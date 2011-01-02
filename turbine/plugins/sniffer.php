<?php

/**
 * This file is part of Turbine
 * http://github.com/SirPepe/Turbine
 * 
 * Copyright Peter Kröner
 * Licensed under GNU LGPL 3, see license.txt or http://www.gnu.org/licenses/
 */


/**
 * Sniffer (2nd edition)
 * The new and improved browser and platform sniffer
 * 
 * This file only builds a list of targets to eliminate. The real work is
 * done in sniffer_exec.php.
 * 
 * Usage: Complicated, see docs
 * Example: -
 * Status:  Probably unstable as hell
 * Version: ?
 */


/*
 * @var array $sniffer_tokill The kill list
 */
$sniffer_tokill = array();


/*
 * @var array $sniffer_current Bookkeeping
 */
$sniffer_current = array(
	'block' => 'global',
	'selector' => null,
	'fi' => -1, // Font face index
	'content' => array(),
	'kill' => 0
);


/*
 * @var array $sniffer_current_property Bookkeeping
 */
$sniffer_current_property = '';


/**
 * sniffer
 * Main plugin function
 * @param string $type Line type
 * @param string $type Line content
 * @return void
 */
function sniffer($type, &$content){
	global $sniffer_current, $sniffer_current_property, $sniffer_tokill;

	// Selectors @media lines and EOF end the previous kill list collection procedure
	if($type == 'selector' || $type == '@media' || $type == 'EOF'){
		// If the kill flag is true, copy the $current data to the kill list
		if($sniffer_current['kill']){
			if($sniffer_current['selector'] == '@font-face'){
				$sniffer_tokill[$sniffer_current['block']][$sniffer_current['selector']][$sniffer_current['fi']] = $sniffer_current['content'];
			}
			else{
				$sniffer_tokill[$sniffer_current['block']][$sniffer_current['selector']] = $sniffer_current['content'];
			}
		}
		// Reset the current list
		$sniffer_current = array(
			'block' => $sniffer_current['block'],
			'selector' => null,
			'fi' => $sniffer_current['fi'],
			'content' => array(),
			'kill' => 0
		);
	}

	// Log the parsing operation, copy relevant data to $sniffer_current
	switch($type){

		// Save the property
		case 'property':
			$sniffer_current_property = $content;
			$sniffer_current['content'][$sniffer_current_property] = array();
		break;

		// Intercept browser, engine and os and device properties
		case 'value':
			if($sniffer_current_property == 'browser'){
				$sniffer_current['kill'] = !sniffer_parse_browser($content);
			}
			elseif($sniffer_current_property == 'engine'){
				$sniffer_current['kill'] = !sniffer_parse_engine($content);
			}
			elseif($sniffer_current_property == 'os'){
				$sniffer_current['kill'] = !sniffer_parse_os($content);
			}
			elseif($sniffer_current_property == 'device'){
				$sniffer_current['kill'] = !sniffer_parse_device($content);
			}
			$sniffer_current['content'][$sniffer_current_property][] = $content;
		break;

		// Switch the block we are in
		case '@media':
			$sniffer_current['block'] = (trim(substr($content, 6)) != 'none') ? $content : 'global';
		break;

		// Switch the selector we are in
		case 'selector':
			$sniffer_current['selector'] = $content;
			if($sniffer_current['selector'] == '@font-face'){
				$sniffer_current['fi']++;
			}
		break;

	} // end switch
}


/**
 * sniffer2_exec
 * Loops through $sniffer_tokill and eliminates the targets from $parsed
 * @param mixed &$parsed
 * @return void
 */
function sniffer_exec(&$parsed){
	global $sniffer_tokill;
	// Look for a kill rule in @turbine
	if(isset($sniffer_tokill['global']['@turbine'])){
		// Empty $parsed
		$parsed = array('global' => array());
		return;
	}
	// Loop through the kill list
	foreach($sniffer_tokill as $block => $css){
		foreach($sniffer_tokill[$block] as $selector => $rules){
			// Loop through @font-face
			if($selector == '@font-face'){
				foreach($sniffer_tokill[$block][$selector] as $fontindex => $styles){
					foreach($sniffer_tokill[$block][$selector][$fontindex] as $property => $values){
						foreach($values as $value){
							$search = array_search($value, $parsed[$block][$selector][$fontindex][$property]);
							if($search !== false){
								unset($parsed[$block][$selector][$fontindex][$property][$search]);
							}
						}
					}
				}
			}
			// Process the rest
			else{
				foreach($rules as $property => $values){
					foreach($values as $value){
						$search = array_search($value, $parsed[$block][$selector][$property]);
						if($search !== false){
							unset($parsed[$block][$selector][$property][$search]);
						}
					}
				}
			}
		}
	}
	// Cleanup
	call_user_func_array('sniffer_exec_cleanup', array(&$parsed));
}





/**
 * sniffer_exec_cleanup
 * Removes any remaining sniffer properties as well as empty properties
 * @param array $parsed The parse tree to clean up
 * @return void
 */
function sniffer_exec_cleanup(&$parsed){
	$sniffer_properties = array('browser', 'engine', 'device', 'os');
	foreach($parsed as $block => $css){
		foreach($parsed[$block] as $selector => $rules){
			if($selector == '@font-face'){
				foreach($parsed[$block][$selector] as $fontindex => $styles){
					foreach($parsed[$block][$selector][$fontindex] as $property => $values){
						if(in_array($property, $sniffer_properties) || empty($parsed[$block][$selector][$fontindex][$property])){
							unset($parsed[$block][$selector][$fontindex][$property]);
						}
					}
				}
			}
			else{
				foreach($parsed[$block][$selector] as $property => $values){
					if(in_array($property, $sniffer_properties) || empty($parsed[$block][$selector][$property])){
						unset($parsed[$block][$selector][$property]);
					}
				}
			}
		}
	}
}


/**
 * sniffer_parse_browser
 * Parses browser rule
 * @param array $rule
 * @return bool $match
 */
function sniffer_parse_browser($rule){
	global $browser;
	$match = false;
	preg_match('/([\^]?)([a-z\-_0-9]+)([!=><]{0,2})([0-9]*\.?[0-9]*]*)/i', $rule, $matches);
	// If the useragent's detected browser is found in the current rule
	if(strstr(strtolower($matches[2]), $browser->browser)){
		// For the time being set $submatch to true
		$submatch = true;
		// If we found a logical operator and a version number
		if($matches[3] != '' && $matches[4] == floatval($matches[4])){
			// Turn a single =-operator into a PHP-interpretable ==-operator
			if($matches[3] == '='){
				$matches[3] = '==';
			}
			// Filter and run the detected rule through the PHP interpreter
			eval('if('.floatval($browser->browser_version).$matches[3].floatval($matches[4]).') $submatch = true; else $submatch = false;');
		}
	}
	else{
		// Set $submatch to false
		$submatch = false;
	}
	// Check if we had a negating operator at the beginning and in case flip result
	if($matches[1] == '^'){
		$submatch = ($submatch == true) ? false : true;
	}
	// Check the final state of $submatch and set $match only to true if $submatch is true
	if($submatch){
		$match = true;
	}
	return $match;
}


/**
 * sniffer_parse_engine
 * Parses engine rule
 * @param array $rule
 * @return bool $match
 */
function sniffer_parse_engine($rule){
	global $browser;
	$match = false;
	preg_match('/([\^]?)([a-z\-_0-9]+)([!=><]{0,2})([0-9]*\.?[0-9]*]*)/i', $rule, $matches);
	// If the useragent's detected engine is found in the current rule
	if(strstr(strtolower($matches[2]), $browser->engine)){
		// For the time being set $submatch to true
		$submatch = true;
		// If we found a logical operator and a version number
		if($matches[3] != '' && $matches[4] == floatval($matches[4])){
			// Turn a single =-operator into a PHP-interpretable ==-operator
			if($matches[3] == '='){
				$matches[3] = '==';
			}
			// Filter and run the detected rule through the PHP interpreter
			eval('if('.floatval($browser->engine_version).$matches[3].floatval($matches[4]).') $submatch = true; else $submatch = false;');
		}
	}
	else{
		// Set $submatch to false
		$submatch = false;
	}
	// Check if we had a negating operator at the beginning and in case flip result
	if($matches[1] == '^'){
		$submatch = ($submatch == true) ? false : true;
	}
	// Check the final state of $submatch and set $match only to true if $submatch is true
	if($submatch){
		$match = true;
	}
	return $match;
}


/**
 * sniffer_parse_device
 * Parses device rule
 * @param array $rule
 * @return bool $match
 */
function sniffer_parse_device($rule){
	global $browser;
	$match = false;
	if(preg_match('/'.$browser->platform_type.'/', strtolower($rule))){
		$submatch = true;
	}
	else{
		$submatch = false;
	}
	// Check if we had a negating operator at the beginning and in case flip result
	if($rule{0} == '^'){
		$submatch = ($submatch) ? false : true;
	}
	// Check the final state of $submatch and set $match only to true if $submatch is true
	if($submatch){
		$match = true;
	}
	return $match;
}


/**
 * sniffer_parse_os
 * Parses os rule
 * @param array $rule
 * @return bool $match
 */
function sniffer_parse_os($rule){
	global $browser;
	$match = false;
	// Prepare special array for Windows name to version mapping
	$os_windowsnames = array();
	$os_windowsnames['95'] = 4.0;
	$os_windowsnames['nt4'] = 4.0;
	$os_windowsnames['98'] = 4.1;
	$os_windowsnames['me'] = 4.9;
	$os_windowsnames['2000'] = $os_windowsnames['2k'] = 5.0;
	$os_windowsnames['xp'] = 5.1;
	$os_windowsnames['2003'] = $os_windowsnames['2k3'] = 5.2;
	$os_windowsnames['vista'] = 6.0;
	$os_windowsnames['windows7'] = $os_windowsnames['win7'] = $os_windowsnames['7'] = 6.1;
	preg_match('/([\^]?)([a-z\-_0-9]+)([!=><]{0,2})([a-z0-9]*\.?[0-9]*]*)/i', $rule, $matches);
	// If the useragent's detected os/platform is found in the current rule
	if(strstr(strtolower($matches[2]), $browser->platform)){
		// For the time being set $submatch to true
		$submatch = true;
		// If we found a logical operator and a version number
		if($matches[3] != '' && (isset($os_windowsnames[$matches[4]]) || $matches[4] == floatval($matches[4]))){
			// Turn a single =-operator into a PHP-interpretable ==-operator
			if($matches[3] == '='){
				$matches[3] = '==';
			}
			// Check for Windows name mapping and apply
			if(isset($os_windowsnames[$matches[4]])){
				$matches[4] = $os_windowsnames[$matches[4]];
			}
			// Filter and run the detected rule through the PHP interpreter
			eval('if('.floatval($browser->platform_version).$matches[3].floatval($matches[4]).') $submatch = true; else $submatch = false;');
		}
	}
	else{
		// Set $submatch to false
		$submatch = false;
	}
	// Check if we had a negating operator at the beginning and in case flip result
	if($matches[1] == '^'){
		$submatch = ($submatch == true) ? false : true;
	}
	// Check the final state of $submatch and set $match only to true if $submatch is true
	if($submatch){
		$match = true;
	}
	return $match;
}



// Register the plugin functions
$cssp->register_plugin('sniffer', array(
	array('sniffer', 'while_parsing', 9999),
	array('sniffer_exec', 'before_compile', 9999)
));



?>
