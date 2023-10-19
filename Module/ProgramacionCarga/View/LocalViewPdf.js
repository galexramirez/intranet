///::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
///::::::::::::::::::: PROGRAMACION PDF v 6.0 FECHA: 20-01-2023 :::::::::::::::::::::::::::///
///:::::::::::::::: MOSTRAR EL ARCHIVO PDF DE LA PROGRAMACION DE PILOTOS Y BUSES ::::::::::///
///::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///

///::::::::::::::::::::::::::::::: Declaracion de Variables :::::::::::::::::::::::::::::::///
var Dni;

///::::::::::::::::::::::::: JS DOM PROGRAMACION PDF ::::::::::::::::::::::::::::::::::::::///
$(document).ready(function(){
  ///::::::::::::::::::: SELECCION DE AÑOS ::::::::::::::::::::::::::::::::::::::::::::::::///
  $("#selectAniosPDF").on('change', function () {
    $("#tablaPDF").dataTable().fnDestroy();
    $('#tablaPDF').hide();
  });
  
  $("#PDF_Dni").on('click', function () {
    $("#tablaPDF").dataTable().fnDestroy();
    $('#tablaPDF').hide();
  });

  ///::::::::::::::::::::::: BOTONES BUSCAR PUBLICACIONES :::::::::::::::::::::::::::::::::///

  ///:::::::::: BOTON BUSCAR PUBLICACIONES -> LLENA TABLA DE PUBLICACIONES ::::::::::::::::///
  $("#btnMostrarPDF").on("click",function(){
    Dni = $("#PDF_Dni").val();
    validacion = validarDni(Dni);
  
    if(validacion!="invalido"){
      AniosPublicados = $("#selectAniosPDF").val();

      div_tabla = f_CreacionTabla("tablaPDF","");
      $("#div_tablaPDF").html(div_tabla);
      columnastabla = f_ColumnasTabla("tablaPDF","");

      $("#tablaPDF").dataTable().fnDestroy();
      $('#tablaPDF').show();

      Accion='BuscarPublicacionCarga';  // Accion para Ajax Local
      tablaPDF = $('#tablaPDF').DataTable({
        language: idiomaEspanol,
        order: [[ 0, "desc" ]],
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
          "data":{MoS:MoS,NombreMoS:NombreMoS,Accion:Accion,AniosPublicados:AniosPublicados,Dni:Dni}, //enviamos opcion 4 para que haga un SELECT
          "dataSrc":""
        },
        "columns": columnastabla
      });
    }
  });
  //:::::::: FIN BOTON BUSCAR PUBLICACIONES -> LLENA TABLA DE PUBLICACIONES :::::::::::::::///
  
  ///:::::::::::::::::::::::  BOTON DESCARGA ARCHIVO PDF  :::::::::::::::::::::::::::::::::///
  $(document).on("click", ".btnPDF_Individual", function(){
    fila = $(this);           
    PubRg_Id = $(this).closest('tr').find('td:eq(0)').text();     
    PubRg_SemanaPublicada = $(this).closest('tr').find('td:eq(1)').text();
    Semana = PubRg_SemanaPublicada+PubRg_Id;
    Dni = $("#PDF_Dni").val();
    window.open(miCarpeta+"Module/ProgramacionCarga/Controller/PDF_Individual.php?Semana="+Semana+"&Dni="+Dni, '_blank');
  });
  ///::::::::::::::::::::: FIN BOTON DESCARGA ARCHIVO PDF  ::::::::::::::::::::::::::::::::///
  
  ///::::::::::::::::::: TERMINO BOTONES BUSCAR PUBLICACIONES :::::::::::::::::::::::::::::///

});
///:::::::::::::::::::::: TERMINO JS DOM PROGRAMACION PDF :::::::::::::::::::::::::::::::::///

///:::::::::::::::::::::::: FUNCIONES PROGRAMACION PDF ::::::::::::::::::::::::::::::::::::///

///:::::::::::: FUNCION PARA VALIDAR LOS DATOS INGRESADOS AL FORMULARIO :::::::::::::::::::///
function validarDni(PDF_Dni){
  var respuesta="";    

  if(PDF_Dni=="" || isNaN(PDF_Dni) ||  PDF_Dni.length!=8)
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
///:::::::::::: FIN FUNCION PARA VALIDAR LOS DATOS INGRESADOS AL FORMULARIO :::::::::::::::///

///::::::::::::::::::::: TERMINO FUNCIONES PROGRAMACION PDF :::::::::::::::::::::::::::::::///