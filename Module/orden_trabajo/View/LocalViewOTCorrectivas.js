///::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
///:: OT CORRECTIVAS v 2.0 FECHA: 2023-06-21 ::::::::::::::::::::::::::::::::::::::::::::::///
///:: CREAR, EDITAR, ELIMINAR TABLA DE OT CORRECTIVAS :::::::::::::::::::::::::::::::::::::///
///::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///

///:: DECLARACION DE VARIABLES ::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
var tablaOT, selectAniosOT, FechaInicioOT, FechaTerminoOT, fila_ot, ot_observadas;
FechaInicioOT   = "";
FechaTerminoOT  = "";
mi_carpeta      = f_DocumentRoot();
const fecha_hoy = new Date();

///:: JS DOM OT CORRECTIVAS :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
$(document).ready(function(){
    ot_observadas = f_ot_observadas();
    $("#ot_alerta").html(ot_observadas);

    if(FechaInicioOT=="" && FechaTerminoOT==""){
        FechaInicioOT = f_CalculoFecha("hoy","-1 Months");
        FechaTerminoOT = f_CalculoFecha("hoy","0");
        $('#FechaInicioOT').val(FechaInicioOT);
        $('#FechaTerminoOT').val(FechaTerminoOT);
    }

    // Si hay cambios en el Fecha se ocultan botones y datatable
    $("#FechaInicioOT").on('change', function () {
        $("#div_tablaOT").empty();
    });
    
    $("#FechaTerminoOT").on('change', function () {
        $("#div_tablaOT").empty();
    });

    ///:: BOTONES DE OT CORRECTIVAS :::::::::::::::::::::::::::::::::::::::::::::::::::::::///

    ///:: BOTON BUSCAR OT CORRECTIVAS :::::::::::::::::::::::::::::::::::::::::::::::::::::///
    $("#btnBuscarOT").on("click",function(){
        FechaInicioOT = $("#FechaInicioOT").val();
        FechaTerminoOT = $("#FechaTerminoOT").val();

        div_tabla = f_CreacionTabla("tablaOT","");
        $("#div_tablaOT").html(div_tabla);
        columnastabla = f_ColumnasTabla("tablaOT","");
    
        $("#tablaOT").dataTable().fnDestroy();
        $('#tablaOT').show();

        // Setup - add a text input to each footer cell
        $('#tablaOT thead tr')
            .clone(true)
            .addClass('filtersOT')
            .appendTo('#tablaOT thead');

        Accion='LeerOT';
        tablaOT = $('#tablaOT').DataTable({
            //Color a las filas
            "rowCallback":function(row,data,index){
                f_ColorFilasOTCorrectivas(row,data);
              }, 
            //Filtros por columnas
            orderCellsTop: true,
            fixedHeader: true,
            initComplete: function (){
                var api = this.api();
                // For each column
                api.columns().eq(0).each(function (colIdx) {
                    // Set the header cell to contain the input element
                    var cell = $('.filtersOT th').eq($(api.column(colIdx).header()).index());
                    var title = $(cell).text();
                    $(cell).html('<input type="text" placeholder="' + title + '" />');
                    // On every keypress in this input
                    $('input',$('.filtersOT th').eq($(api.column(colIdx).header()).index()) ).off('keyup change').on('keyup change', function (e) {
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
            deferRender:    true,
            scrollY:        800,
            scrollCollapse: true,
            scroller:       true,
            scrollX:        true,
            select          : {style: 'os'},
            fixedColumns:{
                left: 1
            },
            fixedHeader:{
                header : false
            },
            //Para mostrar 50 registros popr página 
            pageLength  : 50,
            //Para cambiar el lenguaje a español
            language: idiomaEspanol, 
            //Para usar los botones
            responsive  : "true",
            dom         : 'Blfrtip', // Con Botones Excel,Pdf,Print
            buttons:[
                {
                    extend      : 'excelHtml5',
                    text        : '<i class="fas fa-file-excel"></i> ',
                    titleAttr   : 'Exportar a Excel',
                    className   : 'btn btn-success',
                    title       : 'OT CORRECTIVAS',
                },
            ],
            "ajax":{            
                "url": "Ajax.php", 
                "method": 'POST', //usamos el metodo POST
                "data": {MoS:MoS,NombreMoS:NombreMoS,Accion:Accion,FechaInicioOT:FechaInicioOT,FechaTerminoOT:FechaTerminoOT}, //enviamos opcion 4 para que haga un SELECT
                "dataSrc":""
            },
            "columns": columnastabla,
            "columnDefs": [
                {
                    "targets"   : [ 0, 15, 16],
                    "orderable" : false
                },
                {
                    "targets"  : [15],
                    "render"   : function(data, type, row, meta) {
                        if(data!=""){
                            return '<div class="text-center"><div class="btn-group"><button title="Ver Vales" class="btn btn-sm btn-outline-secondary btn_ver_vales">'+data+'</button></div></div>';
                        }else{
                            return "";
                        }
                    }
                },
            ],
            "order": [[1, 'desc']]
        });     
    });  
    ///:: FIN BOTON BUSCAR OT CORRECTIVAS :::::::::::::::::::::::::::::::::::::::::::::::::///

    ///:: EVENTO DEL BOTON EDITAR :::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
    $(document).on("click", ".btnEditarOT", function(){		
        fila_ot = $(this).closest('tr'); 
        cod_ot = fila_ot.find('td:eq(1)').text();
        cod_ot = cod_ot.substring(2);
        $("#cod_ot").val(cod_ot);
        $('#nav-profile-tab').tab('show')
        document.getElementById("btnCargarOT").click();
        $("#ot_tecnico").focus().select();
    });
    ///:: FIN EVENTO DEL BOTON EDITAR :::::::::::::::::::::::::::::::::::::::::::::::::::::///
    
    ///:: EVENTO DE BOTON VER OTs :::::::::::::::::::::::::::::::::::::::::::::::::::::::::///       
    $(document).on("click", ".btn_ver_ot", function(){		
        let t_title = "";
        $("#form_modal_informacion").trigger("reset");
        fila_ot = $(this).closest('tr'); 
        cod_ot  = fila_ot.find('td:eq(1)').text();
        if(cod_ot.substring(0,1)=="C"){
            t_title = "INFORMACION OTs CORRECTIVAS";
        }else{
            t_title = "INFORMACION OTs PREVENTIVAS";
        }
        cod_ot  = cod_ot.substring(2);
        
        Accion = 'ver_ot';
        $.ajax({
          url: "Ajax.php",
          type: "POST",
          datatype:"json",
          async: false,    
          data: {MoS:MoS,NombreMoS:NombreMoS,Accion:Accion,cod_ot:cod_ot},    
          success: function(data){
            $("#div_info_detalle").html(data);
          }
        });
        f_tabla_ver_horas_tecnicos(cod_ot);
        $(".modal-header").css( "background-color", "#17a2b8");
        $(".modal-header").css( "color", "white" );
        $(".modal-title").text(t_title);
        $('#modal_crud_informacion').modal('show');
        $('#modal-resizable_informacion').resizable();
        $(".modal-dialog").draggable({
            cursor: "move",
            handle: ".dragable_touch",
          });        
    });
    ///:: FIN EVENTO DE BOTON VER OTs :::::::::::::::::::::::::::::::::::::::::::::::::::::///

    ///::::::::: EVENTO DE BOTON VER VALES ::::::::::::::::::::::///       
    $(document).on("click", ".btn_ver_vales", function(){		
        $("#form_modal_informacion").trigger("reset");
        fila_ot = $(this).closest('tr'); 
        cod_ot  = fila_ot.find('td:eq(1)').text();
        cod_ot  = cod_ot.substring(2);
        
        Accion = 'ver_vale';
        $.ajax({
          url: "Ajax.php",
          type: "POST",
          datatype:"json",
          async: false,    
          data: {MoS:MoS,NombreMoS:NombreMoS,Accion:Accion,cod_ot:cod_ot},    
          success: function(data){
            $("#div_info_detalle").html(data);
          }
        });
        $(".modal-header").css( "background-color", "#17a2b8");
        $(".modal-header").css( "color", "white" );
        $(".modal-title").text("INFORMACION VALES");
        $('#modal_crud_informacion').modal('show');	    
        $('#modal-resizable_informacion').resizable();
        $(".modal-dialog").draggable({
            cursor: "move",
            handle: ".dragable_touch",
          });
    });

    ///::::::::::::::: BOTON DESCARGAR OT :::::::::::::::::::::::///
    $(document).on("click", ".btn_descargar_ot", function(){		
        FechaInicioOT   = $("#FechaInicioOT").val();
        FechaTerminoOT  = $("#FechaTerminoOT").val();
        Accion          = 'descargar_ot';
        $.ajax({
            url         : "Ajax.php",
            type        : "POST",
            datatype    : "json",
            async       : false,
            data        : {MoS:MoS,NombreMoS:NombreMoS,Accion:Accion,FechaInicioOT:FechaInicioOT,FechaTerminoOT:FechaTerminoOT},
            beforeSend  : function(){
                Swal.fire({
                  icon              : 'success',
                  title             : 'Procesando Información',
                  showConfirmButton : false,
                  timer             : 5000
                })
            },
            success     : function(data){
                window.location.href = mi_carpeta + "Module/OTCorrectivas/Controller/csv_descarga.php?Archivo=" + data;
            }
        });
    });

    ///:: TERMINO DE BOTONES OT CORRECTIVAS :::::::::::::::::::::::::::::::::::::::::::::::///
});
///:: TERMINO DE JS DON OT CORRECTIVAS ::::::::::::::::::::::::::::::::::::::::::::::::::::///



///:: FUNCIONES DE OT CORRECTIVAS :::::::::::::::::::::::::::::::::::::::::::::::::::::::::///

function f_ColorFilasOTCorrectivas(row,data){
    let color;
    // Columna Estado
    switch(data.ot_estado)
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
    $("td:eq(2)",row).css({
      "color":color,
      "font-weight":"bold",
    });
}

function f_ot_observadas(){
    let rpta_ot_observadas="";
    Accion='ot_observadas';
    $.ajax({
      url       : "Ajax.php",
      type      : "POST",
      datatype  :"json",
      async     : false,
      data      : {MoS:MoS,NombreMoS:NombreMoS,Accion:Accion},    
      success   : function(data){
        rpta_ot_observadas = data;
      }
    });
    div_show = f_DivFormulario("contenido","div_alertsDropdown_ot");
    $("#div_alertsDropdown_ot").html(div_show);
    return rpta_ot_observadas;
}

function f_editar_ot(p_cod_ot){
    $("#cod_ot").val(p_cod_ot);
    $('#nav-profile-tab').tab('show')
    document.getElementById("btnCargarOT").click();
    $("#ot_tecnico").focus().select();
}

///:: TERMINO FUNCIONES DE OT CORRECTIVAS :::::::::::::::::::::::::::::::::::::::::::::::::///