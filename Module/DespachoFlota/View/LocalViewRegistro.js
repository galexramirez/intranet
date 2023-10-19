///:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
///::::::::::::::::: DESPACHO FLOTA v 2.0 ::::::::::::::::::::///
///::::::::::::: REGISTRO DE SALIDA DE BUSES ::::::::::::::::::///
///:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///

///::::::::::: Declaracion de Variables GLOBALES :::::::::::::///

// MoS: Module o Services, NombreMoS: Nombre del modulo o servicio, Accion: Funcion a ejecutar
var opcionDespachoFlota;
var Prog_FechaDespachoFlota,CFaRg_Estado,Repo_Descripcion,ControlFacilitador_Id,turno_DespachoFlota;
var Repo_BusCambio, Repo_HoraSalida, Repo_Motivo, Repo_CFaRgId, Repo_Estado, Programacion_Id;

///::::::::::::::: DOOM DESPACHO FLOTA :::::::::::::://
$(document).ready(function(){
  $("#Prog_FechaDespachoFlota").on('change', function () {
    $("#div_card-columns-DespachoFlota").empty();
    Prog_FechaDespachoFlota = $("#Prog_FechaDespachoFlota").val();
    turnoHtml = f_TurnoDespachoFlota(Prog_FechaDespachoFlota);
    $("#turno_DespachoFlota").html(turnoHtml);
    $("#turno_DespachoFlota").val("");
  });
  
  /// ::::::::::::::: CREA Y EDITA LA SALIDA DE FLOTA :::::::::::::///
  $('#formDespachoFlota').submit(function(e){                         
    e.preventDefault(); //evita el comportambiento normal del submit, es decir, recarga total de la página
    let validacionDespachoFlota="";
    Repo_Descripcion = $.trim($('#Repo_Descripcion').val());
    Repo_BusCambio = $.trim($('#Repo_BusCambio').val());
    Repo_HoraSalida = "";
    hora = $.trim($('#HoraSalida').val());
    minuto = $.trim($('#MinutoSalida').val());
    if(hora !="" && minuto!=""){
      Repo_HoraSalida = hora + ":" + minuto;
    }
    Repo_Motivo = $.trim($('#Repo_Motivo').val());
    validacionDespachoFlota=f_ValidarDespachoFlota(Repo_Descripcion);

    if(validacionDespachoFlota!="invalido") {
      $("#btnGuardarDespachoFlota").prop("disabled",true);
      // NUEVO REPORTE
      if(opcionDespachoFlota == 1){
        Accion='NuevoDespachoFlota';
        $.ajax({
            url: "Ajax.php",
            type: "POST",
            datatype:"json",
            data:  { MoS:MoS,NombreMoS:NombreMoS,Accion:Accion,ControlFacilitador_Id:ControlFacilitador_Id,Programacion_Id:Programacion_Id,Repo_Descripcion:Repo_Descripcion, Repo_BusCambio:Repo_BusCambio, Repo_HoraSalida:Repo_HoraSalida, Repo_Motivo:Repo_Motivo, Repo_CFaRgId:Repo_CFaRgId },
            success: function(data) {
            }
        });
      }
      // EDITAR REPORTE
      if(opcionDespachoFlota == 2){
        Accion='EditarDespachoFlota';
        $.ajax({
            url: "Ajax.php",
            type: "POST",
            datatype:"json",
            data:  { MoS:MoS,NombreMoS:NombreMoS,Accion:Accion,ControlFacilitador_Id:ControlFacilitador_Id,Programacion_Id:Programacion_Id,Repo_Descripcion:Repo_Descripcion, Repo_BusCambio:Repo_BusCambio, Repo_HoraSalida:Repo_HoraSalida, Repo_Motivo:Repo_Motivo },
            success: function(data) {
            }
        });
      }
      Accion='BuscarProgramacion';
      $.ajax({
          url: "Ajax.php",
          type: "POST",
          datatype:"json",
          data:  { MoS:MoS,NombreMoS:NombreMoS,Accion:Accion,Prog_Fecha:Prog_FechaDespachoFlota,turno_DespachoFlota:turno_DespachoFlota },
          success: function(data){
              $("#div_card-columns").empty();
              $("#div_card-columns-DespachoFlota").html(data);        
          }
      });
      $('#modalCRUDDespachoFlota').modal('hide');
    } 
  });    

});    


///:::::::::::::::::::::::::::: BOTONES DESPACHO FLOTA ::::::::::::::::::::::::::::::::::::::::::///

///::::::::: EVENTO BOTON BUSCAR DESPACHO FLOTA ::::::::::::::::::::::///       
$("#btnBuscarDespachoFlota").click(function(){
  Prog_FechaDespachoFlota = $("#Prog_FechaDespachoFlota").val();
  turno_DespachoFlota = $("#turno_DespachoFlota").val()
  // VALIDAR ESTADO DEL CONTROL FACILITADOR EN LA FECHA CORRESPONDIENTE
  existeDespachoFlota = f_ExisteDespachoFlotaTurno(Prog_FechaDespachoFlota,turno_DespachoFlota);
  if (existeDespachoFlota=="SI"){
    Accion='BuscarProgramacion';
    $.ajax({
      url: "Ajax.php",
      type: "POST",
      datatype:"json",
      data:  { MoS:MoS,NombreMoS:NombreMoS,Accion:Accion,Prog_Fecha:Prog_FechaDespachoFlota,turno_DespachoFlota:turno_DespachoFlota },
      success: function(data){
        $("#div_card-columns-DespachoFlota").html(data);        
      }
    });
  }else{
      Swal.fire(
        'NO Generado!',
        'El Despacho de Flota no se encuentra generado.',
        'success'
      )
  }
});

///::::::::::::::::::::::::: FUNCIONES REGISTRO SALIDA DE FLOTA ::::::::::::::::::::::::::::::::::::::::::///

///::::::: FUNCION PARA VALIDAR LOS DATOS INGRESADOS AL FORMULARIO :::::::::::::::::::///
function f_ValidarDespachoFlota(Repo_Descripcion){
  f_LimpiaDespachoFlota();
  NoLetrasMayuscEspacio=/[^A-Z \Ñ]/;
  let rptaDespachoFlota="";    
  if(Repo_Descripcion!=""){
    if(Repo_Descripcion.length>250){
      $("#MsRepo_Descripcion").text("*Máx 250 Caract.");
      $("#MsRepo_Descripcion").css("display", "flex" );
      Swal.fire({
        icon: 'error',
        title: 'DESCRIPCION...',
        text: '*Solo Mayusculas, Máx 250 Caract.!'
      })
      rptaDespachoFlota="invalido";
    }
  }
  return rptaDespachoFlota; 
}

///::::::::: INVISIBILIZA LOS MENSAJE DE ALERTA DEL FORMULARIO :::::: /// 
function f_LimpiaDespachoFlota(){
    $("#MsRepo_Descripcion").css("display", "none" );
}

function f_EditarReporteDespachoFlota(html_ControlFacilitador_Id){
    ControlFacilitador_Id = html_ControlFacilitador_Id;
    opcionDespachoFlota = 1; // NUEVO REPORTE
    f_LimpiaDespachoFlota();
    $("#formDespachoFlota").trigger("reset"); 
    $("#btnGuardarDespachoFlota").prop("disabled",false);
    $("#Repo_Descripcion").prop("disabled",false);
    $('#Repo_BusCambio').prop("disabled",false);
    $('#HoraSalida').prop("disabled",false);
    $('#MinutoSalida').prop("disabled",false);
    $('#Repo_Motivo').prop("disabled",false);
    
    // Se inicializan variables 
    Prog_Operacion = "";
    Programacion_Id = "";
    Repo_CFaRgId = "";
    Repo_Descripcion = "";
    Repo_BusCambio = "";
    Repo_Motivo = "";
    Repo_HoraSalida = "";
    HoraSalida = "";
    MinutoSalida = "";

    Accion = "BuscarReporte";
    $.ajax({
        url: "Ajax.php",
        type: "POST",
        datatype:"json",    
        async: false,
        data: {MoS:MoS,NombreMoS:NombreMoS,Accion:Accion,ControlFacilitador_Id:ControlFacilitador_Id},    
        success: function(data){
          data = $.parseJSON(data);
          $.each(data, function(idx, obj){ 
            Prog_Operacion = obj.Prog_Operacion;
            Programacion_Id = obj.Programacion_Id;
            Repo_CFaRgId = obj.CFaRg_Id;
            if (obj.Repo_Estado != null){
              opcionDespachoFlota = 2; // EDITAR REPORTE
              Repo_Descripcion = obj.Repo_Descripcion;
              Repo_BusCambio = obj.Repo_BusCambio;
              Repo_HoraSalida = obj.Repo_HoraSalida;
              HoraSalida = Repo_HoraSalida.substring(0,2);;
              MinutoSalida = Repo_HoraSalida.substring(3,5);
              Repo_Motivo = obj.Repo_Motivo;
              Repo_Estado = obj.Repo_Estado;
              if(Repo_Estado=="ATENDIDO"){
                opcionDespachoFlota = 0; // NO EDITAR
                $("#Repo_Descripcion").prop("disabled",true);
                $('#Repo_BusCambio').prop("disabled",true);
                $('#HoraSalida').prop("disabled",true);
                $('#MinutoSalida').prop("disabled",true);
                $('#Repo_Motivo').prop("disabled",true);
                $("#btnGuardarDespachoFlota").prop("disabled",true);
              }
            }
          });
        }
    });

    Accion='SelectBus'; 
    $.ajax({
      url: "Ajax.php",
      type: "POST",
      datatype:"json",
      async: false,    
      data: {MoS:MoS,NombreMoS:NombreMoS,Accion:Accion,Prog_Operacion:Prog_Operacion},    
      success: function(data){
        $("#Repo_BusCambio").html(data);
      }
    });

    Tipo='MOTIVO';
    Operacion='DESPACHO FLOTA'; 
    selectHtml = "";
    selectHtml = f_TipoTabla(Operacion,Tipo)
    $("#Repo_Motivo").html(selectHtml);

    $("#Repo_Descripcion").val(Repo_Descripcion);
    $("#Repo_BusCambio").val(Repo_BusCambio);
    $("#HoraSalida").val(HoraSalida);
    $("#MinutoSalida").val(MinutoSalida);
    $("#Repo_Motivo").val(Repo_Motivo);

    $(".modal-header").css("background-color", "#007bff");
    $(".modal-header").css("color", "white" );
    $(".modal-title").text("Editar Reporte");
    
    $("#modalCRUDDespachoFlota").modal("show");
}


function f_TurnoDespachoFlota(Prog_FechaDespachoFlota){
  let rptaTurno="";
  Accion='TurnoDespachoFlota';
  $.ajax({
        url: "Ajax.php",
        type: "POST",
        datatype:"json",
        async: false,
        data:  { MoS:MoS,NombreMoS:NombreMoS,Accion:Accion,Prog_Fecha:Prog_FechaDespachoFlota },
        success: function(data) {
          rptaTurno = data;
        }
  });
  return rptaTurno;
}

function f_ExisteDespachoFlotaTurno(Prog_FechaDespachoFlota,turno_DespachoFlota){
  let rptaExiste="";
  Accion='ExisteDespachoFlotaTurno'; 
  $.ajax({
      url: "Ajax.php",
      type: "POST",
      datatype:"json",
      async: false,    
      data: {MoS:MoS,NombreMoS:NombreMoS,Accion:Accion,Prog_Fecha:Prog_FechaDespachoFlota,turno_DespachoFlota:turno_DespachoFlota},    
      success: function(data){
        rptaExiste = data;
      }
  });
  return rptaExiste;
}
