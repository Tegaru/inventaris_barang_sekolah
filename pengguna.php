<?php 
session_start();
if (!isset($_SESSION['session_username'])) {
  header('Location: login.php');
  exit();
}

?>
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
          <a class="nav-link " aria-current="page" href="dashboard.php">Dashboard</a>
        </li>
        <li class="nav-item mx-2">
          <a class="nav-link " aria-current="page" href="barang.php">Data Barang</a>
        </li>
        <li class="nav-item mx-2">
          <a class="nav-link " href="ruang.php">Data Ruang</a>
        </li>
        <li class="nav-item mx-2">
          <a class="nav-link active" href="pengguna.php">Data Pengguna</a>
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

<!-- Tampilkan Pengguna -->
<section id="hero" style="height: 100%;">
	<div class="container mt-4">
		<div class="row mt-4">
			<h2 class="dashboard"><i class="bi bi-person-check"></i> Data Pengguna</h2>
      
			<div class="table-responsive">
        <button type="button" class="btn btn-sm button-tambah" data-bs-toggle="modal" data-bs-target="#tambah_Pengguna"><span class="t-tambah">+</span> Tambah Pengguna</button>
          <table class="table table-bordered table-striped table-hover">
            <thead class="custom-table-dark">
              <tr>
                <th>No</th>
                <th>Nama Pengguna</th>
                <th>Jenis Kelamin</th>
                <th>No Telp</th>
                <th>Status</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
            <?php 
                
              require "koneksi.php";
              $limit = 5; 
              $page = isset($_GET['page']) ? max(1, intval($_GET['page'])) : 1;
              $skip = ($page - 1) * $limit;
              $sql = "SELECT * FROM tb_pengguna LIMIT $skip, $limit";
              $result = $mysqli->query($sql);

              $no = ($page - 1) * $limit + 1;
              if($result->num_rows > 0) :
              while($row = $result->fetch_assoc()) :

            ?>
                  <tr>
                    <td><?= $no++; ?></td>
                    <td><?= $row["nama_pengguna"] ?></td>
                    <td><?= $row["jenis_kelamin"] ?></td>
                    <td><?= $row["no_hp"] ?></td>
                    <td><?= $row["status_pengguna"] ?></td>
                    <td>
                      
                      <a href="#" class="btn btn-hijau btn-sm" data-bs-toggle="modal" data-bs-target="#edit_Pengguna<?= $row['id_pengguna'] ?>"><i class="bi bi-pencil-square"></i> Ubah</a>
                      <a href="crud_pengguna.php?id=<?= $row['id_pengguna'] ?>" class="btn btn-merah btn-sm delete"><i class="bi bi-trash"></i> Hapus</a>
                    </td>
                  </tr>
                  <!-- Modal Edit-->
              <div class="modal fade" id="edit_Pengguna<?= $row['id_pengguna'] ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header m-header">
                      <h5 class="modal-title" id="staticBackdropLabel"><i class="bi bi-pencil-square"></i> Edit Data Pengguna</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form method="post" action="crud_pengguna.php">
                    <div class="modal-body">
                      <div class="form-group">
                           <!-- <label for="">ID Pengguna:</label> -->
                           <input type="hidden" class="form-control" name="id_pengguna" value="<?= $row['id_pengguna'] ?>" readonly>
                         </div>
                         <div class="form-group mt-1">
                           <label for="">Nama Penggunna:</label>
                           <input type="text" class="form-control" name="nama_pengguna" value="<?= $row['nama_pengguna'] ?>" placeholder="Nama Pengguna">
                         </div>
                          <div class="form-group mt-1">
                           <label for="">Jenis Kelamin:</label>
                           <select name="jenis_kelamin" class="form-control">
                             <option value="Laki-laki" <?php if($row['jenis_kelamin'] === "Laki-laki"){echo "selected";} ?>>Laki-laki</option>
                             <option value="Perempuan" <?php if($row['jenis_kelamin'] === "Perempuan"){echo "selected";} ?>>Perempuan</option>
                           </select>
                         </div>
                          <div class="form-group mt-1">
                           <label for="">No Telp:</label>
                           <input type="number" class="form-control" name="no_hp" value="<?= $row['no_hp'] ?>" placeholder="No Telp" maxlength = "12">
                         </div>
                         <div class="form-group mt-1">
                           <label for="">Status:</label>
                           <select name="status_pengguna" class="form-control">
                             <option value="Siswa" <?php if($row['status_pengguna'] === "Siswa"){echo "selected";} ?>>Siswa</option>
                             <option value="Guru" <?php if($row['status_pengguna'] === "Guru"){echo "selected";} ?>>Guru</option>
                             <option value="Karyawan" <?php if($row['status_pengguna'] === "Karyawan"){echo "selected";} ?>>Karyawan</option>
                           </select>
                         </div>
                    </div>
                    <div class="modal-footer">
                      <button type="submit" class="btn btn-hijau" name="bedit"><i class="bi bi-save"></i> Simpan</button>
                      <button type="button" class="btn btn-danger" data-bs-dismiss="modal"><i class="bi bi-x-circle"></i> Batal</button>
                    </div>
                    </form>
                  </div>
                </div>
              </div>
              <?php
                endwhile; 
               endif;
             ?>
            </tbody>
          </table>
      </div>
		</div>


        <?php
          // Tampilkan navigasi halaman
        // $totalRows = $result->num_rows;
        $query = "SELECT COUNT(id_pengguna) AS total_rows FROM tb_pengguna";
            $result1 = $mysqli->query($query);

            if ($result1) {
                $totalRows = $result1->fetch_assoc()['total_rows'];
            } else {
                $totalRows = 0;
            }
        $totalPages = ceil($totalRows / $limit);
          echo '<nav aria-label="Halaman Navigasi">';
          echo '<ul class="pagination pagination-sm justify-content-end">';

          // Tombol Previous
          echo '<li class="page-item ' . ($page <= 1 ? 'disabled' : '') . '">';
          echo '<a class="page-link" href="?page=' . ($page - 1) . '" tabindex="-1" aria-disabled="true">&laquo</a>';
          echo '</li>';

          // Tombol halaman
          for ($i = 1; $i <= $totalPages; $i++) {
              echo '<li class="page-item ' . ($page == $i ? 'active' : '') . '"><a class="page-link" href="?page=' . $i . '">' . $i . '</a></li>';
          }

          // Tombol Next
          echo '<li class="page-item ' . ($page >= $totalPages ? 'disabled' : '') . '">';
          echo '<a class="page-link" href="?page=' . ($page + 1) . '" >&raquo</a>';
          echo '</li>';

          echo '</ul>';
          echo '</nav>';
        ?>

	   </div>
</section>

<!-- Modal Tambah-->
<div class="modal fade" id="tambah_Pengguna" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header m-header">
        <h5 class="modal-title" id="staticBackdropLabel"><i class="bi bi-person-fill"></i> Tambah Data Pengguna</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form method="post" action="crud_pengguna.php">
      <div class="modal-body">
           <div class="form-group">
             <label for="">Nama Pengguna:</label>
             <input type="text" class="form-control" name="nama_pengguna" placeholder="Nama Pengguna" required>
           </div>
            <div class="form-group mt-1">
             <label for="">Jenis Kelamin:</label>
             <select class="form-control" name="jenis_kelamin">
               <option selected>-- Pilih --</option>
               <option value="Laki-laki">Laki-laki</option>
               <option value="Perempuan">Perempuan</option>
             </select>
           </div>
            <div class="form-group mt-1">
             <label for="">No Telp:</label>
             <input type="number" class="form-control" name="no_hp" placeholder="No Telp" maxlength="12" required>
           </div>
           <div class="form-group mt-1">
             <label for="">Status:</label>
             <select class="form-control" name="status_pengguna">
               <option selected>-- Pilih --</option>
               <option value="Siswa">Siswa</option>
               <option value="Guru">Guru</option>
               <option value="Karyawan">Karyawan</option>
             </select>
           </div>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-ungu" name="bsimpan"><i class="bi bi-plus-circle"></i> Tambah</button>
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal"><i class="bi bi-x-circle"></i> Batal</button>
      </div>
      </form>
    </div>
  </div>
</div>


<!-- Footer -->
</div>
<footer class="footer-barang">
		<p class="mt-2">Copyright @ 2023 - SMK Wikrama 1 Jepara</p>
</footer>

  <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
  <script src="assets/js/alert.js"></script>
  <!-- SweetAlert JS -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.16/dist/sweetalert2.all.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>