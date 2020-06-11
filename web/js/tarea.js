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

      /*  $.ajax({
           type: 'GET',
           url: 'nueva-ajax',
           success: function(respuesta){
                console.log(respuesta.redirect);
           }
        });*/
    })

    $('#Cancelar').click(function(){
        //se Desactivan los 3 botones de cancelar, guardar, Eliminar
        desactivarBotones();

        //desactivamos el texto textNuevaTarea
        $('#textNuevaTarea').attr("disabled", true);

        //activamos el boton NuevaTarea
        $('#nuevaTarea').attr("disabled", false);

        console.log('Hacemos click en cancelar');
    });

    $('#Guardar').click(function(){
        console.log('estamos en guardar '+ document.getElementById('textNuevaTarea').value);
        if(document.getElementById('textNuevaTarea').value){
          //se Desactivan los 3 botones de cancelar, guardar, Eliminar
          desactivarBotones();
          //se activa el boton de NuevaTarea
          $('#nuevaTarea').attr('disabled', false);

          //hacemos el insert en la tabla tareas
          console.log('el valor de nombre es: '+$('#textNuevaTarea').val());
          var json = {
            'nombreTarea':$('#textNuevaTarea').val()
          }
          $.ajax({
            type: 'GET',
            data: json,
            url: 'nueva-ajax',
            success:function(respuesta){
              console.log('retorna: '+respuesta);
              $('#gridTareas').html('');
              $('#gridTareas').html(respuesta);
              //se desactiva el texto y lo ponemos vacio
              $('#textNuevaTarea').val("");
              $('#textNuevaTarea').attr('disabled', true);
            }
          });

          console.log('Hacemos lo que tenemos que hacer');
        }else{
          console.log('Debe escribir un nombre a la tarea');
          $('#tareaVacia').html('<p class="alert alert-danger" role="alert">Debe escribir un nombre a la tarea</p>')
        }
        //comprobamos que no llegue vacio el nombre de la tareas
      /*  if($('#nombre').val){

      }*/
    });

    function desactivarBotones(){
      $('#Guardar').attr("disabled", true);
      $('#Cancelar').attr("disabled", true);
      $('#Eliminar').attr("disabled", true);
    }

})
