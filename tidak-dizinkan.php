<!DOCTYPE html>
<html>

<head>
  <title>Akses Ditolak</title>
  <script type="text/javascript" src="sweetalert/sweetalert2.all.min.js"></script>
</head>

<body>

  <script>
    Swal.fire({
      icon: "error",
      title: "Akses Ditolak!",
      text: "Anda tidak memiliki izin untuk membuka halaman ini.",
    }).then(() => {
      window.location.href = "login.php";
    });
  </script>

</body>

</html>