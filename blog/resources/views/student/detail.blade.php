@extends('common.layouts')

@section('content')
	<div class="panel panel-default">
		<div class="panel-heading">学生详情</div>
		
		<table class="table table-bordered table-striped table-hover">
			<tbody>
				<tr>
					<td width="50%">ID</td>
					<td>{{ $student->id }}</td>
				</tr>
				<tr>
					<td>姓名</td>
					<td>{{ $student->name }}</td>
				</tr>
				<tr>
					<td>年龄</td>
					<td>{{ $student->age }}</td>
				</tr>
				<tr>
					<td>性别</td>
					<td>{{ $student->sex }}</td>
				</tr>
				<tr>
					<td>添加日期</td>
					<td>{{ date('Y-m-d h:i:s',$student->created_at) }}</td>
				</tr>
				<tr>
					<td>更新日期</td>
					<td>{{ date('Y-m-d h:i:s',$student->updated_at) }}</td>
				</tr>
			</tbody>
		</table>
	</div>
@stop