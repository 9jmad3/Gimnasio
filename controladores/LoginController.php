<?php
session_start();
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
            $this->view->show("Login");
            //TODO: Poner alerta de campos vacios.
         }

         $usuario = $_POST['txtusuario'];
         $password = $_POST['txtpassword'];

         if (count($errores) == 0) {
            $resultado = $this->modelo->inUser([
               'usuario' => $usuario,
               'password' => $password
            ]);
         }

         if ($resultado['correcto'] == TRUE) {

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
               "tipo" => "success",
               "mensaje" => "Usuario o contraseña incorrectos"
            ];
            $parametros["mensajes"] = $this->mensajes;

            $this->view->show("Login",$parametros);
            //TODO: Poner alerta usuario o contraseña incorrectos
         }
         


      }else {
         $this->view->show("Login");
      }    
      
   }
}
