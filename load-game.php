<!DOCTYPE html>
<?php
    $host = "localhost";
    $user = "root";
    $pass = "";
    $db = "ShotChartDB";
    $errors = array();

    $con = mysqli_connect($host, $user, $pass, $db) or die("Connection Failed");


    $SelectedLeagueID = isset($_POST['SelectedLeagueID']) ? $_POST['SelectedLeagueID'] : '';
    $SelectedLeagueName = isset($_POST['SelectedLeagueName']) ? $_POST['SelectedLeagueName'] : '';
    $SelectedHomeName = isset($_POST['SelectedHomeName']) ? $_POST['SelectedHomeName'] : '';
    $SelectedHomeTeamID = isset($_POST['SelectedHomeTeamID']) ? $_POST['SelectedHomeTeamID'] : '';
    $SelectedAwayName = isset($_POST['SelectedAwayName']) ? $_POST['SelectedAwayName'] : '';
    $SelectedAwayTeamID = isset($_POST['SelectedAwayTeamID']) ? $_POST['SelectedAwayTeamID'] : '';
    $SelectedGameName = isset($_POST['SelectedGameName']) ? $_POST['SelectedGameName'] : '';
    $SelectedGameID = isset($_POST['SelectedGameID']) ? $_POST['SelectedGameID'] : '';

    $query = "SELECT * FROM GAME WHERE GameID='".$SelectedGameID."';";
    $res = mysqli_query($con, $query);
    $data = mysqli_fetch_assoc($res);

    $SelectedHomeTeamID = $data['TeamHomeID'];
    $SelectedAwayTeamID = $data['TeamAwayID'];
    $SelectedGameName = $data['GameName'];

    $query = "SELECT * FROM TEAM WHERE TeamID='".$SelectedHomeTeamID."';";
    $res = mysqli_query($con, $query);
    $data = mysqli_fetch_assoc($res);

    $SelectedHomeName = $data['TeamName'];


    $query = "SELECT * FROM TEAM WHERE TeamID='".$SelectedAwayTeamID."';";
    $res = mysqli_query($con, $query);
    $data = mysqli_fetch_assoc($res);

    $SelectedAwayName = $data['TeamName'];



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
                <div class="load-game-options">
                    <div class="load-game-side-options side-bar-options text-center">
                        <ul>
                            <li>
                                <label>Games</label>
                                <select id="select-game" name="select_game">
                                    <option value="0" disabled selected>Select Game</option>
                                    <?php
                                        $res = mysqli_query($con, "SELECT * FROM GAME ORDER BY GameName;");
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
                                <label style="color: #00aeef;">Team Home: <?php echo $SelectedHomeName?></label>
                                <label>Quarter: </label>
                                <div class="quarter-number">
                                    <?php
                                        $res = mysqli_query($con, "SELECT Quarter FROM GAME WHERE GameID='".$SelectedGameID."'");
                                        $data = mysqli_fetch_assoc($res);

                                        for ($i=1; $i <= $data['Quarter']; $i++) { 
                                            echo "<button style='background-color: #a9a9a9;' class='quarter-home-button'>Q".$i."</button>";
                                        }
                                    ?>
                                </div>
                                <input type="checkbox" id="hot-zone-home" name="Hot Zone" value="zone"> Show Hot Zone
                            </li>
                            <li>
                                <label style="color: #00aeef;">Team Away: <?php echo $SelectedAwayName?></label>
                                <label>Quarter: </label>
                                <div class="quarter-number">
                                    <?php
                                        $res = mysqli_query($con, "SELECT Quarter FROM GAME WHERE GameID='".$SelectedGameID."'");
                                        $data = mysqli_fetch_assoc($res);

                                        for ($i=1; $i <= $data['Quarter']; $i++) { 
                                            echo "<button style='background-color: #a9a9a9;' class='quarter-away-button'>Q".$i."</button>";
                                        }
                                    ?>
                                </div>
                                <input type="checkbox" id="hot-zone-away" name="Hot Zone" value="zone"> Show Hot Zone
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
                            Load Game
                        </label>
                        <div class="load-game text-center">
                            <label class="load-game-name"> Game Name</label>
                            <div class="load-game-shot-options">
                                <div class="load-game-team-home">
                                    <?php
                                        $res = mysqli_query($con, "SELECT * FROM TEAM WHERE TeamID='".$SelectedHomeTeamID."';");
                                        $data = mysqli_fetch_assoc($res);
                                        $SelectedHomeTeamImg = $data['Image'];
                                        if(!($SelectedHomeTeamImg === null)) echo "<img src='./images/teams/".$data['Image']."' height='100px' width='100px'>";
                                        
                                    ?>
                                    <div class="team-home-shot-chart"></div>
                                    <div class="load-team-home data-team-home-id='<?php echo $SelectedHomeTeamID?>'">
                                        <ul class="load-team-home-list slider slider-nav">
                                            <?php
                                                $query = "SELECT * FROM Player WHERE TeamID='".$SelectedHomeTeamID."' ORDER BY JerseyNumber";
                                                $res = mysqli_query($con, $query);
                                                while($row = mysqli_fetch_array($res)){
                                            ?>
                                                <li id="<?php echo $row['PlayerID']?>">
                                                    <img src="./images/players/<?php echo $row['Image'] ?>" height="30px" width="30px">
                                                    <label class="float-left"># <?php echo $row['JerseyNumber'] ?></label>
                                                </li>
                                            <?php   
                                                }
                                            ?>
                                        </ul>
                                    </div>
                                </div>
                                <div class="load-game-team-away data-team-away-id='<?php echo $SelectedAwayTeamID?>'"">
                                    <?php
                                        $res = mysqli_query($con, "SELECT * FROM TEAM WHERE TeamID='".$SelectedAwayTeamID."';");
                                        $data = mysqli_fetch_assoc($res);
                                        $SelectedAwayTeamImg = $data['Image'];
                                        if(!($SelectedAwayTeamImg === null)) echo "<img src='./images/teams/".$data['Image']."' height='100px' width='100px'>";                                        
                                    ?>
                                    <div class="team-away-shot-chart"></div>
                                    <div class="load-team-away data-team-away-id='<?php echo $SelectedAwayTeamID?>'">
                                        <ul class="load-team-away-list slider slider-nav">
                                            <?php
                                                $query = "SELECT * FROM Player WHERE TeamID='".$SelectedAwayTeamID."' ORDER BY JerseyNumber";
                                                $res = mysqli_query($con, $query);

                                                while($row = mysqli_fetch_array($res)){
                                            ?>
                                                <li id="<?php echo $row['PlayerID']?>">
                                                    <img src="./images/players/<?php echo $row['Image'] ?>" height="30px" width="30px">
                                                    <label class="float-left"># <?php echo $row['JerseyNumber'] ?></label>
                                                </li>
                                            <?php   
                                                }
                                            ?>
                                            
                                        </ul>
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

            </div>

        </div>
        
        <!-- JS -->
        <script type="text/javascript">
            var SelectedGameID = $('#select-game option:selected').val();
            var SelectedGameName = $('#select-game option:selected').text();
            var SelectedHomeTeamID = $('.load-team-home').data('team-home-id');
            var SelectedAwayTeamID = $('.load-team-away').data('team-away-id');

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
            $(document).ready(function () {
                var gameName = <?php echo json_encode($SelectedGameName) ?>;
                $('html,body').animate({scrollTop: $('.load-game-shot-options').position().top - 50}, 2000);
                // if(gameName != null || gameName != '') $('.load-game > label').text(gameName);
            });
            $('.slider-nav').slick({
                    slidesToShow: 5,
                    slidesToScroll: 5,
                    arrows: true,
                    infinite: true,
                    draggable: false
            });


            $('#select-game').change(function() {
                SelectedGameID = $('#select-game option:selected').val();
                $('.quarter-number > button').remove();
                document.location.reload(true);
                $.redirect("/shotchart/load-game.php", {"SelectedGameID": SelectedGameID}); 
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

            function displayShots() {

                $('.team-home-shot-chart > div, .team-away-shot-chart > div').remove();
                $('.quarter-home-button.quarter-active').each(function(i, obj) {
                    var SelectedPlayerID = $('.selected-player').attr('id');
                    if($('.load-team-home').hasClass('selected-team')) {
                        $.post("./load-game-functions/load-game-load-shots.php", {
                            SelectedGameID: SelectedGameID,
                            SelectedTeamID: SelectedHomeTeamID,
                            SelectedPlayerID: SelectedPlayerID,
                            ShotChartX: $('.team-home-shot-chart').position().left,
                            ShotChartY: $('.team-home-shot-chart').position().top,
                            CurrentQuarter: $(this).text().replace(/[^\d]/g, "")
                        })
                         .success(function(data){
                            $('.team-home-shot-chart').append(data);
                         });
                    }

                });
                $('.quarter-away-button.quarter-active').each(function(i, obj) {
                    var SelectedPlayerID = $('.selected-player').attr('id');
                    if($('.load-team-away').hasClass('selected-team')) {
                        $.post("./load-game-functions/load-game-load-shots.php", {
                            SelectedGameID: SelectedGameID,
                            SelectedTeamID: SelectedAwayTeamID,
                            SelectedPlayerID: SelectedPlayerID,
                            ShotChartX: $('.team-away-shot-chart').position().left,
                            ShotChartY: $('.team-away-shot-chart').position().top,
                            CurrentQuarter: $(this).text().replace(/[^\d]/g, "")
                        })
                         .success(function(data){
                            $('.team-away-shot-chart').append(data);
                         });
                    }

                })

            }

            function displayHotZone() {
                    
            }
            
            $(document).on("click", '.team-home-shot-chart', function(e) {
                var offset = $(this).offset();
                var relativeX = e.pageX - offset.left;
                var relativeY = e.pageY - offset.top;
                console.log("RX: " + relativeX + " RY: " + relativeY); //pixels in the image
            });

            $(document).on("click", '.team-away-shot-chart', function(e) {
                var offset = $(this).offset();
                var relativeX = e.pageX - offset.left;
                var relativeY = e.pageY - offset.top;

                console.log("RX: " + relativeX + " RY: " + relativeY); //pixels in the image
            });
            $(document).on("change", '#hot-zone-home', function() {
                if($('#hot-zone-home').is(':checked')) {
                    var shotChartHeight = $('.team-home-shot-chart').height();
                    var shotChartWidth = $('.team-home-shot-chart').width();
                    var shotChartX = $('.team-home-shot-chart').position().left;
                    var shotChartY = $('.team-home-shot-chart').position().top;
                    var canvas = $('<canvas width="'+shotChartWidth+'" height="'+shotChartHeight+'"></canvas>');
                    var ctx = canvas[0].getContext('2d');
                    var shotCountHome=[];

                    $.each($('.team-home-shot-chart > div'), function(i, value) {
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
                    console.log(shotCountHome);
                    for(var i = 0; i < areas.length; i++) {
                        ctx.beginPath();
                        ctx.moveTo(areas[i][0][0], areas[i][0][1]);

                        if(shotCountHome[i+1] == null || shotCountHome[i+1] == 0) ctx.fillStyle = '#00FFFF';
                        else if(((shotCountHome[i+1]*100)/parseFloat($('.team-home-shot-chart > div').length) >= 20) && ((shotCountHome[i+1]*100)/parseFloat($('.team-home-shot-chart > div').length) < 40) ) ctx.fillStyle = '#ffa500'; 
                        else if(((shotCountHome[i+1]*100)/parseFloat($('.team-home-shot-chart > div').length) >= 40) && ((shotCountHome[i+1]*100)/parseFloat($('.team-home-shot-chart > div').length) <= 100)) ctx.fillStyle = '#FF4500';
                        else ctx.fillStyle='#00aeef';
                        

                        $.each(areas[i], function(i, value){
                            ctx.lineTo(value[0], value[1]);
                        });
                        ctx.closePath();
                        ctx.fill();
                    }
                    var dataUrl = canvas[0].toDataURL();
                    $('.team-home-shot-chart').css('background', 'url('+dataUrl+')');
                    $('#team-hot-zone-home').remove();
                    $('.team-home-shot-chart').append('<img id="team-hot-zone-home" src="./images/half-court-hot-zone.png" style="margin-left:auto; margin-right:auto; background:"transparent";/>');
                } else if ($('#hot-zone-home').not(':checked')) {
                    $('#team-hot-zone-home').remove();
                    $('.team-home-shot-chart').css('background', 'url(./images/half-court-resize.png)');
                }

                
            });

            $(document).on("change", '#hot-zone-away', function() {
                if($('#hot-zone-away').is(':checked')) {
                    var shotChartHeight = $('.team-away-shot-chart').height();
                    var shotChartWidth = $('.team-away-shot-chart').width();
                    var shotChartX = $('.team-away-shot-chart').position().left;
                    var shotChartY = $('.team-away-shot-chart').position().top;
                    var canvas = $('<canvas width="'+shotChartWidth+'" height="'+shotChartHeight+'"></canvas>')
                    var ctx = canvas[0].getContext('2d');
                    var shotCountAway=[];

                    
                    $.each($('.team-away-shot-chart > div'), function(i, value) {
                        shotCoordinate=[$(this).data('shot-coordinate-x'), $(this).data('shot-coordinate-y')];
                        
                        for (var i = 0; i < areas.length; i++) {
                            if(inside([shotCoordinate[0], shotCoordinate[1]], areas[i])){
                                if(shotCountAway[i + 1] == null) {
                                    shotCountAway[i + 1] = 1;
                                } else {
                                    shotCountAway[i + 1] = shotCountAway[i + 1] + 1;
                                }
                            }
                        }
                    });
                    
                    for(var i = 0; i < areas.length; i++) {
                        ctx.beginPath();
                        ctx.moveTo(areas[i][0][0], areas[i][0][1]);

                        if(shotCountAway[i+1] == null || shotCountAway[i+1] == 0) ctx.fillStyle = '#00FFFF';
                        else if(((shotCountAway[i+1]*100)/parseFloat($('.team-away-shot-chart > div').length) >= 20) && ((shotCountAway[i+1]*100)/parseFloat($('.team-away-shot-chart > div').length) < 40) ) ctx.fillStyle = '#ffa500'; 
                        else if(((shotCountAway[i+1]*100)/parseFloat($('.team-away-shot-chart > div').length) >= 40) && ((shotCountAway[i+1]*100)/parseFloat($('.team-away-shot-chart > div').length) < 60)) ctx.fillStyle = '#FF4500';
                        else ctx.fillStyle = '#ff000';

                        $.each(areas[i], function(i, value){
                            ctx.lineTo(value[0], value[1]);
                        });
                        ctx.closePath();
                        ctx.fill();
                    }
                    var dataUrl = canvas[0].toDataURL();
                    $('.team-away-shot-chart').css('background', 'url('+dataUrl+')');
                    $('#team-hot-zone-away').remove();
                    $('.team-away-shot-chart').append('<img id="team-hot-zone-away" src="./images/half-court-hot-zone.png" style="margin-left:auto; margin-right:auto; background:"transparent";/>');
                } else if ($('#hot-zone-away').not(':checked')) {
                    $('#team-hot-zone-away').remove();
                    $('.team-away-shot-chart').css('background', 'url(./images/half-court-resize.png)');
                }
            });
            $(document).on("click", '.load-team-home-list li', function(e) {
                $('.selected-player').css('background', 'initial');
                $('.load-team-home-list li, .load-team-away-list li').removeClass('selected-player');
                $('.load-team-home, .load-team-away').css('border', '2px solid #dddedf');
                $('.load-team-home, .load-team-away').removeClass('selected-team');
                $(this).addClass('selected-player');
                $('.load-team-home').addClass('selected-team');
                $(this).css('background', '#00aeef');
                $('.load-team-home').css('border', '2px solid red');

                displayShots();
            });
            $(document).on("click", '.load-team-away-list li', function(e) {
                $('.selected-player').css('background', 'initial');
                $('.load-team-home-list li, .load-team-away-list li').removeClass('selected-player');
                $('.load-team-home, .load-team-away').css('border', '2px solid #dddedf');
                $('.load-team-home, .load-team-away').removeClass('selected-team');
                $(this).addClass('selected-player');
                $('.load-team-away').addClass('selected-team');
                $(this).css('background', '#00aeef');
                $('.load-team-away').css('border', '2px solid red');

                displayShots();
            });

            $('.quarter-number > button').on("click", function(e) {
                if($(this).hasClass('quarter-active')){
                    $(this).removeClass('quarter-active');
                    $(this).css('background-color', '#a9a9a9');
                } else {
                    $(this).addClass('quarter-active');
                    $(this).css('background-color', '#3abdee');
                }
                
                displayShots();
                
            })
        </script>
    </body>
</html>