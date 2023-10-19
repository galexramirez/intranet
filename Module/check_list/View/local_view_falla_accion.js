///::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
///:: FALLA Y ACCION POR COMPONENTE DE CODIGO DE CHECK LIST v 1.0 FECHA: 2023-08-10 :::::::///
///:: CREAR EDITAR ELIMINAR FALLA Y ACCION POR COMPONENTE DE CHECK LIST DE FLOTA ::::::::::///
///::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///

///:: DECLARACION VARIABLES GLOBALES ::::::::::::::::::::::::::::::::::::::::::::::::::::::///
var tabla_check_list_falla_accion, opcion_check_list_falla_accion, fal_check_list_flota, fal_check_list_codigo, fal_check_list_componente, fila_check_list_falla_accion;
var check_list_falla_accion_id, fal_chl_bus_tipo, fal_chl_codigo, fal_chl_descripcion, fal_chl_componente, fal_chl_falla, fal_chl_accion;

///:: INICIO JS DOM COMPONENTES DE CHECK LIST DE FLOTA ::::::::::::::::::::::::::::::::::::///
$(document).ready(function(){
  let select_chl_falla_accion="";

  select_chl_falla_accion = f_select_combo("manto_tc_check_list", "NO", "tc_categoria3", "",  "`tc_categoria1`='CHECK LIST' AND `tc_categoria2`='TIPO BUS'", "`tc_categoria3`");
  $("#fal_check_list_flota").html(select_chl_falla_accion);

  div_boton = f_BotonesFormulario("form_seleccion_check_list_falla_accion","btn_seleccion_check_list_falla_accion");
  $("#div_btn_seleccion_check_list_falla_accion").html(div_boton);

  $("#fal_check_list_flota, #fal_check_list_codigo, #fal_check_list_componente").on('change', function () {
    $("#div_tabla_check_list_falla_accion").empty();
  });

  $("#fal_check_list_flota").on('change', function () {
    fal_check_list_flota = $("#fal_check_list_flota").val();
    fal_check_list_codigo = "";
    fal_check_list_componente = "";
    select_chl_falla_accion = f_select_codigo_check_list(fal_check_list_flota);
    $("#fal_check_list_codigo").html(select_chl_falla_accion);
    $("#fal_check_list_codigo").val(fal_check_list_codigo);
    select_chl_falla_accion = f_select_combo("manto_check_list_componente", "NO", "chl_componente", "",  "`chl_bus_tipo`='"+fal_check_list_flota+"' AND `chl_codigo`='"+fal_check_list_codigo+"'", "`chl_componente`");
    $("#fal_check_list_componente").html(select_chl_falla_accion);
    $("#fal_check_list_componente").val(fal_check_list_componente);
  });

  $("#fal_check_list_codigo").on('change', function () {
    fal_check_list_flota = $("#fal_check_list_flota").val();
    fal_check_list_codigo = $("#fal_check_list_codigo").val();
    fal_check_list_componente = "";
    select_chl_falla_accion = f_select_combo("manto_check_list_componente", "NO", "chl_componente", "",  "`chl_bus_tipo`='"+fal_check_list_flota+"' AND `chl_codigo`='"+fal_check_list_codigo+"'", "`chl_componente`");
    $("#fal_check_list_componente").html(select_chl_falla_accion);
  });

  $("#fal_chl_bus_tipo").on('change', function () {
    fal_chl_bus_tipo = $("#fal_chl_bus_tipo").val();
    fal_chl_codigo = "";
    fal_chl_descripcion = "";
    fal_chl_componente = "";
    select_chl_falla_accion = f_select_combo("manto_check_list_codigo", "NO", "chl_codigo", "",  "`chl_bus_tipo`='"+fal_chl_bus_tipo+"'", "`chl_orden`");
    $("#fal_chl_codigo").html(select_chl_falla_accion);
    $("#fal_chl_codigo").val(fal_chl_codigo);
    $("#fal_chl_descripcion").val(fal_chl_descripcion);
    $("#fal_chl_componente").val(fal_chl_componente);
  });

  $("#fal_chl_codigo").on('change', function () {
    fal_chl_bus_tipo = $("#fal_chl_bus_tipo").val();
    fal_chl_codigo = $("#fal_chl_codigo").val();
    fal_chl_descripcion = f_buscar_dato("manto_check_list_codigo","chl_descripcion","`chl_bus_tipo`='"+fal_chl_bus_tipo+"' AND `chl_codigo`='"+fal_chl_codigo+"'");
    fal_chl_componente = "";
    $("#fal_chl_descripcion").val(fal_chl_descripcion);
    select_chl_falla_accion = f_select_combo("manto_check_list_componente", "NO", "chl_componente", "",  "`chl_bus_tipo`='"+fal_chl_bus_tipo+"' AND `chl_codigo`='"+fal_chl_codigo+"'", "`chl_componente`");
    $("#fal_chl_componente").html(select_chl_falla_accion);
    $("#fal_chl_componente").val(fal_chl_componente);
  });

  ///:: BOTONES COMPONENTES DE CHECK LIST FLOTA ::::::::::::::::::::::::::::::::::::::::::///

  ///:: EVENTO BOTON BUSCAR COMPONENTE CHECK LIST FLOTA ::::::::::::::::::::::::::::::::::///       
  $(document).on("click", ".btn_buscar_check_list_falla_accion", function(){  
    fal_check_list_flota = $("#fal_check_list_flota").val();
    fal_check_list_codigo = $("#fal_check_list_codigo").val();
    fal_check_list_componente = $("#fal_check_list_componente").val();

    div_tabla = f_CreacionTabla("tabla_check_list_falla_accion","");
    $("#div_tabla_check_list_falla_accion").html(div_tabla);
    columnas_tabla = f_ColumnasTabla("tabla_check_list_falla_accion","")

    $("#tabla_check_list_falla_accion").dataTable().fnDestroy();
    $("#tabla_check_list_falla_accion").show();
  
    Accion='buscar_check_list_falla_accion';
    tabla_check_list_falla_accion = $('#tabla_check_list_falla_accion').DataTable({
      //Color a las filas
      "rowCallback":function(row,data,index)
      {
        f_color_filas_check_list_falla_accion(row,data);
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
          title     : 'MODO DE FALLAS Y ACCION DE CHECK LIST PARA LA FLOTA '+fal_check_list_flota
        },
      ],
      "ajax"      : {            
        "url"     : "Ajax.php", 
        "method"  : 'POST',
        "data"    : {MoS:MoS, NombreMoS:NombreMoS, Accion:Accion, chl_bus_tipo:fal_check_list_flota, chl_codigo:fal_check_list_codigo, chl_componente:fal_check_list_componente},
        "dataSrc" : ""
      },
      "columns"   : columnas_tabla,
      "order"     : [[0, 'asc']]
    });
  });
  ///:: FIN BOTONES COMPONENTE DE CHECK LIST FLOTA ::::::::::::::::::::::::::::::::::::::::///

  ///:: CREA CHECK LIST COMPONENTES DE FLOTA ::::::::::::::::::::::::::::::::::::::::::::::///
  $('#form_check_list_falla_accion').submit(function(e){                         
    e.preventDefault(); 
    let valida_check_list_falla_ajuste = "";
    let existe_falla_accion = "";
    let msg_error_falla_accion = "";
    fal_chl_bus_tipo     = $.trim($('#fal_chl_bus_tipo').val());
    fal_chl_codigo       = $.trim($('#fal_chl_codigo').val());
    fal_chl_descripcion  = $.trim($('#fal_chl_descripcion').val());
    fal_chl_componente   = $.trim($('#fal_chl_componente').val());
    fal_chl_falla        = $.trim($('#fal_chl_falla').val());
    fal_chl_accion       = $.trim($('#fal_chl_accion').val());
    valida_check_list_falla_ajuste = f_validar_check_list_falla_accion(fal_chl_bus_tipo, fal_chl_codigo, fal_chl_descripcion, fal_chl_componente, fal_chl_falla, fal_chl_accion);
    
    if(valida_check_list_falla_ajuste=="invalido"){
      msg_error_falla_accion = "*Es posible que falte completar información.";
    }
    if(opcion_check_list_falla_accion=="CREAR"){
      existe_falla_accion = f_buscar_dato("manto_check_list_falla_accion","chl_falla","`chl_bus_tipo`= '"+fal_chl_bus_tipo+"' AND `chl_codigo`='"+fal_chl_codigo+"' AND `chl_componente`='"+fal_chl_componente+"' AND `chl_falla`='"+fal_chl_falla+"' AND `chl_accion`='"+fal_chl_accion+"'");
      if(existe_falla_accion!=""){
        msg_error_falla_accion += " *El Modo de Falla y la Accion de Check List ya se encuentra creado.";
        valida_check_list_falla_ajuste = "invalido";
      }  
    }

    if(valida_check_list_falla_ajuste=="invalido"){
        Swal.fire({
          icon: 'error',
          title: 'INFORMACION...',
          text: msg_error_falla_accion+' !!!'
        })
    }else{
      $("#btn_guardar_check_list_falla_accion").prop("disabled",true);
      if(opcion_check_list_falla_accion=="CREAR"){
        Accion='crear_check_list_falla_accion';
      }else{
        Accion='editar_check_list_falla_accion';
      }
      $.ajax({
        url       : "Ajax.php",
        type      : "POST",
        datatype  : "json",
        data      : { MoS:MoS, NombreMoS:NombreMoS, Accion:Accion, check_list_falla_accion_id:check_list_falla_accion_id, chl_bus_tipo:fal_chl_bus_tipo, chl_codigo:fal_chl_codigo, chl_componente:fal_chl_componente, chl_falla:fal_chl_falla, chl_accion:fal_chl_accion },
        success: function(data) {
          tabla_check_list_falla_accion.ajax.reload(null, false);
          Swal.fire({
            icon  : 'success',
            title :  'El registro ha sido grabado con exito !!!.',
            showConfirmButton: false,
            timer : 1500  
          })
        }
      });
      $("#btn_guardar_check_list_falla_accion").prop("disabled",false);
      $('#modal_crud_check_list_falla_accion').modal('hide');
    }
  });
  ///:: FIN CREA CHECK LIST COMPONENTES DE FLOTA ::::::::::::::::::::::::::::::::::::::::::///

  ///:: EVENTO BOTON GENERAR CHECK LIST COMPONENTES FLOTA :::::::::::::::::::::::::::::::::///
  $(document).on("click", ".btn_nuevo_check_list_falla_accion", function(){
    $("#form_check_list_falla_accion").trigger("reset"); 
    opcion_check_list_falla_accion = "CREAR";
    check_list_falla_accion_id = "";
    fal_chl_bus_tipo = $("#fal_check_list_flota").val();
    fal_chl_codigo = $("#fal_check_list_codigo").val();
    fal_chl_descripcion = f_buscar_dato("manto_check_list_codigo","chl_descripcion","`chl_bus_tipo`='"+fal_chl_bus_tipo+"' AND `chl_codigo`='"+fal_chl_codigo+"'")
    fal_chl_componente = $("#fal_check_list_componente").val();

    f_select_combos_falla_accion();

    $("#fal_chl_bus_tipo").val(fal_chl_bus_tipo);
    $("#fal_chl_codigo").val(fal_chl_codigo);
    $("#fal_chl_descripcion").val(fal_chl_descripcion);
    $("#fal_chl_componente").val(fal_chl_componente);

    $("#fal_chl_bus_tipo").prop("disabled",false);
    $("#fal_chl_codigo").prop("disabled",false);
    $("#fal_chl_componente").prop("disabled",false);
    f_limpia_check_list_falla_accion();

    $(".modal-header").css( "background-color", "#17a2b8");
    $(".modal-header").css( "color", "white" );
    $(".modal-title").text("Alta Modo de Falla y Accion de Check List");
    $('#modal_crud_check_list_falla_accion').modal('show');	    
  });
  ///:: FIN EVENTO BOTON GENERAR CHECK LIST COMPONENTES FLOTA :::::::::::::::::::::::::::::///

  ///:: BOTON EDITAR CHECK LIST COMPONENTES :::::::::::::::::::::::::::::::::::::::::::::::///
  $(document).on("click", ".btn_editar_check_list_falla_accion", function(){
    opcion_check_list_falla_accion = "EDITAR";

    f_limpia_check_list_falla_accion();
    fila_check_list_falla_accion = $(this).closest("tr");  
    
    check_list_falla_accion_id  = fila_check_list_falla_accion.find('td:eq(0)').text();
    fal_chl_bus_tipo     = fila_check_list_falla_accion.find('td:eq(1)').text();
    fal_chl_codigo       = fila_check_list_falla_accion.find('td:eq(2)').text();
    fal_chl_descripcion  = fila_check_list_falla_accion.find('td:eq(3)').text();
    fal_chl_componente   = fila_check_list_falla_accion.find('td:eq(4)').text();
    fal_chl_falla        = fila_check_list_falla_accion.find('td:eq(5)').text();
    fal_chl_accion       = fila_check_list_falla_accion.find('td:eq(6)').text();
    f_select_combos_falla_accion();
    $("#fal_chl_bus_tipo").prop("disabled",true);
    $("#fal_chl_codigo").prop("disabled",true);
    $("#fal_chl_componente").prop("disabled",true);

    $("#fal_chl_bus_tipo").val(fal_chl_bus_tipo);
    $("#fal_chl_codigo").val(fal_chl_codigo);
    $("#fal_chl_descripcion").val(fal_chl_descripcion);
    $("#fal_chl_componente").val(fal_chl_componente);
    $("#fal_chl_falla").val(fal_chl_falla);
    $("#fal_chl_accion").val(fal_chl_accion);

    $(".modal-header").css("background-color", "#007bff");
    $(".modal-header").css("color", "white" );
    $(".modal-title").text("Editar Mode de Falla y Accion de Check List");		

    $('#modal_crud_check_list_falla_accion').modal('show');		   
  });
  ///:: FIN BOTON EDITAR CHECK LIST COMPONENTES :::::::::::::::::::::::::::::::::::::::::::///
  
  ///:: BOTON BORRAR REGISTRO CHECK LIST COMPONENTE :::::::::::::::::::::::::::::::::::::::///
  $(document).on("click", ".btn_borrar_check_list_falla_accion", function(){
    fila_check_list_falla_accion = $(this).closest('tr');           
    check_list_falla_accion_id = fila_check_list_falla_accion.find('td:eq(0)').text();     
    Swal.fire({
      title               : '¿Está seguro?',
      text                : "Se eliminará el registro Id "+check_list_falla_accion_id+"!",
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
        Accion='borrar_check_list_falla_accion';
        $.ajax({
        url         : "Ajax.php",
        type        : "POST",
        datatype    : "json",
        async       : false,    
        data        : { MoS:MoS, NombreMoS:NombreMoS, Accion:Accion, check_list_falla_accion_id:check_list_falla_accion_id },   
            success: function(data) {
              tabla_check_list_falla_accion.ajax.reload(null, false);
            }
        });
      }
    });
  });
  ///:: FIN BOTON BORRAR REGISTRO CHECK LIST COMPONENTE :::::::::::::::::::::::::::::::::::///

  ///:: TERMINO BOTONES COMPONENTES DE CHECK LIST FLOTA :::::::::::::::::::::::::::::::::::///
});
///:: TERMINO JS DOM COMPONENTES DE CHECK LIST DE FLOTA :::::::::::::::::::::::::::::::::::///


///:: INICIO FUNCIONES CHECK LIST COMPONENTES :::::::::::::::::::::::::::::::::::::::::::::///

///:: VALIDA LOS CAMPOS DEL FORMULARIO ::::::::::::::::::::::::::::::::::::::::::::::::::::///
function f_validar_check_list_falla_accion(p_fal_chl_bus_tipo, p_fal_chl_codigo, p_fal_chl_descripcion, p_fal_chl_componente, p_fal_chl_falla, p_fal_chl_accion){
  f_limpia_check_list_falla_accion();
  let rpta_validar_check_list_posicion = "";

  if(p_fal_chl_bus_tipo==""){
    $("#fal_chl_bus_tipo").addClass("color-error");
    rpta_validar_check_list_posicion = "invalido";
  }
  if(p_fal_chl_codigo==""){
    $("#fal_chl_codigo").addClass("color-error");
    rpta_validar_check_list_posicion = "invalido";
  }
  if(p_fal_chl_descripcion==""){
    $("#fal_chl_descripcion").addClass("color-error");
    rpta_validar_check_list_posicion = "invalido";
  }
  if(p_fal_chl_componente==""){
    $("#fal_chl_componente").addClass("color-error");
    rpta_validar_check_list_posicion = "invalido";
  }
  if(p_fal_chl_falla==""){
    $("#fal_chl_falla").addClass("color-error");
    rpta_validar_check_list_posicion = "invalido";
  }
  if(p_fal_chl_accion==""){
    $("#fal_chl_accion").addClass("color-error");
    rpta_validar_check_list_posicion = "invalido";
  }

  return rpta_validar_check_list_posicion; 
}
///:: FIN VALIDA LOS CAMPOS DEL FORMULARIO ::::::::::::::::::::::::::::::::::::::::::::::::///

///:: RESTABLECE EL COLOR DE FONDO DE LOS CAMPOS DEL FORMULARIO :::::::::::::::::::::::::::///
function f_limpia_check_list_falla_accion(){
  $("#fal_chl_bus_tipo").removeClass("color-error");
  $("#fal_chl_codigo").removeClass("color-error");
  $("#fal_chl_descripcion").removeClass("color-error");
  $("#fal_chl_componente").removeClass("color-error");
  $("#fal_chl_falla").removeClass("color-error");
  $("#fal_chl_accion").removeClass("color-error");
}
///:: RESTABLECE EL COLOR DE FONDO DE LOS CAMPOS DEL FORMULARIO :::::::::::::::::::::::::::///

///:: ESTABLECE EL COLOR DE LAS COLUMNAS DEL DATATABLE ::::::::::::::::::::::::::::::::::::///
function f_color_filas_check_list_falla_accion(row,data){
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
  select_chl_falla_accion = f_select_combo("manto_tc_check_list", "NO", "tc_categoria3", "",  "`tc_categoria1`='CHECK LIST' AND `tc_categoria2`='TIPO BUS'", "`tc_categoria3`");
  $("#fal_chl_bus_tipo").html(select_chl_falla_accion);
  select_chl_falla_accion = f_select_combo("manto_check_list_codigo", "NO", "chl_codigo", "",  "`chl_bus_tipo`='"+fal_chl_bus_tipo+"'", "`chl_orden`");
  $("#fal_chl_codigo").html(select_chl_falla_accion);
  select_chl_falla_accion = f_select_combo("manto_check_list_componente", "NO", "chl_componente", "",  "`chl_bus_tipo`='"+fal_chl_bus_tipo+"' AND `chl_codigo`='"+fal_chl_codigo+"'", "`chl_componente`");
  $("#fal_chl_componente").html(select_chl_falla_accion);
  select_chl_falla_accion = f_select_combo("manto_tc_check_list", "NO", "tc_categoria3", "",  "`tc_categoria1`='CHECK LIST' AND `tc_categoria2`='FALLA'", "`tc_categoria3`");
  $("#fal_chl_falla").html(select_chl_falla_accion);
  select_chl_falla_accion = f_select_combo("manto_tc_check_list", "NO", "tc_categoria3", "",  "`tc_categoria1`='CHECK LIST' AND `tc_categoria2`='ACCION'", "`tc_categoria3`");
  $("#fal_chl_accion").html(select_chl_falla_accion);
}

///:: TERMINO FUNCIONES CHECK LIST COMPONENTES ::::::::::::::::::::::::::::::::::::::::::::///