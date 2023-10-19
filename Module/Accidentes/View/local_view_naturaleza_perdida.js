///::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
///:: TAB NATURALEZA DE LA PERDIDA v 4.0  FECHA: 2023-04-29 :::::::::::::::::::::::::::::::///
///:: CREAR, EDITAR, ELIMINAR TABLA ope_accidentes_naturaleza :::::::::::::::::::::::::::::///
///::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///

var tablaDanosMateriales, tablaDanosPersonales, tablaDanosTerceros;

///::::::::::::::::::::::::: INICIO DOM INFORME PRELIMINAR ::::::::::::::::::::::::::::::::///
$(document).ready(function(){

  /*tablaDanosPersonales.on('order.dt search.dt', function () {
    let i = 1;

    tablaDanosReparacion.cells(null, 0, { search: 'applied', order: 'applied' }).every(function (cell) {
        this.data(i++);
    });
  }).draw();*/

  ///:: INICIO BOTONES NATURALEZA DE LA PERDIDA :::::::::::::::::::::::::::::::::::::::::::///

  ///:: BOTON GRABAR -> REALIZA LA GRABACION EN LA TABLA OPE_AccidentesNaturaleza Tipo DAÑOS PERSONALES ::///
  $('#formModalDanosPersonales').submit(function(e){
    e.preventDefault(); //evita el comportambiento normal del submit, es decir, recarga total de la página
    let tValidaDanosPersonales  = "";
    Acci_DescripcionNaturaleza  = $.trim($('#Acci_DetalleLesiones').val());
    Acci_TipoNaturaleza         = 'DañosPersonales';
    Acci_Nombre                 = $.trim($('#Acci_NombreLesionado').val());
    Acci_Dni                    = $.trim($('#Acci_DNILesionado').val());
    Acci_Edad                   = $.trim($('#Acci_EdadLesionado').val());
    Acci_Genero                 = $.trim($('#Acci_GeneroLesionado').val());
    acci_origen                 = $.trim($('#acci_origen_lesionado').val());
    Acci_Placa                  = "";
    if(Acci_Edad==""){
      Acci_Edad = "0";
    }
    if (tValidaDanosPersonales==""){
      $("#btnGuardarDanosPersonales").prop("disabled",true); // DESACTIVA el boton guardar para evitar multiples click
      // CREAR Daños Personales
      if (opcionDanosPersonales==1){
        Accion = "CrearAccidentesNaturaleza";
        $.ajax({
          url       : "Ajax.php",
          type      : "POST",
          datatype  : "json",    
          data      : { MoS:MoS, NombreMoS:NombreMoS, Accion:Accion, Accidentes_Id:InformePreliminar_Id, Acci_Tipo:Acci_TipoNaturaleza,Acci_Descripcion:Acci_DescripcionNaturaleza, Acci_Nombre:Acci_Nombre, Acci_Dni:Acci_Dni, Acci_Edad:Acci_Edad, Acci_Genero:Acci_Genero, acci_origen:acci_origen, Acci_Placa:Acci_Placa},    
          success   : function(data) {
            tablaDanosPersonales.ajax.reload(null, false);
          }
        });
      }
      if (opcionDanosPersonales==2){
        Accion = "editar_accidentes_naturaleza";
        $.ajax({
          url       : "Ajax.php",
          type      : "POST",
          datatype  : "json",    
          data      : { MoS:MoS, NombreMoS:NombreMoS, Accion:Accion, Accidentes_Id:InformePreliminar_Id, Acci_Tipo:Acci_TipoNaturaleza,Acci_Descripcion:Acci_DescripcionNaturaleza, Acci_Nombre:Acci_Nombre, Acci_Dni:Acci_Dni, Acci_Edad:Acci_Edad, Acci_Genero:Acci_Genero, acci_origen:acci_origen, Acci_Placa:Acci_Placa, OPE_AcciNaturalezaId:OPE_AcciNaturalezaId},
          success   : function(data) {
            tablaDanosPersonales.ajax.reload(null, false);
          }
        });
      }
    }
    $('#modalCRUDDanosPersonales').modal('hide');
  });
  ///:: FIN BOTON GRABAR -> REALIZA LA GRABACION EN LA TABLA OPE_AccidentesNaturaleza Tipo DAÑOS PERSONALES ::///

  ///:: BOTON GRABAR -> REALIZA LA GRABACION EN LA TABLA OPE_AccidentesNaturaleza Tipo DAÑOS A TERCEROS ::///
  $('#formModalDanosTerceros').submit(function(e){
    e.preventDefault(); //evita el comportambiento normal del submit, es decir, recarga total de la página
    let tValidaDanosTerceros    = "";
    Acci_DescripcionNaturaleza  = $.trim($('#Acci_DetalleDanosTercero').val());
    Acci_TipoNaturaleza         = 'DañosTerceros';
    Acci_Nombre                 = $.trim($('#Acci_NombreTercero').val());
    Acci_Dni                    = $.trim($('#Acci_DNITercero').val());
    Acci_Edad                   = 0;
    Acci_Genero                 = "";
    acci_origen                 = "";
    Acci_Placa                  = $.trim($('#Acci_PlacaTercero').val());
    if (tValidaDanosTerceros==""){
      $("#btnGuardarDanosPersonales").prop("disabled",true); // DESACTIVA el boton guardar para evitar multiples click
      // CREAR Daños Personales
      if (opcionDanosTerceros==1){
        Accion = "CrearAccidentesNaturaleza";
        $.ajax({
          url       : "Ajax.php",
          type      : "POST",
          datatype  : "json",    
          data      :  { MoS:MoS, NombreMoS:NombreMoS, Accion:Accion, Accidentes_Id:InformePreliminar_Id, Acci_Tipo:Acci_TipoNaturaleza,Acci_Descripcion:Acci_DescripcionNaturaleza, Acci_Nombre:Acci_Nombre, Acci_Dni:Acci_Dni, Acci_Edad:Acci_Edad, Acci_Genero:Acci_Genero, acci_origen:acci_origen, Acci_Placa:Acci_Placa},    
          success   : function(data) {
            tablaDanosTerceros.ajax.reload(null, false);
          }
        });
      }
      if (opcionDanosTerceros==2){
        Accion = "editar_accidentes_naturaleza";
        $.ajax({
          url       : "Ajax.php",
          type      : "POST",
          datatype  : "json",    
          data      :  { MoS:MoS, NombreMoS:NombreMoS, Accion:Accion, Accidentes_Id:InformePreliminar_Id, Acci_Tipo:Acci_TipoNaturaleza,Acci_Descripcion:Acci_DescripcionNaturaleza, Acci_Nombre:Acci_Nombre, Acci_Dni:Acci_Dni, Acci_Edad:Acci_Edad, Acci_Genero:Acci_Genero, acci_origen:acci_origen,Acci_Placa:Acci_Placa, OPE_AcciNaturalezaId},
          success   : function(data) {
            tablaDanosTerceros.ajax.reload(null, false);
          }
        });
      }
    }
    $('#modalCRUDDanosTerceros').modal('hide');
  });

  ///:: BOTON AGREGAR DAÑOS PERSONALES ::::::::::::::::::::::::::::::::::::::::::::::::::::///
  $("#btnAgregarDanosPersonales").on("click",function(){
    $("#formModalDanosPersonales").trigger("reset");
    opcionDanosPersonales = 1; // CREAR Daños Personales
    $("#btnGuardarDanosPersonales").prop("disabled",false); // ACTIVA el boton de guardar 

    Tipo                  = 'GENERO';
    Operacion             = 'INFORME PRELIMINAR';
    selectHtmlAccidentes  = "";
    selectHtmlAccidentes  = f_TipoTabla(Operacion,Tipo);
    $("#Acci_GeneroLesionado").html(selectHtmlAccidentes);

    Tipo                  = 'ORIGEN';
    selectHtmlAccidentes  = "";
    selectHtmlAccidentes  = f_TipoTabla(Operacion,Tipo);
    $("#acci_origen_lesionado").html(selectHtmlAccidentes);

    $(".modal-header").css( "background-color", "#17a2b8");
    $(".modal-header").css( "color", "white" );
    $(".modal-title").text("Alta de Daños Personales");
    $('#modalCRUDDanosPersonales').modal('show');
  });
  ///:: BOTON AGREGAR DAÑOS PERSONALES ::::::::::::::::::::::::::::::::::::::::::::::::::::///

  ///:: BOTON EDITAR DAÑOS PERSONALES :::::::::::::::::::::::::::::::::::::::::::::::::::::///
  $(document).on("click", ".btn_editar_danos_personales", function(){
    $("#formModalDanosPersonales").trigger("reset");
    opcionDanosPersonales = 2; // EDITAR Daños Personales
    $("#btnGuardarDanosPersonales").prop("disabled",false); // ACTIVA el boton de guardar 

    Tipo                  = 'GENERO';
    Operacion             = 'INFORME PRELIMINAR';
    selectHtmlAccidentes  = "";
    selectHtmlAccidentes  = f_TipoTabla(Operacion,Tipo);
    $("#Acci_GeneroLesionado").html(selectHtmlAccidentes);

    Tipo                  = 'ORIGEN';
    selectHtmlAccidentes  = "";
    selectHtmlAccidentes  = f_TipoTabla(Operacion,Tipo);
    $("#acci_origen_lesionado").html(selectHtmlAccidentes);

    filaNaturaleza              = $(this).closest('tr'); 
    OPE_AcciNaturalezaId        = filaNaturaleza.find('td:eq(0)').text();
    Acci_Nombre                 = filaNaturaleza.find('td:eq(1)').text();
    Acci_Dni                    = filaNaturaleza.find('td:eq(2)').text();
    Acci_Edad                   = filaNaturaleza.find('td:eq(3)').text();
    Acci_Genero                 = filaNaturaleza.find('td:eq(4)').text();
    acci_origen                 = filaNaturaleza.find('td:eq(5)').text();
    Acci_DescripcionNaturaleza  = filaNaturaleza.find('td:eq(6)').text();

    $('#Acci_NombreLesionado').val(Acci_Nombre);
    $('#Acci_DNILesionado').val(Acci_Dni);
    $('#Acci_EdadLesionado').val(Acci_Edad);
    $('#Acci_GeneroLesionado').val(Acci_Genero);
    $('#acci_origen_lesionado').val(acci_origen);
    $('#Acci_DetalleLesiones').val(Acci_DescripcionNaturaleza);

    $(".modal-header").css( "background-color", "#17a2b8");
    $(".modal-header").css( "color", "white" );
    $(".modal-title").text("Editar de Daños Personales");
    $('#modalCRUDDanosPersonales').modal('show');

  });
  ///:: FIN BOTON EDITAR DAÑOS PERSONALES :::::::::::::::::::::::::::::::::::::::::::::::::///

  ///:: BOTON BORRAR DAÑOS PERSONALES :::::::::::::::::::::::::::::::::::::::::::::::::::::///
  $(document).on("click", ".btnBorrarDanosPersonales", function(){
    filaNaturaleza = $(this).closest('tr'); 
    OPE_AcciNaturalezaId = filaNaturaleza.find('td:eq(0)').text();
    Swal.fire({
      title: '¿Está seguro?',
      text: "Se eliminará el registro "+OPE_AcciNaturalezaId+" !!!",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Si, eliminar!'
    }).then((result) => 
    {
      if (result.isConfirmed){
        Swal.fire(
          'Eliminado!',
          'El registro ha sido elimidado.',
          'success')
        respuesta = 1;
        if (respuesta == 1){
          Acci_TipoNaturaleza = 'DañosPersonales';            
          Accion='EliminarTablaNaturaleza';
          $.ajax({
            url: "Ajax.php",
            type: "POST",
            datatype:"json",    
            data: { MoS:MoS,NombreMoS:NombreMoS,Accion:Accion,OPE_AcciNaturalezaId:OPE_AcciNaturalezaId,Accidentes_Id:InformePreliminar_Id,Acci_Tipo:Acci_TipoNaturaleza},   
            success: function() {
              tablaDanosPersonales.ajax.reload(null, false);
            }
          });
        }
      }
    });
  });
  ///:: FIN BOTON BORRAR DAÑOS PERSONALES :::::::::::::::::::::::::::::::::::::::::::::::::///
  
  ///:: BOTON AGREGAR DAÑOS A TERCEROS ::::::::::::::::::::::::::::::::::::::::::::::::::::///
  $("#btnAgregarDanosTerceros").on("click",function(){
    $("#formModalDanosTerceros").trigger("reset");
    opcionDanosTerceros = 1; // CREAR Daños a Terceros
    $("#btnGuardarDanosTerceros").prop("disabled",false); // ACTIVA el boton de guardar

    $(".modal-header").css( "background-color", "#17a2b8");
    $(".modal-header").css( "color", "white" );
    $(".modal-title").text("Alta de Daños a Terceros");
    $('#modalCRUDDanosTerceros').modal('show');
  });
  ///:: FIN BOTON AGREGAR DAÑOS A TERCEROS ::::::::::::::::::::::::::::::::::::::::::::::::///

  ///:: BOTON EDITAR DAÑOS A TERCEROS :::::::::::::::::::::::::::::::::::::::::::::::::::::///
  $(document).on("click", ".btn_editar_danos_terceros", function(){
    $("#formModalDanosTerceros").trigger("reset");
    opcionDanosTerceros = 2; // EDITAR Daños a Terceros
    $("#btnGuardarDanosTerceros").prop("disabled",false); // ACTIVA el boton de guardar

    filaNaturaleza              = $(this).closest('tr'); 
    OPE_AcciNaturalezaId        = filaNaturaleza.find('td:eq(0)').text();
    Acci_Nombre                 = filaNaturaleza.find('td:eq(1)').text();
    Acci_Dni                    = filaNaturaleza.find('td:eq(2)').text();
    Acci_Placa                  = filaNaturaleza.find('td:eq(3)').text();
    Acci_DescripcionNaturaleza  = filaNaturaleza.find('td:eq(4)').text();

    $('#Acci_DetalleDanosTercero').val(Acci_DescripcionNaturaleza);
    $('#Acci_NombreTercero').val(Acci_Nombre);
    $('#Acci_DNITercero').val(Acci_Dni);
    $('#Acci_PlacaTercero').val(Acci_Placa);

    $(".modal-header").css( "background-color", "#17a2b8");
    $(".modal-header").css( "color", "white" );
    $(".modal-title").text("Editar de Daños a Terceros");
    $('#modalCRUDDanosTerceros').modal('show');
  });
  ///:: FIN BOTON BORRAR DAÑOS A TERCEROS :::::::::::::::::::::::::::::::::::::::::::::::::///

  ///:: BOTON BORRAR DAÑOS A TERCEROS :::::::::::::::::::::::::::::::::::::::::::::::::::::///
  $(document).on("click", ".btnBorrarDanosTerceros", function(){
    filaNaturaleza = $(this).closest('tr'); 
    OPE_AcciNaturalezaId = filaNaturaleza.find('td:eq(0)').text();
    Swal.fire({
      title: '¿Está seguro?',
      text: "Se eliminará el registro "+OPE_AcciNaturalezaId+" !!!",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
    confirmButtonText: 'Si, eliminar!'
    }).then((result) => 
    {
      if (result.isConfirmed){
        Swal.fire(
          'Eliminado!',
          'El registro ha sido elimidado.',
          'success')
        respuesta = 1;
        if (respuesta == 1){
          Acci_TipoNaturaleza = 'DañosTerceros';            
          Accion='EliminarTablaNaturaleza';
          $.ajax({
            url: "Ajax.php",
            type: "POST",
            datatype:"json",    
            data: { MoS:MoS,NombreMoS:NombreMoS,Accion:Accion,OPE_AcciNaturalezaId:OPE_AcciNaturalezaId,Accidentes_Id:InformePreliminar_Id,Acci_Tipo:Acci_TipoNaturaleza},   
            success: function() {
              tablaDanosTerceros.ajax.reload(null, false);
            }
          });
        }
      }
    });
  });
  ///:: FIN BOTON BORRAR DAÑOS A TERCEROS :::::::::::::::::::::::::::::::::::::::::::::::::///

  ///:: TERMINO INICIO BOTONES NATURALEZA DE LA PERDIDA :::::::::::::::::::::::::::::::::::///
});
///:: TERMINO JS DOM NATURALEZA DE LA PERDIDA :::::::::::::::::::::::::::::::::::::::::::::///


///:: FUNCIONES DE NATURALEZA DE LA PERDIDA :::::::::::::::::::::::::::::::::::::::::::::::///

///:: TERMINO FUNCIONES DE NATURALEZA DE LA PERDIDA :::::::::::::::::::::::::::::::::::::::///
