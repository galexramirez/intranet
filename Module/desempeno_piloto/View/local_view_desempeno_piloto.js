///::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
///:: DESEMPEÑO DE PILOTO v1.0 FECHA: 2023-10-21 ::::::::::::::::::::::::::::::::::::::::::///
//::: INFORMACION GRAFICA DE INASISTENCIAS, COMPORTAMIENTO Y ACCIDENTES DEL PILOTO ::::::::///
///::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///

let dp_fecha_inicio, dp_fecha_termino, dp_nombre_piloto;

dp_fecha_inicio = "";
dp_fecha_termino = "";

$(document).ready(function(){

  if(dp_fecha_inicio=="" && dp_fecha_termino==""){
    dp_fecha_inicio = f_CalculoFecha("hoy","-1 Week");
    dp_fecha_termino = f_CalculoFecha("hoy","0");
    $('#dp_fecha_inicio').val(dp_fecha_inicio);
    $('#dp_fecha_termino').val(dp_fecha_termino);
  }

  ///:: Si hay cambios en el Fecha se ocultan botones y datatable :::::::::::::::::::::::::///
  $("#dp_nombre_piloto, #dp_fecha_inicio, #dp_fecha_termino").on('change', function(){
    div_show = f_MostrarDiv("form_desempeno_piloto", "content","vacio");
    $("#content").html(div_show);
  });

  $(document).on("click", ".btn_cargar_desempeno_piloto", function(){
    dp_nombre_piloto = $("#dp_nombre_piloto").val();
    dp_fecha_inicio = $("#dp_fecha_inicio").val();
    dp_fecha_termino = $("#dp_fecha_termino").val();
    div_show = f_MostrarDiv("form_desempeno_piloto", "content", "cargar");
    Accion='cargar_desempeno_piloto';
    $.ajax({
      url     : "Ajax.php",
      type    : "POST",
      datatype: "json",
      async   : false,
      data    : {MoS:MoS, NombreMoS:NombreMoS, Accion:Accion, nombre_piloto:dp_nombre_piloto, fecha_inicio:dp_fecha_inicio, fecha_termino:dp_fecha_termino},    
      success: function(data){
        div_show = data;
      }
    });
    $("#content").html(div_show); 
  });

  ///:: CARGAR LOS DATOS PARA AUTOCOMPLETAR :::::::::::::::::::::::::::::::::::::::::::::::///
  $(function(){
    let t_auto_completar = f_auto_completar("colaborador","Colab_ApellidosNombres");
    $("#dp_nombre_piloto").autocomplete({
      minLength : 3,
      source    : t_auto_completar,
      html      : true,
      _renderMenu: function(ul, items) {
        var that = this;
        $.each(items, function(index, item) { 
          that._renderItemData(ul, item);
        });
        $(ul).find("li").odd().addClass("odd");
      }
    });
  });

});


///:: FUNCIONES DESEMPEÑO DE PILOTO :::::::::::::::::::::::::::::::::::::::::::::::::::::::///

///:: FUNCION PARA UTILIZAR EL LABEL DEL AUTOCOMPLETE COMO HTML :::::::::::::::::::::::::::///
(function( $ ) {
  let proto = $.ui.autocomplete.prototype,
  initSource = proto._initSource;
  
  function filter( array, term ) {
    let matcher = new RegExp( $.ui.autocomplete.escapeRegex(term), "i" );
    return $.grep( array, function(value) {
      return matcher.test( $( "<div>" ).html( value.label || value.value || value ).text() );
    });
  }
  
  $.extend( proto, {
    _initSource: function(){
      if ( this.options.html && $.isArray(this.options.source) ) {
        this.source = function( request, response ) {
          response( filter( this.options.source, request.term ) );
        };
      } else {
        initSource.call( this );
      }
    },
  
    _renderItem: function(ul, item){
      return $("<li></li>")
        .data("item.autocomplete", item)
        .append($( "<a class='text-decoration-none'></a>" )[ this.options.html ? "html" : "text" ](item.label) )
        .appendTo(ul);
    }
  });
  
})( jQuery );
///:: FIN FUNCION PARA UTILIZAR EL LABEL DEL AUTOCOMPLETE COMO HTML :::::::::::::::::::::::///

///:: TERMINO FUNCIONES DESEMPEÑO DE PILOTO :::::::::::::::::::::::::::::::::::::::::::::::///