///::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
///:: TAB CAUSAS Y ACCIONES v 4.0  FECHA: 2023-05-10 ::::::::::::::::::::::::::::::::::::::///
///:: CREAR, EDITAR, ELIMINAR TABLA ope_accidentes_naturaleza :::::::::::::::::::::::::::::///
///::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///

///:: DECLARACION DE VARIABLES ::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///

///:: INICIO DOM JS CAUSAS Y ACCIONES :::::::::::::::::::::::::::::::::::::::::::::::::::::///
$(document).ready(function(){

  ///:: INICIO BOTONES CAUSAS Y ACCIONES ::::::::::::::::::::::::::::::::::::::::::::::::::///
  
  //:: BOTON GRABAR -> REALIZA LA GRABACION EN LA TABLA OPE_AccidentesNaturaleza Tipo CAUSAS DE ACCIDENTES Y ACCIONES TOMADAS :://
  $('#formModalCausasAcciones').submit(function(e){
    e.preventDefault(); //evita el comportambiento normal del submit, es decir, recarga total de la página
    let tValidaCausasAcciones   = "";
    Acci_DescripcionNaturaleza  = $.trim($('#Acci_DescripcionCausasAcciones').val());
    Acci_Nombre                 = "";
    Acci_Dni                    = "";
    Acci_Edad                   = 0;
    Acci_Genero                 = "";
    Acci_Placa                  = "";
    if (tValidaCausasAcciones==""){
      if(opcionCausasAcciones == 1){
        // CREAR Causas de Accidentes
        Acci_TipoNaturaleza = 'CausasAccidentes';
      }else{
        // CREAR Acciones Tomadas
        Acci_TipoNaturaleza = 'AccionesTomadas';
      }
      $("#btnGuardarCausasAcciones").prop("disabled",true); // DESACTIVA el boton guardar para evitar multiples click
      Accion = "CrearAccidentesNaturaleza";
      $.ajax({
        url       : "Ajax.php",
        type      : "POST",
        datatype  : "json",    
        data      : { MoS:MoS,NombreMoS:NombreMoS,Accion:Accion,Accidentes_Id:InformePreliminar_Id,Acci_Tipo:Acci_TipoNaturaleza,Acci_Descripcion:Acci_DescripcionNaturaleza,Acci_Nombre:Acci_Nombre,Acci_Dni:Acci_Dni,Acci_Edad:Acci_Edad,Acci_Genero:Acci_Genero,Acci_Placa:Acci_Placa},    
        success   : function(data) {
          if(opcionCausasAcciones == 1){
            tablaCausasAccidentes.ajax.reload(null, false);
          }else{
            tablaAccionesTomadas.ajax.reload(null, false);
          }
        }
      });
    }
    $('#modalCRUDCausasAcciones').modal('hide');
  });
  //:: FIN BOTON GRABAR -> REALIZA LA GRABACION EN LA TABLA OPE_AccidentesNaturaleza Tipo CAUSAS DE ACCIDENTES Y ACCIONES TOMADAS :://
  
  ///:::::::::::::::::::::::: BOTON AGREGAR CAUSAS ACCIDENTES ::::::::::::::::::::::::::::::::::///
  $("#btnAgregarCausasAccidentes").on("click",function(){
    $("#formModalCausasAcciones").trigger("reset");
    $("#label_DescripcionCausasAcciones").html('Descripción de Causas Posibles (Máx. 250 caract.)');
    opcionCausasAcciones = 1; // CREAR Causas Accidentes
    $("#btnGuardarCausasAcciones").prop("disabled",false); // ACTIVA el boton de guardar

    $(".modal-header").css( "background-color", "#17a2b8");
    $(".modal-header").css( "color", "white" );
    $(".modal-title").text("Alta de Causas");
    $('#modalCRUDCausasAcciones').modal('show');
  });

  ///:: BOTON BORRAR CAUSAS DE ACCIDENTES :::::::::::::::::::::::::::::::::::::::::::::::::///
  $(document).on("click", ".btnBorrarCausasAccidentes", function(){
    filaNaturaleza        = $(this).closest('tr'); 
    OPE_AcciNaturalezaId  = filaNaturaleza.find('td:eq(0)').text();
    Swal.fire({
      title               : '¿Está seguro?',
      text                : "Se eliminará el registro "+OPE_AcciNaturalezaId+" !!!",
      icon                : 'warning',
      showCancelButton    : true,
      confirmButtonColor  : '#3085d6',
      cancelButtonColor   : '#d33',
      confirmButtonText   : 'Si, eliminar!'
    }).then((result) => 
    {
      if (result.isConfirmed){
        Swal.fire(
          'Eliminado!',
          'El registro ha sido elimidado.',
          'success')
        respuesta = 1;
        if (respuesta == 1){
          Acci_TipoNaturaleza = 'CausasAccidentes';            
          Accion='EliminarTablaNaturaleza';
          $.ajax({
            url       : "Ajax.php",
            type      : "POST",
            datatype  : "json",    
            data      : { MoS:MoS,NombreMoS:NombreMoS,Accion:Accion,OPE_AcciNaturalezaId:OPE_AcciNaturalezaId,Accidentes_Id:InformePreliminar_Id,Acci_Tipo:Acci_TipoNaturaleza},   
            success   : function() {
              tablaCausasAccidentes.ajax.reload(null, false);
            }
          });
        }
      }
    });
  });
  ///:: FIN BOTON BORRAR CAUSAS DE ACCIDENTES :::::::::::::::::::::::::::::::::::::::::::::///

  ///:: BOTON AGREGAR ACCIONES TOMADAS ::::::::::::::::::::::::::::::::::::::::::::::::::::///
  $("#btnAgregarAccionesTomadas").on("click",function(){
    $("#formModalCausasAcciones").trigger("reset");
    $("#label_DescripcionCausasAcciones").html('Descripción de Acciones Tomadas (Máx. 250 caract.)');
    opcionCausasAcciones = 2; // CREAR Acciones Tomadas
    $("#btnGuardarCausasAcciones").prop("disabled",false); // ACTIVA el boton de guardar

    $(".modal-header").css( "background-color", "#17a2b8");
    $(".modal-header").css( "color", "white" );
    $(".modal-title").text("Alta de Acciones Tomadas");
    $('#modalCRUDCausasAcciones').modal('show');
  });
  ///:: FIN BOTON AGREGAR ACCIONES TOMADAS ::::::::::::::::::::::::::::::::::::::::::::::::///

  ///:: BOTON BORRAR ACCIONES TOMADAS :::::::::::::::::::::::::::::::::::::::::::::::::::::///
  $(document).on("click", ".btnBorrarAccionesTomadas", function(){
    filaNaturaleza        = $(this).closest('tr'); 
    OPE_AcciNaturalezaId  = filaNaturaleza.find('td:eq(0)').text();
    Swal.fire({
      title: '¿Está seguro?',
      text: "Se eliminará el registro "+OPE_AcciNaturalezaId+" !!!",
      icon: 'warning',
      showCancelButton    : true,
      confirmButtonColor  : '#3085d6',
      cancelButtonColor   : '#d33',
      confirmButtonText   : 'Si, eliminar!'
    }).then((result) => 
    {
      if (result.isConfirmed){
        Swal.fire(
          'Eliminado!',
          'El registro ha sido elimidado.',
          'success')
        respuesta = 1;
        if (respuesta == 1){
          Acci_TipoNaturaleza = 'AccionesTomadas';
          Accion              = 'EliminarTablaNaturaleza';
          $.ajax({
            url       : "Ajax.php",
            type      : "POST",
            datatype  : "json",    
            data      : { MoS:MoS,NombreMoS:NombreMoS,Accion:Accion,OPE_AcciNaturalezaId:OPE_AcciNaturalezaId,Accidentes_Id:InformePreliminar_Id,Acci_Tipo:Acci_TipoNaturaleza},   
            success   : function() {
              tablaAccionesTomadas.ajax.reload(null, false);
            }
          });
        }
      }
    });
  });
  ///:: FIN BOTON BORRAR ACCIONES TOMADAS :::::::::::::::::::::::::::::::::::::::::::::::::///

  ///:: TERMINO BOTONES CAUSAS Y ACCIONES :::::::::::::::::::::::::::::::::::::::::::::::::///
});
///:: TERMINO JS DOM CAUSAS Y ACCIONES ::::::::::::::::::::::::::::::::::::::::::::::::::::///

///:: FUNCIONES DE CAUSAS Y ACCIONES ::::::::::::::::::::::::::::::::::::::::::::::::::::::///

///:: TERMINO FUNCIONES DE CAUSAS Y ACCIONES ::::::::::::::::::::::::::::::::::::::::::::::///