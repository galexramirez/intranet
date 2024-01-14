///::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
///:::::::::::::::::::: ASIGNAR CODIGOS v 1.0 FECHA: 07-11-2022 :::::::::::::::::::::::::::::::///
//:::::::::::::::::: EDITAR TABLA DE PRECIOS PROVEEDOR ::::::::::::::::::::::::::::::::::::::::///
///::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///

///::::::::::::::::::::::::::::::: Declaracion de Variables :::::::::::::::::::::::::::::::::::::///
var tablaAsignarCodigos, filaAsignarCodigos, opcionAsignarCodigos, PrecioMasActual;
var asignarcod_materialid, asignarcod_descripcion, asignarcod_precioprovid, asignarcod_codproveedor, asignarcod_desproveedor, asignarcod_raxonsocial;
var select_razonsocial, select_tipo, miCarpeta, opcionCargaPDF, matimag_tipoimagen;

miCarpeta = f_DocumentRoot();

///::::::::::::::: JS CARGA DE DATA TABLE :::::::::::::://
$(document).ready(function(){
  ///::::::::: COLOCA EL NOMBRE DEL ARCHIVO PDF EN EL INPUT FILE PARA PDF
  $(document).on('change', '#FichaTecnica_PDF', function (event) {
    pdfEditar="";
    let NombreArch=event.target.files[0].name;
    let Extension=NombreArch.split('.').pop();
    $("#labelFichaTecnica_PDF").text(NombreArch);
    
    let archivo = event.target.files[0];
    let reader = new FileReader();
    if (archivo) {
      reader.readAsDataURL(archivo );
      reader.onloadend = function () {
        pdfEditar='<iframe src="' + reader.result + '" width="750" height="400"></iframe>';
        $("#div_FichaTecnicaPDF").html(pdfEditar);
      }
    }
  });

  /// CARGAMOS LOS PROVEEDORES
  Accion = "SelectProveedores";
  $.ajax({
    url: "Ajax.php",
    type: "POST",
    datatype:"json",
    async: false,
    data: {MoS:MoS,NombreMoS:NombreMoS,Accion:Accion},    
    success: function(data){
      $("#select_razonsocial").html(data);
    }
  });

  //:: BOTON CARGAR PDF -> REALIZA LA GRABACION EN LA TABLA OPE_AccidentesImagenes BUS
  $('#formModalFichaTecnicaPDF').submit(function(e){
    e.preventDefault(); //evita el comportambiento normal del submit, es decir, recarga total de la página
    f_GrabarPDF(opcionCargaPDF);
    $('#modalCRUDFichaTecnicaPDF').modal('hide');
  });
  
  // Si hay cambios en select razon social
  $("#select_razonsocial").on('change', function () {
    select_razonsocial = $("#select_razonsocial").val();
    $('#div_tablaAsignarCodigos').hide();
  });

  // Si hay cambios en SIN DOCUMENTACION
  $("#select_tipo").on('change', function () {
    select_tipo = $("#select_tipo").val();
    $('#div_tablaAsignarCodigos').hide();
  });

  // Si hay cambios en Codigo Material se actualiza Descripcion Material
  $("#asignarcod_materialid").on('change', function () {
    asignarcod_materialid = $("#asignarcod_materialid").val();
    asignarcod_descripcion = "";
    Accion='BuscarAsignarCodigoId';
    $.ajax({
      url: "Ajax.php",
      type: "POST",
      datatype:"json",
      async: false,
      data: {MoS:MoS,NombreMoS:NombreMoS,Accion:Accion,material_id:asignarcod_materialid},    
      success: function(data){
        data = $.parseJSON(data);
        $.each(data, function(idx, obj){ 
          asignarcod_descripcion = obj.material_descripcion;
          asignarcod_materialid = obj.material_id;
        });
      }
    });
    $("#asignarcod_descripcion").val(asignarcod_descripcion);
    $("#asignarcod_materialid").val(asignarcod_materialid);
  });

  // Si hay cambios en Descripcion Repuesto se actualiza Codigo Repuesto
  $("#asignarcod_descripcion").on('change', function () {
    asignarcod_descripcion = $("#asignarcod_descripcion").val();
    asignarcod_materialid = "";
    Accion='BuscarAsignarCodigoDescripcion';
    $.ajax({
      url: "Ajax.php",
      type: "POST",
      datatype:"json",
      async: false,
      data: {MoS:MoS,NombreMoS:NombreMoS,Accion:Accion,material_descripcion:asignarcod_descripcion},    
      success: function(data){
        data = $.parseJSON(data);
        $.each(data, function(idx, obj){ 
            asignarcod_descripcion = obj.material_descripcion;
            asignarcod_materialid = obj.material_id;
        });
      }
    });
    $("#asignarcod_descripcion").val(asignarcod_descripcion);
    $("#asignarcod_materialid").val(asignarcod_materialid);
  });

  ///::::::::: BOTON BUSCAR ::::::::::::::::::::::///       
  $("#btnBuscarAsignarcod").click(function(){
    select_tipo = $("#select_tipo").val();
    select_razonsocial = $("#select_razonsocial").val();
    if(select_razonsocial == ""){
      Swal.fire({
        icon: 'error',
        title: 'Razon Social...',
        text: 'Falta información para la busqueda !!!'
      })    
    }else{
      $('#div_tablaAsignarCodigos').show();
      f_MostrarAsignarCodigos(select_razonsocial, select_tipo);
    }
  });
  
  ///::::::::: BOTON EDITAR ::::::::::::::::::::::///       
  $(document).on("click", ".btnAsignarCodigos", function(){
    opcionAsignarCodigos = 2;// Editar
    f_LimpiaAsignarCodigos();
    filaAsignarCodigos = $(this).closest("tr");	        

    // CARGAR LOS DATOS PARA AUTOCOMPLETAR
    $( function() {
      t_autocompletar = f_AutoCompletar("manto_materiales","material_id");
      $( "#asignarcod_materialid" ).autocomplete({
        minLength : 3,
        source: t_autocompletar,
        html: true,
        _renderMenu: function( ul, items ) {
          var that = this;
          $.each( items, function( index, item ) {
            that._renderItemData( ul, item );
          });
          $( ul ).find( "li" ).odd().addClass( "odd" );
        }
      });
    });
    
    $( function() {
      t_autocompletar = f_AutoCompletar("manto_materiales","material_descripcion");
      $( "#asignarcod_descripcion" ).autocomplete({
        minLengthc : 3,
        source: t_autocompletar,
        html: true,
        _renderMenu: function( ul, items ) {
          var that = this;
          $.each( items, function( index, item ) {
            that._renderItemData( ul, item );
          });
          $( ul ).find( "li" ).odd().addClass( "odd" );
        }
      });
    } );

    asignarcod_codproveedor = filaAsignarCodigos.find('td:eq(0)').text();
    asignarcod_desproveedor = filaAsignarCodigos.find('td:eq(1)').text();
    asignarcod_razonsocial = filaAsignarCodigos.find('td:eq(3)').text();
    asignarcod_materialid = filaAsignarCodigos.find('td:eq(4)').text();
    asignarcod_descripcion = filaAsignarCodigos.find('td:eq(5)').text();
    $("#asignarcod_codproveedor").val(asignarcod_codproveedor);
    $("#asignarcod_desproveedor").val(asignarcod_desproveedor);
    $("#asignarcod_razonsocial").val(asignarcod_razonsocial);
    $("#asignarcod_materialid").val(asignarcod_materialid);
    $("#asignarcod_descripcion").val(asignarcod_descripcion);

    $(".modal-header").css("background-color", "#007bff");
    $(".modal-header").css("color", "white" );
    $(".modal-title").text("Asignar Códigos");		

    $('#modalCRUDAsignarCodigos').modal('show');		   
  });


  /// ::::::::::::::: CREA Y EDITA USUARIO :::::::::::::///
  $('#formModalAsignarCodigos').submit(function(e){                         
    e.preventDefault(); //evita el comportambiento normal del submit, es decir, recarga total de la página
    asignarcod_materialid = $.trim($('#asignarcod_materialid').val());    
    asignarcod_descripcion = $.trim($('#asignarcod_descripcion').val());

    validacionAsignarCodigos = f_validarAsignarCodigos(asignarcod_materialid, asignarcod_descripcion);
    /// EDITAR
    if(opcionAsignarCodigos == 2) {
      if(validacionAsignarCodigos!="invalido") {   
        $("#btnGuardarAsignarCodigos").prop("disabled",true);
        Accion='EditarAsignarCodigos';
        $.ajax({
            url: "Ajax.php",
            type: "POST",
            datatype:"json",    
            data:  { MoS:MoS,NombreMoS:NombreMoS,Accion:Accion, precioprov_codproveedor:asignarcod_codproveedor, precioprov_descripcion:asignarcod_desproveedor, precioprov_razonsocial:asignarcod_razonsocial, precioprov_materialid:asignarcod_materialid },    
            success: function(data) {
                tablaAsignarCodigos.ajax.reload(null, false);
            }
        });
        $('#modalCRUDAsignarCodigos').modal('hide');
        $("#btnGuardarAsignarCodigos").prop("disabled",false);
      } 
    }
  });

});    

///:::::::::::::::::::::::::::::::::: BOTONES DE ASIGNAR CODIGOS :::::::::::::::::::::::::::::::::::::///

///::::::::  BOTON ADJUNTAR DOCUMENTOS EN PDF ::::::::::///
$(document).on("click", ".btnAdjuntarPDF", function(){
  $("#formModalFichaTecnicaPDF").trigger("reset");
  filaAsignarCodigos = $(this).closest('tr'); 
  asignarcod_codproveedor = filaAsignarCodigos.find('td:eq(0)').text();
  asignarcod_razonsocial = filaAsignarCodigos.find('td:eq(3)').text();

  if(asignarcod_codproveedor!="" && asignarcod_razonsocial!=""){
    let pPDF;
    let buscarPDF="";
    matimag_tipoimagen = "PDF";
    buscarPDF = f_BuscarPDF(matimag_tipoimagen);
    if(buscarPDF==""){
      pPDF = '<iframe src="Module/Materiales/View/Img/VistaPrevia.pdf" width="750" height="400"></iframe>';
      opcionCargaPDF = 1; //CREAR nueva imagen
    }else{
      pPDF = '<iframe src="' + buscarPDF + '"  width="750" height="400"></iframe>';
      opcionCargaPDF = 2; //EDITAR imagen
    }
    
    $(".modal-header").css( "background-color", "#17a2b8");
    $(".modal-header").css( "color", "white" );
    $(".modal-title").text("Carga de Archivo PDF");
    $("#div_FichaTecnicaPDF").html(pPDF);
    $("#labelFichaTecnica_PDF").text("Seleccionar Archivo .pdf");
    $('#modalCRUDFichaTecnicaPDF').modal('show');
  }else{
    Swal.fire({
      icon: 'error',
      title: 'ID Código de Proveedor...',
      text: 'Falta información para cargar el archivo!'
    })    
  }
});

///::::::::::::::::::::::::::::::::: FUNCIONES DE ASIGNAR CODIGOS ::::::::::::::::::::::::::::::::::::///

///::::::::: VALIDAR ASIGNAR CODIGOS ::::::::::::::::::::::///       
function f_validarAsignarCodigos(pasignarcod_materialid, pasignarcod_descripcion){
  f_LimpiaAsignarCodigos();
  NoLetrasMayuscEspacio = /[^A-Z \Ñ]/;
  var rpta_asignarcod = "";    
  if(pasignarcod_materialid == ""){
      $("#asignarcod_materialid").addClass("color-error");
      rpta_asignarcod = "invalido";
  }
  if(pasignarcod_descripcion==""){
      $("#asignarcod_descripcion").addClass("color-error");
      rpta_asignarcod = "invalido";
  }
  return rpta_asignarcod; 
}

///::::::::: INVISIBILIZA LOS MENSAJE DE ALERTA DEL FORMULARIO :::::: /// 
function f_LimpiaAsignarCodigos(){
    $("#asignarcod_materialid").removeClass("color-error");
    $("#asignarcod_descripcion").removeClass("color-error");
}

// FUNCION para utilizar el label del autocomplete como html
(function( $ ) {
    var proto = $.ui.autocomplete.prototype,
      initSource = proto._initSource;
    
    function filter( array, term ) {
      var matcher = new RegExp( $.ui.autocomplete.escapeRegex(term), "i" );
      return $.grep( array, function(value) {
        return matcher.test( $( "<div>" ).html( value.label || value.value || value ).text() );
      });
    }
    
    $.extend( proto, {
      _initSource: function() {
        if ( this.options.html && $.isArray(this.options.source) ) {
          this.source = function( request, response ) {
            response( filter( this.options.source, request.term ) );
          };
        } else {
          initSource.call( this );
        }
      },
    
      _renderItem: function( ul, item) {
        return $( "<li></li>" )
          .data( "item.autocomplete", item )
          .append( $( "<a class='text-decoration-none'></a>" )[ this.options.html ? "html" : "text" ]( item.label ) )
          .appendTo( ul );
      }
    });
})( jQuery );

///:::::::::::::: MOSTRAR DATATABLE DE ASIGNAR CODIGOS ::::::::::::::::::///
function f_MostrarAsignarCodigos(pselect_razonsocial, pselect_tipo){
  let pselect_ruc = "";
  let aTablaBD = "manto_proveedores";
  let aCampoBD = "prov_razonsocial";
  let adata = f_BuscarDataBD(aTablaBD,aCampoBD,pselect_razonsocial);
  $.each(adata, function(idx, obj){ 
    pselect_ruc = obj.prov_ruc;
  });

  div_tabla = f_CreacionTabla("tablaAsignarCodigos","");
  $("#div_tablaAsignarCodigos").html(div_tabla);
  columnastabla = f_ColumnasTabla("tablaAsignarCodigos","");
    
  $("#tablaAsignarCodigos").dataTable().fnDestroy();
  $('#tablaAsignarCodigos').show();
  
  // Setup - add a text input to each footer cell
  $('#tablaAsignarCodigos thead tr')
    .clone(true)
    .addClass('filtersAsignarCodigos')
    .appendTo('#tablaAsignarCodigos thead');
  
  Accion='LeerAsignarCodigos';
  tablaAsignarCodigos = $('#tablaAsignarCodigos').DataTable({
    //Filtros por columnas
    orderCellsTop: true,
    fixedHeader: true,
    initComplete: function (){
      var api = this.api();
      // For each column
      api.columns().eq(0).each(function (colIdx) {
        // Set the header cell to contain the input element
        var cell = $('.filtersAsignarCodigos th').eq($(api.column(colIdx).header()).index());
        var title = $(cell).text();
        $(cell).html('<input type="text" placeholder="' + title + '" />');
        // On every keypress in this input
        $('input',$('.filtersAsignarCodigos th').eq($(api.column(colIdx).header()).index()) ).off('keyup change').on('keyup change', function (e) {
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
    // Para mostrar la barra scroll horizontal y vertical
    deferRender:    true,
    scrollY:        800,
    scrollCollapse: true,
    scroller:       true,
    scrollX:        true,
    fixedColumns:{
        left: 1
    },
    fixedHeader:{
        header : false
    },
    //Para mostrar 50 registros popr página 
    pageLength: 50,
    //Para cambiar el lenguaje a español
    language: idioma_espanol, 
    //Para usar los botones
    responsive: "true",
    dom: 'Blfrtip', // Con Botones Excel,Pdf,Print
    buttons:[
        {
            extend:     'excelHtml5',
            text:       '<i class="fas fa-file-excel"></i> ',
            titleAttr:  'Exportar a Excel',
            className:  'btn btn-success',
            title: 'ASIGNAR CODIGOS'
        },
    ],
    "ajax":{            
        "url": "Ajax.php", 
        "method": 'POST', //usamos el metodo POST
        "data": {MoS:MoS,NombreMoS:NombreMoS,Accion:Accion,asignarcod_ruc:pselect_ruc,asignarcod_tipo:pselect_tipo}, //enviamos opcion 4 para que haga un SELECT
        "dataSrc":""
    },
    "columns": columnastabla,
    "order": [[0, 'desc']]
  });
}

///:::::::::::: GRABAR IMAGEN ::::::::::::::::::::::::///
function f_GrabarPDF(p_opcionCargaPDF){
  let blobFile;
  let formData = new FormData();
  blobFile = $('#FichaTecnica_PDF')[0].files[0];
  $("#btnGuardarFichaTecnicaPDF").prop("disabled",true);

  if(p_opcionCargaPDF==1){
    Accion='GrabarImagen';
  }else{
    Accion='EditarImagen';
  }

  formData.append("MoS", MoS);
  formData.append("NombreMoS", NombreMoS);
  formData.append("Accion", Accion);
  formData.append("matimag_codproveedor", asignarcod_codproveedor);
  formData.append("asignarcod_razonsocial", asignarcod_razonsocial);
  formData.append("matimag_tipoimagen", matimag_tipoimagen);
  formData.append("matimag_imagen", blobFile);

  $.ajax({
      url: "Ajax.php",
      type: "POST",
      datatype:"json",    
      data:  formData,   
      contentType:false,
      processData:false,
      success: function(data) {
        $("#btnGuardarFichaTecnicaPDF").prop("disabled",false);
      }
  });	
}

///::::::::: BUSCAR PDF ::::::::::::::::::::::///       
function f_BuscarPDF(pmatimag_tipoimagen){
  let pdf="";
  $("#btnAdjuntarPDF").prop("disabled",true);
  Accion='BuscarImagen';
  $.ajax({
      url: "Ajax.php",
      type: "POST",
      datatype:"json",    
      async: false,   
      data:  { MoS:MoS,NombreMoS:NombreMoS,Accion:Accion, matimag_codproveedor:asignarcod_codproveedor, asignarcod_razonsocial:asignarcod_razonsocial, matimag_tipoimagen:pmatimag_tipoimagen },   
      success: function(data) {
          data = $.parseJSON(data);
          $.each(data, function(idx, obj){ 
              if(obj.b64_Foto){
                  pdf  = 'data:application/pdf;base64,' + obj.b64_Foto;
                  $("#btnAdjuntarPDF").prop("disabled",false);
              }
          });
      }
  });	
  return pdf;
}