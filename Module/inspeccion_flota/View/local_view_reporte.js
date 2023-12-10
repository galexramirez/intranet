///::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
///::: REPORTE DE INSPECCION DE FLOTA v 1.0 :::::::::::::::::::::::::::::::::::::::::::::::///
///::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///

///:: DECLARACION DE VARIABLES GLOBALES :::::::::::::::::::::::::::::::::::::::::::::::::::///
  
///:: JS DOM REPORTE DE INSPECCION FLOTA ::::::::::::::::::::::::::::::::::::::::::::::::::///
$(document).ready(function(){
  let select_rep_insp = "";
  div_show = f_MostrarDiv("form_seleccion_reporte","btn_seleccion_reporte","");
  $("#div_btn_seleccion_reporte").html(div_show);

  $("#repo_fecha_inicio").val(f_CalculoFecha("hoy","-7 days"));
  $("#repo_fecha_termino").val(f_CalculoFecha("hoy","0"));
  
  $("#rep_inspeccion_id").on('change', function () {
    rep_inspeccion_id = $("#rep_inspeccion_id").val();
    rep_inspeccion_bus = "";
    select_rep_insp = f_select_combo("manto_inspeccion_detalle", "NO", "insp_bus", "", "`inspeccion_id`='"+rep_inspeccion_id+"'");
    $("#rep_inspeccion_bus").html(select_rep_insp);
    $("#rep_inspeccion_bus").val(rep_inspeccion_bus);
    div_show = f_MostrarDiv("form_seleccion_reporte","btn_seleccion_reporte","");
    $("#div_btn_seleccion_reporte").html(div_show);    
    $("#div_tabla_reporte").empty();
  });
  
  $("#rep_inspeccion_bus").on('change', function () {
    div_show = f_MostrarDiv("form_seleccion_reporte","btn_seleccion_reporte","");
    $("#div_btn_seleccion_reporte").html(div_show);  
    $("#div_tabla_reporte").empty();
  });
    
  ///:: BOTONES REPORTE DE INSPECCION DE FLOTA ::::::::::::::::::::::::::::::::::::::::::::///
    
  ///:: EVENTO BOTON BUSCAR REPORTE DE INSPECCION DE FLOTA ::::::::::::::::::::::::::::::::///
  $(document).on("click", ".btn_buscar_reporte", function(){
    let repo_fecha_inicio = $("#repo_fecha_inicio").val();
    let repo_fecha_termino = $("#repo_fecha_termino").val();
    rep_inspeccion_bus = "";
    /*rep_inspeccion_id = $("#rep_inspeccion_id").val();
    rep_inspeccion_bus = $("#rep_inspeccion_bus").val();*/
    
    div_tabla     = f_CreacionTabla("tabla_reporte",rep_inspeccion_bus);
    $("#div_tabla_reporte").html(div_tabla);
    columnas_tabla = f_ColumnasTabla("tabla_reporte",rep_inspeccion_bus)
    
    $('#tabla_reporte').dataTable().fnDestroy();
    $('#tabla_reporte').show();

    // Setup - add a text input to each footer cell
    $('#tabla_reporte thead tr')
      .clone(true)
      .addClass('filters_reporte')
      .appendTo('#tabla_reporte thead');

    if(rep_inspeccion_bus===""){
      Accion  = 'buscar_reporte';
    }else{
      Accion  = 'buscar_reporte_bus';
    }
    
    tabla_reporte = $('#tabla_reporte').DataTable({
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
             var cell = $('.filters_reporte th').eq($(api.column(colIdx).header()).index());
             var title = $(cell).text();
             $(cell).html('<input type="text" placeholder="' + title + '" />');
             // On every keypress in this input
             $('input',$('.filters_reporte th').eq($(api.column(colIdx).header()).index()) ).off('keyup change').on('keyup change', function (e) {
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
          //title     : 'INSPECCION DE FLOTA ID '+rep_inspeccion_id,
          title     : 'INSPECCION DE FLOTA DEL '+repo_fecha_inicio+' AL '+repo_fecha_termino,
        },
      ],
      "ajax"        : {            
        "url"       : "Ajax.php", 
        "method"    : 'POST', 
        //"data"      : {MoS:MoS, NombreMoS:NombreMoS, Accion:Accion, inspeccion_id:rep_inspeccion_id, insp_bus:rep_inspeccion_bus},
        "data"      : {MoS:MoS, NombreMoS:NombreMoS, Accion:Accion, fecha_inicio:repo_fecha_inicio, fecha_termino:repo_fecha_termino},
        "dataSrc"   : ""
      },
      "columns"     : columnas_tabla,
      "order"       : [[3, 'asc']]
    });    
  });
  ///:: FIN EVENTO BOTON BUSCAR REPORTE DE INSPECCION DE FLOTA ::::::::::::::::::::::::::::///

  ///:: TERMINO BOTONES REPORTE DE INSPECCION DE FLOTA ::::::::::::::::::::::::::::::::::::///


});    
///:: TERMINO JS DOM REPORTE DE INSPECCION FLOTA ::::::::::::::::::::::::::::::::::::::::::///


///:: FUNCIONES DE REPORTE DE INSPECCION DE FLOTA :::::::::::::::::::::::::::::::::::::::::///

///:: TERMINO FUNCIONES DE REPORTE DE INSPECCION DE FLOTA :::::::::::::::::::::::::::::::::///
