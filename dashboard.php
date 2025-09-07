<?php
session_start();

// Ha nincs bejelentkezve, irányítsuk vissza a login oldalra
if (!isset($_SESSION['user_id'])) {
    header("Location: loginscreen.html");
    exit();
}
?>
<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <title>Vezérlőpult</title>
</head>
<body>
    <h1>Szia, <?php echo htmlspecialchars($_SESSION['name']); ?>! 👋</h1>
    <p>Szerepköröd: <?php echo htmlspecialchars($_SESSION['role']); ?></p>
    <p>Email: <?php echo htmlspecialchars($_SESSION['email']); ?></p>
    <p>Secret: <?php echo htmlspecialchars($_SESSION['current_secret']); ?></p>
    <a href="logout.php">Kilépés</a>
</body>
</html>
