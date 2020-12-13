
<div class="container-fluid mt-5" style="margin-top: 100px !important;">
<H2 class="text-center pb-1">TODOS LOS USUARIOS</H2>
<!--Mostramos los mensajes que se hayan generado al realizar el listado-->

<?php if (isset($mensajes)) {
   foreach ($mensajes as $mensaje) : ?> 
    <div class="alert alert-<?= $mensaje["tipo"] ?>"><?= $mensaje["mensaje"] ?></div>
<?php endforeach;
}?>

<table id="dtBasicExample" class="table table-striped table-bordered table-sm " cellspacing="0" width="100%">
  <thead>
    <tr>
      <th class="th-sm">Id</th>
      <th class="th-sm">Nombre</th>
      <th class="th-sm text-center" colspan="2">OPERACIONES</tr>
  </thead>
  <tbody>

  <?php if(isset($datos))foreach ($datos as $d) : ?>
          <!--Mostramos cada registro en una fila de la tabla-->
          <tr>
            <td><?= $d["id"] ?></td>
            <td><?= $d["nombre"] ?></td>

            <!-- Enviamos a actuser.php, mediante GET, el id del registro que deseamos editar o eliminar: -->
            <td class="text-center">
              <a href="?controller=index&accion=editClase&id=<?= $d['id'] ?>">
                <i class="fas fa-user-edit"></i> Editar 
              </a>
            </td>
            <td class="text-center bg-danger">
              <a href="?controller=index&accion=delClase&id=<?= $d['id'] ?>">
                <i class="fas fa-trash-alt"></i> Eliminar
              </a>
            </td>
          </tr>
    <?php endforeach; ?>
</table>
</div>
