<?php
	require_once('../config.php');
	if ( ! Access() )
	{
		echo "<script>window.location='block.html'</script>";
	}
	else if ( isset ( $_SESSION['login'] ) && $_SESSION['login'] == true )
	{
		echo "<script>window.location='index.php'</script>";
	}
	else
	{
		$error = "" ;
		if ( isset($_POST['username']) )
		{
			if ( $row = isLoggedIn ( $_POST['username'] ) )
			{
				if ( $row['pass'] == $_POST['passwd'] )
				{
					$_SESSION['username'] = $_POST['username'];
					$_SESSION['passwd'] = $_POST['passwd'];
					$_SESSION['captcha'] = "";
					$_SESSION['login']=true;
					echo "<script>window.location='index.php'</script>";
				}
				else
				{
					$arr = getSession();
					$_SESSION['session'] = $arr[0];
					$_SESSION['captcha'] = $arr[1];
					$error = "رمز عبور وارد شده اشتباه است!" ;
				}
			}
			else if ( signin ( $_SESSION['session'] , $_POST['username'] , $_POST['passwd'] , $_POST['captcha'] ) )
			{
				$_SESSION['username'] = $_POST['username'];
				$_SESSION['passwd'] = $_POST['passwd'];
				$_SESSION['ppasswd'] = $_POST['passwd'];
				$_SESSION['captcha'] = $_POST['captcha'];
				$_SESSION['login']=true;
				echo "<script>window.location='refresh.php?p=index'</script>";
			}
			else
			{
				$arr = getSession();
				$_SESSION['session'] = $arr[0];
				$_SESSION['captcha'] = $arr[1];
				$error = "اطلاعات وارد شده نامعتبر است!" ;
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
<!--		<script src="js/docs.js"></script>-->
		<meta http-equiv="content-type" content="text/html; charset=UTF-8">
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="description" content="">
		<meta name="author" content="">
	   <script type="text/javascript">
		   var can, ctx, step = 200, steps = 160 , steps2 = 50;
				  delay = 20, alpha=0.0, trans = 0,spam_y=0,spam_a=0,spam_my=0;
				  
				  
<?php
		if ( ! isset($_POST['username']) ){
		?>
			$(document).ready(function(){ init(); });
<?php
		}else{
		?>
			$(document).ready(function(){ $("#MyCanvas").fadeOut(function(){ $("#cont").slideDown(); }); });
<?php
		}
		?>
				 
			function init() {
				var winW = 630, winH = 460;
				step = 200, steps = 160;
				delay = 20, alpha=0.0;
				winW = $(window).width();
				winH = $(document).height();;
				$("#MyCanvas").width(winW);
				$("#MyCanvas").height(winH);
				spam_y = winH * 0.25;
				spam_my = winH * 0.22;
				
				can = document.getElementById("MyCanvas");
				can.width = winW  ;
				can.height = winH ;
				trans = can.height / 2;
				
				ctx = can.getContext("2d");
				ctx.fillStyle = "rgba(255, 255, 255, " + alpha + ")";
				ctx.font = "300pt Verdana";
				ctx.textAlign = "center";
				ctx.textBaseline = "middle";
				TextSmallToBig();
			}
			function TextSmallToBig() {
				step -= 3;
				alpha += 0.05;
				ctx.clearRect(0, 0, can.width, can.height);
				ctx.save();
				ctx.translate(can.width / 2, trans);
				
				ctx.font = Math.max( step + 0 , steps ) + "pt Verdana";
				ctx.fillStyle = "rgba(102, 68, 99, " + Math.min ( alpha , 1.0 ) + ")";
				ctx.fillText("A", -450, 0);

				ctx.font = Math.max( step + 15 , steps ) + "pt Verdana";
				ctx.fillStyle = "rgba(102, 68, 99, " + Math.min ( alpha - 0.2 , 1.0 ) + ")";
				ctx.fillText("U", -300, 0);

				ctx.font = Math.max( step + 30 , steps ) + "pt Verdana";
				ctx.fillStyle = "rgba(102, 68, 99, " + Math.min ( alpha - 0.4 , 1.0 ) + ")";
				ctx.fillText("T", -150, 0);

				ctx.font = Math.max( step + 45 , steps ) + "pt Verdana";
				ctx.fillStyle = "rgba(102, 68, 99, " + Math.min ( alpha - 0.6 , 1.0 ) + ")";
				ctx.fillText("B", 0, 0);

				ctx.font = Math.max( step + 60 , steps ) + "pt Verdana";
				ctx.fillStyle = "rgba(102, 68, 99, " + Math.min ( alpha - 0.8 , 1.0 ) + ")";
				ctx.fillText("O", 150, 0);

				ctx.font = Math.max( step + 75 , steps ) + "pt Verdana";
				ctx.fillStyle = "rgba(102, 68, 99, " + Math.min ( alpha - 1.0 , 1.0 ) + ")";
				ctx.fillText("O", 300, 0);

				ctx.font = Math.max( step + 90 , steps ) + "pt Verdana";
				ctx.fillStyle = "rgba(102, 68, 99, " + Math.min ( alpha - 1.2 , 1.0 ) + ")";
				ctx.fillText("K", 450, 0);
				
				if ( !( step + 90 > steps || alpha < 2.2 ) )
				{
					ctx.font = "50pt Verdana";
					ctx.fillStyle = "rgba(102, 68, 99, " + Math.min ( spam_a , 1.0 ) + ")";
					ctx.fillText("S.P. Group", 0, spam_y);
					
					spam_a += 0.1;
					spam_y -= 1;
				}
				ctx.restore();
				
				if ( step + 90 > steps || alpha < 2.2 || spam_y > spam_my )
					var t = setTimeout('TextSmallToBig()', 20);
				else
				{
					var t = setTimeout(function(){
						$("#MyCanvas").fadeOut(function(){
							$("#cont").slideDown();
						});
					},1000);
				}
			}
			$(function() {
				$("#why").attr('title', 
				"این سایت فقط و فقط برای دانشجویان امیرکبیر طراحی شده است.<br>" + 
				"برای ورود به سایت شماره دانشجویی و پسورد شما از طریق پرتال دانشگاه بررسی میشود و در صورت صحت آنها به سایت هدایت میشوید.<br>" + 
				"همچنین بعضی امکانات سایت نیازمند اطلاعاتی از شما هستند که در مواقع مورد نیاز از پرتال شما دریافت می گردد.<br>" + 
				"در صورت لزوم میتوانید پس از ورود به سایت رمز عبور خود را عوض کنید.<br>" + 
				"سایت ما به هیج طریقی رمز عبور پرتال شما را ذخیره نمیکند.<br>" 
				);
				$("#why[title]").tooltips();

			});

		</script>
		<link rel='stylesheet' href='css/style.css'>
		<link rel='stylesheet' href='css/tooltips.css'>
		<script src="js/tooltips.js"></script>
	</head>
	<body style='background-color: #eeeeee;' dir=rtl>
		<div id='cont' class="container" style='display: none'>
			<form method='post' class="form-signin" role="form">
				<h2 class="form-signin-heading" style='color: #664463;'>ورود به <a style='color: #dd0000;'>سایت</a></h2>
<?php
	if ( strlen ($error) > 0 )
	{
		echo '<a class="error">'.$error.'</a>';
	}
?>
				<input type="text" class="form-control" placeholder="شماره دانشجویی" name=username required autofocus />
				<br>
				<input type="password" class="form-control" placeholder="رمز پرتال یا رمز عبور" name=passwd required>
				<a id=why href='terms.html'style='color: #664463;font-family: Homa; font-size: 10pt;' title=''>چرا پسورد پرتال؟</a><br><br>
				<center>
					<img src="../showimage.php" id=captcha_pic alt="portal is unavailable" style='color: black' />
				</center>
				<br>
				<input type="text" class="form-control" placeholder="حروف تصویر" name=captcha required>
				<br>
				<center>
					<a href='terms.html'style='color: #664463;' >قوانین استفاده از سایت</a>
				</center>
				<br>
				<button class="btn btn-lg btn-primary btn-block" style='background-color: #664463; color: #eeeeee' type="submit">قوانین استفاده از سایت را می پذیرم</button>
			</form>
		</div>
		<center>
			<canvas id="MyCanvas" style='position: fixed; top: 0; left: 0; width: 100%; height: 100%;background: #eeeeee'>This browser or document mode doesn't support canvas object</canvas>
		</center>
	</body>
</html>
<?php } ?>