<?php

session_start();

if (isset($_GET['id'])) {
    $_SESSION['rec'] = $_GET['id'];
}

include 'config.php';

if(isset($_POST['submit'])){

$passwd = $_POST['passwd'];

if($password == $passwd)

{

$db = new PDO('sqlite:pygmyfoto.sqlite');
$db->query("UPDATE photos SET published = '1' WHERE id='{$_SESSION['rec']}'");
$db = NULL;

$host  = $_SERVER['HTTP_HOST'];
$uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
$extra = 'archive.php';
header("Location: http://$host$uri/$extra");

session_destroy();

exit;

}

else

{

$error_message = "Wrong password. ";
}

}

?>

<html>
<body>
<?php if($error_message){ echo $error_message; } ?> 
Password:
<form method="post" action="publish.php">
<input type="text" name="passwd" />
<input type="submit" name="submit" />
</form>
</body>
