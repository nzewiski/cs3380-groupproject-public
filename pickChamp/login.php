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

<html>
<?php
	
    include 'common.php';
    function drawError($errMsg) {
        echo '<div id="err-msg" class="ui error message">Error: '.$errMsg.'</div>';
    }
	
	session_start();

	//Redirect to content page if already logged in.
	if( isset($_SESSION["loggedInUser"] ) )
	{
		header('Location: ./');
		
	}
?>
<head>
    <title>Pick Champ &mdash; Login</title>
    <?php htmlCommonHead(); ?>
    <style type="text/css">
        body {
            background: url("/assets/img/white_wall_hash.png");
        }
        body > .grid {
            height: 100%;
        }
        .column {
            max-width: 450px;
        }
    </style>
</head>
<body>
    <div class="ui middle aligned center aligned grid">
    <div class="column">
        <h2 class="ui header">
            <div class="content">Welcome, please log in</div>
        </h2>
        <form class="ui large form" action="<?=$_SERVER['PHP_SELF']?>" method='POST'>
            <div class="ui stacked segment">
                <div class="field">
                    <div class="ui left icon input">
                        <i class="user icon"></i>
                        <input required type="text" name="username" placeholder="Username"/>
                    </div>
                </div>
                <div class="field">
                    <div class="ui left icon input">
                        <i class="lock icon"></i>
                        <input required type="password" name="password" placeholder="Password"/>
                    </div>
                </div>
                <input class="ui blue fluid large submit button" type="submit" name="submit" value="Login"/>
            </div>
        </form>
<?php	

    if(isset($_POST['submit'])) {
        //Make sure the no other record contains the same username.
        if( !accountExists() ) {
            drawError("Invalid username/password combination");
        } else {
            $link = mysqli_connect("host_name","username","password","database") or die ("Database connection failed - " . mysqli_error($link));
            $sql = "SELECT salt, hashed_password, isAdmin, userID FROM user WHERE username = UPPER(?) ";
            if ($stmt = mysqli_prepare($link, $sql)) {
                $user = $_POST['username'];
                mysqli_stmt_bind_param( $stmt, "s", $user ) or die("bind param");
                mysqli_stmt_execute($stmt);
                mysqli_stmt_bind_result($stmt, $salt, $hpass, $isAdmin, $userID);
                mysqli_stmt_store_result($stmt);
                mysqli_stmt_fetch($stmt);
            } else {
                die("MySQLi prepare failed");
            }
            mysqli_stmt_close($stmt); 
            mysqli_close($link);
            //Redirect to correct page based on login success.
            if( password_verify( $salt. $_POST["password"], $hpass ) ) {
                //Record user info.
				session_start();
                $_SESSION = array();
				$_SESSION['logged'] = 'yes';
                $_SESSION['user_id'] = $userID;
				$_SESSION['loggedInUser'] = $user;
				$_SESSION['is_admin'] = $isAdmin;
           
				//Record user login time. 
				$link = mysqli_connect("host_name","username","password","database") or die ("Database connection failed - " . mysqli_error($link));
				$sql = "INSERT INTO userLoginTimes( userID ) VALUES ( ( SELECT userID FROM user WHERE userName = ? ) ) ";
				if ($stmt = mysqli_prepare($link, $sql)) 
				{
					$user = $_SESSION['loggedInUser'];
					mysqli_stmt_bind_param( $stmt, "s", $user ) or die("bind param");
					mysqli_stmt_execute($stmt);
				} else {
					die("MySQLi prepare failed");
				}
				mysqli_stmt_close($stmt); 
				mysqli_close($link);
				
               header('Location: ./');
            } else {
                drawError("Invalid username/password combination");
            }
        }
    }
?>
        <div class="ui message">Need an account? <a href="register.php">Register here</a><hr/>
                <p>Having trouble logging in? <a href="password_reset.php">Reset your password</a>.</p>
        </div>
    </div>
    </div>
</body>
</html>

