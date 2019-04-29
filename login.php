
<?php 
  session_start();


  if ( isset($_SESSION['user_id'])){
    header('Location: index.php')
  }
  
  require 'database.php';

  if(!empty($_POST['email']) && !empty($_POST['password']) ){
    $records = $conn->prepare('SELECT ID, email, password FROM users WHERE email=:email');
    $records->bindParam(':email', $_POST['email']);

    $records->execute();
    $results=  $records->fetch(PDO::FETCH_ASSOC);

    $message = "";
    
    if( count($results) > 0 && password_verify($_POST['password'], $results['password']) ){
      $_SESSION['user_id'] = $results['ID'];
      header('Location: index.php');
    } else {
      $message = 'Sorry, those credentials do not match';
    }
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="./php-login/assets/css/style.css">  
  <title>Login</title>
</head>
<body>

<?php require 'partials/header.php'?>

  <h1>Login</h1> or
  <span><a href="signup.php" target="_blank" rel="noopener noreferrer">Login</a></span>

  <?php if(!empty($message)):?>
  <p><?= $message?></p>
  <?php endif; ?>

  <form action="login.php" method="POST">
    <input type="text" name="email" placeholder="Enter you e-mail">
    <input type="password" name="password" placeholder="Enter you password">
    <input type="submit" value="Send">
  </form>

</body>
</html>