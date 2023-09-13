<?php
session_start();
if (!isset($_SESSION['email'])) {
    header('Location: ../../login.php');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
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
      <a class="nav-item nav-link" href="../">Orders</a>
      <a class="nav-item nav-link" href="../menu">Menu</a>
      <a class="nav-item nav-link active" href="">Karyawan</a>
      <a class="nav-item nav-link" href="../../logout.php">Logout</a>
    </div>
  </div>
</nav>
<div class="container" style="margin-top: 1rem;">
<form action="prosesTambahData.php" method="post" id="tambahData">
            <p>Nama Karyawan <input class="form-control" required name="namaKaryawan"  type="text"></input></p>
            <p>Alamat Karyawan <textarea class="form-control" name="alamat" form="tambahData" required></textarea></p>
            <p>No HP <input class="form-control" required name="noHP" type="number" ></input></p>
            <p>Email Karyawan <input class="form-control" required name="email"  type="email"></input></p>
            <p>Gender
            <select name="gender" class="form-control" required>
                <option value="Laki-laki" >Laki-laki</option>
                <option value="Perempuan" >Perempuan</option>
            </select>
            </p>
            <p>Jabatan Karyawan
            <select name="jabatan" class="form-control" required>
                <option value="Manager" >Manager</option>
                <option value="Teknisi" >Teknisi</option>
                <option value="Koki" >Koki</option>
                <option value="Kasir">Kasir</option>
            </select>
            </p>
            <input class="btn btn-primary" type="submit" name="submitBtn" value="Insert">
            <a class="btn btn-light" href="index.php">kembali</a>
</form>     
</div>
</body>
</html>