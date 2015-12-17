<?php
include 'connect.php';
include 'header.php';

 
if($_SESSION['logged'] != 'yes' || !isset($_SESSION['user_id'])){
	
	echo 'User not signed in!';
}
else{
	//Form hasnt been posted
	if($_SERVER['REQUEST_METHOD'] != 'POST'){
		//Retrieve Categories from database
		$sql = "SELECT * FROM categories";
		$result = mysqli_query($link, $sql);
		if(!$result){
			echo 'Error querying Database!';	
		}else{
			
			//Code for 0 categories
			if(mysqli_num_rows($result) == 0){
				if($_SESSION['isAdmin'] == 'yes'){
					echo 'No Categories Created!';
				}else{
					echo 'Wait for the admin to create some categories!';
				}
				
			}else{
				//Code to handle topic creation
				echo '<div class="col-sm-4 col-sm-offset-4 centered"><h2 class="text-center">Create a topic!</h2>
                        <form method="post" action="" class="form">
						<label for="subject">Topic Subject</label>
						<input type="text" name="subject" class="form-control" required/>
						<label class="control-label"for="category">Choose a category</label>';
				echo '<select name="category" class="form-control" required/>';
				while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
					
					echo '<option value="' . $row['cat_id'] . '">' . $row['cat_name'] . '</option>';
				}
				echo '</select>';
				echo '<label for="post-content">Post Body</label>
					   <textarea  rows="15"name="post-content" class="form-control"></textarea><br>
						<div class="form-actions">
						<input type="submit" value="Submit" class="btn"/></form></div></div>';
			}
		}
		
	}else if($_SERVER['REQUEST_METHOD'] == 'POST'){
	//Form has been posted, time for some crazy sql
	$query = "BEGIN WORK";
	$result = mysqli_query($link, $query);
		
		if(isset($_POST['subject']) && isset($_POST['category'])){
			$post_topic = mysqli_real_escape_string($link, $_POST['subject']);
			$post_cat = $_POST['category'];
				
		}
	
	if(!$result){
		echo 'Failed to start transaction!, come back later';
	}else{
		//Query was successful time to unloc
		$sql = 'INSERT INTO topics(topic_subject, topic_date, topic_cat, topic_by) VALUES("' . $post_topic . '", NOW(),
		' . $post_cat . ',' . $_SESSION['user_id'] . ')';
		$result = mysqli_query($link, $sql);
		if(!$result){
			//Query Failed, rollback transaction
			echo 'Failed to insert post into the database, please try again later!';
			$sql = 'ROLLBACK';
			$result = mysqli_query($link, $sql);
		}else{
			//Successfully updated topic table, now update posts
			$post_content = mysqli_real_escape_string($link, $_POST['post-content']);
			$topic_id = mysqli_insert_id($link);
			
			$sql = 'INSERT INTO posts(post_content, post_date, post_topic, post_by) VALUES("' . $post_content . '", NOW(),
			' . $topic_id . ',' . $_SESSION['user_id'] . ')';
			
			$result = mysqli_query($link, $sql);
			if(!$result){
				echo 'An error occured while adding your post to the database!';
				$sql = 'ROLLBACK';
				$result = mysqli_query($link, $sql);
			}else{
				$sql = 'COMMIT';
				$result = mysqli_query($link, $sql);
				echo 'Post completed successfully!';
				
			}
		}
		
	}
}
}
include 'footer.php';