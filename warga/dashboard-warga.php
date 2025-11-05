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

</head>

<body class="sb-nav-fixed" style="background-color: #f8f0f0ff;">
  <?php
  include 'sideandnav/navbar.php';
  include 'sideandnav/sidebar.php';
  ?>
  <div id="layoutSidenav">
    <div id="layoutSidenav_content">
      <main class="p-4">
        <div class="container-fluid px-4">
          <h1 class="mb-4">Dashboard</h1>
          <div class="card mb-4 shadow text-white">
            <div class="card-body rounded-3" style="background: linear-gradient(160deg, #0f1724 0%, #4c1d95 40%, #e66465 70%, #45d0b6 100%);">
              <h3>Selamat Datang 😎</h3>
              <p>Informasi Keamanan Lingkungan</p>
            </div>
            <div class="col-xl-6 ms-auto">
              <div class="card mb-4 shadow">
                <div class="card-header">
                  <i class="fa-solid fa-chart-simple me-1"></i>
                  Grafik
                </div>
                <div class="card-body"><canvas id="myPieChart" width="100%" height="50"></canvas></div>
              </div>
            </div>
          </div>
 
          <div class="card mb-4 shadow">
            <div class="card-body">
              <h5 class="mb-3">📋 Jadwal Jaga Hari Ini</h5>
              <table class="table table-sm align-middle">
                <thead class="table-light">
                  <tr>
                    <th>Nama</th>
                    <th>Shift</th>
                    <th>Status</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>Aldo</td>
                    <td>Malam (22:00 - 02:00)</td>
                    <td><span class="badge text-success">Hadir</span></td>
                  </tr>
                  <tr>
                    <td>Bima</td>
                    <td>Malam (02:00 - 06:00)</td>
                    <td><span class="badge text-success">Hadir</span></td>
                  </tr>
                  <tr>
                    <td>Citra</td>
                    <td>Sore (18:00 - 22:00)</td>
                    <td><span class="badge text-danger">Tidak Hadir</span></td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
          
          <div class="row">
            <div class="col-xl-6">
              <div class="card mb-4 shadow">
                <div class="card-body">
                  <h6 class="mb-4"><i class="fas fa-chart-bar me-2"></i>Grafik</h6>
                  <canvas id="barChart" width="100%" height="50"></canvas>

                </div>
              </div>
            </div>
            <div class="col-xl-6 ms-auto">
              <div class="card mb-4 shadow">
                <div class="card-body">
                  <h6 class="mb-4"><i class="fas fa-chart-pie me-2"></i>Grafik</h6>
                  <canvas id="pieChart" width="100%" height="20"></canvas>
                </div>
              </div>
            </div>
          </div>
      </main>
    </div>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
  <script src="../js/scripts.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script src="../grafik/grafik-kehadiran.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
  <script type="text/javascript" src="../sweetalert/sweetalert2.all.min.js"></script>
</body>

</html>