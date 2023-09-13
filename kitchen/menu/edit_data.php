<?php
session_start();
include '../../essentials/connection.php';
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
	<?php		
		if(isset($_GET['id'])){

			$id = $_GET['id']; // id menu

			// cek id menu apakah ada di table menu
			$query_cek = "SELECT * FROM menu WHERE id=".$id;
			$result_cek = mysqli_query($conn,$query_cek);

			//mengecek apakah ada error ketika menjalankan query
			if(!$result_cek	){
				die ("Query Error: ".mysqli_errno($conn)." - ".mysqli_error($conn));
			
			// jika query tidak ada yg error
			}else{ 
				// jika data tidak ada
				if(mysqli_num_rows($result_cek) == 0){
					echo "data tidak tersedia";
				}else{
					$data = mysqli_fetch_array($result_cek);
	?>			<div class="container" style="margin-top: 1rem;">
					<form action="proses_edit.php" method="post" enctype="multipart/form-data" id="editData">
						<p>
							ID Menu <input class="form-control" type="text" name="id" value="<?= $data['id'] ?>" readonly>
						</p>
						<p>
							Nama <input class="form-control" type="text" name="nama" value="<?= $data['nama']; ?>">
						</p>
						<p>
							Harga <input class="form-control" type="number" name="harga" value="<?= $data['harga']; ?>">
						</p>
						<p>
							Tipe Menu 
						<select name="tipeMenu" class="form-control">
							<option value="Makanan" <?php if ($data['tipeMenu'] == 'Makanan') { echo 'selected'; }; ?>>Makanan</option>
                			<option value="Minuman" <?php if ($data['tipeMenu'] == 'Minuman') { echo 'selected'; };?>>Minuman</option>
						</select>
						</p>
						<p>
							Status Menu  
						<select name="statusMenu" class="form-control" >
							<option value="Tersedia" <?php if ($data['statusMenu'] == 'Tersedia') { echo 'selected'; }; ?>  >Tersedia</option>
                			<option value="Tidak Tersedia" <?php if ($data['statusMenu'] == 'Tidak Tersedia') { echo 'selected'; };?>>Tidak Tersedia</option>
						</select>
						</p>
						<p>Deskripsi <textarea class="form-control" name="deskripsi" form="editData" ><?php echo $data['deskripsi']; ?></textarea></p>
						<p>
                            <?php
                            echo '
                            <img src="../'.$data['image'].'" style="width: 128px;">                          
                            '
                            ?>
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
							<input class="btn btn-primary" type="submit" name="submit" value="Update">
							<a class="btn btn-light" href="index.php">kembali</a>
						</p>
					</form>
				</div>
	<?php
				}
			}
		}else{
			echo 'tidak dapat menampilkan form edit menu <a href="lihat_data.php">klik disini</a> untuk kembali';
		}
	?>
</body>
</html>