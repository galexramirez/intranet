///::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
///:: EDITAR INASISTENCIAS v 2.0  FECHA: 2023-04-25 :::::::::::::::::::::::::::::::::::::::///
///:: EDITAR Y MOSTRAR INASISTENCIAS ::::::::::::::::::::::::::::::::::::::::::::::::::::::///
///::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///

///:: DECLARACION DE VARIABLES ::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///

///:: JS DOM EDITAR INASISTENCIAS :::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
$(document).ready(function(){
  ///:: Si hay cambios en Fecha se actualiza las Tablas para Accidentes :::::::::::::::::::///
  $("#inas_FechaOperacion").on('change', function () {
    inas_fechaOperacion = $("#inas_fechaoperacion").val();
    Accion = 'select_tabla';
    $.ajax({
      url       : "Ajax.php",
      type      : "POST",
      datatype  : "json",
      async     : false,
      data      : {MoS:MoS,NombreMoS:NombreMoS,Accion:Accion,Prog_Fecha:inas_fechaoperacion, operacion:inas_operacion},    
      success   : function(data){
        $("#inas_tabla").html(data);
      }
    });
  });

  // Si hay cambios en tabla de accidentes se actualiza el servicio
  $(document).on('change', '#inas_tabla', function () {
    inas_fechaoperacion = $("#inas_fechaoperacion").val();
    inas_tabla          = $("#inas_tabla").val();
    Accion = 'buscar_servicio';
    $.ajax({
      url       : "Ajax.php",
      type      : "POST",
      datatype  : "json",    
      data      : {MoS:MoS,NombreMoS:NombreMoS,Accion:Accion,Prog_Fecha:inas_fechaoperacion,Prog_Tabla:inas_tabla},    
      success   : function(data){
        $("#inas_servicio").val(data);
      }
    });
  });

  $(document).on('change', '#horainicio', function() {
    inas_horainicio = "";
    inas_horafin    = "";
    horainicio      = $.trim($('#horainicio').val());
    minutoinicio    = $.trim($('#minutoinicio').val());
    if(horainicio !="" && minutoinicio!=""){
      inas_horainicio = horainicio + ":" + minutoinicio;
    }
    horafin         = $.trim($('#horafin').val());
    minutofin       = $.trim($('#minutofin').val());
    if(horafin!="" && minutofin!=""){
      inas_horafin  = horafin + ":" + minutofin;
    }
    inas_totalhoras = f_calcular_diferencia_horas(inas_horainicio,inas_horafin);
    $("#inas_totalhoras").val(inas_totalhoras);
  });

  $(document).on('change', '#minutoinicio', function() {
    inas_horainicio = "";
    inas_horafin    = "";
    horainicio      = $.trim($('#horainicio').val());
    minutoinicio = $.trim($('#minutoinicio').val());
    if(horainicio !="" && minutoinicio!=""){
      inas_horainicio = horainicio + ":" + minutoinicio;
    }
    horafin         = $.trim($('#horafin').val());
    minutofin       = $.trim($('#minutofin').val());
    if(horafin!="" && minutofin!=""){
      inas_horafin  = horafin + ":" + minutofin;
    }
    inas_totalhoras = f_calcular_diferencia_horas(inas_horainicio,inas_horafin);
    $("#inas_totalhoras").val(inas_totalhoras);
  });
  
  $(document).on('change', '#horafin', function() {
    inas_horainicio = "";
    inas_horafin    = "";
    horainicio      = $.trim($('#horainicio').val());
    minutoinicio    = $.trim($('#minutoinicio').val());
    if(horainicio !="" && minutoinicio!=""){
      inas_horainicio = horainicio + ":" + minutoinicio;
    }
    horafin         = $.trim($('#horafin').val());
    minutofin       = $.trim($('#minutofin').val());
    if(horafin!="" && minutofin!=""){
      inas_horafin  = horafin + ":" + minutofin;
    }
    inas_totalhoras = f_calcular_diferencia_horas(inas_horainicio,inas_horafin);
    $("#inas_totalhoras").val(inas_totalhoras);
  });
  
  $(document).on('change', '#minutofin', function() {
    inas_horainicio   = "";
    inas_horafin      = "";
    horainicio        = $.trim($('#horainicio').val());
    minutoinicio      = $.trim($('#minutoinicio').val());
    if(horainicio !="" && minutoinicio!=""){
      inas_horainicio = horainicio + ":" + minutoinicio;
    }
    horafin           = $.trim($('#horafin').val());
    minutofin         = $.trim($('#minutofin').val());
    if(horafin!="" && minutofin!=""){
      inas_horafin    = horafin + ":" + minutofin;
    }
    inas_totalhoras   = f_calcular_diferencia_horas(inas_horainicio,inas_horafin);
    $("#inas_totalhoras").val(inas_totalhoras);
  });

  $(document).on('change', '#inas_tiponovedad', function() {
    inas_tiponovedad  = $.trim($('#inas_tiponovedad').val());
    Operacion         = 'INASISTENCIAS';
    Tipo              = inas_tiponovedad;
    selectHtmlInasistencias = f_TipoTabla(Operacion,Tipo);
    $('#inas_detallenovedad').html(selectHtmlInasistencias);    
  });

  ///:: BOTONES INASISTENCIAS :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
  
  //:: BOTON GRABAR -> REALIZA LA GRABACION EN LA TABLA ope_inasistencias :::::::::::::::::///
  $('#formInasistencias').submit(function(e){
    e.preventDefault(); //evita el comportambiento normal del submit, es decir, recarga total de la página
    let t_validar_inasistencias = "invalido";
    f_cargar_variables_editadas_inasistencias();
    t_validar_inasistencias     = f_validar_inasistencias(inas_tiponovedad, inas_detallenovedad, inas_fechaoperacion, inas_nombrecolaborador, inas_descripcion, inas_tabla, inas_servicio, inas_bus, inas_nombrecgo, inas_lugarexacto, inas_horainicio, inas_horafin, inas_horainicio, inas_horafin, inas_totalhoras, inas_estadoinasistencias, inas_obs_log, inas_lugar_origen, inas_lugar_destino);

    if(t_validar_inasistencias=="invalido"){
      Swal.fire({
        icon: 'error',
        title: 'EDITAR...',
        text: '*Los Campos no pueden estar VACIOS!'
      });
    }else{
      // CREAR NUEVO INASISTENCIAS
      if(opcion_inasistencias=="CREAR"){
        $("#btn_guardar_inasistencias").prop("disabled",true);
        Accion = 'crear_inasistencias';
        $.ajax({
          url       : "Ajax.php",
          type      : "POST",
          datatype  : "json",    
          data      : { MoS:MoS, NombreMoS:NombreMoS, Accion:Accion, inas_programacionid:inas_programacionid, inas_novedadid:inas_novedadid, inasistencias_id:inasistencias_id, inas_tiponovedad:inas_tiponovedad, inas_detallenovedad:inas_detallenovedad, inas_fechaoperacion:inas_fechaoperacion, inas_nombrecolaborador:inas_nombrecolaborador,inas_descripcion:inas_descripcion, inas_tabla:inas_tabla, inas_servicio:inas_servicio, inas_bus:inas_bus, inas_nombrecgo:inas_nombrecgo,inas_lugarexacto:inas_lugarexacto, inas_horainicio:inas_horainicio, inas_horafin:inas_horafin, inas_totalhoras:inas_totalhoras, inas_obs_log:inas_obs_log, inas_estadoinasistencias:inas_estadoinasistencias, inas_lugar_origen:inas_lugar_origen, inas_lugar_destino:inas_lugar_destino},
          success   : function(data) {
            tabla_inasistencias.ajax.reload(null, false);
          }
        });
      }
      $('#modal_crud_inasistencias').modal('hide');
    }
  });
  //:: FIN BOTON GRABAR -> REALIZA LA GRABACION EN LA TABLA ope_inasistencias :::::::::::::///

  ///:: EVENTO DEL BOTON VER LOG INASISTENCIAS ::::::::::::::::::::::::::::::::::::::::::::///
  $(document).on("click", ".btn_log_inasistencias", function(){
    $("#form_modal_log_inasistencias").trigger("reset");
    $("#div_log_inasistencias").html(inas_log);
    
    $(".modal-header-log").css( "background-color", "#17a2b8");
    $(".modal-header-log").css( "color", "white" );
    $(".modal-title-log").text("Log");
    $('#modal_crud_log_inasistencias').modal('show');
    $('#modal-resizable').resizable();
    $(".modal-dialog").draggable({
      cursor: "move",
      handle: ".dragable_touch",
    });
  });
  ///:: FIN EVENTO DEL BOTON VER LOG INASISTENCIAS ::::::::::::::::::::::::::::::::::::::::///


  ///:: TERMINO BOTONES INASISTENCIAS :::::::::::::::::::::::::::::::::::::::::::::::::::::///
});
///:: TERMINO JS DOM EDITAR INASISTENCIAS :::::::::::::::::::::::::::::::::::::::::::::::::///


///:: FUNCIONES EDITAR INASISTENCIAS ::::::::::::::::::::::::::::::::::::::::::::::::::::::///

///:: FUNCION PARA VALIDAR LOS DATOS INGRESADOS AL FORMULARIO :::::::::::::::::::::::::::::///
function f_validar_inasistencias(p_inas_tiponovedad, p_inas_detallenovedad, p_inas_fechaoperacion, p_inas_nombrecolaborador, p_inas_descripcion, p_inas_tabla, p_inas_servicio, p_inas_bus, p_inas_nombrecgo, p_inas_lugarexacto, p_inas_horainicio, p_inas_horafin, p_inas_horainicio, p_inas_horafin, p_inas_totalhoras, p_inas_estadoinasistencias, p_inas_obs_log, p_inas_lugar_origen, p_inas_lugar_destino){

  f_limpia_inasistencias();

  NoLetrasMayuscEspacio=/[^A-Z ]/;
  let rpta_validar_inasistencias="";

  if(p_inas_tiponovedad==""){
    $("#inas_tiponovedad").addClass("color-error");
    rpta_validar_inasistencias = "invalido";
  }
  if(p_inas_detallenovedad==""){
    $("#inas_detallenovedad").addClass("color-error");   
    rpta_validar_inasistencias = "invalido";
  }
  if(p_inas_fechaoperacion==""){
    $("#inas_fechaoperacion").addClass("color-error");
    rpta_validar_inasistencias = "invalido";
  }
  if(p_inas_nombrecolaborador==""){
    $("#inas_nombrecolaborador").addClass("color-error");
    rpta_validar_inasistencias = "invalido";
  }
  if(p_inas_descripcion==""){
    $("#inas_descripcion").addClass("color-error");
    rpta_validar_inasistencias = "invalido";
  }
  if(p_inas_tabla==""){
    $("#inas_tabla").addClass("color-error");
    rpta_validar_inasistencias = "invalido";
  }
  if(p_inas_servicio==""){
    $("#inas_servicio").addClass("color-error");
    rpta_validar_inasistencias = "invalido";
  }
  /* if(p_inas_bus==""){
    $("#inas_bus").addClass("color-error");
    rpta_validar_inasistencias = "invalido";
  }  */ 
  if(p_inas_nombrecgo==""){
    $("#inas_nombrecgo").addClass("color-error");
    rpta_validar_inasistencias = "invalido";
  }
  if(p_inas_lugarexacto==""){
    $("#inas_lugarexacto").addClass("color-error");
    rpta_validar_inasistencias = "invalido";
  } 
  if(p_inas_horainicio==""){
    $("#inas_horainicio").addClass("color-error");
    rpta_validar_inasistencias = "invalido";
  }
  if(p_inas_horafin==""){
    $("#inas_horafin").addClass("color-error");
    rpta_validar_inasistencias = "invalido";
  }
  if(p_inas_horainicio==""){
    $("#inas_horainicio").addClass("color-error");
    rpta_validar_inasistencias = "invalido";
  }
  if(p_inas_horafin==""){
    $("#inas_horafin").addClass("color-error");
    rpta_validar_inasistencias = "invalido";
  }
  if(p_inas_totalhoras==""){
    $("#inas_totalhoras").addClass("color-error");
    rpta_validar_inasistencias = "invalido";
  } 
  if(p_inas_estadoinasistencias==""){
    $("#inas_estadoinasistencias").addClass("color-error");
    rpta_validar_inasistencias = "invalido";
  }   
 /*  if(p_inas_obs_log==""){
    $("#inas_obs_log").addClass("color-error"); 
    rpta_validar_inasistencias = "invalido";
  } */
  if(p_inas_lugar_origen==""){
    $("#inas_lugar_origen").addClass("color-error");
    rpta_validar_inasistencias = "invalido";
  } 
  if(p_inas_lugar_destino==""){
    $("#inas_lugar_destino").addClass("color-error");
    rpta_validar_inasistencias = "invalido";
  } 
  return rpta_validar_inasistencias; 
}
///:: FIN FUNCION PARA VALIDAR LOS DATOS INGRESADOS AL FORMULARIO :::::::::::::::::::::::::///

///:: LIMPIA EL COLOR DE LOS CAMPOS DEL FORMULARIO ::::::::::::::::::::::::::::::::::::::::/// 
function f_limpia_inasistencias(){
  $("#inas_tiponovedad").removeClass("color-error");
  $("#inas_detallenovedad").removeClass("color-error");   
  $("#inas_fechaoperacion").removeClass("color-error");
  $("#inas_nombrecolaborador").removeClass("color-error");
  $("#inas_descripcion").removeClass("color-error");
  $("#inas_tabla").removeClass("color-error");
  $("#inas_servicio").removeClass("color-error");
  $("#inas_bus").removeClass("color-error");
  $("#inas_nombrecgo").removeClass("color-error");
  $("#inas_lugarexacto").removeClass("color-error");
  $("#inas_horainicio").removeClass("color-error");
  $("#inas_horafin").removeClass("color-error");
  $("#inas_horainicio").removeClass("color-error");
  $("#inas_horafin").removeClass("color-error");
  $("#inas_totalhoras").removeClass("color-error");
  $("#inas_estadoinasistencias").removeClass("color-error");
  $("#inas_obs_log").removeClass("color-error");
  $("#inas_lugar_origen").removeClass("color-error");
  $("#inas_lugar_destino").removeClass("color-error");
}
///:: FIN LIMPIA EL COLOR DE LOS CAMPOS DEL FORMULARIO ::::::::::::::::::::::::::::::::::::/// 

///:: SE CARGAN LAS VARIABLES CON LOS VALORES EDITADOS DEL INFORME PRELIMINAR :::::::::::::///
function f_cargar_variables_editadas_inasistencias(){
  inasistencias_id        = $.trim($('#inasistencias_id').val());
  inas_tiponovedad        = $.trim($('#inas_tiponovedad').val());
  inas_detallenovedad     = $.trim($('#inas_detallenovedad').val());
  inas_fechaoperacion     = $.trim($('#inas_fechaoperacion').val());
  inas_nombrecolaborador  = $.trim($('#inas_nombrecolaborador').val());
  inas_descripcion        = $.trim($('#inas_descripcion').val());
  inas_tabla              = $.trim($('#inas_tabla').val());
  inas_servicio           = $.trim($('#inas_servicio').val());
  inas_bus                = $.trim($('#inas_bus').val());
  inas_nombrecgo          = $.trim($('#inas_nombrecgo').val());
  inas_lugarexacto        = $.trim($("#inas_lugarexacto").val());
  inas_horainicio         = "";
  inas_horafin            = "";
  horainicio              = $.trim($('#horainicio').val());
  minutoinicio            = $.trim($('#minutoinicio').val());
  if(horainicio !="" && minutoinicio!=""){
    inas_horainicio = horainicio + ":" + minutoinicio;
  }
  horafin                 = $.trim($('#horafin').val());
  minutofin               = $.trim($('#minutofin').val());
  if(horafin!="" && minutofin!=""){
    inas_horafin = horafin + ":" + minutofin;
  }
  inas_totalhoras         = $.trim($("#inas_totalhoras").val());
  inas_estadoinasistencias= $.trim($("#inas_estadoinasistencias").val());
  inas_obs_log            = $.trim($("#inas_obs_log").val());
  inas_lugar_origen       = $.trim($("#inas_lugar_origen").val());
  inas_lugar_destino      = $.trim($("#inas_lugar_destino").val());
}
///:: FIN CARGA DE LAS VARIABLES CON LOS VALORES EDITADOS DEL INFORME PRELIMINAR ::::::::::///

///:: TERMINO FUNCIONES EDITAR INASISTENCIAS ::::::::::::::::::::::::::::::::::::::::::::::///