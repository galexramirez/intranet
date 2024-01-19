///::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
///:: PRECIOS MATERIAL v 1.0 FECHA: 2023-06-21 ::::::::::::::::::::::::::::::::::::::::::::///
///:: REPORTE DE PRECIOS POR PROVEEDOR Y POR MATERIAL :::::::::::::::::::::::::::::::::::::///
///::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///

///:: DECLARACION DE VARIABLES ::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
var tabla_precios_material, fila_precios_material, opcion_tabla_precios_material, pm_cod_proveedor, pm_razon_social, pm_fecha;


///:: JS DOM DE REPORTE DE PRECIOS POR PROVEEDOR Y POR MATERIAL :::::::::::::::::::::::::::///
$(document).ready(function(){
  pm_fecha = f_CalculoFecha("hoy","0");
  $('#pm_fecha').val(pm_fecha);
  
  let select_precios = f_select_combo("manto_proveedores","NO", "prov_razonsocial", "", "`prov_estado`='ACTIVO'", "`prov_razonsocial` ASC");
  $("#pm_razon_social").html(select_precios);

  ///:: Si hay cambios en razon social Y PRECIOS A LA FECHA :::::::::::::::::::::::::::::::///
  $("#pm_razon_social, #pm_fecha").on('change', function () {
    f_cargar_auto_completar();
    $('#div_tabla_precios_material').hide();
  });

  $("#pm_cod_proveedor").on('change', function () {
    pm_cod_proveedor = $("#pm_cod_proveedor").val();
    $('#div_tabla_precios_material').hide();
  });

  ///:: BOTON BUSCAR PRECIOS POR PROVEEDOR Y POR MATERIAL :::::::::::::::::::::::::::::::::///
  $("#btn_buscar_precios_material").click(function(){
    pm_razon_social   = $("#pm_razon_social").val();
    pm_fecha          = $("#pm_fecha").val();
    pm_cod_proveedor  = $("#pm_cod_proveedor").val();
    if(pm_razon_social=="" || pm_fecha=="" || pm_cod_proveedor==""){
      Swal.fire({
        icon: 'error',
        title: 'Razon Social, Código Material, Fecha ...',
        text: 'Falta información para la busqueda !!!'
      })    
    }else{
      $("#div_tabla_precios_material").show();
      f_mostrar_precios_material(pm_razon_social, pm_fecha, pm_cod_proveedor);
    }
  });
  ///:: FIN BOTON BUSCAR PRECIOS POR PROVEEDOR Y POR MATERIAL :::::::::::::::::::::::::::::///

});    

///:: JS DOM DE REPORTE DE PRECIOS POR PROVEEDOR Y POR MATERIAL :::::::::::::::::::::::::::///

///:: FUNCIONES DE PRECIOS MATERIALES :::::::::::::::::::::::::::::::::::::::::::::::::::::///

///:: MOSTRAR DATATABLE DE PRECIOS POR PROVEEDOR ::::::::::::::::::::::::::::::::::::::::::///
function f_mostrar_precios_material(p_pm_razon_social, p_pm_fecha, p_pm_cod_proveedor){
  let aTablaBD = "manto_proveedores";
  let aCampoBD = "prov_razonsocial";
  let adata = f_BuscarDataBD(aTablaBD,aCampoBD,p_pm_razon_social);
  $.each(adata, function(idx, obj){ 
    p_pm_ruc = obj.prov_ruc;
  });

  div_tabla = f_CreacionTabla("tabla_precios_material","");
  $("#div_tabla_precios_material").html(div_tabla);
  columnas_tabla = f_ColumnasTabla("tabla_precios_material","");

  $("#tabla_precios_material").dataTable().fnDestroy();
  $('#tabla_precios_material').show();
  // Setup - add a text input to each footer cell
  $('#tabla_precios_material thead tr')
      .clone(true)
      .addClass('filters_precios_material')
      .appendTo('#tabla_precios_material thead');
  
  Accion='leer_precios_material';
  tabla_precios_material = $('#tabla_precios_material').DataTable({
    //Filtros por columnas
    orderCellsTop: true,
    fixedHeader: true,
    initComplete: function (){
      var api = this.api();
      // For each column
      api.columns().eq(0).each(function (colIdx) {
          // Set the header cell to contain the input element
          var cell = $('.filters_precios_material th').eq($(api.column(colIdx).header()).index());
          var title = $(cell).text();
          $(cell).html('<input type="text" placeholder="' + title + '" />');
          // On every keypress in this input
          $('input',$('.filters_precios_material th').eq($(api.column(colIdx).header()).index()) ).off('keyup change').on('keyup change', function (e) {
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
    fixedColumns    : {
      left: 1
    },
    fixedHeader     : {
      header : false
    },
    pageLength      : 50,
    language        : idioma_espanol, 
    responsive      : "true",
    dom             : 'Blfrtip',
    buttons         : [{
      extend        : 'excelHtml5',
      text          : '<i class="fas fa-file-excel"></i> ',
      titleAttr     : 'Exportar a Excel',
      className     : 'btn btn-success',
      title         : 'PRECIOS POR PROVEEDOR Y POR MATERIAL Y/O SERVICIO',
      exportOptions : {
        columns     : [ 1,2,3,4,5,6,7,8,9,10,11,12,14,15 ]
      }
    }],
    "ajax"          : {            
      "url"     : "Ajax.php", 
      "method"  : 'POST',
      "data"    : {MoS:MoS, NombreMoS:NombreMoS, Accion:Accion, asignarcod_ruc:p_pm_ruc, asignarcod_fecha:p_pm_fecha, asignarcod_proveedor:p_pm_cod_proveedor},
      "dataSrc" : ""
    },
    "columns": columnas_tabla,
    "order": [[11, 'desc']]
  });     
}
///:: FIN MOSTRAR DATATABLE DE PRECIOS POR PROVEEDOR ::::::::::::::::::::::::::::::::::::::///

///:: FUNCION PARA CARGAR AUTOCOMPLETAR :::::::::::::::::::::::::::::::::::::::::::::::::::///
function f_cargar_auto_completar(){
  $('#div_tabla_precios_material').hide();
  pm_razon_social = $("#pm_razon_social").val();
  pm_fecha        = $("#pm_fecha").val();
  pm_ruc          = "";
  pm_cod_proveedor= "";
  let a_data = f_BuscarDataBD("manto_proveedores", "prov_razonsocial", pm_razon_social);
  $.each(a_data, function(idx, obj){ 
    pm_ruc = obj.prov_ruc;
  });
  
  $( function() {
    t_autocompletar = f_auto_completar("manto_preciosproveedor", "precioprov_codproveedor", "precioprov_descripcion", "precioprov_ruc", pm_ruc, "precioprov_fechavigencia", pm_fecha, "precioprov_tipo", "MATERIAL" );
    $( "#pm_cod_proveedor" ).autocomplete({
      minLength : 3,
      source: t_autocompletar,
      html: true,
      _renderMenu: function( ul, items ) {
        var that = this;
        $.each( items, function( index, item ) {
          that._renderItemData( ul, item );
        });
        $( ul ).find( "li" ).odd().addClass( "odd" );
      }
    });
  });

  $("#pm_cod_proveedor").val(pm_cod_proveedor);
}
///:: FIN FUNCION PARA CARGAR AUTOCOMPLETAR :::::::::::::::::::::::::::::::::::::::::::::::///

///:: TERMINO FUNCIONES DE PRECIOS MATERIALES :::::::::::::::::::::::::::::::::::::::::::::///