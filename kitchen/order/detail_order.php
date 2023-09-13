<?php
include '../../essentials/connection.php';
include '../../process/get_product_details.php';
session_start();
if (!isset($_SESSION['email'])) {
	header('Location: ../login.php');
}

if (!isset($_GET['id'])) {
    header('Location: index.php');
} 
$id = $_GET['id'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kitchen | haRestaurant</title>
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
      <a class="nav-item nav-link active" href="#">Orders</a>
      <a class="nav-item nav-link" href="#">Menu</a>
      <a class="nav-item nav-link" href="#">Karyawan</a>
      <a class="nav-item nav-link" href="../logout.php">Logout</a>
    </div>
  </div>
</nav>

<div class="container" style="margin-top: 1rem;">
<div class="row" style="margin-bottom: 0.5rem;">
<div class="col-md-6">
    <h3>Detail Transaksi</h3>
</div>
<div class="col-md-6">
    <a class="btn btn-primary" href="../index.php" style="float: right;">Back</a>
</div>
</div>
<table class="table table-bordered">
    <tr>
        <th>No</th>
        <th>Nama Menu</th>
        <th>Status</th>
        <th>Quantity</th>
        <th>Harga</th>
        <th>Sub Total</th>
        <th>Opsi</th>
    </tr>
    <?php
    $dataDetail = getDataTransaksi($id);
    $totalHarga = 0;
    for ($i=0; $i < count($dataDetail); $i++) { 
      $idMenu = $dataDetail[$i]['idMenu'];
      $menuDetail = getMenuDetail($dataDetail[$i]['idMenu']);
      $totalHarga += $menuDetail['harga'];
      $subTotal = $menuDetail['harga'] * $dataDetail[$i]['quantity'];
      echo '
      <tr>
        <td>'.($i+1).'</td>
        <td>'.$menuDetail['nama'].'</td>
        <td>'.$dataDetail[$i]['statusPesananMenu'].'</td>
        <td>'.$dataDetail[$i]['quantity'].'</td>
        <td>Rp'.number_format($menuDetail['harga'], 0, ",", ".").'</td>
        <td>Rp'.number_format($subTotal, 0, ",", ".").'</td>
        <td>
        <a class="btn btn-danger btn-sm" href="update_status_detail.php?id='.$id.'&idMenu='.$idMenu.'&status=1">Reject</a>
        <a class="btn btn-secondary btn-sm" href="update_status_detail.php?id='.$id.'&idMenu='.$idMenu.'&status=2">Pending</a>
        <a class="btn btn-success btn-sm" href="update_status_detail.php?id='.$id.'&idMenu='.$idMenu.'&status=3">Ready</a>

        </td>
      </tr>
      ';
    }

?>
</table>
</div>

</body>
</html>