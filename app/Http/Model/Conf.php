<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;

class Conf extends Model
{
    protected $table='Conf';
    protected $primaryKey='conf_id';
    public $timestamps=false;
    //禁止的字段,赋值为空
    public $guarded=[];




}
