<?php 
session_start();
require "koneksi.php";

$err = "";
$username = "";


if (isset($_SESSION['session_username'])) {
	header('Location: dashboard.php');
}

if (isset($_POST['login'])) {
	$username = $_POST['username'];
	$password = $_POST['password'];

	$sql1 = "SELECT * FROM tb_user WHERE username = '$username'";
	$q1 = $mysqli->query($sql1);
	if($q1->num_rows > 0) {
		$r1 = $q1->fetch_assoc();

		if ($r1['username'] == $username AND $r1['password'] == md5($password)  ) {
			$_SESSION['session_username'] = $username;
			$_SESSION['session_password'] = $password;
			echo "<!DOCTYPE html>
			<html>
			<head>
				<title>Alert Berhasil</title>
			</head>
			<body>
			<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
			<script>
				Swal.fire({
			        position: 'center',
			        icon: 'success',
			        title: 'Login Berhasil',
			        text: 'SELAMAT DATANG " .strtoupper($_SESSION['session_username']). "',
			        showConfirmButton: false,
			        timer: 1500
			    }).then((result) => {
			        window.location.href = 'dashboard.php';
			        
			    });
			</script>
			</body>
			</html>";
			
			exit();

		} elseif ($r1['username'] == $username AND $r1['password'] != md5($password) ) {
			echo "<!DOCTYPE html>
			<html>
			<head>
				<title>Alert Gagal</title>
			</head>
			<body>
			<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
			<script>
				Swal.fire({
			        position: 'center',
			        icon: 'info',
			        title: 'Login Gagal',
			        text: 'Password Anda salah!',
			        // showConfirmButton: false,
			        // timer: 1500
			    }).then((result) => {
			        window.location.href = 'login.php';
			        
			    });
			</script>
			</body>
			</html>";
		} 

	} else {
		echo "<!DOCTYPE html>
			<html>
			<head>
				<title>Alert Gagal</title>
			</head>
			<body>
			<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
			<script>
				Swal.fire({
			        position: 'center',
			        icon: 'error',
			        title: 'Login Gagal',
			        text: 'Username dan Password Salah!',
			        // showConfirmButton: false,
			        // timer: 1500
			    }).then((result) => {
			        window.location.href = 'login.php';
			        
			    });
			</script>
			</body>
			</html>";
			
			exit();

	}
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
	 <!-- SweetAlert CSS -->
	 <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.16/dist/sweetalert2.min.css">
</head>

<body class="utama">
<!-- Hero Section -->
<section id="hero" style="height: 100%;">
	<div class="container login">

		<div class="row mt-4">
			<div class="col-md-6 login">
				<img src="assets/img/login.png" alt="" class="img-login">
			</div>
			<div class="col-md-6 form-login end-0">

			<form method="post" action="#" class="login p-5">
				<div class="d-flex justify-content-center">
				<img src="assets/img/logo_smk.png" alt="" class="logo-login" width="50px">
					
				</div>
				<h3 class="judul-login">Selamat Datang</h3>
				<p class="p-login">Masukan username dan passwod untuk login</p>
		        <div class="form-group mt-1">
		         <label for="username">Username:</label>
		         <input type="text" class="form-control login-control" name="username" placeholder="Masukkan Username">
		        </div>
		       <div class="form-group mt-1">
		         <label for="password">Password:</label>
		         <input type="password" class="form-control login-control" name="password" placeholder="Masukkan Password">
		       </div>
	          <button class="btn-login" type="submit" name="login" value="Login">Login</button>
     		</form>
		</div>
		</div>
	</div>
</section>
<footer class=" pt-3">
		<p>Copyright @ 2023 - SMK Wikrama 1 Jepara</p>
</footer>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<!-- <script src="assets/js/jquery-3.7.1.min.js"></script> -->
<script src="assets/js/alert.js"></script>
<!-- SweetAlert JS -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.16/dist/sweetalert2.all.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>