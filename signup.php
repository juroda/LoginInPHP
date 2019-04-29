<?php
  require 'database.php';

  $message = '';

  if(!empty($_POST['email']) && !empty($_POST['password'])){
    $sql = "INSERT INTO users (email, password) VALUES (:email, :password)";
    $stmt = $conn->prepare($sql);

    $stmt->bindParam(':email', $_POST['email']);

    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    $stmt->bindParam(':password', $password);

    if ( $stmt->execute() ){
      $message = 'Succesfully created new user';
    }else {
      $message = 'Sorry there must have been an issue creating your accout';
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
  <title>SignUp</title>
</head>
<body>

  <?php require 'partials/header.php'?>

  <?php if(!empty($message)): ?>
    <p><?= $message ?></p>
  <?php endif; ?>

  <h1>SignUp</h1> or
  <span><a href="login.php" target="_blank" rel="noopener noreferrer">Login</a></span>
  
  <form action="signup.php" method="POST">
    <input type="text" name="email" placeholder="Enter you e-mail">
    <input type="password" name="password" placeholder="Enter you password">
    <input type="password" name="confirm_password" placeholder="Confirm your password">    
    <input type="submit" value="Send">
  </form>
  
</body>
</html>