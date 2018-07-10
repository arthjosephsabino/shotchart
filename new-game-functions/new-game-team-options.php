<?php
	$host = "localhost";
    $user = "root";
    $pass = "";
    $db = "ShotChartDB";
    $errors = array();

    $con = mysqli_connect($host, $user, $pass, $db) or die("Connection Failed");


    $SelectedLeagueName = isset($_POST['SelectedLeagueName']) ? $_POST['SelectedLeagueName'] : '';

    $query = "SELECT * FROM TEAM WHERE LeagueID = (SELECT LeagueID from LEAGUE WHERE LeagueName ='".$SelectedLeagueName."'); ";
    $res = mysqli_query($con, $query);


    $result = array();
    while ($row = mysqli_fetch_array($res)) {
    	$result[] = array(
	      'name' => $row['TeamName']
	    );

    }
    
    echo json_encode($result);


?>