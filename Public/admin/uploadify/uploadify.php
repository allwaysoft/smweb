<?php
//ini_set ('memory_limit', '128M');
require_once 'ImageResize.class.php';
//set_time_limit(0);//0表示没有限制

/*
Uploadify v2.1.4
Release Date: November 8, 2010
*/
if (!empty($_FILES)) {
	$tempFile = $_FILES['Filedata']['tmp_name'];
	$targetPath =  $_SERVER['DOCUMENT_ROOT'] . $_POST['folder'];//$_SERVER['DOCUMENT_ROOT'] .
	$folder = $targetPath.date("Ymd")."/";
	
	if(!is_dir($folder)) mkdir($folder,0755,TRUE);
	
	$extension = strtolower(substr($_FILES['Filedata']['name'], strrpos($_FILES['Filedata']['name'], ".")));
	
	$targetFile =  str_replace('//','/',$folder) .time(). rand(1000, 9999).$extension; //$_FILES['Filedata']['name'];
	
	 //$fileTypes  = str_replace('*.','',$_REQUEST['fileExt']);
	 //$fileTypes  = str_replace(';','|',$fileTypes);
	 //$typesArray = split('\|',$fileTypes);
	 //$fileParts  = pathinfo($_FILES['Filedata']['name']);
	
	 //if (in_array($fileParts['extension'],$typesArray)) {
		// Uncomment the following line if you want to make the directory if it doesn't exist
		// mkdir(str_replace('//','/',$targetPath), 0755, true);
		
		
		//$tempFile = time();
		
		//if(is_dir())
		
		move_uploaded_file($tempFile,$targetFile);
		
		#缩略图
		$sPara = @$_GET['simg'];
		if(!empty($sPara)){
			$simgArr=explode("_",$sPara);
			$simg = $simgArr[0];
			$swidth=$simgArr[1];
			$sheight=$simgArr[2];
			if($simg=='true'){
				$thumbnail = new resizeimage($targetFile, $swidth, $sheight, 0);
			}
		}
		//echo(explode("_", @$_GET['simg']));
		//echo $targetFile;
		echo (str_replace($_SERVER['DOCUMENT_ROOT'].'/', "", $targetFile));
	// } else {
	// 	echo 'Invalid file type.';
	// }
}


?>