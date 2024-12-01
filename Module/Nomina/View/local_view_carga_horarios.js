///::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
///:: TAB GENERAR NOMINA A JSON v 1.0 2024-01-19 ::::::::::::::::::::::::::::::::::::::::::///
///:: CREAR Y ELIMINAR CARGA DE NOMINA A JSON :::::::::::::::::::::::::::::::::::::::::::::///
///::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///

///:: DECLARACION DE VARIABLES ::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
var anio_carga_horarios_nomina, select_carga_horarios_nomina, fecha_hoy;
var chn_fecha, chn_operacion;
///:: JS DOM GENERAR NOMINA A JSON ::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
$(document).ready(function(){
  fecha_hoy = f_CalculoFecha("hoy","0");
  anio_carga_horarios_nomina = fecha_hoy.substring(0,4);
  select_carga_horarios_nomina = f_select_combo("Calendario", "SI", "Calendario_Anio", "", "`Calendario_Anio`>'2020'", "`Calendario_Anio` DESC");
  $("#anio_carga_horarios_nomina").html(select_carga_horarios_nomina);
  $("#anio_carga_horarios_nomina").val(anio_carga_horarios_nomina);

  $("#anio_carga_horarios_nomina").on('change', function () {
    $("#div_tabla_carga_horarios_nomina").empty();
    $("#tabla_carga_horarios_nomina").dataTable().fnDestroy();
    $('#tabla_carga_horarios_nomina').hide();  
  });

  ///:: BOTONES GENERAR NOMINA A JSON :::::::::::::::::::::::::::::::::::::::::::::::::::::///

  ///:: JS BUSCAR GENERAR NOMINA A JSON :::::::::::::::::::::::::::::::::::::::::::::::::::///
  $(document).on("click", ".btn_buscar_carga_horarios_nomina", function(){
    div_tablas = f_CreacionTabla("tabla_carga_horarios_nomina","");
    $('#div_tabla_carga_horarios_nomina').html(div_tablas);
    columnas_tabla = f_ColumnasTabla("tabla_carga_horarios_nomina","");

    anio_carga_horarios_nomina = $("#anio_carga_horarios_nomina").val();
    $("#tabla_carga_horarios_nomina").dataTable().fnDestroy();
    $('#tabla_carga_horarios_nomina').show();

    Accion = 'leer_carga_horarios_nomina';
    tabla_carga_horarios_nomina = $('#tabla_carga_horarios_nomina').DataTable({
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
        "data"    : { MoS:MoS, NombreMoS:NombreMoS, Accion:Accion, chn_anio:anio_carga_horarios_nomina},
        "dataSrc" : ""
      },
      "columns"   : columnas_tabla,
      "order"     : [4, 'desc']
    });
  });
  ///:: FIN JS BUSCAR GENERAR NOMINA A JSON :::::::::::::::::::::::::::::::::::::::::::::::///

  ///:: BOTON CARGAR -> REALIZA LA CARGA DE LA NOMINA A JSON ::::::::::::::::::::::::::::::///
  $('#form_carga_horarios_nomina').submit(function(e){
    e.preventDefault();
    chn_operacion = $("#chn_operacion").val();
    chn_fecha = $('#chn_fecha').val();
    chn_estado = "GENERADO";
    
    let existe_horario = "";
    existe_horario = f_buscar_dato("ope_horarios_nomina_carga", "id", "`hnc_operacion`='"+chn_operacion+"' AND `hnc_fecha`='"+chn_fecha+"' AND `hnc_estado`='"+chn_estado+"'" );
    
    if(existe_horario!=""){
      Swal.fire({
        icon  : 'error',
        title : 'GENERAR HORARIOS PARA NOMINA...',
        text  : '*Los horarios ya se encuentra generados!'
      })
    }else{
      Accion = 'generar_horarios_nomina';
      $("#btn_generar_horarios_nomina").prop("disabled",true);
      $.ajax({
        url     : "Ajax.php",
        type    : "POST",
        datatype: "html",    
        data    : { MoS:MoS, NombreMoS:NombreMoS, Accion:Accion, chn_fecha:chn_fecha, chn_operacion:chn_operacion },    
        beforeSend: function () {
          Swal.fire({
            icon: "info",
            title: "Procesando Información!",
            showConfirmButton: false,
            timer: 3000
          });  
        },
        success: function(data) {
          if(data.substring(0,1)=="E"){
            alert(data);
          }else{
            Swal.fire({
              icon              : 'success',
              title             : data,
              showConfirmButton : false,
              timer             : 2000
            })  
          }
          tabla_carga_horarios_nomina.ajax.reload(null, false);
          $("#btn_generar_horarios_nomina").prop("disabled",false);
          $('#modal_crud_generar_horarios_nomina').modal('hide');
        }
      });  
    }
  });
  ///:: FIN BOTON CARGAR -> REALIZA LA CARGA DE LA NOMINA A JSON ::::::::::::::::::::::::::///

  ///:: BOTON BORRAR REGISTRO generar_nomina ::::::::::::::::::::::::::::::::::::::::::::///
  $(document).on("click", ".btn_borrar_generar_horarios_nomina", function(){
    let fila_carga_horarios_nomina = $(this).closest('tr');           
    horarios_nomina_carga_id = fila_carga_horarios_nomina.find('td:eq(0)').text();     
    chn_anio = fila_carga_horarios_nomina.find('td:eq(1)').text();
    chn_periodo = fila_carga_horarios_nomina.find('td:eq(2)').text();
    chn_estado = fila_carga_horarios_nomina.find('td:eq(10)').text();

    if(chn_estado=='ANULADO'){
      Swal.fire({
        icon  : 'error',
        title : 'ANULAR...',
        text  : '*El registro ya se encuentra ANULADO!'
      })
    }else{
      Swal.fire({
        title       : '¿Está seguro?',
        text        : "Se anulará el registro ID "+horarios_nomina_carga_id+" del "+chn_anio+"_"+chn_periodo+" !",
        icon        : 'warning',
        showCancelButton  : true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor : '#d33',
        confirmButtonText : 'Si, anular!',
        cancelButtonText  : 'Cancelar'
        }).then((result) => 
        {
          if (result.isConfirmed){
            Accion = 'borrar_generar_horarios_nomina';
            $.ajax({
              url       : "Ajax.php",
              type      : "POST",
              datatype  : "json",    
              data: { MoS:MoS, NombreMoS:NombreMoS, Accion:Accion, horarios_nomina_carga_id:horarios_nomina_carga_id },   
              success: function() {
                Swal.fire(
                  'Anulado!',
                  'El registro ha sido anulado.',
                  'success')
                tabla_carga_horarios_nomina.ajax.reload(null, false);
              }
            });
          }
        });  
    }
  });
  ///:: FIN BOTON BORRAR REGISTRO generar_nomina ::::::::::::::::::::::::::::::::::::::::///
    
  ///:: BOTON NUEVO -> CARGA FORMULARIO NUEVO NOMINA ::::::::::::::::::::::::::::::::::::::///
  $(document).on("click", ".btn_agregar_carga_horarios_nomina", function(){
    $("#form_carga_horarios_nomina").trigger("reset");
    chn_fecha = f_CalculoFecha("hoy","0");
    $("#chn_fecha").val(chn_fecha);

    $(".modal-header").css( "background-color", "#17a2b8");
    $(".modal-header").css( "color", "white" );
    $(".modal-title").text("Generar Horarios Nómina");
    $('#modal_crud_generar_horarios_nomina').modal('show');	    
  });
  ///:: FIN BOTON NUEVO -> CARGA FORMULARIO NUEVO NOMINA ::::::::::::::::::::::::::::::::::///
  
  ///:: TERMINO BOTONES CARGA NOMINA A JSON :::::::::::::::::::::::::::::::::::::::::::::::///

});
///:: TERMINO JS DOM CARGA NOMINA A JSON ::::::::::::::::::::::::::::::::::::::::::::::::::///