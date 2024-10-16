<?php

use App\Models\Task;

if (!isset($_SESSION['Auth'])) {
  header("location: /login");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>AdminLTE 3 | Task Board</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="App/Views/plugins/fontawesome-free/css/all.min.css">
  <!-- Ekko Lightbox -->
  <link rel="stylesheet" href="App/Views/plugins/ekko-lightbox/ekko-lightbox.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="App/Views/dist/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="App/Views/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
</head>

<body class="hold-transition sidebar-mini layout-fixed">
  <div class="wrapper">
    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
      <!-- Left navbar links -->
      <ul class="navbar-nav">

      </ul>

      <!-- Right navbar links -->
      <ul class="navbar-nav ml-auto">
        <!-- Navbar Search -->
        <li class="nav-item">
          <a class="nav-link" data-widget="navbar-search" href="#" role="button">
            <i class="fas fa-search"></i>
          </a>
          <div class="navbar-search-block">
            <form class="form-inline">
              <div class="input-group input-group-sm">
                <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
                <div class="input-group-append">
                  <button class="btn btn-navbar" type="submit">
                    <i class="fas fa-search"></i>
                  </button>
                  <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
              </div>
            </form>
          </div>
        </li>
      </ul>
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <!-- Brand Logo -->
      <a href="../index3.html" class="brand-link">
        <img src="App/Views/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">User Panel</span>
      </a>

      <!-- Sidebar -->
      <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
          <div class="image">
            <img src="App/Views/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
          </div>
          <div class="info">
            <a href="#" class="d-block">User</a>
          </div>
        </div>

        <!-- SidebarSearch Form -->


        <!-- Sidebar Menu -->
        <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->

            <li class="nav-item">
              <a href="/login" class="nav-link active">
                <i class="nav-icon fas fa-columns"></i>
                <p>
                  Logout
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
    <div class="content-wrapper kanban">
      <section class="content-header">
        <div class="container-fluid">
          <div class="row">
            <div class="col-sm-6">
              <h1>Task Board</h1>
            </div>
            <div class="col-sm-6 d-none d-sm-block">
              <ol class="breadcrumb float-sm-right">

              </ol>
            </div>
          </div>
        </div>
      </section>

      <section class="content pb-3">
        <div class="container-fluid h-100">
          <div class="card card-row card-secondary">
            <div class="card-header">
              <h3 class="card-title">
                Topshiriqlar
              </h3>
            </div>
            <div class="card-body">
              <div class="card card-info card-outline">
                <div class="card-header">


                  <h1></h1>
                  <?php
                  $vazifalar = Task::gettask($_SESSION['Auth']->id, 1);
                  foreach ($vazifalar as $vazifa) { ?>
                    <h5><?= $vazifa['title'] ?></h5>
                    <div class="card-body">
                      <p>
                        <?= $vazifa['description'] ?>
                      </p>
                      <img src="<?php echo "rasm/" . $vazifa['img'] ?>" alt="" width="100px">
                    </div>
                  <?php }
                  ?>
                  <form action="/user" method="post">
                    <button type="submit" name="qabul" class="btn btn-primary">Qabul qilish</button>
                  </form>

                </div>
                <?php
                if (isset($_POST['qabul'])) {
                  $data = ['status' => '2'];
                  Task::update($data, $_SESSION['Auth']->id);
                  header("location: /user");
                }
                ?>
              </div>
              <div class="card card-light card-outline">
                <div class="card-header">
                  <div class="card-tools">
                    </a>
                  </div>
                </div>

              </div>
            </div>
          </div>
          <div class="card card-row card-secondary">
            <div class="card-header">
              <h3 class="card-title">
                Bajarish
              </h3>
            </div>
            <div class="card-body">
              <div class="card card-info card-outline">
                <div class="card-header">


                  <h1></h1>
                  <?php
                  $vazifalar = Task::gettask($_SESSION['Auth']->id, 2);
                  foreach ($vazifalar as $vazifa) { ?>
                    <h5><?= $vazifa['title'] ?></h5>
                    <div class="card-body">
                      <p>
                        <?= $vazifa['description'] ?>
                      </p>
                      <img src="<?php echo "rasm/" . $vazifa['img'] ?>" alt="" width="100px">
                    </div>
                  <?php }
                  ?>
                  <form action="/user" method="post">
                    <button type="submit" name="topshirish" class="btn btn-primary">Topshirish</button>
                  </form>

                </div>
                <?php
                if (isset($_POST['topshirish'])) {
                  $data = ['status' => '3'];
                  Task::update($data, $_SESSION['Auth']->id);
                  header("location: /user");
                }
                ?>
              </div>
              <div class="card card-light card-outline">
                <div class="card-header">
                  <div class="card-tools">
                    </a>
                  </div>
                </div>

              </div>
            </div>
          </div>
          <div class="card card-row card-secondary">
            <div class="card-header">
              <h3 class="card-title">
                Tugatish
              </h3>
            </div>
            <div class="card-body">
              <div class="card card-info card-outline">
                <div class="card-header">


                  <h1></h1>
                  <?php
                  $vazifalar = Task::gettask($_SESSION['Auth']->id, 3);
                  foreach ($vazifalar as $vazifa) { ?>
                    <h5><?= $vazifa['title'] ?></h5>
                    <div class="card-body">
                      <p>
                        <?= $vazifa['description'] ?>
                      </p>
                      <img src="<?php echo "rasm/" . $vazifa['img'] ?>" alt="" width="100px">
                    </div>
                  <?php }
                  ?>
                  <form action="/user" method="post">
                    <button type="submit" name="tugallash" class="btn btn-primary">Tugallash</button>
                  </form>

                </div>
                <?php
                if (isset($_POST['tugallash'])) {
                  $data = ['status' => '4'];
                  Task::update($data, $_SESSION['Auth']->id);
            
                }
                ?>
              </div>
              <div class="card card-light card-outline">
                <div class="card-header">
                  <div class="card-tools">
                    </a>
                  </div>
                </div>

              </div>
            </div>
          </div>
          <div class="card card-row card-success">
            <div class="card-header">
              <h3 class="card-title">
                Done
              </h3>
            </div>
            <div class="card-body">
              <div class="card card-primary card-outline">
                <div class="card-header">
                  <h5 class="card-title">
                    <?php
                    if(isset($_POST['tugallash']))
                    {
                      echo"Sizning vazifaningi tekshirilmoqda...";
                    }
                    ?>
                  </h5>
                  <div class="card-tools">
                    <a href="#" class="btn btn-tool btn-link">#1</a>
                    <a href="#" class="btn btn-tool">
                      <i class="fas fa-pen"></i>
                    </a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
    </div>

    <footer class="main-footer">
      <div class="float-right d-none d-sm-block">
        <b>Version</b> 3.2.0
      </div>
      <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights reserved.
    </footer>

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
      <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
  </div>
  <!-- ./wrapper -->

  <!-- jQuery -->
  <script src="App/Views/plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap -->
  <script src="App/Views/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- Ekko Lightbox -->
  <script src="App/Views/plugins/ekko-lightbox/ekko-lightbox.min.js"></script>
  <!-- overlayScrollbars -->
  <script src="App/Views/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
  <!-- AdminLTE App -->
  <script src="App/Views/dist/js/adminlte.min.js"></script>
  <!-- Filterizr-->
  <script src="App/Views/plugins/filterizr/jquery.filterizr.min.js"></script>
  <!-- AdminLTE for demo purposes -->
  <script src="App/Views/dist/js/demo.js"></script>
  <!-- Page specific script -->
  <script>
    $(function() {

    })
  </script>
</body>

</html>