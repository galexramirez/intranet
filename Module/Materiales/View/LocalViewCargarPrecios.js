///::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
///:: CARGAR PRECIOS PROVEEDOR v 2.0 FECHA: 11-01-2024 ::::::::::::::::::::::::::::::::::::///
///:: CARGAR TABLA DE PRECIOS PROVEEDOR :::::::::::::::::::::::::::::::::::::::::::::::::::///
///::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///

///:: Declaracion de Variables ::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
var tablaCargarPrecios, selectAniosCargarPrecios, OpcionCargarPrecios, filaCargarPrecios, select_cpm;
var cpm_fechacarga, cpm_id;
let cpm_prov_ruc, cpm_prov_razon_social;

///:: JS DOM CARGAR PRECIOS PROVEEDOR :::::::::::::::::::::::::::::::::::::::::::::::::::::///
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

  $("#cpm_prov_razon_social").on('change',function(){
    cpm_prov_razon_social = $("#cpm_prov_razon_social").val();
    cpm_prov_ruc = f_buscar_dato("manto_proveedores", "prov_ruc", "`prov_razonsocial`='"+cpm_prov_razon_social+"'");
    $("#cpm_prov_ruc").val(cpm_prov_ruc);
  });

  ///:: Si hay cambios en el Fecha se ocultan botones y datatable :::::::::::::::::::::::::///
  $("#selectAniosCargarPrecios").on('change', function () {
    $("#tablaCargarPrecios").dataTable().fnDestroy();
    $('#tablaCargarPrecios').hide();  
  });

  ///:: Si hay cambios en el nombre del archivo a cargar se limpia el texto del resultado :///
  $("#fileCargarPrecios").click(function(){
    $("#div_ResultadoCargarPrecios").empty();
  });

  ///::::::::: COLOCA EL NOMBRE DEL ARCHIVO EN EL INPUT FILE
  $(document).on('click', '#fileCargarPrecios', function (event) {
    let NombreArch = "Seleccionar Archivo .csv o .xlsx";
    $("#LabelfileCargarPrecios").text(NombreArch);
  }); 

  $(document).on('change', '#fileCargarPrecios', function (event) {
    let NombreArch = event.target.files[0].name;
    let Extension = NombreArch.split('.').pop();
    $("#LabelfileCargarPrecios").text(NombreArch);
  }); 

  ///:: BOTONES DE CARGAR PRECIOS POR PROVEEDOR :::::::::::::::::::::::::::::::::::::::::::///

  ///:: BOTON BUSCAR CARGA DE PRECIOS POR PROVEEDOR :::::::::::::::::::::::::::::::::::::::///
  $("#btnBuscarCargarPrecios").on("click",function(){
    selectAniosCargarPrecios = $("#selectAniosCargarPrecios").val();

    div_tabla = f_CreacionTabla("tablaCargarPrecios","");
    $("#div_tablaCargarPrecios").html(div_tabla);
    columnas_tabla = f_ColumnasTabla("tablaCargarPrecios","");
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
      fixedColumns: {
        left: 1
      },
      fixedHeader : {
        header    : false
      },
      pageLength  : 50,
      language    : idioma_espanol, 
      responsive  : "true",
      dom         : 'Blfrtip',
      buttons     : [
        {
          extend    : 'excelHtml5',
          text      : '<i class="fas fa-file-excel"></i> ',
          titleAttr : 'Exportar a Excel',
          className : 'btn btn-success'
        },
      ],
      "ajax"      : {
          "url"   : "Ajax.php", 
          "method": 'POST', 
          "data"  : {MoS:MoS, NombreMoS:NombreMoS, Accion:Accion, Anios:selectAniosCargarPrecios},
          "dataSrc": ""
      },
      "columns" : columnas_tabla,
      "order"   : [[0, 'desc']]
    });     
  });
  ///:: FIN BOTON BUSCAR CARGA DE PRECIOS POR PROVEEDOR :::::::::::::::::::::::::::::::::::///

  ///:: EVENTO DEL BOTON NUEVO ::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
  $("#btnCargarLista").click(function(){
    cpm_prov_ruc = "";
    cpm_prov_razon_social = "";

    select_cpm = f_select_combo("manto_proveedores", "NO", "prov_razonsocial", "", "`prov_estado`='ACTIVO'", "`prov_razonsocial` ASC");
    $("#cpm_prov_razon_social").html(select_cpm);
    $("#cpm_prov_ruc").val(cpm_prov_ruc);
    $("#cpm_prov_razon_social").val(cpm_prov_razon_social);

    OpcionCargarPrecios = 0;
    $("#div_ResultadoCargarPrecios").empty();
    $("#LabelfileCargarPrecios").text("Seleccionar Archivo .csv o .xlsx");
    $("#formCargarPrecios").trigger("reset");
    $(".modal-header").css( "background-color", "#17a2b8");
    $(".modal-header").css( "color", "white" );
    $(".modal-title").text("Nueva Carga");
    $('#modalCRUDCargarPrecios').modal('show');	    
  });
  ///:: FIN EVENTO DEL BOTON NUEVO ::::::::::::::::::::::::::::::::::::::::::::::::::::::::///

  ///:: BOTON BORRAR REGISTRO :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
  $(document).on("click", ".btnEliminarCargarPrecios", function(){
    filaCargarPrecios = $(this);           
    cpm_id = filaCargarPrecios.closest('tr').find('td:eq(0)').text();
    let opcionBorrar = 0;
  
    ///:: VALIDAR FECHAS EN DETALLE DE OT PREVENTIVAS :::::::::::::::::::::::::::::::::::::///
    Accion = 'ValidarCargarPrecios'; 
    $.ajax({
      url     : "Ajax.php",
      type    : "POST",
      datatype: "json",
      async   : false,
      data    : { MoS:MoS, NombreMoS:NombreMoS, Accion:Accion, cpm_id:cpm_id},    
      success: function(data){
        if(data==false){
          opcionBorrar = 1;
        }
      }
    });
  
    if(opcionBorrar==1){
      Swal.fire({
        icon  : 'error',
        title : 'ELIMINAR',
        text  : 'El registro no puede ser eliminado, debido a que la fecha de sus registros es menor a la fecha actual.',
      });
    }else{
      Swal.fire({
        title             : '¿Está seguro?',
        text              : "Se eliminara el registro "+cpm_id+"!",
        icon              : 'warning',
        showCancelButton  : true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor : '#d33',
        confirmButtonText : 'Si, eliminar!'
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
            url     : "Ajax.php",
            type    : "POST",
            datatype: "json",    
            data    : { MoS:MoS, NombreMoS:NombreMoS, Accion:Accion, cpm_id:cpm_id },    
            success : function(){
            }
          });
          // ELIMINAR REGISTRO DE CARGAR PRECIOS PROVEEDOR
          Accion='EliminarCargarPreciosProveedor';
          $.ajax({
            url     : "Ajax.php",
            type    : "POST",
            datatype: "json",    
            data    : { MoS:MoS, NombreMoS:NombreMoS, Accion:Accion, cpm_id:cpm_id},   
            success: function() {
              tablaCargarPrecios.ajax.reload(null, false);
            }
          });
        }
      });
    }
  });
  ///:: FIN BOTON BORRAR REGISTRO :::::::::::::::::::::::::::::::::::::::::::::::::::::::::///

  
  ///:: CREAR CARGAR PRECIOS POR PROVEEDOR ::::::::::::::::::::::::::::::::::::::::::::::::///
  $('#formCargarPrecios').submit(function(e){
    e.preventDefault(); //evita el comportambiento normal del submit, es decir, recarga total de la página
    //:: Valida que exista el archivo Excel. 
    let opcionCargarExcel = 1;
    let t_msg = "";
    cpm_prov_ruc = $("#cpm_prov_ruc").val();
    cpm_prov_razon_social = $("#cpm_prov_razon_social").val();
    if(cpm_prov_razon_social===""){
      t_msg  = '*Requiere seleccionar un Proveedor!'
      opcionCargarExcel = 0;
    }

    let f_Excel = document.getElementById('fileCargarPrecios').value;
    let anioCarga = $("#selectAniosCargarPrecios").val();
    
    if(f_Excel.length===0){
      t_msg  += '<br>*Requiere archivo .cvs o .xlsx!'
      opcionCargarExcel = 0;
    }
    
    if(opcionCargarExcel === 0){
      Swal.fire({
        icon  : 'error',
        title : 'Información... ',
        html  : t_msg,
      })
      $("#div_ResultadoCargarPrecios").empty();
    }else{
      // Objeto FormData para enviar datos de al formulario   
      let formUsuarios = new FormData(); 
      let filesexcel = $("#fileCargarPrecios")[0].files[0]; 
      formUsuarios.append('archivoexcel',filesexcel);
      formUsuarios.append('MoS',MoS);
      formUsuarios.append('NombreMoS',NombreMoS);
      formUsuarios.append('Accion','CrearCargarPrecios');
      formUsuarios.append('Anio',anioCarga);
      formUsuarios.append('cpm_prov_ruc',cpm_prov_ruc);
      formUsuarios.append('cpm_prov_razon_social',cpm_prov_razon_social);
      formUsuarios.append('Anio',anioCarga);
      $("#bntCargarListaPrecios").prop("disabled",true);
      $.ajax({
        url         : "Ajax.php",
        type        : "POST",
        data        : formUsuarios,
        contentType : false,
        processData : false,
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
  ///:: FIN CREAR CARGAR PRECIOS POR PROVEEDOR ::::::::::::::::::::::::::::::::::::::::::::///

  ///:: TERMINO BOTONES DE CARGAR PRECIOS POR PROVEEDOR :::::::::::::::::::::::::::::::::::///

});    
///:: TERMINO JS DOM CARGAR PRECIOS PROVEEDOR :::::::::::::::::::::::::::::::::::::::::::::///

///:: FUNCIONES DE CARGAR PRECIOS PROVEEDOR :::::::::::::::::::::::::::::::::::::::::::::::///

///:: FUNCION PARA VALIDAR LOS DATOS INGRESADOS AL FORMULARIO :::::::::::::::::::::::::::::///
function f_validar_cargar_precios(){
  f_limpia_cargar_precios();
  var respuesta="";    

    
  return respuesta; 
}
///:: FIN FUNCION PARA VALIDAR LOS DATOS INGRESADOS AL FORMULARIO :::::::::::::::::::::::::///

///:: REESTABLECE EL COLOR DE LOS CAMPOS DEL FORMULARIO :::::::::::::::::::::::::::::::::::/// 
function f_limpia_cargar_precios(){

}
///:: FIN REESTABLECE EL COLOR DE LOS CAMPOS DEL FORMULARIO :::::::::::::::::::::::::::::::/// 

///:: TERMINO FUNCIONES DE CARGAR PRECIOS PROVEEDOR :::::::::::::::::::::::::::::::::::::::///