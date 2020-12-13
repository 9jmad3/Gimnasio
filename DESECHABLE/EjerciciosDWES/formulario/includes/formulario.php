<div class="container">

  <!-- Si se ha pulsado y el botón y no hay errores se crea un tarjeta con la información (Falta mostrar la img)-->
  <?php if (isset($_POST["submit"]) && (count($errors) == 0))
  echo'
  <div class="card mb-3 border-primary">
    <img class="card-img-top" style="height: 13rem; object-fit: cover;" id="imgMuestra" src="../formulario/img/imgCard.jpg" alt="No se ha podido cargar la imagen.">
    <div class="card-body">
      <h4 class="card-title">Valores obtenidos mediante el formulario</h4>
      <p class="card-text">
            <strong>Nombre:</strong> ' . $_POST['name'] . '<br/>
            <strong>Apellidos:</strong> ' . $_POST['surnames'] . '<br/>
            <strong>Biografía:</strong> ' . $_POST['biography'] . '<br/>
            <strong>Email:</strong> ' . $_POST['email'] . '<br/>
            <strong>Contraseña:</strong> ' . $_POST['password'] . '<br/>
            <strong>Perfil:</strong> ' . $_POST['role'] . '<br/>
      </p>
    </div>
  </div>
  '?>

  <!-- FORMULARIO. Se guardan los campos ya introducidos y se muestran losm errores si es necesario.-->
  <form class="shadow-lg px-3 py-3 rounded-lg bg-light" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST" name="formulario" enctype="multipart/form-data">
    <div class="form-group">
      <label for="formGroupInputName">Nombre</label>
      <input type="text" class="form-control" id="formGroupInputName"  name="name" <?php if(isset($_POST["name"])){echo "value='{$_POST["name"]}'";} ?>>
      <?php echo mostrar_error($errors, "name"); ?>
    </div>

    <div class="form-group">
      <label for="formGroupInputSurnames">Apellidos</label>
      <input type="text" class="form-control" id="formGroupInputSurnames" name="surnames" <?php if(isset($_POST["surnames"])){echo "value='{$_POST["surnames"]}'";} ?>>
      <?php echo mostrar_error($errors, "surnames"); ?>
    </div>

    <div class="form-group">
      <label for="formGroupInputBiography">Biografia</label>
      <input type="text" class="form-control" id="formGroupInputBiography" name="biography" <?php if(isset($_POST["biography"])){echo "value='{$_POST["biography"]}'";} ?>>
      <?php echo mostrar_error($errors, "biography"); ?>
    </div>

    <div class="form-group">
      <label for="formGroupInputEmail">Correo</label>
      <input type="email" class="form-control" id="formGroupInputEmail" name="email" <?php if(isset($_POST["email"])){echo "value='{$_POST["email"]}'";} ?>>
      <?php echo mostrar_error($errors, "email"); ?>
    </div>

    <div class="form-group">
      <p class="font-weight-normal">Imagen</p>
      <div class="custom-file">
        <label class="custom-file-label" for="customFile">Elija un archivo</label>
        <input type="file" class="custom-file-input" id="customFile" name="image">
        <?php echo mostrar_error($errors, "image"); ?> 
      </div>
    </div>

    <div class="form-group">
      <label for="formGroupInputPassword">Contraseña</label>
      <input type="password" class="form-control" id="formGroupInputPassword" name="password">
      <?php echo mostrar_error($errors, "password"); ?>
    </div>

    <div class="form-group">
      <p class="font-weight-normal">Rol</p>
      <select class="custom-select" name="role">
        <option selected>Seleccione una opcion</option>
        <option value="1" <?php if(isset($_POST["role"])){ if($_POST["role"]==1){ echo "selected='selected'"; }} ?>>Normal</option>
        <option value="2" <?php if(isset($_POST["role"])){ if($_POST["role"]==2){ echo "selected='selected'"; }} ?>>Administrador</option>
      </select>
      <?php echo mostrar_error($errors, "role"); ?>
    </div>

    <div class="form-group d-flex justify-content-center">
        <button type="submit" class="btn btn-primary" name="submit">Enviar</button>
    </div>
  </form>
</div>