<?php include('header.php'); ?>


<div id="download">


<h2>Download Turbine</h2>
<p>
	The current Turbine version is <b>1.1.0</b>:
</p>
<ul class="downloads">
<?php
if($handle = opendir('files')) {
	while (false !== ($file = readdir($handle))) {
		if($file != '.' && $file != '..') {
			echo '<li><a href="/files/' . $file . '">' . $file . '</a> (' . round(filesize('files/' . $file) / 1024, 2) . ' kb)</li>';
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
	If you're looking for an older version of Turbine, check out the <a href="http://github.com/SirPepe/Turbine/archives/master">Github download archive</a>.
</p>


</div>


<?php include('footer.php'); ?>
