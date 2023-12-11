///::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
///:: CIERRE SEMANAL v 1.0 FECHA: 2023-06-23 ::::::::::::::::::::::::::::::::::::::::::::::///
///:: CREAR CIERRE SEMANAL DE OT CORRECTIVAS ::::::::::::::::::::::::::::::::::::::::::::::///
///::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///

///:: DECLARACION DE VARIABLES ::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
var anios_cierre_semanal, miCarpeta, otc_semana, ot_cierre_id, fila_cierre_semanal, select_html;    
miCarpeta = f_DocumentRoot();

///:: JS DOM CIERRE SEMANAL OT CORRECTIVAS ::::::::::::::::::::::::::::::::::::::::::::::::///
$(document).ready(function(){
  select_html = f_select_combo("Calendario", "SI", "Calendario_Anio", "", "`Calendario_Anio`>'2022'", "`Calendario_Anio` DESC");
  $("#select_anios_cierre_semanal").html(select_html);
  div_show = f_MostrarDiv("form_seleccion_cierre_semanal","btn_cierre_semanal","","");
  $("#div_btn_cierre_semanal").html(div_show);

  ///:: SELECCION DE AÑOS :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
  $("#select_anios_cierre_semanal").on('change', function () {
    $("#tabla_cierre_semanal").dataTable().fnDestroy();
    $('#tabla_cierre_semanal').hide();
    div_show = f_MostrarDiv("form_seleccion_cierre_semanal","btn_cierre_semanal","","");
    $("#div_btn_cierre_semanal").html(div_show);
  });

  $("#select_semana_cerrar").click(function(){
    $("#div_resultado_semana_cerrar").empty();
  });

  ///:: BOTONES DE CIERRE SEMANAL OT CORRECTIVAS ::::::::::::::::::::::::::::::::::::::::::///

  ///:: BOTON BUSCAR CIERRE SEMANAL OT CORRECTIVAS ::::::::::::::::::::::::::::::::::::::::///
  $(document).on("click", ".btn_buscar_cierre_semanal", function(){
    div_show = f_MostrarDiv("form_seleccion_cierre_semanal","btn_cierre_semanal","btn_generar_cierre_semanal","");
    $("#div_btn_cierre_semanal").html(div_show);
    div_tabla = f_CreacionTabla("tabla_cierre_semanal","");
    $("#div_tabla_cierre_semanal").html(div_tabla);
    columnastabla = f_ColumnasTabla("tabla_cierre_semanal","");

    anios_cierre_semanal = $("#select_anios_cierre_semanal").val();
    $("#tabla_cierre_semanal").dataTable().fnDestroy();
    $('#tabla_cierre_semanal').show();

    Accion='leer_cierre_semanal';
    tabla_cierre_semanal = $('#tabla_cierre_semanal').DataTable({
      language: idiomaEspanol,
      order: [[ 0, "desc" ]],
      responsive: "true",
      dom: 'Blfrtip', // Con Botones Excel,Pdf,Print
      buttons:[
                {
                  extend:     'excelHtml5',
                  text:       '<i class="fas fa-file-excel"></i> ',
                  titleAttr:  'Exportar a Excel',
                  className:  'btn btn-success',
                  title       : 'CIERRE SEMANAL OT CORRECTIVAS'
                },
              ],
      "ajax"      :{            
        "url"     : "Ajax.php", 
        "method"  : 'POST', //usamos el metodo POST
        "data"    : {MoS:MoS,NombreMoS:NombreMoS,Accion:Accion,anios_cierre_semanal:anios_cierre_semanal}, //enviamos opcion 4 para que haga un SELECT
        "dataSrc" : ""
      },
      "columns": columnastabla
    }); 
  });
  ///:: FIN BOTON BUSCAR CIERRE SEMANAL OT CORRECTIVAS ::::::::::::::::::::::::::::::::::::///

  ///:: BOTON GENERAR CIERRE SEMANAL ::::::::::::::::::::::::::::::::::::::::::::::::::::::///
  $(document).on("click", ".btn_generar_cierre_semanal", function(){
    anios_cierre_semanal = $("#select_anios_cierre_semanal").val();
    select_html = f_select_combo("Calendario","SI","Calendario_Semana","","`Calendario_Anio`='"+anios_cierre_semanal+"'","`Calendario_Semana` DESC");
    $("#form_cierre_semanal").trigger("reset");
    $("#div_resultado_semana_cerrar").empty();
    $(".modal-header").css( "background-color", "#17a2b8");
    $(".modal-header").css( "color", "white" );
    $(".modal-title").text("Generar Cierre Semanal");
    $('#modal_crud_cierre_semanal').modal('show');	    
    $("#select_semana_cerrar").html(select_html);
  });
  ///:: FIN BOTON GENERAR CIERRE SEMANAL ::::::::::::::::::::::::::::::::::::::::::::::::::///

  ///:: BOTON CERRAR SEMANA OT CORRECTIVAS ::::::::::::::::::::::::::::::::::::::::::::::::///
  $('#form_cierre_semanal').submit(function(e){                         
    let validar_estado  = ""; 
    let validar_semana  = ""; 
    let validar_cierre  = "";
    let t_html          = "";
    e.preventDefault();
    otc_semana = $('#select_semana_cerrar').val();
    
    validar_estado = f_validar_estado_cerrado("manto_ot", otc_semana, "CERRADO");
    if(validar_estado!="0"){
      t_html          = "Existen "+validar_estado+" OTs que no estan CERRADAS !!! <br>";
      //validar_cierre  = "invalido";
    }

    validar_estado = f_validar_estado_cerrado("manto_vales", otc_semana, "CERRADO");
    if(validar_estado!="0"){
      t_html          = t_html + "Existen "+validar_estado+" Vales que no estan CERRADOS !!! <br>";
      //validar_cierre  = "invalido";
    }

    validar_semana = f_validar_semana("manto_ot_cierre",`otc_semana`,otc_semana);
    if(validar_semana!="0"){
      t_html          = t_html + "Cierre de la Semana "+otc_semana+" se encuentra generado !!!";
      //validar_cierre  = "invalido";
    }

    if(validar_cierre==""){
      Accion = 'generar_cierre_semanal';
      $("#btn_cerrar_semana").prop("disabled",true);
      $.ajax({
        url: "Ajax.php",
        type: "POST",
        datatype:"json",    
        data:  { MoS:MoS,NombreMoS:NombreMoS,Accion:Accion,otc_semana:otc_semana },    
        beforeSend: function () {
          $("#div_resultado_semana_cerrar").html("Procesando, espere por favor...<img src='Services/PlantillaTemplon/View/Img/loading5.gif' width='20' height='20'>");
        },
        success: function(data) {
          $("#div_resultado_semana_cerrar").html(data);
          tabla_cierre_semanal.ajax.reload(null, false);
          $("#btn_cerrar_semana").prop("disabled",false);
        }
      });  
    }else{
      Swal.fire({
        icon  : 'error',
        title : 'NO ES POSIBLE CERRAR...',
        html  : t_html,
      })
    }
  });
  ///:: FIN BOTON CERRAR SEMANA OT CORRECTIVAS ::::::::::::::::::::::::::::::::::::::::::::///

  ///:: BOTON ABRIR SEMANA CERRADA OT CORRECTIVAS :::::::::::::::::::::::::::::::::::::::::///
  $(document).on("click", ".btn_abrir_semana", function(){
    let rpta_cierre_semanal="";
    fila_cierre_semanal = $(this);           
    ot_cierre_id        = $(this).closest('tr').find('td:eq(0)').text();     
    otc_semana          = $(this).closest('tr').find('td:eq(1)').text();
    csot_estado         = $(this).closest('tr').find('td:eq(8)').text();
  
    if(csot_estado == 'CERRADO') {
      Swal.fire({
        title: '¿Está seguro?',
        text: "Se abrirá el registro "+ot_cierre_id+" | "+otc_semana+"!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si, Abrir!'
      }).then((result) => {
        if(result.isConfirmed)
        {
          Swal.fire(
              'Abierto!',
              'El registro ha sido abierto.',
              'success'
          )
          Accion = 'abrir_semana';
          rpta_cierre_semanal = "ABRIR";
          if(rpta_cierre_semanal=="ABRIR")
          {            
            $.ajax({
              url       : "Ajax.php",
              type      : "POST",
              datatype  : "json",    
              data      : { MoS:MoS,NombreMoS:NombreMoS,Accion:Accion,ot_cierre_id:ot_cierre_id},   
              success   : function() {
                tabla_cierre_semanal.ajax.reload(null, false);
              }
            });
          }
        }
      });
    }else{
      Swal.fire({
        icon: 'error',
        title: 'ABRIR...',
        text: '*Solo se pueden abrir las semanas CERRADAS!'
      })
    }
  });
  ///:: FIN BOTON ABRIR SEMANA CERRADA OT CORRECTIVAS :::::::::::::::::::::::::::::::::::::///
 
  ///:: TERMINO BOTONES DE CIERRE SEMANAL OT CORRECTIVAS ::::::::::::::::::::::::::::::::::///

});
///:: TERMINO JS DOM CIERRE SEMANAL OT CORRECTIVAS ::::::::::::::::::::::::::::::::::::::::///

///:: FUNCIONES CIERRE SEMANAL OT CORRECTIVAS :::::::::::::::::::::::::::::::::::::::::::::///

function f_validar_estado_cerrado(p_tabla, p_semana, p_estado){
  let rpta_validar_estado = "";
  Accion = 'validar_estado_cerrado';
  $.ajax({
    url       : "Ajax.php",
    type      : "POST",
    datatype  : "json",
    async     : false,
    data      : { MoS:MoS, NombreMoS:NombreMoS, Accion:Accion, tabla:p_tabla, semana:p_semana, estado:p_estado },   
    success   : function(data) {
      rpta_validar_estado = data;
    }
  });
  return rpta_validar_estado;
}

function f_validar_semana(p_tabla, p_campo_semana, p_semana){
  let rpta_validar_semana = "";
  Accion = 'validar_semana';
  $.ajax({
    url       : "Ajax.php",
    type      : "POST",
    datatype  : "json",
    async     : false,
    data      : { MoS:MoS, NombreMoS:NombreMoS, Accion:Accion, tabla:p_tabla, campo_semana:p_campo_semana, semana:p_semana},   
    success   : function(data) {
      rpta_validar_semana = data
    }
  });
  return rpta_validar_semana;
}

///:: FUNCIONES CIERRE SEMANAL OT CORRECTIVAS :::::::::::::::::::::::::::::::::::::::::::::///