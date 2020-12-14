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
      ];
      $this->view->show("Login", $parametros);
   }

   /**
    * Funcion que nos permite hacer login en la bbdd con un determinado usuario y asi darle paso a su pagina personal.
    */
   public function inUser()
   {
      // Array asociativo que almacenará los mensajes de error que se generen por cada campo
      $errores = array();

      //Si se ha pulsado el boton de enviar:
      if (isset($_POST['submit'])) {

         //Si usuario o password estan vacios:
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

         //Preguntamos por el usuario y contraseña a la bbdd
         $resultado = $this->modelo->inUser([
            'usuario' => $usuario,
            'password' => $password
         ]);
         
         //Creamos la sesion de usuario ya que al llegar hasta aqui, la consulta ha salido bien.
         $_SESSION['usuario'] = $usuario;

         //Preguntamos si el usuario esta validado pasando su nombre de usuario.
         $datos = $this->modelo->userValidado($usuario);

         //Guardamos su id y rol.
         $_SESSION['id'] = $datos['datos']['id'];
         $_SESSION['rol_id'] = $datos['datos']['rol_id'];

         
         //Si es distinto de 2 y por tanto esta validado:
         if ($_SESSION['rol_id']!=2) {
            
            //Si el usuario y contraseña son correctos:
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
               //Actualizamos las variables de sesion con toda la informacion del usuario.
               $_SESSION['nombre'] = $parametros['datos'][0]['nombre'];
               $_SESSION['apellido1'] = $parametros['datos'][0]['apellido1'];
               $_SESSION['apellido2'] = $parametros['datos'][0]['apellido2'];
               $_SESSION['dni'] = $parametros['datos'][0]['nif'];
               $_SESSION['telefono'] = $parametros['datos'][0]['telefono'];
               $_SESSION['direccion'] = $parametros['datos'][0]['direccion'];
               $_SESSION['imagen'] = $parametros['datos'][0]['imagen'];

               //Discriminamos entre roles para dar paso a una u otra parte de la pagina.
               if ($_SESSION['rol_id'] == 0) {
                  $this->view->show("paginaAdmin",$parametros);
               } 
               if($_SESSION['rol_id'] == 1){
                  $this->view->show("paginaUsuario",$parametros);
               }
            
            //Si el usuario y contraseña NO son correctos:
            } else {
               $this->mensajes[] = [
                  "tipo" => "danger",
                  "mensaje" => "Usuario o contraseña incorrectos"
               ];
               $parametros["mensajes"] = $this->mensajes;

               $this->view->show("Login",$parametros);
            }
         //Si el usuario no esta validado.
         }else{
            $this->mensajes[] = [
               "tipo" => "warning",
               "mensaje" => "Usuario no validado."
            ];
            $parametros["mensajes"] = $this->mensajes;

            $this->view->show("Login",$parametros);
         }
      
      //Si no se ha pulsado dl boton de submit:   
      }else {
         $this->view->show("Login");
      }    
      
   }
}
