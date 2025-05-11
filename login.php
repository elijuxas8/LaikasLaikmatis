<?php
session_start();
if (isset($_SESSION['username'])) {
    header("Location: admin_only.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="lt">
<head>
    <meta charset="UTF-8">
    <title>Login - Administratoriaus Puslapis</title>
    <style>
        body {
            background-color: #2c3e50;
            color: white;
            font-family: Arial, sans-serif;
            text-align: center;
        }
        .login-container {
            margin-top: 50px;
            background-color: #34495e;
            padding: 20px;
            border-radius: 10px;
            width: 300px;
            margin: 0 auto;
        }
        input {
            padding: 10px;
            margin: 10px;
            width: 90%;
            border-radius: 5px;
            border: none;
        }
        .submit-btn {
            background-color: #1abc9c;
            color: white;
            cursor: pointer;
            border: none;
            font-size: 16px;
        }
        .submit-btn:hover {
            background-color: #16a085;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <h2>Prisijungti kaip Administratorius</h2>
        <form action="takelogin.php" method="POST">
            <input type="text" name="username" placeholder="Vartotojo vardas" required>
            <input type="password" name="password" placeholder="Slaptažodis" required>
            <input type="submit" class="submit-btn" value="Prisijungti">
        </form>
    </div>
</body>
</html>
