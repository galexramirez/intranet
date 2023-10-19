///::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
///::::::::::::::::::: PUBLICACION CARGA v 6.0 FECHA: 20-01-2023 ::::::::::::::::::::::::::///
/// CREAR, ELIMINAR Y MOSTRAR LA PUBLICACION WEB PROGRAMACION DE PILOTOS Y BUSES ::::::::::///
///::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///

///::::::::::::::::::::::::::::::: Declaracion de Variables :::::::::::::::::::::::::::::::///
var AniosPublicados, miCarpeta;    
miCarpeta = f_DocumentRoot();

///::::::::::::::::::::::::: JS DOM PUBLICACION CARGA :::::::::::::::::::::::::::::::::::::///
$(document).ready(function(){
  div_boton = f_BotonesFormulario("formSeleccionPublicacionCarga","btn-PublicacionCarga");
  $("#div_btn-PublicacionCarga").html(div_boton);

  $('#btnNuevoPublicacionCarga').hide();
  $('#tablaPublicacionCarga').hide();

  ///:::::::::::::::::: SELECCION DE AÑOS :::::::::::::::::::::::::::::::::::::::::::::::::///
  $("#selectAniosPublicacionCarga").on('change', function () {
    $("#tablaPublicacionCarga").dataTable().fnDestroy();
    $('#tablaPublicacionCarga').hide();
    $('#btnNuevoPublicacionCarga').hide();
  });

  $("#selectSemanasPublicacionCarga").click(function(){
    $("#div_ResultadoPublicacionCarga").empty();
  });

  ///:::::::::::::::::::::: BOTONES DE PUBLICACION CARGA ::::::::::::::::::::::::::::::::::///

  ///:: BOTON BUSCAR PUBLICACIONES -> LLENA TABLA DE PUBLICACIONES ::::::::::::::::::::::::///
  $("#btnBuscarPublicaciones").on("click",function(){
    div_tabla = f_CreacionTabla("tablaPublicacionCarga","");
    $("#div_tablaPublicacionCarga").html(div_tabla);
    columnastabla = f_ColumnasTabla("tablaPublicacionCarga","");

    AniosPublicados = $("#selectAniosPublicacionCarga").val();
    $("#tablaPublicacionCarga").dataTable().fnDestroy();
    $('#tablaPublicacionCarga').show();
    $('#btnNuevoPublicacionCarga').show();

    Accion='LeerPublicacionCarga';
    tablaPublicacionCarga = $('#tablaPublicacionCarga').DataTable({
      language: idiomaEspanol,
      order: [[ 0, "desc" ]],
      responsive: "true",
      dom: 'Blfrtip', // Con Botones Excel,Pdf,Print
      buttons:[
                {
                  extend:     'excelHtml5',
                  text:       '<i class="fas fa-file-excel"></i> ',
                  titleAttr:  'Exportar a Excel',
                  className:  'btn btn-success'
                },
              ],
      "ajax":{            
        "url": "Ajax.php", 
        "method": 'POST', //usamos el metodo POST
        "data":{MoS:MoS,NombreMoS:NombreMoS,Accion:Accion,AniosPublicados:AniosPublicados}, //enviamos opcion 4 para que haga un SELECT
        "dataSrc":""
      },
      "columns": columnastabla
    }); 
  });
  
  ///:::::::::::::::::::::: BOTON NUEVO -> CARGA FORMULARIO NUEVO :::::::::::::::::::::::::///
  $("#btnNuevoPublicacionCarga").click(function(){
    $("#formPublicacionCarga").trigger("reset");
    $("#div_ResultadoPublicacionCarga").empty();
    $(".modal-header").css( "background-color", "#17a2b8");
    $(".modal-header").css( "color", "white" );
    $(".modal-title").text("Nueva Publicación");
    $('#modalCRUDPublicacionCarga').modal('show');	    

    AniosPublicados = $("#selectAniosPublicacionCarga").val();    
    Accion='SemanasPublicacionCarga'; 
    $.ajax({
      url: "Ajax.php",
      type: "POST",
      datatype:"json",
      data: {MoS:MoS,NombreMoS:NombreMoS,Accion:Accion,AniosPublicados:AniosPublicados},    
      success: function(data){
        $("#selectSemanasPublicacionCarga").html(data);
      }
    });
  });
  ///:::::::::::::::::::: FIN BOTON NUEVO -> CARGA FORMULARIO NUEVO :::::::::::::::::::::::///

  ///::::::::::::::::::::: BOTON PUBLICAR -> REALIZA LA PUBLICACION :::::::::::::::::::::::///
  $('#formPublicacionCarga').submit(function(e){                         
    e.preventDefault(); //evita el comportambiento normal del submit, es decir, recarga total de la página
    PubRg_SemanaPublicada = $('#selectSemanasPublicacionCarga').val();
    Accion='CrearPublicacionCarga';
    $("#btnCargarPublicacion").prop("disabled",true);
    $.ajax({
      url: "Ajax.php",
      type: "POST",
      datatype:"json",    
      data:  { MoS:MoS,NombreMoS:NombreMoS,Accion:Accion,PubRg_SemanaPublicada:PubRg_SemanaPublicada },    
      beforeSend: function () {
        $("#div_ResultadoPublicacionCarga").html("Procesando, espere por favor...<img src='Services/PlantillaTemplon/View/Img/loading5.gif' width='20' height='20'>");
      },
      success: function(data) {
        $("#div_ResultadoPublicacionCarga").html(data);
        tablaPublicacionCarga.ajax.reload(null, false);
        $("#btnCargarPublicacion").prop("disabled",false);
      }
    });
  });
  ///::::::::::::::::::: FIN BOTON PUBLICAR -> REALIZA LA PUBLICACION :::::::::::::::::::::///

  ///::::::::::::::::: BOTON PUBLICAR REGISTRO PublicacionCarga :::::::::::::::::::::::::::///
  $(document).on("click", ".btnPublicarProgramacion", function(){
    fila = $(this);           
    PubRg_Id = $(this).closest('tr').find('td:eq(0)').text();     
    PubRg_SemanaPublicada = $(this).closest('tr').find('td:eq(1)').text();
    PubRg_Estado = $(this).closest('tr').find('td:eq(8)').text();
  
    if(PubRg_Estado=='PENDIENTE') {
      respuesta = 0;
      Swal.fire({
        title: '¿Está seguro?',
        text: "Se publicará el registro "+PubRg_Id+" | "+PubRg_SemanaPublicada+"!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si, publicar!'
      }).then((result) => {
        if(result.isConfirmed)
        {
          Swal.fire(
              'Publicado!',
              'El registro ha sido publicado.',
              'success'
          )
          Accion='PublicarProgramacion';
          respuesta = 1;
          if(respuesta=1)
          {            
            $.ajax({
              url: "Ajax.php",
              type: "POST",
              datatype:"json",    
              data: { MoS:MoS,NombreMoS:NombreMoS,Accion:Accion,PubRg_Id:PubRg_Id},   
              success: function() {
                tablaPublicacionCarga.ajax.reload(null, false);
              }
            });
          }
        }
      });
    }else{
      Swal.fire({
        icon: 'error',
        title: 'PUBLICAR...',
        text: '*Solo se pueden publicar las semanas PENDIENTES!'
      })
    }
  });
  ///:::::::::::::::: FIN BOTON PUBLICAR REGISTRO PublicacionCarga ::::::::::::::::::::::::///

  ///::::::::::::::::::::::: BOTON DESCARGA ARCHIVO PDF GENERAL :::::::::::::::::::::::::::///
  $(document).on("click", ".btnFilePDF", function(){
    fila = $(this);           
    PubRg_Id = $(this).closest('tr').find('td:eq(0)').text();     
    PubRg_SemanaPublicada = $(this).closest('tr').find('td:eq(1)').text();
    Semana = PubRg_SemanaPublicada+PubRg_Id;
    window.location.href = miCarpeta + "Module/ProgramacionCarga/Controller/PDF_General.php?Semana=" + Semana;
  });
  ///::::::::::::::::::::: FIN BOTON DESCARGA ARCHIVO PDF GENERAL :::::::::::::::::::::::::///

  ///:::::::::::::::::: BOTON BORRAR REGISTRO PublicacionCarga  :::::::::::::::::::::::::::///
  $(document).on("click", ".btnBorrarPublicacionCarga", function(){
    fila = $(this);           
    PubRg_Id = $(this).closest('tr').find('td:eq(0)').text();     
    PubRg_SemanaPublicada = $(this).closest('tr').find('td:eq(1)').text();
    PubRg_Estado = $(this).closest('tr').find('td:eq(8)').text();

    if(PubRg_Estado=='ELIMINADO')
    {
      Swal.fire({
        icon: 'error',
        title: 'ELIMINAR...',
        text: '*El regsitro ya se encuentra ELIMINADO!'
      })
    }else{
      respuesta = 0;
      Swal.fire({
        title: '¿Está seguro?',
        text: "Se eliminará el registro "+PubRg_Id+" | "+PubRg_SemanaPublicada+"!",
        icon: 'warning',
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
          respuesta = 1;
          if(respuesta = 1)
          {            
            MoS='Module';
            NombreMoS='ProgramacionCarga';
            Accion='BorrarPublicacionCarga';
            $.ajax({
              url: "Ajax.php",
              type: "POST",
              datatype:"json",    
              data: { MoS:MoS,NombreMoS:NombreMoS,Accion:Accion,PubRg_Id:PubRg_Id},   
              success: function() {
                tablaPublicacionCarga.ajax.reload(null, false);
              }
            });
          }
        }
      });
    }
  });
  ///::::::::::::::::: FIN BOTON BORRAR REGISTRO PublicacionCarga  ::::::::::::::::::::::::///
  
  ///::::::::::::::::::: TERMINO BOTONES DE PUBLICACION CARGA :::::::::::::::::::::::::::::///

});
///::::::::::::::::::::: TERMINO JS DOM PUBLICACION CARGA :::::::::::::::::::::::::::::::::///