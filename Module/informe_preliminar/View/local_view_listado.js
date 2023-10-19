///::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
///:: LISTADO INFORME PRELIMINAR v 1.0  FECHA: 2023-05-15::::::::::::::::::::::::::::::::::///
///:: MOSTRAR INFORME PRELIMINAR ::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
///::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///

///:: DECLARACION DE VARIABLES ::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
var tabla_informe_preliminar, acci_fecha_inicio, acci_fecha_termino, fila_informe_preliminar, accidentes_id;
acci_fecha_inicio  = "";
acci_fecha_termino = "";

///:: JS DOM COSTO DE ACCIDENTES ::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
$(document).ready(function(){
  div_boton = f_BotonesFormulario("form_seleccion_informe_preliminar","div_seleccion_informe_preliminar");
  $("#div_seleccion_informe_preliminar").html(div_boton);

  if(acci_fecha_inicio=="" && acci_fecha_termino==""){
    acci_fecha_inicio   = f_CalculoFecha("hoy","0");
    acci_fecha_termino  = f_CalculoFecha("hoy","0");
    $('#acci_fecha_inicio').val(acci_fecha_inicio);
    $('#acci_fecha_termino').val(acci_fecha_termino);
  }

  // Si hay cambios en el Fecha se ocultan botones y datatable
  $("#acci_fecha_inicio").on('change', function () {
    $("#tabla_informe_preliminar").dataTable().fnDestroy();
    $('#tabla_informe_preliminar').hide();  
  });

  $("#acci_fecha_termino").on('change', function () {
    $("#tabla_informe_preliminar").dataTable().fnDestroy();
    $('#tabla_informe_preliminar').hide();
  });

  ///:: BOTONES COSTO DE ACCIDENTES :::::::::::::::::::::::::::::::::::::::::::::::::::::::///

  ///:: BOTON LISTAR COSTO DE ACCIDENTES ::::::::::::::::::::::::::::::::::::::::::::::::::///
  $(document).on("click", ".btn_buscar_informe_preliminar", function(){
    acci_fecha_inicio   = $("#acci_fecha_inicio").val();
    acci_fecha_termino  = $("#acci_fecha_termino").val();

    div_tablas      = f_CreacionTabla("tabla_informe_preliminar","");
    columnas_tabla  = f_ColumnasTabla("tabla_informe_preliminar","");
    $('#div_tabla_informe_preliminar').html(div_tablas);
  
    // Setup - add a text input to each footer cell
    $('#tabla_informe_preliminar thead tr')
      .clone(true)
      .addClass('filters_informe_preliminar')
      .appendTo('#tabla_informe_preliminar thead');
  
    $("#tabla_informe_preliminar").dataTable().fnDestroy();
    $('#tabla_informe_preliminar').show();

    Accion = 'buscar_informe_preliminar';
    tabla_informe_preliminar = $('#tabla_informe_preliminar').DataTable({
    //Filtros por columnas
    orderCellsTop: true,
    fixedHeader: true,
    initComplete: function (){
      var api = this.api();
      // For each column
      api.columns().eq(0).each(function (colIdx) {
        // Set the header cell to contain the input element
        var cell = $('.filters_informe_preliminar th').eq($(api.column(colIdx).header()).index());
        var title = $(cell).text();
        $(cell).html('<input type="text" placeholder="' + title + '" />');
        // On every keypress in this input
        $('input',$('.filters_informe_preliminar th').eq($(api.column(colIdx).header()).index()) ).off('keyup change').on('keyup change', function (e) {
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
    /*deferRender:    true,
    scrollY:        800,
    scrollCollapse: true,
    scroller:       true,
    scrollX:        true,
    fixedColumns:
    {
      left: 1
    },
    fixedHeader:
    {
      header : false
    },*/
      select          : {style: 'os'},
      language          : idioma_espanol,
      responsive        : "true",
      dom               : 'Blfrtip',
      pageLength        : 50,
      buttons           : [
        {
          extend        : 'excelHtml5',
          text          : '<i class="fas fa-file-excel"></i> ',
          titleAttr     : 'Exportar a Excel',
          className     : 'btn btn-success',
          title         : 'REPORTE DE INFORME PRELIMINAR'
        }
      ],
      "ajax"            : {            
        "url"           : "Ajax.php", 
        "method"        : 'POST',
        "data"          : { MoS:MoS, NombreMoS:NombreMoS, Accion:Accion, fecha_inicio:acci_fecha_inicio, fecha_termino:acci_fecha_termino},
        "dataSrc"       : ""
      },
      "columns"         : columnas_tabla,
      "columnDefs"      : [
        { 
          "className"   : "text-center",
          "targets"     : [2,3,5,6,13,14]
        },
        {
          "targets"     : [0,1],
          "orderable"   : false
        },
        {
          "targets"     : [1],
          "render"      : function(data, type, row, meta) {
            if(data!=null){
              return "<div class='text-center'><div class='btn-group'><button title='DOC.ADJ.' class='btn btn-primary btn-sm btn_documentos_adjuntos_pdf'><i class='bi bi-eye'><svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-eye' viewBox='0 0 16 16'><path d='M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z'/><path d='M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z'/></svg></i></button></div></div>";
            }else{
              return "";
            }
          }
        },   
      ],
      "order"           : [[2, 'desc']]
    });
  });

  ///:: BOTON DESCARGAR INFORME PRELIMINAR PDF ::::::::::::::::::::::::::::::::::::::::::::///
  $(document).on("click", ".btn_ip_pdf", function(){
    fila_informe_preliminar = $(this).closest('tr'); 
    accidentes_id           = fila_informe_preliminar.find('td:eq(2)').text();
    let x_pdf               = "";
    let file_pdf            = "IP-"+accidentes_id;
    x_pdf                   = f_buscar_pdf('OPE_AccidentesImagen','Acci_Imagen','Accidentes_Id',accidentes_id,'Acci_TipoImagen','IP_PDF',file_pdf );
    
    if(x_pdf == ""){
      Swal.fire({
        icon  : 'error',
        title : 'PDF...',
        text  : '*NO se ha registrado el archivo PDF!'
      });
    }else{
      //window.open("../../../Services/pdf/"+x_pdf,"_blank");
      let enlace = document.createElement('a');
      enlace.href = "../../../Services/pdf/"+x_pdf;
      enlace.download = x_pdf;
      enlace.click();
      f_unlink_pdf(x_pdf);
    }
  });

  ///:: BOTON VER DOCUMENTOS ADJUNTOS PDF DE INFORME PRELIMINAR :::::::::::::::::::::::::::///
  $(document).on("click", ".btn_documentos_adjuntos_pdf", function(){		
    fila_informe_preliminar = $(this).closest('tr'); 
    accidentes_id           = fila_informe_preliminar.find('td:eq(2)').text();
    let x_pdf               = "";
    let file_pdf            = "DOCUMENTOS ADJUNTOS IP-"+accidentes_id;
    x_pdf                   = f_buscar_pdf('OPE_AccidentesImagen','Acci_Imagen','Accidentes_Id',accidentes_id,'Acci_TipoImagen','PDF',file_pdf );
    
    if(x_pdf == ""){
      Swal.fire({
        icon  : 'error',
        title : 'PDF...',
        text  : '*NO se ha registrado el archivo PDF!'
      });
    }else{
      //window.open("../../../Services/pdf/"+x_pdf,"_blank");
      let enlace = document.createElement('a');
      enlace.href = "../../../Services/pdf/"+x_pdf;
      enlace.download = x_pdf;
      enlace.click();
      f_unlink_pdf(x_pdf);
    }
  });
  ///:: FIN BOTON VER DOCUMENTOS ADJUNTOS PDF DE INFORME PRELIMINAR :::::::::::::::::::::::///

  ///:: BOTON PARA LA DESCARGA DE ARCHIVO CSV :::::::::::::::::::::::::::::::::::::::::::::///
  $("#btn_descargar_informe_preliminar").on("click",function(){
    acci_fecha_inicio   = $("#acci_fecha_inicio").val();
    acci_fecha_termino  = $("#acci_fecha_termino").val();
    Accion = 'descargar_informe_preliminar';
    $.ajax({
        url       : "Ajax.php",
        type      : "POST",
        datatype  :"json",
        async: false,
        data: { MoS:MoS, NombreMoS:NombreMoS, Accion:Accion, fecha_inicio:acci_fecha_inicio, fecha_termino:acci_fecha_termino },
        beforeSend: function(){
          Swal.fire({
            icon: 'success',
            title: 'Procesando Información',
            showConfirmButton: false,
            timer: 5000
          })
        },
        success: function(data){
          window.location.href = mi_carpeta + "Module/informe_preliminar/Controller/csv_descarga.php?Archivo=" + data ;
        }
    });
  });
  ///:: FIN BOTON PARA LA DESCARGA DE ARCHIVO CSV :::::::::::::::::::::::::::::::::::::::::///

});


///:: BUSCAR PDF ::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///       
function f_BuscarPDF(p_Acci_TipoImagen){
  let pdf="";
  Accion='buscar_imagen';
  $.ajax({
      url       : "Ajax.php",
      type      : "POST",
      datatype  : "json",    
      async     : false,   
      data      : { MoS:MoS,NombreMoS:NombreMoS,Accion:Accion,accidentes_id:accidentes_id,Acci_TipoImagen:p_Acci_TipoImagen },   
      success: function(data) {
          data = $.parseJSON(data);
          $.each(data, function(idx, obj){ 
              if(obj.b64_Foto){
                  pdf  = "data:application/pdf;base64," + obj.b64_Foto;
              }
          });
      }
  });	
  return pdf;
}
///:: FIN BUSCAR PDF ::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///

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

