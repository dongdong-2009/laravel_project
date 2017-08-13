<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>用.方式访问多级目录下的视图</title>
</head>
<body>
	<ul>
		<li>hello &nbsp;{{ $name }}</li>
		<li>工资 &nbsp;{{ $salary}}</li>
		<li>视图合成器渲染变量[count] &nbsp;{{ $count}}</li>
		<li>{{ $viewcomposer }}</li>
	</ul>
</body>
</html>