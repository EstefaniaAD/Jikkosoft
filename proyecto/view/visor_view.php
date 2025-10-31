<?php

class visor_view extends VistaBase
{

    function dibujar()
    {
       ?>
<table border="0" id="table_visor_noticias" class="dt-responsive" style="width:80%">
<tbody>
        <?php                             
        foreach ($this->bibliotecas as $key => $reg) {

            $id = trim($reg->getId());
            $nombre = trim($reg->getNombre());
            $descripcion=trim($reg->getDescripcion());
            $categoria = trim($reg->getCategoria()->getNombre());
            $id_categ = trim($reg->getCategoria()->getId());
                                    
   ?> 

<tr>
<td colspan="2"><hr></td></tr><tr><td style="text-align:center" width="20%">
<div class="play_noticias" onclick="visorLibros(<? echo $id_categ;?>);" style="cursor: pointer;">
<i class="fa-solid fa-swatchbook fa-fade fa-3x azul " ></i>
</div>
</td>
<td style="text-align:left" width="80%">
<div class="azul">
<p style="font-size:31px" >
    <strong><? echo $nombre;?></strong>
</p>
<? echo $descripcion;?>
<br><p><strong><? echo $categoria;?></strong>
</p>
<p style="font-size:12px">

</p>
<p></p></div></td></tr>


<?php
    }
?>
</tbody></table>
<?php
}
}
?>
</body>
    