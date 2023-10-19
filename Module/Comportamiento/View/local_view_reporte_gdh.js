///::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
///::::::::::::::::::::::: TAB REPORTE GDH v 1.0  FECHA: 15/05/2022 :::::::::::::::::::::::::::///
///::::::::::::::::::::::: MOSTRAR COMPORTAMIENTO REPORTADOS A GDH ::::::::::::::::::::::::::::///
///::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///

///::::::::::::::::::::::::::::::: Declaracion de Variables :::::::::::::::::::::::::::::::::::///
var tablaReportegdh;
var rgdh_fecha_inicio, rgdh_fecha_termino;
rgdh_fecha_inicio   = "";
rgdh_fecha_termino  = "";

///::::::::::::::::::::::::: DOM NOVEDAD :::::::::::::::::::::::::::::::::::::::::::::::::///
$(document).ready(function(){
  if(rgdh_fecha_inicio=="" && rgdh_fecha_termino==""){
    rgdh_fecha_inicio   = f_CalculoFecha("hoy","0");
    rgdh_fecha_termino  = f_CalculoFecha("hoy","0");
    $('#rgdh_fecha_inicio').val(rgdh_fecha_inicio);
    $('#rgdh_fecha_termino').val(rgdh_fecha_termino);
  }

  // Si hay cambios en el Fecha se ocultan botones y datatable
  $("#rgdh_fecha_inicio").on('change', function () {
    $("#tablaReportegdh").dataTable().fnDestroy();
    $('#tablaReportegdh').hide();
  });

  $("#rgdh_fecha_termino").on('change', function () {
    $("#tablaReportegdh").dataTable().fnDestroy();
    $('#tablaReportegdh').hide();  
  });

///:::::::::::::::::::::::::::: BOTONES COMPORTAMIENTO ::::::::::::::::::::::::::::::::::::::::::///

///:::::::::::::::::::::::: JS DATA TABLE COMPORTAMIENTO ::::::::::::::::::::::::::::::::::///
$(document).on("click", ".btn_buscar_reporte_gdh", function(){
  rgdh_fecha_inicio   = $("#rgdh_fecha_inicio").val();
  rgdh_fecha_termino  = $("#rgdh_fecha_termino").val();

  div_tabla = f_CreacionTabla("tablaReportegdh","");
  $("#div_tablaReportegdh").html(div_tabla);
  columnastabla = f_ColumnasTabla("tablaReportegdh","");
  
  $("#tablaReportegdh").dataTable().fnDestroy();
  $('#tablaReportegdh').show();

  // Setup - add a text input to each footer cell
  $('#tablaReportegdh thead tr')
    .clone(true)
    .addClass('filtersReportegdh')
    .appendTo('#tablaReportegdh thead');

  Accion='BuscarReportegdh';
  tablaReportegdh = $('#tablaReportegdh').DataTable({
     //Filtros por columnas
    orderCellsTop: true,
    fixedHeader: true,
    initComplete: function (){
      var api = this.api();
      // For each column
      api.columns().eq(0).each(function (colIdx) {
        // Set the header cell to contain the input element
        var cell = $('.filtersReportegdh th').eq($(api.column(colIdx).header()).index());
        var title = $(cell).text();
        $(cell).html('<input type="text" placeholder="' + title + '" />');
        // On every keypress in this input
        $('input',$('.filtersReportegdh th').eq($(api.column(colIdx).header()).index()) ).off('keyup change').on('keyup change', function (e) {
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
    //Para cambiar el lenguaje a español
    select          : {style: 'os'},
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
          title       : 'REPORTE COMPORTAMIENTO',
        },
      ],
    "ajax":{            
      "url": "Ajax.php", 
      "method": 'POST', //usamos el metodo POST
      "data":{MoS:MoS, NombreMoS:NombreMoS, Accion:Accion, fecha_inicio:rgdh_fecha_inicio, fecha_termino:rgdh_fecha_termino}, //enviamos opcion 4 para que haga un SELECT
      "dataSrc":""
    },
    "columns":columnastabla,
    "order": [[0, 'desc']]
  });
});

    ///:: BOTON EDITAR COMPORTAMIENTO ::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
    $(document).on("click", ".btn_editar_comportamiento", function(){
      $("#form_comportamiento_editar").trigger("reset");
      $("#btn_guardar_comportamiento_editar").prop("disabled",false);
      f_CargarVariablesVacioComportamiento(); // se inicialiazan las variables de informe de COMPORTAMIENTO
      filaComportamiento    = $(this).closest('tr'); 
      comportamiento_id     = filaComportamiento.find('td:eq(0)').text();
      opcionComportamiento= "EDITAR";
      ///:: SE BUSCA Y SE CARGA EL INFORME COMPORTAMIENTO
      Accion='CargaComportamiento';
      $.ajax({
        url       : "Ajax.php",
        type      : "POST",
        datatype  : "json",
        async     : false,    
        data      : {MoS:MoS,NombreMoS:NombreMoS,Accion:Accion,comportamiento_id:comportamiento_id},
        success   : function(data){
          data = $.parseJSON(data);
          f_CargarVariablesComportamiento(data);
        }
      });
  
      $("#div_form_comportamiento").html("");
      div_show = f_MostrarDiv("form_comportamiento_editar","div_form_comportamiento_editar",comp_estadocomportamiento);
      $("#div_form_comportamiento_editar").html(div_show);
      f_select_combo_comportamiento();
      f_CargaVariablesHtmlComportamiento();
  
      //$("#div_reporte_gdh").show();
      $(".modal-header").css( "background-color", "#17a2b8");
      $(".modal-header").css( "color", "white" );
      $('#modal_crud_comportamiento_editar').modal('show');
      $(".modal-title").text("Editar Comportamiento");
      $('#modal-resizable_comportamiento_editar').resizable();
      $(".modal-dialog").draggable({
        cursor: "move",
        handle: ".dragable_touch",
      });
  
    });
    ///:: FIN BOTON INFORME COMPORTAMIENTO :::::::::::::::::::::::::::::::::::::::::::::::::::///
  
    ///:: EVENTO DEL BOTON VER LOG COMPORTAMIENTO EDITAR :::::::::::::::::::::::::::::::::::::///
    $(document).on("click", ".btn_log_comportamiento_editar", function(){
      $("#form_modal_log_comportamiento_editar").trigger("reset");
      $("#div_log_comportamiento_editar").html(comp_log);
      
      $(".modal-header-log_editar").css( "background-color", "#17a2b8");
      $(".modal-header-log_editar").css( "color", "white" );
      $(".modal-title-log_editar").text("Log");
      $('#modal_crud_log_comportamiento_editar').modal('show');
      $('#modal-resizable_log_editar').resizable();
      $(".modal-dialog").draggable({
        cursor: "move",
        handle: ".dragable_touch",
      });
    });
    ///:: FIN EVENTO DEL BOTON VER LOG COMPORTAMIENTO EDITAR :::::::::::::::::::::::::::::::::///

  ///:: BOTON GRABAR -> REALIZA LA GRABACION DEL COMPORTAMIENTO :::::::::::::::::::::::::::///
  $('#form_comportamiento_editar').submit(function(e){
    e.preventDefault(); //evita el comportambiento normal del submit, es decir, recarga total de la página
    let t_validar_comportamiento_editar="";
    f_CargarVariablesEditadasComportamiento();
    t_validar_comportamiento_editar = f_validar_comportamiento(comp_tiponovedad, comp_fechaoperacion, comp_nombrecolaborador, comp_descripcion, comp_tabla, comp_servicio, comp_bus, comp_nombrecgo, comp_lugarexacto, comp_lugar_origen, comp_lugar_destino,  horainicio, minutoinicio, horafin, minutofin, comp_total_horas, comp_detallenovedad, comp_estadocomportamiento, comp_reconoceresponsabilidad, comp_grado_falta, comp_codigofalta, comp_faltacometida, comp_monto, comp_linkvideo, comp_obs_log);
    if(t_validar_comportamiento_editar=="invalido"){
      Swal.fire({
        icon  : 'error',
        title : 'EDITAR...',
        text  : '*Los Campos no pueden estar VACIOS!'
      });
    }else{
      // EDITAR COMPORTAMIENTO
      if(opcionComportamiento=="EDITAR"){
        $("#btn_guardar_comportamiento_editar").prop("disabled",true);
        Accion='EditarComportamiento';
        $.ajax({
          url: "Ajax.php",
          type: "POST",
          datatype:"json",    
          data:  { MoS:MoS, NombreMoS:NombreMoS, Accion:Accion, comportamiento_id:comportamiento_id, comp_tiponovedad:comp_tiponovedad, comp_fechaoperacion:comp_fechaoperacion, comp_nombrecolaborador:comp_nombrecolaborador, comp_descripcion:comp_descripcion, comp_tabla:comp_tabla, comp_servicio:comp_servicio, comp_bus:comp_bus, comp_nombrecgo:comp_nombrecgo, comp_lugarexacto:comp_lugarexacto, comp_lugar_origen:comp_lugar_origen, comp_lugar_destino:comp_lugar_destino, comp_horainicio:comp_horainicio, comp_horafin:comp_horafin, comp_total_horas:comp_total_horas, comp_detallenovedad:comp_detallenovedad, comp_estadocomportamiento:comp_estadocomportamiento, comp_reconoceresponsabilidad:comp_reconoceresponsabilidad, comp_grado_falta:comp_grado_falta, comp_codigofalta:comp_codigofalta, comp_faltacometida:comp_faltacometida, comp_monto:comp_monto, comp_linkvideo:comp_linkvideo, comp_obs_log:comp_obs_log},
          success: function(data) {
            tablaReportegdh.ajax.reload(null, false);
          }
        });
      }
      $('#modal_crud_comportamiento_editar').modal('hide');
    }
  });
  ///:: FIN BOTON GRABAR -> REALIZA LA GRABACION DEL COMPORTAMIENTO :::::::::::::::::::::::///

  
});


