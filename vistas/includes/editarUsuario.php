<div class="container" style="margin-top: 100px !important;">
    <!-- Default form register -->
    <form class="text-center border border-light p-5" action="?controller=User&accion=actuser&usuario=<?= $_GET['usuario'] ?>" method="post">
    
        <p class="h4 mb-4">EDITAR USUARIO</p>

        <!-- Nombre -->
        <input type="text" id="defaultRegisterFormFirstName" class="form-control mb-4" placeholder="Nombre" name="txtnombre" value="<?php if(isset($datos['datos']['nombre'])){echo $datos['datos']['nombre'] ;}?>">
        <?php if (isset($mensajes)) {
            foreach ($mensajes as $mensaje) : 
                if ($mensaje["campo"] == "nombre") {?>                         
                <div class="alert alert-<?= $mensaje["tipo"] ?>"><?= $mensaje["mensaje"] ?></div>
            <?php } endforeach;
        }?>

        <div class="form-row mb-4">
            <div class="col">
                <!-- Apellido uno -->
                <input type="text" id="defaultRegisterFormFirstName" class="form-control" placeholder="Primer apellido" name="txtapellido1" value="<?php if(isset($datos['datos']['apellido1'])){echo $datos['datos']['apellido1'] ;}?>">
            </div>
            <div class="col">
                <!-- Apellido dos -->
                <input type="text" id="defaultRegisterFormLastName" class="form-control" placeholder="Segundo apellido" name="txtapellido2" value="<?php if(isset($datos['datos']['apellido2'])){echo $datos['datos']['apellido2'] ;}?>">
            </div>
        </div>

        <!-- Dni -->
        <input type="text" id="defaultRegisterFormEmail" class="form-control mb-4" placeholder="DNI" name="txtdni" value="<?php if(isset($datos['datos']['nif'])){echo $datos['datos']['nif'] ;}?>">
        <?php if (isset($mensajes)) {
            foreach ($mensajes as $mensaje) : 
                if ($mensaje["campo"] == "dni") {?>                         
                <div class="alert alert-<?= $mensaje["tipo"] ?>"><?= $mensaje["mensaje"] ?></div>
            <?php } endforeach;
        }?>

        <!-- Phone number -->
        <input type="text" id="defaultRegisterPhonePassword" class="form-control  mb-4" placeholder="Telefono movil" name="txttelefono" aria-describedby="defaultRegisterFormPhoneHelpBlock" value="<?php if(isset($datos['datos']['telefono'])){echo $datos['datos']['telefono'] ;}?>">
        <?php if (isset($mensajes)) {
            foreach ($mensajes as $mensaje) : 
                if ($mensaje["campo"] == "telefono") {?>                         
                <div class="alert alert-<?= $mensaje["tipo"] ?>"><?= $mensaje["mensaje"] ?></div>
            <?php } endforeach;
        }?>
        
        <!-- Direccion -->
        <input type="text" id="defaultRegisterForDireccion" class="form-control mb-4" placeholder="Direccion" name="txtdireccion" value="<?php if(isset($datos['datos']['direccion'])){echo $datos['datos']['direccion'] ;}?>">
        <?php if (isset($mensajes)) {
            foreach ($mensajes as $mensaje) : 
                if ($mensaje["campo"] == "direccion") {?>                         
                <div class="alert alert-<?= $mensaje["tipo"] ?>"><?= $mensaje["mensaje"] ?></div>
            <?php } endforeach;
        }?>

        <!-- Sign up button -->
        <button class="btn btn-info my-4 btn-block" type="submit" name="submit">Actualizar</button>

        <!-- Terms of service -->
    </form>
    <!-- Default form register -->
</div>