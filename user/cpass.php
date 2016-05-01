<?php
	require_once('../config.php');
	if ( ! Access() )
	{
		echo "<script>window.location='block.html'</script>";
	}
	else if ( isPolled ( ) )
	{
		echo "<script>window.location='poll.php'</script>";
	}
	else 
	{
		if ( ! isset ( $_SESSION['login'] ) || $_SESSION['login'] != true )
		{
			echo "<script>window.location='login.php'</script>";
		}
		else
		{
			$errorno = 0 ;
			if ( isset($_POST['oldpasswd']) )
			{
				$errorno = changePassword ( $_POST['oldpasswd'] , $_POST['newpasswd'] , $_POST['cnfpasswd'] );
			}
			?>
			
<!DOCTYPE html>
<html style='background-color: #eeeeee;'>
	<head>
		<title>AutBook</title>
		<meta http-equiv="content-type" content="text/html; charset=UTF-8">
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="description" content="">
		<meta name="author" content="">

		<link rel='stylesheet' href='css/style.css'>
		<link rel='stylesheet' href='css/tooltips.css'>
		<link href="css/bootstrap.css" rel="stylesheet">
		<link href="css/signin.css" rel="stylesheet">
		<script src="js/jquery.js"></script>
		<script src="js/bootstrap.js"></script>
		<script src="js/docs.js"></script>
		<script src="js/tooltips.js"></script>
		<style>
			*{
				font-size: 20px;
			}
			.btn,input{
				width: 100%;
			}
		</style>
	</head>
	<body style='background-color: #eeeeee;' dir=rtl>
		<div id='cont' class="container">
			<form method='post' class="form-signin" role="form">
				<h2 class="form-signin-heading" style='color: #664463;'>تغییر رمز عبور</h2>
				<br>
				<?php
					if ( $errorno != 0 )
					{
						echo "<a class='error'>";
						switch ( $errorno )
						{
							case 1:
								echo "نام کاربری شما وجود ندارد! لطفا با مسئولین سایت تماس بگیرید";
								break;
							case 2:
								echo "رمز عبور قبلی شما اشتباه است";
								break;
							case 3:
								echo "رمز عبور جدید و تایید آن یکسان نیستند";
								break;
						}
						echo "</a><br>";
					}
				?>
				<div class='row'>
					<div class='col-md-12'><input type="password" class="form-control" placeholder="رمز قبلی" name=oldpasswd autofocus required></div>
				</div>
				<div class='row'>
					<div class='col-md-12'><input type="password" class="form-control" placeholder="رمز جدید" name=newpasswd required></div>
				</div>
				<div class='row'>
					<div class='col-md-12'><input type="password" class="form-control" placeholder="تایید رمز" name=cnfpasswd required></div>
				</div>
				<div class='row'>
					<div class='col-md-12'><button class="btn btn-primary" style='background-color: #664463; margin-bottom: 10px' type="submit">تغییر رمز</button></div>
				</div>
				<div class='row'> 
					<div class='col-md-12'><button class="btn btn-danger" type="button" onclick="window.location='index.php'">بازگشت</button></div>
				</div>
			</form>
		</div>
	</body>
</html>			
<?php
		}
	}
?>
