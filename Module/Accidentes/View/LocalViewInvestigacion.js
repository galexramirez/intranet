///::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
///:: TAB INVESTIGACION v 2.0  FECHA: 2023-05-02 ::::::::::::::::::::::::::::::::::::::::::///
///:: CREAR, EDITAR TABLA OPE_AccidentesInvestigacion :::::::::::::::::::::::::::::::::::::///
///::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///

///:: DECLARACION DE VARIABLES ::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
var Investigacion_Id, Acci_Trafico, Acci_GravedadEvento, Acci_DatosRegistro, Acci_FactorDeterminante, Acci_ResponsabilidadDeterminante, Acci_FactorContributivo, Acci_ResponsabilidadContributivo, Acci_TipoExpediente, Acci_EventoReportado, Acci_ResponsabilidadAccidente, Acci_GradoFalta, Acci_Reincidencia, Acci_CodigoRIT, Acci_DescripcionRIT, Acci_AccionDisciplinaria, Acci_ReporteGDH, Acci_FechaReporteGDH, Acci_Premio, Acci_FechaCierreReporte, Acci_TiempoInvestigacion, Acci_CumplimientoMeta, Acci_RatioCumplimiento, Acci_DelayRegistro, Acci_CumplimientoRegistro, Acci_FechaRegistro, Acci_LugarReferencia, Acci_Frecuencia, Acci_Probabilidad, Acci_Severidad, acci_log_informe_final, acci_nro_siniestro, acci_doc_reporte_atencion_rimac;
var Acci_EstadoInvestigacion, opcionInvestigacion, filaInvestigacion;
var inv_FechaInicio, inv_FechaTermino;

inv_FechaInicio = "";
inv_FechaTermino = "";

///::::::::::::::::::::::::: DOM INFORME PRELIMINAR :::::::::::::::::::::::::::::::::::::::::::::::::///
$(document).ready(function(){
  ///:: boton para cerrar informe preliminar
  div_boton = f_BotonesFormulario("form_informe_final","div_btn_cerrar_informe_final");
  $("#div_btn_cerrar_informe_final").html(div_boton);
  
  if(inv_FechaInicio=="" && inv_FechaTermino==""){
    inv_FechaInicio  = f_CalculoFecha("hoy","0");
    inv_FechaTermino = f_CalculoFecha("hoy","0");
    $('#inv_FechaInicio').val(inv_FechaInicio);
    $('#inv_FechaTermino').val(inv_FechaTermino);
  }

  // Si hay cambios en el Fecha se ocultan botones y datatable
  $("#inv_FechaInicio").on('change', function () {
    $("#tablaInvestigacion").dataTable().fnDestroy();
    $('#tablaInvestigacion').hide();  
  });

  $("#inv_FechaTermino").on('change', function () {
    $("#tablaInvestigacion").dataTable().fnDestroy();
    $('#tablaInvestigacion').hide();  
  });

  // Creación de Tablas
  div_tablas = f_CreacionTabla("tablaInvestigacion","");
  $('#div_tablaInvestigacion').html(div_tablas);
  $("#tablaInvestigacion").hide()

  // Setup - add a text input to each footer cell
  $('#tablaInvestigacion thead tr')
    .clone(true)
    .addClass('filtersInvestigacion')
    .appendTo('#tablaInvestigacion thead');

  // SI HAY CAMBIOS EN FRECUENCIA SE ACTUALIZA GRAVEDAD DE EVENTO
  $("#Acci_Frecuencia").on('change', function () {
    Acci_Frecuencia     = $("#Acci_Frecuencia").val();
    Acci_Probabilidad   = $("#Acci_Probabilidad").val();
    Acci_Severidad      = $("#Acci_Severidad").val();
    Acci_GravedadEvento = f_GravedadEvento(Acci_Frecuencia,Acci_Probabilidad,Acci_Severidad);
    $("#Acci_GravedadEvento").val(Acci_GravedadEvento);
  });

  ///:: SI HAY CAMBIOS EN PROBABILIDAD SE ACTUALIZA GRAVEDAD DE EVENTO
  $("#Acci_Probabilidad").on('change', function () {
    Acci_Frecuencia     = $("#Acci_Frecuencia").val();
    Acci_Probabilidad   = $("#Acci_Probabilidad").val();
    Acci_Severidad      = $("#Acci_Severidad").val();
    Acci_GravedadEvento = f_GravedadEvento(Acci_Frecuencia,Acci_Probabilidad,Acci_Severidad);
    $("#Acci_GravedadEvento").val(Acci_GravedadEvento);
  });

  ///:: SI HAY CAMBIOS EN SEVERIDAD SE ACTUALIZA GRAVEDAD DE EVENTO
  $("#Acci_Severidad").on('change', function () {
    Acci_Frecuencia     = $("#Acci_Frecuencia").val();
    Acci_Probabilidad   = $("#Acci_Probabilidad").val();
    Acci_Severidad      = $("#Acci_Severidad").val();
    Acci_GravedadEvento = f_GravedadEvento(Acci_Frecuencia,Acci_Probabilidad,Acci_Severidad);
    $("#Acci_GravedadEvento").val(Acci_GravedadEvento);
  });

  ///:: SI HAY CAMBIOS EN RESPONSABILIDAD CONTRIBUTIVA SE ACTUALIZA RESPONSABILIDAD ACCIDENTE
  $("#Acci_ResponsabilidadContributivo").on('change', function () {
    Acci_ResponsabilidadContributivo  = $("#Acci_ResponsabilidadContributivo").val();
    Acci_ResponsabilidadDeterminante  = $("#Acci_ResponsabilidadDeterminante").val();
    Acci_ResponsabilidadAccidente     = f_ResponsabilidadAccidente(Acci_ResponsabilidadContributivo,Acci_ResponsabilidadDeterminante);
    $("#Acci_ResponsabilidadAccidente").val(Acci_ResponsabilidadAccidente);
  });

  ///:: SI HAY CAMBIOS EN RESPONSABILIDAD DETERMINANTE SE ACTUALIZA RESPONSABILIDAD ACCIDENTE
  $("#Acci_ResponsabilidadDeterminante").on('change', function () {
    Acci_ResponsabilidadContributivo  = $("#Acci_ResponsabilidadContributivo").val();
    Acci_ResponsabilidadDeterminante  = $("#Acci_ResponsabilidadDeterminante").val();
    Acci_ResponsabilidadAccidente     = f_ResponsabilidadAccidente(Acci_ResponsabilidadContributivo,Acci_ResponsabilidadDeterminante);
    $("#Acci_ResponsabilidadAccidente").val(Acci_ResponsabilidadAccidente);
  });

  ///:: SI HAY CAMBIOS EN GRADO FALTA SE ACTUALIZA CODIGO RIT :::::::::::::::::::::::::::::///
  $("#Acci_GradoFalta").on('change', function () {
    Acci_GradoFalta = $("#Acci_GradoFalta").val();
    t_html = f_CodigoRIT(Acci_GradoFalta);
    $("#Acci_CodigoRIT").html(t_html);
  });

  ///:: SI HAY CAMBIOS EN CODIGO RIT SE ACTUALIZA DESCRIPCION RIT :::::::::::::::::::::::::///
  $("#Acci_CodigoRIT").on('change', function () {
    Acci_CodigoRIT    = $("#Acci_CodigoRIT").val();
    Acci_Reincidencia = $("#Acci_Reincidencia").val();
    Acci_GradoFalta   = $("#Acci_GradoFalta").val();
    Accion = 'DescripcionRIT';
    $.ajax({
      url       : "Ajax.php",
      type      : "POST",
      datatype  : "json",
      async     : false,
      data      : {MoS:MoS, NombreMoS:NombreMoS, Accion:Accion, Acci_CodigoRIT:Acci_CodigoRIT, Acci_GradoFalta:Acci_GradoFalta},
      success   : function(data){
        Acci_DescripcionRIT = data;
      }
    });
    $("#Acci_DescripcionRIT").val(Acci_DescripcionRIT);
    Accion = 'AccionDisciplinaria';
    $.ajax({
      url       : "Ajax.php",
      type      : "POST",
      datatype  : "json",
      async     : false,
      data      : {MoS:MoS, NombreMoS:NombreMoS, Accion:Accion, Acci_CodigoRIT:Acci_CodigoRIT, Acci_Reincidencia:Acci_Reincidencia},
      success   : function(data){
        Acci_AccionDisciplinaria = data;
      }
    });
    $("#Acci_AccionDisciplinaria").val(Acci_AccionDisciplinaria);
  });


  // SI HAY CAMBIOS EN TIPO DE EXPEDIENTE SE CALCULA EL CUMPLIMIENTO DE LA META
  $("#Acci_TipoExpediente").on('change', function () {
    Acci_TipoExpediente = $("#Acci_TipoExpediente").val();
    // SE GENERA EL CUMPLIENTO DE LA META
    Accion = 'CumplimientoMeta';
    $.ajax({
      url       : "Ajax.php",
      type      : "POST",
      datatype  : "json",
      async     : false,
      data      : {MoS:MoS, NombreMoS:NombreMoS, Accion:Accion, Acci_TipoExpediente:Acci_TipoExpediente, Acci_TiempoInvestigacion:Acci_TiempoInvestigacion},
      success   : function(data){
        Acci_CumplimientoMeta = data;
      }
    });
    $("#Acci_CumplimientoMeta").val(Acci_CumplimientoMeta);
  });

  //:: BOTON GRABAR -> REALIZA LA GRABACION EN LA TABLA OPE_AccidentesInvestigacion
  $('#form_informe_final').submit(function(e){
    e.preventDefault(); //evita el comportambiento normal del submit, es decir, recarga total de la página
    let tValidaInvestigacion = "invalido";
    f_CargarVariablesEditadasInvestigacion();
    
    Acci_EstadoInformePreliminar = "";
    let adata = f_BuscarDataBD("OPE_AccidentesInformePreliminar","Accidentes_Id",Investigacion_Id);
    $.each(adata, function(idx, obj){
      Acci_EstadoInformePreliminar = obj.Acci_EstadoInformePreliminar;
    });
    
    if(Acci_EstadoInformePreliminar=="ABIERTO"){
      Swal.fire({
        icon: 'error',
        title: 'INFORME PRELIMINAR...',
        text: '*Estado debe estar Cerrado!!!'
      })
    }else{
      tValidaInvestigacion = f_ValidarInvestigacion(Acci_FactorDeterminante, Acci_FactorContributivo, Acci_ResponsabilidadDeterminante, Acci_ResponsabilidadContributivo, Acci_TipoExpediente, Acci_EventoReportado, Acci_GradoFalta, Acci_CodigoRIT, Acci_LugarReferencia, Acci_Frecuencia, Acci_Probabilidad, Acci_Severidad, acci_nro_siniestro);

      if(tValidaInvestigacion==""){
        // CREAR Investigacion
        if(opcionInvestigacion==1){
          Accion = "CrearInvestigacion";
          $("#btn_informe_final").prop("disabled",true);
          $.ajax({
            url       : "Ajax.php",
            type      : "POST",
            datatype  : "json",
            data      : { MoS:MoS, NombreMoS:NombreMoS, Accion:Accion, Accidentes_Id:Investigacion_Id, Acci_DatosRegistro:Acci_DatosRegistro, Acci_Trafico:Acci_Trafico, Acci_LugarReferencia:Acci_LugarReferencia, Acci_FactorDeterminante:Acci_FactorDeterminante, Acci_ResponsabilidadDeterminante:Acci_ResponsabilidadDeterminante,Acci_FactorContributivo:Acci_FactorContributivo, Acci_ResponsabilidadContributivo:Acci_ResponsabilidadContributivo, Acci_TipoExpediente:Acci_TipoExpediente,Acci_EventoReportado:Acci_EventoReportado, Acci_Frecuencia:Acci_Frecuencia, Acci_Probabilidad:Acci_Probabilidad, Acci_Severidad:Acci_Severidad,Acci_GravedadEvento:Acci_GravedadEvento, Acci_ResponsabilidadAccidente:Acci_ResponsabilidadAccidente, Acci_GradoFalta:Acci_GradoFalta, Acci_Reincidencia:Acci_Reincidencia, Acci_CodigoRIT:Acci_CodigoRIT, Acci_DescripcionRIT:Acci_DescripcionRIT, Acci_AccionDisciplinaria:Acci_AccionDisciplinaria, Acci_FechaReporteGDH:Acci_FechaReporteGDH, Acci_ReporteGDH:Acci_ReporteGDH, Acci_Premio:Acci_Premio, Acci_FechaCierreReporte:Acci_FechaCierreReporte, Acci_TiempoInvestigacion:Acci_TiempoInvestigacion, Acci_CumplimientoMeta:Acci_CumplimientoMeta, Acci_DelayRegistro:Acci_DelayRegistro, Acci_CumplimientoRegistro:Acci_CumplimientoRegistro, Acci_FechaRegistro:Acci_FechaRegistro, Acci_FechaCierreAccidente:Acci_FechaCierreReporte, acci_nro_siniestro:acci_nro_siniestro},
            success   : function(data){
              tablaInvestigacion.ajax.reload(null, false);
            }
          });
        }
        // EDITAR Investigacion
        if (opcionInvestigacion==2){
          Accion = "EditarInvestigacion";
          $("#btn_guardar_informe_final").prop("disabled",true);
          $.ajax({
            url       : "Ajax.php",
            type      : "POST",
            datatype  : "json",
            data      : {MoS:MoS,NombreMoS:NombreMoS, Accion:Accion, Accidentes_Id:Investigacion_Id, Acci_DatosRegistro:Acci_DatosRegistro, Acci_Trafico:Acci_Trafico, Acci_LugarReferencia:Acci_LugarReferencia, Acci_FactorDeterminante:Acci_FactorDeterminante, Acci_ResponsabilidadDeterminante:Acci_ResponsabilidadDeterminante,Acci_FactorContributivo:Acci_FactorContributivo, Acci_ResponsabilidadContributivo:Acci_ResponsabilidadContributivo, Acci_TipoExpediente:Acci_TipoExpediente,Acci_EventoReportado:Acci_EventoReportado, Acci_Frecuencia:Acci_Frecuencia, Acci_Probabilidad:Acci_Probabilidad, Acci_Severidad:Acci_Severidad,Acci_GravedadEvento:Acci_GravedadEvento, Acci_ResponsabilidadAccidente:Acci_ResponsabilidadAccidente, Acci_GradoFalta:Acci_GradoFalta, Acci_Reincidencia:Acci_Reincidencia, Acci_CodigoRIT:Acci_CodigoRIT, Acci_DescripcionRIT:Acci_DescripcionRIT, Acci_AccionDisciplinaria:Acci_AccionDisciplinaria, Acci_FechaReporteGDH:Acci_FechaReporteGDH, Acci_ReporteGDH:Acci_ReporteGDH, Acci_Premio:Acci_Premio, Acci_FechaCierreReporte:Acci_FechaCierreReporte, Acci_TiempoInvestigacion:Acci_TiempoInvestigacion,Acci_CumplimientoMeta:Acci_CumplimientoMeta, Acci_DelayRegistro:Acci_DelayRegistro, Acci_CumplimientoRegistro:Acci_CumplimientoRegistro,Acci_FechaRegistro:Acci_FechaRegistro, Acci_FechaCierreAccidente:Acci_FechaCierreReporte, acci_nro_siniestro:acci_nro_siniestro},    
            success   : function(data){
              tablaInvestigacion.ajax.reload(null, false);
            }
          });
        }
        $('#modalCRUDInvestigacion').modal('hide');
      }else{
        Swal.fire({
          icon  : 'error',
          title : 'INFORME FINAL...',
          text  : '*Falta completar información!!!'
        })
      }  
    }
  });

  ///::::::::  BOTON DESCARGAR INFORME PRELIMINAR PDF  ::::::::::///
  $(document).on("click", ".btnFilePDF", function(){
    filaInvestigacion   = $(this).closest('tr'); 
    Investigacion_Id    = filaInvestigacion.find('td:eq(0)').text();
    if(Investigacion_Id!=""){
      Accion = "PDFInformePreliminar";
      $.ajax({
        url       : "Ajax.php", 
        type      : "POST",
        datatype  : "json",    
        async     : false,   
        data      : { MoS:MoS,NombreMoS:NombreMoS,Accion:Accion,Accidentes_Id:Investigacion_Id },   
        success   : function(data) {
          window.location.href = miCarpeta + "Module/Accidentes/Controller/PDF_InformePreliminar.php?Id_DateJS=" + data;
          tablaAccidentes.ajax.reload(toggleZoomScreen(),false);
        }
      });
    }else{
      Swal.fire({
        icon: 'error',
        title: 'ID Accidente...',
        text: 'No se ha generado el ID Accidente!'
      })    
    }
  });

  ///::::::::  BOTON DESCARGAR DOCUMENTOS ADJUNTOS PDF  ::::::::::///
  $(document).on("click", ".btn_ver_documentos_adjuntos", function(){
    filaInvestigacion   = $(this).closest('tr'); 
    Investigacion_Id    = filaInvestigacion.find('td:eq(0)').text();
    let x_pdf     = "";
    let file_pdf  = "DOC_ADJUNTO IP-"+Investigacion_Id;
    x_pdf         = f_buscar_pdf('OPE_AccidentesImagen','Acci_Imagen','Accidentes_Id',Investigacion_Id,'Acci_TipoImagen','PDF',file_pdf );
    if(x_pdf == ""){
        Swal.fire({
            icon: 'error',
            title: 'PDF...',
            text: '*NO se ha registrado el archivo PDF!'
          });
    }else{
      //window.open("../../../Services/pdf/"+x_pdf,"_blank");
      //f_unlink_pdf(x_pdf);
      let enlace = document.createElement('a');
      enlace.href = "../../../Services/pdf/"+x_pdf;
      enlace.download = x_pdf;
      enlace.click();
      f_unlink_pdf(x_pdf);

    }
  });

  ///:: BOTON ABRIR INFORME FINAL ::::::::::::::::::::::::::::::::::::::::::::::::::::///
  $("#btn_abrir_informe_final").on("click",function(){
    Swal.fire({
      title               : '¿Está seguro?',
      text                : "Se abrirá el registro "+Investigacion_Id+" !!!",
      icon                : 'warning',
      showCancelButton    : true,
      confirmButtonColor  : '#3085d6',
      cancelButtonColor   : '#d33',
      confirmButtonText   : 'Si, abrir!'
    }).then((result) => 
    {
      if (result.isConfirmed){
        respuesta = 1;
        if (respuesta == 1){
          Accion='abrir_informe_final';
          $.ajax({
            url       : "Ajax.php",
            type      : "POST",
            datatype  : "json",    
            data      : { MoS:MoS,NombreMoS:NombreMoS,Accion:Accion,Accidentes_Id:Investigacion_Id},   
            success: function(data) {
              Swal.fire(
                'Abrir!',
                'El registro ha sido abierto.',
                'success')      
              opcionInvestigacion = 2;
              $("#btn_abrir_informe_final").hide();
              $("#btn_guardar_informe_final").show();
              $("#btn_guardar_informe_final").prop("disabled",false);
              f_EdicionCamposInvestigacion('disabled', false);
              tablaInvestigacion.ajax.reload(null, false);
            }
          });
        }
      }
    });
  });
  ///:: FIN BOTON ABRIR INFORME PRELIMINAR ::::::::::::::::::::::::::::::::::::::::::::::::///

  ///:: EVENTO DEL BOTON VER LOG INFORME FINAL ::::::::::::::::::::::::::::::::::::::::::::///
  $(document).on("click", ".btn_log_informe_final", function(){
    $("#form_modal_log_informe_final").trigger("reset");
    $("#div_log_informe_final").html(acci_log_informe_final);
    
    $(".modal-header-log").css( "background-color", "#17a2b8");
    $(".modal-header-log").css( "color", "white" );
    $(".modal-title-log").text("Log");
    $('#modal_crud_log_informe_final').modal('show');
    $('#modal-resizable').resizable();
    $(".modal-dialog").draggable({
      cursor: "move",
      handle: ".dragable_touch",
    });
  });
  ///:: FIN EVENTO DEL BOTON VER LOG INFORME FINAL ::::::::::::::::::::::::::::::::::::::::///
  
  
});

///:::::::::::::::::::::::::::: BOTONES ACCIDENTES ::::::::::::::::::::::::::::::::::::::::///

///:::::::::::::::::::::::: JS DATA TABLE ACCIDENTES ::::::::::::::::::::::::::::::::::::::///
$("#btnBuscarInvestigacion").on("click",function(){
  inv_FechaInicio           = $("#inv_FechaInicio").val();
  inv_FechaTermino          = $("#inv_FechaTermino").val();
  columnastabla             = f_ColumnasTabla("tablaInvestigacion","");
  // selectAniosInvestigacion  = $("#selectAniosInvestigacion").val();
  Accion = 'BuscarInvestigacion';
  $("#tablaInvestigacion").dataTable().fnDestroy();
  $('#tablaInvestigacion').show();
  
  tablaInvestigacion = $('#tablaInvestigacion').DataTable({
    
    //Filtros por columnas
    orderCellsTop: true,
    fixedHeader: true,
    initComplete: function (){
      var api = this.api();
      // For each column
      api.columns().eq(0).each(function (colIdx) {
        // Set the header cell to contain the input element
        var cell = $('.filtersInvestigacion th').eq($(api.column(colIdx).header()).index());
        var title = $(cell).text();
        $(cell).html('<input type="text" placeholder="' + title + '" />');
        // On every keypress in this input
        $('input',$('.filtersInvestigacion th').eq($(api.column(colIdx).header()).index()) ).off('keyup change').on('keyup change', function (e) {
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
    fixedColumns:
    {
      left: 1
    },
    fixedHeader:
    {
      header : false
    },
    select          : {style: 'os'},
    language: idiomaEspanol,
    responsive: "true",
    dom: 'Blfrtip', // Con Botones Excel,Pdf,Print
    pageLength: 50,
    buttons:
      [
        {
          extend      : 'excelHtml5',
          text        : '<i class="fas fa-file-excel"></i> ',
          titleAttr   : 'Exportar a Excel',
          className   : 'btn btn-success'
        },
      ],
    "ajax":{            
            "url"     : "Ajax.php", 
            "method"  : 'POST', //usamos el metodo POST
            "data"    : {MoS:MoS, NombreMoS:NombreMoS, Accion:Accion, fecha_inicio:inv_FechaInicio, fecha_termino:inv_FechaTermino}, //enviamos opcion 4 para que haga un SELECT
            "dataSrc" : ""
    },
    "columns"         : columnastabla,
    "columnDefs"      : [
      {
        "targets"   : [19],
        "render"    : function(data, type, row, meta) {
            if(data=='' || data==null){
                return "PENDIENTE";
            }else{
                return data;
            }
        }
      },
      { 
        "className"   : "text-center",
        "targets"     : [1,3,6,7,9,10,11,13,17,18,19]
      },
      {
        "targets"   : [21],
        "render"    : function(data, type, row, meta) {
            if(data!=null){
                return "<div class='text-center'><div class='btn-group'><button title='DOC.ADJ.' class='btn btn-primary btn-sm btn_ver_documentos_adjuntos'><i class='bi bi-eye'><svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-eye' viewBox='0 0 16 16'><path d='M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z'/><path d='M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z'/></svg></i></button></div></div>";
            }else{
                return "";
            }
        }
      }   

    ],
    "order"           : [[0, 'desc']]
  });
});

///:::::::::::::::::::::::: BOTON CARGAR INVESTIGACION ::::::::::::::::::::::::::::::::::::///
$(document).on("click", ".btnCargarInvestigacion", function(){
  let a_data = [];
  filaInvestigacion   = $(this).closest('tr'); 
  Investigacion_Id    = filaInvestigacion.find('td:eq(0)').text();
  opcionInvestigacion = 0; // 1: CREAR, 2:EDITAR

  $("#btn_guardar_informe_final").prop("disabled",false);
  f_cargar_datos_fila(filaInvestigacion);
  accif_antiguedad       = f_antiguedad(filaInvestigacion.find('td:eq(6)').text(),filaInvestigacion.find('td:eq(2)').text());
  a_data = f_BuscarDataBD('OPE_AccidentesInformePreliminar','Accidentes_Id',Investigacion_Id);
  $.each(a_data, function(idx, obj){ 
    accif_horas_trabajadas = obj.Acci_HorasTrabajadas;
  });
  $("#accif_antiguedad").val(accif_antiguedad);
  $("#accif_horas_trabajadas").val(accif_horas_trabajadas);
  
  f_CargarVariablesVacioInvestigacion(); // se inicialiazan las variables de investigacion
  f_EdicionCamposInvestigacion('disabled', false);

  // SE CARGAN TODOS LOS COMBOS
  // COMBOS GENERALES DE TABLA TIPO PARA LIMABUS
  Operacion = 'INVESTIGACION';
  Tipo      = 'LUGAR REFERENCIA';
  selectHtmlAccidentes ="";
  selectHtmlAccidentes = f_TipoTabla(Operacion,Tipo);
  $("#Acci_LugarReferencia").html(selectHtmlAccidentes);

  Tipo = 'FACTOR';
  selectHtmlAccidentes ="";
  selectHtmlAccidentes = f_TipoTabla(Operacion,Tipo);
  $("#Acci_FactorDeterminante").html(selectHtmlAccidentes);
  $("#Acci_FactorContributivo").html(selectHtmlAccidentes);

  Tipo = 'RESPONSABILIDAD FACTOR';
  selectHtmlAccidentes = "";
  selectHtmlAccidentes = f_TipoTabla(Operacion,Tipo);
  $("#Acci_ResponsabilidadDeterminante").html(selectHtmlAccidentes);
  $("#Acci_ResponsabilidadContributivo").html(selectHtmlAccidentes);

  Tipo = 'EXPEDIENTE TIPO';
  selectHtmlAccidentes = "";
  selectHtmlAccidentes = f_TipoTabla(Operacion,Tipo);
  $("#Acci_TipoExpediente").html(selectHtmlAccidentes);

  Tipo = 'REPORTADO EN';
  selectHtmlAccidentes = "";
  selectHtmlAccidentes = f_TipoTabla(Operacion,Tipo);
  $("#Acci_EventoReportado").html(selectHtmlAccidentes);

  Tipo = 'FRECUENCIA';
  selectHtmlAccidentes = "";
  selectHtmlAccidentes = f_TipoTabla(Operacion,Tipo);
  $("#Acci_Frecuencia").html(selectHtmlAccidentes);

  Tipo = 'PROBABILIDAD';
  selectHtmlAccidentes = "";
  selectHtmlAccidentes = f_TipoTabla(Operacion,Tipo);
  $("#Acci_Probabilidad").html(selectHtmlAccidentes);

  Tipo = 'SEVERIDAD';
  selectHtmlAccidentes = "";
  selectHtmlAccidentes = f_TipoTabla(Operacion,Tipo);
  $("#Acci_Severidad").html(selectHtmlAccidentes);

  Tipo = 'GRADO FALTA';
  selectHtmlAccidentes = "";
  selectHtmlAccidentes = f_TipoTabla(Operacion,Tipo);
  $("#Acci_GradoFalta").html(selectHtmlAccidentes);

  // SE BUSCA Y CARGA EL INFORME PRELIMINAR
  Accion = 'CargarInvestigacion';
  $.ajax({
    url       : "Ajax.php",
    type      : "POST",
    datatype  : "json",
    async     : false,
    data      : {MoS:MoS, NombreMoS:NombreMoS, Accion:Accion, Accidentes_Id:Investigacion_Id},
    success   : function(data){
      data = $.parseJSON(data);
      f_CargarVariablesInvestigacion(data);  
    }
  });

  if(Acci_EstadoInvestigacion==""){
    $("#btn_guardar_informe_final").show();
    $("#btn_abrir_informe_final").hide();
    opcionInvestigacion = 1;
    // SE GENERA DatosCalculados DESDE EL INFORME PRELIMINAR
    Accion  = 'DatosCalculados';
    $.ajax({
      url       : "Ajax.php",
      type      : "POST",
      datatype  :"json",
      async     : false,
      data      : {MoS:MoS, NombreMoS:NombreMoS, Accion:Accion, Accidentes_Id:Investigacion_Id},
      success   : function(data){
        data = $.parseJSON(data);
        $.each(data, function(idx, obj){
          Acci_DatosRegistro        = obj.Acci_DatosRegistro;
          Acci_Trafico              = obj.Acci_Trafico;
          Acci_Reincidencia         = obj.Acci_Reincidencia;
          Acci_FechaCierreReporte   = obj.Acci_FechaCierreReporte;
          Acci_FechaReporteGDH      = obj.Acci_FechaCierreReporte;
          Acci_FechaRegistro        = obj.Acci_FechaRegistro;
          Acci_TiempoInvestigacion  = obj.Acci_TiempoInvestigacion;
          Acci_DelayRegistro        = obj.Acci_DelayRegistro;
          Acci_CumplimientoRegistro = obj.Acci_CumplimientoRegistro;
          acci_doc_reporte_atencion_rimac = obj.Acci_DocReporteAtencion;
        })
      }
    });
    if(acci_doc_reporte_atencion_rimac=="SI"){
      $("#acci_nro_siniestro").prop("disabled",false);
    }else{
      $("#acci_nro_siniestro").prop("disabled",true);
    }
  }else{
    opcionInvestigacion = 2;
    // SI EL ESTADO ES CERRADO SE INFORMA Y SE DESHABILITAN TODOS LOS BOTONES DE EDICION
    if(Acci_EstadoInvestigacion=="CERRADO"){
      opcionInvestigacion = 3;
      Swal.fire(
        'Cerrado!!!',
        'La investigación del accidente se encuentra cerrada.',
        'success'
      )
      f_EdicionCamposInvestigacion('disabled', true);
      // Se oculta boton guardar y se muestra boton editar
      $("#btn_guardar_informe_final").hide();
      $("#btn_abrir_informe_final").show();
    }
  }
  
  $("#Acci_Frecuencia").removeClass("color-p1");
  $("#Acci_Frecuencia").removeClass("color-p2");
  $("#Acci_Frecuencia").removeClass("color-p3");
  $("#Acci_Probabilidad").removeClass("color-p1");
  $("#Acci_Probabilidad").removeClass("color-p2");
  $("#Acci_Probabilidad").removeClass("color-p3");
  $("#Acci_Severidad").removeClass("color-p1");
  $("#Acci_Severidad").removeClass("color-p2");
  $("#Acci_Severidad").removeClass("color-p3");
  $("#Acci_Severidad").removeClass("color-p4");

  f_CargaVariablesHtmlInvestigacion();
  $(".modal-header").css( "background-color", "#17a2b8");
  $(".modal-header").css( "color", "white" );
  $(".modal-title").text("Investigación de Accidentes");
  $(".title_informe_final").css( "color", "red" );
  $(".title_informe_final").text("I.P. : " +Investigacion_Id);
  $('#modalCRUDInvestigacion').modal('show');
});

///::::::::::::::::::::::::: FUNCIONES DE INVESTIGACION :::::::::::::::::::::::::::::::::::///

///::::::: FUNCION PARA VALIDAR LOS DATOS INGRESADOS AL FORMULARIO ::::::::::::::::::::::::///
function f_ValidarInvestigacion(pAcci_FactorDeterminante, pAcci_FactorContributivo, pAcci_ResponsabilidadDeterminante, pAcci_ResponsabilidadContributivo, pAcci_TipoExpediente, pAcci_EventoReportado, pAcci_GradoFalta, pAcci_CodigoRIT, pAcci_LugarReferencia, pAcci_Frecuencia, pAcci_Probabilidad, pAcci_Severidad, p_acci_nro_siniestro){
  f_LimpiaMsInvestigacion();
  let rptaValidarInvestigacion = "";    
  
  if(pAcci_FactorDeterminante==""){
    $('#Acci_FactorDeterminante').addClass("color-error");
    rptaValidarInvestigacion="invalido";
  }
  if(pAcci_FactorContributivo==""){
    $('#Acci_FactorContributivo').addClass("color-error");
    rptaValidarInvestigacion="invalido";
  }
  if(pAcci_ResponsabilidadDeterminante==""){
    $('#Acci_ResponsabilidadDeterminante').addClass("color-error");
    rptaValidarInvestigacion="invalido";
  }
  if(pAcci_ResponsabilidadContributivo==""){
    $('#Acci_ResponsabilidadContributivo').addClass("color-error");
    rptaValidarInvestigacion="invalido";
  }
  if(pAcci_TipoExpediente==""){
    $('#Acci_TipoExpediente').addClass("color-error");
    rptaValidarInvestigacion="invalido";
  }
  if(pAcci_EventoReportado==""){
    $('#Acci_EventoReportado').addClass("color-error");
    rptaValidarInvestigacion="invalido";
  }
  if(pAcci_GradoFalta==""){
    $('#Acci_GradoFalta').addClass("color-error");
    rptaValidarInvestigacion="invalido";
  }
  if(pAcci_CodigoRIT==""){
    $('#Acci_CodigoRIT').addClass("color-error");
    rptaValidarInvestigacion="invalido";
  }
  if(pAcci_LugarReferencia==""){
    $('#Acci_LugarReferencia').addClass("color-error");
    rptaValidarInvestigacion="invalido";
  }
  if(pAcci_Frecuencia==""){
    $('#Acci_Frecuencia').addClass("color-error");
    rptaValidarInvestigacion="invalido";
  }
  if(pAcci_Probabilidad==""){
    $('#Acci_Probabilidad').addClass("color-error");
    rptaValidarInvestigacion="invalido";
  }
  if(pAcci_Severidad==""){
    $('#Acci_Severidad').addClass("color-error");
    rptaValidarInvestigacion="invalido";
  }
  if(p_acci_nro_siniestro=="" && acci_doc_reporte_atencion_rimac=="SI"){
    $('#acci_nro_siniestro').addClass("color-error");
    rptaValidarInvestigacion="invalido";
  }
  return rptaValidarInvestigacion; 
}

///:: INVISIBILIZA LOS MENSAJE DE ALERTA DEL FORMULARIO :::::::::::::::::::::::::::::::::::///
function f_LimpiaMsInvestigacion(){
  $('#Acci_FactorDeterminante').removeClass("color-error");
  $('#Acci_FactorContributivo').removeClass("color-error");
  $('#Acci_ResponsabilidadDeterminante').removeClass("color-error");
  $('#Acci_ResponsabilidadContributivo').removeClass("color-error");
  $('#Acci_TipoExpediente').removeClass("color-error");
  $('#Acci_EventoReportado').removeClass("color-error");
  $('#Acci_GradoFalta').removeClass("color-error");
  $('#Acci_CodigoRIT').removeClass("color-error");
  $('#Acci_Frecuencia').removeClass("color-error");
  $('#Acci_Probabilidad').removeClass("color-error");
  $('#Acci_Severidad').removeClass("color-error");
  $('#acci_nro_siniestro').removeClass("color-error");
}

//:: HABILITAR O DESHABILITAR LA EDICION DE LOS CAMPOS ::::::::::::::::::::::::::::::::::::///
function f_EdicionCamposInvestigacion(tOpcion,bValor){
  $('#Acci_FactorDeterminante').prop(tOpcion,bValor);
  $('#Acci_FactorContributivo').prop(tOpcion,bValor);
  $('#Acci_ResponsabilidadDeterminante').prop(tOpcion,bValor);
  $('#Acci_ResponsabilidadContributivo').prop(tOpcion,bValor);
  $('#Acci_TipoExpediente').prop(tOpcion,bValor);
  $('#Acci_EventoReportado').prop(tOpcion,bValor);
  $('#Acci_GradoFalta').prop(tOpcion,bValor);
  $('#Acci_CodigoRIT').prop(tOpcion,bValor);
  $('#Acci_LugarReferencia').prop(tOpcion,bValor);
  $("#Acci_Frecuencia").prop(tOpcion,bValor);
  $("#Acci_Probabilidad").prop(tOpcion,bValor);
  $("#Acci_Severidad").prop(tOpcion,bValor);
  $("#acci_nro_siniestro").prop(tOpcion,bValor);
}

///:: SE CARGAN LAS VARIABLES CON LA INFORMACION DE LA BASE DE DATOS :::::::::::::::::::::///
function f_CargarVariablesInvestigacion(p_data){
  $.each(p_data, function(idx, obj){ 
    Acci_Trafico                            = obj.Acci_Trafico;
    Acci_GravedadEvento                     = obj.Acci_GravedadEvento;
    Acci_DatosRegistro                      = obj.Acci_DatosRegistro;
    Acci_FactorDeterminante                 = obj.Acci_FactorDeterminante;
    Acci_FactorContributivo                 = obj.Acci_FactorContributivo;
    Acci_ResponsabilidadDeterminante        = obj.Acci_ResponsabilidadDeterminante;
    Acci_ResponsabilidadContributivo        = obj.Acci_ResponsabilidadContributivo;
    Acci_TipoExpediente                     = obj.Acci_TipoExpediente;
    Acci_EventoReportado                    = obj.Acci_EventoReportado;
    Acci_ResponsabilidadAccidente           = obj.Acci_ResponsabilidadAccidente;
    Acci_GradoFalta                         = obj.Acci_GradoFalta;
    Acci_Reincidencia                       = obj.Acci_Reincidencia;
    Acci_CodigoRIT                          = obj.Acci_CodigoRIT;
    Acci_DescripcionRIT                     = obj.Acci_DescripcionRIT;
    Acci_AccionDisciplinaria                = obj.Acci_AccionDisciplinaria;
    Acci_ReporteGDH                         = obj.Acci_ReporteGDH;
    Acci_FechaReporteGDH                    = obj.Acci_FechaReporteGDH;
    Acci_Premio                             = obj.Acci_Premio;
    Acci_FechaCierreReporte                 = obj.Acci_FechaCierreReporte;
    Acci_TiempoInvestigacion                = obj.Acci_TiempoInvestigacion;
    Acci_CumplimientoMeta                   = obj.Acci_CumplimientoMeta;
    Acci_DelayRegistro                      = obj.Acci_DelayRegistro;
    Acci_CumplimientoRegistro               = obj.Acci_CumplimientoRegistro;
    Acci_FechaRegistro                      = obj.Acci_FechaRegistro;
    Acci_EstadoInvestigacion                = obj.Acci_EstadoInvestigacion;
    Acci_LugarReferencia                    = obj.Acci_LugarReferencia;
    Acci_Frecuencia                         = obj.Acci_Frecuencia;
    Acci_Probabilidad                       = obj.Acci_Probabilidad;
    Acci_Severidad                          = obj.Acci_Severidad;
    acci_log_informe_final                  = obj.Acci_LogInvestigacion;
    acci_nro_siniestro                      = obj.acci_nro_siniestro;
  });
}

///::::::::::: SE INICIALIZAN LAS VARIABLES DE LA INVESTIGACION ::::::::::::///
function f_CargarVariablesVacioInvestigacion(){
  Acci_Trafico                            = "";
  Acci_GravedadEvento                     = "";
  Acci_DatosRegistro                      = "";
  Acci_FactorDeterminante                 = "";
  Acci_FactorContributivo                 = "";
  Acci_ResponsabilidadDeterminante        = "";
  Acci_ResponsabilidadContributivo        = "";
  Acci_TipoExpediente                     = "";
  Acci_EventoReportado                    = "";
  Acci_ResponsabilidadAccidente           = "";
  Acci_GradoFalta                         = "";
  Acci_Reincidencia                       = "";
  Acci_CodigoRIT                          = "";
  Acci_DescripcionRIT                     = "";
  Acci_AccionDisciplinaria                = "";
  Acci_ReporteGDH                         = "";
  Acci_FechaReporteGDH                    = "";
  Acci_Premio                             = "";
  Acci_FechaCierreReporte                 = "";
  Acci_TiempoInvestigacion                = "";
  Acci_CumplimientoMeta                   = "";
  Acci_DelayRegistro                      = "";
  Acci_CumplimientoRegistro               = "";
  Acci_FechaRegistro                      = "";
  Acci_EstadoInvestigacion                = "";
  Acci_LugarReferencia                    = "";
  Acci_Frecuencia                         = "";
  Acci_Probabilidad                       = "";
  Acci_Severidad                          = "";
  acci_nro_siniestro                      = "";
}

///::::::::::: SE CARGAN LAS VARIABLES HTML CON LA INFORMACION
function f_CargaVariablesHtmlInvestigacion(){
  $('#Acci_Trafico').val(Acci_Trafico);
  $('#Acci_GravedadEvento').val(Acci_GravedadEvento);
  $('#Acci_DatosRegistro').val(Acci_DatosRegistro);
  $('#Acci_FactorDeterminante').val(Acci_FactorDeterminante);
  $('#Acci_FactorContributivo').val(Acci_FactorContributivo);
  $('#Acci_ResponsabilidadDeterminante').val(Acci_ResponsabilidadDeterminante);
  $('#Acci_ResponsabilidadContributivo').val(Acci_ResponsabilidadContributivo);
  $('#Acci_TipoExpediente').val(Acci_TipoExpediente);
  $('#Acci_EventoReportado').val(Acci_EventoReportado);
  $('#Acci_ResponsabilidadAccidente').val(Acci_ResponsabilidadAccidente);
  $('#Acci_GradoFalta').val(Acci_GradoFalta);
  $('#Acci_Reincidencia').val(Acci_Reincidencia);
  t_html = f_CodigoRIT(Acci_GradoFalta);
  $("#Acci_CodigoRIT").html(t_html);
  $('#Acci_CodigoRIT').val(Acci_CodigoRIT);
  $('#Acci_DescripcionRIT').val(Acci_DescripcionRIT);
  $('#Acci_AccionDisciplinaria').val(Acci_AccionDisciplinaria);
  $('#Acci_ReporteGDH').val(Acci_ReporteGDH);
  $('#Acci_FechaReporteGDH').val(Acci_FechaReporteGDH);
  $('#Acci_Premio').val(Acci_Premio);
  $('#Acci_FechaCierreReporte').val(Acci_FechaCierreReporte);
  if(Acci_TiempoInvestigacion=="0"){
    tAcci_TiempoInvestigacion = "< 1 día";
  }else{
    tAcci_TiempoInvestigacion = Acci_TiempoInvestigacion;
    if(Acci_TiempoInvestigacion=="1"){
      tAcci_TiempoInvestigacion += " día";
    }else{
      tAcci_TiempoInvestigacion += " días";
    }
  }
  $('#tAcci_TiempoInvestigacion').val(tAcci_TiempoInvestigacion);
  $('#Acci_CumplimientoMeta').val(Acci_CumplimientoMeta);
  if(Acci_DelayRegistro=="0"){
    tAcci_DelayRegistro = "< 1 día";
  }else{
    tAcci_DelayRegistro = Acci_DelayRegistro;
    if(Acci_DelayRegistro=="1"){
      tAcci_DelayRegistro += " día";
    }else{
      tAcci_DelayRegistro += " días";
    }
  }
  $('#tAcci_DelayRegistro').val(tAcci_DelayRegistro);
  $('#Acci_CumplimientoRegistro').val(Acci_CumplimientoRegistro);
  $('#Acci_FechaRegistro').val(Acci_FechaRegistro);
  $('#Acci_LugarReferencia').val(Acci_LugarReferencia);
  $('#Acci_Frecuencia').val(Acci_Frecuencia);
  $('#Acci_Probabilidad').val(Acci_Probabilidad);
  $('#Acci_Severidad').val(Acci_Severidad);
  $('#acci_nro_siniestro').val(acci_nro_siniestro);
  f_color_gravedad();
}

///:: SE CARGAN LAS VARIABLES CON LOS VALORES EDITADOS DE LA INVESTIGACION :::::::::::::::///
function f_CargarVariablesEditadasInvestigacion(){
  Acci_Trafico                            = $.trim($('#Acci_Trafico').val());
  Acci_GravedadEvento                     = $.trim($('#Acci_GravedadEvento').val());
  Acci_DatosRegistro                      = $.trim($('#Acci_DatosRegistro').val());
  Acci_FactorDeterminante                 = $.trim($('#Acci_FactorDeterminante').val());
  Acci_FactorContributivo                 = $.trim($('#Acci_FactorContributivo').val());
  Acci_ResponsabilidadDeterminante        = $.trim($('#Acci_ResponsabilidadDeterminante').val());
  Acci_ResponsabilidadContributivo        = $.trim($('#Acci_ResponsabilidadContributivo').val());
  Acci_TipoExpediente                     = $.trim($('#Acci_TipoExpediente').val());
  Acci_EventoReportado                    = $.trim($('#Acci_EventoReportado').val());
  Acci_ResponsabilidadAccidente           = $.trim($('#Acci_ResponsabilidadAccidente').val());
  Acci_GradoFalta                         = $.trim($('#Acci_GradoFalta').val());
  if(Acci_GradoFalta==""){
    Acci_GradoFalta = 0;
  }
  Acci_Reincidencia                       = $.trim($('#Acci_Reincidencia').val());
  if(Acci_Reincidencia==""){
    Acci_Reincidencia = 0;
  }
  Acci_CodigoRIT                          = $.trim($('#Acci_CodigoRIT').val());
  Acci_DescripcionRIT                     = $.trim($('#Acci_DescripcionRIT').val());
  Acci_AccionDisciplinaria                = $.trim($('#Acci_AccionDisciplinaria').val());
  Acci_ReporteGDH                         = $.trim($('#Acci_ReporteGDH').val());
  Acci_FechaReporteGDH                    = $.trim($('#Acci_FechaReporteGDH').val());
  Acci_Premio                             = $.trim($('#Acci_Premio').val());
  Acci_FechaCierreReporte                 = $.trim($('#Acci_FechaCierreReporte').val());
  Acci_CumplimientoMeta                   = $.trim($('#Acci_CumplimientoMeta').val());
  Acci_CumplimientoRegistro               = $.trim($('#Acci_CumplimientoRegistro').val());
  Acci_FechaRegistro                      = $.trim($('#Acci_FechaRegistro').val());
  Acci_LugarReferencia                    = $.trim($('#Acci_LugarReferencia').val());
  Acci_Frecuencia                         = $.trim($('#Acci_Frecuencia').val());
  Acci_Probabilidad                       = $.trim($('#Acci_Probabilidad').val());
  Acci_Severidad                          = $.trim($('#Acci_Severidad').val());
  acci_nro_siniestro                      = $.trim($('#acci_nro_siniestro').val());
}

function f_GravedadEvento(pAcci_Frecuencia,pAcci_Probabilidad,pAcci_Severidad){
  let rptaGravedadEvento = "";
  // SE GENERA LA GRAVEDAD DEL EVENTO
  Accion = 'GravedadEvento';
  $.ajax({
    url       : "Ajax.php",
    type      : "POST",
    datatype  : "json",
    async     : false,
    data      : {MoS:MoS,NombreMoS:NombreMoS,Accion:Accion,Acci_Frecuencia:pAcci_Frecuencia,Acci_Probabilidad:pAcci_Probabilidad,Acci_Severidad:pAcci_Severidad},
    success   : function(data){
      rptaGravedadEvento = data;
    }
  });
  f_color_gravedad();

  return rptaGravedadEvento;
}

function f_color_gravedad(){
  $("#Acci_Frecuencia").removeClass("color-p1");
  $("#Acci_Frecuencia").removeClass("color-p2");
  $("#Acci_Frecuencia").removeClass("color-p3");

  if(Acci_Frecuencia=="1"){$("#Acci_Frecuencia").addClass("color-p1");}
  if(Acci_Frecuencia=="2"){$("#Acci_Frecuencia").addClass("color-p2");}
  if(Acci_Frecuencia=="3"){$("#Acci_Frecuencia").addClass("color-p3");}

  $("#Acci_Probabilidad").removeClass("color-p1");
  $("#Acci_Probabilidad").removeClass("color-p2");
  $("#Acci_Probabilidad").removeClass("color-p3");

  if(Acci_Probabilidad=="1"){$("#Acci_Probabilidad").addClass("color-p1");}
  if(Acci_Probabilidad=="2"){$("#Acci_Probabilidad").addClass("color-p2");}
  if(Acci_Probabilidad=="3"){$("#Acci_Probabilidad").addClass("color-p3");}

  $("#Acci_Severidad").removeClass("color-p1");
  $("#Acci_Severidad").removeClass("color-p2");
  $("#Acci_Severidad").removeClass("color-p3");
  $("#Acci_Severidad").removeClass("color-p4");

  if(Acci_Severidad=="1"){$("#Acci_Severidad").addClass("color-p1");}
  if(Acci_Severidad=="2"){$("#Acci_Severidad").addClass("color-p2");}
  if(Acci_Severidad=="3"){$("#Acci_Severidad").addClass("color-p3");}
  if(Acci_Severidad=="4"){$("#Acci_Severidad").addClass("color-p4");}
}

function f_ResponsabilidadAccidente(pAcci_ResponsabilidadContributivo,pAcci_ResponsabilidadDeterminante){
  let rptaResponsabilidadAccidente = "";
  // SE GENERA LA GRAVEDAD DEL EVENTO
  Accion = 'ResponsabilidadAccidente';
  $.ajax({
    url       : "Ajax.php",
    type      : "POST",
    datatype  : "json",
    async     : false,
    data      : {MoS:MoS, NombreMoS:NombreMoS, Accion:Accion, Acci_ResponsabilidadContributivo:pAcci_ResponsabilidadContributivo, Acci_ResponsabilidadDeterminante:pAcci_ResponsabilidadDeterminante},
    success   : function(data){
      rptaResponsabilidadAccidente = data;
    }
  });
  
  if(rptaResponsabilidadAccidente==""){
    Acci_GradoFalta = "";
    Acci_Premio     = "";
  }else{
    if(rptaResponsabilidadAccidente=="NO"){
      Acci_GradoFalta = "NINGUNA";
      Acci_Premio     = "SI";
      Acci_ReporteGDH = "NO";
    }else{
      Acci_GradoFalta = "";
      Acci_Premio     = "NO";
      Acci_ReporteGDH = "SI";
    }
  }
  Acci_DescripcionRIT      = "";
  Acci_AccionDisciplinaria = "";
  $("#Acci_GradoFalta").val(Acci_GradoFalta);
  $("#Acci_Premio").val(Acci_Premio);
  $("#Acci_ReporteGDH").val(Acci_ReporteGDH);

  t_html = f_CodigoRIT(Acci_GradoFalta);
  $("#Acci_CodigoRIT").html(t_html);
    
  $("#Acci_DescripcionRIT").val(Acci_DescripcionRIT);
  $("#Acci_AccionDisciplinaria").val(Acci_AccionDisciplinaria);
  return rptaResponsabilidadAccidente;
}

function f_CodigoRIT(pAcci_GradoFalta){
  let rptaCodigoRIT = "";
  Accion = 'CodigoRIT';
  $.ajax({
    url       : "Ajax.php",
    type      : "POST",
    datatype  : "json",
    async     : false,
    data      : {MoS:MoS,NombreMoS:NombreMoS,Accion:Accion,Acci_GradoFalta:pAcci_GradoFalta},
    success   : function(data){
      rptaCodigoRIT = data;
    }
  });
  return rptaCodigoRIT;
}

function f_cargar_datos_fila(p_fila){ 
  accif_fecha                     = p_fila.find('td:eq(2)').text();
  accif_hora                      = p_fila.find('td:eq(3)').text();
  accif_piloto                    = p_fila.find('td:eq(5)').text();
  accif_fecha_ingreso             = p_fila.find('td:eq(6)').text();
  accif_tabla                     = p_fila.find('td:eq(7)').text();
  accif_servicio                  = p_fila.find('td:eq(8)').text();
  accif_bus                       = p_fila.find('td:eq(9)').text();
  accif_placa                     = p_fila.find('td:eq(10)').text();
  accif_tipo_bus                  = p_fila.find('td:eq(11)').text();
  accif_direccion                 = p_fila.find('td:eq(12)').text();
  accif_sentido                   = p_fila.find('td:eq(13)').text();
  accif_tipo_accidente            = p_fila.find('td:eq(14)').text();
  accif_clase_accidente           = p_fila.find('td:eq(15)').text();
  accif_evento                    = p_fila.find('td:eq(16)').text();
  accif_reconoce_responsabilidad  = p_fila.find('td:eq(17)').text();
  accif_cantidad_lesionados       = p_fila.find('td:eq(18)').text();

  $("#accif_fecha").val(accif_fecha);
  $("#accif_hora").val(accif_hora);
  $("#accif_piloto").val(accif_piloto);
  $("#accif_fecha_ingreso").val(accif_fecha_ingreso);
  $("#accif_tabla").val(accif_tabla);
  $("#accif_servicio").val(accif_servicio);
  $("#accif_bus").val(accif_bus);
  $("#accif_placa").val(accif_placa);
  $("#accif_tipo_bus").val(accif_tipo_bus);
  $("#accif_direccion").val(accif_direccion);
  $("#accif_sentido").val(accif_sentido);
  $("#accif_tipo_accidente").val(accif_tipo_accidente);
  $("#accif_clase_accidente").val(accif_clase_accidente);
  $("#accif_evento").val(accif_evento);
  $("#accif_reconoce_responsabilidad").val(accif_reconoce_responsabilidad);
  $("#accif_cantidad_lesionados").val(accif_cantidad_lesionados);
}