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
	if (!isset($_SERVER['HTTPS']) || !$_SERVER['HTTPS']) { // if request is not secure, redirect to secure url
	   $url = 'https://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
	   header('Location: ' . $url);
	}

	session_start();

	//Redirect to login page if not already logged in.
	if( !isset($_SESSION["username"] ) )
	{
		header( 'Location: login.php' );
	}

	//Redirect to admin page if the user is an admin.
	if( $_SESSION["isAdmin"] == "T" )
	{
		header( 'Location: adminContent.php' );
	}
?>

<html>
	<head>
		<!-- USE BOOTSTRAP BECAUSE IT MAKES FORMATTING/LIFE EASIER -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css"><!-- Latest compiled and minified CSS -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css"><!-- Optional theme -->
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script><!-- Latest compiled and minified JavaScript -->
	</head>
	<body>	
		
		<?php
			
			echo " <h1><center>Welcome, " . $_SESSION["username"] . "!</center></h1>";
			
			if( isset( $_POST["logout"] ) )
			{
				session_unset();
				session_destroy();
				header( 'Location: login.php' );
			}
		?>
		
		<!-- Log out button -->
		<div class="container">
			<div class="row">
				<div class="col-md-4 col-sm-4 col-xs-6">
					<form action="<?=$_SERVER['PHP_SELF']?>" method="POST">
						<div class="row form-group">
							<input class=" btn btn-info" type="submit" name="logout" value="LOG OUT"/>
						</div>
					</form>
				</div>
			</div>
		</div>
	</body>
</html>
	
