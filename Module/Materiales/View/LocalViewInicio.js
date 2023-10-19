///::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
///:: MATERIALES Y SERVICIOS v 1.0 FECHA: 21-09-2022 ::::::::::::::::::::::::::::::::::::::::::::///
///:: CREAR, EDITAR, ELIMINAR TABLA DE MATERIALES :::::::::::::::::::::::::::::::::::::::::::::::///
///::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///

///::::::::::::::::::::::::::::::: Declaracion de Variables :::::::::::::::::::::::::::::::::::::///
var MoS,NombreMoS,Accion,idiomaEspanol, div_tabs, div_tablas, div_boton, div_show, columnastabla;
MoS           = 'Module';
NombreMoS     = 'Materiales';
idiomaEspanol = {
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
  div_tabs = f_CreacionTabs("nav-tab-Materiales","");
  $("#nav-tab-Materiales").html(div_tabs);

  $( "#tabs" ).tabs();
});


///::::::::::::::::::::::::::::::::: FUNCIONES DE MATERIALES ::::::::::::::::::::::::::::::::::::///
function f_TipoTabla(p_Operacion,p_Tipo){
  let rptaSelect="";
  Accion='SelectTipos';
  $.ajax({
    url: "Ajax.php",
    type: "POST",
    datatype:"json",
    async: false,
    data: {MoS:MoS,NombreMoS:NombreMoS,Accion:Accion,ttablamateriales_operacion:p_Operacion,ttablamateriales_tipo:p_Tipo},    
    success: function(data){
      rptaSelect = data;
    }
  });
  return rptaSelect;
}

///::::::::::::::::::::::::::::::::: CALCULO DE FECHAS ::::::::::::::::::::::::::::::::::::///
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

//::::::::::::::::::::::::::::::::: AUTOCOMPLETADO :::::::::::::::::::::::::::::://
function f_AutoCompletar(pNombreTabla,pNombreCampo){
  let rptaAutoCompletar="";
  Accion='AutoCompletar';
  $.ajax({
    url: "Ajax.php",
    type: "POST",
    datatype:"json",
    async: false,
    data: {MoS:MoS,NombreMoS:NombreMoS,Accion:Accion,NombreTabla:pNombreTabla,NombreCampo:pNombreCampo},    
    success: function(data){
      rptaAutoCompletar=$.parseJSON(data);
    }
  });
  return rptaAutoCompletar;
}

///:: AUTOCOMPLETADO ::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
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


//::::::::::::::::::::::::::::::::: FUNCIONES ACCESOS :::::::::::::::::::::::::::::://
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