///::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
///:: VER COTIZACIONES v 3.0 FECHA: 23-02-2023 ::::::::::::::::::::::::::::::::::::::::::::///
///:: EDITAR TABLA DE VER COTIZACIONES ::::::::::::::::::::::::::::::::::::::::::::::::::::///
///::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///

///:: DECLARACION DE VARIABLES ::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
var tmc_pedidoid, tmc_cotizacionid, tmc_razonsocial, tmc_materialid, tmc_descripcion, tmc_unidadmedida, tmc_cantidad, tmc_moneda, tmc_preciosoles, tmc_fechavigencia, tmc_cantidad_cotizacion, tmc_cantidad_solicitada, tmc_preciocotizacion, tmc_subtotal_precio, tmc_seleccion, grupo_material;
var tabla_ver_cotizacion, array_ver_cotizacion, array_material_seleccionado, fila_ver_cotizacion, grupo_columna, seleccion_on, seleccion_off;
var coti_estado, mc_pedidoid;
grupo_columna = 15;
array_ver_cotizacion = [];
///:: FIN DECLARACION DE VARIABLES ::::::::::::::::::::::::::::::::::::::::::::::::::::::::///

///:: INICIO JS DOM VER COTIZACIONES ::::::::::::::::::::::::::::::::::::::::::::::::::::::///
$(document).ready(function(){
  div_show = f_MostrarDiv("form_seleccion_ver_cotizacion","btn_seleccion_ver_cotizacion","","");
  $("#div_btn_seleccion_ver_cotizacion").html(div_show);

  ///:: CAMBIOS CODIGO PEDIDO SE OCULTA EL FORMULARIO :::::::::::::::::::::::::::::::::::::///
  $("#mc_pedidoid").on('change', function () {
    mc_pedidoid = $("#mc_pedidoid").val();
    div_show = f_MostrarDiv("form_seleccion_ver_cotizacion","btn_seleccion_ver_cotizacion","","");
    $("#div_btn_seleccion_ver_cotizacion").html(div_show);
    $("#div_tabla_ver_cotizacion").html("");
  });
    
  ///:: ORDER BY THE GROUPING :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
  $('#tabla_ver_cotizacion').on('click', 'tr.group', function () {
    var currentOrder = tabla_ver_cotizacion.order()[0];
    if (currentOrder[0] === grupo_columna && currentOrder[1] === 'asc') {
      tabla_ver_cotizacion.order([grupo_columna, 'desc']).draw();
    } else {      
      tabla_ver_cotizacion.order([grupo_columna, 'asc']).draw();
    }
  });

  ///:: CAMBIOS CANTIDAD SOLICITADA MATERIAL ::::::::::::::::::::::::::::::::::::::::::::::///
  $("#tmc_cantidad_solicitada").on('change', function () {
    tmc_cantidad_solicitada  = $("#tmc_cantidad_solicitada").val();
    tmc_cantidad_cotizacion  = $("#tmc_cantidad_cotizacion").val();
    $("#tmc_cantidad_solicitada").removeClass("color-error");

    if(parseInt(tmc_cantidad_solicitada) > parseInt(tmc_cantidad_cotizacion)){
      $("#tmc_cantidad_solicitada").addClass("color-error");
      Swal.fire({
        position          : 'center',
        icon              : 'error',
        title             : '*Cantidad Solicitada es mayor que la Cantidad de la Cotización!!!',
        showConfirmButton : false,
        timer             : 1500
      })
    }else{
      tmc_preciocotizacion  = $("#tmc_preciocotizacion").val();
      tmc_subtotal_precio   = tmc_preciocotizacion * tmc_cantidad_solicitada;
      $("#tmc_subtotal_precio").val(tmc_subtotal_precio.toFixed(2));    
    }
  });

  ///:: INICIO BOTONES DE VER COTIZACIONES ::::::::::::::::::::::::::::::::::::::::::::::::///

  ///:: EVENTO DE BOTON VER COTIZACIONES ::::::::::::::::::::::::::::::::::::::::::::::::::///
  $(document).on("click", ".btn_buscar_ver_cotizacion", function(){
    mc_pedidoid = $("#mc_pedidoid").val();
    f_validar_estado_cotizacion(mc_pedidoid);
    div_tabla     = f_CreacionTabla("tabla_ver_cotizacion","");
    $("#div_tabla_ver_cotizacion").html(div_tabla);
    columnastabla = f_ColumnasTabla("tabla_ver_cotizacion","");
    $("#tabla_ver_cotizacion").dataTable().fnDestroy();
    $('#tabla_ver_cotizacion').show();

    Accion='ver_cotizacion';
    $.ajax({
      url       : "Ajax.php",
      type      : "POST",
      datatype  :"json",
      async     : false,
      data      : {MoS:MoS,NombreMoS:NombreMoS,Accion:Accion,  pedido_id:mc_pedidoid, coti_estado:coti_estado },    
      success   : function(data){
        array_ver_cotizacion = $.parseJSON(data);
      }
    });
    
    tabla_ver_cotizacion = $('#tabla_ver_cotizacion').DataTable({
      drawCallback: function (settings) {
        var api = this.api();
        var rows = api.rows({ page: 'current' }).nodes();
        var last = null;
        api
            .column(grupo_columna, { page: 'current' })
            .data()
            .each(function (group, i) {
                if (last !== group) {
                    $(rows)
                        .eq(i)
                        .before('<tr class="group"><td colspan="16">' + group + '</td></tr>');
                    last = group;
                }
            });
      },
      deferRender     : true,
      scrollY         : 800,
      scrollCollapse  : true,
      scroller        : true,
      scrollX         : true,
      fixedColumns    :{
        left          : 1
      },
      fixedHeader     :{
        header        : false
      },
      pageLength      : 50,
      language        : idiomaEspanol, 
      responsive      : "true",
      dom             : 'Blfrtip',
      buttons:[
        {
          extend      : 'excelHtml5',
          text        : '<i class="fas fa-file-excel"></i> ',
          titleAttr   : 'Exportar a Excel',
          className   : 'btn btn-success',
          title       : 'COTIZACIONES'
        },
      ],
      data            : array_ver_cotizacion,
      "columns"       : columnastabla,
      "columnDefs"    : [
        {
          width       : "10px",
          targets     : [2]
        },
        {
          orderable   : false,
          targets     : [16],
          visible     : seleccion_on
        },  
        { 
          visible     : false, 
          targets     : [grupo_columna]
        }
      ],
      "order"         : [[grupo_columna,'asc']]
    });
  }); 
  ///:: FIN EVENTO DE BOTON VER COTIZACION ::::::::::::::::::::::::::::::::::::::::::::::::///

  ///:: EVENTO DEL BOTON EDITAR MATERIALES SELECCION COTIZACIONES :::::::::::::::::::::::::///
  $(document).on("click", ".btn_editar_material_seleccionado", function(){
    $("#form_modal_material_seleccionado").trigger("reset");

    tmc_pedidoid             = "";
    tmc_cotizacionid         = "";
    tmc_razonsocial          = "";
    tmc_materialid           = "";
    tmc_descripcion          = "";
    tmc_unidadmedida         = "";
    tmc_cantidad             = "";
    tmc_preciosoles          = "";
    tmc_fechavigencia        = "";
    tmc_cantidad_cotizacion  = "";
    tmc_cantidad_solicitada  = "";
    tmc_preciocotizacion     = "";
    tmc_subtotal_precio      = "";
    tmc_seleccion            = "";

    fila_material_seleccionado    = $(this).closest('tr'); 
    fila_rm_material_selecionado  = $(this);
    
    tmc_pedidoid             = fila_material_seleccionado.find('td:eq(0)').text();
    tmc_cotizacionid         = fila_material_seleccionado.find('td:eq(1)').text();
    tmc_razonsocial          = fila_material_seleccionado.find('td:eq(2)').text();
    tmc_materialid           = fila_material_seleccionado.find('td:eq(3)').text();
    tmc_descripcion          = fila_material_seleccionado.find('td:eq(4)').text();
    tmc_unidadmedida         = fila_material_seleccionado.find('td:eq(5)').text();
    tmc_cantidad             = fila_material_seleccionado.find('td:eq(6)').text();
    tmc_moneda               = fila_material_seleccionado.find('td:eq(7)').text();
    tmc_preciosoles          = fila_material_seleccionado.find('td:eq(8)').text();
    tmc_fechavigencia        = fila_material_seleccionado.find('td:eq(9)').text();
    tmc_cantidad_cotizacion  = fila_material_seleccionado.find('td:eq(10)').text();
    tmc_cantidad_solicitada  = fila_material_seleccionado.find('td:eq(11)').text();
    tmc_preciocotizacion     = fila_material_seleccionado.find('td:eq(12)').text();
    tmc_subtotal_precio      = fila_material_seleccionado.find('td:eq(13)').text();
    tmc_seleccion            = fila_material_seleccionado.find('td:eq(14)').text();

    $('#tmc_pedidoid').val(tmc_pedidoid);
    $('#tmc_cotizacionid').val(tmc_cotizacionid);
    $('#tmc_razonsocial').val(tmc_razonsocial);
    $('#tmc_materialid').val(tmc_materialid);
    $('#tmc_descripcion').val(tmc_descripcion);
    $('#tmc_unidadmedida').val(tmc_unidadmedida);
    $('#tmc_cantidad').val(tmc_cantidad);
    $('#tmc_moneda').val(tmc_moneda);
    $('#tmc_preciosoles').val(tmc_preciosoles);
    $('#tmc_fechavigencia').val(tmc_fechavigencia);
    $('#tmc_cantidad_cotizacion').val(tmc_cantidad_cotizacion);
    $('#tmc_cantidad_solicitada').val(tmc_cantidad_solicitada);
    $('#tmc_preciocotizacion').val(tmc_preciocotizacion);   
    $('#tmc_subtotal_precio').val(tmc_subtotal_precio);    
    $('#tmc_seleccion').val(tmc_seleccion);          

    $(".modal-header").css( "background-color", "#17a2b8" );
    $(".modal-header").css( "color", "white" );
    $("#material_seleccionado_modal_label").text( "Edición de Cantidad Solicitada" );

    $('#modal_crud_material_seleccionado').modal('show');
    $('#modal_crud_material_seleccionado').draggable({});
  });
  ///:: FIN EVENTO DEL BOTON EDITAR MATERIALES SELECCION COTIZACIONES :::::::::::::::::::::///

  ///:: BOTON GUARDAR -> REALIZA LA GRABACION EN ARREGLO MATERIAL COTIZACION ::::::::::::::///
  $('#form_modal_material_seleccionado').submit(function(e){                         
    e.preventDefault();
    let validar_cantidad_solicitada = "";
    tmc_pedidoid             = $('#tmc_pedidoid').val();
    tmc_cotizacionid         = $('#tmc_cotizacionid').val();
    tmc_razonsocial          = $('#tmc_razonsocial').val();
    tmc_materialid           = $('#tmc_materialid').val();
    tmc_descripcion          = $('#tmc_descripcion').val();
    tmc_unidadmedida         = $('#tmc_unidadmedida').val();
    tmc_cantidad             = $('#tmc_cantidad').val();
    tmc_moneda               = $('#tmc_moneda').val();
    tmc_preciosoles          = $('#tmc_preciosoles').val();
    tmc_fechavigencia        = $('#tmc_fechavigencia').val();
    tmc_cantidad_cotizacion  = $('#tmc_cantidad_cotizacion').val();
    tmc_cantidad_solicitada  = $('#tmc_cantidad_solicitada').val();
    tmc_preciocotizacion     = $('#tmc_preciocotizacion').val();
    tmc_subtotal_precio      = $('#tmc_subtotal_precio').val();
    tmc_seleccion            = $('#tmc_seleccion').val();
    grupo_material           = "CODIGO: "+tmc_materialid+" - DESCRIPCION: "+tmc_descripcion+" - CANTIDAD PEDIDO: "+tmc_cantidad;

    $("#btn_guardar_material_seleccionado").prop("disabled",true);
    $("#tmc_cantidad_solicitada").removeClass("color-error");

    if(tmc_cantidad_cotizacion==""){tmc_cantidad_cotizacion="0";}
    if(tmc_cantidad_solicitada==""){tmc_cantidad_solicitada="0";}
    
    if(parseInt(tmc_cantidad_solicitada) > parseInt(tmc_cantidad_cotizacion)){
      $("#tmc_cantidad_solicitada").addClass("color-error");
      Swal.fire({
        position          : 'center',
        icon              : 'error',
        title             : '*Cantidad Solicitada es mayor que la Cantidad de la Cotización!!!',
        showConfirmButton : false,
        timer             : 1500
      })
    }else{
      if(parseInt(tmc_cantidad_solicitada)==0){
        tmc_seleccion = "NO";
      }else{
        tmc_seleccion = "SI";
        validar_cantidad_solicitada = f_validar_material_solicitado(tmc_materialid, tmc_cantidad, tmc_cantidad_solicitada, fila_material_seleccionado.find('td:eq(11)').text());
      }
      
      if(validar_cantidad_solicitada=="invalido"){
        $("#tmc_cantidad_solicitada").addClass("color-error");
        Swal.fire({
          position          : 'center',
          icon              : 'error',
          title             : '*Cantidad Solicitada es mayor que la Cantidad del Pedido!!!',
          showConfirmButton : false,
          timer             : 1500
        })  
      }else{
        tabla_ver_cotizacion
        .row( fila_rm_material_selecionado.parents('tr') )
        .remove()
        .draw();
  
        tabla_ver_cotizacion.row.add( {
          "tmc_pedidoid"             : tmc_pedidoid,           
          "tmc_cotizacionid"         : tmc_cotizacionid,       
          "tmc_razonsocial"          : tmc_razonsocial,        
          "tmc_materialid"           : tmc_materialid,         
          "tmc_descripcion"          : tmc_descripcion,        
          "tmc_unidadmedida"         : tmc_unidadmedida,       
          "tmc_cantidad"             : tmc_cantidad,           
          "tmc_moneda"               : tmc_moneda,             
          "tmc_preciosoles"          : tmc_preciosoles,        
          "tmc_fechavigencia"        : tmc_fechavigencia,      
          "tmc_cantidad_cotizacion"  : tmc_cantidad_cotizacion,
          "tmc_cantidad_solicitada"  : tmc_cantidad_solicitada,
          "tmc_preciocotizacion"     : tmc_preciocotizacion,   
          "tmc_subtotal_precio"      : tmc_subtotal_precio,    
          "tmc_seleccion"            : tmc_seleccion,          
          "grupo_material"           : grupo_material         
        } ).draw();
        $('#modal_crud_material_seleccionado').modal('hide');  
      }
    }
    $("#btn_guardar_material_seleccionado").prop("disabled",false);
    f_mostrar_btn_generar_orden_compra();
  });
  ///:: FIN REALIZA LA GRABACION EN arreglo MaterialesCotizaciones ::::::::::::::::::::::::///

  ///:: EVENTO DE BOTON GENERAR ORDEN DE COMPRA :::::::::::::::::::::::::::::::::::::::::::///
  $(document).on("click", ".btn_generar_orden_compra", function(){
    let atencion_pedido         = "";
    let array_data              = [];
    array_material_seleccionado = [];
    mc_pedidoid                 = $("#mc_pedidoid").val();
    array_material_seleccionado = tabla_ver_cotizacion.rows().data().toArray();
    atencion_pedido             = f_atencion_pedido(mc_pedidoid);
    array_data                  = JSON.stringify(array_material_seleccionado);

    if(atencion_pedido=="ATENCION PARCIAL"){
      Swal.fire({
        title               : '¿Está seguro?',
        text                : "Se genera Orden de Compra con el Nro. de Pedido "+mc_pedidoid+" ATENCION PARCIAL !!!",
        icon                : 'warning',
        showCancelButton    : true,
        confirmButtonColor  : '#3085d6',
        cancelButtonColor   : '#d33',
        confirmButtonText   : 'Si, generar!'
      }).then((result) => 
      {
        if (result.isConfirmed){
          f_generar_orden_compra(array_data, atencion_pedido);         
        }
      });
    }else{
      f_generar_orden_compra(array_data, atencion_pedido);
    }
    $("#div_tabla_ver_cotizacion").html("");
  }); 
  ///:: FIN EVENTO DE BOTON GENERAR ORDEN DE COMPRA :::::::::::::::::::::::::::::::::::::::///


  ///:: TERMINO BOTONES DE VER COTIZACIONES :::::::::::::::::::::::::::::::::::::::::::::::///

});
///:: TERMINO DE DOM VER COTIZACIONES ::::::::::::::::::::::::::::::::::::::::::::::::::::///

///:: INICIO DE FUNCIONES DE VER COTIZACIONES :::::::::::::::::::::::::::::::::::::::::::::///

///:: VALIDAR ESTADO DE COTIZACION ::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
function f_validar_estado_cotizacion(p_mc_pedidoid){
  let p_data_cotizacion = [];
  p_data_cotizacion = f_BuscarDataBD("manto_pedidos","pedido_id",p_mc_pedidoid);
  $.each(p_data_cotizacion, function(idx, obj){
    if(obj.pedi_estado=="EN COTIZACION"){
      seleccion_off = false;
      seleccion_on  = true;
      coti_estado   = "RECIBIDA";
    }else{
      seleccion_off = true;
      seleccion_on  = false;
      coti_estado   = "";
    }
  });
}
///:: FIN VALIDAR ESTADO DE COTIZACION ::::::::::::::::::::::::::::::::::::::::::::::::::::///

///:: MOSTRAR BOTON GENERAR ORDEN DE COMPRA :::::::::::::::::::::::::::::::::::::::::::::::///
function f_mostrar_btn_generar_orden_compra(){
  array_material_seleccionado           = [];
  let mostrar_btn_generar_orden_compra  = "";
  array_material_seleccionado           = tabla_ver_cotizacion.rows().data().toArray();

  $.each(array_material_seleccionado, function(idx, obj){
    if(obj.tmc_seleccion=="SI"){
      mostrar_btn_generar_orden_compra = "orden de compra";    
    }
  });
  div_show = f_MostrarDiv("form_seleccion_ver_cotizacion","btn_seleccion_ver_cotizacion",mostrar_btn_generar_orden_compra,"");
  $("#div_btn_seleccion_ver_cotizacion").html(div_show);
}
///:: FIN MOSTRAR BOTON GENERAR ORDEN DE COMPRA :::::::::::::::::::::::::::::::::::::::::::///

///:: ATENCION DEL PEDIDO :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
function f_atencion_pedido(p_mc_pedidoid){
  let rpta_atencion_pedido    = "";
  let array_data              = [];
  array_material_seleccionado = tabla_ver_cotizacion.rows().data().toArray();
  array_data                  = JSON.stringify(array_material_seleccionado);
  
  Accion = "atencion_pedido";
  $.ajax({
    url       : "Ajax.php",
    type      : "POST",
    datatype  : "json",    
    async     : false,   
    data      :  { MoS:MoS,NombreMoS:NombreMoS,Accion:Accion, pedido_id:p_mc_pedidoid, array_data:array_data },
    success   : function(data) {
      rpta_atencion_pedido = data;
    }
  });

  return rpta_atencion_pedido;
}
///:: FIN ATENCION DEL PEDIDO :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///

///:: VALIDAR MATERIAL SELECIONADA ::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
function f_validar_material_solicitado(p_tmc_materialid, p_tmc_cantidad, p_tmc_cantidad_solicitada, p_tmc_cantidad_solicitada_anterior){
  let rpta_validar_material_solicitado  = "";
  let array_data                          = [];
  array_material_seleccionado             = tabla_ver_cotizacion.rows().data().toArray();
  array_data                              = JSON.stringify(array_material_seleccionado);

  Accion = "validar_material_solicitado";
  $.ajax({
    url       : "Ajax.php",
    type      : "POST",
    datatype  : "json",    
    async     : false,   
    data      :  { MoS:MoS,NombreMoS:NombreMoS,Accion:Accion, tmc_materialid:p_tmc_materialid, tmc_cantidad_pedido:p_tmc_cantidad, tmc_cantidad_solicitada:p_tmc_cantidad_solicitada, tmc_cantidad_solicitada_anterior:p_tmc_cantidad_solicitada_anterior, array_data:array_data },
    success   : function(data) {
      rpta_validar_material_solicitado = data;
    }
  });

  return rpta_validar_material_solicitado;
}
///:: FIN VALIDAR MATERIAL SELECIONADA ::::::::::::::::::::::::::::::::::::::::::::::::::::///

///:: FUNCION GENERAR ORDEN DE COMPRA :::::::::::::::::::::::::::::::::::::::::::::::::::::///
function f_generar_orden_compra(p_array_data, p_atencion_pedido ){
  Accion = "generar_orden_compra";
  $.ajax({
    url       : "Ajax.php",
    type      : "POST",
    datatype  : "json",    
    async     : false,   
    data      :  { MoS:MoS,NombreMoS:NombreMoS,Accion:Accion, array_data:p_array_data, atencion_pedido:p_atencion_pedido },
    success   : function(data) {
      Swal.fire(
        'Generada!',
        'La Orden de Comrpra ha sido generada.',
        'success')
    }
  });
}
///:: FIN FUNCION GENERAR ORDEN DE COMPRA :::::::::::::::::::::::::::::::::::::::::::::::::///

///:: TERMINO DE FUNCIONES DE VER COTIZACIONES ::::::::::::::::::::::::::::::::::::::::::::///