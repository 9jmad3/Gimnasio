<?php
session_start();
/**
 * Controlador de la página index desde la que se puede hacer el login y el registro
 */

 /**
 * Incluimos todos los modelos que necesite este controlador
 */
require_once MODELS_FOLDER . 'UserModel.php';

class IndexController extends BaseController
{
   public function __construct()
   {
      parent::__construct();
      $this->modelo = new UserModel();
      $this->mensajes = [];
   }

   public function index()
   {
      $parametros = [
         "tituloventana" => "Login a la aplicación"
      ];
      $this->view->show("Inicio",$parametros);
   }

   /**
    * Podemos implementar la acción registro de usuarios
    *
    * @return void
    */
   public function register()
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

         $_SESSION['nombre'] = $nombre;
         $_SESSION['apellido1'] = $apellido1;
         $_SESSION['apellido2'] = $apellido2;
         $_SESSION['dni'] = $dni;
         $_SESSION['telefono'] = $telefono;
         $_SESSION['direccion'] = $direccion;
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
            $_SESSION['nombre'] = null;
         }

         if (!preg_match("/^\d{8}[a-zA-Z]{1}$/", $dni)) {
            $this->mensajes[] = [
               "campo" => "dni",
               "tipo" => "danger",
               "mensaje" => "Dni no valido."
            ];
            $errores["nombre"] = "Error: No valido";
            $parametros = ["mensajes" => $this->mensajes];
            $_SESSION['dni'] = null;
         }

         if (!preg_match("/^[6-7]{1}[0-9]{8}$/", $telefono) && !preg_match("/^[8-9]{1}[0-9]{8}$/", $telefono)) {
            $this->mensajes[] = [
               "campo" => "telefono",
               "tipo" => "danger",
               "mensaje" => "Solo fijos nacionales o moviles."
            ];
            $errores["nombre"] = "Error: No valido";
            $parametros = ["mensajes" => $this->mensajes];
            $_SESSION['telefono'] = null;
         }

         if (!preg_match("/[a-zA-Z0-9_]{1,100}/", $direccion)) {
            $this->mensajes[] = [
               "campo" => "direccion",
               "tipo" => "danger",
               "mensaje" => "Nombre no valido."
            ];
            $errores["nombre"] = "Error: No valido";
            $parametros = ["mensajes" => $this->mensajes];
            $_SESSION['direccion'] = null;
         }
         
         if (count($errores) > 0) {$this->view->show("completarPerfil",$parametros);}
 

         // Si no se han producido errores realizamos el registro del usuario
         if (count($errores) == 0) {
            $resultModelo = $this->modelo->actuser([
               'nombre' => $nombre,
               "apellido1" => $apellido1,
               'apellido2' => $apellido2,
               'dni' => $dni,
               'direccion' => $direccion,
               'telefono' => $telefono
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
      }

      $parametros = [
         "tituloventana" => "Base de Datos con PHP y PDO",
         "datos" => [
            "txtnombre" => isset($nombre) ? $nombre : "",
            "txtpass" => isset($password) ? $password : "",
            "txtemail" => isset($email) ? $email : "",
            "imagen" => isset($imagen) ? $imagen : ""
         ],
         "mensajes" => $this->mensajes
      ];
      //Visualizamos la vista asociada al registro de usuarios
      $nulo = null;
      $perfilCompleto = $this->modelo->perfilCompleto($nulo);

      if (is_null($perfilCompleto['datos']['nif']) || is_null($perfilCompleto['datos']['nombre']) || is_null($perfilCompleto['datos']['apellido1']) || is_null($perfilCompleto['datos']['apellido2']) || is_null($perfilCompleto['datos']['telefono']) || is_null($perfilCompleto['datos']['direccion'])) {
         $_SESSION['perfilCompleto'] = false;
         $this->view->show("completarPerfil",$parametros);
      }else{
         $this->mensajes[] = [
            "campo" => "nuevoUsuario",
            "tipo" => "warning",
            "mensaje" => "Un administrador validará tu perfil."
         ];
         $errores["nombre"] = "Error: No valido";
         $parametros = ["mensajes" => $this->mensajes];
         $_SESSION['perfilCompleto'] = true;
         $this->view->show("paginaUsuario",$parametros);
      }
      
      
   }

   /**
    * Otras acciones que puedan ser necesarias
    */

    public function listarHorario()
   {
      // Almacenamos en el array 'parametros[]'los valores que vamos a mostrar en la vista
      $parametros = [
         "tituloventana" => "Base de Datos con PHP y PDO",
         "datos" => NULL,
         "mensajes" => [],
         "horario" => ["07:00", "07:15", "07:30", "07:45", "08:00", "08:15", "08:30", "8:45", "09:00", "09:15", "09:30","09:45", "10:00", "10:30", "10:45", "11:00", "11:15","11:30" , "11:45", "12:00", "12:15", "12:30" , "12:45", "13:00", "13:15", "13:30", "13:45", "14:00", "14:15", "14:30", "14:45", "15:00", "15:15", "15:30", "15:45", "16:00", "16:15", "16:30", "16:45", "17:00", "17:15","17:30", "17:45", "18:00", "18:15","18:30", "18:45", "19:00", "19:15","19:30", "19:45","20:00", "20:15","20:30","20:45", "21:00", "21:15", "21:30", "21:45", "22:00", "22:15", "22:30", "22:45", "23:00"]
      ];
      // Realizamos la consulta y almacenamos los resultados en la variable $resultModelo
      $resultModelo = $this->modelo->listadoClases();
      // Si la consulta se realizó correctamente transferimos los datos obtenidos
      // de la consulta del modelo ($resultModelo["datos"]) a nuestro array parámetros
      // ($parametros["datos"]), que será el que le pasaremos a la vista para visualizarlos
      if ($resultModelo["correcto"]) :

         foreach ($resultModelo["datos"] as $key => $value) {
            $horas[$key] = $value['horaInicio'];
         }

         array_multisort($horas, SORT_ASC, $resultModelo["datos"]);

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
      $this->view->show("ListarClases", $parametros);
   }

   public function listarInscripciones()
   {
      // Almacenamos en el array 'parametros[]'los valores que vamos a mostrar en la vista
      $parametros = [
         "tituloventana" => "Base de Datos con PHP y PDO",
         "datos" => NULL,
         "mensajes" => []
      ];
      // Realizamos la consulta y almacenamos los resultados en la variable $resultModelo
      $resultModelo = $this->modelo->listadoInscripciones();
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


      $this->view->show("ListarClasesInscritas", $parametros);
   }

   public function borrarInscripcion()
   {
      // Almacenamos en el array 'parametros[]'los valores que vamos a mostrar en la vista
      $parametros = [
         "tituloventana" => "Base de Datos con PHP y PDO",
         "datos" => NULL,
         "mensajes" => []
      ];
      $id = $_GET['id'];
  
      // Realizamos la consulta y almacenamos los resultados en la variable $resultModelo
      $resultModelo = $this->modelo->borrarInscripcion($id);
      // Si la consulta se realizó correctamente transferimos los datos obtenidos
      // de la consulta del modelo ($resultModelo["datos"]) a nuestro array parámetros
      // ($parametros["datos"]), que será el que le pasaremos a la vista para visualizarlos
      if ($resultModelo["correcto"]) :
         $parametros["datos"] = $resultModelo["datos"];
         //Definimos el mensaje para el alert de la vista de que todo fue correctamente
         $this->mensajes[] = [
            "tipo" => "success",
            "mensaje" => "Operacion realizada correctamente"
         ];
      else :
         //Definimos el mensaje para el alert de la vista de que se produjeron errores al realizar el listado
         $this->mensajes[] = [
            "tipo" => "danger",
            "mensaje" => "No se ha podido borrar!! :( <br/>({$resultModelo["error"]})"
         ];
      endif;
      //Asignamos al campo 'mensajes' del array de parámetros el valor del atributo 
      //'mensaje', que recoge cómo finalizó la operación:
      $parametros["mensajes"] = $this->mensajes;
      // Incluimos la vista en la que visualizaremos los datos o un mensaje de error


      $this->view->show("ListarClasesInscritas", $parametros);
   }
}
