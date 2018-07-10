<?php
    $host = "localhost";
    $user = "root";
    $pass = "";
    $db = "ShotChartDB";
    $errors = array();

    $con = mysqli_connect($host, $user, $pass, $db) or die("Connection Failed");


    $NewLeagueName = isset($_POST['league_name']) ? $_POST['league_name'] : '';


    if(isset($_FILES['pic_league']['name'])) {
	    $target = "./../images/leagues/".basename($_FILES['pic_league']['name']);
		$image = $_FILES['pic_league']['name'];
		$query = "INSERT INTO League (LeagueName, Image) VALUES ('".$NewLeagueName."', '".$image."');";
		mysqli_query($con, $query);

		move_uploaded_file($_FILES['pic_league']['tmp_name'], $target);
    }

    header("Location: ./../leagues.php");
?>