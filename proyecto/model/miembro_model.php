<?php


class miembro_model extends Odbc
{

    public function __construct() {}

    
    function getMiembro($alias,$email)
    {
        $sql = "select id,pri_nombre,seg_nombre,pri_apell,seg_apell
                from usuario 
                where email='$email' 
                and alias='$alias'";
                
        $this->consultar($sql, __FUNCTION__);
    }

  

    function insertMiembro($pnombre,$snombre, $papell, $sapell,$alias,$email)
    {
        $sql = "INSERT INTO usuario (pri_nombre, seg_nombre,pri_apell,seg_apell,email,alias) VALUES ('$pnombre','$snombre', '$papell', '$sapell','$alias','$email')";
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
