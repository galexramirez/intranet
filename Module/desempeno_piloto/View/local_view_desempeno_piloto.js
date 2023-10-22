///::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
///:: DESEMPEÑO DE PILOTO v1.0 FECHA: 2023-10-21 ::::::::::::::::::::::::::::::::::::::::::///
//::: INFORMACION GRAFICA DE INASISTENCIAS, COMPORTAMIENTO Y ACCIDENTES DEL PILOTO ::::::::///
///::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///

var dp_fecha_inicio, dp_fecha_termino;
var rootElements = {};

dp_fecha_inicio = "";
dp_fecha_termino = "";

$(document).ready(function(){

  if(dp_fecha_inicio=="" && dp_fecha_termino==""){
    dp_fecha_inicio = f_CalculoFecha("hoy","-1 Week");
    dp_fecha_termino = f_CalculoFecha("hoy","0");
    $('#dp_fecha_inicio').val(dp_fecha_inicio);
    $('#dp_fecha_termino').val(dp_fecha_termino);
  }

  // Si hay cambios en el Fecha se ocultan botones y datatable
  $("#dp_fecha_inicio, #dp_fecha_termino").on('change', function () {
    div_show = f_MostrarDiv("form_desempeno_piloto", "content","vacio");
    $("#content").html(div_show);
  });

  $(document).on("click", ".btn_cargar_desempeno_piloto", function(){
    div_show = f_MostrarDiv("form_desempeno_piloto", "content", "cargar");
    $("#content").html(div_show);
  });
});    


///:: FUNCIONES DESEMPEÑO DE PILOTO :::::::::::::::::::::::::::::::::::::::::::::::::::::::///

///:: TERMINO FUNCIONES DESEMPEÑO DE PILOTO :::::::::::::::::::::::::::::::::::::::::::::::///