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
  div_show = f_MostrarDiv("contenido", "div_alertsDropdown_ayuda", NombreMoS);
  $("#div_alertsDropdown_ayuda").html(div_show);

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


function f_MostrarDiv(pNombreFormulario, pNombreObjeto, pDato){
  let rptaMostrarDiv = "";
  Accion = 'MostrarDiv';
  $.ajax({
    url     : "Ajax.php",
    type    : "POST",
    datatype: "json",
    async   : false,
    data    : {MoS:MoS, NombreMoS:NombreMoS, Accion:Accion, NombreFormulario:pNombreFormulario, NombreObjeto:pNombreObjeto, Dato:pDato},    
    success : function(data){
      rptaMostrarDiv = data;
    }
  });
  return rptaMostrarDiv;
}
///:: TERMINO FUNCIONES DE AJUSTE GENERALES :::::::::::::::::::::::::::::::::::::::::::::::///