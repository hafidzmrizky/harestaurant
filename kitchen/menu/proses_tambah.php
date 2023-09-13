<?php
	session_start();
	if (!isset($_SESSION['email'])) {
		header('Location: ../login.php');
	}
	// di cek apakah ada data post dengan nama index nya "nama"
	if(isset($_POST['nama'])){
		include '../../essentials/connection.php';

		$nama_menu 		= $_POST['nama'];
		$harga_menu 	= $_POST['harga'];
		$tipeMenu		= $_POST['tipeMenu'];
		$statusMenu		= $_POST['statusMenu'];
		$deskripsi		= $_POST['deskripsi'];
		$dirUpload = "../../assets/images/";

		if (isset($_FILES['berkas'])) {
			$totalUpload = count((array)$_FILES['berkas']['name']);
			$explodeData;
		
			for ($a = 0; $a < $totalUpload; $a++) {
				$namaFile = $_FILES['berkas']['name'][$a];
				$tmpName = $_FILES['berkas']['tmp_name'][$a];
				$fileSize = $_FILES['berkas']['size'][$a];
				$fileType = $_FILES['berkas']['type'][$a];
				$fileMax = 2 * 1024 * 1024;
				$fileMin = 10 * 1024;
				$readableFileSize = $fileSize >= 1024 * 1024 ? round($fileSize / (1024 * 1024), 2) . "MB" : ($fileSize >= 1024 ? round($fileSize / 1024, 2) . "KB" : ($fileSize > 1 ? $fileSize . "bytes" : $fileSize . "byte"));
		
				if ($fileType == 'image/png' || $fileType == 'image/jpeg' || $fileType == 'image/gif' || $fileType == 'image/jpg') {
					if ($fileSize > $fileMax) {
						die("File diatas 2MB, silahkan kecilkan ukuran file. Ukuran file yang diupload: " . $readableFileSize);
					} else {
						if($fileSize < $fileMin) {
							die("File harus minimal sebesar 10kb. Ukuran file yang diupload: " . $readableFileSize);
						} else {
							$path_file = $dirUpload.md5($namaFile.rand(0, microtime(true) * 1000)).$namaFile;
							$uploadStatus = move_uploaded_file($tmpName, $path_file);
							if ($uploadStatus) {
								if ($a < 1) {
									$explodeData = $path_file;
									$explodeName = $namaFile;
								} else {
									$explodeData = $explodeData."~".$path_file;
									$explodeName = $explodeName."~".$namaFile;
								}
							} else {
								die("Upload Tidak Berhasil");
							}
						}
					}
				} else {
					die("Tipe file tidak didukung!");
				}
			}
				$explode = explode("~", $explodeData);
				$nameArr = explode("~", $explodeName);
				$query = "INSERT INTO menu(nama,harga, tipeMenu, statusMenu, image, deskripsi) VALUES('$nama_menu','$harga_menu', '$tipeMenu', '$statusMenu', '$explodeData', '$deskripsi' )";
				$res = mysqli_query($conn, $query);
				if(!$res){
					die ("Query Error: ".mysqli_errno($conn)." - ".mysqli_error($conn));
				}else{
					echo "Upload berhasil!<br/>";
					header("Location:index.php");
				}
		}



		//mengecek apakah ada error ketika menjalankan query
		if(!$result){
			die ("Query Error: mysqli_errno($conn)' - mysqli_error($conn)");
		}else{
			header("Location:lihat_data.php");
		}

	// jika ga ada maka tampilkan pesan dibawah ini
	}else{
		echo "form tambah menu harus di isi";
	}	

?>