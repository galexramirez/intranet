///::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
///:::::::::::::::::::: PRECIOS PROVEEDOR v 1.0 FECHA: 07-10-2022 :::::::::::::::::::::::::::::::///
//:::::::::::::::::: CREAR, EDITAR, ELIMINAR TABLA DE PRECIOS PROVEEDOR :::::::::::::::::::::::::///
///::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///

///::::::::::::::::::::::::::::::: Declaracion de Variables :::::::::::::::::::::::::::::::::::::///
var tablaPreciosProveedor, filaPreciosProveedor, opcionTablaPreciosProveedor, pprecioprov_razonsocial, pp_razonsocial, pp_fecha;
var precioprov_id, precioprov_codproveedor, precioprov_descripcion, precioprov_marca, precioprov_procedencia, precioprov_unidadmedida, precioprov_garantia, precioprov_moneda, precioprov_precio, precioprov_preciosoles, precioprov_fechavigencia, precioprov_razonsocial, precioprov_obslog, precioprov_log, precioprov_tipo;


///::::::::::::::: JS CARGA DE DATA TABLE :::::::::::::://
$(document).ready(function(){
  pp_fecha = f_CalculoFecha("hoy","0");
  $('#pp_fecha').val(pp_fecha);
  
  selectHtml="";
  selectHtml=f_TipoTabla("PRECIOS PROVEEDOR","MARCA");
  $("#precioprov_marca").html(selectHtml);
  selectHtml=f_TipoTabla("PRECIOS PROVEEDOR","PROCEDENCIA");
  $("#precioprov_procedencia").html(selectHtml);
  selectHtml=f_select_unidad_medida();
  $("#precioprov_unidadmedida").html(selectHtml);
  selectHtml=f_TipoTabla("PRECIOS PROVEEDOR","MONEDA");
  $("#precioprov_moneda").html(selectHtml);
  selectHtml=f_TipoTabla("MATERIALES","TIPO");
  $("#precioprov_tipo").html(selectHtml);
  
  Accion = "SelectProveedores";
  $.ajax({
    url: "Ajax.php",
    type: "POST",
    datatype:"json",
    async: false,
    data: {MoS:MoS,NombreMoS:NombreMoS,Accion:Accion},    
    success: function(data){
      $("#precioprov_razonsocial").html(data);
      $("#pp_razonsocial").html(data);
    }
  });

  // Si hay cambios en razon social
  $("#pp_razonsocial").on('change', function () {
    pp_razonsocial = $("#pp_razonsocial").val();
    $('#div_tablaPreciosProveedor').hide();
  });

  // Si hay cambios en precioa la fecha
  $("#pp_fecha").on('change', function () {
    pp_fecha = $("#pp_fecha").val();
    $('#div_tablaPreciosProveedor').hide();
  });
  
  $("#btnBuscarPreciosProveedor").click(function(){
    pp_razonsocial = $("#pp_razonsocial").val();
    pp_fecha = $("#pp_fecha").val();pp_fecha
    if(pp_razonsocial=="" || pp_fecha==""){
      Swal.fire({
        icon: 'error',
        title: 'Razon Social, Fecha ...',
        text: 'Falta información para la busqueda !!!'
      })    
    }else{
      $("#div_tablaPreciosProveedor").show();
      f_MostrarPreciosProveedor(pp_razonsocial, pp_fecha);
    }
  });

  ///::::::::: EVENTO DEL BOTON NUEVO ::::::::::::::///
  $("#btnNuevoPreciosProveedor").click(function(){
      opcionTablaPreciosProveedor = 1; // Alta 
      f_LimpiaMsTablaPreciosProveedor();
      $("#formModalPreciosProveedor").trigger("reset");
      $(".modal-header").css( "background-color", "#17a2b8");
      $(".modal-header").css( "color", "white" );
      $(".modal-title").text("Alta de Tabla PreciosProveedor");
      $('#modalCRUDPreciosProveedor').modal('show');	    
  });

  /// ::::::::::::::: CREA Y EDITA USUARIO :::::::::::::///
  $('#formModalPreciosProveedor').submit(function(e){                         
      e.preventDefault(); //evita el comportambiento normal del submit, es decir, recarga total de la página
      precioprov_codproveedor   = $.trim($('#precioprov_codproveedor').val());    
      precioprov_descripcion    = $.trim($('#precioprov_descripcion').val());
      precioprov_marca          = $.trim($('#precioprov_marca').val());
      precioprov_procedencia    = $.trim($('#precioprov_procedencia').val());
      precioprov_unidadmedida   = $.trim($('#precioprov_unidadmedida').val());
      precioprov_garantia       = $.trim($('#precioprov_garantia').val());
      precioprov_moneda         = $.trim($('#precioprov_moneda').val());
      precioprov_precio         = $.trim($('#precioprov_precio').val());
      precioprov_preciosoles    = $.trim($('#precioprov_preciosoles').val());
      precioprov_fechavigencia  = $.trim($('#precioprov_fechavigencia').val());
      precioprov_razonsocial    = $.trim($('#precioprov_razonsocial').val());
      precioprov_obslog         = $.trim($('#precioprov_obslog').val());
      precioprov_tipo           = $.trim($('#precioprov_tipo').val());
  
      validacionTablaPreciosProveedor=f_validarTablaPreciosProveedor(precioprov_codproveedor, precioprov_descripcion, precioprov_marca, precioprov_procedencia, precioprov_unidadmedida, precioprov_garantia, precioprov_moneda, precioprov_precio, precioprov_preciosoles, precioprov_fechavigencia, precioprov_razonsocial, precioprov_obslog, precioprov_tipo);

      unidad_medida           = $.trim(precioprov_unidadmedida.substring(0,precioprov_unidadmedida.indexOf('-')));
      precioprov_unidadmedida = f_encontrar_dato('manto_unidad_medida','unidad_medida',unidad_medida,'unidad_medida') 

      /// CREAR
      if(opcionTablaPreciosProveedor == 1) {
          if(validacionTablaPreciosProveedor!="invalido") {   
              $("#btnGuardarPreciosProveedor").prop("disabled",true);
              Accion='CrearPreciosProveedor';
              $.ajax({
                  url: "Ajax.php",
                  type: "POST",
                  datatype:"json",    
                  data:  { MoS:MoS,NombreMoS:NombreMoS,Accion:Accion, precioprov_codproveedor:precioprov_codproveedor, precioprov_descripcion:precioprov_descripcion, precioprov_marca:precioprov_marca, precioprov_procedencia:precioprov_procedencia, precioprov_unidadmedida:precioprov_unidadmedida, precioprov_garantia:precioprov_garantia, precioprov_moneda:precioprov_moneda, precioprov_precio:precioprov_precio, precioprov_preciosoles:precioprov_preciosoles, precioprov_fechavigencia:precioprov_fechavigencia, precioprov_razonsocial:precioprov_razonsocial, precioprov_obslog:precioprov_obslog, precioprov_tipo:precioprov_tipo },    
                  success: function(data) {
                    tablaPreciosProveedor.ajax.reload(null, false);
                  }
              });
              $('#modalCRUDPreciosProveedor').modal('hide');
              $("#btnGuardarPreciosProveedor").prop("disabled",false);
          } 
      }
  });
        
  ///::::::::  BOTON ANULAR REGISTRO  
  $(document).on("click", ".btnAnularPreciosProveedor", function(){
    let fila = $(this);
    let rptaValidaFecha = "";
    let respuestaTablaPreciosProveedor = 0;
    precioprov_id = fila.closest('tr').find('td:eq(0)').text();
    precioprov_fechavigencia = fila.closest('tr').find('td:eq(13)').text();
    rptaValidaFecha = f_CompararFechaActual(precioprov_fechavigencia);

    if(rptaValidaFecha=="MAYOR"){
      Swal.fire(
        'Inconsistecia!',
        'La fecha de vigencia es menor o igual a la fecha actual',
        'success'
      )
    }else{
      Swal.fire({
          title: '¿Está seguro?',
          text: "Se anulará el registro "+precioprov_id+"!",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Si, Anular!'
      }).then((result) => {
          if (result.isConfirmed) {
              Swal.fire(
                  'Anulado!',
                  'El registro se ha sido anulado.',
                  'success'
              )
              respuestaTablaPreciosProveedor = 1;
              Accion='AnularPreciosProveedor';
              if (respuestaTablaPreciosProveedor == 1) {            
                  $.ajax({
                  url: "Ajax.php",
                  type: "POST",
                  datatype:"json",
                  async: false,    
                  data:  { MoS:MoS,NombreMoS:NombreMoS,Accion:Accion,precioprov_id:precioprov_id },   
                      success: function(data) {
                        tablaPreciosProveedor.ajax.reload(null, false);
                      }
                  });
              }
          }
      });
    }
    });

});    

///::::::::::::::::::::::::: BOTONES DE MATERIALES :::::::::::::::::::::///

///::::::::::::::::::::::::::::::::: FUNCIONES DE MATERIALES ::::::::::::::::::::::::::::::::::::///

///::::::::: VALIDAR MATERIALES ::::::::::::::::::::::///       
function f_validarTablaPreciosProveedor(pprecioprov_codproveedor, pprecioprov_descripcion, pprecioprov_marca, pprecioprov_procedencia, pprecioprov_unidadmedida, pprecioprov_garantia,pprecioprov_moneda, pprecioprov_precio, pprecioprov_preciosoles, pprecioprov_fechavigencia, pprecioprov_razonsocial, pprecioprov_obslog, p_precioprov_tipo){
  f_LimpiaMsTablaPreciosProveedor();
  NoLetrasMayuscEspacio=/[^A-Z \Ñ]/;
  var rpta_PreciosProveedor="";    
  
  if(pprecioprov_codproveedor==""){
      $("#precioprov_codproveedor").addClass("color-error");
      rpta_PreciosProveedor="invalido";
  }
  
  if(pprecioprov_descripcion==""){
      $("#precioprov_descripcion").addClass("color-error");
      rpta_PreciosProveedor="invalido";
  }
  
  if(pprecioprov_marca==""){
      $("#precioprov_marca").addClass("color-error");
      rpta_PreciosProveedor="invalido";
  }

  if(pprecioprov_procedencia==""){
    $("#precioprov_procedencia").addClass("color-error");
    rpta_PreciosProveedor="invalido";
  }

  if(pprecioprov_unidadmedida==""){
    $("#precioprov_unidadmedida").addClass("color-error");
    rpta_PreciosProveedor="invalido";
  }

  if(pprecioprov_garantia==""){
    $("#precioprov_garantia").addClass("color-error");
    rpta_PreciosProveedor="invalido";
  }

  if(pprecioprov_moneda==""){
    $("#precioprov_moneda").addClass("color-error");
    rpta_PreciosProveedor="invalido";
  }

  if(pprecioprov_precio==""){
    $("#precioprov_precio").addClass("color-error");
    rpta_PreciosProveedor="invalido";
  }

  if(pprecioprov_preciosoles==""){
    $("#precioprov_preciosoles").addClass("color-error");
    rpta_PreciosProveedor="invalido";
  }

  if(pprecioprov_fechavigencia==""){
    $("#precioprov_fechavigencia").addClass("color-error");
    rpta_PreciosProveedor="invalido";
  }

  if(pprecioprov_razonsocial==""){
    $("#precioprov_razonsocial").addClass("color-error");
    rpta_PreciosProveedor="invalido";
  }

  if(pprecioprov_obslog==""){
    $("#precioprov_obslog").addClass("color-error");
    rpta_PreciosProveedor="invalido";
  }

  if(p_precioprov_tipo==""){
    $("#precioprov_tipo").addClass("color-error");
    rpta_PreciosProveedor="invalido";
  }

  return rpta_PreciosProveedor; 
}

///::::::::: INVISIBILIZA LOS MENSAJE DE ALERTA DEL FORMULARIO :::::: /// 
function f_LimpiaMsTablaPreciosProveedor(){
  $("#precioprov_codproveedor").removeClass("color-error");
  $("#precioprov_descripcion").removeClass("color-error");
  $("#precioprov_marca").removeClass("color-error");
  $("#precioprov_procedencia").removeClass("color-error");
  $("#precioprov_unidadmedida").removeClass("color-error");
  $("#precioprov_garantia").removeClass("color-error");
  $("#precioprov_moneda").removeClass("color-error");
  $("#precioprov_precio").removeClass("color-error");
  $("#precioprov_preciosoles").removeClass("color-error");
  $("#precioprov_fechavigencia").removeClass("color-error");
  $("#precioprov_razonsocial").removeClass("color-error");
  $("#precioprov_obslog").removeClass("color-error");
  $("#precioprov_tipo").removeClass("color-error");
}

///:::::::::::::: MOSTRAR DATATABLE DE PRECIOS POR PROVEEDOR ::::::::::::::::::///
function f_MostrarPreciosProveedor(ppp_razonsocial, ppp_fecha){
  let aTablaBD = "manto_proveedores";
  let aCampoBD = "prov_razonsocial";
  let adata = f_BuscarDataBD(aTablaBD,aCampoBD,ppp_razonsocial);
  $.each(adata, function(idx, obj){ 
    ppp_ruc = obj.prov_ruc;
  });

  div_tabla = f_CreacionTabla("tablaPreciosProveedor","");
  $("#div_tablaPreciosProveedor").html(div_tabla);
  columnastabla = f_ColumnasTabla("tablaPreciosProveedor","");

  $("#tablaPreciosProveedor").dataTable().fnDestroy();
  $('#tablaPreciosProveedor').show();
  // Setup - add a text input to each footer cell
  $('#tablaPreciosProveedor thead tr')
      .clone(true)
      .addClass('filtersPreciosProveedor')
      .appendTo('#tablaPreciosProveedor thead');
  
  Accion='LeerPreciosProveedor';
  tablaPreciosProveedor = $('#tablaPreciosProveedor').DataTable({
    //Filtros por columnas
    orderCellsTop: true,
    fixedHeader: true,
    initComplete: function (){
      var api = this.api();
      // For each column
      api.columns().eq(0).each(function (colIdx) {
          // Set the header cell to contain the input element
          var cell = $('.filtersPreciosProveedor th').eq($(api.column(colIdx).header()).index());
          var title = $(cell).text();
          $(cell).html('<input type="text" placeholder="' + title + '" />');
          // On every keypress in this input
          $('input',$('.filtersPreciosProveedor th').eq($(api.column(colIdx).header()).index()) ).off('keyup change').on('keyup change', function (e) {
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
    deferRender:    true,
    scrollY:        800,
    scrollCollapse: true,
    scroller:       true,
    scrollX:        true,
    fixedColumns:{
      left: 1
    },
    fixedHeader:{
      header : false
    },
    //Para mostrar 50 registros popr página 
    pageLength: 50,
    //Para cambiar el lenguaje a español
    language: idioma_espanol, 
    //Para usar los botones
    responsive: "true",
    dom: 'Blfrtip', // Con Botones Excel,Pdf,Print
    buttons:[{
      extend:     'excelHtml5',
      text:       '<i class="fas fa-file-excel"></i> ',
      titleAttr:  'Exportar a Excel',
      className:  'btn btn-success',
      title: 'PRECIOS X PROVEEDOR',
      exportOptions: {
        columns: [ 1,2,3,4,5,6,7,8,9,10,11,12,14,15 ]
      }
    }],
          
    "ajax":{            
      "url": "Ajax.php", 
      "method": 'POST', //usamos el metodo POST
      "data": {MoS:MoS,NombreMoS:NombreMoS,Accion:Accion,asignarcod_ruc:ppp_ruc, asignarcod_fecha:ppp_fecha}, //enviamos opcion 4 para que haga un SELECT
      "dataSrc":""
    },
    "columns": columnastabla,
    "order": [[0, 'desc']]
  });     
}