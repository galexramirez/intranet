///::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
///:: REPORTE ACCIDENTES v 1.0  FECHA: 2023-05-02 :::::::::::::::::::::::::::::::::::::::::///
///:: MOSTRAR ACCIDENTES REPORTADOS A GDH :::::::::::::::::::::::::::::::::::::::::::::::::///
///::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///

///:: DECLARACION DE VARIABLES ::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
var tablaReportegdh, acci_fecha_inicio, acci_fecha_termino;
acci_fecha_inicio  = "";
acci_fecha_termino = "";

///:: JS DOM REPORTE ACCIDENTES ::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
$(document).ready(function(){
  if(acci_fecha_inicio=="" && acci_fecha_termino==""){
    acci_fecha_inicio   = f_CalculoFecha("hoy","0");
    acci_fecha_termino  = f_CalculoFecha("hoy","0");
    $('#acci_fecha_inicio').val(acci_fecha_inicio);
    $('#acci_fecha_termino').val(acci_fecha_termino);
  }

  // Si hay cambios en el Fecha se ocultan botones y datatable
  $("#acci_fecha_inicio").on('change', function () {
    $("#tabla_accidentes").dataTable().fnDestroy();
    $('#tabla_accidentes').hide();  
  });

  $("#acci_fecha_termino").on('change', function () {
    $("#tabla_accidentes").dataTable().fnDestroy();
    $('#tabla_accidentes').hide();
  });

  ///:: BOTONES REPORTE ACCIDENTES  :::::::::::::::::::::::::::::::::::::::::::::::::::::::///

  ///:: BOTON LISTAR REPORTE ACCIDENTES :::::::::::::::::::::::::::::::::::::::::::::::::::///
  $(document).on("click", ".btn_buscar_accidentes", function(){
    acci_fecha_inicio   = $("#acci_fecha_inicio").val();
    acci_fecha_termino  = $("#acci_fecha_termino").val();

    div_tablas      = f_CreacionTabla("tablaReportegdh","");
    columnastabla  = f_ColumnasTabla("tablaReportegdh","");
    $('#div_tablaReportegdh').html(div_tablas);
  
    // Setup - add a text input to each footer cell
    $('#tablaReportegdh thead tr')
      .clone(true)
      .addClass('filtersReportegdh')
      .appendTo('#tablaReportegdh thead');
  
    $("#tablaReportegdh").dataTable().fnDestroy();
    $('#tablaReportegdh').show();

    Accion = 'BuscarReportegdh';
    tablaReportegdh = $('#tablaReportegdh').removeAttr('width').DataTable({
      //Filtros por columnas
      orderCellsTop : true,
      fixedHeader   : true,
      initComplete  : function (){
        var api = this.api();
        // For each column
        api.columns().eq(0).each(function (colIdx) {
          // Set the header cell to contain the input element
          var cell  = $('.filtersReportegdh th').eq($(api.column(colIdx).header()).index());
          var title = $(cell).text();
          $(cell).html('<input type="text" placeholder="' + title + '" />');
          // On every keypress in this input
          $('input',$('.filtersReportegdh th').eq($(api.column(colIdx).header()).index()) ).off('keyup change').on('keyup change', function (e) {
            e.stopPropagation();
            // Get the search value
            $(this).attr('title', $(this).val());
            var regexr          = '({search})'; //$(this).parents('th').find('select').val();
            var cursorPosition  = this.selectionStart;
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
      deferRender     : true,
      scrollY         : 800,
      scrollCollapse  : true,
      scroller        : true,
      scrollX         : true,
      fixedColumns    : {
        left: 1
      },
      fixedHeader     : {
        header : false
      },
      select          : {style: 'os'},
      language        : idiomaEspanol,
      fixedColumns    : true,
      responsive      : "true",
      dom             : 'Blfrtip',
      pageLength      : 50,
      buttons         : [
        {
          extend      : 'excelHtml5',
          text        : '<i class="fas fa-file-excel"></i> ',
          titleAttr   : 'Exportar a Excel',
          className   : 'btn btn-success'
        },
      ],
      "ajax"          : {            
        "url"         : "Ajax.php", 
        "method"      : 'POST',
        "data"        : {MoS:MoS, NombreMoS:NombreMoS, Accion:Accion, fecha_inicio:acci_fecha_inicio, fecha_termino:acci_fecha_termino},
        "dataSrc"     : ""
      },
      "columns"       : columnastabla,
      "columnDefs"    : [
        { width       : 300, targets: 16 },
        {
          "targets"  : [38],
          "render"   : function(data, type, row, meta) {
              if(data!=""){
                  return '<div class="text-center"><div class="btn-group"><button title="Ver Lesionados" class="btn btn-sm btn-outline-secondary btn_ver_lesionados">'+data+'</button></div></div>';
              }else{
                  return "";
              }
          }
        },

      ],
      fixedColumns     : true,
      "order"         : [[0, 'desc']]
    });
  });

  ///:: BOTON VER LESIONADOS ::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///       
  $(document).on("click", ".btn_ver_lesionados", function(){		
      $("#form_modal_ver_lesionados").trigger("reset");
      let fila_reporte_gdh = $(this).closest('tr'); 
      let accidentes_id  = fila_reporte_gdh.find('td:eq(0)').text();
      let acci_tipo_naturaleza   = 'DañosPersonales';      
      
      $("#tabla_ver_lesionados").dataTable().fnDestroy();
      div_tablas = f_CreacionTabla("tabla_ver_lesionados","");
      $('#div_tabla_ver_lesionados').html(div_tablas);
      columnastabla  = f_ColumnasTabla("tabla_ver_lesionados","");
      Accion = 'carga_tabla_ver_lesionados';
      $("#tabla_ver_lesionados").dataTable().fnDestroy();
      tabla_ver_lesionados  = $('#tabla_ver_lesionados').removeAttr('width').DataTable({
        language    : idiomaEspanol,
        searching   : false,
        info        : false,
        lengthChange: false,
        paging      : false,    
        fixedColumns: true,
        //pageLength  : 10,
        responsive  : "true",
        "ajax"      : {            
          "url"     : "Ajax.php", 
          "method"  : 'POST',
          "data"    : { MoS:MoS, NombreMoS:NombreMoS, Accion:Accion, Accidentes_Id:accidentes_id, Acci_Tipo:acci_tipo_naturaleza },
          "dataSrc" : ""
        },
        "columns"   : columnastabla,
        "columnDefs"      : [
          {   width       : 200, targets: 0 },
        ],
        "order"           : [[0, 'asc']]
      });    

      $(".modal-header").css( "background-color", "#17a2b8");
      $(".modal-header").css( "color", "white" );
      $(".modal-title").text("Información Lesionados");
      $('#modal_crud_ver_lesionados').modal('show');	    
      $('#modal-resizable_ver_lesionados').resizable();
      $(".modal-dialog").draggable({
          cursor: "move",
          handle: ".dragable_touch",
        });
  });
  ///:: FIN BOTON VER LESIONADOS ::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///

  ///::::::::::::::: BOTON DESCARGAR OT :::::::::::::::::::::::///
  $(document).on("click", ".btn_descargar_ip", function(){		
    acci_fecha_inicio   = $("#acci_fecha_inicio").val();
    acci_fecha_termino  = $("#acci_fecha_termino").val();
    Accion          = 'descargar_ip';
    $.ajax({
        url         : "Ajax.php",
        type        : "POST",
        datatype    : "json",
        async       : false,
        data        : {MoS:MoS,NombreMoS:NombreMoS,Accion:Accion,fecha_inicio:acci_fecha_inicio,fecha_termino:acci_fecha_termino},
        beforeSend  : function(){
            Swal.fire({
              icon              : 'success',
              title             : 'Procesando Información',
              showConfirmButton : false,
              timer             : 5000
            })
        },
        success     : function(data){
          if(data){
            window.location.href = mi_carpeta + "Module/Accidentes/Controller/csv_descarga_ip.php?Archivo=" + data;
            alert("Informe Preliminar");
            window.location.href = mi_carpeta + "Module/Accidentes/Controller/csv_descarga_na.php?Archivo=" + data;
            alert("Daños, Causas y Reparaciones");
            window.location.href = mi_carpeta + "Module/Accidentes/Controller/csv_descarga_re.php?Archivo=" + data;
          }else{
            Swal.fire({
              position : 'center',
              icon     : 'error',
              title    : '*Error al cargar información!!!',
              text     : resp,
            })            
          }
            
        }
    });
});

});

