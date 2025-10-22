
<div id="layoutSidenav">
  <div id="layoutSidenav_nav">
    <nav class="sb-sidenav card shadow" style="height: 560px; border-radius: 30px; margin-top: 120px; margin-left: 10px;">
      <div class="sb-sidenav-menu">
        <div class="nav">
          <i class="fa-solid fa-user" style="height: 100px; "></i>
          <h5 class="text-center mt-3">RT</h5>
          <hr class="me-2 ms-2">
          <a class="nav-link mt-1 text-black" href="dashboard-warga.php">
            <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
            Dashboard
          </a>
          <a class="nav-link text-black" href="kelola-akun.php">
            <div class="sb-nav-link-icon"><i class="fa-solid fa-user"></i></div>
            Kelola Akun
          </a>
          <a class="nav-link text-black" href="kelola-jadwal.php">
            <div class="sb-nav-link-icon"><i class="fa-solid fa-calendar-week"></i></div>
            Kelola Jadwal
          </a>
          <a class="nav-link text-black" href="laporan.php">
            <div class="sb-nav-link-icon"><i class="fa-solid fa-book"></i></div>
            Laporan
          </a>
          <a class="nav-link text-black" href="pengaduan.php">
            <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
            Pengaduan
          </a>
          <a class="nav-link text-black" href="settings.php">
            <div class="sb-nav-link-icon"><i class="fas fa-gear"></i></div>
            Setting
          </a>
        </div>
      </div>
    </nav>
    <nav class="card shadow align-items-center" id="logout" style="border-radius: 30px; margin-top: 10px; height: 50px; margin-left: 10px; cursor: pointer;" >
      <div class="sb-sidenav-menu mt-2">
        <div class="nav">
          <a class="nav-link text-black d-flex" >
            <div class="sb-nav-link-icon"><i class="fa-solid fa-right-from-bracket"></i></div>
            Logout
          </a>
        </div>
      </div>
    </nav>
  </div>
</div>

<script>
  document.getElementById("logout").addEventListener("click", function(event) {
    event.preventDefault();
    Swal.fire({
      title: 'Konfirmasi Logout',
      text: "Apakah Anda yakin ingin logout?",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonText: 'Ya, Logout',
      cancelButtonText: 'Batal'
    }).then((result) => {
      if (result.isConfirmed) {
        window.location.href = "../login.php";
      }
    }); 
  });
</script>