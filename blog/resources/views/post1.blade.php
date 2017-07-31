<!DOCTYPE html>
<html>
	<meta charset="utf-8">
<head>
	<title>测试post路由</title>
</head>
<body>
<h1><center>This is post1 view</center></h1>
<form method="post" action="post2"><!--此处的action直接填写路由名称-->
	<input type="hidden" name="_token" value="{{csrf_token()}}">
	用户名：<input type="text" name="username"><br>
	密码：<input type="text" name="passwd"><br>
	<input type="submit" value="post提交"><br>
</form>
</body>
</html>