<?php
  session_start();
  require 'database/database.php';

  if (isset($_SESSION['id'])) {
    header('Location: index.php');
  }

  if (!empty($_POST['email']) && !empty($_POST['password'])) {
    $records = $conn->prepare('SELECT *  FROM usuarios WHERE user = :user');
    $records->bindParam(':user', $_POST['email']);
    $records->execute();
    $results = $records->fetch(PDO::FETCH_ASSOC);

    $message = '';

    if (count($results) > 0 && password_verify($_POST['password'], $results['password'])) {
      $_SESSION['id'] = $results['id'];
      header("Location: home/home.php");
    } else {
      $message = 'Sorry, those credentials do not match';
    }
  }

?>

<!DOCTYPE html>
<html lang="es" dir="ltr">
  <head>
    <meta charset="utf-8">
  	<link rel="stylesheet" type="text/css" href="assets/css/util.css">
  	<link rel="stylesheet" type="text/css" href="assets/css/main.css">
  <!--===============================================================================================-->
  </head>
  <body>
    <?php if(!empty($message)): ?>
      <p> <?= $message ?></p>
    <?php endif; ?>
  	<div class="limiter">
  		<div class="container-login100">
  			<div class="wrap-login100">
  				<form class="login100-form validate-form p-l-55 p-r-55 p-t-178" method="post" action="index.php">
  					<span class="login100-form-title">Login</span>

  					<div class="wrap-input100 validate-input m-b-16" data-validate="Please enter username">
  						<input class="input100" type="text" name="email" placeholder="Username">
  						<span class="focus-input100"></span>
  					</div>

  					<div class="wrap-input100 validate-input" data-validate = "Please enter password">
  						<input class="input100" type="password" name="password" placeholder="Password">
  						<span class="focus-input100"></span>
  					</div>

  					<div class="text-right p-t-13 p-b-23">
  						<span class="txt1">Forgot</span>

  						<a href="olvideClave/olvidarClave.php" target="_blank" class="txt2">Username / Password?</a>
  					</div>

  					<div class="container-login100-form-btn">
  						<button type="submit" name="ingresar" class="login100-form-btn">Sign In</button>
							<div class="">
								<span class="txt1 p-b-9">Don’t have an account?</span>

								<a href="registro/signup.php" class="">Sign Up</a>
							</div>
  					</div>


  				</form>
  			</div>
  		</div>
  	</div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.js"></script>
   <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.js"></script>
     	<script src="assets/js/main.js"></script>
  </body>
</html>
