<div class="container" style="margin-top: 100px !important;">
    <!-- Default form register -->
    <form class="text-center border border-light p-5" action="?controller=Index&accion=register" method="post">

        <p class="h4 mb-4">Completa tu perfil!</p>

        <!-- Nombre -->
        <input type="text" id="defaultRegisterFormFirstName" class="form-control mb-4" placeholder="Nombre" name="txtnombre" value="<?php if(isset($_SESSION['nombre'])){echo $_SESSION['nombre'] ;}?>">
        <?php if (isset($mensajes)) {
            foreach ($mensajes as $mensaje) : 
                if ($mensaje["campo"] == "nombre") {?>                         
                <div class="alert alert-<?= $mensaje["tipo"] ?>"><?= $mensaje["mensaje"] ?></div>
            <?php } endforeach;
        }?>

        <div class="form-row mb-4">
            <div class="col">
                <!-- Apellido uno -->
                <input type="text" id="defaultRegisterFormFirstName" class="form-control" placeholder="Primer apellido" name="txtapellido1" value="<?php if(isset($_SESSION['apellido1'])){echo $_SESSION['apellido1'] ;}?>">
            </div>
            <div class="col">
                <!-- Apellido dos -->
                <input type="text" id="defaultRegisterFormLastName" class="form-control" placeholder="Segundo apellido" name="txtapellido2" value="<?php if(isset($_SESSION['apellido2'])){echo $_SESSION['apellido2'] ;}?>">
            </div>
        </div>

        <!-- Dni -->
        <input type="text" id="defaultRegisterFormEmail" class="form-control mb-4" placeholder="DNI" name="txtdni" value="<?php if(isset($_SESSION['dni'])){echo $_SESSION['dni'] ;}?>">
        <?php if (isset($mensajes)) {
            foreach ($mensajes as $mensaje) : 
                if ($mensaje["campo"] == "dni") {?>                         
                <div class="alert alert-<?= $mensaje["tipo"] ?>"><?= $mensaje["mensaje"] ?></div>
            <?php } endforeach;
        }?>

        <!-- Phone number -->
        <input type="text" id="defaultRegisterPhonePassword" class="form-control  mb-4" placeholder="Telefono movil" name="txttelefono" aria-describedby="defaultRegisterFormPhoneHelpBlock" value="<?php if(isset($_SESSION['telefono'])){echo $_SESSION['telefono'] ;}?>">
        <?php if (isset($mensajes)) {
            foreach ($mensajes as $mensaje) : 
                if ($mensaje["campo"] == "telefono") {?>                         
                <div class="alert alert-<?= $mensaje["tipo"] ?>"><?= $mensaje["mensaje"] ?></div>
            <?php } endforeach;
        }?>
        
        <!-- Direccion -->
        <input type="text" id="defaultRegisterForDireccion" class="form-control mb-4" placeholder="Direccion" name="txtdireccion" value="<?php if(isset($_SESSION['direccion'])){echo $_SESSION['direccion'] ;}?>">
        <?php if (isset($mensajes)) {
            foreach ($mensajes as $mensaje) : 
                if ($mensaje["campo"] == "direccion") {?>                         
                <div class="alert alert-<?= $mensaje["tipo"] ?>"><?= $mensaje["mensaje"] ?></div>
            <?php } endforeach;
        }?>

        <!-- Sign up button -->
        <button class="btn btn-info my-4 btn-block" type="submit" name="submit">Actualizar</button>

        <hr>

        <!-- Terms of service -->
        <p>Al completar tu perfil un administrador verificará los datos y validará tu cuenta.

    </form>
    <!-- Default form register -->
</div>