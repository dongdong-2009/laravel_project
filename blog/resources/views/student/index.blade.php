@extends('common.layouts')

@section('title')
	首页
@stop

@section('content')
@include('common.message'){{-- 引入子视图 --}}
<div class="panel panel-default">
	<div class="panel-heading">学生列表</div>
	<table class="table table-striped table-hover table-responsive">
		<thead>
		<tr>
			<th>ID</th>
			<th>姓名</th>
			<th>年龄</th>
			<th>性别</th>
			<th>添加时间</th>
			<th>操作</th>
		</tr>
		</thead>
		<tbody>
		@foreach ($students as $stu)
			<tr>
				<th scope="row">{{ $stu->id }}</th>
				<td>{{ $stu->name }}</td>
				<td>{{ $stu->age }}</td>
				<td>{{ $stu->sex ? '男' : '女' }}</td>
				<td>{{ date('Y-m-d h:i:s',$stu->created_at) }}</td>
				<td>
					<a href="">详情</a>
					<a href="">修改</a>
					<a href="">删除</a>
				</td>
			</tr>
		@endforeach	
		</tbody>
	</table>
</div>

{{-- 分页 --}}
<div class="pagination pull-right">
	{{ $students->render() }}
</div>
{{-- <div>
	<ul class="pagination pull-right">
		<li>
			<a href="#" aria-label="Previous">
				<span aria-hidden="true">&laquo;</span>
			</a>
		</li>
		<li class="active"><a href="#">1</a></li>
		<li><a href="#">2</a></li>
		<li><a href="#">3</a></li>
		<li><a href="#">4</a></li>
		<li><a href="#">5</a></li>
		<li>
			<a href="#" aria-label="Next">
				<span aria-hidden="true">&raquo;</span>
			</a>
		</li>
	</ul>
</div> --}}
@stop
