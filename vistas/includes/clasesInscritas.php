
<div class="container-fluid mt-5" style="margin-top: 100px !important;">
<H2 class="text-center pb-1">INSCRIPCIONES ACTIVAS</H2>
<!--Mostramos los mensajes que se hayan generado al realizar el listado-->

<?php if (isset($mensajes)) {
   foreach ($mensajes as $mensaje) : ?> 
    <div class="alert alert-<?= $mensaje["tipo"] ?>"><?= $mensaje["mensaje"] ?></div>
<?php endforeach;
}?>

<table id="dtBasicExample" class="table table-striped table-bordered table-sm" cellspacing="0" width="100%">
  <thead>
    <tr>
      <th class="th-sm">Id Clase</th>
      <th class="th-sm">Clase</th>
      <th class="th-sm">Dia</th>
      <th class="th-sm">Hora Inicio</th>
      <th class="th-sm">Hora Fin</th>
      <th class="th-sm">OPERACIONES</tr>
  </thead>
  <tbody>

  <?php foreach ($datos as $d) :?>
      
          <!--Mostramos cada registro en una fila de la tabla-->
          <tr>
            <td><?= $d["id"] ?></td>  
            <td><?= $d["nombre"]?></td>
            <td><?= $d["Dia"] ?></td>
            <td><?= $d["horaInicio"] ?></td>
            <td><?= $d["horaFin"] ?></td>

            <!-- Enviamos a actuser.php, mediante GET, el id del registro que deseamos editar o eliminar: -->
            <td><a href="?controller=index&accion=borrarInscripcion&id=<?= $d['id'] ?>"><i class="fas fa-trash-alt"></i> Eliminar</a></td>
          </tr>
    <?php endforeach; ?>

</table>
</div>
