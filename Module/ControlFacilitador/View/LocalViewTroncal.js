///::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
///::::::::::::::::::: TAB TRONCAL v 5.0 FECHA: 22-07-2022 ::::::::::::::::::::::::::::::::///
///::::::::: CREAR EVENTOS, EDITAR CONTROL FACILITADOR TRONCAL ::::::::::::::::::::::::::::///
///::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///

///::::::::::::::::::::::::::::::: Declaracion de Variables :::::::::::::::::::::::::::::::///
var adata = [];
var fila,ControlFacilitador_Id,index,nOpcionGrabarTroncal,selectHtml,ViajesCanceladosTroncal;
var Prog_OperacionTroncal,Prog_Operacion,CFaRg_Estado;
var NovedadTroncal_Id, bValidarNovedadTroncal, btnOpcionNovedadTroncal, selectNovedadIdTroncal;
var Prog_NombreColaborador,Prog_Tabla,Prog_HoraOrigen,Prog_HoraDestino,Prog_Servicio,Prog_ServBus,Prog_Bus,Prog_LugarOrigen,Prog_LugarDestino,Prog_TipoEvento,Prog_KmXPuntos,Prog_Sentido,Prog_BusManto,Prog_Fecha, Prog_IdManto, Prog_Observaciones, Nove_NovedadTroncal,Nove_TipoNovedadTroncal,Nove_DetalleNovedadTroncal,Nove_DescripcionNovedadTroncal,Nove_LugarExactoTroncal,Nove_HoraInicioTroncal,Nove_HoraFinTroncal,Nove_TipoOrigenTroncal;
var HoraOrigen, MinutoOrigen, HoraDestino, MinutoDestino, HoraInicioTroncal, MinutoInicioTroncal, Prog_IdManto1, Prog_BusTroncal2;

//Inicializar Variables
Prog_OperacionTroncal = "TRONCAL";
Nove_TipoOrigenTroncal = "";
ViajesCanceladosTroncal = "SI";

///::::::::::::::::::::::::: DOM TRONCAL :::::::::::::::::::::::::::::::::::::::::::::::::///

$(document).ready(function()
{
  Prog_Operacion = Prog_OperacionTroncal;
  xtm = '0'+(fecha_hoy.getMonth()+1);
  xtd = '0'+fecha_hoy.getDate();
  Prog_Fecha = fecha_hoy.getFullYear()+'-'+xtm.substr(-2)+'-'+xtd.substr(-2);
  $("#Prog_Fecha").val(Prog_Fecha);

  ///:: CARGAMOS LOS BUSES
  $( function() {
    t_autocompletar = f_auto_completar("Buses","Bus_NroExterno");
    $( "#bus_troncal" ).autocomplete({
      minLength : 1,
      source: t_autocompletar,
      html: true,
      _renderMenu: function( ul, items ) {
        var that = this;
        $.each( items, function( index, item ) {
          that._renderItemData( ul, item );
        });
        $( ul ).find( "li" ).odd().addClass( "odd" );
      }
    });
  } );

  // Se carga el boton de generar un nuevo registro
  div_boton = f_BotonesFormulario("formSeleccionTroncal","navbarNavDropdownTroncal");
  $("#div_navbarNavDropdownTroncal").html(div_boton);

  div_tablas = f_CreacionTabla("tablaControlFacilitador","");
  $('#div_tablaControlFacilitador').html(div_tablas);

  // Setup - add a text input to each footer cell
  $('#tablaControlFacilitador thead tr')
    .clone(true)
    .addClass('filters')
    .appendTo('#tablaControlFacilitador thead');

  //Selecciona las filas a editar
  $('#tablaControlFacilitador tbody').on( 'click', 'tr', function () {
    $(this).toggleClass('selected');
    // Cero filas seleccionadas
    if(tablaControlFacilitador.rows('.selected').data().length===0){
        adata = [];
    }
   
    // Una fila seleccionada
    if(tablaControlFacilitador.rows('.selected').data().length===1){
      adata = [];
      fila = $(this).closest("tr");	        
      ControlFacilitador_Id = fila.find('td:eq(0)').text();
      index = $.inArray(ControlFacilitador_Id, adata);
      if ( index === -1 ) {
          adata.push( ControlFacilitador_Id );
      } else {
          adata.splice( index, 1 );
      }
    }

    // Mas de una fila seleccionada
    if(tablaControlFacilitador.rows('.selected').data().length>1){
      // Se valida si se presiona la tecla control
      if (isKeyPressed(event)){

      }else{
        adata = [];
      }
      fila = $(this).closest("tr");	        
      ControlFacilitador_Id = fila.find('td:eq(0)').text();
      index = $.inArray(ControlFacilitador_Id, adata);
      if ( index === -1 ) {
        adata.push( ControlFacilitador_Id );
      } else {
        adata.splice( index, 1 );
      }
    }

    // Si no hay filas seleccionadas se oculta el boton editar
    if (adata.length > 0) {
      if (CFaRg_Estado=="GENERADO"){
        bValidarNovedadTroncal = ValidarNovedadTroncal(Prog_Fecha,Prog_Operacion);
        $('#btnEditarTroncal').hide();
        $('#btnAgregarNovedadTroncal').hide();  
        $('#btn_logueo_troncal').hide();
        $('#btnAgregarPuntoFijoTroncal').hide();
        if(bValidarNovedadTroncal=="SI NOVEDADES"){
          $('#btnEditarTroncal').show();
          $('#btnEditarTotalTroncal').show();
        }
        if(adata.length == 1){
          $('#btnAgregarNovedadTroncal').show();
          $('#btn_logueo_troncal').show();
          $('#btnAgregarPuntoFijoTroncal').show();
        }
      }
    }else{$
      $('#btnAgregarNovedadTroncal').hide();
      $('#btn_logueo_troncal').hide();
      $('#btnAgregarPuntoFijoTroncal').hide();
      $('#btnEditarTroncal').hide();
      if(bValidarNovedadTroncal=="SI NOVEDADES"){
        $('#btnEditarTotalTroncal').show();
      }
    }
  });

  // Oculta botones nuevo, editar y datatable
  $('#btnViajeTroncal').hide();
  $('#btnEditarTotalTroncal').hide();
  $('#btnAgregarNovedadTroncal').hide();
  $('#btn_logueo_troncal').hide();
  $('#btnEditarTroncal').hide();
  $('#btnAgregarPuntoFijoTroncal').hide();
  $('#btnInconsistenciasTroncal').hide();
  $('#btnResumenTroncal').hide();
  $('#tablaControlFacilitador').hide();  

  // Si hay cambios en el Fecha se ocultan botones y datatable
  $("#Prog_Fecha").on('change', function () {
    $('#btnViajeTroncal').hide(); // desahabilita boton nuevo
    $('#btnEditarTotalTroncal').hide();
    $('#btnAgregarNovedadTroncal').hide();
    $('#btn_logueo_troncal').hide();
    $('#btnEditarTroncal').hide();
    $('#btnAgregarPuntoFijoTroncal').hide();
    $('#btnInconsistenciasTroncal').hide();
    $('#btnResumenTroncal').hide();
    $("#tablaControlFacilitador").dataTable().fnDestroy();
    $('#tablaControlFacilitador').hide();  
  });

  // Si hay cambios en el select de Novedades
  $("#selectNovedadIdTroncal").on('change', function () {
    selectNovedadIdTroncal = $(this).val();
    Accion='ListarNovedad';
    $.ajax({
      url: "Ajax.php",
      type: "POST",
      datatype:"json",    
      data: {MoS:MoS,NombreMoS:NombreMoS,Accion:Accion,OPE_NovedadId:selectNovedadIdTroncal},
      success: function(data){
        data = $.parseJSON(data);
        $.each(data, function(idx, obj){ 
          $("#t_NovedadIdTroncal").val(obj.Novedad_Id);
          $("#t_NovedadTroncal").val(obj.Nove_Novedad);
          $("#t_TipoNovedadTroncal").val(obj.Nove_TipoNovedad);
          $("#t_DetalleNovedadTroncal").val(obj.Nove_DetalleNovedad);          
          $("#t_DescripcionNovedadTroncal").val(obj.Nove_Descripcion);
        });
      }
    });
  });
  
  // Si hay cambios en la NOVEDAD
  $("#Nove_NovedadTroncal").on('change', function () {
    Tipo=$("#Nove_NovedadTroncal").val();
    selectHtml="";
    selectHtml = f_TipoTabla(Prog_Operacion,Tipo)
    $("#Nove_TipoNovedadTroncal").html(selectHtml);
    thtml = '<option value="">Seleccione una opcion</option>';
    $("#Nove_DetalleNovedadTroncal").html(thtml);
  });
 
  // Si hay cambios en Tipo de Novedad
  $("#Nove_TipoNovedadTroncal").on('change', function () {
    Tipo=$("#Nove_TipoNovedadTroncal").val();
    selectHtml="";
    selectHtml = f_TipoTabla(Prog_Operacion,Tipo)
    $("#Nove_DetalleNovedadTroncal").html(selectHtml);
  });

  // Si hay cambios en Detalle de Novedad
  $("#Nove_DetalleNovedadTroncal").on('change', function () {
    Accion='BuscarDescripcionNovedad';
    Tipo=$("#Nove_DetalleNovedadTroncal").val();
    $.ajax({
      url: "Ajax.php",
      type: "POST",
      datatype:"json",    
      data: {MoS:MoS,NombreMoS:NombreMoS,Accion:Accion,Prog_Operacion:Prog_Operacion,Tipo:Tipo},    
      success: function(data){
        $("#Nove_DescripcionNovedadTroncal").val(data);
      }
    });
  });

  // Calculo de Km Recorridos
  $("#Prog_Sentido").on('change', function () {
    Prog_KmXPuntos = f_KmRecorridos( Prog_OperacionTroncal, $("#Prog_Sentido").val(), $("#Prog_Servicio").val(), $("#Prog_LugarOrigen").val(), $("#Prog_LugarDestino").val() );
    $("#Prog_KmXPuntos").val(Prog_KmXPuntos);
  });

  $("#Prog_Servicio").on('change', function () {
    Prog_KmXPuntos = f_KmRecorridos( Prog_OperacionTroncal, $("#Prog_Sentido").val(), $("#Prog_Servicio").val(), $("#Prog_LugarOrigen").val(), $("#Prog_LugarDestino").val() );
    $("#Prog_KmXPuntos").val(Prog_KmXPuntos);
  });

  $("#Prog_LugarOrigen").on('change', function () {
    Prog_KmXPuntos = f_KmRecorridos( Prog_OperacionTroncal, $("#Prog_Sentido").val(), $("#Prog_Servicio").val(), $("#Prog_LugarOrigen").val(), $("#Prog_LugarDestino").val() );
    $("#Prog_KmXPuntos").val(Prog_KmXPuntos);
  });

  $("#Prog_LugarDestino").on('change', function () {
    Prog_KmXPuntos = f_KmRecorridos( Prog_OperacionTroncal, $("#Prog_Sentido").val(), $("#Prog_Servicio").val(), $("#Prog_LugarOrigen").val(), $("#Prog_LugarDestino").val() );
    $("#Prog_KmXPuntos").val(Prog_KmXPuntos);
  });

  // Si hay cambios en Viajes Cancelados
  $("#ViajesCanceladosTroncal").on('change', function () {
    ViajesCanceladosTroncal = document.getElementById("ViajesCanceladosTroncal");
    $('#btnViajeTroncal').hide(); // desahabilita boton nuevo
    $('#btnEditarTotalTroncal').hide();
    $('#btnAgregarNovedadTroncal').hide();
    $('#btn_logueo_troncal').hide();
    $('#btnEditarTroncal').hide();
    $('#btnAgregarPuntoFijoTroncal').hide();
    $('#btnInconsistenciasTroncal').hide();
    $('#btnResumenTroncal').hide();
    $("#tablaControlFacilitador").dataTable().fnDestroy();
    $('#tablaControlFacilitador').hide();  

    if (ViajesCanceladosTroncal.checked == true){
      ViajesCanceladosTroncal = "SI";
    }else{
      ViajesCanceladosTroncal = "NO";
    }
  });

  // Si hay cambios en Id de bus
  $("#Prog_IdManto").on('change', function () {
    Prog_IdManto = $("#Prog_IdManto").val();
    Accion='BuscarServBus';
    $.ajax({
      url: "Ajax.php",
      type: "POST",
      datatype:"json",    
      async: false,
      data: {MoS:MoS,NombreMoS:NombreMoS,Accion:Accion,Prog_Operacion:Prog_Operacion,Prog_Fecha:Prog_Fecha,Prog_IdManto:Prog_IdManto},    
      success: function(data){
        Prog_ServBus=data;
      }
    });
    $("#Prog_ServBus").val(Prog_ServBus);
  });

  /// ::::::::::::::: CREA Y EDITA FILAS DEL CONTROL FACILITADOR TRONCAL  :::::::::::::///
  $('#formControlFacilitador').submit(function(e){
    e.preventDefault(); //evita el comportambiento normal del submit, es decir, recarga total de la página
    let vacioTroncal                = false;
    let tValidaNuevaNovedadTroncal  = "";
    let tValidaPuntoFijoTroncal     = "";
    let tValidaTroncal              = "";
    let tValidaEditarTotalTroncal   = "";
    let tValidaBusPiloto            = "";
    let hora, minuto;

    Prog_NombreColaborador          = $.trim($('#Prog_NombreColaborador').val());
    Prog_Tabla                      = $.trim($('#Prog_Tabla').val());
    Prog_Servicio                   = $.trim($('#Prog_Servicio').val());
    Prog_ServBus                    = $.trim($('#Prog_ServBus').val());
    Prog_Bus                        = $.trim($('#Prog_Bus').val());
    Prog_LugarOrigen                = $.trim($('#Prog_LugarOrigen').val());
    Prog_LugarDestino               = $.trim($('#Prog_LugarDestino').val());
    Prog_TipoEvento                 = $.trim($('#Prog_TipoEvento').val());
    Prog_KmXPuntos                  = $.trim($('#Prog_KmXPuntos').val());
    Prog_Sentido                    = $.trim($('#Prog_Sentido').val());
    Prog_BusManto                   = $.trim($('#Prog_BusManto').val());
    Prog_Fecha                      = $("#Prog_Fecha").val();
    Prog_Operacion                  = Prog_OperacionTroncal;
    Nove_NovedadTroncal             = $.trim($('#Nove_NovedadTroncal').val());
    Nove_TipoNovedadTroncal         = $.trim($('#Nove_TipoNovedadTroncal').val());
    Nove_DetalleNovedadTroncal      = $.trim($('#Nove_DetalleNovedadTroncal').val());
    Nove_DescripcionNovedadTroncal  = $.trim($('#Nove_DescripcionNovedadTroncal').val());
    Nove_LugarExactoTroncal         = $.trim($('#Nove_LugarExactoTroncal').val());
    Prog_IdManto1                   = $.trim($('#Prog_IdManto1').val());
    Prog_BusTroncal2                = $.trim($('#Prog_BusTroncal2').val());
    Prog_IdManto                    = $.trim($('#Prog_IdManto').val());
    Prog_Observaciones              = $.trim($('#Prog_Observaciones').val());
    Prog_HoraOrigen                 = "";
    Prog_HoraDestino                = "";

    hora = $.trim($('#HoraOrigen').val());
    minuto = $.trim($('#MinutoOrigen').val());
    if(hora !="" && minuto!=""){
      Prog_HoraOrigen = hora + ":" + minuto;
    }
    hora = $.trim($('#HoraDestino').val());
    minuto = $.trim($('#MinutoDestino').val());
    if(hora !="" && minuto!=""){
      Prog_HoraDestino = hora + ":" + minuto;
    }

    Nove_HoraInicioTroncal          = "";
    Nove_HoraFinTroncal             = "";
    
    hora = $.trim($('#HoraInicioTroncal').val());
    minuto = $.trim($('#MinutoInicioTroncal').val());
    if(hora !="" && minuto!=""){
      Nove_HoraInicioTroncal = hora + ":" + minuto;
    }
    hora = $.trim($('#HoraFinTroncal').val());
    minuto = $.trim($('#MinutoFinTroncal').val());
    if(hora !="" && minuto!=""){
      Nove_HoraFinTroncal = hora + ":" + minuto;
    }
    
    LimpiaMsControlFacilitadorTroncal();    

    // CREAR
    if(nOpcionGrabarTroncal == 1){
      tValidaNuevaNovedadTroncal = f_ValidarNuevaNovedadTroncal(Nove_NovedadTroncal,Nove_TipoNovedadTroncal,Nove_DetalleNovedadTroncal,Nove_DescripcionNovedadTroncal,Nove_LugarExactoTroncal,Nove_HoraInicioTroncal,Nove_HoraFinTroncal);
      tValidaTroncal = f_ValidarTroncal(Prog_NombreColaborador,Prog_Bus,Prog_TipoEvento,Prog_HoraOrigen,Prog_HoraDestino,Prog_LugarOrigen,Prog_LugarDestino,Prog_ServBus,Prog_Servicio,Prog_Sentido,Prog_KmXPuntos, Prog_Tabla, Prog_BusManto, Prog_IdManto, Prog_Observaciones);
      if(tValidaTroncal=="invalido"){
        vacioTroncal = true;
        Swal.fire({
          icon: 'error',
          title: 'INFORMACION TRONCAL...',
          text: '*Falta completar información!'
        })
      }
      if(btnOpcionNovedadTroncal==""){
        vacioTroncal = true;
        Swal.fire({
          icon: 'error',
          title: 'NOVEDADES...',
          text: '*Debe seleccionar el tipo de Novedad!'
        })
      }
      if(tValidaNuevaNovedadTroncal=="invalido" && btnOpcionNovedadTroncal=="NuevaNovedad"){
        vacioTroncal = true;
        Swal.fire({
          icon: 'error',
          title: 'NOVEDADES...',
          text: '*NO se han generado novedades!'
        });
      }
      if(selectNovedadIdTroncal=="" && btnOpcionNovedadTroncal=="AsociarNovedad"){
        vacioTroncal = true;
        Swal.fire({
          icon: 'error',
          title: 'NOVEDADES...',
          text: '*NO se ha asociado a una novedad!'
        });
      }
      if(Prog_Bus==""){
        Swal.fire({
          title: '¿BUS?',
          text: "Se grabara el registro con BUS vacio !!!",
          icon: 'warning',
        });
      }
  
      if(Prog_NombreColaborador==""){
        Swal.fire({
          title: '¿PILOTO?',
          text: "Se grabara el registro con PILOTO vacio !!!",
          icon: 'warning',
        });
      }
  
    }

    // AGREGAR NOVEDAD
    if(nOpcionGrabarTroncal == 2){
      tValidaNuevaNovedadTroncal = f_ValidarNuevaNovedadTroncal(Nove_NovedadTroncal,Nove_TipoNovedadTroncal,Nove_DetalleNovedadTroncal,Nove_DescripcionNovedadTroncal,Nove_LugarExactoTroncal,Nove_HoraInicioTroncal,Nove_HoraFinTroncal);
      if(tValidaNuevaNovedadTroncal=="invalido") {
        vacioTroncal = true;
        Swal.fire({
          icon: 'error',
          title: 'NOVEDADES...',
          text: '*NO se han generado novedades!'
        });
      }
    }

    // EDITAR
    if(nOpcionGrabarTroncal == 3) {
      tValidaTroncal = f_ValidarTroncal(Prog_NombreColaborador,Prog_Bus,Prog_TipoEvento,Prog_HoraOrigen,Prog_HoraDestino,Prog_LugarOrigen,Prog_LugarDestino,Prog_ServBus,Prog_Servicio,Prog_Sentido,Prog_KmXPuntos,Prog_Tabla,Prog_BusManto, Prog_IdManto, Prog_Observaciones);

      if(tValidaTroncal=="invalido" && adata.length == 1){
        vacioTroncal = true;
        Swal.fire({
          icon: 'error',
          title: 'INFORMACION TRONCAL...',
          text: '*Falta completar información!'
        })
      }
      if(adata.length > 1 && Prog_NombreColaborador=="" && Prog_Bus=="" && Prog_TipoEvento==""){
        vacioTroncal = true;
        Swal.fire({
          icon: 'error',
          title: 'INFORMACION TRONCAL...',
          text: '*Falta completar información!'
        })
      }
      if(selectNovedadIdTroncal==""){
        vacioTroncal = true;
        Swal.fire({
          icon: 'error',
          title: 'NOVEDADES...',
          text: '*NO se ha asociado a una novedad!'
        });
      }
      if(vacioTroncal == false && tValidaTroncal == ""){
        tValidaBusPiloto = f_InconsistenciasBusPiloto(Prog_Fecha,Prog_Operacion,Prog_Bus,Prog_NombreColaborador,adata,Prog_HoraOrigen,Prog_HoraDestino);
        if(tValidaBusPiloto!=""){
          Swal.fire({
            title: '¿Inconsistencias?',
            text: "Se grabara el registro con Inconsistencias en "+tValidaBusPiloto+" !!!",
            icon: 'warning',
          });
        }
      }
      if(Prog_Bus==""){
        Swal.fire({
          title: '¿BUS?',
          text: "Se grabara el registro con BUS vacio !!!",
          icon: 'warning',
        });
      }
  
      if(Prog_NombreColaborador==""){
        Swal.fire({
          title: '¿PILOTO?',
          text: "Se grabara el registro con PILOTO vacio !!!",
          icon: 'warning',
        });
      }  
    }

    // AGREGAR PUNTO FIJO
    if(nOpcionGrabarTroncal == 4) {
      tValidaPuntoFijoTroncal = f_ValidarNuevaNovedadTroncal(Nove_NovedadTroncal,Nove_TipoNovedadTroncal,Nove_DetalleNovedadTroncal,Nove_DescripcionNovedadTroncal,Nove_LugarExactoTroncal,Nove_HoraInicioTroncal,Nove_HoraFinTroncal);
      if(tValidaPuntoFijoTroncal=="invalido") {
        vacioTroncal = true;
        Swal.fire({
          icon: 'error',
          title: 'NOVEDADES...',
          text: '*NO se han generado novedades!'
        });
      }
    }

    // CAMBIO TOTAL DE BUS O PILOTO
    if(nOpcionGrabarTroncal == 5) {
      tValidaEditarTotalTroncal = f_ValidarEditarTotalTroncal(Prog_IdManto1,Prog_BusTroncal2);
      if(tValidaEditarTotalTroncal=="invalido"){
        vacioTroncal = true;
        Swal.fire({
          icon: 'error',
          title: 'INFORMACION TRONCAL...',
          text: '*Falta completar información!'
        });
      }
      if(selectNovedadIdTroncal==""){
        vacioTroncal = true;
        Swal.fire({
          icon: 'error',
          title: 'NOVEDADES...',
          text: '*NO se ha asociado a una novedad!'
        });
      }
    }

    if(!vacioTroncal){
      $("#btnGuardarTroncal").prop("disabled",true); // Se deshabilita boton de grabar para evitar el multiple click
      /// CREAR
      if(nOpcionGrabarTroncal == 1) {
          Accion='CrearControlFacilitador';
          arrData = JSON.stringify(adata);
          $.ajax({
              url: "Ajax.php",
              type: "POST",
              datatype:"json",    
              data:  { MoS:MoS, NombreMoS:NombreMoS, Accion:Accion, Prog_Operacion:Prog_Operacion, Prog_Fecha:Prog_Fecha, Prog_NombreColaborador:Prog_NombreColaborador,Prog_Tabla:Prog_Tabla, Prog_HoraOrigen:Prog_HoraOrigen, Prog_HoraDestino:Prog_HoraDestino, Prog_Servicio:Prog_Servicio, Prog_ServBus:Prog_ServBus, Prog_Bus:Prog_Bus, Prog_LugarOrigen:Prog_LugarOrigen, Prog_LugarDestino:Prog_LugarDestino, Prog_TipoEvento:Prog_TipoEvento, Prog_KmXPuntos:Prog_KmXPuntos, Prog_Sentido:Prog_Sentido, Prog_BusManto:Prog_BusManto, Prog_IdManto:Prog_IdManto, Prog_Observaciones:Prog_Observaciones, OPE_NovedadId:selectNovedadIdTroncal, btnOpcionNovedad:btnOpcionNovedadTroncal, Nove_Novedad:Nove_NovedadTroncal, Nove_TipoNovedad:Nove_TipoNovedadTroncal, Nove_DetalleNovedad:Nove_DetalleNovedadTroncal, Nove_Descripcion:Nove_DescripcionNovedadTroncal, Nove_LugarExacto:Nove_LugarExactoTroncal, Nove_HoraInicio:Nove_HoraInicioTroncal, Nove_HoraFin:Nove_HoraFinTroncal, Nove_TipoOrigen:Nove_TipoOrigenTroncal, arrData:arrData},
              success: function(data) {
                tablaControlFacilitador.ajax.reload(null, false);
              }
          });
          bValidarNovedadTroncal = ValidarNovedadTroncal(Prog_Fecha,Prog_Operacion);
      }
        
      /// AGREGAR NOVEDAD
      if(nOpcionGrabarTroncal == 2) {
        Accion='EditarControlFacilitador';
        btnOpcionNovedadTroncal="NuevaNovedad";
        arrData = JSON.stringify(adata);
        $.ajax({
          url: "Ajax.php",
          type: "POST",
          datatype:"json",    
          data:  { MoS:MoS, NombreMoS:NombreMoS, Accion:Accion, Prog_Operacion:Prog_Operacion, Prog_Fecha:Prog_Fecha, Prog_NombreColaborador:Prog_NombreColaborador,Prog_Tabla:Prog_Tabla, Prog_HoraOrigen:Prog_HoraOrigen, Prog_HoraDestino:Prog_HoraDestino, Prog_Servicio:Prog_Servicio, Prog_ServBus:Prog_ServBus, Prog_Bus:Prog_Bus,Prog_LugarOrigen:Prog_LugarOrigen, Prog_LugarDestino:Prog_LugarDestino, Prog_TipoEvento:Prog_TipoEvento, Prog_KmXPuntos:Prog_KmXPuntos, Prog_Sentido:Prog_Sentido,Prog_BusManto:Prog_BusManto, Prog_IdManto:Prog_IdManto, Prog_Observaciones:Prog_Observaciones, arrData:arrData, OPE_NovedadId:selectNovedadIdTroncal, btnOpcionNovedad:btnOpcionNovedadTroncal, Nove_Novedad:Nove_NovedadTroncal,Nove_TipoNovedad:Nove_TipoNovedadTroncal, Nove_DetalleNovedad:Nove_DetalleNovedadTroncal, Nove_Descripcion:Nove_DescripcionNovedadTroncal, Nove_LugarExacto:Nove_LugarExactoTroncal, Nove_HoraInicio:Nove_HoraInicioTroncal, Nove_HoraFin:Nove_HoraFinTroncal, Nove_TipoOrigen:Nove_TipoOrigenTroncal},
          success: function(data) {
            tablaControlFacilitador.ajax.reload(null, false);
          }
        });
        bValidarNovedadTroncal = ValidarNovedadTroncal(Prog_Fecha,Prog_Operacion);
      }

      /// EDITAR
      if(nOpcionGrabarTroncal == 3) {
        Accion='EditarControlFacilitador';
        btnOpcionNovedadTroncal="AsociarNovedad";
        arrData = JSON.stringify(adata);
        $.ajax({
          url: "Ajax.php",
          type: "POST",
          datatype:"json",    
          data:  { MoS:MoS, NombreMoS:NombreMoS, Accion:Accion, Prog_Operacion:Prog_Operacion, Prog_Fecha:Prog_Fecha, Prog_NombreColaborador:Prog_NombreColaborador,Prog_Tabla:Prog_Tabla, Prog_HoraOrigen:Prog_HoraOrigen, Prog_HoraDestino:Prog_HoraDestino, Prog_Servicio:Prog_Servicio, Prog_ServBus:Prog_ServBus, Prog_Bus:Prog_Bus,Prog_LugarOrigen:Prog_LugarOrigen, Prog_LugarDestino:Prog_LugarDestino, Prog_TipoEvento:Prog_TipoEvento, Prog_KmXPuntos:Prog_KmXPuntos, Prog_Sentido:Prog_Sentido,Prog_BusManto:Prog_BusManto, Prog_IdManto:Prog_IdManto, Prog_Observaciones:Prog_Observaciones, arrData:arrData, OPE_NovedadId:selectNovedadIdTroncal, btnOpcionNovedad:btnOpcionNovedadTroncal, Nove_Novedad:Nove_NovedadTroncal,Nove_TipoNovedad:Nove_TipoNovedadTroncal, Nove_DetalleNovedad:Nove_DetalleNovedadTroncal, Nove_Descripcion:Nove_DescripcionNovedadTroncal, Nove_LugarExacto:Nove_LugarExactoTroncal, Nove_HoraInicio:Nove_HoraInicioTroncal, Nove_HoraFin:Nove_HoraFinTroncal, Nove_TipoOrigen:Nove_TipoOrigenTroncal},
          success: function(data) {
            tablaControlFacilitador.ajax.reload(null, false);
           }
        });
      }

      /// AGREGAR NOVEDAD
      if(nOpcionGrabarTroncal == 4) {
        Accion='EditarControlFacilitador';
        btnOpcionNovedadTroncal="NuevaNovedad";
        arrData = JSON.stringify(adata);
        $.ajax({
          url: "Ajax.php",
          type: "POST",
          datatype:"json",    
          data:  { MoS:MoS, NombreMoS:NombreMoS, Accion:Accion, Prog_Operacion:Prog_Operacion, Prog_Fecha:Prog_Fecha, Prog_NombreColaborador:Prog_NombreColaborador,Prog_Tabla:Prog_Tabla, Prog_HoraOrigen:Prog_HoraOrigen, Prog_HoraDestino:Prog_HoraDestino, Prog_Servicio:Prog_Servicio, Prog_ServBus:Prog_ServBus, Prog_Bus:Prog_Bus,Prog_LugarOrigen:Prog_LugarOrigen, Prog_LugarDestino:Prog_LugarDestino, Prog_TipoEvento:Prog_TipoEvento, Prog_KmXPuntos:Prog_KmXPuntos, Prog_Sentido:Prog_Sentido,Prog_BusManto:Prog_BusManto, Prog_IdManto:Prog_IdManto, Prog_Observaciones:Prog_Observaciones, arrData:arrData, OPE_NovedadId:selectNovedadIdTroncal, btnOpcionNovedad:btnOpcionNovedadTroncal, Nove_Novedad:Nove_NovedadTroncal,Nove_TipoNovedad:Nove_TipoNovedadTroncal, Nove_DetalleNovedad:Nove_DetalleNovedadTroncal, Nove_Descripcion:Nove_DescripcionNovedadTroncal,  Nove_LugarExacto:Nove_LugarExactoTroncal, Nove_HoraInicio:Nove_HoraInicioTroncal, Nove_HoraFin:Nove_HoraFinTroncal, Nove_TipoOrigen:Nove_TipoOrigenTroncal},
          success: function(data) {
            tablaControlFacilitador.ajax.reload(null, false);
           }
        });
        bValidarNovedadTroncal = ValidarNovedadTroncal(Prog_Fecha,Prog_Operacion);
      }

      /// EDITAR TOTAL DE BUS X BUS
      if(nOpcionGrabarTroncal == 5) {
        Accion='EditarTotalControlFacilitador';
        $.ajax({
          url: "Ajax.php",
          type: "POST",
          datatype:"json",    
          data:  { MoS:MoS,NombreMoS:NombreMoS,Accion:Accion,Prog_Operacion:Prog_Operacion,Prog_Fecha:Prog_Fecha,Prog_IdManto1:Prog_IdManto1,Prog_Bus2:Prog_BusTroncal2,OPE_NovedadId:selectNovedadIdTroncal},
          success: function(data) {
            tablaControlFacilitador.ajax.reload(null, false);
           }
        });
      }

      if(bValidarNovedadTroncal=="SI NOVEDADES"){
        $('#btnEditarTotalTroncal').show();
      }
      $('#modalCRUDControlFacilitador').modal('hide');
    } 
  });

  /// ::::::::::::::: EDITA ESTADO ATENDIDO DE REPORTES DEL CONTROL FACILITADOR  :::::::::::::///
  $('#formMostrarReporteTroncal').submit(function(e){
    e.preventDefault(); //evita el comportambiento normal del submit, es decir, recarga total de la página
    Swal.fire({
      title: '¿Está seguro?',
      text: "Se atenderá el reporte de Despacho de Flota "+ControlFacilitador_Id+" !!!",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Si, atender!'
    }).then((result) => 
    {
      if (result.isConfirmed){
        Swal.fire(
          'Atendido!',
          'El registro ha sido atendido.',
          'success')
        respuesta = 1;
        if (respuesta == 1){            
          Accion='CerrarReporte';
          $.ajax({
            url: "Ajax.php",
            type: "POST",
            datatype:"json",    
            data: { MoS:MoS,NombreMoS:NombreMoS,Accion:Accion,ControlFacilitador_Id:ControlFacilitador_Id},   
            success: function(data) {
              tablaControlFacilitador.ajax.reload(null, false);
            }
          });
        }
      }
    });
    $('#modalCRUDMostrarReporteTroncal').modal('hide');
  });

  //::::::::  SELECCION DE BOTONES NUEVA NOVEDAD Y ASOCIAR NOVEDAD  ::::::://
  $("input[name=optionsNovedadTroncal]").click(function () {    
    let thtml="";
    btnOpcionNovedadTroncal = $(this).val();
    LimpiaMsControlFacilitadorTroncal();

    if(btnOpcionNovedadTroncal=="NuevaNovedad"){
      document.getElementById("Nove_NovedadTroncal").placeholder = "";
      document.getElementById("Nove_DescripcionNovedadTroncal").placeholder = "";
      thtml = '<option value="">Seleccione una opcion</option>';
      $("#Nove_TipoNovedadTroncal").html(thtml);
      $("#Nove_DetalleNovedadTroncal").html(thtml);
      $("#Nove_DescripcionNovedadTroncal").val("");
      $('#div_NuevaNovedadTroncal').show(); 
      $('#div_AsociarNovedadTroncal').hide(); 
    }else{
      thtml="";
      ControlFacilitador_Id=0;
      thtml = f_selectNovedad(Prog_Fecha,Prog_OperacionTroncal,ControlFacilitador_Id);
      $("#selectNovedadIdTroncal").html(thtml);
      document.getElementById("selectNovedadIdTroncal").placeholder = "";
      document.getElementById("t_NovedadIdTroncal").placeholder = "";
      document.getElementById("t_NovedadTroncal").placeholder = "";
      document.getElementById("t_TipoNovedadTroncal").placeholder = "";
      document.getElementById("t_DetalleNovedadTroncal").placeholder = "";
      document.getElementById("t_DescripcionNovedadTroncal").placeholder = "";
      $("#t_NovedadIdTroncal").val("");
      $("#t_NovedadTroncal").val("");
      $("#t_TipoNovedadTroncal").val("");
      $("#t_DetalleNovedadTroncal").val("");
      $("#t_DescripcionNovedadTroncal").val("");
      selectNovedadIdTroncal = "";
      $("#selectNovedadIdTroncal").val("");
      $('#div_NuevaNovedadTroncal').hide(); 
      $('#div_AsociarNovedadTroncal').show(); 
    }
  });

  ///::::::::: EVENTO DEL BOTON NUEVO ::::::::::::::///
  $("#btnViajeTroncal").click(function(){
    nOpcionGrabarTroncal = 1; // Alta Nueva Fila
    Nove_TipoOrigenTroncal = "CGO";
    selectNovedadIdTroncal = "";
    btnOpcionNovedadTroncal = "";

    // Se inicializa el array a modificar y se cargan los id de los registros a actualizar
    adata=[];
    var xdata = tablaControlFacilitador.rows( { selected: true } ).data();
    $.each(xdata,function(index, value){
      adata.push( value.ControlFacilitador_Id );
    });

    $("#formControlFacilitador").trigger("reset");
    $("#btnGuardarTroncal").prop("disabled",false);

    LimpiaMsControlFacilitadorTroncal();

    bValidarNovedadTroncal = ValidarNovedadTroncal(Prog_Fecha,Prog_Operacion);
    fEdicionCamposTroncal('disabled', false);

    $("#Nove_NovedadTroncal").prop('disabled',false);
    $("#Nove_TipoNovedadTroncal").prop('disabled',false);

    if (adata.length < 2){
      if(adata.length === 1){
        f_CargaVariablesFilaTroncal();
      }else{
//        $("#Prog_ServBus").prop('disabled', false);
        f_CargaVariablesVacioTroncal();
        f_CargaVariablesHtmlVacioTroncal();
      }

      f_CargaVariablesHtmlDataTroncal();

      $(".modal-header").css( "background-color", "#17a2b8");
      $(".modal-header").css( "color", "white" );
      $(".modal-title").text("Agregar Viaje Control Facilitador Troncal");
    
      $('#div_ControlFacilitadorTroncalEditarTotal').hide();
      $('#div_ControlFacilitadorTroncalMultiple').show(); 
      $('#div_ControlFacilitadorTroncalUnico').show(); 
      $('#div_OpcionNovedadTroncal').show(); 
      $('#div_NuevaNovedadTroncal').hide(); 
      $('#div_AsociarNovedadTroncal').hide(); 

      $('#modalCRUDControlFacilitador').modal('show');
      $("#modalCRUDControlFacilitador").draggable({});
    }else{
      Swal.fire(
        'NUEVO REGISTRO!',
        'Se puede cargar una sola fila.',
        'success'
      )
    }
  }); 

  ///::::::::: EVENTO DEL BOTON AGREGAR ::::::::::::::::::::::///       
  $('#btnAgregarNovedadTroncal').click( function () {
    selectNovedadIdTroncal = "";
    $("#formControlFacilitador").trigger("reset");
    $("#btnGuardarTroncal").prop("disabled",false);
    // Se inicializa el array a modificar y se cargan los id de los registros a actualizar
    adata=[];
    var xdata = tablaControlFacilitador.rows( { selected: true } ).data();
    $.each(xdata,function(index, value){
      adata.push( value.ControlFacilitador_Id );
    });

    if(adata.length === 1){
      nOpcionGrabarTroncal = 2; //Agregar Novedad
      Nove_TipoOrigenTroncal = "CGO";
      LimpiaMsControlFacilitadorTroncal();

      bValidarNovedadTroncal = ValidarNovedadTroncal(Prog_Fecha,Prog_Operacion);
      fEdicionCamposTroncal('disabled', true);
      $("#Nove_NovedadTroncal").prop('disabled',false);
      $("#Nove_TipoNovedadTroncal").prop('disabled',false);
    
      f_CargaVariablesFilaTroncal();

      f_CargaVariablesHtmlDataTroncal();

      $(".modal-header").css("background-color", "#007bff");
      $(".modal-header").css("color", "white" );
      $(".modal-title").text("Agregar Novedad Troncal");

      $('#div_ControlFacilitadorTroncalEditarTotal').hide();
      $('#div_ControlFacilitadorTroncalMultiple').show(); 
      $('#div_ControlFacilitadorTroncalUnico').show(); 
      $('#div_OpcionNovedadTroncal').hide(); 
      $('#div_AsociarNovedadTroncal').hide(); 
      $('#div_NuevaNovedadTroncal').show(); 

      $("#modalCRUDControlFacilitador").modal("show");
      $("#modalCRUDControlFacilitador").draggable({});
    }else{
      Swal.fire(
        'NOVEDAD!',
        'Las Novedades se crean para una sola fila.',
        'success'
      )
    }
  });

  ///::::::::: EVENTO DEL BOTON EDITAR ::::::::::::::::::::::///       
  $('#btnEditarTroncal').click( function () {
    // Se inicializa el array a modificar y se cargan los id de los registros a actualizar
    adata     = [];
    var xdata = tablaControlFacilitador.rows( { selected: true } ).data();
    $.each(xdata,function(index, value){
      adata.push( value.ControlFacilitador_Id );
    });

    var xtexto = "Multiples Valores";
    selectNovedadIdTroncal = "";
    ControlFacilitador_Id = 0;
    $("#formControlFacilitador").trigger("reset");
    $("#btnGuardarTroncal").prop("disabled",false);

    nOpcionGrabarTroncal = 3; //Editar Filas
    LimpiaMsControlFacilitadorTroncal();

    bValidarNovedadTroncal = ValidarNovedadTroncal(Prog_Fecha,Prog_Operacion);
    fEdicionCamposTroncal('disabled', false);
    
//    $("#Prog_ServBus").prop('disabled', true);
    $("#Prog_HoraOrigen").prop('disabled', true);
    $("#Prog_HoraDestino").prop('disabled', true);

    if (adata.length === 1){
      f_CargaVariablesFilaTroncal();
    }else{
      f_CargaVariablesVacioTroncal();
      f_CargaVariablesHtmlTextoTroncal(xtexto);
    }

    f_CargaVariablesHtmlDataTroncal();
    xtexto  = "";
    xtexto  = f_selectNovedad(Prog_Fecha,Prog_Operacion,ControlFacilitador_Id);
    $("#selectNovedadIdTroncal").html(xtexto);
    $(".modal-header").css("background-color", "#007bff");
    $(".modal-header").css("color", "white" );
    $(".modal-title").text("Editar Control Facilitador Troncal");

    $('#div_ControlFacilitadorTroncalEditarTotal').hide();
    $('#div_ControlFacilitadorTroncalMultiple').show(); 
    if(adata.length === 1){
      $('#div_ControlFacilitadorTroncalUnico').show(); 
    }else{
      $('#div_ControlFacilitadorTroncalUnico').hide(); 
    }
    $('#div_OpcionNovedadTroncal').hide(); 
    $('#div_NuevaNovedadTroncal').hide(); 
    $('#div_AsociarNovedadTroncal').show(); 

    $("#modalCRUDControlFacilitador").modal("show");
    $("#modalCRUDControlFacilitador").draggable({});
  });

  ///::::::::: EVENTO DEL BOTON EDITAR TOTAL BUS PILOTO::::::::::::::::::::::///       
  $('#btnEditarTotalTroncal').click( function () {
    // Se inicializa el array a modificar y se cargan los id de los registros a actualizar
    adata=[];
    var xdata = tablaControlFacilitador.rows( { selected: true } ).data();
    $.each(xdata,function(index, value){
      adata.push( value.ControlFacilitador_Id );
    });

    selectNovedadIdTroncal = "";
    ControlFacilitador_Id = 0;
    $("#formControlFacilitador").trigger("reset");
    $("#btnGuardarTroncal").prop("disabled",false);

    if(adata.length>0){
      Swal.fire({
        icon              : 'success',
        title             : 'CAMBIO DE BUS!',
        html              : 'Se realizará por ID Bus.',
        showConfirmButton : false,
        timer             : 2000
      })
    }

      nOpcionGrabarTroncal = 5; //Editar Filas Todos Bus1 x Bus2, Piloto1 x Piloto2
      LimpiaMsControlFacilitadorTroncal();

      Prog_IdManto1     = "";
      Prog_BusTroncal2  = "";
      $("#Prog_IdManto1").val(Prog_IdManto1);
      $("#Prog_BusTroncal2").val(Prog_BusTroncal2);
    
      Accion='SelectIdMantoActual'; 
      $.ajax({
        url       : "Ajax.php",
        type      : "POST",
        datatype  : "json",    
        data      : {MoS:MoS,NombreMoS:NombreMoS,Accion:Accion,Prog_Operacion:Prog_Operacion,Prog_Fecha:Prog_Fecha},
        success: function(data){
          $("#Prog_IdManto1").html(data);
        }
      });

      //Accion='SelectBusCambio'; 
      //data: {MoS:MoS,NombreMoS:NombreMoS,Accion:Accion,Prog_Operacion:Prog_Operacion,Prog_Fecha:Prog_Fecha},
      Accion='SelectBus'; 
      $.ajax({
        url       : "Ajax.php",
        type      : "POST",
        datatype  : "json",    
        data      : {MoS:MoS,NombreMoS:NombreMoS,Accion:Accion,Prog_Operacion:Prog_Operacion},
        success: function(data){
          $("#Prog_BusTroncal2").html(data);
        }
      });

      bValidarNovedadTroncal  = ValidarNovedadTroncal(Prog_Fecha,Prog_Operacion);
      xtexto                  = "";
      xtexto                  = f_selectNovedad(Prog_Fecha,Prog_Operacion,ControlFacilitador_Id);
      $("#selectNovedadIdTroncal").html(xtexto);
  
      $(".modal-header").css("background-color", "#007bff");
      $(".modal-header").css("color", "white" );
      $(".modal-title").text("Cambio Bus x Bus Control Facilitador Troncal");
      $('#div_ControlFacilitadorTroncalEditarTotal').show();
      $('#div_ControlFacilitadorTroncalMultiple').hide(); 
      $('#div_ControlFacilitadorTroncalUnico').hide(); 
      $('#div_OpcionNovedadTroncal').hide(); 
      $('#div_NuevaNovedadTroncal').hide(); 
      $('#div_AsociarNovedadTroncal').show(); 
  
      $("#modalCRUDControlFacilitador").modal("show");
      $("#modalCRUDControlFacilitador").draggable({}); //MODAL MOVIBLE
    
  });

  ///::::::::: EVENTO DEL BOTON AGREGAR PUNTO FIJO ::::::::::::::::::::::///       
  $('#btnAgregarPuntoFijoTroncal').click( function () {
    selectNovedadIdTroncal = "";
    Nove_NovedadTroncal = "NOVEDAD_PILOTO";
    Nove_TipoNovedadTroncal = "COMPORTAMIENTO";
    
    $("#formControlFacilitador").trigger("reset");
    $("#btnGuardarTroncal").prop("disabled",false);
    // Se inicializa el array a modificar y se cargan los id de los registros a actualizar
    adata=[];
    var xdata = tablaControlFacilitador.rows( { selected: true } ).data();
    $.each(xdata,function(index, value){
      adata.push( value.ControlFacilitador_Id );
    });

    if(adata.length === 1){
      nOpcionGrabarTroncal = 4; //Agregar Punto Fijo
      Nove_TipoOrigenTroncal = "PUNTO FIJO";
      LimpiaMsControlFacilitadorTroncal();

      bValidarNovedadTroncal = ValidarNovedadTroncal(Prog_Fecha,Prog_Operacion);
      fEdicionCamposTroncal('disabled', true);
      $("#Nove_NovedadTroncal").prop('disabled',true);
      $("#Nove_TipoNovedadTroncal").prop('disabled',true);

      f_CargaVariablesFilaTroncal();

      f_CargaVariablesHtmlDataTroncal();
    
      $("#Nove_NovedadTroncal").val(Nove_NovedadTroncal);
      selectHtml="";
      selectHtml=f_TipoTabla(Prog_Operacion,Nove_NovedadTroncal);
      $("#Nove_TipoNovedadTroncal").html(selectHtml);

      $("#Nove_TipoNovedadTroncal").val(Nove_TipoNovedadTroncal);
      selectHtml="";
      selectHtml=f_TipoTabla(Prog_Operacion,Nove_TipoNovedadTroncal);
      $("#Nove_DetalleNovedadTroncal").html(selectHtml);

      $(".modal-header").css("background-color", "#007bff");
      $(".modal-header").css("color", "white" );
      $(".modal-title").text("Agregar Reporte en Vía Troncal");

      $('#div_ControlFacilitadorTroncalEditarTotal').hide();
      $('#div_ControlFacilitadorTroncalMultiple').show(); 
      $('#div_ControlFacilitadorTroncalUnico').show(); 
      $('#div_OpcionNovedadTroncal').hide(); 
      $('#div_AsociarNovedadTroncal').hide(); 
      $('#div_NuevaNovedadTroncal').show(); 

      $("#modalCRUDControlFacilitador").modal("show");
      $("#modalCRUDControlFacilitador").draggable({});

    }else{
      Swal.fire(
        'PUNTO FIJO!',
        'Las Novedades de Punto Fijo se crean para una sola fila.',
        'success'
      )
    }
  });

  ///:::::::::  EVENTO BOTON MOSTRAR INCONSISTENCIAS  ::::::::::///
  $('#btnInconsistenciasTroncal').click( function(){
    let aInconsistenciasTroncal, tablaInconsistenciasTroncal;
    
    // Creacion de tabla de Inconsistencias
    div_tablas = f_CreacionTabla("tablaMostrarInconsistenciasTroncal","");
    $("#div_tablaMostrarInconsistenciasTroncal").html(div_tablas);
    
    aInconsistenciasTroncal = fInconsistenciasControlFacilitador(Prog_Fecha,Prog_Operacion);
    $("#tablaMostrarInconsistenciasTroncal tbody").children().remove();
    if(aInconsistenciasTroncal.length>0){
      tablaInconsistenciasTroncal = "";
      $.each(aInconsistenciasTroncal, function(idx, obj){ 
        tablaInconsistenciasTroncal += ('<tr>');
        tablaInconsistenciasTroncal += ('<td>' + obj.Inco_Tipo +' : '+obj.Inco_Detalle+ '</td>');
        tablaInconsistenciasTroncal += ('<td>' + obj.Inco_Id + '</td>');
        tablaInconsistenciasTroncal += ('<td>' + obj.Inco_IdManto + '</td>');
        tablaInconsistenciasTroncal += ('</tr>');
      });
      $('#tablaMostrarInconsistenciasTroncal').append(tablaInconsistenciasTroncal);

      $("#formMostrarInconsistenciasTroncal").trigger("reset");
      $(".modal-header").css( "background-color", "#17a2b8");
      $(".modal-header").css( "color", "white" );
      $(".modal-title").text("Inconsistencias Troncal");
      $(".modal-subtitle").text("1. Pilotos y Buses no pueden estar asignados en la misma franja horaria a 2 eventos distintos.");
      $('#modalCRUDMostrarInconsistenciasTroncal').modal('show');
      $('#div_tablaMostrarInconsistenciasTroncal').show();    

    }else{
      Swal.fire(
        'Inconsistencias!',
        'NO se han encontrado Inconsistencias en la Operacion',
        'success'
      )
    }
  });

  ///:::::::::  EVENTO BOTON MOSTRAR RESUMEN  ::::::::::///
  $('#btnResumenTroncal').click( function(){
    $("#formMostrarResumenTroncal").trigger("reset");
    let t_html = "";

    if (CFaRg_Estado=="CERRADO"){
      Accion='resumen_operacion_hist';
    }else{
      Accion='ResumenOperacion';
    }
    
    $.ajax({
      url: "Ajax.php",
      type: "POST",
      datatype:"json",
      async: false,
      data: {MoS:MoS,NombreMoS:NombreMoS,Accion:Accion,Prog_Fecha:Prog_Fecha},    
      success: function(data){
        t_html = data;
      }
    });

    $("#div_form_mostrar_resumen_troncal").html(t_html);
    $(".modal-title_resumen_troncal").text("RESUMEN");
    $(".modal-header").css( "background-color", "#17a2b8");
    $(".modal-header").css( "color", "white" );

    $('#modalCRUDMostrarResumenTroncal').modal('show');
    $('#modal-resizable_resumen_troncal').resizable();
    $(".modal-dialog").draggable({
      cursor: "move",
      handle: ".dragable_touch",
    });        

    //$("#modalCRUDMostrarResumenTroncal").draggable({});
  });

  ///::::::::: EVENTO DEL BOTON LOGUEO ::::::::::::::::::::::///       
  $(document).on("click", ".btn_logueo_troncal", function(){
    $("#form_logueo_troncal").trigger("reset");
    $("#btn_novedad_logueo_troncal").prop("disabled",false); // Se habilita boton de grabar para evitar el multiple click
    adata=[];
    var xdata = tablaControlFacilitador.rows( { selected: true } ).data();
    $.each(xdata,function(index, value){
      adata.push( value.ControlFacilitador_Id );
    });
    
    if(adata.length === 1){
      selectNovedadIdTroncal  = "";
      nOpcionGrabarTroncal    = 2; //Agregar Novedad
      Nove_TipoOrigenTroncal  = "CGO";
      LimpiaMsControlFacilitadorTroncal();
      f_CargaVariablesVacioTroncal();
      f_CargaVariablesFilaTroncal();
      data_BD_troncal     = f_BuscarDataBD("Buses","Bus_NroExterno",Prog_Bus);
      logueo_troncal_vid  = "";
      $.each(data_BD_troncal, function(idx, obj){
        logueo_troncal_vid = obj.Bus_NroVid;
      });

      $("#logueo_troncal_bus").val(Prog_Bus);
      $("#logueo_troncal_vid").val(logueo_troncal_vid);
      $("#logueo_troncal_codigo_piloto").val('12'+fila.find('td:eq(1)').text());
      $("#logueo_troncal_nombre_piloto").val(Prog_NombreColaborador);
      $("#logueo_troncal_tabla").val(Prog_Tabla);
      $("#logueo_troncal_servicio").val(Prog_Servicio);

      $(".modal-header").css("background-color", "#17a2b8");
      $(".modal-header").css("color", "white" );
      $(".modal-title_logueo_troncal").text("LOGUEO");
      $(".modal-body-title_logueo_troncal").text("LOGUEO DE SERVICIO");
      $(".modal-body-subtitle_logueo_troncal").text("FECHA: "+f_fecha_texto(fecha_hoy));

      $("#modal_crud_logueo_troncal").modal("show");
      $("#modal_crud_logueo_troncal").draggable({});
    }else{
      Swal.fire(
        'LOGUEO!',
        'El servicio de Logueo es para una sola fila.',
        'success'
      )
    }
  });

  ///::::::::: EVENTO DE BOTON VER BUSES TRONCAL ::::::::::::::::::::::///       
  $(document).on("click", ".btn_ver_bus_troncal", function(){
    $("#form_modal_bus_troncal").trigger("reset");
    bus_nro_externo_troncal = $("#bus_troncal").val();
    data_BD_troncal         = f_BuscarDataBD("Buses","Bus_NroExterno",bus_nro_externo_troncal);
    Bus_NroExterno_troncal  = "";
    $.each(data_BD_troncal, function(idx, obj){
      Bus_NroExterno_troncal = obj.Bus_NroExterno;    
      Bus_NroVid_troncal     = obj.Bus_NroVid;
      Bus_NroPlaca_troncal   = obj.Bus_NroPlaca;  
      Bus_Operacion_troncal  = obj.Bus_Operacion;   
      Bus_Detalle_troncal    = obj.Bus_Detalle;    
      Bus_Tipo_troncal       = obj.Bus_Tipo;  
      Bus_Tipo2_troncal      = obj.Bus_Tipo2;      
      Bus_Estado_troncal     = obj.Bus_Estado;      
      Bus_Tanques_troncal    = obj.Bus_Tanques;   
    });
    if(Bus_NroExterno_troncal == null || Bus_NroExterno_troncal == ""){
      Swal.fire({
        icon: 'error',
        title: 'Bus...',
        text: '*Es posible que la Información no sea la correcta!!!'
      })
    }else{
      $("#Bus_NroExterno_troncal").val(Bus_NroExterno_troncal);
      $("#Bus_NroVid_troncal").val(Bus_NroVid_troncal);
      $("#Bus_NroPlaca_troncal").val(Bus_NroPlaca_troncal);  
      $("#Bus_Operacion_troncal").val(Bus_Operacion_troncal);
      $("#Bus_Detalle_troncal").val(Bus_Detalle_troncal);
      $("#Bus_Tipo_troncal").val(Bus_Tipo_troncal);  
      $("#Bus_Tipo2_troncal").val(Bus_Tipo2_troncal);    
      $("#Bus_Estado_troncal").val(Bus_Estado_troncal);   
      $("#Bus_Tanques_troncal").val(Bus_Tanques_troncal);  
    
      $(".modal-header").css( "background-color", "#17a2b8");
      $(".modal-header").css( "color", "white" );
      $(".modal-title").text("Información de Bus");
      $('#modal_crud_bus_troncal').modal('show');
      $("#modal_crud_bus_troncal").draggable({});
      $("#bus_troncal").val("");	    
    }
  });

  ///::::::::: EVENTO DE BOTON IGUAL FECHAS TRONCAL ::::::::::::::::::::::///       
  $(document).on("click", ".btn_igual_fecha_troncal", function(){
    HoraInicioTroncal = $("#HoraInicioTroncal").val();
    MinutoInicioTroncal = $("#MinutoInicioTroncal").val();
    $("#HoraFinTroncal").val(HoraInicioTroncal);
    $("#MinutoFinTroncal").val(MinutoInicioTroncal);
  });

  ///::::::::: EVENTO DE BOTON AGREGAR NOVEDAD DESDE LOGUEO TRONCAL ::::::::::::::::::::::///       
  $(document).on("click", ".btn_novedad_logueo_troncal", function(){
    selectNovedadIdTroncal        = "";
    btnOpcionNovedadTroncal       = "NuevaNovedad";
    Nove_NovedadTroncal           = "NOVEDAD_BUS";
    Nove_TipoNovedadTroncal       = "FALLA_COMUNICACIONES";
    Nove_DetalleNovedadTroncal    = "SIN_VARADA";
    Nove_DescripcionNovedadTroncal= "SE REPORTA A CGC QUE REALICE EL LOGUEO DEL SERVICIO";
    Nove_LugarExactoTroncal       = Prog_LugarOrigen;
    Nove_HoraInicioTroncal        = fecha_hoy.getHours()+":"+fecha_hoy.getMinutes();
    Nove_HoraFinTroncal           = fecha_hoy.getHours()+":"+fecha_hoy.getMinutes();
    Nove_TipoOrigenTroncal        = "CGO";

    /// AGREGAR NOVEDAD
    if(nOpcionGrabarTroncal == 2) {
      $("#btn_novedad_logueo_troncal").prop("disabled",true); // Se deshabilita boton de grabar para evitar el multiple click
      Accion                  = 'EditarControlFacilitador';
      btnOpcionNovedadTroncal = "NuevaNovedad";
      arrData                 = JSON.stringify(adata);
      $.ajax({
        url       : "Ajax.php",
        type      : "POST",
        datatype  : "json",    
        data      :  { MoS:MoS, NombreMoS:NombreMoS, Accion:Accion, Prog_Operacion:Prog_Operacion, Prog_Fecha:Prog_Fecha,Prog_NombreColaborador:Prog_NombreColaborador,Prog_Tabla:Prog_Tabla, Prog_HoraOrigen:Prog_HoraOrigen, Prog_HoraDestino:Prog_HoraDestino,Prog_Servicio:Prog_Servicio, Prog_ServBus:Prog_ServBus, Prog_Bus:Prog_Bus,Prog_LugarOrigen:Prog_LugarOrigen, Prog_LugarDestino:Prog_LugarDestino,Prog_TipoEvento:Prog_TipoEvento, Prog_KmXPuntos:Prog_KmXPuntos, Prog_Sentido:Prog_Sentido,Prog_BusManto:Prog_BusManto, Prog_IdManto:Prog_IdManto,Prog_Observaciones:Prog_Observaciones, arrData:arrData, OPE_NovedadId:selectNovedadIdTroncal, btnOpcionNovedad:btnOpcionNovedadTroncal,Nove_Novedad:Nove_NovedadTroncal,Nove_TipoNovedad:Nove_TipoNovedadTroncal, Nove_DetalleNovedad:Nove_DetalleNovedadTroncal,Nove_Descripcion:Nove_DescripcionNovedadTroncal, Nove_LugarExacto:Nove_LugarExactoTroncal, Nove_HoraInicio:Nove_HoraInicioTroncal,Nove_HoraFin:Nove_HoraFinTroncal, Nove_TipoOrigen:Nove_TipoOrigenTroncal},
        success   : function(data) {
          tablaControlFacilitador.ajax.reload(null, false);
        }
      });
      bValidarNovedadTroncal = ValidarNovedadTroncal(Prog_Fecha,Prog_Operacion);
    }

    if(bValidarNovedadTroncal=="SI NOVEDADES"){
      $('#btnEditarTotalTroncal').show();
    }
    $('#modal_crud_logueo_troncal').modal('hide');
  });

});

///::::::::::::::::::::::::: FIN DOM TRONCAL :::::::::::::::::::::::::::::::::::::::::::::///

///:::::::::::::::::::::::::::: BOTONES TRONCAL ::::::::::::::::::::::::::::::::::::::::::///

/// :::::::::::::::EVENTO BOTOM MOSTRAR DATATABLE CONTROLFACILITADOR TRONCAL :::::::::::::///
$("#btnBuscarProgramacionTroncal").click(function(){    
  // FALTA REVISAR LA FUNCION RENDER NO ESTA FUNCIONANDO
  columnastabla = f_ColumnasTabla("tablaControlFacilitador","");

  Prog_Fecha = $("#Prog_Fecha").val();
  Prog_Operacion = Prog_OperacionTroncal;
  bValidarNovedadTroncal = ValidarNovedadTroncal(Prog_Fecha,Prog_Operacion);
  CFaRg_Estado = '';

  // VALIDAR ESTADO DEL CONTROL FACILITADOR TRONCAL EN LA FECHA CORRESPONDIENTE
  Accion='ValidarControlFacilitador'; 
  $.ajax({
    url       : "Ajax.php",
    type      : "POST",
    datatype  : "json",
    async     : false,   
    data      : {MoS:MoS,NombreMoS:NombreMoS,Accion:Accion,Prog_Fecha:Prog_Fecha,Prog_Operacion:Prog_Operacion},    
    success   : function(data){
      CFaRg_Estado = data;
      if (CFaRg_Estado=="GENERADO"){
        $('#btnViajeTroncal').show(); // habilita boton nuevo
        $('#btnInconsistenciasTroncal').show(); // habilita boton Inconsistencias
        $('#btnResumenTroncal').show();
        if(bValidarNovedadTroncal=="SI NOVEDADES"){
          $('#btnEditarTotalTroncal').show();
        }
      }else{
        if (CFaRg_Estado=="CERRADO"){
          Swal.fire(
            'Cerrado!',
            'El Control Facilitador Troncal se encuentra cerrado.',
            'success'
          )
          $('#btnResumenTroncal').show();
        }else{
          Swal.fire(
            'NO Generado!',
            'El Control Facilitador Troncal no se encuentra generado.',
            'success'
          )
        }
      }
    }
  });
  
  Accion='SelectUsuario'; 
  $.ajax({
    url: "Ajax.php",
    type: "POST",
    datatype:"json",    
    data: {MoS:MoS,NombreMoS:NombreMoS,Accion:Accion},    
    success: function(data){
      $("#Prog_NombreColaborador").html(data);
    }
  });

  Accion='SelectBus'; 
  $.ajax({
    url: "Ajax.php",
    type: "POST",
    datatype:"json",    
    data: {MoS:MoS,NombreMoS:NombreMoS,Accion:Accion,Prog_Operacion:Prog_Operacion},    
    success: function(data){
      $("#Prog_Bus").html(data);
    }
  });

  Tipo='SERVICIO';
  selectHtml="";
  selectHtml = f_TipoTabla(Prog_Operacion,Tipo)
  $("#Prog_Servicio").html(selectHtml);

  Tipo='LUGAR';
  selectHtml = "";
  selectHtml = f_TipoTabla(Prog_Operacion,Tipo)
  $("#Prog_LugarOrigen").html(selectHtml);
  $("#Prog_LugarDestino").html(selectHtml);

  Tipo='EVENTO'; 
  selectHtml = "";
  selectHtml = f_TipoTabla(Prog_Operacion,Tipo)
  $("#Prog_TipoEvento").html(selectHtml);

  Tipo='NOVEDAD'; 
  selectHtml = "";
  selectHtml = f_TipoTabla(Prog_Operacion,Tipo)
  $("#Nove_NovedadTroncal").html(selectHtml);

  Tipo='SENTIDO';
  Operacion='LIMABUS'; 
  selectHtml = "";
  selectHtml = f_TipoTabla(Operacion,Tipo)
  $("#Prog_Sentido").html(selectHtml);

  $("#tablaControlFacilitador").dataTable().fnDestroy();
  $('#tablaControlFacilitador').show();

  if (CFaRg_Estado=="CERRADO"){
    Accion='leer_control_facilitador_hist';
  }else{
    Accion='LeerControlFacilitador';
  }
  
  tablaControlFacilitador = $('#tablaControlFacilitador').DataTable({
    //Color a las filas
    "rowCallback":function(row,data,index)
    {
      fColorFilasControlFacilitadorTroncal(row,data);
    }, 
    //Filtros por columnas
    orderCellsTop : true,
    fixedHeader   : true,
    initComplete  : function (){
      var api = this.api();
      // For each column
      api.columns().eq(0).each(function (colIdx) {
        // Set the header cell to contain the input element
        var cell  = $('.filters th').eq($(api.column(colIdx).header()).index());
        var title = $(cell).text();
        $(cell).html('<input type="text" placeholder="' + title + '" />');
        // On every keypress in this input
        $('input',$('.filters th').eq($(api.column(colIdx).header()).index()) ).off('keyup change').on('keyup change', function (e) {
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
    // Para mostrar la barra scroll horizontal y vertical
    deferRender     : true,
    scrollY         : 800,
    scrollCollapse  : true,
    scroller        : true,
    scrollX         : true,
    fixedColumns:
    {
      left: 1
    },
    fixedHeader:
    {
      header : false
    },
    select:{style: 'os'},
    //Para mostrar 50 registros popr página 
    pageLength: 500,
    //Para cambiar el lenguaje a español
    language: idiomaEspanol,
    //Para usar los botones
    responsive: "true",
    dom: 'Blfrtip', // Con Botones Excel,Pdf,Print
    lengthMenu: [
      [100, 500, 1000, -1],
      [100, 500, 1000, 'All'],
    ],
    buttons:[
      {
        extend:     'excelHtml5',
        text:       '<i class="fas fa-file-excel"></i> ',
        titleAttr:  'Exportar a Excel',
        title:      'CONTROL FACILITADOR TRONCAL '+Prog_Fecha,
        className:  'btn btn-success'
      },
      {
          extend:     'pdfHtml5',
          text:       '<i class="fas fa-file-pdf"></i> ',
          titleAttr:  'Exportar a PDF',
          className:  'btn btn-danger',
          orientation: 'landscape',
          pagaSize: 'A4',
          title: 'CONTROL FACILITADOR TRONCAL '+Prog_Fecha,
          exportOptions: {
            columns: [ 1,2,3,4,5,6,7,8,9,10,11,12 ]
          }
      },
    ],
    "ajax":{            
      "url": "Ajax.php", 
      "method": 'POST', //usamos el metodo POST
      "data":{ MoS:MoS,NombreMoS:NombreMoS,Accion:Accion,Prog_Fecha:Prog_Fecha,Prog_Operacion:Prog_Operacion,ViajesCancelados:ViajesCanceladosTroncal }, //enviamos opcion 4 para que haga un SELECT
      "dataSrc":"",
    },
    "columns": columnastabla,
    "columnDefs":[
      { "targets"  : [20],
        "render"   : function(data, type, row, meta) {
          if (data == "NO") {
            return "";
          } else {
            if (data == "SI"){
              return "<div class='text-center'><div class='btn-group'><button title='Novedad' class='btn btn-warning btn-sm btnMostrarNovedadTroncal'><i class='bi bi-clipboard-plus'><svg xmlns='http://www.w3.org/2000/svg' width='12' height='12' fill='currentColor' class='bi bi-clipboard-plus' viewBox='0 0 16 16'><path fill-rule='evenodd' d='M8 7a.5.5 0 0 1 .5.5V9H10a.5.5 0 0 1 0 1H8.5v1.5a.5.5 0 0 1-1 0V10H6a.5.5 0 0 1 0-1h1.5V7.5A.5.5 0 0 1 8 7z'/><path d='M4 1.5H3a2 2 0 0 0-2 2V14a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V3.5a2 2 0 0 0-2-2h-1v1h1a1 1 0 0 1 1 1V14a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V3.5a1 1 0 0 1 1-1h1v-1z'/><path d='M9.5 1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-3a.5.5 0 0 1-.5-.5v-1a.5.5 0 0 1 .5-.5h3zm-3-1A1.5 1.5 0 0 0 5 1.5v1A1.5 1.5 0 0 0 6.5 4h3A1.5 1.5 0 0 0 11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3z'/></svg></i></button></div></div>";
            }else{
              return "<div class='text-center'><div class='btn-group'><button title='Novedad' class='btn btn-danger btn-sm btnMostrarNovedadTroncal'><i class='bi bi-clipboard-plus'><svg xmlns='http://www.w3.org/2000/svg' width='12' height='12' fill='currentColor' class='bi bi-clipboard-plus' viewBox='0 0 16 16'><path fill-rule='evenodd' d='M8 7a.5.5 0 0 1 .5.5V9H10a.5.5 0 0 1 0 1H8.5v1.5a.5.5 0 0 1-1 0V10H6a.5.5 0 0 1 0-1h1.5V7.5A.5.5 0 0 1 8 7z'/><path d='M4 1.5H3a2 2 0 0 0-2 2V14a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V3.5a2 2 0 0 0-2-2h-1v1h1a1 1 0 0 1 1 1V14a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V3.5a1 1 0 0 1 1-1h1v-1z'/><path d='M9.5 1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-3a.5.5 0 0 1-.5-.5v-1a.5.5 0 0 1 .5-.5h3zm-3-1A1.5 1.5 0 0 0 5 1.5v1A1.5 1.5 0 0 0 6.5 4h3A1.5 1.5 0 0 0 11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3z'/></svg></i></button></div></div>";
            }
          }
        }
      },
      { "targets"  : [21],
        "render"   : function(data, type, row, meta) {
          if (data == null || data == "") {
              return "";
          } else {
            if (data == "PENDIENTE"){
              return "<div class='text-center'><div class='btn-group'><button title='Reporte' class='btn btn-warning btn-sm btnMostrarReporteTroncal'><i classbi-clipboard-plus'><svg xmlns='http://www.w3.org/2000/svg' width='12' height='12' fill='currentColor' class='bi bi-clipboard-plus' viewBox='0 16'><path fill-rule='evenodd' d='M8 7a.5.5 0 0 1 .5.5V9H10a.5.5 0 0 1 0 1H8.5v1.5a.5.5 0 0 1-1 0V10H6a.5.5 0 0 1 0-1h1.5V7.5A.5.5 0 0 1 8 7z'/><d='M4 1.5H3a2 2 0 0 0-2 2V14a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V3.5a2 2 0 0 0-2-2h-1v1h1a1 1 0 0 1 1 1V14a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V3.5a1 1 01-1h1v-1z'/><path d='M9.5 1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-3a.5.5 0 0 1-.5-.5v-1a.5.5 0 0 1 .5-.5h3zm-3-1A1.5 1.5 0 0 0 5 1.5v1A1.5 1.5 0 0 04h3A1.5 1.5 0 0 0 11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3z'/></svg></i></button></div></div>";
            }else{
              return "<div class='text-center'><div class='btn-group'><button title='Reporte' class='btn btn-success btn-sm btnMostrarReporteTroncal'><i classbi-clipboard-plus'><svg xmlns='http://www.w3.org/2000/svg' width='12' height='12' fill='currentColor' class='bi bi-clipboard-plus' viewBox='0 16'><path fill-rule='evenodd' d='M8 7a.5.5 0 0 1 .5.5V9H10a.5.5 0 0 1 0 1H8.5v1.5a.5.5 0 0 1-1 0V10H6a.5.5 0 0 1 0-1h1.5V7.5A.5.5 0 0 1 8 7z'/><d='M4 1.5H3a2 2 0 0 0-2 2V14a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V3.5a2 2 0 0 0-2-2h-1v1h1a1 1 0 0 1 1 1V14a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V3.5a1 1 01-1h1v-1z'/><path d='M9.5 1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-3a.5.5 0 0 1-.5-.5v-1a.5.5 0 0 1 .5-.5h3zm-3-1A1.5 1.5 0 0 0 5 1.5v1A1.5 1.5 0 0 04h3A1.5 1.5 0 0 0 11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3z'/></svg></i></button></div></div>";
            }
          }
        }
      },
      {
        "targets"   : [ 20, 21],
        "orderable" : false
      }
    ],
    "order": [[7, 'asc'],[4, 'asc']]
  });
});     

///:::::::::  EVENTO BOTON MOSTRAR NOVEDADES  ::::::::::///
$(document).on("click", ".btnMostrarNovedadTroncal", function(){
  fila = $(this).closest('tr'); 
  ControlFacilitador_Id = fila.find('td:eq(0)').text();

  $('#btnAgregarNovedadTroncal').hide();
  $('#btn_logueo_troncal').hide();
  $('#btnAgregarPuntoFijoTroncal').hide();
  $('#btnEditarTroncal').hide();
  $("#formMostrarNovedadTroncal").trigger("reset");

  if (CFaRg_Estado=="CERRADO"){
    Accion='cambios_control_facilitador_hist';
  }else{
    Accion='CambiosControlFacilitador';
  }
  
  $.ajax({
    url: "Ajax.php",
    type: "POST",
    datatype:"json",    
    data: {MoS:MoS,NombreMoS:NombreMoS,Accion:Accion,ControlFacilitador_Id:ControlFacilitador_Id},    
    success: function(data){
      $('#div_MostrarNovedadTroncal').html(data);
    }
  });

  $(".modal-header").css( "background-color", "#17a2b8");
  $(".modal-header").css( "color", "white" );
  $(".modal-title").text("Novedades Troncal");
  $('#modalCRUDMostrarNovedadTroncal').modal('show');
});

///:::::::::  EVENTO BOTON MOSTRAR INCIDENTES  ::::::::::///
$(document).on("click", ".btnMostrarReporteTroncal", function(){
  fila = $(this).closest('tr'); 
  ControlFacilitador_Id = fila.find('td:eq(0)').text();
  let Repo_Descripcion = "";
  let Repo_BusCambio = "";
  let Repo_Motivo = "";
  let Repo_HoraSalida = "";
  let HoraSalida = "";
  let MinutoSalida = "";
  let Repo_Estado = "";
  let Repo_UsuarioId_Generar = "";
  let Repo_FechaGenerar = "";
  let Repo_UsuarioId_Edicion = "";
  let Repo_FechaEdicion = "";
  let Repo_UsuarioId_Cerrar = "";
  let Repo_FechaCerrar = "";

  $('#btnAgregarNovedadTroncal').hide();
  $('#btn_logueo_troncal').hide();
  $('#btnAgregarPuntoFijoTroncal').hide();
  $('#btnEditarTroncal').hide();
  $("#formMostrarReporteTroncal").trigger("reset");

  Accion='ListarReporte';
  $.ajax({
    url: "Ajax.php",
    type: "POST",
    datatype:"json",    
    async: false,    
    data: {MoS:MoS,NombreMoS:NombreMoS,Accion:Accion,ControlFacilitador_Id:ControlFacilitador_Id},    
    success: function(data){
      data = $.parseJSON(data);
      $.each(data, function(idx, obj){ 
        Repo_Descripcion = obj.Repo_Descripcion;
        Repo_BusCambio = obj.Repo_BusCambio;
        Repo_Motivo = obj.Repo_Motivo;
        Repo_HoraSalida = obj.Repo_HoraSalida;
        HoraSalida = Repo_HoraSalida.substring(0,2);;
        MinutoSalida = Repo_HoraSalida.substring(3,5);
        Repo_Estado = obj.Repo_Estado;
        Repo_UsuarioId_Generar = obj.Repo_UsuarioCrear;
        Repo_FechaGenerar = obj.Repo_FechaCrear;
        Repo_UsuarioId_Edicion = obj.Repo_UsuarioEditar;
        Repo_FechaEdicion = obj.Repo_FechaEditar;
        Repo_UsuarioId_Cerrar = obj.Repo_UsuarioAtender;
        Repo_FechaCerrar = obj.Repo_FechaAtender;
      });
      }
  });

  $(".modal-header").css( "background-color", "#17a2b8");
  $(".modal-header").css( "color", "white" );
  $(".modal-title").text( "Reportes Troncal" );
  $("#Repo_Descripcion").val(Repo_Descripcion);
  $("#Repo_BusCambio").val(Repo_BusCambio);
  $("#HoraSalida").val(HoraSalida);
  $("#MinutoSalida").val(MinutoSalida);
  $("#Repo_Motivo").val(Repo_Motivo);
  $("#Repo_Estado").val(Repo_Estado);
  $("#Repo_UsuarioId_Generar").val(Repo_UsuarioId_Generar);
  $("#Repo_FechaGenerar").val(Repo_FechaGenerar);
  $("#Repo_UsuarioId_Edicion").val(Repo_UsuarioId_Edicion);
  $("#Repo_FechaEdicion").val(Repo_FechaEdicion);
  $("#Repo_UsuarioId_Cerrar").val(Repo_UsuarioId_Cerrar);
  $("#Repo_FechaCerrar").val(Repo_FechaCerrar);
  
  if(Repo_Estado == "ATENDIDO"){
    $("#btnAtendidoReporteTroncal").prop("hidden",true);
  }else{
    $("#btnAtendidoReporteTroncal").prop("hidden",false);
  }

  $('#modalCRUDMostrarReporteTroncal').modal('show');
});


///::::::::::::::::::::::::: FUNCIONES TRONCAL ::::::::::::::::::::::::::::::::::::::::::///

///::::::: FUNCION PARA VALIDAR LOS DATOS INGRESADOS AL FORMULARIO :::::::::::::::::::///
function f_ValidarNuevaNovedadTroncal(pNove_NovedadTroncal, pNove_TipoNovedadTroncal, pNove_DetalleNovedadTroncal, pNove_DescripcionNovedadTroncal, pNove_LugarExactoTroncal,pNove_HoraInicioTroncal, pNove_HoraFinTroncal){
  NoLetrasMayuscEspacio=/[^A-Z \Ñ]/;
  let rptaValidarNuevaNovedadTroncal="";    
  let thora, tminuto, thoraini, thorafin;

  if(pNove_NovedadTroncal==""){
    $("#Nove_NovedadTroncal").addClass("color-error");
    rptaValidarNuevaNovedadTroncal="invalido";
  }

  if(pNove_TipoNovedadTroncal==""){
    $("#Nove_TipoNovedadTroncal").addClass("color-error");
    rptaValidarNuevaNovedadTroncal="invalido";
  }

  if(pNove_DetalleNovedadTroncal==""){
    $("#Nove_DetalleNovedadTroncal").addClass("color-error");
    rptaValidarNuevaNovedadTroncal="invalido";
  }

  if(pNove_DescripcionNovedadTroncal=="" || pNove_DescripcionNovedadTroncal.length>1500){
    $("#Nove_DescripcionNovedadTroncal").addClass("color-error");
    rptaValidarNuevaNovedadTroncal="invalido";
  }

  if(pNove_LugarExactoTroncal==""){
    $("#Nove_LugarExactoTroncal").addClass("color-error");
    rptaValidarPuntoFijoTroncal="invalido";
  }

  if(pNove_HoraInicioTroncal==""){
    $("#HoraInicioTroncal").addClass("color-error");
    $("#MinutoInicioTroncal").addClass("color-error");
    rptaValidarNuevaNovedadTroncal="invalido";
  }

  if(pNove_HoraFinTroncal==""){
    $("#HoraFinTroncal").addClass("color-error");
    $("#MinutoFinTroncal").addClass("color-error");
    rptaValidarNuevaNovedadTroncal="invalido";
  }

  // Cambiamos formato string a formato date para comparar
  thora = pNove_HoraInicioTroncal.substring(0,2);
  tminuto = pNove_HoraInicioTroncal.substring(3,5);
  thoraini = new Date("0","0","0",thora,tminuto);
  thora = pNove_HoraFinTroncal.substring(0,2);
  tminuto = pNove_HoraFinTroncal.substring(3,5);
  thorafin = new Date("0","0","0",thora,tminuto);

  if(thoraini > thorafin){
    $("#HoraInicioTroncal").addClass("color-error");
    $("#MinutoInicioTroncal").addClass("color-error");
    rptaValidarNuevaNovedadTroncal="invalido";
  }

  return rptaValidarNuevaNovedadTroncal; 
}


function f_ValidarTroncal(pProg_NombreColaborador, pProg_Bus, pProg_TipoEvento, pProg_HoraOrigen, pProg_HoraDestino, pProg_LugarOrigen, pProg_LugarDestino, pProg_ServBus, pProg_Servicio, pProg_Sentido, pProg_KmXPuntos, pProg_Tabla, pProg_BusManto, pProg_IdManto, pProg_Observaciones){
  NoLetrasMayuscEspacio=/[^A-Z \Ñ]/;
  let respuestaTroncal="";
  let thora, tminuto, thoraini, thorafin;
   
  /* if(pProg_NombreColaborador=="" || NoLetrasMayuscEspacio.test(pProg_NombreColaborador) ||  pProg_NombreColaborador>60){
    $("#Prog_NombreColaborador").addClass("color-error");
    respuestaTroncal="invalido";
  } */

  /* if(nOpcionGrabarTroncal!=1){ // Cuando se crea no es necesario ingresar el numero de bus
    if(pProg_Bus=="" || isNaN(pProg_Bus) ||  pProg_Bus.length!=5){
      $("#Prog_Bus").addClass("color-error");
      respuestaTroncal="invalido";
    }
  } */

  if(pProg_TipoEvento==""){
    $("#Prog_TipoEvento").addClass("color-error");
    respuestaTroncal="invalido";
  }
  
  if(pProg_HoraOrigen==""){
    $("#HoraOrigen").addClass("color-error");
    $("#MinutoOrigen").addClass("color-error");
    respuestaTroncal="invalido";
  }
 
  if(pProg_HoraDestino==""){
    $("#HoraDestino").addClass("color-error");
    $("#MinutoDestino").addClass("color-error");
    respuestaTroncal="invalido";
  }

  // Cambiamos formato string a formato date para comparar
  thora = Prog_HoraOrigen.substring(0,2);
  tminuto = Prog_HoraOrigen.substring(3,5);
  thoraini = new Date("0","0","0",thora,tminuto);
  thora = Prog_HoraDestino.substring(0,2);
  tminuto = Prog_HoraDestino.substring(3,5);
  thorafin = new Date("0","0","0",thora,tminuto);

  if(thoraini > thorafin){
    $("#HoraOrigen").addClass("color-error");
    $("#MinutoOrigen").addClass("color-error");
    respuestaTroncal="invalido";
  }

  if(pProg_LugarOrigen==""){
    $("#Prog_LugarOrigen").addClass("color-error");
    respuestaTroncal="invalido";
  }

  if(pProg_LugarDestino==""){
    $("#Prog_LugarDestino").addClass("color-error");
    respuestaTroncal="invalido";
  }

  if(pProg_ServBus==""){
    $("#Prog_ServBus").addClass("color-error");
    respuestaTroncal="invalido";
  }

  if(pProg_Servicio==""){
    $("#Prog_Servicio").addClass("color-error");
    respuestaTroncal="invalido";
  }

  if(pProg_Sentido==""){
    $("#Prog_Sentido").addClass("color-error");
    respuestaTroncal="invalido";
  }

  if(pProg_KmXPuntos==""){
    $("#Prog_KmXPuntos").addClass("color-error");
    respuestaTroncal="invalido";
  }

  if(pProg_Tabla=="" || pProg_Tabla.length>45  ){
    $("#Prog_Tabla").addClass("color-error");
    respuestaTroncal="invalido";
  }

/*  if(pProg_BusManto==""){
    $("#Prog_BusManto").addClass("color-error");
    respuestaTroncal="invalido";
  }*/

  if(pProg_IdManto==""){
    $("#Prog_IdManto").addClass("color-error");
    respuestaTroncal="invalido";
  }

/*  if(pProg_Observaciones==""){
    $("#Prog_Observaciones").addClass("color-error");
    respuestaTroncal="invalido";
  }*/

  return respuestaTroncal; 
}

function f_ValidarEditarTotalTroncal(pProg_IdManto1,pProg_BusTroncal2){
  NoLetrasMayuscEspacio=/[^A-Z \Ñ]/;
  let respuestaTroncal="";

  if(pProg_IdManto1!="" || pProg_BusTroncal2!=""){
    if(pProg_IdManto1=="" || isNaN(pProg_IdManto1)){
      $("#Prog_IdManto1").addClass("color-error");
      respuestaTroncal="invalido";
    }
    if(pProg_BusTroncal2=="" || isNaN(pProg_BusTroncal2) ||  pProg_BusTroncal2.length!=5){
      $("#Prog_BusTroncal2").addClass("color-error");
      respuestaTroncal="invalido";
    }
/*    if(pProg_BusTroncal1==pProg_BusTroncal2){
      $("#Prog_BusTroncal2").addClass("color-error");
      respuestaTroncal="invalido";
    }*/
  }
  return respuestaTroncal; 
}

///::::::::: INVISIBILIZA LOS MENSAJE DE ALERTA DEL FORMULARIO :::::: /// 
function LimpiaMsControlFacilitadorTroncal(){
  $("#Prog_NombreColaborador").removeClass("color-error");
  $("#Prog_Bus").removeClass("color-error");
  $("#Prog_TipoEvento").removeClass("color-error");
  $("#HoraOrigen").removeClass("color-error");
  $("#MinutoOrigen").removeClass("color-error");
  $("#HoraDestino").removeClass("color-error");
  $("#MinutoDestino").removeClass("color-error");
  $("#Prog_LugarOrigen").removeClass("color-error");
  $("#Prog_LugarDestino").removeClass("color-error");
  $("#Prog_ServBus").removeClass("color-error");
  $("#Prog_Servicio").removeClass("color-error");
  $("#Prog_Sentido").removeClass("color-error");
  $("#Prog_KmXPuntos").removeClass("color-error");
  $("#Prog_Tabla").removeClass("color-error");
  $("#Prog_BusManto").removeClass("color-error");
  $("#Prog_IdManto").removeClass("color-error");
  $("#Prog_Observaciones").removeClass("color-error");
  
  $("#Nove_NovedadTroncal").removeClass("color-error");
  $("#Nove_TipoNovedadTroncal").removeClass("color-error");
  $("#Nove_DetalleNovedadTroncal").removeClass("color-error");
  $("#Nove_DescripcionNovedadTroncal").removeClass("color-error");
  $("#Nove_LugarExactoTroncal").removeClass("color-error");
  $("#HoraInicioTroncal").removeClass("color-error");
  $("#MinutoInicioTroncal").removeClass("color-error");
  $("#HoraFinTroncal").removeClass("color-error");
  $("#MinutoFinTroncal").removeClass("color-error");
  
  $("#Prog_IdManto1").removeClass("color-error");
  $("#Prog_BusTroncal2").removeClass("color-error");
}

//:::: VALIDAR SI EXISTEN NOVEDADES REGISTRADOS ::::://
function ValidarNovedadTroncal(Validar_Fecha,Validar_Operacion){
  let RptaNovedad = ""; // "NO NOVEDADES" o "SI NOVEDADES"
  Accion='ValidarNovedad';
  $.ajax({
    url: "Ajax.php",
    type: "POST",
    datatype:"json",
    async: false,    
    data: {MoS:MoS,NombreMoS:NombreMoS,Accion:Accion,Prog_Fecha:Validar_Fecha,Prog_Operacion:Validar_Operacion},    
    success: function(data){
      RptaNovedad = data;
    }
  });
  if(RptaNovedad=="SI NOVEDADES"){
    $("#btn_AsociarNovedadTroncal").prop("disabled",false);
    $("#label_AsociarNovedadTroncal").prop("title","");
  }else{
    $("#btn_AsociarNovedadTroncal").prop("disabled",true);
    $("#label_AsociarNovedadTroncal").prop("title","No Existen Novedades")
  }
  $("#btn_NuevaNovedadTroncal").attr("checked",true);
  $("#btn_AsociarNovedadTroncal").attr("checked",false);
  return RptaNovedad;
}

//:::: HABILITAR O DESHABILITAR LA EDICION DE LOS CAMPOS ::::://
function fEdicionCamposTroncal(tOpcion,bValor){
  $("#Prog_NombreColaborador").prop(tOpcion, bValor);
  $("#Prog_Tabla").prop(tOpcion, bValor);
  $("#Prog_HoraOrigen").prop(tOpcion, bValor);
  $("#Prog_HoraDestino").prop(tOpcion, bValor);
  $("#Prog_Servicio").prop(tOpcion, bValor);
  $("#Prog_ServBus").prop(tOpcion, bValor);
  $("#Prog_Bus").prop(tOpcion, bValor);
  $("#Prog_LugarOrigen").prop(tOpcion, bValor);
  $("#Prog_LugarDestino").prop(tOpcion, bValor);
  $("#Prog_TipoEvento").prop(tOpcion, bValor);
  $("#Prog_KmXPuntos").prop(tOpcion, bValor);
  $("#Prog_Sentido").prop(tOpcion, bValor);
  $("#Prog_BusManto").prop(tOpcion, bValor);
  $("#Prog_IdManto").prop(tOpcion, bValor);
  $("#Prog_Observaciones").prop(tOpcion, bValor);
  $("#HoraOrigen").prop(tOpcion, bValor);
  $("#MinutoOrigen").prop(tOpcion, bValor);
  $("#HoraDestino").prop(tOpcion, bValor);
  $("#MinutoDestino").prop(tOpcion, bValor);
}

function fColorFilasControlFacilitadorTroncal(row,data){
  let color_rojo = "#E26A5A";
  let color_verde = "#009390";
  let color_azul = "#005EA4";
  let color_amarillo = "#ffff006b";
  // Columna TipoTabla
  if(data.Prog_TipoTabla == 'AM') {
    $("td:eq(14)",row).css({
      "color":color_azul,
    });
    $("td:eq(1)",row).css({
      "color":color_azul,
    });
    $("td:eq(2)",row).css({
      "color":color_azul,
    });
  }
  if(data.Prog_TipoTabla == 'HP') {
    $("td:eq(14)",row).css({
      "color":color_rojo,
    });
    $("td:eq(1)",row).css({
      "color":color_rojo,
    });
    $("td:eq(2)",row).css({
      "color":color_rojo,
    });
  }
  // Columnas de Lugar de Origen y Destino
  if(data.Prog_Sentido=='NS' || data.Prog_Sentido=='NS-AM' || data.Prog_Sentido=='NS-PM'){
    if(data.Prog_LugarOrigen != 'PATIO NORTE'){
      $("td:eq(9)",row).css({
        "color":color_verde,
      });
    }
    if(data.Prog_LugarDestino != 'PATIO NORTE'){
      $("td:eq(10)",row).css({
        "color":color_rojo,
      });
    }
  }
  if(data.Prog_Sentido=='SN' || data.Prog_Sentido=='SN-AM' || data.Prog_Sentido=='SN-PM'){
    if(data.Prog_LugarOrigen != 'PATIO NORTE'){
      $("td:eq(9)",row).css({
        "color":color_rojo,
      });
    }
    if(data.Prog_LugarDestino != 'PATIO NORTE'){
      $("td:eq(10)",row).css({
        "color":color_verde,
      });
    }
  }
  // Columna Tipo Evento
  if(data.Prog_TipoEvento=='INICIO AUTOBUS' || data.Prog_TipoEvento=='FIN AUTOBUS'){
    $("td:eq(11)",row).css({
      "font_weight":"bold",
    });
  }

  // Columnas de ServBus, Bus, Placa y VID
  if(data.Prog_colBus == 0){
    $("td:eq(7)",row).css({
      "color":color_verde,
    });
    $("td:eq(8)",row).css({
      "color":color_verde,
    });
    $("td:eq(15)",row).css({
      "color":color_verde,
    });
  }
  if(data.Prog_colBus == 1){
    $("td:eq(7)",row).css({
      "color":color_azul,
    });
    $("td:eq(8)",row).css({
      "color":color_azul,
    });
    $("td:eq(15)",row).css({
      "color":color_azul,
    });
  }
  // Columna de Tabla y Servicio
  if(data.Prog_colTabla == 0){
    $("td:eq(3)",row).css({
      "color":color_azul,
    });
    $("td:eq(6)",row).css({
      "color":color_azul,
    });
  }else{
    $("td:eq(3)",row).css({
      "color":color_verde,
    });
    $("td:eq(6)",row).css({
      "color":color_verde,
    });
  }
  // Columna de Evento
  if(data.Prog_TipoEvento=="ANULADO"){
    $("td:eq(0)",row).css({"background":color_amarillo,});
    $("td:eq(1)",row).css({"background":color_amarillo,});
    $("td:eq(2)",row).css({"background":color_amarillo,});
    $("td:eq(3)",row).css({"background":color_amarillo,});
    $("td:eq(4)",row).css({"background":color_amarillo,});
    $("td:eq(5)",row).css({"background":color_amarillo,});
    $("td:eq(6)",row).css({"background":color_amarillo,});
    $("td:eq(7)",row).css({"background":color_amarillo,});
    $("td:eq(8)",row).css({"background":color_amarillo,});
    $("td:eq(9)",row).css({"background":color_amarillo,});
    $("td:eq(10)",row).css({"background":color_amarillo,});
    $("td:eq(11)",row).css({"background":color_amarillo,});
    $("td:eq(12)",row).css({"background":color_amarillo,});
    $("td:eq(13)",row).css({"background":color_amarillo,});
    $("td:eq(14)",row).css({"background":color_amarillo,});
    $("td:eq(15)",row).css({"background":color_amarillo,});
    $("td:eq(16)",row).css({"background":color_amarillo,});
    $("td:eq(17)",row).css({"background":color_amarillo,});
    $("td:eq(18)",row).css({"background":color_amarillo,});
    $("td:eq(19)",row).css({"background":color_amarillo,});
    $("td:eq(20)",row).css({"background":color_amarillo,});
    $("td:eq(21)",row).css({"background":color_amarillo,});
  }
}

function f_CargaVariablesFilaTroncal(){
  ControlFacilitador_Id   = fila.find('td:eq(0)').text();
  Prog_NombreColaborador  = fila.find('td:eq(2)').text();
  Prog_Tabla              = fila.find('td:eq(3)').text();
  Prog_HoraOrigen         = fila.find('td:eq(4)').text();
  Prog_HoraDestino        = fila.find('td:eq(5)').text();
  Prog_Servicio           = fila.find('td:eq(6)').text();
  Prog_ServBus            = fila.find('td:eq(7)').text();
  Prog_Bus                = fila.find('td:eq(8)').text();
  Prog_LugarOrigen        = fila.find('td:eq(9)').text();
  Prog_LugarDestino       = fila.find('td:eq(10)').text();
  Prog_TipoEvento         = fila.find('td:eq(11)').text();
  Prog_Observaciones      = fila.find('td:eq(12)').text();
  Prog_KmXPuntos          = fila.find('td:eq(13)').text();
  Prog_Sentido            = fila.find('td:eq(15)').text();
  Prog_BusManto           = fila.find('td:eq(16)').text();
  Prog_IdManto            = fila.find('td:eq(17)').text();
  
  HoraOrigen              = Prog_HoraOrigen.substring(0,2);
  MinutoOrigen            = Prog_HoraOrigen.substring(3,5);
  HoraDestino             = Prog_HoraDestino.substring(0,2);
  MinutoDestino           = Prog_HoraDestino.substring(3,5);

  Nove_LugarExactoTroncal = Prog_LugarOrigen;
  HoraInicioTroncal       = HoraOrigen; 
  MinutoInicioTroncal     = MinutoOrigen;
}

function f_CargaVariablesVacioTroncal(){
  Prog_NombreColaborador = "";
  Prog_Tabla = "";
  Prog_HoraOrigen = "";
  Prog_HoraDestino = "";
  Prog_Servicio = "";
  Prog_ServBus = "";
  Prog_Bus = "";
  Prog_LugarOrigen = "";
  Prog_LugarDestino = "";
  Prog_TipoEvento = "";
  Prog_KmXPuntos = "0";
  Prog_Sentido = "";
  Prog_BusManto = "";
  Prog_IdManto = "";
  Prog_Observaciones = "";
  HoraOrigen = "";
  MinutoOrigen = "";
  HoraDestino = "";
  MinutoDestino = "";

  Nove_LugarExactoTroncal = "";
  HoraInicioTroncal = ""; 
  MinutoInicioTroncal = "";
}

function f_CargaVariablesHtmlVacioTroncal(){
  document.getElementById("Prog_NombreColaborador").placeholder = "";
  document.getElementById("Prog_Tabla").placeholder = "";
  document.getElementById("Prog_Servicio").placeholder = "";
  document.getElementById("Prog_ServBus").placeholder = "";
  document.getElementById("Prog_Bus").placeholder = "";
  document.getElementById("Prog_LugarOrigen").placeholder = "";
  document.getElementById("Prog_LugarDestino").placeholder = "";
  document.getElementById("Prog_TipoEvento").placeholder = "";
  document.getElementById("Prog_KmXPuntos").placeholder = "";
  document.getElementById("Prog_Sentido").placeholder = "";
  document.getElementById("Prog_BusManto").placeholder = "";
  document.getElementById("Prog_IdManto").placeholder = "";
  document.getElementById("Prog_Observaciones").placeholder = "";
  document.getElementById("HoraOrigen").placeholder = "";
  document.getElementById("MinutoOrigen").placeholder = "";
  document.getElementById("HoraDestino").placeholder = "";
  document.getElementById("MinutoDestino").placeholder = "";
  
  document.getElementById("Nove_LugarExactoTroncal").placeholder = "";
  document.getElementById("HoraInicioTroncal").placeholder = "";
  document.getElementById("MinutoInicioTroncal").placeholder = "";
}

function f_CargaVariablesHtmlDataTroncal(){
  $("#Prog_NombreColaborador").val(Prog_NombreColaborador);
  $("#Prog_Tabla").val(Prog_Tabla);
  $("#Prog_HoraOrigen").val(Prog_HoraOrigen);
  $("#Prog_HoraDestino").val(Prog_HoraDestino);
  $("#Prog_Servicio").val(Prog_Servicio);
  $("#Prog_ServBus").val(Prog_ServBus);
  $("#Prog_Bus").val(Prog_Bus);
  $("#Prog_LugarOrigen").val(Prog_LugarOrigen);
  $("#Prog_LugarDestino").val(Prog_LugarDestino);
  $("#Prog_TipoEvento").val(Prog_TipoEvento);
  $("#Prog_KmXPuntos").val(Prog_KmXPuntos);
  $("#Prog_Sentido").val(Prog_Sentido);
  $("#Prog_BusManto").val(Prog_BusManto);
  $("#Prog_IdManto").val(Prog_IdManto);
  $("#Prog_Observaciones").val(Prog_Observaciones);
  $("#HoraOrigen").val(HoraOrigen);
  $("#MinutoOrigen").val(MinutoOrigen);
  $("#HoraDestino").val(HoraDestino);
  $("#MinutoDestino").val(MinutoDestino);

  $("#Nove_LugarExactoTroncal").val(Nove_LugarExactoTroncal);
  $("#HoraInicioTroncal").val(HoraInicioTroncal);
  $("#MinutoInicioTroncal").val(MinutoInicioTroncal);
  $("#HoraFinTroncal").val(HoraInicioTroncal);
  $("#MinutoFinTroncal").val(MinutoInicioTroncal);
}

function f_CargaVariablesHtmlTextoTroncal(xtexto){
  document.getElementById("Prog_NombreColaborador").placeholder = xtexto;
  document.getElementById("Prog_Tabla").placeholder = xtexto;
  document.getElementById("Prog_Servicio").placeholder = xtexto;
  document.getElementById("Prog_ServBus").placeholder = xtexto;
  document.getElementById("Prog_Bus").placeholder = xtexto;
  document.getElementById("Prog_LugarOrigen").placeholder = xtexto;
  document.getElementById("Prog_LugarDestino").placeholder = xtexto;
  document.getElementById("Prog_TipoEvento").placeholder = xtexto;
  document.getElementById("Prog_KmXPuntos").placeholder = xtexto;
  document.getElementById("Prog_Sentido").placeholder = xtexto;
  document.getElementById("Prog_BusManto").placeholder = xtexto;
  document.getElementById("Prog_IdManto").placeholder = xtexto;
  document.getElementById("Prog_Observaciones").placeholder = xtexto;
  document.getElementById("HoraOrigen").placeholder = "";
  document.getElementById("MinutoOrigen").placeholder = "";
  document.getElementById("HoraDestino").placeholder = "";
  document.getElementById("MinutoDestino").placeholder = "";

  document.getElementById("Nove_LugarExactoTroncal").placeholder = "";
  document.getElementById("HoraInicioTroncal").placeholder = "";
  document.getElementById("MinutoInicioTroncal").placeholder = "";
}
  