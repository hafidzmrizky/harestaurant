<?php
session_start();
include 'essentials/connection.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HaResturant | Main</title>
    <link rel="stylesheet" href="../assets/css/bootstrap.css">
    <link rel="stylesheet" href="assets/css/toastify.min.css">
</head>
<body>
    <section id="navigation">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <a class="navbar-brand" href="#">HaRestaurant</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>
          
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
              <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                  <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
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

    <div class="container">
        <div class="row" style="margin-right: 1rem">
        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
  <ol class="carousel-indicators">
    <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
    <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
  </ol>
  <div class="carousel-inner">
    <div class="carousel-item active">
    <img class="d-block w-100" src="../assets/images/banner2.png" style="border-radius: 0.5rem;" width="100rem;">
    </div>
    <div class="carousel-item">
      <img class="d-block w-100" src="../assets/images/banner3.png" style="border-radius: 0.5rem;" width="100rem;" alt="Third slide">
    </div>
  </div>
</div>
        
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <?php
  $query = "SELECT * FROM menu";
  $result = mysqli_query($conn, $query);

  // Check if there are any errors when running the query
  if (!$result) {
    die("Query Error: " . mysqli_errno($conn) . " - " . mysqli_error($conn));
  }

  if (mysqli_num_rows($result) == 0) {
    echo '<p>Tidak Ada Data</p>';
  } else {
    echo '<div class="row" style="padding: 1rem;">';
    while ($row = mysqli_fetch_assoc($result)) {
      $imgSrc = explode("~", $row["image"]);
      $isDisabled = ($row['statusMenu'] == 'Tidak Tersedia') ? 'disabled' : '';
      $isStokStatus = ($row['statusMenu'] == "Tersedia") ? '<span class="badge badge-success" style="padding: 0.5rem">Tersedia</span>' : '<span class="badge badge-danger" style="padding: 0.5rem">Habis</span>';
      $a = 0;
      echo '
        <div class="col-md-3 col-sm-6" style="margin-right: 0rem; margin-bottom: 1rem;">
          <div class="card" style="width: 100%;">
            <img class="card-img-top mx-auto" src="'.$imgSrc[$a]. '" alt="'.$row["nama"].'" style="height: 200px; object-fit: cover;">
            <div class="card-body">
              <h5 class="card-title">' . $row["nama"] . '</h5>
              <p class="card-text" style="height: 3rem; overflow: hidden; text-overflow: ellipsis;">' . $row["deskripsi"] . '</p>
              <p class="card-text">Rp' . number_format($row["harga"], 0, ",", ".") . '</p>
              <div style="margin-bottom: 1rem;">
              <span class="badge badge-info" style="padding: 0.5rem">'.$row['tipeMenu'] .'</span>
              '. $isStokStatus .'
              </div>
              <form action="process/process_cart.php" method="POST" target="tes">
              <input name="data" type="hidden" value="'.$row['id'].'">
              <button name="button" type="submit" class="btn btn-primary "  '  . $isDisabled . '>Tambahkan</button>        
              </form>
            </div>
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
            </script>
          </div>
        </div>
      ';
      $a++;
    }
    echo '</div>';
  }
?>
        </div>
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

    <script src="assets/js/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>
</html>

