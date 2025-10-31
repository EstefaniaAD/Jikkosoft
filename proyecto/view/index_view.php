<?php

class index_view extends VistaBase
{

    function dibujar()
    {
?>

    <section id="actions" class="py-4 mb-4 bg-light">
        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    <a href="#" class="btn btn-primary btn-block" data-bs-toggle="modal" data-bs-target="#agregarBibliotecaModal">
                        <i class="fas fa-plus"></i> Agregar Biblioteca
                    </a>
                </div>
                <div class="col-md-4">
                    <a href="#" onclick="visor()" class="btn btn-primary btn-block" >
                        <i class="fas fa-plus"></i> Visor Miembros
                    </a>
                </div> 
                
            </div>
        </div>
    </section>
<section class="bibliotecas">
    <div class="container">
        <div class="row">
            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">
                        <h4>Listado de Bibliotecas</h4>
                    </div>
                    <table class="table table-striped"><!-- table-striped para que agregue un estilo diferente a los elemntos de la tabla -->
                        <thead class="thead-dark">
                            <tr>
                                <th>#</th>
                                <th>Nombre</th>
                                <th>Categoria</th>
                                <th></th>
                            </tr>
                        </thead>  
                        <tbody>
                        <?php
                                $i = 0;
                                
                                foreach ($this->bibliotecas as $key => $reg) {

                                    $id = trim($reg->getId());
                                    $nombre = trim($reg->getNombre());
                                    $descripcion=trim($reg->getDescripcion());
                                    $categoria = trim($reg->getCategoria()->getNombre());
                                    $id_categ = trim($reg->getCategoria()->getId());
                                    
                                    ?> 
                                <tr>
                                    <td id='id<?php echo $id; ?>'><?php echo $id; ?> 
                                    <input type="hidden" id='descripcion<?echo $id; ?>' value="<? echo $descripcion?>"></td>
                                    <td id='nombre<?echo $id; ?>'><? echo $nombre; ?></td>
                                    <td id='categoria<?echo $id; ?>'> <? echo $categoria; ?></td>
                                    <td>
                                        <a href="#" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#editarBibliotecaModal" onclick="cargarBiblioteca(<?echo $id; ?>,<?echo $id_categ; ?>)">
                                            <i class="fas fa-angle-double-right"></i> Editar

                                        </a>
                                        
                                    </td>
                                    <td>
                                      
                                        <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#confirmModal"  onclick="idElim(<?echo $id; ?>)">
                                        <i class="fa-solid fa-trash-can"></i>
                                        </button>
                                    </td>
                                </tr>    
                                <?php
                                }
                                    ?> 
                        </tbody>
                    </table>
                </div>
            </div>

           

             

            </div>
        </div>

    </div>
</section>

<div class="modal fade" id="agregarBibliotecaModal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-info text-white">
                <h5 class="modal-title">Agregar Biblioteca</h5>
                <button class="btn-close" data-bs-dismiss="modal">
                </button>
            </div>
            
           <form action="" id='grabaBiblioteca' method="POST" class="was-validated">
               
               
                <div class="modal-body">
                    <div class="form-group">
                        <label for="nombre">Nombre</label>
                        <input type="text" name="nombre" id="nombre" class="form-control" required/>
                    </div>
                    <div class="form-group">
                        <label for="descripcion">Descripci&oacute;n</label>
                        <input type="text" name="descripcion" id="descripcion" class="form-control" required/>
                    </div>
                    <div class="form-group">
                        <label for="categoria">Categor&iacute;a</label>
                        <select id="categoria" class="form-select">

                         <?php
                                
                                foreach ($this->categorias as $key => $reg) {

                                    $id = trim($reg->getId());
                                    $nombre = trim($reg->getNombre());
                                   
                                    
                                    ?> 
                            
                            <option value="<?echo $id?>"><? echo $nombre;?></option>
                          <?    } ?>
                        </select>
                    </div>
                    
                </div>
                <div class="modal-footer">
                    <a href="#" class="btn btn-primary " data-bs-dismiss="modal" onclick="guardarBiblioteca()" >
                    Guardar
                    </a> 
                </div>
               

            </form> 
        </div>
        
    </div> 
</div>

<div class="modal fade" id="editarBibliotecaModal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-info text-white">
                <h5 class="modal-title">Editar Biblioteca</h5>
                <button class="btn-close" data-bs-dismiss="modal">
                </button>
            </div>
            
           <form action="" id='editarBiblioteca' method="POST" class="was-validated">
               
               
                <div class="modal-body">
                    <div class="form-group">
                        <label for="nombreEdit">Nombre</label>
                        <input type="text" name="nombreEdit" id="nombreEdit" class="form-control" required/>
                    </div>
                    <div class="form-group">
                        <label for="descripcionEdit">Descripci&oacute;n</label>
                        <input type="text" name="descripcionEdit" id="descripcionEdit" class="form-control" required/>
                    </div>
                    <div class="form-group">
                        <label for="categoriaEdit">Categor&iacute;a</label>
                        <select id="categoriaEdit" class="form-select">

                         <?php
                                
                                foreach ($this->categorias as $key => $reg) {

                                    $id = trim($reg->getId());
                                    $nombre = trim($reg->getNombre());
                                   
                                    
                                    ?> 
                            
                            <option value="<?echo $id?>"><? echo $nombre;?></option>
                          <?    } ?>
                        </select>
                    </div>
                    

                    <input type="hidden" name="idEdit" id="idEdit"  />
                    
                </div>
                <div class="modal-footer">
                    <a href="#" class="btn btn-primary " data-bs-dismiss="modal" onclick="verLibros()" >
                    Libros
                    </a> 
                    <a href="#" class="btn btn-primary " data-bs-dismiss="modal" onclick="editarBiblioteca()" >
                    Guardar
                    </a> 
                </div>
               

            </form> 
        </div>
        
    </div> 
</div>

<div class="modal fade" id="agregarRickandMortyModal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-info text-white">
                <h5 class="modal-title">Personales Rick and Morty</h5>
                <button class="btn-close" data-bs-dismiss="modal">
                </button>
            </div>
            
           <form action="" method="POST" class="was-validated">
               
               
                <div class="modal-body">
                    <div class="form-group">
                        <label for="idRickandMorty">ID (ejem:631)</label>
                        <input type="text" name="idRickandMorty" id="idRickandMorty" class="form-control" required/>
                    </div>
                   
                    
                </div>

               
                <div class="modal-body">
                <center>
                    <div class="mx-auto">
                        <h1 id="labelRickandMorty"></h1>
                        <br>
                        <img src="" id="imgRickandMorty" />
                    </div>
                </center>
                <div id="carouselExampleSlidesOnly" class="carousel slide" data-bs-ride="carousel">
  <div class="carousel-inner">
    <!--<div class="carousel-item active">
      <img src="https://rickandmortyapi.com/api/character/avatar/1.jpeg" class="d-block w-100" alt="...">
    </div>
    <div class="carousel-item">
      <img src="https://rickandmortyapi.com/api/character/avatar/2.jpeg" class="d-block w-100" alt="...">
    </div>
    <div class="carousel-item">
      <img src="https://rickandmortyapi.com/api/character/avatar/3.jpeg" class="d-block w-100" alt="...">
    </div>-->
  </div>
</div>
                </div>
                <div class="modal-footer">
                    <a href="#" class="btn btn-primary btn-block" onclick="rickandMorty()" >
                     Consultar
                    </a> 
                </div>
                

            </form> 
        </div>
        
    </div> 
</div>

<div class="alert alert-danger col-md-4" role="alert" id="error" >
  Debe ingresar todos los campos!
</div>

<div class="modal fade" id="confirmModal" tabindex="-1" aria-labelledby="confirmModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
      <i class="fa-solid fa-triangle-exclamation" style="color: #FFD43B;"></i>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">

      ¿Esta seguro de eliminar esta Bilioteca?
      </div>
      <div class="modal-footer">
        <input type="hidden"id="eliminar"/>
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-primary" data-bs-dismiss="modal" onclick="eliminarBiblioteca()" >Eliminar</button>
      </div> 
    </div>
  </div>
</div>
<?php
    }
}
?>


</body>