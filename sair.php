<?php
session_start();
session_destroy();

// Limpar o cookie de nome do administrador
if (isset($_COOKIE['admin_name'])) {
    setcookie('admin_name', '', time() - 3600);
}

header("Location: index.php");
exit;
?>
