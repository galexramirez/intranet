///::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
///:: REPORTE DE NOMINA v 2.0  FECHA: 2023-11-22 ::::::::::::::::::::::::::::::::::::::::::///
///:: MOSTRAR RESUMEN DE PROGRAMCION POR PILOTO :::::::::::::::::::::::::::::::::::::::::::///
///::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///

///:: DECLARACION DE VARIABLES ::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
var hn_fecha, tabla_listado_horarios_nomina, hn_operacion;
hn_fecha = "";

///:: JS DOM REPORTE DE NOMINA ::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
$(document).ready(function(){
  if(hn_fecha==""){
    hn_fecha = f_CalculoFecha("hoy","0");
    $('#hn_fecha').val(hn_fecha);
  }

  // Si hay cambios en el Fecha se ocultan botones y datatable
  $("#hn_fecha, #hn_operacion").on('change', function () {
    $("#tabla_listado_horarios_nomina").dataTable().fnDestroy();
    $('#tabla_listado_horarios_nomina').hide();  
  });

  ///:: BOTON QUE CARGA DE DATA TABLE DE NOMINA :::::::::::::::::::::::::::::::::::::::::::7//
  $("#btn_buscar_horarios_nomina").on("click",function(){
    hn_fecha = $("#hn_fecha").val();
    hn_operacion = $("#hn_operacion").val();

      div_tabla       = f_CreacionTabla("tabla_listado_horarios_nomina","");
      columnas_tabla  = f_ColumnasTabla("tabla_listado_horarios_nomina","");
      $("#div_tabla_listado_horarios_nomina").html(div_tabla);
    
      $("#tabla_listado_horarios_nomina").dataTable().fnDestroy();
      $('#tabla_listado_horarios_nomina').show();

      Accion = 'listar_horarios_nomina';
      tabla_listado_horarios_nomina = $('#tabla_listado_horarios_nomina').DataTable({
        "processing"  : true,
        language      : idioma_espanol,
        pageLength    : 25,
        responsive    : "true",
        dom           : 'Blfrtip',
        buttons:
          [
            {
                extend:     'excelHtml5',
                text:       '<i class="fas fa-file-excel"></i> ',
                titleAttr:  'Exportar a Excel',
                className:  'btn btn-success',
                title:      'Horarios Nomina del ' + hn_fecha,
                filename:   'Horarios Nomina del ' + hn_fecha,
            },
          ],
        "ajax":{            
                "url"     : "Ajax.php", 
                "method"  : 'POST',
                "data"    : {MoS:MoS, NombreMoS:NombreMoS, Accion:Accion, hn_fecha:hn_fecha, hn_operacion:hn_operacion},
                "dataSrc" : ""
                },
        "columns": columnas_tabla,
        "columnDefs"      : [
          { 
            "className"   : "text-center",
            "targets"     : [0,1,2]
          },
        ],
        "order"           : [[1, 'asc']]
      });
  });
  ///:: FIN BOTON QUE CARGA DE DATA TABLE DE NOMINA :::::::::::::::::::::::::::::::::::::::7//
});    
///:: FIN JS DOM REPORTE DE NOMINA ::::::::::::::::::::::::::::::::::::::::::::::::::::::::///

///:: FUNCION PARA VALIDAR LOS DATOS INGRESADOS AL FORMULARIO :::::::::::::::::::::::::::::///

