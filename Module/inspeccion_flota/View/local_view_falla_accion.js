///::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
///:: FALLA Y ACCION POR COMPONENTE DE CODIGO DE INSPECCION v 1.0 FECHA: 2023-08-10 :::::::///
///:: CREAR EDITAR ELIMINAR FALLA Y ACCION POR COMPONENTE DE INSPECCION DE FLOTA ::::::::::///
///::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///

///:: DECLARACION VARIABLES GLOBALES ::::::::::::::::::::::::::::::::::::::::::::::::::::::///
var tabla_inspeccion_falla_accion, opcion_inspeccion_falla_accion, fal_inspeccion_flota, fal_inspeccion_codigo, fal_inspeccion_componente, fila_inspeccion_falla_accion;
var inspeccion_falla_accion_id, fal_insp_bus_tipo, fal_insp_codigo, fal_insp_descripcion, fal_insp_componente, fal_insp_falla, fal_insp_accion;

///:: INICIO JS DOM COMPONENTES DE INSPECCION DE FLOTA ::::::::::::::::::::::::::::::::::::///
$(document).ready(function(){
  let select_insp_falla_accion="";

  select_insp_falla_accion = f_select_combo("manto_tc_inspeccion", "NO", "tc_categoria2", "",  "`tc_ficha`='INSPECCION' AND `tc_categoria1`='TIPO BUS'", "`tc_categoria2`");
  $("#fal_inspeccion_flota").html(select_insp_falla_accion);

  div_boton = f_BotonesFormulario("form_seleccion_inspeccion_falla_accion","btn_seleccion_inspeccion_falla_accion");
  $("#div_btn_seleccion_inspeccion_falla_accion").html(div_boton);

  $("#fal_inspeccion_flota, #fal_inspeccion_codigo, #fal_inspeccion_componente").on('change', function () {
    $("#div_tabla_inspeccion_falla_accion").empty();
  });

  $("#fal_inspeccion_flota").on('change', function () {
    fal_inspeccion_flota = $("#fal_inspeccion_flota").val();
    fal_inspeccion_codigo = "";
    fal_inspeccion_componente = "";
    select_insp_falla_accion = f_select_codigo_inspeccion(fal_inspeccion_flota);
    $("#fal_inspeccion_codigo").html(select_insp_falla_accion);
    $("#fal_inspeccion_codigo").val(fal_inspeccion_codigo);
    select_insp_falla_accion = f_select_combo("manto_inspeccion_componente", "NO", "insp_componente", "",  "`insp_bus_tipo`='"+fal_inspeccion_flota+"' AND `insp_codigo`='"+fal_inspeccion_codigo+"'", "`insp_componente`");
    $("#fal_inspeccion_componente").html(select_insp_falla_accion);
    $("#fal_inspeccion_componente").val(fal_inspeccion_componente);
  });

  $("#fal_inspeccion_codigo").on('change', function () {
    fal_inspeccion_flota = $("#fal_inspeccion_flota").val();
    fal_inspeccion_codigo = $("#fal_inspeccion_codigo").val();
    fal_inspeccion_componente = "";
    select_insp_falla_accion = f_select_combo("manto_inspeccion_componente", "NO", "insp_componente", "",  "`insp_bus_tipo`='"+fal_inspeccion_flota+"' AND `insp_codigo`='"+fal_inspeccion_codigo+"'", "`insp_componente`");
    $("#fal_inspeccion_componente").html(select_insp_falla_accion);
  });

  $("#fal_insp_bus_tipo").on('change', function () {
    fal_insp_bus_tipo = $("#fal_insp_bus_tipo").val();
    fal_insp_codigo = "";
    fal_insp_descripcion = "";
    fal_insp_componente = "";
    select_insp_falla_accion = f_select_combo("manto_inspeccion_codigo", "NO", "insp_codigo", "",  "`insp_bus_tipo`='"+fal_insp_bus_tipo+"'", "`insp_orden`");
    $("#fal_insp_codigo").html(select_insp_falla_accion);
    $("#fal_insp_codigo").val(fal_insp_codigo);
    $("#fal_insp_descripcion").val(fal_insp_descripcion);
    $("#fal_insp_componente").val(fal_insp_componente);
  });

  $("#fal_insp_codigo").on('change', function () {
    fal_insp_bus_tipo = $("#fal_insp_bus_tipo").val();
    fal_insp_codigo = $("#fal_insp_codigo").val();
    fal_insp_descripcion = f_buscar_dato("manto_inspeccion_codigo","insp_descripcion","`insp_bus_tipo`='"+fal_insp_bus_tipo+"' AND `insp_codigo`='"+fal_insp_codigo+"'");
    fal_insp_componente = "";
    $("#fal_insp_descripcion").val(fal_insp_descripcion);
    select_insp_falla_accion = f_select_combo("manto_inspeccion_componente", "NO", "insp_componente", "",  "`insp_bus_tipo`='"+fal_insp_bus_tipo+"' AND `insp_codigo`='"+fal_insp_codigo+"'", "`insp_componente`");
    $("#fal_insp_componente").html(select_insp_falla_accion);
    $("#fal_insp_componente").val(fal_insp_componente);
  });

  ///:: BOTONES COMPONENTES DE INSPECCION FLOTA ::::::::::::::::::::::::::::::::::::::::::///

  ///:: EVENTO BOTON BUSCAR COMPONENTE INSPECCION FLOTA ::::::::::::::::::::::::::::::::::///       
  $(document).on("click", ".btn_buscar_inspeccion_falla_accion", function(){  
    fal_inspeccion_flota = $("#fal_inspeccion_flota").val();
    fal_inspeccion_codigo = $("#fal_inspeccion_codigo").val();
    fal_inspeccion_componente = $("#fal_inspeccion_componente").val();

    div_tabla = f_CreacionTabla("tabla_inspeccion_falla_accion","");
    $("#div_tabla_inspeccion_falla_accion").html(div_tabla);
    columnas_tabla = f_ColumnasTabla("tabla_inspeccion_falla_accion","")

    $("#tabla_inspeccion_falla_accion").dataTable().fnDestroy();
    $("#tabla_inspeccion_falla_accion").show();
  
    Accion='buscar_inspeccion_falla_accion';
    tabla_inspeccion_falla_accion = $('#tabla_inspeccion_falla_accion').DataTable({
      //Color a las filas
      "rowCallback":function(row,data,index)
      {
        f_color_filas_inspeccion_falla_accion(row,data);
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
          title     : 'MODO DE FALLAS Y ACCION DE INSPECCION PARA LA FLOTA '+fal_inspeccion_flota
        },
      ],
      "ajax"      : {            
        "url"     : "Ajax.php", 
        "method"  : 'POST',
        "data"    : {MoS:MoS, NombreMoS:NombreMoS, Accion:Accion, insp_bus_tipo:fal_inspeccion_flota, insp_codigo:fal_inspeccion_codigo, insp_componente:fal_inspeccion_componente},
        "dataSrc" : ""
      },
      "columns"   : columnas_tabla,
      "order"     : [[0, 'asc']]
    });
  });
  ///:: FIN BOTONES COMPONENTE DE INSPECCION FLOTA ::::::::::::::::::::::::::::::::::::::::///

  ///:: CREA INSPECCION COMPONENTES DE FLOTA ::::::::::::::::::::::::::::::::::::::::::::::///
  $('#form_inspeccion_falla_accion').submit(function(e){                         
    e.preventDefault(); 
    let valida_inspeccion_falla_ajuste = "";
    let existe_falla_accion = "";
    let msg_error_falla_accion = "";
    fal_insp_bus_tipo     = $.trim($('#fal_insp_bus_tipo').val());
    fal_insp_codigo       = $.trim($('#fal_insp_codigo').val());
    fal_insp_descripcion  = $.trim($('#fal_insp_descripcion').val());
    fal_insp_componente   = $.trim($('#fal_insp_componente').val());
    fal_insp_falla        = $.trim($('#fal_insp_falla').val());
    fal_insp_accion       = $.trim($('#fal_insp_accion').val());
    valida_inspeccion_falla_ajuste = f_validar_inspeccion_falla_accion(fal_insp_bus_tipo, fal_insp_codigo, fal_insp_descripcion, fal_insp_componente, fal_insp_falla, fal_insp_accion);
    
    if(valida_inspeccion_falla_ajuste=="invalido"){
      msg_error_falla_accion = "*Es posible que falte completar información.";
    }
    if(opcion_inspeccion_falla_accion=="CREAR"){
      existe_falla_accion = f_buscar_dato("manto_inspeccion_falla_accion","insp_falla","`insp_bus_tipo`= '"+fal_insp_bus_tipo+"' AND `insp_codigo`='"+fal_insp_codigo+"' AND `insp_componente`='"+fal_insp_componente+"' AND `insp_falla`='"+fal_insp_falla+"' AND `insp_accion`='"+fal_insp_accion+"'");
      if(existe_falla_accion!=""){
        msg_error_falla_accion += " *El Modo de Falla y la Accion de Inspección ya se encuentra creado.";
        valida_inspeccion_falla_ajuste = "invalido";
      }  
    }

    if(valida_inspeccion_falla_ajuste=="invalido"){
        Swal.fire({
          icon: 'error',
          title: 'INFORMACION...',
          text: msg_error_falla_accion+' !!!'
        })
    }else{
      $("#btn_guardar_inspeccion_falla_accion").prop("disabled",true);
      if(opcion_inspeccion_falla_accion=="CREAR"){
        Accion='crear_inspeccion_falla_accion';
      }else{
        Accion='editar_inspeccion_falla_accion';
      }
      $.ajax({
        url       : "Ajax.php",
        type      : "POST",
        datatype  : "json",
        data      : { MoS:MoS, NombreMoS:NombreMoS, Accion:Accion, inspeccion_falla_accion_id:inspeccion_falla_accion_id, insp_bus_tipo:fal_insp_bus_tipo, insp_codigo:fal_insp_codigo, insp_componente:fal_insp_componente, insp_falla:fal_insp_falla, insp_accion:fal_insp_accion },
        success: function(data) {
          tabla_inspeccion_falla_accion.ajax.reload(null, false);
          Swal.fire({
            icon  : 'success',
            title :  'El registro ha sido grabado con exito !!!.',
            showConfirmButton: false,
            timer : 1500  
          })
        }
      });
      $("#btn_guardar_inspeccion_falla_accion").prop("disabled",false);
      $('#modal_crud_inspeccion_falla_accion').modal('hide');
    }
  });
  ///:: FIN CREA INSPECCION COMPONENTES DE FLOTA ::::::::::::::::::::::::::::::::::::::::::///

  ///:: EVENTO BOTON GENERAR INSPECCION COMPONENTES FLOTA :::::::::::::::::::::::::::::::::///
  $(document).on("click", ".btn_nuevo_inspeccion_falla_accion", function(){
    $("#form_inspeccion_falla_accion").trigger("reset"); 
    opcion_inspeccion_falla_accion = "CREAR";
    inspeccion_falla_accion_id = "";
    fal_insp_bus_tipo = $("#fal_inspeccion_flota").val();
    fal_insp_codigo = $("#fal_inspeccion_codigo").val();
    fal_insp_descripcion = f_buscar_dato("manto_inspeccion_codigo","insp_descripcion","`insp_bus_tipo`='"+fal_insp_bus_tipo+"' AND `insp_codigo`='"+fal_insp_codigo+"'")
    fal_insp_componente = $("#fal_inspeccion_componente").val();

    f_select_combos_falla_accion();

    $("#fal_insp_bus_tipo").val(fal_insp_bus_tipo);
    $("#fal_insp_codigo").val(fal_insp_codigo);
    $("#fal_insp_descripcion").val(fal_insp_descripcion);
    $("#fal_insp_componente").val(fal_insp_componente);

    $("#fal_insp_bus_tipo").prop("disabled",false);
    $("#fal_insp_codigo").prop("disabled",false);
    $("#fal_insp_componente").prop("disabled",false);
    f_limpia_inspeccion_falla_accion();

    $(".modal-header").css( "background-color", "#17a2b8");
    $(".modal-header").css( "color", "white" );
    $(".modal-title").text("Alta Modo de Falla y Accion de Inspección");
    $('#modal_crud_inspeccion_falla_accion').modal('show');	    
  });
  ///:: FIN EVENTO BOTON GENERAR INSPECCION COMPONENTES FLOTA :::::::::::::::::::::::::::::///

  ///:: BOTON EDITAR INSPECCION COMPONENTES :::::::::::::::::::::::::::::::::::::::::::::::///
  $(document).on("click", ".btn_editar_inspeccion_falla_accion", function(){
    opcion_inspeccion_falla_accion = "EDITAR";

    f_limpia_inspeccion_falla_accion();
    fila_inspeccion_falla_accion = $(this).closest("tr");  
    
    inspeccion_falla_accion_id  = fila_inspeccion_falla_accion.find('td:eq(0)').text();
    fal_insp_bus_tipo     = fila_inspeccion_falla_accion.find('td:eq(1)').text();
    fal_insp_codigo       = fila_inspeccion_falla_accion.find('td:eq(2)').text();
    fal_insp_descripcion  = fila_inspeccion_falla_accion.find('td:eq(3)').text();
    fal_insp_componente   = fila_inspeccion_falla_accion.find('td:eq(4)').text();
    fal_insp_falla        = fila_inspeccion_falla_accion.find('td:eq(5)').text();
    fal_insp_accion       = fila_inspeccion_falla_accion.find('td:eq(6)').text();
    f_select_combos_falla_accion();
    $("#fal_insp_bus_tipo").prop("disabled",true);
    $("#fal_insp_codigo").prop("disabled",true);
    $("#fal_insp_componente").prop("disabled",true);

    $("#fal_insp_bus_tipo").val(fal_insp_bus_tipo);
    $("#fal_insp_codigo").val(fal_insp_codigo);
    $("#fal_insp_descripcion").val(fal_insp_descripcion);
    $("#fal_insp_componente").val(fal_insp_componente);
    $("#fal_insp_falla").val(fal_insp_falla);
    $("#fal_insp_accion").val(fal_insp_accion);

    $(".modal-header").css("background-color", "#007bff");
    $(".modal-header").css("color", "white" );
    $(".modal-title").text("Editar Mode de Falla y Accion de Inspección");		

    $('#modal_crud_inspeccion_falla_accion').modal('show');		   
  });
  ///:: FIN BOTON EDITAR INSPECCION COMPONENTES :::::::::::::::::::::::::::::::::::::::::::///
  
  ///:: BOTON BORRAR REGISTRO INSPECCION COMPONENTE :::::::::::::::::::::::::::::::::::::::///
  $(document).on("click", ".btn_borrar_inspeccion_falla_accion", function(){
    fila_inspeccion_falla_accion = $(this).closest('tr');           
    inspeccion_falla_accion_id = fila_inspeccion_falla_accion.find('td:eq(0)').text();     
    Swal.fire({
      title               : '¿Está seguro?',
      text                : "Se eliminará el registro Id "+inspeccion_falla_accion_id+"!",
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
        Accion='borrar_inspeccion_falla_accion';
        $.ajax({
        url         : "Ajax.php",
        type        : "POST",
        datatype    : "json",
        async       : false,    
        data        : { MoS:MoS, NombreMoS:NombreMoS, Accion:Accion, inspeccion_falla_accion_id:inspeccion_falla_accion_id },   
            success: function(data) {
              tabla_inspeccion_falla_accion.ajax.reload(null, false);
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
function f_validar_inspeccion_falla_accion(p_fal_insp_bus_tipo, p_fal_insp_codigo, p_fal_insp_descripcion, p_fal_insp_componente, p_fal_insp_falla, p_fal_insp_accion){
  f_limpia_inspeccion_falla_accion();
  let rpta_validar_inspeccion_posicion = "";

  if(p_fal_insp_bus_tipo==""){
    $("#fal_insp_bus_tipo").addClass("color-error");
    rpta_validar_inspeccion_posicion = "invalido";
  }
  if(p_fal_insp_codigo==""){
    $("#fal_insp_codigo").addClass("color-error");
    rpta_validar_inspeccion_posicion = "invalido";
  }
  if(p_fal_insp_descripcion==""){
    $("#fal_insp_descripcion").addClass("color-error");
    rpta_validar_inspeccion_posicion = "invalido";
  }
  if(p_fal_insp_componente==""){
    $("#fal_insp_componente").addClass("color-error");
    rpta_validar_inspeccion_posicion = "invalido";
  }
  if(p_fal_insp_falla==""){
    $("#fal_insp_falla").addClass("color-error");
    rpta_validar_inspeccion_posicion = "invalido";
  }
  if(p_fal_insp_accion==""){
    $("#fal_insp_accion").addClass("color-error");
    rpta_validar_inspeccion_posicion = "invalido";
  }

  return rpta_validar_inspeccion_posicion; 
}
///:: FIN VALIDA LOS CAMPOS DEL FORMULARIO ::::::::::::::::::::::::::::::::::::::::::::::::///

///:: RESTABLECE EL COLOR DE FONDO DE LOS CAMPOS DEL FORMULARIO :::::::::::::::::::::::::::///
function f_limpia_inspeccion_falla_accion(){
  $("#fal_insp_bus_tipo").removeClass("color-error");
  $("#fal_insp_codigo").removeClass("color-error");
  $("#fal_insp_descripcion").removeClass("color-error");
  $("#fal_insp_componente").removeClass("color-error");
  $("#fal_insp_falla").removeClass("color-error");
  $("#fal_insp_accion").removeClass("color-error");
}
///:: RESTABLECE EL COLOR DE FONDO DE LOS CAMPOS DEL FORMULARIO :::::::::::::::::::::::::::///

///:: ESTABLECE EL COLOR DE LAS COLUMNAS DEL DATATABLE ::::::::::::::::::::::::::::::::::::///
function f_color_filas_inspeccion_falla_accion(row,data){
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

function f_select_combos_falla_accion(){
  select_insp_falla_accion = f_select_combo("manto_tc_inspeccion", "NO", "tc_categoria2", "",  "`tc_ficha`='INSPECCION' AND `tc_categoria1`='TIPO BUS'", "`tc_categoria2`");
  $("#fal_insp_bus_tipo").html(select_insp_falla_accion);
  select_insp_falla_accion = f_select_combo("manto_inspeccion_codigo", "NO", "insp_codigo", "",  "`insp_bus_tipo`='"+fal_insp_bus_tipo+"'", "`insp_orden`");
  $("#fal_insp_codigo").html(select_insp_falla_accion);
  select_insp_falla_accion = f_select_combo("manto_inspeccion_componente", "NO", "insp_componente", "",  "`insp_bus_tipo`='"+fal_insp_bus_tipo+"' AND `insp_codigo`='"+fal_insp_codigo+"'", "`insp_componente`");
  $("#fal_insp_componente").html(select_insp_falla_accion);
  select_insp_falla_accion = f_select_combo("manto_tc_inspeccion", "NO", "tc_categoria2", "",  "`tc_ficha`='INSPECCION' AND `tc_categoria1`='FALLA'", "`tc_categoria2`");
  $("#fal_insp_falla").html(select_insp_falla_accion);
  select_insp_falla_accion = f_select_combo("manto_tc_inspeccion", "NO", "tc_categoria2", "",  "`tc_ficha`='INSPECCION' AND `tc_categoria1`='ACCION'", "`tc_categoria2`");
  $("#fal_insp_accion").html(select_insp_falla_accion);
}

///:: TERMINO FUNCIONES INSPECCION COMPONENTES ::::::::::::::::::::::::::::::::::::::::::::///