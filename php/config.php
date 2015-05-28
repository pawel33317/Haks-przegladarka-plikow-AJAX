<?php
$GLOBALS['main_folder'] = '../upload';
error_reporting(E_ALL);
$GLOBALS['owner'] = false;
$xx = false;
$db_server = "localhost";
$db_database = "filebro";
$db_username = "root";
$db_password = "";

$mysqli = new mysqli($db_server, $db_username, $db_password, $db_database);
if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
	die();
}

if (session_status() == PHP_SESSION_NONE) {
	session_start();
}

if(isset($_GET['link']) && $_GET['link']!="" && !empty($_GET['link']) && $_GET['link']!="undefined"){
	$GLOBALS['link']=str_replace('..','',$_GET['link']);
	$GLOBALS['current_dir'] = $GLOBALS['main_folder'].'/'.$link;
}
else {
	$GLOBALS['current_dir']=$GLOBALS['main_folder'];
	$GLOBALS['link']='';
}	

if(isset($_COOKIE['log'])){
	$query = "SELECT login, id, haslo, ranga FROM users WHERE login='".$_COOKIE['log']."'";
	$result = $mysqli->query($query);
	$row = $result->fetch_assoc();	
	if($row["haslo"] == $_COOKIE['pas']){
		$GLOBALS['zalogowany'] = true;
		$GLOBALS['user'] = $row["login"];
		$GLOBALS['userid'] = $row["id"];
		
		if($row["ranga"] == 10){
			$GLOBALS['owner'] = true;
		}
		
		if($row["ranga"] == 10){
			$GLOBALS['owner'] = true;
		}

		if(strlen($GLOBALS['link']) > 2){
			if(strpos($GLOBALS['link'], '/') > 0){
				$mainFolder = substr($GLOBALS['link'], 0, strpos($GLOBALS['link'], '/')-1);
			}else{
				$mainFolder = $GLOBALS['link'];
			}
			
			if($mainFolder == $GLOBALS['user']){
				$GLOBALS['owner'] = true;
			}
		}
		////////////////////////////////////////////////////////
		////////////////////////////////////////////////////////
		/////////owner jeżeli właściciel katalogu///////////////
		////////////////////////////////////////////////////////
		////////////////////////////////////////////////////////
		////////////////////////////////////////////////////////
	}else{
		$GLOBALS['zalogowany'] = false;
	}
}else{
	$GLOBALS['zalogowany'] = false;
}


	


function genCurrentLink(){
	echo 'Serwer';
	if ($GLOBALS['link'] != ''){
		echo '/'.$GLOBALS['link'];
	}
}
function goToTop(){
	$pos = strrpos($GLOBALS['link'], "/");
	if ($pos === false) {
		$newLink = 'index.php';
	}else{
		$newLink = 'index.php?link='.substr($GLOBALS['link'], 0, $pos);
	}
	if ($GLOBALS['link'] != ''){
		echo '
		<script>
			$("#goToTop").show();
			$("#goToTop").click(function(){
				window.open("'.$newLink.'","_self");
			});
			
			$("#goToTop2").show();
			$("#goToTop2").click(function(){
				window.open("'.$newLink.'","_self");
			});

		</script>';
	}
}
function schowekElementExist($searched){
	if (session_status() == PHP_SESSION_NONE) {
		return false;
	}
	if(!isset($_SESSION["count"])){
		return false;
	}
	for($i = 0; $i <= $_SESSION["count"]; $i++){
		if($_SESSION["var".$i] == $searched){
			return true;
		}
	}
	return false;
}


?>