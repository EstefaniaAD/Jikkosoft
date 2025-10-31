<?php
class Libro 
{
    
    private $id= "";
    private $titulo= "";
    private $autor= "";
    private $fecha= "";
    private $abstract= "";
    private $ruta="";
    private $libreria="";
    private $estado= "";

    function __construct($id,$titulo,$autor,$fecha,$abstract,$libreria,$ruta,$estado)
    {
        $this->id=$id;
        $this->titulo=$titulo;
        $this->autor=$autor;
        $this->fecha=$fecha;
        $this->abstract=$abstract;
        $this->ruta=$ruta;
        $this->libreria=$libreria;
        $this->estado=$estado;
    }

    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getTitulo() {
        return $this->titulo;
    }

    public function setTitulo($titulo) {
        $this->titulo = $titulo;
    }

    public function getAutor() {
        return $this->autor;
    }

    public function setAutor($autor) {
        $this->titulo = $autor;
    }

    public function getAbstract() {
        return $this->abstract;
    }

    public function setAbstract($abstract) {
        $this->abstract = $abstract;
    }

    public function getFecha() {
        return $this->fecha;
    }

    public function setFecha($fecha) {
        $this->fecha = $fecha;
    }

    public function getLibreria() {
        return $this->libreria;
    }

    public function setLibreria($libreria) {
        $this->titulo = $libreria;
    }

    public function getRuta() {
        return $this->ruta;
    }

    public function setRuta($ruta) {
        $this->titulo = $ruta;
    }

}