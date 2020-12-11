<div class="container-fluid" style="margin-top: 100px;">
    <div class="row">
        <div class="col">
            <table class="table text-center">
                <thead class="unique-color-dark white-text">
                    <tr>
                    <th scope="col">Remitente</th>
                    <th scope="col">Asunto</th>
                    <th scope="col">Fecha</th>
                    <th scope="col">Operaciones</th>
                    </tr>
                </thead>
                <tbody>


                <?php if(isset($datos)) foreach ($datos as $d) : ?>
                    <!--Mostramos cada registro en una fila de la tabla-->
                    <tr>
                        <td><?= $d["usuario"] ?></td>  
                        <td><?= $d["asunto"] ?></td>
                        <td><?= $d["fechaCreacion"] ?></td>
                        <td>
                            <button class="btn btn-outline-primary waves-effect rounded-pill" data-toggle="modal" data-target="#basicExampleModal<?= $d["id"] ?>"><i class="fas fa-eye"></i></button>

                            <!-- Modal -->
                            <div class="modal fade" id="basicExampleModal<?= $d["id"] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Mensaje</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">

                                        <!-- CONTENIDO DEL MENSAJE -->
                                        <?= $d["contenido"] ?>
                            
                                    
                                </div>
                                <div class="blue-gradient text-white">FitGym</div>
                                </div>
                            </div>
                            </div>
                            <a class="btn waves-effect rounded-pill btn btn-outline-danger" href="?controller=user&accion=delMensaje&id=<?= $d['id']?>"><i class="fas fa-trash-alt"></i></a>
                        </td>
                       </tr>
                <?php endforeach; ?>

                </tbody>
                </table>
        </div>

        <div class="col">
            <!-- Default form contact -->
            <form class="text-center border border-light p-5" action="#!">

            <p class="h4 mb-4">Enviar mensaje</p>

            <!-- Destinatario -->
            <input type="text" id="defaultContactFormName" class="form-control mb-4" placeholder="Usuario de destino">

            <!-- Asunto -->
            <input type="email" id="defaultContactFormEmail" class="form-control mb-4" placeholder="Asunto">

            <!-- Subject -->
            <!-- <label>Subject</label>
            <select class="browser-default custom-select mb-4">
                <option value="" disabled>Choose option</option>
                <option value="1" selected>Feedback</option>
                <option value="2">Report a bug</option>
                <option value="3">Feature request</option>
                <option value="4">Feature request</option>
            </select> -->

            <!-- Message -->
            <div class="form-group">
                <textarea class="form-control rounded-0" id="exampleFormControlTextarea2" rows="3" placeholder="Mensaje"></textarea>
            </div>

            <!-- Send button -->
            <button class="btn blue-gradient btn-block" type="submit">Enviar</button>

            </form>
            <!-- Default form contact -->
        </div>
    </div>
</div>