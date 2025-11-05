<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <meta name="description" content="" />
  <meta name="author" content="" />
  <title>KELOLA AKUN</title>
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
  ?>
  <div id="layoutSidenav">
    <div id="layoutSidenav_content">
      <main class="p-4">
        <div class="container-fluid px-4">
          <h1>Kelola Akun</h1>
          <i class="text-muted">Sekuriti / Warga</i>
          <div class="card mt-5 mb-4 shadow">
            <div class="card-body">
              <button type="button" class="btn btn-outline-success btn-sm mt-3 mb-4 shadow-sm">
                <i class="fas fa-plus me-1"></i> Tambah Sekuriti
              </button>
              <div class="table-responsive">
                <table id="tabelSekuriti" class="table align-middle">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Nama Sekuriti</th>
                      <th>Username</th>

                      <th>Nik</th>
                      <th>No Hp</th>
                      <th>Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $no = 1;
                    ?>
                    <tr>
                      <td><?= $no++ ?></td>
                      <td>Test</td>
                      <td>test</td>

                      <td>2171100505059001</td>
                      <td>test</td>
                      <td>
                        <button class="btn btn-danger btn-sm" id="hapusSekuriti<?= $no - 1 ?>">
                          <i class="fas fa-trash-alt"></i>
                        </button>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>

          <div class="card mb-4 shadow">
            <div class="card-body">
              <button type="button" class="btn btn-outline-success btn-sm mt-3 mb-4 shadow-sm">
                <i class="fas fa-plus me-1"></i> Tambah Warga
              </button>
              <div class="table-responsive">
                <table id="tabelWarga" class="table align-middle">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Nama Warga</th>
                      <th>Email</th>
                      <th>Username</th>
                      <th>Nik</th>
                      <th>Alamat</th>
                      <th>No Hp</th>
                      <th>Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $no = 1;
                    ?>
                    <tr>
                      <td><?= $no++ ?></td>
                      <td>Test</td>
                      <td>test</td>
                      <td>test</td>
                      <td>test</td>

                      <td>test</td>
                      <td>test</td>
                      <td>
                        <button class="btn btn-danger btn-sm" id="hapusWarga<?= $no - 1 ?>">
                          <i class="fas fa-trash-alt"></i>
                        </button>
                      </td>
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
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.min.js" integrity="sha384-G/EV+4j2dNv+tEPo3++6LCgdCROaejBqfUeNjuKAiuXbjrxilcCdDz6ZAVfHWe1Y" crossorigin="anonymous"></script>
  <script src="../js/scripts.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
  <script src="../assets/demo/chart-bar-demo.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
  <script type="text/javascript" src="../sweetalert/sweetalert2.all.min.js"></script>
  <!-- data table -->
  <script src="https://cdn.datatables.net/2.0.3/js/dataTables.js"></script>
  <script src="https://cdn.datatables.net/2.0.3/js/dataTables.bootstrap5.js"></script>
  <script>
    $(document).ready(function() {
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

    $(document).ready(function() {
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

    document.getElementById("hapusSekuriti<?= $no - 1 ?>").addEventListener("click", function(event) {
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

    document.getElementById("hapusWarga<?= $no - 1 ?>").addEventListener("click", function(event) {
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