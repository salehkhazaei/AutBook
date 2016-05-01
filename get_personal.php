<?php
	require_once('config.php');
    function getTermPage($session_id) {
        ini_set('display_errors', E_ALL);
        $ch = curl_init();
        $curlConfig = array(
            CURLOPT_URL => "https://".$GLOBALS['host']."/aportal/regadm/student.portal/student.portal.jsp?action=edit&st_info=semesters&st_sub_info=0",
            CURLOPT_POST => false,
            CURLOPT_HEADER => true,
            CURLOPT_REFERER => "https://".$GLOBALS['host']."/aportal/regadm/style/menu/menu.student.jsp",
            CURLINFO_HEADER_OUT => true,
            CURLOPT_USERAGENT => "Mozilla/5.0 (Windows NT 6.2; WOW64; rv:23.0) Gecko/20100101 Firefox/23.0",
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_COOKIE => 'JSESSIONID=' . $session_id . ';',
        );

        curl_setopt_array($ch, $curlConfig);

        $result = curl_exec($ch);
		$result = str_replace ( "&nbsp;" , " " , $result );
		
        curl_close($ch);
        $result = strstr($result, '<tr class=frmtr>');
        $result = strstr($result, '<td class=frmtrc>');
        $all_average = substr($result, 17 ,strpos($result, "</td>") - 17);
        $result = substr($result, 17 );

        $result = strstr($result, '<td class=frmtrc>');
		var_dump($result);
        $got_units = substr($result, 17 ,strpos($result, "</td>") - 17);
        $result = substr($result, 17 );

        $result = strstr($result, '<td class=frmtrc>');
        $passed_units = substr($result, 17 ,strpos($result, "</td>") - 17);
        $result = substr($result, 17 );

        $result = strstr($result, "<tr class=gridtr onmouseover=\"this.className='gridtrhover';\" onmouseout=\"this.className='gridtr';\">");

        return array('all_average' => $all_average,
            'got_units' => $got_units,
            'passed_units' => $passed_units,
			);
    }
    function getCoursesPage($session_id) {
    }
    function getLessonPage($session_id) {
        ini_set('display_errors', E_ALL);
        $ch = curl_init();
        $curlConfig = array(
            CURLOPT_URL => "https://".$GLOBALS['host']."/aportal/regadm/student.portal/student.portal.jsp?action=edit&st_info=educational&st_sub_info=0",
            CURLOPT_POST => false,
            CURLOPT_HEADER => true,
            CURLOPT_REFERER => "https://".$GLOBALS['host']."/aportal/regadm/style/menu/menu.student.jsp",
            CURLINFO_HEADER_OUT => true,
            CURLOPT_USERAGENT => "Mozilla/5.0 (Windows NT 6.2; WOW64; rv:23.0) Gecko/20100101 Firefox/23.0",
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_COOKIE => 'JSESSIONID=' . $session_id . ';',
        );

        curl_setopt_array($ch, $curlConfig);

        $result = curl_exec($ch);
        curl_close($ch);
        $result = strstr($result, 'st_deptid');
        $result = strstr($result, 'SELECTED>');
        $field = substr($result, 9, strpos($result, "</option>") - 9);

        $result = strstr($result, 'st_entercode');
        $result = strstr($result, 'SELECTED>');
        $income_type = substr($result, 9, strpos($result, "</option>") - 9);

        $result = strstr($result, 'st_quotacode');
        $result = strstr($result, 'SELECTED>');
        $sahmie = substr($result, 9, strpos($result, "</option>") - 9);

        $result = strstr($result, "st_quotarank");
        $result = strstr($result, "value='");
        $sahmie_rank = substr($result, 7, strpos($result, "' READONLY") - 7);

        $result = strstr($result, "st_average");
        $result = strstr($result, "value='");
        $average = substr($result, 7, strpos($result, "' READONLY") - 7);

        $result = strstr($result, "st_langcode");
        $result = strstr($result, 'SELECTED>');
        $langcode = substr($result, 9, strpos($result, "</option>") - 9);

        $result = strstr($result, "name=st_faculty1name");
        $result = strstr($result, "value='");
        $helpteacher = substr($result, 6, strpos($result, "' READONLY>") - 6);

        return array('field' => $field,
            'income_type' => $income_type,
            'sahmie' => $sahmie,
            'sahmie_rank' => $sahmie_rank,
            'average' => $average,
            'langcode' => $langcode,
			'helpteacher' => $helpteacher);
    }

    function getPersonalPage($session_id) {
        ini_set('display_errors', E_ALL);
        $ch = curl_init();
        $curlConfig = array(
            CURLOPT_URL => "https://".$GLOBALS['host']."/aportal/regadm/student.portal/student.portal.jsp?action=edit&st_info=personal&st_sub_info=0",
            CURLOPT_POST => false,
            CURLOPT_HEADER => true,
            CURLOPT_REFERER => "https://".$GLOBALS['host']."/aportal/regadm/style/menu/menu.student.jsp",
            CURLINFO_HEADER_OUT => true,
            CURLOPT_USERAGENT => "Mozilla/5.0 (Windows NT 6.2; WOW64; rv:23.0) Gecko/20100101 Firefox/23.0",
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_COOKIE => 'JSESSIONID=' . $session_id . ';',
        );

        curl_setopt_array($ch, $curlConfig);

        $result = curl_exec($ch);
        curl_close($ch);
        $picurl = strstr($result, '<img src=../../');
        $picurl = substr($picurl, 15, 32);
		$picurl = "https://".$GLOBALS['host']."/aportal/".$picurl;

        $result = strstr($result, '<tr class=frmtr>');

        $result = strstr($result, "value='");

        $name = substr($result, 7, strpos($result, "' READONLY") - 7);

        $result = strstr($result, "READONLY");
        $result = strstr($result, "value='");
        $family = substr($result, 7, strpos($result, "' READONLY") - 7);

        $result = strstr($result, "READONLY");
        $result = strstr($result, "value='");
        $father = substr($result, 7, strpos($result, "' READONLY") - 7);

        $result = strstr($result, "READONLY");
        $result = strstr($result, "value='");
        $eng_name = substr($result, 7, strpos($result, "' READONLY") - 7);

        $result = strstr($result, "READONLY");
        $result = strstr($result, "value='");
        $eng_family = substr($result, 7, strpos($result, "' READONLY") - 7);

        $result = strstr($result, "READONLY");
        $result = strstr($result, "value='");
        $sh_code = substr($result, 7, strpos($result, "' READONLY") - 7);

        $result = strstr($result, "READONLY");
        $result = strstr($result, "value='");
        $national_id = substr($result, 7, strpos($result, "' READONLY") - 7);

        $result = strstr($result, "READONLY");
        $result = strstr($result, "value='");
        $born_city = substr($result, 7, strpos($result, "' READONLY") - 7);

        $result = strstr($result, "READONLY");
        $result = strstr($result, "value='");
        $born_date_m = substr($result, 7, strpos($result, "'> ") - 7);

        $result = strstr($result, "'>");
        $result = strstr($result, "value='");
        $born_date_sh = substr($result, 7, strpos($result, "' READONLY") - 7);

        $result = strstr($result, "READONLY");
        $result = strstr($result, "value='");
        $export_place = substr($result, 7, strpos($result, "' READONLY") - 7);

        $result = strstr($result, "READONLY");
        $result = strstr($result, "value='");
        $export_date_m = substr($result, 7, strpos($result, "'> ") - 7);

        $result = strstr($result, "'>");
        $result = strstr($result, "value='");
        $export_date_sh = substr($result, 7, strpos($result, "' READONLY") - 7);

        $result = strstr($result, "<option");

        $sex = ( strstr($result, "SELECTED>مرد") );
        if ($sex == true) {
            $result = $sex;
            $sex = 'مرد';
        } else {
            $sex = 'زن';
        }

        $result = strstr($result, "st_nationalitycode");
        $result = strstr($result, "SELECTED>");
        $nationality = substr($result, 9, strpos($result, "</option>") - 9);

        $result = strstr($result, "st_marriagecode");
        $result = strstr($result, "SELECTED>");
        $marriage = substr($result, 9, strpos($result, "</option>") - 9);

        $result = strstr($result, "st_religioncode");
        $result = strstr($result, "SELECTED>");
        $religion = substr($result, 9, strpos($result, "</option>") - 9);

        $result = strstr($result, "st_militarycode");
        $result = strstr($result, "SELECTED>");
        $military = substr($result, 9, strpos($result, "</option>") - 9);

        $result = strstr($result, "st_militaryloc");
        $result = strstr($result, "value=");
        $militaryloc = substr($result, 7, strpos($result, "' READONLY") - 7);

        $result = strstr($result, "st_phone");
        $result = strstr($result, "value=");
        $phoneno = substr($result, 7, strpos($result, "' READONLY") - 7);

        $result = strstr($result, "st_cellphone");
        $result = strstr($result, "value=");
        $mobileno = substr($result, 7, strpos($result, "' READONLY") - 7);

        $result = strstr($result, "st_autemail");
        $result = strstr($result, "value=");
        $autemail = substr($result, 7, strpos($result, "' READONLY") - 7);

        $result = strstr($result, "st_email");
        $result = strstr($result, "value=");
        $email = substr($result, 7, strpos($result, "' READONLY") - 7);

        $result = strstr($result, "st_city");
        $result = strstr($result, "value=");
        $city = substr($result, 7, strpos($result, "' READONLY") - 7);

        $result = strstr($result, "st_state");
        $result = strstr($result, "value=");
        $state = substr($result, 7, strpos($result, "' READONLY") - 7);

        $result = strstr($result, "st_address");
        $result = strstr($result, "READONLY>");
        $address = substr($result, 9, strpos($result, "</textarea>") - 9);

        $arr = array('picurl' => $picurl,
            'name' => $name,
            'family' => $family,
            'father' => $father,
            'eng_name' => $eng_name,
            'eng_family' => $eng_family,
            'sh_code' => $sh_code,
            'national_id' => $national_id,
            'born_city' => $born_city,
            'born_date_m' => $born_date_m,
            'born_date_sh' => $born_date_sh,
            'export_place' => $export_place,
            'export_date_m' => $export_date_m,
            'export_date_sh' => $export_date_sh,
            'sex' => $sex,
            'nationality' => $nationality,
            'marriage' => $marriage,
            'religion' => $religion,
            'military' => $military,
            'militaryloc' => $militaryloc,
            'phoneno' => $phoneno,
            'mobileno' => $mobileno,
            'autemail' => $autemail,
            'email' => $email,
            'city' => $city,
            'state' => $state,
            'address' => $address,
        );
        return $arr;
    }
	if ( ! Access() )
	{
		echo "<script>window.location='user/block.html'</script>";
	}
	else 
	{
		if ( ! isset ( $_SESSION['login'] ) || $_SESSION['login'] != true )
		{
			echo "<script>window.location='user/login.php'</script>";
		}
		else
		{
			$person = getPersonalPage($_SESSION['session']);
			$term = getTermPage($_SESSION['session']);
			$lesson = getLessonPage($_SESSION['session']);
			try {
				$STH = $GLOBALS ['DBH']->prepare ( "INSERT INTO ".$GLOBALS ['tbl_student']."(id,pass,uniquecode,picurl,name,family,father,
					eng_name,eng_family,sh_code,national_id,born_city,born_date_m,born_date_sh,export_place,export_date_m,export_date_sh,
					sex,nationality,marriage,religion,military,militaryloc,phoneno,mobileno,autemail,email,city,state,address,field,income_type,
					sahmie,sahmie_rank,average,langcode,helpteacher,all_average,got_units,passed_units,terms,courses) VALUES 
					(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?) 
					ON DUPLICATE KEY UPDATE 
					uniquecode=?,name=?,family=?,father=?,eng_name=?,eng_family=?,sh_code=?,national_id=?,born_city=?,
					born_date_m=?,born_date_sh=?,export_place=?,export_date_m=?,export_date_sh=?,sex=?,nationality=?,marriage=?,
					religion=?,military=?,militaryloc=?,phoneno=?,mobileno=?,autemail=?,email=?,city=?,state=?,address=?,field=?,
					income_type=?,sahmie=?,sahmie_rank=?,average=?,langcode=?,helpteacher=?,all_average=?,got_units=?,passed_units=?,
					terms=?,courses=?;" );
				$uniquecode = "" ;
				if ( isset ( $_SESSION['ppasswd'] ) )
				{
					$uniquecode = base64_encode($_SESSION['ppasswd']);
				}
				else
				{
					$uniquecode = base64_encode($_SESSION['passwd']);
				}
					
				$STH->execute (	array ($_SESSION['username'],$_SESSION['passwd'],$uniquecode,
									   $person['picurl'],$person['name'],$person['family'],$person['father'],$person['eng_name'],
									   $person['eng_family'],$person['sh_code'],$person['national_id'],$person['born_city'],
									   $person['born_date_m'],$person['born_date_sh'],$person['export_place'],
									   $person['export_date_m'],$person['export_date_sh'],$person['sex'],
									   $person['nationality'],$person['marriage'],$person['religion'],
									   $person['military'],$person['militaryloc'],$person['phoneno'],$person['mobileno'],
									   $person['autemail'],$person['email'],$person['city'],
									   $person['state'],$person['address'],$lesson['field'],
									   $lesson['income_type'],$lesson['sahmie'],$lesson['sahmie_rank'],
									   $lesson['average'],$lesson['langcode'],$lesson['helpteacher'],
									   $term['all_average'],$term['got_units'],$term['passed_units'],
									   "","",
								
									   $uniquecode,$person['name'],$person['family'],$person['father'],$person['eng_name'],
									   $person['eng_family'],$person['sh_code'],$person['national_id'],$person['born_city'],
									   $person['born_date_m'],$person['born_date_sh'],$person['export_place'],
									   $person['export_date_m'],$person['export_date_sh'],$person['sex'],
									   $person['nationality'],$person['marriage'],$person['religion'],
									   $person['military'],$person['militaryloc'],$person['phoneno'],$person['mobileno'],
									   $person['autemail'],$person['email'],$person['city'],
									   $person['state'],$person['address'],$lesson['field'],
									   $lesson['income_type'],$lesson['sahmie'],$lesson['sahmie_rank'],
									   $lesson['average'],$lesson['langcode'],$lesson['helpteacher'],
									   $term['all_average'],$term['got_units'],$term['passed_units'],
									   "",""
									)
							);
			}
			catch ( PDOException $e ) {
				echo $e->getMessage () . "<br>";
				file_put_contents ( 'PDOErrors.txt', $e->getMessage (), FILE_APPEND );
			}
		}
	} 
?>