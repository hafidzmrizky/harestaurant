<?php
include '../essentials/connection.php';
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
    <title>Kitchen | haRestaurant</title>
    <link rel="stylesheet" href="../assets/css/bootstrap.css">
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
      <a class="nav-item nav-link" href="menu/">Menu</a>
      <a class="nav-item nav-link" href="karyawan/">Karyawan</a>
      <a class="nav-item nav-link" href="../logout.php">Logout</a>
    </div>
  </div>
</nav>

<div class="container" style="margin-top: 1rem;">
<table class="table table-bordered">
<tr>
    <th>No</th>
    <th>Nomor Meja</th>
    <th>Nomor Pesanan</th>
    <th>Status Pesanan</th>
    <th>Status Bayar</th>
    <th>Metode Bayar</th>
    <th>Order Time</th>
    <th>Opsi</th>
</tr>
<?php
    $query = "SELECT * FROM transaksi";
    $exc = mysqli_query($conn, $query);
    $dataTransaksi = array();
    while ($row = mysqli_fetch_array($exc)) {
        $a = 1;
        echo '
        <tr>
        <td>'.$a.'</td>
        <td>'.$row['nomorMeja'].'</td>
        <td>'.$row['nomorTransaksi'].'</td>
        <td>'.$row['statusPesanan'].'</td>
        <td>'.$row['statusPembayaran'].'</td>
        <td>'.$row['metodePembayaran'].'</td>
        <td>'.$row['waktuTransaksi'].'</td>
        <td>
        <a class="btn btn-warning btn-sm" href="order/detail_order.php?id='.$row["idTransaksi"].'">Detail</a>
        <a class="btn btn-danger btn-sm" href="order/update_payment.php?id='.$row["idTransaksi"].'">Terbayar</a>
        </td>
        </tr>
        
        ';
        $a++;
    }

?>

</table>
</div>

</body>
</html>