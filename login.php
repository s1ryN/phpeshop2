<!DOCTYPE HTML>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Přihlášení</title>
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

        main {
            flex-grow: 1;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .login-form {
            border: 1px solid #ccc;
            padding: 20px;
            width: auto;

        }

        input[type=email], input[type=password], input[type=submit] {
            width: calc(100% - 22px);
            padding: 10px;
            margin: 10px;
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

        .register-link {
            text-align: center;
        }
    </style>
</head>
<body>

<header>
    <a href="index.php" class="brand">
        <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQIieVzLTLWLIoRBM9Tbg5xcyiksVAG2QnsiQ&usqp=CAU" alt="Logo">
        <h1>nderground</h1>
    </a>

    </a>
</header>

<main>
    <div class="login-form">
        <?php if (isset($_GET['error']) && $_GET['error'] == 'invalid'): ?>
            <p style="color: red;">Špatně zadané údaje.</p>
        <?php endif; ?>
        <form method="post" action="login-process.php">
            <p>Email*: <input type="email" name="email" required placeholder="jmeno.prijmeni@domena.cz"></p>
            <p>Heslo*: <input type="password" name="password" required placeholder="heslo"></p>
            <input type="submit" name="submit" value="Přihlásit se">
        </form>
        <div class="register-link">
            Nemáte účet? <a href="register.php">Vytvořte si ho!</a>
        </div>

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