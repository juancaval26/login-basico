<?php
  session_start();

  require '../database/database.php';

  if (isset($_SESSION['id'])) {
    $records = $conn->prepare('SELECT * FROM usuarios WHERE id = :id');
    $records->bindParam(':id', $_SESSION['id']);
    $records->execute();
    $results = $records->fetch(PDO::FETCH_ASSOC);

    $user = null;

    if (count($results) > 0) {
      $user = $results;
    }
  }
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Welcome to you WebApp</title>
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/style.css">
  </head>
  <body>

    <?php if(!empty($user)): ?>
      <br> Welcome. <?= $user['user']; ?>
      <br>You are Successfully Logged In
      <a href="../cerrarSesion/logout.php">
        Logout
      </a>
    <?php endif; ?>
  </body>
</html>
