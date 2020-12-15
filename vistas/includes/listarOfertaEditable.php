<div class="container mt-5" style="margin-top: 100px !important;">


  <!--Section: Content-->
  <section class="dark-grey-text">

    <!-- Section heading -->
    <h2 class="text-center font-weight-bold mb-4 pb-2">Edicion / Eliminación</h2>
    <!-- Section description -->
    <p class="text-center mx-auto w-responsive mb-5">La eliminación NO  es reversible</p>

    <?php if(isset($datos))foreach ($datos as $d) : ?>
        <!-- Grid row -->

        <div class="row align-items-center">

        <!-- Grid column -->
        <div class="col-lg-5 col-xl-4">

            <!-- Featured image -->
            <div class="view overlay rounded z-depth-1-half mb-lg-0 mb-4">
            <img class="img-fluid" src="img/ofertaClases/<?php echo $d["Imagen"]?>" alt="Sample image">
            <a>
                <div class="mask rgba-white-slight"></div>
            </a>
            </div>

        </div>
        <!-- Grid column -->

        <!-- Grid column -->
        <div class="col-lg-7 col-xl-8">

            <!-- Post title -->
            <h4 class="font-weight-bold mb-3"><strong><?= $d["nombre"] ?></strong></h4>
            <!-- Excerpt -->
            <p class="dark-grey-text"><?= $d["descripcion"] ?></p>
            <a href="?controller=index&accion=editClase&id=<?= $d['id'] ?>">
                <i class="fas fa-user-edit"></i> Editar 
            </a>
            <a href="?controller=index&accion=delClase&id=<?= $d['id'] ?>">
                <i class="fas fa-trash-alt"></i> Eliminar
            </a>
        </div>
        <!-- Grid column -->

        </div>
        <!-- Grid row -->

        <hr class="my-5">
    <?php endforeach; ?>    
  </section>
  <!--Section: Content-->


</div>