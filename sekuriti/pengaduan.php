<?php
/* panggil koneksi ke database */
// call ambulance call ambulance but not for me
include '../connection/connection.php';

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

                  <!-- Tanggal & Waktu -->
                  <div class="row mb-3">
                    <div class="col-md-6">
                      <label for="tanggal" class="form-label">Tanggal Kejadian</label>
                      <input type="date" class="form-control" id="tanggal" name="tanggal" required>
                    </div>
                    <div class="col-md-6">
                      <label for="waktu" class="form-label">Waktu Kejadian</label>
                      <input type="time" class="form-control" id="waktu" name="waktu" required>
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
                    <button type="reset" class="btn btn-secondary me-2">Batal</button>
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
                        <th>Nama Warga</th>
                        <th>Lokasi Kejadian</th>
                        <th>Waktu</th>
                        <th>Tanggal</th>
                        <th>Status Laporan</th>
                        <th>Aksi</th>
                      </tr>
                    </thead>
                    <tbody class="text-center">
                      <tr>
                        <td>1</td>
                        <td>Ahmad Setiawan</td>
                        <td></td>
                        <td>Senin</td>
                        <td>04-11-2025</td>
                        <td><span class="badge badge-soft text-danger"><i class="fa-solid fa-xmark me-1"></i>Ditolak</span></td>
                        <td>
                          <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#editJadwalModal">
                            <i class="fas fa-eye"></i>
                          </button>
                          <button class="btn btn-danger btn-sm" onclick="hapusJadwal(1)">
                            <i class="fas fa-trash-alt"></i>
                          </button>
                        </td>
                      </tr>
                      <tr>
                        <td>2</td>
                        <td>Bahlil</td>
                        <td></td>
                        <td>Senin</td>
                        <td>04-11-2025</td>
                        <td><span class="badge badge-soft text-success"><i class="fa-solid fa-check me-1"></i>Ditolak</span></td>
                        <td>
                          <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#editJadwalModal">
                            <i class="fas fa-eye"></i>
                          </button>
                          <button class="btn btn-danger btn-sm" onclick="hapusJadwal(1)">
                            <i class="fas fa-trash-alt"></i>
                          </button>
                        </td>
                      </tr>
                      <tr>
                        <td>3</td>
                        <td>Ahmad Sahroni</td>
                        <td></td>
                        <td>Senin</td>
                        <td>04-11-2025</td>
                        <td><span class="badge badge-soft text-primary"><i class="fa-solid fa-clock me-1"></i>Menunggu Validasi</span></td>
                        <td>
                          <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#editJadwalModal">
                            <i class="fas fa-eye"></i>
                          </button>
                          <button class="btn btn-danger btn-sm" onclick="hapusJadwal(1)">
                            <i class="fas fa-trash-alt"></i>
                          </button>
                        </td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>

              <!-- Modal Detai Pengaduan (contoh, strukturnya sama) -->
              <div class="modal fade" id="editJadwalModal" tabindex="-1" aria-labelledby="editJadwalModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                  <div class="modal-content rounded-3 shadow">
                    <div class="modal-header bg-primary text-dark">
                      <h5 class="modal-title" id="editJadwalModalLabel">Detai Pengaduan</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                      <form id="formEditJadwal">
                        <!-- isian form edit sama seperti tambah -->
                        <div class="mb-3">
                          <label class="form-label">Nama Warga</label>
                          <input type="text" class="form-control" value="Ahmad Setiawan" disabled>
                        </div>
                        <div class="mb-3">
                          <label for="" class="form-label">Alamat</label>
                          <textarea name="" id="" class="form-control" disabled></textarea>
                        </div>
                        <div class="mb-3">
                          <label class="form-label">Hari</label>
                          <input type="text" class="form-control" value="Senin" disabled>
                        </div>
                        <div class="mb-3">
                          <label class="form-label">Tanggal</label>
                          <input type="date" class="form-control" value="2025-11-04" disabled>
                        </div>
                      </form>
                    </div>

                  </div>
                </div>
              </div>

              <!-- Script Hapus -->
              <script>
                function hapusJadwal(id) {
                  Swal.fire({
                    title: 'Yakin ingin menghapus?',
                    text: 'Data jadwal akan dihapus permanen!',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#6c757d',
                    confirmButtonText: 'Ya, Hapus!',
                    cancelButtonText: 'Batal'
                  }).then((result) => {
                    if (result.isConfirmed) {
                      Swal.fire('Dihapus!', 'Data jadwal berhasil dihapus.', 'success');
                    }
                  });
                }
              </script>

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
  <!-- data table -->
  <script src="https://cdn.datatables.net/2.0.3/js/dataTables.js"></script>
  <script src="https://cdn.datatables.net/2.0.3/js/dataTables.bootstrap5.js"></script>
  <script>
    $(document).ready(function () {
      $('#tabelSekuriti').DataTable({
        "language": {
          "search": "<i class='fa-solid fa-magnifying-glass'></i> ",
          "lengthMenu": "Tampilkan _MENU_ data per halaman",
          "zeroRecords": "Data tidak ditemukan",
          "info": "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
          "infoEmpty": "Tidak ada data tersedia",
          "infoFiltered": "(disaring dari total _MAX_ data)"
        },
        "pageLength": 5,
        "lengthMenu": [5, 10, 25, 50]
      });
    });

    $(document).ready(function () {
      $('#tabelWarga').DataTable({
        "language": {
          "search": "<i class='fa-solid fa-magnifying-glass'></i> ",
          "lengthMenu": "Tampilkan _MENU_ data per halaman",
          "zeroRecords": "Data tidak ditemukan",
          "info": "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
          "infoEmpty": "Tidak ada data tersedia",
          "infoFiltered": "(disaring dari total _MAX_ data)"
        },
        "pageLength": 5,
        "lengthMenu": [5, 10, 25, 50]
      });
    });

    document.getElementById("hapusSekuriti<?= $no - 1 ?>").addEventListener("click", function (event) {
      event.preventDefault();
      Swal.fire({
        title: 'Konfirmasi Hapus',
        text: "Apakah Anda yakin ingin menghapus akun ini?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Hapus',
        cancelButtonText: 'Batal'
      }).then((result) => {
        if (result.isConfirmed) {
          Swal.fire(
            'Dihapus!',
            'Data telah dihapus.',
            'success'
          )
        }
      });
    });

    document.getElementById("hapusWarga<?= $no - 1 ?>").addEventListener("click", function (event) {
      event.preventDefault();
      Swal.fire({
        title: 'Konfirmasi Hapus',
        text: "Apakah Anda yakin ingin menghapus akun ini?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Hapus',
        cancelButtonText: 'Batal'
      }).then((result) => {
        if (result.isConfirmed) {
          Swal.fire(
            'Dihapus!',
            'Data telah dihapus.',
            'success'
          )
        }
      });
    });
  </script>
</body>

</html>