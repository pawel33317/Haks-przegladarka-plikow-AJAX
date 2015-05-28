<?php
include 'config.php';
function changeName($old, $new){
	while(file_exists($new)){
		$new.='(n)';
	}	
	rename($old,$new);
}
$filePath = $GLOBALS['current_dir'];
$oldname = $_GET['oldname'];
$newname = $_GET['newname'];
$old = $filePath.'/'.$oldname;
$new = $filePath.'/'.$newname;
changeName($old, $new);

?>