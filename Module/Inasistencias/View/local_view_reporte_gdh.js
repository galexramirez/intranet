///::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
///:: TAB REPORTE GDH v 2.0  FECHA: 2023-047-25 :::::::::::::::::::::::::::::::::::::::::::///
///:: MOSTRAR INASISTENCIAS REPORTADOS A GDH ::::::::::::::::::::::::::::::::::::::::::::::///
///::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///

///:: DECLARACION DE VARIABLES ::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
var tabla_reporte_gdh, rgdh_fecha_inicio, rgdh_fecha_termino;
rgdh_fecha_inicio = "";
rgdh_fecha_termino = "";

///:: JS DOM REPORTE GDH :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
$(document).ready(function(){
  if(rgdh_fecha_inicio=="" && rgdh_fecha_termino==""){
    rgdh_fecha_inicio   = f_CalculoFecha("hoy","0");
    rgdh_fecha_termino  = f_CalculoFecha("hoy","0");
    $('#rgdh_fecha_inicio').val(rgdh_fecha_inicio);
    $('#rgdh_fecha_termino').val(rgdh_fecha_termino);
  }

  // Si hay cambios en el Fecha se ocultan botones y datatable
  $("#rgdh_fecha_inicio").on('change', function () {
    $("#tabla_reporte_gdh").dataTable().fnDestroy();
    $('#tabla_reporte_gdh').hide();  
  });

  $("#rgdh_fecha_termino").on('change', function () {
    $("#tabla_reporte_gdh").dataTable().fnDestroy();
    $('#tabla_reporte_gdh').hide();
  });

  ///:: BOTONES REPORTE GDH :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///

  ///:: BOTON LISTAR REPORTE GDH ::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
  $(document).on("click", ".btn_buscar_reporte_gdh", function(){
    rgdh_fecha_inicio   = $("#rgdh_fecha_inicio").val();
    rgdh_fecha_termino  = $("#rgdh_fecha_termino").val();

    div_tabla       = f_CreacionTabla("tabla_reporte_gdh","");
    columnas_tabla  = f_ColumnasTabla("tabla_reporte_gdh","");
    $("#div_tabla_reporte_gdh").html(div_tabla);

    // Setup - add a text input to each footer cell
    $('#tabla_reporte_gdh thead tr')
    .clone(true)
    .addClass('filters_reporte_gdh')
    .appendTo('#tabla_reporte_gdh thead');

    Accion = 'buscar_reporte_gdh';
    $("#tabla_reporte_gdh").dataTable().fnDestroy();
    $('#tabla_reporte_gdh').show();

    tabla_reporte_gdh = $('#tabla_reporte_gdh').DataTable({
       //Filtros por columnas
      orderCellsTop: true,
      fixedHeader: true,
      initComplete: function (){
      var api = this.api();
      // For each column
      api.columns().eq(0).each(function (colIdx) {
        // Set the header cell to contain the input element
        var cell = $('.filters_reporte_gdh th').eq($(api.column(colIdx).header()).index());
        var title = $(cell).text();
        $(cell).html('<input type="text" placeholder="' + title + '" />');
        // On every keypress in this input
        $('input',$('.filters_reporte_gdh th').eq($(api.column(colIdx).header()).index()) ).off('keyup change').on('keyup change', function (e) {
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
          title         : 'REPORTE GDH'
        },
      ],
      "ajax"            : {
        "url"           : "Ajax.php", 
        "method"        : 'POST', //usamos el metodo POST
        "data"          : {MoS:MoS, NombreMoS:NombreMoS, Accion:Accion, fecha_inicio:rgdh_fecha_inicio, fecha_termino:rgdh_fecha_termino}, //enviamos opcion 4 para que haga un SELECT
        "dataSrc"       : ""
      },
      "columns"         : columnas_tabla,
      "order"           : [[0, 'desc']]
    });
  });
  ///:: FIN BOTON LISTAR REPORTE GDH ::::::::::::::::::::::::::::::::::::::::::::::::::::::///

  ///:: BOTON EDITAR INASISTENCIAS ::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
  $(document).on("click", ".btn_editar_inasistencias", function(){
    $("#form_inasistencias_editar").trigger("reset");
    f_cargar_variables_vacio_inasistencias(); // se inicialiazan las variables de informe de INASISTENCIAS
    fila_inasistencias  = $(this).closest('tr'); 
    inasistencias_id    = fila_inasistencias.find('td:eq(0)').text(); 
    opcion_inasistencias= "EDITAR";
    ///:: SE BUSCA Y SE CARGA EL INFORME INASISTENCIAS
    Accion='carga_inasistencias';
    $.ajax({
      url       : "Ajax.php",
      type      : "POST",
      datatype  : "json",
      async     : false,    
      data      : {MoS:MoS,NombreMoS:NombreMoS,Accion:Accion,inasistencias_id:inasistencias_id},
      success   : function(data){
        data = $.parseJSON(data);
        f_cargar_variables_inasistencias(data);
      }
    });

    $("#div_form_inasistencias").html("");
    div_show = f_MostrarDiv("form_inasistencias_editar","div_form_inasistencias_editar",inas_estadoinasistencias);
    $("#div_form_inasistencias_editar").html(div_show);
    f_cargar_combos_inasistencias();
    f_carga_variables_html_inasistencias();

    //$("#div_reporte_gdh").show();
    $(".modal-header").css( "background-color", "#17a2b8");
    $(".modal-header").css( "color", "white" );
    $('#modal_crud_inasistencias_editar').modal('show');
    $(".modal-title").text("Editar Inasistencias");
    $('#modal-resizable_inasistencias_editar').resizable();
    $(".modal-dialog").draggable({
      cursor: "move",
      handle: ".dragable_touch",
    });

  });
  ///:: FIN BOTON INFORME INASISTENCIAS :::::::::::::::::::::::::::::::::::::::::::::::::::///

  ///:: EVENTO DEL BOTON VER LOG INASISTENCIAS EDITAR :::::::::::::::::::::::::::::::::::::///
  $(document).on("click", ".btn_log_inasistencias_editar", function(){
    $("#form_modal_log_inasistencias_editar").trigger("reset");
    $("#div_log_inasistencias_editar").html(inas_log);
    
    $(".modal-header-log_editar").css( "background-color", "#17a2b8");
    $(".modal-header-log_editar").css( "color", "white" );
    $(".modal-title-log_editar").text("Log");
    $('#modal_crud_log_inasistencias_editar').modal('show');
    $('#modal-resizable_log_editar').resizable();
    $(".modal-dialog").draggable({
      cursor: "move",
      handle: ".dragable_touch",
    });
  });
  ///:: FIN EVENTO DEL BOTON VER LOG INASISTENCIAS EDITAR :::::::::::::::::::::::::::::::::///

  //:: BOTON GRABAR -> REALIZA LA EDICION EN LA TABLA ope_inasistencias :::::::::::::::::::///
  $('#form_inasistencias_editar').submit(function(e){
    e.preventDefault(); //evita el comportambiento normal del submit, es decir, recarga total de la página
    let t_validar_inasistencias_editar = "";
    f_cargar_variables_editadas_inasistencias();
    t_validar_inasistencias_editar     = f_validar_inasistencias(inas_estadoinasistencias);

    if(t_validar_inasistencias_editar=="invalido"){
      Swal.fire({
        icon: 'error',
        title: 'EDITAR...',
        text: '*Los Campos no pueden estar VACIOS!'
      });
    }else{
      // EDITAR INASISTENCIAS
      if(opcion_inasistencias=="EDITAR"){
        $("#btn_guardar_inasistencias_editar").prop("disabled",true);
        Accion = 'editar_inasistencias';
        $.ajax({
          url       : "Ajax.php",
          type      : "POST",
          datatype  : "json",    
          data      :  { MoS:MoS, NombreMoS:NombreMoS, Accion:Accion, inasistencias_id:inasistencias_id, inas_tiponovedad:inas_tiponovedad, inas_detallenovedad:inas_detallenovedad, inas_fechaoperacion:inas_fechaoperacion, inas_nombrecolaborador:inas_nombrecolaborador, inas_descripcion:inas_descripcion,inas_tabla:inas_tabla, inas_servicio:inas_servicio, inas_bus:inas_bus, inas_nombrecgo:inas_nombrecgo, inas_lugarexacto:inas_lugarexacto, inas_horainicio:inas_horainicio, inas_horafin:inas_horafin, inas_totalhoras:inas_totalhoras, inas_obs_log:inas_obs_log, inas_estadoinasistencias:inas_estadoinasistencias, inas_lugar_origen:inas_lugar_origen, inas_lugar_destino:inas_lugar_destino},
          success   : function(data) {
            tabla_reporte_gdh.ajax.reload(null, false);
          }
        });
      }
      $('#modal_crud_inasistencias_editar').modal('hide');
    }
  });
  //:: FIN BOTON GRABAR -> REALIZA LA GRABACION EN LA TABLA ope_inasistencias :::::::::::::///


  ///:: TERMINO BOTONES REPORTE GDH :::::::::::::::::::::::::::::::::::::::::::::::::::::::///

});
///:: TERMINO JS DOM REPORTE GDH ::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///