<?php
include 'connect.php';
include 'header.php';

if($_SERVER['REQUEST_METHOD'] != 'POST'){
	echo 'Can\'t call this script directly';
}
else{
	
	if(!$_SESSION['logged']){
		echo 'You must be signed in to reply!';
	}else{
		if(isset($_GET['id'])){
			//Set variables and scrub for xss
			$id = $_GET['id'];
			$reply_content = mysqli_real_escape_string($link, $_POST['reply-content']);
		}
		//Retrieve user forum signature
		$sql = 'SELECT user_profile_sig FROM user_profile WHERE user_profile_id =' . $id;

		$result = mysqli_query($link, $sql);
		if(!$result){
			echo 'Failed to retrieve forum signature';
		}
		while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
			$sig = $row['user_profile_sig'];
			//If sig is set, attach it to the post
			if(strlen($sig) > 0){
				$reply_content = $_POST['reply-content'] . '<br>------------------<br>' . $sig;
			}else{
				$reply_content = $_POST['reply-content'];
			}
		}
		
		//Sql to insert post into database
		$sql = 'INSERT INTO posts(post_content, post_date, post_topic, post_by)
				VALUES("' . $reply_content . '",NOW(),' . $id .',' . $_SESSION['user_id'] .')';
		
		$result = mysqli_query($link, $sql);
		if(!$result){
			echo 'Failed to insert post into the database!';
		}else{
			
			echo 'Your reply has been saved! Return to the <a href="topic.php?id=' . $id . '">post</a>';
		}
		
	}
}

include footer.php;