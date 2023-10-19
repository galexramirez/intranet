///:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
///:::::::::::::::::::: INICIO v 2.0 :::::::::::::::::::::::::///
///::::::::::::: VARIABLES Y FUNCIONES GLOBALES ::::::::::::::///
///:::::::::::: FECHA: 2022-02-24 12:50 ::::::::::::::::::::::///

///::::::::::: Declaracion de Variables GLOBALES :::::::::::::///
// MoS: Module o Services, NombreMoS: Nombre del modulo o servicio, Accion: Funcion a ejecutar
var MoS, NombreMoS, Accion;
MoS = "Module";
NombreMoS = "AjusteOperaciones";
// Variable para cambiar el lenguaje a español de un datatable
var idiomaEspanol = {
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
  "select":
    {
      "rows":
      {
        "_": "Seleccionadas %d filas",
        "0": "Click a una fila para seleccionarla",
        "1": "Seleccionada 1 fila"
      }
    },
  "sProcesssing": "Procesando...",
};

///::::::::: ACTIVA LOS TABS ::::::::::::: ///
$(document).ready(function() {
  $( "#tabs" ).tabs();
});