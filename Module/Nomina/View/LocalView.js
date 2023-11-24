///::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
///:: REPORTE DE NOMINA v 2.0  FECHA: 2023-11-22 ::::::::::::::::::::::::::::::::::::::::::///
///:: MOSTRAR RESUMEN DE PROGRAMCION POR PILOTO :::::::::::::::::::::::::::::::::::::::::::///
///::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///

///:: DECLARACION DE VARIABLES ::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
var fecha_inicio, fecha_termino, tabla_nomina;
fecha_inicio = fecha_termino = "";

///:: JS DOM REPORTE DE NOMINA ::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
$(document).ready(function(){
  if(fecha_inicio=="" && fecha_termino==""){
    fecha_inicio   = f_CalculoFecha("hoy","-1 month");
    fecha_termino  = f_CalculoFecha("hoy","0");
    $('#fecha_inicio').val(fecha_inicio);
    $('#fecha_termino').val(fecha_termino);
  }

  // Si hay cambios en el Fecha se ocultan botones y datatable
  $("#fecha_inicio, #fecha_termino").on('change', function () {
    $("#tabla_nomina").dataTable().fnDestroy();
    $('#tabla_nomina').hide();  
  });

  ///:: BOTON QUE CARGA DE DATA TABLE DE NOMINA :::::::::::::::::::::::::::::::::::::::::::7//
  $("#btn_cargar_nomina").on("click",function(){
    let t_validar_nomina = "";
    fecha_inicio = $("#fecha_inicio").val();
    fecha_termino = $("#fecha_termino").val();
    t_validar_nomina = f_validar_nomina(fecha_inicio,fecha_termino);

    if(t_validar_nomina=="invalido"){
      Swal.fire({
        icon: 'error',
        title: 'Fechas...',
        text: '*Información incorrecta!'
      })
    }else{
      div_tabla       = f_CreacionTabla("tabla_nomina","");
      columnas_tabla  = f_ColumnasTabla("tabla_nomina","");
      $("#div_tabla_nomina").html(div_tabla);
    
      $("#tabla_nomina").dataTable().fnDestroy();
      $('#tabla_nomina').show();

      Accion = 'CargarNomina';  
      tabla_nomina = $('#tabla_nomina').DataTable({
        "processing"  : true,
        language      : idioma_espanol,
        pageLength    : 100,
        responsive    : "true",
        dom           : 'Blfrtip',
        buttons:
          [
            {
                extend:     'excelHtml5',
                text:       '<i class="fas fa-file-excel"></i> ',
                titleAttr:  'Exportar a Excel',
                className:  'btn btn-success',
                title:      'Nomina del ' + fecha_inicio + ' al ' + fecha_termino,
                filename:   'Nomina del ' + fecha_inicio + ' al ' + fecha_termino,
            },
          ],
        "ajax":{            
                "url"     : "Ajax.php", 
                "method"  : 'POST',
                "data"    : {MoS:MoS, NombreMoS:NombreMoS, Accion:Accion, fecha_inicio:fecha_inicio, fecha_termino:fecha_termino},
                "dataSrc" : ""
                },
        "columns": columnas_tabla,
        "columnDefs"      : [
          { 
            "className"   : "text-center",
            "targets"     : [0,1,2,4,5,6,7]
          },
        ],
        "order"           : [[0, 'desc']]
      });
    }
  });
  ///:: FIN BOTON QUE CARGA DE DATA TABLE DE NOMINA :::::::::::::::::::::::::::::::::::::::7//
});    
///:: FIN JS DOM REPORTE DE NOMINA ::::::::::::::::::::::::::::::::::::::::::::::::::::::::///

///:: FUNCION PARA VALIDAR LOS DATOS INGRESADOS AL FORMULARIO :::::::::::::::::::::::::::::///
function f_validar_nomina(fecha_inicio, fecha_termino){
  f_limpia_nomina();
  let rpta_nomina="";    

  if(fecha_termino < fecha_inicio){
    $("#fecha_inicio").addClass("color-error");
    rpta_nomina="invalido";
  }
  if(fecha_termino=="" | fecha_inicio==""){
    $("#fecha_inicio").addClass("color-error");
    $("#fecha_termino").addClass("color-error");  
    rpta_nomina="invalido";
  }
  return rpta_nomina; 
}

///::: FUNCION REESTABLECE EL COLOR DE LOS CAMPOS DEL FORMULARIO ::::::::::::::::::::::::::///
function f_limpia_nomina(){
  $("#fecha_inicio").removeClass("color-error");
  $("#fecha_termino").removeClass("color-error");
}