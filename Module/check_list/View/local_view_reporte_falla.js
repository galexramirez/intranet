///::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
///::: REPORTE DE FALLAS DE INSPECCION DE FLOTA v 1.0 :::::::::::::::::::::::::::::::::::::///
///::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///

///:: DECLARACION DE VARIABLES GLOBALES :::::::::::::::::::::::::::::::::::::::::::::::::::///
  
///:: JS DOM REPORTE FALLAS DE INSPECCION FLOTA :::::::::::::::::::::::::::::::::::::::::::///
$(document).ready(function(){
  div_show = f_MostrarDiv("form_seleccion_reporte_falla","btn_seleccion_reporte_falla","");
  $("#div_btn_seleccion_reporte_falla").html(div_show);

  $("#reporte_falla_fecha_inicio").val(f_CalculoFecha("hoy","-7 days"));
  $("#reporte_falla_fecha_termino").val(f_CalculoFecha("hoy","0"));
  ///:: BOTONES REPORTE DE INSPECCION DE FLOTA ::::::::::::::::::::::::::::::::::::::::::::///
    
  ///:: EVENTO BOTON BUSCAR REPORTE DE INSPECCION DE FLOTA ::::::::::::::::::::::::::::::::///
  $(document).on("click", ".btn_buscar_reporte_falla", function(){
    let reporte_falla_fecha_inicio = $("#reporte_falla_fecha_inicio").val();
    let reporte_falla_fecha_termino = $("#reporte_falla_fecha_termino").val();
    
    div_tabla     = f_CreacionTabla("tabla_reporte_falla","");
    $("#div_tabla_reporte_falla").html(div_tabla);
    columnas_tabla = f_ColumnasTabla("tabla_reporte_falla","")
    
    $('#tabla_reporte_falla').dataTable().fnDestroy();
    $('#tabla_reporte_falla').show();

    // Setup - add a text input to each footer cell
    $('#tabla_reporte_falla thead tr')
      .clone(true)
      .addClass('filters_reporte_falla')
      .appendTo('#tabla_reporte_falla thead');

    Accion  = 'buscar_reporte_falla';
    tabla_reporte_falla = $('#tabla_reporte_falla').DataTable({
        "rowCallback":function(row,data,index){
            f_color_filas_reporte_falla(row,data);
        },
         //Filtros por columnas
         orderCellsTop : true,
         fixedHeader : true,
         initComplete: function (){
           var api = this.api();
           // For each column
           api.columns().eq(0).each(function (colIdx) {
             // Set the header cell to contain the input element
             var cell = $('.filters_reporte_falla th').eq($(api.column(colIdx).header()).index());
             var title = $(cell).text();
             $(cell).html('<input type="text" placeholder="' + title + '" />');
             // On every keypress in this input
             $('input',$('.filters_reporte_falla th').eq($(api.column(colIdx).header()).index()) ).off('keyup change').on('keyup change', function (e) {
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
          title     : 'FALLAS EN CHECK LIST DE FLOTA DEL '+reporte_falla_fecha_inicio+' AL '+reporte_falla_fecha_termino,
        },
      ],
      "ajax"        : {            
        "url"       : "Ajax.php", 
        "method"    : 'POST', 
        //"data"      : {MoS:MoS, NombreMoS:NombreMoS, Accion:Accion, inspeccion_id:fal_inspeccion_id, insp_bus:fal_inspeccion_bus},
        "data"      : {MoS:MoS, NombreMoS:NombreMoS, Accion:Accion, fecha_inicio:reporte_falla_fecha_inicio, fecha_termino:reporte_falla_fecha_termino},
        "dataSrc"   : ""
      },
      "columns"     : columnas_tabla,
      "order"       : [[2, 'asc']]
    });    
  });
  ///:: FIN EVENTO BOTON BUSCAR REPORTE DE INSPECCION DE FLOTA ::::::::::::::::::::::::::::///

  ///:: TERMINO BOTONES REPORTE DE INSPECCION DE FLOTA ::::::::::::::::::::::::::::::::::::///


});    
///:: TERMINO JS DOM REPORTE DE INSPECCION FLOTA ::::::::::::::::::::::::::::::::::::::::::///


///:: FUNCIONES DE REPORTE DE INSPECCION DE FLOTA :::::::::::::::::::::::::::::::::::::::::///
///:: CAMBIA EL COLOR DEL CAMPO ESTADO EN EL DATATABLE ::::::::::::::::::::::::::::::::::::///
function f_color_filas_reporte_falla(row, data){
  let color_rojo  = "#E26A5A";
  let color_verde = "#009390";
  let color_azul  = "#005EA4";
  
  // Columna
  if(data.chl_estado == 'ABIERTO') {
    $("td:eq(6)",row).css({
      "color":color_rojo,
    });
  }

  // Columna 
  if(data.chl_estado == 'CERRADO') {
    $("td:eq(6)",row).css({
      "color":color_verde,
    });
  }

  // Columna 
  if(data.chl_estado == 'ANULADO') {
    $("td:eq(6)",row).css({
      "color":color_azul,
    });
  }

}
///:: FIN CAMBIA EL COLOR DEL CAMPO ESTADO EN EL DATATABLE ::::::::::::::::::::::::::::::::///

///:: TERMINO FUNCIONES DE REPORTE DE INSPECCION DE FLOTA :::::::::::::::::::::::::::::::::///
