///::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
///:::::::::::::::::::: KILOMETRAJE v 3.0 FECHA: 18-01-2023 :::::::::::::::::::::::::::::::///
//:::::::::::::::::: CREAR, EDITAR, ELIMINAR TABLA DE OT PREVENTIVAS ::::::::::::::::::::::///
///::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///

///::::::::::::::::::::::::::::::: Declaracion de Variables :::::::::::::::::::::::::::::::///
var MoS,NombreMoS,Accion,idiomaEspanol, div_tabs, div_tablas, div_boton, div_show, columnastabla;
MoS             = 'Module';
NombreMoS       = 'Kilometraje';
const fecha_hoy = new Date();
idiomaEspanol   = {
    "lengthMenu": "&nbsp&nbsp&nbsp&nbspMostrar _MENU_ registros",
    "zeroRecords": "No se encuentran resultados",
    "info": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
    "infoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
    "infoFiltered": "(Filtrado de un total de _MAX_ registros)",
    "sSearch": "Buscar:",
    "oPaginate": {
        "sFirst": "Primero",
        "sLast": "Ultimo",
        "sNext": "Siguiente",
        "sPrevious": "Anterior"
    },
    "sProcessing": "Procesando...",
};

///:::::::::::::::::::::::::::::::::: JS DOM KILOMETRAJE ::::::::::::::::::::::::::::::::::///
$(document).ready(function(){
  div_tabs = f_CreacionTabs("nav-tab-kilometraje","");
  $("#div_nav-tab-kilometraje").html(div_tabs);

  $( "#tabs" ).tabs();
});


///::::::::::::::::::::::::::::::::: FUNCIONES DE KILOMETRAJE :::::::::::::::::::::::::::::///
function f_TipoTabla(p_Operacion,p_Tipo){
  let rptaSelect="";
  Accion='SelectTipos';
  $.ajax({
    url: "Ajax.php",
    type: "POST",
    datatype:"json",
    async: false,
    data: {MoS:MoS,NombreMoS:NombreMoS,Accion:Accion,TtablaKilometraje_Operacion:p_Operacion,TtablaKilometraje_Tipo:p_Tipo},    
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