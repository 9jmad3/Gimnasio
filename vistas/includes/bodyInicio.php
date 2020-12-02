  <!-- Full Page Intro -->
  <div class="view full-page-intro" style="background-image: url('img/fondoPrincipal.jpg'); background-repeat: no-repeat; background-size: cover;">

    <!-- Mask & flexbox options-->
    <div class="mask rgba-black-light d-flex justify-content-center align-items-center">

      <!-- Content -->
      <div class="container">

        <!--Grid row-->
        <div class="row wow fadeIn">

          <!--Grid column-->
          <div class="col-md-6 mb-4 white-text text-center text-md-left">

            <h1 class="display-4 font-weight-bold">¡Únete al equipo!</h1>

            <hr class="hr-light">

            <p>
              <strong>Registrate para acceder a toda la información.</strong>
            </p>

            <p class="mb-4 d-none d-md-block">
              <strong>Después de que te validemos como usuario tendrás tu propio sitio y accederás a opciones internas para socios.</strong>
            </p>

            <a href="#ventajas" class="btn btn-indigo btn-lg">Más información</a>

          </div>
          <!--Grid column-->

          <!--Grid column-->
          <div class="col-md-6 col-xl-5 mb-4">

            <!--Card-->
            <div class="card">

              <!--Card content-->
              <div class="card-body">

                <!-- Form -->
                <form name="" action="?controller=User&accion=adduser" id="formRegistro" method="post">
                  <!-- Heading -->
                  <h3 class="dark-grey-text text-center">
                    <strong>Registro</strong>
                  </h3>
                  <hr>
                  <?php if (isset($mensajes)) {
                      foreach ($mensajes as $mensaje) : 
                        if ($mensaje["campo"] == "nuevoUsuario") {?>                         
                          <div class="alert alert-<?= $mensaje["tipo"] ?>"><?= $mensaje["mensaje"] ?></div>
                    <?php } endforeach;
                    }?>

                  <div class="md-form">
                    <i class="fas fa-user prefix grey-text"></i>
                    <input type="text" id="form3" class="form-control" name="txtusuario">
                    <label for="form3">Usuario</label>

                    <?php if (isset($mensajes)) {
                      foreach ($mensajes as $mensaje) : 
                        if ($mensaje["campo"] == "usuario") {?>                         
                          <div class="alert alert-<?= $mensaje["tipo"] ?>"><?= $mensaje["mensaje"] ?></div>
                    <?php } endforeach;
                    }?>
                  </div>

                  <div class="md-form">
                    <i class="fas fa-envelope prefix grey-text"></i>
                    <input type="text" id="form2" class="form-control" name="txtemail">
                    <label for="form2">Email</label>

                    <?php if (isset($mensajes)) {
                      foreach ($mensajes as $mensaje) : 
                        if ($mensaje["campo"] == "email") {?>                         
                          <div class="alert alert-<?= $mensaje["tipo"] ?>"><?= $mensaje["mensaje"] ?></div>
                    <?php } endforeach;
                    }?>
                  </div>

                  <div class="md-form">
                    <i class="fas fa-key prefix grey-text"></i>
                    <input type="password" id="password" class="form-control" name="txtpassword">
                    <label for="password">Contraseña</label>

                    <?php if (isset($mensajes)) {
                      foreach ($mensajes as $mensaje) : 
                        if ($mensaje["campo"] == "password") {?>                         
                          <div class="alert alert-<?= $mensaje["tipo"] ?>"><?= $mensaje["mensaje"] ?></div>
                    <?php } endforeach;
                    }?>
                  </div>
                  
                  <div class="md-form pl-5">
                    <div class="g-recaptcha" data-sitekey="6LfRLfYZAAAAAFtXRmQEdD2jCV8KBjlt-TgZxI5I"></div>
                  </div>

                  <div class="md-form text-center">
                    <button class="btn btn-indigo" type="submit"  name="submit">Enviar</button>
                  </div>                    
                </form>
                <!-- Form -->

              </div>

            </div>
            <!--/.Card-->

          </div>
          <!--Grid column-->

        </div>
        <!--Grid row-->

      </div>
      <!-- Content -->

    </div>
    <!-- Mask & flexbox options-->

  </div>
  <!-- Full Page Intro -->

  <!--Main layout-->
  <main>
    <div class="container">

      <!--Section: Main features & Quick Start-->
      <section class="mt-5 wow fadeIn">

        <h3 class="h3 text-center mb-5" id="online">Entrenamiento online</h3>

        <!--Grid row-->
        <div class="row wow fadeIn">

          <!--Grid column-->
          <div class="col-lg-6 col-md-12 px-4">

            <!--First row-->
            <div class="row">
              <div class="col-1 mr-3">
                <i class="fas fa-running fa-2x indigo-text"></i>
              </div>
              <div class="col-10">
                <h5 class="feature-title">Distintas disciplinas</h5>
                <p class="grey-text">Ciclo, BodyCombat, BodyPump, GAP entre otras.</p>
              </div>
            </div>
            <!--/First row-->

            <div style="height:30px"></div>

            <!--Second row-->
            <div class="row">
              <div class="col-1 mr-3">
                <i class="fab fa-youtube fa-2x blue-text"></i>
              </div>
              <div class="col-10">
                <h5 class="feature-title">En directo y bajo demanda</h5>
                <p class="grey-text">Conectate en directo a la clase o hazla cuando quieras visitando los videos.
                </p>
              </div>
            </div>
            <!--/Second row-->

            <div style="height:30px"></div>

            <!--Third row-->
            <div class="row">
              <div class="col-1 mr-3">
                <i class="fas fa-comments fa-2x cyan-text"></i>
              </div>
              <div class="col-10">
                <h5 class="feature-title">Interacción</h5>
                <p class="grey-text">Deja comentarios y el monitor o monitora resolverá tu duda</p>
              </div>
            </div>
            <!--/Third row-->

          </div>
          <!--/Grid column-->

          <!--Grid column-->
          <div class="col-lg-6 col-md-12">

            <p class="h5 text-center mb-4">Clases online exclusivas para usuarios registrados</p>
            <div class="embed-responsive embed-responsive-16by9">
              <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/RmW1zElrkO0" allowfullscreen></iframe>
            </div>
          </div>
          <!--/Grid column-->

        </div>
        <!--/Grid row-->

      </section>
      <!--Section: Main features & Quick Start-->

      <hr class="my-5" id="ventajas">

      <!--Section: Not enough-->
      <section>

        <h2 class="my-5 h3 text-center">Ventajas de ser un usuario registrado</h2>

        <!--First row-->
        <div class="row features-small mb-5 mt-3 wow fadeIn">

          <!--First column-->
          <div class="col-md-4">
            <!--First row-->
            <div class="row">
              <div class="col-2">
                <i class="fas fa-check-circle fa-2x indigo-text"></i>
              </div>
              <div class="col-10">
                <h6 class="feature-title">Horario de clases</h6>
                <p class="grey-text">Podrás ver todas las clases disponibles en la semana actual.
                </p>
                <div style="height:15px"></div>
              </div>
            </div>
            <!--/First row-->

            <!--Second row-->
            <div class="row">
              <div class="col-2">
                <i class="fas fa-check-circle fa-2x indigo-text"></i>
              </div>
              <div class="col-10">
                <h6 class="feature-title">Reserva de clases</h6>
                <p class="grey-text">Solo podrás entrar en clases dirigidas previa reserva gratuita.
                </p>
                <div style="height:15px"></div>
              </div>
            </div>
            <!--/Second row-->

          </div>
          <!--/First column-->

          <!--Second column-->
          <div class="col-md-4 flex-center">
            <img src="img/ventajasBanner.png" alt="MDB Magazine Template displayed on iPhone" class="z-depth-0 img-fluid">
          </div>
          <!--/Second column-->

          <!--Third column-->
          <div class="col-md-4 mt-2">
            
            <!--First row-->
            <div class="row">
                <div class="col-2">
                  <i class="fas fa-check-circle fa-2x indigo-text"></i>
                </div>
                <div class="col-10">
                  <h6 class="feature-title">Historial</h6>
                  <p class="grey-text">Accede a todas las clases a las que has asistido.</p>
                  <div style="height:15px"></div>
                </div>
              </div>
              <!--/First row-->

              <!--Second row-->
              <div class="row">
                <div class="col-2">
                  <i class="fas fa-check-circle fa-2x indigo-text"></i>
                </div>
                <div class="col-10">
                  <h6 class="feature-title">Social</h6>
                  <p class="grey-text">Personaliza tu perfil</p>
                  <div style="height:15px"></div>
                </div>
              </div>
              <!--/Second row-->

            
          </div>
          <!--/Third column-->

        </div>
        <!--/First row-->

      </section>
      <!--Section: Not enough-->

      <hr class="my-5" id="location">

      <!-- Section: Location -->
      <section>

        <h2 class="my-5 h3 text-center">Donde estamos</h2>

        <!--Google map-->
        <div id="map-container" class="z-depth-1-half map-container" style="height: 300px">
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d793.7649713897918!2d-6.918387270781877!3d37.270006998740904!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xd11c555b4d5ed6d%3A0x97c525d71ab5734a!2sCalle%20Fedatario%20Miguel%20Ferre%20Molt%C3%B3%2C%2021007%20Huelva%2C%20Espa%C3%B1a!5e0!3m2!1ses!2sus!4v1604918068387!5m2!1ses!2sus" width="100%" height="100%" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
        </div>
      </section>
      <!-- Section: Location -->

    <hr class="my-5" id="contact">

    <!-- Section: Contacto -->
    <section class="mb-5">
        <h2 class="my-5 h3 text-center">Contacto</h2>

        <!--Modal: Contact form-->
        <div class=" cascading-modal" role="document">

          <!--Content-->
          <div class="modal-content">

            <!--Body-->
            <div class="modal-body">

              <!-- Material input name -->
              <div class="md-form form-sm">
                <i class="fa fa-envelope prefix indigo-text"></i>
                <input type="text" id="materialFormNameModalEx1" class="form-control form-control-sm">
                <label for="materialFormNameModalEx1">Nombre</label>
              </div>

              <!-- Material input email -->
              <div class="md-form form-sm">
                <i class="fa fa-lock prefix indigo-text"></i>
                <input type="password" id="materialFormEmailModalEx1" class="form-control form-control-sm">
                <label for="materialFormEmailModalEx1">Email</label>
              </div>

              <!-- Material input subject -->
              <div class="md-form form-sm">
                <i class="fa fa-mail-bulk prefix indigo-text"></i>
                <input type="text" id="materialFormSubjectModalEx1" class="form-control form-control-sm">
                <label for="materialFormSubjectModalEx1">Asunto</label>
              </div>

              <!-- Material textarea message -->
              <div class="md-form form-sm">
                <i class="fa fa-pencil-alt prefix indigo-text"></i>
                <textarea type="text" id="materialFormMessageModalEx1"
                  class="md-textarea form-control"></textarea>
                <label for="materialFormMessageModalEx1">Mensaje</label>
              </div>

              <div class="text-center mt-4 mb-2">
                <button class="btn btn-indigo btn-lg">Enviar
                  <i class="fa fa-send ml-2"></i>
                </button>
              </div>

            </div>
          </div>
          <!--/.Content-->
        </div>
        <!--/Modal: Contact form-->
    </section>
    <!-- Section: Contacto -->


    </div>
  </main>
  <!--Main layout-->