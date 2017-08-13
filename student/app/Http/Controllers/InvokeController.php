<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

/*
	创建只包含__invoker的控制器，只处理单个操作
 */
class InvokeController extends Controller
{
	//当对象被当做方法调用时，该方法会被自动调用
	//invoke和普通函数一样传参个数由invoke函数本身的参数个数决定
    public function __invoke($a1,$a2,$a3){
    	return [
    		'status' => "ok",
    		'参数1' => $a1,
    		'参数2' => $a2,
    		'参数3' => $a3,
    	];
    }
}
