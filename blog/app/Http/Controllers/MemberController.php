<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Member;					//使用模型命名空间

class MemberController extends Controller
{
    public function info($name,$age){
		return view('member.info',['name' => $name,'age' => $age]);
    }

    public function modelTest(){
    	return Member::getMemeber();
    }
}
