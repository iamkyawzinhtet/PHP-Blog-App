<?php
    session_start();
    require 'config/config.php';
    if($_POST) {
      if(empty($_POST['name']) || empty($_POST['email']) || empty($_POST['password'])) {
        if(empty($_POST['name'])) {
          $nameError = 'Name is required';
        }
        if(empty($_POST['email'])) {
          $emailError = 'Email is required';
        }
        if(empty($_POST['password'])) {
          $passwordError = 'Password is required';
        }
      }else{
        $name = $_POST['name'];
        $email = $_POST['email'];
        $password = password_hash($_POST['password'],PASSWORD_DEFAULT);
  
        $stmt = $pdo->prepare("SELECT * FROM users WHERE email=:email");
        $stmt->bindValue(':email', $email);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        if($user) {
          echo "<script>alert('This account already exists.')</script>";
        }else {
          $stmt = $pdo->prepare("INSERT INTO users(name,email,password) VALUES (:name,:email,:password)");
          $result = $stmt->execute(
            array(
              ':name' => $name,
              ':email' => $email,
              ':password' => $password,
            )
          );
          if($result) {
            echo "<script>alert('Successfully registered');
            window.location.href='login.php';</script>";
          }
        }
      }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>AdminLTE 3 | Log in</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <h3 style="color: #666">Blog App</h3>
  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg mb-3">Register</p>

      <form action="register.php" method="post">
        <p style="color: red"><?php echo empty($nameError) ? '' : "*".$nameError  ?></p>
        <div class="input-group mb-4">
          <input name="name" type="text" class="form-control" placeholder="Name">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>
        <p style="color: red"><?php echo empty($emailError) ? '' : "*".$emailError  ?></p>
        <div class="input-group mb-4">
          <input name="email" type="email" class="form-control" placeholder="Email">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <p style="color: red"><?php echo empty($passwordError) ? '' : "*".$passwordError  ?></p>
        <div class="input-group mb-4">
          <input name="password" type="password" class="form-control" placeholder="Password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="button-group">
        <button type="submit" class="btn btn-primary mr-1">Register</button>
        <a href="login.php">Sign in</a>
        </div>
      </form>
    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
</body>
</html>
