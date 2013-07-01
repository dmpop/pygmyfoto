<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">

<!-- http://lokeshdhakar.com/projects/lightbox2/ -->

<html>

	<head>
	<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
	<link href="css/style.css" rel="stylesheet" type="text/css" media="all" />
	<link href='http://fonts.googleapis.com/css?family=Asap:400,700,400italic,700italic' rel='stylesheet' type='text/css'>
	<link rel="shortcut icon" href="favicon.ico" />

	<title>Pygmyfoto</title>
	</head>

	<body>
	
	<?php
	
	include 'config.php';
	print "<div id='content'><h1>$title</h1>";
	print "$navigation<br />";
	
	$dir='photos/queue/';
	$files = glob($dir.'*.jpg', GLOB_BRACE);
	$fileCount = count(glob($dir.'*.jpg'));

   // for ($i=($fileCount-1); $i>=0; $i--) 
   
   for ($i=($fileCount-1); $i>=($fileCount-11); $i--) {  
    echo '<img src="'.$files[$i].'" alt="" width="500px"><br /><br />';
    }
    
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
