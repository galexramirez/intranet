///::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
///:: DASHBOARD MANTENIMIENTO v1.0 FECHA: 2023-06-21 ::::::::::::::::::::::::::::::::::::::///
//::: INFORMACION GRAFICA OTS CORRECTIVAS, PREVENTIVAS, VALES Y KILOMETRAJE :::::::::::::::///
///::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///

var dbm_fecha_inicio, dbm_fecha_termino, miCarpeta, array_data, valor, categoria;
var rootElements = {};
miCarpeta = f_DocumentRoot();
dbm_fecha_inicio = "";
dbm_fecha_termino = "";

$(document).ready(function(){

  if(dbm_fecha_inicio=="" && dbm_fecha_termino==""){
    dbm_fecha_inicio = f_CalculoFecha("hoy","-1 Week");
    dbm_fecha_termino = f_CalculoFecha("hoy","0");
    $('#dbm_fecha_inicio').val(dbm_fecha_inicio);
    $('#dbm_fecha_termino').val(dbm_fecha_termino);
  }

  // Si hay cambios en el Fecha se ocultan botones y datatable
  $("#dbm_fecha_inicio, #dbm_fecha_termino").on('change', function () {
    div_show = f_MostrarDiv("form_dashboard", "content","vacio");
    $("#content").html(div_show);
  });

  $(document).on("click", ".btn_cargar_dashboard", function(){
    div_show = f_MostrarDiv("form_dashboard", "content", "cargar");
    $("#content").html(div_show);
    valor     = "valor";
    categoria = "estado";
    f_grafico_pie("manto_ot", "ot_estado", "ot_date_crea", valor, categoria, "div_chart_pie_ot");
    f_grafico_pie("manto_otprv", "otpv_estado", "otpv_date_prog", valor, categoria, "div_chart_pie_otprv");
    f_grafico_pie("manto_vales", "va_estado", "va_date_genera", valor, categoria, "div_chart_pie_vales");
    //f_grafico_pie("manto_vales_prv", "vapv_estado", "vapv_date_genera", valor, categoria, "div_chart_pie_vales_prv");
    //createChartLine("div_chart_line_km"); 
  
  });
});    


///:: FUNCIONES DASHBOARD MANTENIMIENTO :::::::::::::::::::::::::::::::::::::::::::::::::::///

///:: FUNCION PARA VALIDAR LOS DATOS INGRESADOS AL FORMULARIO ::::::::::::::::::::::::::::///
function f_validar_dbm(p_dbm_fecha_inicio, p_dbm_fecha_termino){
  f_limpia_dbm();
  let rpta_dbm="";    

  if(p_dbm_fecha_inicio > p_dbm_fecha_termino){
    $("#dbm_fecha_inicio").addClass("color-error");
    $("#dbm_fecha_termino").addClass("color-error");
    rpta_dbm="invalido";
  }

  if(p_dbm_fecha_termino=="" || p_dbm_fecha_inicio==""){
    $("#dbm_fecha_inicio").addClass("color-error");
    $("#dbm_fecha_termino").addClass("color-error");
    rpta_dbm="invalido";
  }

  return rpta_dbm; 
}
///:: FIN FUNCION PARA VALIDAR LOS DATOS INGRESADOS AL FORMULARIO ::::::::::::::::::::::::///

///:: REESTABLECE EL COLOR DEL CAMPO EN EL FORMULARIO ::::::::::::::::::::::::::::::::::::/// 
function f_limpia_dbm(){
  $("#dbm_fecha_inicio").removeClass("color-error");
  $("#dbm_fecha_termino").removeClass("color-error");
}
///:: FIN REESTABLECE EL COLOR DEL CAMPO EN EL FORMULARIO ::::::::::::::::::::::::::::::::/// 

function f_grafico_pie(p_tabla, p_campo, p_campo_fecha, p_valor, p_categoria, p_divId ){
  let a_data;
  dbm_fecha_inicio = $("#dbm_fecha_inicio").val();
  dbm_fecha_termino = $("#dbm_fecha_termino").val();

  Accion='datos_grafico_pie';
  $.ajax({
    url       : "Ajax.php",
    type      : "POST",
    datatype  : "json",
    async     : true,
    data      : {MoS:MoS, NombreMoS:NombreMoS, Accion:Accion, tabla:p_tabla, campo:p_campo, fecha_inicio:dbm_fecha_inicio, fecha_termino:dbm_fecha_termino, campo_fecha:p_campo_fecha, valor:p_valor, categoria:p_categoria},    
    success: function(data){
      a_data = $.parseJSON(data);
      createChartPie(p_divId, a_data, p_valor, p_categoria);
    }
  });  
}

function createChartPie(p_divId, p_data, p_valor, p_categoria) {
  // Dispose previously created Root element
  maybeDisposeRoot(p_divId);

  // Create root element
  // https://www.amcharts.com/docs/v5/getting-started/#Root_element
  var root = am5.Root.new(p_divId);
  rootElements[p_divId] = root;
  // Set themes
  // https://www.amcharts.com/docs/v5/concepts/themes/
  root.setThemes([
    am5themes_Animated.new(root)
  ]);
  
  // Create chart
  // https://www.amcharts.com/docs/v5/charts/percent-charts/pie-chart/
  var chart = root.container.children.push(
    am5percent.PieChart.new(root, {
      endAngle: 270
    })
  );
  
  // Create series
  // https://www.amcharts.com/docs/v5/charts/percent-charts/pie-chart/#Series
  var series = chart.series.push(
    am5percent.PieSeries.new(root, {
      valueField: p_valor,
      categoryField: p_categoria,
      endAngle: 270
    })
  );
  
  series.states.create("hidden", {
    endAngle: -90
  });
  
  // Set data
  // https://www.amcharts.com/docs/v5/charts/percent-charts/pie-chart/#Setting_data
  series.data.setAll(p_data);

  series.appear(100, 10);
  
}; // end am5.ready()

function maybeDisposeRoot(p_divId) {
  // Verificar si el elemento existe en el objeto rootElements
  if (rootElements[p_divId]) {
    // Dispose del elemento
    rootElements[p_divId].dispose();
    // Eliminar el elemento del objeto rootElements
    delete rootElements[p_divId];
  }
}

function createChartLine(p_divId) {
  // Dispose previously created Root element
  maybeDisposeRoot(p_divId);


  // Create root element
  // https://www.amcharts.com/docs/v5/getting-started/#Root_element 
  var root = am5.Root.new(p_divId);
  
  
  // Set themes
  // https://www.amcharts.com/docs/v5/concepts/themes/ 
  root.setThemes([
    am5themes_Dark.new(root)
  ]);
  
  
  // Create chart
  // https://www.amcharts.com/docs/v5/charts/xy-chart/
  var chart = root.container.children.push(am5xy.XYChart.new(root, {
    panX: true,
    panY: true,
    wheelX: "panX",
    wheelY: "zoomX",
    maxTooltipDistance: 0,
    pinchZoomX:true
  }));
  
  
  var date = new Date();
  date.setHours(0, 0, 0, 0);
  var value = 100;
  
  function generateData() {
    value = Math.round((Math.random() * 10 - 4.2) + value);
    am5.time.add(date, "day", 1);
    return {
      date: date.getTime(),
      value: value
    };
  }
  
  function generateDatas(count) {
    var data = [];
    for (var i = 0; i < count; ++i) {
      data.push(generateData());
    }
    return data;
  }
  
  
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
  for (var i = 0; i < 2; i++) {
    var series = chart.series.push(am5xy.LineSeries.new(root, {
      name: "Series " + i,
      xAxis: xAxis,
      yAxis: yAxis,
      valueYField: "value",
      valueXField: "date",
      legendValueText: "{valueY}",
      tooltip: am5.Tooltip.new(root, {
        pointerOrientation: "horizontal",
        labelText: "{valueY}"
      })
    }));
  
    date = new Date();
    date.setHours(0, 0, 0, 0);
    value = 0;
  
    var data = generateDatas(100);
    series.data.setAll(data);
  
    // Make stuff animate on load
    // https://www.amcharts.com/docs/v5/concepts/animations/
    series.appear();
  }
  
  
  // Add cursor
  // https://www.amcharts.com/docs/v5/charts/xy-chart/cursor/
  var cursor = chart.set("cursor", am5xy.XYCursor.new(root, {
    behavior: "none"
  }));
  cursor.lineY.set("visible", false);
  
  
  // Add scrollbar
  // https://www.amcharts.com/docs/v5/charts/xy-chart/scrollbars/
  chart.set("scrollbarX", am5.Scrollbar.new(root, {
    orientation: "horizontal"
  }));
  
  chart.set("scrollbarY", am5.Scrollbar.new(root, {
    orientation: "vertical"
  }));
  
  
  // Add legend
  // https://www.amcharts.com/docs/v5/charts/xy-chart/legend-xy-series/
  var legend = chart.rightAxesContainer.children.push(am5.Legend.new(root, {
    width: 200,
    paddingLeft: 15,
    height: am5.percent(100)
  }));
  
  // When legend item container is hovered, dim all the series except the hovered one
  legend.itemContainers.template.events.on("pointerover", function(e) {
    var itemContainer = e.target;
  
    // As series list is data of a legend, dataContext is series
    var series = itemContainer.dataItem.dataContext;
  
    chart.series.each(function(chartSeries) {
      if (chartSeries != series) {
        chartSeries.strokes.template.setAll({
          strokeOpacity: 0.15,
          stroke: am5.color(0x000000)
        });
      } else {
        chartSeries.strokes.template.setAll({
          strokeWidth: 3
        });
      }
    })
  })
  
  // When legend item container is unhovered, make all series as they are
  legend.itemContainers.template.events.on("pointerout", function(e) {
    var itemContainer = e.target;
    var series = itemContainer.dataItem.dataContext;
  
    chart.series.each(function(chartSeries) {
      chartSeries.strokes.template.setAll({
        strokeOpacity: 1,
        strokeWidth: 1,
        stroke: chartSeries.get("fill")
      });
    });
  })
  
  legend.itemContainers.template.set("width", am5.p100);
  legend.valueLabels.template.setAll({
    width: am5.p100,
    textAlign: "right"
  });
  
  // It's is important to set legend data after all the events are set on template, otherwise events won't be copied
  legend.data.setAll(chart.series.values);
  
  
  // Make stuff animate on load
  // https://www.amcharts.com/docs/v5/concepts/animations/
  chart.appear(1000, 100);
  
  }; // end am5.ready()


  ///:: TERMINO FUNCIONES DASHBOARD MANTENIMIENTO :::::::::::::::::::::::::::::::::::::::::::///