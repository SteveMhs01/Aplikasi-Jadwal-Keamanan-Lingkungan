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

<body class="sb-nav-fixed" style="background-color: #f8f0f0ff; ">
  <?php
  include 'sideandnav/navbar.php';
  include 'sideandnav/sidebar.php';
  ?>
  <div id="layoutSidenav">
    <div id="layoutSidenav_content">
      <main class="p-4">
        <div class="container-fluid px-4">
          <h1 class="mb-5 ">Dashboard</h1>
          <div class="row">
            <div class="col-xl-3 col-md-6">
              <div class="card mb-4">
                <div class="card-body shadow">Card</div>
              </div>
            </div>
            <div class="col-xl-3 col-md-6">
              <div class="card mb-4">
                <div class="card-body shadow">Card</div>
              </div>
            </div>
            <div class="col-xl-3 col-md-6">
              <div class="card mb-4">
                <div class="card-body shadow">Card</div>
              </div>
            </div>
            <div class="col-xl-3 col-md-6">
              <div class="card mb-4">
                <div class="card-body shadow">Card</div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-xl-6 ">
              <div class="card mb-4 shadow">
                <div class="card-header">
                  <i class="fas fa-chart-area me-1"></i>
                  Example
                </div>
                <div class="card-body"><canvas id="myAreaChart" width="100%" height="40"></canvas></div>
              </div>
            </div>
            <div class="col-xl-6">
              <div class="card mb-4 shadow">
                <div class="card-header">
                  <i class="fa-solid fa-chart-simple me-1"></i>
                  Grafik
                </div>
                <div class="card-body"><canvas id="myBarChart" width="100%" height="40"></canvas></div>
              </div>
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
            <div class="card-header">
              <i class="fas fa-table me-1"></i>
              DataTable Example
            </div>
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