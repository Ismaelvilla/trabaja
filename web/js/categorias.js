$(document).ready(function(){
   $('#categoriaForm').on('change', function(){
        console.log('funiona '+$('#categoriaForm').serialize());
       $('#mensajeVacio').html('');
       if($('#nombre').val()){
           $.ajax({
               type:'POST',
               url:'/categorias/categoria-ajax',
               data: $('#categoriaForm').serialize(),
               success:function(respuesta){
                   console.log('Finalizamos bien '+respuesta.redirect);
                  // window.location = respuesta.redirect;
               }
           });
       }else{
           $('#mensajeVacio').html('<span class="badge badge-pill badge-danger">El valor Nombre no puede ser vacio</span>');
       }
   });

   $('#activo').on('click',function(){
       $('#cajaActivada').hide();
       $('#cajaDesactivada').hide();

       if( $('#activo').is(':checked') ) {
           $('#etiquetaEstado').html('<span class="badge badge-pill badge-success">Activado</span>');
           $('#cajaActivada').show();
       }else{
           $('#etiquetaEstado').html('<span class="badge badge-pill badge-danger">Desactivado</span>');
           $('#cajaDesactivada').show();
       }
   })

});