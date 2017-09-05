<!DOCTYPE html>
<html>
<head>	
	<title>alex hebing</title>
	<link rel="shortcut icon" href="../love.ico" />
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	<?php 

		$fileNames = array();
		$mp3dir = "./bonus";

		foreach (new DirectoryIterator($mp3dir) as $file) 
		{
		  if ($file->isFile()) 
		  {
		  	$file = array(
		  		"title" => basename($file, ".mp3"),
        		"path" => basename($file));

		    array_push($fileNames, $file);
		  }
		}
	?>

	<div id="container">
		<h3>a sweetness</h3>
		<div id="content">			 
			<iframe style="border: 0; width: 400px; height: 472px;" src="https://bandcamp.com/EmbeddedPlayer/album=2621143822/size=large/bgcol=ffffff/linkcol=0687f5/artwork=small/transparent=true/" seamless><a href="http://alexhebing.bandcamp.com/album/a-sweetness">a sweetness by Alex Hebing</a></iframe>			
		</div>					
	</div>
	<h4>BONUS MATERIAL</h4>
	<table id="contentTable"></table> 
</body>
<script>
	function CreateTable()
	{
		var files = JSON.parse( '<?php echo json_encode($fileNames) ?>' );
		
		for (var i = 0; i < files.length; i++) {
			AddToTable(i, files[i].title, files[i].path);
		};
	}

	function AddToTable(index, title, path)
	{
		var table = document.getElementById("contentTable");

        var row = table.insertRow(index);
        var col1 = row.insertCell(0);
        col1.innerHTML = title;

        var col2 = row.insertCell(1);
        col2.innerHTML = '<audio controls><source src="./bonus/' + path + '" type="audio/mpeg">Your browser does not support the audio element.</audio>';
	}

	CreateTable();
</script>
</html>