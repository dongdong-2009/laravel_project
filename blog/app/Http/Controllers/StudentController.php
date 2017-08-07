<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Student;

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
}
