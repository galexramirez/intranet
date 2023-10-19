///::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
///:::::::::::::::::::: OT PREVENTIVAS v 2.0 FECHA: 29-12-2022 ::::::::::::::::::::::::::::::::::///
//:::::::::::::::::: CREAR, EDITAR, ELIMINAR TABLA DE OT PREVENTIVAS ::::::::::::::::::::::::::::///
///::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///

///::::::::::::::::::::::::::::::: Declaracion de Variables :::::::::::::::::::::::::::::::::::::///
var tablaOTPrv, selectAniosOTPrv, FechaInicioOTPrv, FechaTerminoOTPrv, filaOTPrv, otprv_observadas;
FechaInicioOTPrv    = "";
FechaTerminoOTPrv   = "";
mi_carpeta          = f_DocumentRoot();

///::::::::::::::: JS CARGA DE DATA TABLE :::::::::::::://
$(document).ready(function(){
    otprv_observadas = f_otprv_observadas();
    $("#otprv_alerta").html(otprv_observadas);

    if(FechaInicioOTPrv=="" && FechaTerminoOTPrv==""){
        FechaInicioOTPrv = f_CalculoFecha("hoy","-1 Months");
        FechaTerminoOTPrv = f_CalculoFecha("hoy","0");
        $('#FechaInicioOTPrv').val(FechaInicioOTPrv);
        $('#FechaTerminoOTPrv').val(FechaTerminoOTPrv);
    }

    // Si hay cambios en el Fecha se ocultan botones y datatable
    $("#FechaInicioOTPrv").on('change', function () {
      $("#tablaOTPrv").dataTable().fnDestroy();
      $('#tablaOTPrv').hide();  
      $("#btnNuevoOTPrv").hide();
    });
    
    $("#FechaTerminoOTPrv").on('change', function () {
        $("#tablaOTPrv").dataTable().fnDestroy();
        $('#tablaOTPrv').hide();  
        $("#btnNuevoOTPrv").hide();
    });

    ///::::::::: EVENTO DE BOTON VER OTPRV ::::::::::::::::::::::///       
    $(document).on("click", ".btn_ver_ot_prv", function(){		
        $("#form_modal_informacion_otprv").trigger("reset");
        fila_ot_prv = $(this).closest('tr'); 
        cod_ot_prv  = fila_ot_prv.find('td:eq(1)').text();
        cod_ot_prv  = cod_ot_prv.substring(2)
        
        Accion = 'ver_ot_prv';
        $.ajax({
          url: "Ajax.php",
          type: "POST",
          datatype:"json",
          async: false,    
          data: {MoS:MoS,NombreMoS:NombreMoS,Accion:Accion,cod_ot_prv:cod_ot_prv},    
          success: function(data){
            $("#div_info_detalle_otprv").html(data);
          }
        });
        $(".modal-header").css( "background-color", "#17a2b8");
        $(".modal-header").css( "color", "white" );
        $(".modal-title").text("INFORMACION OTs PREVENTIVAS");
        $('#modal_crud_informacion_otprv').modal('show');
        $('#modal-resizable_informacion_otprv').resizable();
        $(".modal-dialog").draggable({
            cursor: "move",
            handle: ".dragable_touch",
          });
    });

    ///::::::::::::::: BOTON DESCARGAR OT :::::::::::::::::::::::///
    $(document).on("click", ".btn_descargar_otprv", function(){		
        FechaInicioOTPrv   = $("#FechaInicioOTPrv").val();
        FechaTerminoOTPrv  = $("#FechaTerminoOTPrv").val();
        Accion          = 'descargar_otprv';
        $.ajax({
            url         : "Ajax.php",
            type        : "POST",
            datatype    : "json",
            async       : false,
            data        : {MoS:MoS,NombreMoS:NombreMoS,Accion:Accion,FechaInicioOTPrv:FechaInicioOTPrv,FechaTerminoOTPrv:FechaTerminoOTPrv},
            beforeSend  : function(){
                Swal.fire({
                    icon              : 'success',
                    title             : 'Procesando Información',
                    showConfirmButton : false,
                    timer             : 5000
                })
            },
            success     : function(data){
                window.location.href = mi_carpeta + "Module/OTPreventivas/Controller/csv_descarga.php?Archivo=" + data;
            }
        });
    });

});    

///::::::::::::::::::::::::: BOTONES DE USUARIOS :::::::::::::::::::::///

///:::::::::::::::::::::::: JS DATA TABLE ACCIDENTES ::::::::::::::::::::::::::::::::::///
$("#btnBuscarOTPrv").on("click",function(){
    let validacion, t_DiferenciaFecha;
    FechaInicioOTPrv = $("#FechaInicioOTPrv").val();
    FechaTerminoOTPrv = $("#FechaTerminoOTPrv").val();
    validacion = f_validar(FechaInicioOTPrv,FechaTerminoOTPrv);
    t_DiferenciaFecha = f_DiferenciaFecha(FechaInicioOTPrv,FechaTerminoOTPrv,'366');

    if(validacion == "invalido"){
        Swal.fire({
            icon: 'error',
            title: 'Informacion...',
            text: '*Es posible que la Información no sea la correcta!!!'
          })
    }else{
        if(t_DiferenciaFecha == "NO"){
            Swal.fire({
                icon: 'error',
                title: 'Periodo de Tiempo',
                text: 'Debe ser menor a 1 año !!!',
              });      
        }else{
            div_tabla = f_CreacionTabla("tablaOTPrv","");
            $("#div_tablaOTPrv").html(div_tabla);
            columnastabla = f_ColumnasTabla("tablaOTPrv","");
        
            $("#tablaOTPrv").dataTable().fnDestroy();
            $('#tablaOTPrv').show();
    
            // Setup - add a text input to each footer cell
            $('#tablaOTPrv thead tr')
                .clone(true)
                .addClass('filtersOTPrv')
                .appendTo('#tablaOTPrv thead');
    
            Accion      ='LeerOTPrv';
            tablaOTPrv  = $('#tablaOTPrv').DataTable({
                //Color a las filas
                "rowCallback"   : function(row,data,index){
                    f_ColorFilasOTPreventivas(row,data);
                }, 
                //Filtros por columnas
                orderCellsTop   : true,
                fixedHeader     : true,
                initComplete    : function (){
                    var api = this.api();
                    // For each column
                    api.columns().eq(0).each(function (colIdx) {
                        // Set the header cell to contain the input element
                        var cell = $('.filtersOTPrv th').eq($(api.column(colIdx).header()).index());
                        var title = $(cell).text();
                        $(cell).html('<input type="text" placeholder="' + title + '" />');
                        // On every keypress in this input
                        $('input',$('.filtersOTPrv th').eq($(api.column(colIdx).header()).index()) ).off('keyup change').on('keyup change', function (e) {
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
                    left        : 1
                },
                fixedHeader     : {
                    header      : false
                },
                "processing"    : true,
                //Para mostrar 50 registros popr página 
                pageLength      : 50,
                //Para cambiar el lenguaje a español
                language        : idiomaEspanol, 
                //Para usar los botones
                responsive      : "true",
                dom             : 'Blfrtip', // Con Botones Excel,Pdf,Print
                buttons:[
                    {
                        extend      : 'excelHtml5',
                        text        : '<i class="fas fa-file-excel"></i> ',
                        titleAttr   : 'Exportar a Excel',
                        className   : 'btn btn-success',
                        title       : 'OTs PREVENTIVAS'
                    },
                ],
                "ajax":{            
                    "url": "Ajax.php", 
                    "method": 'POST', //usamos el metodo POST
                    "data":{MoS:MoS,NombreMoS:NombreMoS,Accion:Accion,FechaInicioOTPrv:FechaInicioOTPrv,FechaTerminoOTPrv:FechaTerminoOTPrv}, //enviamos opcion 4 para que haga un SELECT
                    "dataSrc":""
                },
                "columns":columnastabla,
                "columnDefs": [
                    {
                        "targets"   : [ 0, 15],
                        "orderable" : false
                    },
                ],
                "order": [[1, 'desc']]
            });     
        }
    }
});  

///::::::::: EVENTO DEL BOTON EDITAR ::::::::::::::::::::::///       
$(document).on("click", ".btnEditarOTPrv", function(){		
    filaOTPrv = $(this).closest('tr'); 
    cod_otpv = filaOTPrv.find('td:eq(1)').text();
    $("#cod_otpv").val(cod_otpv.substring(2));
    $('#nav-contact-tab').tab('show')
    document.getElementById("btnCargarOTPrv").click();
    $("#otpv_tecnico").focus().select();
});

///::::::::::::::::::::::::::::::::: FUNCIONES DE OT PREVENTIVAS ::::::::::::::::::::::::::::::::::::///

///::::::: FUNCION PARA VALIDAR LOS DATOS INGRESADOS AL FORMULARIO :::::::::::::::::::///
function f_validar(p_FechaInicio,p_FechaTermino){
    f_LimpiaMs();
    let rptaOTPrv="";    
  
    if(p_FechaInicio > p_FechaTermino){
      $("#FechaInicioOTPrv").addClass("color-error");
      $("#FechaTerminoOTPrv").addClass("color-error");
      rptaOTPrv="invalido";
    }
    if(p_FechaTermino=="" | p_FechaInicio==""){
      $("#FechaInicioOTPrv").addClass("color-error");
      $("#FechaTerminoOTPrv").addClass("color-error");
      rptaOTPrv="invalido";
    }
    return rptaOTPrv; 
}
  
///::::::::: INVISIBILIZA LOS MENSAJE DE ALERTA DEL FORMULARIO :::::: /// 
function f_LimpiaMs(){
    $("#FechaInicioOTPrv").removeClass("color-error");
    $("#FechaTerminoOTPrv").removeClass("color-error");
}

function f_ColorFilasOTPreventivas(row,data){
    let color;
    // Columna Estado
    switch(data.otpv_estado)
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

function f_otprv_observadas(){
    let rpta_otprv_observadas="";
    Accion = 'otprv_observadas';
    $.ajax({
      url       : "Ajax.php",
      type      : "POST",
      datatype  : "json",
      async     : false,
      data      : {MoS:MoS,NombreMoS:NombreMoS,Accion:Accion},    
      success   : function(data){
        rpta_otprv_observadas = data;
      }
    });
    div_show = f_DivFormulario("contenido","div_alertsDropdown_otprv");
    $("#div_alertsDropdown_otprv").html(div_show);
    return rpta_otprv_observadas;
}

function f_editar_otprv(p_cod_otpv){
    $("#cod_otpv").val(p_cod_otpv);
    $('#nav-contact-tab').tab('show')
    document.getElementById("btnCargarOTPrv").click();
    $("#otpv_tecnico").focus().select();
}
