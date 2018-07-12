<!DOCTYPE html>
<html>

<head>
  <title>登入頁面</title>
</head>

<body>

<form method="POST" action="{{ route('userAuth')}}">
 帳號:<br>
<input type="text" name="帳號">
<br>
 密碼:<br>
<input type="text" name="密碼">
<input type="submit" value="登入">
</form> 

</body>
</html>
