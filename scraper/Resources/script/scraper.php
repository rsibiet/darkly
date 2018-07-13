<?php

include "simple_html_dom.php";

function loop($url) {
	$invalidReadme = array(
		0 => "Demande à ton voisin de gauche   ",
		1 => "Demande à ton voisin de droite   ",
		2 => "Demande à ton voisin du dessus   ",
		3 => "Demande à ton voisin du dessous  ",
		4 => "Toujours pas tu vas craquer non ? ",
		5 => "Non ce n'est toujours pas bon ... ",
		6 => "Tu veux de l'aide ? Moi aussi !   "
	);

	$rootDirectory = file_get_html($url . $element->href);
	foreach($rootDirectory->find('a') as $element) {
		if (strpos($element, "../") == False) {
			if (strpos($element, "README") != False) {
				$readme = file_get_html($url . $element->href);
				$isInvalid = False;
				foreach ($invalidReadme as $value) {
					if (strcmp($value, $readme) == 0) {
						$isInvalid = True;
						break ;
					}
				}
				if ($isInvalid == False) {
					echo $url . "\nFLAG: " . $readme . "\n";
					exit;
				}
				echo $url . ": NO :(\n";
			}
			loop($url . $element->href);
		}
	}
}
loop("http://192.168.101.129/.hidden/");

?>
