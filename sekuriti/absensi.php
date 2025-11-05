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
    <style>
        .avatar-circle {
            width: 45px;
            height: 45px;
            background: #7d5cff;
            color: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
        }
        .card-custom {
            border-radius: 18px;
            box-shadow: 0 4px 18px rgba(0,0,0,0.08);
        }
        .btn-hadir {
            background: #28a745;
            color: white;
        }
        .btn-absen {
            background: #dc3545;
            color: white;
        }
        .header-bg {
            border-radius: 18px 18px 0px 0px;
            background: linear-gradient(to right, #2a71e8, #00c6ff);
            color: white;
            padding: 25px 10px;
            text-align: center;
        }
    </style>

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
<div class="container py-5">
    <div class="card card-custom">

        <div class="header-bg">
            <h4 class="fw-bold">ABSENSI RONDA HARI INI</h4>
            <small>Senin, 1 Oktober 2025</small>
        </div>

        <div class="p-3">

            <!-- ITEM -->
            <div class="d-flex align-items-center justify-content-between p-2 border-bottom">
                <div class="d-flex align-items-center gap-3">
                    <div class="avatar-circle">A</div>
                    <div>
                        <strong>Nama</strong><br>
                        <small>19:00 - 03:00</small><br>
                        <small class="text-secondary">BELUM ABSEN</small>
                    </div>
                </div>
                <div class="d-flex gap-2">
                    <button class="btn btn-sm btn-hadir">Hadir</button>
                    <button class="btn btn-sm btn-absen">Tidak hadir</button>
                </div>
            </div>

            <!-- COPY BERGERAK KE BAWAH -->
            <div class="d-flex align-items-center justify-content-between p-2 border-bottom">
                <div class="d-flex align-items-center gap-3">
                    <div class="avatar-circle">B</div>
                    <div>
                        <strong>Nama</strong><br>
                        <small>19:00 - 03:00</small><br>
                        <small class="text-secondary">BELUM ABSEN</small>
                    </div>
                </div>
                <div class="d-flex gap-2">
                    <button class="btn btn-sm btn-hadir">Hadir</button>
                    <button class="btn btn-sm btn-absen">Tidak hadir</button>
                </div>
            </div>

            <div class="d-flex align-items-center justify-content-between p-2 border-bottom">
                <div class="d-flex align-items-center gap-3">
                    <div class="avatar-circle">C</div>
                    <div>
                        <strong>Nama</strong><br>
                        <small>19:00 - 03:00</small><br>
                        <small class="text-secondary">BELUM ABSEN</small>
                    </div>
                </div>
                <div class="d-flex gap-2">
                    <button class="btn btn-sm btn-hadir">Hadir</button>
                    <button class="btn btn-sm btn-absen">Tidak hadir</button>
                </div>
            </div>

            <div class="d-flex align-items-center justify-content-between p-2 border-bottom">
                <div class="d-flex align-items-center gap-3">
                    <div class="avatar-circle">D</div>
                    <div>
                        <strong>Nama</strong><br>
                        <small>19:00 - 03:00</small><br>
                        <small class="text-secondary">BELUM ABSEN</small>
                    </div>
                </div>
                <div class="d-flex gap-2">
                    <button class="btn btn-sm btn-hadir">Hadir</button>
                    <button class="btn btn-sm btn-absen">Tidak hadir</button>
                </div>
            </div>

            <div class="d-flex align-items-center justify-content-between p-2">
                <div class="d-flex align-items-center gap-3">
                    <div class="avatar-circle">E</div>
                    <div>
                        <strong>Nama</strong><br>
                        <small>19:00 - 03:00</small><br>
                        <small class="text-secondary">BELUM ABSEN</small>
                    </div>
                </div>
                <div class="d-flex gap-2">
                    <button class="btn btn-sm btn-hadir">Hadir</button>
                    <button class="btn btn-sm btn-absen">Tidak hadir</button>
                </div>
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