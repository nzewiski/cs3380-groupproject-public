<?php 
include 'connect.php';
include 'header.php';
if(isset($_GET['id'])){
	//Post id was sent to the form
	$id = $_GET['id'];
	$sql = 'DELETE FROM posts WHERE post_id=' . $id;
	$result = mysql_query($sql);
	if(!$result){
		echo 'Failed to delete post!';
	}else{
		echo 'Post was deleted Successfully <a href="topic.php?id=' . $_GET['topic'] . '">return to Thread?</a>';
	}
	
}

include 'footer.php';
