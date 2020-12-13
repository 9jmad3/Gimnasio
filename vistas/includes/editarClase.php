<div class="container" style="margin-top: 100px !important;">
    <!-- Default form register -->
    <form class="text-center border border-light p-5" action="?controller=index&accion=editarClase&id=<?= $_GET['id'] ?>" method="post" enctype="multipart/form-data">

        <p class="h4 mb-4">EDITAR CLASE</p>

        <!-- Nombre -->
        <input type="text" id="defaultRegisterFormFirstName" class="form-control mb-4" placeholder="Nombre" name="txtnombre" value="">
       
        <!-- Tipo -->
        <select class="browser-default custom-select form-control mb-4" name="txttipo">
            <option selected>Seleccione un Tipo</option>
            <option value="Resistencia">Resistencia</option>
            <option value="Estiramiento">Estiramiento</option>
            <option value="Resistenca-Fuerza">Resistenca-Fuerza</option>
        </select>

        <!-- Descripcion -->
        <div class="form-group">
            <textarea class="form-control rounded-0" id="exampleFormControlTextarea2" name="txtdescripcion" rows="6" placeholder="Descripcion"></textarea>
        </div>   
        

        <P>IMPORTANTE: El archivo tiene que ser .jpg y tener el mismo nombre que la clase. Mayusculas incluidas.</P>
        <!-- Imagen -->
        <div class="custom-file">
            <input type="file" class="custom-file-input" id="customFileLang" lang="es" name="imagen">
            <label class="custom-file-label" for="customFileLang">Seleccionar Archivo</label>
        </div>

        <!-- Sign up button -->
        <button class="btn btn-info my-4 btn-block" type="submit" name="submit">Actualizar</button>

    </form>
    <!-- Default form register -->
</div>