<?php
require_once('config.php');
function endsWith($haystack, $needle)
{
    $length = strlen($needle);
    if ($length == 0) {
        return true;
    }

    return (substr($haystack, -$length) === $needle);
}
function profilepic($id=-1)
{
	if ( $id == -1 )
	{
		$id = $_SESSION['username'];
	}
	$rows = Select ( "*" , $GLOBALS['tbl_student'] , "id=?" , array($id) );
	if ( $row = $rows->fetch() )
	{
		$picurl = $row['picurl'];
		if ( (strpos($picurl, $id) !== FALSE) &&
			 (strpos($picurl, 'uploads') !== FALSE) && 
			 endsWith($picurl,".txt") )
		{
			$myfile = fopen($picurl, "r") or die("Unable to open file!");
			$echo = fread($myfile,filesize($picurl));
			fclose($myfile);
		}
		else
		{
			ini_set('display_errors', E_ALL);
			$ch = curl_init();
			$curlConfig = array(
				CURLOPT_URL => $picurl ,
				CURLOPT_POST => false,
				CURLOPT_HEADER => false,
				CURLINFO_HEADER_OUT => true,
				CURLOPT_USERAGENT => "Mozilla/5.0 (Windows NT 6.2; WOW64; rv:23.0) Gecko/20100101 Firefox/23.0",
				CURLOPT_SSL_VERIFYPEER => false,
				CURLOPT_RETURNTRANSFER => true,
				CURLOPT_BINARYTRANSFER => true,
				CURLOPT_COOKIE => 'JSESSIONID=' . $_SESSION['session'] . ';',
			);
			curl_setopt_array($ch, $curlConfig);
			$result = curl_exec($ch);
			if($errno = curl_errno($ch)) {
				$echo = "cURL error ({$errno}):\n";
				var_dump($curlConfig);
			}		
			else
			{
				$echo = 'data:image/jpeg;base64,'.base64_encode($result);
			}
			curl_close($ch);
		}
		return $echo;
	}
}
?>