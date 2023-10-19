///:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
///::::::::::::::::: DESPACHO FLOTA v 2.0 ::::::::::::::::::::///
///::::::::::::: INFORME DE SALIDA DE BUSES ::::::::::::::::::///
///:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///

///::::::::::: Declaracion de Variables GLOBALES :::::::::::::///

var tablaInformeLlegada, tablaInformeDespacho, tablaSalidaFlota, idiomaEspanol;
var tipo_SalidaFlota, dFechaSalidaFlota, selectOperacionSalidaFlota;
var Prog_OperacionSalidaFlota, Prog_FechaSalidaFlota;

///::::::::::::::: DOOM DESPACHO FLOTA :::::::::::::://
$(document).ready(function(){
  Tipo='TIPO SALIDA';
  Operacion='DESPACHO FLOTA'; 
  selectHtml = "";
  selectHtml = f_TipoTabla(Operacion,Tipo);
  $("#tipo_SalidaFlota").html(selectHtml);

  Tipo='TURNO';
  Operacion='DESPACHO FLOTA'; 
  selectHtml = "";
  selectHtml = f_TipoTabla(Operacion,Tipo);
  $("#selectTurnoSalidaFlota").html(selectHtml);

  Tipo='OPERACION';
  Operacion='LIMABUS'; 
  selectHtml = "";
  selectHtml = f_TipoTabla(Operacion,Tipo);
  $("#Prog_OperacionSalidaFlota").html(selectHtml);

  div_boton = f_BotonesFormulario("formSeleccionSalidaFlota","btnGenerarSalidaFlota");
  $("#div_btnGenerarSalidaFlota").html(div_boton);
  $("#div_btnGenerarSalidaFlota").hide();

  $("#Prog_FechaSalidaFlota").on('change', function () {
    $("#div_tablaSalidaFlota").empty();
    $("#div_btnGenerarSalidaFlota").hide();
  });

  $("#Prog_OperacionSalidaFlota").on('change', function () {
    $("#div_tablaSalidaFlota").empty();
    $("#div_btnGenerarSalidaFlota").hide();
  });
  
  $("#tipo_SalidaFlota").on('change', function () {
    $("#div_tablaSalidaFlota").empty();
    $("#div_btnGenerarSalidaFlota").hide();
  });

  /// ::::::::::::::: CREA SALIDA DE FLOTA :::::::::::::///
  $('#formSalidaFlota').submit(function(e){                         
    e.preventDefault(); //evita el comportambiento normal del submit, es decir, recarga total de la página
    tHoraInicioSalidaFlota = $.trim($('#tHoraInicioSalidaFlota').val());
    tHoraTerminoSalidaFlota = $.trim($('#tHoraTerminoSalidaFlota').val());
    selectTurnoSalidaFlota = $.trim($('#selectTurnoSalidaFlota').val());
    validacionSalidaFlota = f_ValidarSalidaFlota(dFechaSalidaFlota,selectOperacionSalidaFlota,tHoraInicioSalidaFlota,tHoraTerminoSalidaFlota,selectTurnoSalidaFlota);
    existeSalidaFlota = f_ExisteSalidaFlota(dFechaSalidaFlota,selectOperacionSalidaFlota,selectTurnoSalidaFlota);
    
    if(existeSalidaFlota=="SI"){
      Swal.fire(
        'Existe!',
        'El Despacho de Flota ya se encuentra creado.',
        'success'
      )
    }else{
      if(validacionSalidaFlota!="invalido") {
        $("#btnCrearSalidaFlota").prop("disabled",true);
        Accion='CrearSalidaFlota';
        $.ajax({
              url: "Ajax.php",
              type: "POST",
              datatype:"json",
              data:  { MoS:MoS,NombreMoS:NombreMoS,Accion:Accion,Prog_Fecha:dFechaSalidaFlota,Prog_Operacion:selectOperacionSalidaFlota,HoraInicio:tHoraInicioSalidaFlota,HoraTermino:tHoraTerminoSalidaFlota,TurnoSalidaFlota:selectTurnoSalidaFlota },
              success: function(data) {
                Swal.fire(
                  'Grabado!',
                  'El registro ha sido generado con exito !!!.',
                  'success')
              }
        });
        $('#modalCRUDSalidaFlota').modal('hide');
      }else{
        Swal.fire({
          icon: 'error',
          title: 'INFORMACION...',
          text: '*Es posible que la información sea incorrecta!!!'
        })
      } 
    }
  });    

  ///::::::::: EVENTO BOTON GENERAR SALIDA FLOTA ::::::::::::::::::::::///       
  $("#btnGenerarSalidaFlota").click(function(){
    if(tablaSalidaFlota.rows().count()>0){
      $("#formSalidaFlota").trigger("reset");
      $("#btnCrearSalidaFlota").prop("disabled",false);
      $("#dFechaSalidaFlota").val(dFechaSalidaFlota);
      $("#selectOperacionSalidaFlota").val(selectOperacionSalidaFlota);
      
      $(".modal-header").css( "background-color", "#17a2b8");
      $(".modal-header").css( "color", "white" );
      $(".modal-title").text("Generar Salida de Flota");
      $('#modalCRUDSalidaFlota').modal('show');
    }else{
      Swal.fire({
        position: 'center',
        icon: 'success',
        title: 'No existen registros.',
        showConfirmButton: false,
        timer: 1500
      })      
    }
  });

});    


///:::::::::::::::::::::::::::: BOTONES DESPACHO FLOTA ::::::::::::::::::::::::::::::::::::::::::///

///::::::::: EVENTO BOTON BUSCAR SALIDA FLOTA ::::::::::::::::::::::///       
$("#btnBuscarSalidaFlota").click(function(){
  Prog_FechaSalidaFlota = $("#Prog_FechaSalidaFlota").val();
  Prog_OperacionSalidaFlota = $("#Prog_OperacionSalidaFlota").val();
  tipo_SalidaFlota = $("#tipo_SalidaFlota").val();

  if(tipo_SalidaFlota=="ACTUAL"){
      dFechaSalidaFlota = Prog_FechaSalidaFlota;
      selectOperacionSalidaFlota = Prog_OperacionSalidaFlota;
      $("#div_btnGenerarSalidaFlota").show();
  }else{
    $("#div_btnGenerarSalidaFlota").hide();
  }

  div_tabla = f_CreacionTabla("tablaSalidaFlota",tipo_SalidaFlota);
  $("#div_tablaSalidaFlota").html(div_tabla);
  columnastabla = f_ColumnasTabla("tablaSalidaFlota",tipo_SalidaFlota)

  $("#tablaSalidaFlota").dataTable().fnDestroy();
  $('#tablaSalidaFlota').show();
  
  Accion='BuscarSalidaFlota';
  tablaSalidaFlota = $('#tablaSalidaFlota').DataTable({
    //Color a las filas
    "rowCallback":function(row,data,index)
    {
      f_ColorFilasSalidaFlota(row,data);
    }, 

    language: idiomaEspanol,
    responsive: "true",
    dom: 'Blfrtip', // Con Botones Excel,Pdf,Print
    pageLength: 100,
    buttons:
    [
      {
        extend:     'excelHtml5',
        text:       '<i class="fas fa-file-excel"></i> ',
        titleAttr:  'Exportar a Excel',
        className:  'btn btn-success',
        title:      'SALIDA DE FLOTA '+Prog_OperacionSalidaFlota+' DEL '+Prog_FechaSalidaFlota
      },
    ],
    "ajax":{            
      "url": "Ajax.php", 
      "method": 'POST', //usamos el metodo POST
      "data":{MoS:MoS,NombreMoS:NombreMoS,Accion:Accion,Prog_Fecha:Prog_FechaSalidaFlota, Prog_Operacion:Prog_OperacionSalidaFlota, tipo_SalidaFlota:tipo_SalidaFlota}, //enviamos opcion 4 para que haga un SELECT
      "dataSrc":""
    },
    "columns":columnastabla,
    "order": [[4, 'asc']]
  });
});



///::::::::::::::::::::::::: FUNCIONES DESPACHO FLOTA ::::::::::::::::::::::::::::::::::::::::::///

function f_ValidarSalidaFlota(Prog_FechaSalidaFlota,Prog_OperacionSalidaFlota,horainicio_SalidaFlota,horatermino_SalidaFlota,tipo_SalidaFlota){
  f_LimpiaSalidaFlota();
  NoLetrasMayuscEspacio=/[^A-Z \Ñ]/;
  let rptaSalidaFlota="";


  return rptaSalidaFlota; 
}

function f_ExisteSalidaFlota(Prog_FechaSalidaFlota,Prog_OperacionSalidaFlota,selectTurnoSalidaFlota){
  let rptaExisteSalidaFlota="";
  Accion='ExisteSalidaFlota';
  $.ajax({
        url: "Ajax.php",
        type: "POST",
        datatype:"json",
        async: false,
        data:  { MoS:MoS,NombreMoS:NombreMoS,Accion:Accion,Prog_Fecha:Prog_FechaSalidaFlota,Prog_Operacion:Prog_OperacionSalidaFlota,TurnoSalidaFlota:selectTurnoSalidaFlota },
        success: function(data) {
          rptaExisteSalidaFlota = data;
        }
  });
  return rptaExisteSalidaFlota;
}

///::::::::: INVISIBILIZA LOS MENSAJE DE ALERTA DEL FORMULARIO :::::: /// 
function f_LimpiaSalidaFlota(){
  //$("#MsRepo_Descripcion").css("display", "none" );
}

function f_ColorFilasSalidaFlota(row,data){
  let color_rojo = "#E26A5A";
  let color_verde = "#009390";
  let color_azul = "#005EA4";
  
  // Columna Hora Mantenimiento
  $("td:eq(4)",row).css({
    "color":color_azul,
  });
  // Columna Servicio
  if(data.Prog_Servicio == 'BUS RETEN'){
    $("td:eq(9)",row).css({
      "color":color_verde,
    });
  }
}