///::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
///:: INICIO v 3.0 ::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
///:: VARIABLES Y FUNCIONES GLOBALES ::::::::::::::::::::::::::::::::::::::::::::::::::::::///
///:: FECHA: 2022-10-27 15:50 :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///

///:: INICIO DECALARACION VARIABLES GLOBALES ::::::::::::::::::::::::::::::::::::::::::::::///
var MoS, NombreMoS, Accion, div_tabs, div_tablas, div_boton, div_show, columnastabla;
MoS       = "Module";
NombreMoS = "AjusteGenerales";
var idiomaEspanol = {
  "lengthMenu"    : "&nbsp&nbsp&nbsp&nbspMostrar _MENU_ registros",
  "zeroRecords"   : "No se encuentran resultados",
  "info"          : "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
  "infoEmpty"     : "Mostrando registros del 0 al 0 de un total de 0 registros",
  "infoFiltered"  : "(Filtrado de un total de _MAX_ registros)",
  "sSearch"       : "Buscar:",
  "oPaginate"     : 
    {
      "sFirst"    : "Primero",
      "sLast"     : "Ultimo",
      "sNext"     : "Siguiente",
      "sPrevious" : "Anterior"
    },
  "select":
    {
      "rows"      :
      {
        "_"       : "Seleccionadas %d filas",
        "0"       : "Click a una fila para seleccionarla",
        "1"       : "Seleccionada 1 fila"
      }
    },
  "sProcessing"   : "Procesando...",
};
///:: TERMINO DECALARACION VARIABLES GLOBALES :::::::::::::::::::::::::::::::::::::::::::::///

///:: INICIO JS DOM ACTIVA LOS TABS AJUSTES GENERALES :::::::::::::::::::::::::::::::::::::///
$(document).ready(function() {
  div_tabs = f_CreacionTabs("nav-tab-AjusteGenerales","");
  $("#nav-tab-AjusteGenerales").html(div_tabs);

  $( "#tabs" ).tabs();
});
///:: TERMINO JS DOM ACTIVA LOS TABS AJUSTES GENERALES ::::::::::::::::::::::::::::::::::::///

///:: INICIO FUNCIONES DE AJUSTE GENERALES ::::::::::::::::::::::::::::::::::::::::::::::::///

function f_TipoTabla(p_Operacion,p_Tipo){
  let rptaSelect="";
  Accion='SelectTipos';
  $.ajax({
    url: "Ajax.php",
    type: "POST",
    datatype:"json",
    async: false,
    data: {MoS:MoS,NombreMoS:NombreMoS,Accion:Accion,ttablausuario_operacion:p_Operacion,ttablausuario_tipo:p_Tipo},    
    success: function(data){
      rptaSelect = data;
    }
  });
  return rptaSelect;
}

function f_TipoTablaUsuario(p_Operacion,p_Tipo){
  let rptaSelect="";
  Accion='SelectTiposUsuario';
  $.ajax({
    url: "Ajax.php",
    type: "POST",
    datatype:"json",
    async: false,
    data: {MoS:MoS,NombreMoS:NombreMoS,Accion:Accion,ttablausuario_operacion:p_Operacion,ttablausuario_tipo:p_Tipo},    
    success: function(data){
      rptaSelect = data;
    }
  });
  return rptaSelect;
}

///:: BUSCAR DATA EN BD :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
function f_BuscarDataBD(pTablaBD,pCampoBD,pDataBuscar){
  let rptaData;
  Accion='BuscarDataBD';
  $.ajax({
    url       : "Ajax.php",
    type      : "POST",
    datatype  : "json",
    async     : false,
    data      : {MoS:MoS,NombreMoS:NombreMoS,Accion:Accion,TablaBD:pTablaBD,CampoBD:pCampoBD,DataBuscar:pDataBuscar},    
    success   : function(data){
      rptaData = $.parseJSON(data);
    }
  });
  return rptaData;
}
///:: FIN BUSCAR DATA EN BD :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///

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

///:: TERMINO FUNCIONES DE AJUSTE GENERALES :::::::::::::::::::::::::::::::::::::::::::::::///