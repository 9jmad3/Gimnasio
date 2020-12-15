<div class="container" style="margin-top: 100px !important;">

    <?php if (isset($mensajes)) {
          foreach ($mensajes as $mensaje) : ?> 
            <div class="alert alert-<?= $mensaje["tipo"] ?>"><?= $mensaje["mensaje"] ?></div>
        <?php endforeach;
    }?>

    <!-- Default form register -->
    <form class="text-center border border-light p-5" action="?controller=index&accion=editarClase&id=<?= $_GET['id'] ?>" method="post" enctype="multipart/form-data">

        <p class="h4 mb-4">EDITAR CLASE</p>

        <!-- Nombre -->
        <input type="text" id="defaultRegisterFormFirstName" class="form-control mb-4" placeholder="Nombre" name="txtnombre" value="<?= $datos[0]['nombre']?>">
       
        <!-- Tipo -->
        <select class="browser-default custom-select form-control mb-4" name="txttipo">
            <option selected><?= $datos[0]['tipo']?></option>
            <option value="Resistencia">Resistencia</option>
            <option value="Estiramiento">Estiramiento</option>
            <option value="Resistenca-Fuerza">Resistenca-Fuerza</option>
        </select>

        <!-- Descripcion -->
        <div class="form-group">
            <textarea class="form-control rounded-0" id="exampleFormControlTextarea2" name="txtdescripcion" rows="6" placeholder="Descripcion"><?= $datos[0]['descripcion']?></textarea>
        </div>   
        
         <!-- Color -->
         <select class="browser-default custom-select form-control mb-4" name="txtcolor">
            <option value="<?= $datos[0]['color']?>" selected><?= $datos[0]['color']?></option>
            <option value="btn-default">Cian</option>
            <option value="btn-secondary">Lila</option>
            <option value="btn-success">Verde</option>
            <option value="btn-info">Celeste</option>
            <option value="btn-warnig">Amarillo</option>
            <option value="btn-danger">Rojo</option>
            <option value="btn-unique">Rojo Carmesí</option>
            <option value="btn-pink">Rosa</option>
            <option value="btn-deep-orange">Naranja</option>
            <option value="btn-elegant">Negro</option>
            <option value="btn-blue-grey">Gris</option>
            <option value="btn-amber">Ambar</option>
        </select>


        <!-- Imagen -->
        <div class="custom-file">
            <input type="file" class="custom-file-input" id="customFileLang" lang="es" name="imagen">
            <label class="custom-file-label" for="customFileLang"><?= $datos[0]['Imagen']?></label>
        </div>

        <!-- Sign up button -->
        <button class="btn btn-info my-4 btn-block" type="submit" name="submit">Actualizar</button>

    </form>

    <?PHP var_dump($datos[0])?>
    <!-- Default form register -->
</div>