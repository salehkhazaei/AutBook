<?php
	require_once('../config.php');
	if ( ! Access() )
	{
		echo "<script>window.location='block.html'</script>";
	}
	else 
	{
		if ( ! isset ( $_SESSION['login'] ) || $_SESSION['login'] != true )
		{
			echo "<script>window.location='login.php'</script>";
		}
		else
		{
?>
<!DOCTYPE html>
<html lang="en" style='background-color: #eeeeee;'>
	<head>
		<meta http-equiv="content-type" content="text/html; charset=UTF-8">
		<meta charset="utf-8">
		<title>AutBook</title>
		<script src='js/jquery.js'></script>
		<style>
			@font-face 
			{ 
				font-family: "Homa"; 
				src: url('homa.ttf') format("truetype"); 
			} 
			html,body,input{
				font-family: Homa;
			}
			#addbox{
				position: fixed;
				top: 100px;
				left: 0px;
				width: 200px;
				height: 50px;
				background: #dddddd;
			}
			#addlist{
				position: fixed;
				top: 150px;
				left: 0px;
				width: 200px;
				height: 100%;
				background: #f9f9f9;
			}
			#chatheader{
				position: fixed;
				top: 0px;
				left: 0px;
				width: 100%;
				height: 100px;
				background: #ffffff;
			}
			#chatbox{
				position: fixed;
				top: 100px;
				left: 200px;
				width: 100%;
				height: 90%;
				background: url('icons/chat-back5.jpg');
				font-family: Arial;
			}
			#textbox{
				position: fixed;
				top: 90%;
				left: 200px;
				width: 100%;
				height: 10%;
				background: #bbbbbb;
			}	
			#txtadd {
				margin: 5px;
				margin-left: 0px;
				width: 105px;
				height: 40px;
				text-align: right;
				font-size: 20px;
			}
			#btnadd {
				margin: 5px;
				margin-right: 0px;
				width: 75px;
				height: 40px;
			}
			.chatright {
				float: right;
				background: #ccffff;
				padding: 10px;
			}
			.chatleft {
				float: left;
				background: #ffffcc;
				padding: 10px;
			}
			.right {
				float: right;
			}
			.left {
				float: left;
			}
			.center {
				float: center;
			}
			.alist {
				background: #e0e0e0;
				margin: 5px;
				height:50px;	
			}
			.profilepic {
				margin: 5px;
				height: 40px;
			}
			.profilepic_chat {
				margin-left: 5px;
				margin-right: 5px;
				height: 40px;
			}
			.profilepic_big {
				margin: 5px;
				height: 60px;
			}
			#btnchat { 	
				width: 50px;
				height: 30px;
			}
			#txtchat { 
				height: 30px;
				text-align: right;
			}
			#header_exit {
				background: #aa0000;
				color: #ffffff;
				padding: 10px;
				cursor: pointer;
			}
			input{
				-moz-border-radius: 10px;
				-webkit-border-radius: 10px;
				border-radius: 10px;
				outline:none;
				border: none;
			}
		</style>
		<script>
			function resize(){
				$("#addlist").height ( $(window).height() - $("#addbox").height() );
				$("#chatbox").height ( $(window).height() - 50 - 100 ).width( $(window).width() - 200 );
				$("#textbox").css({ top: $(window).height() - 50 }).height ( 50 ).width( $(window).width() - 200 );
				$("#btnchat").width( 50 ).height (30);
				$("#txtchat").width( $("#textbox").width() - 100 ).height (30);
			}
			$(document).ready(resize);
			$(window).resize(resize);
		</script>
	</head>
	<body style='background-color: #eeeeee;'>
		<div id=addbox>
			<input id=txtadd class='right' type=text placeholder='مخاطب جدید' />
			<input id=btnadd class='left' type=button value='اضافه کردن'/>
		</div>
		<div id=addlist>
			<div id='9131089' class=alist>
				<img src='icons/failed.png' class='left profilepic' />
				<a>9131089</a>
			</div>
			<div id='9131089' class=alist>
				<img src='icons/failed.png' class='left profilepic' />
				<a>9131089</a>
			</div>
			<div id='9131089' class=alist>
				<img src='icons/failed.png' class='left profilepic' />
				<a>9131089</a>
			</div>
			<div id='9131089' class=alist>
				<img src='icons/failed.png' class='left profilepic' />
				<a>9131089</a>
			</div>
		</div>
		<div id=chatheader>
			<div style='margin: 20px; font-size: 20px'>
				<span id=header_exit class='left'>خروج</span>
				<img id=header_pic src='icons/failed.png' class='profilepic_big right' />
				<span id=header_name class='right'>9131089 - صالح خزاعی</span><br>
				<span id=header_online class='right'>آنلاین</span>
			</div>
		</div>
		<div id=chatbox>
			<div style='margin: 20px 200px 20px 200px; font-size: 15px'>
				<div class='chat right'>
					<img src='icons/failed.png' class='profilepic_chat' />
					<span class='chatleft'>سلام</span>
				</div>
				<div style='height: 100px'></div>
				<div class='chat left'>
					<img src='icons/failed.png' class='profilepic_chat' />
					<span class='chatright'>سلام</span>
				</div>
			</div>
		</div>
		<div id=textbox>
			<div style='margin: 10px'>
				<input id=btnchat class='left' type=button value='ارسال'/>
				<input id=txtchat class='right' type=text placeholder='پیغام وارد کنید' />
			</div>
		</div>
		<table style='position: fixed; top:0;left:0;width:100%;height:100%;opacity:0.7;background:black'>
			<tr>
				<td style='color: white; text-align:center; font-size: 100pt'>به زودی</td>
			</tr>
		</table>
	</body>
</html>
<?php		

		}
	}
?>
