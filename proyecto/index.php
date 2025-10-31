<?php
require_once 'config/global.php';
require_once '../application/core/ControladorBase_SQL.php';
require_once '../application/core/VistaBase.php';

if (isset($_REQUEST["controlador"])) {
    $controllerObj = cargarControlador($_REQUEST["controlador"]);
    lanzarAccion($controllerObj);
  } elseif(isset($_FILES['file']) and !$_FILES['file']['error']){
      $data = json_decode($_POST['param']);
      $_REQUEST['metodo'] = $data->metodo;
      $controllerObj = cargarControlador($data->controlador);
      lanzarAccion($controllerObj);
  }else {
  
    $controllerObj = cargarControlador(CONTROLADOR_DEFECTO);
  
    lanzarAccion($controllerObj); 
    
  }
?>