<?php
	require_once('config.php');
	if ( ! Access() )
	{
		echo "<script>window.location='user/block.html'</script>";
	}
	else 
	{
		require_once('EntekhabVahed.php');
		if ( ! isset ( $_SESSION['login'] ) || $_SESSION['login'] != true )
		{
			echo "<script>window.location='user/login.php'</script>";
		}
		else
		{
			$ent = unserialize($_SESSION['eobj']);
			if( preg_match("([0-9]+:[0-9]+:[0-9]+;?)",$_GET['courses']))
			{
				$ent->_save($_GET['courses']);
			}
			$_SESSION['eobj'] = serialize($ent);
		}
	} 
?>