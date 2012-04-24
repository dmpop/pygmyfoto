<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html>

	<head>
	<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
	<link href="style.css" rel="stylesheet" type="text/css" media="all" />
	<link href='http://fonts.googleapis.com/css?family=Artifika' rel='stylesheet' type='text/css'>
	<link href='http://fonts.googleapis.com/css?family=Oleo+Script' rel='stylesheet' type='text/css'>
	<link href="http://fonts.googleapis.com/css?family=Droid+Serif:regular,italic,bold,bolditalic&v1" rel="stylesheet" type="text/css">
	<title>Pygmyfoto</title>
	</head>
	
	<body>
	
	<div id="content">
	<h1>Pygmyfoto</h1>
	<hr>

<?php

$db = new PDO('sqlite:pygmyfoto.sqlite');
print "<table border=0>";
$result = $db->query("SELECT id, article, tags FROM photos WHERE pub = '1' ORDER BY id DESC");
foreach($result as $row)
{
print "<tr><td><p>".$row['article']."</p></td></tr>";
print "<tr><td><p class='box'>Tags:<em> ".$row['tags']."</p></em></td></tr>";
}
print "</table>";

$db = NULL;

?>
	<div class="footer"><a href="archive.php">Pygmyfoto archive</a></div>
	</div>
	</body>
</html>