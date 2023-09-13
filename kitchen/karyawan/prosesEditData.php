<?php
session_start();
if (!isset($_SESSION['email'])) {
    header('Location: ../../login.php');
}
include '../../essentials/connection.php';


if(isset($_POST['idKaryawan'])) {
    $idKaryawan = $_POST['idKaryawan'];
    $namaKaryawan = $_POST['namaKaryawan'];
    $alamat = $_POST['alamat'];
    $noHP = $_POST['noHP'];
    $email = $_POST['email'];
    $gender = $_POST['gender'];
    $jabatan = $_POST['jabatan'];

    $query = "UPDATE karyawan SET nama_karyawan='$namaKaryawan', alamat='$alamat', no_hp='$noHP', email='$email', gender='$gender', jabatan='$jabatan' WHERE id_karyawan='$idKaryawan'";
    $res = mysqli_query($conn, $query);
    if(!$res){
        die ("Query Error: ".mysqli_errno($conn)." - ".mysqli_error($conn));
    }else{
        header("Location: index.php"); 
        exit;
    }

} else {
    echo "Formulir Edit harus diisi untuk dapat melanjutkan, <a href='lihatData.php'>Kembali</a>";
}

?>