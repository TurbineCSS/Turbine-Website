<?php include('header.php'); ?>


<div id="shell">


<h2>Turbine sandbox</h2>


<?php
	include('turbine/lib/browser/browser.php');
	include('turbine/lib/base.php');
	$browser = new Browser();
	$browser->parse();
?>

<div class="shellcell1">
	<h3>Paste Turbine code here</h3>
	<textarea id="cssp">#foo
    color:red</textarea>
</div>
<div class="shellcell2">
	<h3>Paste HTML code here</h3>
	<textarea id="html"><p id="foo">
    Lorem Ipsum
</p></textarea>
</div>
<div class="shellcell1">
	<h3>Resulting CSS</h3>
	<textarea id="css"></textarea>
</div>
<div class="shellcell2">
	<h3>Resulting CSS + HTML</h3>
	<iframe id="result" src="lib/shell/display.html"></iframe>
</div>
<h3>Choose your browser</h3>
<p id="browservars">
	<label>Browser: <input value="<?php echo $browser->browser ?>" id="browser" name="browser" type="text"></label>
	<label>Version: <input value="<?php echo $browser->browser_version ?>" id="browser_version" name="browser_version" class="version" type="text"></label>
	<br><br>
	<label>Engine: <input value="<?php echo $browser->engine ?>" id="engine" name="engine" type="text"></label>
	<label>Version: <input value="<?php echo $browser->engine_version ?>" id="engine_version" name="engine_version" class="version" type="text"></label>
	<br><br>
	<label>Platform: <input value="<?php echo $browser->platform ?>" id="platform" name="platform" type="text"></label>
	<label>Version: <input value="<?php echo $browser->platform_version ?>" id="platform_version" name="platform_version" class="version" type="text"></label>
	<label>Type: <input value="<?php echo $browser->platform_type ?>" id="platform_type" name="platform_type" class="type" type="text"></label>
</p>
<p>
	<label><input type="checkbox" id="interactive">Interactive mode</label>
	<button id="go">Go!</button>
</p>


</div>


<?php include('footer.php'); ?>
