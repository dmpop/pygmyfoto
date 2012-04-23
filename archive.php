<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html>

	<head>
	<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
	<link href="style.css" rel="stylesheet" type="text/css" media="all" />
	<link href="http://fonts.googleapis.com/css?family=Droid+Serif:regular,italic,bold,bolditalic&v1" rel="stylesheet" type="text/css">
	<title>Pygmyfoto</title>
	</head>
	
	<body>
	<center><div class="titlebar">
	<div class="titlebartext">&#10031; Pygmyfoto Archive &#10031;</div>
	</div></center>
	
	<div id="content">

<?php

$db = new PDO('sqlite:pygmyfoto.sqlite');
print "<table border=0>";
$result = $db->query("SELECT id, article, tags FROM photos WHERE pub = '-' ORDER BY id ASC");
foreach($result as $row)
{
print "<tr><td><p>".$row['article']."</p></td></tr>";
print "<tr><td><p class='box'>Tags:<em> ".$row['tags']."</p></em></td></tr>";
}
print "</table>";

$db = NULL;

?>
	<div class="footer"><a href="index.php">Pygmyfoto</a></div>
	</div>
	</body>
</html>