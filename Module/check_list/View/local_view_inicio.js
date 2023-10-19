///::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
///:: CHECK LIST DE FLOTA 2023-09-25 ::::::::::::::::::::::::::::::::::::::::::::::::::::::///
///:: INICIO v 1.0 ::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
///::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///

///:: DECLARACION VARIABLES GLOBALES ::::::::::::::::::::::::::::::::::::::::::::::::::::::///
var MoS, NombreMoS, Accion, div_tabs, div_tablas, div_boton, columnas_tabla, div_show, idioma_espanol, mi_carpeta;
MoS           = "Module";
NombreMoS     = "check_list";
mi_carpeta    = f_DocumentRoot();
idioma_espanol = {
  "lengthMenu"    : "&nbsp&nbsp&nbsp&nbspMostrar _MENU_ registros",
  "zeroRecords"   : "No se encuentran resultados",
  "info"          : "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
  "infoEmpty"     : "Mostrando registros del 0 al 0 de un total de 0 registros",
  "infoFiltered"  : "(Filtrado de un total de _MAX_ registros)",
  "sSearch"       : "Buscar:",
  "oPaginate"     : 
  {
    "sFirst": "Primero",
    "sLast": "Ultimo",
    "sNext": "Siguiente",
    "sPrevious": "Anterior"
  },
  "select"        :
  {
    "rows"        :
    {
      "_"       : "Seleccionadas %d filas",
      "0"       : "Click a una fila para seleccionarla",
      "1"       : "Seleccionada 1 fila"
    }
  },
  "sProcessing": "Procesando...",
};
  
///:: DOM JS INSPECCION DE FLOTA :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
$(document).ready(function(){
  div_tabs = f_CreacionTabs("nav-tab-check_list","");
  $("#nav-tab-check_list").html(div_tabs);
  div_tabs = f_CreacionTabs("nav-tab-arbol","");
  $("#nav-tab-arbol").html(div_tabs);
  div_tabs = f_CreacionTabs("nav-tab-arbol_falla_via","");
  $("#nav-tab-arbol_falla_via").html(div_tabs);
  div_tabs = f_CreacionTabs("nav-tab-ajustes_check_list","");
  $("#nav-tab-ajustes_check_list").html(div_tabs);
  div_tabs = f_CreacionTabs("nav-tab-detalle_check_list","");
  $("#nav-tab-detalle_check_list").html(div_tabs);

  $( "#tabs" ).tabs();
});
///:: TERMINO DOM INSPECCION DE FLOTA :::::::::::::::::::::::::::::::::::::::::::::::::::::///

///:: FUNCIONES INSPECCION DE FLOTA :::::::::::::::::::::::::::::::::::::::::::::::::::::::///

///:: FUNCION QUE GENERA EL LISTADO DEL COMBO SELECT ::::::::::::::::::::::::::::::::::::::///
function f_select_combo(p_nombre_tabla, p_es_campo_unico, p_campo_select, p_campo_inicial, p_condicion_where, p_order_by){
  let rpta_select_combo = "";
  Accion = 'select_combo';
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

///:: SELECT DE USUARIOS ::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
function f_select_roles(p_roles_perfil, p_roles_campo){
  let rpta_select_roles = "";
  Accion = 'select_roles';
  $.ajax({
    url       : "Ajax.php",
    type      : "POST", 
    datatype  : "json",
    async     : false,
    data      : {MoS:MoS, NombreMoS:NombreMoS, Accion:Accion, roles_perfil:p_roles_perfil, roles_campo:p_roles_campo},    
    success   : function(data){
      rpta_select_roles = data;
    }
  });
  return rpta_select_roles;
}

///:: CALCULO DE FECHAS :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
function f_CalculoFecha(p_inicio,p_calculo){
  let rptaFecha="";
  Accion='CalculoFecha';
  $.ajax({
    url: "Ajax.php",
    type: "POST",
    datatype:"json",
    async: false,
    data: {MoS:MoS,NombreMoS:NombreMoS,Accion:Accion,inicio:p_inicio,calculo:p_calculo},    
    success: function(data){
      rptaFecha = data;
    }
  });
  return rptaFecha;
}

// Compara la feche actual con la fecha ingresada
// rpta : fecha actual es "MAYOR" o "MENOR IGUAL"
function f_CompararFechaActual(pfecha){
  let rptaDiferencia="";
  Accion='CompararFechaActual';
  $.ajax({
    url: "Ajax.php",
    type: "POST",
    datatype:"json",
    async: false,
    data: {MoS:MoS,NombreMoS:NombreMoS,Accion:Accion,fecha:pfecha},    
    success: function(data){
      rptaDiferencia = data;
    }
  });
  return rptaDiferencia;
}

function f_DiferenciaFecha(p_inicio,p_final){
  let rptaDiferencia="";
  Accion='DiferenciaFecha';
  $.ajax({
    url: "Ajax.php",
    type: "POST",
    datatype:"json",
    async: false,
    data: {MoS:MoS,NombreMoS:NombreMoS,Accion:Accion,inicio:p_inicio,final:p_final},    
    success: function(data){
      rptaDiferencia = data;
    }
  });
  return rptaDiferencia;
}

function f_dias_diferencia_fechas(p_inicio,p_final){
  let rpta_dias="";
  Accion='dias_diferencia_fechas';
  $.ajax({
    url: "Ajax.php",
    type: "POST",
    datatype:"json",
    async: false,
    data: {MoS:MoS,NombreMoS:NombreMoS,Accion:Accion,inicio:p_inicio,final:p_final},    
    success: function(data){
      rpta_dias = data;
    }
  });
  return rpta_dias;
}

//::::::::::::::::::::::::::::::::: BUSCAR DATA EN BD :::::::::::::::::::::::::::::://
function f_BuscarDataBD(pTablaBD,pCampoBD,pDataBuscar){
  let rptaData;
  Accion='BuscarDataBD';
  $.ajax({
    url: "Ajax.php",
    type: "POST",
    datatype:"json",
    async: false,
    data: {MoS:MoS,NombreMoS:NombreMoS,Accion:Accion,TablaBD:pTablaBD,CampoBD:pCampoBD,DataBuscar:pDataBuscar},    
    success: function(data){
      rptaData = $.parseJSON(data);
    }
  });
  return rptaData;
}

function f_buscar_data_bd(p_tabla, p_c_where){
  let rpta_data;
  Accion = 'buscar_data_bd';
  $.ajax({
    url       : "Ajax.php",
    type      : "POST",
    datatype  : "json",
    async     : false,
    data      : {MoS:MoS, NombreMoS:NombreMoS, Accion:Accion, tabla:p_tabla, c_where:p_c_where},    
    success   : function(data){
      rpta_data = $.parseJSON(data);
    }
  });
  return rpta_data;
}

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

function f_contar_dato(p_nombre_tabla, p_campo_buscar, p_condicion_where){
  let rpta_contar = "";
  Accion = 'contar_dato';
  $.ajax({
    url       : "Ajax.php",
    type      : "POST",
    datatype  : "json",
    async     : false,
    data      : { MoS:MoS, NombreMoS:NombreMoS, Accion:Accion, nombre_tabla:p_nombre_tabla, campo_buscar:p_campo_buscar, condicion_where:p_condicion_where},
    success   : function(data){
      rpta_contar = data;
    }
  });
  return rpta_contar;
}

//:::::::::::::::::::::::::::::::::: UBICAR DIRECTORIO RAIZ ::::::::::::::::::::::://
function f_DocumentRoot(){
  let rptaMiCarpeta = '';
  Accion = 'DocumentRoot';
  $.ajax({
    url: "Ajax.php",
    type: "POST",
    datatype:"json",
    async: false,
    data: {MoS:MoS,NombreMoS:NombreMoS,Accion:Accion},    
    success: function(data){
      rptaMiCarpeta = data;
    }
  });
  return rptaMiCarpeta;
}

///:: AUTOCOMPLETADO ::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
function f_AutoCompletar(pNombreTabla,pNombreCampo, p_va_asociado, p_va_date_genera, p_va_tipo){
  let rptaAutoCompletar="";
  Accion='AutoCompletar';
  $.ajax({
    url: "Ajax.php",
    type: "POST",
    datatype:"json",
    async: false,
    data: {MoS:MoS, NombreMoS:NombreMoS, Accion:Accion, NombreTabla:pNombreTabla, NombreCampo:pNombreCampo, va_asociado:p_va_asociado, va_date_genera:p_va_date_genera, va_tipo:p_va_tipo},
    success: function(data){
      rptaAutoCompletar=$.parseJSON(data);
    }
  });
  
  return rptaAutoCompletar;
}

///:: FUNCIONES DE ACCESOS ::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
function f_CreacionTabs(pNombreTabs,pTipoTabs){
  let rptaTabs  = "";
  Accion        = 'CreacionTabs';
  $.ajax({
    url       : "Ajax.php",
    type      : "POST",
    datatype  : "json",
    async     : false,
    data      : {MoS:MoS,NombreMoS:NombreMoS,Accion:Accion,NombreTabs:pNombreTabs,TipoTabs:pTipoTabs},    
    success   : function(data){
      rptaTabs = data;
    }
  });
  return rptaTabs;
}

function f_CreacionTabla(pNombreTabla,pTipoTabla){
  let rptaTabla = "";
  Accion        = 'CreacionTabla';
  $.ajax({
    url       : "Ajax.php",
    type      : "POST",
    datatype  : "json",
    async     : false,
    data      : {MoS:MoS,NombreMoS:NombreMoS,Accion:Accion,NombreTabla:pNombreTabla,TipoTabla:pTipoTabla},    
    success   : function(data){
      rptaTabla = data;
    }
  });
  return rptaTabla;
}

function f_ColumnasTabla(pNombreTabla,pTipoTabla){
  let rptaColumnas  = "";
  Accion            = 'ColumnasTabla';
  $.ajax({
    url       : "Ajax.php",
    type      : "POST",
    datatype  : "json",
    async     : false,
    data      : {MoS:MoS,NombreMoS:NombreMoS,Accion:Accion,NombreTabla:pNombreTabla,TipoTabla:pTipoTabla},    
    success   : function(data){
      rptaColumnas = $.parseJSON(data);
    }
  });
  return rptaColumnas;
}

function f_BotonesFormulario(pNombreFormulario,pNombreObjeto){
  let rptaBotonesFormulario = "";
  Accion                    = 'BotonesFormulario';
  $.ajax({
    url       : "Ajax.php",
    type      : "POST",
    datatype  : "json",
    async     : false,
    data      : {MoS:MoS,NombreMoS:NombreMoS,Accion:Accion,NombreFormulario:pNombreFormulario,NombreObjeto:pNombreObjeto},    
    success   : function(data){
      rptaBotonesFormulario = data;
    }
  });
  return rptaBotonesFormulario;
}

function f_DivFormulario(pNombreFormulario,pNombreObjeto){
  let rptaDivFormulario="";
  Accion='DivFormulario';
  $.ajax({
    url: "Ajax.php",
    type: "POST",
    datatype:"json",
    async: false,
    data: {MoS:MoS,NombreMoS:NombreMoS,Accion:Accion,NombreFormulario:pNombreFormulario,NombreObjeto:pNombreObjeto},    
    success: function(data){
      rptaDivFormulario = data;
    }
  });
  return rptaDivFormulario;
}

function f_MostrarDiv(pNombreFormulario,pNombreObjeto,pDato){
  let rptaMostrarDiv="";
  Accion='MostrarDiv';
  $.ajax({
    url: "Ajax.php",
    type: "POST",
    datatype:"json",
    async: false,
    data: {MoS:MoS,NombreMoS:NombreMoS,Accion:Accion,NombreFormulario:pNombreFormulario,NombreObjeto:pNombreObjeto,Dato:pDato},    
    success: function(data){
      rptaMostrarDiv = data;
    }
  });
  return rptaMostrarDiv;
}
///:: FIN FUNCIONES DE ACCESOS ::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///

///:: TERMINO FUNCIONES INSPECCION DE  FLOTA ::::::::::::::::::::::::::::::::::::::::::::::///