<?php
session_start();

$cart_items = isset($_SESSION['cart']) ? $_SESSION['cart'] : [];
$delivery_option = isset($_SESSION['delivery_option']) ? $_SESSION['delivery_option'] : 'N/A';
$payment_option = isset($_SESSION['payment_option']) ? $_SESSION['payment_option'] : 'N/A';

?>
<!DOCTYPE html>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Potvrzení objednávky</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
        }
        header {
            background-color: #f1f1f1;
            padding: 10px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .brand img {
            max-height: 50px;
        }

        .brand {
            display: flex;
            align-items: center;
            text-decoration: none;
            color: #007BFF;
        }

        .brand h1 {
            margin: 0;
            color: #007BFF;
        }

        main {
            min-height: calc(100vh - 70px);
            padding: 20px;
        }

        .confirmation-container {
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            max-width: 800px;
            margin: 0 auto;
        }

        .confirmation-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 0;
            border-bottom: 1px solid #ccc;
        }

        .confirmation-item:last-child {
            border-bottom: none;
        }

        .confirmation-item h3 {
            margin: 0;
            font-size: 18px;
        }

        .confirmation-item p {
            margin: 0;
            color: #666;
        }

        .confirmation-total {
            text-align: right;
            margin-top: 20px;
            font-size: 18px;
            font-weight: bold;
        }

        .confirmation-methods {
            margin-top: 20px;
        }

        .confirmation-methods p {
            margin: 5px 0;
        }

        footer {
            background-color: #f1f1f1;
            padding: 10px;
            display: flex;
            justify-content: flex-end;
            align-items: center;
        }

        .footer-info {
            text-align: right;
            margin-right: 20px;
        }

        .footer-info p {
            margin: 2px;
            font-size: 12px;
            color: #333;
        }

        .confirm-button {
            background-color: #007BFF;
            color: white;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 5px;
            display: inline-block;
            margin-top: 20px;
            cursor: pointer;
            text-align: center;
        }

        .confirm-button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>

<header>
    <a href="index.php" class="brand">
        <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQIieVzLTLWLIoRBM9Tbg5xcyiksVAG2QnsiQ&usqp=CAU" alt="Logo">
        <h1>nderground</h1>
    </a>
</header>

<main>
    <div class="confirmation-container">
        <h2>Potvrzení objednávky</h2>
        <?php if (empty($cart_items)): ?>
            <p>Váš košík je prázdný.</p>
        <?php else: ?>
            <?php foreach ($cart_items as $item): ?>
                <div class="confirmation-item">
                    <div>
                        <h3><?php echo htmlspecialchars($item['nazev']); ?></h3>
                        <p>Cena: <?php echo htmlspecialchars($item['cena']); ?> Kč</p>
                        <p>Množství: <?php echo htmlspecialchars($item['quantity']); ?></p>
                    </div>
                    <div>
                        <p>Celkem: <?php echo htmlspecialchars($item['cena'] * $item['quantity']); ?> Kč</p>
                    </div>
                </div>
            <?php endforeach; ?>
            <?php
            $total = array_reduce($cart_items, function ($sum, $item) {
                return $sum + (isset($item['cena'], $item['quantity']) ? $item['cena'] * $item['quantity'] : 0);
            }, 0);
            ?>
            <div class="confirmation-total">
                Celková cena: <?php echo htmlspecialchars($total); ?> Kč
            </div>
            <div class="confirmation-methods">
                <p>Způsob dopravy: <?php echo htmlspecialchars($delivery_option); ?></p>
                <p>Způsob platby: <?php echo htmlspecialchars($payment_option); ?></p>
                <P>Potvrzením objednávky se zavazujete k zaplacení.
            </div>
            <form action="potvrzeniobjednavky.php" method="POST">
                <button type="submit" class="confirm-button">Potvrdit objednávku</button>
            </form>
        <?php endif; ?>
    </div>
</main>

<footer>
    <div class="footer-info">
        <p>Telefonní číslo: +420 724 394 232</p>
        <p>Adresa e-mail: Jebej.pdf@skolakrizik.cz</p>
        <p>IČO: 69696969</p>
        <p>DIČ: 420420420</p>
    </div>
</footer>

</body>
</html>
