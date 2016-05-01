<?php
	require_once('config.php');
	if ( ! Access() )
	{
		echo "<script>window.location='user/block.html'</script>";
	}
	else
	{
		if ( isset ( $_SESSION['captcha'] ) )
		{
			ini_set('display_errors', E_ALL);
			$ch = curl_init();
			$curlConfig = array(
				CURLOPT_URL => $_SESSION['captcha'] ,
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
				echo "cURL error ({$errno}):\n";
				var_dump($curlConfig);
			}		
			else
			{
				header('Content-type: image/jpeg');
				echo $result;
			}
			curl_close($ch);
		}
		else
		{
			echo "INVALID SESSION!";
		}
	}
?>