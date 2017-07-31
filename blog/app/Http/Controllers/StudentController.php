<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StudentController extends Controller
{
    /*
        使用DB操作数据库
     */
    public function select(){
    	$sql = 'select * from student';
    	$student = DB::select($sql);
    	dd($student);
    }

    public function insert($name = 'user',$age = 10,$sex = 1){
    	/*return [
    		'name' => $name,
    		'age' => $age,
    		'sex' => $sex
    	];*/
    	$sql = 'insert into student(name,age,sex) values(?,?,?)';
    	$bool = DB::insert($sql,[$name,$age,$sex]);
    	var_dump($bool);
    }

    public function update(){
    	$sql = 'update student set age = ? where name = ?';
    	$count = DB::update($sql,
    		['100','mayun']);
    	var_dump($count);
    }

    public function delete($name){
    	$sql = 'delete from student where name = ?';
    	$num = DB::delete($sql,[$name]);
    	var_dump($num);
    }

    /*
        查询构造器操作数据库
     */
    public function query3(){
        return "hello";
    }
}
