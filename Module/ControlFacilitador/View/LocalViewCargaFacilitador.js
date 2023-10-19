///::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
///:: TAB CARGA v 4.0 2023-08-15 ::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
///:: CREAR, CERRAR Y ELIMINAR CONTROLES FACILITADORES ::::::::::::::::::::::::::::::::::::///
///::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///

///:: DECLARACION DE VARIABLES ::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
var SemanaFacilitadorCarga, CFaRg_FechaCargada, CFaRg_TipoOperacionCargada, CFaRg_Id, CFaRg_Estado;

///:: DOM CARGA FACILITADOR :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///

$(document).ready(function(){
  ///:: Se carga el boton de generar un nuevo registro ::::::::::::::::::::::::::::::::::::///
  div_boton = f_BotonesFormulario("formSeleccionFacilitadorCarga","");
  $("#div_btn_facilitador_carga").html(div_boton);

  Accion = 'AniosFacilitadorCarga'; 
  $.ajax({
    url       : "Ajax.php",
    type      : "POST",
    datatype  : "json",
    async     : false, 
    data      : {MoS:MoS,NombreMoS:NombreMoS,Accion:Accion},    
    success   : function(data){
      $("#selectAniosFacilitadorCarga").html(data);
    }
  });
  selectAniosFacilitadorCarga = fecha_hoy.getFullYear();
  $("#selectAniosFacilitadorCarga").val(selectAniosFacilitadorCarga.toString());

  Accion='SemanasFacilitadorCarga'; 
  $.ajax({
    url: "Ajax.php",
    type: "POST",
    datatype:"json",    
    data: {MoS:MoS,NombreMoS:NombreMoS,Accion:Accion,elegidoC1:selectAniosFacilitadorCarga},    
    success: function(data){
      $("#selectSemanasFacilitadorCarga").html(data);
    }
  });

  ///:: JS COMBOS DEPENDIENTES ::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
  $("#selectAniosFacilitadorCarga").on('change', function () {
    div_boton = f_BotonesFormulario("formSeleccionFacilitadorCarga","");
    $("#div_btn_facilitador_carga").html(div_boton);
  
    $("#tablaFacilitadorCarga").dataTable().fnDestroy();
    $('#tablaFacilitadorCarga').hide();  
  });

  $("#selectSemanasFacilitadorCarga").on('change', function () {
    div_boton = f_BotonesFormulario("formSeleccionFacilitadorCarga","");
    $("#div_btn_facilitador_carga").html(div_boton);
  
    $("#tablaFacilitadorCarga").dataTable().fnDestroy();
    $('#tablaFacilitadorCarga').hide();  
  });

  $("#selectAniosFacilitadorCarga").on('change',function () {
    $("#selectAniosFacilitadorCarga option:selected").each(function () {
      elegidoC1=$(this).val();
      Accion='SemanasFacilitadorCarga'; 
      $.ajax({
        url: "Ajax.php",
        type: "POST",
        datatype:"json",    
        data: {MoS:MoS,NombreMoS:NombreMoS,Accion:Accion,elegidoC1:elegidoC1},    
        success: function(data){
          $("#selectSemanasFacilitadorCarga").html(data);
        }
      });
    });
  });

  ///:: BOTONES CARGA FACILITADOR :::::::::::::::::::::::::::::::::::::::::::::::::::::::::///

  ///:: JS DATA TABLE FacilitadorCarga ::::::::::::::::::::::::::::::::::::::::::::::::::::///
  $(document).on("click", ".btnBuscarFacilitador", function(){
    div_tablas = f_CreacionTabla("tablaFacilitadorCarga","AccionesFacilitadorCarga");
    $('#div_tablaFacilitadorCarga').html(div_tablas);
    columnastabla = f_ColumnasTabla("tablaFacilitadorCarga","defaultContentFacilitadorCarga");

    div_boton = f_BotonesFormulario("formSeleccionFacilitadorCarga","btnNuevoFacilitadorCarga");
    $("#div_btn_facilitador_carga").html(div_boton);

    SemanaFacilitadorCarga = $("#selectSemanasFacilitadorCarga").val();
    $("#tablaFacilitadorCarga").dataTable().fnDestroy();
    $('#tablaFacilitadorCarga').show();

    Accion='LeerFacilitadorCarga';
    tablaFacilitadorCarga = $('#tablaFacilitadorCarga').DataTable({
      language: idiomaEspanol,
      pageLength: 25,
      responsive: "true",
      dom: 'Blfrtip',
      buttons:
        [
          {
            extend    : 'excelHtml5',
            text      : '<i class="fas fa-file-excel"></i> ',
            titleAttr : 'Exportar a Excel',
            className : 'btn btn-success'
          },
        ],
      "ajax"      : {            
        "url"     : "Ajax.php", 
        "method"  : 'POST',
        "data"    : {MoS:MoS,NombreMoS:NombreMoS,Accion:Accion,Semana:SemanaFacilitadorCarga},
        "dataSrc" : ""
      },
      "columns"   : columnastabla,
      "order"     : [[1, 'asc']]
    });
  });
  ///:: FIN JS DATA TABLE FacilitadorCarga ::::::::::::::::::::::::::::::::::::::::::::::::///

  ///:: BOTON CARGAR -> REALIZA LA CARGA DE LA PROGRAMACION A CONTROL FACILITADOR :::::::::///
  $('#formFacilitadorCarga').submit(function(e){
    e.preventDefault(); //evita el comportambiento normal del submit, es decir, recarga total de la página
    CFaRg_FechaCargada = $('#CFaRg_FechaCargada').val();
    CFaRg_TipoOperacionCargada = $('#CFaRg_TipoOperacionCargada').val();
    SemanaFacilitadorCarga = $("#selectSemanasFacilitadorCarga").val();

    Accion='CrearFacilitadorCarga';
    $("#btnCargarFacilitador").prop("disabled",true);
    $.ajax({
      url: "Ajax.php",
      type: "POST",
      datatype:"json",    
      data:  { MoS:MoS,NombreMoS:NombreMoS,Accion:Accion,CFaRg_FechaCargada:CFaRg_FechaCargada,CFaRg_TipoOperacionCargada:CFaRg_TipoOperacionCargada,Semana:SemanaFacilitadorCarga },    
      beforeSend: function () {
        $("#div_ResultadoFacilitadorCarga").html("Procesando, espere por favor...<img src='Services/PlantillaTemplon/View/Img/loading5.gif' width='20' height='20'>");
      },
      success: function(data) {
        $("#div_ResultadoFacilitadorCarga").html(data);
        tablaFacilitadorCarga.ajax.reload(null, false);
        $("#btnCargarFacilitador").prop("disabled",false);
      }
    });
  });
  ///:: FIN BOTON CARGAR -> REALIZA LA CARGA DE LA PROGRAMACION A CONTROL FACILITADOR :::::///

  ///:: BOTON BORRAR REGISTRO FacilitadorCarga ::::::::::::::::::::::::::::::::::::::::::::///
  $(document).on("click", ".btnBorrarFacilitadorCarga", function(){
    fila = $(this);           
    CFaRg_Id = $(this).closest('tr').find('td:eq(0)').text();     
    CFaRg_FechaCargada = $(this).closest('tr').find('td:eq(1)').text();
    CFaRg_TipoOperacionCargada = $(this).closest('tr').find('td:eq(2)').text();
    CFaRg_Estado = $(this).closest('tr').find('td:eq(9)').text(); 

    respuesta = 0;
    opcion2 = 0;  

    if(CFaRg_Estado=='ELIMINADO')
    {
      Swal.fire({
        icon  : 'error',
        title : 'ELIMINAR...',
        text  : '*El registro ya se encuentra ELIMINADO!'
      })
    }else{
      if(CFaRg_Estado=='CERRADO'){
        Swal.fire({
          icon  : 'error',
          title : 'CERRADO...',
          text  : '*El registro se encuentra CERRADO!'
        })  
      }else{
        Swal.fire({
          title: '¿Está seguro?',
          text: "Se eliminara el registro "+CFaRg_Id+" | "+CFaRg_FechaCargada+" | "+CFaRg_TipoOperacionCargada+" y TODAS las novedades reportadas !",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Si, eliminar!'
        }).then((result) => 
        {
          if (result.isConfirmed)
            {
            Swal.fire(
              'Eliminado!',
              'El registro ha sido eliminado.',
              'success')
            respuesta = 1;
            // BORRAR REGISTRO DE PROGRAMACION REGISTRO CARGA CAMBIAR ESTADO ELIMINADO
            if (respuesta = 1)
            {            
              Accion='BorrarFacilitadorCarga';
              $.ajax({
                url       : "Ajax.php",
                type      : "POST",
                datatype  : "json",    
                data: { MoS:MoS, NombreMoS:NombreMoS, Accion:Accion, CFaRg_Id:CFaRg_Id},   
                success: function() {
                  tablaFacilitadorCarga.ajax.reload(null, false);
                }
              });
            
              opcion2 = 1;

              if(opcion2 = 1)
              {
                // BORRAR DETALLE DEL CONTROL FACILITADOR 
                Accion='BorrarDetalleFacilitador'; 
                $.ajax({
                  url: "Ajax.php",
                  type: "POST",
                  datatype:"json",    
                  data: {MoS:MoS, NombreMoS:NombreMoS, Accion:Accion, CFaRg_Id:CFaRg_Id, CFaRg_FechaCargada:CFaRg_FechaCargada},    
                  success: function(){
                    //tablaFacilitadorCarga.ajax.reload(null, false);
                  }
                });
              
                // BORRAR NOVEDADES
                Accion='BorrarNovedadCarga'; 
                $.ajax({
                  url: "Ajax.php",
                  type: "POST",
                  datatype:"json",    
                  data: {MoS:MoS,NombreMoS:NombreMoS,Accion:Accion,CFaRg_Id:CFaRg_Id},    
                  success: function(){
                  
                  }
                });

                // BORRAR CONTROL DE CAMBIOS DE NOVEDAD
                Accion='BorrarControlCambiosNovedad'; 
                $.ajax({
                  url: "Ajax.php",
                  type: "POST",
                  datatype:"json",    
                  data: {MoS:MoS,NombreMoS:NombreMoS,Accion:Accion,CFaRg_Id:CFaRg_Id},    
                  success: function(){
                  
                  }
                });
              
              }
            }
          }
        });  
      }
    }
  });
  ///:: FIN BOTON BORRAR REGISTRO FacilitadorCarga ::::::::::::::::::::::::::::::::::::::::///
    
  ///:: BOTON CERRAR REGISTRO FacilitadorCarga ::::::::::::::::::::::::::::::::::::::::::::///
  $(document).on("click", ".btnCerrarFacilitadorCarga", function(){
    fila = $(this);           
    CFaRg_Id                    = $(this).closest('tr').find('td:eq(0)').text();     
    CFaRg_FechaCargada          = $(this).closest('tr').find('td:eq(1)').text();
    CFaRg_TipoOperacionCargada  = $(this).closest('tr').find('td:eq(2)').text();
    CFaRg_Estado                = $(this).closest('tr').find('td:eq(9)').text();
    xFechaOperacion             = CFaRg_FechaCargada.substring(0,4)+'-'+CFaRg_FechaCargada.substring(5,7)+'-'+CFaRg_FechaCargada.substring(8,10);
    let xInconsistenciasOperacion;
    let respuestaCerrar   = 0;
    let novedad_pendiente = ""; 

    if(CFaRg_Estado=='GENERADO') {
      //novedad_pendiente = f_buscar_dato("OPE_Novedad","Nove_Estado","`Nove_Estado`='PENDIENTE' AND `Nove_CFaRgId`='"+CFaRg_Id+"'");
      novedad_pendiente = f_buscar_dato("OPE_Novedad","Nove_Estado","`Nove_Estado`='PENDIENTE' AND `Nove_FechaOperacion`='"+xFechaOperacion+"'");
      if(novedad_pendiente == 'PENDIENTE'){
        respuestaCerrar = 1;
        Swal.fire({
          icon  : 'error',
          title : 'NOVEDADES PENDIENTES...',
          text  : '*Solo se pueden cerrar las operaciones que no tengan Novedades Pendientes!'
        });  
      }
      //xInconsistenciasOperacion = fInconsistenciasControlFacilitador(xFechaOperacion,CFaRg_TipoOperacionCargada);
      let xInconsistenciasOperacion_Troncal = fInconsistenciasControlFacilitador(xFechaOperacion,'TRONCAL');
      let xInconsistenciasOperacion_Alimentador = fInconsistenciasControlFacilitador(xFechaOperacion,'ALIMENTADOR');
      if(xInconsistenciasOperacion_Troncal.length > 0 || xInconsistenciasOperacion_Alimentador.length > 0) {
        respuestaCerrar = 1;
        Swal.fire({
          icon  : 'error',
          title : 'INCONSISTENCIAS...',
          text  : '*Solo se pueden cerrar las operaciones que no tengan INCONSISTENCIAS!'
        });  
      }
      if(respuestaCerrar == 0){
        Swal.fire({
          title             : '¿Está seguro?',
          text              : "Se cerrará el registro "+CFaRg_Id+" | "+CFaRg_FechaCargada+" | "+CFaRg_TipoOperacionCargada+" !",
          icon              : 'warning',
          showCancelButton  : true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor : '#d33',
          confirmButtonText : 'Si, Cerrar!'
        }).then((result) => {
          if (result.isConfirmed) {
              Swal.fire(
                  'Cerrado!',
                  'El registro ha sido cerrado.',
                  'success'
              )
              Accion = 'CerrarFacilitadorCarga';
              respuesta = 1;
              if (respuesta=1) {            
                $.ajax({
                  url     : "Ajax.php",
                  type    : "POST",
                  datatype: "json",    
                  data    : { MoS:MoS, NombreMoS:NombreMoS, Accion:Accion, CFaRg_Id:CFaRg_Id, CFaRg_FechaCargada:CFaRg_FechaCargada, CFaRg_TipoOperacionCargada:CFaRg_TipoOperacionCargada},
                  success : function() {
                    tablaFacilitadorCarga.ajax.reload(null, false);
                  }
                });
              }
          }
        });
      }
    }else{
      Swal.fire({
        icon: 'error',
        title: 'CERRAR...',
        text: '*Solo se pueden cerrar las operaciones GENERADAS!'
      })
    }
  });
  ///:: FIN BOTON CERRAR REGISTRO FacilitadorCarga ::::::::::::::::::::::::::::::::::::::::///

  ///:: BOTON NUEVO -> CARGA FORMULARIO NUEVO CONTROL FACILITADOR :::::::::::::::::::::::::///
  $(document).on("click", ".btnNuevoFacilitadorCarga", function(){
    Opcion = 0;
    $("#div_ResultadoFacilitadorCarga").empty();
    $("#formFacilitadorCarga").trigger("reset");
    $(".modal-header").css( "background-color", "#17a2b8");
    $(".modal-header").css( "color", "white" );
    $(".modal-title").text("Generar Nuevo Facilitador");
    $('#modalCRUDFacilitadorCarga').modal('show');	    
  });
  ///:: FIN BOTON NUEVO -> CARGA FORMULARIO NUEVO CONTROL FACILITADOR :::::::::::::::::::::///
  
  $("#CFaRg_FechaCargada").click(function(){
    $("#div_ResultadoFacilitadorCarga").empty();
  });
  
  $("#CFaRg_TipoOperacionCargada").click(function(){
    $("#div_ResultadoFacilitadorCarga").empty();
  });
  
});