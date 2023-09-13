<?php
include '../essentials/connection.php';
include '../process/get_product_details.php';
include_once '../process/process_cart.php';
include '../kitchen/karyawan/karyawanExport.php';
session_start();
if (!isset($_SESSION['email'])) {
    header('Location: ../../login.php');
}

session_start();
if (!isset($_SESSION['email'])) {
	header('Location: ../login.php');
}




?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Checkout - haRestaurant | 2023</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="../assets/css/bootstrap.css">
        <link rel="stylesheet" href="../assets/css/checkout.css">
    </head>
    <body>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <a class="navbar-brand" href="../index.php">HaRestaurant</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>
          
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
              <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                  <a class="nav-link" href="../index.php">Home <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="../checkOrderStatus.php">Check Order Status</a>
                </li>
                  <li class="nav-item active" >
                    <a class="nav-link" href="../cart.php">Keranjang</a>
                  </li>
              </ul>
              <?php
              if (isset($_SESSION['email'])) {
                $username = explode("@", $_SESSION["email"]);
                echo '<a style="margin-right: 5px;">Hai, '.$username[0].'</a>';
                echo '<a class="btn btn-outline-primary" href="../kitchen/index.php"style="margin-right: 0.5rem;">Dashboard Admin</a>';
                echo '<a class="btn btn-outline-danger" href="../logout.php">Logout</a>';
              } else {
                echo '
                <a href="login.php" class="btn btn-outline-success my-2 my-sm-0" type="submit">Masuk</a>
                ';
              }
              ?>
                
            </div>
          </nav>
        <div class="container" style="display: flex; justify-content: center; align-items: center;">
        <div class="row">
            <div class="col-md-12 col-12" style="display: flex; justify-content: center; align-items: center;">
              <img class="check" src="../assets/images/CheckMark-01.webp">
            </div>
            <div class="col-md-12 col-12" style="text-align: center;">
                <h3>Terima kasih telah memesan!</h3>
                <p>Anda akan diarahkan ke halaman status pesanan dalam 10 detik.</p>
                <p>Simpan Informasi Pembayaran ini:</p>
                <?php
                if ($_POST['metodePembayaran'] == "cash") {
                    echo '
                    <p>Metode Pembayaran: Cash</p>
                    <p>Total Pembayaran: Rp. '.number_format($_POST['totalPembayaran'], 0, ',', '.').'</p>
                    ';
                } 
                if ($_POST['metodePembayaran'] == "qris") {
                    echo '
                    <p>Metode Pembayaran: QRIS</p>
                    <img src="../assets/images/qris.png" style="width: 200px; height: 200px;">
                    <p>Total Pembayaran: Rp. '.number_format($_POST['totalPembayaran'], 0, ',', '.').'</p>
                    ';
                }
                if ($_POST['metodePembayaran'] == "transfer") {
                    echo '
                    <p>Metode Pembayaran: Transfer</p>
                    <p>Rekening: 1234567890</p>
                    <p>Atas Nama: HaRestaurant</p>
                    <p>Total Pembayaran: Rp. '.number_format($_POST['totalPembayaran'], 0, ',', '.').'</p>
                    ';
                }

                ?>
            </div>



        
        </div>
        </body>
</html>



<?php

$arrayItems = getCartItem();
$nomorMeja = rand(1, 100);
$statusPesanan = "pending";
$metodePembayaran = $_POST['metodePembayaran'];
$statusPembayaran = "pending";
$idKaryawan = getKaryawanID();
$query = "INSERT INTO transaksi(nomorMeja, statusPesanan, metodePembayaran, statusPembayaran, idKaryawan) VALUES('$nomorMeja', '$statusPesanan', '$metodePembayaran', '$statusPembayaran', '$idKaryawan')";
$res = mysqli_query($conn, $query);
if (!$res) {
    $_SESSION['notification'] = "Gagal menambahkan pesanan!";
    header("Location: ../cart.php");
}
$idTransaksi = mysqli_insert_id($conn);
$query = "UPDATE transaksi SET nomorTransaksi='A000$idTransaksi' WHERE idTransaksi='$idTransaksi'";
$hasil = mysqli_query($conn, $query);
foreach ($arrayItems as $item) {
    $idMenu = $item['idMenu'];
    $quantity = $item['quantity'];
    $query3 = "INSERT INTO transaksiDetail(idTransaksi, idMenu, quantity, statusPesananMenu) VALUES('$idTransaksi', '$idMenu', '$quantity', 'pending')";
    $res3 = mysqli_query($conn, $query3);
    if (!$res3) {
        $_SESSION['notification'] = "Gagal menambahkan pesanan!";
        header("Location: ../cart.php");
    } else {
        deleteItemCart($idMenu);
        deleteCart();
        $_SESSION['notification'] = "Berhasil menambahkan pesanan!";
        // countdown 10 seconds
        header("Refresh: 10; url=../checkOrderStatus.php?idTransaksi=A000$idTransaksi");
        
    }
    

}

?>