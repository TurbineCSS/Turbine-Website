<?php include('header.php'); ?>


<div id="shell">


<h2>CSS to Turbine converter</h2>


<?php
	//include('../../lib/base.php');
	//include('../../lib/browser.php');
	//$browser = new Browser();
?>

<div class="shellcell fl">
	<h2>Paste Turbine code here</h2>
	<textarea id="cssp">#foo
    color:red</textarea>
</div>
<div class="shellcell fr">
	<h2>Paste HTML code here</h2>
	<textarea id="html"><p id="foo">
    Lorem Ipsum
</p></textarea>
</div>
<div class="shellcell fl">
	<h2>Resulting CSS</h2>
	<textarea id="css"></textarea>
</div>
<div class="shellcell fr">
	<h2>Resulting CSS + HTML</h2>
	<iframe id="result" src="display.html"></iframe>
</div>
<p id="browservars">
	<label>Browser: <input value="<?php echo $browser->name ?>" id="browser" name="browser" type="text"></label>
	<label>Version: <input value="<?php echo $browser->version ?>" id="browserversion" name="browserversion" class="version" type="text"></label>
	<label>Family: <input value="<?php echo $browser->family ?>" id="family" name="family" type="text"></label>
	<label>Version: <input value="<?php echo $browser->familyversion ?>" id="familyversion" name="familyversion" class="version" type="text"></label>
	<label>Engine: <input value="<?php echo $browser->engine ?>" id="engine" name="engine" type="text"></label>
	<label>Version: <input value="<?php echo $browser->engineversion ?>" id="engineversion" name="engineversion" class="version" type="text"></label>
	<label>Platform: <input value="<?php echo $browser->platform ?>" id="platform" name="platform" type="text"></label>
	<label>Version: <input value="<?php echo $browser->platformversion ?>" id="platformversion" name="platformversion" class="version" type="text"></label>
	<label>Type: <input value="<?php echo $browser->platformtype ?>" id="platformtype" name="platformtype" class="type" type="text"></label>
</p>
<p>
	<label><input type="checkbox" id="interactive">Interactive mode</label>
	<button id="go">Go!</button>
</p>


</div>


<?php include('footer.php'); ?>