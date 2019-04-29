<?php 

  session_start();
  require 'database.php';

  if( isset($_SESSION['user_id'])){
    $records = $conn->prepare('SELECT ID, email, password FROM users WHERE ID = :id');

    $records->bindParam(':id', $_SESSION['user_id']);
    $records->execute();
    $results = $records->fetch(PDO::FETCH_ASSOC);

    $user = null;

    if ( count($results) > 0){
      $user = $results;
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
  <title>WelcomeToYourApp</title>
</head>
<body>
  
<?php require 'partials/header.php'?>

<?php if( !empty($user)):?>
  <br>Welcome. <?= $user['email']?>
  <br>You are succesfully logged in
  <a href="logout.php">Logout</a>
<?php else:?>
  <h1>Please login orSignup</h1>
  <a href="login.php">Login</a> or
  <a href="signup.php">Sign-up</a>
<?php endif; ?>

</body>
</html>