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

   /**
    * Función que realiza el listado de todos mensajes de un determinado usuario
    * Devuelve un array asociativo con tres campos:
    * -'correcto': indica si el listado se realizó correctamente o no.
    * -'datos': almacena todos los datos obtenidos de la consulta.
    * -'error': almacena el mensaje asociado a una situación errónea (excepción) 
    * @return type
    */
   public function listadoMensajes()
   {
      $return = [
         "correcto" => FALSE,
         "datos" => NULL,
         "error" => NULL
      ];
      //Realizamos la consulta...
      try {  //Definimos la instrucción SQL  
         $sql = "SELECT usuarios.usuario, mensajes.id, mensajes.idRemitente, mensajes.idDestinatario, mensajes.contenido, mensajes.asunto, mensajes.fechaCreacion  
                           FROM mensajes JOIN usuarios ON mensajes.idRemitente = usuarios.id 
                                          WHERE idDestinatario=:idDestinatario";
         $query = $this->db->prepare($sql);
         // Hacemos directamente la consulta al no tener parámetros
         $query->execute(['idDestinatario' => $_SESSION['id']]);
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

   /**
    * Función que realiza inserta un mensaje
    * Devuelve un array asociativo con tres campos:
    * -'correcto': indica si el listado se realizó correctamente o no.
    * -'datos': almacena todos los datos obtenidos de la consulta.
    * -'error': almacena el mensaje asociado a una situación errónea (excepción) 
    * @return type
    */
   public function addmensaje($datos)
   {
      $return = [
         "correcto" => FALSE,
         "error" => NULL,
         "inscrito" => FALSE
      ];

         $fecha = date("d/m/Y");  //Creamos la fecha de envio del mensaje
         $idUsuario = $_SESSION['id'];
         $usuarioDestino = $datos['destinatario'];

         //Primero buscamos el usuario de destino mediante su nombre de usuario.
         $sqlUno = "SELECT id FROM usuarios WHERE usuario=:usuario";
         $queryUno = $this->db->prepare($sqlUno);

         $queryUno->execute(['usuario' => $usuarioDestino]);

         //Si el usuario exite.
         if ($queryUno) {
            try {//Inicializamos la transacción
               $resultado = $queryUno->fetch();

               $this->db->beginTransaction();
               //Definimos la instrucción SQL parametrizada 
               $sql = "INSERT INTO mensajes (idRemitente, idDestinatario, contenido, asunto, fechaCreacion)
                              VALUES (:idRemitente, :idDestinatario, :contenido, :asunto, :fechaCreacion)";
               // Preparamos la consulta...
               $query = $this->db->prepare($sql);
               // y la ejecutamos indicando los valores que tendría cada parámetro
               $query->execute([
                  'idRemitente' => $datos['idRemitente'],
                  'idDestinatario' => $resultado['id'],
                  'contenido' => $datos['contenido'],
                  'asunto' => $datos['asunto'],
                  'fechaCreacion' => $fecha
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

         } else {
            $return["error"] = "El usuario destinatario no existe";
         }
         
      return $return;
   }

   /**
    * Función para borrar un mensaje
    * Devuelve un array asociativo con tres campos:
    * -'correcto': indica si el listado se realizó correctamente o no.
    * -'error': almacena el mensaje asociado a una situación errónea (excepción) 
    * @return type
    */
   public function delMensaje($id)
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
            $sql = "DELETE FROM mensajes WHERE id=:id";
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
    * Función para insertar una determinada clase
    * Devuelve un array asociativo con tres campos:
    * -'correcto': indica si el listado se realizó correctamente o no.
    * -'error': almacena el mensaje asociado a una situación errónea (excepción) 
    * @return type
    */
   public function insertarClase($datos)
   {
      $return = [
         "correcto" => FALSE,
         "error" => NULL
      ];
      
      try {
         $sql = "INSERT INTO clases(nombre,tipo,descripcion,imagen)
                         VALUES (:nombre,:tipo,:descripcion,:imagen)";

         $query = $this->db->prepare($sql);

         $query->execute([
            'nombre' => $datos["nombre"],
            'tipo'=> $datos['tipo'],
            'descripcion'=> $datos['descripcion'],
            'imagen'=> $datos['imagen']
         ]);   

         //Supervisamos si la inserción se realizó correctamente... 
         if ($query) {
            $return["correcto"] = TRUE;
         }

      } catch (PDOException $ex) {
         var_dump($ex->getMessage());
         //$this->db->rollback(); // rollback() se revierten los cambios realizados durante la transacción
         $return["error"] = $ex->getMessage();
         //die();
      }

      return $return;
   }

   /**
    * Función que permite editar un clase
    * Devuelve un array asociativo con tres campos:
    * -'correcto': indica si el listado se realizó correctamente o no.
    * -'error': almacena el mensaje asociado a una situación errónea (excepción) 
    * @return type
    */
   public function editarClase($datos)
   {
      $return = [
         "correcto" => FALSE,
         "error" => NULL
      ];
      
      try {
         $sql = "UPDATE clases SET nombre= :nombre, tipo= :tipo, descripcion= :descripcion, imagen= :imagen  WHERE id= :id";
         $query = $this->db->prepare($sql);

         $query->execute([
            'nombre' => $datos["nombre"],
            'tipo'=> $datos['tipo'],
            'descripcion'=> $datos['descripcion'],
            'imagen'=> $datos['imagen'],
            'id' => $datos['id']
         ]);   

         //Supervisamos si la inserción se realizó correctamente... 
         if ($query) {
            $return["correcto"] = TRUE;
         }

      } catch (PDOException $ex) {
         $return["error"] = $ex->getMessage();
      }

      return $return;
   }

   /**
    * Función que permite eliminar una clase (bodypump, bodycombat...)
    * Devuelve un array asociativo con tres campos:
    * -'correcto': indica si el listado se realizó correctamente o no.
    * -'error': almacena el mensaje asociado a una situación errónea (excepción) 
    * @return type
    */
   public function delClase($id)
   {
      $return = [
         "correcto" => FALSE,
         "error" => NULL
      ];
      //Si hemos recibido el id y es un número realizamos el borrado...
      if ($id && is_numeric($id)) {
         try {
            //PRIMERO BORRAMOS LAS CLASES EN EL HORARIO
            //Inicializamos la transacción
            $this->db->beginTransaction();
            //Definimos la instrucción SQL parametrizada 
            $sql = "DELETE FROM clasesExistentes WHERE idClase=:id";
            $query = $this->db->prepare($sql);
            $query->execute(['id' => $id]);

            //DESPUES BORRAMOS LA CLASE DEL SISTEMA
            //Definimos la instrucción SQL parametrizada 
            $sql = "DELETE FROM clases WHERE id=:id";
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
    * Función que realiza el listado de la oferta de clases
    * Devuelve un array asociativo con tres campos:
    * -'correcto': indica si el listado se realizó correctamente o no.
    * -'datos': almacena todos los datos obtenidos de la consulta.
    * -'error': almacena el mensaje asociado a una situación errónea (excepción) 
    * @return type
    */
   public function listarOferta()
   {
      $return = [
         "correcto" => FALSE,
         "datos" => NULL,
         "error" => NULL
      ];

      //Realizamos la consulta...
      try {  //Definimos la instrucción SQL  
         $sql = "SELECT * FROM clases";

         $resultsquery = $this->db->query($sql);

         if ($resultsquery) :
            $return["correcto"] = TRUE;
            $return["datos"] = $resultsquery->fetchAll(PDO::FETCH_ASSOC);
         endif;
      } catch (PDOException $ex) {
         $return["error"] = $ex->getMessage();
      }

      return $return;
   }

   /**
    * Función que realiza el listado de inscripciones
    * Devuelve un array asociativo con tres campos:
    * -'correcto': indica si el listado se realizó correctamente o no.
    * -'datos': almacena todos los datos obtenidos de la consulta.
    * -'error': almacena el mensaje asociado a una situación errónea (excepción) 
    * @return type
    */
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

   /**
    * Función que permite la eliminacion de una clase determinada de un dia y hora determinados
    * Devuelve un array asociativo con tres campos:
    * -'correcto': indica si el listado se realizó correctamente o no.
    * -'datos': almacena todos los datos obtenidos de la consulta.
    * -'error': almacena el mensaje asociado a una situación errónea (excepción) 
    * @return type
    */
   public function delCLaseExistente($id)
   {
      $return = [
         "correcto" => FALSE,
         "datos" => NULL,
         "error" => NULL
      ];

      try {  
         $this->db->beginTransaction();

         $sql = "DELETE FROM clasesExistentes WHERE id=:id";
         $query = $this->db->prepare($sql);
         $query->execute(['id' => $id]);
         
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

   /**
    * Función que permite borrar una inscripcion de un uusairo a una clase
    * Devuelve un array asociativo con tres campos:
    * -'correcto': indica si el listado se realizó correctamente o no.
    * -'datos': almacena todos los datos obtenidos de la consulta.
    * -'error': almacena el mensaje asociado a una situación errónea (excepción) 
    * @return type
    */
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

   /**
    * Función que permite insertar una clase en un dia y hora determinados.
    * Devuelve un array asociativo con dos campos:
    * -'correcto': indica si el listado se realizó correctamente o no.
    * -'error': almacena el mensaje asociado a una situación errónea (excepción) 
    * @return type
    */
   public function insertarClaseExistente($datos)
   {
      $return = [
         "correcto" => FALSE,
         "error" => NULL
      ];

      $contador= 0; //Variable para editar clases duplicadas.

      try {
         $this->db->beginTransaction();
         //Primero comprobamos que esas horas no esten ocupadas
         $sqlUno = "SELECT count(*) FROM clasesExistentes WHERE Dia=:dia and horaInicio<:horaFin and horaFin>:horaInicio";
         $queryUno = $this->db->prepare($sqlUno);
         
         $queryUno->execute([
            'dia' => $datos['Dia'],
            'horaFin' => $datos['horaFin'],
            'horaInicio' => $datos['horaInicio']]
         );
         $contador = $queryUno->fetch();

         //Si la hora esta libre:
         if ($contador['count(*)'] == 0) {
            $sql = "INSERT INTO clasesExistentes (idClase, Dia, horaInicio, horaFin)
                              VALUES (:idClase,:Dia,:horaInicio,:horaFin)";
               // Preparamos la consulta...
               $query = $this->db->prepare($sql);
               // y la ejecutamos indicando los valores que tendría cada parámetro
               $query->execute([
                  'idClase' => $datos['idClase'],
                  'Dia' => $datos['Dia'],
                  'horaFin' => $datos['horaFin'],
                  'horaInicio' => $datos['horaInicio']
               ]); //Supervisamos si la inserción se realizó correctamente... 

               if ($query) {
                  $this->db->commit(); // commit() confirma los cambios realizados durante la transacción
                  $return["correcto"] = TRUE;
               } // o no :(
         } else {
            $return["error"] = "Horario no disponible. Consulte el horario para ver horas libres.";
         }

      } catch (PDOException $ex) {
         $this->db->rollback(); // rollback() se revierten los cambios realizados durante la transacción
         $return["error"] = $ex->getMessage();
         //die();
      }         
      return $return;
   }

   /**
    * Función que realiza la insercion de un usuario a una determinada clase
    * Devuelve un array asociativo con tres campos:
    * -'correcto': indica si el listado se realizó correctamente o no.
    * -'datos': almacena todos los datos obtenidos de la consulta.
    * -'error': almacena el mensaje asociado a una situación errónea (excepción) 
    * @return type
    */
   public function insertarInscripcion($id)
   {
      $return = [
         "correcto" => FALSE,
         "error" => NULL,
         "inscrito" => FALSE
      ];

      $contador= 0; //Variable para editar clases duplicadas.

      
         $idUsuario = $_SESSION['id'];

         //Primero comprobamos que el usuario no esté ya inscrito en esa clase.
         $sqlUno = "SELECT count(*) FROM asistenciaClases WHERE idAlumno=:id and  idClase=:idClase";
         $queryUno = $this->db->prepare($sqlUno);
         $queryUno->execute([
            'id' => $idUsuario,
            'idClase' => $id]
         );
         $contador = $queryUno->fetch();

         //Si no esta inscrito se le inscribe
         if ($contador["count(*)"]==0) {
            try {//Inicializamos la transacción
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

         } else { //Si ya esta inscrito se le informa.
            $return["inscrito"] = TRUE;
         }
         
      return $return;
   }

   /**
    * Función que realiza el listado dde todas las clases
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
          $sql = "SELECT clasesExistentes.id, clasesExistentes.idClase, clasesExistentes.duracion ,clasesExistentes.Dia, clasesExistentes.horaInicio, clasesExistentes.horaFin, clases.nombre FROM clasesExistentes
                                                                                                                                                                               JOIN clases ON clasesExistentes.idClase = clases.id;";
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
    * Función que realiza el listado de todos los usuarios no validados
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

    /**
    * Función que actualizar el rol_id de un usuario al administrador
    * Devuelve un array asociativo con dos campos:
    * -'correcto': indica si el listado se realizó correctamente o no.
    * -'error': almacena el mensaje asociado a una situación errónea (excepción) 
    * @return type
    */
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

    /**
    * Función que lista todos los usuarios pendientes de activacion
    * Devuelve un array asociativo con dos campos:
    * -'correcto': indica si el listado se realizó correctamente o no.
    * -'error': almacena el mensaje asociado a una situación errónea (excepción) 
    * @return type
    */
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
    * Devuelve un array asociativo con dos campos:
    * -'correcto': indica si el listado se realizó correctamente o no.
    * -'error': almacena el mensaje asociado a una situación errónea (excepción) 
    * @return type
    */
   public function deluser($id)
   {
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
    * Función que permite añadir un usuario a la bbdd.
    * Devuelve un array asociativo con dos campos:
    * -'correcto': indica si el listado se realizó correctamente o no.
    * -'error': almacena el mensaje asociado a una situación errónea (excepción) 
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

   /**
    * Función que actualizar la informacion de un usuario
    * Devuelve un array asociativo con dos campos:
    * -'correcto': indica si el listado se realizó correctamente o no.
    * -'error': almacena el mensaje asociado a una situación errónea (excepción) 
    * @return type
    */
   public function actuser($datos)
   {
      $return = [
         "correcto" => FALSE,
         "error" => NULL
      ];
      
      try {
         $sql = "UPDATE usuarios SET nif= :nif, nombre= :nombre, apellido1= :apellido1, apellido2= :apellido2, imagen= :imagen, telefono= :telefono, direccion= :direccion  WHERE usuario= :usuario";
         $query = $this->db->prepare($sql);

         //Si no trae el nombre de usuario lo cogemos de la sesion.
         if (!is_null($datos['usuario'])) {
            $query->execute([
               'nif' => $datos['dni'],
               'nombre' => $datos["nombre"],
               'apellido1'=> $datos["apellido1"],
               'apellido2'=> $datos["apellido2"],
               'imagen' => $datos['imagen'],
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
               'imagen' => $datos['imagen'],
               'telefono' => $datos['telefono'],
               'direccion' => $datos['direccion'],
               'usuario'=> $_SESSION['usuario']
            ]);
         }
         
         
         if ($query) {
            $return["correcto"] = TRUE;
         }
      } catch (PDOException $ex) {
         $return["error"] = $ex->getMessage();
      }

      return $return;
   }

   /**
    * Función que listar toda la informacion de un determinado usuario mediante id
    * Devuelve un array asociativo con tres campos:
    * -'correcto': indica si el listado se realizó correctamente o no.
    * -'datos': almacena todos los datos obtenidos de la consulta.
    * -'error': almacena el mensaje asociado a una situación errónea (excepción) 
    * @return type
    */
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

   /**
    * Función que listar toda la informacion de un determinado usuario mediante el usuario
    * Devuelve un array asociativo con tres campos:
    * -'correcto': indica si el listado se realizó correctamente o no.
    * -'datos': almacena todos los datos obtenidos de la consulta.
    * -'error': almacena el mensaje asociado a una situación errónea (excepción) 
    * @return type
    */
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

   /**
    * Función que permite listar el rol_id y el id de un usuario mediante su usuario.
    * Devuelve un array asociativo con tres campos:
    * -'correcto': indica si el listado se realizó correctamente o no.
    * -'datos': almacena todos los datos obtenidos de la consulta.
    * -'error': almacena el mensaje asociado a una situación errónea (excepción) 
    * @return type
    */
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
