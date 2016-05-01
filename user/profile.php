<?php
	require_once('../config.php');
	require_once('../profilepic.php'); 
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
			$rows = Select ( "*" , $GLOBALS['tbl_student'] , "id=?" , array ( $_SESSION [ 'username' ] ) );
			$row = $rows->fetch();
?>
<!DOCTYPE html>
<html style='background-color: #eeeeee;'>
	<head>
		<title>AutBook</title>
		<script src="js/jquery.js"></script>
		<script src="js/jquery.contenthover.min.js"></script>
		<meta charset="utf-8">
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
				float: right;
				clear: right;
			}
			tr {
				background: #f7f7f7;
				color: #074a02;
				font-size: 25px;
			}
			tr:hover {
				background: #ffffff;
				color: #074a02;
			}
			#static_header	{
				margin-bottom: 50px;
				width: 100%;
				height: auto;
				background: #0a8e00;
				text-align: center;
				font-size: 40pt;
			}
			#back {
				float: right;
				clear: right;
				background: #0a8e00;
				color: #eeeeee;
				font-size: 20pt;
				text-decoration: none;
				padding: 15pt;
			}
			.profile_label {
				float: center;
				margin-left: 110pt;
			}
			#back:hover {
				background: #2bc81f;
			}
			.contenthover 
			{ 
				text-align:center; 
				height: 100%;
			}
.contenthover, contenthover a { color:#fff; }
.contenthover a.mybutton { display:block; float:left; padding:5px 10px; background:#3c9632; color:#fff; -moz-border-radius: 4px; -webkit-border-radius: 4px; border-radius: 4px; }
.contenthover a.mybutton:hover { background:#34742d }
			#editback {
				background: #000000;
				position: fixed;
				top: 0;
				left: 0;
				width: 100%;
				height: 100%;
				display: none;
				z-order: 10000;
			}
			#edittbl {
				background: #ffffff;
				position: fixed;
				top: 35%;
				left: 35%;
				width: 30%;
				height: 30%;
				display: none;
				z-order: 100000;
			}
		</style>
	</head>
	<body style='background-color: #eeeeee;' dir=rtl>
		<div id=static_header><a class='profile_label' style='color: #eeeeee;'>پروفایل</a><a id=back href='index.php'>بازگشت</a></div>
		<div class="container">
			<table width=100% cellspacing=10px cellpadding=10px	>
				<?php
				echo "
				<tr><td width=50%>شماره دانشجویی</td><td width=50%>".$_SESSION['username']."</td>
				<td rowspan=3 style='width: auto;' valign=center><img id='mypic' style='background: #eeeeee; height: 250px; width: auto; margin-top: 15px' src='".profilepic()."' alt='عکس کاربر' />
				<div class=\"contenthover\">
					<table style='width:100% ;height:100%;'><tr><td id=edit><a>ویرایش</a></td></tr></table>
				</div>
				</td></tr>
				<tr><td width=50%>نام</td><td width=50%>".$row['name']."</td></tr>
				<tr><td>نام خانوادگی</td><td>".$row['family']."</td></tr>
				<tr><td>جنسیت</td><td colspan=2>".$row['sex']."</td></tr>
				<tr><td>موبایل</td><td colspan=2>".$row['mobileno']."</td></tr>
				<tr><td>ایمیل دانشگاه</td><td colspan=2>".$row['autemail']."</td></tr>
				<tr><td>ایمیل</td><td colspan=2>".$row['email']."</td></tr>
				<tr><td>محل تولد</td><td colspan=2>".$row['born_city']."</td></tr>
				<tr><td>محل زندگی</td><td colspan=2>".$row['city']."</td></tr>
				<tr><td>رشته</td><td colspan=2>".$row['field']."</td></tr> ";
				?>
			</table>
		</div>
		<div id=editback>
		</div>
		<form action='../upload_b64.php'>
		<table id=edittbl>
			<tr>
				<td style='text-align: center'>
					<img id=editimg src='icons/User-yellow-icon.png' width=200px/>
				</td>
			</tr>
			<tr>
				<td style='text-align: center'>
					<input style='width: 100%;font-family: Homa; font-size: 20px;' type=file id=uploadfile name=uploaded_file value='انتخاب عکس'/>
				</td>
			</tr>
			<tr>
				<td style='text-align: center'>
					<input style='width: 100%;font-family: Homa; font-size: 20px;' type=button id=upload value='آپلود'/>
				</td>
			</tr>
			<tr>
				<td style='text-align: center'>
					<input style='width: 100%;font-family: Homa; font-size: 20px;' type=button id=back value='بازگشت'/>
				</td>
			</tr>
		</table>
		</form>
	</body>
	<script>
		$(document).ready(function(){
			$('#mypic').contenthover({
				overlay_background:'#fff',
				overlay_opacity:0.8
			});
			$("#edit").click(function(){
				$("#editback").fadeTo(100,0.2);
				$("#edittbl").fadeIn();
			});
			$("#editback,#back").click(function(){
				$("#editback,#edittbl").fadeOut();
			});
			$('#upload').click(function(){
				var formData = new FormData($('form')[0]);
				var request = $.ajax({
					url: '../upload_b64.php',
					type: 'POST',
					data: formData,
					cache: false,
					contentType: false,
					processData: false
				});
				request.done(function(msg){
					switch ( msg )
					{
						case "0":
							alert ( "عکس شما با موفقیت عوض شد" ) ;
							location.reload();
							break;
						case "-1":
						case "-2":
						case "-3":
						case "-4":
						case "-5":
							alert ( msg + "فایل انتخاب شده عکس نیست" ) ;
							break;
						case "-6":
							alert ( "حداکثر حجم فایل 350 کیلوبایت است!" ) ;
							break;
						case "-7":
							alert ( "خطا در ذخیره سازی" ) ;
							break;
						default:
							alert ( "خطا" ) ;
							break;
					}
				});
			});
		});
	</script>
</html>
<?php } } ?>