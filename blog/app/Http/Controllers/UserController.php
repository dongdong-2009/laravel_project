<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    //控制器测试方法
    public function show($id,$name){
    	return [
    		'id' => $id,
    		'name' => $name,
    	];
    }
}
