///:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
///:::::::::::::::::::: REPORTE REPUESTOS v 1.0 FECHA: 22-08-2022 ::::::::::::::::::::::::::::::::::///
//::::::::::::::::::::::::::::::::::::: LISTAR VALES Y REPUESTOS :::::::::::::::::::::::::::::::::::///
///:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///

///::::::::::::::::::::::::::::::: Declaracion de Variables :::::::::::::::::::::::::::::::::::::///
var tablaReporte, FechaInicioReporte, FechaTerminoReporte;
FechaInicioReporte = "";
FechaTerminoReporte = "";

///::::::::::::::: JS CARGA DE DATA TABLE :::::::::::::://
$(document).ready(function(){
    if(FechaInicioReporte=="" && FechaTerminoReporte==""){
        FechaInicioReporte = f_CalculoFecha("hoy","-1 Month");
        FechaTerminoReporte = f_CalculoFecha("hoy","0");
        $('#FechaInicioReporte').val(FechaInicioReporte);
        $('#FechaTerminoReporte').val(FechaTerminoReporte);
    }

    // Si hay cambios en el Fecha se ocultan botones y datatable
    $("#FechaInicioReporte").on('change', function () {
        $("#div_tablaReporte").empty();
    });
    
    $("#FechaTerminoReporte").on('change', function () {
        $("#div_tablaReporte").empty();
    });

});    

///::::::::::::::::::::::::: BOTONES REPORTE :::::::::::::::::::::///

///:::::::::::::::::::::::: GENERAR REPORTE ::::::::::::::::::::::::::::::::::///
$("#btnBuscarReporte").on("click",function(){
    let t_DiferenciaFecha = "";
    FechaInicioReporte = $("#FechaInicioReporte").val();
    FechaTerminoReporte = $("#FechaTerminoReporte").val();

    t_DiferenciaFecha = f_DiferenciaFecha(FechaInicioReporte,FechaTerminoReporte);

    if(t_DiferenciaFecha=="NO"){
        Swal.fire({
            position: 'center',
            icon: 'error',
            title: 'Periodo de Tiempo',
            html: "Debe ser menor a 1 año !!!",
            showConfirmButton: false,
            timer: 1500
          })
    }else{
        div_tabla = f_CreacionTabla("tablaReporte","");
        $("#div_tablaReporte").html(div_tabla);
        columnastabla = f_ColumnasTabla("tablaReporte","");
      
        $("#tablaReporte").dataTable().fnDestroy();
        $('#tablaReporte').show();
    
        // Setup - add a text input to each footer cell
        $('#tablaReporte thead tr')
            .clone(true)
            .addClass('filtersReporte')
            .appendTo('#tablaReporte thead');
    
        Accion='LeerReporte';
        tablaReporte = $('#tablaReporte').DataTable({
            "rowCallback":function(row,data,index){
                f_ColorFilasVales(row,data);
              }, 
            //Filtros por columnas
            orderCellsTop   : true,
            fixedHeader     : true,
            initComplete    : function (){
                var api = this.api();
                // For each column
                api.columns().eq(0).each(function (colIdx) {
                    // Set the header cell to contain the input element
                    var cell = $('.filtersReporte th').eq($(api.column(colIdx).header()).index());
                    var title = $(cell).text();
                    $(cell).html('<input type="text" placeholder="' + title + '" />');
                    // On every keypress in this input
                    $('input',$('.filtersReporte th').eq($(api.column(colIdx).header()).index()) ).off('keyup change').on('keyup change', function (e) {
                        e.stopPropagation();
                        // Get the search value
                        $(this).attr('title', $(this).val());
                        var regexr = '({search})'; //$(this).parents('th').find('select').val();
                        var cursorPosition = this.selectionStart;
                        // Search the column for that value
                        api.column(colIdx).search(
                            this.value != '' ? regexr.replace('{search}', '(((' + this.value + ')))'): '',
                            this.value != '',
                            this.value == ''
                        ).draw();
                        $(this).focus()[0].setSelectionRange(cursorPosition, cursorPosition);
                    });
                });
            },
            // Para mostrar la barra scroll horizontal y vertical
            deferRender     : true,
            scrollY         : 800,
            scrollCollapse  : true,
            scroller        : true,
            scrollX         : true,
            fixedColumns    : {
                left: 1
            },
            fixedHeader     : {
                header : false
            },
            pageLength      : 50,
            language        : idiomaEspanol, 
            responsive      : "true",
            dom             : 'Bfrtip',
            buttons         :[
                {
                    extend      : 'excelHtml5',
                    text        : '<i class="fas fa-file-excel"></i> ',
                    titleAttr   : 'Exportar a Excel',
                    className   : 'btn btn-success',
                    title       : 'REPORTE REPUESTOS DEL '+FechaInicioReporte+' AL '+FechaTerminoReporte,
                },
            ],
            "ajax"          :{            
                "url"       : "Ajax.php", 
                "method"    : 'POST', //usamos el metodo POST
                "data"      : {MoS:MoS, NombreMoS:NombreMoS, Accion:Accion, FechaInicioReporte:FechaInicioReporte, FechaTerminoReporte:FechaTerminoReporte}, //enviamos opcion 4 para que haga un SELECT
                "dataSrc"   : ""
            },
            "columns"       : columnastabla,
            "order"         : [[9,'desc'], [0,'desc']]
        });     
    }
});  

function f_ColorFilasVales(row,data){
    let color;
    // Columna Estado
    switch(data.va_estado)
    {
        case "CERRADO":
            color = "#53A258";
        break;
        case "OBSERVADO":
            color = "#EC515D";
        break;
        case "ANULADO":
            color = "#00A3D6";
        break;
        case "ABIERTO":
            color = "#FF9D0A";
        break;
        case "PENDIENTE CT":
            color = "#EC515D";
        break;
    }
    $("td:eq(1)",row).css({
      "color":color,
      "font-weight":"bold",
    });
  }