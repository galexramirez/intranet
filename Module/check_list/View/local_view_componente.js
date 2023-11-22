///::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
///:: COMPONENTE DE CODIGO DE CHECK LIST v 1.0 FECHA: 2023-09-25 ::::::::::::::::::::::::::///
///:: CREAR EDITAR ELIMINAR COMPONENTE DE CHECK LIST DE FLOTA :::::::::::::::::::::::::::::///
///::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///

///:: DECLARACION VARIABLES GLOBALES ::::::::::::::::::::::::::::::::::::::::::::::::::::::///
var tabla_check_list_componente, opcion_check_list_componente, com_check_list_flota, com_check_list_codigo, fila_check_list_componente;
var check_list_componente_id, com_chl_bus_tipo, com_chl_codigo, com_chl_descripcion, com_chl_componente;

///:: INICIO JS DOM COMPONENTES DE INSPECCION DE FLOTA ::::::::::::::::::::::::::::::::::::///
$(document).ready(function(){
  let select_chl_componente="";

  select_chl_componente = f_select_combo("manto_tc_check_list", "NO", "tc_categoria3", "",  "`tc_categoria1`='CHECK LIST' AND `tc_categoria2`='TIPO BUS'", "`tc_categoria3`");
  $("#com_check_list_flota").html(select_chl_componente);

  div_boton = f_BotonesFormulario("form_seleccion_check_list_componente","btn_seleccion_check_list_componente");
  $("#div_btn_seleccion_check_list_componente").html(div_boton);

  $("#com_check_list_flota, #com_check_list_codigo").on('change', function () {
    $("#div_tabla_check_list_componente").empty();
    $("#div_tabla_check_list_falla_accion").empty();
    $("#div_tabla_check_list_posicion").empty();
  });

  $("#com_check_list_flota").on('change', function () {
    com_check_list_flota = $("#com_check_list_flota").val();
    com_check_list_codigo = "";
    $("#fal_check_list_flota").val(com_check_list_flota);
    $("#pos_check_list_flota").val(com_check_list_flota);
    select_chl_componente = f_select_codigo_check_list(com_check_list_flota);
    $("#com_check_list_codigo").html(select_chl_componente);
    $("#fal_check_list_codigo").html(select_chl_componente);
    $("#pos_check_list_codigo").html(select_chl_componente);
    select_chl_componente = f_select_combo("manto_check_list_componente", "NO", "chl_componente", "", "`chl_bus_tipo`='"+com_check_list_flota+"' AND `chl_codigo`='"+com_check_list_codigo+"'");
    $("#fal_check_list_componente").html(select_chl_componente);
    $("#pos_check_list_componente").html(select_chl_componente);
    $("#com_check_list_codigo").val(com_chl_codigo);
    $("#fal_check_list_codigo").val(com_chl_codigo);
    $("#fal_check_list_componente").val("");
    $("#pos_check_list_codigo").val("");
    $("#pos_check_list_componente").val("");

  });

  $("#com_check_list_codigo").on('change', function () {
    com_check_list_flota = $("#com_check_list_flota").val();
    com_check_list_codigo = $("#com_check_list_codigo").val();
    select_chl_componente = f_select_combo("manto_check_list_componente", "NO", "chl_componente", "", "`chl_bus_tipo`='"+com_check_list_flota+"' AND `chl_codigo`='"+com_check_list_codigo+"'");
    $("#fal_check_list_componente").html(select_chl_componente);
    $("#pos_check_list_componente").html(select_chl_componente);
    $("#fal_check_list_codigo").val(com_check_list_codigo);
    $("#fal_check_list_componente").val("");
    $("#pos_check_list_codigo").val(com_check_list_codigo);
    $("#pos_check_list_componente").val("");
  });

  $("#com_chl_bus_tipo").on('change', function () {
    com_chl_bus_tipo = $("#com_chl_bus_tipo").val();
    com_chl_codigo = "";
    com_chl_descripcion = "";
    com_chl_componente = "";
    select_chl_componente = f_select_combo("manto_check_list_codigo", "NO", "chl_codigo", "",  "`chl_bus_tipo`='"+com_chl_bus_tipo+"'", "`chl_orden`");
    $("#com_chl_codigo").html(select_chl_componente);
    $("#com_chl_codigo").val(com_chl_codigo);
    $("#com_chl_descripcion").val(com_chl_descripcion);
    $("#com_chl_componente").val(com_chl_componente);
  });

  $("#com_chl_codigo").on('change', function () {
    com_chl_bus_tipo = $("#com_chl_bus_tipo").val();
    com_chl_codigo = $("#com_chl_codigo").val();
    com_chl_descripcion = f_buscar_dato("manto_check_list_codigo","chl_descripcion","`chl_bus_tipo`='"+com_chl_bus_tipo+"' AND `chl_codigo`='"+com_chl_codigo+"'");
    $("#com_chl_descripcion").val(com_chl_descripcion);
  });

  ///:: BOTONES COMPONENTES DE INSPECCION FLOTA ::::::::::::::::::::::::::::::::::::::::::///

  ///:: EVENTO BOTON BUSCAR COMPONENTE INSPECCION FLOTA ::::::::::::::::::::::::::::::::::///       
  $(document).on("click", ".btn_buscar_check_list_componente", function(){  
    com_check_list_flota = $("#com_check_list_flota").val();
    com_check_list_codigo = $("#com_check_list_codigo").val();
    select_chl_componente = f_select_codigo_check_list(com_check_list_flota);
    $("#fal_check_list_codigo").html(select_chl_componente);
    $("#pos_check_list_codigo").html(select_chl_componente);
    select_chl_componente = f_select_combo("manto_check_list_componente", "NO", "chl_componente", "", "`chl_bus_tipo`='"+com_check_list_flota+"' AND `chl_codigo`='"+com_check_list_codigo+"'");
    $("#fal_check_list_componente").html(select_chl_componente);
    $("#pos_check_list_componente").html(select_chl_componente);
    $("#fal_check_list_codigo").val(com_check_list_codigo);
    $("#fal_check_list_componente").val("");
    $("#pos_check_list_codigo").val(com_check_list_codigo);
    $("#pos_check_list_componente").val("");

    $("#div_tabla_check_list_falla_accion").empty();
    $("#div_tabla_check_list_posicion").empty();

    div_tabla = f_CreacionTabla("tabla_check_list_componente","");
    $("#div_tabla_check_list_componente").html(div_tabla);
    columnas_tabla = f_ColumnasTabla("tabla_check_list_componente","")

    $("#tabla_check_list_componente").dataTable().fnDestroy();
    $("#tabla_check_list_componente").show();
  
    Accion='buscar_check_list_componente';
    tabla_check_list_componente = $('#tabla_check_list_componente').DataTable({
      //Color a las filas
      "rowCallback":function(row,data,index)
      {
        f_color_filas_check_list_posicion(row,data);
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
          title     : 'COMPONENTES DE CHECK LIST PARA LA FLOTA '+com_check_list_flota
        },
      ],
      "ajax"      : {            
        "url"     : "Ajax.php", 
        "method"  : 'POST',
        "data"    : {MoS:MoS, NombreMoS:NombreMoS, Accion:Accion, chl_bus_tipo:com_check_list_flota, chl_codigo:com_check_list_codigo},
        "dataSrc" : ""
      },
      "columns"   : columnas_tabla,
      "order"     : [[1, 'asc']]
    });
  });
  ///:: FIN BOTONES COMPONENTE DE INSPECCION FLOTA ::::::::::::::::::::::::::::::::::::::::///

  ///:: CREA INSPECCION COMPONENTES DE FLOTA ::::::::::::::::::::::::::::::::::::::::::::::///
  $('#form_check_list_componente').submit(function(e){                         
    e.preventDefault(); 
    let valida_check_list_componente = "";
    let existe_componente = "";
    let msg_error_componente = "";
    com_chl_bus_tipo     = $.trim($('#com_chl_bus_tipo').val());
    com_chl_codigo       = $.trim($('#com_chl_codigo').val());
    com_chl_descripcion  = $.trim($('#com_chl_descripcion').val());
    com_chl_componente   = $.trim($('#com_chl_componente').val());
    valida_check_list_componente = f_validar_check_list_posicion(com_chl_bus_tipo, com_chl_codigo, com_chl_descripcion, com_chl_componente);
    
    if(valida_check_list_componente=="invalido"){
      msg_error_componente = "*Es posible que falte completar información.";
    }
    if(opcion_check_list_componente=="CREAR"){
      existe_componente = f_buscar_dato("manto_check_list_componente","chl_componente","`chl_bus_tipo`= '"+com_chl_bus_tipo+"' AND `chl_codigo`='"+com_chl_codigo+"' AND `chl_componente`='"+com_chl_componente+"'");
      if(existe_componente!=""){
        msg_error_componente += " *El Componente de Check List ya se encuentra creado.";
        valida_check_list_componente = "invalido";
      }  
    }

    if(valida_check_list_componente=="invalido"){
        Swal.fire({
          icon: 'error',
          title: 'INFORMACION...',
          text: msg_error_componente+' !!!'
        })
    }else{
      $("#btn_guardar_check_list_componente").prop("disabled",true);
      if(opcion_check_list_componente=="CREAR"){
        Accion='crear_check_list_componente';
      }else{
        Accion='editar_check_list_componente';
      }
      $.ajax({
        url       : "Ajax.php",
        type      : "POST",
        datatype  : "json",
        data      : { MoS:MoS, NombreMoS:NombreMoS, Accion:Accion, check_list_componente_id:check_list_componente_id, chl_bus_tipo:com_chl_bus_tipo, chl_codigo:com_chl_codigo, chl_componente:com_chl_componente },
        success: function(data) {
          tabla_check_list_componente.ajax.reload(null, false);
          Swal.fire({
            icon  : 'success',
            title :  'El registro ha sido grabado con exito !!!.',
            showConfirmButton: false,
            timer : 1500  
          })
        }
      });
      $("#btn_guardar_check_list_componente").prop("disabled",false);
      $('#modal_crud_check_list_componente').modal('hide');
    }
  });
  ///:: FIN CREA INSPECCION COMPONENTES DE FLOTA ::::::::::::::::::::::::::::::::::::::::::///

  ///:: EVENTO BOTON GENERAR INSPECCION COMPONENTES FLOTA :::::::::::::::::::::::::::::::::///
  $(document).on("click", ".btn_nuevo_check_list_componente", function(){
    $("#form_check_list_componente").trigger("reset"); 
    opcion_check_list_componente = "CREAR";
    check_list_componente_id = "";
    com_check_list_flota = $("#com_check_list_flota").val();
    com_check_list_codigo = $("#com_check_list_codigo").val();
    com_chl_bus_tipo = com_check_list_flota;
    com_chl_codigo = com_check_list_codigo;
    com_chl_descripcion = f_buscar_dato("manto_check_list_codigo","chl_descripcion","`chl_bus_tipo`='"+com_chl_bus_tipo+"' AND `chl_codigo`='"+com_chl_codigo+"'")

    f_select_combos_componente();

    $("#com_chl_bus_tipo").val(com_chl_bus_tipo);
    $("#com_chl_codigo").val(com_chl_codigo);
    $("#com_chl_descripcion").val(com_chl_descripcion);

    $("#com_chl_bus_tipo").prop("disabled",false);
    $("#com_chl_codigo").prop("disabled",false);
    f_limpia_check_list_componente();

    $(".modal-header").css( "background-color", "#17a2b8");
    $(".modal-header").css( "color", "white" );
    $(".modal-title").text("Alta Componente de Check List");
    $('#modal_crud_check_list_componente').modal('show');	    
  });
  ///:: FIN EVENTO BOTON GENERAR INSPECCION COMPONENTES FLOTA :::::::::::::::::::::::::::::///

  ///:: BOTON BORRAR REGISTRO INSPECCION COMPONENTE :::::::::::::::::::::::::::::::::::::::///
  $(document).on("click", ".btn_borrar_check_list_componente", function(){
    fila_check_list_componente = $(this).closest('tr');
    chl_bus_tipo = fila_check_list_componente.find('td:eq(1)').text();
    chl_codigo = fila_check_list_componente.find('td:eq(2)').text();     
    chl_componente = fila_check_list_componente.find('td:eq(4)').text();     

    Swal.fire({
      title               : '¿Está seguro?',
      text                : "Se eliminará el componente "+chl_componente+"! incluido fallas, acciones y posiciones",
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
        Accion='borrar_check_list_componente';
        $.ajax({
        url         : "Ajax.php",
        type        : "POST",
        datatype    : "json",
        async       : false,    
        data        : { MoS:MoS, NombreMoS:NombreMoS, Accion:Accion, chl_bus_tipo:chl_bus_tipo, chl_codigo:chl_codigo, chl_componente:chl_componente},   
            success: function(data) {
              tabla_check_list_componente.ajax.reload(null, false);
            }
        });
      }
    });
  });
  ///:: FIN BOTON BORRAR REGISTRO INSPECCION COMPONENTE :::::::::::::::::::::::::::::::::::///

  ///:: TERMINO BOTONES COMPONENTES DE INSPECCION FLOTA :::::::::::::::::::::::::::::::::::///
});
///:: TERMINO JS DOM COMPONENTES DE INSPECCION DE FLOTA :::::::::::::::::::::::::::::::::::///


///:: INICIO FUNCIONES INSPECCION COMPONENTES :::::::::::::::::::::::::::::::::::::::::::::///

///:: VALIDA LOS CAMPOS DEL FORMULARIO ::::::::::::::::::::::::::::::::::::::::::::::::::::///
function f_validar_check_list_posicion(p_com_chl_bus_tipo, p_com_chl_codigo, p_com_chl_descripcion, p_com_chl_componente){
  f_limpia_check_list_componente();
  let rpta_validar_check_list_posicion = "";

  if(p_com_chl_bus_tipo==""){
    $("#com_chl_bus_tipo").addClass("color-error");
    rpta_validar_check_list_posicion = "invalido";
  }
  if(p_com_chl_codigo==""){
    $("#com_chl_codigo").addClass("color-error");
    rpta_validar_check_list_posicion = "invalido";
  }
  if(p_com_chl_descripcion==""){
    $("#com_chl_descripcion").addClass("color-error");
    rpta_validar_check_list_posicion = "invalido";
  }
  if(p_com_chl_componente==""){
    $("#com_chl_componente").addClass("color-error");
    rpta_validar_check_list_posicion = "invalido";
  }

  return rpta_validar_check_list_posicion; 
}
///:: FIN VALIDA LOS CAMPOS DEL FORMULARIO ::::::::::::::::::::::::::::::::::::::::::::::::///

///:: RESTABLECE EL COLOR DE FONDO DE LOS CAMPOS DEL FORMULARIO :::::::::::::::::::::::::::///
function f_limpia_check_list_componente(){
  $("#com_chl_bus_tipo").removeClass("color-error");
  $("#com_chl_codigo").removeClass("color-error");
  $("#com_chl_descripcion").removeClass("color-error");
  $("#com_chl_componente").removeClass("color-error");
}
///:: RESTABLECE EL COLOR DE FONDO DE LOS CAMPOS DEL FORMULARIO :::::::::::::::::::::::::::///

///:: ESTABLECE EL COLOR DE LAS COLUMNAS DEL DATATABLE ::::::::::::::::::::::::::::::::::::///
function f_color_filas_check_list_posicion(row,data){
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

function f_select_combos_componente(){
  select_chl_componente = f_select_combo("manto_tc_check_list", "NO", "tc_categoria3", "",  "`tc_categoria1`='CHECK LIST' AND `tc_categoria2`='TIPO BUS'", "`tc_categoria3`");
  $("#com_chl_bus_tipo").html(select_chl_componente);
  select_chl_componente = f_select_combo("manto_check_list_codigo", "NO", "chl_codigo", "",  "`chl_bus_tipo`='"+com_chl_bus_tipo+"'", "`chl_orden`");
  $("#com_chl_codigo").html(select_chl_componente);
}

function f_select_codigo_check_list(p_chl_bus_tipo){
  let rpta_select_codigo_check_list = "";
  Accion = 'select_codigo_check_list';
  $.ajax({
    url       : "Ajax.php",
    type      : "POST",
    datatype  : "json",
    async     : false,
    data      : {MoS:MoS, NombreMoS:NombreMoS, Accion:Accion, chl_bus_tipo:p_chl_bus_tipo},
    success   : function(data){
      rpta_select_codigo_check_list = data;
    }
  });
  return rpta_select_codigo_check_list;
}
///:: TERMINO FUNCIONES INSPECCION COMPONENTES ::::::::::::::::::::::::::::::::::::::::::::///