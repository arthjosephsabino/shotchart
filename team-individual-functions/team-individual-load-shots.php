<?php
    $host = "localhost";
    $user = "root";
    $pass = "";
    $db = "ShotChartDB";
    $errors = array();

    $con = mysqli_connect($host, $user, $pass, $db) or die("Connection Failed");


    $SelectedTeamID = isset($_POST['SelectedTeamID']) ? $_POST['SelectedTeamID'] : '';
    $SelectedGameID = isset($_POST['SelectedGameID']) ? $_POST['SelectedGameID'] : '';
    $ShotChartX = isset($_POST['ShotChartX']) ? (int)$_POST['ShotChartX'] : 0;
    $ShotChartY = isset($_POST['ShotChartY']) ? (int)$_POST['ShotChartY'] : 0;
    $CurrentQuarter = isset($_POST['CurrentQuarter']) ? (int)$_POST['CurrentQuarter'] : 1;

    $query = "SELECT * from shot 
				INNER JOIN PLAYER ON shot.PlayerID = player.PlayerID
				INNER JOIN TEAM ON player.TeamID = team.TeamID WHERE Team.TeamID='".$SelectedTeamID."' AND shot.GameID ='".$SelectedGameID."' AND shot.QuarterShot='".$CurrentQuarter."';";

	$res = mysqli_query($con, $query);

	// echo "<div>".$query."</div>";
	
	while($row = mysqli_fetch_array($res)) {
		$ShotX = (int)$ShotChartX + (int)$row['XCLCoordinate'];
		$ShotY = (int)$ShotChartY + (int)$row['YCLCoordinate'];

		echo "<div style=";
		echo '"';
	    echo "position: absolute; ";
	    echo "left: ".$ShotX."px; ";
	    echo "top: ".$ShotY."px; ";
	    echo "width: 10px; ";
	    echo "height: 10px; ";
	    if ($row["MadeShot"] == "true") {
	    	echo "background: url('./../shotchart/images/oMark.png')";
	    } else if ($row["MadeShot"] == "false"){
	    	echo "background: url('./../shotchart/images/xMark.png')";
	    }
	    echo '" ';
	    echo "data-shot-coordinate-x='".(int)$row['XCLCoordinate']."' ";
	    echo "data-shot-coordinate-y='".(int)$row['YCLCoordinate']."' ";
	    if ($row["MadeShot"] == "true") {
	    	echo "data-made-shot='true' ";
	    } else if ($row["MadeShot"] == "false"){
	    	echo "data-made-shot='false' ";
	    }
	    echo ">";
	    echo "</div>";
	}
?>