
<div class="container mt-5" style="margin-top: 100px !important; height: 70vh;">

<!--Mostramos los mensajes que se hayan generado al realizar el listado-->

<?php if (isset($mensajes)) {
   foreach ($mensajes as $mensaje) : ?> 
    <div class="alert alert-<?= $mensaje["tipo"] ?>"><?= $mensaje["mensaje"] ?></div>
<?php endforeach;
}?>

<table id="dtBasicExample" class="table table-striped table-bordered table-sm" cellspacing="0" width="100%">
  <thead>
    <tr>
      <th class="th-sm">Nombre

      </th>
      <th class="th-sm">Email

      </th>
      <th class="th-sm">Rol

      </th>
      <th class="th-sm">Imagen

      </th>
      <th class="th-sm">OPERACIONES
    </tr>
  </thead>
  <tbody>

  <?php foreach ($datos as $d) : ?>
          <!--Mostramos cada registro en una fila de la tabla-->
          <tr>  
            <td><?= $d["nombre"] ?></td>
            <!--<td><?= $d["password"] ?></td>-->
            <td><?= $d["email"] ?></td>
            <td>Deshabilitado</td>
            <?php if ($d["imagen"] !== NULL) : ?>
              <td><img src="fotos/<?= $d['imagen'] ?>" width="40" /></td>
            <?php else : ?>
              <td>----</td>
            <?php endif; ?>
            <!-- Enviamos a actuser.php, mediante GET, el id del registro que deseamos editar o eliminar: -->
            <td><a href="?controller=user&accion=acceptUser&id=<?= $d['id'] ?>"><i class="fas fa-user-check"></i> Aceptar </a><a href="?controller=user&accion=deluser&id=<?= $d['id'] ?>"><i class="fas fa-trash-alt"></i> Eliminar</a></td>
          </tr>
    <?php endforeach; ?>
</table>
</div>