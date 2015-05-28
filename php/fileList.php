<?php
include 'config.php';
function foldery(){
	if(isset($_GET['link']) && $_GET['link']!="" && !empty($_GET['link']) && $_GET['link']!="undefined"){
		$link=str_replace('..','',$_GET['link']);
		$link=$link.'/';
	}
	else {
		$link='';
	}	
	if(!file_exists($GLOBALS['current_dir'])){
		return 'brak takiego folderu';
	}

	
	$fileHtmlList='';
	

	foreach(new DirectoryIterator($GLOBALS['current_dir']) as $num => $entry){
		if($entry->isDir() && $entry->getFilename()!='..' && $entry->getFilename()!='.'){
			//$tablicaFolderow[$num] = new klasaFolderu;
			//$tablicaFolderow[$num]->tworzNazwe($entry->getFilename());
			//$tablicaFolderow[$num]->tworzHtml($folder);
			//@$kodFolderow .= $tablicaFolderow[$num]->htmlFolderu;
		
		if(strlen($entry->getFilename()) > 15){
				$shortName = substr($entry->getFilename(), 0, 13).'...';
		}else{
				$shortName = $entry->getFilename();
		}	
		
		
		$fileHtmlList=$fileHtmlList.'
			<div class="ikona" onclick="showFileMenu(this)" ondblclick="window.open(\'index.php?link='.$link.$entry->getFilename().'\',\'_self\');">
				<div style="display:inline-block;">
					
						<img style="cursor:pointer;"  src="style/ico/folder.png" alt="" title="'.$entry->getFilename().'" />
					<br>
					<strong><a title="'.$entry->getFilename().'" href="index.php?link='.$link.$entry->getFilename().'"';
					
					
					if ($GLOBALS['link'] == ''){
						$localiz = $GLOBALS['link'];
					}else{
						$localiz = $GLOBALS['link'].'/';
					}
					if (schowekElementExist($localiz.$entry->getFilename())){
						$fileHtmlList .=  ' style="color:red;" ';
					}
					
					
					
					
					
					
					
					
					$fileHtmlList.='>'.$shortName.'</a></strong>
				<br></div><div style="display:inline-block; display:none; vertical-align: top;">';
				if($GLOBALS['owner'])
				$fileHtmlList.='
					<span class="glyphicon glyphicon-pencil" aria-hidden="true" 
					onmouseover="$(this).css(\'color\', \'#5cb85c\')" 
					onmouseout="$(this).css(\'color\', \'#323232\')"
					onclick="_(\'renameOldName\').value=\''.$entry->getFilename().'\';$(\'#renameFileDir\').show();"
					></span><br>
					<span class="glyphicon glyphicon-remove" aria-hidden="true" onclick="dirRemove(\''.$entry->getFilename().'\');" onmouseover="$(this).css(\'color\', \'#5cb85c\')" onmouseout="$(this).css(\'color\', \'#323232\')"></span><br>
					<span class="glyphicon glyphicon-move" aria-hidden="true" 
					onmouseover="$(this).css(\'color\', \'#5cb85c\')" 
					onmouseout="$(this).css(\'color\', \'#323232\')"
					onclick="schowekAdd(\''.$entry->getFilename().'\',\''.$GLOBALS['link'].'\');"
					></span>
				';
			$fileHtmlList.='</div></div>';
				
			//$fileHtmlList=$fileHtmlList.'<strong><a href="index.php?link='.$link.$entry->getFilename().'">'.$entry->getFilename().'</a></strong><br>';
		}
	}
	return $fileHtmlList;
}
function pliki(){
	if(isset($_GET['link']) && $_GET['link']!="" && !empty($_GET['link']) && $_GET['link']!="undefined"){
		$link=str_replace('..','',$_GET['link']);
	}else{
		$link="undefined";
	}
	
	if(!file_exists($GLOBALS['current_dir'])){
		return 'brak takiego folderu';
	}
	
	$fileHtmlList='';
	foreach(new DirectoryIterator($GLOBALS['current_dir']) as $num => $entry){
		if(!$entry->isDir() && $entry->getFilename()!='..' && $entry->getFilename()!='.'){
			//$tablicaFolderow[$num] = new klasaFolderu;
			//$tablicaFolderow[$num]->tworzNazwe($entry->getFilename());
			//$tablicaFolderow[$num]->tworzHtml($folder);
			//@$kodFolderow .= $tablicaFolderow[$num]->htmlFolderu;
			
			//ROZSZERZENIE PLIKU
			$pos = strrpos($entry->getFilename(), ".");
			if ($pos === false) {
				$fileExtension = 'none';
			}else{
				$fileExtension = substr($entry->getFilename(), $pos+1);
			}
			
			
			
			if(strlen($entry->getFilename()) > 15){
				$shortName = substr($entry->getFilename(), 0, 13).'...';
			}else{
				$shortName = $entry->getFilename();
			}
		
			$fileHtmlList .= '<div class="ikona" onclick="showFileMenu(this)" ondblclick="window.open(\'php/fileDownload.php?link='.$link.'&file='.$entry->getFilename().'\',\'_self\');">
				<div style="display:inline-block;">
					
						<img style="cursor:pointer;"  src="style/ico/';
						if ($fileExtension == 'txt') {$fileHtmlList .= 'txt.png';}
						elseif ($fileExtension == 'mp3') {$fileHtmlList .= 'mp3.png';}
						elseif ($fileExtension == 'pdf') {$fileHtmlList .= 'pdf.png';}
						elseif ($fileExtension == 'bmp') {$fileHtmlList .= 'bmp.png';}
						elseif ($fileExtension == 'psd') {$fileHtmlList .= 'psd.png';}
						elseif ($fileExtension == 'avi') {$fileHtmlList .= 'avi.png';}
						elseif ($fileExtension == 'mpg') {$fileHtmlList .= 'mpg.png';}
						elseif ($fileExtension == 'mov') {$fileHtmlList .= 'mov.png';}
						elseif ($fileExtension == 'mp4') {$fileHtmlList .= 'mp4.png';}
						elseif ($fileExtension == 'wav') {$fileHtmlList .= 'wav.png';}
						elseif ($fileExtension == 'wmv') {$fileHtmlList .= 'wmv.png';}
						elseif ($fileExtension == 'xml') {$fileHtmlList .= 'xml.png';}
						elseif ($fileExtension == 'iso') {$fileHtmlList .= 'iso.png';}
						elseif ($fileExtension == 'png') {$fileHtmlList .= 'png.png';}
						elseif ($fileExtension == 'gif') {$fileHtmlList .= 'gif.png';}
						elseif ($fileExtension == 'php' or $fileExtension == 'phpx') {$fileHtmlList .= 'php.png';}
						elseif ($fileExtension == 'c')   {$fileHtmlList .= 'c.png';}	
						elseif ($fileExtension == 'sql') {$fileHtmlList .= 'sql.png';}
						elseif ($fileExtension == 'css') {$fileHtmlList .= 'css.png';}
						elseif ($fileExtension == 'py') {$fileHtmlList .= 'python.png';}
						elseif ($fileExtension == 'bat' or $fileExtension == 'cmd')   {$fileHtmlList .= 'bat.png';}
						elseif ($fileExtension == 'xls' or $fileExtension == 'xlsx')  {$fileHtmlList .= 'excel.png';}
						elseif ($fileExtension == 'exe' or $fileExtension == 'msi')   {$fileHtmlList .= 'exe.png';}
						elseif ($fileExtension == 'inf' or $fileExtension == 'info')  {$fileHtmlList .= 'inf.png';}
						elseif ($fileExtension == 'htm' or $fileExtension == 'html')  {$fileHtmlList .= 'html.png';}	
						elseif ($fileExtension == 'c++' or $fileExtension == 'cpp')   {$fileHtmlList .= 'cpp.png';}
						elseif ($fileExtension == 'py' or $fileExtension == 'cpp')   {$fileHtmlList .= 'cpp.png';}
						elseif ($fileExtension == 'jpg' or $fileExtension == 'jpeg')  {$fileHtmlList .= 'jpg.png';}
						elseif ($fileExtension == 'zip' or $fileExtension == '7-zip') {$fileHtmlList .= 'zip.png';}
						elseif ($fileExtension == 'ppt' or $fileExtension == 'pptx')  {$fileHtmlList .= 'pp.png';}
						elseif ($fileExtension == 'rar' or $fileExtension == 'tar'  or $fileExtension == 'gz' or $fileExtension == '7z') {$fileHtmlList .= 'rar.png';}
						elseif ($fileExtension == 'doc' or $fileExtension == 'docx' or $fileExtension == 'rtf'){$fileHtmlList .= 'word.png';}
						else{$fileHtmlList .= 'nie.png';}
						$fileHtmlList .= '" alt="" title="'.$entry->getFilename().'" />
					<br/><strong><a'; 
					
					if ($GLOBALS['owner'] == true){
						$fileHtmlList=$fileHtmlList.' style="text-shadow: 0px 0px 15px #337ac6;" ';
					}

					$fileHtmlList .= ' href="php/fileDownload.php?link='.$link.'&file='.$entry->getFilename().'"';
					
	
		
					

					
					if ($GLOBALS['link'] == ''){
						$localiz = $GLOBALS['link'];
					}else{
						$localiz = $GLOBALS['link'].'/';
					}
					if (schowekElementExist($localiz.$entry->getFilename())){
						$fileHtmlList .=  ' style="color:red;" ';
					}
					$fileHtmlList .=  '>'.$shortName.'</a></strong><br>';
					
				$fileHtmlList .= '</div>
				<div style="display:none; vertical-align: top;">';
				if ($fileExtension == 'c++' or $fileExtension == 'cpp' or $fileExtension == 'c' or $fileExtension == 'php' or $fileExtension == 'htm' or $fileExtension == 'html' or 
					$fileExtension == 'css' or $fileExtension == 'sql' or $fileExtension == 'xml' or $fileExtension == 'py' or $fileExtension == 'php' or $fileExtension == 'txt')
				
					$fileHtmlList .= '<span class="glyphicon glyphicon-eye-open" aria-hidden="true" 
							onmouseover="$(this).css(\'color\', \'#5cb85c\')" onmouseout="$(this).css(\'color\', \'#323232\')"
							onclick="window.open(\'php/openFile.php?link='.$link.'&file='.$entry->getFilename().'\');"
							></span><br>';
							
							
							
			if($GLOBALS['owner'])					
				$fileHtmlList .= '<span class="glyphicon glyphicon-pencil" aria-hidden="true" 
				onmouseover="$(this).css(\'color\', \'#5cb85c\')" 
				onmouseout="$(this).css(\'color\', \'#323232\')"
				onclick="_(\'renameOldName\').value=\''.$entry->getFilename().'\';$(\'#renameFileDir\').show();"
				></span><br>
					<span class="glyphicon glyphicon-remove" aria-hidden="true" onclick="removeFile(\''.$entry->getFilename().'\');" onmouseover="$(this).css(\'color\', \'#5cb85c\')" onmouseout="$(this).css(\'color\', \'#323232\')"></span><br>
					<span class="glyphicon glyphicon-move" aria-hidden="true"
					onmouseover="$(this).css(\'color\', \'#5cb85c\')" 
					onmouseout="$(this).css(\'color\', \'#323232\')"
					onclick="schowekAdd(\''.$entry->getFilename().'\',\''.$GLOBALS['link'].'\');"
					></span>';
				$fileHtmlList .= '</div>
			</div>';
			//$fileHtmlList=$fileHtmlList.'<a href="php/fileDownload.php?link='.$_GET['link'].'&file='.$entry->getFilename().'">'.$entry->getFilename().' ---roz: '.$fileExtension.'</a><br>';
		}
	}
	return $fileHtmlList;
}

	$isInfo=false;
	$query = "SELECT opis FROM folder WHERE link='".$GLOBALS['link']."'";
	$result = $mysqli->query($query);
	$row = $result->fetch_assoc();	
	if($result->num_rows > 0){
		if($row['opis'] != ''){
			$isInfo=true;
		}
	}else{
		$sql = "INSERT INTO folder (link)
		VALUES ('".$GLOBALS['link']."')";

		if ($mysqli->query($sql) === TRUE) {
			//echo "New record created successfully<br>";
		} else {
			echo "Error: " . $sql . "<br>" . $mysqli->error.'<br>';
		}
	}
	
	if($isInfo==true)
		echo '<div id="dirinfo" class="alert alert-warning" role="alert" onclick="$(this).hide();" style="margin:10px;">'.$row['opis'].'</div>';
	

	
if(!$GLOBALS['owner']){
	$query = "SELECT haslo FROM folder WHERE link='".$GLOBALS['link']."'";
	$result = $mysqli->query($query);
	$row = $result->fetch_assoc();	
		
	if($row['haslo'] == ''){
		$CAN_SHOW_FILES = true;
	}else{
		if(isset($_COOKIE[$GLOBALS['link']])){
			if ($row['haslo'] == $_COOKIE[$GLOBALS['link']]){
				$CAN_SHOW_FILES = true;
			}else{
				$CAN_SHOW_FILES = false;
			}
		}else{
			$CAN_SHOW_FILES = false;
		}	
	}
}else{
	$CAN_SHOW_FILES = true;
}
	
	
	
if($CAN_SHOW_FILES){
	echo foldery();
	echo pliki();
}else{
	echo '<div class="form-inline" style="width:100%; text-align:center; padding:5%;">
				<div class="form-group has-success">
					<input type="password" class="form-control" id="dirpass" name="dirpass" placeholder="hasło">
				</div><br>
				<button type="submit" class="btn btn-success"  style="width:20%; margin-top:2%;" onclick="dirpass(\''.$GLOBALS['link'].'\');">Potwierdź</button>
			</div>';
}

















?>