<!DOCTYPE html>
<?php
    $host = "localhost";
    $user = "root";
    $pass = "";
    $db = "ShotChartDB";
    $errors = array();

    $con = mysqli_connect($host, $user, $pass, $db) or die("Connection Failed");

    $SelectedLeagueName = isset($_POST['SelectedLeagueName']) ? $_POST['SelectedLeagueName'] : '';
    $SelectedLeagueID;

    $row = mysqli_query($con, "SELECT * FROM LEAGUE WHERE LeagueName='".$SelectedLeagueName."';");
    $data = mysqli_fetch_assoc($row);
    $SelectedLeagueID = $data['LeagueID'];

?>

<html class="no-js">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title></title>

        <!-- Mobile -->
        <meta name="viewport" content="width=device-width, minimum-scale=1, maximum-scale=1, user-scalable=no, minimal-ui">
        <meta name="mobile-web-app-capable" content="yes">
        <meta name="apple-mobile-web-app-capable" content="yes">
        <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">

        <!-- Favicon -->
        <link rel="shortcut icon" type="image/x-icon" href="favicon.ico">

        <!-- JS -->
        <script src="js/modernizr-2.8.3.min.js"></script>
        <script src="js/jquery-1.8.3.min.js"></script>
        <script src="js/jquery.redirect.js"></script>
        <script src="js/main.js"></script>

        <!-- Fonts -->
        
        <!-- CSS -->
        <link rel="stylesheet" href="css/reset.custom.css">
        <link rel="stylesheet" href="style.css">


    </head>

    <body>
        <!-- Body Wrapper -->
        <div class="body-wrapper">
            <!-- Main Header -->
            <header class="main-header">
                <div class="wrapper">
                    <div class="main-nav">
                        <a href="index.php" class="logo-schart float-left"></a>
                        <div class="nav-home">
                            <ul>
                                <li>
                                    <a href="index.php">home</a>
                                </li>
                                <li>
                                    <a href="index.php">help</a>
                                </li>
                            </ul>
                        </div>
                        <div class="clear"></div>
                    </div>
                    <div class="game-nav">
                        <ul>
                            <li>
                                <a href="new-game.php">new game</a>
                            </li>
                            <li>
                                <a href="load-game.php">load game</a>
                            </li>
                            <li>
                                <a href="leagues.php">leagues</a>
                            </li>
                            <li>
                                <a href="teams.php">teams</a>
                            </li>
                            <li>
                                <a href="players.php">players</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </header>
            <aside class="side-bar">
                <div class="league-options">
                    <div class="select-league-options side-bar-options text-center">
                        <ul>
                            <li>
                                <label>League Name</label>
                                <select id="select-league" name="select_league">
                                    <option value="0" disabled selected>Select League</option>
                                    <?php 
                                        $res = mysqli_query($con, "SELECT * FROM LEAGUE ORDER BY LeagueName;");

                                        while($row = mysqli_fetch_array($res)) {

                                            if($SelectedLeagueID == $row['LeagueID']) {
                                                echo "<option value='".$row['LeagueID']."' selected>".$row['LeagueName']."</option>";
                                                continue;    
                                            }
                                            echo "<option value='".$row['LeagueID']."'>".$row['LeagueName']."</option>";
                                        }
                                    ?>
                                </select>
                            </li>
                            <li>
                                <?php
                                    $rowCount = mysqli_query($con, "SELECT COUNT(*) as NumberOfGames from GAME where LeagueID='".$SelectedLeagueID."'");
                                    $data = mysqli_fetch_assoc($rowCount);
                                ?>
                                <label>
                                    Number of Games:       
                                </label>
                                <label>
                                    <?php echo $data['NumberOfGames'] ?>
                                </label>
                            </li>
                            <li>
                                <?php
                                    $rowCount = mysqli_query($con, "SELECT COUNT(*) as NumberOfTeams from TEAM where LeagueID='".$SelectedLeagueID."'");
                                    $data = mysqli_fetch_assoc($rowCount);
                                ?>
                                <label>
                                    Number of Teams: 
                                </label>
                                <label>
                                    <?php echo $data['NumberOfTeams'] ?>
                                </label>
                            </li>
                        </ul>
                    </div>
                </div>
            </aside>
            <!-- Main Content -->
            <main class="main-content">
                <section class="section-content">
                    <div class="wrapper">
                        <label>
                            Leagues
                        </label>

                        <div class="selected-league">
                            <a href="leagues.php"> <label> < Back </label></a>
                            <div class="selected-league-image text-center">
                                <?php
                                    $row = mysqli_query($con, "SELECT * FROM LEAGUE WHERE LeagueName='".$SelectedLeagueName."';");
                                    $data = mysqli_fetch_assoc($row);
                                    $SelectedLeagueID = $data['LeagueID'];
                                ?>
                                <img src="./images/leagues/<?php echo $data['Image']?>" alt="" width="200px" height="200px" />
                                <label><?php echo $data['LeagueName']?></label>

                            </div>

                            <div class="selected-league-info">
                                <div class="selected-league-games">
                                    <label>
                                        Games
                                    </label>
                                    <?php
                                        $res = mysqli_query($con, "SELECT * FROM GAME WHERE LeagueID='".$SelectedLeagueID."'");
                                        while($row = mysqli_fetch_array($res)) {
                                    ?>

                                    <div>
                                        <label><?php  echo $row['GameName']?></label>
                                    </div>
                                    <?php 
                                        } 
                                    ?>
                                </div>
                                <div class="selected-league-teams">
                                    <label>
                                        Teams
                                    </label>
                                    <?php
                                        $res = mysqli_query($con, "SELECT * FROM TEAM WHERE LeagueID='".$SelectedLeagueID."'");
                                        while($row = mysqli_fetch_array($res)) {
                                    ?>

                                    <div>
                                        <label><?php  echo $row['TeamName']?></label>
                                    </div>
                                    <?php 
                                        } 
                                    ?>
                                </div>
                                <div class="clear"></div>
                            </div>

                        </div>
                    </div>
                </section>
            </main>
            
            <!-- Main Footer -->
            <footer class="main-footer">

            </footer>

            <!-- Modal -->
            <div class="modal-overlay">

            </div>

        </div>
        
        <!-- JS -->

        <script type="text/javascript">
            $('#select-league').change(function () {
                SelectedLeagueName = $('#select-league option:selected').text();
                $.redirect("/shotchart/league-individual.php", {"SelectedLeagueName": SelectedLeagueName}); 
            });
        </script>
    </body>
</html>