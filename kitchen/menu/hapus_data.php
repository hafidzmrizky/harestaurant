<?php
	session_start();
	if (!isset($_SESSION['email'])) {
		header('Location: ../../login.php');
	}
	include '../../essentials/connection.php';

	$query = "DELETE FROM menu WHERE id=".$_GET['id'];
	$result = mysqli_query($conn, $query);

	//mengecek apakah ada error ketika menjalankan query
	if(!$result){
		die ("Query Error: ".mysqli_errno($conn)." - ".mysqli_error($conn));
	}else{
		header("Location:lihat_data.php");
	}

?>