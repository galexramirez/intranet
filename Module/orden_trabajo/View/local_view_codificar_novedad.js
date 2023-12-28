///::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
///:: CODIFICAR NOVEDAD v 1.0 FECHA: 2023-12-10 :::::::::::::::::::::::::::::::::::::::::::///
///:: CREAR CODIFICACION DE NOVEDAD :::::::::::::::::::::::::::::::::::::::::::::::::::::::///
///::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///

///:: DECLARACION DE VARIABLES ::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
var select_codificar;
var nope_componente, nope_posicion, nope_falla, nope_accion;

///:: JS DOM CODIFICAR NOVEDADES :::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
$(document).ready(function(){

  ///:: CONSULTA DE COMPONENTE DE NOVEDAD ::::::::::::::::::::::::::::::::::::::::::::::::///
  $("#nope_componente").on('change', function () {
    f_limpia_codificar_novedad();
    $("#nope_posicion").prop("disabled",false);
    $("#nope_falla").prop("disabled",false);
    $("#nope_accion").prop("disabled",false);
    nope_componente = $("#nope_componente").val();
    contar_posicion = f_contar_dato("manto_check_list_posicion","chl_posicion","`chl_bus_tipo`='"+bus_tipo+"' AND `chl_componente`='"+nope_componente+"'");
    nope_falla = "";
    nope_accion = "";

    if(contar_posicion=="1"){
      nope_posicion = f_buscar_dato("manto_check_list_posicion","chl_posicion","`chl_bus_tipo`='"+bus_tipo+"' AND `chl_componente`='"+nope_componente+"'");
      $("#nope_falla").focus().select();      
      $("#nope_posicion").prop("disabled",true);
    }else{
      nope_posicion = '';
    }

    select_codificar = f_select_combo("manto_check_list_posicion","NO","chl_posicion","","`chl_bus_tipo`='"+bus_tipo+"' AND `chl_componente`='"+nope_componente+"'","CAST(`chl_posicion` AS UNSIGNED)");
    $("#nope_posicion").html(select_codificar);

    contar_falla = f_contar_dato("manto_check_list_falla_accion","chl_falla","`chl_bus_tipo`='"+bus_tipo+"' AND `chl_componente`='"+nope_componente+"'");

    if(contar_posicion=="1" && contar_falla=="1"){
      nope_falla = f_buscar_dato("manto_check_list_falla_accion","chl_falla","`chl_bus_tipo`='"+bus_tipo+"' AND `chl_componente`='"+nope_componente+"'");
      $("#nope_accion").focus().select();
      $("#nope_falla").prop("disabled",true);   
    }else{
      nope_falla = "";
    }

    select_codificar = f_select_combo("manto_check_list_falla_accion","SI","chl_falla","","`chl_bus_tipo`='"+bus_tipo+"' AND `chl_componente`='"+nope_componente+"'","`chl_falla`","`chl_falla` ASC");
    $("#nope_falla").html(select_codificar);

    contar_accion = f_contar_dato("manto_check_list_falla_accion","chl_accion","`chl_bus_tipo`='"+bus_tipo+"' AND `chl_componente`='"+nope_componente+"' AND `chl_falla`='"+nope_falla+"'");

    if(contar_posicion=="1" && contar_falla=="1" && contar_accion=="1"){
      nope_accion = f_buscar_dato("manto_check_list_falla_accion","chl_accion","`chl_bus_tipo`='"+bus_tipo+"' AND `chl_componente`='"+nope_componente+"' AND `chl_falla`='"+nope_falla+"'");
      $("#btn_registrar_novedad_regular").focus().select();      
      $("#nope_accion").prop("disabled",true);
    }else{
      nope_accion = "";
    }

    select_codificar = f_select_combo("manto_check_list_falla_accion","NO","chl_accion","","`chl_bus_tipo`='"+bus_tipo+"' AND `chl_componente`='"+nope_componente+"' AND `chl_falla`='"+nope_falla+"'","`chl_accion`","`chl_accion` ASC");
    $("#nope_accion").html(select_codificar);

    $("#nope_posicion").val(nope_posicion);
    $("#nope_falla").val(nope_falla);
    $("#nope_accion").val(nope_accion);
  });
  ///:: FIN CONSULTA DE COMPONENTE DE OBSERVACIONES :::::::::::::::::::::::::::::::::::::::///

  ///:: CONSULTA DE POSICION DE OBSERVACIONES :::::::::::::::::::::::::::::::::::::::::::::///
  $("#nope_posicion").on('change', function (){
    $("#nope_falla").prop("disabled",false);
    $("#nope_accion").prop("disabled",false);
    nope_accion = "";
    
    contar_falla = f_contar_dato("manto_check_list_falla_accion","chl_falla","`chl_bus_tipo`='"+bus_tipo+"' AND `chl_componente`='"+nope_componente+"'");

    if(contar_falla=="1"){
      nope_falla = f_buscar_dato("manto_check_list_falla_accion","chl_falla","`chl_bus_tipo`='"+bus_tipo+"' AND `chl_componente`='"+nope_componente+"'");
      $("#nope_accion").focus().select();
      $("#nope_falla").prop("disabled",true);   
    }else{
      nope_falla = "";
    }

    select_codificar = f_select_combo("manto_check_list_falla_accion","NO","chl_falla","","`chl_bus_tipo`='"+bus_tipo+"' AND `chl_componente`='"+nope_componente+"'","`chl_falla` ASC");
    $("#nope_falla").html(select_codificar);

    contar_accion = f_contar_dato("manto_check_list_falla_accion","chl_accion","`chl_bus_tipo`='"+bus_tipo+"' AND `chl_componente`='"+nope_componente+"' AND `chl_falla`='"+nope_falla+"'");

    if(contar_falla=="1" && contar_accion=="1"){
      nope_accion = f_buscar_dato("manto_check_list_falla_accion","chl_accion","`chl_bus_tipo`='"+bus_tipo+"' AND `chl_componente`='"+nope_componente+"' AND `chl_falla`='"+nope_falla+"'");
      $("#btn_codificar_novedad").focus().select();      
      $("#nope_accion").prop("disabled",true);
    }else{
      nope_accion = "";
    }

    select_codificar = f_select_combo("manto_check_list_falla_accion","NO","chl_accion","","`chl_bus_tipo`='"+bus_tipo+"' AND `chl_componente`='"+nope_componente+"' AND `chl_falla`='"+nope_falla+"'","`chl_accion` ASC");
    $("#nope_accion").html(select_codificar);

    $("#nope_falla").val(nope_falla);
    $("#nope_accion").val(nope_accion);
  })
  ///:: FIN CONSULTA DE POSICION DE OBSERVACIONES :::::::::::::::::::::::::::::::::::::::::///

  $("#nope_falla").on('change', function (){
    $("#nope_accion").prop("disabled",false);
    nope_falla = $("#nope_falla").val();
    contar_accion = f_contar_dato("manto_check_list_falla_accion","chl_accion","`chl_bus_tipo`='"+bus_tipo+"' AND `chl_componente`='"+nope_componente+"' AND `chl_falla`='"+nope_falla+"'");

    select_codificar = f_select_combo("manto_check_list_falla_accion","NO","chl_accion","","`chl_bus_tipo`='"+bus_tipo+"' AND `chl_componente`='"+nope_componente+"' AND `chl_falla`='"+nope_falla+"'","`chl_accion`");
    $("#nope_accion").html(select_codificar);

    if(contar_accion=="1"){
      nope_accion = f_buscar_dato("manto_check_list_falla_accion","chl_accion","`chl_bus_tipo`='"+bus_tipo+"' AND `chl_componente`='"+nope_componente+"' AND `chl_falla`='"+nope_falla+"'");
      $("#btn_codificar_novedad").focus().select();      
      $("#nope_accion").prop("disabled",true);
    }else{
      nope_accion = "";
    }

    $("#nope_accion").val(nope_accion);
  })

  ///:: BOTONES DE NOVEDADES REGULAR :::::::::::::::::::::::::::::::::::::::::::::::::::::///

  ///:: BOTON NUEVO :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
  $(document).on("click", ".btn_codificar", function(){
    f_limpia_codificar_novedad();
    f_select_combos_codificar_novedad();
    $("#form_codificar_novedad").trigger("reset");
    let nope_novedad_id = novedad_id.substring(3, 18);
    let nope_descripcion = f_buscar_dato("OPE_Novedad","Nove_Descripcion","`Novedad_Id`='"+nope_novedad_id+"'");
    
    nope_componente=""; 
    nope_posicion=""; 
    nope_falla=""; 
    nope_accion="";

    $("#nope_posicion").prop("disabled",false);
    $("#nope_falla").prop("disabled",false);
    $("#nope_accion").prop("disabled",false);

    $("#nope_componente").val(nope_componente); 
    $("#nope_posicion").val(nope_posicion);
    $("#nope_falla").val(nope_falla);
    $("#nope_accion").val(nope_accion);
    $("#nope_descripcion").val(nope_descripcion);

    $(".modal-header").css( "background-color", "#17a2b8");
    $(".modal-header").css( "color", "white" );
    $(".modal-title").text("Arborizar Novedad");
    $('#modal_crud_codificar_novedad').modal('show');
    $('#modal_crud_codificar_novedad').modal('show');
    $("#modal_crud_codificar_novedad").draggable({});

  });
  ///:: FIN BOTON NUEVO :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///

  ///:: CREAR NOVEDAD REGULAR :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
  $('#form_codificar_novedad').submit(function(e){                         
    e.preventDefault(); //evita el comportambiento normal del submit, es decir, recarga total de la página
    let validacion  = '';
    nope_componente = $("#nope_componente").val(); 
    nope_posicion = $("#nope_posicion").val();
    nope_falla = $("#nope_falla").val();
    nope_accion = $("#nope_accion").val();
    validacion = f_validar_codificar_novedad(nope_componente, nope_posicion, nope_falla, nope_accion);
    if(validacion=="invalido"){
      Swal.fire({
        position            : 'center',
        icon                : 'error',
        title               : '*Falta Completar Información!!!',
        showConfirmButton   : false,
        timer               : 1500
      })
    }else{
      $("#btn_codificar_novedad").prop("disabled",true);
      Accion = 'codificar_novedad';
      $.ajax({
          url         : "Ajax.php",
          type        : "POST",
          datatype    : "json",    
          data        : { MoS:MoS, NombreMoS:NombreMoS, Accion:Accion, nope_tipo_novedad:tipo_novedad, nope_novedad_id:novedad_id, nope_componente:nope_componente, nope_posicion:nope_posicion, nope_falla:nope_falla, nope_accion:nope_accion},    
          success     : function(data) {
              tabla_novedades.ajax.reload(null, false);
          }
      });
      $('#modal_crud_codificar_novedad').modal('hide');
      $("#btn_codificar_novedad").prop("disabled",false);
      div_show = f_MostrarDiv("form_seleccion_novedades", "btn_seleccion_novedades", "inicio", "inicio");
      $("#div_btn_seleccion_novedades").html(div_show);
    }
  });
  ///:: FIN CREAR NOVEDAD REGULAR :::::::::::::::::::::::::::::::::::::::::::::::::::::::///

    ///:: TERMINO DE BOTONES NOVEDADES MANTENIMIENTO ::::::::::::::::::::::::::::::::::::::///
});
///:: TERMINO DE JS DOM NOVEDADES MANTENIMIENTO :::::::::::::::::::::::::::::::::::::::::::///



///:: FUNCIONES DE NOVEDADES MANTENIMEINTO ::::::::::::::::::::::::::::::::::::::::::::::::///
function f_limpia_codificar_novedad(){
  $("#nope_componente").removeClass("color-error");
  $("#nope_posicion").removeClass("color-error");
  $("#nope_falla").removeClass("color-error");
  $("#nope_accion").removeClass("color-error");
}

function f_validar_codificar_novedad(p_nope_componente, p_nope_posicion, p_nope_falla, p_nope_accion){
  let rpta_validar_codificar_novedad = "";
  if(p_nope_componente==""){
      $("#nope_componente").addClass("color-error");
      rpta_validar_codificar_novedad = "invalido";
  } 
  if(p_nope_posicion==""){
      $("#nope_posicion").addClass("color-error");
      rpta_validar_codificar_novedad = "invalido";
  } 
  if(p_nope_falla==""){
      $("#nope_falla").addClass("color-error");
      rpta_validar_codificar_novedad = "invalido";
  } 
  if(p_nope_accion==""){
      $("#nope_accion").addClass("color-error");
      rpta_validar_codificar_novedad = "invalido";
  }
  return rpta_validar_codificar_novedad;
}

function f_select_combos_codificar_novedad(){
  select_codificar = f_select_combo("manto_tc_orden_trabajo","NO","tc_categoria3","","`tc_variable`='SISTEMA' AND `tc_categoria1`='NOVEDAD REGULAR' AND `tc_categoria2`='OPERACION'","`tc_categoria3` ASC");
  $("#bus_tipo").html(select_codificar);
  select_codificar = f_select_combo("manto_check_list_componente","SI","chl_componente","","`chl_bus_tipo`='"+bus_tipo+"'","`chl_componente` ASC");
  $("#nope_componente").html(select_codificar);
  select_codificar = f_select_combo("manto_check_list_posicion","NO","chl_posicion","","`chl_bus_tipo`='"+bus_tipo+"' AND `chl_componente`='"+nope_componente+"'","CAST(`chl_posicion` AS UNSIGNED)");
  $("#nope_posicion").html(select_codificar);
  select_codificar = f_select_combo("manto_check_list_falla_accion","SI","chl_falla","","`chl_bus_tipo`='"+bus_tipo+"' AND `chl_componente`='"+nope_componente+"'","`chl_falla`","`chl_falla` ASC");
  $("#nope_falla").html(select_codificar);
  select_codificar = f_select_combo("manto_check_list_falla_accion","NO","chl_accion","","`chl_bus_tipo`='"+bus_tipo+"' AND `chl_componente`='"+nope_componente+"' AND `chl_falla`='"+nope_falla+"'","`chl_accion`","`chl_accion` ASC");
  $("#nope_accion").html(select_codificar);

}


///:: TERMINO FUNCIONES DE NOVEDAD REGULAR ::::::::::::::::::::::::::::::::::::::::::::::::///
