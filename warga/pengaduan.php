<?php
session_start();
include '../connection/connection.php';

/* ===============================
   CEK LOGIN
================================ */
if (!isset($_SESSION['id_pengguna'])) {
  header("Location: ../login.php");
  exit;
}

$id_pengguna = $_SESSION['id_pengguna'];

/* ===============================
   AMBIL NAMA USER
================================ */
$user = mysqli_fetch_assoc(
  mysqli_query($koneksi, "SELECT nama FROM tb_pengguna WHERE id_pengguna='$id_pengguna'")
);
$nama = $user['nama'] ?? '';

/* ===============================
   PROSES KIRIM LAPORAN
================================ */
if (isset($_POST['kirim'])) {
  $lokasi    = mysqli_real_escape_string($koneksi, $_POST['lokasi']);
  $tanggal   = mysqli_real_escape_string($koneksi, $_POST['tanggal']);
  $deskripsi = mysqli_real_escape_string($koneksi, $_POST['deskripsi']);

  $insert = mysqli_query($koneksi, "
    INSERT INTO tb_pengaduan_insiden
    (id_pengguna, nama, lokasi, tanggal, deskripsi, status)
    VALUES
    ('$id_pengguna','$nama','$lokasi','$tanggal','$deskripsi','diproses')
  ");

  if ($insert) {
    $_SESSION['success'] = "Laporan berhasil dikirim";
    header("Location: pengaduan.php");
    exit;
  }
}

/* ===============================
   DATA LAPORAN
================================ */
$laporan = mysqli_query($koneksi, "
  SELECT * FROM tb_pengaduan_insiden
  WHERE id_pengguna='$id_pengguna'
  ORDER BY id_pengaduan DESC
");
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <meta name="description" content="" />
  <meta name="author" content="" />
  <title>Form Pengaduan</title>
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

          <!-- ALERT SUKSES -->
          <?php if (isset($_SESSION['success'])): ?>
            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
            <script>
              Swal.fire('Berhasil!', '<?= $_SESSION['success'] ?>', 'success');
            </script>
          <?php unset($_SESSION['success']);
          endif; ?>

          <div class="container mt-4">
            <div class="card shadow rounded-3">
              <div class="card-body">
                <h4 class="text-center mb-4">Laporkan Insiden Ronda Anda</h4>
                <p class="text-center text-muted mb-4">
                  Sampaikan laporan insiden yang terjadi di lingkungan Anda. Data Anda akan kami jaga kerahasiaannya.
                </p>

                <form method="POST">
                  <div class="mb-3">
                    <label>Lokasi Kejadian</label>
                    <input type="text" name="lokasi" class="form-control" required>
                  </div>

                  <div class="mb-3">
                    <label>Tanggal Kejadian</label>
                    <input type="date" name="tanggal" class="form-control" required>
                  </div>

                  <div class="mb-3">
                    <label>Deskripsi Insiden</label>
                    <textarea name="deskripsi" class="form-control" rows="4" required></textarea>
                  </div>

                  <div class="text-end">
                    <button name="kirim" class="btn btn-primary">
                      <i class="fa-solid fa-paper-plane"></i> Kirim Laporan
                    </button>
                  </div>
                </form>
              </div>
            </div>

            <!-- TABEL -->
            <div class="card shadow mt-3">
              <div class="card-body">
                <table class="table table-hover text-center">
                  <thead class="table-light">
                    <tr>
                      <th>No</th>
                      <th>Tanggal</th>
                      <th>Status</th>
                      <th>Aksi</th>
                    </tr>
                  </thead>

                  <tbody>
                    <?php
                    $limit = 10;
                    $page  = isset($_GET['page']) ? (int)$_GET['page'] : 1;
                    $start = ($page - 1) * $limit;

                    $totalData = mysqli_fetch_assoc(
                      mysqli_query($koneksi, "SELECT COUNT(*) total FROM tb_pengaduan_insiden WHERE id_pengguna='$id_pengguna'")
                    )['total'];

                    $totalPage = ceil($totalData / $limit);
                    $laporan = mysqli_query($koneksi, "
                    SELECT * FROM tb_pengaduan_insiden
                    WHERE id_pengguna='$id_pengguna'
                    ORDER BY id_pengaduan DESC
                    LIMIT $start, $limit
                  ");
                    ?>

                    <?php if (mysqli_num_rows($laporan) > 0):
                      $no = 1;
                      while ($row = mysqli_fetch_assoc($laporan)): ?>
                        <tr>
                          <td><?= $no++ ?></td>
                          <td><?= date('d-m-Y', strtotime($row['tanggal'])) ?></td>
                          <td>
                            <?=
                            match ($row['status']) {
                              'diterima' => "<span class='badge bg-success'>Diterima</span>",
                              'ditolak'  => "<span class='badge bg-danger'>Ditolak</span>",
                              default    => "<span class='badge bg-warning text-dark'>Diproses</span>",
                            }
                            ?>
                          </td>
                          <td>
                            <button class="btn btn-primary btn-sm" data-bs-toggle="modal"
                              data-bs-target="#modal<?= $row['id_pengaduan'] ?>">
                              <i class="fa fa-eye"></i>
                            </button>
                          </td>
                        </tr>
                      <?php endwhile;
                    else: ?>
                      <tr>
                        <td colspan="4">Belum ada laporan</td>
                      </tr>
                    <?php endif; ?>
                  </tbody>
                </table>
                <nav>
                  <ul class="pagination justify-content-center">
                    <?php for ($i = 1; $i <= $totalPage; $i++): ?>
                      <li class="page-item <?= ($i == $page) ? 'active' : '' ?>">
                        <a class="page-link" href="?page=<?= $i ?>"><?= $i ?></a>
                      </li>
                    <?php endfor; ?>
                  </ul>
                </nav>

              </div>
            </div>


            <!-- MODAL DETAIL -->
            <?php
            mysqli_data_seek($laporan, 0);
            while ($row = mysqli_fetch_assoc($laporan)):
            ?>
              <div class="modal fade" id="modal<?= $row['id_pengaduan'] ?>">
                <div class="modal-dialog modal-dialog-centered">
                  <div class="modal-content">
                    <div class="modal-header bg-primary text-white">
                      <h5>Detail Pengaduan</h5>
                      <button class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                      <p><b>Lokasi:</b> <?= $row['lokasi'] ?></p>
                      <p><b>Tanggal:</b> <?= date('d-m-Y', strtotime($row['tanggal'])) ?></p>
                      <p><b>Status:</b> <?= ucfirst($row['status']) ?></p>
                      <p><b>Deskripsi:</b><br><?= $row['deskripsi'] ?></p>
                    </div>
                  </div>
                </div>
              </div>
            <?php endwhile; ?>


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
</body>

</html>