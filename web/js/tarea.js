$(document).ready(function(){

   //boton nuevaTarea
    $('#nuevaTarea').click(function(){
        console.log('hacemos click');
        //se activan los botones de Guardar y Cancelar
        $('#Guardar').attr("disabled", false);
        $('#Cancelar').attr("disabled", false);

        //se activa el campo de texto textNuevaTarea
        $('#textNuevaTarea').attr("disabled", false);

        //se desactiva el boton de NuevaTarea
        $('#nuevaTarea').attr("disabled", true);
    })
    //*********************** INICIO ACCIONES CANCELAR*************** //
    $('#Cancelar').click(function(){
        if($('#textNuevaTarea').val()){
            $('#modalCancelar').modal('show');
        }else{
            AccionesCancelar();
        }
    });

    $('#btnCancelarModalNo').click(function(){
        AccionesCancelar();
    });

    $('#btnCancelarModalSi').click(function(){
        $('#Guardar').click();
    });

    //Acciones llevadas a cabo cuando se cancela y no se guardan los cambios
    function AccionesCancelar(){
        //se Desactivan los 3 botones de cancelar, guardar, Eliminar
        estadoBotones(true);
        //desactivamos el texto textNuevaTarea
        $('#textNuevaTarea').attr("disabled", true);
        //ponemos vacio el textNueva Tareas
        $('#textNuevaTarea').val("");
        //activamos el boton NuevaTarea
        $('#nuevaTarea').attr("disabled", false);
        //este div tiene que estar vacio
        $('#tareaVacia').html('');
    }
    //************** FIN ACCIONES CANCELAR ******************//

    $('#Guardar').click(function(){
        $('#tareaVacia').html('');
        if(document.getElementById('textNuevaTarea').value){
            //se Desactivan los 3 botones de cancelar, guardar, Eliminar
            estadoBotones(true);
            //se activa el boton de NuevaTarea
            $('#nuevaTarea').attr('disabled', false);
            //hacemos el insert en la tabla tareas, mediante ajax
            var json = {
              'nombreTarea':$('#textNuevaTarea').val()
            }
            $.ajax({
              type: 'GET',
              data: json,
              url: 'nueva-ajax',
              success:function(respuesta){
                $('#gridTareas').html('');
                $('#gridTareas').html(respuesta);
                //se desactiva el texto y lo ponemos vacio
                $('#textNuevaTarea').val("");
                $('#textNuevaTarea').attr('disabled', true);
              }
            });
        }else{
            $('#tareaVacia').html('<p class="alert alert-danger" role="alert">Debe escribir un nombre a la tarea</p>')
        }
    });

    function estadoBotones(estado){
        //si es true se desactivan los botones, si es false se activan
        $('#Guardar').attr("disabled", estado);
        $('#Cancelar').attr("disabled", estado);
        $('#Eliminar').attr("disabled", estado);
    }

    //cada vez que se haga click en un checkbox comprobamos que
    // si hay alguno seleccionado los botones estaran activados y
    //si no hay ninguno seleccionado los botones estaran desactivados
    $('#gridTareas').on('click', '.check', function(e){
        var activaBotones = false;
        //recorremos todos los checkbox
        $(".check").each(function () {
          //sacamos su atributo id
          var id = this.id;
          if( $('#'+id).prop('checked') ){
            activaBotones = true;
          }

        });
        // si activaBotones es false se desactivan los botones
        if( activaBotones == false ){
          estadoBotones(true);
        }else{
          //activamos los activaBotones
          estadoBotones(false);
        }    
    });

    //boton de Eliminar
    $('#eliminarModal').click(function(){
        var seleccionados = '';
        //recorremos tods los checkbox para ver los que estan $seleccionados
        //los metemos en un string separados por el simbolo |
        $('.check').each(function(){
            var id = this.id;
            if( $('#'+id).prop('checked') ){
                seleccionados += id +'|';
            }
        });
        //creamos la variable json que es la que vamos a pasar por ajax
        var json={
            'seleccionados': seleccionados
        }
        $.ajax({
            method : 'GET',
            url: 'eliminar-ajax',
            data: json,
            success: function(respuesta){
                $('#gridTareas').html('');
                $('#gridTareas').html(respuesta);
            }
        })
    });

})
