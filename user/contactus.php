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
		</style>
	</head>
	<body>
		<div class='container'>
			<br>
			<br>
			<br>
			<div class='row'>
				<div class='col-md-offset-4 col-md-4'>
					<center><h1><b>تماس با ما</b></h1></center>
				</div>
			</div>
			<br>
			<br>
			<div class='row'>
				<div class='col-md-offset-4 col-md-4'>
					<div class='row'>
						<div class='col-md-12'>
							<center><img src="icons/red-mail-icon.png"/></center>
						</div>
						<div class='col-md-12'>
							<center><h2>info [at] autbook [dot] ir</h2></center>
						</div>
					</div>
				</div>
			</div>
			<br>
			<div class='row'>
				<div class='col-md-offset-4 col-md-4'><center><a id=back href='index.php'>برگشت به سایت</a></center></div>
			</div>
		</div>
	</body>
</html>
<?php } ?>