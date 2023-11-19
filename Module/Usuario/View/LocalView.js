///::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
///:: USUARIOS v 5.0 FECHA: 2023-05-12 ::::::::::::::::::::::::::::::::::::::::::::::::::::///
///:: CREAR, EDITAR, ELIMINAR TABLA DE USUARIOS :::::::::::::::::::::::::::::::::::::::::::///
///::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///

///:: DECLARACION DE VARIABLES ::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
var tablaUsuarios, opcion_usuarios, fila_usuarios, Usuario_Id, Usua_Nombres, Usua_NombreCorto, Usua_UsuarioWeb, Usua_Password, Usua_Perfil, Usua_Estado;

///:: JS DOM USUARIO ::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
$(document).ready(function(){
    let a_data  = [];
    ///:: Muestra u Oculta el Password ::::::::::::::::::::::::::::::::::::::::::::::::::::///
    $('#ShowPassword').click(function () {
		$('#Usua_Password').attr('type', $(this).is(':checked') ? 'text' : 'password');
	});

    ///:: SI SE ACTUALIZA Usuario_Id ENTONCES SE BUSCA DATA :::::::::::::::::::::::::::::::///
    $("#Usuario_Id").on('change', function () {
        Usuario_Id  = $("#Usuario_Id").val(); 
        Usua_Nombres        = "";
        Usua_NombreCorto    = "";
        Usua_UsuarioWeb     = "";
        Usua_Password       = "";
        Usua_Perfil         = "";
        Usua_Estado         = "";
        a_data      = f_BuscarDataBD('colaborador', 'Colaborador_id', Usuario_Id)
        $.each(a_data, function(idx, obj){
            Usuario_Id          = obj.Colaborador_id;
            Usua_Nombres        = obj.Colab_ApellidosNombres;
            Usua_NombreCorto    = obj.Colab_nombre_corto;
        });
        $("#Usuario_Id").val(Usuario_Id);
        $("#Usua_Nombres").val(Usua_Nombres);
        $("#Usua_NombreCorto").val(Usua_NombreCorto);
        $("#Usua_UsuarioWeb").val(Usua_UsuarioWeb);
        $("#Usua_Password").val(Usua_Password);
        $("#Usua_Perfil").val(Usua_Perfil);
        $("#Usua_Estado").val(Usua_Estado);                    
    });
    
    div_tabla = f_CreacionTabla("tablaUsuario","");
    $("#div_tablaUsuario").html(div_tabla);
    columnastabla = f_ColumnasTabla("tablaUsuario","");

    Accion = 'CargaTablaUsuario';
    tablaUsuarios = $('#tablaUsuarios').DataTable({
        language        : idiomaEspanol, 
        responsive      : "true",
        dom             : 'Blfrtip',
        buttons         : [
            {
                extend      : 'excelHtml5',
                text        : '<i class="fas fa-file-excel"></i> ',
                titleAttr   : 'Exportar a Excel',
                className   : 'btn btn-success',
                title       : 'USUARIOS'
            },
        ],
        "ajax"          : {
            "url"       : "Ajax.php", 
            "method"    : 'POST', 
            "data"      : { MoS:MoS, NombreMoS:NombreMoS, Accion:Accion },
            "dataSrc"   : ""
        },
        "columns"       : columnastabla,
        "order"         : [[1, 'asc']]
    });     

    ///:: BOTONES DE USUARIOS :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///

    ///:: EVENTO DEL BOTON NUEVO USUARIO ::::::::::::::::::::::::::::::::::::::::::::::::::///
    $(document).on("click", ".btn_nuevo_usuario", function(){
        opcion_usuarios = "CREAR"; 
        f_limpia_usuarios();
        $("#formUsuarios").trigger("reset");

        Usuario_Id          = "";
        Usua_Nombres        = "";
        Usua_NombreCorto    = "";
        Usua_UsuarioWeb     = "";
        Usua_Password       = "";
        Usua_Perfil         = "";
        Usua_Estado         = "";

        data_html = f_select_combo("glo_tipotablausuario","NO","ttablausuario_detalle",Usua_Perfil,"`ttablausuario_tipo`='PERFIL'")
        $("#Usua_Perfil").html(data_html);
        data_html = f_select_combo("glo_tipotablausuario","NO","ttablausuario_detalle",Usua_Estado,"`ttablausuario_tipo`='ESTADO'")
        $("#Usua_Estado").html(data_html);

        $("#Usuario_Id").val(Usuario_Id);
        $("#Usua_Nombres").val(Usua_Nombres);
        $("#Usua_NombreCorto").val(Usua_NombreCorto);
        $("#Usua_UsuarioWeb").val(Usua_UsuarioWeb);
        $("#Usua_Password").val(Usua_Password);
        $("#Usua_Perfil").val(Usua_Perfil);
        $("#Usua_Estado").val(Usua_Estado);

        $("#Usua_Nombres").prop("disabled",false);
        $("#btn_guardar_usuario").prop("disabled",false);
        $(".modal-header").css( "background-color", "#17a2b8");
        $(".modal-header").css( "color", "white" );
        $(".modal-title").text("Alta de Usuario");
        $('#modalCRUD').modal('show');	    
    });
    ///:: FIN EVENTO DEL BOTON NUEVO USUARIO ::::::::::::::::::::::::::::::::::::::::::::::///

    ///:: EVENTO DEL BOTON EDITAR :::::::::::::::::::::::::::::::::::::::::::::::::::::::::///       
    $(document).on("click", ".btn_editar_usuario", function(){		        
        f_limpia_usuarios();
        $("#formUsuarios").trigger("reset");

        opcion_usuarios     = "EDITAR";
        fila_usuarios       = $(this).closest("tr");	        
        Usuario_Id          = fila_usuarios.find('td:eq(0)').text();
        Usua_Nombres        = fila_usuarios.find('td:eq(1)').text();
        Usua_NombreCorto    = fila_usuarios.find('td:eq(2)').text();
        Usua_UsuarioWeb     = fila_usuarios.find('td:eq(3)').text();
        Usua_Password       = fila_usuarios.find('td:eq(4)').text();
        Usua_Perfil         = fila_usuarios.find('td:eq(5)').text();
        Usua_Estado         = fila_usuarios.find('td:eq(6)').text();

        data_html = f_select_combo("glo_tipotablausuario","NO","ttablausuario_detalle",Usua_Perfil,"`ttablausuario_tipo`='PERFIL'")
        $("#Usua_Perfil").html(data_html);
        data_html = f_select_combo("glo_tipotablausuario","NO","ttablausuario_detalle",Usua_Estado,"`ttablausuario_tipo`='ESTADO'")
        $("#Usua_Estado").html(data_html);
        
        $("#Usuario_Id").val(Usuario_Id);
        $("#Usua_Nombres").val(Usua_Nombres);
        $("#Usua_NombreCorto").val(Usua_NombreCorto);
        $("#Usua_UsuarioWeb").val(Usua_UsuarioWeb);
        $("#Usua_Password").val(Usua_Password);
        $("#Usua_Perfil").val(Usua_Perfil);
        $("#Usua_Estado").val(Usua_Estado);

        $("#Usua_Nombres").prop("disabled",true);
        $(".modal-header").css("background-color", "#007bff");
        $(".modal-header").css("color", "white" );
        $(".modal-title").text("Editar Usuario");		
        $('#modalCRUD').modal('show');		   
    });
    ///:: FIN EVENTO DEL BOTON EDITAR :::::::::::::::::::::::::::::::::::::::::::::::::::::///

    ///:: BOTON BORRAR REGISTRO :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
    $(document).on("click", ".btn_borrar_usuario", function(){
        fila_usuarios   = $(this);           
        Usuario_Id      = $(this).closest('tr').find('td:eq(0)').text();
        let rpta_borrar_usuarios = "";
        Swal.fire({
            title               : '¿Está seguro?',
            text                : "Se eliminara el registro "+Usuario_Id+" con todos sus accesos a modulos !",
            icon                : 'warning',
            showCancelButton    : true,
            confirmButtonColor  : '#3085d6',
            cancelButtonColor   : '#d33',
            confirmButtonText   : 'Si, eliminar!'
        }).then((result) => {
            if (result.isConfirmed) {
                rpta_borrar_usuarios = "BORRAR";
                Accion = 'BorrarUsuario';
                if (rpta_borrar_usuarios == "BORRAR") {
                    $.ajax({
                        url         : "Ajax.php",
                        type        : "POST",
                        datatype    : "json",    
                        data        : { MoS:MoS, NombreMoS:NombreMoS, Accion:Accion, Usuario_Id:Usuario_Id },   
                        success: function() {
                            tablaUsuarios.ajax.reload(null, false);
                            Swal.fire(
                                'Eliminado!',
                                'El registro ha sido eliminado.',
                                'success'
                            )            
                        }
                    });
                }
            }
        });
    });
    ///:: FIN BOTON BORRAR REGISTRO :::::::::::::::::::::::::::::::::::::::::::::::::::::::///
    
    ///::: BOTON CREA Y EDITA USUARIO :::::::::::::::::::::::::::::::::::::::::::::::::::::///
    $('#formUsuarios').submit(function(e){
        let validacion_usuarios = "";
        let t_msg               = '';
        e.preventDefault(); 
        Usuario_Id          = $.trim($('#Usuario_Id').val());    
        Usua_Nombres        = $.trim($('#Usua_Nombres').val());
        Usua_NombreCorto    = $.trim($('#Usua_NombreCorto').val());    
        Usua_UsuarioWeb     = $.trim($('#Usua_UsuarioWeb').val());    
        Usua_Password       = $.trim($('#Usua_Password').val());
        Usua_Perfil         = $.trim($('#Usua_Perfil').val());  
        Usua_Estado         = $.trim($('#Usua_Estado').val());
        
        validacion_usuarios = f_validar_usuarios(Usuario_Id, Usua_Nombres, Usua_NombreCorto, Usua_UsuarioWeb, Usua_Password, Usua_Perfil, Usua_Estado);
        if(Usuario_Id!=''){
            a_data = f_BuscarDataBD('usuario', 'Usuario_Id', Usuario_Id)
            if(a_data.length>0 && opcion_usuarios=='CREAR'){
                t_msg               = '<br>Usuario Existe!!!';
                validacion_usuarios = 'invalido';
                $("#Usuario_Id").addClass("color-error");
            }
        }
        if(Usua_UsuarioWeb!=''){
            a_data = f_BuscarDataBD('usuario', 'Usua_UsuarioWeb', Usua_UsuarioWeb)
            if(a_data.length>0 && opcion_usuarios=='CREAR'){
                t_msg               += '<br>UsuarioWeb Existe!!!';
                validacion_usuarios = 'invalido';
                $("#Usua_UsuarioWeb").addClass("color-error");
            }
            if(a_data.length>0 && opcion_usuarios=='EDITAR'){
                $.each(a_data, function(idx, obj){
                    if(Usuario_Id != obj.Usuario_Id){
                        t_msg               += "<br>UsuarioWeb Existe!!!";
                        validacion_usuarios = "invalido";
                        $("#Usua_UsuarioWeb").addClass("color-error");        
                    } 
                });
            }
        }

        if(validacion_usuarios=="invalido"){
            Swal.fire({
                position            : 'center',
                icon                : 'error',
                title               : '*Falta Completar Información!!!'+t_msg,
                showConfirmButton   : false,
                timer               : 1500
            });
        }else{
            $("#btn_guardar_usuario").prop("disabled",true); //Deshabilita boton guardar para evitar multiples clicks
            if(opcion_usuarios == "CREAR") {
                Accion = 'CrearUsuario';
                $.ajax({
                    url         : "Ajax.php",
                    type        : "POST",
                    datatype    : "json",
                    data        : { MoS:MoS, NombreMoS:NombreMoS, Accion:Accion, Usuario_Id:Usuario_Id, Usua_Nombres:Usua_Nombres, Usua_NombreCorto:Usua_NombreCorto,   Usua_UsuarioWeb:Usua_UsuarioWeb, Usua_Password:Usua_Password, Usua_Perfil:Usua_Perfil, Usua_Estado:Usua_Estado },    
                    success     : function(data) {
                        tablaUsuarios.ajax.reload(null, false);
                    }
                });
            }
            if(opcion_usuarios == "EDITAR") {
                Accion = 'EditarUsuario';
                $.ajax({
                    url         : "Ajax.php",
                    type        : "POST",
                    datatype    : "json",    
                    data        : { MoS:MoS, NombreMoS:NombreMoS, Accion:Accion, Usuario_Id:Usuario_Id, Usua_Nombres:Usua_Nombres, Usua_NombreCorto:Usua_NombreCorto,   Usua_UsuarioWeb:Usua_UsuarioWeb, Usua_Password:Usua_Password, Usua_Perfil:Usua_Perfil, Usua_Estado:Usua_Estado },    
                    success     : function(data) {
                        tablaUsuarios.ajax.reload(null, false);
                    }
                });
            }
            $('#modalCRUD').modal('hide');    
            $("#btn_guardar_usuario").prop("disabled",false);
        }
    });
    ///::: FIN BOTON CREA Y EDITA USUARIO :::::::::::::::::::::::::::::::::::::::::::::::::///

    ///:: TERMINO BOTONES DE USUARIOS :::::::::::::::::::::::::::::::::::::::::::::::::::::///
});    
///:: TERMINO JS DOM USUARIO ::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///


///:: FUNCIONES DE USUARIOS :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///

///:: FUNCION PARA VALIDAR LOS DATOS INGRESADOS AL FORMULARIO :::::::::::::::::::::::::::::///
function f_validar_usuarios(p_Usuario_Id, p_Usua_Nombres, p_Usua_NombreCorto, p_Usua_UsuarioWeb, p_Usua_Password, p_Usua_Perfil, p_Usua_Estado){
    f_limpia_usuarios();
    let rpta_validar_usuarios = "";    

    if(p_Usuario_Id=="" || isNaN(p_Usuario_Id) || p_Usuario_Id.length<8){
        $("#Usuario_Id").addClass("color-error");
        rpta_validar_usuarios = "invalido";
    }
    
    if(p_Usua_Nombres==""){
         $("#Usua_Nombres").addClass("color-error");
        rpta_validar_usuarios="invalido";
    }

    if(p_Usua_NombreCorto==""){
        $("#Usua_NombreCorto").addClass("color-error");
        rpta_validar_usuarios="invalido";
    }

    if(p_Usua_UsuarioWeb==""){
        $("#Usua_UsuarioWeb").addClass("color-error");
        rpta_validar_usuarios="invalido";
    }

    if(p_Usua_Password==""){
        $("#Usua_Password").addClass("color-error");
        rpta_validar_usuarios="invalido";
    }

    if(p_Usua_Perfil==""){
        $("#Usua_Perfil").addClass("color-error");
        rpta_validar_usuarios="invalido";
    }

    if(p_Usua_Estado==""){
        $("#Usua_Estado").addClass("color-error");
        rpta_validar_usuarios="invalido";
    }
    
    return rpta_validar_usuarios; 
}
///:: FIN FUNCION PARA VALIDAR LOS DATOS INGRESADOS AL FORMULARIO :::::::::::::::::::::::::///

///:: LIMPIA EL COLOR DE LOS CAMPOS DEL FORMULARIO ::::::::::::::::::::::::::::::::::::::::/// 
function f_limpia_usuarios(){
    var cambio = document.getElementById("Usua_Password");
    cambio.type = "password";
    $('.icon').removeClass('fa fa-eye').addClass('fa fa-eye-slash');
    $('#Usua_Password').attr('type', $(this).is(':checked') ? 'text' : 'password');
        
    $("#Usuario_Id").removeClass("color-error");
    $("#Usua_Nombres").removeClass("color-error");
    $("#Usua_NombreCorto").removeClass("color-error");
    $("#Usua_UsuarioWeb").removeClass("color-error");
    $("#Usua_Password").removeClass("color-error");
    $("#Usua_Perfil").removeClass("color-error");
    $("#Usua_Estado").removeClass("color-error");
}
///:: FIN LIMPIA EL COLOR DE LOS CAMPOS DEL FORMULARIO ::::::::::::::::::::::::::::::::::::/// 

///:: MOSTRAR U OCULTAR PASSWORD ::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
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
///:: FIN MOSTRAR U OCULTAR PASSWORD ::::::::::::::::::::::::::::::::::::::::::::::::::::::///

///:: TERMINO FUNCIONES DE USUARIOS :::::::::::::::::::::::::::::::::::::::::::::::::::::::///