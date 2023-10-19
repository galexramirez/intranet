///::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
///:: CODIGOS DE CHECK LIST DE FLOTA v 1.0 FECHA: 2023-08-10 ::::::::::::::::::::::::::::::///
///:: CREAR EDITAR ELIMINAR CODIGOS DE CHECK LIST DE FLOTA ::::::::::::::::::::::::::::::::///
///::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///

///:: DECLARACION VARIABLES GLOBALES ::::::::::::::::::::::::::::::::::::::::::::::::::::::///
var tabla_check_list_codigo, opcion_check_list_codigo, cod_check_list_flota, fila_check_list_codigo;
var check_list_codigo_id, cod_chl_bus_tipo, cod_chl_orden, cod_chl_codigo, cod_chl_descripcion;

///:: INICIO JS DOM CODIGOS DE CHECK LIST DE FLOTA ::::::::::::::::::::::::::::::::::::::::///
$(document).ready(function(){
  let select_chl_codigo="";

  select_chl_codigo = f_select_combo("manto_tc_check_list", "NO", "tc_categoria3", "",  "`tc_categoria1`='CHECK LIST' AND `tc_categoria2`='TIPO BUS'", "`tc_categoria3`");
  $("#cod_check_list_flota").html(select_chl_codigo);

  div_boton = f_BotonesFormulario("form_seleccion_check_list_ajuste","btn_seleccion_check_list_ajuste");
  $("#div_btn_seleccion_check_list_ajuste").html(div_boton);

  div_boton = f_BotonesFormulario("form_seleccion_check_list_codigo","btn_seleccion_check_list_codigo");
  $("#div_btn_seleccion_check_list_codigo").html(div_boton);

  $("#cod_check_list_flota").on('change', function () {
    $("#div_tabla_check_list_codigo").empty();
    $("#div_tabla_check_list_componente").empty();
    $("#div_tabla_check_list_falla_accion").empty();
    $("#div_tabla_check_list_posicion").empty();
    cod_check_list_flota = $("#cod_check_list_flota").val();
    $("#com_check_list_flota").val(cod_check_list_flota);
    $("#fal_check_list_flota").val(cod_check_list_flota);
    $("#pos_check_list_flota").val(cod_check_list_flota);
    select_chl_codigo = f_select_codigo_check_list(cod_check_list_flota);
    $("#com_check_list_codigo").html(select_chl_codigo);
    $("#fal_check_list_codigo").html(select_chl_codigo);
    $("#pos_check_list_codigo").html(select_chl_codigo);
    $("#com_check_list_codigo").val("");
    $("#fal_check_list_codigo").val("");
    $("#fal_check_list_componente").val("");
    $("#pos_check_list_codigo").val("");
    $("#pos_check_list_componente").val("");

  });

  ///:: BOTONES CODIGO DE CHECK LIST FLOTA ::::::::::::::::::::::::::::::::::::::::::::::::///

  ///:: EVENTO BOTON BUSCAR CODIGO CHECK LIST FLOTA :::::::::::::::::::::::::::::::::::::::///       
  $(document).on("click", ".btn_buscar_check_list_codigo", function(){  
    cod_check_list_flota = $("#cod_check_list_flota").val();
    $("#com_check_list_flota").val(cod_check_list_flota);
    $("#fal_check_list_flota").val(cod_check_list_flota);
    $("#pos_check_list_flota").val(cod_check_list_flota);
    select_chl_codigo = f_select_codigo_check_list(cod_check_list_flota);
    $("#com_check_list_codigo").html(select_chl_codigo);
    $("#com_check_list_codigo").val("");
    $("#fal_check_list_codigo").val("");
    $("#fal_check_list_componente").val("");
    $("#pos_check_list_codigo").val("");
    $("#pos_check_list_componente").val("");

    $("#div_tabla_check_list_componente").empty();
    $("#div_tabla_check_list_falla_accion").empty();
    $("#div_tabla_check_list_posicion").empty();

    div_tabla = f_CreacionTabla("tabla_check_list_codigo","");
    $("#div_tabla_check_list_codigo").html(div_tabla);
    columnas_tabla = f_ColumnasTabla("tabla_check_list_codigo","")

    $("#tabla_check_list_codigo").dataTable().fnDestroy();
    $("#tabla_check_list_codigo").show();
  
    Accion='buscar_check_list_codigo';
    tabla_check_list_codigo = $('#tabla_check_list_codigo').DataTable({
      //Color a las filas
      "rowCallback":function(row,data,index)
      {
        f_color_filas_check_list_codigo(row,data);
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
          title     : 'CODIGOS DE CHECK LIST DE LA FLOTA '+cod_check_list_flota
        },
      ],
      "ajax"      : {            
        "url"     : "Ajax.php", 
        "method"  : 'POST',
        "data"    : {MoS:MoS, NombreMoS:NombreMoS, Accion:Accion, chl_bus_tipo:cod_check_list_flota},
        "dataSrc" : ""
      },
      "columns"   : columnas_tabla,
      "order"     : [[1, 'asc']]
    });
  });
  ///:: FIN BOTONES CODIGO DE CHECK LIST FLOTA ::::::::::::::::::::::::::::::::::::::::::::///

  ///:: CREA CHECK LIST CODIGO DE FLOTA :::::::::::::::::::::::::::::::::::::::::::::::::::///
  $('#form_check_list_codigo').submit(function(e){                         
    e.preventDefault(); 
    let valida_check_list_codigo = "";
    let existe_codigo = "";
    let msg_error = "";
    cod_chl_bus_tipo     = $.trim($('#cod_chl_bus_tipo').val());
    cod_chl_orden        = $.trim($('#cod_chl_orden').val());
    cod_chl_codigo       = $.trim($('#cod_chl_codigo').val());
    cod_chl_descripcion  = $.trim($('#cod_chl_descripcion').val());
    valida_check_list_codigo = f_validar_check_list_codigo(cod_chl_bus_tipo, cod_chl_orden, cod_chl_codigo, cod_chl_descripcion);
    
    if(valida_check_list_codigo=="invalido"){
      msg_error = "*Es posible que falte completar información.";
    }
    if(opcion_check_list_codigo=="CREAR"){
      existe_codigo = f_buscar_dato("manto_check_list_codigo","chl_codigo","`chl_bus_tipo`= '"+cod_chl_bus_tipo+"' AND `chl_codigo`='"+cod_chl_codigo+"'");
      if(existe_codigo!=""){
        msg_error += " *El Código de Check List ya se encuentra creado.";
        valida_check_list_codigo = "invalido";
      }  
    }

    if(valida_check_list_codigo=="invalido"){
        Swal.fire({
          icon: 'error',
          title: 'INFORMACION...',
          text: msg_error+' !!!'
        })
    }else{
      $("#btn_guardar_check_list_codigo").prop("disabled",true);
      if(opcion_check_list_codigo=="CREAR"){
        Accion='crear_check_list_codigo';
      }else{
        Accion='editar_check_list_codigo';
      }
      $.ajax({
        url       : "Ajax.php",
        type      : "POST",
        datatype  : "json",
        data      : { MoS:MoS, NombreMoS:NombreMoS, Accion:Accion, check_list_codigo_id:check_list_codigo_id, chl_bus_tipo:cod_chl_bus_tipo, chl_orden:cod_chl_orden, chl_codigo:cod_chl_codigo, chl_descripcion:cod_chl_descripcion },
        success: function(data) {
          tabla_check_list_codigo.ajax.reload(null, false);
          Swal.fire({
            icon  : 'success',
            title :  'El registro ha sido grabado con exito !!!.',
            showConfirmButton: false,
            timer : 1500  
          })
        }
      });
      $("#btn_guardar_check_list_codigo").prop("disabled",false);
      $('#modal_crud_check_list_codigo').modal('hide');
    }
  });
  ///:: FIN CREA CHECK LIST CODIGO DE FLOTA :::::::::::::::::::::::::::::::::::::::::::::::///

  ///:: EVENTO BOTON GENERAR CHECK LIST CODIGO FLOTA ::::::::::::::::::::::::::::::::::::::///
  $(document).on("click", ".btn_nuevo_check_list_codigo", function(){
    $("#form_check_list_codigo").trigger("reset"); 
    opcion_check_list_codigo = "CREAR";
    check_list_codigo_id = "";
    select_chl_codigo = f_select_combo("manto_tc_check_list", "NO", "tc_categoria3", "", "`tc_categoria1`='CHECK LIST' AND `tc_categoria2`='TIPO BUS'", "`tc_categoria3`");
    $("#cod_chl_bus_tipo").html(select_chl_codigo);
    cod_chl_bus_tipo = $("#cod_check_list_flota").val();
    $("#cod_chl_bus_tipo").val(cod_chl_bus_tipo);

    $("#cod_chl_bus_tipo").prop("disabled",false);
    $("#cod_chl_codigo").prop("disabled",false);
    f_limpia_check_list_codigo();
    
    $(".modal-header").css( "background-color", "#17a2b8");
    $(".modal-header").css( "color", "white" );
    $(".modal-title").text("Alta Códigos de Check List");
    $('#modal_crud_check_list_codigo ').modal('show');	    
  });
  ///:: FIN EVENTO BOTON GENERAR CHECK LIST CODIGO FLOTA ::::::::::::::::::::::::::::::::::///

  ///:: BOTON EDITAR CHECK LIST CODIGO ::::::::::::::::::::::::::::::::::::::::::::::::::::///
  $(document).on("click", ".btn_editar_check_list_codigo", function(){
    opcion_check_list_codigo = "EDITAR";
    select_chl_codigo = f_select_combo("manto_tc_check_list", "NO", "tc_categoria3", "",  "`tc_categoria1`='CHECK LIST' AND `tc_categoria2`='TIPO BUS'", "`tc_categoria3`");
    $("#cod_chl_bus_tipo").html(select_chl_codigo);
  
    f_limpia_check_list_codigo();
    fila_check_list_codigo = $(this).closest("tr");  
    
    check_list_codigo_id  = fila_check_list_codigo.find('td:eq(0)').text();
    cod_chl_orden        = fila_check_list_codigo.find('td:eq(1)').text();
    cod_chl_bus_tipo     = fila_check_list_codigo.find('td:eq(2)').text();
    cod_chl_codigo       = fila_check_list_codigo.find('td:eq(3)').text();
    cod_chl_descripcion  = fila_check_list_codigo.find('td:eq(4)').text();

    $("#cod_chl_bus_tipo").prop("disabled",true);
    $("#cod_chl_codigo").prop("disabled",true);

    $("#cod_chl_orden").val(cod_chl_orden);
    $("#cod_chl_bus_tipo").val(cod_chl_bus_tipo);
    $("#cod_chl_codigo").val(cod_chl_codigo);
    $("#cod_chl_descripcion").val(cod_chl_descripcion);

    $(".modal-header").css("background-color", "#007bff");
    $(".modal-header").css("color", "white" );
    $(".modal-title").text("Editar Código de Check List");		

    $('#modal_crud_check_list_codigo').modal('show');		   
  });
  ///:: FIN BOTON EDITAR CHECK LIST CODIGO ::::::::::::::::::::::::::::::::::::::::::::::::///
  
  ///:: BOTON BORRAR REGISTRO CHECK LIST CODIGO :::::::::::::::::::::::::::::::::::::::::::///
  $(document).on("click", ".btn_borrar_check_list_codigo", function(){
    fila_check_list_codigo = $(this).closest('tr');           
    chl_bus_tipo = fila_check_list_codigo.find('td:eq(2)').text();
    chl_codigo = fila_check_list_codigo.find('td:eq(3)').text();     
    Swal.fire({
      title               : '¿Está seguro?',
      text                : "Se eliminará el código "+chl_codigo+"! incluido componentes, fallas, acciones y posiciones",
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
        Accion='borrar_check_list_codigo';
        $.ajax({
        url         : "Ajax.php",
        type        : "POST",
        datatype    : "json",
        async       : false,    
        data        : { MoS:MoS, NombreMoS:NombreMoS, Accion:Accion, chl_bus_tipo:chl_bus_tipo, chl_codigo:chl_codigo },   
            success: function(data) {
              tabla_check_list_codigo.ajax.reload(null, false);
            }
        });
      }
    });
  });
  ///:: FIN BOTON BORRAR REGISTRO CHECK LIST CODIGO :::::::::::::::::::::::::::::::::::::::///

    ///:: BOTON DESCARGAR ARBOL CHECK LIST CODIGO :::::::::::::::::::::::::::::::::::::::::///
    $(document).on("click", ".btn_descargar_arbol", function(){
      chl_bus_tipo = $("#cod_check_list_flota").val();
      Accion='descargar_arbol';
      $.ajax({
      url         : "Ajax.php",
      type        : "POST",
      datatype    : "json",
      async       : false,    
      data        : { MoS:MoS, NombreMoS:NombreMoS, Accion:Accion, chl_bus_tipo:chl_bus_tipo },   
      beforeSend: function(){
        Swal.fire({
          icon: 'success',
          title: 'Procesando Información',
          showConfirmButton: false,
          timer: 5000
        })
      },
      success: function(data){
        window.location.href = mi_carpeta + "Module/check_list/Controller/csv_descarga_arbol_check_list.php?archivo=" + data;
      }
      });
    });
    ///:: FIN BOTON BORRAR REGISTRO CHECK LIST CODIGO :::::::::::::::::::::::::::::::::::::::///
  
  ///:: TERMINO BOTONES CODIGO DE CHECK LIST FLOTA ::::::::::::::::::::::::::::::::::::::::///
});
///:: TERMINO JS DOM CODIGOS DE CHECK LIST DE FLOTA :::::::::::::::::::::::::::::::::::::::///


///:: INICIO FUNCIONES CHECK LIST CODIGO ::::::::::::::::::::::::::::::::::::::::::::::::::///

///:: VALIDA LOS CAMPOS DEL FORMULARIO ::::::::::::::::::::::::::::::::::::::::::::::::::::///
function f_validar_check_list_codigo(p_cod_chl_bus_tipo, p_cod_chl_orden, p_cod_chl_codigo, p_cod_chl_descripcion){
  f_limpia_check_list_codigo();
  let rpta_validar_check_list_codigo = "";

  if(p_cod_chl_bus_tipo==""){
    $("#cod_chl_bus_tipo").addClass("color-error");
    rpta_validar_check_list_codigo = "invalido";
  }
  if(p_cod_chl_orden==""){
    $("#cod_chl_orden").addClass("color-error");
    rpta_validar_check_list_codigo = "invalido";
  }
  if(p_cod_chl_codigo==""){
    $("#cod_chl_codigo").addClass("color-error");
    rpta_validar_check_list_codigo = "invalido";
  }
  if(p_cod_chl_descripcion==""){
    $("#cod_chl_descripcion").addClass("color-error");
    rpta_validar_check_list_codigo = "invalido";
  }

  return rpta_validar_check_list_codigo; 
}
///:: FIN VALIDA LOS CAMPOS DEL FORMULARIO ::::::::::::::::::::::::::::::::::::::::::::::::///

///:: RESTABLECE EL COLOR DE FONDO DE LOS CAMPOS DEL FORMULARIO :::::::::::::::::::::::::::///
function f_limpia_check_list_codigo(){
  $("#cod_chl_bus_tipo").removeClass("color-error");
  $("#cod_chl_orden").removeClass("color-error");
  $("#cod_chl_codigo").removeClass("color-error");
  $("#cod_chl_descripcion").removeClass("color-error");
}
///:: RESTABLECE EL COLOR DE FONDO DE LOS CAMPOS DEL FORMULARIO :::::::::::::::::::::::::::///

///:: ESTABLECE EL COLOR DE LAS COLUMNAS DEL DATATABLE ::::::::::::::::::::::::::::::::::::///
function f_color_filas_check_list_codigo(row,data){
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

///:: TERMINO FUNCIONES CHECK LIST CODIGO :::::::::::::::::::::::::::::::::::::::::::::::::///