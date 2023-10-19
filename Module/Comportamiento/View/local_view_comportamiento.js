///::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
///:: TAB CRUD COMPORTAMIENTO v 2.0  FECHA: 2023-05-20 ::::::::::::::::::::::::::::::::::::///
///:: CREAR EDITAR Y ELIMINAR COMPORTAMIENTO ;;;;;;;;;;;;;;;;;;;;;:::::::::::::::::::::::::///
///::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///

///:: DECLARACION DE VARIABLES ::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///

///:: DOM JS CRUD COMPORTAMIENTO ::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
$(document).ready(function(){
  ///:: CAMBIOS EN FECHA ACTUALIZA TABLAS :::::::::::::::::::::::::::::::::::::::::::::::::///
  $("#comp_fechaoperacion").on('change', function () {
    comp_fechaoperacion = $("#comp_fechaoperacion").val();
    data_html = f_select_tabla(comp_fechaoperacion, comp_operacion);
    comp_tabla = "";
    $("#comp_tabla").html(data_html);
    $("#comp_tabla").val(comp_tabla);
  });

  // Si hay cambios en tabla de accidentes se actualiza el servicio
  $(document).on('change', '#comp_tabla', function () {
    comp_fechaoperacion = $("#comp_fechaoperacion").val();
    comp_tabla          = $("#comp_tabla").val();
    Accion = 'buscar_servicio';
    $.ajax({
      url       : "Ajax.php",
      type      : "POST",
      datatype  : "json",    
      data      : {MoS:MoS,NombreMoS:NombreMoS,Accion:Accion,Prog_Fecha:comp_fechaoperacion,Prog_Tabla:comp_tabla},    
      success   : function(data){
        $("#comp_servicio").val(data);
      }
    });
  });

  $(document).on('change', '#horainicio', function() {
    comp_horainicio = "";
    comp_horafin    = "";
    horainicio      = $.trim($('#horainicio').val());
    minutoinicio    = $.trim($('#minutoinicio').val());
    if(horainicio !="" && minutoinicio!=""){
      comp_horainicio = horainicio + ":" + minutoinicio;
    }
    horafin         = $.trim($('#horafin').val());
    minutofin       = $.trim($('#minutofin').val());
    if(horafin!="" && minutofin!=""){
      comp_horafin  = horafin + ":" + minutofin;
    }
    comp_total_horas = f_calcular_diferencia_horas(comp_horainicio,comp_horafin);
    $("#comp_total_horas").val(comp_total_horas);
  });

  $(document).on('change', '#minutoinicio', function() {
    comp_horainicio = "";
    comp_horafin    = "";
    horainicio      = $.trim($('#horainicio').val());
    minutoinicio = $.trim($('#minutoinicio').val());
    if(horainicio !="" && minutoinicio!=""){
      comp_horainicio = horainicio + ":" + minutoinicio;
    }
    horafin         = $.trim($('#horafin').val());
    minutofin       = $.trim($('#minutofin').val());
    if(horafin!="" && minutofin!=""){
      comp_horafin  = horafin + ":" + minutofin;
    }
    comp_total_horas = f_calcular_diferencia_horas(comp_horainicio,comp_horafin);
    $("#comp_total_horas").val(comp_total_horas);
  });
  
  $(document).on('change', '#horafin', function() {
    comp_horainicio = "";
    comp_horafin    = "";
    horainicio      = $.trim($('#horainicio').val());
    minutoinicio    = $.trim($('#minutoinicio').val());
    if(horainicio !="" && minutoinicio!=""){
      comp_horainicio = horainicio + ":" + minutoinicio;
    }
    horafin         = $.trim($('#horafin').val());
    minutofin       = $.trim($('#minutofin').val());
    if(horafin!="" && minutofin!=""){
      comp_horafin  = horafin + ":" + minutofin;
    }
    comp_total_horas = f_calcular_diferencia_horas(comp_horainicio,comp_horafin);
    $("#comp_total_horas").val(comp_total_horas);
  });
  
  $(document).on('change', '#minutofin', function() {
    comp_horainicio   = "";
    comp_horafin      = "";
    horainicio        = $.trim($('#horainicio').val());
    minutoinicio      = $.trim($('#minutoinicio').val());
    if(horainicio !="" && minutoinicio!=""){
      comp_horainicio = horainicio + ":" + minutoinicio;
    }
    horafin           = $.trim($('#horafin').val());
    minutofin         = $.trim($('#minutofin').val());
    if(horafin!="" && minutofin!=""){
      comp_horafin    = horafin + ":" + minutofin;
    }
    comp_total_horas   = f_calcular_diferencia_horas(comp_horainicio,comp_horafin);
    $("#comp_total_horas").val(comp_total_horas);
  });

  $(document).on('change', '#comp_grado_falta', function() {
    let data_html = "";
    comp_grado_falta = $.trim($('#comp_grado_falta').val());
    comp_codigofalta = "";
    comp_faltacometida = "";
    data_html = f_select_combo("ope_accidentesmatriz","NO","acmt_busqueda","","`acmt_campo`='"+comp_grado_falta+"'");
    $("#comp_codigofalta").html(data_html);
    $("#comp_codigofalta").val(comp_codigofalta);
    $("#comp_faltacometida").val(comp_faltacometida);
  });

  $(document).on('change', '#comp_codigofalta', function() {
    comp_grado_falta = $.trim($('#comp_grado_falta').val());
    comp_codigofalta = $.trim($('#comp_codigofalta').val());
    comp_faltacometida = f_buscar_dato("ope_accidentesmatriz", "acmt_respuesta", "`acmt_campo`='"+comp_grado_falta+"' AND `acmt_busqueda`='"+comp_codigofalta+"'");
    $("#comp_faltacometida").val(comp_faltacometida);
  });

  ///:: BOTONES CRUD COMPORTAMIENTO :::::::::::::::::::::::::::::::::::::::::::::::::::::::///

  ///:: BOTON INFORME COMPORTAMIENTO  :::::::::::::::::::::::::::::::::::::::::::::::::::::///
  $(document).on("click", ".btnComportamiento", function(){
    f_limpia_comportamiento();
    f_CargarVariablesVacioComportamiento(); // se inicialiazan las variables de informe de COMPORTAMIENTO
    $("#div_FaltaCometida").hide();  
    $("#div_ReporteGDH").hide();  
    $("#btnGuardarComportamiento").show();
    $("#btnGuardarComportamiento").prop("disabled",false);
    filaComportamiento  = $(this).closest('tr'); 
    comp_programacionid = filaComportamiento.find('td:eq(0)').text();
    comp_novedadid      = filaComportamiento.find('td:eq(1)').text();
    comportamiento_id   = filaComportamiento.find('td:eq(13)').text();

    // SE REVISA EL ESTADO DEL INFORME DE COMPORTAMIENTO
    Accion='EstadoComportamiento';
    comp_estadocomportamiento = "";
    $.ajax({
      url: "Ajax.php",
      type: "POST",
      datatype:"json",
      async: false,    
      data: {MoS:MoS,NombreMoS:NombreMoS,Accion:Accion,comportamiento_id:comportamiento_id},    
      success: function(data){
        comp_estadocomportamiento = data;
      }
    });
    // SI EL ESTADO ES VACIO SE REALIZA LA CARGA INICIAL DEL INFORME COMPORTAMIENTO CON LA INFORMACION DEL CONTROL FACILITADOR Y NOVEDAD
    if(comp_estadocomportamiento==""){
      opcionComportamiento = "CREAR";  // CREAR NUEVO COMPORTAMIENTO
      Accion='CargaInicialComportamiento';
      $.ajax({
        url: "Ajax.php",
        type: "POST",
        datatype:"json",
        async: false,    
        data: {MoS:MoS,NombreMoS:NombreMoS,Accion:Accion,comp_programacionid:comp_programacionid,comp_novedadid:comp_novedadid},    
        success: function(data){
          data = $.parseJSON(data);
          f_CargaInicialComportamiento(data);
        }
      });
    }else{
      //opcionComportamiento = "EDITAR";  // EDITAR COMPORTAMIENTO
      // SE BUSCA Y SE CARGA EL INFORME COMPORTAMIENTO
      Accion='CargaComportamiento';
      $.ajax({
        url: "Ajax.php",
        type: "POST",
        datatype:"json",
        async: false,    
        data: {MoS:MoS,NombreMoS:NombreMoS,Accion:Accion,comportamiento_id:comportamiento_id},
        success: function(data){
          data = $.parseJSON(data);
          f_CargarVariablesComportamiento(data);
        }
      });

    }

    $("#div_form_comportamiento_editar").html("");
    div_show = f_MostrarDiv("formComportamiento","div_form_comportamiento",comp_estadocomportamiento);
    $("#div_form_comportamiento").html(div_show);

    // SE CARGAN TODOS LOS COMBOS
    f_select_combo_comportamiento();
    f_CargaVariablesHtmlComportamiento();


    $(".modal-header").css( "background-color", "#17a2b8");
    $(".modal-header").css( "color", "white" );
    $(".modal-title").text( "Crear Comportamiento" );
    $('#modalCRUDComportamiento').modal('show');

  });
  ///:: FIN BOTON INFORME COMPORTAMIENTO  :::::::::::::::::::::::::::::::::::::::::::::::::///

  ///:: BOTON GRABAR -> REALIZA LA GRABACION DEL COMPORTAMIENTO :::::::::::::::::::::::::::///
  $('#formComportamiento').submit(function(e){
    e.preventDefault(); //evita el comportambiento normal del submit, es decir, recarga total de la página
    let t_validar_comportamiento="";
    f_CargarVariablesEditadasComportamiento();
    t_validar_comportamiento = f_validar_comportamiento(comp_tiponovedad, comp_fechaoperacion, comp_nombrecolaborador, comp_descripcion, comp_tabla, comp_servicio, comp_bus, comp_nombrecgo, comp_lugarexacto, comp_lugar_origen, comp_lugar_destino,  horainicio, minutoinicio, horafin, minutofin, comp_total_horas, comp_detallenovedad, comp_estadocomportamiento, comp_reconoceresponsabilidad, comp_grado_falta, comp_codigofalta, comp_faltacometida, comp_monto, comp_linkvideo, comp_obs_log);
    if(t_validar_comportamiento=="invalido"){
      Swal.fire({
        icon  : 'error',
        title : 'EDITAR...',
        text  : '*Los Campos no pueden estar VACIOS!'
      });
    }else{
      // CREAR NUEVO COMPORTAMIENTO
      if(opcionComportamiento=="CREAR"){
        $("#btnGuardarComportamiento").prop("disabled",true);
        Accion = 'CrearComportamiento';
        $.ajax({
          url       : "Ajax.php",
          type      : "POST",
          datatype  : "json",    
          data:  { MoS:MoS, NombreMoS:NombreMoS, Accion:Accion, comp_programacionid:comp_programacionid, comp_novedadid:comp_novedadid, comp_tiponovedad:comp_tiponovedad, comp_fechaoperacion:comp_fechaoperacion, comp_nombrecolaborador:comp_nombrecolaborador, comp_descripcion:comp_descripcion, comp_tabla:comp_tabla, comp_servicio:comp_servicio, comp_bus:comp_bus, comp_nombrecgo:comp_nombrecgo, comp_lugarexacto:comp_lugarexacto, comp_lugar_origen:comp_lugar_origen, comp_lugar_destino:comp_lugar_destino, comp_horainicio:comp_horainicio, comp_horafin:comp_horafin, comp_total_horas:comp_total_horas, comp_detallenovedad:comp_detallenovedad, comp_estadocomportamiento:comp_estadocomportamiento, comp_reconoceresponsabilidad:comp_reconoceresponsabilidad, comp_grado_falta:comp_grado_falta, comp_codigofalta:comp_codigofalta, comp_faltacometida:comp_faltacometida, comp_monto:comp_monto, comp_linkvideo:comp_linkvideo, comp_obs_log:comp_obs_log, comp_operacion:comp_operacion},    
          success: function(data) {
            tablaComportamiento.ajax.reload(null, false);
          }
        });
      }
      $('#modalCRUDComportamiento').modal('hide');
    }
  });
  ///:: FIN BOTON GRABAR -> REALIZA LA GRABACION DEL COMPORTAMIENTO :::::::::::::::::::::::///

  ///:: EVENTO DEL BOTON VER LOG COMPORTAMIENTO :::::::::::::::::::::::::::::::::::::::::::///
  $(document).on("click", ".btn_log_comportamiento", function(){
    $("#form_modal_log_comportamiento").trigger("reset");
    $("#div_log_comportamiento").html(comp_log);
    
    $(".modal-header-log").css( "background-color", "#17a2b8");
    $(".modal-header-log").css( "color", "white" );
    $(".modal-title-log").text("Log");
    $('#modal_crud_log_comportamiento').modal('show');
    $('#modal-resizable').resizable();
    $(".modal-dialog").draggable({
      cursor: "move",
      handle: ".dragable_touch",
    });
  });
  ///:: FIN EVENTO DEL BOTON VER LOG COMPORTAMIENTO :::::::::::::::::::::::::::::::::::::::///


  ///:: TERMINO BOTONES COMPORTAMIENTO ::::::::::::::::::::::::::::::::::::::::::::::::::::///
});
///:: TERMINO DOM JS LISTADO DE COMPORTAMIENTO ::::::::::::::::::::::::::::::::::::::::::::///


///:: FUNCIONES COMPORTAMIENTO ::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///

///:: FUNCION PARA VALIDAR LOS DATOS INGRESADOS AL FORMULARIO :::::::::::::::::::::::::::::///
function f_validar_comportamiento(p_comp_tiponovedad, p_comp_fechaoperacion, p_comp_nombrecolaborador, p_comp_descripcion, p_comp_tabla, p_comp_servicio, p_comp_bus, p_comp_nombrecgo, p_comp_lugarexacto, p_comp_lugar_origen, p_comp_lugar_destino, p_horainicio, p_minutoinicio, p_horafin, p_minutofin, p_comp_total_horas, p_comp_detallenovedad, p_comp_estadocomportamiento, p_comp_reconoceresponsabilidad, p_comp_grado_falta, p_comp_codigofalta, p_comp_faltacometida, p_comp_monto, p_comp_linkvideo, p_comp_obs_log){
  f_limpia_comportamiento();
  let rpta_validar_comportamiento="";    

  if(p_comp_tiponovedad==""){
    $("#comp_tiponovedad").addClass("color-error");
    rpta_validar_comportamiento = "invalido";
  };
  if(p_comp_fechaoperacion==""){
    $("#comp_fechaoperacion").addClass("color-error");
    rpta_validar_comportamiento = "invalido";
  };
  if(p_comp_nombrecolaborador==""){
    $("#comp_nombrecolaborador").addClass("color-error");
    rpta_validar_comportamiento = "invalido";
  };
  if(p_comp_descripcion==""){
    $("#comp_descripcion").addClass("color-error");
    rpta_validar_comportamiento = "invalido";
  };
  if(p_comp_tabla==""){
    $("#comp_tabla").addClass("color-error");
    rpta_validar_comportamiento = "invalido";
  };
  if(p_comp_servicio==""){
    $("#comp_servicio").addClass("color-error");
    rpta_validar_comportamiento = "invalido";
  };
  if(p_comp_bus==""){
    $("#comp_bus").addClass("color-error");
    rpta_validar_comportamiento = "invalido";
  };
  if(p_comp_nombrecgo==""){
    $("#comp_nombrecgo").addClass("color-error");
    rpta_validar_comportamiento = "invalido";
  };
  if(p_comp_lugarexacto==""){
    $("#comp_lugarexacto").addClass("color-error");
    rpta_validar_comportamiento = "invalido";
  };
  if(p_comp_lugar_origen==""){
    $("#comp_lugar_origen").addClass("color-error");
    rpta_validar_comportamiento = "invalido";
  };
  if(p_comp_lugar_destino==""){
    $("#comp_lugar_destino").addClass("color-error");
    rpta_validar_comportamiento = "invalido";
  };
  if(p_horainicio==""){
    $("#horainicio").addClass("color-error");
    rpta_validar_comportamiento = "invalido";
  };
  if(p_minutoinicio==""){
    $("#minutoinicio").addClass("color-error");
    rpta_validar_comportamiento = "invalido";
  };
  if(p_horafin==""){
    $("#horafin").addClass("color-error");
    rpta_validar_comportamiento = "invalido";
  };
  if(p_minutofin==""){
    $("#cminutofin").addClass("color-error");
    rpta_validar_comportamiento = "invalido";
  };
  if(p_comp_total_horas==""){
    $("#comp_total_horas").addClass("color-error");
    rpta_validar_comportamiento = "invalido";
  };
  if(p_comp_detallenovedad==""){
    $("#comp_detallenovedad").addClass("color-error");
    rpta_validar_comportamiento = "invalido";
  };
  if(p_comp_estadocomportamiento==""){
    $("#comp_estadocomportamiento").addClass("color-error");
    rpta_validar_comportamiento = "invalido";
  };
  if(p_comp_reconoceresponsabilidad==""){
    $("#comp_reconoceresponsabilidad").addClass("color-error");
    rpta_validar_comportamiento = "invalido";
  };
  if(p_comp_grado_falta==""){
    $("#comp_grado_falta").addClass("color-error");
    rpta_validar_comportamiento = "invalido";
  };
  if(p_comp_codigofalta==""){
    $("#comp_codigofalta").addClass("color-error");
    rpta_validar_comportamiento = "invalido";
  };
  if(p_comp_faltacometida==""){
    $("#comp_faltacometida").addClass("color-error");
    rpta_validar_comportamiento = "invalido";
  };
  return rpta_validar_comportamiento; 
}
///:: FIN FUNCION PARA VALIDAR LOS DATOS INGRESADOS AL FORMULARIO :::::::::::::::::::::::::///

///:: INVISIBILIZA LOS MENSAJE DE ALERTA DEL FORMULARIO :::::::::::::::::::::::::::::::::::///
function f_limpia_comportamiento(){
  $("#comp_tiponovedad").removeClass("color-error");
  $("#comp_fechaoperacion").removeClass("color-error");
  $("#comp_nombrecolaborador").removeClass("color-error");
  $("#comp_descripcion").removeClass("color-error");
  $("#comp_tabla").removeClass("color-error");
  $("#comp_servicio").removeClass("color-error");
  $("#comp_bus").removeClass("color-error");
  $("#comp_nombrecgo").removeClass("color-error");
  $("#comp_lugarexacto").removeClass("color-error");
  $("#comp_lugar_origen").removeClass("color-error");
  $("#comp_lugar_destino").removeClass("color-error");
  $("#horainicio").removeClass("color-error");
  $("#minutoinicio").removeClass("color-error");
  $("#horafin").removeClass("color-error");
  $("#minutofin").removeClass("color-error");
  $("#comp_total_horas").removeClass("color-error");
  $("#comp_detallenovedad").removeClass("color-error");
  $("#comp_estadocomportamiento").removeClass("color-error");
  $("#comp_reconoceresponsabilidad").removeClass("color-error");
  $("#comp_grado_falta").removeClass("color-error");
  $("#comp_codigofalta").removeClass("color-error");
  $("#comp_faltacometida").removeClass("color-error");
  $("#comp_monto").removeClass("color-error");
  $("#comp_linkvideo").removeClass("color-error");
  $("#comp_obs_log").removeClass("color-error");

}
///:: FIN INVISIBILIZA LOS MENSAJE DE ALERTA DEL FORMULARIO :::::::::::::::::::::::::::::::///
  
///:: SE INICIALIZAN LAS VARIABLES DEL INFORME DE COMPORTAMIENTO ::::::::::::::::::::::::::///
function f_CargarVariablesVacioComportamiento(){
  comportamiento_id             = "";
  comp_tiponovedad              = "";
  comp_detallenovedad           = "";
  comp_fechaoperacion           = "";
  comp_operacion                = "";
  comp_nombrecolaborador        = "";
  comp_descripcion              = "";
  comp_tabla                    = "";
  comp_servicio                 = "";
  comp_bus                      = "";
  comp_nombrecgo                = "";
  comp_lugarexacto              = "";
  comp_horainicio               = "";
  comp_horafin                  = "";
  comp_grado_falta              = "";
  comp_codigofalta              = "";
  comp_faltacometida            = "";
  comp_monto                    = "";
  comp_linkvideo                = "";
  comp_reconoceresponsabilidad  = "";
  comp_reportegdh               = "";
  comp_fechareportegdh          = "";
  comp_usuarioid_edicion        = "";
  comp_fechaedicion             = "";
  comp_estadocomportamiento     = "";
  comp_lugar_origen             = "";
  comp_lugar_destino            = "";
  comp_total_horas              = "";
  horainicio                    = "";
  minutoinicio                  = "";
  horafin                       = "";
  minutofin                     = "";
  comp_log                      = "";
  comp_obs_log                  = "";
}
///:: FIN SE INICIALIZAN LAS VARIABLES DEL INFORME DE COMPORTAMIENTO ::::::::::::::::::::::///

///:: SE CARGAN LAS VARIABLES CON LA INFORMACION DE LA BASE DE DATOS ::::::::::::::::::::::///
function f_CargaInicialComportamiento(p_data){
  $.each(p_data, function(idx, obj){
    comp_tiponovedad        = obj.comp_tiponovedad; 
    comp_detallenovedad     = obj.comp_detallenovedad;
    comp_fechaoperacion     = obj.comp_fechaoperacion;
    comp_operacion          = obj.comp_operacion;
    comp_nombrecolaborador  = obj.comp_nombrecolaborador;
    comp_descripcion        = obj.comp_descripcion;
    comp_tabla              = obj.comp_tabla;
    comp_servicio           = obj.comp_servicio;
    comp_bus                = obj.comp_bus;
    comp_nombrecgo          = obj.comp_nombrecgo;
    comp_lugarexacto        = obj.comp_lugarexacto;
    comp_horainicio         = obj.comp_horainicio;
    comp_horafin            = obj.comp_horafin;
    comp_lugar_origen       = obj.comp_lugar_origen;
    comp_lugar_destino      = obj.comp_lugar_destino;
    horainicio              = comp_horainicio.substring(0,2);
    minutoinicio            = comp_horainicio.substring(3,5);
    horafin                 = comp_horafin.substring(0,2);
    minutofin               = comp_horafin.substring(3,5);
    comp_total_horas        = f_calcular_diferencia_horas(comp_horainicio,comp_horafin);
  });
}
///:: FIN SE CARGAN LAS VARIABLES CON LA INFORMACION DE LA BASE DE DATOS ::::::::::::::::::///

///:: SE CARGAN LAS VARIABLES CON LA INFORMACION DE LA BASE DE DATOS ::::::::::::::::::::::///
function f_CargarVariablesComportamiento(p_data){
  $.each(p_data, function(idx, obj){ 
    comp_tiponovedad              = obj.comp_tiponovedad;
    comp_detallenovedad           = obj.comp_detallenovedad;
    comp_fechaoperacion           = obj.comp_fechaoperacion;
    comp_operacion                = obj.comp_operacion;
    comp_nombrecolaborador        = obj.comp_nombrecolaborador;
    comp_descripcion              = obj.comp_descripcion;
    comp_tabla                    = obj.comp_tabla;
    comp_servicio                 = obj.comp_servicio;
    comp_bus                      = obj.comp_bus;
    comp_nombrecgo                = obj.comp_nombrecgo;
    comp_lugarexacto              = obj.comp_lugarexacto;
    comp_horainicio               = obj.comp_horainicio;
    comp_horafin                  = obj.comp_horafin;
    comp_grado_falta              = obj.comp_grado_falta;
    comp_codigofalta              = obj.comp_codigofalta;
    comp_faltacometida            = obj.comp_faltacometida;
    comp_monto                    = obj.comp_monto;
    comp_linkvideo                = obj.comp_linkvideo;
    comp_reconoceresponsabilidad  = obj.comp_reconoceresponsabilidad;
    comp_reportegdh               = obj.comp_reportegdh;
    comp_fechareportegdh          = obj.comp_fechareportegdh;
    comp_usuarioid_edicion        = obj.Usua_Nombres;
    comp_fechaedicion             = obj.comp_fechaedicion;
    comp_estadocomportamiento     = obj.comp_estadocomportamiento;
    comp_lugar_origen             = obj.comp_lugar_origen;
    comp_lugar_destino            = obj.comp_lugar_destino;
    comp_total_horas              = obj.comp_total_horas;
    comp_log                      = obj.comp_log;      
    horainicio                    = comp_horainicio.substring(0,2);
    minutoinicio                  = comp_horainicio.substring(3,5);
    horafin                       = comp_horafin.substring(0,2);
    minutofin                     = comp_horafin.substring(3,5);

  });
}
///:: FIN SE CARGAN LAS VARIABLES CON LA INFORMACION DE LA BASE DE DATOS ::::::::::::::::::///

///:: SE CARGAN LAS VARIABLES HTML CON LA INFORMACION :::::::::::::::::::::::::::::::::::::///
function f_CargaVariablesHtmlComportamiento(){
  $("#comportamiento_id").val(comportamiento_id);
  $("#comp_tiponovedad").val(comp_tiponovedad);
  $("#comp_detallenovedad").val(comp_detallenovedad);
  $("#comp_fechaoperacion").val(comp_fechaoperacion);
  $("#comp_nombrecolaborador").val(comp_nombrecolaborador);
  $("#comp_descripcion").val(comp_descripcion);
  $("#comp_tabla").val(comp_tabla);
  $("#comp_servicio").val(comp_servicio);
  $("#comp_bus").val(comp_bus);
  $("#comp_nombrecgo").val(comp_nombrecgo);
  $("#comp_lugarexacto").val(comp_lugarexacto)
  $("#horainicio").val(horainicio);
  $("#minutoinicio").val(minutoinicio);
  $("#horafin").val(horafin);
  $("#minutofin").val(minutofin);
  $("#comp_total_horas").val(comp_total_horas);
  $("#comp_grado_falta").val(comp_grado_falta);
  $("#comp_codigofalta").val(comp_codigofalta);
  $("#comp_faltacometida").val(comp_faltacometida);
  $("#comp_monto").val(comp_monto);
  $("#comp_linkvideo").val(comp_linkvideo);
  $("#comp_reconoceresponsabilidad").val(comp_reconoceresponsabilidad);
  $("#comp_usuarioid_edicion").val(comp_usuarioid_edicion);
  $("#comp_fechaedicion").val(comp_fechaedicion);
  $("#comp_estadocomportamiento").val(comp_estadocomportamiento);
  $("#comp_lugar_origen").val(comp_lugar_origen);
  $("#comp_lugar_destino").val(comp_lugar_destino);
}
///:: FIN SE CARGAN LAS VARIABLES HTML CON LA INFORMACION :::::::::::::::::::::::::::::::::///

///:: SE CARGAN LAS VARIABLES CON LOS VALORES EDITADOS DEL COMPORTAMIENTO :::::::::::::::::///
function f_CargarVariablesEditadasComportamiento(){
  comportamiento_id             = $.trim($('#comportamiento_id').val());
  comp_tiponovedad              = $.trim($('#comp_tiponovedad').val());
  comp_fechaoperacion           = $.trim($('#comp_fechaoperacion').val());
  comp_nombrecolaborador        = $.trim($('#comp_nombrecolaborador').val());
  comp_descripcion              = $.trim($('#comp_descripcion').val());
  comp_tabla                    = $.trim($('#comp_tabla').val());
  comp_servicio                 = $.trim($('#comp_servicio').val());
  comp_bus                      = $.trim($('#comp_bus').val());
  comp_nombrecgo                = $.trim($('#comp_nombrecgo').val());
  comp_lugarexacto              = $.trim($("#comp_lugarexacto").val());
  comp_lugar_origen             = $.trim($('#comp_lugar_origen').val());
  comp_lugar_destino            = $.trim($('#comp_lugar_destino').val());
  horainicio                    = $.trim($('#horainicio').val());
  minutoinicio                  = $.trim($('#minutoinicio').val());
  if(horainicio !="" && minutoinicio!=""){
    comp_horainicio = horainicio + ":" + minutoinicio;
  }
  horafin                       = $.trim($('#horafin').val());
  minutofin                     = $.trim($('#minutofin').val());
  if(horainicio !="" && minutoinicio!=""){
    comp_horafin = horainicio + ":" + minutoinicio;
  }
  comp_detallenovedad           = $.trim($('#comp_detallenovedad').val());
  comp_estadocomportamiento     = $.trim($('#comp_estadocomportamiento').val());
  comp_reconoceresponsabilidad  = $.trim($('#comp_reconoceresponsabilidad').val());
  comp_grado_falta              = $.trim($('#comp_grado_falta').val());
  comp_codigofalta              = $.trim($('#comp_codigofalta').val());
  comp_faltacometida            = $.trim($('#comp_faltacometida').val());
  comp_monto                    = $.trim($('#comp_monto').val());
  comp_linkvideo                = $.trim($('#comp_linkvideo').val());
  comp_obs_log                  = $.trim($('#comp_obs_log').val());
}
///:: FIN SE CARGAN LAS VARIABLES CON LOS VALORES EDITADOS DEL COMPORTAMIENTO :::::::::::::///

///:: SE CARGAN LOS COMBOS SELECT DE COMPORTAMIENTO :::::::::::::::::::::::::::::::::::::::///
function f_select_combo_comportamiento(){
  let data_html="";
  data_html = f_select_combo("OPE_TipoTablaComportamiento","NO","TtablaComportamiento_Detalle",comp_tiponovedad,"`TtablaComportamiento_Tipo`='TIPO_NOVEDAD'");
  $("#comp_tiponovedad").html(data_html);
  data_html = f_select_combo("OPE_TipoTablaComportamiento","NO","TtablaComportamiento_Detalle",comp_detallenovedad,"`TtablaComportamiento_Tipo`='DETALLE_NOVEDAD'");
  $("#comp_detallenovedad").html(data_html);
  data_html = f_select_combo("OPE_TipoTablaComportamiento","NO","TtablaComportamiento_Detalle","","`TtablaComportamiento_Tipo`='ESTADO'");
  $("#comp_estadocomportamiento").html(data_html);
  data_html = f_select_roles("PILOTO","Colab_ApellidosNombres");
  $("#comp_nombrecolaborador").html(data_html);
  data_html = f_select_tabla(comp_fechaoperacion, comp_operacion);
  $("#comp_tabla").html(data_html);
  data_html = f_select_combo("Buses","NO","Bus_NroExterno",comp_bus,"`Bus_Operacion`='"+comp_operacion+"'");
  $("#comp_bus").html(data_html);
  data_html = f_select_combo("OPE_TipoTablaComportamiento","NO","TtablaComportamiento_Detalle",comp_lugar_origen,"`TtablaComportamiento_Tipo`='LUGAR' AND `TtablaComportamiento_Operacion`='"+comp_operacion+"'");
  $("#comp_lugar_origen").html(data_html);
  data_html = f_select_combo("OPE_TipoTablaComportamiento","NO","TtablaComportamiento_Detalle",comp_lugar_destino,"`TtablaComportamiento_Tipo`='LUGAR' AND `TtablaComportamiento_Operacion`='"+comp_operacion+"'");
  $("#comp_lugar_destino").html(data_html);
  data_html = f_select_combo("OPE_TipoTablaComportamiento","NO","TtablaComportamiento_Detalle",comp_grado_falta,"`TtablaComportamiento_Tipo`='GRADO FALTA'");
  $("#comp_grado_falta").html(data_html);
  data_html = f_select_combo("ope_accidentesmatriz","NO","acmt_busqueda",comp_codigofalta,"`acmt_campo`='"+comp_grado_falta+"'");
  $("#comp_codigofalta").html(data_html);
  data_html = f_select_combo("OPE_TipoTablaComportamiento","NO","TtablaComportamiento_Detalle",comp_faltacometida,"`TtablaComportamiento_Tipo`='FALTA COMETIDA'");
  $("#comp_faltacometida").html(data_html);
  data_html = f_select_combo("OPE_TipoTablaComportamiento","NO","TtablaComportamiento_Detalle",comp_reconoceresponsabilidad,"`TtablaComportamiento_Tipo`='DECIDIR'");
  $("#comp_reconoceresponsabilidad").html(data_html);

}
///:: FIN SE CARGAN LOS COMBOS SELECT DE COMPORTAMIENTO :::::::::::::::::::::::::::::::::::///

function f_buscar_dato(p_nombre_tabla, p_campo_buscar, p_condicion_where){
  let rpta_buscar = "";
  Accion = 'buscar_dato';
  $.ajax({
    url       : "Ajax.php",
    type      : "POST",
    datatype  : "json",
    async     : false,
    data      : {MoS:MoS, NombreMoS:NombreMoS, Accion:Accion, nombre_tabla:p_nombre_tabla, campo_buscar:p_campo_buscar, condicion_where:p_condicion_where},
    success   : function(data){
      rpta_buscar = data;
    }
  });
  return rpta_buscar;
}

function f_select_tabla(p_fecha, p_operacion){
  let rpta_select_tabla = "";
  Accion = 'select_tabla';
  $.ajax({
    url       : "Ajax.php",
    type      : "POST",
    datatype  : "json",
    async     : false,
    data      : {MoS:MoS,NombreMoS:NombreMoS,Accion:Accion,prog_fecha:p_fecha, operacion:p_operacion},    
    success   : function(data){
      rpta_select_tabla = data;
    }
  });
  return rpta_select_tabla;
}
///:: TERMINO FUNCIONES COMPORTAMIENTO ::::::::::::::::::::::::::::::::::::::::::::::::::::///