///::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
///::: REPORTE DE FALLAS DE INSPECCION DE FLOTA v 1.0 :::::::::::::::::::::::::::::::::::::///
///::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///

///:: DECLARACION DE VARIABLES GLOBALES :::::::::::::::::::::::::::::::::::::::::::::::::::///
  
///:: JS DOM REPORTE FALLAS DE INSPECCION FLOTA :::::::::::::::::::::::::::::::::::::::::::///
$(document).ready(function(){
  let select_fal_insp = "";
  div_show = f_MostrarDiv("form_seleccion_falla","btn_seleccion_falla","");
  $("#div_btn_seleccion_falla").html(div_show);

  $("#falla_fecha_inicio").val(f_CalculoFecha("hoy","-7 days"));
  $("#falla_fecha_termino").val(f_CalculoFecha("hoy","0"));
  
  $("#fal_inspeccion_id").on('change', function () {
    fal_inspeccion_id = $("#fal_inspeccion_id").val();
    fal_inspeccion_bus = "";
    select_fal_insp = f_select_combo("manto_inspeccion_movimiento", "SI", "insp_bus", "", "`inspeccion_id`='"+fal_inspeccion_id+"'");
    $("#fal_inspeccion_bus").html(select_fal_insp);
    $("#fal_inspeccion_bus").val(fal_inspeccion_bus);
    div_show = f_MostrarDiv("form_seleccion_falla","btn_seleccion_falla","");
    $("#div_btn_seleccion_falla").html(div_show);    
    $("#div_tabla_falla").empty();
  });
  
  $("#fal_inspeccion_bus").on('change', function () {
    div_show = f_MostrarDiv("form_seleccion_falla","btn_seleccion_falla","");
    $("#div_btn_seleccion_falla").html(div_show);  
    $("#div_tabla_falla").empty();
  });
    
  ///:: BOTONES REPORTE DE INSPECCION DE FLOTA ::::::::::::::::::::::::::::::::::::::::::::///
    
  ///:: EVENTO BOTON BUSCAR REPORTE DE INSPECCION DE FLOTA ::::::::::::::::::::::::::::::::///
  $(document).on("click", ".btn_buscar_falla", function(){
    let falla_fecha_inicio = $("#falla_fecha_inicio").val();
    let falla_fecha_termino = $("#falla_fecha_termino").val();
    /* fal_inspeccion_id = $("#fal_inspeccion_id").val();
    fal_inspeccion_bus = $("#fal_inspeccion_bus").val(); */
    
    div_tabla     = f_CreacionTabla("tabla_falla","");
    $("#div_tabla_falla").html(div_tabla);
    columnas_tabla = f_ColumnasTabla("tabla_falla","")
    
    $('#tabla_falla').dataTable().fnDestroy();
    $('#tabla_falla').show();

    // Setup - add a text input to each footer cell
    $('#tabla_falla thead tr')
      .clone(true)
      .addClass('filters_falla')
      .appendTo('#tabla_falla thead');

    Accion  = 'buscar_falla';
    
    tabla_falla = $('#tabla_falla').DataTable({
        "rowCallback":function(row,data,index){
            f_color_filas_inspeccion(row,data);
        },
         //Filtros por columnas
         orderCellsTop : true,
         fixedHeader : true,
         initComplete: function (){
           var api = this.api();
           // For each column
           api.columns().eq(0).each(function (colIdx) {
             // Set the header cell to contain the input element
             var cell = $('.filters_falla th').eq($(api.column(colIdx).header()).index());
             var title = $(cell).text();
             $(cell).html('<input type="text" placeholder="' + title + '" />');
             // On every keypress in this input
             $('input',$('.filters_falla th').eq($(api.column(colIdx).header()).index()) ).off('keyup change').on('keyup change', function (e) {
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
  
      select        : {style: 'os'},
      language      : idioma_espanol,
      responsive    : "true",
      dom           : 'Blfrtip', 
      pageLength    : 50,
      buttons       : [
        {
          extend    : 'excelHtml5',
          text      : '<i class="fas fa-file-excel"></i> ',
          titleAttr : 'Exportar a Excel',
          className : 'btn btn-success',
          //title     : 'FALLAS EN INSPECCION DE FLOTA ID '+fal_inspeccion_id
          title     : 'FALLAS EN INSPECCION DE FLOTA DEL '+falla_fecha_inicio+' AL '+falla_fecha_termino,
        },
      ],
      "ajax"        : {            
        "url"       : "Ajax.php", 
        "method"    : 'POST', 
        //"data"      : {MoS:MoS, NombreMoS:NombreMoS, Accion:Accion, inspeccion_id:fal_inspeccion_id, insp_bus:fal_inspeccion_bus},
        "data"      : {MoS:MoS, NombreMoS:NombreMoS, Accion:Accion, fecha_inicio:falla_fecha_inicio, fecha_termino:falla_fecha_termino},
        "dataSrc"   : ""
      },
      "columns"     : columnas_tabla,
      "columnDefs": [
        {"className": "text-center", "targets": [0,1,2,3,10]}
      ],
      "order"       : [[0, 'asc']]
    });    
  });
  ///:: FIN EVENTO BOTON BUSCAR REPORTE DE INSPECCION DE FLOTA ::::::::::::::::::::::::::::///

  ///:: TERMINO BOTONES REPORTE DE INSPECCION DE FLOTA ::::::::::::::::::::::::::::::::::::///


});    
///:: TERMINO JS DOM REPORTE DE INSPECCION FLOTA ::::::::::::::::::::::::::::::::::::::::::///


///:: FUNCIONES DE REPORTE DE INSPECCION DE FLOTA :::::::::::::::::::::::::::::::::::::::::///

///:: TERMINO FUNCIONES DE REPORTE DE INSPECCION DE FLOTA :::::::::::::::::::::::::::::::::///
