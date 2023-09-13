<?php
session_start();
include '../../essentials/connection.php';
if (!isset($_SESSION['email'])) {
	header('Location: ../login.php');
}

$id = $_GET['id'];
$idMenu = $_GET['idMenu'];
$status = $_GET['status'];

function updateStatus($id) {
    include '../../essentials/connection.php';
    $query = 'SELECT * FROM transaksiDetail WHERE idTransaksi = '.$id.'';
    $exc = mysqli_query($conn, $query);
    $totalData = mysqli_num_rows($exc);
    $readyCount = 0;
    $pendingCount = 0;
    $rejectCount = 0;
    while ($row = mysqli_fetch_array($exc)) {
        switch ($row['statusPesananMenu']) {
            case 'ready':
                $readyCount++;
                break;
            case 'pending':
                $pendingCount++;
                break;
            case 'reject':
                $rejectCount++;
                break;
        }
    }

    if ($readyCount == $totalData - $rejectCount) {
        $status = 'ready';
    }

    if ($pendingCount == $totalData - $rejectCount) {
        $status = 'pending';
    } 

    if ($rejectCount == $totalData) {
        $status = 'reject';
    } 

    $query = 'UPDATE transaksi SET statusPesanan = "'.$status.'" WHERE idTransaksi = '.$id.'';
    $exc = mysqli_query($conn, $query);
}

switch ($status) {
    case 1: 
        $query = 'UPDATE transaksiDetail SET statusPesananMenu = "reject" WHERE idTransaksi = '.$id.' AND idMenu = '.$idMenu.'';
        $exc = mysqli_query($conn, $query);
        if ($exc) {
            updateStatus($id);
            header('Location: detail_order.php?id='.$id.'');
        } else {
            echo 'gagal';
        }
        break;
    
    case 2:
        $query = 'UPDATE transaksiDetail SET statusPesananMenu = "pending" WHERE idTransaksi = '.$id.' AND idMenu = '.$idMenu.'';
        $exc = mysqli_query($conn, $query);
        if ($exc) {
            updateStatus($id);
            header('Location: detail_order.php?id='.$id.'');
        } else {
            echo 'gagal';
        }
        break;

    case 3:
        $query = 'UPDATE transaksiDetail SET statusPesananMenu = "ready" WHERE idTransaksi = '.$id.' AND idMenu = '.$idMenu.'';
        $exc = mysqli_query($conn, $query);
        if ($exc) {
            updateStatus($id);
            header('Location: detail_order.php?id='.$id.'');
        } else {
            echo 'gagal';
        }
        break;

    default:
        echo 'gagal';
}


?>