<!DOCTYPE html>
<html>

<head>
<script type="text/javascript">
$('#username').blur(function(){
	var Right = [A-Za-z0-9]{6,20};
	var Short = {0,5};
	var Long = {21,};
	var WorngWord = [^A-Za-z0-9];
	if(Short.test($("#username").val())){
		$("#usernameMessage").text("帳號長度過短!");
	}
	else if(Long.test($("#username").val())){
		$("#usernameMessage").text("帳號長度過長!");
	}
	else if(WorngWord.test($("#username").val())){
		$("#usernameMessage").text("出現錯誤字元!");
	}
    else if(Right.test($("#username").val())){
		$("#usernameMessage").text("帳號格式通過!");
	}
	else{
		$("#usernameMessage").text("格式不符!");
	}
});
$('#password').blur(function(){
	var Right = [A-Za-z0-9]{6,20};
	var Short = {0,5};
	var Long = {21,};
	var WorngWord = [^A-Za-z0-9];
	if(Short.test($("#password").val())){
		$("#passwordMessage").text("帳號長度過短!");
	}
	else if(Long.test($("#password").val())){
		$("#passwordMessage").text("帳號長度過長!");
	}
	else if(WorngWord.test($("#password").val())){
		$("#passwordMessage").text("出現錯誤字元!");
	}
    else if(Right.test($("#password").val())){
		$("#passwordMessage").text("帳號格式通過!");
	}
	else{
		$("#passwordMessage").text("格式不符!");
	}
});
</script>
  <title></title>
</head>

<body>
@if($errors)
<div>{{ $errors }}</div>
@endif
<form method="POST" action="{{ route('userAuth')}}">
 輸入帳號<br>
<input type="text" name="username">
<div id="usernameMessage">></div><br>
輸入密碼<br>
<input type="text" name="password">
<div id="passwordMessage">></div><br>
<input type="hidden" name="_token" value="{{ csrf_token() }}" />
<input type="submit" value="登入">
</form> 

</body>
</html>
