<div class="container-fluid" style="margin-top: 100px !important;">
    <h2 class="text-center m-3">INSCRIPCIÓN EN UN CLICK</h2>
    <table class="table table-striped table-responsive-md btn-table">

        <thead class="text-center">
            <tr>
                <th>Hora</th>
                <th>Lunes</th>
                <th>Martes</th>
                <th>Miercoles</th>
                <th>Jueves</th>
                <th>Viernes</th>
            </tr>
        </thead>

        <tbody class="text-center">
            <tr>
                <td>00:00</td><!-- <th scope="row">1</th> -->
                <td>Sin clases</td>
                <td>
                <button type="button" class="btn btn-indigo btn-sm m-0">BodyPump</button></a>
                </td>
                <td>Sin clases</td>
                <td>Sin clases</td>
                <td>Sin clases</td>
            </tr>

            <?php foreach ($datos as $d) : ?>
            <!--Mostramos cada registro en una fila de la tabla-->
            <tr>
                <?php if ($d["idClase"] == 1) : ?>
                    <td>
                        <a href="?controller=user&accion=editarUsuario&usuario=<?= $d['id'] ?>">
                            <button type="button" class="btn btn-indigo btn-sm m-0">BodyPump</button>
                        </a>
                    </td>
                <?php elseif ($d["idClase"] == 2) : ?>
                    <td>
                        <a href="?controller=user&accion=editarUsuario&usuario=<?= $d['id'] ?>">
                            <button type="button" class="btn btn-indigo btn-sm m-0">BodyCombat</button>
                        </a>
                    </td>
                <?php elseif ($d["idClase"] == 3) : ?>
                    <td>
                        <a href="?controller=user&accion=editarUsuario&usuario=<?= $d['id'] ?>">
                            <button type="button" class="btn btn-indigo btn-sm m-0">BodyAttack</button>
                        </a>
                    </td>
                <?php endif; ?> 
            </tr>
            <?php endforeach; ?>
    
        </tbody>

    </table>
</div>