///::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
///:: MATERIALES Y SERVICIOS v 1.0 FECHA: 21-09-2022 ::::::::::::::::::::::::::::::::::::::::::::///
///:: CREAR, EDITAR, ELIMINAR TABLA DE MATERIALES :::::::::::::::::::::::::::::::::::::::::::::::///
///::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///

///::::::::::::::::::::::::::::::: Declaracion de Variables :::::::::::::::::::::::::::::::::::::///
var MoS, NombreMoS, Accion, idioma_espanol, div_tabs, div_tablas, div_boton, div_show, columnas_tabla;
MoS             = 'Module';
NombreMoS       = 'Materiales';
idioma_espanol  = {
  "lengthMenu"  : "&nbsp&nbsp&nbsp&nbspMostrar _MENU_ registros",
  "zeroRecords" : "No se encuentran resultados",
  "info"        : "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
  "infoEmpty"   : "Mostrando registros del 0 al 0 de un total de 0 registros",
  "infoFiltered": "(Filtrado de un total de _MAX_ registros)",
  "sSearch"     : "Buscar:",
  "oPaginate"   : {
    "sFirst"    : "Primero",
    "sLast"     : "Ultimo",
    "sNext"     : "Siguiente",
    "sPrevious" : "Anterior"
  },
  "sProcessing": "Procesando...",
};

///::::::::::::::: JS DOM MATERIALES :::::::::::::://
$(document).ready(function(){
  div_show = f_MostrarDiv("contenido", "div_alertsDropdown_ayuda", NombreMoS);
  $("#div_alertsDropdown_ayuda").html(div_show);

  div_tabs = f_CreacionTabs("nav-tab-Materiales","");
  $("#nav-tab-Materiales").html(div_tabs);

  div_tabs = f_CreacionTabs("nav-tab-ajustes_material","");
  $("#nav-tab-ajustes_material").html(div_tabs);

  $( "#tabs" ).tabs();
});


///:: FUNCIONES DE MATERIALES :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///

///:: FUNCION QUE GENERA EL LISTADO DEL COMBO SELECT ::::::::::::::::::::::::::::::::::::::///
function f_select_combo(p_nombre_tabla, p_es_campo_unico, p_campo_select, p_campo_inicial, p_condicion_where, p_order_by){
  let rpta_select_combo = "";
  Accion    ='select_combo';
  $.ajax({
    url       : "Ajax.php",
    type      : "POST",
    datatype  : "json",
    async     : false,
    data      : {MoS:MoS, NombreMoS:NombreMoS, Accion:Accion, nombre_tabla:p_nombre_tabla, es_campo_unico:p_es_campo_unico, campo_select:p_campo_select, campo_inicial:p_campo_inicial, condicion_where:p_condicion_where, order_by:p_order_by},
    success   : function(data){
      rpta_select_combo = data;
    }
  });
  return rpta_select_combo;
}
///:: FIN DE FUNCION QUE GENERA EL LISTADO DEL COMBO SELECT :::::::::::::::::::::::::::::::///

function f_TipoTabla(p_Operacion,p_Tipo){
  let rptaSelect="";
  Accion = 'SelectTipos';
  $.ajax({
    url     : "Ajax.php",
    type    : "POST",
    datatype: "json",
    async   : false,
    data    : {MoS:MoS, NombreMoS:NombreMoS, Accion:Accion, ttablamateriales_operacion:p_Operacion,ttablamateriales_tipo:p_Tipo},    
    success: function(data){
      rptaSelect = data;
    }
  });
  return rptaSelect;
}

///:: CALCULO DE FECHAS :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
function f_CalculoFecha(p_inicio,p_calculo){
  let rptaFecha = "";
  Accion = 'CalculoFecha';
  $.ajax({
    url     : "Ajax.php",
    type    : "POST",
    datatype: "json",
    async   : false,
    data    : {MoS:MoS, NombreMoS:NombreMoS, Accion:Accion, inicio:p_inicio, calculo:p_calculo},    
    success: function(data){
      rptaFecha = data;
    }
  });
  return rptaFecha;
}
///:: FIN CALCULO DE FECHAS :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///

///:: Compara la feche actual con la fecha ingresada ::::::::::::::::::::::::::::::::::::::///
///:: rpta : fecha actual es "MAYOR" o "MENOR IGUAL"
function f_CompararFechaActual(pfecha){
  let rptaDiferencia="";
  Accion = 'CompararFechaActual';
  $.ajax({
    url     : "Ajax.php",
    type    : "POST",
    datatype: "json",
    async   : false,
    data    : {MoS:MoS, NombreMoS:NombreMoS, Accion:Accion, fecha:pfecha},    
    success : function(data){
      rptaDiferencia = data;
    }
  });
  return rptaDiferencia;
}
///:: FIN Compara la feche actual con la fecha ingresada ::::::::::::::::::::::::::::::::::///

///:: AUTOCOMPLETADO ::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
function f_AutoCompletar(pNombreTabla, pNombreCampo){
  let rptaAutoCompletar = "";
  Accion = 'AutoCompletar';
  $.ajax({
    url     : "Ajax.php",
    type    : "POST",
    datatype: "json",
    async   : false,
    data    : {MoS:MoS, NombreMoS:NombreMoS, Accion:Accion, NombreTabla:pNombreTabla, NombreCampo:pNombreCampo},    
    success: function(data){
      rptaAutoCompletar=$.parseJSON(data);
    }
  });
  return rptaAutoCompletar;
}
///:: FIN AUTOCOMPLETADO ::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///

///:: AUTOCOMPLETADO  :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
function f_auto_completar(p_tabla, p_campo_codigo, p_campo_descripcion, p_campo_asociado, p_asociado, p_campo_fecha, p_fecha, p_campo_tipo, p_tipo){
  let rpta_auto_completar = "";
  Accion = 'auto_completar';
  $.ajax({
    url       : "Ajax.php",
    type      : "POST",
    datatype  : "json",
    async     : false,
    data      : {MoS:MoS, NombreMoS:NombreMoS, Accion:Accion, tabla:p_tabla, campo_codigo:p_campo_codigo, campo_descripcion:p_campo_descripcion, campo_asociado:p_campo_asociado, asociado:p_asociado, campo_fecha:p_campo_fecha, fecha:p_fecha, campo_tipo:p_campo_tipo, tipo:p_tipo},
    success: function(data){
      rpta_auto_completar = $.parseJSON(data);
    }
  });
  
  return rpta_auto_completar;
}
///:: FIN AUTOCOMPLETADO ::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///

///:: BUSCAR DATA EN BD :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
function f_BuscarDataBD(pTablaBD,pCampoBD,pDataBuscar){
  let rptaData;
  Accion = 'BuscarDataBD';
  $.ajax({
    url     : "Ajax.php",
    type    : "POST",
    datatype: "json",
    async   : false,
    data    : {MoS:MoS, NombreMoS:NombreMoS, Accion:Accion, TablaBD:pTablaBD, CampoBD:pCampoBD, DataBuscar:pDataBuscar},    
    success: function(data){
      rptaData = $.parseJSON(data);
    }
  });
  return rptaData;
}
///:: BUSCAR DATA EN BD :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///

///:: ENCONTRAR DATO UNICO EN TABLA :::::::::::::::::::::::::::::::::::::::::::::::::::::::///
function f_encontrar_dato(p_tabla,p_campo_encontrar,p_data_buscar,p_campo_devuelto){
  let rpta_encontrar_dato;
  Accion = 'encontrar_dato';
  $.ajax({
    url       : "Ajax.php",
    type      : "POST",
    datatype  : "json",
    async     : false,
    data      : { MoS:MoS,NombreMoS:NombreMoS,Accion:Accion,tabla:p_tabla,campo_encontrar:p_campo_encontrar,data_buscar:p_data_buscar, campo_devuelto:p_campo_devuelto },
    success   : function(data){
      rpta_encontrar_dato = data;
    }
  });
  return rpta_encontrar_dato;
}
///:: ENCONTRAR DATO UNICO EN TABLA :::::::::::::::::::::::::::::::::::::::::::::::::::::::///

///:: COMBO SELECT PARA UNIDAD DE MEDIDA ::::::::::::::::::::::::::::::::::::::::::::::::::///
function f_select_unidad_medida(){
  let rpta_select="";
  Accion = 'unidad_medida';
  $.ajax({
    url       : "Ajax.php",
    type      : "POST",
    datatype  : "json",
    async     : false,    
    data      : { MoS:MoS,NombreMoS:NombreMoS,Accion:Accion},   
    success   : function(data) {
      rpta_select = data;
    }
  });
  return rpta_select;
}
///:: FIN COMBO SELECT PARA UNIDAD DE MEDIDA ::::::::::::::::::::::::::::::::::::::::::::::///

///:: UBICAR DIRECTORIO RAIZ ::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
function f_DocumentRoot(){
  let rptaMiCarpeta = '';
  Accion = 'DocumentRoot';
  $.ajax({
    url     : "Ajax.php",
    type    : "POST",
    datatype: "json",
    async   : false,
    data    : {MoS:MoS, NombreMoS:NombreMoS, Accion:Accion},    
    success : function(data){
      rptaMiCarpeta = data;
    }
  });
  return rptaMiCarpeta;
}
///:: FIN UBICAR DIRECTORIO RAIZ ::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///

///:: FUNCION QUE BUSCA UN DATO EN ESPECIFICO :::::::::::::::::::::::::::::::::::::::::::::///
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
///:: FIN FUNCION QUE BUSCA UN DATO EN ESPECIFICO :::::::::::::::::::::::::::::::::::::::::///

///:: FUNCION DE AYUDA PARA EL MODULO :::::::::::::::::::::::::::::::::::::::::::::::::::::///
function f_ayuda_modulo(man_titulo){
  let man_modulo_id = f_buscar_dato("Modulo", "Modulo_Id", "`Mod_Nombre` = '"+NombreMoS+"'");
  let manual_id = f_buscar_dato("glo_manual", "manual_id", "`man_modulo_id` = '"+man_modulo_id+"' AND `man_titulo` = '"+man_titulo+"'");
  let man_html = f_buscar_dato("glo_manual_html", "man_html", "`manual_id`='"+manual_id+"'");
  $("#div_ver_ayuda_html").html(man_html);

  $("#form_modal_ver_ayuda").trigger("reset");
  $(".modal-header").css( "background-color", "#17a2b8");
  $(".modal-header").css( "color", "white" );
  $(".modal-title").text( man_titulo );
  $('#modal_crud_ver_ayuda').modal('show');	   
  $('#modal-resizable_ver_ayuda').resizable();
  $(".modal-dialog").draggable({
    cursor: "move",
    handle: ".dragable_touch",
  });
}
///:: FIN FUNCION DE AYUDA PARA EL MODULO :::::::::::::::::::::::::::::::::::::::::::::::::///

///:: FUNCIONES ACCESOS :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
function f_CreacionTabs(pNombreTabs,pTipoTabs){
  let rptaTabs = "";
  Accion = 'CreacionTabs';
  $.ajax({
    url     : "Ajax.php",
    type    : "POST",
    datatype: "json",
    async   : false,
    data: {MoS:MoS, NombreMoS:NombreMoS, Accion:Accion, NombreTabs:pNombreTabs, TipoTabs:pTipoTabs},    
    success: function(data){
      rptaTabs = data;
    }
  });
  return rptaTabs;
}

function f_CreacionTabla(pNombreTabla,pTipoTabla){
  let rptaTabla = "";
  Accion = 'CreacionTabla';
  $.ajax({
    url     : "Ajax.php",
    type    : "POST",
    datatype: "json",
    async   : false,
    data    : {MoS:MoS, NombreMoS:NombreMoS, Accion:Accion, NombreTabla:pNombreTabla, TipoTabla:pTipoTabla},    
    success: function(data){
      rptaTabla = data;
    }
  });
  return rptaTabla;
}

function f_ColumnasTabla(pNombreTabla, pTipoTabla){
  let rptaColumnas = "";
  Accion = 'ColumnasTabla';
  $.ajax({
    url     : "Ajax.php",
    type    : "POST",
    datatype: "json",
    async   : false,
    data    : {MoS:MoS, NombreMoS:NombreMoS, Accion:Accion, NombreTabla:pNombreTabla, TipoTabla:pTipoTabla},    
    success: function(data){
      rptaColumnas = $.parseJSON(data);
    }
  });
  return rptaColumnas;
}

function f_BotonesFormulario(pNombreFormulario, pNombreObjeto){
  let rptaBotonesFormulario = "";
  Accion = 'BotonesFormulario';
  $.ajax({
    url     : "Ajax.php",
    type    : "POST",
    datatype: "json",
    async   : false,
    data    : {MoS:MoS, NombreMoS:NombreMoS, Accion:Accion, NombreFormulario:pNombreFormulario, NombreObjeto:pNombreObjeto},    
    success: function(data){
      rptaBotonesFormulario = data;
    }
  });
  return rptaBotonesFormulario;
}

function f_DivFormulario(pNombreFormulario,pNombreObjeto){
  let rptaDivFormulario = "";
  Accion = 'DivFormulario';
  $.ajax({
    url     : "Ajax.php",
    type    : "POST",
    datatype: "json",
    async   : false,
    data    : {MoS:MoS, NombreMoS:NombreMoS, Accion:Accion, NombreFormulario:pNombreFormulario, NombreObjeto:pNombreObjeto},    
    success: function(data){
      rptaDivFormulario = data;
    }
  });
  return rptaDivFormulario;
}

function f_MostrarDiv(pNombreFormulario, pNombreObjeto, pDato){
  let rptaMostrarDiv="";
  Accion = 'MostrarDiv';
  $.ajax({
    url     : "Ajax.php",
    type    : "POST",
    datatype: "json",
    async   : false,
    data    : {MoS:MoS, NombreMoS:NombreMoS, Accion:Accion, NombreFormulario:pNombreFormulario, NombreObjeto:pNombreObjeto, Dato:pDato},    
    success: function(data){
      rptaMostrarDiv = data;
    }
  });
  return rptaMostrarDiv;
}
///:: FIN FUNCIONES ACCESOS :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///