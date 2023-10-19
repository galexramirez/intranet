///::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
///:: POSICION DE COMPONENTE DE FLOTA v 1.0 FECHA: 2023-09-25 :::::::::::::::::::::::::::::///
///:: CREAR EDITAR ELIMINAR POSICION DE COMPONENTE DE FALLA EN VIA DE FLOTA :::::::::::::::::///
///::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///

///:: DECLARACION VARIABLES GLOBALES ::::::::::::::::::::::::::::::::::::::::::::::::::::::///
var tabla_falla_via_posicion, opcion_falla_via_posicion, pos_falla_via_flota, pos_falla_via_codigo, pos_falla_via_componente, fila_falla_via_posicion;
var falla_via_posicion_id, pos_fav_tipo, pos_fav_bus_tipo, pos_fav_codigo, pos_fav_descripcion, pos_fav_componente, pos_fav_posicion;

///:: INICIO JS DOM CODIGOS DE FALLA EN VIA DE FLOTA ::::::::::::::::::::::::::::::::::::::::///
$(document).ready(function(){
  let select_fav_posicion="";

  select_fav_posicion = f_select_combo("manto_tc_check_list", "NO", "tc_categoria3", "",  "`tc_categoria1`='FALLA EN VIA' AND `tc_categoria2`='TIPO BUS'", "`tc_categoria3`");
  $("#pos_falla_via_flota").html(select_fav_posicion);

  div_boton = f_BotonesFormulario("form_seleccion_falla_via_posicion","btn_seleccion_falla_via_posicion");
  $("#div_btn_seleccion_falla_via_posicion").html(div_boton);

  $("#pos_falla_via_flota, #pos_falla_via_codigo, #pos_falla_via_componente").on('change', function () {
    $("#div_tabla_falla_via_posicion").empty();
  });

  $("#pos_falla_via_flota").on('change', function () {
    pos_falla_via_flota = $("#pos_falla_via_flota").val();
    pos_falla_via_codigo = "";
    pos_falla_via_componente = "";
    select_fav_posicion = f_select_codigo_falla_via(pos_falla_via_flota);
    $("#pos_falla_via_codigo").html(select_fav_posicion);
    $("#pos_falla_via_codigo").val(pos_falla_via_codigo);
    select_fav_posicion = f_select_combo("manto_falla_via_componente", "NO", "fav_componente", "",  "`fav_bus_tipo`='"+pos_falla_via_flota+"' AND `fav_codigo`='"+pos_falla_via_codigo+"'", "`fav_componente`");
    $("#pos_falla_via_componente").html(select_fav_posicion);
    $("#pos_falla_via_componente").val(pos_falla_via_componente);
  });

  $("#pos_falla_via_codigo").on('change', function () {
    pos_falla_via_flota = $("#pos_falla_via_flota").val();
    pos_falla_via_codigo = $("#pos_falla_via_codigo").val();
    pos_falla_via_componente = "";
    select_fav_posicion = f_select_combo("manto_falla_via_componente", "NO", "fav_componente", "",  "`fav_bus_tipo`='"+pos_falla_via_flota+"' AND `fav_codigo`='"+pos_falla_via_codigo+"'", "`fav_componente`");
    $("#pos_falla_via_componente").html(select_fav_posicion);
    $("#pos_falla_via_componente").val(pos_falla_via_componente);
  });

  $("#pos_fav_bus_tipo").on('change', function () {
    pos_fav_bus_tipo = $("#pos_fav_bus_tipo").val();
    pos_fav_codigo = "";
    pos_fav_descripcion = "";
    pos_fav_componente = "";
    select_fav_posicion = f_select_combo("manto_falla_via_codigo", "NO", "fav_codigo", "",  "`fav_bus_tipo`='"+pos_fav_bus_tipo+"'", "`fav_orden`");
    $("#pos_fav_codigo").html(select_fav_posicion);
    $("#pos_fav_codigo").val(pos_fav_codigo);
    $("#pos_fav_descripcion").val(pos_fav_descripcion);
    $("#pos_fav_componente").val(pos_fav_componente);
  });

  $("#pos_fav_codigo").on('change', function () {
    pos_fav_bus_tipo = $("#pos_fav_bus_tipo").val();
    pos_fav_codigo = $("#pos_fav_codigo").val();
    pos_fav_componente = "";
    pos_fav_descripcion = f_buscar_dato("manto_falla_via_codigo","fav_descripcion","`fav_bus_tipo`='"+pos_fav_bus_tipo+"' AND `fav_codigo`='"+pos_fav_codigo+"'");
    $("#pos_fav_descripcion").val(pos_fav_descripcion);
    select_fav_posicion = f_select_combo("manto_falla_via_componente", "SI", "fav_componente", "",  "`fav_bus_tipo`='"+pos_fav_bus_tipo+"' AND `fav_codigo`='"+pos_fav_codigo+"'", "`fav_componente`");
    $("#pos_fav_componente").html(select_fav_posicion);
    $("#pos_fav_componente").val(pos_fav_componente);
  });

  ///:: BOTONES POSICION DE FALLA EN VIA FLOTA ::::::::::::::::::::::::::::::::::::::::::::::///

  ///:: EVENTO BOTON BUSCAR POSICION FALLA EN VIA FLOTA :::::::::::::::::::::::::::::::::::::///
  $(document).on("click", ".btn_buscar_falla_via_posicion", function(){  
    pos_falla_via_flota = $("#pos_falla_via_flota").val();
    pos_falla_via_codigo = $("#pos_falla_via_codigo").val();
    pos_falla_via_componente = $("#pos_falla_via_componente").val();

    div_tabla = f_CreacionTabla("tabla_falla_via_posicion","");
    $("#div_tabla_falla_via_posicion").html(div_tabla);
    columnas_tabla = f_ColumnasTabla("tabla_falla_via_posicion","")

    $("#tabla_falla_via_posicion").dataTable().fnDestroy();
    $("#tabla_falla_via_posicion").show();

    Accion='buscar_falla_via_posicion';
    tabla_falla_via_posicion = $('#tabla_falla_via_posicion').DataTable({
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
          title     : 'POSICION DE FALLA EN VIA PARA LA FLOTA '+pos_falla_via_flota
        },
      ],
      "ajax"      : {            
        "url"     : "Ajax.php", 
        "method"  : 'POST',
        "data"    : {MoS:MoS, NombreMoS:NombreMoS, Accion:Accion, fav_bus_tipo:pos_falla_via_flota, fav_codigo:pos_falla_via_codigo, fav_componente:pos_falla_via_componente},
        "dataSrc" : ""
      },
      "columns"   : columnas_tabla,
      "order"     : [[0, 'asc']]
    });
  });
  ///:: FIN BOTONES POSICION DE FALLA EN VIA FLOTA ::::::::::::::::::::::::::::::::::::::::::///

  ///:: CREA FALLA EN VIA POSICION DE FLOTA :::::::::::::::::::::::::::::::::::::::::::::::::::///
  $('#form_falla_via_posicion').submit(function(e){                         
    e.preventDefault(); 
    let valida_falla_via_posicion = "";
    let existe_posicion = "";
    let msg_error_posicion = "";
    pos_fav_bus_tipo     = $.trim($('#pos_fav_bus_tipo').val());
    pos_fav_codigo       = $.trim($('#pos_fav_codigo').val());
    pos_fav_descripcion  = $.trim($('#pos_fav_descripcion').val());
    pos_fav_componente   = $.trim($('#pos_fav_componente').val());
    pos_fav_posicion     = $.trim($('#pos_fav_posicion').val());
    pos_fav_posicion     = pos_fav_posicion.toUpperCase();
    valida_falla_via_posicion = f_validar_falla_via_posicion(pos_fav_bus_tipo, pos_fav_codigo, pos_fav_descripcion, pos_fav_componente, pos_fav_posicion);

    if(valida_falla_via_posicion=="invalido"){
      msg_error_posicion = "*Es posible que falte completar información.";
    }
    if(opcion_falla_via_posicion=="CREAR"){
      existe_posicion = f_buscar_dato("manto_falla_via_posicion","fav_posicion","`fav_bus_tipo`= '"+pos_fav_bus_tipo+"' AND `fav_codigo`='"+pos_fav_codigo+"' AND `fav_componente`='"+pos_fav_componente+"' AND `fav_posicion`='"+pos_fav_posicion+"'");
      if(existe_posicion!=""){
        msg_error_posicion += " *La Posición de Falla en Vía ya se encuentra creada.";
        valida_falla_via_posicion = "invalido";
      }  
    }

    if(valida_falla_via_posicion=="invalido"){
        Swal.fire({
          icon: 'error',
          title: 'INFORMACION...',
          text: msg_error_posicion+' !!!'
        })
    }else{
      $("#btn_guardar_falla_via_posicion").prop("disabled",true);
      if(opcion_falla_via_posicion=="CREAR"){
        Accion='crear_falla_via_posicion';
      }else{
        Accion='editar_falla_via_posicion';
      }
      $.ajax({
        url       : "Ajax.php",
        type      : "POST",
        datatype  : "json",
        data      : { MoS:MoS, NombreMoS:NombreMoS, Accion:Accion, falla_via_posicion_id:falla_via_posicion_id, fav_bus_tipo:pos_fav_bus_tipo, fav_codigo:pos_fav_codigo, fav_componente:pos_fav_componente, fav_posicion:pos_fav_posicion },
        success: function(data) {
          tabla_falla_via_posicion.ajax.reload(null, false);
          Swal.fire({
            icon  : 'success',
            title :  'El registro ha sido grabado con exito !!!.',
            showConfirmButton: false,
            timer : 1500  
          })
        }
      });
      $("#btn_guardar_falla_via_posicion").prop("disabled",false);
      $('#modal_crud_falla_via_posicion').modal('hide');
    }
  });
  ///:: FIN CREA FALLA EN VIA POSICION DE FLOTA :::::::::::::::::::::::::::::::::::::::::::::///

  ///:: EVENTO BOTON GENERAR FALLA EN VIA POSICION FLOTA ::::::::::::::::::::::::::::::::::::///
  $(document).on("click", ".btn_nuevo_falla_via_posicion", function(){
    $("#form_falla_via_posicion").trigger("reset"); 
    opcion_falla_via_posicion = "CREAR";
    falla_via_posicion_id = "";

    pos_fav_bus_tipo = $("#pos_falla_via_flota").val();
    pos_fav_codigo = $("#pos_falla_via_codigo").val();
    pos_fav_descripcion = f_buscar_dato("manto_falla_via_codigo","fav_descripcion","`fav_bus_tipo`='"+pos_fav_bus_tipo+"' AND `fav_codigo`='"+pos_fav_codigo+"'")
    pos_fav_componente = $("#pos_falla_via_componente").val();

    f_select_combos_posicion_falla_via();

    $("#pos_fav_bus_tipo").val(pos_fav_bus_tipo);
    $("#pos_fav_codigo").val(pos_fav_codigo);
    $("#pos_fav_descripcion").val(pos_fav_descripcion);
    $("#pos_fav_componente").val(pos_fav_componente);

    $("#pos_fav_bus_tipo").prop("disabled",false);
    $("#pos_fav_codigo").prop("disabled",false);
    $("#pos_fav_componente").prop("disabled",false);
    
    f_limpia_falla_via_posicion();
    
    $(".modal-header").css( "background-color", "#17a2b8");
    $(".modal-header").css( "color", "white" );
    $(".modal-title").text("Alta Posición de Falla en Vía");
    $('#modal_crud_falla_via_posicion').modal('show');
  });
  ///:: FIN EVENTO BOTON GENERAR FALLA EN VIA POSICION FLOTA ::::::::::::::::::::::::::::::::///

  ///:: BOTON EDITAR FALLA EN VIA POSICION ::::::::::::::::::::::::::::::::::::::::::::::::::///
  $(document).on("click", ".btn_editar_falla_via_posicion", function(){
    opcion_falla_via_posicion = "EDITAR";
    
    f_limpia_falla_via_posicion();
    fila_falla_via_posicion = $(this).closest("tr");  
    
    falla_via_posicion_id  = fila_falla_via_posicion.find('td:eq(0)').text();
    pos_fav_bus_tipo     = fila_falla_via_posicion.find('td:eq(1)').text();
    pos_fav_codigo       = fila_falla_via_posicion.find('td:eq(2)').text();
    pos_fav_descripcion  = fila_falla_via_posicion.find('td:eq(3)').text();
    pos_fav_componente   = fila_falla_via_posicion.find('td:eq(4)').text();
    pos_fav_posicion     = fila_falla_via_posicion.find('td:eq(5)').text();
    f_select_combos_posicion_falla_via();
    $("#pos_fav_tipo").prop("disabled",true);
    $("#pos_fav_bus_tipo").prop("disabled",true);
    $("#pos_fav_codigo").prop("disabled",true);
    $("#pos_fav_componente").prop("disabled",true);

    $("#pos_fav_bus_tipo").val(pos_fav_bus_tipo);
    $("#pos_fav_codigo").val(pos_fav_codigo);
    $("#pos_fav_descripcion").val(pos_fav_descripcion);
    $("#pos_fav_componente").val(pos_fav_componente);
    $("#pos_fav_posicion").val(pos_fav_posicion);

    $(".modal-header").css("background-color", "#007bff");
    $(".modal-header").css("color", "white" );
    $(".modal-title").text("Editar Posición de Falla en Vía");		

    $('#modal_crud_falla_via_posicion').modal('show');		   
  });
  ///:: FIN BOTON EDITAR FALLA EN VIA POSICION ::::::::::::::::::::::::::::::::::::::::::::::///
  
  ///:: BOTON BORRAR REGISTRO FALLA EN VIA CODIGO :::::::::::::::::::::::::::::::::::::::::::///
  $(document).on("click", ".btn_borrar_falla_via_posicion", function(){
    fila_falla_via_posicion = $(this).closest('tr');           
    falla_via_posicion_id = fila_falla_via_posicion.find('td:eq(0)').text();     
    Swal.fire({
      title               : '¿Está seguro?',
      text                : "Se eliminará el registro Id "+falla_via_posicion_id+"!",
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
        Accion='borrar_falla_via_posicion';
        $.ajax({
        url         : "Ajax.php",
        type        : "POST",
        datatype    : "json",
        async       : false,    
        data        : { MoS:MoS, NombreMoS:NombreMoS, Accion:Accion, falla_via_posicion_id:falla_via_posicion_id },   
            success: function(data) {
              tabla_falla_via_posicion.ajax.reload(null, false);
            }
        });
      }
    });
  });
  ///:: FIN BOTON BORRAR REGISTRO FALLA EN VIA POSICION :::::::::::::::::::::::::::::::::::::///

  ///:: TERMINO BOTONES POSICION DE FALLA EN VIA FLOTA ::::::::::::::::::::::::::::::::::::::///
});
///:: TERMINO JS DOM POSICION DE FALLA EN VIA DE FLOTA ::::::::::::::::::::::::::::::::::::::///


///:: INICIO FUNCIONES FALLA EN VIA POSICION ::::::::::::::::::::::::::::::::::::::::::::::::///

///:: VALIDA LOS CAMPOS DEL FORMULARIO ::::::::::::::::::::::::::::::::::::::::::::::::::::///
function f_validar_falla_via_posicion(p_pos_fav_bus_tipo, p_pos_fav_codigo, p_pos_fav_descripcion, p_pos_fav_componente, p_pos_fav_posicion){
  f_limpia_falla_via_posicion();
  let rpta_validar_falla_via_posicion = "";

  if(p_pos_fav_bus_tipo==""){
    $("#pos_fav_bus_tipo").addClass("color-error");
    rpta_validar_falla_via_posicion = "invalido";
  }
  if(p_pos_fav_codigo==""){
    $("#pos_fav_codigo").addClass("color-error");
    rpta_validar_falla_via_posicion = "invalido";
  }
  if(p_pos_fav_descripcion==""){
    $("#pos_fav_descripcion").addClass("color-error");
    rpta_validar_falla_via_posicion = "invalido";
  }
  if(p_pos_fav_componente==""){
    $("#pos_fav_componente").addClass("color-error");
    rpta_validar_falla_via_posicion = "invalido";
  }
  if(p_pos_fav_posicion==""){
    $("#pos_fav_posicion").addClass("color-error");
    rpta_validar_falla_via_posicion = "invalido";
  }

  return rpta_validar_falla_via_posicion; 
}
///:: FIN VALIDA LOS CAMPOS DEL FORMULARIO ::::::::::::::::::::::::::::::::::::::::::::::::///

///:: RESTABLECE EL COLOR DE FONDO DE LOS CAMPOS DEL FORMULARIO :::::::::::::::::::::::::::///
function f_limpia_falla_via_posicion(){
  $("#pos_fav_bus_tipo").removeClass("color-error");
  $("#pos_fav_codigo").removeClass("color-error");
  $("#pos_fav_descripcion").removeClass("color-error");
  $("#pos_fav_componente").removeClass("color-error");
  $("#pos_fav_posicion").removeClass("color-error");
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

function f_select_combos_posicion_falla_via(){
  select_fav_posicion = f_select_combo("manto_tc_check_list", "NO", "tc_categoria3", "",  "`tc_categoria1`='FALLA EN VIA' AND `tc_categoria2`='TIPO BUS'", "`tc_categoria3`");
  $("#pos_fav_bus_tipo").html(select_fav_posicion);
  select_fav_posicion = f_select_combo("manto_falla_via_codigo", "NO", "fav_codigo", "",  "`fav_bus_tipo`='"+pos_fav_bus_tipo+"'", "`fav_orden`");
  $("#pos_fav_codigo").html(select_fav_posicion);
  select_fav_posicion = f_select_combo("manto_falla_via_componente", "SI", "fav_componente", "",  "`fav_bus_tipo`='"+pos_fav_bus_tipo+"' AND `fav_codigo`='"+pos_fav_codigo+"'", "`fav_componente`");
  $("#pos_fav_componente").html(select_fav_posicion);
}

///:: TERMINO FUNCIONES FALLA EN VIA CODIGO :::::::::::::::::::::::::::::::::::::::::::::::::///