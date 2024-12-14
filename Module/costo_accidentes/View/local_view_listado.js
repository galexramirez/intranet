///::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
///:: COSTO DE ACCIDENTES v 1.0  FECHA: 2023-05-03:::::: ::::::::::::::::::::::::::::::::::///
///:: MOSTRAR ACCIDENTES REPORTADOS :::::::::::::::::::::::::::::::::::::::::::::::::::::::///
///::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///

///:: DECLARACION DE VARIABLES ::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
var tabla_costo_accidentes, acci_fecha_inicio, acci_fecha_termino, fila_costo_accidentes, accidentes_id, acci_tipo_imagen, opcion_carga_pdf, opcion_carga_costo_accidente;
acci_fecha_inicio  = "";
acci_fecha_termino = "";

///:: JS DOM COSTO DE ACCIDENTES ::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
$(document).ready(function(){
  div_show = f_MostrarDiv("form_seleccion_costo_accidentes","div_seleccion_costo_accidentes","");
  $("#div_seleccion_costo_accidentes").html(div_show);

  if(acci_fecha_inicio=="" && acci_fecha_termino==""){
    acci_fecha_inicio   = f_CalculoFecha("hoy","0");
    acci_fecha_termino  = f_CalculoFecha("hoy","0");
    $('#acci_fecha_inicio').val(acci_fecha_inicio);
    $('#acci_fecha_termino').val(acci_fecha_termino);
  }

  // Si hay cambios en el Fecha se ocultan botones y datatable
  $("#acci_fecha_inicio").on('change', function () {
    $("#tabla_costo_accidentes").dataTable().fnDestroy();
    $('#tabla_costo_accidentes').hide();  
  });

  $("#acci_fecha_termino").on('change', function () {
    $("#tabla_costo_accidentes").dataTable().fnDestroy();
    $('#tabla_costo_accidentes').hide();
  });

  $("#acos_monto_mano_obra").on('change', function () {
    f_calculo_cotizacion();
  });

  $("#acos_monto_insumos").on('change', function () {
    f_calculo_cotizacion();  
  });

  //Selecciona las filas a editar
  $(document).on("click", "tr",".tabla_costo_accidentes tbody", function(){		
    accidentes_id="";
    if(tabla_costo_accidentes.rows('.selected').data().length===1){
      fila_costo_accidentes = $(this).closest("tr");	        
      accidentes_id         = fila_costo_accidentes.find('td:eq(0)').text();
      acos_firma_convenio   = fila_costo_accidentes.find('td:eq(11)').text();
    }
    div_show = f_MostrarDiv("form_seleccion_costo_accidentes","div_seleccion_costo_accidentes",accidentes_id);
    $("#div_seleccion_costo_accidentes").html(div_show);
  });

  ///:: COLOCA EL NOMBRE DEL ARCHIVO PDF EN EL INPUT FILE PARA PDF ::::::::::::::::::::::::///
  $(document).on('change', '#cargar_pdf', function (event) {
    pdfEditar       = "";
    let NombreArch  = event.target.files[0].name;
    let Extension   = NombreArch.split('.').pop();
    $("#label_cargar_pdf").text(NombreArch);
  });
  ///:: BOTONES COSTO DE ACCIDENTES :::::::::::::::::::::::::::::::::::::::::::::::::::::::///

  ///:: BOTON LISTAR COSTO DE ACCIDENTES ::::::::::::::::::::::::::::::::::::::::::::::::::///
  $(document).on("click", ".btn_buscar_costo_accidentes", function(){
    acci_fecha_inicio   = $("#acci_fecha_inicio").val();
    acci_fecha_termino  = $("#acci_fecha_termino").val();

    div_show = f_MostrarDiv("form_seleccion_costo_accidentes","div_seleccion_costo_accidentes","");
    $("#div_seleccion_costo_accidentes").html(div_show);

    div_tablas      = f_CreacionTabla("tabla_costo_accidentes","");
    columnas_tabla  = f_ColumnasTabla("tabla_costo_accidentes","");
    $('#div_tabla_costo_accidentes').html(div_tablas);
  
    // Setup - add a text input to each footer cell
    $('#tabla_costo_accidentes thead tr')
      .clone(true)
      .addClass('filters_costo_accidentes')
      .appendTo('#tabla_costo_accidentes thead');
  
    $("#tabla_costo_accidentes").dataTable().fnDestroy();
    $('#tabla_costo_accidentes').show();

    Accion = 'buscar_costo_accidentes';
    tabla_costo_accidentes = $('#tabla_costo_accidentes').removeAttr('width').DataTable({
      "rowCallback":function(row,data,index){
        f_color_filas_costo_accidentes(row,data);
      }, 
      orderCellsTop: true,
      fixedHeader: true,
      initComplete: function (){
        var api = this.api();
        // For each column
        api.columns().eq(0).each(function (colIdx) {
          // Set the header cell to contain the input element
          var cell = $('.filters_costo_accidentes th').eq($(api.column(colIdx).header()).index());
          var title = $(cell).text();
          $(cell).html('<input type="text" placeholder="' + title + '" />');
          // On every keypress in this input
          $('input',$('.filters_costo_accidentes th').eq($(api.column(colIdx).header()).index()) ).off('keyup change').on('keyup change', function (e) {
            e.stopPropagation();
            // Get the search value
            $(this).attr('title', $(this).val());
            var regexr = '({search})';
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
      /*scrollY         : 800,
      scrollCollapse  : true,
      scroller        : true,
      scrollX         : true,*/
      fixedColumns    : {
        left          : 1
      },
      fixedHeader     : {
        header        : false
      },
      select          : {style: 'os'},
      language        : idioma_espanol,
      responsive      : "true",
      dom             : 'Blfrtip',
      pageLength      : 25,
      buttons         : [
        {
          extend      : 'excelHtml5',
          text        : '<i class="fas fa-file-excel"></i> ',
          titleAttr   : 'Exportar a Excel',
          className   : 'btn btn-success',
          title       : 'REPORTE COSTO DE ACCIDENTES'
        },
      ],
      "ajax"          : {            
        "url"         : "Ajax.php", 
        "method"      : 'POST',
        "data"        : { MoS:MoS, NombreMoS:NombreMoS, Accion:Accion, fecha_inicio:acci_fecha_inicio, fecha_termino:acci_fecha_termino},
        "dataSrc"     : ""
      },
      "columns"       : columnas_tabla,
      "columnDefs"    : [
        { width       : 100, targets: [0] },
        { width       : 300, targets: [2] },
        { 
          "className" : "text-center", 
          "targets"   : [0,1,3,4,8,9,10]
        },
        { 
          "className" : "text-right", 
          "targets"   : [6,7,8]
        }
      ],
      fixedColumns    : true,
      "order"         : [[0, 'desc']]
    });
  });
  
  ///:: BOTON DESCARGAR INFORME PRELIMINAR PDF ::::::::::::::::::::::::::::::::::::::::::::///
  $(document).on("click", ".btn_ver_ip", function(){
    Acci_TipoImagen = "IP_PDF";
    Acci_Archivo = f_buscar_dato("OPE_AccidentesImagen","Acci_Archivo","`Accidentes_Id`='"+accidentes_id+"' AND `Acci_TipoImagen`='"+Acci_TipoImagen+"'") ;
    if(Acci_Archivo == ""){
      Swal.fire({
          icon: 'error',
          title: 'PDF...',
          text: '*NO se ha registrado el archivo PDF!'
        });
    }else{
      window.open(mi_carpeta+"Services/files/pdf/ip/"+Acci_Archivo,"_blank");
    }
  });

  ///:: BOTON VER DOCUMENTOS ADJUNTOS PDF DE INFORME PRELIMINAR :::::::::::::::::::::::::::///
  $(document).on("click", ".btn_ver_doc_adj", function(){		
    Acci_TipoImagen = "PDF";
    Acci_Archivo = f_buscar_dato("OPE_AccidentesImagen","Acci_Archivo","`Accidentes_Id`='"+accidentes_id+"' AND `Acci_TipoImagen`='"+Acci_TipoImagen+"'") ;
    if(Acci_Archivo == ""){
      Swal.fire({
          icon: 'error',
          title: 'PDF...',
          text: '*NO se ha registrado el archivo PDF!'
        });
    }else{
      window.open(mi_carpeta+"Services/files/pdf/ip/"+Acci_Archivo,"_blank");
    }
  });
  ///:: FIN BOTON VER DOCUMENTOS ADJUNTOS PDF DE INFORME PRELIMINAR :::::::::::::::::::::::///

  ///:: BOTON VER COTIZACION PDF DE COSTO DE ACCIDENTES :::::::::::::::::::::::::::::::::::///
  $(document).on("click", ".btn_ver_cotizacion", function(){		
    let x_pdf     = "";
    let file_pdf  = "COTIZACION IP-"+accidentes_id;
    x_pdf         = f_buscar_pdf('ope_accidentes_costo_imagen','acci_imagen','accidentes_id',accidentes_id,'acci_tipo_imagen','COTIZACION',file_pdf );
    
    if(x_pdf == ""){
        Swal.fire({
            icon: 'error',
            title: 'PDF...',
            text: '*NO se ha registrado el archivo PDF!'
          });
    }else{
      window.open("../../../Services/pdf/"+x_pdf,"_blank");  
      f_unlink_pdf(x_pdf);
    }
  });
  ///:: FIN BOTON VER COTIZACION PDF DE COSTO DE ACCIDENTES :::::::::::::::::::::::::::::::///

  ///:: BOTON ADJUNTAR COTIZACION PDF DE COSTOS DE ACCIDENTES :::::::::::::::::::::::::::::///
  $(document).on("click", ".btn_cargar_cotizacion", function(){		
    if(accidentes_id!=""){
      let buscar_pdf    = "";
      let a_data;
      acci_tipo_imagen  = "COTIZACION";
      file_pdf          = "COTIZACION IP-"+accidentes_id;
      opcion_carga_costo_accidente = "CREAR";
   
      buscar_pdf = f_buscar_pdf('ope_accidentes_costo_imagen', 'acci_imagen', 'accidentes_id', accidentes_id, 'acci_tipo_imagen', acci_tipo_imagen, file_pdf);
      if(buscar_pdf==""){
        opcion_carga_pdf = "CREAR";
      }else{
        opcion_carga_pdf = "EDITAR";
      }
      
      acos_monto_mano_obra  = 0.00;
      acos_monto_insumos    = 0.00;
      acos_costo_manto      = 0.00;
      acos_monto_impuesto   = 0.00;
      acos_monto_cotizado   = 0.00;
      
      a_data = f_BuscarDataBD('ope_accidentes_costo', `acos_accidentes_id`, accidentes_id);
      $.each(a_data, function(idx, obj){ 
        acos_monto_mano_obra  = obj.acos_monto_mano_obra;
        acos_monto_insumos    = obj.acos_monto_insumos;
        acos_costo_manto      = obj.acos_costo_manto;
        acos_monto_impuesto   = obj.acos_monto_impuesto;
        acos_monto_cotizado   = obj.acos_monto_cotizado;
        opcion_carga_costo_accidente = "EDITAR";
      });

      $("#acos_monto_mano_obra").val(acos_monto_mano_obra);
      $("#acos_monto_insumos").val(acos_monto_insumos);
      $("#acos_costo_manto").val(acos_costo_manto);
      $("#acos_monto_impuesto").val(acos_monto_impuesto);
      $("#acos_monto_cotizado").val(acos_monto_cotizado);

      $(".modal-header").css( "background-color", "#17a2b8");
      $(".modal-header").css( "color", "white" );
      $(".modal-title").text("Carga de Cotización PDF");
      $("#label_cargar_pdf").text("Seleccionar Archivo .pdf");
      $('#modal_crud_cargar_pdf').modal('show');
    }else{
      Swal.fire({
        icon  : 'error',
        title : 'ID Accidente...',
        text  : 'No se ha generado el ID Accidente!'
      })    
    }
  });
  ///:: FIN BOTON ADJUNTAR COTIZACION PDF DE COSTOS DE ACCIDENTES :::::::::::::::::::::::::///

  ///:: BOTON CERRAR FIRMA CONVENIO :::::::::::::::::::::::::::::::::::::::::::::::::::::::///
  $(document).on("click", ".btn_firma_convenio", function(){
    Swal.fire({
      title               : '¿Está seguro?',
      text                : "Se cerrará la firma del convenio del Accidente con IP-"+accidentes_id+"!",
      icon                : 'warning',
      showCancelButton    : true,
      confirmButtonColor  : '#3085d6',
      cancelButtonColor   : '#d33',
      confirmButtonText   : 'Si, cerrar!'
    }).then((result) => {
      if (result.isConfirmed) {
          rpta_cerrar_firma_cpomvenio = "CERRAR";
          Accion = 'cerrar_firma_convenio';
          if (rpta_cerrar_firma_cpomvenio == "CERRAR") {
              $.ajax({
                  url         : "Ajax.php",
                  type        : "POST",
                  datatype    : "json",    
                  data        : { MoS:MoS, NombreMoS:NombreMoS, Accion:Accion, accidentes_id:accidentes_id },   
                  success: function() {
                      tabla_costo_accidentes.ajax.reload(null, false);
                      Swal.fire(
                          'Cerrado!',
                          'El registro ha sido cerrado.',
                          'success'
                      )            
                  }
              });
          }
      }
    });
  });
  ///:: FIN BOTON CERRAR FIRMA CONEVNIO :::::::::::::::::::::::::::::::::::::::::::::::::::///

  ///:: BOTON CARGAR PDF -> REALIZA LA GRABACION EN LA TABLA ope_accidentes_costo_imagen ::///
  $('#form_modal_cargar_pdf').submit(function(e){
    e.preventDefault();
    f_grabar_pdf(opcion_carga_pdf, acci_tipo_imagen);
    f_grabar_cotizacion(opcion_carga_costo_accidente);
    $('#modal_crud_cargar_pdf').modal('hide');
  });
  ///:: FIN BOTON CARGAR PDF -> REALIZA LA GRABACION EN LA TABLA OPE_AccidentesImagenes BUS ::///

});


///:: BUSCAR PDF ::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///       
function f_buscar_pdf(p_tabla, p_campo_archivo, p_campo_buscar, p_dato_buscar, p_campo_tipo_archivo, p_dato_tipo_archivo, p_nombre_archivo){
  let pdf="";
  Accion='buscar_pdf';
  $.ajax({
      url       : "Ajax.php",
      type      : "POST",
      datatype  : "json",    
      async     : false,   
      data      : { MoS:MoS, NombreMoS:NombreMoS, Accion:Accion, tabla:p_tabla, campo_archivo:p_campo_archivo, campo_buscar:p_campo_buscar, dato_buscar:p_dato_buscar, campo_tipo_archivo:p_campo_tipo_archivo, dato_tipo_archivo:p_dato_tipo_archivo, nombre_archivo:p_nombre_archivo },   
      success: function(data) {
        pdf = data;
      }
  });	
  return pdf;
}
///:: FIN BUSCAR PDF ::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///

function f_unlink_pdf(p_archivo){
  let rpta_unlink_pdf = "";
  Accion = 'unlink_pdf';
  $.ajax({
      url       : "Ajax.php",
      type      : "POST",
      datatype  : "json",    
      async     : false,   
      data      : { MoS:MoS, NombreMoS:NombreMoS, Accion:Accion, archivo:p_archivo },   
      success: function(data) {
        rpta_unlink_pdf = data;
      }
  });
  return rpta_unlink_pdf;
}

///:: GRABAR IMAGEN :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
function f_grabar_pdf(p_opcion_carga_pdf, p_acci_tipo_imagen){
  let blobFile;
  let formData = new FormData();

  blobFile = $('#cargar_pdf')[0].files[0];
  
  if(blobFile){
    if(p_opcion_carga_pdf=="CREAR"){
      Accion='grabar_imagen';
    }else{
      Accion='editar_imagen';
    }
  
    formData.append("MoS", MoS);
    formData.append("NombreMoS", NombreMoS);
    formData.append("Accion", Accion);
    formData.append("accidentes_id", accidentes_id);
    formData.append("acci_tipo_imagen", p_acci_tipo_imagen);
    formData.append("acci_imagen", blobFile);
    $.ajax({
        url         : "Ajax.php",
        type        : "POST",
        datatype    : "json",
        data        : formData,   
        async       : false,
        contentType : false,
        processData : false,
        success     : function(data) {
        }
    });	  
  }
  
}
///:: FIN GRABAR IMAGEN :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///

///:: GRABAR IMAGEN :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
function f_grabar_cotizacion(p_opcion_carga_costo_accidente){
  if(p_opcion_carga_costo_accidente=="CREAR"){
    Accion='crear_costo_accidente';
  }else{
    Accion='editar_costo_accidente';
  }

  acos_monto_mano_obra  = $("#acos_monto_mano_obra").val();
  acos_monto_insumos    = $("#acos_monto_insumos").val();
  acos_costo_manto      = $("#acos_costo_manto").val();
  acos_monto_impuesto   = $("#acos_monto_impuesto").val();
  acos_monto_cotizado   = $("#acos_monto_cotizado").val();

  $.ajax({
    url         : "Ajax.php",
    type        : "POST",
    datatype    : "json",
    async     : false,   
    data      : { MoS:MoS, NombreMoS:NombreMoS, Accion:Accion, accidentes_id:accidentes_id, acos_monto_mano_obra:acos_monto_mano_obra, acos_monto_insumos:acos_monto_insumos, acos_costo_manto:acos_costo_manto, acos_monto_impuesto:acos_monto_impuesto, acos_monto_cotizado:acos_monto_cotizado },   
    success: function(data) {
      tabla_costo_accidentes.ajax.reload(null, false);
    }
  });	
}
///:: FIN GRABAR IMAGEN :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///

function f_calculo_cotizacion(){
  acos_monto_mano_obra  = $("#acos_monto_mano_obra").val();
  acos_monto_insumos    = $("#acos_monto_insumos").val();
  numb_costo_manto      = Math.round10(parseFloat(acos_monto_mano_obra)+parseFloat(acos_monto_insumos),-2);
  numb_monto_impuesto   = Math.round10(numb_costo_manto*(18/100),-2);
  numb_monto_cotizado   = Math.round10(numb_costo_manto+numb_monto_impuesto,-2);
  acos_costo_manto      = numb_costo_manto.toString();
  acos_monto_impuesto   = numb_monto_impuesto.toString(); 
  acos_monto_cotizado   = numb_monto_cotizado.toString();
  $("#acos_costo_manto").val(acos_costo_manto) ;
  $("#acos_monto_impuesto").val(acos_monto_impuesto);
  $("#acos_monto_cotizado").val(acos_monto_cotizado);
}

///:: FUNCION COLOR A FILAS DATATABLE :::::::::::::::::::::::::::::::::::::::::::::::::::::///
function f_color_filas_costo_accidentes(row,data){
  let color_fondo = "";
  let color_texto = "black";
  // Columna Estado
  switch(data.estado_final)
  {
      case "CERRADO":
          color_fondo = "#53A258";  // verde
          color_texto = "white";
      break;
      case "ABIERTO":
          color_fondo = "#EC515D";  // rojo
      break;
      case "CITACION":
          color_fondo = "#00A3D6";  // celeste
      break;
      case "PENDIENTE":
          color_fondo = "#FF9D0A";  // naranja
      break;
      case "PENDIENTE":
          color_fondo = "#EC515D";  // rojo
      break;
  }
  $("td:eq(8)",row).css({
    "color"       : color_texto,
    "background"  : color_fondo,
    "font-weight" : "bold",
  });
  
  color_fondo = "";
  color_texto = "black";
  // Columna Estado
  switch(data.firma_convenio)
  {
      case "CERRADO":
          color_fondo = "#53A258";  // verde
          color_texto = "white";
      break;
      case "ABIERTO":
          color_fondo = "#EC515D";  // rojo
      break;
      case "CITACION":
          color_fondo = "#00A3D6";  // celeste
      break;
      case "PENDIENTE":
          color_fondo = "#FF9D0A";  // naranja
      break;
      case "PENDIENTE":
          color_fondo = "#EC515D";  // rojo
      break;
  }
  $("td:eq(10)",row).css({
    "color"       : color_texto,
    "background"  : color_fondo,
    "font-weight" : "bold",
  });

}
///:: FIN FUNCION COLOR A FILAS DATATABLE::::::::::::::::::::::::::::::::::::::::::::::::::///

(function() {
  /**
   * Ajuste decimal de un número.
   *
   * @param {String}  tipo  El tipo de ajuste.
   * @param {Number}  valor El numero.
   * @param {Integer} exp   El exponente (el logaritmo 10 del ajuste base).
   * @returns {Number} El valor ajustado.
   */
  function decimalAdjust(type, value, exp) {
    // Si el exp no está definido o es cero...
    if (typeof exp === 'undefined' || +exp === 0) {
      return Math[type](value);
    }
    value = +value;
    exp = +exp;
    // Si el valor no es un número o el exp no es un entero...
    if (isNaN(value) || !(typeof exp === 'number' && exp % 1 === 0)) {
      return NaN;
    }
    // Shift
    value = value.toString().split('e');
    value = Math[type](+(value[0] + 'e' + (value[1] ? (+value[1] - exp) : -exp)));
    // Shift back
    value = value.toString().split('e');
    return +(value[0] + 'e' + (value[1] ? (+value[1] + exp) : exp));
  }

  // Decimal round
  if (!Math.round10) {
    Math.round10 = function(value, exp) {
      return decimalAdjust('round', value, exp);
    };
  }
  // Decimal floor
  if (!Math.floor10) {
    Math.floor10 = function(value, exp) {
      return decimalAdjust('floor', value, exp);
    };
  }
  // Decimal ceil
  if (!Math.ceil10) {
    Math.ceil10 = function(value, exp) {
      return decimalAdjust('ceil', value, exp);
    };
  }
})();
