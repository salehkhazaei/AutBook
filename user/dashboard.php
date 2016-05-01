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
	else if ( ! isset ( $_SESSION['plogin'] ) || $_SESSION['plogin'] != true )
	{
		echo "<script>window.location='portal.php'</script>";
	}
	else
	{
		require_once('../EntekhabVahed.php');
?>
<!DOCTYPE html>
<html lang="en" dir=rtl>
	<head>
		<meta http-equiv="content-type" content="text/html; charset=UTF-8">
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="description" content="">
		<meta name="author" content="">
		<title>AutBook</title>
		<link href="css/dashboard.css" rel="stylesheet">
		<link rel="stylesheet" href="css/fontello.css">
		<link rel="stylesheet" href="css/animation.css"><!--[if IE 7]><link rel="stylesheet" href="css/fontello-ie7.css"><![endif]-->
	</head>

	<body>
		<div id=top>
			<i id=menu_button class="icon-list-2 right" style='color: #838383; font-size: 35pt;'></i>
			<div id=logo class='center'>
				AutBook
			</div>
		</div>
		<div id=side1>
		</div>
		<div id=side2>
		</div>
		<div id=bottom>
			<table id=btmtable>
				<tr>
					<td class='btmth'>نام درس</td>
					<td class='btmth'>کد درس</td>
					<td class='btmth'>گروه</td>
					<td class='btmth'>واحد</td>
					<td class='btmth'>استاد</td>
					<td class='btmth'>زمان 1</td>
					<td class='btmth'>زمان 2</td>
					<td class='btmth'>زمان 3</td>
					<td class='btmth'>تاریخ امتحان</td>
					<td class='btmth'>TA</td>
					<td class='btmth'>زمان TA</td>
					<td class='btmth'>گروه TA</td>
				</tr>
			</table>
		</div>
		<div id=examdiv>
		<table id=examtable>
			<tr id='examtblth'><td>تاریخ امتحانات</td></tr>
		</table>
		</div>
		<div id=timediv>
		<table id=timetable cellspacing=0px cellpadding=0px>
			<tr id=timetableth>
				<td class='tdr' >روز ها</td>
				<td class='tdt' >7</td>
				<td class='tdt' ></td>
				<td class='tdt' ></td>
				<td class='tdt' ></td>
				<td class='tdt' >8</td>
				<td class='tdt' ></td>
				<td class='tdt' ></td>
				<td class='tdt' ></td>
				<td class='tdt' >9</td>
				<td class='tdt' ></td>
				<td class='tdt' ></td>
				<td class='tdt' ></td>
				<td class='tdt' >10</td>
				<td class='tdt' ></td>
				<td class='tdt' ></td>
				<td class='tdt' ></td>
				<td class='tdt' >11</td>
				<td class='tdt' ></td>
				<td class='tdt' ></td>
				<td class='tdt' ></td>
				<td class='tdt' >12</td>
				<td class='tdt' ></td>
				<td class='tdt' ></td>
				<td class='tdt' ></td>
				<td class='tdt' >13</td>
				<td class='tdt' ></td>
				<td class='tdt' ></td>
				<td class='tdt' ></td>
				<td class='tdt' >14</td>
				<td class='tdt' ></td>
				<td class='tdt' ></td>
				<td class='tdt' ></td>
				<td class='tdt' >15</td>
				<td class='tdt' ></td>
				<td class='tdt' ></td>
				<td class='tdt' ></td>
				<td class='tdt' >16</td>
				<td class='tdt' ></td>
				<td class='tdt' ></td>
				<td class='tdt' ></td>
				<td class='tdt' >17</td>
				<td class='tdt' ></td>
				<td class='tdt' ></td>
				<td class='tdt' ></td>
				<td class='tdt' >18</td>
				<td class='tdt' ></td>
				<td class='tdt' ></td>
				<td class='tdt' ></td>
				<td class='tdt' >19</td>
				<td class='tdt' ></td>
				<td class='tdt' ></td>
				<td class='tdt' ></td>
				<td class='tdt' >20</td>
				<td class='tdt' ></td>
				<td class='tdt' ></td>
				<td class='tdt' ></td>
				<td class='tdt' >21</td>
				<td class='tdt' ></td>
				<td class='tdt' ></td>
				<td class='tdt' ></td>
				<td class='tdt' >22</td>
			</tr>
			<tr id=day0>
				<td class='tdd' >شنبه</td>
			</tr>
			<tr id=day1>
				<td class='tdd' >یک شنبه</td>
			</tr>
			<tr id=day2>
				<td class='tdd' >دو شنبه</td>
			</tr>
			<tr id=day3>
				<td class='tdd' >سه شنبه</td>
			</tr>
			<tr id=day4>
				<td class='tdd' >چهارشنبه</td>
			</tr>
			<tr id=day5>
				<td class='tdd' >پنجشنبه</td>
			</tr>
		</table>
		</div>

		<div id=menu_back>
		</div>
		<div id=menu>
			<table width=100% height=100% border=0>
				<tr>
					<td class='noborder' valign=center >
						<center>
						<table cellspacing=20px border=0 width=70% cellpadding=10px>
							<tr><td id='btn_save' class='button noborder'>ذخیره برنامه</td></tr>
							<tr><td id='btn_load' class='button noborder'>
								بارگذاری برنامه
								<ul class='collul'>
								</ul>
							</td></tr>
							<tr><td id='btn_exit' class='button noborder'>خروج</td></tr>
							<tr><td id='btn_back' class='button noborder'>برگشت</td></tr>
						</table>
						</center>
					</td>
				</tr>
			</table>
		</div>
	
		<script src="js/jquery.js"></script>
		<script src="js/bootstrap.js"></script>
		<script>
			var data = <?php $ent = unserialize($_SESSION['eobj']); echo $ent->_course(); ?>;
			var schadules = <?php $ent = unserialize($_SESSION['eobj']); echo $ent->_load(); ?>;
			var selected_schadule = <?php
					$cur_idx = -1 ;
					if ( isset ( $_GET['s'] ) ) 
					{ 
						$cur_idx = $_GET['s'];
					} 
					echo $cur_idx; 
					$ent = unserialize($_SESSION['eobj']); 
					$ent->current_sched = $cur_idx; 
					$_SESSION['eobj'] = serialize($ent);
					?>;
			$(document).ready(function(){
				init();
			});
			$("#menu_button").hover(function(){
				$("#menu_button").css({'color': '#664463'});
			});
			$("#menu_button").mouseleave(function(){
				$("#menu_button").css({'color': '#838383'});
			});
		</script>
		<script src="js/dashboard.js"></script>
	</body>
</html>


<?php } ?>


