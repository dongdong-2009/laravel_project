<?php
use App\Http\Middleware\Mkk;
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

/***********************************************
 *                     测试                    *
/**********************************************/
//获取环境变量
Route::get('/getenv',function() {
	//在.env中如果有APP_URL则用.env中的，没有的话就用第二个参数
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

//访问配置值
Route::get('/getconfig',function() {
	//config(['database.connections'=>"我已经设置了"]);
	$value = config('database.connections');
	if(!$value){
		return ['status'=>'error'];
	}else{
		return ['status'=>'OK','databases.connections'=>$value];
	}
});

//单个路由参数,where方法可以传关联数组
Route::get('user/{id}',function($user){
	return ['user'=>$user];
})->where('id','[A-Za-z]+');

//多个路由参数
Route::get('people/{name}/{age}',function($name,$age){
	return ['name'=>$name,'age'=>$age];
});

//路由群组
Route::group(['prefix'=>'haosi','middleware'=>'haosi'], function () {
    Route::get('mkk', function () {
        return ['status'=>'ok','data'=>'我是小昆哥'];
    });
});

//自己定义的中间件，出错重定向到该页面
Route::get('Haosi',function(){
	return ['status'=>'error','msg'=>'浩思不要小孩'];
});
 /***********************************************/
