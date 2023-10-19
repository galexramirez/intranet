///::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
///:: ORDEN COMPRA v 2.0 FECHA: 18-02-2023 ::::::::::::::::::::::::::::::::::::::::::::::::///
///:: EDITAR, ELIMINAR TABLA DE ORDEN COMPRA ::::::::::::::::::::::::::::::::::::::::::::::///
///::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///

///:: DECLARACION DE VARIABLES ::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
var ordencompra_id;
var fila_orden_compra, obs_anular_orden_compra;
///:: TERMINO DECLARACION DE VARIABLES ::::::::::::::::::::::::::::::::::::::::::::::::::::///

///:: INICIO JS DOM ORDEN DE COMPRA :::::::::::::::::::::::::::::::::::::::::::::::::::::::///
$(document).ready(function(){

  div_boton = f_BotonesFormulario("form_seleccion_orden_compra","btn_seleccion_orden_compra","","");
  $("#div_btn_seleccion_orden_compra").html(div_boton);

  ///:: CAMBIOS CODIGO PEDIDO SE OCULTA EL FORMULARIO :::::::::::::::::::::::::::::::::::///
  $("#orco_pedidoid").on('change', function () {
    orco_pedidoid = $("#orco_pedidoid").val();
    $("#div_tabla_orden_compra").html("");
  });
  
  ///:: INICIO BOTONES DE ORDEN DE COMPRA :::::::::::::::::::::::::::::::::::::::::::::::///
  
  ///:: BOTON BUSCAR ORDENES DE COMPRA ::::::::::::::::::::::::::::::::::::::::::::::::::///
  $(document).on("click", ".btn_buscar_orden_compra", function(){
    orco_pedidoid = $("#orco_pedidoid").val();
    div_tabla = f_CreacionTabla("tabla_orden_compra","");
    $("#div_tabla_orden_compra").html(div_tabla);
    columnastabla = f_ColumnasTabla("tabla_orden_compra","");
    
    $("#tabla_orden_compra").dataTable().fnDestroy();
    $('#tabla_orden_compra').show();
    
    Accion='leer_orden_compra';
    tabla_orden_compra = $('#tabla_orden_compra').DataTable({
        deferRender     : true,
        scrollY         : 800,
        scrollCollapse  : true,
        scroller        : true,
        scrollX         : true,
        fixedColumns    : {
                            left: 1
                        },
        fixedHeader     : {
                            header : false
                        },
        pageLength      : 50,
        language        : idiomaEspanol, 
        responsive      : "true",
        dom             : 'Blfrtip', // Con Botones Excel,Pdf,Print
        buttons         : [
                            {
                                extend      : 'excelHtml5',
                                text        : '<i class="fas fa-file-excel"></i> ',
                                titleAttr   : 'Exportar a Excel',
                                className   : 'btn btn-success',
                                title       : 'ORDENES DE COMPRA'
                            },
                        ],
        "ajax"          : {            
                            "url"       : "Ajax.php", 
                            "method"    : 'POST',
                            "data"      : { MoS:MoS,NombreMoS:NombreMoS,Accion:Accion, orco_pedidoid:orco_pedidoid },
                            "dataSrc"   : ""
                        },
        "columns"       : columnastabla,
        "order"         : [[1, 'desc']]
    });     
  });
  ///:: FIN BOTON BUSCAR ORDEN DE COMPRA ::::::::::::::::::::::::::::::::::::::::::::::::::///

  ///:: EVENTO DEL BOTON EDITAR :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
  $(document).on("click", ".btn_editar_orden_compra", function(){		
/*        fila_orden_compra = $(this).closest('tr'); 
        pedido_id = fila_orden_compra.find('td:eq(1)').text();
        $("#pedido_id").val(pedido_id);
        $('#nav-profile-tab').tab('show');
        document.getElementById("btn_cargar_pedido").click();
        $("#pedido_id").focus().select();*/
  });
  ///:: FIN EVENTO DEL BOTON EDITAR :::::::::::::::::::::::::::::::::::::::::::::::::::::::///

  ///:: EVENTO DE BOTON VER PEDIDO ::::::::::::::::::::::::::::::::::::::::::::::::::::::::///       
  $(document).on("click", ".btn_ver_orden_compra", function(){		
    fila_orden_compra = $(this).closest('tr'); 
    ordencompra_id    = fila_orden_compra.find('td:eq(1)').text();
    orco_fecha        = fila_orden_compra.find('td:eq(2)').text();
    orco_pedidoid     = fila_orden_compra.find('td:eq(3)').text();
    orco_cotizacionid = fila_orden_compra.find('td:eq(4)').text();
    orco_ruc          = fila_orden_compra.find('td:eq(5)').text();
    orco_razonsocial  = fila_orden_compra.find('td:eq(6)').text();
    orco_centrocosto  = fila_orden_compra.find('td:eq(7)').text();
    orco_prioridad    = fila_orden_compra.find('td:eq(8)').text();
    orco_subtotal     = fila_orden_compra.find('td:eq(9)').text();
    orco_igv          = fila_orden_compra.find('td:eq(10)').text();
    orco_subtotal     = fila_orden_compra.find('td:eq(11)').text();
    orco_estado       = fila_orden_compra.find('td:eq(12)').text();
    orco_responsable  = fila_orden_compra.find('td:eq(13)').text();

    orco_data = f_BuscarDataBD("manto_ordencompra","ordencompra_id",ordencompra_id);
    $.each(orco_data, function(idx, obj){ 
          orco_log = obj.orco_log;
    });
    
    $("#form_modal_orden_compra").trigger("reset");

    $('#ordencompra_id').val(ordencompra_id);
    $('#orco_fecha').val(orco_fecha);
    $('#orco_pedidoid').val(orco_pedidoid);
    $('#orco_cotizacionid').val(orco_cotizacionid);
    $('#orco_ruc').val(orco_ruc);
    $('#orco_razonsocial').val(orco_razonsocial);
    $('#orco_centrocosto').val(orco_centrocosto);
    $('#orco_prioridad').val(orco_prioridad);
    $('#orco_subtotal').val(orco_subtotal);
    $('#orco_igv').val(orco_igv);
    $('#orco_subtotal').val(orco_subtotal);
    $('#orco_estado').val(orco_estado);
    $('#orco_responsable').val(orco_responsable);
    $("#div_orco_log").html(orco_log);

    div_tabla = f_CreacionTabla("tabla_material_orden_compra","");
    $("#div_tabla_material_orden_compra").html(div_tabla);
    columnastabla = f_ColumnasTabla("tabla_material_orden_compra","");
    $("#tabla_material_orden_compra").dataTable().fnDestroy();
    $('#tabla_material_orden_compra').show();
    
    Accion='cargar_material_orden_compra';
    tabla_material_orden_compra = $('#tabla_material_orden_compra').DataTable({
      language      : idiomaEspanol,
      searching     : false,
      info          : false,
      lengthChange  : false,
      pageLength    : 5,
      responsive    : "true",
      "ajax":{            
        "url"       : "Ajax.php", 
        "method"    : 'POST',
        "data"      : { MoS:MoS, NombreMoS:NombreMoS, Accion:Accion, ordencompra_id:ordencompra_id },
        "dataSrc"   : ""
      },
      "columns"     : columnastabla
    });     
    
    $(".modal-header").css( "background-color", "#17a2b8");
    $(".modal-header").css( "color", "white" );
    $(".modal-title").text("Información de Orden de Compra");
    $('#modal_crud_orden_compra').modal('show');	    
  });
  ///:: FIN EVENTO DE BOTON VER PEDIDO ::::::::::::::::::::::::::::::::::::::::::::::::::::///

  ///:: EVENTO DEL BOTON ANULAR ORDEN DE COMPRA :::::::::::::::::::::::::::::::::::::::::::///
  $(document).on("click", ".btn_anular_orden_compra", function(){
    fila_orden_compra       = $(this).closest('tr'); 
    ordencompra_id          = fila_orden_compra.find('td:eq(1)').text();
    obs_anular_orden_compra = "";
    $("#form_modal_anular_orden_compra").trigger("reset");

    $("#obs_anular_orden_compra").val(obs_anular_orden_compra);
    $("#obs_anular").removeClass("color-error");
    $(".modal-header").css( "background-color", "#17a2b8");
    $(".modal-header").css( "color", "white" );
    $(".modal-title").text("Anular Orden de Compra");
    $('#modal_crud_anular_orden_compra').modal('show');
    $("#modal_crud_anular_orden_compra").draggable({});
  });
  ///:: FIN EVENTO DEL BOTON ANULAR ORDEN DE COMPRA :::::::::::::::::::::::::::::::::::::::///

  ///:: EVENTO DEL BOTON GRABAR ANULAR ORDEN DE COMPRA ::::::::::::::::::::::::::::::::::::///
  $(document).on("click", ".btn_grabar_anular_orden_compra", function(){
    $("#obs_anular_orden_compra").removeClass("color-error");
    obs_anular_orden_compra = $("#obs_anular_orden_compra").val();

    if(obs_anular_orden_compra == ""){
      $("obs_anular").addClass("color-error");
      Swal.fire({
        position          : 'center',
        icon              : 'error',
        title             : '*Falta Completar Información!!!',
        showConfirmButton : false,
        timer             : 1500
      })
    }else{
      orco_estado = "ANULADA";
      Accion      = 'estado_orden_compra';
      $.ajax({
        url       : "Ajax.php",
        type      : "POST",
        datatype  :"json",
        async     : false,
        data      : {MoS:MoS,NombreMoS:NombreMoS,Accion:Accion, ordencompra_id:ordencompra_id, orco_estado:orco_estado, obs_log:obs_anular_orden_compra},    
        success   : function(data){
          tabla_material_orden_compra.ajax.reload(null, false);
          Swal.fire({
            position          : 'center',
            icon              : 'success',
            title             : '*Se anuló la Orden de Compra Nro. '+ordencompra_id+' !!!',
            showConfirmButton : false,
            timer             : 1500
          })
        }
      });
      $('#modal_crud_anular_orden_compra').modal('hide');
    }
  });
  ///:: FIN EVENTO DEL BOTON GRABAR ANULAR ORDEN DE COMPRA ::::::::::::::::::::::::::::::::///

  ///::  BOTON DESCARGAR ORDEN DE COMPRA PDF  :::::::::::::::::::::::::::::::::::::::::::::///
  $(document).on("click", ".btn_orden_compra_pdf", function(){
    fila_orden_compra = $(this).closest('tr'); 
    ordencompra_id    = fila_orden_compra.find('td:eq(1)').text();
    Accion            = "orden_compra_pdf";
    
    $.ajax({
      url: "Ajax.php",
      type: "POST",
      datatype:"json",    
      async: false,   
      data:  { MoS:MoS,NombreMoS:NombreMoS,Accion:Accion, ordencompra_id:ordencompra_id },   
      success: function(data) {
        window.location.href = miCarpeta + "Module/Pedidos/Controller/PDF_OCompra.php?Id_DateJS=" + data;
      }
    });	
  
  });
  ///:: FIN BOTON DESCARGAR ORDEN DE COMPRA PDF :::::::::::::::::::::::::::::::::::::::::::///

  ///:: TERMINO BOTONES PEDIDO ::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///

});    
///:: TERMINO JS DOM PEDIDOS ::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///


///:: INICIO FUNCIONES DE PEDIDO ::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///

///:: TERMINO FUNCIONES DE PEDIDO :::::::::::::::::::::::::::::::::::::::::::::::::::::::::///