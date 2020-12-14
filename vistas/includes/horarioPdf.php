<!-- <div class="container-fluid" style="margin-top: 100px !important;"> -->
    <h2 style="text-align: center;">HORARIO</h2>
    
    <table class="table table-striped table-responsive-md btn-table" style="margin-left: 20px;">

        <thead class="text-center" style="width: 300px;">
            <tr style="margin-bottom: 50px; background-color:black; color:mintcream">
                <th style="width: 100px;">Hora</th>
                <th style="width: 100px;">Lunes</th>
                <th style="width: 100px;">Martes</th>
                <th style="width: 100px;">Miercoles</th>
                <th style="width: 100px;">Jueves</th>
                <th style="width: 100px;">Viernes</th>
                <th style="width: 100px;">Sabado</th>
            </tr>
        </thead>

        <tbody style="text-align: center;">
            <?php 
                $contador = 0;
                $vacio = true;
                foreach ($horario as $d) :?>

                <!--Mostramos cada registro en una fila de la tabla-->
                <tr>
                    <td style="background-color:silver">
                        <?= $d?>
                    </td> 
                    <td style="background-color:cornflowerblue">
                        <?php foreach ($datos as $clase) :?>                      
                            <?php if ($clase["Dia"] == 'Lunes' && $clase['horaInicio'] == $d || $clase["Dia"] == 'Lunes' &&  $clase['horaFin'] > $d && $clase['horaInicio'] < $d || $clase["Dia"] == 'Lunes' &&  $clase['horaFin'] == $d) : ?>
                                        <?= $clase['nombre'] ?>
                            <?php  endif;?>
                        <?php endforeach;?> 
                    </td>
                

                    <td style="background-color:silver">
                        <?php foreach ($datos as $clase) :?>
                            <?php if ($clase["Dia"] == 'Martes' && $clase['horaInicio'] == $d || $clase["Dia"] == 'Martes' &&  $clase['horaFin'] > $d && $clase['horaInicio'] < $d || $clase["Dia"] == 'Martes' &&  $clase['horaFin'] == $d): ?>
                                    <?= $clase['nombre'] ?>
                            <?php endif;?> 
                        <?php endforeach;?>   
                    </td>
                

                    <td style="background-color:cornflowerblue">
                        <?php foreach ($datos as $clase) :?>
                            <?php if ($clase["Dia"] == 'Miercoles' && $clase['horaInicio'] == $d || $clase["Dia"] == 'Miercoles' &&  $clase['horaFin'] > $d && $clase['horaInicio'] < $d || $clase["Dia"] == 'Miercoles' &&  $clase['horaFin'] == $d) : ?>
                                    <?= $clase['nombre'] ?>
                            <?php endif;?> 
                        <?php endforeach;?>   
                    </td>

                    <td style="background-color:silver">
                        <?php foreach ($datos as $clase) :?>
                            <?php if ($clase["Dia"] == 'Jueves' && $clase['horaInicio'] == $d || $clase["Dia"] == 'Jueves' &&  $clase['horaFin'] > $d && $clase['horaInicio'] < $d || $clase["Dia"] == 'Jueves' &&  $clase['horaFin'] == $d) : ?>
                                    <?= $clase['nombre'] ?>
                            <?php endif;?> 
                        <?php endforeach;?>
                    </td>

                    <td style="background-color:cornflowerblue">
                        <?php foreach ($datos as $clase) :?>
                            <?php if ($clase["Dia"] == 'Viernes' && $clase['horaInicio'] == $d || $clase["Dia"] == 'Viernes' &&  $clase['horaFin'] > $d && $clase['horaInicio'] < $d || $clase["Dia"] == 'Viernes' &&  $clase['horaFin'] == $d) : ?>
                                    <?= $clase['nombre'] ?>
                            <?php endif;?> 
                        <?php endforeach;?>   
                    </td>

                    <td style="background-color:silver">
                        <?php foreach ($datos as $clase) :?>
                            <?php if ($clase["Dia"] == 'Sabado' && $clase['horaInicio'] == $d || $clase["Dia"] == 'Sabado' &&  $clase['horaFin'] > $d && $clase['horaInicio'] < $d || $clase["Dia"] == 'Sabado' &&  $clase['horaFin'] == $d) : ?>         
                                    <?= $clase['nombre'] ?>
                            <?php endif;?> 
                        <?php endforeach;?>   
                    </td>

                </tr>

            <?php $contador++; endforeach;?>
                    
        </tbody>

    </table>
    
<!-- </div> -->