<?php
include '../connection/connection.php';
session_start();

// Pastikan pengguna login (sesuaikan sesuai struktur login Anda)
$id_pengguna = $_SESSION['id_pengguna'] ?? null;

if (isset($_POST['kirim'])) {

  // Ambil data input
  $lokasi = mysqli_real_escape_string($koneksi, $_POST['lokasi']);
  $tanggal = mysqli_real_escape_string($koneksi, $_POST['tanggal']);
  $deskripsi = mysqli_real_escape_string($koneksi, $_POST['deskripsi']);

  // Validasi pengguna login
  if (!$id_pengguna) {
    echo "<script>
                alert('Anda harus login untuk melaporkan insiden.');
                window.location.href = '../login.php';
              </script>";
    exit;
  }

  // Insert ke tabel pengaduan utama
  $query_pengaduan = "
        INSERT INTO tb_pengaduan_insiden (id_pengguna, lokasi, tanggal, deskripsi, status)
        VALUES ('$id_pengguna', '$lokasi', '$tanggal', '$deskripsi', 'Menunggu Validasi')
    ";

  if (mysqli_query($koneksi, $query_pengaduan)) {

    // Ambil id_pengaduan terakhir
    $id_pengaduan = mysqli_insert_id($koneksi);

    // SweetAlert sukses
    echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
              <script>
                Swal.fire({
                  title: 'Berhasil!',
                  text: 'Laporan insiden Anda berhasil dikirim.',
                  icon: 'success',
                  confirmButtonText: 'OK'
                }).then(() => {
                  window.location.href = 'pengaduan.php';
                });
              </script>";
    exit;
  } else {

    // SweetAlert gagal
    echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
              <script>
                Swal.fire({
                  title: 'Gagal!',
                  text: 'Terjadi kesalahan saat mengirim laporan.',
                  icon: 'error',
                  confirmButtonText: 'OK'
                });
              </script>";
  }
}
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
  <!-- data tables -->
  <link rel="stylesheet" href="https://cdn.datatables.net/2.0.3/css/dataTables.bootstrap5.css">


</head>

<body class="sb-nav-fixed" style="background-color: #f8f0f0ff;">
  <?php
  include 'sideandnav/navbar.php';
  include 'sideandnav/sidebar.php';
  include '../connection/connection.php';

  ?>
  <div id="layoutSidenav">
    <div id="layoutSidenav_content">
      <main class="p-4">
        <div class="container-fluid px-4">
          <div class="container mt-4">
            <div class="card shadow rounded-3">
              <div class="card-body">
                <h4 class="text-center mb-4">Laporkan Insiden Ronda Anda</h4>
                <p class="text-center text-muted mb-4">
                  Sampaikan laporan insiden yang terjadi di lingkungan Anda. Data Anda akan kami jaga kerahasiaannya.
                </p>

                <form method="POST" action="">


                  <!-- Lokasi -->
                  <div class="form-group mb-3">
                    <label for="lokasi" class="form-label">Lokasi Kejadian</label>
                    <input type="text" class="form-control" id="lokasi" name="lokasi"
                      placeholder="Contoh: Jl. Merdeka No. 123, Depan SDN 1..." required>
                  </div>

                  <!-- Tanggal Kejadian -->
                  <div class="row mb-3">
                    <div class="col-md-6">
                      <label for="tanggal" class="form-label">Tanggal Kejadian</label>
                      <input type="date" class="form-control" id="tanggal" name="tanggal" required>
                    </div>

                  </div>

                  <!-- Deskripsi -->
                  <div class="form-group mb-3">
                    <label for="deskripsi" class="form-label">Deskripsi Insiden</label>
                    <textarea class="form-control" id="deskripsi" name="deskripsi" rows="4"
                      placeholder="Jelaskan secara detail kejadian, pihak yang terlibat, dan kondisi saat ini..."
                      required></textarea>
                  </div>

                  <!-- Tombol -->
                  <div class="d-flex justify-content-end mt-4">
                    <button type="submit" name="kirim" class="btn btn-primary">
                      <i class="bi bi-send"></i> Kirim Laporan
                    </button>
                  </div>
                </form>
              </div>
            </div>
            <div class="card shadow rounded-3 mt-3">
              <div class="card-body">


                <!-- Tabel Pengaduan -->
                <div class="table-responsive">
                  <table class="table table-borderedless table-hover align-middle">
                    <thead class="table-light text-center">
                      <tr>
                        <th>No</th>
                        <th>Tanggal</th>
                        <th>Status Laporan</th>
                        <th>Aksi</th>
                      </tr>
                    </thead>
                    <tbody class="text-center">
                      <?php
                      $id_pengguna = $_SESSION['id_pengguna']; // dari session login
                      $no = 1;

                      $query = "SELECT * FROM tb_pengaduan_insiden WHERE id_pengguna = '$id_pengguna' ORDER BY id_pengaduan DESC";
                      $result = mysqli_query($koneksi, $query);

                      if (mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {

                          // Format tanggal
                          $tanggal = date("d-m-Y", strtotime($row['tanggal']));

                          // Badge status
                          $status = $row['status'];
                          $badge = "";

                          if ($status == "Ditolak") {
                            $badge = "<span class='badge badge-soft text-danger'><i class='fa-solid fa-xmark me-1'></i>Ditolak</span>";
                          } elseif ($status == "Menunggu Validasi") {
                            $badge = "<span class='badge badge-soft text-primary'><i class='fa-solid fa-clock me-1'></i>Menunggu Validasi</span>";
                          } elseif ($status == "Diproses") {
                            $badge = "<span class='badge badge-soft text-warning'><i class='fa-solid fa-spinner me-1'></i>Diproses</span>";
                          } elseif ($status == "Disetujui") {
                            $badge = "<span class='badge badge-soft text-success'><i class='fa-solid fa-check me-1'></i>Disetujui</span>";
                          }

                      ?>
                          <tr>
                            <td><?= $no++; ?></td>
                            <td><?= $tanggal; ?></td>
                            <td><?= $badge; ?></td>
                            <td>
                              <!-- Lihat detail -->
                              <button
                                class="btn btn-primary btn-sm"
                                data-bs-toggle="modal"
                                data-bs-target="#modalDetail<?= $row['id_pengaduan']; ?>">
                                <i class="fas fa-eye"></i>
                              </button>


                            </td>
                          </tr>

                      <?php
                        }
                      } else {
                        echo "<tr><td colspan='4'>Belum ada laporan insiden</td></tr>";
                      }
                      ?>
                    </tbody>

                  </table>

                </div>
              </div>

              <!-- Modal Detai Pengaduan (contoh, strukturnya sama) -->
              <?php
              $result = mysqli_query($koneksi, $query);
              while ($row = mysqli_fetch_assoc($result)) {
              ?>
                <div class="modal fade" id="modalDetail<?= $row['id_pengaduan']; ?>" tabindex="-1">
                  <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content rounded-3 shadow">
                      <div class="modal-header bg-primary text-dark">
                        <h5 class="modal-title">Detail Pengaduan</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                      </div>

                      <div class="modal-body">
                        <p><strong>Lokasi:</strong> <?= $row['lokasi']; ?></p>
                        <p><strong>Tanggal:</strong> <?= date("d-m-Y", strtotime($row['tanggal'])); ?></p>
                        <p><strong>Deskripsi:</strong><br><?= $row['deskripsi']; ?></p>
                        <p><strong>Status:</strong> <?= $row['status']; ?></p>
                      </div>
                    </div>
                  </div>
                </div>
              <?php } ?>


            </div>
          </div>
        </div>
    </div>
    </main>
  </div>
  </div>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
    integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
    integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
    crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.min.js"
    integrity="sha384-G/EV+4j2dNv+tEPo3++6LCgdCROaejBqfUeNjuKAiuXbjrxilcCdDz6ZAVfHWe1Y"
    crossorigin="anonymous"></script>
  <script src="../js/scripts.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
  <script src="../assets/demo/chart-bar-demo.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js"
    crossorigin="anonymous"></script>
  <script type="text/javascript" src="../sweetalert/sweetalert2.all.min.js"></script>

</body>

</html>