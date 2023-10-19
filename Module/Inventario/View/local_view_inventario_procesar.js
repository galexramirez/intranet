///:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
///:::::::::::::::: PROCESAR INVENTARIO v 1.0 FECHA: 22-11-2022 ::::::::::::::::::::::::///
//:::::::::::::::::::::::: EDITAR TABLA DE INVENTARIOS :::::::::::::::::::::::::::::::::///
///:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///

///:::::::::::::::::::::::: INICIO Declaracion de Variables ::::::::::::::::::::::::::::///
var inventario_id, inv_log;
var select_html;
miCarpeta = f_DocumentRoot();

///:::::::::::::::::::::::::: FIN Declaracion de Variables :::::::::::::::::::::::::::::///

///::::::::::::::::::::::::: INICIO JS DOM PROCESAR PEDIDOS ::::::::::::::::::::::::::::///

$(document).ready(function(){

  ///::: Se cargan los botones de seleccion de procesar pedidos ::::::::::::::::::::::::///
  div_show = f_MostrarDiv("form_seleccion_procesar_inventario","btn_seleccion_procesar_inventario","inicio","");
  $("#div_btn_seleccion_procesar_inventario").html(div_show);
  
  ///::: Si hay cambios en el codigo de PEDIDO se oculta el formulario :::::::::::::::::///
  $("#inventario_id").on('change', function () {
    inventario_id = $("#inventario_id").val();
    div_show = f_MostrarDiv("form_seleccion_procesar_inventario","btn_seleccion_procesar_inventario","inicio","");
    $("#div_btn_seleccion_procesar_inventario").html(div_show);
    div_show = f_DivFormulario("form_procesar_inventario","vacio");
    $("#div_form_procesar_inventario").html(div_show);  
  });

  ///::: Si hay cambios en el movimiento de inventario :::::::::::::::::::::::::::::::::///
  $(document).on("change", ".inv_movimiento", function(){
    inv_movimiento = $("#inv_movimiento").val();
    select_html = f_TipoTabla("INVENTARIO",inv_movimiento);
    $("#inv_tipo_movimiento").html(select_html);    
  });

  ///:::::::::::::::::::: INICIO BOTONES DE PROCESAR INVENTARIO ::::::::::::::::::::::::///

  ///::::::::::::::::::::::::::: BOTON CARGAR INVENTARIO :::::::::::::::::::::::::::::::///
  $(document).on("click", ".btn_cargar_inventario", function(){
    inventario_id = $("#inventario_id").val();
    if(inventario_id==""){
      Swal.fire({
        position: 'center',
        icon: 'error',
        title: '*Falta Completar Información!!!',
        showConfirmButton: false,
        timer: 1500
      })
      $("#inventario_id").focus();
    }else{
      div_show = f_MostrarDiv("form_seleccion_procesar_inventario","btn_seleccion_procesar_inventario","cargar","")
      $("#div_btn_seleccion_procesar_inventario").html(div_show);
      div_show = f_DivFormulario("form_procesar_inventario","ver");
      $("#div_form_procesar_inventario").html(div_show);
    }
  });
  ///:::::::::::::::::::::::: FIN BOTON CARGAR INVENTARIO ::::::::::::::::::::::::::::::///

  ///::::::::::::::::::::::::::: BOTON EDITAR INVENTARIO :::::::::::::::::::::::::::::::///
  $(document).on("click", ".btn_editar_inventario", function(){
    div_show = f_MostrarDiv("form_seleccion_procesar_inventario","btn_seleccion_procesar_inventario","nuevo","")
    $("#div_btn_seleccion_procesar_inventario").html(div_show);
    div_show = f_DivFormulario("form_procesar_inventario","editar");
    $("#div_form_procesar_inventario").html(div_show);
    f_combos_inventario();

  });
  ///:::::::::::::::::::::::: FIN BOTON EDITAR INVENTARIO ::::::::::::::::::::::::::::::///

  ///:::::::::::::::::::::::::::: BOTON NUEVO INVENTARIO :::::::::::::::::::::::::::::::///
  $(document).on("click", ".btn_nuevo_inventario", function(){
    $("#inventario_id").prop("disabled",true);
    div_show = f_MostrarDiv("form_seleccion_procesar_inventario","btn_seleccion_procesar_inventario","nuevo","")
    $("#div_btn_seleccion_procesar_inventario").html(div_show);
    div_show = f_DivFormulario("form_procesar_inventario","editar");
    $("#div_form_procesar_inventario").html(div_show);
    inv_fecha_creacion = f_CalculoFecha("hoy","0");
    inv_nombre_responsable = f_nombre_responsable();
    $('#inv_fecha_creacion').val(inv_fecha_creacion);
    $("#inv_nombre_responsable").val(inv_nombre_responsable);
    f_combos_inventario();
  
  });
  ///:::::::::::::::::::::::: FIN BOTON NUEVO INVENTARIO :::::::::::::::::::::::::::::::///

  ///:::::::::::::::::::::: BOTON CANCELAR PROCESAR INVENTARIO :::::::::::::::::::::::::///
  $(document).on("click", ".btn_cancelar_procesar_inventario", function(){
    $("#inventario_id").prop("disabled",false);
    $("#inventario_id").focus();
    div_show = f_MostrarDiv("form_seleccion_procesar_inventario","btn_seleccion_procesar_inventario","inicio","");
    $("#div_btn_seleccion_procesar_inventario").html(div_show);
    div_show = f_DivFormulario("form_procesar_inventario","vacio");
    $("#div_form_procesar_inventario").html(div_show);  
  });
  ///::::::::::::::::::::::::::TERMINO BOTON CANCELAR Pedidos ::::::::::::::::::::::::::///

  ///::::::::::::::::::: EVENTO DEL BOTON VER LOG PEDIDO :::::::::::::::::::::::::::::::///
  $(document).on("click", ".btn_log_inventario", function(){
    $("#form_modal_log_inventario").trigger("reset");
    $(".modal-header").css( "background-color", "#17a2b8");
    $(".modal-header").css( "color", "white" );
    $(".modal-title").text("Log Inventario");
    $('#modal_crud_log_inventario').modal('show');
    $("#modal_crud_log_inventario").draggable({});
    $("#div_log_inventario").html(inv_log);
  });
  ///:::::::::::::::::::::: TERMINO BOTON VER LOG PEDIDO :::::::;;;;;;;:::::::::::::::::///

  ///::::::::::::::::::::::::::::: FIN DE BOTONES INVENTARIO :::::::::::::::::::::::::::///

});

///:::::::::::::::: FIN JS DOM PROCESAR PEDIDOS ::::::::::::::::::::::::::::::::::::::::///


///::::::::::::::::::::::: INICIO FUNCIONES DE PROCESAR INVENTARIO :::::::::::::::::::::///

///:::::::::::::::::: CARGA LOS COMBOS DE INVENTARIO :::::::::::::::::::::::::::::::::::///
function f_combos_inventario(){
  let rpta_select;
  select_html = f_TipoTabla("INVENTARIO","MOVIMIENTO");
  $("#inv_movimiento").html(select_html);
  
  Accion='select_almacen';
  $.ajax({
    url: "Ajax.php",
    type: "POST",
    datatype:"json",
    async: false,
    data: {MoS:MoS,NombreMoS:NombreMoS,Accion:Accion},    
    success: function(data){
      rpta_select = data;
    }
  });
  $("#inv_alm_descripcion").html(rpta_select);

}
///:::::::::::::::::: FIN CARGA LOS COMBOS DE ALMACEN ::::::::::::::::::::::::::::::::::///

///::::::::::::::::::::::: TERMINO FUNCIONES DE PROCESAR INVENTARIO ::::::::::::::::::::///