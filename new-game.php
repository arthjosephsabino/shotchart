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
        <script type="text/javascript" src="js/jquery-ui.js"></script>
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
                <div class="game-options">
                    <div class="new-game-options side-bar-options text-center">
                        <ul>
                            <li>
                                <label>Game Name</label>
                                <input id="input-game" type="text" name="game_name">
                            </li>
                            <li>
                                <label>League Name</label>
                                <select id="select-league" name="select_league">
                                    <option value="0" disabled selected>Select League</option>
                                    <?php
                                        $res = mysqli_query($con, "SELECT LeagueName from League ORDER BY LeagueName");
                                        while($row = mysqli_fetch_array($res)) {
                                            echo "<option value='".$row['LeagueName']."'>".$row['LeagueName']."</option>";
                                        }
                                    ?>
                                </select>
                            </li>
                            <li>
                                <label>Team Home</label>
                                <select id="select-home" name="select_home">
                                    <option value="0" disabled selected>Select Team Home</option>
                                </select>
                            </li>
                            <li>
                                <label>Team Away</label>
                                <select id="select-away" name="select_away">
                                    <option value="0" disabled selected>Select Team Away</option>
                                </select>
                            </li>
                        </ul>
                        <button class="new-game-options-button button-save" name="Save">save</button>
                    </div>
                </div>
            </aside>
            <!-- Main Content -->
            <main class="main-content">
                <section class="section-content team-options-section">
                    <div class="wrapper">
                        <label>
                            New Game
                        </label>

                        <div class="team-input">
                            <div class="team-home float-left">
                                <div class="home-header">
                                    <label>
                                        Team Home
                                    </label>
                                </div>
                                <div class="home-players-display">
                                    
                                </div>
                            </div>
                            <div class="team-away float-left">
                                <div class="away-header">
                                    <label>
                                        Team Away
                                    </label>
                                </div>
                                <div class="away-players-display">
                                    
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
            $('.jersey-number-form').keypress(function(e) {
                if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
                    return false;
                }
             });
            
            $( function() {
                $( ".home-players-display" ).sortable();
                $( ".home-players-display" ).disableSelection();
                $( ".away-players-display" ).sortable();
                $( ".away-players-display" ).disableSelection();
            } );

            $('#select-league').change(function() {

                $('#select-home option').not(':first').remove();
                $("#select-home option:first").attr('selected','selected');

                $('#select-away option').not(':first').remove();
                $("#select-away option:first").attr('selected','selected');

                $('.home-players-display > div').remove();
                $('.away-players-display > div').remove();

                $('.home-header > label').text('Team Home ');
                $('.away-header > label').text('Team Away ');
                $.post( "./new-game-functions/new-game-team-options.php",{SelectedLeagueName: $(this).val() }, function( data ) {
                    $.each(data, function(i, value) {
                        $('#select-home').append('<option value="'+data[i].name+'">'+data[i].name+"</option>");
                        $('#select-away').append('<option value="'+data[i].name+'">'+data[i].name+"</option>");
                    });
                }, "json");
            });

            $('#select-home').change(function() {
                $('#select-away option').each(function() {
                    if($(this).val() == 0) return;
                    else $(this).removeAttr('disabled');
                });

                $('.home-header > label').text('Team Home: ' + $('#select-home').val());
                $('#select-away').find('option[value="'+$('#select-home').val()+'"]').attr('disabled','disabled');

                $.post("./new-game-functions/new-game-team-display.php", {SelectedTeamName: $(this).val()})
                 .success(function(data){
                    $('.home-players-display').html(data);
                 });


            });

            $('#select-away').change(function() {
                $('#select-home option').each(function() {
                    if($(this).val() == 0) return;
                    else $(this).removeAttr('disabled');
                });
                
                $('.away-header > label').text('Team Away: ' + $('#select-away').val());
                $('#select-home').find('option[value="'+$('#select-away').val()+'"]').attr('disabled','disabled');

                $.post("./new-game-functions/new-game-team-display.php", {SelectedTeamName: $(this).val()})
                 .success(function(data){
                    $('.away-players-display').html(data);
                 });

            });

            $('.new-game-options-button.button-save').on('click', function(e) {
                if($('#input-game').val() == '' || $('#input-game').val() == null){
                    alert("Please Input Game name");
                    return;
                }

                $.redirect("./new-game-functions/new-game-game-create.php",
                    {
                        SelectedLeagueName: $('#select-league option:selected').val(),
                        SelectedHomeName: $('#select-home option:selected').val(),
                        SelectedAwayName: $('#select-away option:selected').val(),
                        SelectedGameName: $('#input-game').val()

                    });
            });
            
        </script>
    </body>
</html>