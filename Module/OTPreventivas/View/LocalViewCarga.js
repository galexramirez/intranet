///::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
///:::::::::::::::::: CARGA OT PREVENTIVAS v 2.0 FECHA: 28-12-2022 ::::::::::::::::::::::::::::::///
//::::::::::::::::::::::::::: CARGAR TABLA DE OT PREVENTIVAS ::::::::::::::::::::::::::::::::::::///
///::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///

///::::::::::::::::::::::::::::::: Declaracion de Variables :::::::::::::::::::::::::::::::::::::///
var tablaOTPrvCarga, selectAniosOTPrvCarga, OpcionOTPrvCarga, filaOTPrvCarga;
var otprvcarga_semanaprogramada;

///::::::::::::::: JS CARGA DE DATA TABLE :::::::::::::://
$(document).ready(function(){
  $("#btnNuevoOTPrvCarga").hide();

  Accion='SelectAnios'; 
  $.ajax({
    url       : "Ajax.php",
    type      : "POST",
    datatype  : "json",
    async     : false,    
    data: {MoS:MoS,NombreMoS:NombreMoS,Accion:Accion},    
    success   : function(data){
      $("#selectAniosOTPrvCarga").html(data);
    }
  });
  selectAniosOTPrvCarga = fecha_hoy.getFullYear();
  $("#selectAniosOTPrvCarga").val(selectAniosOTPrvCarga.toString());
  
  // Si hay cambios en el Fecha se ocultan botones y datatable
  $("#selectAniosOTPrvCarga").on('change', function () {
    $("#tablaOTPrvCarga").dataTable().fnDestroy();
    $('#tablaOTPrvCarga').hide();  
    $("#btnNuevoOTPrvCarga").hide();
  });

  // Si hay cambios en el nombre del archivo a cargar se limpia el texto del resultado
  $("#fileOTPrvCarga").click(function(){
    $("#div_ResultadoOTPrvCarga").empty();
  });

  ///::::::::: COLOCA EL NOMBRE DEL ARCHIVO EN EL INPUT FILE
  $(document).on('change', '#fileOTPrvCarga', function (event) {
    var NombreArch  = event.target.files[0].name;
    var Extension   = NombreArch.split('.').pop();
    $("#LabelfileOTPrvCarga").text(NombreArch);
  }); 

      
  /// ::::::::::::::: CREAR OT PREVENTIVAS :::::::::::::///
  $('#formOTPrvCarga').submit(function(e){                         
    e.preventDefault(); //evita el comportambiento normal del submit, es decir, recarga total de la página
    //:: Valida que exista el archivo Excel. 
    let f_Excel = document.getElementById('fileOTPrvCarga').value;
    let anioCarga = $("#selectAniosOTPrvCarga").val();
    let opcionCargarExcel = 0;
    if(f_Excel.length==0){
        Swal.fire({
          icon: 'error',
          title: 'Archivo Excel...',
          text: '*Requiere archivo .xlsx!'
        })
    } 
    else{
        opcionCargarExcel = 1;
        $("#div_ResultadoOTPrvCarga").empty();
    }
    // Objeto FormData para enviar datos de al formulario   
    let formUsuarios = new FormData(); 
    let filesexcel = $("#fileOTPrvCarga")[0].files[0]; 
    formUsuarios.append('archivoexcel',filesexcel);
    formUsuarios.append('MoS',MoS);
    formUsuarios.append('NombreMoS',NombreMoS);
    formUsuarios.append('Accion','CrearOTPrvCarga');
    formUsuarios.append('Anio',anioCarga);
    
    if(opcionCargarExcel == 1){
      $("#bntCargarOTPrvCarga").prop("disabled",true);
      $.ajax({
        url:"Ajax.php",
        type:"POST",
        data: formUsuarios,
        contentType:false,
        processData:false,
        beforeSend: function () {
          $("#div_ResultadoOTPrvCarga").html("Procesando, espere por favor...<img src='Services/PlantillaTemplon/View/Img/loading5.gif' width='20' height='20'>");
        },
        success:function(resp){
          $("#div_ResultadoOTPrvCarga").html(resp);
          tablaOTPrvCarga.ajax.reload(null, false);
          $("#bntCargarOTPrvCarga").prop("disabled",false);
        },
      });
    }
  });
});    

///::::::::::::::::::::::::: BOTONES DE USUARIOS :::::::::::::::::::::///

///:::::::::::::::::::::::: JS DATA TABLE ACCIDENTES ::::::::::::::::::::::::::::::::::///
$("#btnBuscarOTPrvCarga").on("click",function(){
  selectAniosOTPrvCarga = $("#selectAniosOTPrvCarga").val();

  if(selectAniosOTPrvCarga===""){
    Swal.fire({
      icon              : 'success',
      title             : 'Seleccionar Año...',
      showConfirmButton : false,
      timer             : 1500
    })
  }else{
    div_tabla = f_CreacionTabla("tablaOTPrvCarga","");
    $("#div_tablaOTPrvCarga").html(div_tabla);
    columnastabla = f_ColumnasTabla("tablaOTPrvCarga","");
    
    $("#tablaOTPrvCarga").dataTable().fnDestroy();
    $('#tablaOTPrvCarga').show();
    $("#btnNuevoOTPrvCarga").show();
    
    Accion          = 'LeerOTPrvCarga';
    tablaOTPrvCarga = $('#tablaOTPrvCarga').DataTable({
      deferRender   : true,
      scrollY       : 800,
      scrollCollapse: true,
      scroller      : true,
      scrollX       : true,
      fixedColumns  : {
        left        : 1
      },
      fixedHeader   : {
        header      : false
      },
      pageLength    : 50,
      language      : idiomaEspanol, 
      responsive    : "true",
      dom           : 'Blfrtip',
      buttons       : [
        {
          extend      : 'excelHtml5',
          text        : '<i class="fas fa-file-excel"></i> ',
          titleAttr   : 'Exportar a Excel',
          className   : 'btn btn-success',
          title       : 'CARGA OTs PREVENTIVAS'
        },
      ],
      "ajax"      : {            
        "url"     : "Ajax.php", 
        "method"  : 'POST', //usamos el metodo POST
        "data"    : {MoS:MoS,NombreMoS:NombreMoS,Accion:Accion,Anios:selectAniosOTPrvCarga}, //enviamos opcion 4 para que haga un SELECT
        "dataSrc" : ""
      },
      "columns"   : columnastabla,
      "order"     : [[1, 'desc']]
    });     
  }
});  

///::::::::: EVENTO DEL BOTON NUEVO ::::::::::::::///
$("#btnNuevoOTPrvCarga").click(function(){
  OpcionOTPrvCarga = 0;
  $("#div_ResultadoOTPrvCarga").empty();
  $("#LabelfileOTPrvCarga").text("Seleccionar Archivo .xlsx");
  $("#formOTPrvCarga").trigger("reset");
  $(".modal-header").css( "background-color", "#17a2b8");
  $(".modal-header").css( "color", "white" );
  $(".modal-title").text("Nueva Carga");
  $('#modalCRUDOTPrvCarga').modal('show');	    
});
  
///::::::::  BOTON BORRAR REGISTRO  
$(document).on("click", ".btnBorrarOTPrvCarga", function(){
  filaOTPrvCarga = $(this);           
  otprvcarga_id = filaOTPrvCarga.closest('tr').find('td:eq(0)').text();
  otprvcarga_semanaprogramada = filaOTPrvCarga.closest('tr').find('td:eq(1)').text();
  let opcionBorrar = 0;
  
  // VALIDAR FECHAS EN DETALLE DE OT PREVENTIVAS 
  Accion='ValidarOTPrv'; 
  $.ajax({
    url: "Ajax.php",
    type: "POST",
    datatype:"json",
    async: false,
    data: {MoS:MoS,NombreMoS:NombreMoS,Accion:Accion,otprvcarga_semanaprogramada:otprvcarga_semanaprogramada},    
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
      text: "Se eliminara el registro "+otprvcarga_id+" | "+otprvcarga_semanaprogramada+"!",
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
        // BORRAR REGISTRO DE OT PREVENTIVAS CARGA
        Accion='BorrarOTPrvCarga';
        $.ajax({
          url: "Ajax.php",
          type: "POST",
          datatype:"json",    
          data: { MoS:MoS,NombreMoS:NombreMoS,Accion:Accion,otprvcarga_id:otprvcarga_id},   
          success: function() {
          }
        });
        // BORRAR DETALLE DE OT PREVENTIVAS 
        Accion='BorrarOTPrv'; 
        $.ajax({
          url: "Ajax.php",
          type: "POST",
          datatype:"json",    
          data: {MoS:MoS,NombreMoS:NombreMoS,Accion:Accion,otprvcarga_id:otprvcarga_id},    
          success: function(){
          }
        });
        tablaOTPrvCarga.row(filaOTPrvCarga.parents('tr')).remove().draw();                  
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