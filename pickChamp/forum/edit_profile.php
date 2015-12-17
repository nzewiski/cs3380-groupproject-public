<?php
include 'connect.php';
include 'header.php';
	//Retrieve Profile password to use for later
	if(isset($_GET['id'])){
		$id = $_GET['id'];
	}
	
	//Update user_profile table if the form has been posted
	if($_SERVER['REQUEST_METHOD'] == 'POST'){
			//BEGIN SQL Transaction
			$result = mysqli_query("BEGIN TRANSACTION");
			if(!result){
				echo 'Profile Update Failed';
			}else{
				//Update user profile table, fn,ln, website
				$sql = 'UPDATE user_profile SET user_profile_fn="' . mysqli_real_escape_string($link,$_POST['first_name']) . '", 
						user_profile_ln="' . mysqli_real_escape_string($link, $_POST['last_name']) . '", user_profile_web="' . mysqli_real_escape_string($link, $_POST['website']) . 
				'", user_profile_sig="' . mysqli_real_escape_string($link, $_POST['signature']) . '" WHERE user_profile_id=' . $id;
				//echo $sql;
				$result = mysqli_query($link, $sql);
			
				if(!$result){
					mysqli_query("ROLLBACK");
				}else{
					//User profile table updated, update users table now
					if(isset($POST['email'])){
						$sql = "UPDATE user SET email='" . $_POST['email'] . "'";
						$result = mysqli_query($sql);
						if(!$result){
							//Update failed, rollback entire transaction
							echo 'Failed to update table!';
							mysqli_query("ROLLBACK");
						}else{
							//Table update Succeeded!
							echo '<div class="panel panel-sucess">
									<div class="panel-heading">Profile Updated Successfully</div>
									</div>';
								
							mysqli_query("COMMIT");
						}
					}else{
						//email field was not updated, commit anyway
						mysqli_query("COMMIT");
					}
				}
				
			}
			
			
		}
		


	



	
?>

<div class="col-sm-4 col-sm-offset-4">
<h1>Edit Profile</h1>
<!-- Edit Profile Form -->
		<form role="form" action="" method="POST">
			<label for="first_name">First Name</label>
			<input class="form-control" type="text" name="first_name" value="<?php ?>" placeholder="First Name"><br>
			<label for="last_name">Last name</label>
			<input class="form-control" type="text" name="last_name" placeholder="Last Name"><br>
			<label for="email">Email</label>
			<input class="form-control" type="email" name="email" placeholder="john@example.com"><br>
			<label for="website">Website</label>
			<input class="form-control" type="url" name="website" placeholder="www.cool.com"><br>	
			<label for="signature">Forum Signature</label><br>
			<input class="form-control" type="text" name="signature"><br>
			<input type="submit" class="btn" value="Submit">
		</form>	
</div>





<?php 
include 'footer.php';