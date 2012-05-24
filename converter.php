<?php
	include('header.php');
	include('lib/converter/parser.php');
	include('lib/converter/converter.php');
?>


<div id="converter">


<h2>CSS to Turbine converter</h2>


<form action="converter.php" method="post">

<h3>Enter CSS code below</h3>
<textarea cols="120" rows="20" name="css"><?php if(isset($_POST['css'])){echo stripslashes($_POST['css']);}?></textarea>
<p>

	<label for="ichar">Indention chars</label>
	<select id="ichar" name="ichar">
		<option value="tab"<?php if(!isset($_POST) || (isset($_POST['ichar']) && $_POST['ichar'] != 'space')){ echo ' selected'; } ?>>Tabs</option>
		<option value="space"<?php if(isset($_POST['ichar']) && $_POST['ichar'] == 'space'){ echo ' selected'; } ?>>Spaces</option>
	</select>

	<label for="icount">Indentation level</label>
	<input type="text" name="icount" id="icount" value="<?php if(isset($_POST['icount'])){ echo $_POST['icount']; } else { echo '1'; } ?>">

	<label>
		<input type="checkbox" name="colonspace" value="1" id="colonspace" <?php if(isset($_POST['colonspace']) && $_POST['colonspace'] == '1'){ echo 'checked'; } ?>>
		Space after property colon?
	</label>
	<input type="submit" value="Convert!" id="convert">
</p>

<?php
	if(isset($_POST['css']) && !empty($_POST['css'])){
		echo '<h3>Result</h3><pre>';
		CsspConverter::factory($_POST['ichar'], $_POST['icount'], (isset($_POST['colonspace'])) ? true : false)->load_string(stripslashes($_POST['css']))->parse()->convert();
		echo '</pre>';
	}
?>

</form>

</div>

<?php include('footer.php'); ?>
