///::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
///:: MATERIAL PEDIDO v 2.0 FECHA: 18-02-2023 :::::::::::::::::::::::::::::::::::::::::::::///
//::: EDITAR TABLA DE COTIZACION ::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
///::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///

///:: INICIO DECLARACION VARIABLE :::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
var mp_materialid, mp_descripcion, mp_asignacion, mp_macrosistema, mp_sistema, mp_tarjeta, mp_condicion, mp_flota, mp_patrimonial, mp_categoria, mp_unidadmedida, mp_cantidad, mp_bus, mp_observaciones, mp_tipo;

///:: FIN DECLARACION VARIABLE ::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///


///:: INICIO JS DOM MATERIAL PEDIDO :::::::::::::::::::::::::::::::::::::::::::::::::::::::///
$(document).ready(function(){
  ///::: CARGAMOS LOS BUSES :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
  Accion='buses_pedido';
  $.ajax({
    url       : "Ajax.php",
    type      : "POST",
    datatype  : "json",
    async     : false,
    data      : {MoS:MoS,NombreMoS:NombreMoS,Accion:Accion},    
    success   : function(data){
      $("#mp_bus").html(data);
    }
  });

  ///:: CAMBIOS EN CODIGO MATERIAL SE ACTUALIZA DESCRIPCION DE MATERIAL :::::::::::::::::///
  $(document).on("click", ".btn_buscar_material", function(){
    f_limpia_material_pedido();
    mp_materialid     = "";
    mp_descripcion    = "";
    mp_asignacion     = "";
    mp_macrosistema   = "";
    mp_sistema        = "";
    mp_tarjeta        = "";
    mp_condicion      = "";
    mp_flota          = "";
    mp_patrimonial    = "";
    mp_categoria      = "";
    mp_unidadmedida   = "";
    mp_tipo           = "";
    mp_cantidad       = "";
    mp_bus            = "";
    mp_observaciones  = "";
    mp_materialid = $("#buscar_material").val();
    
    Accion='buscar_material_id';
    $.ajax({
      url: "Ajax.php",
      type: "POST",
      datatype:"json",
      async: false,
      data: {MoS:MoS,NombreMoS:NombreMoS,Accion:Accion,mp_materialid:mp_materialid},    
      success: function(data){
        data = $.parseJSON(data);
        $.each(data, function(idx, obj){ 
          mp_asignacion   = "LB";
          mp_descripcion  = obj.material_descripcion;
          mp_macrosistema = obj.material_macrosistema;
          mp_sistema      = obj.material_sistema;
          mp_tarjeta      = obj.material_tarjeta;
          mp_condicion    = obj.material_condicion;
          mp_flota        = obj.material_flota;
          mp_patrimonial  = obj.material_patrimonial;
          mp_categoria    = obj.material_categoria;
          mp_unidadmedida = obj.material_unidadmedida;
          mp_tipo         = obj.material_tipo;
        });
      }
    });
    
    $("#mp_materialid").val(mp_materialid);
    $("#mp_descripcion").val(mp_descripcion);
    $("#mp_asignacion").val(mp_asignacion);
    $("#mp_macrosistema").val(mp_macrosistema);
    $("#mp_sistema").val(mp_sistema);
    $("#mp_tarjeta").val(mp_tarjeta);
    $("#mp_condicion").val(mp_condicion);
    $("#mp_flota").val(mp_flota);
    $("#mp_patrimonial").val(mp_patrimonial);
    $("#mp_categoria").val(mp_categoria);
    $("#mp_unidadmedida").val(mp_unidadmedida);
    $("#mp_tipo").val(mp_tipo);
    $("#buscar_material").val("");
  });
   
  ///:: INICIO BOTONES MATERIAL PEDIDO ::::::::::::::::::::::::::::::::::::::::::::::::::::///

  ///:: EVENTO DEL BOTON NUEVO MATERIAL PEDIDO ::::::::::::::::::::::::::::::::::::::::::::///
  $(document).on("click", ".btn_material_pedido", function(){
    pedi_tipo = $("#pedi_tipo").val();
    if(pedi_tipo==""){
      Swal.fire({
        position: 'center',
        icon: 'error',
        title: '*Seleccionar Tipo de Pedido !!!',
        showConfirmButton: false,
        timer: 1500
      })
      $("#pedi_tipo").focus().select();  
    }else{
      ///:: CARGARMOS LOS DATOS PARA AUTOCOMPLETAR CODIGO MATERIAL ::::::::::::::::::::::::::///
      $( function() {
        t_autocompletar = f_auto_completar_tipo("manto_materiales","material_id",pedi_tipo);
        $( "#buscar_material" ).autocomplete({
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

      $("#form_modal_material_pedido").trigger("reset");
      f_limpia_material_pedido();
      mp_materialid     = "";
      mp_descripcion    = "";
      mp_asignacion     = "";
      mp_macrosistema   = "";
      mp_sistema        = "";
      mp_tarjeta        = "";
      mp_condicion      = "";
      mp_flota          = "";
      mp_patrimonial    = "";
      mp_categoria      = "";
      mp_unidadmedida   = "";
      mp_cantidad       = "";
      mp_bus            = "";
      mp_observaciones  = "";
      mp_tipo           = "";
  
      $("#mp_materialid").val(mp_materialid);
      $("#mp_descripcion").val(mp_descripcion);
      $("#mp_asignacion").val(mp_asignacion);
      $("#mp_macrosistema").val(mp_macrosistema);
      $("#mp_sistema").val(mp_sistema);
      $("#mp_tarjeta").val(mp_tarjeta);
      $("#mp_condicion").val(mp_condicion);
      $("#mp_flota").val(mp_flota);
      $("#mp_patrimonial").val(mp_patrimonial);
      $("#mp_categoria").val(mp_categoria);
      $("#mp_unidadmedida").val(mp_unidadmedida);
      $("#mp_cantidad").val(mp_cantidad);
      $("#mp_bus").val(mp_bus);
      $("#mp_observaciones").val(mp_observaciones);
      $("#mp_tipo").val(mp_tipo);
  
      $(".modal-header").css( "background-color", "#17a2b8");
      $(".modal-header").css( "color", "white" );
      $(".modal-title").text( "AGREGAR "+pedi_tipo);
      $('#modal_crud_material_pedido').modal('show');
      $("#modal_crud_material_pedido").draggable({});  
    }
  });
  ///:: FIN BOTON NUEVO MATERIAL PEDIDO :::::::::::::::::::::::::::::::::::::::::::::::::::///

  ///:: BOTON GRABAR -> REALIZA LA GRABACION EN LA TABLA manto_materialespedidos ::::::::::///
  $('#form_modal_material_pedido').submit(function(e){
    e.preventDefault(); //evita el comportambiento normal del submit, es decir, recarga total de la página
    t_valida_material_pedido = "";
    mp_pedidoid       = $("#pedido_id").val();
    mp_materialid     = $("#mp_materialid").val();
    mp_descripcion    = $("#mp_descripcion").val();
    mp_unidadmedida   = $("#mp_unidadmedida").val();
    mp_bus            = $("#mp_bus").val();
    mp_cantidad       = $("#mp_cantidad").val();
    mp_observaciones  = $.trim($("#mp_observaciones").val());
    t_valida_material_pedido = f_validar_material_pedido(mp_materialid, mp_descripcion, mp_unidadmedida, mp_cantidad, mp_bus, mp_observaciones)
    if (t_valida_material_pedido=="invalido"){
      Swal.fire({
        position: 'center',
        icon: 'error',
        title: '*Falta Completar Información !!!',
        showConfirmButton: false,
        timer: 1500
      })
    }else{  
      $("#btn_guardar_material_pedido").prop("disabled",true); // DESACTIVA el boton guardar para evitar multiples click
      tabla_material_pedido.row.add( {
        "mp_materialid"     : mp_materialid,
        "mp_descripcion"    : mp_descripcion,
        "mp_unidadmedida"   : mp_unidadmedida,
        "mp_cantidad"       : mp_cantidad,
        "mp_bus"            : mp_bus,
        "mp_observaciones"  : mp_observaciones
      } ).draw();
      $("#btn_guardar_material_pedido").prop("disabled",false);
      f_limpia_material_pedido();
      mp_materialid     = "";
      mp_descripcion    = "";
      mp_asignacion     = "";
      mp_macrosistema   = "";
      mp_sistema        = "";
      mp_tarjeta        = "";
      mp_condicion      = "";
      mp_flota          = "";
      mp_patrimonial    = "";
      mp_categoria      = "";  
      mp_unidadmedida   = "";
      mp_cantidad       = "";
      mp_bus            = "";
      mp_observaciones  = "";
      mp_tipo           = "";
      $("#mp_materialid").val(mp_materialid);
      $("#mp_descripcion").val(mp_descripcion);
      $("#mp_asignacion").val(mp_asignacion);
      $("#mp_macrosistema").val(mp_macrosistema);
      $("#mp_sistema").val(mp_sistema);
      $("#mp_tarjeta").val(mp_tarjeta);
      $("#mp_condicion").val(mp_condicion);
      $("#mp_flota").val(mp_flota);
      $("#mp_patrimonial").val(mp_patrimonial);
      $("#mp_categoria").val(mp_categoria);
      $("#mp_unidadmedida").val(mp_unidadmedida);
      $("#mp_cantidad").val(mp_cantidad);
      $("#mp_bus").val(mp_bus);
      $("#mp_observaciones").val(mp_observaciones);
      $("#mp_tipo").val(mp_tipo);
      $("#mp_materialid").focus().select();      
    }
  });
  ///:: FIN REALIZA LA GRABACION EN LA TABLA manto_materialespedidos :::::::::::::::::::///
  
  ///:: BOTON BORRAR MATERIAL PEDIDO :::::::::::::::::::::::::::::::::::::::::::::::::::///
  $(document).on("click", ".btn_borrar_material_pedido", function(){
    mp_materialid         = "";
    fila_material_pedido  = $(this); 
    mp_materialid         = fila_material_pedido.closest('tr').find('td:eq(0)').text();
    Swal.fire({
      title               : '¿Está seguro?',
      text                : "Se eliminará el registro "+mp_materialid+" !!!",
      icon                : 'warning',
      showCancelButton    : true,
      confirmButtonColor  : '#3085d6',
      cancelButtonColor   : '#d33',
      confirmButtonText   : 'Si, eliminar!'
    }).then((result) => 
    {
      if (result.isConfirmed){
        tabla_material_pedido
          .row( fila_material_pedido.parents('tr') )
          .remove()
          .draw();
        Swal.fire(
          'Eliminado!',
          'El registro ha sido elimidado.',
          'success')
      }
    });
  });
  ///:: FIN BOTON BORRAR MATERIALES PEDIDOS :::::::::::::::::::::::::::::::::::::::::::::::///
  
  ///:: TERMINO BOTONES MATERIAL PEDIDO :::::::::::::::::::::::::::::::::::::::::::::::::::///
});
///:: TERMINO JS DOM MATERIAL PEDIDO ::::::::::::::::::::::::::::::::::::::::::::::::::::::///


///:: INICIO FUNCIONES MATERIAL PEDIDO ::::::::::::::::::::::::::::::::::::::::::::::::::::///

///:: FUNCION UTILIZAR LABEL AUTOCOMPLETE COMO HTML :::::::::::::::::::::::::::::::::::::::///
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
///:: FIN FUNCION UTILIZAR LABEL AUTOCOMPLETE COMO HTML :::::::::::::::::::::::::::::::::::///

///:: VALIDA LOS CAMPOS DE MATERIALES DE PEDIDOS ::::::::::::::::::::::::::::::::::::::::::/// 
function f_validar_material_pedido(pmp_materialid, pmp_descripcion, pmp_unidadmedida, pmp_cantidad, pmp_bus){
  NoLetrasMayuscEspacio=/[^A-Z \Ñ]/;
  let rpta_material_pedido="";
  f_limpia_material_pedido();
   
  if(pmp_materialid==""){
    $("#mp_materialid").addClass("color-error");
    rpta_material_pedido="invalido";
  }
  if(pmp_descripcion==""){
    $("#mp_descripcion").addClass("color-error");
    rpta_material_pedido="invalido";
  }
  if(pmp_unidadmedida==""){
    $("#mp_unidadmedida").addClass("color-error");
    rpta_material_pedido="invalido";
  }
  if(pmp_cantidad==""){
    $("#mp_cantidad").addClass("color-error");
    rpta_material_pedido="invalido";
  }
  if(pmp_bus==""){
    $("#mp_bus").addClass("color-error");
    rpta_material_pedido="invalido";
  }
  return rpta_material_pedido;
}
///:: FIN VALIDA LOS CAMPOS DE MATERIALES DE PEDIDOS ::::::::::::::::::::::::::::::::::::::///

///:: INVISIBILIZA LOS MENSAJE DE ALERTA DEL FORMULARIO :::::::::::::::::::::::::::::::::::/// 
function f_limpia_material_pedido(){
  $("#mp_materialid").removeClass("color-error");
  $("#mp_descripcion").removeClass("color-error");
  $("#mp_unidadmedida").removeClass("color-error");
  $("#mp_cantidad").removeClass("color-error");
  $("#mp_bus").removeClass("color-error");
}
///:: FIN INVISIBILIZA LOS MENSAJE DE ALERTA DEL FORMULARIO :::::::::::::::::::::::::::::::/// 

///:: GENERACION DE TABLA DE DETALLE DE MATERIALES DE PEDIDOS :::::::::::::::::::::::::::::///
function f_tabla_material_pedido(ppedido_id,pbtn_BorrarMateriales){
  array_material_pedido = [];
  div_tabla = f_CreacionTabla("tabla_material_pedido",pbtn_BorrarMateriales);
  $("#div_tabla_material_pedido").html(div_tabla);
  columnastabla = f_ColumnasTabla("tabla_material_pedido",pbtn_BorrarMateriales);

  $("#tabla_material_pedido").dataTable().fnDestroy();
  $('#tabla_material_pedido').show();
  Accion='cargar_material_pedido';
  $.ajax({
    url       : "Ajax.php",
    type      : "POST",
    datatype  : "json",
    async     : false,
    data      : {MoS:MoS,NombreMoS:NombreMoS,Accion:Accion, pedido_id:ppedido_id},    
    success: function(data){
      array_material_pedido = $.parseJSON(data);
    }
  });

  tabla_material_pedido = $('#tabla_material_pedido').DataTable({
    language      : idiomaEspanol,
    searching     : false,
    info          : false,
    lengthChange  : true,
    pageLength    : 10,
    responsive    : "true",
    data          : array_material_pedido,
    columns       : columnastabla
  });
}
///:: FIN GENERACION DE TABLA DE DETALLE DE MATERIALES DE PEDIDOS :::::::::::::::::::::::::///

///:: TERMINO FUNCIONES MATERIAL PEDIDO :::::::::::::::::::::::::::::::::::::::::::::::::::///