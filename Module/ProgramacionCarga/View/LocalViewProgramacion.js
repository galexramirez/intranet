///::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
///::::::::::::::::::: PROGRAMACION CARGA v 6.0 FECHA: 20-01-2023 :::::::::::::::::::::::::///
///::::: CREAR, ELIMINAR Y MOSTRAR LA PROGRAMACION DE PILOTOS Y BUSES :::::::::::::::::::::///
///::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///

///::::::::::::::::::::::::::::::: Declaracion de Variables :::::::::::::::::::::::::::::::///
var Semana;

///::::::::::::::::::::::::: JS DOM PROGRAMACION CARGA ::::::::::::::::::::::::::::::::::::///
$(document).ready(function(){
  div_boton = f_BotonesFormulario("formSeleccionProgramacionCarga","btn-ProgramacionCarga");
  $("#div_btn-ProgramacionCarga").html(div_boton);
  $("#btnNuevoProgramacionCarga").hide();

  Accion='AniosProgramacionCarga'; 
  $.ajax({
    url: "Ajax.php",
    type: "POST",
    datatype:"json",    
    data: {MoS:MoS,NombreMoS:NombreMoS,Accion:Accion},    
    success: function(data){
      $("#selectAniosProgramacionCarga").html(data);
    }
  });

  Accion='AniosPublicacionCarga'; 
  $.ajax({
    url: "Ajax.php",
    type: "POST",
    datatype:"json",    
    data: {MoS:MoS,NombreMoS:NombreMoS,Accion:Accion},    
    success: function(data){
      $("#selectAniosPublicacionCarga").html(data);
      $("#selectAniosPDF").html(data);
    }
  });

  ///::::::::::::::::::::::::::: JS COMBOS DEPENDIENTES ::::::::::::::::::::::::::::::::::::///
  $("#selectAniosProgramacionCarga").on('change', function () {
    $("#btnNuevoProgramacionCarga").hide();
    $("#tablaProgramacionCarga").dataTable().fnDestroy();
    $('#tablaProgramacionCarga').hide();  
  });

  $("#selectSemanasProgramacionCarga").on('change', function () {
    $("#btnNuevoProgramacionCarga").hide();
    $("#tablaProgramacionCarga").dataTable().fnDestroy();
    $('#tablaProgramacionCarga').hide();  
  });

  $("#selectAniosProgramacionCarga").on('change',function () {
    $("#selectAniosProgramacionCarga option:selected").each(function () {
      elegidoC1=$(this).val();
      Accion='SemanasProgramacionCarga'; 
      $.ajax({
        url: "Ajax.php",
        type: "POST",
        datatype:"json",    
        data: {MoS:MoS,NombreMoS:NombreMoS,Accion:Accion,elegidoC1:elegidoC1},    
        success: function(data){
          $("#selectSemanasProgramacionCarga").html(data);
        }
      });
    });
  });

  ///::::::::::::::::: LIMPIA EL DIV DE RESULTADO :::::::::::::::::::::::::::::::::::::::::///
  $("#D3").click(function(){
    $("#div_ResultadoProgramacionCarga").empty();
  });

  ///:::::::::::::::::: COLOCA EL NOMBRE DEL ARCHIVO EN EL INPUT FILE :::::::::::::::::::::///
  $(document).on('change', '#D3', function (event) {
    var NombreArch=event.target.files[0].name;
    var Extension=NombreArch.split('.').pop();
    $("#LabelD3").text(NombreArch);
  }); 


  ///::::::::::::::::::::::: BOTONES PROGRAMACION CARGA :::::::::::::::::::::::::::::::::::///
  
  //:::::::::::::::: BOTON NUEVO CARGA DE PROGRAMACION ::::::::::::::::::::::::::::::::::::///
  $("#btnNuevoProgramacionCarga").click(function(){
    Opcion = 0;
    $("#div_ResultadoProgramacionCarga").empty();
    $("#LabelD3").text("Seleccionar Archivo .csv o .xlsx");
    $("#formProgramacionCarga").trigger("reset");
    $(".modal-header").css( "background-color", "#17a2b8");
    $(".modal-header").css( "color", "white" );
    $(".modal-title").text("Nueva Carga");
    $('#modalCRUDProgramacionCarga').modal('show');	    
  });
  ///:::::::::::::::::::: FIN BOTON NUEVO CARGA DE PROGRAMACION :::::::::::::::::::::::::::///

  ///:::::::::::::::::::::::: BOTON BUSCAR PROGRAMACION CARGA :::::::::::::::::::::::::::::///
  $("#btnBuscarProgramacion").on("click",function(){
    $("#btnNuevoProgramacionCarga").show();
    Semana = $("#selectSemanasProgramacionCarga").val();

    div_tabla = f_CreacionTabla("tablaProgramacionCarga","");
    $("#div_tablaProgramacionCarga").html(div_tabla);
    columnastabla = f_ColumnasTabla("tablaProgramacionCarga","");

    $("#tablaProgramacionCarga").dataTable().fnDestroy();
    $('#tablaProgramacionCarga').show();
    Accion='LeerProgramacionCarga';  
    tablaProgramacionCarga = $('#tablaProgramacionCarga').DataTable({
      language: idiomaEspanol,
      responsive: "true",
      dom: 'Blfrtip', // Con Botones Excel,Pdf,Print
      pageLength: 25,
      buttons:
      [
        {
          extend:     'excelHtml5',
          text:       '<i class="fas fa-file-excel"></i> ',
          titleAttr:  'Exportar a Excel',
          className:  'btn btn-success'
        },
      ],
      "ajax":
      {            
        "url": "Ajax.php", 
        "method": 'POST', //usamos el metodo POST
        "data":{MoS:MoS,NombreMoS:NombreMoS,Accion:Accion,Semana:Semana}, //enviamos opcion 4 para que haga un SELECT
        "dataSrc":""
      },
      "columns": columnastabla,
      "order": [1, 'asc']
    });
  });
  ///:::::::::::::::::::::: FIN BOTON BUSCAR PROGRAMACION CARGA :::::::::::::::::::::::::::///

  ///::::::::::::::: BOTON CARGAR -> REALIZA LA CARGA DE LA PROGRAMACION ::::::::::::::::::///
  $('#formProgramacionCarga').submit(function(e){
    e.preventDefault(); //evita el comportambiento normal del submit, es decir, recarga total de la página
    //:: Valida que exista el Excel. 
    let excel = document.getElementById('D3').value;
    let Semana = $("#selectSemanasProgramacionCarga").val();
    if(excel.length==0)
    {
      Swal.fire({
        icon: 'error',
        title: 'Archivo Excel...',
        text: '*Requiere archivo .cvs o .xlsx!'
      })
      Opcion = 0;
    } 
    else 
    {
      Opcion = 1;
      $("#div_ResultadoProgramacionCarga").empty();
    }

    // Objeto FormData para enviar datos de al formulario   
    let formUsuarios = new FormData(); 
    let filesexcel = $("#D3")[0].files[0]; 
    formUsuarios.append('archivoexcel',filesexcel);
    formUsuarios.append('MoS','Module');
    formUsuarios.append('NombreMoS','ProgramacionCarga');
    formUsuarios.append('Accion','CrearProgramacionCarga');
    formUsuarios.append('Semana',Semana);
  
    if(Opcion == 1){
      $("#bntCargarProgramacion").prop("disabled",true);
      $.ajax({
        url:"Ajax.php",
        type:"POST",
        data: formUsuarios,
        contentType:false,
        processData:false,
        beforeSend: function () {
          $("#div_ResultadoProgramacionCarga").html("Procesando, espere por favor...<img src='Services/PlantillaTemplon/View/Img/loading5.gif' width='20' height='20'>");
        },
        success:function(resp){
          $("#div_ResultadoProgramacionCarga").html(resp);
          tablaProgramacionCarga.ajax.reload(null, false);
          $("#bntCargarProgramacion").prop("disabled",false);
        },
      });
    }
  });
  ///::::::::::::::: FIN BOTON CARGAR -> REALIZA LA CARGA DE LA PROGRAMACION ::::::::::::::///

  ///::::::::::::::::::: BOTON BORRAR REGISTRO ProgramacionCarga ::::::::::::::::::::::::::///
  $(document).on("click", ".btnBorrarProgramacionCarga", function(){
    fila = $(this);           
    PrgRg_Id = $(this).closest('tr').find('td:eq(0)').text();     
    PrgRg_FechaProgramado = $(this).closest('tr').find('td:eq(1)').text();
    PrgRg_Operacion = $(this).closest('tr').find('td:eq(3)').text();

    let respuesta = 0;
    let opcion2 = 0;
    let rpta_validar_prog = "";
    let rpta_validar_ctrlfaci = "";

    Accion='ValidarProgramacionCarga'; // La programacion no debe estar publicada
    $.ajax({
      url: "Ajax.php",
      type: "POST",
      datatype:"json",
      async: false,
      data: { MoS:MoS,NombreMoS:NombreMoS,Accion:Accion,PrgRg_FechaProgramado:PrgRg_FechaProgramado},   
      success: function(data) {
        rpta_validar_prog = data;
      }
    });

    if(rpta_validar_prog=="NO"){
      Swal.fire({
        icon: 'error',
        title: 'Semana Publicada...',
        text: '*La programación se encuentra publicada!!!'
      })
    }else{
      Accion='ValidarControlFacilitador'; // La programacion no debe estar generada en el Control Facilitador de Operaciones
      $.ajax({
        url: "Ajax.php",
        type: "POST",
        datatype:"json",
        async: false,
        data: { MoS:MoS,NombreMoS:NombreMoS,Accion:Accion,PrgRg_FechaProgramado:PrgRg_FechaProgramado,PrgRg_Operacion:PrgRg_Operacion},   
        success: function(data) {
          rpta_validar_ctrlfaci = data;
        }
      });
      if(rpta_validar_ctrlfaci=="NO"){
        Swal.fire({
          icon: 'error',
          title: 'Control Facilitador...',
          text: '*La programación ha sido generada en Operaciones!!!'
        })
      }else{
        Swal.fire({
          title: '¿Está seguro?',
          text: "Se eliminara el registro "+PrgRg_Id+" | "+PrgRg_FechaProgramado+" | "+PrgRg_Operacion+"!",
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
            // BORRAR REGISTRO DE PROGRAMACION REGISTRO CARGA
            if(respuesta = 1)
            {            
              Accion='BorrarProgramacionCarga';
              $.ajax({
                url: "Ajax.php",
                type: "POST",
                datatype:"json",    
                data: { MoS:MoS,NombreMoS:NombreMoS,Accion:Accion,PrgRg_Id:PrgRg_Id},   
                success: function() {
                  tablaProgramacionCarga.row(fila.parents('tr')).remove().draw();                  
                }
              });
              opcion2 = 1;
              // BORRAR DETALLE DE PROGRAMACION..... FALTA CONDICION DE AJAX 
              if(opcion2 = 1)
              {
                Accion='BorrarProgramacion'; 
                $.ajax({
                  url: "Ajax.php",
                  type: "POST",
                  datatype:"json",    
                  data: {MoS:MoS,NombreMoS:NombreMoS,Accion:Accion,PrgRg_FechaProgramado:PrgRg_FechaProgramado,PrgRg_Operacion:PrgRg_Operacion},    
                  success: function(){
                    tablaProgramacionCarga.row(fila.parents('tr')).remove().draw();
                  }
                });
              }
            }
          }
        });
      }
    }
  });
  ///::::::::::::::::::: BOTON BORRAR REGISTRO ProgramacionCarga ::::::::::::::::::::::::::///

  ///:::::::::::::::::::::TERMINO BOTONES PROGRAMACION CARGA ::::::::::::::::::::::::::::::///


});
///::::::::::::::::::::::::: TERMINO JS DOM PROGRAMACION CARGA ::::::::::::::::::::::::::::///