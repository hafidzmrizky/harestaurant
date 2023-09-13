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
    <title>Menu | haRestaurant</title>
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
<a style="margin-bottom: 1rem;" class="btn btn-primary" href='tambah.php'> Tambah Data</a>
<table class="table table-bordered">
<tr>
    <th>No</th>
    <th>Nama</th>
    <th>Harga</th>
    <th>Status Menu</th>
    <th>Tipe Menu</th>
    <th>Opsi</th>
</tr>
<?php
    $query 	= "SELECT * FROM menu";
    $result = mysqli_query($conn,$query);
    if(mysqli_num_rows($result) == 0){
        echo '
            <tr>
                <td colspan="6">Tidak Ada Data</td>
            </tr>';
    }
    $no = 1;
    while($row = mysqli_fetch_assoc($result)){
        $isStokStatus = ($row['statusMenu'] == "Tersedia") ? '<span class="badge badge-success" style="padding: 0.5rem">Tersedia</span>' : '<span class="badge badge-danger" style="padding: 0.5rem">Habis</span>';
        echo '
        <tr>
            <td>'.$no++.'</td>
            <td>'.$row['nama'].'</td>
            <td>'.number_format($row["harga"],0,",",".").'</td>
            <td>'.$isStokStatus.'</td>
            <td>'.$row['tipeMenu'].'</td>
            <td>
            <a class="btn btn-warning btn-sm" href="edit_data.php?id='.$row["id"].'">edit</a>
            <a class="btn btn-danger btn-sm" href="hapus_data.php?id='.$row["id"].'">hapus</a>
        </td>
        </tr>
        ';
    }

?>


</table>
</div>

</body>
</html>