///::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
///:: LISTADO DE VALES v 4.0 FECHA: 2023-12-31 ::::::::::::::::::::::::::::::::::::::::::::///
//::: CREAR, EDITAR, ELIMINAR TABLA DE VALE :::::::::::::::::::::::::::::::::::::::::::::::///
///::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///

///::: DECLARACIONES DE VARIABLES :::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
var tabla_vale, tabla_ver_detalle_reportes, fecha_inicio_listado, fecha_termino_listado, fila_vale, vales_observados;
fecha_inicio_listado  = "";
fecha_termino_listado = "";
mi_carpeta = f_DocumentRoot();

///:: JS DOM VALE :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
$(document).ready(function(){
    vales_observados = f_vales_observados();
    $("#vales_alerta").html(vales_observados);

    div_boton = f_BotonesFormulario("form_seleccion_vale","btn_seleccion_vale");
    $("#div_btn_seleccion_vale").html(div_boton);

    if(fecha_inicio_listado=="" && fecha_termino_listado==""){
        fecha_inicio_listado = f_CalculoFecha("hoy","-1 Months");
        fecha_termino_listado = f_CalculoFecha("hoy","0");
        $('#fecha_inicio_listado').val(fecha_inicio_listado);
        $('#fecha_termino_listado').val(fecha_termino_listado);
    }

    ///:: SI HAY CAMBIOS EN LAS FECHAS SE OCULTAN BOTONES Y DATATABLE :::::::::::::::::::::///
    $("#fecha_inicio_listado, #fecha_termino_listado").on('change', function () {
        $("#div_tabla_vale").empty();
    });

    ///:: BOTONES DE VALE :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///

    ///:: BOTON BUSCAR VALE :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
    $(document).on("click",  ".btn_buscar_vale", function(){		
        fecha_inicio_listado = $("#fecha_inicio_listado").val();
        fecha_termino_listado = $("#fecha_termino_listado").val();

        div_tabla = f_CreacionTabla("tabla_vale","");
        $("#div_tabla_vale").html(div_tabla);
        columna_tabla = f_ColumnasTabla("tabla_vale","");
  
        $("#tabla_vale").dataTable().fnDestroy();
        $('#tabla_vale').show();

        // Setup - add a text input to each footer cell
        $('#tabla_vale thead tr')
            .clone(true)
            .addClass('filters_vale')
            .appendTo('#tabla_vale thead');

        Accion = 'leer_vale';
        tabla_vale = $('#tabla_vale').DataTable({
            //Color a las filas
            "rowCallback":function(row,data,index){
                f_color_filas_vale(row,data);
            }, 
            orderCellsTop   : true,
            fixedHeader     : true,
            initComplete    : function (){
                var api = this.api();
                // For each column
                api.columns().eq(0).each(function (colIdx) {
                    // Set the header cell to contain the input element
                    var cell = $('.filters_vale th').eq($(api.column(colIdx).header()).index());
                    var title = $(cell).text();
                    $(cell).html('<input type="text" placeholder="' + title + '" />');
                    // On every keypress in this input
                    $('input',$('.filters_vale th').eq($(api.column(colIdx).header()).index()) ).off('keyup change').on('keyup change', function (e) {
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
                left : 1
            },
            fixedHeader     : {
                header : false
            },
            pageLength      : 50,
            language        : idioma_espanol, 
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
                "data"      : { MoS:MoS, NombreMoS:NombreMoS, Accion:Accion, fecha_inicio_listado:fecha_inicio_listado, fecha_termino_listado:fecha_termino_listado },
                "dataSrc"   : ""
            },
            "columns"       : columna_tabla,
            "columnDefs"    :[
                {
                    "targets"   : [0,9],
                    "orderable" : false
                },
            ],
            "order"         : [[1, 'desc']]
        });
    });
    ///:: FIN BOTON BUSCAR VALE :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///

    ///:: EVENTO DEL BOTON EDITAR :::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
    $(document).on("click", ".btn_editar_vale", function(){
        fila_vale  = $(this).closest('tr'); 
        vale_id   = fila_vale.find('td:eq(1)').text();
        $("#vale_id").val(vale_id);
        $('#nav-profile-tab').tab('show');
        document.getElementById("btn_cargar_vale").click();
        $("#va_ot_id").focus().select();
    });
    ///:: FIN EVENTO DEL BOTON EDITAR :::::::::::::::::::::::::::::::::::::::::::::::::::::///

    ///:: EVENTO DE BOTON VER VALE ::::::::::::::::::::::::::::::::::::::::::::::::::::::::///       
    $(document).on("click", ".btn_ver_vale", function(){
        fila_vale  = $(this).closest('tr'); 
        vale_id    = fila_vale.find('td:eq(1)').text();
        $("#form_modal_ver_vale").trigger("reset");

        Accion = 'cargar_vale';
        $.ajax({
          url       : "Ajax.php",
          type      : "POST",
          datatype  : "json",
          async     : false,    
          data      : {MoS:MoS, NombreMoS:NombreMoS, Accion:Accion, vale_id:vale_id},    
          success   : function(data){
            data = $.parseJSON(data);
            $.each(data, function(idx, obj){ 
                ivale_id            = obj.vale_id;
                iva_ot_id           = obj.va_ot_id;
                iva_genera          = obj.va_genera;
                iva_date_genera     = obj.va_date_genera;
                iva_asociado        = obj.va_asociado;
                iva_obs_cgm         = obj.va_obs_cgm;
                iva_obs_aom         = obj.va_obs_aom;
                iva_estado          = obj.va_estado;
                iva_bus             = obj.va_bus;
                iva_descrip         = obj.va_descrip;
                iva_log             = obj.va_log;
              });
          }
        });
        $('#ivale_id').text(ivale_id);
        $('#iva_ot_id').text(iva_ot_id);
        $('#iva_genera').text(iva_genera);
        $('#iva_date_genera').text(iva_date_genera);
        $('#iva_asociado').text(iva_asociado);
        $('#iva_estado').text(iva_estado);
        $('#iva_bus').text(iva_bus);
        $('#iva_estado').text(iva_estado);
        $('#iva_descrip').text(iva_descrip);
        // Se cargan los div
        $("#div_iva_obs_cgm").html(iva_obs_cgm);
        $("#div_iva_obs_aom").html(iva_obs_aom);
        $("#div_iva_log").html(iva_log);

        div_tabla = f_CreacionTabla("tabla_ver_detalle_repuestos","");
        $("#div_tabla_ver_detalle_repuestos").html(div_tabla);
        columna_tabla = f_ColumnasTabla("tabla_ver_detalle_repuestos","");
  
        $("#tabla_ver_detalle_repuestos").dataTable().fnDestroy();
        $('#tabla_ver_detalle_repuestos').show();
        Accion='cargar_repuestos';
        tabla_ver_detalle_repuestos = $('#tabla_ver_detalle_repuestos').DataTable({
          language      : idioma_espanol,
          searching     : false,
          info          : false,
          lengthChange  : false,
          paging        : false,
          responsive    : "true",
          "ajax"        : {            
            "url"       : "Ajax.php", 
            "method"    : 'POST', 
            "data"      : { MoS:MoS, NombreMoS:NombreMoS, Accion:Accion, vale_id:vale_id }, 
            "dataSrc"   : ""
          },
          "columns"     : columna_tabla,
        });     
   
        $(".modal-header").css( "background-color", "#17a2b8");
        $(".modal-header").css( "color", "white" );
        $(".modal-title").text("Información de Vales");
        $('#modal_crud_ver_vale').modal('show');	   
        $('#modal-resizable_ver_vale').resizable();
        $(".modal-dialog").draggable({
            cursor: "move",
            handle: ".dragable_touch",
          });         
    });
    ///:: FIN EVENTO DE BOTON VER VALE ::::::::::::::::::::::::::::::::::::::::::::::::::::///

    ///:: BOTON DESCARGAR VALE ::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
    $(document).on("click", ".btn_descargar_vale", function(){		
        fecha_inicio_listado   = $("#fecha_inicio_listado").val();
        fecha_termino_listado  = $("#fecha_termino_listado").val();
        Accion = 'descargar_vale';
        $.ajax({
            url         : "Ajax.php",
            type        : "POST",
            datatype    : "json",
            async       : false,
            data        : {MoS:MoS, NombreMoS:NombreMoS, Accion:Accion, fecha_inicio_listado:fecha_inicio_listado, fecha_termino_listado:fecha_termino_listado},
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

    $(document).on("click", ".btn_listado_imprimir_vale", function(){
        ivale_id = $("#ivale_id").text();  
        let nro_vale = "";
        nro_vale = parseInt(ivale_id);
        if(nro_vale!==""){
            f_imprimir_vale(nro_vale,"div_listado_imprimir_vale");
        }else{
            Swal.fire({
                position: 'center',
                icon: 'warning',
                title: "No existe N° Vale : "+nro_vale+" !!!",
                showConfirmButton: false,
                timer: 1500
            })
        }
    });

    ///:: TERMINO BOTONES DE VALE :::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
});    
///:: TERMINO JS DOM VALE :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///

///:: FUNCIONES DE VALE :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
function f_color_filas_vale(row,data){
    let color;
    // Columna Estado
    switch(data.va_estado)
    {
        case "ABIERTO":
            color = "#FF9D0A";
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

function f_vales_observados(){
    let rpta_vales_observados="";
    Accion = 'vales_observados';
    $.ajax({
      url       : "Ajax.php",
      type      : "POST",
      datatype  : "json",
      async     : false,
      data      : {MoS:MoS, NombreMoS:NombreMoS, Accion:Accion},
      success   : function(data){
        rpta_vales_observados = data;
      }
    });
    div_show = f_DivFormulario("contenido","div_alertsDropdown_vales");
    $("#div_alertsDropdown_vales").html(div_show);
    return rpta_vales_observados;
}

function f_editar_vale(p_vale_id){
    $("#vale_id").val(p_vale_id);
    $('#nav-profile-tab').tab('show');
    document.getElementById("btn_cargar_vale").click();
    $("#va_ot_id").focus().select();
}

///:: TERMINO FUNCIONES DE VALE :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///

