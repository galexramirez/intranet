///::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
///::::::::::::::::::: AJUSTE USUARIO v 1.0 FECHA: 15-11-2022 :::::::::::::::::::::::::::::///
///:::::::::::::::::::::  EDITAR COLABORADORES Y USUARIO ::::::::::::::::::::::::::::::::::///
///::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///

///::::::::::::::::::::::::::::::: Declaracion de Variables :::::::::::::::::::::::::::::::///

var opcionAjusteUsuario, fotoEditar, foto;
foto = "";
opcionAjusteUsuario = 2;
///::::::::::::::: JS CARGA DE DATA TABLE :::::::::::::://
$(document).ready(function(){
    // Muestra u Oculta el Password
    $('#ShowPassword').click(function () {
		$('#Usua_Password').attr('type', $(this).is(':checked') ? 'text' : 'password');
	});

    $("#btnGuardarAjusteUsuario").hide();

    Accion='CargarAjusteUsuario';
    $.ajax({
        url: "Ajax.php",
        type: "POST",
        datatype:"json",    
        async: false,
        data:  { MoS:MoS,NombreMoS:NombreMoS,Accion:Accion},    
        success: function(data) {
            data = $.parseJSON(data);
            $.each(data, function(idx, obj){ 
              Colaborador_id = obj.Colaborador_id;    
              Colab_ApellidosNombres = obj.Colab_ApellidosNombres;
              Colab_CargoActual = obj.Colab_CargoActual;    
              Colab_Estado = obj.Colab_Estado;    
              Colab_FechaIngreso = obj.Colab_FechaIngreso;
              Colab_FechaCese = obj.Colab_FechaCese;  
              Colab_Email = obj.Colab_Email;
              Colab_Direccion = obj.Colab_Direccion;
              Colab_Distrito = obj.Colab_Distrito;
              Colab_CodigoCortoPT = obj.Colab_CodigoCortoPT;
              Colab_PerfilEvaluacion = obj.Colab_PerfilEvaluacion;
              Usua_NombreCorto = obj.Usua_NombreCorto;
              Usua_Password = obj.Usua_Password;
              Usua_UsuarioWeb = obj.Usua_UsuarioWeb;
              $("#Colaborador_id").val(Colaborador_id);
              $("#Colab_ApellidosNombres").val(Colab_ApellidosNombres);
              $("#Colab_CargoActual").val(Colab_CargoActual);
              $("#Colab_FechaIngreso").val(Colab_FechaIngreso);
              $("#Colab_Email").val(Colab_Email);
              $("#Colab_Direccion").val(Colab_Direccion);
              $("#Colab_Distrito").val(Colab_Distrito);
              $("#Colab_CodigoCortoPT").val(Colab_CodigoCortoPT);
              $("#Colab_PerfilEvaluacion").val(Colab_PerfilEvaluacion);
              $("#Usua_NombreCorto").val(Usua_NombreCorto);
              $("#Usua_UsuarioWeb").val(Usua_UsuarioWeb);
              $("#Usua_Password").val(Usua_Password);
            });
        }
    });

    foto=f_BuscarFotografia(Colaborador_id);
    if(foto==""){
        fotoEditar='<img src="data:image/jpg;base64," height="340px" width="340px" alt="" />';        
    }else{
        fotoEditar='<img src="' + foto + '" height="340px" width="340px" alt="" />';
    }
    $("#div_FotografiaAjusteUsuario").html(fotoEditar);

    /// ::::::::::::::: CREA Y EDITA USUARIO :::::::::::::///
    $('#formAjusteUsuario').submit(function(e){                         
        e.preventDefault(); //evita el comportambiento normal del submit, es decir, recarga total de la página
        let validacion = "";

        Usua_Password = $.trim($('#Usua_Password').val());    
    
        validacion=f_validar(Usua_Password);

        if(validacion=="invalido"){
            Swal.fire({
                position: 'center',
                icon: 'error',
                title: '*Falta Completar Información!!!',
                showConfirmButton: false,
                timer: 1500
              })
        }else{
            /// EDITAR
            if(opcionAjusteUsuario = 2) {   
                Accion='EditarAjusteUsuario';
                $("#btnGuardarAjusteUsuario").prop("disabled",true);
                $.ajax({
                    url: "Ajax.php",
                    type: "POST",
                    datatype:"json",    
                    data:  { MoS:MoS,NombreMoS:NombreMoS,Accion:Accion,Usua_Password:Usua_Password},    
                    success: function(data) {
                        f_LimpiaMs();
                    }
                });
            } 
            $("#btnGuardarAjusteUsuario").prop("disabled",false);
            $("#btnGuardarAjusteUsuario").hide();
            $("#btnEditarAjusteUsuario").show();
            $("#Usua_Password").prop("disabled",true);
            $("#show_password").prop("disabled",true);
        }
    });
});    


///:::::::::::::::::::::::::::::::::: BOTONES DE MAESTRO UNO :::::::::::::::::::::::::::::::///
$("#btnCancelarAjusteUsuario").click(function(){
    f_LimpiaMs();
    $("#Usua_Password").prop("disabled",true);
    $("#show_password").prop("disabled",true);
    $("#btnEditarAjusteUsuario").show();
    $("#btnGuardarAjusteUsuario").hide();
});

$("#btnEditarAjusteUsuario").click(function(){
    f_LimpiaMs();
    $("#Usua_Password").prop("disabled",false);
    $("#show_password").prop("disabled",false);
    $("#btnEditarAjusteUsuario").hide();
    $("#btnGuardarAjusteUsuario").show();
    
});

///:::::::::::::::::::::::::::::::::: FUNCIONES DE MAESTRO UNO :::::::::::::::::::::::::::::::///

///::::::: FUNCION PARA VALIDAR LOS DATSO INGRESADOS AL FORMULARIO :::::::::::::::::::///
function f_validar(Usua_Password){
    f_LimpiaMs();
    let respuesta="";    

    if(Usua_Password==""){
        $("#Usua_Password").addClass("color-error");
        respuesta="invalido";
    }
    return respuesta; 
}

///::::::::: INVISIBILIZA LOS MENSAJE DE ALERTA DEL FORMULARIO :::::: /// 
function f_LimpiaMs(){
    var cambio = document.getElementById("Usua_Password");
    cambio.type = "password";
    $('.icon').removeClass('fa fa-eye').addClass('fa fa-eye-slash');
    $('#Usua_Password').attr('type', $(this).is(':checked') ? 'text' : 'password');

    $("#Usua_Password").removeClass("color-error");
}

///::::::::: BUSCAR FOTOGRAFIA ::::::::::::::::::::::///       
function f_BuscarFotografia(){
    let img="";
    Accion='BuscarFotografia';
    $.ajax({
        url: "Ajax.php",
        type: "POST",
        datatype:"json",    
        async: false,   
        data:  { MoS:MoS,NombreMoS:NombreMoS,Accion:Accion },   
        success: function(data) {
            data = $.parseJSON(data);
            $.each(data, function(idx, obj){ 
                if(obj.b64_Foto){
                    img  = 'data:image/jpg;base64,' + obj.b64_Foto;
                }
            });
        }
    });	
    return img;
}

///:::::::: MOSTRAR U OCULTAR PASSWORD :::::::::::::::::///
function f_mostrarPassword(){
    var cambio = document.getElementById("Usua_Password");
    if(cambio.type == "password"){
        cambio.type = "text";
        $('.icon').removeClass('fa fa-eye-slash').addClass('fa fa-eye');
    }else{
        cambio.type = "password";
        $('.icon').removeClass('fa fa-eye').addClass('fa fa-eye-slash');
    }
} 