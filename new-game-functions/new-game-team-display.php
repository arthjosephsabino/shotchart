<?php
	$host = "localhost";
    $user = "root";
    $pass = "";
    $db = "ShotChartDB";
    $errors = array();

    $con = mysqli_connect($host, $user, $pass, $db) or die("Connection Failed");



    $SelectedTeamName = isset($_POST['SelectedTeamName']) ? $_POST['SelectedTeamName'] : '';

    $query = "SELECT * FROM PLAYER WHERE TeamID = (SELECT TeamID from TEAM WHERE TeamName ='".$SelectedTeamName."'); ";
    $res = mysqli_query($con, $query);

    while($row = mysqli_fetch_array($res)) {
    	echo "<div class='ui-state-default'>";
        echo "<img src='./images/players/".$row['Image']."' height='150' width='150'>";
        echo "<div>";
        echo "<label>".$row['PlayerName']."</label>";
        echo "<label>".$row['JerseyNumber']."</label>";
        echo "</div>";
        echo "<div class='clear'></div>";
        echo "</div>";
    }
?>