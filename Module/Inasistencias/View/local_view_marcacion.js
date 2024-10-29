///::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
///:: TAB MARCACION v 1.0  FECHA: 2024-10-20 ::::::::::::::::::::::::::::::::::::::::::::::///
///:: MOSTRAR LUGAR, FECHA Y HORA DE LAS MARCACIONES DE PILOTOS :::::::::::::::::::::::::::///
///::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///

///:: DECLARACION DE VARIABLES ::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
var tabla_marcacion, marc_fecha_inicio, marc_fecha_termino;
marc_fecha_inicio = "";
marc_fecha_termino = "";

///:: JS DOM REPORTE GDH :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
$(document).ready(function(){
  if(marc_fecha_inicio=="" && marc_fecha_termino==""){
    marc_fecha_inicio   = f_CalculoFecha("hoy","0");
    marc_fecha_termino  = f_CalculoFecha("hoy","0");
    $('#marc_fecha_inicio').val(marc_fecha_inicio);
    $('#marc_fecha_termino').val(marc_fecha_termino);
  }

  // Si hay cambios en el Fecha se ocultan botones y datatable
  $("#marc_fecha_inicio").on('change', function () {
    $("#tabla_marcacion").dataTable().fnDestroy();
    $('#tabla_marcacion').hide();  
  });

  $("#marc_fecha_termino").on('change', function () {
    $("#tabla_marcacion").dataTable().fnDestroy();
    $('#tabla_marcacion').hide();
  });

  ///:: BOTONES REPORTE GDH :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///

  ///:: BOTON LISTAR REPORTE GDH ::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
  $(document).on("click", ".btn_buscar_marcacion", function(){
    marc_fecha_inicio   = $("#marc_fecha_inicio").val();
    marc_fecha_termino  = $("#marc_fecha_termino").val();

    div_tabla       = f_CreacionTabla("tabla_marcacion","");
    columnas_tabla  = f_ColumnasTabla("tabla_marcacion","");
    $("#div_tabla_marcacion").html(div_tabla);

    // Setup - add a text input to each footer cell
    $('#tabla_marcacion thead tr')
    .clone(true)
    .addClass('filters_marcacion')
    .appendTo('#tabla_marcacion thead');

    Accion = 'buscar_marcacion';
    $("#tabla_marcacion").dataTable().fnDestroy();
    $('#tabla_marcacion').show();

    tabla_marcacion = $('#tabla_marcacion').DataTable({
      orderCellsTop: true,
      fixedHeader: true,
      initComplete: function (){
      var api = this.api();
      // For each column
      api.columns().eq(0).each(function (colIdx) {
        // Set the header cell to contain the input element
        var cell = $('.filters_marcacion th').eq($(api.column(colIdx).header()).index());
        var title = $(cell).text();
        $(cell).html('<input type="text" placeholder="' + title + '" />');
        // On every keypress in this input
        $('input',$('.filters_marcacion th').eq($(api.column(colIdx).header()).index()) ).off('keyup change').on('keyup change', function (e) {
          e.stopPropagation();
          // Get the search value
          $(this).attr('title', $(this).val());
          var regexr = '({search})';
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
          title         : 'MARCACIONES'
        },
      ],
      "ajax"            : {
        "url"           : "Ajax.php", 
        "method"        : 'POST',
        "data"          : {MoS:MoS, NombreMoS:NombreMoS, Accion:Accion, fecha_inicio:marc_fecha_inicio, fecha_termino:marc_fecha_termino},
        "dataSrc"       : ""
      },
      "columns"         : columnas_tabla,
      "columnDefs"      : [
        {   width       : 300, 
            targets     : [6,7] },
        {
          "targets"     : [1],
          "orderable"   : false
        },
        { 
          "className"   : "text-center",
          "targets"     : [0,2,3,4,5,7,8]
        },
      ],
      "order"           : [[0, 'desc']]
    });
  });
  ///:: FIN BOTON LISTAR REPORTE GDH ::::::::::::::::::::::::::::::::::::::::::::::::::::::///

  ///:: EVENTO DEL BOTON VER UBICACION EN GOOGLE MAPS :::::::::::::::::::::::::::::::::::::///
  $(document).on("click", ".btn_ubicacion", function(){
    fila_marcacion = $(this).closest('tr'); 
    lat = fila_marcacion.find('td:eq(8)').text();
    long = fila_marcacion.find('td:eq(9)').text();
    window.open('https://maps.google.com/?q='+lat+','+long, '_blank');
  });
  ///:: FIN EVENTO DEL BOTON VER LOG INASISTENCIAS EDITAR :::::::::::::::::::::::::::::::::///

  ///:: TERMINO BOTONES REPORTE GDH :::::::::::::::::::::::::::::::::::::::::::::::::::::::///

});
///:: TERMINO JS DOM REPORTE GDH ::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///