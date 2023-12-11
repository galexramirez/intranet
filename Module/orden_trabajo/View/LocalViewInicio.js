///::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
///:: OT CORRECTIVAS v 3.0 FECHA: 14-06-2023 ::::::::::::::::::::::::::::::::::::::::::::::///
///:: CREAR, EDITAR, ELIMINAR TABLA DE OT CORRECTIVAS :::::::::::::::::::::::::::::::::::::///
///::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///

///:: Declaracion de Variables ::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
var MoS, NombreMoS, Accion, idiomaEspanol, div_tabs, div_tablas, div_boton, div_show, columnastabla, mi_carpeta;
MoS       = 'Module';
NombreMoS = 'orden_trabajo';
mi_carpeta      = f_DocumentRoot();
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
    "sProcessing" : "Procesando...",
};

///:: JS DOM OT CORRECTIVAS :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
$(document).ready(function(){
  div_show = f_MostrarDiv("contenido", "div_alertsDropdown_ayuda", NombreMoS, "");
  $("#div_alertsDropdown_ayuda").html(div_show);

  div_tabs = f_CreacionTabs("nav-tab-OTCorrectivas","");
  $("#nav-tab-OTCorrectivas").html(div_tabs);

  div_tabs = f_CreacionTabs("nav-tab-ajustes_ot","");
  $("#nav-tab-ajustes_ot").html(div_tabs);

  $( "#tabs" ).tabs();
});


///:: FUNCIONES DE OT CORRECTIVAS ::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
function f_TipoTabla(p_Operacion,p_Tipo){
  let rptaSelect="";
  Accion='SelectTipos';
  $.ajax({
    url: "Ajax.php",
    type: "POST",
    datatype:"json",
    async: false,
    data: {MoS:MoS,NombreMoS:NombreMoS,Accion:Accion,ttablaotcorrectivas_operacion:p_Operacion,ttablaotcorrectivas_tipo:p_Tipo},    
    success: function(data){
      rptaSelect = data;
    }
  });
  return rptaSelect;
}

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

function f_MayorFecha(p_inicio,p_final){
  let rptaMayor="";
  Accion='MayorFecha';
  $.ajax({
    url: "Ajax.php",
    type: "POST",
    datatype:"json",
    async: false,
    data: {MoS:MoS,NombreMoS:NombreMoS,Accion:Accion,inicio:p_inicio,final:p_final},    
    success: function(data){
      rptaMayor = data;
    }
  });
  return rptaMayor;
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

///:: FIN DE CALCULO DE FECHAS ::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///

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
///:: FIN DE SELECT DE USUARIOS :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///

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

function f_MostrarDiv(pNombreFormulario,pNombreObjeto,pDato1, pDato2){
  let rptaMostrarDiv="";
  Accion='MostrarDiv';
  $.ajax({
    url: "Ajax.php",
    type: "POST",
    datatype:"json",
    async: false,
    data: {MoS:MoS,NombreMoS:NombreMoS,Accion:Accion,NombreFormulario:pNombreFormulario,NombreObjeto:pNombreObjeto,Dato1:pDato1, Dato2:pDato2},    
    success: function(data){
      rptaMostrarDiv = data;
    }
  });
  return rptaMostrarDiv;
}
///:: FIN DE FUNCIONES ACCESOS ::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///

///:: TERMINO DE FUNCIONES DE OT CORRECTIVAS ::::::::::::::::::::::::::::::::::::::::::::::///