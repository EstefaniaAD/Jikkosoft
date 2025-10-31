<?php

class miembro_controller extends ControladorBase
{

    private $model;
    private $MS = 'miembro';

    function __construct()
    {
        parent::__construct();
        $this->model = cargarModel($this->MS);
        $this->model->conectar(CONEXION, USER, PASS, '', 0);
    }

    function index()
    {
        
    }

    function validar(){
        $alias = $_POST['alias'];
        $email =  $_POST['email'];
        
        $this->model->getMiembro($alias,$email);
        $datosOdbc = $this->model->getDatosOdbc();
        $libros= array();
        $response['existe']=0;

        while ($reg = $datosOdbc->getRegistro()) {

            $response['id'] = trim($reg["id"]);
            $response['pri_nombre'] =  (ucwords(strtolower(trim($reg["pri_nombre"]))));
            $response['seg_nombre'] =  (ucwords(strtolower(trim($reg["seg_nombre"]))));
            $response['pri_apell'] =  ((strtolower(trim($reg["pri_apell"]))));
            $response['seg_apell'] =  trim($reg["seg_apell"]);
            $response['existe']=1;

            
        }

        echo json_encode($response);

    }

    function grabarMiembro()
    {
        $pnombre = $_POST['pnombre'];
        $snombre =  $_POST['snombre'];
        $papell = $_POST['papell'];
        $sapell = $_POST['sapell'];
        $alias = $_POST['usuario'];
        $email = $_POST['email'];
        
        $this->model->insertMiembro($pnombre,$snombre, $papell, $sapell,$alias,$email);
        
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
