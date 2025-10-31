
function rickandMorty(){
    $.ajax({
        url: 'index.php',
        type: 'post',
        dataType: 'json',
        data: {metodo: 'rickandMorty',id: $("#idRickandMorty").val()},
        success: function(data) {
         
         $("#labelRickandMorty").text(data['name']);
         $("#imgRickandMorty").attr('src', data['image']);
         
        },
        error: function(data) {
         
        }
       });
       rickandMortyCarrusel();
}

function rickandMortyCarrusel(){
    $.ajax({
        url: 'index.php',
        type: 'post',
        dataType: 'html',
        data: {metodo: 'rickandMortyCarrusel'},
        success: function(data) {
        /* alert(data);
         $('.carousel-inner').append(
            data          );

          /*  $('.carousel-inner').append(
                "<div class='carousel-item active'><img src='https://rickandmortyapi.com/api/character/avatar/1.jpeg' class='d-block w-100' alt=''></div>"
              )*/
         
        },
        error: function(data) {
         
        }
       });
}

function guardarBiblioteca(){

    if($("#nombre").val()=='' || $("#descripcion")=='' || $("#categoria").val()==''){
        $('#error').show();
        setTimeout(function() {
            $("#error").hide(1000);
            }, 2000);
        return;
    }
    $.ajax({
        url: 'index.php',
        type: 'post',
        dataType: 'json',
        data: {metodo: 'grabarBiblioteca',nombre: $("#nombre").val(),descripcion: $("#descripcion").val() ,categoria: $("#categoria").val() },
        success: function(data) { 
            $("#grabaBiblioteca").submit() ;
        },
        
        error: function(data) { 
         
        }
       });
}

function eliminarBiblioteca(){

    $.ajax({
        url: 'index.php',
        type: 'post',
        dataType: 'json',
        data: {metodo: 'eliminarBiblioteca',id: $("#eliminar").val()},
        success: function(data) { 
            $("#grabaBiblioteca").submit() ;
        },
        
        error: function(data) { 
         
        }
       });
}

function idElim(id){
    $("#eliminar").val(id);
}

function cargarBiblioteca(id,id_categ){
    $("#nombreEdit").val( $("#nombre"+id).text());
    $("#descripcionEdit").val( $("#descripcion"+id).val());
    $("#categoriaEdit").val( id_categ);
    $("#idEdit").val( $("#id"+id).text());

}

function editarBiblioteca(){

    if($("#nombreEdit").val()=='' || $("#descripcionEdit").val()=='' || $("#categoriaEdit").val()=='' ){
        $('#error').show();
        setTimeout(function() {
            $("#error").hide(1000);
            }, 2000);
        return;
    }
    $.ajax({
        url: 'index.php',
        type: 'post',
        dataType: 'json',
        data: {metodo: 'editarBiblioteca',id: $("#idEdit").val(),nombre: $("#nombreEdit").val(),descripcion: $("#descripcionEdit").val() ,categoria: $("#categoriaEdit").val()   },
        success: function(data) { 
            $("#editarBiblioteca").submit() ;
        },
        
        error: function(data) { 
         
        }
       });
}

function verLibros(id_bibl){ 
  /*  $("#nombreEdit").val( $("#nombre"+id).text());
    $("#descripcionEdit").val( $("#descripcion"+id).val());
    $("#categoriaEdit").val( id_categ);
    $("#idEdit").val( $("#id"+id).text());

    const ventanaNombre = 'popupDatos';

  const url = 'index.php'; // Cambia por tu ruta real
*/
  // Abre una ventana vacía con ese nombre
  window.open('', 'libros', 'width=800,height=600');

  // Crea un formulario dinámico
  const $form = $('<form>', {
    method: 'POST',
    action: 'index.php',
    target: 'libros'
  });

  // Agrega los parámetros ocultos
  $form.append($('<input>', { type: 'hidden', name: 'id_biblioteca', value: $("#idEdit").val() }));
  $form.append($('<input>', { type: 'hidden', name: 'metodo', value: 'index' }));
  $form.append($('<input>', { type: 'hidden', name: 'controlador', value: 'libro' }));
  /*
  $form.append($('<input>', { type: 'hidden', id_biblioteca: $("#id"+id).text()}));
  $form.append($('<input>', { type: 'hidden', metodo: 'obtenerLibros'}));
  $form.append($('<input>', { type: 'hidden', name: 'token', value: 'abcde9876' }));*/

  // Añade el form temporalmente al body
  $form.appendTo('body');

  // Envía el formulario (abre la ventana con los datos POST)
  $form.trigger('submit');

  // Elimina el formulario del DOM
  $form.remove();
}

function guardarLibro(){
   

    if($("#titulo").val()=='' || $("#autor")=='' || $("#fecha").val()==''|| $("#abstract").val()==''|| $("#abstract").val()==''){
        $('#error').show();
        setTimeout(function() {
            $("#error").hide(1000);
            }, 2000);
        return;
    }
  
    $("#grabaLibro").submit() ;
     
}

function cargarLibro(id){


     $.ajax({
        url: 'index.php',
        type: 'post',
        dataType: 'json',
        data: {metodo: 'infoLibro',controlador: 'libro',id: id },
        success: function(data) { 
            $("#idEdit").val( $("#id"+id).text());
            $("#tituloEdit").val(data.titulo);
            $("#autorEdit").val(data.autor);
            $("#fechaEdit").val(data.fecha);
            $("#abstractEdit").val(data.abstract);
            $('#archivoAct').attr('href', data.archivo);
            let nombre = data.archivo.substring(data.archivo.lastIndexOf('/')+1);
            $('#archivoAct').text(nombre);
        },
        
        error: function(data) { 
            
        }
       });

}

function editarLibro(){

    if($("#tituloEdit").val()=='' || $("#autorEdit").val()=='' || $("#fechaEdit").val()=='' || $("#abstractEdit").val()=='' ){
        $('#error').show();
        setTimeout(function() {
            $("#error").hide(1000);
            }, 2000);
        return;
    }
    
    $("#editarLibro").submit() ;
}

function eliminarLibro(){

    $.ajax({
        url: 'index.php',
        type: 'post',
        dataType: 'json',
        data: {metodo: 'eliminarLibro',controlador: 'libro',id: $("#eliminar").val()},
        success: function(data) { 
            $("#eliminarLibro").submit() ;
        },
        
        error: function(data) { 
         
        }
       });
}

function visor(){ 
 
  window.open('', 'visor','width=800,height=600');

  const $form = $('<form>', {
    method: 'POST',
    action: 'index.php',
    target: 'visor'
  });

  $form.append($('<input>', { type: 'hidden', name: 'metodo', value: 'visor' }));
 
  $form.appendTo('body');

  $form.trigger('submit');

  $form.remove();
}

function visorLibros(idLib){ 
 
  window.open('', 'visorLibros','width=800,height=600');

  const $form = $('<form>', {
    method: 'POST',
    action: 'index.php',
    target: 'visorLibros'
  });

  $form.append($('<input>', { type: 'hidden', name: 'metodo', value: 'visorLibros' }));
  $form.append($('<input>', { type: 'hidden', name: 'controlador', value: 'libro' }));
  $form.append($('<input>', { type: 'hidden', name: 'idLib', value: idLib }));
 
  $form.appendTo('body');

  $form.trigger('submit');

  $form.remove();
}

function validarMiembro(){

     $.ajax({
        url: 'index.php',
        type: 'post',
        dataType: 'json',
        data: {metodo: 'validar',controlador: 'miembro',email: $("#email").val(),alias:$("#usuario").val() },
        success: function(data) { 

            if(data.existe==1){
                $('#validarMiembroModal').modal('hide');
                $('.libros').show();
            }else{
                 $('#validarMiembroModal').modal('hide');
                 $('#agregarMiembroModal').modal('show');
            }
            
        },
        
        error: function(data) { 
            
        }
       });

}
/*
function validarSuscripcion(idUsu,idBibl){


     $.ajax({
        url: 'index.php',
        type: 'post',
        dataType: 'json',
        data: {metodo: 'validarSuscripcion',controlador: 'miembro',idUsu: idUsu,idBibl:idBibl },
        success: function(data) { 

            if(data.existe==1){
                $('#validarMiembroModal').modal('hide');
                $('.libros').show();
            }else{
                 $('#validarMiembroModal').modal('hide');
                 $('#suscribirMiembroModal').modal('show');
            }
            
        },
        
        error: function(data) { 
            
        }
       });

}*/


function guardarMiembro(){
   

    if($("#pnombreg").val()=='' || $("#papellg")=='' || $("#sapellg")==''|| $("#emailg").val()==''|| $("#usuariog").val()==''){
        $('#error').show();
        setTimeout(function() {
            $("#error").hide(1000);
            }, 2000);
        return;
    }
  
    $.ajax({
        url: 'index.php',
        type: 'post',
        dataType: 'json',
        data: {metodo: 'grabarMiembro',controlador: 'miembro',pnombre:$("#pnombreg").val(),snombre:$("#snombreg").val(),papell:$("#papellg").val(),sapell:$("#sapellg").val(),email:$("#emailg").val(),usuario: $("#usuariog").val() },
        success: function(data) { 
            $('.libros').show();
        },
        
        error: function(data) { 
        }
       });
    
     
}

