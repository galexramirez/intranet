///::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
///:: PROCESAR COTIZACION v 2.0 FECHA: 18-02-2023 :::::::::::::::::::::::::::::::::::::::::///
//::: EDITAR TABLA DE COTIZACION ::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
///::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///

///:: INICIO DECLARACION VARIABLE :::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
var mc_materialid, mc_descripcion, mc_unidadmedida, mc_cantidad, mc_preciocotizacion, mc_totalprecio, mc_cantidad, mc_cantidad_cotizacion, mc_cantidad_solicitada;
///:: FIN DECLARACION VARIABLE ::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///


///:: INICIO JS DOM PROCESAR COTIZACION :::::::::::::::::::::::::::::::::::::::::::::::::::///
$(document).ready(function(){
  ///:: CAMBIOS PRECIOS MATERIAL ::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
  $("#mc_preciocotizacion").on('change', function () {
    mc_preciocotizacion     = $("#mc_preciocotizacion").val();
    mc_cantidad_cotizacion  = $("#mc_cantidad_cotizacion").val();
    mc_totalprecio          = mc_preciocotizacion * mc_cantidad_cotizacion;
    $("#mc_totalprecio").val(mc_totalprecio.toFixed(2));  
  });

  ///:: CAMBIOS CANTIDAD MATERIAL :::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
  $("#mc_cantidad_cotizacion").on('change', function () {
    mc_cantidad             = $("#mc_cantidad").val();
    mc_cantidad_cotizacion  = $("#mc_cantidad_cotizacion").val();
    $("#mc_cantidad_cotizacion").removeClass("color-error");

    if(parseInt(mc_cantidad_cotizacion) > parseInt(mc_cantidad)){
      $("#mc_cantidad_cotizacion").addClass("color-error");
      Swal.fire({
        position          : 'center',
        icon              : 'error',
        title             : '*Cantidad es mayor que la Cantidad del Pedido!!!',
        showConfirmButton : false,
        timer             : 1500
      })
    }else{
      mc_preciocotizacion     = $("#mc_preciocotizacion").val();
      mc_totalprecio          = mc_preciocotizacion * mc_cantidad_cotizacion;
      $("#mc_totalprecio").val(mc_totalprecio.toFixed(2));    
    }
  });


  ///:: COLOCA EL NOMBRE DEL ARCHIVO PDF EN EL INPUT FILE PARA PDF ::::::::::::::::::::::::///
  $(document).on('change', '#cotizacion_pdf', function (event) {
    pdf_editar="";
    let NombreArch=event.target.files[0].name;
    let Extension=NombreArch.split('.').pop();
    $("#label_cotizacion_pdf").text(NombreArch);
    
    let archivo = event.target.files[0];
    let reader = new FileReader();
    if (archivo) {
      reader.readAsDataURL(archivo );
      reader.onloadend = function () {
        pdf_editar='<iframe src="' + reader.result + '" width="750" height="400"></iframe>';
        $("#div_cotizacion_pdf").html(pdf_editar);
      }
    }
  });
  
  ///:: INICIO BOTONES PROCESAR COTIZACION ::::::::::::::::::::::::::::::::::::::::::::::::///

  ///:: EVENTO DEL BOTON NUEVA COTIZACION :::::::::::::::::::::::::::::::::::::::::::::::::///
  $(document).on("click", ".btn_nueva_cotizacion", function(){
    coti_razonsocial = "";
    coti_fecha = f_CalculoFecha("hoy","hora");
    $("#form_modal_cotizacion").trigger("reset");

    $("#coti_razonsocial").val(coti_razonsocial);
    $("#coti_fecha").val(coti_fecha);

    $(".modal-header").css( "background-color", "#17a2b8");
    $(".modal-header").css( "color", "white" );
    $(".modal-title").text("Alta de Cotizaciones");
    $('#modal_crud_cotizacion').modal('show');
    $("#modal_crud_cotizacion").draggable({});
  });
  ///:: FIN BOTON NUEVA COTIZACION ::::::::::::::::::::::::::::::::::::::::::::::::::::::::///

  ///:: EVENTO DEL GUARDAR COTIZACION :::::::::::::::::::::::::::::::::::::::::::::::::::::///
  $(document).on("click", ".btn_guardar_cotizacion", function(){
    let coti_data         = [];
    let proveedor_existe  = "NO";
    coti_razonsocial      = $("#coti_razonsocial").val();
    coti_fecha            = $("#coti_fecha").val();
    $("#coti_razonsocial").removeClass("color-error");
    $("#coti_fecha").removeClass("color-error");

    if(coti_razonsocial == "" || coti_fecha == ""){
      $("coti_razonsocial").addClass("color-error");
      $("coti_fecha").addClass("color-error");
      Swal.fire({
        position          : 'center',
        icon              : 'error',
        title             : '*Falta Completar Información!!!',
        showConfirmButton : false,
        timer             : 1500
      })
    }else{
      coti_pedidoid = $("#pedido_id").val();
      coti_data = f_BuscarDataBD("manto_cotizaciones","coti_pedidoid",coti_pedidoid);
      $.each(coti_data, function(idx, obj){ 
        if(coti_razonsocial == obj.coti_razonsocial){
          proveedor_existe = "SI";
        }
      });
      if(proveedor_existe=="SI"){
        Swal.fire({
          position          : 'center',
          icon              : 'error',
          title             : '*Provedor ya existe!!!',
          showConfirmButton : false,
          timer             : 1500
        })  
      }else{
        $("#btn_guardar_cotizacion").prop("disabled",true);
        Accion = 'guardar_cotizacion';
        $.ajax({
          url: "Ajax.php",
          type: "POST",
          datatype:"json",
          async: false,
          data: {MoS:MoS,NombreMoS:NombreMoS,Accion:Accion, coti_pedidoid:coti_pedidoid, coti_razonsocial:coti_razonsocial, coti_fecha:coti_fecha},    
          success: function(data){
            tabla_cotizacion.ajax.reload(null, false);
          }
        });
        $("#btn_guardar_cotizacion").prop("disabled",false);
        $('#modal_crud_cotizacion').modal('hide');  
      }
    }
  });
  ///:: FIN BOTON GUARDAR COTIZACION ::::::::::::::::::::::::::::::::::::::::::::::::::::::///

  ///:: BOTON DESCARGAR COTIZACION PDF ::::::::::::::::::::::::::::::::::::::::::::::::::::///
  $(document).on("click", ".btn_cotizacion_pdf", function(){
    fila_cotizacion  = $(this).closest('tr'); 
    cotizacion_id     = fila_cotizacion.find('td:eq(0)').text();
    if(cotizacion_id!=""){
      Accion="cotizacion_pdf";
      $.ajax({
        url: "Ajax.php",
        type: "POST",
        datatype:"json",    
        async: false,   
        data:  { MoS:MoS,NombreMoS:NombreMoS,Accion:Accion,cotizacion_id:cotizacion_id },   
        success: function(data) {
          window.location.href = miCarpeta + "Module/Pedidos/Controller/PDF_Cotizacion.php?Id_DateJS=" + data;
        }
    });	

    }else{
      Swal.fire({
        icon: 'error',
        title: 'ID Cotización...',
        text: 'No se ha generado el ID Cotización !!!'
      })    
    }
  });
  ///::FIN BOTON DESCARGAR COTIZACION PDF :::::::::::::::::::::::::::::::::::::::::::::::::///

  ///:: BOTON CERRAR COTIZACION :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
  $(document).on("click", ".btn_cerrar_cotizacion", function(){
    let data_bd;
    let mostrar_accion_cotizacion = "SI";
    array_material_cotizacion     = [];
    fila_cotizacion               = $(this).closest('tr'); 
    cotizacion_id                 = fila_cotizacion.find('td:eq(0)').text();
    coti_estado                   = fila_cotizacion.find('td:eq(4)').text();
    pedi_estado                   = $("#pedi_estado").val();
    
    if(cotizacion_id!=""){
      $("#form_modal_cerrar_cotizacion").trigger("reset");
      data_bd = f_BuscarDataBD("manto_cotizaciones","cotizacion_id",cotizacion_id);
      $.each(data_bd, function(idx, obj){
          icotizacion_id        = obj.cotizacion_id;
          icoti_fecha           = obj.coti_fecha;
          icoti_pedidoid        = obj.coti_pedidoid;
          icoti_ruc             = obj.coti_ruc;
          icoti_razonsocial     = obj.coti_razonsocial;
          icoti_responsabledni  = obj.coti_responsable;
          icoti_estado          = obj.coti_estado;
          icoti_log             = obj.coti_log;
      });
      data_bd = f_BuscarDataBD("glo_roles","roles_dni",icoti_responsabledni);
      $.each(data_bd, function(idx, obj){ 
        icoti_responsable = obj.roles_nombrecorto;
      });
      
      $('#icotizacion_id').val(cotizacion_id);
      $('#icoti_fecha').val(icoti_fecha);
      $('#icoti_pedidoid').val(icoti_pedidoid);
      $('#icoti_razonsocial').val(icoti_razonsocial);
      $('#icoti_responsable').val(icoti_responsable);
      $('#icoti_estado').val(icoti_estado);
      $("#div_icoti_log").html(icoti_log);

      mostrar_accion_cotizacion = f_valida_cerrar_cotizacion(pedi_estado, coti_estado); 
      div_show                  = f_MostrarDiv("form_modal_cerrar_cotizacion","btn_cerrar_cotizacion",mostrar_accion_cotizacion,"");
      $("#div_btn_cerrar_cotizacion").html(div_show);
      div_tabla = f_CreacionTabla("tabla_material_cotizacion",mostrar_accion_cotizacion);
      $("#div_tabla_material_cotizacion").html(div_tabla);
      columnastabla = f_ColumnasTabla("tabla_material_cotizacion",mostrar_accion_cotizacion);
        
      $("#tabla_material_cotizacion").dataTable().fnDestroy();
      $('#tabla_material_cotizacion').show();
      
      Accion='cargar_material_cotizacion';
      $.ajax({
        url       : "Ajax.php",
        type      : "POST",
        datatype  :"json",
        async     : false,
        data      : {MoS:MoS,NombreMoS:NombreMoS,Accion:Accion, cotizacion_id:cotizacion_id},    
        success   : function(data){
          array_material_cotizacion = $.parseJSON(data);
        }
      });
      
      tabla_material_cotizacion = $('#tabla_material_cotizacion').DataTable({
        language      : idiomaEspanol,
        searching     : false,
        info          : false,
        lengthChange  : false,
        pageLength    : 5,
        responsive    : "true",
        data          : array_material_cotizacion,
        "columns"     : columnastabla,
        "columnDefs"  : [
          {className: "text-center", "targets":[0,2]},
          {className: "text-right", "targets":[3,4,5]}
        ],
      });     
      
      $(".modal-header").css( "background-color", "#17a2b8");
      $(".modal-header").css( "color", "white" );
      $(".modal-title").text("Recibir Cotización");
      $('#modal_crud_cerrar_cotizacion').modal('show');	    
    }else{
      Swal.fire({
        icon: 'error',
        title: 'ID Cotización...',
        text: 'No se ha generado el ID Cotización !!!'
      })    
    }
  });
  ///:: TERMINO BOTON CERRAR COTIZACION :::::::::::::::::::::::::::::::::::::::::::::::::::///
  
  ///:: EVENTO DEL BOTON EDITAR MATERIALES COTIZACIONES :::::::::::::::::::::::::::::::::::///
  $(document).on("click", ".btn_editar_material_cotizacion", function(){
    
    $("#form_modal_material_cotizacion").trigger("reset");

    mc_materialid           = "";
    mc_descripcion          = "";
    mc_unidadmedida         = "";
    mc_cantidad             = "";
    mc_cantidad_cotizacion  = "";
    mc_preciocotizacion     = "";
    mc_totalprecio          = "";

    fila_material_cotizacion      = $(this).closest('tr'); 
    fila_rm_material_cotizacion   = $(this);
    mc_materialid                 = fila_material_cotizacion.find('td:eq(0)').text();
    mc_descripcion                = fila_material_cotizacion.find('td:eq(1)').text();
    mc_unidadmedida               = fila_material_cotizacion.find('td:eq(2)').text();
    mc_cantidad                   = fila_material_cotizacion.find('td:eq(3)').text();
    mc_cantidad_cotizacion        = fila_material_cotizacion.find('td:eq(4)').text();
    mc_preciocotizacion           = fila_material_cotizacion.find('td:eq(5)').text();
    mc_totalprecio                = fila_material_cotizacion.find('td:eq(6)').text();

    $('#mc_materialid').val(mc_materialid);
    $('#mc_descripcion').val(mc_descripcion);
    $('#mc_unidadmedida').val(mc_unidadmedida);
    $('#mc_cantidad').val(mc_cantidad);
    $('#mc_cantidad_cotizacion').val(mc_cantidad_cotizacion);
    $('#mc_preciocotizacion').val(mc_preciocotizacion);
    $('#mc_totalprecio').val(mc_totalprecio);

    $(".modal-header").css( "background-color", "#17a2b8" );
    $(".modal-header").css( "color", "white" );
    $("#material_cotizacion_modal_label").text( "Edición de Materiales" );

    $('#modal_crud_material_cotizacion').modal('show');
    $('#modal_crud_material_cotizacion').draggable({});
  });
  ///:: FIN EVENTO DEL BOTON EDITAR MATERIALES COTIZACIONES :::::::::::::::::::::::::::::::///
  
  ///:: BOTON GUARDAR -> REALIZA LA GRABACION EN ARREGLO MATERIAL COTIZACION ::::::::::::::///
  $(document).on("click", ".btn_guardar_material_cotizacion", function(){
    mc_materialid           = $("#mc_materialid").val();
    mc_descripcion          = $("#mc_descripcion").val();
    mc_unidadmedida         = $("#mc_unidadmedida").val();
    mc_cantidad             = $("#mc_cantidad").val();
    mc_cantidad_cotizacion  = $("#mc_cantidad_cotizacion").val();
    mc_preciocotizacion     = $("#mc_preciocotizacion").val();
    mc_totalprecio          = $("#mc_totalprecio").val();

    $("#btn_guardar_material_cotizacion").prop("disabled",true);
    $("#mc_cantidad_cotizacion").removeClass("color-error");

    if(parseInt(mc_cantidad_cotizacion) > parseInt(mc_cantidad)){
      $("#mc_cantidad_cotizacion").addClass("color-error");
      Swal.fire({
        position          : 'center',
        icon              : 'error',
        title             : '*Cantidad es mayor que la Cantidad del Pedido!!!',
        showConfirmButton : false,
        timer             : 1500
      })
    }else{
      tabla_material_cotizacion
      .row( fila_rm_material_cotizacion.parents('tr') )
      .remove()
      .draw();

      tabla_material_cotizacion.row.add( {
        "mc_materialid"           : mc_materialid,
        "mc_descripcion"          : mc_descripcion,
        "mc_unidadmedida"         : mc_unidadmedida,
        "mc_cantidad"             : mc_cantidad,
        "mc_cantidad_cotizacion"  : mc_cantidad_cotizacion,
        "mc_preciocotizacion"     : mc_preciocotizacion,
        "mc_totalprecio"          : mc_totalprecio
      } ).draw();
      $('#modal_crud_material_cotizacion').modal('hide');
    }
    $("#btn_guardar_material_cotizacion").prop("disabled",false);
  });
  ///:: FIN REALIZA LA GRABACION EN arreglo MaterialesCotizaciones ::::::::::::::::::::::::///
    
  ///:: BOTON GRABAR CERRAR COTIZACION ::::::::::::::::::::::::::::::::::::::::::::::::::::///
  $(document).on("click", ".btn_grabar_cerrar_cotizacion", function(){
    let array_data                  = [];
    let validar_precio_cotizacion   = "";
    let validar_cantidad_cotizacion = "";
    let mensage_cotizacion          = "";
    let mensage_cantidad_cotizacion = "";
    cotizacion_id                   = $('#icotizacion_id').val();
    array_material_cotizacion       = tabla_material_cotizacion.rows().data().toArray();

    $.each(array_material_cotizacion, function(idx, obj){ 
      if(obj.mc_preciocotizacion==null || obj.mc_preciocotizacion==""){
        validar_precio_cotizacion = "invalido";
      }
      if(parseInt(obj.mc_cantidad) > parseInt(obj.mc_cantidad_cotizacion)){
        validar_cantidad_cotizacion = "invalido";
      }
    });
    
    if(validar_precio_cotizacion=="invalido"){
      mensage_cotizacion = 'Falta Completar Información en Precios. ';
    }
    if(validar_cantidad_cotizacion=="invalido"){
      mensage_cantidad_cotizacion = 'Atención Parcial del Pedido. ';
    }

    Swal.fire({
      title             : '¿Está seguro?',
      text              : mensage_cotizacion + mensage_cantidad_cotizacion + "Se recibe la Cotización Nro. " + cotizacion_id + " !!!",
      icon              : 'warning',
      showCancelButton  : true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor : '#d33',
      cancelButtonText  : 'Cancelar',
      confirmButtonText : 'Si, recibir!'
    }).then((result) => 
    {
      if (result.isConfirmed){
        array_material_cotizacion = tabla_material_cotizacion.rows().data().toArray();
        $("#btn_grabar_cerrar_cotizacion").prop("disabled",true);
        array_data = JSON.stringify(array_material_cotizacion);
        Accion = "editar_cotizacion";
        $.ajax({
          url: "Ajax.php",
          type: "POST",
          datatype:"json",
          async: false,
          data: {MoS:MoS,NombreMoS:NombreMoS,Accion:Accion, cotizacion_id:cotizacion_id, array_data:array_data},
          success: function(data){
            tabla_cotizacion.ajax.reload(null, false);
          }
        });
        $("#btn_grabar_cerrar_cotizacion").prop("disabled",false);
        Swal.fire({
          position: 'center',
          icon: 'success',
          title: 'El registro ha sido cerrado.',
          showConfirmButton: false,
          timer: 1500
        })
        $('#modal_crud_cerrar_cotizacion').modal('hide');
      }
    });  

  });
  ///:: FIN BOTON GRABAR CERRAR COTIZACION ::::::::::::::::::::::::::::::::::::::::::::::::///
  
  ///:: BOTON ADJUNTAR DOCUMENTOS EN PDF ::::::::::::::::::::::::::::::::::::::::::::::::::///
  $(document).on("click", ".btn_adjuntar_pdf", function(){
    $("#form_modal_cotizacion_pdf").trigger("reset");
    $("#div_label_cotizacion_pdf").show();
    $("#btn_guardar_cotizacion_pdf").show();
    fila_cotizacion = $(this).closest('tr'); 
    cotizacion_id   = fila_cotizacion.find('td:eq(0)').text();
    coti_estado     = fila_cotizacion.find('td:eq(4)').text();
    pedi_estado     = $("#pedi_estado").val();
    
    if(cotizacion_id!=""){
      let p_pdf;
      let buscar_pdf          = "";
      cotizacion_tipo_imagen  = "PDF";
      buscar_pdf              = f_buscar_pdf(cotizacion_id,cotizacion_tipo_imagen);
      if(buscar_pdf==""){
        p_pdf = '<iframe src="Module/Pedidos/View/Img/VistaPrevia.pdf" width="750" height="400"></iframe>';
        opcion_carga_pdf = 1; //CREAR nueva imagen
      }else{
        p_pdf = '<iframe src="' + buscar_pdf + '"  width="750" height="400"></iframe>';
        opcion_carga_pdf = 2; //EDITAR imagen
      }
      $(".modal-header").css( "background-color", "#17a2b8");
      $(".modal-header").css( "color", "white" );
      $(".modal-title").text("Carga de Archivo PDF");
      $("#div_cotizacion_pdf").html(p_pdf);
      $("#label_cotizacion_pdf").text("Seleccionar Archivo .pdf");
      
      if(pedi_estado=="CERRADO" || pedi_estado=="CANCELADO" || coti_estado=="CERRADO"){
        $("#div_label_cotizacion_pdf").hide();
        $("#btn_guardar_cotizacion_pdf").hide();
      }
      
      $('#modal_crud_otizacion_pdf').modal('show');
    }else{
      Swal.fire({
        icon: 'error',
        title: 'ID Código de Cotización...',
        text: 'Falta información para cargar el archivo!'
      })    
    }
  });
  ///:: FIN BOTON ADJUNTAR DOCUMENTOS EN PDF ::::::::::::::::::::::::::::::::::::::::::::::///

  ///:: BOTON GUARDAR PDF -> GRABACION EN LA TABLA manto_cotizacionesimagen :::::::::::::::///
  $('#form_modal_cotizacion_pdf').submit(function(e){
    e.preventDefault();
    f_grabar_pdf(opcion_carga_pdf);
    $('#modal_crud_otizacion_pdf').modal('hide');
  });
  ///:: FIN BOTON GUARDAR PDF -> GRABACION EN LA TABLA manto_cotizacionesimagen :::::::::::///

  ///:: EVENTO DEL BOTON CERRAR PEDIDO NO ATENDIDO ::::::::::::::::::::::::::::::::::::::::///
  $(document).on("click", ".btn_cerrar_pedido_no_atendido", function(){
    obs_cerrar_pedido_no_atendido = "";
    $("#form_modal_cerrar_pedido_no_atendido").trigger("reset");

    $("#obs_cerrar_pedido_no_atendido").val(obs_cerrar_pedido_no_atendido);
    $("#obs_cerrar_pedido_no_atendido").removeClass("color-error");
    $(".modal-header").css( "background-color", "#17a2b8");
    $(".modal-header").css( "color", "white" );
    $(".modal-title").text("Cerrar Pedido No Atendido");
    $('#modal_crud_cerrar_pedido_no_atendido').modal('show');
    $("#modal_crud_cerrar_pedido_no_atendido").draggable({});
  });
  ///:: FIN EVENTO DEL BOTON CERRAR PEDIDO NO ATENDIDO ::::::::::::::::::::::::::::::::::::///

  ///:: EVENTO DEL BOTON ACEPTAR CERRAR PEDIDO NO ATENDIDO ::::::::::::::::::::::::::::::::///
  $(document).on("click", ".btn_aceptar_cerrar_pedido_no_atendido", function(){
    $("#obs_cerrar_pedido_no_atendido").removeClass("color-error");
    $("#btn_aceptar_cerrar_pedido_no_atendido").prop("disabled",true);
    obs_cerrar_pedido_no_atendido = $("#obs_cerrar_pedido_no_atendido").val();
    if(obs_cerrar_pedido_no_atendido == ""){
      $("#obs_cerrar_pedido_no_atendido").addClass("color-error");
      Swal.fire({
        position          : 'center',
        icon              : 'error',
        title             : '*Falta Completar Información!!!',
        showConfirmButton : false,
        timer             : 1500
      })
    }else{
      pedi_estado     = "CERRADO";
      pedi_estado_obs = "NO ATENDIDO";
      Accion      = 'estado_pedido';
      $.ajax({
        url       : "Ajax.php",
        type      : "POST",
        datatype  :"json",
        async     : false,
        data      : {MoS:MoS,NombreMoS:NombreMoS,Accion:Accion, pedido_id:pedido_id, pedi_estado:pedi_estado, pedi_log:pedi_log, obs_log:obs_validar_pedido_directo, pedi_estado_obs:pedi_estado_obs},    
        success   : function(data){

        }
      });
      $("#pedi_estado").val(pedi_estado);
      div_show = f_MostrarDiv("form_seleccion_procesar_pedido","btn_seleccion_procesar_pedido",pedi_estado,"");
      $("#div_btn_seleccion_procesar_pedido").html(div_show);
      div_show = f_MostrarDiv("form_procesar_pedido","div_solicitar_cotizacion",pedi_estado,"");
      $("#div_solicitar_cotizacion").html(div_show);
      $("#div_solicitar_cotizacion").show();
      f_tabla_cotizacion();

      $('#modal_crud_cerrar_pedido_no_atendido').modal('hide');
    }
    $("#btn_aceptar_cerrar_pedido_no_atendido").prop("disabled",false);
  });
  ///:: FIN EVENTO DEL BOTON ACEPTAR CERRAR PEDIDO NO ATENDIDO ::::::::::::::::::::::::::::///

  ///:: TERMINO BOTONES PROCESAR COTIZACION :::::::::::::::::::::::::::::::::::::::::::::::///
});
///:: TERMINO JS DOM PROCESAR COTIZACION ::::::::::::::::::::::::::::::::::::::::::::::::::///


///:: INICIO FUNCIONES PROCESAR COTIZACION ::::::::::::::::::::::::::::::::::::::::::::::::///

///:: VALIDAR CERRAR COTIZACION :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
function f_valida_cerrar_cotizacion(p_pedi_estado, p_coti_estado){
  let rpta_valida_cerrar_cotizacion = "";
  Accion='valida_cerrar_cotizacion';
  $.ajax({
      url       : "Ajax.php",
      type      : "POST",
      datatype  : "json",    
      async     : false,   
      data      :  { MoS:MoS,NombreMoS:NombreMoS,Accion:Accion, pedi_estado:p_pedi_estado, coti_estado:p_coti_estado },   
      success   : function(data) {
        rpta_valida_cerrar_cotizacion = data;
      }
  });	
  return rpta_valida_cerrar_cotizacion;
}
///:: FIN VALIDAR CERRAR COTIZACION :::::::::::::::::::::::::::::::::::::::::::::::::::::::///

///:: GENERACION DE TABLA DE DETALLE DE COTIZACION ::::::::::::::::::::::::::::::::::::::::///
function f_tabla_cotizacion(){
  div_tabla = f_CreacionTabla("tabla_cotizacion","");
  $("#div_tabla_cotizacion").html(div_tabla);
  columnastabla = f_ColumnasTabla("tabla_cotizacion","");

  $("#tabla_cotizacion").dataTable().fnDestroy();
  $('#tabla_cotizacion').show();
  Accion = 'cargar_cotizacion';

  tabla_cotizacion = $('#tabla_cotizacion').DataTable({
    language    : idiomaEspanol,
    searching   : false,
    info        : false,
    lengthChange: true,
    fixedColumns: true,
    pageLength  : 10,
    responsive  : "true",
    "ajax":{            
      "url"     : "Ajax.php", 
      "method"  : 'POST',
      "data"    :{ MoS:MoS, NombreMoS:NombreMoS, Accion:Accion, coti_pedidoid:pedido_id },
      "dataSrc" : ""
    },
    columns     : columnastabla,
    columnDefs  :[
      {
        width   : "500",
        targets : 2
      }  
    ]
  });
}
///:: FIN GENERACION DE TABLA DE DETALLE DE COTIZACIONES ::::::::::::::::::::::::::::::::::///
  
///:: FUNCION GRABAR IMAGEN :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
function f_grabar_pdf(p_opcion_carga_pdf){
    let blobFile;
    let formData = new FormData();
    blobFile = $('#cotizacion_pdf')[0].files[0];
    $("#btn_guardar_cotizacion_pdf").prop("disabled",true);
  
    if(p_opcion_carga_pdf==1){
      Accion = 'grabar_imagen';
    }else{
      Accion = 'editar_imagen';
    }
  
    formData.append("MoS", MoS);
    formData.append("NombreMoS", NombreMoS);
    formData.append("Accion", Accion);
    formData.append("cotizacion_id", cotizacion_id);
    formData.append("cotizacion_imagen", blobFile);
  
    $.ajax({
        url         : "Ajax.php",
        type        : "POST",
        datatype    : "json",    
        data        :  formData,   
        contentType :false,
        processData :false,
        success     : function(data) {
          $("#btn_guardar_cotizacion_pdf").prop("disabled",false);
        }
    });	
}
///:: FIN FUNCION GRABAR IMAGEN :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
  
///:::::::::::::::::::::::::::::: FUNCION BUSCAR PDF ::::::::::::::::::::::::::::::::::::::///       
function f_buscar_pdf(pcotizacion_id, pcotizacion_tipo_imagen){
  let pdf="";
  $("#btn_adjuntar_pdf").prop("disabled",true);
  Accion='buscar_imagen';
  $.ajax({
      url       : "Ajax.php",
      type      : "POST",
      datatype  : "json",    
      async     : false,   
      data      :  { MoS:MoS,NombreMoS:NombreMoS,Accion:Accion, cotimag_cotizacionid:pcotizacion_id, cotimag_tipoimagen:pcotizacion_tipo_imagen },   
      success   : function(data) {
          data = $.parseJSON(data);
          $.each(data, function(idx, obj){ 
              if(obj.b64_Foto){
                  pdf  = 'data:application/pdf;base64,' + obj.b64_Foto;
                  $("#btn_adjuntar_pdf").prop("disabled",false);
              }
          });
      }
  });	
  return pdf;
}
///:::::::::::::::::::::::::::: FIN FUNCION BUSCAR PDF ::::::::::::::::::::::::::::::::::::///

///:: TERMINO FUNCIONES PROCESAR COTIZACION :::::::::::::::::::::::::::::::::::::::::::::::///
