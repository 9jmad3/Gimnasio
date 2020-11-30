<div class="container py-5 my-5" style="margin-top: 100px !important; height: 75vh !important;">
      <!-- ALERTAS-->
      <form class="text-center border border-light p-5 w-50 bg-white rounded-lg" action="?controller=Login&accion=inUser" id="login" method="post">
    <?php if (isset($mensajes)) {
          foreach ($mensajes as $mensaje) : ?> 
            <div class="alert alert-<?= $mensaje["tipo"] ?>"><?= $mensaje["mensaje"] ?></div>
        <?php endforeach;
    }?>
    <!-- ALERTAS-->
  <section class="p-md-5 mx-md-5 text-center text-lg-left grey z-depth-1"
    style="background-image: url(https://mdbootstrap.com/img/Photos/Others/background2.jpg);">
    <div class="row d-flex justify-content-center">
      <div class="col-md-10">
        <div class="card">
          <div class="card-body m-3">
            <div class="row">
              <div class="col-lg-4 d-flex mb-2 align-items-center">
                <div class="avatar mx-4 w-100 white d-flex justify-content-center align-items-center">
                  <img src="https://mdbootstrap.com/img/Photos/Avatars/img%20%2810%29.jpg" class="rounded-circle img-fluid z-depth-1" alt="woman avatar">
                </div>
              </div>
              <div class="col-lg-8">
              <form class="text-center" action="#!">
    

            <div class="form-row mb-4">
            <div class="col">
                <!-- First name -->
                <input type="text" id="defaultRegisterFormFirstName" class="form-control" placeholder="First name">
            </div>
            </div>

            <!-- E-mail -->
            <input type="email" id="defaultRegisterFormEmail" class="form-control mb-4" placeholder="E-mail">

            <!-- Sign up button -->
            <button class="btn btn-info my-4 btn-block" type="submit">Actualizar</button>
        </form>  



              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>