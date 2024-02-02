<?php
session_start();

// Check if the session variables are set
if ($_SESSION["registered"] == true) {
	$reg = $_SESSION["registered"];
}


?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Landing Page</title>

    </head>
    <body>
<?php
include 'navbar.php';
?>   
        <div id="main">
            <img id="background" src="arcade-unsplash.jpg">
            <div id="loggedIn" style ="visibility:hidden">
                <h2 id="greeting">Welcome to Pairs</h2>
                <img id="hand1" src="two-kings.png">
                <img id="hand2" src="two-kings.png">
            </div>
            <p id="descriptionText">The memory game is a common children's game played with a set of cards. The cards have a pictures on one side and each picture appears on two (or sometimes more) cards. The game starts with all the cards face down and you start to turn over two cards. If the two cards have the same picture, then we keep the cards turned, otherwise they turn the cards face down again. When all the cards have been taken you will see your score and be able to submit it if you want.</p>
            <div id="logingelem">
                <p>You are not using a registered session ?<br></p>
                <a id="regNow" href="registration.php" style="text-decoration:none">Register now</a>
            </div>
            <button id="playbutt" type = "button" onclick ="playButt()" style ="visibility:hidden" >Click here to play !</button>
	    <form action="logout.php" method="POST">
	    	<button id="logout" type ="submit" onclick="logOut()" style ="visibility:hidden"> Log Out </button>
	    </form>
        </div>
    </body>    
    <style>
        body {
            margin: 0%;
        }

        #background {
            filter: blur(6px);
            position: absolute;
            display: block;
            height: 120%;
            width: 100%;
            margin-left: auto;
            margin-right: auto;
        }
        
        #greeting{ 
            color: white;
            font-weight: bold;
            font-size: 140px;
            position: absolute;
            top: 15%;
            left: 50%;
            transform: translate(-50%, -50%);
            z-index: 2;
            padding: 20px;
            text-align: center;
        }

        #descriptionText {
            position: absolute;
            color: lightpink;
            text-align: center;
            width: 80%;
            margin-left: 10%;
            margin-top: 4%;
            font-size: 30px;
        }

        #hand1, #hand2 {
            position: absolute;
            height: 8%;
            width: 6%;
        }

        #hand1 {
            margin-top: 8.2%;
            margin-left: 23%;
        }

        #hand2 {
            margin-top: 8.5%;
            margin-left: 71%;
        }

        #logingelem{
            background-color: rgb(0,0,0); 
            background-color: rgba(0,0,0, 0.4); 
            color: white;
            font-weight: bold;
            font-size: 80px;
            border: 3px solid #f1f1f1;
            position: absolute;
            margin-top: 30%;
            left: 50%;
            transform: translate(-50%, -50%);
            z-index: 2;
            width: 80%;
            padding: 50px;
            text-align: center;
            text-decoration: none;
        }

        #regNow{
            border: 3px solid #f1f1f1;
            background-color: rgba(151, 149, 149, 0.949);
            color: rgb(39, 76, 213);
            padding: 30px;
            font-size: 80px;
        }

        #playbutt{
            background-color: rgba(0, 0, 0, 0.856); 
            color: white;
            font-weight: bold;
            font-size: 80px;
            border: 5px solid #f1f1f1;
            position: absolute;
            top: 60%;
            left: 50%;
            transform: translate(-50%, -50%);
            z-index: 2;
            width: 70%;
            padding: 65px;
            text-align: center;
            text-decoration: none;
        }


	 #logout {
            position: absolute;
            margin-top: 0%;
            left: 90%;
            background-color: #ff00ff;
            color: #fff;
            font-size: 25px;
            padding: 10px 35px;
            border-radius: 10px;
            border: none;
            cursor: pointer;
            transition: background-color 0.3s ease-in-out;
            box-shadow: 2px 2px 2px #000;
        }

        #logout:hover {
            background-color: #ff69b4;
        }
    </style>
    <script>
	function hasLogedIn(){
            if (<?php echo $reg ?>){
		return true }
	    return false
        }

	function playButt() {
	    window.open('pairs.php',"_self");
	}

	function displayInteraction(){
	    if (hasLogedIn() == true) {
	        const playPossibility = document.getElementById("playbutt");
	        const register = document.getElementById("logingelem");
	        const welcome = document.getElementById("loggedIn");
	        playPossibility.style.visibility ="visible";
	        welcome.style.visibility ="visible";
	        register.style.display = "none";
		document.getElementById("logout").style.visibility ="visible";
	    }
	}

	function logout() {
	    fetch('logout.php', {
	        method: 'POST',
	        credentials: 'include'
	    })
	    .then(response => {
	        if (response.ok) {
	            window.location.replace('index.php');
	        }
	    })
	    .catch(error => console.log(error));
	}

	displayInteraction();
    </script>
</html>
