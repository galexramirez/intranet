///::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
///:: REGISTRO INSPECCION FLOTA v 1.0 :::::::::::::::::::::::::::::::::::::::::::::::::::::///
///:: DETALLE DE OBSERVACIONES DE INSPECCION ::::::::::::::::::::::::::::::::::::::::::::::///
///::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///

///:: DECLARACIONES DE VARIABLES GLOBALES :::::::::::::::::::::::::::::::::::::::::::::::::///
var opcion_inspeccion_registro, reg_inspeccion_id, reg_inspeccion_bus, a_inspeccion_bus, array_posicion, array_movimiento, tabla_inspeccion_registro_posicion, fila_inspeccion_registro;
var reg_insp_bus_tipo, reg_insp_codigo, reg_insp_posicion, reg_insp_falla, reg_insp_accion, reg_insp_descripcion;

///:: JS DOM REGISTRO INSPECCION FLOTA ::::::::::::::::::::::::::::::::::::::::::::::::::::///
$(document).ready(function(){
  let select_reg_insp = "", contar_posicion="", contar_falla="", contar_accion="";
  div_show = f_MostrarDiv("form_seleccion_inspeccion_registro","btn_seleccion_inspeccion_registro","");
  $("#div_btn_seleccion_inspeccion_registro").html(div_show);

  $("#reg_inspeccion_id").on('change', function () {
    reg_inspeccion_id = $("#reg_inspeccion_id").val();
    reg_inspeccion_bus = "";
    select_reg_insp = f_select_combo("manto_inspeccion_detalle", "NO", "insp_bus", "", "`inspeccion_id`='"+reg_inspeccion_id+"' AND `insp_detalle_estado`='PENDIENTE'", "`insp_bus`");
    $("#reg_inspeccion_bus").html(select_reg_insp);      
    $("#reg_inspeccion_bus").val(reg_inspeccion_bus);
    div_show = f_MostrarDiv("form_seleccion_inspeccion_registro","btn_seleccion_inspeccion_registro","");
    $("#div_btn_seleccion_inspeccion_registro").html(div_show);    
    $("#div_card_columns_inspeccion_registro").empty();
    $("#div_btn_enviar_inspeccion_registro").empty();
  });

  $("#reg_inspeccion_bus").on('change', function () {
    div_show = f_MostrarDiv("form_seleccion_inspeccion_registro","btn_seleccion_inspeccion_registro","");
    $("#div_btn_seleccion_inspeccion_registro").html(div_show);  
    $("#div_card_columns_inspeccion_registro").empty();
    $("#div_btn_enviar_inspeccion_registro").empty();
  });

  ///:: SELECCION INSPECCION COMPONENTE DE INSPECCION DE FLOTA ::::::::::::::::::::::::::::///
  $("#reg_insp_componente").on('change', function () {
    $("#reg_insp_posicion").prop("disabled",false);
    $("#reg_insp_falla").prop("disabled",false);
    $("#reg_insp_accion").prop("disabled",false);
    reg_insp_componente = $("#reg_insp_componente").val();
    contar_posicion = f_contar_dato("manto_inspeccion_posicion","insp_posicion","`insp_bus_tipo`='"+reg_insp_bus_tipo+"' AND `insp_codigo`='"+reg_insp_codigo+"' AND `insp_componente`='"+reg_insp_componente+"'");
    reg_insp_falla = "";
    reg_insp_accion = "";

    if(contar_posicion=="1"){
      reg_insp_posicion = f_buscar_dato("manto_inspeccion_posicion","insp_posicion","`insp_bus_tipo`='"+reg_insp_bus_tipo+"' AND `insp_codigo`='"+reg_insp_codigo+"' AND `insp_componente`='"+reg_insp_componente+"'");
      $("#reg_insp_falla").focus().select();
      $("#reg_insp_posicion").prop("disabled",true);
    }else{
      reg_insp_posicion = '';
    }

    select_reg_insp = f_select_combo("manto_inspeccion_posicion","NO","insp_posicion","","`insp_bus_tipo`='"+reg_insp_bus_tipo+"' AND `insp_codigo`='"+reg_insp_codigo+"' AND `insp_componente`='"+reg_insp_componente+"'","CAST(`insp_posicion` AS UNSIGNED)");
    $("#reg_insp_posicion").html(select_reg_insp);

    contar_falla = f_contar_dato("manto_inspeccion_falla_accion","insp_falla","`insp_bus_tipo`='"+reg_insp_bus_tipo+"' AND `insp_codigo`='"+reg_insp_codigo+"' AND `insp_componente`='"+reg_insp_componente+"'");

    if(contar_posicion=="1" && contar_falla=="1"){
      reg_insp_falla = f_buscar_dato("manto_inspeccion_falla_accion","insp_falla","`insp_bus_tipo`='"+reg_insp_bus_tipo+"' AND `insp_codigo`='"+reg_insp_codigo+"' AND `insp_componente`='"+reg_insp_componente+"'");
      $("#reg_insp_accion").focus().select();
      $("#reg_insp_falla").prop("disabled",true);
    }else{
      reg_insp_falla = "";
    }

    select_reg_insp = f_select_combo("manto_inspeccion_falla_accion","SI","insp_falla","","`insp_bus_tipo`='"+reg_insp_bus_tipo+"' AND `insp_codigo`='"+reg_insp_codigo+"' AND `insp_componente`='"+reg_insp_componente+"'","`insp_falla`");
    $("#reg_insp_falla").html(select_reg_insp);

    contar_accion = f_contar_dato("manto_inspeccion_falla_accion","insp_accion","`insp_bus_tipo`='"+reg_insp_bus_tipo+"' AND `insp_codigo`='"+reg_insp_codigo+"' AND `insp_componente`='"+reg_insp_componente+"' AND `insp_falla`='"+reg_insp_falla+"'");

    if(contar_posicion=="1" && contar_falla=="1" && contar_accion=="1"){
      reg_insp_accion = f_buscar_dato("manto_inspeccion_falla_accion","insp_accion","`insp_bus_tipo`='"+reg_insp_bus_tipo+"' AND `insp_codigo`='"+reg_insp_codigo+"' AND `insp_componente`='"+reg_insp_componente+"' AND `insp_falla`='"+reg_insp_falla+"'");
      $("#btn_agregar_inspeccion_registro_posicion").focus().select();      
      $("#reg_insp_accion").prop("disabled",true);
    }else{
      reg_insp_accion = "";
    }

    select_reg_insp = f_select_combo("manto_inspeccion_falla_accion","NO","insp_accion","","`insp_bus_tipo`='"+reg_insp_bus_tipo+"' AND `insp_codigo`='"+reg_insp_codigo+"' AND `insp_componente`='"+reg_insp_componente+"' AND `insp_falla`='"+reg_insp_falla+"'","`insp_accion`");
    $("#reg_insp_accion").html(select_reg_insp);
    
    $("#reg_insp_posicion").val(reg_insp_posicion);
    $("#reg_insp_falla").val(reg_insp_falla);
    $("#reg_insp_accion").val(reg_insp_accion);
  });
  ///:: FIN SELECCION INSPECCION COMPONENTE DE INSPECCION DE FLOTA ::::::::::::::::::::::::///

  ///:: SELECCION INSPECCION POSICION DE INSPECCION DE FLOTA ::::::::::::::::::::::::::::::///
  $("#reg_insp_posicion").on('change', function (){
    $("#reg_insp_falla").prop("disabled",false);
    $("#reg_insp_accion").prop("disabled",false);
    reg_insp_accion = "";
    contar_falla = f_contar_dato("manto_inspeccion_falla_accion","insp_falla","`insp_bus_tipo`='"+reg_insp_bus_tipo+"' AND `insp_codigo`='"+reg_insp_codigo+"' AND `insp_componente`='"+reg_insp_componente+"'");

    if(contar_falla=="1"){
      reg_insp_falla = f_buscar_dato("manto_inspeccion_falla_accion","insp_falla","`insp_bus_tipo`='"+reg_insp_bus_tipo+"' AND `insp_codigo`='"+reg_insp_codigo+"' AND `insp_componente`='"+reg_insp_componente+"'");
      $("#reg_insp_accion").focus().select();
      $("#reg_insp_falla").prop("disabled",true);
    }else{
      reg_insp_falla = "";
    }

    select_reg_insp = f_select_combo("manto_inspeccion_falla_accion","NO","insp_accion","","`insp_bus_tipo`='"+reg_insp_bus_tipo+"' AND `insp_codigo`='"+reg_insp_codigo+"' AND `insp_componente`='"+reg_insp_componente+"' AND `insp_falla`='"+reg_insp_falla+"'","`insp_accion`");
    $("#reg_insp_accion").html(select_reg_insp);

    contar_accion = f_contar_dato("manto_inspeccion_falla_accion","insp_accion","`insp_bus_tipo`='"+reg_insp_bus_tipo+"' AND `insp_codigo`='"+reg_insp_codigo+"' AND `insp_componente`='"+reg_insp_componente+"' AND `insp_falla`='"+reg_insp_falla+"'");

    if(contar_falla=="1" && contar_accion=="1"){
      reg_insp_accion = f_buscar_dato("manto_inspeccion_falla_accion","insp_accion","`insp_bus_tipo`='"+reg_insp_bus_tipo+"' AND `insp_codigo`='"+reg_insp_codigo+"' AND `insp_componente`='"+reg_insp_componente+"' AND `insp_falla`='"+reg_insp_falla+"'");
      $("#btn_agregar_inspeccion_registro_posicion").focus().select();      
      $("#reg_insp_accion").prop("disabled",true);
    }else{
      reg_insp_accion = "";
    }

    select_reg_insp = f_select_combo("manto_inspeccion_falla_accion","NO","insp_accion","","`insp_bus_tipo`='"+reg_insp_bus_tipo+"' AND `insp_codigo`='"+reg_insp_codigo+"' AND `insp_componente`='"+reg_insp_componente+"' AND `insp_falla`='"+reg_insp_falla+"'","`insp_accion`");
    $("#reg_insp_accion").html(select_reg_insp);

    $("#reg_insp_falla").val(reg_insp_falla);
    $("#reg_insp_accion").val(reg_insp_accion);
  })
  ///:: FIN SELECCION INSPECCION POSICION DE INSPECCION DE FLOTA ::::::::::::::::::::::::::///

  ///:: SELECCION INSPECCION FALLA DE INSPECCION DE FLOTA :::::::::::::::::::::::::::::::::///
  $("#reg_insp_falla").on('change', function (){
    $("#reg_insp_accion").prop("disabled",false);
    reg_insp_falla = $("#reg_insp_falla").val();
    contar_accion = f_contar_dato("manto_inspeccion_falla_accion","insp_accion","`insp_bus_tipo`='"+reg_insp_bus_tipo+"' AND `insp_codigo`='"+reg_insp_codigo+"' AND `insp_componente`='"+reg_insp_componente+"' AND `insp_falla`='"+reg_insp_falla+"'");
    reg_insp_accion = "";
    select_reg_insp = f_select_combo("manto_inspeccion_falla_accion","NO","insp_accion","","`insp_bus_tipo`='"+reg_insp_bus_tipo+"' AND `insp_codigo`='"+reg_insp_codigo+"' AND `insp_componente`='"+reg_insp_componente+"' AND `insp_falla`='"+reg_insp_falla+"'","`insp_accion`");
    $("#reg_insp_accion").html(select_reg_insp);

    if(contar_accion=="1"){
      reg_insp_accion = f_buscar_dato("manto_inspeccion_falla_accion","insp_accion","`insp_bus_tipo`='"+reg_insp_bus_tipo+"' AND `insp_codigo`='"+reg_insp_codigo+"' AND `insp_componente`='"+reg_insp_componente+"' AND `insp_falla`='"+reg_insp_falla+"'");
      $("#btn_agregar_inspeccion_registro_posicion").focus().select();      
      $("#reg_insp_accion").prop("disabled",true);
    }else{
      reg_insp_accion = "";
    }

    $("#reg_insp_accion").val(reg_insp_accion);
  })
  ///:: FIN SELECCION INSPECCION FALLA DE INSPECCION DE FLOTA :::::::::::::::::::::::::::::///

  ///:: INICIO BOTONES DE INSPECCION REGISTRO :::::::::::::::::::::::::::::::::::::::::::::///
  
  ///:: EVENTO BOTON BUSCAR REGISTRO DE INSPECCION DE FLOTA :::::::::::::::::::::::::::::::///
  $(document).on("click", ".btn_buscar_inspeccion_bus", function(){
    let html_card_columns = ""
    reg_inspeccion_id = $("#reg_inspeccion_id").val();
    reg_inspeccion_bus = $("#reg_inspeccion_bus").val();

    let valida_fecha_inspeccion = f_valida_fecha_inspeccion(reg_inspeccion_id);
    
    if(valida_fecha_inspeccion=="SI"){
      if (reg_inspeccion_id!="" && reg_inspeccion_bus!=""){
        html_card_columns = f_buscar_inspeccion_registro(reg_inspeccion_id, reg_inspeccion_bus, "html");
        $("#div_card_columns_inspeccion_registro").html(html_card_columns);
        a_inspeccion_bus = f_buscar_inspeccion_registro(reg_inspeccion_id, reg_inspeccion_bus, "array");
        array_movimiento = [];
        div_show = f_MostrarDiv("form_seleccion_inspeccion_registro","btn_seleccion_inspeccion_registro","");
        $("#div_btn_seleccion_inspeccion_registro").html(div_show);
        div_show = f_MostrarDiv("form_seleccion_inspeccion_registro","btn_enviar_inspeccion_registro",reg_inspeccion_bus);
        $("#div_btn_enviar_inspeccion_registro").html(div_show);
        reg_insp_bus_tipo = f_buscar_dato("manto_inspeccion_registro","insp_bus_tipo","`inspeccion_id`='"+reg_inspeccion_id+"'");
      }else{
          Swal.fire(
            'Información!',
            'Falta completar información.',
            'success'
          )
      }  
    }else{
      Swal.fire({
        position            : 'center',
        icon                : 'error',
        title               : '*Inconsistencia entre fecha actual y programada!!!',
        showConfirmButton   : false,
        timer               : 1500
      })
    }

  });
  ///:: FIN EVENTO BOTON BUSCAR REGISTRO DE INSPECCION DE FLOTA :::::::::::::::::::::::::::///

  ///:: EVENTO BOTON GUARDAR REGISTRO DE INSPECCION DE FLOTA ::::::::::::::::::::::::::::::///
  $(document).on("click", ".btn_enviar_inspeccion_registro", function(){
    let a_data_bus = [];
    let a_data_movimiento = [];
    let codigos_pendientes = "NO";
    
    a_inspeccion_bus.forEach(obj => {
      if(obj.insp_estado_codigo==""){
        codigos_pendientes = "SI";
      }
    })

    if(codigos_pendientes=="SI"){
      Swal.fire({
        icon  : 'error',
        title : 'INSPECCION...',
        text  : 'Códigos de Inspección Pendientes !!!'
      })

    }else{
      $("#btn_enviar_inspeccion_registro").prop("disabled",true); 
      a_data_bus = JSON.stringify(a_inspeccion_bus);
      a_data_movimiento = JSON.stringify(array_movimiento);
      Accion = "guardar_inspeccion_bus";   
      $.ajax({
        url       : "Ajax.php",
        type      : "POST",
        datatype  : "json",
        async     : false,
        data      :  { MoS:MoS, NombreMoS:NombreMoS, Accion:Accion, a_data_bus:a_data_bus, a_data_movimiento:a_data_movimiento },
        success   : function(data) {
          Swal.fire(
            'Guardado!',
            'El registro ha sido guardado.',
            'success'
          )            
        }
      });
      reg_inspeccion_id = $("#reg_inspeccion_id").val();
      reg_inspeccion_bus = "";
      select_reg_insp = f_select_combo("manto_inspeccion_detalle", "NO", "insp_bus", "", "`inspeccion_id`='"+reg_inspeccion_id+"' AND `insp_detalle_estado`='PENDIENTE'", "`insp_bus`");
      $("#reg_inspeccion_bus").html(select_reg_insp);      
      $("#reg_inspeccion_bus").val(reg_inspeccion_bus);
      div_show = f_MostrarDiv("form_seleccion_inspeccion_registro","btn_seleccion_inspeccion_registro","");
      $("#div_btn_seleccion_inspeccion_registro").html(div_show);    
      $("#div_card_columns_inspeccion_registro").empty();
      $("#div_btn_enviar_inspeccion_registro").empty();
      $("#btn_enviar_inspeccion_registro").prop("disabled",false);
    }
  });
  ///:: FIN EVENTO BOTON BUSCAR REGISTRO DE INSPECCION DE FLOTA :::::::::::::::::::::::::::///

  ///:: BOTON AGREGAR NUEVA INSPECCION COMPONENTE Y POSICION DE FLOTA :::::::::::::::::::::///
  $(document).on("click", ".btn_agregar_inspeccion_registro_posicion", function(){
    let array_valida_posicion = [];
    let valida_agregar = '';
    let t_msg = '';
    reg_insp_componente = $.trim($('#reg_insp_componente').val());
    reg_insp_posicion   = $.trim($('#reg_insp_posicion').val());    
    reg_insp_falla      = $.trim($('#reg_insp_falla').val());
    reg_insp_accion     = $.trim($('#reg_insp_accion').val());

    valida_agregar = f_valida_agregar_posicion(reg_insp_componente, reg_insp_posicion, reg_insp_falla, reg_insp_accion);
    if(valida_agregar=="invalido"){
      t_msg += 'Falta Completar Información!!!';
    }
    array_valida_posicion = tabla_inspeccion_registro_posicion.rows().data().toArray();

    $.each(array_valida_posicion, function(idx, obj){ 
      if(reg_insp_componente==obj.insp_componente && reg_insp_posicion==obj.insp_posicion && reg_insp_falla==obj.insp_falla){
        valida_agregar = "invalido";
        t_msg += "Falla ya registrada!!!";
      }
    });

    if(valida_agregar=="invalido"){
      Swal.fire({
        position          : 'center',
        icon              : 'error',
        title             : t_msg,
        showConfirmButton : false,
        timer             : 1500
      })
    }else{
      $("#btn_agregar_inspeccion_registro_posicion").prop("disabled",true);

      tabla_inspeccion_registro_posicion.row.add( {
        "insp_componente" : reg_insp_componente,
        "insp_posicion"   : reg_insp_posicion,
        "insp_falla"      : reg_insp_falla,
        "insp_accion"     : reg_insp_accion
      } ).draw();

      select_reg_insp = f_select_combo("manto_inspeccion_componente", "SI", "insp_componente", "",  "`insp_bus_tipo`='"+reg_insp_bus_tipo+"' AND `insp_codigo`='"+reg_insp_codigo+"'", "`insp_componente`");
      $("#reg_insp_componente").html(select_reg_insp);
      $("#reg_insp_posicion").html("");
      $("#reg_insp_falla").html("");
      $("#reg_insp_accion").html("");    

      reg_insp_componente = "";
      reg_insp_posicion = "";
      reg_insp_falla = "";
      reg_insp_accion = "";

      $("#reg_insp_componente").val(reg_insp_componente);
      $("#reg_insp_posicion").val(reg_insp_posicion);
      $("#reg_insp_falla").val(reg_insp_falla);
      $("#reg_insp_accion").val(reg_insp_accion);
      $("#btn_agregar_inspeccion_registro_posicion").prop("disabled",false);

      $("#reg_insp_posicion").prop("disabled",false);
      $("#reg_insp_falla").prop("disabled",false);
      $("#reg_insp_accion").prop("disabled",false);

      f_registrar_inspeccion_registro_posicion();
    }
  });
  ///:: FIN BOTON AGREGAR NUEVA INSPECCION COMPONENTE Y POSICION DE FLOTA :::::::::::::::::///

  ///:: BOTON BORRAR INSPECCION COMPONENTE Y POSICION :::::::::::::::::::::::::::::::::::::///
  $(document).on("click", ".btn_borrar_inspeccion_registro_posicion", function(){
    fila_inspeccion_registro = $(this); 
    reg_insp_componente = fila_inspeccion_registro.closest('tr').find('td:eq(0)').text();
    reg_insp_posicion = fila_inspeccion_registro.closest('tr').find('td:eq(1)').text();
    reg_insp_falla = fila_inspeccion_registro.closest('tr').find('td:eq(2)').text();
    Swal.fire({
      title: '¿Está seguro?',
      text: "Se eliminará el Comp.: "+reg_insp_componente+" Posic.: "+reg_insp_posicion+" Falla: "+reg_insp_falla+"!!!",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Si, eliminar!'
    }).then((result) => 
    {
      if (result.isConfirmed){
        tabla_inspeccion_registro_posicion
        .row( fila_inspeccion_registro.parents('tr') )
        .remove()
        .draw();
        Swal.fire(
          'Eliminado!',
          'El registro ha sido elimidado.',
          'success')
        f_registrar_inspeccion_registro_posicion();
      }
    });
  });
  ///:: FIN BORRAR INSPECCION COMPONENTE Y POSICION :::::::::::::::::::::::::::::::::::::::///

  ///:: TERMINO BOTONES DE INSPECCION REGISTRO ::::::::::::::::::::::::::::::::::::::::::::///
});
///:: FUNCIONES REGISTRO DE INSPECCION DE FLOTA :::::::::::::::::::::::::::::::::::::::::::///

///:: FUNCION PARA VALIDAR LOS DATOS INGRESADOS AL FORMULARIO :::::::::::::::::::::::::::::///
function f_valida_agregar_posicion(p_reg_insp_componente, p_reg_insp_posicion, p_reg_insp_falla, p_reg_insp_accion){
  f_limpia_inspeccion_registro();
  let rpta_valida_agregar_posicion = "";
  if(p_reg_insp_componente==""){
    $("#reg_insp_componente").addClass("color-error");
    rpta_valida_agregar_posicion = "invalido";
  }
  if(p_reg_insp_posicion==""){
    $("#reg_insp_posicion").addClass("color-error");
    rpta_valida_agregar_posicion = "invalido";
  }
  if(p_reg_insp_falla==""){
    $("#reg_insp_falla").addClass("color-error");
    rpta_valida_agregar_posicion = "invalido";
  }
  if(p_reg_insp_accion==""){
    $("#reg_insp_accion").addClass("color-error");
    rpta_valida_agregar_posicion = "invalido";
  }
  return rpta_valida_agregar_posicion;
}
///:: FUNCION PARA VALIDAR LOS DATOS INGRESADOS AL FORMULARIO :::::::::::::::::::::::::::::///

///:: REESTABLECE EL COLOR DE LOS CAMPOS INVALIDOS ::::::::::::::::::::::::::::::::::::::::/// 
function f_limpia_inspeccion_registro(){
  $("#reg_insp_componente").removeClass("color-error");
  $("#reg_insp_posicion").removeClass("color-error");
  $("#reg_insp_falla").removeClass("color-error");
  $("#reg_insp_accion").removeClass("color-error");
}
///:: FIN REESTABLECE EL COLOR DE LOS CAMPOS INVALIDOS ::::::::::::::::::::::::::::::::::::///

///:: FUNCION BUSCAR LOS CODIGOS DE INSPECCION POR BUS ::::::::::::::::::::::::::::::::::::///
function f_buscar_inspeccion_registro(p_inspeccion_id, p_inspeccion_bus, p_tipo_data){
  let rpta_html = "";
  let rpta_arreglo = [];
  Accion = 'buscar_inspeccion_bus';
  $.ajax({
    url       : "Ajax.php",
    type      : "POST",
    datatype  : "json",
    async     : false,
    data      : { MoS:MoS, NombreMoS:NombreMoS, Accion:Accion, inspeccion_id:p_inspeccion_id, insp_bus:p_inspeccion_bus, tipo_data:p_tipo_data },
    success   : function(data){
      if(p_tipo_data=="html"){
        rpta_html = data;
      }else{
        rpta_arreglo = $.parseJSON(data);
      }
    }
  });
  if(p_tipo_data=="html"){
    return rpta_html;
  }else{
    return rpta_arreglo;
  }
}
///:: FIN FUNCION BUSCAR LOS CODIGOS DE INSPECCION POR BUS ::::::::::::::::::::::::::::::::///

///:: FUNCION INSPECCION POR BUS CORRECTO :::::::::::::::::::::::::::::::::::::::::::::::::///
function f_codigo_observado(p_codigo_inspeccion){
  f_limpia_inspeccion_registro();
  reg_insp_codigo = p_codigo_inspeccion;
  array_posicion = [];
  reg_insp_descripcion = f_buscar_dato("manto_inspeccion_codigo","insp_descripcion","`insp_bus_tipo`='"+reg_insp_bus_tipo+"' AND `insp_codigo`='"+reg_insp_codigo+"'");
  select_reg_insp = f_select_combo("manto_inspeccion_componente", "SI", "insp_componente", "",  "`insp_bus_tipo`='"+reg_insp_bus_tipo+"' AND `insp_codigo`='"+reg_insp_codigo+"'", "`insp_componente`");
  $("#reg_insp_componente").html(select_reg_insp);
  $("#reg_insp_posicion").html("");
  $("#reg_insp_falla").html("");
  $("#reg_insp_accion").html("");
  if(array_movimiento.length>0){
    array_posicion = array_movimiento.filter(function(movimiento){
      return movimiento.insp_codigo==reg_insp_codigo;
    });
    array_movimiento = array_movimiento.filter(function(movimiento){
      return movimiento.insp_codigo!==reg_insp_codigo;
    });
  }
  
  reg_insp_componente = "";
  reg_insp_posicion = "";
  reg_insp_falla = "";
  reg_insp_accion = "";
  
  $("#reg_insp_posicion").prop("disabled",false);
  $("#reg_insp_falla").prop("disabled",false);
  $("#reg_insp_accion").prop("disabled",false);

  $("#reg_insp_componente").val(reg_insp_componente);
  $("#reg_insp_posicion").val(reg_insp_posicion);
  $("#reg_insp_falla").val(reg_insp_falla);
  $("#reg_insp_accion").val(reg_insp_accion);
  f_tabla_inspeccion_registro_posicion();
      
  $(".modal-header").css( "background-color", "#17a2b8");
  $(".modal-header").css( "color", "white" );
  $(".modal-title").text( "BUS "+reg_inspeccion_bus+" COD. "+reg_insp_descripcion );
  $('#modal_crud_inspeccion_registro_posicion').modal('show');
}
///:: FIN FUNCION INSPECCION POR BUS CORRECTO :::::::::::::::::::::::::::::::::::::::::::::///

///:: FUNCION INSPECCION POR BUS OBSERVADO ::::::::::::::::::::::::::::::::::::::::::::::::///
function f_codigo_correcto(p_codigo_inspeccion){
  let c_html = "";
  let c_div = "#div_thumbs_"+p_codigo_inspeccion;
  let c_id_card_header = ".card_header_codigo_"+p_codigo_inspeccion;
  let c_card_header = document.querySelector(c_id_card_header);
  reg_insp_codigo = p_codigo_inspeccion;
  c_html = '<i class="bi bi-check-circle-fill" style="color:green"><svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-check-circle-fill" viewBox="0 0 16 16"><path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/></svg></i>';

  a_inspeccion_bus.forEach(obj => {
    if(obj.insp_codigo==p_codigo_inspeccion){
      if(obj.insp_estado_codigo!=""){
        if(obj.insp_estado_codigo!="CORRECTO"){
          Swal.fire(
            'Correcto!',
            'El código esta cambiando de estado.',
            'success')
        }
      }
      obj.insp_estado_codigo = "CORRECTO";
    }
  })
  if(array_movimiento.length>0){
    array_movimiento = array_movimiento.filter(function(movimiento){
      return movimiento.insp_codigo!==reg_insp_codigo;
    });
  }

  $(c_div).html(c_html);
  c_card_header.style.background = "darkseagreen";

}
///:: FIN FUNCION INSPECCION POR BUS OBSERVADO ::::::::::::::::::::::::::::::::::::::::::::///

///:: FUNCION INSPECCION POR BUS OBSERVADO ::::::::::::::::::::::::::::::::::::::::::::::::///
function f_codigo_no_inspeccionado(p_codigo_inspeccion){
  let n_html = "";
  let n_div = "#div_thumbs_"+p_codigo_inspeccion;
  let n_id_card_header = ".card_header_codigo_"+p_codigo_inspeccion;
  let n_card_header = document.querySelector(n_id_card_header);
  reg_insp_codigo = p_codigo_inspeccion;
  n_html = '<i class="bi bi-exclamation-circle-fill" style="color:orange"><svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-exclamation-circle-fill" viewBox="0 0 16 16"><path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8 4a.905.905 0 0 0-.9.995l.35 3.507a.552.552 0 0 0 1.1 0l.35-3.507A.905.905 0 0 0 8 4zm.002 6a1 1 0 1 0 0 2 1 1 0 0 0 0-2z"/></svg></i>';

  a_inspeccion_bus.forEach(obj => {
    if(obj.insp_codigo==p_codigo_inspeccion){
      if(obj.insp_estado_codigo!=""){
        if(obj.insp_estado_codigo!="NO INSPECCIONADO"){
          Swal.fire(
            'No Inspeccionado!',
            'El código esta cambiando de estado.',
            'success')
        }
      }
      obj.insp_estado_codigo = "NO INSPECCIONADO";
    }
  })

  if(array_movimiento.length>0){
    array_movimiento = array_movimiento.filter(function(movimiento){
      return movimiento.insp_codigo!==reg_insp_codigo;
    });
  }

  $(n_div).html(n_html);
  n_card_header.style.background = "bisque";
}
///:: FIN FUNCION INSPECCION POR BUS OBSERVADO ::::::::::::::::::::::::::::::::::::::::::::///

///:: GENERACION DE TABLA DE DETALLE DE REPUESTOS :::::::::::::::::::::::::::::::::::::::::///
function f_tabla_inspeccion_registro_posicion(){
  div_tabla = f_CreacionTabla("tabla_inspeccion_registro_posicion","");
  $("#div_tabla_inspeccion_registro_posicion").html(div_tabla);
  columnas_tabla = f_ColumnasTabla("tabla_inspeccion_registro_posicion","");

  $("#tabla_inspeccion_registro_posicion").dataTable().fnDestroy();
  $('#tabla_inspeccion_registro_posicion').show();

  tabla_inspeccion_registro_posicion = $('#tabla_inspeccion_registro_posicion').DataTable({
    language      : idioma_espanol,
    searching     : false,
    info          : false,
    lengthChange  : false,
    paging        : false,
    //pageLength    : 10,
    responsive    : "true",
    data          : array_posicion,
    columns       : columnas_tabla
  });     
}
///:: FIN GENERACION DE TABLA DE DETALLE DE REPUESTOS :::::::::::::::::::::::::::::::::::::///

function f_registrar_inspeccion_registro_posicion(){
  let t_html = "";
  let t_div = "#div_thumbs_"+reg_insp_codigo;
  let t_id_card_header = ".card_header_codigo_"+reg_insp_codigo;
  let t_card_header = document.querySelector(t_id_card_header);

  array_posicion = tabla_inspeccion_registro_posicion.rows().data().toArray();
  array_movimiento = array_movimiento.filter(function(movimiento){
    return movimiento.insp_codigo!==reg_insp_codigo;
  });

  if(array_posicion.length>0){
    array_posicion.forEach(obj => {
      reg_insp_descripcion = f_buscar_dato("manto_inspeccion_codigo","insp_descripcion","`insp_bus_tipo`='"+reg_insp_bus_tipo+"' AND `insp_codigo`='"+reg_insp_codigo+"'");
      array_movimiento.push({"inspeccion_id":reg_inspeccion_id, "insp_bus_tipo":reg_insp_bus_tipo, "insp_bus":reg_inspeccion_bus, "insp_codigo":reg_insp_codigo, "insp_descripcion":reg_insp_descripcion, "insp_componente":obj.insp_componente, "insp_posicion":obj.insp_posicion, "insp_falla":obj.insp_falla, "insp_accion":obj.insp_accion});
    });
    t_html = '<i class="bi bi-x-circle-fill" style="color:red"><svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-x-circle-fill" viewBox="0 0 16 16"><path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM5.354 4.646a.5.5 0 1 0-.708.708L7.293 8l-2.647 2.646a.5.5 0 0 0 .708.708L8 8.707l2.646 2.647a.5.5 0 0 0 .708-.708L8.707 8l2.647-2.646a.5.5 0 0 0-.708-.708L8 7.293 5.354 4.646z"/></svg></i>';
    $(t_div).html(t_html);
    t_card_header.style.background = "lightcoral";

    a_inspeccion_bus.forEach(obj => {
      if(obj.insp_codigo==reg_insp_codigo){
        if(obj.insp_estado_codigo!=""){
          if(obj.insp_estado_codigo!="OBSERVADO"){
            Swal.fire(
              'Observado!',
              'El código esta cambiando de estado.',
              'success')
          }
        }  
        obj.insp_estado_codigo = "OBSERVADO";
      } 
    });  
  }else{
    $(t_div).html(t_html);
    t_card_header.style.background = "rgba(0,0,0,.03)";
    a_inspeccion_bus.forEach(obj => {
      if(obj.insp_codigo==reg_insp_codigo){
        obj.insp_estado_codigo = "";
      } 
    });  
  }
}

///:: TERMINO FUNCIONES REGISTRO DE INSPECCION DE FLOTA :::::::::::::::::::::::::::::::::::///