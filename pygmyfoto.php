<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html>

	<head>
	<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
	<link href="style.css" rel="stylesheet" type="text/css" media="all" />
	<link href="http://fonts.googleapis.com/css?family=Droid+Serif:regular,italic,bold,bolditalic&v1" rel="stylesheet" type="text/css">
	<title>Pygmyfoto</title>
	</head>
	
	<body>
	<center><div class="sidebar">
	<div class="sidetext">&#10031; One Photo At A Time &#10031;</div>
	</div></center>
	
	<div id="content">
	<p class="content"></p>
	<h2>
	Pygmyfoto
	</h2>

<?php

$db = new PDO('sqlite:pygmyfoto.sqlite');
print "<hr>";
print "<table border=0>";
$result = $db->query("SELECT id, article, tags FROM photos WHERE pub = '1' ORDER BY id ASC");
foreach($result as $row)
{
print "<tr><td><p>".$row['article']."</p></td></tr>";
print "<tr><td><small>Tags:<em> ".$row['tags']."</small></em></td></tr>";
}
print "</table>";

$db = NULL;

print "<hr>";

?>
	<center><div class="footer"><a href="pfarchive.php">Pygmyfoto archive</a></div></center>
	
	<script type="text/javascript" src="/slimstat/?js"></script>
	</body>
</html>