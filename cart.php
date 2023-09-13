<?php
include './essentials/connection.php';
include './process/get_product_details.php';
include_once './process/process_cart.php';
session_start();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HaResturant | Main</title>
    <link rel="stylesheet" href="./assets/css/bootstrap.css">
    <link rel="stylesheet" href="assets/css/toastify.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@500&display=swap" rel="stylesheet">
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
    </section>
    
    <section id="cart">
        <div class="container" style="margin-top: 1rem;">

              <?php
            if (!doesSessionExists()) {
                echo '
                <div class="alert alert-warning" role="alert">
                    Keranjang anda kosong!
                </div>
                ';
            } else {
              $arrayItems = getCartItem();
              echo '<div class="row">';
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
                      <div class="col-md-3 col-sm-6" style="margin-right: 0rem; margin-bottom: 1rem;">
                          <div class="card" style="width: 100%;">
                              <img class="card-img-top mx-auto" src="'.$imgSrc[$a]. '" alt="'.$row["nama"].'" style="height: 200px; object-fit: cover;">
                              <div class="card-body">
                                  <h5 class="card-title">' . $row["nama"] . '</h5>
                                  <div class="form-group">
                                    <form action="process/process_cart.php" method="post">
                                      <label for="quantity">Quantity</label>
                                      <input type="hidden" value="'.$item['idMenu'].'" name="idMenu">
                                      <input type="number" class="form-control" id="quantity" name="quantityNew" value="'.$item['quantity'].'" min="0" '.$isDisabled.' oninput="submitForm(this.form)">
                                    </form>
                                    <script>
                                    document.addEventListener("DOMContentLoaded", function () {
                                      var scrollPosition = localStorage.getItem("scrollPosition");
                                  
                                      if (scrollPosition !== null) {
                                          // Restore the scroll position
                                          window.scrollTo(0, parseInt(scrollPosition));
                                          localStorage.removeItem("scrollPosition");
                                      }
                                  });                                  
                                    
                                    window.addEventListener("beforeunload", function () {
                                        localStorage.setItem("scrollPosition", window.scrollY);
                                    });

                                    function submitForm(form) {  
                                      
                                      form.submit();

                                      Toastify({
                                        text: "'.$_SESSION['notification'].'",
                                        duration: 3000,
                                        gravity: "top", // `top` or `bottom`
                                        position: "right", // `left`, `center` or `right`
                                        stopOnFocus: true, // Prevents dismissing of toast on hover
                                        onClick: function(){} // Callback after click
                                      }).showToast();
                                    }
                                    </script>
                                  </div>
                                  <p class="card-text">Rp' . number_format($row["harga"] * $item['quantity'], 0, ",", ".") . '</p>
                                  <div style="margin-bottom: 1rem;">
                                      <span class="badge badge-info" style="padding: 0.5rem">'.$row['tipeMenu'] .'</span>
                                      '. $isStokStatus .'
                                  </div>
                              </div>
                          </div>
                      </div>
                      ';
                      $a++;
                  }
              } ?>
                <div class="container-fluid" id="end" style="background-color: #007bff;">
                <div class="row">
                  <div class="col-md-4 col-12" style="height: 4rem;">
                    <h3 style="color: white; font-family: 'Poppins', sans-serif; text-align: center; height: 100%; display: flex; align-items: center; width: 100%;">Total Harga: Rp<?php echo number_format($totalHarga, 0, ",", ".")  ?></h3>
                  </div>
                  <div class="col-md-8 col-12" style="height: 4rem;">
                    <div class="container" style="float: right; justify-content: flex-end; height: 100%; display: flex; align-items: center; ">
                      <a style="font-family: 'Poppins', sans-serif; justify-content: flex-end; align-items: center;" class="btn btn-light" href="checkout.php">Checkout</a>
                    </div>
                  </div>
                  </div>
                </div>
              </div>
            
            <?php
              echo '</div>';
          }
          ?>
        </div>

        <script src="assets/js/toastify-js.js"></script>
        <?php
if (isset($_SESSION['notification'])) {
  echo '
  <script>
  Toastify({
    text: "'.$_SESSION["notification"].'",
    duration: 3000,
    gravity: "top", // `top` or `bottom`
    position: "right", // `left`, `center` or `right`
    stopOnFocus: true, // Prevents dismissing of toast on hover
    onClick: function(){} // Callback after click
  }).showToast();
  </script>
  ';
  $_SESSION['notification'] = null;
}
        ?>

    </section>
    <style>
    @media screen and (max-width: 768px) {
      #end {
        height: 8rem;
      }
    }
    </style>

    <script src="assets/js/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>
</html>