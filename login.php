<?php
session_start();
include("config.php");

// Állítsuk a visszaküldött tartalom típusát JSON-ra
header('Content-Type: application/json');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = mysqli_real_escape_string($conn, $_POST['email']); // EMAIL használata
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE email='$email' LIMIT 1"; // EMAIL alapján keresés
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);

        if (password_verify($password, $row['password'])) {
            // Session-be mentjük az adatokat
            $_SESSION['user_id'] = $row['user_id'];
            $_SESSION['name'] = $row['name'];
            $_SESSION['role'] = $row['role'];
            $_SESSION['email'] = $row['email'];

            // JSON válasz sikeres belépéshez
            echo json_encode([
                'success' => true,
                'redirect' => 'dashboard.php'
            ]);
        } else {
            echo json_encode([
                'success' => false,
                'message' => '❌ Hibás jelszó!'
            ]);
        }
    } else {
        echo json_encode([
            'success' => false,
            'message' => '❌ Nincs ilyen felhasználó!'
        ]);
    }
} else {
    // Ha nem POST, jelezzük hibával
    echo json_encode([
        'success' => false,
        'message' => '❌ Érvénytelen kérés!'
    ]);
}
?>