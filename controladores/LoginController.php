<?php
/**
 * Incluimos los modelos que necesite este controlador
 */
require_once MODELS_FOLDER . 'UserModel.php';

/**
 * Controlador de la página de Login desde la cual se puede acceder a tu perfil
 */
class LoginController extends BaseController
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
      $this->view->show("Login", $parametros);
   }

   public function inUser()
   {
      // Array asociativo que almacenará los mensajes de error que se generen por cada campo
      $errores = array();

      if (isset($_POST['submit'])) {
         if (empty( $_POST['txtusuario']) || empty($_POST['txtpassword'])) {
            
            $this->mensajes[] = [
               "tipo" => "danger",
               "mensaje" => "¿No tienes cuenta? Necesitas registrarte"
            ];
            $parametros["mensajes"] = $this->mensajes;

            $this->view->show("Login",$parametros);
         }

         $usuario = $_POST['txtusuario'];
         $password = $_POST['txtpassword'];

         if (count($errores) == 0) {
            $resultado = $this->modelo->inUser([
               'usuario' => $usuario,
               'password' => $password
            ]);
         }
         $_SESSION['usuario'] = $usuario;

         $datos = $this->modelo->userValidado($usuario);
         $_SESSION['id'] = $datos['datos']['id'];
         $_SESSION['rol_id'] = $datos['datos']['rol_id'];

         
         
         if ($_SESSION['rol_id']!=2) {
            
            if ($resultado['correcto'] == TRUE) {

               //Implementación de la funcion recuerdame que guarda en usuario y contraseña en cookies. 
               if(isset($_POST['recuerdo']) && ($_POST['recuerdo']=="on")){ // Creamos las cookies para ambas variables
                  setcookie('usuario',$usuario,time() + (15 * 24 * 60 * 60));
                  setcookie('password',$password,time() + (15 * 24 * 60 * 60));
                  setcookie('recuerdo',$_POST['recuerdo'],time() + (15 * 24 * 60 * 60));

               } else{ // Eliminamos las cookies vaciandolas
                  if(isset($_COOKIE['usuario'])) { setcookie('usuario',""); }
                  if(isset($_COOKIE['password'])){ setcookie('password',""); }
                  if(isset($_COOKIE['recuerdo'])){ setcookie('recuerdo',""); } 
               }

               $parametros['datos'] = $resultado['datos'];

               $_SESSION['nombre'] = $parametros['datos'][0]['nombre'];
               $_SESSION['apellido1'] = $parametros['datos'][0]['apellido1'];
               $_SESSION['apellido2'] = $parametros['datos'][0]['apellido2'];
               $_SESSION['dni'] = $parametros['datos'][0]['nif'];
               $_SESSION['telefono'] = $parametros['datos'][0]['telefono'];
               $_SESSION['direccion'] = $parametros['datos'][0]['direccion'];
               $_SESSION['imagen'] = $parametros['datos'][0]['imagen'];

               if ($_SESSION['rol_id'] == 0) {
                  $this->view->show("paginaAdmin",$parametros);
               } 
               if($_SESSION['rol_id'] == 1){
                  $this->view->show("paginaUsuario",$parametros);
               }
              
            } else {
               $this->mensajes[] = [
                  "tipo" => "danger",
                  "mensaje" => "Usuario o contraseña incorrectos"
               ];
               $parametros["mensajes"] = $this->mensajes;

               $this->view->show("Login",$parametros);
            }
         
         }else{
            $this->mensajes[] = [
               "tipo" => "warning",
               "mensaje" => "Usuario no validado."
            ];
            $parametros["mensajes"] = $this->mensajes;

            $this->view->show("Login",$parametros);
         }

      }else {
         $this->view->show("Login");
      }    
      
   }
}
