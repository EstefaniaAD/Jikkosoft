<?php

class visorLibro_view extends VistaBase
{

    function dibujar()
    {
?>
  

            <table border="0" id="table_visor_noticias" class="dt-responsive" style="width:80%">
            <tbody>
                        <?php
                                $i = 0;
                                
                                foreach ($this->libros as $key => $reg) {

                                    $id = trim($reg->getId());
                                    $titulo = trim($reg->getTitulo());
                                    $abstract=trim($reg->getAbstract());
                                    $fecha=trim($reg->getFecha());
                                    $autor=trim($reg->getAutor());
                                    $idLib=trim($reg->getLibreria());
                                    $archivo=trim($reg->getRuta());
                                    $nombre = substr($archivo, strrpos($archivo, '/') + 1);
                                    
                                    ?> 
                                <tr>
<td colspan="2"><hr></td></tr><tr><td style="text-align:center" width="20%">
<div class="play_noticias"  style="cursor: pointer;">
<a href="#" data-bs-toggle="modal" data-bs-target="#validarMiembroModal">

<i class="fa-solid fa-receipt fa-fade fa-3x azul"></i>
</a>
</div>
</td>
<td style="text-align:left" width="80%">
<div class="azul">
<p style="font-size:31px" >
    <strong><? echo $titulo;?></strong>
</p>
<? echo $abstract;?>
<br>
<a href="<? echo $archivo;?>" id='<? echo $id;?>' class='libros' style="display: none"><? echo $nombre;?></a>
<p><strong><? echo "Autor: $autor, Fecha: $fecha";?></strong>
</p>
<p style="font-size:12px">

</p>
<p></p></div></td></tr>
   
                                <?php
                                }
                                    ?> 
                        </tbody>
                    </table>
                

<div class="modal fade" id="validarMiembroModal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-info text-white">
                <h5 class="modal-title">Validar Suscripci&oacute;n</h5>
                <button class="btn-close" data-bs-dismiss="modal">
                </button>
            </div>
            
           <form action="" id='grabaLibro' method="POST" class="was-validated" enctype="multipart/form-data">
               
                <input type="hidden" id='id_biblioteca' name="id_biblioteca" value="<? echo $this->id_biblioteca; ?>">
                
                <div class="modal-body">
                    <div class="form-group">
                        <label for="usuario">Usuario</label>
                        <input type="text" name="usuario" id="usuario" class="form-control" required/>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="text" name="email" id="email" class="form-control" required/>
                    </div>
                    
                </div>
                <div class="modal-footer">
                    <a href="#" class="btn btn-primary " data-bs-dismiss="modal" onclick="validarMiembro()" >
                    Guardar
                    </a> 
                </div>
               

            </form> 
        </div>
        
    </div> 
</div>

<div class="modal fade" id="agregarMiembroModal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-info text-white">
                <h5 class="modal-title">Suscripci&oacute;n</h5>
                <button class="btn-close" data-bs-dismiss="modal">
                </button>
            </div>
            
           <form action="" id='grabaMiembro' method="POST" class="was-validated">
               
                <input type="hidden" id='id_biblioteca' name="id_biblioteca" value="<? echo $idLib; ?>">
                <input type="hidden" id='metodo' name="metodo" value="grabarMiembro">
                <input type="hidden" id='controlador'name="controlador"  value="miembro">

                <div class="modal-body">
                    <div class="form-group">
                        <label for="pnombreg">Primer Nombre </label>
                        <input type="text" name="pnombreg" id="pnombreg" class="form-control" required/>
                    </div>
                    <div class="form-group">
                        <label for="snombreg">Segundo Nombre </label>
                        <input type="text" name="snombreg" id="snombreg" class="form-control" required/>
                    </div>
                    <div class="form-group">
                        <label for="papellg">Primer Apellido </label>
                        <input type="text" class="form-control"  name="papellg" id="papellg" required />
                    </div>
                    <div class="form-group">
                        <label for="sapellg">Segundo Apellido</label>
                        <input type="text" class="form-control"  name="sapellg" id="sapellg" required />
                    </div>
                    <div class="form-group">
                        <label for="usuariog">Usuario</label>
                        <input type="text" class="form-control"  name="usuariog" id="usuariog" required />
                    </div>
                    <div class="form-group">
                        <label for="emailg">Email</label>
                        <input type="text" class="form-control"  name="emailg" id="emailg" required />
                    </div>
                    







                </div>
                <div class="modal-footer">
                    <a href="#" class="btn btn-primary " data-bs-dismiss="modal" onclick="guardarMiembro()" >
                    Guardar
                    </a> 
                </div>
               

            </form> 
        </div>
        
    </div> 
</div>




<?php
    }
}
?>
 <div class="alert alert-danger col-md-4" role="alert" id="error" >
  Debe ingresar todos los campos!
</div>


</body>
    
