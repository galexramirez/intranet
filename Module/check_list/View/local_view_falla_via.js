///::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
///:: OBSERVACIONES CHECK LIST FLOTA v 1.0 ::::::::::::::::::::::::::::::::::::::::::::::::///
///:: DETALLE DE OBSERVACIONES DE CHECK LIST ::::::::::::::::::::::::::::::::::::::::::::::///
///::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///

///:: DECLARACIONES DE VARIABLES GLOBALES :::::::::::::::::::::::::::::::::::::::::::::::::///
var fav_check_list_id, fav_chl_bus_tipo, fav_chl_novedad_id, fav_chl_descripcion_novedad, fav_chl_codigo, fav_chl_descripcion_codigo, fav_chl_componente, fav_chl_posicion, fav_chl_falla, fav_chl_accion;
var array_falla_via, fila_check_list_falla_via, tabla_check_list_falla_via, fav_fila_falla_via;

///:: JS DOM REGISTRO INSPECCION FLOTA ::::::::::::::::::::::::::::::::::::::::::::::::::::///
$(document).ready(function(){
  let select_chl_fav='', contar_componente_fav='', contar_posicion_fav='', contar_falla_fav='', contar_accion_fav='';
  fav_chl_bus_tipo = "";
  array_falla_via = [];

  /*
  $("#fav_chl_novedad_id").on('change', function () {
    fav_chl_novedad_id = $("#fav_chl_novedad_id").val();
    fav_chl_descripcion_novedad = f_buscar_dato("OPE_Novedad","Nove_Descripcion","`Novedad_Id`='"+fav_chl_novedad_id+"'");
    fav_chl_codigo = "";
    fav_chl_descripcion_codigo = "";
    fav_chl_componente = "";
    fav_chl_posicion = "";
    fav_chl_falla = "";
    fav_chl_accion = "";

    select_chl_fav = f_select_combo("manto_falla_via_componente","NO","fav_componente","","`fav_bus_tipo`='"+fav_chl_bus_tipo+"' AND `fav_codigo`='"+fav_chl_codigo+"'","`fav_componente`");
    $("#fav_chl_componente").html(select_chl_fav);

    select_chl_fav = f_select_combo("manto_falla_via_posicion","NO","fav_posicion","","`fav_bus_tipo`='"+fav_chl_bus_tipo+"' AND `fav_codigo`='"+fav_chl_codigo+"' AND `fav_componente`='"+fav_chl_componente+"'","`fav_posicion`");
    $("#fav_chl_posicion").html(select_chl_fav);

    select_chl_fav = f_select_combo("manto_falla_via_falla_accion","SI","fav_falla","","`fav_bus_tipo`='"+fav_chl_bus_tipo+"' AND `fav_codigo`='"+fav_chl_codigo+"' AND `fav_componente`='"+fav_chl_componente+"'","`fav_falla`");
    $("#fav_chl_falla").html(select_chl_fav);

    select_chl_fav = f_select_combo("manto_falla_via_falla_accion","NO","fav_accion","","`fav_bus_tipo`='"+fav_chl_bus_tipo+"' AND `fav_codigo`='"+fav_chl_codigo+"' AND `fav_componente`='"+fav_chl_componente+"' AND `fav_falla`='"+fav_chl_falla+"'","`fav_accion`");
    $("#fav_chl_accion").html(select_chl_fav);
 
    $("#fav_chl_descripcion_novedad").val(fav_chl_descripcion_novedad);
    $("#fav_chl_codigo").val(fav_chl_codigo);
    $("#fav_chl_descripcion_codigo").val(fav_chl_descripcion_codigo);
    $("#fav_chl_componente").val(fav_chl_componente);
    $("#fav_chl_posicion").val(fav_chl_posicion);
    $("#fav_chl_falla").val(fav_chl_falla);
    $("#fav_chl_accion").val(fav_chl_accion);
  });
  */

  ///:: CONSULTA DE CODIGO DE FALLA EN VIA ::::::::::::::::::::::::::::::::::::::::::::::::///
  $("#fav_chl_codigo").on('change', function () {
    $("#fav_chl_componente").prop("disabled",false);
    $("#fav_chl_posicion").prop("disabled",false);
    $("#fav_chl_falla").prop("disabled",false);
    $("#fav_chl_accion").prop("disabled",false);
    fav_chl_codigo = $("#fav_chl_codigo").val();
    fav_chl_descripcion_codigo = f_buscar_dato("manto_falla_via_codigo","fav_descripcion","`fav_bus_tipo`='"+fav_chl_bus_tipo+"' AND `fav_codigo`='"+fav_chl_codigo+"'");
    contar_componente_fav = f_contar_dato("manto_falla_via_componente","fav_componente","`fav_bus_tipo`='"+fav_chl_bus_tipo+"' AND `fav_codigo`='"+fav_chl_codigo+"'");
    fav_chl_componente = "";
    fav_chl_posicion = "";
    fav_chl_falla = "";
    fav_chl_accion = "";

    if(contar_componente_fav=="1"){
      fav_chl_componente = f_buscar_dato("manto_falla_via_componente","fav_componente","`fav_bus_tipo`='"+fav_chl_bus_tipo+"' AND `fav_codigo`='"+fav_chl_codigo+"'");
      $("#fav_chl_posicion").focus().select();
      $("#fav_chl_componente").prop("disabled",true);
    }else{
      fav_chl_componente = '';
    }

    select_chl_fav = f_select_combo("manto_falla_via_componente","NO","fav_componente","","`fav_bus_tipo`='"+fav_chl_bus_tipo+"' AND `fav_codigo`='"+fav_chl_codigo+"'","`fav_componente`");
    $("#fav_chl_componente").html(select_chl_fav);

    contar_posicion_fav = f_contar_dato("manto_falla_via_posicion","fav_posicion","`fav_bus_tipo`='"+fav_chl_bus_tipo+"' AND `fav_codigo`='"+fav_chl_codigo+"' AND `fav_componente`='"+fav_chl_componente+"'");

    if(contar_componente_fav=="1" && contar_posicion_fav=="1"){
      fav_chl_posicion = f_buscar_dato("manto_falla_via_posicion","fav_posicion","`fav_bus_tipo`='"+fav_chl_bus_tipo+"' AND `fav_codigo`='"+fav_chl_codigo+"' AND `fav_componente`='"+fav_chl_componente+"'");
      $("#fav_chl_falla").focus().select();
      $("#fav_chl_posicion").prop("disabled",true);
    }else{
      fav_chl_posicion = '';
    }

    select_chl_fav = f_select_combo("manto_falla_via_posicion","NO","fav_posicion","","`fav_bus_tipo`='"+fav_chl_bus_tipo+"' AND `fav_codigo`='"+fav_chl_codigo+"' AND `fav_componente`='"+fav_chl_componente+"'","`fav_posicion`");
    $("#fav_chl_posicion").html(select_chl_fav);

    contar_falla_fav = f_contar_dato("manto_falla_via_falla_accion","fav_falla","`fav_bus_tipo`='"+fav_chl_bus_tipo+"' AND `fav_codigo`='"+fav_chl_codigo+"' AND `fav_componente`='"+fav_chl_componente+"'");

    if(contar_componente_fav=="1" && contar_posicion_fav=="1" && contar_falla_fav=="1"){
      fav_chl_falla = f_buscar_dato("manto_falla_via_falla_accion","fav_falla","`fav_bus_tipo`='"+fav_chl_bus_tipo+"' AND `fav_codigo`='"+fav_chl_codigo+"' AND `fav_componente`='"+fav_chl_componente+"'");
      $("#fav_chl_accion").focus().select();
      $("#fav_chl_falla").prop("disabled",true);   
    }else{
      fav_chl_falla = "";
    }

    select_chl_fav = f_select_combo("manto_falla_via_falla_accion","SI","fav_falla","","`fav_bus_tipo`='"+fav_chl_bus_tipo+"' AND `fav_codigo`='"+fav_chl_codigo+"' AND `fav_componente`='"+fav_chl_componente+"'","`fav_falla`");
    $("#fav_chl_falla").html(select_chl_fav);

    contar_accion_fav = f_contar_dato("manto_falla_via_falla_accion","fav_accion","`fav_bus_tipo`='"+fav_chl_bus_tipo+"' AND `fav_codigo`='"+fav_chl_codigo+"' AND `fav_componente`='"+fav_chl_componente+"' AND `fav_falla`='"+fav_chl_falla+"'");

    if(contar_componente_fav=="1" && contar_posicion_fav=="1" && contar_falla_fav=="1" && contar_accion_fav=="1"){
      fav_chl_accion = f_buscar_dato("manto_falla_via_falla_accion","fav_accion","`fav_bus_tipo`='"+fav_chl_bus_tipo+"' AND `fav_codigo`='"+fav_chl_codigo+"' AND `fav_componente`='"+fav_chl_componente+"' AND `fav_falla`='"+fav_chl_falla+"'");
      $("#btn_check_list_registrar_falla_via").focus().select();
      $("#fav_chl_accion").prop("disabled",true);
    }else{
      fav_chl_accion = "";
    }

    select_chl_fav = f_select_combo("manto_falla_via_falla_accion","NO","fav_accion","","`fav_bus_tipo`='"+fav_chl_bus_tipo+"' AND `fav_codigo`='"+fav_chl_codigo+"' AND `fav_componente`='"+fav_chl_componente+"' AND `fav_falla`='"+fav_chl_falla+"'","`fav_accion`");
    $("#fav_chl_accion").html(select_chl_fav);

    $("#fav_chl_descripcion_codigo").val(fav_chl_descripcion_codigo);
    $("#fav_chl_componente").val(fav_chl_componente);
    $("#fav_chl_posicion").val(fav_chl_posicion);
    $("#fav_chl_falla").val(fav_chl_falla);
    $("#fav_chl_accion").val(fav_chl_accion);
  });
  ///:: FIN CONSULTA DE CODIGO DE FALLA EN VIA ::::::::::::::::::::::::::::::::::::::::::::///

  ///:: CONSULTA DE COMPONENTE DE FALLA EN VIA ::::::::::::::::::::::::::::::::::::::::::::///
  $("#fav_chl_componente").on('change', function () {
    $("#fav_chl_posicion").prop("disabled",false);
    $("#fav_chl_falla").prop("disabled",false);
    $("#fav_chl_accion").prop("disabled",false);
    fav_chl_componente = $("#fav_chl_componente").val();
    contar_posicion_fav = f_contar_dato("manto_falla_via_posicion","fav_posicion","`fav_bus_tipo`='"+fav_chl_bus_tipo+"' AND `fav_codigo`='"+fav_chl_codigo+"' AND `fav_componente`='"+fav_chl_componente+"'");
    fav_chl_falla = "";
    fav_chl_accion = "";

    if(contar_posicion_fav=="1"){
      fav_chl_posicion = f_buscar_dato("manto_falla_via_posicion","fav_posicion","`fav_bus_tipo`='"+fav_chl_bus_tipo+"' AND `fav_codigo`='"+fav_chl_codigo+"' AND `fav_componente`='"+fav_chl_componente+"'");
      $("#fav_chl_falla").focus().select();
      $("#fav_chl_posicion").prop("disabled",true);
    }else{
      fav_chl_posicion = '';
    }

    select_chl_fav = f_select_combo("manto_falla_via_posicion","NO","fav_posicion","","`fav_bus_tipo`='"+fav_chl_bus_tipo+"' AND `fav_codigo`='"+fav_chl_codigo+"' AND `fav_componente`='"+fav_chl_componente+"'","`fav_posicion`");
    $("#fav_chl_posicion").html(select_chl_fav);

    contar_falla_fav = f_contar_dato("manto_falla_via_falla_accion","fav_falla","`fav_bus_tipo`='"+fav_chl_bus_tipo+"' AND `fav_codigo`='"+fav_chl_codigo+"' AND `fav_componente`='"+fav_chl_componente+"'");

    if(contar_posicion_fav=="1" && contar_falla_fav=="1"){
      fav_chl_falla = f_buscar_dato("manto_falla_via_falla_accion","fav_falla","`fav_bus_tipo`='"+fav_chl_bus_tipo+"' AND `fav_codigo`='"+fav_chl_codigo+"' AND `fav_componente`='"+fav_chl_componente+"'");
      $("#fav_chl_accion").focus().select();
      $("#fav_chl_falla").prop("disabled",true);   
    }else{
      fav_chl_falla = "";
    }

    select_chl_fav = f_select_combo("manto_falla_via_falla_accion","SI","fav_falla","","`fav_bus_tipo`='"+fav_chl_bus_tipo+"' AND `fav_codigo`='"+fav_chl_codigo+"' AND `fav_componente`='"+fav_chl_componente+"'","`fav_falla`");
    $("#fav_chl_falla").html(select_chl_fav);

    contar_accion_fav = f_contar_dato("manto_falla_via_falla_accion","fav_accion","`fav_bus_tipo`='"+fav_chl_bus_tipo+"' AND `fav_codigo`='"+fav_chl_codigo+"' AND `fav_componente`='"+fav_chl_componente+"' AND `fav_falla`='"+fav_chl_falla+"'");

    if(contar_posicion_fav=="1" && contar_falla_fav=="1" && contar_accion_fav=="1"){
      fav_chl_accion = f_buscar_dato("manto_falla_via_falla_accion","fav_accion","`fav_bus_tipo`='"+fav_chl_bus_tipo+"' AND `fav_codigo`='"+fav_chl_codigo+"' AND `fav_componente`='"+fav_chl_componente+"' AND `fav_falla`='"+fav_chl_falla+"'");
      $("#btn_check_list_registrar_falla_via").focus().select();
      $("#fav_chl_accion").prop("disabled",true);
    }else{
      fav_chl_accion = "";
    }

    select_chl_fav = f_select_combo("manto_falla_via_falla_accion","NO","fav_accion","","`fav_bus_tipo`='"+fav_chl_bus_tipo+"' AND `fav_codigo`='"+fav_chl_codigo+"' AND `fav_componente`='"+fav_chl_componente+"' AND `fav_falla`='"+fav_chl_falla+"'","`fav_accion`");
    $("#fav_chl_accion").html(select_chl_fav);

    $("#fav_chl_posicion").val(fav_chl_posicion);
    $("#fav_chl_falla").val(fav_chl_falla);
    $("#fav_chl_accion").val(fav_chl_accion);
  });
  ///:: FIN CONSULTA DE COMPONENTE DE FALLA EN VIA ::::::::::::::::::::::::::::::::::::::::///

  ///:: CONSULTA DE POSICION DE FALLA EN VIA ::::::::::::::::::::::::::::::::::::::::::::::///
  $("#fav_chl_posicion").on('change', function (){
    $("#fav_chl_falla").prop("disabled",false);
    $("#fav_chl_accion").prop("disabled",false);
    fav_chl_accion = "";
    
    contar_falla_fav = f_contar_dato("manto_falla_via_falla_accion","fav_falla","`fav_bus_tipo`='"+fav_chl_bus_tipo+"' AND `fav_codigo`='"+fav_chl_codigo+"' AND `fav_componente`='"+fav_chl_componente+"'");
    
    if(contar_falla_fav=="1"){
      fav_chl_falla = f_buscar_dato("manto_falla_via_falla_accion","fav_falla","`fav_bus_tipo`='"+fav_chl_bus_tipo+"' AND `fav_codigo`='"+fav_chl_codigo+"' AND `fav_componente`='"+fav_chl_componente+"'");
      $("#fav_chl_accion").focus().select();
      $("#fav_chl_falla").prop("disabled",true);   
    }else{
      fav_chl_falla = "";
    }

    select_chl_fav = f_select_combo("manto_falla_via_falla_accion","NO","fav_accion","","`fav_bus_tipo`='"+fav_chl_bus_tipo+"' AND `fav_codigo`='"+fav_chl_codigo+"' AND `fav_componente`='"+fav_chl_componente+"' AND `fav_falla`='"+fav_chl_falla+"'","`fav_accion`");
    $("#fav_chl_accion").html(select_chl_fav);

    contar_accion_fav = f_contar_dato("manto_falla_via_falla_accion","fav_accion","`fav_bus_tipo`='"+fav_chl_bus_tipo+"' AND `fav_codigo`='"+fav_chl_codigo+"' AND `fav_componente`='"+fav_chl_componente+"' AND `fav_falla`='"+fav_chl_falla+"'");

    if(contar_falla_fav=="1" && contar_accion_fav=="1"){
      fav_chl_accion = f_buscar_dato("manto_falla_via_falla_accion","fav_accion","`fav_bus_tipo`='"+fav_chl_bus_tipo+"' AND `fav_codigo`='"+fav_chl_codigo+"' AND `fav_componente`='"+fav_chl_componente+"' AND `fav_falla`='"+fav_chl_falla+"'");
      $("#btn_check_list_registrar_falla_via").focus().select();
      $("#fav_chl_accion").prop("disabled",true);
    }else{
      fav_chl_accion = "";
    }

    select_chl_fav = f_select_combo("manto_falla_via_falla_accion","NO","fav_accion","","`fav_bus_tipo`='"+fav_chl_bus_tipo+"' AND `fav_codigo`='"+fav_chl_codigo+"' AND `fav_componente`='"+fav_chl_componente+"' AND `fav_falla`='"+fav_chl_falla+"'","`fav_accion`");

    $("#fav_chl_falla").val(fav_chl_falla);
    $("#fav_chl_accion").val(fav_chl_accion);
  })
  ///:: FIN CONSULTA DE POSICION DE FALLA EN VIA ::::::::::::::::::::::::::::::::::::::::::///

  ///:: CONSULTA DE FALLA EN VIA ::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
  $("#fav_chl_falla").on('change', function (){
    $("#fav_chl_accion").prop("disabled",false);
    fav_chl_falla = $("#fav_chl_falla").val();
    contar_accion_fav = f_contar_dato("manto_falla_via_falla_accion","fav_accion","`fav_bus_tipo`='"+fav_chl_bus_tipo+"' AND `fav_codigo`='"+fav_chl_codigo+"' AND `fav_componente`='"+fav_chl_componente+"' AND `fav_falla`='"+fav_chl_falla+"'");

    select_chl_fav = f_select_combo("manto_falla_via_falla_accion","NO","fav_accion","","`fav_bus_tipo`='"+fav_chl_bus_tipo+"' AND `fav_codigo`='"+fav_chl_codigo+"' AND `fav_componente`='"+fav_chl_componente+"' AND `fav_falla`='"+fav_chl_falla+"'","`fav_accion`");
    $("#fav_chl_accion").html(select_chl_fav);

    if(contar_accion_fav=="1"){
      fav_chl_accion = f_buscar_dato("manto_falla_via_falla_accion","fav_accion","`fav_bus_tipo`='"+fav_chl_bus_tipo+"' AND `fav_codigo`='"+fav_chl_codigo+"' AND `fav_componente`='"+fav_chl_componente+"' AND `fav_falla`='"+fav_chl_falla+"'");
      $("#btn_check_list_registrar_falla_via").focus().select();
      $("#fav_chl_accion").prop("disabled",true);
    }else{
      fav_chl_accion = "";
    }

    $("#fav_chl_accion").val(fav_chl_accion);
  })
  ///:: FIN CONSULTA DE FALLA EN VIA ::::::::::::::::::::::::::::::::::::::::::::::::::::::///

  ///:: INICIO BOTONES DE INSPECCION REGISTRO :::::::::::::::::::::::::::::::::::::::::::::///

  ///:: BOTON NUEVA OBSERVACION DE CHECK LIST DE FLOTA ::::::::::::::::::::::::::::::::::::///
  $(document).on("click", ".btn_editar_check_list_falla_via", function(){
      $("#form_check_list_registro_falla_via").trigger("reset");
      fav_fila_falla_via = $(this); 
      chl_fecha = $("#chl_fecha").val();
      chl_bus = $("#chl_bus").val();
      f_limpia_falla_via();
      select_chl_fav = f_select_combo("manto_falla_via_codigo", "NO", "fav_codigo", "", "`fav_bus_tipo`='"+fav_chl_bus_tipo+"'","`fav_codigo`");
      $("#fav_chl_codigo").html(select_chl_fav);

      fav_check_list_id = check_list_id;
      fav_chl_novedad_id = fav_fila_falla_via.closest('tr').find('td:eq(0)').text();
      fav_chl_descripcion_novedad = fav_fila_falla_via.closest('tr').find('td:eq(1)').text();
      fav_chl_codigo = fav_fila_falla_via.closest('tr').find('td:eq(2)').text();
      fav_chl_descripcion_codigo = fav_fila_falla_via.closest('tr').find('td:eq(3)').text();
      fav_chl_componente = fav_fila_falla_via.closest('tr').find('td:eq(4)').text();
      fav_chl_posicion = fav_fila_falla_via.closest('tr').find('td:eq(5)').text();
      fav_chl_falla = fav_fila_falla_via.closest('tr').find('td:eq(6)').text();
      fav_chl_accion = fav_fila_falla_via.closest('tr').find('td:eq(7)').text();
      
      $("#fav_chl_codigo").prop("disabled",false);
      $("#fav_chl_componente").prop("disabled",false);
      $("#fav_chl_posicion").prop("disabled",false);
      $("#fav_chl_falla").prop("disabled",false);
      $("#fav_chl_accion").prop("disabled",false);

      $("#fav_chl_novedad_id").val(fav_chl_novedad_id);
      $("#fav_chl_descripcion_novedad").val(fav_chl_descripcion_novedad);
      $("#fav_chl_codigo").val(fav_chl_codigo);
      $("#fav_chl_descripcion_codigo").val(fav_chl_descripcion_codigo);
      $("#fav_chl_componente").val(fav_chl_componente);
      $("#fav_chl_posicion").val(fav_chl_posicion);
      $("#fav_chl_falla").val(fav_chl_falla);
      $("#fav_chl_accion").val(fav_chl_accion);
      $("#fav_chl_codigo").focus().select();
    
      
      $(".modal-header").css( "background-color", "#17a2b8");
      $(".modal-header").css( "color", "white" );
      $(".modal-title").text( "Alta de Fallas en Vía" );
      $('#modal_crud_check_list_registro_falla_via').modal('show');
  });
  ///:: FIN BOTON AGREGAR NUEVA INSPECCION COMPONENTE Y POSICION DE FLOTA :::::::::::::::::///
  
  ///:: BOTON AGREGAR NUEVA INSPECCION COMPONENTE Y POSICION DE FLOTA :::::::::::::::::::::///
  $(document).on("click", ".btn_check_list_registrar_falla_via", function(){
    let array_valida_falla_via = [];
    let valida_agregar_fav  = '';
    let t_msg = '';

    fav_chl_novedad_id  = $.trim($('#fav_chl_novedad_id').val());
    fav_chl_descripcion_novedad = $.trim($('#fav_chl_descripcion_novedad').val());
    fav_chl_codigo      = $.trim($('#fav_chl_codigo').val());
    fav_chl_descripcion_codigo = $.trim($('#fav_chl_descripcion_codigo').val());
    fav_chl_componente  = $.trim($('#fav_chl_componente').val());
    fav_chl_posicion    = $.trim($('#fav_chl_posicion').val());    
    fav_chl_falla       = $.trim($('#fav_chl_falla').val());
    fav_chl_accion      = $.trim($('#fav_chl_accion').val());

    valida_agregar_fav  = f_valida_agregar_falla_via(fav_chl_novedad_id, fav_chl_codigo, fav_chl_descripcion_codigo, fav_chl_componente, fav_chl_posicion, fav_chl_falla, fav_chl_accion);
    if(valida_agregar_fav == "invalido"){
      t_msg += 'Falta Completar Información!!!';
    }
    array_valida_falla_via = tabla_check_list_falla_via.rows().data().toArray();

    if(valida_agregar_fav == "invalido"){
      Swal.fire({
        position            : 'center',
        icon                : 'error',
        title               : t_msg,
        showConfirmButton   : false,
        timer               : 1500
      })
    }else{
      $("#btn_check_list_registrar_falla_via").prop("disabled",true);

      tabla_check_list_falla_via
      .row( fav_fila_falla_via.parents('tr') )
      .remove()
      .draw();

      tabla_check_list_falla_via.row.add( {
        "fav_novedad_id" : fav_chl_novedad_id,
        "fav_descripcion_novedad" : fav_chl_descripcion_novedad,
        "fav_codigo"     : fav_chl_codigo,
        "fav_descripcion_codigo": fav_chl_descripcion_codigo,
        "fav_componente" : fav_chl_componente,
        "fav_posicion"   : fav_chl_posicion,
        "fav_falla"      : fav_chl_falla,
        "fav_accion"     : fav_chl_accion
      } ).draw();

      $("#btn_check_list_registrar_falla_via").prop("disabled",false);
      $('#modal_crud_check_list_registro_falla_via').modal('hide');
    }
  });
  ///:: FIN BOTON AGREGAR NUEVA INSPECCION COMPONENTE Y POSICION DE FLOTA :::::::::::::::::///

  ///:: BOTON BORRAR INSPECCION COMPONENTE Y POSICION :::::::::::::::::::::::::::::::::::::///
  $(document).on("click", ".btn_borrar_check_list_falla_via", function(){
    fila_check_list_falla_via = $(this); 
    fav_chl_novedad_id = fila_check_list_falla_via.closest('tr').find('td:eq(0)').text();
    fav_chl_codigo     = fila_check_list_falla_via.closest('tr').find('td:eq(1)').text();
    fav_chl_componente = fila_check_list_falla_via.closest('tr').find('td:eq(3)').text();
    Swal.fire({
      title: '¿Está seguro?',
      text: "Se eliminará el registro Novedad Id: "+fav_chl_novedad_id+" Código: "+fav_chl_codigo+" Componente : "+fav_chl_componente+" !!!",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Si, eliminar!'
    }).then((result) => 
    {
      if (result.isConfirmed){
        tabla_check_list_falla_via
        .row( fila_check_list_falla_via.parents('tr') )
        .remove()
        .draw();
        Swal.fire(
          'Eliminado!',
          'El registro ha sido elimidado.',
          'success')
      }
    });
  });
  ///:: FIN BORRAR INSPECCION COMPONENTE Y POSICION :::::::::::::::::::::::::::::::::::::::///

  ///:: TERMINO BOTONES DE INSPECCION REGISTRO ::::::::::::::::::::::::::::::::::::::::::::///
});
///:: FUNCIONES REGISTRO DE INSPECCION DE FLOTA :::::::::::::::::::::::::::::::::::::::::::///

///:: FUNCION PARA VALIDAR LOS DATOS INGRESADOS AL FORMULARIO :::::::::::::::::::::::::::::///
function f_valida_agregar_falla_via(p_fav_chl_novedad_id, p_fav_chl_codigo, p_fav_chl_descripcion_codigo, p_fav_chl_componente, p_fav_chl_posicion, p_fav_chl_falla, p_fav_chl_accion){
  f_limpia_falla_via();
  let rpta_valida_agregar_falla_via = "";
  if(p_fav_chl_novedad_id==""){
    $("#fav_chl_novedad_id").addClass("color-error");
    rpta_valida_agregar_falla_via = "invalido";
  }
  if(p_fav_chl_codigo==""){
    $("#fav_chl_codigo").addClass("color-error");
    rpta_valida_agregar_falla_via = "invalido";
  }
  if(p_fav_chl_descripcion_codigo==""){
    $("#fav_chl_descripcion_codigo").addClass("color-error");
    rpta_valida_agregar_falla_via = "invalido";
  }
  if(p_fav_chl_componente==""){
    $("#fav_chl_componente").addClass("color-error");
    rpta_valida_agregar_falla_via = "invalido";
  }
  if(p_fav_chl_posicion==""){
    $("#fav_chl_posicion").addClass("color-error");
    rpta_valida_agregar_falla_via = "invalido";
  }
  if(p_fav_chl_falla==""){
    $("#fav_chl_falla").addClass("color-error");
    rpta_valida_agregar_falla_via = "invalido";
  }
  if(p_fav_chl_accion==""){
    $("#fav_chl_accion").addClass("color-error");
    rpta_valida_agregar_falla_via = "invalido";
  }
  return rpta_valida_agregar_falla_via;
}
///:: FUNCION PARA VALIDAR LOS DATOS INGRESADOS AL FORMULARIO :::::::::::::::::::::::::::::///

///:: REESTABLECE EL COLOR DE LOS CAMPOS INVALIDOS ::::::::::::::::::::::::::::::::::::::::/// 
function f_limpia_falla_via(){
  $("#fav_chl_novedad_id").removeClass("color-error");
  $("#fav_chl_codigo").removeClass("color-error");
  $("#fav_chl_descripcion_codigo").removeClass("color-error");
  $("#fav_chl_componente").removeClass("color-error");
  $("#fav_chl_posicion").removeClass("color-error");
  $("#fav_chl_falla").removeClass("color-error");
  $("#fav_chl_accion").removeClass("color-error");
}
///:: FIN REESTABLECE EL COLOR DE LOS CAMPOS INVALIDOS ::::::::::::::::::::::::::::::::::::///

///:: GENERACION DE TABLA DE OBSERVACIONES CHECK LIST :::::::::::::::::::::::::::::::::::::///
function f_tabla_check_list_falla_via(p_check_list_id, p_chl_estado){
  let array_data = [];
  array_falla_via = [];
  div_tabla = f_CreacionTabla("tabla_check_list_falla_via",p_chl_estado);
  $("#div_tabla_check_list_falla_via").html(div_tabla);
  columnas_tabla = f_ColumnasTabla("tabla_check_list_falla_via",p_chl_estado);

  $("#tabla_check_list_falla_via").dataTable().fnDestroy();
  $('#tabla_check_list_falla_via').show();

  array_data = f_BuscarDataBD('manto_check_list_falla_via','check_list_id',p_check_list_id);
  if(array_data.length==0){
    array_data = [];
    array_data = f_buscar_data_bd("OPE_Novedad", "`Nove_FechaOperacion`='"+chl_fecha+"' AND `Nove_Bus`='"+chl_bus+"' AND `Nove_TipoNovedad` IN ('FALLA_COMUNICACION', 'FALLA_TELEMETRIA','FALLA_BUS' )");
    console.log(array_data);
    if(array_data.length>0){
      array_data.forEach(obj => {
        array_falla_via.push({fav_novedad_id : obj.Novedad_Id, fav_descripcion_novedad : obj.Nove_Descripcion, fav_codigo : '', fav_descripcion_codigo : '', fav_componente : '', fav_posicion : '', fav_falla : '', fav_accion : ''});
      });  
    }
  }else{
    array_falla_via = array_data;
  }
  
  tabla_check_list_falla_via = $('#tabla_check_list_falla_via').DataTable({
    language      : idioma_espanol,
    searching     : true,
    info          : true,
    lengthChange  : true,
    paging        : true,
    pageLength    : 25,
    responsive    : "true",
    data          : array_falla_via,
    columns       : columnas_tabla
  });    
}
///:: FIN GENERACION DE TABLA DE OBSERVACIONES CHECK LIST :::::::::::::::::::::::::::::::::///

///:: TERMINO FUNCIONES REGISTRO DE INSPECCION DE FLOTA :::::::::::::::::::::::::::::::::::///