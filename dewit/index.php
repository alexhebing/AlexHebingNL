<!DOCTYPE html>
<html>
<head>	
	<title>I love Jesse</title>
	<link rel="shortcut icon" href="../love.ico" />
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>	
	<div id="container">	
		<h3>Dag meneer de Wit!</h3>
		<div id="imgContainer">
			<img id="img" src="img/wheelchair.jpg" />
		</div>
		<div id="youtubeContainer" class="youtubeContainer">
			<iframe width="560" height="315" src="https://www.youtube.com/embed/P6dUf9PyKcw" frameborder="0" allowfullscreen></iframe>
		</div>
		<div id="buttonContainer">
			<div class="button" onclick="shutUpClick()">Shut up and let me watch a clip...</div>
			<div class="button" onclick="stackOverflowClick()">Stack Overflow!</div>
			<div class="button" onclick="mysteryButtonClick()">Mystery button...</div>
		</div>
		<audio id="audio" controls="controls">
			<source id="mp3Source" src="" type="audio/mp3"></source>
			Your browser does not support the audio element.
		</audio>							
	</div> 
</body>
<script>
	function shutUpClick()
	{
		document.getElementById('youtubeContainer').style.display = "block";

		document.getElementById('img').style.display = "none";

		audio.pause();
	}

	function mysteryButtonClick()
	{
		console.log("figured it out yet?");
	}

	function stackOverflowClick()
	{
		function person()
		{
			var anotherPerson = new person();
		}

		try 
		{
		    firstPerson = new person();
		}
		catch(err) 
		{
		    alert(err.message);
		}		
	}

	function StartGreeting()
	{
		var source = document.getElementById('mp3Source');
        source.src='sounds/Spraak 003.m4a';

        
		audio.loop = true;
        audio.load(); //call this to just preload the audio without playing
        audio.play();
	}



	StartGreeting();
</script>
</html>