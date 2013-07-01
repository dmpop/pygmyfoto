<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html>

	<head>
	<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
	<link href="css/style.css" rel="stylesheet" type="text/css" media="all" />
	<link href='http://fonts.googleapis.com/css?family=Asap:400,700,400italic,700italic' rel='stylesheet' type='text/css'>
	<link rel="shortcut icon" href="favicon.ico" />

	<?php
	
	include 'config.php';
	print "<title>$title</title>";
	
	?>
	
	</head>
	<body>
	
	<?php
	
	include 'config.php';
	
	print "<div id='content'><h1>$title</h1>";
	
	$db = new PDO('sqlite:pygmyfoto.sqlite');
	
	print $navigation;
	
	print "<table border=0>";
	
	$result = $db->query("SELECT id, title, count FROM photos ORDER BY count DESC");
	
	foreach($result as $row)
	{
	print "<tr><td><p>".$row['title']."</p></td><td><p>".$row['count']."</p></td></tr>";
	}
	
	print "</table>";
	
	$db = NULL;
	
	print "<div class='footer'>$footer</div>";
	
	$ip=$_SERVER['REMOTE_ADDR'];
	$date = $date = date('Y-m-d H:i:s');
	$page = basename($_SERVER['PHP_SELF']);
	$file = fopen("ip.log", "a+");
	fputs($file, " $ip	$page $date \n");
	fclose($file);
	
	?>
	
	</div>
	</body>
</html>
