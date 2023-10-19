///::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
///:: POSICION DE COMPONENTE DE FLOTA v 1.0 FECHA: 2023-08-10 :::::::::::::::::::::::::::::///
///:: CREAR EDITAR ELIMINAR POSICION DE COMPONENTE DE INSPECCION DE FLOTA :::::::::::::::::///
///::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///

///:: DECLARACION VARIABLES GLOBALES ::::::::::::::::::::::::::::::::::::::::::::::::::::::///
var tabla_inspeccion_posicion, opcion_inspeccion_posicion, pos_inspeccion_flota, pos_inspeccion_codigo, pos_inspeccion_componente, fila_inspeccion_posicion;
var inspeccion_posicion_id, pos_insp_tipo, pos_insp_bus_tipo, pos_insp_codigo, pos_insp_descripcion, pos_insp_componente, pos_insp_posicion;

///:: INICIO JS DOM CODIGOS DE INSPECCION DE FLOTA ::::::::::::::::::::::::::::::::::::::::///
$(document).ready(function(){
  let select_insp_posicion="";

  select_insp_posicion = f_select_combo("manto_tc_inspeccion", "NO", "tc_categoria2", "",  "`tc_ficha`='INSPECCION' AND `tc_categoria1`='TIPO BUS'", "`tc_categoria2`");
  $("#pos_inspeccion_flota").html(select_insp_posicion);

  div_boton = f_BotonesFormulario("form_seleccion_inspeccion_posicion","btn_seleccion_inspeccion_posicion");
  $("#div_btn_seleccion_inspeccion_posicion").html(div_boton);

  $("#pos_inspeccion_flota, #pos_inspeccion_codigo, #pos_inspeccion_componente").on('change', function () {
    $("#div_tabla_inspeccion_posicion").empty();
  });

  $("#pos_inspeccion_flota").on('change', function () {
    pos_inspeccion_flota = $("#pos_inspeccion_flota").val();
    pos_inspeccion_codigo = "";
    pos_inspeccion_componente = "";
    select_insp_posicion = f_select_codigo_inspeccion(pos_inspeccion_flota);
    $("#pos_inspeccion_codigo").html(select_insp_posicion);
    $("#pos_inspeccion_codigo").val(pos_inspeccion_codigo);
    select_insp_posicion = f_select_combo("manto_inspeccion_componente", "NO", "insp_componente", "",  "`insp_bus_tipo`='"+pos_inspeccion_flota+"' AND `insp_codigo`='"+pos_inspeccion_codigo+"'", "`insp_componente`");
    $("#pos_inspeccion_componente").html(select_insp_posicion);
    $("#pos_inspeccion_componente").val(pos_inspeccion_componente);
  });

  $("#pos_inspeccion_codigo").on('change', function () {
    pos_inspeccion_flota = $("#pos_inspeccion_flota").val();
    pos_inspeccion_codigo = $("#pos_inspeccion_codigo").val();
    pos_inspeccion_componente = "";
    select_insp_posicion = f_select_combo("manto_inspeccion_componente", "NO", "insp_componente", "",  "`insp_bus_tipo`='"+pos_inspeccion_flota+"' AND `insp_codigo`='"+pos_inspeccion_codigo+"'", "`insp_componente`");
    $("#pos_inspeccion_componente").html(select_insp_posicion);
    $("#pos_inspeccion_componente").val(pos_inspeccion_componente);
  });

  $("#pos_insp_bus_tipo").on('change', function () {
    pos_insp_bus_tipo = $("#pos_insp_bus_tipo").val();
    pos_insp_codigo = "";
    pos_insp_descripcion = "";
    pos_insp_componente = "";
    select_insp_posicion = f_select_combo("manto_inspeccion_codigo", "NO", "insp_codigo", "",  "`insp_bus_tipo`='"+pos_insp_bus_tipo+"'", "`insp_orden`");
    $("#pos_insp_codigo").html(select_insp_posicion);
    $("#pos_insp_codigo").val(pos_insp_codigo);
    $("#pos_insp_descripcion").val(pos_insp_descripcion);
    $("#pos_insp_componente").val(pos_insp_componente);
  });

  $("#pos_insp_codigo").on('change', function () {
    pos_insp_bus_tipo = $("#pos_insp_bus_tipo").val();
    pos_insp_codigo = $("#pos_insp_codigo").val();
    pos_insp_componente = "";
    pos_insp_descripcion = f_buscar_dato("manto_inspeccion_codigo","insp_descripcion","`insp_bus_tipo`='"+pos_insp_bus_tipo+"' AND `insp_codigo`='"+pos_insp_codigo+"'");
    $("#pos_insp_descripcion").val(pos_insp_descripcion);
    select_insp_posicion = f_select_combo("manto_inspeccion_componente", "SI", "insp_componente", "",  "`insp_bus_tipo`='"+pos_insp_bus_tipo+"' AND `insp_codigo`='"+pos_insp_codigo+"'", "`insp_componente`");
    $("#pos_insp_componente").html(select_insp_posicion);
    $("#pos_insp_componente").val(pos_insp_componente);
  });

  ///:: BOTONES POSICION DE INSPECCION FLOTA ::::::::::::::::::::::::::::::::::::::::::::::///

  ///:: EVENTO BOTON BUSCAR POSICION INSPECCION FLOTA :::::::::::::::::::::::::::::::::::::///
  $(document).on("click", ".btn_buscar_inspeccion_posicion", function(){  
    pos_inspeccion_flota = $("#pos_inspeccion_flota").val();
    pos_inspeccion_codigo = $("#pos_inspeccion_codigo").val();
    pos_inspeccion_componente = $("#pos_inspeccion_componente").val();

    div_tabla = f_CreacionTabla("tabla_inspeccion_posicion","");
    $("#div_tabla_inspeccion_posicion").html(div_tabla);
    columnas_tabla = f_ColumnasTabla("tabla_inspeccion_posicion","")

    $("#tabla_inspeccion_posicion").dataTable().fnDestroy();
    $("#tabla_inspeccion_posicion").show();

    Accion='buscar_inspeccion_posicion';
    tabla_inspeccion_posicion = $('#tabla_inspeccion_posicion').DataTable({
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
          title     : 'POSICION DE INSPECCION PARA LA FLOTA '+pos_inspeccion_flota
        },
      ],
      "ajax"      : {            
        "url"     : "Ajax.php", 
        "method"  : 'POST',
        "data"    : {MoS:MoS, NombreMoS:NombreMoS, Accion:Accion, insp_bus_tipo:pos_inspeccion_flota, insp_codigo:pos_inspeccion_codigo, insp_componente:pos_inspeccion_componente},
        "dataSrc" : ""
      },
      "columns"   : columnas_tabla,
      "order"     : [[0, 'asc']]
    });
  });
  ///:: FIN BOTONES POSICION DE INSPECCION FLOTA ::::::::::::::::::::::::::::::::::::::::::///

  ///:: CREA INSPECCION POSICION DE FLOTA :::::::::::::::::::::::::::::::::::::::::::::::::::///
  $('#form_inspeccion_posicion').submit(function(e){                         
    e.preventDefault(); 
    let valida_inspeccion_posicion = "";
    let existe_posicion = "";
    let msg_error_posicion = "";
    pos_insp_bus_tipo     = $.trim($('#pos_insp_bus_tipo').val());
    pos_insp_codigo       = $.trim($('#pos_insp_codigo').val());
    pos_insp_descripcion  = $.trim($('#pos_insp_descripcion').val());
    pos_insp_componente   = $.trim($('#pos_insp_componente').val());
    pos_insp_posicion     = $.trim($('#pos_insp_posicion').val());
    pos_insp_posicion     = pos_insp_posicion.toUpperCase();
    valida_inspeccion_posicion = f_validar_inspeccion_posicion(pos_insp_bus_tipo, pos_insp_codigo, pos_insp_descripcion, pos_insp_componente, pos_insp_posicion);

    if(valida_inspeccion_posicion=="invalido"){
      msg_error_posicion = "*Es posible que falte completar información.";
    }
    if(opcion_inspeccion_posicion=="CREAR"){
      existe_posicion = f_buscar_dato("manto_inspeccion_posicion","insp_posicion","`insp_bus_tipo`= '"+pos_insp_bus_tipo+"' AND `insp_codigo`='"+pos_insp_codigo+"' AND `insp_componente`='"+pos_insp_componente+"' AND `insp_posicion`='"+pos_insp_posicion+"'");
      if(existe_posicion!=""){
        msg_error_posicion += " *La Posición de Inspección ya se encuentra creada.";
        valida_inspeccion_posicion = "invalido";
      }  
    }

    if(valida_inspeccion_posicion=="invalido"){
        Swal.fire({
          icon: 'error',
          title: 'INFORMACION...',
          text: msg_error_posicion+' !!!'
        })
    }else{
      $("#btn_guardar_inspeccion_posicion").prop("disabled",true);
      if(opcion_inspeccion_posicion=="CREAR"){
        Accion='crear_inspeccion_posicion';
      }else{
        Accion='editar_inspeccion_posicion';
      }
      $.ajax({
        url       : "Ajax.php",
        type      : "POST",
        datatype  : "json",
        data      : { MoS:MoS, NombreMoS:NombreMoS, Accion:Accion, inspeccion_posicion_id:inspeccion_posicion_id, insp_bus_tipo:pos_insp_bus_tipo, insp_codigo:pos_insp_codigo, insp_componente:pos_insp_componente, insp_posicion:pos_insp_posicion },
        success: function(data) {
          tabla_inspeccion_posicion.ajax.reload(null, false);
          Swal.fire({
            icon  : 'success',
            title :  'El registro ha sido grabado con exito !!!.',
            showConfirmButton: false,
            timer : 1500  
          })
        }
      });
      $("#btn_guardar_inspeccion_posicion").prop("disabled",false);
      $('#modal_crud_inspeccion_posicion').modal('hide');
    }
  });
  ///:: FIN CREA INSPECCION POSICION DE FLOTA :::::::::::::::::::::::::::::::::::::::::::::///

  ///:: EVENTO BOTON GENERAR INSPECCION POSICION FLOTA ::::::::::::::::::::::::::::::::::::///
  $(document).on("click", ".btn_nuevo_inspeccion_posicion", function(){
    $("#form_inspeccion_posicion").trigger("reset"); 
    opcion_inspeccion_posicion = "CREAR";
    inspeccion_posicion_id = "";

    pos_insp_bus_tipo = $("#pos_inspeccion_flota").val();
    pos_insp_codigo = $("#pos_inspeccion_codigo").val();
    pos_insp_descripcion = f_buscar_dato("manto_inspeccion_codigo","insp_descripcion","`insp_bus_tipo`='"+pos_insp_bus_tipo+"' AND `insp_codigo`='"+pos_insp_codigo+"'")
    pos_insp_componente = $("#pos_inspeccion_componente").val();

    f_select_combos_posicion();

    $("#pos_insp_bus_tipo").val(pos_insp_bus_tipo);
    $("#pos_insp_codigo").val(pos_insp_codigo);
    $("#pos_insp_descripcion").val(pos_insp_descripcion);
    $("#pos_insp_componente").val(pos_insp_componente);

    $("#pos_insp_bus_tipo").prop("disabled",false);
    $("#pos_insp_codigo").prop("disabled",false);
    $("#pos_insp_componente").prop("disabled",false);
    
    f_limpia_inspeccion_posicion();
    
    $(".modal-header").css( "background-color", "#17a2b8");
    $(".modal-header").css( "color", "white" );
    $(".modal-title").text("Alta Posición de Inspección");
    $('#modal_crud_inspeccion_posicion').modal('show');
  });
  ///:: FIN EVENTO BOTON GENERAR INSPECCION POSICION FLOTA ::::::::::::::::::::::::::::::::///

  ///:: BOTON EDITAR INSPECCION POSICION ::::::::::::::::::::::::::::::::::::::::::::::::::///
  $(document).on("click", ".btn_editar_inspeccion_posicion", function(){
    opcion_inspeccion_posicion = "EDITAR";
    
    f_limpia_inspeccion_posicion();
    fila_inspeccion_posicion = $(this).closest("tr");  
    
    inspeccion_posicion_id  = fila_inspeccion_posicion.find('td:eq(0)').text();
    pos_insp_bus_tipo     = fila_inspeccion_posicion.find('td:eq(1)').text();
    pos_insp_codigo       = fila_inspeccion_posicion.find('td:eq(2)').text();
    pos_insp_descripcion  = fila_inspeccion_posicion.find('td:eq(3)').text();
    pos_insp_componente   = fila_inspeccion_posicion.find('td:eq(4)').text();
    pos_insp_posicion     = fila_inspeccion_posicion.find('td:eq(5)').text();
    f_select_combos_posicion();
    $("#pos_insp_tipo").prop("disabled",true);
    $("#pos_insp_bus_tipo").prop("disabled",true);
    $("#pos_insp_codigo").prop("disabled",true);
    $("#pos_insp_componente").prop("disabled",true);

    $("#pos_insp_bus_tipo").val(pos_insp_bus_tipo);
    $("#pos_insp_codigo").val(pos_insp_codigo);
    $("#pos_insp_descripcion").val(pos_insp_descripcion);
    $("#pos_insp_componente").val(pos_insp_componente);
    $("#pos_insp_posicion").val(pos_insp_posicion);

    $(".modal-header").css("background-color", "#007bff");
    $(".modal-header").css("color", "white" );
    $(".modal-title").text("Editar Posición de Inspección");		

    $('#modal_crud_inspeccion_posicion').modal('show');		   
  });
  ///:: FIN BOTON EDITAR INSPECCION POSICION ::::::::::::::::::::::::::::::::::::::::::::::///
  
  ///:: BOTON BORRAR REGISTRO INSPECCION CODIGO :::::::::::::::::::::::::::::::::::::::::::///
  $(document).on("click", ".btn_borrar_inspeccion_posicion", function(){
    fila_inspeccion_posicion = $(this).closest('tr');           
    inspeccion_posicion_id = fila_inspeccion_posicion.find('td:eq(0)').text();     
    Swal.fire({
      title               : '¿Está seguro?',
      text                : "Se eliminará el registro Id "+inspeccion_posicion_id+"!",
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
        Accion='borrar_inspeccion_posicion';
        $.ajax({
        url         : "Ajax.php",
        type        : "POST",
        datatype    : "json",
        async       : false,    
        data        : { MoS:MoS, NombreMoS:NombreMoS, Accion:Accion, inspeccion_posicion_id:inspeccion_posicion_id },   
            success: function(data) {
              tabla_inspeccion_posicion.ajax.reload(null, false);
            }
        });
      }
    });
  });
  ///:: FIN BOTON BORRAR REGISTRO INSPECCION POSICION :::::::::::::::::::::::::::::::::::::///

  ///:: TERMINO BOTONES POSICION DE INSPECCION FLOTA ::::::::::::::::::::::::::::::::::::::///
});
///:: TERMINO JS DOM POSICION DE INSPECCION DE FLOTA ::::::::::::::::::::::::::::::::::::::///


///:: INICIO FUNCIONES INSPECCION POSICION ::::::::::::::::::::::::::::::::::::::::::::::::///

///:: VALIDA LOS CAMPOS DEL FORMULARIO ::::::::::::::::::::::::::::::::::::::::::::::::::::///
function f_validar_inspeccion_posicion(p_pos_insp_bus_tipo, p_pos_insp_codigo, p_pos_insp_descripcion, p_pos_insp_componente, p_pos_insp_posicion){
  f_limpia_inspeccion_posicion();
  let rpta_validar_inspeccion_posicion = "";

  if(p_pos_insp_bus_tipo==""){
    $("#pos_insp_bus_tipo").addClass("color-error");
    rpta_validar_inspeccion_posicion = "invalido";
  }
  if(p_pos_insp_codigo==""){
    $("#pos_insp_codigo").addClass("color-error");
    rpta_validar_inspeccion_posicion = "invalido";
  }
  if(p_pos_insp_descripcion==""){
    $("#pos_insp_descripcion").addClass("color-error");
    rpta_validar_inspeccion_posicion = "invalido";
  }
  if(p_pos_insp_componente==""){
    $("#pos_insp_componente").addClass("color-error");
    rpta_validar_inspeccion_posicion = "invalido";
  }
  if(p_pos_insp_posicion==""){
    $("#pos_insp_posicion").addClass("color-error");
    rpta_validar_inspeccion_posicion = "invalido";
  }

  return rpta_validar_inspeccion_posicion; 
}
///:: FIN VALIDA LOS CAMPOS DEL FORMULARIO ::::::::::::::::::::::::::::::::::::::::::::::::///

///:: RESTABLECE EL COLOR DE FONDO DE LOS CAMPOS DEL FORMULARIO :::::::::::::::::::::::::::///
function f_limpia_inspeccion_posicion(){
  $("#pos_insp_bus_tipo").removeClass("color-error");
  $("#pos_insp_codigo").removeClass("color-error");
  $("#pos_insp_descripcion").removeClass("color-error");
  $("#pos_insp_componente").removeClass("color-error");
  $("#pos_insp_posicion").removeClass("color-error");
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

function f_select_combos_posicion(){
  select_insp_posicion = f_select_combo("manto_tc_inspeccion", "NO", "tc_categoria2", "",  "`tc_ficha`='INSPECCION' AND `tc_categoria1`='TIPO BUS'", "`tc_categoria2`");
  $("#pos_insp_bus_tipo").html(select_insp_posicion);
  select_insp_posicion = f_select_combo("manto_inspeccion_codigo", "NO", "insp_codigo", "",  "`insp_bus_tipo`='"+pos_insp_bus_tipo+"'", "`insp_orden`");
  $("#pos_insp_codigo").html(select_insp_posicion);
  select_insp_posicion = f_select_combo("manto_inspeccion_componente", "SI", "insp_componente", "",  "`insp_bus_tipo`='"+pos_insp_bus_tipo+"' AND `insp_codigo`='"+pos_insp_codigo+"'", "`insp_componente`");
  $("#pos_insp_componente").html(select_insp_posicion);
}

///:: TERMINO FUNCIONES INSPECCION CODIGO :::::::::::::::::::::::::::::::::::::::::::::::::///