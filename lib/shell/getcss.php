<?php

/**
 * Turbine
 * http://turbine.peterkroener.de/
 * 
 * Copyright (C) 2009 Peter Kröner, Christian Schaefer
 * 
 * This library is free software; you can redistribute it and/or
 * modify it under the terms of the GNU Library General Public
 * License as published by the Free Software Foundation; either
 * version 3 of the License, or (at your option) any later version.
 *
 * This library is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU
 * Library General Public License for more details.
 * 
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */


// Constants
define('TURBINEVERSION', 0.01);
define('TURBINEPATH', dirname($_SERVER['SCRIPT_NAME']));


// Load libraries
include('../../turbine/lib/base.php');
include('../../turbine/lib/browser.php');
include('../../turbine/lib/parser.php');
include('../../turbine/lib/cssp.php');
include('../../turbine/lib/cssmin.php');


// Create the Turbine instance
$cssp = new CSSP();


// Set debugging level
$cssp->config['debug_level'] = 0;


// Get and store browser properties
$browser = new Browser();
$browser->parse();


// Set global path constant SCRIPTPATH for use in the special constant $_SCRIPTPATH
$cssp->global_constants['SCRIPTPATH'] = TURBINEPATH;


// Plugin loading state
$plugins_loaded = false;


// Precess input
if($_POST['css']){

	// Set browser properties
	$browser->browser = $_POST['browser'];
	$browser->browser_version = $_POST['browser_version'];
	$browser->engine = $_POST['engine'];
	$browser->engine_version = $_POST['engine_version'];
	$browser->platform = $_POST['platform'];
	$browser->platform_version = $_POST['platform_version'];
	$browser->platform_type = $_POST['platform_type'];


	// Load plugins (if not already loaded)
	if(!$plugins_loaded){
		$plugindir = '../../turbine/plugins';
		if($handle = opendir($plugindir)){
			while(false !== ($pluginfile = readdir($handle))){
				if($pluginfile != '.' && $pluginfile != '..' && is_file($plugindir.'/'.$pluginfile) && pathinfo($plugindir.'/'.$pluginfile,PATHINFO_EXTENSION) == 'php' && !function_exists(substr($pluginfile, 0, -4))){
					include($plugindir.'/'.$pluginfile);
				}
			}
			closedir($handle);
		}
		$plugins_loaded = true;
	}


	// Load string
	$source = stripslashes($_POST['css']);
	$cssp->load_string($source, true);


	// Set global filepath constant for the current file
	$filepath = dirname($file);
	if($filepath != '.'){
		$cssp->global_constants['FILEPATH'] = $filepath;
	}
	else{
		$cssp->global_constants['FILEPATH'] = '';
	}


	// Get plugin settings for the before parse hook
	$plugin_list = array();
	$found = false;
	foreach($cssp->code as $line){
		if(!$found){
			if(preg_match('/^[\s\t]*@turbine/i',$line) == 1){
				$found = true;
			}
		}
		else{
			preg_match('~^\s+plugins:(.*?)(?://|$)~', $line, $matches);
			if(count($matches) == 2){
				$plugin_list = $cssp->tokenize($matches[1], ',');
				break;
			}
		}
	}


	$cssp->set_indention_char();                                         // Set the character(s) used for code indention
	$cssp->apply_plugins('before_parse', $plugin_list, $cssp->code);     // Apply plugins for before parse
	$cssp->parse();                                                      // Parse the code
	$cssp->apply_plugins('before_compile', $plugin_list, $cssp->parsed); // Apply plugins for before compile
	$cssp->compile();                                                    // Do the Turbine magic
	$cssp->apply_plugins('before_glue', $plugin_list, $cssp->parsed);    // Apply plugins for before glue


	// Set compression mode
	if(isset($cssp->parsed['global']['@turbine']['compress'][0])){
		$compress = (bool) $cssp->parsed['global']['@turbine']['compress'][0];
	}
	else{
		$compress = false;
	}


	unset($cssp->parsed['global']['@turbine']);                      // Remove configuration @-rule
	$output = $cssp->glue($compress);                             // Glue css output
	$cssp->apply_plugins('before_output', $plugin_list, $output); // Apply plugins for before output


	// Show errors
	if($cssp->config['debug_level'] > 0 && !empty($cssp->errors)){
		$error_message = implode('\\00000A', $cssp->errors);
		$css = $css.'body:before { content:"'.$error_message.'" !important; font-family:Verdana, Arial, sans-serif !important;
			font-weight:bold !important; color:#000 !important; background:#F4EA9F !important; display:block !important;
			border-bottom:1px solid #D5CA6E; padding:8px !important; white-space:pre; }';
	}


	// Output
	echo stripslashes($output);

}


?>
