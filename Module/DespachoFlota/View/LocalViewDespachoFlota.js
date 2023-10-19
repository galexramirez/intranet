///::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
///:: DESPACHO FLOTA 2023-04-01 :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
///:: INFORME DESPACHO DE FLOTA v 3.0 :::::::::::::::::::::::::::::::::::::::::::::::::::::///
///::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///

///:: DECLARACION VARIABLES GLOBALES ::::::::::::::::::::::::::::::::::::::::::::::::::::::///
var tablaInformeDespacho;

///:: DOM DESPACHO FLOTA ::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
$(document).ready(function(){
  Tipo        = 'OPERACION';
  Operacion   = 'LIMABUS'; 
  selectHtml  = "";
  selectHtml  = f_TipoTabla(Operacion,Tipo);
  $("#Prog_OperacionInformeDespacho").html(selectHtml);

  $("#Prog_FechaInformeDespacho").on('change', function () {
    $("#div_tablaInformeDespacho").empty();
    Prog_FechaInformeDespacho     = $("#Prog_FechaInformeDespacho").val();
    Prog_OperacionInformeDespacho = $("#Prog_OperacionInformeDespacho").val(); 
    selectHtml                    = "";
    selectHtml                    = f_TurnoInformeDespacho(Prog_FechaInformeDespacho,Prog_OperacionInformeDespacho);
    $("#turno_InformeDespacho").html(selectHtml);
    $("#turno_InformeDespacho").val("");
  });

  $("#Prog_OperacionInformeDespacho").on('change', function () {
    $("#div_tablaInformeDespacho").empty();
    Prog_FechaInformeDespacho     = $("#Prog_FechaInformeDespacho").val();
    Prog_OperacionInformeDespacho = $("#Prog_OperacionInformeDespacho").val(); 
    selectHtml                    = "";
    selectHtml                    = f_TurnoInformeDespacho(Prog_FechaInformeDespacho,Prog_OperacionInformeDespacho);
    $("#turno_InformeDespacho").html(selectHtml);
    $("#turno_InformeDespacho").val("");
  });

  $("#turno_InformeDespacho").on('change', function () {
    $("#div_tablaInformeDespacho").empty();
  });

});    
///:: TERMINO DOM DESPACHO FLOTA ::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///


///:: BOTONES DESPACHO FLOTA ::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///

///:: EVENTO BOTON BUSCAR DESPACHO FLOTA ::::::::::::::::::::::::::::::::::::::::::::::::::///       
$("#btnBuscarInformeDespacho").click(function(){
  Prog_FechaInformeDespacho     = $("#Prog_FechaInformeDespacho").val();
  Prog_OperacionInformeDespacho = $("#Prog_OperacionInformeDespacho").val();
  turno_InformeDespacho         = $("#turno_InformeDespacho").val();
  
  div_tabla     = f_CreacionTabla("tablaInformeDespacho","");
  $("#div_tablaInformeDespacho").html(div_tabla);
  columnastabla = f_ColumnasTabla("tablaInformeDespacho","")

  Accion  = 'BuscarInformeDespacho';
  $("#tablaInformeDespacho").dataTable().fnDestroy();
  $('#tablaInformeDespacho').show();
  
  tablaInformeDespacho = $('#tablaInformeDespacho').DataTable({
    //Color a las filas
    "rowCallback":function(row,data,index)
    {
      f_ColorFilasDespachoFlota(row,data);
    }, 
    language      : idiomaEspanol,
    responsive    : "true",
    dom           : 'Blfrtip', // Con Botones Excel,Pdf,Print
    pageLength    : 100,
    buttons       : [
      {
        extend    : 'excelHtml5',
        text      : '<i class="fas fa-file-excel"></i> ',
        titleAttr : 'Exportar a Excel',
        className : 'btn btn-success',
        title     : 'DESPACHO FLOTA '+Prog_FechaInformeDespacho
      },
    ],
    "ajax"        : {            
      "url"       : "Ajax.php", 
      "method"    : 'POST', 
      "data"      : {MoS:MoS,NombreMoS:NombreMoS,Accion:Accion,Prog_Fecha:Prog_FechaInformeDespacho,Prog_Operacion:Prog_OperacionInformeDespacho,turno_InformeDespacho:turno_InformeDespacho},
      "dataSrc"   : ""
    },
    "columns"     : columnastabla,
    "order"       : [[8, 'asc']]
  });
});
///:: FIN EVENTO BOTON BUSCAR DESPACHO FLOTA ::::::::::::::::::::::::::::::::::::::::::::::///

///:: TERMINO BOTONES DESPACHO FLOTA ::::::::::::::::::::::::::::::::::::::::::::::::::::::///


///:: FUNCIONES DESPACHO FLOTA ::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///

///:::::::: INVISIBILIZA LOS MENSAJE DE ALERTA DEL FORMULARIO :::::: /// 
function f_ValidaInformeDespachoFlota(){
}

function f_LimpiaInformeDespachoFlota(){
}

function f_TurnoInformeDespacho(Prog_FechaInformeDespacho,Prog_OperacionInformeDespacho){
  let rptaTurno = "";
  Accion        = 'TurnoInformeDespacho';
  $.ajax({
        url       : "Ajax.php",
        type      : "POST",
        datatype  : "json",
        async     : false,
        data      : { MoS:MoS,NombreMoS:NombreMoS,Accion:Accion,Prog_Fecha:Prog_FechaInformeDespacho,Prog_Operacion:Prog_OperacionInformeDespacho },
        success   : function(data) {
          rptaTurno = data;
        }
  });
  return rptaTurno;
}

function f_ColorFilasDespachoFlota(row,data){
  let color_rojo  = "#E26A5A";
  let color_verde = "#009390";
  let color_azul  = "#005EA4";
  
  // Columna Hora Entrega
  $("td:eq(4)",row).css({
    "color":color_verde,
  });

  // Columna Status
  if(data.Repo_Status == 'RETRASO') {
    $("td:eq(11)",row).css({
      "color":color_rojo,
    });
  }
}

///:: TERMINO FUNCIONES DESPACHO FLOTA ::::::::::::::::::::::::::::::::::::::::::::::::::::///