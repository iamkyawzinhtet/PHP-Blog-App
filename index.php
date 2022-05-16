<?php
//   session_start();
//   require 'config/config.php';

//   if(empty($_SESSION['user_id']) && empty($_SESSION['logged_in'])) {
//     header('Location: login.php');
//   }

  // print "<pre>";
  // print_r($result);
?>

<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Blog App | Admin</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
</head>
<body>
<div class="wrapper">
  <!-- Container. Contains page content -->
  <div class="container">
  <!-- Content Header (Page header) -->
  <section class="content-header mb-4">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-4">
              <h1 style="color: #666">Blogs</h1>
          </div>
          <div class="col-sm-8">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php">Home</a></li>
              <li class="breadcrumb-item active"><a href="logout.php">Logout</a></li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
  <!-- Main content -->
  <section class="content">
      <div class="container-fluid">
      <div class="row">
          <div class="col-md-4">
            <!-- Box Comment -->
            <div class="card card-widget">
              <!-- /.card-header -->
              <div class="card-body">
                <a href="blogdetail.php" style="color: #666">
                    <img class="img-fluid pad mb-3" src="dist/img/photo2.png" alt="Photo">
                    <h5 style="text-align:center">Sample Title</h5>
                </a>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
  </section>
  </div>
  <!-- /.content-wrapper -->


  <!-- Main Footer -->
  <footer class="main-footer" style="margin-left: 0;text-align: center;">
    <!-- Default to the left -->
    <strong>Copyright &copy; 2022 <a href="#">Blog App</a>.</strong> All rights reserved.
  </footer>
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
</body>
</html>