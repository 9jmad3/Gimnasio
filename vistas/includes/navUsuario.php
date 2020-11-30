<!-- Navbar -->
<nav class="navbar fixed-top navbar-expand-lg navbar-dark scrolling-navbar unique-color-dark">
    <div class="container">

      <!-- Brand -->
      <a class="navbar-brand" href="?controller=Index&accion=index">
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
          <li class="nav-item "> 
          <!-- active -->
            <a class="nav-link" href="#">Ver horario
            <span class="sr-only">(current)</span>
            </a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink" data-toggle="dropdown"
              aria-haspopup="true" aria-expanded="false">Clases dirigidas</a>
            <div class="dropdown-menu dropdown-primary" aria-labelledby="navbarDropdownMenuLink">
              <a class="dropdown-item" href="?controller=User&accion=listaUsuarios">Nueva inscripcion</a>
              <a class="dropdown-item" href="?controller=User&accion=listaUsuariosNoValidados">Cancelar inscripcion</a>
              <a class="dropdown-item disabled" href="#">Inscripciones activas</a>
            </div>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#location">Mensajes</a>
          </li>
        </ul>

        <!-- Right -->
        <ul class="navbar-nav nav-flex-icons">
          <li class="nav-item">
            <a class="nav-link disabled" href="#location"><?php echo"".$_SESSION['nombre'].""?></a>
          </li>
          <li class="nav-item avatar dropdown">
        <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink-55" data-toggle="dropdown"
          aria-haspopup="true" aria-expanded="false">
          <img src="https://mdbootstrap.com/img/Photos/Avatars/avatar-2.jpg" class="rounded-circle z-depth-0"
            alt="avatar image" style="max-width: 40px !important;">
        </a>
        <div class="dropdown-menu dropdown-menu-lg-right dropdown-secondary"
          aria-labelledby="navbarDropdownMenuLink-55">
          <a class="dropdown-item" href="?controller=User&accion=completarPerfil">Editar perfil</a>
          <a class="dropdown-item" href="#">Cerrar sesion</a>
        </div>
      </li>
        </ul>

      </div>

    </div>
</nav>
<!-- Navbar -->