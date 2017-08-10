<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>轻松学会Laravel - @yield('title')</title>
	<link rel="stylesheet" type="text/css" href="./static/bootstrap.min.js">
	@section('style')
	@show
</head>
<body>
{{-- 头部 --}}
@section('header')
	<div class="jumbotron">
		<div class="container">
			<h2>轻松学会laravel</h2>
			<p>-玩转laravel表单</p>		
		</div>
	</div>
@show

{{-- 中间内容区域 --}}
<div class="container">
	<div class="row">
		{{-- 左侧菜单区域 --}}
		<div class="col-md-3">
		@section('leftmenu')
			<div class="list-group">
				<a href="#" class="list-group-item active">学生列表</a>
				<a href="#" class="list-group-item">新增学生</a>
			</div>
		@show			
		</div>

		{{-- 右侧内容区 --}}
		<div class="col-md-9">
			{{-- 成功提示框 --}}
			<div class="alert alert-success alert-dismissible" role="alert">
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
					<span aria-hidden='true'>&times;</span>
				</button>
				<strong>成功</strong>
			</div>

			{{-- 失败提示框 --}}
			<div class="alert alert-danger alert-dismissible" role="alert">
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
					<span aria-hidden='true'>&times;</span>
				</button>
				<strong>成功</strong>
			</div>
		</div>
	</div>
</div>
</body>
</html>