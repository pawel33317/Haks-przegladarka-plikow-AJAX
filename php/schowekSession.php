<?php
	include 'config.php';
	
	function showSchowek(){
		if (session_status() == PHP_SESSION_NONE) {
			session_start();
		}
		if(isset($_SESSION["count"])){
			print "<em>Ilość elementów do przeniesienia: ".($_SESSION["count"]+1).'</em><br>';
			for($i = 0; $i <= $_SESSION["count"]; $i++){
				print $_SESSION["var".$i]."<br>";
			}
			return true;
		}
		return false;
	}
	
	
	
	
function create_zip($files = array(),$destination = '',$overwrite = false) {
	//if the zip file already exists and overwrite is false, return false
	if(file_exists($destination) && !$overwrite) { return false; }
	//vars
	$valid_files = array();
	//if files were passed in...
	if(is_array($files)) {
		//cycle through each file
		foreach($files as $file) {
			//make sure the file exists
			if(file_exists($file)) {
				$valid_files[] = $file;
			}
		}
	}
	//if we have good files...
	if(count($valid_files)) {
		//create the archive
		$zip = new ZipArchive();
		if($zip->open($destination,$overwrite ? ZIPARCHIVE::OVERWRITE : ZIPARCHIVE::CREATE) !== true) {
			return false;
		}
		//add the files
		foreach($valid_files as $file) {
			$zip->addFile($file,$file);
		}
		//debug
		//echo 'The zip archive contains ',$zip->numFiles,' files with a status of ',$zip->status;
		
		//close the zip -- done!
		$zip->close();
		
		//check to make sure the file exists
		return file_exists($destination);
	}
	else{
		return false;
	}
}
	
	
class FlxZipArchive extends ZipArchive 
{
 public function addDir($location, $name) 
 {
       $this->addEmptyDir($name);
       $this->addDirDo($location, $name);
 } 
 private function addDirDo($location, $name) 
 {
    $name .= '/';
    $location .= '/';
    $dir = opendir ($location);
    while ($file = readdir($dir))
    {
        if ($file == '.' || $file == '..') continue;
        $do = (filetype( $location . $file) == 'dir') ? 'addDir' : 'addFile';
        $this->$do($location . $file, $name . $file);
    }
 } 
}

	
	if(@$_GET['op'] == 'add'){
		if (session_status() == PHP_SESSION_NONE) {
			session_start();
		}
		
		$isNewSession=false;
		if(!isset($_SESSION["count"])){
			$_SESSION["count"] = 0;
			$isNewSession=true;
		}
		
		$isAlreadyExist=false;
		for($i = 0; $i <= $_SESSION["count"]; $i++){
			if(!$isNewSession && $_SESSION["var".$i] == $_GET['file']){
				$isAlreadyExist=true;
			}
		}
		
		if(!$isAlreadyExist){
			if($isNewSession==false){
				$_SESSION["count"]++;
			}
			$_SESSION["var".$_SESSION["count"]] = $_GET['file'];
		}
		showSchowek();
	}
	if(@$_GET['op'] == 'destroy'){
		@session_unset(); 
		@session_destroy();
		@session_write_close();
		@setcookie(session_name(),'',0,'/');
		@session_regenerate_id(true);
	}
	if(@$_GET['op'] == 'zipcreate'){
		if (session_status() == PHP_SESSION_NONE) {
			session_start();
		}
		if(!isset($_SESSION["count"])){
			return false;
		}
		$files_to_zip = array();
		for($i = 0; $i <= $_SESSION["count"]; $i++){
			$pos = strrpos($_SESSION["var".$i], "/");
			
			if ($pos === false){
				if ($_GET['newlocation'] == '') {
					$newLocation = $_GET['newlocation'];
				}else{
					$newLocation = $_GET['newlocation'].'/';
				}
			}else{
				if ($_GET['newlocation'] == '') {
					$newLocation = $_GET['newlocation'];
				}else{
					$newLocation = $_GET['newlocation'].'/';
				}
				
			}
			//rename($GLOBALS['main_folder'].'/'.$_SESSION["var".$i], );
			array_push($files_to_zip,$GLOBALS['main_folder'].'/'.$_SESSION["var".$i]);
		}
		
		$za = new FlxZipArchive;
		$zip_file_name = $GLOBALS['main_folder'].'/'.$newLocation.date("Ymd-G.i.s").'.zip';
		
		$res = $za->open($zip_file_name, ZipArchive::CREATE);
		if($res === TRUE) 
		{
			if(is_array($files_to_zip)) {
				//cycle through each file
				foreach($files_to_zip as $file) {
					//make sure the file exists
					if(is_dir($file)) {
						$za->addDir($file, basename($file));
					}else{
						$za->addFile($file,basename($file));
					}
				}
			}
			$za->close();
			}
		else{
			echo 'Could not create a zip archive';
		}
		@session_unset(); 
		@session_destroy();
		@session_write_close();
		@setcookie(session_name(),'',0,'/');
		@session_regenerate_id(true);
	}
	if(@$_GET['op'] == 'move'){
		if (session_status() == PHP_SESSION_NONE) {
			session_start();
		}
		if(!isset($_SESSION["count"])){
			return false;
		}
		
		for($i = 0; $i <= $_SESSION["count"]; $i++){
			$pos = strrpos($_SESSION["var".$i], "/");
			
			if ($pos === false){
				if ($_GET['newlocation'] == '') {
					$newLocation = $_GET['newlocation'].$_SESSION["var".$i];
				}else{
					$newLocation = $_GET['newlocation'].'/'.substr($_SESSION["var".$i], $pos);
				}
			}else{
				if ($_GET['newlocation'] == '') {
					$newLocation = $_GET['newlocation'].substr($_SESSION["var".$i], $pos+1);
				}else{
					$newLocation = $_GET['newlocation'].substr($_SESSION["var".$i], $pos);
				}
				
			}
			rename($GLOBALS['main_folder'].'/'.$_SESSION["var".$i], $GLOBALS['main_folder'].'/'.$newLocation);
			
			                            //  echo $_SESSION["var".$i].'-----'.$newLocation.'-----------'.$_GET['newlocation'].'<br>';
		}
		@session_unset(); 
		@session_destroy();
		@session_write_close();
		@setcookie(session_name(),'',0,'/');
		@session_regenerate_id(true);
	}
	if(@$_GET['op'] == 'show'){
		showSchowek();
	}
	if(@$_GET['op'] == 'plaste'){
		@session_unset(); 
		@session_destroy();
		@session_write_close();
		@setcookie(session_name(),'',0,'/');
		@session_regenerate_id(true);
	}
	//print_r(@$_SESSION);
?>