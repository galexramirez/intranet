///::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
///:: PROCESAR PEDIDOS v 2.0 FECHA: 18-02-2023 ::::::::::::::::::::::::::::::::::::::::::::///
//::: EDITAR TABLA DE PEDIDOS :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
///::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///

///:: INICIO DECLARACION VARIABLE :::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
var pedido_id, pedi_fechacreacion, pedi_fecharequerimiento, pedi_prioridad, pedi_centrocosto, pedi_proceso, pedi_nombre_contacto, pedi_direccion_entrega, pedi_orden_compra_directa, pedi_tipo, pedi_cotizacion, pedi_ordencompra, pedi_estado, pedi_log,  tpedi_estado, tpedido_id, obs_log, obs_validar, obs_validar_pedido_directo, obs_cancelar_pedido, pedi_estado_obs;
var tabla_material_pedido, btn_borrar_material, t_valida_pedido, tabla_cotizacion;
var array_material_pedido, opcion_procesar_pedido;
var inicio_pedido = "INICIO";
///:: FIN DECLARACION VARIABLE ::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///

///:: INICIO JS DOM PROCESAR PEDIDOS ::::::::::::::::::::::::::::::::::::::::::::::::::::::///

$(document).ready(function(){
  ///:: CARGAR BOTONES SELECCION PROCESAR PEDIDO ::::::::::::::::::::::::::::::::::::::::::///
  div_show = f_MostrarDiv("form_seleccion_procesar_pedido","btn_seleccion_procesar_pedido",inicio_pedido,"");
  $("#div_btn_seleccion_procesar_pedido").html(div_show);
  div_show = f_MostrarDiv("form_procesar_pedido","","");
  $("#div_form_procesar_pedido").html(div_show);
  $("#div_solicitar_cotizacion").hide();
  
  ///:: CAMBIOS CODIGO PEDIDO SE OCULTA EL FORMULARIO :::::::::::::::::::::::::::::::::::::///
  $("#pedido_id").on('change', function () {
    pedido_id = $("#pedido_id").val();
    div_show = f_MostrarDiv("form_seleccion_procesar_pedido","btn_seleccion_procesar_pedido",inicio_pedido,"");
    $("#div_btn_seleccion_procesar_pedido").html(div_show);
    div_show = f_MostrarDiv("form_procesar_pedido","form_procesar_pedido","","");
    $("#div_form_procesar_pedido").html(div_show);
    $("#div_solicitar_cotizacion").hide();
  });

  ///:: INICIO BOTONES DE PROCESAR PEDIDOS ::::::::::::::::::::::::::::::::::::::::::::::::///

  ///:: BOTON CANCELAR PROCESAR PEDIDOS :::::::::::::::::::::::::::::::::::::::::::::::::::///
  $(document).on("click", ".btn_cancelar_procesar_pedido", function(){
    $("#pedido_id").prop("disabled",false);
    $("#pedido_id").focus();

    div_show = f_MostrarDiv("form_seleccion_procesar_pedido","btn_seleccion_procesar_pedido",inicio_pedido,"");
    $("#div_btn_seleccion_procesar_pedido").html(div_show);
    div_show = f_MostrarDiv("form_procesar_pedido","form_procesar_pedido","","");
    $("#div_form_procesar_pedido").html(div_show);
    $("#div_solicitar_cotizacion").hide();
  });
  ///:: FIN BOTON CANCELAR PROCESAR PEDIDOS :::::::::::::::::::::::::::::::::::::::::::::::///

  ///:: BOTON CARGAR PROCESAR PEDIDO ::::::::::::::::::::::::::::::::::::::::::::::::::::::///
  $(document).on("click", ".btn_cargar_pedido", function(){
    let cargar_data = [];
    f_cargar_variables_vacio_pedido();
    pedido_id  = $("#pedido_id").val();
    tpedido_id = $("#pedido_id").val();
    if(pedido_id==""){
      $("#pedido_id").focus();
      Swal.fire({
        position          : 'center',
        icon              : 'error',
        title             : 'Ingresar N° Pedido !!!',
        showConfirmButton : false,
        timer             : 1500
      })
    }else{
      cargar_data = f_cargar_pedido(pedido_id);
          f_cargar_variables_pedido(cargar_data);
          if(pedi_estado!=""){
            div_show = f_MostrarDiv("form_seleccion_procesar_pedido","btn_seleccion_procesar_pedido",pedi_estado,pedi_orden_compra_directa);
            $("#div_btn_seleccion_procesar_pedido").html(div_show);
            div_show = f_MostrarDiv("form_procesar_pedido","form_procesar_pedido","","cargar");
            $("#div_form_procesar_pedido").html(div_show);
            div_show = f_MostrarDiv("form_procesar_pedido","div_solicitar_cotizacion",pedi_estado,"");
            $("#div_solicitar_cotizacion").html(div_show);
            if(pedi_estado=="PENDIENTE DE APROBACION" || pedi_estado=="OBSERVADO"){
              $("#div_solicitar_cotizacion").hide();
            }else{
              $("#div_solicitar_cotizacion").show();
            }
            
            f_tabla_cotizacion();
            f_combos_pedido();
            f_cargar_variables_html_pedido();
          }else{
            $("#pedido_id").focus();
            Swal.fire({
              position          : 'center',
              icon              : 'error',
              title             : 'N° Pedido NO se encuentra !!!',
              showConfirmButton : false,
              timer             : 1500
            });
          }
          // SE DESHABILITAN LOS CAMPOS DE CABECERA
          $("#pedi_fecharequerimiento").prop("disabled",true);
          $("#pedi_prioridad").prop("disabled",true);
          $("#pedi_centrocosto").prop("disabled",true);
          $("#pedi_proceso").prop("disabled",true);
          $("#pedi_nombre_contacto").prop("disabled",true);
          $("#pedi_direccion_entrega").prop("disabled",true);
          $("#pedi_orden_compra_directa").prop("disabled",true);
          $("#pedi_tipo").prop("disabled",true);

          // SE DESHABILITA LOS CAMPOS DE DETALLE
          $("#pedi_estado").prop("disabled",true);
          $("#obs_log").prop("disabled",true);
          // SE CARGA TABLA DETALLE DE REPUESTOS
          btn_borrar_material = "NO";
          f_tabla_material_pedido(pedido_id,btn_borrar_material);
    }
  });
  ///:: FIN BOTON CARGAR PROCESAR PEDIDO ::::::::::::::::::::::::::::::::::::::::::::::::::///

  ///:: BOTON NUEVO PROCESAR PEDIDO :::::::::::::::::::::::::::::::::::::::::::::::::::::::///
  $(document).on("click", ".btn_nuevo_pedido", function(){
    f_cargar_variables_vacio_pedido();
    pedido_id   = $("#pedido_id").val();
    tpedido_id  = $("#pedido_id").val();

    if(pedido_id!=""){
      $("#pedido_id").focus();
      Swal.fire({
        position          : 'center',
        icon              : 'error',
        title             : 'N° Pedido debe estar vacio!!!',
        showConfirmButton : false,
        timer             : 1500
      })
    }else{
      opcion_procesar_pedido = "NUEVO";
      div_show = f_MostrarDiv("form_seleccion_procesar_pedido","btn_seleccion_procesar_pedido",opcion_procesar_pedido,"");
      $("#div_btn_seleccion_procesar_pedido").html(div_show);
      div_show = f_MostrarDiv("form_procesar_pedido","form_procesar_pedido","material","cargar");
      $("#div_form_procesar_pedido").html(div_show);
      $("#div_solicitar_cotizacion").hide();

      $("#pedi_fecharequerimiento").focus().select();
      f_combos_pedido();
      f_cargar_variables_html_pedido();

      $("#pedido_id").prop("disabled",true);
      // SE HABILITAN LOS CAMPOS DE PEDIDO
      $("#pedi_fecharequerimiento").prop("disabled",false);
      $("#pedi_prioridad").prop("disabled",false);
      $("#pedi_centrocosto").prop("disabled",false);
      $("#pedi_proceso").prop("disabled",false);
      $("#pedi_nombre_contacto").prop("disabled",false);
      $("#pedi_direccion_entrega").prop("disabled",false);
      $("#pedi_orden_compra_directa").prop("disabled",false);
      $("#pedi_tipo").prop("disabled",false);
      $("#obs_log").prop("disabled",false);

      // SE CARGA TABLA DETALLE DE REPUESTOS
      btn_borrar_material = "SI";
      f_tabla_material_pedido(pedido_id,btn_borrar_material);
    }
  });
  ///:: FIN BOTON NUEVO PROCESAR PEDIDO :::::::::::::::::::::::::::::::::::::::::::::::::::///

  ///:: BOTON EDITAR PROCESAR PEDIDO ::::::::::::::::::::::::::::::::::::::::::::::::::::::///
  $(document).on("click", ".btn_editar_procesar_pedido", function(){
    let c_data = [];
    opcion_procesar_pedido = "EDITAR";
    div_show = f_MostrarDiv("form_seleccion_procesar_pedido","btn_seleccion_procesar_pedido",pedi_estado,"");
    $("#div_btn_seleccion_procesar_pedido").html(div_show);
    div_show = f_MostrarDiv("form_procesar_pedido","form_procesar_pedido","material","cargar");
    $("#div_form_procesar_pedido").html(div_show);
    $("#div_solicitar_cotizacion").hide();

    f_combos_pedido();
    f_cargar_variables_vacio_pedido();
    pedido_id = $("#pedido_id").val();
    c_data = f_cargar_pedido(pedido_id);
    f_cargar_variables_pedido(c_data);
    f_cargar_variables_html_pedido();
    
    $("#pedi_fecharequerimiento").focus().select();

    $("#pedido_id").prop("disabled",true);
    $("#pedi_fecharequerimiento").prop("disabled",false);
    $("#pedi_prioridad").prop("disabled",false);
    $("#pedi_centrocosto").prop("disabled",false);
    $("#pedi_proceso").prop("disabled",false);
    $("#pedi_nombre_contacto").prop("disabled",false);
    $("#pedi_direccion_entrega").prop("disabled",false);
    $("#pedi_orden_compra_directa").prop("disabled",false);    
    $("#pedi_tipo").prop("disabled",false);
    $("#obs_log").prop("disabled",false);

    btn_borrar_material = "SI";
    f_tabla_material_pedido(pedido_id,btn_borrar_material);
  });
  ///:: FIN BOTON EDITAR PROCESAR PEDIDO ::::::::::::::::::::::::::::::::::::::::::::::::::///

  ///:: BOTON GUARDAR PEDIDO ::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
  $(document).on("click", ".btn_guardar_procesar_pedido", function(){
    let array_data            = [];
    let msg_title             = '';
    t_valida_pedido           = "";
    pedido_id                 = $('#pedido_id').val();
    pedi_fechacreacion        = $('#pedi_fechacreacion').val();
    pedi_fecharequerimiento   = $('#pedi_fecharequerimiento').val();
    pedi_prioridad            = $('#pedi_prioridad').val();
    pedi_centrocosto          = $('#pedi_centrocosto').val();
    pedi_proceso              = $('#pedi_proceso').val();
    pedi_nombre_contacto      = $('#pedi_nombre_contacto').val();
    pedi_direccion_entrega    = $('#pedi_direccion_entrega').val();
    pedi_orden_compra_directa = $('#pedi_orden_compra_directa').val();
    pedi_tipo                 = $('#pedi_tipo').val();
    pedi_estado               = $("#pedi_estado").val();
    obs_log                   = $.trim($("#obs_log").val());
    array_material_pedido     = tabla_material_pedido.rows().data().toArray();

    if(array_material_pedido.length == 0){
      t_valida_pedido = "invalido";
      msg_title       = '*Agregar ';
      if(pedi_tipo==""){
        msg_title     = msg_title + 'Material o Servicio';
      }else{
        msg_title     = msg_title + pedi_tipo;
      }
      msg_title       = msg_title + '!!!<br>';
    }

    if("invalido" == f_validar_tipo(pedi_tipo, array_material_pedido)){
      t_valida_pedido = "invalido";
      msg_title       = msg_title + '*Agregar solo ' + pedi_tipo + '!!!<br>';
    }

    if( "invalido" == f_validar_pedido(pedido_id, pedi_fechacreacion, pedi_fecharequerimiento, pedi_prioridad, pedi_centrocosto, pedi_proceso, pedi_nombre_contacto, pedi_direccion_entrega, pedi_orden_compra_directa, pedi_tipo, obs_log, array_material_pedido)){
      t_valida_pedido = "invalido";
      msg_title       = msg_title + '*Falta Completar Información!!! ';
    }

    if(t_valida_pedido == "invalido"){
      Swal.fire({
        position          : 'center',
        icon              : 'error',
        title             : '* ERROR EN INFORMACION !!!',
        html              : msg_title,
        showConfirmButton : false,
        timer             : 1500
      })
    }else{
      $("#btn_guardar_procesar_pedido").prop("disabled",true);
      array_data = JSON.stringify(array_material_pedido);
      if(opcion_procesar_pedido=="NUEVO"){
        Accion      = "generar_pedido";
      }else{
        Accion      = "editar_pedido";
        pedi_estado = "PENDIENTE DE APROBACION";
      }
      $.ajax({
        url       : "Ajax.php",
        type      : "POST",
        datatype  :"json",
        async     : false,
        data      : {MoS:MoS,NombreMoS:NombreMoS,Accion:Accion, pedido_id:pedido_id, pedi_fechacreacion:pedi_fechacreacion, pedi_fecharequerimiento:pedi_fecharequerimiento, pedi_prioridad:pedi_prioridad, pedi_centrocosto:pedi_centrocosto, pedi_proceso:pedi_proceso, pedi_nombre_contacto:pedi_nombre_contacto, pedi_direccion_entrega:pedi_direccion_entrega, pedi_orden_compra_directa:pedi_orden_compra_directa, pedi_tipo:pedi_tipo, pedi_estado:pedi_estado, pedi_log:pedi_log, obs_log:obs_log, array_data:array_data},
        success   : function(data){

        }
      });
      $("#btn_guardar_procesar_pedido").prop("disabled",false);
      Swal.fire({
        position          : 'center',
        icon              : 'success',
        title             : 'El registro ha sido grabado.',
        showConfirmButton : false,
        timer             : 1500
      })

      div_show = f_MostrarDiv("form_seleccion_procesar_pedido","btn_seleccion_procesar_pedido",inicio_pedido,"");
      $("#div_btn_seleccion_procesar_pedido").html(div_show);
      div_show = f_MostrarDiv("form_procesar_pedido","","");
      $("#div_form_procesar_pedido").html(div_show);
      $("#div_solicitar_cotizacion").hide();

      $("#pedido_id").prop("disabled",false);
      $("#pedido_id").focus().select();

      btn_borrar_material = "NO";
      f_tabla_material_pedido(pedido_id,btn_borrar_material);
    }
  });
  ///:: FIN BOTON GUARDAR PEDIDO ::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///

  ///:: EVENTO DEL BOTON VER LOG PEDIDO :::::::::::::::::::::::::::::::::::::::::::::::::::///
  $(document).on("click", ".btn_log_pedido", function(){
    $("#form_modal_log_pedido").trigger("reset");

    $(".modal-header").css( "background-color", "#17a2b8");
    $(".modal-header").css( "color", "white" );
    $(".modal-title").text("Log");
    $('#modal_crud_log_pedido').modal('show');
    $("#modal_crud_log_pedido").draggable({});
    $("#div_log_pedido").html(pedi_log);
  });
  ///:: FIN BOTON VER LOG PEDIDO ::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///

  ///:: EVENTO DEL BOTON VALIDAR PEDIDO :::::::::::::::::::::::::::::::::::::::::::::::::::///
  $(document).on("click", ".btn_validar_pedido", function(){
    obs_validar = "";
    $("#form_modal_validar_pedido").trigger("reset");

    $("#obs_validar").val(obs_validar);
    $("#obs_validar").removeClass("color-error");
    $(".modal-header").css( "background-color", "#17a2b8");
    $(".modal-header").css( "color", "white" );
    $(".modal-title").text("Validar Pedido");
    $('#modal_crud_validar_pedido').modal('show');
    $("#modal_crud_validar_pedido").draggable({});
  });
  ///:: FIN EVENTO DEL BOTON VALIDAR PEDIDO :::::::::::::::::::::::::::::::::::::::::::::::///

  ///:: EVENTO DEL BOTON VALIDAR PEDIDO DIRECTO :::::::::::::::::::::::::::::::::::::::::::///
  $(document).on("click", ".btn_validar_pedido_directo", function(){
    obs_validar_pedido_directo = "";
    $("#form_modal_validar_pedido_directo").trigger("reset");

    $("#obs_validar_pedido_directo").val(obs_validar_pedido_directo);
    $("#obs_validar_pedido_directo").removeClass("color-error");
    $(".modal-header").css( "background-color", "#17a2b8");
    $(".modal-header").css( "color", "white" );
    $(".modal-title").text("Validar Pedido Directo");
    $('#modal_crud_validar_pedido_directo').modal('show');
    $("#modal_crud_validar_pedido_directo").draggable({});
  });
  ///:: FIN EVENTO DEL BOTON VALIDAR PEDIDO DIRECTO :::::::::::::::::::::::::::::::::::::::///

  ///:: EVENTO DEL BOTON CANCEALR PEDIDO ::::::::::::::::::::::::::::::::::::::::::::::::::///
  $(document).on("click", ".btn_cancelar_pedido", function(){
    obs_cancelar_pedido = "";
    $("#form_modal_cancelar_pedido").trigger("reset");

    $("#obs_cancelar_pedido").val(obs_cancelar_pedido);
    $("#obs_cancelar_pedido").removeClass("color-error");
    $(".modal-header").css( "background-color", "#17a2b8");
    $(".modal-header").css( "color", "white" );
    $(".modal-title").text("Cancelar Pedido");
    $('#modal_crud_cancelar_pedido').modal('show');
    $("#modal_crud_cancelar_pedido").draggable({});
  });
  ///:: EVENTO DEL BOTON CANCELAR PEDIDO ::::::::::::::::::::::::::::::::::::::::::::::::::///

  ///:: EVENTO DEL BOTON APROBAR PEDIDO :::::::::::::::::::::::::::::::::::::::::::::::::::///
  $(document).on("click", ".btn_aprobar_pedido", function(){
    $("#obs_validar").removeClass("color-error");
    obs_validar     = $("#obs_validar").val();
    pedi_estado_obs = "";
    if(obs_validar == ""){
      $("obs_validar").addClass("color-error");
      Swal.fire({
        position          : 'center',
        icon              : 'error',
        title             : '*Falta Completar Información!!!',
        showConfirmButton : false,
        timer             : 1500
      })
    }else{
      pedi_estado = "REQUERIDO";
      Accion      = 'estado_pedido';
      $.ajax({
        url       : "Ajax.php",
        type      : "POST",
        datatype  :"json",
        async     : false,
        data      : {MoS:MoS,NombreMoS:NombreMoS,Accion:Accion, pedido_id:pedido_id, pedi_estado:pedi_estado, pedi_log:pedi_log, obs_log:obs_validar, pedi_estado_obs:pedi_estado_obs},    
        success   : function(data){

        }
      });
      $("#pedi_estado").val(pedi_estado);
      div_show = f_MostrarDiv("form_seleccion_procesar_pedido","btn_seleccion_procesar_pedido",pedi_estado,"");
      $("#div_btn_seleccion_procesar_pedido").html(div_show);
      div_show = f_MostrarDiv("form_procesar_pedido","div_solicitar_cotizacion",pedi_estado,"");
      $("#div_solicitar_cotizacion").html(div_show);
      $("#div_solicitar_cotizacion").show();
      f_tabla_cotizacion();

      $('#modal_crud_validar_pedido').modal('hide');
    }
  });
  ///:: FIN EVENTO DEL BOTON APROBAR PEDIDO :::::::::::::::::::::::::::::::::::::::::::::::///

  ///:: EVENTO DEL BOTON APROBAR PEDIDO DIRECTO :::::::::::::::::::::::::::::::::::::::::::///
  $(document).on("click", ".btn_aprobar_pedido_directo", function(){
    $("#obs_validar_pedido_directo").removeClass("color-error");
    obs_validar_pedido_directo = $("#obs_validar_pedido_directo").val();
    if(obs_validar_pedido_directo == ""){
      $("#obs_validar_pedido_directo").addClass("color-error");
      Swal.fire({
        position          : 'center',
        icon              : 'error',
        title             : '*Falta Completar Información!!!',
        showConfirmButton : false,
        timer             : 1500
      })
    }else{
      pedi_estado     = "REQUERIDO";
      pedi_estado_obs = "";
      Accion      = 'estado_pedido';
      $.ajax({
        url       : "Ajax.php",
        type      : "POST",
        datatype  :"json",
        async     : false,
        data      : {MoS:MoS,NombreMoS:NombreMoS,Accion:Accion, pedido_id:pedido_id, pedi_estado:pedi_estado, pedi_log:pedi_log, obs_log:obs_validar_pedido_directo, pedi_estado_obs:pedi_estado_obs},    
        success   : function(data){

        }
      });
      $("#pedi_estado").val(pedi_estado);
      div_show = f_MostrarDiv("form_seleccion_procesar_pedido","btn_seleccion_procesar_pedido",pedi_estado,"");
      $("#div_btn_seleccion_procesar_pedido").html(div_show);
      div_show = f_MostrarDiv("form_procesar_pedido","div_solicitar_cotizacion",pedi_estado,"");
      $("#div_solicitar_cotizacion").html(div_show);
      $("#div_solicitar_cotizacion").show();
      f_tabla_cotizacion();

      $('#modal_crud_validar_pedido_directo').modal('hide');
    }
  });
  ///:: FIN EVENTO DEL BOTON APROBAR PEDIDO DIRECTO :::::::::::::::::::::::::::::::::::::::///

  ///:: EVENTO DEL BOTON ACEPTAR CANCELAR PEDIDO ::::::::::::::::::::::::::::::::::::::::::///
  $(document).on("click", ".btn_aceptar_cancelar_pedido", function(){
    $("#obs_cancelar_pedido").removeClass("color-error");
    obs_cancelar_pedido = $("#obs_cancelar_pedido").val();
    if(obs_cancelar_pedido == ""){
      $("#obs_cancelar_pedido").addClass("color-error");
      Swal.fire({
        position          : 'center',
        icon              : 'error',
        title             : '*Falta Completar Información!!!',
        showConfirmButton : false,
        timer             : 1500
      })
    }else{
      pedi_estado     = "CANCELADO";
      pedi_estado_obs = "";
      Accion      = 'estado_pedido';
      $.ajax({
        url       : "Ajax.php",
        type      : "POST",
        datatype  :"json",
        async     : false,
        data      : {MoS:MoS,NombreMoS:NombreMoS,Accion:Accion, pedido_id:pedido_id, pedi_estado:pedi_estado, pedi_log:pedi_log, obs_log:obs_cancelar_pedido, pedi_estado_obs:pedi_estado_obs},    
        success   : function(data){

        }
      });
      $("#pedi_estado").val(pedi_estado);
      div_show = f_MostrarDiv("form_seleccion_procesar_pedido","btn_seleccion_procesar_pedido",pedi_estado,"");
      $("#div_btn_seleccion_procesar_pedido").html(div_show);
      div_show = f_MostrarDiv("form_procesar_pedido","div_solicitar_cotizacion",pedi_estado,"");
      $("#div_solicitar_cotizacion").html(div_show);
      $("#div_solicitar_cotizacion").show();
      f_tabla_cotizacion();

      $('#modal_crud_cancelar_pedido').modal('hide');
    }
  });
  ///:: FIN EVENTO DEL BOTON ACEPTAR CANCELAR PEDIDO ::::::::::::::::::::::::::::::::::::::///

  ///:: EVENTO DEL BOTON RECHAZAR PEDIDO ::::::::::::::::::::::::::::::::::::::::::::::::::///
  $(document).on("click", ".btn_rechazar_pedido", function(){
    $("#obs_validar").removeClass("color-error");
    obs_validar = $("#obs_validar").val();
    if(obs_validar == ""){
      $("#obs_validar").addClass("color-error");
      Swal.fire({
        position          : 'center',
        icon              : 'error',
        title             : '*Falta Completar Información!!!',
        showConfirmButton : false,
        timer             : 1500
      })
    }else{
      pedi_estado     = "OBSERVADO";
      pedi_estado_obs = "";
      Accion      = 'estado_pedido';
      $.ajax({
        url       : "Ajax.php",
        type      : "POST",
        datatype  : "json",
        async     : false,
        data      : {MoS:MoS,NombreMoS:NombreMoS,Accion:Accion, pedido_id:pedido_id, pedi_estado:pedi_estado, pedi_log:pedi_log, obs_log:obs_validar, pedi_estado_obs:pedi_estado_obs},    
        success: function(data){

        }
      });
      $("#pedi_estado").val(pedi_estado);
      div_show = f_MostrarDiv("form_seleccion_procesar_pedido","btn_seleccion_procesar_pedido",pedi_estado,"");
      $("#div_btn_seleccion_procesar_pedido").html(div_show);
      $('#modal_crud_validar_pedido').modal('hide');
    }
  });
  ///:: FIN EVENTO DEL BOTON RECHAZAR PEDIDO ::::::::::::::::::::::::::::::::::::::::::::::///

  ///::: TERMINO DE BOTONES PEDIDOS :::::::::::::::::::::::::::::::::::::::::::::::::::::::///

});
///:::::::::::::::: FIN JS DOM PROCESAR PEDIDOS :::::::::::::::::::::::::::::::::::::::::::///

///:: INICIO FUNCIONES DE PROCESAR PEDIUDOS :::::::::::::::::::::::::::::::::::::::::::::::///
function f_cargar_pedido(p_pedido_id){
  let data_pedido = [];
  Accion = 'cargar_pedido';
  $.ajax({
    url       : "Ajax.php",
    type      : "POST",
    datatype  : "json",
    async     : false,    
    data      : {MoS:MoS,NombreMoS:NombreMoS,Accion:Accion,pedido_id:p_pedido_id},    
    success   : function(data){
      data_pedido = $.parseJSON(data);
    }
  });
  return data_pedido;
}
///:: SE CARGA LA INFORMACION DE PEDIDOS ::::::::::::::::::::::::::::::::::::::::::::::::::///

///:: FIN SE CARGA LA INFORMACION DE PEDIDOS ::::::::::::::::::::::::::::::::::::::::::::::///

///:: SE INICIALIZAN LAS VARIABLES EN BLANCO DE PEDIDOS Y LOS ERRORES EN CAMPOS :::::::::::///
function f_cargar_variables_vacio_pedido(){
  f_limpia_pedido();
  pedido_id                 = "";
  pedi_fechacreacion        = f_CalculoFecha("hoy","0");
  pedi_fecharequerimiento   = "";
  pedi_prioridad            = "";
  pedi_centrocosto          = "";
  pedi_proceso              = "";
  pedi_nombre_contacto      = "";
  pedi_direccion_entrega    = "";
  pedi_orden_compra_directa = "";
  pedi_tipo                 = "";
  pedi_cotizacion           = "";
  pedi_ordencompra          = "";
  pedi_estado               = "";
  pedi_log                  = "";
  tpedido_id                = "";
  obs_log                   = "";
}
///:: FIN SE INICIALIZAN LAS VARIABLES EN BLANCO DE PEDIDOS Y LOS ERRORES EN CAMPOS :::::::///

///:: SE CARGAN LAS VARIABLES CON LA INFORMACION DE PEDIDOS EN LA BASE DE DATOS :::::::::::///
function f_cargar_variables_pedido(p_data){
  $.each(p_data, function(idx, obj){ 
    pedido_id                 = obj.pedido_id;
    pedi_fechacreacion        = obj.pedi_fechacreacion;
    pedi_fecharequerimiento   = obj.pedi_fecharequerimiento;
    pedi_prioridad            = obj.pedi_prioridad;
    pedi_centrocosto          = obj.pedi_centrocosto;
    pedi_proceso              = obj.pedi_proceso;
    pedi_nombre_contacto      = obj.pedi_nombre_contacto;
    pedi_direccion_entrega    = obj.pedi_direccion_entrega;
    pedi_orden_compra_directa = obj.pedi_orden_compra_directa;  
    pedi_tipo                 = obj.pedi_tipo;
    pedi_cotizacion           = obj.pedi_cotizacion;
    pedi_ordencompra          = obj.pedi_ordencompra;
    pedi_estado               = obj.pedi_estado;
    pedi_log                  = obj.pedi_log;
    tpedido_id                = obj.pedido_id;
    tpedi_estado              = obj.pedi_estado;
    obs_log                   = "";
  });
}
///:: FIN SE CARGAN LAS VARIABLES CON LA INFORMACION DE PEDIDOS EN LA BASE DE DATOS :::::::///

///:: SE CARGAN LAS VARIABLES HTML CON LA INFORMACION DE PEDIDOS ::::::::::::::::::::::::::///
function f_cargar_variables_html_pedido(){
  $('#pedido_id').val(pedido_id);
  $('#tpedido_id').val(tpedido_id);
  $('#pedi_fechacreacion').val(pedi_fechacreacion);
  $('#pedi_fecharequerimiento').val(pedi_fecharequerimiento);
  $('#pedi_prioridad').val(pedi_prioridad);
  $('#pedi_centrocosto').val(pedi_centrocosto);
  $('#pedi_proceso').val(pedi_proceso);
  $('#pedi_nombre_contacto').val(pedi_nombre_contacto);
  $('#pedi_direccion_entrega').val(pedi_direccion_entrega);
  $('#pedi_orden_compra_directa').val(pedi_orden_compra_directa);
  $('#pedi_tipo').val(pedi_tipo);
  $('#pedi_estado').val(pedi_estado);
  $('#obs_log').val(obs_log);
}
///:: FIN SE CARGAN LAS VARIABLES HTML CON LA INFORMACION DE PEDIDOS ::::::::::::::::::::::///

///:: VALIDA LOS CAMPOS DE PEDIDOS ::::::::::::::::::::::::::::::::::::::::::::::::::::::::/// 
function f_validar_pedido(ppedido_id, ppedi_fechacreacion, ppedi_fecharequerimiento, ppedi_prioridad, ppedi_centrocosto, p_pedi_proceso, p_pedi_nombre_contacto, p_pedi_direccion_entrega, p_pedi_orden_compra_directa, ppedi_tipo, pobs_log){
  NoLetrasMayuscEspacio=/[^A-Z \Ñ]/;
  let rpta_validar_pedido="";
  f_limpia_pedido();

  if(ppedi_fecharequerimiento==""){
    $("#pedi_fecharequerimiento").addClass("color-error");
    rpta_validar_pedido="invalido";
  }else{
    if(ppedi_fecharequerimiento < ppedi_fechacreacion){
      $("#pedi_fecharequerimiento").addClass("color-error");
      rpta_validar_pedido="invalido";
    }
  }
  
  if(ppedi_prioridad==""){
    $("#pedi_prioridad").addClass("color-error");
    rpta_validar_pedido="invalido";
  }

  if(ppedi_centrocosto==""){
    $("#pedi_centrocosto").addClass("color-error");
    rpta_validar_pedido="invalido";
  }

  if(p_pedi_proceso==""){
    $("#pedi_proceso").addClass("color-error");
    rpta_validar_pedido="invalido";
  }

  if(p_pedi_nombre_contacto==""){
    $("#pedi_nombre_contacto").addClass("color-error");
    rpta_validar_pedido="invalido";
  }

  if(p_pedi_direccion_entrega==""){
    $("#pedi_direccion_entrega").addClass("color-error");
    rpta_validar_pedido="invalido";
  }

  if(p_pedi_orden_compra_directa==""){
    $("#pedi_orden_compra_directa").addClass("color-error");
    rpta_validar_pedido="invalido";
  }

  if(ppedi_tipo==""){
    $("#pedi_tipo").addClass("color-error");
    rpta_validar_pedido="invalido";
  }
/*
  if(pobs_log==""){
    $("#obs_log").addClass("color-error");
    rpta_validar_pedido="invalido";
  }
*/
  return rpta_validar_pedido;
}
///:: FIN VALIDA LOS CAMPOS DE PEDIDOS ::::::::::::::::::::::::::::::::::::::::::::::::::::/// 

///:: VALIDA EL TIPO DE PEDIDO ::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::/// 
function f_validar_tipo(p_pedi_tipo, p_array_material_pedido){
  let rpta_validar_tipo = "";
  let a_data            = [];
  $.each(p_array_material_pedido, function(idx, obj){
    a_data = f_BuscarDataBD('manto_materiales','material_id',obj.mp_materialid)
    $.each(a_data, function(idx, obj){
      if(obj.material_tipo!=p_pedi_tipo){
        rpta_validar_tipo = "invalido";
      }
    });
  });
  return rpta_validar_tipo;
}
///:: FIN VALIDA EL TIPO DE PEDIDO ::::::::::::::::::::::::::::::::::::::::::::::::::::::::/// 
///:: REMUEVE LA CLASE ERROR DEL FORMULARIO NUEVO PEDIDO ::::::::::::::::::::::::::::::::::/// 
function f_limpia_pedido(){
  $("#pedi_fecharequerimiento").removeClass("color-error");
  $("#pedi_prioridad").removeClass("color-error");
  $("#pedi_centrocosto").removeClass("color-error");
  $("#pedi_proceso").removeClass("color-error");
  $("#pedi_nombre_contacto").removeClass("color-error");
  $("#pedi_direccion_entrega").removeClass("color-error");
  $("#pedi_orden_compra_directa").removeClass("color-error");
  $("#pedi_tipo").removeClass("color-error");
}
///:: FIN REMUEVE LA CLASE ERROR DEL FORMULARIO NUEVO PEDIDO :::::::::::::::::::::::::::::::///

///:: FUNCION CARGA DE COMBOS PROCESAR PEDIDOS :::::::::::::::::::::::::::::::::::::::::::::///
function f_combos_pedido(){
  ///::: CARGAMOS LOS PROVEEDORES :::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
  Accion = "select_proveedor";
  $.ajax({
    url       : "Ajax.php",
    type      : "POST",
    datatype  :"json",
    async     : false,
    data      : {MoS:MoS,NombreMoS:NombreMoS,Accion:Accion},    
    success   : function(data){
      $("#coti_razonsocial").html(data);
    }
  });

  ///:: SE CARGAN LOS COMBOS DE TABLA TIPO PEDIDOS ::::::::::::::::::::::::::::::::::::::::///
  Operacion='PEDIDOS';
  Tipo='PRIORIDAD';
  selectHtmlPedidos = "";
  selectHtmlPedidos = f_TipoTabla(Operacion,Tipo);
  $("#pedi_prioridad").html(selectHtmlPedidos);
  
  Tipo='ESTADO';
  selectHtmlPedidos = "";
  selectHtmlPedidos = f_TipoTabla(Operacion,Tipo);
  $("#pedi_estado").html(selectHtmlPedidos);
  
  Tipo='CENTRO DE COSTO';
  selectHtmlPedidos="";
  selectHtmlPedidos = f_TipoTabla(Operacion,Tipo);
  $("#pedi_centrocosto").html(selectHtmlPedidos);

  Tipo='PROCESO SOLICITANTE';
  selectHtmlPedidos="";
  selectHtmlPedidos = f_TipoTabla(Operacion,Tipo);
  $("#pedi_proceso").html(selectHtmlPedidos);

  let perfil = 'CONTACTO ORDEN DE COMPRA';
  selectHtmlPedidos="";
  selectHtmlPedidos = f_select_roles(perfil);
  $("#pedi_nombre_contacto").html(selectHtmlPedidos);

  Tipo='ORDEN DE COMPRA DIRECTA';
  selectHtmlPedidos="";
  selectHtmlPedidos = f_TipoTabla(Operacion,Tipo);
  $("#pedi_orden_compra_directa").html(selectHtmlPedidos);

  Tipo='TIPO';
  selectHtmlPedidos="";
  selectHtmlPedidos = f_TipoTabla(Operacion,Tipo);
  $("#pedi_tipo").html(selectHtmlPedidos);


}
///:: FIN FUNCION CARGA DE COMBOS PROCESAR PEDIDOS :::::::::::::::::::::::::::::::::::::::::///

///:: TERMINO FUNCIONES DE PROCESAR PEDIDOS ::::::::::::::::::::::::::::::::::::::::::::::::///