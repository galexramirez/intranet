///::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
///::::::::::: CARGAR PRECIOS PROVEEDOR v 1.0 FECHA: 13-10-2022 :::::::::::::::::::::::::::///
//:::::::::::::::::: CARGAR TABLA DE PRECIOS PROVEEDOR ::::::::::::::::::::::::::::::::::::///
///::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///

///::::::::::::::::::::::::: Declaracion de Variables :::::::::::::::::::::::::::::::::::::///
var tablaCargarPrecios, selectAniosCargarPrecios, OpcionCargarPrecios, filaCargarPrecios;
var cpm_fechacarga, cpm_id;

///::::::::::::::: JS CARGA DE DATA TABLE :::::::::::::://
$(document).ready(function(){

  Accion='SelectAnios'; 
  $.ajax({
    url: "Ajax.php",
    type: "POST",
    datatype:"json",    
    data: {MoS:MoS,NombreMoS:NombreMoS,Accion:Accion},    
    success: function(data){
      $("#selectAniosCargarPrecios").html(data);
    }
  });
  
  // Si hay cambios en el Fecha se ocultan botones y datatable
  $("#selectAniosCargarPrecios").on('change', function () {
    $("#tablaCargarPrecios").dataTable().fnDestroy();
    $('#tablaCargarPrecios').hide();  
  });

  // Si hay cambios en el nombre del archivo a cargar se limpia el texto del resultado
  $("#fileCargarPrecios").click(function(){
    $("#div_ResultadoCargarPrecios").empty();
  });

  ///::::::::: COLOCA EL NOMBRE DEL ARCHIVO EN EL INPUT FILE
  $(document).on('change', '#fileCargarPrecios', function (event) {
    var NombreArch=event.target.files[0].name;
    var Extension=NombreArch.split('.').pop();
    $("#LabelfileCargarPrecios").text(NombreArch);
  }); 

      
  /// ::::::::::::::: CREAR OT PREVENTIVAS :::::::::::::///
  $('#formCargarPrecios').submit(function(e){                         
    e.preventDefault(); //evita el comportambiento normal del submit, es decir, recarga total de la página
    //:: Valida que exista el archivo Excel. 
    let f_Excel = document.getElementById('fileCargarPrecios').value;
    let anioCarga = $("#selectAniosCargarPrecios").val();
    let opcionCargarExcel = 0;
    if(f_Excel.length==0){
        Swal.fire({
          icon: 'error',
          title: 'Archivo Excel...',
          text: '*Requiere archivo .cvs o .xlsx!'
        })
    } 
    else{
        opcionCargarExcel = 1;
        $("#div_ResultadoCargarPrecios").empty();
    }
    // Objeto FormData para enviar datos de al formulario   
    let formUsuarios = new FormData(); 
    let filesexcel = $("#fileCargarPrecios")[0].files[0]; 
    formUsuarios.append('archivoexcel',filesexcel);
    formUsuarios.append('MoS',MoS);
    formUsuarios.append('NombreMoS',NombreMoS);
    formUsuarios.append('Accion','CrearCargarPrecios');
    formUsuarios.append('Anio',anioCarga);
    
    if(opcionCargarExcel == 1){
      $("#bntCargarListaPrecios").prop("disabled",true);
      $.ajax({
        url:"Ajax.php",
        type:"POST",
        data: formUsuarios,
        contentType:false,
        processData:false,
        beforeSend: function () {
          $("#div_ResultadoCargarPrecios").html("Procesando, espere por favor...<img src='Services/PlantillaTemplon/View/Img/loading5.gif' width='20' height='20'>");
        },
        success:function(resp){
          $("#div_ResultadoCargarPrecios").html(resp);
          tablaCargarPrecios.ajax.reload(null, false);
          $("#bntCargarListaPrecios").prop("disabled",false);
        },
      });
    }
  });
});    

///::::::::::::::::::::::::: BOTONES DE USUARIOS :::::::::::::::::::::///

///:::::::::::::::::::::::: JS DATA TABLE CARGAR PRECIOS ::::::::::::::::::::::::::::::::::///
$("#btnBuscarCargarPrecios").on("click",function(){
  selectAniosCargarPrecios = $("#selectAniosCargarPrecios").val();

  div_tabla = f_CreacionTabla("tablaCargarPrecios","");
  $("#div_tablaCargarPrecios").html(div_tabla);
  columnastabla = f_ColumnasTabla("tablaCargarPrecios","");
  $("#tablaCargarPrecios").dataTable().fnDestroy();
  $('#tablaCargarPrecios').show();

  Accion='LeerCargarPrecios';
  
  tablaCargarPrecios = $('#tablaCargarPrecios').DataTable({
    // Para mostrar la barra scroll horizontal y vertical
    deferRender:    true,
    scrollY:        800,
    scrollCollapse: true,
    scroller:       true,
    scrollX:        true,
    fixedColumns:{
        left: 1
    },
    fixedHeader:{
        header : false
    },
    //Para mostrar 50 registros popr página 
    pageLength: 50,
    //Para cambiar el lenguaje a español
    language: idiomaEspanol, 
    //Para usar los botones
    responsive: "true",
    dom: 'Blfrtip', // Con Botones Excel,Pdf,Print
    buttons:[
        {
            extend:     'excelHtml5',
            text:       '<i class="fas fa-file-excel"></i> ',
            titleAttr:  'Exportar a Excel',
            className:  'btn btn-success'
        },
        {
            extend:     'pdfHtml5',
            text:       '<i class="fas fa-file-pdf"></i> ',
            titleAttr:  'Exportar a PDF',
            className:  'btn btn-danger'
        },
    ],
    "ajax":{            
        "url": "Ajax.php", 
        "method": 'POST', //usamos el metodo POST
        "data":{MoS:MoS,NombreMoS:NombreMoS,Accion:Accion,Anios:selectAniosCargarPrecios}, //enviamos opcion 4 para que haga un SELECT
        "dataSrc":""
    },
    "columns":columnastabla,
    "order": [[0, 'desc']]
  });     
});  

///::::::::: EVENTO DEL BOTON NUEVO ::::::::::::::///
$("#btnCargarLista").click(function(){
  OpcionCargarPrecios = 0;
  $("#div_ResultadoCargarPrecios").empty();
  $("#LabelfileCargarPrecios").text("Seleccionar Archivo .csv o .xlsx");
  $("#formCargarPrecios").trigger("reset");
  $(".modal-header").css( "background-color", "#17a2b8");
  $(".modal-header").css( "color", "white" );
  $(".modal-title").text("Nueva Carga");
  $('#modalCRUDCargarPrecios').modal('show');	    
});
  
///::::::::  BOTON BORRAR REGISTRO  
$(document).on("click", ".btnEliminarCargarPrecios", function(){
  filaCargarPrecios = $(this);           
  cpm_id = filaCargarPrecios.closest('tr').find('td:eq(0)').text();
  let opcionBorrar = 0;
  
  // VALIDAR FECHAS EN DETALLE DE OT PREVENTIVAS 
  Accion='ValidarCargarPrecios'; 
  $.ajax({
    url: "Ajax.php",
    type: "POST",
    datatype:"json",
    async: false,
    data: {MoS:MoS,NombreMoS:NombreMoS,Accion:Accion,cpm_id:cpm_id},    
    success: function(data){
      if(data==false){
        opcionBorrar = 1;
      }
    }
  });
  
  if(opcionBorrar==1){
    Swal.fire({
      icon: 'error',
      title: 'ELIMINAR',
      text: 'El registro no puede ser eliminado, debido a que la fecha de sus registros es menor a la fecha actual.',
    });
  }else{
    Swal.fire({
      title: '¿Está seguro?',
      text: "Se eliminara el registro "+cpm_id+"!",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Si, eliminar!'
    }).then((result) => {
      if (result.isConfirmed) {
        Swal.fire(
            'Eliminado!',
            'El registro ha sido eliminado.',
            'success'
        )
        // BORRAR DETALLE DE PRECIOS PROVEEDOR 
        Accion='AnularCargarPreciosProveedor'; 
        $.ajax({
          url: "Ajax.php",
          type: "POST",
          datatype:"json",    
          data: {MoS:MoS,NombreMoS:NombreMoS,Accion:Accion,cpm_id:cpm_id},    
          success: function(){
          }
        });
        // ELIMINAR REGISTRO DE CARGAR PRECIOS PROVEEDOR
        Accion='EliminarCargarPreciosProveedor';
        $.ajax({
          url: "Ajax.php",
          type: "POST",
          datatype:"json",    
          data: { MoS:MoS,NombreMoS:NombreMoS,Accion:Accion,cpm_id:cpm_id},   
          success: function() {
            tablaCargarPrecios.ajax.reload(null, false);
          }
        });
        
      }
    });
  }
});


///::::::::::::::::::::::::::::::::: FUNCIONES DE USUARIOS ::::::::::::::::::::::::::::::::::::///

///::::::::::::::: FUNCION PARA VALIDAR LOS DATOS INGRESADOS AL FORMULARIO :::::::::::::::::::///
function f_validar(){
  f_LimpiaMs();
  NoLetrasMayuscEspacio=/[^A-Z \Ñ]/;
  var respuesta="";    

    
  return respuesta; 
}

///::::::::: INVISIBILIZA LOS MENSAJE DE ALERTA DEL FORMULARIO :::::: /// 
function f_LimpiaMs(){

}