<?php
include 'connect.php';
include 'header.php';


$imgDir = "imgs/";
$imgs = array();
$i = 0;


$files = scandir($imgDir);
if($files){
	$filecount = count($files) - 2;
}
//Prepare Row


if(is_dir($imgDir)){
		if($dh = opendir($imgDir)){
			while(($file = readdir($dh)) != FALSE){
				//Coincidentally rtrim is removing the . and .. directories
				$trimmed = rtrim($file, "..");
				if(strlen($trimmed) > 0){
					$imgs[$i] = $trimmed;
					$i +=1;
				}	
			}
			//Finished storing images, not out put with for loop in pagination
			$total = $filecount;
			$total_pages = ceil($total/4);
			$pagLink = '<ul class="pagination col-sm-4 col-sm-offset-4">';
			for($i=0; $i<=$total_pages; $i++){
				$pagLink .= '<li><a onclick="loadImg(' .$i. ')"href="gallery.php?page=' . $i . '">' . $i .'</a></li>' ;
			}
			echo $pagLink . '</ul>';
			
			
		}
}



include 'footer.php';