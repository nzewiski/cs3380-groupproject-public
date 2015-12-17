<?php
include 'connect.php';
include 'header.php';
//Profile.php page displayed when clicking on user profile link from a forum post
//Set the user ID for use in SQL 
if(isset($_GET['id'])){
	$id = $_GET['id'];
	//echo 'Welcome user #:' . $id;
}

//Display profile for the GET $id variable even if user 'owns' the profile
if($id){
	//Get Profile data from database
	$sql = 'SELECT user.email, user.username, user.isAdmin, 
			user.firstname, user.lastname, user_profile.user_profile_web, 
			user_profile.user_profile_sig FROM user_profile RIGHT JOIN user ON user.userID = user_profile.user_profile_id 
			WHERE user.userID=' . $id;
	$result = mysqli_query($link, $sql);
	if(!$result){
		echo 'Mysql Query Failed!';
	}
	
	//Store variables, and output data in formatted page
	while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
		$email = $row['email'];
		$name = $row['username'];
		$level = $row['isAdmin'];
		$fn = $row['firstname'];
		$ln = $row['lastname'];
		$website = $row['user_profile_web'];	
	}
	
}
?>
<!-- Begin HTML Formatting -->
<div class="row">
	<div class="text-centered"><h1><?php echo $name ?>'s Profile</h1></div>
</div>
<div class="row">
	<!-- Left Column -->
	<div class="col-sm-3 col-sm-offset-4">
		<ul class="list-group">
			<li class="list-group-item text-muted">Profile</li>
				<li class="list-group-item"><span><strong>Name: </strong><?php echo $fn . ' ' . $ln; ?></span></li>
				<li class="list-group-item"><span><strong>Email: </strong><?php echo $email; ?></span></li>				
				<li class="list-group-item"><strong>Access Level: </strong><?php if($level == 'F'){ echo 'Regular User';}else echo 'Admin'?></li>
		</ul>
		
		<div class="panel panel-default">
			<div class="panel-heading">Website <span class="glyphicon glyphicon-sunglasses"></span></i></div>
			<div class="panel-body"><a href="<?php echo $website;?>"><?php echo $website;?></a></div>
		</div>
	
	</div>
</div>


<?php 
include 'footer.php';

