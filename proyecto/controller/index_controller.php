<?php
require_once "class/biblioteca.php";

class index_controller extends ControladorBase
{

    private $model;
    private $MS = 'index';

    function __construct()
    {
        parent::__construct();
        $this->model = cargarModel($this->MS);
        $this->model->conectar(CONEXION, USER, PASS, '', 0);
    }

    function index()
    {
       /* $this->model->getPuntos();
        $datosOdbc = $this->model->getDatosOdbc();
        $puntos_vta = array();

        while ($reg = $datosOdbc->getRegistro()) {

            $id = trim($reg["id"]);
            $nombre =  (ucwords(strtolower(trim($reg["nombre"]))));
            $direccion = trim($reg["direccion"]);
            $telefono = trim($reg["telefono"]);
            $ecommerce = trim($reg["ecommerce"]);
            $carta = trim($reg["carta"]);

            array_push(
                $puntos_vta,
                array(
                    'id' => $id,
                    'nombre' => $nombre,
                    'direccion' => $direccion,
                    'telefono' => $telefono,
                    'ecommerce' => $ecommerce,
                    'carta' => $carta
                )
            );
        }*/

        $datos_vista['bibliotecas'] = $this->obtenerBibliotecas();
        $datos_vista['categorias'] = $this->obtenerCategorias();
        $vista = cargarView("index");
        $vista->asignarVariable($datos_vista);
        $vista->cargarTemplate("head");
        $vista->cargarTemplate("menu");
        $vista->dibujar();
    }

    function obtenerBibliotecas(){

        $this->model->getBibliotecas();
        $datosOdbc = $this->model->getDatosOdbc();
        $bibliotecas= array();

        while ($reg = $datosOdbc->getRegistro()) {

            $id = trim($reg["id"]);
            $nombre =  (ucwords(strtolower(trim($reg["nombre"]))));
            $descripcion = strtolower(trim($reg["descripcion"]));
            $estado = trim($reg["estado"]);
            $id_categ = trim($reg["id_categ"]);
            $categoria = trim($reg["categoria"]);
            $est_cat = trim($reg["est_cat"]);

            $biblioteca=new Biblioteca($id,$nombre,$descripcion,$estado,$id_categ,$categoria,$est_cat);

            array_push(
                $bibliotecas,
                $biblioteca

            );
        }

        return $bibliotecas;

    }

     function obtenerCategorias(){

        $this->model->getCategorias();
        $datosOdbc = $this->model->getDatosOdbc();
        $categorias= array();

        while ($reg = $datosOdbc->getRegistro()) {

            $id = trim($reg["id"]);
            $nombre =  (ucwords(strtolower(trim($reg["nombre"]))));
            $estado = trim($reg["estado"]);

            $categoria=new Categoria($id,$nombre,$estado);

            array_push(
                $categorias,
                $categoria

            );
        }

        return $categorias;

    }

    

    function grabarBiblioteca()
    {
        $nombre = $_POST['nombre'];
        $descripcion = $_POST['descripcion'];
        $categoria = $_POST['categoria'];
        $this->model->insertBiblioteca($nombre, $descripcion,$categoria,'A');
        $response['graba'] = 1;
        echo json_encode($response);
    }

    function editarBiblioteca()
    {
        $id = $_POST['id'];
        $nombre = $_POST['nombre'];
        $descripcion = $_POST['descripcion'];
        $categoria = $_POST['categoria'];
       
        $this->model->updateBiblioteca($id, $nombre, $descripcion, $categoria);
        $response['editar'] = 1;
        echo json_encode($response);
    }

    function eliminarBiblioteca()
    {
        $id = $_POST['id'];
        $this->model->eliminarBiblioteca($id);
        $response['eliminar'] = 1;
        echo json_encode($response);
    }

    function visor()
    {
        $datos_vista['bibliotecas'] = $this->obtenerBibliotecas();
        $vista = cargarView("visor");
        $vista->asignarVariable($datos_vista);
        $vista->cargarTemplate("head");
        $vista->cargarTemplate("menu");
        $vista->dibujar();
    }
    
}
