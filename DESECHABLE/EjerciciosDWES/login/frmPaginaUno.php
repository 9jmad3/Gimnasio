<?php
 session_start(); //Activamos el uso de sesiones
 if((!isset($_SESSION['logueado']))&& (!isset($_COOKIE['abierta']))){ //Si no existe la sesión ni la cookie de sesion abierta
    //Redirigimos a la página de login con el tipo de error ‘fuera’: que indica que
    // se trató de acceder directamente a una página sin loguearse previamente
    header ("Location: index.php?error=fuera");
 }
?>

<!-- Documento principal que incluye a los demás -->
<!DOCTYPE html>
<html lang="en">
<head>
    <?php require 'includes/header.php'; ?>
</head>
    <body>
        <?php require 'includes/menu.php'; ?>
        <?php require 'paginasPersonales/paginaUno.php'; ?>
        <?php require 'includes/footer.php'; ?>
    </body>
</html>