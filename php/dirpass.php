<?php
include 'config.php';

	$query = "SELECT haslo FROM folder WHERE link='".$_GET['linkk']."'";
	$result = $mysqli->query($query);
	$row = $result->fetch_assoc();	
		
	if($row['haslo'] == md5($_GET['haslo'])){
		setcookie($_GET['linkk'], md5($_GET['haslo']), time()+3600*24*7,'');
	}else{
		echo 'zle';
	}

?>