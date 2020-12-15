<div class="container" style="margin-top: 100px !important;">

    
    <?php if (isset($mensajes)){?> 
        <div class="alert alert-info"><?= $mensajes ?></div>
    <?php };?>

    <!-- Default form register -->
    <form class="text-center border border-light p-5" action="?controller=index&accion=insertarClaseExistente" method="post" enctype="multipart/form-data">

        <p class="h4 mb-4">INSERTAR NUEVA CLASE</p>
        <!-- idClase -->
        <select class="browser-default custom-select form-control mb-4" name="txtidclase">
            <?php if (isset($clases)) {
                foreach ($clases as $clase) : ?> 
                     <option selected value="<?php echo $clase['id'] ?>"><?php echo $clase['nombre'] ?></option>
                <?php endforeach;
            }?>
            <option selected value="-">Modalidad</option>
        </select>

        <!-- Dia -->
        <select class="browser-default custom-select form-control mb-4" name="txtDia">
            <option selected value="Lunes">Lunes</option>
            <option value="Martes">Martes</option>
            <option value="Miercoles">Miercoles</option>
            <option value="Jueves">Jueves</option>
            <option value="Viernes">Viernes</option>
            <option value="Sabado">Sabado</option>
        </select>

        <!-- horaInicio -->
        <select class="browser-default custom-select form-control mb-4" name="txtHoraInicio">
            <?php if (isset($horario)) {
                foreach ($horario as $hora) : ?> 
                     <option selected value="<?php echo $hora ?>"><?php echo $hora ?></option>
                <?php endforeach;
            }?>
            <option selected value="-">Hora inicio</option>
        </select>

        <!-- horaFin -->
        <select class="browser-default custom-select form-control mb-4" name="txtHoraFin">
            <?php if (isset($horario)) {
                foreach ($horario as $hora) : ?> 
                     <option selected value="<?php echo $hora ?>"><?php echo $hora ?></option>
                <?php endforeach;
            }?>
            <option selected value="-">Hora fin</option>
        </select>

        <!-- Sign up button -->
        <button class="btn btn-info my-4 btn-block" type="submit" name="submit">Actualizar</button>

    </form>
    <!-- Default form register -->

</div>