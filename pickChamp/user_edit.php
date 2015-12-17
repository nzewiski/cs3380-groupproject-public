<!--
Copyright (c) <2015> < Alain Chen, James Barksdale, Khalen Fredieu, Colin Stevens, Nick Zewiski>


Permission is hereby granted, free of charge, to any person obtaining a copy of this software and 
associated documentation files (the "Software"), to deal in the Software without restriction, 
including without limitation the rights to use, copy, modify, merge, publish, distribute, 
sublicense, and/or sell copies of the Software, and to permit persons to whom 
the Software is furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all copies 
or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, 
INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR 
PURPOSE AND NONINFRINGEMENT.  IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE 
FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, 
ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
-->

<?php
require('includes/application_top.php');

include('includes/classes/class.formvalidation.php');

if (isset($_POST['submit'])) {
	$my_form = new validator;
	$mail = new PHPMailer();

	if($my_form->checkEmail($_POST['email'])) { // check for good mail

		if ($my_form->validate_fields('firstname,lastname,email,password')) { // comma delimited list of the required form fields
			if ($_POST['password'] == $_POST['password2']) {
				$salt = mt_rand();
                $hpass = password_hash( $salt. $_POST['password'], PASSWORD_BCRYPT) or die("bind param");
				$sql = "update " . DB_PREFIX . "user ";
				$sql .= "set hashed_password = '".$hpass."', salt = '".$salt."', firstname = '".$_POST['firstname']."', lastname = '".$_POST['lastname']."', email = '".$_POST['email']."' ";
				$sql .= "where userID = " . $user->userID . ";";
				//die($sql);
				$mysqli->query($sql) or die($mysqli->error);

				//set confirmation message
				$display = '<div class="responseOk">Account updated successfully.</div><br/>';
			} else {
				$display = '<div class="responseError">Passwords do not match, please try again.</div><br/>';
			}
		} else {
			$display = str_replace($_SESSION['email_field_name'], 'Email', $my_form->error);
			$display = '<div class="responseError">' . $display . '</div><br/>';
		}
	} else {
		$display = '<div class="responseError">There seems to be a problem with your email address, please check.</div><br/>';
	}
}

include('includes/header.php');

$sql = "select * from " . DB_PREFIX . "user where userID = " . $user->userID;
$query = $mysqli->query($sql);
if ($query->num_rows > 0) {
	$row = $query->fetch_assoc();
	$firstname = $row['firstname'];
	$lastname = $row['lastname'];
	$email = $row['email'];
}

if (!empty($_POST['firstname'])) $firstname = $_POST['firstname'];
if (!empty($_POST['lastname'])) $lastname = $_POST['lastname'];
if (!empty($_POST['email'])) $email = $_POST['email'];
?>
	<h1>Edit User Account Details</h1>
	<?php if(isset($display)) echo $display; ?>
	<form action="user_edit.php" method="post" name="edituser">
		<fieldset>
		<legend style="font-weight:bold;">Enter User Details:</legend>
			<p>First Name:<br />
			<input type="text" name="firstname" value="<?php echo $firstname; ?>"></p>

			<p>Last Name:<br />
			<input type="text" name="lastname" value="<?php echo $lastname; ?>"></p>

			<p>Email:<br />
			<input type="text" name="email" value="<?php echo $email; ?>" size="30"></p>

			<p>New Password:<br />
			<input type="password" name="password" value=""></p>

			<p>Confirm Password:<br />
			<input type="password" name="password2" value=""></p>

			<p><input type="submit" name="submit" value="Submit" class="btn btn-primary"></p>
		</fieldset>
	</form>
<?php
include('includes/footer.php');
