<?php include('header.php'); ?>


<div id="download">


<h2>Download Turbine</h2>
<h3>Stable</h3>
<p>
	The current stable Turbine version is <b>1.0.11</b>:
</p>
<ul class="downloads">
<?php
if($handle = opendir('files/stable')){
	while (false !== ($file = readdir($handle))){
		if($file != '.' && $file != '..'){
			echo '<li><a href="/files/stable/' . $file . '">' . $file . '</a> (' . round(filesize('files/stable/' . $file) / 1024, 2) . ' kb)</li>';
		}
	}
	closedir($handle);
}
?>
</ul>
<h3>Beta</h3>
<p>
	The current beta release is <b>1.1.0beta1</b>:
</p>
<ul class="downloads">
<?php
if($handle = opendir('files/beta')){
	while (false !== ($file = readdir($handle))){
		if($file != '.' && $file != '..'){
			echo '<li><a href="/files/beta/' . $file . '">' . $file . '</a> (' . round(filesize('files/beta/' . $file) / 1024, 2) . ' kb)</li>';
		}
	}
	closedir($handle);
}
?>
</ul>
<h3>Installation</h3>
<p>
	Simply download one of the files from above and unpack it to a directory on your web server. There are no requirements beside PHP 5.2. See
	<a href="docs.php">the docs</a> for more information on setup and usage.
</p>

<h3>Older versions</h3>
<p>
	If you're looking for an older version of Turbine, check out the <a href="http://github.com/igorsantos07/Turbine/archives/master">Github download archive</a>.
</p>


</div>


<?php include('footer.php'); ?>
