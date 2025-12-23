<?php
session_start();
include "../connection/connection.php";

// PROSES TAMBAH AKUN (di awal)
if (isset($_POST['register'])) {

  $nik = $_POST['nik'];
  $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
  $email = $_POST['email'];
  $nama = $_POST['nama'];
  $alamat = $_POST['alamat'];
  $no_hp = $_POST['no_hp'];
  $role = $_POST['role'];

  $query = "INSERT INTO tb_pengguna 
        ( nik, password, email, nama, alamat, no_hp, role) 
        VALUES 
        ('$nik', '$password', '$email', '$nama', '$alamat', '$no_hp', '$role')";

  if (mysqli_query($koneksi, $query)) {

    // simpan pesan ke session
    $_SESSION['sukses_tambah'] = true;

    // redirect untuk mencegah re-submit
    header("Location: kelola-akun.php");
    exit;
  } else {
    die("Gagal Insert: " . mysqli_error($koneksi));
  }
}


// INCLUDE SETELAH PHP SELESAI DAN INCLUDE SIDEBAR DAN NAVBAR
include 'sideandnav/navbar.php';
include 'sideandnav/sidebar.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <title>KELOLA AKUN</title>

  <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
  <link href="../css/styles.css" rel="stylesheet" />
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js"></script>

</head>
<style>
  /* Garis pemisah kolom */
  .col-divider {
    border-left: 2px solid #eee;
  }

  /* Ikon dalam input */
  .input-group-text {
    background: #f3f4f6;
    border-right: 0;
  }

  .form-control:focus {
    border-color: #6366f1;
    box-shadow: 0 0 5px rgba(99, 102, 241, 0.5);
  }
</style>

<body class="sb-nav-fixed" style="background-color: #f8f0f0ff;">

  <?php
  // tampilkan SweetAlert jika sukses tambah akun
  if (isset($_SESSION['sukses_tambah'])) {
    echo "
      <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
      <script>
        Swal.fire({
          icon: 'success',
          title: 'Akun Berhasil Ditambahkan',
          showConfirmButton: false,
          timer: 1500
        });
      </script>";
    unset($_SESSION['sukses_tambah']);
  }

  // tampilkan SweetAlert jika sukses update akun
  if (isset($_SESSION['sukses_update'])) {
    echo "
    <script>
      Swal.fire({
        icon: 'success',
        title: 'Data Berhasil Diupdate',
        showConfirmButton: false,
        timer: 1500
      });
    </script>";
    unset($_SESSION['sukses_update']);
  }

  // tampilkan SweetAlert jika sukses delete akun
  if (isset($_SESSION['sukses_delete'])) {
    echo "
    <script>
      Swal.fire({
        icon: 'success',
        title: 'Data Berhasil Didelete',
        showConfirmButton: false,
        timer: 1500
      });
    </script>";
    unset($_SESSION['sukses_delete']);
  }
  ?>

  <div id="layoutSidenav">
    <div id="layoutSidenav_content">
      <main class="p-4">
        <div class="container-fluid px-4">
          <h1>Kelola Akun</h1>
          <i class="text-muted">Sekuriti / Warga</i>

          <!-- Tabel Akun -->
          <div class="card mt-4 mb-4 shadow">
            <div class="card-body">
              <button type="button" class="btn btn-outline-success btn-sm mt-3 mb-4 shadow-sm" data-bs-toggle="modal" data-bs-target="#tambahAkunModal">
                <i class="fas fa-circle-plus me-1"></i> Tambah Akun
              </button>

              <div class="table-responsive">
                <table id="tabelAkun" class="table align-middle">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Nik</th>
                      <th>Nama</th>
                      <th>Password</th>
                      <th>Aksi</th>
                    </tr>
                  </thead>

                  <!-- Mengambil Data Dari Database -->
                  <tbody>
                    <?php
                    $query = mysqli_query($koneksi, "SELECT * FROM tb_pengguna");
                    $no = 1;
                    while ($data = mysqli_fetch_assoc($query)) {
                    ?>
                      <tr>
                        <td><?= $no++; ?></td>
                        <td><?= $data['nik']; ?></td>
                        <td><?= $data['nama']; ?></td>
                        <td>*******</td>
                        <td class="text-center d-flex gap-2">
                          <!-- Tombol Detail -->
                          <button class="btn btn-primary DetailAkun"
                            data-id="<?= $data['id_pengguna']; ?>"
                            data-nik="<?= $data['nik']; ?>"
                            data-email="<?= $data['email']; ?>"
                            data-nama="<?= $data['nama']; ?>"
                            data-alamat="<?= $data['alamat']; ?>"
                            data-nohp="<?= $data['no_hp']; ?>"
                            data-role="<?= $data['role']; ?>">
                            <i class="fa fa-eye"></i>
                          </button>
                          <!-- Tombol Hapus -->
                          <button class="btn btn-danger hapusAkun"
                            data-id="<?= $data['id_pengguna']; ?>">
                            <i class="fa-solid fa-trash"></i>
                          </button>
                        </td>
                      </tr>
                    <?php } ?>
                  </tbody>
                </table>
              </div>

            </div>
          </div>

          <!-- Modal Tambah Akun -->
          <div class="modal fade" id="tambahAkunModal" tabindex="-1">
            <div class="modal-dialog modal-lg modal-dialog-centered">
              <div class="modal-content rounded-3 shadow">
                <div class="modal-header bg-success text-white">
                  <h5 class="modal-title">Tambah Akun Ronda</h5>
                  <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                  <form id="formTambahAkun" method="POST" action="">
                    <div class="row">

                      <!-- Kolom Kiri -->
                      <div class="col-md-6">

                        <div class="mb-3">
                          <label class="form-label">NIK</label>
                          <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-id-card"></i></span>
                            <input type="number" class="form-control" name="nik" placeholder="Nomor Induk Kependudukan">
                          </div>
                        </div>

                        <div class="mb-3">
                          <label class="form-label">Password</label>
                          <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-lock"></i></span>
                            <input type="text" class="form-control" name="password" placeholder="Masukkan password">
                          </div>
                        </div>

                        <div class="mb-3">
                          <label class="form-label">Email</label>
                          <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                            <input type="email" class="form-control" name="email" placeholder="Masukkan email">
                          </div>
                        </div>

                      </div>

                      <!-- Kolom Kanan -->
                      <div class="col-md-6 col-divider">

                        <div class="mb-3">
                          <label class="form-label">Nama</label>
                          <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-user-tag"></i></span>
                            <input type="text" class="form-control" name="nama" placeholder="Nama lengkap">
                          </div>
                        </div>

                        <div class="mb-3">
                          <label class="form-label">Alamat</label>
                          <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-map-marker-alt"></i></span>
                            <input type="text" class="form-control" name="alamat" placeholder="Alamat domisili" required>
                          </div>
                        </div>

                        <div class="mb-3">
                          <label class="form-label">No Hp</label>
                          <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-phone"></i></span>
                            <input type="number" class="form-control" name="no_hp" placeholder="Nomor handphone" required>
                          </div>
                        </div>

                        <div class="mb-3">
                          <label class="form-label">Role</label>
                          <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-user-shield"></i></span>
                            <select name="role" class="form-control" required>
                              <option value="">Pilih Role -</option>
                              <option value="rt">RT</option>
                              <option value="sekuriti">Sekuriti</option>
                              <option value="warga">Warga</option>
                            </select>
                          </div>
                        </div>

                      </div>
                    </div>

                </div>

                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                  <button type="submit" class="btn btn-success" name="register">Daftar</button>
                </div>
                </form>

              </div>
            </div>
          </div>

          <!-- MODAL DETAIL AKUN -->
          <div class="modal fade" id="modalDetailAkun" tabindex="-1">
            <div class="modal-dialog modal-lg modal-dialog-centered">
              <div class="modal-content rounded-3 shadow">

                <form method="POST" action="">
                  <input type="hidden" name="id_pengguna" id="edit-id">

                  <div class="modal-header bg-primary text-white">
                    <h5>Detail Pengguna</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                  </div>

                  <div class="modal-body">
                    <div class="row">

                      <!-- KOLOM KIRI -->
                      <div class="col-md-6">


                        <div class="mb-3">
                          <label class="form-label">NIK</label>
                          <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-id-card"></i></span>
                            <input type="number" class="form-control" id="edit-nik" name="nik" placeholder="Nomor Induk Kependudukan" required>
                          </div>
                        </div>

                        <div class="mb-3">
                          <label class="form-label">Email</label>
                          <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                            <input type="email" class="form-control" id="edit-email" name="email" placeholder="Masukkan email" required>
                          </div>
                        </div>


                        <div class="mb-3">
                          <label class="form-label">Nama</label>
                          <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-user-tag"></i></span>
                            <input type="text" class="form-control" id="edit-nama" name="nama" placeholder="Nama lengkap" required>
                          </div>
                        </div>


                      </div>

                      <!-- KOLOM KANAN -->
                      <div class="col-md-6 col-divider">

                        <div class="mb-3">
                          <label class="form-label">Alamat</label>
                          <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-map-marker-alt"></i></span>
                            <textarea class="form-control" id="edit-alamat" name="alamat" placeholder="Alamat domisili"></textarea>
                          </div>
                        </div>

                        <div class="mb-3">
                          <label class="form-label">No Hp</label>
                          <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-phone"></i></span>
                            <input type="number" class="form-control" id="edit-nohp" name="no_hp" placeholder="Nomor handphone">
                          </div>
                        </div>

                        <div class="mb-3">
                          <label class="form-label">Role</label>
                          <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-user-shield"></i></span>
                            <select name="role" id="edit-role" class="form-control">
                              <option value="">Pilih Role -</option>
                              <option value="rt">RT</option>
                              <option value="sekuriti">Sekuriti</option>
                              <option value="warga">Warga</option>
                            </select>
                          </div>
                        </div>

                      </div>

                    </div>
                  </div>

                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>

                  </div>

                </form>

              </div>
            </div>
          </div>

        </div>
      </main>
    </div>
  </div>

  <!-- Scripts -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.min.js"></script>
  <script src="../js/scripts.js"></script>
  <script src="https://cdn.datatables.net/2.0.3/js/dataTables.js"></script>
  <script src="https://cdn.datatables.net/2.0.3/js/dataTables.bootstrap5.js"></script>

  <script>
    // Pagination
    $(document).ready(function() {
      $('#tabelAkun').DataTable({
        pageLength: 5,
        lengthMenu: [5, 10, 25, 50],
        responsive: true,
        autoWidth: false,

        language: {
          search: "<i class='fa-solid fa-magnifying-glass me-2'></i>Cari :",
          lengthMenu: "Tampilkan Data : _MENU_ ",
          zeroRecords: "Tidak ada data ditemukan",
          info: "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
          infoEmpty: "Tidak ada data tersedia",
          infoFiltered: "(disaring dari _MAX_ total data)",
          paginate: {
            first: "Awal",
            last: "Akhir",
            next: "›",
            previous: "‹"
          }
        }
      });
    });

    // DETAIL AKUN
    $(".detailAkun").click(function() {

      $("#edit-id").val($(this).data('id')).prop("readonly", true);
      $("#edit-nik").val($(this).data('nik')).prop("readonly", true);
      $("#edit-email").val($(this).data('email')).prop("readonly", true);
      $("#edit-nama").val($(this).data('nama')).prop("readonly", true);
      $("#edit-alamat").val($(this).data('alamat')).prop("readonly", true);
      $("#edit-nohp").val($(this).data('nohp')).prop("readonly", true);
      $("#edit-role").val($(this).data('role')).prop("readonly", true);

      $("#modalDetailAkun").modal("show");
    });


    // DELETE AKUN
    $(document).on('click', '.hapusAkun', function() {
      // AMBIL id dengan benar
      let id = $(this).data('id');

      if (!id) {
        console.error("ID tidak ditemukan!");
        return;
      }

      Swal.fire({
        title: 'Yakin hapus akun?',
        text: "Data tidak dapat dikembalikan!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Hapus',
        cancelButtonText: 'Batal'
      }).then((result) => {
        if (result.isConfirmed) {
          window.location.href = "hapus-akun.php?id_pengguna=" + id;
        }
      });
    });
  </script>

</body>

</html>