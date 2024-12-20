///::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
///:: INFORMATIVOS v 1.0 FECHA: 2024-11-04 ::::::::::::::::::::::::::::::::::::::::::::::::///
///:: CREAR, EDITAR, ELIMINAR INFORMATIVOS ::::::::::::::::::::::::::::::::::::::::::::::::///
///::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///

///:: DECLARACION DE VARIABLES ::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
var comunicado_id, comu_titulo, comu_fecha_inicio, comu_fecha_fin, comu_proceso, comu_destacado, comu_archivo;
var opcion_informativo, tabla_informativo, imagen_editar, form_data;

///:: JS DOM MAESTRO COLABORADOR ::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
$(document).ready(function(){
    ///:: COLOCA EL NOMBRE DEL ARCHIVO EN EL INPUT FILE :::::::::::::::::::::::::::::::::::///
    $(document).on('change', '#comu_archivo', function (event) {
        imagen_editar = "";
        let NombreArch=event.target.files[0].name;
        let Extension=NombreArch.split('.').pop();
        $("#label_comu_archivo").text(NombreArch);
        
        let archivo = event.target.files[0];
        let reader  = new FileReader();
        if (archivo) {
          reader.readAsDataURL(archivo );
          reader.onloadend = function () {
            imagen_editar='<img src="' + reader.result + '" height="340px" width="360px" class="rounded" alt="" />';
            $("#div_comu_archivo").html(imagen_editar);
          }
        }
    }); 

    div_tabla = f_CreacionTabla("tabla_informativo","");
    $("#div_tabla_informativo").html(div_tabla);
    columnastabla = f_ColumnasTabla("tabla_informativo","");

    Accion = 'listado_informativo';
    tabla_informativo = $('#tabla_informativo').removeAttr('width').DataTable({
        language            : idiomaEspanol,
        responsive          : "true",
        dom                 : 'Blfrtip', // Con Botones Excel,Pdf,Print
        buttons:[
            {
                extend      : 'excelHtml5',
                text        : '<i class="fas fa-file-excel"></i> ',
                titleAttr   : 'Exportar a Excel',
                className   : 'btn btn-success',
                title       : 'INFORMATIVOS'
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
            {   width       : 400, targets: [1] },
            {   width       : 600, targets: [6] },
            { 
                "className" : "text-center", 
                "targets"   : [0,2,3,4,5]
            },
            {
                "targets"   : [7],
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
                        return "<a href='../../../Services/image/comunicados/"+data+"' target='_blank'>"+data+"</a>";
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
    $('#form_informativo').submit(function(e){                         
        e.preventDefault();
        let imagen = '';
        let nombre_imagen = '';
        let validacion = '';
        let tmsg = "";
        let existe_imagen = "";
        comu_archivo = '';
        imagen = document.getElementById('comu_archivo').value;

        comunicado_id = $.trim($('#comunicado_id').val());    
        comu_titulo  = $.trim($('#comu_titulo').val());
        comu_fecha_inicio = $.trim($('#comu_fecha_inicio').val());    
        comu_fecha_fin = $.trim($('#comu_fecha_fin').val());    
        comu_proceso = $.trim($('#comu_proceso').val());
        comu_destacado = $.trim($('#comu_destacado').val());  

        validacion = f_validar_informativo(comu_titulo, comu_fecha_inicio, comu_fecha_fin, comu_proceso, comu_destacado, imagen);

        if(imagen.length>0){
            comu_archivo = $('#comu_archivo')[0].files[0];
            nombre_imagen = $('#comu_archivo')[0].files[0].name;
            existe_imagen = f_buscar_dato("comunicado","Comu_Archivo","`Comu_Archivo`='"+nombre_imagen+"' AND `comu_estado`='ACTIVO'");
            if(existe_imagen.length>0){
                validacion = "invalido";
                tmsg = "<br>Archivo de Imagen Existe"
            }
        }else{
            tmsg = "<br>Agregar Imagen";
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
            if(opcion_informativo == "CREAR") {
                Accion = 'crear_informativo';
            }
            form_data = new FormData();
            form_data.append("MoS", MoS);
            form_data.append("NombreMoS", NombreMoS);
            form_data.append("Accion", Accion);
            form_data.append("comunicado_id", comunicado_id);
            form_data.append("comu_titulo", comu_titulo);
            form_data.append("comu_fecha_inicio", comu_fecha_inicio);
            form_data.append("comu_fecha_fin", comu_fecha_fin);
            form_data.append("comu_proceso", comu_proceso);
            form_data.append("comu_destacado", comu_destacado);
            form_data.append("comu_archivo", comu_archivo);
            form_data.append("nombre_imagen", nombre_imagen);
            $.ajax({
                url         : "Ajax.php",
                type        : "POST",
                datatype    : "json",    
                data        :  form_data,   
                contentType :false,
                processData :false,
                success     : function(data) {
                    tabla_informativo.ajax.reload(null, false);
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
            $('#modal_crud_informativo').modal('hide'); 
            $("#btn_guardar").prop("disabled",false);
        }
    });

    ///:: BOTON NUEVO :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
    $("#btn_nuevo").click(function(){
        opcion_informativo = "CREAR"; 
        f_limpia_informativo();
        $("#form_informativo").trigger("reset");
        
        imagen_editar='<img src="Module/informativos/View/Img/VistaPrevia.jpg" height="340px" width="360px" class="rounded"/>';
        $("#div_comu_archivo").html(imagen_editar);
        $("#label_comu_archivo").text("Seleccionar Archivo .jpg, .bmp, .jpeg o .pgn");
    
        $(".modal-header").css( "background-color", "#17a2b8");
        $(".modal-header").css( "color", "white" );
        $(".modal-title").text("ALTA DE INFORMATIVOS");
        $('#modal_crud_informativo').modal('show');
    });
    ///:: FIN BOTON NUEVO :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///

    ///::  BOTON BORRAR REGISTRO  :::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
    $(document).on("click", ".btn_borrar", function(){
        let fila = $(this).closest('tr');           
        comunicado_id = fila.find('td:eq(0)').text();
        comu_archivo = fila.find('td:eq(6)').text();
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
                Accion = 'borrar_informativo';
                    $.ajax({
                        url      : "Ajax.php",
                        type     : "POST",
                        datatype : "json",    
                        data     : { MoS:MoS, NombreMoS:NombreMoS, Accion:Accion, comunicado_id:comunicado_id, comu_archivo:comu_archivo },   
                        success : function(data) {
                            tabla_informativo.ajax.reload(null, false);
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
function f_validar_informativo(comu_titulo, comu_fecha_inicio, comu_fecha_fin, comu_proceso, comu_destacado, nombre_imagen){
    f_limpia_informativo();
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
    if(comu_proceso==""){
        $("#comu_proceso").addClass("color-error");
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
function f_limpia_informativo(){
    $("#comunicado_id").removeClass("color-error");
    $("#comu_titulo").removeClass("color-error");
    $("#comu_fecha_inicio").removeClass("color-error");
    $("#comu_fecha_fin").removeClass("color-error");
    $("#comu_proceso").removeClass("color-error");
    $("#comu_destacado").removeClass("color-error");
}
///:: FIN INVISIBILIZA LOS MENSAJE DE ALERTA DEL FORMULARIO :::::::::::::::::::::::::::::::/// 

///:: TERMINO FUNCIONES DE INFORMATIVOS :::::::::::::::::::::::::::::::::::::::::::::::::::///