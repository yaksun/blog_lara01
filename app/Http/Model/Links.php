<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;

class Links extends Model
{
    protected $table='links';
    protected $primaryKey='link_id';
    public $timestamps=false;
    //禁止的字段,赋值为空
    public $guarded=[];
}
