<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StudentDemo extends Model
{
    protected $table = 'student';

    public $timestamps = true;

    //添加行时设置的时间戳
    protected function getDateFormat(){
    	return time();
    }

    //获取行中的时间戳
    protected function asDateTime($val){
    	return $val;
    }
}
