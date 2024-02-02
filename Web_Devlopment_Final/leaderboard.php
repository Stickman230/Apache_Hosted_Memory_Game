<?php
session_start();

// Check if the session variables are set
if ($_SESSION["registered"] == true) {
    
	  // Retrieve the cookie values
	$username = $_COOKIE["username"];
	$emojiS = $_COOKIE["userAvatarS"];
	$emojiM = $_COOKIE["userAvatarM"];
	$emojiE = $_COOKIE["userAvatarE"];
	$score = $_COOKIE["score"];
	$time = $_COOKIE["time"];
	$clicks = $_COOKIE["clicks"];

	// Update the leaderboard table with the retrieved values
	// Retrieve the existing leaderboard data
	if (
	    !isset($_COOKIE["username"]) ||
	    !isset($_COOKIE["userAvatarS"]) ||
	    !isset($_COOKIE["userAvatarM"]) ||
	    !isset($_COOKIE["userAvatarE"]) ||
	    !isset($_COOKIE["score"]) ||
	    !isset($_COOKIE["time"]) ||
	    !isset($_COOKIE["clicks"])
	) {
	    echo "Error: missing one or more required cookie values";
	    // handle the error here
	}

	$path = "leaderboard.json";
	if (file_exists($path)) {
		$data = file_get_contents($path,true);
		$ex_leaderboard = json_decode($data);
		$elements = array();
		    foreach ($ex_leaderboard as $rows) {
		        $element = array();
		        foreach ($rows as $key => $val) {
		            $element[$key] = $val;
		        }
		        $elements[] = $element;
		    }

	}
	$userIndex = -1;
        foreach ($elements as $index => $users) {
           if ($users['username'] == $username) {
              $userIndex = $index;
              break;
           }
        }

    // Update the user data if found, otherwise add the new user data
    if ($userIndex >= 0) {
        $elements[$userIndex]['emojiS'] = $emojiS;
        $elements[$userIndex]['emojiM'] = $emojiM;
        $elements[$userIndex]['emojiE'] = $emojiE;
        $elements[$userIndex]['score'] = $score;
        $elements[$userIndex]['time'] = $time;
        $elements[$userIndex]['clicks'] = $clicks;
    } else {
	$elements[] = array(
	    "username" => $username,
	    "emojiS" => $emojiS,
	    "emojiM" => $emojiM,
	    "emojiE" => $emojiE,
	    "score" => $score,
	    "time" => $time,
	    "clicks" => $clicks
	);}
	// Append the new user data to the existing leaderboard data

	// Sort the leaderboard array by score in descending order
	usort($elements, function($a, $b) {
    		return $a['score'] - $b['score'];
	});
	$elements = array_slice($elements, 0, 10);
	// Save the updated leaderboard data to a file

	$modified = json_encode($elements);
	file_put_contents($path ,$modified);
	if (json_last_error() !== JSON_ERROR_NONE) {
	    echo "Error: failed to encode leaderboard data: " . json_last_error_msg();
	}
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://fonts.cdnfonts.com/css/arcade-classic" rel="stylesheet">
        <title>Leaderboard</title>
    </head>
    <body>
<?php
include 'navbar.php'
?>
        <div id="main">
            <img id="background" src="arcade-unsplash.jpg" class="center">
	        <div class="center">
	            <table id="scoretables" style="width:80%">
	                <tr id="header">
	                    <th>AVATAR</th>
	                    <th>USER</th>
	                    <th>BEST TOTAL SCORE</th>
	                    <th>TIME</th>
	                    <th>N.OF CLICKS</th>
	                </tr>
			<?php foreach ($elements as $user): ?>
	                <tr>
	                    <td>
				<div id="emoji" >
                            	<img id="emojiS" src="<?php echo $user['emojiS']?>">
                            	<img id="emojiM" src="<?php echo $user['emojiM']?>">
                            	<img id="emojiE" src="<?php echo $user['emojiE']?>">
                        	</div>
			    </td>
	                    <td><?php echo $user['username']?></td>
	                    <td><?php echo $user['score']?></td>
	                    <td><?php echo $user['time']?></td>
	                    <td><?php echo $user['clicks']?></td>
	                </tr>
			<?php endforeach; ?>
	            </table>
	        </div>
	</div>
    </body>
    <style>
        body{
            margin: 0px;
        }

        #scoretables {
            background-color: #aca9a999;
            box-shadow: 5px;
            border-spacing: 2px;
            border: 15px solid #b3b3b3;
            text-align: center;
            margin-top: 42%;
            margin-left: 50%;
            overflow: auto;
            color: rgb(255, 255, 255);
            font-weight: bold;
            font-size: 350%;
            transform: translate(-50%, -50%);
            z-index: 2;
            border-collapse: collapse;
        }

        #background {
            filter: blur(6px);
	    min-height: 180%;
  	    min-width: 1024px;
	    width: 100%;
            height: auto%;
        }

        #header{
            background-color:blue;
            padding: 10px ;
            font-family: 'ArcadeClassic', sans-serif;
        }

        th, td {
            border: 1px solid;
            padding: 25px
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
            background-color: #28779c;}

        .navbar {
            background-color: blue;}
        
        @media screen and (max-width: 800px) {
            .navbar a {
                float: none;
                display: block;}
        }

        .aligned-R{
            float: right;}

        .aligned-L{
            float: left;}

        .center {
            position: absolute;
            display: block;
            margin-left: auto;
            margin-right: auto;
            width: 100%;
        }

	 #emoji {
            position: relative;
	    margin-top: -20%;
    	    right: 15%;
        }

        #emoji img {
            position: absolute;
            width: 40%;

        }

    </style>
    <script src="leaderboard.js"></script>
</html>
