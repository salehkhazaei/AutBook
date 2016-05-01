<?php
	require_once('../config.php');
	require_once('../boy_girl.php');
	require_once('../profilepic.php');
	if ( ! Access() )
	{
		echo "<script>window.location='block.html'</script>";
	}
	else if ( isPolled ( ) )
	{
		echo "<script>window.location='poll.php'</script>";
	}
	else if ( ! isset ( $_SESSION['login'] ) || $_SESSION['login'] != true )
	{
		echo "<script>window.location='login.php'</script>";
	}
	else 
	{
?>
<!DOCTYPE html>
<html style='background-color: #dddddd;' lang="fa">
	<head>
		<title>AutBook</title>
		<script src="js/jquery.js"></script>
		<meta charset="utf-8">
		<link rel="stylesheet" href="css/fontello.css">
		<link rel="stylesheet" href="css/animation.css"><!--[if IE 7]><link rel="stylesheet" href="css/fontello-ie7.css"><![endif]-->
		<style>
			@font-face 
			{ 
				font-family: "Homa"; 
				src: url('homa.ttf') format("truetype"); 
			} 
			html{
				font-family: Homa;
			}
			#profile_label {
				font-size: 100px;
			}
			table{
				float: center;
				clear: center;
			}
			.card {
				background: #f5f5f5;
				color: #aa8000;
				font-size: 25px;
				text-align: center;
				padding-top: 5px;
				padding-left: 5px;
				padding-right: 5px;
				padding-bottom: 5px;
				margin-bottom: 0px;
			}
			.card:hover {
				background: #ffffff;
				color: #edb200;
			}
			.card td{
				min-width: 200px;
			}
			#static_header	{
				font-size: 40pt;
				margin-bottom: 50px;
			}
			#dynamic_header	{
				position: fixed;
				top: 0 ;
				left: 0 ;
				width: 100%;
				height: auto;
				background: #edb200;
				text-align: center;
				font-size: 40pt;
			}
			#back {
				float: right;
				clear: right;
				background: #edb200;
				color: #eeeeee;
				font-size: 20pt;
				text-decoration: none;
				padding: 15pt;
			}
			#back:hover {
				background: #fac525;
			}
			.generation_label {
				margin-left: 110pt;
				float: center;
			}
		</style>
	</head>
	<body style='background-color: #dddddd;' dir=rtl>
		<div id=static_header><a class='generation_label' style='color: #664463;'>شجره نامه</a></div>
		<div id=dynamic_header><a class='generation_label' style='color: #eeeeee;'>شجره نامه</a><a id=back href='index.php'>بازگشت</a></div>
		<div class="container">
			<table width=100% cellspacing=0px cellpadding=5px>
<?php
				$rows = Select ( "*" , $GLOBALS['tbl_generation'] , "id LIKE '__".substr($_SESSION['username'],2)."'" , NULL);
				while ( $row = $rows->fetch ())
				{
					$sex = getSex ( $row['name'] );
					$haspic = false ;
					$picobj = 'icons/User-yellow-icon.png';
					$rrows = Select ( "*" , $GLOBALS['tbl_student'] , "id=?" , array($row['id']));
					if ( $rrow = $rrows->fetch() )
					{
						$picobj = "<img style='background: #eeeeee; height: 200px; margin-bottom: 0px; width: auto' src='".profilepic($rrow['id'])."' alt='عکس کاربر' />";;
						$haspic = true; 
					}
					else
					{
						if ( $sex == 'girl' )
						{
							$picobj = "<i class=\"icon-user-woman\" style='background: #eeeeee; font-size: 100pt; height: 200px; margin-bottom: 0px; width: auto'></i>";
						}
						else
						{
							$picobj = "<i class=\"icon-user\" style='background: #eeeeee; font-size: 100pt; height: 200px; margin-bottom: 0px; width: auto'></i>";
						}
					}
					echo "<tr><td>
							<center>
								<table class='card' border=0 cellspacing=0; cellpadding=0>
									<tr><td rowspan=2 style='text-align: right;' valign=center>".$picobj."</td>
									<td>".$row['name']." ".$row['family']."</td></tr>
									<tr><td>".$row['id']."</td></tr>
								</table>
							</center>
						</td></tr>";
				}
?>
			</table>
			</center>
		</div>
	</body>
</html>
<?php } ?>