<?php 
include 'connect.php';
include 'header.php';

if(isset($_GET['edit'])){
	//edit was called, saved post id
	$post_id = $_GET['edit'];
	/**
	 * Retrieve Post Content, output value to textarea form
	 * 
	 */
	$sql = 'SELECT post_content, post_topic, post_by FROM posts WHERE post_id =' . $post_id;
	$results = mysql_query($sql);
	if(!$results){
		echo 'Query Failed!';
		echo $sql;
	}else{
		if($row = mysql_fetch_assoc($results)){
			$post_content = $row["post_content"];
			$post_topic = $row['post_topic'];
			$post_by = $row['post_by'];
		}
	}
	
}else if($_SERVER['REQUEST_METHOD'] == 'POST'){
	//Script was posted from itsself
	$sql = 'UPDATE posts SET post_content="' . mysql_real_escape_string($_POST['post_content']) . '" WHERE 
			post_id=' . $_POST['post_id'];
	$results = mysql_query($sql);		
	if(!$results){
		echo 'Update Failed! ';
		echo $sql;
		
	}else{
		//Send user back to their profile
		header("Location: topic.php?id=" . $_POST['post_topic']);
	}
}



?>

<div class="row">
	<h1>Edit Post</h1>
	<form  method="POST" action="edit_post.php">
	<div class="col-sm-8 col-sm-offset-2">
		<textarea rows="8"class="form-control" name="post_content" required><?php echo $post_content;?></textarea><br>
		<input type="hidden" name="post_id" value="<?php echo $post_id;?>" >
		<input type="hidden" name="post_topic" value="<?php echo $post_topic;?>" >
		<input type="submit" value="Edit Post">
	</div>
	</form>

</div>