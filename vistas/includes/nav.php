<!-- Navbar -->
<nav class="navbar fixed-top navbar-expand-lg navbar-dark scrolling-navbar unique-color-dark">
    <div class="container">

      <!-- Brand -->
      <a class="navbar-brand" href="?controller=Index&accion=index">
        <strong>FitGym</strong>
      </a>

      <!-- Collapse -->
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
        aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <!-- Links -->
      <div class="collapse navbar-collapse" id="navbarSupportedContent">

        <!-- Left -->
        <ul class="navbar-nav mr-auto">
          <li class="nav-item" <?php if($_SERVER['REQUEST_URI'] == "/gimnasio/index.php?controller=Login&accion=index")  echo"hidden"?>>
            <a class="nav-link" href="#online">Clases Online</a>
          </li>
          <li class="nav-item" <?php if($_SERVER['REQUEST_URI'] == "/gimnasio/index.php?controller=Login&accion=index")  echo"hidden"?>>
            <a class="nav-link" href="#location">Donde estamos</a>
          </li>
          <li class="nav-item" <?php if($_SERVER['REQUEST_URI'] == "/gimnasio/index.php?controller=Login&accion=index")  echo"hidden"?>>
            <a class="nav-link" href="#contact">Contacto</a>
          </li>
          <li class="nav-item" <?php if($_SERVER['REQUEST_URI'] == "/gimnasio/index.php?controller=Login&accion=index")  echo"hidden"?>>
            <a class="nav-link" href="?controller=index&accion=generarpdf">Descargar horario</a>
          </li>
        </ul>

        <!-- Right -->
        <ul class="navbar-nav nav-flex-icons">
          <!-- <li class="nav-item">
            <a href="https://twitter.com/MDBootstrap" class="nav-link" target="_blank">
              <i class="fab fa-twitter"></i>
            </a>
          </li> -->
          <li class="nav-item">
            <a href="?controller=Login&accion=index" class="nav-link border border-light rounded">
              <i class="fas fa-sign-in-alt mr-2"></i>Iniciar sesion
            </a>
          </li>
        </ul>

      </div>

    </div>
</nav>
<!-- Navbar -->