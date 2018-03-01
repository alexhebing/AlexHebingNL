<?php
	$fileNames = array();
	$mp3dir = "C:/Alex/rommeltjes/2016";
	$isFavPage = false;

	foreach (new DirectoryIterator($mp3dir) as $file) {
	  if ($file->isFile()) {

	  	$title = basename($file);
	  	$path = '/session/2016' . '/' . $title;

	  	$file = array(
	  		"title" => basename($file, ".mp3"),
    		"path" => $path);

	      array_push($fileNames, $file);
	  }
	}

	include('master.php');
?>