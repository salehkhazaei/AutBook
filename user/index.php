<?php
	require_once('../config.php');
	if ( ! isset ( $_SESSION['login'] ) || $_SESSION['login'] != true )
	{
		echo "<script>window.location='login.php'</script>";
	}
	else if ( isPolled ( ) )
	{
		echo "<script>window.location='poll.php'</script>";
	}
	else if ( ! Access() )
	{
		echo "<script>window.location='block.html'</script>";
	}
	else
	{
?>
<!DOCTYPE html>
<html lang="en" style='background-color: #eeeeee;'>
	<head>
		<meta http-equiv="content-type" content="text/html; charset=UTF-8">
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="description" content="">
		<meta name="author" content="">

		<link href="css/bootstrap.css" rel="stylesheet" />
		<script src="js/jquery.js"></script>
		<script src="js/bootstrap.js"></script>
		<link rel="stylesheet" href="css/fontello.css">
		<title>AutBook</title>
		<style>
			@font-face 
			{ 
				font-family: "Homa"; 
				src: url('homa.ttf') format("truetype"); 
			} 
			html, body {
				font-family: Homa;
				margin:0;
				padding:0;
				width:100%;
				height:100%;
			}
			.screen {
				margin: 0;
                position: absolute;
                width: 100% 
                height: 100%;
                left: 0;
                top: 0;
            }
			.screen .main {
                width: 100%;
                height: 100%;
            }
			div{
				text-align: center;
			}
			h1{
				color: #664463;
			}
			span{
				color: white;
			}
			#logo {
				font-family: Sans;
				font-size: 100pt;
				color: #664463;
				letter-spacing: 30px;
			}
			.closed{
				-ms-transform: rotate(-30deg); /* IE 9 */
				-webkit-transform: rotate(-30deg); /* Chrome, Safari, Opera */
				transform: rotate(-30deg);
				color: red;
				z-index: 10;
 			}
		</style>
		<script src='js/jquery.js'></script>
		<script>
			$(document).ready(function(){
				$('.tdnote,.tdsearch,.tdlogout,.tdcontact,.tdcpass').css('cursor','pointer');
				$(".tdcontact").hover(function(){
					$("#contact").hide();
					$("#contact_h").show();
					$(".exit,.gene,.sele,.mess,.prof,.cpass").css({'color': '#838383'});
					$(".cont").css({'color': '#dd0000'});
				});
				$(".tdnote").hover(function(){
					$("#note").hide();
					$("#note_h").show();
					$(".exit,.prof,.gene,.mess,.cont,.cpass").css({'color': '#838383'});
					$(".sele").css({'color': '#682c62'});
					$(".tdnotec").attr('valign','center');
				});
				$(".tdsearch").hover(function(){
					$("#search").hide();
					$("#search_h").show();
					$(".exit,.prof,.sele,.mess,.cont,.cpass").css({'color': '#838383'});
					$(".gene").css({'color': '#edb200'});
				});
				$(".tdcpass").hover(function(){
					$("#cpass").hide();
					$("#cpass_h").show();
					$(".prof,.gene,.sele,.mess,.cont,.exit").css({'color': '#838383'});
					$(".cpass").css({'color': '#c8c801'});
				});
				$(".tdlogout").hover(function(){
					$("#logout").hide();
					$("#logout_h").show();
					$(".prof,.gene,.sele,.mess,.cont,.cpass").css({'color': '#838383'});
					$(".exit").css({'color': '#500000'});
				});

				$(".tdcontact").mouseleave(function(){
					$("#contact").show();
					$("#contact_h").hide();
					$(".exit,.prof,.gene,.sele,.mess,.cont,.cpass").css({'color': '#838383'});
				});
				$(".tdnote").mouseleave(function(){
					$("#note").show();
					$("#note_h").hide();
					$(".exit,.prof,.gene,.sele,.mess,.cont,.cpass").css({'color': '#838383'});
					$(".tdnotec").attr('valign','bottom');
				});
				$(".tdsearch").mouseleave(function(){
					$("#search").show();
					$("#search_h").hide();
					$(".exit,.prof,.gene,.sele,.mess,.cont,.cpass").css({'color': '#838383'});
				});
				$(".tdcpass").mouseleave(function(){
					$("#cpass").show();
					$("#cpass_h").hide();
					$(".exit,.prof,.gene,.sele,.mess,.cont,.cpass").css({'color': '#838383'});
				});
				$(".tdlogout").mouseleave(function(){
					$("#logout").show();
					$("#logout_h").hide();
					$(".exit,.prof,.gene,.sele,.mess,.cont,.cpass").css({'color': '#838383'});
				});

				$(".tdnote").click(function(){
					window.location='dashboard.php';
				});
				$(".tdcontact").click(function(){
					window.location='contactus.php';
				});
				$(".tdsearch").click(function(){
					window.location='generation.php';
				});
				$(".tdcpass").click(function(){
					window.location='cpass.php';
				});
				$(".tdlogout").click(function(){
					window.location='../logout.php';
				});
			});
		</script>
	</head>
	<body style='background-color: #eeeeee;'>
		<div class='container'>
			<div class='row'>
				<div class='col-md-12' id=logo><center>AUTBOOK</center></div>
			</div>
			<div class='row'>
				<div class='col-md-offset-1 col-md-2 tdlogout'>
					<i id=logout class="icon-logout" style='color: #838383; font-size: 100pt;'></i>
					<i id=logout_h class="icon-logout" style='color: #500000; font-size: 100pt;display: none' ></i>

					<h1 class='exit' style='color: #838383;'>خروج</h1>
					<span class='exit' style='color: #838383;'>خروج از سایت</span>
				</div>
				<div class='col-md-2 tdcpass'>
					<i id=cpass class="icon-pencil" style='color: #838383; font-size: 100pt;'></i>
					<i id=cpass_h class="icon-pencil" style='color: #c8c801; font-size: 100pt;display: none' ></i>

					<h1 class='cpass' style='color: #838383;'>تغییر پسورد</h1>
					<span class='cpass' style='color: #838383;'>تغییر رمز ورود به سایت</span>
				</div>
				<div class='col-md-2 tdcontact'>
					<i id=contact class="icon-mail-1" style='color: #838383; font-size: 100pt;'></i>
					<i id=contact_h class="icon-mail-1" style='color: #dd0000; font-size: 100pt;display: none' ></i>

					<h1 class='cont' style='color: #838383;'>تماس با ما</h1>
					<span class='cont' style='color: #838383;'>ارتباط با ما و گزارش مشکلات</span>
				</div>
				<div class='col-md-2 tdsearch'>
					<i id=search class="icon-users" style='color: #838383; font-size: 100pt;'></i>
					<i id=search_h class="icon-users" style='color: #edb200; font-size: 100pt;display: none' ></i>

					<h1 class='gene' style='color: #838383;'>شجره نامه</h1>
					<span class='gene' style='color: #838383;'>شجره نامه دانشکده ای خود را ببینید</span>
				</div>
				<div class='col-md-2 tdnote'>
					<i id=note class="icon-edit" style='color: #838383; font-size: 100pt;'></i>
<!--					<div id=note_h class='closed' style='font-size: 30pt; display: none'>بسته شده است</div> -->
					<i id=note_h class="icon-edit" style='color: #682c62; font-size: 100pt;display: none' ></i>

					<h1 class='sele' style='color: #838383;'>انتخاب واحد مجازی</h1>
					<span class='sele' style='color: #838383;'>تداخل هارا ببینید و برای انتخاب واحد آماده باشید</span>
				</div>
			</div>
		</div>
	</body>
</html>
<?php } ?>