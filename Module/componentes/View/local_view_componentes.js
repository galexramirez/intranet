///::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
///:: COMPONENTES v 1.0 FECHA: 2023-07-06 :::::::::::::::::::::::::::::::::::::::::::::::::///
///:: CREAR, EDITAR, ELIMINAR TABLA DE COMPONENTES ::::::::::::::::::::::::::::::::::::::::///
///::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///

///:: DECLARACION DE VARIABLES ::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
var tabla_componentes, opcion_componentes, fila_componentes;
var componente_id, comp_sistema, comp_tipo_componente, comp_codigo_patrimonial, comp_origen, comp_nro_serie, comp_nro_parte, comp_observaciones, comp_nombres_usuario, comp_fecha, comp_log;

///:: JS DOM COMPONENTE :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
$(document).ready(function (){
  /*$("#comp_sistema").on('change', function () {
    comp_sistema  = $.trim($('#comp_sistema').val());
    comp_tipo_componente     = $.trim($('#comp_tipo_componente').val());    
    f_genera_codigo_patriomonial(comp_sistema, comp_tipo_componente)
  });*/

  $("#comp_tipo_componente").on('change', function () {
    comp_tipo_componente     = $.trim($('#comp_tipo_componente').val());    
    f_genera_codigo_patriomonial(comp_tipo_componente)
  });

  ///:: BOTONES DE COMPONENTES ::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
  
  ///:: BOTON CARGAR TABLA COMPONENTES ::::::::::::::::::::::::::::::::::::::::::::::::::///       
  $(document).on("click", ".btn_buscar_componentes", function(){
    f_mostrar_tabla_componentes();
  });
  
  ///:: EVENTO DEL BOTON NUEVO COMPONENTES ::::::::::::::::::::::::::::::::::::::::::::::///
  $(document).on("click", ".btn_nuevo_componentes", function(){
      opcion_componentes = "CREAR";
      f_limpia_componentes();
      f_select_combos_componentes();
      $("#form_modal_componentes").trigger("reset");
      $(".modal-header").css( "background-color", "#17a2b8");
      $(".modal-header").css( "color", "white" );
      $(".modal-title").text("Alta de Componentes");
      $('#modal_crud_componentes').modal('show');
      $('#modal_crud_componentes').draggable();
  });

  ///:: BOTON EDITAR TABLA COMPONENTES ::::::::::::::::::::::::::::::::::::::::::::::::::///
  $(document).on("click", ".btn_editar_componentes", function(){
    f_limpia_componentes();
    f_select_combos_componentes();
    opcion_componentes      = "EDITAR";
    fila_componentes        = $(this).closest("tr");
    componente_id           = fila_componentes.find('td:eq(0)').text();
    comp_sistema            = fila_componentes.find('td:eq(1)').text();
    comp_tipo_componente               = fila_componentes.find('td:eq(2)').text(); 
    comp_codigo_patrimonial = fila_componentes.find('td:eq(3)').text();
    comp_origen             = fila_componentes.find('td:eq(4)').text();
    comp_nro_serie          = fila_componentes.find('td:eq(5)').text();
    comp_nro_parte          = fila_componentes.find('td:eq(6)').text();
    comp_observaciones      = fila_componentes.find('td:eq(7)').text();
    comp_turno              = fila_componentes.find('td:eq(8)').text();
    comp_nombres_usuario    = fila_componentes.find('td:eq(9)').text();
    comp_fecha              = fila_componentes.find('td:eq(10)').text();
    $("#componente_id").val(componente_id);
    $("#comp_sistema").val(comp_sistema);
    $("#comp_tipo_componente").val(comp_tipo_componente);
    $("#comp_codigo_patrimonial").val(comp_codigo_patrimonial);
    $("#comp_origen").val(comp_origen);
    $("#comp_nro_serie").val(comp_nro_serie);
    $("#comp_nro_parte").val(comp_nro_parte);
    $("#comp_turno").val(comp_turno);
    $("#comp_observaciones").val(comp_observaciones);
    $("#comp_nombres_usuario").val(comp_nombres_usuario);
    $("#comp_fecha").val(comp_fecha);

    $(".modal-header").css("background-color", "#007bff");
    $(".modal-header").css("color", "white" );
    $(".modal-title").text("Editar Componentes");		

    $('#modal_crud_componentes').modal('show');
    $('#modal_crud_componentes').draggable();
  });

  /// ::::::::::::::: CREA Y EDITA MATERIALES :::::::::::::///
  $('#form_modal_componentes').submit(function(e){                         
    let validar_componentes = "";
    e.preventDefault(); //evita el comportambiento normal del submit, es decir, recarga total de la página
    componente_id           = $.trim($('#componente_id').val());
    comp_sistema            = $.trim($('#comp_sistema').val());
    comp_tipo_componente               = $.trim($('#comp_tipo_componente').val());
    comp_codigo_patrimonial = $.trim($('#comp_codigo_patrimonial').val());
    comp_origen             = $.trim($('#comp_origen').val());
    comp_nro_serie          = $.trim($('#comp_nro_serie').val());
    comp_nro_parte          = $.trim($('#comp_nro_parte').val());
    comp_turno              = $.trim($('#comp_turno').val());
    comp_observaciones      = $.trim($('#comp_observaciones').val());
  
    validar_componentes     = f_validar_componentes(comp_sistema, comp_tipo_componente, comp_codigo_patrimonial, comp_origen, comp_nro_serie, comp_nro_parte, comp_turno);

    if(validar_componentes=="invalido") {
      Swal.fire({
        position            : 'center',
        icon                : 'error',
        title               : '*Falta Completar Información!!!',
        showConfirmButton   : false,
        timer               : 1500
      });
    }else{
      $("#btn_guardar_componentes").prop("disabled",true);
      if(opcion_componentes == "CREAR") {
        Accion = 'crear_componentes';
        $.ajax({
          url       : "Ajax.php",
          type      : "POST",
          datatype  : "json",    
          data      : { MoS:MoS, NombreMoS:NombreMoS, Accion:Accion, comp_sistema:comp_sistema, comp_tipo_componente:comp_tipo_componente, comp_codigo_patrimonial:comp_codigo_patrimonial, comp_origen:comp_origen, comp_nro_serie:comp_nro_serie, comp_nro_parte:comp_nro_parte, comp_turno:comp_turno, comp_observaciones:comp_observaciones },
          success   : function(data) {
            tabla_componentes.ajax.reload(null, false);
          }
        });
      } 
      if(opcion_componentes == "EDITAR") {
        Accion='editar_componentes';
        $.ajax({
          url       : "Ajax.php",
          type      : "POST",
          datatype  : "json",    
          data      : { MoS:MoS, NombreMoS:NombreMoS, Accion:Accion, componente_id:componente_id, comp_sistema:comp_sistema, comp_tipo_componente:comp_tipo_componente, comp_codigo_patrimonial:comp_codigo_patrimonial, comp_origen:comp_origen, comp_nro_serie:comp_nro_serie, comp_nro_parte:comp_nro_parte, comp_turno:comp_turno, comp_observaciones:comp_observaciones },    
          success   : function(data) {
            tabla_componentes.ajax.reload(null, false);
          }
        });
      } 
      $('#modal_crud_componentes').modal('hide');
      $("#btn_guardar_componentes").prop("disabled",false);
    }
  });

  ///:: EVENTO DEL BOTON VER LOG COMPONENTES ::::::::::::::::::::::::::::::::::::::::::::::///
  $(document).on("click", ".btn_comp_log", function(){
    let a_data = [];
    $("#form_modal_log_componentes").trigger("reset");

    a_data = f_BuscarDataBD("manto_componentes", "componente_id", componente_id);
    $.each(a_data, function(idx, obj){ 
      comp_log = obj.comp_log;
    });

    $(".modal-header-log_componentes").css( "background-color", "#17a2b8");
    $(".modal-header-log_componentes").css( "color", "white" );
    $(".modal-title-log_componentes").text("Log");
    $('#modal_crud_log_componentes').modal('show');
    $("#modal_crud_log_componentes").draggable({});
    $("#div_log_componentes").html(comp_log);
  });
  ///:: FIN BOTON VER LOG COMPONENTES :::::::::::::::::::::::::::::::::::::::::::::::::::::///


  ///:: TERMINO BOTONES DE COMPONENTES ::::::::::::::::::::::::::::::::::::::::::::::::::::///
});    
///:: TERMINO JS DOM COMPONENTE :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///

///:: FUNCIONES DE COMPONENTES ::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///

///:: VALIDAR COMPONENTES :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///       
function f_validar_componentes(p_comp_sistema, p_comp_tipo_componente, p_comp_codigo_patrimonial, p_comp_origen, p_comp_nro_serie, p_comp_nro_parte, p_comp_turno){
  f_limpia_componentes();
  let rpta_validar_componentes="";    

  if(p_comp_sistema==""){
    $("#comp_sistema").addClass("color-error");
    rpta_validar_componentes = "invalido";
  }

  if(p_comp_tipo_componente==""){
    $("#comp_tipo_componente").addClass("color-error");
    rpta_validar_componentes = "invalido";
  }

  if(p_comp_codigo_patrimonial==""){
    $("#comp_codigo_patrimonial").addClass("color-error");
    rpta_validar_componentes = "invalido";
  }

  if(p_comp_origen==""){
    $("#comp_origen").addClass("color-error");
    rpta_validar_componentes = "invalido";
  }

  if(p_comp_nro_serie==""){
    $("#comp_nro_serie").addClass("color-error");
    rpta_validar_componentes = "invalido";
  }

  if(p_comp_nro_parte==""){
    $("#comp_nro_parte").addClass("color-error");
    rpta_validar_componentes = "invalido";
  }

  if(p_comp_turno==""){
    $("#comp_turno").addClass("color-error");
    rpta_validar_componentes = "invalido";
  }

  return rpta_validar_componentes; 
}

///:: REESTABLECE EL COLOR DE LOS CAMPOS CON ERROR :::::::::::::::::::::::::::::::::::::::/// 
function f_limpia_componentes(){
    $("#componentes_id").removeClass("color-error");
    $("#comp_sistema").removeClass("color-error");
    $("#comp_tipo_componente").removeClass("color-error");
    $("#comp_codigo_patrimonial").removeClass("color-error");
    $("#comp_origen").removeClass("color-error");
    $("#comp_nro_serie").removeClass("color-error");
    $("#comp_nro_parte").removeClass("color-error");
    $("#comp_observaciones").removeClass("color-error");
    $("#comp_turno").removeClass("color-error");
}

function f_genera_codigo_patriomonial(p_comp_tipo_componente) {
  if(p_comp_tipo_componente!=""){
    Accion = "genera_codigo_patrimonial";
    $.ajax({
      url       : "Ajax.php",
      type      : "POST",
      datatype  : "json",
      async     : false,    
      data      : { MoS:MoS, NombreMoS:NombreMoS, Accion:Accion, comp_tipo_componente:p_comp_tipo_componente },
      success   : function(data) {
          comp_codigo_patrimonial  = data;
      }
    });
    $("#comp_codigo_patrimonial").val(comp_codigo_patrimonial);  
  }else{
    comp_codigo_patrimonial = "";
    $("#comp_codigo_patrimonial").val(comp_codigo_patrimonial);  
  }
}   

function f_mostrar_tabla_componentes(){
  div_tabla = f_CreacionTabla("tabla_componentes","");
  $("#div_tabla_componentes").html(div_tabla);
  columnastabla = f_ColumnasTabla("tabla_componentes","");

  $("#tabla_componentes").dataTable().fnDestroy();
  $('#tabla_componentes').show();

  // Setup - add a text input to each footer cell
  $('#tabla_componentes thead tr')
      .clone(true)
      .addClass('filters_componentes')
      .appendTo('#tabla_componentes thead');

  Accion='leer_componentes';
  tabla_componentes = $('#tabla_componentes').DataTable({
      //Filtros por columnas
      orderCellsTop : true,
      fixedHeader   : true,
      initComplete  : function (){
          var api = this.api();
          // For each column
          api.columns().eq(0).each(function (colIdx) {
              // Set the header cell to contain the input element
              var cell = $('.filters_componentes th').eq($(api.column(colIdx).header()).index());
              var title = $(cell).text();
              $(cell).html('<input type="text" placeholder="' + title + '" />');
              // On every keypress in this input
              $('input',$('.filters_componentes th').eq($(api.column(colIdx).header()).index()) ).off('keyup change').on('keyup change', function (e) {
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
      deferRender     : true,
      /*scrollY         : 800,
      scrollCollapse  : true,
      scroller        : true,
      scrollX         : true,*/
      fixedColumns    : {
        left          : 1
      },
      fixedHeader     : {
        header        : false
      },
      pageLength      : 50,
      language        : idiomaEspanol, 
      responsive      : "true",
      dom             : 'Blfrtip', // Con Botones Excel,Pdf,Print
      buttons         :[
        {
          extend      : 'excelHtml5',
          text        : '<i class="fas fa-file-excel"></i> ',
          titleAttr   :  'Exportar a Excel',
          className   :  'btn btn-success'
        },
      ],
      "ajax"          : {            
          "url"       : "Ajax.php", 
          "method"    : 'POST',
          "data"      : {MoS:MoS,NombreMoS:NombreMoS,Accion:Accion},
          "dataSrc"   : ""
      },
      "columns"       : columnastabla,
      "order"         : [[0, 'desc']]
  });     

}

function f_select_combos_componentes(){
  let t_html = "";
  t_html = f_select_combo("manto_tc_componente", "NO", "tc_categoria2", "", "`tc_ficha`='COMPONENTE' AND `tc_categoria1`='SISTEMA'", "ASC");
  $("#comp_sistema").html(t_html);
  t_html = f_select_combo("manto_tc_componente", "NO", "tc_categoria2", "", "`tc_ficha`='COMPONENTE' AND `tc_categoria1`='TIPO'", "ASC");
  $("#comp_tipo_componente").html(t_html);
  t_html = f_select_combo("manto_tc_componente", "NO", "tc_categoria2", "", "`tc_ficha`='COMPONENTE' AND `tc_categoria1`='ORIGEN'", "ASC");
  $("#comp_origen").html(t_html);
  t_html = f_select_combo("manto_tc_componente", "NO", "tc_categoria2", "", "`tc_ficha`='COMPONENTE' AND `tc_categoria1`='TURNO'", "ASC");
  $("#comp_turno").html(t_html);
}