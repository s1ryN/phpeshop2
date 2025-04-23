<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $idprodukt = $_POST['idprodukt'];
    $quantity = isset($_POST['quantity']) ? (int)$_POST['quantity'] : 1;

    require 'conn.php';
    $query = "SELECT idprodukt, nazev, cena FROM produkt WHERE idprodukt = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('i', $idprodukt);
    $stmt->execute();
    $result = $stmt->get_result();
    $product = $result->fetch_assoc();

    if ($product) {
        $cart_item = [
            'idprodukt' => $product['idprodukt'],
            'nazev' => $product['nazev'],
            'cena' => $product['cena'],
            'quantity' => $quantity,
        ];

        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = [];
        }

        $found = false;
        foreach ($_SESSION['cart'] as &$item) {
            if (is_array($item) && $item['idprodukt'] == $idprodukt) {
                $item['quantity'] += $quantity;
                $found = true;
                break;
            }
        }

        if (!$found) {
            $_SESSION['cart'][] = $cart_item;
        }
    }

    $stmt->close();
    $conn->close();

    header('Location: index.php');
    exit;
}
?>
