<?php
require('fpdf186/fpdf.php'); // Update the path to where you have placed the FPDF library
require 'conn.php';

// Check if the user is logged in
if (!isset($_SESSION['iduser'])) {
    die("User not logged in.");
}

$user_id = $_SESSION['iduser'];

// Fetch the latest order for the logged-in user
$orderQuery = "SELECT f.idfaktura, f.celkovacena, f.datumobjednani, f.datumdoruceni, d.nazev as doprava, p.nazev as platba, u.jmeno, u.primeni, u.ulicecp, u.mesto, u.PSC, u.email, u.telefon
               FROM faktura f
               JOIN doprava d ON f.doprava_iddoprava = d.iddoprava
               JOIN platba p ON f.platba_idplatba = p.idplatba
               JOIN user u ON f.user_iduser = u.iduser
               WHERE f.user_iduser = ?
               ORDER BY f.datumobjednani DESC
               LIMIT 1";
$stmt = $conn->prepare($orderQuery);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$orderResult = $stmt->get_result();
$orderData = $orderResult->fetch_assoc();

if (!$orderData) {
    die("Order not found.");
}

$order_id = $orderData['idfaktura'];

// Fetch the order items
$itemsQuery = "SELECT pr.nazev, pr.popis, pr.cena, po.pocet
               FROM produkty po
               JOIN produkt pr ON po.produkt_idprodukt = pr.idprodukt
               WHERE po.faktura_idfaktura = ?";
$stmt = $conn->prepare($itemsQuery);
$stmt->bind_param("i", $order_id);
$stmt->execute();
$itemsResult = $stmt->get_result();

// Create the PDF
$pdf = new FPDF();
$pdf->AddPage();
$pdf->AddFont('DejaVu','','DejaVuSans.php');
$pdf->AddFont('DejaVu','B','DejaVuSans-Bold.php');
$pdf->SetFont('DejaVu', '', 14);

$pdf->Cell(0, 10, 'Faktura', 0, 1, 'C');
$pdf->SetFont('DejaVu', '', 12);

$pdf->Cell(0, 10, 'Datum objednani: ' . $orderData['datumobjednani'], 0, 1);
$pdf->Cell(0, 10, 'Datum doruceni: ' . $orderData['datumdoruceni'], 0, 1);
$pdf->Cell(0, 10, 'Zakaznik: ' . $orderData['jmeno'] . ' ' . $orderData['primeni'], 0, 1);
$pdf->Cell(0, 10, 'Adresa: ' . $orderData['ulicecp'] . ', ' . $orderData['mesto'] . ' ' . $orderData['PSC'], 0, 1);
$pdf->Cell(0, 10, 'Email: ' . $orderData['email'], 0, 1);
$pdf->Cell(0, 10, 'Telefon: ' . $orderData['telefon'], 0, 1);
$pdf->Cell(0, 10, 'Doprava: ' . $orderData['doprava'], 0, 1);
$pdf->Cell(0, 10, 'Platba: ' . $orderData['platba'], 0, 1);

$pdf->Ln(10);
$pdf->SetFont('DejaVu', 'B', 12);
$pdf->Cell(100, 10, 'Produkt', 1);
$pdf->Cell(30, 10, 'Cena', 1);
$pdf->Cell(30, 10, 'Pocet', 1);
$pdf->Cell(30, 10, 'Celkem', 1);
$pdf->Ln();

$pdf->SetFont('DejaVu', '', 12);
$total = 0;
while ($item = $itemsResult->fetch_assoc()) {
    $lineTotal = $item['cena'] * $item['pocet'];
    $total += $lineTotal;
    
    $pdf->Cell(100, 10, $item['nazev'], 1);
    $pdf->Cell(30, 10, $item['cena'], 1);
    $pdf->Cell(30, 10, $item['pocet'], 1);
    $pdf->Cell(30, 10, $lineTotal, 1);
    $pdf->Ln();
}

$pdf->SetFont('DejaVu', 'B', 12);
$pdf->Cell(160, 10, 'Celkem', 1);
$pdf->Cell(30, 10, $total, 1);

$pdf->Output();

$stmt->close();
$conn->close();
?>
