<?php
	include "config.php";
	include "functions/map-tags.php";
	include "functions/upload-run.php";
	include "$getid3_path";
	$i = 0;
	$link = mysqli_connect($mysql_host, $mysql_user, $mysql_password) or die('Could not connect: ' . mysqli_error($link));
	mysqli_select_db($link , $mysql_database) or die('Could not select database');
	$tags = "tagme file_dump_(admin)";
	$rating = "unrated";
	$length = "0";
	foreach(glob("$dump_dir/*",GLOB_ONLYDIR) as $dir){
		foreach($allowed_filetypes as $end){
			foreach(glob("$dir/*.$end") as $file){
				//$file = substr($file,strlen($dump_dir)+1);
				echo "$file<br />";
				$ext = strtolower(pathinfo("$dump_dir/$file")['extension']);
				$file_type = $ext;
				
				upload($link , $metaterms , $file , $ext , $rating , $tags , $imagedir , $thumbdir , $imgck , $allowed_filetypes , $i , 'DUMP' , $dump_type );
			}
		}
	}
	foreach($allowed_filetypes as $end){
		foreach(glob("$dump_dir/*.$end") as $file){
			//$file = substr($file,strlen($dump_dir)+1);
			echo "$file<br />";
			$ext = strtolower(pathinfo("$dump_dir/$file")['extension']);
			$file_type = $ext;
		
			upload($link , $metaterms , $file , $ext , $rating , $tags , $imagedir , $thumbdir , $imgck , $allowed_filetypes , $i , 'DUMP' );
		}
	}
		
?>
