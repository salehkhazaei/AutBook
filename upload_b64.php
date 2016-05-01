<?php
	require_once('config.php');
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
			global $maximum_file_size;
			$maximum_file_size = 350000;

			if ( ( ! empty($_FILES["uploaded_file"] ) ) && 
				 ( $_FILES['uploaded_file']['error'] == 0 ) ) 
			{
				$filename = basename($_FILES['uploaded_file']['name']);
				$filetype = $_FILES['uploaded_file']['type'];
				$filename = strtolower($filename);
				$filetype = strtolower($filetype);
					
				$pos = strpos($filename,'php');
				
				if(!($pos === false)) {
					die('-1'); //error, file contains php');
				}

				$file_ext = strrchr($filename, '.');

				//check the extension is allowed
				$whitelist = array(".jpg",".jpeg",".png"); 
				
				if (!(in_array($file_ext, $whitelist))) {
					die('-2'); // not allowed extension,please upload images (jpg, jpeg, png) only');
				}

				//check upload typ
				$pos = strpos($filetype,'image');
				
				if($pos === false) {
					die('-3'); //File is not an image');
				}
			 
				$imageinfo = getimagesize($_FILES['uploaded_file']['tmp_name']);
				
				if($imageinfo['mime'] != 'image/jpeg'&& $imageinfo['mime']  != 'image/jpg'&& $imageinfo['mime'] != 'image/png') {
					die('-4'); //file is not an image 2');
				}
			 
				//check double file type (image with comment)
				if(substr_count($filetype, '/')>1){
					die('-5'); // multiple image types');
				}
				
				//check size 
				if ($_FILES["uploaded_file"]["size"] > $GLOBALS['maximum_file_size']) {
					die("-6");// files with size more than 350KB are not allowed!");
				}


				// upload to upload direcory 
				$uploaddir =  getcwd()."/".'uploads/'.$_SESSION['username'] .'/' ;
				if (file_exists($uploaddir)) {  
				} 
				else {  
					mkdir( $uploaddir, 0755, true);  
				} 

				//change the image name by adding a random number, hashing it using md5 function
				$name = basename($_FILES['uploaded_file']['name']).mt_rand();
				$uploadfile = $uploaddir . md5($name).'.txt';
				$base = 'data:'.$imageinfo['mime'].';base64,'.base64_encode(file_get_contents($_FILES['uploaded_file']['tmp_name']));
				$myfile = fopen($uploadfile, "w") ;
				if (fwrite($myfile, $base) == FALSE){
					echo "-7";
				}
				else{
					echo "0"; //uploaded successfully as ".$uploadfile;
					Update ( $GLOBALS['tbl_student'] , "picurl=?" , "id=?" , array($uploadfile,$_SESSION['username'] ) ) ;
				}
				fclose($myfile);
			} 
		}
	} 
?>