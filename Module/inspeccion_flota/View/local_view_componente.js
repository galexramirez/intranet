///::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
///:: COMPONENTE DE CODIGO DE INSPECCION v 1.0 FECHA: 2023-08-10 ::::::::::::::::::::::::::///
///:: CREAR EDITAR ELIMINAR COMPONENTE DE INSPECCION DE FLOTA :::::::::::::::::::::::::::::///
///::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///

///:: DECLARACION VARIABLES GLOBALES ::::::::::::::::::::::::::::::::::::::::::::::::::::::///
var tabla_inspeccion_componente, opcion_inspeccion_componente, com_inspeccion_flota, com_inspeccion_codigo, fila_inspeccion_componente;
var inspeccion_componente_id, com_insp_bus_tipo, com_insp_codigo, com_insp_descripcion, com_insp_componente;

///:: INICIO JS DOM COMPONENTES DE INSPECCION DE FLOTA ::::::::::::::::::::::::::::::::::::///
$(document).ready(function(){
  let select_insp_componente="";

  select_insp_componente = f_select_combo("manto_tc_inspeccion", "NO", "tc_categoria2", "",  "`tc_ficha`='INSPECCION' AND `tc_categoria1`='TIPO BUS'", "`tc_categoria2`");
  $("#com_inspeccion_flota").html(select_insp_componente);

  div_boton = f_BotonesFormulario("form_seleccion_inspeccion_componente","btn_seleccion_inspeccion_componente");
  $("#div_btn_seleccion_inspeccion_componente").html(div_boton);

  $("#com_inspeccion_flota, #com_inspeccion_codigo").on('change', function () {
    $("#div_tabla_inspeccion_componente").empty();
    $("#div_tabla_inspeccion_falla_accion").empty();
    $("#div_tabla_inspeccion_posicion").empty();
  });

  $("#com_inspeccion_flota").on('change', function () {
    com_inspeccion_flota = $("#com_inspeccion_flota").val();
    com_inspeccion_codigo = "";
    $("#fal_inspeccion_flota").val(com_inspeccion_flota);
    $("#pos_inspeccion_flota").val(com_inspeccion_flota);
    select_insp_componente = f_select_codigo_inspeccion(com_inspeccion_flota);
    $("#com_inspeccion_codigo").html(select_insp_componente);
    $("#fal_inspeccion_codigo").html(select_insp_componente);
    $("#pos_inspeccion_codigo").html(select_insp_componente);
    select_insp_componente = f_select_combo("manto_inspeccion_componente", "NO", "insp_componente", "", "`insp_bus_tipo`='"+com_inspeccion_flota+"' AND `insp_codigo`='"+com_inspeccion_codigo+"'");
    $("#fal_inspeccion_componente").html(select_insp_componente);
    $("#pos_inspeccion_componente").html(select_insp_componente);
    $("#com_inspeccion_codigo").val(com_insp_codigo);
    $("#fal_inspeccion_codigo").val(com_insp_codigo);
    $("#fal_inspeccion_componente").val("");
    $("#pos_inspeccion_codigo").val("");
    $("#pos_inspeccion_componente").val("");

  });

  $("#com_inspeccion_codigo").on('change', function () {
    com_inspeccion_flota = $("#com_inspeccion_flota").val();
    com_inspeccion_codigo = $("#com_inspeccion_codigo").val();
    select_insp_componente = f_select_combo("manto_inspeccion_componente", "NO", "insp_componente", "", "`insp_bus_tipo`='"+com_inspeccion_flota+"' AND `insp_codigo`='"+com_inspeccion_codigo+"'");
    $("#fal_inspeccion_componente").html(select_insp_componente);
    $("#pos_inspeccion_componente").html(select_insp_componente);
    $("#fal_inspeccion_codigo").val(com_inspeccion_codigo);
    $("#fal_inspeccion_componente").val("");
    $("#pos_inspeccion_codigo").val(com_inspeccion_codigo);
    $("#pos_inspeccion_componente").val("");
  });

  $("#com_insp_bus_tipo").on('change', function () {
    com_insp_bus_tipo = $("#com_insp_bus_tipo").val();
    com_insp_codigo = "";
    com_insp_descripcion = "";
    com_insp_componente = "";
    select_insp_componente = f_select_combo("manto_inspeccion_codigo", "NO", "insp_codigo", "",  "`insp_bus_tipo`='"+com_insp_bus_tipo+"'", "`insp_orden`");
    $("#com_insp_codigo").html(select_insp_componente);
    $("#com_insp_codigo").val(com_insp_codigo);
    $("#com_insp_descripcion").val(com_insp_descripcion);
    $("#com_insp_componente").val(com_insp_componente);
  });

  $("#com_insp_codigo").on('change', function () {
    com_insp_bus_tipo = $("#com_insp_bus_tipo").val();
    com_insp_codigo = $("#com_insp_codigo").val();
    com_insp_descripcion = f_buscar_dato("manto_inspeccion_codigo","insp_descripcion","`insp_bus_tipo`='"+com_insp_bus_tipo+"' AND `insp_codigo`='"+com_insp_codigo+"'");
    $("#com_insp_descripcion").val(com_insp_descripcion);
  });

  ///:: BOTONES COMPONENTES DE INSPECCION FLOTA ::::::::::::::::::::::::::::::::::::::::::///

  ///:: EVENTO BOTON BUSCAR COMPONENTE INSPECCION FLOTA ::::::::::::::::::::::::::::::::::///       
  $(document).on("click", ".btn_buscar_inspeccion_componente", function(){  
    com_inspeccion_flota = $("#com_inspeccion_flota").val();
    com_inspeccion_codigo = $("#com_inspeccion_codigo").val();
    select_insp_componente = f_select_codigo_inspeccion(com_inspeccion_flota);
    $("#fal_inspeccion_codigo").html(select_insp_componente);
    $("#pos_inspeccion_codigo").html(select_insp_componente);
    select_insp_componente = f_select_combo("manto_inspeccion_componente", "NO", "insp_componente", "", "`insp_bus_tipo`='"+com_inspeccion_flota+"' AND `insp_codigo`='"+com_inspeccion_codigo+"'");
    $("#fal_inspeccion_componente").html(select_insp_componente);
    $("#pos_inspeccion_componente").html(select_insp_componente);
    $("#fal_inspeccion_codigo").val(com_inspeccion_codigo);
    $("#fal_inspeccion_componente").val("");
    $("#pos_inspeccion_codigo").val(com_inspeccion_codigo);
    $("#pos_inspeccion_componente").val("");

    $("#div_tabla_inspeccion_falla_accion").empty();
    $("#div_tabla_inspeccion_posicion").empty();

    div_tabla = f_CreacionTabla("tabla_inspeccion_componente","");
    $("#div_tabla_inspeccion_componente").html(div_tabla);
    columnas_tabla = f_ColumnasTabla("tabla_inspeccion_componente","")

    $("#tabla_inspeccion_componente").dataTable().fnDestroy();
    $("#tabla_inspeccion_componente").show();
  
    Accion='buscar_inspeccion_componente';
    tabla_inspeccion_componente = $('#tabla_inspeccion_componente').DataTable({
      //Color a las filas
      "rowCallback":function(row,data,index)
      {
        f_color_filas_inspeccion_posicion(row,data);
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
          title     : 'COMPONENTES DE INSPECCION PARA LA FLOTA '+com_inspeccion_flota
        },
      ],
      "ajax"      : {            
        "url"     : "Ajax.php", 
        "method"  : 'POST',
        "data"    : {MoS:MoS, NombreMoS:NombreMoS, Accion:Accion, insp_bus_tipo:com_inspeccion_flota, insp_codigo:com_inspeccion_codigo},
        "dataSrc" : ""
      },
      "columns"   : columnas_tabla,
      "order"     : [[1, 'asc']]
    });
  });
  ///:: FIN BOTONES COMPONENTE DE INSPECCION FLOTA ::::::::::::::::::::::::::::::::::::::::///

  ///:: CREA INSPECCION COMPONENTES DE FLOTA ::::::::::::::::::::::::::::::::::::::::::::::///
  $('#form_inspeccion_componente').submit(function(e){                         
    e.preventDefault(); 
    let valida_inspeccion_componente = "";
    let existe_componente = "";
    let msg_error_componente = "";
    com_insp_bus_tipo     = $.trim($('#com_insp_bus_tipo').val());
    com_insp_codigo       = $.trim($('#com_insp_codigo').val());
    com_insp_descripcion  = $.trim($('#com_insp_descripcion').val());
    com_insp_componente   = $.trim($('#com_insp_componente').val());
    valida_inspeccion_componente = f_validar_inspeccion_posicion(com_insp_bus_tipo, com_insp_codigo, com_insp_descripcion, com_insp_componente);
    
    if(valida_inspeccion_componente=="invalido"){
      msg_error_componente = "*Es posible que falte completar información.";
    }
    if(opcion_inspeccion_componente=="CREAR"){
      existe_componente = f_buscar_dato("manto_inspeccion_componente","insp_componente","`insp_bus_tipo`= '"+com_insp_bus_tipo+"' AND `insp_codigo`='"+com_insp_codigo+"' AND `insp_componente`='"+com_insp_componente+"'");
      if(existe_componente!=""){
        msg_error_componente += " *El Componente de Inspección ya se encuentra creado.";
        valida_inspeccion_componente = "invalido";
      }  
    }

    if(valida_inspeccion_componente=="invalido"){
        Swal.fire({
          icon: 'error',
          title: 'INFORMACION...',
          text: msg_error_componente+' !!!'
        })
    }else{
      $("#btn_guardar_inspeccion_componente").prop("disabled",true);
      if(opcion_inspeccion_componente=="CREAR"){
        Accion='crear_inspeccion_componente';
      }else{
        Accion='editar_inspeccion_componente';
      }
      $.ajax({
        url       : "Ajax.php",
        type      : "POST",
        datatype  : "json",
        data      : { MoS:MoS, NombreMoS:NombreMoS, Accion:Accion, inspeccion_componente_id:inspeccion_componente_id, insp_bus_tipo:com_insp_bus_tipo, insp_codigo:com_insp_codigo, insp_descripcion:com_insp_descripcion, insp_componente:com_insp_componente },
        success: function(data) {
          tabla_inspeccion_componente.ajax.reload(null, false);
          Swal.fire({
            icon  : 'success',
            title :  'El registro ha sido grabado con exito !!!.',
            showConfirmButton: false,
            timer : 1500  
          })
        }
      });
      $("#btn_guardar_inspeccion_componente").prop("disabled",false);
      $('#modal_crud_inspeccion_componente').modal('hide');
    }
  });
  ///:: FIN CREA INSPECCION COMPONENTES DE FLOTA ::::::::::::::::::::::::::::::::::::::::::///

  ///:: EVENTO BOTON GENERAR INSPECCION COMPONENTES FLOTA :::::::::::::::::::::::::::::::::///
  $(document).on("click", ".btn_nuevo_inspeccion_componente", function(){
    $("#form_inspeccion_componente").trigger("reset"); 
    opcion_inspeccion_componente = "CREAR";
    inspeccion_componente_id = "";
    com_inspeccion_flota = $("#com_inspeccion_flota").val();
    com_inspeccion_codigo = $("#com_inspeccion_codigo").val();
    com_insp_bus_tipo = com_inspeccion_flota;
    com_insp_codigo = com_inspeccion_codigo;
    com_insp_descripcion = f_buscar_dato("manto_inspeccion_codigo","insp_descripcion","`insp_bus_tipo`='"+com_insp_bus_tipo+"' AND `insp_codigo`='"+com_insp_codigo+"'")

    f_select_combos_componente();

    $("#com_insp_bus_tipo").val(com_insp_bus_tipo);
    $("#com_insp_codigo").val(com_insp_codigo);
    $("#com_insp_descripcion").val(com_insp_descripcion);

    $("#com_insp_bus_tipo").prop("disabled",false);
    $("#com_insp_codigo").prop("disabled",false);
    f_limpia_inspeccion_componente();

    $(".modal-header").css( "background-color", "#17a2b8");
    $(".modal-header").css( "color", "white" );
    $(".modal-title").text("Alta Componente de Inspección");
    $('#modal_crud_inspeccion_componente').modal('show');	    
  });
  ///:: FIN EVENTO BOTON GENERAR INSPECCION COMPONENTES FLOTA :::::::::::::::::::::::::::::///

  ///:: BOTON EDITAR INSPECCION COMPONENTES :::::::::::::::::::::::::::::::::::::::::::::::///
  /* $(document).on("click", ".btn_editar_inspeccion_componente", function(){
    opcion_inspeccion_componente = "EDITAR";

    f_limpia_inspeccion_componente();
    fila_inspeccion_componente = $(this).closest("tr");  
    
    inspeccion_componente_id  = fila_inspeccion_componente.find('td:eq(0)').text();
    com_insp_bus_tipo     = fila_inspeccion_componente.find('td:eq(1)').text();
    com_insp_codigo       = fila_inspeccion_componente.find('td:eq(2)').text();
    com_insp_descripcion  = fila_inspeccion_componente.find('td:eq(3)').text();
    com_insp_componente   = fila_inspeccion_componente.find('td:eq(4)').text();
    f_select_combos_componente();
    $("#com_insp_tipo").prop("disabled",true);
    $("#com_insp_bus_tipo").prop("disabled",true);
    $("#com_insp_codigo").prop("disabled",true);

    $("#com_insp_bus_tipo").val(com_insp_bus_tipo);
    $("#com_insp_codigo").val(com_insp_codigo);
    $("#com_insp_descripcion").val(com_insp_descripcion);
    $("#com_insp_componente").val(com_insp_componente);

    $(".modal-header").css("background-color", "#007bff");
    $(".modal-header").css("color", "white" );
    $(".modal-title").text("Editar Componente de Inspección");		

    $('#modal_crud_inspeccion_componente').modal('show');		   
  }); */
  ///:: FIN BOTON EDITAR INSPECCION COMPONENTES :::::::::::::::::::::::::::::::::::::::::::///
  
  ///:: BOTON BORRAR REGISTRO INSPECCION COMPONENTE :::::::::::::::::::::::::::::::::::::::///
  $(document).on("click", ".btn_borrar_inspeccion_componente", function(){
    fila_inspeccion_componente = $(this).closest('tr');
    insp_bus_tipo = fila_inspeccion_componente.find('td:eq(1)').text();
    insp_codigo = fila_inspeccion_componente.find('td:eq(2)').text();     
    insp_componente = fila_inspeccion_componente.find('td:eq(4)').text();     

    Swal.fire({
      title               : '¿Está seguro?',
      text                : "Se eliminará el componente "+insp_componente+"! incluido fallas, acciones y posiciones",
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
        Accion='borrar_inspeccion_componente';
        $.ajax({
        url         : "Ajax.php",
        type        : "POST",
        datatype    : "json",
        async       : false,    
        data        : { MoS:MoS, NombreMoS:NombreMoS, Accion:Accion, insp_bus_tipo:insp_bus_tipo, insp_codigo:insp_codigo, insp_componente:insp_componente},   
            success: function(data) {
              tabla_inspeccion_componente.ajax.reload(null, false);
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
function f_validar_inspeccion_posicion(p_com_insp_bus_tipo, p_com_insp_codigo, p_com_insp_descripcion, p_com_insp_componente){
  f_limpia_inspeccion_componente();
  let rpta_validar_inspeccion_posicion = "";

  if(p_com_insp_bus_tipo==""){
    $("#com_insp_bus_tipo").addClass("color-error");
    rpta_validar_inspeccion_posicion = "invalido";
  }
  if(p_com_insp_codigo==""){
    $("#com_insp_codigo").addClass("color-error");
    rpta_validar_inspeccion_posicion = "invalido";
  }
  if(p_com_insp_descripcion==""){
    $("#com_insp_descripcion").addClass("color-error");
    rpta_validar_inspeccion_posicion = "invalido";
  }
  if(p_com_insp_componente==""){
    $("#com_insp_componente").addClass("color-error");
    rpta_validar_inspeccion_posicion = "invalido";
  }

  return rpta_validar_inspeccion_posicion; 
}
///:: FIN VALIDA LOS CAMPOS DEL FORMULARIO ::::::::::::::::::::::::::::::::::::::::::::::::///

///:: RESTABLECE EL COLOR DE FONDO DE LOS CAMPOS DEL FORMULARIO :::::::::::::::::::::::::::///
function f_limpia_inspeccion_componente(){
  $("#com_insp_bus_tipo").removeClass("color-error");
  $("#com_insp_codigo").removeClass("color-error");
  $("#com_insp_descripcion").removeClass("color-error");
  $("#com_insp_componente").removeClass("color-error");
}
///:: RESTABLECE EL COLOR DE FONDO DE LOS CAMPOS DEL FORMULARIO :::::::::::::::::::::::::::///

///:: ESTABLECE EL COLOR DE LAS COLUMNAS DEL DATATABLE ::::::::::::::::::::::::::::::::::::///
function f_color_filas_inspeccion_posicion(row,data){
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
  select_insp_componente = f_select_combo("manto_tc_inspeccion", "NO", "tc_categoria2", "",  "`tc_ficha`='INSPECCION' AND `tc_categoria1`='TIPO BUS'", "`tc_categoria2`");
  $("#com_insp_bus_tipo").html(select_insp_componente);
  select_insp_componente = f_select_combo("manto_inspeccion_codigo", "NO", "insp_codigo", "",  "`insp_bus_tipo`='"+com_insp_bus_tipo+"'", "`insp_orden`");
  $("#com_insp_codigo").html(select_insp_componente);
}

function f_select_codigo_inspeccion(p_insp_bus_tipo){
  let rpta_select_codigo_inspeccion = "";
  Accion = 'select_codigo_inspeccion';
  $.ajax({
    url       : "Ajax.php",
    type      : "POST",
    datatype  : "json",
    async     : false,
    data      : {MoS:MoS, NombreMoS:NombreMoS, Accion:Accion, insp_bus_tipo:p_insp_bus_tipo},
    success   : function(data){
      rpta_select_codigo_inspeccion = data;
    }
  });
  return rpta_select_codigo_inspeccion;
}
///:: TERMINO FUNCIONES INSPECCION COMPONENTES ::::::::::::::::::::::::::::::::::::::::::::///