///::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
///:: ORDEN DE TRABAJO v 3.0 FECHA: 2023-12-28 ::::::::::::::::::::::::::::::::::::::::::::///
///:: CREAR, EDITAR, ELIMINAR TABLA DE ORDEN DE TRABAJO :::::::::::::::::::::::::::::::::::///
///::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///

///:: DECLARACION DE VARIABLES ::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
var tabla_ot, razon_social_ot, fecha_inicio_ot, fecha_termino_ot, fila_ot, ot_observadas, select_ot, nuevo_vale_ot;
var fila_va_ot_id, fila_va_ot_id, fila_va_estado, fila_va_genera, fila_va_bus, fila_va_origen, fila_va_asociado, fila_va_descrip, fila_va_date_genera;
fecha_inicio_ot = "", fecha_termino_ot  = "";
nuevo_vale_ot   = "NO";
mi_carpeta      = f_DocumentRoot();

///:: JS DOM ORDEN DE TRABAJO :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
$(document).ready(function(){
    select_ot = f_select_combo("manto_proveedores","NO", "prov_razonsocial", "", "`prov_estado`='ACTIVO'", "`prov_razonsocial` ASC");
    $("#razon_social_ot").html(select_ot);

    div_show = f_MostrarDiv("form_seleccion_ot", "btn_seleccion_ot", "", "");
    $("#div_btn_seleccion_ot").html(div_show);

    if(fecha_inicio_ot=="" && fecha_termino_ot==""){
        fecha_inicio_ot = f_CalculoFecha("hoy","-1 Months");
        fecha_termino_ot = f_CalculoFecha("hoy","0");
        $('#fecha_inicio_ot').val(fecha_inicio_ot);
        $('#fecha_termino_ot').val(fecha_termino_ot);
    }

    // Si hay cambios en el Fecha se ocultan botones y datatable
    $("#razon_social_ot, #fecha_inicio_ot, #fecha_termino_ot").on('change', function () {
        $("#div_tabla_ot").empty();
    });

    ///:: BOTONES DE ORDEN DE TRABAJO :::::::::::::::::::::::::::::::::::::::::::::::::::::///

    ///:: BOTON BUSCAR ORDEN DE TRABAJO :::::::::::::::::::::::::::::::::::::::::::::::::::///
    $(document).on("click", ".btn_buscar_ot", function(){
        fecha_inicio_ot = $("#fecha_inicio_ot").val();
        fecha_termino_ot = $("#fecha_termino_ot").val();
        razon_social_ot = $("#razon_social_ot").val();
        let ot_ruc_proveedor = f_buscar_dato("manto_proveedores", "prov_ruc", "`prov_razonsocial`='"+razon_social_ot+"'");

        div_tabla = f_CreacionTabla("tabla_ot","");
        $("#div_tabla_ot").html(div_tabla);
        columnas_tabla = f_ColumnasTabla("tabla_ot","");
    
        $("#tabla_ot").dataTable().fnDestroy();
        $('#tabla_ot').show();

        // Setup - add a text input to each footer cell
        $('#tabla_ot thead tr')
            .clone(true)
            .addClass('filters_ot')
            .appendTo('#tabla_ot thead');

        Accion='leer_ot';
        tabla_ot = $('#tabla_ot').DataTable({
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
                    var cell = $('.filters_ot th').eq($(api.column(colIdx).header()).index());
                    var title = $(cell).text();
                    $(cell).html('<input type="text" placeholder="' + title + '" />');
                    // On every keypress in this input
                    $('input',$('.filters_ot th').eq($(api.column(colIdx).header()).index()) ).off('keyup change').on('keyup change', function (e) {
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
            pageLength  : 50,
            language: idioma_espanol, 
            responsive  : "true",
            dom         : 'Blfrtip', // Con Botones Excel,Pdf,Print
            buttons:[
                {
                    extend      : 'excelHtml5',
                    text        : '<i class="fas fa-file-excel"></i> ',
                    titleAttr   : 'Exportar a Excel',
                    className   : 'btn btn-success',
                    title       : 'ORDEN DE TRABAJO',
                },
            ],
            "ajax":{            
                "url"       : "Ajax.php", 
                "method"    : 'POST', //usamos el metodo POST
                "data"      : {MoS:MoS, NombreMoS:NombreMoS, Accion:Accion, ot_ruc_proveedor:ot_ruc_proveedor, fecha_inicio_ot:fecha_inicio_ot, fecha_termino_ot:fecha_termino_ot}, //enviamos opcion 4 para que haga un SELECT
                "dataSrc"   : ""
            },
            "columns"       : columnas_tabla,
            "columnDefs"    : [
                {
                    "targets"   : [ 0, 11],
                    "orderable" : false
                },
                {
                    "targets"  : [10],
                    "render"   : function(data, type, row, meta) {
                        if(data!=""){
                            return '<div class="text-center"><div class="btn-group"><button title="Ver Vales" class="btn btn-sm btn-outline-secondary btn_ver_vales">'+data+'</button></div></div>';
                        }else{
                            return "";
                        }
                    }
                },
            ],
            "order": [[3, 'desc']]
        });     
    });  
    ///:: FIN BOTON BUSCAR ORDEN DE TRABAJO :::::::::::::::::::::::::::::::::::::::::::::::///

    ///:: EVENTO DEL BOTON EDITAR :::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
    $(document).on("click", ".btn_nuevo_vale", function(){		
        nuevo_vale_ot = "SI";
        fila_ot = $(this).closest('tr'); 
        vale_id = "";
        fila_va_ot_id = fila_ot.find('td:eq(1)').text();
        fila_va_ot_id = fila_va_ot_id.substring(2);
        fila_va_estado = fila_ot.find('td:eq(2)').text();
        fila_va_genera = fila_ot.find('td:eq(4)').text();
        fila_va_bus = fila_ot.find('td:eq(5)').text();
        fila_va_origen = fila_ot.find('td:eq(6)').text();
        fila_va_asociado = fila_ot.find('td:eq(7)').text();
        fila_va_descrip = fila_ot.find('td:eq(8)').text();
        fila_va_date_genera = f_CalculoFecha("hoy","H");

        if(fila_va_estado=="ABIERTO"){
            $("#vale_id").val(vale_id);
            div_show = f_MostrarDiv("form_seleccion_procesar_vale","btn_seleccion_procesar_vale", "","");
            $("#div_btn_seleccion_procesar_vale").html(div_show);
            $('#nav-profile-tab').tab('show')
            document.getElementById("btn_cargar_vale").click();
        }else{
            Swal.fire({
                position: 'center',
                icon: 'error',
                title: "Estado "+fila_va_estado+" !!!",
                showConfirmButton: false,
                timer: 1500
            })  
        }
    });
    ///:: FIN EVENTO DEL BOTON EDITAR :::::::::::::::::::::::::::::::::::::::::::::::::::::///
    
    ///:: EVENTO DE BOTON VER OTs :::::::::::::::::::::::::::::::::::::::::::::::::::::::::///       
    $(document).on("click", ".btn_ver_ot", function(){		
        let t_title = "";
        $("#form_modal_informacion").trigger("reset");
        fila_ot = $(this).closest('tr'); 
        ot_id  = fila_ot.find('td:eq(1)').text();
        if(ot_id.substring(0,1)=="C"){
            t_title = "INFORMACION OTs CORRECTIVAS";
        }else{
            t_title = "INFORMACION OTs PREVENTIVAS";
        }
        ot_id  = ot_id.substring(2);
        
        Accion = 'ver_ot';
        $.ajax({
          url: "Ajax.php",
          type: "POST",
          datatype:"json",
          async: false,    
          data: {MoS:MoS,NombreMoS:NombreMoS,Accion:Accion,ot_id:ot_id},    
          success: function(data){
            $("#div_info_detalle").html(data);
          }
        });
        f_tabla_ver_horas_tecnicos(ot_id);
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

    ///:: EVENTO DE BOTON VER VALES :::::::::::::::::::::::::::::::::::::::::::::::::::::::///       
    $(document).on("click", ".btn_ver_vales", function(){		
        $("#form_modal_informacion").trigger("reset");
        fila_ot = $(this).closest('tr'); 
        ot_id  = fila_ot.find('td:eq(1)').text();
        ot_id  = ot_id.substring(2);
        
        Accion = 'ver_vale';
        $.ajax({
          url: "Ajax.php",
          type: "POST",
          datatype:"json",
          async: false,    
          data: {MoS:MoS,NombreMoS:NombreMoS,Accion:Accion,ot_id:ot_id},    
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
    ///:: FIN EVENTO DE BOTON VER VALES :::::::::::::::::::::::::::::::::::::::::::::::::::///

    ///:: BOTON DESCARGAR OT ::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
    $(document).on("click", ".btn_descargar_ot", function(){		
        fecha_inicio_ot   = $("#fecha_inicio_ot").val();
        fecha_termino_ot  = $("#fecha_termino_ot").val();
        Accion          = 'descargar_ot';
        $.ajax({
            url         : "Ajax.php",
            type        : "POST",
            datatype    : "json",
            async       : false,
            data        : {MoS:MoS,NombreMoS:NombreMoS,Accion:Accion,fecha_inicio_ot:fecha_inicio_ot,fecha_termino_ot:fecha_termino_ot},
            beforeSend  : function(){
                Swal.fire({
                  icon              : 'success',
                  title             : 'Procesando Información',
                  showConfirmButton : false,
                  timer             : 5000
                })
            },
            success     : function(data){
                window.location.href = mi_carpeta + "Module/orden_trabajo/Controller/csv_descarga.php?Archivo=" + data;
            }
        });
    });
    ///:: FIN BOTON DESCARGAR OT ::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///

    ///:: TERMINO DE BOTONES ORDEN DE TRABAJO :::::::::::::::::::::::::::::::::::::::::::::///
});
///:: TERMINO DE JS DON ORDEN DE TRABAJO ::::::::::::::::::::::::::::::::::::::::::::::::::::///



///:: FUNCIONES DE ORDEN DE TRABAJO :::::::::::::::::::::::::::::::::::::::::::::::::::::::::///

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

function f_editar_ot(p_ot_id){
    $("#ot_id").val(p_ot_id);
    $('#nav-profile-tab').tab('show')
    document.getElementById("btn_cargar_ot").click();
}

  ///:: GENERACION DE TABLA DE VER HORAS LABORADAS TECNICOS :::::::::::::::::::::::::::::::///
  function f_tabla_ver_horas_tecnicos(p_cod_ot){
    let array_ver_horas_tecnicos = [];
    div_tabla = f_CreacionTabla("tabla_ver_horas_tecnicos","");
    $("#div_tabla_ver_horas_tecnicos").html(div_tabla);
    columnas_tabla = f_ColumnasTabla("tabla_ver_horas_tecnicos","");
  
    $("#tabla_ver_horas_tecnicos").dataTable().fnDestroy();
    $('#tabla_ver_horas_tecnicos').show();
  
    Accion='cargar_horas_tecnicos';
    $.ajax({
      url       : "Ajax.php",
      type      : "POST",
      datatype  : "json",    
      async     : false,
      data      :  { MoS:MoS,NombreMoS:NombreMoS,Accion:Accion, cod_ot:p_cod_ot },    
      success: function(data) {
        array_ver_horas_tecnicos = $.parseJSON(data);
      }
    });
      
    tabla_ver_horas_tecnicos = $('#tabla_ver_horas_tecnicos').DataTable({
      language      : idioma_espanol,
      searching     : false,
      info          : false,
      lengthChange  : false,
      pageLength    : 5,
      responsive    : "true",
      data          : array_ver_horas_tecnicos,
      columns       : columnas_tabla
    });     
  }
  ///:: FIN GENERACION DE TABLA DE HORAS LABORADAS TECNICOS :::::::::::::::::::::::::::::::///


///:: TERMINO FUNCIONES DE ORDEN DE TRABAJO :::::::::::::::::::::::::::::::::::::::::::::::::///