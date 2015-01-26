<?php
    //Start session
    session_name("TestSession");
    session_start();
    
    //Load quiz json file
    if ( !(isset($questions) ) ) {
        $questions = json_decode(file_get_contents("testQuestions.json"), true);
    }
    //Initialise quiz elements
    $no_of_questions = count( $questions["questions"]);
    if ( !( isset( $_SESSION["current_question"] ) ) ){
        $_SESSION["current_question"] = -1;
    }
    if ( !( isset( $_SESSION["current_score"] ) ) ){
        $_SESSION["current_score"] = 0;
    }
    if ( !( isset( $_SESSION["best_score"] ) ) ){
        $_SESSION["best_score"] = 0;
    }
?>

<html>
    <head>
        <title>Maxi's Tech Test</title>
        <link rel="stylesheet" href="css/style.css" type="text/css" media="screen" />
    </head>
    <body>
        <script>//Facebook auth
            window.fbAsyncInit = function() {
                FB.init({
                    appId      : '338768482914375',
                    xfbml      : true,
                    version    : 'v2.2'
                });
          
            //Greets user after successful login
            function onLogin(response) {
                if (response.status == 'connected') {
                    FB.api('/me?fields=first_name', function(data) {
                        var welcomeBlock = document.getElementById('fb-welcome');
                        welcomeBlock.innerHTML = 'Alright, ' + data.first_name + '!</br>Are you ready to test your knowledge?';
                    });
                    FB.api('/me/picture?fields=url', function(data) {
                        var userImg = document.getElementById('fb-pic');
                        userImg.src = data.data.url;
                    });
                }
            }
          
            FB.getLoginStatus(function(response) {
                // Check login status on load, and if the user is
                // already logged in, go directly to the welcome message.
                if (response.status == 'connected') {
                    onLogin(response);
                } else {
                    // Otherwise, show Login dialog first.
                    FB.login(function(response) {
                      onLogin(response);
                    }, {scope: 'user_friends, email'});
                }
            });
          };
        
            (function(d, s, id){
                var js, fjs = d.getElementsByTagName(s)[0];
                if (d.getElementById(id)) {return;}
                js = d.createElement(s); js.id = id;
                js.src = "//connect.facebook.net/en_US/sdk.js";
                fjs.parentNode.insertBefore(js, fjs);
             }(document, 'script', 'facebook-jssdk'));
        </script>
        
        <?php
            if (isset($_POST['startButton'])) { //Start quiz
                $_SESSION['current_question'] = 0;
            }

            if (isset($_POST['submitButton'])) { //Submit question answer
                if (isset($_POST['answerRadio'])){
                    if ($_POST['answerRadio']== $questions["questions"][$_SESSION["current_question"]]["answer"]) {
                        $_SESSION['current_score']++;
                    }
                    $_SESSION['current_question']++;
                }
            }

            if (isset($_POST['quitButton'])) { //Back to menu
                $_SESSION['current_question'] = -1;
                $_SESSION['current_score'] = 0;
            }

            if (isset($_POST['tryButton'])) { //Try again
                $_SESSION['current_question'] = -1;
                $_SESSION['current_score'] = 0;
            }
            // Include twitteroauth
            require "twitteroauth/autoloader.php";
            use Abraham\TwitterOAuth\TwitterOAuth;
            
            if (isset($_POST['twitterButton'])) {
                // Set keys
                $consumerKey = 'Nc63PhRW8XAgcoCOZgi4nOFra';
                $consumerSecret = 'vwBPMQGILcVwGD07tjzYIwXgdEOtXTQQSWreInT9MI2NE3rYRk';
                $accessToken = '203202332-b3D56FAicHtkeVFKg4coj1lM3952xfHAuy0BG59T';
                $accessTokenSecret = 'STTOClLq24IBhvrILhxH0xShKiRytm9E38syLu5X2vdSo';
                    
                // Create object
                $tweet = new TwitterOAuth($consumerKey, $consumerSecret, $accessToken, $accessTokenSecret);
                    
                // Set status message
                $tweetMessage = "Someone scored ".$_SESSION['current_score']."/".$no_of_questions." in #MaxTechTest";
                    
                // Check for 140 characters
                if(strlen($tweetMessage) <= 140) {
                    // Post tweet
                    $tweet->post('statuses/update', array('status' => $tweetMessage));
                }
            }
        ?>
        <div id="welcomeBanner">
            <div id="head1"> Welcome </div><div id="head2"> to </div><div id="head3"> #MaxTechTest </div>
            <img id="fb-pic">
        </div>
        <div id="bestScoreBox">Best Score: <?php echo $_SESSION['best_score']."/".$no_of_questions?></div>
        
        <?php
            if ($_SESSION['current_question'] >= 0) { 
        ?>
            <div id="currentScoreBox">Current Score: <?php echo $_SESSION['current_score']."/".$no_of_questions?></div>    
        <?php } ?>
            <div id="highScoreBox"> <a href="highscores.php">Latest Scores</a></div>
        <?php //Title page
            if ($_SESSION['current_question'] == -1) {
        ?>
            <p id="fb-welcome">...Logging in...</p>
            <form method="POST" action="">
                <input type="submit" value="Start Quiz" name="startButton">
            </form>
        <?php
            }
            //Question page format
            if (($_SESSION['current_question'] >= 0) and ($_SESSION['current_question'] < $no_of_questions)) {
        ?>
            <p><b>Question <?php echo ($_SESSION["current_question"]+1)?>:</b> <?php echo $questions["questions"][$_SESSION["current_question"]]["question"]?></p>
            <p>
            <!--Put a div that gets populated with tick etc-->
                <form method="POST" action="">
                    <?php 
                    for ($x = 0; $x < count($questions["questions"][$_SESSION["current_question"]]["options"]); $x++) {
                    echo ('<input type="radio" name="answerRadio" value="'.($x+1).'"> '.$questions["questions"][$_SESSION["current_question"]]["options"][$x]."<br>");
                    }?>
                    </br>
                    <div id="hintBox"></div>
                    <input type="submit" name="submitButton" value="Continue">
                    <input type="submit" name="quitButton" value="Quit">
                </form>
                <button type="submit" value="Hint" onclick="showHint()">Hint</button>
            </p>
        <?php
                }
                //Score page
                if ($_SESSION['current_question'] >= $no_of_questions) {
                    if($_SESSION["best_score"] <= $_SESSION['current_score']){
                        $_SESSION["best_score"] = $_SESSION['current_score'];
                    }
        ?>
            <div id="finalScoreBox">
                <?php 
                if ($_SESSION['current_score'] >= 2) {
                    echo ("Well done! ");
                } 
                else {
                    echo ("Not great! ");
                } ?>
                You got <?php echo $_SESSION['current_score']."/".$no_of_questions?>!
            </div>
            <form method="POST" action=''>
                <input type="submit" value="Try Again?" name="tryButton">
                <input type="submit" value="Share Score" name="twitterButton">
            </form>
        <?php } ?>

        <script>
            function showHint() {
                //document.getElementById("hintBut").innerHTML = "poos"
                xmlhttp = new XMLHttpRequest();
                xmlhttp.onreadystatechange = function() {
                    if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                        document.getElementById("hintBox").innerHTML = "<b>Hint:</b>" + xmlhttp.responseText + "<br><br>";
                    }
                }
                xmlhttp.open("GET", "https://community.dur.ac.uk/maximilian.clayton-clowes/getHint.php?questionNumber=<?php echo $_SESSION["current_question"]; ?>", false);
                xmlhttp.send();
            }
        </script>
    </body>
</html>