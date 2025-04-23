<?php
require 'conn.php';

if (!isset($_SESSION['iduser'])) {
    die("Nejste přihlášeni.");
}

$user_id = $_SESSION['iduser'];

$delivery_option = isset($_SESSION['delivery_option']) ? $_SESSION['delivery_option'] : die("Delivery option not set.");
$payment_option = isset($_SESSION['payment_option']) ? $_SESSION['payment_option'] : die("Payment option not set.");


if (!isset($_SESSION['cart']) || empty($_SESSION['cart'])) {
    die("Váš košík je prázdný.");
}

$cart_items = $_SESSION['cart'];

$dopravaQuery = "SELECT iddoprava FROM doprava WHERE nazev = ?";
$stmt = $conn->prepare($dopravaQuery);
$stmt->bind_param("s", $delivery_option);
$stmt->execute();
$dopravaResult = $stmt->get_result();
if ($dopravaResult->num_rows === 0) {
    die("Špatná možnost dopravy.");
}
$dopravaData = $dopravaResult->fetch_assoc();
$doprava_id = $dopravaData['iddoprava'];

$platbaQuery = "SELECT idplatba FROM platba WHERE nazev = ?";
$stmt = $conn->prepare($platbaQuery);
$stmt->bind_param("s", $payment_option);
$stmt->execute();
$platbaResult = $stmt->get_result();
if ($platbaResult->num_rows === 0) {
    die("Špatná možnost platby.");
}
$platbaData = $platbaResult->fetch_assoc();
$platba_id = $platbaData['idplatba'];

$stmt->close();

$total_price = 0;
foreach ($cart_items as $item) {
    if (!isset($item['idprodukt'])) {
        die("Předmětu v košíku chybí ID.");
    }
    $total_price += $item['cena'] * $item['quantity'];
}

$datumdoruceni = date('Y-m-d H:i:s', strtotime('+7 days'));

$conn->begin_transaction();

try {
    $orderQuery = "INSERT INTO faktura (celkovacena, datumdoruceni, user_iduser, doprava_iddoprava, platba_idplatba) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($orderQuery);
    $stmt->bind_param("isiii", $total_price, $datumdoruceni, $user_id, $doprava_id, $platba_id);
    $stmt->execute();
    $order_id = $stmt->insert_id;

    $productQuery = "INSERT INTO produkty (pocet, cenaks, produkt_idprodukt, faktura_idfaktura) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($productQuery);

    foreach ($cart_items as $item) {
        if (!isset($item['quantity']) || !isset($item['cena']) || !isset($item['idprodukt'])) {
            throw new Exception("V košíku chybí potřebná data.");
        }

        $quantity = $item['quantity'];
        $price = $item['cena'];
        $product_id = $item['idprodukt'];
        $stmt->bind_param("iiii", $quantity, $price, $product_id, $order_id);
        $stmt->execute();
    }

    $conn->commit();

    unset($_SESSION['cart']);

    header('Location: zaplaceno.php');
} catch (Exception $e) {
    $conn->rollback();
    echo "Nešlo uložit objednávku: " . $e->getMessage();
}

$stmt->close();
$conn->close();
?>
