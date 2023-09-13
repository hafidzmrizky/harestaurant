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
    <title>Kitchen Edit Karyawan</title>
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

<?php
include '../../essentials/connection.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = "SELECT * FROM karyawan WHERE id_karyawan='$id'";
    $res = mysqli_query($conn, $query);
    if ($res->num_rows > 0) {
        while ($rows = $res->fetch_assoc()) {
            echo '
            <div class="container" style="margin-top: 1rem;">
            <form action="prosesEditData.php" method="post" id="editData">
            <p>ID Karyawan <input class="form-control" name="idKaryawan" readonly type="text"  value=' . $rows['id_karyawan'] .'></input></p>
            <p>Nama Karyawan <input class="form-control" name="namaKaryawan"  type="text"  value=' . $rows['nama_karyawan'] .'></input></p>';
            ?>
            <p>Alamat Karyawan <textarea class="form-control" name="alamat" form="editData" ><?php echo $rows['alamat']; ?></textarea></p>
            <?php
            echo '
            <p>No HP <input class="form-control" name="noHP" type="number"  value=' . $rows['no_hp'] .'></input></p>
            <p>Email Karyawan <input class="form-control" name="email"  type="email"  value=' . $rows['email'] .'></input></p>
            ';
            ?>
            <p>Gender Karyawan
            <select name="gender" class="form-control">
                <option value="Laki-laki" <?php if ($rows['gender'] == 'Laki-laki') { echo 'selected'; }; ?>  >Laki-laki</option>
                <option value="Perempuan" <?php if ($rows['gender'] == 'Perempuan') { echo 'selected'; };?>>Perempuan</option>
            </select>
            <?php
            echo '
            </p>
            <p>Jabatan Karyawan';
            ?>
            <select name="jabatan" class="form-control">
                <option value="Manager" <?php if ($rows['jabatan'] == 'Manager') { echo 'selected'; }; ?>  >Manager</option>
                <option value="Teknisi" <?php if ($rows['jabatan'] == 'Teknisi') { echo 'selected'; };?>>Teknisi</option>
                <option value="Koki" <?php if ($rows['jabatan'] == 'Koki') { echo 'selected'; };?>>Koki</option>
                <option value="Kasir" <?php if ($rows['jabatan'] == 'Kasir') { echo 'selected'; };?>>Kasir</option>
            </select>
            <?php
            echo '
            <p>
            <input class="btn btn-primary" type="submit" name="submitBtn" value="Update">
            <a class="btn btn-light" href="index.php">kembali</a>
            </p>
            
            
            </form>
            </div>
            ';
        }
    } else {
        echo 'ID tidak valid, harap kembali lagi dan coba lagi. <a href="lihatData.php">Lihat Data</a> ';
    }

} else {
echo 'Tidak menerima data edit, harap kembali lagi dan coba lagi: <a href="lihatData.php">Lihat Data</a> ';
}

?>

</body>
</html>