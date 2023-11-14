///::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
///:: MANUAL DE USUARIO 2023-11-13 ::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
///:: LISTADO MANUAL DE USUARIO v 1.0 :::::::::::::::::::::::::::::::::::::::::::::::::::::///
///::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///

///:: DECLARACION VARIABLES GLOBALES ::::::::::::::::::::::::::::::::::::::::::::::::::::::///
var tabla_manual, fila_manual;
var manual_id;

///:: DOM CHECAK LIST DE FLOTA :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
$(document).ready(function(){
  let select_html  = "";

  div_show = f_BotonesFormulario("form_seleccion_listado_manual","btn_seleccion_listado_manual","");
  $("#div_btn_seleccion_listado_manual").html(div_show);

  ///:: BOTONES CHECK LIST DE FLOTA :::::::::::::::::::::::::::::::::::::::::::::::::::::::///

  ///:: EVENTO BOTON BUSCAR CHECK LIST DE FLOTA :::::::::::::::::::::::::::::::::::::::::::///
  $(document).on("click", ".btn_buscar_listado_manual", function(){
   
    div_tabla     = f_CreacionTabla("tabla_manual","");
    $("#div_tabla_manual").html(div_tabla);
    columnas_tabla = f_ColumnasTabla("tabla_manual","")
    
    $("#tabla_manual").dataTable().fnDestroy();
    $('#tabla_manual').show();

    // Setup - add a text input to each footer cell
    $('#tabla_manual thead tr')
      .clone(true)
      .addClass('filters_manual')
      .appendTo('#tabla_manual thead');

    Accion  = 'buscar_manual';
    tabla_manual = $('#tabla_manual').DataTable({
      "rowCallback":function(row,data,index){
        f_color_filas_manual(row,data);
      },
         //Filtros por columnas
         orderCellsTop: true,
         fixedHeader: true,
         initComplete: function (){
           var api = this.api();
           // For each column
           api.columns().eq(0).each(function (colIdx) {
             // Set the header cell to contain the input element
             var cell = $('.filters_manual th').eq($(api.column(colIdx).header()).index());
             var title = $(cell).text();
             $(cell).html('<input type="text" placeholder="' + title + '" />');
             // On every keypress in this input
             $('input',$('.filters_manual th').eq($(api.column(colIdx).header()).index()) ).off('keyup change').on('keyup change', function (e) {
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
          title     : 'MANUAL DE USUARIO'
        },
      ],
      "ajax"        : {            
        "url"       : "Ajax.php", 
        "method"    : 'POST', 
        "data"      : {MoS:MoS, NombreMoS:NombreMoS, Accion:Accion},
        "dataSrc"   : ""
      },
      "columns"     : columnas_tabla,
      "order"       : [[1, 'asc'],[2, 'asc']]
    });
  });
  ///:: FIN EVENTO BOTON BUSCAR CHECK LIST DE FLOTA :::::::::::::::::::::::::::::::::::::::///

  ///:: EVENTO BOTON NUEVO CHECK LIST DE FLOTA ::::::::::::::::::::::::::::::::::::::::::::///
  $(document).on("click", ".btn_editar_manual_registro", function(){
    fila_manual = $(this).closest('tr'); 
    manual_id = fila_manual.find('td:eq(1)').text();
    man_capitulo = fila_manual.find('td:eq(2)').text();
    man_sub_capitulo = fila_manual.find('td:eq(3)').text();
    man_descripcion = fila_manual.find('td:eq(4)').text();
    $("#manual_id").val(manual_id);
    $("#man_capitulo").val(man_capitulo);
    $("#man_sub_capitulo").val(man_sub_capitulo);
    $("#man_descripcion").val(man_descripcion);
    $('#nav-profile-tab').tab('show');
    div_show = f_MostrarDiv("form_seleccion_manual_registro","btn_seleccion_manual_registro","");
    $("#div_btn_seleccion_manual_registro").html(div_show);
    document.getElementById("btn_cargar_manual_registro").click();
  });
  ///:: FIN EVENTO BOTON NUEVO CHECK LIST DE FLOTA ::::::::::::::::::::::::::::::::::::::::///

    ///:: EVENTO BOTON BORRAR REGISTRO MANUAL DE USUARIO ::::::::::::::::::::::::::::::::::///
    $(document).on("click", ".btn_borrar_manual_registro", function(){
      manual_id = $("#t_manual_id").val();
      Swal.fire({
        title               : '¿Está seguro?',
        text                : "Se borrará el Manual ID. "+manual_id+" !",
        icon                : 'warning',
        showCancelButton    : true,
        confirmButtonColor  : '#3085d6',
        cancelButtonColor   : '#d33',
        confirmButtonText   : 'Si, borrar!'
      }).then((result) => {
        if (result.isConfirmed) {
          Accion = 'borrar_manual_registro';
          $.ajax({
              url         : "Ajax.php",
              type        : "POST",
              datatype    : "json",    
              data        : { MoS:MoS, NombreMoS:NombreMoS, Accion:Accion, manual_id:manual_id },   
              success: function() {
                tabla_manual.ajax.reload(null, false);
                Swal.fire(
                    'Anulado!',
                    'El registro ha sido anulado.',
                    'success'
                )            
              }
          });
        }
      });
    });
    ///:: FIN EVENTO BOTON BORRAR REGISTRO MANUAL DE USUARIO ::::::::::::::::::::::::::::::///
  
  ///:: EVENTO BOTON NUEVO CHECK LIST DE FLOTA ::::::::::::::::::::::::::::::::::::::::::::///
  $(document).on("click", ".btn_ver_manual_registro", function(){
  });
 ///:: FIN EVENTO BOTON NUEVO CHECK LIST DE FLOTA :::::::::::::::::::::::::::::::::::::::::///

  ///:: TERMINO BOTONES CHECK LIST DE FLOTA :::::::::::::::::::::::::::::::::::::::::::::::///

});    
///:: TERMINO DOM CHECK LIST DE FLOTA :::::::::::::::::::::::::::::::::::::::::::::::::::::///

///:: FUNCIONES CHECK LIST DE FLOTA :::::::::::::::::::::::::::::::::::::::::::::::::::::::///

///:: CAMBIA EL COLOR DEL CAMPO ESTADO EN EL DATATABLE ::::::::::::::::::::::::::::::::::::///
function f_color_filas_manual(row, data){
  let color_rojo  = "#E26A5A";
  let color_verde = "#009390";
  let color_azul  = "#005EA4";
/*  
  // Columna
  if(data.chl_estado == 'ABIERTO') {
    $("td:eq(2)",row).css({
      "color":color_rojo,
    });
  }

  // Columna 
  if(data.chl_estado == 'CERRADO') {
    $("td:eq(2)",row).css({
      "color":color_verde,
    });
  }*/
}
///:: FIN CAMBIA EL COLOR DEL CAMPO ESTADO EN EL DATATABLE ::::::::::::::::::::::::::::::::///


///:: TERMINO FUNCIONES CHECK LIST DE FLOTA :::::::::::::::::::::::::::::::::::::::::::::::///