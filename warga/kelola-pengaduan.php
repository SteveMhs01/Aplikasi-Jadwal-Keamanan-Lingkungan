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

  include 'sideandnav/sidebar.php';
  ?>
  <div id="layoutSidenav">
    <div id="layoutSidenav_content">
      <main class="p-4">
        <div class="container-fluid px-4">
          <h1>Laporkan Insiden</h1>
          <i class="text-muted">Sampaikan laporan insiden yang terjadi di lingkungan anda. Data anda akan jaga
            kerahasiannya</i>
          <div class="card mt-5 mb-4 shadow">
            <div class="card-body">
              <h4 class="text-center mb-4">Laporkan Insiden Ronda Anda</h4>
              <p class="text-center text-muted mb-4">
                Sampaikan laporan insiden yang terjadi di lingkungan Anda. Data Anda akan kami jaga kerahasiaannya.
              </p>

              <form method="POST" action="">
                <!-- Jenis Insiden -->
                <div class="form-group mb-3">
                  <label for="jenis_insiden" class="form-label">Jenis Insiden</label>
                  <select class="form-control" id="jenis_insiden" name="jenis_insiden" required>
                    <option value="">-- Pilih Jenis Insiden --</option>
                    <option value="Kecurian">Kecurian</option>
                    <option value="Perkelahian">Perkelahian</option>
                    <option value="Kebakaran">Kebakaran</option>
                    <option value="Gangguan">Gangguan Masyarakat</option>
                    <option value="Lainnya">Lainnya</option>
                  </select>
                </div>

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

                <!-- Tingkat Urgensi -->
                <div class="form-group mb-3">
                  <label class="form-label d-block mb-2">Tingkat Urgensi</label>
                  <div class="urgensi-wrapper d-flex gap-3">
                    <input type="radio" name="urgensi" value="Rendah" id="urgensi-rendah" required>
                    <label for="urgensi-rendah" class="urgensi-btn rendah">Rendah</label>

                    <input type="radio" name="urgensi" value="Sedang" id="urgensi-sedang">
                    <label for="urgensi-sedang" class="urgensi-btn sedang">Sedang</label>

                    <input type="radio" name="urgensi" value="Tinggi" id="urgensi-tinggi">
                    <label for="urgensi-tinggi" class="urgensi-btn tinggi">Tinggi</label>

                    <input type="radio" name="urgensi" value="Darurat" id="urgensi-darurat">
                    <label for="urgensi-darurat" class="urgensi-btn darurat">Darurat</label>
                  </div>
                </div>



                <!-- Data Pelapor -->
                <h5 class="mt-4 mb-2">Data Pelapor</h5>
                <div class="row">
                  <div class="col-md-6 mb-3">
                    <label for="id_warga" class="form-label">Nama Warga</label>
                    <select class="form-control" id="id_warga" name="id_warga" required>
                      <option value="">-- Pilih Warga --</option>
                      <option value="1">Ahmad Fauzi</option>
                      <option value="2">Siti Aminah</option>
                    </select>
                  </div>
                  <div class="col-md-6 mb-3">
                    <label for="no_hp" class="form-label">Nomor HP</label>
                    <input type="text" class="form-control" id="no_hp" name="no_hp" placeholder="Contoh: 081234567890"
                      required>
                  </div>
                </div>

                <!-- Tombol -->
                <div class="d-flex justify-content-end mt-4">
                  <button type="reset" class="btn btn-secondary me-2">Batal</button>
                  <button type="submit" name="kirim" class="btn btn-primary">
                    <i class="bi bi-send"></i> Kirim Laporan
                  </button>
                </div>
              </form>
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