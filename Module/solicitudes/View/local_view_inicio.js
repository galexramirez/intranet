///::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
///:: SOLICITUDES v 1.0 FECHA: 10-04-2023 :::::::::::::::::::::::::::::::::::::::::::::::::///
///:: CREAR, EDITAR SOLICITUDES :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
///::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///

///:: DECLARACION DE VARIABLES ::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
var MoS, NombreMoS, Accion, idioma_espanol, div_tabs, div_tablas, div_boton, div_show, columnastabla, mi_carpeta;

mi_carpeta      = f_DocumentRoot();
MoS             = 'Module';
NombreMoS       = 'solicitudes';
idioma_espanol  = {
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
    "sProcessing"   : "Procesando...",
};
///:: TERMINO DECLARACION DE VARIABLES ::::::::::::::::::::::::::::::::::::::::::::::::::::///

///:: JS DOM INICIO :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
$(document).ready(function(){

});
///:: TERMINO JS DOM INICIO :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///

///:: FUNCIONES DE SOLICITUDES ::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///

function f_select_tipos(p_Operacion,p_Tipo){
  let rptaSelect="";
  Accion='SelectTipos';
  $.ajax({
    url: "Ajax.php",
    type: "POST",
    datatype:"json",
    async: false,
    data: {MoS:MoS,NombreMoS:NombreMoS,Accion:Accion,operacion:p_Operacion,tipo:p_Tipo},    
    success: function(data){
      rptaSelect = data;
    }
  });
  return rptaSelect;
}

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

function f_permisos(p_objeto){
  let rpta_permisos = "";
  Accion = 'permisos';
  $.ajax({
    url       : "Ajax.php",
    type      : "POST",
    datatype  : "json",
    async     : false,
    data      : {MoS:MoS, NombreMoS:NombreMoS, Accion:Accion, objeto:p_objeto},    
    success   : function(data){
      rpta_permisos = data;
    }
  });
  return rpta_permisos;
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

function f_DiferenciaFecha(p_inicio,p_final,p_dias){
  let rptaDiferencia="";
  Accion='DiferenciaFecha';
  $.ajax({
    url: "Ajax.php",
    type: "POST",
    datatype:"json",
    async: false,
    data: {MoS:MoS,NombreMoS:NombreMoS,Accion:Accion,inicio:p_inicio,final:p_final,dias:p_dias},    
    success: function(data){
      rptaDiferencia = data;
    }
  });
  return rptaDiferencia;
}
///:: FIN CALCULO DE FECHAS :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///

///:: BUSCAR DATA EN BD :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
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
///:: FIN BUSCAR DATA EN BD :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///

///:: ENCONTRAR LA DIRECCION RAIZ DEL MODULO ::::::::::::::::::::::::::::::::::::::::::::::///
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
///:: FIN ENCONTRAR LA DIRECCION RAIZ DEL MODULO ::::::::::::::::::::::::::::::::::::::::::///

///:: FUNCIONES DE ACCESOS ::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
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

///:: FIN FUNCIONES DE ACCESOS ::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///

///:: TERMINO FUNCIONES DE SOLICITUDES ::::::::::::::::::::::::::::::::::::::::::::::::::::///