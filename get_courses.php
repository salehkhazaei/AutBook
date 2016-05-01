<?php
	require_once ('config.php');
	if ( ! Access() )
	{
		echo "<script>window.location='user/block.html'</script>";
	}
	else if ( isset ( $_SESSION['login'] ) && $_SESSION['login'] == true )
	{
		if ( isset ( $_GET['s'] ) && $_GET['s'] == '1' )
		{
			
		}
		else
		{
			require_once ('EntekhabVahed.php');
			if ( ! isset ( $_SESSION['eobj'] ) )
			{
				$ent = new EntekhabVahed($_SESSION['session'] , $_SESSION['username']);
				$_SESSION['eobj'] = serialize($ent);
			}
			else
			{
				$ent = unserialize($_SESSION['eobj']);
				$ent->refresh();
			}
		}
	}
?>
