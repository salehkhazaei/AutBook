<?php
	require_once('config.php');
    function CheckConnection($hoststr) {
		set_time_limit(10);
        ini_set('display_errors', E_ALL);
        $ch = curl_init();
        $curlConfig = array(
            CURLOPT_URL => "https://".$hoststr."/aportal/",
            CURLOPT_POST => false,
            CURLOPT_HEADER => true,
            CURLINFO_HEADER_OUT => true,
            CURLOPT_USERAGENT => "Mozilla/5.0 (Windows NT 6.2; WOW64; rv:23.0) Gecko/20100101 Firefox/23.0",
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_RETURNTRANSFER => true,
        );
        curl_setopt_array($ch, $curlConfig);
        $result = curl_exec($ch);
		if($errno = curl_errno($ch)) {
			return false ;
		}
        curl_close($ch);
		return true;
    }
	if ( ! Access() )
	{
		echo "<script>window.location='user/block.html'</script>";
	}
	else 
	{
		if ( ! CheckConnection ( "portal2.aut.ac.ir" ) )
		{
			if ( ! CheckConnection ( "portal.aut.ac.ir" ) ) 
			{
				echo "false";
			}
			else
			{
				echo "true";
				$GLOBALS['host'] = "portal.aut.ac.ir";
			}
		}
		else
		{
			echo "true";
			$GLOBALS['host'] = "portal2.aut.ac.ir";
		}
	}
?>
