$(document).ready(function(){
   $('#btnEnviar').on('click',function(e){
       console.log('pinchamos en enviar '+$('#nombre'));
       $('#mensajeVacio').html('');
       //paramos la propagación del boton submit
       e.preventDefault();
       if($('#nombre').val()){
           $.ajax({
               type:'POST',
               url:'/categorias/categoria-ajax',
               data: $('#categoriaForm').serialize(),
               success:function(respuesta){
                   console.log('Finalizamos bien '+respuesta.redirect);
                   window.location = respuesta.redirect;
               }
           });
       }else{

           $('#mensajeVacio').html('El valor Nombre no puede ser vacio');
       }
      /* */
   })
});