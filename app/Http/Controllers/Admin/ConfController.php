<?php

namespace App\Http\Controllers\Admin;

use App\Http\Model\Conf;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

class ConfController extends Controller
{
    //获取全部分类
    // GET| admin/Conf
    public function index()
    {
        $data=Conf::orderBy('conf_order','desc')->get();

        foreach ($data as $k=>$v){
            //根据字段类型拼装显示内容
            switch($v->field_type){
                case 'input':
                    $data[$k]->_html='<input class="lg" type="text" name="conf_content[]" value="'.$v->conf_content.'"/>';
                    break;
                case 'textarea':
                    $data[$k]->_html='<textarea name="conf_content[]">'.$v->conf_content.'</textarea>';
                    break;
                case 'radio':
                    $str='';
                    $arr=explode(',',$v->field_value);
                    foreach ($arr as $m=>$n){
                        $r=explode('|',$n);
                        $c="";
                        if($v->conf_content==$r[0]){
                            $c="checked";
                        }
                        $str.='<input type="radio" name="conf_content[]" value="'.$r[0].'" '.$c.' />'.$r[1]."&nbsp;&nbsp";

                    }
                    $data[$k]->_html=$str;
                    break;
            }
        }
        return view('admin.conf.index',compact('data'));
    }
    //新建配置
    //GET| admin/Conf/create
    public function create()
    {
        return view('admin.conf.add');
    }

    //添加配置提交
    // | POST| admin/conf
    public function store()
    {

        $input=Input::except('_token');
        $rule=[
            'conf_name'=>'required',
            'conf_title'=>'required',

        ];
        $msg=[
            'conf_name.required'=>'配置名称不能为空',
            'conf_title.required'=>'配置标题不能为空',

        ];

        $validator=Validator::make($input,$rule,$msg);
        if($validator->passes()){

            $res=Conf::create($input);
            if($res){
                $this->putFile();
                return redirect('admin/conf')->with('errors','配置添加成功');
            }else{
                return back()->with('errors','配置添加失败');
            }
        }else{
            return back()->withErrors($validator);
        }
    }

    public function changeOrder()
    {
        $input=Input::all();
        $conf=Conf::find($input['conf_id']);
        $conf->conf_order=$input['conf_order'];

        $res=$conf->update();

        if($res){
            $data=[
                'status'=>0,
                'msg'=>'配置修改成功'
            ];
        }else{
            $data=[
                'status'=>1,
                'msg'=>'配置修改失败'
            ];
        }

        return $data;
    }

    //展示单个配置
    //GET| admin/conf/{Conf}
    public function show($conf_id)
    {
        $field=Conf::find($conf_id);

        return view('admin.conf.edit',compact('field'));
    }
    //编辑单个配置
    //GET| admin/conf/{conf}/edit
    public function edit()
    {

    }
    //更新单个配置
    //PUT| admin/conf/{conf}
    public function update($conf_id)
    {

        $input=Input::except('_token','_method');
        $res=Conf::where('conf_id',$conf_id)->update($input);
        if($res){
            $this->putFile();
            return redirect('admin/conf');
        }else{
            return back()->with('errors','配置修改失败');
        }
    }

    //删除单篇配置
    // DELETE  admin/Conf/{Conf}
    public function destroy($conf_id)
    {
        $res=Conf::where('conf_id',$conf_id)->delete();
        if($res){
            $this->putFile();
            $data=[
                'status'=>0,
                'msg'=>'配置删除成功'
            ];
        }else{
            $data=[
                'status'=>1,
                'msg'=>'配置删除失败'
            ];
        }

        return $data;
    }
    //配置首页修改配置内容的方法
    public function changeContent()
    {
        $input=Input::except('_token');
        $res=0;
        foreach ($input['conf_id'] as $k=>$v){
            $res+=Conf::where('conf_id',$v)->update(['conf_content'=>$input['conf_content'][$k]]);
        }
        if($res==0){
            return back()->with('errors','内容没有修改');
        }else{
            $this->putFile();
            return back()->with('errors','内容修改成功');
        }



    }
    public function putFile()
    {
        $data=Conf::pluck('conf_content','conf_title')->all();
        //echo var_export($data,true);
        //var_export($data);
        //要写入的内容
        $str='<?php return '.var_export($data,true).';';
        //写入的路径
        $path=base_path().'\config\web.php';

        file_put_contents($path,$str);
       // echo config('web.web_url');

    }

}
