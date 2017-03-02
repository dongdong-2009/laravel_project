<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

//获取环境变量测试
Route::get('/getenv',function() {
	$app_url = env('APP_URL','我是默认值,.env文件没有设置我');
	if($app_url){
		return ['status'=>'OK','app_url'=>$app_url];
	}else{
		return ['status'=>'error'];
	}
});
