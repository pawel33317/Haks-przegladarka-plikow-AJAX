<?php
include 'config.php';
function dirCreate($path){
	while(file_exists($path)){
		$path.='(n)';
	}
	mkdir($path, 0700);
	chmod($path, 0777);
	//chmod('pliki', 0777);
}
$filePath = $GLOBALS['current_dir'];
$dirName = $_GET['dir'];
$path = $filePath.'/'.$dirName;
dirCreate($path);



?>