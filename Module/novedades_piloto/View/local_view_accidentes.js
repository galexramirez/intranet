///::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
///:: ACCIDENTES GDH v 1.0  FECHA: 2023-05-02 :::::::::::::::::::::::::::::::::::::::::::::///
///:: MOSTRAR ACCIDENTES REPORTADOS A GDH :::::::::::::::::::::::::::::::::::::::::::::::::///
///::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///

///:: DECLARACION DE VARIABLES ::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
var tabla_accidentes, acci_fecha_inicio, acci_fecha_termino;
acci_fecha_inicio  = "";
acci_fecha_termino = "";

///:: INICIO JS DOM ACCIDENTES GDH ::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
$(document).ready(function(){
  if(acci_fecha_inicio=="" && acci_fecha_termino==""){
    acci_fecha_inicio   = f_CalculoFecha("hoy","-1 month");
    acci_fecha_termino  = f_CalculoFecha("hoy","0");
    $('#acci_fecha_inicio').val(acci_fecha_inicio);
    $('#acci_fecha_termino').val(acci_fecha_termino);
  }

  // Si hay cambios en el Fecha se ocultan botones y datatable
  $("#acci_fecha_inicio").on('change', function () {
    $("#tabla_accidentes").dataTable().fnDestroy();
    $('#tabla_accidentes').hide();  
  });

  $("#acci_fecha_termino").on('change', function () {
    $("#tabla_accidentes").dataTable().fnDestroy();
    $('#tabla_accidentes').hide();
  });

  ///:: INICIO BOTONES ACCIDENTES GDH :::::::::::::::::::::::::::::::::::::::::::::::::::::///

  ///:: BOTON LISTAR ACCIDENTES GDH :::::::::::::::::::::::::::::::::::::::::::::::::::::::///
  $(document).on("click", ".btn_buscar_accidentes", function(){
    acci_fecha_inicio   = $("#acci_fecha_inicio").val();
    acci_fecha_termino  = $("#acci_fecha_termino").val();

    div_tablas      = f_CreacionTabla("tabla_accidentes","");
    columnas_tabla  = f_ColumnasTabla("tabla_accidentes","");
    $('#div_tabla_accidentes').html(div_tablas);
  
    // Setup - add a text input to each footer cell
    $('#tabla_accidentes thead tr')
      .clone(true)
      .addClass('filters_accidentes')
      .appendTo('#tabla_accidentes thead');
  
    $("#tabla_accidentes").dataTable().fnDestroy();
    $('#tabla_accidentes').show();

    Accion = 'buscar_accidentes';
    tabla_accidentes = $('#tabla_accidentes').DataTable({
      //Filtros por columnas
      orderCellsTop: true,
      fixedHeader: true,
      initComplete: function (){
        var api = this.api();
        // For each column
        api.columns().eq(0).each(function (colIdx) {
          // Set the header cell to contain the input element
          var cell = $('.filters_accidentes th').eq($(api.column(colIdx).header()).index());
          var title = $(cell).text();
          $(cell).html('<input type="text" placeholder="' + title + '" />');
          // On every keypress in this input
          $('input',$('.filters_accidentes th').eq($(api.column(colIdx).header()).index()) ).off('keyup change').on('keyup change', function (e) {
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
      /*
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
      */
      select          : {style: 'os'},
      language        : idiomaEspanol,
      responsive      : "true",
      dom             : 'Blfrtip',
      pageLength      : 50,
      buttons         : [
        {
          extend      : 'excelHtml5',
          text        : '<i class="fas fa-file-excel"></i> ',
          titleAttr   : 'Exportar a Excel',
          className   : 'btn btn-success',
          title       : 'REPORTE ACCIDENTES'
        },
      ],
      "ajax"          : {            
        "url"         : "Ajax.php", 
        "method"      : 'POST',
        "data"        : {MoS:MoS, NombreMoS:NombreMoS, Accion:Accion, fecha_inicio:acci_fecha_inicio, fecha_termino:acci_fecha_termino},
        "dataSrc"     : ""
      },
      "columns": columnas_tabla,
      "columnDefs"      : [
        {   width       : 800, targets: [8] },
        {
          "targets"     : [0],
          "orderable"   : false
        },
        { 
          "className"   : "text-center",
          "targets"     : [2,3,4,11,13,14]
        },
      ],
      "order"           : [[1, 'desc']]
    });
  });

  ///:: EVENTO DE BOTON VER ACCIDENTES ::::::::::::::::::::::::::::::::::::::::::::::::::::///
  $(document).on("click", ".btn_ver_accidentes", function(){
    $("#form_modal_ver_accidentes").trigger("reset");
    let fila_accidentes = $(this).closest('tr'); 
    let accidentes_id  = fila_accidentes.find('td:eq(1)').text();

    let x_pdf     = "";
    let file_pdf  = "IP-"+accidentes_id;
    x_pdf         = f_buscar_pdf('OPE_AccidentesImagen','Acci_Imagen','Accidentes_Id',accidentes_id,'Acci_TipoImagen','IP_PDF',file_pdf );
    
    if(x_pdf == ""){
      Swal.fire({
        icon  : 'error',
        title : 'PDF...',
        text  : '*NO se ha registrado el archivo PDF!'
      });
    }else{
      window.open("../../../Services/pdf/"+x_pdf,"_blank");
      f_unlink_pdf(x_pdf);
    }

  });
  ///:: FIN EVENTO DE BOTON VER INASIETNCIAS ::::::::::::::::::::::::::::::::::::::::::::::///

  ///:: BOTON DESCARGAR ACCIDENTES ::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
  $(document).on("click", ".btn_descargar_accidentes", function(){		
    rgdh_fecha_inicio   = $("#rgdh_fecha_inicio").val();
    rgdh_fecha_termino  = $("#rgdh_fecha_termino").val();
    Accion          = 'descargar_accidentes';
    $.ajax({
        url         : "Ajax.php",
        type        : "POST",
        datatype    : "json",
        async       : false,
        data        : {MoS:MoS, NombreMoS:NombreMoS, Accion:Accion,  fecha_inicio:rgdh_fecha_inicio, fecha_termino:rgdh_fecha_termino},
        beforeSend  : function(){
            Swal.fire({
              icon              : 'success',
              title             : 'Procesando Información',
              showConfirmButton : false,
              timer             : 5000
            })
        },
        success     : function(data){
            window.location.href = mi_carpeta + "Module/novedades_piloto/Controller/csv_descarga_accidentes.php?Archivo=" + data;
        }
    });
  });
  ///:: FIN BOTON DESCARGAR ACCIDENTES ::::::::::::::::::::::::::::::::::::::::::::::::::::///

  ///:: TERMINO BOTONES ACCIDENTES GDH ::::::::::::::::::::::::::::::::::::::::::::::::::::///
});

///:: TERMINO JS DOM ACCIDENTES GDH :::::::::::::::::::::::::::::::::::::::::::::::::::::::///

///:: FUNCIONES DE ACCIDENTES GDH :::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
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


///:: TERMINO FUNCIONES DE ACCIDENTES GDH :::::::::::::::::::::::::::::::::::::::::::::::::///