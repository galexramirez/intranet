///::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
///::::::::::::::::::::::: KILOMETRAJE v 2.0 FECHA: 18-01-2023 ::::::::::::::::::::::::::::///
//:::::::::::::::::: CREAR, EDITAR, ELIMINAR TABLA DE OT KILOMETRAJE ::::::::::::::::::::::///
///::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///

///::::::::::::::::::::::::::::::: Declaracion de Variables :::::::::::::::::::::::::::::::///
var tablaKm, selectAniosKm, FechaInicioKm, FechaTerminoKm, filaKm, selectTipoKm, selectTipoBusKm, km_bus, km_fecha, selectkm_motivo, datahtml, km_kilometraje, km_historial, selectBusKm, adata, root, selectDiasKm;
FechaInicioKm = "";
FechaTerminoKm = "";
selectTipoBusKm = "TODOS";
selectTipoKm = "TODOS";
selectkm_motivo = "PATIO SUR";
selectDiasKm = "7";
adata = [];

///:::::::::::::::::::::::: JS DOM KILOMETRAJE ::::::::::::::::::::::::::::::::::::::::::::///
$(document).ready(function(){
    div_boton = f_BotonesFormulario("formSeleccionKm","btn-seleccionkm");
    $("#div_btn-seleccionkm").html(div_boton);
  
    // Se inicializan las fechas del data table
    if(FechaInicioKm=="" && FechaTerminoKm==""){
        FechaInicioKm = f_CalculoFecha("hoy","-7 days");
        FechaTerminoKm = f_CalculoFecha("hoy","0");
        $('#FechaTerminoKm').val(FechaTerminoKm);
    }

    $("#selectTipoKm").val(selectTipoKm);
    $("#selectTipoBusKm").val(selectTipoBusKm);
    $("#selectDiasKm").val(selectDiasKm);

    // Cargamos los buses
    Accion='BusesKm';
    $.ajax({
        url: "Ajax.php",
        type: "POST",
        datatype:"json",
        async: false,
        data: {MoS:MoS,NombreMoS:NombreMoS,Accion:Accion},    
        success: function(data){
            $("#selectBusKm").html(data);
        }
    });

    // Si hay cambios en el Fecha se ocultan botones y datatable
    $("#FechaTerminoKm").on('change', function () {
      $("#tablaKm").dataTable().fnDestroy();
      $('#tablaKm').hide();
    });
    
    $("#selectTipoBusKm").on('change', function () {
        selectTipoBusKm = $("#selectTipoBusKm").val();
        $("#tablaKm").dataTable().fnDestroy();
        $('#tablaKm').hide();
    });

    $("#selectTipoKm").on('change', function () {
        selectTipoKm = $("#selectTipoKm").val();
        $("#tablaKm").dataTable().fnDestroy();
        $('#tablaKm').hide();
    });

    $("#km_bus").on('change', function (){
        $("#div_EditarKm").hide();
        $("#div_modal-footer").hide();
    });

    $("#km_fecha").on('change', function (){
        $("#div_EditarKm").hide();
        $("#div_modal-footer").hide();
    });

    $("#selectDiasKm").on('change', function (){
        selectDiasKm = $("#selectDiasKm").val();
        $("#tablaKm").dataTable().fnDestroy();
        $('#tablaKm').hide();
    });

    $("#selectBusKm").on('change', function (){
        $("#formKmGrafico").trigger("reset");
        selectBusKm = $("#selectBusKm").val();
        adata = f_GenerarDatosGraficoKm(selectBusKm);
        f_MostrarGraficoKm(adata);
        $(".modal-header").css( "background-color", "#17a2b8");
        $(".modal-header").css( "color", "white" );
        $(".modal-title").text("Gráfico Kilometraje Bus "+selectBusKm);
    
        $('#modalCRUDKmGrafico').modal('show');	    
        $("#selectBusKm").val("");
        });

    ///::::::::::::::::::::::::: BOTONES DE KILOMETRAJE :::::::::::::::::::::::::::::::::::///

    ///:::::::::::::::::::::::: BOTON BUSCAR KILOMETRAJE ::::::::::::::::::::::::::::::::::///
    $("#btnBuscarKm").on("click",function(){
        let NombreTabla = "tablaKm";
        let ColumnasTabla = "";
        let div_tablaKm = "";
        let DiasKm = "";
        selectDiasKm = $("#selectDiasKm").val();
        DiasKm ="-"+selectDiasKm+" Days";
        FechaTerminoKm = $("#FechaTerminoKm").val();
        FechaInicioKm = f_CalculoFecha(FechaTerminoKm,DiasKm);

        if(div_tablaKm==""){
            Accion='CreacionTablaKm';
            $.ajax({
              url: "Ajax.php",
              type: "POST",
              datatype:"json",
              async: false,    
              data:  { MoS:MoS,NombreMoS:NombreMoS,Accion:Accion,NombreTabla:NombreTabla,FechaInicioKm:FechaInicioKm,FechaTerminoKm:FechaTerminoKm,TipoBusKm:selectTipoBusKm },    
              success: function(data) {
                div_tablaKm = data;
              }
            });
        }
        $('#div_tablaKm').html(div_tablaKm);
        $("#tablaKm").dataTable().fnDestroy();
        $('#tablaKm').show();

        Accion='CrearColumnasKm';
        $.ajax({
          url: "Ajax.php",
          type: "POST",
          datatype:"json",
          async: false,
          data: {MoS:MoS,NombreMoS:NombreMoS,Accion:Accion,FechaInicioKm:FechaInicioKm,FechaTerminoKm:FechaTerminoKm,TipoBusKm:selectTipoBusKm },    
          success: function(data){
            ColumnasTabla = $.parseJSON(data);
        }
        });

        Accion='LeerKm';
        tablaKm = $('#tablaKm').DataTable({
            //Filtros por columnas
            orderCellsTop: true,
            fixedHeader: true,
            // Para mostrar la barra scroll horizontal y vertical
            deferRender:    true,
            scrollY:        800,
            scrollCollapse: true,
            scroller:       true,
            scrollX:        true,
            fixedColumns:{
                left: 1
            },
            fixedHeader:{
                header : false
            },
            //Para mostrar 50 registros popr página 
            pageLength: 100,
            //Para cambiar el lenguaje a español
            language: idiomaEspanol, 
            //Para usar los botones
            responsive: "true",
            dom: 'Blrtip', // Con Botones Excel,Pdf,Print
            buttons:[
                {
                    extend:     'excelHtml5',
                    text:       '<i class="fas fa-file-excel"></i> ',
                    titleAttr:  'Exportar a Excel',
                    className:  'btn btn-success',
                    title:      'KILOMETRAJE '+selectTipoKm+' DEL '+FechaInicioKm+' AL '+FechaTerminoKm
                },
            ],
            "ajax":{            
                "url"   : "Ajax.php", 
                "method": 'POST', //usamos el metodo POST
                "data"  :{MoS:MoS,NombreMoS:NombreMoS,Accion:Accion,FechaInicioKm:FechaInicioKm,FechaTerminoKm:FechaTerminoKm,TipoKm:selectTipoKm,TipoBusKm:selectTipoBusKm },
                "dataSrc":""
            },
            "columns": ColumnasTabla,
            "order": [[2, 'desc']],
            "columnDefs": [
                {
                    "className" : "text-center", 
                    "targets"   : "_all"
                },
                {
                    "targets"   : [0],
                    "orderable" : false,
                    "visible"   : false
                }
            ]
        });     
    });
    ///:::::::::::::::::::::::: FIN BOTON BUSCAR KILOMETRAJE ::::::::::::::::::::::::::::::///
    
    ///::::::::::::::::::: EVENTO DEL BOTON ACTUALIZAR KILOMETRAJE ::::::::::::::::::::::::///
    $("#btnActualizarKm").on("click",function(){
        $("#formKmEditar").trigger("reset");
        datahtml = "";
        km_bus = "";
        km_fecha = "";
        selectkm_motivo = "PATIO SUR";
        $("#km_bus").val(km_bus);
        $("#km_fecha").val(km_fecha);
        $("#selectkm_motivo").val(selectkm_motivo);
    
        Accion='BusesKm';
        $.ajax({
            url: "Ajax.php",
            type: "POST",
            datatype:"json",
            async: false,
            data: {MoS:MoS,NombreMoS:NombreMoS,Accion:Accion},    
            success: function(data){
                datahtml = data;
                $("#km_bus").html(datahtml);
            }
        });
        
        $("#div_EditarKm").hide();
        $("#div_modal-footer").hide();    
        $(".modal-header").css( "background-color", "#17a2b8");
        $(".modal-header").css( "color", "white" );
        $(".modal-title").text("Editar Kilometraje");
    
        $('#modalCRUDKmEditar').modal('show');	    
    
    });
    ///::::::::::::::::::: FIN EVENTO DEL BOTON ACTUALIZAR KILOMETRAJE ::::::::::::::::::::///
    
    ///:::::::::::::::::::: EVENTO DEL BOTON EDITAR KILOMETRAJE :::::::::::::::::::::::::::///
    $("#btnEditarKm").on("click",function(){
        km_kilometraje = "";
        km_bus = $("#km_bus").val();
        km_fecha = $("#km_fecha").val();
        Accion="BuscarBusKm";
        $.ajax({
            url: "Ajax.php",
            type: "POST",
            datatype:"json",
            async: false,
            data: {MoS:MoS,NombreMoS:NombreMoS,Accion:Accion,km_bus:km_bus,km_fecha:km_fecha},    
            success: function(data){
                data = $.parseJSON(data);
                $.each(data, function(idx, obj){
                    km_kilometraje = obj.CKL_KM_KILOMETRAJE;
                    if(obj.CKL_KM_MOTIVO!=null){
                        selectkm_motivo = obj.CKL_KM_MOTIVO;
                    }else{
                        selectkm_motivo = "PATIO SUR";
                    }
                    if(obj.CKL_KM_HISTORIAL!=null){
                        km_historial = obj.CKL_KM_HISTORIAL;
                    }else{
                        km_historial = obj.CKL_KM_FECHA_CARGA + " - " + obj.km_usuario_carga + ": CARGA KILOMETRAJE <br>";
                    }
                });
            }
        });

        if(km_kilometraje==""){
            Swal.fire({
                position: 'center',
                icon: 'warning',
                title: 'DATOS NO ENCONTRADOS!',
                text: "COMPRUEBE QUE LOS DATOS DE BUS Y FECHA SON LOS CORRECTOS",
                showConfirmButton: false,
                timer: 2000
              })      
        }else{
            $("#tkm_bus").val(km_bus);
            $("#tkm_fecha").val(km_fecha);
            $("#km_kilometraje").val(km_kilometraje);
            $("#selectkm_motivo").val(selectkm_motivo);
            $("#div_km_historial").html(km_historial);
            $("#div_EditarKm").show();
            $("#div_modal-footer").show();    
        }
    });

    ///::::::::::::: BOTON GRAFICO DE KILOMETRAJE :::::::::::::::::::::::::::::::::::::::::///
    $(document).on("click", ".btnGraficoKm", function(){
        filaKm = $(this);           
        BusKm = filaKm.closest('tr').find('td:eq(1)').text();
        adata = f_GenerarDatosGraficoKm(BusKm);
        f_MostrarGraficoKm(adata);
        $(".modal-header").css( "background-color", "#17a2b8");
        $(".modal-header").css( "color", "white" );
        $(".modal-title").text("Gráfico Kilometraje Bus "+BusKm);
        $('#modalCRUDKmGrafico').modal('show');	    
    });
    ///:::::::::::::::::::: EVENTO DEL BOTON EDITAR KILOMETRAJE :::::::::::::::::::::::::::///

    /// ::::::::::::::: BOTON EDITA KILOMETRAJE POR BUS Y FECHA :::::::::::::::::::::::::::///
    $('#formKmEditar').submit(function(e){
        e.preventDefault(); //evita el comportambiento normal del submit, es decir, recarga total de la página
        let tvalidakm="";
        let mensajekm = "*El kilometraje ingresado no corresponde!";
        
        km_bus = $("#tkm_bus").val();
        km_fecha = $("#tkm_fecha").val();
        km_kilometraje = $("#km_kilometraje").val();
        selectkm_motivo = $("#selectkm_motivo").val();

        tvalidakm = f_validarKm(km_bus,km_fecha,km_kilometraje);

        if(tvalidakm=="NO"){
            Swal.fire({
                title: '¿Está seguro de guardar?',
                html: "Ten en cuenta que:<br>"+mensajekm+"!!!",
                icon: 'warning',
                showCancelButton: true,
                cancelButtonColor: '#d33',
                cancelButtonText: 'Cancelar',
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'Si, guardar!',
                focusCancel: true
            }).then((result) => 
            {
                if(result.isConfirmed){
                    $("#bntGuardarKm").prop("disabled",true);
                    // Cargamos las variables en blanco
                    Accion = 'GrabarKm';
                    $.ajax({
                        url: "Ajax.php",
                        type: "POST",
                        datatype:"json",
                        async: false,
                        data: {MoS:MoS,NombreMoS:NombreMoS,Accion:Accion,km_bus:km_bus,km_fecha:km_fecha,km_kilometraje:km_kilometraje,km_motivo:selectkm_motivo,km_historial:km_historial},    
                        success: function(data){
                            $("#bntGuardarKm").prop("disabled",false);
                        }
                    });
                    Swal.fire({
                        position: 'center',
                        icon: 'success',
                        title: 'El registro ha sido grabado.',
                        showConfirmButton: false,
                        timer: 1500
                    })
                    $('#modalCRUDKmEditar').modal('hide');      
                }
            });
        }else{
            $("#bntGuardarKm").prop("disabled",true);
            // Cargamos las variables en blanco
            Accion = 'GrabarKm';
            $.ajax({
                url: "Ajax.php",
                type: "POST",
                datatype:"json",
                async: false,
                data: {MoS:MoS,NombreMoS:NombreMoS,Accion:Accion,km_bus:km_bus,km_fecha:km_fecha,km_kilometraje:km_kilometraje,km_motivo:selectkm_motivo,km_historial:km_historial},    
                success: function(data){
                    $("#bntGuardarKm").prop("disabled",false);
                }
            });
            Swal.fire({
                position: 'center',
                icon: 'success',
                title: 'El registro ha sido grabado.',
                showConfirmButton: false,
                timer: 1500
            })      
            $('#modalCRUDKmEditar').modal('hide');      
        }
    });
    ///::::::::::::::: FIN BOTON EDITA KILOMETRAJE POR BUS Y FECHA ::::::::::::::::::::::::///

    ///::::::::::::::::::::::::: TERMINO BOTONES DE KILOMETRAJE :::::::::::::::::::::::::::///

});    
///:::::::::::::::::::::::: TERMINO JS DOM KILOMETRAJE ::::::::::::::::::::::::::::::::::::///


///:::::::::::::::::::::::::: FUNCIONES DE KILOMETRAJE ::::::::::::::::::::::::::::::::::::///

///::::::::::::::::::::::: VALIDA EL KM EDITADO :::::::::::::::::::::::::::::::::::::::::::///
function f_validarKm(pkm_bus,pkm_fecha,pkm_kilometraje){
    let rptakm = "";
    Accion='ValidarKm';
    $.ajax({
      url: "Ajax.php",
      type: "POST",
      datatype:"json",
      async: false,
      data: {MoS:MoS,NombreMoS:NombreMoS,Accion:Accion,km_bus:pkm_bus,km_fecha:pkm_fecha,km_kilometraje:pkm_kilometraje},    
      success: function(data){
        rptakm = data;
      },
    });
    return rptakm;
}
///::::::::::::::::::::::: FIN VALIDA EL KM EDITADO :::::::::::::::::::::::::::::::::::::::///

///::::::::::::::::::: GENERACION DE DATOS PARA EL GRAFICO ::::::::::::::::::::::::::::::::///
function f_GenerarDatosGraficoKm(pBusKm){
    rptaData = [];
    Accion='DatosGraficoKm';
    $.ajax({
        url: "Ajax.php",
        type: "POST",
        datatype:"json",
        async: false,
        data: {MoS:MoS,NombreMoS:NombreMoS,Accion:Accion,buskm:pBusKm},    
        success: function(data){
            rptaData = $.parseJSON(data);
        }
    });
    return rptaData;
}
///::::::::::::::::::: FIN GENERACION DE DATOS PARA EL GRAFICO ::::::::::::::::::::::::::::///

///:::::::::::::::::::::::::: GRAFICA DE KILOMETRAJE POR BUS ::::::::::::::::::::::::::::::///
function f_MostrarGraficoKm(pdata){
    am5.ready(function() {
        var divId = "chartdivGraficoKm";

        // Si no tenemos referencia a un elemento raíz creado previamente, podemos encontrarlo entre am5.registry.rootElements, que es una matriz que contiene todos los elementos raíz.
        am5.array.each(am5.registry.rootElements, function(root) {
            if (root.dom.id == divId) {
              root.dispose();
            }
          });
    
        // Create root element
        // https://www.amcharts.com/docs/v5/getting-started/#Root_element
        root = am5.Root.new(divId);
        
        // Set themes
        // https://www.amcharts.com/docs/v5/concepts/themes/
        root.setThemes([
          am5themes_Animated.new(root)
        ]);

        // Create chart
        // https://www.amcharts.com/docs/v5/charts/xy-chart/
        var chart = root.container.children.push(am5xy.XYChart.new(root, {
            panX: true,
            panY: true,
            wheelX: "panX",
            wheelY: "zoomX",
            pinchZoomX:true
        }));

        // Add cursor
        // https://www.amcharts.com/docs/v5/charts/xy-chart/cursor/
        var cursor = chart.set("cursor", am5xy.XYCursor.new(root, {
            behavior: "none"
        }));
        cursor.lineY.set("visible", false);
    
        // Genera Data
        var adataGraficoKm = [];
        $.each(pdata, function(idx, obj){
            date1 = new Date(obj.date);
            if(obj.value===null){
                obj.value='0';
            }
            value1 = parseInt(obj.value);
            date1.setHours(0, 0, 0, 0);
            am5.time.add(date1, "day", 1);
            date = date1.getTime();
            value = value1;
            adataGraficoKm.push({date:date,value:value});
        });

        // Create axes
        // https://www.amcharts.com/docs/v5/charts/xy-chart/axes/
        var xAxis = chart.xAxes.push(am5xy.DateAxis.new(root, {
          maxDeviation: 0.2,
          baseInterval: {
            timeUnit: "day",
            count: 1
          },
          renderer: am5xy.AxisRendererX.new(root, {}),
          tooltip: am5.Tooltip.new(root, {})
        }));

        var yAxis = chart.yAxes.push(am5xy.ValueAxis.new(root, {
          renderer: am5xy.AxisRendererY.new(root, {})
        }));
        
        // Add series
        // https://www.amcharts.com/docs/v5/charts/xy-chart/series/
        var series = chart.series.push(am5xy.LineSeries.new(root, {
          name: "Series",
          xAxis: xAxis,
          yAxis: yAxis,
          valueYField: "value",
          valueXField: "date",
          tooltip: am5.Tooltip.new(root, {
            labelText: "{valueY}"
          })
        }));
    
        // Add scrollbar
        // https://www.amcharts.com/docs/v5/charts/xy-chart/scrollbars/
        chart.set("scrollbarX", am5.Scrollbar.new(root, {
          orientation: "horizontal"
        }));

        // Set data
        series.data.setAll(adataGraficoKm);

        // Make stuff animate on load
        // https://www.amcharts.com/docs/v5/concepts/animations/
        series.appear(500);
        chart.appear(500, 50);

    }); // end am5.ready()
}
///:::::::::::::::::::::::: fin GRAFICA DE KILOMETRAJE POR BUS ::::::::::::::::::::::::::::///

///:::::::::::::::::::::::: TERMINO FUNCIONES DE KILOMETRAJE ::::::::::::::::::::::::::::::///