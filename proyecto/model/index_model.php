<?php


class index_model extends Odbc
{

    public function __construct() {}

    
    function getBibliotecas()
    {
        $sql = "select  b.id,b.nombre,b.descripcion,b.estado,c.id as id_categ,c.nombre as categoria,c.estado as est_cat
                from biblioteca b, categoria c 
                where b.estado='A' 
                and b.id_categ=c.id";
        $this->consultar($sql, __FUNCTION__);
    }

    function getCategorias()
    {
        $sql = "select  id, nombre, estado from categoria where estado='A'";
        $this->consultar($sql, __FUNCTION__);
    }

    function insertBiblioteca($nombre, $descripcion,$categoria,$estado)
    {
        $sql = "INSERT INTO biblioteca (nombre, descripcion, id_categ, estado) VALUES ('$nombre', '$descripcion', '$categoria', '$estado')";
        $this->ejecutar($sql, __FUNCTION__);
    }

     function updateBiblioteca($id, $nombre, $descripcion, $categoria)
    {
        $sql = "UPDATE biblioteca set nombre='$nombre', descripcion='$descripcion', id_categ='$categoria' where id=$id";
        $this->ejecutar($sql, __FUNCTION__);
    }

     function eliminarBiblioteca($id)
    {
        $sql = "UPDATE biblioteca set estado='I' where id=$id";
        $this->ejecutar($sql, __FUNCTION__);
    }

  
}
