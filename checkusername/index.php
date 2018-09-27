<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Page Title</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" type="text/css" media="screen" href="main.css" />
  <script src="main.js"></script>
  <script type="text/javascript" src="https://code.jquery.com/jquery-1.8.2.js"></script>
</head>
<body>
<?php
require_once('connect.php');
if(isset($_POST) & !empty($_POST)){
	$username = mysqli_real_escape_string($conn, $_POST['username']);

	$sql = "SELECT * FROM member WHERE mem_username='$username'";
	$result = mysqli_query($conn, $sql);
	$count = mysqli_num_rows($result);
}
?>
<form class="form-signin" method="POST">
    <h2 class="form-signin-heading">Please Register</h2>
    <div class="input-group">
	  <span class="input-group-addon" id="basic-addon1">@</span>
	  <input type="text" name="username" id="username" class="form-control" value="<?php echo $username;?>" required>
    <?php 
    if($username!=""){
      if($count == 1){
		  echo "<font color='red'>มีชื่อนี้อยู่ในระบบแล้ว</font>";
	    }else{
		  echo "<font color='green'>ชื่อนี้สามารถใช้งานได้</font>";
      }
    }else{}
  ?>
	</div>
	
	<label for="inputEmail" class="sr-only">Email address</label>
    <input type="email" name="email" id="inputEmail" class="form-control" placeholder="Email address" required autofocus>
    <label for="inputPassword" class="sr-only">Password</label>
    <input type="password" name="password" id="inputPassword" class="form-control" placeholder="Password" required>
    <button class="btn btn-lg btn-primary btn-block" type="submit">Register</button>
    <a class="btn btn-lg btn-primary btn-block" href="login.php">Login</a>
  </form><span id="usernameLoading"><span id="usernameResult"></span>

<script type="text/javascript">
	$(document).ready(function() {
		$('#usernameLoading').hide();
		$('#username').keyup(function(){
		  $('#usernameLoading').show();
	      $.post("check.php", {
	        username: $('#username').val()
	      }, function(response){
	        $('#usernameResult').fadeOut();
	        setTimeout("finishAjax('usernameResult', '"+escape(response)+"')", 400);
	      });
	    	return false;
		});
	});

	function finishAjax(id, response) {
	  $('#usernameLoading').hide();
	  $('#'+id).html(unescape(response));
	  $('#'+id).fadeIn();
	} //finishAjax
</script>
</body>
</html>
