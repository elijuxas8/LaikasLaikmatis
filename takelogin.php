<?php
// Prisijungimas prie duomenų bazės
$servername = "localhost";
$username = "root"; // Jūsų duomenų bazės vartotojo vardas
$password = ""; // Jūsų duomenų bazės slaptažodis
$dbname = "vartotojai"; // Jūsų duomenų bazės pavadinimas

$conn = new mysqli($servername, $username, $password, $dbname);

// Patikriname, ar prisijungimas sėkmingas
if ($conn->connect_error) {
    die("Nepavyko prisijungti prie duomenų bazės: " . $conn->connect_error);
}

// Patikriname, ar forma buvo pateikta
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user = $_POST['username']; // Vartotojo vardas
    $pass = $_POST['password']; // Slaptažodis

    // Paieška duomenų bazėje, kad gauti vartotojo informaciją
    $sql = "SELECT * FROM vartotojai WHERE username = '$user' AND password = '$pass'";
    $result = $conn->query($sql);

    // Jei vartotojas rastas
    if ($result->num_rows > 0) {
        // Prisijungimo sėkmė
        session_start(); // Pradėti sesiją
        $_SESSION['username'] = $user; // Išsaugoti vartotojo vardą sesijoje
        header("Location: dashboard.php"); // Nukreipti į valdymo puslapį
    } else {
        // Jei vartotojas nerastas
        echo "Neteisingas vartotojo vardas arba slaptažodis.";
    }
}

// Uždaryti duomenų bazės ryšį
$conn->close();
?>
