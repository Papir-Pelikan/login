<?php
$servername = "sqlXXX.epizy.com"; // phpMyAdmin -> Hostname
$username   = "epiz_XXXXXXX";     // InfinityFree DB user
$password   = "saját_jelszó";     // InfinityFree DB password
$dbname     = "epiz_XXXXXXX_db";  // InfinityFree DB név

$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
    die("Adatbázis kapcsolat sikertelen: " . mysqli_connect_error());
}
?>
