<?php
session_start();
if (!isset($_SESSION['email'])) {
    header('Location: ../../login.php');
}
include '../../essentials/connection.php';
if (isset($_POST['submitBtn'])) {
    $namaKaryawan = $_POST['namaKaryawan'];
    $alamat = $_POST['alamat'];
    $noHP = $_POST['noHP'];
    $email = $_POST['email'];
    $gender = $_POST['gender'];
    $jabatan = $_POST['jabatan'];

    $query = "INSERT INTO karyawan(nama_karyawan, alamat, no_hp, email, gender, jabatan) VALUES ('$namaKaryawan',' $alamat', '$noHP', '$email', '$gender', '$jabatan')";
    $res = mysqli_query($conn, $query);
    if (!$res) {
        die ("Query Error: ".mysqli_errno($conn)." - ".mysqli_error($conn) . "<a href='lihatData.php'>Kembali ke Lihat Data</a>");
    } else {
        header("Location: index.php");
    }
} else {
    echo "Data belum berhasil ditambahkan, silahkan coba lagi dengan menyertakan semua kolom. <a href='lihatData.php'>Kembali ke Lihat Data</a>";
}


?>