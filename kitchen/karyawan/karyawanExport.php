<?php
session_start();
if (!isset($_SESSION['email'])) {
    header('Location: ../../login.php');
}
function getKaryawanID(){
    include '../essentials/connection.php';
    $email = $_SESSION['email'];
    $query = "SELECT id_karyawan FROM karyawan WHERE email='$email'";
    $res = mysqli_query($conn, $query);
    if (!$res) {
        die("Database problem!");
    } else {
        if(mysqli_num_rows($res) == 0){
            echo "Username did not exist";
        } else {
            $data = mysqli_fetch_array($res);
            $_SESSION['id_karyawan'] = $data['id_karyawan'];
            return $_SESSION['id_karyawan'];
        }
    }
}


?>