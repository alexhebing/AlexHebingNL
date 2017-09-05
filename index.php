<!DOCTYPE html>
<html>
<head>	
	<title>alex hebing</title>
	<link rel="shortcut icon" href="love.ico" />
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	<?php

		include "dirFinder.php";

		$dirs = FindDirs();
	?>
	
	<h3>ALEX HEBING</h3>
	<div id="container">		
		<div id="navBarContainer">
			<nav id="navBar">
			</nav>
		</div>
		<div id="explanationField" class="contentField">
		</div>
		<div id="imageField" class="contentField">
		</div>					
	</div>
	
</body>
<script>
	function CreateNavBar()
	{
		var dirs = JSON.parse( '<?php echo json_encode($dirs) ?>' );

		for (var i = 0; i < dirs.length; i++) {
			
			if (dirs[i].Name != "cgi-bin" && dirs[i].Name != "img" && dirs[i].Name != "dewit")
			{
				AddElementToNavBar(dirs[i]);
			}
		};
	}

	function AddElementToNavBar(dir)
	{
		var navBar = document.getElementById("navBar");		

		var newNode = document.createElement("a");
		newNode.classList.add("navElement");
		newNode.addEventListener('click', function() { location.href = dir.Name }, false)
		newNode.onmouseover = function() { HandleMouseOver(dir.Name) };
		newNode.onmouseleave = function() { HandleMouseLeave(dir.Name )};

		var textNode = document.createElement("p");
		textNode.innerText = dir.Name;
		newNode.appendChild(textNode);

		navBar.appendChild(newNode);
	}

	function HandleMouseOver(dirName)
	{
		var explanationField = document.getElementById("explanationField");
		explanationField.innerText = SelectText(dirName);
	}

	function HandleMouseLeave()
	{
		var explanationField = document.getElementById("explanationField");
		explanationField.innerText = "";
	}

	function SelectText(dirName)
	{
		switch(dirName) {
		    case "encourage":
		        return "Secret spot for exchanging encouragements. Goed bezig!";
		    case "volcasessions":
		        return "Weekend afternoon fun";
	        case "touch":
		        return "My first game, and last project for the university. Start the theoretical reflections on touch!";
	        case "a sweetness":
	        	return "Some songs recorded in and around 2008. Mostly on life and death.";
		    default:
		        return "Nothing to say about this (yet)";
		}
	}

	CreateNavBar();
</script>