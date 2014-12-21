<?php

	function gz ($in, $out) {
		$fp = gzopen ($out, 'w9');
		
		gzwrite ($fp, file_get_contents($in));
		
		gzclose($fp);
	}
	
	$packagesFile = "Packages"
	$packagesGZFile = "Packages.gz"
	
	if (file_exists($packagesGZFile)) {
		unlink($packagesGZFile);
	}
	
	gz($packagesFile, $packagesGZFile);
	
	if (file_exists($packagesGZFile)) {
		print("All good");
	} else {
		print("Something bad happened");
	}
?>
