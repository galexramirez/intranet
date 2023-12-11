///::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
///:: OBSERVACIONES CHECK LIST FLOTA v 1.0 ::::::::::::::::::::::::::::::::::::::::::::::::///
///:: DETALLE DE OBSERVACIONES DE CHECK LIST ::::::::::::::::::::::::::::::::::::::::::::::///
///::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///

///:: DECLARACIONES DE VARIABLES GLOBALES :::::::::::::::::::::::::::::::::::::::::::::::::///
var obs_check_list_id, obs_chl_bus_tipo, obs_chl_codigo, obs_chl_descripcion, obs_chl_componente, obs_chl_posicion, obs_chl_falla, obs_chl_accion;
var array_observaciones, fila_check_list_observaciones, tabla_check_list_observaciones;

///:: JS DOM REGISTRO INSPECCION FLOTA ::::::::::::::::::::::::::::::::::::::::::::::::::::///
$(document).ready(function(){
  let select_chl_obs='', contar_componente='', contar_posicion='', contar_falla='', contar_accion='';
  obs_chl_bus_tipo = "";
  array_observaciones = [];

  ///:: CONSULTA DE CODIGO DE OBSERVACIONES :::::::::::::::::::::::::::::::::::::::::::::::///
  $("#obs_chl_codigo").on('change', function () {
    $("#obs_chl_componente").prop("disabled",false);
    $("#obs_chl_posicion").prop("disabled",false);
    $("#obs_chl_falla").prop("disabled",false);
    $("#obs_chl_accion").prop("disabled",false);
    obs_chl_codigo = $("#obs_chl_codigo").val();
    obs_chl_descripcion = f_buscar_dato("manto_check_list_codigo","chl_descripcion","`chl_bus_tipo`='"+obs_chl_bus_tipo+"' AND `chl_codigo`='"+obs_chl_codigo+"'");
    contar_componente = f_contar_dato("manto_check_list_componente","chl_componente","`chl_bus_tipo`='"+obs_chl_bus_tipo+"' AND `chl_codigo`='"+obs_chl_codigo+"'");
    obs_chl_componente = "";
    obs_chl_posicion = "";
    obs_chl_falla = "";
    obs_chl_accion = "";

    if(contar_componente=="1"){
      obs_chl_componente = f_buscar_dato("manto_check_list_componente","chl_componente","`chl_bus_tipo`='"+obs_chl_bus_tipo+"' AND `chl_codigo`='"+obs_chl_codigo+"'");
      $("#obs_chl_posicion").focus().select();      
      $("#obs_chl_componente").prop("disabled",true);
    }else{
      obs_chl_componente = "";
    }

    select_chl_obs = f_select_combo("manto_check_list_componente","NO","chl_componente","","`chl_bus_tipo`='"+obs_chl_bus_tipo+"' AND `chl_codigo`='"+obs_chl_codigo+"'","`chl_componente` ASC");
    $("#obs_chl_componente").html(select_chl_obs);

    contar_posicion = f_contar_dato("manto_check_list_posicion","chl_posicion","`chl_bus_tipo`='"+obs_chl_bus_tipo+"' AND `chl_codigo`='"+obs_chl_codigo+"' AND `chl_componente`='"+obs_chl_componente+"'");

    if(contar_componente=="1" && contar_posicion=="1"){
      obs_chl_posicion = f_buscar_dato("manto_check_list_posicion","chl_posicion","`chl_bus_tipo`='"+obs_chl_bus_tipo+"' AND `chl_codigo`='"+obs_chl_codigo+"' AND `chl_componente`='"+obs_chl_componente+"'");
      $("#obs_chl_falla").focus().select();      
      $("#obs_chl_posicion").prop("disabled",true);
    }else{
      obs_chl_posicion = '';
    }

    select_chl_obs = f_select_combo("manto_check_list_posicion","NO","chl_posicion","","`chl_bus_tipo`='"+obs_chl_bus_tipo+"' AND `chl_codigo`='"+obs_chl_codigo+"' AND `chl_componente`='"+obs_chl_componente+"'","CAST(`chl_posicion` AS UNSIGNED)");
    $("#obs_chl_posicion").html(select_chl_obs);

    contar_falla = f_contar_dato("manto_check_list_falla_accion","chl_falla","`chl_bus_tipo`='"+obs_chl_bus_tipo+"' AND `chl_codigo`='"+obs_chl_codigo+"' AND `chl_componente`='"+obs_chl_componente+"'");

    if(contar_componente=="1" && contar_posicion=="1" && contar_falla=="1"){
      obs_chl_falla = f_buscar_dato("manto_check_list_falla_accion","chl_falla","`chl_bus_tipo`='"+obs_chl_bus_tipo+"' AND `chl_codigo`='"+obs_chl_codigo+"' AND `chl_componente`='"+obs_chl_componente+"'");
      $("#obs_chl_accion").focus().select();
      $("#obs_chl_falla").prop("disabled",true);   
    }else{
      obs_chl_falla = "";
    }

    select_chl_obs = f_select_combo("manto_check_list_falla_accion","SI","chl_falla","","`chl_bus_tipo`='"+obs_chl_bus_tipo+"' AND `chl_codigo`='"+obs_chl_codigo+"' AND `chl_componente`='"+obs_chl_componente+"'","`chl_falla`");
    $("#obs_chl_falla").html(select_chl_obs);

    contar_accion = f_contar_dato("manto_check_list_falla_accion","chl_accion","`chl_bus_tipo`='"+obs_chl_bus_tipo+"' AND `chl_codigo`='"+obs_chl_codigo+"' AND `chl_componente`='"+obs_chl_componente+"' AND `chl_falla`='"+obs_chl_falla+"'");

    if(contar_componente=="1" && contar_posicion=="1" && contar_falla=="1" && contar_accion=="1"){
      obs_chl_accion = f_buscar_dato("manto_check_list_falla_accion","chl_accion","`chl_bus_tipo`='"+obs_chl_bus_tipo+"' AND `chl_codigo`='"+obs_chl_codigo+"' AND `chl_componente`='"+obs_chl_componente+"' AND `chl_falla`='"+obs_chl_falla+"'");
      $("#btn_check_list_registrar_observaciones").focus().select();      
      $("#obs_chl_accion").prop("disabled",true);
    }else{
      obs_chl_accion = "";
    }

    select_chl_obs = f_select_combo("manto_check_list_falla_accion","NO","chl_accion","","`chl_bus_tipo`='"+obs_chl_bus_tipo+"' AND `chl_codigo`='"+obs_chl_codigo+"' AND `chl_componente`='"+obs_chl_componente+"' AND `chl_falla`='"+obs_chl_falla+"'","`chl_accion`");
    $("#obs_chl_accion").html(select_chl_obs);
 
    $("#obs_chl_descripcion").val(obs_chl_descripcion);
    $("#obs_chl_componente").val(obs_chl_componente);
    $("#obs_chl_posicion").val(obs_chl_posicion);
    $("#obs_chl_falla").val(obs_chl_falla);
    $("#obs_chl_accion").val(obs_chl_accion);
  });
  ///:: FIN CONSULTA DE CODIGO DE OBSERVACIONES :::::::::::::::::::::::::::::::::::::::::::///

  ///:: CONSULTA DE COMPONENTE DE OBSERVACIONES :::::::::::::::::::::::::::::::::::::::::::///
  $("#obs_chl_componente").on('change', function () {
    $("#obs_chl_posicion").prop("disabled",false);
    $("#obs_chl_falla").prop("disabled",false);
    $("#obs_chl_accion").prop("disabled",false);
    obs_chl_componente = $("#obs_chl_componente").val();
    contar_posicion = f_contar_dato("manto_check_list_posicion","chl_posicion","`chl_bus_tipo`='"+obs_chl_bus_tipo+"' AND `chl_codigo`='"+obs_chl_codigo+"' AND `chl_componente`='"+obs_chl_componente+"'");
    obs_chl_falla = "";
    obs_chl_accion = "";

    if(contar_posicion=="1"){
      obs_chl_posicion = f_buscar_dato("manto_check_list_posicion","chl_posicion","`chl_bus_tipo`='"+obs_chl_bus_tipo+"' AND `chl_codigo`='"+obs_chl_codigo+"' AND `chl_componente`='"+obs_chl_componente+"'");
      $("#obs_chl_falla").focus().select();      
      $("#obs_chl_posicion").prop("disabled",true);
    }else{
      obs_chl_posicion = '';
    }

    select_chl_obs = f_select_combo("manto_check_list_posicion","NO","chl_posicion","","`chl_bus_tipo`='"+obs_chl_bus_tipo+"' AND `chl_codigo`='"+obs_chl_codigo+"' AND `chl_componente`='"+obs_chl_componente+"'","CAST(`chl_posicion` AS UNSIGNED)");
    $("#obs_chl_posicion").html(select_chl_obs);

    contar_falla = f_contar_dato("manto_check_list_falla_accion","chl_falla","`chl_bus_tipo`='"+obs_chl_bus_tipo+"' AND `chl_codigo`='"+obs_chl_codigo+"' AND `chl_componente`='"+obs_chl_componente+"'");

    if(contar_posicion=="1" && contar_falla=="1"){
      obs_chl_falla = f_buscar_dato("manto_check_list_falla_accion","chl_falla","`chl_bus_tipo`='"+obs_chl_bus_tipo+"' AND `chl_codigo`='"+obs_chl_codigo+"' AND `chl_componente`='"+obs_chl_componente+"'");
      $("#obs_chl_accion").focus().select();
      $("#obs_chl_falla").prop("disabled",true);   
    }else{
      obs_chl_falla = "";
    }

    select_chl_obs = f_select_combo("manto_check_list_falla_accion","SI","chl_falla","","`chl_bus_tipo`='"+obs_chl_bus_tipo+"' AND `chl_codigo`='"+obs_chl_codigo+"' AND `chl_componente`='"+obs_chl_componente+"'","`chl_falla` ASC");
    $("#obs_chl_falla").html(select_chl_obs);

    contar_accion = f_contar_dato("manto_check_list_falla_accion","chl_accion","`chl_bus_tipo`='"+obs_chl_bus_tipo+"' AND `chl_codigo`='"+obs_chl_codigo+"' AND `chl_componente`='"+obs_chl_componente+"' AND `chl_falla`='"+obs_chl_falla+"'");

    if(contar_posicion=="1" && contar_falla=="1" && contar_accion=="1"){
      obs_chl_accion = f_buscar_dato("manto_check_list_falla_accion","chl_accion","`chl_bus_tipo`='"+obs_chl_bus_tipo+"' AND `chl_codigo`='"+obs_chl_codigo+"' AND `chl_componente`='"+obs_chl_componente+"' AND `chl_falla`='"+obs_chl_falla+"'");
      $("#btn_check_list_registrar_observaciones").focus().select();      
      $("#obs_chl_accion").prop("disabled",true);
    }else{
      obs_chl_accion = "";
    }

    select_chl_obs = f_select_combo("manto_check_list_falla_accion","NO","chl_accion","","`chl_bus_tipo`='"+obs_chl_bus_tipo+"' AND `chl_codigo`='"+obs_chl_codigo+"' AND `chl_componente`='"+obs_chl_componente+"' AND `chl_falla`='"+obs_chl_falla+"'","`chl_accion` ASC");
    $("#obs_chl_accion").html(select_chl_obs);

    $("#obs_chl_posicion").val(obs_chl_posicion);
    $("#obs_chl_falla").val(obs_chl_falla);
    $("#obs_chl_accion").val(obs_chl_accion);
  });
  ///:: FIN CONSULTA DE COMPONENTE DE OBSERVACIONES :::::::::::::::::::::::::::::::::::::::///

  ///:: CONSULTA DE POSICION DE OBSERVACIONES :::::::::::::::::::::::::::::::::::::::::::::///
  $("#obs_chl_posicion").on('change', function (){
    $("#obs_chl_falla").prop("disabled",false);
    $("#obs_chl_accion").prop("disabled",false);
    obs_chl_accion = "";
    
    contar_falla = f_contar_dato("manto_check_list_falla_accion","chl_falla","`chl_bus_tipo`='"+obs_chl_bus_tipo+"' AND `chl_codigo`='"+obs_chl_codigo+"' AND `chl_componente`='"+obs_chl_componente+"'");

    if(contar_falla=="1"){
      obs_chl_falla = f_buscar_dato("manto_check_list_falla_accion","chl_falla","`chl_bus_tipo`='"+obs_chl_bus_tipo+"' AND `chl_codigo`='"+obs_chl_codigo+"' AND `chl_componente`='"+obs_chl_componente+"'");
      $("#obs_chl_accion").focus().select();
      $("#obs_chl_falla").prop("disabled",true);   
    }else{
      obs_chl_falla = "";
    }

    select_chl_obs = f_select_combo("manto_check_list_falla_accion","NO","chl_falla","","`chl_bus_tipo`='"+obs_chl_bus_tipo+"' AND `chl_codigo`='"+obs_chl_codigo+"' AND `chl_componente`='"+obs_chl_componente+"'","`chl_falla` ASC");
    $("#obs_chl_falla").html(select_chl_obs);

    contar_accion = f_contar_dato("manto_check_list_falla_accion","chl_accion","`chl_bus_tipo`='"+obs_chl_bus_tipo+"' AND `chl_codigo`='"+obs_chl_codigo+"' AND `chl_componente`='"+obs_chl_componente+"' AND `chl_falla`='"+obs_chl_falla+"'");

    if(contar_falla=="1" && contar_accion=="1"){
      obs_chl_accion = f_buscar_dato("manto_check_list_falla_accion","chl_accion","`chl_bus_tipo`='"+obs_chl_bus_tipo+"' AND `chl_codigo`='"+obs_chl_codigo+"' AND `chl_componente`='"+obs_chl_componente+"' AND `chl_falla`='"+obs_chl_falla+"'");
      $("#btn_check_list_registrar_observaciones").focus().select();      
      $("#obs_chl_accion").prop("disabled",true);
    }else{
      obs_chl_accion = "";
    }

    select_chl_obs = f_select_combo("manto_check_list_falla_accion","NO","chl_accion","","`chl_bus_tipo`='"+obs_chl_bus_tipo+"' AND `chl_codigo`='"+obs_chl_codigo+"' AND `chl_componente`='"+obs_chl_componente+"' AND `chl_falla`='"+obs_chl_falla+"'","`chl_accion` ASC");
    $("#obs_chl_accion").html(select_chl_obs);

    $("#obs_chl_falla").val(obs_chl_falla);
    $("#obs_chl_accion").val(obs_chl_accion);
  })
  ///:: FIN CONSULTA DE POSICION DE OBSERVACIONES :::::::::::::::::::::::::::::::::::::::::///

  $("#obs_chl_falla").on('change', function (){
    $("#obs_chl_accion").prop("disabled",false);
    obs_chl_falla = $("#obs_chl_falla").val();
    contar_accion = f_contar_dato("manto_check_list_falla_accion","chl_accion","`chl_bus_tipo`='"+obs_chl_bus_tipo+"' AND `chl_codigo`='"+obs_chl_codigo+"' AND `chl_componente`='"+obs_chl_componente+"' AND `chl_falla`='"+obs_chl_falla+"'");

    select_chl_obs = f_select_combo("manto_check_list_falla_accion","NO","chl_accion","","`chl_bus_tipo`='"+obs_chl_bus_tipo+"' AND `chl_codigo`='"+obs_chl_codigo+"' AND `chl_componente`='"+obs_chl_componente+"' AND `chl_falla`='"+obs_chl_falla+"'","`chl_accion` ASC");
    $("#obs_chl_accion").html(select_chl_obs);

    if(contar_accion=="1"){
      obs_chl_accion = f_buscar_dato("manto_check_list_falla_accion","chl_accion","`chl_bus_tipo`='"+obs_chl_bus_tipo+"' AND `chl_codigo`='"+obs_chl_codigo+"' AND `chl_componente`='"+obs_chl_componente+"' AND `chl_falla`='"+obs_chl_falla+"'");
      $("#btn_check_list_registrar_observaciones").focus().select();      
      $("#obs_chl_accion").prop("disabled",true);
    }else{
      obs_chl_accion = "";
    }

    $("#obs_chl_accion").val(obs_chl_accion);
  })

  ///:: INICIO BOTONES DE INSPECCION REGISTRO :::::::::::::::::::::::::::::::::::::::::::::///

  ///:: BOTON NUEVA OBSERVACION DE CHECK LIST DE FLOTA ::::::::::::::::::::::::::::::::::::///
  $(document).on("click", ".btn_nuevo_registro_observaciones", function(){
    if(obs_chl_bus_tipo!=""){
      $("#form_check_list_registro_observaciones").trigger("reset");
      f_cargar_datos_observaciones();
      $(".modal-header").css( "background-color", "#17a2b8");
      $(".modal-header").css( "color", "white" );
      $(".modal-title").text( "Alta de Observaciones" );
      $('#modal_crud_check_list_registro_observaciones').modal('show');
    }else{
      Swal.fire({
        position            : 'center',
        icon                : 'error',
        title               : "Ingresar Bus !",
        showConfirmButton   : false,
        timer               : 1500
      })
    }
  });
  ///:: FIN BOTON AGREGAR NUEVA INSPECCION COMPONENTE Y POSICION DE FLOTA :::::::::::::::::///
  
  ///:: BOTON AGREGAR NUEVA INSPECCION COMPONENTE Y POSICION DE FLOTA :::::::::::::::::::::///
  $(document).on("click", ".btn_check_list_registrar_observaciones", function(){
    let array_valida_observacion = [];
    let valida_agregar = '';
    let t_msg = '';

    obs_chl_codigo      = $.trim($('#obs_chl_codigo').val());
    obs_chl_descripcion = $.trim($('#obs_chl_descripcion').val());
    obs_chl_componente  = $.trim($('#obs_chl_componente').val());
    obs_chl_posicion    = $.trim($('#obs_chl_posicion').val());    
    obs_chl_falla       = $.trim($('#obs_chl_falla').val());
    obs_chl_accion      = $.trim($('#obs_chl_accion').val());

    valida_agregar = f_valida_agregar_observaciones(obs_chl_codigo, obs_chl_descripcion, obs_chl_componente, obs_chl_posicion, obs_chl_falla, obs_chl_accion);
    if(valida_agregar=="invalido"){
      t_msg += 'Falta Completar Información!!!';
    }
    array_valida_observacion = tabla_check_list_observaciones.rows().data().toArray();

    $.each(array_valida_observacion, function(idx, obj){ 
      if(obs_chl_codigo==obj.chl_codigo && obs_chl_componente==obj.chl_componente && obs_chl_posicion==obj.chl_posicion && obs_chl_falla==obj.chl_falla){
        valida_agregar = "invalido";
        t_msg += "Observación ya registrada!!!";
      }
    });

    if(valida_agregar=="invalido"){
      Swal.fire({
        position            : 'center',
        icon                : 'error',
        title               : t_msg,
        showConfirmButton   : false,
        timer               : 1500
      })
    }else{
      $("#btn_check_list_registrar_observaciones").prop("disabled",true);

      tabla_check_list_observaciones.row.add( {
        "chl_codigo"     : obs_chl_codigo,
        "chl_descripcion": obs_chl_descripcion,
        "chl_componente" : obs_chl_componente,
        "chl_posicion"   : obs_chl_posicion,
        "chl_falla"      : obs_chl_falla,
        "chl_accion"     : obs_chl_accion
      } ).draw();

      f_cargar_datos_observaciones();
      $("#btn_check_list_registrar_observaciones").prop("disabled",false);
    }
  });
  ///:: FIN BOTON AGREGAR NUEVA INSPECCION COMPONENTE Y POSICION DE FLOTA :::::::::::::::::///

  ///:: BOTON BORRAR INSPECCION COMPONENTE Y POSICION :::::::::::::::::::::::::::::::::::::///
  $(document).on("click", ".btn_borrar_check_list_observaciones", function(){
    fila_check_list_observaciones = $(this); 
    obs_chl_codigo = fila_check_list_observaciones.closest('tr').find('td:eq(0)').text();
    obs_chl_componente = fila_check_list_observaciones.closest('tr').find('td:eq(2)').text();
    Swal.fire({
      title: '¿Está seguro?',
      text: "Se eliminará el registro Código: "+obs_chl_codigo+" Componente : "+obs_chl_componente+" !!!",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Si, eliminar!'
    }).then((result) => 
    {
      if (result.isConfirmed){
        tabla_check_list_observaciones
        .row( fila_check_list_observaciones.parents('tr') )
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
function f_valida_agregar_observaciones(p_obs_chl_codigo, p_obs_chl_descripcion, p_obs_chl_componente, p_obs_chl_posicion, p_obs_chl_falla, p_obs_chl_accion){
  f_limpia_observaciones();
  let rpta_valida_agregar_observaciones = "";
  if(p_obs_chl_codigo==""){
    $("#obs_chl_codigo").addClass("color-error");
    rpta_valida_agregar_observaciones = "invalido";
  }
  if(p_obs_chl_descripcion==""){
    $("#obs_chl_descripcion").addClass("color-error");
    rpta_valida_agregar_observaciones = "invalido";
  }
  if(p_obs_chl_componente==""){
    $("#obs_chl_componente").addClass("color-error");
    rpta_valida_agregar_observaciones = "invalido";
  }
  if(p_obs_chl_posicion==""){
    $("#obs_chl_posicion").addClass("color-error");
    rpta_valida_agregar_observaciones = "invalido";
  }
  if(p_obs_chl_falla==""){
    $("#obs_chl_falla").addClass("color-error");
    rpta_valida_agregar_observaciones = "invalido";
  }
  if(p_obs_chl_accion==""){
    $("#obs_chl_accion").addClass("color-error");
    rpta_valida_agregar_observaciones = "invalido";
  }
  return rpta_valida_agregar_observaciones;
}
///:: FUNCION PARA VALIDAR LOS DATOS INGRESADOS AL FORMULARIO :::::::::::::::::::::::::::::///

///:: REESTABLECE EL COLOR DE LOS CAMPOS INVALIDOS ::::::::::::::::::::::::::::::::::::::::/// 
function f_limpia_observaciones(){
  $("#obs_chl_codigo").removeClass("color-error");
  $("#obs_chl_descripcion").removeClass("color-error");
  $("#obs_chl_componente").removeClass("color-error");
  $("#obs_chl_posicion").removeClass("color-error");
  $("#obs_chl_falla").removeClass("color-error");
  $("#obs_chl_accion").removeClass("color-error");
}
///:: FIN REESTABLECE EL COLOR DE LOS CAMPOS INVALIDOS ::::::::::::::::::::::::::::::::::::///

///:: GENERACION DE TABLA DE OBSERVACIONES CHECK LIST :::::::::::::::::::::::::::::::::::::///
function f_tabla_check_list_observaciones(p_check_list_id, p_chl_estado){
  div_tabla = f_CreacionTabla("tabla_check_list_observaciones",p_chl_estado);
  $("#div_tabla_check_list_observaciones").html(div_tabla);
  columnas_tabla = f_ColumnasTabla("tabla_check_list_observaciones",p_chl_estado);

  $("#tabla_check_list_observaciones").dataTable().fnDestroy();
  $('#tabla_check_list_observaciones').show();

  Accion='buscar_check_list_observaciones';
  $.ajax({
    url       : "Ajax.php",
    type      : "POST",
    datatype  : "json",    
    async     : false,
    data      :  { MoS:MoS,NombreMoS:NombreMoS,Accion:Accion, check_list_id:p_check_list_id },    
    success: function(data) {
      array_observaciones = $.parseJSON(data);
    }
  });


  tabla_check_list_observaciones = $('#tabla_check_list_observaciones').DataTable({
    language      : idioma_espanol,
    searching     : true,
    info          : true,
    lengthChange  : true,
    paging        : true,
    pageLength    : 25,
    responsive    : "true",
    data          : array_observaciones,
    columns       : columnas_tabla
  });    
}
///:: FIN GENERACION DE TABLA DE OBSERVACIONES CHECK LIST :::::::::::::::::::::::::::::::::///

function f_cargar_datos_observaciones(){
  f_limpia_observaciones();
  select_chl_obs = f_select_combo("manto_check_list_codigo", "NO", "chl_codigo", "", "`chl_bus_tipo`='"+obs_chl_bus_tipo+"'","`chl_orden`");
  $("#obs_chl_codigo").html(select_chl_obs);
  obs_check_list_id = check_list_id;
  obs_chl_codigo = "";
  obs_chl_descripcion = "";
  obs_chl_componente = "";
  obs_chl_posicion = "";
  obs_chl_falla = "";
  obs_chl_accion = "";
  
  $("#obs_chl_posicion").prop("disabled",false);
  $("#obs_chl_falla").prop("disabled",false);
  $("#obs_chl_accion").prop("disabled",false);

  $("#obs_chl_codigo").val(obs_chl_codigo);
  $("#obs_chl_descripcion").val(obs_chl_descripcion);
  $("#obs_chl_componente").val(obs_chl_componente);
  $("#obs_chl_posicion").val(obs_chl_posicion);
  $("#obs_chl_falla").val(obs_chl_falla);
  $("#obs_chl_accion").val(obs_chl_accion);
  $("#obs_chl_codigo").focus().select();
}

///:: TERMINO FUNCIONES REGISTRO DE INSPECCION DE FLOTA :::::::::::::::::::::::::::::::::::///