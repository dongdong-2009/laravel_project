<?php
use App\Http\Middleware\Mkk;
use Illuminate\Http\Request;
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
//url中带{}的会识别为参数传给闭包函数
Route::get('user/{id}',function(Request $request,$user){
	//$aaaa = "";
	return [
		'user' => $user,
		'is方法' => $request->is("user/akon"),
		'url' => $request->url(),
		'fullurl' => $request->fullUrl(),
		'method' => $request->isMethod('post'),
		//'测试空字符串转null' => $aaaa,
		'request_all' => $request->all(),
		'request默认值输入默认值' => $request->input('职业','laravle'),
		'request的has方法' => $request->has('aa'),
	];
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
Route::get('Haosi',function(Request $request){
	return [
		'status' => 'error','msg'=>'浩思不要小孩',
		'路由名称' => ($this->current()) ? $this->current()->getName() : null,
		'request[\'age\']' => $request->input('age'),
		'$path' => $request->path(),
	];
});
 /***********************************************/

 /*
 	控制器路由,调用控制器UserController的show方法
 	两个参数都会传给控制器，名字不用对，只要位置对上即可
  */
 Route::get('msg/{id}/{name}','UserController@show');//->middleware('haosi');

/*
	调用只处理单个操作的控制器
 */
Route::get('invoke/{salary}/{man}/{aa}','InvokeController');

/*
	给资源控制器注册一个资源路由
	可以指定资源可以使用的方法
 */
Route::resource('photos','PhotoController',[
	'only' => [
		'index',
		'create',
		'show',
	],
	//命名路由名称
	'names' => [
		'create' => 'new',
	],
	//路由资源参数，没弄懂
	'parameters' => [
		'photos' => 'liuyan',
	],
	]);