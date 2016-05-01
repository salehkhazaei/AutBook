<?php
	session_start();
	global $db_username, $db_password, $db_database, $db_host;
	global $tbl_course, $tbl_schedule, $tbl_access;
	global $tbl_student, $tbl_generation, $tbl_message;
	global $DBH,$host;
	global $tbl_gender;

	$db_database = "da19440_autbook";
	$db_host = "localhost";
	$db_username = "da19440_autbook";
	$db_password = "SalehKhazaeizZ123";
	$tbl_course = "Course";
	$tbl_schedule = "Schedule";
	$tbl_access = "Access";
	$tbl_student = "Student";
	$tbl_generation = "Generation";
	$tbl_message = "Message";
	$tbl_gender = "GENDER";
	$tbl_poll = "Poll";
	$host = "portal2.aut.ac.ir";

	OpenDatabase ( $db_host, $db_database, $db_username, $db_password );

	CreatePollTable ();
	CreateCourseTable ();
	CreateScheduleTable ();
	CreateAccessTable ();
	createStudentTable ();
	createGenerationTable ();
	createMessageTable ();
	createGenderTable ();
	
	class Message {
		public $id ;
		public $_from ;
		public $_to ;
		public $_time ; 
		public $_readed ;
		public $_deleted ;
	}
	
	class Student {
		public $id;
		public $pass;
		public $uniquecode;
		public $picurl;
		public $name;
		public $family;
		public $father;
		public $eng_name;
		public $eng_family;
		public $sh_code;
		public $national_id;
		public $born_city;
		public $born_date_m;
		public $born_date_sh;
		public $export_place;
		public $export_date_m;
		public $export_date_sh;
		public $sex;
		public $nationality;
		public $marriage;
		public $religion;
		public $military;
		public $militaryloc;
		public $phoneno;
		public $mobileno;
		public $autemail;
		public $email;
		public $city;
		public $state;
		public $address;
		public $field;
		public $income_type;
		public $sahmie;
		public $sahmie_rank;
		public $average;
		public $langcode;
		public $helpteacher;
		public $all_average;
		public $got_units;
		public $passed_units;
		public $terms;
		public $courses;
	}
	function CreatePollTable() {
		try {
			$GLOBALS ['DBH']->query ( 
					"CREATE TABLE IF NOT EXISTS " . $GLOBALS ['tbl_poll'] . " ( id varchar(10) not null,
																				q1 varchar(3),
																				q2 varchar(3),
																				q3 varchar(3),
																				q4 varchar(3),
																				q5 varchar(3),
																				q6 text,
																				PRIMARY KEY(id))
																			CHARSET=utf8 DEFAULT COLLATE utf8_persian_ci;" );
		}
		catch ( PDOException $e ) {
			echo $e->getMessage ();
			file_put_contents ( 'PDOErrors.txt', $e->getMessage (), FILE_APPEND );
		}

	}

	function createGenderTable() {
		try {
			$GLOBALS ['DBH']->query ( 
					"CREATE TABLE IF NOT EXISTS " . $GLOBALS ['tbl_gender'] . " ( name varchar(40) not null,
																				gender int(1) not null,
																				PRIMARY KEY(name))
																			CHARSET=utf8 DEFAULT COLLATE utf8_persian_ci;" );
		}
		catch ( PDOException $e ) {
			echo $e->getMessage ();
			file_put_contents ( 'PDOErrors.txt', $e->getMessage (), FILE_APPEND );
		}

	}
	function createMessageTable() {
		try {
			$GLOBALS ['DBH']->query ( 
					"CREATE TABLE IF NOT EXISTS " . $GLOBALS ['tbl_message'] . " (
																		id 				int(12) not null AUTO_INCREMENT,
																		_from			varchar(12) not null,
																		_to				varchar(12) not null,
																		_time			varchar(50) not null,
																		_readed			int(1)	default 0,
																		_deleted		int(1)  default 0,
																		PRIMARY KEY(id)) CHARSET=utf8 DEFAULT COLLATE utf8_persian_ci;" );
		}
		catch ( PDOException $e ) {
			echo $e->getMessage ();
			file_put_contents ( 'PDOErrors.txt', $e->getMessage (), FILE_APPEND );
		}
	}
	function createStudentTable() {
		try {
			$GLOBALS ['DBH']->query ( 
					"CREATE TABLE IF NOT EXISTS " . $GLOBALS ['tbl_student'] . " (
																		id 				int(12) not null,
																		pass			varchar(30),
																		uniquecode 			varchar(30),
																		picurl 			varchar(200),
																		name 			varchar(50),
																		family 			varchar(50),
																		father 			varchar(50),
																		eng_name 		varchar(50),
																		eng_family		varchar(50),
																		sh_code			varchar(50),
																		national_id		varchar(50),
																		born_city		varchar(50),
																		born_date_m		varchar(50),
																		born_date_sh	varchar(50),	
																		export_place	varchar(50),
																		export_date_m	varchar(50),
																		export_date_sh	varchar(50),
																		sex				varchar(8),
																		nationality		varchar(50),
																		marriage		varchar(50),
																		religion		varchar(50),
																		military		varchar(50),
																		militaryloc		varchar(50),
																		phoneno			varchar(50),
																		mobileno		varchar(50),
																		autemail		varchar(150),
																		email			varchar(150),
																		city			varchar(50),
																		state			varchar(50),
																		address			varchar(250),
																		field			varchar(100),
																		income_type		varchar(50),	
																		sahmie			varchar(50),
																		sahmie_rank		varchar(50),
																		average			varchar(50),
																		langcode		varchar(50),
																		helpteacher		varchar(50),
																		all_average		varchar(50),
																		got_units		varchar(30),
																		passed_units	varchar(30),
																		terms			text,
																		courses			text,
																		PRIMARY KEY(id)) CHARSET=utf8 DEFAULT COLLATE utf8_persian_ci;" );
		}
		catch ( PDOException $e ) {
			echo $e->getMessage ();
			file_put_contents ( 'PDOErrors.txt', $e->getMessage (), FILE_APPEND );
		}

	}
	function createGenerationTable() {
		try {
			$GLOBALS ['DBH']->query ( 
					"CREATE TABLE IF NOT EXISTS " . $GLOBALS ['tbl_generation'] . " (id varchar(12) not null,
																					name varchar(50),
																					family varchar(50),
																					PRIMARY KEY(id)) CHARSET=utf8 DEFAULT COLLATE utf8_persian_ci;" );
		}
		catch ( PDOException $e ) {
			echo $e->getMessage ();
			file_put_contents ( 'PDOErrors.txt', $e->getMessage (), FILE_APPEND );
		}
	}

	function CreateCourseTable() {
		try {
			$GLOBALS ['DBH']->query ( 
					"CREATE TABLE IF NOT EXISTS " . $GLOBALS ['tbl_course'] . " ( id varchar(12) not null,
																		code int(10) not null,
																		name varchar(100) not null,
																		groups int(3) not null,
																		wday1 varchar(30) not null,
																		start_time1 varchar(30) not null,
																		end_time1 varchar(30) not null,
																		wday2 varchar(30) default null,
																		start_time2 varchar(30) default null,
																		end_time2 varchar(30) default null,
																		wday3 varchar(30) default null,
																		start_time3 varchar(30) default null,
																		end_time3 varchar(30) default null,
																		teacher varchar(20) not null,
																		exam_date_day varchar (40),
																		exam_date_month varchar (40),
																		exam_date_year varchar (40),
																		exam_time_start varchar(40),	
																		exam_time_end varchar(40) not null,
																		unit int(2) not null,
																		category varchar(50) not null,
																		wday_ta varchar(30) default null,
																		start_time_ta varchar(30) default null,
																		end_time_ta varchar(30) default null,
																		ta_goroh int(3) not null default 0,
																		ta_zarf int (3) default null,
																		TA varchar(30) default null,
																		khali int(4) default null,
																		jensiat varchar(10) default null,
																		zarfiat int(2) not null,
																		PRIMARY KEY(id)) 
																		CHARSET=utf8 DEFAULT COLLATE utf8_persian_ci;" );
		}
		catch ( PDOException $e ) {
			echo $e->getMessage ();
			file_put_contents ( 'PDOErrors.txt', $e->getMessage (), FILE_APPEND );
		}

	}

	function CreateScheduleTable() {
		try {
			$GLOBALS ['DBH']->query ( 
					"CREATE TABLE IF NOT EXISTS " . $GLOBALS ['tbl_schedule'] . " (
																		course_ids TEXT,
																		student_id varchar(10) not null,
																		id int(4) auto_increment not null,
																		 
																		PRIMARY KEY(id));" );
		}
		catch ( PDOException $e ) {
			echo $e->getMessage ();
			file_put_contents ( 'PDOErrors.txt', $e->getMessage (), FILE_APPEND );
		}

	}

	function CreateAccessTable() {
		try {
			$GLOBALS ['DBH']->query ( 
					"CREATE TABLE IF NOT EXISTS " . $GLOBALS ['tbl_access'] . " (ip varchar(45) not null,
																							numberOfRequests int(2) default 0,
																							last_request_time varchar(31),
																							blocked_time varchar(31),
																							PRIMARY KEY(ip));" );
		}
		catch ( PDOException $e ) {
			echo $e->getMessage ();
			file_put_contents ( 'PDOErrors.txt', $e->getMessage (), FILE_APPEND );
		}
	}
	function OpenDatabase($host, $database, $username, $password) {
		try {
			$GLOBALS ['DBH'] = new PDO ( "mysql:host=$host;dbname=$database;charset=utf8", $username, $password );
			$GLOBALS ['DBH']->setAttribute ( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
			
			return true;
		}
		catch ( PDOException $e ) {
			echo $e->getMessage ();
			file_put_contents ( 'PDOErrors.txt', $e->getMessage (), FILE_APPEND );
			return false;
		}
		return false;

	}

	function AccessIP ( $ip )
	{
		$rrows = Select ( "*" , $GLOBALS ['tbl_access'] , "ip=:ip" , array(':ip' => $ip) );
		$now = time ();
		if ( $rrow = $rrows->fetch() )
		{
			$time = $rrow['last_request_time'];
			$btime = $rrow['blocked_time'];
			if ($now - $btime < 180 && $btime != false )
			{
				return false;
			}
			if ($now - $time > 1) {
				Update ( $GLOBALS ['tbl_access'], "last_request_time=?,numberOfRequests=? ", "ip=?", array ($now,0,$ip));
				return true;
			}
			else if ( $rrow['numberOfRequests']+1 < 10 )
			{
				Update ( $GLOBALS ['tbl_access'], "numberOfRequests=?", "ip=?", array ($rrow['numberOfRequests']+1,$ip));
				return true;
			}
			else
			{
				Update ( $GLOBALS ['tbl_access'], "blocked_time=?", "ip=?", array ($now,$ip));
				return false;
			}
		}
		else
		{
			Create ( $GLOBALS ['tbl_access'], "(ip,numberOfRequests,last_request_time,blocked_time)" , "(?,?,?,?)" , array($ip,0,$now,null));
			return true;
		}
	}

	function Access ( ) 
	{
		$a = AccessIP($_SERVER['REMOTE_ADDR']);
		$b = true ;
		if ( isset ( $_SERVER['HTTP_X_FORWARDED_FOR'] ) )
		{
			$b = AccessIP($_SERVER['HTTP_X_FORWARDED_FOR']);
		}
		return $a && $b;
	}

	function Create($table, $headers, $values, $data) {
		try {
			$STH = $GLOBALS ['DBH']->prepare ( "INSERT INTO " . $table . " " . $headers . " values " . $values );
			$STH->execute ( $data );
		}
		catch ( PDOException $e ) {
			echo $e->getMessage ();
			file_put_contents ( 'PDOErrors.txt', $e->getMessage (), FILE_APPEND );
			return;
		}
		return true;
	}

	function Update($table, $set, $where, $data) {
		try {
			$STH = $GLOBALS ['DBH']->prepare ( "UPDATE " . $table . " SET " . $set . " WHERE " . $where );
			$STH->execute ( $data );
		}
		catch ( PDOException $e ) {
			echo $e->getMessage ();
			file_put_contents ( 'PDOErrors.txt', $e->getMessage (), FILE_APPEND );
		}

	}

	function Delete($table, $where, $data) {
		try {
			$STH = $GLOBALS ['DBH']->prepare ( "DELETE FROM " . $table . " WHERE " . $where );
			$STH->execute ( $data );
		}
		catch ( PDOException $e ) {
			echo $e->getMessage ();
			file_put_contents ( 'PDOErrors.txt', $e->getMessage (), FILE_APPEND );
		}

	}

	function Select($what, $table, $where, $data) {
		if ($where == null) {
			return $GLOBALS ['DBH']->query ( "select " . $what . " from " . $table );
		}
		else {
			$statement = $GLOBALS ['DBH']->prepare ( "select " . $what . " from " . $table . " where " . $where ); // name = :name");
			$statement->execute ( $data );
			return $statement;
		}

	}

    function signin($session_id, $username, $password, $captcha) {
        ini_set('display_errors', E_ALL);
        $ch = curl_init();
        $curlConfig = array(
            CURLOPT_URL => "https://".$GLOBALS['host']."/aportal/login.jsp",
            CURLOPT_POST => true,
            CURLOPT_HEADER => true,
            CURLINFO_HEADER_OUT => true,
            CURLOPT_USERAGENT => "Mozilla/5.0 (Windows NT 6.2; WOW64; rv:23.0) Gecko/20100101 Firefox/23.0",
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_COOKIE => 'JSESSIONID=' . $session_id . ';',
            CURLOPT_POSTFIELDS => 'username=' . ($username) . '&password=' . ($password) . '&passline=' . ($captcha) . '&login=%D9%88%D8%B1%D9%88%D8%AF+%D8%A8%D9%87+%D9%BE%D9%88%D8%B1%D8%AA%D8%A7%D9%84',
        );

        curl_setopt_array($ch, $curlConfig);
        $result = curl_exec($ch);
        curl_close($ch);

        if (strstr($result, '<frame name="topper"')) 
		{
			$_SESSION['plogin']=true;
            return true;
        } 
		else 
		{
            getSession();
            return false;
        }
    }

    function getSession() {
        ini_set('display_errors', E_ALL);
        $ch = curl_init();
        $curlConfig = array(
            CURLOPT_URL => "https://".$GLOBALS['host']."/aportal/",
            CURLOPT_POST => false,
            CURLOPT_HEADER => true,
            CURLINFO_HEADER_OUT => true,
            CURLOPT_USERAGENT => "Mozilla/5.0 (Windows NT 6.2; WOW64; rv:23.0) Gecko/20100101 Firefox/23.0",
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_RETURNTRANSFER => true,
        );

        curl_setopt_array($ch, $curlConfig);

        $result = curl_exec($ch);
        curl_close($ch);
        $session_start = strstr($result, "JSESSIONID=");
        $session_id = substr($session_start, 11, 32);

        $captcha_start = strstr($session_start, "<img src=");
        $captcha_id = substr($captcha_start, 10, 93);
        $captcha_url = "https://".$GLOBALS['host']."/aportal/" . $captcha_id;

		return array ( $session_id , $captcha_url );
    }
	function isLoggedIn ( $username )
	{
		$rows = Select ( "*" , $GLOBALS['tbl_student'] , "id=?" , array($username));
		if ( $row = $rows->fetch() )
		{
			if ( $row['pass'] == null )
			{
				return false ;
			}
			else
				return $row ;
		}
		else
			return false ;
	}
	function contactUs ( $name , $email , $msg )
	{
		$to      = "saleh.khazaei@gmail.com";
		$subject = "AUTBOOK ContactUs";
		$message = urlencode("Name: ".$name."\nEmail: ".$email."\nMessage: ".$msg);
		$headers = 'From: contactus@autbook.ir\r\n' .
			'X-Mailer: PHP/' . phpversion();
		mail($to, $subject, $message, $headers);
	}
	function changePassword ( $old , $new , $conf )
	{
		$rows = Select ( "*" , $GLOBALS['tbl_student'] , "id=?" , array($_SESSION['username']) );
		if ( $row = $rows->fetch() )
		{
			if ( $row['pass'] == $old )
			{
				if ( $new == $conf )
				{
					Update ( $GLOBALS['tbl_student'] , "pass=?" , "id=?" , array( $conf , $_SESSION['username']) );
					return 0 ;
				}
				else
				{
					return 3 ;
				}
			}
			else
			{
				return 2 ;
			}
		}
		else
		{
			return 1 ;
		}
	}
	function isPolled ( )
	{
		$rows = Select ( "id" , $GLOBALS['tbl_poll'] , "id=?" , array ( $_SESSION['username'] ) );
		return !( $rows->fetch() );
	}
?>