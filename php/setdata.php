<?php
include 'config.php';

if (isset($_GET['opis'])){
	$query = "update folder SET opis = '".$_GET['opis']."' WHERE link='".substr($GLOBALS['current_dir'], strlen($GLOBALS['main_folder'])+1)."'";
	$result = $mysqli->query($query);
	echo $_GET['opis'];
}

if (isset($_GET['haslo'])){

	if ($_GET['haslo'] == ''){
		$query = "update folder SET haslo = '' WHERE link='".substr($GLOBALS['current_dir'], strlen($GLOBALS['main_folder'])+1)."'";
		$result = $mysqli->query($query);
		echo 'Brak hasła';
	}else{
		$query = "update folder SET haslo = '".md5($_GET['haslo'])."' WHERE link='".substr($GLOBALS['current_dir'], strlen($GLOBALS['main_folder'])+1)."'";
		$result = $mysqli->query($query);
		echo '*******';
	}
}

?>