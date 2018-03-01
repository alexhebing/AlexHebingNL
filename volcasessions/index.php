<?php
	try {

	$fileNames = array();
	$mp3dir = "C:/Alex/rommeltjes/2017";
	$isFavPage = false;

	foreach (new DirectoryIterator($mp3dir) as $file) {
	  if ($file->isFile()) {

	  	$title = basename($file);
	  	$path = '/session/2017' . '/' . $title;

	  	$file = array(
	  		"title" => basename($file, ".mp3"),
    		"path" => $path);

	      array_push($fileNames, $file);
	  }
	}
}
catch (Exception $e) {
	echo $e->getMessage();
}

	include('master.php');
?>