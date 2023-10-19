///::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
///:: INASISTENCIAS GDH v 1.0  FECHA: 2023-04-28 ::::::::::::::::::::::::::::::::::::::::::///
///:: MOSTRAR INASISTENCIAS REPORTADOS A GDH ::::::::::::::::::::::::::::::::::::::::::::::///
///::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///

///:: DECLARACION DE VARIABLES ::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
var tabla_inasistencias, rgdh_fecha_inicio, rgdh_fecha_termino;
rgdh_fecha_inicio   = "";
rgdh_fecha_termino  = "";
mi_carpeta          = f_DocumentRoot();
///:: JS DOM INASISTENCIAS GDH ::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
$(document).ready(function(){
  if(rgdh_fecha_inicio=="" && rgdh_fecha_termino==""){
    rgdh_fecha_inicio   = f_CalculoFecha("hoy","-1 month");
    rgdh_fecha_termino  = f_CalculoFecha("hoy","0");
    $('#rgdh_fecha_inicio').val(rgdh_fecha_inicio);
    $('#rgdh_fecha_termino').val(rgdh_fecha_termino);
  }

  // Si hay cambios en el Fecha se ocultan botones y datatable
  $("#rgdh_fecha_inicio").on('change', function () {
    $("#tabla_inasistencias").dataTable().fnDestroy();
    $('#tabla_inasistencias').hide();  
  });

  $("#rgdh_fecha_termino").on('change', function () {
    $("#tabla_inasistencias").dataTable().fnDestroy();
    $('#tabla_inasistencias').hide();
  });

  ///:: BOTONES INASISTENCIAS GDH :::::::::::::::::::::::::::::::::::::::::::::::::::::::::///

  ///:: BOTON LISTAR INASISTENCIAS GDH ::::::::::::::::::::::::::::::::::::::::::::::::::::///
  $(document).on("click", ".btn_buscar_inasistencias", function(){
    rgdh_fecha_inicio   = $("#rgdh_fecha_inicio").val();
    rgdh_fecha_termino  = $("#rgdh_fecha_termino").val();

    div_tabla       = f_CreacionTabla("tabla_inasistencias","");
    columnas_tabla  = f_ColumnasTabla("tabla_inasistencias","");
    $("#div_tabla_inasistencias").html(div_tabla);

    // Setup - add a text input to each footer cell
    $('#tabla_inasistencias thead tr')
    .clone(true)
    .addClass('filters_inasistencias')
    .appendTo('#tabla_inasistencias thead');
    
    $("#tabla_inasistencias").dataTable().fnDestroy();
    $('#tabla_inasistencias').show();
    
    Accion = 'buscar_inasistencias';
    tabla_inasistencias = $('#tabla_inasistencias').DataTable({
       //Filtros por columnas
      orderCellsTop: true,
      fixedHeader: true,
      initComplete: function (){
      var api = this.api();
      // For each column
      api.columns().eq(0).each(function (colIdx) {
        // Set the header cell to contain the input element
        var cell = $('.filters_inasistencias th').eq($(api.column(colIdx).header()).index());
        var title = $(cell).text();
        $(cell).html('<input type="text" placeholder="' + title + '" />');
        // On every keypress in this input
        $('input',$('.filters_inasistencias th').eq($(api.column(colIdx).header()).index()) ).off('keyup change').on('keyup change', function (e) {
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
          title         : 'REPORTE INASISTENCIAS'
        },
      ],
      "ajax"            : {
        "url"           : "Ajax.php", 
        "method"        : 'POST', //usamos el metodo POST
        "data"          : {MoS:MoS, NombreMoS:NombreMoS, Accion:Accion, fecha_inicio:rgdh_fecha_inicio, fecha_termino:rgdh_fecha_termino}, //enviamos opcion 4 para que haga un SELECT
        "dataSrc"       : ""
      },
      "columns"         : columnas_tabla,
      "columnDefs"      : [
        {
          "targets"     : [0,1],
          "orderable"   : false
        },
        { 
          "className"   : "text-center",
          "targets"     : [3,4,5,6,7,11]
        },
      ],
      "order"           : [[1, 'desc']]
    });
  });
  ///:: FIN BOTON LISTAR REPORTE GDH ::::::::::::::::::::::::::::::::::::::::::::::::::::::///

  ///:: EVENTO DE BOTON VER INASISTENCIAS :::::::::::::::::::::::::::::::::::::::::::::::::///       
  $(document).on("click", ".btn_ver_inasistencias", function(){		
    $("#form_modal_ver_inasistencias").trigger("reset");
    fila_inasistencias = $(this).closest('tr'); 
    inasistencias_id  = fila_inasistencias.find('td:eq(1)').text();
    
    Accion = 'ver_inasistencias';
    $.ajax({
      url: "Ajax.php",
      type: "POST",
      datatype:"json",
      async: false,    
      data: {MoS:MoS, NombreMoS:NombreMoS, Accion:Accion, inasistencias_id:inasistencias_id},    
      success: function(data){
        $("#div_ver_inasistencias").html(data);
      }
    });
    $(".modal-header").css( "background-color", "#17a2b8");
    $(".modal-header").css( "color", "white" );
    $(".modal-title").text( "INASISTENCIAS" );
    $('#modal_crud_ver_inasistencias').modal('show');
    $('#modal-resizable_ver_inasistencias').resizable();
    $(".modal-dialog").draggable({
      cursor: "move",
      handle: ".dragable_touch",
    });        
  });
  ///:: FIN EVENTO DE BOTON VER INASIETNCIAS ::::::::::::::::::::::::::::::::::::::::::::::///

  ///:: BOTON DESCARGAR INASISTENCIAS :::::::::::::::::::::::::::::::::::::::::::::::::::::///
  $(document).on("click", ".btn_descargar_inasistencias", function(){		
    rgdh_fecha_inicio   = $("#rgdh_fecha_inicio").val();
    rgdh_fecha_termino  = $("#rgdh_fecha_termino").val();
    Accion          = 'descargar_inasistencias';
    $.ajax({
        url         : "Ajax.php",
        type        : "POST",
        datatype    : "json",
        async       : false,
        data        : {MoS:MoS, NombreMoS:NombreMoS, Accion:Accion,  fecha_inicio:rgdh_fecha_inicio, fecha_termino:rgdh_fecha_termino},
        beforeSend  : function(){
            Swal.fire({
              icon              : 'success',
              title             : 'Procesando Información',
              showConfirmButton : false,
              timer             : 5000
            })
        },
        success     : function(data){
            window.location.href = mi_carpeta + "Module/novedades_piloto/Controller/csv_descarga_inasistencias.php?Archivo=" + data;
        }
    });
  });
  ///:: FIN BOTON DESCARGAR INASISTENCIAS :::::::::::::::::::::::::::::::::::::::::::::::::///

  ///:: TERMINO BOTONES REPORTE GDH :::::::::::::::::::::::::::::::::::::::::::::::::::::::///

});
///:: TERMINO JS DOM REPORTE GDH ::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///