///::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
///:::::::::::::::::::: REPORTE INFOBUS v1.0 FECHA: 30-08-2022 ::::::::::::::::::::::::::::::::::///
//::::::::: INFORMACION DE BUS, OTS CORRECTIVAS, PREVENTIVAS, VALES Y KILOMETRAJE :::::::::::::::///
///::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///

var ib_FechaInicio, ib_FechaTermino, ib_Bus, ib_Tipo, ib_Sistema, ib_origen, miCarpeta;
miCarpeta = f_DocumentRoot();
ib_FechaInicio = "";
ib_FechaTermino = "";
ib_Bus = "TODOS";
ib_Tipo = "GENERAL";
ib_Sistema = "";
ib_origen = "";

$(document).ready(function(){

  if(ib_FechaInicio=="" && ib_FechaTermino==""){
    ib_FechaInicio = f_CalculoFecha("hoy","-12 Months");
    ib_FechaTermino = f_CalculoFecha("hoy","0");
    $('#ib_FechaInicio').val(ib_FechaInicio);
    $('#ib_FechaTermino').val(ib_FechaTermino);
  }

  // COMBOS DE TABLA TIPO OTCORRECTIVAS
  Operacion='OTCORRECTIVAS';
  Tipo='SISTEMA';
  selectHtmlOT="";
  selectHtmlOT = f_TipoTabla(Operacion,Tipo);
  $("#ib_Sistema").html(selectHtmlOT);

  selectHtmlOT = f_select_combo("manto_origenes","NO","or_nombre","","`or_nombre`!=''","`or_nombre`");
  $("#ib_origen").html(selectHtmlOT);
  
  // Cargamos los buses
  Accion='BusesInfoBus';
  $.ajax({
      url: "Ajax.php",
      type: "POST",
      datatype:"json",
      async: false,
      data: {MoS:MoS,NombreMoS:NombreMoS,Accion:Accion},    
      success: function(data){
          $("#ib_Bus").html(data);
          $("#ib_Bus").val(ib_Bus);
      }
  });
  
  // Si hay cambios en el Fecha se ocultan botones y datatable
  $("#ib_FechaInicio").on('change', function () {
    $("#div_tablaInfoBus").empty();
  });
  
  $("#ib_FechaTermino").on('change', function () {
    $("#div_tablaInfoBus").empty();
  });

  $("#ib_Bus").on('change', function () {
    $("#div_tablaInfoBus").empty();
  });

  $("#ib_Tipo").on('change', function () {
    $("#div_tablaInfoBus").empty();
  });

  ///::::::::::::::: JS CARGA DE DATA TABLE :::::::::::::://
  $("#btnCargarInfoBus").on("click",function()
  {
    let validacion, t_DiferenciaFecha;
    ib_FechaInicio  = $("#ib_FechaInicio").val();
    ib_FechaTermino = $("#ib_FechaTermino").val();
    ib_Bus          = $("#ib_Bus").val();
    ib_Tipo         = $("#ib_Tipo").val();
    ib_Sistema      = $("#ib_Sistema").val();
    ib_Contenga     = $("#ib_Contenga").val();
    ib_origen       = $("#ib_origen").val();
    
    validacion        = validar(ib_FechaInicio,ib_FechaTermino, ib_Bus);
    if(ib_Bus=="TODOS"){
      t_DiferenciaFecha = f_DiferenciaFecha(ib_FechaInicio,ib_FechaTermino,'366');
    }

    if(validacion=="invalido"){
      Swal.fire({
        icon: 'error',
        title: 'Informacion...',
        text: '*Es posible que la Información no sea la correcta!!!'
      })
    }else{
      if(t_DiferenciaFecha=="NO"){
        $("#ib_FechaInicio").addClass("color-error");
        $("#ib_FechaTermino").addClass("color-error");
        Swal.fire({
            icon: 'error',
            title: 'Consulta Mayores a 1 año',
            html: "Debe seleccionar un bus !!!",
          })
      }else{
        div_tabla = f_CreacionTabla("tablaInfoBus","");
        $("#div_tablaInfoBus").html(div_tabla);
        columnastabla = f_ColumnasTabla("tablaInfoBus","");
        // Setup - add a text input to each footer cell
        $('#tablaInfoBus thead tr')
          .clone(true)
          .addClass('filtersInfoBus')
          .appendTo('#tablaInfoBus thead');
    
        $("#tablaInfoBus").dataTable().fnDestroy();
        $('#tablaInfoBus').show();
        Accion='CargarInfoBus';
        tablaInfoBus = $('#tablaInfoBus').DataTable({
          //Color a las filas
          "rowCallback":function(row,data,index){
            f_ColorFilasInfoBus(row,data);
          }, 
          //Filtros por columnas
          orderCellsTop: true,
          fixedHeader: true,
          initComplete: function (){
              var api = this.api();
              // For each column
              api.columns().eq(0).each(function (colIdx) {
                  // Set the header cell to contain the input element
                  var cell = $('.filtersInfoBus th').eq($(api.column(colIdx).header()).index());
                  var title = $(cell).text();
                  $(cell).html('<input type="text" placeholder="' + title + '" />');
                  // On every keypress in this input
                  $('input',$('.filtersInfoBus th').eq($(api.column(colIdx).header()).index()) ).off('keyup change').on('keyup change', function (e) {
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
          "processing": true,
          language: idiomaEspanol,
          responsive: "true",
          pageLength: 100,
          dom: 'Blfrtip',
          buttons:
            [
              {
                  extend:     'excelHtml5',
                  text:       '<i class="fas fa-file-excel"></i> ',
                  titleAttr:  'Exportar a Excel',
                  className:  'btn btn-success',
                  title:      'InfoBus del ' + ib_Bus + ' desde ' + ib_FechaInicio + ' al ' + ib_FechaTermino,
                  filename:   'Infobus del ' + ib_Bus + ' desde ' + ib_FechaInicio + ' al ' + ib_FechaTermino,
              },
            ],
          "ajax":{            
                  "url"     : "Ajax.php", 
                  "method"  : 'POST',
                  "data"    : {MoS:MoS,NombreMoS:NombreMoS,Accion:Accion,ib_FechaInicio:ib_FechaInicio,ib_FechaTermino:ib_FechaTermino,ib_Bus:ib_Bus,ib_Tipo:ib_Tipo,ib_Sistema:ib_Sistema,ib_Contenga:ib_Contenga, ib_origen:ib_origen},
                  "dataSrc" : ""
                  },
          "columns"   : columnastabla,
          "columnDefs": [
            {
              "targets"   : [0, 16],
              "orderable" : false,
                
            },
            {
              "targets"   : [10],
              "visible"   : false
            }
        ],
          order     : [[4, 'desc']],
        });
  
      }
    }
  });

    ///::::::::::::::: JS CARGA DE DATA TABLE :::::::::::::://
    $("#btnDescargarInfoBus").on("click",function()
    {
      let validacion = "", t_DiferenciaFecha="";
      ib_FechaInicio  = $("#ib_FechaInicio").val();
      ib_FechaTermino = $("#ib_FechaTermino").val();
      ib_Bus      = $("#ib_Bus").val();
      ib_Tipo     = $("#ib_Tipo").val();
      ib_Sistema  = $("#ib_Sistema").val();
      ib_Contenga = $("#ib_Contenga").val();
      ib_origen   = $("#ib_origen").val();
      
      validacion = validar(ib_FechaInicio,ib_FechaTermino, ib_Bus);
      if(ib_Bus=="TODOS"){
        t_DiferenciaFecha = f_DiferenciaFecha(ib_FechaInicio,ib_FechaTermino,'366');
      }

      if(validacion=="invalido"){
        Swal.fire({
          icon: 'error',
          title: 'Informacion...',
          text: '*Es posible que la Información no sea la correcta!!!'
        })  
      }else{
        if(t_DiferenciaFecha=="NO"){
          $("#ib_FechaInicio").addClass("color-error");
          $("#ib_FechaTermino").addClass("color-error");
          Swal.fire({
            icon: 'error',
            title: 'Consulta Mayores a 1 año',
            html: "Debe seleccionar un bus !!!",
          })
        }else{
          // Descarga archivo csv o Excel
          Accion='DescargarInfoBus';
          $.ajax({
              url     : "Ajax.php",
              type    : "POST",
              datatype: "json",
              data    : {MoS:MoS,NombreMoS:NombreMoS,Accion:Accion,ib_FechaInicio:ib_FechaInicio,ib_FechaTermino:ib_FechaTermino,ib_Bus:ib_Bus,ib_Tipo:ib_Tipo,ib_Sistema:ib_Sistema,ib_Contenga:ib_Contenga, ib_origen:ib_origen},
              beforeSend: function(){
                Swal.fire({
                  icon              : 'success',
                  title             : 'Procesando Información...',
                  showConfirmButton : false,
                  timer             : 5000  // 90000
                })
              },
              success: function(data){
                window.location.href = miCarpeta + "Module/InfoBus/Controller/csv_Descarga.php?Archivo=" + data + "&Tipo=" + ib_Tipo;
                /*Swal.fire({
                  icon              : 'success',
                  title             : 'Descargando Información...',
                  showConfirmButton : false,
                  timer             : 10000
                })
                let link = document.createElement('a');
                link.href = miCarpeta + 'Services/Json/' +data;
                link.download = data;
                link.click();
                f_borrar_archivo(data);*/
              }
          });
        }
      }
    });
  
});    

///::::::::: EVENTO DE BOTON VER OTs ::::::::::::::::::::::///       
$(document).on("click", ".btnVerOTs", function(){		
  let nro_ot="";
  $("#formModalInformacion").trigger("reset");
  fila_InfoBus = $(this).closest('tr'); 
  nro_ot = fila_InfoBus.find('td:eq(1)').text();

  if(nro_ot.substring(0,1)=="C"){
    tipo_ot = "CORRECTIVAS";
  }else{
    tipo_ot = "PREVENTIVAS";
  }
  
  Accion = 'InfoBusOTs';
  $.ajax({
    url: "Ajax.php",
    type: "POST",
    datatype:"json",
    async: false,    
    data: {MoS:MoS,NombreMoS:NombreMoS,Accion:Accion,nro_ot:nro_ot},    
    success: function(data){
      $("#div_InfoDetalle").html(data);
    }
  });
  $(".modal-header").css( "background-color", "#17a2b8");
  $(".modal-header").css( "color", "white" );
  $(".modal-title").text("Información de OTs "+tipo_ot);
  $('#modalCRUDInformacion').modal('show');
  $('#modal-resizable').resizable();
  $(".modal-dialog").draggable({
    cursor: "move",
    handle: ".dragable_touch",
  });
});

///::::::::: EVENTO DE BOTON VER VALES ::::::::::::::::::::::///       
$(document).on("click", ".btnVerVales", function(){		
  let nro_ot="";
  $("#formModalInformacion").trigger("reset");
  fila_InfoBus = $(this).closest('tr'); 
  nro_ot = fila_InfoBus.find('td:eq(1)').text();
 
  Accion = 'InfoBusVales';
  $.ajax({
    url: "Ajax.php",
    type: "POST",
    datatype:"json",
    async: false,    
    data: {MoS:MoS,NombreMoS:NombreMoS,Accion:Accion,nro_ot:nro_ot},    
    success: function(data){
      $("#div_InfoDetalle").html(data);
    }
  });
  $(".modal-header").css( "background-color", "#17a2b8");
  $(".modal-header").css( "color", "white" );
  $(".modal-title").text("Información de Vales");
  $('#modalCRUDInformacion').modal('show');
  $(".modal-dialog").draggable({
    cursor: "move",
    handle: ".dragable_touch",
  });
});

///::::::::: EVENTO DE BOTON VER BUSES ::::::::::::::::::::::///       
$(document).on("click", ".btn_ver_bus", function(){		
  let bus_nro_externo = "";
  let Bus_NroExterno  = "";
  let bus_km          = "";
  $("#form_modal_buses").trigger("reset");
  bus_nro_externo = $("#ib_Bus").val();
  data_BD = f_BuscarDataBD("Buses","Bus_NroExterno",bus_nro_externo);
  $.each(data_BD, function(idx, obj){
    Bus_NroExterno = obj.Bus_NroExterno;    
    Bus_NroPlaca   = obj.Bus_NroPlaca;  
    Bus_Operacion  = obj.Bus_Operacion;   
    Bus_Detalle    = obj.Bus_Detalle;    
    Bus_Tipo       = obj.Bus_Tipo;  
    Bus_Tipo2      = obj.Bus_Tipo2;      
    Bus_Estado     = obj.Bus_Estado;      
    Bus_Tanques    = obj.Bus_Tanques;   
  });

  Accion = 'info_bus_km';
  $.ajax({
    url: "Ajax.php",
    type: "POST",
    datatype:"json",
    async: false,    
    data: {MoS:MoS,NombreMoS:NombreMoS,Accion:Accion,bus_nro_externo:bus_nro_externo},    
    success: function(data){
      bus_km = data;
    }
  });

  if(Bus_NroExterno == ""){
    Swal.fire({
      icon: 'error',
      title: 'Bus...',
      text: '*Es posible que la Información no sea la correcta!!!'
    })
  }else{
    $("#Bus_NroExterno").val(Bus_NroExterno);
    $("#bus_km").val(bus_km);
    $("#Bus_NroPlaca").val(Bus_NroPlaca);  
    $("#Bus_Operacion").val(Bus_Operacion);
    $("#Bus_Detalle").val(Bus_Detalle);
    $("#Bus_Tipo").val(Bus_Tipo);  
    $("#Bus_Tipo2").val(Bus_Tipo2);    
    $("#Bus_Estado").val(Bus_Estado);   
    $("#Bus_Tanques").val(Bus_Tanques);  
  
    $(".modal-header").css( "background-color", "#17a2b8");
    $(".modal-header").css( "color", "white" );
    $(".modal-title").text("Información de Bus");
    $('#modal_crud_buses').modal('show');	    
  }
});

///::::::: FUNCION PARA VALIDAR LOS DATOS INGRESADOS AL FORMULARIO :::::::::::::::::::///
function validar(pib_FechaInicio,pib_FechaTermino,pib_Bus){
  LimpiaMs();
  let rptaInfoBus="";    

  if(pib_FechaInicio > pib_FechaTermino){
    $("#ib_FechaInicio").addClass("color-error");
    $("#ib_FechaTermino").addClass("color-error");
    rptaInfoBus="invalido";
  }
  if(pib_FechaTermino=="" || pib_FechaInicio==""){
    $("#ib_FechaInicio").addClass("color-error");
    $("#ib_FechaTermino").addClass("color-error");
    rptaInfoBus="invalido";
  }
  if(pib_Bus==""){
    $("#ib_Bus").addClass("color-error");
    rptaInfoBus="invalido";
  }
  return rptaInfoBus; 
}

///::::::::: INVISIBILIZA LOS MENSAJE DE ALERTA DEL FORMULARIO :::::: /// 
function LimpiaMs(){
  $("#ib_FechaInicio").removeClass("color-error");
  $("#ib_FechaTermino").removeClass("color-error");
  $("#ib_Bus").removeClass("color-error");
}

function f_ColorFilasInfoBus(row,data){
  let color;
  // Columna Estado
  switch(data.ib_estado)
  {
      case "CERRADO":
          color = "#53A258";
      break;
      case "OBSERVADO":
          color = "#EC515D";
      break;
      case "ANULADO":
          color = "#00A3D6";
      break;
      case "ABIERTO":
          color = "#FF9D0A";
      break;
      case "PENDIENTE CT":
          color = "#EC515D";
      break;
  }
  $("td:eq(2)",row).css({
    "color":color,
    "font-weight":"bold",
  });
}

function f_borrar_archivo(p_archivo){
  let rpta_borrar = "";
  Accion = 'borrar_archivo';
  $.ajax({
      url       : "Ajax.php",
      type      : "POST",
      datatype  : "json",    
      async     : false,   
      data      : { MoS:MoS, NombreMoS:NombreMoS, Accion:Accion, archivo:p_archivo },   
      success: function(data) {
        rpta_borrar = data;
      }
  });
  return rpta_borrar;
}
