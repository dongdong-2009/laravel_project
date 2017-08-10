<?php
use App\Http\Middleware\Mkk;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\View;
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

/*Route::get('post1',function(){
	return view('post1');
});
//post请求的的路由
Route::post('post2',function(Request $req){
	echo "<pre>";
	var_dump($req);
	echo "</pre>";
	return [
		'name' => $req->input('username'),
		'passwd' => $req->input('passwd')
	];
});*/

/*
//路由别名
Route::get('alias/22',['as' => 'super',function(){
	return [
		'msg' => '路由别名',
		'route_name' => route('super')
	];
}]);*/

/*//路由群组
Route::group(['prefix' => 'member'],function(){
	Route::get('xueyou',function(){
		return ['member' => "xueyou"];
	});

	Route::get('xudong',function(){
		return ['member' => "xudong"];
	});
});*/

/*//路由参数后面加?可以省略
Route::get('user100/{id}/{name?}',function($id1,$name = 'akon'){
	return $name == 'akon' ? [
		'status' => '使用了匿名函数默认参数，路由参数加问号可以省略参数',
		'id' => $id1,
		'name' => $name,
	] : [
		'status' => '正常使用参数',
		'id' => $id1,
		'name' => $name,
	];
})->where([
	'id' => '[1-9][1-9]',
	'name' => '[A-Za-z]+'
]);*/

Route::get('blade_test',function(Request $request){
	//方法一：从url截取视图名
	/*$url = $request->url();
	$pos = strrpos($url,'/');	//从右边获取字符在字符串中出现的位置
	$blade_view = substr($url,$pos+1);	//从字符串中截取指定长度
	return ['blade_view' => $blade_view,'url'=>$url];*/
	//方法二：从get参数获取视图名
	$blade_view = $request->input('view');
	if(View::exists($blade_view)){
		return view($blade_view,[
			'name' => 'akon',
			'salary' => '10k',
		]);
	}else{
		return response()->json([
				'status' => 'error',
				'msg'=> '访问的视图'.$blade_view.'不存在'
			]);
	}
});

//多级目录访问视图用.方式,用/也可以
Route::get('dir_hello',function(){
	return view('dir.hello',[
		'name' => 'akon',
		'salary' => '10k',
		]);
});

Route::get('view_with',function(){
	return view('dir.with')->with('with',"I am with");
});


Route::get('/', function () {
    return view('welcome');
});

//重定向到指定url，并添加session并且在blade中显示
Route::get('redir',function(){
	return redirect('/')->with('status', '重定向页面session');
});

//响应并自动下载文件
Route::get('download',function(){
	return response()->download('G:\laravel5.4\blog\webpack.mix.js',"我是小昆哥");
});

//返回数组，自动转换为json字符串
Route::get('response_json',function(){
	return response()->json([
			'name' => "Akon",
			'age' => '20',
		]);
});

//响应文件
Route::get("show_file",function(){
	return response()->file('G:\web\js\img\1.jpg');
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
Route::get('people/{name}/{age?}',function($name1,$age1){
	return ['name'=>$name1,'age'=>$age1];
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
		'status' => 'error',
		'msg'=>'浩思不要小孩',
		'路由名称' => ($this->current()) ? $this->current()->getName() : null,
		'request[\'age\']' => $request->input('age'),
		'$path' => $request->path(),
	];
});

 /**************************************************************
							控制器测试
 ***************************************************************/
//----------------------------【1】北风网视频---------------------------------
//访问MemberController控制器方法info方式1
//Route::get('member/info','MemberController@info');
//访问MemberController控制器方法info方式2
Route::any('member/info/{name}/{age}',['uses' => 'MemberController@info'])
->where(['name' => '[a-zA-Z]+','age' => '[1-9]+']);

Route::match(['get','post'],'member/modelTest','MemberController@modelTest');

//控制器操作学生表
Route::match(['get','post','put'],'DB_facade_select','StudentController@select');
Route::match(['get','post','put'],'DB_facade_insert/{name}/{age}/{sex}','StudentController@insert');
Route::match(['get','post','put'],'DB_facade_update','StudentController@update');
Route::match(['get','post','put'],'DB_facade_delete/{name}','StudentController@delete');
Route::get('query_bulder_insert','StudentController@query_bulder_insert');
Route::get('query_builder_update','StudentController@query_builder_update');
Route::get('query_builder_delete','StudentController@query_builder_delete');
Route::get('query_builder_select','StudentController@query_builder_select');
Route::get('query_builder_juhefunc','StudentController@query_builder_juhefunc');
Route::get('orm_select','StudentController@orm_select');
Route::get('orm_add','StudentController@orm_add');
Route::get('orm_update','StudentController@orm_update');
Route::get('orm_delete','StudentController@orm_delete');
Route::get('section1',['uses' => 'StudentController@section1']);
Route::get('section2',['uses' => 'StudentController@section2']);
Route::get('url',['uses' => 'StudentController@urlTest','as' => 'urlalias']);
//----------------------------1---------------------------------

/****************************【2】laravel China论坛**********************************/
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



Auth::routes();

Route::get('/home', 'HomeController@index');
