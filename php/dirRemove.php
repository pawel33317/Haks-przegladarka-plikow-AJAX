<?php
include 'config.php';

function removee($path,$mysqli){
	foreach(new DirectoryIterator($path) as  $entry){
		if($entry->isDir() && $entry->getFilename()!='..' && $entry->getFilename()!='.'){
			removee($path.'/'.$entry->getFilename(),$mysqli);
		}
		if(!$entry->isDir()){
			@unlink($path.'/'.$entry->getFilename());
		}
	}
	$query = "delete from folder WHERE link='".substr($path, strlen($GLOBALS['main_folder'])+1)."'";
	$result = $mysqli->query($query);
	rmdir($path);
}



$filePath = $GLOBALS['current_dir'];
$dirName = $_GET['dir'];
$path = $filePath.'/'.$dirName;
removee($path,$mysqli);




?>