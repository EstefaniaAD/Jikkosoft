<?php
require_once "categoria.php";

class Biblioteca 
{
    
    private $id= "";
    private $nombre= "";
    private $descripcion= "";
    private $categoria= null;
    private $estado= "";

    function __construct($id,$nombre,$descripcion,$estado,$id_categ,$categoria,$est_cat)
    {
        $this->id=$id;
        $this->nombre=$nombre;
        $this->descripcion=$descripcion;
        $this->categoria=new Categoria($id_categ,$categoria,$est_cat);
        $this->estado=$estado;
    }

    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getNombre() {
        return $this->nombre;
    }

    public function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    public function getDescripcion() {
        return $this->descripcion;
    }

    public function setDescripcion($descripcion) {
        $this->descripcion = $descripcion;
    }

    public function getCategoria() {
        return $this->categoria;
    }

    public function setCategoria($categoria) {
        $this->categoria = $categoria;
    }
    

}