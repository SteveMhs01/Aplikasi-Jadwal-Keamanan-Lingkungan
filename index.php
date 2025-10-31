<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Perumahan Putra Yudha Indah</title>

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

  <!-- Custom Styles -->
  <style>
    :root {
      --crystal-gradient: linear-gradient(135deg, #a8edea 0%, #fed6e3 100%);
    }

    body {
      font-family: 'Poppins', sans-serif;
      background-color: #f9f9f9;
      color: #333;
    }

    /* Navbar */
    .navbar {
      background: white;
      box-shadow: 0 2px 10px rgba(0,0,0,0.05);
    }

    .navbar-brand {
      font-weight: 700;
      color: #333 !important;
    }

    /* Hero Section */
    .hero {
      background: linear-gradient(160deg, #0f1724 0%, #4c1d95 40%, #e66465 70%, #45d0b6 100%);
      color: #222;
      text-align: center;
      padding: 150px 20px;
      position: relative;
      margin-top: 90px;
    }

    .hero h1 {
      font-weight: 700;
      font-size: 2.8rem;
    }

    .hero p {
      font-size: 1.1rem;
      color: #444;
    }

    .hero .btn:hover {
      background: #084298;
    }

    /* Tentang Kami */
    .section-title {
      color: #0d6efd;
      text-transform: uppercase;
      font-weight: 600;
      font-size: 0.9rem;
    }

    .icon-circle {
      background: var(--crystal-gradient);
      width: 50px;
      height: 50px;
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 1.3rem;
      color: #333;
    }

    /* Card Ronda */
    .card {
      border: none;
      border-radius: 15px;
      overflow: hidden;
      box-shadow: 0 4px 20px rgba(0,0,0,0.1);
      transition: transform 0.3s ease;
    }

    .card:hover {
      transform: translateY(-15px);
    }

    .card img {
      height: 200px;
      object-fit: cover;
    }

    /* Footer */
    footer {
      background: #222;
      color: #ddd;
      padding: 40px 0 20px;
    }

    footer a {
      color: white;
      margin: 0 8px;
      font-size: 1.3rem;
      transition: color 0.3s;
    }

    footer a:hover {
      color: #0d6efd;
    }
  </style>
</head>

<body>
  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg fixed-top ms-5 me-5 rounded-4 shadow-sm mt-3 ">
    <div class="container">
      <a class="navbar-brand" href="#">Jadwal Keamanan Lingkungan</a>
      <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
        <ul class="navbar-nav me-3">
          <li class="nav-item"><a class="nav-link active" href="#">Beranda</a></li>
          <li class="nav-item"><a class="nav-link" href="#tentang">Tentang</a></li>
          <li class="nav-item"><a class="nav-link" href="#ronda">Ronda</a></li>
        </ul>
        <a href="login.php" class="btn btn-outline-success px-4"><i class="fas fa-sign-in-alt me-2"></i>Login</a>
      </div>
    </div>
  </nav>

  <!-- Hero Section -->
  <section class="hero d-flex flex-column justify-content-center align-items-center">
    <h1 class="mb-3">Selamat Datang di<br>Perumahan Putra Yudha Indah</h1>
    <p>RT 007 RW 08 · Kelurahan Kabil · Kecamatan Nongsa · Kota Batam</p>
    <a href="#tentang" class="btn btn-md btn-outline-primary mt-3 rounded-pill"><i class="fa-solid fa-arrow-right me-2"></i>Pelajari Lebih Lanjut</a>
  </section>

  <!-- Tentang Kami -->
  <section id="tentang" class="py-5">
    <div class="container">
      <div class="row align-items-center">
        <div class="col-md-5 mb-4 mb-md-0">
          <img src="./img/img.png" class="img-fluid rounded shadow" alt="Tentang Kami">
        </div>
        <div class="col-md-7">
          <div class="section-title mb-2">Tentang Kami</div>
          <h2 class="fw-bold mb-3">Komunitas Kita Bersama</h2>
          <p>Perumahan Putra Yudha Indah adalah komunitas warga yang menjunjung tinggi nilai kebersamaan, kepedulian, dan tanggung jawab sosial dalam menjaga keamanan serta keharmonisan lingkungan.</p>
          <div class="icon-circle mt-3"><i class="bi bi-people-fill"></i></div>
        </div>
      </div>
    </div>
  </section>

  <!-- Program Ronda -->
  <section id="ronda" class="py-5 bg-light">
    <div class="container text-center">
      <div class="section-title mb-2">Ronda Kami</div>
      <h2 class="fw-bold mb-4">Program Ronda Warga</h2>
      <p class="mb-5">Menjaga keamanan adalah tanggung jawab bersama. Kami melaksanakan jadwal ronda secara bergilir demi keamanan dan ketertiban lingkungan.</p>

      <div class="row g-4">
        <!-- card 1 -->
        <div class="col-md-3 col-sm-6">
          <div class="card">
            <img src="https://source.unsplash.com/400x300/?security,guard" alt="">
            <div class="card-body">
              <h6 class="fw-semibold">Ronda Malam Warga</h6>
              <p class="small">Kegiatan rutin menjaga keamanan lingkungan setiap malam.</p>
            </div>
          </div>
        </div>

        <!-- card 2 -->
        <div class="col-md-3 col-sm-6">
          <div class="card">
            <img src="https://source.unsplash.com/400x300/?meeting,neighborhood" alt="">
            <div class="card-body">
              <h6 class="fw-semibold">Koordinasi Warga</h6>
              <p class="small">Menjalin komunikasi efektif antarwarga dan pengurus.</p>
            </div>
          </div>
        </div>

        <!-- card 3 -->
        <div class="col-md-3 col-sm-6">
          <div class="card">
            <img src="https://source.unsplash.com/400x300/?volunteer,community" alt="">
            <div class="card-body">
              <h6 class="fw-semibold">Kegiatan Sosial</h6>
              <p class="small">Membangun solidaritas dan semangat gotong royong.</p>
            </div>
          </div>
        </div>

        <!-- card 4 -->
        <div class="col-md-3 col-sm-6">
          <div class="card">
            <img src="https://source.unsplash.com/400x300/?police,night" alt="">
            <div class="card-body">
              <h6 class="fw-semibold">Sinergi dengan Aparat</h6>
              <p class="small">Berkoordinasi dengan pihak keamanan setempat.</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Footer -->
  <footer>
    <div class="container text-center">
      <p class="mb-2">Perumahan Putra Yudha Indah · RT 007 RW 08 · Kabil, Nongsa, Batam</p>
      <div class="mb-3">
        <a href="#"><i class="bi bi-facebook"></i></a>
        <a href="#"><i class="bi bi-instagram"></i></a>
        <a href="#"><i class="bi bi-whatsapp"></i></a>
        <a href="#"><i class="bi bi-envelope"></i></a>
      </div>
      <p class="text-secondary small mb-0">© 2025 Komunitas Putra Yudha Indah</p>
    </div>
  </footer>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

  <!-- Icon -->
  <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
</body>
</html>
