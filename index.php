<?php
  session_start();
  require 'config/config.php';

  if(empty($_SESSION['user_id']) && empty($_SESSION['logged_in'])) {
    header('Location: login.php');
  }
  if(!empty($_GET['pageno'])) {
    $pageno = $_GET['pageno'];
  }else {
    $pageno = 1;
  }
  $numOfRecs = 6;
  $offset = ($pageno - 1) * $numOfRecs;

  if(empty($_POST['search'])) {
    $stmt = $pdo->prepare("SELECT * FROM posts ORDER BY id DESC");
    $stmt->execute();
    $rawResult = $stmt->fetchAll();
    $total_pages = ceil(count($rawResult) / $numOfRecs);

    $stmt = $pdo->prepare("SELECT * FROM posts ORDER BY id DESC LIMIT $offset,$numOfRecs");
    $stmt->execute();
    $result = $stmt->fetchAll();
  }else {
    $searchKey = $_POST['search'];
    $stmt = $pdo->prepare("SELECT * FROM posts WHERE title LIKE '%$searchKey%' ORDER BY id DESC");
    $stmt->execute();
    $rawResult = $stmt->fetchAll();
    $total_pages = ceil(count($rawResult) / $numOfRecs);

    $stmt = $pdo->prepare("SELECT * FROM posts WHERE title LIKE '%$searchKey%' ORDER BY id DESC LIMIT $offset,$numOfRecs");
    $stmt->execute();
    $result = $stmt->fetchAll();
  }

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
        <?php
        if($result){
          $i = 1;
          foreach ($result as $value) {
          ?>
            <div class="col-md-4">
              <!-- Box Comment -->
              <div class="card">
                <!-- /.card-header -->
                <div class="card-body">
                  <a href="blogdetail.php?id=<?php echo $value['id']?>" style="color: #666">
                    <img class="img-fluid pad mb-3" src="admin/images/<?php echo $value['image']?>" style="height: 200px;">
                    <h5 style="text-align:center"><?php echo($value['title']) ?></h5>
                  </a>
                </div>
                <!-- /.card-body -->
              </div>
              <!-- /.card -->
            </div>
            <!-- /.col -->
        <?php
        $i++;
        }
      }
        ?>
        </div>
        <!-- /.row -->
        <div class="row float-right">
          <ul class="pagination pagination-sm m-0">
            <li class="page-item">
              <a class="page-link" href="?pageno=1">First</a>
            </li>
            <li class="page-item <?php if($pageno<=1){echo 'disabled';} ?>">
              <a class="page-link" href="<?php if($pageno<=1){echo '#';}else{echo "?pageno=".($pageno-1);} ?>">Previous</a>
            </li>
            <li class="page-item">
              <a class="page-link" href="#"><?php echo $pageno; ?></a>
            </li>
            <li class="page-item <?php if($pageno>=$total_pages){echo 'disabled';} ?>">
              <a class="page-link" href="<?php if($pageno>=$total_pages){echo '#';}else{echo "?pageno=".($pageno+1);} ?>">Next</a>
            </li>
            <li class="page-item">
              <a class="page-link" href="?pageno=<?php echo $total_pages ?>">Last</a>
            </li>
          </ul>
        </div>
      </div>
  </section>
  </div>
  <!-- /.content-wrapper -->


  <!-- Main Footer -->
  <footer class="main-footer mt-4" style="margin-left: 0;text-align: center;">
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
