<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<!-- http://lokeshdhakar.com/projects/lightbox2/ -->

<html>

	<head>
	<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
	<link href="css/style.css" rel="stylesheet" type="text/css" media="all" />
	<link href='http://fonts.googleapis.com/css?family=Asap:400,700,400italic,700italic' rel='stylesheet' type='text/css'>
	<link rel="shortcut icon" href="favicon.ico" />

	<script src="js/jquery-1.7.2.min.js"></script>
	<script src="js/lightbox.js"></script>
	<link href="css/lightbox.css" rel="stylesheet" />

	<title>Pygmyfoto</title>
	</head>
	
	<body>

	<div id="menu">
		 <a class="menu" href="index.php">Home</a> &#10081;<br>
		 <a class="menu" href="archive.php">Archive</a><br>
		 <a class="menu" href="https://github.com/dmpop/pygmyfoto">Pygmyfoto</a><br>
		 <hr>
		 <form method="post" action="search.php">
		 	<input type="text" name="tag" size="12"> <input type="submit" value="&#10148;">
		 </form>
	</div>
	
	<div id="content">
	<h1>P * y * g * m * y * f * o * t * o</h1>

	<script type="text/javascript">
	$(function() {
		$('a[@rel*=lightbox]').lightBox();
	});
	</script>

<?php

$db = new PDO('sqlite:pygmyfoto.sqlite');
print "<table border=0>";
$result = $db->query("SELECT id, description, tags, exif FROM photos WHERE published = '1' ORDER BY dt DESC");
foreach($result as $row)
{
print "<tr><td>".$row['description']."</td></tr>";
print "<tr><td valign='top'><p class='box'>Tags:<em> ".$row['tags']."</em> <a href='photo.php?id=".$row['id']."'>Permalink</a></p></td></tr>";
print "<tr><td><p class='box'>".$row['exif']."</p></td></tr>";
}
print "</table>";

$db = NULL;

?>
	<div class="footer">Powered by Pygmyfoto</div>
	</div>
	</body>
</html>