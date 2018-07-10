<?php
    $host = "localhost";
    $user = "root";
    $pass = "";
    $db = "ShotChartDB";
    $errors = array();

    $con = mysqli_connect($host, $user, $pass, $db) or die("Connection Failed");

    $SelectedLeagueName = isset($_POST['SelectedLeagueName']) ? $_POST['SelectedLeagueName'] : '';
    $SelectedHomeName = isset($_POST['SelectedHomeName']) ? $_POST['SelectedHomeName'] : '';
    $SelectedAwayName = isset($_POST['SelectedAwayName']) ? $_POST['SelectedAwayName'] : '';
    $SelectedGameName = isset($_POST['SelectedGameName']) ? $_POST['SelectedGameName'] : '';


    //insert game
    $query = "SELECT LeagueID FROM LEAGUE WHERE LeagueName='".$SelectedLeagueName."'";
    $res = mysqli_query($con, $query);
    $row = mysqli_fetch_assoc($res);
    $SelectedLeagueID = $row['LeagueID'];

    $query = "SELECT TeamID FROM TEAM WHERE TeamName='".$SelectedHomeName."'";
    $res = mysqli_query($con, $query);
    $row = mysqli_fetch_assoc($res);
    $SelectedHomeTeamID = $row['TeamID'];

    $query = "SELECT TeamID FROM TEAM WHERE TeamName='".$SelectedAwayName."'";
    $res = mysqli_query($con, $query);
    $row = mysqli_fetch_assoc($res);
    $SelectedAwayTeamID = $row['TeamID'];

    $query = "INSERT INTO game (LeagueID, TeamHomeID, TeamAwayID, GameName)
						VALUES ('$SelectedLeagueID', '$SelectedHomeTeamID', '$SelectedAwayTeamID', '$SelectedGameName')";
	mysqli_query($con, $query);

    $query = "SELECT GameID FROM GAME WHERE GameName='".$SelectedGameName."'";
    $res = mysqli_query($con, $query);
    $row = mysqli_fetch_assoc($res);
    $SelectedGameID = $row['GameID'];
    session_start();

    $_SESSION['SelectedLeagueID'] = $SelectedLeagueID;
    $_SESSION['SelectedLeagueName'] = $SelectedLeagueName;

    $_SESSION['SelectedHomeName'] = $SelectedHomeName;
    $_SESSION['SelectedHomeTeamID'] = $SelectedHomeTeamID;
    
    $_SESSION['SelectedAwayName'] = $SelectedAwayName;
    $_SESSION['SelectedAwayTeamID'] = $SelectedAwayTeamID;
    
    $_SESSION['SelectedGameName'] = $SelectedGameName;
    $_SESSION['SelectedGameID'] = $SelectedGameID;

	header('Location: ./../in-game.php');
?>