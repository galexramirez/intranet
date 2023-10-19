///:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
///::::::::::::::::: DESPACHO FLOTA v 2.0 ::::::::::::::::::::///
///::::::::::::::::::: LLEGADA DE FLOTA ::::::::::::::::::::::///
///:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///

///::::::::::: Declaracion de Variables GLOBALES :::::::::::::///

var tablaInformeLlegada, Prog_FechaInformeLlegada, Prog_OperacionInformeLlegada, tipo_InformeLlegada;
  
///::::::::::::::: DOOM DESPACHO FLOTA :::::::::::::://
$(document).ready(function(){
  $("#tablaInformeLlegada").hide();
  
  Tipo='TIPO SALIDA';
  Operacion='DESPACHO FLOTA'; 
  selectHtml = "";
  selectHtml = f_TipoTabla(Operacion,Tipo);
  $("#tipo_InformeLlegada").html(selectHtml);

  Tipo='OPERACION';
  Operacion='LIMABUS'; 
  selectHtml = "";
  selectHtml = f_TipoTabla(Operacion,Tipo);
    $("#Prog_OperacionInformeLlegada").html(selectHtml);

});    


///:::::::::::::::::::::::::::: BOTONES LLEGADA FLOTA ::::::::::::::::::::::::::::::::::::::::::///

///::::::::: EVENTO BOTON BUSCAR LLEGADA FLOTA ::::::::::::::::::::::///       
$("#btnBuscarInformeLlegada").click(function(){
  Prog_FechaInformeLlegada = $("#Prog_FechaInformeLlegada").val();
  Prog_OperacionInformeLlegada = $("#Prog_OperacionInformeLlegada").val();
  tipo_InformeLlegada = $("#tipo_InformeLlegada").val();
  
  div_tabla = f_CreacionTabla("tablaInformeLlegada",tipo_InformeLlegada);
  $("#div_tablaInformeLlegada").html(div_tabla);
  columnastabla = f_ColumnasTabla("tablaInformeLlegada",tipo_InformeLlegada);

  Accion='BuscarInformeLlegada';
  $("#tablaInformeLlegada").dataTable().fnDestroy();
  $('#tablaInformeLlegada').show();

  tablaInformeLlegada = $('#tablaInformeLlegada').DataTable({
    language: idiomaEspanol,
    responsive: "true",
    dom: 'Blfrtip', // Con Botones Excel,Pdf,Print
    pageLength: 100,
    buttons:
      [
        {
        extend:     'excelHtml5',
        text:       '<i class="fas fa-file-excel"></i> ',
        titleAttr:  'Exportar a Excel',
        className:  'btn btn-success'
        },
        {
          extend:     'pdfHtml5',
          text:       '<i class="fas fa-file-pdf"></i> ',
          titleAttr:  'Exportar a PDF',
          className:  'btn btn-danger',
          orientation: 'landscape',
          pagaSize: 'A4',
          title: 'LLEGADA FLOTA '+Prog_FechaInformeLlegada
        },
      ],
    "ajax":{            
      "url": "Ajax.php", 
      "method": 'POST', //usamos el metodo POST
      "data":{MoS:MoS,NombreMoS:NombreMoS,Accion:Accion,Prog_Fecha:Prog_FechaInformeLlegada, Prog_Operacion:Prog_OperacionInformeLlegada, tipo_InformeLlegada:tipo_InformeLlegada}, 
      "dataSrc":""
    },
    "columns":columnastabla,
    "order": [[4, 'asc']]
  });
});
///::::::::::::::::::::::::: FUNCIONES LLEGADA FLOTA ::::::::::::::::::::::::::::::::::::::::::///

