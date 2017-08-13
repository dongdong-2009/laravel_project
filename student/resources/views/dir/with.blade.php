<!DOCTYPE html>
<html>
<head>
	<title>with传参</title>
</head>
<body>
	@if (isset($with))
	<h1>{{ $with }}</h1>
	<h3>这是AppserviceProvider的boot方法共享给所有视图的变量[$Akon]--->{{ $Akon }}</h3>
	@endif
</body>
</html>