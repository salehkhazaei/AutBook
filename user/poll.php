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
	else if ( ! isPolled ( ) )
	{
		echo "<script>window.location='index.php'</script>";
	}
	else if ( isset ( $_POST['q6'] ) )
	{
		Create ( $GLOBALS['tbl_poll'] , "(id,q1,q2,q3,q4,q5,q6)" , "(?,?,?,?,?,?,?)" , array ( $_SESSION['username'] , 
																							isset ( $_POST [ 'q1' ] ) ? $_POST [ 'q1'] : '0' ,
																							isset ( $_POST [ 'q2' ] ) ? $_POST [ 'q2'] : '0' ,
																							isset ( $_POST [ 'q3' ] ) ? $_POST [ 'q3'] : '0' , 
																							isset ( $_POST [ 'q4' ] ) ? $_POST [ 'q4'] : '0' , 
																							isset ( $_POST [ 'q5' ] ) ? $_POST [ 'q5'] : '0' ,
																							$_POST [ 'q6' ]
																							) );
		echo "<script>window.location='index.php';</script>";
	}
	else
	{
?>
<html>
	<head>
		<title>AutBook</title>
		<meta http-equiv="content-type" content="text/html; charset=UTF-8">
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="description" content="">
		<meta name="author" content="">

		<link href="css/bootstrap.css" rel="stylesheet" />
		<script src="js/jquery.js"></script>
		<script src="js/bootstrap.js"></script>
		<style>
			@font-face 
			{ 
				font-family: "Homa"; 
				src: url('homa.ttf') format("truetype"); 
			} 
			* {
				font-family: Homa;
			}
			#back {
				padding: 5px;
				background: #aa0000;
				color: #eeeeee;
				text-decoration: none;
				font-size: 20pt;
			}
			html,body{
				background-color: #eeeeee;
			}
			.text-color {
				color: #664463;
			}
			input{
				color: #ffff00;
			}
		</style>
	</head>
	<body>
		<div class='container'>
			<form method=post>
			<br>
			<br>
			<br>
			<div class='row'>
				<div class='col-md-offset-4 col-md-4 text-color' >
					<center><h1><b>نظر سنجی</b></h1></center>
				</div>
			</div>
			<br>
			<div class='row'>
				<div class='col-md-12 text-color'>
					<center><h2><b>دانشجوی عزیز و گرامی</b></h2></center>
					<br>
					<center><h3>این ترم, دومین ترمی است که این سایت در حال فعالیت است</h3></center>
					<center><h3>ما در نظر داریم قسمت های بیشتری را به این سایت اضافه کنیم و امکانات بیشتری را در اختیار شما دانشجویان عزیز بگذاریم به همین دلیل از شما دانشجوی عزیز میخواهیم که نظر خود را در مورد این سایت با پر کردن فرم زیر اعلام بفرمایید</h3></center>
				</div>
			</div>
			<br>
			<br>
			<div class='row'>
				<div class='col-md-12'>
					<center><h3>این سایت تا چه حد در فرآیند انتخاب واحد شما تاثیرگذار بود است؟</h3></center>
				</div>
			</div>
			<div class='row'>
				<div class='col-md-3'>
					<input type='radio' name='q1' value='r1'>هیچ تاثیری نداشت</input>
				</div>
				<div class='col-md-3'>
					<input type='radio' name='q1' value='r2'>کمی تاثیر داشت</input>
				</div>
				<div class='col-md-3'>
					<input type='radio' name='q1' value='r3'>باعث شد متوجه برخی تداخل ها بشوم</input>
				</div>
				<div class='col-md-3'>
					<input type='radio' name='q1' value='r4'>تاثیر زیادی داشت</input>
				</div>
			</div>
			<br>
			<br>
			<div class='row'>
				<div class='col-md-12'>
					<center><h3>ایا از محیط کاربری این سایت رضایت داشته اید؟</h3></center>
				</div>
			</div>
			<div class='row'>
				<div class='col-md-3'>
					<input type='radio' name='q2' value='r1'>خیلی داغونه</input>
				</div>
				<div class='col-md-3'>
					<input type='radio' name='q2' value='r2'>اصلا قشنگ نیست</input>
				</div>
				<div class='col-md-3'>
					<input type='radio' name='q2' value='r3'>زیبا است اما مشکلات زیادی دارد</input>
				</div>
				<div class='col-md-3'>
					<input type='radio' name='q2' value='r4'>خیلی زیبا و عالی است</input>
				</div>
			</div>
			<br>
			<br>
			<div class='row'>
				<div class='col-md-12'>
					<center><h3>به نظر شما این سایت باید فعالیت خود را ادامه بدهد؟</h3></center>
				</div>
			</div>
			<div class='row'>
				<div class='col-md-3'>
					<input type='radio' name='q3' value='r1'>سایت باید فعالیت خود را متوقف کند</input>
				</div>
				<div class='col-md-3'>
					<input type='radio' name='q3' value='r2'>زمینه فعالیت فعلی سایت اصلا خوب نیست اما در زمینه های دیگر می تواند موفق باشد</input>
				</div>
				<div class='col-md-3'>
					<input type='radio' name='q3' value='r3'>سایت خوبی است ولی در زمینه های دیگر هم باید فعالیت داشته باشد</input>
				</div>
				<div class='col-md-3'>
					<input type='radio' name='q3' value='r4'>بله سایت خوبی برای کمک به دانشجویان است</input>
				</div>
			</div>
			<br>
			<br>
			<div class='row'>
				<div class='col-md-12'>
					<center><h3>مشکل بسیاری از دانشجویان با این سایت اعتماد به سایت در زمینه رمز عبور پرتال بوده است, شما تا چه حد با این موضوع مشکل داشتید؟</h3></center>
				</div>
			</div>
			<div class='row'>
				<div class='col-md-4'>
					<input type='radio' name='q4' value='r1'>روش اشتباهی است و باید از روش های دیگر استفاده شود</input>
				</div>
				<div class='col-md-4'>
					<input type='radio' name='q4' value='r2'>بهتر است از روش های دیگر استفاده شود</input>
				</div>
				<div class='col-md-4'>
					<input type='radio' name='q4' value='r3'>مشکلی نداشتم</input>
				</div>
			</div>
			<br>
			<br>
			<div class='row'>
				<div class='col-md-12'>
					<center><h3>ما در نظر داریم سیستمی هوشمند راه اندازی کنیم تا با توجه به واحد های شما و چارت درسی رشته شما , برای انتخاب واحد به شما پیشنهاداتی بدهد</h3></center>
					<center><h3>اگر برای ترم آینده چنین سیستمی را در سایت قرار بدهیم آیا شما از ان استفاده می کنید؟</h3></center>
				</div>
			</div>
			<div class='row'>
				<div class='col-md-4'>
					<input type='radio' name='q5' value='r1'>به هیچ وجه از آن استفاده نمیکنم</input>
				</div>
				<div class='col-md-4'>
					<input type='radio' name='q5' value='r2'>اگر چنین سیستمی باشد شاید از ان استفاده کنم</input>
				</div>
				<div class='col-md-4'>
					<input type='radio' name='q5' value='r3'>سیستم خوبی است,حتما از آن استفاده خواهم کرد</input>
				</div>
			</div>
			<br>
			<br>
			<div class='row'>
				<div class='col-md-12'>
					<center><h3>چنانچه پیشنهادی برای بهبود سایت ما دارید خوشحال میشویم ان را با ما در میان بگذارید</h3></center>
				</div>
			</div>
			<div class='row'>
				<div class='col-md-12'>
					<textarea rows=5 style='width: 100%' name='q6' ></textarea>
				</div>
			</div>
			<div class='row'>
				<div class='col-md-12'>
					<center><h3>با تشکر از همکاری شما</h3></center>
				</div>
			</div>
			<br>
			<div class='row'>
				<div class='col-md-offset-4 col-md-4'><center><input class="btn btn-primary" type='submit' value='ثبت و بازگشت به سایت' /></center></div>
			</div>
			<br>
			<br>
			</form>
		</div>
	</body>
</html>
<?php } ?>