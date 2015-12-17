<?php
//signup.php
include 'connect.php';
include 'header.php';

echo "<h3 class='text-center'>Register!</h3>";

if($_SERVER['REQUEST_METHOD'] != 'POST'){
	//Form hasnt been posted, echo user form
	echo '<div class="col-sm-4 col-sm-offset-4"><form class="form-vertical" method="post" action="">
		<label class="control-label" for="user_name">Username:</label>
        <input type="text" class="form-control" name="user_name" required/><br>
		<label for="Password">Password</label>
        <input  type="password" class="form-control" name="user_pass" required><br>
		<label for="user_pass_check">Confirm Password</label>
        <input  type="password" class="form-control" name="user_pass_check" required><br>
		<label for="user_email">Email:</label>
        <input  type="email" class="form-control" name="user_email" required><br>
		<div class="form-actions">
        <input type="submit" class="btn" value="Sign up!" />
		</div>
     </form></div>';	
	
}else{
	//Form has been posted, process the data
	//Store Errors in an array
	$errors = array();
	if(isset($_POST['username'])){
		//username was posted correctly
		if(!ctype_alnum($_POST['username'])){
			$errors[] = "Username contains invalid characters";
		}else if(strlen($_POST['username']) > 30){
			$errors[] = "Username greater than 30 characters";
		}
		
	}
	
	if(isset($_POST['user_pass'])){
		
		if($_POST['user_pass'] != $_POST['user_pass_check']){
			$errors[] = "The two passwords did not match";
		}
	}
	
	//Check the errors array
	if(!empty($errors)){
		foreach($errors as $key => $value){
			
			echo '<li>' . $value . '</li>';
			
		}
	}
	else
	{
		//the form has been posted without, so save it
		//notice the use of mysql_real_escape_string, keep everything safe!
		//also notice the sha1 function which hashes the password
		$sql = "INSERT INTO
                    users(user_name, user_pass, user_email ,user_date, user_level)
                VALUES('" . mysql_real_escape_string($_POST['user_name']) . "',
                       '" . sha1($_POST['user_pass']) . "',
                       '" . mysql_real_escape_string($_POST['user_email']) . "',
                        NOW(),
                        0)";
		 
		$result = mysql_query($sql);
		if(!$result)
		{
			//something went wrong, display the error
			echo 'Something went wrong while registering. Please try again later.';
			//echo mysql_error(); //debugging purposes, uncomment when needed
		}
		else
		{
			//Insert and create a record for the profile table
			$sql = 'INSERT INTO user_profile(user_profile_id, user_profile_fn, user_profile_ln, 
					user_profile_web, user_profile_sig ) VALUES('. mysql_insert_id() .', null, null, null, null)';
			$result = mysqli_query($link, $sql);
			if(!$result){
				echo 'Profile Update Failed!';
			}
			
			echo 'Successfully registered. You can now <a href="signin.php">sign in</a> and start posting! :-)';
		}
	}	
	
}
include 'footer.php';