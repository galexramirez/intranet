///::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
///:::::::::::::::::: DETALLE DE PROGRAMACION v 6.0 FECHA: 20-01-2023 :::::::::::::::::::::///
///:::::::::::::::::::: MOSTRAR LA PROGRAMACION DE PILOTOS ::::::::::::::::::::::::::::::::///
///::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///

///::::::::::::::::::::::::::::::: Declaracion de Variables :::::::::::::::::::::::::::::::///

///::::::::::::::::::::::::: JS DOM DETALLE DE PROGRAMACION :::::::::::::::::::::::::::::::///
$(document).ready(function(){

  ///::::::::::::::::::: BOTONES DE DETALLE DE PROGRAMACION :::::::::::::::::::::::::::::::///
  
  ///::::::::::::::: BOTON QUE GENERA DATATABLE DETALLE DE PROGRAMACION :::::::::::::::::::///
  $("#btnMostrarDetalleProgramacion").on("click",function(){
    var FechaInicio = $("#FechaInicio").val();
    var FechaTermino = $("#FechaTermino").val();
    var Prog_Dni = $("#Prog_Dni").val();
    
    $('#tablaDetalleProgramacion').hide();  
    validacion = validar_fecha(FechaInicio,FechaTermino,Prog_Dni);

    if(validacion!="invalido"){
      div_tabla = f_CreacionTabla("tablaDetalleProgramacion","");
      $("#div_tablaDetalleProgramacion").html(div_tabla);
      columnastabla = f_ColumnasTabla("tablaDetalleProgramacion","");
  
      $("#tablaDetalleProgramacion").dataTable().fnDestroy();
      $('#tablaDetalleProgramacion').show();
      Accion='DetalleProgramacion';
      tablaDetalleProgramacion = $('#tablaDetalleProgramacion').DataTable({
        language: idiomaEspanol,
        responsive: "true",
        dom: 'Blfrtip', // Con Botones Excel,Pdf,Print
        buttons:[
                  {
                    extend:     'excelHtml5',
                    text:       '<i class="fas fa-file-excel"></i> ',
                    titleAttr:  'Exportar a Excel',
                    className:  'btn btn-success'
                  },
                ],
        "ajax":{            
                "url": "Ajax.php", 
                "method": 'POST', //usamos el metodo POST
                "data":{MoS:MoS,NombreMoS:NombreMoS,Accion:Accion,FechaInicio:FechaInicio,FechaTermino:FechaTermino,Prog_Dni:Prog_Dni}, //enviamos opcion 4 para que haga un SELECT
                "dataSrc":""
                },
        "columns": columnastabla
      });
    }
  });    
  ///:::::::::::::: FIN BOTON QUE GENERA DATATABLE DETALLE DE PROGRAMACION ::::::::::::::::///
  
  ///::::::::::::::::: TERMINO BOTONES DE DETALLE DE PROGRAMACION :::::::::::::::::::::::::///

});
///:::::::::::::::::::::::: FIN JS DOM DETALLE DE PROGRAMACION ::::::::::::::::::::::::::::///


///::::::::::::::::::::: FUNCIONES DE DETALLE DE PROGRAMACION :::::::::::::::::::::::::::::///

///::::::: FUNCION PARA VALIDAR LOS DATOS INGRESADOS AL FORMULARIO ::::::::::::::::::::::::///
function validar_fecha(FechaInicio,FechaTermino,Prog_Dni){
  var respuesta="";    

  if(FechaTermino < FechaInicio)
      {
         Swal.fire({
          icon: 'error',
          title: 'Fechas...',
          text: '*Fecha de Termino debe ser mayor!'
        })
         respuesta="invalido";
      }

  if(FechaTermino=="" | FechaInicio=="")
      {
         Swal.fire({
          icon: 'error',
          title: 'Fechas...',
          text: '*Fechas no pueden ser vacios!'
         })
         respuesta="invalido";
      }
      
  if(Prog_Dni=="" || isNaN(Prog_Dni) ||  Prog_Dni.length!=8)
      {
        Swal.fire({
          icon: 'error',
          title: 'DNI...',
          text: '*Requiere 8 Números!'
        })
        respuesta="invalido";
      }
    
  return respuesta; 
}
///::::::: FIN FUNCION PARA VALIDAR LOS DATOS INGRESADOS AL FORMULARIO ::::::::::::::::::::///

///:::::::::::::::::: TERMINO FUNCIONES DE DETALLE DE PROGRAMACION ::::::::::::::::::::::::///