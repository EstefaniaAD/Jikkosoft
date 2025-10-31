<?php

class libro_view extends VistaBase
{

    function dibujar()
    {
?>
  <section id="actions" class="py-4 mb-4 bg-light">
        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    <a href="#" class="btn btn-primary btn-block" data-bs-toggle="modal" data-bs-target="#agregarlibroModal">
                        <i class="fas fa-plus"></i> Agregar Libro
                    </a>
                </div>
                
            </div>
        </div>
    </section>
<section class="libros">
    <div class="container">
        <div class="row">
            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">
                        <h4>Listado de Libros</h4>
                    </div>
                    <table class="table table-striped"><!-- table-striped para que agregue un estilo diferente a los elemntos de la tabla -->
                        <thead class="thead-dark">
                            <tr>
                                <th>#</th>
                                <th>T&iacute;tilo</th>
                                <th>Autor</th>
                                <th></th>
                            </tr>
                        </thead>  
                        <tbody>
                        <?php
                                $i = 0;
                                
                                foreach ($this->libros as $key => $reg) {

                                    $id = trim($reg->getId());
                                    $titulo = trim($reg->getTitulo());
                                    $autor=trim($reg->getAutor());
                                    
                                    ?> 
                                <tr>
                                    <td id='id<?php echo $id; ?>'><?php echo $id; ?> 
                                    <td id='titulo<?echo $id; ?>'><? echo $titulo; ?></td>
                                    <td id='autor<?echo $id; ?>'> <? echo $autor; ?></td>
                                    <td>
                                        <a href="#" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#editarLibroModal" onclick="cargarLibro(<?echo $id; ?>)">
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

<div class="modal fade" id="agregarLibroModal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-info text-white">
                <h5 class="modal-title">Agregar Libro</h5>
                <button class="btn-close" data-bs-dismiss="modal">
                </button>
            </div>
            
           <form action="" id='grabaLibro' method="POST" class="was-validated" enctype="multipart/form-data">
               
                <input type="hidden" id='id_biblioteca' name="id_biblioteca" value="<? echo $this->id_biblioteca; ?>">
                <input type="hidden" id='metodo' name="metodo" value="grabarLibro">
                <input type="hidden" id='controlador'name="controlador"  value="libro">

                <div class="modal-body">
                    <div class="form-group">
                        <label for="titulo">T&iacute;tulo</label>
                        <input type="text" name="titulo" id="titulo" class="form-control" required/>
                    </div>
                    <div class="form-group">
                        <label for="autor">Autor</label>
                        <input type="text" name="autor" id="autor" class="form-control" required/>
                    </div>
                    <div class="form-group">
                        <label for="fecha">Fecha</label>
                        <input type="text" class="form-control"  name="fecha" id="fecha" required />
                    </div>
                    <div class="form-group">
                        <label for="abstract">Abstract</label>
                        <textarea  name="abstract" id="abstract" class="form-control" required></textarea> 
                    </div>
                    <div class="form-group">
                        <label for="archivo">Archivo</label>
                        <input class="form-control" type="file" id="archivo" name="archivo" required/>
                    </div>
                    







                </div>
                <div class="modal-footer">
                    <a href="#" class="btn btn-primary " data-bs-dismiss="modal" onclick="guardarLibro()" >
                    Guardar
                    </a> 
                </div>
               

            </form> 
        </div>
        
    </div> 
</div>

<div class="modal fade" id="editarLibroModal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-info text-white">
                <h5 class="modal-title">Editar Biblioteca</h5>
                <button class="btn-close" data-bs-dismiss="modal">
                </button>
            </div>
            
           <form action="" id='editarLibro' method="POST" class="was-validated" enctype="multipart/form-data">
               
                <input type="hidden" id='id_biblioteca' name="id_biblioteca" value="<? echo $this->id_biblioteca; ?>">
                <input type="hidden" id='metodo' name="metodo" value="editarLibro">
                <input type="hidden" id='controlador'name="controlador"  value="libro">

                <div class="modal-body">
                    <div class="form-group">
                        <label for="tituloEdit">Nombre</label>
                        <input type="text" name="tituloEdit" id="tituloEdit" class="form-control" required/>
                    </div>
                   <div class="form-group">
                        <label for="autorEdir">Autor</label>
                        <input type="text" name="autorEdit" id="autorEdit" class="form-control" required/>
                    </div>
                    <div class="form-group">
                        <label for="fechaEdit">Fecha</label>
                        <input type="text" class="form-control"  name="fechaEdit" id="fechaEdit" required />
                    </div>
                    <div class="form-group">
                        <label for="abstractEdit">Abstract</label>
                        <textarea  name="abstractEdit" id="abstractEdit" class="form-control" required></textarea> 
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Archivo actual:</label><br>
                        <a href="uploads/documento.pdf" id="archivoAct" target="_blank">📄 documento.pdf</a>
                    </div>
                    <div class="form-group">
                        <label for="archivoEdit">Archivo (en caso de cambiar el actual)</label>
                        <input class="form-control" type="file" id="archivoEdit" name="archivoEdit" />
                    </div>
                    

                    <input type="hidden" name="idEdit" id="idEdit"  />
                    
                </div>
                <div class="modal-footer">
                   
                    <a href="#" class="btn btn-primary " data-bs-dismiss="modal" onclick="editarLibro()" >
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
    <form action="" id='eliminarLibro' method="POST" class="was-validated">
        <input type="hidden" id='id_biblioteca' name="id_biblioteca" value="<? echo $this->id_biblioteca; ?>">
        <input type="hidden" id='controlador'name="controlador"  value="libro">
      <div class="modal-header">
      <i class="fa-solid fa-triangle-exclamation" style="color: #FFD43B;"></i>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">

      ¿Esta seguro de eliminar este Libro?
      </div>
      <div class="modal-footer">
        <input type="hidden"id="eliminar"/>
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-primary" data-bs-dismiss="modal" onclick="eliminarLibro()" >Eliminar</button>
      </div> 
    </form>
    </div>
  </div>
</div>
<?php
    }
}
?>
</body>
    
    
<script>
$(function() {
  $('#fecha').datepicker({
    format: 'dd/mm/yyyy',
    language: 'es',
    autoclose: true,
    todayHighlight: true
  });
});
  </script>
  <script>
$(function() {
  $('#fecha').datepicker({
    format: 'dd/mm/yyyy',
    language: 'es',
    autoclose: true,
    todayHighlight: true
  });
});
  </script>