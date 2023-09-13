<?php
session_start();
include './essentials/connection.php';
include './process/get_product_details.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HaResturant | Main</title>
    <link rel="stylesheet" href="./assets/css/bootstrap.css">
</head>
<body>
    <section id="navigation">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <a class="navbar-brand" href="./index.php">HaRestaurant</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>
          
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
              <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                  <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item active">
                  <a class="nav-link" href="checkOrderStatus.php">Check Order Status</a>
                </li>
                  <li class="nav-item">
                    <a class="nav-link" href="cart.php">Keranjang</a>
                  </li>
              </ul>
              <?php
              if (isset($_SESSION['email'])) {
                $username = explode("@", $_SESSION["email"]);
                echo '<a style="margin-right: 5px;">Hai, '.$username[0].'</a>';
                echo '<a class="btn btn-outline-primary" href="kitchen/index.php"style="margin-right: 0.5rem;">Dashboard Admin</a>';
                echo '<a class="btn btn-outline-danger" href="logout.php">Logout</a>';
              } else {
                echo '
                <a href="login.php" class="btn btn-outline-success my-2 my-sm-0" type="submit">Masuk</a>
                ';
              }
              ?>
                
            </div>
          </nav>
    </section>
    <section id="orderStatus">
      <div class="container" style="margin-top: 1rem;">
      <?php if (!isset($_GET['idTransaksi'])) {
        echo '
        <h3>ID Transaksi </h3>
        <form class="form-group" action="' .$_SERVER['PHP_SELF'] . '" method="get">
          <input type="text" class="form-control" name="idTransaksi" placeholder="Masukkan ID Transaksi">
          <input type="submit" class="btn btn-primary form-control" name="submitTrx" value="Cek Status">
        </form>
        ';
      }
        ?>
        <?php
if (isset($_GET['idTransaksi'])) {
  $idTransaksi = $_GET['idTransaksi'];
  $query = "SELECT * FROM transaksi WHERE nomorTransaksi='$idTransaksi'";
  $result = mysqli_query($conn, $query);
  if (!$result) {
      die("Query Error: " . mysqli_errno($conn) . " - " . mysqli_error($conn));
  } else {
      if(mysqli_num_rows($result) == 0){
          echo '
          <div class="alert alert-warning" role="alert">
            Nomor transaksi tidak ditemukan! Silahkan cek kembali nomor transaksi Anda. Data yang dimasukkan: '.$idTransaksi.'
          </div>
          ';
      } else {
          $data = mysqli_fetch_array($result);
          $idTrx = $data['idTransaksi'];
          echo '
          <div class="container">
            <div class="row">
              <div class="col-md-6">
              <h3>Transaction Number</h3>
              <h4><code><mark>'.$data['nomorTransaksi'].'</mark></code></h4>
              </div>
              <div class="col-md-6">
              <h3>Status</h3>
              <h4><code><mark>'.$data['statusPesanan'].'</mark></code></h4>
              </div>
              <div class="col-md-12">
              <h3>Order Details</h3>
              <table class="table table-bordered">
                <tr>
                  <th>No</th>
                  <th>Nama Menu</th>
                  <th>Status</th>
                  <th>Quantity</th>
                  <th>Harga</th>
                  <th>Sub Total</th>
                </tr>';
                $dataDetail = getDataTransaksi($idTrx);
                $totalHarga = 0;
                for ($i=0; $i < count($dataDetail); $i++) { 
                  $menuDetail = getMenuDetail($dataDetail[$i]['idMenu']);
                  $subTotal = $menuDetail['harga'] * $dataDetail[$i]['quantity'];
                  $totalHarga += $subTotal;
                  echo '
                  <tr>
                    <td>'.($i+1).'</td>
                    <td>'.$menuDetail['nama'].'</td>
                    <td>'.$dataDetail[$i]['statusPesananMenu'].'</td>
                    <td>'.$dataDetail[$i]['quantity'].'</td>
                    <td>Rp'.number_format($menuDetail['harga'], 0, ",", ".").'</td>
                    <td>Rp'.number_format($subTotal, 0, ",", ".").'</td>
                  </tr>
                  ';
                }
                echo '
                <tr>
                <td colspan="4" style="text-align: right;"><b>Total</b></td>
                <td>Rp'.number_format($totalHarga, 0, ",", ".").'</td>
                <td></td>
                </tr>
                </table>
              </div>
              <div class="col-md-6">
              <h3>Table No</h3>
              <h4><code><mark>'.$data['nomorMeja'].'</mark></code></h4>
              </div>
              <div class="col-md-6">
              <h3>Payment Method</h3>
              <h4><code><mark>'.$data['metodePembayaran'].'</mark></code></h4>
              </div>
            </div>
          </div>
          ';
      }
  }
}
      ?>
      </div>
      

    </section>
    
    <script src="assets/js/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>
</html>