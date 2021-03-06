<!DOCTYPE html>
<?php
    $host = "localhost";
    $user = "root";
    $pass = "";
    $db = "ShotChartDB";
    $errors = array();

    $con = mysqli_connect($host, $user, $pass, $db) or die("Connection Failed");

    $SelectedTeamID = isset($_POST['SelectedTeamID']) ? $_POST['SelectedTeamID'] : '';
    $SelectedGameID = isset($_POST['SelectedGameID']) ? $_POST['SelectedGameID'] : '';

    

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

                                            if($SelectedTeamID == $row['TeamID']) {
                                                echo "<option value='".$row['TeamID']."' selected>".$row['TeamName']."</option>";
                                                continue;    
                                            }
                                            echo "<option value='".$row['TeamID']."'>".$row['TeamName']."</option>";
                                        }
                                    ?>
                                </select>
                            </li>
                            <li>
                                <label>Games</label>
                                <select id="select-game" name="select_game">
                                    <option value="0" disabled selected>Select Game</option>
                                    <?php
                                        $res = mysqli_query($con, "SELECT * FROM GAME WHERE TeamHomeID='".$SelectedTeamID."' OR TeamAwayID='".$SelectedTeamID."'");
                                        while ($row = mysqli_fetch_array($res)) {
                                            if($SelectedGameID == $row['GameID']) {
                                                echo "<option value='".$row['GameID']."' selected>".$row['GameName']."</option>";
                                                continue;    
                                            }
                                            echo "<option value='".$row['GameID']."'>".$row['GameName']."</option>";
                                        }
                                    ?>
                                </select>
                            </li>
                            <li>
                                <label>Game Info</label>
                                <div class="selected-team-game-info">
                                    <?php
                                        $res = mysqli_query($con, "SELECT COUNT(*) as NumberOfGames FROM GAME WHERE TeamHomeID='".$SelectedTeamID."' OR TeamAwayID='".$SelectedTeamID."'");
                                        $data = mysqli_fetch_assoc($res);
                                    ?>
                                    <label>Number of Games: <?php echo $data['NumberOfGames']?></label>
                                    <?php
                                        $res = mysqli_query($con, "SELECT team.TeamName, game.GameID, team.TeamID, game.GameName from team INNER JOIN game ON team.TeamID = game.TeamHomeID WHERE game.GameID='".$SelectedGameID."';");
                                        $data = mysqli_fetch_assoc($res);
                                    ?>
                                    <label>Team Home: <?php echo $data['TeamName']?></label>
                                    <?php
                                        $res = mysqli_query($con, "SELECT team.TeamName, game.GameID, team.TeamID, game.GameName from team INNER JOIN game ON team.TeamID = game.TeamAwayID WHERE game.GameID='".$SelectedGameID."';");
                                        $data = mysqli_fetch_assoc($res);
                                    ?>
                                    <label>Team Away: <?php echo $data['TeamName']?></label>
                                </div>
                            </li>
                            <li>
                                <label>
                                    Players
                                </label>
                                <div class="selected-team-players">
                                    <?php
                                        $res = mysqli_query($con, "SELECT * FROM PLAYER WHERE TeamID='".$SelectedTeamID."'");
                                        while($row = mysqli_fetch_array($res)) {
                                    ?>

                                    <div>
                                        <label><?php  echo $row['PlayerName']?></label>
                                    </div>
                                    <?php 
                                        } 
                                    ?>
                                    
                                </div>
                            </li>
                            <li>
                                <label>Quarter</label>
                                <div class="quarter-number">
                                    <?php
                                        $res = mysqli_query($con, "SELECT Quarter FROM GAME WHERE GameID='".$SelectedGameID."'");
                                        $data = mysqli_fetch_assoc($res);

                                        for ($i=1; $i <= $data['Quarter']; $i++) { 
                                            echo "<button style='background-color: #a9a9a9;'>Q".$i."</button>";
                                        }
                                    ?>
                                </div>
                                <div class="radio-button-team-zones">
                                        <input type="radio" id="hot-zone-team" name="Hot Zone" value="hot-zone">  Hot Zone 
                                        <input type="radio" id="shot-zone-team" name="Hot Zone" value="shot-zone">  Shot Zone
                                        <input type="radio" id="remove-zone-team" name="Hot Zone" value="remove-zone">  Remove Zone
                                </div>
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
                            Teams
                        </label>

                        <a href="teams.php"> <label> < Back </label></a>
                        
                        <div class="selected-team-individual">
                            <div class="team-shot-chart text-center"></div>
                            <div>
                                <div class="selected-team-image text-center">
                                    <?php
                                        $row = mysqli_query($con, "SELECT * FROM TEAM WHERE TeamID='".$SelectedTeamID."';");
                                        $data = mysqli_fetch_assoc($row);
                                        $SelectedTeamID = $data['TeamID'];
                                    ?>
                                    <img src="./images/teams/<?php echo $data['Image']?>" alt="" width="100px" height="100px" />
                                    <label><?php echo $data['TeamName']?></label>

                                </div>
                                
                                <div class="selected-team-interpretation">
                                    <label>Quarter: <label></label></label>
                                    <table class="selected-team-interpretation-table">
                                        <tr>
                                            <th> </th>
                                            <th>Shots Made</th>
                                            <th>Attempted Shots</th>
                                        </tr>
                                        <tr>
                                            <td>Painted</td>
                                            <td class="shots-made-painted">0/0</td>
                                            <td class="attempted-shots-painted">0/0</td>
                                        </tr>
                                        <tr>
                                            <td>Mid Range</td>
                                            <td class="shots-made-mid-range">0/0</td>
                                            <td class="attempted-shots-mid-range">0/0</td>
                                        </tr>
                                        <tr>
                                            <td>Outside</td>
                                            <td class="shots-made-outside">0/0</td>
                                            <td class="attempted-shots-outside">0/0</td>
                                        </tr>
                                    </table>
                                    <label>Tendency: <label></label></label>
                                </div>
                            </div>
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

            var SelectedGameID = $('#select-game option:selected').val();
            var SelectedTeamID = $('#select-team option:selected').val();
            var area1 = [[148, 2], [148, 8], [148, 14], [149, 18], [151, 27], [153, 35], [154, 36], [155,41], [155,39], [153,36], [156,35], [157,46], [161,54], [165, 60], [170, 69], [177, 77],
            [185, 86], [194, 93], [204, 100], [218, 106], [226, 109], [233, 111], [243, 112], [259, 113], [265, 113], [271, 112], [278, 111],
            [285, 109], [297, 104], [304, 108], [316, 93], [328, 81], [337, 72], [344, 62], [357, 47], [356, 38], [359, 24], [361, 13], [362, 1]];

            var area2=[[76,2], [145,2], [145,12], [146, 20], [149, 33], [153, 45], [158, 55], [164,64], [171, 74], [178, 83], [189, 93], [205, 103], [175, 156], [157, 146], [146, 138], [132, 126], [119, 112], [113, 105], [107, 96], [106, 90], [102, 88], [105, 93], [102, 87],  [100, 85], [110, 101], [109, 101], [99, 84], [96, 79], [89, 63], [83, 44], [79, 26], [78, 14], [77, 7]];

            var area3=[[206, 104], [177, 156], [187, 160], [198, 164], [211, 168], [225, 171], [237, 172], [254, 173], [272, 172], [287, 169], [302, 165], [317, 160], [332, 154], [304, 103], [295, 107], [286, 110], [277, 113], [268, 114], [243, 115], [231, 112], [220, 109], [206, 103]];
            var area4=[[306, 102], [334, 153], [352, 142], [371, 126], [384, 113], [397, 95], [407, 78], [417, 56], [423, 32], [425, 13], [426, 4], [426, 0], [364, 0], [364, 14], [361, 29], [353, 50], [343, 66], [330, 82], [318, 93]];
            var area5=[[30, 0], [76, 0], [76, 16], [78, 33], [82, 49], [87, 64], [92, 74], [100, 89], [47, 134], [31, 111]];
            var area6=[[99, 90], [47, 134], [69, 159], [86, 174], [108, 189], [130, 200], [147, 208], [170, 215], [188, 220], [200 ,221], [217, 172], [196, 166], [176, 157], [158, 148], [135, 131], [119, 116], [106, 98], [100, 89]];
            var area7=[[217, 172], [199, 222], [217, 225], [263, 226], [282, 225], [296, 223], [306, 221], [288, 170], [268, 174], [233, 174], [219, 172]];
            var area8=[[288, 171], [306, 221], [334, 214], [367, 202], [399, 184], [427, 163], [445, 144], [455, 131], [404, 87], [392, 104], [373, 126], [352, 143], [326, 158], [308, 165], [292, 170]];
            var area9=[[427, 0], [469, 0], [469, 110], [455, 131], [404, 87], [415, 64], [421, 45], [425, 24]];
            var area10=[[0, 0], [30, 0], [30, 110], [0, 110]];
            var area11=[[0, 111], [31, 111], [65, 156], [88, 176], [112, 192], [145, 207], [180, 218], [212, 224], [155, 374], [0, 374]];
            var area12=[[212, 225], [274, 226], [288, 225], [346, 374], [156, 374]];
            var area13=[[289, 225], [319, 219], [360, 206], [396, 187], [430, 161], [459, 128], [472, 108], [500, 108], [500, 375], [346, 375]];
            var area14=[[470, 0], [500, 0], [500, 106], [470, 106]];

            var areas=[area1, area2, area3, area4, area5, area6, area7, area8, area9, area10, area11, area12, area13, area14];

            var paintedArea=[[170, 0], [170, 150], [329, 150], [329, 0]];
            var midRangeArea=[[31, 0], [31, 110], [51, 140], [77, 167], [112, 191], [149, 208], [188, 220], [217, 225], [282, 225], [325, 217], [364, 203], [411, 176], [448, 141], [469, 110], [469, 0], [329, 0], [329, 150], [170, 150], [170, 0]];
            $(document).ready(function () {
                $('html,body').animate({scrollTop: $('.team-shot-chart').position().top -130}, 2000);
            });
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

            function removeTeamShotZone() {
                $('#team-shot-zone').remove();
                $('.team-shot-chart').css('background', 'url(./images/half-court-resize.png)');
            }

            function displayTeamShotZone() {
                removeTeamShotZone();
                var shotChartHeight = $('.team-shot-chart').height();
                var shotChartWidth = $('.team-shot-chart').width();
                var shotChartX = $('.team-shot-chart').position().left;
                var shotChartY = $('.team-shot-chart').position().top;
                var canvas = $('<canvas width="'+shotChartWidth+'" height="'+shotChartHeight+'"></canvas>');
                var ctx = canvas[0].getContext('2d');
                var shotCountHome=[];

                $.each($('.team-shot-chart > div'), function(i, value) {
                    shotCoordinate=[$(this).data('shot-coordinate-x'), $(this).data('shot-coordinate-y')];
                    for (var i = 0; i < areas.length; i++) {
                        if(inside([shotCoordinate[0], shotCoordinate[1]], areas[i])){
                            if(shotCountHome[i + 1] == null) {
                                shotCountHome[i + 1] = 1;
                            } else {
                                shotCountHome[i + 1] = shotCountHome[i + 1] + 1;
                            }
                        }
                    }
                });
                
                for(var i = 0; i < areas.length; i++) {
                    ctx.beginPath();
                    ctx.moveTo(areas[i][0][0], areas[i][0][1]);

                    ctx.fillStyle = '#00FFFF';
                    if(shotCountHome[i+1] == null || shotCountHome[i+1] == 0) ctx.fillStyle = '#00FFFF';
                    else if(((shotCountHome[i+1]*100)/parseFloat($('.team-shot-chart > div').length) >= 0) && ((shotCountHome[i+1]*100)/parseFloat($('.team-shot-chart > div').length) < 20) ) ctx.fillStyle = '#00e5e5'; 
                    else if(((shotCountHome[i+1]*100)/parseFloat($('.team-shot-chart > div').length) >= 20) && ((shotCountHome[i+1]*100)/parseFloat($('.team-shot-chart > div').length) < 40) ) ctx.fillStyle = '#00aeef';  
                    else if(((shotCountHome[i+1]*100)/parseFloat($('.team-shot-chart > div').length) >= 40) && ((shotCountHome[i+1]*100)/parseFloat($('.team-shot-chart > div').length) < 60)) ctx.fillStyle = '#ffa500';
                    else if(((shotCountHome[i+1]*100)/parseFloat($('.team-shot-chart > div').length) >= 60) && ((shotCountHome[i+1]*100)/parseFloat($('.team-shot-chart > div').length) <= 100)) ctx.fillStyle = '#FF4500';

                    console.log("i:" + i + "ctx.fillStyle: " + ctx.fillStyle);
                    $.each(areas[i], function(i, value){
                        ctx.lineTo(value[0], value[1]);
                    });
                    ctx.closePath();
                    ctx.fill();
                }

                var dataUrl = canvas[0].toDataURL();
                $('.team-shot-chart').css('background', 'url('+dataUrl+')');
                $('#team-shot-zone').remove();
                $('.team-shot-chart').append('<img id="team-shot-zone" src="./images/half-court-hot-zone.png" style="margin-left:auto; margin-right:auto; background:"transparent";/>');
            }
            function removeTeamHotZone() {
                $('#team-hot-zone').remove();
                $('.team-shot-chart').css('background', 'url(./images/half-court-resize.png)');
            }
            function displayTeamHotZone() {
                removeTeamHotZone();
                var shotChartHeight = $('.team-shot-chart').height();
                var shotChartWidth = $('.team-shot-chart').width();
                var shotChartX = $('.team-shot-chart').position().left;
                var shotChartY = $('.team-shot-chart').position().top;
                var canvas = $('<canvas width="'+shotChartWidth+'" height="'+shotChartHeight+'"></canvas>');
                var ctx = canvas[0].getContext('2d');
                var shotCountHome=[];

                $.each($('.team-shot-chart > div'), function(i, value) {
                    shotCoordinate=[$(this).data('shot-coordinate-x'), $(this).data('shot-coordinate-y')];
                    for (var i = 0; i < areas.length; i++) {
                        if(inside([shotCoordinate[0], shotCoordinate[1]], areas[i]) && $(this).data('made-shot')){
                            if(shotCountHome[i + 1] == null) {
                                shotCountHome[i + 1] = 1;
                            } else {
                                shotCountHome[i + 1] = shotCountHome[i + 1] + 1;
                            }
                        }
                    }
                });
                
                for(var i = 0; i < areas.length; i++) {
                    ctx.beginPath();
                    ctx.moveTo(areas[i][0][0], areas[i][0][1]);

                    ctx.fillStyle = '#00FFFF';
                    if(shotCountHome[i+1] == null || shotCountHome[i+1] == 0) ctx.fillStyle = '#00FFFF';
                    else if(((shotCountHome[i+1]*100)/parseFloat($('.team-shot-chart > div').length) >= 0) && ((shotCountHome[i+1]*100)/parseFloat($('.team-shot-chart > div').length) < 20) ) ctx.fillStyle = '#00e5e5'; 
                    else if(((shotCountHome[i+1]*100)/parseFloat($('.team-shot-chart > div').length) >= 20) && ((shotCountHome[i+1]*100)/parseFloat($('.team-shot-chart > div').length) < 40) ) ctx.fillStyle = '#00aeef'; 
                    else if(((shotCountHome[i+1]*100)/parseFloat($('.team-shot-chart > div').length) >= 40) && ((shotCountHome[i+1]*100)/parseFloat($('.team-shot-chart > div').length) < 60)) ctx.fillStyle = '#ffa500';
                    else if(((shotCountHome[i+1]*100)/parseFloat($('.team-shot-chart > div').length) >= 60) && ((shotCountHome[i+1]*100)/parseFloat($('.team-shot-chart > div').length) <= 100)) ctx.fillStyle = '#FF4500';

                    $.each(areas[i], function(i, value){
                        ctx.lineTo(value[0], value[1]);
                    });
                    ctx.closePath();
                    ctx.fill();
                }

                var dataUrl = canvas[0].toDataURL();
                $('.team-shot-chart').css('background', 'url('+dataUrl+')');
                $('#team-hot-zone').remove();
                $('.team-shot-chart').append('<img id="team-hot-zone" src="./images/half-court-hot-zone.png" style="margin-left:auto; margin-right:auto; background:"transparent";/>');
            }

            function updateInterpretationTable() {
                var shotChartX = $('.team-shot-chart').position().left;
                var shotChartY = $('.team-shot-chart').position().top;
                var paintedAreaNumMade = 0;
                var paintedAreaNumAttempt = 0;
                var midRangeAreaNumMade = 0;
                var midRangeAreaNumAttempt = 0;
                var outsideAreaNumMade = 0;
                var outsideAreaNumAttempt = 0;
                var paintedPercentage = 0;
                var midRangePercentage = 0;
                var outsidePercentage = 0;
                var totalShotsDisplay = $('.team-shot-chart > div').length;

                var interpretationText = '';
                $.each($('.team-shot-chart > div'), function(i, value) {
                    shotCoordinate=[$(this).data('shot-coordinate-x'), $(this).data('shot-coordinate-y')];
                    madeShot = $(this).data('made-shot');

                    if(inside([shotCoordinate[0], shotCoordinate[1]], paintedArea)) {
                        if(madeShot) {
                            paintedAreaNumMade = paintedAreaNumMade + 1;
                        }
                        paintedAreaNumAttempt = paintedAreaNumAttempt + 1;
                    } else if (inside([shotCoordinate[0], shotCoordinate[1]], midRangeArea)) {
                        if(madeShot) {
                            midRangeAreaNumMade = midRangeAreaNumMade + 1;
                        }

                        midRangeAreaNumAttempt = midRangeAreaNumAttempt + 1;
                    } else {
                        if (madeShot) {
                            outsideAreaNumMade = outsideAreaNumMade + 1; 
                        }
                        outsideAreaNumAttempt = outsideAreaNumAttempt + 1;
                    } 
                });

                paintedPercentage = parseFloat(paintedAreaNumAttempt)/parseFloat(totalShotsDisplay);
                midRangePercentage = parseFloat(midRangeAreaNumAttempt)/parseFloat(totalShotsDisplay);
                outsidePercentage = parseFloat(outsideAreaNumAttempt)/parseFloat(totalShotsDisplay);

                
                $('.shots-made-painted').text(paintedAreaNumMade + "/" + paintedAreaNumAttempt);
                $('.shots-made-mid-range').text(midRangeAreaNumMade + "/" + midRangeAreaNumAttempt);
                $('.shots-made-outside').text(outsideAreaNumMade + "/" + outsideAreaNumAttempt);

                $('.attempted-shots-painted').text(paintedAreaNumAttempt + "/" + totalShotsDisplay);
                $('.attempted-shots-mid-range').text(midRangeAreaNumAttempt + "/" + totalShotsDisplay);
                $('.attempted-shots-outside').text(outsideAreaNumAttempt + "/" + totalShotsDisplay);
                

                if(paintedPercentage >= midRangePercentage) {
                    if(paintedPercentage > outsidePercentage) {
                        interpretationText = "Painted Area";
                    }
                    if(paintedPercentage == midRangePercentage) {
                        interpretationText = "Painted Area and Mid Range Area";
                    }
                } if(midRangePercentage > paintedPercentage) {
                    if(midRangePercentage > outsidePercentage) {
                        interpretationText = "Mid Range Area"
                    }
                    if(midRangePercentage == outsidePercentage) {
                        interpretationText = "Mid Range Area and Outside Area";
                    }
                } if (outsidePercentage > paintedPercentage) {
                    if(outsidePercentage > midRangePercentage) {
                        interpretationText = "Outside Area";
                    }
                    if (outsidePercentage == paintedPercentage) {
                        interpretationText = "Painted Area and Outside Area";
                    }
                } else if(outsidePercentage == paintedPercentage && outsidePercentage == midRangePercentage) interpretationText = "Painted Area, Mid Range Area, and Outside Area";

                $('.selected-team-interpretation > label:nth-of-type(2) > label').text('');
                $('.selected-team-interpretation > label:nth-of-type(2) > label').text(interpretationText);

            }
            $('#select-team').change(function () {
                SelectedTeamID = $('#select-team option:selected').val();
                $('.quarter-number > button').remove();
                $.redirect("/shotchart/team-individual.php", {"SelectedTeamID": SelectedTeamID}); 
            });

            $('#select-game').change(function () {
                SelectedTeamID = $('#select-team option:selected').val();
                SelectedGameID = $('#select-game option:selected').val();
                $('.quarter-number > button').remove();
                document.location.reload(true);                
                $.redirect("/shotchart/team-individual.php", {"SelectedTeamID": SelectedTeamID, "SelectedGameID": SelectedGameID}); 
            });

            $(document).on("click", '.quarter-number > button', function(e) {
                if($(this).hasClass('quarter-active')){
                    $(this).removeClass('quarter-active');
                    $(this).css('background-color', '#a9a9a9');
                } else {
                    $(this).addClass('quarter-active');
                    $(this).css('background-color', '#3abdee');
                }
                
                removeTeamHotZone();
                $('.team-shot-chart > div').remove();
                var quarterInterpretationText='';
                $('.selected-team-interpretation > label:first-of-type > label').text('');
                $('.quarter-active').each(function(i, obj) {
                    if(i == $('.quarter-active').length - 1) quarterInterpretationText = quarterInterpretationText + $(this).text().trim();
                    else quarterInterpretationText = quarterInterpretationText + $(this).text().trim()+ ", ";
                    $.post("./team-individual-functions/team-individual-load-shots.php", {
                        SelectedGameID: SelectedGameID,
                        SelectedTeamID: SelectedTeamID,
                        ShotChartX: $('.team-shot-chart').position().left,
                        ShotChartY: $('.team-shot-chart').position().top,
                        CurrentQuarter: $(this).text().replace(/[^\d]/g, "")
                    })
                     .success(function(data){
                        $('.team-shot-chart').append(data);
                        updateInterpretationTable();
                        if($('#hot-zone-team').is(':checked')) {
                            displayTeamHotZone();
                        } else if ($('#shot-zone-team').is(':checked')) {
                            displayTeamShotZone();
                        }
                     });
                });
                $('.selected-team-interpretation > label:first-of-type > label').text(quarterInterpretationText);

            })

            $(document).on("change", '#hot-zone-team', function() {
                updateInterpretationTable();
                removeTeamShotZone();
                if($('#hot-zone-team').is(':checked')) {
                    displayTeamHotZone();
                } 
                else if ($('#hot-zone-team').not(':checked')) {
                    removeTeamHotZone();
                } 
            });

            $(document).on("change", '#shot-zone-team', function() {
                updateInterpretationTable();
                removeTeamHotZone();
                if($('#shot-zone-team').is(':checked')) {
                    displayTeamShotZone();
                }
                else if ($('#shot-zone-team').not(':checked')) removeTeamShotZone();
            })

            $(document).on("change", '#remove-zone-team', function() {
                removeTeamShotZone();
                removeTeamHotZone();
            });

        </script>
    </body>
</html>