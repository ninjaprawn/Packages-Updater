<?php
	
	// PHP INFO ARRAY (From PHP Docs Comments)
	
	ob_start();
	phpinfo();
	$phpinfo = array('phpinfo' => array());
	if(preg_match_all('#(?:<h2>(?:<a name=".*?">)?(.*?)(?:</a>)?</h2>)|(?:<tr(?: class=".*?")?><t[hd](?: class=".*?")?>(.*?)\s*</t[hd]>(?:<t[hd](?: class=".*?")?>(.*?)\s*</t[hd]>(?:<t[hd](?: class=".*?")?>(.*?)\s*</t[hd]>)?)?</tr>)#s', ob_get_clean(), $matches, PREG_SET_ORDER))
	    foreach($matches as $match)
	        if(strlen($match[1]))
	            $phpinfo[$match[1]] = array();
	        elseif(isset($match[3]))
	            $phpinfo[end(array_keys($phpinfo))][$match[2]] = isset($match[4]) ? array($match[3], $match[4]) : $match[3];
	        else
	            $phpinfo[end(array_keys($phpinfo))][] = $match[2];
	            
	// GZ Function (From SO)

	function gz ($in, $out) {
		$fp = gzopen ($out, 'w9');
		
		gzwrite ($fp, file_get_contents($in));
		
		gzclose($fp);
	}
	
	// BZIP2 Function (From PHP docs)
	
	function bzip2 ($in, $out) 
	{ 
	    if (!file_exists ($in) || !is_readable ($in)) 
	        return false; 
	    if ((!file_exists ($out) && !is_writeable (dirname ($out)) || (file_exists($out) && !is_writable($out)) )) 
	        return false; 
	    
	    $in_file = fopen ($in, "rb"); 
	    $out_file = bzopen ($out, "wb"); 
	    
	    while (!feof ($in_file)) { 
	        $buffer = fgets ($in_file, 4096); 
	         bzwrite ($out_file, $buffer, 4096); 
	    } 
	
	    fclose ($in_file); 
	    bzclose ($out_file); 
	    
	    return true; 
	}
	
	//My Stuff
	
	$packagesFile = "Packages"
	$packagesGZFile = "Packages.gz"
	$packagesBZFile = "Packages.bz2"
	
	if (file_exists($packagesGZFile)) {
		unlink($packagesGZFile);
	}
	
	if (file_exists($packagesBZFile)) {
		unlink($packagesBZFile);
	}
	
	if (substr($phpinfo['Phar']['bzip2 compression'],0,8) == "disabled") {
		gz($packagesFile, $packagesGZFile);
		if (file_exists($packagesGZFile)) {
			print("All good");
		} else {
			print("Something bad happened");
		}
	} else {
		bzip2($packagesFile, $packagesBZFile);
		if (file_exists($packagesBZFile)) {
			print("All good");
		} else {
			print("Something bad happened");
		}
	}
?>
