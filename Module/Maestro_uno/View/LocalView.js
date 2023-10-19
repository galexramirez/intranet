///::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
///:: MAESTRO UNO v 4.0 FECHA: 2023-04-27 :::::::::::::::::::::::::::::::::::::::::::::::::///
///:: CREAR, EDITAR, ELIMINAR COLABORADORES :::::::::::::::::::::::::::::::::::::::::::::::///
///::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///

///:: DECLARACION DE VARIABLES ::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
var opcionMaestroUno, tablaMaestroUno, fotoEditar;

///:: JS DOM MAESTRO COLABORADOR ::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
$(document).ready(function(){
    ///:: COLOCA EL NOMBRE DEL ARCHIVO EN EL INPUT FILE :::::::::::::::::::::::::::::::::::///
    $(document).on('change', '#Colab_Fotografia', function (event) {
        fotoEditar = "";
        let NombreArch=event.target.files[0].name;
        let Extension=NombreArch.split('.').pop();
        $("#labelColab_Fotografia").text(NombreArch);
        
        let archivo = event.target.files[0];
        let reader  = new FileReader();
        if (archivo) {
          reader.readAsDataURL(archivo );
          reader.onloadend = function () {
            fotoEditar='<img src="' + reader.result + '" height="260px" width="280px" alt="" />';
            $("#div_FotografiaColaborador").html(fotoEditar);
          }
        }
    }); 

    div_tabla = f_CreacionTabla("tablaMaestroUno","");
    $("#div_tablaMaestroUno").html(div_tabla);
    columnastabla = f_ColumnasTabla("tablaMaestroUno","");

    Accion = 'CargaTablaMaestro_uno';
    tablaMaestroUno = $('#tablaMaestroUno').removeAttr('width').DataTable({
        language            : idiomaEspanol,
        responsive          : "true",
        dom                 : 'Blfrtip', // Con Botones Excel,Pdf,Print
        buttons:[
            {
                extend      : 'excelHtml5',
                text        : '<i class="fas fa-file-excel"></i> ',
                titleAttr   : 'Exportar a Excel',
                className   : 'btn btn-success',
                title       : 'MAESTRO COLABORADOR'
            },
        ],
        "ajax" :{            
            "url"       : "Ajax.php", 
            "method"    : 'POST', //usamos el metodo POST
            "data"      : { MoS:MoS,NombreMoS:NombreMoS,Accion:Accion }, //enviamos opcion 4 para que haga un SELECT
            "dataSrc"   : ""
        },
        "columns"       : columnastabla,
        "columnDefs"    : [
            {   width       : 50, targets: [0, 4, 5, 6, 10] },
            {   width       : 250, targets: [1] },
            {   width       : 350, targets: [8] },
            {   width       : 150, targets: [2, 9] },
            {   width       : 250, targets: 3 },
            {   width       : 80, targets: 7 },
            {
                "targets"   : [12],
                "orderable" : false
            },
            {
                "targets"   : [11],
                "render"    : function(data, type, row, meta) {
                    if(data!=null){
                        return "<div class='text-center'><div class='btn-group'><button title='Fotografia' class='btn btn-success btn-sm btnFotografia'><i class='bi bi-image'><svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-image' viewBox='0 0 16 16'><path d='M6.002 5.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0z'/><path d='M2.002 1a2 2 0 0 0-2 2v10a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V3a2 2 0 0 0-2-2h-12zm12 1a1 1 0 0 1 1 1v6.5l-3.777-1.947a.5.5 0 0 0-.577.093l-3.71 3.71-2.66-1.772a.5.5 0 0 0-.63.062L1.002 12V3a1 1 0 0 1 1-1h12z'/></svg></i></button></div></div>";
                    }else{
                        return "";
                    }
                }
            }
        ],
        fixedColumns     : true,
        "order"         : [[1, 'asc']]
    });     

    ///:: BOTONES DE MAESTRO UNO ::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///

    ///:: CREA Y EDITA MAESTRO UNO ::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
    $('#formMaestroUno').submit(function(e){                         
        e.preventDefault(); //evita el comportambiento normal del submit, es decir, recarga total de la página
        let validaFotografia    = '';
        let validacion          = '';
        let a_data              = [];
        let t_msg               = '';
        validaFotografia        = document.getElementById('Colab_Fotografia').value;

        Colaborador_id          = $.trim($('#Colaborador_id').val());    
        Colab_ApellidosNombres  = $.trim($('#Colab_ApellidosNombres').val());
        Colab_CargoActual       = $.trim($('#Colab_CargoActual').val());    
        Colab_Estado            = $.trim($('#Colab_Estado').val());    
        Colab_FechaIngreso      = $.trim($('#Colab_FechaIngreso').val());
        Colab_FechaCese         = $.trim($('#Colab_FechaCese').val());  
        Colab_Email             = $.trim($('#Colab_Email').val());
        Colab_Direccion         = $.trim($('#Colab_Direccion').val());
        Colab_Distrito          = $.trim($('#Colab_Distrito').val());
        Colab_CodigoCortoPT     = $.trim($('#Colab_CodigoCortoPT').val());
        //Colab_PerfilEvaluacion  = $.trim($('#Colab_PerfilEvaluacion').val());
        Colab_PerfilEvaluacion  = "";
        Colab_nombre_corto      = $.trim($('#Colab_nombre_corto').val());
    
        validacion = f_validar(Colaborador_id, Colab_ApellidosNombres, Colab_CargoActual, Colab_Estado, Colab_FechaIngreso,Colab_FechaCese, Colab_Email, Colab_Direccion, Colab_Distrito, Colab_CodigoCortoPT, Colab_PerfilEvaluacion, Colab_nombre_corto);
        
        if(Colab_FechaCese=="") {
            Colab_FechaCese = "NULL";
        }else{
            Colab_FechaCese = "'"+Colab_FechaCese+"'";
        }
        if(Colaborador_id!=''){
            a_data = f_BuscarDataBD('colaborador', 'Colaborador_id', Colaborador_id);
            if(a_data.length>0 && opcionMaestroUno==1){
                validacion  = 'invalido';
                t_msg       += '<br>Número DNI Existe!!!';
                $("#Colaborador_id").addClass("color-error");
            }    
        }
        if(Colab_Email!=''){
            a_data = f_BuscarDataBD('colaborador', 'Colab_Email', Colab_Email);
            if(a_data.length>0 && opcionMaestroUno==1){
                validacion  = 'invalido';
                t_msg       += '<br>Correo Eléctonico Existe!!!';
                $("#Colab_Email").addClass("color-error");
            }    
            if(a_data.length>1 && opcionMaestroUno==2){
                validacion  = 'invalido';
                t_msg       += '<br>Correo Eléctonico Existe!!!';
                $("#Colab_Email").addClass("color-error");
            }
        }
        if(Colab_nombre_corto!=''){
            a_data = f_BuscarDataBD('colaborador', 'Colab_nombre_corto', Colab_nombre_corto);
            if(a_data.length>0 && opcionMaestroUno==1){
                validacion  = 'invalido';
                t_msg       += '<br>Nombre Corto Existe!!!';
                $("#Colab_nombre_corto").addClass("color-error");
            }
            if(a_data.length>1 && opcionMaestroUno==2){
                validacion  = 'invalido';
                t_msg       += '<br>Nombre Corto Existe!!!';
                $("#Colab_nombre_corto").addClass("color-error");
            }        
        }

        if(validacion=="invalido"){
            Swal.fire({
                position            : 'center',
                icon                : 'error',
                title               : '*Falta Completar Información!!!'+t_msg,
                showConfirmButton   : false,
                timer               : 1500
              })
        }else{
            $("#btnGuardar").prop("disabled",true);
            if(opcionMaestroUno == 1) {   // CREAR
                Accion = 'CrearMaestro_uno';
                $("#btnGuardar").prop("disabled",true);
                $.ajax({
                    url         : "Ajax.php",
                    type        : "POST",
                    datatype    : "json",    
                    data        : { MoS:MoS,NombreMoS:NombreMoS,Accion:Accion,Colaborador_id:Colaborador_id,Colab_ApellidosNombres:Colab_ApellidosNombres,Colab_CargoActual:Colab_CargoActual,Colab_Estado:Colab_Estado,Colab_FechaIngreso:Colab_FechaIngreso,Colab_FechaCese:Colab_FechaCese,Colab_Email:Colab_Email,Colab_Direccion:Colab_Direccion,Colab_Distrito:Colab_Distrito,Colab_CodigoCortoPT:Colab_CodigoCortoPT,Colab_PerfilEvaluacion:Colab_PerfilEvaluacion, Colab_nombre_corto},    
                    success     : function(data) {
                        if(validaFotografia.length>0){
                            f_GrabarFotografia(Colaborador_id);
                        }
                        tablaMaestroUno.ajax.reload(null, false);
                    }
                });
                $('#modalCRUD').modal('hide');
            } 
            if(opcionMaestroUno == 2) {   
                Accion = 'EditarMaestro_uno';
                $("#btnGuardar").prop("disabled",true);
                $.ajax({
                    url         : "Ajax.php",
                    type        : "POST",
                    datatype    : "json",    
                    data        : { MoS:MoS,NombreMoS:NombreMoS,Accion:Accion,Colaborador_id:Colaborador_id,Colab_ApellidosNombres:Colab_ApellidosNombres,Colab_CargoActual:Colab_CargoActual,Colab_Estado:Colab_Estado,Colab_FechaIngreso:Colab_FechaIngreso,Colab_FechaCese:Colab_FechaCese,Colab_Email:Colab_Email,Colab_Direccion:Colab_Direccion,Colab_Distrito:Colab_Distrito,Colab_CodigoCortoPT:Colab_CodigoCortoPT,Colab_PerfilEvaluacion:Colab_PerfilEvaluacion, Colab_nombre_corto},    
                    success     : function(data) {
                        if(validaFotografia.length>0){
                            f_GrabarFotografia(Colaborador_id);
                        }
                        tablaMaestroUno.ajax.reload(null, false);
                    }
                });
                $('#modalCRUD').modal('hide');
            } 
            $("#btnGuardar").prop("disabled",false);
        }
    });

    ///:: BOTON NUEVO :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
    $("#btnNuevo").click(function(){
        opcionMaestroUno = 1; // Alta 
        f_LimpiaMs();
        f_select_combos_maestrouno();
        $("#Colaborador_id").prop('disabled', false);
        $("#formMaestroUno").trigger("reset");
        
        fotoEditar='<img src="Module/Maestro_uno/View/Img/perfil.jpg" height="340px" width="360px"/>';
        $("#div_FotografiaColaborador").html(fotoEditar);
        $("#labelColab_Fotografia").text("Seleccionar Archivo .jpg o .bmp");
    
        $(".modal-header").css( "background-color", "#17a2b8");
        $(".modal-header").css( "color", "white" );
        $(".modal-title").text("ALTA DE MAESTRO");
        $('#modalCRUD').modal('show');
    });
    ///:: FIN BOTON NUEVO :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///

    ///:: BOTON EDITAR ::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
    $(document).on("click", ".btnEditar", function(){		        
        let foto="";
        fotoEditar="";
        opcionMaestroUno = 2;// Editar
        f_LimpiaMs();
        f_select_combos_maestrouno();
        $("#Colaborador_id").prop('disabled', true);
        $("#formMaestroUno").trigger("reset");
        fila                    = $(this).closest("tr");	        
        Colaborador_id          = fila.find('td:eq(0)').text();
        Colab_ApellidosNombres  = fila.find('td:eq(1)').text();
        Colab_nombre_corto      = fila.find('td:eq(2)').text();
        Colab_CargoActual       = fila.find('td:eq(3)').text();
        Colab_Estado            = fila.find('td:eq(4)').text();
        Colab_FechaIngreso      = fila.find('td:eq(5)').text();
        Colab_FechaCese         = fila.find('td:eq(6)').text();
        Colab_Email             = fila.find('td:eq(7)').text();
        Colab_Direccion         = fila.find('td:eq(8)').text();
        Colab_Distrito          = fila.find('td:eq(9)').text();
        Colab_CodigoCortoPT     = fila.find('td:eq(10)').text();
        //Colab_PerfilEvaluacion  = fila.find('td:eq(11)').text();

        $("#Colaborador_id").val(Colaborador_id);
        $("#Colab_ApellidosNombres").val(Colab_ApellidosNombres);
        $("#Colab_nombre_corto").val(Colab_nombre_corto);
        $("#Colab_CargoActual").val(Colab_CargoActual);
        $("#Colab_Estado").val(Colab_Estado);
        $("#Colab_FechaIngreso").val(Colab_FechaIngreso);
        $("#Colab_FechaCese").val(Colab_FechaCese);
        $("#Colab_Email").val(Colab_Email);
        $("#Colab_Direccion").val(Colab_Direccion);
        $("#Colab_Distrito").val(Colab_Distrito);
        $("#Colab_CodigoCortoPT").val(Colab_CodigoCortoPT);
        //$("#Colab_PerfilEvaluacion").val(Colab_PerfilEvaluacion);

        foto=f_BuscarFotografia(Colaborador_id);
        if(foto==""){
            fotoEditar='<img src="Module/Maestro_uno/View/Img/perfil.jpg" height="340px" width="360px"/>';        
        }else{
            fotoEditar='<img src="' + foto + '" height="340px" width="360px"/>';
        }
        $("#div_FotografiaColaborador").html(fotoEditar);
        $("#labelColab_Fotografia").text("Seleccionar Archivo .jpg o .bmp");

        $(".modal-header").css("background-color", "#007bff");
        $(".modal-header").css("color", "white" );
        $(".modal-title").text("EDITAR MAESTRO");		
        $('#modalCRUD').modal('show');		   
    });

    ///::  BOTON BORRAR REGISTRO  :::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
    $(document).on("click", ".btnBorrar", function(){
        let rpta_borrar_colaborador   = "";
        fila_colaborador    = $(this).closest('tr');           
        Colaborador_id      = fila_colaborador.find('td:eq(0)').text();     
        Swal.fire({
            title               : '¿Está seguro?',
            text                : "Se eliminara el registro "+Colaborador_id+"!!!",
            icon                : 'warning',
            showCancelButton    : true,
            confirmButtonColor  : '#3085d6',
            cancelButtonColor   : '#d33',
            confirmButtonText   : 'Si, eliminar!'
        }).then((result) => {
            if (result.isConfirmed) {
                rpta_borrar_colaborador = "BORRAR";
                Accion = 'BorrarMaestro_uno';
                if (rpta_borrar_colaborador == "BORRAR") {
                    $.ajax({
                        url         : "Ajax.php",
                        type        : "POST",
                        datatype    : "json",    
                        data        : { MoS:MoS, NombreMoS:NombreMoS, Accion:Accion, Colaborador_id:Colaborador_id },   
                        success: function() {
                            tablaMaestroUno.ajax.reload(null, false);
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
    ///:: FIN BOTON BORRAR REGISTRO  ::::::::::::::::::::::::::::::::::::::::::::::::::::::///

    ///:: BOTON FOTOGRAFIA ::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
    $(document).on("click", ".btnFotografia", function(){		        
        let foto = "";
        let imagFotografia;
        fila            = $(this).closest("tr");	        
        Colaborador_id  = fila.find('td:eq(0)').text();
        foto            = f_BuscarFotografia(Colaborador_id);
        if(foto==""){
            Swal.fire({
                icon    : 'error',
                title   : 'FOTOGRAFIA...',
                text    : '*NO se ha registrado la fotografia del colaborador!'
              });
        }else{
            imagFotografia = '<img src="' + foto + '" height="370px" width="390px" alt="" />';
            $("#div_MostrarFotografia").html(imagFotografia);                  
            $(".modal-header").css("background-color", "#007bff");
            $(".modal-header").css("color", "white" );
            $(".modal-title").text("Fotografia Colaborador");		
            $('#modalCRUDFotografia').modal('show');		   
        }
    });
    ///:: FIN BOTON FOTOGRAFIA ::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///

    ///:: TERMINO BOTONES MAESTRO UNO :::::::::::::::::::::::::::::::::::::::::::::::::::::///


});    
///:: TERMINO JS DOM MAESTRO UNO ::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///


///:: FUNCIONES DE MAESTRO UNO ::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///

///:: FUNCION PARA VALIDAR LOS DATSO INGRESADOS AL FORMULARIO :::::::::::::::::::::::::::::///
function f_validar(Colaborador_id, Colab_ApellidosNombres, Colab_CargoActual, Colab_Estado, Colab_FechaIngreso,Colab_FechaCese, Colab_Email, Colab_Direccion, Colab_Distrito, Colab_CodigoCortoPT, Colab_PerfilEvaluacion, Colab_nombre_corto){
    f_LimpiaMs();
    let respuesta="";    

    if(Colaborador_id=="" || isNaN(Colaborador_id) || Colaborador_id.length<8){
        $("#Colaborador_id").addClass("color-error");
        respuesta="invalido";
    }
    
    if(Colab_ApellidosNombres==""){
        $("#Colab_ApellidosNombres").addClass("color-error");
        respuesta="invalido";
    }

    if(Colab_nombre_corto==""){
        $("#Colab_nombre_corto").addClass("color-error");
        respuesta="invalido";
    }

    if(Colab_Estado==""){
        $("#Colab_Estado").addClass("color-error");
        respuesta="invalido";
    }

    if(Colab_FechaIngreso==""){
        $("#Colab_FechaIngreso").addClass("color-error");
        respuesta="invalido";
    }

    if(Colab_CargoActual.substring(0,6)=="PILOTO" && Colab_CodigoCortoPT==""){
        $("#Colab_CodigoCortoPT").addClass("color-error");
        respuesta="invalido";
    }

    return respuesta; 
}
///:: FINN FUNCION PARA VALIDAR LOS DATSO INGRESADOS AL FORMULARIO ::::::::::::::::::::::::///

///:: INVISIBILIZA LOS MENSAJE DE ALERTA DEL FORMULARIO :::::::::::::::::::::::::::::::::::/// 
function f_LimpiaMs(){
    $("#Colaborador_id").removeClass("color-error");
    $("#Colab_ApellidosNombres").removeClass("color-error");
    $("#Colab_nombre_corto").removeClass("color-error");
    $("#Colab_CargoActual").removeClass("color-error");
    $("#Colab_Estado").removeClass("color-error");
    $("#Colab_FechaIngreso").removeClass("color-error");
    $("#Colab_FechaCese").removeClass("color-error");
    $("#Colab_Email").removeClass("color-error");
    $("#Colab_Direccion").removeClass("color-error");
    $("#Colab_Distrito").removeClass("color-error");
    $("#Colab_CodigoCortoPT").removeClass("color-error");
    //$("#Colab_PerfilEvaluacion").removeClass("color-error");
}
///:: FIN INVISIBILIZA LOS MENSAJE DE ALERTA DEL FORMULARIO :::::::::::::::::::::::::::::::/// 

///:: BUSCAR FOTOGRAFIA :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///       
function f_BuscarFotografia(Colaborador_id){
    let img = "";
    Accion  = 'FotografiaMaestro_uno';
    $.ajax({
        url         : "Ajax.php",
        type        : "POST",
        datatype    : "json",    
        async       : false,   
        data        :  { MoS:MoS,NombreMoS:NombreMoS,Accion:Accion,Colaborador_id:Colaborador_id },   
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
///:: FIN BUSCAR FOTOGRAFIA :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///

///:: GRABAR FOTOGRAFIA :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
function f_GrabarFotografia(Colaborador_id){
    let blobFile    = $('#Colab_Fotografia')[0].files[0];
    let formData    = new FormData();
    Accion          = 'GrabarFotografia';

    formData.append("MoS", MoS);
    formData.append("NombreMoS", NombreMoS);
    formData.append("Accion", Accion);
    formData.append("Colaborador_id", Colaborador_id);
    formData.append("Colab_Fotografia", blobFile);
    $.ajax({
        url         : "Ajax.php",
        type        : "POST",
        datatype    : "json",    
        data        :  formData,   
        contentType :false,
        processData :false,
        success     : function(data) {
        }
    });	
}
///:: FIN GRABAR FOTOGRAFIA :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///

///:: FUNCION CON LA CARGA DE LOS SELECT COMBOS DE MAESTROUNO :::::::::::::::::::::::::::::///
function f_select_combos_maestrouno(){
    letselectHtml = "";
    selectHtml = f_TipoTabla("MAESTRO UNO","ESTADO");
    $("#Colab_Estado").html(selectHtml);

    selectHtml = "";
    selectHtml = f_TipoTabla("MAESTRO UNO","CARGO");
    $("#Colab_CargoActual").html(selectHtml);

    selectHtml = "";
    selectHtml = f_TipoTabla("MAESTRO UNO","PERFIL");
    $("#Colab_PerfilEvaluacion").html(selectHtml);

    selectHtml = "";
    selectHtml = f_TipoTabla("MAESTRO UNO","DISTRITO");
    $("#Colab_Distrito").html(selectHtml);
}
///:: FIN FUNCION CON LA CARGA DE LOS SELECT COMBOS DE MAESTROUNO :::::::::::::::::::::::::///

///:: TERMINO FUNCIONES DE MAESTRO UNO ::::::::::::::::::::::::::::::::::::::::::::::::::::///