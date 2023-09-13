<?php
session_start();
include '../../essentials/connection.php';
if (!isset($_SESSION['email'])) {
	header('Location: ../login.php');
}

$id = $_GET['id'];
$query = "UPDATE transaksi SET statusPembayaran = 'paid' WHERE idTransaksi = '$id'";
$exc = mysqli_query($conn, $query);
if ($exc) {
    header('Location: ../');
} else {
    echo 'gagal';
}

?>