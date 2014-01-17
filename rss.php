<?php

$db = new PDO('sqlite:pygmyfoto.sqlite');

header("Content-type: text/xml"); 

echo "<?xml version='1.0' encoding='UTF-8'?> 
<rss version='2.0'>
<channel>
<title>Pygmyfoto</title>
<link>https://github.com/dmpop/pygmyfoto</link>
<description>Pygmyfoto</description>
<language>en-us</language>"; 

$result = $db->prepare("SELECT id, title, tags, published FROM photos WHERE published = '1' ORDER BY dt DESC");
$result->execute();

include 'config.php';

foreach ($result as $row)
{
	$title=$row['title'];
	$URL=$baseurl."photo.php?id=".$row['id'];
	$tags=$row['tags'];
	echo "<item><title>$title</title>
	<link>$URL</link>
	<description>$tags</description></item>";
}
echo "</channel></rss>";

$result->closeCursor();
$db = NULL;

?>


