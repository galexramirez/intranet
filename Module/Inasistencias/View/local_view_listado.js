///::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
///:: LISTADO INASISTENCIAS v 3.0  FECHA: 2023-04-24 ::::::::::::::::::::::::::::::::::::::///
///:: MOSTRAR LISTADO INASISTENCIAS :::::::::::::::::::::::::::::::::::::::::::::::::::::::///
///::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///

///:: DECLARACION DE VARIABLES ::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///

var tabla_inasistencias, fila_inasistencias;
var ope_inasistenciasid, inasistencias_id, inas_programacionid, inas_controlfacilitadorid, inas_openovedadid, inas_novedadid, inas_tiponovedad, inas_detallenovedad, inas_descripcion, inas_operacion, inas_fechaoperacion, inas_estadoinasistencias, inas_dni, inas_codigocolaborador, inas_nombrecolaborador, inas_codigocgo, inas_nombrecgo, inas_tabla, inas_servicio, inas_bus, inas_lugarexacto, inas_horainicio, inas_horafin, inas_totalhoras, inas_cfargid, inas_usuarioid_generar, inas_fechagenerar, inas_usuarioid_edicion, inas_fechaedicion, inas_usuarioid_cerrar, inas_fechacerrar, horainicio, minutoinicio, horafin, minutofin,  inas_log, inas_obs_log, inas_lugar_origen, inas_lugar_destino;
var select_html_inasistencias, tDefaultContentInasistencias, opcion_inasistencias;
var in_fecha_inicio, in_fecha_termino, fecha_inicio_inasistencias;

in_fecha_inicio = "";
in_fecha_termino = "";
fecha_inicio_inasistencias = '2023-05-08';

///:: JS DOM LISTADO INASISTENCIAS ::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
$(document).ready(function(){
  if(in_fecha_inicio=="" && in_fecha_termino==""){
    in_fecha_inicio   = f_CalculoFecha("hoy","0");
    in_fecha_termino  = f_CalculoFecha("hoy","0");
    $('#in_fecha_inicio').val(in_fecha_inicio);
    $('#in_fecha_termino').val(in_fecha_termino);
  }

  // Si hay cambios en el Fecha se ocultan botones y datatable
  $("#in_fecha_inicio").on('change', function () {
    $("#tabla_inasistencias").dataTable().fnDestroy();
    $('#tabla_inasistencias').hide();
  });

  $("#no_fecha_termino").on('change', function () {
    $("#tabla_inasistencias").dataTable().fnDestroy();
    $('#tabla_inasistencias').hide();  
  });

  ///:: BOTONES INASISTENCIAS :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///

  ///:: BOTON BUSCAR INASISTENCIAS ::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
  $(document).on("click", ".btn_buscar_inasistencias", function(){
    in_fecha_inicio   = $("#in_fecha_inicio").val();
    in_fecha_termino  = $("#in_fecha_termino").val();
  
    if(Date.parse(in_fecha_inicio)<Date.parse(fecha_inicio_inasistencias)){
      Swal.fire({
        icon: 'error',
        title: 'FECHAS...',
        text: '*Inasistencias inicia a partir del 08/05/2023!'
      });
    }else{
      div_tabla       = f_CreacionTabla("tabla_inasistencias","");
      columnas_tabla  = f_ColumnasTabla("tabla_inasistencias","");
      $("#div_tabla_inasistencias").html(div_tabla);
  
      $('#tabla_inasistencias thead tr')
      .clone(true)
      .addClass('filters_inasistencias')
      .appendTo('#tabla_inasistencias thead');
  
      Accion='buscar_inasistencias';
      $("#tabla_inasistencias").dataTable().fnDestroy();
      $('#tabla_inasistencias').show();
  
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
        // Para mostrar la barra scroll horizontal y vertical
        deferRender     : true,
        scrollY         : 800,
        scrollCollapse  : true,
        scroller        : true,
        scrollX         : true,
        fixedColumns    : {
          left          : 1
        },
        fixedHeader     : {
          header        : false
        },
        language        : idiomaEspanol,
        responsive      : "true",
        dom             : 'Blfrtip',
        pageLength      : 50,
        buttons: [
          {
            extend      : 'excelHtml5',
            text        : '<i class="fas fa-file-excel"></i> ',
            titleAttr   : 'Exportar a Excel',
            className   : 'btn btn-success',
            title       : 'INASISTENCIAS',
          },
        ],
        "ajax"            : {
          "url"           : "Ajax.php", 
          "method"        : 'POST', 
          "data"          : {MoS:MoS,NombreMoS:NombreMoS,Accion:Accion,fecha_inicio:in_fecha_inicio, fecha_termino:in_fecha_termino},
          "dataSrc"       : ""
        },
        "columns"         : columnas_tabla,
        "columnDefs"      : [
          {
            "targets"     : [10, 11],
            "orderable"   : false,
          },
          {
            "targets"   : [13],
            "render"    : function(data, type, row, meta) {
                if(data==null){
                    return "PENDIENTE ANALISIS OP";
                }else{
                    return data;
                }
            }
          }
        ],
        "order": [[1, 'desc']]
      });  
    }
  });
  ///:: FIN BOTON BUSCAR INASISTENCIAS ::::::::::::::::::::::::::::::::::::::::::::::::::::///

  ///:: BOTON INFORME INASISTENCIAS :::::::::::::::::::::::::::::::::::::::::::::::::::::::///
  $(document).on("click", ".btn_inasistencias", function(){
    f_cargar_variables_vacio_inasistencias(); // se inicialiazan las variables de informe de INASISTENCIAS
    fila_inasistencias  = $(this).closest('tr'); 
    inas_programacionid = fila_inasistencias.find('td:eq(0)').text();
    inas_novedadid      = fila_inasistencias.find('td:eq(1)').text();
    inasistencias_id    = fila_inasistencias.find('td:eq(12)').text();
  
    ///:: SI EL ESTADO ES VACIO SE REALIZA LA CARGA INICIAL DEL INFORME INASISTENCIAS CON LA INFORMACION DEL CONTROL FACILITADOR Y NOVEDAD
    if(inasistencias_id==""){
      opcion_inasistencias  = "CREAR";
      Accion                = 'carga_inicial_inasistencias';
      $.ajax({
        url       : "Ajax.php",
        type      : "POST",
        datatype  : "json",
        async     : false,    
        data      : {MoS:MoS,NombreMoS:NombreMoS,Accion:Accion,inas_programacionid:inas_programacionid,inas_novedadid:inas_novedadid},    
        success   : function(data){
          data = $.parseJSON(data);
          f_carga_inicial_inasistencias(data);
        }
      });
      $(".modal-title").text("Crear Inasistencias");
    }else{
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
      $(".modal-title").text("Ver Inasistencias");
    }

    $("#div_form_inasistencias_editar").html("");
    div_show = f_MostrarDiv("formInasistencias","div_form_inasistencias",inas_estadoinasistencias);
    $("#div_form_inasistencias").html(div_show);
    f_cargar_combos_inasistencias();
    f_carga_variables_html_inasistencias();

    $("#div_reporte_gdh").show();
    $(".modal-header").css( "background-color", "#17a2b8");
    $(".modal-header").css( "color", "white" );
    $('#modal_crud_inasistencias').modal('show');
    
    $('#modal-resizable_inasistencias').resizable();
    $(".modal-dialog").draggable({
      cursor: "move",
      handle: ".dragable_touch",
    });

  });
  ///:: FIN BOTON INFORME INASISTENCIAS :::::::::::::::::::::::::::::::::::::::::::::::::::///

  ///:: BOTON REPORTE CONTROL FACILITADOR :::::::::::::::::::::::::::::::::::::::::::::::::///
  $(document).on("click", ".btn_reporte_facilitador", function(){
    fila_inasistencias  = $(this).closest('tr'); 
    Nove_ProgramacionId = fila_inasistencias.find('td:eq(0)').text();
    Novedad_Id          = fila_inasistencias.find('td:eq(1)').text();
    Accion              = 'detalle_control_facilitador';

    $.ajax({
      url       : "Ajax.php",
      type      : "POST",
      datatype  : "json",
      async     : false,    
      data      : {MoS:MoS,NombreMoS:NombreMoS,Accion:Accion,Nove_ProgramacionId:Nove_ProgramacionId,Novedad_Id:Novedad_Id},
      success   : function(data){
        $('#div_detalle_control_facilitador').html(data);
      }
    });
    $(".modal-header").css( "background-color", "#17a2b8" );
    $(".modal-header").css( "color", "white" );
    $(".modal-title").text( "Detalle Control Facilitador" );
    $('#modal_crud_detalle_control_facilitador').modal('show');
    $('#modal-resizable_detalle_cf').resizable();
    $(".modal-dialog").draggable({
      cursor: "move",
      handle: ".dragable_touch",
    });

  });
  ///:: FIN BOTON REPORTE CONTROL FACILITADOR :::::::::::::::::::::::::::::::::::::::::::::///

  ///:: TERMINO BOTONES INASISTENCIAS :::::::::::::::::::::::::::::::::::::::::::::::::::::///
});
///:: TERMINO JS DOM LISTADO INASISTENCIAS ::::::::::::::::::::::::::::::::::::::::::::::::///

///:: FUNCIONES INASISTENCIAS :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///

///:: SE INICIALIZAN LAS VARIABLES DEL INFORME DE INASISTENCIAS :::::::::::::::::::::::::::///
function f_cargar_variables_vacio_inasistencias(){
  inasistencias_id        = "";
  inas_tiponovedad        = "";
  inas_detallenovedad     = "";
  inas_fechaoperacion     = "";
  inas_operacion          = "";
  inas_nombrecolaborador  = "";
  inas_descripcion        = "";
  inas_tabla              = "";
  inas_servicio           = "";
  inas_bus                = "";
  inas_nombrecgo          = "";
  inas_lugarexacto        = "";
  inas_horainicio         = "";
  inas_horafin            = "";
  inas_totalhoras         = "";
  inas_usuarioid_edicion  = "";
  inas_fechaedicion       = "";
  horainicio              = "";
  minutoinicio            = "";
  horafin                 = "";
  minutofin               = "";
  inas_estadoinasistencias= "";
  inas_log                = "";
  inas_obs_log            = "";
  inas_lugar_origen       = "";
  inas_lugar_destino      = "";
}
///:: FIN SE INICIALIZAN LAS VARIABLES DEL INFORME DE INASISTENCIAS :::::::::::::::::::::::///

///:: SE CARGAN LAS VARIABLES CON LA INFORMACION DE NOVEDADES :::::::::::::::::::::::::::::///
function f_carga_inicial_inasistencias(p_data){
  $.each(p_data, function(idx, obj){ 
    inas_tiponovedad        = obj.inas_tiponovedad;
    inas_detallenovedad     = obj.inas_detallenovedad;
    inas_fechaoperacion     = obj.inas_fechaoperacion;
    inas_operacion          = obj.inas_operacion;
    inas_nombrecolaborador  = obj.inas_nombrecolaborador;
    inas_descripcion        = obj.inas_descripcion;
    inas_tabla              = obj.inas_tabla;
    inas_servicio           = obj.inas_servicio;
    inas_bus                = obj.inas_bus;
    inas_nombrecgo          = obj.inas_nombrecgo;
    inas_lugarexacto        = obj.inas_lugarexacto;
    inas_horainicio         = obj.inas_horainicio;
    inas_horafin            = obj.inas_horafin;
    horainicio              = inas_horainicio.substring(0,2);
    minutoinicio            = inas_horainicio.substring(3,5);
    horafin                 = inas_horafin.substring(0,2);
    minutofin               = inas_horafin.substring(3,5);
    inas_totalhoras         = f_calcular_diferencia_horas(inas_horainicio,inas_horafin);
    inas_estadoinasistencias= "";
    inas_log                = "";
    inas_lugar_origen       = obj.inas_lugar_origen;
    inas_lugar_destino      = obj.inas_lugar_destino;
  });
}
///:: FIN CARGA DE VARIABLES CON LA INFORMACION DE NOEVDADES ::::::::::::::::::::::::::::::///

///:: SE CARGAN LAS VARIABLES CON LA INFORMACION DE INASISTENCIAS :::::::::::::::::::::::::///
function f_cargar_variables_inasistencias(p_data){
  $.each(p_data, function(idx, obj){ 
    inas_tiponovedad        = obj.inas_tiponovedad;
    inas_detallenovedad     = obj.inas_detallenovedad;
    inas_fechaoperacion     = obj.inas_fechaoperacion;  
    inas_operacion          = obj.inas_operacion;
    inas_nombrecolaborador  = obj.inas_nombrecolaborador;
    inas_descripcion        = obj.inas_descripcion;
    inas_tabla              = obj.inas_tabla;
    inas_servicio           = obj.inas_servicio;
    inas_bus                = obj.inas_bus;
    inas_nombrecgo          = obj.inas_nombrecgo;
    inas_lugarexacto        = obj.inas_lugarexacto;
    inas_horainicio         = obj.inas_horainicio;
    inas_horafin            = obj.inas_horafin;
    inas_totalhoras         = obj.inas_totalhoras;
    inas_usuarioid_edicion  = obj.Usua_Nombres;
    inas_fechaedicion       = obj.inas_fechaedicion;
    horainicio              = inas_horainicio.substring(0,2);
    minutoinicio            = inas_horainicio.substring(3,5);
    horafin                 = inas_horafin.substring(0,2);
    minutofin               = inas_horafin.substring(3,5);
    inas_estadoinasistencias= obj.inas_estadoinasistencias;
    inas_log                = obj.inas_log;
    inas_lugar_origen       = obj.inas_lugar_origen;
    inas_lugar_destino      = obj.inas_lugar_destino;
  });
}
///:: FIN CARGA DE VARIABLES CON LA INFORMACION DE INASISTENCIAS ::::::::::::::::::::::::::///

///:: SE CARGAN LAS VARIABLES HTML CON LA INFORMACION :::::::::::::::::::::::::::::::::::::///
function f_carga_variables_html_inasistencias(){
  $("#inasistencias_id").val(inasistencias_id);
  $("#inas_tiponovedad").val(inas_tiponovedad);
  $("#inas_detallenovedad").val(inas_detallenovedad);
  $("#inas_fechaoperacion").val(inas_fechaoperacion);
  $("#inas_nombrecolaborador").val(inas_nombrecolaborador);
  $("#inas_descripcion").val(inas_descripcion);
  $("#inas_tabla").val(inas_tabla);
  $("#inas_servicio").val(inas_servicio);
  $("#inas_bus").val(inas_bus);
  $("#inas_nombrecgo").val(inas_nombrecgo);
  $("#inas_lugarexacto").val(inas_lugarexacto)
  $("#horainicio").val(horainicio);
  $("#minutoinicio").val(minutoinicio);
  $("#horafin").val(horafin);
  $("#minutofin").val(minutofin);
  $("#inas_totalhoras").val(inas_totalhoras);
  $("#inas_usuarioid_edicion").val(inas_usuarioid_edicion);
  $("#inas_fechaedicion").val(inas_fechaedicion);
  $("#inas_estadoinasistencias").val(inas_estadoinasistencias);
  $("#inas_obs_log").val(inas_obs_log);
  $("#inas_lugar_origen").val(inas_lugar_origen);
  $("#inas_lugar_destino").val(inas_lugar_destino);
}
///:: SE CARGAN LAS VARIABLES HTML CON LA INFORMACION :::::::::::::::::::::::::::::::::::::///

///:: CARGAR LOS COMBOS PARA INASISTENCIAS ::::::::::::::::::::::::::::::::::::::::::::::::///
function f_cargar_combos_inasistencias(){
  ///:: COMBOS DE USUARIOS

  let Usua_Perfil = 'PILOTO';
  let roles_campo = 'Colab_ApellidosNombres';
  t_html = f_select_roles(Usua_Perfil,roles_campo);
  $("#inas_nombrecolaborador").html(t_html);

  Usua_Perfil = 'PERSONAL OPERACIONES';
  t_html = f_select_roles(Usua_Perfil,roles_campo);
  $("#inas_nombrecgo").html(t_html);

  ///:: COMBOS DE BUS
  Accion = 'select_bus'; 
  $.ajax({
    url       : "Ajax.php",
    type      : "POST",
    datatype  : "json",
    async     : false,
    data      : {MoS:MoS,NombreMoS:NombreMoS,Accion:Accion, operacion:inas_operacion},    
    success   : function(data){
      $("#inas_bus").html(data);
    }
  });

  ///:: COMBOS TABLA
  Accion = 'select_tabla';
  $.ajax({
    url       : "Ajax.php",
    type      : "POST",
    datatype  : "json",
    async     : false,
    data      : {MoS:MoS,NombreMoS:NombreMoS,Accion:Accion,Prog_Fecha:inas_fechaoperacion, operacion:inas_operacion},    
    success   : function(data){
      $("#inas_tabla").html(data);
    }
  });

  ///:: ASIGNAR SERVICIO
  Accion = 'buscar_servicio';
  $.ajax({
    url       : "Ajax.php",
    type      : "POST",
    datatype  : "json",
    data      : {MoS:MoS,NombreMoS:NombreMoS,Accion:Accion,Prog_Fecha:inas_fechaoperacion,Prog_Tabla:inas_tabla},
    success   : function(data){
      $("#inas_servicio").val(data);
    }
  });

  ///:: COMBOS DE TABLA TIPO PARA INASISTENCIAS
  Operacion = 'INASISTENCIAS';
  Tipo      = 'TIPO NOVEDAD';
  select_html_inasistencias = "";
  select_html_inasistencias = f_select_tipos(Operacion,Tipo);
  $("#inas_tiponovedad").html(select_html_inasistencias);
  
  Tipo      = inas_tiponovedad;
  select_html_inasistencias = "";
  select_html_inasistencias = f_select_tipos(Operacion,Tipo);
  $("#inas_detallenovedad").html(select_html_inasistencias);

  Tipo      = 'ESTADO';
  select_html_inasistencias = "";
  select_html_inasistencias = f_select_tipos(Operacion,Tipo);
  $("#inas_estadoinasistencias").html(select_html_inasistencias);
  
  Tipo      = 'LUGAR';
  select_html_inasistencias = "";
  select_html_inasistencias = f_select_tipos(inas_operacion,Tipo);
  $("#inas_lugar_origen").html(select_html_inasistencias);
  $("#inas_lugar_destino").html(select_html_inasistencias);
}
///:: FIN CARGA LOS COMBOS PARA INASISTENCIAS :::::::::::::::::::::::::::::::::::::::::::::///

///:: TERMINO FUNCIONES DE INASISTENCIAS ::::::::::::::::::::::::::::::::::::::::::::::::::///