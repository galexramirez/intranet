///::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
///:: PROCESAR REPUESTOS VALES v 2.0 FECHA: 07-03-2023 ::::::::::::::::::::::::::::::::::::///
//::: EDITAR TABLA DE REPUESTOS VALES :::::::::::::::::::::::::::::::::::::::::::::::::::::///
///::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///

///:: DECLARACION DE VARIABLES ::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
var tablaDetalleRepuestos, btn_BorrarRepuesto, fila_DetalleRepuestos, t_autocompletar, array_vale_repuestos;
var rv_repuesto, rv_descripcion, rv_nroserie, rv_cantidad, rv_unidad;
///:: TERMINO DECLARACION DE VARIABLES ::::::::::::::::::::::::::::::::::::::::::::::::::::///

///:: JS DOM VALES REPUESTOS ::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
$(document).ready(function(){
  $("#rv_descripcion").on('change', function(){
    $("#rv_id").focus().select();
  });

  $("#rv_cantidad_real").on('change', function(){
    rv_cantidad_real = $("#rv_cantidad_real").val();
    mv_patrimonial = $("#mv_patrimonial").val();
    rv_cod_patrimonial_recepcion = "";
    if(parseInt(rv_cantidad_real)===1 && mv_patrimonial==="SI"){
      $("#rv_cod_patrimonial_recepcion").prop("disabled",false);
      $("#rv_cod_patrimonial_recepcion").val(va_cod_patrimonial_recepcion);
    }else{
      $("#rv_cod_patrimonial_recepcion").prop("disabled",true);
      $("#rv_cod_patrimonial_recepcion").val(va_cod_patrimonial_recepcion);
    }
  })
  
  ///:: INICIO BOTONES DE VALES REPUESTOS :::::::::::::::::::::::::::::::::::::::::::::::::///

  ///:: CAMBIOS EN CODIGO MATERIAL SE ACTUALIZA DESCRIPCION DE MATERIAL :::::::::::::::::::///
  $(document).on("click", ".btn_buscar_repuesto", function(){
    $("#rv_repuesto").prop("disabled",true);
    $("#rv_descripcion").prop("disabled",true);
    $("#rv_cantidad").prop("disabled",false);
    f_LimpiaDetalleRepuestos();
    mv_asignacion     = "";
    mv_macrosistema   = "";
    mv_sistema        = "";
    mv_tarjeta        = "";
    mv_condicion      = "";
    mv_flota          = "";
    mv_patrimonial    = "";
    mv_categoria      = "";
    mv_tipo           = "";
    mv_moneda         = "";
    mv_preciosoles    = "";
    rv_descripcion    = "";
    rv_unidad         = "";
    rv_nroserie       = "";
    rv_cantidad       = "";
    rv_cantidad_real  = "";
    rv_repuesto       = $("#buscar_repuesto").val();
    rv_cod_patrimonial_despacho = "";
    rv_cod_patrimonial_recepcion = "";

    Accion = 'BuscarCodigoRepuesto';
    $.ajax({
      url       : "Ajax.php",
      type      : "POST",
      datatype  : "json",
      async     : false,
      data      : { MoS:MoS, NombreMoS:NombreMoS, Accion:Accion, rv_repuesto:rv_repuesto, va_asociado:va_asociado, va_date_genera:va_date_genera, va_tipo:va_tipo },
      success: function(data){
        data = $.parseJSON(data);
        $.each(data, function(idx, obj){ 
          rv_descripcion    = obj.precioprov_descripcion;
          mv_asignacion     = "LB";
          mv_macrosistema   = obj.material_macrosistema;
          mv_sistema        = obj.material_sistema;
          mv_tarjeta        = obj.material_tarjeta;
          mv_condicion      = obj.material_condicion;
          mv_flota          = obj.material_flota;
          mv_patrimonial    = obj.material_patrimonial;
          mv_categoria      = obj.material_categoria;
          mv_tipo           = obj.precioprov_tipo;
          mv_moneda         = obj.precioprov_moneda;
          mv_preciosoles    = obj.precioprov_preciosoles;
          rv_unidad         = obj.um_descripcion;
        });
      }
    });
    $("#rv_repuesto").val(rv_repuesto);
    $("#rv_descripcion").val(rv_descripcion);
    $("#rv_unidad").val(rv_unidad);
    $("#mv_asignacion").val(mv_asignacion);
    $("#mv_macrosistema").val(mv_macrosistema);
    $("#mv_sistema").val(mv_sistema);
    $("#mv_tarjeta").val(mv_tarjeta);
    $("#mv_condicion").val(mv_condicion);
    $("#mv_flota").val(mv_flota);
    $("#mv_patrimonial").val(mv_patrimonial);
    $("#mv_categoria").val(mv_categoria);
    $("#mv_tipo").val(mv_tipo);
    $("#mv_moneda").val(mv_moneda);
    $("#mv_preciosoles").val(mv_preciosoles);
    $("#rv_cantidad_real").val(rv_cantidad_real);
    $("#rv_cod_patrimonial_despacho").val(rv_cod_patrimonial_despacho);
    $("#rv_cod_patrimonial_recepcion").val(rv_cod_patrimonial_recepcion);

    if(mv_patrimonial==="SI"){
      $("#rv_cod_patrimonial_despacho").prop("disabled",false);
      rv_cantidad = "1.00";
      $("#rv_cantidad").prop("disabled",true);
    }else{
      $("#rv_cod_patrimonial_despacho").prop("disabled",true);
      $("#rv_cod_patrimonial_recepcion").prop("disabled",true);
    }
    $("#rv_cantidad").val(rv_cantidad);
    $("#buscar_repuesto").val("");
    $("#rv_id").focus().select();
  });
  ///:: FIN CAMBIOS EN CODIGO MATERIAL SE ACTUALIZA DESCRIPCION DE MATERIAL :::::::::::::::///

  ///:: CREAR UN NUEVO CODIGO DE MATERIAL ::::::::::::::::::::::::::::::::::::::::::::::::///
  $(document).on("click", ".btn_nuevo_repuesto", function(){
    f_LimpiaDetalleRepuestos();
    mv_asignacion     = "";
    mv_macrosistema   = "";
    mv_sistema        = "";
    mv_tarjeta        = "";
    mv_condicion      = "";
    mv_flota          = "";
    mv_patrimonial    = "";
    mv_categoria      = "";
    mv_tipo           = "MATERIAL";
    mv_moneda         = "";
    mv_preciosoles    = "";
    rv_descripcion    = "";
    rv_unidad         = "";
    rv_nroserie       = "";
    rv_cantidad       = "";
    rv_repuesto       = $("#buscar_repuesto").val();

    $("#rv_repuesto").val(rv_repuesto);
    $("#rv_descripcion").val(rv_descripcion);
    $("#rv_unidad").val(rv_unidad);
    $("#mv_asignacion").val(mv_asignacion);
    $("#mv_macrosistema").val(mv_macrosistema);
    $("#mv_sistema").val(mv_sistema);
    $("#mv_tarjeta").val(mv_tarjeta);
    $("#mv_condicion").val(mv_condicion);
    $("#mv_flota").val(mv_flota);
    $("#mv_patrimonial").val(mv_patrimonial);
    $("#mv_categoria").val(mv_categoria);
    $("#mv_tipo").val(mv_tipo);
    $("#mv_moneda").val(mv_moneda);
    $("#mv_preciosoles").val(mv_preciosoles);

    $("#rv_repuesto").prop("disabled",false);
    $("#rv_descripcion").prop("disabled",false);
    $("#buscar_repuesto").val("");
    $("#rv_repuesto").focus().select();
  });
  ///:: FIN CAMBIOS EN CODIGO MATERIAL SE ACTUALIZA DESCRIPCION DE MATERIAL :::::::::::::::///

  ///:: EVENTO DEL BOTON AGREGAR REPUESTO :::::::::::::::::::::::::::::::::::::::::::::::::///
  $(document).on("click", ".btn_repuestos_vale", function(){
    va_asociado     = $("#va_asociado").val();
    va_date_genera  = $("#va_date_genera").val();
    va_tipo = "MATERIAL";
    if(va_asociado!="" && va_date_genera!=""){
      $("#rv_repuesto").prop("disabled",true);
      $("#rv_descripcion").prop("disabled",true);
      ///:: CARGAR LOS DATOS PARA AUTOCOMPLETAR :::::::::::::::::::::::::::::::::::::::::::::::///
      $( function() {
        t_autocompletar = f_AutoCompletar("manto_preciosproveedor", "precioprov_codproveedor", va_asociado, va_date_genera, va_tipo);
        $( "#buscar_repuesto" ).autocomplete({
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
      } );

      $("#form_modal_detalle_repuestos").trigger("reset");
      f_LimpiaDetalleRepuestos();
  
      rv_id             = f_max_id(tablaDetalleRepuestos.rows().data().toArray());
      rv_repuesto       = "";
      rv_descripcion    = "";
      rv_nroserie       = "";
      rv_cantidad       = "";
      rv_unidad         = "";
      mv_asignacion     = "";
      mv_macrosistema   = "";
      mv_sistema        = "";
      mv_tarjeta        = "";
      mv_condicion      = "";
      mv_flota          = "";
      mv_patrimonial    = "";
      mv_categoria      = "";
      mv_tipo           = "";
      mv_moneda         = "";
      mv_preciosoles    = "";
      
      $("#rv_id").val(rv_id);
      $("#rv_repuesto").val(rv_repuesto);
      $("#rv_descripcion").val(rv_descripcion);
      $("#rv_nroserie").val(rv_nroserie);
      $("#rv_cantidad").val(rv_cantidad);
      $("#rv_unidad").val(rv_unidad);
      $("#mv_asignacion").val(mv_asignacion);
      $("#mv_macrosistema").val(mv_macrosistema);
      $("#mv_sistema").val(mv_sistema);
      $("#mv_tarjeta").val(mv_tarjeta);
      $("#mv_condicion").val(mv_condicion);
      $("#mv_flota").val(mv_flota);
      $("#mv_patrimonial").val(mv_patrimonial);
      $("#mv_categoria").val(mv_categoria);
      $("#mv_tipo").val(mv_tipo);
      $("#mv_moneda").val(mv_moneda);
      $("#mv_preciosoles").val(mv_preciosoles);
    
      $("#rv_cantidad").prop("disabled",false);
      $("#rv_cod_patrimonial_despacho").prop("disabled",true);
      $("#rv_cod_patrimonial_recepcion").prop("disabled",true);
      
      $(".modal-header").css( "background-color", "#17a2b8");
      $(".modal-header").css( "color", "white" );
      $(".modal-title").text("Alta de Repuestos");
      $('#modal_crud_detalle_repuestos').modal('show');
      $("#modal_crud_detalle_repuestos").draggable({});
      $("#buscar_repuesto").focus().select();  
    }else{
      Swal.fire({
        position          : 'center',
        icon              : 'error',
        title             : '*Falta Completar Información !!!',
        showConfirmButton : false,
        timer             : 1500
      })
    }
  });
  ///:: FIN EVENTO DEL BOTON AGREGAR REPUESTO :::::::::::::::::::::::::::::::::::::::::::::///

  //:: BOTON GRABAR -> REALIZA LA GRABACION EN LA TABLA manto_rep_vale ::::::::::::::::::::///
  $('#form_modal_detalle_repuestos').submit(function(e){
    e.preventDefault();
    let t_ValidaDetalleRepuestos = "";
    rv_id           = $("#rv_id").val();
    rv_repuesto     = $("#rv_repuesto").val();
    rv_nroserie     = $("#rv_nroserie").val();
    rv_descripcion  = $("#rv_descripcion").val();
    rv_cantidad     = $("#rv_cantidad").val();
    rv_unidad       = $("#rv_unidad").val();
    mv_tipo         = $("#mv_tipo").val();
    t_ValidaDetalleRepuestos = f_ValidarDetalleRepuestos(rv_id, rv_repuesto, rv_nroserie, rv_descripcion, rv_cantidad, mv_tipo)
    if (t_ValidaDetalleRepuestos=="invalido"){
      Swal.fire({
        position          : 'center',
        icon              : 'error',
        title             : '*Falta Completar Información !!!',
        showConfirmButton : false,
        timer             : 1500
      })
    }else{  
      $("#btn_guardar_detalle_repuestos").prop("disabled",true);
      tablaDetalleRepuestos.row.add( {
        "rv_id"         : rv_id,
        "rv_repuesto"   : rv_repuesto,
        "rv_nroserie"   : rv_nroserie,
        "rv_descripcion": rv_descripcion,
        "rv_cantidad"   : rv_cantidad,
        "rv_unidad"     : rv_unidad,
        "rv_tipo"       : mv_tipo,
      } ).draw();
      
      $("#btn_guardar_detalle_repuestos").prop("disabled",false);
      f_LimpiaDetalleRepuestos();

      rv_id             = f_max_id(tablaDetalleRepuestos.rows().data().toArray());
      rv_repuesto       = "";
      rv_descripcion    = "";
      rv_cantidad       = "";
      rv_nroserie       = "";
      rv_unidad         = "";
      mv_asignacion     = "";
      mv_macrosistema   = "";
      mv_sistema        = "";
      mv_tarjeta        = "";
      mv_condicion      = "";
      mv_flota          = "";
      mv_patrimonial    = "";
      mv_categoria      = "";
      mv_tipo           = "";
      mv_moneda         = "";
      mv_preciosoles    = "";
      
      $("#rv_id").val(rv_id);
      $("#rv_repuesto").val(rv_repuesto);
      $("#rv_descripcion").val(rv_descripcion);
      $("#rv_cantidad").val(rv_cantidad);
      $("#rv_nroserie").val(rv_nroserie);
      $("#rv_unidad").val(rv_unidad);
      $("#mv_asignacion").val(mv_asignacion);
      $("#mv_macrosistema").val(mv_macrosistema);
      $("#mv_sistema").val(mv_sistema);
      $("#mv_tarjeta").val(mv_tarjeta);
      $("#mv_condicion").val(mv_condicion);
      $("#mv_flota").val(mv_flota);
      $("#mv_patrimonial").val(mv_patrimonial);
      $("#mv_categoria").val(mv_categoria);
      $("#mv_tipo").val(mv_tipo);
      $("#mv_moneda").val(mv_moneda);
      $("#mv_preciosoles").val(mv_preciosoles);

      $("#rv_repuesto").prop("disabled",true);
      $("#rv_descripcion").prop("disabled",true);
      $("#buscar_repuesto").focus().select();      
    }
  });
  //:: FIN BOTON GRABAR -> REALIZA LA GRABACION EN LA TABLA manto_rep_vale ::::::::::::::::///

  ///:: BOTON BORRAR DETALLE REPUESTOS ::::::::::::::::::::::::::::::::::::::::::::::::::::///
  $(document).on("click", ".btnBorrarDetalleRepuestos", function(){
    fila_DetalleRepuestos = $(this); 
    rv_id = fila_DetalleRepuestos.closest('tr').find('td:eq(0)').text();
    Swal.fire({
      title: '¿Está seguro?',
      text: "Se eliminará el registro "+rv_id+" !!!",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Si, eliminar!'
    }).then((result) => 
    {
      if (result.isConfirmed){
        tablaDetalleRepuestos
        .row( fila_DetalleRepuestos.parents('tr') )
        .remove()
        .draw();
        Swal.fire(
          'Eliminado!',
          'El registro ha sido elimidado.',
          'success')
      }
    });

  });
  ///:: FIN BOTON BORRAR DETALLE REPUESTOS ::::::::::::::::::::::::::::::::::::::::::::::::///

  ///:: BOTON CANCELAR DETALLE REPUESTOS ::::::::::::::::::::::::::::::::::::::::::::::::::///
  $(document).on("click", ".btn_cancelar_detalle_repuesto", function(){
    $("#va_obs_cgm").focus().select();
  });
  ///:: FIN BOTON CANCELAR DETALLE REPUESTOS ::::::::::::::::::::::::::::::::::::::::::::::///


  ///:: TERMINO DE BOTONES VALES ::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///


});

///:: TERMINO DE DOM VALES REPUESTOS ::::::::::::::::::::::::::::::::::::::::::::::::::::::///

///:: FUNCIONES DE VALES ::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///

///:: VALIDA LOS CAMPOS DE REPUESTOS ::::::::::::::::::::::::::::::::::::::::::::::::::::::///
function f_ValidarDetalleRepuestos(prv_id, prv_repuesto, prv_nroserie, prv_descripcion, prv_cantidad, pmv_tipo){
  NoLetrasMayuscEspacio=/[^A-Z \Ñ]/;
  let rpta_DetalleRepuestos="";
  
  if(prv_id==""){
    $("#rv_id").addClass("color-error");
    rpta_DetalleRepuestos="invalido";
  }
  if(prv_repuesto==""){
    $("#rv_repuesto").addClass("color-error");
    rpta_DetalleRepuestos="invalido";
  }
  if(prv_descripcion==""){
    $("#rv_descripcion").addClass("color-error");
    rpta_DetalleRepuestos="invalido";
  }
  if(prv_cantidad==""){
    $("#rv_cantidad").addClass("color-error");
    rpta_DetalleRepuestos="invalido";
  }
  if(pmv_tipo==""){
    $("#mv_tipo").addClass("color-error");
    rpta_DetalleRepuestos="invalido";
  }

  return rpta_DetalleRepuestos;
}
///:: FIN VALIDA LOS CAMPOS DE REPUESTOS ::::::::::::::::::::::::::::::::::::::::::::::::::///

///:: ELIMINA EL COLOR DE ERROR EN LOS CAMPOS :::::::::::::::::::::::::::::::::::::::::::::/// 
function f_LimpiaDetalleRepuestos(){
  $("#rv_id").removeClass("color-error");
  $("#rv_repuesto").removeClass("color-error");
  $("#rv_descripcion").removeClass("color-error");
  $("#rv_cantidad").removeClass("color-error");
  $("#mv_tipo").removeClass("color-error");
}
///:: FIN ELIMINA EL COLOR DE ERROR EN LOS CAMPOS :::::::::::::::::::::::::::::::::::::::::///

///:: GENERACION DE TABLA DE DETALLE DE REPUESTOS :::::::::::::::::::::::::::::::::::::::::///
function f_TablaDetalleRepuestos(pcod_vale,pbtn_BorrarRepuesto){
  array_vale_repuestos = [];
  div_tabla = f_CreacionTabla("tablaDetalleRepuestos",pbtn_BorrarRepuesto);
  $("#div_tablaDetalleRepuestos").html(div_tabla);
  columnastabla = f_ColumnasTabla("tablaDetalleRepuestos",pbtn_BorrarRepuesto);

  $("#tablaDetalleRepuestos").dataTable().fnDestroy();
  $('#tablaDetalleRepuestos').show();

  Accion='cargar_detalle_repuestos';
  $.ajax({
    url       : "Ajax.php",
    type      : "POST",
    datatype  : "json",    
    async     : false,
    data      :  { MoS:MoS,NombreMoS:NombreMoS,Accion:Accion, cod_vale:pcod_vale },    
    success: function(data) {
      array_vale_repuestos = $.parseJSON(data);
    }
  });
    
  tablaDetalleRepuestos = $('#tablaDetalleRepuestos').DataTable({
    language      : idiomaEspanol,
    searching     : false,
    info          : false,
    lengthChange  : true,
    pageLength    : 10,
    responsive    : "true",
    data          : array_vale_repuestos,
    columns       : columnastabla
  });     
}
///:: FIN GENERACION DE TABLA DE DETALLE DE REPUESTOS :::::::::::::::::::::::::::::::::::::///

///:: FUNCION PARA UTILIZAR EL LABEL DEL AUTOCOMPLETE COMO HTML :::::::::::::::::::::::::::///
(function( $ ) {

  var proto = $.ui.autocomplete.prototype,
    initSource = proto._initSource;
  
  function filter( array, term ) {
    var matcher = new RegExp( $.ui.autocomplete.escapeRegex(term), "i" );
    return $.grep( array, function(value) {
      return matcher.test( $( "<div>" ).html( value.label || value.value || value ).text() );
    });
  }
  
  $.extend( proto, {
    _initSource: function() {
      if ( this.options.html && $.isArray(this.options.source) ) {
        this.source = function( request, response ) {
          response( filter( this.options.source, request.term ) );
        };
      } else {
        initSource.call( this );
      }
    },
  
    _renderItem: function( ul, item) {
      return $( "<li></li>" )
        .data( "item.autocomplete", item )
        .append( $( "<a class='text-decoration-none'></a>" )[ this.options.html ? "html" : "text" ]( item.label ) )
        .appendTo( ul );
    }
  });
  
})( jQuery );
///:: FIN FUNCION PARA UTILIZAR EL LABEL DEL AUTOCOMPLETE COMO HTML :::::::::::::::::::::::///

///:: FUNCION DE MAXIMO ID DE REPUESTOS :::::::::::::::::::::::::::::::::::::::::::::::::::///
function f_max_id(p_array_data){
  let rpta_max_id = "";
  let max_id    = 0;
  if(p_array_data.length==0){
    rpta_max_id = "1";
  }else{
    $.each(p_array_data, function(idx, obj){
      if(parseInt(obj.rv_id) > max_id){
        max_id = parseInt(obj.rv_id);
      }
    });
    max_id = max_id + 1;
    rpta_max_id = max_id.toString();
  }
  return rpta_max_id;
}
///:: FIN FUNCION DE MAXIMO ID DE REPUESTOS :::::::::::::::::::::::::::::::::::::::::::::::///


///:: TERMINO FUNCIONES DE VALES ::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///