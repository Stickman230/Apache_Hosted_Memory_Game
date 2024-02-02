<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the username from the form input
    $username = $_POST["username-input"];
    
    // Set the session variable for the username
    session_start();
    $_SESSION["username"] = $username;
    
    if (isset($_POST['srcArray'])) {
        $srcArray = json_decode($_POST['srcArray']);
	echo '<pre>';
	print_r($srcArray);
	echo '</pre>';
        // Store the srcArray elements as session variables
        $_SESSION['emojiE'] = $srcArray[0];
        $_SESSION['emojiM'] = $srcArray[1];
        $_SESSION['emojiS'] = $srcArray[2];
    }
    if (isset($_SESSION["emojiE"]) && isset($_SESSION["emojM;"]) && isset($_SESSION["emojiS"]));
    	$_SESSION["registered"] = true;
    // Redirect to the profile page
    header("Location: pairs.php");
    exit();
  }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Memory Page</title>
        
    </head>
    <body>
<?php
include 'navbar.php';
?>         
        <div id="main">
            <img id="background" src="arcade-unsplash.jpg" class="center">
            <div id="background2" >
                <h1 id="avatarText" style="display: none;">Please choose an avatar</h1>
                <div id="arrows" style="display: none;">
                    <img id="eyeArrow" src="Rarrow-removebg-preview.png" onclick="changeEye()">
                    <img id="mouthArrow" src="Rarrow-removebg-preview.png" onclick="changeMouth()">
                    <img id="skinArrow" src="Rarrow-removebg-preview.png" onclick="changeSkin()">
                </div>
                <div id="content">
                    <h1 id="Rtext">Registration page</h1>
                    <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" onsubmit="HasLogedIn(event)">
                        <input type="text" id="username-input" name="username-input" placeholder="Enter your username" autocomplete="off" required>
                        <div id="error-message" class="error-message" style="display: none;">
                        Invalid characters detected. Please enter a new username without any of the following characters: !"@#%&*()+=^{}[]—;:'<>?/
                        </div>
			<div id="error-message2" class="error-message" style="display: none;">
                        Invalid length of username, please respect a 20 char limit.
                        </div>
                        <button id="Next" type="button" onclick="validateInput()">Next</button>
			<div id="emoji" style="display: none;">
                            <img id="emojiS" >
                            <img id="emojiM" >
                            <img id="emojiE" >
                        </div>
                        <button id="StartP" type="submit" style="display: none;">Start Playing</button>
                    </form>
                </div>
            </div>
        </div>
    </body>
    <style>
        body{
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
            height: 100%;
            width: 100%;
            max-width: 120%;
            margin-left: auto;
            margin-right: auto;
        }

        #background2 {
            background-color: #191919;
            position: absolute;
            width: 50%;
            height: 50%;
            top: 25%;
            left: 25%;
            border-radius: 80px;
            border: none;
            padding: 10px;
        }

        #content {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            text-align: center;
        }

        h1 {
            color: #fff;
            font-size: 60px;
            text-shadow: 2px 2px 2px #000;
        }

        input[type="text"] {
            padding: 12px;
            border-radius: 10px;
            border: none;
            font-size: 1.5rem;
            margin: 20px;
            width: 400px;
            background-color: #fff;
            box-shadow: 2px 2px 2px #000;
        }

        button {
            margin-top: 10%;
            background-color: #ff00ff;
            color: #fff;
            font-size: 1.5rem;
            padding: 12px 24px;
            border-radius: 10px;
            border: none;
            cursor: pointer;
            transition: background-color 0.3s ease-in-out;
            box-shadow: 2px 2px 2px #000;
        }

        button:hover {
            background-color: #ff69b4;
        }

        .error-message {
            color: red;
            font-weight: bold;
            font-size: 15px;
            position: absolute;
        }

        #StartP {
            margin: 0 auto;
            margin-top: 300%;
        }

        #avatarText {
            text-align: center;
            margin-bottom: 0%;   
        }

        #emoji {
            position: relative;
            margin-top: 2%;
        }

	#emoji img {
            position: absolute;
            left: -43%;
            width: 190%;
            bottom: 100%;
            margin-bottom: 50%;
        }

        #emojiE {
            margin-top: -20px;
        }

        #arrows {
            display: flex;
            flex-direction: column;
            margin-left: 78%;
            margin-top: 13%;
        }

        #arrows img {
            width: 45%;
            margin-top: 15%;
        }
        
    </style>
    <script src="registration.js"></script>
</html>
