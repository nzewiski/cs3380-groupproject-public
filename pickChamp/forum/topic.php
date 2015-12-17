<?php
include 'connect.php';
include 'header.php';
session_start();
if(isset($_GET['id'])){
	$id = $_GET['id'];
}

$sql = 'SELECT topic_id, topic_subject FROM topics WHERE topics.topic_id="' . $id . '"';


$postsql = 'SELECT  posts.post_id, posts.post_topic, posts.post_content, posts.post_date, posts.post_by, user.userID, user.username
		FROM posts LEFT JOIN user ON posts.post_by = user.userID
		WHERE posts.post_topic="' . $id . '"';

$result = mysqli_query($link, $sql);
if(!$result){
	echo 'Topic view Query Failed!';
}else{
	
	//Prepare the table to show the subject of the topic
	echo '<div class="col-sm-8 col-sm-offset-2"><table class="table table-striped table-bordered">';
	while($row = mysqli_fetch_array($result, MYSQLI_BOTH )){
		echo '<tr><th  colspan="2" class="text-center">' . $row['topic_subject'] . '</th></tr>';	
	}
	//Query database for post content
	$result = mysqli_query($link, $postsql);
	while($row = mysqli_fetch_array($result, MYSQLI_BOTH)){

		echo '<tr>';
		//User table cell
		echo '<td style="width:15%; text-align: center;">';
		//Link to user profile, 
		echo '<span class="glyphicon glyphicon-user"></span><a href="profile.php?id=' . $row['userID'] . '"> ' . $row['username'] .'</a>'; 
		echo '<br>Posts<br><div class="post_count">' . post_count($row['userID']) . '</div><div class="post_time">';
		//Format Date
		$date = new DateTime($row['post_date']);
		$formatDate = $date->format('Y-M-D H:I:s');
		echo $formatDate;
		echo '</div></td>';
		//Post table cell
		echo '<td style="width:100%;">';
		//Show a Delete button, only if the post is that users, or the post is an admin
		if($row['post_by'] == $_SESSION['loggedInUser'] || $_SESSION['isAdmin'] == 'yes'){
			echo '<a  title="Delete Post" href="delete_post.php?id=' . $row['post_id'] . '&topic=' .$row['post_topic'] .'">
					<span class="pull-right glyphicon glyphicon-remove-circle"></span></a><a  title="Edit Post" href="edit_post.php?edit=' . $row['post_id'] . '"> 
							<span class="pull-right glyphicon glyphicon-pencil"></span></a><br>';
		}
		
		echo $row['post_content'];
		echo '</td>';
		echo '</tr>';		
		$postCount += 1;
	}
    mysqli_free_result($result);
	echo '</table>';
	if($_SESSION['logged']){
		echo '<form class="form" method="post" action="reply.php?id=' . $id . '">';
		echo '<textarea  class="form-control"name="reply-content" cols="60" rows="10"></textarea><br>';
		echo '<input title="Reply" type="submit" class="btn-primary" value="Reply"></form>';
	}else{
		echo '<p class="text-muted">Please Login to Post</p>';
	}

	echo '</div>';
	
}

function post_count($id){
// 	$sql = 'SELECT COUNT(post_by) as post_count FROM posts WHERE post_by =' . $id;
// 	$result = mysqli_query($link, $sql);
// 	if(!$result){
// 		echo 'post count failed';
// 	}
// 	if($row = mysqli_fetch_array($result, MYSQLI_BOTH)){
// 		return $row['post_count'];
// 	}
	
}

include 'footer.php';
