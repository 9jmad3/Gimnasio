<div class="container my-5" style="height: 60vh;">


  <!-- Section: Block Content -->
  <section style="margin-top: 10% !important;">
    <h6 class="font-weight-bold text-center grey-text text-uppercase small mb-4">Admin</h6>
    <h3 class="font-weight-bold text-center dark-grey-text pb-2">Bienvenido</h3>
    <hr class="w-header my-4">
    <p class="lead text-center text-muted pt-2 mb-5">Recuerda modificar el horario si es necesario.</p>

    <div class="row white-text">

      <!-- Grid column -->
      <div class="col-xl-3 col-md-6 mb-4">
      </div>
      <!-- Grid column -->

      <!-- Grid column -->
      <div class="col-xl-6 col-md-12 mb-8">

        <!-- Card Blue -->
        <div class="card classic-admin-card light-blue lighten-1">
          <div class="card-body py-3">
            <i class="fas fa-chart-pie"></i>
            <p class="small">Usuarios pendientes de validacion</p>
            
            <h4><?php /*var_dump($pendientesActivacion);*/ 
            if($pendientesActivacion){echo"".$pendientesActivacion["count(*)"]."";}?></h4>
          </div>
         
        </div>
        <!-- Card Blue -->

      </div>
      <!-- Grid column -->

       <!-- Grid column -->
       <div class="col-xl-3 col-md-6 mb-4">
        </div>
        <!-- Grid column -->

    </div>

  </section>
  <!-- Section: Block Content -->
  

</div>