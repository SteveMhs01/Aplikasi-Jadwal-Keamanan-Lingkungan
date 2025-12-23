<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <meta name="description" content="" />
  <meta name="author" content="" />
  <title>Dashboard RT</title>
  <link href="../css/styles.css" rel="stylesheet" />
  <link rel="stylesheet" href="sweetalert/sweetalert2.css">
  <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body class="sb-nav-fixed" style="background-color: #f9f6f6; ">
  <?php
  include("../cek-login.php");
  cekRole("sekuriti");
  include '../connection/connection.php';
  include 'sideandnav/navbar.php';
  include 'sideandnav/sidebar.php';

  /* ===============================
   DATA BULANAN (BAR CHART)
================================ */

  // laporan per bulan
  $laporanBulanan = array_fill(1, 12, 0);

  $qLaporan = mysqli_query($koneksi, "
  SELECT MONTH(tanggal) AS bulan, COUNT(*) AS total
  FROM tb_pengaduan_insiden
  GROUP BY MONTH(tanggal)
");

  while ($row = mysqli_fetch_assoc($qLaporan)) {
    $laporanBulanan[(int)$row['bulan']] = (int)$row['total'];
  }

  /* ===============================
   DATA PIE CHART
================================ */

  // Total laporan
  $qTotalLaporan = mysqli_query($koneksi, "SELECT COUNT(*) total FROM tb_pengaduan_insiden");
  $totalLaporan = mysqli_fetch_assoc($qTotalLaporan)['total'];

  // Total kehadiran (HADIR saja)
  $qKehadiran = mysqli_query($koneksi, "
  SELECT COUNT(*) total 
  FROM tb_absensi 
  WHERE keterangan = 'Hadir'
");
  $totalKehadiran = mysqli_fetch_assoc($qKehadiran)['total'];

  // Total laporan ditolak
  $qDitolak = mysqli_query($koneksi, "
  SELECT COUNT(*) total 
  FROM tb_pengaduan_insiden 
  WHERE status = 'Ditolak'
");
  $ditolak = mysqli_fetch_assoc($qDitolak)['total'];

  // Total laporan selesai
  $qSelesai = mysqli_query($koneksi, "
  SELECT COUNT(*) total 
  FROM tb_pengaduan_insiden 
  WHERE status = 'Valid'
");
  $selesai = mysqli_fetch_assoc($qSelesai)['total'];

  // Total laporan
  $qTotalLaporan = mysqli_query($koneksi, "SELECT COUNT(*) AS total FROM tb_pengaduan_insiden");
  $totalLaporan  = mysqli_fetch_assoc($qTotalLaporan)['total'];

  // Laporan menunggu validasi
  $qMenunggu = mysqli_query($koneksi, "SELECT COUNT(*) AS total FROM tb_pengaduan_insiden WHERE status='diproses'");
  $menunggu  = mysqli_fetch_assoc($qMenunggu)['total'];

  // Laporan valid / selesai
  $qSelesai = mysqli_query($koneksi, "SELECT COUNT(*) AS total FROM tb_pengaduan_insiden WHERE status='diterima'");
  $selesai  = mysqli_fetch_assoc($qSelesai)['total'];

  // Total warga
  $qWarga = mysqli_query($koneksi, "SELECT COUNT(*) AS total FROM tb_pengguna WHERE role='warga'");
  $totalWarga = mysqli_fetch_assoc($qWarga)['total'];

  // Kehadiran ronda (%)
  $qHadir = mysqli_query($koneksi, "SELECT COUNT(*) AS total FROM tb_absensi WHERE keterangan='hadir'");
  $hadir = mysqli_fetch_assoc($qHadir)['total'];

  $qTotalAbsensi = mysqli_query($koneksi, "SELECT COUNT(*) AS total FROM tb_absensi");
  $totalAbsensi = mysqli_fetch_assoc($qTotalAbsensi)['total'];

  $persenHadir = $totalAbsensi > 0 ? round(($hadir / $totalAbsensi) * 100) : 0;

  ?>
  <div id="layoutSidenav">
    <div id="layoutSidenav_content">
      <main class="p-4">
        <div class="container-fluid px-4">
          <h1 class="mb-4">Dashboard</h1>
          <div class="card mb-4 shadow text-white">
            <div class="card-body rounded-3" style="background: linear-gradient(160deg, #0f1724 0%, #4c1d95 40%, #e66465 70%, #45d0b6 100%);">
              <h3>Selamat Datang, <?php echo htmlspecialchars($_SESSION['nama']); ?> 😎</h3>
              <p>Informasi Keamanan Lingkungan</p>
            </div>
          </div>
          <div class="row g-3 mb-4">


            <div class="">
              <div class="card mb-4 shadow">
                <div class="card-body">
                  <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Consequuntur neque delectus provident est ex laboriosam accusantium harum. Ipsa nisi beatae laboriosam officia, sunt iusto ex obcaecati consequatur dicta reiciendis eligendi nulla est rem sit eum? Accusantium voluptatem quae unde eaque nisi, aut necessitatibus asperiores voluptates officiis eos cum velit optio voluptate tempore ad animi natus mollitia omnis dicta consectetur sit a sequi nulla quas! Molestiae ducimus repellendus a! Reiciendis quas quam et possimus officiis nostrum eligendi? Similique officiis nemo culpa impedit veritatis voluptates commodi odio pariatur ipsum quibusdam accusantium temporibus porro et suscipit, fugit molestias, necessitatibus itaque alias sed quam!</p>
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
            <div class="row g-4">
              <div class="col-md-8">
                <div class="card p-3 shadow">
                  <h6 class="fw-semibold mb-3">Insiden 6 Bulan Terakhir</h6>
                  <canvas id="barChart" width="100%" height="40"></canvas>
                </div>
              </div>
              <div class="col-md-4">
                <div class="card p-3 shadow">
                  <h6 class="fw-semibold mb-3">Distribusi Jenis Insiden</h6>
                  <canvas id="pieChart" width="100%" height="87"></canvas>
                </div>
              </div>
            </div>
      </main>
    </div>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
  <script src="../js/scripts.js"></script>
  <script type="text/javascript" src="../sweetalert/sweetalert2.all.min.js"></script>
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

    // Grafik Laporan Pie
    const pie = document.getElementById("pieChart");

    new Chart(pie, {
      type: "doughnut",
      data: {
        labels: [
          "Total Kehadiran",
          "Total Laporan",
          "Laporan Ditolak",
          "Laporan Selesai"
        ],
        datasets: [{
          data: [
            <?= $totalKehadiran ?>,
            <?= $totalLaporan ?>,
            <?= $ditolak ?>,
            <?= $selesai ?>
          ],
          backgroundColor: [
            "rgba(255, 159, 64, 0.4)",
            "rgba(54, 162, 235, 0.4)",
            "rgba(255, 99, 132, 0.4)",
            "rgba(50, 240, 7, 0.4)"
          ],
          borderColor: [
            "rgb(255, 159, 64)",
            "rgb(54, 162, 235)",
            "rgb(255, 99, 132)",
            "rgb(50, 240, 7)"
          ],
          borderWidth: 2,
          hoverOffset: 10
        }]
      },
    });
  </script>
</body>

</html>