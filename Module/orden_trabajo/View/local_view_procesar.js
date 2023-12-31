///::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
///:: PROCESAR ORDEN DE TRABAJO v 4.0 FECHA: 14-06-2023 :::::::::::::::::::::::::::::::::::///
///:: EDITAR TABLA DE ORDEN DE TRABAJO ::::::::::::::::::::::::::::::::::::::::::::::::::::///
///::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///

///:: DECLARACION DE VARIABLES ::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
var ot_id, ot_origen, ot_bus, ot_kilometraje, ot_fecha_registro, ot_nombre_proveedor, ot_cgm, ot_estado, ot_actividad, ot_obs_cgm, ot_sistema, ot_obs_proveedor, ot_ejecucion, ot_semana_cierre, ot_tipo, ot_log;
var opcion_ot, select_ot;

///:: JS DOM ORDEN DE TRABAJO :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
$(document).ready(function(){
  $("#form_procesar_ot").hide();

  // Si hay cambios en el codigo OT se oculta el form
  $("#ot_id").on('change', function () {
    $("#form_procesar_ot").hide();
  });

  $("#ot_fecha_registro, #ot_bus").on('change', function () {
    ot_fecha_registro = $("#ot_fecha_registro").val();
    ot_bus = $("#ot_bus").val();
    f_calculo_kilometraje(ot_bus,ot_fecha_registro);
  });

  /// Si hay cambios en el origen OT
  $("#ot_origen").on('change', function () {
    ot_origen = $("#ot_origen").val();
    ot_tipo = f_buscar_dato("manto_ot_origen", "or_tipo_ot", "`or_nombre`='"+ot_origen+"'");
    $("#ot_tipo").val(ot_tipo);
  });

  $("#ot_id").keypress(function(event) {
    if (event.keyCode === 13 && $("#ot_id").val().length>0) {
      $("#btn_cargar_ot").focus();
    }
  });

  $("#ot_nombre_proveedor").on("change",function(){
    ot_nombre_proveedor = $("#ot_nombre_proveedor").val();
    tabla_horas_tecnicos
    .rows()
    .remove()
    .draw();
  });

  ///:: BOTONES DE ORDEN DE TRABAJO :::::::::::::::::::::::::::::::::::::::::::::::::::::::///

  ///:: BOTON CARGA DE ORDEN DE TRABAJO :::::::::::::::::::::::::::::::::::::::::::::::::::///
  $(document).on("click", ".btn_cargar_ot", function(){
    let semana_estado = "";
    let ot_existe = "";
    f_cargar_variables_vacio_ot(); //Se inicializan las variables en vacio, se cargan en blanco
    opcion_ot = ""; // 1=CREAR 2=EDITAR
    ot_id = $("#ot_id").val();
  
    if(ot_id==""){
      $("#ot_origen").focus();
      Swal.fire({
        position: 'center',
        icon: 'success',
        title: 'Se creara una nueva OT !!!',
        showConfirmButton: false,
        timer: 1500
      })
      opcion_ot = "CREAR";
      $("#form_procesar_ot").show();
      $("#ot_origen").focus().select();
      f_cargar_variables_html_ot();
      f_combos_selects_ot();
      div_show = f_MostrarDiv("form_procesar_ot","btn_guardar_ot","","");
      $("#div_btn_guardar_ot").html(div_show);
      f_tabla_horas_tecnicos(ot_id);
    }else{
      ot_existe = f_buscar_dato("manto_ots", "ot_id", "`ot_id`='"+ot_id+"'");
      Accion = 'cargar_ot';
      $.ajax({
        url     : "Ajax.php",
        type    : "POST",
        datatype: "json",
        async   : false,    
        data    : {MoS:MoS, NombreMoS:NombreMoS, Accion:Accion, ot_id:ot_id},    
        success: function(data){
          data = $.parseJSON(data);
          f_cargar_variables_ot(data);
          f_combos_selects_ot();
          if(ot_existe==ot_id){
            opcion_ot = "EDITAR";
            $("#form_procesar_ot").show();
            $("#ot_origen").focus().select();
            f_cargar_variables_html_ot();
            Accion = 'cargar_vales'; // SE CARGAN LOS VALES VINCULADOS A LA OT
            $.ajax({
              url     : "Ajax.php",
              type    : "POST",
              datatype: "json",
              async   : false,
              data    : {MoS:MoS, NombreMoS:NombreMoS, Accion:Accion, ot_id:ot_id},    
              success: function(data){
                $("#div_vales").html(data);
              }
            });
            semana_estado = f_validar_semana_cerrada(ot_semana_cierre);
            div_show = f_MostrarDiv("form_procesar_ot","btn_guardar_ot",semana_estado,"");
            $("#div_btn_guardar_ot").html(div_show);
            f_tabla_horas_tecnicos(ot_id);
          }else{
            Swal.fire({
              position: 'center',
              icon: 'warning',
              title: "No existe N° OT : "+ot_id+" !!!",
              showConfirmButton: false,
              timer: 1500
            })
            opcion_ot="";
            $("#form_procesar_ot").hide();
            $("#ot_id").focus().select();
          }
        }
      });
    }
  });
  ///:: FIN DE BOTON CARGA DE ORDEN DE TRABAJO ::::::::::::::::::::::::::::::::::::::::::::::///

  ///:: BOTON GUARDAR ORDEN DE TRABAJO ::::::::::::::::::::::::::::::::::::::::::::::::::::::///
  $(document).on("click", ".btn_guardar_ot", function(){
    let t_msg           = "";
    let t_html          = "";
    let rpta_guardar_ot = "";
    let salto_linea     = "<br>";
    let t_validar       = "";
    let array_data      = [];

    ot_id            = $("#ot_id").val();
    f_limpia_ot();
    f_cargar_variables_editadas_ot();
    array_horas_tecnicos = tabla_horas_tecnicos.rows().data().toArray();

    if(ot_estado === ""){
      rpta_guardar_ot = "invalido";
      t_msg += "* El estado de la OT no puede ser vacio"+salto_linea;
      $("#ot_estado").addClass("color-error");
    }

    if(ot_fecha_registro === ""){
      rpta_guardar_ot = "invalido";
      t_msg += "* Falta completar información"+salto_linea;
      $("#ot_fecha_registro").addClass("color-error");
    }

    if(ot_estado === "CERRADO"){
      t_validar = f_validar_ot(ot_id, ot_origen, ot_bus, ot_kilometraje, ot_fecha_registro, ot_nombre_proveedor, ot_cgm, ot_estado, ot_actividad, ot_ejecucion, ot_obs_cgm, ot_sistema, ot_obs_proveedor, ot_semana_cierre, ot_tipo);
    
      if(t_validar!=""){
        t_msg += '*Es posible que algún campo su información no sea la correcta!'+salto_linea;
        rpta_guardar_ot = 'invalido';
      }

      t_validar = "NO";
      bvalidarKm = f_validar_km(ot_bus, ot_fecha_registro, ot_kilometraje);

      if(bvalidarKm=="NO"){
        t_msg += "*El kilometraje ingresado no corresponde!"+salto_linea;
        rpta_guardar_ot = 'invalido';
        $("#ot_kilometraje").addClass("color-error"); 
      }
    }

    if(ot_estado === "ABIERTO"){
      t_msg += "* El estado de la OT es ABIERTO!!!"+salto_linea;
    }

    if(rpta_guardar_ot === ""){
      if(opcion_ot === "CREAR"){ Accion = 'crear_ot'; }
      if(opcion_ot === "EDITAR"){ Accion = 'editar_ot'; }
      if(t_msg!=""){
        t_html = "Ten en cuenta que:"+t_msg+" !!!";
      }
      Swal.fire({
        title             : '¿Está seguro de guardar?',
        html              : t_html,
        icon              : 'warning',
        showCancelButton  : true,
        cancelButtonColor : '#d33',
        cancelButtonText  : 'Cancelar',
        confirmButtonColor: '#3085d6',
        confirmButtonText : 'Si, guardar!',
        focusCancel       : true
      }).then((result) => 
      {
        if(result.isConfirmed){
          $("#bnt_guardar_ot").prop("disabled",true);
          array_data = JSON.stringify(array_horas_tecnicos);
          $.ajax({
            url     : "Ajax.php",
            type    : "POST",
            datatype: "json",
            async   : false,
            data    : {MoS:MoS, NombreMoS:NombreMoS, Accion:Accion, ot_id:ot_id, ot_origen:ot_origen, ot_bus:ot_bus, ot_kilometraje:ot_kilometraje, ot_fecha_registro:ot_fecha_registro, ot_nombre_proveedor:ot_nombre_proveedor, ot_cgm:ot_cgm, ot_estado:ot_estado, ot_actividad:ot_actividad, ot_ejecucion:ot_ejecucion, ot_obs_cgm:ot_obs_cgm, ot_sistema:ot_sistema, ot_obs_proveedor:ot_obs_proveedor, ot_semana_cierre:ot_semana_cierre, ot_tipo:ot_tipo, array_data:array_data},
            success: function(data){

            }
          });
          Swal.fire({
            position: 'center',
            icon: 'success',
            title: 'El registro ha sido grabado.',
            showConfirmButton: false,
            timer: 1500
          })      
          $("#form_procesar_ot").hide();
          ot_id = "";
          $("#ot_id").val(ot_id);
          $("#ot_id").focus();
          ot_observadas = f_ot_observadas();
          $("#ot_alerta").html(ot_observadas);      
        }
      });
      $("#bnt_guardar_ot").prop("disabled",false);
    }else{
      Swal.fire({
        icon: 'error',
        title: 'NO ES POSIBLE GUARDAR...',
        html: "Ten en cuenta que: "+t_msg+" !!!",
      })
    }
  });
  ///:: FIN DE BOTON GUARDAR ORDEN DE TRABAJO :::::::::::::::::::::::::::::::::::::::::::::///

  ///:: BOTON CANCELAR ORDEN DE TRABAJO :::::::::::::::::::::::::::::::::::::::::::::::::::///
  $(document).on("click", ".btn_cancelar_ot", function(){
    $("#form_procesar_ot").hide();
    ot_id = "";
    $("#ot_id").val(ot_id);
    $("#ot_id").focus();
  });
  ///:: BOTON CANCELAR ORDEN DE TRABAJO :::::::::::::::::::::::::::::::::::::::::::::::::::///

  ///:: EVENTO DEL BOTON VER LOG ORDEN DE TRABAJO :::::::::::::::::::::::::::::::::::::::::///
  $(document).on("click", ".btn_log_ot", function(){
    $("#form_modal_log_ot").trigger("reset");
    $("#div_log_ot").html(ot_log);
    $(".modal-header").css( "background-color", "#17a2b8");
    $(".modal-header").css( "color", "white" );
    $(".modal-title").text("Log");
    $('#modal_crud_log_ot').modal('show');
  });
  ///:: FIN DE EVENTO DEL BOTON VER LOG ORDEN DE TRABAJO ::::::::::::::::::::::::::::::::::///
  
  ///:: EVENTO DEL BOTON VER PROCESAR ORDEN DE TRABAJO ::::::::::::::::::::::::::::::::::::///
  $("#btn_procesar_ver_ot").click(function(){
    $("#form_modal_ver_ot").trigger("reset");
    ot_id = $("#ot_id").val();
      Accion = 'ver_ot';
      $.ajax({
        url     : "Ajax.php",
        type    : "POST",
        datatype: "json",
        async   : false,    
        data    : {MoS:MoS, NombreMoS:NombreMoS, Accion:Accion, ot_id:ot_id},    
        success: function(data){
          $("#div_ver_ot").html(data);
        }
      });
      f_tabla_ver_horas_tecnicos(ot_id);
      $(".modal-header").css( "background-color", "#17a2b8");
      $(".modal-header").css( "color", "white" );
      $(".modal-title").text("INFORMACION OTs");
      $('#modal_crud_ver_ot').modal('show');
      $('#modal-resizable_ver_ot').resizable();
      $(".modal-dialog").draggable({
        cursor: "move",
        handle: ".dragable_touch",
      });        
  });
  ///:: FIN DE EVENTO DEL BOTON VER PROCESAR ORDEN DE TRABAJO :::::::::::::::::::::::::::::///

});
///:: TERMINO JS DOM ORDEN DE TRABAJO :::::::::::::::::::::::::::::::::::::::::::::::::::::///


///:: FUNCIONES DE ORDEN DE TRABAJO :::::::::::::::::::::::::::::::::::::::::::::::::::::::///

///:: FUNCION PARA VALIDAR LOS DATOS INGRESADOS AL FORMULARIO :::::::::::::::::::::::::::::///
function f_validar_ot(p_ot_id, p_ot_origen, p_ot_bus, p_ot_kilometraje, p_ot_fecha_registro, p_ot_nombre_proveedor, p_ot_cgm, ot_estado, p_ot_actividad, p_ot_ejecucion, p_ot_obs_cgm, p_ot_sistema, p_ot_obs_proveedor, p_ot_semana_cierre, p_ot_tipo){
  f_limpia_ot();
  let rpta_validar_ot="";    
  /*
  if(p_ot_id==''){
    $("#ot_id").addClass("color-error");
    rpta_validar_ot="invalido";
  }

  if(p_ot_origen==''){
    $("#ot_origen").addClass("color-error");
    rpta_validar_ot="invalido";
  }
  
  if(p_ot_bus==''){
    $("#ot_bus").addClass("color-error");
    rpta_validar_ot="invalido";
  }
  */
  if(p_ot_kilometraje==''){
    $("#ot_kilometraje").addClass("color-error");
    rpta_validar_ot="invalido";
  }
  /*
  if(p_ot_fecha_registro==''){
    $("#ot_fecha_registro").addClass("color-error");
    rpta_validar_ot="invalido";
  }
  
  if(p_ot_nombre_proveedor==''){
    $("#ot_nombre_proveedor").addClass("color-error");
    rpta_validar_ot="invalido";
  }
  
  if(p_ot_cgm==''){
    $("#ot_cgm").addClass("color-error");
    rpta_validar_ot="invalido";
  }
  */
  if(p_ot_estado==''){
    $("#ot_estado").addClass("color-error");
    rpta_validar_ot="invalido";
  }
  
  if(p_ot_actividad.length>500){
    $("#ot_activida").addClass("color-error");
    rpta_validar_ot="invalido";
  }
  /*
  if(p_ot_ejecucion.length>5000){
    $("#ot_ejecucion").addClass("color-error");
    rpta_validar_ot="invalido";
  }
  
  if(p_ot_obs_cgm.length>2500){
    $("#ot_obs_cgm").addClass("color-error");
    rpta_validar_ot="invalido";
  }
  
  if(pot_sistema==''){
    $("#ot_sistema").addClass("color-error");
    rpta_validar_ot="invalido";
  }
  
  if(p_ot_obs_proveedor.length>2500){
    $("#ot_obs_proveedor").addClass("color-error");
    rpta_validar_ot="invalido";
  }
  
  if(pot_semana_cierre==''){
    $("#ot_semana_cierre").addClass("color-error");
    rpta_validar_ot="invalido";
  }
  
  if(p_ot_tipo==''){
    $("#ot_tipo").addClass("color-error");
    rpta_validar_ot="invalido";
  }
  */     
  return rpta_validar_ot; 
}
///:: FIN DE FUNCION PARA VALIDAR LOS DATOS INGRESADOS AL FORMULARIO ::::::::::::::::::::::///

///:: MENSAJE DE ALERTA DEL FORMULARIO COLOR DE CAMPOS ::::::::::::::::::::::::::::::::::::/// 
function f_limpia_ot(){
  $('#ot_id').removeClass("color-error");
  $('#ot_origen').removeClass("color-error");
  $('#ot_bus').removeClass("color-error");
  $('#ot_kilometraje').removeClass("color-error");
  $('#ot_fecha_registro').removeClass("color-error");
  $('#ot_nombre_proveedor').removeClass("color-error");
  $('#ot_cgm').removeClass("color-error");
  $('#ot_estado').removeClass("color-error");
  $('#ot_actividad').removeClass("color-error");
  $('#ot_ejecucion').removeClass("color-error");
  $('#ot_obs_cgm').removeClass("color-error");
  $('#ot_sistema').removeClass("color-error");
  $('#ot_obs_proveedor').removeClass("color-error");
  $("#ot_semana_cierre").removeClass("color-error");
  $('#ot_tipo').removeClass("color-error");
}
///:: FIN DE MENSAJE DE ALERTA DEL FORMULARIO COLOR DE CAMPOS :::::::::::::::::::::::::::::///

///:: SE CARGAN LAS VARIABLES CON LA INFORMACION DE LA BASE DE DATOS ::::::::::::::::::::::///
function f_cargar_variables_ot(p_data){
  $.each(p_data, function(idx, obj){ 
    ot_id               = obj.ot_id;
    ot_origen           = obj.ot_origen;
    ot_bus              = obj.ot_bus;
    ot_kilometraje      = obj.ot_kilometraje;
    ot_fecha_registro   = obj.ot_fecha_registro;
    ot_nombre_proveedor = obj.ot_nombre_proveedor;
    ot_cgm              = obj.ot_cgm;
    ot_estado           = obj.ot_estado;
    ot_actividad        = obj.ot_actividad;
    ot_ejecucion        = obj.ot_ejecucion;
    ot_obs_cgm          = obj.ot_obs_cgm;
    ot_sistema          = obj.ot_sistema;
    ot_obs_proveedor    = obj.ot_obs_proveedor;
    ot_semana_cierre    = obj.ot_semana_cierre;
    ot_tipo             = obj.ot_tipo;
    ot_log              = obj.ot_log;
  });
}
///:: FIN DE SE CARGAN LAS VARIABLES CON LA INFORMACION DE LA BASE DE DATOS :::::::::::::::///
  
///:: SE INICIALIZAN LAS VARIABLES DE LA OT CORRECTIVA ::::::::::::::::::::::::::::::::::::///
function f_cargar_variables_vacio_ot(){
  f_limpia_ot();
  ot_id               = '';
  ot_origen           = '';
  ot_bus              = '';
  ot_kilometraje      = '';
  ot_fecha_registro   = '';
  ot_nombre_proveedor = '';
  ot_cgm              = '';
  ot_estado           = '';
  ot_actividad        = '';
  ot_obs_cgm          = '';
  ot_sistema          = '';
  ot_obs_proveedor    = '';
  ot_obs_ejecucion    = '';
  ot_semana_cierre    = '';
  ot_tipo             = '';
  ot_log              = '';
}
///:: FIN DE SE INICIALIZAN LAS VARIABLES DE LA OT CORRECTIVA :::::::::::::::::::::::::::::///

///:: SE CARGAN LAS VARIABLES HTML CON LA INFORMACION :::::::::::::::::::::::::::::::::::::///
function f_cargar_variables_html_ot(){
  let html="";
  let t_ot_id = "";
  $('#ot_id').val(ot_id);
  $('#ot_origen').val(ot_origen);
  $('#ot_bus').val(ot_bus);
  $('#ot_kilometraje').val(ot_kilometraje);
  $('#ot_fecha_registro').val(ot_fecha_registro);
  $('#ot_nombre_proveedor').val(ot_nombre_proveedor);
  $('#ot_cgm').val(ot_cgm);
  $('#ot_estado').val(ot_estado);
  $('#ot_actividad').val(ot_actividad);
  $('#ot_ejecucion').val(ot_ejecucion);
  $('#ot_obs_cgm').val(ot_obs_cgm);
  $('#ot_sistema').val(ot_sistema);
  $('#ot_obs_proveedor').val(ot_obs_proveedor);
  $("#ot_semana_cierre").val(ot_semana_cierre);
  $("#ot_tipo").val(ot_tipo);

  // Se cargan los div
  $("#div_km_comparacion").html(html);
  $("#div_codigo_ot").html(html);
  
  // Se calcula el rango del kilometraje
  if(ot_bus!="" && ot_fecha_registro!=null){
    f_calculo_kilometraje(ot_bus,ot_fecha_registro);
  }

  if(ot_id!==""){
    t_ot_id = "00000000"+ot_id;
    t_ot_id = t_ot_id.substring(t_ot_id.length-8);
  }
  
  html = f_MostrarDiv("form_procesar_ot","div_codigo_ot",t_ot_id,"");
  $("#div_codigo_ot").html(html);
}
///:: FIN DE SE CARGAN LAS VARIABLES HTML CON LA INFORMACION ::::::::::::::::::::::::::::::///

///:: SE CARGAN LAS VARIABLES CON LOS VALORES EDITADOS ::::::::::::::::::::::::::::::::::::///
function f_cargar_variables_editadas_ot(){
  ot_id               = $.trim($('#ot_id').val());
  ot_origen           = $.trim($('#ot_origen').val());
  ot_bus              = $.trim($('#ot_bus').val());
  ot_kilometraje      = $.trim($('#ot_kilometraje').val());
  ot_fecha_registro   = $.trim($('#ot_fecha_registro').val());
  ot_nombre_proveedor = $.trim($('#ot_nombre_proveedor').val());
  ot_cgm              = $.trim($('#ot_cgm').val());
  ot_estado           = $.trim($('#ot_estado').val());
  ot_actividad        = $.trim($('#ot_actividad').val());
  ot_ejecucion        = $.trim($('#ot_ejecucion').val());
  ot_obs_cgm          = $.trim($('#ot_obs_cgm').val());
  ot_sistema          = $.trim($('#ot_sistema').val());
  ot_obs_proveedor    = $.trim($('#ot_obs_proveedor').val());
  ot_semana_cierre    = $.trim($('#ot_semana_cierre').val());
  ot_tipo             = $.trim($('#ot_tipo').val());
}
///:: FIN DE SE CARGAN LAS VARIABLES CON LOS VALORES EDITADOS :::::::::::::::::::::::::::::///

///:: CALCULO DE KM DEL DIA ANTERIOR Y DEL DIA FINAL:::::::::::::::::::::::::::::::::::::::///
function f_calculo_kilometraje(pot_bus, pot_inicio){
  let kmhtml = "";
  if(pot_inicio.length>0){
    pot_inicio = pot_inicio.substring(0,10);
    if(pot_inicio!="0000-00-00"){
      Accion = 'CalculoKilometraje';
      $.ajax({
        url     : "Ajax.php",
        type    : "POST",
        datatype: "json",
        async   : false,
        data    : {MoS:MoS, NombreMoS:NombreMoS, Accion:Accion, ot_bus:pot_bus, ot_inicio:pot_inicio},    
        success : function(data){
          kmhtml = data;
        },
      });
    }
  }
  $("#div_km_comparacion").html(kmhtml);
}
///:: FIN DE CALCULO DE KM DEL DIA ANTERIOR Y DEL DIA FINAL::::::::::::::::::::::::::::::::///

///:: VALIDA EL KM REALIZADO ::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
function f_validar_km(pot_bus, pot_inicio, pot_kilometraje){
  let rptakm = "";
  if(pot_inicio.length>0){
    pot_inicio = pot_inicio.substring(0,10);
    if(pot_inicio!="0000-00-00"){
      Accion = 'ValidarKm';
      $.ajax({
        url     : "Ajax.php",
        type    : "POST",
        datatype: "json",
        async   : false,
        data    : {MoS:MoS, NombreMoS:NombreMoS, Accion:Accion, ot_bus:pot_bus, ot_inicio:pot_inicio, ot_kilometraje:pot_kilometraje},    
        success : function(data){
          rptakm = data;
        },
      });
    }
  }
  return rptakm;
}
///:: FIN DE VALIDA EL KM REALIZADO :::::::::::::::::::::::::::::::::::::::::::::::::::::::///

///:: FUNCION QUE CARGA LOS COMBOS DE SELECTS :::::::::::::::::::::::::::::::::::::::::::::///
function f_combos_selects_ot()
{
  select_ot = f_select_combo("Buses","NO","Bus_NroExterno","","`Bus_NroExterno`!='' AND `Bus_Tipo`='UNIDAD' AND `Bus_Estado`='DISPONIBLE' AND (`Bus_Tipo2`='ALIMENTADOR' OR `Bus_Tipo2`='ARTICULADO')","CAST(`Bus_NroExterno` AS UNSIGNED)");
  $("#ot_bus").html(select_ot);

  select_ot = f_select_combo("manto_proveedores", "NO", "prov_razonsocial", "", "`prov_ruc`!='' AND `prov_razonsocial`!=''", "`prov_razonsocial` ASC");
  $("#ot_nombre_proveedor").html(select_ot);
  
  select_ot = f_select_combo("manto_ot_origen", "NO", "or_nombre", "", "`or_nombre`!='' AND `or_tipo_ot`!=''", "`or_nombre` ASC");
  $("#ot_origen").html(select_ot);

  select_ot = f_select_roles("CGM","Colab_nombre_corto"); 
  $("#ot_cgm").html(select_ot);

  select_ot = f_select_combo("manto_tc_orden_trabajo", "NO", "tc_categoria3", "", "`tc_variable`='SISTEMA' AND `tc_categoria1`='ORDEN TRABAJO' AND `tc_categoria2`='ESTADO'", "`tc_categoria3` ASC");
  $("#ot_estado").html(select_ot);

  select_ot = f_select_combo("manto_tc_orden_trabajo", "NO", "tc_categoria3", "", "`tc_variable`='USUARIO' AND `tc_categoria1`='ORDEN TRABAJO' AND `tc_categoria2`='SISTEMA'", "`tc_categoria3` ASC");
  $("#ot_sistema").html(select_ot);

  select_ot = f_select_combo("Calendario", "SI", "Calendario_Semana", "", "", "`Calendario_Semana` DESC");
  $("#ot_semana_cierre").html(select_ot);
}
///:: FIN DE FUNCION QUE CARGA LOS COMBOS DE SELECTS ::::::::::::::::::::::::::::::::::::::///

function f_validar_semana_cerrada(p_semana){
  let a_data;
  let rpta="";
  a_data = f_BuscarDataBD("manto_ot_cierre", "otc_semana", p_semana);
  $.each(a_data, function(idx, obj){ 
    rpta = obj.otc_estado;
  });
  return rpta;  
}
///:: TERMINO DE FUNCIONES DE ORDEN DE TRABAJO ::::::::::::::::::::::::::::::::::::::::::::///