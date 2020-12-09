<?php
session_start();
/**
 *   Clase 'UserModel' que implementa el modelo de usuarios de nuestra aplicación en una
 * arquitectura MVC. Se encarga de gestionar el acceso a la tabla usuarios
 */
class UserModel extends BaseModel
{

   private $id;

   private $nombre;

   private $email;

   private $password;

   private $image;

   public function __construct()
   {
      // Se conecta a la BD
      parent::__construct();
      $this->table = "usuarios";  
   }

   public function getId()
   {
      return $this->id;
   }

   public function setId($id)
   {
      $this->id = $id;
   }

   public function getNombre()
   {
      return $this->nombre;
   }

   public function setNombre($nombre)
   {
      $this->nombre = $nombre;
   }

   public function getEmail()
   {
      return $this->email;
   }

   public function setEmail($email)
   {
      $this->email = $email;
   }

   public function getPassword()
   {
      return $this->password;
   }

   public function setPassword($password)
   {
      $this->password = $password;
   }

   public function getImage()
   {
      return $this->image;
   }

   public function setImage($image)
   {
      $this->image = $image;
   }

   /**
    * Función que realiza el listado de todos los usuarios registrados
    * Devuelve un array asociativo con tres campos:
    * -'correcto': indica si el listado se realizó correctamente o no.
    * -'datos': almacena todos los datos obtenidos de la consulta.
    * -'error': almacena el mensaje asociado a una situación errónea (excepción) 
    * @return type
    */
   public function listado()
   {
      $return = [
         "correcto" => FALSE,
         "datos" => NULL,
         "error" => NULL
      ];
      //Realizamos la consulta...
      try {  //Definimos la instrucción SQL  
         $sql = "SELECT * FROM usuarios";
         // Hacemos directamente la consulta al no tener parámetros
         $resultsquery = $this->db->query($sql);
         //Supervisamos si la inserción se realizó correctamente... 
         if ($resultsquery) :
            $return["correcto"] = TRUE;
            $return["datos"] = $resultsquery->fetchAll(PDO::FETCH_ASSOC);
         endif; // o no :(
      } catch (PDOException $ex) {
         $return["error"] = $ex->getMessage();
      }

      return $return;
   }

   public function listadoInscripciones()
   {
      $return = [
         "correcto" => FALSE,
         "datos" => NULL,
         "error" => NULL
      ];

      //Realizamos la consulta...
      try {  //Definimos la instrucción SQL  
         $sql = "SELECT clasesExistentes.idClase, clasesExistentes.id, idAlumno, horaInicio, horaFin, Dia, clasesExistentes.duracion FROM clasesExistentes 
                                                                                          JOIN asistenciaClases ON clasesExistentes.id = asistenciaClases.idClase 
                                                                                          JOIN clases ON asistenciaClases.idClase = clases.id 
                                                                                          WHERE idAlumno=:idAlumno";


         $query = $this->db->prepare($sql);
         // Hacemos directamente la consulta al no tener parámetros
         $query->execute(['idAlumno' => $_SESSION['id']]);
         //Supervisamos si la inserción se realizó correctamente... 
         if ($query) :
            $return["correcto"] = TRUE;
            $return["datos"] = $query->fetchAll(PDO::FETCH_ASSOC);
         endif; // o no :(
      } catch (PDOException $ex) {
         $return["error"] = $ex->getMessage();
      }

      return $return;
   }

   public function borrarInscripcion($id)
   {
      $return = [
         "correcto" => FALSE,
         "datos" => NULL,
         "error" => NULL
      ];
      
      $usuario = $_SESSION['id'];

      try {  
         $this->db->beginTransaction();

         $sql = "DELETE FROM asistenciaClases WHERE idAlumno=:idAlumno and idClase=:idClase";
         $query = $this->db->prepare($sql);
         $query->execute(['idAlumno' => $usuario, 
                          'idClase' => $id]);
         
         if ($query) {
            $this->db->commit();  
            $return["correcto"] = TRUE;
         } 
      } catch (PDOException $ex) {
         $this->db->rollback(); 
         $return["error"] = $ex->getMessage();
      }

      return $return;
   }

   public function insertarInscripcion($id)
   {
      $return = [
         "correcto" => FALSE,
         "error" => NULL
      ];

      try {

         $idUsuario = $_SESSION['id'];
         //Inicializamos la transacción
         $this->db->beginTransaction();
         //Definimos la instrucción SQL parametrizada 
         $sql = "INSERT INTO asistenciaClases (idClase, idAlumno)
                         VALUES (:idClase,:idUsuario)";
         // Preparamos la consulta...
         $query = $this->db->prepare($sql);
         // y la ejecutamos indicando los valores que tendría cada parámetro
         $query->execute([
            'idClase' => $id,
            'idUsuario' => $idUsuario
         ]); //Supervisamos si la inserción se realizó correctamente... 
         if ($query) {
            $this->db->commit(); // commit() confirma los cambios realizados durante la transacción
            $return["correcto"] = TRUE;
         } // o no :(
      } catch (PDOException $ex) {
         $this->db->rollback(); // rollback() se revierten los cambios realizados durante la transacción
         $return["error"] = $ex->getMessage();
         //die();
      }

      return $return;
   }

   /**
    * Función que realiza el listado de todos los usuarios registrados
    * Devuelve un array asociativo con tres campos:
    * -'correcto': indica si el listado se realizó correctamente o no.
    * -'datos': almacena todos los datos obtenidos de la consulta.
    * -'error': almacena el mensaje asociado a una situación errónea (excepción) 
    * @return type
    */
    public function listadoClases()
    {
       $return = [
          "correcto" => FALSE,
          "datos" => NULL,
          "error" => NULL
       ];

       //Realizamos la consulta...
       try {  //Definimos la instrucción SQL  
          $sql = "SELECT * FROM clasesExistentes";
          // Hacemos directamente la consulta al no tener parámetros
          $resultsquery = $this->db->query($sql);
          //Supervisamos si la inserción se realizó correctamente... 
          if ($resultsquery) :
             $return["correcto"] = TRUE;
             $return["datos"] = $resultsquery->fetchAll(PDO::FETCH_ASSOC);
          endif; // o no :(
       } catch (PDOException $ex) {
          $return["error"] = $ex->getMessage();
       }
 
       return $return;
    }


   /**
    * Función que realiza el listado de todos los usuarios registrados
    * Devuelve un array asociativo con tres campos:
    * -'correcto': indica si el listado se realizó correctamente o no.
    * -'datos': almacena todos los datos obtenidos de la consulta.
    * -'error': almacena el mensaje asociado a una situación errónea (excepción) 
    * @return type
    */
    public function listadoNoValidados()
    {
       $return = [
          "correcto" => FALSE,
          "datos" => NULL,
          "error" => NULL
       ];
       //Realizamos la consulta...
       try {  //Definimos la instrucción SQL  
          $sql = "SELECT * FROM usuarios WHERE rol_id = 2";
          // Hacemos directamente la consulta al no tener parámetros
          $resultsquery = $this->db->query($sql);
          //Supervisamos si la inserción se realizó correctamente... 
          if ($resultsquery) :
             $return["correcto"] = TRUE;
             $return["datos"] = $resultsquery->fetchAll(PDO::FETCH_ASSOC);
          endif; // o no :(
       } catch (PDOException $ex) {
          $return["error"] = $ex->getMessage();
       }
 
       return $return;
    }

    public function actualizaruser($datos)
    {
         $return = [
            "correcto" => FALSE,
            "error" => NULL
         ];
   
         try {
            //Inicializamos la transacción
            $this->db->beginTransaction();
            //Definimos la instrucción SQL parametrizada 
            $sql = "UPDATE usuarios SET rol_id= :rol_id WHERE id=:id";
            $query = $this->db->prepare($sql);
            $query->execute([
               'id' => $datos["id"],
               'rol_id' => $datos["rol_id"]
            ]);
            //Supervisamos si la inserción se realizó correctamente... 
            if ($query) {
               $this->db->commit();  // commit() confirma los cambios realizados durante la transacción
               $return["correcto"] = TRUE;
            } // o no :(
         } catch (PDOException $ex) {
            $this->db->rollback(); // rollback() se revierten los cambios realizados durante la transacción
            $return["error"] = $ex->getMessage();
            //die();
         }
   
         return $return;
      
    }

    public function pendientesActivacion()
    {
       //Realizamos la consulta...
          $sql = "SELECT count(*) FROM usuarios WHERE rol_id = 2";
          // Hacemos directamente la consulta al no tener parámetros
          $resultsquery = $this->db->query($sql);
          //Supervisamos si la inserción se realizó correctamente... 
          if ($resultsquery) :
             $return = $resultsquery->fetch();;
          endif; // o no :(
 
       return $return;
    }
   
   /**
    * Función que comprueba que el usuario y contraseña son correctos
    * Devuelve un array asociativo con tres campos:
    * -'correcto': indica si el listado se realizó correctamente o no.
    * -'datos': almacena todos los datos obtenidos de la consulta.
    * -'error': almacena el mensaje asociado a una situación errónea (excepción) 
    * @return type
    */
   public function inUser($datos)
   {
      $return = [
         "correcto" => FALSE,
         "error" => NULL
      ];
      
      try {
         $sql = "SELECT * FROM usuarios WHERE usuario =:usuario and password =:password";
         $query = $this->db->prepare($sql);
         $query->execute(['usuario'=>$datos["usuario"],'password'=>$datos["password"]]);

         if ($query) {
            $usuarioDatos = $query -> fetchAll();

            if (count($usuarioDatos)>0) {
               $return["correcto"] = TRUE;
               $return["datos"] = $usuarioDatos;
            }
           
         }
      } catch (\Throwable $ex) {
         $return["error"] = $ex->getMessage();
      }

      return $return;
   }


   /**
    * Método que elimina el usuario cuyo id es el que se le pasa como parámetro 
    * @param $id es un valor numérico. Es el campo clave de la tabla
    * @return boolean
    */
   public function deluser($id)
   {
      // La función devuelve un array con dos valores:'correcto', que indica si la
      // operación se realizó correctamente, y 'mensaje', campo a través del cual le
      // mandamos a la vista el mensaje indicativo del resultado de la operación
      $return = [
         "correcto" => FALSE,
         "error" => NULL
      ];
      //Si hemos recibido el id y es un número realizamos el borrado...
      if ($id && is_numeric($id)) {
         try {
            //Inicializamos la transacción
            $this->db->beginTransaction();
            //Definimos la instrucción SQL parametrizada 
            $sql = "DELETE FROM usuarios WHERE id=:id";
            $query = $this->db->prepare($sql);
            $query->execute(['id' => $id]);
            //Supervisamos si la eliminación se realizó correctamente... 
            if ($query) {
               $this->db->commit();  // commit() confirma los cambios realizados durante la transacción
               $return["correcto"] = TRUE;
            } // o no :(
         } catch (PDOException $ex) {
            $this->db->rollback(); // rollback() se revierten los cambios realizados durante la transacción
            $return["error"] = $ex->getMessage();
         }
      } else {
         $return["correcto"] = FALSE;
      }

      return $return;
   }

   /**
    * 
    * @param type $datos
    * @return type
    */
   public function adduser($datos)
   {
      $return = [
         "correcto" => FALSE,
         "error" => NULL
      ];

      try {
         //Inicializamos la transacción
         $this->db->beginTransaction();
         //Definimos la instrucción SQL parametrizada 
         $sql = "INSERT INTO usuarios(usuario,password,email)
                         VALUES (:usuario,:password,:email)";
         // Preparamos la consulta...
         $query = $this->db->prepare($sql);
         // y la ejecutamos indicando los valores que tendría cada parámetro
         $query->execute([
            'usuario' => $datos["usuario"],
            'password' => $datos["password"],
            'email' => $datos["email"]
         ]); //Supervisamos si la inserción se realizó correctamente... 
         if ($query) {
            $this->db->commit(); // commit() confirma los cambios realizados durante la transacción
            $return["correcto"] = TRUE;
         } // o no :(
      } catch (PDOException $ex) {
         $this->db->rollback(); // rollback() se revierten los cambios realizados durante la transacción
         $return["error"] = $ex->getMessage();
         //die();
      }

      return $return;
   }

   public function actuser($datos)
   {
      $return = [
         "correcto" => FALSE,
         "error" => NULL
      ];
      
      try {
         //Inicializamos la transacción
         //$this->db->beginTransaction();
         //Definimos la instrucción SQL parametrizada 
         $sql = "UPDATE usuarios SET nif= :nif, nombre= :nombre, apellido1= :apellido1, apellido2= :apellido2, telefono= :telefono, direccion= :direccion  WHERE usuario= :usuario";
         $query = $this->db->prepare($sql);

         if (!is_null($datos['usuario'])) {
            $query->execute([
               'nif' => $datos['dni'],
               'nombre' => $datos["nombre"],
               'apellido1'=> $datos["apellido1"],
               'apellido2'=> $datos["apellido2"],
               'telefono' => $datos['telefono'],
               'direccion' => $datos['direccion'],
               'usuario'=> $datos['usuario']
            ]);
         } else {
            $query->execute([
               'nif' => $datos['dni'],
               'nombre' => $datos["nombre"],
               'apellido1'=> $datos["apellido1"],
               'apellido2'=> $datos["apellido2"],
               'telefono' => $datos['telefono'],
               'direccion' => $datos['direccion'],
               'usuario'=> $_SESSION['usuario']
            ]);
         }
         

         

         //Supervisamos si la inserción se realizó correctamente... 
         if ($query) {
            //$this->db->commit();  // commit() confirma los cambios realizados durante la transacción
            $return["correcto"] = TRUE;
         } // o no :(
      } catch (PDOException $ex) {
         //$this->db->rollback(); // rollback() se revierten los cambios realizados durante la transacción
         $return["error"] = $ex->getMessage();
         //die();
      }

      return $return;
   }

   public function listausuario($id)
   {
      $return = [
         "correcto" => FALSE,
         "datos" => NULL,
         "error" => NULL
      ];

      if ($id && is_numeric($id)) {
         try {
            $sql = "SELECT * FROM usuarios WHERE id=:id";
            $query = $this->db->prepare($sql);
            $query->execute(['id' => $id]);
            //Supervisamos que la consulta se realizó correctamente... 
            if ($query) {
               $return["correcto"] = TRUE;
               $return["datos"] = $query->fetch(PDO::FETCH_ASSOC);
            } // o no :(
         } catch (PDOException $ex) {
            $return["error"] = $ex->getMessage();
            //die();
         }
      }

      return $return;
   }

   public function perfilCompleto($usuario)
   {
      $return = [
         "correcto" => FALSE,
         "datos" => NULL,
         "error" => NULL
      ];

         try {
            $sql = "SELECT * FROM usuarios WHERE usuario=:usuario";
            $query = $this->db->prepare($sql);

            //depende de que metodo llame a este (perfilCompleto), se ejecutara la consulta de una determinada manera.
            if (is_null($usuario)) {
               $query->execute(['usuario' => $_SESSION['usuario']]);
            } else {
               $query->execute(['usuario' => $usuario]);
            }
            
           
            //Supervisamos que la consulta se realizó correctamente... 
            if ($query) {
               $return["correcto"] = TRUE;
               $return["datos"] = $query->fetch(PDO::FETCH_ASSOC);
            } // o no :(
         } catch (PDOException $ex) {
            $return["error"] = $ex->getMessage();
            //die();
         }

      return $return;
   }

   public function userValidado($usuario)
   {
      $return = [
         "correcto" => FALSE,
         "datos" => NULL,
         "error" => NULL
      ];

         try {
            $sql = "SELECT rol_id , id FROM usuarios WHERE usuario=:usuario";
            $query = $this->db->prepare($sql);
            $query->execute(['usuario' => $usuario]);
            //Supervisamos que la consulta se realizó correctamente... 
            if ($query) {
               $return["correcto"] = TRUE;
               $return["datos"] = $query->fetch();
            } // o no :(
         } catch (PDOException $ex) {
            $return["error"] = $ex->getMessage();
            //die();
         }

      return $return;
   }
}
