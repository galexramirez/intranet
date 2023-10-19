///::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
///:: TAB LISTADO COMPORTAMIENTO v 2.0  FECHA: 2023-05-20 :::::::::::::::::::::::::::::::::///
///:: EDITAR Y MOSTRAR COMPORTAMIENTO :::::::;;;;;;;;;;;;;;;;;;;;;:::::::::::::::::::::::::///
///::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///

///:: DECLARACION DE VARIABLES ::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
var tablaComportamiento, filaComportamiento;
var ope_comportamientoid, comportamiento_id, comp_programacionid, comp_controlfacilitadorid, comp_openovedadid, comp_novedadid, comp_tiponovedad, comp_detallenovedad, comp_descripcion, comp_operacion, comp_fechaoperacion, comp_estadocomportamiento, comp_dni, comp_codigocolaborador, comp_nombrecolaborador, comp_codigocgo, comp_nombrecgo, comp_tabla, comp_servicio, comp_bus, comp_lugarexacto, comp_horainicio, comp_horafin, comp_linkvideo, comp_codigofalta, comp_faltacometida, comp_monto, comp_reconoceresponsabilidad, comp_reportegdh, comp_fechareportegdh, comp_cfargid, comp_usuarioid_generar, comp_fechagenerar, comp_usuarioid_edicion, comp_fechaedicion, comp_usuarioid_cerrar, comp_fechacerrar, comp_lugar_origen, comp_lugar_destino, comp_total_horas, comp_obs_log, comp_log, horainicio, minutoinicio, horafin, minutofin;
var selectAniosComportamiento, opcionComportamiento;
var comp_fecha_inicio, comp_fecha_termino, fecha_inicio_comportamiento;

comp_fecha_inicio = "";
comp_fecha_termino = "";
fecha_inicio_comportamiento = '2023-07-21';


///:: DOM JS LISTADO DE COMPORTAMIENTO :::::::::::::::::::::::::::::::::::::::::::::::::::::///
$(document).ready(function(){
  if(comp_fecha_inicio=="" && comp_fecha_termino==""){
    comp_fecha_inicio   = f_CalculoFecha("hoy","0");
    comp_fecha_termino  = f_CalculoFecha("hoy","0");
    $('#comp_fecha_inicio').val(comp_fecha_inicio);
    $('#comp_fecha_termino').val(comp_fecha_termino);
  }

  // Si hay cambios en el Fecha se ocultan botones y datatable
  $("#comp_fecha_inicio").on('change', function () {
    $("#tablaComportamiento").dataTable().fnDestroy();
    $('#tablaComportamiento').hide();
  });

  $("#comp_fecha_termino").on('change', function () {
    $("#tablaComportamiento").dataTable().fnDestroy();
    $('#tablaComportamiento').hide();  
  });

  ///:: BOTONES COMPORTAMIENTO ::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///

  ///:: BOTON BUSCAR COMPORTAMIENTO :::::::::::::::::::::::::::::::::::::::::::::::::::::::///
  $(document).on("click", ".btn_buscar_comportamiento", function(){
    MostrarAccionesComportamiento = true; // para validar con los botones
    comp_fecha_inicio   = $("#comp_fecha_inicio").val();
    comp_fecha_termino  = $("#comp_fecha_termino").val();

    if(Date.parse(comp_fecha_inicio)<Date.parse(fecha_inicio_comportamiento)){
      Swal.fire({
        icon: 'error',
        title: 'FECHAS...',
        text: '*Comportamiento inicia a partir del 21/07/2023 !!!'
      });
    }else{
      div_tabla = f_CreacionTabla("tablaComportamiento","");
      $("#div_tablaComportamiento").html(div_tabla);
      columnastabla = f_ColumnasTabla("tablaComportamiento","");
    
      $("#tablaComportamiento").dataTable().fnDestroy();
      $('#tablaComportamiento').show();
    
      // Setup - add a text input to each footer cell
      $('#tablaComportamiento thead tr')
        .clone(true)
        .addClass('filtersComportamiento')
        .appendTo('#tablaComportamiento thead');
    
      Accion='BuscarComportamiento';
      tablaComportamiento = $('#tablaComportamiento').DataTable({
         //Filtros por columnas
        orderCellsTop: true,
        fixedHeader: true,
        initComplete: function (){
          var api = this.api();
          // For each column
          api.columns().eq(0).each(function (colIdx) {
            // Set the header cell to contain the input element
            var cell = $('.filtersComportamiento th').eq($(api.column(colIdx).header()).index());
            var title = $(cell).text();
            $(cell).html('<input type="text" placeholder="' + title + '" />');
            // On every keypress in this input
            $('input',$('.filtersComportamiento th').eq($(api.column(colIdx).header()).index()) ).off('keyup change').on('keyup change', function (e) {
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
        deferRender     : true,
        scrollY         : 800,
        scrollCollapse  : true,
        scroller        : true,
        scrollX         : true,

        fixedColumns    :
        {
          left          : 1
        },
        fixedHeader     :
        {
          header        : false
        },
        select          : {style: 'os'},
        language        : idiomaEspanol,
        responsive      : "true",
        dom             : 'Blfrtip', // Con Botones Excel,Pdf,Print
        pageLength      : 50,
        buttons         :
          [
            {
              extend      : 'excelHtml5',
              text        : '<i class="fas fa-file-excel"></i> ',
              titleAttr   : 'Exportar a Excel',
              className   : 'btn btn-success',
              title       : 'LISTADO DE COMPORTAMIENTO'
            },
          ],
        "ajax"            : {            
          "url"           : "Ajax.php", 
          "method"        : 'POST', //usamos el metodo POST
          "data"          : {MoS:MoS, NombreMoS:NombreMoS, Accion:Accion, fecha_inicio:comp_fecha_inicio, fecha_termino:comp_fecha_termino},
          "dataSrc"       : ""
        },
        "columns"         : columnastabla,
        "columnDefs"      : [
          {
            "targets"     : [11, 12],
            "orderable"   : false,
          },
          {
            "targets"   : [14],
            "render"    : function(data, type, row, meta) {
                if(data==null){
                    return "PENDIENTE ANALISIS OP";
                }else{
                    return data;
                }
            }
          }
        ],
        "order"           : [[1, 'desc']]
      });    
    }
  });
  ///:: FIN BOTON BUSCAR COMPORTAMIENTO :::::::::::::::::::::::::::::::::::::::::::::::::::///

  ///:: BOTON REPORTE FACILITADOR :::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
  $(document).on("click", ".btnReporteFacilitador", function(){
    filaComportamiento = $(this).closest('tr'); 
    Nove_ProgramacionId = filaComportamiento.find('td:eq(0)').text();
    Novedad_Id = filaComportamiento.find('td:eq(1)').text();
    Accion='DetalleControlFacilitador';
    $.ajax({
      url: "Ajax.php",
      type: "POST",
      datatype:"json",
      async: false,    
      data: {MoS:MoS,NombreMoS:NombreMoS,Accion:Accion,Nove_ProgramacionId:Nove_ProgramacionId,Novedad_Id:Novedad_Id},
      success: function(data){
        $('#div_DetalleControlFacilitador').html(data);
      }
    });
    $(".modal-header").css( "background-color", "#17a2b8" );
    $(".modal-header").css( "color", "white" );
    $(".modal-title").text( "Detalle Control Facilitador" );
    $('#modalCRUDDetalleControlFacilitador').modal('show');
  });
  ///:: FIN BOTON REPORTE FACILITADOR :::::::::::::::::::::::::::::::::::::::::::::::::::::///
  
  ///:: TERMINO BOTONES COMPORTAMIENTO ::::::::::::::::::::::::::::::::::::::::::::::::::::///
});
///:: TERMINO DOM JS LISTADO DE COMPORTAMIENTO ::::::::::::::::::::::::::::::::::::::::::::///


///:: FUNCIONES LISTADO COMPORTAMIENTO ::::::::::::::::::::::::::::::::::::::::::::::::::::///

///:: TERMINO FUNCIONES COMPORTAMIENTO ::::::::::::::::::::::::::::::::::::::::::::::::::::///