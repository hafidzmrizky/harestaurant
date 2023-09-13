<?php
session_start();
if (isset($_POST['loginBtn'])) {
    include '../essentials/connection.php';
    $email = $_POST['email'];
    $password = $_POST['password'];
    $password = md5($password);

    $query = "SELECT * FROM login WHERE email='$email' AND password='$password'";
    $res = mysqli_query($conn, $query);
    if (!$res) {
        die("Database problem!");
    } else {
        if(mysqli_num_rows($res) == 0){
            echo "Login Gagal: Username/Password salah!";
        } else {
            $data = mysqli_fetch_array($res);
            $_SESSION['email'] = $data['email'];
            header("Location: ../index.php");
        }
    }
} else {
    header("Location: login.php");
}

?>