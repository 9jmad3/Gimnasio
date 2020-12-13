<?php
 session_start(); // Activamos el uso de sesiones
 session_unset(); // Libera todas las variables de sesión
 setcookie('abierta',"");
 session_destroy(); // Destruimos la sesión
 header("location:../index.php"); //Redirigimos a la página de Login
?>