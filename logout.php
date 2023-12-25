<?php 

session_start();

$_SESSION['$session_username'] = '';
$_SESSION['$session_password'] = '';

session_destroy();

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
			        icon: 'info',
			        title: 'Logout',
					text: 'Anda Berhasil Logout',
			    }).then((result) => {
			        window.location.href = 'login.php';
			        
			    });
			</script>
			</body>
			</html>";

 ?>