<?php
	$fileNames = array();
	$mp3dir = "./2016mp3s";
	$isFavPage = false;

	foreach (new DirectoryIterator($mp3dir) as $file) {
	  if ($file->isFile()) {

	  	$title = basename($file);
	  	$path = $mp3dir . '/' . $title;

	  	$file = array(
	  		"title" => basename($file, ".mp3"),
    		"path" => $path);

	      array_push($fileNames, $file);
	  }
	}

	include('master.php');
?>