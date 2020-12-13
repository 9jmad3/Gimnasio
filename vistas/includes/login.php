  <!-- Start your project here-->
  <div class="d-flex justify-content-center mb-n4" style="background-image: url('img/fondoLogin.jpg'); background-repeat: no-repeat; background-size: cover;" >

 <!-- Default form login -->

    <!-- ALERTAS-->
    <form class="text-center border border-light p-5 w-25 bg-white rounded-lg" action="?controller=Login&accion=inUser" id="login" method="post">
    <?php if (isset($mensajes)) {
          foreach ($mensajes as $mensaje) : ?> 
            <div class="alert alert-<?= $mensaje["tipo"] ?>"><?= $mensaje["mensaje"] ?></div>
        <?php endforeach;
    }?>
    <!-- ALERTAS-->

    <p class="h4 mb-4">Iniciar sesion</p>

    <!-- Usuario -->
    <input type="text" id="defaultLoginFormEmail" name="txtusuario" class="form-control mb-4" placeholder="" value="<?php if(isset($_COOKIE['usuario'])) {echo$_COOKIE['usuario']; }?>">

    <!-- Password -->
    <input type="password" id="defaultLoginFormPassword" name="txtpassword" class="form-control mb-4" placeholder="" value="<?php if(isset($_COOKIE['password'])) {echo$_COOKIE['password']; } ?>">

    <div class="d-flex justify-content-around">
        <div>
            <!-- Remember me -->
            <div class="custom-control custom-checkbox">
                <input type="checkbox" class="custom-control-input" id="defaultLoginFormRemember" name="recuerdo" <?php if(isset($_COOKIE['recuerdo'])) {echo"checked";} ?>>
                <label class="custom-control-label" for="defaultLoginFormRemember">Recuerdame</label>
            </div>
        </div>
        <div>
            <!-- Forgot password -->
            <a href="">Recuperar contraseña</a>
        </div>
    </div>

    <!-- Sign in button -->
    <button class="btn btn-indigo btn-block my-4 ml-n1 mt-5" type="submit"  name="submit">Entrar</button>
    </form>
<!-- Default form login -->
  </div>
  <!-- /Start your project here-->

  <!-- SCRIPTS -->
  <!-- JQuery -->
  <script type="text/javascript" src="js/jquery-3.4.1.min.js"></script>
  <!-- Bootstrap tooltips -->
  <script type="text/javascript" src="js/popper.min.js"></script>
  <!-- Bootstrap core JavaScript -->
  <script type="text/javascript" src="js/bootstrap.min.js"></script>
  <!-- MDB core JavaScript -->
  <script type="text/javascript" src="js/mdb.min.js"></script>

