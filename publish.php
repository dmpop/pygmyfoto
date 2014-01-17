<html>

  <head>
  <meta http-equiv="content-type" content="text/html; charset=UTF-8" />
  <link href="css/style.css" rel="stylesheet" type="text/css" media="all" />
  <link href='http://fonts.googleapis.com/css?family=Asap:400,700,400italic,700italic' rel='stylesheet' type='text/css'>
  <link rel="shortcut icon" href="favicon.ico" />
  
  <?php
  
  include 'config.php';
  echo "<title>$title</title>";
  echo "<div id='content'><h1>$title</h1>";
  echo "<div class='center'>$navigation</div>";
  
  ?>
  
  </head>
  <body>
  
  <?php
  
  session_start();
  
  if (isset($_GET['id'])) {
    $_SESSION['rec'] = $_GET['id'];
    }
    
    if(isset($_POST['submit'])){
    $passwd = $_POST['passwd'];
    
    if($password == $passwd)
    {
    $db = new PDO('sqlite:pygmyfoto.sqlite');
    $result=$db->prepare("UPDATE photos SET published = '1' WHERE id=:id");
    $id = "{$_SESSION['rec']}";
    $result->bindParam(':id', $id, PDO::PARAM_INT);
    $result->execute();
    $result->closeCursor();
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
    $error_message = "<p><div class='center'><font color='red'>Wrong password.</font> Try again or <a href='index.php'>cancel</a></div></p>";
    }
    }
    
    ?>
    
    <?php if($error_message){ echo $error_message; } ?>
    <p><div class='center'>
    <form method="post" action="publish.php">
    Password: <input type="text" name="passwd" />
    <input type="submit" name="submit" />
    </form></p>
    </div>
    </div>
</body>
