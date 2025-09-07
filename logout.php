<?php
session_start();
session_destroy();
header("Location: loginscreen.html");
exit();
?>
