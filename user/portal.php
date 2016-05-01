<?php
	require_once('../config.php');
	if ( ! Access() )
	{
		echo "<script>window.location='block.html'</script>";
	}
	else if ( ! isset ( $_SESSION['login'] ) || $_SESSION['login'] != true )
	{
		echo "<script>window.location='login.php'</script>";
	}
	else if ( isset ( $_SESSION['plogin'] ) && $_SESSION['plogin'] == true )
	{
		echo "<script>window.location='refresh.php'</script>";
	}
	else if ( isPolled ( ) )
	{
		echo "<script>window.location='poll.php'</script>";
	}
	else
	{
		require_once('../EntekhabVahed.php');
		$error = "" ;
		if ( isset($_POST['username']) )
		{
			if ( signin ( $_SESSION['session'] , $_POST['username'] , $_POST['passwd'] , $_POST['captcha'] ) )
			{
				$_SESSION['username'] = $_POST['username'];
				$_SESSION['ppasswd'] = $_POST['passwd'];
				$_SESSION['captcha'] = $_POST['captcha'];
				echo "<script>window.location='refresh.php'</script>";
			}
			else
			{
				$error = "اطلاعات وارد شده نامعتبر است!" ;
				$arr = getSession();
				$_SESSION['session'] = $arr[0];
				$_SESSION['captcha'] = $arr[1];
			}
		}
		else
		{
			$arr = getSession();
			$_SESSION['session'] = $arr[0];
			$_SESSION['captcha'] = $arr[1];
		}
?>
<!DOCTYPE html>
<html style='background-color: #eeeeee;'>
	<head>
		<title>AutBook</title>
		<link href="css/bootstrap.css" rel="stylesheet">
		<link href="css/signin.css" rel="stylesheet">
		<script src="js/jquery.js"></script>
		<script src="js/bootstrap.js"></script>
		<script src="js/docs.js"></script>
		<meta http-equiv="content-type" content="text/html; charset=UTF-8">
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="description" content="">
		<meta name="author" content="">
	</head>
	<body style='background-color: #eeeeee;' dir=rtl>
		<div class="container">
			<form method='post' class="form-signin" role="form">
				<h2 class="form-signin-heading" style='color: #990000;'>دسترسی به پرتال</h2>
<?php
	if ( strlen ($error) > 0 )
	{
		echo '<a class="error">'.$error.'</a>';
	}
?>
				<input type="text" class="form-control" placeholder="شماره دانشجویی" name=username required autofocus />
				<br>
				<input type="password" class="form-control" placeholder="رمز پرتال" name=passwd required>
				<center>
					<img src="../showimage.php" id=captcha_pic alt="portal is unavailable" style='color: black' />
				</center>
				<br>
				<input type="text" class="form-control" placeholder="حروف تصویر" name=captcha required>
				<br>
				<center>
					<a href='terms.html'style='color: #990000;' >قوانین استفاده از سایت</a>
				</center>
				<br>
				<button class="btn btn-lg btn-primary btn-block" style='background-color: #990000; color: #eeeeee' type="submit">قوانین استفاده از سایت را می پذیرم</button>
			</form>
		</div>
	</body>
</html>
<?php } ?>