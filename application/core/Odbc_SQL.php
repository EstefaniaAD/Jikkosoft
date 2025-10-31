<?php

/**
 * Clase que se encarga de las solicitudes a la BD
 */
include('DatosOdbc_SQL.php');

class Odbc
{

  private $host = INSTANCIA;
  // private $db_name = "intranet"; //pruebas
  private $db_name = DB; //produccion
  private $username = USER;
  private $password = PASS;

  // private $db_name = "intranet"; //pruebas
  public $conn;
  public $conexion;
  public $conectado;
  public $statement;

  // ------------------------------------------------------------------------

  function __construct($dsn = '', $usuario = '', $clave = '', $salir = true, $simulador = false)
  {
    $this->salir = $salir;
    $this->dsn = $dsn;
    $this->usuario = $usuario;
    $this->clave = $clave;
    $this->simulador = $simulador;
    $this->conectado = $this->conectar();
  }

  // ------------------------------------------------------------------------

  /**
   * Establece la conexion con el ODBC
   */
  function conectar($dsn = '', $usuario = '', $clave = '', $salir = true, $simulador = false)
  {

    $this->salir = $salir;
    $this->dsn = $dsn;
    $this->usuario = $usuario;
    $this->clave = $clave;
    $this->simulador = $simulador;

    $this->conn = null;
    try {
      //$this->conn = new PDO("sqlsrv:Server=" . $this->host . ";Database=intranet_copia" , $usuario, $clave);
      ////$this->conn = new PDO("sqlsrv:Server=" . $this->host . ";Database=intranet_copia" , $usuario, $clave);
      $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=".DB, $usuario, $clave);      
      
      $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $exception) {exit("------------".$exception);
      $log = [
        "id" => uniqid('', true),
        "Message" => $exception->getMessage(),
        "Code" => (string) $exception->getCode(),
        "File" => $exception->getFile(),
        "Line" => (string) $exception->getLine(),
        "TraceAsString" => $exception->getTraceAsString(),
        "Class" => get_class($exception),
      ];
      echo json_encode($log, JSON_PRETTY_PRINT);
      echo"------------";
    }
    $this->conexion = $this->conn;
    return true;
  }

  // ------------------------------------------------------------------------

  /**
   * funcion que consulta a la BD y que soporta la opcion de simulador.
   * @param String $consulta string de la consulta
   * @param String $nomSimulador alias de la consulta para ser guardada en la session y no ser reescribida.
   */
  function consultar($consulta, $parameters = [])
  {

    
    $this->datosOdbc = new DatosOdbc();
    $this->datosOdbc->reset();

    $this->datosOdbc->setConsulta($consulta);

    $registros = array();
    $rows = 0;
    $this->statement = '';
    // $this->conectado = $this->conectar();

    try {
      $db = $this->conexion;
      $this->statement = $db->prepare($consulta);
      $this->statement->execute();

      $registros = $this->statement->fetchall(PDO::FETCH_ASSOC);

      $rows = $this->statement->rowcount();


    } catch (PDOException $exception) {
      $log = [
        "id" => uniqid('', true),
        "Error" => $this->statement->errorInfo(),
        "Consulta" => $consulta,
        "Message" => $exception->getMessage(),
        "Code" => (string) $exception->getCode(),
        "File" => $exception->getFile(),
        "Line" => (string) $exception->getLine(),
        "TraceAsString" => $exception->getTraceAsString(),
        "Class" => get_class($exception),
      ];
      echo json_encode($log, JSON_PRETTY_PRINT);
      
    }



    $this->datosOdbc->setRegistro($registros);
    $this->datosOdbc->setNumRegistros($rows);
    // $this->close();


    return 0;
  }

  // ------------------------------------------------------------------------

  /**
   * retorna el objeto con el resultado de la consulta.
   */
  function getDatosOdbc()
  {
    return $this->datosOdbc;
  }

  // ------------------------------------------------------------------------

  /**
   * Se usa para las consultas de tipo insert, update y delete.
   * @param String $consulta: Consulta sql
   * @return int
   */
  function ejecutar($consulta)
  {
    // $this->conectado = $this->conectar();
    $registros = array();
    $rows = 0;

    try {
      $db = $this->conexion;
      $this->statement = $db->prepare($consulta);
      $registros = $this->statement->execute();
      $registros=0;

    } catch (PDOException $exception) {
      $log = [
        "id" => uniqid('', true),
        "Error" => $this->statement->errorInfo(),
        "Consulta" => $consulta,
        "Message" => $exception->getMessage(),
        "Code" => (string) $exception->getCode(),
        "File" => $exception->getFile(),
        "Line" => (string) $exception->getLine(),
        "TraceAsString" => $exception->getTraceAsString(),
        "Class" => get_class($exception),
      ];
      $registros=1;
      echo json_encode($log, JSON_PRETTY_PRINT);
    }
    // $this->close();
    return $registros;
  }

  // ------------------------------------------------------------------------

  /**
   * FALTA DOCUMENTAR
   * @param String $consulta
   * @param String $mensaje
   */
  function ejecutarSeguro($consulta, $mensaje = 'Error Ejecutando!')
  {
    // $this->conectado = $this->conectar();
    $registros = array();
    $rows = 0;

    try {
      $db = $this->conexion;
      $this->statement = $db->prepare($consulta);
      $this->statement->execute();

    } catch (PDOException $exception) {
      $log = [
        "id" => uniqid('', true),
        "Error" => $this->statement->errorInfo(),
        "Consulta" => $consulta,
        "Message" => $exception->getMessage(),
        "Code" => (string) $exception->getCode(),
        "File" => $exception->getFile(),
        "Line" => (string) $exception->getLine(),
        "TraceAsString" => $exception->getTraceAsString(),
      ];
      echo json_encode($log, JSON_PRETTY_PRINT);
    }
    // $this->close();
    return $registros;
  }

  // ------------------------------------------------------------------------

  /**
   * Iniciar una transaccion al poner false
   */
  function autocommit($auto = FALSE)
  {
    // $this->conectado = $this->conectar();
    return $this->conexion->beginTransaction();
  }
  // ------------------------------------------------------------------------

  /**
   * Revierte todas las sentencias pendientes de la conexion.
   */
  function rollback()
  {
    // $this->close();
    return $this->conexion->rollBack();
  }

  // ------------------------------------------------------------------------

  /**
   * Envia todas las transacciones pendientes en una conexion.
   */
  function commit()
  {
    // $this->close();
    return $this->conexion->commit();
  }

  // ------------------------------------------------------------------------

  /*   * *************    funciones para el simulador   ****************   */

  /**
   * funcion que trasforma el arreglo a una cadena y lo escribe en un archivo
   */
  function simuladorBd($archivo, $arreglo)
  {
    $cadena = json_encode($arreglo);
    $_SESSION['simulador_' . $archivo] = trim($cadena);
  }

  // ------------------------------------------------------------------------

  /**
   * funcionque trae el texto y lo pasa de nuevo a un arreglo
   */
  function traerSimuladorBd($archivo)
  {
    $fichero = $_SESSION['simulador_' . $archivo];
    return json_decode(trim($fichero), true);
  }

  // ------------------------------------------------------------------------

  /** funcion que verifica la existencia del archivo
   * -existe solo llama a traerSimuladorBd()
   * -no existe llama a simuladorBd() y traerSimuladorBd()
   */
  function iniciarTmp($archivo)
  {
    if (empty($_SESSION))
      return false;

    if (@$_SESSION['simulador_' . $archivo] == "") { /* A veces tira error porque no encuentra la variable de session establecida, se ignora porque no importa */
      return false;
    }
    return true;
  }

  function close()
  {
    return $this->conexion = null;
  }

  // ------------------------------------------------------------------------
}

?>