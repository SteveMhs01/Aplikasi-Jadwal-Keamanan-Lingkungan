<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- Judul -->
  <title>Keamanan Lingkungan</title>

  <!-- Link Animasi -->
  <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />

  <!-- Link Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Comfortaa:wght@300..700&family=Silkscreen:wght@400;700&display=swap" rel="stylesheet">

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

  <!-- Custom Styles -->
  <style>
    @font-face {
      font-family: 'Comfortaa';
      font-style: normal;
      font-display: swap;
      font-weight: 300;
      src: url('/comfortaa-latin-300.woff') format('woff');
    }

    @font-face {
      font-family: 'Comfortaa';
      font-style: normal;
      font-display: swap;
      font-weight: 600;
      src: url('/comfortaa-latin-600.woff') format('woff');
    }

    @font-face {
      font-family: 'IBM Plex Mono';
      font-style: normal;
      font-display: swap;
      font-weight: 400;
      src: url('/ibm-plex-mono-latin-400.woff') format('woff');
    }

    :root {
      --crystal-gradient: linear-gradient(135deg, #a8edea 0%, #fed6e3 100%);
    }

    body {
      font-family: 'Comfortaa', sans-serif;
      background-color: #f9f6f6d7;
      color: #333;
      scroll-behavior: smooth;
    }

    /* Navbar */
    .navbar {
      background: white;
      box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
      position: fixed;
    }

    .navbar-brand {
      font-weight: 700;
      color: #333 !important;
    }

    /* Hero Section */
    .hero {
      background: #092C4C;
      color: #eaeaea;
      text-align: center;
      padding: 150px 20px;
      position: relative;

    }

    .hero h1 {
      font-weight: 700;
      font-size: 2.8rem;
    }

    .hero p {
      font-size: 1.1rem;
      color: #eaeaea;
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
      box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
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
  <nav class="navbar navbar-expand-lg fixed-top ms-3 me-3 rounded-4 shadow-sm mt-3">
    <div class="container">
      <a class="navbar-brand" href="#">Keamanan Lingkungan</a>
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
    <h1 class="mb-3 animate__animated animate__fadeIn">Selamat Datang 😎😎 <br></h1>
    <p class="animate__animated animate__fadeIn"></p>
    <button href="#tentang" class="btn btn-md btn-outline-primary mt-3 rounded-pill animate__animated animate__fadeIn"><i class="fa-solid fa-arrow-right me-2"></i>Pelajari Lebih Lanjut</button>
  </section>

  <!-- Tentang Kami -->
  <section id="tentang" class="py-5">
    <div class="container">
      <div class="row align-items-center">
        <div class="col-md-5 mb-4 mb-md-0">
          <img src="./img/img.png" class="img-fluid rounded shadow animate__animated animate__fadeIn" alt="Tentang Kami">
        </div>
        <div class="col-md-7 animate__animated animate__fadeInRight">
          <div class="section-title mb-2">Tentang Kami</div>
          <h2 class="fw-bold mb-3">Komunitas Kita Bersama</h2>
          <p>Ronda juga mencerminkan semangat kebersamaan dan kekompakan warga dalam membangun keamanan bersama. Melalui kegiatan ini, terbentuk budaya saling menjaga, menghargai, dan bertanggung jawab demi terciptanya ketertiban lingkungan yang berkelanjutan.</p>
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
        <div class="col-md-3 col-sm-6 animate__animated animate__fadeIn">
          <div class="card">
            <img src="./img/img11.jpg" class="img-fluid rounded shadow animate__animated animate__fadeIn" alt="">
            <div class="card-body">
              <h6 class="fw-semibold">Ronda Malam Warga</h6>
              <p class="small">Kegiatan rutin menjaga keamanan lingkungan setiap malam.</p>
            </div>
          </div>
        </div>

        <!-- card 2 -->
        <div class="col-md-3 col-sm-6 animate__animated animate__fadeIn">
          <div class="card">
            <img src="./img/img22.jpg" class="img-fluid rounded shadow animate__animated animate__fadeIn" alt="">
            <div class="card-body">
              <h6 class="fw-semibold">Koordinasi Warga</h6>
              <p class="small">Menjalin komunikasi efektif antarwarga dan pengurus.</p>
            </div>
          </div>
        </div>

        <!-- card 3 -->
        <div class="col-md-3 col-sm-6 animate__animated animate__fadeIn">
          <div class="card">
            <img src="./img/img33.png" class="img-fluid rounded shadow animate__animated animate__fadeIn" alt="">
            <div class="card-body">
              <h6 class="fw-semibold">Kegiatan Sosial</h6>
              <p class="small">Membangun solidaritas dan semangat gotong royong.</p>
            </div>
          </div>
        </div>

        <!-- card 4 -->
        <div class="col-md-3 col-sm-6 animate__animated animate__fadeIn">
          <div class="card">
            <img src="./img/img44.jpg" class="img-fluid rounded shadow animate__animated animate__fadeIn" alt="">
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
  <footer class="bg-dark py-4 mt-5">
    <div class="container pt-4">
      <div class="row text-center text-md-start align-items-center mb-4">
        <div class="col-md-6 mb-3 mb-md-0">
          <h5 class="fw-bold">Hubungi Kami</h5>
          <p class="mb-0">
            Perumahan Putra Yudha Indah
          </p>
          <p>RT 007 RW 08 · Kabil, Nongsa, Batam</p>
          <i class="fa-solid fa-phone"></i>
          <span>+62 856-6847-5298</span>
          <br>
          <i class="fa-solid fa-phone text-dark"></i>
          <span>+62 895-6036-69128</span>
        </div>
        <div class="col-md-6 text-md-end">
          <h5 class="fw-bold">Ikuti Kami</h5>
          <div class="d-flex justify-content-center justify-content-md-end gap-3 fs-4">
            <a href="#"><i class="fa-brands fa-instagram"></i></a>
            <a href="#"><i class="fa-brands fa-facebook"></i></a>
            <a href="#"><i class="fa-brands fa-x-twitter"></i></a>
          </div>
        </div>
      </div>
      <hr class="my-3">
      <p class="text-secondary small mb-0 text-center">
        &copy; <span id="year"></span> TRPL.
      </p>
    </div>
  </footer>

  <script>
    document.getElementById('year').textContent = new Date().getFullYear();
  </script>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

  <!-- Icon -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css" integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</body>

</html>