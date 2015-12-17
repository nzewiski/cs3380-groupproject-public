<?php

	session_start();
	
	if( !isset($_SESSION["favTeamState"]) )
		$_SESSION["favTeamState"] = "ALL";

    $link = mysqli_connect("host_name","username","password","database") 
		or die ("Database connection failed - " . mysqli_error($link));

	if( $_SESSION["favTeamState"] == "ALL" )
	{
		$sql = "
			SELECT teamID as teamName, COUNT(pickID) as count FROM picks RIGHT OUTER JOIN teams ON ( picks.pickID = teams.teamID ) GROUP BY teamID;
			";
	}
	else
	{
		$sql = "
			SELECT teamID as teamName, COUNT(gameID) as count FROM  picks RIGHT OUTER JOIN teams ON ( picks.pickID = teams.teamID ) "
			. "WHERE picks.userID IN ( "
			. " SELECT userID FROM user WHERE loc_state = '" . $_SESSION["favTeamState"] . "' )"
			. " GROUP BY teamName;
			";
	}

    if ($result = mysqli_query($link, $sql)) {

		while( $row = mysqli_fetch_assoc($result) ){
			$data[] = $row;
		}

		echo json_encode($data);     	
	
	} else {
		echo "fail";
		die("MySQLi prepare failed");
	}
	 
    mysqli_close($link);
?>
