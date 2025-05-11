<?php
session_start();
$host = "localhost";
$user = "root";
$pass = "";
$dbname = "mano_puslapis"; // Pakeisk į savo DB

$conn = new mysqli($host, $user, $pass, $dbname);
if ($conn->connect_error) {
    die("Klaida jungiantis prie duomenų bazės: " . $conn->connect_error);
}

// Gauk vartotojo vardą ir slaptažodį iš formos
$username = $_POST['username'];
$password = $_POST['password'];

// Patikriname, ar vartotojas egzistuoja ir ar slaptažodis atitinka
$sql = "SELECT * FROM users WHERE username = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 1) {
    $user = $result->fetch_assoc();

    // Patikriname, ar slaptažodis teisingas
    if (password_verify($password, $user['password']) && $user['role'] === 'admin') {
        $_SESSION['username'] = $user['username'];
        header("Location: admin_only.php");
    } else {
        echo "Neteisingas slaptažodis arba neturite teisės prisijungti.";
    }
} else {
    echo "Vartotojas nerastas.";
}

$stmt->close();
$conn->close();
?>
