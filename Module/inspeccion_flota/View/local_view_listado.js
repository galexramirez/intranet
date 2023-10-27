///::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
///:: INSPECCION DE FLOTA 2023-07-31 ::::::::::::::::::::::::::::::::::::::::::::::::::::::///
///:: INFORME INSPECCION DE FLOTA v 10 ::::::::::::::::::::::::::::::::::::::::::::::::::::///
///::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///

///:: DECLARACION VARIABLES GLOBALES ::::::::::::::::::::::::::::::::::::::::::::::::::::::///
var tabla_inspeccion, insp_buses, fila_inspeccion;
var inspeccion_id, insp_bus_tipo, insp_fecha_programada, insp_seleccion_buses, ins_estado;

///:: DOM INSPECCION DE FLOTA :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
$(document).ready(function(){
  let select_html  = "";
  $("#sele_fecha_inicio").val(f_CalculoFecha("hoy","-7 days"));
  $("#sele_fecha_termino").val(f_CalculoFecha("hoy","0"));

  div_show = f_MostrarDiv("form_seleccion_inspeccion_flota","btn_seleccion_inspeccion","");
  $("#div_btn_seleccion_inspeccion").html(div_show);

  $("#sele_fecha_inicio, #sele_fecha_termino").on('change', function () {
    $("#div_tabla_inspeccion").empty();
    div_show = f_MostrarDiv("form_seleccion_inspeccion_flota","btn_seleccion_inspeccion","");
    $("#div_btn_seleccion_inspeccion").html(div_show);  
  });

  $("#insp_bus_tipo, #insp_seleccion_buses").on('change', function () {
    insp_bus_tipo = "";
    insp_seleccion_buses = $("#insp_seleccion_buses").val();
    div_show = "";
    $("#div_seleccion_buses").html(div_show);
    if(insp_seleccion_buses=="PARCIAL"){
      insp_bus_tipo = $("#insp_bus_tipo").val();
      if(insp_bus_tipo!=""){
        div_show = f_MostrarDiv("form_inspeccion","div_seleccion_buses",insp_bus_tipo);
        $("#div_seleccion_buses").html(div_show);  
      }
    }
  });

  ///:: Selecciona las filas a editar :::::::::::::::::::::::::::::::::::::::::::::::::::::///
  $(document).on("click", "tr", function(){
    let tabla_inspeccion_seleccion = $(this).closest("table");
    if(tabla_inspeccion_seleccion.hasClass("tabla_inspeccion")){
      insp_estado="";
      inspeccion_id = "";
      if(tabla_inspeccion.rows('.selected').data().length===1){
        fila_inspeccion = $(this).closest("tr");	        
        inspeccion_id   = fila_inspeccion.find('td:eq(0)').text();
        insp_estado     = fila_inspeccion.find('td:eq(8)').text();
      }
      div_show = f_MostrarDiv("form_seleccion_inspeccion_flota","btn_seleccion_inspeccion",insp_estado);
      $("#div_btn_seleccion_inspeccion").html(div_show);  
    }
  });

  ///:: BOTONES INSPECCION DE FLOTA :::::::::::::::::::::::::::::::::::::::::::::::::::::::///

  ///:: EVENTO BOTON BUSCAR INSPECCION DE FLOTA :::::::::::::::::::::::::::::::::::::::::::///
  $(document).on("click", ".btn_buscar_inspeccion", function(){
    let sele_fecha_inicio = $("#sele_fecha_inicio").val();
    let sele_fecha_termino = $("#sele_fecha_termino").val();
    
    div_tabla     = f_CreacionTabla("tabla_inspeccion","");
    $("#div_tabla_inspeccion").html(div_tabla);
    columnas_tabla = f_ColumnasTabla("tabla_inspeccion","")
    
    $("#tabla_inspeccion").dataTable().fnDestroy();
    $('#tabla_inspeccion').show();

    // Setup - add a text input to each footer cell
    $('#tabla_inspeccion thead tr')
      .clone(true)
      .addClass('filters_inspeccion')
      .appendTo('#tabla_inspeccion thead');

    Accion  = 'buscar_inspeccion';
    tabla_inspeccion = $('#tabla_inspeccion').DataTable({
      "rowCallback":function(row,data,index){
        f_color_filas_inspeccion(row,data);
      },
         //Filtros por columnas
         orderCellsTop: true,
         fixedHeader: true,
         initComplete: function (){
           var api = this.api();
           // For each column
           api.columns().eq(0).each(function (colIdx) {
             // Set the header cell to contain the input element
             var cell = $('.filters_inspeccion th').eq($(api.column(colIdx).header()).index());
             var title = $(cell).text();
             $(cell).html('<input type="text" placeholder="' + title + '" />');
             // On every keypress in this input
             $('input',$('.filters_inspeccion th').eq($(api.column(colIdx).header()).index()) ).off('keyup change').on('keyup change', function (e) {
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
          title     : 'INSPECCION DE FLOTA'
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
  ///:: FIN EVENTO BOTON BUSCAR INSPECCION DE FLOTA :::::::::::::::::::::::::::::::::::::::///

  ///:: EVENTO BOTON NUEVO INSPECCION DE FLOTA ::::::::::::::::::::::::::::::::::::::::::::///
  $(document).on("click", ".btn_nueva_inspeccion", function(){
    f_limpia_inspeccion();
    insp_fecha_programada = f_CalculoFecha("hoy","0");
    insp_bus_tipo = "";
    insp_seleccion_buses = "TODOS";
    div_show = "";

    $("#form_inspeccion").trigger("reset");
    select_html  = f_select_combo("manto_tc_inspeccion", "NO", "tc_categoria2", "",  "`tc_ficha`='INSPECCION' AND `tc_categoria1`='TIPO BUS'", "`tc_categoria2`");
    $("#insp_bus_tipo").html(select_html);
    select_html  = f_select_combo("manto_tc_inspeccion", "NO", "tc_categoria2", "",  "`tc_ficha`='INSPECCION' AND `tc_categoria1`='SELECCION BUSES'", "`tc_categoria2`");
    
    $("#insp_seleccion_buses").html(select_html);
    $("#insp_fecha_programada").val(insp_fecha_programada);
    $("#insp_bus_tipo").val(insp_bus_tipo);
    $("#insp_seleccion_buses").val(insp_seleccion_buses);
    $("#div_seleccion_buses").html(div_show);
    $("#btn_crear_inspeccion").prop("disabled",false);
        
    $(".modal-header").css( "background-color", "#17a2b8");
    $(".modal-header").css( "color", "white" );
    $(".modal-title").text("Inspeccion de Flota");
    $('#modal_crud_inspeccion').modal('show');
  });
  ///:: FIN EVENTO BOTON NUEVO INSPECCION DE FLOTA ::::::::::::::::::::::::::::::::::::::::///
  
  ///:: CREA NUEVA INSPECCION DE FLOTA ::::::::::::::::::::::::::::::::::::::::::::::::::::///
  $('#form_inspeccion').submit(function(e){
    e.preventDefault(); //evita el comportambiento normal del submit, es decir, recarga total de la página
    let valida_inspeccion = '';
    let a_buses = [];
    insp_fecha_programada = $.trim($('#insp_fecha_programada').val());
    insp_bus_tipo         = $.trim($('#insp_bus_tipo').val());    
    insp_seleccion_buses  = $.trim($('#insp_seleccion_buses').val());        

    if(insp_seleccion_buses=="PARCIAL"){
      a_buses = f_carga_buses_seleccionados(insp_bus_tipo);
    }

    valida_inspeccion = f_valida_inspeccion(insp_fecha_programada, insp_bus_tipo, insp_seleccion_buses, a_buses);
    
    if(valida_inspeccion=="invalido"){
      Swal.fire({
        position            : 'center',
        icon                : 'error',
        title               : '*Falta Completar Información!!!',
        showConfirmButton   : false,
        timer               : 1500
      })
    }else{
      $("#btn_crear_inspeccion").prop("disabled",true);
      a_data = JSON.stringify(a_buses);
      Accion = 'crear_inspeccion';
      $.ajax({
        url         : "Ajax.php",
        type        : "POST",
        datatype    : "json",    
        data        : { MoS:MoS, NombreMoS:NombreMoS, Accion:Accion, insp_fecha_programada:insp_fecha_programada, insp_bus_tipo:insp_bus_tipo, insp_seleccion_buses:insp_seleccion_buses, a_data:a_data},    
        success     : function(data) {
          tabla_inspeccion.ajax.reload(null, false);
        }
      });
      $('#modal_crud_inspeccion').modal('hide');
    }
  });
  ///:: FIN CREA NUEVA INSPECCION DE FLOTA ::::::::::::::::::::::::::::::::::::::::::::::::///

  ///:: EVENTO BOTON CERRAR INSPECCION DE FLOTA :::::::::::::::::::::::::::::::::::::::::::///
  $(document).on("click", ".btn_cerrar_inspeccion", function(){
    let a_buses_pendientes = f_buscar_dato("manto_inspeccion_detalle","inspeccion_id","`inspeccion_id`='"+inspeccion_id+"' AND `insp_detalle_estado`='PENDIENTE'");
    if(a_buses_pendientes.length==0){
      Swal.fire({
        title               : '¿Está seguro?',
        text                : "Se cerrará la Inspeccion Id-"+inspeccion_id+"!",
        icon                : 'warning',
        showCancelButton    : true,
        confirmButtonColor  : '#3085d6',
        cancelButtonColor   : '#d33',
        confirmButtonText   : 'Si, cerrar!',
        cancelButtonText    : 'Cancelar'
      }).then((result) => {
        if (result.isConfirmed) {
          Accion = 'cerrar_inspeccion';
            $.ajax({
              url         : "Ajax.php",
              type        : "POST",
              datatype    : "json",    
              data        : { MoS:MoS, NombreMoS:NombreMoS, Accion:Accion, inspeccion_id:inspeccion_id },   
              success: function() {
                tabla_inspeccion.ajax.reload(null, false);
                Swal.fire(
                  'Cerrado!',
                  'El registro ha sido cerrado.',
                  'success'
                )            
                div_show = f_MostrarDiv("form_seleccion_inspeccion_flota","btn_seleccion_inspeccion",'CERRADO');
                $("#div_btn_seleccion_inspeccion").html(div_show);
              }
            });
        }
      });  
    }else{
      Swal.fire({
        title               : '¿Está seguro?',
        text                : "Buses Pendientes NO Inspeccionados. Desea Cerrar la Inspeccion Id-"+inspeccion_id+"!",
        icon                : 'warning',
        showCancelButton    : true,
        confirmButtonColor  : '#3085d6',
        cancelButtonColor   : '#d33',
        confirmButtonText   : 'Si, cerrar!',
        cancelButtonText    : 'Cancelar'
      }).then((result) => {
        if (result.isConfirmed) {
          Accion = 'cerrar_inspeccion';
            $.ajax({
              url         : "Ajax.php",
              type        : "POST",
              datatype    : "json",    
              data        : { MoS:MoS, NombreMoS:NombreMoS, Accion:Accion, inspeccion_id:inspeccion_id },   
              success: function() {
                tabla_inspeccion.ajax.reload(null, false);
                Swal.fire(
                  'Cerrado!',
                  'El registro ha sido cerrado.',
                  'success'
                )
                div_show = f_MostrarDiv("form_seleccion_inspeccion_flota","btn_seleccion_inspeccion",'CERRADO');
                $("#div_btn_seleccion_inspeccion").html(div_show);           
              }
            });
        }
      });  

    }
  });
  ///:: FIN EVENTO BOTON CERRAR INSPECCION DE FLOTA :::::::::::::::::::::::::::::::::::::::///

  ///:: BOTON REGISTRO DE INSPECCION ::::::::::::::::::::::::::::::::::::::::::::::::::::::///
  $(document).on("click", ".btn_registro_inspeccion", function(){
    let valida_fecha_inspeccion = f_valida_fecha_inspeccion(inspeccion_id);
    if(valida_fecha_inspeccion=="SI"){
      $("#reg_inspeccion_id").val(inspeccion_id);
      reg_inspeccion_bus = "";
      select_html = f_select_combo("manto_inspeccion_detalle", "NO", "insp_bus", "", "`inspeccion_id`='"+inspeccion_id+"' AND `insp_detalle_estado`='PENDIENTE'");
      $("#reg_inspeccion_bus").html(select_html);      
      $("#reg_inspeccion_bus").val(reg_inspeccion_bus);
      
      $('#nav-profile-tab').tab('show')
      $("#div_card_columns_inspeccion_registro").empty();
      $("#reg_inspeccion_bus").focus().select();
    }else{
      Swal.fire({
        position            : 'center',
        icon                : 'error',
        title               : '*Inconsistencia entre fecha actual y programada!!!',
        showConfirmButton   : false,
        timer               : 1500
      })
    }
  });
  ///:: FIN BOTON REGISTRO DE INSPECCION ::::::::::::::::::::::::::::::::::::::::::::::::::///

  ///:: EVENTO BOTON ANULAR INSPECCION DE FLOTA :::::::::::::::::::::::::::::::::::::::::::///
  $(document).on("click", ".btn_anular_inspeccion", function(){
    let a_buses_pendientes = f_buscar_dato("manto_inspeccion_detalle","inspeccion_id","`inspeccion_id`='"+inspeccion_id+"' AND (`insp_detalle_estado`='CERRADO' OR `insp_detalle_estado`='NO INSPECCIONADO')");
    if(a_buses_pendientes.length==0){
      Swal.fire({
        title               : '¿Está seguro?',
        text                : "Se anulará la Inspeccion Id-"+inspeccion_id+"!",
        icon                : 'warning',
        showCancelButton    : true,
        confirmButtonColor  : '#3085d6',
        cancelButtonColor   : '#d33',
        confirmButtonText   : 'Si, anular!',
        cancelButtonText    : 'Cancelar'
      }).then((result) => {
        if (result.isConfirmed) {
          Accion = 'anular_inspeccion';
            $.ajax({
              url         : "Ajax.php",
              type        : "POST",
              datatype    : "json",    
              data        : { MoS:MoS, NombreMoS:NombreMoS, Accion:Accion, inspeccion_id:inspeccion_id },   
              success: function() {
                tabla_inspeccion.ajax.reload(null, false);
                Swal.fire(
                  'Anulado!',
                  'El registro ha sido anulado.',
                  'success'
                )
                div_show = f_MostrarDiv("form_seleccion_inspeccion_flota","btn_seleccion_inspeccion",'ANULADO');
                $("#div_btn_seleccion_inspeccion").html(div_show);                        
              }
            });
        }
      });  
    }else{
      Swal.fire({
        position            : 'center',
        icon                : 'error',
        title               : '*Existen Buses Registrados !!!',
        showConfirmButton   : false,
        timer               : 1500
      })            
    }
  });
  ///:: FIN EVENTO BOTON ANULAR INSPECCION DE FLOTA :::::::::::::::::::::::::::::::::::::::///

  ///:: TERMINO BOTONES INSPECCION DE FLOTA :::::::::::::::::::::::::::::::::::::::::::::::///

});    
///:: TERMINO DOM INSPECCION DE FLOTA :::::::::::::::::::::::::::::::::::::::::::::::::::::///

///:: FUNCIONES INSPECCION DE FLOTA :::::::::::::::::::::::::::::::::::::::::::::::::::::::///

///:: VALIDA LOS CAMPOS DEL FORMULARIO ::::::::::::::::::::::::::::::::::::::::::::::::::::/// 
function f_valida_inspeccion(p_insp_fecha_programada, p_insp_bus_tipo, p_insp_seleccion_buses, p_a_buses){
  f_limpia_inspeccion();
  let rpta_valida_inspeccion="";
  
  if(p_insp_fecha_programada==""){
    $("#insp_fecha_programada").addClass('color-error');
    rpta_valida_inspeccion="invalido"
  }

  if(p_insp_bus_tipo==""){
    $("#insp_bus_tipo").addClass('color-error');
    rpta_valida_inspeccion="invalido"
  }

  if(p_insp_seleccion_buses==""){
    $("#insp_seleccion_buses").addClass('color-error');
    rpta_valida_inspeccion="invalido"
  }

  if(p_insp_seleccion_buses=="PARCIAL" && p_a_buses.length==0){
    $("#insp_seleccion_buses").addClass('color-error');
    rpta_valida_inspeccion="invalido"
  }


  return rpta_valida_inspeccion
}
///:: FIN DE VALIDA LOS CAMPOS DEL FORMULARIO :::::::::::::::::::::::::::::::::::::::::::::///

///:: REESTABLECE EL COLOR DEL CAMPO CON ERROR EN EL FORMULARIO :::::::::::::::::::::::::::///
function f_limpia_inspeccion(){
  $("#insp_fecha").removeClass('color-error');
  $("#insp_bus_tipo").removeClass('color-error');
  $("#insp_seleccion_buses").removeClass('color-error');
}
///:: FIN REESTABLECE EL COLOR DEL CAMPO CON ERROR EN EL FORMULARIO :::::::::::::::::::::::///

///:: CAMBIA EL COLOR DEL CAMPO ESTADO EN EL DATATABLE ::::::::::::::::::::::::::::::::::::///
function f_color_filas_inspeccion(row, data){
  let color_rojo  = "#E26A5A";
  let color_verde = "#009390";
  let color_azul  = "#005EA4";
  
  // Columna
  if(data.insp_estado == 'ABIERTO') {
    $("td:eq(8)",row).css({
      "color":color_rojo,
    });
  }

  // Columna 
  if(data.insp_estado == 'CERRADO') {
    $("td:eq(8)",row).css({
      "color":color_verde,
    });
  }
}
///:: FIN CAMBIA EL COLOR DEL CAMPO ESTADO EN EL DATATABLE ::::::::::::::::::::::::::::::::///

///:: GENERA EL ARREGLO CON TODOS LOS BUSES SELECCIONADOS SEGUN LA FLOTA ::::::::::::::::::///
function f_carga_buses_seleccionados(p_insp_bus_tipo){
  let is_checked;
  let rpta_a_data = [];
  let a_buses_flota = f_BuscarDataBD("Buses","Bus_Tipo2",p_insp_bus_tipo);
  $.each(a_buses_flota, function(idx, obj){ 
    Bus_NroExterno = obj.Bus_NroExterno;
    is_checked = document.getElementById(Bus_NroExterno).checked;
    if(is_checked){
      rpta_a_data.push(Bus_NroExterno);
    }
  });
  return rpta_a_data;
}
///:: FIN GENERA EL ARREGLO CON TODOS LOS BUSES SELECCIONADOS SEGUN LA FLOTA ::::::::::::::///

function f_valida_fecha_inspeccion(p_inspeccion_id){
  let rpta_valida_fecha_inspeccion = "";
  let f_fecha_programada = f_buscar_dato("manto_inspeccion_registro","insp_fecha_programada","`inspeccion_id`='"+p_inspeccion_id+"'");
  let f_fecha_hoy = f_CalculoFecha("hoy","0");
  if(f_fecha_programada==f_fecha_hoy){
    rpta_valida_fecha_inspeccion = "SI"
  }
  if(f_CompararFechaActual(f_fecha_programada)=="MAYOR"){
    if(f_dias_diferencia_fechas(f_fecha_programada,f_fecha_hoy)=="1"){
      rpta_valida_fecha_inspeccion = "SI"
    }
  }
  return rpta_valida_fecha_inspeccion;
}
///:: TERMINO FUNCIONES INSPECCION DE FLOTA :::::::::::::::::::::::::::::::::::::::::::::::///