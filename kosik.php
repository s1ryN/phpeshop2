<?php
session_start();

if (!isset($_SESSION['cart']) || !is_array($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
} else {
    $_SESSION['cart'] = array_filter($_SESSION['cart'], 'is_array');
}

$cart_items = $_SESSION['cart'];

$is_logged_in = isset($_SESSION['iduser']); 

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['delete_item'])) {
    $idprodukt = $_POST['idprodukt'];

    foreach ($cart_items as $key => $item) {
        if (is_array($item) && isset($item['idprodukt']) && $item['idprodukt'] == $idprodukt) {
            unset($cart_items[$key]);
            $_SESSION['cart'] = array_values($cart_items);
            break;
        }
    }

    header('Location: kosik.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Košík</title>
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

        .login-register {
            text-align: right;
        }

        .login-register a {
            margin-left: 20px;
            text-decoration: none;
            color: #333;
            padding: 8px 12px;
            border-radius: 5px;
            transition: background-color 0.3s, color 0.3s;
        }

        .login-register a:hover {
            background-color: #007BFF;
            color: #fff;
        }

        main {
            min-height: calc(100vh - 70px);
            padding: 20px;
        }

        .cart-container {
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            max-width: 800px;
            margin: 0 auto;
        }

        .cart-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 0;
            border-bottom: 1px solid #ccc;
        }

        .cart-item:last-child {
            border-bottom: none;
        }

        .cart-item h3 {
            margin: 0;
            font-size: 18px;
        }

        .cart-item p {
            margin: 0;
            color: #666;
        }

        .cart-total {
            text-align: right;
            margin-top: 20px;
            font-size: 18px;
            font-weight: bold;
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

        .delete-button {
            background-color: #ff4d4d;
            color: white;
            padding: 5px 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .delete-button:hover {
            background-color: #e60000;
        }

        .checkout-button {
            background-color: #007BFF;
            color: white;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 5px;
            display: inline-block;
            margin-top: 20px;
        }

        .checkout-button:hover {
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
    <div class="login-register">
        <a href="login.php">Přihlásit se</a>
        <a href="register.php">Registrovat se</a>
        <a href="kosik.php">Košík</a>
    </div>
</header>

<main>
    <div class="cart-container">
        <h2>Váš košík</h2>
        <?php if (empty($cart_items)): ?>
            <p>Váš košík je prázdný.</p>
        <?php else: ?>
            <?php foreach ($cart_items as $item): ?>
                <?php if (is_array($item) && isset($item['nazev'], $item['cena'], $item['quantity'])): ?>
                    <div class="cart-item">
                        <div>
                            <h3><?php echo htmlspecialchars($item['nazev']); ?></h3>
                            <p>Cena: <?php echo htmlspecialchars($item['cena']); ?> Kč</p>
                            <p>Množství: <?php echo htmlspecialchars($item['quantity']); ?></p>
                        </div>
                        <div>
                            <p>Celkem: <?php echo htmlspecialchars($item['cena'] * $item['quantity']); ?> Kč</p>
                            <form action="kosik.php" method="POST">
                                <input type="hidden" name="idprodukt" value="<?php echo $item['idprodukt']; ?>">
                                <button type="submit" name="delete_item" class="delete-button">Odstranit</button>
                            </form>
                        </div>
                    </div>
                <?php else: ?>
                    <p>Chyba: Nesprávná struktura položky v košíku.</p>
                <?php endif; ?>
            <?php endforeach; ?>
            <?php
            $total = array_reduce($cart_items, function ($sum, $item) {
                return $sum + (is_array($item) && isset($item['cena'], $item['quantity']) ? $item['cena'] * $item['quantity'] : 0);
            }, 0);
            ?>
            <div class="cart-total">
                Celková cena: <?php echo htmlspecialchars($total); ?> Kč
            </div>
            <button id="checkout-button" class="checkout-button">Pokračovat na dopravu</button>
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

<script>
//kontrola přihlášení - při kliknutí na tlačítko "Pokračovat na dopravu" zkontroluje zda-li je uživatel přihlášený
    document.getElementById('checkout-button').addEventListener('click', function() {
        var isLoggedIn = <?php echo json_encode($is_logged_in); ?>;
        if (isLoggedIn) {
            window.location.href = 'doprava.php';
        } else {
            alert('Pro pokračování musíte být přihlášeni');
        }
    });
</script>

</body>
</html>
