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
				  
			$(document).ready(function(){ init(); });
				 
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
		<div id='cont' class="container" style='display: none; font-size: 40pt;'>
<h1>AUTBOOK</h1>
<h2>به علت جلوگیری از اختلال در فرآیند انتخاب واحد این سایت تا ساعت 8 شب یکشنبه در دسترس نخواهد بود</h2>
		</div>
		<center>
			<canvas id="MyCanvas" style='position: fixed; top: 0; left: 0; width: 100%; height: 100%;background: #eeeeee'>This browser or document mode doesn't support canvas object</canvas>
		</center>
	</body>
</html>