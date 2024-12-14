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
  ///:: FIN EVENTO DE BOTON VER INASIETNCIAS ::::::::::::::::::::::::::::::::::::::::::::::///

  ///:: TERMINO BOTONES ACCIDENTES GDH ::::::::::::::::::::::::::::::::::::::::::::::::::::///
});

///:: TERMINO JS DOM ACCIDENTES GDH :::::::::::::::::::::::::::::::::::::::::::::::::::::::///