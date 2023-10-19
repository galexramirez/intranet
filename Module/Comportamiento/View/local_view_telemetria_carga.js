///::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
///::::::::::::::::::::::: TAB COMPORTAMIENTO v 1.0  FECHA: 13/07/2022 ::::::::::::::::::::::::///
///::::::::::::::::::::::: CARGAR O ELIMINAR REGISTROS DE TELEMETRIA:::::::::::::::::::::::::::///
///::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///

///::::::::::::::::::::::::::::::: Declaracion de Variables :::::::::::::::::::::::::::::::::::///

var tablaTelemetriaCarga, filaTelemetriaCarga;
var selectAniosTelemetriaCarga, telemetriacarga_id,telemetriacarga_fechaoperacion;

///::::::::::::::::::::::::: DOM NOVEDAD :::::::::::::::::::::::::::::::::::::::::::::::::///
$(document).ready(function(){
  /*Accion='AniosComportamiento'; 
  $.ajax({
    url: "Ajax.php",
    type: "POST",
    datatype:"json",    
    data: {MoS:MoS,NombreMoS:NombreMoS,Accion:Accion},    
    success: function(data){
      $("#selectAniosTelemetriaCarga").html(data);
    }
  });*/

  div_boton = f_BotonesFormulario("formSeleccionTelemetriaCarga","btnNuevoTelemetriaCarga");
  $("#div_btnNuevoTelemetriaCarga").html(div_boton);

  // Si hay cambios en el Fecha se ocultan botones y datatable
  $("#selectAniosTelemetriaCarga").on('change', function () {
    $("#div_tablaTelemetriaCarga").empty();
  });

  // Si hay cambios en el nombre del archivo a cargar se limpia el texto del resultado
  $("#fileTelemetriaCarga").click(function(){
    $("#div_ResultadoTelemetriaCarga").empty();
  });
  
  ///::::::::: COLOCA EL NOMBRE DEL ARCHIVO EN EL INPUT FILE
  $(document).on('change', '#fileTelemetriaCarga', function (event) {
    var NombreArch=event.target.files[0].name;
    var Extension=NombreArch.split('.').pop();
    $("#LabelfileTelemetriaCarga").text(NombreArch);
  }); 
  
  /// ::::::::::::::: CREAR CARGA DE KM :::::::::::::///
  $('#formTelemetriaCarga').submit(function(e){                         
    e.preventDefault(); //evita el comportambiento normal del submit, es decir, recarga total de la página
  
    //:: Valida que exista el archivo Excel. 
    let f_Excel = document.getElementById('fileTelemetriaCarga').value;
    let anioCarga = $("#selectAniosTelemetriaCarga").val();
    telemetriacarga_fechaoperacion = $("#telemetriacarga_fechaoperacion").val();
    let existe_fechaoperacion = f_existefechaoperacion(telemetriacarga_fechaoperacion);
    let opcionCargarExcel = 0;

    if(existe_fechaoperacion=="SI"){
      Swal.fire({
        icon: 'error',
        title: 'Fecha...',
        text: '*Fecha de Operación ya se encuentra registrada!!!'
      })
    }else{
      if(f_Excel.length==0){
        Swal.fire({
          icon: 'error',
          title: 'Archivo Excel...',
          text: '*Requiere archivo .csv o .xlsx!'
        })
      }else{
        opcionCargarExcel = 1;
        $("#div_ResultadoTelemetriaCarga").empty();
      }
      // Objeto FormData para enviar datos de al formulario   
      let formTelemetriaCarga = new FormData(); 
      let filesexcel = $("#fileTelemetriaCarga")[0].files[0]; 
      formTelemetriaCarga.append('archivoexcel',filesexcel);
      formTelemetriaCarga.append('MoS',MoS);
      formTelemetriaCarga.append('NombreMoS',NombreMoS);
      formTelemetriaCarga.append('Accion','CrearTelemetriaCarga');
      formTelemetriaCarga.append('Anio',anioCarga);
      formTelemetriaCarga.append('telemetriacarga_fechaoperacion',telemetriacarga_fechaoperacion);
    
      if(opcionCargarExcel == 1){
        $("#bntCargarTelemetriaCarga").prop("disabled",true);
        $.ajax({
          url:"Ajax.php",
          type:"POST",
          data: formTelemetriaCarga,
          contentType:false,
          processData:false,
          beforeSend: function () {
            $("#div_ResultadoTelemetriaCarga").html("Procesando, espere por favor...<img src='Services/PlantillaTemplon/View/Img/loading5.gif' width='20' height='20'>");
          },
          success:function(resp){
            $("#div_ResultadoTelemetriaCarga").html(resp);
            tablaTelemetriaCarga.ajax.reload(null, false);
            $("#bntCargarTelemetriaCarga").prop("disabled",false);
          },
        });
      }
    }
  });

  ///::::::::: EVENTO DEL BOTON NUEVO ::::::::::::::///
  $("#btnNuevoTelemetriaCarga").click(function(){
    $("#formTelemetriaCarga").trigger("reset");
  
    $("#div_ResultadoTelemetriaCarga").empty();
    $("#LabelfileTelemetriaCarga").text("Seleccionar Archivo .csv o .xlsx");
    $(".modal-header").css( "background-color", "#17a2b8");
    $(".modal-header").css( "color", "white" );
    $(".modal-title").text("Nueva Carga");
    $('#modalCRUDTelemetriaCarga').modal('show');	    
  });

});

///:::::::::::::::::::::::::::: BOTONES COMPORTAMIENTO ::::::::::::::::::::::::::::::::::::::::::///

///:::::::::::::::::::::::: JS DATA TABLE COMPORTAMIENTO ::::::::::::::::::::::::::::::::::///
$("#btnBuscarTelemetriaCarga").on("click",function(){
  selectAniosTelemetriaCarga = $("#selectAniosTelemetriaCarga").val();

  div_tabla = f_CreacionTabla("tablaTelemetriaCarga","");
  $("#div_tablaTelemetriaCarga").html(div_tabla);
  columnastabla = f_ColumnasTabla("tablaTelemetriaCarga","")

  $("#tablaTelemetriaCarga").dataTable().fnDestroy();
  $('#tablaTelemetriaCarga').show();

  Accion='BuscarTelemetriaCarga';
  tablaTelemetriaCarga = $('#tablaTelemetriaCarga').DataTable({
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
          extend:     'excelHtml5',
          text:       '<i class="fas fa-file-excel"></i> ',
          titleAttr:  'Exportar a Excel',
          className:  'btn btn-success'
        },
        {
          extend:     'print',
          text:       '<i class="fa fa-print"></i> ',
          titleAttr:  'Imprimir',
          className:  'btn btn-info'
        },
      ],
    "ajax":{            
      "url": "Ajax.php", 
      "method": 'POST', //usamos el metodo POST
      "data":{MoS:MoS,NombreMoS:NombreMoS,Accion:Accion,Anio:selectAniosTelemetriaCarga}, //enviamos opcion 4 para que haga un SELECT
      "dataSrc":""
    },
    "columns":columnastabla,
    "order": [[0, 'desc']]
  });
});


///::::::::  BOTON BORRAR REGISTRO  
$(document).on("click", ".btnBorrarTelemetriaCarga", function(){
  filaTelemetriaCarga = $(this);           
  telemetriacarga_id = filaTelemetriaCarga.closest('tr').find('td:eq(0)').text();
  telemetriacarga_fechaopetracion = filaTelemetriaCarga.closest('tr').find('td:eq(2)').text();
  
  Swal.fire({
    title: '¿Está seguro?',
    text: "Se eliminara el registro "+telemetriacarga_id+" | "+telemetriacarga_fechaoperacion+"!",
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Si, eliminar!'
  }).then((result) => {
    if (result.isConfirmed) {
      Swal.fire(
          'Eliminado!',
          'El registro ha sido eliminado.',
          'success'
      )
      // BORRAR REGISTRO DE KILOMETROS CARGA
      Accion='BorrarTelemetriaCarga';
      $.ajax({
        url: "Ajax.php",
        type: "POST",
        datatype:"json",    
        data: { MoS:MoS,NombreMoS:NombreMoS,Accion:Accion,telemetriacarga_id:telemetriacarga_id},   
        success: function() {
        }
      });
      // BORRAR DETALLE DE KILOMETRAJE 
      Accion='BorrarTelemetria'; 
      $.ajax({
        url: "Ajax.php",
        type: "POST",
        datatype:"json",    
        data: {MoS:MoS,NombreMoS:NombreMoS,Accion:Accion,telemetriacarga_id:telemetriacarga_id},    
        success: function(){
        }
      });
      tablaTelemetriaCarga.row(filaTelemetriaCarga.parents('tr')).remove().draw();                  
    }
  });

});

///::::::::::::::::::::::::: FUNCIONES TELEMETRIA ::::::::::::::::::::::::::::::::::::::::::///

///::::::: FUNCION PARA VALIDAR LOS DATOS INGRESADOS AL FORMULARIO :::::::::::::::::::///
function f_ValidarTelemetria(){
  LimpiaMsTelemetria();

  NoLetrasMayuscEspacio=/[^A-Z ]/;
  let rptaValidarTelemetria="";    

  return rptaValidarTelemetria; 
}

///::::::::: INVISIBILIZA LOS MENSAJE DE ALERTA DEL FORMULARIO :::::: /// 
function LimpiaMsTelemetria(){
  $("#Mstelemetria_id").css("display", "none" );
}

///::::::::: FECHA QUE SE DEBE DE INGRESAR - SE VERIFICA CUAL ES LA ULTIMA FECHA DE INGRESO A LA TABLA manto_ckl_kilometraje :::::::::::::::::::::///
function f_existefechaoperacion(pfechaoperacion){
  let rpta_existefechaoperacion="";
  Accion="ExisteFechaOperacion";
  $.ajax({
    url: "Ajax.php",
    type: "POST",
    datatype:"json",    
    async: false,
    data: {MoS:MoS,NombreMoS:NombreMoS,Accion:Accion,tlmtcarga_fechaoperacion:pfechaoperacion},    
    success: function(data){
       rpta_existefechaoperacion = data;
    }
  });
  return rpta_existefechaoperacion;
}