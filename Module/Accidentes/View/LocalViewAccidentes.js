///::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
///:: TAB ACCIDENTES v 4.0  FECHA: 2023-04-20 :::::::::::::::::::::::::::::::::::::::::::::///
///:: EDITAR Y MOSTRAR ACCIDENTES :::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
///::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///

///:: DECLARACION DE VARIABLES ::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
var tablaAccidentes, filaAccidentes, Acci_Operacion, perm_adjuntar_pdf, perm_informe_preliminar, opcionCargaPDF;
var OPE_AccidentesId, Accidentes_Id, Nove_ProgramacionId, Novedad_Id, Prog_Operacion, Acci_TipoImagen, Acci_Archivo;
var selectAniosAccidentes, tDefaultContentAccidentes, miCarpeta;
var no_FechaInicio, no_FechaTermino, fecha_inicio_accidentes;

no_FechaInicio      = "";
no_FechaTermino     = "";
Nove_ProgramacionId = "";
Novedad_Id          = "";
miCarpeta           = f_DocumentRoot();
fecha_inicio_accidentes = '2023-05-16';

///:: DOM JS LISTADO ACCIDENTES ::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
$(document).ready(function(){
  div_show = f_DivFormulario("formSeleccionAccidentes","formSeleccionAccidentes");
  $("#formSeleccionAccidentes").html(div_show);

  if(no_FechaInicio=="" && no_FechaTermino==""){
    no_FechaInicio = f_CalculoFecha("hoy","0");
    no_FechaTermino = f_CalculoFecha("hoy","0");
    $('#no_FechaInicio').val(no_FechaInicio);
    $('#no_FechaTermino').val(no_FechaTermino);
  }

  ///:: Si hay cambios en el Fecha se ocultan botones y datatable :::::::::::::::::::::::::///
  $("#no_FechaInicio").on('change', function () {
    $("#tablaAccidentes").dataTable().fnDestroy();
    $('#tablaAccidentes').hide();  
  });

  $("#no_FechaTermino").on('change', function () {
    $("#tablaAccidentes").dataTable().fnDestroy();
    $('#tablaAccidentes').hide();  
  });

  ///:: COLOCA EL NOMBRE DEL ARCHIVO PDF EN EL INPUT FILE PARA PDF ::::::::::::::::::::::::///
  $(document).on('change', '#Acci_PDF', function (event) {
    pdfEditar       = "";
    let NombreArch  = event.target.files[0].name;
    let Extension   = NombreArch.split('.').pop();
    $("#labelAcci_PDF").text(NombreArch);
  });

  ///:: INICIO BOTONES LISTADO DE ACCIDENTES ::::::::::::::::::::::::::::::::::::::::::::::///

  $(document).on("click",".btn_files", function(){
    Accion = "files";
    $.ajax({
      url       : "Ajax.php",
      type      : "POST",
      datatype  : "html",
      async     : false,    
      data      : {MoS:MoS,NombreMoS:NombreMoS,Accion:Accion},
      beforeSend: function(){
        Swal.fire({
          icon: "info",
          title: "Procesando Files!",
          showConfirmButton: false,
          timer: 5000
        });
      },    
      success   : function(data){
        if(data.substring(0,1)=="E"){
          alert(data);
        }else{
          Swal.fire({
            icon              : 'success',
            title             : data,
            showConfirmButton : false,
            timer             : 2000
          })  
        }
      }
    });

  });

  ///:: BOTON DATA TABLE LISTADO DE ACCIDENTES ::::::::::::::::::::::::::::::::::::::::::::///
  $(document).on("click", ".btnBuscarAccidentes", function(){
    let t_DiferenciaFecha, t_validacion;
    t_DiferenciaFecha       = "";
    t_validacion            = "";
    no_FechaInicio          = $("#no_FechaInicio").val();
    no_FechaTermino         = $("#no_FechaTermino").val();
    t_DiferenciaFecha       = f_DiferenciaFecha(no_FechaInicio,no_FechaTermino,'366');
    t_validacion            = validar(no_FechaInicio,no_FechaTermino);

    if(Date.parse(no_FechaInicio)<Date.parse(fecha_inicio_accidentes)){
      Swal.fire({
        icon: 'error',
        title: 'FECHAS...',
        text: '*Novedades Operacionales inicia a partir del 16/05/2023!'
      });
    }else{
      if(t_validacion=="invalido"){
        Swal.fire({
          icon: 'error',
          title: 'Informacion...',
          text: '*Es posible que la Información no sea la correcta!!!'
        })
      }else{
        if(t_DiferenciaFecha=="NO"){
          $("#no_FechaInicio").addClass("color-error");
          $("#no_FechaTermino").addClass("color-error");
          Swal.fire({
              icon: 'error',
              title: 'Rango de Fechas',
              html: "Consulta debe ser Menor a 1 año !!!",
            })
        }else{
          MostrarAccionesAccidentes = true; // para validar con los botones
  
          // Creación de Tablas
          div_tablas = f_CreacionTabla("tablaAccidentes","");
          $('#div_tablaAccidentes').html(div_tablas);
          $('#tablaAccidentes').hide();
  
          // Setup - add a text input to each footer cell
          $('#tablaAccidentes thead tr')
            .clone(true)
            .addClass('filters')
            .appendTo('#tablaAccidentes thead');
  
          // Se cargan las columnas segun los permisos  
          columnastabla = f_ColumnasTabla("tablaAccidentes","");
        
          $("#tablaAccidentes").dataTable().fnDestroy();
          $('#tablaAccidentes').show();
        
          Accion='BuscarAccidentes';
          tablaAccidentes = $('#tablaAccidentes').DataTable({
            //Filtros por columnas
            orderCellsTop: true,
            fixedHeader: true,
            initComplete: function (){
              var api = this.api();
              // For each column
              api.columns().eq(0).each(function (colIdx) {
                // Set the header cell to contain the input element
                var cell = $('.filters th').eq($(api.column(colIdx).header()).index());
                var title = $(cell).text();
                $(cell).html('<input type="text" placeholder="' + title + '" />');
                // On every keypress in this input
                $('input',$('.filters th').eq($(api.column(colIdx).header()).index()) ).off('keyup change').on('keyup change', function (e) {
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
            //Para cambiar el lenguaje a español
            language: idiomaEspanol,
            //Para usar los botones
            responsive: "true",
            dom: 'Blfrtip', // Con Botones Excel,Pdf,Print
            //Para mostrar 50 registros popr página 
            pageLength: 50,
            buttons:
              [
                {
                  extend    : 'excelHtml5',
                  text      : '<i class="fas fa-file-excel"></i> ',
                  titleAttr : 'Exportar a Excel',
                  className : 'btn btn-success',
                  title     : 'NOVEDADES OPERACIONALES'
                },
              ],
            "ajax":{            
                    "url": "Ajax.php", 
                    "method": 'POST', //usamos el metodo POST
                    "data":{MoS:MoS,NombreMoS:NombreMoS,Accion:Accion,fecha_inicio:no_FechaInicio, fecha_termino:no_FechaTermino}, //enviamos opcion 4 para que haga un SELECT
                    "dataSrc":""
            },
            "columns": columnastabla,
            "columnDefs"      : [
              {
                "targets"     : [10,11,14,15,16],
                "orderable"   : false,
              },
              {
                "targets"   : [13],
                "render"    : function(data, type, row, meta) {
                    if(data==null){
                        return "PENDIENTE";
                    }else{
                        return data;
                    }
                }
              },
              {
                "targets"   : [14],
                "render"    : function(data, type, row, meta) {
                    if(data!=null){
                        return "<div class='text-center'><div class='btn-group'><button title='PDF' class='btn btn-danger btn-sm btn_ip_pdf'><i class='bi bi-file-earmark-pdf'><svg   xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-file-earmark-pdf' viewBox='0 0 16 16'><path d='M14 14V4.5L9.5 0H4a2 2 0 0  0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2zM9.5 3A1.5 1.5 0 0 0 11 4.5h2V14a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h5.5v2z'/><path d='M4.603 14.087a.81.81 0 0 1-. 438-.42c-.195-.388-.13-.776.08-1.102.198-.307.526-.568.897-.787a7.68 7.68 0 0 1 1.482-.645 19.697 19.697 0 0 0 1.062-2.227 7.269 7.269 0 0 1-.43-1.295c-.086-.4-.119-. 796-.046-1.136.075-.354.274-.672.65-.823.192-.077.4-.12.602-.077a.7.7 0 0 1 .477.365c.088.164.12.356.127.538.007.188-.012.396-.047.614-.084.51-.27 1.134-.52 1.794a10. 954 10.954 0 0 0 .98 1.686 5.753 5.753 0 0 1 1.334.05c.364.066.734.195.96.465.12.144.193.32.2.518.007.192-.047.382-.138.563a1.04 1.04 0 0 1-.354.416.856.856 0 0 1-. 51.138c-.331-.014-.654-.196-.933-.417a5.712 5.712 0 0 1-.911-.95 11.651 11.651 0 0 0-1.997.406 11.307 11.307 0 0 1-1.02 1.51c-.292.35-.609.656-.927.787a.793.793 0 0   1-.58.029zm1.379-1.901c-.166.076-.32.156-.459.238-.328.194-.541.383-.647.547-.094.145-.096.25-.04.361.01.022.02.036.026.044a.266.266 0 0 0 .035-.012c.137-.056.355-.  235.635-.572a8.18 8.18 0 0 0 .45-.606zm1.64-1.33a12.71 12.71 0 0 1 1.01-.193 11.744 11.744 0 0 1-.51-.858 20.801 20.801 0 0 1-.5 1.05zm2.446.45c.15.163.296.3.435.41. 24.19.407.253.498.256a.107.107 0 0 0 .07-.015.307.307 0 0 0 .094-.125.436.436 0 0 0 .059-.2.095.095 0 0 0-.026-.063c-.052-.062-.2-.152-.518-.209a3.876 3.876 0 0 0-. 612-.053zM8.078 7.8a6.7 6.7 0 0 0 .2-.828c.031-.188.043-.343.038-.465a.613.613 0 0 0-.032-.198.517.517 0 0 0-.145.04c-.087.035-.158.106-.196.283-.04.192-.03.469.046.  822.024.111.054.227.09.346z'/></svg></i></button></div></div>";
                    }else{
                        return "";
                    }
                }
              },
              {
                "targets"   : [16],
                "render"    : function(data, type, row, meta) {
                    if(data!=null){
                        return "<div class='text-center'><div class='btn-group'><button title='DOC.ADJ.' class='btn btn-primary btn-sm btn_documentos_adjuntos_pdf'><i class='bi bi-eye'><svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-eye' viewBox='0 0 16 16'><path d='M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z'/><path d='M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z'/></svg></i></button></div></div>";
                    }else{
                        return "";
                    }
                }
              }   
            ],
            "order": [[1, 'desc']]
          });    
        }
      }      
    }
  });
  ///:: FIN BOTON DATA TABLE LISTADO DE ACCIDENTES ::::::::::::::::::::::::::::::::::::::::///

  ///:: BOTON REPORTE CONTROL FACILITADOR  ::::::::::::::::::::::::::::::::::::::::::::::::///
  $(document).on("click", ".btnReporteFacilitador", function(){
    filaAccidentes      = $(this).closest('tr'); 
    Nove_ProgramacionId = filaAccidentes.find('td:eq(0)').text();
    Novedad_Id          = filaAccidentes.find('td:eq(1)').text();

    Accion = 'DetalleControlFacilitador';
    $.ajax({
      url: "Ajax.php",
      type: "POST",
      datatype:"json",
      async: false,    
      data: {MoS:MoS,NombreMoS:NombreMoS,Accion:Accion,Nove_ProgramacionId:Nove_ProgramacionId,Novedad_Id:Novedad_Id},    
      success: function(data){
        $('#div_DetalleControlFacilitador').html(data);
      }
    }); 

    $(".modal-header").css( "background-color", "#17a2b8");
    $(".modal-header").css( "color", "white" );
    $(".modal-title").text("Detalle Control Facilitador - Novedad "+Novedad_Id);
    $('#modalCRUDDetalleControlFacilitador').modal('show'); 
  });
  ///:: FIN BOTON REPORTE CONTROL FACILITADOR  ::::::::::::::::::::::::::::::::::::::::::::///

  ///:: BOTON INFORME PRELIMINAR ::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
  $(document).on("click", ".btnInformePreliminar", function(){
    perm_informe_preliminar = f_permisos(NombreMoS, "colInformePreliminar");
    if(perm_informe_preliminar == "SI"){
      filaAccidentes      = $(this).closest('tr'); 
      Nove_ProgramacionId = filaAccidentes.find('td:eq(0)').text();
      Novedad_Id          = filaAccidentes.find('td:eq(1)').text();
      Accidentes_Id       = filaAccidentes.find('td:eq(12)').text();
      Prog_Operacion      = filaAccidentes.find('td:eq(4)').text();
      $("#selectInformePreliminar_Id").val(Accidentes_Id);
      $('#nav-profile-tab-InformePreliminar').tab('show')
      document.getElementById("btnBuscarInformePreliminar").click();  
    }else{
      Swal.fire({
        icon: 'error',
        title: 'Permisos...',
        text: 'No tiene permiso para esta opción!!!'
      })    
    }
  });
  ///:: FIN BOTON INFORME PRELIMINAR ::::::::::::::::::::::::::::::::::::::::::::::::::::::///
  
  ///:: BOTON ADJUNTAR DOCUMENTOS EN PDF ::::::::::::::::::::::::::::::::::::::::::::::::::///
  $(document).on("click", ".btnAdjuntarPDF", function(){
    Acci_Archivo = "";
    Acci_TipoImagen = "PDF";
    perm_adjuntar_pdf = f_permisos(NombreMoS, "colAdjuntarPDF");

    if(perm_adjuntar_pdf == "SI"){
      filaAccidentes = $(this).closest('tr'); 
      Accidentes_Id = filaAccidentes.find('td:eq(12)').text();
      Acci_Archivo = f_buscar_dato("OPE_AccidentesImagen","Acci_Archivo","`Accidentes_Id`='"+Accidentes_Id+"' AND `Acci_TipoImagen`='"+Acci_TipoImagen+"'") ;
      if(Accidentes_Id!=""){
        if(Acci_Archivo==""){
          opcionCargaPDF = 1; //CREAR nueva imagen
        }else{
          opcionCargaPDF = 2; //EDITAR imagen
        }
        $(".modal-header").css( "background-color", "#17a2b8");
        $(".modal-header").css( "color", "white" );
        $(".modal-title").text("Carga de Archivo PDF");
        $("#labelAcci_PDF").text("Seleccionar Archivo .pdf");
        $('#modalCRUDPDFCarga').modal('show');
      }else{
        Swal.fire({
          icon: 'error',
          title: 'ID Accidente...',
          text: 'No se ha generado el ID Accidente!'
        })    
      }    
    }else{
      Swal.fire({
        icon: 'error',
        title: 'Permisos...',
        text: 'No tiene permiso para esta opción!!!'
      })
    }
  });
  ///:: FIN BOTON ADJUNTAR DOCUMENTOS EN PDF ::::::::::::::::::::::::::::::::::::::::::::::///

  ///:: BOTON CARGAR PDF -> REALIZA LA GRABACION EN LA TABLA OPE_AccidentesImagenes BUS :::///
  $('#formModalPDFCarga').submit(function(e){
    e.preventDefault();
    let nombre_pdf = $('#Acci_PDF')[0].files[0].name;
    if(nombre_pdf!=""){
      let blobFile;
      let formData = new FormData();
    
      blobFile = $('#Acci_PDF')[0].files[0];
      if(opcionCargaPDF==1){
        Accion='grabar_pdf';
      }else{
        Accion='editar_pdf';
      }
    
      formData.append("MoS", MoS);
      formData.append("NombreMoS", NombreMoS);
      formData.append("Accion", Accion);
      formData.append("Accidentes_Id", Accidentes_Id);
      formData.append("Acci_TipoImagen", Acci_TipoImagen);
      formData.append("Acci_Imagen", blobFile);
      formData.append("Acci_Archivo", Acci_Archivo);
      $.ajax({
          url         : "Ajax.php",
          type        : "POST",
          datatype    : "json",
          data        : formData,   
          async       : false,
          contentType : false,
          processData : false,
          success     : function(data) {
            tablaAccidentes.ajax.reload(null,false);
            if(data.substring(0,1)=="E"){
              Swal.fire({
                position : 'center',
                icon     : 'error',
                title    : '*Error al cargar archivo PDF!!!',
                text     : data,
              })
            }else{
              Swal.fire({
                icon              : 'success',
                title             : data,
                showConfirmButton : false,
                timer             : 2000
              })  
            }
          }
      });	
    
    }else{
      Swal.fire({
        position          : 'center',
        icon              : 'error',
        title             : '*No se ha cargado ningún archivo PDF!!!',
        showConfirmButton : false,
        timer             : 1500
      })
    }
    $('#modalCRUDPDFCarga').modal('hide');
    
  });
  ///:: FIN BOTON CARGAR PDF -> REALIZA LA GRABACION EN LA TABLA OPE_AccidentesImagenes BUS ::///
  
  ///:: BOTON VER ARCHIVO PDF DE INFORME PRELIMINAR :::::::::::::::::::::::::::::::::::::::///
  $(document).on("click", ".btn_ip_pdf", function(){
    Acci_TipoImagen = "IP_PDF";
    filaAccidentes = $(this).closest('tr'); 
    Accidentes_Id = filaAccidentes.find('td:eq(12)').text();
    Acci_Archivo = f_buscar_dato("OPE_AccidentesImagen","Acci_Archivo","`Accidentes_Id`='"+Accidentes_Id+"' AND `Acci_TipoImagen`='"+Acci_TipoImagen+"'") ;
    window.open(mi_carpeta+"Services/files/pdf/ip/"+Acci_Archivo,"_blank");
  });
  ///:: FIN BOTON VER ARCHIVO PDF DE INFORME PRELIMINAR :::::::::::::::::::::::::::::::::::///

  ///:: BOTON VER ARCHIVO PDF DE INFORME PRELIMINAR :::::::::::::::::::::::::::::::::::::::///
  $(document).on("click", ".btn_documentos_adjuntos_pdf", function(){		
    Acci_TipoImagen = "PDF";
    filaAccidentes = $(this).closest('tr'); 
    Accidentes_Id = filaAccidentes.find('td:eq(12)').text();
    Acci_Archivo = f_buscar_dato("OPE_AccidentesImagen","Acci_Archivo","`Accidentes_Id`='"+Accidentes_Id+"' AND `Acci_TipoImagen`='"+Acci_TipoImagen+"'") ;
    window.open(mi_carpeta+"Services/files/pdf/ip/"+Acci_Archivo,"_blank");
  });
  ///:: FIN BOTON VER ARCHIVO PDF DE INFORME PRELIMINAR :::::::::::::::::::::::::::::::::::///

  ///::TERMINO BOTONES LISTADO DE ACCIDENTES ::::::::::::::::::::::::::::::::::::::::::::::///
});
///:: TERMINO DOM JS LISTADO ACCIDENTES :::::::::::::::::::::::::::::::::::::::::::::::::::///


///::::::::::::::::::::::::: FUNCIONES DE ACCIDENTES ::::::::::::::::::::::::::::::::::::::///

///:: FUNCION PARA VALIDAR LOS DATOS INGRESADOS AL FORMULARIO :::::::::::::::::::::::::::::///
function validar(pno_FechaInicio,pno_FechaTermino){
  LimpiaMs();
  let rpta_validar="";    

  if(pno_FechaInicio > pno_FechaTermino){
    $("#no_FechaInicio").addClass("color-error");
    $("#no_FechaTermino").addClass("color-error");
    rpta_validar="invalido";
  }
  if(pno_FechaTermino=="" || pno_FechaInicio==""){
    $("#no_FechaInicio").addClass("color-error");
    $("#no_FechaTermino").addClass("color-error");
    rpta_validar="invalido";
  }
  return rpta_validar; 
}
///:: FIN FUNCION PARA VALIDAR LOS DATOS INGRESADOS AL FORMULARIO :::::::::::::::::::::::::///

///:: LIMPIA LOS CAMPOS DEL FORMULARIO ::::::::::::::::::::::::::::::::::::::::::::::::::::/// 
function LimpiaMs(){
  $("#no_FechaInicio").removeClass("color-error");
  $("#no_FechaTermino").removeClass("color-error");
}
///:: FIN LIMPIA LOS CAMPOS DEL FORMULARIO ::::::::::::::::::::::::::::::::::::::::::::::::/// 
