<?php
include 'config.php';

function removee($path){
    if (is_file($path) === true){
    	unlink($path);
    	exit();
    }
    return false;
}
$filePath = $GLOBALS['current_dir'];
$fileName = $_GET['file'];
$path = $filePath.'/'.$fileName;
removee($path);



?>