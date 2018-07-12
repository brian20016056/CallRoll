<!DOCTYPE html>
<html>

<head>
  <title>登入頁面</title>
</head>

<body>
@if($errors)
<div>{{ $errors }}</div>
@endif
<form method="POST" action="{{ route('userAuth')}}">
 帳號:<br>
<input type="text" name="username">
<br>
 密碼:<br>
<input type="text" name="password">
<input type="hidden" name="_token" value="{{ csrf_token() }}" />
<input type="submit" value="登入">
</form> 

</body>
</html>
