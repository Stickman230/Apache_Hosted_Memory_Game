<?php
session_start();

// Check if the session variables are set
if ($_SESSION["registered"] == true) {
   $registered = $_SESSION["registered"];
    
  // Retrieve the username from the session variable
  $username = $_SESSION["username"];

  // Retrieve the avatar elements from the session variable
  $emojiS = $_SESSION["emojiS"];
  $emojiM = $_SESSION["emojiM"];
  $emojiE = $_SESSION["emojiE"];
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
	  $time = $_POST["timer"];
	  $clicks = $_POST["clicks"];
	  $score = $_POST["score"];

	  setcookie('userAvatarS', $emojiS, time() + (30 * 24 * 60 * 60));
	  setcookie('userAvatarM', $emojiM, time() + (30 * 24 * 60 * 60));
	  setcookie('userAvatarE', $emojiE, time() + (30 * 24 * 60 * 60));
	  setcookie('username', $username, time() + (30 * 24 * 60 * 60));
	  setcookie('time', $time, time() + (30 * 24 * 60 * 60));
	  setcookie('clicks', $clicks, time() + (30 * 24 * 60 * 60));
	  setcookie('score', $score, time() + (30 * 24 * 60 * 60));
 }
}

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Memory Game</title>

  </head>
  <body>
<?php
include 'navbar.php';
?>       
      <div id="main">
          <img id="background" src="arcade-unsplash.jpg" class="center">
          <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
	   <h1 id="timer">00:00:00</h1>
	   <input type="hidden" id="score" name="score" value="">
	   <input type="hidden" id="clicks" name="clicks" value="">
	   <input type="hidden" id="timerValue" name="timer" value="">
	   <button type="submit" id="SubScore" onclick="submitScore()" style="display: none;"> Submit </button>
	  </form>
          <section id="memory-game" style="display: none;">

              <div class="memory-card" data-framework="1">
                <img id="eye" class="front-face" >
                <img id="mouth" class="front-face" >
                <img id="skin" class="front-face" >
                <img class="back-face" src="card-backface.jpg" alt="Memory Card">
              </div>
            
              <div class="memory-card" data-framework="1">
                <img id="eye" class="front-face" >
                <img id="mouth" class="front-face" >
                <img id="skin" class="front-face" >
                <img class="back-face" src="card-backface.jpg" alt="Memory Card">
              </div>
            
              <div class="memory-card" data-framework="2">
                <img id="eye" class="front-face" >
                <img id="mouth" class="front-face" >
                <img id="skin" class="front-face" >
                <img class="back-face" src="card-backface.jpg" alt="Memory Card">
              </div>
            
              <div class="memory-card" data-framework="2">
                <img id="eye" class="front-face" >
                <img id="mouth" class="front-face" >
                <img id="skin" class="front-face" >
                <img class="back-face" src="card-backface.jpg" alt="Memory Card">
              </div>
            
              <div class="memory-card" data-framework="3">
                <img id="eye" class="front-face" >
                <img id="mouth" class="front-face" >
                <img id="skin" class="front-face" >
                <img class="back-face" src="card-backface.jpg" alt="Memory Card">
              </div>
            
              <div class="memory-card" data-framework="3">
                <img id="eye" class="front-face" >
                <img id="mouth" class="front-face" >
                <img id="skin" class="front-face" >
                <img class="back-face" src="card-backface.jpg" alt="Memory Card">
              </div>
            
              <div class="memory-card" data-framework="4">
                <img id="eye" class="front-face" >
                <img id="mouth" class="front-face" >
                <img id="skin" class="front-face" >
                <img class="back-face" src="card-backface.jpg" alt="Memory Card">
              </div>
            
              <div class="memory-card" data-framework="4">
                <img id="eye" class="front-face" >
                <img id="mouth" class="front-face" >
                <img id="skin" class="front-face" >
                <img class="back-face" src="card-backface.jpg" alt="Memory Card">
              </div>
            
              <div class="memory-card" data-framework="5">
                <img id="eye" class="front-face" >
                <img id="mouth" class="front-face" >
                <img id="skin" class="front-face" >
                <img class="back-face" src="card-backface.jpg" alt="Memory Card">
              </div>
            
              <div class="memory-card" data-framework="5">
                <img id="eye" class="front-face" >
                <img id="mouth" class="front-face" >
                <img id="skin" class="front-face" >
                <img class="back-face" src="card-backface.jpg" alt="Memory Card">
              </div>
            
            </section>
            <button id="startButt" type="button" onclick="startGame()"> Start the game </button>
            <audio id="music" src="heros-time-paulo-kalazz.mp3"></audio>
            <audio id="music2" src="ta-da-brass-ensemble-fast-soundroll-1-00-01.mp3"></audio>
            <button type="button" id="PlayAgain" onclick="playAgain()" style="display: none;"> Play again </button>
      </div>
  </body>
  <style>
    body {
      margin: 0px;
    }
    .navbar {
      width: 100%;
      background-color: #555;
      overflow: auto;
    }
    .navbar a {
      padding: 20px;
      color: white;
      text-decoration: none;
      font-family: Verdana;
      font-size: 12px;
      font-weight: bold;
    }
    .navbar a:hover {
      background-color: #000;}
    .navbar {
      background-color: blue;}
      
    @media screen and (max-width: 500px) {
      .navbar a {
        float: none;
        display: block;}
    }
    .aligned-R{
      float: right;}
    .aligned-L{
      float: left;}
      
    #background {
      filter: blur(6px);
      position: absolute;
      display: block;
      height: 120%;
    }

    .center {
      margin-left: auto;
      margin-right: auto;
      width: 100%;
    }

    #timer {
      position: absolute;
      color: white;
      left: 45%;
      top: 10%;
      font-size: 50px;
      font-family: 'Trebuchet MS';
    }

    #memory-game {
      width: 840px;
      height: 640px;
      margin: auto;
      display: flex;
      flex-wrap: wrap;
      position: absolute;
      box-sizing: border-box;
      top: 22%;
      left: 25%;
      perspective: 1000px;
      background-color: rgba(128, 128, 128, 0.672);
      border-radius: 10px;
      padding: 2%;
    }

    .memory-card {
      width: calc(20% - 10px);
      height: calc(50% - 10px);
      margin: 5px;
      position: relative;
      box-shadow: 1px 1px 1px rgba(0,0,0,.3);
      transform: scale(1);
      transform-style: preserve-3d;
      text-align: center;
      transition: transform .3s;
    }

    .front-face,.back-face {
      width: 100%;
      height: 100%;
      position: absolute;
      backface-visibility: hidden;
      display: block;
      border-radius: 10px;
    }

    .memory-card:active {
      transform: scale(0.97);
      transition: transform .2s;
    }

    .memory-card.flip {
      transform: rotateY(180deg);
    }

    .front-face {
      transform: rotateY(180deg);
      border: 3px solid white ;
    }

    #eye{
      z-index: 2;
    }

    #mouth{
      z-index: 1;
    }
    
    #skin{
      z-index: 0;
      background-color: white;
    }

    button {
      position: absolute;
      margin-top: 25%;
      left: 40%;
      background-color: #ff00ff;
      color: #fff;
      font-size: 2.5rem;
      padding: 32px 44px;
      border-radius: 10px;
      border: none;
      cursor: pointer;
      transition: background-color 0.3s ease-in-out;
      box-shadow: 2px 2px 2px #000;
    }

    button:hover {
      background-color: #ff69b4;
    }

  </style>
  <script type="text/javascript">
    var logged = '<?php echo $registered; ?>';
  </script>
  <script src="pairs2.js"></script>
</html>
