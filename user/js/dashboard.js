function init(){
	var select_got = null;
	var selecteds = [];
	var sel_idx = 0 ;
	var sel_red = -1 ;
	var red_timer = setInterval ( function(){ $(".overlap").removeClass('overlap'); sel_red = -1; } ,1000);
	
	var categories = {};
	var cat_idx = 0 ;
	var i ;
	var strSide1 = "<table cellspacing=5px border=0 width=100% cellpadding=5px>";
	for ( i in data )
	{
		var exist = false ;
		var j = 0 ;
		for ( j = 0 ; j < cat_idx ; j ++ )
		{
			if ( data[i].category == categories[j] )
			{
				exist = true ;
				break ;
			}
		}
		if ( ! exist )
		{
			categories[cat_idx] = data[i].category;
			cat_idx ++ ;
			strSide1 = strSide1 + ( '<tr><td id="catid' + i +'" class="category" href="#">' + data[i].category + '</td></tr>' );
		}
		if ( data[i].category == "اخذ شده" && selected_schadule < 0 )
		{
			if ( select_got == null )
			{
				select_got = confirm ( "آیا مایلید واحد های اخذ شده به جدول اضافه شود؟" );
			}
			
			if ( select_got == true )
			{
				selecteds[sel_idx] = i;
				sel_idx ++ ;
			}
		}
	}
	strSide1 = strSide1 + '</table>';
	$("#side1").html(strSide1);
	$(".category").click(function(){
		var strSide2 = "<table cellspacing=5px border=0 width=100% cellpadding=5px>";
		$("#btmtable").html("<td class='btmth'>نام درس</td><td class='btmth'>کد درس</td><td class='btmth'>گروه</td><td class='btmth'>واحد</td><td class='btmth'>استاد</td><td class='btmth'>زمان 1</td><td class='btmth'>زمان 2</td><td class='btmth'>زمان 3</td><td class='btmth'>تاریخ امتحان</td><td class='btmth'>TA</td><td class='btmth'>زمان TA</td><td class='btmth'>گروه TA</td>");//Pegah
		var cs = 0 ;
		cs = this.id.substr(5);
		var lessons = {};
		var les_idx = 0 ;
		var i = 0 ;
		for ( i in data )
		{
			if ( data[i].category == data[cs].category )
			{
				var exist = false ;
				var j = 0 ;
				for ( j = 0 ; j < les_idx ; j ++ )
				{
					if ( data[i].name == lessons[j] )
					{
						exist = true ;
						break ;
					}
				}
				if ( ! exist )
				{
					lessons[les_idx] = data[i].name;
					les_idx ++ ;
					strSide2 = strSide2 + ( '<tr><td id="lesid' + i +'Q' + cs + '" class="lessons" href="#">' + data[i].name + '</td></tr>' );
				}
			}
		}
		strSide2 = strSide2 + ("</table>");
		$("#side2").html(strSide2);
		$(".lessons").click(function(){
			var ls = 0 ;
			var lcs = 0 ;
			ls = this.id.split("Q")[0].substr(5);
			lcs = this.id.split("Q")[1] ;
			$("#btmtable").html("<td class='btmth'>نام درس</td><td class='btmth'>کد درس</td><td class='btmth'>گروه</td><td class='btmth'>واحد</td><td class='btmth'>استاد</td><td class='btmth'>زمان 1</td><td class='btmth'>زمان 2</td><td class='btmth'>زمان 3</td><td class='btmth'>تاریخ امتحان</td><td class='btmth'>TA</td><td class='btmth'>زمان TA</td><td class='btmth'>گروه TA</td>");//Pegah
			var i = 0 ;
			for ( i in data )
			{
				if ( data[i].category == data[lcs].category && data[i].name == data[ls].name )
				{
					var ddd = '<tr id="cls' + i + '" class="classes">' + 
											'<td>' + data[i].name + '</td>' + 
											'<td>' + data[i].code + '</td>' + 
											'<td>' + data[i].groups + '</td>' + 
											'<td>' + data[i].unit + '</td>' + 
											'<td>' + data[i].teacher + '</td>' + 
											'<td>' + data[i].wday1 + ' ' + data[i].start_time1 + '-' + data[i].end_time1 + '</td>';
											
					if ( data[i].wday2 != null && data[i].wday2 != false )
						ddd += '<td>' + data[i].wday2 + ' ' + data[i].start_time2 + '-' + data[i].end_time2 + '</td>';
					else
						ddd += '<td></td>';
						
					if ( data[i].wday3 != null && data[i].wday3 != false )
						ddd += '<td>' + data[i].wday3 + ' ' + data[i].start_time3 + '-' + data[i].end_time3 + '</td>' ;
					else
						ddd += '<td></td>';
						
					if ( data[i].exam_date != null && data[i].exam_date != false  )
						ddd += '<td>' + data[i].exam_date.year + '/' + data[i].exam_date.month + '/' + data[i].exam_date.day + ' ' + data[i].exam_time_start + '-' + data[i].exam_time_end + '</td>' ;
					else
						ddd += '<td></td>';
						
					if ( data[i].TA != null && data[i].TA != false )
						ddd += '<td>' + data[i].TA+ '</td>';
					else
						ddd += '<td></td>';
						
					if ( data[i].wday_ta != null && data[i].wday_ta != false )
						ddd += '<td>' + data[i].wday_ta + ' ' + data[i].start_time_ta + '-' + data[i].end_time_ta + '</td>';
					else
						ddd += '<td></td>';
					
					ddd += '<td>' + data[i].ta_groh + '</td>' + '</tr>' ;
					$("#btmtable").append ( ddd );
				}
			}
			$(".classes").click(function(){
				var as = 0 ;
				as = this.id.substr(3);
				var exists = false ;
				var j = 0 ; 
				for ( j = 0 ; j < sel_idx ; j ++ )
				{
					if ( as == selecteds[j] )
					{
						exists = true ;
						break ;
					}
					if ( doesOverLap( data[selecteds[j]] , data[as] ) )
					{
						sel_red = selecteds[j];
						clearInterval(red_timer);
						red_timer = setInterval ( function(){ $(".overlap").removeClass('overlap'); sel_red = -1; } ,1000);
						
						drawTimeTable();
						return false;
					}
				}
				if ( ! exists )
				{
					selecteds[sel_idx] = as;
					sel_idx ++ ;
				}
				drawTimeTable();
			});
		})
	});
	for ( i in schadules )
	{
		$(".collul").append("<li id=load" + schadules[i].id + " class='loadbtn'>" + schadules[i].id + "</li>");
	}
	$(".loadbtn").click(function(){
		var qs = 0 ;
		qs = this.id.substr(4);
		window.location='dashboard.php?s='+qs;
	});
	if ( selected_schadule >= 0 )
	{
		var courses = schadules[selected_schadule-1].course_ids.split(";");
		selecteds = [];
		sel_idx = 0 ;
		for ( i in courses )
		{
			for ( j in data )
			{
				if ( courses[i].split(":")[0] == data[j].code && 
				     courses[i].split(":")[1] == data[j].groups && 
				     courses[i].split(":")[2] == data[j].ta_groh)
				{
					selecteds [ sel_idx ] = j ;
					sel_idx ++ ;
				}
			}
		}
	}

	$("#menu_button").click(function(){
		$("#menu_back").fadeIn();
		$("#menu").fadeIn();
		$("#menu_back,#btn_back").click(function(){
			$("#menu").fadeOut();
			$("#menu_back").fadeOut();
		});
		$("#btn_load").click(function(){
			$(".collul").slideToggle();
		});
		$("#btn_save").click(function(){
			var sel_str = "" ;
			var op = 0;
			for ( ; op < sel_idx ; op ++ )
			{
				sel_str += "" + data[selecteds[op]].id;
				if ( op != sel_idx - 1 )
					sel_str += ";";
			}
			sel_str = "courses=" + encodeURI(sel_str);
			var request = $.ajax({
				url: "save.php",
				data: sel_str,
			});
			request.done(function( msg ) {
				$("#menu").fadeOut();
				$("#menu_back").fadeOut();
			});
		});
		$("#btn_exit").click(function(){
			window.location='index.php';
		});
	});
	$( window ).resize(function() {
		resizing();
	});	
	resizing();

	function doesOverLap(c1, c2){
		var times = [ [ c1.wday1 , c1.start_time1 , c1.end_time1 ] , 
					  [ c1.wday2 , c1.start_time2 , c1.end_time2 ] , 
					  [ c1.wday3 , c1.start_time3 , c1.end_time3 ] , 
					  [ c1.wday_ta , c1.start_time_ta , c1.end_time_ta ] , 
					  [ c2.wday1 , c2.start_time1 , c2.end_time1 ] , 
					  [ c2.wday2 , c2.start_time2 , c2.end_time2 ] , 
					  [ c2.wday3 , c2.start_time3 , c2.end_time3 ] , 
					  [ c2.wday_ta , c2.start_time_ta , c2.end_time_ta ] ]
		var i = 0 ;
		var j = 0 ;
	    for ( i = 0 ; i < 8 ; i ++ )
		{
			for ( j = 0 ; j < 8 ; j ++ )
			{
				if ( i == j )
					continue;
				if (times[i][0] == null || times[j][0] == null || times[i][0] == false || times[j][0] == false )
					continue;
				if (times[i][0] == times[j][0]) 
				{
					if ( ( times[i][1] < times[j][2] && times[i][1] >= times[j][1] ) || 
					     ( times[j][1] < times[i][2] && times[j][1] >= times[i][1] ) )
					{
						return true;
					}
				}
			}
		}
		if (c1.exam_date == null || c2.exam_date == null ||
			c1.exam_date['day'] == null || c1.exam_date['day'] == false ||
		    c2.exam_date['day'] == null || c2.exam_date['day'] == false )
			return false ;
		if ((c2.exam_date ['day'] == c1.exam_date ['day']) && (c2.exam_date ['month'] == c1.exam_date ['month']) &&
			(c2.exam_date ['year'] == c1.exam_date ['year'])) 
		{
			if ((c2.exam_time_start < c1.exam_time_end && c2.exam_time_start >= c1.exam_time_start) ||
				(c1.exam_time_start < c2.exam_time_end && c1.exam_time_start >= c2.exam_time_start)) 
			{
				return true;
			}
		}
		return false;
	}

	function TimeDetails ( i , j ) 
	{
		var mapping = {"شنبه":0,"يکشنبه":1,"یک شنبه":1,"دوشنبه":2,"دو شنبه":2,"سه شنبه":3,"چهارشنبه":4,"چهار شنبه":4,"پنج شنبه":5,"جمعه":6}
		var res = {};
		// default response
		res['state'] = 0 ;
		var q ;
		for ( q = 0 ; q < sel_idx ; q ++ )
		{
			if ( mapping[data[selecteds[q]].wday1.trim()] == i )
			{
				var ste1 = length ( data[selecteds[q]].start_time1 , data[selecteds[q]].end_time1 );
				var stt1 = length ( data[selecteds[q]].start_time1 , giveTime ( j ) );
				if ( stt1 == 0 )
				{
					// start of the class
					res['state'] = 1 ;
					res['len'] = ste1;
					res['id'] = selecteds[q];
					res['str'] = data[selecteds[q]].name + " (" + data[selecteds[q]].teacher + ")";
				}
				else if ( stt1 > 0 && stt1 < ste1 )
				{
					// middle of the class
					res['state'] = 2 ;
				}
			}
			if ( mapping[data[selecteds[q]].wday2] == i )
			{
				var ste2 = length ( data[selecteds[q]].start_time2 , data[selecteds[q]].end_time2 );
				var stt2 = length ( data[selecteds[q]].start_time2 , giveTime ( j ) );
				if ( stt2 == 0 )
				{
					// start of the class
					res['state'] = 1 ;
					res['len'] = ste2;
					res['id'] = selecteds[q];
					res['str'] = data[selecteds[q]].name + " (" + data[selecteds[q]].teacher + ")";
				}
				else if ( stt2 > 0 && stt2 < ste2 )
				{
					// middle of the class
					res['state'] = 2 ;
				}
			}
			if ( mapping[data[selecteds[q]].wday3] == i )
			{
				var ste2 = length ( data[selecteds[q]].start_time3 , data[selecteds[q]].end_time3 );
				var stt2 = length ( data[selecteds[q]].start_time3 , giveTime ( j ) );
				if ( stt2 == 0 )
				{
					// start of the class
					res['state'] = 1 ;
					res['len'] = ste2;
					res['id'] = selecteds[q];
					res['str'] = data[selecteds[q]].name + " (" + data[selecteds[q]].teacher + ")";
				}
				else if ( stt2 > 0 && stt2 < ste2 )
				{
					// middle of the class
					res['state'] = 2 ;
				}
			}
			if ( mapping[data[selecteds[q]].wday_ta] == i )
			{
				var ste2 = length ( data[selecteds[q]].start_time_ta , data[selecteds[q]].end_time_ta );
				var stt2 = length ( data[selecteds[q]].start_time_ta , giveTime ( j ) );
				if ( stt2 == 0 )
				{
					// start of the class
					res['state'] = 1 ;
					res['len'] = ste2;
					res['id'] = selecteds[q];
					res['str'] = data["تدریسیار " + selecteds[q]].name + " (" + data[selecteds[q]].teacher + ")";
				}
				else if ( stt2 > 0 && stt2 < ste2 )
				{
					// middle of the class
					res['state'] = 2 ;
				}
			}
		}
		return res ;
	}
	function giveTime ( j )
	{
		var h = 7 ;
		var m = 0 ;
		
		for ( i = 0 ; i < j ; i ++ )
		{
			m += 15 ;
			if ( m >= 60 )
			{
				h ++ ;
				m = 0 ;
			}
		}
		return ('0' + h).slice(-2)+':'+('0' + m).slice(-2) + ":00";
	}
	function length ( a , b )
	{
		var ha = a.split(":")[0];
		var hb = b.split(":")[0];//Pegah fekr konam inja nayad avaz she vali nafahmidam dari chikar mikoni, esme moteghayer ha malum nabud 
		var ma = a.split(":")[1];
		var mb = b.split(":")[1];
		var sa = (ha - 7) * 4 + (ma / 15);
		var sb = (hb - 7) * 4 + (mb / 15);
		
		return sb - sa;
	}
	function giveTNum ( a )
	{
		var ha = a.split(":")[0];
		var ma = a.split(":")[1];
		var sa = (ha - 7) * 4 + (ma / 15);
		return sa;
	}
	function drawTimeTable()
	{
		$("#examtable").html("<tr id='examtblth'><td>تاریخ امتحانات</td></tr>");
		var exams = [];
		var e,ie=0 ;
		for ( e = 0,ie = 0 ; e < sel_idx ; e ++ )
		{
			if ( data[selecteds[e]].exam_date != null )
			{
				exams[ie] = selecteds[e];
				ie ++ ;
			}
		}		
		exams.sort(function(i, j){
			var a = data[i];
			var b = data[j];
			if ( a.exam_date.year > b.exam_date.year )
				return 1 ;
			else if ( a.exam_date.year < b.exam_date.year )
				return -1 ;
				
			if ( a.exam_date.month > b.exam_date.month )
				return 1 ;
			else if ( a.exam_date.month < b.exam_date.month )
				return -1 ;
				
			if ( a.exam_date.day > b.exam_date.day )
				return 1 ;
			else if ( a.exam_date.day < b.exam_date.day )
				return -1 ;
				
			if ( giveTNum(a.exam_time_start) > giveTNum(b.exam_time_start) )
				return 1 ;
			else if ( giveTNum(a.exam_time_start) < giveTNum(b.exam_time_start) )
				return -1 ;
			return 0;
		});
		for ( e = 0 ; e < ie ; e ++ )
		{
			var d = data[exams[e]];
			if ( sel_red == exams[e] )
			{
				
				$("#examtable").append("<tr><td class='overlap'>" + d.name + "<br>" + d.exam_date.year + '/' + d.exam_date.month + '/' + d.exam_date.day + ' ' + d.exam_time_start + '-' + d.exam_time_end + "</td></tr>");
			}
			else
			{
				$("#examtable").append("<tr><td>" + d.name + "<br>"	+ d.exam_date.year + '/' + d.exam_date.month + '/' + d.exam_date.day + ' ' + d.exam_time_start + '-' + d.exam_time_end + "</td></tr>");
			}
		}
		$("#day0").html("<td class='tdd' >شنبه</td>");
		$("#day1").html("<td class='tdd' >یکشنبه</td>");
		$("#day2").html("<td class='tdd' >دوشنبه</td>");
		$("#day3").html("<td class='tdd' >سه شنبه</td>");
		$("#day4").html("<td class='tdd' >چهارشنبه</td>");
		$("#day5").html("<td class='tdd' >پنج شنبه</td>");
		$("#day6").html("<td class='tdd' >جمعه</td>");
		var i = 0 ;
		var j = 0 ;
		for ( i = 0 ; i < 7 ; i ++ )
		{
			for ( j = 0 ; j < 61 ; j ++ )
			{
				var class_j = "";
				if ( j % 4 == 0 )
					class_j = " rightborder";
				var time_details = TimeDetails(i,j);
				if ( time_details['state'] == 0 )
				{
					$("#day" + i).append("<td class='empty" + class_j + "'></td>");
				}
				else if ( time_details['state'] == 1 )
				{
					if ( sel_red == time_details['id'] )
					{
						$("#day" + i).append("<td id='selec" + time_details['id'] + "' class='overlap selected" + class_j + "' colspan=" + time_details['len'] + ">" + time_details['str'] + "</td>");
					}
					else
					{
						$("#day" + i).append("<td id='selec" + time_details['id'] + "' class='selected" + class_j + "' colspan=" + time_details['len'] + ">" + time_details['str'] + "</td>");
					}
				}
				else if ( time_details['state'] == 2 )
				{
				}
				// elseif 2 nothing to do 
			}
		}
		$(".selected").click(function(){
			if ( confirm ( 'ایا مطمئن هستید این درس را میخواهید حذف کنید؟' ) == true )
			{
				var ds = 0 ;
				ds = this.id.substr(5);
				var index = selecteds.indexOf(ds);
				if (index > -1) {
					selecteds.splice(index, 1);
				}
				sel_idx = selecteds.length ;
				drawTimeTable();
			}
		});
	}
	function resizing ()
	{
		var w = $("#timetable").width();
		w = w / 61;
		$(".tdt").width(w);
		$(".tdr").width(w * 4);
		drawTimeTable();
	}
}
