///::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
///:: DETALLE NOVEDAD v 1.0  FECHA: 2023-04-28 ::::::::--::::::::::::::::::::::::::::::::::///
///:: MOSTRAR DETALLE NOVEDAD REPORTADOS A GDH ::::::::::::::::::::::::::::::::::::::::::::///
///::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///

///:: DECLARACION DE VARIABLES ::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
var tabla_novedad_detalle, node_fecha_inicio, node_fecha_termino;
node_fecha_inicio   = "";
node_fecha_termino  = "";

///:: JS DOM INASISTENCIAS GDH ::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
$(document).ready(function(){
  if(node_fecha_inicio=="" && node_fecha_termino==""){
    node_fecha_inicio   = f_CalculoFecha("hoy","-1 month");
    node_fecha_termino  = f_CalculoFecha("hoy","0");
    $('#node_fecha_inicio').val(node_fecha_inicio);
    $('#node_fecha_termino').val(node_fecha_termino);
  }

  // Si hay cambios en el Fecha se ocultan botones y datatable
  $("#node_fecha_inicio", "#node_fecha_termino").on('change', function () {
    $("#tabla_novedad_detalle").dataTable().fnDestroy();
    $('#tabla_novedad_detalle').hide();  
  });

  ///:: BOTONES DETALLE NOVEDAD GDH :::::::::::::::::::::::::::::::::::::::::::::::::::::::///

  ///:: BOTON LISTAR DETALLE NOVEDAD GDH ::::::::::::::::::::::::::::::::::::::::::::::::::///
  $(document).on("click", ".btn_buscar_novedad_detalle", function(){
    node_fecha_inicio   = $("#node_fecha_inicio").val();
    node_fecha_termino  = $("#node_fecha_termino").val();

    div_tabla       = f_CreacionTabla("tabla_novedad_detalle","");
    columnas_tabla  = f_ColumnasTabla("tabla_novedad_detalle","");
    $("#div_tabla_novedad_detalle").html(div_tabla);

    // Setup - add a text input to each footer cell
    $('#tabla_novedad_detalle thead tr')
    .clone(true)
    .addClass('filters_novedad_detalle')
    .appendTo('#tabla_novedad_detalle thead');
    
    $("#tabla_novedad_detalle").dataTable().fnDestroy();
    $('#tabla_novedad_detalle').show();
    
    Accion = 'buscar_novedad_detalle';
    tabla_novedad_detalle = $('#tabla_novedad_detalle').DataTable({
       //Filtros por columnas
      orderCellsTop: true,
      fixedHeader: true,
      initComplete: function (){
      var api = this.api();
      // For each column
      api.columns().eq(0).each(function (colIdx) {
        // Set the header cell to contain the input element
        var cell = $('.filters_novedad_detalle th').eq($(api.column(colIdx).header()).index());
        var title = $(cell).text();
        $(cell).html('<input type="text" placeholder="' + title + '" />');
        // On every keypress in this input
        $('input',$('.filters_novedad_detalle th').eq($(api.column(colIdx).header()).index()) ).off('keyup change').on('keyup change', function (e) {
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
      deferRender       : true,
      scrollY           : 800,
      scrollCollapse    : true,
      scroller          : true,
      scrollX           : true,
      fixedColumns      : {
        left: 1
      },
      fixedHeader       : {
        header : false
      },
      select            : {style: 'os'},
      language          : idiomaEspanol,
      responsive        : "true",
      dom               : 'Blfrtip',
      pageLength        : 50,
      buttons           : [
        {
          extend        : 'excelHtml5',
          text          : '<i class="fas fa-file-excel"></i> ',
          titleAttr     : 'Exportar a Excel',
          className     : 'btn btn-success',
          title         : 'REPORTE NOVEDADES DE COLABORADOR'
        },
      ],
      "ajax"            : {
        "url"           : "Ajax.php", 
        "method"        : 'POST', //usamos el metodo POST
        "data"          : {MoS:MoS, NombreMoS:NombreMoS, Accion:Accion, fecha_inicio:node_fecha_inicio, fecha_termino:node_fecha_termino}, //enviamos opcion 4 para que haga un SELECT
        "dataSrc"       : ""
      },
      "columns"         : columnas_tabla,
      "order"           : [[5, 'desc']]
    });
  });
  ///:: FIN BOTON LISTAR REPORTE GDH ::::::::::::::::::::::::::::::::::::::::::::::::::::::///



  ///:: TERMINO BOTONES REPORTE GDH :::::::::::::::::::::::::::::::::::::::::::::::::::::::///

});
///:: TERMINO JS DOM REPORTE GDH ::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///