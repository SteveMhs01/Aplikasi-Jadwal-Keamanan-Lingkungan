<?php

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <meta name="description" content="" />
  <meta name="author" content="" />
  <title>Dashboard</title>
  <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
  <link href="../css/styles.css" rel="stylesheet" />
  <link rel="stylesheet" href="sweetalert/sweetalert2.css">
  <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
  <style>
    .card {
      border-radius: 12px;
    }

    .card-body {
      padding: 1rem 1.25rem;
    }
  </style>
</head>

<body class="sb-nav-fixed" style="background-color: #f8f0f0ff; ">
  <?php
  include 'sideandnav/navbar.php';
  include 'sideandnav/sidebar.php';
  include '../connection/connection.php';
  
  ?>
  <div id="layoutSidenav">
    <div id="layoutSidenav_content">
      <main class="p-4">
        <div class="container-fluid px-4">
          <h1 class="mb-4">Dashboard</h1>
          <div class="card mb-4 shadow">
            <div class="card-body rounded-3" style="background:linear-gradient(135deg, #667EEA, #764BA2); color:white;">
              <h3>Selamat Datang</h3>
              <p>Informasi Keamanan Lingkungan</p>
            </div>
          </div>
          <div class="row g-3 mb-4">
            <!-- Card 1 -->
            <div class="col-xl-3 col-md-6">
              <div class="card shadow border-0">
                <div class="card-body d-flex align-items-center">
                  <div class="me-3">
                    <i class="fas fa-chart-bar fa-2x text-primary"></i>
                  </div>
                  <div>
                    <h4 class="mb-0 fw-bold">0</h4>
                    <p class="mb-0 text-muted small">Total Insiden</p>
                  </div>
                </div>
              </div>
            </div>

            <!-- Card 2 -->
            <div class="col-xl-3 col-md-6">
              <div class="card shadow border-0">
                <div class="card-body d-flex align-items-center">
                  <div class="me-3">
                    <i class="fas fa-check-circle fa-2x text-success"></i>
                  </div>
                  <div>
                    <h4 class="mb-0 fw-bold">0%</h4>
                    <p class="mb-0 text-muted small">Kehadiran Ronda</p>
                  </div>
                </div>
              </div>
            </div>

            <!-- Card 3 -->
            <div class="col-xl-3 col-md-6">
              <div class="card shadow border-0">
                <div class="card-body d-flex align-items-center">
                  <div class="me-3">
                    <i class="fas fa-users fa-2x text-info"></i>
                  </div>
                  <div>
                    <h4 class="mb-0 fw-bold">0</h4>
                    <p class="mb-0 text-muted small">Seluruh Warga</p>
                  </div>
                </div>
              </div>
            </div>

            <!-- Card 4 -->
            <div class="col-xl-3 col-md-6">
              <div class="card shadow border-0">
                <div class="card-body d-flex align-items-center">
                  <div class="me-3">
                    <i class="fas fa-search fa-2x text-danger"></i>
                  </div>
                  <div>
                    <h4 class="mb-0 fw-bold">0</h4>
                    <p class="mb-0 text-muted small">Laporan Perlu Validasi</p>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-xl-6 ">
              <div class="card mb-4 shadow">
                <div class="card-body">
                  <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Consequuntur neque delectus provident est ex laboriosam accusantium harum. Ipsa nisi beatae laboriosam officia, sunt iusto ex obcaecati consequatur dicta reiciendis eligendi nulla est rem sit eum? Accusantium voluptatem quae unde eaque nisi, aut necessitatibus asperiores voluptates officiis eos cum velit optio voluptate tempore ad animi natus mollitia omnis dicta consectetur sit a sequi nulla quas! Molestiae ducimus repellendus a! Reiciendis quas quam et possimus officiis nostrum eligendi? Similique officiis nemo culpa impedit veritatis voluptates commodi odio pariatur ipsum quibusdam accusantium temporibus porro et suscipit, fugit molestias, necessitatibus itaque alias sed quam!</p>
                </div>
              </div>
            </div>
            <div class="col-xl-6">
              <div class="card mb-4 shadow">
                <div class="card-body">
                 <h6 class="mb-4"><i class="fas fa-chart-bar me-2"></i>Grafik</h6>
                <canvas id="myBarChart" width="100%" height="40"></canvas></div>
              </div>
            </div>
            <div class="col-xl-6 ms-auto">
              <div class="card mb-4 shadow">
                <div class="card-body">
                  <h6 class="mb-4"><i class="fas fa-chart-pie me-2"></i>Grafik</h6>
                  <canvas id="myPieChart" width="100%" height="50"></canvas></div>
              </div>
            </div>
          </div>
          <div class="card mb-4 shadow">
            
            <div class="card-body">
              <table id="datatablesSimple">
                <thead>
                  <tr>

                  </tr>
                </thead>
                <tbody>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </main>
    </div>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
  <script src="../js/scripts.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
  <script src="../assets/demo/chart-bar-demo.js"></script>
  <script src="../assets/demo/chart-pie-demo.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
  <script type="text/javascript" src="../sweetalert/sweetalert2.all.min.js"></script>
</body>

</html>