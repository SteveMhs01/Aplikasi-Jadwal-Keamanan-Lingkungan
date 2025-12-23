<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <meta name="description" content="" />
  <meta name="author" content="" />
  <title>LAPORAN BULANAN</title>
  <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
  <link href="../css/styles.css" rel="stylesheet" />
  <link rel="stylesheet" href="sweetalert/sweetalert2.css">
  <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

</head>

<?php
include '../connection/connection.php';

// Filter bulan
$bulan = isset($_GET['bulan']) ? $_GET['bulan'] : '';

// WHERE condition
$where = "WHERE 1=1";

if ($bulan != '') {
  $where .= " AND MONTH(tanggal) = '$bulan'";
}


// === STATISTIK ===
$totalKehadiran = mysqli_fetch_assoc(mysqli_query(
  $koneksi,
  "SELECT COUNT(*) AS jml FROM tb_absensi $where"
))['jml'];

$totalLaporan = mysqli_fetch_assoc(mysqli_query(
  $koneksi,
  "SELECT COUNT(*) AS jml FROM tb_pengaduan_insiden $where"
))['jml'];

$selesai = mysqli_fetch_assoc(mysqli_query(
  $koneksi,
  "SELECT COUNT(*) AS jml FROM tb_pengaduan_insiden $where AND status='diterima'"
))['jml'];

$ditolak = mysqli_fetch_assoc(mysqli_query(
  $koneksi,
  "SELECT COUNT(*) AS jml FROM tb_pengaduan_insiden $where AND status='ditolak'"
))['jml'];

$proses = mysqli_fetch_assoc(mysqli_query(
  $koneksi,
  "SELECT COUNT(*) AS jml FROM tb_pengaduan_insiden $where AND status='diproses'"
))['jml'];


// === DATA TABEL ===
$dataLaporan = mysqli_query(
  $koneksi,
  "SELECT *,u.nama FROM tb_pengaduan_insiden p join tb_pengguna u ON p.id_pengguna = u.id_pengguna $where ORDER BY tanggal DESC LIMIT 10"
);

?>


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

            <!-- Filter Section  -->
            <form method="GET" class="row g-3 mb-4 align-items-end">
              <div class="col-md-3">
                <label class="form-label fw-semibold">Periode</label>
                <select name="bulan" class="form-select" onchange="this.form.submit()">
                  <option value="">Semua Bulan</option>
                  <?php
                  for ($i = 1; $i <= 12; $i++) {
                    $selected = ($bulan == str_pad($i, 2, '0', STR_PAD_LEFT)) ? 'selected' : '';
                    echo "<option value='" . str_pad($i, 2, '0', STR_PAD_LEFT) . "' $selected>
                      " . date('F', mktime(0, 0, 0, $i, 1)) . "
                      </option>";
                  }
                  ?>
                </select>
              </div>
            </form>


            <!-- Statistik Cards -->
            <div class="row g-3 mb-4">
              <?php
              $cards = [
                ['Total Kehadiran', $totalKehadiran, 'warning'],
                ['Total Laporan', $totalLaporan, 'primary'],
                ['Ditolak', $ditolak, 'danger'],
                ['Selesai', $selesai, 'success']
              ];

              foreach ($cards as $c) {
                echo "
                <div class='col-md-3'>
                  <div class='card text-center p-3 shadow'>
                    <h6 class='text-muted'>{$c[0]}</h6>
                    <h3 class='fw-bold text-{$c[2]}'>{$c[1]}</h3>
                  </div>
                </div>";
              }
              ?>
            </div>


            <!-- Tabel -->
            <div class="card mb-4 p-3 shadow">
              <h6 class="fw-semibold mb-3">Data Insiden Terbaru</h6>

              <div class="table-responsive">
                <table class="table table-hover align-middle">
                  <thead class="table-light">
                    <tr>
                      <th>Nama Pelapor</th>
                      <th>Tanggal</th>
                      <th>Status</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php while ($row = mysqli_fetch_assoc($dataLaporan)) { ?>
                      <tr>
                        <td><?= $row['nama'] ?></td>
                        <td><?= date('d M Y', strtotime($row['tanggal'])) ?></td>
                        <?php
                        $badgeClass = match ($row['status']) {
                          'diterima' => 'bg-success',
                          'ditolak'  => 'bg-danger',
                          default    => 'bg-warning text-dark',
                        };
                        ?>
                        <td>
                          <span class="badge <?= $badgeClass ?>">
                            <?= ucfirst($row['status']) ?>
                          </span>
                        </td>
                      </tr>
                    <?php } ?>
                  </tbody>
                </table>
              </div>
            </div>

            <!-- Grafik Laporan -->
            <div class="row g-4">
              <div class="col-md-8">
                <div class="card p-3 shadow">
                  <h6 class="fw-semibold mb-3">Chart Insiden</h6>
                  <canvas id="barChart" width="100%" height="40"></canvas>
                </div>
              </div>
              <div class="col-md-4">
                <div class="card p-3 shadow">
                  <h6 class="fw-semibold mb-3">Distribusi Jenis Laporan</h6>
                  <canvas id="pieChart" width="100%" height="87"></canvas>
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
  <script type="text/javascript" src="../sweetalert/sweetalert2.all.min.js"></script>

  <?php
  $bulanData = [
    1 => 0,
    2 => 0,
    3 => 0,
    4 => 0,
    5 => 0,
    6 => 0,
    7 => 0,
    8 => 0,
    9 => 0,
    10 => 0,
    11 => 0,
    12 => 0
  ];

  $laporanBulanan = array_fill(1, 12, 0);
  $absensiBulanan  = array_fill(1, 12, 0);

  // Data laporan insiden
  $q = mysqli_query($koneksi, "
  SELECT MONTH(tanggal) AS bulan, COUNT(*) AS total
  FROM tb_pengaduan_insiden
  GROUP BY MONTH(tanggal)
");

  while ($row = mysqli_fetch_assoc($q)) {
    $laporanBulanan[(int)$row['bulan']] = (int)$row['total'];
  }

  // Data absensi
  $i = mysqli_query($koneksi, "
  SELECT MONTH(tanggal) AS bulan, COUNT(*) AS total
  FROM tb_absensi
  GROUP BY MONTH(tanggal)
");

  while ($row = mysqli_fetch_assoc($i)) {
    $absensiBulanan[(int)$row['bulan']] = (int)$row['total'];
  }

  ?>

  <script>
    // Laporan Grafik Bar
    const bar = document.getElementById("barChart");

    new Chart(bar, {
      type: "bar",
      data: {
        labels: [
          "Januari", "Februari", "Maret", "April", "Mei", "Juni",
          "Juli", "Agustus", "September", "Oktober", "November", "Desember"
        ],
        datasets: [{
          label: "Jumlah Laporan",
          data: <?= json_encode(array_values($laporanBulanan)) ?>,
          backgroundColor: [
            "rgba(255, 99, 132, 0.2)",
            "rgba(255, 159, 64, 0.2)",
            "rgba(75, 192, 192, 0.2)",
            "rgba(54, 162, 235, 0.2)",
            "rgba(153, 102, 255, 0.2)",
            "rgba(201, 203, 207, 0.2)",
            "rgba(255, 99, 132, 0.2)",
            "rgba(255, 159, 64, 0.2)",
            "rgba(255, 205, 86, 0.2)",
            "rgba(75, 192, 192, 0.2)",
            "rgba(54, 162, 235, 0.2)",
            "rgba(153, 102, 255, 0.2)",
          ],
          borderColor: [
            "rgb(255, 99, 132)",
            "rgb(255, 159, 64)",
            "rgb(255, 205, 86)",
            "rgb(75, 192, 192)",
            "rgb(54, 162, 235)",
            "rgb(153, 102, 255)",
            "rgb(201, 203, 207)",
            "rgb(255, 99, 132)",
            "rgb(255, 159, 64)",
            "rgb(255, 205, 86)",
            "rgb(75, 192, 192)",
            "rgb(54, 162, 235)",
          ],
          borderWidth: 2
        }]
      },
      options: {
        scales: {
          y: {
            beginAtZero: true
          }
        }
      }
    });

    // Laporan Grafik Pie
    const pie = document.getElementById("pieChart");

    new Chart(pie, {
      type: "doughnut",
      data: {
        labels: ["Total Kehadiran", "Total Laporan", "Laporan Ditolak", "Laporan Selesai"],
        datasets: [{
          data: [
            <?= $totalKehadiran ?>,
            <?= $totalLaporan ?>,
            <?= $ditolak ?>,
            <?= $selesai ?>
          ],
          backgroundColor: [
            "rgba(255, 159, 64, 0.2)",
            "rgba(54, 162, 235, 0.2)",
            "rgba(255, 99, 132, 0.2)",
            "rgba(50, 240, 7, 0.2)"
          ],
          borderColor: [
            "rgba(255, 159, 64, 1)",
            "rgb(54, 162, 235)",
            "rgba(255, 99, 132, 1)",
            "rgba(50, 240, 7, 1)"
          ],
          hoverOffset: 4,
          borderWidth: 2
        }]
      }
    });
  </script>

</body>


</html>