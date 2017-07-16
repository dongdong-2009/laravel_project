<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Closure;

class UserController extends Controller
{
	//在控制器构造函数中指定中间件
	//Controller控制器定义了middleware方法，会去调用相应的中间件
	public function __construct(){
		$this->middleware('haosi');
		//控制器允许利用闭包创建中间件
		$this->middleware(function($request,Closure $next){
			if($request->input('age') > 30){
				return redirect('Haosi');
			}
			return $next($request);
		});
	}

    //控制器测试方法
    public function show(Request $request,$id,$name){
    	return [
    		'id' => $id,
    		'name' => $name,
    		//有第二个参数，当session变量不存在时会使用默认值
    		'session[s]' => $request->session()->get('s','默认session值'),
    	];
    }
}
