<?php
session_start();

// Tikrinam, ar vartotojas prisijungęs ir ar jis yra administratorius
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}

$host = "localhost";
$user = "root";
$pass = "";
$dbname = "mano_puslapis"; // Pakeisk į savo DB

$conn = new mysqli($host, $user, $pass, $dbname);
if ($conn->connect_error) {
    die("Klaida jungiantis prie duomenų bazės: " . $conn->connect_error);
}

$username = $_SESSION['username'];
$sql = "SELECT role FROM users WHERE username = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 1) {
    $user = $result->fetch_assoc();
    if ($user['role'] !== 'admin') {
        echo "Neturite teisės pasiekti šio puslapio.";
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="lt">
<head>
    <meta charset="UTF-8">
    <title>Administratoriaus Puslapis</title>
    <style>
        body {
            background-color: #1a1a2e;
            color: white;
            font-family: Arial, sans-serif;
        }
        .container {
            padding: 50px;
            text-align: center;
            background-color: #2e2e4d;
            border-radius: 10px;
        }
        a {
            color: #bbb;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Sveikas, <?php echo $_SESSION['username']; ?>!</h1>
        <p>Čia yra administratoriaus turinys.</p>
        <a href="logout.php">Atsijungti</a>
    </div>
</body>
</html>
