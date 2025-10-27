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
          <h1 class="mb-4">Rekap Laporan Kehadiran</h1>
          <div class="card shadow border-0">
            <div class="card-body">

            </div> 
          </div>
          <div class="container mt-4">
            <div class="card shadow border-0">
              <div class="card-body">
                <h5 class="card-title mb-4">Data Kehadiran</h5>
                <div class="table-responsive">
                  <table class="table align-middle">
                    <thead class="table-light">
                      <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Status</th>
                        <th>Waktu Hadir</th>
                        <th>Keterangan</th>
                        <th class="text-center">Aksi</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td>1</td>
                        <td>Nama</td>
                        <td><span class="badge bg-success-subtle text-success fw-semibold px-3 py-2 rounded-pill">Hadir</span></td>
                        <td><span class="badge bg-success-subtle text-success">19:05</span></td>
                        <td>Hadir tepat waktu</td>
                        <td class="text-center"><button class="btn btn-primary btn-sm rounded-pill px-3">Edit</button></td>
                      </tr>
                      <tr>
                        <td>2</td>
                        <td>Nama</td>
                        <td><span class="badge bg-success-subtle text-success fw-semibold px-3 py-2 rounded-pill">Hadir</span></td>
                        <td><span class="badge bg-success-subtle text-success">19:25</span></td>
                        <td>Hadir</td>
                        <td class="text-center"><button class="btn btn-primary btn-sm rounded-pill px-3">Edit</button></td>
                      </tr>
                      <tr>
                        <td>3</td>
                        <td>Nama</td>
                        <td><span class="badge bg-danger-subtle text-danger fw-semibold px-3 py-2 rounded-pill">Tidak Hadir</span></td>
                        <td>-</td>
                        <td>Tidak Hadir</td>
                        <td class="text-center"><button class="btn btn-primary btn-sm rounded-pill px-3"><i class="fa-solid fa-pen"></i></button></td>
                      </tr>
                      <tr>
                        <td>4</td>
                        <td>Nama</td>
                        <td><span class="badge bg-success-subtle text-success fw-semibold px-3 py-2 rounded-pill">Hadir</span></td>
                        <td><span class="badge bg-success-subtle text-success">18:00</span></td>
                        <td>Hadir tepat waktu</td>
                        <td class="text-center"><button class="btn btn-primary btn-sm rounded-pill px-3">Edit</button></td>
                      </tr>
                      <tr>
                        <td>5</td>
                        <td>Nama</td>
                        <td><span class="badge bg-secondary-subtle text-secondary fw-semibold px-3 py-2 rounded-pill">Belum Dilaporkan</span></td>
                        <td>-</td>
                        <td>Belum melapor</td>
                        <td class="text-center"><button class="btn btn-primary btn-sm rounded-pill px-3">Edit</button></td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
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
  <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
  <script type="text/javascript" src="../sweetalert/sweetalert2.all.min.js"></script>
</body>

</html>