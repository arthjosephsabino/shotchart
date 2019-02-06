<?php
    $host = "localhost";
    $user = "root";
    $pass = "";
    $db = "ShotChartDB";
    $errors = array();

    $con = mysqli_connect($host, $user, $pass, $db) or die("Connection Failed");

    session_start();

    $SelectedLeagueID = isset($_SESSION['SelectedLeagueID']) ? $_SESSION['SelectedLeagueID'] : '';
    $SelectedLeagueName = isset($_SESSION['SelectedLeagueName']) ? $_SESSION['SelectedLeagueName'] : '';
    $SelectedHomeName = isset($_SESSION['SelectedHomeName']) ? $_SESSION['SelectedHomeName'] : '';
    $SelectedHomeTeamID = isset($_SESSION['SelectedHomeTeamID']) ? $_SESSION['SelectedHomeTeamID'] : '';
    $SelectedAwayName = isset($_SESSION['SelectedAwayName']) ? $_SESSION['SelectedAwayName'] : '';
    $SelectedAwayTeamID = isset($_SESSION['SelectedAwayTeamID']) ? $_SESSION['SelectedAwayTeamID'] : '';
    $SelectedGameName = isset($_SESSION['SelectedGameName']) ? $_SESSION['SelectedGameName'] : '';
    $SelectedGameID = isset($_SESSION['SelectedGameID']) ? $_SESSION['SelectedGameID'] : '';
    
    

    $ScoreHome = isset($_POST['ScoreHome']) ? $_POST['ScoreHome'] : '';
    $ScoreAway = isset($_POST['ScoreAway']) ? $_POST['ScoreAway'] : '';
    $CurrentQuarter = isset($_POST['CurrentQuarter']) ? $_POST['CurrentQuarter'] : '';
    $TeamHomePlayers = isset($_POST['TeamHomePlayers']) ? $_POST['TeamHomePlayers'] : '';
    $TeamAwayPlayers = isset($_POST['TeamAwayPlayers']) ? $_POST['TeamAwayPlayers'] : '';

    $query = "UPDATE game SET ScoreHome='$ScoreHome', ScoreAway='$ScoreAway', Quarter='$CurrentQuarter'
					WHERE GameID='$SelectedGameID';";
	mysqli_query($con, $query);

	foreach($TeamHomePlayers as $homePlayer) {
		$query = "SELECT PlayerID from player WHERE TeamID=$SelectedHomeTeamID AND PlayerName='".$homePlayer['name']."' AND JerseyNumber ='".$homePlayer['jerseyNumber']."';";
		$row = mysqli_fetch_row(mysqli_query($con,$query));

		$PlayerID = $row[0];
			
		$query = "INSERT INTO playerstat(PlayerID, GameID, Points, Field_Goals_Made, Field_Goals_Attempted, Three_Points_Made, Three_Points_Attempted, Free_Throws_Made, Free_Throws_Attempted, Field_Goal_Percentage, Three_Point_Percentage, Efficient_FG_Percentage, True_Shot_Percentage) VALUES (
									'$PlayerID', '$SelectedGameID', '".$homePlayer['stats']['points']."', '".$homePlayer['stats']['fgm']."', '".$homePlayer['stats']['fga']."',
									'".$homePlayer['stats']['threepm']."', '".$homePlayer['stats']['threepa']."', '".$homePlayer['stats']['ftm']."', '".$homePlayer['stats']['fta']."', '".$homePlayer['stats']['fgper']."', '".$homePlayer['stats']['threeper']."', '".$homePlayer['stats']['eFgper']."', '".$homePlayer['stats']['tsper']."'); ";
		$result = mysqli_query($con, $query);

			if(isset($homePlayer["shots"])) {
				foreach ($homePlayer["shots"] as $shot) {
					$query = "INSERT INTO shot(PlayerID, GameID, XCoordinate, YCoordinate, XCLCoordinate, YCLCoordinate, TimeShot, QuarterShot, PointsShot, MadeShot) VALUES ('$PlayerID', '$SelectedGameID', '".$shot['x']."', '".$shot['y']."', '".$shot['relX']."', '".$shot['relY']."','".$shot['time']."', '".$shot['quarter']."', '".$shot['points']."', '".$shot['made']."');";

					$result = mysqli_query($con, $query);
				}
			}

			if (isset($homePlayer["ftshots"])) {
				foreach ($homePlayer["ftshots"] as $ftshot) {
					$query = "INSERT INTO ftshot(PlayerID, GameID, Timeshot, QuarterShot, PointsShot, MadeShot) VALUES ('".$PlayerID."', '".$SelectedGameID."', '".$ftshot['time']."', '".$ftshot['quarter']."', '".$ftshot['points']."', '".$ftshot['made']."');";
					$result = mysqli_query($con, $query);
				}			
			}
	}


	foreach($TeamAwayPlayers as $awayPlayer) {
		$query = "SELECT PlayerID from player WHERE TeamID=$SelectedAwayTeamID AND PlayerName='".$awayPlayer['name']."' AND JerseyNumber ='".$awayPlayer['jerseyNumber']."';";
		$row = mysqli_fetch_row(mysqli_query($con,$query));

		$PlayerID = $row[0];
			
		$query = "INSERT INTO playerstat(PlayerID, GameID, Points, Field_Goals_Made, Field_Goals_Attempted, Three_Points_Made, Three_Points_Attempted, Free_Throws_Made, Free_Throws_Attempted, Field_Goal_Percentage, Three_Point_Percentage, Efficient_FG_Percentage, True_Shot_Percentage) VALUES (
									'$PlayerID', '$SelectedGameID', '".$awayPlayer['stats']['points']."', '".$awayPlayer['stats']['fgm']."', '".$awayPlayer['stats']['fga']."',
									'".$awayPlayer['stats']['threepm']."', '".$awayPlayer['stats']['threepa']."', '".$awayPlayer['stats']['ftm']."', '".$awayPlayer['stats']['fta']."', '".$awayPlayer['stats']['fgper']."', '".$awayPlayer['stats']['threeper']."', '".$awayPlayer['stats']['eFgper']."', '".$awayPlayer['stats']['tsper']."'); ";
		$result = mysqli_query($con, $query);

			if(isset($awayPlayer["shots"])) {
				foreach ($awayPlayer["shots"] as $shot) {
					$query = "INSERT INTO shot(PlayerID, GameID, XCoordinate, YCoordinate, XCLCoordinate, YCLCoordinate, TimeShot, QuarterShot, PointsShot, MadeShot) VALUES ('$PlayerID', '$SelectedGameID', '".$shot['x']."', '".$shot['y']."', '".$shot['relX']."', '".$shot['relY']."','".$shot['time']."', '".$shot['quarter']."', '".$shot['points']."', '".$shot['made']."');";

					$result = mysqli_query($con, $query);
				}
			}

			if (isset($awayPlayer["ftshots"])) {
				foreach ($awayPlayer["ftshots"] as $ftshot) {
					$query = "INSERT INTO ftshot(PlayerID, GameID, Timeshot, QuarterShot, PointsShot, MadeShot) VALUES ('".$PlayerID."', '".$SelectedGameID."', '".$ftshot['time']."', '".$ftshot['quarter']."', '".$ftshot['points']."', '".$ftshot['made']."');";
					$result = mysqli_query($con, $query);
				}			
			}
	}

	$_POST['SelectedLeagueID'] = $SelectedLeagueID;
    $_POST['SelectedLeagueName'] = $SelectedLeagueName;
    $_POST['SelectedHomeName'] = $SelectedHomeName;
    $_POST['SelectedHomeTeamID'] = $SelectedHomeTeamID;
    $_POST['SelectedAwayName'] = $SelectedAwayName;
    $_POST['SelectedAwayTeamID'] = $SelectedAwayTeamID;
    $_POST['SelectedGameName'] = $SelectedGameName;
    $_POST['SelectedGameID'] = $SelectedGameID;

    echo "a";
	header("Location: ./../load-game.php");

?>