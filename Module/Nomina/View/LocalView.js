$(document).ready(function()
{
  $('#tablaUsuarios').hide();  

  ///::::::::::::::: JS CARGA DE DATA TABLE :::::::::::::://
  $("#btnCargarNomina").on("click",function()
  {
      var MoS,NombreMoS,Accion;    
      var FechaInicio = $("#FechaInicio").val();
      var FechaTermino = $("#FechaTermino").val();
    
      // Nivel Modulo o Servicio donde se esta trabajando    
      MoS='Module';
      // Nombre del Modulo o Servicio donde se esta trabajando      
      NombreMoS='Nomina';
      // Nombre
      Accion='CargarNomina';

      validacion = validar(FechaInicio,FechaTermino);

      if(validacion!="invalido"){
      $("#tablaUsuarios").dataTable().fnDestroy();
      $('#tablaUsuarios').show();
      tablaUsuarios = $('#tablaUsuarios').DataTable({
        //Para cambiar el lenguaje a español
        language:
          {
            "lengthMenu": "&nbsp&nbsp&nbsp&nbspMostrar _MENU_ registros",
            "zeroRecords": "No se encuentran resultados",
            "info": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
            "infoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
            "infoFiltered": "(Filtrado de un total de _MAX_ registros)",
            "sSearch": "Buscar:",
            "oPaginate": 
              {
                "sFirst": "Primero",
                "sLast": "Ultimo",
                "sNext": "Siguiente",
                "sPrevious": "Anterior"
              },
            "sProcesssing": "Procesando...",
          },
        //Para usar los botones
        responsive: "true",
        dom: 'Blfrtip', // Con Botones Excel,Pdf,Print
        buttons:
          [
            {
                extend:     'excelHtml5',
                text:       '<i class="fas fa-file-excel"></i> ',
                titleAttr:  'Exportar a Excel',
                className:  'btn btn-success',
                title:      'Nomina del ' + FechaInicio + ' al ' + FechaTermino,
                filename:   'Nomina del ' + FechaInicio + ' al ' + FechaTermino,
            },
        /*    {
                extend:     'pdfHtml5',
                text:       '<i class="fas fa-file-pdf"></i> ',
                titleAttr:  'Exportar a PDF',
                className:  'btn btn-danger'
            }, 
            {
                extend:     'print',
                text:       '<i class="fa fa-print"></i> ',
                titleAttr:  'Imprimir',
                className:  'btn btn-info'
            },*/
          ],
        "ajax":{            
                "url": "Ajax.php", 
                "method": 'POST', //usamos el metodo POST
                "data":{MoS:MoS,NombreMoS:NombreMoS,Accion:Accion,FechaInicio:FechaInicio,FechaTermino:FechaTermino}, //enviamos opcion 4 para que haga un SELECT
                "dataSrc":""
                },
        "columns":[
                  {"data": "Fecha"},
                  {"data": "Codigo"},                    
                  {"data": "DNI"},                    
                  {"data": "ApellidosNombres"},                    
                  {"data": "HoraInicio"},
                  {"data": "HoraTermino"},                    
                  {"data": "Amplitud"},
                  {"data": "Duracion"},
                  {"data": "TipoOperacion"},
                  {"data": "Servicio"}
                  ]
      });
      }
  });
});    


///::::::: FUNCION PARA VALIDAR LOS DATOS INGRESADOS AL FORMULARIO :::::::::::::::::::///
function validar(FechaInicio,FechaTermino){

  LimpiaMs();

  NoLetrasMayuscEspacio=/[^A-Z ]/;
  var respuesta="";    

  if(FechaTermino < FechaInicio)
      {
      //   $("#MsFechaTermino").text("*Fecha de Termino debe ser mayor");
      //   $("#MsFechaTermino").css("display", "flex" );
         Swal.fire({
          icon: 'error',
          title: 'Fechas...',
          text: '*Fecha de Termino debe ser mayor!'
        })

         respuesta="invalido";
      }
  if(FechaTermino=="" | FechaInicio=="")
      {
      //   $("#MsFechaTermino").text("*Fechas no pueden ser vacios");
      //   $("#MsFechaTermino").css("display", "flex" );
         Swal.fire({
          icon: 'error',
          title: 'Fechas...',
          text: '*Fechas no pueden ser vacios!'
         })

         respuesta="invalido";
      }
  return respuesta; 
}

///::::::::: INVISIBILIZA LOS MENSAJE DE ALERTA DEL FORMULARIO :::::: /// 
function LimpiaMs(){
    $("#MsFechaInicio").css("display", "none" );
    $("#MsFechaTermino").css("display", "none" );
}

