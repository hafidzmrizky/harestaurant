<?php
include './essentials/connection.php';
include './process/get_product_details.php';
include_once './process/process_cart.php';
session_start();
if (!isset($_SESSION['email'])) {
	header('Location: login.php');
}

if(isCartEmpty()) {
    header('Location: index.php');
}

?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Checkout - haRestaurant | 2023</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="./assets/css/bootstrap.css">
        <link rel="stylesheet" href="./assets/css/checkout.css">
    </head>
    <body>
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
                <li class="nav-item">
                  <a class="nav-link" href="checkOrderStatus.php">Check Order Status</a>
                </li>
                  <li class="nav-item active" >
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

        <div class="container-fluid checkout">
            <h3>Checkout</h3>
            <div class="row" method="post" action="process/checkout.php">
                <div class="col-md-6 col-12" style="padding: 0;">
                    <div class="container-fluid">
                        <?php
                         $arrayItems = getCartItem();
                         foreach ($arrayItems as $item) {
                            $idMenu = $item['idMenu'];
                            $query = "SELECT * FROM menu WHERE id = $idMenu";
                            $result = mysqli_query($conn, $query);
                    
                            if (!$result) {
                                echo "Error executing query: " . mysqli_error($conn);
                            } 
                            while ($row = mysqli_fetch_assoc($result)) {
                                $imgSrc = explode("~", $row["image"]);
                                $isDisabled = ($row['statusMenu'] == 'Tidak Tersedia') ? 'disabled' : '';
                                $isStokStatus = ($row['statusMenu'] == "Tersedia") ? '<span class="badge badge-success" style="padding: 0.5rem">Tersedia</span>' : '<span class="badge badge-danger" style="padding: 0.5rem">Habis</span>';
                                $totalHargaPre = $row["harga"] * $item['quantity'];
                                $totalHarga = $totalHargaPre + $totalHarga;
                                $a = 0;
                        echo '
                        <div class="row">
                            <div class="col-md-12">
                                <h6 style="display: flex; align-items: center;"><img width="22px" style="margin-right: 0.35rem;" src="assets/images/stars.png"><b>HaRestaurant</b></h6>
                                <p style="font-size: small;">Kota Tangerang Selatan</p>
                            </div>
                            <div class="col-md-12">
                                <div class="container-fluid" style="padding: 0;">
                                <div class="row">
                                    <div class="col-md-2 col-3">
                                        <img src="'.$imgSrc[$a].'" width="100%">
                                    </div>
                                    <div class="col-md-9 col-7">
                                        <h6>'.$row["nama"].'</h6>
                                        <p><b>Rp'.number_format($totalHargaPre, 0, ",", ".").'</b></p>
                                    </div>
                                    <div class="col-md-1 col-1">
                                        <p>'.$item['quantity'].'</p>
                                    </div>
                                </div>
                                <hr>
                            </div>
                            </div>
                            </div>
                        ';
                        $a++;
                            }}
                    ?>
                    </div>

            </div>
            <div class="col-md-6 col-12">
                <div class="card ringkasan">
                    <div class="card-body">
                        <h5><b>Ringkasan Belanja</b></h5>
                        <table style="width: 100%;">
                        <?php
                        $arrayItems = getCartItem();
                        $totalHarga = 0;
                        foreach ($arrayItems as $item) {
                           $idMenu = $item['idMenu'];
                           $query = "SELECT * FROM menu WHERE id = $idMenu";
                           $result = mysqli_query($conn, $query);
                           if (!$result) {
                               echo "Error executing query: " . mysqli_error($conn);
                           } 
                           while ($row = mysqli_fetch_assoc($result)) {
                               $imgSrc = explode("~", $row["image"]);
                               $isDisabled = ($row['statusMenu'] == 'Tidak Tersedia') ? 'disabled' : '';
                               $isStokStatus = ($row['statusMenu'] == "Tersedia") ? '<span class="badge badge-success" style="padding: 0.5rem">Tersedia</span>' : '<span class="badge badge-danger" style="padding: 0.5rem">Habis</span>';
                               $totalHargaPre = $row["harga"] * $item['quantity'];
                               $totalHarga = $totalHarga + $totalHargaPre;
                        echo '
                            <tr>
                                <td><p>'.$row['nama'].'</p></td>
                                <td><p style="float:right">Rp'.number_format($totalHargaPre, 0, ",", ".").'</p></td>
                            </tr>
                            ';
                
                           }
                        }
                        echo '
                        <tr>
                        <td><h5><b>Total Harga</b></h5></td>
                        <td><h5 style="float:right">Rp'.number_format($totalHarga, 0, ",", ".").'</h5></td>
                        </tr>
                        ';

                        ?>
                        </table>
                        <h5><b>Metode Pembayaran</b></h5>
                        <form action="process/checkout.php" method="post">
                            <div class="form-group">
                                <label for="paymentMethod">Pilih Metode Pembayaran</label>
                                <input type="hidden" value="<?php echo $totalHarga;?>" name="totalPembayaran" id="totalPembayaran">
                                <select class="form-control" id="paymentMethod" name="metodePembayaran" onchange="showPaymentDetails()">
                                    <option value="transfer">Transfer</option>
                                    <option value="qris">QRIS</option>
                                    <option value="cash">Cash</option>
                                </select>
                            </div>
                            <input type="submit" class="btn btn-primary" value="Bayar" name="submitBtn" style="width: 100%;">
                        </form>
                    </div>
                </div>
            </div>
        </div>




        
        <script src="assets/js/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    </body>
</html>