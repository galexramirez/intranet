///::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
///:: ENTRADA INVENTARIO v 1.0 FECHA: 22-11-2022 ::::::::::::::::::::::::::::::::::::::::::///
//::: EDITAR TABLA ENTRADA INVENTARIO :::::::::::::::::::::::::::::::::::::::::::::::::::::///
///::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///

///:: INICIO DECLARACION VARIABLES ::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
var entrada_id, ent_log;
var select_html;
miCarpeta = f_DocumentRoot();
///:: FIN DECLARACION VARIABLES :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///

///:: INICIO JS DOM ENTRADA INVENTARIO ::::::::::::::::::::::::::::::::::::::::::::::::::::///

$(document).ready(function(){
  ///:: CARGAR BOTONES SELECCION ENTRADA ::::::::::::::::::::::::::::::::::::::::::::::::::///
  div_show = f_MostrarDiv("form_seleccion_entrada","btn_seleccion_entrada","inicio","");
  $("#div_btn_seleccion_entrada").html(div_show);
  
  ///:: CANBIOS EN CODIGO ENTRADA :::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
  $("#entrada_id").on('change', function () {
    entrada_id = $("#entrada_id").val();
    div_show = f_MostrarDiv("form_seleccion_entrada","btn_seleccion_entrada","inicio","");
    $("#div_btn_seleccion_entrada").html(div_show);
    div_show = f_DivFormulario("form_procesar_entrada","vacio");
    $("#div_form_entrada").html(div_show);  
  });

  ///:: CAMBIOS TIPO MOVIMIENTO :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
  $(document).on("change", ".ent_tipo_movimiento", function(){
    ent_tipo_movimiento = $("#ent_tipo_movimiento").val();
    select_html = f_TipoTabla("ENTRADA",ent_tipo_movimiento);
    $("#ent_tipo_documento").html(select_html);    
  });

  ///:: CAMBIOS TIPO DOCUMENTO ::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
  $(document).on("change", ".ent_tipo_documento", function(){
    ent_tipo_documento = $("#ent_tipo_documento").val();
    ent_nro_documento = "";
    $("#ent_nro_documento").val(ent_nro_documento);
  });

  ///:: CAMBIOS EN EL NUMERO DE DOCUMENTO :::::::::::::::::::::::::::::::::::::::::::::::::///
  $(document).on("change", ".ent_nro_documento", function(){
    btn_accion_materiales_entrada = "SI";
    ent_tipo_documento = $("#ent_tipo_documento").val();
    ent_nro_documento = $("#ent_nro_documento").val();
    f_tabla_importar_materiales_entrada(ent_tipo_documento, ent_nro_documento, btn_accion_materiales_entrada);
  });

  ///:::::::::::::::::::: INICIO BOTONES DE ENTRADA INVENTARIO :::::::::::::::::::::::::///

  ///::::::::::::::::::::: BOTON CARGAR ENTRADA INVENTARIO :::::::::::::::::::::::::::::///
  $(document).on("click", ".btn_cargar_entrada", function(){
    entrada_id = $("#entrada_id").val();
    if(entrada_id==""){
      Swal.fire({
        position: 'center',
        icon: 'error',
        title: '*Falta Completar Información!!!',
        showConfirmButton: false,
        timer: 1500
      })
      $("#entrada_id").focus();
    }else{
      btn_accion_materiales_entrada = "NO";
      div_show = f_MostrarDiv("form_seleccion_entrada","btn_seleccion_entrada","cargar","")
      $("#div_btn_seleccion_entrada").html(div_show);
      div_show = f_DivFormulario("form_entrada","ver");
      $("#div_form_entrada").html(div_show);
      f_tabla_materiales_entrada(entrada_id,btn_accion_materiales_entrada);
    }
  });
  ///:::::::::::::::::: FIN BOTON CARGAR ENTRADA INVENTARIO ::::::::::::::::::::::::::::///

  ///:::::::::::::::::::: BOTON EDITAR ENTRADA INVENTARIO ::::::::::::::::::::::::::::::///
  $(document).on("click", ".btn_editar_entrada", function(){
    opcion_entrada = "EDITAR";
    div_show = f_MostrarDiv("form_seleccion_entrada","btn_seleccion_entrada","nuevo","")
    $("#div_btn_seleccion_entrada").html(div_show);
    div_show = f_DivFormulario("form_entrada","editar");
    $("#div_form_entrada").html(div_show);
    f_combos_entrada();
  });
  ///:: FIN BOTON EDITAR ENTRADA INVENTARIO :::::::::::::::::::::::::::::::::::::::::::::::///

  ///:: BOTON NUEVO ENTRADA INVENTARIO ::::::::::::::::::::::::::::::::::::::::::::::::::::///
  $(document).on("click", ".btn_nuevo_entrada", function(){
    opcion_entrada = "NUEVO";
    $("#entrada_id").prop("disabled",true);
    btn_accion_materiales_entrada = "SI";
    entrada_id = $("#entrada_id").val();
    div_show = f_MostrarDiv("form_seleccion_entrada","btn_seleccion_entrada","nuevo","")
    $("#div_btn_seleccion_entrada").html(div_show);
    div_show = f_DivFormulario("form_entrada","editar");
    $("#div_form_entrada").html(div_show);
    ent_fecha_creacion = f_CalculoFecha("hoy","0");
    ent_usuario_nombre = f_usuario_nombre();
    $('#ent_fecha_creacion').val(ent_fecha_creacion);
    $("#ent_usuario_nombre").val(ent_usuario_nombre);
    f_combos_entrada();
    f_tabla_materiales_entrada(entrada_id,btn_accion_materiales_entrada);
  
  });
  ///:: FIN BOTON NUEVO ENTRADA INVENTARIO ::::::::::::::::::::::::::::::::::::::::::::::::///

  ///:: BOTON CANCELAR ENTRADA INVENTARIO :::::::::::::::::::::::::::::::::::::::::::::::::///
  $(document).on("click", ".btn_cancelar_entrada", function(){
    $("#entrada_id").prop("disabled",false);
    $("#entrada_id").focus();
    div_show = f_MostrarDiv("form_seleccion_entrada","btn_seleccion_entrada","inicio","");
    $("#div_btn_seleccion_entrada").html(div_show);
    div_show = f_DivFormulario("form_entrada","vacio");
    $("#div_form_entrada").html(div_show);  
  });
  ///:: TERMINO BOTON CANCELAR ENTRADA ::::::::::::::::::::::::::::::::::::::::::::::::::::///

  ///:: EVENTO DEL BOTON VER LOG ENTRADA ::::::::::::::::::::::::::::::::::::::::::::::::::///
  $(document).on("click", ".btn_log_entrada", function(){
    $("#form_modal_log_entrada").trigger("reset");
    $(".modal-header").css( "background-color", "#17a2b8");
    $(".modal-header").css( "color", "white" );
    $(".modal-title").text("Log Entrada de Inventario");
    $('#modal_crud_log_entrada').modal('show');
    $("#modal_crud_log_entrada").draggable({});
    $("#div_log_entrada").html(ent_log);
  });
  ///:: TERMINO BOTON VER LOG PEDIDO ::::::::::::::::::::::::::::::::::::::::::::::::::::::///

  ///:: BOTON GUARDAR ENTRADA :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
  $(document).on("click", ".btn_guardar_entrada", function(){
    let array_data = [];
    t_valida_entrada = "";
    
    entrada_id                = $('#entrada_id').val();
    ent_fecha_creacion        = $('#ent_fecha_creacion').val();
    ent_almacen_descripcion   = $('#ent_almacen_descripcion').val();
    ent_tipo_movimiento       = $('#ent_tipo_movimiento').val();
    ent_tipo_documento        = $('#ent_tipo_documento').val();
    ent_nro_documento         = $('#ent_nro_documento').val();
    ent_nombre_entrega        = $('#ent_nombre_entrega').val();
    ent_centro_costo          = $("#ent_centro_costo").val();
    obs_ent_log               = $.trim($("#obs_ent_log").val());
    array_materiales_entrada  = tabla_materiales_entrada.rows().data().toArray();

    t_valida_entrada = f_validar_entrada(entrada_id, ent_fecha_creacion, ent_almacen_descripcion, ent_tipo_movimiento, ent_tipo_documento, ent_nro_documento, ent_nombre_entrega, ent_centro_costo, obs_ent_log, array_materiales_entrada);

    if(t_valida_entrada == "invalido"){
      Swal.fire({
        position: 'center',
        icon: 'error',
        title: '*Falta Completar Información!!!',
        showConfirmButton: false,
        timer: 1500
      })
    }else{
      $("#btn_guardar_entrada").prop("disabled",true);
      array_data = JSON.stringify(array_materiales_entrada);
      if(opcion_entrada=="NUEVO"){
        Accion = "crear_entrada_inventario";
      }else{
        Accion = "editar_entrada_invetario";
      }
      $.ajax({
        url: "Ajax.php",
        type: "POST",
        datatype:"json",
        async: false,
        data: {MoS:MoS,NombreMoS:NombreMoS,Accion:Accion, entrada_id:entrada_id, ent_fecha_creacion:ent_fecha_creacion, ent_almacen_descripcion:ent_almacen_descripcion, ent_tipo_movimiento:ent_tipo_movimiento, ent_tipo_documento:ent_tipo_documento, ent_nro_documento:ent_nro_documento, ent_nombre_entrega:ent_nombre_entrega, ent_centro_costo:ent_centro_costo, obs_ent_log:obs_ent_log, array_data:array_data},
        success: function(data){

        }
      });
      $("#btn_guardar_entrada").prop("disabled",false);
      Swal.fire({
        position: 'center',
        icon: 'success',
        title: 'El registro ha sido grabado.',
        showConfirmButton: false,
        timer: 1500
      })
      div_show = f_MostrarDiv("form_seleccion_entrada","btn_seleccion_entrada","inicio","")
      $("#div_btn_seleccion_entrada").html(div_show);
      div_show = f_DivFormulario("form_entrada","vacio");
      $("#div_form_entrada").html(div_show);
      $("#entrada_id").focus().select();
      $("#entrada_id").prop("disabled",false);
    }
  });
  ///:: FIN BOTON GUIARDAR ENTRADA ::::::::::::::::::::::::::::::::::::::::::::::::::::::::///

  ///:: FIN DE BOTONES INVENTARIO :::::::::::::::::::::::::::::::::::::::::::::::::::::::::///

});

///:: FIN JS DOM ENTRADA INVENTARIO :::::::::::::::::::::::::::::::::::::::::::::::::::::::///


///:: INICIO FUNCIONES DE ENTRADA INVENTARIO ::::::::::::::::::::::::::::::::::::::::::::::///

///:: CARGA LOS COMBOS DE ENTRADA :::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
function f_combos_entrada(){
  let rpta_select_entrada;
  rpta_select_entrada = f_TipoTabla("ENTRADA","TIPO MOVIMIENTO");
  $("#ent_tipo_movimiento").html(rpta_select_entrada);
  rpta_select_entrada = f_TipoTabla("ENTRADA","CENTRO DE COSTO");
  $("#ent_centro_costo").html(rpta_select_entrada);
  
  Accion='select_almacen';
  $.ajax({
    url: "Ajax.php",
    type: "POST",
    datatype:"json",
    async: false,
    data: {MoS:MoS,NombreMoS:NombreMoS,Accion:Accion},    
    success: function(data){
      rpta_select_entrada = data;
    }
  });
  $("#ent_almacen_descripcion").html(rpta_select_entrada);
}
///:: FIN CARGA LOS COMBOS DE ENTRADA ::::::::::::::::::::::::::::::::::::::::::::::::::::///

///:: VALIDA LOS CAMPOS DE ENTRADA :::::::::::::::::::::::::::::::::::::::::::::::::::::::/// 
function f_validar_entrada(p_entrada_id, p_ent_fecha_creacion, p_ent_almacen_descripcion, p_ent_tipo_movimiento, p_ent_tipo_documento, p_ent_nro_documento, p_ent_nombre_entrega, p_ent_centro_costo, p_obs_ent_log, p_array_materiales_entrada){
  NoLetrasMayuscEspacio = /[^A-Z \Ñ]/;
  let rpta_entrada = "";
  f_limpia_entrada();

  if(p_ent_fecha_creacion==""){
    $("#ent_fecha_creacion").addClass("color-error");
    rpta_entrada="invalido";
  }
  
  if(p_ent_almacen_descripcion==""){
      $("#ent_almacen_descripcion").addClass("color-error");
      rpta_entrada="invalido";
  }
  
  if(p_ent_tipo_movimiento==""){
    $("#ent_tipo_movimiento").addClass("color-error");
    rpta_entrada="invalido";
  }

  if(p_ent_tipo_documento==""){
    $("#ent_tipo_documento").addClass("color-error");
    rpta_entrada="invalido";
  }

  if(p_ent_nro_documento==""){
    $("#ent_nro_documento").addClass("color-error");
    rpta_entrada="invalido";
  }

  if(p_ent_nombre_entrega==""){
    $("#ent_nombre_entrega").addClass("color-error");
    rpta_entrada="invalido";
  }

  if(p_ent_centro_costo==""){
    $("#ent_centro_costo").addClass("color-error");
    rpta_entrada="invalido";
  }

  /*if(p_obs_ent_log==""){
    $("#obs_ent_log").addClass("color-error");
    rpta_entrada="invalido";
  }*/

  if (p_array_materiales_entrada.length == 0){
    rpta_entrada="invalido";
    alert(p_array_materiales_entrada.length);
  }

  return rpta_entrada;
}
///:: FIN VALIDA LOS CAMPOS DE ENTRADA :::::::::::::::::::::::::::::::::::::::::::::::::/// 

///:: REMUEVE LA CLASE ERROR DEL FORMULARIO NUEVO ENTRADA ::::::::::::::::::::::::::::::/// 
function f_limpia_entrada(){
  $("#ent_fecha_creacion").removeClass("color-error");
  $("#ent_almacen_descripcion").removeClass("color-error");
  $("#ent_tipo_movimiento").removeClass("color-error");
  $("#ent_tipo_documento").removeClass("color-error");
  $("#ent_nro_documento").removeClass("color-error");
  $("#ent_nombre_entrega").removeClass("color-error");
  $("#ent_centro_costo").removeClass("color-error");
  //$("#obs_ent_log").removeClass("color-error");
}
///:: FIN REMUEVE LA CLASE ERROR DEL FORMULARIO NUEVO ENTRADA ::::::::::::::::::::::::::/// 


///::::::::::::::::::::::: TERMINO FUNCIONES DE PROCESAR INVENTARIO ::::::::::::::::::::///