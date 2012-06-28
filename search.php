<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<!-- http://leandrovieira.com/projects/jquery/lightbox/ -->

<html>

	<head>
	<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
	<link href="css/style.css" rel="stylesheet" type="text/css" media="all" />
	<link href='http://fonts.googleapis.com/css?family=Artifika' rel='stylesheet' type='text/css'>
	<link href='http://fonts.googleapis.com/css?family=Oleo+Script' rel='stylesheet' type='text/css'>
	<link href="http://fonts.googleapis.com/css?family=Droid+Serif:regular,italic,bold,bolditalic&v1" rel="stylesheet" type="text/css">
	<link href='http://fonts.googleapis.com/css?family=Crete+Round' rel='stylesheet' type='text/css'>
	<link rel="shortcut icon" href="favicon.ico" />

	<script type="text/javascript" src="js/jquery.js"></script>
	<script type="text/javascript" src="js/jquery.lightbox-0.5.js"></script>
	<link rel="stylesheet" type="text/css" href="css/jquery.lightbox-0.5.css" media="screen" />

	<title>Pygmyfoto</title>
	</head>
	
	<body>

	<div id="menu">
		 <a class="menu" href="index.php">Home</a><br>
		 <a class="menu" href="archive.php">Archive</a><br>
		 <a class="menu" href="https://github.com/dmpop/pygmyfoto">Pygmyfoto</a><br>
		 <hr>
		 <form method="post" action="search.php">
		 	<input type="text" name="tag" size="12"> <input type="submit" value="&#10148;">
		 </form>
	</div>
	
	<div id="content">
	<h1>Pygmyfoto</h1>
	<hr>

	<script type="text/javascript">
	$(function() {
		$('a[@rel*=lightbox]').lightBox();
	});
	</script>

<?php

$tag = $_POST['tag'];

$db = new PDO('sqlite:pygmyfoto.sqlite');
print "<table border=0>";
$result = $db->query("SELECT id, description, tags, exif FROM photos WHERE published = '1' AND tags LIKE '%$tag%' ORDER BY id DESC");
foreach($result as $row)
{
print "<tr><td>".$row['description']."</td></tr>";
print "<tr><td valign='top'><p class='box'>Tags:<em> ".$row['tags']."</p></em></td></tr>";
print "<tr><td><p class='box'>".$row['exif']."</p></td></tr>";
}
print "</table>";

$db = NULL;

?>
	<div class="footer">Powered by Pygmyfoto</div>
	</div>
	</body>
</html>