///::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
///:: VALES v 3.0 FECHA: 01-06-2023 :::::::::::::::::::::::::::::::::::::::::::::::::::::::///
//::: CREAR, EDITAR, ELIMINAR TABLA DE VALES ::::::::::::::::::::::::::::::::::::::::::::::///
///::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///

///::: DECLARACIONES DE VARIABLES :::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
var tabla_vales, tabla_ver_detalle_reportes, selectAniosVales, FechaInicioVales, FechaTerminoVales, fila_vales, vales_observadas;
FechaInicioVales    = "";
FechaTerminoVales   = "";
const fecha_hoy     = new Date();
mi_carpeta          = f_DocumentRoot();

///:: JS DOM VALE :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
$(document).ready(function(){
    vales_observadas = f_vales_observadas();
    $("#vales_alerta").html(vales_observadas);

    div_boton = f_BotonesFormulario("form_seleccion_vales","btn_seleccion_vales");
    $("#div_btn_seleccion_vales").html(div_boton);

    if(FechaInicioVales=="" && FechaTerminoVales==""){
        FechaInicioVales = f_CalculoFecha("hoy","-1 Months");
        FechaTerminoVales = f_CalculoFecha("hoy","0");
        $('#FechaInicioVales').val(FechaInicioVales);
        $('#FechaTerminoVales').val(FechaTerminoVales);
    }

    ///:: SI HAY CAMBIOS EN LAS FECHAS SE OCULTAN BOTONES Y DATATABLE :::::::::::::::::::::///
    $("#FechaInicioVales").on('change', function () {
        $("#div_tabla_vales").empty();
    });
    
    $("#FechaTerminoVales").on('change', function () {
        $("#div_tabla_vales").empty();
    });

    ///:: BOTONES DE VALES ::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///

    ///:: BOTON BUSCAR VALES ::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
    $(document).on("click", ".btn_buscar_vales", function(){		
        FechaInicioVales = $("#FechaInicioVales").val();
        FechaTerminoVales = $("#FechaTerminoVales").val();

        div_tabla = f_CreacionTabla("tabla_vales","");
        $("#div_tabla_vales").html(div_tabla);
        columnastabla = f_ColumnasTabla("tabla_vales","");
  
        $("#tala_vales").dataTable().fnDestroy();
        $('#tabla_vales').show();

        // Setup - add a text input to each footer cell
        $('#tabla_vales thead tr')
            .clone(true)
            .addClass('filtersVales')
            .appendTo('#tabla_vales thead');

        Accion='LeerVales';
        tabla_vales = $('#tabla_vales').DataTable({
            //Color a las filas
            "rowCallback":function(row,data,index){
                f_ColorFilasValess(row,data);
            }, 
            //Filtros por columnas
            orderCellsTop   : true,
            fixedHeader     : true,
            initComplete    : function (){
                var api = this.api();
                // For each column
                api.columns().eq(0).each(function (colIdx) {
                    // Set the header cell to contain the input element
                    var cell = $('.filtersVales th').eq($(api.column(colIdx).header()).index());
                    var title = $(cell).text();
                    $(cell).html('<input type="text" placeholder="' + title + '" />');
                    // On every keypress in this input
                    $('input',$('.filtersVales th').eq($(api.column(colIdx).header()).index()) ).off('keyup change').on('keyup change', function (e) {
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
            dom             : 'Blfrtip',
            buttons         : [
                                {
                                    extend      : 'excelHtml5',
                                    text        : '<i class="fas fa-file-excel"></i> ',
                                    titleAttr   : 'Exportar a Excel',
                                    className   : 'btn btn-success'
                                },
                            ],
            "ajax"          : {            
                                "url"       : "Ajax.php", 
                                "method"    : 'POST',
                                "data"      : { MoS:MoS,NombreMoS:NombreMoS,Accion:Accion,FechaInicioVales:FechaInicioVales,FechaTerminoVales:FechaTerminoVales },
                                "dataSrc"   :""
                            },
            "columns"       : columnastabla,
            "columnDefs"    :[
                {
                    "targets"   : [0,12],
                    "orderable" : false
                },
            ],
            "order"         : [[1, 'desc']]
        });
    });
    ///:: FIN BOTON BUSCAR VALES ::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///

    ///:: EVENTO DEL BOTON EDITAR :::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
    $(document).on("click", ".btn_editar_vales", function(){
        fila_vales  = $(this).closest('tr'); 
        cod_vale    = fila_vales.find('td:eq(1)').text();
        $("#cod_vale").val(cod_vale);
        $('#nav-profile-tab').tab('show');
        document.getElementById("btn_cargar_vales").click();
        $("#va_ot_id").focus().select();
    });
    ///:: FIN EVENTO DEL BOTON EDITAR :::::::::::::::::::::::::::::::::::::::::::::::::::::///

    ///:: EVENTO DE BOTON VER VALES :::::::::::::::::::::::::::::::::::::::::::::::::::::::///       
    $(document).on("click", ".btn_ver_vales", function(){
        fila_vales  = $(this).closest('tr'); 
        cod_vale    = fila_vales.find('td:eq(1)').text();
        $("#form_modal_ver_vales").trigger("reset");

        Accion = 'cargar_vales';
        $.ajax({
          url       : "Ajax.php",
          type      : "POST",
          datatype  : "json",
          async     : false,    
          data      : {MoS:MoS,NombreMoS:NombreMoS,Accion:Accion,cod_vale:cod_vale},    
          success   : function(data){
            data = $.parseJSON(data);
            $.each(data, function(idx, obj){ 
                icod_vale           = obj.cod_vale;
                iva_ot_id              = obj.va_ot_id;
                iva_genera          = obj.va_genera;
                iva_date_genera     = obj.va_date_genera;
                iva_asociado        = obj.va_asociado;
                iva_responsable     = obj.va_responsable;
                iva_obs_cgm         = obj.va_obs_cgm;
                iva_cierre_adm      = obj.va_cierre_adm;
                iva_date_cierre_adm = obj.va_date_cierre_adm;
                iva_obs_aom         = obj.va_obs_aom;
                iva_estado          = obj.va_estado;
                iva_garantia        = obj.va_garantia;
                iva_bus             = obj.va_bus;
                iva_descrip         = obj.va_descrip;
              });
          }
        });
        $('#icod_vale').text(icod_vale);
        $('#iva_ot_id').text(iva_ot_id);
        $('#iva_genera').text(iva_genera);
        $('#iva_date_genera').text(iva_date_genera);
        $('#iva_asociado').text(iva_asociado);
        $('#iva_responsable').text(iva_responsable);
        $('#iva_obs_cgm').text(iva_obs_cgm);
        $('#iva_cierre_adm').text(iva_cierre_adm);
        $('#iva_date_cierre_adm').text(iva_date_cierre_adm);
        $('#iva_estado').text(iva_estado);
        $('#iva_garantia').text(iva_garantia);
        $('#iva_bus').text(iva_bus);
        $('#iva_estado').text(iva_estado);
        $('#iva_descrip').text(iva_descrip);
        // Se cargan los div
        $("#div_iva_obs_cgm").html(iva_obs_cgm);
        $("#div_iva_obs_aom").html(iva_obs_aom);

        div_tabla = f_CreacionTabla("tabla_ver_detalle_repuestos","");
        $("#div_tabla_ver_detalle_repuestos").html(div_tabla);
        columnastabla = f_ColumnasTabla("tabla_ver_detalle_repuestos","");
  
        $("#tabla_ver_detalle_repuestos").dataTable().fnDestroy();
        $('#tabla_ver_detalle_repuestos').show();
        Accion='cargar_detalle_repuestos';
        tabla_ver_detalle_repuestos = $('#tabla_ver_detalle_repuestos').DataTable({
          language      : idiomaEspanol,
          searching     : false,
          info          : false,
          lengthChange  : false,
          paging        : false,
          //pageLength    : 5,
          responsive    : "true",
          "ajax"        : {            
            "url"       : "Ajax.php", 
            "method"    : 'POST', 
            "data"      : { MoS:MoS, NombreMoS:NombreMoS, Accion:Accion, cod_vale:cod_vale }, 
            "dataSrc"   : ""
          },
          "columns"     : columnastabla,
        });     
   
        $(".modal-header").css( "background-color", "#17a2b8");
        $(".modal-header").css( "color", "white" );
        $(".modal-title").text("Información de Vales");
        $('#modal_crud_ver_vales').modal('show');	   
        $('#modal-resizable_ver_vales').resizable();
        $(".modal-dialog").draggable({
            cursor: "move",
            handle: ".dragable_touch",
          });         
    });
    ///:: FIN EVENTO DE BOTON VER VALES :::::::::::::::::::::::::::::::::::::::::::::::::::///

    ///:: BOTON DESCARGAR VALES :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
    $(document).on("click", ".btn_descargar_vales", function(){		
        FechaInicioVales   = $("#FechaInicioVales").val();
        FechaTerminoVales  = $("#FechaTerminoVales").val();
        Accion          = 'descargar_vales';
        $.ajax({
            url         : "Ajax.php",
            type        : "POST",
            datatype    : "json",
            async       : false,
            data        : {MoS:MoS,NombreMoS:NombreMoS,Accion:Accion,FechaInicioVales:FechaInicioVales,FechaTerminoVales:FechaTerminoVales},
            beforeSend  : function(){
                Swal.fire({
                  icon              : 'success',
                  title             : 'Procesando Información',
                  showConfirmButton : false,
                  timer             : 5000
                })
            },
            success     : function(data){
                window.location.href = mi_carpeta + "Module/vales_v3/Controller/csv_descarga.php?Archivo=" + data;
            }
        });
    });

    $(document).on("click", ".btn_imprimir_vale", function(){
        //$.print("#div_imprimir");
        //f_imprimir_documento();
        window.location.href = mi_carpeta + "Module/vales_v3/Controller/imprimir_demo.php";
    });

    ///:: TERMINO BOTONES DE VALES ::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
});    
///:: TERMINO JS DOM VALE :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///

///:: FUNCIONES DE VALES ::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
function f_ColorFilasValess(row,data){
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
        case "P CIERRE":
            color = "#FF9D0A";
        break;
        case "PENDIENTE OT":
            color = "#EC515D";
        break;
    }
    $("td:eq(2)",row).css({
      "color":color,
      "font-weight":"bold",
    });
}

function f_vales_observadas(){
    let rpta_vales_observadas="";
    Accion = 'vales_observadas';
    $.ajax({
      url       : "Ajax.php",
      type      : "POST",
      datatype  : "json",
      async     : false,
      data      : {MoS:MoS,NombreMoS:NombreMoS,Accion:Accion},    
      success   : function(data){
        rpta_vales_observadas = data;
      }
    });
    div_show = f_DivFormulario("contenido","div_alertsDropdown_vales");
    $("#div_alertsDropdown_vales").html(div_show);
    return rpta_vales_observadas;
}

function f_editar_vales(p_cod_vale){
    $("#cod_vale").val(p_cod_vale);
    $('#nav-profile-tab').tab('show');
    document.getElementById("btn_cargar_vales").click();
    $("#va_ot_id").focus().select();
}

function f_imprimir_documento(){
    let rpta_imprimir_documento="";
    Accion = 'imprimir_documento';
    $.ajax({
      url       : "Ajax.php",
      type      : "POST",
      datatype  : "json",
      async     : false,
      data      : {MoS:MoS,NombreMoS:NombreMoS,Accion:Accion},    
      success   : function(data){
        rpta_imprimir_documento = data;
      }
    });
    return rpta_imprimir_documento;    
}
///:: TERMINO FUNCIONES DE VALES ::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///

