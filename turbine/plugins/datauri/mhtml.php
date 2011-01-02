<?php

/**
 * This file is part of Turbine
 * http://github.com/SirPepe/Turbine
 * 
 * Copyright Peter Kröner
 * Licensed under GNU LGPL 3, see license.txt or http://www.gnu.org/licenses/
 */


if(isset($_GET['cache'])){
	$mhtmlfile = '../../cache/'.preg_replace('/[^a-z0-9]/i','',preg_replace('/\!img[a-z0-9]+$/i','',$_GET['cache'])).'_mhtml.txt';
	$etag = md5($mhtmlfile.filemtime($mhtmlfile));
	if(@$_SERVER['HTTP_IF_NONE_MATCH'] === $etag){
		header('HTTP/1.1 304 Not Modified');
		exit();
	}
	header("Cache-Control: max-age=2592000, public");
	header("Expires: ".gmdate('D, d M Y H:i:s', mktime(date('h') + (24 * 35)))." GMT");
	header("Vary: Accept-Encoding"); 
	header("Content-type: text/plain"); 
	header("ETag: ".$etag);
	echo file_get_contents($mhtmlfile);
}


?>
