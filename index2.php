<?php
define('SCRIPT', './mozilla-version2.php');
?>
<!DOCTYPE html>
<html>

<head>
	<meta http-equiv="content-type" content="text/html; charset=UTF-8">
	<meta charset="UTF-8">
	<title>Mozilla versions</title>
</head>

<body>

<h2>Form</h2>

<form method="GET" action="<?php echo SCRIPT; ?>">
	<label for="product">Product:</label>
	<select name="product" id="product">
		<option value="firefox">Firefox</option>
		<option value="mobile">Firefox for Android</option>
		<option value="thunderbird">Thunderbird</option>
		<option value="seamonkey">SeaMonkey</option>
	</select>
	<br>
	<label for="channel">Channel:</label>
	<select name="channel" id="channel">
		<option value="release">Release</option>
	</select>
	<br>
	<input type="submit" value="Show latest version">
</form>

<h2>Script code <?php echo SCRIPT; ?></h2>

<pre>
<?php echo htmlspecialchars(file_get_contents(SCRIPT)); ?>
</pre>

</body>
</html>
