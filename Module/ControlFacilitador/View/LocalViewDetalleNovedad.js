///::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
///:::::::::::::::::: TAB DETALLE NOVEDADES v 2.0  FECHA: 05/02/2022 ::::::::::::::::::::::///
///:::::::EDITAR Y MOSTRAR LOS EVENTOS Y SUS NOVEDADES ::::::::::::::::::::::::::::::::::::///
///::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///

///::::::::::::::::::::::::::::::: Declaracion de Variables :::::::::::::::::::::::::::::::///

var tablaNovedadCarga, filaNovedad, Nove_TipoOperacionCarga;

///::::::::::::::::::::::::: DOM NOVEDAD :::::::::::::::::::::::::::::::::::::::::::::::::///

$(document).ready(function(){
  xtm = '0'+(fecha_hoy.getMonth()+1);
  xtd = '0'+fecha_hoy.getDate();
  Nove_FechaOperacion = fecha_hoy.getFullYear()+'-'+xtm.substr(-2)+'-'+xtd.substr(-2);
  $("#Nove_FechaOperacion").val(Nove_FechaOperacion);

  //$('#tablaDetalleNovedad').hide();
});

///:::::::::::::::::::::::::::: BOTONES NOVEDAD ::::::::::::::::::::::::::::::::::::::::::///

///:::::::::::::::::::::::: JS DATA TABLE NOVEDAD CARGA ::::::::::::::::::::::::::::::::::///

///::::::::  BOTON BUSCAR DETALLE DE NOVEDAD  ::::::::::///
$("#btnBuscarDetalleNovedad").on("click",function(){
  Nove_FechaOperacion = $("#Nove_FechaOperacion").val();
  let a_detalle_novedad = f_BuscarDataBD('OPE_ControlFacilitadorRegistroCarga','CFaRg_FechaCargada',Nove_FechaOperacion);
  let estado_cerrado = "";
  let estado_generado = "";
  let ver_detalle_novedad = "invalido";

  // Generamos la tabla Detalle de Novedad
  div_tablas = f_CreacionTabla("tablaDetalleNovedad","");
  $('#div_tablaDetalleNovedad').html(div_tablas);

  columnastabla = f_ColumnasTabla("tablaDetalleNovedad","");

  $("#tablaDetalleNovedad").dataTable().fnDestroy();
  $('#tablaDetalleNovedad').show();

  $.each(a_detalle_novedad, function(idx, obj){ 
    if(obj.CFaRg_Estado=='CERRADO'){
      estado_cerrado = "CERRADO";
    }
    if(obj.CFaRg_Estado=="GENERADO"){
      estado_generado = "GENERADO";
    }
  });

  if(estado_cerrado=="CERRADO" && estado_generado==""){
    Accion = 'detalle_novedad_carga_hist';
    ver_detalle_novedad = "";
  }
  if(estado_cerrado=="" && estado_generado=="GENERADO"){
    Accion = 'DetalleNovedadCarga';  
    ver_detalle_novedad = "";
  }

  if(ver_detalle_novedad=="invalido"){
    Swal.fire(
      'CONTROL FACILITADOR!',
      'El Control Facilitador se encuentra parcialmente cerrado.',
      'success'
    )
    $('#div_tablaDetalleNovedad').html("");

  }else{
    tablaDetalleNovedad = $('#tablaDetalleNovedad').DataTable({
      //Color a las filas
      "rowCallback":function(row,data,index)
      {
        fColorFilasDetalleNovedad(row,data);
      }, 
          //Filtros por columnas
          orderCellsTop: true,
          fixedHeader: true,
          initComplete: function (){
            var api = this.api();
            // For each column
            api.columns().eq(0).each(function (colIdx) {
              // Set the header cell to contain the input element
              var cell = $('.filtersDetalleNovedad th').eq($(api.column(colIdx).header()).index());
              var title = $(cell).text();
              $(cell).html('<input type="text" placeholder="' + title + '" />');
              // On every keypress in this input
              $('input',$('.filtersDetalleNovedad th').eq($(api.column(colIdx).header()).index()) ).off('keyup change').on('keyup change', function (e) {
                e.stopPropagation();
                // Get the search value
                $(this).attr('title', $(this).val());
                var regexr = '({search})'; //$(this).parents('th').find('select').val();
                var cursorPosition = this.selectionStart;
                // Search the column for that value
                api.column(colIdx).search(
                  this.value != '' ? regexr.replace('{search}', '(((' + this.value + ')))'): '',
                  this.value != '',
                  this.value == ''
                ).draw();
                $(this).focus()[0].setSelectionRange(cursorPosition, cursorPosition);
              });
            });
          },
      "processing": true,
      //Para cambiar el lenguaje a español
      language: idiomaEspanol,
      //Para usar los botones
      responsive: "true",
      dom: 'Blfrtip', // Con Botones Excel,Pdf,Print
      //Para mostrar 50 registros popr página 
      pageLength: 50,
      buttons:
        [
          {
            extend:     'excelHtml5',
            text:       '<i class="fas fa-file-excel"></i> ',
            titleAttr:  'Exportar a Excel',
            className:  'btn btn-success',
            title       : 'DETALLE DE NOVEDADES'
          },
        ],
      "ajax":{            
                "url": "Ajax.php", 
                "method": 'POST', //usamos el metodo POST
                "data":{MoS:MoS,NombreMoS:NombreMoS,Accion:Accion,Nove_FechaOperacion:Nove_FechaOperacion}, //enviamos opcion 4 para que haga un SELECT
                "dataSrc":""
              },
      "columns":columnastabla,
      "order": [[0, 'asc'],[14, 'asc']]
    });  
  }
});

///::::::::::::::::::::::::: FUNCIONES DETALLE NOVEDAD ::::::::::::::::::::::::::::::::::::::::::///

function fColorFilasDetalleNovedad(row,data){
  color_azul      = '#4472c4';
  color_verde     = '#218838';
  color_rojo      = 'red';
  color_naranja   = 'orange';
  
  // Columna Estado Novedad
  if(data.CFaci_Estado == 'EDITADO') {
    $("td:eq(35)",row).css({
      "color": color_azul,  //"#4472c4", // azul
    });
  }
  if(data.CFaci_Estado == 'ANULADO') {
    $("td:eq(35)",row).css({
      "color": color_naranja,
    });
  }

  // Columna Id de Programacion de Novedad
  if(data.colProgId == 1) {
    $("td:eq(1)",row).css({
      "color": color_verde,  //"#218838", // verde
    });
  }

  // Columna Codigo Piloto
  if((data.Prog_CodigoColaborador_ant != data.Prog_CodigoColaborador) && data.Prog_CodigoColaborador_ant != null) {
    $("td:eq(2)",row).css({
      "color": color_rojo,
    });
    $("td:eq(17)",row).css({
      "color": color_rojo,
    });
  }

  // Columna Nombre Piloto
  if((data.Prog_NombreColaborador_ant != data.Prog_NombreColaborador) && data.Prog_NombreColaborador_ant != null) {
    $("td:eq(3)",row).css({
      "color": color_rojo,
    });
    $("td:eq(18)",row).css({
      "color": color_rojo,
    });
  }

  // Columna Tabla
  if((data.Prog_Tabla_ant != data.Prog_Tabla) && data.Prog_Tabla_ant != null) {
    $("td:eq(4)",row).css({
      "color": color_rojo,
    });
    $("td:eq(19)",row).css({
      "color": color_rojo,
    });
  }

  // Columna Hora Origen
  if((data.Prog_HoraOrigen_ant != data.Prog_HoraOrigen) && data.Prog_HoraOrigen_ant != null) {
    $("td:eq(5)",row).css({
      "color": color_rojo,
    });
    $("td:eq(20)",row).css({
      "color": color_rojo,
    });
  }

  // Columna Hora Destino
  if((data.Prog_HoraDestino_ant != data.Prog_HoraDestino) && data.Prog_HoraDestino_ant != null) {
    $("td:eq(6)",row).css({
      "color": color_rojo,
    });
    $("td:eq(21)",row).css({
      "color": color_rojo,
    });
  }

  // Columna Servicio
  if((data.Prog_Servicio_ant != data.Prog_Servicio) && data.Prog_Servicio_ant != null) {
    $("td:eq(7)",row).css({
      "color": color_rojo,
    });
    $("td:eq(21)",row).css({
      "color": color_rojo,
    });
  }

  // Columna ServBus
  if((data.Prog_ServBus_ant != data.Prog_ServBus) && data.Prog_ServBus_ant != null) {
    $("td:eq(8)",row).css({
      "color": color_rojo,
    });
    $("td:eq(22)",row).css({
      "color": color_rojo,
    });
  }

  // Columna Bus
  if((data.Prog_Bus_ant != data.Prog_Bus) && data.Prog_Bus_ant != null) {
    $("td:eq(9)",row).css({
      "color": color_rojo,
    });
    $("td:eq(24)",row).css({
      "color": color_rojo,
    });
  }

  // Columna Lugar Origen 
  if((data.Prog_LugarOrigen_ant != data.Prog_LugarOrigen) && data.Prog_LugarOrigen_ant != null) {
    $("td:eq(10)",row).css({
      "color": color_rojo,
    });
    $("td:eq(25)",row).css({
      "color": color_rojo,
    });
  }

  // Columna Lugar Destino
  if((data.Prog_LugarDestino_ant != data.Prog_LugarDestino) && data.Prog_LugarDestino_ant != null) {
    $("td:eq(11)",row).css({
      "color": color_rojo,
    });
    $("td:eq(26)",row).css({
      "color": color_rojo,
    });
  }

  // Columna Evento
  if((data.Prog_Evento_ant != data.Prog_Evento) && data.Prog_Evento_ant != null) {
    $("td:eq(12)",row).css({
      "color": color_rojo,
    });
    $("td:eq(27)",row).css({
      "color": color_rojo,
    });
  }

  // Columna Observaciones
  if((data.Prog_Observaciones_ant != data.Prog_Observaciones) && data.Prog_Observaciones_ant != null) {
    $("td:eq(13)",row).css({
      "color": color_rojo,
    });
    $("td:eq(28)",row).css({
      "color": color_rojo,
    });
  }

  // Columna KmXPuntos 
  if((data.Prog_KmXPuntos_ant != data.Prog_KmXPuntos) && data.Prog_KmXPuntos_ant != null) {
    $("td:eq(14)",row).css({
      "color": color_rojo,
    });
    $("td:eq(29)",row).css({
      "color": color_rojo,
    });
  }

  // Columna Sentido
  if((data.Prog_Sentido_ant != data.Prog_Sentido) && data.Prog_Sentido_ant != null) {
    $("td:eq(15)",row).css({
      "color": color_rojo,
    });
    $("td:eq(30)",row).css({
      "color": color_rojo,
    });
  }

  // Columna Id Manto
  if((data.Prog_IdManto_ant != data.Prog_IdManto) && data.Prog_IdManto_ant != null) {
    $("td:eq(16)",row).css({
      "color": color_rojo,
    });
    $("td:eq(31)",row).css({
      "color": color_rojo,
    });
  }

}