<!DOCTYPE html>
<?php
    $host = "localhost";
    $user = "root";
    $pass = "";
    $db = "ShotChartDB";
    $errors = array();

    $con = mysqli_connect($host, $user, $pass, $db) or die("Connection Failed");

    session_start();
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
        <script type="text/javascript" src="slick/slick.min.js"></script>
        <script src="js/jquery.redirect.js"></script>
        <script src="js/main.js"></script>

        <!-- Fonts -->
        
        <!-- CSS -->
        <link rel="stylesheet" href="css/reset.custom.css">
        <link rel="stylesheet" href="css/font-awesome.min.css">
        <link rel="stylesheet" type="text/css" href="slick/slick.css"/>
        <link rel="stylesheet" type="text/css" href="slick/slick-theme.css"/>
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
                <div class="in-game-options">
                    <div class="in-game-side-options side-bar-options text-center">
                        <ul>
                            <li>
                                <label>Quarter:</label>
                                <p class="current-quarter" contenteditable="true">1</p>
                                <button class="button-add-quarter">+</button>
                                <button class="button-minus-quarter">-</button>
                            </li>
                            <li>
                                <label>Clock:</label>
                                <p class="clock" contenteditable="true">12:00.0</p>
                            </li>
                            <li>
                                <button class="clock-button clock-start">Start</button>
                                <button class="clock-button clock-pause">Pause</button>
                                <button class="clock-button clock-reset">Reset</button>
                            </li>
                            <li>
                                <label>Shot Clock:</label>
                                <p class="shot-clock">24.0</p>
                            </li>
                            <li>
                                <button class="clock-button clock-24">Reset to 24</button>
                                <button class="clock-button clock-14">Reset to 14</button>
                            </li>
                        </ul>
                        
                        <div class="in-game-scoreboard">
                            <div class="poss-1">
                                <label> Poss (Home)</label>
                            </div>
                            <div class="poss-2">
                                <label> Poss (Away)</label>
                            </div>
                            <div class="score-1">
                                <label> Score (Home)</label>
                                <span>0</span>
                                <button class="score-1-add">+</button>
                                <button class="score-1-minus">-</button>
                            </div>
                            <div class="score-2">
                                <label> Score (Away)</label>
                                <span>0</span>
                                <button class="score-2-add">+</button>
                                <button class="score-2-minus">-</button>
                            </div>
                            <div class="tf-1">
                                <label> Team Fouls (Home)</label>
                                <span>0</span>
                                <button class="tf-1-add">+</button>
                                <button class="tf-1-minus">-</button>
                            </div>
                            <div class="tf-2">
                                <label> Team Fouls (Away)</label>
                                <span>0</span>
                                <button class="tf-2-add">+</button>
                                <button class="tf-2-minus">-</button>
                            </div>
                            <div class="ft-1">
                                <label> Free Throw (Home)</label>
                                <button class="ftm-1-add">+</button>
                                <button class="ftm-1-minus">-</button>
                                <button class="fta-1-add">+</button>
                                <button class="fta-1-minus">-</button>
                                <p>
                                    <span>--</span> /
                                    <span>--</span>
                                </p>
                            </div>    
                            <div class="ft-2">
                                <label> Free Throw (Away)</label>
                                <button class="ftm-2-add">+</button>
                                <button class="ftm-2-minus">-</button>
                                <button class="fta-2-add">+</button>
                                <button class="fta-2-minus">-</button>
                                <p>
                                    <span>--</span> /
                                    <span>--</span>
                                </p>
                            </div>
                            <div class="clear"></div>
                        </div>
                    </div>
                </div>
            </aside>
            <!-- Main Content -->
            <main class="main-content">
                <section class="section-content team-options">
                    <div class="wrapper">
                        <label>
                            In-Game
                        </label>
                        <div class="in-game text-center">
                            <label class="in-game-name">Game Name</label>
                            <div class="in-game-shot-options">
                                <div>
                                    <div class="shot-chart"></div>
                                    <div class="shot-chart-home" style="display: none;"></div>
                                    <div class="shot-chart-away" style="display: none;"></div>
                                    <div class="shot-chart-help text-center">
                                        <div>
                                            <label>O - Made</label>
                                            <label>X - Missed</label>
                                        </div>
                                        <button class="in-game-save-button button-save">save</button>
                                    </div>
                                </div>
                                <div class="in-game-team-options">
                                    <div class="team-home">
                                        <?php
                                            $row = mysqli_query($con, "SELECT * FROM TEAM WHERE TeamID='".$_SESSION['SelectedHomeTeamID']."';");
                                            $data = mysqli_fetch_assoc($row);
                                            $SelectedHomeTeamImg = $data['Image'];
                                        ?>
                                        <label>Team Name (Home): <?php echo $_SESSION['SelectedHomeName']?></label>
                                        <img src="./images/teams/<?php echo $SelectedHomeTeamImg ?>" height="35px" width="35px">
                                        <ul class="team-home-list slider slider-nav">
                                            <?php
                                                $query = "SELECT * FROM Player WHERE TeamID='".$_SESSION['SelectedHomeTeamID']."' ORDER BY JerseyNumber";
                                                $res = mysqli_query($con, $query);

                                                while($row = mysqli_fetch_array($res)){
                                            ?>
                                                <li id="<?php echo $row['JerseyNumber']?>">
                                                    <img src="./images/players/<?php echo $row['Image'] ?>" height="50px" width="50px">
                                                    <label class="float-left"># <?php echo $row['JerseyNumber'] ?></label>
                                                </li>
                                            <?php   
                                                }
                                            ?>
                                        </ul>
                                        <button class="substitute-home sub-button" disabled>Substitute</button>
                                    </div>
                                    <div class="team-away">
                                        <?php
                                            $row = mysqli_query($con, "SELECT * FROM TEAM WHERE TeamID='".$_SESSION['SelectedAwayTeamID']."';");
                                            $data = mysqli_fetch_assoc($row);
                                            $SelectedAwayTeamImg = $data['Image'];
                                        ?>
                                        <label>Team Name (Away): <?php echo $_SESSION['SelectedAwayName']?></label>
                                        <img src="./images/teams/<?php echo $SelectedAwayTeamImg ?>" height="35px" width="35px">
                                        <ul class="team-away-list slider slider-nav">
                                            <?php
                                                $query = "SELECT * FROM Player WHERE TeamID='".$_SESSION['SelectedAwayTeamID']."' ORDER BY JerseyNumber";
                                                $res = mysqli_query($con, $query);

                                                while($row = mysqli_fetch_array($res)){
                                            ?>
                                                <li id="<?php echo $row['JerseyNumber']?>">
                                                    <img src="./images/players/<?php echo $row['Image'] ?>" height="50px" width="50px">
                                                    <label class="float-left"># <?php echo $row['JerseyNumber'] ?></label>
                                                </li>
                                            <?php   
                                                }
                                            ?>
                                        </ul>
                                        <button class="substitute-away sub-button" disabled>Substitute</button>
                                    </div>

                                    <div class="indiv-player-info">
                                        <div>
                                            <div class="indiv-player-pic">
                                                <label>Player Pic</label>
                                                <label></label>
                                            </div>
                                            <div class="indiv-player-stats">
                                                <label>Player Stats</label>
                                                <div>
                                                    <div class="indiv-points">
                                                        <h3>Pts: </h3>
                                                    </div>
                                                    <div class="indiv-fgm">
                                                        <h3>FGM: </h3>
                                                    </div>
                                                    <div class="indiv-fga">
                                                        <h3>FGA: </h3>
                                                    </div>
                                                    <div class="indiv-threepm">
                                                        <h3>3PM: </h3>
                                                    </div>
                                                    <div class="indiv-threepa">
                                                        <h3>3PA: </h3>
                                                    </div>
                                                    <div class="indiv-ftm">
                                                        <h3>FTM: </h3>
                                                    </div>
                                                    <div class="indiv-fta">
                                                        <h3>FTA: </h3>
                                                    </div>
                                                    <div class="indiv-fouls">
                                                        <h3>Fouls: </h3>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="indiv-player-shots">
                                                <label>Player Shots</label>
                                                <div class="indiv-player-fg-shots text-left">
                                                    <ul>
                                                        <li>
                                                        </li>
                                                    </ul>
                                                </div>
                                                <div class="indiv-player-ft-shots text-left">
                                                    <ul>
                                                        <li>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="clear"></div>
                                        </div>
                                    </div>
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
                <div class="modal-content text-center sub-player">
                    <div class="modal-header">
                        <label>Substitute Menu</label>
                    </div>
                    <div class="substitute-menu">
                        <label>Team Home</label>
                        <ul class="team-list slick slider-nav">
                            
                        </ul>
                        <button class="sub-button substitute-menu-button">Substitute</button>
                    </div>
                </div>
            </div>

        </div>
        
        <!-- JS -->
        <script type="text/javascript">

            var startTime;
            var xOnShotChart = false, oOnShotChart = false, XOUrl;
            var scoreHome = 0, scoreAway = 0, tfHome = 0, tfAway = 0, ftmAway = 0, ftmHome = 0, ftaHome = 0, ftaAway = 0, currentQuarter = 1;
            var countFT = 0, countFG = 0;
            var SelectedHomeName = '<?php echo $_SESSION['SelectedHomeName'] ?>';
            var SelectedAwayName = '<?php echo $_SESSION['SelectedAwayName'] ?>';

            var teamHomePlayers = new Object();

            var teamAwayPlayers = new Object();
            var relativePolygon = [[26, 0], [26, 110], [40, 125], [57, 150], [85, 174], [109, 190], [139, 204], [167, 214], [195, 221], [227, 225], [257, 226], [305, 221], [339, 212], [369, 201], [390, 190], [407, 178], [420, 168], [451, 136], [461, 123], [468, 110], [468, 0]];
            function Shot(x, y, relX, relY, playerShot, points, quarter, time, made) {
                countFG = countFG + 1;
                this.shotID = countFG;
                this.x = x;
                this.y = y;
                this.relX = relX;
                this.relY = relY;
                this.points = points;
                this.playerShot = playerShot;
                this.quarter = quarter;
                this.time = time;
                this.made = made
                this.getCoordinates = function(){
                    console.log(this.x + ", " + this.y);
                }
            }
            
            function FreeThrowShot(playerShot, points, quarter, time, made) {
                countFT = countFT + 1;
                this.playerShot = playerShot;
                this.points = points;
                this.quarter = quarter;
                this.time = time;
                this.made = made;
                this.FtID = countFT;
            }

            function Player(name, jerseyNumber, team, image){
                this.name = name;
                this.jerseyNumber = jerseyNumber;
                this.team = team;
                this.stats = {
                    points:0,
                    fgm: 0,
                    fga: 0,
                    fta:0,
                    ftm: 0,
                    threepm: 0,
                    threepa: 0,
                    fgper: 0,
                    threeper:0,
                    eFgper:0,
                    tsper:0,
                    fouls: 0

                }
                this.image = image;
                this.shots = new Array();
                this.ftshots = new Array();
            }
            function removePlayerFGShot() {
                var target = event.currentTarget;
                var parent = target.parentElement;
                var selected_player = $('.selected-player').text().replace(/[^A-Z0-9]/ig, "");

                if($('.selected-team').hasClass('team-home')) {
                    $.each($('.shot-chart-home > div'), function(i, value) {
                        if($(this).data('shot-id') == $(parent).data('shot-id')) $(this).remove();
                    });   

                    teamHomePlayers[selected_player].shots = jQuery.grep(teamHomePlayers[selected_player].shots, function(shot) {

                        if(shot.shotID == $(parent).data('shot-id')) {
                            if(shot.made) {
                                scoreHome = parseInt($('.score-1 > span').text()) - shot.points;
                                $('.score-1 > span').text(scoreHome);

                                teamHomePlayers[selected_player].stats.points = teamHomePlayers[selected_player].stats.points - shot.points;
                                teamHomePlayers[selected_player].stats.fgm = teamHomePlayers[selected_player].stats.fgm - 1;

                                if(shot.points == 3) teamHomePlayers[selected_player].stats.threepm = teamHomePlayers[selected_player].stats.threepm - 1;
                            }
                            if(shot.points == 3) teamHomePlayers[selected_player].stats.threepa = teamHomePlayers[selected_player].stats.threepa - 1;
                            teamHomePlayers[selected_player].stats.fga = teamHomePlayers[selected_player].stats.fga - 1;
                        }
                        return shot.shotID != $(parent).data('shot-id');    
                    });
                } else if($('.selected-team').hasClass('team-away')) {
                    $.each($('.shot-chart-away > div'), function(i, value) {
                        if($(this).data('shot-id') == $(parent).data('shot-id')) $(this).remove();
                    });   

                    teamAwayPlayers[selected_player].shots = jQuery.grep(teamAwayPlayers[selected_player].shots, function(shot) {

                        if(shot.shotID == $(parent).data('shot-id')) {
                            if(shot.made) {
                                scoreAway = parseInt($('.score-2 > span').text()) - shot.points;
                                $('.score-2 > span').text(scoreAway);

                                teamAwayPlayers[selected_player].stats.points = teamAwayPlayers[selected_player].stats.points - shot.points;
                                teamAwayPlayers[selected_player].stats.fgm = teamAwayPlayers[selected_player].stats.fgm - 1;

                                if(shot.points == 3) teamAwayPlayers[selected_player].stats.threepm = teamAwayPlayers[selected_player].stats.threepm - 1;
                            }
                            if(shot.points == 3) teamAwayPlayers[selected_player].stats.threepa = teamAwayPlayers[selected_player].stats.threepa - 1;
                            teamAwayPlayers[selected_player].stats.fga = teamAwayPlayers[selected_player].stats.fga - 1;
                        }
                        return shot.shotID != $(parent).data('shot-id');    
                    });
                }
                displayPlayerInfo();
                $('.shot-chart-home > .selected-shot, .shot-chart-away > .selected-shot').remove();
                $(parent).remove();
            }

            function removePlayerFTShot() {
                var target = event.currentTarget;
                var parent = target.parentElement;
                var selected_player = $('.selected-player').text().replace(/[^A-Z0-9]/ig, "");


                 if($('.selected-team').hasClass('team-home')) {
                    teamHomePlayers[selected_player].ftshots = jQuery.grep(teamHomePlayers[selected_player].ftshots, function(shot) {
                        if(shot.FtID == $(parent).data('ft-id')) {
                            if(shot.made) {
                                scoreHome = parseInt($('.score-1 > span').text()) - shot.points;
                                ftmHome = parseInt($('.ft-1 > p > span:first-child').text()) - 1;
                                $('.score-1 > span').text(scoreHome);
                                $('.ft-1 > p > span:first-child').text(ftmHome);

                                teamHomePlayers[selected_player].stats.points = teamHomePlayers[selected_player].stats.points - shot.points;
                                teamHomePlayers[selected_player].stats.ftm = teamHomePlayers[selected_player].stats.ftm - 1;

                            }
                            ftaHome = parseInt($('.ft-1 > p > span:nth-child(2)').text()) - 1;
                            $('.ft-1 > p > span:nth-child(2)').text(ftaHome)
                            teamHomePlayers[selected_player].stats.fga = teamHomePlayers[selected_player].stats.fta - 1;
                        }
                        return shot.FtID != $(parent).data('ft-id');    
                    });
                } else if($('.selected-team').hasClass('team-away')) {
                    teamAwayPlayers[selected_player].ftshots = jQuery.grep(teamAwayPlayers[selected_player].ftshots, function(shot) {
                        if(shot.FtID == $(parent).data('ft-id')) {
                            if(shot.made) {
                                scoreAway = parseInt($('.score-2 > span').text()) - shot.points;
                                ftmAway = parseInt($('.ft-2 > p > span:first-child').text()) - 1;
                                $('.score-2 > span').text(scoreAway);
                                $('.ft-2 > p > span:first-child').text(ftmAway);

                                teamAwayPlayers[selected_player].stats.points = teamAwayPlayers[selected_player].stats.points - shot.points;
                                teamAwayPlayers[selected_player].stats.ftm = teamAwayPlayers[selected_player].stats.ftm - 1;

                            }
                            ftaAway = parseInt($('.ft-2 > p > span:nth-child(2)').text()) - 1;
                            $('.ft-2 > p > span:nth-child(2)').text(ftaAway)
                            teamAwayPlayers[selected_player].stats.fga = teamAwayPlayers[selected_player].stats.fta - 1;
                        }
                        return shot.FtID != $(parent).data('ft-id');    
                    });
                }
                displayPlayerInfo();
                $(parent).remove();
            }
            function displayPlayerInfo() {
                var selected_player = $('.selected-player').text().replace(/[^A-Z0-9]/ig, "");
                var img;
                
                $('.indiv-player-pic img').remove();
                $(".indiv-player-ft-shots > ul").remove();
                $(".indiv-player-fg-shots > ul").remove();
                $(".indiv-player-fg-shots").append($('<ul></ul>'));
                $(".indiv-player-ft-shots").append($('<ul></ul>'));
                
                if($('.selected-team').hasClass('team-home')) {
                    img = $('<img />',
                             { id: 'Myid',
                               src: './images/players/'+teamHomePlayers[selected_player].image,
                               height: 100,
                               width: 100
                             })
                    img.insertAfter($('.indiv-player-pic label:first-of-type'));

                    $('.indiv-player-pic label:last-of-type').text(teamHomePlayers[selected_player].name);
                    
                    $('.indiv-points h3').text("Pts: "+teamHomePlayers[selected_player].stats.points);
                    $('.indiv-fgm h3').text("FGM: "+teamHomePlayers[selected_player].stats.fgm);
                    $('.indiv-fga h3').text("FGA: "+teamHomePlayers[selected_player].stats.fga);
                    $('.indiv-threepm h3').text("3PM: "+teamHomePlayers[selected_player].stats.threepm);
                    $('.indiv-threepa h3').text("3PA: "+teamHomePlayers[selected_player].stats.threepa);
                    $('.indiv-ftm h3').text("FTM: "+teamHomePlayers[selected_player].stats.ftm);
                    $('.indiv-fta h3').text("FTA: "+teamHomePlayers[selected_player].stats.fta);
                    $('.indiv-fouls h3').text("Fouls: "+teamHomePlayers[selected_player].stats.fouls);

                    $.each(teamHomePlayers[selected_player].shots, function(i, shot){
                        if(shot.made) var listText = "Pts: " +shot.points+ " Q: " +shot.quarter+ " Time: " +shot.time;
                        else var listText = "Pts: 0 Q: " +shot.quarter+ " Time: " +shot.time;
                        $(".indiv-player-fg-shots > ul").append(
                            $('<li></li>')
                                .data('shot-id', shot.shotID)
                                .data('coordinates', {relX: shot.relX, relY: shot.relY})
                                .css('padding', '2px 0')
                                .css('font-size', '12px')
                                .css('border-bottom', '2px solid #dddedf')
                                .text(listText)
                                .append(
                                    $('<button></button')
                                        .css('font-size', '5px')
                                        .css('padding', '3px')
                                        .css('background', 'red')
                                        .css('color', 'white')
                                        .css('border-radius', '10px')
                                        .css('border-top-left-radius', '10px')
                                        .css('border-top-right-radius', '10px')
                                        .css('border-bottom-left-radius', '10px')
                                        .css('border-bottom-right-radius', '10px')
                                        .css('margin-left', '10px')
                                        .on('click', removePlayerFGShot)
                                        .text('X')
                                    )
                        )
                    });
                    //home ftshots
                    $.each(teamHomePlayers[selected_player].ftshots, function(i, shot){
                        if(shot.made) var listText = "Pts: " +shot.points+ " Q: " +shot.quarter+ " Time: " +shot.time;
                        else var listText = "Pts: 0 Q: " +shot.quarter+ " Time: " +shot.time;
                        $(".indiv-player-ft-shots > ul").append(
                            $('<li></li>')
                                .data('ft-id', shot.FtID)
                                .css('padding', '2px 0')
                                .css('font-size', '12px')
                                .css('border-bottom', '2px solid #dddedf')
                                .text(listText)
                                .append(
                                    $('<button></button')
                                        .css('font-size', '5px')
                                        .css('padding', '3px')
                                        .css('background', 'red')
                                        .css('color', 'white')
                                        .css('border-radius', '10px')
                                        .css('border-top-left-radius', '10px')
                                        .css('border-top-right-radius', '10px')
                                        .css('border-bottom-left-radius', '10px')
                                        .css('border-bottom-right-radius', '10px')
                                        .css('margin-left', '10px')
                                        .on('click', removePlayerFTShot)
                                        .text('X')
                                    )
                        )
                    });
                } else if ($('.selected-team').hasClass('team-away')) {
                    img = $('<img />',
                             { id: 'Myid',
                               src: './images/players/'+teamAwayPlayers[selected_player].image,
                               height: 100,
                               width: 100
                             })
                    img.insertAfter($('.indiv-player-pic label:first-of-type'));

                    $('.indiv-player-pic label:last-of-type').text(teamAwayPlayers[selected_player].name);
                    
                    $('.indiv-points h3').text("Pts: "+teamAwayPlayers[selected_player].stats.points);
                    $('.indiv-fgm h3').text("FGM: "+teamAwayPlayers[selected_player].stats.fgm);
                    $('.indiv-fga h3').text("FGA: "+teamAwayPlayers[selected_player].stats.fga);
                    $('.indiv-threepm h3').text("3PM: "+teamAwayPlayers[selected_player].stats.threepm);
                    $('.indiv-threepa h3').text("3PA: "+teamAwayPlayers[selected_player].stats.threepa);
                    $('.indiv-ftm h3').text("FTM: "+teamAwayPlayers[selected_player].stats.ftm);
                    $('.indiv-fta h3').text("FTA: "+teamAwayPlayers[selected_player].stats.fta);
                    $('.indiv-fouls h3').text("Fouls: "+teamAwayPlayers[selected_player].stats.fouls);

                    $.each(teamAwayPlayers[selected_player].shots, function(i, shot){
                        if(shot.made) var listText = "Pts: " +shot.points+ " Q: " +shot.quarter+ " Time: " +shot.time;
                        else var listText = "Pts: 0 Q: " +shot.quarter+ " Time: " +shot.time;
                        $(".indiv-player-fg-shots > ul").append(
                            $('<li></li>')
                                .data('shot-id', shot.shotID)
                                .data('coordinates', {relX: shot.relX, relY: shot.relY})
                                .css('padding', '2px 0')
                                .css('font-size', '12px')
                                .css('border-bottom', '2px solid #dddedf')
                                .text(listText)
                                .append(
                                    $('<button></button')
                                        .css('font-size', '5px')
                                        .css('padding', '3px')
                                        .css('background', 'red')
                                        .css('color', 'white')
                                        .css('border-radius', '10px')
                                        .css('border-top-left-radius', '10px')
                                        .css('border-top-right-radius', '10px')
                                        .css('border-bottom-left-radius', '10px')
                                        .css('border-bottom-right-radius', '10px')
                                        .css('margin-left', '10px')
                                        .on('click', removePlayerFGShot)
                                        .text('X')
                                    )
                        )
                    });

                    //home ftshots
                    $.each(teamAwayPlayers[selected_player].ftshots, function(i, shot){
                         if(shot.made) var listText = "Pts: " +shot.points+ " Q: " +shot.quarter+ " Time: " +shot.time;
                        else var listText = "Pts: 0 Q: " +shot.quarter+ " Time: " +shot.time;
                        $(".indiv-player-ft-shots > ul").append(
                            $('<li></li>')
                                .data('ft-id', shot.FtID)
                                .css('padding', '2px 0')
                                .css('font-size', '12px')
                                .css('border-bottom', '2px solid #dddedf')
                                .text(listText)
                                .append(
                                    $('<button></button')
                                        .css('font-size', '5px')
                                        .css('padding', '3px')
                                        .css('background', 'red')
                                        .css('color', 'white')
                                        .css('border-radius', '10px')
                                        .css('border-top-left-radius', '10px')
                                        .css('border-top-right-radius', '10px')
                                        .css('border-bottom-left-radius', '10px')
                                        .css('border-bottom-right-radius', '10px')
                                        .css('margin-left', '10px')
                                        .on('click', removePlayerFTShot)
                                        .text('X')
                                    )
                        )
                    });
                }

            }
            function reset() {
                $('.substitute-home').attr('disabled', 'disabled');
                $('.substitute-away').attr('disabled', 'disabled');
                $('.substitute-home').css('background', 'gray');
                $('.substitute-away').css('background', 'gray');
                $('.selected-team').css('border', '2px solid #dddedf');
                $(".shot-chart").css('cursor', 'pointer');
                $(".shot-chart-home, .shot-chart-away").css('display', 'none');
                $(".shot-chart").css('display', 'block');
                $('.selected-player').css('background', 'initial');
                $('.team-home-list li, .team-away-list li').removeClass('selected-player');
                $('.team-home, .team-away').removeClass('selected-team');
                $('.team-list li').removeClass('selected-sub-player');
                $('.shot-chart-home > .selected-shot, .shot-chart-away > .selected-shot').remove();
            }

            function inside(point, vs) {
                var x = point[0], y = point[1];

                var inside = false;
                for (var i = 0, j = vs.length - 1; i < vs.length; j = i++) {
                    var xi = vs[i][0], yi = vs[i][1];
                    var xj = vs[j][0], yj = vs[j][1];

                    var intersect = ((yi > y) != (yj > y))
                        && (x < (xj - xi) * (y - yi) / (yj - yi) + xi);
                    if (intersect) inside = !inside;
                }

                return inside;
            };
            <?php
                $query = "SELECT PlayerName, JerseyNumber, Image FROM PLAYER WHERE TeamID='".$_SESSION['SelectedHomeTeamID']."'";
                $result=mysqli_query($con,$query);
                while($row=mysqli_fetch_array($result,MYSQLI_NUM)) {
                    echo "teamHomePlayers['$row[1]'] = new Player('$row[0]', '$row[1]', '".$_SESSION['SelectedHomeName']."', '$row[2]'); ";
                }

            ?>

            <?php
                $query = "SELECT PlayerName, JerseyNumber, Image FROM PLAYER WHERE TeamID='".$_SESSION['SelectedAwayTeamID']."'";
                $result=mysqli_query($con,$query);
                while($row=mysqli_fetch_array($result,MYSQLI_NUM)) {
                    echo "teamAwayPlayers['$row[1]'] = new Player('$row[0]', '$row[1]', '".$_SESSION['SelectedAwayName']."', '$row[2]'); ";
                }

            ?>

            $(document).ready(function () {
                var gameName = <?php echo json_encode($_SESSION['SelectedGameName']) ?>;
                $('html,body').animate({scrollTop: $('.in-game-shot-options').position().top - 100}, 2000);
                if(gameName != null || gameName != '') $('.in-game > label').text(gameName);
            });

            $('.current-quarter, .clock, .shot-clock').keypress(function(e) {
                    if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
                        return false;
                    }
                });

            $('.team-away-list.slider-nav, .team-home-list.slider-nav').slick({
                    slidesToShow: 5,
                    slidesToScroll: 5,
                    arrows: false,
                    infinite: true,
                    draggable: false
            });
            //modal
            $('.sub-button.substitute-home, .sub-button.substitute-away').click(function(e) {
                if(!$('.team-home-list li, .team-away-list li').hasClass('selected-player')) return;
                $('.team-list li').remove();
                $('.modal-overlay').css('display', 'block');

                if($(e.target).hasClass('substitute-home')) {
                    $('.substitute-menu > label:first-of-type').text("Team Home: "+ SelectedHomeName);
                    $('.team-home-list li').not(".slick-cloned, .slick-active").each(function(e){
                        var subImage = $(this).find('img').attr('src');
                        var subID = $(this).attr('id');
                        var subJerseyNumber = $(this).find('label').text();

                        $('.team-list').slick('slickAdd', "<li id="+subID+"><img src='"+subImage+"' height='50px' width='50px'> <label class='float-left'>"+subJerseyNumber+"</label></li>");
                    });
                } else if($(e.target).hasClass('substitute-away')) {
                    $('.substitute-menu > label:first-of-type').text("Team Away: "+ SelectedAwayName);
                    $('.team-away-list li').not(".slick-cloned, .slick-active").each(function(e){
                        var subImage = $(this).find('img').attr('src');
                        var subID = $(this).attr('id');
                        var subJerseyNumber = $(this).find('label').text();

                        
                        $('.team-list').slick('slickAdd', "<li id="+subID+"><img src='"+subImage+"' height='50px' width='50px'> <label class='float-left'>"+subJerseyNumber+"</label></li>");
                    });
                }

                $(window).click(function (e) {
                    if($(e.target).attr('class') == 'modal-overlay')$('.modal-overlay').css('display', 'none');
                })
            });

            $('.team-list.slider-nav').slick({
                slidesToShow: 5,
                slidesToScroll: 5,
                arrows: true,
                infinite: true
            });
            function computeAdvanceStats() {
                $.each(Object.keys(teamHomePlayers), function(i, value) {
                    if(teamHomePlayers[value].stats.fga != 0){
                      teamHomePlayers[value].stats.fgper = parseFloat(teamHomePlayers[value].stats.fgm)/parseFloat(teamHomePlayers[value].stats.fga);
                      var twofgm = teamHomePlayers[value].stats.fgm - teamHomePlayers[value].stats.threepm;

                      teamHomePlayers[value].stats.eFgper = ((twofgm + parseFloat(1.5*teamHomePlayers[value].stats.threepm))/teamHomePlayers[value].stats.fga)*100;
                    }

                    if(teamHomePlayers[value].stats.fta != 0){
                        teamHomePlayers[value].stats.ftper = ((parseFloat(teamHomePlayers[value].stats.ftm)/parseFloat(teamHomePlayers[value].stats.fta))*100).toFixed(2);
                    } 
                    if(teamHomePlayers[value].stats.threepa != 0){
                        teamHomePlayers[value].stats.threeper = ((parseFloat(teamHomePlayers[value].stats.threepm)/parseFloat(teamHomePlayers[value].stats.threepa))*100).toFixed(2);
                    }
                    if(teamHomePlayers[value].stats.fga != 0 || teamHomePlayers[value].stats.fta != 0){
                      teamHomePlayers[value].stats.tsper = (((teamHomePlayers[value].stats.points)/ (2*(teamHomePlayers[value].stats.fga) + (0.44 * teamHomePlayers[value].stats.fta)))*100).toFixed(2);  
                    } 
                });

                $.each(Object.keys(teamAwayPlayers), function(i, value) {
                    if(teamAwayPlayers[value].stats.fga != 0){
                      teamAwayPlayers[value].stats.fgper = parseFloat(teamAwayPlayers[value].stats.fgm)/parseFloat(teamAwayPlayers[value].stats.fga);
                      var twofgm = teamAwayPlayers[value].stats.fgm - teamAwayPlayers[value].stats.threepm;

                      teamAwayPlayers[value].stats.eFgper = ((twofgm + parseFloat(1.5*teamAwayPlayers[value].stats.threepm))/teamAwayPlayers[value].stats.fga)*100;
                    }

                    if(teamAwayPlayers[value].stats.fta != 0){
                        teamAwayPlayers[value].stats.ftper = ((parseFloat(teamAwayPlayers[value].stats.ftm)/parseFloat(teamAwayPlayers[value].stats.fta))*100).toFixed(2);
                    } 
                    if(teamAwayPlayers[value].stats.threepa != 0){
                        teamAwayPlayers[value].stats.threeper = ((parseFloat(teamAwayPlayers[value].stats.threepm)/parseFloat(teamAwayPlayers[value].stats.threepa))*100).toFixed(2);
                    }
                    if(teamAwayPlayers[value].stats.fga != 0 || teamAwayPlayers[value].stats.fta != 0){
                      teamAwayPlayers[value].stats.tsper = (((teamAwayPlayers[value].stats.points)/ (2*(teamAwayPlayers[value].stats.fga) + (0.44 * teamAwayPlayers[value].stats.fta)))*100).toFixed(2);  
                    } 
                });
            }
            $(document).on('click', '.in-game-save-button', function() {
                computeAdvanceStats();

                scoreHome = $(".score-1 > span").text();
                scoreAway = $(".score-2 > span").text();
                quarter = $(".current-quarter").text();

                $.redirect('./save-game-functions/in-game-save.php', {
                    "ScoreHome": scoreHome,
                    "ScoreAway": scoreAway,
                    "CurrentQuarter": quarter,
                    "TeamHomePlayers": teamHomePlayers,
                    "TeamAwayPlayers": teamAwayPlayers,
                });
            })
            $(document).on('click', '.team-list li', function(){ 
                $('.selected-sub-player').css('background', 'initial');
                $('.team-list li').removeClass('selected-sub-player');
                $('.shot-chart-home > .selected-shot, .shot-chart-away > .selected-shot').remove();
                $(this).addClass('selected-sub-player');
                $(this).css('background', '#00aeef');
            });


            $(document).on('click', '.indiv-player-ft-shots ul li', function() {
                $('.selected-ft-shot').css('background', 'initial');
                $('.indiv-player-shots li').removeClass('selected-ft-shot');
                $(this).addClass('selected-ft-shot');
                $(this).css('background', '#00aeef');
            });

            $(document).on('click', '.indiv-player-fg-shots ul li', function() {
                var selected_shotX;
                var selected_shotY;

                $('.selected-fg-shot').css('background', 'initial');
                $('.indiv-player-shots li').removeClass('selected-fg-shot');
                $(this).addClass('selected-fg-shot');
                $(this).css('background', '#00aeef');
                var shotChartX = ($('.team-home').hasClass('selected-team')) ? $('.shot-chart-home').position().left : $('.shot-chart-away').position().left;
                var shotChartY = ($('.team-home').hasClass('selected-team')) ? $('.shot-chart-home').position().top : $('.shot-chart-away').position().top;

                selected_shotX = parseInt($(this).data('coordinates').relX) + shotChartX;
                selected_shotY = parseInt($(this).data('coordinates').relY) + shotChartY;

                
                $('.shot-chart-home > .selected-shot, .shot-chart-away > .selected-shot').remove(); 
                
                if($('.team-home').hasClass('selected-team')) {
                    $(".shot-chart-home").append(
                            $('<div></div>')
                                .addClass('selected-shot')
                                .css('position', 'absolute')
                                .css('left', selected_shotX + 'px')
                                .css('top', selected_shotY + 'px')
                                .css('width', 10)
                                .css('height', 10)
                                .css('background', 'url(./images/highlightMark.png)')
                    );
                } else if ($('.team-away').hasClass('selected-team')) {
                    $(".shot-chart-away").append(
                            $('<div></div>')
                                .addClass('selected-shot')
                                .css('position', 'absolute')
                                .css('left', selected_shotX + 'px')
                                .css('top', selected_shotY + 'px')
                                .css('width', 10)
                                .css('height', 10)
                                .css('background', 'url(./images/highlightMark.png)')
                    );
                }



            });

            $('.sub-button.substitute-menu-button').click(function(e) {
                if(!$('.team-list li').hasClass('selected-sub-player')) alert('Choose Player to Substitute');
                var selImage = $('.selected-player').find('img').attr('src');
                var selID = $('.selected-player').attr('id');
                var selJerseyNumber = $('.selected-player').find('label').text();

                var subImage = $(".selected-sub-player").find('img').attr('src');
                var subID = $('.selected-sub-player').attr('id');
                var subJerseyNumber = $(".selected-sub-player").find('label').text();

                if($('.selected-team').hasClass('team-home')) {
                    
                    $('.team-home-list').slick('slickRemove', ($('.team-home-list').find('#'+subID).attr('data-slick-index')));
                    $('.team-home-list').slick('slickRemove', $('.selected-player').attr('data-slick-index'));

                    $('.team-home-list').slick('slickAdd', "<li id="+subID+"><img src='"+subImage+"' height='50px' width='50px'> <label class='float-left'>"+subJerseyNumber+"</label></li>", 0, true);
                    $('.team-home-list').slick('slickAdd', "<li id="+selID+"><img src='"+selImage+"' height='50px' width='50px'> <label class='float-left'>"+selJerseyNumber+"</label></li>");

                } else if($('.selected-team').hasClass('team-away')) {

                    $('.team-away-list').slick('slickRemove', ($('.team-away-list').find('#'+subID).attr('data-slick-index')));
                    $('.team-away-list').slick('slickRemove', $('.selected-player').attr('data-slick-index'));

                    $('.team-away-list').slick('slickAdd', "<li id="+subID+"><img src='"+subImage+"' height='50px' width='50px'> <label class='float-left'>"+subJerseyNumber+"</label></li>", 0, true);
                    $('.team-away-list').slick('slickAdd', "<li id="+selID+"><img src='"+selImage+"' height='50px' width='50px'> <label class='float-left'>"+selJerseyNumber+"</label></li>");
                }

                $('.modal-overlay').css('display', 'none');
                reset();
                $('.team-list').slick('refresh');

            });

            $(document).on("click", '.team-home-list li', function(e) {
                $('.substitute-away').attr('disabled', 'disabled');
                $('.substitute-away').css('background', 'gray');
                $('.substitute-home').removeAttr('disabled');
                $('.substitute-home').css('background', '#00aeef');
                $('.selected-player').css('background', 'initial');
                $('.team-home-list li, .team-away-list li').removeClass('selected-player');
                $('.team-home, .team-away').css('border', '2px solid #dddedf');
                $('.team-home, .team-away').removeClass('selected-team');
                $(this).addClass('selected-player');
                $('.team-home').addClass('selected-team');
                $(this).css('background', '#00aeef');
                $('.team-home').css('border', '2px solid red');
                
                displayPlayerInfo();
                $('.shot-chart-home').show(300);
                $('.shot-chart-away').css('display', 'none');
                $('.shot-chart').css('display', 'none');
            });
            $(document).on("click", '.team-away-list li', function(e) {
                $('.substitute-home').attr('disabled', 'disabled');
                $('.substitute-home').css('background', 'gray');
                $('.substitute-away').removeAttr('disabled');
                $('.substitute-away').css('background', '#00aeef');
                $('.selected-player').css('background', 'initial');
                $('.team-home-list li, .team-away-list li').removeClass('selected-player');
                $('.team-home, .team-away').css('border', '2px solid #dddedf');
                $('.team-home, .team-away').removeClass('selected-team');
                $(this).addClass('selected-player');
                $('.team-away').addClass('selected-team');
                $(this).css('background', '#00aeef');
                $('.team-away').css('border', '2px solid red');

                displayPlayerInfo();
                $('.shot-chart-away').show(300);
                $('.shot-chart-home').css('display', 'none');
                $('.shot-chart').css('display', 'none');
            });
            //input hotkeys
            $("body").keypress(function(event){
                if (event.keyCode == 113) {
                    $('.clock-start').click();
                }
                if (event.keyCode == 119) {
                    $('.clock-pause').click();
                }
                if (event.keyCode == 101) {
                    $('.clock-pause').click();
                }
                if (event.keyCode == 97) {
                    $(".shot-chart, .shot-chart-home, .shot-chart-away").css({'cursor': 'url(./images/xMark.png), auto'});
                    xOnShotChart = true;
                    oOnShotChart = false;
                }

                if (event.keyCode == 115) {
                    $(".shot-chart, .shot-chart-home, .shot-chart-away").css({'cursor': 'url(./images/oMark.png), auto'});
                    xOnShotChart = false;
                    oOnShotChart = true;
                }
                if (event.keyCode == 100) {
                    $(".shot-chart, .shot-chart-home, .shot-chart-away").css({'cursor': 'default'});
                    xOnShotChart = false;
                    oOnShotChart = false;
                }

                if (xOnShotChart) {
                    XOUrl = "xMark.png"; 
                }
                else if (oOnShotChart) {
                    XOUrl = "oMark.png"  
                } 
                else return;
            });
            $(document).on("click",".shot-chart-away, .shot-chart-home", function(e) {
                var offset = $(this).offset();
                var relativeX = e.pageX - offset.left;
                var relativeY = e.pageY - offset.top;
                var pointsFG;
                var threePtShot = false;
                var shotCoordinatePolygon = [];
                var selected_player;
                console.log("RX: " + relativeX + " RY: " + relativeY); //pixels in the image
                // console.log("LX: "+$('.shot-chart-home').position().left +" "+ "TY: "+$('.shot-chart-home').position().top);
                var shotChartX = ($('.shot-chart-home').position().left == 0) ? $('.shot-chart-away').position().left : $('.shot-chart-home').position().left;
                var shotChartY = ($('.shot-chart-home').position().top == 0) ? $('.shot-chart-away').position().top : $('.shot-chart-home').position().top;
                var shotCoordinateX = parseInt(shotChartX) + parseInt(relativeX);
                var shotCoordinateY = parseInt(shotChartY) + parseInt(relativeY);
                // console.log("SX: " + shotCoordinateX + " SY: " + shotCoordinateY);
                // console.log("EX: " + e.pageX + " EY: " + e.pageY);


                if (!startTime) return;
                for (var i = 0; i < relativePolygon.length; i++) {
                    shotCoordinatePolygon.push([relativePolygon[i][0] + shotChartX, relativePolygon[i][1] + shotChartY]);
                }
                selected_player = $('.selected-player').text().replace(/[^A-Z0-9]/ig, "");

                if(inside([shotCoordinateX, shotCoordinateY], shotCoordinatePolygon)) pointsFG = 2;

                else {
                    threePtShot = true;
                    pointsFG = 3;
                }         
                if($(".shot-chart-home").is(':visible') && (xOnShotChart || oOnShotChart) && ($('.team-home-list li, .team-away-list li').hasClass('selected-player'))) {
                    if (!oOnShotChart) pointsFG = 0;

                    teamHomePlayers[selected_player].shots.push(new Shot(e.pageX , e.pageY, relativeX, relativeY, selected_player, pointsFG, currentQuarter, $(".clock").text(), oOnShotChart));
                    teamHomePlayers[selected_player].stats.fga = teamHomePlayers[selected_player].stats.fga + 1;
                    if(pointsFG == 2){
                        teamHomePlayers[selected_player].stats.fgm = teamHomePlayers[selected_player].stats.fgm + 1;
                    }
                    else if(pointsFG == 3) {
                      teamHomePlayers[selected_player].stats.fgm = teamHomePlayers[selected_player].stats.fgm + 1;
                      teamHomePlayers[selected_player].stats.threepm = teamHomePlayers[selected_player].stats.threepm + 1;
                      teamHomePlayers[selected_player].stats.threepa = teamHomePlayers[selected_player].stats.threepa + 1;  
                    } else if (pointsFG == 0) {
                        if (threePtShot) {
                            teamHomePlayers[selected_player].stats.threepa = teamHomePlayers[selected_player].stats.threepa + 1;
                        }
                    }
                    teamHomePlayers[selected_player].stats.points = teamHomePlayers[selected_player].stats.points + pointsFG;
                    scoreHome = scoreHome + pointsFG;

                    $(".score-1 > span").text(scoreHome);

                    $(".shot-chart-home").append(
                        $('<div></div>')
                            .data('shot-id', teamHomePlayers[selected_player].shots[teamHomePlayers[selected_player].shots.length - 1].shotID)
                            .css('position', 'absolute')
                            .css('top', e.pageY + 'px')
                            .css('left', e.pageX + 'px')
                            .css('width', 10)
                            .css('height', 10)
                            .css('background', 'url(./images/'+XOUrl+')')
                    );
                }

                if($(".shot-chart-away").is(':visible') && (xOnShotChart || oOnShotChart) && ($('.team-home-list li, .team-away-list li').hasClass('selected-player'))) {
                    if (!oOnShotChart) pointsFG = 0;

                    teamAwayPlayers[selected_player].shots.push(new Shot(e.pageX , e.pageY, relativeX, relativeY, selected_player, pointsFG, currentQuarter, $(".clock").text(), oOnShotChart));
                    teamAwayPlayers[selected_player].stats.fga = teamAwayPlayers[selected_player].stats.fga + 1;
                    if(pointsFG == 2){
                        teamAwayPlayers[selected_player].stats.fgm = teamAwayPlayers[selected_player].stats.fgm + 1;
                    }
                    else if(pointsFG == 3) {
                      teamAwayPlayers[selected_player].stats.fgm = teamAwayPlayers[selected_player].stats.fgm + 1;
                      teamAwayPlayers[selected_player].stats.threepm = teamAwayPlayers[selected_player].stats.threepm + 1;
                      teamAwayPlayers[selected_player].stats.threepa = teamAwayPlayers[selected_player].stats.threepa + 1;  
                    } else if (pointsFG == 0) {
                        if (threePtShot) {
                            teamAwayPlayers[selected_player].stats.threepa = teamAwayPlayers[selected_player].stats.threepa + 1;
                        }
                    }
                    teamAwayPlayers[selected_player].stats.points = teamAwayPlayers[selected_player].stats.points + pointsFG;
                    scoreAway = scoreAway + pointsFG;

                    $(".score-2 > span").text(scoreAway);        
                    $(".shot-chart-away").append(
                        $('<div></div>')
                            .data('shot-id', teamAwayPlayers[selected_player].shots[teamAwayPlayers[selected_player].shots.length - 1].shotID)
                            .css('position', 'absolute')
                            .css('top', e.pageY + 'px')
                            .css('left', e.pageX + 'px')
                            .css('width', 10)
                            .css('height', 10)
                            .css('background', 'url(./images/'+XOUrl+')')
                    );
                }

                displayPlayerInfo();
            });
            $(".button-add-quarter").on("click", function(e) {
                currentQuarter = parseInt($(".current-quarter").text());
                currentQuarter = currentQuarter + 1;
                $(".current-quarter").text(currentQuarter);
            });

            $(".button-minus-quarter").on("click", function(e) {
                currentQuarter = parseInt($(".current-quarter").text());
                if (currentQuarter == 1) return;
                currentQuarter = currentQuarter - 1;
                $(".current-quarter").text(currentQuarter);
            });

            $(".poss-1").click(function (e) {
                $(".poss-1").css('background', '#00aeef');
                $(".poss-2").css('background', '#f9f9f9');
            });
            $(".poss-2").click(function (e) {
                $(".poss-2").css('background', '#00aeef');
                $(".poss-1").css('background', '#f9f9f9');
            });

            $(".score-1-add").on("click", function(e) {

                if(!$('.team-home').hasClass('selected-team') || !$('.team-home-list li').hasClass('selected-player')) return;
                var selected_player = $('.selected-player').text().replace(/[^A-Z0-9]/ig, "");
                
                scoreHome = parseInt($(".score-1 > span").text());
                scoreHome = scoreHome + 1;
                $(".score-1 > span").text(scoreHome);

                teamHomePlayers[selected_player].stats.points = teamHomePlayers[selected_player].stats.points + 1;
                displayPlayerInfo();
            });

            $(".score-1-minus").on("click", function(e) {
                
                if(!$('.team-home').hasClass('selected-team') || !$('.team-home-list li').hasClass('selected-player')) return;
                var selected_player = $('.selected-player').text().replace(/[^A-Z0-9]/ig, "");

                scoreHome = parseInt($(".score-1 > span").text());
                if (scoreHome == 0) return;
                scoreHome = scoreHome - 1;
                $(".score-1 > span").text(scoreHome);


                if(teamHomePlayers[selected_player].stats.points == 0) return;
                teamHomePlayers[selected_player].stats.points = teamHomePlayers[selected_player].stats.points - 1;
                displayPlayerInfo();
            });

            $(".score-2-add").on("click", function(e) {

                if(!$('.team-away').hasClass('selected-team') || !$('.team-away-list li').hasClass('selected-player')) return;
                
                var selected_player = $('.selected-player').text().replace(/[^A-Z0-9]/ig, "");
                scoreAway = parseInt($(".score-2 > span").text());
                scoreAway = scoreAway + 1;

                teamAwayPlayers[selected_player].stats.points = teamAwayPlayers[selected_player].stats.points + 1;
                displayPlayerInfo();
            });


            $(".score-2-minus").on("click", function(e) {
                if(!$('.team-away').hasClass('selected-team') || !$('.team-away-list li').hasClass('selected-player')) return;
                var selected_player = $('.selected-player').text().replace(/[^A-Z0-9]/ig, "");
                scoreAway = parseInt($(".score-2 > span").text());
                if (scoreAway == 0) return;
                scoreAway = scoreAway - 1;

                if(teamAwayPlayers[selected_player].stats.points == 0) return;
                teamAwayPlayers[selected_player].stats.points = teamAwayPlayers[selected_player].stats.points - 1;
                displayPlayerInfo();
            });

            $(".tf-1-add").on("click", function(e) {
                if(!$('.team-home').hasClass('selected-team') || !$('.team-home-list li').hasClass('selected-player')) return;
                var selected_player = $('.selected-player').text().replace(/[^A-Z0-9]/ig, "");

                tfHome = parseInt($(".tf-1 > span").text());
                tfHome = tfHome + 1;
                $(".tf-1 > span").text(tfHome);

                teamHomePlayers[selected_player].stats.fouls = teamHomePlayers[selected_player].stats.fouls + 1;
                displayPlayerInfo();

            });

            $(".tf-1-minus").on("click", function(e) {

                if(!$('.team-home').hasClass('selected-team') || !$('.team-home-list li').hasClass('selected-player')) return;
                var selected_player = $('.selected-player').text().replace(/[^A-Z0-9]/ig, "");

                tfHome = parseInt($(".tf-1 > span").text());
                if (tfHome == 0) return;
                tfHome = tfHome - 1;
                $(".tf-1 > span").text(tfHome);

                if (teamHomePlayers[selected_player].stats.fouls == 0) return;
                teamHomePlayers[selected_player].stats.fouls = teamHomePlayers[selected_player].stats.fouls - 1;
                displayPlayerInfo();
            });


            $(".tf-2-add").on("click", function(e) {
                if(!$('.team-away').hasClass('selected-team') || !$('.team-away-list li').hasClass('selected-player')) return;
                var selected_player = $('.selected-player').text().replace(/[^A-Z0-9]/ig, "");

                tfAway = parseInt($(".tf-2 > span").text());
                tfAway = tfAway + 1;
                $(".tf-2 > span").text(tfAway);
                teamAwayPlayers[selected_player].stats.fouls = teamAwayPlayers[selected_player].stats.fouls + 1;
                displayPlayerInfo();
            });

            $(".tf-2-minus").on("click", function(e) {
                if(!$('.team-away').hasClass('selected-team') || !$('.team-away-list li').hasClass('selected-player')) return;
                var selected_player = $('.selected-player').text().replace(/[^A-Z0-9]/ig, "");

                tfAway = parseInt($(".tf-2 > span").text());
                if (tfAway == 0) return;
                tfAway = tfAway - 1;
                $(".tf-2 > span").text(tfAway);

                if (teamAwayPlayers[selected_player].stats.fouls == 0) return;
                teamAwayPlayers[selected_player].stats.fouls = teamAwayPlayers[selected_player].stats.fouls - 1;
                displayPlayerInfo();
            });

            //fts insert here

            $('.ftm-1-add').on("click", function(e) {
                if(!$('.team-home').hasClass('selected-team') || !$('.team-home-list li').hasClass('selected-player')) return;
                if($(".ft-1 > p > span:first-child").text() == "--") {
                    ftmHome = 0;
                }
                ftmHome = ftmHome + 1;
                ftaHome = ftaHome + 1;

                scoreHome = parseInt($(".score-1 > span").text());
                scoreHome = scoreHome + 1;

                $(".score-1 > span").text(scoreHome);
                $(".ft-1 > p > span:first-child").text(ftmHome);
                $(".ft-1 > p > span:nth-child(2)").text(ftaHome);

                var selected_player = $('.selected-player').text().replace(/[^A-Z0-9]/ig, "");

                teamHomePlayers[selected_player].stats.ftm = teamHomePlayers[selected_player].stats.ftm + 1;
                teamHomePlayers[selected_player].stats.fta = teamHomePlayers[selected_player].stats.fta + 1; 
                teamHomePlayers[selected_player].stats.points = teamHomePlayers[selected_player].stats.points + 1; 
                $(".indiv-ftm > h3").text(teamHomePlayers[selected_player].stats.ftm);
                $(".indiv-fta > h3").text(teamHomePlayers[selected_player].stats.fta);
                $(".indiv-points > h3").text(teamHomePlayers[selected_player].stats.points);

                teamHomePlayers[selected_player].ftshots.push(new FreeThrowShot(selected_player, 1, parseInt($(".current-quarter").text()),  $(".clock").text(), true));

                displayPlayerInfo();
            });

            $('.ftm-1-minus').on("click", function(e) {
                if(!$('.team-home').hasClass('selected-team') || !$('.team-home-list li').hasClass('selected-player')) return;
                if($(".ft-1 > p > span:first-child").text() == "--" ||
                    $(".ft-1 > p > span:first-child").text() == "0") {

                    $(".ft-1 > p > span:first-child").text("--");
                    if (ftaHome == 0) {
                        $(".ft-1 > p > span:nth-child(2)").text("--");
                    }
                    
                    return;
                }
                ftmHome = ftmHome - 1;
                ftaHome = ftaHome - 1;

                $(".ft-1 > p > span:first-child").text(ftmHome);
                $(".ft-1 > p > span:nth-child(2)").text(ftaHome);

                var selected_player = $('.selected-player').text().replace(/[^A-Z0-9]/ig, "");
                if (teamHomePlayers[selected_player].stats.ftm == 0) return;
                teamHomePlayers[selected_player].stats.ftm = teamHomePlayers[selected_player].stats.ftm - 1;
                teamHomePlayers[selected_player].stats.fta = teamHomePlayers[selected_player].stats.fta - 1; 
                $(".indiv-ftm > h3").text(teamHomePlayers[selected_player].stats.ftm);
                $(".indiv-fta > h3").text(teamHomePlayers[selected_player].stats.fta);

                displayPlayerInfo();
            });

            $('.ftm-2-add').on("click", function(e) {
                if(!$('.team-away').hasClass('selected-team') || !$('.team-away-list li').hasClass('selected-player')) return;
                if($(".ft-2 > p > span:first-child").text() == "--") {
                    ftmAway = 0;
                }
                ftmAway = ftmAway + 1;
                ftaAway = ftaAway + 1;

                scoreAway = parseInt($(".score-2 > span").text());
                scoreAway = scoreAway + 1;

                $(".score-2 > span").text(scoreAway);
                $(".ft-2 > p > span:first-child").text(ftmAway);
                $(".ft-2 > p > span:nth-child(2)").text(ftaAway);

                var selected_player = $('.selected-player').text().replace(/[^A-Z0-9]/ig, "");

                teamAwayPlayers[selected_player].stats.ftm = teamAwayPlayers[selected_player].stats.ftm + 1;
                teamAwayPlayers[selected_player].stats.fta = teamAwayPlayers[selected_player].stats.fta + 1; 
                teamAwayPlayers[selected_player].stats.points = teamAwayPlayers[selected_player].stats.points + 1; 
                $(".indiv-ftm > h3").text(teamAwayPlayers[selected_player].stats.ftm);
                $(".indiv-fta > h3").text(teamAwayPlayers[selected_player].stats.fta);
                $(".indiv-points > h3").text(teamAwayPlayers[selected_player].stats.points);

                teamAwayPlayers[selected_player].ftshots.push(new FreeThrowShot(selected_player, 1, parseInt($(".current-quarter").text()),  $(".clock").text(), true));

                displayPlayerInfo();
            });

            $('.ftm-2-minus').on("click", function(e) {
                if(!$('.team-away').hasClass('selected-team') || !$('.team-away-list li').hasClass('selected-player')) return;
                if($(".ft-2 > p > span:first-child").text() == "--" ||
                    $(".ft-2 > p > span:first-child").text() == "0") {

                    $(".ft-2 > p > span:first-child").text("--");
                    if (ftaAway == 0) {
                        $(".ft-2 > p > span:nth-child(2)").text("--");
                    }
                    
                    return;
                }
                ftmAway = ftmAway - 1;
                ftaAway = ftaAway - 1;

                $(".ft-2 > p > span:first-child").text(ftmAway);
                $(".ft-2 > p > span:nth-child(2)").text(ftaAway);

                var selected_player = $('.selected-player').text().replace(/[^A-Z0-9]/ig, "");
                if (teamAwayPlayers[selected_player].stats.ftm == 0) return;
                teamAwayPlayers[selected_player].stats.ftm = teamAwayPlayers[selected_player].stats.ftm - 1;
                teamAwayPlayers[selected_player].stats.fta = teamAwayPlayers[selected_player].stats.fta - 1; 
                $(".indiv-ftm > h3").text(teamAwayPlayers[selected_player].stats.ftm);
                $(".indiv-fta > h3").text(teamAwayPlayers[selected_player].stats.fta);

                displayPlayerInfo();
            });


            $(".fta-1-add").on("click", function(e) {
                if(!$('.team-home').hasClass('selected-team') || !$('.team-home-list li').hasClass('selected-player')) return;
                if($(".ft-1 > p > span:first-child").text() == "--") {
                    ftaHome = 0;
                }
                ftaHome = ftaHome + 1;
                $(".ft-1 > p > span:nth-child(2)").text(ftaHome);
                var selected_player = $('.selected-player').text().replace(/[^A-Z0-9]/ig, "");
                teamHomePlayers[selected_player].stats.fta = teamHomePlayers[selected_player].stats.fta + 1; 
                $(".indiv-fta > h3").text(teamHomePlayers[selected_player].stats.fta);

                teamHomePlayers[selected_player].ftshots.push(new FreeThrowShot(selected_player, 1, parseInt($(".current-quarter").text()), $(".clock").text(), false));

                displayPlayerInfo();
            });

            $(".fta-1-minus").on("click", function(e) {
                if(!$('.team-home').hasClass('selected-team') || !$('.team-home-list li').hasClass('selected-player')) return;
                if($(".ft-1 > p > span:nth-child(2)").text() == "--" || 
                    $(".ft-1 > p > span:nth-child(2)").text() == "0") {
                    $(".ft-1 > p > span:nth-child(2)").text("--");
                    $(".ft-1 > p > span:first-child").text("--");
                    return;
                }

                if (ftaHome == ftmHome){
                    ftmHome = ftmHome - 1;
                    $(".ft-1 > p > span:first-child").text(ftmHome);
                }

                ftaHome = ftaHome - 1;
                $(".ft-1 > p > span:nth-child(2)").text(ftaHome);
                var selected_player = $('.selected-player').text().replace(/[^A-Z0-9]/ig, "");
                if (teamHomePlayers[selected_player].stats.fta == 0) return;
                if (teamHomePlayers[selected_player].stats.ftm == teamHomePlayers[selected_player].stats.fta) {
                    teamHomePlayers[selected_player].stats.ftm = teamHomePlayers[selected_player].stats.ftm - 1;     
                    $(".indiv-ftm > label").text(teamHomePlayers[selected_player].stats.ftm);
                }
                teamHomePlayers[selected_player].stats.fta = teamHomePlayers[selected_player].stats.fta - 1; 
                $(".indiv-fta > label").text(teamHomePlayers[selected_player].stats.fta);

                displayPlayerInfo();

            });

            $(".fta-2-add").on("click", function(e) {
                if(!$('.team-away').hasClass('selected-team') || !$('.team-away-list li').hasClass('selected-player')) return;
                if($(".ft-2 > p > span:first-child").text() == "--") {
                    ftaAway = 0;
                }
                ftaAway = ftaAway + 1;
                $(".ft-2 > p > span:nth-child(2)").text(ftaAway);
                var selected_player = $('.selected-player').text().replace(/[^A-Z0-9]/ig, "");
                teamAwayPlayers[selected_player].stats.fta = teamAwayPlayers[selected_player].stats.fta + 1; 
                $(".indiv-fta > h3").text(teamAwayPlayers[selected_player].stats.fta);

                teamAwayPlayers[selected_player].ftshots.push(new FreeThrowShot(selected_player, 1, parseInt($(".current-quarter").text()), $(".clock").text(), false));
                displayPlayerInfo();
            });

            $(".fta-2-minus").on("click", function(e) {
                if(!$('.team-away').hasClass('selected-team') || !$('.team-away-list li').hasClass('selected-player')) return;
                if($(".ft-2 > p > span:nth-child(2)").text() == "--" || 
                    $(".ft-2 > p > span:nth-child(2)").text() == "0") {
                    $(".ft-2 > p > span:nth-child(2)").text("--");
                    $(".ft-2 > p > span:first-child").text("--");
                    return;
                }

                if (ftaAway == ftmAway){
                    ftmAway = ftmAway - 1;
                    $(".ft-1 > p > span:first-child").text(ftmAway);
                }

                ftaAway = ftaAway - 1;
                $(".ft-1 > p > span:nth-child(2)").text(ftaAway);
                var selected_player = $('.selected-player').text().replace(/[^A-Z0-9]/ig, "");
                if (teamAwayPlayers[selected_player].stats.fta == 0) return;
                if (teamAwayPlayers[selected_player].stats.ftm == teamAwayPlayers[selected_player].stats.fta) {
                    teamAwayPlayers[selected_player].stats.ftm = teamAwayPlayers[selected_player].stats.ftm - 1;     
                    $(".indiv-ftm > label").text(teamAwayPlayers[selected_player].stats.ftm);
                }
                teamAwayPlayers[selected_player].stats.fta = teamAwayPlayers[selected_player].stats.fta - 1; 
                $(".indiv-fta > label").text(teamAwayPlayers[selected_player].stats.fta);

                displayPlayerInfo();

            });
            $(".clock-24").on("click", function(e) {
                 $(".shot-clock").text("24.2");
            });
            $(".clock-14").on("click", function(e) {
                 $(".shot-clock").text("14.2");
            });


            $(".clock-start").on('click', function(){
                if(startTime) return;
                $('.shot-chart-home > .selected-shot, .shot-chart-away > .selected-shot').remove();
                $(".clock").attr('contentEditable', 'false');
                $('.scoreboard > div > span, .scoreboard > div > p > span').attr('contentEditable', false);
                $('.shot-clock').attr('contentEditable', false);
                startTime = true;
                startTimer();
                
            });

            $(".clock-pause").on('click', function(){
                $('.current-quarter, .clock, .shot-clock').attr('contentEditable', true);
                
                startTime = false;

                $('.indiv-player-pic img').remove();
                $('.indiv-player-pic label:last-of-type').text("");
                $(".indiv-points > h3").text("");
                $(".indiv-fgm > h3").text("");
                $(".indiv-fga > h3").text("");
                $(".indiv-threepm > h3").text("");
                $(".indiv-threepa > h3").text("");
                $(".indiv-ftm > h3").text("");
                $(".indiv-fta > h3").text("");
                $(".indiv-fouls > h3").text("");
                $(".indiv-player-fg-shots > ul").remove();
                $(".indiv-player-ft-shots > ul").remove();
                reset();
            });

            $(".clock-reset").on('click', function(){
                if (startTime) {
                    alert("Must pause time first");
                    return;
                }
                $(".clock").text("00:00.0");
                $(".shot-clock").text("24.0");
                $(".clock").attr('contentEditable', 'true');
            });

            startTimer = function() {
                if (startTime) {
                    time = $(".clock").text().split(".");
                    shot_clock = $(".shot-clock").text().split(".");
                    shot_clock_millis = parseInt(shot_clock[1]);
                    shot_clock_seconds = parseInt(shot_clock[0]);
                    time_millis = parseInt(time[1])
                    time = time[0].split(":")
                    time_minutes = parseInt(time[0]);
                    time_seconds = parseInt(time[1]);


                    if (time_minutes > 0 || time_seconds > 0 || time_millis > 0) {
                        time_millis--;
                        if (time_millis < 0) {
                            time_seconds--;
                            if (time_seconds < 0) {
                                time_minutes--;
                                time_seconds = 59;
                            }
                            time_millis = 9;
                        }
                        shot_clock_millis--;
                        if (shot_clock_millis < 0) {
                            shot_clock_seconds--;
                            if (shot_clock_seconds < 0) {
                                shot_clock_seconds = 24;
                            }
                            shot_clock_millis = 9;
                        }

                        timer = setTimeout(startTimer, 100);
                    } else {
                        startTime = false;
                    }

                    if (time_seconds < 10) {
                        $(".clock").text(time_minutes + ":" + "0" + time_seconds + "." + time_millis);    
                    } else {
                        $(".clock").text(time_minutes + ":" + time_seconds + "." + time_millis);    
                    }

                    if (time_minutes < 10) {
                        $(".clock").text( "0" + time_minutes + ":" + time_seconds + "." + time_millis);    
                    }
                    $('.shot-clock').text(shot_clock_seconds + "." + shot_clock_millis);
                }
            }
            
        </script>
    </body>
</html>