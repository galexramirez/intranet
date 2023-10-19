///:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
///:::::::::::::::::::: INICIO v 2.0 :::::::::::::::::::::::::///
///::::::::::::: VARIABLES Y FUNCIONES GLOBALES ::::::::::::::///
///:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///

///::::::::::: Declaracion de Variables GLOBALES :::::::::::::///

// MoS: Module o Services, NombreMoS: Nombre del modulo o servicio, Accion: Funcion a ejecutar
var MoS, NombreMoS, Accion, div_tabs, div_tablas, div_boton, div_show, columnastabla, mi_carpeta;
var idiomaEspanol;
mi_carpeta      = f_DocumentRoot();
const fecha_hoy = new Date();
MoS             = "Module";
NombreMoS       = "ControlFacilitador";
idiomaEspanol   = {
  "lengthMenu": "&nbsp&nbsp&nbsp&nbspMostrar _MENU_ registros",
  "zeroRecords": "No se encuentran resultados",
  "info": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
  "infoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
  "infoFiltered": "(Filtrado de un total de _MAX_ registros)",
  "sSearch": "Buscar:",
  "oPaginate": 
    {
      "sFirst": "Primero",
      "sLast": "Ultimo",
      "sNext": "Siguiente",
      "sPrevious": "Anterior"
    },
  "select":
    {
      "rows":
      {
        "_": "Seleccionadas %d filas",
        "0": "Click a una fila para seleccionarla",
        "1": "Seleccionada 1 fila"
      }
    },
  "sProcessing": "Procesando...",
};

///::::::::: ACTIVA LOS TABS ::::::::::::: ///
$(document).ready(function() {
  div_tabs = f_CreacionTabs("nav-tab-ControlFacilitador","");
  $("#nav-tab-ControlFacilitador").html(div_tabs);

  $( "#tabs" ).tabs();
});

///::::::::::::::::::::::::::::::::::::: FUNCIONES GLOBALES :::::::::::::::::::::::::::::::::::///

///::::::: FUNCION PARA VALIDAR LOS DATOS INGRESADOS AL CONTROL fACILITADOR :::::::::::::::::::///
function fInconsistenciasControlFacilitador(Prog_Fecha,Prog_Operacion){
  let aInconsistenciasOperacion;
  Accion='InconsistenciasControlFacilitador'; 
  $.ajax({
        url: "Ajax.php",
        type: "POST",
        datatype:"json",    
        async: false,    
        data: {MoS:MoS,NombreMoS:NombreMoS,Accion:Accion,Prog_Fecha:Prog_Fecha,Prog_Operacion:Prog_Operacion},    
        success: function(data){
          aInconsistenciasOperacion = $.parseJSON(data);
        }
  });
  return aInconsistenciasOperacion;
}

///::::::: FUNCION PARA VALIDAR LOS DATOS A CAMBIAR BUS Y PILOTO ANTES DE GRABAR :::::::::::::::::::///
function f_InconsistenciasBusPiloto(Prog_Fecha,Prog_Operacion,Prog_Bus,Prog_NombreColaborador,p_adata,Prog_HoraOrigen,Prog_HoraDestino) {
  let rptaInconsistenciasBusPiloto;
  let p_arrData = [];
  p_arrData = JSON.stringify(p_adata);
  Accion='InconsistenciasBusPiloto'; 
  $.ajax({
        url: "Ajax.php",
        type: "POST",
        datatype:"json",    
        async: false,    
        data: {MoS:MoS,NombreMoS:NombreMoS,Accion:Accion,Prog_Fecha:Prog_Fecha,Prog_Operacion:Prog_Operacion,Prog_Bus:Prog_Bus,Prog_NombreColaborador,arrData:p_arrData,Prog_HoraOrigen:Prog_HoraOrigen,Prog_HoraDestino:Prog_HoraDestino},    
        success: function(data){
          rptaInconsistenciasBusPiloto = data;
        }
  });
  return rptaInconsistenciasBusPiloto;
}

///::::: DETECTA SI LA TECLA CONTROL FUE PRESIONADA :::::///
function isKeyPressed(event) {
  if (event.ctrlKey) {
  //  CTRL Key Presionada
    return true;
  } else {
  //  CTRL Key NO Presionada
    return false;
  }
}

function f_selectNovedad(Prog_Fecha,Prog_Operacion,ControlFacilitador_Id){
  let rptaSelectNovedad="";
  Accion='SelectNovedad';
  $.ajax({
    url: "Ajax.php",
    type: "POST",
    datatype:"json",
    async: false,    
    data: {MoS:MoS,NombreMoS:NombreMoS,Accion:Accion,Prog_Fecha:Prog_Fecha,Prog_Operacion:Prog_Operacion,ControlFacilitador_Id:ControlFacilitador_Id},    
    success: function(data){
      rptaSelectNovedad=data;
    }
  });
  return rptaSelectNovedad;  
}

function f_TipoTabla(Prog_Operacion,Tipo){
  let rptaSelect="";
  Accion='SelectTipos';
  $.ajax({
    url: "Ajax.php",
    type: "POST",
    datatype:"json",
    async: false,
    data: {MoS:MoS,NombreMoS:NombreMoS,Accion:Accion,Prog_Operacion:Prog_Operacion,Tipo:Tipo},    
    success: function(data){
      rptaSelect = data;
    }
  });
  return rptaSelect;
}

function f_KmRecorridos(Prog_Operacion,Prog_Sentido,Prog_Servicio,Prog_LugarOrigen,Prog_LugarDestino){
  let RptaKmRecorridos = 0; 
  Accion='KmRecorridos';
  $.ajax({
    url: "Ajax.php",
    type: "POST",
    datatype:"json",
    async: false,    
    data: {MoS:MoS,NombreMoS:NombreMoS,Accion:Accion,Prog_Operacion:Prog_Operacion,Prog_Sentido:Prog_Sentido,Prog_Servicio:Prog_Servicio,Prog_LugarOrigen:Prog_LugarOrigen,Prog_LugarDestino:Prog_LugarDestino},    
    success: function(data){
      RptaKmRecorridos = data;
    }
  });
  return RptaKmRecorridos;
}

function f_fecha_texto(p_fecha){
  let rpta_fecha = ""
  switch (p_fecha.getMonth()+1){
    case 1: xtm = 'ENERO'; break; 
    case 2: xtm = 'FEBRERO'; break; 
    case 3: xtm = 'MARZO'; break; 
    case 4: xtm = 'ABRIL'; break; 
    case 5: xtm = 'MAYO'; break; 
    case 6: xtm = 'JUNIO'; break; 
    case 7: xtm = 'JULIO'; break; 
    case 8: xtm = 'AGOSTO'; break; 
    case 9: xtm = 'SETIEMBRE'; break; 
    case 10: xtm = 'OCTUBRE'; break; 
    case 11: xtm = 'NOVIEMBRE'; break; 
    case 12: xtm = 'DICIEMBRE'; break; 
  };
  xtd = '0'+p_fecha.getDate();
  xtd = xtd.substr(-2);
  switch (p_fecha.getDay()){
    case 0: xtdd = 'DOMINGO'; break; 
    case 1: xtdd = 'LUNES'; break; 
    case 2: xtdd = 'MARTES'; break; 
    case 3: xtdd = 'MIERCOLES'; break; 
    case 4: xtdd = 'JUEVES'; break; 
    case 5: xtdd = 'VIERNES'; break; 
    case 6: xtdd = 'SABADO'; break; 
  };
  xta = p_fecha.getFullYear();
  rpta_fecha = xtdd+", "+xtd+" DE "+xtm+" DE "+xta;
  return rpta_fecha;
}

///:: FUNCION CANTIDAD DE HORAS TRABAJADAS HASTA UNA HORA DETERMINADA :::::::::::::::::::::///
function f_horas_trabajadas(p_operacion, p_fecha, p_codigo, p_hora){
  let rpta_horas_trabajadas = "";
  Accion = 'horas_trabajadas';
  $.ajax({
    url       : "Ajax.php",
    type      : "POST",
    datatype  : "json",
    async     : false,
    data      : {MoS:MoS, NombreMoS:NombreMoS, Accion:Accion, operacion:p_operacion, fecha:p_fecha, p_codigo:p_codigo, hora:p_hora},    
    success: function(data){
      rpta_horas_trabajdas = data;
    }
  });
  return rpta_horas_trabajadas
}

//::::::::::::::::::::::::::::::::: BUSCAR DATA EN BD :::::::::::::::::::::::::::::://
function f_BuscarDataBD(pTablaBD,pCampoBD,pDataBuscar){
  let rptaData;
  Accion='BuscarDataBD';
  $.ajax({
    url       : "Ajax.php",
    type      : "POST",
    datatype  : "json",
    async     : false,
    data      : {MoS:MoS,NombreMoS:NombreMoS,Accion:Accion,TablaBD:pTablaBD,CampoBD:pCampoBD,DataBuscar:pDataBuscar},    
    success   : function(data){
      rptaData = $.parseJSON(data);
    }
  });
  return rptaData;
}

//::::::::::::::::::::::::::::::::: AUTOCOMPLETADO :::::::::::::::::::::::::::::://
function f_auto_completar(p_nombre_tabla, p_nombre_campo){
  let rpta_auto_completar="";
  Accion='auto_completar';
  $.ajax({
    url       : "Ajax.php",
    type      : "POST",
    datatype  : "json",
    async     : false,
    data      : {MoS:MoS,NombreMoS:NombreMoS,Accion:Accion, nombre_tabla:p_nombre_tabla,nombre_campo:p_nombre_campo},
    success   : function(data){
      rpta_auto_completar = $.parseJSON(data);
    }
  });
  return rpta_auto_completar;
}

///:: FUNCION UTILIZAR LABEL AUTOCOMPLETE COMO HTML :::::::::::::::::::::::::::::::::::::::///
(function( $ ) {

  var proto = $.ui.autocomplete.prototype,
    initSource = proto._initSource;
  
  function filter( array, term ) {
    var matcher = new RegExp( $.ui.autocomplete.escapeRegex(term), "i" );
    return $.grep( array, function(value) {
      return matcher.test( $( "<div>" ).html( value.label || value.value || value ).text() );
    });
  }
  
  $.extend( proto, {
    _initSource: function() {
      if ( this.options.html && $.isArray(this.options.source) ) {
        this.source = function( request, response ) {
          response( filter( this.options.source, request.term ) );
        };
      } else {
        initSource.call( this );
      }
    },
  
    _renderItem: function( ul, item) {
      return $( "<li></li>" )
        .data( "item.autocomplete", item )
        .append( $( "<a class='text-decoration-none'></a>" )[ this.options.html ? "html" : "text" ]( item.label ) )
        .appendTo( ul );
    }
  });
  
})( jQuery );
///:: FIN FUNCION UTILIZAR LABEL AUTOCOMPLETE COMO HTML :::::::::::::::::::::::::::::::::::///

function f_buscar_dato(p_nombre_tabla, p_campo_buscar, p_condicion_where){
  let rpta_buscar = "";
  Accion = 'buscar_dato';
  $.ajax({
    url       : "Ajax.php",
    type      : "POST",
    datatype  : "json",
    async     : false,
    data      : {MoS:MoS, NombreMoS:NombreMoS, Accion:Accion, nombre_tabla:p_nombre_tabla, campo_buscar:p_campo_buscar, condicion_where:p_condicion_where},
    success   : function(data){
      rpta_buscar = data;
    }
  });
  return rpta_buscar;
}

function f_DocumentRoot(){
  let rptaMiCarpeta = '';
  Accion = 'DocumentRoot';
  $.ajax({
    url       : "Ajax.php",
    type      : "POST",
    datatype  : "json",
    async     : false,
    data      : {MoS:MoS,NombreMoS:NombreMoS,Accion:Accion},    
    success   : function(data){
      rptaMiCarpeta = data;
    }
  });
  return rptaMiCarpeta;
}

///::::::::::::::: FUNCIONES PARA LA CREACION DE ACCESOS ::::::::::::::::::::::::::::///
function f_CreacionTabs(pNombreTabs,pTipoTabs){
  let rptaTabs="";
  Accion='CreacionTabs';
  $.ajax({
    url: "Ajax.php",
    type: "POST",
    datatype:"json",
    async: false,
    data: {MoS:MoS,NombreMoS:NombreMoS,Accion:Accion,NombreTabs:pNombreTabs,TipoTabs:pTipoTabs},    
    success: function(data){
      rptaTabs = data;
    }
  });
  return rptaTabs;
}

function f_CreacionTabla(pNombreTabla,pTipoTabla){
  let rptaTabla="";
  Accion='CreacionTabla';
  $.ajax({
    url: "Ajax.php",
    type: "POST",
    datatype:"json",
    async: false,
    data: {MoS:MoS,NombreMoS:NombreMoS,Accion:Accion,NombreTabla:pNombreTabla,TipoTabla:pTipoTabla},    
    success: function(data){
      rptaTabla = data;
    }
  });
  return rptaTabla;
}

function f_ColumnasTabla(pNombreTabla,pTipoTabla){
  let rptaColumnas;
  Accion='ColumnasTabla';
  $.ajax({
    url: "Ajax.php",
    type: "POST",
    datatype:"json",
    async: false,
    data: {MoS:MoS,NombreMoS:NombreMoS,Accion:Accion,NombreTabla:pNombreTabla,TipoTabla:pTipoTabla},    
    success: function(data){
      rptaColumnas = $.parseJSON(data);
    }
  });
  return rptaColumnas;
}

function f_BotonesFormulario(pNombreFormulario,pNombreObjeto){
  let rptaBotonesFormulario="";
  Accion='BotonesFormulario';
  $.ajax({
    url: "Ajax.php",
    type: "POST",
    datatype:"json",
    async: false,
    data: {MoS:MoS,NombreMoS:NombreMoS,Accion:Accion,NombreFormulario:pNombreFormulario,NombreObjeto:pNombreObjeto},    
    success: function(data){
      rptaBotonesFormulario = data;
    }
  });
  return rptaBotonesFormulario;
}

function f_DivFormulario(pNombreFormulario,pNombreObjeto){
  let rptaDivFormulario="";
  Accion='DivFormulario';
  $.ajax({
    url: "Ajax.php",
    type: "POST",
    datatype:"json",
    async: false,
    data: {MoS:MoS,NombreMoS:NombreMoS,Accion:Accion,NombreFormulario:pNombreFormulario,NombreObjeto:pNombreObjeto},    
    success: function(data){
      rptaDivFormulario = data;
    }
  });
  return rptaDivFormulario;
}

function f_MostrarDiv(pNombreFormulario,pNombreObjeto,pDato){
  let rptaMostrarDiv="";
  Accion='MostrarDiv';
  $.ajax({
    url: "Ajax.php",
    type: "POST",
    datatype:"json",
    async: false,
    data: {MoS:MoS,NombreMoS:NombreMoS,Accion:Accion,NombreFormulario:pNombreFormulario,NombreObjeto:pNombreObjeto,Dato:pDato},    
    success: function(data){
      rptaMostrarDiv = data;
    }
  });
  return rptaMostrarDiv;
}

///::::::::::::::: FIN DE FUNCIONES PARA LA CREACION DE ACCESOS ::::::::::::::::::::::::::::///