<?php include('header.php'); ?>


<div id="converter">


<h2>CSS to Turbine converter</h2>

<?php
	require('lib/converter/parser.php');
	require('lib/converter/converter.php');
?>

<form action="converter" method="post">
<div class="cell" id="converterIn">
	<h2>CSS</h2>
	<textarea cols="120" rows="20" name="css"><?php if(isset($_POST['css'])){echo stripslashes($_POST['css']);}?></textarea>
</div>
<div class="cell" id="converterout">
	<h2>Turbine</h2>
	<textarea cols="120" rows="20" name="cssp"><?php if(isset($_POST['css'])){ CsspConverter::factory($_POST['ichar'], $_POST['icount'], (isset($_POST['colonspace'])) ? true : false)->load_string(stripslashes($_POST['css']))->parse()->convert(); } ?></textarea>
</div>

<p>

	<label for="ichar">Indention char</label>
	<select id="ichar" name="ichar">
		<option value="tab"<?php if(!isset($_POST) || (isset($_POST['ichar']) && $_POST['ichar'] != 'space')){ echo ' selected'; } ?>>Tabs</option>
		<option value="space"<?php if(isset($_POST['ichar']) && $_POST['ichar'] == 'space'){ echo ' selected'; } ?>>Spaces</option>
	</select>

	<label for="icount">Idention level</label>
	<input type="text" name="icount" id="icount" value="<?php if(isset($_POST['icount'])){ echo $_POST['icount']; } else { echo '1'; } ?>">

	<label>
		<input type="checkbox" name="colonspace" value="1" id="colonspace" <?php if(isset($_POST['colonspace']) && $_POST['colonspace'] == '1'){ echo 'checked'; } ?>>
		Space after property colon?
	</label>

	<input type="submit" value="Convert!" id="convert">

</p>

</form>

</div>

<?php include('footer.php'); ?>