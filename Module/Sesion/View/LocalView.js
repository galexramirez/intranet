$(document).ready(function(){
    $(document).on("click", ".btn_ingresar_sesion", function(){
        location.reload();   
    });
    // Muestra u Oculta el Password
    $('#ShowPassword').click(function () {
        $('#user_pass').attr('type', $(this).is(':checked') ? 'text' : 'password');
    });
    
});

///:::::::: MOSTRAR U OCULTAR PASSWORD :::::::::::::::::///
function mostrarPassword(){
    var cambio = document.getElementById("user_pass");
    if(cambio.type == "password"){
        cambio.type = "text";
        $('.icon').removeClass('fa fa-eye-slash').addClass('fa fa-eye');
    }else{
        cambio.type = "password";
        $('.icon').removeClass('fa fa-eye').addClass('fa fa-eye-slash');
    }
} 

    