<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html>

	<head>
	<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
	<link href="css/style.css" rel="stylesheet" type="text/css" media="all" />
	<link href='http://fonts.googleapis.com/css?family=Averia+Gruesa+Libre' rel='stylesheet' type='text/css'>
	<link href="http://fonts.googleapis.com/css?family=Droid+Serif:regular,italic,bold,bolditalic&v1" rel="stylesheet" type="text/css">
	<link href='http://fonts.googleapis.com/css?family=Crete+Round' rel='stylesheet' type='text/css'>
	<link rel="shortcut icon" href="favicon.ico" />

	<script src="js/jquery-1.7.2.min.js"></script>
	<script src="js/lightbox.js"></script>
	<link href="css/lightbox.css" rel="stylesheet" />

	<title>Pygmyfoto</title>
	</head>
	
	<body>
	
	<div id="content">
	<h1>P * y * g * m * y * f * o * t * o</h1>

	<script type="text/javascript">
	$(function() {
		$('a[@rel*=lightbox]').lightBox();
	});
	</script>

<?php

$id = $_GET['id'];

$db = new PDO('sqlite:pygmyfoto.sqlite');

print "<center><a href='index.php'>Home</a> &#10034; <a href='archive.php'>Archive</a> &#10034; <a href='https://github.com/dmpop/pygmyfoto'>Pygmyfoto</a></center>";

print "<table border=0>";
$result = $db->query("SELECT id, description, tags, exif, osm, count FROM photos WHERE id='$id'");
foreach($result as $row)
{
print "<tr><td>".$row['description']."</td></tr>";
print "<tr><td valign='top'><p class='box'><img src='images/tag.png' alt='Tags'><em> ".$row['tags']."</em> <a href='".$row['osm']."'><img src='images/world.png' alt='OpenStreetMap'></a> <strong>Views:</strong><em> ".$row['count']."</p></td></tr>";
print "<tr><td><p class='box'>".$row['exif']."</p></td></tr>";
}
print "</table>";

$db->query("UPDATE photos SET count = count + 1 WHERE id='$id'");

$db = NULL;

print "<p><center><form method='post' action='search.php'><input type='text' name='tag' size='11' value='Search by tag'> <input type='submit' value='&#10148;'></form></center></p>"

?>
	<div class="footer">Powered by Pygmyfoto</div>
	</div>
	</body>
</html>