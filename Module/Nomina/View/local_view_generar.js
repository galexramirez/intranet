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
  select_carga_nomina = f_select_combo("Calendario", "SI", "Calendario_Anio", "", "`Calendario_Anio`>'2020'", "`Calendario_Anio` DESC");
  $("#anio_generar_nomina").html(select_carga_nomina);
  $("#anio_generar_nomina").val(anio_generar_nomina);

  $("#anio_generar_nomina").on('change', function () {
    $("#div_tabla_generar_nomina").empty();
    $("#tabla_generar_nomina").dataTable().fnDestroy();
    $('#tabla_generar_nomina').hide();  
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
      "order"     : [[5, 'desc']]
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
    
    let existe_nomina = "";
    existe_nomina = f_buscar_dato("ope_nomina_carga", "nomina_carga_id", "`ncar_anio`='"+ncar_anio+"' AND `ncar_periodo`='"+ncar_periodo+"' AND `ncar_tipo`='"+ncar_tipo+"' AND `ncar_estado`='GENERADO'" );
    
    if(existe_nomina!=""){
      Swal.fire({
        icon  : 'error',
        title : 'GENERAR NOMINA...',
        text  : '*La nómina ya se encuentra generada!'
      })
    }else{
      Accion = 'generar_nomina';
      $("#btn_generar_nomina").prop("disabled",true);
      $.ajax({
        url     : "Ajax.php",
        type    : "POST",
        datatype: "json",    
        data    : { MoS:MoS, NombreMoS:NombreMoS, Accion:Accion, ncar_anio:ncar_anio, ncar_periodo:ncar_periodo, ncar_tipo:ncar_tipo, ncar_fecha_inicio:ncar_fecha_inicio, ncar_fecha_termino:ncar_fecha_termino },    
        beforeSend: function () {
          Swal.fire({
            position: "top-end",
            icon: "info",
            title: "Procesando Información!",
            showConfirmButton: false,
            timer: 3000
          });  
        },
        success: function(data) {
          Swal.fire({
            icon              : 'success',
            title             : data,
            showConfirmButton : false,
            timer             : 2000
          })
          tabla_generar_nomina.ajax.reload(null, false);
          $("#btn_generar_nomina").prop("disabled",false);
          $('#modal_crud_generar_nomina').modal('hide');
        }
      });  
    }
  });
  ///:: FIN BOTON CARGAR -> REALIZA LA CARGA DE LA NOMINA A JSON ::::::::::::::::::::::::::///

  ///:: BOTON BORRAR REGISTRO generar_nomina ::::::::::::::::::::::::::::::::::::::::::::///
  $(document).on("click", ".btn_borrar_generar_nomina", function(){
    let fila_generar_nomina = $(this).closest('tr');           
    nomina_carga_id = fila_generar_nomina.find('td:eq(0)').text();     
    ncar_anio = fila_generar_nomina.find('td:eq(1)').text();
    ncar_periodo = fila_generar_nomina.find('td:eq(2)').text();
    ncar_estado = fila_generar_nomina.find('td:eq(11)').text();

    if(ncar_estado=='ANULADO'){
      Swal.fire({
        icon  : 'error',
        title : 'ANULAR...',
        text  : '*El registro ya se encuentra ANULADO!'
      })
    }else{
      Swal.fire({
        title       : '¿Está seguro?',
        text        : "Se anulará el registro ID "+nomina_carga_id+" del "+ncar_anio+"_"+ncar_periodo+" !",
        icon        : 'warning',
        showCancelButton  : true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor : '#d33',
        confirmButtonText : 'Si, anular!',
        cancelButtonText  : 'Cancelar'
        }).then((result) => 
        {
          if (result.isConfirmed){
            Accion = 'borrar_generar_nomina';
            $.ajax({
              url       : "Ajax.php",
              type      : "POST",
              datatype  : "json",    
              data: { MoS:MoS, NombreMoS:NombreMoS, Accion:Accion, nomina_carga_id:nomina_carga_id },   
              success: function() {
                Swal.fire(
                  'Anulado!',
                  'El registro ha sido anulado.',
                  'success')
                tabla_generar_nomina.ajax.reload(null, false);
              }
            });
          }
        });  
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

    let n_mes = "";
    let t_mes = fecha_hoy.substring(5,7);
    switch (t_mes) {
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