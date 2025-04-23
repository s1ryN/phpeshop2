<!DOCTYPE html>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produkty Kategorie</title>
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
            display: flex;
            justify-content: space-between;
            padding: 20px;
        }

        .products-container {
            display: flex;
            flex-wrap: wrap;
            padding: 20px;
            justify-content: space-around;
        }
        .product-item {
            width: 30%; /* každý produkt zabírá trochu méně než třetinu šířky kontejneru */
            margin-bottom: 20px;
            background-color: #fff;
            border: 1px solid #ccc;
            border-radius: 5px;
            padding: 10px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        .product-item img {
            width: 100%;
            height: auto;
            border-radius: 5px;
        }
        .product-item h3, .product-item p {
            text-align: center;
        }
        .add-to-cart {
            display: block;
            width: 100%;
            padding: 10px;
            background-color: #007BFF;
            color: #fff;
            text-align: center;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s;
        }
        .add-to-cart:hover {
            background-color: #0056b3;
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

        main h1 {
            text-align: center;
            margin-top: 20px;
            font-size: 24px;
            color: #333;
        }

        .print-invoice-btn {
            display: block;
            width: 200px; 
            margin: 0 auto;
            padding: 10px; 
            background-color: #007BFF;
            color: #fff;
            text-align: center;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s;
            height: 50px;
        }

        .print-invoice-btn:hover {
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
    <h1>Děkujeme za objednávku, vaše objednávka se nyní připravuje</h1>
    <a href="faktura.php" class="print-invoice-btn">Stáhnout fakturu</a>
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
