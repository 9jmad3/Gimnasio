<!-- Default form login -->
<form class="text-center border border-light p-5 w-50 container" action="index.php" method="POST" >

    <img src="img/login.jpg" alt="" class="rounded-circle w-25 mb-4">

    <!-- Usuario -->
    <input type="text" id="defaultLoginFormEmail" class="form-control mb-4" placeholder="Usuario" name="usuario" value="<?php if(isset($_COOKIE['usuario'])) {echo$_COOKIE['usuario']; }?>">

    <!-- Password -->
    <input type="password" id="defaultLoginFormPassword" class="form-control mb-4" placeholder="Password" name="password" value="<?php if(isset($_COOKIE['password'])) {echo$_COOKIE['password']; } ?>">

    <!-- PHP DE FALLOS -->
    <?php
      if(isset($_GET['error'])){
        if ($_GET['error'] == "datos") {
        echo'<div class="alert alert-warning" role="alert">
              <strong>¡Atención!</strong> Contraseña o usuario incorrecto.
              </div>';
        }
        elseif($_GET['error']== "fuera"){
        echo'<div class="alert alert-info" role="alert">
              <strong>¡Credenciales!</strong> Necesitas estar logueado para ver eso.
              </div>';
        }
      }
      ?> 

    <div class="d-flex justify-content-around">
        <div>
            <!-- Remember me -->
            <div class="custom-control custom-checkbox">
                <input type="checkbox" class="custom-control-input" id="defaultLoginFormRemember" name="recuerdo" <?php if(isset($_COOKIE['recuerdo'])) {echo"checked";} ?>>
                <label class="custom-control-label" for="defaultLoginFormRemember">Recuerdame</label>
            </div>
        </div>
        <div>
            <!-- Sesion abierta -->
            <div class="custom-control custom-checkbox">
                <input type="checkbox" class="custom-control-input" id="sesionAbierta" name="abierta" <?php if(isset($_COOKIE['abierta'])) {echo"checked";} ?>>
                <label class="custom-control-label" for="sesionAbierta">Mantener sesion abierta</label>
            </div>
        </div>
    </div>

    <!-- Sign in button -->
    <button class="btn btn-primary btn-block my-4" type="submit" name="enviar">Entrar</button>

</form>
<!-- Default form login -->