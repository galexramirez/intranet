///::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
///:: ENTRADA MATERIALES v 1.0 FECHA: 22-11-2022 ::::::::::::::::::::::::::::::::::::::::::///
//::: EDITAR TABLA ENTRADA MATERIALES :::::::::::::::::::::::::::::::::::::::::::::::::::::///
///::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///

///:: INICIO DECLARACION VARIABLES ::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
var tabla_materiales_entrada, array_materiales_entrada, btn_borrar_materiales_entrada, t_autocompletar;
var fila_materiales_entrada;
///:: FIN DECLARACION VARIABLES :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///

///:: INICIO JS DOM ENTRADA MATERIALES ::::::::::::::::::::::::::::::::::::::::::::::::::::///

$(document).ready(function(){
  ///:: CARGARMOS LOS DATOS PARA AUTOCOMPLETAR CODIGO MATERIAL ::::::::::::::::::::::::::::///
  $( function() {
    t_autocompletar = f_AutoCompletar("manto_materiales","material_id");
    $( "#entm_material_id" ).autocomplete({
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
  
  ///:: SI HAY CAMBIOS EN CODIGO MATERIAL SE BUSCAN LOS DATOS DEL MISMO :::::::::::::::::::///
  $("#entm_material_id").on('change', function () {
    entm_material_id = $("#entm_material_id").val();
    Accion='BuscarMaterialid';
    $.ajax({
      url: "Ajax.php",
      type: "POST",
      datatype:"json",
      async: false,
      data: {MoS:MoS,NombreMoS:NombreMoS,Accion:Accion,material_id:entm_material_id},    
      success: function(data){
        data = $.parseJSON(data);
        $.each(data, function(idx, obj){ 
          entm_descripcion    = obj.material_descripcion;
          entm_asignacion     = "LB";
          entm_macrosistema   = obj.material_macrosistema;
          entm_sistema        = obj.material_sistema;
          entm_tarjeta        = obj.material_tarjeta;
          entm_condicion      = obj.material_condicion;
          entm_flota          = obj.material_flota;
          entm_patrimonial    = obj.material_patrimonial;
          entm_categoria      = obj.material_categoria;
          entm_moneda         = obj.moneda;
          entm_unidad_medida  = obj.unidad_medida;
          entm_precio         = obj.precio;
          entm_precio_soles   = obj.precio_soles;
        });
      }
    });
    $("#entm_descripcion").val(entm_descripcion);
    $("#entm_asignacion").val(entm_asignacion);
    $("#entm_macrosistema").val(entm_macrosistema);
    $("#entm_sistema").val(entm_sistema);
    $("#entm_tarjeta").val(entm_tarjeta);
    $("#entm_condicion").val(entm_condicion);
    $("#entm_flota").val(entm_flota);
    $("#entm_patrimonial").val(entm_patrimonial);
    $("#entm_categoria").val(entm_categoria);
    $("#entm_moneda").val(entm_moneda);
    $("#entm_unidad_medida").val(entm_unidad_medida);
    $("#entm_precio").val(entm_precio);
    $("#entm_precio_soles").val(entm_precio_soles);
  });

  ///:: INICIO BOTONES DE ENTRADA MATERIALES ::::::::::::::::::::::::::::::::::::::::::::::///

  ///:: BOTON NUEVO ENTRADA DE MATERIALES :::::::::::::::::::::::::::::::::::::::::::::::::///
  $(document).on("click", ".btn_materiales_entrada", function(){
    opcion_entrada_materiales = 1; /// CREAR
    f_limpia_entrada_materiales();
    $("#form_modal_entrada_materiales").trigger("reset");

    entm_material_id    = "";
    entm_descripcion    = "";
    entm_unidad_medida  = "";
    entm_cantidad       = "";
    entm_moneda         = "";
    entm_precio         = "";
    entm_precio_soles   = "";
    entm_patrimonial    = "";
    $("#entm_material_id").val(entm_material_id);
    $("#entm_descripcion").val(entm_descripcion);
    $("#entm_unidad_medida").val(entm_unidad_medida);
    $("#entm_cantidad").val(entm_cantidad);
    $("#entm_moneda").val(entm_moneda);
    $("#entm_precio").val(entm_precio);
    $("#entm_precio_soles").val(entm_precio_soles);
    $("#entm_patrimonial").val(entm_patrimonial);

    $(".modal-header").css( "background-color", "#17a2b8");
    $(".modal-header").css( "color", "white" );
    $(".modal-title").text("Entrada de Materiales");
    $('#modal_crud_entrada_materiales').modal('show');
    $("#modal_crud_entrada_materiales").draggable({});
  
  });
  ///:: FIN BOTON NUEVO ENTRADA DE MATERIALES :::::::::::::::::::::::::::::::::::::::::::::///

  ///:: BOTON EDITAR ENTRADA DE MATERIALES ::::::::::::::::::::::::::::::::::::::::::::::::///
  $(document).on("click", ".btn_editar_materiales_entrada", function(){
    opcion_entrada_materiales = 2; /// EDITAR
    f_limpia_entrada_materiales();
    $("#form_modal_entrada_materiales").trigger("reset");
    entm_material_id="";
    fila_materiales_entrada = $(this); 
    entm_material_id    = fila_materiales_entrada.closest('tr').find('td:eq(0)').text();
    entm_descripcion    = fila_materiales_entrada.closest('tr').find('td:eq(1)').text();
    entm_unidad_medida  = fila_materiales_entrada.closest('tr').find('td:eq(2)').text();
    entm_cantidad       = fila_materiales_entrada.closest('tr').find('td:eq(3)').text();
    entm_moneda         = fila_materiales_entrada.closest('tr').find('td:eq(4)').text();
    entm_precio         = fila_materiales_entrada.closest('tr').find('td:eq(5)').text();
    entm_precio_soles   = fila_materiales_entrada.closest('tr').find('td:eq(6)').text();
    entm_patrimonial    = fila_materiales_entrada.closest('tr').find('td:eq(7)').text();
    $("#entm_material_id").val(entm_material_id);
    $("#entm_descripcion").val(entm_descripcion);
    $("#entm_unidad_medida").val(entm_unidad_medida);
    $("#entm_cantidad").val(entm_cantidad);
    $("#entm_moneda").val(entm_moneda);
    $("#entm_precio").val(entm_precio);
    $("#entm_precio_soles").val(entm_precio_soles);
    $("#entm_patrimonial").val(entm_patrimonial);

    $(".modal-header").css( "background-color", "#17a2b8");
    $(".modal-header").css( "color", "white" );
    $(".modal-title").text("Entrada de Materiales");
    $('#modal_crud_entrada_materiales').modal('show');
    $("#modal_crud_entrada_materiales").draggable({});
  
  });
  ///:: FIN BOTON NUEVO ENTRADA DE MATERIALES :::::::::::::::::::::::::::::::::::::::::::::///

  ///:: BOTON GRABAR EN LA TABLA MATERIALES ENTRADA :::::::::::::::::::::::::::::::::::::::///
  $('#form_modal_entrada_materiales').submit(function(e){
    e.preventDefault();
    t_validar_material_entrada = "";
    entm_material_id      = $("#entm_material_id").val();
    entm_descripcion      = $("#entm_descripcion").val();
    entm_unidad_medida    = $("#entm_unidad_medida").val();
    entm_cantidad         = $("#entm_cantidad").val();
    entm_moneda           = $.trim($("#entm_moneda").val());
    entm_precio           = $.trim($("#entm_precio").val());
    entm_precio_soles     = $.trim($("#entm_precio_soles").val());
    entm_patrimonial      = $.trim($("#entm_patrimonial").val());
    
    t_validar_material_entrada = f_validar_material_entrada(entm_material_id, entm_descripcion, entm_unidad_medida, entm_cantidad, entm_moneda, entm_precio, entm_precio_soles, entm_patrimonial)
    
    if (t_validar_material_entrada=="invalido"){
      Swal.fire({
        position: 'center',
        icon: 'error',
        title: '*Falta Completar Información !!!',
        showConfirmButton: false,
        timer: 1500
      })
    }else{  
      $("#btn_guardar_entrada_materiales").prop("disabled",true); // DESACTIVA el boton guardar para evitar multiples click
      if(opcion_entrada_materiales==2){
        tabla_materiales_entrada
          .row( fila_materiales_entrada.parents('tr') )
          .remove()
          .draw();
      }
      tabla_materiales_entrada.row.add( {
        "entm_material_id"    : entm_material_id,
        "entm_descripcion"    : entm_descripcion,
        "entm_unidad_medida"  : entm_unidad_medida,
        "entm_cantidad"       : entm_cantidad,
        "entm_moneda"         : entm_moneda,
        "entm_precio"         : entm_precio,
        "entm_precio_soles"   : entm_precio_soles,
        "entm_patrimonial"    : entm_patrimonial,
      } ).draw();
      $("#btn_guardar_entrada_materiales").prop("disabled",false);
      $('#modal_crud_entrada_materiales').modal('hide');
    }
  });
  ///:: FIN BOTON GRABAR EN LA TABLA MATERIALES ENTRADA ::::::::::::::::::::::::::::::::///
  
  ///:::::::::::::::::::::::: BOTON BORRAR MATERIALES PEDIDOS ::::::::::::::::::::::::::///
  $(document).on("click", ".btn_borrar_materiales_entrada", function(){
    entm_material_id="";
    fila_materiales_entrada = $(this); 
    entm_material_id = fila_materiales_entrada.closest('tr').find('td:eq(0)').text();
    Swal.fire({
      title: '¿Está seguro?',
      text: "Se eliminará el registro "+entm_material_id+" !!!",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Si, eliminar!'
    }).then((result) => 
    {
      if (result.isConfirmed){
        tabla_materiales_entrada
          .row( fila_materiales_entrada.parents('tr') )
          .remove()
          .draw();
        Swal.fire(
          'Eliminado!',
          'El registro ha sido elimidado.',
          'success')
      }
    });
  });
  ///:::::::::::::::::::: TERMINO BOTON BORRAR MATERIALES PEDIDOS ::::::::::::::::::::::///
  

  ///::::::::::::::::::::::::::::: FIN DE BOTONES INVENTARIO :::::::::::::::::::::::::::///

});

///:::::::::::::::: FIN JS DOM ENTRADA MATERIALES ::::::::::::::::::::::::::::::::::::::///


///::::::::::::::::::::::: INICIO FUNCIONES DE ENTRADA MATERIALES ::::::::::::::::::::::///

///:::::::::::::::::: CARGA LOS COMBOS DE ENTRADA MATERIALES :::::::::::::::::::::::::::///
function f_combos_entrada_mataeriales(){
  let rpta_select_entrada_material;


}
///:::::::::::::::::: FIN CARGA LOS COMBOS DE ENTRADA MATERIALES :::::::::::::::::::::::///

///:::::::::::: GENERACION DE TABLA DE DETALLE DE ENTRADA MATERIALES :::::::::::::::::::///
function f_tabla_materiales_entrada(p_entrada_id,p_btn_borrar_materiales_entrada){
  array_materiales_entrada = [];
  div_tabla = f_CreacionTabla("tabla_materiales_entrada",p_btn_borrar_materiales_entrada);
  $("#div_tabla_materiales_entrada").html(div_tabla);
  columnastabla = f_ColumnasTabla("tabla_materiales_entrada",p_btn_borrar_materiales_entrada);

  $("#tabla_materiales_entrada").dataTable().fnDestroy();
  $('#tabla_materiales_entrada').show();
  Accion='cargar_materiales_entrada';
  $.ajax({
    url: "Ajax.php",
    type: "POST",
    datatype:"json",
    async: false,
    data: {MoS:MoS,NombreMoS:NombreMoS,Accion:Accion, entrada_id:p_entrada_id},    
    success: function(data){
      array_materiales_entrada = $.parseJSON(data);
    }
  });

  tabla_materiales_entrada = $('#tabla_materiales_entrada').DataTable({
    language: idiomaEspanol,
    searching: false,
    info: false,
    lengthChange: true,
    pageLength: 10,
    responsive: "true",
    data: array_materiales_entrada,
    columns: columnastabla
  });
}
///:::::::::::: TERMINO GENERACION DE TABLA DE DETALLE DE ENTRADA MATERIALES :::::::::::///

///:::::::::::: GENERACION DE TABLA DE DETALLE DE ENTRADA MATERIALES :::::::::::::::::::///
function f_tabla_importar_materiales_entrada(p_tipo_documento, p_nro_documento, p_btn_accion_materiales_entrada){
  array_materiales_entrada = [];
  div_tabla = f_CreacionTabla("tabla_materiales_entrada",p_btn_accion_materiales_entrada);
  $("#div_tabla_materiales_entrada").html(div_tabla);
  columnastabla = f_ColumnasTabla("tabla_materiales_entrada",p_btn_accion_materiales_entrada);

  $("#tabla_materiales_entrada").dataTable().fnDestroy();
  $('#tabla_materiales_entrada').show();
  Accion='importar_materiales_entrada';
  $.ajax({
    url: "Ajax.php",
    type: "POST",
    datatype:"json",
    async: false,
    data: {MoS:MoS,NombreMoS:NombreMoS,Accion:Accion, tipo_documento:p_tipo_documento, nro_documento:p_nro_documento},    
    success: function(data){
      array_materiales_entrada = $.parseJSON(data);
    }
  });

  tabla_materiales_entrada = $('#tabla_materiales_entrada').DataTable({
    language: idiomaEspanol,
    searching: false,
    info: false,
    lengthChange: true,
    pageLength: 10,
    responsive: "true",
    data: array_materiales_entrada,
    columns: columnastabla
  });
}
///:::::::::::: TERMINO GENERACION DE TABLA DE DETALLE DE ENTRADA MATERIALES :::::::::::///

///::::::::: VALIDA LOS CAMPOS DE MATERIALES DE PEDIDOS ::::::::::::::::::::::::::::::::/// 
function f_validar_material_entrada(p_entm_material_id, p_entm_descripcion, p_entm_unidad_medida, p_entm_cantidad, p_entm_moneda, p_entm_precio, p_entm_precio_soles, p_entm_patrimonial){
  NoLetrasMayuscEspacio=/[^A-Z \Ñ]/;
  let rpta_validar_entrada_materiales="";
  f_limpia_entrada_materiales();
   
  if(p_entm_material_id==""){
    $("#entm_material_id").addClass("color-error");
    rpta_validar_entrada_materiales="invalido";
  }
  if(p_entm_descripcion==""){
    $("#entm_descripcion").addClass("color-error");
    rpta_validar_entrada_materiales="invalido";
  }
  if(p_entm_unidad_medida==""){
    $("#entm_unidad_medida").addClass("color-error");
    rpta_validar_entrada_materiales="invalido";
  }
  if(p_entm_cantidad==""){
    $("#entm_cantidad").addClass("color-error");
    rpta_validar_entrada_materiales="invalido";
  }
  if(p_entm_moneda==""){
    $("#entm_moneda").addClass("color-error");
    rpta_validar_entrada_materiales="invalido";
  }
  if(p_entm_precio==""){
    $("#entm_precio").addClass("color-error");
    rpta_validar_entrada_materiales="invalido";
  }
  if(p_entm_precio_soles==""){
    $("#entm_precio_soles").addClass("color-error");
    rpta_validar_entrada_materiales="invalido";
  }
  if(p_entm_patrimonial==""){
    $("#entm_patrimonial").addClass("color-error");
    rpta_validar_entrada_materiales="invalido";
  }
  return rpta_validar_entrada_materiales;
}
///::::::::: TERMINO VALIDA LOS CAMPOS DE MATERIALES DE PEDIDOS ::::::::::::::::::::::::/// 

///::::::::: INVISIBILIZA LOS MENSAJE DE ALERTA DEL FORMULARIO :::::::::::::::::::::::::/// 
function f_limpia_entrada_materiales(){
  $("#entm_material_id").removeClass("color-error");
  $("#entm_descripcion").removeClass("color-error");
  $("#entm_unidad_medida").removeClass("color-error");
  $("#entm_cantidad").removeClass("color-error");
  $("#entm_moneda").removeClass("color-error");
  $("#entm_precio").removeClass("color-error");
  $("#entm_precio_soles").removeClass("color-error");
  $("#entm_patrimonial").removeClass("color-error");
}
///:: TERMINO INVISIBILIZA LOS MENSAJE DE ALERTA DEL FORMULARIO :::::::::::::::::::::::::::/// 

///:: FUNCION UTILIZAR LABEL AUTOCOMPLETAR HTML :::::::::::::::::::::::::::::::::::::::::::///
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
///:: TERMINO FUNCION UTILIZAR LABEL AUTOCOMPLETAR HTML :::::::::::::::::::::::::::::::::::///


///:: TERMINO FUNCIONES DE ENTRADA MATERIALES :::::::::::::::::::::::::::::::::::::::::::::///