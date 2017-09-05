<?php

	function FindDirs()
	{
		chdir(dirname(__FILE__));

		$dirNames = array_filter(glob('*'), 'is_dir');			
		$dirs = array();

		foreach ($dirNames as $dirName) {
			$dir = array(
		  		"Name" => $dirName);
			
			array_push($dirs, $dir);
		}

		return $dirs;
	}

?>