///::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
///:: POSICION DE COMPONENTE DE FLOTA v 1.0 FECHA: 2023-09-25 :::::::::::::::::::::::::::::///
///:: CREAR EDITAR ELIMINAR POSICION DE COMPONENTE DE CHECK LIST DE FLOTA :::::::::::::::::///
///::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///

///:: DECLARACION VARIABLES GLOBALES ::::::::::::::::::::::::::::::::::::::::::::::::::::::///
var tabla_check_list_posicion, opcion_check_list_posicion, pos_check_list_flota, pos_check_list_codigo, pos_check_list_componente, fila_check_list_posicion;
var check_list_posicion_id, pos_chl_tipo, pos_chl_bus_tipo, pos_chl_codigo, pos_chl_descripcion, pos_chl_componente, pos_chl_posicion;

///:: INICIO JS DOM CODIGOS DE CHECK LIST DE FLOTA ::::::::::::::::::::::::::::::::::::::::///
$(document).ready(function(){
  let select_chl_posicion="";

  select_chl_posicion = f_select_combo("manto_tc_check_list", "NO", "tc_categoria3", "",  "`tc_categoria1`='CHECK LIST' AND `tc_categoria2`='TIPO BUS'", "`tc_categoria3`");
  $("#pos_check_list_flota").html(select_chl_posicion);

  div_boton = f_BotonesFormulario("form_seleccion_check_list_posicion","btn_seleccion_check_list_posicion");
  $("#div_btn_seleccion_check_list_posicion").html(div_boton);

  $("#pos_check_list_flota, #pos_check_list_codigo, #pos_check_list_componente").on('change', function () {
    $("#div_tabla_check_list_posicion").empty();
  });

  $("#pos_check_list_flota").on('change', function () {
    pos_check_list_flota = $("#pos_check_list_flota").val();
    pos_check_list_codigo = "";
    pos_check_list_componente = "";
    select_chl_posicion = f_select_codigo_check_list(pos_check_list_flota);
    $("#pos_check_list_codigo").html(select_chl_posicion);
    $("#pos_check_list_codigo").val(pos_check_list_codigo);
    select_chl_posicion = f_select_combo("manto_check_list_componente", "NO", "chl_componente", "",  "`chl_bus_tipo`='"+pos_check_list_flota+"' AND `chl_codigo`='"+pos_check_list_codigo+"'", "`chl_componente`");
    $("#pos_check_list_componente").html(select_chl_posicion);
    $("#pos_check_list_componente").val(pos_check_list_componente);
  });

  $("#pos_check_list_codigo").on('change', function () {
    pos_check_list_flota = $("#pos_check_list_flota").val();
    pos_check_list_codigo = $("#pos_check_list_codigo").val();
    pos_check_list_componente = "";
    select_chl_posicion = f_select_combo("manto_check_list_componente", "NO", "chl_componente", "",  "`chl_bus_tipo`='"+pos_check_list_flota+"' AND `chl_codigo`='"+pos_check_list_codigo+"'", "`chl_componente`");
    $("#pos_check_list_componente").html(select_chl_posicion);
    $("#pos_check_list_componente").val(pos_check_list_componente);
  });

  $("#pos_chl_bus_tipo").on('change', function () {
    pos_chl_bus_tipo = $("#pos_chl_bus_tipo").val();
    pos_chl_codigo = "";
    pos_chl_descripcion = "";
    pos_chl_componente = "";
    select_chl_posicion = f_select_combo("manto_check_list_codigo", "NO", "chl_codigo", "",  "`chl_bus_tipo`='"+pos_chl_bus_tipo+"'", "`chl_orden`");
    $("#pos_chl_codigo").html(select_chl_posicion);
    $("#pos_chl_codigo").val(pos_chl_codigo);
    $("#pos_chl_descripcion").val(pos_chl_descripcion);
    $("#pos_chl_componente").val(pos_chl_componente);
  });

  $("#pos_chl_codigo").on('change', function () {
    pos_chl_bus_tipo = $("#pos_chl_bus_tipo").val();
    pos_chl_codigo = $("#pos_chl_codigo").val();
    pos_chl_componente = "";
    pos_chl_descripcion = f_buscar_dato("manto_check_list_codigo","chl_descripcion","`chl_bus_tipo`='"+pos_chl_bus_tipo+"' AND `chl_codigo`='"+pos_chl_codigo+"'");
    $("#pos_chl_descripcion").val(pos_chl_descripcion);
    select_chl_posicion = f_select_combo("manto_check_list_componente", "SI", "chl_componente", "",  "`chl_bus_tipo`='"+pos_chl_bus_tipo+"' AND `chl_codigo`='"+pos_chl_codigo+"'", "`chl_componente`");
    $("#pos_chl_componente").html(select_chl_posicion);
    $("#pos_chl_componente").val(pos_chl_componente);
  });

  ///:: BOTONES POSICION DE CHECK LIST FLOTA ::::::::::::::::::::::::::::::::::::::::::::::///

  ///:: EVENTO BOTON BUSCAR POSICION CHECK LIST FLOTA :::::::::::::::::::::::::::::::::::::///
  $(document).on("click", ".btn_buscar_check_list_posicion", function(){  
    pos_check_list_flota = $("#pos_check_list_flota").val();
    pos_check_list_codigo = $("#pos_check_list_codigo").val();
    pos_check_list_componente = $("#pos_check_list_componente").val();

    div_tabla = f_CreacionTabla("tabla_check_list_posicion","");
    $("#div_tabla_check_list_posicion").html(div_tabla);
    columnas_tabla = f_ColumnasTabla("tabla_check_list_posicion","")

    $("#tabla_check_list_posicion").dataTable().fnDestroy();
    $("#tabla_check_list_posicion").show();

    Accion='buscar_check_list_posicion';
    tabla_check_list_posicion = $('#tabla_check_list_posicion').DataTable({
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
          title     : 'POSICION DE CHECK LIST PARA LA FLOTA '+pos_check_list_flota
        },
      ],
      "ajax"      : {            
        "url"     : "Ajax.php", 
        "method"  : 'POST',
        "data"    : {MoS:MoS, NombreMoS:NombreMoS, Accion:Accion, chl_bus_tipo:pos_check_list_flota, chl_codigo:pos_check_list_codigo, chl_componente:pos_check_list_componente},
        "dataSrc" : ""
      },
      "columns"   : columnas_tabla,
      "order"     : [[0, 'asc']]
    });
  });
  ///:: FIN BOTONES POSICION DE CHECK LIST FLOTA ::::::::::::::::::::::::::::::::::::::::::///

  ///:: CREA CHECK LIST POSICION DE FLOTA :::::::::::::::::::::::::::::::::::::::::::::::::::///
  $('#form_check_list_posicion').submit(function(e){                         
    e.preventDefault(); 
    let valida_check_list_posicion = "";
    let existe_posicion = "";
    let msg_error_posicion = "";
    pos_chl_bus_tipo     = $.trim($('#pos_chl_bus_tipo').val());
    pos_chl_codigo       = $.trim($('#pos_chl_codigo').val());
    pos_chl_descripcion  = $.trim($('#pos_chl_descripcion').val());
    pos_chl_componente   = $.trim($('#pos_chl_componente').val());
    pos_chl_posicion     = $.trim($('#pos_chl_posicion').val());
    pos_chl_posicion     = pos_chl_posicion.toUpperCase();
    valida_check_list_posicion = f_validar_check_list_posicion(pos_chl_bus_tipo, pos_chl_codigo, pos_chl_descripcion, pos_chl_componente, pos_chl_posicion);

    if(valida_check_list_posicion=="invalido"){
      msg_error_posicion = "*Es posible que falte completar información.";
    }
    if(opcion_check_list_posicion=="CREAR"){
      existe_posicion = f_buscar_dato("manto_check_list_posicion","chl_posicion","`chl_bus_tipo`= '"+pos_chl_bus_tipo+"' AND `chl_codigo`='"+pos_chl_codigo+"' AND `chl_componente`='"+pos_chl_componente+"' AND `chl_posicion`='"+pos_chl_posicion+"'");
      if(existe_posicion!=""){
        msg_error_posicion += " *La Posición de Inspección ya se encuentra creada.";
        valida_check_list_posicion = "invalido";
      }  
    }

    if(valida_check_list_posicion=="invalido"){
        Swal.fire({
          icon: 'error',
          title: 'INFORMACION...',
          text: msg_error_posicion+' !!!'
        })
    }else{
      $("#btn_guardar_check_list_posicion").prop("disabled",true);
      if(opcion_check_list_posicion=="CREAR"){
        Accion='crear_check_list_posicion';
      }else{
        Accion='editar_check_list_posicion';
      }
      $.ajax({
        url       : "Ajax.php",
        type      : "POST",
        datatype  : "json",
        data      : { MoS:MoS, NombreMoS:NombreMoS, Accion:Accion, check_list_posicion_id:check_list_posicion_id, chl_bus_tipo:pos_chl_bus_tipo, chl_codigo:pos_chl_codigo, chl_componente:pos_chl_componente, chl_posicion:pos_chl_posicion },
        success: function(data) {
          tabla_check_list_posicion.ajax.reload(null, false);
          Swal.fire({
            icon  : 'success',
            title :  'El registro ha sido grabado con exito !!!.',
            showConfirmButton: false,
            timer : 1500  
          })
        }
      });
      $("#btn_guardar_check_list_posicion").prop("disabled",false);
      $('#modal_crud_check_list_posicion').modal('hide');
    }
  });
  ///:: FIN CREA CHECK LIST POSICION DE FLOTA :::::::::::::::::::::::::::::::::::::::::::::///

  ///:: EVENTO BOTON GENERAR CHECK LIST POSICION FLOTA ::::::::::::::::::::::::::::::::::::///
  $(document).on("click", ".btn_nuevo_check_list_posicion", function(){
    $("#form_check_list_posicion").trigger("reset"); 
    opcion_check_list_posicion = "CREAR";
    check_list_posicion_id = "";

    pos_chl_bus_tipo = $("#pos_check_list_flota").val();
    pos_chl_codigo = $("#pos_check_list_codigo").val();
    pos_chl_descripcion = f_buscar_dato("manto_check_list_codigo","chl_descripcion","`chl_bus_tipo`='"+pos_chl_bus_tipo+"' AND `chl_codigo`='"+pos_chl_codigo+"'")
    pos_chl_componente = $("#pos_check_list_componente").val();

    f_select_combos_posicion();

    $("#pos_chl_bus_tipo").val(pos_chl_bus_tipo);
    $("#pos_chl_codigo").val(pos_chl_codigo);
    $("#pos_chl_descripcion").val(pos_chl_descripcion);
    $("#pos_chl_componente").val(pos_chl_componente);

    $("#pos_chl_bus_tipo").prop("disabled",false);
    $("#pos_chl_codigo").prop("disabled",false);
    $("#pos_chl_componente").prop("disabled",false);
    
    f_limpia_check_list_posicion();
    
    $(".modal-header").css( "background-color", "#17a2b8");
    $(".modal-header").css( "color", "white" );
    $(".modal-title").text("Alta Posición de Inspección");
    $('#modal_crud_check_list_posicion').modal('show');
  });
  ///:: FIN EVENTO BOTON GENERAR CHECK LIST POSICION FLOTA ::::::::::::::::::::::::::::::::///

  ///:: BOTON EDITAR CHECK LIST POSICION ::::::::::::::::::::::::::::::::::::::::::::::::::///
  $(document).on("click", ".btn_editar_check_list_posicion", function(){
    opcion_check_list_posicion = "EDITAR";
    
    f_limpia_check_list_posicion();
    fila_check_list_posicion = $(this).closest("tr");  
    
    check_list_posicion_id  = fila_check_list_posicion.find('td:eq(0)').text();
    pos_chl_bus_tipo     = fila_check_list_posicion.find('td:eq(1)').text();
    pos_chl_codigo       = fila_check_list_posicion.find('td:eq(2)').text();
    pos_chl_descripcion  = fila_check_list_posicion.find('td:eq(3)').text();
    pos_chl_componente   = fila_check_list_posicion.find('td:eq(4)').text();
    pos_chl_posicion     = fila_check_list_posicion.find('td:eq(5)').text();
    f_select_combos_posicion();
    $("#pos_chl_tipo").prop("disabled",true);
    $("#pos_chl_bus_tipo").prop("disabled",true);
    $("#pos_chl_codigo").prop("disabled",true);
    $("#pos_chl_componente").prop("disabled",true);

    $("#pos_chl_bus_tipo").val(pos_chl_bus_tipo);
    $("#pos_chl_codigo").val(pos_chl_codigo);
    $("#pos_chl_descripcion").val(pos_chl_descripcion);
    $("#pos_chl_componente").val(pos_chl_componente);
    $("#pos_chl_posicion").val(pos_chl_posicion);

    $(".modal-header").css("background-color", "#007bff");
    $(".modal-header").css("color", "white" );
    $(".modal-title").text("Editar Posición de Inspección");		

    $('#modal_crud_check_list_posicion').modal('show');		   
  });
  ///:: FIN BOTON EDITAR CHECK LIST POSICION ::::::::::::::::::::::::::::::::::::::::::::::///
  
  ///:: BOTON BORRAR REGISTRO CHECK LIST CODIGO :::::::::::::::::::::::::::::::::::::::::::///
  $(document).on("click", ".btn_borrar_check_list_posicion", function(){
    fila_check_list_posicion = $(this).closest('tr');           
    check_list_posicion_id = fila_check_list_posicion.find('td:eq(0)').text();     
    Swal.fire({
      title               : '¿Está seguro?',
      text                : "Se eliminará el registro Id "+check_list_posicion_id+"!",
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
        Accion='borrar_check_list_posicion';
        $.ajax({
        url         : "Ajax.php",
        type        : "POST",
        datatype    : "json",
        async       : false,    
        data        : { MoS:MoS, NombreMoS:NombreMoS, Accion:Accion, check_list_posicion_id:check_list_posicion_id },   
            success: function(data) {
              tabla_check_list_posicion.ajax.reload(null, false);
            }
        });
      }
    });
  });
  ///:: FIN BOTON BORRAR REGISTRO CHECK LIST POSICION :::::::::::::::::::::::::::::::::::::///

  ///:: TERMINO BOTONES POSICION DE CHECK LIST FLOTA ::::::::::::::::::::::::::::::::::::::///
});
///:: TERMINO JS DOM POSICION DE CHECK LIST DE FLOTA ::::::::::::::::::::::::::::::::::::::///


///:: INICIO FUNCIONES CHECK LIST POSICION ::::::::::::::::::::::::::::::::::::::::::::::::///

///:: VALIDA LOS CAMPOS DEL FORMULARIO ::::::::::::::::::::::::::::::::::::::::::::::::::::///
function f_validar_check_list_posicion(p_pos_chl_bus_tipo, p_pos_chl_codigo, p_pos_chl_descripcion, p_pos_chl_componente, p_pos_chl_posicion){
  f_limpia_check_list_posicion();
  let rpta_validar_check_list_posicion = "";

  if(p_pos_chl_bus_tipo==""){
    $("#pos_chl_bus_tipo").addClass("color-error");
    rpta_validar_check_list_posicion = "invalido";
  }
  if(p_pos_chl_codigo==""){
    $("#pos_chl_codigo").addClass("color-error");
    rpta_validar_check_list_posicion = "invalido";
  }
  if(p_pos_chl_descripcion==""){
    $("#pos_chl_descripcion").addClass("color-error");
    rpta_validar_check_list_posicion = "invalido";
  }
  if(p_pos_chl_componente==""){
    $("#pos_chl_componente").addClass("color-error");
    rpta_validar_check_list_posicion = "invalido";
  }
  if(p_pos_chl_posicion==""){
    $("#pos_chl_posicion").addClass("color-error");
    rpta_validar_check_list_posicion = "invalido";
  }

  return rpta_validar_check_list_posicion; 
}
///:: FIN VALIDA LOS CAMPOS DEL FORMULARIO ::::::::::::::::::::::::::::::::::::::::::::::::///

///:: RESTABLECE EL COLOR DE FONDO DE LOS CAMPOS DEL FORMULARIO :::::::::::::::::::::::::::///
function f_limpia_check_list_posicion(){
  $("#pos_chl_bus_tipo").removeClass("color-error");
  $("#pos_chl_codigo").removeClass("color-error");
  $("#pos_chl_descripcion").removeClass("color-error");
  $("#pos_chl_componente").removeClass("color-error");
  $("#pos_chl_posicion").removeClass("color-error");
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

function f_select_combos_posicion(){
  select_chl_posicion = f_select_combo("manto_tc_check_list", "NO", "tc_categoria3", "",  "`tc_categoria1`='CHECK LIST' AND `tc_categoria2`='TIPO BUS'", "`tc_categoria3`");
  $("#pos_chl_bus_tipo").html(select_chl_posicion);
  select_chl_posicion = f_select_combo("manto_check_list_codigo", "NO", "chl_codigo", "",  "`chl_bus_tipo`='"+pos_chl_bus_tipo+"'", "`chl_orden`");
  $("#pos_chl_codigo").html(select_chl_posicion);
  select_chl_posicion = f_select_combo("manto_check_list_componente", "SI", "chl_componente", "",  "`chl_bus_tipo`='"+pos_chl_bus_tipo+"' AND `chl_codigo`='"+pos_chl_codigo+"'", "`chl_componente`");
  $("#pos_chl_componente").html(select_chl_posicion);
}

///:: TERMINO FUNCIONES CHECK LIST CODIGO :::::::::::::::::::::::::::::::::::::::::::::::::///