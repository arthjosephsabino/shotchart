<?php
    $host = "localhost";
    $user = "root";
    $pass = "";
    $db = "ShotChartDB";
    $errors = array();

    $con = mysqli_connect($host, $user, $pass, $db) or die("Connection Failed");



    $SelectedLeagueID = isset($_POST['select_league']) ? $_POST['select_league'] : '';
    $NewTeamName = isset($_POST['team_name']) ? $_POST['team_name'] : '';
    $NewTeamID='';

    if(isset($_FILES['pic_team']['name'])) {
    	$target = "./../images/teams/".basename($_FILES['pic_team']['name']);
    	$image = $_FILES['pic_team']['name'];
    	$query = "INSERT INTO TEAM (LeagueID, TeamName, Image) VALUES ('".$SelectedLeagueID."', '".$NewTeamName."', '".$image."');";
    	mysqli_query($con, $query);

    	$query = "SELECT LAST_INSERT_ID()";
    	$res = mysqli_query($con, $query);
    	$data = mysqli_fetch_assoc($res);
    	$NewTeamID = $data['LAST_INSERT_ID()'];

    	move_uploaded_file($_FILES['pic_team']['tmp_name'], $target);
    }

    
    for ($i=0; $i < count($_FILES['player_pic_team']['name']); $i++) { 
    	$target = "./../images/players/".basename($_FILES['player_pic_team']['name'][$i]);
    	$image = $_FILES['player_pic_team']['name'][$i];

    	$query = "INSERT INTO PLAYER (TeamID, PlayerName, JerseyNumber, Image) VALUES ('".$NewTeamID."', '".$_POST['player_name'][$i]."', '".$_POST['jersey_number'][$i]."', '".$_FILES['player_pic_team']['name'][$i]."');";
    	mysqli_query($con, $query);

    	move_uploaded_file($_FILES['player_pic_team']['tmp_name'][$i], $target);
    }
    header("Location: ./../teams.php");
    
?>