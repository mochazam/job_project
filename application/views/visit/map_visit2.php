<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Map</title>
	<?php echo isset($map['js']) ? $map['js'] : '';?>

	<style>
		.btn-back {
			margin: 20px;
		}
	</style>	
</head>
<body>

<?php echo isset($map['html']) ? $map['html'] : '';?>

<div class="btn-back">
	<input class="btn" action="action" onclick="window.history.go(-1); return false;" type="button" value="Back" />
</div>
</body>
</html>