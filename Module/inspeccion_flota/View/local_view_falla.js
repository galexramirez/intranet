///::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
///::: REPORTE DE FALLAS DE INSPECCION DE FLOTA v 1.0 :::::::::::::::::::::::::::::::::::::///
///::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///

///:: DECLARACION DE VARIABLES GLOBALES :::::::::::::::::::::::::::::::::::::::::::::::::::///
  
///:: JS DOM REPORTE FALLAS DE INSPECCION FLOTA :::::::::::::::::::::::::::::::::::::::::::///
$(document).ready(function(){
  let select_fal_insp, inspeccion_movimiento_id, insp_movimiento_estado, fila_falla;
  let nf_inspeccion_id, nf_detalle_inspeccion, nf_bus_tipo, nf_bus, nf_codigo, nf_descripcion, nf_componente, nf_posicion, nf_falla, nf_accion; 
  div_show = f_MostrarDiv("form_seleccion_falla","btn_seleccion_falla","");
  $("#div_btn_seleccion_falla").html(div_show);

  $("#falla_fecha_inicio").val(f_CalculoFecha("hoy","-7 days"));
  $("#falla_fecha_termino").val(f_CalculoFecha("hoy","0"));
  
  $("#falla_fecha_inicio, #falla_fecha_termino").on('change', function () {
    div_show = f_MostrarDiv("form_seleccion_falla","btn_seleccion_falla","");
    $("#div_btn_seleccion_falla").html(div_show);  
    $("#div_tabla_falla").empty();
  });

  $("#nf_inspeccion_id").on('change', function () {
    let nf_data = [];
    nf_inspeccion_id = $("#nf_inspeccion_id").val();
    nf_bus_tipo = '';
    nf_bus = '';
    nf_detalle_inspeccion = '';
    nf_codigo = '';
    nf_descripcion = '';
    nf_componente = '';
    nf_posicion = '';
    nf_falla = '';
    nf_accion = '';
    nf_data = f_BuscarDataBD('manto_inspeccion_registro','inspeccion_id',nf_inspeccion_id);
    $.each(nf_data, function(idx, obj){ 
      nf_bus_tipo = obj.insp_bus_tipo;
      nf_detalle_inspeccion = 'FEC.: '+obj.insp_fecha_programada+ '  FLT.: '+obj.insp_bus_tipo;
    });    

    select_fal_insp = f_select_combo('manto_inspeccion_detalle','NO', 'insp_bus', '', "`insp_detalle_estado`!='PENDIENTE' AND `inspeccion_id`='"+nf_inspeccion_id+"'");
    $("#nf_bus").html(select_fal_insp);
    select_fal_insp = '';
    $("#nf_codigo").html(select_fal_insp);
    $("#nf_componente").html(select_fal_insp);
    $("#nf_posicion").html(select_fal_insp);
    $("#nf_falla").html(select_fal_insp);
    $("#nf_accion").html(select_fal_insp);

    $("#nf_bus").val(nf_bus);
    $("#nf_detalle_inspeccion").val(nf_detalle_inspeccion);
    $("#nf_codigo").val(nf_codigo);
    $("#nf_descripcio").val(nf_descripcion);
    $("#nf_componente").val(nf_componente);
    $("#nf_posicion").val(nf_posicion);
    $("#nf_falla").val(nf_falla);
    $("#nf_accion").val(nf_accion);
  })

  $("#nf_bus").on('change', function () {
    nf_codigo = '';
    nf_descripcion = '';
    nf_componente = '';
    nf_posicion = '';
    nf_falla = '';
    nf_accion = '';

    select_fal_insp = f_select_combo('manto_inspeccion_codigo','NO','insp_codigo','',"`insp_bus_tipo`='"+nf_bus_tipo+"'" );
    $("#nf_codigo").html(select_fal_insp);
    select_fal_insp = '';
    $("#nf_componente").html(select_fal_insp);
    $("#nf_posicion").html(select_fal_insp);
    $("#nf_falla").html(select_fal_insp);
    $("#nf_accion").html(select_fal_insp);

    $("#nf_codigo").val(nf_codigo);
    $("#nf_descripcio").val(nf_descripcion);
    $("#nf_componente").val(nf_componente);
    $("#nf_posicion").val(nf_posicion);
    $("#nf_falla").val(nf_falla);
    $("#nf_accion").val(nf_accion);
  });

  $("#nf_codigo").on('change', function () {
    nf_codigo = $("#nf_codigo").val();
    nf_descripcion = f_buscar_dato("manto_inspeccion_codigo","insp_descripcion","`insp_bus_tipo`='"+nf_bus_tipo+"' AND `insp_codigo`='"+nf_codigo+"'");
    nf_componente = "";
    nf_posicion = "";
    nf_falla = "";
    nf_accion = "";

    select_fal_insp = f_select_combo("manto_inspeccion_componente","NO","insp_componente","","`insp_bus_tipo`='"+nf_bus_tipo+"' AND `insp_codigo`='"+nf_codigo+"'","insp_componente");
    $("#nf_componente").html(select_fal_insp);

    select_fal_insp = f_select_combo("manto_inspeccion_posicion","NO","insp_posicion","","`insp_bus_tipo`='"+nf_bus_tipo+"' AND `insp_codigo`='"+nf_codigo+"' AND `insp_componente`='"+nf_componente+"'","insp_posicion");
    $("#nf_posicion").html(select_fal_insp);

    select_fal_insp = f_select_combo("manto_inspeccion_falla_accion","SI","insp_falla","","`insp_bus_tipo`='"+nf_bus_tipo+"' AND `insp_codigo`='"+nf_codigo+"' AND `insp_componente`='"+nf_componente+"'","insp_falla");
    $("#nf_falla").html(select_fal_insp);

    select_fal_insp = f_select_combo("manto_inspeccion_falla_accion","NO","insp_accion","","`insp_bus_tipo`='"+nf_bus_tipo+"' AND `insp_codigo`='"+nf_codigo+"' AND `insp_componente`='"+nf_componente+"' AND `insp_falla`='"+nf_falla+"'","insp_accion");
    $("#nf_accion").html(select_fal_insp);
 
    $("#nf_descripcion").val(nf_descripcion);
    $("#nf_componente").val(nf_componente);
    $("#nf_posicion").val(nf_posicion);
    $("#nf_falla").val(nf_falla);
    $("#nf_accion").val(nf_accion);
  });

  $("#nf_componente").on('change', function () {
    nf_componente = $("#nf_componente").val();
    let contar_posicion = f_contar_dato("manto_inspeccion_posicion","insp_posicion","`insp_bus_tipo`='"+nf_bus_tipo+"' AND `insp_codigo`='"+nf_codigo+"' AND `insp_componente`='"+nf_componente+"'");
    nf_falla = "";
    nf_accion = "";

    select_fal_insp = f_select_combo("manto_inspeccion_posicion","NO","insp_posicion","","`insp_bus_tipo`='"+nf_bus_tipo+"' AND `insp_codigo`='"+nf_codigo+"' AND `insp_componente`='"+nf_componente+"'","insp_posicion");
    $("#nf_posicion").html(select_fal_insp);

    select_fal_insp = f_select_combo("manto_inspeccion_falla_accion","SI","insp_falla","","`insp_bus_tipo`='"+nf_bus_tipo+"' AND `insp_codigo`='"+nf_codigo+"' AND `insp_componente`='"+nf_componente+"'","insp_falla");
    $("#nf_falla").html(select_fal_insp);

    select_fal_insp = f_select_combo("manto_inspeccion_falla_accion","NO","insp_accion","","`insp_bus_tipo`='"+nf_bus_tipo+"' AND `insp_codigo`='"+nf_codigo+"' AND `insp_componente`='"+nf_componente+"' AND `insp_falla`='"+nf_falla+"'","insp_accion");
    $("#nf_accion").html(select_fal_insp);

    if(contar_posicion=="1"){
      nf_posicion = f_buscar_dato("manto_inspeccion_posicion","insp_posicion","`insp_bus_tipo`='"+nf_bus_tipo+"' AND `insp_codigo`='"+nf_codigo+"' AND `insp_componente`='"+nf_componente+"'");
      $("#nf_falla").focus().select();      
    }else{
      nf_posicion = '';
    }

    $("#nf_posicion").val(nf_posicion);
    $("#nf_falla").val(nf_falla);
    $("#nf_accion").val(nf_accion);
  });

  $("#nf_posicion").on('change', function (){
    nf_accion = "";
    
    let contar_falla = f_contar_dato("manto_inspeccion_falla_accion","insp_falla","`insp_bus_tipo`='"+nf_bus_tipo+"' AND `insp_codigo`='"+nf_codigo+"' AND `insp_componente`='"+nf_componente+"'");
    
    select_fal_insp = f_select_combo("manto_inspeccion_falla_accion","NO","insp_accion","","`insp_bus_tipo`='"+nf_bus_tipo+"' AND `insp_codigo`='"+nf_codigo+"' AND `insp_componente`='"+nf_componente+"' AND `insp_falla`='"+nf_falla+"'","insp_accion");
    $("#nf_accion").html(select_fal_insp);

    if(contar_falla=="1"){
      nf_falla = f_buscar_dato("manto_inspeccion_falla_accion","insp_falla","`insp_bus_tipo`='"+nf_bus_tipo+"' AND `insp_codigo`='"+nf_codigo+"' AND `insp_componente`='"+nf_componente+"'");
      $("#nf_accion").focus().select();      
    }else{
      nf_falla = "";
    }

    $("#nf_falla").val(nf_falla);
    $("#nf_accion").val(nf_accion);
  })

  $("#nf_falla").on('change', function (){
    nf_falla = $("#nf_falla").val();
    let contar_accion = f_contar_dato("manto_inspeccion_falla_accion","insp_accion","`insp_bus_tipo`='"+nf_bus_tipo+"' AND `insp_codigo`='"+nf_codigo+"' AND `insp_componente`='"+nf_componente+"' AND `insp_falla`='"+nf_falla+"'");
    

    select_fal_insp = f_select_combo("manto_inspeccion_falla_accion","NO","insp_accion","","`insp_bus_tipo`='"+nf_bus_tipo+"' AND `insp_codigo`='"+nf_codigo+"' AND `insp_componente`='"+nf_componente+"' AND `insp_falla`='"+nf_falla+"'","insp_accion");
    $("#nf_accion").html(select_fal_insp);

    if(contar_accion=="1"){
      nf_accion = f_buscar_dato("manto_inspeccion_falla_accion","insp_accion","`insp_bus_tipo`='"+nf_bus_tipo+"' AND `insp_codigo`='"+nf_codigo+"' AND `insp_componente`='"+nf_componente+"' AND `insp_falla`='"+nf_falla+"'");
      $("#btn_inspeccion_registrar_observaciones").focus().select();      
    }else{
      nf_accion = "";
    }

    $("#nf_accion").val(nf_accion);
  })

  ///:: SELECCIONA LAS FILAS A ANULAR :::::::::::::::::::::::::::::::::::::::::::::::::::::///
  $(document).on("click", "tr", function(){
    let tabla_falla_seleccion = $(this).closest("table");
    if(tabla_falla_seleccion.hasClass("tabla_falla")){
      inspeccion_movimiento_id = '';
      insp_movimiento_estado = '';
      if(tabla_falla.rows('.selected').data().length===1){
        fila_falla = $(this).closest("tr");	        
        inspeccion_movimiento_id = fila_falla.find('td:eq(0)').text();
        inspeccion_movimiento_id = inspeccion_movimiento_id.replace(/\D/g, "");
        insp_movimiento_estado = fila_falla.find('td:eq(1)').text();
      }
      div_show = f_MostrarDiv("form_seleccion_falla","btn_seleccion_falla",insp_movimiento_estado);
      $("#div_btn_seleccion_falla").html(div_show);
    }
  });
    
  ///:: BOTONES REPORTE DE INSPECCION DE FLOTA ::::::::::::::::::::::::::::::::::::::::::::///
    
  ///:: EVENTO BOTON BUSCAR REPORTE DE INSPECCION DE FLOTA ::::::::::::::::::::::::::::::::///
  $(document).on("click", ".btn_buscar_falla", function(){
    let falla_fecha_inicio = $("#falla_fecha_inicio").val();
    let falla_fecha_termino = $("#falla_fecha_termino").val();
    
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
            f_color_filas_falla(row,data);
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
          title     : 'FALLAS EN INSPECCION DE FLOTA DEL '+falla_fecha_inicio+' AL '+falla_fecha_termino,
        },
      ],
      "ajax"        : {            
        "url"       : "Ajax.php", 
        "method"    : 'POST', 
        "data"      : {MoS:MoS, NombreMoS:NombreMoS, Accion:Accion, fecha_inicio:falla_fecha_inicio, fecha_termino:falla_fecha_termino},
        "dataSrc"   : ""
      },
      "columns"     : columnas_tabla,
      "columnDefs": [
        {"className": "text-center", "targets": [0,1,2,3,4,11]}
      ],
      "order"       : [[0, 'asc']]
    });    
  });
  ///:: FIN EVENTO BOTON BUSCAR REPORTE DE INSPECCION DE FLOTA ::::::::::::::::::::::::::::///

  ///:: EVENTO BOTON ANULAR FALLA EN INSPECCION DE FLOTA ::::::::::::::::::::::::::::::::::///
  $(document).on("click", ".btn_anular_falla", function(){
    let existe_orden_trabajo = '';
    if(inspeccion_movimiento_id!=''){
      existe_orden_trabajo = f_buscar_dato('manto_inspeccion_movimiento','insp_orden_trabajo_id',"`inspeccion_movimiento_id`='"+inspeccion_movimiento_id+"'");
      if(existe_orden_trabajo.length>0){
        Swal.fire({
          position            : 'center',
          icon                : 'error',
          title               : '*Existe Orden de Trabajo ID '+existe_orden_trabajo+' !!!',
          showConfirmButton   : false,
          timer               : 1500
        })  
      }else{
        Swal.fire({
          title               : '¿Está seguro?',
          text                : "Se anulará la Falla de Inspeccion F-"+inspeccion_movimiento_id+"!",
          icon                : 'warning',
          showCancelButton    : true,
          confirmButtonColor  : '#3085d6',
          cancelButtonColor   : '#d33',
          confirmButtonText   : 'Si, anular!',
          cancelButtonText    : 'Cancelar'
        }).then((result) => {
          if (result.isConfirmed) {
            Accion = 'anular_falla';
              $.ajax({
                url         : "Ajax.php",
                type        : "POST",
                datatype    : "json",    
                data        : { MoS:MoS, NombreMoS:NombreMoS, Accion:Accion, inspeccion_movimiento_id:inspeccion_movimiento_id },   
                success: function() {
                  tabla_falla.ajax.reload(null, false);
                  Swal.fire(
                    'Anulado!',
                    'El registro ha sido anulado.',
                    'success'
                  )
                  div_show = f_MostrarDiv("form_seleccion_falla","btn_seleccion_falla",'ANULADO');
                  $("#div_btn_seleccion_falla").html(div_show);
                }
              });
          }
        });    
      }
    }else{
      Swal.fire({
        position            : 'center',
        icon                : 'error',
        title               : '*No Existe Inspección ID !!!',
        showConfirmButton   : false,
        timer               : 1500
      })
    }          
  });
  ///:: FIN EVENTO BOTON ANULAR INSPECCION DE FLOTA :::::::::::::::::::::::::::::::::::::::///

  ///:: BOTON NUEVA FALLA EN INSPECCION DE FLOTA ::::::::::::::::::::::::::::::::::::::::::///
  $(document).on("click", ".btn_crear_falla", function(){
      $("#form_nueva_falla").trigger("reset");
      nf_inspeccion_id = '';
      nf_bus = '';
      nf_detalle_inspeccion = '';
      nf_codigo = '';
      nf_descripcion = '';
      nf_componente = '';
      nf_posicion = '';
      nf_falla = '';
      nf_accion = '';
  
      select_fal_insp = '';
      $("#nf_bus").html(select_fal_insp);
      $("#nf_codigo").html(select_fal_insp);
      $("#nf_componente").html(select_fal_insp);
      $("#nf_posicion").html(select_fal_insp);
      $("#nf_falla").html(select_fal_insp);
      $("#nf_accion").html(select_fal_insp);
  
      $("#nf_bus").val(nf_bus);
      $("#nf_detalle_inspeccion").val(nf_detalle_inspeccion);
      $("#nf_codigo").val(nf_codigo);
      $("#nf_descripcio").val(nf_descripcion);
      $("#nf_componente").val(nf_componente);
      $("#nf_posicion").val(nf_posicion);
      $("#nf_falla").val(nf_falla);
      $("#nf_accion").val(nf_accion);
        
      $(".modal-header").css( "background-color", "#17a2b8");
      $(".modal-header").css( "color", "white" );
      $(".modal-title").text( "Alta de Falla" );
      $('#modal_crud_nueva_falla').modal('show');
  });
  ///:: FIN BOTON AGREGAR NUEVA INSPECCION COMPONENTE Y POSICION DE FLOTA :::::::::::::::::///

  ///:: BOTON AGREGAR NUEVA FALLA EN INSPECCION DE FLOTA ::::::::::::::::::::::::::::::::::///
  $(document).on("click", ".btn_agregar_nueva_falla", function(){
    let valida_falla = '';
    let t_msg = '';
    let existe_falla = '';

    nf_inspeccion_id= $.trim($('#nf_inspeccion_id').val());
    nf_bus         = $.trim($('#nf_bus').val());
    nf_codigo      = $.trim($('#nf_codigo').val());
    nf_descripcion = $.trim($('#nf_descripcion').val());
    nf_componente  = $.trim($('#nf_componente').val());
    nf_posicion    = $.trim($('#nf_posicion').val());    
    nf_falla       = $.trim($('#nf_falla').val());
    nf_accion      = $.trim($('#nf_accion').val());

    valida_falla = f_valida_falla(nf_inspeccion_id, nf_bus, nf_bus_tipo, nf_codigo, nf_descripcion, nf_componente, nf_posicion, nf_falla, nf_accion);
    if(valida_falla=="invalido"){
      t_msg += 'Falta Completar Información!!!';
    }
    
    existe_falla = f_buscar_dato('manto_inspeccion_movimiento','insp_falla',"`inspeccion_id`='"+nf_inspeccion_id+"' AND `insp_bus_tipo`='"+nf_bus_tipo+"' AND `insp_bus`='"+nf_bus+"' AND `insp_codigo`='"+nf_codigo+"' AND `insp_componente`='"+nf_componente+"' AND `insp_posicion`='"+nf_posicion+"' AND `insp_falla`='"+nf_falla+"' AND `insp_movimiento_estado`='ACTIVO'");
    
    if(existe_falla == nf_falla){

      valida_falla = "invalido";
      t_msg += "Falla ya registrada!!!";
    }
    
    if(valida_falla=="invalido"){
      Swal.fire({
        position            : 'center',
        icon                : 'error',
        title               : t_msg,
        showConfirmButton   : false,
        timer               : 1500
      })
    }else{
      $("#btn_agregar_nueva_falla").prop("disabled",true);
      Accion = 'crear_falla';
      $.ajax({
        url       : "Ajax.php",
        type      : "POST",
        datatype  : "json",
        async     : false,
        data      : {MoS:MoS, NombreMoS:NombreMoS, Accion:Accion, inspeccion_id:nf_inspeccion_id, insp_bus_tipo:nf_bus_tipo, insp_bus:nf_bus, insp_codigo:nf_codigo, insp_descripcion:nf_descripcion, insp_componente:nf_componente, insp_posicion:nf_posicion, insp_falla:nf_falla, insp_accion:nf_accion},
        success   : function(data){
          tabla_falla.ajax.reload(null, false);
        }
      });
      $('#modal_crud_nueva_falla').modal('hide');
      $("#btn_agregar_nueva_falla").prop("disabled",false);
    }
  });
  ///:: FIN BOTON AGREGAR NUEVA INSPECCION COMPONENTE Y POSICION DE FLOTA :::::::::::::::::///

  ///:: TERMINO BOTONES REPORTE DE INSPECCION DE FLOTA ::::::::::::::::::::::::::::::::::::///


});    
///:: TERMINO JS DOM REPORTE DE INSPECCION FLOTA ::::::::::::::::::::::::::::::::::::::::::///


///:: FUNCIONES DE REPORTE DE INSPECCION DE FLOTA :::::::::::::::::::::::::::::::::::::::::///

///:: CAMBIA EL COLOR DEL CAMPO ESTADO EN EL DATATABLE ::::::::::::::::::::::::::::::::::::///
function f_color_filas_falla(row, data){
  let color_rojo  = "#E26A5A";
  let color_verde = "#009390";
  let color_azul  = "#005EA4";
  
  // Columna
  if(data.insp_movimiento_estado == 'ANULADO') {
    $("td:eq(1)",row).css({
      "color":color_rojo,
    });
  }

  // Columna 
  if(data.insp_movimiento_estado == 'ACTIVO') {
    $("td:eq(1)",row).css({
      "color":color_verde,
    });
  }
}
///:: FIN CAMBIA EL COLOR DEL CAMPO ESTADO EN EL DATATABLE ::::::::::::::::::::::::::::::::///

///:: FUNCION PARA VALIDAR LOS DATOS INGRESADOS AL FORMULARIO :::::::::::::::::::::::::::::///
function f_valida_falla(p_nf_inspeccion_id, p_nf_bus, p_nf_bus_tipo, p_nf_codigo, p_nf_descripcion, p_nf_componente, p_nf_posicion, p_nf_falla, p_nf_accion){
  f_limpia_falla();
  let rpta_valida_falla = "";
  
  if(p_nf_inspeccion_id==""){
    $("#nf_inspeccion_id").addClass("color-error");
    rpta_valida_falla = "invalido";
  }
  if(p_nf_bus==""){
    $("#nf_bus").addClass("color-error");
    rpta_valida_falla = "invalido";
  }
  if(p_nf_bus_tipo==""){
    $("#nf_detalle_inspeccion").addClass("color-error");
    rpta_valida_falla = "invalido";
  }
  if(p_nf_codigo==""){
    $("#nf_codigo").addClass("color-error");
    rpta_valida_falla = "invalido";
  }
  if(p_nf_descripcion==""){
    $("#nf_descripcion").addClass("color-error");
    rpta_valida_falla = "invalido";
  }
  if(p_nf_componente==""){
    $("#nf_componente").addClass("color-error");
    rpta_valida_falla = "invalido";
  }
  if(p_nf_posicion==""){
    $("#nf_posicion").addClass("color-error");
    rpta_valida_falla = "invalido";
  }
  if(p_nf_falla==""){
    $("#nf_falla").addClass("color-error");
    rpta_valida_falla = "invalido";
  }
  if(p_nf_accion==""){
    $("#nf_accion").addClass("color-error");
    rpta_valida_falla = "invalido";
  }
  return rpta_valida_falla;
}
///:: FUNCION PARA VALIDAR LOS DATOS INGRESADOS AL FORMULARIO :::::::::::::::::::::::::::::///

///:: REESTABLECE EL COLOR DE LOS CAMPOS INVALIDOS ::::::::::::::::::::::::::::::::::::::::/// 
function f_limpia_falla(){
  $("#nf_inspeccion_id").removeClass("color-error");
  $("#nf_bus").removeClass("color-error");
  $("#nf_detalle_inspeccion").removeClass("color-error");
  $("#nf_codigo").removeClass("color-error");
  $("#nf_descripcion").removeClass("color-error");
  $("#nf_componente").removeClass("color-error");
  $("#nf_posicion").removeClass("color-error");
  $("#nf_falla").removeClass("color-error");
  $("#nf_accion").removeClass("color-error");
}
///:: FIN REESTABLECE EL COLOR DE LOS CAMPOS INVALIDOS ::::::::::::::::::::::::::::::::::::///


///:: TERMINO FUNCIONES DE REPORTE DE INSPECCION DE FLOTA :::::::::::::::::::::::::::::::::///
