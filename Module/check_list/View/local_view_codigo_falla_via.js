///::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
///:: CODIGOS DE FALLA EN VIA v 1.0 FECHA: 2023-08-10 :::::::::::::::::::::::::::::::::::::///
///:: CREAR EDITAR ELIMINAR CODIGOS DE FALLA EN VIA :::::::::::::::::::::::::::::::::::::::///
///::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///

///:: DECLARACION VARIABLES GLOBALES ::::::::::::::::::::::::::::::::::::::::::::::::::::::///
var tabla_falla_via_codigo, opcion_falla_via_codigo, cod_falla_via_flota, fila_falla_via_codigo;
var falla_via_codigo_id, cod_fav_bus_tipo, cod_fav_orden, cod_fav_codigo, cod_fav_descripcion;

///:: INICIO JS DOM CODIGOS DE FALLA EN VIA :::::::::::::::::::::::::::::::::::::::::::::::///
$(document).ready(function(){
  let select_falla_via_codigo="";

  select_falla_via_codigo = f_select_combo("manto_tc_check_list", "NO", "tc_categoria3", "",  "`tc_categoria1`='FALLA EN VIA' AND `tc_categoria2`='TIPO BUS'", "`tc_categoria3`");
  $("#cod_falla_via_flota").html(select_falla_via_codigo);

  div_boton = f_BotonesFormulario("form_seleccion_falla_via_ajuste","btn_seleccion_falla_via_ajuste");
  $("#div_btn_seleccion_falla_via_ajuste").html(div_boton);

  div_boton = f_BotonesFormulario("form_seleccion_falla_via_codigo","btn_seleccion_falla_via_codigo");
  $("#div_btn_seleccion_falla_via_codigo").html(div_boton);

  $("#cod_falla_via_flota").on('change', function () {
    $("#div_tabla_falla_via_codigo").empty();
    $("#div_tabla_falla_via_componente").empty();
    $("#div_tabla_falla_via_falla_accion").empty();
    $("#div_tabla_falla_via_posicion").empty();
    cod_falla_via_flota = $("#cod_falla_via_flota").val();
    $("#com_falla_via_flota").val(cod_falla_via_flota);
    $("#fal_falla_via_flota").val(cod_falla_via_flota);
    $("#pos_falla_via_flota").val(cod_falla_via_flota);
    select_falla_via_codigo = f_select_codigo_check_list(cod_falla_via_flota);
    $("#com_falla_via_codigo").html(select_falla_via_codigo);
    $("#fal_falla_via_codigo").html(select_falla_via_codigo);
    $("#pos_falla_via_codigo").html(select_falla_via_codigo);
    $("#com_falla_via_codigo").val("");
    $("#fal_falla_via_codigo").val("");
    $("#fal_falla_via_componente").val("");
    $("#pos_falla_via_codigo").val("");
    $("#pos_falla_via_componente").val("");

  });

  ///:: BOTONES CODIGO DE FALLA EN VIA :::::::::::::::::::::::::::::::::::::::::::::::::::::///

  ///:: EVENTO BOTON BUSCAR CODIGO FALLA EN VIA ::::::::::::::::::::::::::::::::::::::::::::///       
  $(document).on("click", ".btn_buscar_falla_via_codigo", function(){  
    cod_falla_via_flota = $("#cod_falla_via_flota").val();
    $("#com_falla_via_flota").val(cod_falla_via_flota);
    $("#fal_falla_via_flota").val(cod_falla_via_flota);
    $("#pos_falla_via_flota").val(cod_falla_via_flota);
    select_falla_via_codigo = f_select_codigo_check_list(cod_falla_via_flota);
    $("#com_falla_via_codigo").html(select_falla_via_codigo);
    $("#com_falla_via_codigo").val("");
    $("#fal_falla_via_codigo").val("");
    $("#fal_falla_via_componente").val("");
    $("#pos_falla_via_codigo").val("");
    $("#pos_falla_via_componente").val("");

    $("#div_tabla_falla_via_componente").empty();
    $("#div_tabla_falla_via_falla_accion").empty();
    $("#div_tabla_falla_via_posicion").empty();

    div_tabla = f_CreacionTabla("tabla_falla_via_codigo","");
    $("#div_tabla_falla_via_codigo").html(div_tabla);
    columnas_tabla = f_ColumnasTabla("tabla_falla_via_codigo","")

    $("#tabla_falla_via_codigo").dataTable().fnDestroy();
    $("#tabla_falla_via_codigo").show();
  
    Accion='buscar_falla_via_codigo';
    tabla_falla_via_codigo = $('#tabla_falla_via_codigo').DataTable({
      //Color a las filas
      "rowCallback":function(row,data,index)
      {
        f_color_filas_falla_via_codigo(row,data);
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
          title     : 'CODIGOS DE FALLA EN VIA '+cod_falla_via_flota
        },
      ],
      "ajax"      : {            
        "url"     : "Ajax.php", 
        "method"  : 'POST',
        "data"    : {MoS:MoS, NombreMoS:NombreMoS, Accion:Accion, fav_bus_tipo:cod_falla_via_flota},
        "dataSrc" : ""
      },
      "columns"   : columnas_tabla,
      "order"     : [[1, 'asc']]
    });
  });
  ///:: FIN BOTONES CODIGO DE FALLA EN VIA :::::::::::::::::::::::::::::::::::::::::::::::::///

  ///:: CREA FALLA EN VIA CODIGO DE ::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
  $('#form_falla_via_codigo').submit(function(e){                         
    e.preventDefault(); 
    let valida_falla_via_codigo = "";
    let existe_codigo = "";
    let msg_error = "";
    cod_fav_bus_tipo     = $.trim($('#cod_fav_bus_tipo').val());
    cod_fav_orden        = $.trim($('#cod_fav_orden').val());
    cod_fav_codigo       = $.trim($('#cod_fav_codigo').val());
    cod_fav_descripcion  = $.trim($('#cod_fav_descripcion').val());
    valida_falla_via_codigo = f_validar_falla_via_codigo(cod_fav_bus_tipo, cod_fav_orden, cod_fav_codigo, cod_fav_descripcion);
    
    if(valida_falla_via_codigo=="invalido"){
      msg_error = "*Es posible que falte completar información.";
    }
    if(opcion_falla_via_codigo=="CREAR"){
      existe_codigo = f_buscar_dato("manto_falla_via_codigo","fav_codigo","`fav_bus_tipo`= '"+cod_fav_bus_tipo+"' AND `fav_codigo`='"+cod_fav_codigo+"'");
      if(existe_codigo!=""){
        msg_error += " *El Código de Falla en Vía ya se encuentra creado.";
        valida_falla_via_codigo = "invalido";
      }  
    }

    if(valida_falla_via_codigo=="invalido"){
        Swal.fire({
          icon: 'error',
          title: 'INFORMACION...',
          text: msg_error+' !!!'
        })
    }else{
      $("#btn_guardar_falla_via_codigo").prop("disabled",true);
      if(opcion_falla_via_codigo=="CREAR"){
        Accion='crear_falla_via_codigo';
      }else{
        Accion='editar_falla_via_codigo';
      }
      $.ajax({
        url       : "Ajax.php",
        type      : "POST",
        datatype  : "json",
        data      : { MoS:MoS, NombreMoS:NombreMoS, Accion:Accion, falla_via_codigo_id:falla_via_codigo_id, fav_bus_tipo:cod_fav_bus_tipo, fav_orden:cod_fav_orden, fav_codigo:cod_fav_codigo, fav_descripcion:cod_fav_descripcion },
        success: function(data) {
          tabla_falla_via_codigo.ajax.reload(null, false);
          Swal.fire({
            icon  : 'success',
            title :  'El registro ha sido grabado con exito !!!.',
            showConfirmButton: false,
            timer : 1500  
          })
        }
      });
      $("#btn_guardar_falla_via_codigo").prop("disabled",false);
      $('#modal_crud_falla_via_codigo').modal('hide');
    }
  });
  ///:: FIN CREA FALLA EN VIA CODIGO DE ::::::::::::::::::::::::::::::::::::::::::::::::::::///

  ///:: EVENTO BOTON GENERAR FALLA EN VIA CODIGO :::::::::::::::::::::::::::::::::::::::::::///
  $(document).on("click", ".btn_nuevo_falla_via_codigo", function(){
    $("#form_falla_via_codigo").trigger("reset"); 
    opcion_falla_via_codigo = "CREAR";
    falla_via_codigo_id = "";
    select_falla_via_codigo = f_select_combo("manto_tc_check_list", "NO", "tc_categoria3", "", "`tc_categoria1`='FALLA EN VIA' AND `tc_categoria2`='TIPO BUS'", "`tc_categoria3`");
    $("#cod_fav_bus_tipo").html(select_falla_via_codigo);
    cod_fav_bus_tipo = $("#cod_falla_via_flota").val();
    $("#cod_fav_bus_tipo").val(cod_fav_bus_tipo);

    $("#cod_fav_bus_tipo").prop("disabled",false);
    $("#cod_fav_codigo").prop("disabled",false);
    f_limpia_falla_via_codigo();
    
    $(".modal-header").css( "background-color", "#17a2b8");
    $(".modal-header").css( "color", "white" );
    $(".modal-title").text("Alta Códigos de Falla en Vía");
    $('#modal_crud_falla_via_codigo ').modal('show');	    
  });
  ///:: FIN EVENTO BOTON GENERAR FALLA EN VIA CODIGO :::::::::::::::::::::::::::::::::::::::///

  ///:: BOTON EDITAR FALLA EN VIA CODIGO ::::::::::::::::::::::::::::::::::::::::::::::::::::///
  $(document).on("click", ".btn_editar_falla_via_codigo", function(){
    opcion_falla_via_codigo = "EDITAR";
    select_falla_via_codigo = f_select_combo("manto_tc_check_list", "NO", "tc_categoria3", "",  "`tc_categoria1`='FALLA EN VIA' AND `tc_categoria2`='TIPO BUS'", "`tc_categoria3`");
    $("#cod_fav_bus_tipo").html(select_falla_via_codigo);
  
    f_limpia_falla_via_codigo();
    fila_falla_via_codigo = $(this).closest("tr");  
    
    falla_via_codigo_id  = fila_falla_via_codigo.find('td:eq(0)').text();
    cod_fav_orden        = fila_falla_via_codigo.find('td:eq(1)').text();
    cod_fav_bus_tipo     = fila_falla_via_codigo.find('td:eq(2)').text();
    cod_fav_codigo       = fila_falla_via_codigo.find('td:eq(3)').text();
    cod_fav_descripcion  = fila_falla_via_codigo.find('td:eq(4)').text();

    $("#cod_fav_bus_tipo").prop("disabled",true);
    $("#cod_fav_codigo").prop("disabled",true);

    $("#cod_fav_orden").val(cod_fav_orden);
    $("#cod_fav_bus_tipo").val(cod_fav_bus_tipo);
    $("#cod_fav_codigo").val(cod_fav_codigo);
    $("#cod_fav_descripcion").val(cod_fav_descripcion);

    $(".modal-header").css("background-color", "#007bff");
    $(".modal-header").css("color", "white" );
    $(".modal-title").text("Editar Código de Falla en Vía");		

    $('#modal_crud_falla_via_codigo').modal('show');		   
  });
  ///:: FIN BOTON EDITAR FALLA EN VIA CODIGO ::::::::::::::::::::::::::::::::::::::::::::::::///
  
  ///:: BOTON BORRAR REGISTRO FALLA EN VIA CODIGO :::::::::::::::::::::::::::::::::::::::::::///
  $(document).on("click", ".btn_borrar_falla_via_codigo", function(){
    fila_falla_via_codigo = $(this).closest('tr');           
    fav_bus_tipo = fila_falla_via_codigo.find('td:eq(2)').text();
    falla_via_codigo = fila_falla_via_codigo.find('td:eq(3)').text();     
    Swal.fire({
      title               : '¿Está seguro?',
      text                : "Se eliminará el código "+falla_via_codigo+"! incluido componentes, fallas, acciones y posiciones",
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
        Accion='borrar_falla_via_codigo';
        $.ajax({
        url         : "Ajax.php",
        type        : "POST",
        datatype    : "json",
        async       : false,    
        data        : { MoS:MoS, NombreMoS:NombreMoS, Accion:Accion, fav_bus_tipo:fav_bus_tipo, falla_via_codigo:falla_via_codigo },   
            success: function(data) {
              tabla_falla_via_codigo.ajax.reload(null, false);
            }
        });
      }
    });
  });
  ///:: FIN BOTON BORRAR REGISTRO FALLA EN VIA CODIGO :::::::::::::::::::::::::::::::::::::::///

    ///:: BOTON DESCARGAR ARBOL FALLA EN VIA CODIGO :::::::::::::::::::::::::::::::::::::::::///
    $(document).on("click", ".btn_descargar_arbol_falla_via", function(){
      fav_bus_tipo = $("#cod_falla_via_flota").val();
      Accion='descargar_arbol_falla_via';
      $.ajax({
      url         : "Ajax.php",
      type        : "POST",
      datatype    : "json",
      async       : false,    
      data        : { MoS:MoS, NombreMoS:NombreMoS, Accion:Accion, fav_bus_tipo:fav_bus_tipo },   
      beforeSend: function(){
        Swal.fire({
          icon: 'success',
          title: 'Procesando Información',
          showConfirmButton: false,
          timer: 5000
        })
      },
      success: function(data){
        window.location.href = mi_carpeta + "Module/check_list/Controller/csv_descarga_arbol_falla_via.php?archivo=" + data;
      }
      });
    });
    ///:: FIN BOTON BORRAR REGISTRO FALLA EN VIA CODIGO :::::::::::::::::::::::::::::::::::::::///
  
  ///:: TERMINO BOTONES CODIGO DE FALLA EN VIA :::::::::::::::::::::::::::::::::::::::::::::///
});
///:: TERMINO JS DOM CODIGOS DE FALLA EN VIA DE ::::::::::::::::::::::::::::::::::::::::::::///


///:: INICIO FUNCIONES FALLA EN VIA CODIGO ::::::::::::::::::::::::::::::::::::::::::::::::::///

///:: VALIDA LOS CAMPOS DEL FORMULARIO ::::::::::::::::::::::::::::::::::::::::::::::::::::///
function f_validar_falla_via_codigo(p_cod_fav_bus_tipo, p_cod_fav_orden, p_cod_fav_codigo, p_cod_fav_descripcion){
  f_limpia_falla_via_codigo();
  let rpta_validar_falla_via_codigo = "";

  if(p_cod_fav_bus_tipo==""){
    $("#cod_fav_bus_tipo").addClass("color-error");
    rpta_validar_falla_via_codigo = "invalido";
  }
  if(p_cod_fav_orden==""){
    $("#cod_fav_orden").addClass("color-error");
    rpta_validar_falla_via_codigo = "invalido";
  }
  if(p_cod_fav_codigo==""){
    $("#cod_fav_codigo").addClass("color-error");
    rpta_validar_falla_via_codigo = "invalido";
  }
  if(p_cod_fav_descripcion==""){
    $("#cod_fav_descripcion").addClass("color-error");
    rpta_validar_falla_via_codigo = "invalido";
  }

  return rpta_validar_falla_via_codigo; 
}
///:: FIN VALIDA LOS CAMPOS DEL FORMULARIO ::::::::::::::::::::::::::::::::::::::::::::::::///

///:: RESTABLECE EL COLOR DE FONDO DE LOS CAMPOS DEL FORMULARIO :::::::::::::::::::::::::::///
function f_limpia_falla_via_codigo(){
  $("#cod_fav_bus_tipo").removeClass("color-error");
  $("#cod_fav_orden").removeClass("color-error");
  $("#cod_fav_codigo").removeClass("color-error");
  $("#cod_fav_descripcion").removeClass("color-error");
}
///:: RESTABLECE EL COLOR DE FONDO DE LOS CAMPOS DEL FORMULARIO :::::::::::::::::::::::::::///

///:: ESTABLECE EL COLOR DE LAS COLUMNAS DEL DATATABLE ::::::::::::::::::::::::::::::::::::///
function f_color_filas_falla_via_codigo(row,data){
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

///:: TERMINO FUNCIONES FALLA EN VIA ::::::::::::::::::::::::::::::::::::::::::::::::::::::///