<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>学生系统 - @yield('title')</title>
	<link rel="stylesheet" type="text/css" href= {{ asset('static/bootstrap.min.css') }}>
	@section('style')
	@show
</head>
<body>
{{-- 头部 --}}
@section('header')
	<div class="jumbotron">
		<div class="container">
			<h2>轻松学会laravel</h2>
			<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;--玩转laravel表单</p>		
		</div>
	</div>
@show

{{-- 中间内容区域 --}}
<div class="container">
	<div class="row">
		{{-- 左侧菜单区域 --}}
		<div class="col-xs-3">
		@section('leftmenu')
			<div class="list-group">
				<a href="{{ url('studentDemo/index') }}" class="list-group-item 
				{{ Request::getPathInfo() == '/studentDemo/index' ? 'active' : ''}}">学生列表</a>
				<a href="{{ url('studentDemo/create') }}" class="list-group-item
				{{ Request::getPathInfo() == '/studentDemo/create' ? 'active' : '' }}">新增学生</a>
			</div>
		@show			
		</div>

		{{-- 右侧内容区 --}}
		<div class="col-md-9">
			@yield('content')
			{{-- 自定义内容区域 --}}	
		</div>
	</div>
</div>

{{-- 底部 --}}
@section('footer')
	<div class="jumbotron" style="margin: 0">
		<div class="container">
			<span> @2017 Akon</span>
		</div>
	</div>
@show

<script type="text/javascript" src={{ asset('static/jquery.min.js') }}></script>
<script type="text/javascript" src={{ asset('static/bootstrap.min.js') }}></script>

@section('javascript')
@show

</body>
</html>