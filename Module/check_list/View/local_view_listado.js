///::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
///:: CHECK LIST DE FLOTA 2023-09-25 ::::::::::::::::::::::::::::::::::::::::::::::::::::::///
///:: LISTADO CHECK LIST DE FLOTA v 1.0 :::::::::::::::::::::::::::::::::::::::::::::::::::///
///::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///

///:: DECLARACION VARIABLES GLOBALES ::::::::::::::::::::::::::::::::::::::::::::::::::::::///
var tabla_check_list, fila_check_list;
var check_list_id;

///:: DOM CHECAK LIST DE FLOTA :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
$(document).ready(function(){
  let select_html  = "";
  $("#sele_fecha_inicio").val(f_CalculoFecha("hoy","-7 days"));
  $("#sele_fecha_termino").val(f_CalculoFecha("hoy","0"));

  div_show = f_MostrarDiv("form_seleccion_check_list","btn_seleccion_check_list","");
  $("#div_btn_seleccion_check_list").html(div_show);

  $("#sele_fecha_inicio, #sele_fecha_termino").on('change', function () {
    $("#div_tabla_check_list").empty();
    div_show = f_MostrarDiv("form_seleccion_check_list","btn_seleccion_check_list","");
    $("#div_btn_seleccion_check_list").html(div_show);  
  });

  ///:: Selecciona las filas a editar :::::::::::::::::::::::::::::::::::::::::::::::::::::///
  $(document).on("click", "tr",".tabla_check_list tbody", function(){		
    check_list_id = "";
    if(tabla_check_list.rows('.selected').data().length===1){
      fila_check_list = $(this).closest("tr");	        
      check_list_id   = fila_check_list.find('td:eq(0)').text();
    }
  });

  ///:: BOTONES CHECK LIST DE FLOTA :::::::::::::::::::::::::::::::::::::::::::::::::::::::///

  ///:: EVENTO BOTON BUSCAR CHECK LIST DE FLOTA :::::::::::::::::::::::::::::::::::::::::::///
  $(document).on("click", ".btn_buscar_check_list", function(){
    let sele_fecha_inicio = $("#sele_fecha_inicio").val();
    let sele_fecha_termino = $("#sele_fecha_termino").val();
    
    div_tabla     = f_CreacionTabla("tabla_check_list","");
    $("#div_tabla_check_list").html(div_tabla);
    columnas_tabla = f_ColumnasTabla("tabla_check_list","")
    
    $("#tabla_check_list").dataTable().fnDestroy();
    $('#tabla_check_list').show();

    // Setup - add a text input to each footer cell
    $('#tabla_check_list thead tr')
      .clone(true)
      .addClass('filters_check_list')
      .appendTo('#tabla_check_list thead');

    Accion  = 'buscar_check_list';
    tabla_check_list = $('#tabla_check_list').DataTable({
      "rowCallback":function(row,data,index){
        f_color_filas_check_list(row,data);
      },
         //Filtros por columnas
         orderCellsTop: true,
         fixedHeader: true,
         initComplete: function (){
           var api = this.api();
           // For each column
           api.columns().eq(0).each(function (colIdx) {
             // Set the header cell to contain the input element
             var cell = $('.filters_check_list th').eq($(api.column(colIdx).header()).index());
             var title = $(cell).text();
             $(cell).html('<input type="text" placeholder="' + title + '" />');
             // On every keypress in this input
             $('input',$('.filters_check_list th').eq($(api.column(colIdx).header()).index()) ).off('keyup change').on('keyup change', function (e) {
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
          title     : 'CHECK LIST DE FLOTA'
        },
      ],
      "ajax"        : {            
        "url"       : "Ajax.php", 
        "method"    : 'POST', 
        "data"      : {MoS:MoS, NombreMoS:NombreMoS, Accion:Accion, fecha_inicio:sele_fecha_inicio, fecha_termino:sele_fecha_termino},
        "dataSrc"   : ""
      },
      "columns"     : columnas_tabla,
      "order"       : [[0, 'desc']]
    });
  });
  ///:: FIN EVENTO BOTON BUSCAR CHECK LIST DE FLOTA :::::::::::::::::::::::::::::::::::::::///

  ///:: EVENTO BOTON NUEVO CHECK LIST DE FLOTA ::::::::::::::::::::::::::::::::::::::::::::///
  $(document).on("click", ".btn_editar_check_list", function(){
    fila_check_list = $(this).closest('tr'); 
    check_list_id = fila_check_list.find('td:eq(0)').text();
    $("#check_list_id").val(check_list_id);
    $('#nav-profile-tab').tab('show');
    div_show = f_MostrarDiv("form_seleccion_check_list_registro","btn_seleccion_check_list_registro","");
    $("#div_btn_seleccion_check_list_registro").html(div_show);
    document.getElementById("btn_cargar_check_list_registro").click();
  });
  ///:: FIN EVENTO BOTON NUEVO CHECK LIST DE FLOTA ::::::::::::::::::::::::::::::::::::::::///
  
  ///:: EVENTO BOTON NUEVO CHECK LIST DE FLOTA ::::::::::::::::::::::::::::::::::::::::::::///
  $(document).on("click", ".btn_ver_check_list", function(){
  });
 ///:: FIN EVENTO BOTON NUEVO CHECK LIST DE FLOTA ::::::::::::::::::::::::::::::::::::::::///

  ///:: TERMINO BOTONES CHECK LIST DE FLOTA :::::::::::::::::::::::::::::::::::::::::::::::///

});    
///:: TERMINO DOM CHECK LIST DE FLOTA :::::::::::::::::::::::::::::::::::::::::::::::::::::///

///:: FUNCIONES CHECK LIST DE FLOTA :::::::::::::::::::::::::::::::::::::::::::::::::::::::///

///:: CAMBIA EL COLOR DEL CAMPO ESTADO EN EL DATATABLE ::::::::::::::::::::::::::::::::::::///
function f_color_filas_check_list(row, data){
  let color_rojo  = "#E26A5A";
  let color_verde = "#009390";
  let color_azul  = "#005EA4";
  
  // Columna
  if(data.chl_estado == 'ABIERTO') {
    $("td:eq(1)",row).css({
      "color":color_rojo,
    });
  }

  // Columna 
  if(data.chl_estado == 'CERRADO') {
    $("td:eq(1)",row).css({
      "color":color_verde,
    });
  }
}
///:: FIN CAMBIA EL COLOR DEL CAMPO ESTADO EN EL DATATABLE ::::::::::::::::::::::::::::::::///


///:: TERMINO FUNCIONES CHECK LIST DE FLOTA :::::::::::::::::::::::::::::::::::::::::::::::///