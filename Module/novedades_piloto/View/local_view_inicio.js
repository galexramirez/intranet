///::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
///:: INICIO v 3.0 2023-04-24 :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
///:: VARIABLES Y FUNCIONES GLOBALES ::::::::::::::::::::::::::::::::::::::::::::::::::::::///
///::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///

///:: DECLARACION DE VARIABLES GLOBALES :::::::::::::::::::::::::::::::::::::::::::::::::::///
var MoS, NombreMoS, Accion, idioma_espanol, div_tabs, div_tablas, div_boton, div_show, columnas_tabla, mi_carpeta;
const fecha_actual_novedades = new Date();
const anio_actual_novedades = fecha_actual_novedades.getFullYear();
MoS           = "Module";
NombreMoS     = "novedades_piloto";
idiomaEspanol = {
  "lengthMenu": "&nbsp&nbsp&nbsp&nbspMostrar _MENU_ registros",
  "zeroRecords": "No se encuentran resultados",
  "info": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
  "infoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
  "infoFiltered": "(Filtrado de un total de _MAX_ registros)",
  "sSearch": "Buscar:",
  "oPaginate": 
    {
      "sFirst": "Primero",
      "sLast": "Ultimo",
      "sNext": "Siguiente",
      "sPrevious": "Anterior"
    },
  "select":
    {
      "rows":
      {
        "_": "Seleccionadas %d filas",
        "0": "Click a una fila para seleccionarla",
        "1": "Seleccionada 1 fila"
      }
    },
  "sProcessing": "Procesando...",
};

///:: ACTIVA LOS TABS :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
$(document).ready(function() {
  div_tabs = f_CreacionTabs("nav-tab-novedades_piloto","");
  $("#div_nav-tab-novedades_piloto").html(div_tabs);
  
  $( "#tabs" ).tabs();
});


///:: FUNCIONES GLOBALES ::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///

///:: FUNCIONES DE NOVEDADES DE PILOTO ::::::::::::::::::::::::::::::::::::::::::::::::::::///

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

function f_calcular_diferencia_horas(p_horainicio,p_horafinal){
  let rptaCalculo="";
  if(p_horainicio!="" && p_horafinal!=""){
    Accion='calcular_diferencia_horas';
    $.ajax({
      url: "Ajax.php",
      type: "POST",
      datatype:"json",
      async: false,    
      data: {MoS:MoS,NombreMoS:NombreMoS,Accion:Accion,horainicio:p_horainicio,horafinal:p_horafinal},
      success: function(data){
        rptaCalculo = data;
      }
    });
  }
  return rptaCalculo;
}
///:: FIN CALCULO DE FECHAS :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///

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

///:: TERMINO FUNCIONES DE INASISTENCIAS ::::::::::::::::::::::::::::::::::::::::::::::::::///