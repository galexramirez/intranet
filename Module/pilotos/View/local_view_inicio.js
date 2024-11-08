///::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
///:: DESEMPEÑO PILOTO v1.0 FECHA: 2023-10-21 :::::::::::::::::::::::::::::::::::::::::::::///
//::: INFORMACION GRAFICA DE INASISTENCIAS, COMPORTAMIENTO Y ACCIDENTES DEL PILOTO ::::::::///
///::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///

///:: DECLARACION DE VARIABLES ::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
var MoS, NombreMoS, Accion, idioma_espanol, div_tabs, div_tablas, div_boton, div_show, columnastabla, data_BD, mi_carpeta;
var lat, long, msg;
mi_carpeta = f_DocumentRoot();
MoS = 'Module';
NombreMoS = 'pilotos';
idioma_espanol = {
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

$(document).ready(function () {
  window.addEventListener('load', function () {
    navigator.geolocation.getCurrentPosition(geoposOK, geoposKO);
  });

  div_show = f_MostrarDiv("contenido", "div_alertsDropdown_ayuda", NombreMoS);
  $("#div_alertsDropdown_ayuda").html(div_show);

  div_tabs = f_CreacionTabs("nav-tab-comunicado","");
  $("#div_nav-tab-comunicado").html(div_tabs);
});

///:: FUNCIONES GENERALES PARA DESEMPEÑO DE PILOT0 ::::::::::::::::::::::::::::::::::::::::///

function f_DocumentRoot() {
  let rptaMiCarpeta = '';
  Accion = 'DocumentRoot';
  $.ajax({
    url: "Ajax.php",
    type: "POST",
    datatype: "json",
    async: false,
    data: { MoS: MoS, NombreMoS: NombreMoS, Accion: Accion },
    success: function (data) {
      rptaMiCarpeta = data;
    }
  });
  return rptaMiCarpeta;
}

function f_DNI() {
  let rpta_dni = '';
  Accion = 'usuario_id';
  $.ajax({
    url: "Ajax.php",
    type: "POST",
    datatype: "json",
    async: false,
    data: { MoS: MoS, NombreMoS: NombreMoS, Accion: Accion },
    success: function (data) {
      rpta_dni = data;
    }
  });
  return rpta_dni;
}

///:: CALCULO DE FECHAS :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
function f_CalculoFecha(p_inicio, p_calculo) {
  let rptaFecha = "";
  Accion = 'CalculoFecha';
  $.ajax({
    url: "Ajax.php",
    type: "POST",
    datatype: "json",
    async: false,
    data: { MoS: MoS, NombreMoS: NombreMoS, Accion: Accion, inicio: p_inicio, calculo: p_calculo },
    success: function (data) {
      rptaFecha = data;
    }
  });
  return rptaFecha;
}

function f_DiferenciaFecha(p_inicio, p_final, p_dias) {
  let rptaDiferencia = "";
  Accion = 'DiferenciaFecha';
  $.ajax({
    url: "Ajax.php",
    type: "POST",
    datatype: "json",
    async: false,
    data: { MoS: MoS, NombreMoS: NombreMoS, Accion: Accion, inicio: p_inicio, final: p_final, dias: p_dias },
    success: function (data) {
      rptaDiferencia = data;
    }
  });
  return rptaDiferencia;
}

///:: BUSCAR DATA EN BD :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
function f_BuscarDataBD(pTablaBD, pCampoBD, pDataBuscar) {
  let rptaData;
  Accion = 'BuscarDataBD';
  $.ajax({
    url: "Ajax.php",
    type: "POST",
    datatype: "json",
    async: false,
    data: { MoS: MoS, NombreMoS: NombreMoS, Accion: Accion, TablaBD: pTablaBD, CampoBD: pCampoBD, DataBuscar: pDataBuscar },
    success: function (data) {
      rptaData = $.parseJSON(data);
    }
  });
  return rptaData;
}

///:: AUTOCOMPLETADO ::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
function f_auto_completar(pNombreTabla, pNombreCampo) {
  let rpta_auto_completar = "";
  Accion = 'auto_completar';
  $.ajax({
    url: "Ajax.php",
    type: "POST",
    datatype: "json",
    async: false,
    data: { MoS: MoS, NombreMoS: NombreMoS, Accion: Accion, NombreTabla: pNombreTabla, NombreCampo: pNombreCampo },
    success: function (data) {
      rpta_auto_completar = $.parseJSON(data);
    }
  });
  return rpta_auto_completar;
}

function f_buscar_dato(p_nombre_tabla, p_campo_buscar, p_condicion_where) {
  let rpta_buscar = "";
  Accion = 'buscar_dato';
  $.ajax({
    url: "Ajax.php",
    type: "POST",
    datatype: "json",
    async: false,
    data: { MoS: MoS, NombreMoS: NombreMoS, Accion: Accion, nombre_tabla: p_nombre_tabla, campo_buscar: p_campo_buscar, condicion_where: p_condicion_where },
    success: function (data) {
      rpta_buscar = data;
    }
  });
  return rpta_buscar;
}

function f_ayuda_modulo(man_titulo) {
  let man_modulo_id = f_buscar_dato("Modulo", "Modulo_Id", "`Mod_Nombre` = '" + NombreMoS + "'");
  let manual_id = f_buscar_dato("glo_manual", "manual_id", "`man_modulo_id` = '" + man_modulo_id + "' AND `man_titulo` = '" + man_titulo + "'");
  let man_html = f_buscar_dato("glo_manual_html", "man_html", "`manual_id`='" + manual_id + "'");
  $("#div_ver_ayuda_html").html(man_html);

  $("#form_modal_ver_ayuda").trigger("reset");
  $(".modal-header").css("background-color", "#17a2b8");
  $(".modal-header").css("color", "white");
  $(".modal-title").text(man_titulo);
  $('#modal_crud_ver_ayuda').modal('show');
  $('#modal-resizable_ver_ayuda').resizable();
  $(".modal-dialog").draggable({
    cursor: "move",
    handle: ".dragable_touch",
  });
}

///:: FUNCIONES ACCESOS :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
function f_CreacionTabs(pNombreTabs, pTipoTabs) {
  let rptaTabs = "";
  Accion = 'CreacionTabs';
  $.ajax({
    url: "Ajax.php",
    type: "POST",
    datatype: "json",
    async: false,
    data: { MoS: MoS, NombreMoS: NombreMoS, Accion: Accion, NombreTabs: pNombreTabs, TipoTabs: pTipoTabs },
    success: function (data) {
      rptaTabs = data;
    }
  });
  return rptaTabs;
}

function f_CreacionTabla(pNombreTabla, pTipoTabla) {
  let rptaTabla = "";
  Accion = 'CreacionTabla';
  $.ajax({
    url: "Ajax.php",
    type: "POST",
    datatype: "json",
    async: false,
    data: { MoS: MoS, NombreMoS: NombreMoS, Accion: Accion, NombreTabla: pNombreTabla, TipoTabla: pTipoTabla },
    success: function (data) {
      rptaTabla = data;
    }
  });
  return rptaTabla;
}

function f_ColumnasTabla(pNombreTabla, pTipoTabla) {
  let rptaColumnas = "";
  Accion = 'ColumnasTabla';
  $.ajax({
    url: "Ajax.php",
    type: "POST",
    datatype: "json",
    async: false,
    data: { MoS: MoS, NombreMoS: NombreMoS, Accion: Accion, NombreTabla: pNombreTabla, TipoTabla: pTipoTabla },
    success: function (data) {
      rptaColumnas = $.parseJSON(data);
    }
  });
  return rptaColumnas;
}

function f_BotonesFormulario(pNombreFormulario, pNombreObjeto) {
  let rptaBotonesFormulario = "";
  Accion = 'BotonesFormulario';
  $.ajax({
    url: "Ajax.php",
    type: "POST",
    datatype: "json",
    async: false,
    data: { MoS: MoS, NombreMoS: NombreMoS, Accion: Accion, NombreFormulario: pNombreFormulario, NombreObjeto: pNombreObjeto },
    success: function (data) {
      rptaBotonesFormulario = data;
    }
  });
  return rptaBotonesFormulario;
}

function f_DivFormulario(pNombreFormulario, pNombreObjeto) {
  let rptaDivFormulario = "";
  Accion = 'DivFormulario';
  $.ajax({
    url: "Ajax.php",
    type: "POST",
    datatype: "json",
    async: false,
    data: { MoS: MoS, NombreMoS: NombreMoS, Accion: Accion, NombreFormulario: pNombreFormulario, NombreObjeto: pNombreObjeto },
    success: function (data) {
      rptaDivFormulario = data;
    }
  });
  return rptaDivFormulario;
}

function f_MostrarDiv(pNombreFormulario, pNombreObjeto, pDato) {
  let rptaMostrarDiv = "";
  Accion = 'MostrarDiv';
  $.ajax({
    url: "Ajax.php",
    type: "POST",
    datatype: "json",
    async: false,
    data: { MoS: MoS, NombreMoS: NombreMoS, Accion: Accion, NombreFormulario: pNombreFormulario, NombreObjeto: pNombreObjeto, Dato: pDato },
    success: function (data) {
      rptaMostrarDiv = data;
    }
  });
  return rptaMostrarDiv;
}

///:: FUNCIONES MARCACION GEOPOSICION :::::::::::::::::::::::::::::::::::::::::::::::::::::///
/** @param {GeolocationPosition} pos */
function geoposOK(pos) {
  lat = pos.coords.latitude;
  long = pos.coords.longitude;
}

/** @param {GeolocationPositionError} err */
function geoposKO(err) {
  console.warn(err.message);
  msg = "";
  switch (err.code) {
    case err.PERMISSION_DENIED:
      msg = "No nos has dado permiso para obtener tu posición";
      break;
    case err.POSITION_UNAVAILABLE:
      msg = "Tu posición actual no está disponible";
      break;
    case err.TIMEOUT:
      msg = "No se ha podido obtener tu posición en un tiempo prudencial";
      break;
    default:
      msg = "Error desconocido";
      break;
  }
}

///:: TERMINO FUNCIONES GENERALES PARA COMUNICADOS PILOTOS  ::::::::::::::::::::::::::::::///