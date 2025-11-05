<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <meta name="description" content="" />
  <meta name="author" content="" />
  <title>KELOLA JADWAL</title>
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
          <h1 class="mb-4">Jadwal Ronda</h1>
          <i class="text-muted">Kelola Jadwal Ronda</i>
          <div class="container mt-4">
            <div class="card shadow rounded-3 ">
                  <div class="card-body">
                    <!-- Header -->
                    <div class="d-flex justify-content-between align-items-center mb-4">
                      <h5 class="mb-0"></h5>
                      <button class="btn btn-sm btn-outline-success" data-bs-toggle="modal" data-bs-target="#tambahJadwalModal">
                        <i class="fas fa-plus me-1"></i> Tambah Jadwal
                      </button>
                    </div>

                    <!-- Tabel Jadwal -->
                    <div class="table-responsive">
                      <table class="table table-borderedless table-hover align-middle">
                        <thead class="table-light text-center">
                          <tr>
                            <th>No</th>
                            <th>Nama Warga</th>
                            <th>Hari</th>
                            <th>Tanggal</th>
                            <th>Jam</th>
                            <th>Pos Ronda</th>
                            <th>Aksi</th>
                          </tr>
                        </thead>
                        <tbody class="text-center">
                          <tr>
                            <td>1</td>
                            <td>Ahmad Setiawan, Budi Santoso, Dedi, Fajar, Hendra</td>
                            <td>Senin</td>
                            <td>04-11-2025</td>
                            <td>22:00 - 00:00</td>
                            <td>Pos 1</td>
                            <td>
                              <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editJadwalModal">
                                <i class="fas fa-edit"></i>
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

                  <!-- Modal Tambah Jadwal -->
                  <div class="modal fade" id="tambahJadwalModal" tabindex="-1" aria-labelledby="tambahJadwalModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                      <div class="modal-content rounded-3 shadow">
                        <div class="modal-header bg-success text-white">
                          <h5 class="modal-title" id="tambahJadwalModalLabel">Tambah Jadwal Ronda</h5>
                          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">
                          <form id="formTambahJadwal">
                            <!-- Input nama warga (bisa sampai 5 orang) -->
                            <div class="mb-3">
                              <label class="form-label">Nama Warga (maksimal 5 orang)</label>
                              <div id="namaContainer">
                                <input type="text" name="nama[]" class="form-control mb-2" placeholder="Masukkan nama warga" required>
                              </div>
                              <button type="button" class="btn btn-outline-success btn-sm" id="tambahNamaBtn">
                                <i class="fas fa-plus me-1"></i> Tambah Nama
                              </button>
                            </div>

                            <div class="mb-3">
                              <label class="form-label">Hari</label>
                              <select class="form-select" required>
                                <option value="">-- Pilih Hari --</option>
                                <option>Senin</option>
                                <option>Selasa</option>
                                <option>Rabu</option>
                                <option>Kamis</option>
                                <option>Jumat</option>
                                <option>Sabtu</option>
                                <option>Minggu</option>
                              </select>
                            </div>

                            <div class="mb-3">
                              <label class="form-label">Tanggal</label>
                              <input type="date" class="form-control" required>
                            </div>

                            <div class="mb-3">
                              <label class="form-label">Jam</label>
                              <input type="text" class="form-control" placeholder="Contoh: 22:00 - 00:00" required>
                            </div>

                            <div class="mb-3">
                              <label class="form-label">Pos Ronda</label>
                              <input type="text" class="form-control" placeholder="Masukkan pos ronda" required>
                            </div>
                          </form>
                        </div>

                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                          <button type="submit" class="btn btn-success">Simpan</button>
                        </div>
                      </div>
                    </div>
                  </div>

                  <!-- Modal Edit Jadwal (contoh, strukturnya sama) -->
                  <div class="modal fade" id="editJadwalModal" tabindex="-1" aria-labelledby="editJadwalModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                      <div class="modal-content rounded-3 shadow">
                        <div class="modal-header bg-warning text-dark">
                          <h5 class="modal-title" id="editJadwalModalLabel">Edit Jadwal Ronda</h5>
                          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">
                          <form id="formEditJadwal">
                            <!-- isian form edit sama seperti tambah -->
                            <div class="mb-3">
                              <label class="form-label">Nama Warga</label>
                              <input type="text" class="form-control" value="Ahmad Setiawan" required>
                            </div>
                            <div class="mb-3">
                              <label class="form-label">Hari</label>
                              <select class="form-select" required>
                                <option>Senin</option>
                                <option>Selasa</option>
                                <option>Rabu</option>
                                <option>Kamis</option>
                                <option>Jumat</option>
                                <option>Sabtu</option>
                                <option>Minggu</option>
                              </select>
                            </div>
                            <div class="mb-3">
                              <label class="form-label">Tanggal</label>
                              <input type="date" class="form-control" value="2025-11-04" required>
                            </div>
                            <div class="mb-3">
                              <label class="form-label">Jam</label>
                              <input type="text" class="form-control" value="22:00 - 00:00" required>
                            </div>
                            <div class="mb-3">
                              <label class="form-label">Pos Ronda</label>
                              <input type="text" class="form-control" value="Pos 1" required>
                            </div>
                          </form>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                          <button type="submit" class="btn btn-warning text-dark">Simpan Perubahan</button>
                        </div>
                      </div>
                    </div>
                  </div>

                  <!-- Script Tambah Nama Maks 5 Orang -->
                  <script>
                    const namaContainer = document.getElementById("namaContainer");
                    const tambahNamaBtn = document.getElementById("tambahNamaBtn");

                    tambahNamaBtn.addEventListener("click", () => {
                      const jumlahInput = namaContainer.querySelectorAll("input").length;
                      if (jumlahInput < 5) {
                        const input = document.createElement("input");
                        input.type = "text";
                        input.name = "nama[]";
                        input.classList.add("form-control", "mb-2");
                        input.placeholder = `Masukkan nama warga ke-${jumlahInput + 1}`;
                        input.required = true;
                        namaContainer.appendChild(input);
                      } else {
                        Swal.fire({
                          icon: "warning",
                          title: "Batas Maksimal!",
                          text: "Kamu hanya bisa menambahkan maksimal 5 nama warga.",
                          confirmButtonColor: "#2fd43cff"
                        });
                      }
                    });
                  </script>

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
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
  <script src="../js/scripts.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
  <script src="assets/demo/chart-area-demo.js"></script>
  <script src="assets/demo/chart-bar-demo.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
  <script src="js/datatables-simple-demo.js"></script>
  <script type="text/javascript" src="../sweetalert/sweetalert2.all.min.js"></script>
</body>

</html>