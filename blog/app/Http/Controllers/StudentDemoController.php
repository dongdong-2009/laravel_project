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
    	//可以直接在当前页面处理新建请求
    	if($req->isMethod('POST')){
    		dd("aaaaaaaaaaaaaa");
    		$data = $req->input('Student');
    		if(Student::create($data)){
    			return redirect('studentDemo/index');
    		}else{
    			return redirect()->back();
    		}
    	}
    	return view('student.create');
    }

    public function save(Request $req){
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
}
