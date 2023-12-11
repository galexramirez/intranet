///::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
///:: NOVEDAD REGULAR v 1.0 FECHA: 2023-12-08 :::::::::::::::::::::::::::::::::::::::::::::///
///:: CREAR NOVEDAD REGULAR :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
///::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///

///:: DECLARACION DE VARIABLES ::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
var select_novedad;
var nreg_descripcion, nreg_operacion, nreg_bus, nreg_componente, nreg_posicion, nreg_falla, nreg_accion;

///:: JS DOM NOVEDADES MANTENIMIENTO ::::::::::::::::::::::::::::::::::::::::::::::::::::::///
$(document).ready(function(){
  $("#nreg_operacion").on('change', function () {
    $("#nreg_posicion").prop("disabled",false);
    $("#nreg_falla").prop("disabled",false);
    $("#nreg_accion").prop("disabled",false);    

    bus_tipo = "";
    nreg_operacion = $("#nreg_operacion").val();
    if(nreg_operacion=="TRONCAL"){
      bus_tipo = "ARTICULADO"; 
    }
    if(nreg_operacion=="ALIMENTADOR"){
      bus_tipo = "ALIMENTADOR"; 
    }
    nreg_bus = "";
    nreg_descripcion = "";
    nreg_componente = "";
    nreg_posicion = "";
    nreg_falla = "";
    nreg_accion = "";

    select_novedad = f_select_combo("Buses","NO","Bus_NroExterno","","`Bus_Estado`='DISPONIBLE' AND `Bus_Tipo`='UNIDAD' AND `Bus_Operacion`='"+nreg_operacion+"'","`Bus_NroExterno` ASC");
    $("#nreg_bus").html(select_novedad);
    select_novedad = f_select_combo("manto_check_list_componente","NO","chl_componente","","`chl_bus_tipo`='"+bus_tipo+"'","`chl_componente` ASC");
    $("#nreg_componente").html(select_novedad);
    select_novedad = f_select_combo("manto_check_list_posicion","NO","chl_posicion","","`chl_bus_tipo`='"+bus_tipo+"' AND `chl_componente`='"+nreg_componente+"'","CAST(`chl_posicion` AS UNSIGNED)");
    $("#nreg_posicion").html(select_novedad);
    select_novedad = f_select_combo("manto_check_list_falla_accion","SI","chl_falla","","`chl_bus_tipo`='"+bus_tipo+"' AND `chl_componente`='"+nreg_componente+"'","`chl_falla`","`chl_falla` ASC");
    $("#nreg_falla").html(select_novedad);
    select_novedad = f_select_combo("manto_check_list_falla_accion","NO","chl_accion","","`chl_bus_tipo`='"+bus_tipo+"' AND `chl_componente`='"+nreg_componente+"' AND `chl_falla`='"+nreg_falla+"'","`chl_accion`","`chl_accion` ASC");
    $("#nreg_accion").html(select_novedad);

    $("#nreg_bus").val(nreg_bus);
    $("#nreg_descripcion").val(nreg_descripcion);
    $("#nreg_componente").val(nreg_componente);
    $("#nreg_posicion").val(nreg_posicion);
    $("#nreg_falla").val(nreg_falla);
    $("#nreg_accion").val(nreg_accion);
  });

  ///:: CONSULTA DE COMPONENTE DE OBSERVACIONES :::::::::::::::::::::::::::::::::::::::::::///
  $("#nreg_componente").on('change', function () {
    $("#nreg_posicion").prop("disabled",false);
    $("#nreg_falla").prop("disabled",false);
    $("#nreg_accion").prop("disabled",false);
    nreg_componente = $("#nreg_componente").val();
    contar_posicion = f_contar_dato("manto_check_list_posicion","chl_posicion","`chl_bus_tipo`='"+bus_tipo+"' AND `chl_componente`='"+nreg_componente+"'");
    nreg_falla = "";
    nreg_accion = "";

    if(contar_posicion=="1"){
      nreg_posicion = f_buscar_dato("manto_check_list_posicion","chl_posicion","`chl_bus_tipo`='"+bus_tipo+"' AND `chl_componente`='"+nreg_componente+"'");
      $("#nreg_falla").focus().select();      
      $("#nreg_posicion").prop("disabled",true);
    }else{
      nreg_posicion = '';
    }

    select_novedad = f_select_combo("manto_check_list_posicion","NO","chl_posicion","","`chl_bus_tipo`='"+bus_tipo+"' AND `chl_componente`='"+nreg_componente+"'","CAST(`chl_posicion` AS UNSIGNED)");
    $("#nreg_posicion").html(select_novedad);

    contar_falla = f_contar_dato("manto_check_list_falla_accion","chl_falla","`chl_bus_tipo`='"+bus_tipo+"' AND `chl_componente`='"+nreg_componente+"'");

    if(contar_posicion=="1" && contar_falla=="1"){
      nreg_falla = f_buscar_dato("manto_check_list_falla_accion","chl_falla","`chl_bus_tipo`='"+bus_tipo+"' AND `chl_componente`='"+nreg_componente+"'");
      $("#nreg_accion").focus().select();
      $("#nreg_falla").prop("disabled",true);   
    }else{
      nreg_falla = "";
    }

    select_novedad = f_select_combo("manto_check_list_falla_accion","SI","chl_falla","","`chl_bus_tipo`='"+bus_tipo+"' AND `chl_componente`='"+nreg_componente+"'","`chl_falla`","`chl_falla` ASC");
    $("#nreg_falla").html(select_novedad);

    contar_accion = f_contar_dato("manto_check_list_falla_accion","chl_accion","`chl_bus_tipo`='"+bus_tipo+"' AND `chl_componente`='"+nreg_componente+"' AND `chl_falla`='"+nreg_falla+"'");

    if(contar_posicion=="1" && contar_falla=="1" && contar_accion=="1"){
      nreg_accion = f_buscar_dato("manto_check_list_falla_accion","chl_accion","`chl_bus_tipo`='"+bus_tipo+"' AND `chl_componente`='"+nreg_componente+"' AND `chl_falla`='"+nreg_falla+"'");
      $("#btn_registrar_novedad_regular").focus().select();      
      $("#nreg_accion").prop("disabled",true);
    }else{
      nreg_accion = "";
    }

    select_novedad = f_select_combo("manto_check_list_falla_accion","NO","chl_accion","","`chl_bus_tipo`='"+bus_tipo+"' AND `chl_componente`='"+nreg_componente+"' AND `chl_falla`='"+nreg_falla+"'","`chl_accion`","`chl_accion` ASC");
    $("#nreg_accion").html(select_novedad);

    $("#nreg_posicion").val(nreg_posicion);
    $("#nreg_falla").val(nreg_falla);
    $("#nreg_accion").val(nreg_accion);
  });
  ///:: FIN CONSULTA DE COMPONENTE DE OBSERVACIONES :::::::::::::::::::::::::::::::::::::::///

  ///:: CONSULTA DE POSICION DE OBSERVACIONES :::::::::::::::::::::::::::::::::::::::::::::///
  $("#nreg_posicion").on('change', function (){
    $("#nreg_falla").prop("disabled",false);
    $("#nreg_accion").prop("disabled",false);
    nreg_accion = "";
    
    contar_falla = f_contar_dato("manto_check_list_falla_accion","chl_falla","`chl_bus_tipo`='"+bus_tipo+"' AND `chl_componente`='"+nreg_componente+"'");

    if(contar_falla=="1"){
      nreg_falla = f_buscar_dato("manto_check_list_falla_accion","chl_falla","`chl_bus_tipo`='"+bus_tipo+"' AND `chl_componente`='"+nreg_componente+"'");
      $("#nreg_accion").focus().select();
      $("#nreg_falla").prop("disabled",true);   
    }else{
      nreg_falla = "";
    }

    select_novedad = f_select_combo("manto_check_list_falla_accion","NO","chl_falla","","`chl_bus_tipo`='"+bus_tipo+"' AND `chl_componente`='"+nreg_componente+"'","`chl_falla` ASC");
    $("#nreg_falla").html(select_novedad);

    contar_accion = f_contar_dato("manto_check_list_falla_accion","chl_accion","`chl_bus_tipo`='"+bus_tipo+"' AND `chl_componente`='"+nreg_componente+"' AND `chl_falla`='"+nreg_falla+"'");

    if(contar_falla=="1" && contar_accion=="1"){
      nreg_accion = f_buscar_dato("manto_check_list_falla_accion","chl_accion","`chl_bus_tipo`='"+bus_tipo+"' AND `chl_componente`='"+nreg_componente+"' AND `chl_falla`='"+nreg_falla+"'");
      $("#btn_registrar_novedad_regular").focus().select();      
      $("#nreg_accion").prop("disabled",true);
    }else{
      nreg_accion = "";
    }

    select_novedad = f_select_combo("manto_check_list_falla_accion","NO","chl_accion","","`chl_bus_tipo`='"+bus_tipo+"' AND `chl_componente`='"+nreg_componente+"' AND `chl_falla`='"+nreg_falla+"'","`chl_accion` ASC");
    $("#nreg_accion").html(select_novedad);

    $("#nreg_falla").val(nreg_falla);
    $("#nreg_accion").val(nreg_accion);
  })
  ///:: FIN CONSULTA DE POSICION DE OBSERVACIONES :::::::::::::::::::::::::::::::::::::::::///

  $("#nreg_falla").on('change', function (){
    $("#nreg_accion").prop("disabled",false);
    nreg_falla = $("#nreg_falla").val();
    contar_accion = f_contar_dato("manto_check_list_falla_accion","chl_accion","`chl_bus_tipo`='"+bus_tipo+"' AND `chl_componente`='"+nreg_componente+"' AND `chl_falla`='"+nreg_falla+"'");

    select_novedad = f_select_combo("manto_check_list_falla_accion","NO","chl_accion","","`chl_bus_tipo`='"+bus_tipo+"' AND `chl_componente`='"+nreg_componente+"' AND `chl_falla`='"+nreg_falla+"'","`chl_accion`");
    $("#nreg_accion").html(select_novedad);

    if(contar_accion=="1"){
      nreg_accion = f_buscar_dato("manto_check_list_falla_accion","chl_accion","`chl_bus_tipo`='"+bus_tipo+"' AND `chl_componente`='"+nreg_componente+"' AND `chl_falla`='"+nreg_falla+"'");
      $("#btn_registrar_novedad_regular").focus().select();      
      $("#nreg_accion").prop("disabled",true);
    }else{
      nreg_accion = "";
    }

    $("#nreg_accion").val(nreg_accion);
  })

  ///:: BOTONES DE NOVEDADES REGULAR :::::::::::::::::::::::::::::::::::::::::::::::::::::///

  ///:: BOTON NUEVO :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
  $(document).on("click", ".btn_generar_novedad_regular", function(){
    $("#form_novedad_regular").trigger("reset");

    f_limpia_novedad_regular();
  
    bus_tipo = "";
    nreg_descripcion = "";
    nreg_operacion = "";
    nreg_bus = "";
    nreg_componente = "";
    nreg_posicion = "";
    nreg_falla = "";
    nreg_accion = "";

    f_select_combos_novedad_regular();

    $("#nreg_posicion").prop("disabled",false);
    $("#nreg_falla").prop("disabled",false);
    $("#nreg_accion").prop("disabled",false);    

    $("#nreg_descripcion").val(nreg_descripcion); 
    $("#nreg_operacion").val(nreg_operacion); 
    $("#nreg_bus").val(nreg_bus); 
    $("#nreg_componente").val(nreg_componente); 
    $("#nreg_posicion").val(nreg_posicion);
    $("#nreg_falla").val(nreg_falla);
    $("#nreg_accion").val(nreg_accion);

    $(".modal-header").css( "background-color", "#17a2b8");
    $(".modal-header").css( "color", "white" );
    $(".modal-title").text("Alta Novedad Regular");
    $('#modal_crud_novedad_regular').modal('show');
  });
  ///:: FIN BOTON NUEVO :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///

  ///:: CREAR NOVEDAD REGULAR :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
  $('#form_novedad_regular').submit(function(e){                         
    e.preventDefault(); //evita el comportambiento normal del submit, es decir, recarga total de la página
    let validacion  = '';
    
    nreg_descripcion = $.trim($("#nreg_descripcion").val()); 
    nreg_operacion = $("#nreg_operacion").val(); 
    nreg_bus = $("#nreg_bus").val(); 
    nreg_componente = $("#nreg_componente").val(); 
    nreg_posicion = $("#nreg_posicion").val();
    nreg_falla = $("#nreg_falla").val();
    nreg_accion = $("#nreg_accion").val();

    validacion = f_validar_novedad_regular(nreg_descripcion, nreg_operacion, nreg_bus, nreg_componente, nreg_posicion, nreg_falla, nreg_accion);
    
    if(validacion=="invalido"){
      Swal.fire({
        position            : 'center',
        icon                : 'error',
        title               : '*Falta Completar Información!!!',
        showConfirmButton   : false,
        timer               : 1500
      })
    }else{
      $("#btn_registrar_novedad_regular").prop("disabled",true);
      Accion = 'crear_novedad_regular';
      $.ajax({
          url         : "Ajax.php",
          type        : "POST",
          datatype    : "json",    
          data        : { MoS:MoS, NombreMoS:NombreMoS, Accion:Accion, nreg_descripcion:nreg_descripcion, nreg_operacion:nreg_operacion, nreg_bus:nreg_bus, nreg_componente:nreg_componente, nreg_posicion:nreg_posicion, nreg_falla:nreg_falla, nreg_accion:nreg_accion},    
          success     : function(data) {
              tabla_novedades.ajax.reload(null, false);
          }
      });
      $('#modal_crud_novedad_regular').modal('hide');
      $("#btn_registrar_novedad_regular").prop("disabled",false);
    }
  });
  ///:: FIN CREAR NOVEDAD REGULAR :::::::::::::::::::::::::::::::::::::::::::::::::::::::///

    ///:: TERMINO DE BOTONES NOVEDADES MANTENIMIENTO ::::::::::::::::::::::::::::::::::::::///
});
///:: TERMINO DE JS DOM NOVEDADES MANTENIMIENTO :::::::::::::::::::::::::::::::::::::::::::///

///:: FUNCIONES DE NOVEDADES MANTENIMEINTO ::::::::::::::::::::::::::::::::::::::::::::::::///
function f_limpia_novedad_regular(){
  $("#nreg_descripcion").removeClass("color-error");
  $("#nreg_operacion").removeClass("color-error");
  $("#nreg_bus").removeClass("color-error");
  $("#nreg_componente").removeClass("color-error");
  $("#nreg_posicion").removeClass("color-error");
  $("#nreg_falla").removeClass("color-error");
  $("#nreg_accion").removeClass("color-error");
}

function f_validar_novedad_regular(p_nreg_descripcion, p_nreg_operacion, p_nreg_bus, p_nreg_componente, p_nreg_posicion, p_nreg_falla, p_nreg_accion){
  f_limpia_novedad_regular();
  let rpta_validar_novedad_regular = "";
  if(p_nreg_descripcion==""){
      $("#nreg_descripcion").addClass("color-error");
      rpta_validar_novedad_regular = "invalido";
  } 
  if(p_nreg_operacion==""){
      $("#nreg_operacion").addClass("color-error");
      rpta_validar_novedad_regular = "invalido";
  } 
  if(p_nreg_bus=="" || p_nreg_bus==null){
      $("#nreg_bus").addClass("color-error");
      rpta_validar_novedad_regular = "invalido";
  } 
  if(p_nreg_componente=="" || p_nreg_componente==null){
      $("#nreg_componente").addClass("color-error");
      rpta_validar_novedad_regular = "invalido";
  } 
  if(p_nreg_posicion=="" || p_nreg_posicion==null ){
      $("#nreg_posicion").addClass("color-error");
      rpta_validar_novedad_regular = "invalido";
  } 
  if(p_nreg_falla=="" || p_nreg_falla==null){
      $("#nreg_falla").addClass("color-error");
      rpta_validar_novedad_regular = "invalido";
  } 
  if(p_nreg_accion=="" || p_nreg_accion==null){
      $("#nreg_accion").addClass("color-error");
      rpta_validar_novedad_regular = "invalido";
  }
  return rpta_validar_novedad_regular;
}

function f_select_combos_novedad_regular(){
  select_novedad = f_select_combo("manto_tc_orden_trabajo","NO","tc_categoria3","","`tc_variable`='SISTEMA' AND `tc_categoria1`='NOVEDAD REGULAR' AND `tc_categoria2`='OPERACION'","`tc_categoria3` ASC");
  $("#nreg_operacion").html(select_novedad);
  select_novedad = f_select_combo("Buses","NO","Bus_NroExterno","","`Bus_Estado`='DISPONIBLE' AND `Bus_Tipo`='UNIDAD' AND `Bus_Operacion`='"+nreg_operacion+"'","`Bus_NroExterno` ASC");
  $("#nreg_bus").html(select_novedad);
  select_novedad = f_select_combo("manto_check_list_componente","NO","chl_componente","","`chl_bus_tipo`='"+bus_tipo+"'","`chl_componente` ASC");
  $("#nreg_componente").html(select_novedad);
  select_novedad = f_select_combo("manto_check_list_posicion","NO","chl_posicion","","`chl_bus_tipo`='"+bus_tipo+"' AND `chl_componente`='"+nreg_componente+"'","CAST(`chl_posicion` AS UNSIGNED)");
  $("#nreg_posicion").html(select_novedad);
  select_novedad = f_select_combo("manto_check_list_falla_accion","SI","chl_falla","","`chl_bus_tipo`='"+bus_tipo+"' AND `chl_componente`='"+nreg_componente+"'","`chl_falla`","`chl_falla` ASC");
  $("#nreg_falla").html(select_novedad);
  select_novedad = f_select_combo("manto_check_list_falla_accion","NO","chl_accion","","`chl_bus_tipo`='"+bus_tipo+"' AND `chl_componente`='"+nreg_componente+"' AND `chl_falla`='"+nreg_falla+"'","`chl_accion`","`chl_accion` ASC");
  $("#nreg_accion").html(select_novedad);
}


///:: TERMINO FUNCIONES DE NOVEDAD REGULAR ::::::::::::::::::::::::::::::::::::::::::::::::///