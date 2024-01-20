///::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
///:: TAB GENERAR NOMINA A JSON v 1.0 2024-01-19 ::::::::::::::::::::::::::::::::::::::::::///
///:: CREAR Y ELIMINAR CARGA DE NOMINA A JSON :::::::::::::::::::::::::::::::::::::::::::::///
///::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///

///:: DECLARACION DE VARIABLES ::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
var anio_generar_nomina, select_carga_nomina, fecha_hoy;
var ncar_anio, ncar_periodo, ncar_tipo, ncar_archivo, ncar_fecha_inicio, ncar_fecha_termino;
///:: JS DOM GENERAR NOMINA A JSON ::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
$(document).ready(function(){
  fecha_hoy = f_CalculoFecha("hoy","0");
  anio_generar_nomina = fecha_hoy.substring(0,4);
  select_carga_nomina = f_select_combo("Calendario", "SI", "Calendario_Anio", "", "`Calendario_Anio`>'2022'", "`Calendario_Anio` DESC");
  $("#anio_generar_nomina").html(select_carga_nomina);
  $("#anio_generar_nomina").val(anio_generar_nomina);

  $("#anio_generar_nomina").on('change', function () {
    $("#div_tabla_generar_nomina").empty();
    $("#tabla_generar_nomina").dataTable().fnDestroy();
    $('#tabla_generar_nomina').hide();  
  });

  $("#ncar_anio, #ncar_periodo, #ncar_tipo").on('change', function () {
    let n_periodo = "", n_tipo = "";
    ncar_anio = $("#ncar_anio").val();
    ncar_periodo = $("#ncar_periodo").val();
    switch (ncar_periodo) {
      case "ENERO":
        n_periodo = "01";
      break;
      case "FEBRERO":
        n_periodo = "02"; 
      break;
      case "MARZO":
        n_periodo = "03";
      break;
      case "ABRIL":
        n_periodo = "04";
      break;
      case "MAYO":
        n_periodo = "05";
      break;
      case "JUNIO":
        n_periodo = "06";
      break;
      case "JULIO":
        n_periodo = "07";
      break;
      case "AGOSTO":
        n_periodo = "08";
      break;
      case "SETIEMBRE":
        n_periodo = "09";
      break;
      case "OCTUBRE":
        n_periodo = "10";
      break;
      case "NOVIEMBRE":
        n_periodo = "11";
      break;
      case "DICIEMBRE":
        n_periodo = "12";
      break;
    }
    ncar_tipo = $("#ncar_tipo").val();
    switch (ncar_tipo) {
      case "PROGRAMACION":
        n_tipo = "01";
      break;
      case "OPERACION":
        n_tipo = "02";
      break;
    }
    ncar_archivo = ncar_anio+"_M"+n_periodo+"_T"+n_tipo+"_+id.json";
    $("#ncar_archivo").val(ncar_archivo);
  });
  ///:: BOTONES GENERAR NOMINA A JSON :::::::::::::::::::::::::::::::::::::::::::::::::::::///

  ///:: JS BUSCAR GENERAR NOMINA A JSON :::::::::::::::::::::::::::::::::::::::::::::::::::///
  $(document).on("click", ".btn_buscar_generar_nomina", function(){
    div_tablas = f_CreacionTabla("tabla_generar_nomina","");
    $('#div_tabla_generar_nomina').html(div_tablas);
    columnas_tabla = f_ColumnasTabla("tabla_generar_nomina","");

    anio_generar_nomina = $("#anio_generar_nomina").val();
    $("#tabla_generar_nomina").dataTable().fnDestroy();
    $('#tabla_generar_nomina').show();

    Accion = 'leer_generar_nomina';
    tabla_generar_nomina = $('#tabla_generar_nomina').DataTable({
      language    : idioma_espanol,
      pageLength  : 25,
      responsive  : "true",
      dom         : 'Blfrtip',
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
        "data"    : { MoS:MoS, NombreMoS:NombreMoS, Accion:Accion, ncar_anio:anio_generar_nomina},
        "dataSrc" : ""
      },
      "columns"   : columnas_tabla,
      "order"     : [[4, 'desc']]
    });
  });
  ///:: FIN JS BUSCAR GENERAR NOMINA A JSON :::::::::::::::::::::::::::::::::::::::::::::::///

  ///:: BOTON CARGAR -> REALIZA LA CARGA DE LA NOMINA A JSON ::::::::::::::::::::::::::::::///
  $('#form_generar_nomina').submit(function(e){
    e.preventDefault(); //evita el comportambiento normal del submit, es decir, recarga total de la página
    ncar_anio = $('#ncar_anio').val();
    ncar_periodo = $('#ncar_periodo').val();
    ncar_tipo = $("#ncar_tipo").val();
    ncar_fecha_inicio = $('#ncar_fecha_inicio').val();
    ncar_fecha_termino = $('#ncar_fecha_termino').val();

    Accion = 'generar_nomina';
    $("#btn_generar_nomina").prop("disabled",true);
    $.ajax({
      url     : "Ajax.php",
      type    : "POST",
      datatype: "json",    
      data    : { MoS:MoS, NombreMoS:NombreMoS, Accion:Accion, ncar_anio:ncar_anio, ncar_periodo:ncar_periodo, ncar_tipo:ncar_tipo, ncar_fecha_inicio:ncar_fecha_inicio, ncar_fecha_termino:ncar_fecha_termino },    
      beforeSend: function () {

      },
      success: function(data) {

        tabla_generar_nomina.ajax.reload(null, false);
        $("#btn_generar_nomina").prop("disabled",false);
        $('#modal_crud_generar_nomina').modal('hide');
      }
    });
  });
  ///:: FIN BOTON CARGAR -> REALIZA LA CARGA DE LA NOMINA A JSON ::::::::::::::::::::::::::///

  ///:: BOTON BORRAR REGISTRO generar_nomina ::::::::::::::::::::::::::::::::::::::::::::///
  $(document).on("click", ".btn_borrar_generar_nomina", function(){
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
              Accion='Borrargenerar_nomina';
              $.ajax({
                url       : "Ajax.php",
                type      : "POST",
                datatype  : "json",    
                data: { MoS:MoS, NombreMoS:NombreMoS, Accion:Accion, CFaRg_Id:CFaRg_Id},   
                success: function() {
                  tablagenerar_nomina.ajax.reload(null, false);
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
                    //tablagenerar_nomina.ajax.reload(null, false);
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
  ///:: FIN BOTON BORRAR REGISTRO generar_nomina ::::::::::::::::::::::::::::::::::::::::///
    
  ///:: BOTON NUEVO -> CARGA FORMULARIO NUEVO NOMINA ::::::::::::::::::::::::::::::::::::::///
  $(document).on("click", ".btn_agregar_nomina", function(){
    $("#form_generar_nomina").trigger("reset");

    select_carga_nomina = f_select_combo("Calendario", "SI", "Calendario_Anio", "", "`Calendario_Anio`>'2022'", "`Calendario_Anio` DESC");
    $("#ncar_anio").html(select_carga_nomina);
    ncar_anio = fecha_hoy.substring(0,4);
    $("#ncar_anio").val(ncar_anio);

    n_mes = fecha_hoy.substring(5,7);
    switch (n_mes) {
      case "01":
        n_mes = "ENERO";
      break;
      case "02":
        n_mes = "FEBRERO";
      break;
      case "03":
        n_mes = "MARZO";
      break;
      case "04":
        n_mes = "ABRIL";
      break;
      case "05":
        n_mes = "MAYO";
      break;
      case "06":
        n_mes = "JUNIO";
      break;
      case "07":
        n_mes = "JULIO";
      break;
      case "08":
        n_mes = "AGOSTO";
      break;
      case "09":
        n_mes = "SEPTIEMBRE";
      break;
      case "10":
        n_mes = "OCTUBRE";
      break;
      case "11":
        n_mes = "NOVIEMBRE";
      break;
      case "12":
        n_mes = "DICIEMBRE";
      break;
    }
    $("#ncar_periodo").val(n_mes);

    $(".modal-header").css( "background-color", "#17a2b8");
    $(".modal-header").css( "color", "white" );
    $(".modal-title").text("Generar Nómina");
    $('#modal_crud_generar_nomina').modal('show');	    
  });
  ///:: FIN BOTON NUEVO -> CARGA FORMULARIO NUEVO NOMINA ::::::::::::::::::::::::::::::::::///
  
  ///:: TERMINO BOTONES CARGA NOMINA A JSON :::::::::::::::::::::::::::::::::::::::::::::::///

});
///:: TERMINO JS DOM CARGA NOMINA A JSON ::::::::::::::::::::::::::::::::::::::::::::::::::///