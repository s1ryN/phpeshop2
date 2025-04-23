<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['delivery_option'])) {
        $_SESSION['delivery_option'] = $_POST['delivery_option'];
    }
    if (isset($_POST['payment_option'])) {
        $_SESSION['payment_option'] = $_POST['payment_option'];
    }
    header('Location: potvrzeni.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Doprava a platba</title>
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

        .form-container {
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            max-width: 600px;
            margin: 0 auto;
        }

        .form-container h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }

        .form-group select, .form-group button {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .form-group button {
            background-color: #007BFF;
            color: #fff;
            border: none;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .form-group button:hover {
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
        <a href="login.php">Přihlásit se</a>
        <a href="register.php">Registrovat se</a>
        <a href="kosik.php">Košík</a>
    </div>
</header>

<main>
    <div class="form-container">
        <h2>Vyberte dopravu a platbu</h2>
        <form action="doprava.php" method="POST">
            <div class="form-group">
                <label for="delivery_option">Způsob dopravy:</label>
                <select name="delivery_option" id="delivery_option" required>
                    <option value="Zásilkovna">Zásilkovna</option>
                    <option value="Česká Pošta">Česká Pošta</option>
                    <option value="PPL">PPL</option>
                    <option value="Osobní převzetí">Osobní převzetí</option>
                </select>
            </div>
            <div class="form-group">
                <label for="payment_option">Způsob platby:</label>
                <select name="payment_option" id="payment_option" required>
                    <option value="Platba kartou online">Platba kartou online</option>
                </select>
            </div>
            <div class="form-group">
                <button type="submit">Pokračovat</button>
            </div>
        </form>
    </div>
</main>

<footer>
    <div class="footer-info">
        <p>Telefonní číslo: +420 724 394 232</p>
        <p>Adresa e-mail: Je.pdf@skolakrizik.cz</p>
        <p>IČO: 69696969</p>
        <p>DIČ: 420420420</p>
    </div>
</footer>

</body>
</html>
