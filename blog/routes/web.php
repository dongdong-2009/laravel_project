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
	$environment = App::environment();
	if($app_url && $environment){
		return ['status'=>'OK',
		'app_url'=>$app_url,
		'environment'=>$environment];
	}else{
		return ['status'=>'error'];
	}
});

//访问配置值测试
Route::get('/getconfig',function() {
	//config(['database.connections'=>"我已经设置了"]);
	$value = config('database.connections');
	if(!$value){
		return ['status'=>'error'];
	}else{
		return ['status'=>'OK','databases.connections'=>$value];
	}
});
