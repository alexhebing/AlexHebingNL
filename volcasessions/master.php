<!DOCTYPE html>
<html>
<head>	
	<title>alex hebing</title>
	<link rel="shortcut icon" href="../love.ico" />
	<link rel="stylesheet" type="text/css" href="style.css">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">	
</head>
<body>	
	<div id="container">	
		<h3>VOLCA SESSIONS</h3>
		<div id="menu">
         <a href="2016.php"><h2>2016</h2></a>
         <a href="index.php"><h2>2017</h2></a>
      	</div>
		<div id="mediaPlayer" class="mediaplayer">
			<img class="mediaplayerImage" src="img/volcabass.png" />
			<div id="title" class="mediaplayerTitle"></div>
			<audio id="audio" controls="controls">
				<source id="mp3Source" src="" type="audio/mp3"></source>
				Your browser does not support the audio element.
			</audio>
			<table id="contentTable"></table>
		</div>
						
	</div> 
</body>
<script>
	var currentlyPlayingSongTitle;
	var currentlyPlayingSongPath;
	var songs;

	function CreateTable()
	{
		var isFavPage = JSON.parse( '<?php echo json_encode($isFavPage) ?>' );
		var files = [];

		if (isFavPage)
		{
			for(var i in localStorage)
			{
			    files.push(new Session(i, localStorage[i]));
			}
		}
		else
		{
			files = JSON.parse( '<?php echo json_encode($fileNames) ?>' );			
		}
		
		songs = SortFilesByName(files);

		for (var i = 0; i < files.length; i++) {
			AddToTable(i, files[i].title, files[i].path);

			if (i === 0)
			{
				SetTrack(files[i].title, files[i].path)
			}
		};
	}
	

	function Session(title, path)
	{
		this.title = title;
		this.path = path;
	}

	function AddToTable(index, title, path)
	{
		var table = document.getElementById("contentTable");

        var row = table.insertRow(index);
        var col1 = row.insertCell(0);
        col1.innerHTML = title;
        col1.onclick = function(){SetTrack(title, path)};
	}

	function SetTrack(title, path)
	{
		var mediaplayer = document.getElementById("audio");

		var source = document.getElementById('mp3Source');
		var mp3Dir =  JSON.parse('<?php echo json_encode($mp3dir) ?>' );
        source.src= path;

        currentlyPlayingSongTitle = title;
        currentlyPlayingSongPath = path;

        audio.load(); //call this to just preload the audio without playing
        audio.play();

        var titleElement = document.getElementById("title");
        titleElement.innerText = title;
	}

	function SortFilesByName(files)
	{
		return files.sort(function(a, b)
		{
			var aIndex = a.title.indexOf(".");
			var aEndIndex = a.title.indexOf(".", aIndex + 1);
			var aLastIndex = a.title.lastIndexOf(".");

			var aDay = a.title.substring(0, aIndex);
			var aMonth = a.title.substring(aIndex + 1, aEndIndex);
			var aYear = a.title.substring(aEndIndex + 1, aEndIndex + 5);
			var aNumber = a.title.substring(aLastIndex + 1, aLastIndex + 2);

			var bIndex = b.title.indexOf(".");
			var bEndIndex = b.title.indexOf(".", bIndex + 1);
			var bLastIndex = b.title.lastIndexOf(".");

			var bDay = b.title.substring(0, bIndex);
			var bMonth = b.title.substring(bIndex + 1, bEndIndex);
			var bYear = b.title.substring(bEndIndex + 1, bEndIndex + 5);
			var bNumber = b.title.substring(bLastIndex + 1, bLastIndex + 2);
			
			
			if (aYear == bYear)
			{	
				if (aMonth == bMonth)
				{
					if (aDay == bDay)
					{
						return aNumber - bNumber;						
					}
					else
					{
						return bDay - aDay;
					}
				}
				else
				{
					return bMonth - aMonth;
				}
			}
			else
			{
				return bYear - aYear;
			}			
		})
	}

	function StartNextTrack()
	{
		for (var i = 0; i < songs.length; i++) {
			if (songs[i].title === currentlyPlayingSongTitle)
			{
				if (i === songs.length -1) // last song in list
				{
					SetTrack(songs[0].title, songs[0].path)
					break;
				}

				SetTrack(songs[i + 1].title, songs[i + 1].path)
				break;
			}
		};
	}

	function SubscribeToEvents()
	{
		audio.onended = function() {
		    StartNextTrack();
		};
	}

	CreateTable();
	SubscribeToEvents();		
</script>
</html>