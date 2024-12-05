///::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
///:: TAB INFORME PRELIMINAR v 3.0  FECHA: 2022-08-03 :::::::::::::::::::::::::::::::::::::///
///:: EDITAR TABLA OPE_INFORMEPRELIMINAR ::::::::::::::::::::::::::::::::::::::::::::::::::///
///::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///

///:: DECLARACION DE VARIABLES ::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
var InformePreliminar_Id,Acci_TipoAccidente,Acci_ClaseAccidente,Acci_DanosMateriales,Acci_Lesiones,Acci_Fatalidad,Acci_Otro,Acci_OtroDescripcion,Acci_TipoEvento,Acci_FechaAccidente,Acci_HoraAccidente,HoraAccidente,MinutoAccidente,Acci_Dni,Acci_CodigoColaborador,Acci_NombreColaborador,Acci_TablaAccidente,Acci_ServicioAccidente,Acci_LugarAccidente,Acci_NroPlacaAccidente,Acci_BusAccidente,Acci_SentidoAccidente,Acci_km_perdidos_accidente,Acci_ConciliacionAccidente,Acci_MontoConciliadoAccidente,Acci_NombreCGO,Acci_NombrePersonalApoyo,Acci_ReconoceResponsabilidadAccidente,Acci_HospitalAccidente,Acci_ComisariaAccidente,Acci_HoraFinAtencion,HoraFinAtencionAccidente,MinutoFinAtencionAccidente,Acci_HorasTrabajadas,HoraTrabajadasAccidente,MinutoTrabajadosAccidente,Acci_ObjetoAccidente,Acci_HoraLlegadaProcurador,HoraLlegadaProcurador,MinutoLlegadaProcurador,Acci_NombreCGM,Acci_NombrePersonalApoyoManto, Acci_DocReporteAccidente,Acci_DocConciliacion,Acci_DocPartePolicial,Acci_DocOficioPeritaje,Acci_DocReporteAtencion,Acci_DocDenunciaPolicial,Acci_DocCitacionManifestacion,Acci_DocOtro,Acci_DocOtroDescripcion,Acci_DescripcionAccidente,Acci_NombreSuscribeInformacion,Acci_FechaElaboracionInforme,Acci_UsuarioId_Cerrar,Acci_FechaCerrar, acci_log_ip, acci_lugar_referencia;
var Acci_TipoNaturaleza, OPE_AcciNaturalezaId, Acci_DescripcionNaturaleza, Acci_TipoImagen, Acci_Imagen, OPE_AcciReparacionId, Acci_EstadoInformePreliminar, Acci_Operacion;
var MostrarBorrar,opcionCargaImagenes, opcionDanosMateriales, opcionDanosPersonales, opcionDanosTerceros, opcionCausasAcciones, filaNaturaleza, filaReparacion, editarInformePreliminar;
var tablaCausasAccidentes, tablaAccionesTomadas;

MostrarBorrar = "SI"; // Mostrar la columna de borrar en los datataables
///:: TERMINO DECLARACION DE VARIABLES ::::::::::::::::::::::::::::::::::::::::::::::::::::///

///:: INICIO DOM JS INFORME PRELIMINAR ::::::::::::::::::::::::::::::::::::::::::::::::::::///
$(document).ready(function(){
  div_tabs = f_CreacionTabs("nav-tab-InformePreliminar","");
  $("#nav-tab-InformePreliminar").html(div_tabs);
  $("#nav-tab-InformePreliminar").hide();
  $("#nav-tabContent-profile").hide();

  ///:: SE CARGAN LOS BOTONES :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
  ///:: boton de generar un nuevo registro
  div_boton = f_BotonesFormulario("formAccidenteIncidente","div_btnInformePreliminar");
  $("#div_btnInformePreliminar").html(div_boton);
  ///:: boton de agregar daños personales
  div_boton = f_BotonesFormulario("formDanosPersonales","div_btnAgregarDanosPersonales");
  $("#div_btnAgregarDanosPersonales").html(div_boton);
  ///:: boton de agregar daños terceros
  div_boton = f_BotonesFormulario("formDanosTerceros","div_btnAgregarDanosTerceros");
  $("#div_btnAgregarDanosTerceros").html(div_boton);
  ///:: boton de agregar causas accidentes
  div_boton = f_BotonesFormulario("formCausasAccidentes","div_btnAgregarCausasAccidentes");
  $("#div_btnAgregarCausasAccidentes").html(div_boton);
  ///:: boton de agregar acciones tomadas
  div_boton = f_BotonesFormulario("formAccionesTomadas","div_btnAgregarAccionesTomadas");
  $("#div_btnAgregarAccionesTomadas").html(div_boton);
  ///:: boton de agregar daños reparacion
  div_boton = f_BotonesFormulario("formDanosReparacion","div_btnAgregarDanosReparacion");
  $("#div_btnAgregarDanosReparacion").html(div_boton);
  ///:: boton para cerrar informe preliminar
  div_boton = f_BotonesFormulario("formDanosReparacion","div_btn_cerrar_informe_preliminar");
  $("#div_btn_cerrar_informe_preliminar").html(div_boton);
  ///:: TERMINO CARGAN LOS BOTONES ::::::::::::::::::::::::::::::::::::::::::::::::::::::::///

  ///:: Si hay cambios en Fecha se actualiza las Tablas para Accidentes :::::::::::::::::::///
  $("#Acci_FechaAccidente").on('change', function () {
    Acci_FechaAccidente = $("#Acci_FechaAccidente").val();
    Acci_BusAccidente   = $("#Acci_BusAccidente").val();
    Accion='SelectTablaAccidente';
    $.ajax({
      url       : "Ajax.php",
      type      : "POST",
      datatype  : "json",    
      data      : {MoS:MoS,NombreMoS:NombreMoS,Accion:Accion,Prog_Fecha:Acci_FechaAccidente},    
      success   : function(data){
        $("#Acci_TablaAccidente").html(data);
      }
    });
    Acci_HorasTrabajadas = f_horas_trabajadas(Acci_Operacion, Acci_FechaAccidente, Acci_Dni, Acci_HoraAccidente);
    if(Acci_HorasTrabajadas!=""){
      HoraTrabajadasAccidente   = Acci_HorasTrabajadas.substring(0,2) ;
      MinutoTrabajadosAccidente = Acci_HorasTrabajadas.substring(3,5) ;  
    }
    $("#HoraTrabajadasAccidente").val(HoraTrabajadasAccidente);
    $("#MinutoTrabajadosAccidente").val(MinutoTrabajadosAccidente);
    Acci_km_perdidos_accidente = f_km_perdidos(Accidentes_Id, Acci_Operacion, Acci_BusAccidente, Acci_FechaAccidente);
    $("#Acci_km_perdidos_accidentes").val(Acci_km_perdidos_accidente);
  });

  ///:: Si hay cambios en tabla de accidentes se actualiza el servicio ::::::::::::::::::::///
  $("#Acci_TablaAccidente").on('change', function () {
    Acci_FechaAccidente = $("#Acci_FechaAccidente").val();
    Acci_TablaAccidente = $("#Acci_TablaAccidente").val();
    Accion='BuscarServicio';
    $.ajax({
      url       : "Ajax.php",
      type      : "POST",
      datatype  : "json",    
      data      : {MoS:MoS,NombreMoS:NombreMoS,Accion:Accion,Prog_Fecha:Acci_FechaAccidente,Prog_Tabla:Acci_TablaAccidente},    
      success   : function(data){
        $("#Acci_ServicioAccidente").val(data);
      }
    });
  });

  ///:: Si hay cambios en Consecuencias de Accidente se actualiza el campo Clinica de Accidente ::///
  $("#Acci_Lesiones").on('change', function () {
    Acci_Lesiones = $("#Acci_Lesiones").val();
    if(Acci_Lesiones=="SIN LESIONES"){
      Acci_HospitalAccidente = "NINGUNO";
      $("#Acci_HospitalAccidente").prop('disabled', true);
    }else{
      Acci_HospitalAccidente = "";
      $("#Acci_HospitalAccidente").prop('disabled', false);
    }
    $("#Acci_HospitalAccidente").val(Acci_HospitalAccidente);
  });

  ///:: Si hay cambios en Conciliacion de Accidente se habilita o deshabilita el Monto Conciliado ::///
  $("#Acci_ConciliacionAccidente").on('change', function () {
    let nValor="";
    Acci_ConciliacionAccidente = $("#Acci_ConciliacionAccidente").val();
    if(Acci_ConciliacionAccidente=='SI'){
      $("#Acci_MontoConciliadoAccidente").prop('disabled', false);
    }else{
      $("#Acci_MontoConciliadoAccidente").val(nValor);
      $("#Acci_MontoConciliadoAccidente").prop('disabled', true);
    }
  });

  ///:: Si hay cambios en Consecuencias de Accidente se habilita o deshabilita el campo OtroDescripcion ::///
  $("#Acci_DocOtro").on('change', function () {
    let nValor="";
    Acci_DocOtro = document.getElementById("Acci_DocOtro");
    if (Acci_DocOtro.checked == true){
      $("#Acci_DocOtroDescripcion").prop('disabled', false);
    } else {
      $("#Acci_DocOtroDescripcion").val(nValor);
      $("#Acci_DocOtroDescripcion").prop('disabled', true);
    }
  });

  ///:: Si hay cambios en nombre colaborador se actualiza el nro. Dni y el codigo de colaborador ::///
  $("#Acci_NombreColaborador").on('change', function () {
    Acci_NombreColaborador = $("#Acci_NombreColaborador").val();
    Accion = 'BuscarColaborador';
    $.ajax({
      url       : "Ajax.php",
      type      : "POST",
      datatype  : "json",    
      data      : {MoS:MoS,NombreMoS:NombreMoS,Accion:Accion,Acci_NombreColaborador:Acci_NombreColaborador},    
      success: function(data){
        data = $.parseJSON(data);
        $.each(data, function(idx, obj){ 
          Acci_Dni = obj.Acci_Dni;
          Acci_CodigoColaborador = obj.Acci_CodigoColaborador;
        });
        $("#Acci_Dni").val(Acci_Dni);
        $("#Acci_CodigoColaborador").val(Acci_CodigoColaborador);
      }
    });
    Acci_HorasTrabajadas = f_horas_trabajadas(Acci_Operacion, Acci_FechaAccidente, Acci_Dni, Acci_HoraAccidente);
    if(Acci_HorasTrabajadas!=""){
      HoraTrabajadasAccidente   = Acci_HorasTrabajadas.substring(0,2) ;
      MinutoTrabajadosAccidente = Acci_HorasTrabajadas.substring(3,5) ;  
    }
    $("#HoraTrabajadasAccidente").val(HoraTrabajadasAccidente);
    $("#MinutoTrabajadosAccidente").val(MinutoTrabajadosAccidente);
  });

  ///:: Si hay cambios en tabla de accidentes se actualiza el servicio ::::::::::::::::::::///
  $("#Acci_BusAccidente").on('change', function () {
    Acci_BusAccidente   = $("#Acci_BusAccidente").val();
    Acci_FechaAccidente = $("#Acci_FechaAccidente").val();
    Accion = 'BuscarNroPlaca';
    $.ajax({
      url: "Ajax.php",
      type: "POST",
      datatype:"json",    
      data: {MoS:MoS,NombreMoS:NombreMoS,Accion:Accion,Acci_Bus:Acci_BusAccidente},    
      success: function(data){
        $("#Acci_NroPlacaAccidente").val(data);
      }
    });
    Acci_km_perdidos_accidente = f_km_perdidos(Accidentes_Id, Acci_Operacion, Acci_BusAccidente, Acci_FechaAccidente);
    $("#Acci_km_perdidos_accidentes").val(Acci_km_perdidos_accidente);
  });

  $("#HoraAccidente").on('change', function(){
    HoraAccidente   = $.trim($('#HoraAccidente').val());
    MinutoAccidente = $.trim($('#MinutoAccidente').val());
    if(HoraAccidente !="" && MinutoAccidente!=""){
      Acci_HoraAccidente = HoraAccidente + ":" + MinutoAccidente;
    }
    Acci_HorasTrabajadas = f_horas_trabajadas(Acci_Operacion, Acci_FechaAccidente, Acci_Dni, Acci_HoraAccidente);
    if(Acci_HorasTrabajadas!=""){
      HoraTrabajadasAccidente   = Acci_HorasTrabajadas.substring(0,2) ;
      MinutoTrabajadosAccidente = Acci_HorasTrabajadas.substring(3,5) ;  
    }
    $("#HoraTrabajadasAccidente").val(HoraTrabajadasAccidente);
    $("#MinutoTrabajadosAccidente").val(MinutoTrabajadosAccidente);
  })

  $("#MinutoAccidente").on('change', function(){
    HoraAccidente   = $.trim($('#HoraAccidente').val());
    MinutoAccidente = $.trim($('#MinutoAccidente').val());
    if(HoraAccidente !="" && MinutoAccidente!=""){
      Acci_HoraAccidente = HoraAccidente + ":" + MinutoAccidente;
    }
    Acci_HorasTrabajadas = f_horas_trabajadas(Acci_Operacion, Acci_FechaAccidente, Acci_Dni, Acci_HoraAccidente);
    if(Acci_HorasTrabajadas!=""){
      HoraTrabajadasAccidente   = Acci_HorasTrabajadas.substring(0,2) ;
      MinutoTrabajadosAccidente = Acci_HorasTrabajadas.substring(3,5) ;  
    }
    $("#HoraTrabajadasAccidente").val(HoraTrabajadasAccidente);
    $("#MinutoTrabajadosAccidente").val(MinutoTrabajadosAccidente);
  })

  ///:: INICIO BOTONES ACCIDENTES :::::::::::::::::::::::::::::::::::::::::::::::::::::::::///

  ///:: BOTON CARGAR Informe Preliminar :::::::::::::::::::::::::::::::::::::::::::::::::::///
  $("#btnBuscarInformePreliminar").on("click",function(){
    // SE OCULTAN LOS TABS DE INFORME PRELIMINAR
    $("#nav-tab-InformePreliminar").hide();
    $("#nav-tabContent-profile").hide();

    // Se declaran variables privadas  
    let buscarImagen = "";
    let pImagen = "";
    let ingresarInformePreliminar = 0; // 0: SI INGRESA, 1: NO INGRESA
    editarInformePreliminar = 0; // 0: EDITAR INFORME PRELIMINAR, 1: CREAR INFORME PRELIMINAR

    InformePreliminar_Id = $("#selectInformePreliminar_Id").val();
    f_CargarVariablesVacioInformePreliminar(); // se inicialiazan las variables de informe preliminar

    // SE ACTIVAN LOS TAB DE EL INFORME PRELIMINAR
    $("#nav-NaturalezaPerdida-tab").prop("disabled",false);
    $("#nav-CausasAcciones-tab").prop("disabled",false);
    $("#nav-Imagenes-tab").prop("disabled",false);
    $("#nav-DanosReparacion-tab").prop("disabled",false);

    // Se oculta boton guardar y se muestra boton editar
    $("#btnCancelarInformePreliminar").hide();
    $("#btnGuardarInformePreliminar").hide();
    $("#btnEditarInformePreliminar").show()
    $("#btnCerrarInformePreliminar").hide();
    $("#btnAbrirInformePreliminar").hide();
    $("#btn_generar_pdf_informe_preliminar").show();

    $("#btnAgregarDanosPersonales").show();
    $("#btnAgregarDanosTerceros").show();
    $("#btnAgregarCausasAccidentes").show();
    $("#btnAgregarAccionesTomadas").show();
    $("#btnAgregarDanosReparacion").show();
    $(".btn_cargar_imagenes_ip").show();
    MostrarBorrar = "SI";

    f_EdicionCamposInformePreliminar('disabled', true);

    // SE REVISA EL ESTADO DEL INFORME PRELIMINAR
    Acci_EstadoInformePreliminar = f_buscar_dato("OPE_AccidentesInformePreliminar", "Acci_EstadoInformePreliminar", "`Accidentes_Id`='"+InformePreliminar_Id+"'");
    /* Acci_EstadoInformePreliminar = "";
    Accion='EstadoInformePreliminar';
    $.ajax({
      url: "Ajax.php",
      type: "POST",
      datatype:"json",
      async: false,    
      data: {MoS:MoS,NombreMoS:NombreMoS,Accion:Accion,Accidentes_Id:InformePreliminar_Id},    
      success: function(data){
        Acci_EstadoInformePreliminar = data;
      }
    }); */

    // SI EL ESTADO ES VACIO SE REALIZA LA CARGA INICIAL DEL INFORME PRELIMINAR CON LA INFORMACION DEL CONTROL FACILITADOR Y NOVEDAD
    if(Acci_EstadoInformePreliminar==""){
      // SE INACTIVAN LOS TABS DEL INFORME PRELIMINAR
      $("#nav-NaturalezaPerdida-tab").prop("disabled",true);
      $("#nav-CausasAcciones-tab").prop("disabled",true);
      $("#nav-Imagenes-tab").prop("disabled",true);
      $("#nav-DanosReparacion-tab").prop("disabled",true);
      // SI SE TIENE CARGADA EL ID NOVEDAD ENTONCES BUSCAMOS Y CARGAMOS INFORMACION DE LA NOVEDAD
      if(Nove_ProgramacionId!="" && Novedad_Id!=""){
        editarInformePreliminar = 1;
        ingresarInformePreliminar = 1;
        Accion='CargarNovedad';
        $.ajax({
          url: "Ajax.php",
          type: "POST",
          datatype:"json",
          async: false,    
          data: {MoS:MoS,NombreMoS:NombreMoS,Accion:Accion,Nove_ProgramacionId:Nove_ProgramacionId,Novedad_Id:Novedad_Id},    
          success: function(data){
            data = $.parseJSON(data);
            f_CargarVariablesInformePreliminar(data);
          }
        });
      }
    }else{
      // SE BUSCA Y CARGA EL INFORME PRELIMINAR

      editarInformePreliminar   = 0;
      ingresarInformePreliminar = 1;
      Accion = 'BuscarInformePreliminar';
      $.ajax({
        url       : "Ajax.php",
        type      : "POST",
        datatype  : "json",
        async     : false,    
        data      : {MoS:MoS,NombreMoS:NombreMoS,Accion:Accion,Accidentes_Id:InformePreliminar_Id},    
        success   : function(data){
          data = $.parseJSON(data);
          f_CargarVariablesInformePreliminar(data);
        }
      });
      // SI EL ESTADO ES CERRADO SE INFORMA Y SE DESHABILITAN TODOS LOS BOTONES DE EDICION
      if(Acci_EstadoInformePreliminar=="CERRADO"){
        Swal.fire(
          'Cerrado!',
          'El Informe Preliminar se encuentra cerrado.',
          'success'
        )
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
      }else{
        $("#btnCerrarInformePreliminar").show();
        $("#btnAbrirInformePreliminar").hide();
      }
    }

    if(ingresarInformePreliminar==0){
      Swal.fire(
        'NO ENCONTRADO!',
        'El Informe Preliminar no se encuentra creado',
        'success'
      )
    }else{
      // SE CARGAN TODOS LOS COMBOS
      // COMBOS DE USUARIOS
      Accion='SelectUsuario';
      Usua_Perfil = 'PILOTO';
      $("#Acci_NombreColaborador").html(f_select_usuario(Usua_Perfil));
      Usua_Perfil = 'CGO';
      $("#Acci_NombreCGO").html(f_select_usuario(Usua_Perfil));
      Usua_Perfil = 'PERSONAL OPERACIONES';
      $("#Acci_NombrePersonalApoyo").html(f_select_usuario(Usua_Perfil));
      Usua_Perfil = 'CGM';
      $("#Acci_NombreCGM").html(f_select_usuario(Usua_Perfil));
      Usua_Perfil = 'PERSONAL MANTENIMIENTO';
      $("#Acci_NombrePersonalApoyoManto").html(f_select_usuario(Usua_Perfil));

      // COMBOS DE BUS
      Accion='SelectBus'; 
      $.ajax({
        url: "Ajax.php",
        type: "POST",
        datatype:"json",
        async: false,
        data: {MoS:MoS,NombreMoS:NombreMoS,Accion:Accion},    
        success: function(data){
          $("#Acci_BusAccidente").html(data);
        }
      });

      // COMBOS GENERALES DE TABLA TIPO PARA LIMABUS
      Tipo='DECIDIR';
      Operacion='INFORME PRELIMINAR';
      selectHtmlAccidentes="";
      selectHtmlAccidentes = f_TipoTabla(Operacion,Tipo);
      $("#Acci_ConciliacionAccidente").html(selectHtmlAccidentes);
      $("#Acci_ReconoceResponsabilidadAccidente").html(selectHtmlAccidentes);
      Tipo='SENTIDO';
      selectHtmlAccidentes="";
      selectHtmlAccidentes = f_TipoTabla(Operacion,Tipo);
      $("#Acci_SentidoAccidente").html(selectHtmlAccidentes);
      Tipo='COMISARIA';
      selectHtmlAccidentes="";
      selectHtmlAccidentes = f_TipoTabla(Operacion,Tipo);
      $("#Acci_ComisariaAccidente").html(selectHtmlAccidentes);
      // COMBOS DE TABLA TIPO PARA ACCIDENTES
      Tipo='TIPO_ACCIDENTE';
      selectHtmlAccidentes="";
      selectHtmlAccidentes = f_TipoTabla(Operacion,Tipo);
      $("#Acci_TipoAccidente").html(selectHtmlAccidentes);
      //Tipo=Acci_TipoAccidente;
      Tipo='CLASE_ACCIDENTE';
      selectHtmlAccidentes="";
      selectHtmlAccidentes = f_TipoTabla(Operacion,Tipo);
      $("#Acci_ClaseAccidente").html(selectHtmlAccidentes);
      Tipo='CONSECUENCIA';
      selectHtmlAccidentes="";
      selectHtmlAccidentes = f_TipoTabla(Operacion,Tipo);
      $("#Acci_Lesiones").html(selectHtmlAccidentes);
      Tipo='DAÑOS_MATERIALES';
      selectHtmlAccidentes="";
      selectHtmlAccidentes = f_TipoTabla(Operacion,Tipo);
      $("#Acci_DanosMateriales").html(selectHtmlAccidentes);
      Tipo='TIPO EVENTO';
      selectHtmlAccidentes="";
      selectHtmlAccidentes = f_TipoTabla(Operacion,Tipo);
      $("#Acci_TipoEvento").html(selectHtmlAccidentes);
      Tipo='LUGAR';
      selectHtmlAccidentes="";
      selectHtmlAccidentes = f_TipoTabla(Operacion,Tipo);
      $("#Acci_LugarAccidente").html(selectHtmlAccidentes);
      Tipo='OBJETO ACCIDENTE';
      selectHtmlAccidentes="";
      selectHtmlAccidentes = f_TipoTabla(Operacion,Tipo);
      $("#Acci_ObjetoAccidente").html(selectHtmlAccidentes);
      Tipo='CODIGO COLOR';
      selectHtmlAccidentes="";
      selectHtmlAccidentes = f_TipoTabla(Operacion,Tipo);
      $("#Acci_CodigoColor").html(selectHtmlAccidentes);
      Tipo = 'SECCION BUS';
      selectHtmlAccidentes="";
      selectHtmlAccidentes = f_TipoTabla(Acci_Operacion,Tipo);
      $("#Acci_SeccionBus").html(selectHtmlAccidentes);

      // SE MUESTRAN LOS TABS DE INFORME PRELIMINAR
      $("#nav-tab-InformePreliminar").show();
      $("#nav-tabContent-profile").show();

      // SE CARGAN LOS DATATABLES
      f_CargarDataTables();

      // SE CARGAN LAS IMAGENES DE LA TABLA ACCIDENTES IMAGENES, MAPA, BUS, CODIGOQR
      // IMAGENES DEL 1 AL 4
      buscarImagen =  f_BuscarImagen("Imagen1");
      if(buscarImagen==""){
        pImagen = '<img src="Module/Accidentes/View/Img/SinImagen.jpg" class="card-img-top rounded img-fluid img-thumbnail" alt="Responsive image" >';
      }else{
        pImagen = '<img src="' + buscarImagen + '" class="card-img-top rounded img-fluid img-thumbnail" alt="Responsive image" >';
      }
      $("#div_Imagen1").html(pImagen);
      buscarImagen = f_BuscarImagen("Imagen2");
      if(buscarImagen==""){
        pImagen = '<img src="Module/Accidentes/View/Img/SinImagen.jpg" class="card-img-top rounded img-fluid img-thumbnail" alt="Responsive image" >';
      }else{
        pImagen = '<img src="' + buscarImagen + '" class="card-img-top rounded img-fluid img-thumbnail" alt="Responsive image" >';
      }
      $("#div_Imagen2").html(pImagen);
      buscarImagen = f_BuscarImagen("Imagen3");
      if(buscarImagen==""){
        pImagen = '<img src="Module/Accidentes/View/Img/SinImagen.jpg" class="card-img-top rounded img-fluid img-thumbnail" alt="Responsive image" >';
      }else{
        pImagen = '<img src="' + buscarImagen + '" class="card-img-top rounded img-fluid img-thumbnail" alt="Responsive image" >';
      }
      $("#div_Imagen3").html(pImagen);
      buscarImagen = f_BuscarImagen("Imagen4");
      if(buscarImagen==""){
        pImagen = '<img src="Module/Accidentes/View/Img/SinImagen.jpg" class="card-img-top rounded img-fluid img-thumbnail" alt="Responsive image" >';
      }else{
        pImagen = '<img src="' + buscarImagen + '" class="card-img-top rounded img-fluid img-thumbnail" alt="Responsive image" >';
      }
      $("#div_Imagen4").html(pImagen);
      // IMAGEN DE MAPA
      buscarImagen = f_BuscarImagen("Mapa");
      if(buscarImagen==""){
        pImagen = '<img src="Module/Accidentes/View/Img/SinImagen.jpg" class="card-img-top rounded img-fluid img-thumbnail" alt="Responsive image" >';
      }else{
        pImagen = '<img src="' + buscarImagen + '" class="card-img-top rounded img-fluid img-thumbnail" alt="Responsive image" >';
      }
      $("#div_Mapa").html(pImagen);
      //IMAGEN DE BUS
      buscarImagen = f_BuscarImagen("Bus");
      if(buscarImagen==""){
        if(Acci_Operacion=="TRONCAL"){
          pImagen = '<img src="Module/Accidentes/View/Img/bus_troncal.jpg" class="img-thumbnail" alt="" >';
        }else{
          pImagen = '<img src="Module/Accidentes/View/Img/bus_alimentador.jpg" class="img-thumbnail" alt="" >';
        }      
      }else{
        pImagen = '<img src="' + buscarImagen + '" class="card-img-top rounded img-fluid img-thumbnail" alt="Responsive image" >';
      }
      $("#div_Bus").html(pImagen);
      // IMAGEN CODIGO QR
      buscarImagen = f_BuscarImagen("CodigoQR");
      if(buscarImagen==""){
        pImagen = '<img src="Module/Accidentes/View/Img/SinImagen.jpg" class="card-img-top rounded img-fluid img-thumbnail" alt="Responsive image" >';
      }else{
        pImagen = '<img src="' + buscarImagen + '" class="img-thumbnail" alt="" >';
      }
      $("#div_CodigoQr").html(pImagen);
      //IMAGEN IP PDF
      buscarImagen = f_BuscarImagen("IP_PDF");
      if(buscarImagen==""){
        $("#btn_generar_pdf_informe_preliminar").show();
        $("#btnCerrarInformePreliminar").hide();
        $("#btnAbrirInformePreliminar").hide();
      }else{
        $("#btn_generar_pdf_informe_preliminar").hide();
      }

      Accion = 'SelectTablaAccidente';
      $.ajax({
        url       : "Ajax.php",
        type      : "POST",
        datatype  : "json",
        async     : false,    
        data      : {MoS:MoS,NombreMoS:NombreMoS,Accion:Accion,Prog_Fecha:Acci_FechaAccidente},    
        success   : function(data){
          $("#Acci_TablaAccidente").html(data);
        }
      });
      f_CargaVariablesHtmlInformePreliminar();
    }
  });
  ///:: FIN BOTON BUSCAR Informe Preliminar :::::::::::::::::::::::::::::::::::::::::::::::///
  
  ///:: BOTON EDITAR Informe Preliminar :::::::::::::::::::::::::::::::::::::::::::::::::::///
  $("#btnEditarInformePreliminar").on("click",function(){
    // Se declaran variables privadas  
    let buscarImagen = "";
    let pImagen = "";

    $("#btnCancelarInformePreliminar").prop("disabled",false);
    $("#btnGuardarInformePreliminar").prop("disabled",false);
    $("#btnCancelarInformePreliminar").show();
    $("#btnGuardarInformePreliminar").show();
    $("#btnEditarInformePreliminar").hide();

    f_EdicionCamposInformePreliminar('disabled', false);
    if(Acci_Otro=="NO" || Acci_Otro==null ){
      $("#Acci_OtroDescripcion").prop('disabled', true);
    }
    if(Acci_ConciliacionAccidente=="NO" || Acci_ConciliacionAccidente==null ){
      $("#Acci_MontoConciliadoAccidente").prop('disabled', true);
    }
    if(Acci_DocOtro=="NO" || Acci_DocOtro==null ){
      $("#Acci_DocOtroDescripcion").prop('disabled', true);
    }
    if(Acci_ClaseAccidente=="ACCIDENTE_SL" || Acci_ClaseAccidente=="INCIDENTE" || Acci_ClaseAccidente=="VANDALISMO_SL"){
      $("#Acci_HospitalAccidente").prop('disabled', true);
    }
  });
  ///:: FIN BOTON EDITAR Informe Preliminar :::::::::::::::::::::::::::::::::::::::::::::::///

  ///:: BOTON CANCELAR Informe Preliminar :::::::::::::::::::::::::::::::::::::::::::::::::///
  $("#btnCancelarInformePreliminar").on("click",function(){
    // SE OCULTAN LOS TABS DE INFORME PRELIMINAR
    $("#nav-tab-InformePreliminar").hide();
    $("#nav-tabContent-profile").hide();
    Nove_ProgramacionId = "";
    Novedad_Id = "";
  });
  ///:: FIN BOTON CANCELAR Informe Preliminar :::::::::::::::::::::::::::::::::::::::::::::///

  ///:: BOTON GRABAR Informe Preliminar :::::::::::::::::::::::::::::::::::::::::::::::::::///
  $("#btnGuardarInformePreliminar").on("click",function(){
    let tValidaInformePreliminar = "";

    f_CargarVariablesEditadasInformePreliminar(); 
    tValidaInformePreliminar = f_ValidarInformePreliminar(Acci_TipoAccidente, Acci_ClaseAccidente, Acci_Lesiones, Acci_DanosMateriales, Acci_Otro, Acci_OtroDescripcion, Acci_TipoEvento , Acci_FechaAccidente, Acci_HoraAccidente, Acci_NombreColaborador, Acci_TablaAccidente, Acci_LugarAccidente, Acci_BusAccidente, Acci_SentidoAccidente, Acci_km_perdidos_accidente, Acci_ConciliacionAccidente, Acci_MontoConciliadoAccidente, Acci_NombreCGO, Acci_NombrePersonalApoyo, Acci_ReconoceResponsabilidadAccidente, Acci_HospitalAccidente, Acci_ComisariaAccidente, Acci_HoraFinAtencion,Acci_HorasTrabajadas, Acci_ObjetoAccidente, Acci_NombreCGM, Acci_NombrePersonalApoyoManto, Acci_DocOtro, Acci_DocOtroDescripcion, Acci_DescripcionAccidente, acci_lugar_referencia);

    if(tValidaInformePreliminar=="invalido"){
      Swal.fire({
        icon: 'error',
        title: 'INFORME PRELIMINAR...',
        text: '*Falta completar información!!!'
      })
    }else{
      $("#btnEditarInformePreliminar").show();
      $("#btnCancelarInformePreliminar").hide();
      $("#btnGuardarInformePreliminar").hide(); 
      if(editarInformePreliminar==1){ // CREAR INFORME PRELIMINAR
        Accion='CrearInformePreliminar';
        $("#btnGuardarInformePreliminar").prop("disabled",true);
        $.ajax({
          url: "Ajax.php",
          type: "POST",
          datatype:"json",
          async: false,    
          data: {MoS:MoS,NombreMoS:NombreMoS, Accion:Accion, Accidentes_Id:InformePreliminar_Id, Acci_ClaseAccidente:Acci_ClaseAccidente, Acci_TipoAccidente:Acci_TipoAccidente,Acci_DanosMateriales:Acci_DanosMateriales, Acci_Lesiones:Acci_Lesiones, Acci_Fatalidad:Acci_Fatalidad, Acci_Otro:Acci_Otro, Acci_OtroDescripcion:Acci_OtroDescripcion,Acci_TipoEvento:Acci_TipoEvento ,Acci_Fecha:Acci_FechaAccidente, Acci_Hora:Acci_HoraAccidente, Acci_NombreColaborador:Acci_NombreColaborador,Acci_Tabla:Acci_TablaAccidente, Acci_Servicio:Acci_ServicioAccidente ,Acci_Lugar:Acci_LugarAccidente, Acci_Bus:Acci_BusAccidente, Acci_Sentido:Acci_SentidoAccidente,Acci_km_perdidos:Acci_km_perdidos_accidente ,Acci_Conciliacion:Acci_ConciliacionAccidente, Acci_MontoConciliado:Acci_MontoConciliadoAccidente,Acci_NombreCGO:Acci_NombreCGO, Acci_NombrePersonalApoyo:Acci_NombrePersonalApoyo, Acci_ReconoceResponsabilidad:Acci_ReconoceResponsabilidadAccidente,Acci_Hospital:Acci_HospitalAccidente, Acci_Comisaria:Acci_ComisariaAccidente, Acci_HoraFinAtencion:Acci_HoraFinAtencion, Acci_HorasTrabajadas:Acci_HorasTrabajadas,Acci_Objeto:Acci_ObjetoAccidente, Acci_NombreCGM:Acci_NombreCGM,Acci_NombrePersonalApoyoManto:Acci_NombrePersonalApoyoManto, Acci_DocReporte:Acci_DocReporteAccidente  ,Acci_DocConciliacion:Acci_DocConciliacion, Acci_DocPartePolicial:Acci_DocPartePolicial, Acci_DocOficioPeritaje:Acci_DocOficioPeritaje  ,Acci_DocReporteAtencion:Acci_DocReporteAtencion, Acci_DocDenunciaPolicial:Acci_DocDenunciaPolicial, Acci_DocCitacionManifestacion:Acci_DocCitacionManifestacion,Acci_DocOtro:Acci_DocOtro, Acci_DocOtroDescripcion:Acci_DocOtroDescripcion, Acci_Descripcion:Acci_DescripcionAccidente, Nove_ProgramacionId:Nove_ProgramacionId,Novedad_Id:Novedad_Id, Acci_Operacion:Acci_Operacion, acci_lugar_referencia:acci_lugar_referencia},
          success: function(data){
            data = $.parseJSON(data);
            $.each(data, function(idx, obj){ 
              Accidentes_Id = obj.Accidentes_Id;
              InformePreliminar_Id = obj.Accidentes_Id;
            });
            f_CargarVariablesInformePreliminar(data);
          }
        });
        // CARGA ID ACCIDENTES
        $("#selectInformePreliminar_Id").val(Accidentes_Id);
        // CREAR CODIGO QR
        Accion='CodigoQR';
        Tipo='CREAR';
        $.ajax({
          url: "Ajax.php",
          type: "POST",
          datatype:"json",
          async: false,    
          data: {MoS:MoS,NombreMoS:NombreMoS,Accion:Accion,Accidentes_Id:Accidentes_Id,Acci_TipoAccidente:Acci_TipoAccidente,Acci_TipoEvento:Acci_TipoEvento,Acci_Bus:Acci_BusAccidente,Acci_NombreColaborador:Acci_NombreColaborador,Acci_Lugar:Acci_LugarAccidente,Acci_Comisaria:Acci_ComisariaAccidente,Acci_Hospital:Acci_HospitalAccidente,Tipo:Tipo},    
          success: function(){
          }
        });
        // CARGAN LOS DATATABLES
        f_CargarDataTables();
      }else{ // EDITAR INFORME PRELIMINAR
        Accion='EditarInformePreliminar';
        $("#btnGuardarInformePreliminar").prop("disabled",true);
        $.ajax({
          url: "Ajax.php",
          type: "POST",
          datatype:"json",
          async: false,    
          data: {MoS:MoS, NombreMoS:NombreMoS, Accion:Accion, Accidentes_Id:InformePreliminar_Id, Acci_ClaseAccidente:Acci_ClaseAccidente, Acci_TipoAccidente:Acci_TipoAccidente, Acci_DanosMateriales:Acci_DanosMateriales, Acci_Lesiones:Acci_Lesiones, Acci_Fatalidad:Acci_Fatalidad, Acci_Otro:Acci_Otro,Acci_OtroDescripcion:Acci_OtroDescripcion, Acci_TipoEvento:Acci_TipoEvento, Acci_Fecha:Acci_FechaAccidente, Acci_Hora:Acci_HoraAccidente,Acci_NombreColaborador:Acci_NombreColaborador, Acci_Tabla:Acci_TablaAccidente, Acci_Servicio:Acci_ServicioAccidente, Acci_Lugar:Acci_LugarAccidente,Acci_Bus:Acci_BusAccidente, Acci_Sentido:Acci_SentidoAccidente, Acci_km_perdidos:Acci_km_perdidos_accidente, Acci_Conciliacion:Acci_ConciliacionAccidente,Acci_MontoConciliado:Acci_MontoConciliadoAccidente, Acci_NombreCGO:Acci_NombreCGO, Acci_NombrePersonalApoyo:Acci_NombrePersonalApoyo, Acci_ReconoceResponsabilidad:Acci_ReconoceResponsabilidadAccidente, Acci_Hospital:Acci_HospitalAccidente, Acci_Comisaria:Acci_ComisariaAccidente, Acci_HoraFinAtencion:Acci_HoraFinAtencion, Acci_HorasTrabajadas:Acci_HorasTrabajadas, Acci_Objeto:Acci_ObjetoAccidente, Acci_NombreCGM:Acci_NombreCGM, Acci_NombrePersonalApoyoManto:Acci_NombrePersonalApoyoManto, Acci_DocReporte:Acci_DocReporteAccidente, Acci_DocConciliacion:Acci_DocConciliacion, Acci_DocPartePolicial:Acci_DocPartePolicial, Acci_DocOficioPeritaje:Acci_DocOficioPeritaje, Acci_DocReporteAtencion:Acci_DocReporteAtencion, Acci_DocDenunciaPolicial:Acci_DocDenunciaPolicial,Acci_DocCitacionManifestacion:Acci_DocCitacionManifestacion, Acci_DocOtro:Acci_DocOtro, Acci_DocOtroDescripcion:Acci_DocOtroDescripcion,Acci_Descripcion:Acci_DescripcionAccidente, acci_lugar_referencia:acci_lugar_referencia},    
          success: function(data){
            data = $.parseJSON(data);
            f_CargarVariablesInformePreliminar(data);
          }
        });
        // EDITAR CODIGO QR
        Accion='CodigoQR';
        Tipo='EDITAR'; 
        $.ajax({
          url: "Ajax.php",
          type: "POST",
          datatype:"json",
          async: false,    
          data: {MoS:MoS,NombreMoS:NombreMoS,Accion:Accion,Accidentes_Id:InformePreliminar_Id,Acci_TipoAccidente:Acci_TipoAccidente,Acci_TipoEvento:Acci_TipoEvento,Acci_Bus:Acci_BusAccidente,Acci_NombreColaborador:Acci_NombreColaborador,Acci_Lugar:Acci_LugarAccidente,Acci_Comisaria:Acci_ComisariaAccidente,Acci_Hospital:Acci_HospitalAccidente,Tipo:Tipo},    
          success: function(){
  
          }
        });
      }
      buscarImagen = f_BuscarImagen("CodigoQR");
      if(buscarImagen==""){
        pImagen = '<img src="Module/Accidentes/View/Img/SinImagen.jpg" class="img-thumbnail" alt="" >';
      }else{
        pImagen = '<img src="' + buscarImagen + '" class="img-thumbnail" alt="" >';
      }
      $("#div_CodigoQr").html(pImagen);
      
      f_CargaVariablesHtmlInformePreliminar();
      f_EdicionCamposInformePreliminar('disabled', true);
  
      // SE ACTIVAN LOS TAB DE EL INFORME PRELIMINAR
      $("#nav-NaturalezaPerdida-tab").prop("disabled",false);
      $("#nav-CausasAcciones-tab").prop("disabled",false);
      $("#nav-Imagenes-tab").prop("disabled",false);
      $("#nav-DanosReparacion-tab").prop("disabled",false);
      Nove_ProgramacionId = "";
      Novedad_Id = "";
      tablaAccidentes.ajax.reload(toggleZoomScreen(),false);
    }

  });
  ///:: FIN BOTON GRABAR Informe Preliminar :::::::::::::::::::::::::::::::::::::::::::::::///

  ///:: TERMINO BOTONES ACCIDENTES ::::::::::::::::::::::::::::::::::::::::::::::::::::::::///

});
///:: TERMINO DOM JS INFORME PRELIMINAR :::::::::::::::::::::::::::::::::::::::::::::::::::///

///:: INICIO FUNCIONES DE INFORME PRELIMINAR ::::::::::::::::::::::::::::::::::::::::::::::///

///:: FUNCION PARA VALIDAR LOS DATOS INGRESADOS AL FORMULARIO :::::::::::::::::::::::::::::///
function f_ValidarInformePreliminar(pAcci_TipoAccidente, pAcci_ClaseAccidente, pAcci_Lesiones, pAcci_DanosMateriales, pAcci_Otro, pAcci_OtroDescripcion, pAcci_TipoEvento , pAcci_FechaAccidente, pAcci_HoraAccidente, pAcci_NombreColaborador, pAcci_TablaAccidente, pAcci_LugarAccidente, pAcci_BusAccidente, pAcci_SentidoAccidente, pAcci_km_perdidos_accidente, pAcci_ConciliacionAccidente, pAcci_MontoConciliadoAccidente, pAcci_NombreCGO, pAcci_NombrePersonalApoyo, pAcci_ReconoceResponsabilidadAccidente, pAcci_HospitalAccidente, pAcci_ComisariaAccidente, pAcci_HoraFinAtencion, pAcci_HorasTrabajadas, pAcci_ObjetoAccidente, pAcci_NombreCGM, pAcci_NombrePersonalApoyoManto, pAcci_DocOtro, pAcci_DocOtroDescripcion, pAcci_DescripcionAccidente, p_acci_lugar_referencia){

  f_LimpiaInformePreliminar();

  NoLetrasMayuscEspacio=/[^A-Z ]/;
  let rptaValidarInformePreliminar="";

  if(pAcci_TipoAccidente == ""){
    $("#Acci_TipoAccidente").addClass("color-error");  
    rptaValidarInformePreliminar = "invalido";
  }

  if(pAcci_ClaseAccidente == ""){
    $("#Acci_ClaseAccidente").addClass("color-error");
    rptaValidarInformePreliminar = "invalido";
  }

  if(pAcci_Lesiones == ""){
    $("#Acci_Lesiones").addClass("color-error");
    rptaValidarInformePreliminar = "invalido";
  }

  if(pAcci_DanosMateriales == ""){
    $("#Acci_DanosMateriales").addClass("color-error");
    rptaValidarInformePreliminar = "invalido";
  }

  if(pAcci_Otro=="SI" && pAcci_OtroDescripcion == ""){
    $("#Acci_OtroDescripcion").addClass("color-error");
    rptaValidarInformePreliminar = "invalido";
  }

  if(pAcci_TipoEvento == ""){
    $("#Acci_TipoEvento").addClass("color-error");
    rptaValidarInformePreliminar = "invalido";
  }
  
  if(pAcci_FechaAccidente == ""){
    $("#Acci_FechaAccidente").addClass("color-error");
    rptaValidarInformePreliminar = "invalido";
  }

  if(pAcci_HoraAccidente == ""){
    $("#HoraAccidente").addClass("color-error");
    $("#MinutoAccidente").addClass("color-error");
    rptaValidarInformePreliminar = "invalido";
  }

  if(pAcci_NombreColaborador == ""){
    $("#Acci_NombreColaborador").addClass("color-error");
    rptaValidarInformePreliminar = "invalido";
  }

  if(pAcci_TablaAccidente == ""){
    $("#Acci_TablaAccidente").addClass("color-error");
    rptaValidarInformePreliminar = "invalido";
  }

  if(pAcci_LugarAccidente == ""){
    $("#Acci_LugarAccidente").addClass("color-error");
    rptaValidarInformePreliminar = "invalido";
  }

  if(pAcci_BusAccidente == ""){
    $("#Acci_BusAccidente").addClass("color-error");
    rptaValidarInformePreliminar = "invalido";
  }

  if(pAcci_SentidoAccidente == ""){
    $("#Acci_SentidoAccidente").addClass("color-error");
    rptaValidarInformePreliminar = "invalido";
  }

  if(pAcci_km_perdidos_accidente == ""){
    $("#Acci_km_perdidos_accidente").addClass("color-error");
    rptaValidarInformePreliminar = "invalido";
  }

  if(pAcci_ConciliacionAccidente == "SI" && pAcci_MontoConciliadoAccidente == ""){
    $("#Acci_MontoConciliadoAccidente").addClass("color-error");
    rptaValidarInformePreliminar = "invalido";
  }

  if(pAcci_NombreCGO == ""){
    $("#Acci_NombreCGO").addClass("color-error");
    rptaValidarInformePreliminar = "invalido";
  }

  if(pAcci_NombrePersonalApoyo == ""){
    $("#Acci_NombrePersonalApoyo").addClass("color-error");
    rptaValidarInformePreliminar = "invalido";
  }

  if(pAcci_ReconoceResponsabilidadAccidente == ""){
    $("#Acci_ReconoceResponsabilidadAccidente").addClass("color-error");
    rptaValidarInformePreliminar = "invalido";
  }

  if(pAcci_HospitalAccidente == ""){
    $("#Acci_HospitalAccidente").addClass("color-error");
    rptaValidarInformePreliminar = "invalido";
  }

  if(pAcci_ComisariaAccidente == ""){
    $("#Acci_ComisariaAccidente").addClass("color-error");
    rptaValidarInformePreliminar = "invalido";
  }

  if(pAcci_HorasTrabajadas == ""){
    $("#HoraTrabajadasAccidente").addClass("color-error");
    $("#MinutoTrabajadosAccidente").addClass("color-error");
    rptaValidarInformePreliminar = "invalido";
  }

  if(pAcci_ObjetoAccidente == ""){
    $("#Acci_ObjetoAccidente").addClass("color-error");
    rptaValidarInformePreliminar = "invalido";
  }

  if(pAcci_NombreCGM == ""){
    $("#Acci_NombreCGM").addClass("color-error");
    rptaValidarInformePreliminar = "invalido";
  }

  if(pAcci_NombrePersonalApoyoManto == ""){
    $("#Acci_NombrePersonalApoyoManto").addClass("color-error");
    rptaValidarInformePreliminar = "invalido";
  }

  if(pAcci_DocOtro == "SI" && pAcci_DocOtroDescripcion == "" && bpAcci_DocOtroDescripcion.length > 50 ){
    $("#Acci_DocOtroDescripcion").addClass("color-error");
    rptaValidarInformePreliminar = "invalido";
  }

  if(pAcci_DescripcionAccidente == ""){
    $("#Acci_DescripcionAccidente").addClass("color-error");
    rptaValidarInformePreliminar = "invalido";
  }

  if(p_acci_lugar_referencia == ""){
    $("#acci_lugar_referencia").addClass("color-error");
    rptaValidarInformePreliminar = "invalido";
  }

  return rptaValidarInformePreliminar; 
}
///:: FIN FUNCION PARA VALIDAR LOS DATOS INGRESADOS AL FORMULARIO :::::::::::::::::::::::::///

///:: INVISIBILIZA LOS MENSAJE DE ALERTA DEL FORMULARIO :::::::::::::::::::::::::::::::::::/// 
function f_LimpiaInformePreliminar(){
  $("#Acci_TipoAccidente").removeClass("color-error");
  $("#Acci_ClaseAccidente").removeClass("color-error");
  $("#Acci_Lesiones").removeClass("color-error");
  $("#Acci_DanosMateriales").removeClass("color-error");
  $("#Acci_OtroDescripcion").removeClass("color-error");
  $("#Acci_TipoEvento").removeClass("color-error");
  $("#Acci_FechaAccidente").removeClass("color-error");
  $("#HoraAccidente").removeClass("color-error");
  $("#MinutoAccidente").removeClass("color-error");
  $("#Acci_NombreColaborador").removeClass("color-error");
  $("#Acci_TablaAccidente").removeClass("color-error");
  $("#Acci_LugarAccidente").removeClass("color-error");
  $("#Acci_BusAccidente").removeClass("color-error");
  $("#Acci_SentidoAccidente").removeClass("color-error");
  $("#Acci_km_perdidos_accidente").removeClass("color-error");
  $("#Acci_MontoConciliadoAccidente").removeClass("color-error");
  $("#Acci_NombreCGO").removeClass("color-error");
  $("#Acci_NombrePersonalApoyo").removeClass("color-error");
  $("#Acci_ReconoceResponsabilidadAccidente").removeClass("color-error");
  $("#Acci_HospitalAccidente").removeClass("color-error");
  $("#Acci_ComisariaAccidente").removeClass("color-error");
  $("#HoraFinAtencionAccidente").removeClass("color-error");
  $("#MinutoFinAtencionAccidente").removeClass("color-error");
  $("#HoraTrabajadasAccidente").removeClass("color-error");
  $("#MinutoTrabajadosAccidente").removeClass("color-error");
  $("#Acci_ObjetoAccidente").removeClass("color-error");
  $("#Acci_NombreCGM").removeClass("color-error");
  $("#Acci_NombrePersonalApoyoManto").removeClass("color-error");
  $("#Acci_DocOtroDescripcion").removeClass("color-error");
  $("#Acci_DescripcionAccidente").removeClass("color-error");
  $("#acci_lugar_referencia").removeClass("color-error");
}
///:: FIN INVISIBILIZA LOS MENSAJE DE ALERTA DEL FORMULARIO :::::::::::::::::::::::::::::::///

///:: HABILITAR O DESHABILITAR LA EDICION DE LOS CAMPOS :::::::::::::::::::::::::::::::::::///
function f_EdicionCamposInformePreliminar(tOpcion,bValor){
  $("#Acci_TipoAccidente").prop(tOpcion, bValor);
  $("#Acci_ClaseAccidente").prop(tOpcion, bValor);
  $("#Acci_DanosMateriales").prop(tOpcion, bValor);
  $("#Acci_Lesiones").prop(tOpcion, bValor);
  $("#Acci_TipoEvento").prop(tOpcion, bValor);
  $("#Acci_FechaAccidente").prop(tOpcion, bValor);
  $("#HoraAccidente").prop(tOpcion, bValor);
  $("#MinutoAccidente").prop(tOpcion, bValor);
  $("#Acci_NombreColaborador").prop(tOpcion, bValor);
  $("#Acci_TablaAccidente").prop(tOpcion, bValor);
  $("#Acci_LugarAccidente").prop(tOpcion, bValor);
  $("#Acci_BusAccidente").prop(tOpcion, bValor);
  $("#Acci_SentidoAccidente").prop(tOpcion, bValor);
  $("#Acci_km_perdidos_accidente").prop(tOpcion, bValor);
  $("#Acci_ConciliacionAccidente").prop(tOpcion, bValor);
  $("#Acci_MontoConciliadoAccidente").prop(tOpcion, bValor);
  $("#Acci_NombreCGO").prop(tOpcion, bValor);
  $("#Acci_NombrePersonalApoyo").prop(tOpcion, bValor);
  $("#Acci_ReconoceResponsabilidadAccidente").prop(tOpcion, bValor);
  $("#Acci_HospitalAccidente").prop(tOpcion, bValor);
  $("#Acci_ComisariaAccidente").prop(tOpcion, bValor);
  $("#HoraFinAtencionAccidente").prop(tOpcion, bValor);
  $("#MinutoFinAtencionAccidente").prop(tOpcion, bValor);
  $("#HoraTrabajadasAccidente").prop(tOpcion, bValor);
  $("#MinutoTrabajadosAccidente").prop(tOpcion, bValor);
  $("#Acci_ObjetoAccidente").prop(tOpcion, bValor);
  $("#Acci_NombreCGM").prop(tOpcion, bValor);
  $("#Acci_NombrePersonalApoyoManto").prop(tOpcion, bValor);
  $("#Acci_DocReporteAccidente").prop(tOpcion, bValor);
  $("#Acci_DocConciliacion").prop(tOpcion, bValor);
  $("#Acci_DocPartePolicial").prop(tOpcion, bValor);
  $("#Acci_DocOficioPeritaje").prop(tOpcion, bValor);
  $("#Acci_DocReporteAtencion").prop(tOpcion, bValor);
  $("#Acci_DocDenunciaPolicial").prop(tOpcion, bValor);
  $("#Acci_DocCitacionManifestacion").prop(tOpcion, bValor);
  $("#Acci_DocOtro").prop(tOpcion, bValor);
  $("#Acci_DocOtroDescripcion").prop(tOpcion, bValor);
  $("#Acci_DescripcionAccidente").prop(tOpcion, bValor);
  $("#acci_lugar_referencia").prop(tOpcion, bValor);
}
///:: FIN HABILITAR O DESHABILITAR LA EDICION DE LOS CAMPOS :::::::::::::::::::::::::::::::///

///:: SE CARGAN LAS VARIABLES CON LA INFORMACION DE LA BASE DE DATOS ::::::::::::::::::::::///
function f_CargarVariablesInformePreliminar(p_data){
  $.each(p_data, function(idx, obj){
    Acci_Operacion                        = obj.Acci_Operacion; 
    Acci_TipoAccidente                    = obj.Acci_TipoAccidente;
    Acci_ClaseAccidente                   = obj.Acci_ClaseAccidente;
    Acci_DanosMateriales                  = obj.Acci_DanosMateriales ;
    Acci_Lesiones                         = obj.Acci_Lesiones ;
    Acci_TipoEvento                       = obj.Acci_TipoEvento ;
    Acci_FechaAccidente                   = obj.Acci_Fecha ;
    Acci_HoraAccidente                    = obj.Acci_Hora ; // + campo
    HoraAccidente                         = Acci_HoraAccidente.substring(0,2) ;
    MinutoAccidente                       = Acci_HoraAccidente.substring(3,5) ;
    Acci_Dni                              = obj.Acci_Dni ;
    Acci_CodigoColaborador                = obj.Acci_CodigoColaborador ;
    Acci_NombreColaborador                = obj.Acci_NombreColaborador ;
    Acci_TablaAccidente                   = obj.Acci_Tabla ;
    Acci_ServicioAccidente                = obj.Acci_Servicio ;
    Acci_LugarAccidente                   = obj.Acci_Lugar ;
    Acci_NroPlacaAccidente                = obj.Acci_NroPlaca ;
    Acci_BusAccidente                     = obj.Acci_Bus ;
    Acci_SentidoAccidente                 = obj.Acci_Sentido ;
    Acci_km_perdidos_accidente            = obj.Acci_km_perdidos ;
    Acci_ConciliacionAccidente            = obj.Acci_Conciliacion ;
    Acci_MontoConciliadoAccidente         = obj.Acci_MontoConciliado ;
    Acci_NombreCGO                        = obj.Acci_NombreCGO ;
    Acci_NombrePersonalApoyo              = obj.Acci_NombrePersonalApoyo ;
    Acci_ReconoceResponsabilidadAccidente = obj.Acci_ReconoceResponsabilidad ;
    Acci_HospitalAccidente                = obj.Acci_Hospital ;
    Acci_ComisariaAccidente               = obj.Acci_Comisaria ;
    Acci_HoraFinAtencion                  = obj.Acci_HoraFinAtencion ; // + campo
    if(Acci_HoraFinAtencion !== null){
      HoraFinAtencionAccidente              = Acci_HoraFinAtencion.substring(0,2) ;
      MinutoFinAtencionAccidente            = Acci_HoraFinAtencion.substring(3,5) ;  
    }
    Acci_HorasTrabajadas                  = obj.Acci_HorasTrabajadas ; // + campo
    if(Acci_HorasTrabajadas !== null){
      HoraTrabajadasAccidente   = Acci_HorasTrabajadas.substring(0,2) ;
      MinutoTrabajadosAccidente = Acci_HorasTrabajadas.substring(3,5) ;
    }
    Acci_ObjetoAccidente                  = obj.Acci_Objeto ;
    Acci_NombreCGM                        = obj.Acci_NombreCGM ;
    Acci_NombrePersonalApoyoManto         = obj.Acci_NombrePersonalApoyoManto ;
    Acci_DocReporteAccidente              = obj.Acci_DocReporte ;
    Acci_DocConciliacion                  = obj.Acci_DocConciliacion ;
    Acci_DocPartePolicial                 = obj.Acci_DocPartePolicial ;
    Acci_DocOficioPeritaje                = obj.Acci_DocOficioPeritaje ;
    Acci_DocReporteAtencion               = obj.Acci_DocReporteAtencion ;
    Acci_DocDenunciaPolicial              = obj.Acci_DocDenunciaPolicial ;
    Acci_DocCitacionManifestacion         = obj.Acci_DocCitacionManifestacion ;
    Acci_DocOtro                          = obj.Acci_DocOtro ;
    Acci_DocOtroDescripcion               = obj.Acci_DocOtroDescripcion ;
    Acci_DescripcionAccidente             = obj.Acci_Descripcion ;
    Acci_NombreSuscribeInformacion        = obj.Acci_NombreSuscribeInformacion ;
    Acci_FechaElaboracionInforme          = obj.f_Acci_FechaElaboracionInforme ;
    Acci_UsuarioId_Cerrar                 = obj.n_Acci_UsuarioId_Cerrar ;
    Acci_FechaCerrar                      = obj.f_Acci_FechaCerrar ;
    acci_log_ip                           = obj.acci_log_ip;
    acci_lugar_referencia                  = obj.acci_lugar_referencia;
  });
}
///:: FIN SE CARGAN LAS VARIABLES CON LA INFORMACION DE LA BASE DE DATOS ::::::::::::::::::///

///:: SE INICIALIZAN LAS VARIABLES DEL INFORME PRELIMINAR :::::::::::::::::::::::::::::::::///
function f_CargarVariablesVacioInformePreliminar(){
  Acci_Operacion                        = "";
  Acci_TipoAccidente                    = "";
  Acci_ClaseAccidente                   = "";
  Acci_DanosMateriales                  = "";
  Acci_Lesiones                         = "";
  Acci_TipoEvento                       = "";
  Acci_FechaAccidente                   = "";
  Acci_HoraAccidente                    = ""; // + campo
  HoraAccidente                         = "";
  MinutoAccidente                       = "";
  Acci_Dni                              = "";
  Acci_CodigoColaborador                = "";
  Acci_NombreColaborador                = "";
  Acci_TablaAccidente                   = "";
  Acci_ServicioAccidente                = "";
  Acci_LugarAccidente                   = "";
  Acci_NroPlacaAccidente                = "";
  Acci_BusAccidente                     = "";
  Acci_SentidoAccidente                 = "";
  Acci_km_perdidos_accidente            = "";
  Acci_ConciliacionAccidente            = "";
  Acci_MontoConciliadoAccidente         = "";
  Acci_NombreCGO                        = "";
  Acci_NombrePersonalApoyo              = "";
  Acci_ReconoceResponsabilidadAccidente = "";
  Acci_HospitalAccidente                = "";
  Acci_ComisariaAccidente               = "";
  Acci_HoraFinAtencion                  = ""; // + campo
  HoraFinAtencionAccidente              = "";
  MinutoFinAtencionAccidente            = "";
  Acci_HorasTrabajadas                  = ""; // + campo
  HoraTrabajadasAccidente               = "";
  MinutoTrabajadosAccidente             = "";
  Acci_ObjetoAccidente                  = "";
  Acci_NombreCGM                        = "";
  Acci_NombrePersonalApoyoManto         = "";
  Acci_DocReporteAccidente              = "";
  Acci_DocConciliacion                  = "";
  Acci_DocPartePolicial                 = "";
  Acci_DocOficioPeritaje                = "";
  Acci_DocReporteAtencion               = "";
  Acci_DocDenunciaPolicial              = "";
  Acci_DocCitacionManifestacion         = "";
  Acci_DocOtro                          = "";
  Acci_DocOtroDescripcion               = "";
  Acci_DescripcionAccidente             = "";
  Acci_NombreSuscribeInformacion        = "";
  Acci_FechaElaboracionInforme          = "";
  Acci_UsuarioId_Cerrar                 = "";
  Acci_FechaCerrar                      = "";
  acci_lugar_referencia                 = "";
}
///:: FIN INICIALIZAN LAS VARIABLES DEL INFORME PRELIMINAR ::::::::::::::::::::::::::::::::///

///:: SE CARGAN LAS VARIABLES HTML CON LA INFORMACION :::::::::::::::::::::::::::::::::::::///
function f_CargaVariablesHtmlInformePreliminar(){
  // Se cargan los div
  html = f_MostrarDiv("formAccidenteIncidente","div_Accidentes_Id",InformePreliminar_Id);
  $("#div_Accidentes_Id").html(html);
  
  $("#Acci_TipoAccidente").val(Acci_TipoAccidente);
  $("#Acci_ClaseAccidente").val(Acci_ClaseAccidente);
  $("#Acci_Lesiones").val(Acci_Lesiones);
  $("#Acci_DanosMateriales").val(Acci_DanosMateriales);
  $("#Acci_TipoEvento").val(Acci_TipoEvento);
  $("#Acci_FechaAccidente").val(Acci_FechaAccidente);
  $("#HoraAccidente").val(HoraAccidente);
  $("#MinutoAccidente").val(MinutoAccidente);
  $("#Acci_Dni").val(Acci_Dni);
  $("#Acci_CodigoColaborador").val(Acci_CodigoColaborador);
  $("#Acci_NombreColaborador").val(Acci_NombreColaborador);
  $("#Acci_TablaAccidente").val(Acci_TablaAccidente);
  $("#Acci_ServicioAccidente").val(Acci_ServicioAccidente);
  $("#Acci_LugarAccidente").val(Acci_LugarAccidente);
  $("#Acci_NroPlacaAccidente").val(Acci_NroPlacaAccidente);
  $("#Acci_BusAccidente").val(Acci_BusAccidente);
  $("#Acci_SentidoAccidente").val(Acci_SentidoAccidente);
  $("#Acci_km_perdidos_accidente").val(Acci_km_perdidos_accidente);
  $("#Acci_ConciliacionAccidente").val(Acci_ConciliacionAccidente);
  $("#Acci_MontoConciliadoAccidente").val(Acci_MontoConciliadoAccidente);
  $("#Acci_NombreCGO").val(Acci_NombreCGO);
  $("#Acci_NombrePersonalApoyo").val(Acci_NombrePersonalApoyo);
  $("#Acci_ReconoceResponsabilidadAccidente").val(Acci_ReconoceResponsabilidadAccidente);
  $("#Acci_HospitalAccidente").val(Acci_HospitalAccidente);
  $("#Acci_ComisariaAccidente").val(Acci_ComisariaAccidente);
  $("#HoraFinAtencionAccidente").val(HoraFinAtencionAccidente);
  $("#MinutoFinAtencionAccidente").val(MinutoFinAtencionAccidente);
  $("#HoraTrabajadasAccidente").val(HoraTrabajadasAccidente);
  $("#MinutoTrabajadosAccidente").val(MinutoTrabajadosAccidente);
  $("#Acci_ObjetoAccidente").val(Acci_ObjetoAccidente);
  $("#Acci_NombreCGM").val(Acci_NombreCGM);
  $("#Acci_NombrePersonalApoyoManto").val(Acci_NombrePersonalApoyoManto);
  if(Acci_DocReporteAccidente=="SI"){
    $("#Acci_DocReporteAccidente").prop("checked",true);
  }else{
    $("#Acci_DocReporteAccidente").prop("checked",false);
  }
  if(Acci_DocConciliacion=="SI"){
    $("#Acci_DocConciliacion").prop("checked",true);
  }else{
    $("#Acci_DocConciliacion").prop("checked",false);
  }
  if(Acci_DocPartePolicial=="SI"){
    $("#Acci_DocPartePolicial").prop("checked",true);
  }else{
    $("#Acci_DocPartePolicial").prop("checked",false);
  }
  if(Acci_DocOficioPeritaje=="SI"){
    $("#Acci_DocOficioPeritaje").prop("checked",true);
  }else{
    $("#Acci_DocOficioPeritaje").prop("checked",false);
  }
  if(Acci_DocReporteAtencion=="SI"){
    $("#Acci_DocReporteAtencion").prop("checked",true);
  }else{
    $("#Acci_DocReporteAtencion").prop("checked",false);
  }
  if(Acci_DocDenunciaPolicial=="SI"){
    $("#Acci_DocDenunciaPolicial").prop("checked",true);
  }else{
    $("#Acci_DocDenunciaPolicial").prop("checked",false);
  }
  if(Acci_DocCitacionManifestacion=="SI"){
    $("#Acci_DocCitacionManifestacion").prop("checked",true);
  }else{
    $("#Acci_DocCitacionManifestacion").prop("checked",false);
  }
  if(Acci_DocOtro=="SI"){
    $("#Acci_DocOtro").prop("checked",true);
  }else{
    $("#Acci_DocOtro").prop("checked",false);
  }
  $("#Acci_DocOtroDescripcion").val(Acci_DocOtroDescripcion);
  $("#Acci_DescripcionAccidente").val(Acci_DescripcionAccidente);
  $("#Acci_NombreSuscribeInformacion").val(Acci_NombreSuscribeInformacion);
  $("#Acci_FechaElaboracionInforme").val(Acci_FechaElaboracionInforme);
  $("#Acci_UsuarioId_Cerrar").val(Acci_UsuarioId_Cerrar);
  $("#Acci_FechaCerrar").val(Acci_FechaCerrar);
  $("#acci_lugar_referencia").val(acci_lugar_referencia);
}
///:: FIN SE CARGAN LAS VARIABLES HTML CON LA INFORMACION :::::::::::::::::::::::::::::::::///

///:: FUNCION CARGAR LAS VARIABLES CON LOS VALORES EDITADOS DEL INFORME PRELIMINAR ::::::::///
function f_CargarVariablesEditadasInformePreliminar(){
  let isChecked;
  Acci_TipoAccidente    = $.trim($('#Acci_TipoAccidente').val());
  Acci_ClaseAccidente   = $.trim($('#Acci_ClaseAccidente').val());
  Acci_Lesiones         = $.trim($('#Acci_Lesiones').val());
  Acci_DanosMateriales  = $.trim($('#Acci_DanosMateriales').val());
  Acci_TipoEvento       = $.trim($('#Acci_TipoEvento').val());
  Acci_FechaAccidente   = $.trim($('#Acci_FechaAccidente').val());
  Acci_HoraAccidente    = "";
  HoraAccidente         = $.trim($('#HoraAccidente').val());
  MinutoAccidente       = $.trim($('#MinutoAccidente').val());
  if(HoraAccidente !="" && MinutoAccidente!=""){
    Acci_HoraAccidente = HoraAccidente + ":" + MinutoAccidente;
  }
  Acci_Dni = $.trim($('#Acci_Dni').val());
  Acci_CodigoColaborador                = $.trim($('#Acci_CodigoColaborador').val());
  Acci_NombreColaborador                = $.trim($('#Acci_NombreColaborador').val());
  Acci_TablaAccidente                   = $.trim($('#Acci_TablaAccidente').val());
  Acci_ServicioAccidente                = $.trim($('#Acci_ServicioAccidente').val());
  Acci_LugarAccidente                   = $.trim($('#Acci_LugarAccidente').val());
  Acci_NroPlacaAccidente                = $.trim($('#Acci_NroPlacaAccidente').val());
  Acci_BusAccidente                     = $.trim($('#Acci_BusAccidente').val());
  Acci_SentidoAccidente                 = $.trim($('#Acci_SentidoAccidente').val());
  Acci_km_perdidos_accidente            = $.trim($('#Acci_km_perdidos_accidente').val());
  Acci_ConciliacionAccidente            = $.trim($('#Acci_ConciliacionAccidente').val());
  Acci_MontoConciliadoAccidente         = $.trim($('#Acci_MontoConciliadoAccidente').val());
  Acci_NombreCGO                        = $.trim($('#Acci_NombreCGO').val());
  Acci_NombrePersonalApoyo              = $.trim($('#Acci_NombrePersonalApoyo').val());
  Acci_ReconoceResponsabilidadAccidente = $.trim($('#Acci_ReconoceResponsabilidadAccidente').val());
  Acci_HospitalAccidente                = $.trim($('#Acci_HospitalAccidente').val());
  Acci_HospitalAccidente                = Acci_HospitalAccidente.toUpperCase(); // A mayúsculas
  Acci_ComisariaAccidente               = $.trim($('#Acci_ComisariaAccidente').val());
  Acci_HoraFinAtencion                  = "";
  HoraFinAtencionAccidente              = $.trim($('#HoraFinAtencionAccidente').val());
  MinutoFinAtencionAccidente            = $.trim($('#MinutoFinAtencionAccidente').val());
  if(HoraFinAtencionAccidente !="" && MinutoFinAtencionAccidente!=""){
    Acci_HoraFinAtencion = HoraFinAtencionAccidente + ":" + MinutoFinAtencionAccidente;
  }
  Acci_HorasTrabajadas                  = "";
  HoraTrabajadasAccidente               = $.trim($('#HoraTrabajadasAccidente').val());
  MinutoTrabajadosAccidente             = $.trim($('#MinutoTrabajadosAccidente').val());
  if(HoraTrabajadasAccidente !="" && MinutoTrabajadosAccidente!=""){
    Acci_HorasTrabajadas = HoraTrabajadasAccidente + ":" + MinutoTrabajadosAccidente;
  }
  Acci_ObjetoAccidente                  = $.trim($('#Acci_ObjetoAccidente').val());
  Acci_NombreCGM                        = $.trim($('#Acci_NombreCGM').val());
  Acci_NombrePersonalApoyoManto         = $.trim($('#Acci_NombrePersonalApoyoManto').val());
  isChecked                             = document.getElementById("Acci_DocReporteAccidente").checked;
  if(isChecked){
    Acci_DocReporteAccidente = "SI";
  }else{
    Acci_DocReporteAccidente = "NO";
  }
  isChecked = document.getElementById("Acci_DocConciliacion").checked;
  if(isChecked){
    Acci_DocConciliacion = "SI";
  }else{
    Acci_DocConciliacion = "NO";
  }
  isChecked = document.getElementById("Acci_DocPartePolicial").checked;
  if(isChecked){
    Acci_DocPartePolicial = "SI";
  }else{
    Acci_DocPartePolicial = "NO";
  }
  isChecked = document.getElementById("Acci_DocOficioPeritaje").checked;
  if(isChecked){
    Acci_DocOficioPeritaje = "SI";
  }else{
    Acci_DocOficioPeritaje = "NO";
  }
  isChecked = document.getElementById("Acci_DocReporteAtencion").checked;
  if(isChecked){
    Acci_DocReporteAtencion = "SI";
  }else{
    Acci_DocReporteAtencion = "NO";
  }
  isChecked = document.getElementById("Acci_DocDenunciaPolicial").checked;
  if(isChecked){
    Acci_DocDenunciaPolicial = "SI";
  }else{
    Acci_DocDenunciaPolicial = "NO";
  }
  isChecked = document.getElementById("Acci_DocCitacionManifestacion").checked;
  if(isChecked){
    Acci_DocCitacionManifestacion = "SI";
  }else{
    Acci_DocCitacionManifestacion = "NO";
  }
  isChecked = document.getElementById("Acci_DocOtro").checked;
  if(isChecked){
    Acci_DocOtro = "SI";
  }else{
    Acci_DocOtro = "NO";
  }
  Acci_DocOtroDescripcion         = $.trim($('#Acci_DocOtroDescripcion').val());
  Acci_DocOtroDescripcion         = Acci_DocOtroDescripcion.toUpperCase();
  Acci_DescripcionAccidente       = $.trim($('#Acci_DescripcionAccidente').val());
  Acci_DescripcionAccidente       = Acci_DescripcionAccidente.toUpperCase();
  Acci_NombreSuscribeInformacion  = $.trim($('#Acci_NombreSuscribeInformacion').val());
  Acci_FechaElaboracionInforme    = $.trim($('#Acci_FechaElaboracionInforme').val());
  Acci_UsuarioId_Cerrar           = $.trim($('#Acci_UsuarioId_Cerrar').val());
  Acci_FechaCerrar                = $.trim($('#Acci_FechaCerrar').val());
  acci_lugar_referencia           = $.trim($('#acci_lugar_referencia').val());
}
///:: FIN FUNCION CARGAR LAS VARIABLES CON LOS VALORES EDITADOS DEL INFORME PRELIMINAR ::::///

///:: FUNCION CARGAR LOS DATATABLES :::::::::::::::::::::::::::::::::::::::::::::::::::::::///
function f_CargarDataTables(){
  // Se inicializan los dataTables
  $("#tablaDanosPersonales").dataTable().fnDestroy();
  $("#tablaDanosTerceros").dataTable().fnDestroy();
  $("#tablaCausasAccidentes").dataTable().fnDestroy();
  $("#tablaAccionesTomadas").dataTable().fnDestroy();
  $("#tablaDanosReparacion").dataTable().fnDestroy();

  // Creación de Tablas
  div_tablas = f_CreacionTabla("tablaDanosPersonales",MostrarBorrar);
  $('#div_tablaDanosPersonales').html(div_tablas);
  div_tablas = f_CreacionTabla("tablaDanosTerceros",MostrarBorrar);
  $('#div_tablaDanosTerceros').html(div_tablas);
  div_tablas = f_CreacionTabla("tablaCausasAccidentes",MostrarBorrar);
  $('#div_tablaCausasAccidentes').html(div_tablas);
  div_tablas = f_CreacionTabla("tablaAccionesTomadas",MostrarBorrar);
  $('#div_tablaAccionesTomadas').html(div_tablas);
  div_tablas = f_CreacionTabla("tablaDanosReparacion",MostrarBorrar);
  $('#div_tablaDanosReparacion').html(div_tablas);

  // Se cargan las columnas de los datatables segun los permisos
  let columnastablaDanosPersonales;
  let columnastablaDanosTerceros;
  let columnastablaCausasAccidentes;
  let columnastablaAccionesTomadas;
  let columnastablaDanosReparacion;
  columnastablaDanosPersonales  = f_ColumnasTabla("tablaDanosPersonales",MostrarBorrar);
  columnastablaDanosTerceros    = f_ColumnasTabla("tablaDanosTerceros",MostrarBorrar);
  columnastablaCausasAccidentes = f_ColumnasTabla("tablaCausasAccidentes",MostrarBorrar);
  columnastablaAccionesTomadas  = f_ColumnasTabla("tablaAccionesTomadas",MostrarBorrar);
  columnastablaDanosReparacion  = f_ColumnasTabla("tablaDanosReparacion",MostrarBorrar);
  
  // Se inicializan los dataTables
  $("#tablaDanosPersonales").dataTable().fnDestroy();
  $("#tablaDanosTerceros").dataTable().fnDestroy();
  $("#tablaCausasAccidentes").dataTable().fnDestroy();
  $("#tablaAccionesTomadas").dataTable().fnDestroy();
  $("#tablaDanosReparacion").dataTable().fnDestroy();

  Accion                = 'CargaTablaNaturaleza';
  Acci_TipoNaturaleza   = 'DañosPersonales';
  tablaDanosPersonales  = $('#tablaDanosPersonales').removeAttr('width').DataTable({
    language    : idiomaEspanol,
    searching   : false,
    info        : false,
    fixedColumns: true,
    pageLength  : 10,
    responsive  : "true",
    "ajax"      : {            
      "url"     : "Ajax.php", 
      "method"  : 'POST',
      "data"    : { MoS:MoS, NombreMoS:NombreMoS, Accion:Accion, Accidentes_Id:InformePreliminar_Id, Acci_Tipo:Acci_TipoNaturaleza },
      "dataSrc" : ""
    },
    "columns"   : columnastablaDanosPersonales,
    "columnDefs"      : [
      {   width       : 200, targets: 1 },
    ],
    "order"           : [[0, 'asc']]
  });
  
  Acci_TipoNaturaleza = 'DañosTerceros';
  tablaDanosTerceros  = $('#tablaDanosTerceros').DataTable({
    language    : idiomaEspanol,
    searching   : false,
    info        : false,
    pageLength  : 10,
    responsive  : "true",
    "ajax"      : {            
      "url"     : "Ajax.php", 
      "method"  : 'POST',
      "data"    : { MoS:MoS, NombreMoS:NombreMoS, Accion:Accion, Accidentes_Id:InformePreliminar_Id, Acci_Tipo:Acci_TipoNaturaleza },
      "dataSrc" : ""
    },
    "columns"   : columnastablaDanosTerceros
  });
  
  Acci_TipoNaturaleza   = 'CausasAccidentes';
  tablaCausasAccidentes = $('#tablaCausasAccidentes').DataTable({
    language    : idiomaEspanol,
    searching   : false,
    info        : false,
    pageLength  : 10,
    responsive  : "true",
    "ajax"      : {            
      "url"     : "Ajax.php", 
      "method"  : 'POST',
      "data"    : { MoS:MoS, NombreMoS:NombreMoS, Accion:Accion, Accidentes_Id:InformePreliminar_Id, Acci_Tipo:Acci_TipoNaturaleza },
      "dataSrc" : ""
    },
    "columns": columnastablaCausasAccidentes
  });     

  Acci_TipoNaturaleza   = 'AccionesTomadas';
  tablaAccionesTomadas  = $('#tablaAccionesTomadas').DataTable({
    language    : idiomaEspanol,
    searching   : false,
    info        : false,
    pageLength  : 10,
    responsive  : "true",
    "ajax"      : {            
      "url"     : "Ajax.php", 
      "method"  : 'POST',
      "data"    : { MoS:MoS, NombreMoS:NombreMoS, Accion:Accion, Accidentes_Id:InformePreliminar_Id, Acci_Tipo:Acci_TipoNaturaleza },
      "dataSrc" : ""
    },
    "columns"   : columnastablaAccionesTomadas
  });     
  
  Accion = 'CargaTablaReparacion';
  tablaDanosReparacion = $('#tablaDanosReparacion').DataTable({
    "rowCallback":function(row,data,index)
    {
      f_ColorFilasDanosReparacion(row,data);
    }, 
    language    : idiomaEspanol,
    searching   : false,
    info        : false,
    pageLength  : 10,
    responsive  : "true",
    "ajax"      : {            
      "url"     : "Ajax.php", 
      "method"  : 'POST', //usamos el metodo POST
      "data"    : { MoS:MoS, NombreMoS:NombreMoS, Accion:Accion, Accidentes_Id:InformePreliminar_Id },
      "dataSrc" : ""
    },
    "columns"   : columnastablaDanosReparacion
  });
}
///:: FIN FUNCION CARGAR LOS DATATABLES :::::::::::::::::::::::::::::::::::::::::::::::::::///

///:: TERMINIO FUNCIONES DE INFORME PRELIMINAR ::::::::::::::::::::::::::::::::::::::::::::///