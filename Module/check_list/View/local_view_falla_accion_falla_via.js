///::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
///:: FALLA Y ACCION POR COMPONENTE DE CODIGO DE FALLA EN VIA v 1.0 FECHA: 2023-08-10 :::::///
///:: CREAR EDITAR ELIMINAR FALLA Y ACCION POR COMPONENTE DE FALLA EN VIA DE FLOTA ::::::::///
///::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///

///:: DECLARACION VARIABLES GLOBALES ::::::::::::::::::::::::::::::::::::::::::::::::::::::///
var tabla_falla_via_falla_accion, opcion_falla_via_falla_accion, fal_falla_via_flota, fal_falla_via_codigo, fal_falla_via_componente, fila_falla_via_falla_accion;
var falla_via_falla_accion_id, fal_fav_bus_tipo, fal_fav_codigo, fal_fav_descripcion, fal_fav_componente, fal_fav_falla, fal_fav_accion;

///:: INICIO JS DOM COMPONENTES DE FALLA EN VIA DE FLOTA ::::::::::::::::::::::::::::::::::///
$(document).ready(function(){
  let select_fav_falla_accion="";

  select_fav_falla_accion = f_select_combo("manto_tc_check_list", "NO", "tc_categoria3", "",  "`tc_categoria1`='FALLA EN VIA' AND `tc_categoria2`='TIPO BUS'", "`tc_categoria3`");
  $("#fal_falla_via_flota").html(select_fav_falla_accion);

  div_boton = f_BotonesFormulario("form_seleccion_falla_via_falla_accion","btn_seleccion_falla_via_falla_accion");
  $("#div_btn_seleccion_falla_via_falla_accion").html(div_boton);

  $("#fal_falla_via_flota, #fal_falla_via_codigo, #fal_falla_via_componente").on('change', function () {
    $("#div_tabla_falla_via_falla_accion").empty();
  });

  $("#fal_falla_via_flota").on('change', function () {
    fal_falla_via_flota = $("#fal_falla_via_flota").val();
    fal_falla_via_codigo = "";
    fal_falla_via_componente = "";
    select_fav_falla_accion = f_select_codigo_falla_via(fal_falla_via_flota);
    $("#fal_falla_via_codigo").html(select_fav_falla_accion);
    $("#fal_falla_via_codigo").val(fal_falla_via_codigo);
    select_fav_falla_accion = f_select_combo("manto_falla_via_componente", "NO", "fav_componente", "",  "`fav_bus_tipo`='"+fal_falla_via_flota+"' AND `fav_codigo`='"+fal_falla_via_codigo+"'", "`fav_componente`");
    $("#fal_falla_via_componente").html(select_fav_falla_accion);
    $("#fal_falla_via_componente").val(fal_falla_via_componente);
  });

  $("#fal_falla_via_codigo").on('change', function () {
    fal_falla_via_flota = $("#fal_falla_via_flota").val();
    fal_falla_via_codigo = $("#fal_falla_via_codigo").val();
    fal_falla_via_componente = "";
    select_fav_falla_accion = f_select_combo("manto_falla_via_componente", "NO", "fav_componente", "",  "`fav_bus_tipo`='"+fal_falla_via_flota+"' AND `fav_codigo`='"+fal_falla_via_codigo+"'", "`fav_componente`");
    $("#fal_falla_via_componente").html(select_fav_falla_accion);
  });

  $("#fal_fav_bus_tipo").on('change', function () {
    fal_fav_bus_tipo = $("#fal_fav_bus_tipo").val();
    fal_fav_codigo = "";
    fal_fav_descripcion = "";
    fal_fav_componente = "";
    select_fav_falla_accion = f_select_combo("manto_falla_via_codigo", "NO", "fav_codigo", "",  "`fav_bus_tipo`='"+fal_fav_bus_tipo+"'", "`fav_orden`");
    $("#fal_fav_codigo").html(select_fav_falla_accion);
    $("#fal_fav_codigo").val(fal_fav_codigo);
    $("#fal_fav_descripcion").val(fal_fav_descripcion);
    $("#fal_fav_componente").val(fal_fav_componente);
  });

  $("#fal_fav_codigo").on('change', function () {
    fal_fav_bus_tipo = $("#fal_fav_bus_tipo").val();
    fal_fav_codigo = $("#fal_fav_codigo").val();
    fal_fav_descripcion = f_buscar_dato("manto_falla_via_codigo","fav_descripcion","`fav_bus_tipo`='"+fal_fav_bus_tipo+"' AND `fav_codigo`='"+fal_fav_codigo+"'");
    fal_fav_componente = "";
    $("#fal_fav_descripcion").val(fal_fav_descripcion);
    select_fav_falla_accion = f_select_combo("manto_falla_via_componente", "NO", "fav_componente", "",  "`fav_bus_tipo`='"+fal_fav_bus_tipo+"' AND `fav_codigo`='"+fal_fav_codigo+"'", "`fav_componente`");
    $("#fal_fav_componente").html(select_fav_falla_accion);
    $("#fal_fav_componente").val(fal_fav_componente);
  });

  ///:: BOTONES COMPONENTES DE FALLA EN VIA FLOTA ::::::::::::::::::::::::::::::::::::::::::///

  ///:: EVENTO BOTON BUSCAR COMPONENTE FALLA EN VIA FLOTA ::::::::::::::::::::::::::::::::::///       
  $(document).on("click", ".btn_buscar_falla_via_falla_accion", function(){  
    fal_falla_via_flota = $("#fal_falla_via_flota").val();
    fal_falla_via_codigo = $("#fal_falla_via_codigo").val();
    fal_falla_via_componente = $("#fal_falla_via_componente").val();

    div_tabla = f_CreacionTabla("tabla_falla_via_falla_accion","");
    $("#div_tabla_falla_via_falla_accion").html(div_tabla);
    columnas_tabla = f_ColumnasTabla("tabla_falla_via_falla_accion","")

    $("#tabla_falla_via_falla_accion").dataTable().fnDestroy();
    $("#tabla_falla_via_falla_accion").show();
  
    Accion='buscar_falla_via_falla_accion';
    tabla_falla_via_falla_accion = $('#tabla_falla_via_falla_accion').DataTable({
      //Color a las filas
      "rowCallback":function(row,data,index)
      {
        f_color_filas_falla_via_falla_accion(row,data);
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
          title     : 'MODO DE FALLAS Y ACCION DE FALLA EN VIA PARA LA FLOTA '+fal_falla_via_flota
        },
      ],
      "ajax"      : {            
        "url"     : "Ajax.php", 
        "method"  : 'POST',
        "data"    : {MoS:MoS, NombreMoS:NombreMoS, Accion:Accion, fav_bus_tipo:fal_falla_via_flota, fav_codigo:fal_falla_via_codigo, fav_componente:fal_falla_via_componente},
        "dataSrc" : ""
      },
      "columns"   : columnas_tabla,
      "order"     : [[0, 'asc']]
    });
  });
  ///:: FIN BOTONES COMPONENTE DE FALLA EN VIA FLOTA ::::::::::::::::::::::::::::::::::::::::///

  ///:: CREA FALLA EN VIA COMPONENTES DE FLOTA ::::::::::::::::::::::::::::::::::::::::::::::///
  $('#form_falla_via_falla_accion').submit(function(e){                         
    e.preventDefault(); 
    let valida_falla_via_falla_ajuste = "";
    let existe_falla_accion = "";
    let msg_error_falla_accion = "";
    fal_fav_bus_tipo     = $.trim($('#fal_fav_bus_tipo').val());
    fal_fav_codigo       = $.trim($('#fal_fav_codigo').val());
    fal_fav_descripcion  = $.trim($('#fal_fav_descripcion').val());
    fal_fav_componente   = $.trim($('#fal_fav_componente').val());
    fal_fav_falla        = $.trim($('#fal_fav_falla').val());
    fal_fav_accion       = $.trim($('#fal_fav_accion').val());
    valida_falla_via_falla_ajuste = f_validar_falla_via_falla_accion(fal_fav_bus_tipo, fal_fav_codigo, fal_fav_descripcion, fal_fav_componente, fal_fav_falla, fal_fav_accion);
    
    if(valida_falla_via_falla_ajuste=="invalido"){
      msg_error_falla_accion = "*Es posible que falte completar información.";
    }
    if(opcion_falla_via_falla_accion=="CREAR"){
      existe_falla_accion = f_buscar_dato("manto_falla_via_falla_accion","fav_falla","`fav_bus_tipo`= '"+fal_fav_bus_tipo+"' AND `fav_codigo`='"+fal_fav_codigo+"' AND `fav_componente`='"+fal_fav_componente+"' AND `fav_falla`='"+fal_fav_falla+"' AND `fav_accion`='"+fal_fav_accion+"'");
      if(existe_falla_accion!=""){
        msg_error_falla_accion += " *El Modo de Falla y la Accion de Falla en Vía ya se encuentra creado.";
        valida_falla_via_falla_ajuste = "invalido";
      }  
    }

    if(valida_falla_via_falla_ajuste=="invalido"){
        Swal.fire({
          icon: 'error',
          title: 'INFORMACION...',
          text: msg_error_falla_accion+' !!!'
        })
    }else{
      $("#btn_guardar_falla_via_falla_accion").prop("disabled",true);
      if(opcion_falla_via_falla_accion=="CREAR"){
        Accion='crear_falla_via_falla_accion';
      }else{
        Accion='editar_falla_via_falla_accion';
      }
      $.ajax({
        url       : "Ajax.php",
        type      : "POST",
        datatype  : "json",
        data      : { MoS:MoS, NombreMoS:NombreMoS, Accion:Accion, falla_via_falla_accion_id:falla_via_falla_accion_id, fav_bus_tipo:fal_fav_bus_tipo, fav_codigo:fal_fav_codigo, fav_componente:fal_fav_componente, fav_falla:fal_fav_falla, fav_accion:fal_fav_accion },
        success: function(data) {
          tabla_falla_via_falla_accion.ajax.reload(null, false);
          Swal.fire({
            icon  : 'success',
            title :  'El registro ha sido grabado con exito !!!.',
            showConfirmButton: false,
            timer : 1500  
          })
        }
      });
      $("#btn_guardar_falla_via_falla_accion").prop("disabled",false);
      $('#modal_crud_falla_via_falla_accion').modal('hide');
    }
  });
  ///:: FIN CREA FALLA EN VIA COMPONENTES DE FLOTA ::::::::::::::::::::::::::::::::::::::::::///

  ///:: EVENTO BOTON GENERAR FALLA EN VIA COMPONENTES FLOTA :::::::::::::::::::::::::::::::::///
  $(document).on("click", ".btn_nuevo_falla_via_falla_accion", function(){
    $("#form_falla_via_falla_accion").trigger("reset"); 
    opcion_falla_via_falla_accion = "CREAR";
    falla_via_falla_accion_id = "";
    fal_fav_bus_tipo = $("#fal_falla_via_flota").val();
    fal_fav_codigo = $("#fal_falla_via_codigo").val();
    fal_fav_descripcion = f_buscar_dato("manto_falla_via_codigo","fav_descripcion","`fav_bus_tipo`='"+fal_fav_bus_tipo+"' AND `fav_codigo`='"+fal_fav_codigo+"'")
    fal_fav_componente = $("#fal_falla_via_componente").val();

    f_select_combos_falla_accion_falla_via();

    $("#fal_fav_bus_tipo").val(fal_fav_bus_tipo);
    $("#fal_fav_codigo").val(fal_fav_codigo);
    $("#fal_fav_descripcion").val(fal_fav_descripcion);
    $("#fal_fav_componente").val(fal_fav_componente);

    $("#fal_fav_bus_tipo").prop("disabled",false);
    $("#fal_fav_codigo").prop("disabled",false);
    $("#fal_fav_componente").prop("disabled",false);
    f_limpia_falla_via_falla_accion();

    $(".modal-header").css( "background-color", "#17a2b8");
    $(".modal-header").css( "color", "white" );
    $(".modal-title").text("Alta Modo de Falla y Accion de Falla en Vía");
    $('#modal_crud_falla_via_falla_accion').modal('show');	    
  });
  ///:: FIN EVENTO BOTON GENERAR FALLA EN VIA COMPONENTES FLOTA :::::::::::::::::::::::::::::///

  ///:: BOTON EDITAR FALLA EN VIA COMPONENTES :::::::::::::::::::::::::::::::::::::::::::::::///
  $(document).on("click", ".btn_editar_falla_via_falla_accion", function(){
    opcion_falla_via_falla_accion = "EDITAR";

    f_limpia_falla_via_falla_accion();
    fila_falla_via_falla_accion = $(this).closest("tr");  
    
    falla_via_falla_accion_id  = fila_falla_via_falla_accion.find('td:eq(0)').text();
    fal_fav_bus_tipo     = fila_falla_via_falla_accion.find('td:eq(1)').text();
    fal_fav_codigo       = fila_falla_via_falla_accion.find('td:eq(2)').text();
    fal_fav_descripcion  = fila_falla_via_falla_accion.find('td:eq(3)').text();
    fal_fav_componente   = fila_falla_via_falla_accion.find('td:eq(4)').text();
    fal_fav_falla        = fila_falla_via_falla_accion.find('td:eq(5)').text();
    fal_fav_accion       = fila_falla_via_falla_accion.find('td:eq(6)').text();
    f_select_combos_falla_accion_falla_via();
    $("#fal_fav_bus_tipo").prop("disabled",true);
    $("#fal_fav_codigo").prop("disabled",true);
    $("#fal_fav_componente").prop("disabled",true);

    $("#fal_fav_bus_tipo").val(fal_fav_bus_tipo);
    $("#fal_fav_codigo").val(fal_fav_codigo);
    $("#fal_fav_descripcion").val(fal_fav_descripcion);
    $("#fal_fav_componente").val(fal_fav_componente);
    $("#fal_fav_falla").val(fal_fav_falla);
    $("#fal_fav_accion").val(fal_fav_accion);

    $(".modal-header").css("background-color", "#007bff");
    $(".modal-header").css("color", "white" );
    $(".modal-title").text("Editar Mode de Falla y Accion de Falla en Vía");		

    $('#modal_crud_falla_via_falla_accion').modal('show');		   
  });
  ///:: FIN BOTON EDITAR FALLA EN VIA COMPONENTES :::::::::::::::::::::::::::::::::::::::::::///
  
  ///:: BOTON BORRAR REGISTRO FALLA EN VIA COMPONENTE :::::::::::::::::::::::::::::::::::::::///
  $(document).on("click", ".btn_borrar_falla_via_falla_accion", function(){
    fila_falla_via_falla_accion = $(this).closest('tr');           
    falla_via_falla_accion_id = fila_falla_via_falla_accion.find('td:eq(0)').text();     
    Swal.fire({
      title               : '¿Está seguro?',
      text                : "Se eliminará el registro Id "+falla_via_falla_accion_id+"!",
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
        Accion='borrar_falla_via_falla_accion';
        $.ajax({
        url         : "Ajax.php",
        type        : "POST",
        datatype    : "json",
        async       : false,    
        data        : { MoS:MoS, NombreMoS:NombreMoS, Accion:Accion, falla_via_falla_accion_id:falla_via_falla_accion_id },   
            success: function(data) {
              tabla_falla_via_falla_accion.ajax.reload(null, false);
            }
        });
      }
    });
  });
  ///:: FIN BOTON BORRAR REGISTRO FALLA EN VIA COMPONENTE :::::::::::::::::::::::::::::::::::///

  ///:: TERMINO BOTONES COMPONENTES DE FALLA EN VIA FLOTA :::::::::::::::::::::::::::::::::::///
});
///:: TERMINO JS DOM COMPONENTES DE FALLA EN VIA DE FLOTA :::::::::::::::::::::::::::::::::::///


///:: INICIO FUNCIONES FALLA EN VIA COMPONENTES :::::::::::::::::::::::::::::::::::::::::::::///

///:: VALIDA LOS CAMPOS DEL FORMULARIO ::::::::::::::::::::::::::::::::::::::::::::::::::::///
function f_validar_falla_via_falla_accion(p_fal_fav_bus_tipo, p_fal_fav_codigo, p_fal_fav_descripcion, p_fal_fav_componente, p_fal_fav_falla, p_fal_fav_accion){
  f_limpia_falla_via_falla_accion();
  let rpta_validar_falla_via_posicion = "";

  if(p_fal_fav_bus_tipo==""){
    $("#fal_fav_bus_tipo").addClass("color-error");
    rpta_validar_falla_via_posicion = "invalido";
  }
  if(p_fal_fav_codigo==""){
    $("#fal_fav_codigo").addClass("color-error");
    rpta_validar_falla_via_posicion = "invalido";
  }
  if(p_fal_fav_descripcion==""){
    $("#fal_fav_descripcion").addClass("color-error");
    rpta_validar_falla_via_posicion = "invalido";
  }
  if(p_fal_fav_componente==""){
    $("#fal_fav_componente").addClass("color-error");
    rpta_validar_falla_via_posicion = "invalido";
  }
  if(p_fal_fav_falla==""){
    $("#fal_fav_falla").addClass("color-error");
    rpta_validar_falla_via_posicion = "invalido";
  }
  if(p_fal_fav_accion==""){
    $("#fal_fav_accion").addClass("color-error");
    rpta_validar_falla_via_posicion = "invalido";
  }

  return rpta_validar_falla_via_posicion; 
}
///:: FIN VALIDA LOS CAMPOS DEL FORMULARIO ::::::::::::::::::::::::::::::::::::::::::::::::///

///:: RESTABLECE EL COLOR DE FONDO DE LOS CAMPOS DEL FORMULARIO :::::::::::::::::::::::::::///
function f_limpia_falla_via_falla_accion(){
  $("#fal_fav_bus_tipo").removeClass("color-error");
  $("#fal_fav_codigo").removeClass("color-error");
  $("#fal_fav_descripcion").removeClass("color-error");
  $("#fal_fav_componente").removeClass("color-error");
  $("#fal_fav_falla").removeClass("color-error");
  $("#fal_fav_accion").removeClass("color-error");
}
///:: RESTABLECE EL COLOR DE FONDO DE LOS CAMPOS DEL FORMULARIO :::::::::::::::::::::::::::///

///:: ESTABLECE EL COLOR DE LAS COLUMNAS DEL DATATABLE ::::::::::::::::::::::::::::::::::::///
function f_color_filas_falla_via_falla_accion(row,data){
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

function f_select_combos_falla_accion_falla_via(){
  select_fav_falla_accion = f_select_combo("manto_tc_check_list", "NO", "tc_categoria3", "",  "`tc_categoria1`='FALLA EN VIA' AND `tc_categoria2`='TIPO BUS'", "`tc_categoria3`");
  $("#fal_fav_bus_tipo").html(select_fav_falla_accion);
  select_fav_falla_accion = f_select_combo("manto_falla_via_codigo", "NO", "fav_codigo", "",  "`fav_bus_tipo`='"+fal_fav_bus_tipo+"'", "`fav_orden`");
  $("#fal_fav_codigo").html(select_fav_falla_accion);
  select_fav_falla_accion = f_select_combo("manto_falla_via_componente", "NO", "fav_componente", "",  "`fav_bus_tipo`='"+fal_fav_bus_tipo+"' AND `fav_codigo`='"+fal_fav_codigo+"'", "`fav_componente`");
  $("#fal_fav_componente").html(select_fav_falla_accion);
  select_fav_falla_accion = f_select_combo("manto_tc_check_list", "NO", "tc_categoria3", "",  "`tc_categoria1`='FALLA EN VIA' AND `tc_categoria2`='FALLA'", "`tc_categoria3`");
  $("#fal_fav_falla").html(select_fav_falla_accion);
  select_fav_falla_accion = f_select_combo("manto_tc_check_list", "NO", "tc_categoria3", "",  "`tc_categoria1`='FALLA EN VIA' AND `tc_categoria2`='ACCION'", "`tc_categoria3`");
  $("#fal_fav_accion").html(select_fav_falla_accion);
}

///:: TERMINO FUNCIONES FALLA EN VIA COMPONENTES ::::::::::::::::::::::::::::::::::::::::::::///