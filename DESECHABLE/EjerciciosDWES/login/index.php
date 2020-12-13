<?php
  $usuariook= "pepe";
  $passok= "123";
  $error=$_GET['error'];
  if(isset($_POST['enviar'])) //Si se ha enviado el formulario… 
      { // Comprobamos que se han recibido las variables y que no están vacías
        
    if((isset($_POST['usuario'])&& isset($_POST['password'])) && ((!empty($_POST['usuario']))&& (!empty($_POST['usuario'])))) { // Comprobamos datos de usuario correctos
        if ($_POST['usuario']== $usuariook && $_POST['password']== $passok) {// Si son correctos iniciamos la sesión denominada ‘logueado’
            session_start();
            $_SESSION['logueado']= $_POST['usuario'];
            $_SESSION['usuario']= $_POST['usuario'];
            if(isset($_POST['recuerdo']) && ($_POST['recuerdo']=="on"))            { // Creamos las cookies para ambas variables
                setcookie('usuario',$_POST['usuario'],time() + (15 * 24 * 60 * 60));
                setcookie('password',$_POST['password'],time() + (15 * 24 * 60 * 60));
                setcookie('recuerdo',$_POST['recuerdo'],time() + (15 * 24 * 60 * 60));
            } else{ // Eliminamos las cookies vaciandolas
                if(isset($_COOKIE['usuario'])) { setcookie('usuario',""); }
                if(isset($_COOKIE['password'])){ setcookie('password',""); }
                if(isset($_COOKIE['recuerdo'])){ setcookie('recuerdo',""); } 
            }
            // Lógica asociada a mantener la sesión abierta
            if(isset($_POST['abierta']) && ($_POST['abierta']=="on")){
                setcookie('abierta',$_POST['usuario'],time() + (15* 24 * 60 * 60));
            } else { 
                if(isset($_COOKIE['abierta'])){
                 setcookie('abierta',""); }
            }
                header("Location: frmPaginaUno.php");// Accedemos a la página de inicio
        } else{ 
            header ("Location: index.php?error=datos"); // Redirigimos a la página de login
        }
    }
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
        <?php require 'includes/formulario.php'; ?>
        <?php require 'includes/footer.php'; ?>
    </body>
</html>