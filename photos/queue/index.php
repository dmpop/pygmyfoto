<?php

$files = glob("*.jpg");
$fileCount = count(glob("*.jpg"));

// for ($i=($fileCount-1); $i>=0; $i--) 

for ($i=($fileCount-1); $i>=($fileCount-11); $i--) {  
    echo '<img src="'.$files[$i].'" alt="" width="500px"><br /><br />';
}

?>
