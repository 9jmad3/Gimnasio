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
            <?php 
                $contador = 0;
                $vacio = true;
                foreach ($horario as $d) :?>

                <!--Mostramos cada registro en una fila de la tabla-->
                <tr>
                    <td>
                        <?= $d?>
                    </td> 
                    <td>
                        <?php foreach ($datos as $clase) :?>
                            <?php if ($clase["Dia"] == 'Lunes' && $clase['horaInicio'] == $d) : ?>
                                <?php if ($clase['idClase'] == 1) : ?>
                                    <a href="?controller=user&accion=editarUsuario&usuario=<?= $datos[$contador]['id'] ?>">
                                        <button type="button" class="btn btn-indigo btn-sm m-0">BodyPump</button>
                                    </a>
                                <?php elseif ($clase["idClase"] == 2) : ?>
                                    <a href="?controller=user&accion=editarUsuario&usuario=<?= $datos[$contador]['id'] ?>">
                                        <button type="button" class="btn btn-danger btn-sm m-0">BodyCombat</button>
                                    </a>
                                <?php elseif ($clase['idClase'] == 3) : ?>
                                    <a href="?controller=user&accion=editarUsuario&usuario=<?= $datos[$contador]['id'] ?>">
                                        <button type="button" class="btn btn-dark-green btn-sm m-0">BodyAttack</button>
                                    </a>
                                <?php elseif ($clase["idClase"] == 4) : ?>
                                    <a href="?controller=user&accion=editarUsuario&usuario=<?= $datos[$contador]['id'] ?>">
                                        <button type="button" class="btn btn-pink btn-sm m-0">Yoga</button>
                                    </a>
                                <?php elseif ($clase["idClase"] == 5) : ?>
                                    <a href="?controller=user&accion=editarUsuario&usuario=<?= $datos[$contador]['id'] ?>">
                                        <button type="button" class="btn btn-light-blue btn-sm m-0">Cycling</button>
                                    </a>
                                <?php endif; $vacio = false;?> 
                            <?php  endif; ?> 
                        <?php endforeach;?> 

                        <?php if ($vacio) : ?>
                            Sin clases
                        <?php endif; $vacio = true;?>
                    </td>
                

                    <td>
                        <?php foreach ($datos as $clase) :?>
                            <?php if ($clase["Dia"] == 'Martes' && $clase['horaInicio'] == $d) : ?>
                        
                                <?php if ($clase["idClase"] == 1) : ?>
                                    <a href="?controller=user&accion=editarUsuario&usuario=<?= $datos[$contador]['id'] ?>">
                                        <button type="button" class="btn btn-indigo btn-sm m-0">BodyPump</button>
                                    </a>
                                <?php elseif ($clase["idClase"] == 2) : ?>
                                    <a href="?controller=user&accion=editarUsuario&usuario=<?= $datos[$contador]['id'] ?>">
                                        <button type="button" class="btn btn-danger btn-sm m-0">BodyCombat</button>
                                    </a>
                                <?php elseif ($clase["idClase"] == 3) : ?>
                                    <a href="?controller=user&accion=editarUsuario&usuario=<?= $datos[$contador]['id'] ?>">
                                        <button type="button" class="btn btn-dark-green btn-sm m-0">BodyAttack</button>
                                    </a>
                                <?php elseif ($clase["idClase"] == 4) : ?>
                                    <a href="?controller=user&accion=editarUsuario&usuario=<?= $datos[$contador]['id'] ?>">
                                        <button type="button" class="btn btn-pink btn-sm m-0">Yoga</button>
                                    </a>
                                <?php elseif ($clase["idClase"] == 5) : ?>
                                    <a href="?controller=user&accion=editarUsuario&usuario=<?= $datos[$contador]['id'] ?>">
                                        <button type="button" class="btn btn-light-blue btn-sm m-0">Cycling</button>
                                    </a>
                                <?php endif; $vacio = false; ?> 
                            <?php endif; ?> 
                        <?php endforeach;?>   

                        <?php if ($vacio) : ?>
                            Sin clases
                        <?php endif; $vacio = true; ?>
                    </td>
                

                    <td>
                        <?php foreach ($datos as $clase) :?>
                            <?php if ($clase["Dia"] == 'Miercoles' && $clase['horaInicio'] == $d) : ?>
                                <?php if ($clase["idClase"] == 1) : ?>
                                    <a href="?controller=user&accion=editarUsuario&usuario=<?= $datos[$contador]['id'] ?>">
                                        <button type="button" class="btn btn-indigo btn-sm m-0">BodyPump</button>
                                    </a>
                                <?php elseif ($clase["idClase"] == 2) : ?>
                                    <a href="?controller=user&accion=editarUsuario&usuario=<?= $datos[$contador]['id'] ?>">
                                        <button type="button" class="btn btn-danger btn-sm m-0">BodyCombat</button>
                                    </a>
                                <?php elseif ($clase["idClase"] == 3) : ?>
                                    <a href="?controller=user&accion=editarUsuario&usuario=<?= $datos[$contador]['id'] ?>">
                                        <button type="button" class="btn btn-dark-green btn-sm m-0">BodyAttack</button>
                                    </a>
                                <?php elseif ($clase["idClase"] == 4) : ?>
                                    <a href="?controller=user&accion=editarUsuario&usuario=<?= $datos[$contador]['id'] ?>">
                                        <button type="button" class="btn btn-pink btn-sm m-0">Yoga</button>
                                    </a>
                                <?php elseif ($clase["idClase"] == 5) : ?>
                                    <a href="?controller=user&accion=editarUsuario&usuario=<?= $datos[$contador]['id'] ?>">
                                        <button type="button" class="btn btn-light-blue btn-sm m-0">Cycling</button>
                                    </a>
                                <?php endif; $vacio = false; ?> 
                            <?php endif; ?> 
                        <?php endforeach;?>   

                        <?php if ($vacio) : ?>
                            Sin clases
                        <?php endif; $vacio = true; ?>
                    </td>

                    <td>
                        <?php foreach ($datos as $clase) :?>
                            <?php if ($clase["Dia"] == 'Jueves' && $clase['horaInicio'] == $d) : ?>
                                <?php if ($clase["idClase"] == 1) : ?>
                                    <a href="?controller=user&accion=editarUsuario&usuario=<?= $datos[$contador]['id'] ?>">
                                        <button type="button" class="btn btn-indigo btn-sm m-0">BodyPump</button>
                                    </a>
                                <?php elseif ($clase["idClase"] == 2) : ?>
                                    <a href="?controller=user&accion=editarUsuario&usuario=<?= $datos[$contador]['id'] ?>">
                                        <button type="button" class="btn btn-danger btn-sm m-0">BodyCombat</button>
                                    </a>
                                <?php elseif ($clase["idClase"] == 3) : ?>
                                    <a href="?controller=user&accion=editarUsuario&usuario=<?= $datos[$contador]['id'] ?>">
                                        <button type="button" class="btn btn-dark-green btn-sm m-0">BodyAttack</button>
                                    </a>
                                <?php elseif ($clase["idClase"] == 4) : ?>
                                    <a href="?controller=user&accion=editarUsuario&usuario=<?= $datos[$contador]['id'] ?>">
                                        <button type="button" class="btn btn-pink btn-sm m-0">Yoga</button>
                                    </a>
                                <?php elseif ($clase["idClase"] == 5) : ?>
                                    <a href="?controller=user&accion=editarUsuario&usuario=<?= $datos[$contador]['id'] ?>">
                                        <button type="button" class="btn btn-light-blue btn-sm m-0">Cycling</button>
                                    </a>
                                <?php endif; $vacio = false; ?> 
                            <?php endif; ?> 
                        <?php endforeach;?>   

                        <?php if ($vacio) : ?>
                            Sin clases
                        <?php endif; $vacio = true; ?>
                    </td>

                    <td>
                        <?php foreach ($datos as $clase) :?>
                            <?php if ($clase["Dia"] == 'Viernes' && $clase['horaInicio'] == $d) : ?>
                                <?php if ($clase["idClase"] == 1) : ?>
                                    <a href="?controller=user&accion=editarUsuario&usuario=<?= $datos[$contador]['id'] ?>">
                                        <button type="button" class="btn btn-indigo btn-sm m-0">BodyPump</button>
                                    </a>
                                <?php elseif ($clase["idClase"] == 2) : ?>
                                    <a href="?controller=user&accion=editarUsuario&usuario=<?= $datos[$contador]['id'] ?>">
                                        <button type="button" class="btn btn-danger btn-sm m-0">BodyCombat</button>
                                    </a>
                                <?php elseif ($clase["idClase"] == 3) : ?>
                                    <a href="?controller=user&accion=editarUsuario&usuario=<?= $datos[$contador]['id'] ?>">
                                        <button type="button" class="btn btn-dark-green btn-sm m-0">BodyAttack</button>
                                    </a>
                                <?php elseif ($clase["idClase"] == 4) : ?>
                                    <a href="?controller=user&accion=editarUsuario&usuario=<?= $datos[$contador]['id'] ?>">
                                        <button type="button" class="btn btn-pink btn-sm m-0">Yoga</button>
                                    </a>
                                <?php elseif ($clase["idClase"] == 5) : ?>
                                    <a href="?controller=user&accion=editarUsuario&usuario=<?= $datos[$contador]['id'] ?>">
                                        <button type="button" class="btn btn-light-blue btn-sm m-0">Cycling</button>
                                    </a>
                                <?php endif; $vacio = false; ?> 
                            <?php endif; ?> 
                        <?php endforeach;?>   

                        <?php if ($vacio) : ?>
                            Sin clases
                        <?php endif; $vacio = true; ?>
                    </td>

                </tr>

                             
                
            <?php $contador++; endforeach;?>
                    
        </tbody>

    </table>
    
</div>