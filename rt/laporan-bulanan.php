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
          <h1 class="mb-4">Rekap Laporan Bulanan</h1>
          <div class="container-fluid p-4">
            <!-- Filter Section -->
            <div class="row g-3 mb-4 align-items-end">
              <div class="col-md-3">
                <label class="form-label fw-semibold">Periode</label>
                <select class="form-select">
                  <option>Bulan Ini</option>
                  <option>Bulan Lalu</option>
                  <option>Tahun Ini</option>
                </select>
              </div>
              <div class="col-md-3">
                <label class="form-label fw-semibold">Jenis Insiden</label>
                <select class="form-select">
                  <option>Semua Jenis</option>
                  <option>Kriminal</option>
                  <option>Laporan</option>
                </select>
              </div>
              <div class="col-md-3">
                <label class="form-label fw-semibold">Status</label>
                <select class="form-select">
                  <option>Semua Status</option>
                  <option>Selesai</option>
                  <option>Proses</option>
                  <option>Pending</option>
                </select>
              </div>
              <div class="col-md-3 text-end">
                <button class="btn btn-primary">Terapkan Filter</button>
                <button class="btn btn-outline-secondary">Reset</button>
              </div>
            </div>

            <!-- Statistik Cards -->
            <div class="row g-3 mb-4">
              <div class="col-md-3">
                <div class="card stat-card text-center p-3">
                  <div class="card-body">
                    <i class="bi bi-flag fs-3 text-primary"></i>
                    <h6 class="mt-2 mb-1 text-muted">Total Insiden</h6>
                    <h3 class="fw-bold">0</h3>
                    <small class="text-danger">-0% dari bulan lalu</small>
                  </div>
                </div>
              </div>
              <div class="col-md-3">
                <div class="card stat-card text-center p-3">
                  <div class="card-body">
                    <i class="bi bi-exclamation-triangle fs-3 text-danger"></i>
                    <h6 class="mt-2 mb-1 text-muted">Insiden Kriminal</h6>
                    <h3 class="fw-bold">0</h3>
                    <small class="text-danger">-0% dari bulan lalu</small>
                  </div>
                </div>
              </div>
              <div class="col-md-3">
                <div class="card stat-card text-center p-3">
                  <div class="card-body">
                    <i class="bi bi-clipboard fs-3 text-warning"></i>
                    <h6 class="mt-2 mb-1 text-muted">Laporan</h6>
                    <h3 class="fw-bold">0</h3>
                    <small class="text-success">0% dari bulan lalu</small>
                  </div>
                </div>
              </div>
              <div class="col-md-3">
                <div class="card stat-card text-center p-3">
                  <div class="card-body">
                    <i class="bi bi-check2-circle fs-3 text-success"></i>
                    <h6 class="mt-2 mb-1 text-muted">Selesai</h6>
                    <h3 class="fw-bold">0</h3>
                    <small class="text-danger">-0% dari bulan lalu</small>
                  </div>
                </div>
              </div>
            </div>

            <!-- Grafik -->
            <div class="row g-4">
              <div class="col-md-8">
                <div class="card p-3">
                  <h6 class="fw-semibold mb-3">Insiden 6 Bulan Terakhir</h6>
                  <canvas id="barChart" width="100%" height="40"></canvas>
                </div>
              </div>
              <div class="col-md-4">
                <div class="card p-3">
                  <h6 class="fw-semibold mb-3">Distribusi Jenis Insiden</h6>
                  <canvas id="pieChart" width="100%" height="87"></canvas>
                </div>
              </div>
            </div>

            <!-- Tabel -->
            <div class="card mt-4 p-3">
              <h6 class="fw-semibold mb-3">Data Insiden Terbaru</h6>
              <div class="table-responsive">
                <table class="table align-middle">
                  <thead class="table-light">
                    <tr>
                      <th>Tanggal</th>
                      <th>Jenis Insiden</th>
                      <th>Pelapor</th>
                      <th>Status</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>15 Jan 2024</td>
                      <td><span class="badge badge-soft-danger">Kriminal</span></td>
                      <td>Nama</td>
                      <td><span class="badge badge-soft-success">Selesai</span></td>
                    </tr>
                    <tr>
                      <td>13 Jan 2024</td>
                      <td><span class="badge badge-soft-primary">Laporan</span></td>
                      <td>Nama</td>
                      <td><span class="badge badge-soft-primary">Proses</span></td>
                    </tr>
                    <tr>
                      <td>12 Jan 2024</td>
                      <td><span class="badge badge-soft-warning">Lainnya</span></td>
                      <td>Nama</td>
                      <td><span class="badge badge-soft-warning">Pending</span></td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>

        </div>
      </main>
    </div>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
  <script src="../grafik/grafik-kehadiran.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
  <script type="text/javascript" src="../sweetalert/sweetalert2.all.min.js"></script>
</body>
  

</html>