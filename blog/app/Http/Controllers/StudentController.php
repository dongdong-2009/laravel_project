<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Student;
use Illuminate\Support\Facades\Session;

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
    public function query_bulder_insert(){
        $bool = DB::table('student')->insert([
        		['name' => 'user_1', 'age' => 1],
				['name' => 'user_2', 'age' => 2],
				['name' => 'user_3', 'age' => 3],
				['name' => 'user_4', 'age' => 4],
				['name' => 'user_5', 'age' => 5],
        ]);
		/*$id = DB::table('student')->insertGetId(
			['name' => 'aa','age' => '10']
		);
        var_dump($id);*/
    }

    public function query_builder_update(){
    	/*$num = DB::table('student')
    		->where('id',6)
    		->update(['age' => 100]
    	);*/

    	//$num = DB::table('student')->increment('age',3);
    	//$num = DB::table('student')->decrement('age',3);
    	/*$num = DB::table('student')
    		->where('id',6)
    		->decrement('age',3);*/
    	$num = DB::table('student')
    		->where('id',6)
    		->decrement('age',3,['name' => 'decrement']);
    	var_dump($num);
    }

    public function query_builder_delete(){
    	/*$num = DB::table('student')
    		->where('id','>=','7')
    		->delete();
    	var_dump($num);
    	*/
    	DB::table('student')->truncate();	//清空数据表
    }

    public function query_builder_select(){
    	//get:获取所有数据
    	//$student = DB::table('student')->get();
    	
    	//first:获取表的一行
    	//$student = DB::table('student')->orderBy('id','desc')->first();
    	
    	//where
    	/*$student = DB::table('student')
    		->where('id','>=',6)
    		->get();*/
    	/*$student = DB::table('student')
    		->whereRaw('id >= ? and age > ?',[4,50])
    		->get();*/

    	//pluck:返回结果集中指定的字段
    	/*$student = DB::table('student')
    		->pluck('age');*/

    	//lists:返回结果集中指定字段,并可指定下标
    	/*$student = DB::table('student')
    		->lists('name','id');*/

    	//select:指定返回结果集的多个字段
    	/*$student = DB::table('student')
    		->select('id','name','age')
    		->get();*/
    	//dd($student);

    	//chunk：指定每次查找几条数据（必须指定排序）
    	echo "<pre>";
    	DB::table('student')->orderBy('age')->chunk(1,function($students){
    			var_dump($students);
    			if(1){
    				return false;	//遇到false终止查询
    			}
    		});
    	echo "</pre>";
    }

    //聚合函数
    public function query_builder_juhefunc(){
    	//count：返回表的记录条数
    	//$num = DB::table('student')->count();
    	
    	//max:返回最大值
    	//$max = DB::table('student')->max('name');
    	
    	//min：返回最小值
    	//$min = DB::table('student')->min('age');

    	//avg：返回平均值
    	//$avg = DB::table('student')->avg('age');
    	
    	//sum：返回总和
    	$sum = DB::table('student')->sum('age');
    	dd($sum);
    }

    /*
        使用Eloqument ORM操作数据库
        使namespace App\Student模型
     */
    public function orm_select(){
        //$students = Student::all();      //返回模型对象
        //$students = Student::find(7);   //find默认以id为主键，如果在模型中没有指定，返回模型对象
        //$students = Student::findOrFail(2); //失败则停止
        
        //查询构造器
        //$students = Student::get();         //在模型中使用查询构造器
        /*$students = Student::where('id','>','2')
            ->orderBy('id','desc')
            ->first();
        dd($students);*/
        /*Student::chunk(2,function($students){
            var_dump($students);
        });*/
        
        //聚合函数
        //return Student::count();
        //return Student::where('id','>',2)->max('name');
        //return Student::where('id','>',2)->min('name');
        return Student::where('id','>',2)->avg('age');
    }

    public function orm_add(){
        //使用模型新增数据
       /* $student = new Student();
        $student->name = 'sean2';
        $student->age = 22;
        $bool = $student->save();
        dd($student);*/

        //$student =  Student::find(8);
        //return ['id' => 8,'created_at' => $student->created_at];
        //return $student->created_at;
        //echo date('Y-m-d H:i:s',$student->created_at);
        
        //使用模型的create方法新增数据
        /*$student = Student::create(
            ['name' => 'akon1','age' => '18']
        );
        dd($student);*/

        //以属性查找用户，如果没有则新增，返回查找到的实例
        /*$student = Student::firstOrCreate(
            ['name' => 'akon2']
        );*/

        //以属性查找用户,不存在则创建实例，但需要手动保存
        $student = Student::firstOrNew(
            ['name' => 'akon3']
        );
        $bool = $student->save();

        dd($student);
    }

    public function orm_update(){
        //通过模型更新数据
       /* $student = Student::find(13);
        $student->name = 'akon3_update';
        $bool = $student->save();
        dd($bool);*/
        /*$student = Student::where('name','akon3');
        dd($student);*/

        //结合查询语句批量更新
        $num = Student::where('id','>',10)->update(
            ['age' => '22']
        );
        dd($num);
    }

    public function orm_delete(){
        //1、通过模型删除
        /*$student = Student::find(13);
        $bool = $student->delete();
        dd($bool);*/

        //2、通过主键值删除
        /*$num = Student::destroy(12,11);
        //$num = Student::destroy([12,11]);
        //$num = Student::destroy(12);
        dd($num);*/

        //3、根据指定条件删除
        $num = Student::where('id', '>' ,'8')->delete();
        dd($num);
    }

    public function section1(){
        $name = 'sean';
        $arr = ['sean','imoc'];

        //第二个参数可以给视图传参
        return view('student.section1',[
            'name' => $name,
            'arr' => $arr
        ]);
    }

    public function section2(){
        $students = Student::get();
        $name = 'sean';
        $arr = ['sean','imoc'];
        
        return view('student.section2',[
            'name' => $name,
            'arr' => $arr,
            'students' => $students
        ]);
    }

    public function urlTest(){
        return view('student.urlTest');
    }

    /*
        laravel表单篇
     */
    public function request1(Request $req){
        //1、取值
        /*return [
            'name' => $req->input('name'),
            'sex' => $req->input('sex','未知性别')  //第二个参数为未定义变量时的默认值
        ];*/

        /*if($req->has('age')){
            return $req->input('age');
        }else{
            return 'age is unset';
        }*/

        //dd($req->all());
        
        //2、判断请求类型
        return [
            'request_method' => $req->method(),
            'judge_post_or_not' => $req->ismethod('POST') ? "is POST" : "not post",
            'judge_ajax_request_ir_not' => $req->ajax() ? "is ajax request" : "not ajax request",
            '判断请求前缀' => $req->is('student/*'),
            '请求url' => $req->url(),
        ];
    }

    public function session1(Request $req){
        //1、HTTP request session()
        //$req->session()->put('key1','value1');

        //2、session的辅助函数
        //session()->put('key2','value2');
        
        //3、通过Session类
        //Session::put('key3','value3');
        
        //4、以数组的形式存储session
        //Session::put(['key4' => 'value4']);
        
        //5、把数据放至session数组中
        //Session::push('student',"stu1");
        //Session::push('student',"stu2");
        
        //6、session只有第一在别的页面访问时存在
        Session::flash('key_flash','val_flash');
        return redirect('student/session2');
    }

    public function session2(Request $req){
        //从session中取数据
        return [
            'session[key1]' => $req->session()->get('key1'),
            'session[key2]' => session()->get('key2'),
            'session[key3]' => Session::get('key3'),
            'session[key4]' => session()->get('key4','default_key4'),
            'session[student]' => Session::pull('student'),
            'session::all' => Session::all(),
            'session::has' => Session::has('key11'),
            //'session::forget' => Session::forget('key1'),   //删除session指定值
            //'session::flush' => Session::flush(),   //清空session
            'session::flash' => Session::get('key_flash'),
        ];
    }

    public function reponse(){
        $data = [
            'errCode' => 0,
            'errMsg' => 'success',
            'data' => 'Sean',
        ];

        //return response()->json($data);
        //return redirect('student/redirect')->with('msg','快闪数据');
        /*return redirect()     //控制器方法跳转
            ->action('StudentController@redirect')
            ->with('msg','快闪数据');*/
        //return redirect()->route('redir')->with('msg','快闪数据');    //路由别名跳转
        return redirect()->back();  //返回上一个页面
    }

    public function redirect(){
        $msg = Session::get('msg','暂无信息');
        return [
            'msg' => 'I am redirect',
            'with_msg' => $msg,
        ];
    }

    //活动的宣传页面
    public function activity0(){
        return [
            'status' => 'not arrived',
            'msg' => '活动即将开始，敬请期待',
            'date_now' => date('Y-m-d h:i:s',time()),
            'date_activity' => date('Y-m-d h:i:s',strtotime('2017-08-11'))
        ];
    }

    public function activity1(){
        return [
            'status' => 'doing',
            'msg' => '活动1正在进行中，谢谢您的参与'
        ];
    }

    public function activity2(){
        return [
            'status' => 'doing',
            'msg' => '活动2正在进行中，谢谢您的参与'
        ];
    }
}
