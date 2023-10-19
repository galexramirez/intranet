///::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
///:::::::::::::::::: CARGA KILOMETRAJE v 2.0 FECHA: 18-01-2023 :::::::::::::::::::::::::::///
//::::::::::::::::::::::::::: CARGAR TABLA DE KILOMETRAJE :::::::::::::::::::::::::::::::::///
///::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///

///::::::::::::::::::::::::::::::: Declaracion de Variables :::::::::::::::::::::::::::::::///
var tablaKmCarga, selectAniosKmCarga, OpcionKmCarga, filaKmCarga;
var kmcarga_fecha;

///::::::::::::::::::::::::: JS DOM CARGA DE KILOMETRAJE ::::::::::::::::::::::::::::::::::///
$(document).ready(function(){
  div_boton = f_BotonesFormulario("formSeleccionKmCarga","btn-seleccion");
  $("#div_btn-seleccion").html(div_boton);

  $("#btnNuevoKmCarga").hide();

  Accion='SelectAnios'; 
  $.ajax({
    url     : "Ajax.php",
    type    : "POST",
    datatype: "json",    
    async   : false,
    data    : {MoS:MoS,NombreMoS:NombreMoS,Accion:Accion},    
    success : function(data){
      $("#selectAniosKmCarga").html(data);
    }
  });
  selectAniosKmCarga = fecha_hoy.getFullYear();
  $("#selectAniosKmCarga").val(selectAniosKmCarga.toString());  
  // Si hay cambios en el Fecha se ocultan botones y datatable
  $("#selectAniosKmCarga").on('change', function () {
    $("#tablaKmCarga").dataTable().fnDestroy();
    $('#tablaKmCarga').hide();  
    $("#btnNuevoKmCarga").hide();
  });

  // Si hay cambios en el nombre del archivo a cargar se limpia el texto del resultado
  $("#fileKmCarga").click(function(){
    $("#div_ResultadoKmCarga").empty();
  });

  ///::::::::: COLOCA EL NOMBRE DEL ARCHIVO EN EL INPUT FILE
  $(document).on('change', '#fileKmCarga', function (event) {
    var NombreArch=event.target.files[0].name;
    var Extension=NombreArch.split('.').pop();
    $("#LabelfileKmCarga").text(NombreArch);
  });

  ///::::::::::::::::::::::::::::::: BOTONES DE KILOMETROS CARGA ::::::::::::::::::::::::::///

  ///:::::::::::::::::::::::: btnCargarKmCarga CREAR CARGA DE KM ::::::::::::::::::::::::::///
  $('#formKmCarga').submit(function(e){                         
    e.preventDefault(); //evita el comportambiento normal del submit, es decir, recarga total de la página
    //:: Valida que exista el archivo Excel. 
    let f_Excel = document.getElementById('fileKmCarga').value;
    let anioCarga = $("#selectAniosKmCarga").val();
    kmcarga_fecha = $("#kmcarga_fecha").val();
    let validarfechacarga = f_validarfechacarga();
    let opcionCargarExcel = 0;
    
    if(validarfechacarga!=kmcarga_fecha){
      Swal.fire({
        icon: 'error',
        title: 'Fecha...',
        text: '*Fecha de Carga incorrecta!!!'
      })
    }else{
      if(f_Excel.length==0){
        Swal.fire({
          icon: 'error',
          title: 'Archivo Excel...',
          text: '*Requiere archivo .csv o .xlsx!'
        })
      }else{
        opcionCargarExcel = 1;
        $("#div_ResultadoKmCarga").empty();
      }
      // Objeto FormData para enviar datos de al formulario   
      let formKmCarga = new FormData(); 
      let filesexcel = $("#fileKmCarga")[0].files[0]; 
      formKmCarga.append('archivoexcel',filesexcel);
      formKmCarga.append('MoS',MoS);
      formKmCarga.append('NombreMoS',NombreMoS);
      formKmCarga.append('Accion','CrearKmCarga');
      formKmCarga.append('Anio',anioCarga);
      formKmCarga.append('kmcarga_fecha',kmcarga_fecha);
        
      if(opcionCargarExcel == 1){
        $("#bntCargarKmCarga").prop("disabled",true);
        $.ajax({
          url:"Ajax.php",
          type:"POST",
          data: formKmCarga,
          contentType:false,
          processData:false,
          beforeSend: function () {
            $("#div_ResultadoKmCarga").html("Procesando, espere por favor...<img src='Services/PlantillaTemplon/View/Img/loading5.gif' width='20' height='20'>");
          },
          success:function(resp){
            $("#div_ResultadoKmCarga").html(resp);
            tablaKmCarga.ajax.reload(null, false);
            $("#bntCargarKmCarga").prop("disabled",false);
          },
        });
      }
    }
  });
  ///::::::::::::::::::::: FIN btnCargarKmCarga CREAR CARGA DE KM :::::::::::::::::::::::::///
  
  ///:::::::::::::::::::::::: BOTON BUSCAR KILOMETROS CARGA :::::::::::::::::::::::::::::::///
  $("#btnBuscarKmCarga").on("click",function(){
    selectAniosKmCarga = $("#selectAniosKmCarga").val();
    FechaInicioKm = "";
    FechaTerminoKm = "";

    div_tabla = f_CreacionTabla("tablaKmCarga","");
    $("#div_tablaKmCarga").html(div_tabla);
    columnastabla = f_ColumnasTabla("tablaKmCarga","");
    $("#tablaKmCarga").dataTable().fnDestroy();
    $('#tablaKmCarga').show();
    $("#btnNuevoKmCarga").show();

    Accion='LeerKmCarga';
    tablaKmCarga = $('#tablaKmCarga').DataTable({
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
      pageLength    : 50,
      language      : idiomaEspanol, 
      responsive    : "true",
      dom           : 'Blfrtip', // Con Botones Excel,Pdf,Print
      buttons:[
        {
          extend    : 'excelHtml5',
          text      : '<i class="fas fa-file-excel"></i> ',
          titleAttr : 'Exportar a Excel',
          className : 'btn btn-success'
        },
      ],
      "ajax":{            
        "url"     : "Ajax.php",
        "method"  : 'POST', //usamos el metodo POST
        "data"    :{MoS:MoS,NombreMoS:NombreMoS,Accion:Accion,Anios:selectAniosKmCarga}, //enviamos opcion 4 para que haga un SELECT
        "dataSrc" :""
      },
      "columns"   :columnastabla,
/*      "columnDefs":[
          {
            "targets" : [5],
            "visible" : false
          }
      ],*/
      "order": [[2, 'desc']]
    });
  });  
  ///:::::::::::::::::::::::: FIN BOTON BUSCAR KILOMETROS CARGA :::::::::::::::::::::::::::///

  ///:::::::::::::::::::::::: EVENTO DEL BOTON NUEVO KM CARGA :::::::::::::::::::::::::::::///
  $("#btnNuevoKmCarga").click(function(){
    OpcionKmCarga = 0;
    tfechacarga = f_validarfechacarga();
    $("#formKmCarga").trigger("reset");

    $("#kmcarga_fecha").val(tfechacarga);
    $("#div_ResultadoKmCarga").empty();
    $("#LabelfileKmCarga").text("Seleccionar Archivo .csv o .xlsx");
    $(".modal-header").css( "background-color", "#17a2b8");
    $(".modal-header").css( "color", "white" );
    $(".modal-title").text("Nueva Carga");
    $('#modalCRUDKmCarga').modal('show');	    
  });
  ///::::::::::::::::::::::: FIN EVENTO DEL BOTON NUEVO KM CARGA ::::::::::::::::::::::::::///
  
  ///::::::::::::::::  BOTON BORRAR REGISTRO KM CARGA :::::::::::::::::::::::::::::::::::::///  
  $(document).on("click", ".btnBorrarKmCarga", function(){
    filaKmCarga = $(this);           
    kmcarga_id = filaKmCarga.closest('tr').find('td:eq(0)').text();
    kmcarga_fecha = filaKmCarga.closest('tr').find('td:eq(2)').text();
    
    Swal.fire({
      title: '¿Está seguro?',
      text: "Se eliminara el registro "+kmcarga_id+" | "+kmcarga_fecha+"!",
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
        // BORRAR REGISTRO DE KILOMETROS CARGA
        Accion='BorrarKmCarga';
        $.ajax({
          url: "Ajax.php",
          type: "POST",
          datatype:"json",    
          data: { MoS:MoS,NombreMoS:NombreMoS,Accion:Accion,kmcarga_id:kmcarga_id},   
          success: function() {
          }
        });
        // BORRAR DETALLE DE KILOMETRAJE 
        Accion='BorrarKm'; 
        $.ajax({
          url: "Ajax.php",
          type: "POST",
          datatype:"json",    
          data: {MoS:MoS,NombreMoS:NombreMoS,Accion:Accion,kmcarga_id:kmcarga_id},    
          success: function(){
          }
        });
        tablaKmCarga.row(filaKmCarga.parents('tr')).remove().draw();                  
      }
    });
  });
  ///:::::::::::::::: FIN BOTON BORRAR REGISTRO KM CARGA ::::::::::::::::::::::::::::::::::///

  ///:::::::::::::::::::::::::: TERMIANO BOTONES DE KILOMETROS CARGA ::::::::::::::::::::::///

});
///:::::::::::::::::::::: FIN JS DOM CARGA DE KILOMETRAJE :::::::::::::::::::::::::::::::::///


///::::::::::::::::::::::::::::::: FUNCIONES DE KM CARGA ::::::::::::::::::::::::::::::::::///

///:: FECHA QUE SE DEBE DE INGRESAR - SE VERIFICA CUAL ES LA ULTIMA FECHA DE INGRESO A LA TABLA manto_ckl_kilometraje ::///
function f_validarfechacarga(){
  let rptavalidarfechacarga="";
  Accion="ValidarFechaCarga";
  $.ajax({
    url: "Ajax.php",
    type: "POST",
    datatype:"json",    
    async: false,
    data: {MoS:MoS,NombreMoS:NombreMoS,Accion:Accion},    
    success: function(data){
       rptavalidarfechacarga = data;
    }
  });
  return rptavalidarfechacarga;
}
///:::::::::::::::::::::: FIN DE VALIDAR FECHA ::::::::::::::::::::::::::::::::::::::::::::///