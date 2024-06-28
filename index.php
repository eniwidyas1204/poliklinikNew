<?php
session_start();
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Sistem Informasi Politeknik</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <!-- select library -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/habibmhamadi/multi-select-tag@3.0.1/dist/css/multi-select-tag.css">
</head>
<body>
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-3">
    <div class="container-fluid">
      <a class="navbar-brand" href="index.php">Sistem Informasi Poliklinik</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto">
          <li class="nav-item">
            <a class="nav-link" href="index.php">Home</a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Data Master</a>
            <ul class="dropdown-menu">
              <li>
                <a class="dropdown-item" href="index.php?page=dokter">Dokter</a>
              </li>
              <li>
                <a class="dropdown-item" href="index.php?page=pasien">Pasien</a>
              </li>
              <li>
                <a class="dropdown-item" href="index.php?page=obat">Obat</a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="index.php?page=periksa">Periksa</a>
          </li>
        </ul>
        <ul class="navbar-nav ms-auto">
          <?php
          if (isset($_SESSION['username'])) {
          ?>
            <li class="nav-item">
              <a class="nav-link" href="logout.php">Logout</a>
            </li>
          <?php
          } else {
          ?>
            <li class="nav-item">
              <a class="nav-link" href="index.php?page=registerUser">Register</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="index.php?page=loginUser">Login</a>
            </li>
          <?php
          }
          ?>
        </ul>
      </div>
    </div>
  </nav>
  <main role="main" class="container">
    <?php
    if (isset($_GET['page'])) {
    ?>
      <h2><?php echo ucwords($_GET['page']) ?></h2>
    <?php
      include($_GET['page'] . ".php");
    } else {
      echo "Selamat Datang di Sistem Informasi Poliklinik";
    }
    ?>
  </main>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  <!-- select library -->
  <script src="https://cdn.jsdelivr.net/gh/habibmhamadi/multi-select-tag@3.0.1/dist/js/multi-select-tag.js"></script>
  <script>
    new MultiSelectTag('obat')  // id
  </script>
</body>
</html>
