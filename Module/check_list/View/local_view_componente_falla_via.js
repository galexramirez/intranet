///::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
///:: COMPONENTE DE CODIGO DE FALLA EN VIA v 1.0 FECHA: 2023-09-25 ::::::::::::::::::::::::///
///:: CREAR EDITAR ELIMINAR COMPONENTE DE FALLA EN VIA DE FLOTA :::::::::::::::::::::::::::///
///::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///

///:: DECLARACION VARIABLES GLOBALES ::::::::::::::::::::::::::::::::::::::::::::::::::::::///
var tabla_falla_via_componente, opcion_falla_via_componente, com_falla_via_flota, com_falla_via_codigo, fila_falla_via_componente;
var falla_via_componente_id, com_fav_bus_tipo, com_fav_codigo, com_fav_descripcion, com_fav_componente;

///:: INICIO JS DOM COMPONENTES DE FALLA EN VIA :::::::::::::::::::::::::::::::::::::::::::///
$(document).ready(function(){
  let select_falla_via_componente="";

  select_falla_via_componente = f_select_combo("manto_tc_check_list", "NO", "tc_categoria3", "",  "`tc_categoria1`='FALLA EN VIA' AND `tc_categoria2`='TIPO BUS'", "`tc_categoria3`");
  $("#com_falla_via_flota").html(select_falla_via_componente);

  div_boton = f_BotonesFormulario("form_seleccion_falla_via_componente","btn_seleccion_falla_via_componente");
  $("#div_btn_seleccion_falla_via_componente").html(div_boton);

  $("#com_falla_via_flota, #com_falla_via_codigo").on('change', function () {
    $("#div_tabla_falla_via_componente").empty();
    $("#div_tabla_falla_via_falla_accion").empty();
    $("#div_tabla_falla_via_posicion").empty();
  });

  $("#com_falla_via_flota").on('change', function () {
    com_falla_via_flota = $("#com_falla_via_flota").val();
    com_falla_via_codigo = "";
    $("#fal_falla_via_flota").val(com_falla_via_flota);
    $("#pos_falla_via_flota").val(com_falla_via_flota);
    select_falla_via_componente = f_select_codigo_falla_via(com_falla_via_flota);
    $("#com_falla_via_codigo").html(select_falla_via_componente);
    $("#fal_falla_via_codigo").html(select_falla_via_componente);
    $("#pos_falla_via_codigo").html(select_falla_via_componente);
    select_falla_via_componente = f_select_combo("manto_falla_via_componente", "NO", "fav_componente", "", "`fav_bus_tipo`='"+com_falla_via_flota+"' AND `fav_codigo`='"+com_falla_via_codigo+"'", "`fav_componente`");
    $("#fal_falla_via_componente").html(select_falla_via_componente);
    $("#pos_falla_via_componente").html(select_falla_via_componente);
    $("#com_falla_via_codigo").val(com_falla_via_codigo);
    $("#fal_falla_via_codigo").val(com_falla_via_codigo);
    $("#fal_falla_via_componente").val("");
    $("#pos_falla_via_codigo").val("");
    $("#pos_falla_via_componente").val("");

  });

  $("#com_falla_via_codigo").on('change', function () {
    com_falla_via_flota = $("#com_falla_via_flota").val();
    com_falla_via_codigo = $("#com_falla_via_codigo").val();
    select_falla_via_componente = f_select_combo("manto_falla_via_componente", "NO", "fav_componente", "", "`fav_bus_tipo`='"+com_falla_via_flota+"' AND `fav_codigo`='"+com_falla_via_codigo+"'", "`fav_componente`");
    $("#fal_falla_via_componente").html(select_falla_via_componente);
    $("#pos_falla_via_componente").html(select_falla_via_componente);
    $("#fal_falla_via_codigo").val(com_falla_via_codigo);
    $("#fal_falla_via_componente").val("");
    $("#pos_falla_via_codigo").val(com_falla_via_codigo);
    $("#pos_falla_via_componente").val("");
  });

  $("#com_fav_bus_tipo").on('change', function () {
    com_fav_bus_tipo = $("#com_fav_bus_tipo").val();
    com_fav_codigo = "";
    com_fav_descripcion = "";
    com_fav_componente = "";
    select_falla_via_componente = f_select_combo("manto_falla_via_codigo", "NO", "fav_codigo", "",  "`fav_bus_tipo`='"+com_fav_bus_tipo+"'", "`fav_orden`");
    $("#com_fav_codigo").html(select_falla_via_componente);
    $("#com_fav_codigo").val(com_fav_codigo);
    $("#com_fav_descripcion").val(com_fav_descripcion);
    $("#com_fav_componente").val(com_fav_componente);
  });

  $("#com_fav_codigo").on('change', function () {
    com_fav_bus_tipo = $("#com_fav_bus_tipo").val();
    com_fav_codigo = $("#com_fav_codigo").val();
    com_fav_descripcion = f_buscar_dato("manto_falla_via_codigo","fav_descripcion","`fav_bus_tipo`='"+com_fav_bus_tipo+"' AND `fav_codigo`='"+com_fav_codigo+"'");
    $("#com_fav_descripcion").val(com_fav_descripcion);
  });

  ///:: BOTONES COMPONENTES DE FALLA EN VIA :::::::::::::::::::::::::::::::::::::::::::::::///

  ///:: EVENTO BOTON BUSCAR COMPONENTE FALLA EN VIA :::::::::::::::::::::::::::::::::::::::///
  $(document).on("click", ".btn_buscar_falla_via_componente", function(){  
    com_falla_via_flota = $("#com_falla_via_flota").val();
    com_falla_via_codigo = $("#com_falla_via_codigo").val();
    select_falla_via_componente = f_select_codigo_falla_via(com_falla_via_flota);
    $("#fal_falla_via_codigo").html(select_falla_via_componente);
    $("#pos_falla_via_codigo").html(select_falla_via_componente);
    select_falla_via_componente = f_select_combo("manto_falla_via_componente", "NO", "fav_componente", "", "`fav_bus_tipo`='"+com_falla_via_flota+"' AND `fav_codigo`='"+com_falla_via_codigo+"'", "`fav_componente`");
    $("#fal_falla_via_componente").html(select_falla_via_componente);
    $("#pos_falla_via_componente").html(select_falla_via_componente);
    $("#fal_falla_via_codigo").val(com_falla_via_codigo);
    $("#fal_falla_via_componente").val("");
    $("#pos_falla_via_codigo").val(com_falla_via_codigo);
    $("#pos_falla_via_componente").val("");

    $("#div_tabla_falla_via_falla_accion").empty();
    $("#div_tabla_falla_via_posicion").empty();

    div_tabla = f_CreacionTabla("tabla_falla_via_componente","");
    $("#div_tabla_falla_via_componente").html(div_tabla);
    columnas_tabla = f_ColumnasTabla("tabla_falla_via_componente","")

    $("#tabla_falla_via_componente").dataTable().fnDestroy();
    $("#tabla_falla_via_componente").show();
  
    Accion='buscar_falla_via_componente';
    tabla_falla_via_componente = $('#tabla_falla_via_componente').DataTable({
      //Color a las filas
      "rowCallback":function(row,data,index)
      {
        f_color_filas_falla_via_posicion(row,data);
      },
      select        : {style: 'os'},
      language      : idioma_espanol,
      responsive    : "true",
      dom           : 'Blfrtip',
      pageLength    : 100,
      buttons       :
      [
        {
          extend    : 'excelHtml5',
          text      : '<i class="fas fa-file-excel"></i> ',
          titleAttr : 'Exportar a Excel',
          className : 'btn btn-success',
          title     : 'COMPONENTES DE FALLA EN VIA PARA LA FLOTA '+com_falla_via_flota
        },
      ],
      "ajax"      : {            
        "url"     : "Ajax.php", 
        "method"  : 'POST',
        "data"    : {MoS:MoS, NombreMoS:NombreMoS, Accion:Accion, fav_bus_tipo:com_falla_via_flota, fav_codigo:com_falla_via_codigo},
        "dataSrc" : ""
      },
      "columns"   : columnas_tabla,
      "order"     : [[1, 'asc']]
    });
  });
  ///:: FIN BOTONES COMPONENTE DE FALLA EN VIA ::::::::::::::::::::::::::::::::::::::::::::///

  ///:: CREA COMPONENTES DE FALLA EN VIA ::::::::::::::::::::::::::::::::::::::::::::::::::///
  $('#form_falla_via_componente').submit(function(e){                         
    e.preventDefault(); 
    let valida_falla_via_componente = "";
    let existe_componente = "";
    let msg_error_componente = "";
    com_fav_bus_tipo     = $.trim($('#com_fav_bus_tipo').val());
    com_fav_codigo       = $.trim($('#com_fav_codigo').val());
    com_fav_descripcion  = $.trim($('#com_fav_descripcion').val());
    com_fav_componente   = $.trim($('#com_fav_componente').val());
    valida_falla_via_componente = f_validar_falla_via_posicion(com_fav_bus_tipo, com_fav_codigo, com_fav_descripcion, com_fav_componente);
    
    if(valida_falla_via_componente=="invalido"){
      msg_error_componente = "*Es posible que falte completar información.";
    }
    if(opcion_falla_via_componente=="CREAR"){
      existe_componente = f_buscar_dato("manto_falla_via_componente","fav_componente","`fav_bus_tipo`= '"+com_fav_bus_tipo+"' AND `fav_codigo`='"+com_fav_codigo+"' AND `fav_componente`='"+com_fav_componente+"'");
      if(existe_componente!=""){
        msg_error_componente += " *El Componente de Falla en Vía ya se encuentra creado.";
        valida_falla_via_componente = "invalido";
      }  
    }

    if(valida_falla_via_componente=="invalido"){
        Swal.fire({
          icon: 'error',
          title: 'INFORMACION...',
          text: msg_error_componente+' !!!'
        })
    }else{
      $("#btn_guardar_falla_via_componente").prop("disabled",true);
      if(opcion_falla_via_componente=="CREAR"){
        Accion='crear_falla_via_componente';
      }else{
        Accion='editar_falla_via_componente';
      }
      $.ajax({
        url       : "Ajax.php",
        type      : "POST",
        datatype  : "json",
        data      : { MoS:MoS, NombreMoS:NombreMoS, Accion:Accion, falla_via_componente_id:falla_via_componente_id, fav_bus_tipo:com_fav_bus_tipo, fav_codigo:com_fav_codigo, fav_descripcion:com_fav_descripcion, fav_componente:com_fav_componente },
        success: function(data) {
          tabla_falla_via_componente.ajax.reload(null, false);
          Swal.fire({
            icon  : 'success',
            title :  'El registro ha sido grabado con exito !!!.',
            showConfirmButton: false,
            timer : 1500  
          })
        }
      });
      $("#btn_guardar_falla_via_componente").prop("disabled",false);
      $('#modal_crud_falla_via_componente').modal('hide');
    }
  });
  ///:: FIN CREA COMPONENTES FALLA EN VIA :::::::::::::::::::::::::::::::::::::::::::::::::///

  ///:: EVENTO BOTON GENERAR COMPONENTES FALLA EN VIA :::::::::::::::::::::::::::::::::::::///
  $(document).on("click", ".btn_nuevo_falla_via_componente", function(){
    $("#form_falla_via_componente").trigger("reset"); 
    opcion_falla_via_componente = "CREAR";
    falla_via_componente_id = "";
    com_falla_via_flota = $("#com_falla_via_flota").val();
    com_falla_via_codigo = $("#com_falla_via_codigo").val();
    com_fav_bus_tipo = com_falla_via_flota;
    com_fav_codigo = com_falla_via_codigo;
    com_fav_descripcion = f_buscar_dato("manto_falla_via_codigo","fav_descripcion","`fav_bus_tipo`='"+com_fav_bus_tipo+"' AND `fav_codigo`='"+com_fav_codigo+"'")

    f_select_combos_componente_falla_via();

    $("#com_fav_bus_tipo").val(com_fav_bus_tipo);
    $("#com_fav_codigo").val(com_fav_codigo);
    $("#com_fav_descripcion").val(com_fav_descripcion);

    $("#com_fav_bus_tipo").prop("disabled",false);
    $("#com_fav_codigo").prop("disabled",false);
    f_limpia_falla_via_componente();

    $(".modal-header").css( "background-color", "#17a2b8");
    $(".modal-header").css( "color", "white" );
    $(".modal-title").text("Alta Componente de Falla en Vía");
    $('#modal_crud_falla_via_componente').modal('show');	    
  });
  ///:: FIN EVENTO BOTON GENERAR COMPONENTES FALLA EN VIA :::::::::::::::::::::::::::::::::///

  ///:: BOTON BORRAR REGISTRO COMPONENTE FALLA EN VIA :::::::::::::::::::::::::::::::::::::///
  $(document).on("click", ".btn_borrar_falla_via_componente", function(){
    fila_falla_via_componente = $(this).closest('tr');
    fav_bus_tipo = fila_falla_via_componente.find('td:eq(1)').text();
    fav_codigo = fila_falla_via_componente.find('td:eq(2)').text();     
    fav_componente = fila_falla_via_componente.find('td:eq(4)').text();     

    Swal.fire({
      title               : '¿Está seguro?',
      text                : "Se eliminará el componente "+fav_componente+"! incluido fallas, acciones y posiciones",
      icon                : 'warning',
      showCancelButton    : true,
      confirmButtonColor  : '#3085d6',
      cancelButtonColor   : '#d33',
      confirmButtonText   : 'Si, eliminar!'
    }).then((result) => {
      if (result.isConfirmed) {
        Swal.fire({
          icon  : 'success',
          title : 'El registro ha sido eliminado.',
          showConfirmButton: false,
          timer : 1500  
        })
        Accion='borrar_falla_via_componente';
        $.ajax({
        url         : "Ajax.php",
        type        : "POST",
        datatype    : "json",
        async       : false,    
        data        : { MoS:MoS, NombreMoS:NombreMoS, Accion:Accion, fav_bus_tipo:fav_bus_tipo, fav_codigo:fav_codigo, fav_componente:fav_componente},   
            success: function(data) {
              tabla_falla_via_componente.ajax.reload(null, false);
            }
        });
      }
    });
  });
  ///:: FIN BOTON BORRAR REGISTRO COMPONENTE DE FALLA EN VIA ::::::::::::::::::::::::::::::///

  ///:: TERMINO BOTONES COMPONENTES DE FALLA EN VIA :::::::::::::::::::::::::::::::::::::::///
});
///:: TERMINO JS DOM COMPONENTES DE FALLA EN VIA ::::::::::::::::::::::::::::::::::::::::::///


///:: INICIO FUNCIONES COMPONENTES DE FALLA EN VIA ::::::::::::::::::::::::::::::::::::::::///

///:: VALIDA LOS CAMPOS DEL FORMULARIO ::::::::::::::::::::::::::::::::::::::::::::::::::::///
function f_validar_falla_via_posicion(p_com_fav_bus_tipo, p_com_fav_codigo, p_com_fav_descripcion, p_com_fav_componente){
  f_limpia_falla_via_componente();
  let rpta_validar_falla_via_posicion = "";

  if(p_com_fav_bus_tipo==""){
    $("#com_fav_bus_tipo").addClass("color-error");
    rpta_validar_falla_via_posicion = "invalido";
  }
  if(p_com_fav_codigo==""){
    $("#com_fav_codigo").addClass("color-error");
    rpta_validar_falla_via_posicion = "invalido";
  }
  if(p_com_fav_descripcion==""){
    $("#com_fav_descripcion").addClass("color-error");
    rpta_validar_falla_via_posicion = "invalido";
  }
  if(p_com_fav_componente==""){
    $("#com_fav_componente").addClass("color-error");
    rpta_validar_falla_via_posicion = "invalido";
  }

  return rpta_validar_falla_via_posicion; 
}
///:: FIN VALIDA LOS CAMPOS DEL FORMULARIO ::::::::::::::::::::::::::::::::::::::::::::::::///

///:: RESTABLECE EL COLOR DE FONDO DE LOS CAMPOS DEL FORMULARIO :::::::::::::::::::::::::::///
function f_limpia_falla_via_componente(){
  $("#com_fav_bus_tipo").removeClass("color-error");
  $("#com_fav_codigo").removeClass("color-error");
  $("#com_fav_descripcion").removeClass("color-error");
  $("#com_fav_componente").removeClass("color-error");
}
///:: RESTABLECE EL COLOR DE FONDO DE LOS CAMPOS DEL FORMULARIO :::::::::::::::::::::::::::///

///:: ESTABLECE EL COLOR DE LAS COLUMNAS DEL DATATABLE ::::::::::::::::::::::::::::::::::::///
function f_color_filas_falla_via_posicion(row,data){
  let color_rojo = "#E26A5A";
  let color_verde = "#009390";
  let color_azul = "#005EA4";
  /*
  ///:: Columna ORDEN
  $("td:eq(1)",row).css({
    "color":color_azul,
  });
  ///:: Columna CODIGO
  $("td:eq(4)",row).css({
    "color":color_verde,
  });
*/
}
///:: FIN ESTABLECE EL COLOR DE LAS COLUMNAS DEL DATATABLE ::::::::::::::::::::::::::::::::///

function f_select_combos_componente_falla_via(){
  select_falla_via_componente = f_select_combo("manto_tc_check_list", "NO", "tc_categoria3", "",  "`tc_categoria1`='FALLA EN VIA' AND `tc_categoria2`='TIPO BUS'", "`tc_categoria3`");
  $("#com_fav_bus_tipo").html(select_falla_via_componente);
  select_falla_via_componente = f_select_combo("manto_falla_via_codigo", "NO", "fav_codigo", "",  "`fav_bus_tipo`='"+com_fav_bus_tipo+"'", "`fav_orden`");
  $("#com_fav_codigo").html(select_falla_via_componente);
}

function f_select_codigo_falla_via(p_fav_bus_tipo){
  let rpta_select_codigo_falla_via = "";
  Accion = 'select_codigo_falla_via';
  $.ajax({
    url       : "Ajax.php",
    type      : "POST",
    datatype  : "json",
    async     : false,
    data      : {MoS:MoS, NombreMoS:NombreMoS, Accion:Accion, fav_bus_tipo:p_fav_bus_tipo},
    success   : function(data){
      rpta_select_codigo_falla_via = data;
    }
  });
  return rpta_select_codigo_falla_via;
}
///:: TERMINO FUNCIONES COMPONENTES FALLA EN VIA ::::::::::::::::::::::::::::::::::::::::::///