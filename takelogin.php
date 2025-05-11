<?php
session_start();

// Duomenų bazės duomenys
$host = "localhost";
$user = "root";
$pass = "";
$dbname = "mano_puslapis"; // Pakeisk į tikrą savo DB pavadinimą

// Prisijungimas prie DB
$conn = new mysqli($host, $user, $pass, $dbname);
if ($conn->connect_error) {
    die("Klaida jungiantis prie duomenų bazės: " . $conn->connect_error);
}

// Gaunam duomenis iš formos
$username = $_POST['username'];
$password = $_POST['password'];

// Ieškom vartotojo
$sql = "SELECT * FROM users WHERE username = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 1) {
    $user = $result->fetch_assoc();

    // Tikrinam slaptažodį
    if (password_verify($password, $user['password'])) {
        $_SESSION['username'] = $user['username'];
        echo "Prisijungimas sėkmingas. Sveikas, " . htmlspecialchars($user['username']) . "!";

        // Galima peradresuoti:
        // header("Location: index.html");
        // exit;
    } else {
        echo "Neteisingas slaptažodis.";
    }
} else {
    echo "Vartotojas nerastas.";
}

$stmt->close();
$conn->close();
?>
