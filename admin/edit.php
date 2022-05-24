<?php
  session_start();
  require '../config/config.php';
  require '../config/common.php';

  if(empty($_SESSION['user_id']) && empty($_SESSION['logged_in'])) {
    header('Location: login.php');
  }
    // print "<pre>";
    // print_r($result);

    if($_POST) {
      if(empty($_POST['title']) || empty($_POST['content'])) {
        if(empty($_POST['title'])) {
          $titleError = 'Title is required';
        }
        if(empty($_POST['content'])) {
          $contentError = 'Content is required';
        }
      }else {
        $id = $_POST['id'];
        $title = $_POST['title'];
        $content = $_POST['content'];
  
        if($_FILES['image']['name'] != null) {
          
          $file = 'images/'.($_FILES['image']['name']);
          $imageType = pathinfo($file,PATHINFO_EXTENSION);
    
          if($imageType != 'png' && $imageType != 'jpg' && $imageType != 'jpeg') {
            echo "<script>alert('Image must be png,jpg or jpeg.');</script>";
          }else {
              $image = $_FILES['image']['name'];
              move_uploaded_file($_FILES['image']['tmp_name'],$file);
    
              $stmt = $pdo->prepare("UPDATE posts SET title='$title',content='$content',image='$image' WHERE id='$id'");
              $result = $stmt->execute();
                if($result) {
                    echo "<script>alert('Successfully updated.');
                    window.location.href='index.php';</script>";
                }
          }
        }else {
          $stmt = $pdo->prepare("UPDATE posts SET title='$title',content='$content' WHERE id='$id'");
          $result = $stmt->execute();
            if($result) {
                echo "<script>alert('Successfully updated.');
                window.location.href='index.php';</script>";
            }
        }
      }
  }

  $stmt = $pdo->prepare("SELECT * FROM posts WHERE id=".$_GET['id']);
  $stmt->execute();
  $result = $stmt->fetchAll();
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
  <title>Edit Post</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../dist/css/adminlte.min.css">
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="../dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">Blog App | Admin</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Blog Posts
              </p>
            </a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-12">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php">Home</a></li>
              <li class="breadcrumb-item active"><a href="logout.php">Logout</a></li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <div class="container-fluid pl-3 pr-3">
        <form action="" method="POST" enctype='multipart/form-data'>
        <input name="_token" type="hidden" value="<?php echo $_SESSION['_token']; ?>">
        <div class="form-group mb-4">
            <input type="hidden" name="id" value="<?php echo $result[0]['id']?>" >
            <label for="title" class="form-label" style="color: #666">Title</label>
            <p style="color: red"><?php echo empty($titleError) ? '' : '*'.$titleError; ?></p>
            <input type="text" name="title" class="form-control" value="<?php echo($result[0]['title']) ?>">
        </div>
        <div class="form-group mb-4">
            <label for="Content" class="form-label" style="color: #666">Content</label>
            <p style="color: red"><?php echo empty($contentError) ? '' : '*'.$contentError; ?></p>
            <textarea name="content" cols="30" rows="10" class="form-control"><?php echo($result[0]['content']) ?></textarea>
        </div>
        <div class="form-group mb-4">
            <label for="image" class="form-label mb-3" style="color: #666">Image</label>
            <img src="images/<?php echo $result[0]['image']?>" width="150" class="mb-3"><br>
            <input type="file" name="image" class="form-control">
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-success mr-1">Update Post</button>
        </div>
        </form>
    </div>
    
  </div>
  <!-- /.content-wrapper -->


  <!-- Main Footer -->
  <footer class="main-footer" style="text-align: center;">
    <!-- Default to the left -->
    <strong>Copyright &copy; 2022 <a href="#">Blog App</a>.</strong> All rights reserved.
  </footer>
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
<script src="../plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="../dist/js/adminlte.min.js"></script>
</body>
</html>
