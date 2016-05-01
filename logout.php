<?php
	require_once('config.php');
	session_destroy();
	echo "<script>window.location='user/login.php'</script>";
?>