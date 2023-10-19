///::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
///::::::::::::::::::: TAB REPORTE v 1.0 FECHA: 20-05-2022 ::::::::::::::::::::::::::::::::///
///::::::::::::: REPORTES DE OPERACION CONTROL FACILITADOR  :::::::::::::::::::::::::::::::///
///::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///

///::::::::::::::::::::::::::::::: Declaracion de Variables :::::::::::::::::::::::::::::::///
var fechaReporteop, tipoReporteop, operacionReporteop;
var tablaReporteop;
///::::::::::::::::::::::::: DOM TRONCAL :::::::::::::::::::::::::::::::::::::::::::::::::///

$(document).ready(function()
{
  xtm = '0'+(fecha_hoy.getMonth()+1);
  xtd = '0'+fecha_hoy.getDate();
  fechaReporteop = fecha_hoy.getFullYear()+'-'+xtm.substr(-2)+'-'+xtd.substr(-2);
  $("#fechaReporteop").val(fechaReporteop);

  // Si hay cambios en el Fecha se ocultan datatable
  $("#fechaReporteop").on('change', function () {
    $("#tablaReporteop").dataTable().fnDestroy();
    $('#tablaReporteop').hide();  
  });

  // Si hay cambios en el select de tipo de Reporteop se ocultan datatable
  $("#tipoReporteop").on('change', function () {
    $("#tablaReporteop").dataTable().fnDestroy();
    $('#tablaReporteop').hide();  
  });

  // Si hay cambios en el select de operacion de Reporteop se ocultan datatable
  $("#operacionReporteop").on('change', function () {
    $("#tablaReporteop").dataTable().fnDestroy();
    $('#tablaReporteop').hide();  
  });

  Tipo='REPORTEOP';
  Operacion='LIMABUS'; 
  selectHtml = "";
  selectHtml = f_TipoTabla(Operacion,Tipo)
  $("#tipoReporteop").html(selectHtml);

  Tipo='OPERACION';
  Operacion='LIMABUS'; 
  selectHtml = "";
  selectHtml = f_TipoTabla(Operacion,Tipo)
  $("#operacionReporteop").html(selectHtml);

});


///:::::::::::::::::::::::::::: BOTONES TRONCAL ::::::::::::::::::::::::::::::::::::::::::///

/// :::::::::::::::EVENTO BOTOM MOSTRAR DATATABLE CONTROLFACILITADOR TRONCAL :::::::::::::///
$("#btnBuscarReporteop").click(function(){    
  fechaReporteop = $("#fechaReporteop").val();
  
  let a_reporte_op = f_BuscarDataBD('OPE_ControlFacilitadorRegistroCarga','CFaRg_FechaCargada',fechaReporteop);
  let estado_cerrado = "";
  let estado_generado = "";
  let ver_reporte_op = "invalido";

  tipoReporteop = $("#tipoReporteop").val();
  operacionReporteop = $("#operacionReporteop").val();
  let orderTabla = [[0, 'asc']];
  let div_tabla = "";
  let columnasTabla = "";
  if(tipoReporteop=="HISTORIAL CAMBIOS"){
    orderTabla = [[0, 'asc'],[20, 'asc']];
  }
  div_tabla = f_CreacionTabla("tablaReporteop",tipoReporteop);
  columnasTabla = f_ColumnasTabla("tablaReporteop",tipoReporteop);
  $('#div_tablaReporteop').html(div_tabla);
  $("#tablaReporteop").dataTable().fnDestroy();
  $('#tablaReporteop').show();
  
  // Setup - add a text input to each footer cell
  $('#tablaReporteop thead tr')
    .clone(true)
    .addClass('filtersReporteop')
    .appendTo('#tablaReporteop thead');

  $.each(a_reporte_op, function(idx, obj){ 
    if(obj.CFaRg_Estado=='CERRADO'){
      estado_cerrado = "CERRADO";
    }
    if(obj.CFaRg_Estado=="GENERADO"){
      estado_generado = "GENERADO";
    }
  });

  if(estado_cerrado=="CERRADO" && estado_generado==""){
    Accion = 'reporte_op_hist';
    ver_reporte_op = "";
  }
  if(estado_cerrado=="" && estado_generado=="GENERADO"){
    Accion = 'Reporteop';
    ver_reporte_op = "";
  }

  if(ver_reporte_op=="invalido"){
    Swal.fire(
      'CONTROL FACILITADOR!',
      'El Control Facilitador no se encuentra cerrado.',
      'success'
    )
    $('#div_tablaReporteop').html("");
  }else{
    tablaReporteop = $('#tablaReporteop').DataTable({
      //Color a las filas
      "rowCallback":function(row,data,index)
      {
        fColorFilasReporteop(row,data);
      }, 
      //Filtros por columnas
      orderCellsTop: true,
      fixedHeader: true,
      initComplete: function (){
        var api = this.api();
        // For each column
        api.columns().eq(0).each(function (colIdx) {
          // Set the header cell to contain the input element
          var cell = $('.filtersReporteop th').eq($(api.column(colIdx).header()).index());
          var title = $(cell).text();
          $(cell).html('<input type="text" placeholder="' + title + '" />');
          // On every keypress in this input
          $('input',$('.filtersReporteop th').eq($(api.column(colIdx).header()).index()) ).off('keyup change').on('keyup change', function (e) {
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
      // Para mostrar la barra scroll horizontal y vertical
      deferRender:    true,
      scrollY:        800,
      scrollCollapse: true,
      scroller:       true,
      scrollX:        true,
      fixedColumns:
      {
        left: 1
      },
      fixedHeader:
      {
        header : false
      },
      select:{style: 'os'},
      //Para mostrar 50 registros popr página 
      pageLength: 100,
      //Para cambiar el lenguaje a español
      language: idiomaEspanol,
      //Para usar los botones
      responsive: "true",
      dom: 'Blfrtip', // Con Botones Excel,Pdf,Print
      buttons:[
        {
          extend:     'excelHtml5',
          text:       '<i class="fas fa-file-excel"></i> ',
          titleAttr:  'Exportar a Excel',
          className:  'btn btn-success',
          title       : 'REPORTE '+tipoReporteop+' '+operacionReporteop+' DEL '+fechaReporteop
        },
      ],
      "ajax":{            
        "url": "Ajax.php", 
        "method": 'POST', //usamos el metodo POST
        "data":{ MoS:MoS,NombreMoS:NombreMoS,Accion:Accion,fechaReporteop:fechaReporteop,tipoReporteop:tipoReporteop,operacionReporteop:operacionReporteop }, //enviamos opcion 4 para que haga un SELECT
        "dataSrc":"",
      },
      "columns":columnasTabla,
      "order": orderTabla
    });  
  }
});     

///::::::::::::::::::::::::: FUNCIONES TRONCAL ::::::::::::::::::::::::::::::::::::::::::///
function fColorFilasReporteop(row,data){
  let color_rojo = "#E26A5A";
  let color_verde = "#009390";
  let color_azul = "#005EA4";
  // Columna TipoTabla
  if(data.Prog_TipoTabla == 'AM') {
    $("td:eq(14)",row).css({
      "color":color_azul,
    });
    $("td:eq(1)",row).css({
      "color":color_azul,
    });
    $("td:eq(2)",row).css({
      "color":color_azul,
    });
  }
  if(data.Prog_TipoTabla == 'HP') {
    $("td:eq(14)",row).css({
      "color":color_rojo,
    });
    $("td:eq(1)",row).css({
      "color":color_rojo,
    });
    $("td:eq(2)",row).css({
      "color":color_rojo,
    });
  }
  // Columnas de Lugar de Origen y Destino
  if(data.Prog_Sentido=='NS' || data.Prog_Sentido=='NS-AM' || data.Prog_Sentido=='NS-PM'){
    if(data.Prog_LugarOrigen != 'PATIO NORTE'){
      $("td:eq(9)",row).css({
        "color":color_verde,
      });
    }
    if(data.Prog_LugarDestino != 'PATIO NORTE'){
      $("td:eq(10)",row).css({
        "color":color_rojo,
      });
    }
  }
  if(data.Prog_Sentido=='SN' || data.Prog_Sentido=='SN-AM' || data.Prog_Sentido=='SN-PM'){
    if(data.Prog_LugarOrigen != 'PATIO NORTE'){
      $("td:eq(9)",row).css({
        "color":color_rojo,
      });
    }
    if(data.Prog_LugarDestino != 'PATIO NORTE'){
      $("td:eq(10)",row).css({
        "color":color_verde,
      });
    }
  }
  // Columna Tipo Evento
  if(data.Prog_TipoEvento=='INICIO AUTOBUS' || data.Prog_TipoEvento=='FIN AUTOBUS'){
    $("td:eq(11)",row).css({
      "font_weight":"bold",
    });
  }

  // Columnas de ServBus, Bus, Placa y VID
  if(data.Prog_colBus == 0){
    $("td:eq(7)",row).css({
      "color":color_verde,
    });
    $("td:eq(8)",row).css({
      "color":color_verde,
    });
    $("td:eq(15)",row).css({
      "color":color_verde,
    });
    $("td:eq(16)",row).css({
      "color":color_verde,
    });
    $("td:eq(19)",row).css({
      "color":color_verde,
    });
  }
  if(data.Prog_colBus == 1){
    $("td:eq(7)",row).css({
      "color":color_azul,
    });
    $("td:eq(8)",row).css({
      "color":color_azul,
    });
    $("td:eq(15)",row).css({
      "color":color_azul,
    });
    $("td:eq(16)",row).css({
      "color":color_azul,
    });
    $("td:eq(19)",row).css({
      "color":color_azul,
    });
  }
  // Columna de Tabla y Servicio
  if(data.Prog_colTabla == 0){
    $("td:eq(3)",row).css({
      "color":color_azul,
    });
    $("td:eq(6)",row).css({
      "color":color_azul,
    });
  }
  if(data.Prog_colTabla == 1){
    $("td:eq(3)",row).css({
      "color":color_verde,
    });
    $("td:eq(6)",row).css({
      "color":color_verde,
    });
  }
}
