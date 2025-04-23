<!DOCTYPE HTML>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrace</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
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
            flex-grow: 1;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .registration-form {
            border: 1px solid #ccc;
            padding: 20px;
            margin: 20px;
            width: auto;

        }

        input[type=text], input[type=email], input[type=tel], input[type=password], input[type=submit] {
            width: calc(100% - 22px);
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        input[type=submit] {
            width: 100%;
            padding: 10px;
            border: none;
            border-radius: 5px;
            background-color: #007BFF;
            color: white;
            cursor: pointer;
        }

        input[type=submit]:hover {
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

</header>

<main>
    <div class="registration-form">
        <?php if (isset($_GET['error']) && $_GET['error'] == 'invalid'): ?>
            <p style="color: red;">Špatně zadané údaje.</p>
        <?php endif; ?>
        <form method="post" action="registration-process.php">
            <p>Jméno: <input type="text" name="firstName" required placeholder="Jméno"></p>
            <p>Příjmení: <input type="text" name="lastName" required placeholder="Příjmení"></p>
            <p>Email: <input type="email" name="email" required placeholder="email@example.com"></p>
            <p>Heslo: <input type="password" name="password" required placeholder="superheslo123"></p>
            <p>Telefonní číslo: <input type="tel" name="phone" pattern="[0-9]{3}-[0-9]{3}-[0-9]{3}" required placeholder="123-456-789"></p>
            <p>Ulice a číslo popisné: <input type="text" name="street" required placeholder="Shrekova bažina 69"></p>
            <p>Město: <input type="text" name="city" required placeholder="Praha pod Vltavou"></p>
            <p>PSČ: <input type="text" name="psc" required placeholder="24775"></p>
            <p>IČO: <input type="text" name="billingDetails" placeholder="12345678"></p>
            <p>Číslo kreditní karty: <input type="text" name="creditCardNumber" required placeholder="1234567891234567"></p>
            <p>Datum expirace: <input type="text" name="expirationDate" required placeholder="MM/RR"></p>
            <p>CVV: <input type="text" name="cvv" required placeholder="123"></p>
            <input type="submit" value="Registrovat">
        </form>
    </div>

    <div class="back-link">
        Již máte účet? <a href="login.php">Přihlásit se</a>
    </div>
</main>

<footer>
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