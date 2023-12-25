<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Laporan Peminjaman</title>
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

	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/2.4.2/css/buttons.dataTables.min.css">
</head>
<body>
 <nav class="navbar navbar-expand-lg ">
  <div class="container">
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav mx-auto">
        <li class="nav-item mx-2">
          <a class="nav-link " aria-current="page" href="dashboard.php">Dashboard</a>
        </li>
        <li class="nav-item mx-2">
          <a class="nav-link " aria-current="page" href="barang.php">Data Barang</a>
        </li>
        <li class="nav-item mx-2">
          <a class="nav-link " href="ruang.php">Data Ruang</a>
        </li>
        <li class="nav-item mx-2">
          <a class="nav-link " href="pengguna.php">Data Pengguna</a>
        </li>
        <li class="nav-item mx-2">
          <a class="nav-link" href="peminjaman.php">Peminjaman</a>
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
<div class="container">
<h2 class="dashboard  mt-3">Laporan Peminjaman</h2>
<a href="peminjaman.php">
    <button type="button" class="btn btn-sm button-tambah custom-button">Kembali</button>
</a>
<table id="example" class="display nowrap" style="width:100%">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Pengguna</th>
                <th>Nama Barang</th>
                <th>Tanggal Pinjam</th>
                <th>Tanggal Kembali</th>
                <th>Jumlah Pinjam</th>
            </tr>
        </thead>
        <tbody>
        	<?php 
              require "koneksi.php";

        	  $sql = "SELECT * FROM tb_peminjaman 
              INNER JOIN tb_pengguna ON tb_peminjaman.id_pengguna = tb_pengguna.id_pengguna
              INNER JOIN tb_barang ON tb_peminjaman.kode_barang = tb_barang.kode_barang";

              $result = $mysqli->query($sql);

              $no = 1;
              if($result->num_rows > 0) :
              while($row = $result->fetch_assoc()) :
        	?>
            <tr>
                <td><?= $no++; ?></td>
                <td><?= $row["nama_pengguna"] ?></td>
                <td><?= $row["nama_barang"] ?></td>
                <td><?= $row["tanggal_peminjaman"] ?></td>
                <td><?= $row["tanggal_kembali"] ?></td>
                <td><?= $row["jumlah_pinjam"] ?></td>
                
            </tr>
           <?php
                  endwhile;
            	endif;
            ?>
        </tbody>
    </table>
</div>
<script type="text/javascript" src="https://code.jquery.com/jquery-3.7.0.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/2.4.2/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.html5.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.print.min.js"></script>

<script type="text/javascript">
	
$(document).ready(function() {
    $('#example').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            'excel', 'pdf', 'print'
        ]
    } );
} );

</script>
</body>
</html>