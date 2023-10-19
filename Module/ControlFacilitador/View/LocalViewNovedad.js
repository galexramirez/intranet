///::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
///:: TAB NOVEDADES v 4.0  FECHA: 25/07/2023 ::::::::::::::::::::::::::::::::::::::::::::::///
///:: EDITAR Y MOSTRAR LAS NOVEDADES ::::::::::::::::::::::::::::::::::::::::::::::::::::::///
///::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///

///:: DECLARACION DE VARIABLES ::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///

var tablaNovedadCarga, filaNovedadCarga, Nove_TipoOperacionCarga;
var OPE_NovedadId, NovedadCarga_Id, Nove_NovedadCarga, Nove_TipoNovedadCarga, Nove_DetalleNovedadCarga, Nove_DescripcionNovedadCarga, Nove_LugarExactoNovedadCarga, Nove_HoraInicioNovedadCarga, Nove_HoraFinNovedadCarga, CFaRg_EstadoNovedad, novedad_id, nove_tipo_imagen;
var Prog_FechaNovedadCarga, tDefaultContentNovedad, tRenderNovedad, selectHtmlNovedad;
var MostrarAbrirNovedadCarga; // Muestra la columna Abrir del datatable con el boton para abrir las novedades cerradas (true:Mostrar, false:No Mostrar)

///:: JS DOM NOVEDAD ::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
$(document).ready(function(){
  div_show = f_MostrarDiv("form_seleccion_novedad_carga","div_seleccion_novedad_carga","");
  $("#div_seleccion_novedad_carga").html(div_show);

  xtm = '0'+(fecha_hoy.getMonth()+1);
  xtd = '0'+fecha_hoy.getDate();
  Prog_FechaNovedadCarga = fecha_hoy.getFullYear()+'-'+xtm.substr(-2)+'-'+xtd.substr(-2);
  $("#Prog_FechaNovedadCarga").val(Prog_FechaNovedadCarga);

  Tipo        = 'ESTADO';
  Operacion   = 'NOVEDAD';
  selectHtml  = "";
  selectHtml  = f_TipoTabla(Operacion,Tipo)
  $("#Nove_Estado").html(selectHtml);
  $("#Nove_Estado").val('PENDIENTE');

  ///:: Selecciona las filas a editar :::::::::::::::::::::::::::::::::::::::::::::::::::::///
  $(document).on("click", "tr",".tablaNovedadCarga tbody", function(){		
    novedad_id = "";
    if(tablaNovedadCarga.rows('.selected').data().length===1){
      filaNovedadCarga = $(this).closest("tr");	        
      novedad_id         = filaNovedadCarga.find('td:eq(2)').text();
    }
    div_show = f_MostrarDiv("form_seleccion_novedad_carga","div_seleccion_novedad_carga",novedad_id);
    $("#div_seleccion_novedad_carga").html(div_show);
  });

  ///:: COLOCA EL NOMBRE DEL ARCHIVO PDF EN EL INPUT FILE PARA PDF ::::::::::::::::::::::::///
  $(document).on('change', '#cargar_pdf', function (event) {
    pdfEditar       = "";
    let NombreArch  = event.target.files[0].name;
    let Extension   = NombreArch.split('.').pop();
    $("#label_cargar_pdf").text(NombreArch);
  });

  ///:: Si hay cambios en el Fecha se ocultan botones y datatable :::::::::::::::::::::::::///
  $("#Prog_FechaNovedadCarga, #Nove_Estado").on('change', function () {
    $("#tablaNovedadCarga").dataTable().fnDestroy();
    $('#tablaNovedadCarga').hide();  
    div_show = f_MostrarDiv("form_seleccion_novedad_carga","div_seleccion_novedad_carga","");
    $("#div_seleccion_novedad_carga").html(div_show);  
  });

  ///:: Add event listener for opening and closing details ::::::::::::::::::::::::::::::::///
  $('#tablaNovedadCarga tbody').on('click', 'td.dt-control', function () {
    var tr = $(this).closest('tr');
    var row = tablaNovedadCarga.row( tr );

    if ( row.child.isShown() ) {
        // This row is already open - close it
        row.child.hide();
        tr.removeClass('dt-hasChild shown');
    }
    else {
        // Open this row
        row.child( format(row.data()) ).show();
        tr.addClass('dt-hasChild shown');
    }
  } );
  
  ///:: Si hay cambios en Novedad se actualiza Tipo Novedad y Detalle Novedad :::::::::::::///
  $("#Nove_NovedadCarga").on('change', function () {
    Nove_NovedadCarga = $("#Nove_NovedadCarga").val();
    selectHtmlNovedad="";
    selectHtmlNovedad = f_TipoTabla(Nove_TipoOperacionCarga,Nove_NovedadCarga);
    $("#Nove_TipoNovedadCarga").html(selectHtmlNovedad);
    thtmlNovedad = '<option value="">Seleccione una opcion</option>';
    $("#Nove_DetalleNovedadCarga").html(thtmlNovedad);
  });

  ///:: Si hay cambios en Novedad se actualiza Tipo Novedad y Detalle Novedad :::::::::::::///
  $("#Nove_TipoNovedadCarga").on('change', function () {
    Nove_TipoNovedadCarga = $("#Nove_TipoNovedadCarga").val();
    selectHtmlNovedad="";
    selectHtmlNovedad = f_TipoTabla(Nove_TipoOperacionCarga,Nove_TipoNovedadCarga);
    $("#Nove_DetalleNovedadCarga").html(selectHtmlNovedad);
  });

  ///:: INCIO BOTONES NOVEDAD :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///

  ///:: BOTON QUE MUESTRA EL DATATABLE DE NOVEDADES :::::::::::::::::::::::::::::::::::::::///
  $(document).on("click", ".btnBuscarNovedadCarga", function(){
    div_tablas = f_CreacionTabla("tablaNovedadCarga","colAbrirNovedadCarga");
    $('#div_tablaNovedadCarga').html(div_tablas);
    $('#tablaNovedadCarga').hide();

    // Setup - add a text input to each footer cell
    $('#tablaDetalleNovedad thead tr')
      .clone(true)
      .addClass('filtersDetalleNovedad')
      .appendTo('#tablaDetalleNovedad thead');

    MostrarAbrirNovedadCarga  = false;
    Prog_FechaNovedadCarga    = $("#Prog_FechaNovedadCarga").val();
    Nove_Estado               = $("#Nove_Estado").val();
    
    // VALIDAR ESTADO DEL CONTROL FACILITADOR ALIMENTADOR EN LA FECHA CORRESPONDIENTE
    Accion='ValidarControlFacilitadorCarga'; 
    $.ajax({
      url: "Ajax.php",
      type: "POST",
      datatype:"json",
      async: false,    
      data: {MoS:MoS,NombreMoS:NombreMoS,Accion:Accion,Prog_Fecha:Prog_FechaNovedadCarga},    
      success: function(data){
          CFaRg_EstadoNovedad = data;
          if (CFaRg_EstadoNovedad=="GENERADO"){
          }else{
              if (CFaRg_EstadoNovedad=="CERRADO"){
                Swal.fire(
                  'Cerrado!',
                  'El Control Facilitador se encuentra cerrado.',
                  'success'
                )
              }else{
                  Swal.fire(
                      'NO Generado!',
                      'El Control Facilitador no se encuentra generado.',
                      'success'
                  )
              }
          }
      }
    });
    columnastabla = f_ColumnasTabla("tablaNovedadCarga",CFaRg_EstadoNovedad);
    Accion = 'BuscarNovedadCarga';
    $("#tablaNovedadCarga").dataTable().fnDestroy();
    $('#tablaNovedadCarga').show();

    tablaNovedadCarga = $('#tablaNovedadCarga').DataTable({
      processing    : true,
      select        : {style: 'os'},
      language      : idiomaEspanol,
      responsive    : "true",
      dom           : 'Blfrtip', // Con Botones Excel,Pdf,Print
      pageLength    : 50,
      buttons:
      [
        {
          extend    : 'excelHtml5',
          text      : '<i class="fas fa-file-excel"></i> ',
          titleAttr : 'Exportar a Excel',
          className : 'btn btn-success'
        },
        {
          extend    : 'print',
          text      :  '<i class="fa fa-print"></i> ',
          titleAttr : 'Imprimir',
          className : 'btn btn-info'
        },
      ],
      "ajax"        : {   
        "url"       : "Ajax.php", 
        "method"    : 'POST', //usamos el metodo POST
        "data"      : {MoS:MoS,NombreMoS:NombreMoS,Accion:Accion,Nove_Fecha:Prog_FechaNovedadCarga, Nove_Estado:Nove_Estado}, //enviamos opcion 4 para que haga un SELECT
        "dataSrc"   : ""
      },
      "columns"     : columnastabla,
      "order"       : [[1, 'desc']]
    });
  });
  ///:: FIN BOTON QUE MUESTRA EL DATATABLE DE NOVEDADES :::::::::::::::::::::::::::::::::::///

  ///:: BOTON EDITAR NOVEDAD ::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
  $(document).on("click", ".btnEditarNovedadCarga", function(){
    $("#formNovedadCarga").trigger("reset"); 
    $("#btnGuardarNovedadCarga").prop("disabled",false);
    filaNovedadCarga = $(this).closest("tr");
    OPE_NovedadId = filaNovedadCarga.find('td:eq(1)').text();
    NovedadCarga_Id = filaNovedadCarga.find('td:eq(2)').text();
    Nove_TipoOperacionCarga = filaNovedadCarga.find('td:eq(11)').text();
    Nove_EstadoCarga = filaNovedadCarga.find('td:eq(17)').text();

    let opcionEditarNovedad = 0;
    
    if(Nove_EstadoCarga=="ANULADO" && opcionEditarNovedad==0){
      Swal.fire({
        icon: 'error',
        title: 'EDITAR...',
        text: '*El registro se encuentra ANULADO!'
      });
      opcionEditarNovedad=1;
    }
    if(Nove_EstadoCarga=="CERRADO" && opcionEditarNovedad==0){
      Swal.fire({
        icon: 'error',
        title: 'EDITAR...',
        text: '*El registro se encuentra CERRADO!'
      });
      opcionEditarNovedad=1;
    }
  
    if(opcionEditarNovedad==0){
      $("#btnGuardarNovedadCarga").prop("disabled",false);
      LimpiaNovedadCarga();
      Nove_NovedadCarga = filaNovedadCarga.find('td:eq(7)').text();
      Nove_TipoNovedadCarga = filaNovedadCarga.find('td:eq(8)').text();
      Nove_DetalleNovedadCarga = filaNovedadCarga.find('td:eq(9)').text();
      // Nove_DescripcionNovedadCarga = filaNovedadCarga.find('td:eq(10)').text();
      Nove_DescripcionNovedadCarga = f_buscar_dato("OPE_Novedad","Nove_Descripcion"," `Novedad_Id`='"+NovedadCarga_Id+"'");
      Nove_LugarExactoNovedadCarga = filaNovedadCarga.find('td:eq(14)').text();
      Nove_HoraInicioNovedadCarga = filaNovedadCarga.find('td:eq(15)').text();
      Nove_HoraFinNovedadCarga = filaNovedadCarga.find('td:eq(16)').text();
      HoraInicioNovedadCarga = Nove_HoraInicioNovedadCarga.substring(0,2);
      MinutoInicioNovedadCarga = Nove_HoraInicioNovedadCarga.substring(3,5);
      HoraFinNovedadCarga = Nove_HoraFinNovedadCarga.substring(0,2);
      MinutoFinNovedadCarga = Nove_HoraFinNovedadCarga.substring(3,5);
  
      TipoNovedad='NOVEDAD';
      selectHtmlNovedad="";
      selectHtmlNovedad = f_TipoTabla(Nove_TipoOperacionCarga,TipoNovedad);
      $("#Nove_NovedadCarga").html(selectHtmlNovedad);

      selectHtmlNovedad="";
      selectHtmlNovedad = f_TipoTabla(Nove_TipoOperacionCarga,Nove_NovedadCarga);
      $("#Nove_TipoNovedadCarga").html(selectHtmlNovedad);

      selectHtmlNovedad="";
      selectHtmlNovedad = f_TipoTabla(Nove_TipoOperacionCarga,Nove_TipoNovedadCarga);
      $("#Nove_DetalleNovedadCarga").html(selectHtmlNovedad);
      
      $("#NovedadCarga_Id").val(NovedadCarga_Id);
      $("#Nove_NovedadCarga").val(Nove_NovedadCarga);
      $("#Nove_TipoNovedadCarga").val(Nove_TipoNovedadCarga);
      $("#Nove_DetalleNovedadCarga").val(Nove_DetalleNovedadCarga);
      $("#Nove_DescripcionNovedadCarga").val(Nove_DescripcionNovedadCarga);
      $("#Nove_LugarExactoNovedadCarga").val(Nove_LugarExactoNovedadCarga);
      $("#Nove_HoraInicioNovedadCarga").val(Nove_HoraInicioNovedadCarga);
      $("#Nove_HoraFinNovedadCarga").val(Nove_HoraFinNovedadCarga);
      $("#HoraInicioNovedadCarga").val(HoraInicioNovedadCarga);
      $("#MinutoInicioNovedadCarga").val(MinutoInicioNovedadCarga);
      $("#HoraFinNovedadCarga").val(HoraFinNovedadCarga);
      $("#MinutoFinNovedadCarga").val(MinutoFinNovedadCarga);

      $("#NovedadCarga_Id").prop('disabled', true);    
      $(".modal-header").css("background-color", "#007bff");
      $(".modal-header").css("color", "white" );
      $(".modal-title").text("Editar Novedad");
      
      $("#modalCRUDNovedadCarga").modal("show");
      $("#modalCRUDNovedadCarga").draggable({});
    }
  });
  ///:: FIN BOTON EDITAR NOVEDAD ::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///

  ///:: BOTON BORRAR REGISTRO NOVEDAD :::::::::::::::::::::::::::::::::::::::::::::::::::::///
  $(document).on("click", ".btnEliminarNovedadCarga", function(){
    filaNovedadCarga = $(this).closest('tr');           
    OPE_NovedadId = filaNovedadCarga.find('td:eq(1)').text();
    NovedadCarga_Id = filaNovedadCarga.find('td:eq(2)').text();
    Nove_FechaCarga = filaNovedadCarga.find('td:eq(5)').text();
    Nove_TipoNovedad = filaNovedadCarga.find('td:eq(8)').text();
    Nove_OperacionCarga = filaNovedadCarga.find('td:eq(11)').text();
    Nove_EstadoCarga = filaNovedadCarga.find('td:eq(17)').text();
    
    let opcionEliminarNovedad = 0;
    let tValidarNovedad_ControlFacilitador = "";

    if(Nove_EstadoCarga=="ANULADO" && opcionEliminarNovedad==0){
      Swal.fire({
        icon: 'error',
        title: 'ANULAR...',
        text: '*El registro se encuentra ANULADO!'
      });
      opcionEliminarNovedad=1;
    }
    if(Nove_EstadoCarga=="CERRADO" && opcionEliminarNovedad==0){
      Swal.fire({
        icon: 'error',
        title: 'ANULAR...',
        text: '*El registro se encuentra CERRADO!'
      });
      opcionEliminarNovedad=1;
    }
    if(Nove_TipoNovedad!="ERROR_DE_REGISTRO" && opcionEliminarNovedad==0){
      Swal.fire({
        icon: 'error',
        title: 'ANULAR...',
        text: '*El tipo de novedad debe se ERROR_DE_REGISTRO!'
      });
      opcionEliminarNovedad=1;
    }

    Accion='ValidarNovedad_ControlFacilitador';
    $.ajax({
      url: "Ajax.php",
      type: "POST",
      datatype:"json",
      async: false,    
      data: { MoS:MoS,NombreMoS:NombreMoS,Accion:Accion,OPE_NovedadId:OPE_NovedadId,Novedad_Id:NovedadCarga_Id},   
      success: function(data) {
        tValidarNovedad_ControlFacilitador = data;
      }
    });

    if(tValidarNovedad_ControlFacilitador!="" && opcionEliminarNovedad==0){
      Swal.fire({
        icon: 'error',
        title: 'ANULAR...',
        text: '*Novedad '+NovedadCarga_Id+' asignada en Control Facilitador IDs : '+tValidarNovedad_ControlFacilitador+' !!!'
      });
      opcionEliminarNovedad=1;
    }

    if(opcionEliminarNovedad == 0){
      Swal.fire({
        title: '¿Está seguro?',
        text: "Se anulará el registro "+NovedadCarga_Id+" | "+Nove_FechaCarga+" | "+Nove_OperacionCarga+" !!!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si, anular!',
        cancelButtonText: 'Cancelar'
      }).then((result) => 
      {
        if (result.isConfirmed){
          Swal.fire(
            'Anulado!',
            'El registro ha sido anulado.',
            'success')
          respuesta = 1;
          if (respuesta == 1){            
            Accion='EliminarNovedadCarga';
            $.ajax({
              url: "Ajax.php",
              type: "POST",
              datatype:"json",    
              data: { MoS:MoS,NombreMoS:NombreMoS,Accion:Accion,OPE_NovedadId:OPE_NovedadId},   
              success: function() {
                tablaNovedadCarga.ajax.reload(null, false);
              }
            });
          }
        }
      });
    }
  });
  ///:: FIN BOTON BORRAR REGISTRO NOVEDAD :::::::::::::::::::::::::::::::::::::::::::::::::///
    
  ///:: BOTON CERRAR REGISTRO NovedadCarga ::::::::::::::::::::::::::::::::::::::::::::::::///
  $(document).on("click", ".btnCerrarNovedadCarga", function(){
    filaNovedadCarga = $(this).closest('tr');
    OPE_NovedadId = filaNovedadCarga.find('td:eq(1)').text();
    NovedadCarga_Id = filaNovedadCarga.find('td:eq(2)').text();
    Nove_FechaCarga = filaNovedadCarga.find('td:eq(5)').text();
    Nove_OperacionCarga = filaNovedadCarga.find('td:eq(11)').text();
    Nove_EstadoCarga = filaNovedadCarga.find('td:eq(17)').text();
  
    let opcionCerrarNovedad = 0;

    if(Nove_EstadoCarga=='CERRADO' && opcionCerrarNovedad==0){
      Swal.fire({
        icon: 'error',
        title: 'CERRAR...',
        text: '*El registro se encuentra CERRADO!'
      })
      opcionCerrarNovedad = 1;
    }

    if(Nove_EstadoCarga=='ANULADO' && opcionCerrarNovedad==0){
      Swal.fire({
        icon: 'error',
        title: 'CERRAR...',
        text: '*El registro ya se encuentra ANULADO!'
      })
      opcionCerrarNovedad = 1;
    }

    if(opcionCerrarNovedad == 0){
      Swal.fire({
        title: '¿Está seguro?',
        text: "Se cerrará el registro "+NovedadCarga_Id+" | "+Nove_FechaCarga+" | "+Nove_OperacionCarga+" !!!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si, cerrar!',
        cancelButtonText: 'Cancelar'
      }).then((result) => 
      {
        if (result.isConfirmed){
          Swal.fire(
            'Cerrado!',
            'El registro ha sido cerrado.',
            'success')
          respuesta = 1;
          if (respuesta == 1){            
            Accion='CerrarNovedadCarga';
            $.ajax({
              url: "Ajax.php",
              type: "POST",
              datatype:"json",    
              data: { MoS:MoS,NombreMoS:NombreMoS,Accion:Accion,OPE_NovedadId:OPE_NovedadId},   
              success: function(data) {
                tablaNovedadCarga.ajax.reload(null, false);
              }
            });
          }
        }
      });
    }
  });
  ///:: FIN BOTON CERRAR REGISTRO NovedadCarga ::::::::::::::::::::::::::::::::::::::::::::///

  ///:: BOTON ABRIR REGISTRO NovedadCarga :::::::::::::::::::::::::::::::::::::::::::::::::///
  $(document).on("click", ".btnAbrirNovedadCarga", function(){
    let cf_estado = "";
    filaNovedadCarga    = $(this).closest('tr');
    OPE_NovedadId       = filaNovedadCarga.find('td:eq(1)').text();
    NovedadCarga_Id     = filaNovedadCarga.find('td:eq(2)').text();
    Nove_FechaCarga     = filaNovedadCarga.find('td:eq(5)').text();
    Nove_OperacionCarga = filaNovedadCarga.find('td:eq(11)').text();
    Nove_EstadoCarga    = filaNovedadCarga.find('td:eq(17)').text();

    cf_estado = f_buscar_dato("OPE_ControlFacilitadorRegistroCarga", "CFaRg_Estado", "`CFaRg_FechaCargada`='"+Prog_FechaNovedadCarga+"' AND `CFaRg_TipoOperacionCargada`='"+Nove_OperacionCarga+"'");

    if(cf_estado=="CERRADO"){
      Swal.fire({
        icon: 'error',
        title: 'CERRADO...',
        text: '*El Control Facilitador se encuentra CERRADO!!!'
      })
    }else{
      if(Nove_EstadoCarga=="CERRADO"){
        Swal.fire({
          title: '¿Está seguro?',
          text: "Se abrirá el registro "+NovedadCarga_Id+" | "+Nove_FechaCarga+" | "+Nove_OperacionCarga+" !!!",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Si, abrir!',
          cancelButtonText: 'Cancelar'
        }).then((result) => 
        {
          if (result.isConfirmed){
            Swal.fire(
              'Abierto!',
              'El registro ha sido abierto.',
              'success')
            respuesta = 1;
            if (respuesta == 1){            
              Accion='AbrirNovedadCarga';
              $.ajax({
                url: "Ajax.php",
                type: "POST",
                datatype:"json",    
                data: { MoS:MoS,NombreMoS:NombreMoS,Accion:Accion,OPE_NovedadId:OPE_NovedadId},   
                success: function(data) {
                  tablaNovedadCarga.ajax.reload(null, false);
                }
              });
            }
          }
        });
      }else{
        Swal.fire({
          icon: 'error',
          title: 'ABRIR...',
          text: '*El registro NO se encuentra CERRADO!!!'
        })
      }
    }
  });

  ///:: BOTON HISTORIAL NovedadCarga :::::::::::::::::::::::::::::::::::::::::::::::::::::::///
  $(document).on("click", ".btnHistorialNovedadCarga", function(){
    let tdiv_MostrarHistorialNovedadCarga="";
    filaNovedadCarga = $(this).closest('tr');
    NovedadCarga_Id = filaNovedadCarga.find('td:eq(2)').text();

    $("#formMostrarNovedadAlimentador").trigger("reset");

    Accion='HistorialNovedadCarga';
    $.ajax({
      url: "Ajax.php",
      type: "POST",
      datatype:"json",
      async: false,     
      data: { MoS:MoS,NombreMoS:NombreMoS,Accion:Accion,Novedad_Id:NovedadCarga_Id},   
      success: function(data) {
        tdiv_MostrarHistorialNovedadCarga = data;
        $('#div_MostrarHistorialNovedadCarga').html(tdiv_MostrarHistorialNovedadCarga);
      }
    });

    if(tdiv_MostrarHistorialNovedadCarga==""){
      Swal.fire(
        'Historial!',
        'El Registro no cuenta con historial.',
        'success'
      )
    }else{
      $(".modal-header").css( "background-color", "#17a2b8");
      $(".modal-header").css( "color", "white" );
      $(".modal-title").text("Historial Novedades");
      $('#modalCRUDMostrarHistorialNovedadCarga').modal('show');
    }
  });
  ///:: FIN BOTON CERRAR REGISTRO NovedadCarga ::::::::::::::::::::::::::::::::::::::::::::///

  ///:: BOTON GRABAR -> REALIZA LA GRABACION EN LA TABLA OPE_NOVEDAD ::::::::::::::::::::::///
  $('#formNovedadCarga').submit(function(e){
    e.preventDefault(); //evita el comportambiento normal del submit, es decir, recarga total de la página
    let tValidarNovedadCarga="";
    let horaNovedad, minutoNovedad;
    NovedadCarga_Id = $('#NovedadCarga_Id').val();
    Nove_NovedadCarga = $('#Nove_NovedadCarga').val();
    Nove_TipoNovedadCarga = $('#Nove_TipoNovedadCarga').val();
    Nove_DetalleNovedadCarga = $('#Nove_DetalleNovedadCarga').val();
    Nove_DescripcionNovedadCarga = $('#Nove_DescripcionNovedadCarga').val();
    Nove_LugarExactoNovedadCarga = $('#Nove_LugarExactoNovedadCarga').val();

    Nove_HoraInicioNovedadCarga = "";
    Nove_HoraFinNovedadCarga = "";
    horaNovedad = $.trim($('#HoraInicioNovedadCarga').val());
    minutoNovedad = $.trim($('#MinutoInicioNovedadCarga').val());
    if(horaNovedad !="" && minutoNovedad !=""){
      Nove_HoraInicioNovedadCarga = horaNovedad + ":" + minutoNovedad;
    }
    horaNovedad = $.trim($('#HoraFinNovedadCarga').val());
    minutoNovedad = $.trim($('#MinutoFinNovedadCarga').val());
    if(horaNovedad !="" && minutoNovedad !=""){
      Nove_HoraFinNovedadCarga = horaNovedad + ":" + minutoNovedad;
    }

    tValidarNovedadCarga = f_ValidarNovedadCarga(Nove_NovedadCarga, Nove_TipoNovedadCarga, Nove_DetalleNovedadCarga, Nove_DescripcionNovedadCarga, Nove_LugarExactoNovedadCarga, Nove_HoraInicioNovedadCarga, Nove_HoraFinNovedadCarga);

    if(tValidarNovedadCarga=="invalido"){
      Swal.fire({
        icon: 'error',
        title: 'EDITAR...',
        text: '*Los Campos no pueden estar VACIOS!'
      });
    }else{
      Accion='EditarNovedadCarga';
      $("#btnGuardarNovedadCarga").prop("disabled",true);
      $.ajax({
        url: "Ajax.php",
        type: "POST",
        datatype:"json",    
        data:  { MoS:MoS,NombreMoS:NombreMoS,Accion:Accion,OPE_NovedadId:OPE_NovedadId,Novedad_Id:NovedadCarga_Id,Nove_Novedad:Nove_NovedadCarga,Nove_TipoNovedad:Nove_TipoNovedadCarga,Nove_DetalleNovedad:Nove_DetalleNovedadCarga,Nove_Descripcion:Nove_DescripcionNovedadCarga,Nove_LugarExacto:Nove_LugarExactoNovedadCarga,Nove_HoraInicio:Nove_HoraInicioNovedadCarga,Nove_HoraFin:Nove_HoraFinNovedadCarga },    
        success: function(data) {
          tablaNovedadCarga.ajax.reload(null, false);
        }
      });
      $('#modalCRUDNovedadCarga').modal('hide');
    }
  });
  ///:: FIN BOTON GRABAR -> REALIZA LA GRABACION EN LA TABLA OPE_NOVEDAD ::::::::::::::::::///

  ///:: BOTON ADJUNTAR PDF DE NOVEDADES :::::::::::::::::::::::::::::::::::::::::::::::::::///
  $(document).on("click", ".btn_cargar_pdf_novedades", function(){		
    if(novedad_id!=""){
      let buscar_pdf    = "";
      nove_tipo_imagen  = "NOVEDAD";
      file_pdf          = "NOVEDAD ID-"+novedad_id;
   
      buscar_pdf = f_buscar_pdf('ope_novedad_imagen', 'nove_imagen', 'novedad_id', novedad_id, 'nove_tipo_imagen', nove_tipo_imagen, file_pdf);
      if(buscar_pdf==""){
        opcion_carga_pdf = "CREAR";
      }else{
        opcion_carga_pdf = "EDITAR";
      }
      
      $(".modal-header").css( "background-color", "#17a2b8");
      $(".modal-header").css( "color", "white" );
      $(".modal-title").text("Carga de Novedades PDF");
      $("#label_cargar_pdf").text("Seleccionar Archivo .pdf");
      $('#modal_crud_cargar_pdf').modal('show');
    }else{
      Swal.fire({
        icon  : 'error',
        title : 'ID Accidente...',
        text  : 'No se ha generado el ID Accidente!'
      })    
    }
  });
  ///:: FIN BOTON ADJUNTAR COTIZACION PDF DE COSTOS DE ACCIDENTES :::::::::::::::::::::::::///

  ///:: BOTON CARGAR PDF -> REALIZA LA GRABACION EN LA TABLA ope_novedades_imagen :::::::::///
  $('#form_modal_cargar_pdf').submit(function(e){
    e.preventDefault();
    f_grabar_pdf(opcion_carga_pdf, nove_tipo_imagen);
    div_show = f_MostrarDiv("form_seleccion_novedad_carga","div_seleccion_novedad_carga",novedad_id);
    $("#div_seleccion_novedad_carga").html(div_show);
    $('#modal_crud_cargar_pdf').modal('hide');
  });
  ///:: FIN BOTON CARGAR PDF -> REALIZA LA GRABACION EN LA TABLA ope_novedades_imagen :::::///

  ///:: BOTON VER NOVEDAD PDF DE NOVEDADES ::::::::::::::::::::::::::::::::::::::::::::::::///
  $(document).on("click", ".btn_ver_pdf_novedades", function(){		
    let x_pdf     = "";
    let file_pdf  = "NOVEDAD ID-"+novedad_id;
    x_pdf         = f_buscar_pdf('ope_novedad_imagen','nove_imagen','novedad_id',novedad_id,'nove_tipo_imagen','NOVEDAD',file_pdf );
    
    if(x_pdf == ""){
        Swal.fire({
            icon: 'error',
            title: 'PDF...',
            text: '*NO se ha registrado el archivo PDF!'
          });
    }else{
      window.open("../../../Services/pdf/"+x_pdf,"_blank");  
      f_unlink_pdf(x_pdf);
    }
  });
  ///:: FIN BOTON VER COTIZACION PDF DE COSTO DE ACCIDENTES :::::::::::::::::::::::::::::::///

  ///:: TERMINO BOTONES NOVEDAD :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
});

///:: INICIO FUNCIONES NOVEDAD CARGA ::::::::::::::::::::::::::::::::::::::::::::::::::::::///

///:: Formatting function for row details - modify as you need ::::::::::::::::::::::::::::///
function format ( d ) {
  let Nove_UsuarioId_Edicion = d.Nove_UsuarioId_Edicion;
  let Nove_FechaEdicion = d.Nove_FechaEdicion;
  let Nove_UsuarioId_Eliminar = d.Nove_UsuarioId_Eliminar;
  let Nove_FechaEliminar = d.Nove_FechaEliminar;
  let Nove_UsuarioId_Cerrar = d.Nove_UsuarioId_Cerrar;
  let Nove_FechaCerrar = d.Nove_FechaCerrar;

  if(Nove_UsuarioId_Edicion==null){
    Nove_UsuarioId_Edicion="";
    Nove_FechaEdicion="";
  };

  if(Nove_UsuarioId_Eliminar==null){
    Nove_UsuarioId_Eliminar="";
    Nove_FechaEliminar="";
  };
  
  if(Nove_UsuarioId_Cerrar==null){
    Nove_UsuarioId_Cerrar="";
    Nove_FechaCerrar="";
  };

  // `d` is the original data object for the row
  return '<table id="tablaDetalleNovedadCarga" cellpadding="5" cellspacing="0" border="0" style="padding-left:50px;">'+
      '<tr>'+
          '<td>TABLA:</td>'+
          '<td>'+d.Nove_Tabla+'</td>'+
          '<td>HORA ORIGEN:</td>'+
          '<td>'+d.Nove_HoraOrigen+'</td>'+
          '<td>HORA DESTINO:</td>'+
          '<td>'+d.Nove_HoraDestino +'</td>'+
          '<td>SERVICIO:</td>'+
          '<td>'+d.Nove_Servicio+'</td>'+
          '<td>LUGAR ORIGEN:</td>'+
          '<td>'+d.Nove_LugarOrigen +'</td>'+
          '<td>LUGAR DESTINO:</td>'+
          '<td>'+d.Nove_LugarDestino +'</td>'+
      '</tr>'+
      '<tr>'+
          '<td>USUARIO ULTIMA EDICION:</td>'+
          '<td>'+Nove_UsuarioId_Edicion+'</td>'+
          '<td>FECHA ULTIMA EDICION:</td>'+
          '<td>'+Nove_FechaEdicion+'</td>'+
          '<td>USUARIO QUE ELIMINA:</td>'+
          '<td>'+Nove_UsuarioId_Eliminar+'</td>'+
          '<td>FECHA QUE ELIMINA:</td>'+
          '<td>'+Nove_FechaEliminar+'</td>'+
          '<td>USUARIO QUE CIERRA:</td>'+
          '<td>'+Nove_UsuarioId_Cerrar+'</td>'+
          '<td>FECHA QUE CIERRA:</td>'+
          '<td>'+Nove_FechaCerrar+'</td>'+
      '</tr>'+
  '</table>';
}
///:: FIN Formatting function for row details - modify as you need ::::::::::::::::::::::::///

///:: FUNCION PARA V ALIDAR LOS DATOS INGRESADOS AL FORMULARIO :::::::::::::::::::::::::::::///
function f_ValidarNovedadCarga(pNove_NovedadCarga, pNove_TipoNovedadCarga, pNove_DetalleNovedadCarga, pNove_DescripcionNovedadCarga, pNove_LugarExactoNovedadCarga, pNove_HoraInicioNovedadCarga, pNove_HoraFinNovedadCarga){
  LimpiaNovedadCarga();
  NoLetrasMayuscEspacio=/[^A-Z \Ñ]/;
  let rptaValidarNovedadCarga="";    
  let thora, tminuto, thoraini, thorafin;

  if(pNove_NovedadCarga==""){
    $("#Nove_NovedadCarga").addClass("color-error");
    rptaValidarNovedadCarga="invalido";
  }
    
  if(pNove_TipoNovedadCarga==""){
    $("#Nove_TipoNovedadCarga").addClass("color-error");
    rptaValidarNovedadCarga="invalido";
  }

  if(pNove_DetalleNovedadCarga==""){
    $("#Nove_DetalleNovedadCarga").addClass("color-error");
    rptaValidarNovedadCarga="invalido";
  }

  if(pNove_DescripcionNovedadCarga==""){
    $("#Nove_DescripcionNovedadCarga").addClass("color-error");
    rptaValidarNovedadCarga="invalido";
  }

  if(pNove_LugarExactoNovedadCarga==""){
    $("#Nove_LugarExactoNovedadCarga").addClass("color-error");
    rptaValidarNovedadCarga="invalido";
  }

  if(pNove_HoraInicioNovedadCarga==""){
    $("#HoraInicioNovedadCarga").addClass("color-error");
    $("#MinutoInicioNovedadCarga").addClass("color-error");
    rptaValidarNovedadCarga="invalido";
  }

  if(pNove_HoraFinNovedadCarga==""){
    $("#HoraFinNovedadCarga").addClass("color-error");
    $("#MinutoFinNovedadCarga").addClass("color-error");
    rptaValidarNuevaNovedadCarga="invalido";
  }

  ///:: Cambiamos formato string a formato date para comparar :::::::::::::::::::::::::::::///
  thora = pNove_HoraInicioNovedadCarga.substring(0,2);
  tminuto = pNove_HoraInicioNovedadCarga.substring(3,5);
  thoraini = new Date("0","0","0",thora,tminuto);
  thora = pNove_HoraFinNovedadCarga.substring(0,2);
  tminuto = pNove_HoraFinNovedadCarga.substring(3,5);
  thorafin = new Date("0","0","0",thora,tminuto);

  if(thoraini > thorafin){
    $("#HoraFinNovedadCarga").addClass("color-error");
    $("#MinutoFinNovedadCarga").addClass("color-error");
    rptaValidarNovedadCarga="invalido";
  }

  return rptaValidarNovedadCarga; 
}
///:: FIN FUNCION PARA VALIDAR LOS DATOS INGRESADOS AL FORMULARIO :::::::::::::::::::::::::///

///:: INVISIBILIZA LOS MENSAJE DE ALERTA DEL FORMULARIO :::::::::::::::::::::::::::::::::::///
function LimpiaNovedadCarga(){
  $("#Nove_NovedadCarga").removeClass("color-error");
  $("#Nove_TipoNovedadCarga").removeClass("color-error");
  $("#Nove_DetalleNovedadCarga").removeClass("color-error");
  $("#Nove_DescripcionNovedadCarga").removeClass("color-error");
  $("#Nove_LugarExactoNovedadCarga").removeClass("color-error");
  $("#HoraInicioNovedadCarga").removeClass("color-error");
  $("#MinutoInicioNovedadCarga").removeClass("color-error");
  $("#HoraFinNovedadCarga").removeClass("color-error");
  $("#MinutoFinNovedadCarga").removeClass("color-error");
}
///:: FIN INVISIBILIZA LOS MENSAJE DE ALERTA DEL FORMULARIO :::::::::::::::::::::::::::::::///

///:: BUSCAR PDF ::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///       
function f_buscar_pdf(p_tabla, p_campo_archivo, p_campo_buscar, p_dato_buscar, p_campo_tipo_archivo, p_dato_tipo_archivo, p_nombre_archivo){
  let pdf = "";
  Accion = 'buscar_pdf';
  $.ajax({
      url       : "Ajax.php",
      type      : "POST",
      datatype  : "json",    
      async     : false,   
      data      : { MoS:MoS, NombreMoS:NombreMoS, Accion:Accion, tabla:p_tabla, campo_archivo:p_campo_archivo, campo_buscar:p_campo_buscar, dato_buscar:p_dato_buscar, campo_tipo_archivo:p_campo_tipo_archivo, dato_tipo_archivo:p_dato_tipo_archivo, nombre_archivo:p_nombre_archivo },   
      success: function(data) {
        pdf = data;
      }
  });	
  return pdf;
}
///:: FIN BUSCAR PDF ::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///

function f_unlink_pdf(p_archivo){
  let rpta_unlink_pdf = "";
  Accion = 'unlink_pdf';
  $.ajax({
      url       : "Ajax.php",
      type      : "POST",
      datatype  : "json",    
      async     : false,   
      data      : { MoS:MoS, NombreMoS:NombreMoS, Accion:Accion, archivo:p_archivo },   
      success: function(data) {
        rpta_unlink_pdf = data;
      }
  });
  return rpta_unlink_pdf;
}

///:: GRABAR IMAGEN :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
function f_grabar_pdf(p_opcion_carga_pdf, p_nove_tipo_imagen){
  let blobFile;
  let formData = new FormData();

  blobFile = $('#cargar_pdf')[0].files[0];
  
  if(blobFile){
    if(p_opcion_carga_pdf=="CREAR"){
      Accion='grabar_imagen';
    }else{
      Accion='editar_imagen';
    }
  
    formData.append("MoS", MoS);
    formData.append("NombreMoS", NombreMoS);
    formData.append("Accion", Accion);
    formData.append("novedad_id", novedad_id);
    formData.append("nove_tipo_imagen", p_nove_tipo_imagen);
    formData.append("nove_imagen", blobFile);
    $.ajax({
        url         : "Ajax.php",
        type        : "POST",
        datatype    : "json",
        data        : formData,   
        async       : false,
        contentType : false,
        processData : false,
        success     : function(data) {
        }
    });	  
  }
  
}
///:: FIN GRABAR IMAGEN :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///

///:: TERMINO FUNCIONES NOVEDAD CARGA :::::::::::::::::::::::::::::::::::::::::::::::::::::///