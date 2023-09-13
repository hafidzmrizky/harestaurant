<?php
	session_start();
	if (!isset($_SESSION['email'])) {
		header('Location: ../../login.php');
	}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title></title>
	<link rel="stylesheet" href="../../assets/css/bootstrap.css">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="#">Kitchen | haRestaurant</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
    <div class="navbar-nav">
      <a class="nav-item nav-link" href="../">Orders</a>
      <a class="nav-item nav-link active" href="">Menu</a>
      <a class="nav-item nav-link" href="../karyawan/">Karyawan</a>
      <a class="nav-item nav-link" href="../../logout.php">Logout</a>
    </div>
  </div>
</nav>
	<div class="container" style="margin-top: 1rem;">
	<form action="proses_tambah.php" method="post"  enctype="multipart/form-data" id="tambahData">
		<p>
			Nama <input class="form-control" type="text" name="nama">
		</p>
		<p>
			Harga <input class="form-control" type="number" name="harga">
		</p>
		<p>
			Tipe Menu 
		<select name="tipeMenu" class="form-control">
			<option value="Makanan">Makanan</option>
        	<option value="Minuman">Minuman</option>
		</select>
		</p>
		<p>
			Status Menu  
		<select name="statusMenu" class="form-control">
			<option value="Tersedia">Tersedia</option>
    		<option value="Tidak Tersedia">Tidak Tersedia</option>
		</select>
		</p>
		<p>Deskripsi <textarea class="form-control" name="deskripsi" form="tambahData" ></textarea></p>
		<div class="input-group mb-3">
							<div class="input-group-prepend">
								<span class="input-group-text">Upload</span>
							</div>
							<div class="custom-file">
							<input class="custom-file-input" type="file" name="berkas[]" accept="image/jpeg, image/jpg, image/png, image/gif"/>
								<label class="custom-file-label" for="inputGroupFile01">Choose file</label>
							</div>
						</div>
		<p>
			<input class="btn btn-primary" type="submit" name="submit" value="Simpan">
			<input class="btn btn-danger" type="reset" name="reset">
			<a class="btn btn-light" href="index.php">kembali</a>
		</p>
	</form>
</div>
</body>
</html>