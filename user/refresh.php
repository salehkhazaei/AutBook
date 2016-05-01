<?php
	require_once ('../config.php');
	if ( ! Access() )
	{
		echo "<script>window.location='block.html'</script>";
	}
	else if ( isPolled ( ) )
	{
		echo "<script>window.location='poll.php'</script>";
	}
	else if ( isset ( $_SESSION['login'] ) && $_SESSION['login'] == true )
	{
?>
<html>
	<head>
		<title>AutBook</title>
		<meta http-equiv="content-type" content="text/html; charset=UTF-8">
		<meta charset="utf-8">
		<script src="js/jquery.js"></script>
		<style>
			@font-face 
			{ 
				font-family: "Homa"; 
				src: url('homa.ttf') format("truetype"); 
			} 
			html{
				font-family: Homa;
			}
			#loading_back{
				background-color: black;
				opacity: 0.7;
				position: fixed;
				top: 0;
				left: 0;
				width: 100%;
				height: 100%;
			}
			#loading_msg{
				position: fixed;
				opacity: 1.0;
				top: 35%;
				left: 35%;
				width: 30%;
				height: 30%;
				background-color: white;
				color: black;
				text-align: right;
			}
		</style>
		<script>
			var done = false;
			var request_connect = $.ajax({
				url: "../connect.php",
			});
			request_connect.done(function( msg ) {
				if ( msg == "true" )
				{
					$("#connect").css('color','#00b927').text("(وصل شد)");
					var request_courses = $.ajax({
						url: '<?php if ( isset ($_GET['p']) && $_GET['p'] == 'index' ) echo "../get_courses.php?s=1"; else echo "../get_courses.php"; ?>',
					});
					request_courses.done(function( msg ) {
						$("#courses").css('color','#00b927').text("(دریافت شد)");
						if ( done )
						{
							window.location = '<?php if ( isset ($_GET['p']) && $_GET['p'] == 'index' ) echo "index.php"; else echo "dashboard.php"; ?>';
						}
						done = true ;
					});
					request_courses.fail(function( jqXHR, textStatus ) {
						$("#courses").css('color','#d50000').text("(خطا)");
					});
					var request_personal = $.ajax({
						url: "../get_personal.php",
					});
					request_personal.done(function( msg ) {
						$("#personal").css('color','#00b927').text("(دریافت شد)");
						if ( done )
						{
							window.location = '<?php if ( isset ($_GET['p']) && $_GET['p'] == 'index' ) echo "index.php"; else echo "dashboard.php"; ?>';
						}
						done = true ;
					});
					request_personal.fail(function( jqXHR, textStatus ) {
						$("#personal").css('color','#d50000').text("(خطا)");
					});
				}
				else
				{
					$("#connect,#courses,#personal").css('color','#d50000').text("(خطا)");
					$("#loading_msg").append('<tr><td><a href="index.php">بازگشت</a></td><td>پرتال در دسترس نیست!</td></tr>');
				}
			});
			request_connect.fail(function( jqXHR, textStatus ) {
				$("#connect,#courses,#personal").css('color','#d50000').text("(خطا)");
				$("#loading_msg").append('<tr><td><a href="index.php">بازگشت</a></td><td>پرتال در دسترس نیست!</td></tr>');
			});
		</script>
	</head>
	<body>
		<div id=loading_back>
		</div>
		<table id=loading_msg cellpadding=10px>
			<tr>
				<td style='text-align: center' colspan=2><a style='color: #f2b000'>لطفا صبر کنید. این عملیات ممکن است زمان ببرد.</a></td>
			</tr>
			<tr>
				<td style='text-align: left'><a id=connect style='color: #f2b000'>(در حال اتصال)</a></td>
				<td style='text-align: right'><a>برقراری ارتباط با پرتال</a></td>
			</tr>
			<tr>
				<td style='text-align: left'><a id=courses style='color: #f2b000'>(در حال دریافت)</a></td>
				<td style='text-align: right'><a>دریافت اطلاعات دروس</a></td>
			</tr>
			<tr>
				<td style='text-align: left'><a id=personal style='color: #f2b000'>(در حال دریافت)</a></td>
				<td style='text-align: right'a>دریافت اطلاعات شخص</a></td>
			</tr>
		</table>
	</body>
</html>
<?php }?>