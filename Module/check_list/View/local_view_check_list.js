///::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
///:: REGISTRO CHECK LIST FLOTA v 1.0 :::::::::::::::::::::::::::::::::::::::::::::::::::::///
///:: CREAR Y EDITAR DETALLE DE CHECK LIST ::::::::::::::::::::::::::::::::::::::::::::::::///
///::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///

///:: DECLARACIONES DE VARIABLES GLOBALES :::::::::::::::::::::::::::::::::::::::::::::::::///
var t_check_list, chl_fecha, chl_bus, chl_kilometraje, chl_nombre_piloto, chl_estado, chl_log;
var opcion_check_list;

///:: JS DOM REGISTRO CHECK LIST FLOTA ::::::::::::::::::::::::::::::::::::::::::::::::::::///
$(document).ready(function(){
  let select_check_list = '';
  let array_data_check_list = [];
  div_show = f_MostrarDiv("form_seleccion_check_list_registro","btn_seleccion_check_list_registro","");
  $("#div_btn_seleccion_check_list_registro").html(div_show);
  $("#nav-tab-detalle_check_list").hide();
  $("#nav-tabContent-detalle_check_list").hide();

  $("#check_list_id").on('change', function () {
    div_show = f_MostrarDiv("form_seleccion_check_list_registro","btn_seleccion_check_list_registro","");
    $("#div_btn_seleccion_check_list_registro").html(div_show);
    $("#div_check_list_registro").empty();
    $("#div_btn_guardar_check_list_registro").empty();
    $("#nav-tab-detalle_check_list").hide();
    $("#nav-tabContent-detalle_check_list").hide();
  });

  $(document).on('change', '.chl_bus, .chl_fecha', function() {
    chl_bus = $("#chl_bus").val();
    chl_fecha = $("#chl_fecha").val();
    obs_chl_bus_tipo = f_buscar_dato("Buses", "Bus_Tipo2", "`Bus_NroExterno`='"+chl_bus+"'");
    fav_chl_bus_tipo = f_buscar_dato("Buses", "Bus_Tipo2", "`Bus_NroExterno`='"+chl_bus+"'");
    f_tabla_check_list_observaciones(check_list_id, chl_estado);
    f_tabla_check_list_falla_via(check_list_id, chl_estado);
  });

  ///:: INICIO BOTONES DE CHECK LIST REGISTRO :::::::::::::::::::::::::::::::::::::::::::::///
  
  ///:: EVENTO BOTON BUSCAR REGISTRO DE CHECK LIST DE FLOTA :::::::::::::::::::::::::::::::///
  $(document).on("click", ".btn_cargar_check_list_registro", function(){
    opcion_check_list = "";
    check_list_id = $("#check_list_id").val();
    $("#nav-tab-detalle_check_list").hide();
    $("#nav-tabContent-detalle_check_list").hide();
    if(check_list_id!==""){
      if( check_list_id==f_buscar_dato("manto_check_list_registro","check_list_id","`check_list_id`='"+check_list_id+"'") ){
        array_data_check_list = f_BuscarDataBD("manto_check_list_registro","check_list_id",check_list_id);
        array_data_check_list.forEach(obj => {
          t_check_list_id = obj.check_list_id;
          chl_fecha = obj.chl_fecha;
          chl_bus = obj.chl_bus;
          chl_kilometraje = obj.chl_kilometraje;
          chl_nombre_piloto = obj.chl_nombre_piloto;
          chl_estado = obj.chl_estado;
          chl_log = obj.chl_log;
        });
        obs_chl_bus_tipo = f_buscar_dato("Buses", "Bus_Tipo2", "`Bus_NroExterno`='"+chl_bus+"'");
        fav_chl_bus_tipo = f_buscar_dato("Buses", "Bus_Tipo2", "`Bus_NroExterno`='"+chl_bus+"'");
        opcion_check_list = "EDITAR";
        div_show = f_MostrarDiv("form_check_list_registro","div_check_list_registro","");
        $("#div_check_list_registro").html(div_show);
        div_show = f_MostrarDiv("form_check_list_registro","btn_guardar_check_list_registro",chl_estado);
        $("#div_btn_guardar_check_list_registro").html(div_show);
        f_cargar_datos_check_list();
      }else{
        Swal.fire({
          title: '¿Está seguro de crear?',
          html: "Se creará el Check List N° : "+check_list_id+" !!!",
          icon: 'warning',
          showCancelButton: true,
          cancelButtonColor: '#d33',
          cancelButtonText: 'Cancelar',
          confirmButtonColor: '#3085d6',
          confirmButtonText: 'Si, crear!',
          focusConfirm: true
        }).then((result) => 
        {
          if(result.isConfirmed){
            opcion_check_list = "CREAR";
            div_show = f_MostrarDiv("form_check_list_registro","div_check_list_registro","");
            $("#div_check_list_registro").html(div_show);
            div_show = f_MostrarDiv("form_check_list_registro","btn_guardar_check_list_registro","");
            $("#div_btn_guardar_check_list_registro").html(div_show);
            t_check_list_id = check_list_id;
            chl_fecha = f_CalculoFecha("hoy","-1 days");
            chl_bus = "";
            chl_kilometraje = "";
            chl_nombre_piloto = "";
            chl_estado = "ABIERTO";
            obs_chl_bus_tipo = "";
            f_cargar_datos_check_list();
          }
        });
      }
    }else{
      Swal.fire({
        position            : 'center',
        icon                : 'error',
        title               : "Ingresar Nro. Check List !",
        showConfirmButton   : false,
        timer               : 1500
      })
    }
  });
  ///:: FIN EVENTO BOTON BUSCAR REGISTRO DE CHECK LIST DE FLOTA :::::::::::::::::::::::::::///

  ///:: EVENTO BOTON GUARDAR REGISTRO DE CHECK LIST DE FLOTA ::::::::::::::::::::::::::::::///
  $(document).on("click", ".btn_guardar_check_list_registro", function(){
    let a_data_observaciones = [];
    let a_data_falla_via = [];
    let validar_check_list_registro = "";
    t_check_list_id = $("#t_check_list_id").val();
    chl_fecha = $("#chl_fecha").val();
    chl_bus = $("#chl_bus").val();
    chl_kilometraje = $("#chl_kilometraje").val();
    chl_nombre_piloto = $("#chl_nombre_piloto").val();
    chl_estado = $("#chl_estado").val();
    let array_observaciones = tabla_check_list_observaciones.rows().data().toArray();
    let array_falla_via = tabla_check_list_falla_via.rows().data().toArray();

    validar_check_list_registro = f_valida_agregar_check_list(t_check_list_id, chl_fecha, chl_bus, chl_kilometraje, chl_nombre_piloto, chl_estado);
   
    if(validar_check_list_registro=="invalido"){
      Swal.fire({
        icon  : 'error',
        title : 'CHECK LIST...',
        text  : 'Falta completar información !!!'
      })

    }else{
      $("#btn_guardar_check_list_registro").prop("disabled",true); 
      a_data_observaciones = JSON.stringify(array_observaciones);
      a_data_falla_via = JSON.stringify(array_falla_via);
      if(opcion_check_list=="CREAR"){
        Accion = "crear_check_list_registro";
      }
      if(opcion_check_list=="EDITAR"){
        Accion = "editar_check_list_registro";
      }
      $.ajax({
        url       : "Ajax.php",
        type      : "POST",
        datatype  : "json",
        async     : false,
        data      :  { MoS:MoS, NombreMoS:NombreMoS, Accion:Accion, check_list_id:t_check_list_id, chl_fecha:chl_fecha, chl_bus:chl_bus, chl_kilometraje:chl_kilometraje, chl_nombre_piloto:chl_nombre_piloto, chl_estado:chl_estado, a_data_observaciones:a_data_observaciones, a_data_falla_via:a_data_falla_via },
        success   : function(data) {
          Swal.fire(
            'Guardado!',
            'El registro ha sido guardado.',
            'success'
          )            
        }
      });
      div_show = f_MostrarDiv("form_seleccion_check_list_registro","btn_seleccion_check_list_registro","");
      $("#div_btn_seleccion_check_list_registro").html(div_show);
      $("#div_check_list_registro").empty();
      $("#div_btn_guardar_check_list_registro").empty();
      $("#nav-tab-detalle_check_list").hide();
      $("#nav-tabContent-detalle_check_list").hide();
      $("#check_list_id").focus().select();
      $("#btn_guardar_check_list_registro").prop("disabled",false);
      //tabla_check_list.ajax.reload(toggleZoomScreen(), false);
    }
  });
  ///:: FIN EVENTO BOTON BUSCAR REGISTRO DE CHECK LIST DE FLOTA :::::::::::::::::::::::::::///

  ///:: EVENTO BOTON CANCELAR REGISTRO DE CHECK LIST DE FLOTA :::::::::::::::::::::::::::::///
  $(document).on("click", ".btn_cancelar_check_list_registro", function(){
    div_show = f_MostrarDiv("form_seleccion_check_list_registro","btn_seleccion_check_list_registro","");
    $("#div_btn_seleccion_check_list_registro").html(div_show);
    $("#div_check_list_registro").empty();
    $("#div_btn_guardar_check_list_registro").empty();
    $("#nav-tab-detalle_check_list").hide();
    $("#nav-tabContent-detalle_check_list").hide();
    $("#check_list_id").focus().select();
  });
  ///:: FIN EVENTO BOTON CANCELAR REGISTRO DE CHECK LIST DE FLOTA :::::::::::::::::::::::::///

  ///:: EVENTO BOTON LOG REGISTRO DE CHECK LIST DE FLOTA ::::::::::::::::::::::::::::::::::///
  $(document).on("click", ".btn_log_check_list_registro", function(){
    $("#form_modal_log_check_list").trigger("reset");
    check_list_id = $("#t_check_list_id").val();
    chl_log = f_buscar_dato("manto_check_list_registro","chl_log","`check_list_id` = '"+check_list_id+"'");
    $("#div_log_check_list").html(chl_log);
    $(".modal-header").css( "background-color", "#17a2b8");
    $(".modal-header").css( "color", "white" );
    $(".modal-title").text("Log");
    $('#modal_crud_log_check_list').modal('show');
  });
  ///:: FIN EVENTO BOTON LOG REGISTRO DE CHECK LIST DE FLOTA ::::::::::::::::::::::::::::::///

  ///:: EVENTO BOTON VER REGISTRO DE CHECK LIST DE FLOTA ::::::::::::::::::::::::::::::::::///
  $(document).on("click", ".btn_ver_check_list_registro", function(){
  });
  ///:: FIN EVENTO BOTON VER REGISTRO DE CHECK LIST DE FLOTA ::::::::::::::::::::::::::::::///

  ///:: EVENTO BOTON CERRAR REGISTRO CHECK LIST DE FLOTA ::::::::::::::::::::::::::::::::::///
  $(document).on("click", ".btn_cerrar_check_list_registro", function(){
    check_list_id = $("#t_check_list_id").val();
    Swal.fire({
      title               : '¿Está seguro?',
      text                : "Se cerrará el Check List Nor. "+check_list_id+" !",
      icon                : 'warning',
      showCancelButton    : true,
      confirmButtonColor  : '#3085d6',
      cancelButtonColor   : '#d33',
      confirmButtonText   : 'Si, cerrar!'
    }).then((result) => {
      if (result.isConfirmed) {
        Accion = 'cerrar_check_list_registro';
        $.ajax({
            url         : "Ajax.php",
            type        : "POST",
            datatype    : "json",    
            data        : { MoS:MoS, NombreMoS:NombreMoS, Accion:Accion, check_list_id:check_list_id },   
            success: function() {
              chl_estado = "CERRADO";
              $("#chl_estado").val(chl_estado);
              div_show = f_MostrarDiv("form_check_list_registro","btn_guardar_check_list_registro",chl_estado);
              $("#div_btn_guardar_check_list_registro").html(div_show);
              f_tabla_check_list_observaciones(check_list_id, chl_estado);
              f_tabla_check_list_falla_via(check_list_id, chl_estado);          
              //tabla_check_list.ajax.reload(toggleZoomScreen(), false);   
              Swal.fire(
                  'Cerrado!',
                  'El registro ha sido cerrado.',
                  'success'
              )            
            }
        });
      }
    });
  });
  ///:: FIN EVENTO BOTON CERRAR REGISTRO DE CHECK LIST DE FLOTA :::::::::::::::::::::::::::///

  ///:: EVENTO BOTON ANULAR REGISTRO DE CHECK LIST DE FLOTA :::::::::::::::::::::::::::::::///
  $(document).on("click", ".btn_anular_check_list_registro", function(){
    check_list_id = $("#t_check_list_id").val();
    Swal.fire({
      title               : '¿Está seguro?',
      text                : "Se anulará el Check List Nro. "+check_list_id+" !",
      icon                : 'warning',
      showCancelButton    : true,
      confirmButtonColor  : '#3085d6',
      cancelButtonColor   : '#d33',
      confirmButtonText   : 'Si, anular!'
    }).then((result) => {
      if (result.isConfirmed) {
        Accion = 'anular_check_list_registro';
        $.ajax({
            url         : "Ajax.php",
            type        : "POST",
            datatype    : "json",    
            data        : { MoS:MoS, NombreMoS:NombreMoS, Accion:Accion, check_list_id:check_list_id },   
            success: function() {
              chl_estado = "ANULADO";
              $("#chl_estado").val(chl_estado);
              div_show = f_MostrarDiv("form_check_list_registro","btn_guardar_check_list_registro",chl_estado);
              $("#div_btn_guardar_check_list_registro").html(div_show);
              f_tabla_check_list_observaciones(check_list_id, chl_estado);
              f_tabla_check_list_falla_via(check_list_id, chl_estado);                
              //tabla_check_list.ajax.reload(toggleZoomScreen(), false);
              Swal.fire(
                  'Anulado!',
                  'El registro ha sido anulado.',
                  'success'
              )            
            }
        });
      }
    });
  });
  ///:: FIN EVENTO BOTON ANULAR REGISTRO DE CHECK LIST DE FLOTA :::::::::::::::::::::::::::///

  ///:: TERMINO BOTONES DE CHECK LIST REGISTRO ::::::::::::::::::::::::::::::::::::::::::::///
});
///:: FUNCIONES REGISTRO DE CHECK LIST DE FLOTA :::::::::::::::::::::::::::::::::::::::::::///

///:: FUNCION PARA VALIDAR LOS DATOS INGRESADOS AL FORMULARIO :::::::::::::::::::::::::::::///
function f_valida_agregar_check_list(p_t_check_list_id, p_chl_fecha, p_chl_bus, p_chl_kilometraje, p_chl_nombre_piloto, p_chl_estado){
  f_limpia_check_list_registro();
  let rpta_valida_agregar_check_list = "";
  
  if(p_t_check_list_id==""){
    $("#t_check_list_id").addClass("color-error");
    rpta_valida_agregar_check_list = "invalido";
  }
  if(p_chl_fecha==""){
    $("#chl_fecha").addClass("color-error");
    rpta_valida_agregar_check_list = "invalido";
  }
  if(p_chl_bus==""){
    $("#chl_bus").addClass("color-error");
    rpta_valida_agregar_check_list = "invalido";
  }
  if(p_chl_kilometraje==""){
    $("#chl_kilometraje").addClass("color-error");
    rpta_valida_agregar_check_list = "invalido";
  }
  if(p_chl_nombre_piloto==""){
    $("#chl_nombre_piloto").addClass("color-error");
    rpta_valida_agregar_check_list = "invalido";
  }
  if(p_chl_estado==""){
    $("#chl_estado").addClass("color-error");
    rpta_valida_agregar_check_list = "invalido";
  }

  return rpta_valida_agregar_check_list;
}
///:: FUNCION PARA VALIDAR LOS DATOS INGRESADOS AL FORMULARIO :::::::::::::::::::::::::::::///

///:: REESTABLECE EL COLOR DE LOS CAMPOS INVALIDOS ::::::::::::::::::::::::::::::::::::::::/// 
function f_limpia_check_list_registro(){
  $("#t_check_list_id").removeClass("color-error");
  $("#chl_fecha").removeClass("color-error");
  $("#chl_bus").removeClass("color-error");
  $("#chl_kilometraje").removeClass("color-error");
  $("#chl_nombre_piloto").removeClass("color-error");
  $("#chl_estado").removeClass("color-error");
}
///:: FIN REESTABLECE EL COLOR DE LOS CAMPOS INVALIDOS ::::::::::::::::::::::::::::::::::::///

function f_cargar_datos_check_list(){
  $("#div_btn_seleccion_check_list_registro").empty();  
  select_check_list = f_select_combo("Buses","NO","Bus_NroExterno","","`Bus_NroExterno`!=''");
  $("#chl_bus").html(select_check_list);
  select_check_list = f_select_combo("glo_roles","NO","roles_apellidosnombres",chl_nombre_piloto,"`roles_perfil`='PILOTO'");
  $("#chl_nombre_piloto").html(select_check_list);

  $("#t_check_list_id").val(t_check_list_id);
  $("#chl_fecha").val(chl_fecha);
  $("#chl_bus").val(chl_bus);
  $("#chl_kilometraje").val(chl_kilometraje);
  $("#chl_nombre_piloto").val(chl_nombre_piloto);
  $("#chl_estado").val(chl_estado);
  $("#nav-tab-detalle_check_list").show();
  $("#nav-tabContent-detalle_check_list").show();
  $("#chl_fecha").focus().select();

  div_show = f_MostrarDiv("form_registro_observaciones","btn_nuevo_registro_observaciones",chl_estado);
  $("#div_btn_nuevo_registro_observaciones").html(div_show);      
  f_tabla_check_list_observaciones(check_list_id, chl_estado);

  f_tabla_check_list_falla_via(check_list_id, chl_estado);

}

///:: TERMINO FUNCIONES REGISTRO DE CHECK LIST DE FLOTA :::::::::::::::::::::::::::::::::::///