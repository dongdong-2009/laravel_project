@if(count($errors))<!-- 如果全局的errors对象被赋值则显示错误信息 -->
	<div class="alert alert-danger">
		<ul>
			@foreach ($errors->all() as $err)
				<li>{{ $err }}</li>
			@endforeach
		</ul>
	</div>
@endif