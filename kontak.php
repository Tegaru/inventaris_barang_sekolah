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
</head>
<body>
	
	<!-- Navbar -->
	<nav class="navbar navbar-expand-lg navbar-dark">
  <div class="container">
    <a class="navbar-brand d-flex align-items-center" href="#">
    	<img src="assets/img/logo_smk.png" alt="" width="45" class="d-inline-block align-text-top me-3">
    	SMK WIKRAMA 1 JEPARA</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav mx-auto">
        <li class="nav-item mx-2">
          <a class="nav-link" aria-current="page" href="index.php">BERANDA</a>
        </li>
        <li class="nav-item mx-2">
          <a class="nav-link active" href="#">KONTAK</a>
        </li>
        <li class="nav-item mx-2">
          <a class="nav-link" href="https://smkwikrama1jepara.sch.id/">WEBSITE</a>
        </li>
      </ul>
      <div>
      	<a href="login.php"><button class="button-masuk">Login</button></a>
      </div>
    </div>
  </div>
</nav>

<!-- Form Kontak -->
<section id="hero" style="height: 100%;">
	<div class="container">
		<div class="row mt-4">
			<div class="col-md-7 kontak-tagline">
				<h2>KONTAK KAMI</h2>
				<p> “ Silahkan tinggalkan pesan Anda, pada kolom yang tersedia “</p>
			</div>
			<div class="col-md-5 ">
	     <form method="post" action="kirim_kontak.php" class="kontak p-5">
	       <div class="form-group kontak-group mt-1">
	         <label for="">Nama:</label>
	         <input type="text" class="form-control kontak-control" name="nama" placeholder="Masukkan Nama Anda">
	       </div>
	 
	       <div class="form-group kontak-group mt-1">
	         <label for="">Email:</label>
	         <input type="email" class="form-control kontak-control" name="email" placeholder="Masukkan Email Anda">
	       </div>
	       <div class="form-group kontak-group mt-1">
	         <label for="">Telepon:</label>
	         <input type="telepon" class="form-control kontak-control" name="telepon" placeholder="Masukkan Nomor Telepon Anda">
	       </div>
	       <div class="form-group kontak-group mt-1">
	         <label for="">Pesan:</label>
	         <textarea name="pesan" class="form-control kontak-control" cols="10" rows="3" placeholder="Masukkan Pesan Anda"></textarea>
	       </div>
	 
	       <button class="button-kontak" type="submit" name="kirim"	value="kirim">Kirim</button>
     		</form>
   		</div>
 </div>
			</div>
		</div>
	</div>
</section>

<!-- Footer -->
<footer class="mt-4 pt-3">
		<p>Copyright @ 2023 - SMK Wikrama 1 Jepara</p>
</footer>
</div>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>