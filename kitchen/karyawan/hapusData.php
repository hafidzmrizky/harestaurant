<?php
session_start();
if (!isset($_SESSION['email'])) {
    header('Location: ../../login.php');
}

include '../../essentials/connection.php';
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = "DELETE FROM karyawan WHERE id_karyawan='$id'";
    $res = mysqli_query($conn, $query);
    if (!$res) {
        die ("Query Error: ".mysqli_errno($conn)." - ".mysqli_error($conn));
    } else {
        header("Location: index.php");
    }
} else {
    echo "ID belum terkirim, tidak dapat melanjutkan. <a href='lihatData.php'>Kembali?</a>";
}

?>