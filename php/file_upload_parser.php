<?php
include 'config.php';
$files=array();
$fdata=$_FILES['upload'];
if(is_array($fdata['name'])){
	for($i=0;$i<count($fdata['name']);++$i){
		$files[]=array(
			'name'    =>$fdata['name'][$i],
			'type'  => $fdata['type'][$i],
			'tmp_name'=>$fdata['tmp_name'][$i],
			'error' => $fdata['error'][$i], 
			'size'  => $fdata['size'][$i]  );
    }
}else 
	$files[]=$fdata;
//echo '<div class="alert alert-info" onclick="$(this).hide();" role="alert" style="margin:10px;">';

foreach ($files as $file) {
	$path = $GLOBALS['current_dir'].'/'.$file['name'];
	
	while(file_exists($path)){
		$pos = strrpos($path, ".");
		if ($pos === false) {
			$path.='(n)';
		}else{
			$path = substr($path, 0, $pos).'(n)'.substr($path, $pos);
		}
	}
	if(move_uploaded_file($file['tmp_name'], $path)){
		echo $file['name']." został wrzucony<br>";
	} else {
		echo "move_uploaded_file function failed";
	}
}

//echo $GLOBALS['current_dir'].'/'.$file['name'];
//echo '</div>';
?>