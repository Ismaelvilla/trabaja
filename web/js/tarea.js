$(document).ready(function(){
    $('#nuevaTarea').click(function(){
        console.log('hacemos click');
        $.ajax({
           type: 'GET',
           url: 'nueva-ajax',
           success: function(e){

           }
        });
    })

})