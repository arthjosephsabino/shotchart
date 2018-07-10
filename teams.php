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
                <div class="team-options">
                    <div class="select-team-options side-bar-options text-center">
                        <ul>
                            <li>
                                <label>Team Name</label>
                                <select id="select-team" name="select_team">
                                    <option value="0" disabled selected>Select Team</option>
                                    <?php 
                                        $res = mysqli_query($con, "SELECT * FROM TEAM ORDER BY TeamName;");
                                        while($row = mysqli_fetch_array($res)) {
                                            echo "<option value='".$row['TeamID']."'>".$row['TeamName']."</option>";
                                        }
                                    ?>
                                </select>
                            </li>
                            <li>
                                <button class="add-team-button menu-button">add team</button>
                            </li>
                        </ul>
                    </div>
                </div>
            </aside>
            <!-- Main Content -->
            <main class="main-content">
                <section class="section-content team-options">
                    <div class="wrapper">
                        <label>
                            Teams
                        </label>
                        <div class="teams">
                            <?php
                                $res = mysqli_query($con, "SELECT * FROM TEAM ORDER BY TeamName;");

                                while($row = mysqli_fetch_array($res)) {
                            ?>
                                <div data-team-id="<?php echo $row['TeamID'];?>">
                                    <img src="./images/teams/<?php echo $row['Image']?>" alt="" width="100px" height="100px"/>
                                    <div class="team-name">
                                        <label>
                                            Name:
                                        </label>
                                        <label>
                                             <?php echo $row['TeamName']?>
                                        </label>
                                    </div>
                                    <div class="number-game">
                                        <?php
                                            $rowCount = mysqli_query($con, "SELECT COUNT(*) AS NumberOfGames FROM GAME WHERE TeamHomeID=".$row['TeamID']. " OR TeamAwayID=".$row['TeamID']);
                                            $data = mysqli_fetch_assoc($rowCount);
                                        ?>
                                        <label>
                                            Number of Games:       
                                        </label>
                                        <label>
                                            <?php echo $data['NumberOfGames'] ?>
                                        </label>
                                    </div>
                                    <div class="number-player">
                                        <?php
                                            $rowCount = mysqli_query($con, "SELECT COUNT(*) as NumberOfPlayers FROM PLAYER WHERE TeamID=".$row['TeamID']);
                                            $data = mysqli_fetch_assoc($rowCount);
                                        ?>
                                        <label>
                                            Number of Players:       
                                        </label>
                                        <label>
                                            <?php echo $data['NumberOfPlayers'] ?>
                                        </label>
                                    </div>
                                    <div class="team-league">
                                        <?php
                                            $rowLeague = mysqli_query($con, "SELECT LeagueName FROM LEAGUE WHERE LeagueID=".$row['LeagueID']);
                                            $data = mysqli_fetch_assoc($rowLeague);
                                        ?>
                                        <label>
                                            League:       
                                        </label>
                                        <label>
                                            <?php echo $data['LeagueName'] ?>
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
                <div class="modal-content text-center add-team">
                    <div class="modal-header add-team-header">
                        <label>Add Team</label>
                    </div>

                    <div class="add-team-menu">
                        <form method="POST" action="./add-team-functions/add-team-create-team.php" enctype="multipart/form-data" onsubmit="return sendForm()">
                            <ul>
                                <li>
                                    <label>League Name</label>
                                    <select id="select-league" name="select_league">
                                        <option value="0" disabled selected>Select League</option>
                                        <?php
                                            $res = mysqli_query($con, "SELECT * from League ORDER BY LeagueName");
                                            while($row = mysqli_fetch_array($res)) {
                                                echo "<option value='".$row['LeagueID']."'>".$row['LeagueName']."</option>";
                                            }
                                        ?>
                                    </select>
                                </li>
                                <li>
                                    <label>Team Name</label>
                                    <input type="text" class="form-team-name team-name-form" name="team_name" placeholder="Team Name"></input>
                                </li>
                                <li>
                                    <label>Team Image</label>
                                    <input type="file" class="pic-team" name="pic_team" accept="image/*">
                                </li>
                                <li>
                                    <label>Add Players</label>
                                    <div class="add-team-menu-add-players">
                                        <div>
                                            <div>
                                                1
                                                <input type="text" class="form-team player-name-form" name="player_name[]" placeholder="Player Name"></input>
                                            </div>
                                            <div>
                                                <input type="text" class="form-team jersey-number-form" name="jersey_number[]" placeholder="Jersey Number"></input>
                                            </div>
                                            <div class="upload-image">
                                                <input type="file" name="player_pic_team[]" class='form-team' accept="image/*">
                                            </div>
                                            <div class="clear"></div>
                                        </div>
                                        <div>
                                            <div>
                                                2
                                                <input type="text" class="form-team player-name-form" name="player_name[]" placeholder="Player Name"></input>
                                            </div>
                                            <div>
                                                <input type="text" class="form-team jersey-number-form" name="jersey_number[]" placeholder="Jersey Number"></input>
                                            </div>
                                            <div class="upload-image">
                                                <input type="file" name="player_pic_team[]" class='form-team' accept="image/*">
                                            </div>
                                            <div class="clear"></div>
                                        </div>
                                        <div>
                                            <div>
                                                3
                                                <input type="text" class="form-team player-name-form" name="player_name[]" placeholder="Player Name"></input>
                                            </div>
                                            <div>
                                                <input type="text" class="form-team jersey-number-form" name="jersey_number[]" placeholder="Jersey Number"></input>
                                            </div>
                                            <div class="upload-image">
                                                <input type="file" name="player_pic_team[]" class='form-team' accept="image/*">
                                            </div>
                                            <div class="clear"></div>
                                        </div>
                                        <div>
                                            <div>
                                                4
                                                <input type="text" class="form-team player-name-form" name="player_name[]" placeholder="Player Name"></input>
                                            </div>
                                            <div>
                                                <input type="text" class="form-team jersey-number-form" name="jersey_number[]" placeholder="Jersey Number"></input>
                                            </div>
                                            <div class="upload-image">
                                                <input type="file" name="player_pic_team[]" class='form-team' accept="image/*">
                                            </div>
                                            <div class="clear"></div>
                                        </div>
                                        <div>
                                            <div>
                                                5
                                                <input type="text" class="form-team player-name-form" name="player_name[]" placeholder="Player Name"></input>
                                            </div>
                                            <div>
                                                <input type="text" class="form-team jersey-number-form" name="jersey_number[]" placeholder="Jersey Number"></input>
                                            </div>
                                            <div class="upload-image">
                                                <input type="file" name="player_pic_team[]" class='form-team' accept="image/*">
                                            </div>
                                            <div class="clear"></div>
                                        </div>
                                        <div>
                                            <div>
                                                6
                                                <input type="text" class="form-team player-name-form" name="player_name[]" placeholder="Player Name"></input>
                                            </div>
                                            <div>
                                                <input type="text" class="form-team jersey-number-form" name="jersey_number[]" placeholder="Jersey Number"></input>
                                            </div>
                                            <div class="upload-image">
                                                <input type="file" name="player_pic_team[]" class='form-team' accept="image/*">
                                            </div>
                                            <div class="clear"></div>
                                        </div>
                                        <div>
                                            <div>
                                                7
                                                <input type="text" class="form-team player-name-form" name="player_name[]" placeholder="Player Name"></input>
                                            </div>
                                            <div>
                                                <input type="text" class="form-team jersey-number-form" name="jersey_number[]" placeholder="Jersey Number"></input>
                                            </div>
                                            <div class="upload-image">
                                                <input type="file" name="player_pic_team[]" class='form-team' accept="image/*">
                                            </div>
                                            <div class="clear"></div>
                                        </div>
                                        <div>
                                            <div>
                                                8
                                                <input type="text" class="form-team player-name-form" name="player_name[]" placeholder="Player Name"></input>
                                            </div>
                                            <div>
                                                <input type="text" class="form-team jersey-number-form" name="jersey_number[]" placeholder="Jersey Number"></input>
                                            </div>
                                            <div class="upload-image">
                                                <input type="file" name="player_pic_team[]" class='form-team' accept="image/*">
                                            </div>
                                            <div class="clear"></div>
                                        </div>
                                        <div>
                                            <div>
                                                9
                                                <input type="text" class="form-team player-name-form" name="player_name[]" placeholder="Player Name"></input>
                                            </div>
                                            <div>
                                                <input type="text" class="form-team jersey-number-form" name="jersey_number[]" placeholder="Jersey Number"></input>
                                            </div>
                                            <div class="upload-image">
                                                <input type="file" name="player_pic_team[]" class='form-team' accept="image/*">
                                            </div>
                                            <div class="clear"></div>
                                        </div>
                                        <div>
                                            <div>
                                                10
                                                <input type="text" class="form-team player-name-form" name="player_name[]" placeholder="Player Name"></input>
                                            </div>
                                            <div>
                                                <input type="text" class="form-team jersey-number-form" name="jersey_number[]" placeholder="Jersey Number"></input>
                                            </div>
                                            <div class="upload-image">
                                                <input type="file" name="player_pic_team[]" class='form-team' accept="image/*">
                                            </div>
                                            <div class="clear"></div>
                                        </div>
                                        <div>
                                            <div>
                                                11
                                                <input type="text" class="form-team player-name-form" name="player_name[]" placeholder="Player Name"></input>
                                            </div>
                                            <div>
                                                <input type="text" class="form-team jersey-number-form" name="jersey_number[]" placeholder="Jersey Number"></input>
                                            </div>
                                            <div class="upload-image">
                                                <input type="file" name="player_pic_team[]" class='form-team' accept="image/*">
                                            </div>
                                            <div class="clear"></div>
                                        </div>
                                        <div>
                                            <div>
                                                12
                                                <input type="text" class="form-team player-name-form" name="player_name[]" placeholder="Player Name"></input>
                                            </div>
                                            <div>
                                                <input type="text" class="form-team jersey-number-form" name="jersey_number[]" placeholder="Jersey Number"></input>
                                            </div>
                                            <div class="upload-image">
                                                <input type="file" name="player_pic_team[]" class='form-team' accept="image/*">
                                            </div>
                                            <div class="clear"></div>
                                        </div>
                                        <div>
                                            <div>
                                                13
                                                <input type="text" class="form-team player-name-form" name="player_name[]" placeholder="Player Name"></input>
                                            </div>
                                            <div>
                                                <input type="text" class="form-team jersey-number-form" name="jersey_number[]" placeholder="Jersey Number"></input>
                                            </div>
                                            <div class="upload-image">
                                                <input type="file" name="player_pic_team[]" class='form-team' accept="image/*">
                                            </div>
                                            <div class="clear"></div>
                                        </div>
                                        <div>
                                            <div>
                                                14
                                                <input type="text" class="form-team player-name-form" name="player_name[]" placeholder="Player Name"></input>
                                            </div>
                                            <div>
                                                <input type="text" class="form-team jersey-number-form" name="jersey_number[]" placeholder="Jersey Number"></input>
                                            </div>
                                            <div class="upload-image">
                                                <input type="file" name="player_pic_team[]" class='form-team' accept="image/*">
                                            </div>
                                            <div class="clear"></div>
                                        </div>
                                        <div>
                                            <div>
                                                15
                                                <input type="text" class="form-team player-name-form" name="player_name[]" placeholder="Player Name"></input>
                                            </div>
                                            <div>
                                                <input type="text" class="form-team jersey-number-form" name="jersey_number[]" placeholder="Jersey Number"></input>
                                            </div>
                                            <div class="upload-image">
                                                <input type="file" name="player_pic_team[]" class='form-team' accept="image/*">
                                            </div>
                                            <div class="clear"></div>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <button class="add-team-button modal-button">Add</button>
                                </li>
                            </ul>
                        </form>
                    </div>
                </div>
                
            </div>

        </div>
        
        <!-- JS -->
        <script type="text/javascript">
            var SelectedTeamID;
            function sendForm() {
                if($('#select-league').val() == 0 || $('#select-league').val() == null) {
                    alert('Please Select League');
                    return false;  
                } if($('.form-team-name.team-name-form').val() == '' || $('.form-team-name.team-name-form').val() == null) {
                    alert('Please Input Name');
                    return false;
                } if($('.pic-team').val() == '' || $('.pic-team').val() == null) {
                    alert('Please Input Team Image');
                    return false;
                }
                
                $.each($('.form-team'), function(i, value) {
                    console.log("d: " +$(this).val());
                    if($(this).val() == '' || $(this).val() == null) {
                        alert('Please fill up all information about player');
                        return false;
                    }
                });
                return true;
            }
            $('.teams > div:not(:last-child)').click( function(e) {
                SelectedTeamID = $(this).data('team-id');
                $.redirect("/shotchart/team-individual.php", {"SelectedTeamID": SelectedTeamID});
            });

            $('#select-team').change(function () {
                SelectedTeamID = $('#select-team option:selected').text();
                $.redirect("/shotchart/team-individual.php", {"SelectedTeamID": SelectedTeamID}); 
            });

            $(document).on('click', '.menu-button.add-team-button', function(e) {
                $('.modal-overlay').css('display', 'block');
                $(window).click(function (e) {
                    if($(e.target).attr('class') == 'modal-overlay')$('.modal-overlay').css('display', 'none');
                })
            });
            
        </script>
    </body>
</html>