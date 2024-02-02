<?php
session_start();

// Check if the session variables are set
if ($_SESSION["registered"] == true) {
  $is_registered = $_SESSION["registered"];
  // Retrieve the username from the session variable
  $username = $_SESSION["username"];

  // Retrieve the avatar elements from the session variable
  $emojiSs = $_SESSION["emojiS"];
  $emojiMm = $_SESSION["emojiM"];
  $emojiEe = $_SESSION["emojiE"];}
?>

<html>
    <div class="navbar">
        <a class="aligned-L" href="index.php"> Home</a> 
        <a class="aligned-R" href="pairs.php"> Memory</a>
	<div class="aligned-L" id="emoji2" style="display: none;" >
            <img id="emojiSs" src="<?php echo $emojiSs?>">
            <img id="emojiMm" src="<?php echo $emojiMm ?>">
            <img id="emojiEe" src="<?php echo $emojiEe ?>">
        </div>
	<p id="user" class="aligned-L"><?php echo $username ?></p>
        <a id="nav3" class="aligned-R" href="registration.php"> Register</a>
    </div>
    <style>
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

    	#emoji2 img {
      	  position: absolute;
      	  width: 3%;
	  top: 2px;
    	}

	#user{
       	  margin-left: 60px;
	  color: #f7c705;
	  margin-top: 1.05%;
	  font-family: Verdana;
          font-size: 15px;
          font-weight: bold;
	}
    </style>
    <script>

        function displayNav() {
           var registered = <?php echo $is_registered; ?>;
		if (registered) {
			const logged = document.getElementById("nav3");
                	logged.innerHTML = " Leaderboard";
                	logged.href = "leaderboard.php";
			document.getElementById("emoji2").style.display ="block";
		} else {
			alert("You are not registered yet.");
		}
        }

	displayNav();
    </script>
</html>
