<!DOCTYPE html>
<html>
<head>
	<title>Encouragerizer</title>
	<link rel="shortcut icon" href="../love.ico" />
	<link rel="stylesheet" href="style.css">
	<script> 
		function ToggleBackgroundImage()
		{
			var random = Math.floor(Math.random() * 2) + 1; 

			if (random == 1)
			{
				photoName =  "Aardappeltje.jpg";				
			}
			else
			{
				photoName =  "patatjes1.jpg";
			}

			document.body.style.backgroundImage = 'url(' + photoName + ')';
		}

		function MoveToEncouragements()
		{
			window.open("encouragements.txt");
		}
	</script>
</head>
<body>
	<?php

	$GLOBALS['passwordChecked'] = false;
	$GLOBALS['photoName'] = "myPhoto.jpg";
	$encouragement = '';

	$password = "";

	if ($_SERVER["REQUEST_METHOD"] == "POST") 
	{
	 	if (!empty($_POST["password"]))
	 	{
		 	$GLOBALS['passwordChecked'] = false;

		 	$password = test_input($_POST["password"]);
	    	check_password($password);
    	}

    	if (!empty($_POST["newEncouragement"]))
	 	{
		 	$GLOBALS['passwordChecked'] = true;
		 	$filename = "encouragements.txt";

		 	$encouragement = test_input($_POST["newEncouragement"]);
		 	$encouragement = trim($encouragement);

			$lines = file($filename, FILE_IGNORE_NEW_LINES);

			if (!in_array(trim($encouragement), $lines))
			{
		  		file_put_contents($filename, $encouragement.PHP_EOL, FILE_APPEND);
		  	}
    	}
	}

	function test_input($data) {
	  $data = trim($data);
	  $data = stripslashes($data);
	  $data = htmlspecialchars($data);
	  return $data;
	}

	function check_password($password)
	{
		if (md5($password) != "cee83a99bd44ea371a814f64acf26cb6")
		{
			show_403('403 in your face!');
		}

		$GLOBALS['passwordChecked'] = true;
	}

	function show_403($message)
	{
		header("HTTP/1.0 403 Forbidden"); 
		header("Status: 403 Forbidden");
		echo $message;
		exit;
	}

	?>

	<h1>ENCOURAGERIZER!!</h1>

	<div id = "myContainer">
		<div id="passwordForm" class="form" <?php if ($GLOBALS['passwordChecked']){ echo 'style="display:none;"'; }?> >
			<form method="post">
				<div <?php if ($passwordChecked){ echo 'style="display:none;"'; }?> >Please enter the password:</div>
				<input type="password" name="password" class="inputField">
				<br>
				<input type="submit" value="Give it a try" class="inputButton">
			</form>
		</div>

		<div id="encourageForm" class="form" <?php if (!$GLOBALS['passwordChecked']){ echo 'style="display:none;"'; }?> >		
			<form method="post">
				<div id="addedEncouragement" <?php if (empty($encouragement)){ echo 'style="display:none;"'; }?> >You just added: <?php echo $encouragement ?></div>
				<div id="newEncouragement">New Encouragement: <input type="text" name="newEncouragement" class="inputField"></div>
				<br>
				<input type="submit" value="Add" class="inputButton">			    
			</form>
			<button onclick="MoveToEncouragements()" class="inputButton" id="getEncouragementsButton">Get Encouragements</button>
		</div>
	</div> <!--mycontainer-->
</body>
<script>
	ToggleBackgroundImage();
</script>
</html>