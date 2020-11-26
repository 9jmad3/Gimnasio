<!-- Navbar -->
<nav class="navbar fixed-top navbar-expand-lg navbar-dark scrolling-navbar unique-color-dark">
    <div class="container">

      <!-- Brand -->
      <a class="navbar-brand" href="?controller=Index&accion=index">
        <strong>ADMINISTRACION</strong>
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
            <a class="nav-link" href="#">Modificar horario
            <span class="sr-only">(current)</span>
            </a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink" data-toggle="dropdown"
              aria-haspopup="true" aria-expanded="false">Operaciones con usuarios</a>
            <div class="dropdown-menu dropdown-primary" aria-labelledby="navbarDropdownMenuLink">
              <a class="dropdown-item" href="?controller=User&accion=listaUsuarios">Listar</a>
              <a class="dropdown-item" href="#">No validados</a>
              <a class="dropdown-item disabled" href="#">Disabled</a>
            </div>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#location">Alta de usuarios</a>
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
          <a class="nav-link" href="#">Salir
          </li>
        </ul>

      </div>

    </div>
</nav>
<!-- Navbar -->