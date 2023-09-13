<?php
include '../../essentials/connection.php';
session_start();
if (!isset($_SESSION['email'])) {
	header('Location: ../login.php');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Karyawan | haRestaurant</title>
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
      <a class="nav-item nav-link" href="../menu/">Menu</a>
      <a class="nav-item nav-link active" href="">Karyawan</a>
      <a class="nav-item nav-link" href="../../logout.php">Logout</a>
    </div>
  </div>
</nav>

<div class="container" style="margin-top: 1rem;">
<a style="margin-bottom: 1rem;" class="btn btn-primary" href='tambahData.php'> Tambah Data</a>
<table class="table table-bordered table-responsive">
<tr>
    <th>No</th>
    <th>ID Karyawan</th>
    <th>Nama Karyawan</th>
    <th>Alamat</th>
    <th>No HP</th>
    <th>Email</th>
    <th>Gender</th>
    <th>Jabatan</th>
    <th>Opsi</th>
</tr>
<?php
    $query 	= "SELECT * FROM karyawan";
    $result = mysqli_query($conn,$query);
    if(mysqli_num_rows($result) == 0){
        echo '
            <tr>
                <td colspan="6">Tidak Ada Data</td>
            </tr>';
    }
    $no = 1;
    while($row = mysqli_fetch_assoc($result)){
        echo '
        <tr>
            <td>'.$no++.'</td>
            <td>'. $row['id_karyawan']. '</td>
            <td>'. $row['nama_karyawan']. '</td>
            <td>'. $row['alamat']. '</td>
            <td>'. $row['no_hp']. '</td>
            <td>'. $row['email']. '</td>
            <td>'. $row['gender']. '</td>
            <td>'. $row['jabatan']. '</td>
            <td>
            <a class="btn btn-warning btn-sm" href="editData.php?id='.$row["id_karyawan"].'">edit</a>
            <a class="btn btn-danger btn-sm" href="hapusData.php?id='.$row["id_karyawan"].'">hapus</a>
        </td>
        </tr>
        ';
    }

?>


</table>
</div>

</body>
</html>