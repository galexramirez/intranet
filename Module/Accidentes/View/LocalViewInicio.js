///::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
///:::::::::::::::::::: INICIO v 3.0 2022-08-01 :::::::::::::::::::::::::///
///::::::::::::: VARIABLES Y FUNCIONES GLOBALES :::::::::::::::::::::::::///
///::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///

///::::::::::: Declaracion de Variables GLOBALES ::::::::::::::::::::::::///

// MoS: Module o Services, NombreMoS: Nombre del modulo o servicio, Accion: Funcion a ejecutar
var MoS, NombreMoS, Accion, div_tabs, div_tablas, div_boton, div_show, columnastabla;
// Variable para cambiar el lenguaje a español de un datatable
var idiomaEspanol, mi_carpeta;

MoS           = "Module";
NombreMoS     = "Accidentes";
mi_carpeta = f_DocumentRoot();
idiomaEspanol = {
  "lengthMenu"  : "&nbsp&nbsp&nbsp&nbspMostrar _MENU_ registros",
  "zeroRecords" : "No se encuentran resultados",
  "info"        : "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
  "infoEmpty"   : "Mostrando registros del 0 al 0 de un total de 0 registros",
  "infoFiltered": "(Filtrado de un total de _MAX_ registros)",
  "sSearch"     : "Buscar:",
  "oPaginate"   : 
    {
      "sFirst"  : "Primero",
      "sLast"   : "Ultimo",
      "sNext"   : "Siguiente",
      "sPrevious" : "Anterior"
    },
  "select"      :
    {
      "rows"    :
      {
        "_"     : "Seleccionadas %d filas",
        "0"     : "Click a una fila para seleccionarla",
        "1"     : "Seleccionada 1 fila"
      }
    },
  "sProcessing" : "Procesando...",
};

///::::::::: ACTIVA LOS TABS ::::::::::::: ///
$(document).ready(function() {
  div_show = f_MostrarDiv("contenido", "div_alertsDropdown_ayuda", NombreMoS);
  $("#div_alertsDropdown_ayuda").html(div_show);

  div_tabs = f_CreacionTabs("nav-tab-Accidentes","");
  $("#nav-tab-Accidentes").html(div_tabs);

  $("#nav-tab-Accidentes").tabs();
});

///::::::::::::::::::::::::::::::::: FUNCIONES GLOBALES :::::::::::::::::::::::::::::::::::///

function f_selectNovedad(Prog_Fecha,Prog_Operacion,ControlFacilitador_Id){
  let rptaSelectNovedad="";
  Accion='SelectNovedad';
  $.ajax({
    url: "Ajax.php",
    type: "POST",
    datatype:"json",
    async: false,    
    data: {MoS:MoS,NombreMoS:NombreMoS,Accion:Accion,Prog_Fecha:Prog_Fecha,Prog_Operacion:Prog_Operacion,ControlFacilitador_Id:ControlFacilitador_Id},    
    success: function(data){
      rptaSelectNovedad=data;

    }
  });
  return rptaSelectNovedad;  
}

function f_TipoTabla(p_Operacion,p_Tipo){
  let rptaSelect  = "";
  Accion          = 'SelectTipos';
  $.ajax({
    url       : "Ajax.php",
    type      : "POST",
    datatype  : "json",
    async     : false,
    data      : {MoS:MoS,NombreMoS:NombreMoS,Accion:Accion,TtablaAccidentes_Operacion:p_Operacion,TtablaAccidentes_Tipo:p_Tipo},    
    success   : function(data){
      rptaSelect = data;
    }
  });
  return rptaSelect;
}

function f_MatrizAccidentes(pacmt_campo,pacmt_busqueda){
  let rptaMatrizAccidentes="";
  // SE BUSCA Y CARGA LA ACCION DISCIPLINARIA SEGUN LA MATRIZ DISCIPLINARIA EN TABLA ope_accidentesmatriz
  Accion='AccionDisciplinaria';
  $.ajax({
    url: "Ajax.php",
    type: "POST",
    datatype:"json",
    async: false,
    data: {MoS:MoS,NombreMoS:NombreMoS,Accion:Accion,acmt_campo:pacmt_campo,acmt_busqueda:pacmt_busqueda},
    success: function(data){
      rptaMatrizAccidentes = data;
    }
  });
  return rptaMatrizAccidentes;
}

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

function f_antiguedad(p_inicio,p_final){
  let rpta_antiguedad="";
  Accion='antiguedad';
  $.ajax({
    url     : "Ajax.php",
    type    : "POST",
    datatype: "json",
    async   : false,
    data    : {MoS:MoS,NombreMoS:NombreMoS,Accion:Accion,inicio:p_inicio,final:p_final},
    success : function(data){
      rpta_antiguedad = data;
    }
  });
  return rpta_antiguedad;
}

///:: FUNCION CANTIDAD DE HORAS TRABAJADAS HASTA UNA HORA DETERMINADA :::::::::::::::::::::///
function f_horas_trabajadas(p_operacion, p_fecha, p_dni, p_hora){
  let rpta_horas_trabajadas = "";
  Accion = 'horas_trabajadas';
  $.ajax({
    url       : "Ajax.php",
    type      : "POST",
    datatype  : "json",
    async     : false,
    data      : {MoS:MoS, NombreMoS:NombreMoS, Accion:Accion, operacion:p_operacion, fecha:p_fecha, dni:p_dni, hora:p_hora},    
    success: function(data){
      rpta_horas_trabajadas = data;
    }
  });
  return rpta_horas_trabajadas;
}

function f_km_perdidos(p_Accidentes_Id, p_operacion, p_bus, p_fecha_operacion){
  let rpta_km_perdidos = "";
  Accion = 'km_perdidos';
  $.ajax({
    url       : "Ajax.php",
    type      : "POST",
    datatype  : "json",
    async     : false,
    data      : {MoS:MoS, NombreMoS:NombreMoS, Accion:Accion, Accidentes_Id:p_Accidentes_Id, operacion:p_operacion, bus:p_bus, fecha_operacion:p_fecha_operacion},    
    success: function(data){
      rpta_km_perdidos = data;
    }
  });
  return rpta_km_perdidos;
}

function f_select_usuario(p_usua_perfil){
  let rpta_select_usuario = "";
  Accion = 'SelectUsuario';
  $.ajax({
    url       : "Ajax.php",
    type      : "POST",
    datatype  : "json",
    async     : false,
    data      : {MoS:MoS,NombreMoS:NombreMoS,Accion:Accion,Usua_Perfil:p_usua_perfil},    
    success   : function(data){
      rpta_select_usuario = data;
    }
  });
  return rpta_select_usuario;
}

function f_permisos(p_nombre_modulo, p_nombre_objeto){
  let rpta_permisos = "";
  Accion = 'permisos';
  $.ajax({
    url       : "Ajax.php",
    type      : "POST",
    datatype  : "json",
    async     : false,
    data      : {MoS:MoS, NombreMoS:NombreMoS, Accion:Accion, nombre_modulo:p_nombre_modulo, nombre_objeto:p_nombre_objeto},    
    success   : function(data){
      rpta_permisos = data;
    }
  });
  return rpta_permisos;
}

///:: BUSCAR DATA EN BD :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
function f_BuscarDataBD(pTablaBD,pCampoBD,pDataBuscar){
  let rptaData;
  Accion = 'BuscarDataBD';
  $.ajax({
    url         : "Ajax.php",
    type        : "POST",
    datatype    : "json",
    async       : false,
    data        : {MoS:MoS,NombreMoS:NombreMoS,Accion:Accion,TablaBD:pTablaBD,CampoBD:pCampoBD,DataBuscar:pDataBuscar},    
    success     : function(data){
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

///::::::::::::::: FUNCIONES PARA LA CREACION DE ACCESOS ::::::::::::::::::::::::::::::::::///
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

///::::::::::::::: FIN DE FUNCIONES PARA LA CREACION DE ACCESOS ::::::::::::::::::::::::::::///