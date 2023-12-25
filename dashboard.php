<?php 
session_start();
if (!isset($_SESSION['session_username'])) {
  header('Location: login.php');
  exit();
}

 ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Iventaris</title>
	<!-- Bootsrap CSS -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

	<!-- Font Google -->
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&family=Quicksand:wght@400;700&display=swap" rel="stylesheet">

	<!-- My Style -->
	<link rel="stylesheet" type="text/css" href="assets/css/style.css">

	<!-- Logo Title Bar -->
	<link rel="icon" href="assets/img/logo_smk.png" type="image/x-icon">

  <!-- Bootstrap Font Icon CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
</head>
<body>
	
	<!-- Navbar -->
	<nav class="navbar navbar-expand-lg ">
  <div class="container">
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav mx-auto">
        <li class="nav-item mx-2">
          <a class="nav-link active" aria-current="page" href="dashboard.php">Dashboard</a>
        </li>
        <li class="nav-item mx-2">
          <a class="nav-link" aria-current="page" href="barang.php">Data Barang</a>
        </li>
        <li class="nav-item mx-2">
          <a class="nav-link " href="ruang.php">Data Ruang</a>
        </li>
        <li class="nav-item mx-2">
          <a class="nav-link " href="pengguna.php">Data Pengguna</a>
        </li>
        <li class="nav-item mx-2">
          <a class="nav-link " href="peminjaman.php">Peminjaman</a>
        </li>
        <li class="nav-item mx-2">
          <a class="nav-link " href="pengembalian.php">Pengembalian</a>
        </li>
      </ul>
      <div>
      	<a href="logout.php"><button class="button-keluar">Logout</button></a>
      </div>
    </div>
  </div>
</nav>
<?php 
require "koneksi.php";
$sql_barang = "SELECT COUNT(*) AS totalBarang FROM tb_barang";
$result_barang = $mysqli->query($sql_barang);
$rowTotalBarang = $result_barang->fetch_assoc();
$totalBarang = $rowTotalBarang['totalBarang'];

$sql_pengguna = "SELECT COUNT(*) AS totalPengguna FROM tb_pengguna";
$result_pengguna = $mysqli->query($sql_pengguna);
$rowTotalPengguna = $result_pengguna->fetch_assoc();
$totalPengguna = $rowTotalPengguna['totalPengguna'];


$sql_baik = "SELECT SUM(jumlah) AS totalBaik FROM tb_barang WHERE kondisi_barang = 'Baik'";
$result_baik = $mysqli->query($sql_baik);
$rowTotalBaik = $result_baik->fetch_assoc();
$totalBaik = $rowTotalBaik['totalBaik'];

$sql_rusak = "SELECT SUM(jumlah) AS totalRusak FROM tb_barang WHERE kondisi_barang = 'Rusak'";
$result_rusak = $mysqli->query($sql_rusak);
$rowTotalRusak = $result_rusak->fetch_assoc();
$totalRusak = $rowTotalRusak['totalRusak'];

 ?>
<!-- Dashboard -->
<section id="hero" style="height: 100%;">
	<div class="container mt-5">
		<div class="row mt-4">
			<h2 class="dashboard"><i class="bi bi-house"></i> Dashboard</h2>
			<div class="row">
<div class="col-sm-3">
    <div class="card">
      <div class="card-body">
        <h1 class="card-title"><?= 0+$totalBarang ?></h1>
        <h3 class="card-text">Data Barang</h3>
        <p class="card-text">Jumlah Barang saat ini</p>
      </div>
    </div>
  </div>
<div class="col-sm-3">
    <div class="card">
      <div class="card-body">
        <h1 class="card-title"><?= 0+$totalPengguna ?></h1>
        <h3 class="card-text">Data Pengguna</h3>
        <p class="card-text">Jumlah Pengguna saat ini</p>
      </div>
    </div>
  </div>
 <div class="col-sm-3">
    <div class="card">
      <div class="card-body">
        <h1 class="card-title"><?= 0+$totalBaik ?></h1>
        <h3 class="card-text">Kondisi Baik</h3>
        <p class="card-text">Barang Kondisi Baik</p>
      </div>
    </div>
  </div>
  <div class="col-sm-3">
    <div class="card">
      <div class="card-body">
        <h1 class="card-title"><?= 0+$totalRusak ?></h1>
        <h3 class="card-text">Kondisi Rusak</h3>
        <p class="card-text">Barang Kondisi Rusak</p>
      </div>
    </div>
  </div>
</div>
		</div>
	</div>
</section>

<!-- Footer -->

</div>
<footer class="footer-admin pt-2">
		<p class="mt-2">Copyright @ 2023 - SMK Wikrama 1 Jepara</p>
</footer>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>