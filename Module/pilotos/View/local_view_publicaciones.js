///::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
///:: PUBLICACIONES v 1.0 FECHA: 2024-11-04 :::::::::::::::::::::::::::::::::::::::::::::::///
///:: CREAR, EDITAR, ELIMINAR INFORMATIVOS ::::::::::::::::::::::::::::::::::::::::::::::::///
///::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///

///:: DECLARACION DE VARIABLES ::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
var comunicado_id, comu_titulo, comu_fecha_inicio, comu_fecha_fin, comu_categoria, comu_destacado, comu_imagen, comu_pdf, comu_video, comu_link;
var opcion_publicacion, tabla_publicacion, imagen_editar, form_data;

///:: JS DOM MAESTRO COLABORADOR ::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
$(document).ready(function(){
    ///:: COLOCA EL NOMBRE DEL ARCHIVO EN EL INPUT FILE :::::::::::::::::::::::::::::::::::///
    $(document).on('change', '#comu_imagen', function (event) {
        imagen_editar = "";
        let NombreArch=event.target.files[0].name;
        let Extension=NombreArch.split('.').pop();
        $("#label_comu_imagen").text(NombreArch);
        
        let archivo = event.target.files[0];
        let reader  = new FileReader();
        if (archivo) {
          reader.readAsDataURL(archivo );
          reader.onloadend = function () {
            imagen_editar='<img src="' + reader.result + '" height="428px" width="360px" class="rounded" alt="" />';
            $("#div_comu_imagen").html(imagen_editar);
          }
        }
    }); 

    $(document).on('change', '#comu_pdf', function (event) {
        let NombreArch=event.target.files[0].name;
        let Extension=NombreArch.split('.').pop();
        $("#label_comu_pdf").text(NombreArch);
    }); 

    div_tabla = f_CreacionTabla("tabla_publicacion","");
    $("#div_tabla_publicacion").html(div_tabla);
    columnastabla = f_ColumnasTabla("tabla_publicacion","");

    Accion = 'listado_publicacion';
    tabla_publicacion = $('#tabla_publicacion').removeAttr('width').DataTable({
        language            : idioma_espanol,
        responsive          : "true",
        dom                 : 'Blfrtip',
        buttons:[
            {
                extend      : 'excelHtml5',
                text        : '<i class="fas fa-file-excel"></i> ',
                titleAttr   : 'Exportar a Excel',
                className   : 'btn btn-success',
                title       : 'PUBLICACIONES'
            },
        ],
        "ajax" :{            
            "url"       : "Ajax.php", 
            "method"    : 'POST',
            "data"      : { MoS:MoS,NombreMoS:NombreMoS,Accion:Accion },
            "dataSrc"   : ""
        },
        "columns"       : columnastabla,
        "columnDefs"    : [
            {   width       : 500, targets: [1] },
            {   width       : 600, targets: [6,7,8,9] },
            { 
                "className" : "text-center", 
                "targets"   : [0,2,3,4,5]
            },
            {
                "targets"   : [6,7,8,9,12],
                "orderable" : false
            },
            {
                "targets"   : [4],
                "render"    : function(data, type, row, meta) {
                    if(data===1){
                        return "SI";
                    }else{
                        return "NO";
                    }
                }
            },
            {
                "targets"   : [6],
                "render"    : function(data, type, row, meta) {
                    if(data!=null){
                        return "<a href='../../../Services/files/image/comunicados/"+data+"' target='_blank'>"+data+"</a>";
                    }else{
                        return "";
                    }
                }
            },
            {
                "targets"   : [7],
                "render"    : function(data, type, row, meta) {
                    if(data!=null){
                        return "<a href='../../../Services/files/pdf/comunicados/"+data+"' target='_blank'>"+data+"</a>";
                    }else{
                        return "";
                    }
                }
            },
            {
                "targets"   : [8],
                "render"    : function(data, type, row, meta) {
                    if(data!=null){
                        return "<a href='"+data+"' target='_blank'>"+data+"</a>";
                    }else{
                        return "";
                    }
                }
            },
            {
                "targets"   : [9],
                "render"    : function(data, type, row, meta) {
                    if(data!=null){
                        return "<a href='"+data+"' target='_blank'>"+data+"</a>";
                    }else{
                        return "";
                    }
                }
            }
        ],
        fixedColumns     : true,
        "order"         : [[0, 'desc']]
    });     

    ///:: BOTONES DE INFORMATIVOS :::::::::::::::::::::::::::::::::::::::::::::::::::::::::///

    ///:: CREA Y EDITA MAESTRO UNO ::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
    $('#form_publicacion').submit(function(e){                         
        e.preventDefault();
        let imagen = '';
        let pdf = '';
        let nombre_pdf = '';
        let nombre_imagen = '';
        let validacion = '';
        let tmsg = "";
        let existe_imagen = "";
        let existe_pdf = "";
        comu_imagen = '';
        imagen = document.getElementById('comu_imagen').value;
        pdf = document.getElementById('comu_pdf').value;
        comu_titulo  = $.trim($('#comu_titulo').val());
        comu_fecha_inicio = $.trim($('#comu_fecha_inicio').val());    
        comu_fecha_fin = $.trim($('#comu_fecha_fin').val());    
        comu_categoria = $.trim($('#comu_categoria').val());
        comu_destacado = $.trim($('#comu_destacado').val());
        comu_video = $.trim($('#comu_video').val());
        comu_link = $.trim($('#comu_link').val());

        validacion = f_validar_publicacion(comu_titulo, comu_fecha_inicio, comu_fecha_fin, comu_categoria, comu_destacado, imagen);

        if(imagen.length>0){
            comu_imagen = $('#comu_imagen')[0].files[0];
            nombre_imagen = $('#comu_imagen')[0].files[0].name;
            existe_imagen = f_buscar_dato("comunicado","Comu_Imagen","`Comu_Imagen`='"+nombre_imagen+"' AND `Comu_Estado`='ACTIVO'");
            if(existe_imagen.length>0){
                validacion = "invalido";
                tmsg = "<br>Archivo de Imagen Existe"
            }
        }else{
            tmsg = "<br>Agregar Imagen";
        }

        if(pdf.length>0){
            comu_pdf = $('#comu_pdf')[0].files[0];
            nombre_pdf = $('#comu_pdf')[0].files[0].name;
            existe_pdf = f_buscar_dato("comunicado","Comu_Pdf","`Comu_Pdf`='"+nombre_pdf+"' AND `Comu_Estado`='ACTIVO'");
            if(existe_pdf.length>0){
                validacion = "invalido";
                tmsg = "<br>Archivo PDF Existe"
            }
        }

        if(validacion=="invalido"){
            Swal.fire({
                position            : 'center',
                icon                : 'error',
                title               : '*Falta Completar Información!!!'+tmsg,
                showConfirmButton   : false,
                timer               : 1500
              })
        }else{
            $("#btn_guardar").prop("disabled",true);
            if(opcion_publicacion == "CREAR") {
                Accion = 'crear_publicacion';
            }
            form_data = new FormData();
            form_data.append("MoS", MoS);
            form_data.append("NombreMoS", NombreMoS);
            form_data.append("Accion", Accion);
            form_data.append("comu_titulo", comu_titulo);
            form_data.append("comu_fecha_inicio", comu_fecha_inicio);
            form_data.append("comu_fecha_fin", comu_fecha_fin);
            form_data.append("comu_categoria", comu_categoria);
            form_data.append("comu_destacado", comu_destacado);
            form_data.append("comu_imagen", comu_imagen);
            form_data.append("nombre_imagen", nombre_imagen);
            form_data.append("comu_pdf", comu_pdf);
            form_data.append("nombre_pdf", nombre_pdf);
            form_data.append("comu_video", comu_video);
            form_data.append("comu_link", comu_link);
            $.ajax({
                url         : "Ajax.php",
                type        : "POST",
                datatype    : "json",    
                data        :  form_data,   
                contentType : false,
                processData : false,
                success     : function(data) {
                    tabla_publicacion.ajax.reload(null, false);
                    if(data){
                        Swal.fire(
                            'Creación!',
                            'El registro ha sido generado.',
                            'success'
                        )
                    }else{
                        Swal.fire({
                            position : 'center',
                            icon : 'error',
                            title : 'No se graba la imagen en el servidor!!!',
                            showConfirmButton : false,
                            timer : 1500
                        })
                    }       
                }
            });	
            $('#modal_crud_publicacion').modal('hide'); 
            $("#btn_guardar").prop("disabled",false);
        }
    });

    ///:: BOTON NUEVO :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
    $("#btn_nuevo").click(function(){
        opcion_publicacion = "CREAR"; 
        f_limpia_publicacion();
        $("#form_publicacion").trigger("reset");
        
        imagen_editar='<img src="Module/pilotos/View/Img/VistaPrevia.jpg" height="428px" width="360px" class="rounded"/>';
        $("#div_comu_imagen").html(imagen_editar);
        $("#label_comu_imagen").text("Seleccionar Archivo .jpg, .bmp, .jpeg o .pgn");
        $("#label_comu_pdf").text("Seleccionar Archivo .pdf");
    
        $(".modal-header").css( "background-color", "#17a2b8");
        $(".modal-header").css( "color", "white" );
        $(".modal-title").text("ALTA DE PUBLICACIONES");
        $('#modal_crud_publicacion').modal('show');
    });
    ///:: FIN BOTON NUEVO :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///

    ///::  BOTON BORRAR REGISTRO  :::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
    $(document).on("click", ".btn_borrar", function(){
        let fila = $(this).closest('tr');           
        comunicado_id = fila.find('td:eq(0)').text();
        comu_imagen = fila.find('td:eq(6)').text();
        comu_pdf = fila.find('td:eq(7)').text();
        Swal.fire({
            title              : "¿Está seguro?",
            text               : "Se eliminara el registro "+comunicado_id+"!!!",
            icon               : "warning",
            showCancelButton   : true,
            confirmButtonColor : "#3085d6",
            cancelButtonColor  : "#d33",
            confirmButtonText  : "Si, eliminar!"
        }).then((result) => {
            if (result.isConfirmed) {
                Accion = 'borrar_publicacion';
                    $.ajax({
                        url      : "Ajax.php",
                        type     : "POST",
                        datatype : "json",    
                        data     : { MoS:MoS, NombreMoS:NombreMoS, Accion:Accion, comunicado_id:comunicado_id, comu_imagen:comu_imagen, comu_pdf:comu_pdf },   
                        success : function(data) {
                            tabla_publicacion.ajax.reload(null, false);
                            if(data){
                                Swal.fire(
                                    'Eliminado!',
                                    'El registro ha sido eliminado.',
                                    'success'
                                )
                            }else{
                                Swal.fire({
                                    position : 'center',
                                    icon : 'error',
                                    title : 'No se elimina la imagen del servidor!!!',
                                    showConfirmButton : false,
                                    timer : 1500
                                })
                            }       
                        }
                    });
            }
        });

    });
    ///:: FIN BOTON BORRAR REGISTRO  ::::::::::::::::::::::::::::::::::::::::::::::::::::::///

    ///:: TERMINO BOTONES MAESTRO UNO :::::::::::::::::::::::::::::::::::::::::::::::::::::///


});    
///:: TERMINO JS DOM MAESTRO UNO ::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///


///:: FUNCIONES DE INFORMATIVOS :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///

///:: FUNCION PARA VALIDAR LOS DATSO INGRESADOS AL FORMULARIO :::::::::::::::::::::::::::::///
function f_validar_publicacion(comu_titulo, comu_fecha_inicio, comu_fecha_fin, comu_categoria, comu_destacado, nombre_imagen){
    f_limpia_publicacion();
    let respuesta="";    
    if(comu_titulo=="" || comu_titulo.length>200){
        $("#comu_titulo").addClass("color-error");
        respuesta="invalido";
    }
    if(comu_fecha_inicio==""){
        $("#comu_fecha_inicio").addClass("color-error");
        respuesta="invalido";
    }
    if(comu_fecha_fin==""){
        $("#comu_fecha_fin").addClass("color-error");
        respuesta="invalido";
    }
    if(comu_fecha_inicio!="" && comu_fecha_fin!=""){
        if(comu_fecha_inicio>comu_fecha_fin){
            $("#comu_fecha_inicio").addClass("color-error");
            $("#comu_fecha_fin").addClass("color-error");
            respuesta="invalido";
        }
    }
    if(comu_categoria==""){
        $("#comu_categoria").addClass("color-error");
        respuesta="invalido";
    }
    if(comu_destacado==""){
        $("#comu_destacado").addClass("color-error");
        respuesta="invalido";
    }
    if(nombre_imagen.length==0){
        respuesta="invalido";
    }
    return respuesta; 
}
///:: FINN FUNCION PARA VALIDAR LOS DATOS INGRESADOS AL FORMULARIO ::::::::::::::::::::::::///

///:: INVISIBILIZA LOS MENSAJE DE ALERTA DEL FORMULARIO :::::::::::::::::::::::::::::::::::/// 
function f_limpia_publicacion(){
    $("#comunicado_id").removeClass("color-error");
    $("#comu_titulo").removeClass("color-error");
    $("#comu_fecha_inicio").removeClass("color-error");
    $("#comu_fecha_fin").removeClass("color-error");
    $("#comu_categoria").removeClass("color-error");
    $("#comu_destacado").removeClass("color-error");
}
///:: FIN INVISIBILIZA LOS MENSAJE DE ALERTA DEL FORMULARIO :::::::::::::::::::::::::::::::/// 

///:: TERMINO FUNCIONES DE INFORMATIVOS :::::::::::::::::::::::::::::::::::::::::::::::::::///