///::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
///:: TAB ALIMENTADOR v 4.0 FECHA: 22-07-2022 :::::::::::::::::::::::::::::::::::::::::::::///
///:: CREAR NOVEDADES, EDITAR CONTROL FACILITADOR ALIMENTADOR::::::::::::::::::::::::::::::///
///::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///

///::::::::::::::::::::::::::::::: Declaracion de Variables :::::::::::::::::::::::::::::::///

var adataAlimentador = [];
var filaAlimentador,ControlFacilitador_IdAlimentador,indexAlimentador,nOpcionGrabarAlimentador,selectHtmlAlimentador,ViajesCanceladosAlimentador;
var Prog_FechaAlimentador,Prog_OperacionAlimentador,CFaRg_EstadoAlimentador;
var NovedadAlimentador_Id, bValidarNovedadAlimentador, btnOpcionNovedadAlimentador, selectNovedadIdAlimentador;
var Prog_NombreColaboradorAlimentador, Prog_TablaAlimentador, Prog_HoraOrigenAlimentador, Prog_HoraDestinoAlimentador, Prog_ServicioAlimentador, Prog_ServBusAlimentador,Prog_BusAlimentador, Prog_LugarOrigenAlimentador, Prog_LugarDestinoAlimentador, Prog_TipoEventoAlimentador, Prog_KmXPuntosAlimentador, Prog_SentidoAlimentador, Prog_BusMantoAlimentador, Prog_IdMantoAlimentador, Prog_ObservacionesAlimentador, Prog_FechaAlimentador,  Nove_NovedadAlimentador, Nove_TipoNovedadAlimentador, Nove_DetalleNovedadAlimentador, Nove_DescripcionNovedadAlimentador, Nove_LugarExactoAlimentador,Nove_HoraInicioAlimentador, Nove_HoraFinAlimentador, Nove_TipoOrigenAlimentador;
var HoraOrigenAlimentador, MinutoOrigenAlimentador, HoraDestinoAlimentador, MinutoDestinoAlimentador, HoraInicioAlimentador, MinutoInicioAlimentador, Prog_IdMantoAlimentador1, Prog_BusAlimentador2;

//Inicializar Variables
Prog_OperacionAlimentador = "ALIMENTADOR";
Nove_TipoOrigenAlimentador = "";
ViajesCanceladosAlimentador = "SI";

///::::::::::::::::::::::::: DOM ALIMENTADOR :::::::::::::::::::::::::::::::::::::::::::::::::///

$(document).ready(function()
{
  xam = '0'+(fecha_hoy.getMonth()+1);
  xad = '0'+fecha_hoy.getDate();
  Prog_FechaAlimentador = fecha_hoy.getFullYear()+'-'+xam.substr(-2)+'-'+xad.substr(-2);
  $("#Prog_FechaAlimentador").val(Prog_FechaAlimentador);

  ///:: CARGAMOS LOS BUSES
  $( function() {
    t_autocompletar = f_auto_completar("Buses","Bus_NroExterno");
    $( "#bus_alimentador" ).autocomplete({
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
  div_boton = f_BotonesFormulario("formSeleccionAlimentador","navbarNavDropdownAlimentador");
  $("#div_navbarNavDropdownAlimentador").html(div_boton);

  div_tablas = f_CreacionTabla("tablaControlFacilitadorAlimentador","");
  $('#div_tablaControlFacilitadorAlimentador').html(div_tablas);

  // Setup - add a text input to each footer cell
  $('#tablaControlFacilitadorAlimentador thead tr')
    .clone(true)
    .addClass('filtersAlimentador')
    .appendTo('#tablaControlFacilitadorAlimentador thead');

  //Selecciona las filas a editar
  $('#tablaControlFacilitadorAlimentador tbody').on( 'click', 'tr', function () {
    $(this).toggleClass('selected');
    // Cero filas seleccionadas
    if(tablaControlFacilitadorAlimentador.rows('.selected').data().length===0){
        adataAlimentador = [];
    }
   
    // Una fila seleccionada
    if(tablaControlFacilitadorAlimentador.rows('.selected').data().length===1){
      adataAlimentador = [];

      filaAlimentador = $(this).closest("tr");	        
      ControlFacilitador_IdAlimentador = filaAlimentador.find('td:eq(0)').text();
      indexAlimentador = $.inArray(ControlFacilitador_IdAlimentador, adataAlimentador);
      if ( indexAlimentador === -1 ) {
          adataAlimentador.push( ControlFacilitador_IdAlimentador );
      } else {
          adataAlimentador.splice( indexAlimentador, 1 );
      }
    }

    // Mas de una fila seleccionada
    if(tablaControlFacilitadorAlimentador.rows('.selected').data().length>1){
      // Se valida si se presiona la tecla control
      if (isKeyPressed(event)){

      }else{
        adataAlimentador = [];
      }
      filaAlimentador = $(this).closest("tr");	        
      ControlFacilitador_IdAlimentador = filaAlimentador.find('td:eq(0)').text();
      indexAlimentador = $.inArray(ControlFacilitador_IdAlimentador, adataAlimentador);
      if ( indexAlimentador === -1 ) {
        adataAlimentador.push( ControlFacilitador_IdAlimentador );
      } else {
        adataAlimentador.splice( indexAlimentador, 1 );
      }
    }

    // Si no hay filas seleccionadas se oculta el boton editar
    if (adataAlimentador.length > 0) {
      if (CFaRg_EstadoAlimentador=="GENERADO"){
        bValidarNovedadAlimentador = ValidarNovedadAlimentador(Prog_FechaAlimentador,Prog_OperacionAlimentador);
        $('#btnEditarAlimentador').hide();
        $('#btnAgregarNovedadAlimentador').hide();  
        $('#btn_logueo_alimentador').hide();  
        $('#btnAgregarPuntoFijoAlimentador').hide();
        if(bValidarNovedadAlimentador=="SI NOVEDADES"){
          $('#btnEditarAlimentador').show();
          $('#btnEditarTotalAlimentador').show();
        }
        if(adataAlimentador.length == 1){
          $('#btnAgregarNovedadAlimentador').show();
          $('#btn_logueo_alimentador').show();  
          $('#btnAgregarPuntoFijoAlimentador').show();
        }
      }
    }else{$
      $('#btnAgregarNovedadAlimentador').hide();
      $('#btn_logueo_alimentador').hide();  
      $('#btnAgregarPuntoFijoAlimentador').hide();
      $('#btnEditarAlimentador').hide();
      if(bValidarNovedadAlimentador=="SI NOVEDADES"){
        $('#btnEditarTotalAlimentador').show();
      }
    }
  });

  // Oculta botones nuevo, editar y datatable
  $('#btnViajeAlimentador').hide();
  $('#btnEditarTotalAlimentador').hide();
  $('#btnAgregarNovedadAlimentador').hide();
  $('#btn_logueo_alimentador').hide();  
  $('#btnEditarAlimentador').hide();
  $('#btnAgregarPuntoFijoAlimentador').hide();
  $('#btnResumenAlimentador').hide();
  $('#btnInconsistenciasAlimentador').hide();
  $("#tablaControlFacilitadorAlimentador").dataTable().fnDestroy();
  $('#tablaControlFacilitadorAlimentador').hide();  

  // Si hay cambios en el Fecha se ocultan botones y datatable
  $("#Prog_FechaAlimentador").on('change', function () {
    $('#btnViajeAlimentador').hide(); // desahabilita boton nuevo
    $('#btnEditarTotalAlimentador').hide();
    $('#btnAgregarNovedadAlimentador').hide();
    $('#btn_logueo_alimentador').hide();  
    $('#btnEditarAlimentador').hide();
    $('#btnAgregarPuntoFijoAlimentador').hide();
    $('#btnResumenAlimentador').hide();
    $('#btnInconsistenciasAlimentador').hide();
    $("#tablaControlFacilitadorAlimentador").dataTable().fnDestroy();
    $('#tablaControlFacilitadorAlimentador').hide();  
  });

  // Si hay cambios en el select de Novedades
  $("#selectNovedadIdAlimentador").on('change', function () {
    selectNovedadIdAlimentador = $(this).val();
    Accion='ListarNovedad';
    $.ajax({
      url: "Ajax.php",
      type: "POST",
      datatype:"json",    
      data: {MoS:MoS,NombreMoS:NombreMoS,Accion:Accion,OPE_NovedadId:selectNovedadIdAlimentador},
      success: function(data){
        data = $.parseJSON(data);
        tableNovedadAlimentador = "";
        $.each(data, function(idx, obj){ 
          $("#t_NovedadIdAlimentador").val(obj.Novedad_Id);
          $("#t_NovedadAlimentador").val(obj.Nove_Novedad);
          $("#t_TipoNovedadAlimentador").val(obj.Nove_TipoNovedad);
          $("#t_DetalleNovedadAlimentador").val(obj.Nove_DetalleNovedad);          
          $("#t_DescripcionNovedadAlimentador").val(obj.Nove_Descripcion);
        });
      }
    });
  });

  // Si hay cambios en la NOVEDAD
  $("#Nove_NovedadAlimentador").on('change', function () {
    Tipo=$("#Nove_NovedadAlimentador").val();
    selectHtmlAlimentador="";
    selectHtmlAlimentador = f_TipoTabla(Prog_OperacionAlimentador,Tipo)
    $("#Nove_TipoNovedadAlimentador").html(selectHtmlAlimentador);
    thtmlAlimentador = '<option value="">Seleccione una opcion</option>';
    $("#Nove_DetalleNovedadAlimentador").html(thtmlAlimentador);
  });
 
  // Si hay cambios en Tipo de Novedad
  $("#Nove_TipoNovedadAlimentador").on('change', function () {
    Tipo=Tipo=$("#Nove_TipoNovedadAlimentador").val();
    selectHtmlAlimentador="";
    selectHtmlAlimentador = f_TipoTabla(Prog_OperacionAlimentador,Tipo)
    $("#Nove_DetalleNovedadAlimentador").html(selectHtmlAlimentador);
  });
  
  // Si hay cambios en Detalle de Novedad
  $("#Nove_DetalleNovedadAlimentador").on('change', function () {
    Accion='BuscarDescripcionNovedad';
    Tipo=$("#Nove_DetalleNovedadAlimentador").val();
    $.ajax({
      url: "Ajax.php",
      type: "POST",
      datatype:"json",    
      data: {MoS:MoS,NombreMoS:NombreMoS,Accion:Accion,Prog_Operacion:Prog_Operacion,Tipo:Tipo},    
      success: function(data){
        $("#Nove_DescripcionNovedadAlimentador").val(data);
      }
    });
  });

  // Calculo de Km Recorridos
  $("#Prog_SentidoAlimentador").on('change', function () {
    Prog_KmXPuntosAlimentador = f_KmRecorridos( Prog_OperacionAlimentador, $("#Prog_SentidoAlimentador").val(), $("#Prog_ServicioAlimentador").val(), $("#Prog_LugarOrigenAlimentador").val(), $("#Prog_LugarDestinoAlimentador").val() );
    $("#Prog_KmXPuntosAlimentador").val(Prog_KmXPuntosAlimentador);
  });

  $("#Prog_ServicioAlimentador").on('change', function () {
    Prog_KmXPuntosAlimentador = f_KmRecorridos( Prog_OperacionAlimentador, $("#Prog_SentidoAlimentador").val(), $("#Prog_ServicioAlimentador").val(), $("#Prog_LugarOrigenAlimentador").val(), $("#Prog_LugarDestinoAlimentador").val() );
    $("#Prog_KmXPuntosAlimentador").val(Prog_KmXPuntosAlimentador);
  });

  $("#Prog_LugarOrigenAlimentador").on('change', function () {
    Prog_KmXPuntosAlimentador = f_KmRecorridos( Prog_OperacionAlimentador, $("#Prog_SentidoAlimentador").val(), $("#Prog_ServicioAlimentador").val(), $("#Prog_LugarOrigenAlimentador").val(), $("#Prog_LugarDestinoAlimentador").val() );
    $("#Prog_KmXPuntosAlimentador").val(Prog_KmXPuntosAlimentador);
  });

  $("#Prog_LugarDestinoAlimentador").on('change', function () {
    Prog_KmXPuntosAlimentador = f_KmRecorridos( Prog_OperacionAlimentador, $("#Prog_SentidoAlimentador").val(), $("#Prog_ServicioAlimentador").val(), $("#Prog_LugarOrigenAlimentador").val(), $("#Prog_LugarDestinoAlimentador").val() );
    $("#Prog_KmXPuntosAlimentador").val(Prog_KmXPuntosAlimentador);
  });

  // Si hay cambios en Viajes Cancelados
  $("#ViajesCanceladosAlimentador").on('change', function () {
    ViajesCanceladosAlimentador = document.getElementById("ViajesCanceladosAlimentador");
    $('#btnViajeAlimentador').hide(); // desahabilita boton nuevo
    $('#btnEditarTotalAlimentador').hide();
    $('#btnAgregarNovedadAlimentador').hide();
    $('#btn_logueo_alimentador').hide();  
    $('#btnEditarAlimentador').hide();
    $('#btnAgregarPuntoFijoAlimentador').hide();
    $('#btnInconsistenciasAlimentador').hide();
    $('#btnResumenAlimentador').hide();
    $("#tablaControlFacilitadorAlimentador").dataTable().fnDestroy();
    $('#tablaControlFacilitadorAlimentador').hide();  

    if (ViajesCanceladosAlimentador.checked == true){
      ViajesCanceladosAlimentador = "SI";
    }else{
      ViajesCanceladosAlimentador = "NO";
    }
  });


  /// ::::::::::::::: CREA Y EDITA FILAS DEL CONTROL FACILITADOR ALIMENTADOR :::::::::::::///
  $('#formControlFacilitadorAlimentador').submit(function(e){
    e.preventDefault(); //evita el comportambiento normal del submit, es decir, recarga total de la página
    vacioAlimentador = false;
    let tValidaNuevaNovedadAlimentador = "";
    let tValidaPuntoFijoAlimentador = "";
    let tValidaAlimentador = "";
    let tValidaEditarTotalAlimentador = "";
    let tValidaBusPilotoAlimentador = "";
    let horaAlimentador, minutoAlimentador;

    Prog_NombreColaboradorAlimentador = $.trim($('#Prog_NombreColaboradorAlimentador').val());
    Prog_TablaAlimentador = $.trim($('#Prog_TablaAlimentador').val());
    Prog_ServicioAlimentador = $.trim($('#Prog_ServicioAlimentador').val());
    Prog_ServBusAlimentador = $.trim($('#Prog_ServBusAlimentador').val());
    Prog_BusAlimentador = $.trim($('#Prog_BusAlimentador').val());
    Prog_LugarOrigenAlimentador = $.trim($('#Prog_LugarOrigenAlimentador').val());
    Prog_LugarDestinoAlimentador = $.trim($('#Prog_LugarDestinoAlimentador').val());
    Prog_TipoEventoAlimentador = $.trim($('#Prog_TipoEventoAlimentador').val());
    Prog_KmXPuntosAlimentador = $.trim($('#Prog_KmXPuntosAlimentador').val());
    Prog_SentidoAlimentador = $.trim($('#Prog_SentidoAlimentador').val());
    Prog_BusMantoAlimentador = $.trim($('#Prog_BusMantoAlimentador').val());
    Prog_IdMantoAlimentador = $.trim($('#Prog_IdMantoAlimentador').val());
    Prog_ObservacionesAlimentador = $.trim($('#Prog_ObservacionesAlimentador').val());
    Prog_FechaAlimentador = $("#Prog_FechaAlimentador").val();
    Nove_NovedadAlimentador = $.trim($('#Nove_NovedadAlimentador').val());
    Nove_TipoNovedadAlimentador = $.trim($('#Nove_TipoNovedadAlimentador').val());
    Nove_DetalleNovedadAlimentador = $.trim($('#Nove_DetalleNovedadAlimentador').val());
    Nove_DescripcionNovedadAlimentador = $.trim($('#Nove_DescripcionNovedadAlimentador').val());
    Nove_LugarExactoAlimentador = $.trim($('#Nove_LugarExactoAlimentador').val());
    Prog_IdMantoAlimentador1 = $.trim($('#Prog_IdMantoAlimentador1').val());
    Prog_BusAlimentador2 = $.trim($('#Prog_BusAlimentador2').val());

    Prog_HoraOrigenAlimentador = "";
    Prog_HoraDestinoAlimentador = "";
    horaAlimentador = $.trim($('#HoraOrigenAlimentador').val());
    minutoAlimentador = $.trim($('#MinutoOrigenAlimentador').val());
    if(horaAlimentador !="" && minutoAlimentador !=""){
      Prog_HoraOrigenAlimentador = horaAlimentador + ":" + minutoAlimentador;
    }
    horaAlimentador = $.trim($('#HoraDestinoAlimentador').val());
    minutoAlimentador = $.trim($('#MinutoDestinoAlimentador').val());
    if(horaAlimentador !="" && minutoAlimentador !=""){
      Prog_HoraDestinoAlimentador = horaAlimentador + ":" + minutoAlimentador;
    }

    Nove_HoraInicioAlimentador = "";
    Nove_HoraFinAlimentador = "";
    horaAlimentador = $.trim($('#HoraInicioAlimentador').val());
    minutoAlimentador = $.trim($('#MinutoInicioAlimentador').val());
    if(horaAlimentador !="" && minutoAlimentador !=""){
      Nove_HoraInicioAlimentador = horaAlimentador + ":" + minutoAlimentador;
    }
    horaAlimentador = $.trim($('#HoraFinAlimentador').val());
    minutoAlimentador = $.trim($('#MinutoFinAlimentador').val());
    if(horaAlimentador !="" && minutoAlimentador !=""){
      Nove_HoraFinAlimentador = horaAlimentador + ":" + minutoAlimentador;
    }
    LimpiaMsControlFacilitadorAlimentador();

    // CREAR
    if(nOpcionGrabarAlimentador == 1){
      tValidaNuevaNovedadAlimentador = f_ValidarNuevaNovedadAlimentador(Nove_NovedadAlimentador,Nove_TipoNovedadAlimentador,Nove_DetalleNovedadAlimentador,Nove_DescripcionNovedadAlimentador,Nove_LugarExactoAlimentador,Nove_HoraInicioAlimentador,Nove_HoraFinAlimentador);
      tValidaAlimentador = f_ValidarAlimentador(Prog_NombreColaboradorAlimentador, Prog_BusAlimentador, Prog_TipoEventoAlimentador, Prog_HoraOrigenAlimentador,Prog_HoraDestinoAlimentador,Prog_LugarOrigenAlimentador, Prog_LugarDestinoAlimentador, Prog_ServBusAlimentador, Prog_ServicioAlimentador, Prog_SentidoAlimentador, Prog_KmXPuntosAlimentador, Prog_TablaAlimentador, Prog_BusMantoAlimentador, Prog_IdMantoAlimentador, Prog_ObservacionesAlimentador);
      if(tValidaAlimentador=="invalido"){
        vacioAlimentador = true;
        Swal.fire({
          icon: 'error',
          title: 'INFORMACION ALIMENTADOR...',
          text: '*Falta completar información!'
        })
      }
      if(btnOpcionNovedadAlimentador==""){
        vacioAlimentador = true;
        Swal.fire({
          icon: 'error',
          title: 'NOVEDADES...',
          text: '*Debe seleccionar el tipo de Novedad!'
        })
      }
      if(tValidaNuevaNovedadAlimentador=="invalido" && btnOpcionNovedadAlimentador=="NuevaNovedad"){
        vacioAlimentador = true;
        Swal.fire({
          icon: 'error',
          title: 'NOVEDADES...',
          text: '*NO se han generado Novedades!'
        })
      }
      if(selectNovedadIdAlimentador=="" && btnOpcionNovedadAlimentador=="AsociarNovedad"){
        vacioAlimentador = true;
        Swal.fire({
          icon: 'error',
          title: 'NOVEDADES...',
          text: '*NO se ha asociado a una Novedad!'
        })
      }
      if(Prog_BusAlimentador==""){
        Swal.fire({
          title: '¿BUS?',
          text: "Se grabara el registro con BUS vacio !!!",
          icon: 'warning',
        });
      }
  
      if(Prog_NombreColaboradorAlimentador==""){
        Swal.fire({
          title: '¿PILOTO?',
          text: "Se grabara el registro con PILOTO vacio !!!",
          icon: 'warning',
        });
      }
  
    }

    // AGREGAR NOVEDAD
    if(nOpcionGrabarAlimentador == 2){
      tValidaNuevaNovedadAlimentador = f_ValidarNuevaNovedadAlimentador(Nove_NovedadAlimentador,Nove_TipoNovedadAlimentador,Nove_DetalleNovedadAlimentador,Nove_DescripcionNovedadAlimentador,Nove_LugarExactoAlimentador,Nove_HoraInicioAlimentador,Nove_HoraFinAlimentador);
      if(tValidaNuevaNovedadAlimentador=="invalido"){
        vacioAlimentador = true;
        Swal.fire({
          icon: 'error',
          title: 'NOVEDADES...',
          text: '*NO se han generado novedades!'
        })
      }
    }

    // EDITAR
    if(nOpcionGrabarAlimentador == 3){
      tValidaAlimentador = f_ValidarAlimentador(Prog_NombreColaboradorAlimentador, Prog_BusAlimentador, Prog_TipoEventoAlimentador, Prog_HoraOrigenAlimentador,Prog_HoraDestinoAlimentador,Prog_LugarOrigenAlimentador, Prog_LugarDestinoAlimentador, Prog_ServBusAlimentador, Prog_ServicioAlimentador, Prog_SentidoAlimentador, Prog_KmXPuntosAlimentador, Prog_TablaAlimentador, Prog_BusMantoAlimentador, Prog_IdMantoAlimentador, Prog_ObservacionesAlimentador);
      if(tValidaAlimentador=="invalido" && adataAlimentador.length==1){
        vacioAlimentador = true;
        Swal.fire({
          icon: 'error',
          title: 'INFORMACION ALIMENTADOR...',
          text: '*Falta completar información!'
        })
      }
      if(adataAlimentador.length > 1 && Prog_NombreColaboradorAlimentador=="" && Prog_BusAlimentador=="" && Prog_TipoEventoAlimentador==""){
        vacioAlimentador = true;
        Swal.fire({
          icon: 'error',
          title: 'INFORMACION ALIMENTADOR...',
          text: '*Falta completar información!'
        })
      }
      if(selectNovedadIdAlimentador==""){
        vacioAlimentador = true;
        Swal.fire({
          icon: 'error',
          title: 'NOVEDADES...',
          text: '*NO se ha asociado a una novedad!'
        });
      }
      if(vacioAlimentador == false && tValidaAlimentador == ""){
        tValidaBusPilotoAlimentador = f_InconsistenciasBusPiloto(Prog_FechaAlimentador,Prog_OperacionAlimentador,Prog_BusAlimentador,Prog_NombreColaboradorAlimentador,adataAlimentador,Prog_HoraOrigenAlimentador,Prog_HoraDestinoAlimentador);
        if(tValidaBusPilotoAlimentador!=""){
          Swal.fire({
            title: '¿Inconsistencias?',
            text: "Se grabara el registro con Inconsistencias en "+tValidaBusPilotoAlimentador+" !!!",
            icon: 'warning',
          });
        }
      }
      if(Prog_BusAlimentador==""){
        Swal.fire({
          title: '¿BUS?',
          text: "Se grabara el registro con BUS vacio !!!",
          icon: 'warning',
        });
      }
  
      if(Prog_NombreColaboradorAlimentador==""){
        Swal.fire({
          title: '¿PILOTO?',
          text: "Se grabara el registro con PILOTO vacio !!!",
          icon: 'warning',
        });
      }
  
    }

    // AGREGAR PUNTO FIJO
    if(nOpcionGrabarAlimentador == 4) {
      tValidaPuntoFijoAlimentador = f_ValidarNuevaNovedadAlimentador(Nove_NovedadAlimentador,Nove_TipoNovedadAlimentador,Nove_DetalleNovedadAlimentador,Nove_DescripcionNovedadAlimentador,Nove_LugarExactoAlimentador,Nove_HoraInicioAlimentador,Nove_HoraFinAlimentador);
      if(tValidaPuntoFijoAlimentador=="invalido"){
        vacioAlimentador = true;
        Swal.fire({
          icon: 'error',
          title: 'NOVEDADES...',
          text: '*NO se han generado novedades!'
        });
      }
    }

    // CAMBIO TOTAL DE BUS
    if(nOpcionGrabarAlimentador == 5) {
      tValidaEditarTotalAlimentador = f_ValidarEditarTotalAlimentador(Prog_IdMantoAlimentador1,Prog_BusAlimentador2);
      if(tValidaEditarTotalAlimentador=="invalido"){
        vacioAlimentador = true;
        Swal.fire({
          icon: 'error',
          title: 'INFORMACION ALIMENTADOR...',
          text: '*Falta completar información!'
        });
      }
      if(selectNovedadIdAlimentador==""){
        vacioAlimentador = true;
        Swal.fire({
          icon: 'error',
          title: 'NOVEDADES...',
          text: '*NO se ha asociado a una novedad!'
        });
      }
    }

    if(!vacioAlimentador){
      $("#btnGuardarAlimentador").prop("disabled",true); // Se deshabilta boton de grabar para evitar los multiples click
      /// CREAR
      if(nOpcionGrabarAlimentador == 1) {
          Accion='CrearControlFacilitador';
          arrDataAlimentador = JSON.stringify(adataAlimentador);
          $.ajax({
              url: "Ajax.php",
              type: "POST",
              datatype:"json",    
              data:  { MoS:MoS, NombreMoS:NombreMoS, Accion:Accion, Prog_Operacion:Prog_OperacionAlimentador, Prog_Fecha:Prog_FechaAlimentador,Prog_NombreColaborador:Prog_NombreColaboradorAlimentador, Prog_Tabla:Prog_TablaAlimentador, Prog_HoraOrigen:Prog_HoraOrigenAlimentador,Prog_HoraDestino:Prog_HoraDestinoAlimentador, Prog_Servicio:Prog_ServicioAlimentador, Prog_ServBus:Prog_ServBusAlimentador, Prog_Bus:Prog_BusAlimentador,Prog_LugarOrigen:Prog_LugarOrigenAlimentador, Prog_LugarDestino:Prog_LugarDestinoAlimentador, Prog_TipoEvento:Prog_TipoEventoAlimentador,Prog_KmXPuntos:Prog_KmXPuntosAlimentador, Prog_Sentido:Prog_SentidoAlimentador, Prog_BusManto:Prog_BusMantoAlimentador, Prog_IdManto:Prog_IdMantoAlimentador, Prog_Observaciones:Prog_ObservacionesAlimentador, OPE_NovedadId:selectNovedadIdAlimentador,btnOpcionNovedad:btnOpcionNovedadAlimentador, Nove_Novedad:Nove_NovedadAlimentador, Nove_TipoNovedad:Nove_TipoNovedadAlimentador,Nove_DetalleNovedad:Nove_DetalleNovedadAlimentador, Nove_Descripcion:Nove_DescripcionNovedadAlimentador, Nove_LugarExacto:Nove_LugarExactoAlimentador,Nove_HoraInicio:Nove_HoraInicioAlimentador, Nove_HoraFin:Nove_HoraFinAlimentador, Nove_TipoOrigen:Nove_TipoOrigenAlimentador, arrData:arrDataAlimentador},
              success: function(data) {
                tablaControlFacilitadorAlimentador.ajax.reload(null, false);
              }
          });
          bValidarNovedadAlimentador = ValidarNovedadAlimentador(Prog_FechaAlimentador,Prog_OperacionAlimentador);
      }
        
      /// AGREGAR NOVEDAD
      if(nOpcionGrabarAlimentador == 2) {
        Accion='EditarControlFacilitador';
        btnOpcionNovedadAlimentador="NuevaNovedad";
        arrDataAlimentador = JSON.stringify(adataAlimentador);
        $.ajax({
          url: "Ajax.php",
          type: "POST",
          datatype:"json",    
          data:  { MoS:MoS, NombreMoS:NombreMoS, Accion:Accion, Prog_Operacion:Prog_OperacionAlimentador, Prog_Fecha:Prog_FechaAlimentador, Prog_NombreColaborador:Prog_NombreColaboradorAlimentador, Prog_Tabla:Prog_TablaAlimentador, Prog_HoraOrigen:Prog_HoraOrigenAlimentador,Prog_HoraDestino:Prog_HoraDestinoAlimentador, Prog_Servicio:Prog_ServicioAlimentador, Prog_ServBus:Prog_ServBusAlimentador, Prog_Bus:Prog_BusAlimentador,Prog_LugarOrigen:Prog_LugarOrigenAlimentador, Prog_LugarDestino:Prog_LugarDestinoAlimentador, Prog_TipoEvento:Prog_TipoEventoAlimentador, Prog_KmXPuntos:Prog_KmXPuntosAlimentador, Prog_Sentido:Prog_SentidoAlimentador, Prog_BusManto:Prog_BusMantoAlimentador, Prog_IdManto:Prog_IdMantoAlimentador, Prog_Observaciones:Prog_ObservacionesAlimentador, OPE_NovedadId:selectNovedadIdAlimentador, btnOpcionNovedad:btnOpcionNovedadAlimentador, Nove_Novedad:Nove_NovedadAlimentador, Nove_TipoNovedad:Nove_TipoNovedadAlimentador,Nove_DetalleNovedad:Nove_DetalleNovedadAlimentador, Nove_Descripcion:Nove_DescripcionNovedadAlimentador, Nove_LugarExacto:Nove_LugarExactoAlimentador,Nove_HoraInicio:Nove_HoraInicioAlimentador, Nove_HoraFin:Nove_HoraFinAlimentador, Nove_TipoOrigen:Nove_TipoOrigenAlimentador, arrData:arrDataAlimentador},  
          success: function(data) {
            tablaControlFacilitadorAlimentador.ajax.reload(null, false);
           }
        });
        bValidarNovedadAlimentador = ValidarNovedadAlimentador(Prog_FechaAlimentador,Prog_OperacionAlimentador);
      }

      /// EDITAR
      if(nOpcionGrabarAlimentador == 3) {
        Accion='EditarControlFacilitador';
        btnOpcionNovedadAlimentador="AsociarNovedad";
        arrDataAlimentador = JSON.stringify(adataAlimentador);
        $.ajax({
          url: "Ajax.php",
          type: "POST",
          datatype:"json",    
          data:  { MoS:MoS, NombreMoS:NombreMoS, Accion:Accion, Prog_Operacion:Prog_OperacionAlimentador, Prog_Fecha:Prog_FechaAlimentador, Prog_NombreColaborador:Prog_NombreColaboradorAlimentador, Prog_Tabla:Prog_TablaAlimentador, Prog_HoraOrigen:Prog_HoraOrigenAlimentador,Prog_HoraDestino:Prog_HoraDestinoAlimentador, Prog_Servicio:Prog_ServicioAlimentador, Prog_ServBus:Prog_ServBusAlimentador, Prog_Bus:Prog_BusAlimentador,Prog_LugarOrigen:Prog_LugarOrigenAlimentador, Prog_LugarDestino:Prog_LugarDestinoAlimentador, Prog_TipoEvento:Prog_TipoEventoAlimentador, Prog_KmXPuntos:Prog_KmXPuntosAlimentador, Prog_Sentido:Prog_SentidoAlimentador, Prog_BusManto:Prog_BusMantoAlimentador, Prog_IdManto:Prog_IdMantoAlimentador, Prog_Observaciones:Prog_ObservacionesAlimentador, OPE_NovedadId:selectNovedadIdAlimentador, btnOpcionNovedad:btnOpcionNovedadAlimentador, Nove_Novedad:Nove_NovedadAlimentador, Nove_TipoNovedad:Nove_TipoNovedadAlimentador,Nove_DetalleNovedad:Nove_DetalleNovedadAlimentador, Nove_Descripcion:Nove_DescripcionNovedadAlimentador, Nove_LugarExacto:Nove_LugarExactoAlimentador,Nove_HoraInicio:Nove_HoraInicioAlimentador, Nove_HoraFin:Nove_HoraFinAlimentador, Nove_TipoOrigen:Nove_TipoOrigenAlimentador, arrData:arrDataAlimentador},
          success: function(data) {
            tablaControlFacilitadorAlimentador.ajax.reload(null, false);
           }
        });
      }

      /// AGREGAR PUNTO FIJO
      if(nOpcionGrabarAlimentador == 4) {
        Accion='EditarControlFacilitador';
        btnOpcionNovedadAlimentador="NuevaNovedad";
        arrDataAlimentador = JSON.stringify(adataAlimentador);
        $.ajax({
          url: "Ajax.php",
          type: "POST",
          datatype:"json",    
          data:  { MoS:MoS, NombreMoS:NombreMoS, Accion:Accion, Prog_Operacion:Prog_OperacionAlimentador, Prog_Fecha:Prog_FechaAlimentador, Prog_NombreColaborador:Prog_NombreColaboradorAlimentador, Prog_Tabla:Prog_TablaAlimentador, Prog_HoraOrigen:Prog_HoraOrigenAlimentador,Prog_HoraDestino:Prog_HoraDestinoAlimentador, Prog_Servicio:Prog_ServicioAlimentador, Prog_ServBus:Prog_ServBusAlimentador, Prog_Bus:Prog_BusAlimentador,Prog_LugarOrigen:Prog_LugarOrigenAlimentador, Prog_LugarDestino:Prog_LugarDestinoAlimentador, Prog_TipoEvento:Prog_TipoEventoAlimentador, Prog_KmXPuntos:Prog_KmXPuntosAlimentador, Prog_Sentido:Prog_SentidoAlimentador, Prog_BusManto:Prog_BusMantoAlimentador, Prog_IdManto:Prog_IdMantoAlimentador, Prog_Observaciones:Prog_ObservacionesAlimentador, OPE_NovedadId:selectNovedadIdAlimentador, btnOpcionNovedad:btnOpcionNovedadAlimentador, Nove_Novedad:Nove_NovedadAlimentador, Nove_TipoNovedad:Nove_TipoNovedadAlimentador,Nove_DetalleNovedad:Nove_DetalleNovedadAlimentador, Nove_Descripcion:Nove_DescripcionNovedadAlimentador, Nove_LugarExacto:Nove_LugarExactoAlimentador,Nove_HoraInicio:Nove_HoraInicioAlimentador, Nove_HoraFin:Nove_HoraFinAlimentador, Nove_TipoOrigen:Nove_TipoOrigenAlimentador, arrData:arrDataAlimentador},
          success: function(data) {
            tablaControlFacilitadorAlimentador.ajax.reload(null, false);
          }
        });
        bValidarNovedadAlimentador = ValidarNovedadAlimentador(Prog_FechaAlimentador,Prog_OperacionAlimentador);
      }

      /// EDITAR TOTAL BUS O PILOTO
      if(nOpcionGrabarAlimentador == 5) {
        Accion='EditarTotalControlFacilitador';
        $.ajax({
          url: "Ajax.php",
          type: "POST",
          datatype:"json",    
          data:  { MoS:MoS,NombreMoS:NombreMoS,Accion:Accion,Prog_Operacion:Prog_OperacionAlimentador,Prog_Fecha:Prog_FechaAlimentador,Prog_IdManto1:Prog_IdMantoAlimentador1,Prog_Bus2:Prog_BusAlimentador2,OPE_NovedadId:selectNovedadIdAlimentador},
          success: function(data) {
            tablaControlFacilitadorAlimentador.ajax.reload(null, false);
         }
        });
      }

      if(bValidarNovedadAlimentador=="SI NOVEDADES"){
        $('#btnEditarTotalAlimentador').show();
      }
      $('#modalCRUDControlFacilitadorAlimentador').modal('hide');      
      
    } 
  });

  /// ::::::::::::::: EDITA ESTADO ATENDIDO DE REPORTES DEL CONTROL FACILITADOR  :::::::::::::///
  $('#formMostrarReporteAlimentador').submit(function(e){
    e.preventDefault(); //evita el comportambiento normal del submit, es decir, recarga total de la página
    Swal.fire({
      title: '¿Está seguro?',
      text: "Se atenderá el reporte de Despacho de Flota "+ControlFacilitador_IdAlimentador+" !!!",
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
            data: { MoS:MoS,NombreMoS:NombreMoS,Accion:Accion,ControlFacilitador_Id:ControlFacilitador_IdAlimentador},   
            success: function(data) {
              tablaControlFacilitadorAlimentador.ajax.reload(null, false);
            }
          });
        }
      }
    });
    $('#modalCRUDMostrarReporteAlimentador').modal('hide');
  });
  
  //::::::::  SELECCION DE BOTONES NUEVA NOVEDAD Y ASOCIAR NOVEDAD  ::::::://
  $("input[name=optionsNovedadAlimentador]").click(function () {    
    // Se inicializan las tablas 
    btnOpcionNovedadAlimentador = $(this).val();
    LimpiaMsControlFacilitadorAlimentador();
    
    if(btnOpcionNovedadAlimentador=="NuevaNovedad"){
      document.getElementById("Nove_NovedadAlimentador").placeholder = "";
      document.getElementById("Nove_DescripcionNovedadAlimentador").placeholder = "";
      thtml = '<option value="">Seleccione una opcion</option>';
      $("#Nove_TipoNovedadAlimentador").html(thtml);
      $("#Nove_DetalleNovedadAlimentador").html(thtml);
      $("#Nove_DescripcionNovedadAlimentador").val("");
      $('#div_NuevaNovedadAlimentador').show(); 
      $('#div_AsociarNovedadAlimentador').hide(); 
    }else{
      document.getElementById("selectNovedadIdAlimentador").placeholder = "";
      document.getElementById("t_NovedadIdAlimentador").placeholder = "";
      document.getElementById("t_NovedadAlimentador").placeholder = "";
      document.getElementById("t_TipoNovedadAlimentador").placeholder = "";
      document.getElementById("t_DetalleNovedadAlimentador").placeholder = "";
      document.getElementById("t_DescripcionNovedadAlimentador").placeholder = "";
      thtml = "";
      ControlFacilitador_IdAlimentador=0;
      thtml = f_selectNovedad(Prog_FechaAlimentador,Prog_OperacionAlimentador,ControlFacilitador_IdAlimentador);
      $("#selectNovedadIdAlimentador").html(thtml);
      $("#t_NovedadIdAlimentador").val("");
      $("#t_NovedadAlimentador").val("");
      $("#t_TipoNovedadAlimentador").val("");
      $("#t_DetalleNovedadAlimentador").val("");
      $("#t_DescripcionNovedadAlimentador").val("");
      selectNovedadIdAlimentador = "";
      $("#selectNovedadIdAlimentador").val("");
      $('#div_NuevaNovedadAlimentador').hide(); 
      $('#div_AsociarNovedadAlimentador').show(); 
    }
  });

  ///::::::::: EVENTO DEL BOTON NUEVO ::::::::::::::///
  $("#btnViajeAlimentador").click(function(){
    nOpcionGrabarAlimentador = 1; // Alta Nueva Fila
    Nove_TipoOrigenAlimentador = "CGO";
    selectNovedadIdAlimentador = "";
    btnOpcionNovedadAlimentador = "";

    // Se inicializa el array a modificar y se cargan los id de los registros a actualizar
    adataAlimentador=[];
    var xdataAlimentador = tablaControlFacilitadorAlimentador.rows( { selected: true } ).data();
    $.each(xdataAlimentador,function(index, value){
      adataAlimentador.push( value.ControlFacilitador_Id );
    });
  
    $("#formControlFacilitadorAlimentador").trigger("reset");
    $("#btnGuardarAlimentador").prop("disabled",false);
    
    LimpiaMsControlFacilitadorAlimentador();

    bValidarNovedadAlimentador = ValidarNovedadAlimentador(Prog_FechaAlimentador,Prog_OperacionAlimentador);
    fEdicionCamposAlimentador('disabled', false);

    $("#Prog_HoraOrigenAlimentador").prop('disabled', true);
    $("#Prog_HoraDestinoAlimentador").prop('disabled', true);
    $("#Nove_NovedadAlimentador").prop('disabled',false);
    $("#Nove_TipoNovedadAlimentador").prop('disabled',false);

    if (adataAlimentador.length < 2){
      if(adataAlimentador.length === 1){
        //$("#Prog_ServBusAlimentador").prop('disabled', true);
        f_CargaVariablesFilaAlimentador();
      }else{
        //$("#Prog_ServBusAlimentador").prop('disabled', false);
        f_CargaVariablesVacioAlimentador();
        f_CargaVariablesHtmlVacioAlimentador();
      }
      f_CargaVariablesHtmlDataAlimentador();
    
      $(".modal-header").css( "background-color", "#17a2b8");
      $(".modal-header").css( "color", "white" );
      $(".modal-title").text("Alta Control Facilitador Alimentador");

      $('#div_ControlFacilitadorAlimentadorEditarTotal').hide();
      $('#div_ControlFacilitadorAlimentasorMultiple').show(); 
      $('#div_ControlFacilitadorAlimentadorUnico').show(); 
      $('#div_OpcionNovedadAlimentador').show(); 
      $('#div_NuevaNovedadAlimentador').hide(); 
      $('#div_AsociarNovedadAlimentador').hide(); 
    
      $('#modalCRUDControlFacilitadorAlimentador').modal('show');
      $("#modalCRUDControlFacilitadorAlimentador").draggable({});
    }else{
      Swal.fire(
        'NUEVO REGISTRO!',
        'Se puede cargar una sola fila.',
        'success'
      )
    } 
  }); 

  ///::::::::: EVENTO DEL BOTON AGREGAR NOVEDAD ::::::::::::::::::::::///       
  $('#btnAgregarNovedadAlimentador').click( function () {
    selectNovedadIdAlimentador = "";
    $("#formControlFacilitadorAlimentador").trigger("reset");
    $("#btnGuardarAlimentador").prop("disabled",false);
  
    // Se inicializa el array a modificar y se cargan los id de los registros a actualizar
    adataAlimentador=[];
    var xdataAlimentador = tablaControlFacilitadorAlimentador.rows( { selected: true } ).data();
    $.each(xdataAlimentador,function(index, value){
      adataAlimentador.push( value.ControlFacilitador_Id );
    });

    if(adataAlimentador.length === 1){    
      nOpcionGrabarAlimentador = 2; //Agregar Novedad
      Nove_TipoOrigenAlimentador = "CGO";
      LimpiaMsControlFacilitadorAlimentador();

      bValidarNovedadAlimentador = ValidarNovedadAlimentador(Prog_FechaAlimentador,Prog_OperacionAlimentador);
      fEdicionCamposAlimentador('disabled', true);
      $("#Nove_NovedadAlimentador").prop('disabled',false);
      $("#Nove_TipoNovedadAlimentador").prop('disabled',false);

      f_CargaVariablesFilaAlimentador();

      f_CargaVariablesHtmlDataAlimentador();

      $(".modal-header").css("background-color", "#007bff");
      $(".modal-header").css("color", "white" );
      $(".modal-title").text("Agregar Novedad Alimentador");

      $('#div_ControlFacilitadorAlimentadorEditarTotal').hide();
      $('#div_ControlFacilitadorAlimentadorMultiple').show(); 
      $('#div_ControlFacilitadorAlimentadorUnico').show(); 
      $('#div_OpcionNovedadAlimentador').hide(); 
      $('#div_AsociarNovedadAlimentador').hide(); 
      $('#div_NuevaNovedadAlimentador').show(); 

      $("#modalCRUDControlFacilitadorAlimentador").modal("show");
      $("#modalCRUDControlFacilitadorAlimentador").draggable({});
    }else{
      Swal.fire(
        'NOVEDAD!',
        'Las Novedades se crean para una sola fila.',
        'success'
      )
    }
  });

  ///::::::::: EVENTO DEL BOTON EDITAR ::::::::::::::::::::::///       
  $('#btnEditarAlimentador').click( function () {
    // Se inicializa el array a modificar y se cargan los id de los registros a actualizar
    adataAlimentador=[];
    var xdataAlimentador = tablaControlFacilitadorAlimentador.rows( { selected: true } ).data();
    $.each(xdataAlimentador,function(index, value){
      adataAlimentador.push( value.ControlFacilitador_Id );
    });

    let xtextoAlimentador = "Multiples Valores";
    selectNovedadIdAlimentador = "";
    $("#formControlFacilitadorAlimentador").trigger("reset");
    $("#btnGuardarAlimentador").prop("disabled",false);

    nOpcionGrabarAlimentador = 3; //Editar Filas
    LimpiaMsControlFacilitadorAlimentador();

    bValidarNovedadAlimentador = ValidarNovedadAlimentador(Prog_FechaAlimentador,Prog_OperacionAlimentador);
    fEdicionCamposAlimentador('disabled', false);
    
//    $("#Prog_ServBusAlimentador").prop('disabled', true);
    $("#Prog_HoraOrigenAlimentador").prop('disabled', true);
    $("#Prog_HoraDestinoAlimentador").prop('disabled', true);

    if (adataAlimentador.length === 1){
      f_CargaVariablesFilaAlimentador();
    }else{
      f_CargaVariablesVacioAlimentador();
      f_CargaVariablesHtmlTextoAlimentador(xtextoAlimentador);
    }
    f_CargaVariablesHtmlDataAlimentador();
    xtextoAlimentador = "";
    xtextoAlimentador = f_selectNovedad(Prog_FechaAlimentador,Prog_OperacionAlimentador,ControlFacilitador_IdAlimentador);
    $("#selectNovedadIdAlimentador").html(xtextoAlimentador);

    $(".modal-header").css("background-color", "#007bff");
    $(".modal-header").css("color", "white" );
    $(".modal-title").text("Editar Control Facilitador Alimentador");

    $('#div_ControlFacilitadorAlimentadorEditarTotal').hide();
    $('#div_ControlFacilitadorAlimentadorMultiple').show(); 
    if(adataAlimentador.length === 1){
      $('#div_ControlFacilitadorAlimentadorUnico').show(); 
    }else{
      $('#div_ControlFacilitadorAlimentadorUnico').hide(); 
    }
    $('#div_OpcionNovedadAlimentador').hide(); 
    $('#div_NuevaNovedadAlimentador').hide(); 
    $('#div_AsociarNovedadAlimentador').show(); 

    $("#modalCRUDControlFacilitadorAlimentador").modal("show");
    $("#modalCRUDControlFacilitadorAlimentador").draggable({});
  });

  ///::::::::: EVENTO DEL BOTON EDITAR TOTAL BUS PILOTO::::::::::::::::::::::///       
  $('#btnEditarTotalAlimentador').click( function () {
    // Se inicializa el array a modificar y se cargan los id de los registros a actualizar
    adataAlimentador=[];
    var xdataAlimentador = tablaControlFacilitadorAlimentador.rows( { selected: true } ).data();
    $.each(xdataAlimentador,function(index, value){
      adataAlimentador.push( value.ControlFacilitador_Id );
    });

    selectNovedadIdAlimentador = "";
    ControlFacilitador_IdAlimentador = 0;
    $("#formControlFacilitador").trigger("reset");
    $("#btnGuardarAlimentador").prop("disabled",false);

    if(adata.length>0){
      Swal.fire({
        title             : 'CAMBIO DE BUS!',
        html              : 'Se realizará por ID Bus.',
        showConfirmButton : false,
        timer             : 2000
      })
    }
      nOpcionGrabarAlimentador = 5; //Editar Filas Todos Bus1 x Bus2, Piloto1 x Piloto2
      LimpiaMsControlFacilitadorAlimentador();

      Prog_IdMantoAlimentador1 = "";
      Prog_BusAlimentador2 = "";
      $("#Prog_IdMantoAlimentador1").val(Prog_IdMantoAlimentador1);
      $("#Prog_BusAlimentador2").val(Prog_BusAlimentador2);

/*       Accion='SelectBusActual'; 
      $.ajax({
        url: "Ajax.php",
        type: "POST",
        datatype:"json",    
        data: {MoS:MoS,NombreMoS:NombreMoS,Accion:Accion,Prog_Operacion:Prog_OperacionAlimentador,Prog_Fecha:Prog_FechaAlimentador},
        success: function(data){
          $("#Prog_IdMantoAlimentador1").html(data);
          $("#Prog_BusAlimentador2").html(data);
        }
      });
 */
      Accion='SelectIdMantoActual'; 
      $.ajax({
        url       : "Ajax.php",
        type      : "POST",
        datatype  : "json",    
        data      : {MoS:MoS,NombreMoS:NombreMoS,Accion:Accion,Prog_Operacion:Prog_OperacionAlimentador,Prog_Fecha:Prog_FechaAlimentador},
        success: function(data){
          $("#Prog_IdMantoAlimentador1").html(data);
        }
      });

      Accion='SelectBus'; 
      $.ajax({
        url       : "Ajax.php",
        type      : "POST",
        datatype  : "json",    
        data      : {MoS:MoS,NombreMoS:NombreMoS,Accion:Accion,Prog_Operacion:Prog_OperacionAlimentador},
        success: function(data){
          $("#Prog_BusAlimentador2").html(data);
        }
      });

      bValidarNovedadAlimentador = ValidarNovedadAlimentador(Prog_FechaAlimentador,Prog_OperacionAlimentador);
      let xtextoAlimentador="";
      xtextoAlimentador = f_selectNovedad(Prog_FechaAlimentador,Prog_OperacionAlimentador,ControlFacilitador_IdAlimentador);
      $("#selectNovedadIdAlimentador").html(xtextoAlimentador);

      $(".modal-header").css("background-color", "#007bff");
      $(".modal-header").css("color", "white" );
      $(".modal-title").text("Editar Bus por Bus Control Facilitador Alimentador");
      $('#div_ControlFacilitadorAlimentadorEditarTotal').show();
      $('#div_ControlFacilitadorAlimentadorMultiple').hide(); 
      $('#div_ControlFacilitadorAlimentadorUnico').hide(); 
      $('#div_OpcionNovedadAlimentador').hide(); 
      $('#div_NuevaNovedadAlimentador').hide(); 
      $('#div_AsociarNovedadAlimentador').show(); 

      $("#modalCRUDControlFacilitadorAlimentador").modal("show");
      $("#modalCRUDControlFacilitadorAlimentador").draggable({});

  });

  ///::::::::: EVENTO DEL BOTON AGREGAR PUNTO FIJO ::::::::::::::::::::::///       
  $('#btnAgregarPuntoFijoAlimentador').click( function () {
    selectNovedadIdAlimentador = "";
    Nove_NovedadAlimentador = "NOVEDAD_PILOTO";
    Nove_TipoNovedadAlimentador = "COMPORTAMIENTO";

    $("#formControlFacilitadorAlimentador").trigger("reset");
    $("#btnGuardarAlimentador").prop("disabled",false);
    // Se inicializa el array a modificar y se cargan los id de los registros a actualizar
    adataAlimentador=[];
    var xdataAlimentador = tablaControlFacilitadorAlimentador.rows( { selected: true } ).data();
    $.each(xdataAlimentador,function(index, value){
      adataAlimentador.push( value.ControlFacilitador_Id );
    });
  
  if(adataAlimentador.length === 1){    
    nOpcionGrabarAlimentador = 4; //Agregar Novedad Punto Fijo
    Nove_TipoOrigenAlimentador = "PUNTO FIJO";
    LimpiaMsControlFacilitadorAlimentador();

    bValidarNovedadAlimentador = ValidarNovedadAlimentador(Prog_FechaAlimentador,Prog_OperacionAlimentador);
    fEdicionCamposAlimentador('disabled', true);
    $("#Nove_NovedadAlimentador").prop('disabled',true);
    $("#Nove_TipoNovedadAlimentador").prop('disabled',true);
  
    f_CargaVariablesFilaAlimentador();
    f_CargaVariablesHtmlDataAlimentador();
    $("#Nove_NovedadAlimentador").val(Nove_NovedadAlimentador);
    selectHtmlAlimentador="";
    selectHtmlAlimentador=f_TipoTabla(Prog_OperacionAlimentador,Nove_NovedadAlimentador);
    $("#Nove_TipoNovedadAlimentador").html(selectHtmlAlimentador);
    
    $("#Nove_TipoNovedadAlimentador").val(Nove_TipoNovedadAlimentador);
    selectHtmlAlimentador="";
    selectHtmlAlimentador=f_TipoTabla(Prog_OperacionAlimentador,Nove_TipoNovedadAlimentador);
    $("#Nove_DetalleNovedadAlimentador").html(selectHtmlAlimentador);

    $(".modal-header").css("background-color", "#007bff");
    $(".modal-header").css("color", "white" );
    $(".modal-title").text("Agregar Reporte en Vía Alimentador");

    $('#div_ControlFacilitadorAlimentadorEditarTotal').hide();
    $('#div_ControlFacilitadorAlimentadorMultiple').show(); 
    $('#div_ControlFacilitadorAlimentadorUnico').show(); 
    $('#div_OpcionNovedadAlimentador').hide(); 
    $('#div_AsociarNovedadAlimentador').hide(); 
    $('#div_NuevaNovedadAlimentador').show(); 
    $('#div_detallePuntoFijoAlimentador').hide(); 
    $('#div_detalleNovedadAlimentador').show(); 

    $("#modalCRUDControlFacilitadorAlimentador").modal("show");
    $("#modalCRUDControlFacilitadorAlimentador").draggable({});
  }else{
    Swal.fire(
      'NOVEDAD!',
      'Las Novedades se crean para una sola fila.',
      'success'
    )
  }
});


  ///:::::::::  EVENTO BOTON MOSTRAR INCONSISTENCIAS  ::::::::::///
  $('#btnInconsistenciasAlimentador').click( function(){
    let aInconsistenciasAlimentador, tablaInconsistenciasAlimentador;

    // Creacion de tabla de Inconsistencias
    div_tablas = f_CreacionTabla("tablaMostrarInconsistenciasAlimentador","");
    $("#div_tablaMostrarInconsistenciasAlimentador").html(div_tablas);

    aInconsistenciasAlimentador = fInconsistenciasControlFacilitador(Prog_FechaAlimentador,Prog_OperacionAlimentador);
    $("#tablaMostrarInconsistenciasAlimentador tbody").children().remove();
    if(aInconsistenciasAlimentador.length>0){
      tablaInconsistenciasAlimentador = "";
      $.each(aInconsistenciasAlimentador, function(idx, obj){ 
        tablaInconsistenciasAlimentador += ('<tr>');
        tablaInconsistenciasAlimentador += ('<td>' + obj.Inco_Tipo +' : '+obj.Inco_Detalle+ '</td>');
        tablaInconsistenciasAlimentador += ('<td>' + obj.Inco_Id + '</td>');
        tablaInconsistenciasAlimentador += ('<td>' + obj.Inco_IdManto + '</td>');
        tablaInconsistenciasAlimentador += ('</tr>');
      });
      $('#tablaMostrarInconsistenciasAlimentador').append(tablaInconsistenciasAlimentador);

      $("#formMostrarInconsistenciasAlimentador").trigger("reset");
      $(".modal-header").css( "background-color", "#17a2b8");
      $(".modal-header").css( "color", "white" );
      $(".modal-title").text("Inconsistencias Alimentador");
      $(".modal-subtitle").text("1. Pilotos y Buses no pueden estar asignados en la misma franja horaria a 2 eventos distintos.");
      $('#modalCRUDMostrarInconsistenciasAlimentador').modal('show');
      $('#div_tablaMostrarInconsistenciasAlimentador').show();    
    }else{
      Swal.fire(
        'Inconsistencias!',
        'NO se han encontrado Inconsistencias en la Operacion',
        'success'
      )
    }
  });

  ///:::::::::  EVENTO BOTON MOSTRAR RESUMEN  ::::::::::///
  $('#btnResumenAlimentador').click( function(){
    $("#formMostrarResumenAlimentador").trigger("reset");
    let t_html_alimentador = "";

    if (CFaRg_EstadoAlimentador=="GENERADO"){
      Accion='ResumenOperacion';
    }else{
      Accion='resumen_operacion_hist';
    }
    $.ajax({
      url     : "Ajax.php",
      type    : "POST",
      datatype:"json",
      async   : false,
      data    : {MoS:MoS,NombreMoS:NombreMoS,Accion:Accion,Prog_Fecha:Prog_FechaAlimentador},    
      success: function(data){
        t_html_alimentador = data;
      }
    });

    $("#div_form_mostrar_resumen_alimentador").html(t_html_alimentador);
    $(".modal-header").css( "background-color", "#17a2b8");
    $(".modal-header").css( "color", "white" );
    $(".modal-title_resumen_alimentador").text("RESUMEN");
    $('#modalCRUDMostrarResumenAlimentador').modal('show');

    $('#modal-resizable_resumen_troncal').resizable();
    $(".modal-dialog").draggable({
      cursor: "move",
      handle: ".dragable_touch",
    });        

//    $("#modalCRUDMostrarResumenAlimentador").draggable({});
  });

  ///::::::::: EVENTO DEL BOTON LOGUEO ::::::::::::::::::::::///       
  $(document).on("click", ".btn_logueo_alimentador", function(){
    $("#form_logueo_alimentador").trigger("reset");
    $("#btn_novedad_logueo_alimentador").prop("disabled",false); // Se habilita boton de grabar para evitar el multiple click
    adataAlimentador=[];
    var xdataAlimentador = tablaControlFacilitadorAlimentador.rows( { selected: true } ).data();
    $.each(xdataAlimentador,function(index, value){
      adataAlimentador.push( value.ControlFacilitador_Id );
    });
    logueo_alimentador_vid = ""; // FALTA BUSCAR
    if(adataAlimentador.length === 1){
      selectNovedadIdAlimentador  = "";
      nOpcionGrabarAlimentador    = 2; //Agregar Novedad
      Nove_TipoOrigenAlimentador  = "CGO";
      LimpiaMsControlFacilitadorTroncal();
      f_CargaVariablesVacioAlimentador();
      f_CargaVariablesFilaAlimentador();
      data_BD_alimentador     = f_BuscarDataBD("Buses","Bus_NroExterno",Prog_BusAlimentador);
      logueo_alimentador_vid  = "";
      $.each(data_BD_alimentador, function(idx, obj){
        logueo_alimentador_vid = obj.Bus_NroVid;
      });
      $("#logueo_alimentador_bus").val(Prog_BusAlimentador);
      $("#logueo_alimentador_vid").val(logueo_alimentador_vid);
      $("#logueo_alimentador_codigo_piloto").val('12'+filaAlimentador.find('td:eq(1)').text());
      $("#logueo_alimentador_nombre_piloto").val(Prog_NombreColaboradorAlimentador);
      $("#logueo_alimentador_tabla").val(Prog_TablaAlimentador);
      $("#logueo_alimentador_servicio").val(Prog_ServicioAlimentador);

      $(".modal-header").css("background-color", "#17a2b8");
      $(".modal-header").css("color", "white" );
      $(".modal-title_logueo_alimentador").text("LOGUEO");
      $(".modal-body-title_logueo_alimentador").text("LOGUEO DE SERVICIO");
      $(".modal-body-subtitle_logueo_alimentador").text("FECHA: "+f_fecha_texto(fecha_hoy));

      $("#modal_crud_logueo_alimentador").modal("show");
      $("#modal_crud_logueo_alimentador").draggable({});
    }else{
      Swal.fire(
        'LOGUEO!',
        'El servicio de Logueo es para una sola fila.',
        'success'
      )
    }
  });

  ///::::::::: EVENTO DE BOTON VER BUSES ALIMENTADOR ::::::::::::::::::::::///       
  $(document).on("click", ".btn_ver_bus_alimentador", function(){
    $("#form_modal_bus_alimentador").trigger("reset");
    bus_nro_externo_alimentador = $("#bus_alimentador").val();
    data_BD_alimentador         = f_BuscarDataBD("Buses","Bus_NroExterno",bus_nro_externo_alimentador);
    Bus_NroExterno_alimentador  = "";
    $.each(data_BD_alimentador, function(idx, obj){
      Bus_NroExterno_alimentador = obj.Bus_NroExterno;    
      Bus_NroVid_alimentador     = obj.Bus_NroVid;
      Bus_NroPlaca_alimentador   = obj.Bus_NroPlaca;  
      Bus_Operacion_alimentador  = obj.Bus_Operacion;   
      Bus_Detalle_alimentador    = obj.Bus_Detalle;    
      Bus_Tipo_alimentador       = obj.Bus_Tipo;  
      Bus_Tipo2_alimentador      = obj.Bus_Tipo2;      
      Bus_Estado_alimentador     = obj.Bus_Estado;      
      Bus_Tanques_alimentador    = obj.Bus_Tanques;   
    });
    if(Bus_NroExterno_alimentador == null || Bus_NroExterno_alimentador == ""){
      Swal.fire({
        icon: 'error',
        title: 'Bus...',
        text: '*Es posible que la Información no sea la correcta!!!'
      })
    }else{
      $("#Bus_NroExterno_alimentador").val(Bus_NroExterno_alimentador);
      $("#Bus_NroVid_alimentador").val(Bus_NroVid_alimentador);
      $("#Bus_NroPlaca_alimentador").val(Bus_NroPlaca_alimentador);  
      $("#Bus_Operacion_alimentador").val(Bus_Operacion_alimentador);
      $("#Bus_Detalle_alimentador").val(Bus_Detalle_alimentador);
      $("#Bus_Tipo_alimentador").val(Bus_Tipo_alimentador);  
      $("#Bus_Tipo2_alimentador").val(Bus_Tipo2_alimentador);    
      $("#Bus_Estado_alimentador").val(Bus_Estado_alimentador);   
      $("#Bus_Tanques_alimentador").val(Bus_Tanques_alimentador);  
    
      $(".modal-header").css( "background-color", "#17a2b8");
      $(".modal-header").css( "color", "white" );
      $(".modal-title").text("Información de Bus");
      $('#modal_crud_bus_alimentador').modal('show');
      $("#modal_crud_bus_alimentador").draggable({});
      $("#bus_alimentador").val("");	    
    }
  });

  ///::::::::: EVENTO DE BOTON IGUAL FECHAS ALIMENTADOR ::::::::::::::::::::::///       
  $(document).on("click", ".btn_igual_fecha_alimentador", function(){
    HoraInicioAlimentador = $("#HoraInicioAlimentador").val();
    MinutoInicioAlimentador = $("#MinutoInicioAlimentador").val();
    $("#HoraFinAlimentador").val(HoraInicioAlimentador);
    $("#MinutoFinAlimentador").val(MinutoInicioAlimentador);
  });

  ///::::::::: EVENTO DE BOTON AGREGAR NOVEDAD DESDE LOGUEO Alimentador ::::::::::::::::::::::///       
  $(document).on("click", ".btn_novedad_logueo_alimentador", function(){
    selectNovedadIdAlimentador        = "";
    btnOpcionNovedadAlimentador       = "NuevaNovedad";
    Nove_NovedadAlimentador           = "NOVEDAD_BUS";
    Nove_TipoNovedadAlimentador       = "FALLA_COMUNICACIONES";
    Nove_DetalleNovedadAlimentador    = "SIN_VARADA";
    Nove_DescripcionNovedadAlimentador= "SE REPORTA A CGC QUE REALICE EL LOGUEO DEL SERVICIO";
    Nove_LugarExactoAlimentador       = Prog_LugarOrigen;
    Nove_HoraInicioAlimentador        = fecha_hoy.getHours()+":"+fecha_hoy.getMinutes();
    Nove_HoraFinAlimentador           = fecha_hoy.getHours()+":"+fecha_hoy.getMinutes();
    Nove_TipoOrigenAlimentador        = "CGO";

    if(nOpcionGrabarAlimentador == 2) {
      $("#btn_novedad_logueo_alimentador").prop("disabled",true); // Se deshabilita boton de grabar para evitar el multiple click
      Accion                      = 'EditarControlFacilitador';
      btnOpcionNovedadAlimentador = "NuevaNovedad";
      arrDataAlimentador          = JSON.stringify(adataAlimentador);
      $.ajax({
        url: "Ajax.php",
        type: "POST",
        datatype:"json",    
        data:  { MoS:MoS, NombreMoS:NombreMoS, Accion:Accion, Prog_Operacion:Prog_OperacionAlimentador, Prog_Fecha:Prog_FechaAlimentador, Prog_NombreColaborador:Prog_NombreColaboradorAlimentador, Prog_Tabla:Prog_TablaAlimentador, Prog_HoraOrigen:Prog_HoraOrigenAlimentador,Prog_HoraDestino:Prog_HoraDestinoAlimentador, Prog_Servicio:Prog_ServicioAlimentador, Prog_ServBus:Prog_ServBusAlimentador, Prog_Bus:Prog_BusAlimentador,Prog_LugarOrigen:Prog_LugarOrigenAlimentador, Prog_LugarDestino:Prog_LugarDestinoAlimentador, Prog_TipoEvento:Prog_TipoEventoAlimentador, Prog_KmXPuntos:Prog_KmXPuntosAlimentador, Prog_Sentido:Prog_SentidoAlimentador, Prog_BusManto:Prog_BusMantoAlimentador, Prog_IdManto:Prog_IdMantoAlimentador, Prog_Observaciones:Prog_ObservacionesAlimentador, OPE_NovedadId:selectNovedadIdAlimentador, btnOpcionNovedad:btnOpcionNovedadAlimentador, Nove_Novedad:Nove_NovedadAlimentador, Nove_TipoNovedad:Nove_TipoNovedadAlimentador,Nove_DetalleNovedad:Nove_DetalleNovedadAlimentador, Nove_Descripcion:Nove_DescripcionNovedadAlimentador, Nove_LugarExacto:Nove_LugarExactoAlimentador,Nove_HoraInicio:Nove_HoraInicioAlimentador, Nove_HoraFin:Nove_HoraFinAlimentador, Nove_TipoOrigen:Nove_TipoOrigenAlimentador, arrData:arrDataAlimentador},  
        success: function(data) {
          tablaControlFacilitadorAlimentador.ajax.reload(null, false);
         }
      });
      bValidarNovedadAlimentador = ValidarNovedadAlimentador(Prog_FechaAlimentador,Prog_OperacionAlimentador);
    }

    if(bValidarNovedadAlimentador=="SI NOVEDADES"){
      $('#btnEditarTotalAlimentador').show();
    }
    $('#modal_crud_logueo_alimentador').modal('hide');
  });

});

///:::::::::::::::::::::::::::: FIN DOOM ALIMENTADOR :::::::::::::::::::::::::::::::::::::::::///

///:::::::::::::::::::::::::::: BOTONES ALIMENTADOR ::::::::::::::::::::::::::::::::::::::::::///

/// ::::::::::::::: BOTON MOSTRAR DATATABLE CONTROLFACILITADOR ALIMENTADOR :::::::::::::///
$("#btnBuscarProgramacionAlimentador").click(function(){    
  columnastabla = f_ColumnasTabla("tablaControlFacilitadorAlimentador","");

  Prog_FechaAlimentador = $("#Prog_FechaAlimentador").val();
  bValidarNovedadAlimentador = ValidarNovedadAlimentador(Prog_FechaAlimentador,Prog_OperacionAlimentador);
  CFaRg_EstadoAlimentador = '';

  // VALIDAR ESTADO DEL CONTROL FACILITADOR ALIMENTADOR EN LA FECHA CORRESPONDIENTE
  Accion='ValidarControlFacilitador'; 
  $.ajax({
    url: "Ajax.php",
    type: "POST",
    datatype:"json",    
    async     : false,   
    data: {MoS:MoS,NombreMoS:NombreMoS,Accion:Accion,Prog_Fecha:Prog_FechaAlimentador,Prog_Operacion:Prog_OperacionAlimentador},    
    success: function(data){
      CFaRg_EstadoAlimentador = data;
      if (CFaRg_EstadoAlimentador=="GENERADO"){
        $('#btnViajeAlimentador').show(); // habilita boton nuevo        
        $('#btnInconsistenciasAlimentador').show(); // habilita boton Inconsistencias
        $('#btnResumenAlimentador').show();
        if(bValidarNovedadAlimentador=="SI NOVEDADES"){
          $('#btnEditarTotalAlimentador').show();
        }
      }else{
        if (CFaRg_EstadoAlimentador=="CERRADO"){
          Swal.fire(
            'Cerrado!',
            'El Control Facilitador Alimentador se encuentra cerrado.',
            'success'
          )
          $('#btnResumenAlimentador').show();
        }else{
          Swal.fire(
            'NO Generado!',
            'El Control Facilitador Alimentador no se encuentra generado.',
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
      $("#Prog_NombreColaboradorAlimentador").html(data);
    }
  });

  Accion='SelectBus'; 
  $.ajax({
    url: "Ajax.php",
    type: "POST",
    datatype:"json",    
    data: {MoS:MoS,NombreMoS:NombreMoS,Accion:Accion,Prog_Operacion:Prog_OperacionAlimentador},    
    success: function(data){
      $("#Prog_BusAlimentador").html(data);
    }
  });

  TipoAlimentador = 'SERVICIO';
  selectHtmlAlimentador="";
  selectHtmlAlimentador = f_TipoTabla(Prog_OperacionAlimentador,TipoAlimentador)
  $("#Prog_ServicioAlimentador").html(selectHtmlAlimentador);

  TipoAlimentador = 'LUGAR';
  selectHtmlAlimentador = "";
  selectHtmlAlimentador = f_TipoTabla(Prog_OperacionAlimentador,TipoAlimentador)
  $("#Prog_LugarOrigenAlimentador").html(selectHtmlAlimentador);
  $("#Prog_LugarDestinoAlimentador").html(selectHtmlAlimentador);

  TipoAlimentador = 'EVENTO'; 
  selectHtmlAlimentador = "";
  selectHtmlAlimentador = f_TipoTabla(Prog_OperacionAlimentador,TipoAlimentador)
  $("#Prog_TipoEventoAlimentador").html(selectHtmlAlimentador);

  TipoAlimentador = 'NOVEDAD'; 
  selectHtmlAlimentador = "";
  selectHtmlAlimentador = f_TipoTabla(Prog_OperacionAlimentador,TipoAlimentador)
  $("#Nove_NovedadAlimentador").html(selectHtmlAlimentador);

  TipoAlimentador='SENTIDO';
  OperacionAlimentador='LIMABUS'; 
  selectHtmlAlimentador = "";
  selectHtmlAlimentador = f_TipoTabla(OperacionAlimentador,TipoAlimentador)
  $("#Prog_SentidoAlimentador").html(selectHtmlAlimentador);

  $("#tablaControlFacilitadorAlimentador").dataTable().fnDestroy();
  $('#tablaControlFacilitadorAlimentador').show();

  if (CFaRg_EstadoAlimentador =="CERRADO"){
    Accion='leer_control_facilitador_hist';
  }else{
    Accion='LeerControlFacilitador';
  }

  tablaControlFacilitadorAlimentador = $('#tablaControlFacilitadorAlimentador').DataTable({
    //Color a las filas
    "rowCallback":function(row,data,index)
    {
      fColorFilasControlFacilitadorAlimentador(row,data);
    }, 
    //Filtros por columnas
    orderCellsTop: true,
    fixedHeader: true,
    initComplete: function (){
      var api = this.api();
      // For each column
      api.columns().eq(0).each(function (colIdx) {
        // Set the header cell to contain the input element
        var cell = $('.filtersAlimentador th').eq($(api.column(colIdx).header()).index());
        var title = $(cell).text();
        $(cell).html('<input type="text" placeholder="' + title + '" />');
        // On every keypress in this input
        $('input',$('.filtersAlimentador th').eq($(api.column(colIdx).header()).index()) ).off('keyup change').on('keyup change', function (e) {
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
    deferRender:    true,
    scrollY:        800,
    scrollCollapse: true,
    scroller:       true,
    scrollX:        true,
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
        title: 'CONTROL FACILITADOR ALIMENTADOR '+Prog_FechaAlimentador,
        className:  'btn btn-success'
      },
      {
        extend:     'pdfHtml5',
        text:       '<i class="fas fa-file-pdf"></i> ',
        titleAttr:  'Exportar a PDF',
        className:  'btn btn-danger',
        orientation: 'landscape',
        pagaSize: 'A4',
        title: 'CONTROL FACILITADOR ALIMENTADOR '+Prog_FechaAlimentador,
        exportOptions: {
          columns: [ 1,2,3,4,5,6,7,8,9,10,11,12 ]
        }
      },
    ],
    "ajax":{            
      "url": "Ajax.php", 
      "method": 'POST', //usamos el metodo POST
      "data":{ MoS:MoS,NombreMoS:NombreMoS,Accion:Accion,Prog_Fecha:Prog_FechaAlimentador,Prog_Operacion:Prog_OperacionAlimentador }, //enviamos opcion 4 para que haga un SELECT
      "dataSrc":"",
    },
    "columns":columnastabla,
    "columnDefs":[
      { "targets"  : [20],
        "render"   : function(data, type, row, meta) {
          if (data == "NO") {
            return "";
          } else {
            if (data == "SI"){
              return "<div class='text-center'><div class='btn-group'><button title='Novedad' class='btn btn-warning btn-sm btnMostrarNovedadAlimentador'><i class='bi bi-clipboard-plus'><svg xmlns='http://www.w3.org/2000/svg' width='12' height='12' fill='currentColor' class='bi bi-clipboard-plus' viewBox='0 0 16 16'><path fill-rule='evenodd' d='M8 7a.5.5 0 0 1 .5.5V9H10a.5.5 0 0 1 0 1H8.5v1.5a.5.5 0 0 1-1 0V10H6a.5.5 0 0 1 0-1h1.5V7.5A.5.5 0 0 1 8 7z'/><path d='M4 1.5H3a2 2 0 0 0-2 2V14a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V3.5a2 2 0 0 0-2-2h-1v1h1a1 1 0 0 1 1 1V14a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V3.5a1 1 0 0 1 1-1h1v-1z'/><path d='M9.5 1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-3a.5.5 0 0 1-.5-.5v-1a.5.5 0 0 1 .5-.5h3zm-3-1A1.5 1.5 0 0 0 5 1.5v1A1.5 1.5 0 0 0 6.5 4h3A1.5 1.5 0 0 0 11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3z'/></svg></i></button></div></div>";
            }else{
              return "<div class='text-center'><div class='btn-group'><button title='Novedad' class='btn btn-danger btn-sm btnMostrarNovedadAlimentador'><i class='bi bi-clipboard-plus'><svg xmlns='http://www.w3.org/2000/svg' width='12' height='12' fill='currentColor' class='bi bi-clipboard-plus' viewBox='0 0 16 16'><path fill-rule='evenodd' d='M8 7a.5.5 0 0 1 .5.5V9H10a.5.5 0 0 1 0 1H8.5v1.5a.5.5 0 0 1-1 0V10H6a.5.5 0 0 1 0-1h1.5V7.5A.5.5 0 0 1 8 7z'/><path d='M4 1.5H3a2 2 0 0 0-2 2V14a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V3.5a2 2 0 0 0-2-2h-1v1h1a1 1 0 0 1 1 1V14a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V3.5a1 1 0 0 1 1-1h1v-1z'/><path d='M9.5 1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-3a.5.5 0 0 1-.5-.5v-1a.5.5 0 0 1 .5-.5h3zm-3-1A1.5 1.5 0 0 0 5 1.5v1A1.5 1.5 0 0 0 6.5 4h3A1.5 1.5 0 0 0 11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3z'/></svg></i></button></div></div>";
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
              return "<div class='text-center'><div class='btn-group'><button title='Reporte' class='btn btn-warning btn-sm btnMostrarReporteAlimentador'><i class='bi bi-clipboard-plus'><svg xmlns='http://www.w3.org/2000/svg' width='12' height='12' fill='currentColor' class='bi bi-clipboard-plus' viewBox='0 0 16 16'><path fill-rule='evenodd' d='M8 7a.5.5 0 0 1 .5.5V9H10a.5.5 0 0 1 0 1H8.5v1.5a.5.5 0 0 1-1 0V10H6a.5.5 0 0 1 0-1h1.5V7.5A.5.5 0 0 1 8 7z'/><path d='M4 1.5H3a2 2 0 0 0-2 2V14a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V3.5a2 2 0 0 0-2-2h-1v1h1a1 1 0 0 1 1 1V14a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V3.5a1 1 0 0 1 1-1h1v-1z'/><path d='M9.5 1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-3a.5.5 0 0 1-.5-.5v-1a.5.5 0 0 1 .5-.5h3zm-3-1A1.5 1.5 0 0 0 5 1.5v1A1.5 1.5 0 0 0 6.5 4h3A1.5 1.5 0 0 0 11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3z'/></svg></i></button></div></div>";
            }else{
              return "<div class='text-center'><div class='btn-group'><button title='Reporte' class='btn btn-success btn-sm btnMostrarReporteAlimentador'><i class='bi bi-clipboard-plus'><svg xmlns='http://www.w3.org/2000/svg' width='12' height='12' fill='currentColor' class='bi bi-clipboard-plus' viewBox='0 0 16 16'><path fill-rule='evenodd' d='M8 7a.5.5 0 0 1 .5.5V9H10a.5.5 0 0 1 0 1H8.5v1.5a.5.5 0 0 1-1 0V10H6a.5.5 0 0 1 0-1h1.5V7.5A.5.5 0 0 1 8 7z'/><path d='M4 1.5H3a2 2 0 0 0-2 2V14a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V3.5a2 2 0 0 0-2-2h-1v1h1a1 1 0 0 1 1 1V14a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V3.5a1 1 0 0 1 1-1h1v-1z'/><path d='M9.5 1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-3a.5.5 0 0 1-.5-.5v-1a.5.5 0 0 1 .5-.5h3zm-3-1A1.5 1.5 0 0 0 5 1.5v1A1.5 1.5 0 0 0 6.5 4h3A1.5 1.5 0 0 0 11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3z'/></svg></i></button></div></div>";
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
$(document).on("click", ".btnMostrarNovedadAlimentador", function(){
  filaAlimentador = $(this).closest('tr');
  ControlFacilitador_IdAlimentador = filaAlimentador.find('td:eq(0)').text();

  $('#btnAgregarNovedadAlimentador').hide();
  $('#btn_logueo_alimentador').hide();  
  $('#btnEditarAlimentador').hide();
  $("#formMostrarNovedadAlimentador").trigger("reset");

  Accion='CambiosControlFacilitador';
  $.ajax({
    url: "Ajax.php",
    type: "POST",
    datatype:"json",    
    data: {MoS:MoS,NombreMoS:NombreMoS,Accion:Accion,ControlFacilitador_Id:ControlFacilitador_IdAlimentador},    
    success: function(data){
      $('#div_MostrarNovedadAlimentador').html(data);
    }
  });
  $(".modal-header").css( "background-color", "#17a2b8");
  $(".modal-header").css( "color", "white" );
  $(".modal-title").text("Novedades Alimentador");
  $('#modalCRUDMostrarNovedadAlimentador').modal('show');
});


///::::::::::::.:::::::  EVENTO BOTON MOSTRAR REPORTES  ::::::::::::::::::::::::///
$(document).on("click", ".btnMostrarReporteAlimentador", function(){
  filaAlimentador = $(this).closest('tr'); 
  ControlFacilitador_IdAlimentador = filaAlimentador.find('td:eq(0)').text();
  let Repo_DescripcionAlimentador = "";
  let Repo_BusCambioAlimentador = "";
  let Repo_MotivoAlimentador = "";
  let Repo_HoraSalidaAlimentador = "";
  let HoraSalidaAlimentador = "";
  let MinutoSalidaAlimentador = "";
  let Repo_EstadoAlimentador = "";
  let Repo_UsuarioId_GenerarAlimentador = "";
  let Repo_FechaGenerarAlimentador = "";
  let Repo_UsuarioId_EdicionAlimentador = "";
  let Repo_FechaEdicionAlimentador = "";
  let Repo_UsuarioId_CerrarAlimentador = "";
  let Repo_FechaCerrarAlimentador = "";
  
  $('#btnAgregarNovedadAlimentador').hide();
  $('#btn_logueo_alimentador').hide();  
  $('#btnEditarAlimentador').hide();
  $("#formMostrarReporteAlimentador").trigger("reset");

  Accion='ListarReporte';
  $.ajax({
    url: "Ajax.php",
    type: "POST",
    datatype:"json",    
    async: false,    
    data: {MoS:MoS,NombreMoS:NombreMoS,Accion:Accion,ControlFacilitador_Id:ControlFacilitador_IdAlimentador},    
    success: function(data){
      data = $.parseJSON(data);
      $.each(data, function(idx, obj){ 
        Repo_DescripcionAlimentador = obj.Repo_Descripcion;
        Repo_BusCambioAlimentador = obj.Repo_BusCambio;
        Repo_MotivoAlimentador = obj.Repo_Motivo;
        Repo_HoraSalidaAlimentador = obj.Repo_HoraSalida;
        HoraSalidaAlimentador = Repo_HoraSalidaAlimentador.substring(0,2);;
        MinutoSalidaAlimentador = Repo_HoraSalidaAlimentador.substring(3,5);
        Repo_EstadoAlimentador = obj.Repo_Estado;
        Repo_UsuarioId_GenerarAlimentador = obj.Repo_UsuarioCrear;
        Repo_FechaGenerarAlimentador = obj.Repo_FechaCrear;
        Repo_UsuarioId_EdicionAlimentador = obj.Repo_UsuarioEditar;
        Repo_FechaEdicionAlimentador = obj.Repo_FechaEditar;
        Repo_UsuarioId_CerrarAlimentador = obj.Repo_UsuarioAtender;
        Repo_FechaCerrarAlimentador = obj.Repo_FechaAtender;
      });
      }
  });

  $(".modal-header").css( "background-color", "#17a2b8");
  $(".modal-header").css( "color", "white" );
  $(".modal-title").text( "Reportes Alimentador" );
  $("#Repo_DescripcionAlimentador").val(Repo_DescripcionAlimentador);
  $("#Repo_BusCambioAlimentador").val(Repo_BusCambioAlimentador);
  $("#HoraSalidaAlimentador").val(HoraSalidaAlimentador);
  $("#MinutoSalidaAlimentador").val(MinutoSalidaAlimentador);
  $("#Repo_MotivoAlimentador").val(Repo_MotivoAlimentador);
  $("#Repo_EstadoAlimentador").val(Repo_EstadoAlimentador);
  $("#Repo_UsuarioId_GenerarAlimentador").val(Repo_UsuarioId_GenerarAlimentador);
  $("#Repo_FechaGenerarAlimentador").val(Repo_FechaGenerarAlimentador);
  $("#Repo_UsuarioId_EdicionAlimentador").val(Repo_UsuarioId_EdicionAlimentador);
  $("#Repo_FechaEdicionAlimentador").val(Repo_FechaEdicionAlimentador);
  $("#Repo_UsuarioId_CerrarAlimentador").val(Repo_UsuarioId_CerrarAlimentador);
  $("#Repo_FechaCerrarAlimentador").val(Repo_FechaCerrarAlimentador);
  
  if(Repo_EstadoAlimentador == "ATENDIDO"){
    $("#btnAtendidoReporteAlimentador").prop("hidden",true);
  }else{
    $("#btnAtendidoReporteAlimentador").prop("hidden",false);
  }

  $('#modalCRUDMostrarReporteAlimentador').modal('show');
});

///::::::::::::::::::::::::: FUNCIONES ALIMENTADOR ::::::::::::::::::::::::::::::::::::::::::///

///::::::: FUNCION PARA VALIDAR LOS DATSO INGRESADOS AL FORMULARIO :::::::::::::::::::///
function f_ValidarNuevaNovedadAlimentador(pNove_NovedadAlimentador, pNove_TipoNovedadAlimentador, pNove_DetalleNovedadAlimentador, pNove_DescripcionNovedadAlimentador, pNove_LugarExactoAlimentador, pNove_HoraInicioAlimentador, pNove_HoraFinAlimentador){
  NoLetrasMayuscEspacio=/[^A-Z \Ñ]/;
  let rptaValidarNuevaNovedadAlimentador="";    
  let thora, tminuto, thoraini, thorafin;

  if(pNove_NovedadAlimentador==""){
    $("#Nove_NovedadAlimentador").addClass("color-error");
    rptaValidarNuevaNovedadAlimentador="invalido";
  }
    
  if(pNove_TipoNovedadAlimentador==""){
    $("#Nove_TipoNovedadAlimentador").addClass("color-error");
    rptaValidarNuevaNovedadAlimentador="invalido";
  }

  if(pNove_DetalleNovedadAlimentador==""){
    $("#Nove_DetalleNovedadAlimentador").addClass("color-error");
    rptaValidarNuevaNovedadAlimentador="invalido";
  }

  if(pNove_DescripcionNovedadAlimentador=="" || pNove_DescripcionNovedadAlimentador.length>1500){
    $("#Nove_DescripcionNovedadAlimentador").addClass("color-error");
    rptaValidarNuevaNovedadAlimentador="invalido";
  }

  if(pNove_LugarExactoAlimentador==""){
    $("#Nove_LugarExactoAlimentador").addClass("color-error");
    rptaValidarNuevaNovedadAlimentador="invalido";
  }

  if(pNove_HoraInicioAlimentador==""){
    $("#Nove_HoraInicioAlimentador").addClass("color-error");
    rptaValidarNuevaNovedadAlimentador="invalido";
  }

  if(pNove_HoraFinAlimentador==""){
    $("#Nove_HoraFinAlimentador").addClass("color-error");
    rptaValidarNuevaNovedadAlimentador="invalido";
  }

  // Cambiamos formato string a formato date para comparar
  thora = pNove_HoraInicioAlimentador.substring(0,2);
  tminuto = pNove_HoraInicioAlimentador.substring(3,5);
  thoraini = new Date("0","0","0",thora,tminuto);
  thora = pNove_HoraFinAlimentador.substring(0,2);
  tminuto = pNove_HoraFinAlimentador.substring(3,5);
  thorafin = new Date("0","0","0",thora,tminuto);
  
  if(thoraini > thorafin){
    $("#Nove_HoraInicioAlimentador").text("*No puede ser mayor que la hora fin");
    $("#Nove_HoraInicioAlimentador").addClass("color-error");
    rptaValidarNuevaNovedadAlimentador="invalido";
  }
    
  return rptaValidarNuevaNovedadAlimentador; 
}

///::::::: FUNCION PARA VALIDAR LOS DATSO INGRESADOS AL FORMULARIO :::::::::::::::::::///
function f_ValidarAlimentador(pProg_NombreColaboradorAlimentador, pProg_BusAlimentador, pProg_TipoEventoAlimentador, pProg_HoraOrigenAlimentador, pProg_HoraDestinoAlimentador,pProg_LugarOrigenAlimentador, pProg_LugarDestinoAlimentador, pProg_ServBusAlimentador, pProg_ServicioAlimentador, pProg_SentidoAlimentador, pProg_KmXPuntosAlimentador, pProg_TablaAlimentador, pProg_BusMantoAlimentador, pProg_IdMantoAlimentador, pProg_ObservacionesAlimentador){
  NoLetrasMayuscEspacio=/[^A-Z \Ñ]/;
  var respuestaAlimentador="";    
  let thora, tminuto, thoraini, thorafin;
    
  /* if(pProg_NombreColaboradorAlimentador=="" || NoLetrasMayuscEspacio.test(pProg_NombreColaboradorAlimentador) || pProg_NombreColaboradorAlimentador.length>60){
    $("#Prog_NombreColaboradorAlimentador").addClass("color-error");
    respuestaAlimentador="invalido";
  } */

  /* if(nOpcionGrabarAlimentador!=1){ // Cuando se crea no es necesario ingresar el numero de bus
    if(pProg_BusAlimentador=="" || isNaN(pProg_BusAlimentador) || pProg_BusAlimentador.length!=5){
      $("#Prog_BusAlimentador").addClass("color-error");
      respuestaAlimentador="invalido";
    }
  } */

  if(pProg_TipoEventoAlimentador=="" || pProg_TipoEventoAlimentador.length>45  ){
    $("#Prog_TipoEventoAlimentador").addClass("color-error");
    respuestaAlimentador="invalido";
  }

  if(pProg_HoraOrigenAlimentador==""){
    $("#HoraOrigenAlimentador").addClass("color-error");
    $("#MinutoOrigenAlimentador").addClass("color-error");
    respuestaAlimentador="invalido";
  }

  if(pProg_HoraDestinoAlimentador==""){
    $("#HoraDestinoAlimentador").addClass("color-error");
    $("#MinutoDestinoAlimentador").addClass("color-error");
    respuestaAlimentador="invalido";
  }

  // Cambiamos formato string a formato date para comparar
  thora = pProg_HoraOrigenAlimentador.substring(0,2);
  tminuto = pProg_HoraOrigenAlimentador.substring(3,5);
  thoraini = new Date("0","0","0",thora,tminuto);
  thora = pProg_HoraDestinoAlimentador.substring(0,2);
  tminuto = pProg_HoraDestinoAlimentador.substring(3,5);
  thorafin = new Date("0","0","0",thora,tminuto);

  if(thoraini > thorafin){
    $("#HoraOrigenAlimentador").addClass("color-error");
    $("#MinutoOrigenAlimentador").addClass("color-error");
    respuestaAlimentador="invalido";
  }

  if(pProg_LugarOrigenAlimentador==""){
    $("#Prog_LugarOrigenAlimentador").addClass("color-error");
    respuestaAlimentador="invalido";
  }

  if(pProg_LugarDestinoAlimentador==""){
    $("#Prog_LugarDestinoAlimentador").addClass("color-error");
    respuestaAlimentador="invalido";
  }

  if(pProg_ServBusAlimentador==""){
    $("#Prog_ServBusAlimentador").addClass("color-error");
    respuestaAlimentador="invalido";
  }
  
  if(pProg_ServicioAlimentador==""){
    $("#Prog_ServicioAlimentador").addClass("color-error");
    respuestaAlimentador="invalido";
  }

  if(pProg_SentidoAlimentador==""){
    $("#Prog_SentidoAlimentador").addClass("color-error");
    respuestaAlimentador="invalido";
  }
  
  if(pProg_KmXPuntosAlimentador==""){
    $("#Prog_KmXPuntosAlimentador").addClass("color-error");
    respuestaAlimentador="invalido";
  }

  if(pProg_TablaAlimentador=="" || pProg_TablaAlimentador.length>45){
    $("#Prog_TablaAlimentador").addClass("color-error");
    respuestaAlimentador="invalido";
  }

  /*if(pProg_BusMantoAlimentador==""){
    $("#Prog_BusMantoAlimentador").addClass("color-error");
    respuestaAlimentador="invalido";
  }*/

  if(pProg_IdMantoAlimentador==""){
    $("#Prog_IdMantoAlimentador").addClass("color-error");
    respuestaAlimentador="invalido";
  }

  /*if(pProg_ObservacionesAlimentador==""){
    $("#Prog_ObservacionesAlimentador").addClass("color-error");
    respuestaAlimentador="invalido";
  }*/

  return respuestaAlimentador; 
}

function f_ValidarEditarTotalAlimentador(pProg_IdMantoAlimentador1,pProg_BusAlimentador2){
  NoLetrasMayuscEspacio=/[^A-Z \Ñ]/;
  let respuestaAlimentador="";
  if(pProg_IdMantoAlimentador1!="" || pProg_BusAlimentador2!=""){
    if(pProg_IdMantoAlimentador1=="" || isNaN(pProg_IdMantoAlimentador1)){
      $("#Prog_IdMantoAlimentador1").addClass("color-error");
      respuestaAlimentador="invalido";
    }
    if(pProg_BusAlimentador2=="" || isNaN(pProg_BusAlimentador2) ||  pProg_BusAlimentador2.length!=5){
      $("#Prog_IdMantoAlimentador1").addClass("color-error");
      respuestaAlimentador="invalido";
    }
  }
  return respuestaAlimentador; 
}

///::::::::: INVISIBILIZA LOS MENSAJE DE ALERTA DEL FORMULARIO :::::: /// 
function LimpiaMsControlFacilitadorAlimentador(){
  $("#Prog_NombreColaboradorAlimentador").removeClass("color-error");
  $("#Prog_TablaAlimentador").removeClass("color-error");    
  $("#HoraOrigenAlimentador").removeClass("color-error");
  $("#MinutoOrigenAlimentador").removeClass("color-error");
  $("#HoraDestinoAlimentador").removeClass("color-error");
  $("#MinutoDestinoAlimentador").removeClass("color-error");
  $("#Prog_ServicioAlimentador").removeClass("color-error");
  $("#Prog_ServBusAlimentador").removeClass("color-error");
  $("#Prog_BusAlimentador").removeClass("color-error");
  $("#Prog_LugarOrigenAlimentador").removeClass("color-error");
  $("#Prog_LugarDestinoAlimentador").removeClass("color-error");
  $("#Prog_TipoEventoAlimentador").removeClass("color-error");
  $("#Prog_KmXPuntosAlimentador").removeClass("color-error");
  $("#Prog_SentidoAlimentador").removeClass("color-error");
  $("#Prog_BusMantoAlimentador").removeClass("color-error");
  $("#Prog_IdMantoAlimentador").removeClass("color-error");
  $("#Prog_ObservacionesAlimentador").removeClass("color-error");
  $("#Nove_NovedadAlimentador").removeClass("color-error");
  $("#Nove_TipoNovedadAlimentador").removeClass("color-error");
  $("#Nove_DetalleNovedadAlimentador").removeClass("color-error");
  $("#Nove_DescripcionNovedadAlimentador").removeClass("color-error");
  $("#Nove_LugarExactoAlimentador").removeClass("color-error");
  $("#HoraInicioAlimentador").removeClass("color-error");
  $("#MinutoInicioAlimentador").removeClass("color-error");
  $("#HoraFinAlimentador").removeClass("color-error");
  $("#MinutoFinAlimentador").removeClass("color-error");
  $("#Prog_IdMantoAlimentador1").removeClass("color-error");
  $("#Prog_BusAlimentador2").removeClass("color-error");
}

//:::: VALIDAR SI EXISTEN EVENTOS REGISTRADOS ::::://
function ValidarNovedadAlimentador(Validar_Fecha,Validar_Operacion){
  RptaNovedadAlimentador = ""; // "NO NOVEDADES" o "SI NOVEDADES"
  Accion='ValidarNovedad'; 
  $.ajax({
    url: "Ajax.php",
    type: "POST",
    datatype:"json",
    async: false,    
    data: {MoS:MoS,NombreMoS:NombreMoS,Accion:Accion,Prog_Fecha:Validar_Fecha,Prog_Operacion:Validar_Operacion},    
    success: function(data){
      RptaNovedadAlimentador = data;
    }
  });

  if(RptaNovedadAlimentador=="SI NOVEDADES"){
    $("#btn_AsociarNovedadAlimentador").prop("disabled",false);
    $("#label_AsociarNovedadAlimentador").prop("title","");
  }else{
    $("#btn_AsociarNovedadAlimentador").prop("disabled",true);
    $("#label_AsociarNovedadAlimentador").prop("title","No Existen Novedades")
  }
  $("#btn_NuevaNovedadAlimentador").attr("checked",true);
  $("#btn_AsociarNovedadAlimentador").attr("checked",false);
  return RptaNovedadAlimentador;
}

//:::: HABILITAR O DESHABILITAR LA EDICION DE LOS CAMPOS ::::://
function fEdicionCamposAlimentador(tOpcion,bValor){
  $("#Prog_NombreColaboradorAlimentador").prop(tOpcion, bValor);
  $("#Prog_TablaAlimentador").prop(tOpcion, bValor);
  $("#Prog_HoraOrigenAlimentador").prop(tOpcion, bValor);
  $("#Prog_HoraDestinoAlimentador").prop(tOpcion, bValor);
  $("#Prog_ServicioAlimentador").prop(tOpcion, bValor);
  $("#Prog_ServBusAlimentador").prop(tOpcion, bValor);
  $("#Prog_BusAlimentador").prop(tOpcion, bValor);
  $("#Prog_LugarOrigenAlimentador").prop(tOpcion, bValor);
  $("#Prog_LugarDestinoAlimentador").prop(tOpcion, bValor);
  $("#Prog_TipoEventoAlimentador").prop(tOpcion, bValor);
  $("#Prog_KmXPuntosAlimentador").prop(tOpcion, bValor);
  $("#Prog_SentidoAlimentador").prop(tOpcion, bValor);
  $("#Prog_BusMantoAlimentador").prop(tOpcion, bValor);
  $("#Prog_IdMantoAlimentador").prop(tOpcion, bValor);
  $("#Prog_ObservacionesAlimentador").prop(tOpcion, bValor);
  $("#HoraOrigenAlimentador").prop(tOpcion, bValor);
  $("#MinutoOrigenAlimentador").prop(tOpcion, bValor);
  $("#HoraDestinoAlimentador").prop(tOpcion, bValor);
  $("#MinutoDestinoAlimentador").prop(tOpcion, bValor);

}

function fColorFilasControlFacilitadorAlimentador(row,data){
  let color_rojo = "#E26A5A";
  let color_verde = "#009390";
  let color_azul = "#005EA4";
  let color_amarillo = "#ffff006b";
  // Columna TipoTabla
  if(data.Prog_TipoTablaAlimentador == 'AM') {
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
  if(data.Prog_TipoTablaAlimentador == 'HP') {
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
  if(data.Prog_SentidoAlimentador=='NS' || data.Prog_SentidoAlimentador=='NS-AM' || data.Prog_SentidoAlimentador=='NS-PM'){
    if(data.Prog_LugarOrigenAlimentador != 'PATIO NORTE'){
      $("td:eq(9)",row).css({
        "color":color_verde,
      });
    }
    if(data.Prog_LugarDestinoAlimentador != 'PATIO NORTE'){
      $("td:eq(10)",row).css({
        "color":color_rojo,
      });
    }
  }
  if(data.Prog_SentidoAlimentador=='SN' || data.Prog_SentidoAlimentador=='SN-AM' || data.Prog_SentidoAlimentador=='SN-PM'){
    if(data.Prog_LugarOrigenAlimentador != 'PATIO NORTE'){
      $("td:eq(9)",row).css({
        "color":color_rojo,
      });
    }
    if(data.Prog_LugarDestinoAlimentador != 'PATIO NORTE'){
      $("td:eq(10)",row).css({
        "color":color_verde,
      });
    }
  }
  // Columna Tipo Evento
  if(data.Prog_TipoEventoAlimentador=='INICIO AUTOBUS' || data.Prog_TipoEventoAlimentador=='FIN AUTOBUS'){
    $("td:eq(11)",row).css({
      "font_weight":"bold",
    });
  }
  // Columnas de ServBus, Bus, Placa y VID
  if(data.Prog_colBusAlimentador == 0){
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
  if(data.Prog_colBusAlimentador == 1){
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
  if(data.Prog_colTablaAlimentador == 0){
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

function f_CargaVariablesFilaAlimentador(){
  ControlFacilitador_IdAlimentador  = filaAlimentador.find('td:eq(0)').text();
  Prog_NombreColaboradorAlimentador = filaAlimentador.find('td:eq(2)').text();
  Prog_TablaAlimentador             = filaAlimentador.find('td:eq(3)').text();
  Prog_HoraOrigenAlimentador        = filaAlimentador.find('td:eq(4)').text();
  Prog_HoraDestinoAlimentador       = filaAlimentador.find('td:eq(5)').text();
  Prog_ServicioAlimentador          = filaAlimentador.find('td:eq(6)').text();
  Prog_ServBusAlimentador           = filaAlimentador.find('td:eq(7)').text();
  Prog_BusAlimentador               = filaAlimentador.find('td:eq(8)').text();
  Prog_LugarOrigenAlimentador       = filaAlimentador.find('td:eq(9)').text();
  Prog_LugarDestinoAlimentador      = filaAlimentador.find('td:eq(10)').text();
  Prog_TipoEventoAlimentador        = filaAlimentador.find('td:eq(11)').text();
  Prog_ObservacionesAlimentador     = filaAlimentador.find('td:eq(12)').text();
  Prog_KmXPuntosAlimentador         = filaAlimentador.find('td:eq(13)').text();
  Prog_SentidoAlimentador           = filaAlimentador.find('td:eq(15)').text();
  Prog_BusMantoAlimentador          = filaAlimentador.find('td:eq(16)').text();
  Prog_IdMantoAlimentador           = filaAlimentador.find('td:eq(17)').text();
  
  HoraOrigenAlimentador             = Prog_HoraOrigenAlimentador.substring(0,2);
  MinutoOrigenAlimentador           = Prog_HoraOrigenAlimentador.substring(3,5);
  HoraDestinoAlimentador            = Prog_HoraDestinoAlimentador.substring(0,2);
  MinutoDestinoAlimentador          = Prog_HoraDestinoAlimentador.substring(3,5);

  Nove_LugarExactoAlimentador       = Prog_LugarOrigenAlimentador;
  HoraInicioAlimentador             = HoraOrigenAlimentador; 
  MinutoInicioAlimentador           = MinutoOrigenAlimentador;
}

function f_CargaVariablesVacioAlimentador(){
  Prog_NombreColaboradorAlimentador = "";
  Prog_TablaAlimentador = "";
  Prog_HoraOrigenAlimentador = "";
  Prog_HoraDestinoAlimentador = "";
  Prog_ServicioAlimentador = "";
  Prog_ServBusAlimentador = "";
  Prog_BusAlimentador = "";
  Prog_LugarOrigenAlimentador = "";
  Prog_LugarDestinoAlimentador = "";
  Prog_TipoEventoAlimentador = "";
  Prog_KmXPuntosAlimentador = "";
  Prog_SentidoAlimentador = "";
  Prog_BusMantoAlimentador = "";
  Prog_IdMantoAlimentador = "";
  Prog_ObservacionesAlimentador = "";
  HoraOrigenAlimentador = "";
  MinutoOrigenAlimentador = "";
  HoraDestinoAlimentador = "";
  MinutoDestinoAlimentador = "";

  Nove_LugarExactoAlimentador = "";
  HoraInicioAlimentador = ""; 
  MinutoInicioAlimentador = "";
}

function f_CargaVariablesHtmlVacioAlimentador(){
  document.getElementById("Prog_NombreColaboradorAlimentador").placeholder = "";
  document.getElementById("Prog_TablaAlimentador").placeholder = "";      
  document.getElementById("Prog_ServicioAlimentador").placeholder = "";
  document.getElementById("Prog_ServBusAlimentador").placeholder = "";
  document.getElementById("Prog_BusAlimentador").placeholder = "";
  document.getElementById("Prog_LugarOrigenAlimentador").placeholder = "";
  document.getElementById("Prog_LugarDestinoAlimentador").placeholder = "";
  document.getElementById("Prog_TipoEventoAlimentador").placeholder = "";
  document.getElementById("Prog_KmXPuntosAlimentador").placeholder = "";
  document.getElementById("Prog_SentidoAlimentador").placeholder = "";
  document.getElementById("Prog_BusMantoAlimentador").placeholder = "";
  document.getElementById("Prog_IdMantoAlimentador").placeholder = "";
  document.getElementById("Prog_ObservacionesAlimentador").placeholder = "";
  document.getElementById("HoraOrigenAlimentador").placeholder = "";
  document.getElementById("MinutoOrigenAlimentador").placeholder = "";
  document.getElementById("HoraDestinoAlimentador").placeholder = "";
  document.getElementById("MinutoDestinoAlimentador").placeholder = "";

  document.getElementById("Nove_LugarExactoAlimentador").placeholder = "";
  document.getElementById("HoraInicioAlimentador").placeholder = "";
  document.getElementById("MinutoInicioAlimentador").placeholder = "";
}

function f_CargaVariablesHtmlDataAlimentador(){
  $("#Prog_NombreColaboradorAlimentador").val(Prog_NombreColaboradorAlimentador);
  $("#Prog_TablaAlimentador").val(Prog_TablaAlimentador);    
  $("#Prog_ServicioAlimentador").val(Prog_ServicioAlimentador);
  $("#Prog_ServBusAlimentador").val(Prog_ServBusAlimentador);
  $("#Prog_BusAlimentador").val(Prog_BusAlimentador);
  $("#Prog_LugarOrigenAlimentador").val(Prog_LugarOrigenAlimentador);
  $("#Prog_LugarDestinoAlimentador").val(Prog_LugarDestinoAlimentador);
  $("#Prog_TipoEventoAlimentador").val(Prog_TipoEventoAlimentador);
  $("#Prog_KmXPuntosAlimentador").val(Prog_KmXPuntosAlimentador);
  $("#Prog_SentidoAlimentador").val(Prog_SentidoAlimentador);
  $("#Prog_BusMantoAlimentador").val(Prog_BusMantoAlimentador);
  $("#Prog_IdMantoAlimentador").val(Prog_IdMantoAlimentador);
  $("#Prog_ObservacionesAlimentador").val(Prog_ObservacionesAlimentador);
  $("#HoraOrigenAlimentador").val(HoraOrigenAlimentador);
  $("#MinutoOrigenAlimentador").val(MinutoOrigenAlimentador);
  $("#HoraDestinoAlimentador").val(HoraDestinoAlimentador);
  $("#MinutoDestinoAlimentador").val(MinutoDestinoAlimentador);

  $("#Nove_LugarExactoAlimentador").val(Nove_LugarExactoAlimentador);
  $("#HoraInicioAlimentador").val(HoraInicioAlimentador);
  $("#MinutoInicioAlimentador").val(MinutoInicioAlimentador);
  $("#HoraFinAlimentador").val(HoraInicioAlimentador);
  $("#MinutoFinAlimentador").val(MinutoInicioAlimentador);
}

function f_CargaVariablesHtmlTextoAlimentador(xtextoAlimentador){
  document.getElementById("Prog_NombreColaboradorAlimentador").placeholder = xtextoAlimentador;
  document.getElementById("Prog_TablaAlimentador").placeholder = xtextoAlimentador;    
  document.getElementById("Prog_ServicioAlimentador").placeholder = xtextoAlimentador;
  document.getElementById("Prog_ServBusAlimentador").placeholder = xtextoAlimentador;
  document.getElementById("Prog_BusAlimentador").placeholder = xtextoAlimentador;
  document.getElementById("Prog_LugarOrigenAlimentador").placeholder = xtextoAlimentador;
  document.getElementById("Prog_LugarDestinoAlimentador").placeholder = xtextoAlimentador;
  document.getElementById("Prog_TipoEventoAlimentador").placeholder = xtextoAlimentador;
  document.getElementById("Prog_KmXPuntosAlimentador").placeholder = xtextoAlimentador;
  document.getElementById("Prog_SentidoAlimentador").placeholder = xtextoAlimentador;
  document.getElementById("Prog_BusMantoAlimentador").placeholder = xtextoAlimentador;
  document.getElementById("Prog_IdMantoAlimentador").placeholder = xtextoAlimentador;
  document.getElementById("Prog_ObservacionesAlimentador").placeholder = xtextoAlimentador;
  document.getElementById("HoraOrigenAlimentador").placeholder = "";
  document.getElementById("MinutoOrigenAlimentador").placeholder = "";
  document.getElementById("HoraDestinoAlimentador").placeholder = "";
  document.getElementById("MinutoDestinoAlimentador").placeholder = "";

  document.getElementById("Nove_LugarExactoAlimentador").placeholder = "";
  document.getElementById("HoraInicioAlimentador").placeholder = "";
  document.getElementById("MinutoInicioAlimentador").placeholder = "";
}