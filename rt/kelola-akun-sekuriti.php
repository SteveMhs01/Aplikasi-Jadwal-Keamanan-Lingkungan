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
  ?>
  <div id="layoutSidenav">
    <div id="layoutSidenav_content">
      <main>
        <div class="container-fluid px-4">
          <h1 class="mt-5 mb-5 ">Kelola Akun Sekuriti</h1>
          <div class="card mb-4 shadow">
            <div class="card-body" id="myAreaChart" width="100%" height="40">
              <button onclick="window.location.href='tambah-jadwal.php'" class="btn btn-success mb-4 rounded-3 mt-5">
                <i class="fa-solid fa-plus me-2"></i>TAMBAH AKUN
              </button>
              <table id="tabel" class="table align-middle">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Nama Sekuriti</th>
                    <th>Username</th>
                    <th>Password</th>
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
                    <td>test</td>
                    <td>2171100505059001</td>
                    <td>test</td>
                    <td class="col-sm-3">
                      <button type="submit" name="edit" id="edit" class="btn btn-primary rounded-3 mb-2" data-bs-toggle="modal" data-bs-target="#detailModal1"><i class="fa-solid fa-eye me-1"></i>LIHAT</button>
                      <button type="submit" name="edit" id="edit" class="btn btn-warning rounded-3 mb-2"><i class="fa-solid fa-tools me-1"></i>EDIT</button>
                      <button type="reset" name="hapus" id="edit" class="btn btn-danger rounded-3 mb-2"><i class="fa-solid fa-trash me-1"></i>HAPUS</button>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
          <div
            class="modal fade"
            id="detailModal1"
            tabindex="-1"
            aria-labelledby="detailModalLabel1"
            aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="detailModalLabel">
                    Detail Akun
                  </h5>
                  <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="modal"
                    aria-label="close"></button>
                </div>
                <div class="modal-body">
                  <p><strong>Id :</strong></p>
                  <p><strong>Nama :</strong></p>
                  <p><strong>Username :</strong></p>
                  <p><strong>Nik :</strong></p>
                  <p><strong>No Hp :</strong></p>
                </div>
                <div class="modal-footer">
                  <button
                    type="button"
                    class="btn btn-secondary"
                    data-bs-dismiss="modal">
                    Tutup
                  </button>
                </div>
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
      $('#tabel').DataTable({
        "language": {
          "search": "Cari:",
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
  </script>
</body>

</html>