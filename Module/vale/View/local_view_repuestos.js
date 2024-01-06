///::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
///:: PROCESAR REPUESTOS VALES v 2.0 FECHA: 07-03-2023 ::::::::::::::::::::::::::::::::::::///
//::: EDITAR TABLA DE REPUESTOS VALES :::::::::::::::::::::::::::::::::::::::::::::::::::::///
///::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///

///:: DECLARACION DE VARIABLES ::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
var tabla_repuestos, btn_borrar_repuesto, fila_repuestos, t_autocompletar, array_vale_repuestos;
var vr_repuesto, vr_descripcion, vr_nroserie, vr_cantidad, vr_unidad;
///:: TERMINO DECLARACION DE VARIABLES ::::::::::::::::::::::::::::::::::::::::::::::::::::///

///:: JS DOM VALES REPUESTOS ::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
$(document).ready(function(){
  $("#vr_descripcion").on('change', function(){
    $("#vr_id").focus().select();
  });

  $("#vr_cantidad_real").on('change', function(){
    vr_cantidad_real = $("#vr_cantidad_real").val();
    mv_patrimonial = $("#mv_patrimonial").val();
    vr_cod_patrimonial_recepcion = "";
    if(parseInt(vr_cantidad_real)===1 && mv_patrimonial==="SI"){
      $("#vr_cod_patrimonial_recepcion").prop("disabled",false);
      $("#vr_cod_patrimonial_recepcion").val(va_cod_patrimonial_recepcion);
    }else{
      $("#vr_cod_patrimonial_recepcion").prop("disabled",true);
      $("#vr_cod_patrimonial_recepcion").val(va_cod_patrimonial_recepcion);
    }
  })
  
  ///:: INICIO BOTONES DE VALES REPUESTOS :::::::::::::::::::::::::::::::::::::::::::::::::///

  ///:: CAMBIOS EN CODIGO MATERIAL SE ACTUALIZA DESCRIPCION DE MATERIAL :::::::::::::::::::///
  $(document).on("click", ".btn_buscar_repuesto", function(){
    $("#vr_repuesto").prop("disabled",true);
    $("#vr_descripcion").prop("disabled",true);
    $("#vr_cantidad").prop("disabled",false);
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
    vr_descripcion    = "";
    vr_unidad         = "";
    vr_nroserie       = "";
    vr_cantidad       = "";
    vr_cantidad_real  = "";
    vr_repuesto       = $("#buscar_repuesto").val();
    vr_cod_patrimonial_despacho = "";
    vr_cod_patrimonial_recepcion = "";

    Accion = 'BuscarCodigoRepuesto';
    $.ajax({
      url       : "Ajax.php",
      type      : "POST",
      datatype  : "json",
      async     : false,
      data      : { MoS:MoS, NombreMoS:NombreMoS, Accion:Accion, vr_repuesto:vr_repuesto, va_asociado:va_asociado, va_date_genera:va_date_genera, va_tipo:va_tipo },
      success: function(data){
        data = $.parseJSON(data);
        $.each(data, function(idx, obj){ 
          vr_descripcion    = obj.precioprov_descripcion;
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
          vr_unidad         = obj.um_descripcion;
        });
      }
    });
    $("#vr_repuesto").val(vr_repuesto);
    $("#vr_descripcion").val(vr_descripcion);
    $("#vr_unidad").val(vr_unidad);
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
    $("#vr_cantidad_real").val(vr_cantidad_real);
    $("#vr_cod_patrimonial_despacho").val(vr_cod_patrimonial_despacho);
    $("#vr_cod_patrimonial_recepcion").val(vr_cod_patrimonial_recepcion);

    if(mv_patrimonial==="SI"){
      $("#vr_cod_patrimonial_despacho").prop("disabled",false);
      vr_cantidad = "1.00";
      $("#vr_cantidad").prop("disabled",true);
    }else{
      $("#vr_cod_patrimonial_despacho").prop("disabled",true);
      $("#vr_cod_patrimonial_recepcion").prop("disabled",true);
    }
    $("#vr_cantidad").val(vr_cantidad);
    $("#buscar_repuesto").val("");
    $("#vr_id").focus().select();
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
    vr_descripcion    = "";
    vr_unidad         = "";
    vr_nroserie       = "";
    vr_cantidad       = "";
    vr_repuesto       = $("#buscar_repuesto").val();

    $("#vr_repuesto").val(vr_repuesto);
    $("#vr_descripcion").val(vr_descripcion);
    $("#vr_unidad").val(vr_unidad);
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

    $("#vr_repuesto").prop("disabled",false);
    $("#vr_descripcion").prop("disabled",false);
    $("#buscar_repuesto").val("");
    $("#vr_repuesto").focus().select();
  });
  ///:: FIN CAMBIOS EN CODIGO MATERIAL SE ACTUALIZA DESCRIPCION DE MATERIAL :::::::::::::::///

  ///:: EVENTO DEL BOTON AGREGAR REPUESTO :::::::::::::::::::::::::::::::::::::::::::::::::///
  $(document).on("click", ".btn_repuestos_vale", function(){
    va_asociado     = $("#va_asociado").val();
    va_date_genera  = $("#va_date_genera").val();
    va_tipo = "MATERIAL";
    if(va_asociado!="" && va_date_genera!=""){
      $("#vr_repuesto").prop("disabled",true);
      $("#vr_descripcion").prop("disabled",true);
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
  
      vr_id             = f_max_id(tabla_repuestos.rows().data().toArray());
      vr_repuesto       = "";
      vr_descripcion    = "";
      vr_nroserie       = "";
      vr_cantidad       = "";
      vr_unidad         = "";
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
      
      $("#vr_id").val(vr_id);
      $("#vr_repuesto").val(vr_repuesto);
      $("#vr_descripcion").val(vr_descripcion);
      $("#vr_nroserie").val(vr_nroserie);
      $("#vr_cantidad").val(vr_cantidad);
      $("#vr_unidad").val(vr_unidad);
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
    
      $("#vr_cantidad").prop("disabled",false);
      $("#vr_cod_patrimonial_despacho").prop("disabled",true);
      $("#vr_cod_patrimonial_recepcion").prop("disabled",true);
      
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
    vr_id           = $("#vr_id").val();
    vr_repuesto     = $("#vr_repuesto").val();
    vr_nroserie     = $("#vr_nroserie").val();
    vr_descripcion  = $("#vr_descripcion").val();
    vr_cantidad     = $("#vr_cantidad").val();
    vr_unidad       = $("#vr_unidad").val();
    mv_tipo         = $("#mv_tipo").val();
    t_ValidaDetalleRepuestos = f_ValidarDetalleRepuestos(vr_id, vr_repuesto, vr_nroserie, vr_descripcion, vr_cantidad, mv_tipo)
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
      tabla_repuestos.row.add( {
        "vr_id"         : vr_id,
        "vr_repuesto"   : vr_repuesto,
        "vr_nroserie"   : vr_nroserie,
        "vr_descripcion": vr_descripcion,
        "vr_cantidad"   : vr_cantidad,
        "vr_unidad"     : vr_unidad,
        "vr_tipo"       : mv_tipo,
      } ).draw();
      
      $("#btn_guardar_detalle_repuestos").prop("disabled",false);
      f_LimpiaDetalleRepuestos();

      vr_id             = f_max_id(tabla_repuestos.rows().data().toArray());
      vr_repuesto       = "";
      vr_descripcion    = "";
      vr_cantidad       = "";
      vr_nroserie       = "";
      vr_unidad         = "";
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
      
      $("#vr_id").val(vr_id);
      $("#vr_repuesto").val(vr_repuesto);
      $("#vr_descripcion").val(vr_descripcion);
      $("#vr_cantidad").val(vr_cantidad);
      $("#vr_nroserie").val(vr_nroserie);
      $("#vr_unidad").val(vr_unidad);
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

      $("#vr_repuesto").prop("disabled",true);
      $("#vr_descripcion").prop("disabled",true);
      $("#buscar_repuesto").focus().select();      
    }
  });
  //:: FIN BOTON GRABAR -> REALIZA LA GRABACION EN LA TABLA manto_rep_vale ::::::::::::::::///

  ///:: BOTON BORRAR DETALLE REPUESTOS ::::::::::::::::::::::::::::::::::::::::::::::::::::///
  $(document).on("click", ".btnBorrarDetalleRepuestos", function(){
    fila_repuestos = $(this); 
    vr_id = fila_repuestos.closest('tr').find('td:eq(0)').text();
    Swal.fire({
      title: '¿Está seguro?',
      text: "Se eliminará el registro "+vr_id+" !!!",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Si, eliminar!'
    }).then((result) => 
    {
      if (result.isConfirmed){
        tabla_repuestos
        .row( fila_repuestos.parents('tr') )
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
function f_ValidarDetalleRepuestos(pvr_id, pvr_repuesto, pvr_nroserie, pvr_descripcion, pvr_cantidad, pmv_tipo){
  NoLetrasMayuscEspacio=/[^A-Z \Ñ]/;
  let rpta_DetalleRepuestos="";
  
  if(pvr_id==""){
    $("#vr_id").addClass("color-error");
    rpta_DetalleRepuestos="invalido";
  }
  if(pvr_repuesto==""){
    $("#vr_repuesto").addClass("color-error");
    rpta_DetalleRepuestos="invalido";
  }
  if(pvr_descripcion==""){
    $("#vr_descripcion").addClass("color-error");
    rpta_DetalleRepuestos="invalido";
  }
  if(pvr_cantidad==""){
    $("#vr_cantidad").addClass("color-error");
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
  $("#vr_id").removeClass("color-error");
  $("#vr_repuesto").removeClass("color-error");
  $("#vr_descripcion").removeClass("color-error");
  $("#vr_cantidad").removeClass("color-error");
  $("#mv_tipo").removeClass("color-error");
}
///:: FIN ELIMINA EL COLOR DE ERROR EN LOS CAMPOS :::::::::::::::::::::::::::::::::::::::::///

///:: GENERACION DE TABLA DE DETALLE DE REPUESTOS :::::::::::::::::::::::::::::::::::::::::///
function f_tabla_repuestos(p_vale_id, p_btn_borrar_repuesto){
  array_vale_repuestos = [];
  div_tabla = f_CreacionTabla("tabla_repuestos",p_btn_borrar_repuesto);
  $("#div_tabla_repuestos").html(div_tabla);
  columnas_tabla = f_ColumnasTabla("tabla_repuestos",p_btn_borrar_repuesto);

  $("#tabla_repuestos").dataTable().fnDestroy();
  $('#tabla_repuestos').show();

  Accion='cargar_repuestos';
  $.ajax({
    url       : "Ajax.php",
    type      : "POST",
    datatype  : "json",    
    async     : false,
    data      :  { MoS:MoS,NombreMoS:NombreMoS,Accion:Accion, vale_id:p_vale_id },    
    success: function(data) {
      array_vale_repuestos = $.parseJSON(data);
    }
  });
    
  tabla_repuestos = $('#tabla_repuestos').DataTable({
    language      : idioma_espanol,
    searching     : false,
    info          : false,
    lengthChange  : true,
    pageLength    : 10,
    responsive    : "true",
    data          : array_vale_repuestos,
    columns       : columnas_tabla
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
      if(parseInt(obj.vr_id) > max_id){
        max_id = parseInt(obj.vr_id);
      }
    });
    max_id = max_id + 1;
    rpta_max_id = max_id.toString();
  }
  return rpta_max_id;
}
///:: FIN FUNCION DE MAXIMO ID DE REPUESTOS :::::::::::::::::::::::::::::::::::::::::::::::///


///:: TERMINO FUNCIONES DE VALES ::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///