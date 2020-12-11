<?php
session_start();
/**
 * Incluimos los modelos que necesite este controlador
 */
require_once MODELS_FOLDER . 'UserModel.php';

/**
 * Clase controlador que será la encargada de obtener, para cada tarea, los datos
 * necesarios de la base de datos, y posteriormente, tras su proceso de elaboración,
 * enviarlos a la vista para su visualización
 */
class UserController extends BaseController
{
   // El atributo $modelo es de la 'clase modelo' y será a través del que podremos 
   // acceder a los datos y las operaciones de la base de datos desde el controlador
   private $modelo;
   //$mensajes se utiliza para almacenar los mensajes generados en las tareas, 
   //que serán posteriormente transmitidos a la vista para su visualización
   private $mensajes;

   /**
    * Constructor que crea automáticamente un objeto modelo en el controlador e
    * inicializa los mensajes a vacío
    */
   public function __construct()
   {
      parent::__construct();
      $this->modelo = new UserModel();
      $this->mensajes = [];
   }

   /**
    * Método que obtiene de la base de datos el listado de usuarios y envía dicha
    * infomación a la vista correspondiente para su visualización
    */
   public function listado()
   {
      // Almacenamos en el array 'parametros[]'los valores que vamos a mostrar en la vista
      $parametros = [
         "tituloventana" => "Base de Datos con PHP y PDO",
         "datos" => NULL,
         "mensajes" => []
      ];
      // Realizamos la consulta y almacenamos los resultados en la variable $resultModelo
      $resultModelo = $this->modelo->listado();
      // Si la consulta se realizó correctamente transferimos los datos obtenidos
      // de la consulta del modelo ($resultModelo["datos"]) a nuestro array parámetros
      // ($parametros["datos"]), que será el que le pasaremos a la vista para visualizarlos
      if ($resultModelo["correcto"]) :
         $parametros["datos"] = $resultModelo["datos"];
         //Definimos el mensaje para el alert de la vista de que todo fue correctamente
         $this->mensajes[] = [
            "tipo" => "success",
            "mensaje" => "El listado se realizó correctamente"
         ];
      else :
         //Definimos el mensaje para el alert de la vista de que se produjeron errores al realizar el listado
         $this->mensajes[] = [
            "tipo" => "danger",
            "mensaje" => "El listado no pudo realizarse correctamente!! :( <br/>({$resultModelo["error"]})"
         ];
      endif;
      //Asignamos al campo 'mensajes' del array de parámetros el valor del atributo 
      //'mensaje', que recoge cómo finalizó la operación:
      $parametros["mensajes"] = $this->mensajes;
      // Incluimos la vista en la que visualizaremos los datos o un mensaje de error
      $this->view->show("ListadoUser", $parametros);
   }

   /**
    * Metodo que se usa para cargar los datos de un usuario especifico para que el administrador pueda editarlos.
    */
   public function editarUsuario()
   {  
      // Array asociativo que almacenará los mensajes de error que se generen por cada campo
      $errores = array();
      // Inicializamos valores de los campos de texto
      $valnombre = "";
      $valemail = "";
      $valimagen = "";

      $parametros['datos'] = $this->modelo->perfilCompleto($_GET['usuario']);     
      $this->view->show("editarUsuario",$parametros);
   }

   /**
    * Método de la clase controlador que realiza la eliminación de un usuario a 
    * través del campo id
    */
   public function deluser()
   {
      // verificamos que hemos recibido los parámetros desde la vista de listado 
      if (isset($_GET['id']) && (is_numeric($_GET['id']))) {
         $id = $_GET["id"];
         //Realizamos la operación de suprimir el usuario con el id=$id
         $resultModelo = $this->modelo->deluser($id);
         //Analizamos el valor devuelto por el modelo para definir el mensaje a 
         //mostrar en la vista listado
         if ($resultModelo["correcto"]) :
            $this->mensajes[] = [
               "tipo" => "success",
               "mensaje" => "Se eliminó correctamente el usuario $id"
            ];
         else :
            $this->mensajes[] = [
               "tipo" => "danger",
               "mensaje" => "La eliminación del usuario no se realizó correctamente!! :( <br/>({$resultModelo["error"]})"
            ];
         endif;
      } else { //Si no recibimos el valor del parámetro $id generamos el mensaje indicativo:
         $this->mensajes[] = [
            "tipo" => "danger",
            "mensaje" => "No se pudo acceder al id del usuario a eliminar!! :("
         ];
      }

      if ($_GET['vista'] == 1) {
         $this->listaUsuarios();
      } else {
         $this->listaUsuariosNoValidados();
      }
      
   }

   public function delMensaje()
   {
      // verificamos que hemos recibido los parámetros desde la vista de listado 
      if (isset($_GET['id']) && (is_numeric($_GET['id']))) {
         $id = $_GET["id"];
         //Realizamos la operación de suprimir el mensaje con el id=$id
         $resultModelo = $this->modelo->delMensaje($id);
             
      } else { //Si no recibimos el valor del parámetro $id generamos el mensaje indicativo:
         $this->mensajes[] = [
            "tipo" => "danger",
            "mensaje" => "ERROR al borrar."
         ];
      }

      $this->view->show("paginaMensajes");
   }

   /**
    * Método de la clase controlador que realiza la inserción en la bdbb de un usuario con los tres campos basicos. usuario, password y email.
    * TERMINADO / FUNCIONADO CORRECTAMENTE
    */
   public function adduser()
   {

      $errores = array();
      //CAPTCHA
      $secret = "6LfRLfYZAAAAAPCGrD5YeHyQaCQd-JJ-VnlVhNKp";
      $response = null;
      // comprueba la clave secreta
      $reCaptcha = new ReCaptcha($secret);
     
      if ($_POST["g-recaptcha-response"]) {
          $response = $reCaptcha->verifyResponse(
          $_SERVER["REMOTE_ADDR"],
          $_POST["g-recaptcha-response"]
          );
       }
      
     
      if ($response != null && $response->success) {
         // Array asociativo que almacenará los mensajes de error que se generen por cada campo
      
            // Si se ha pulsado el botón guardar...
            if (isset($_POST) && !empty($_POST) && isset($_POST['submit'])) { // y hemos recibido las variables del formulario y éstas no están vacías...
               $usuario = filter_var($_POST['txtusuario'],FILTER_SANITIZE_STRING);
               $password = $_POST['txtpassword']; //sha1();
               $email = filter_var($_POST['txtemail'],FILTER_SANITIZE_STRING);

               //Si no se cumple la expresión regular se genera un error especifico.
               if (!preg_match("/^[a-z0-9ü][a-z0-9ü_]{3,9}$/", $usuario)) {
                  $this->mensajes[] = [
                     "campo" => "usuario",
                     "tipo" => "danger",
                     "mensaje" => "Usuario no valido. Caracteres alfanumericos de 3 a 9 veces."
                  ];
                  $errores["email"] = "Error: No valido";
                  $parametros = ["mensajes" => $this->mensajes];
               }
               //Si no se cumple la expresión regular se genera un error especifico.
               if (!preg_match("/^[^@]+@[^@]+\.[a-zA-Z]{2,}$/", $email)) {
                  $this->mensajes[] = [
                     "campo" => "email",
                     "tipo" => "danger",
                     "mensaje" => "Email no valido"
                  ];
                  $errores["email"] = "Error: No valido";
                  $parametros = ["mensajes" => $this->mensajes];
               }
               //Si no se cumple la expresión regular se genera un error especifico.
               if (!preg_match("/^(?=\w*\d)(?=\w*[A-Z])(?=\w*[a-z])\S{8,16}$/", $password)) {
                  $this->mensajes[] = [
                     "campo" => "password",
                     "tipo" => "danger",
                     "mensaje" => "Contraseña no valida Ej: 0aRaprueba"
                  ];
                  $errores["password"] = "Error: No valido";
                  $parametros = ["mensajes" => $this->mensajes];  
               }
               //Si se ha generado algún error se retorna al inicio pasando el/los errores pertinentes.
               if (count($errores) > 0) {$this->view->show("inicio",$parametros);}

               // Si no se han producido errores realizamos el registro del usuario
               if (count($errores) == 0) {
                  $resultModelo = $this->modelo->adduser([
                     'usuario' => $usuario,
                     "password" => $password,
                     'email' => $email
                  ]);
                     if ($resultModelo["correcto"]){
                        $this->mensajes[] = [
                           "tipo" => "success",
                           "mensaje" => "El usuarios se registró correctamente!! :)"
                        ];
                     }else{
                           //Si se ha retornado un error con el campo email ya existente se genera el mensaje para mostrar al usuario.
                           if (strpos($resultModelo['error'], "email")) {
                              $this->mensajes[] = [
                                 "campo" => "email",
                                 "tipo" => "danger",
                                 "mensaje" => "Email asociado a cuenta existente"
                              ];
                              $errores["email"] = "Error: Email ya existe";
                              $parametros = ["mensajes" => $this->mensajes];
                           }
                           //Si se ha retornado un error con el campo usuario ya existente se genera el mensaje para mostrar al usuario.
                           if (strpos($resultModelo['error'], "usuario")) {
                              $this->mensajes[] = [
                                 "campo" => "usuario",
                                 "tipo" => "danger",
                                 "mensaje" => "Nombre de usuario en uso"
                              ];
                              $errores["usuario"] = "Error: Usuario ya existe";
                              $parametros = ["mensajes" => $this->mensajes];
                           }
                           //Retornamos errores a la vista principal.
                           $this->view->show("inicio",$parametros);
                        };
               } 
            }

            if (count($errores) == 0){
               $_SESSION['usuario'] = $usuario;

               // $parametros = [
               //    "tituloventana" => "Base de Datos con PHP y PDO",
               //    "datos" => [
               //       "txtusuario" => isset($usuario) ? $usuario : "",
               //       "txtpass" => isset($password) ? $password : "",
               //       "txtemail" => isset($email) ? $email : ""
               //    ],
               //    "mensajes" => $this->mensajes
               // ];
               //Visualizamos la vista asociada al registro de usuarios
               $this->mensajes[] = [
                  "campo" => "nuevoUsuario",
                  "tipo" => "warning",
                  "mensaje" => "Un administrador validará tu perfil."
               ];
               $errores["nombre"] = "Error: No valido";
               $parametros = ["mensajes" => $this->mensajes];
               $_SESSION['perfilCompleto'] = true;
               $this->view->show("inicio",$parametros);
            }
      } else {
         // Si el código no es válido, lanzamos mensaje de error al usuario
         $this->mensajes[] = [
            "campo" => "captcha",
            "tipo" => "danger",
            "mensaje" => "No aceptamos robots."
         ];
         $errores["email"] = "Error: No valido";
         $parametros = ["mensajes" => $this->mensajes];
         $this->view->show("inicio",$parametros);
      }   
   }

   /**
    * Método de la clase controlador que permite actualizar al administrador los datos del usuario
    * cuyo id coincide con el que se pasa como parámetro desde la vista de listado
    * a través de GET
    */
   public function actuser()
   {
      // Array asociativo que almacenará los mensajes de error que se generen por cada campo
      $errores = array();
      // Si se ha pulsado el botón guardar...
      if (isset($_POST) && !empty($_POST) && isset($_POST['submit'])) { // y hemos recibido las variables del formulario y éstas no están vacías...
         $nombre = filter_var($_POST['txtnombre'],FILTER_SANITIZE_STRING);
         $apellido1 = filter_var($_POST['txtapellido1'],FILTER_SANITIZE_STRING); //sha1();
         $apellido2 = filter_var($_POST['txtapellido2'],FILTER_SANITIZE_STRING);
         $dni = filter_var($_POST['txtdni'],FILTER_SANITIZE_STRING);
         $direccion = filter_var($_POST['txtdireccion'],FILTER_SANITIZE_STRING);
         $telefono = filter_var($_POST['txttelefono'],FILTER_SANITIZE_STRING);

         /* Realizamos la carga de la imagen en el servidor */
         //       Comprobamos que el campo tmp_name tiene un valor asignado para asegurar que hemos
         //       recibido la imagen correctamente
         //       Definimos la variable $imagen que almacenará el nombre de imagen 
         //       que almacenará la Base de Datos inicializada a NULL
         $imagen = NULL;

         if (isset($_FILES["imagen"]) && (!empty($_FILES["imagen"]["tmp_name"]))) {
            // Verificamos la carga de la imagen
            // Comprobamos si existe el directorio fotos, y si no, lo creamos
            if (!is_dir("fotos")) {
               $dir = mkdir("fotos", 0777, true);
            } else {
               $dir = true;
            }
            // Ya verificado que la carpeta uploads existe movemos el fichero seleccionado a dicha carpeta
            if ($dir) {
               //Para asegurarnos que el nombre va a ser único...
               $nombrefichimg = time() . "-" . $_FILES["imagen"]["name"];
               // Movemos el fichero de la carpeta temportal a la nuestra
               $movfichimg = move_uploaded_file($_FILES["imagen"]["tmp_name"], "fotos/" . $nombrefichimg);
               $imagen = $nombrefichimg;
               // Verficamos que la carga se ha realizado correctamente
               if ($movfichimg) {
                  $imagencargada = true;
               } else {
                  $imagencargada = false;
                  $this->mensajes[] = [
                     "tipo" => "danger",
                     "mensaje" => "Error: La imagen no se cargó correctamente! :("
                  ];
                  $errores["imagen"] = "Error: La imagen no se cargó correctamente! :(";
               }
            }
         }

         //Si no se cumple la expresión regular se genera un error especifico.
         if (!preg_match("/^[a-zA-Z]{1,50}$/", $nombre)) {
            $this->mensajes[] = [
               "campo" => "nombre",
               "tipo" => "danger",
               "mensaje" => "Nombre no valido."
            ];
            $errores["nombre"] = "Error: No valido";
            $parametros = ["mensajes" => $this->mensajes];
         }

         if (!preg_match("/^\d{8}[a-zA-Z]{1}$/", $dni)) {
            $this->mensajes[] = [
               "campo" => "dni",
               "tipo" => "danger",
               "mensaje" => "Dni no valido."
            ];
            $errores["nombre"] = "Error: No valido";
            $parametros = ["mensajes" => $this->mensajes];
         }

         if (!preg_match("/^[6-7]{1}[0-9]{8}$/", $telefono) && !preg_match("/^[8-9]{1}[0-9]{8}$/", $telefono)) {
            $this->mensajes[] = [
               "campo" => "telefono",
               "tipo" => "danger",
               "mensaje" => "Solo fijos nacionales o moviles."
            ];
            $errores["nombre"] = "Error: No valido";
            $parametros = ["mensajes" => $this->mensajes];
         }

         if (!preg_match("/[a-zA-Z0-9_]{1,100}/", $direccion)) {
            $this->mensajes[] = [
               "campo" => "direccion",
               "tipo" => "danger",
               "mensaje" => "Nombre no valido."
            ];
            $errores["nombre"] = "Error: No valido";
            $parametros = ["mensajes" => $this->mensajes];
         }
         
         if (count($errores) > 0) {$this->view->show("editarUsuario",$parametros);}
 
         // Si no se han producido errores realizamos el registro del usuario
         if (count($errores) == 0) {

            $resultModelo = $this->modelo->actuser([
               'nombre' => $nombre,
               "apellido1" => $apellido1,
               'apellido2' => $apellido2,
               'dni' => $dni,
               'direccion' => $direccion,
               'telefono' => $telefono,
               'usuario' => $_GET['usuario'] //Parametro opcional depende del metodo que haya ejecutado este.
            ]);

            if ($resultModelo["correcto"]) :
               $this->mensajes[] = [
                  "tipo" => "success",
                  "mensaje" => "El usuarios se registró correctamente!! :)"
               ];
            else :
               $this->mensajes[] = [
                  "tipo" => "danger",
                  "mensaje" => "El usuario no pudo registrarse!! :( <br />({$resultModelo["error"]})"
               ];
            endif;
         } else {
            $this->mensajes[] = [
               "tipo" => "danger",
               "mensaje" => "Datos de registro de usuario erróneos!! :("
            ];
         }

         //$this->view->show("editarUsuario",$parametros);
         $this->listaUsuarios();
      }
   }

   public function listaUsuarios()
   {
       // Almacenamos en el array 'parametros[]'los valores que vamos a mostrar en la vista
       $parametros = [
         "tituloventana" => "Base de Datos con PHP y PDO",
         "datos" => NULL,
         "mensajes" => []
      ];
      // Realizamos la consulta y almacenamos los resultados en la variable $resultModelo
      $resultModelo = $this->modelo->listado();
      // Si la consulta se realizó correctamente transferimos los datos obtenidos
      // de la consulta del modelo ($resultModelo["datos"]) a nuestro array parámetros
      // ($parametros["datos"]), que será el que le pasaremos a la vista para visualizarlos
      if ($resultModelo["correcto"]) :
         $parametros["datos"] = $resultModelo["datos"];
         //Definimos el mensaje para el alert de la vista de que todo fue correctamente
         $this->mensajes[] = [
            "tipo" => "success",
            "mensaje" => "El listado se realizó correctamente"
         ];
      else :
         //Definimos el mensaje para el alert de la vista de que se produjeron errores al realizar el listado
         $this->mensajes[] = [
            "tipo" => "danger",
            "mensaje" => "El listado no pudo realizarse correctamente!! :( <br/>({$resultModelo["error"]})"
         ];
      endif;
      //Asignamos al campo 'mensajes' del array de parámetros el valor del atributo 
      //'mensaje', que recoge cómo finalizó la operación:
      $parametros["mensajes"] = $this->mensajes;
      // Incluimos la vista en la que visualizaremos los datos o un mensaje de error
      $this->view->show("ListarUsuarios", $parametros);
   }

   public function listaUsuariosNoValidados()
   {
      // Almacenamos en el array 'parametros[]'los valores que vamos a mostrar en la vista
      $parametros = [
         "tituloventana" => "Base de Datos con PHP y PDO",
         "datos" => NULL,
         "mensajes" => []
      ];
      // Realizamos la consulta y almacenamos los resultados en la variable $resultModelo
      $resultModelo = $this->modelo->listadoNoValidados();
      // Si la consulta se realizó correctamente transferimos los datos obtenidos
      // de la consulta del modelo ($resultModelo["datos"]) a nuestro array parámetros
      // ($parametros["datos"]), que será el que le pasaremos a la vista para visualizarlos
      if ($resultModelo["correcto"]) :
         $parametros["datos"] = $resultModelo["datos"];
         //Definimos el mensaje para el alert de la vista de que todo fue correctamente
         $this->mensajes[] = [
            "tipo" => "success",
            "mensaje" => "Operación realizada correctamente"
         ];
      else :
         //Definimos el mensaje para el alert de la vista de que se produjeron errores al realizar el listado
         $this->mensajes[] = [
            "tipo" => "danger",
            "mensaje" => "El listado no pudo realizarse correctamente!! :( <br/>({$resultModelo["error"]})"
         ];
      endif;
      //Asignamos al campo 'mensajes' del array de parámetros el valor del atributo 
      //'mensaje', que recoge cómo finalizó la operación:
      $parametros["mensajes"] = $this->mensajes;
      // Incluimos la vista en la que visualizaremos los datos o un mensaje de error
      $this->view->show("ListarUsuariosNoValidados", $parametros);
   }

   public function editPerfilAdmin()
   {
      // Almacenamos en el array 'parametros[]'los valores que vamos a mostrar en la vista
      $parametros = [
         "tituloventana" => "Base de Datos con PHP y PDO",
         "datos" => NULL,
         "mensajes" => []
      ];

      $this->view->show("EditarPerfilAdmin", $parametros);
   }
   
   public function cerrarSesion()
   {
      session_destroy();
      $this->view->show("inicio");
   }

   public function completarPerfil()
   {
      $this->view->show("completarPerfil");
   }

   public function actualizaruser()
   {
      $parametros = [
         "tituloventana" => "Base de Datos con PHP y PDO",
         "datos" => NULL,
         "mensajes" => []
      ];

      $datos = [];
      $datos['id'] = $_GET['id'];
      $datos['rol_id'] = $_GET['rol_id'];

      
      $this->modelo->actualizaruser($datos);

      
      $this->listaUsuariosNoValidados();
   }

   public function mensajes()
   {
       // Almacenamos en el array 'parametros[]'los valores que vamos a mostrar en la vista
       $parametros = [
         "tituloventana" => "Base de Datos con PHP y PDO",
         "datos" => NULL,
         "mensajes" => []
      ];
      // Realizamos la consulta y almacenamos los resultados en la variable $resultModelo
      $resultModelo = $this->modelo->listadoMensajes();
      // Si la consulta se realizó correctamente transferimos los datos obtenidos
      // de la consulta del modelo ($resultModelo["datos"]) a nuestro array parámetros
      // ($parametros["datos"]), que será el que le pasaremos a la vista para visualizarlos
      if ($resultModelo["correcto"]) :
         $parametros["datos"] = $resultModelo["datos"];
         //Definimos el mensaje para el alert de la vista de que todo fue correctamente
         $this->mensajes[] = [
            "tipo" => "success",
            "mensaje" => "El listado se realizó correctamente"
         ];
      else :
         //Definimos el mensaje para el alert de la vista de que se produjeron errores al realizar el listado
         $this->mensajes[] = [
            "tipo" => "danger",
            "mensaje" => "El listado no pudo realizarse correctamente!! :( <br/>({$resultModelo["error"]})"
         ];
      endif;
      //Asignamos al campo 'mensajes' del array de parámetros el valor del atributo 
      //'mensaje', que recoge cómo finalizó la operación:
      $parametros["mensajes"] = $this->mensajes;
      // Incluimos la vista en la que visualizaremos los datos o un mensaje de error
      $this->view->show("paginaMensajes", $parametros);
   }
}
