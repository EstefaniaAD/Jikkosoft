<?php
require_once "class/libro.php";

class libro_controller extends ControladorBase
{

    private $model;
    private $MS = 'libro';

    function __construct()
    {
        parent::__construct();
        $this->model = cargarModel($this->MS);
        $this->model->conectar(CONEXION, USER, PASS, '', 0);
    }

    function index()
    {
        $id_biblioteca = $_POST['id_biblioteca'];
        $datos_vista['libros'] = $this->obtenerLibros($id_biblioteca);
        $datos_vista['id_biblioteca'] =$id_biblioteca; 
        $vista = cargarView("libro");
        $vista->asignarVariable($datos_vista);
        $vista->cargarTemplate("head");
        $vista->cargarTemplate("menu");
        $vista->dibujar();
    }

    function obtenerLibros($id_biblioteca){

        
        $this->model->getLibros($id_biblioteca);
        $datosOdbc = $this->model->getDatosOdbc();
        $libros= array();

        while ($reg = $datosOdbc->getRegistro()) {

            $id = trim($reg["id"]);
            $titulo =  (ucwords(strtolower(trim($reg["titulo"]))));
            $autor =  (ucwords(strtolower(trim($reg["autor"]))));
            $abstract =  ((strtolower(trim($reg["abstract"]))));
            $fecha =  trim($reg["fecha"]);
            $archivo=  trim($reg["archivo"]);
            $libro=new Libro($id,$titulo,$autor,$fecha,$abstract,$id_biblioteca,$archivo,'A');

            array_push(
                $libros,
                $libro

            );
        }

        return $libros;

    }

    function grabarLibro()
    {
        $titulo = $_POST['titulo'];
        $autor =  $_POST['autor'];
        $abstract = $_POST['abstract'];
        $fecha = $_POST['fecha'];
        $id_bibli = $_POST['id_biblioteca'];
        

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (isset($_FILES['archivo']) && $_FILES['archivo']['error'] === 0) {
                $nombre = $_FILES['archivo']['name'];
                $tmp = $_FILES['archivo']['tmp_name'];
                $destino = 'uploads/' . basename($nombre);

                // Asegúrate de que exista la carpeta "uploads"
                if (move_uploaded_file($tmp, $destino)) {
                    echo "✅ Archivo subido correctamente: $nombre";
                } else {
                    echo "❌ Error al mover el archivo.";
                }
            } else {
                echo "⚠️ No se recibió ningún archivo o hubo un error.";
            }
        }
        $this->model->insertLibro($titulo,$autor, $abstract,$fecha,$destino,$id_bibli,'A');
        $datos_vista['libros'] = $this->obtenerLibros($id_bibli);
        $datos_vista['id_biblioteca'] =$id_bibli; 
        $vista = cargarView("libro");
        $vista->asignarVariable($datos_vista);
        $vista->cargarTemplate("head");
        $vista->cargarTemplate("menu");
        $vista->dibujar();
    }

    function infoLibro()
    {
        $id = $_POST['id'];
       
        $this->model->getLibro($id);
        $datosOdbc = $this->model->getDatosOdbc();
        $libros= array();

        while ($reg = $datosOdbc->getRegistro()) {

            $response['titulo']  =  (ucwords(strtolower(trim($reg["titulo"]))));
            $response['autor']   =  (ucwords(strtolower(trim($reg["autor"]))));
            $response['fecha']   = trim($reg["fecha"]);
            $response['abstract']   = trim($reg["abstract"]);
            $response['archivo']   = trim($reg["archivo"]);

        }
        $response['editar'] = 1;
        echo json_encode($response);
    }


     function editarLibro()
    {
        $titulo = $_POST['tituloEdit'];
        $autor =  $_POST['autorEdit'];
        $abstract = $_POST['abstractEdit'];
        $fecha = $_POST['fechaEdit'];
        $id_bibli = $_POST['id_biblioteca'];
        $destino='';
        
        $id = $_POST['idEdit'];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (isset($_FILES['archivoEdit']) && $_FILES['archivoEdit']['error'] === 0) {
                $nombre = $_FILES['archivoEdit']['name'];
                $tmp = $_FILES['archivoEdit']['tmp_name'];
                $destino = 'uploads/' . basename($nombre);

                // Asegúrate de que exista la carpeta "uploads"
                if (move_uploaded_file($tmp, $destino)) {
                    echo "✅ Archivo subido correctamente: $nombre";
                } else {
                    echo "❌ Error al mover el archivo.";
                }
            } else {
                echo "⚠️ No se modificó el archivo actual.";
            }
        }

        $this->model->updateLibro($id,$titulo,$autor, $abstract,$fecha,$destino,$id_bibli,'A');
        $datos_vista['libros'] = $this->obtenerLibros($id_bibli);
        $datos_vista['id_biblioteca'] =$id_bibli; 
        $vista = cargarView("libro");
        $vista->asignarVariable($datos_vista);
        $vista->cargarTemplate("head");
        $vista->cargarTemplate("menu");
        $vista->dibujar();
    }

    function eliminarLibro()
    {
        $id = $_POST['id'];
        $this->model->eliminarLibro($id);
        $response['eliminar'] = 1;
        echo json_encode($response);
    }

    function visorLibros()
    {
        $id_biblioteca = $_POST['idLib'];
        $datos_vista['libros'] = $this->obtenerLibros($id_biblioteca);
        $datos_vista['id_biblioteca'] =$id_biblioteca; 
        $vista = cargarView("visorLibro");
        $vista->asignarVariable($datos_vista);
        $vista->cargarTemplate("head");
        $vista->cargarTemplate("menu");
        $vista->dibujar();
    }

    
}
