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
    </style>
</head>
<body>

<header>
    <a href="index.php" class="brand">
        <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQIieVzLTLWLIoRBM9Tbg5xcyiksVAG2QnsiQ&usqp=CAU" alt="Logo">
        <h1>nderground</h1>
    </a>
    <div class="login-register">
    <?php
        session_start();
        if(isset($_SESSION['iduser'])) {
            // Uživatel je přihlášen
                echo '<a href="logout.php">Odhlásit se</a>';
        } else {
            // Uživatel není přihlášen
                echo '<a href="register.php">Registrace</a>';
                echo '<a href="login.php">Přihlášení</a>';
        }
    ?>
        <a href="kosik.php">Košík</a>
    </div>

</header>

<main>
    <div class="products-container">
    <?php
        require 'conn.php';

        $query = "SELECT p.idprodukt, p.nazev, p.popis, p.cena, o.cesta 
                  FROM produkt p 
                  JOIN obrazek o ON p.obrazek_idobrazek = o.idobrazek";
        $result = $conn->query($query);

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo '<div class="product-item">';
                echo '<img src="images/' . $row["cesta"] . '" alt="' . $row["nazev"] . '">';
                echo '<h3>' . $row["nazev"] . '</h3>';
                echo '<p>' . $row["popis"] . '</p>';
                echo '<p>' . $row["cena"] . ' Kč</p>';
                echo '<form action="add_to_cart.php" method="POST">';
                echo '<input type="hidden" name="idprodukt" value="' . $row["idprodukt"] . '">';
                echo '<input type="number" name="quantity" value="1" min="1">';
                echo '<button type="submit" class="add-to-cart">Přidat do košíku</button>';
                echo '</form>';
                echo '</div>';
            }
        } else {
            echo "0 výsledků";
        }

        $conn->close();
    ?>
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
