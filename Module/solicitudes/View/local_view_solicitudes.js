///::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
///:: SOLICITUDES v 1.0 FECHA: 10-04-2023 :::::::::::::::::::::::::::::::::::::::::::::::::///
///:: CREAR, EDITAR SOLICITUDES :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
///::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///

///:: DECLARACION DE VARIABLES ::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
var opcion_solicitudes, tabla_solicitudes, pdf_editar, sele_fecha_inicio, sele_fecha_termino, fila_solicitudes, solicitudes_id, fecha15;
var solicitudes_id, soli_detalle_respuesta, soli_log, soli_estado, soli_apellidos_nombres, soli_tipo;
sele_fecha_inicio   = "";
sele_fecha_termino  = "";
fecha15             = f_CalculoFecha("hoy","+15 days");
///:: TERMINO DECLARACION DE VARIABLES ::::::::::::::::::::::::::::::::::::::::::::::::::::///

///:: JS DOM SOLICITUDES ::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///

$(document).ready(function(){

    div_boton = f_BotonesFormulario("form_solicitudes_seleccion","");
    $("#div_btn_solicitudes_seleccion").html(div_boton);

    if(sele_fecha_inicio=="" && sele_fecha_termino==""){
        sele_fecha_inicio   = f_CalculoFecha("hoy","-7 days");
        sele_fecha_termino  = f_CalculoFecha("hoy","0");
        $('#sele_fecha_inicio').val(sele_fecha_inicio);
        $('#sele_fecha_termino').val(sele_fecha_termino);
    }
    
    ///:: COLOCA EL NOMBRE DEL ARCHIVO EN EL INPUT FILE :::::::::::::::::::::::::::::::::::///
    $(document).on('change', '#soli_pdf', function (event) {
        pdf_editar          = "";
        let nombre_archivo  = event.target.files[0].name;
        let extension       = nombre_archivo.split('.').pop();
        $("#label_solicitudes_pdf").text(nombre_archivo);
        
        let archivo = event.target.files[0];
        let reader = new FileReader();
        if (archivo) {
          reader.readAsDataURL(archivo );
          reader.onloadend = function () {
            pdf_editar='<iframe src="' + reader.result + '" width="530" height="520"></iframe>';
            $("#div_solicitudes_pdf").html(pdf_editar);
          }
        }
    }); 

    ///:: SI HAY CAMBIOS EN NOMBRES ACTUALIZAMOS DNI  :::::::::::::::::::::::::::::::::::::///
    $(document).on('change', '#soli_apellidos_nombres', function () {
        soli_dni = "";
        soli_apellidos_nombres = $('#soli_apellidos_nombres').val();
        let a_data = f_BuscarDataBD('glo_roles','roles_apellidosnombres',soli_apellidos_nombres);
        $.each(a_data, function(idx, obj){ 
            soli_dni = obj.roles_dni;
        });
        $('#soli_dni').val(soli_dni);
        $("#div_validacion_solicitudes").html(f_validacion_solicitudes($("#soli_fecha_ingreso").val(), $("#soli_fecha_recepcion").val(), $("#soli_fecha_inicio").val(), $("#soli_tipo").val(), $("#soli_dni").val()));
    });

    ///:: SI HAY CAMBIOS EN FECHA RECEPCION ACTUALIZAMOS VALIDACION :::::::::::::::::::::::///
    $(document).on('change', '#soli_fecha_recepcion', function () {
        $("#div_validacion_solicitudes").html(f_validacion_solicitudes($("#soli_fecha_ingreso").val(), $("#soli_fecha_recepcion").val(), $("#soli_fecha_inicio").val(), $("#soli_tipo").val(), $("#soli_dni").val()));
    });

    ///:: SI HAY CAMBIOS EN FECHA INICIO ACTUALIZAMOS VALIDACION ::::::::::::::::::::::::::///
    $(document).on('change', '#soli_fecha_inicio', function () {
        $("#div_validacion_solicitudes").html(f_validacion_solicitudes($("#soli_fecha_ingreso").val(), $("#soli_fecha_recepcion").val(), $("#soli_fecha_inicio").val(), $("#soli_tipo").val(), $("#soli_dni").val()));
    });

    ///:: SI HAY CAMBIOS EN TIPO ACTUALIZAMOS VALIDACION ::::::::::::::::::::::::::::::::::///
    $(document).on('change', '#soli_tipo', function () {
        $("#div_validacion_solicitudes").html(f_validacion_solicitudes($("#soli_fecha_ingreso").val(), $("#soli_fecha_recepcion").val(), $("#soli_fecha_inicio").val(), $("#soli_tipo").val(), $("#soli_dni").val()));
    });

    ///:: BOTONES DE SOLICITUDES ::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///

    ///:: BOTON LISTAR SOLICITUDES ::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
    $(document).on("click", ".btn_buscar_solicitudes", function(){
        f_mostrar_datatable_solicitudes('leer_solicitudes');
    });
    ///:: FIN BOTON LISTAR SOLICITUDES ::::::::::::::::::::::::::::::::::::::::::::::::::::///

    ///:: BOTON LISTAR SOLICITUDES ACTIVAS ::::::::::::::::::::::::::::::::::::::::::::::::///
    $(document).on("click", ".btn_buscar_solicitudes_activas", function(){
        f_mostrar_datatable_solicitudes('leer_solicitudes_activas');
    });
    ///:: FIN BOTON LISTAR SOLICITUDES ACTIVAS ::::::::::::::::::::::::::::::::::::::::::::///

    ///:: BOTON CREAR Y EDITAR SOLICITUDES ::::::::::::::::::::::::::::::::::::::::::::::::///
    $('#form_solicitudes').submit(function(e){                         
        e.preventDefault();
        let validar_pdf         ="";
        let validar_solicitudes = "";
        validar_pdf             = document.getElementById('soli_pdf').value;

        solicitudes_id          = $.trim($('#solicitudes_id').val());    
        soli_fecha_ingreso      = $.trim($('#soli_fecha_ingreso').val());
        soli_fecha_recepcion    = $.trim($('#soli_fecha_recepcion').val());
        soli_tipo               = $.trim($('#soli_tipo').val());
        soli_codigo_adm         = $.trim($('#soli_codigo_adm').val());
        soli_dni                = $.trim($('#soli_dni').val());    
        soli_apellidos_nombres  = $.trim($('#soli_apellidos_nombres').val());    
        soli_fecha_inicio       = $.trim($('#soli_fecha_inicio').val());    
        soli_fecha_fin          = $.trim($('#soli_fecha_fin').val());
        soli_descripcion        = $.trim($('#soli_descripcion').val());  

        validar_solicitudes = f_validar_solicitudes(soli_fecha_ingreso, soli_fecha_recepcion, soli_tipo, soli_codigo_adm, soli_dni, soli_apellidos_nombres, soli_fecha_inicio, soli_fecha_fin, soli_descripcion);

        if(validar_solicitudes=="invalido"){
            Swal.fire({
                position: 'center',
                icon: 'error',
                title: '*Falta Completar Información!!!',
                showConfirmButton: false,
                timer: 1500
              })
        }else{
            /// CREAR
            $("#btn_guardar_solicitudes").prop("disabled",true);
            if(opcion_solicitudes == 'CREAR') {   
                Accion = 'crear_solicitudes';
                $.ajax({
                    url         : "Ajax.php",
                    type        : "POST",
                    datatype    : "json",
                    async       : false,
                    data        :  { MoS:MoS, NombreMoS:NombreMoS, Accion:Accion, solicitudes_id:solicitudes_id, soli_fecha_ingreso:soli_fecha_ingreso, soli_fecha_recepcion:soli_fecha_recepcion, soli_tipo:soli_tipo, soli_codigo_adm: soli_codigo_adm, soli_dni:soli_dni, soli_apellidos_nombres:soli_apellidos_nombres, soli_fecha_inicio:soli_fecha_inicio, soli_fecha_fin:soli_fecha_fin, soli_descripcion:soli_descripcion},    
                    success: function(data) {
                        arreglo_data = $.parseJSON(data);
                        $.each(arreglo_data, function(idx, obj){ 
                            solicitudes_id = obj.solicitudes_id;
                        });
                        if(validar_pdf.length>0){
                            f_grabar_pdf_solicitudes(solicitudes_id);
                        }
                        tabla_solicitudes.ajax.reload(null, false);
                    }
                });
            } 
            /// EDITAR
            if(opcion_solicitudes == 'EDITAR') {   
                Accion='editar_solicitudes';
                $.ajax({
                    url         : "Ajax.php",
                    type        : "POST",
                    datatype    : "json",
                    data        : { MoS:MoS, NombreMoS:NombreMoS, Accion:Accion, solicitudes_id:solicitudes_id, soli_fecha_ingreso:soli_fecha_ingreso, soli_fecha_recepcion:soli_fecha_recepcion, soli_tipo:soli_tipo, soli_codigo_adm: soli_codigo_adm, soli_dni:soli_dni, soli_apellidos_nombres:soli_apellidos_nombres, soli_fecha_inicio:soli_fecha_inicio, soli_fecha_fin:soli_fecha_fin, soli_descripcion:soli_descripcion},
                    success: function(data) {
                        if(validar_pdf.length>0){
                            f_grabar_pdf_solicitudes(solicitudes_id);
                        }
                        tabla_solicitudes.ajax.reload(null, false);
                    }
                });
            } 
            $('#modal_crud_solicitudes').modal('hide');
            $("#btn_guardar_solicitudes").prop("disabled",false);
        }
    });
    ///:: FIN BOTON CREAR Y EDITAR SOLICITUDES ::::::::::::::::::::::::::::::::::::::::::::///

    ///:: BOTON NUEVO SOLICITUDES :::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
    $(document).on("click", ".btn_nuevo_solicitudes", function(){
        let vacio = "";
        opcion_solicitudes = "CREAR";
        f_limpia_solicitudes();          
        $("#solicitudes_id").prop('disabled', false);
        $("#form_solicitudes").trigger("reset");
    
        $('#soli_apellidos_nombres').html(f_select_roles('PILOTO','roles_apellidosnombres'));
        $('#soli_tipo').html(f_select_tipos('SOLICITUDES','TIPO SOLICITUD'));
        soli_fecha_ingreso  = f_CalculoFecha("hoy","0h");
        $('#soli_fecha_ingreso').val(soli_fecha_ingreso);
        $('#soli_fecha_recepcion').val(vacio);
        $('#solicitudes_id').val(vacio);
        $('#soli_tipo').val(vacio);
        $('#soli_codigo_adm').val(vacio);
        $('#soli_dni').val(vacio);
        $('#soli_apellidos_nombres').val(vacio);
        $('#soli_fecha_inicio').val(vacio);
        $('#soli_fecha_fin').val(vacio);
        $('#soli_descripcion').val(vacio);

        $("#label_solicitudes_pdf").text("Seleccionar Archivo .pdf");

        $(".modal-header").css( "background-color", "#17a2b8");
        $(".modal-header").css( "color", "white" );
        $(".modal-title").text( "Ingreso de Nuevas Solicitudes" );
        $('#modal_crud_solicitudes').modal('show');
        $('#modal-resizable').resizable();
        $(".modal-dialog").draggable({
          cursor: "move",
          handle: ".dragable_touch",
        });

        t_html = "<strong>Anticipación:  d | En Operaciones:  d | Solicitudes al año:  </strong>";
        $("#div_validacion_solicitudes").html(t_html);
    });
    ///:: FIN BOTON NUEVO SOLICITUDES :::::::::::::::::::::::::::::::::::::::::::::::::::::///

    ///:: BOTON EDITAR SOLICITUDES ::::::::::::::::::::::::::::::::::::::::::::::::::::::::///       
    $(document).on("click", ".btn_editar_solicitudes", function(){
        fila_solicitudes    = $(this).closest("tr");
        soli_estado         = fila_solicitudes.find('td:eq(11)').text();
        
        if(soli_estado=='OBSERVADO'){
            $("#form_solicitudes").trigger("reset");
            f_limpia_solicitudes();
            let buscar_pdf      = "";
            pdf_editar          = "";
            opcion_solicitudes  = 'EDITAR';
            
            solicitudes_id          = fila_solicitudes.find('td:eq(1)').text();
            soli_fecha_ingreso      = fila_solicitudes.find('td:eq(2)').text();
            soli_fecha_recepcion    = fila_solicitudes.find('td:eq(3)').text();
            soli_dni                = fila_solicitudes.find('td:eq(4)').text();
            soli_apellidos_nombres  = fila_solicitudes.find('td:eq(5)').text();
            soli_fecha_inicio       = fila_solicitudes.find('td:eq(6)').text();
            soli_fecha_fin          = fila_solicitudes.find('td:eq(7)').text();
            soli_tipo               = fila_solicitudes.find('td:eq(8)').text();
            soli_codigo_adm         = fila_solicitudes.find('td:eq(9)').text();
            soli_descripcion        = fila_solicitudes.find('td:eq(10)').text();
    
            $('#soli_apellidos_nombres').html(f_select_roles('PILOTO','roles_apellidosnombres'));
            $('#soli_tipo').html(f_select_tipos('SOLICITUDES','TIPO SOLICITUD'));
            
            $("#solicitudes_id").val(solicitudes_id);
            $("#soli_fecha_ingreso").val(soli_fecha_ingreso);
            $("#soli_fecha_recepcion").val(soli_fecha_recepcion);
            $("#soli_dni").val(soli_dni);
            $("#soli_apellidos_nombres").val(soli_apellidos_nombres);
            $("#soli_fecha_inicio").val(soli_fecha_inicio);
            $("#soli_fecha_fin").val(soli_fecha_fin);
            $("#soli_tipo").val(soli_tipo);
            $("#soli_codigo_adm").val(soli_codigo_adm);
            $("#soli_descripcion").val(soli_descripcion);
           
            buscar_pdf = f_buscar_pdf_solicitudes(solicitudes_id);
            if(buscar_pdf==""){
                pdf_editar = '<iframe src="Module/solicitudes/View/Img/VistaPrevia.pdf" width="530" height="520"></iframe>';        
            }else{
                pdf_editar = '<iframe src="' + buscar_pdf + '"  width="530" height="520"></iframe>';
            }
            $("#div_solicitudes_pdf").html(pdf_editar);
            $("#label_solicitudes_pdf").text("Seleccionar Archivo .pdf");

            $("#div_validacion_solicitudes").html(f_validacion_solicitudes($("#soli_fecha_ingreso").val(), $("#soli_fecha_recepcion").val(), $("#soli_fecha_inicio").val(), $("#soli_tipo").val(), $("#soli_dni").val()));

            $(".modal-header").css("background-color", "#007bff");
            $(".modal-header").css("color", "white" );
            $(".modal-title").text("Editar Solicitudes");		
            $('#modal_crud_solicitudes').modal('show');
            $('#modal-resizable').resizable();
            $(".modal-dialog").draggable({
              cursor: "move",
              handle: ".dragable_touch",
            });
    
        }else{
            Swal.fire({
                position            : 'center',
                icon                : 'error',
                title               : '* Estado OBSERVADO !!!',
                html                : 'Solo se editan las solicitudes en estado OBSERVADO',
                showConfirmButton   : false,
                timer: 2500
              })
        }
    });
    ///:: FIN BOTON EDITAR SOLICITUDES ::::::::::::::::::::::::::::::::::::::::::::::::::::/// 

    ///:: BOTON BORRAR REGISTRO  ::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
    $(document).on("click", ".btn_borrar_solicitudes", function(){
        fila_solicitudes = $(this);
        solicitudes_id = fila_solicitudes.closest('tr').find('td:eq(0)').text();     
        var respuesta = confirm("¿Está seguro de borrar el registro "+solicitudes_id+"?");                
        Accion='borrar_solicitudes';
        if (respuesta) {            
            $.ajax({
              url       : "Ajax.php",
              type      : "POST",
              datatype  : "json",    
              data      : { MoS:MoS,NombreMoS:NombreMoS,Accion:Accion,solicitudes_id:solicitudes_id },   
              success   : function() {
                  tabla_solicitudes.row(fila_solicitudes.parents('tr')).remove().draw();                  
               }
            });	
        }
    });
    ///:: BOTON BORRAR REGISTRO  ::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
    
    ///:: BOTON VER ARCHIVO PDF :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///       
    $(document).on("click", ".btn_solicitudes_pdf", function(){		        
        //let x_pdf = "";
        //let i_pdf ;
        fila_solicitudes    = $(this).closest("tr");	        
        solicitudes_id      = fila_solicitudes.find('td:eq(1)').text();

        let x_pdf     = "";
        let file_pdf  = "N_SO-"+solicitudes_id;
        x_pdf         = f_buscar_pdf('ope_solicitudes_pdf','spdf_pdf','spdf_solicitudes_id',solicitudes_id,'','',file_pdf );
    
        //x_pdf = f_buscar_pdf_solicitudes(solicitudes_id);
        if(x_pdf == ""){
            Swal.fire({
                icon: 'error',
                title: 'PDF...',
                text: '*NO se ha registrado el archivo PDF!'
              });
        }else{
            window.open("../../../Services/pdf/"+x_pdf,"_blank");
            f_unlink_pdf(x_pdf);      
        }
    });
    ///:: FIN BOTON VER ARCHIVO PDF :::::::::::::::::::::::::::::::::::::::::::::::::::::::///       

    ///:: BOTON VER ARCHIVO PDF :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///       
    $(document).on("click", ".btn_xlpdf_solicitudes", function(){		
        let x_pdf     = "";
        let file_pdf  = "N_SO-"+solicitudes_id;
        x_pdf         = f_buscar_pdf('ope_solicitudes_pdf','spdf_pdf','spdf_solicitudes_id',solicitudes_id,'','',file_pdf );
        if(x_pdf == ""){
            Swal.fire({
                icon: 'error',
                title: 'PDF...',
                text: '*NO se ha registrado el archivo PDF!'
              });
        }else{
            window.open("../../../Services/pdf/"+x_pdf,"_blank");
            f_unlink_pdf(x_pdf); 
        }
    });
    ///:: FIN BOTON VER ARCHIVO PDF :::::::::::::::::::::::::::::::::::::::::::::::::::::::///       

    ///:: BOTON OBSERVAR SOLICITUDES ::::::::::::::::::::::::::::::::::::::::::::::::::::::/// 
    $(document).on("click", ".btn_observar_solicitudes", function(){
        fila_solicitudes    = $(this).closest("tr");
        solicitudes_id      = fila_solicitudes.find('td:eq(1)').text();
        soli_estado         = fila_solicitudes.find('td:eq(11)').text();
        
        if(soli_estado=='PENDIENTE'){
            Swal.fire({
                title: '¿Está seguro?',
                text: "Se OBSERVARA el registro "+solicitudes_id+" !!!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si, observar!',
                cancelButtonText: 'Cancelar'
                }).then((result) => {
                    if (result.isConfirmed){
                        Swal.fire(
                            'OBSERVADO!',
                            'El registro ha sido observado.',
                            'success')
                        respuesta = 1;
                        if (respuesta == 1){ 
                            soli_estado             = "OBSERVADO";
                            soli_detalle_respuesta  = "";
                            soli_respuesta          = "";          
                            Accion                  = 'estado_solicitudes';
                            $.ajax({
                                url       : "Ajax.php",
                                type      : "POST",
                                datatype  : "json",    
                                data      : { MoS:MoS, NombreMoS:NombreMoS, Accion:Accion, solicitudes_id:solicitudes_id, soli_estado:soli_estado, soli_detalle_respuesta:soli_detalle_respuesta, soli_respuesta:soli_respuesta},   
                                success   : function(data) {
                                    tabla_solicitudes.ajax.reload(null, false);
                                }
                            });
                        }
                    }
                });
  
        }else{
            Swal.fire({
                position            : 'center',
                icon                : 'error',
                title               : '* Estado PENDIENTE !!!',
                html                : 'Solo se observan las solicitudes en estado PENDIENTE',
                showConfirmButton   : false,
                timer: 2500
              })
        }
    });
    ///:: FIN BOTON OBSERVAR SOLICITUDES ::::::::::::::::::::::::::::::::::::::::::::::::::///

    ///:: BOTON CITAR SOLICITUDES :::::::::::::::::::::::::::::::::::::::::::::::::::::::::/// 
    $(document).on("click", ".btn_citar_solicitudes", function(){
        if(soli_estado=='PENDIENTE'){
            if(soli_tipo=='CARTAS'){
                Swal.fire({
                    position            : 'center',
                    icon                : 'error',
                    title               : '* Tipo CARTAS !!!',
                    html                : 'Solo se citan las solicitudes de PILOTOS',
                    showConfirmButton   : false,
                    timer: 2500
                  })    
            }else{
                $("#btn_citar_solicitudes").prop("disabled",true);
                Swal.fire({
                    title: '¿Está seguro?',
                    text: "Se citará a "+soli_apellidos_nombres+" !!!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Si, citar!',
                    cancelButtonText: 'Cancelar'
                    }).then((result) => {
                        if (result.isConfirmed){
                            Swal.fire(
                                'CITADO!',
                                'El piloto ha sido citado.',
                                'success')
                            respuesta = 1;
                            if (respuesta == 1){ 
                                soli_estado             = "CITACION";
                                soli_detalle_respuesta  = "";
                                soli_respuesta          = "";          
                                Accion                  = 'estado_solicitudes';
                                $.ajax({
                                    url       : "Ajax.php",
                                    type      : "POST",
                                    datatype  : "json",    
                                    data      : { MoS:MoS, NombreMoS:NombreMoS, Accion:Accion, solicitudes_id:solicitudes_id, soli_estado:soli_estado, soli_detalle_respuesta:soli_detalle_respuesta, soli_respuesta:soli_respuesta},   
                                    success   : function(data) {
                                        tabla_solicitudes.ajax.reload(null, false);
                                    }
                                });
                            }
                        }
                    });    
            }  
        }else{
            Swal.fire({
                position            : 'center',
                icon                : 'error',
                title               : '* Estado PENDIENTE !!!',
                html                : 'Solo se citan las solicitudes en estado PENDIENTE',
                showConfirmButton   : false,
                timer: 2500
              })
        }
        $('#modal_crud_ver_solicitudes').modal('hide');
    });
    ///:: FIN BOTON OBSERVAR SOLICITUDES ::::::::::::::::::::::::::::::::::::::::::::::::::///

    ///:: EVENTO DEL BOTON VALIDAR PEDIDO :::::::::::::::::::::::::::::::::::::::::::::::::::///
    $(document).on("click", ".btn_validar_solicitudes", function(){
        fila_solicitudes    = $(this).closest("tr");
        solicitudes_id      = fila_solicitudes.find('td:eq(1)').text();
        soli_estado         = fila_solicitudes.find('td:eq(11)').text();

        if(soli_estado=='PENDIENTE' || soli_estado=='CITACION'){
            $("#isoli_detalle_respuesta").removeClass("color-error");
            $("#form_ver_solicitudes").trigger("reset");
            let buscar_pdf      = "";
            pdf_editar          = "";
    
            solicitudes_id          = fila_solicitudes.find('td:eq(1)').text();
            soli_fecha_ingreso      = fila_solicitudes.find('td:eq(2)').text();
            soli_fecha_recepcion    = fila_solicitudes.find('td:eq(3)').text();
            soli_dni                = fila_solicitudes.find('td:eq(4)').text();
            soli_apellidos_nombres  = fila_solicitudes.find('td:eq(5)').text();
            soli_fecha_inicio       = fila_solicitudes.find('td:eq(6)').text();
            soli_fecha_fin          = fila_solicitudes.find('td:eq(7)').text();
            soli_tipo               = fila_solicitudes.find('td:eq(8)').text();
            soli_codigo_adm         = fila_solicitudes.find('td:eq(9)').text();
            soli_descripcion        = fila_solicitudes.find('td:eq(10)').text();
            soli_estado             = fila_solicitudes.find('td:eq(11)').text();
            soli_respuesta          = fila_solicitudes.find('td:eq(12)').text();
            soli_detalle_respuesta  = fila_solicitudes.find('td:eq(13)').text();
            soli_usuario_nombres    = fila_solicitudes.find('td:eq(14)').text();
            soli_responsable_nombres= fila_solicitudes.find('td:eq(15)').text();
    
            let a_data = f_BuscarDataBD('ope_solicitudes','solicitudes_id',solicitudes_id);
            $.each(a_data, function(idx, obj){ 
                soli_log = obj.soli_log;
            });
    
            $("#isolicitudes_id").html(':&nbsp&nbsp'+solicitudes_id);
            $("#isoli_fecha_ingreso").html(':&nbsp&nbsp'+soli_fecha_ingreso);
            $("#isoli_fecha_recepcion").html(':&nbsp&nbsp'+soli_fecha_recepcion);
            $("#isoli_dni").html(':&nbsp&nbsp'+soli_dni);
            $("#isoli_apellidos_nombres").html(':&nbsp&nbsp'+soli_apellidos_nombres);
            $("#isoli_fecha_inicio").html(':&nbsp&nbsp'+soli_fecha_inicio);
            $("#isoli_fecha_fin").html(':&nbsp&nbsp'+soli_fecha_fin);
            $("#isoli_tipo").html(':&nbsp&nbsp'+soli_tipo);
            $("#isoli_codigo_adm").html(':&nbsp&nbsp'+soli_codigo_adm);
            $("#isoli_descripcion").val(soli_descripcion);
            $("#isoli_estado").html(':&nbsp&nbsp'+soli_estado);
            $("#isoli_respuesta").html(':&nbsp&nbsp'+soli_respuesta);
            $("#isoli_detalle_respuesta").val(soli_detalle_respuesta);
            $("#isoli_usuario_nombres").html(':&nbsp&nbsp'+soli_usuario_nombres);
            $("#isoli_responsable_nombres").html(':&nbsp&nbsp'+soli_responsable_nombres);

            $("#isoli_detalle_respuesta").prop("disabled",false);

            $("#idiv_validacion_solicitudes").html(f_validacion_solicitudes(soli_fecha_ingreso, soli_fecha_recepcion, soli_fecha_inicio, soli_tipo, soli_dni));
    
            div_boton = f_BotonesFormulario("form_ver_solicitudes","btn_validar");
            $("#idiv_btn_ver_solicitudes").html(div_boton);
        
            $(".modal-header").css("background-color", "#007bff");
            $(".modal-header").css("color", "white" );
            $(".modal-title").text("Validar Solicitudes");		
            $('#modal_crud_ver_solicitudes').modal('show');
            $('#modal-resizable').resizable();
            $(".modal-dialog").draggable({
              cursor: "move",
              handle: ".dragable_touch",
            });            
        }else{
            Swal.fire({
                position            : 'center',
                icon                : 'error',
                title               : '* Estado PENDIENTE !!!',
                html                : 'Solo se validan las solicitudes en estado PENDIENTE',
                showConfirmButton   : false,
                timer: 2500
              })            
        }
    });
    ///:: FIN EVENTO DEL BOTON VALIDAR PEDIDO :::::::::::::::::::::::::::::::::::::::::::::::///

    ///:: EVENTO DEL BOTON APROBAR PEDIDO :::::::::::::::::::::::::::::::::::::::::::::::::::///
    $(document).on("click", ".btn_aprobar_solicitudes", function(){
        $("#isoli_detalle_respuesta").removeClass("color-error");
        obs_aprobar         = $("#isoli_detalle_respuesta").val();

        if(obs_aprobar == ""){
            $("#isoli_detalle_respuesta").addClass("color-error");
            Swal.fire({
                position          : 'center',
                icon              : 'error',
                title             : '*Falta Completar Información!!!',
                showConfirmButton : false,
                timer             : 1500
            })
        }else{
            $("#btn_aprobar_solicitudes").prop("disabled",true);
            soli_estado     = "ATENDIDO";
            soli_respuesta  = "APROBADO";
            Accion          = 'estado_solicitudes';
            $.ajax({
                url       : "Ajax.php",
                type      : "POST",
                datatype  : "json",
                async     : false,
                data      : {MoS:MoS,NombreMoS:NombreMoS,Accion:Accion, solicitudes_id:solicitudes_id, soli_estado:soli_estado, soli_detalle_respuesta:obs_aprobar, soli_respuesta:soli_respuesta},    
                success   : function(data){
                    tabla_solicitudes.ajax.reload(null, false);
                }
            });
            $('#modal_crud_ver_solicitudes').modal('hide');
        }
    });
    ///:: FIN EVENTO DEL BOTON APROBAR PEDIDO :::::::::::::::::::::::::::::::::::::::::::::///

    ///:: EVENTO DEL BOTON RECHAZAR PEDIDO ::::::::::::::::::::::::::::::::::::::::::::::::///
    $(document).on("click", ".btn_desaprobar_solicitudes", function(){
        $("#isoli_detalle_respuesta").removeClass("color-error");
        obs_aprobar         = $("#isoli_detalle_respuesta").val();
        
        if(obs_aprobar == ""){
            $("#isoli_detalle_respuesta").addClass("color-error");
            Swal.fire({
                position          : 'center',
                icon              : 'error',
                title             : '*Falta Completar Información!!!',
                showConfirmButton : false,
                timer             : 1500
            })
        }else{
            $("#btn_deaaprobar_solicitudes").prop("disabled",true);
            soli_estado     = "ATENDIDO";
            soli_respuesta  = "DESAPROBADO";
            Accion          = 'estado_solicitudes';
            $.ajax({
                url       : "Ajax.php",
                type      : "POST",
                datatype  : "json",
                async     : false,
                data      : {MoS:MoS,NombreMoS:NombreMoS,Accion:Accion, solicitudes_id:solicitudes_id, soli_estado:soli_estado, soli_detalle_respuesta:obs_aprobar, soli_respuesta:soli_respuesta},    
                success: function(data){
                    tabla_solicitudes.ajax.reload(null, false);
                }
            });
            $('#modal_crud_ver_solicitudes').modal('hide');
        }
    });
    ///:: FIN EVENTO DEL BOTON RECHAZAR PEDIDO ::::::::::::::::::::::::::::::::::::::::::::///

    ///:: BOTON VER SOLICITUDES :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///       
    $(document).on("click", ".btn_ver_solicitudes", function(){
        $("#form_ver_solicitudes").trigger("reset");
        let buscar_pdf      = "";
        pdf_editar          = "";
        fila_solicitudes    = $(this).closest("tr");

        solicitudes_id          = fila_solicitudes.find('td:eq(1)').text();
        soli_fecha_ingreso      = fila_solicitudes.find('td:eq(2)').text();
        soli_fecha_recepcion    = fila_solicitudes.find('td:eq(3)').text();
        soli_dni                = fila_solicitudes.find('td:eq(4)').text();
        soli_apellidos_nombres  = fila_solicitudes.find('td:eq(5)').text();
        soli_fecha_inicio       = fila_solicitudes.find('td:eq(6)').text();
        soli_fecha_fin          = fila_solicitudes.find('td:eq(7)').text();
        soli_tipo               = fila_solicitudes.find('td:eq(8)').text();
        soli_codigo_adm         = fila_solicitudes.find('td:eq(9)').text();
        soli_descripcion        = fila_solicitudes.find('td:eq(10)').text();
        soli_estado             = fila_solicitudes.find('td:eq(11)').text();
        soli_respuesta          = fila_solicitudes.find('td:eq(12)').text();
        soli_detalle_respuesta  = fila_solicitudes.find('td:eq(13)').text();
        soli_usuario_nombres    = fila_solicitudes.find('td:eq(14)').text();
        soli_responsable_nombres= fila_solicitudes.find('td:eq(15)').text();

        let a_data = f_BuscarDataBD('ope_solicitudes','solicitudes_id',solicitudes_id);
        $.each(a_data, function(idx, obj){ 
            soli_log = obj.soli_log;
        });

        $("#isolicitudes_id").html(':&nbsp&nbsp'+solicitudes_id);
        $("#isoli_fecha_ingreso").html(':&nbsp&nbsp'+soli_fecha_ingreso);
        $("#isoli_fecha_recepcion").html(':&nbsp&nbsp'+soli_fecha_recepcion);
        $("#isoli_dni").html(':&nbsp&nbsp'+soli_dni);
        $("#isoli_apellidos_nombres").html(':&nbsp&nbsp'+soli_apellidos_nombres);
        $("#isoli_fecha_inicio").html(':&nbsp&nbsp'+soli_fecha_inicio);
        $("#isoli_fecha_fin").html(':&nbsp&nbsp'+soli_fecha_fin);
        $("#isoli_tipo").html(':&nbsp&nbsp'+soli_tipo);
        $("#isoli_codigo_adm").html(':&nbsp&nbsp'+soli_codigo_adm);
        $("#isoli_descripcion").val(soli_descripcion);
        $("#isoli_estado").html(':&nbsp&nbsp'+soli_estado);
        $("#isoli_respuesta").html(':&nbsp&nbsp'+soli_respuesta);
        $("#isoli_detalle_respuesta").val(soli_detalle_respuesta);
        $("#isoli_usuario_nombres").html(':&nbsp&nbsp'+soli_usuario_nombres);
        $("#isoli_responsable_nombres").html(':&nbsp&nbsp'+soli_responsable_nombres);
        
        $("#isoli_detalle_respuesta").prop("disabled",true);
        buscar_pdf = f_buscar_pdf_solicitudes(solicitudes_id);
        if(buscar_pdf==""){
            pdf_editar = '<iframe src="Module/solicitudes/View/Img/VistaPrevia.pdf" width="530" height="620"></iframe>';        
        }else{
            pdf_editar = '<iframe src="' + buscar_pdf + '"  width="530" height="620"></iframe>';
        }
        $("#idiv_ver_solicitudes_pdf").html(pdf_editar);

        $("#idiv_validacion_solicitudes").html(f_validacion_solicitudes(soli_fecha_ingreso, soli_fecha_recepcion, soli_fecha_inicio, soli_tipo, soli_dni));

        div_boton = f_BotonesFormulario("form_ver_solicitudes","");
        $("#idiv_btn_ver_solicitudes").html(div_boton);
    
        $(".modal-header").css("background-color", "#007bff");
        $(".modal-header").css("color", "white" );
        $(".modal-title").text("Ver Solicitudes");		
        $('#modal_crud_ver_solicitudes').modal('show');
        $('#modal-resizable').resizable();
        $(".modal-dialog").draggable({
          cursor: "move",
          handle: ".dragable_touch",
        });
    
    });
    ///:: FIN BOTON VER SOLICITUDES :::::::::::::::::::::::::::::::::::::::::::::::::::::::/// 

    ///:: BOTON DESCARGAR SOLICITUDES :::::::::::::::::::::::::::::::::::::::::::::::::::::///
    $(document).on("click", ".btn_descargar_solicitudes", function(){		
        sele_fecha_inicio   = $("#sele_fecha_inicio").val();
        sele_fecha_termino  = $("#sele_fecha_termino").val();
        Accion          = 'descargar_solicitudes';
        $.ajax({
            url         : "Ajax.php",
            type        : "POST",
            datatype    : "json",
            async       : false,
            data        : {MoS:MoS,NombreMoS:NombreMoS,Accion:Accion,fecha_inicio:sele_fecha_inicio,fecha_termino:sele_fecha_termino},
            beforeSend  : function(){
                Swal.fire({
                    icon              : 'success',
                    title             : 'Procesando Información',
                    showConfirmButton : false,
                    timer             : 5000
                })
            },
            success     : function(data){
                window.location.href = mi_carpeta + "Module/solicitudes/Controller/csv_descarga.php?Archivo=" + data;
            }
        });
    });
    ///:: FIN BOTON DESCARGAR SOLICITUDES :::::::::::::::::::::::::::::::::::::::::::::::::///

    ///:: EVENTO DEL BOTON VER LOG SOLICITUDES ::::::::::::::::::::::::::::::::::::::::::::///
    $(document).on("click", ".btn_log_solicitudes", function(){
        $("#form_modal_log_solicitudes").trigger("reset");
        $("#div_log_solicitudes").html(soli_log);
        
        $(".modal-header-log").css( "background-color", "#17a2b8");
        $(".modal-header-log").css( "color", "white" );
        $(".modal-title-log").text("Log");
        $('#modal_crud_log_solicitudes').modal('show');
        $('#modal-resizable').resizable();
        $(".modal-dialog").draggable({
          cursor: "move",
          handle: ".dragable_touch",
        });
    });
    ///:: FIN EVENTO DEL BOTON VER LOG SOLICITUDES ::::::::::::::::::::::::::::::::::::::::///


    ///:: TERMINO BOTONES DE SOLICITUDES ::::::::::::::::::::::::::::::::::::::::::::::::::///
});
///:: TERMINO JS DOM SOLICITUDES ::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///



///:: FUNCIONES DE SOLICITUDES ::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///

///:: FUNCION PARA VALIDAR LOS DATOS INGRESADOS AL FORMULARIO :::::::::::::::::::::::::::::///
function f_validar_solicitudes(p_soli_fecha_ingreso, p_soli_fecha_recepcion, p_soli_tipo, p_soli_codigo_adm, p_soli_dni, p_soli_apellidos_nombres, p_soli_fecha_inicio, p_soli_fecha_fin, p_soli_descripcion){
    f_limpia_solicitudes();
    NoLetrasMayuscEspacio=/[^A-Z \Ñ \Ä \Ë \Ö \Ü \Á \É \Í \Ó \Ú]/;
    let rpta_validar_solicitudes="";    
   
    if(p_soli_fecha_ingreso==""){
        $("#soli_fecha_ingreso").addClass("color-error");
        rpta_validar_solicitudes="invalido";
    }

    if(p_soli_fecha_recepcion==""){
        $("#soli_fecha_recepcion").addClass("color-error");
        rpta_validar_solicitudes="invalido";
    }

    if(p_soli_tipo==""){
        $("#soli_tipo").addClass("color-error");
        rpta_validar_solicitudes="invalido";
    }

/*     if(p_soli_codigo_adm==""){
        $("#soli_codigo_adm").addClass("color-error");
        rpta_validar_solicitudes="invalido";
    }
 */
    if(p_soli_dni==""){
        $("#soli_dni").addClass("color-error");
        rpta_validar_solicitudes="invalido";
    }

    if(p_soli_apellidos_nombres==""){
        $("#soli_apellidos_nombres").addClass("color-error");
        rpta_validar_solicitudes="invalido";
    }

    if(p_soli_fecha_inicio==""){
        $("#soli_fecha_inicio").addClass("color-error");
        rpta_validar_solicitudes="invalido";
    }

    if(p_soli_fecha_fin==""){
        $("#soli_fecha_fin").addClass("color-error");
        rpta_validar_solicitudes="invalido";
    }

    if(p_soli_descripcion==""){
        $("#soli_descripcion").addClass("color-error");
        rpta_validar_solicitudes="invalido";
    }

    if(p_soli_fecha_inicio > p_soli_fecha_fin){
        $("#soli_fecha_inicio").addClass("color-error");
        rpta_validar_solicitudes="invalido";
    }

    return rpta_validar_solicitudes; 
}
///:: FIN FUNCION PARA VALIDAR LOS DATOS INGRESADOS AL FORMULARIO :::::::::::::::::::::::::///

///:: BORRA EL FORMATO DE COLOR ERROR EN LOS CAMPOS DEL FORMULARIO ::::::::::::::::::::::::/// 
function f_limpia_solicitudes(){
    $("#soli_fecha_ingreso").removeClass("color-error");
    $("#soli_fecha_recepcion").removeClass("color-error");
    $("#soli_tipo").removeClass("color-error");
    $("#soli_dni").removeClass("color-error");
    $("#soli_apellidos_nombres").removeClass("color-error");
    $("#soli_fecha_inicio").removeClass("color-error");
    $("#soli_fecha_fin").removeClass("color-error");
    $("#soli_descripcion").removeClass("color-error");
}
///:: FIN BORRA EL FORMATO DE COLOR ERROR EN LOS CAMPOS DEL FORMULARIO ::::::::::::::::::::/// 

///:: FUNCION PARA BUSCAR PDF :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///       
function f_buscar_pdf_solicitudes(solicitudes_id){
    let pdf = "";
    Accion  ='pdf_solicitudes';
    $.ajax({
        url         : "Ajax.php",
        type        : "POST",
        datatype    : "json",    
        async       : false,   
        data        : { MoS:MoS,NombreMoS:NombreMoS,Accion:Accion,solicitudes_id:solicitudes_id },   
        success     : function(data) {
            data = $.parseJSON(data);
            $.each(data, function(idx, obj){ 
                if(obj.b64_pdf){
                    pdf  = 'data:application/pdf;base64,' + obj.b64_pdf;
                }
            });
        }
    });	
    return pdf;
}
///:: FIN FUNCION PARA BUSCAR PDF :::::::::::::::::::::::::::::::::::::::::::::::::::::::::///

///:: FUNCION GRABAR PDF ::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
function f_grabar_pdf_solicitudes(p_solicitudes_id){
    let blobFile = $('#soli_pdf')[0].files[0];
    let formData = new FormData();
    Accion       = 'grabar_pdf_solicitudes';

    formData.append("MoS", MoS);
    formData.append("NombreMoS", NombreMoS);
    formData.append("Accion", Accion);
    formData.append("solicitudes_id", p_solicitudes_id);
    formData.append("soli_pdf", blobFile);
    
    $.ajax({
        url         : "Ajax.php",
        type        : "POST",
        datatype    : "json",    
        data        :  formData,   
        contentType : false,
        processData : false,
        success     : function(data) {
       
        }
    });
}
///:: FIN FUNCION GRABAR PDF ::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///

///:: FUNCION COLOR A FILAS DATATABLE :::::::::::::::::::::::::::::::::::::::::::::::::::::///
function f_color_filas_solicitudes(row,data){
    let color;
    // Columna Estado
    switch(data.soli_estado)
    {
        case "ATENDIDO":
            color = "#53A258";
        break;
        case "ABIERTO":
            color = "#EC515D";
        break;
        case "CITACION":
            color = "#00A3D6";
        break;
        case "OBSERVADO":
            color = "#FF9D0A";
        break;
        case "PENDIENTE":
            color = "#EC515D";
        break;
    }
    $("td:eq(11)",row).css({
      "color":color,
      "font-weight":"bold",
    });
  }
///:: FIN FUNCION COLOR A FILAS DATATABLE::::::::::::::::::::::::::::::::::::::::::::::::::///

///:: FUNCION PARA VALIDAR LOS DATOS INGRESADOS AL FORMULARIO :::::::::::::::::::::::::::::///
function f_validar_seleccion(p_sele_fecha_inicio, p_sele_fecha_termino){
    f_limpia_seleccion();
    let rpta_validar_seleccion ="";    
  
    if(p_sele_fecha_inicio > p_sele_fecha_termino){
      $("#sele_fecha_inicio").addClass("color-error");
      rpta_validar_seleccion = "invalido";
    }
    if(p_sele_fecha_inicio == ""){
      $("#sele_fecha_inicio").addClass("color-error");
      rpta_validar_seleccion = "invalido";
    }
    if(p_sele_fecha_termino == ""){
        $("#sele_fecha_termino").addClass("color-error");
        rpta_validar_seleccion = "invalido";
    }  
    return rpta_validar_seleccion; 
  }
///:: FIN FUNCION PARA VALIDAR LOS DATOS INGRESADOS AL FORMULARIO :::::::::::::::::::::::::///

///:: REMUEVE EL COLOR DE ERROR EN LOS CAMPOS DEL FORMULARIO ::::::::::::::::::::::::::::::/// 
function f_limpia_seleccion(){
    $("#sele_fecha_inicio").removeClass("color-error");
    $("#sele_fecha_termino").removeClass("color-error");
}
///:: FIN REMUEVE EL COLOR DE ERROR EN LOS CAMPOS DEL FORMULARIO ::::::::::::::::::::::::::/// 

///:: FUNCION QUE VALIDA LAS FECHAS DE LA SOLICITUD :::::::::::::::::::::::::::::::::::::::///
function f_validacion_solicitudes(p_fecha_ingreso, p_fecha_recepcion, p_fecha_inicio, p_tipo, p_dni){
let rpta_validacion_solicitudes = '';
if(p_tipo!="CARTAS"){
    Accion='validacion_solicitudes';
    $.ajax({
      url           : "Ajax.php",
      type          : "POST",
      datatype      : "json",
      async         : false,
      data          : {MoS:MoS, NombreMoS:NombreMoS, Accion:Accion, fecha_ingreso:p_fecha_ingreso, fecha_recepcion:p_fecha_recepcion, fecha_inicio:p_fecha_inicio, dni:p_dni},    
      success       : function(data){
        rpta_validacion_solicitudes = data;
      }
    });    
}
return rpta_validacion_solicitudes
}
///:: FIN FUNCION QUE VALIDA LAS FECHAS DE LA SOLICITUD :::::::::::::::::::::::::::::::::::///

///:: FUNCION MOSTRAR DATATABLE INASISTENCIAS :::::::::::::::::::::::::::::::::::::::::::::///
function f_mostrar_datatable_solicitudes(p_accion){
    f_limpia_seleccion();
    let t_diferencia_fecha, t_validar_seleccion;
    sele_fecha_inicio       = $("#sele_fecha_inicio").val();
    sele_fecha_termino      = $("#sele_fecha_termino").val();
    t_diferencia_fecha      = f_DiferenciaFecha(sele_fecha_inicio,sele_fecha_termino,'366');
    t_validar_seleccion     = f_validar_seleccion(sele_fecha_inicio,sele_fecha_termino);

    if(t_validar_seleccion=="invalido"){
        Swal.fire({
          icon: 'error',
          title: 'Información...',
          text: '*Es posible que la Información no sea la correcta!!!'
        })
    }else{
        if(t_diferencia_fecha=="NO"){
          $("#sele_fecha_inicio").addClass("color-error");
          $("#sele_fecha_termino").addClass("color-error");
          Swal.fire({
              icon  : 'error',
              title : 'Rango de Fechas',
              html  : "Consulta debe ser MENOR a 1 año !!!",
            })
        }else{
            div_tabla               = f_CreacionTabla("tabla_solicitudes","");
            columnastabla           = f_ColumnasTabla("tabla_solicitudes","");
            //Accion                  = p_accion;
            
            $("#div_tabla_solicitudes").html(div_tabla);

            $('#tabla_solicitudes thead tr')
            .clone(true)
            .addClass('filters_solicitudes')
            .appendTo('#tabla_solicitudes thead');                

            tabla_solicitudes   = $('#tabla_solicitudes').DataTable({
                "rowCallback":function(row,data,index){
                    f_color_filas_solicitudes(row,data);
                  }, 
                  orderCellsTop: true,
                  fixedHeader: true,
                  initComplete: function (){
                      var api = this.api();
                      // For each column
                      api.columns().eq(0).each(function (colIdx) {
                          // Set the header cell to contain the input element
                          var cell = $('.filters_solicitudes th').eq($(api.column(colIdx).header()).index());
                          var title = $(cell).text();
                          $(cell).html('<input type="text" placeholder="' + title + '" />');
                          // On every keypress in this input
                          $('input',$('.filters_solicitudes th').eq($(api.column(colIdx).header()).index()) ).off('keyup change').on('keyup change', function (e) {
                              e.stopPropagation();
                              // Get the search value
                              $(this).attr('title', $(this).val());
                              var regexr = '({search})'; //$(this).parents('th').find('select').val();
                              var cursorPosition = this.selectionStart;
                              // Search the column for that value
                              api.column(colIdx).search(
                                  this.value != '' ? regexr.replace('{search}', '(((' + this.value + ')))'): '',
                                  this.value != '',
                                  this.value == ''
                              ).draw();
                              $(this).focus()[0].setSelectionRange(cursorPosition, cursorPosition);
                          });
                      });
                  },
        
                language            : idioma_espanol,
                responsive          : "true",
                processing          : "true",
                dom                 : 'Blfrtip',
                buttons             : [
                    {
                        extend      : 'excelHtml5',
                        text        : '<i class="fas fa-file-excel"></i> ',
                        titleAttr   : 'Exportar a Excel',
                        className   : 'btn btn-success',
                        title       : 'Solicitudes desde el ' + sele_fecha_inicio + ' al ' + sele_fecha_termino,
                        filename    : 'Solicitudes desde el ' + sele_fecha_inicio + ' al ' + sele_fecha_termino,
                    },
                ],
                "ajax"              : {            
                    "url"           : "Ajax.php", 
                    "method"        : 'POST',
                    "data"          : { MoS:MoS, NombreMoS:NombreMoS, Accion:p_accion, fecha_inicio:sele_fecha_inicio, fecha_termino:sele_fecha_termino },
                    "dataSrc"       : ""
                },
                "columns"           : columnastabla,
                "columnDefs"        : [
                    { "width": "5%", "targets": [0] },
                    {
                        "targets"   : [0,16],
                        "orderable" : false
                    },
                ],
                "order"             : [[1, 'desc']]
            });
        }
    }

}
///:: FIN FUNCION MOSTRAR DATATABLE INASISTENCIAS :::::::::::::::::::::::::::::::::::::::::///

///:: BUSCAR PDF ::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///       
function f_buscar_pdf(p_tabla, p_campo_archivo, p_campo_buscar, p_dato_buscar, p_campo_tipo_archivo, p_dato_tipo_archivo, p_nombre_archivo){
    let pdf="";
    Accion='buscar_pdf';
    $.ajax({
        url       : "Ajax.php",
        type      : "POST",
        datatype  : "json",    
        async     : false,   
        data      : { MoS:MoS, NombreMoS:NombreMoS, Accion:Accion, tabla:p_tabla, campo_archivo:p_campo_archivo, campo_buscar:p_campo_buscar, dato_buscar:p_dato_buscar, campo_tipo_archivo:p_campo_tipo_archivo, dato_tipo_archivo:p_dato_tipo_archivo, nombre_archivo:p_nombre_archivo },   
        success: function(data) {
          pdf = data;
        }
    });	
    return pdf;
}
///:: FIN BUSCAR PDF ::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///

///:: BORRAR PDF SERVIDOR :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
function f_unlink_pdf(p_archivo){
    let rpta_unlink_pdf = "";
    Accion = 'unlink_pdf';
    $.ajax({
        url       : "Ajax.php",
        type      : "POST",
        datatype  : "json",    
        async     : false,   
        data      : { MoS:MoS, NombreMoS:NombreMoS, Accion:Accion, archivo:p_archivo },   
        success: function(data) {
          rpta_unlink_pdf = data;
        }
    });
    return rpta_unlink_pdf;
}
///:: FIN BORRAR PDF SERVIDOR :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///

///:: TERMINO FUNCIONES DE SOLICITUDES ::::::::::::::::::::::::::::::::::::::::::::::::::::///