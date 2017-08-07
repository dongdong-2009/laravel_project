<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/*
	模型默认用模型的小写复数作为关联的表名
 */
class Student extends Model
{
    //模型关联表
    protected $table = "student";

    //默认以id作为主键，可以指定
    protected $primaryKey = "id";

    //设置该属性可以阻止ORM默认在save表格的时候增加created_at、updated_at列
    public $timestamps = true;

    //指定使用模型的create方法批量添加数据时的可批量操作字段
    protected $fillable = ['name','age'];

    //指定不容许批量赋值的字段
    protected $Sguarded = [];

    //设置create的时间为当前时间戳
    /*protected function getDateFormat(){
    	return time();
    }*/

    //设置获取数据时返回的时间戳,不设置会返回格式化后的时间
    protected function asDateTime($val){
    	return $val;
    }
}
