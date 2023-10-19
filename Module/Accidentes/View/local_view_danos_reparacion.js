///::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
///:: TAB DAÑOS PARA REPARACION v 3.0  FECHA: 2023-04-30 ::::::::::::::::::::::::::::::::::///
///:: CREAR, EDITAR Y ELIMINAR TABLA OPE_AccidentesReparacion :::::::::::::::::::::::::::::///
///::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///

///:: DECLARACION DE VARIABLES ::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
var tablaDanosReparacion;

///:: INICIO JS DOM DAÑOS PARA REPARACION :::::::::::::::::::::::::::::::::::::::::::::::::///
$(document).ready(function(){

  ///:: INICIO BOTONES DAÑOS PARA REPARACION ::::::::::::::::::::::::::::::::::::::::::::::///

  ///:: BOTON GRABAR -> REALIZA LA GRABACION EN LA TABLA OPE_DanosReparacion ::::::::::::::///
  $('#formModalDanosReparacion').submit(function(e){
    e.preventDefault(); //evita el comportambiento normal del submit, es decir, recarga total de la página
    let tValidaDanosReparacion  = "";
    Acci_CodigoColor            = $.trim($('#Acci_CodigoColor').val());
    Acci_SeccionBus             = $.trim($('#Acci_SeccionBus').val());
    Acci_DescripcionReparacion  = $.trim($('#Acci_DescripcionReparacion').val());
    tValidaDanosReparacion      = f_valida_danos_reparacion(Acci_CodigoColor, Acci_SeccionBus, Acci_DescripcionReparacion);

    if (tValidaDanosReparacion=="invalido"){
      Swal.fire({
        icon: 'error',
        title: 'DAÑOS PARA REPARACION...',
        text: '*Falta completar información!!!'
      })
    }else{
      $("#btnGuardarDanosReparacion").prop("disabled",true); // DESACTIVA el boton guardar para evitar multiples click
      Accion = "CrearAccidentesReparacion";
      $.ajax({
        url       : "Ajax.php",
        type      : "POST",
        datatype  : "json",    
        data      : { MoS:MoS, NombreMoS:NombreMoS, Accion:Accion, Accidentes_Id:InformePreliminar_Id, Acci_CodigoColor:Acci_CodigoColor, Acci_SeccionBus:Acci_SeccionBus, Acci_DescripcionReparacion:Acci_DescripcionReparacion},    
        success   : function(data) {
          tablaDanosReparacion.ajax.reload(null, false);
        }
      });
      $('#modalCRUDDanosReparacion').modal('hide');
    }
  });
  ///:: FIN BOTON GRABAR -> REALIZA LA GRABACION EN LA TABLA OPE_DanosReparacion ::::::::::///

  ///:: BOTON CARGAR IMAGEN -> REALIZA LA GRABACION EN LA TABLA OPE_AccidentesImagenes BUS ::///
  $('#formModalImagenesBus').submit(function(e){
    e.preventDefault(); //evita el comportambiento normal del submit, es decir, recarga total de la página
    let fotoEditar = "";
    f_GrabarImagen(opcionCargaImagenes);
    let archivo = $('#Acci_ImagenBus')[0].files[0];
    let reader  = new FileReader();
    if (archivo) {
      reader.readAsDataURL(archivo );
      reader.onloadend  = function () {
        fotoEditar      ='<img src="' + reader.result + '" class="card-img-top rounded img-fluid img-thumbnail" alt="Responsive image" />';
        $("#div_Bus").html(fotoEditar);
      }
    }
    $('#modalCRUDImagenesBus').modal('hide');
  });
  ///:: FIN BOTON CARGAR IMAGEN -> REALIZA LA GRABACION EN LA TABLA OPE_AccidentesImagenes BUS ::///
 
  ///:: BOTON AGREGAR DAÑOS PARA REPARACION :::::::::::::::::::::::::::::::::::::::::::::::///
  $("#btnAgregarDanosReparacion").on("click",function(){
    $("#formModalDanosReparacion").trigger("reset");
    $("#btnGuardarDanosReparacion").prop("disabled",false); // ACTIVA el boton de guardar

    $(".modal-header").css( "background-color", "#17a2b8");
    $(".modal-header").css( "color", "white" );
    $(".modal-title").text("Alta de Daños para Reparación");
    $('#modalCRUDDanosReparacion').modal('show');
  });
  ///:: FIN BOTON AGREGAR DAÑOS PARA REPARACION :::::::::::::::::::::::::::::::::::::::::::///

  ///:: BOTON BORRAR DAÑOS PARA REPARACION ::::::::::::::::::::::::::::::::::::::::::::::::///
  $(document).on('click', '.btnBorrarDanosReparacion', function(){
    filaReparacion        = $(this).closest('tr'); 
    OPE_AcciReparacionId  = filaReparacion.find('td:eq(0)').text();
    Swal.fire({
      title             : '¿Está seguro?',
      text              : "Se eliminará el registro "+OPE_AcciReparacionId+" !!!",
      icon              : 'warning',
      showCancelButton  : true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor : '#d33',
      confirmButtonText : 'Si, eliminar!'
    }).then((result) => 
    {
      if (result.isConfirmed){   // PROBLEMAS NO ESPERA LA CONFIRMACION Y NO ELIMINA EL REGISTRO
        Swal.fire(
          'Eliminado!',
          'El registro ha sido elimidado.',
          'success')
        respuesta = 1;
        if (respuesta == 1){
          Accion = 'EliminarTablaReparacion';
          $.ajax({
            url       : "Ajax.php",
            type      : "POST",
            datatype  : "json",    
            data: { MoS:MoS, NombreMoS:NombreMoS, Accion:Accion, OPE_AcciReparacionId:OPE_AcciReparacionId, Accidentes_Id:InformePreliminar_Id},   
            success   : function() {
              tablaDanosReparacion.ajax.reload(null, false);
            }
          });
        }
      }
    });
  });
  ///:: FIN BOTON BORRAR DAÑOS PARA REPARACION ::::::::::::::::::::::::::::::::::::::::::::///

  ///:: BOTON CERRAR INFORME PRELIMINAR :::::::::::::::::::::::::::::::::::::::::::::::::::///
  $("#btnCerrarInformePreliminar").on("click",function(){
    let adata = f_BuscarDataBD("OPE_AccidentesInformePreliminar","Accidentes_Id",InformePreliminar_Id);
    $.each(adata, function(idx, obj){
      Acci_HoraFinAtencion = obj.Acci_HoraFinAtencion;
    });
    if(Acci_HoraFinAtencion=="00:00:00"){
      Swal.fire({
        icon: 'error',
        title: 'INFORME PRELIMINAR...',
        text: '*Falta completar Hora Fin de Atención!!!'
      })
    }else{
      Swal.fire({
        title: '¿Está seguro?',
        text: "Se cerrará el registro "+InformePreliminar_Id+" !!!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si, cerrar!'
      }).then((result) => 
      {
        if (result.isConfirmed){
          Swal.fire(
            'Cerrado!',
            'El registro ha sido cerrado.',
            'success')
          respuesta = 1;
          if (respuesta == 1){
            Accion='CerrarInformePreliminar';
            $.ajax({
              url: "Ajax.php",
              type: "POST",
              datatype:"json",    
              data: { MoS:MoS,NombreMoS:NombreMoS,Accion:Accion,Accidentes_Id:InformePreliminar_Id},   
              success: function(data) {
                data = $.parseJSON(data);
                f_CargarVariablesInformePreliminar(data);
                f_CargaVariablesHtmlInformePreliminar();
                // Se oculta boton guardar y se muestra boton editar
                $("#btnCancelarInformePreliminar").hide();
                $("#btnGuardarInformePreliminar").hide();
                $("#btnEditarInformePreliminar").hide();
                $("#btnCerrarInformePreliminar").hide();
                $("#btnAbrirInformePreliminar").show();
                $("#btnAgregarDanosPersonales").hide();
                $("#btnAgregarDanosTerceros").hide();
                $("#btnAgregarCausasAccidentes").hide();
                $("#btnAgregarAccionesTomadas").hide();
                $("#btnAgregarDanosReparacion").hide();
                $(".btn_cargar_imagenes_ip").hide();
                MostrarBorrar = "NO";
                // SE CARGAN LOS DATATABLES
                f_CargarDataTables();
  
                f_EdicionCamposInformePreliminar('disabled', true);
                tablaAccidentes.ajax.reload(toggleZoomScreen(), false);
              }
            });
          }
        }
      });  
    }
  });
  ///:: FIN BOTON CERRAR INFORME PRELIMINAR :::::::::::::::::::::::::::::::::::::::::::::::///

  ///:: BOTON GENERAR PDF INFORME PRELIMINAR ::::::::::::::::::::::::::::::::::::::::::::::///
  $(document).on('click', ".btn_generar_pdf_informe_preliminar", function(){
    let adata = f_BuscarDataBD("OPE_AccidentesInformePreliminar","Accidentes_Id",InformePreliminar_Id);
    $.each(adata, function(idx, obj){
      Acci_HoraFinAtencion = obj.Acci_HoraFinAtencion;
    });
    if(Acci_HoraFinAtencion=="00:00:00"){
      Swal.fire({
        icon: 'error',
        title: 'INFORME PRELIMINAR...',
        text: '*Falta completar Hora Fin de Atención!!!'
      })
    }else{
      Swal.fire({
        title               : '¿Está seguro?',
        text                : "Se generará el PDF IP-"+InformePreliminar_Id+"  !!!",
        icon                : 'warning',
        showCancelButton    : true,
        confirmButtonColor  : '#3085d6',
        cancelButtonColor   : '#d33',
        confirmButtonText   : 'Si, generar!'
      }).then((result) => 
      {
        if (result.isConfirmed){
          respuesta = 1;
          if (respuesta == 1){
            if(InformePreliminar_Id!=""){
              Accion = "guardar_pdf_informe_preliminar";
              $.ajax({
                url       : "Ajax.php",
                type      : "POST",
                datatype  : "json",    
                async     : false,   
                data      : { MoS:MoS,NombreMoS:NombreMoS,Accion:Accion,Accidentes_Id:InformePreliminar_Id },   
                success   : function(data) {
                  data = $.parseJSON(data);
                  $.each(data, function(idx, obj){
                    acci_log_ip = obj.acci_log_ip;
                  });
                  Swal.fire(
                    'Generado!',
                    'El informe ha sido generado en PDF.',
                    'success');
                  $("#btn_generar_pdf_informe_preliminar").hide();
                  $("#btnAbrirInformePreliminar").show();
                  tablaAccidentes.ajax.reload(toggleZoomScreen(),false);
                }
              });	
          
            }else{
              Swal.fire({
                icon  : 'error',
                title : 'ID Informe Preliminar...',
                text  : 'No se ha generado el ID Informe Preliminar!'
              })    
            }
          }
        }
      });  
    }
  });
  ///:: FIN BOTON CERRAR INFORME PRELIMINAR :::::::::::::::::::::::::::::::::::::::::::::::///

  ///:: BOTON ABRIR INFORME PRELIMINAR ::::::::::::::::::::::::::::::::::::::::::::::::::::///
  $("#btnAbrirInformePreliminar").on("click",function(){
    Acci_EstadoInvestigacion = "";
    let adata = f_BuscarDataBD("OPE_AccidentesInvestigacion","Accidentes_Id",InformePreliminar_Id);
    $.each(adata, function(idx, obj){
      Acci_EstadoInvestigacion = obj.Acci_EstadoInvestigacion;
    });
    if(Acci_EstadoInvestigacion=="CERRADO"){
      Swal.fire({
        icon: 'error',
        title: 'INFORME FINAL...',
        text: '*Estado no debe estar Cerrado!!!'
      })
    }else{
      Swal.fire({
        title: '¿Está seguro?',
        text: "Se abrirá el registro "+InformePreliminar_Id+" !!!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si, abrir!'
      }).then((result) => 
      {
        if (result.isConfirmed){
          Swal.fire(
            'Abrir!',
            'El registro ha sido abierto.',
            'success')
          respuesta = 1;
          if (respuesta == 1){
            Accion='AbrirInformePreliminar';
            $.ajax({
              url: "Ajax.php",
              type: "POST",
              datatype:"json",    
              data: { MoS:MoS,NombreMoS:NombreMoS,Accion:Accion,Accidentes_Id:InformePreliminar_Id},   
              success: function(data) {
                data = $.parseJSON(data);
                f_CargarVariablesInformePreliminar(data);
                f_CargaVariablesHtmlInformePreliminar();
                // Se oculta boton guardar y se muestra boton editar
                $("#btnCancelarInformePreliminar").hide();
                $("#btnGuardarInformePreliminar").hide();
                $("#btnEditarInformePreliminar").show()
                $("#btnCerrarInformePreliminar").show();
                $("#btnAbrirInformePreliminar").hide();
                $("#btnAgregarDanosPersonales").show();
                $("#btnAgregarDanosTerceros").show();
                $("#btnAgregarCausasAccidentes").show();
                $("#btnAgregarAccionesTomadas").show();
                $("#btnAgregarDanosReparacion").show();
                $(".btn_cargar_imagenes_ip").show();
                MostrarBorrar = "SI";
                // SE CARGAN LOS DATATABLES
                f_CargarDataTables();
                
                f_EdicionCamposInformePreliminar('disabled', true);
                tablaAccidentes.ajax.reload(toggleZoomScreen(), false);
              }
            });
          }
        }
      });  
    }
  });
  ///:: FIN BOTON ABRIR INFORME PRELIMINAR ::::::::::::::::::::::::::::::::::::::::::::::::///

  ///:: EVENTO DEL BOTON VER LOG SOLICITUDES ::::::::::::::::::::::::::::::::::::::::::::///
  $(document).on("click", ".btn_log_informe_preliminar", function(){
    $("#form_modal_log_ip").trigger("reset");
    $("#div_log_ip").html(acci_log_ip);
    
    $(".modal-header-log").css( "background-color", "#17a2b8");
    $(".modal-header-log").css( "color", "white" );
    $(".modal-title-log").text("Log");
    $('#modal_crud_log_ip').modal('show');
    $('#modal-resizable').resizable();
    $(".modal-dialog").draggable({
      cursor: "move",
      handle: ".dragable_touch",
    });
  });
  ///:: FIN EVENTO DEL BOTON VER LOG SOLICITUDES ::::::::::::::::::::::::::::::::::::::::///

  ///:: TERMINO BOTONES DAÑOS PARA REPARACION :::::::::::::::::::::::::::::::::::::::::::::///
});
///:: TERMINO JS DOM DAÑOS PARA REPARACION ::::::::::::::::::::::::::::::::::::::::::::::::///


///:: FUNCIONES DE DAÑOS PARA REPARACION ::::::::::::::::::::::::::::::::::::::::::::::::::///

///:: FUNCION COLOR DE FILAS PARA LA TABLA DAÑOS PARA REPARACION ::::::::::::::::::::::::::///
function f_ColorFilasDanosReparacion(row,data){
  // Columna TipoTabla
  if(data.Acci_CodigoColor == 'P') {
    $("td:eq(1)",row).css({
      "color":"white", 
      "background-color":"#218838", // verde
    });
  }
  if(data.Acci_CodigoColor == 'R') {
    $("td:eq(1)",row).css({
      //"color":"yellow", // amarillo
      "background-color":"yellow",
    });
  }
  if(data.Acci_CodigoColor == 'G') {
    $("td:eq(1)",row).css({
      //"color":"#ed7d31", // naranja
      "background-color":"#ed7d31", // naranja
    });
  }
  if(data.Acci_CodigoColor == 'Q') {
    $("td:eq(1)",row).css({
      "color":"white", 
      "background-color":"red", // rojo
    });
  }
}
///:: FIN FUNCION COLOR DE FILAS PARA LA TABLA DAÑOS PARA REPARACION ::::::::::::::::::::::///

///:: FUNCION QUE VALIDA LOS CAMPOS INGRESADOS EN EL FORMULARIO :::::::::::::::::::::::::::///
function f_valida_danos_reparacion(p_Acci_CodigoColor, p_Acci_SeccionBus, p_Acci_DescripcionReparacion){
  let rpta_valida_danos_reparacion = "";
  f_limpia_danos_reparacion();
  if(p_Acci_CodigoColor==""){
    $("#Acci_CodigoColor").addClass('color-error');
    rpta_valida_danos_reparacion = "invalido";
  }
  if(p_Acci_SeccionBus==""){
    $("#Acci_SeccionBus").addClass('color-error');
    rpta_valida_danos_reparacion = "invalido";
  }
  if(p_Acci_DescripcionReparacion==""){
    $("#Acci_DescripcionReparacion").addClass('color-error');
    rpta_valida_danos_reparacion = "invalido";
  }
  return rpta_valida_danos_reparacion;
}
///:: FIN FUNCION QUE VALIDA LOS CAMPOS INGRESADOS EN EL FORMULARIO :::::::::::::::::::::::///

///:: FUNCION QUE LIMPIA LOS CAMPOS INGRESADOS EN EL FORMULARIO :::::::::::::::::::::::::::///
function f_limpia_danos_reparacion(){
  $("#Acci_CodigoColor").removeClass('color-error');
  $("#Acci_SeccionBus").removeClass('color-error');
  $("#Acci_DescripcionReparacion").removeClass('color-error');
}
///:: FIN FUNCION QUE LIMPIA LOS CAMPOS INGRESADOS EN EL FORMULARIO :::::::::::::::::::::::///

///:: TERMINO FUNCIONES DE DAÑOS PARA REPARACION ::::::::::::::::::::::::::::::::::::::::::///