<?php
	include 'config.php';
	include 'geshi/geshi.php';
	
	$filePath = $GLOBALS['current_dir'];
	$fileName = $_GET['file'];
	$path = $filePath.'/'.$fileName;

	$language = substr($fileName, strrpos($fileName, '.')+1);
	//echo $language;
	$fileContent = file_get_contents($path);
	
	switch ($language) {
    case 'html':
        $language = 'html5';
        break;
    case 'cs':
        $language = 'csharp';
        break;
}
	
	echo '<pre>';
	
		$geshii = new GeSHi($fileContent, $language);
		echo $geshii->parse_code();
	
		//echo htmlspecialchars($fileContent);
	echo '</pre>';
?>