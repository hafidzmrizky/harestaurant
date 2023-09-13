<?php
session_start();
error_reporting(E_ALL & ~E_NOTICE);

if (isset($_POST['quantityNew'])) {
    $id = $_POST['idMenu'];
    $quantity = $_POST['quantityNew'];
    if ($_POST['quantityNew'] == 0) {
        $_SESSION['notification'] = "Berhasil menghapus item dari keranjang!";
        deleteItemCart($id);
        header('Location: ../cart.php');
    } else {
        $_SESSION['notification'] = "Berhasil mengubah jumlah item!";
        updateItemQuantity($id, $quantity);
        header('Location: ../cart.php');
    }
    updateItemQuantity($id, $quantity);
    header('Location: ../cart.php');
}


if (isset($_POST['data'])) {
    $data = $_POST['data'];
    addItemToCart($data);
    $_SESSION['notification'] = "Berhasil menambahkan item ke keranjang!";
    header('Location: ../index.php');
}

function doesSessionExists() {
    if (isset($_SESSION['cart'])) {
        return true;
    } else {
        return false;
    }
}

function createCartSession() {
    if (!doesSessionExists()) {
        $_SESSION['cart'] = array();
        return true;
    } else {
        return true;
    }
}

function checkIfItemExists($id) {
    if (doesSessionExists()) {
        $cart = $_SESSION['cart'];
        for ($i=0; $i < count($cart); $i++) { 
            if ($cart[$i]['idMenu'] == $id) {
                return true;
            }
        }
        return false;
    } else {
        return false;
    }
}

function addItemToCart($id) {
    if (doesSessionExists()) {
        $cart = $_SESSION['cart'];

        // Check if the item already exists in the cart
        $itemExists = false;
        foreach ($cart as &$item) {
            if ($item['idMenu'] == $id) {
                $item['quantity']++;
                $itemExists = true;
                break;
            }
        }

        // If the item doesn't exist, add it to the cart
        if (!$itemExists) {
            $cart[] = array(
                "idMenu" => $id,
                "quantity" => 1
            );
        }

        $_SESSION['cart'] = $cart;
        return true;
    } else {
       createCartSession();
       addItemToCart($id);
    }
}


function updateItemQuantity($id, $quantity) {
    if (isset($_SESSION['cart'])) {
        foreach ($_SESSION['cart'] as &$item) {
            if ($item['idMenu'] == $id) {
                $item['quantity'] = $quantity;
                break;
            }
        }
    }
}

function deleteItemCart($id) {
    if (doesSessionExists()) {
        $cart = $_SESSION['cart'];
        for ($i=0; $i < count($cart); $i++) { 
            if ($cart[$i]['idMenu'] == $id) {
                $itemPrice = $cart[$i]['price'] * $cart[$i]['quantity'];
                unset($cart[$i]);
                $_SESSION['cart'] = $cart;
                return true;
            }
        }
    }
    return false;
}

function getCartItem() {
    if (doesSessionExists()) {
        $cart = $_SESSION['cart'];
        $filteredCart = array_filter($cart, function($item) {
            if ($item['quantity'] > 0) {
                return true;
            } else {
                deleteItemCart($item['idMenu']);
                return false;
            }
        });
        return $filteredCart;
    } else {
        return false;
    }
}

function isCartEmpty() {
    if (doesSessionExists()) {
        $cart = $_SESSION['cart'];
        if (count($cart) == 0) {
            return true;
        } else {
            return false;
        }
    } else {
        return true;
    }
}


function deleteCart() {
    if (doesSessionExists()) {
        unset($_SESSION['cart']);
        return true;
    } else {
        return false;
    }
}

?>