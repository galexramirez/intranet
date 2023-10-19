///::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
///:::::::::::::::::::: MAESTRO UNO v 1.0 FECHA: 25-10-2022 ::::::::::::::::::::::::::::::::::///
//:::::::::::::::::: CREAR, EDITAR, ELIMINAR TABLA DE COLABORADORES ::::::::::::::::::::::::::::///
///::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///

///::::::::::::::::::::::::::::::: Declaracion de Variables :::::::::::::::::::::::::::::::::::::///
var MoS,NombreMoS,Accion,idiomaEspanol, div_tabs, div_tablas, div_boton, div_show, columnastabla;
MoS='Module';
NombreMoS='AjusteUsuario';
idiomaEspanol={
    "lengthMenu": "&nbsp&nbsp&nbsp&nbspMostrar _MENU_ registros",
    "zeroRecords": "No se encuentran resultados",
    "info": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
    "infoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
    "infoFiltered": "(Filtrado de un total de _MAX_ registros)",
    "sSearch": "Buscar:",
    "oPaginate": {
        "sFirst": "Primero",
        "sLast": "Ultimo",
        "sNext": "Siguiente",
        "sPrevious": "Anterior"
    },
    "sProcesssing": "Procesando...",
};

///::::::::::::::: JS DOM OT PREVENTIVAS :::::::::::::://
$(document).ready(function(){

});


///::::::::::::::::::::::::::::::::: FUNCIONES DE MAESTRO UNO ::::::::::::::::::::::::::::::::::::///
function f_TipoTabla(p_Operacion,p_Tipo){
  let rptaSelect="";
  Accion='SelectTipos';
  $.ajax({
    url: "Ajax.php",
    type: "POST",
    datatype:"json",
    async: false,
    data: {MoS:MoS,NombreMoS:NombreMoS,Accion:Accion,ttablamaestrouno_operacion:p_Operacion,ttablamaestrouno_tipo:p_Tipo},    
    success: function(data){
      rptaSelect = data;
    }
  });
  return rptaSelect;
}

