<?php
require_once 'config.php';
require_once 'CourseController.php';
require_once 'Schedule.php';

global $session_id1;

class EntekhabVahed {
	public $schedules = array ();
	public $s_id;
	public $current_sched;
	public $num_of_schedules;
	public $courses_available = array ();
	public $availableCourses;
	private $request_time = 2;

	public function __construct($session, $username) {
		$GLOBALS ['session_id1'] = $session;
		$this->current_sched = -1;
		$this->s_id = $username;
		$this->courses_available = $this->getCoursesData ( $GLOBALS ['session_id1'] );
		$this->getStudentSchedule ( $username );
	}

	public function getStudentSchedule() {
		$rows = $GLOBALS ['DBH']->query ( "SELECT * FROM " . $GLOBALS ['tbl_schedule'] . " WHERE student_id ='" . $this->s_id . "';" );
		$rows->setFetchMode ( PDO::FETCH_CLASS, 'Schedule' );
		$i = 0;
		$this->schedules = array ();
		while ( $rrow = $rows->fetch () ) {
			$this->schedules [$i] = $rrow;
			$i ++;
		}
		$this->num_of_schedules = $i;
		return $this->schedules;
	}

	private function getCoursesData($session_id) {
		set_time_limit(0);
		$this->availableCourses = array ();
		$got=array();
		$daneshkade=array();
		$math=array();
		$physics=array();
		$azPhysic1=array();
		$azPhysic2=array();
		$service=array();
		$zaban=array();
		$IslamHistory=array();
		$andisheh=array();
		$farsi=array();
		$akhlagh=array();
		$enghelab=array();
		$tafsir=array();
		$tarbiat1=array();
		$tarbiat2=array();
		$got = $this->getGotData ( $GLOBALS['session_id1'] );
		$daneshkade = $this->getFieldData ( $GLOBALS ['session_id1'] );
		$math = $this->getMathData ( $GLOBALS ['session_id1'] );
		$physics = $this->getPhysicsData ( $GLOBALS ['session_id1'] );
		$azPhysic1 = $this->getPhysicsLab1 ( $GLOBALS ['session_id1'] );
		$azPhysic2 = $this->getPhysicsLab2 ( $GLOBALS ['session_id1'] );
		$service = $this->getServiceData ( $GLOBALS ['session_id1'] );
		$zaban = $this->getEnglishData ( $GLOBALS ['session_id1'] );
		$IslamHistory = $this->getIslamHistoryData ( $GLOBALS ['session_id1'] );
		$andisheh = $this->getAndishehData ( $GLOBALS ['session_id1'] );
		$farsi = $this->getFarsiData ( $GLOBALS ['session_id1'] );
		$akhlagh = $this->getAkhlaghData ( $GLOBALS ['session_id1'] );
		$enghelab = $this->getEnghelabData ( $GLOBALS ['session_id1'] );
		$tafsir = $this->getTafsirData ( $GLOBALS ['session_id1'] );
		$tarbiat1 = $this->getTarbiat1Data ( $GLOBALS ['session_id1'] );
		$tarbiat2 = $this->getTarbiat2Data ( $GLOBALS ['session_id1'] );
		
		$this->availableCourses = array_merge ( $got, $daneshkade, $math, $physics, $azPhysic1, $azPhysic2, $service, $zaban, $IslamHistory, $andisheh, 
				$farsi, $akhlagh, $enghelab, $tafsir, $tarbiat1, $tarbiat2 );
		return $this->availableCourses;
	}

	function getGotData($session) {
		ini_set ( 'display_errors', E_ALL );
		$ch = curl_init ();
		
		curl_setopt ( $ch , CURLOPT_URL , "https://".$GLOBALS['host']."/aportal/regadm/student.portal/student.portal.jsp?action=edit&st_info=register&st_sub_info=0" );
		curl_setopt ( $ch , CURLOPT_POST , false );
		curl_setopt ( $ch , CURLOPT_REFERER , "https://".$GLOBALS['host']."/aportal/regadm/style/menu/menu.student.jsp" );
		curl_setopt ( $ch , CURLOPT_RETURNTRANSFER , true );
		curl_setopt ( $ch , CURLOPT_USERAGENT , "Mozilla/5.0 (Macintosh; Intel Mac OS X 10.8; rv:31.0) Gecko/20100101 Firefox/31.0" );
		curl_setopt ( $ch , CURLOPT_SSL_VERIFYPEER , false );
		curl_setopt ( $ch , CURLINFO_HEADER_OUT , true );
		curl_setopt ( $ch , CURLOPT_COOKIE , 'JSESSIONID=' . $session . ';' );
		
		$result = curl_exec ( $ch );
		curl_close ( $ch );
		
		return $this->InsertToDBIfNotExists ( $this->parseCourseHTML ( $result, "اخذ شده", 69 ) );
	}

	function getFieldData($session) {
		ini_set ( 'display_errors', E_ALL );
		$ch = curl_init ();
		
		curl_setopt ( $ch , CURLOPT_URL , "https://".$GLOBALS['host']."/aportal/regadm/student.portal/student.portal.jsp?action=edit&st_info=register&st_sub_info=u_mine_all" );
		curl_setopt ( $ch , CURLOPT_POST , false );
		curl_setopt ( $ch , CURLOPT_REFERER , "https://".$GLOBALS['host']."/aportal/regadm/style/menu/menu.student.jsp" );
		curl_setopt ( $ch , CURLOPT_RETURNTRANSFER , true );
		curl_setopt ( $ch , CURLOPT_USERAGENT , "Mozilla/5.0 (Macintosh; Intel Mac OS X 10.8; rv:31.0) Gecko/20100101 Firefox/31.0" );
		curl_setopt ( $ch , CURLOPT_SSL_VERIFYPEER , false );
		curl_setopt ( $ch , CURLINFO_HEADER_OUT , true );
		curl_setopt ( $ch , CURLOPT_COOKIE , 'JSESSIONID=' . $session . ';' );
		
		$result = curl_exec ( $ch );
		curl_close ( $ch );
		
		return $this->InsertToDBIfNotExists ( $this->parseCourseHTML ( $result, "دانشکده", 3 ) );
	}

	function getMathData($session) {
		ini_set ( 'display_errors', E_ALL );
		$ch = curl_init ();
		$curlConfig = array (
				CURLOPT_URL => "https://".$GLOBALS['host']."/aportal/regadm/student.portal/student.portal.jsp?action=edit&st_info=register&st_sub_info=u_math",
				CURLOPT_POST => false,
				CURLOPT_REFERER => "https://".$GLOBALS['host']."/aportal/regadm/style/menu/menu.student.jsp",CURLOPT_RETURNTRANSFER => true,
				CURLOPT_USERAGENT => "Mozilla/5.0 (Macintosh; Intel Mac OS X 10.8; rv:31.0) Gecko/20100101 Firefox/31.0",
				CURLOPT_SSL_VERIFYPEER => false,CURLINFO_HEADER_OUT => true,CURLOPT_COOKIE => 'JSESSIONID=' . $session . ';',
		);
		
		curl_setopt_array ( $ch, $curlConfig );
		$result = curl_exec ( $ch );
		curl_close ( $ch );
		
		return $this->InsertToDBIfNotExists ( $this->parseCourseHTML ( $result, "ریاضی", 3 ) );
	
	}

	function getPhysicsData($session) {
		ini_set ( 'display_errors', E_ALL );
		$ch = curl_init ();
		$curlConfig = array (
				CURLOPT_URL => "https://".$GLOBALS['host']."/aportal/regadm/student.portal/student.portal.jsp?action=edit&st_info=register&st_sub_info=u_phys",
				CURLOPT_POST => false,
				CURLOPT_REFERER => "https://".$GLOBALS['host']."/aportal/regadm/style/menu/menu.student.jsp",CURLOPT_RETURNTRANSFER => true,
				CURLOPT_USERAGENT => "Mozilla/5.0 (Macintosh; Intel Mac OS X 10.8; rv:31.0) Gecko/20100101 Firefox/31.0",
				CURLOPT_SSL_VERIFYPEER => false,CURLINFO_HEADER_OUT => true,CURLOPT_COOKIE => 'JSESSIONID=' . $session . ';',
		);
		
		curl_setopt_array ( $ch, $curlConfig );
		$result = curl_exec ( $ch );
		curl_close ( $ch );
		
		return $this->InsertToDBIfNotExists ( $this->parseCourseHTML ( $result, "فیزیک", 3 ) );
	
	}

	function getPhysicsLab1($session) {
		ini_set ( 'display_errors', E_ALL );
		$ch = curl_init ();
		$curlConfig = array (
				CURLOPT_URL => "https://".$GLOBALS['host']."/aportal/regadm/student.portal/student.portal.jsp?action=edit&st_info=register&st_sub_info=u_physlab1",
				CURLOPT_POST => false,
				CURLOPT_REFERER => "https://".$GLOBALS['host']."/aportal/regadm/style/menu/menu.student.jsp",CURLOPT_RETURNTRANSFER => true,
				CURLOPT_USERAGENT => "Mozilla/5.0 (Macintosh; Intel Mac OS X 10.8; rv:31.0) Gecko/20100101 Firefox/31.0",
				CURLOPT_SSL_VERIFYPEER => false,CURLINFO_HEADER_OUT => true,CURLOPT_COOKIE => 'JSESSIONID=' . $session . ';',
		);
		
		curl_setopt_array ( $ch, $curlConfig );
		$result = curl_exec ( $ch );
		curl_close ( $ch );
		
		return $this->InsertToDBIfNotExists ( $this->parseCourseHTML ( $result, "آزفیزیک۱", 1 ) );
	
	}

	function getPhysicsLab2($session) {
		ini_set ( 'display_errors', E_ALL );
		$ch = curl_init ();
		$curlConfig = array (
				CURLOPT_URL => "https://".$GLOBALS['host']."/aportal/regadm/student.portal/student.portal.jsp?action=edit&st_info=register&st_sub_info=u_physlab2",
				CURLOPT_POST => false,
				CURLOPT_REFERER => "https://".$GLOBALS['host']."/aportal/regadm/style/menu/menu.student.jsp",CURLOPT_RETURNTRANSFER => true,
				CURLOPT_USERAGENT => "Mozilla/5.0 (Macintosh; Intel Mac OS X 10.8; rv:31.0) Gecko/20100101 Firefox/31.0",
				CURLOPT_SSL_VERIFYPEER => false,CURLINFO_HEADER_OUT => true,CURLOPT_COOKIE => 'JSESSIONID=' . $session . ';',
		);
		curl_setopt_array ( $ch, $curlConfig );
		$result = curl_exec ( $ch );
		curl_close ( $ch );
		
		return $this->InsertToDBIfNotExists ( $this->parseCourseHTML ( $result, "آزفیزیک۲", 1 ) );
	
	}

	function getServiceData($session) {
		ini_set ( 'display_errors', E_ALL );
		$ch = curl_init ();
		$curlConfig = array (
				CURLOPT_URL => "https://".$GLOBALS['host']."/aportal/regadm/student.portal/student.portal.jsp?action=edit&st_info=register&st_sub_info=u_serv",
				CURLOPT_POST => false,
				CURLOPT_REFERER => "https://".$GLOBALS['host']."/aportal/regadm/style/menu/menu.student.jsp",CURLOPT_RETURNTRANSFER => true,
				CURLOPT_USERAGENT => "Mozilla/5.0 (Macintosh; Intel Mac OS X 10.8; rv:31.0) Gecko/20100101 Firefox/31.0",
				CURLOPT_SSL_VERIFYPEER => false,CURLINFO_HEADER_OUT => true,CURLOPT_COOKIE => 'JSESSIONID=' . $session . ';',
		);
		curl_setopt_array ( $ch, $curlConfig );
		
		$result = curl_exec ( $ch );
		curl_close ( $ch );
		
		return $this->InsertToDBIfNotExists ( $this->parseCourseHTML ( $result, "سرویس", 2 ) );
	
	}

	function getEnglishData($session) {
		ini_set ( 'display_errors', E_ALL );
		$ch = curl_init ();
		$curlConfig = array (
				CURLOPT_URL => "https://".$GLOBALS['host']."/aportal/regadm/student.portal/student.portal.jsp?action=edit&st_info=register&st_sub_info=u_english",
				CURLOPT_POST => false,
				CURLOPT_REFERER => "https://".$GLOBALS['host']."/aportal/regadm/style/menu/menu.student.jsp",CURLOPT_RETURNTRANSFER => true,
				CURLOPT_USERAGENT => "Mozilla/5.0 (Macintosh; Intel Mac OS X 10.8; rv:31.0) Gecko/20100101 Firefox/31.0",
				CURLOPT_SSL_VERIFYPEER => false,CURLINFO_HEADER_OUT => true,CURLOPT_COOKIE => 'JSESSIONID=' . $session . ';',
		);
		
		curl_setopt_array ( $ch, $curlConfig );
		
		$result = curl_exec ( $ch );
		curl_close ( $ch );
		
		return $this->InsertToDBIfNotExists ( $this->parseCourseHTML ( $result, "زبان", 2 ) );
	
	}

	function getIslamHistoryData($session) {
		ini_set ( 'display_errors', E_ALL );
		$ch = curl_init ();
		$curlConfig = array (
				CURLOPT_URL => "https://".$GLOBALS['host']."/aportal/regadm/student.portal/student.portal.jsp?action=edit&st_info=register&st_sub_info=u_history",
				CURLOPT_POST => false,
				CURLOPT_REFERER => "https://".$GLOBALS['host']."/aportal/regadm/style/menu/menu.student.jsp",CURLOPT_RETURNTRANSFER => true,
				CURLOPT_USERAGENT => "Mozilla/5.0 (Macintosh; Intel Mac OS X 10.8; rv:31.0) Gecko/20100101 Firefox/31.0",
				CURLOPT_SSL_VERIFYPEER => false,CURLINFO_HEADER_OUT => true,CURLOPT_COOKIE => 'JSESSIONID=' . $session . ';',
		);
		
		curl_setopt_array ( $ch, $curlConfig );
		
		$result = curl_exec ( $ch );
		curl_close ( $ch );
		
		return $this->InsertToDBIfNotExists ( $this->parseCourseHTML ( $result, "تاریخ اسلام", 1 ) );
	
	}

	function getAndishehData($session) {
		ini_set ( 'display_errors', E_ALL );
		$ch = curl_init ();
		$curlConfig = array (
				CURLOPT_URL => "https://".$GLOBALS['host']."/aportal/regadm/student.portal/student.portal.jsp?action=edit&st_info=register&st_sub_info=u_andishe",
				CURLOPT_POST => false,
				CURLOPT_REFERER => "https://".$GLOBALS['host']."/aportal/regadm/style/menu/menu.student.jsp",CURLOPT_RETURNTRANSFER => true,
				CURLOPT_USERAGENT => "Mozilla/5.0 (Macintosh; Intel Mac OS X 10.8; rv:31.0) Gecko/20100101 Firefox/31.0",
				CURLOPT_SSL_VERIFYPEER => false,CURLINFO_HEADER_OUT => true,CURLOPT_COOKIE => 'JSESSIONID=' . $session . ';',
		);
		curl_setopt_array ( $ch, $curlConfig );
		
		$result = curl_exec ( $ch );
		curl_close ( $ch );
		
		return $this->InsertToDBIfNotExists ( $this->parseCourseHTML ( $result, "اندیشه", 1 ) );
	
	}

	function getFarsiData($session) {
		ini_set ( 'display_errors', E_ALL );
		$ch = curl_init ();
		$curlConfig = array (
				CURLOPT_URL => "https://".$GLOBALS['host']."/aportal/regadm/student.portal/student.portal.jsp?action=edit&st_info=register&st_sub_info=u_persian",
				CURLOPT_POST => false,
				CURLOPT_REFERER => "https://".$GLOBALS['host']."/aportal/regadm/style/menu/menu.student.jsp",CURLOPT_RETURNTRANSFER => true,
				CURLOPT_USERAGENT => "Mozilla/5.0 (Macintosh; Intel Mac OS X 10.8; rv:31.0) Gecko/20100101 Firefox/31.0",
				CURLOPT_SSL_VERIFYPEER => false,CURLINFO_HEADER_OUT => true,CURLOPT_COOKIE => 'JSESSIONID=' . $session . ';',
		);
		
		curl_setopt_array ( $ch, $curlConfig );
		
		$result = curl_exec ( $ch );
		curl_close ( $ch );
		
		return $this->InsertToDBIfNotExists ( $this->parseCourseHTML ( $result, "فارسی", 2 ) );
	
	}

	function getAkhlaghData($session) {
		ini_set ( 'display_errors', E_ALL );
		$ch = curl_init ();
		$curlConfig = array (
				CURLOPT_URL => "https://".$GLOBALS['host']."/aportal/regadm/student.portal/student.portal.jsp?action=edit&st_info=register&st_sub_info=u_akhlagh",
				CURLOPT_POST => false,
				CURLOPT_REFERER => "https://".$GLOBALS['host']."/aportal/regadm/style/menu/menu.student.jsp",CURLOPT_RETURNTRANSFER => true,
				CURLOPT_USERAGENT => "Mozilla/5.0 (Macintosh; Intel Mac OS X 10.8; rv:31.0) Gecko/20100101 Firefox/31.0",
				CURLOPT_SSL_VERIFYPEER => false,CURLINFO_HEADER_OUT => true,CURLOPT_COOKIE => 'JSESSIONID=' . $session . ';',
		);
		
		curl_setopt_array ( $ch, $curlConfig );
		
		$result = curl_exec ( $ch );
		curl_close ( $ch );
		
		return $this->InsertToDBIfNotExists ( $this->parseCourseHTML ( $result, "اخلاق", 1 ) );
	
	}

	function getEnghelabData($session) {
		ini_set ( 'display_errors', E_ALL );
		$ch = curl_init ();
		$curlConfig = array (
				CURLOPT_URL => "https://".$GLOBALS['host']."/aportal/regadm/student.portal/student.portal.jsp?action=edit&st_info=register&st_sub_info=u_revel",
				CURLOPT_POST => false,
				CURLOPT_REFERER => "https://".$GLOBALS['host']."/aportal/regadm/style/menu/menu.student.jsp",CURLOPT_RETURNTRANSFER => true,
				CURLOPT_USERAGENT => "Mozilla/5.0 (Macintosh; Intel Mac OS X 10.8; rv:31.0) Gecko/20100101 Firefox/31.0",
				CURLOPT_SSL_VERIFYPEER => false,CURLINFO_HEADER_OUT => true,CURLOPT_COOKIE => 'JSESSIONID=' . $session . ';',
		);
		
		curl_setopt_array ( $ch, $curlConfig );
		
		$result = curl_exec ( $ch );
		curl_close ( $ch );
		
		return $this->InsertToDBIfNotExists ( $this->parseCourseHTML ( $result, "انقلاب", 1 ) );
	
	}

	function getTafsirData($session) {
		ini_set ( 'display_errors', E_ALL );
		$ch = curl_init ();
		$curlConfig = array (
				CURLOPT_URL => "https://".$GLOBALS['host']."/aportal/regadm/student.portal/student.portal.jsp?action=edit&st_info=register&st_sub_info=u_tafsir",
				CURLOPT_POST => false,
				CURLOPT_REFERER => "https://".$GLOBALS['host']."/aportal/regadm/style/menu/menu.student.jsp",CURLOPT_RETURNTRANSFER => true,
				CURLOPT_USERAGENT => "Mozilla/5.0 (Macintosh; Intel Mac OS X 10.8; rv:31.0) Gecko/20100101 Firefox/31.0",
				CURLOPT_SSL_VERIFYPEER => false,CURLINFO_HEADER_OUT => true,CURLOPT_COOKIE => 'JSESSIONID=' . $session . ';',
		);
		
		curl_setopt_array ( $ch, $curlConfig );
		
		$result = curl_exec ( $ch );
		curl_close ( $ch );
		
		return $this->InsertToDBIfNotExists ( $this->parseCourseHTML ( $result, "تفسیر", 1 ) );
	
	}

	function getTarbiat1Data($session) {
		ini_set ( 'display_errors', E_ALL );
		$ch = curl_init ();
		$curlConfig = array (
				CURLOPT_URL => "https://".$GLOBALS['host']."/aportal/regadm/student.portal/student.portal.jsp?action=edit&st_info=register&st_sub_info=u_phyedu1",
				CURLOPT_POST => false,
				CURLOPT_REFERER => "https://".$GLOBALS['host']."/aportal/regadm/style/menu/menu.student.jsp",CURLOPT_RETURNTRANSFER => true,
				CURLOPT_USERAGENT => "Mozilla/5.0 (Macintosh; Intel Mac OS X 10.8; rv:31.0) Gecko/20100101 Firefox/31.0",
				CURLOPT_SSL_VERIFYPEER => false,CURLINFO_HEADER_OUT => true,CURLOPT_COOKIE => 'JSESSIONID=' . $session . ';',
		);
		curl_setopt_array ( $ch, $curlConfig );
		
		$result = curl_exec ( $ch );
		curl_close ( $ch );
		
		return $this->InsertToDBIfNotExists ( $this->parseCourseHTML ( $result, "تربیت۱", 2 ) );
	
	}

	function getTarbiat2Data($session) {
		ini_set ( 'display_errors', E_ALL );
		$ch = curl_init ();
		$curlConfig = array (
				CURLOPT_URL => "https://".$GLOBALS['host']."/aportal/regadm/student.portal/student.portal.jsp?action=edit&st_info=register&st_sub_info=u_phyedu2",
				CURLOPT_POST => false,
				CURLOPT_REFERER => "https://".$GLOBALS['host']."/aportal/regadm/style/menu/menu.student.jsp",CURLOPT_RETURNTRANSFER => true,
				CURLOPT_USERAGENT => "Mozilla/5.0 (Macintosh; Intel Mac OS X 10.8; rv:31.0) Gecko/20100101 Firefox/31.0",
				CURLOPT_SSL_VERIFYPEER => false,CURLINFO_HEADER_OUT => true,CURLOPT_COOKIE => 'JSESSIONID=' . $session . ';',
		);
		
		curl_setopt_array ( $ch, $curlConfig );
		
		$result = curl_exec ( $ch );
		curl_close ( $ch );
		
		return $this->InsertToDBIfNotExists ( $this->parseCourseHTML ( $result, "تربیت۲", 2 ) );
	
	}

	public function InsertToDBIfNotExists($arr) {
		if ( $arr != NULL )
		{
			foreach ( $arr as $course ) {
				try {
					$STH = $GLOBALS ['DBH']->prepare ( 
		"INSERT INTO ".$GLOBALS ['tbl_course']."
		(id, name, groups, wday1, start_time1, end_time1, wday2, start_time2, end_time2,wday3, start_time3, end_time3,
		teacher, exam_date_day,exam_date_month,exam_date_year, exam_time_start, exam_time_end, code, unit, category, wday_ta, start_time_ta, end_time_ta,
		zarfiat, khali, ta_zarf, TA, ta_goroh, jensiat) VALUES 
		(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?) ON DUPLICATE KEY UPDATE 
		name=?, groups=?, wday1=?, start_time1=?, end_time1=?, wday2=?, start_time2=?, end_time2=?,wday3=?, start_time3=?, end_time3=?,
		teacher=?, exam_date_day=?, exam_date_month=?, exam_date_year=?, exam_time_start=?, exam_time_end=?, code=?, unit=?, category=?, wday_ta=?, start_time_ta=?, end_time_ta=?,
		zarfiat=?, khali=?, ta_zarf=?, TA=?, ta_goroh=?, jensiat=?;" );
					$STH->execute (	array ($course->id,$course->name,$course->groups,$course->wday1,$course->start_time1,$course->end_time1,
									$course->wday2,$course->start_time2,$course->end_time2,
									$course->wday3,$course->start_time3,$course->end_time3,
									$course->teacher,$course->exam_date['day'],$course->exam_date['month'],$course->exam_date['year'],$course->exam_time_start,
									$course->exam_time_end,$course->code,$course->unit,$course->category,$course->wday_ta,
									$course->start_time_ta,$course->end_time_ta,$course->zarfiat,$course->khali,
									$course->ta_zarf,$course->TA,$course->ta_groh,$course->jensiat,
									
									$course->name,$course->groups,$course->wday1,$course->start_time1,$course->end_time1,
									$course->wday2,$course->start_time2,$course->end_time2,
									$course->wday3,$course->start_time3,$course->end_time3,
									$course->teacher,$course->exam_date['day'],$course->exam_date['month'],$course->exam_date['year'],$course->exam_time_start,
									$course->exam_time_end,$course->code,$course->unit,$course->category,$course->wday_ta,
									$course->start_time_ta,$course->end_time_ta,$course->zarfiat,$course->khali,
									$course->ta_zarf,$course->TA,$course->ta_groh,$course->jensiat
							) );
				}
				catch ( PDOException $e ) {
					echo $e->getMessage () . "<br>";
					file_put_contents ( 'PDOErrors.txt', $e->getMessage (), FILE_APPEND );
				}
			}
		}
		return $arr;
	}

	public function parseCourseHTML($result1, $category, $_numberOfTime) {
		$result1 = str_replace ( "&nbsp;" , " " , $result1 );
		$r = "<tr class=gridtr onmouseover=\"this.className='gridtrhover';\" onmouseout=\"this.className='gridtr';\">";
		$result = strstr ( $result1, $r );
		$daneshkade_string = "دانشکده";
		$c = array ();
		$pegah = strstr ( $result, $r );
		$time3 = $name = $group = $wday1 = $start_time1 = $end_time1 = $wday2 = $start_time2 = $end_time2 = $wday_ta = $start_time_ta = $end_time_ta = $teacher = $exam_date = $exam_start = $exam_end = $code = $unit = $zarfiat = $khali = $ta_zarf = $TA = $ta_groh = $wday3 = $start_time3 = $end_time3 = $sex = "";
		
		
		while ( (strpos ( $pegah, $r )) !== FALSE ) {
			$array_time = array ();
			$p = strstr ( $pegah, "<td class=gridtic>" );
			$p = strstr ( $p, "<td class=gridtic >" );
			$name = strstr ( $p, "</td>", true );
			$name = substr ( $name, strlen ( "<td class=gridtic >" ) );
			
			$p = strstr ( $p, "</td>" );
			$p = strstr ( $p, "<td class=gridtic >" );
			$code = strstr ( $p, "</td>", true );
			$code = substr ( $code, strlen ( "<td class=gridtic >" ) );
			
			$p = strstr ( $p, "</td>" );
			$p = strstr ( $p, "<td class=gridtic >" );
			$unit = strstr ( $p, "</td>", true );
			$unit = substr ( $unit, strlen ( "<td class=gridtic >" ) );
			
			$p = strstr ( $p, "</td>" );
			$p = strstr ( $p, "<td class=gridtic >" );
			$group = strstr ( $p, "</td>", true );
			$group = substr ( $group, strlen ( "<td class=gridtic >" ) );
			if ($category != $daneshkade_string && $_numberOfTime != 69 ) {
				$p = strstr ( $p, "</td>" );
				$p = strstr ( $p, "<td class=gridtic >" );
				$sex = strstr ( $p, "</td>", true );
				$sex = substr ( $sex, strlen ( "<td class=gridtic >" ) );
			}
			else {
				$sex = "هردو";
			}
			if ( $_numberOfTime != 69 )
			{
				$p = strstr ( $p, "</td>" );
				$p = strstr ( $p, "<td class=gridtic >" );
				$zarfiat = strstr ( $p, "</td>", true );
				$zarfiat = substr ( $zarfiat, strlen ( "<td class=gridtic >" ) );
				
				$p = strstr ( $p, "</td>" );
				$p = strstr ( $p, "<td class=gridtic >" );
				$khali = strstr ( $p, "</td>", true );
				$khali = substr ( $khali, strlen ( "<td class=gridtic >" ) );
			}

			$p = strstr ( $p, "</td>" );
			$p = strstr ( $p, "<td class=gridtic >" );
			$teacher = strstr ( $p, "</td>", true );
			$teacher = substr ( $teacher, strlen ( "<td class=gridtic >" ) );
			
			$p = strstr ( $p, "</td>" );
			$p = strstr ( $p, "<td class=gridtic >" );
			$time1 = strstr ( $p, "</td>", true );
			$time1 = substr ( $time1, strlen ( "<td class=gridtic >" ) );
			
			$wday1 = strstr ( $time1, "[", true );
			$sti = strstr ( $time1, "[" );
			$start_time1 = strstr ( $sti, '-' );
			$start_time1 = strstr ( $start_time1, ']', true );
			$start_time1 = substr ( $start_time1, 1 );
			$end_time1 = strstr ( $sti, "-", true );
			$end_time1 = substr ( $end_time1, 1 );
			$start_time1 = $this->fixTimeSyntax ( $start_time1 );
			$end_time1 = $this->fixTimeSyntax ( $end_time1 );
			if ($_numberOfTime > 1) {
				$p = strstr ( $p, "</td>" );
				$p = strstr ( $p, "<td class=gridtic >" );
				$time2 = strstr ( $p, "</td>", true );
				$time2 = substr ( $time2, strlen ( "<td class=gridtic >" ) );
				if ( $time2 == " " )
				{
					$time2 = NULL;
					$wday2 = NULL;
					$start_time2 = NULL;
					$end_time2 = NULL;
				}
				else
				{
					$wday2 = strstr ( $time2, "[", true );
					$sti2 = strstr ( $time2, "[" );
					$start_time2 = strstr ( $sti2, '-' );
					$start_time2 = strstr ( $start_time2, ']', true );
					$start_time2 = substr ( $start_time2, 1 );
					$end_time2 = strstr ( $sti2, "-", true );
					$end_time2 = substr ( $end_time2, 1 );
					$start_time2 = $this->fixTimeSyntax ( $start_time2 );
					$end_time2 = $this->fixTimeSyntax ( $end_time2 );
				}
			}
			else {
				$time2 = NULL;
				$wday2 = NULL;
				$start_time2 = NULL;
				$end_time2 = NULL;
			}
			
			if (strcmp ( $category, $daneshkade_string ) == 0 || $_numberOfTime == 69) {
				
				$p = strstr ( $p, "</td>" );
				$p = strstr ( $p, "<td class=gridtic >" );
				$time3 = strstr ( $p, "</td>", true );
				$time3 = substr ( $time3, strlen ( "<td class=gridtic >" ) );
				
				if ( $time3 == " " )
				{
					$time3 = NULL;
					$wday3 = NULL;
					$start_time3 = NULL;
					$end_time3 = NULL;
				}
				else
				{
					$wday3 = strstr ( $time3, "[", true );
					$sti4 = strstr ( $time3, "[" );
					$start_time3 = strstr ( $sti4, '-' );
					$start_time3 = strstr ( $start_time3, ']', true );
					$start_time3 = substr ( $start_time3, 1 );
					$end_time3 = strstr ( $sti4, "-", true );
					$end_time3 = substr ( $end_time3, 1 );
					$start_time3 = $this->fixTimeSyntax ( $start_time3 );
					$end_time3 = $this->fixTimeSyntax ( $end_time3 );
				}
			}
			if ((strcmp ( $time3, " " ) == 0) || (strcmp ( $category, $daneshkade_string ) != 0 && $_numberOfTime != 69 )) {
				$start_time3 = NULL;
				$end_time3 = NULL;
				$wday3 = NULL;
				$time3 = NULL;
			}
			$p = strstr ( $p, "</td>" );
			$p = strstr ( $p, "<td class=gridtic >" );
			$exam = strstr ( $p, "</td>", true );
			$exam = substr ( $exam, strlen ( "<td class=gridtic >" ) );
			if ( $exam == " " )
			{
				$exam_date = NULL;
				$exam_start = NULL;
				$exam_end = NULL;
			}
			$exam_date = strstr ( $exam, "[", true );
			$sti = strstr ( $exam, "[" );
			$exam_start = strstr ( $sti, '-' );
			$exam_start = strstr ( $exam_start, ']', true );
			$exam_start = substr ( $exam_start, 1 );
			$exam_end = strstr ( $sti, "-", true );
			$exam_end = substr ( $exam_end, 1 );
			$exam_start = $this->fixTimeSyntax ( $exam_start );
			$exam_end = $this->fixTimeSyntax ( $exam_end );
			
			if ($_numberOfTime == 3 && $unit != 1) {
				$p = strstr ( $p, "</td>" );
				$p = strstr ( $p, "<td class=gridtic >" );
				$TA = strstr ( $p, "</td>", true );
				$TA = substr ( $TA, strlen ( "<td class=gridtic >" ) );
				if (strcmp ( " ", $TA ) != 0) {
					$p = strstr ( $p, "</td>" );
					$p = strstr ( $p, "<td class=gridtic >" );
					$ta_groh = strstr ( $p, "</td>", true );
					$ta_groh = substr ( $ta_groh, strlen ( "<td class=gridtic >" ) );
					$p = strstr ( $p, "</td>" );
					$p = strstr ( $p, "<td class=gridtic >" );
					$ta_zarf = strstr ( $p, "</td>", true );
					$ta_zarf = substr ( $ta_zarf, strlen ( "<td class=gridtic >" ) );
					$p = strstr ( $p, "</td>" );
					$p = strstr ( $p, "<td class=gridtic >" );
					$ta_time = strstr ( $p, "</td>", true );
					$ta_time = substr ( $ta_time, 19 );
					if ( $ta_time == " " )
					{
						$wday_ta = NULL;
						$start_time_ta = NULL;
						$end_time_ta = NULL;
					}
					else
					{
						$wday_ta = strstr ( $ta_time, "[", true );
						$sti3 = strstr ( $ta_time, "[" );
						$start_time_ta = strstr ( $sti3, '-' );
						$start_time_ta = strstr ( $start_time_ta, ']', true );
						$start_time_ta = substr ( $start_time_ta, 1 );
						$end_time_ta = strstr ( $sti3, "-", true );
						$end_time_ta = substr ( $end_time_ta, 1 );
						$start_time_ta = $this->fixTimeSyntax ( $start_time_ta );
						$end_time_ta = $this->fixTimeSyntax ( $end_time_ta );
					}
				}
				else {
					$TA = NULL;
					$ta_groh = 0;
					$ta_zarf = NULL;
					$ta_time = NULL;
					$wday_ta = NULL;
					$start_time_ta = NULL;
					$end_time_ta = NULL;
				}
			}
			if ( $ta_groh == NULL )
				$ta_groh = 0 ;
			$course = new Course ( $name, $group, $wday1, $start_time1, $end_time1, $wday2, $start_time2, $end_time2, $wday3, $start_time3, $end_time3, $wday_ta, $start_time_ta, 
					$end_time_ta, $teacher, $exam_date, $exam_start, $exam_end, $code, $unit, $category, $zarfiat, $khali, 
					$ta_zarf, $TA, $ta_groh, $sex );
			array_push ( $c, $course );
			
			$pegah = strstr ( $pegah, $name );
			$pegah = strstr ( $pegah, $r );
		}
		
		return $c;
	}

	function fixTimeSyntax($a_t) {
		$time_len = strlen ( $a_t );
		if ($time_len == 1) {
			$a_t = "0" . $a_t . ":00";
		}
		elseif ($time_len == 2) {
			$a_t = $a_t . ":00";
		}
		elseif ($time_len == 4) {
			$a_t = "0" . $a_t;
		}
		elseif ($time_len == 5) {
			$a_t = $a_t;
		}
		return $a_t;
	}
	
	public function addNewSchedule() {
		$this->schedules [$this->num_of_schedules] = Schedule::construct ( null, $this->s_id, "" );
		$this->num_of_schedules ++;
		return $this->schedules [$this->num_of_schedules - 1];
	}

	public function save($_stringOfCourses) {
		$this->schedules [$this->num_of_schedules] = Schedule::construct ( null, $this->s_id, $_stringOfCourses );
		$this->num_of_schedules ++;		
	}

	public function load() {
		getStudentSchedule ( $this->s_id );
	}

	public function refresh() {
		$this->courses_available = $this->getCoursesData ( $GLOBALS ['session_id1'] );
	}

	public function updateSchedule($_schedule_id, $_new_courses) {
		Update ( $GLOBALS ['tbl_schedule'], "course_ids=?", "id=? and student_id=?", array ($_new_courses,$_schedule_id,$this->s_id));
	}

	public function _load() {
		return json_encode ( $this->getStudentSchedule ( $this->s_id ) );
	}

	public function _course() {
		return json_encode ( $this->courses_available );
	}

	public function _save($cs) {
		if ($this->current_sched != -1) {
			$this->updateSchedule ( $this->current_sched, $cs );
		}
		else {
			$ss = $this->addNewSchedule ();
			$this->current_sched = $ss->id;
			$this->updateSchedule ( $this->current_sched, $cs );
		}
	}
}
?>