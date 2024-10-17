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
              <a href="/logout" class="nav-link active">
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
        <div class="container-fluid">
    <div class="card card-row card-secondary">
        <div class="card-header">
            <h3 class="card-title">Topshiriqlar</h3>
        </div>
        <div class="card-body">
            <div class="card card-info card-outline">
                <div class="card-header">
                    <h1></h1>
                    <?php
                    $vazifalar = Task::gettask($_SESSION['Auth']->id, 1);
                    if (!empty($vazifalar)) { ?>
                        <div class="table-responsive">
                            <table class="table mb-0 w-100">
                                <thead>
                                    <tr>
                                        <th>Title</th>
                                        <th>Description</th>
                                        <th>Rasm</th>
                                        <th>Amallar</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($vazifalar as $vazifa) { ?>
                                        <tr>
                                            <td><?= $vazifa['title'] ?></td>
                                            <td><?= $vazifa['description'] ?></td>
                                            <td>
                                                <img src="<?php echo "rasm/" . $vazifa['img'] ?>" alt="" width="100px">
                                            </td>
                                            <td>
                                                <form action="/user" method="post">
                                                    <input type="hidden" name="task_id" value="<?= $vazifa['id'] ?>">
                                                    <button type="submit" name="qabul" class="btn btn-success">Qabul qilish</button>
                                                </form>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    <?php } else { ?>
                        <p>Hozirda hech qanday topshiriq yo'q.</p>
                    <?php } ?>
                </div>

                <?php
                if (isset($_POST['qabul'])) {
                    $task_id = $_POST['task_id'];
                    $data = ['status' => '2'];
                    Task::update($data, $task_id);
                    header("location: /user");
                    exit; // Redirectdan so'ng scriptni to'xtatish
                }
                ?>
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
                  if (!empty($vazifalar)) { ?>
                    <table class="table">
                      <thead>
                        <tr>
                          <th>Title</th>
                          <th>Description</th>
                          <th>Rasm</th>
                          <th>Amallar</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php foreach ($vazifalar as $vazifa) { ?>
                          <tr>
                            <td><?= $vazifa['title'] ?></td>
                            <td><?= $vazifa['description'] ?></td>
                            <td>
                              <img src="<?php echo "rasm/" . $vazifa['img'] ?>" alt="" width="100px">
                            </td>
                            <td>
                              <form action="/user" method="post">
                                <input type="hidden" name="task_id" value="<?= $vazifa['id'] ?>">
                                <button type="submit" name="bajar" class="btn btn-success">Bajarish</button>
                              </form>
                            </td>
                          </tr>
                        <?php } ?>
                      </tbody>
                    </table>
                  <?php } else { ?>
                    <p>Hozirda bajarish uchun topshiriq mavjud emas!</p>
                  <?php } ?>
                </div>
                <?php
                if (isset($_POST['bajar'])) {
                  $task_id = $_POST['task_id'];
                  $data = ['status' => '3'];
                  Task::update($data, $task_id);
                  header("location: /user");
                }
                ?>
              </div>
              <div class="card card-light card-outline">
                <div class="card-header">
                  <div class="card-tools">
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="card card-row card-secondary">
            <div class="card-header">
              <h3 class="card-title">
                Yakun
              </h3>
            </div>
            <div class="card-body">
              <div class="card card-info card-outline">
                <div class="card-header">
                  <h1></h1>
                  <?php
                  $vazifalar = Task::gettask($_SESSION['Auth']->id, 3);
                  if (!empty($vazifalar)) { ?>
                    <table class="table">
                      <thead>
                        <tr>
                          <th>Title</th>
                          <th>Description</th>
                          <th>Rasm</th>
                          <th>Amallar</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php foreach ($vazifalar as $vazifa) { ?>
                          <tr>
                            <td><?= $vazifa['title'] ?></td>
                            <td><?= $vazifa['description'] ?></td>
                            <td>
                              <img src="<?php echo "rasm/" . $vazifa['img'] ?>" alt="" width="100px">
                            </td>
                            <td>
                              <form action="/user" method="post">
                                <input type="hidden" name="task_id" value="<?= $vazifa['id'] ?>">
                                <button type="submit" name="topshir" class="btn btn-success">Tugallash</button>
                              </form>
                            </td>
                          </tr>
                        <?php } ?>
                      </tbody>
                    </table>
                  <?php } else { ?>
                    <p>Hozirda yakunlash uchun topshiriq mavjud emas!</p>
                  <?php } ?>
                </div>
                <?php
                if (isset($_POST['topshir'])) {
                  $task_id = $_POST['task_id'];
                  $data = ['status' => '4'];
                  Task::update($data, $task_id);
                  header("location: /user");
                }
                ?>
              </div>
              <div class="card card-light card-outline">
                <div class="card-header">
                  <div class="card-tools">
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="card card-row card-secondary">
            <div class="card-header">
              <h3 class="card-title">
                Done
              </h3>
            </div>
            <div class="card-body">
              <div class="card card-info card-outline">
                <div class="card-header">
                  <h1></h1>
                  <?php
                  $vazifalar = Task::gettask($_SESSION['Auth']->id, 4);
                  if (!empty($vazifalar)) { ?>
                    <table class="table">
                      <thead>
                        <tr>
                          <th>Title</th>
                          <th>Description</th>
                          <th>Rasm</th>
                          <th>Amallar</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php foreach ($vazifalar as $vazifa) { ?>
                          <tr>
                            <td><?= $vazifa['title'] ?></td>
                            <td><?= $vazifa['description'] ?></td>
                            <td>
                              <img src="<?php echo "rasm/" . $vazifa['img'] ?>" alt="" width="100px">
                            </td>
                            <td>
                              <form action="/user" method="post">
                                <input type="hidden" name="task_id" value="<?= $vazifa['id'] ?>">
                                <button type="submit" name="yakun" class="btn btn-success">Tekshirilmoqda...</button>
                              </form>
                            </td>
                          </tr>
                        <?php } ?>
                      </tbody>
                    </table>
                  <?php } else { ?>
                    <p>Ma'lumot mavjud emas!</p>
                  <?php } ?>
                </div>
                <?php
                if (isset($_POST['yakun'])) {
                  $task_id = $_POST['task_id'];
                  $data = ['status' => '4'];
                  Task::update($data, $task_id);
                  header("location: /user");
                }
                ?>
              </div>
              <div class="card card-light card-outline">
                <div class="card-header">
                  <div class="card-tools">
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