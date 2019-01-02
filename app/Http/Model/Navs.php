<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;

class Navs extends Model
{
    protected $table='navs';
    protected $primaryKey='nav_id';
    public $timestamps=false;
    //禁止的字段,赋值为空
    public $guarded=[];
}
