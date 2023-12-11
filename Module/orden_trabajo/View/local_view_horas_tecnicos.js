///:: DECLARACION DE VARIABLES ::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
var array_horas_tecnicos, tabla_horas_tecnicos, opcion_horas_tecnicos, tecnico_nombres, hora_inicio, hora_fin, t_html;

///:: JS DOM HORAS LABORADAS TECNICOS ::::::::::::::::::::::::::::::::::::::::::::::::::::///
$(document).ready(function(){

  ///:: BOTONES HORAS LABORADAS TECNICOS :::::::::::::::::::::::::::::::::::::::::::::::::///
  
  ///:: EVENTO DEL BOTON NUEVA HORA LABORADA TECNICOS ::::::::::::::::::::::::::::::::::::///
  $(document).on("click", ".btn_horas_tecnicos", function(){
    $("#btn_guardar_horas_tecnicos").prop("disabled",false);
    $ot_asociado  = $("#ot_asociado").val();
    t_html        = f_select_combo("manto_resp_asociado","SI","ra_nombres","","`ra_asociado` = '"+ot_asociado+"'", "`ra_nombres` ASC");
    $("#tecnico_nombres").html(t_html);
    opcion_horas_tecnicos = "CREAR"; 
    f_limpia_horas_tecnicos();
    tecnico_nombres = '';
    hora_inicio     = '';
    hora_fin        = '';
    $("#tecnico_nombres").val(tecnico_nombres);
    $("#hora_inicio").val(hora_inicio);
    $("#hora_fin").val(hora_fin);
  
    $("#form_horas_tecnicos").trigger("reset");
    $(".modal-header").css( "background-color", "#17a2b8");
    $(".modal-header").css( "color", "white" );
    $(".modal-title").text( "Horas Laboradas por Técnicos");
    $("#modal_crud_horas_tecnicos").modal("show");	    
  });
  ///:: FIN EVENTO DEL BOTON NUEVA HORA LABORADA TECNICOS :::::::::::::::::::::::::::::::::///

  //:: BOTON GRABAR -> REALIZA LA GRABACION EN ARREGLO HORAS TECNICOS ::::::::::::::::::::///
  $('#form_horas_tecnicos').submit(function(e){
    e.preventDefault();
    let t_valida_horas_tecnicos = "";
    tecnico_nombres = $("#tecnico_nombres").val();
    hora_inicio     = $("#hora_inicio").val();
    hora_fin        = $("#hora_fin").val();
    total_horas     = "";
    t_valida_horas_tecnicos = f_validar_horas_tecnicos(tecnico_nombres, hora_inicio, hora_fin);
    if (t_valida_horas_tecnicos=="invalido"){
      Swal.fire({
        position          : 'center',
        icon              : 'error',
        title             : '*Información con inconsistencias!!!',
        showConfirmButton : false,
        timer             : 1500
      })
    }else{  
      $("#btn_guardar_horas_tecnicos").prop("disabled",true);
      tabla_horas_tecnicos.row.add( {
        "tecnico_nombres"  : tecnico_nombres,
        "hora_inicio"      : hora_inicio,
        "hora_fin"         : hora_fin,
        "total_horas"      : total_horas
      } ).draw();
      f_limpia_horas_tecnicos();
      tecnico_nombres = '';
      hora_inicio     = '';
      hora_fin        = '';
      $("#tecnico_nombres").val(tecnico_nombres);
      $("#hora_inicio").val(hora_inicio);
      $("#hora_fin").val(hora_fin);
      $("#btn_guardar_horas_tecnicos").prop("disabled",false);
      $("#tecnico_nombres").focus().select();      
    }
  });
  //:: FIN BOTON GRABAR -> REALIZA LA GRABACION EN EL ARREGLO HORAS TECNICOS ::::::::::::::///

  ///:: BOTON BORRAR HORAS TECNICOS :::::::::::::::::::::::::::::::::::::::::::::::::::::::///
  $(document).on("click", ".btn_borrar_horas_tecnicos", function(){
    let fila_horas_tecnicos = $(this); 
    tecnico_nombres = fila_horas_tecnicos.closest('tr').find('td:eq(0)').text();
    Swal.fire({
      title: '¿Está seguro?',
      text: "Se eliminará el Técnico "+tecnico_nombres+" !!!",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Si, eliminar!'
    }).then((result) => 
    {
      if (result.isConfirmed){
        tabla_horas_tecnicos
        .row( fila_horas_tecnicos.parents('tr') )
        .remove()
        .draw();
        Swal.fire(
          'Eliminado!',
          'El registro ha sido elimidado.',
          'success')
      }
    });

  });
  ///:: FIN BOTON BORRAR HORAS TECNICOS :::::::::::::::::::::::::::::::::::::::::::::::::::///

  ///:: TERMINO BOTONES HORAS LABORADAS TECNICOS ::::::::::::::::::::::::::::::::::::::::::///

});
///:: TERMINO JS DOM HORAS LABORADAS TECNICOS :::::::::::::::::::::::::::::::::::::::::::::///


///:: FUNCIONES HORAS LABORADAS TECNICOS ::::::::::::::::::::::::::::::::::::::::::::::::::///

///:: FUNCION REESTABLECE COLOR NEUTRAL A CAMPOS AEFCTADOS ::::::::::::::::::::::::::::::::///
function f_limpia_horas_tecnicos(){
  $("#tecnico_nombres").removeClass("color-error");
  $("#hora_inicio").removeClass("color-error");
  $("#hora_fin").removeClass("color-error");
};
///:: FIN FUNCION REESTABLECE COLOR NEUTRAL A CAMPOS AEFCTADOS ::::::::::::::::::::::::::::///

///:: GENERACION DE TABLA DE HORAS LABORADAS TECNICOS :::::::::::::::::::::::::::::::::::::///
function f_tabla_horas_tecnicos(p_cod_ot){
    array_horas_tecnicos = [];
    div_tabla = f_CreacionTabla("tabla_horas_tecnicos","");
    $("#div_tabla_horas_tecnicos").html(div_tabla);
    columnastabla = f_ColumnasTabla("tabla_horas_tecnicos","");
  
    $("#tabla_horas_tecnicos").dataTable().fnDestroy();
    $('#tabla_horas_tecnicos').show();
  
    Accion='cargar_horas_tecnicos';
    $.ajax({
      url       : "Ajax.php",
      type      : "POST",
      datatype  : "json",    
      async     : false,
      data      : { MoS:MoS,NombreMoS:NombreMoS,Accion:Accion, cod_ot:p_cod_ot },    
      success   : function(data) {
        array_horas_tecnicos = $.parseJSON(data);
      }
    });
      
    tabla_horas_tecnicos = $('#tabla_horas_tecnicos').DataTable({
      language      : idiomaEspanol,
      searching     : false,
      info          : false,
      lengthChange  : true,
      pageLength    : 10,
      responsive    : "true",
      data          : array_horas_tecnicos,
      columns       : columnastabla
    });     
  }
  ///:: FIN GENERACION DE TABLA DE HORAS LABORADAS TECNICOS :::::::::::::::::::::::::::::::///

  ///:: GENERACION DE TABLA DE VER HORAS LABORADAS TECNICOS :::::::::::::::::::::::::::::::///
  function f_tabla_ver_horas_tecnicos(p_cod_ot){
    let array_ver_horas_tecnicos = [];
    div_tabla = f_CreacionTabla("tabla_ver_horas_tecnicos","");
    $("#div_tabla_ver_horas_tecnicos").html(div_tabla);
    columnastabla = f_ColumnasTabla("tabla_ver_horas_tecnicos","");
  
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
      language      : idiomaEspanol,
      searching     : false,
      info          : false,
      lengthChange  : false,
      pageLength    : 5,
      responsive    : "true",
      data          : array_ver_horas_tecnicos,
      columns       : columnastabla
    });     
  }
  ///:: FIN GENERACION DE TABLA DE HORAS LABORADAS TECNICOS :::::::::::::::::::::::::::::::///

  ///:: VALIDAR HORAS LABORADAS TECNICOS ::::::::::::::::::::::::::::::::::::::::::::::::::///
  function f_validar_horas_tecnicos(p_tecnico_nombres, p_hora_inicio, p_hora_fin){
    let rpta_validar_horas_tecnico = "";

    if(p_tecnico_nombres==""){
      $("#tecnico_nombres").addClass("color-error");
      rpta_validar_horas_tecnico = "invalido";
    }
    if(p_hora_inicio==""){
      $("#hora_inicio").addClass("color-error");
      rpta_validar_horas_tecnico = "invalido";
    }
    if(p_hora_fin==""){
      $("#hora_fin").addClass("color-error");
      rpta_validar_horas_tecnico = "invalido";
    }

    if(p_hora_inicio!="" && p_hora_fin!=""){
      if(f_MayorFecha(p_hora_inicio,p_hora_fin)=="SI"){
        total_horas = f_calcular_diferencia_horas(p_hora_inicio,p_hora_fin);
      }else{
        $("#hora_inicio").addClass("color-error");
        $("#hora_fin").addClass("color-error");
        rpta_validar_horas_tecnico = "invalido";
      }
    }

    return rpta_validar_horas_tecnico;
  }
  ///:: FIN VALIDAR HORAS LABORADAS TECNICOS ::::::::::::::::::::::::::::::::::::::::::::::///

///:: TERMINO FUNCIONES HORAS LABORADAS TECNICOS ::::::::::::::::::::::::::::::::::::::::::///