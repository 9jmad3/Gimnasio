    <!-- CONTENIDO -->
    <div class="container my-5 z-depth-1">
        <!--Section: Content-->
        <section class="dark-grey-text">

            <div class="row pr-lg-5">
            <div class="col-md-7 mb-4">

                <div class="view">
                <img src="https://mdbootstrap.com/img/illustrations/graphics(4).png" class="img-fluid" alt="smaple image">
                </div>

            </div>
            <div class="col-md-5 d-flex align-items-center">
                <div>
                
                <h3 class="font-weight-bold mb-4"> Bienvenido 
                    <?php if(isset($_COOKIE['abierta'])){
                        echo"'" .$_COOKIE['abierta']. "'" ;
                    } else{ 
                        echo"'" . $_SESSION['logueado']. "'" ;} ?>
                </h3>

                    <p>Esta es la pagina personal Uno.</p>

                    <a href="frmPaginaDos.php"><button type="button" class="btn btn-primary btn-rounded mx-0">Ir a pagina dos</button></a>

                    <a href="includes/logout.php"><button type="button" class="btn btn-warning btn-rounded mx-0">Cerrar sesion</button></a>

                </div>
            </div>
            </div>

        </section>
        <!--Section: Content-->
    </div>

