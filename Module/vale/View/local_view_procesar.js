///::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
///:: PROCESAR VALE v 3.0 FECHA: 2024-01-02 :::::::::::::::::::::::::::::::::::::::::::::::///
//::: EDITAR TABLA DE VALE + REPUESTOS ::::::::::::::::::::::::::::::::::::::::::::::::::::///
///::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///

///:: DECLARACION DE VARIABLES ::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
var vale_id, va_ot_id, va_genera, va_date_genera, va_asociado, va_responsable, va_obs_cgm, va_cierre_adm, va_date_cierre_adm, va_obs_aom, va_estado, va_garantia, va_bus, tva_estado, va_descrip, tva_obs_aom, opcion_vale, va_tipo, va_ruc;
var vale_ot_estado;
///:: TERMINO DECLARACION DE VARIABLES ::::::::::::::::::::::::::::::::::::::::::::::::::::///

///:: JS DOM VALE PROCESAR ::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
$(document).ready(function(){
  div_show = f_MostrarDiv("form_seleccion_procesar_vale","btn_seleccion_procesar_vale", "","");
  $("#div_btn_seleccion_procesar_vale").html(div_show);
  $("#form_procesar_vale").hide();

  ///:: SI HAY CAMBIOS EN EL CODIGO DE VALES SE OCULTA EL FORM ::::::::::::::::::::::::::::///
  $("#vale_id").on('change', function () {
    vale_id = $("#vale_id").val();
    $("#form_procesar_vale").hide();
    div_show = f_MostrarDiv("form_seleccion_procesar_vale","btn_seleccion_procesar_vale", "","");
    $("#div_btn_seleccion_procesar_vale").html(div_show);

  });

  /// SI HAY CAMBIOS EN ASOCIADOS SE ACTUALIZA RESPONSABLE ::::::::::::::::::::::::::::::::///
  $("#va_asociado").on('change', function () {
    t_html      = "";
    va_asociado = $("#va_asociado").val();
    a_data      = f_BuscarDataBD("manto_proveedores","prov_razonsocial",va_asociado);
    $.each(a_data, function(idx, obj){
      va_ruc    = obj.prov_ruc;
    });
    t_html      = f_select_combo("manto_tecnico_asociado","NO","ta_nombre_corto","","`ta_ruc` = '"+va_ruc+"'");
    $("#va_responsable").html(t_html);
  });

  ///:: SI HAY CAMBIOS EN N° OT SE ACTUALIZA BUS Y DESCRIPCION ::::::::::::::::::::::::::::///
  $("#va_ot_id").on('change', function () {
    va_ot_id          = $("#va_ot_id").val();
    va_bus         = "";
    va_descrip     = "";
    vale_ot_estado = "REGISTRADO";

    a_data = f_BuscarDataBD("manto_ots", "ot_id", va_ot_id);
    $.each(a_data, function(idx, obj){
      va_ot_id    = obj.ot_id; 
      va_bus      = obj.ot_bus;
      va_descrip  = obj.ot_origen + " - " + obj.ot_actividad;
    });
    if(a_data.length == 0){
      va_ot_id        = $("#va_ot_id").val();
      vale_ot_estado  = "NO REGISTRADO";
      Swal.fire({
        position          : 'center',
        icon              : 'warning',
        title             : 'N° OT no registrado !!!',
        showConfirmButton : false,
        timer             : 1500
      })
    }

    $("#va_ot_id").val(va_ot_id);
    $("#va_bus").val(va_bus);
    $("#va_descrip").val(va_descrip);
  });

  ///:: INICIO DE BOTONES PROCESAR VALES ::::::::::::::::::::::::::::::::::::::::::::::::::///

  ///:: BOTON CARGAR PROCESAR VALES :::::::::::::::::::::::::::::::::::::::::::::::::::::::///
  $(document).on("click", ".btn_cargar_vale", function(){
    let vale_existe = "";
    t_html = "";
    f_cargar_variables_vacio_vale();
    f_carga_variables_html_vale();
    vale_id     = $("#vale_id").val();
    opcion_vale = "";

    if(vale_id==""){
      Swal.fire({
        position: 'center',
        icon: 'success',
        title: 'Se creara un nuevo VALE !!!',
        showConfirmButton: false,
        timer: 1500
      })
      $("#form_procesar_vale").show();
      $("#va_ot_id").focus().select();
      f_carga_variables_html_vale();
      f_combos_procesar_vales();
      opcion_vale = "CREAR";
      div_show = f_MostrarDiv("form_seleccionar_procesar_vale","btn_seleccion_procesar_vale", "vacio","");
      $("#div_btn_seleccion_procesar_vale").html(div_show);
      btn_borrar_repuesto = "SI";
      f_tabla_repuestos(vale_id,btn_borrar_repuesto);
      div_show = f_MostrarDiv("form_procesar_vale","btn_guardar_vale", "", "");
      $("#div_btn_guardar_vale").html(div_show);
    }else{
      vale_existe = f_buscar_dato("manto_vale", "vale_id", "`vale_id`='"+vale_id+"'");
      Accion = 'cargar_vale';
      $.ajax({
        url       : "Ajax.php",
        type      : "POST",
        datatype  : "json",
        async     : false,    
        data      : { MoS:MoS, NombreMoS:NombreMoS, Accion:Accion, vale_id:vale_id },
        success   : function(data){
          data = $.parseJSON(data);
          f_cargar_variables_vale(data);
          f_combos_procesar_vales();
          if(vale_existe==vale_id){
            opcion_vale  = "EDITAR"; 
            ///:: SE CARGA EL COMBO CON TODOS LOS RESPONSABLES DEL ASOCIADO :::::::::::::::///
            a_data      = f_BuscarDataBD("manto_proveedores","prov_razonsocial",va_asociado);
            $.each(a_data, function(idx, obj){
              va_ruc    = obj.prov_ruc;
            });        
            t_html      = f_select_combo("manto_resp_asociado","NO","ra_nombres",va_responsable,"`ra_ruc_asociado` = '"+va_ruc+"'");
            $("#va_responsable").html(t_html);
            ///:: SE PRECARGA EL PRIMER RESPONSABLE DEL ASOCIADO ::::::::::::::::::::::::::///
            if((va_responsable==null || va_responsable=="") && va_asociado!=""){
              a_data = f_BuscarDataBD("manto_resp_asociado","ra_asociado",va_asociado);
              $.each(a_data, function(idx, obj){ 
                  va_responsable = obj.ra_nombres;
              });
              $("#va_responsable").val(va_responsable);
            }
            $("#form_procesar_vale").show();
            $("#va_ot_id").focus().select();
            f_carga_variables_html_vale();
            
            div_show      = f_MostrarDiv("form_seleccionar_procesar_vale","btn_seleccion_procesar_vale", "vacio","");
            $("#div_btn_seleccion_procesar_vale").html(div_show);
            btn_borrar_repuesto = "SI";
            f_tabla_repuestos(vale_id,btn_borrar_repuesto);
            div_show = f_MostrarDiv("form_procesar_vale","btn_guardar_vale", "","");
            $("#div_btn_guardar_vale").html(div_show);
        
          }else{
            Swal.fire({
              position: 'center',
              icon: 'warning',
              title: "No existe N° VALE : "+vale_id+" !!!",
              showConfirmButton: false,
              timer: 1500
            })
            opcion_vale = "";
            $("#form_procesar_vale").show();
            $("#vale_id").focus();

          }
        }
      });
    }
  });
  ///:: FIN BOTON CARGAR VALES ::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///

  ///:: BOTON GUARDAR VALES :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
  $("#btn_guardar_vale").on("click",function(){
    let array_vale_repuesto;
    let array_data        = [];
    let rpta_data         = [];
    let grabar_vale       = "";
    vale_ot_estado        = "REGISTRADO";
    vale_id               = $('#vale_id').val();
    va_ot_id              = $('#va_ot_id').val();
    va_genera             = $('#va_genera').val();
    va_date_genera        = $('#va_date_genera').val();
    va_asociado           = $('#va_asociado').val();
    va_responsable        = $('#va_responsable').val();
    va_garantia           = $('#va_garantia').val();
    va_obs_cgm            = $("#va_obs_cgm").val();        
    va_obs_aom            = $("#va_obs_aom").val();
    va_estado             = $("#va_estado").val();
    va_tipo               = "MATERIAL";
    array_vale_repuesto = tabla_repuestos.rows().data().toArray();
    $("#va_date_genera").removeClass("color-error");
    $("#va_estado").removeClass("color-error");

    a_data = f_BuscarDataBD("manto_ot", "ot_id", va_ot_id);
    $.each(array_vale_repuesto, function(idx, obj){ 
      rv_repuesto = obj.rv_repuesto;
      rpta_data = f_BuscarDataBD("manto_preciosproveedor", "precioprov_codproveedor", rv_repuesto);
      if(rpta_data.length==0){
        if(va_estado!="OBSERVADO"){
          Swal.fire({
            position          : 'center',
            icon              : 'error',
            title             : '*Estado debe ser OBSERVADO!!!',
            showConfirmButton : false,
            timer             : 1500
          })
          $("#va_estado").addClass("color-error");    
          grabar_vale = "invalido";    
        }
      }
    });

    if(va_date_genera==""){
      Swal.fire({
        position          : 'center',
        icon              : 'error',
        title             : '*Falta Completar Información!!!',
        showConfirmButton : false,
        timer             : 1500
      })
      $("#va_date_genera").addClass("color-error");
      grabar_vale = "invalido";
    }else{
      let isValidDate = Date.parse(va_date_genera);
        if (isNaN(isValidDate)) {
          Swal.fire({
            position          : 'center',
            icon              : 'error',
            title             : '*Fecha Invalida!!!',
            showConfirmButton : false,
            timer             : 1500
          })
          $("#va_date_genera").addClass("color-error");
          grabar_vale = "invalido";
    
        }
    }

    if(va_estado==""){
      Swal.fire({
        position          : 'center',
        icon              : 'error',
        title             : '*Falta Completar Información!!!',
        showConfirmButton : false,
        timer             : 1500
      })
      $("#va_estado").addClass("color-error");    
      grabar_vale = "invalido";
    }

    if(grabar_vale==""){
      $("#btn_guardar_vale").prop("disabled",true);
      if(opcion_vale=="CREAR"){
        Accion = "generar_vale";
      }else{
        Accion = "editar_vale";
      }
      array_data = JSON.stringify(array_vale_repuesto);
      $.ajax({
        url             : "Ajax.php",
        type            : "POST",
        datatype        : "json",
        async           : false,
        data            : { MoS:MoS, NombreMoS:NombreMoS, Accion:Accion, vale_id:vale_id, va_ot_id:va_ot_id, va_genera:va_genera, va_date_genera:va_date_genera, va_asociado:va_asociado, va_responsable, va_responsable, va_garantia:va_garantia, va_obs_cgm:va_obs_cgm, tva_obs_aom:tva_obs_aom, va_obs_aom:va_obs_aom, va_estado:va_estado, va_tipo:va_tipo, array_data:array_data },
        success         : function(data){

        }
      });
      Swal.fire({
        position          : 'center',
        icon              : 'success',
        title             : 'El registro ha sido grabado.',
        showConfirmButton : false,
        timer             : 1500
      })
      $("#btn_guardar_vale").prop("disabled",false);
      div_show = f_MostrarDiv("form_seleccion_procesar_vale","btn_seleccion_procesar_vale", "","");
      $("#div_btn_seleccion_procesar_vale").html(div_show);
      $("#form_procesar_vale").hide();  
    }

  });
  ///:: FIN BOTON GUARDAR VALES :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///

  ///:: BOTON CANCELAR VALES ::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
  $(document).on("click", ".btn_cancelar_vale", function(){
    div_show = f_MostrarDiv("form_seleccion_procesar_vale","btn_seleccion_procesar_vale", "","");
    $("#div_btn_seleccion_procesar_vale").html(div_show);
    $("#form_procesar_vale").hide();
    $("#vale_id").focus().select();
  });
  ///:: FIN BOTON CANCELAR VALES ::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///

  ///:: EVENTO DEL BOTON VER LOG VALES ::::::::::::::::::::::::::::::::::::::::::::::::::::///
  $(document).on("click", ".btn_log_vale", function(){
    $("#form_modal_log_vale").trigger("reset");

    $(".modal-header").css( "background-color", "#17a2b8");
    $(".modal-header").css( "color", "white" );
    $(".modal-title").text("Log");
    $('#modal_crud_log_vales').modal('show');
    $("#modal_crud_log_vales").draggable({});
    $("#div_log_vale").html(tva_obs_aom);
  });
  ///:: FIN BOTON VER LOG VALES :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///

  ///:: EVENTO DE BOTON VER PROCESAR VALES :::::::::::::::::::::::::::::::::::::::::::::::::::::::///       
  $(document).on("click", ".btn_procesar_ver_vale", function(){
      vale_id = $("#vale_id").val();
      $("#form_modal_ver_procesar_vale").trigger("reset");
      Accion = 'cargar_vale';
      $.ajax({
        url       : "Ajax.php",
        type      : "POST",
        datatype  : "json",
        async     : false,    
        data      : {MoS:MoS,NombreMoS:NombreMoS,Accion:Accion,vale_id:vale_id},    
        success   : function(data){
          data = $.parseJSON(data);
          $.each(data, function(idx, obj){ 
              ipvale_id            = obj.vale_id;
              ipva_ot_id           = obj.va_ot_id;
              ipva_genera          = obj.va_genera;
              ipva_date_genera     = obj.va_date_genera;
              ipva_asociado        = obj.va_asociado;
              ipva_responsable     = obj.va_responsable;
              ipva_obs_cgm         = obj.va_obs_cgm;
              ipva_cierre_adm      = obj.va_cierre_adm;
              ipva_date_cierre_adm = obj.va_date_cierre_adm;
              ipva_obs_aom         = obj.va_obs_aom;
              ipva_estado          = obj.va_estado;
              ipva_garantia        = obj.va_garantia;
              ipva_bus             = obj.va_bus;
              ipva_descrip         = obj.va_descrip;
            });
        }
      });
      $('#ipvale_id').val(ipvale_id);
      $('#ipva_ot_id').val(ipva_ot_id);
      $('#ipva_genera').val(ipva_genera);
      $('#ipva_date_genera').val(ipva_date_genera);
      $('#ipva_asociado').val(ipva_asociado);
      $('#ipva_responsable').val(ipva_responsable);
      $('#ipva_obs_cgm').val(ipva_obs_cgm);
      $('#ipva_cierre_adm').val(ipva_cierre_adm);
      $('#ipva_date_cierre_adm').val(ipva_date_cierre_adm);
      $('#ipva_estado').val(ipva_estado);
      $('#ipva_garantia').val(ipva_garantia);
      $('#ipva_bus').val(ipva_bus);
      $('#ipva_estado').val(ipva_estado);
      $('#ipva_descrip').val(ipva_descrip);
      // Se cargan los div
      $("#div_ipva_obs_cgm").html(ipva_obs_cgm);
      $("#div_ipva_obs_aom").html(ipva_obs_aom);
      div_tabla = f_CreacionTabla("tabla_ver_procesar_repuestos","");
      $("#div_tabla_ver_procesar_repuestos").html(div_tabla);
      columnas_tabla = f_ColumnasTabla("tabla_ver_procesar_repuestos","");

      $("#tabla_ver_procesar_repuestos").dataTable().fnDestroy();
      $('#tabla_ver_procesar_repuestos').show();
      Accion='cargar_repuestos';
      tabla_ver_procesar_repuestos = $('#tabla_ver_procesar_repuestos').DataTable({
        language      : idioma_espanol,
        searching     : false,
        info          : false,
        lengthChange  : false,
        pageLength    : 5,
        responsive    : "true",
        "ajax"        : {            
          "url"       : "Ajax.php", 
          "method"    : 'POST', 
          "data"      : { MoS:MoS, NombreMoS:NombreMoS, Accion:Accion, vale_id:vale_id }, 
          "dataSrc"   : ""
        },
        "columns"     : columnas_tabla,
      });     
  
      $(".modal-header").css( "background-color", "#17a2b8");
      $(".modal-header").css( "color", "white" );
      $(".modal-title").text("Información de Vales");
      $('#modal_crud_ver_procesar_vale').modal('show');	   
      $('#modal-resizable_ver_procesar_vales').resizable();
      $(".modal-dialog").draggable({
          cursor: "move",
          handle: ".dragable_touch",
        });         
  });
  ///:: FIN EVENTO DE BOTON VER VALES :::::::::::::::::::::::::::::::::::::::::::::::::::///


  ///:: TERMINO BOTONES DE PROCESAR VALES :::::::::::::::::::::::::::::::::::::::::::::::::///

});

///:: TERMINO DE DOM PROCESAR VALES :::::::::::::::::::::::::::::::::::::::::::::::::::::::///

///:: FUNCIONES DE PROCESAR VALES :::::::::::::::::::::::::::::::::::::::::::::::::::::::::///

///:: SE INICIALIZAN LAS VARIABLES DE VALES :::::::::::::::::::::::::::::::::::::::::::::::///
function f_cargar_variables_vacio_vale(){
  f_limpia_vale();
  vale_id             = "";
  va_ot_id            = "";
  va_genera           = "";
  va_date_genera      = "";
  va_asociado         = "";
  va_responsable      = "";
  va_obs_cgm          = "";
  va_cierre_adm       = "";
  va_date_cierre_adm  = "";
  va_obs_aom          = "";
  va_estado           = "";
  va_garantia         = "";
  va_bus              = "";
  tva_estado          = "";
  va_descrip          = "";
  tva_obs_aom         = "";
}
///:: FIN INICIALIZAN LAS VARIABLES DE VALES ::::::::::::::::::::::::::::::::::::::::::::::///

///:: SE CARGAN LAS VARIABLES CON LA INFORMACION DE LA BASE DE DATOS ::::::::::::::::::::::///
function f_cargar_variables_vale(p_data){
  $.each(p_data, function(idx, obj){ 
    vale_id = obj.vale_id;
    if(obj.va_ot_id=='0'){
      va_ot_id = '';
    }else{
      va_ot_id = obj.va_ot_id;  
    }
    va_genera           = obj.va_genera;
    va_date_genera      = obj.va_date_genera;
    va_asociado         = obj.va_asociado;
    va_responsable      = obj.va_responsable;
    va_obs_cgm          = obj.va_obs_cgm;
    va_cierre_adm       = obj.va_cierre_adm;
    va_date_cierre_adm  = obj.va_date_cierre_adm;
    va_estado           = obj.va_estado;
    va_garantia         = obj.va_garantia;
    va_bus              = obj.va_bus;
    tva_estado          = obj.va_estado;
    va_descrip          = obj.va_descrip;
    tva_obs_aom         = obj.va_obs_aom;
  });
}
///:: FIN SE CARGAN LAS VARIABLES CON LA INFORMACION DE LA BASE DE DATOS ::::::::::::::::::///

///:: SE CARGAN LAS VARIABLES HTML CON LA INFORMACION :::::::::::::::::::::::::::::::::::::///
function f_carga_variables_html_vale(){
  let t_vale_id = "";
  if(vale_id!==""){
    t_vale_id = "00000000"+vale_id;
    t_vale_id = t_vale_id.substring(t_vale_id.length-8);
  }
  $('#tvale_id').val(t_vale_id);
  $('#va_ot_id').val(va_ot_id);
  $('#va_genera').val(va_genera);
  $('#va_date_genera').val(va_date_genera);
  $('#va_asociado').val(va_asociado);
  $('#va_responsable').val(va_responsable);
  $('#va_obs_cgm').val(va_obs_cgm);
  $('#va_cierre_adm').val(va_cierre_adm);
  $('#va_date_cierre_adm').val(va_date_cierre_adm);
  $('#va_obs_aom').val(va_obs_aom);
  $('#va_estado').val(va_estado);
  $('#va_garantia').val(va_garantia);
  $('#va_bus').val(va_bus);
  $('#tva_estado').val(tva_estado);
  $('#va_descrip').val(va_descrip);
}
///:: FIN CARGAN LAS VARIABLES HTML CON LA INFORMACION ::::::::::::::::::::::::::::::::::::///

///:: SE VALIDA LOS DATOS DE VALES ::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
function f_ValidarVales(pvale_id, pva_ot_id, pva_genera, pva_date_genera, pva_asociado, pva_responsable, pva_garantia, pva_obs_cgm, pva_obs_aom, pva_estado){
  NoLetrasMayuscEspacio=/[^A-Z \Ñ]/;
  let rpta_ValesCabecera="";
  f_limpia_vale();
  if(pvale_id==""){
    $("#vale_id").addClass("color-error");
    rpta_ValesCabecera="invalido";
  }

  if(pva_ot_id==""){
    $("#va_ot_id").addClass("color-error");
    rpta_ValesCabecera="invalido";
  }

  if(pva_genera==""){
    $("#va_genera").addClass("color-error");
    rpta_ValesCabecera="invalido";
  }
  
  if(pva_date_genera==""){
    $("#va_date_genera").addClass("color-error");
    rpta_ValesCabecera="invalido";
  }
 
  if(pva_asociado==""){
    $("#va_asociado").addClass("color-error");
    rpta_ValesCabecera="invalido";
  }

  if(pva_responsable==""){
    $("#va_responsable").addClass("color-error");
    rpta_ValesCabecera="invalido";
  }

  if(pva_garantia==""){
    $("#va_garantia").addClass("color-error");
    rpta_ValesCabecera="invalido";
  }

  if(pva_obs_cgm==""){
    $("#va_obs_cgm").addClass("color-error");
    rpta_ValesCabecera="invalido";
  }

  if(pva_obs_aom==""){
    $("#va_obs_aom").addClass("color-error");
    rpta_ValesCabecera="invalido";
  }

  if(pva_estado==""){
    $("#va_estado").addClass("color-error");
    rpta_ValesCabecera="invalido";
  }

  return rpta_ValesCabecera;
}
///:: FIN VALIDA LOS DATOS DE VALES :::::::::::::::::::::::::::::::::::::::::::::::::::::::///

///:: REMUEVE EL COLOR DE ERROR EN LOS CAMPOS ::::::::::::::::::::::::::::::::::::::::::::/// 
function f_limpia_vale(){
  $("#vale_id").removeClass("color-error");
  $("#va_ot_id").removeClass("color-error");
  $("#va_genera").removeClass("color-error");
  $("#va_date_genera").removeClass("color-error");
  $("#va_asociado").removeClass("color-error");
  $("#va_responsable").removeClass("color-error");
  $("#va_garantia").removeClass("color-error");
  $("#va_obs_cgm").removeClass("color-error");
  $("#va_obs_aom").removeClass("color-error");
  $("#va_estado").removeClass("color-error");
}
///:: FIN REMUEVE EL COLOR DE ERROR EN LOS CAMPOS ::::::::::::::::::::::::::::::::::::::::/// 

///:: FUNCIONES COMBOS DE PROCESAR VALES :::::::::::::::::::::::::::::::::::::::::::::::::///
function f_combos_procesar_vales(){
  ///:: CARGAMOS ASOCIADOS :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
  t_html = f_select_combo("manto_proveedores","NO","prov_razonsocial",va_asociado,"");
  $("#va_asociado").html(t_html);

  ///:: CARGAMOS CGM ::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
  t_html = f_select_roles("CGM","Colab_nombre_corto");
  $("#va_genera").html(t_html);

  t_html = f_select_combo("manto_tc_vale","NO","tc_categoria3",va_garantia,"`manto_tc_vale`.`tc_variable` = 'USUARIO' AND `manto_tc_vale`.`tc_categoria1`= 'VALE' AND `manto_tc_vale`.`tc_categoria2`= 'GARANTIA'" );
  $("#va_garantia").html(t_html);

  t_html = f_select_combo("manto_tc_vale","NO","tc_categoria3",va_estado,"`manto_tc_vale`.`tc_variable` = 'SISTEMA' AND `manto_tc_vale`.`tc_categoria1`= 'VALE' AND `manto_tc_vale`.`tc_categoria2`= 'ESTADO' ");
  $("#va_estado").html(t_html);

}
///:: FIN DE COMBOS DE PROCESAR VALES ::::::::::::::::::::::::::::::::::::::::::::::::::::///

///:: TERMINO FUNCIONES DE PROCESAR VALES ::::::::::::::::::::::::::::::::::::::::::::::::///