///::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
///:: CARGAR REPUESTOS PROVEEDOR v 1.0 FECHA: 24-01-2024 ::::::::::::::::::::::::::::::::::///
///:: CARGAR TABLA DE REPUESTOS PROVEEDOR :::::::::::::::::::::::::::::::::::::::::::::::::///
///::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///

///:: Declaracion de Variables ::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
var tabla_repuesto_proveedor_carga, rpc_anio, opcion_rpc, fila_rpc, select_rpc;
var rpc_fecha_carga, rpc_id;
let rpc_prov_ruc, rpc_prov_razon_social, fecha_hoy;

///:: JS DOM CARGAR REPUESTOS PROVEEDOR :::::::::::::::::::::::::::::::::::::::::::::::::::///
$(document).ready(function(){
  fecha_hoy = f_CalculoFecha("hoy","0");
  rpc_anio = fecha_hoy.substring(0,4);
  select_rpc = f_select_combo("Calendario", "SI", "Calendario_Anio", "", "`Calendario_Anio`>'2023'", "`Calendario_Anio` DESC");
  $("#rpc_anio").html(select_rpc);
  $("#rpc_anio").val(rpc_anio);

  $("#rpc_prov_razon_social").on('change',function(){
    rpc_prov_razon_social = $("#rpc_prov_razon_social").val();
    rpc_prov_ruc = f_buscar_dato("manto_proveedores", "prov_ruc", "`prov_razonsocial`='"+rpc_prov_razon_social+"'");
    $("#rpc_prov_ruc").val(rpc_prov_ruc);
  });

  ///:: Si hay cambios en el Fecha se ocultan botones y datatable :::::::::::::::::::::::::///
  $("#rpc_anio").on('change', function () {
    $("#tabla_repuesto_proveedor_carga").dataTable().fnDestroy();
    $('#tabla_repuesto_proveedor_carga').hide();  
  });

  ///:: Si hay cambios en el nombre del archivo a cargar se limpia el texto del resultado :///
  $("#file_rpc").click(function(){
    $("#div_resultado_repuesto_proveedor_carga").empty();
  });

  ///::::::::: COLOCA EL NOMBRE DEL ARCHIVO EN EL INPUT FILE
  $(document).on('click', '#file_rpc', function (event) {
    let nombre_archivo = "Seleccionar Archivo .csv o .xlsx";
    $("#label_file_rpc").text(nombre_archivo);
  }); 

  $(document).on('change', '#file_rpc', function (event) {
    let nombre_archivo = event.target.files[0].name;
    let extension = nombre_archivo.split('.').pop();
    $("#label_file_rpc").text(nombre_archivo);
  }); 

  ///:: BOTONES DE CARGAR REPUESTOS POR PROVEEDOR :::::::::::::::::::::::::::::::::::::::::///

  ///:: BOTON BUSCAR CARGA DE REPUESTOS POR PROVEEDOR :::::::::::::::::::::::::::::::::::::///
  $("#btn_buscar_repuesto_proveedor_carga").on("click",function(){
    rpc_anio = $("#rpc_anio").val();

    div_tabla = f_CreacionTabla("tabla_repuesto_proveedor_carga","");
    $("#div_tabla_repuesto_proveedor_carga").html(div_tabla);
    
    columnas_tabla = f_ColumnasTabla("tabla_repuesto_proveedor_carga","");
    $("#tabla_repuesto_proveedor_carga").dataTable().fnDestroy();
    $('#tabla_repuesto_proveedor_carga').show();

    Accion='leer_repuesto_proveedor_carga';
    
    tabla_repuesto_proveedor_carga = $('#tabla_repuesto_proveedor_carga').DataTable({
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
      pageLength  : 25,
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
          "data"  : {MoS:MoS, NombreMoS:NombreMoS, Accion:Accion, rpc_anio:rpc_anio},
          "dataSrc": ""
      },
      "columns" : columnas_tabla,
      "order"   : [[0, 'desc']]
    });     
  });
  ///:: FIN BOTON BUSCAR CARGA DE PRECIOS POR PROVEEDOR :::::::::::::::::::::::::::::::::::///

  ///:: EVENTO DEL BOTON NUEVO ::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
  $("#btn_cargar_repuesto_proveedor").click(function(){
    rpc_prov_ruc = "";
    rpc_prov_razon_social = "";

    select_rpc = f_select_combo("manto_proveedores", "NO", "prov_razonsocial", "", "`prov_estado`='ACTIVO'", "`prov_razonsocial` ASC");
    $("#rpc_prov_razon_social").html(select_rpc);
    $("#rpc_prov_ruc").val(rpc_prov_ruc);
    $("#rpc_prov_razon_social").val(rpc_prov_razon_social);

    opcion_rpc = 0;
    $("#div_resultado_repuesto_proveedor_carga").empty();
    $("#label_file_rpc").text("Seleccionar Archivo .csv o .xlsx");
    $("#form_rpc").trigger("reset");
    $(".modal-header").css( "background-color", "#17a2b8");
    $(".modal-header").css( "color", "white" );
    $(".modal-title").text("Nueva Carga");
    $('#modal_crud_rpc').modal('show');	    
  });
  ///:: FIN EVENTO DEL BOTON NUEVO ::::::::::::::::::::::::::::::::::::::::::::::::::::::::///

  ///:: BOTON BORRAR REGISTRO :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
  $(document).on("click", ".btn_eliminar_repuesto_proveedor_carga", function(){
    fila_rpc = $(this);           
    rpc_id = fila_rpc.closest('tr').find('td:eq(0)').text();
 
    Swal.fire({
      title             : '¿Está seguro?',
      text              : "Se eliminara el registro "+rpc_id+"!",
      icon              : 'warning',
      showCancelButton  : true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor : '#d33',
      confirmButtonText : 'Si, eliminar!',
      cancelButtonText  : 'Cancelar'
    }).then((result) => {
      if (result.isConfirmed) {
        // ELIMINAR REGISTRO DE REPUESTO PROVEEDOR CARGA
        Accion='eliminar_repuesto_proveedor_carga';
        $.ajax({
          url     : "Ajax.php",
          type    : "POST",
          datatype: "json",    
          data    : { MoS:MoS, NombreMoS:NombreMoS, Accion:Accion, rpc_id:rpc_id},   
          success: function() {
            tabla_repuesto_proveedor_carga.ajax.reload(null, false);
            Swal.fire(
              'Eliminado!',
              'El registro ha sido eliminado.',
              'success'
            )    
          }
        });
      }
    });
  });
  ///:: FIN BOTON BORRAR REGISTRO :::::::::::::::::::::::::::::::::::::::::::::::::::::::::///

    ///:: CREAR CARGAR PRECIOS POR PROVEEDOR ::::::::::::::::::::::::::::::::::::::::::::::::///
  $('#form_rpc').submit(function(e){
    e.preventDefault(); //evita el comportambiento normal del submit, es decir, recarga total de la página
    //:: Valida que exista el archivo Excel. 
    let opcion_cargar_excel = 1;
    let t_msg = "";
    rpc_prov_ruc = $("#rpc_prov_ruc").val();
    rpc_prov_razon_social = $("#rpc_prov_razon_social").val();
    rpc_anio = $("#rpc_anio").val();
    
    if(rpc_prov_razon_social===""){
      t_msg  = '*Requiere seleccionar un Proveedor!'
      opcion_cargar_excel = 0;
    }

    let f_Excel = document.getElementById('file_rpc').value;
        
    if(f_Excel.length===0){
      t_msg  += '<br>*Requiere archivo .cvs o .xlsx!'
      opcion_cargar_excel = 0;
    }
    
    if(opcion_cargar_excel === 0){
      Swal.fire({
        icon  : 'error',
        title : 'Información... ',
        html  : t_msg,
      })
      $("#div_resultado_repuesto_proveedor_carga").empty();
    }else{
      // Objeto FormData para enviar datos de al formulario   
      let form_repuesto_proveedor_carga = new FormData(); 
      let files_excel = $("#file_rpc")[0].files[0]; 
      form_repuesto_proveedor_carga.append('archivo_excel',files_excel);
      form_repuesto_proveedor_carga.append('MoS',MoS);
      form_repuesto_proveedor_carga.append('NombreMoS',NombreMoS);
      form_repuesto_proveedor_carga.append('Accion','crear_repuesto_proveedor_carga');
      form_repuesto_proveedor_carga.append('rpc_prov_ruc',rpc_prov_ruc);
      form_repuesto_proveedor_carga.append('rpc_prov_razon_social',rpc_prov_razon_social);
      $("#bnt_cargar_lista_repuesto_proveedor").prop("disabled",true);
      $.ajax({
        url         : "Ajax.php",
        type        : "POST",
        data        : form_repuesto_proveedor_carga,
        contentType : false,
        processData : false,
        beforeSend: function () {
          $("#div_resultado_repuesto_proveedor_carga").html("Procesando, espere por favor...<img src='Services/PlantillaTemplon/View/Img/loading5.gif' width='20' height='20'>");
        },
        success:function(resp){
          $("#div_resultado_repuesto_proveedor_carga").html(resp);
          tabla_repuesto_proveedor_carga.ajax.reload(null, false);
          $("#bnt_cargar_lista_repuesto_proveedor").prop("disabled",false);
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
function f_validar_rpc(){
  f_limpia_rpc();
  var respuesta="";    

    
  return respuesta; 
}
///:: FIN FUNCION PARA VALIDAR LOS DATOS INGRESADOS AL FORMULARIO :::::::::::::::::::::::::///

///:: REESTABLECE EL COLOR DE LOS CAMPOS DEL FORMULARIO :::::::::::::::::::::::::::::::::::/// 
function f_limpia_rpc(){

}
///:: FIN REESTABLECE EL COLOR DE LOS CAMPOS DEL FORMULARIO :::::::::::::::::::::::::::::::/// 

///:: TERMINO FUNCIONES DE CARGAR PRECIOS PROVEEDOR :::::::::::::::::::::::::::::::::::::::///