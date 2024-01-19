///::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
///:: MATERIALES v 2.0 FECHA: 11-01-2024 ::::::::::::::::::::::::::::::::::::::::::::::::::///
///:: CREAR, EDITAR, ELIMINAR TABLA DE MATERIALES :::::::::::::::::::::::::::::::::::::::::///
///::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///

///:: Declaracion de Variables ::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
var tablaMateriales, filaMateriales, opcionTablaMateriales, select_html;
var material_id, material_descripcion, material_categoria, material_patrimonial, material_observaciones, material_log, material_estado, material_obslog, mate_unidad_medida, material_unidadmedida;
var cod_asignacion, cod_macrosistema, cod_sistema, cod_componente, cod_material, cod_tarjeta, cod_condicion, cod_flota;

///:: JS CARGA DE DATA TABLE ::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
$(document).ready(function(){
  $("#cod_asignacion").on('change', function () {
    f_GeneraCodigoMateriales();
  });
  
  $("#cod_macrosistema").on('change', function () {
    cod_macrosistema  = $("#cod_macrosistema").val();
    cod_sistema       = "";
    select_html       = "";
    select_html       = f_TipoTabla("MATERIALES",cod_macrosistema);
    $("#cod_sistema").html(select_html);
    $("#cod_sistema").val(cod_sistema);
    f_GeneraCodigoMateriales();
  });
  
  $("#cod_tarjeta").on('change', function () {
    cod_tarjeta   = $("#cod_tarjeta").val();
    cod_condicion = "";
    select_html   = "";
    select_html   = f_TipoTabla("MATERIALES",cod_tarjeta);
    $("#cod_condicion").html(select_html);
    $("#cod_condicion").val(cod_condicion);
    f_GeneraCodigoMateriales();
  });
  
  $("#cod_sistema, #cod_tarjeta, #cod_condicion, #cod_flota ").on('change', function () { 
    f_GeneraCodigoMateriales(); 
  });
  
  ///:: BOTON RECARGAR TABLA ::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
  $("#btnBuscarMateriales").click(function(){
    f_MostrarTablaMateriales();
  });
  ///:: BOTON RECARGAR TABLA ::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
    
  ///:: EVENTO DEL BOTON NUEVO ::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
  $("#btnNuevoMateriales").click(function(){
    opcionTablaMateriales = 1; // Alta 
    material_log          = "";
    material_id           = "";
    material_obslog       = "";

    f_LimpiaMsTablaMateriales();
    f_select_materiales();    

    $("#material_id").prop('disabled', false);
    $("#btnCodigoMateriales").show();
    $("#btnGuardarMateriales").show();
    $("#formModalMateriales").trigger("reset");
    $("#div_material_log").html(material_log);
    $("#material_obslog").val(material_obslog);

    $(".modal-header").css( "background-color", "#17a2b8");
    $(".modal-header").css( "color", "white" );
    $(".modal-title").text("Alta Materiales y Servicios");
    $('#modalCRUDMateriales').modal('show');
    $('#modalCRUDMateriales').draggable();
  });
  ///:: FIN EVENTO DEL BOTON NUEVO ::::::::::::::::::::::::::::::::::::::::::::::::::::::::///

  ///:: EVENTO DEL BOTON NUEVO ::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
    $("#btnCodigoMateriales").click(function(){
      if(material_id==""){
        cod_material      = "";
        cod_asignacion    = "";
        cod_macrosistema  = "";
        cod_sistema       = "";
        cod_componente    = "";
        cod_tarjeta       = "";
        cod_condicion     = "";
        cod_flota         = "";
      }else{
        cod_material = material_id;
        f_BuscarCodigoMateriales(cod_material);
      }
      f_LimpiaMsCodigoMateriales();
      $("#formModalCodigoMateriales").trigger("reset");

      $("#material_descripcion").prop('disabled', false);
      $("#material_patrimonial").prop('disabled', false);
      $("#material_categoria").prop('disabled', false);
      $("#material_observaciones").prop('disabled', false);

      $("#cod_material").val(cod_material);
      $("#cod_asignacion").val(cod_asignacion);
      $("#cod_macrosistema").val(cod_macrosistema);
      $("#cod_sistema").val(cod_sistema);
      $("#cod_componente").val(cod_componente);
      $("#cod_tarjeta").val(cod_tarjeta);
      $("#cod_condicion").val(cod_condicion);
      $("#cod_flota").val(cod_flota);
      $("#btnCodigoMateriales").show();

      $(".modal-header").css( "background-color", "#17a2b8");
      $(".modal-header").css( "color", "white" );
      $("#codigoModalLabel").text("Generar Código de Materiales");
      $('#modalCRUDCodigoMateriales').modal('show');	    
      $('#modalCRUDCodigoMateriales').draggable();
    });
  ///:: FIN EVENTO DEL BOTON NUEVO ::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
    
  ///:: BOTON EDITAR ::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///       
  $(document).on("click", ".btnEditarMateriales", function(){
    f_LimpiaMsTablaMateriales();
    f_select_materiales();
    opcionTablaMateriales = 2;// Editar
    filaTablaMateriales   = $(this).closest("tr");	        
    material_id           = filaTablaMateriales.find('td:eq(0)').text();
    material_descripcion  = filaTablaMateriales.find('td:eq(1)').text();
    mate_unidad_medida    = filaTablaMateriales.find('td:eq(2)').text(); 
    material_tipo         = filaTablaMateriales.find('td:eq(3)').text();
    material_patrimonial  = filaTablaMateriales.find('td:eq(4)').text();
    material_categoria    = filaTablaMateriales.find('td:eq(5)').text();
    material_estado       = filaTablaMateriales.find('td:eq(13)').text();
    material_obslog       = "";
    
    $("#btnCodigoMateriales").hide();
    
    if(material_estado=="INACTIVO"){
      $("#material_descripcion").prop('disabled', true);
      $("#mate_unidad_medida").prop('disabled', true);
      $("#material_tipo").prop('disabled', true);
      $("#material_patrimonial").prop('disabled', true);
      $("#material_categoria").prop('disabled', true);
      $("#material_observaciones").prop('disabled', true);
    }else{
      $("#material_descripcion").prop('disabled', false);
      $("#mate_unidad_medida").prop('disabled', false);
      $("#material_tipo").prop('disabled', false);
      $("#material_patrimonial").prop('disabled', false);
      $("#material_categoria").prop('disabled', false);
      $("#material_observaciones").prop('disabled', false);
    }
    
    mTablaBD = "manto_materiales";
    mCampoBD = "material_id";
    mdata = f_BuscarDataBD(mTablaBD,mCampoBD,material_id)
    
    $.each(mdata, function(idx, obj){ 
      material_observaciones  = obj.material_observaciones;
      material_log            = obj.material_log;
    });

    $("#material_id").val(material_id);
    $("#material_descripcion").val(material_descripcion);
    $("#mate_unidad_medida").val(mate_unidad_medida);
    $("#material_tipo").val(material_tipo);
    $("#material_patrimonial").val(material_patrimonial);
    $("#material_categoria").val(material_categoria);
    $("#material_observaciones").val(material_observaciones);
    $("#material_estado").val(material_estado);
    $("#div_material_log").html(material_log);
    $("#material_obslog").val(material_obslog);

    $(".modal-header").css("background-color", "#007bff");
    $(".modal-header").css("color", "white" );
    $(".modal-title").text("Editar Materiales y Servicios");		

    $('#modalCRUDMateriales').modal('show');
  });

  ///:: CREA Y EDITA MATERIALES :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
  $('#formModalMateriales').submit(function(e){                         
    let validacionTablaMateriales = "";
    e.preventDefault(); //evita el comportambiento normal del submit, es decir, recarga total de la página
    material_id             = $.trim($('#material_id').val());    
    material_descripcion    = $.trim($('#material_descripcion').val());
    mate_unidad_medida      = $.trim($('#mate_unidad_medida').val());
    material_tipo           = $.trim($('#material_tipo').val());
    material_patrimonial    = $.trim($('#material_patrimonial').val());
    material_categoria      = $.trim($('#material_categoria').val());
    material_estado         = $.trim($('#material_estado').val());
    material_observaciones  = $.trim($('#material_observaciones').val());
    material_obslog         = $.trim($('#material_obslog').val());
    cod_macrosistema        = $("#cod_macrosistema").val();
    cod_sistema             = $("#cod_sistema").val();
    cod_tarjeta             = $("#cod_tarjeta").val();
    cod_condicion           = $("#cod_condicion").val();
    cod_flota               = $("#cod_flota").val();

    validacionTablaMateriales = f_validarTablaMateriales(material_id, material_descripcion, mate_unidad_medida, material_tipo, material_patrimonial, material_categoria,material_estado, material_observaciones, material_obslog);
    unidad_medida         = $.trim(mate_unidad_medida.substring(0,mate_unidad_medida.indexOf('-')));
    material_unidadmedida = f_encontrar_dato('manto_unidad_medida','unidad_medida',unidad_medida,'unidad_medida') 

    /// CREAR
    if(opcionTablaMateriales == 1) {
      if(validacionTablaMateriales!="invalido") {   
        $("#btnGuardarMateriales").prop("disabled",true);
        Accion = 'CrearMateriales';
        $.ajax({
          url       : "Ajax.php",
          type      : "POST",
          datatype  : "json",    
          data      : { MoS:MoS,NombreMoS:NombreMoS,Accion:Accion, material_id:material_id, material_descripcion:material_descripcion, material_unidadmedida:material_unidadmedida, material_tipo:material_tipo, material_patrimonial:material_patrimonial, material_categoria:material_categoria,  material_estado:material_estado, material_observaciones:material_observaciones, material_obslog:material_obslog, material_macrosistema:cod_macrosistema, material_sistema:cod_sistema, material_tarjeta:cod_tarjeta, material_condicion:cod_condicion, material_flota:cod_flota },
          success   : function(data) {
            tablaMateriales.ajax.reload(null, false);
          }
        });
        $('#modalCRUDMateriales').modal('hide');
        $("#btnGuardarMateriales").prop("disabled",false);
      } 
    }
    /// EDITAR
    if(opcionTablaMateriales == 2) {
      if(validacionTablaMateriales!="invalido") {   
        $("#btnGuardarMateriales").prop("disabled",true);
        Accion='EditarMateriales';
        $.ajax({
          url       : "Ajax.php",
          type      : "POST",
          datatype  : "json",    
          data      : { MoS:MoS,NombreMoS:NombreMoS,Accion:Accion, material_id:material_id, material_descripcion:material_descripcion, material_unidadmedida:material_unidadmedida, material_tipo:material_tipo, material_patrimonial:material_patrimonial, material_categoria:material_categoria,  material_estado:material_estado, material_observaciones:material_observaciones, material_obslog:material_obslog },    
          success   : function(data) {
            tablaMateriales.ajax.reload(null, false);
          }
        });
        $('#modalCRUDMateriales').modal('hide');
        $("#btnGuardarMateriales").prop("disabled",false);
      } 
    }
  });
  ///:: FIN CREA Y EDITA MATERIALES :::::::::::::::::::::::::::::::::::::::::::::::::::::::///
  
  ///:: GENERA CODIGO MATERIALES ::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
  $('#formModalCodigoMateriales').submit(function(e){                         
    let validarCodigoMateriales = "";
    e.preventDefault(); //evita el comportambiento normal del submit, es decir, recarga total de la página
    cod_material      = $.trim($("#cod_material").val());
    cod_asignacion    = $.trim($("#cod_asignacion").val());
    cod_macrosistema  = $.trim($("#cod_macrosistema").val());
    cod_sistema       = $.trim($("#cod_sistema").val());
    cod_componente    = $.trim($("#cod_componente").val());
    cod_tarjeta       = $.trim($("#cod_tarjeta").val());
    cod_condicion     = $.trim($("#cod_condicion").val());
    cod_flota         = $.trim($("#cod_flota").val());
    
    validarCodigoMateriales = f_validarCodigoMateriales(cod_material, cod_asignacion, cod_macrosistema, cod_sistema, cod_componente, cod_tarjeta, cod_condicion, cod_flota);
    if (validarCodigoMateriales!="invalido"){
      material_id = cod_material;
      $("#material_id").val(cod_material);
      $("#modalCRUDCodigoMateriales").modal('hide');  
    }else{
      Swal.fire(
        'Generar!',
        'Falta completar información ...!',
        'success'
      )  
    }
  });
  ///:: FIN GENERA CODIGO MATERIALES ::::::::::::::::::::::::::::::::::::::::::::::::::::::///

  ///:: TERMINO BOTONES DE MATERIALES :::::::::::::::::::::::::::::::::::::::::::::::::::::///
});
///:: TERMINO JS CARGA DE DATA TABLE ::::::::::::::::::::::::::::::::::::::::::::::::::::::///


///:: FUNCIONES DE MATERIALES :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///

///:: VALIDAR MATERIALES ::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///       
function f_validarTablaMateriales(pmaterial_id, pmaterial_descripcion, pmate_unidad_medida, pmaterial_tipo, pmaterial_patrimonial, pmaterial_categoria, pmaterial_estado, pmaterial_observaciones, pmaterial_obslog){
  f_LimpiaMsTablaMateriales();
  NoLetrasMayuscEspacio=/[^A-Z \Ñ]/;
  var rpta_Materiales="";    
  
  if(pmaterial_id==""){
      $("#material_id").addClass("color-error");
      rpta_Materiales="invalido";
  }
  if(pmaterial_descripcion==""){
      $("#material_descripcion").addClass("color-error");
      rpta_Materiales="invalido";
  }
  if(pmate_unidad_medida==""){
    $("#mate_unidad_medida").addClass("color-error");
    rpta_Materiales="invalido";
  }
  if(pmaterial_tipo==""){
    $("#material_tipo").addClass("color-error");
    rpta_Materiales="invalido";
  }
  if(pmaterial_patrimonial==""){
    $("#material_patrimonial").addClass("color-error");
    rpta_Materiales="invalido";
  }
  if(pmaterial_categoria==""){
    $("#material_categoria").addClass("color-error");
    rpta_Materiales="invalido";
  }
  if(pmaterial_estado==""){
    $("#material_estado").addClass("color-error");
    rpta_Materiales="invalido";
  }
  /*if(pmaterial_observaciones==""){
      $("#material_observaciones").addClass("color-error");
      rpta_Materiales="invalido";
  }
  if(pmaterial_obslog==""){
    $("#material_obslog").addClass("color-error");
    rpta_Materiales="invalido";
  }*/
  return rpta_Materiales; 
}

function f_validarCodigoMateriales(pcod_material, pcod_asignacion, pcod_macrosistema, pcod_sistema, pcod_componente, pcod_tarjeta, pcod_condicion, pcod_flota){
  f_LimpiaMsCodigoMateriales();
  NoLetrasMayuscEspacio=/[^A-Z \Ñ]/;
  var rpta_CodigoMateriales="";    

  if(pcod_material==""){
      $("#cod_material").addClass("color-error");
      rpta_CodigoMateriales="invalido";
  }

  if(pcod_asignacion==""){
      $("#cod_asignacion").addClass("color-error");
      rpta_CodigoMateriales="invalido";
  }

  if(pcod_macrosistema==""){
    $("#cod_macrosistema").addClass("color-error");
    rpta_CodigoMateriales="invalido";
  }

  if(pcod_sistema==""){
    $("#cod_sistema").addClass("color-error");
    rpta_CodigoMateriales="invalido";
  }

  if(pcod_componente==""){
      $("#cod_componente").addClass("color-error");
      rpta_CodigoMateriales="invalido";
  }

  if(pcod_tarjeta==""){
    $("#cod_tarjeta").addClass("color-error");
    rpta_CodigoMateriales="invalido";
  }

  if(pcod_condicion==""){
    $("#cod_condicion").addClass("color-error");
    rpta_CodigoMateriales="invalido";
  }

  if(pcod_flota==""){
    $("#cod_flota").addClass("color-error");
    rpta_CodigoMateriales="invalido";
  }

  return rpta_CodigoMateriales; 
}

///::::::::: INVISIBILIZA LOS MENSAJE DE ALERTA DEL FORMULARIO :::::: /// 
function f_LimpiaMsTablaMateriales(){
    $("#material_id").removeClass("color-error");
    $("#material_descripcion").removeClass("color-error");
    $("#mate_unidad_medida").removeClass("color-error");
    $("#material_tipo").removeClass("color-error");
    $("#material_patrimonial").removeClass("color-error");
    $("#material_categoria").removeClass("color-error");
    $("#material_estado").removeClass("color-error");
    /*$("#material_observaciones").removeClass("color-error");
    $("#material_obslog").removeClass("color-error");*/
}

function f_LimpiaMsCodigoMateriales(){
  $("#cod_material").removeClass("color-error");
  $("#cod_asignacion").removeClass("color-error");
  $("#cod_macrosistema").removeClass("color-error");
  $("#cod_sistema").removeClass("color-error");
  $("#cod_componente").removeClass("color-error");
  $("#cod_tarjet").removeClass("color-error");
  $("#cod_condicion").removeClass("color-error");
  $("#cod_flota").removeClass("color-error");
}

function f_GeneraCodigoMateriales() {
  cod_asignacion    = $("#cod_asignacion").val();
  cod_macrosistema  = $("#cod_macrosistema").val();
  cod_sistema       = $("#cod_sistema").val();
  cod_tarjeta       = $("#cod_tarjeta").val();
  cod_condicion     = $("#cod_condicion").val();
  cod_flota         = $("#cod_flota").val();
  
  if(cod_asignacion!="" && cod_macrosistema!="" && cod_sistema!="" && cod_tarjeta!="" && cod_condicion!="" && cod_flota!=""){
    Accion = "GeneraCodigoMateriales";
    $.ajax({
      url       : "Ajax.php",
      type      : "POST",
      datatype  : "json",
      async     : false,    
      data      : { MoS:MoS, NombreMoS:NombreMoS, Accion:Accion, cod_asignacion:cod_asignacion, cod_macrosistema:cod_macrosistema, cod_sistema:cod_sistema, cod_tarjeta:cod_tarjeta, cod_condicion:cod_condicion, cod_flota:cod_flota },
      success   : function(data) {
        data = $.parseJSON(data);
        $.each(data, function(idx, obj){ 
          cod_material    = obj.cod_material;
          cod_componente  = obj.cod_componente;
        });
      }
    });
  
    $("#cod_material").val(cod_material);
    $("#cod_componente").val(cod_componente);  
  }else{
  //if(cod_asignacion=="" || cod_macrosistema=="" || cod_sistema==""){
    cod_material   = "";
    cod_componente = "";
    $("#cod_material").val(cod_material);
    $("#cod_componente").val(cod_componente);  
  }
}   

function f_BuscarCodigoMateriales(pcod_material) {
  Accion = "BuscarCodigoMateriales";
  $.ajax({
    url       : "Ajax.php",
    type      : "POST",
    datatype  : "json",
    async     : false,    
    data: { MoS:MoS,NombreMoS:NombreMoS,Accion:Accion, cod_material:pcod_material},   
    success: function(data) {
      data = $.parseJSON(data);
        $.each(data, function(idx, obj){ 
          cod_asignacion    = obj.cod_asignacion;
          cod_macrosistema  = obj.cod_macrosistema;
          cod_sistema       = obj.cod_sistema;
          cod_componente    = obj.cod_componente;
          cod_tarjeta       = obj.cod_tarjeta;
          cod_condicion     = obj.cod_condicion;
          cod_flota         = obj.cod_flota;
        });
    }
  });
}

function f_MostrarTablaMateriales(){
  div_tabla = f_CreacionTabla("tablaMateriales","");
  $("#div_tablaMateriales").html(div_tabla);
  columnastabla = f_ColumnasTabla("tablaMateriales","");

  $("#tablaMateriales").dataTable().fnDestroy();
  $('#tablaMateriales').show();

  // Setup - add a text input to each footer cell
  $('#tablaMateriales thead tr')
      .clone(true)
      .addClass('filtersMateriales')
      .appendTo('#tablaMateriales thead');

  Accion='LeerMateriales';
  tablaMateriales = $('#tablaMateriales').DataTable({
      //Filtros por columnas
      orderCellsTop : true,
      fixedHeader   : true,
      initComplete  : function (){
          var api = this.api();
          // For each column
          api.columns().eq(0).each(function (colIdx) {
              // Set the header cell to contain the input element
              var cell = $('.filtersMateriales th').eq($(api.column(colIdx).header()).index());
              var title = $(cell).text();
              $(cell).html('<input type="text" placeholder="' + title + '" />');
              // On every keypress in this input
              $('input',$('.filtersMateriales th').eq($(api.column(colIdx).header()).index()) ).off('keyup change').on('keyup change', function (e) {
                  e.stopPropagation();
                  // Get the search value
                  $(this).attr('title', $(this).val());
                  var regexr = '({search})'; //$(this).parents('th').find('select').val();
                  var cursorPosition = this.selectionStart;
                  // Search the column for that value
                  api.column(colIdx).search(
                      this.value != '' ? regexr.replace('{search}', '(((' + this.value + ')))'): '',
                      this.value != '',
                      this.value == ''
                  ).draw();
                  $(this).focus()[0].setSelectionRange(cursorPosition, cursorPosition);
              });
          });
      },
      deferRender     : true,
      scrollY         : 800,
      scrollCollapse  : true,
      scroller        : true,
      scrollX         : true,
      fixedColumns    : {
        left          : 1
      },
      fixedHeader     : {
        header        : false
      },
      pageLength      : 50,
      language        : idioma_espanol, 
      responsive      : "true",
      dom             : 'Blfrtip', // Con Botones Excel,Pdf,Print
      buttons         :[
        {
          extend      : 'excelHtml5',
          text        : '<i class="fas fa-file-excel"></i> ',
          titleAttr   :  'Exportar a Excel',
          className   :  'btn btn-success'
        },
      ],
      "ajax"          : {            
          "url"       : "Ajax.php", 
          "method"    : 'POST',
          "data"      : {MoS:MoS,NombreMoS:NombreMoS,Accion:Accion},
          "dataSrc"   : ""
      },
      "columns"       : columnastabla,
      "columnDefs"    : [
        {
          "targets"   : [14, 15],
          "orderable" : false
        },
        {
          "className" : "text-center",
          "targets"   : [2,4,5,6,7,8]
        },
        {
          "targets"   : [14],
          "render"    : function(data, type, row, meta) {
              if(data==="SI"){
                  return "<div class='text-center'><div class='btn-group'><button title='Proveedor' class='btn btn-sm btnProveedor'><i class='bi bi-people-fill'><svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-people-fill' viewBox='0 0 16 16'><path d='M7 14s-1 0-1-1 1-4 5-4 5 3 5 4-1 1-1 1H7zm4-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6z'/><path fill-rule='evenodd' d='M5.216 14A2.238 2.238 0 0 1 5 13c0-1.355.68-2.75 1.936-3.72A6.325 6.325 0 0 0 5 9c-4 0-5 3-5 4s1 1 1 1h4.216z'/><path d='M4.5 8a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5z'/></svg></i></button></div></div>";
              }else{
                  return "";
              }
          }
        }
      ],
      "order"         : [[0, 'desc']]
  });     
}

function f_select_materiales(){
  select_html = f_select_unidad_medida();
  $("#mate_unidad_medida").html(select_html);

  select_html = f_select_combo("manto_tc_material", "NO", "tc_categoria3", "", "`tc_variable`='SISTEMA' AND `tc_categoria1`='MATERIALES' AND `tc_categoria2`='TIPO'", "`tc_categoria3` ASC");
  $("#material_tipo").html(select_html);

  select_html  = f_select_combo("manto_tc_material", "NO", "tc_categoria3", "", "`tc_variable`='SISTEMA' AND `tc_categoria1`='MATERIALES' AND `tc_categoria2`='PATRIMONIAL'", "`tc_categoria3` ASC");
  $("#material_patrimonial").html(select_html);

  select_html  = f_select_combo("manto_tc_material", "NO", "tc_categoria3", "", "`tc_variable`='USUARIO' AND `tc_categoria1`='MATERIALES' AND `tc_categoria2`='CATEGORIA'", "`tc_categoria3` ASC");
  $("#material_categoria").html(select_html);

  select_html  = f_select_combo("manto_tc_material", "NO", "tc_categoria3", "", "`tc_variable`='SISTEMA' AND `tc_categoria1`='MATERIALES' AND `tc_categoria2`='ESTADO'", "`tc_categoria3` ASC");
  $("#material_estado").html(select_html);
  
  select_html  = f_select_combo("manto_tc_material", "NO", "tc_categoria3", "", "`tc_variable`='USUARIO' AND `tc_categoria1`='MATERIALES' AND `tc_categoria2`='ASIGNACION'", "`tc_categoria3` ASC");
  $("#cod_asignacion").html(select_html);

  select_html  = f_select_combo("manto_tc_material", "NO", "tc_categoria3", "", "`tc_variable`='USUARIO' AND `tc_categoria1`='MATERIALES' AND `tc_categoria2`='MACROSISTEMA'", "`tc_categoria3` ASC");
  $("#cod_macrosistema").html(select_html);

  select_html  = f_select_combo("manto_tc_material", "NO", "tc_categoria3", "", "`tc_variable`='USUARIO' AND `tc_categoria1`='MATERIALES' AND `tc_categoria2`='"+cod_macrosistema+"'", "`tc_categoria3` ASC");
  $("#cod_sistema").html(select_html);

  select_html  = f_select_combo("manto_tc_material", "NO", "tc_categoria3", "", "`tc_variable`='USUARIO' AND `tc_categoria1`='MATERIALES' AND `tc_categoria2`='TARJETA'", "`tc_categoria3` ASC");
  $("#cod_tarjeta").html(select_html);

  select_html  = f_select_combo("manto_tc_material", "NO", "tc_categoria3", "", "`tc_variable`='USUARIO' AND `tc_categoria1`='MATERIALES' AND `tc_categoria2`='"+cod_tarjeta+"'", "`tc_categoria3` ASC");
  $("#cod_condicion").html(select_html);

  select_html  = f_select_combo("manto_tc_material", "NO", "tc_categoria3", "", "`tc_variable`='SISTEMA' AND `tc_categoria1`='MATERIALES' AND `tc_categoria2`='FLOTA'", "`tc_categoria3` ASC");
  $("#cod_flota").html(select_html);
}