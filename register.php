<?php
$host = "localhost";
$user = "root";
$pass = "";
$dbname = "tavoduombaze"; // Pakeisk į tikrą DB pavadinimą

$conn = new mysqli($host, $user, $pass, $dbname);
if ($conn->connect_error) {
    die("Klaida jungiantis prie DB: " . $conn->connect_error);
}

$username = $_POST['username'];
$email = $_POST['email'];
$password = password_hash($_POST['password'], PASSWORD_BCRYPT); // Užkoduojam slaptažodį

$sql = "INSERT INTO users (username, email, password) VALUES (?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sss", $username, $email, $password);

if ($stmt->execute()) {
    echo "Registracija sėkminga!";
    // Gali nukreipti į prisijungimo puslapį:
    // header("Location: login.html");
} else {
    echo "Klaida: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
