<!-- Navbar -->
<nav class="navbar fixed-top navbar-expand-lg navbar-dark scrolling-navbar unique-color-dark">
    <div class="container">

      <!-- Brand -->
      <a class="navbar-brand" href="?controller=Login&accion=inUser">
        <strong>Bienvenido</strong>
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
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink" data-toggle="dropdown"
              aria-haspopup="true" aria-expanded="false">Clases dirigidas</a>
            <div class="dropdown-menu dropdown-primary" aria-labelledby="navbarDropdownMenuLink">
              <a class="dropdown-item" href="?controller=index&accion=listarOferta">Oferta de clases</a>
              <a class="dropdown-item" href="?controller=index&accion=listarhorario">Horario</a>
              <a class="dropdown-item" href="?controller=index&accion=listarInscripciones">Inscripciones activas</a>
            </div>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="?controller=user&accion=mensajes">Mensajes</a>
          </li>
        </ul>

        <!-- Right -->
        <ul class="navbar-nav nav-flex-icons">
          <li class="nav-item">
            <a class="nav-link disabled" href="#location"><?php echo"".$_SESSION['usuario'].""?></a>
          </li>
          <li class="nav-item avatar dropdown">
        <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink-55" data-toggle="dropdown"
          aria-haspopup="true" aria-expanded="false">
          <img src="fotos/<?= $_SESSION['imagen'] ?>" class="rounded-circle z-depth-0"
            alt="avatar image" style="max-width: 40px !important;">
        </a>
        <div class="dropdown-menu dropdown-menu-lg-right dropdown-secondary"
          aria-labelledby="navbarDropdownMenuLink-55">
          <a class="dropdown-item" href="?controller=User&accion=completarPerfil">Editar perfil</a>
          <a class="dropdown-item" href="?controller=User&accion=cerrarSesion">Cerrar sesion</a>
        </div>
      </li>
        </ul>

      </div>
      
    </div>
</nav>
<!-- Navbar -->