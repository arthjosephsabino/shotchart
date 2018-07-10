<!DOCTYPE html>
<?php
    $host = "localhost";
    $user = "root";
    $pass = "";
    $db = "ShotChartDB";
    $errors = array();

    $con = mysqli_connect($host, $user, $pass, $db) or die("Connection Failed");


?>
<!DOCTYPE html>
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
                <div class="player-options">
                    <div class="select-player-options side-bar-options text-center">
                        <ul>
                            <li>
                                <label>Player Name</label>
                                <select id="select-player" name="select_player">
                                    <option value="0" disabled selected>Select Player</option>
                                    <?php 
                                        $res = mysqli_query($con, "SELECT * FROM PLAYER ORDER BY PlayerName;");
                                        while($row = mysqli_fetch_array($res)) {
                                            echo "<option value='".$row['PlayerID']."'>".$row['PlayerName']."</option>";
                                        }
                                    ?>
                                </select>
                            </li>
                        </ul>
                    </div>
                </div>
            </aside>
            <!-- Main Content -->
            <main class="main-content">
                <section class="section-content player-options">
                    <div class="wrapper">
                        <label>
                            Players
                        </label>
                        <div class="players">
                            <?php
                                $res = mysqli_query($con, "SELECT * FROM PLAYER ORDER BY PlayerName;");

                                while($row = mysqli_fetch_array($res)) {
                            ?>
                                <div data-player-id="<?php echo $row['PlayerID'];?>" >
                                    <img src="./images/players/<?php echo $row['Image']?>" width="100px" height="100px"/>
                                    <div class="player-name">
                                        <label>
                                            Name:
                                        </label>
                                        <label>
                                             <?php echo $row['PlayerName']?>
                                        </label>
                                    </div>
                                    <div class="player-team">
                                        <?php
                                            $rowTeam = mysqli_query($con, "SELECT TeamName FROM TEAM WHERE TeamID=".$row['TeamID']);
                                            $data = mysqli_fetch_assoc($rowTeam);
                                        ?>
                                        <label>
                                            Team:       
                                        </label>
                                        <label>
                                            <?php echo $data['TeamName'] ?>
                                        </label>
                                    </div>
                                </div>
                            <?php 
                                }
                            ?>
                            <div class="clear"></div>   
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
            var SelectedPlayerID;
            $('.players > div:not(:last-child)').click( function(e) {
                SelectedPlayerID = $(this).data("player-id");
                $.redirect("/shotchart/player-individual.php", {"SelectedPlayerID": SelectedPlayerID});
            });

            $('#select-player').change(function() {
                SelectedPlayerID = $('#select-player option:selected').val();
                $.redirect("/shotchart/player-individual.php", {"SelectedPlayerID": SelectedPlayerID});
            });

        </script>
    </body>
</html>