<?php
// Prisijungimo duomenys (Pvz., saugomi duomenų bazėje)
$stored_username = 'admin';
$stored_password_hash = '$2y$10$e5UfjXeV6tn5vslH.jMcbTVdD4KXYtqms0bSUsax.Q5c2ar2RE4XO'; // bcrypt hash

// Patikriname, ar gauti duomenys atitinka
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    if ($username === $stored_username && password_verify($password, $stored_password_hash)) {
        echo 'Prisijungta sėkmingai!';
        // Čia galite nukreipti į kitą puslapį, pavyzdžiui:
        // header('Location: dashboard.php');
    } else {
        echo 'Neteisingas vartotojo vardas arba slaptažodis';
    }
}
?>
