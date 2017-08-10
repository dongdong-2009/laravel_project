@extends('student.layout')

{{-- 显示title区块，section参数是继承的父模板中yield或section定义的区块 --}}
@section('title')
	section1_title
@stop{{-- 此处必须用stop，不然下面区块也会显示title字段 --}}

@section('header')
@parent{{-- 不写parent就会直接重写父模板 --}}
	：section1_header
@stop

@section('content')
@parent{{-- yeild无法继承，只会override --}}
	content
	{{-- 1、模板中输出php变量 --}}
	<p>name:{{ $name }}</p>

	{{-- 2、模板中调用php代码 --}}
	<p>{{ date('Y-m-d h:i:s',time()) }}</p>
	<p>{{ in_array($name, $arr) ? 'true' : 'false' }}</p>
	{{-- <p>{{ isset($name1) ? $name : 'default_name' }}</p> --}}
	<p>{{ $name1 or 'default_name' }}</p>{{-- 等同于上面 --}}

	{{-- 3、原样输出 --}}
	<p>@{{ $name }}</p>

	{{-- 5、引入子视图include --}}
	@include('student.child1',['message' => '我是错误信息'])
@stop