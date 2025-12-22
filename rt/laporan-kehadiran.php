<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <meta name="description" content="" />
  <meta name="author" content="" />
  <title>LAPORAN KEHADIRAN</title>
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
          <div class="container mt-4">
            <div class="card shadow border-0">
              <div class="card-body">
                <h5 class="card-title mb-4">Data Kehadiran</h5>
                <form method="GET" class="row g-3 mb-4 align-items-end">
                  <div class="col-md-3">
                    <label class="form-label">Dari Tanggal</label>
                    <input type="date" name="tgl_dari" class="form-control"
                      value="<?= $_GET['tgl_dari'] ?? '' ?>">
                  </div>

                  <div class="col-md-3">
                    <label class="form-label">Sampai Tanggal</label>
                    <input type="date" name="tgl_sampai" class="form-control"
                      value="<?= $_GET['tgl_sampai'] ?? '' ?>">
                  </div>

                  <div class="col-md-3">
                    <button type="submit" class="btn btn-primary rounded-pill px-4">
                      <i class="fa-solid fa-filter"></i> Filter
                    </button>

                    <a href="export_excel.php?tgl_dari=<?= $_GET['tgl_dari'] ?? '' ?>&tgl_sampai=<?= $_GET['tgl_sampai'] ?? '' ?>"
                      class="btn btn-success rounded-pill px-4">
                      <i class="fa-solid fa-file-excel"></i> Excel
                    </a>
                  </div>
                </form>

                <div class="table-responsive">
                  <table class="table align-middle">
                    <thead class="table-light">
                      <tr>
                        <th>Nama</th>
                        <th>Status</th>
                        <th>Jam masuk</th>
                        <th>Keterangan</th>
                        <th>tanggal</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      include '../connection/connection.php';
                      $tgl_dari   = $_GET['tgl_dari'] ?? '';
                      $tgl_sampai = $_GET['tgl_sampai'] ?? '';

                      $where = "";
                      if (!empty($tgl_dari) && !empty($tgl_sampai)) {
                        $where = "WHERE a.tanggal BETWEEN '$tgl_dari' AND '$tgl_sampai'";
                      }
                      $limit = 4;
                      $page  = isset($_GET['page']) ? (int)$_GET['page'] : 1;
                      $page  = ($page < 1) ? 1 : $page;

                      $offset = ($page - 1) * $limit;
                      $countQuery = "
                        SELECT COUNT(*) AS total
                        FROM tb_absensi_detail ad
                        JOIN tb_absensi a ON ad.id_absensi = a.id_absensi
                        JOIN tb_pengguna p ON ad.id_pengguna = p.id_pengguna
                        $where
                      ";

                      $countResult = mysqli_query($koneksi, $countQuery);
                      $totalData   = mysqli_fetch_assoc($countResult)['total'];
                      $totalPage   = ceil($totalData / $limit);

                      $query = "
                        SELECT 
                            p.nama,
                            ad.status_absensi,
                            ad.jam_masuk,
                            a.keterangan,
                            a.tanggal
                        FROM tb_absensi_detail ad
                        JOIN tb_absensi a ON ad.id_absensi = a.id_absensi
                        JOIN tb_pengguna p ON ad.id_pengguna = p.id_pengguna
                        $where
                        ORDER BY a.tanggal DESC
                        LIMIT $limit OFFSET $offset
                      ";

                      $result = mysqli_query($koneksi, $query);

                      while ($row = mysqli_fetch_assoc($result)) {

                        $statusClass = match ($row['status_absensi']) {
                          'Hadir' => 'bg-success-subtle text-success',
                          'Izin'  => 'bg-warning-subtle text-warning',
                          'Sakit' => 'bg-info-subtle text-info',
                          default => 'bg-danger-subtle text-danger'
                        };
                      ?>
                        <tr>
                          <td><?= htmlspecialchars($row['nama']); ?></td>

                          <td>
                            <span class="badge <?= $statusClass ?> fw-semibold px-3 py-2 rounded-pill">
                              <?= $row['status_absensi']; ?>
                            </span>
                          </td>

                          <td>
                            <?php if ($row['jam_masuk']) : ?>
                              <span class="badge bg-success-subtle text-success">
                                <?= date('H:i', strtotime($row['jam_masuk'])); ?>
                              </span>
                            <?php else : ?>
                              <span class="badge bg-secondary-subtle text-secondary">-</span>
                            <?php endif; ?>
                          </td>

                          <td><?= htmlspecialchars($row['keterangan']); ?></td>

                          <td><?= date('d-m-Y', strtotime($row['tanggal'])); ?></td>
                        </tr>
                      <?php } ?>
                    </tbody>
                  </table>
                  <?php if ($totalPage > 1): ?>
                    <nav class="mt-4">
                      <ul class="pagination justify-content-center">

                        <!-- PREV -->
                        <li class="page-item <?= ($page <= 1) ? 'disabled' : '' ?>">
                          <a class="page-link"
                            href="?page=<?= $page - 1 ?>&tgl_dari=<?= $tgl_dari ?>&tgl_sampai=<?= $tgl_sampai ?>">
                            Previous
                          </a>
                        </li>

                        <!-- NUMBER -->
                        <?php for ($i = 1; $i <= $totalPage; $i++): ?>
                          <li class="page-item <?= ($page == $i) ? 'active' : '' ?>">
                            <a class="page-link"
                              href="?page=<?= $i ?>&tgl_dari=<?= $tgl_dari ?>&tgl_sampai=<?= $tgl_sampai ?>">
                              <?= $i ?>
                            </a>
                          </li>
                        <?php endfor; ?>

                        <!-- NEXT -->
                        <li class="page-item <?= ($page >= $totalPage) ? 'disabled' : '' ?>">
                          <a class="page-link"
                            href="?page=<?= $page + 1 ?>&tgl_dari=<?= $tgl_dari ?>&tgl_sampai=<?= $tgl_sampai ?>">
                            Next
                          </a>
                        </li>

                      </ul>
                    </nav>
                  <?php endif; ?>

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