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

if ($_GET['reset'] == 'true') {
	$display = '<div class="responseOk">Your password has been reset, and has been sent to you.</div><br/>';
}

if (is_array($_POST) && sizeof($_POST) > 0) {
	//create new user, disabled
	$sql = "SELECT * FROM " . DB_PREFIX . "user WHERE username='".$_POST['username']."' and email = '".$_POST['email']."';";
	$query = $mysqli->query($sql);
	if ($query->num_rows > 0) {
		$row = $query->fetch_assoc();

		//generate random password and update the db
		$password = randomString(10);
		$salt = mt_rand();
        $hpass = password_hash( $salt. $_POST['password'], PASSWORD_BCRYPT) or die("bind param");
		$sql = "update " . DB_PREFIX . "user set salt = '".$salt."', hashed_password = '".$secure_password."' where username='".$_POST['username']."' and email = '".$_POST['email']."';";
		$mysqli->query($sql) or die($mysqli->error);
	
		//send confirmation email
		$message = "Line 1\r\nLine 2\r\nLine 3";

		// In case any of our lines are larger than 70 characters, we should use wordwrap()
		$message = wordwrap($message, 70, "\r\n");

		// Send
		$mail->AddAddress($_POST['email']); // the form will be sent to this address
		$mail->Subject = 'Pick Champ\' Password'; // the subject of email

		// html text block
		$msg = '<p>Your new password for Pick Champ\' has been generated.  Your username is: ' . $result['username'] . '</p>' . "\n\n";
		$msg .= '<p>Your new password is: ' . $password . '</p>' . "\n\n";
		$msg .= '<a href="' . SITE_URL . 'login.php">Click here to sign in</a>.</p>';

		$mail->Body = $msg;
		$mail->AltBody = strip_tags($msg);

		$mail->Send();

		header('Location: password_reset.php?reset=true');
		exit;
	} else {
		$display = '<div class="responseError">No account matched, please try again.</div><br/>';
	}
	$query->free;
}
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<title>Pick Champ</title>

	<base href="<?php echo SITE_URL; ?>" />
	<link rel="stylesheet" type="text/css" media="all" href="css/bootstrap.min.css" />
	<!--link rel="stylesheet" type="text/css" media="all" href="css/all.css" /-->
	<!--link rel="stylesheet" type="text/css" media="screen" href="css/jquery.countdown.css" /-->
	<link rel="shortcut icon" href="favicon.ico" type="image/x-icon" />
	<script type="text/javascript" src="js/jquery-2.1.1.min.js"></script>
	<script type="text/javascript" src="js/bootstrap.min.js"></script>
	<script type="text/javascript" src="js/modernizr-2.7.0.min.js"></script>
	<script type="text/javascript" src="js/svgeezy.min.js"></script>
	<script type="text/javascript" src="js/jquery.main.js"></script>
	<style type="text/css">
	body { background-color: #eee; }
	.form-password-reset {
		max-width: 330px;
		padding: 15px;
		margin: 0 auto;
	}
	</style>
</head>

<body>
	<div class="container">
		<form class="form-password-reset" role="form" action="password_reset.php" method="post">
			<h2 class="form-password-reset-heading">Password Reset</h2>
			<?php if(isset($display)) echo $display; ?>
			<p>Enter your Username and email address, and a new password will be generated and sent to you.</p>
			<p><input type="text" name="username" class="form-control" placeholder="Username" required autofocus />
			<input type="email" name="email" class="form-control" placeholder="Email Address" required /></p>
			<!--label class="checkbox"><input type="checkbox" value="remember-me"> Remember me</label-->
			<p><button class="btn btn-lg btn-primary btn-block" type="submit">Submit</button></p>
			<p><a href="login.php">Log In</a></p>
		</form>

    </div> <!-- /container -->
</body>
</html>
<?php
//include('includes/footer.php');

function randomString($length) {
	// Generate random 32 charecter string
	$string = md5(time());

	// Position Limiting
	$highest_startpoint = 32-$length;

	// Take a random starting point in the randomly
	// Generated String, not going any higher then $highest_startpoint
	$randomString = substr($string,rand(0,$highest_startpoint),$length);

	return $randomString;
}
?>