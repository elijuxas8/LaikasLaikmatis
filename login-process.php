<?php
// Patikriname, ar buvo gauti duomenys iš formos
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Patikriname, ar duomenys teisingi
    if ($username == "admin" && $password == "slaptažodis123") {
        echo "Prisijungta sėkmingai!";
        // Galite atlikti papildomas veiksmų sekas, pvz., nukreipti į kitą puslapį
        // header("Location: dashboard.php"); // Nukreipia į valdymo puslapį
    } else {
        echo "Neteisingas vartotojo vardas arba slaptažodis.";
    }
} else {
    echo "Prašome užpildyti formą.";
}
?>
