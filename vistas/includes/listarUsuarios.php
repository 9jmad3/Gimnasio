
<div class="container-fluid mt-5" style="margin-top: 100px !important; height: 70vh;">
<H2 class="text-center pb-1">TODOS LOS USUARIOS</H2>
<!--Mostramos los mensajes que se hayan generado al realizar el listado-->

<?php if (isset($mensajes)) {
   foreach ($mensajes as $mensaje) : ?> 
    <div class="alert alert-<?= $mensaje["tipo"] ?>"><?= $mensaje["mensaje"] ?></div>
<?php endforeach;
}?>

<table id="dtBasicExample" class="table table-striped table-bordered table-sm" cellspacing="0" width="100%">
  <thead>
    <tr>
      <th class="th-sm">Id</th>
      <th class="th-sm">Usuario</th>
      <th class="th-sm">Nombre</th>
      <th class="th-sm">Primer apellido</th>
      <th class="th-sm">Segundo apellido</th>
      <th class="th-sm">Dni</th>
      <th class="th-sm">Email</th>
      <th class="th-sm">Telefono</th>
      <th class="th-sm">Direccion</th>
      <th class="th-sm">Rol</th>
      <th class="th-sm">Imagen</th>
      <th class="th-sm">OPERACIONES</tr>
  </thead>
  <tbody>

  <?php foreach ($datos as $d) : ?>
          <!--Mostramos cada registro en una fila de la tabla-->
          <tr>
            <td><?= $d["id"] ?></td>  
            <td><?= $d["usuario"] ?></td>
            <td><?= $d["nombre"] ?></td>
            <td><?= $d["apellido1"] ?></td>
            <td><?= $d["apellido2"] ?></td>
            <td><?= $d["nif"] ?></td>
            <td><?= $d["email"] ?></td>
            <td><?= $d["telefono"] ?></td>
            <td><?= $d["direccion"] ?></td>

            <?php if ($d["rol_id"] == 0) : ?>
              <td>Administrador</td>
            <?php elseif ($d["rol_id"] == 1) : ?>
              <td>Standard</td>
            <?php elseif ($d["rol_id"] == 2) : ?>
              <td></td>
            <?php endif; ?> 

            <?php if ($d["imagen"] !== NULL) : ?>
                <td><img src="fotos/<?= $d['imagen'] ?>" width="40" /></td>
              <?php else : ?>
                <td>----</td>
            <?php endif; ?>
            <!-- Enviamos a actuser.php, mediante GET, el id del registro que deseamos editar o eliminar: -->
            <td><a href="?controller=user&accion=actualizaruser&id=<?= $d['id'] ?>"><i class="fas fa-user-edit"></i> Editar </a><a href="?controller=user&accion=deluser&id=<?= $d['id'] ?>&vista=1"><i class="fas fa-trash-alt"></i> Eliminar</a></td>
          </tr>
    <?php endforeach; ?>
</table>
</div>