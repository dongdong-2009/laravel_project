<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\StudentDemo;

class StudentDemoController extends Controller
{
    public function index(){
    	$students = StudentDemo::paginate(4);
    	//dd($students);
    	return view('student.index',[
    		'students' => $students,
    	]);
    }

    public function create(Request $req){
        $student = new StudentDemo();
    	//可以直接在当前页面处理新建请求
    	if($req->isMethod('POST')){
    		dd("This is test");
    		$data = $req->input('Student');
    		if(Student::create($data)){
    			return redirect('studentDemo/index');
    		}else{
    			return redirect()->back();
    		}
    	}
    	return view('student.create',[
            'student' => $student,
        ]);
    }

    public function save(Request $req){
    	//dd('aaaaaaa');
        
        //1、控制器验证,参数1，参数2验证规则
        //参数3：对验证规则重命名（数组）
        //参数4：对错误变量重命令（数组）
        //验证失败，会抛出异常被web中间件捕获，将错误保存至session并且保存至视图，并返回上级页面
        //\Illuminate\View\Middleware\ShareErrorsFromSession::class,
        //:attribute为占位符
        /*$this->validate($req,[
            'Student.name' => 'required | min:2 | max:10',
            'Student.age' => 'required | integer',
            'Student.sex' => 'required | integer',
        ],[
            'required' => ':attribute为必填项',
            'min' => ':attribute最少2个字符',
            'max' => ':attribute最多10个字符',
            'integer' => ':attribute必须为整数',
        ],[
            'Student.name' => '姓名',
            'Student.age' => '年龄',
            'Student.sex' => '性别',
        ]);*/

        //2、Validator类验证
        //需要手动注册错误信息给view视图
        $validator = \Validator::make($req->input(),[
            'Student.name' => 'required | min:2 | max:10',
            'Student.age' => 'required | integer',
            'Student.sex' => 'required | integer',
        ],[
            'required' => ':attribute为必填项',
            'min' => ':attribute最少2个字符',
            'max' => ':attribute最多10个字符',
            'integer' => ':attribute必须为整数',
        ],[
            'Student.name' => '姓名',
            'Student.age' => '年龄',
            'Student.sex' => '性别',
        ]);

        //dd($validator);
        //withinput进行数据保持
        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $data = $req->input('Student');

    	$stu = new StudentDemo();
    	$stu->name = $data['name'];
    	$stu->age = $data['age'];
    	$stu->sex = $data['sex'];

    	if($stu->save()){
    		return redirect('studentDemo/index')->with('success','添加成功');
    	}else{
    		return redirect()->back();
    	}
    }

    public function update(Request $req,$id){
        $student = StudentDemo::find($id);

        if($req->isMethod('POST')){
            $data = $req->input('Student');
            $student->name = $data['name'];
            $student->age = $data['age'];
            $student->sex = $data['sex'];

            $validator = \Validator::make($req->input(),[
                'Student.name' => 'required | min:2 | max:10',
                'Student.age' => 'required | integer',
                'Student.sex' => 'required | integer',
            ],[
                'required' => ':attribute为必填项',
                'min' => ':attribute最少2个字符',
                'max' => ':attribute最多10个字符',
                'integer' => ':attribute必须为整数',
            ],[
                'Student.name' => '姓名',
                'Student.age' => '年龄',
                'Student.sex' => '性别',
            ]);

            //withinput进行数据保持
            if($validator->fails()){
                return redirect()->back()->withErrors($validator)->withInput();
            }

            if($student->save()){
                return redirect('studentDemo/index')->with('success','修改成功[id]-'.$id);
            }else{
                return redirect()->back();
            }
        }

        return view('student.update',[
            'student' => $student,
        ]);
    }

    public function detail(Request $req,$id){
        $student = StudentDemo::find($id);

        return view('student.detail',[
            'student' => $student,
        ]);
    }

    public function delete($id){
        $student = studentDemo::find($id);

        if($student){
            if($student->delete()){
                return redirect('studentDemo/index')->with('success','删除'.$student->name.'成功');
            }else{
                return redirect('studentDemo/index')->with('success','删除'.$student->name.'失败');
            }  
        }
    }
}
