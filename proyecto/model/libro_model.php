<?php


class libro_model extends Odbc
{

    public function __construct() {}

    
    function getLibros($id_biblioteca)
    {
        $sql = "select id,titulo,autor,fecha,abstract,archivo
                from libro 
                where estado='A' 
                and id_bibli='$id_biblioteca'";
        $this->consultar($sql, __FUNCTION__);
    }

  

    function insertLibro($titulo,$autor, $abstract,$fecha,$destino,$d_bibli,$estado)
    {
        $sql = "INSERT INTO libro (titulo, autor,abstract,fecha,archivo,id_bibli, estado) VALUES ('$titulo', '$autor', '$abstract','$fecha','$destino','$d_bibli', '$estado')";
        $this->ejecutar($sql, __FUNCTION__);
    }

     function getLibro($id)
    {
        $sql = "select *
                from libro 
                where estado='A' 
                and id='$id'";
        $this->consultar($sql, __FUNCTION__);
    }

     function updateLibro($id,$titulo,$autor, $abstract,$fecha,$destino,$id_bibli,$estado)
    {
        if(trim($destino)!='')
            $sql = "UPDATE libro set titulo='$titulo', autor='$autor',abstract='$abstract',fecha='$fecha',archivo='$destino' where id='$id'";
        else
            $sql = "UPDATE libro set titulo='$titulo', autor='$autor',abstract='$abstract',fecha='$fecha' where id='$id'";

        $this->ejecutar($sql, __FUNCTION__);
    }

    function eliminarLibro($id)
    {
        $sql = "UPDATE libro set estado='I' where id='$id'";
        $this->ejecutar($sql, __FUNCTION__);
    }

     


}
