///::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
///:: PROCESAR REPUESTOS VALES v 2.0 FECHA: 07-03-2023 ::::::::::::::::::::::::::::::::::::///
//::: EDITAR TABLA DE REPUESTOS VALES :::::::::::::::::::::::::::::::::::::::::::::::::::::///
///::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///

///:: DECLARACION DE VARIABLES ::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
var tablaDetalleRepuestos, btn_BorrarRepuesto, fila_DetalleRepuestos, t_autocompletar, array_vale_repuestos;
var rv_repuesto, rv_desc, rv_nroserie, rv_cantidad, rv_unidad;
///:: TERMINO DECLARACION DE VARIABLES ::::::::::::::::::::::::::::::::::::::::::::::::::::///

///:: JS DOM VALES REPUESTOS ::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
$(document).ready(function(){

  ///:: CARGAR LOS DATOS PARA AUTOCOMPLETAR :::::::::::::::::::::::::::::::::::::::::::::::///
  $(function(){
    t_autocompletar = f_AutoCompletar("manto_repuestos","cod_rep");
    $("#buscar_repuesto").autocomplete({
      minLength : 3,
      source    : t_autocompletar,
      html      : true,
      _renderMenu: function(ul, items) {
        var that = this;
        $.each(items, function(index, item) {
          that._renderItemData(ul, item);
        });
        $(ul).find("li").odd().addClass("odd");
      }
    });
  });

  ///:: CAMBIOS EN CODIGO MATERIAL SE ACTUALIZA DESCRIPCION DE MATERIAL :::::::::::::::::///
  $(document).on("click", ".btn_buscar_repuesto", function(){
  //$("#buscar_repuesto").on('click', function () {
    f_LimpiaDetalleRepuestos();
    rv_repuesto = $("#buscar_repuesto").val();
    rv_desc     = "";
    rv_unidad   = "";
    Accion='BuscarCodigoRepuesto';
    $.ajax({
      url       : "Ajax.php",
      type      : "POST",
      datatype  : "json",
      async     : false,
      data      : { MoS:MoS,NombreMoS:NombreMoS,Accion:Accion,rv_repuesto:rv_repuesto },
      success: function(data){
        data = $.parseJSON(data);
        $.each(data, function(idx, obj){ 
          rv_desc   = obj.rv_desc;
          rv_unidad = obj.rv_unidad;
        });
      }
    });
    $("#rv_repuesto").val(rv_repuesto);
    $("#rv_desc").val(rv_desc);
    $("#rv_unidad").val(rv_unidad);
    $("#buscar_repuesto").val("");
    $("#rv_id").focus().select();
  });

  ///:: INICIO BOTONES DE VALES REPUESTOS :::::::::::::::::::::::::::::::::::::::::::::::::///

  ///:: EVENTO DEL BOTON NUEVO REPUESTO :::::::::::::::::::::::::::::::::::::::::::::::::::///
  $(document).on("click", ".btn_repuestos_vale", function(){
    $("#form_modal_detalle_repuestos").trigger("reset");
    f_LimpiaDetalleRepuestos();

    rv_id       = f_max_id(tablaDetalleRepuestos.rows().data().toArray());
    rv_repuesto = "";
    rv_desc     = "";
    rv_nroserie = "";
    rv_cantidad = "";
    rv_unidad   = "";

    $("#rv_id").val(rv_id);
    $("#rv_repuesto").val(rv_repuesto);
    $("#rv_desc").val(rv_desc);
    $("#rv_nroserie").val(rv_nroserie);
    $("#rv_cantidad").val(rv_cantidad);
    $("#rv_unidad").val(rv_unidad);

    $(".modal-header").css( "background-color", "#17a2b8");
    $(".modal-header").css( "color", "white" );
    $(".modal-title").text("Alta de Repuestos");
    $('#modal_crud_detalle_repuestos').modal('show');
    $("#modal_crud_detalle_repuestos").draggable({});
    $("#buscar_repuesto").focus().select();
  });
  ///:: FIN EVENTO DEL BOTON NUEVO REPUESTO :::::::::::::::::::::::::::::::::::::::::::::::///

  //:: BOTON GRABAR -> REALIZA LA GRABACION EN LA TABLA manto_rep_vale ::::::::::::::::::::///
  $('#form_modal_detalle_repuestos').submit(function(e){
    e.preventDefault();
    let t_ValidaDetalleRepuestos = "";
    rv_id       = $("#rv_id").val();
    rv_repuesto = $("#rv_repuesto").val();
    rv_nroserie = $("#rv_nroserie").val();
    rv_desc     = $("#rv_desc").val();
    rv_cantidad = $("#rv_cantidad").val();
    rv_unidad   = $("#rv_unidad").val();
    t_ValidaDetalleRepuestos = f_ValidarDetalleRepuestos(rv_id, rv_repuesto, rv_nroserie, rv_desc, rv_cantidad)
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
        "rv_desc"       : rv_desc,
        "rv_cantidad"   : rv_cantidad,
        "rv_unidad"     : rv_unidad,
      } ).draw();
      
      $("#btn_guardar_detalle_repuestos").prop("disabled",false);
      f_LimpiaDetalleRepuestos();

      rv_id       = f_max_id(tablaDetalleRepuestos.rows().data().toArray());
      rv_repuesto = "";
      rv_desc     = "";
      rv_cantidad = "";
      rv_nroserie = "";
      rv_unidad   = "";
      
      $("#rv_id").val(rv_id);
      $("#rv_repuesto").val(rv_repuesto);
      $("#rv_desc").val(rv_desc);
      $("#rv_cantidad").val(rv_cantidad);
      $("#rv_nroserie").val(rv_nroserie);
      $("#rv_unidad").val(rv_unidad);
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
function f_ValidarDetalleRepuestos(prv_id, prv_repuesto, prv_nroserie, prv_desc, prv_cantidad){
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
  if(prv_desc==""){
    $("#rv_desc").addClass("color-error");
    rpta_DetalleRepuestos="invalido";
  }
  if(prv_cantidad==""){
    $("#rv_cantidad").addClass("color-error");
    rpta_DetalleRepuestos="invalido";
  }

  return rpta_DetalleRepuestos;
}
///:: FIN VALIDA LOS CAMPOS DE REPUESTOS ::::::::::::::::::::::::::::::::::::::::::::::::::///

///:: ELIMINA EL COLOR DE ERROR EN LOS CAMPOS :::::::::::::::::::::::::::::::::::::::::::::/// 
function f_LimpiaDetalleRepuestos(){
  $("#rv_id").removeClass("color-error");
  $("#rv_repuesto").removeClass("color-error");
  $("#rv_desc").removeClass("color-error");
  $("#rv_cantidad").removeClass("color-error");
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