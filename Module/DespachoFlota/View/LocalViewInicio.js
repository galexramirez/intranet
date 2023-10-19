///::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
///:: DESPACHO FLOTA 2023-04-01 :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
///:: INICIO v 3.0 ::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
///::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///

///:: DECLARACION VARIABLES GLOBALES ::::::::::::::::::::::::::::::::::::::::::::::::::::::///
var MoS, NombreMoS, Accion, div_tabs, div_tablas, div_boton, columnastabla;
MoS           = "Module";
NombreMoS     = "DespachoFlota";
idiomaEspanol = {
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
  
///:: DOM DESPACHO FLOTA ::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
$(document).ready(function(){
  ///:: CREACION Y ACCESOS A LOS TABS DEL MODULO ::::::::::::::::::::::::::::::::::::::::::///
  div_tabs = f_CreacionTabs("nav-tab-DespachoFlota","");
  $("#nav-tab-DespachoFlota").html(div_tabs);
  $( "#tabs" ).tabs();
});
///:: TERMINO DOM DESPACHO FLOTA ::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///

///:: FUNCIONES DESPACHO FLOTA ::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///

function f_TipoTabla(Prog_Operacion,Tipo){
  let rptaSelect  = "";
  Accion          = 'SelectTipos';
  $.ajax({
    url       : "Ajax.php",
    type      : "POST",
    datatype  : "json",
    async     : false,
    data      : {MoS:MoS,NombreMoS:NombreMoS,Accion:Accion,Prog_Operacion:Prog_Operacion,Tipo:Tipo},    
    success   : function(data){
      rptaSelect = data;
    }
  });
  return rptaSelect;
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
///:: FIN FUNCIONES DE ACCESOS ::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///

///:: TERMINO FUNCIONES DESPACHO FLOTA ::::::::::::::::::::::::::::::::::::::::::::::::::::///