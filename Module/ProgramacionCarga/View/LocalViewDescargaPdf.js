///::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
///:::::::::::::: DESCARGA DE LA PROGRAMACION v 6.0 FECHA: 20-01-2023 :::::::::::::::::::::///
///::::: MOSTRAR LAS DESCARFAS DE LA PROGRAMACION DE PILOTO :::::::::::::::::::::::::::::::///
///::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///

///::::::::::::::::::::::::::::::: Declaracion de Variables :::::::::::::::::::::::::::::::///

///::::::::::::::::::::::::: JS DOM DESCARGA DE LAPROGRAMACION ::::::::::::::::::::::::::::///
$(document).ready(function(){

  ///::::::::::::::: JS BOTOTN CARGA DE DATA TABLE ::::::::::::::::::::::::::::::::::::::::///
  $("#btnMostrarDescargaPdf").on("click",function(){
    var Desc_FechaInicio = $("#Desc_FechaInicio").val();
    var Desc_FechaTermino = $("#Desc_FechaTermino").val();
    var Desc_Prog_Dni = $("#Desc_Prog_Dni").val();
    desc_validacion = desc_validar_fecha(Desc_FechaInicio,Desc_FechaTermino,Desc_Prog_Dni);
  
    if(desc_validacion!="invalido"){
      div_tabla = f_CreacionTabla("tablaDescargaPdf","");
      $("#div_tablaDescargaPdf").html(div_tabla);
      columnastabla = f_ColumnasTabla("tablaDescargaPdf","");
      
      $("#tablaDescargaPdf").dataTable().fnDestroy();
      $('#tablaDescargaPdf').show();
      
      Accion='DetalleDescargaPdf';
      tablaDescargaPdf = $('#tablaDescargaPdf').DataTable({
        language: idiomaEspanol,
        responsive: "true",
        dom: 'Blfrtip', // Con Botones Excel,Pdf,Print
        buttons:
            [
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
          "data":{MoS:MoS,NombreMoS:NombreMoS,Accion:Accion,Desc_FechaInicio:Desc_FechaInicio,Desc_FechaTermino:Desc_FechaTermino,Desc_Prog_Dni:Desc_Prog_Dni}, //enviamos opcion 4 para que haga un SELECT
          "dataSrc":""
        },
        "columns": columnastabla
        });
      }
    });    
  
});


///::::::: FUNCION PARA VALIDAR LOS DATOS INGRESADOS AL FORMULARIO :::::::::::::::::::///
function desc_validar_fecha(Desc_FechaInicio,Desc_FechaTermino){
  let respuesta="";    

  if(Desc_FechaTermino < Desc_FechaInicio)
      {
         Swal.fire({
          icon: 'error',
          title: 'Fechas...',
          text: '*Fecha de Termino debe ser mayor!'
        })
         respuesta="invalido";
      }

  if(Desc_FechaTermino=="" | Desc_FechaInicio=="")
      {
         Swal.fire({
          icon: 'error',
          title: 'Fechas...',
          text: '*Fechas no pueden ser vacios!'
         })
         respuesta="invalido";
      }
  return respuesta; 
}