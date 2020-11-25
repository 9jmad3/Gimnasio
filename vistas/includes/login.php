  <!-- Start your project here-->
  <div class="d-flex justify-content-center unique-color-dark mb-n4" style="height: 100vh" >

 <!-- Default form login -->

    <!-- ALERTAS-->
    <form class="text-center border border-light p-5 w-50 bg-white rounded-lg" action="?controller=Login&accion=inUser" id="login" method="post">
    <?php if (isset($mensajes)) {
          foreach ($mensajes as $mensaje) : ?> 
            <div class="alert alert-<?= $mensaje["tipo"] ?>"><?= $mensaje["mensaje"] ?></div>
        <?php endforeach;
    }?>
    <!-- ALERTAS-->

    <p class="h4 mb-4">Iniciar sesion</p>

    <!-- Usuario -->
    <input type="text" id="defaultLoginFormEmail" name="txtusuario" class="form-control mb-4" placeholder="">

    <!-- Password -->
    <input type="password" id="defaultLoginFormPassword" name="txtpassword" class="form-control mb-4" placeholder="">

    <div class="d-flex justify-content-around">
        <div>
            <!-- Remember me -->
            <div class="custom-control custom-checkbox">
                <input type="checkbox" class="custom-control-input" id="defaultLoginFormRemember">
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

    <!-- Social login -->
    <div class="mt-5">
        <a href="#" class="mx-2" role="button"><i class="fab fa-facebook-f light-blue-text"></i></a>
        <a href="#" class="mx-2" role="button"><i class="fab fa-twitter light-blue-text"></i></a>
        <a href="#" class="mx-2" role="button"><i class="fab fa-linkedin-in light-blue-text"></i></a>
        <a href="#" class="mx-2" role="button"><i class="fab fa-github light-blue-text"></i></a>
    </div>
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

