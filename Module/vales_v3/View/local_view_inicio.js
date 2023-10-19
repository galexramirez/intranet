///::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
///:: OT VALES v 3.0 FECHA: 01-06-2023 ::::::::::::::::::::::::::::::::::::::::::::::::::::///
//::: CREAR, EDITAR, ELIMINAR TABLA DE OT VALES :::::::::::::::::::::::::::::::::::::::::::///
///::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///

///:: DECLARACION DE VARIABLES ::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
var MoS,NombreMoS,Accion,idiomaEspanol, div_tabs, div_tablas, div_boton, div_show, columnastabla, mi_carpeta, a_data, t_html;
MoS           = 'Module';
NombreMoS     = 'vales_v3';
idiomaEspanol = {
    "lengthMenu"    : "&nbsp&nbsp&nbsp&nbspMostrar _MENU_ registros",
    "zeroRecords"   : "No se encuentran resultados",
    "info"          : "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
    "infoEmpty"     : "Mostrando registros del 0 al 0 de un total de 0 registros",
    "infoFiltered"  : "(Filtrado de un total de _MAX_ registros)",
    "sSearch"       : "Buscar:",
    "oPaginate"     : {
      "sFirst"      : "Primero",
      "sLast"       : "Ultimo",
      "sNext"       : "Siguiente",
      "sPrevious"   : "Anterior"
    },
    "sProcessing"  : "Procesando...",
};

///:: JS DOM VALES ::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
$(document).ready(function(){
  div_tabs = f_CreacionTabs("nav-tab-Vales","");
  $("#nav-tab-Vales").html(div_tabs);

  $( "#tabs" ).tabs();
});


///:: FUNCIONES DE VALES ::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
function f_DocumentRoot(){
  let rpta_mi_carpeta = '';
  Accion = 'DocumentRoot';
  $.ajax({
    url       : "Ajax.php",
    type      : "POST",
    datatype  : "json",
    async     : false,
    data      : {MoS:MoS,NombreMoS:NombreMoS,Accion:Accion},    
    success   : function(data){
      rpta_mi_carpeta = data;
    }
  });
  return rpta_mi_carpeta;
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

///:: BUSCAR DATA EN BD :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
function f_BuscarDataBD(pTablaBD,pCampoBD,pDataBuscar){
  let rptaData;
  Accion='BuscarDataBD';
  $.ajax({
    url       : "Ajax.php",
    type      : "POST",
    datatype  :"json",
    async     : false,
    data      : {MoS:MoS,NombreMoS:NombreMoS,Accion:Accion,TablaBD:pTablaBD,CampoBD:pCampoBD,DataBuscar:pDataBuscar},    
    success   : function(data){
      rptaData = $.parseJSON(data);
    }
  });
  return rptaData;
}
///:: FIN BUSCAR DATA EN BD :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///

///:: SELECT DE USUARIOS ::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
function f_select_roles(p_roles_perfil, p_roles_campo){
  let rpta_select_roles = "";
  Accion ='select_roles';
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

///:: FUNCION QUE GENERA EL LISTADO DEL COMBO SELECT ::::::::::::::::::::::::::::::::::::::///
function f_select_combo(p_nombre_tabla, p_es_campo_unico, p_campo_select, p_campo_inicial, p_condicion_where){
  let rpta_select_combo = "";
  Accion    ='select_combo';
  $.ajax({
    url       : "Ajax.php",
    type      : "POST",
    datatype  : "json",
    async     : false,
    data      : {MoS:MoS, NombreMoS:NombreMoS, Accion:Accion, nombre_tabla:p_nombre_tabla, es_campo_unico:p_es_campo_unico, campo_select:p_campo_select, campo_inicial:p_campo_inicial, condicion_where:p_condicion_where},
    success   : function(data){
      rpta_select_combo = data;
    }
  });
  return rpta_select_combo;
}

///:: FUNCIONES ACCESOS :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
function f_CreacionTabs(pNombreTabs,pTipoTabs){
  let rptaTabs="";
  Accion='CreacionTabs';
  $.ajax({
    url: "Ajax.php",
    type: "POST",
    datatype:"json",
    async: false,
    data: {MoS:MoS,NombreMoS:NombreMoS,Accion:Accion,NombreTabs:pNombreTabs,TipoTabs:pTipoTabs},    
    success: function(data){
      rptaTabs = data;
    }
  });
  return rptaTabs;
}

function f_CreacionTabla(pNombreTabla,pTipoTabla){
  let rptaTabla="";
  Accion='CreacionTabla';
  $.ajax({
    url: "Ajax.php",
    type: "POST",
    datatype:"json",
    async: false,
    data: {MoS:MoS,NombreMoS:NombreMoS,Accion:Accion,NombreTabla:pNombreTabla,TipoTabla:pTipoTabla},    
    success: function(data){
      rptaTabla = data;
    }
  });
  return rptaTabla;
}

function f_ColumnasTabla(pNombreTabla,pTipoTabla){
  let rptaColumnas="";
  Accion='ColumnasTabla';
  $.ajax({
    url: "Ajax.php",
    type: "POST",
    datatype:"json",
    async: false,
    data: {MoS:MoS,NombreMoS:NombreMoS,Accion:Accion,NombreTabla:pNombreTabla,TipoTabla:pTipoTabla},    
    success: function(data){
      rptaColumnas = $.parseJSON(data);
    }
  });
  return rptaColumnas;
}

function f_BotonesFormulario(pNombreFormulario,pNombreObjeto){
  let rptaBotonesFormulario="";
  Accion='BotonesFormulario';
  $.ajax({
    url: "Ajax.php",
    type: "POST",
    datatype:"json",
    async: false,
    data: {MoS:MoS,NombreMoS:NombreMoS,Accion:Accion,NombreFormulario:pNombreFormulario,NombreObjeto:pNombreObjeto},    
    success: function(data){
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