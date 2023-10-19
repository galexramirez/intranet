///::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
///:: CODIGOS DE INSPECCION DE FLOTA v 1.0 FECHA: 2023-08-10 ::::::::::::::::::::::::::::::///
///:: CREAR EDITAR ELIMINAR CODIGOS DE INSPECCION DE FLOTA ::::::::::::::::::::::::::::::::///
///::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///

///:: DECLARACION VARIABLES GLOBALES ::::::::::::::::::::::::::::::::::::::::::::::::::::::///
var tabla_inspeccion_codigo, opcion_inspeccion_codigo, cod_inspeccion_tipo, cod_inspeccion_flota, fila_inspeccion_codigo;
var inspeccion_codigo_id, cod_insp_bus_tipo, cod_insp_orden, cod_insp_codigo, cod_insp_descripcion;

///:: INICIO JS DOM CODIGOS DE INSPECCION DE FLOTA ::::::::::::::::::::::::::::::::::::::::///
$(document).ready(function(){
  let select_insp_codigo="";

  select_insp_codigo = f_select_combo("manto_tc_inspeccion", "NO", "tc_categoria2", "",  "`tc_ficha`='INSPECCION' AND `tc_categoria1`='TIPO BUS'", "`tc_categoria2`");
  $("#cod_inspeccion_flota").html(select_insp_codigo);

  div_boton = f_BotonesFormulario("form_seleccion_inspeccion_ajuste","btn_seleccion_inspeccion_ajuste");
  $("#div_btn_seleccion_inspeccion_ajuste").html(div_boton);

  div_boton = f_BotonesFormulario("form_seleccion_inspeccion_codigo","btn_seleccion_inspeccion_codigo");
  $("#div_btn_seleccion_inspeccion_codigo").html(div_boton);

  $("#cod_inspeccion_tipo, #cod_inspeccion_flota").on('change', function () {
    $("#div_tabla_inspeccion_codigo").empty();
    $("#div_tabla_inspeccion_componente").empty();
    $("#div_tabla_inspeccion_falla_accion").empty();
    $("#div_tabla_inspeccion_posicion").empty();
    cod_inspeccion_flota = $("#cod_inspeccion_flota").val();
    $("#com_inspeccion_flota").val(cod_inspeccion_flota);
    $("#fal_inspeccion_flota").val(cod_inspeccion_flota);
    $("#pos_inspeccion_flota").val(cod_inspeccion_flota);
    select_insp_codigo = f_select_codigo_inspeccion(cod_inspeccion_flota);
    $("#com_inspeccion_codigo").html(select_insp_codigo);
    $("#fal_inspeccion_codigo").html(select_insp_codigo);
    $("#pos_inspeccion_codigo").html(select_insp_codigo);
    $("#com_inspeccion_codigo").val("");
    $("#fal_inspeccion_codigo").val("");
    $("#fal_inspeccion_componente").val("");
    $("#pos_inspeccion_codigo").val("");
    $("#pos_inspeccion_componente").val("");

  });

  ///:: BOTONES CODIGO DE INSPECCION FLOTA ::::::::::::::::::::::::::::::::::::::::::::::::///

  ///:: EVENTO BOTON BUSCAR CODIGO INSPECCION FLOTA :::::::::::::::::::::::::::::::::::::::///       
  $(document).on("click", ".btn_buscar_inspeccion_codigo", function(){  
    cod_inspeccion_flota = $("#cod_inspeccion_flota").val();
    $("#com_inspeccion_flota").val(cod_inspeccion_flota);
    $("#fal_inspeccion_flota").val(cod_inspeccion_flota);
    $("#pos_inspeccion_flota").val(cod_inspeccion_flota);
    select_insp_codigo = f_select_codigo_inspeccion(cod_inspeccion_flota);
    $("#com_inspeccion_codigo").html(select_insp_codigo);
    $("#com_inspeccion_codigo").val("");
    $("#fal_inspeccion_codigo").val("");
    $("#fal_inspeccion_componente").val("");
    $("#pos_inspeccion_codigo").val("");
    $("#pos_inspeccion_componente").val("");

    $("#div_tabla_inspeccion_componente").empty();
    $("#div_tabla_inspeccion_falla_accion").empty();
    $("#div_tabla_inspeccion_posicion").empty();

    div_tabla = f_CreacionTabla("tabla_inspeccion_codigo","");
    $("#div_tabla_inspeccion_codigo").html(div_tabla);
    columnas_tabla = f_ColumnasTabla("tabla_inspeccion_codigo","")

    $("#tabla_inspeccion_codigo").dataTable().fnDestroy();
    $("#tabla_inspeccion_codigo").show();
  
    Accion='buscar_inspeccion_codigo';
    tabla_inspeccion_codigo = $('#tabla_inspeccion_codigo').DataTable({
      //Color a las filas
      "rowCallback":function(row,data,index)
      {
        f_color_filas_inspeccion_codigo(row,data);
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
          title     : 'CODIGOS DE INSPECCION DE LA FLOTA '+cod_inspeccion_flota
        },
      ],
      "ajax"      : {            
        "url"     : "Ajax.php", 
        "method"  : 'POST',
        "data"    : {MoS:MoS, NombreMoS:NombreMoS, Accion:Accion, insp_bus_tipo:cod_inspeccion_flota},
        "dataSrc" : ""
      },
      "columns"   : columnas_tabla,
      "order"     : [[1, 'asc']]
    });
  });
  ///:: FIN BOTONES CODIGO DE INSPECCION FLOTA ::::::::::::::::::::::::::::::::::::::::::::///

  ///:: CREA INSPECCION CODIGO DE FLOTA :::::::::::::::::::::::::::::::::::::::::::::::::::///
  $('#form_inspeccion_codigo').submit(function(e){                         
    e.preventDefault(); 
    let valida_inspeccion_codigo = "";
    let existe_codigo = "";
    let msg_error = "";
    cod_insp_bus_tipo     = $.trim($('#cod_insp_bus_tipo').val());
    cod_insp_orden        = $.trim($('#cod_insp_orden').val());
    cod_insp_codigo       = $.trim($('#cod_insp_codigo').val());
    cod_insp_descripcion  = $.trim($('#cod_insp_descripcion').val());
    valida_inspeccion_codigo = f_validar_inspeccion_codigo(cod_insp_bus_tipo, cod_insp_orden, cod_insp_codigo, cod_insp_descripcion);
    
    if(valida_inspeccion_codigo=="invalido"){
      msg_error = "*Es posible que falte completar información.";
    }
    if(opcion_inspeccion_codigo=="CREAR"){
      existe_codigo = f_buscar_dato("manto_inspeccion_codigo","insp_codigo","`insp_bus_tipo`= '"+cod_insp_bus_tipo+"' AND `insp_codigo`='"+cod_insp_codigo+"'");
      if(existe_codigo!=""){
        msg_error += " *El Código de Inspección ya se encuentra creado.";
        valida_inspeccion_codigo = "invalido";
      }  
    }

    if(valida_inspeccion_codigo=="invalido"){
        Swal.fire({
          icon: 'error',
          title: 'INFORMACION...',
          text: msg_error+' !!!'
        })
    }else{
      $("#btn_cuardar_inspeccion_codigo").prop("disabled",true);
      if(opcion_inspeccion_codigo=="CREAR"){
        Accion='crear_inspeccion_codigo';
      }else{
        Accion='editar_inspeccion_codigo';
      }
      $.ajax({
        url       : "Ajax.php",
        type      : "POST",
        datatype  : "json",
        data      : { MoS:MoS, NombreMoS:NombreMoS, Accion:Accion, inspeccion_codigo_id:inspeccion_codigo_id, insp_bus_tipo:cod_insp_bus_tipo, insp_orden:cod_insp_orden, insp_codigo:cod_insp_codigo, insp_descripcion:cod_insp_descripcion },
        success: function(data) {
          tabla_inspeccion_codigo.ajax.reload(null, false);
          Swal.fire({
            icon  : 'success',
            title : 'El registro ha sido grabado con exito !!!.',
            showConfirmButton: false,
            timer : 1500  
          })
        }
      });
      $("#btn_cuardar_inspeccion_codigo").prop("disabled",false);
      $('#modal_crud_inspeccion_codigo').modal('hide');
    }
  });
  ///:: FIN CREA INSPECCION CODIGO DE FLOTA :::::::::::::::::::::::::::::::::::::::::::::::///

  ///:: EVENTO BOTON GENERAR INSPECCION CODIGO FLOTA ::::::::::::::::::::::::::::::::::::::///
  $(document).on("click", ".btn_nuevo_inspeccion_codigo", function(){
    $("#form_inspeccion_codigo").trigger("reset"); 
    opcion_inspeccion_codigo = "CREAR";
    inspeccion_codigo_id = "";
    select_insp_codigo = f_select_combo("manto_tc_inspeccion", "NO", "tc_categoria2", "", "`tc_ficha`='INSPECCION' AND `tc_categoria1`='TIPO BUS'", "`tc_categoria2`");
    $("#cod_insp_bus_tipo").html(select_insp_codigo);
    cod_insp_bus_tipo = $("#cod_inspeccion_flota").val();
    $("#cod_insp_bus_tipo").val(cod_insp_bus_tipo);

    $("#cod_insp_bus_tipo").prop("disabled",false);
    $("#cod_insp_codigo").prop("disabled",false);
    f_limpia_inspeccion_codigo();
    
    $(".modal-header").css( "background-color", "#17a2b8");
    $(".modal-header").css( "color", "white" );
    $(".modal-title").text("Alta Códigos de Inspección");
    $('#modal_crud_inspeccion_codigo ').modal('show');	    
  });
  ///:: FIN EVENTO BOTON GENERAR INSPECCION CODIGO FLOTA ::::::::::::::::::::::::::::::::::///

  ///:: BOTON EDITAR INSPECCION CODIGO ::::::::::::::::::::::::::::::::::::::::::::::::::::///
  $(document).on("click", ".btn_editar_inspeccion_codigo", function(){
    opcion_inspeccion_codigo = "EDITAR";
    select_insp_codigo = f_select_combo("manto_tc_inspeccion", "NO", "tc_categoria2", "",  "`tc_ficha`='INSPECCION' AND `tc_categoria1`='TIPO BUS'", "`tc_categoria2`");
    $("#cod_insp_bus_tipo").html(select_insp_codigo);
  
    f_limpia_inspeccion_codigo();
    fila_inspeccion_codigo = $(this).closest("tr");  
    
    inspeccion_codigo_id  = fila_inspeccion_codigo.find('td:eq(0)').text();
    cod_insp_orden        = fila_inspeccion_codigo.find('td:eq(1)').text();
    cod_insp_bus_tipo     = fila_inspeccion_codigo.find('td:eq(2)').text();
    cod_insp_codigo       = fila_inspeccion_codigo.find('td:eq(3)').text();
    cod_insp_descripcion  = fila_inspeccion_codigo.find('td:eq(4)').text();

    $("#cod_insp_bus_tipo").prop("disabled",true);
    $("#cod_insp_codigo").prop("disabled",true);

    $("#cod_insp_orden").val(cod_insp_orden);
    $("#cod_insp_bus_tipo").val(cod_insp_bus_tipo);
    $("#cod_insp_codigo").val(cod_insp_codigo);
    $("#cod_insp_descripcion").val(cod_insp_descripcion);

    $(".modal-header").css("background-color", "#007bff");
    $(".modal-header").css("color", "white" );
    $(".modal-title").text("Editar Código de Inspección");		

    $('#modal_crud_inspeccion_codigo').modal('show');		   
  });
  ///:: FIN BOTON EDITAR INSPECCION CODIGO ::::::::::::::::::::::::::::::::::::::::::::::::///
  
  ///:: BOTON BORRAR REGISTRO INSPECCION CODIGO :::::::::::::::::::::::::::::::::::::::::::///
  $(document).on("click", ".btn_borrar_inspeccion_codigo", function(){
    fila_inspeccion_codigo = $(this).closest('tr');           
    insp_bus_tipo = fila_inspeccion_codigo.find('td:eq(2)').text();
    insp_codigo = fila_inspeccion_codigo.find('td:eq(3)').text();     
    Swal.fire({
      title               : '¿Está seguro?',
      text                : "Se eliminará el código "+insp_codigo+"! incluido componentes, fallas, acciones y posiciones",
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
        Accion='borrar_inspeccion_codigo';
        $.ajax({
        url         : "Ajax.php",
        type        : "POST",
        datatype    : "json",
        async       : false,    
        data        : { MoS:MoS, NombreMoS:NombreMoS, Accion:Accion, insp_bus_tipo:insp_bus_tipo, insp_codigo:insp_codigo },   
            success: function(data) {
              tabla_inspeccion_codigo.ajax.reload(null, false);
            }
        });
      }
    });
  });
  ///:: FIN BOTON BORRAR REGISTRO INSPECCION CODIGO :::::::::::::::::::::::::::::::::::::::///

    ///:: BOTON DESCARGAR ARBOL INSPECCION CODIGO :::::::::::::::::::::::::::::::::::::::::///
    $(document).on("click", ".btn_descargar_arbol", function(){
      insp_bus_tipo = $("#cod_inspeccion_flota").val();
      Accion='descargar_arbol';
      $.ajax({
      url         : "Ajax.php",
      type        : "POST",
      datatype    : "json",
      async       : false,    
      data        : { MoS:MoS, NombreMoS:NombreMoS, Accion:Accion, insp_bus_tipo:insp_bus_tipo },   
      beforeSend: function(){
        Swal.fire({
          icon: 'success',
          title: 'Procesando Información',
          showConfirmButton: false,
          timer: 5000
        })
      },
      success: function(data){
        window.location.href = mi_carpeta + "Module/inspeccion_flota/Controller/csv_descarga.php?archivo=" + data;
      }
      });
    });
    ///:: FIN BOTON BORRAR REGISTRO INSPECCION CODIGO :::::::::::::::::::::::::::::::::::::::///
  
  ///:: TERMINO BOTONES CODIGO DE INSPECCION FLOTA ::::::::::::::::::::::::::::::::::::::::///
});
///:: TERMINO JS DOM CODIGOS DE INSPECCION DE FLOTA :::::::::::::::::::::::::::::::::::::::///


///:: INICIO FUNCIONES INSPECCION CODIGO ::::::::::::::::::::::::::::::::::::::::::::::::::///

///:: VALIDA LOS CAMPOS DEL FORMULARIO ::::::::::::::::::::::::::::::::::::::::::::::::::::///
function f_validar_inspeccion_codigo(p_cod_insp_bus_tipo, p_cod_insp_orden, p_cod_insp_codigo, p_cod_insp_descripcion){
  f_limpia_inspeccion_codigo();
  let rpta_validar_inspeccion_codigo = "";

  if(p_cod_insp_bus_tipo==""){
    $("#cod_insp_bus_tipo").addClass("color-error");
    rpta_validar_inspeccion_codigo = "invalido";
  }
  if(p_cod_insp_orden==""){
    $("#cod_insp_orden").addClass("color-error");
    rpta_validar_inspeccion_codigo = "invalido";
  }
  if(p_cod_insp_codigo==""){
    $("#cod_insp_codigo").addClass("color-error");
    rpta_validar_inspeccion_codigo = "invalido";
  }
  if(p_cod_insp_descripcion==""){
    $("#cod_insp_descripcion").addClass("color-error");
    rpta_validar_inspeccion_codigo = "invalido";
  }

  return rpta_validar_inspeccion_codigo; 
}
///:: FIN VALIDA LOS CAMPOS DEL FORMULARIO ::::::::::::::::::::::::::::::::::::::::::::::::///

///:: RESTABLECE EL COLOR DE FONDO DE LOS CAMPOS DEL FORMULARIO :::::::::::::::::::::::::::///
function f_limpia_inspeccion_codigo(){
  $("#cod_insp_bus_tipo").removeClass("color-error");
  $("#cod_insp_orden").removeClass("color-error");
  $("#cod_insp_codigo").removeClass("color-error");
  $("#cod_insp_descripcion").removeClass("color-error");
}
///:: RESTABLECE EL COLOR DE FONDO DE LOS CAMPOS DEL FORMULARIO :::::::::::::::::::::::::::///

///:: ESTABLECE EL COLOR DE LAS COLUMNAS DEL DATATABLE ::::::::::::::::::::::::::::::::::::///
function f_color_filas_inspeccion_codigo(row,data){
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

///:: TERMINO FUNCIONES INSPECCION CODIGO :::::::::::::::::::::::::::::::::::::::::::::::::///