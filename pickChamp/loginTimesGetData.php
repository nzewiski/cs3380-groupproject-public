<?php

    $link = mysqli_connect("host_name","username","password","database") 
		or die ("Database connection failed - " . mysqli_error($link));

    $sql = "
    SELECT SUBSTRING( login_time, 12, 2 ) AS hour_UTC0, COUNT(*) as count FROM userLoginTimes NATURAL JOIN user 
	WHERE isAdmin = 'F' GROUP BY hour_UTC0 ORDER BY hour_UTC0;
    ";

    if ($result = mysqli_query($link, $sql)) {

		$data = array();
		
		for( $i = 0; $i < 24; $i++ )
		{
			$data[$i] = array (
				"hour_UTC0" => $i,
				"count" => 0,
			);
		}

		while( $row = mysqli_fetch_assoc($result) ){
			$data[ $row["hour_UTC0"] + 0 ] = $row;
		}

		echo json_encode($data);     	
	
	} else {
		echo "fail";
		die("MySQLi prepare failed");
	}
	 
    mysqli_close($link);
?>
