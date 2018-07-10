<!DOCTYPE html>
<?php
    $host = "localhost";
    $user = "root";
    $pass = "";
    $db = "ShotChartDB";
    $errors = array();

    $con = mysqli_connect($host, $user, $pass, $db) or die("Connection Failed");


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
                                            echo "<option value='".$row['LeagueName']."'>".$row['LeagueName']."</option>";
                                        }
                                    ?>
                                </select>
                            </li>
                            <li>
                                <button class="add-league-button menu-button">add league</button>
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
                        <div class="leagues">
                            <?php
                                $res = mysqli_query($con, "SELECT * FROM LEAGUE ORDER BY LeagueName;");

                                while($row = mysqli_fetch_array($res)) {
                            ?>
                                <div>
                                    <img src="./images/leagues/<?php echo $row['Image']?>" alt="" width="100px" height="100px"/>
                                    <div class="league-name">
                                        <label>
                                            Name:
                                        </label>
                                        <label>
                                             <?php echo $row['LeagueName']?>
                                        </label>
                                    </div>
                                    <div class="number-game">
                                        <?php
                                            $rowCount = mysqli_query($con, "SELECT COUNT(*) as NumberOfGames from GAME where LeagueID=".$row['LeagueID']);
                                            $data = mysqli_fetch_assoc($rowCount);
                                        ?>
                                        <label>
                                            Number of Games:       
                                        </label>
                                        <label>
                                            <?php echo $data['NumberOfGames'] ?>
                                        </label>
                                    </div>
                                    <div class="number-team">
                                        <?php
                                            $rowCount = mysqli_query($con, "SELECT COUNT(*) as NumberOfTeams from TEAM where LeagueID=".$row['LeagueID']);
                                            $data = mysqli_fetch_assoc($rowCount);
                                        ?>
                                        <label>
                                            Number of Teams: 
                                        </label>
                                        <label>
                                            <?php echo $data['NumberOfTeams'] ?>
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
                <div class="modal-content text-center add-league">
                    <div class="modal-header add-league-header">
                        <label>Add League</label>
                    </div>

                    <div class="add-league-menu">
                        <form method="POST" action="./add-league-functions/add-league-create-league.php" enctype="multipart/form-data" onsubmit="return sendForm()">
                            <ul>
                                <li>
                                    <label>League Name</label>
                                    <input type="text" class="form-league-name league-name-form" name="league_name" placeholder="League Name"></input>
                                </li>
                                <li>
                                    <label>League Image</label>
                                    <input type="file" class="pic-league" name="pic_league" accept="image/*">
                                </li>
                                <li>
                                    <button class="add-league-button modal-button">Add</button>
                                </li>
                            </ul>
                        </form>
                    </div>
                </div>
            </div>
        
        <!-- JS -->
        <script type="text/javascript">
            var SelectedLeagueName;
            function sendForm() {
                if($('.form-league-name.league-name-form').val() == 0 || $('.form-league-name.league-name-form').val() == null) {
                    alert('Please Insert Name');
                    return false;  
                }

                if($('.pic-league').val() == '' || $('.pic-league').val() == null) {
                    alert('Please Input League Image');
                    return false;
                }

                return true;
            }
            $('.leagues > div:not(:last-child)').click( function(e) {
                SelectedLeagueName = $.trim($(this).find('div.league-name').children(':nth-child(2)').text());
                $.redirect("/shotchart/league-individual.php", {"SelectedLeagueName": SelectedLeagueName});
            });

            $('#select-league').change(function () {
                SelectedLeagueName = $('#select-league').val();
                $.redirect("/shotchart/league-individual.php", {"SelectedLeagueName": SelectedLeagueName}); 
            });

            $(document).on('click', '.menu-button.add-league-button', function(e) {
                $('.modal-overlay').css('display', 'block');
                $(window).click(function (e) {
                    if($(e.target).attr('class') == 'modal-overlay')$('.modal-overlay').css('display', 'none');
                })
            });
        </script>
    </body>
</html>