<?php
function getMenuDetail($id) {
    include $_SERVER['DOCUMENT_ROOT'] . '/essentials/connection.php';
    $menuDetailQuery = "SELECT * FROM MENU WHERE id='$id'";
    $menuDetail = mysqli_query($conn, $menuDetailQuery);
    $menu = mysqli_fetch_array($menuDetail);
    return $menu;
}

function getDataTransaksi($idTrx) {
    include $_SERVER['DOCUMENT_ROOT'] . '/essentials/connection.php';
    $query = "SELECT * FROM transaksidetail WHERE idTransaksi=$idTrx;";
    $exc = mysqli_query($conn, $query);
    $dataTransaksi = array();
    while ($row = mysqli_fetch_array($exc)) {
        $dataTransaksi[] = $row;
    }
    return $dataTransaksi;
}
?>