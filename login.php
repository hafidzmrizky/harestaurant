<?php
session_start();
if (isset($_SESSION['email'])) {
    header('Location: index.php');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="./assets/css/bootstrap.css">
    
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 col-md-6">
                <div class="col-12" style="display: flex; justify-content: center; margin-top: 2rem;">
                    <h2>Login | Resturant</h2>
                </div>
                <p style="text-align: center;">Untuk dapat mengakses bagian ini pada situs restaurant, silahkan login.</p>
                <form action="./process/proses_login.php" method="post">
                <div class="container" style="display: flex; justify-content: center;">
                    <div class="row">
                        <div class="col-12" style="display: flex; justify-content: center;">
                            <input type="email" required placeholder="Email" name="email" style="width: 85%; height: 2.5rem; border: 1px solid #eaeaec; color: #898d8e; text-indent: 10px; background-color: #eaeaec; border-radius: 5px;">
                        </div>
                        <div class="col-12" style="display: flex; justify-content: center; margin-top: 1rem;">
                            <input type="password" required placeholder="Password" name="password" style="width: 85%; height: 2.5rem; border: 1px solid #eaeaec; color: #898d8e; text-indent: 10px; background-color: #eaeaec; border-radius: 5px;">
                        </div>
                        <div class="col-12" style="display: flex; justify-content: center; margin-top: 1rem;">
                            <button type="submit" name="loginBtn" class="btn btn-primary" style="width: 50%; border-radius: 5px;">Masuk</button>
                        </div>
                    </div>
                </div>
            </form>
            </div>
            <div class="col-12 col-md-6" style="background-color: #eaeaec;">
                <div class="container">
                </div>
            </div>
        </div>
    </div>
    <script src="assets/js/bootstrap-4.0.0-dist(1)/js/bootstrap.js"></script>
</body>
</html>