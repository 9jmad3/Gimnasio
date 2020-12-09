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
         
         if ($datos['datos']['rol_id']!=2) {

            if ($resultado['correcto'] == TRUE) {


               
               //Implementación de la funcion recuerdame que guarda en usuario y contraseña en cookies. 
               if(isset($_POST['recuerdo']) && ($_POST['recuerdo']=="on"))            { // Creamos las cookies para ambas variables
                  setcookie('usuario',$usuario,time() + (15 * 24 * 60 * 60));
                  setcookie('password',$password,time() + (15 * 24 * 60 * 60));
                  setcookie('recuerdo',$_POST['recuerdo'],time() + (15 * 24 * 60 * 60));
              } else{ // Eliminamos las cookies vaciandolas
                  if(isset($_COOKIE['usuario'])) { setcookie('usuario',""); }
                  if(isset($_COOKIE['password'])){ setcookie('password',""); }
                  if(isset($_COOKIE['recuerdo'])){ setcookie('recuerdo',""); } 
              }

               $parametros['datos'] = $resultado['datos'];

               if ($parametros['datos'][0]['rol_id'] == 0) {
                  $parametros['pendientesActivacion']= $this->modelo->pendientesActivacion();

                  
                  $_SESSION['nombre'] = $parametros['datos'][0]['nombre'];
                  $_SESSION['perfilCompleto']=true;
                  
                  $this->view->show("paginaAdmin",$parametros);
               } 
               if($parametros['datos'][0]['rol_id'] == 1 || $parametros['datos'][0]['rol_id'] == 2){

                  $_SESSION['usuario'] = $usuario;

                  $this->view->show("paginaUsuario",$parametros);
               }

               $perfilCompleto = $this->modelo->perfilCompleto($_SESSION['usuario']);
               if (is_null($perfilCompleto['datos']['nif']) || is_null($perfilCompleto['datos']['nombre']) || is_null($perfilCompleto['datos']['apellido1']) || is_null($perfilCompleto['datos']['apellido2']) || is_null($perfilCompleto['datos']['telefono']) || is_null($perfilCompleto['datos']['direccion'])) {
                  $_SESSION['perfilCompleto'] = false;
                  $_SESSION['nombre'] = $perfilCompleto['datos']['nombre'];
                  $_SESSION['apellido1'] = $perfilCompleto['datos']['apellido1'];
                  $_SESSION['apellido2'] = $perfilCompleto['datos']['apellido2'];
                  $_SESSION['dni'] = $perfilCompleto['datos']['nif'];
                  $_SESSION['telefono'] = $perfilCompleto['datos']['telefono'];
                  $_SESSION['direccion'] = $perfilCompleto['datos']['direccion'];
               }else{
                  $_SESSION['perfilCompleto'] = true;
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
