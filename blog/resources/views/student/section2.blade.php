@extends('student.layout')

{{-- 显示title区块，section参数是继承的父模板中yield或section定义的区块 --}}
@section('title')
	section2_title
@stop{{-- 此处必须用stop，不然下面区块也会显示title字段 --}}

@section('header')
@parent{{-- 不写parent就会直接重写父模板 --}}
	：section2_header
@stop

@section('content')
@parent{{-- yeild无法继承，只会override --}}
	{{-- 1、if --}}
	@if($name == 'sean1')
		<p>姓名:{{ $name }}</p>
	@else
		<p>姓名:no</p>
	@endif

	{{-- 2、unless,相当于if取反 --}}
	@unless ($name == 'aaa')
		<p>I am not aaa</p>
	@endunless


	{{-- 3、for --}}
	{{-- @for($i = 0;$i < 3;$i++)
		<p>{{ $i }}</p>
	@endfor --}}

	{{-- 4、foreach --}}
	{{-- @foreach ($students as $row)
		<p>id:{{ $row->id }},name:{{ $row->name }}</p>
		@if($row->id > 2)
			@break
		@endif
	@endforeach --}}

	{{-- 5、forelse --}}
	{{-- @forelse($students as $row)
		<p>{{ $row->age }}</p>
	@empty
		<p>null</p>
	@endforelse --}}

	{{-- 通过url名字获取路由并跳转 --}}
	<p><a href="{{ url('url') }}">1、url()获取路由名跳转</a></p>
	<p><a href="{{ action('StudentController@urlTest') }}">2、action通过控制器及方法跳转</a></p>
	<p><a href="{{ route('urlalias') }}">3、通过route()获取路由别名生成url</a></p>
@stop