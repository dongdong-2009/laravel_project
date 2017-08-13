<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StudentDemo extends Model
{
    const SEX_UN = 0;
    const SEX_BOY = 1;
    const SEX_GIRL = 2;

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

    //获取性别
    public function getSex($ind = null){
        $arr = [
            self::SEX_UN => '未知',
            self::SEX_BOY => '男',
            self::SEX_GIRL => '女'
        ];

        if($ind !== null){
            return array_key_exists($ind,$arr) ? $arr[$ind] : $arr[self::SEX_UN];
        }

        return $arr;
    }
}
