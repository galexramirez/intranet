///::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
///:: PROCESAR VALES v 2.0 FECHA: 07-03-2023 ::::::::::::::::::::::::::::::::::::::::::::::///
//::: EDITAR TABLA DE VALES :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
///::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///

///:: DECLARACION DE VARIABLES ::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
var cod_vale, va_ot, va_genera, va_date_genera, va_asociado, va_responsable, va_obs_cgm, va_cierre_adm, va_date_cierre_adm, va_obs_aom, va_estado, va_garantia, va_bus, tva_estado, va_descrip, tva_obs_aom, opcion_vales;
var vale_ot_estado;
///:: TERMINO DECLARACION DE VARIABLES ::::::::::::::::::::::::::::::::::::::::::::::::::::///

///:: JS DOM VALES PROCESAR :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
$(document).ready(function(){
  div_show = f_MostrarDiv("form_seleccion_procesar_vales","btn_seleccion_procesar_vales", "","");
  $("#div_btn_seleccion_procesar_vales").html(div_show);
  $("#form_procesar_vales").hide();

  ///:: SI HAY CAMBIOS EN EL CODIGO DE VALES SE OCULTA EL FORM ::::::::::::::::::::::::::::///
  $("#cod_vale").on('change', function () {
    cod_vale = $("#cod_vale").val();
    $("#form_procesar_vales").hide();
    div_show = f_MostrarDiv("form_seleccion_procesar_vales","btn_seleccion_procesar_vales", "","");
    $("#div_btn_seleccion_procesar_vales").html(div_show);

  });

  /// SI HAY CAMBIOS EN ASOCIADOS SE ACTUALIZA RESPONSABLE ::::::::::::::::::::::::::::::::///
  $("#va_asociado").on('change', function () {
    va_asociado = $("#va_asociado").val();
    // SE CARGA EL COMBO CON TODOS LOS RESPONSABLES DEL ASOCIADO
    Accion = 'SelectResponsable';
    $.ajax({
      url         : "Ajax.php",
      type        : "POST",
      datatype    : "json",
      async       : false,
      data        : { MoS:MoS,NombreMoS:NombreMoS,Accion:Accion,va_asociado:va_asociado },
      success     : function(data){
        $("#va_responsable").html(data);
      }
    });
  });

  ///:: SI HAY CAMBIOS EN N° OT SE ACTUALIZA BUS Y DESCRIPCION ::::::::::::::::::::::::::::///
  $("#va_ot").on('change', function () {
    va_ot          = $("#va_ot").val();
    va_bus         = "";
    va_descrip     = "";
    vale_ot_estado = "REGISTRADO";
    ///:: SE CARGA EL COMBO CON TODOS LOS RESPONSABLES DEL ASOCIADO :::::::::::::::::::::::///
    Accion  = 'BuscarOT';
    $.ajax({
      url       : "Ajax.php",
      type      : "POST",
      datatype  : "json",
      async     : false,
      data      : { MoS:MoS,NombreMoS:NombreMoS,Accion:Accion,va_ot:va_ot }, 
      success   : function(data){
        data = $.parseJSON(data);
        $.each(data, function(idx, obj){ 
          va_ot       = obj.va_ot;
          va_bus      = obj.va_bus;
          va_descrip  = obj.va_descrip;
          if(va_ot==""){
            va_ot           = $("#va_ot").val();
            vale_ot_estado  = "NO REGISTRADO";
            Swal.fire({
              position          : 'center',
              icon              : 'warning',
              title             : 'N° OT no registrado !!!',
              showConfirmButton : false,
              timer             : 1500
            })
            //$("#va_ot").focus().select();
          }
        });
      }
    });
    $("#va_ot").val(va_ot);
    $("#va_bus").val(va_bus);
    $("#va_descrip").val(va_descrip);
  });

  ///:: INICIO DE BOTONES PROCESAR VALES ::::::::::::::::::::::::::::::::::::::::::::::::::///

  ///:: BOTON CARGAR PROCESAR VALES :::::::::::::::::::::::::::::::::::::::::::::::::::::::///
  $(document).on("click", ".btn_cargar_vales", function(){
    f_CargarVariablesVacioVales();
    f_CargaVariablesHtmlVales();
    cod_vale     = $("#cod_vale").val();
    opcion_vales = "";

    if(cod_vale==""){
      $("#cod_vale").focus();
      Swal.fire({
        position          : 'center',
        icon              : 'error',
        title             : 'Ingresar N° Vale !!!',
        showConfirmButton : false,
        timer             : 1500
      })
    }else{
      f_combos_procesar_vales();
      Accion = 'cargar_vales';
      $.ajax({
        url       : "Ajax.php",
        type      : "POST",
        datatype  : "json",
        async     : false,    
        data      : { MoS:MoS,NombreMoS:NombreMoS,Accion:Accion,cod_vale:cod_vale },
        success   : function(data){
          data = $.parseJSON(data);
          f_CargarVariablesVales(data);
          if(va_estado!=""){
            ///:: SE CARGA EL COMBO CON TODOS LOS RESPONSABLES DEL ASOCIADO :::::::::::::::///
            Accion = 'SelectResponsable';
            $.ajax({
              url     : "Ajax.php",
              type    : "POST",
              datatype:"json",
              async   : false,
              data    : {MoS:MoS,NombreMoS:NombreMoS,Accion:Accion,va_asociado:va_asociado},    
              success : function(data){
                $("#va_responsable").html(data);
              }
            });
            ///:: SE PRECARGA EL PRIMER RESPONSABLE DEL ASOCIADO ::::::::::::::::::::::::::///
            if((va_responsable==null || va_responsable=="") && va_asociado!=""){
              Accion = 'BuscarResponsable';
              $.ajax({
                url       : "Ajax.php",
                type      : "POST",
                datatype  :"json",
                async     : false,
                data      : {MoS:MoS,NombreMoS:NombreMoS,Accion:Accion,va_asociado:va_asociado},    
                success   : function(data){
                  va_responsable = data;
                }
              });
              $("#va_responsable").val(va_responsable);
            }
            $("#form_procesar_vales").show();
            $("#va_ot").focus().select();
            f_CargaVariablesHtmlVales();
            opcion_vales  = "EDITAR"; 
            div_show      = f_MostrarDiv("form_seleccionar_procesar_vales","btn_seleccion_procesar_vales", "vacio","");
            $("#div_btn_seleccion_procesar_vales").html(div_show);
          }else{
            Swal.fire({
              title             : '¿Está seguro de crear?',
              html              : "Se creará el Vale N° : "+cod_vale+" !!!",
              icon              : 'warning',
              showCancelButton  : true,
              cancelButtonColor : '#d33',
              cancelButtonText  : 'Cancelar',
              confirmButtonColor: '#3085d6',
              confirmButtonText : 'Si, crear!',
              focusConfirm      : true
            }).then((result) => 
            {
              if(result.isConfirmed){
                $("#form_procesar_vales").show();
                $("#va_ot").focus().select();
                f_CargaVariablesHtmlVales();
                opcion_vales  = "CREAR";
                div_show      = f_MostrarDiv("form_seleccionar_procesar_vales","btn_seleccion_procesar_vales", "vacio","");
                $("#div_btn_seleccion_procesar_vales").html(div_show);
              }
            });
          }
          // SE HABILITAN LOS CAMPOS DE CABECERA
          $("#va_ot").prop("disabled",false);
          $("#va_asociado").prop("disabled",false);
          $("#va_responsable").prop("disabled",false);
          $("#va_garantia").prop("disabled",false);
          $("#va_genera").prop("disabled",false);
          $("#va_date_genera").prop("disabled",false);
          $("#va_obs_cgm").prop("disabled",false);
          $("#va_obs_aom").prop("disabled",false);
          $("#va_estado").prop("disabled",false);
          btn_BorrarRepuesto = "SI";
          f_TablaDetalleRepuestos(cod_vale,btn_BorrarRepuesto);
        }
      });
    }
  });
  ///:: FIN BOTON CARGAR VALES ::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///

  ///:: BOTON GUARDAR VALES :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
  $("#btn_guardar_vale").on("click",function(){
    let array_data        = [];
    let grabar_vale       = "";
    vale_ot_estado        = "REGISTRADO";
    cod_vale              = $('#cod_vale').val();
    va_ot                 = $('#va_ot').val();
    va_genera             = $('#va_genera').val();
    va_date_genera        = $('#va_date_genera').val();
    va_asociado           = $('#va_asociado').val();
    va_responsable        = $('#va_responsable').val();
    va_garantia           = $('#va_garantia').val();
    va_obs_cgm            = $("#va_obs_cgm").val();         
    va_obs_aom            = $("#va_obs_aom").val();
    va_estado             = $("#va_estado").val();
    array_vales_repuestos = tablaDetalleRepuestos.rows().data().toArray();
    $("#va_date_genera").removeClass("color-error");
    $("#va_estado").removeClass("color-error");

    Accion  = 'BuscarOT';
    $.ajax({
      url       : "Ajax.php",
      type      : "POST",
      datatype  : "json",
      async     : false,
      data      : { MoS:MoS,NombreMoS:NombreMoS,Accion:Accion,va_ot:va_ot }, 
      success   : function(data){
        data = $.parseJSON(data);
        $.each(data, function(idx, obj){ 
          va_ot       = obj.va_ot;
          va_bus      = obj.va_bus;
          va_descrip  = obj.va_descrip;
          if(va_ot==""){
            va_ot           = $("#va_ot").val();
            vale_ot_estado  = "NO REGISTRADO";
          }
        });
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
/*    
    if(va_estado=="OBSERVADO"){
      if(vale_ot_estado=="NO REGISTRADO"){
        va_obs_aom = va_obs_aom + " OT NO REGISTRADA";
      }else{
        Swal.fire({
          position          : 'center',
          icon              : 'error',
          title             : '* Estado debe ser OBSERVADO!!!',
          showConfirmButton : false,
          timer             : 1500
        })
        $("#va_estado").addClass("color-error");
        grabar_vale = "invalido";
      }
    }

    if(va_estado=="CERRADO"){
      grabar_vale = f_ValidarVales(cod_vale, va_ot, va_genera, va_date_genera, va_asociado, va_responsable, va_garantia, va_obs_cgm, va_obs_aom, va_estado);
      if(vale_ot_estado=="NO REGISTRADO"){
        Swal.fire({
          position          : 'center',
          icon              : 'error',
          title             : '* OT NO Registrada!!!',
          showConfirmButton : false,
          timer             : 1500
        })
        $("#va_ot").addClass("color-error");
        grabar_vale = "invalido";
      }
    }
*/
    if(grabar_vale==""){
      $("#btn_guardar_vale").prop("disabled",true);
      if(opcion_vales=="CREAR"){
        Accion = "generar_vales";
      }else{
        Accion = "editar_vales";
      }
      array_data = JSON.stringify(array_vales_repuestos);
      $.ajax({
        url             : "Ajax.php",
        type            : "POST",
        datatype        : "json",
        async           : false,
        data            : { MoS:MoS,NombreMoS:NombreMoS,Accion:Accion, cod_vale:cod_vale, va_ot:va_ot, va_genera:va_genera, va_date_genera:va_date_genera, va_asociado:va_asociado, va_responsable, va_responsable, va_garantia:va_garantia, va_obs_cgm:va_obs_cgm, tva_obs_aom:tva_obs_aom, va_obs_aom:va_obs_aom, va_estado:va_estado, array_data:array_data },
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
      div_show = f_MostrarDiv("form_seleccion_procesar_vales","btn_seleccion_procesar_vales", "","");
      $("#div_btn_seleccion_procesar_vales").html(div_show);
      $("#form_procesar_vales").hide();
      vales_observadas = f_vales_observadas();
      $("#vales_alerta").html(vales_observadas);
  
    }

  });
  ///:: FIN BOTON GUARDAR VALES :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///

  ///:: BOTON CANCELAR VALES ::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
  $(document).on("click", ".btn_cancelar_vale", function(){
    div_show = f_MostrarDiv("form_seleccion_procesar_vales","btn_seleccion_procesar_vales", "","");
    $("#div_btn_seleccion_procesar_vales").html(div_show);
    $("#form_procesar_vales").hide();
    $("#cod_vale").focus().select();
  });
  ///:: FIN BOTON CANCELAR VALES ::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///

    ///:: EVENTO DE BOTON VER PROCESAR VALES :::::::::::::::::::::::::::::::::::::::::::::::::::::::///       
    $(document).on("click", ".btn_procesar_ver_vales", function(){
        cod_vale = $("#cod_vale").val();
        $("#form_modal_ver_procesar_vales").trigger("reset");

        Accion = 'cargar_vales';
        $.ajax({
          url       : "Ajax.php",
          type      : "POST",
          datatype  : "json",
          async     : false,    
          data      : {MoS:MoS,NombreMoS:NombreMoS,Accion:Accion,cod_vale:cod_vale},    
          success   : function(data){
            data = $.parseJSON(data);
            $.each(data, function(idx, obj){ 
                ipcod_vale           = obj.cod_vale;
                ipva_ot              = obj.va_ot;
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
        $('#ipcod_vale').val(ipcod_vale);
        $('#ipva_ot').val(ipva_ot);
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

        div_tabla = f_CreacionTabla("tabla_ver_procesar_detalle_repuestos","");
        $("#div_tabla_ver_procesar_detalle_repuestos").html(div_tabla);
        columnastabla = f_ColumnasTabla("tabla_ver_procesar_detalle_repuestos","");
  
        $("#tabla_ver_procesar_detalle_repuestos").dataTable().fnDestroy();
        $('#tabla_ver_procesar_detalle_repuestos').show();
        Accion='cargar_detalle_repuestos';
        tabla_ver_procesar_detalle_repuestos = $('#tabla_ver_procesar_detalle_repuestos').DataTable({
          language      : idiomaEspanol,
          searching     : false,
          info          : false,
          lengthChange  : false,
          pageLength    : 5,
          responsive    : "true",
          "ajax"        : {            
            "url"       : "Ajax.php", 
            "method"    : 'POST', 
            "data"      : { MoS:MoS, NombreMoS:NombreMoS, Accion:Accion, cod_vale:cod_vale }, 
            "dataSrc"   : ""
          },
          "columns"     : columnastabla,
        });     
   
        $(".modal-header").css( "background-color", "#17a2b8");
        $(".modal-header").css( "color", "white" );
        $(".modal-title").text("Información de Vales");
        $('#modal_crud_ver_procesar_vales').modal('show');	   
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
function f_CargarVariablesVacioVales(){
  f_LimpiaVales();
  cod_vale            = "";
  va_ot               = "";
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
function f_CargarVariablesVales(p_data){
  $.each(p_data, function(idx, obj){ 
    cod_vale = obj.cod_vale;
    if(obj.va_ot=='0'){
      va_ot = '';
    }else{
      va_ot = obj.va_ot;  
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
function f_CargaVariablesHtmlVales(){
  $('#tcod_vale').val(cod_vale);
  $('#va_ot').val(va_ot);
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
  // Se cargan los div
  $("#div_va_obs_aom").html(tva_obs_aom);
}
///:: FIN CARGAN LAS VARIABLES HTML CON LA INFORMACION ::::::::::::::::::::::::::::::::::::///

///:: SE VALIDA LOS DATOS DE VALES ::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
function f_ValidarVales(pcod_vale, pva_ot, pva_genera, pva_date_genera, pva_asociado, pva_responsable, pva_garantia, pva_obs_cgm, pva_obs_aom, pva_estado){
  NoLetrasMayuscEspacio=/[^A-Z \Ñ]/;
  let rpta_ValesCabecera="";
  f_LimpiaVales();
  if(pcod_vale==""){
    $("#cod_vale").addClass("color-error");
    rpta_ValesCabecera="invalido";
  }

  if(pva_ot==""){
    $("#va_ot").addClass("color-error");
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
function f_LimpiaVales(){
  $("#cod_vale").removeClass("color-error");
  $("#va_ot").removeClass("color-error");
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
  Accion='AsociadoVales';
  $.ajax({
    url: "Ajax.php",
    type: "POST",
    datatype:"json",
    async: false,
    data: {MoS:MoS,NombreMoS:NombreMoS,Accion:Accion},    
    success: function(data){
        $("#va_asociado").html(data);
    }
  });

  ///:: CCARGAMOS CGM :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
  Accion='SelectUsuario';
  Usua_Perfil = 'CGM';
  $.ajax({
    url: "Ajax.php",
    type: "POST",
    datatype:"json",
    async: false,
    data: {MoS:MoS,NombreMoS:NombreMoS,Accion:Accion,Usua_Perfil:Usua_Perfil},    
    success: function(data){
      $("#va_genera").html(data);
    }
  });
  
  Operacion='VALES';
  
  Tipo='GARANTIA';
  selectHtmlVales="";
  selectHtmlVales = f_TipoTabla(Operacion,Tipo);
  $("#va_garantia").html(selectHtmlVales);
  
  Tipo='ESTADO';
  selectHtmlVales="";
  selectHtmlVales = f_TipoTabla(Operacion,Tipo);
  $("#va_estado").html(selectHtmlVales);
}
///:: FIN DE COMBOS DE PROCESAR VALES ::::::::::::::::::::::::::::::::::::::::::::::::::::///

///:: TERMINO FUNCIONES DE PROCESAR VALES ::::::::::::::::::::::::::::::::::::::::::::::::///