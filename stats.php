<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html>

	<head>
	<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
	<link href="css/style.css" rel="stylesheet" type="text/css" media="all" />
	<link href='http://fonts.googleapis.com/css?family=Asap:400,700,400italic,700italic' rel='stylesheet' type='text/css'>
	<link rel="shortcut icon" href="favicon.ico" />

	<title>Pygmyfoto</title>
	</head>

	<body>
	
	<div id="content">
	<h1>P * y * g * m * y * f * o * t * o</h1>

<?php

$db = new PDO('sqlite:pygmyfoto.sqlite');

print "<center><a href='index.php'><strong>Home</a></strong> &#10034; <a href='archive.php'>Archive</a> &#10034; <a href='https://github.com/dmpop/pygmyfoto'>Pygmyfoto</a></center>";

print "<table border=0>";
$result = $db->query("SELECT id, title, count FROM photos ORDER BY count DESC");
foreach($result as $row)
{
	print "<tr><td><p>".$row['title']."</p></td><td><p>".$row['count']."</p></td></tr>";
}
print "</table>";

$db = NULL;

?>
	<div class="footer">Powered by Pygmyfoto</div>
	</div>
	</body>

</html>
