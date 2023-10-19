///::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
///:: NOVEDAD CARGA v 1.0 FECHA: 2023-08-02 :::::::::::::::::::::::::::::::::::::::::::::::///
///:: CREAR, ELIMINAR Y MOSTRAR LA CARGA DE NOVEDADES DE PILOTOS ::::::::::::::::::::::::::///
///::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///

///:: DECLARACION DE VARIABLES ::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
var anio_novedad_carga, tabla_novedad_carga;

///::::::::::::::::::::::::: JS DOM PROGRAMACION CARGA ::::::::::::::::::::::::::::::::::::///
$(document).ready(function(){
  let select_html="";
  div_boton = f_BotonesFormulario("form_seleccion_novedad_carga","btn_novedad_carga");
  $("#div_btn_novedad_carga").html(div_boton);
  select_html = f_select_combo("Calendario","SI","Calendario_Anio","","`Calendario_Anio`>'2022'","Calendario_Anio");
  $("#select_anio_novedad_carga").html(select_html);
  $("#select_anio_novedad_carga").val(anio_actual_novedades);

  ///:: LIMPIA EL DIV DE RESULTADO ::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
  $("#file_novedad_carga").click(function(){
    $("#div_resultado_novedad_carga").empty();
  });

  ///:: COLOCA EL NOMBRE DEL ARCHIVO EN EL INPUT FILE :::::::::::::::::::::::::::::::::::::///
  $(document).on('change', '#file_novedad_carga', function (event) {
    let NombreArch = event.target.files[0].name;
    // let Extension = NombreArch.split('.').pop();
    $("#label_novedad_carga").text(NombreArch);
  }); 


  ///:: BOTONES NOVEDAD CARGA :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
  
  //:: BOTON NUEVO CARGA DE NOVEDADES :::::::::::::::::::::::::::::::::::::::::::::::::::::///
  $(document).on("click", ".btn_nuevo_novedad_carga", function(){
    $("#div_resultado_novedad_carga").empty();
    $("#label_novedad_carga").text("Seleccionar Archivo .csv o .xlsx");
    $("#form_novedad_carga").trigger("reset");
    $(".modal-header").css( "background-color", "#17a2b8");
    $(".modal-header").css( "color", "white" );
    $(".modal-title").text("Nueva Carga");
    $('#modal_crud_novedad_carga').modal('show');	    
  });
  //:: FIN BOTON NUEVO CARGA DE NOVEDADES :::::::::::::::::::::::::::::::::::::::::::::::::///

  ///:: BOTON BUSCAR NOVEDAD CARGA ::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
  $(document).on("click", ".btn_buscar_novedad_carga", function(){
    anio_novedad_carga = $("#select_anio_novedad_carga").val();

    div_tabla = f_CreacionTabla("tabla_novedad_carga","");
    $("#div_tabla_novedad_carga").html(div_tabla);
    columnas_tabla = f_ColumnasTabla("tabla_novedad_carga","");

    $("#tabla_novedad_carga").dataTable().fnDestroy();
    $('#tabla_novedad_carga').show();
    Accion = 'leer_novedad_carga';  
    tabla_novedad_carga = $('#tabla_novedad_carga').DataTable({
      language        : idiomaEspanol,
      responsive      : "true",
      dom             : 'Blfrtip', 
      pageLength      : 25,
      select          : {style: 'os'},
      buttons:
      [
        {
          extend      : 'excelHtml5',
          text        : '<i class="fas fa-file-excel"></i> ',
          titleAttr   : 'Exportar a Excel',
          className   : 'btn btn-success',
          title       : 'REGISTRO NOVEDAD CARGA'
        },
      ],
      "ajax":
      {            
        "url": "Ajax.php", 
        "method": 'POST', //usamos el metodo POST
        "data":{MoS:MoS, NombreMoS:NombreMoS, Accion:Accion, anio:anio_novedad_carga}, //enviamos opcion 4 para que haga un SELECT
        "dataSrc":""
      },
      "columns": columnas_tabla,
      "order": [1, 'desc']
    });
  });
  ///:: FIN BOTON BUSCAR NOVEDAD CARGA ::::::::::::::::::::::::::::::::::::::::::::::::::::///

  ///:: BOTON CARGAR -> REALIZA LA CARGA DE LAS NOVEDADES :::::::::::::::::::::::::::::::::///
  $('#form_novedad_carga').submit(function(e){
    e.preventDefault(); //evita el comportambiento normal del submit, es decir, recarga total de la página
    let opcion_novedad_carga = "";
    let excel = document.getElementById('file_novedad_carga').value;
    anio_novedad_carga = $("#select_anio_novedad_carga").val();
    $("#div_resultado_novedad_carga").empty();

    if(excel.length==0){
      opcion_novedad_carga = "invalido";
    }

    // Objeto FormData para enviar datos de al formulario   
    let formUsuarios = new FormData(); 
    let filesexcel = $("#file_novedad_carga")[0].files[0]; 
    formUsuarios.append('archivoexcel',filesexcel);
    formUsuarios.append('MoS',MoS);
    formUsuarios.append('NombreMoS',NombreMoS);
    formUsuarios.append('Accion','crear_novedad_carga');
    formUsuarios.append('anio',anio_novedad_carga);
  
    if(opcion_novedad_carga == ""){
      $("#bnt_cargar_novedad").prop("disabled",true);
      $.ajax({
        url         : "Ajax.php",
        type        : "POST",
        data        : formUsuarios,
        contentType : false,
        processData : false,
        beforeSend  : function () {
          $("#div_resultado_novedad_carga").html("Procesando, espere por favor...<img src='Services/PlantillaTemplon/View/Img/loading5.gif' width='20' height='20'>");
        },
        success:function(resp){
          $("#div_resultado_novedad_carga").html(resp);
          tabla_novedad_carga.ajax.reload(null, false);
          $("#bnt_cargar_novedad").prop("disabled",false);
        },
      });
    }else{
      Swal.fire({
        icon: 'error',
        title: 'Archivo Excel...',
        text: '*Requiere archivo .cvs o .xlsx!'
      })
    }
  });
  ///:: FIN BOTON CARGAR -> REALIZA LA CARGA DE LAS NOVEDADES :::::::::::::::::::::::::::::///

  ///:: BOTON BORRAR REGISTRO NOVEDAD CARGA :::::::::::::::::::::::::::::::::::::::::::::::///
  $(document).on("click", ".btn_borrar_novedad_carga", function(){
    let fila_novedad_carga = $(this).closest('tr');           
    noco_codigo_carga = fila_novedad_carga.find('td:eq(0)').text();

        Swal.fire({
          title : '¿Está seguro?',
          text  : "Se eliminara el registro "+noco_codigo_carga+" !!!",
          icon  : 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Si, eliminar!'
        }).then((result) => {
          if(result.isConfirmed)
          {
            Swal.fire(
                'Eliminado!',
                'El registro ha sido eliminado.',
                'success'
            )
              Accion='borrar_novedad_carga';
              $.ajax({
                url     : "Ajax.php",
                type    : "POST",
                datatype: "json",    
                data    : { MoS:MoS,NombreMoS:NombreMoS,Accion:Accion,noco_codigo_carga:noco_codigo_carga},   
                success : function() {
                  tabla_novedad_carga.ajax.reload(null, false);
                }
              });
          }
        });
  });
  ///:: BOTON BORRAR REGISTRO NOVEDAD CARGA :::::::::::::::::::::::::::::::::::::::::::::::///

  ///:: TERMINO BOTONES NOVEDAD CARGA :::::::::::::::::::::::::::::::::::::::::::::::::::::///


});
///:: TERMINO JS DOM NOVEDAD CARGA ::::::::::::::::::::::::::::::::::::::::::::::::::::::::///