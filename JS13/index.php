<?php
include('lib/Session.php');
$session = new Session();
if ($session->get('is_login') !== true) {
    header('Location: login.php');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>AdminLTE 3 | Blank Page</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="adminlte/plugins/fontawesome-free/css/all.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="adminlte/dist/css/adminlte.min.css">
</head>

<body class="hold-transition sidebar-mini">
    <!-- Site wrapper -->
    <div class="wrapper">
        <!-- Nav -->
         <?php include('layouts/header.php');?>
         <!--NAV-->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="adminlte/index3.html" class="brand-link">
                <img src="adminlte/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
                <span class="brand-text font-weight-light">AdminLTE 3</span>
            </a>

            <!-- Sidebar -->
            <?php include ('layouts/sidebar.php');?>
            <!-- /.sidebar -->
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <?php
      $page = isset($_GET['page']) ? $_GET['page'] : 'dashboard';
      switch(strtolower($page)){
        case 'dashboard'  : include('pages/dashboard.php'); break;
        case 'buku'       : include('pages/buku.php'); break;
        case 'kategori'   : include('pages/kategori.php'); break;
        case 'user'       : include('pages/user.php'); break;
        default           : include('pages/404.php'); break;
      }
    ?>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->

       <?php include('layouts/footer.php')?>

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->

    <!-- jQuery -->
    <script src="adminlte/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="adminlte/dist/js/adminlte.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="adminlte/dist/js/demo.js"></script>
</body>

</html>