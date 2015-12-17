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
    //Returns common html head objects, allowing site-wide changes in a single location.
    function htmlCommonHead() {
        echo '<meta charset="utf-8" />';
        echo '<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />';
        echo '<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">';
        echo '<script type="text/javascript" src="/assets/js/jquery.min.js"></script><!-- JQuery -->';
        echo '<script type="text/javascript" src="/assets/js/semantic.min.js"></script><!-- Semantic UI library -->';
        echo '<link rel="stylesheet" href="/assets/css/semantic.min.css"><!-- Semantic UI CSS -->';
    }
    //Finds whether the account username that the user is trying to sign into 
    //actually exists or not.
    function accountExists() {
		$link = mysqli_connect("host_name","username","password","database") or die ("Database connection failed - " . mysqli_error($link));				
        $sql = "SELECT COUNT(*) AS count FROM user WHERE username = UPPER(?) ";
        if ($stmt = mysqli_prepare($link, $sql)) {
            $user = $_POST['username'];		
            mysqli_stmt_bind_param($stmt, "s", $user ) or die("bind param");
            mysqli_stmt_execute($stmt);		
            mysqli_stmt_bind_result($stmt, $count);
            mysqli_stmt_store_result($stmt);
            mysqli_stmt_fetch($stmt);
        } else {
            die("prepare failed");
        }

        mysqli_stmt_close($stmt); 
        mysqli_close($link);	
        if( $count == "1" )
            return true;
        return false;
    }
?>