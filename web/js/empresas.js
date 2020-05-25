$(document).ready(function(){
    $('#deleteButton').click(function(){
        console.log('hemos pulsado eliminar');
        $.ajax({
            type: 'DELETE',
            dataType: 'json',
            success: function(respuesta){
                console.log('Finalizo correctamente '+respuesta.redirect);
                window.location = respuesta.redirect;
            }
        });
    });

    $('#notificationForm').on('change',function(){
        console.log('se modificaa'+$(this).serialize());
        $.ajax({
           type: 'POST',
           dataType: 'json',
           data: $(this).serialize(),
           success: function(respuesta){
               console.log('hemos terminado: '+respuesta.redirect);
           }
        });
    });

});