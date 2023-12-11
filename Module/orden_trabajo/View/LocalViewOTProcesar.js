///::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
///:: PROCESAR OT CORRECTIVAS v 3.0 FECHA: 14-06-2023 :::::::::::::::::::::::::::::::::::::///
///:: EDITAR TABLA DE OT CORRECTIVAS ::::::::::::::::::::::::::::::::::::::::::::::::::::::///
///::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///

///:: DECLARACION DE VARIABLES ::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
var ot_id, ot_origen, ot_bus, ot_kilometraje, ot_date_crea, ot_date_ct, ot_asociado, ot_hmotor, ot_cgm_crea, ot_cgm_ct, ot_estado, ot_resp_asoc, ot_descrip, ot_tecnico, ot_check, ot_obs_cgm, ot_sistema, ot_inicio, ot_fin, ot_codfalla, ot_at, ot_obs_asoc, ot_montado, ot_dmontado, ot_busmont, ot_busdmont, ot_motivo, ot_obs_aom, ot_ca, ot_date_ca, ot_componente_raiz, ot_obs_aom2, ot_accidentes_id, ot_semana_cierre, ot_cod_vinculada;
var opcionOT;

///:: JS DOM OT CORRECTIVAS :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
$(document).ready(function(){
  $("#formProcesarOT").hide();

  // Si hay cambios en el codigo OT se oculta el form
  $("#ot_id").on('change', function () {
    $("#formProcesarOT").hide();
  });

  $("#ot_fin").on('change', function () {
    ot_fin = $("#ot_fin").val();
    ot_bus = $("#ot_bus").val();
    f_CalculoKilometraje(ot_bus,ot_fin);
  });

  /// Si hay cambios en el origen OT
  $("#ot_origen").on('change', function () {
    ot_origen = $("#ot_origen").val();
    if(ot_origen=="Accidente (A)"){
      $("#ot_accidentes_id").prop("disabled",false);
    }else{
      ot_accidentes_id = "";
      $("#ot_accidentes_id").val(ot_accidentes_id);
      $("#ot_accidentes_id").prop("disabled",true);
    }
  });

  $("#ot_id").keypress(function(event) {
    if (event.keyCode === 13 && $("#ot_id").val().length>0) {
      $("#btnCargarOT").focus();
    }
  });

  $("#ot_asociado").on("change",function(){
    ot_asociado = $("#ot_asociado").val();
    ot_tecnico = $("#ot_tecnico").val();
    
    // SE CARGA EL COMBO CON TODOS LOS TECNICOS DEL ASOCIADO
    Accion='SelectTecnico';
    $.ajax({
      url: "Ajax.php",
      type: "POST",
      datatype:"json",
      async: false,
      data: {MoS:MoS,NombreMoS:NombreMoS,Accion:Accion,ot_asociado:ot_asociado},    
      success: function(data){
        $("#ot_tecnico").html(data);
        $("#ot_resp_asoc").html(data);
      }
    });
    // SE PRECARGA EL PRIMER TECNICO DEL ASOCIADO
    if(ot_tecnico==null || ot_tecnico==""){
      Accion='BuscarTecnico';
      $.ajax({
        url: "Ajax.php",
        type: "POST",
        datatype:"json",
        async: false,
        data: {MoS:MoS,NombreMoS:NombreMoS,Accion:Accion,ot_asociado:ot_asociado},    
        success: function(data){
          ot_tecnico = data;
        }
      });
      $("#ot_tecnico").val(ot_tecnico);
      $("#ot_resp_asoc").val(ot_tecnico);
    }
    tabla_horas_tecnicos
    .rows()
    .remove()
    .draw();

  });

  ///:: BOTONES DE OT CORRECTIVAS :::::::::::::::::::::::::::::::::::::::::::::::::::::::::///

  ///:: BOTON CARGA DE OT CORRECTIVAS :::::::::::::::::::::::::::::::::::::::::::::::::::::///
  $("#btnCargarOT").on("click",function(){
    let semana_estado = "";
    f_CargarVariablesVacioOT(); //Se inicializan las variables en vacio, se cargan en blanco
    $("#ot_accidentes_id").prop("disabled",true);
    opcionOT = 0; //1=CREAR 2=EDITAR
    ot_id = $("#ot_id").val();
  
    if(ot_id==""){
      $("#ot_id").focus();
      Swal.fire({
        position: 'center',
        icon: 'warning',
        title: 'Ingresar N° OT !!!',
        showConfirmButton: false,
        timer: 1500
      })
      opcionOT=0;
    }else{
      f_combos_selects_ot();
      Accion = 'CargarOT';
      $.ajax({
        url: "Ajax.php",
        type: "POST",
        datatype:"json",
        async: false,    
        data: {MoS:MoS,NombreMoS:NombreMoS,Accion:Accion,ot_id:ot_id},    
        success: function(data){
          data = $.parseJSON(data);
          f_CargarVariablesOT(data);
          if(ot_estado!=""){    
            opcionOT = 2;
            // SE CARGA EL COMBO CON TODOS LOS TECNICOS DEL ASOCIADO
            Accion='SelectTecnico';
            $.ajax({
              url: "Ajax.php",
              type: "POST",
              datatype:"json",
              async: false,
              data: {MoS:MoS,NombreMoS:NombreMoS,Accion:Accion,ot_asociado:ot_asociado},    
              success: function(data){
                $("#ot_tecnico").html(data);
                $("#ot_resp_asoc").html(data);
              }
            });
            // SE PRECARGA EL PRIMER TECNICO DEL ASOCIADO
            if(ot_tecnico==null || ot_tecnico==""){
              Accion='BuscarTecnico';
              $.ajax({
                url: "Ajax.php",
                type: "POST",
                datatype:"json",
                async: false,
                data: {MoS:MoS,NombreMoS:NombreMoS,Accion:Accion,ot_asociado:ot_asociado},    
                success: function(data){
                  ot_tecnico = data;
                }
              });
              $("#ot_tecnico").val(ot_tecnico);
            }
            if(ot_origen=="Accidente (A)"){
              $("#ot_accidentes_id").prop("disabled",false);
            }
            $("#formProcesarOT").show();
            $("#ot_origen").focus().select();
            f_CargaVariablesHtmlOT();
            // SE CARGAN LOS VALES VINCULADOS A LA OT
            Accion='CargarVales';
            $.ajax({
              url: "Ajax.php",
              type: "POST",
              datatype:"json",
              async: false,
              data: {MoS:MoS,NombreMoS:NombreMoS,Accion:Accion,ot_id:ot_id},    
              success: function(data){
                $("#div_vales").html(data);
              }
            });
            semana_estado = f_validar_semana_cerrada(ot_semana_cierre);
            div_show = f_MostrarDiv("formProcesarOT","btn_guardar_ot",semana_estado,"");
            $("#div_btn_guardar_ot").html(div_show);
          }else{
            Swal.fire({
              title: '¿Está seguro de crear?',
              html: "Se creará la OT N° : "+ot_id+" !!!",
              icon: 'warning',
              showCancelButton: true,
              cancelButtonColor: '#d33',
              cancelButtonText: 'Cancelar',
              confirmButtonColor: '#3085d6',
              confirmButtonText: 'Si, crear!',
              focusConfirm: true
            }).then((result) => 
            {
              if(result.isConfirmed){
                opcionOT = 1;
                $("#formProcesarOT").show();
                $("#ot_origen").focus().select();
                f_CargaVariablesHtmlOT();
              }
            });
            div_show = f_MostrarDiv("formProcesarOT","btn_guardar_ot","","");
            $("#div_btn_guardar_ot").html(div_show);    
          }
        }
      });
      f_tabla_horas_tecnicos(ot_id);
    }
  });
  ///:: FIN DE BOTON CARGA DE OT CORRECTIVAS ::::::::::::::::::::::::::::::::::::::::::::::///

  ///:: BOTON GUARDAR OT CORRECTIVAS ::::::::::::::::::::::::::::::::::::::::::::::::::::::///
  $(document).on("click", ".btnGuardarOT", function(){
    let bvalidarOT    = "";
    let bvalidarKm    = "NO";
    let rptaGuardarOT = "";
    let mensajekm     = "";
    let mensajeEstado = "";
    let mensajeinfo   = "";
    let mensajeip     = "";
    let mensaje_ot_vinculada = "";
    let tmsg          = "";
    let t_html        = "";
    let a_data        = [];
    let array_data    = [];
    ot_id            = $("#ot_id").val();
    f_LimpiaMsOT();
    f_CargarVariablesEditadasOT();
    array_horas_tecnicos = tabla_horas_tecnicos.rows().data().toArray();

    if(ot_estado==""){
      rptaGuardarOT = "invalido";
      mensajeEstado = "*El estado de la OT no puede ser vacio";
      $("#ot_estado").addClass("color-error");
    }

    if(ot_date_crea==""){
      rptaGuardarOT = "invalido";
      mensajeinfo   = "*Falta completar información";
      $("#ot_date_crea").addClass("color-error");
    }

    if(ot_estado=="CERRADO"){
      bvalidarOT = f_validarOT(ot_id, ot_origen, ot_bus, ot_kilometraje, ot_date_crea, ot_asociado, ot_hmotor, ot_cgm_crea, ot_cgm_ct, ot_estado, ot_resp_asoc, ot_descrip, ot_tecnico,  ot_check, ot_obs_cgm, ot_sistema, ot_inicio, ot_fin, ot_codfalla, ot_at, ot_obs_asoc, ot_montado, ot_dmontado, ot_busmont, ot_busdmont, ot_motivo, ot_componente_raiz, ot_obs_aom2, ot_semana_cierre);
      bvalidarKm = f_validarKm(ot_bus,ot_fin,ot_kilometraje);
    
      if(bvalidarOT!=""){
        mensajeinfo   = '*Es posible que algún campo su información no sea la correcta!'
        rptaGuardarOT = 'invalido';
      }
    
      if(bvalidarKm=="NO"){
        mensajekm     = "*El kilometraje ingresado no corresponde!";
        rptaGuardarOT = 'invalido';
        $("#ot_kilometraje").addClass("color-error");
      }
    }

    if(ot_estado=="ABIERTO"){
      mensajeEstado = "*El estado de la OT Correctiva es ABIERTO!";
    }

    if(ot_origen=="Accidente (A)"){
      if(ot_accidentes_id!=''){
        a_data = f_BuscarDataBD("OPE_AccidentesInformePreliminar", "Accidentes_Id", ot_accidentes_id);
        if(a_data.length==0){
          mensajeip     = "*El N° IP no existe!!!";
          //rptaGuardarOT = 'invalido';
          $("#ot_accidentes_id").addClass("color-error");  
        }
      }else{
        mensajeip     = "*El N° IP debe ser registrado!!!";
        //rptaGuardarOT = 'invalido';
        $("#ot_accidentes_id").addClass("color-error");
      }
    }

    if(ot_cod_vinculada!=''){
      a_data = f_BuscarDataBD("manto_ot", "ot_id", ot_cod_vinculada);
      if(a_data.length==0){
        mensaje_ot_vinculada = "*El N° OT Vinculada no existe!!!";
        //rptaGuardarOT = 'invalido';
        $("#ot_cod_vinculada").addClass("color-error");  
      }
    }

    if(mensajeinfo!=""){
      tmsg = tmsg+"<br>"+mensajeinfo;
    }
    if(mensajekm!=""){
      tmsg = tmsg+"<br>"+mensajekm;
    }
    if(mensajeEstado!=""){
      tmsg = tmsg+"<br>"+mensajeEstado;
    }
    if(mensajeip!=""){
      tmsg = tmsg+"<br>"+mensajeip;
    }
    if(mensaje_ot_vinculada!=""){
      tmsg = tmsg+"<br>"+mensaje_ot_vinculada;
    }

    if(rptaGuardarOT==""){
      if(opcionOT==1){
        Accion = 'CrearOT';
      }else{
        Accion = 'EditarOT';
      }
      if(tmsg!=""){
        t_html = "Ten en cuenta que:"+tmsg+" !!!";
      }
      Swal.fire({
        title             : '¿Está seguro de guardar?',
        html              : t_html,
        icon              : 'warning',
        showCancelButton  : true,
        cancelButtonColor : '#d33',
        cancelButtonText  : 'Cancelar',
        confirmButtonColor: '#3085d6',
        confirmButtonText : 'Si, guardar!',
        focusCancel       : true
      }).then((result) => 
      {
        if(result.isConfirmed){
          $("#bntGuardarOT").prop("disabled",true);
          array_data = JSON.stringify(array_horas_tecnicos);
          $.ajax({
            url: "Ajax.php",
            type: "POST",
            datatype:"json",
            async: false,
            data: {MoS:MoS,NombreMoS:NombreMoS,Accion:Accion, ot_id:ot_id, ot_origen:ot_origen, ot_bus:ot_bus, ot_kilometraje:ot_kilometraje, ot_date_crea:ot_date_crea,  ot_date_ct:ot_date_ct, ot_asociado:ot_asociado, ot_hmotor:ot_hmotor, ot_cgm_crea:ot_cgm_crea, ot_cgm_ct:ot_cgm_ct, ot_estado:ot_estado, ot_resp_asoc:ot_resp_asoc,   ot_descrip:ot_descrip, ot_tecnico:ot_tecnico, ot_obs_cgm:ot_obs_cgm, ot_check:ot_check, ot_sistema:ot_sistema, ot_inicio:ot_inicio, ot_fin:ot_fin, ot_codfalla:ot_codfalla,   ot_at:ot_at, ot_obs_asoc:ot_obs_asoc, ot_montado:ot_montado, ot_dmontado:ot_dmontado, ot_busmont:ot_busmont, ot_busdmont:ot_busdmont, ot_motivo:ot_motivo,  ot_obs_aom:ot_obs_aom, ot_ca:ot_ca, ot_date_ca:ot_date_ca, ot_componente_raiz:ot_componente_raiz, ot_obs_aom2:ot_obs_aom2, ot_accidentes_id:ot_accidentes_id, ot_semana_cierre:ot_semana_cierre, ot_cod_vinculada:ot_cod_vinculada, array_data:array_data},
            success: function(data){

            }
          });
          Swal.fire({
            position: 'center',
            icon: 'success',
            title: 'El registro ha sido grabado.',
            showConfirmButton: false,
            timer: 1500
          })      
          $("#formProcesarOT").hide();
          ot_id = "";
          $("#ot_id").val(ot_id);
          $("#ot_id").focus();
          ot_observadas = f_ot_observadas();
          $("#ot_alerta").html(ot_observadas);      
        }
      });
      $("#bntGuardarOT").prop("disabled",false);
    }else{
      Swal.fire({
        icon: 'error',
        title: 'NO ES POSIBLE GUARDAR...',
        html: "Ten en cuenta que: "+tmsg+" !!!",
      })
    }
  });
  ///:: FIN DE BOTON GUARDAR OT CORRECTIVAS :::::::::::::::::::::::::::::::::::::::::::::::///

  ///:: BOTON CANCELAR OT CORRECTIVAS :::::::::::::::::::::::::::::::::::::::::::::::::::::///
  $(document).on("click", ".btn_cancelar_ot", function(){
    $("#formProcesarOT").hide();
    ot_id = "";
    $("#ot_id").val(ot_id);
    $("#ot_id").focus();
  });
  ///:: BOTON CANCELAR OT CORRECTIVAS :::::::::::::::::::::::::::::::::::::::::::::::::::::///

  ///:: EVENTO DEL BOTON VER LOG OT CORRECTIVAS :::::::::::::::::::::::::::::::::::::::::::///
  $("#btnLogOT").click(function(){
    $("#formModalLogOT").trigger("reset");
    $("#div_logOT").html(ot_obs_aom);
    $(".modal-header").css( "background-color", "#17a2b8");
    $(".modal-header").css( "color", "white" );
    $(".modal-title").text("Log");
    $('#modalCRUDLogOT').modal('show');
  });
  ///:: FIN DE EVENTO DEL BOTON VER LOG OT CORRECTIVAS ::::::::::::::::::::::::::::::::::::///
  
  ///:: EVENTO DEL BOTON VER PROCESAR OT CORRECTIVAS ::::::::::::::::::::::::::::::::::::::///
  $("#btn_procesar_ver_ot").click(function(){
    $("#form_modal_ver_ot").trigger("reset");
    ot_id = $("#ot_id").val();
      Accion = 'ver_ot';
      $.ajax({
        url: "Ajax.php",
        type: "POST",
        datatype:"json",
        async: false,    
        data: {MoS:MoS,NombreMoS:NombreMoS,Accion:Accion,ot_id:ot_id},    
        success: function(data){
          $("#div_ver_ot").html(data);
        }
      });
      f_tabla_ver_horas_tecnicos(ot_id);
      $(".modal-header").css( "background-color", "#17a2b8");
      $(".modal-header").css( "color", "white" );
      $(".modal-title").text("INFORMACION OTs CORRECTIVAS");
      $('#modal_crud_ver_ot').modal('show');
      $('#modal-resizable_ver_ot').resizable();
      $(".modal-dialog").draggable({
        cursor: "move",
        handle: ".dragable_touch",
      });        
  });
  ///:: FIN DE EVENTO DEL BOTON VER PROCESAR OT CORRECTIVAS :::::::::::::::::::::::::::::::///

});
///:: TERMINO JS DOM OT CORRECTIVAS :::::::::::::::::::::::::::::::::::::::::::::::::::::::///


///:: FUNCIONES DE OT CORRECTIVAS :::::::::::::::::::::::::::::::::::::::::::::::::::::::::///

///:: FUNCION PARA VALIDAR LOS DATOS INGRESADOS AL FORMULARIO :::::::::::::::::::::::::::::///
function f_validarOT(pot_id, pot_origen, pot_bus, pot_kilometraje, pot_date_crea, pot_asociado, pot_hmotor, pot_cgm_crea, pot_cgm_ct, pot_estado, pot_resp_asoc, pot_descrip, pot_tecnico, pot_check, pot_obs_cgm, pot_sistema, pot_inicio, pot_fin, pot_codfalla, pot_at, pot_obs_asoc, pot_montado, pot_dmontado, pot_busmont, pot_busdmont, pot_motivo, pot_componente_raiz, pot_obs_aom2, pot_accidentes_id, pot_semana_cierre, pot_cod_vinculada){
    f_LimpiaMsOT();
    let NoLetrasMayuscEspacio=/[^A-Z \Ñ]/;
    let rptaOT="";    
    let color_amarillo = "yellow"
/*
    if(pot_id==''){
      $("#ot_id").addClass("color-error");
      rptaOT="invalido";
    }

    if(pot_origen==''){
      $("#ot_origen").addClass("color-error");
      rptaOT="invalido";
    }
  
    if(pot_bus==''){
      $("#ot_bus").addClass("color-error");
      rptaOT="invalido";
    }
*/
    if(pot_kilometraje==''){
      $("#ot_kilometraje").addClass("color-error");
      rptaOT="invalido";
    }
/*
    if(pot_date_crea==''){
      $("#ot_date_crea").addClass("color-error");
      rptaOT="invalido";
    }

    if(pot_asociado==''){
      $("#ot_asociado").addClass("color-error");
      rptaOT="invalido";
    }

    if(pot_hmotor==''){
      $("#ot_hmotor").addClass("color-error");
      rptaOT="invalido";
    }

    if(pot_cgm_crea==''){
      $("#ot_cgm_crea").addClass("color-error");
      rptaOT="invalido";
    }

    if(pot_cgm_ct==''){
      $("#ot_cgm_ct").addClass("color-error");
      rptaOT="invalido";
    }
*/
    if(pot_estado==''){
      $("#ot_estado").addClass("color-error");
      rptaOT="invalido";
    }
/*
    if(pot_resp_asoc==''){
      $("#ot_resp_asoc").addClass("color-error");
      rptaOT="invalido";
    }
*/
    if(pot_descrip.length>100000){
      $("#ot_descrip").addClass("color-error");
      rptaOT="invalido";
    }
/*
    if(pot_tecnico==''){
      $("#ot_tecnico").addClass("color-error");
      rptaOT="invalido";
    }

    if(pot_check==''){
      $("#ot_check").addClass("color-error");
      rptaOT="invalido";
    }
*/
    if(pot_obs_cgm.length>1000){
      $("#ot_obs_cgm").addClass("color-error");
      rptaOT="invalido";
    }
/*
    if(pot_sistema==''){
      $("#ot_sistema").addClass("color-error");
      rptaOT="invalido";
    }
*/
    if(pot_inicio==''){
      $("#ot_inicio").addClass("color-error");
      rptaOT="invalido";
    }

    if(pot_fin==''){
      $("#ot_fin").addClass("color-error");
      rptaOT="invalido";
    }

    if(pot_inicio!='' && pot_fin!=''){
      if(f_MayorFecha(pot_inicio,pot_fin)=="NO"){
        $("#ot_inicio").addClass("color-error");
        rptaOT="invalido";
      }
    }

/*
    if(pot_codfalla==''){
      $("#ot_codfalla").addClass("color-error");
      rptaOT="invalido";
    }
*/
    if(pot_at.length>5000){
      $("#ot_at").addClass("color-error");
      rptaOT="invalido";
    }

    if(pot_obs_asoc.length>5000){
      $("#ot_obs_asoc").addClass("color-error");
      rptaOT="invalido";
    }
/*
    if(pot_montado==''){
      $("#ot_montado").addClass("color-error");
      rptaOT="invalido";
    }

    if(pot_dmontado==''){
      $("#ot_dmontado").addClass("color-error");
      rptaOT="invalido";
    }

    if(pot_busmont==''){
      $("#ot_busmont").addClass("color-error");
      rptaOT="invalido";
    }

    if(pot_busdmont==''){
      $("#ot_busdmont").addClass("color-error");
      rptaOT="invalido";
    }

    if(pot_motivo==''){
      $("#ot_motivo").addClass("color-error");
      rptaOT="invalido";
    }

    if(pot_componente_raiz==''){
      $("#ot_componente_raiz").addClass("color-error");
      rptaOT="invalido";
    }

    if(pot_obs_aom2==''){
      $("#ot_obs_aom2").addClass("color-error");
      rptaOT="invalido";
    }

    if(pot_accidentes_id==''){
      $("#ot_accidentes_id").addClass("color-error");
      rptaOT="invalido";
    }
    
    if(pot_semana_cierre==''){
      $("#ot_semana_cierre").addClass("color-error");
      rptaOT="invalido";
    }

    if(pot_cod_vinculada==''){
      $("#ot_cod_vinculada").addClass("color-error");
      rptaOT="invalido";
    }

*/     
    return rptaOT; 
}
///:: FIN DE FUNCION PARA VALIDAR LOS DATOS INGRESADOS AL FORMULARIO ::::::::::::::::::::::///

///:: MENSAJE DE ALERTA DEL FORMULARIO COLOR DE CAMPOS ::::::::::::::::::::::::::::::::::::/// 
function f_LimpiaMsOT(){
  $('#ot_id').removeClass("color-error");
  $('#ot_origen').removeClass("color-error");
  $('#ot_bus').removeClass("color-error");
  $('#ot_kilometraje').removeClass("color-error");
  $('#ot_date_crea').removeClass("color-error");
  $('#ot_date_ct').removeClass("color-error");
  $('#ot_asociado').removeClass("color-error");
  $('#ot_hmotor').removeClass("color-error");
  $('#ot_cgm_crea').removeClass("color-error");
  $('#ot_cgm_ct').removeClass("color-error");
  $('#ot_estado').removeClass("color-error");
  $('#ot_resp_asoc').removeClass("color-error");
  $('#ot_descrip').removeClass("color-error");
  $('#ot_tecnico').removeClass("color-error");
  $('#ot_check').removeClass("color-error");
  $('#ot_obs_cgm').css('background', 'white')
  $('#ot_sistema').removeClass("color-error");
  $('#ot_inicio').removeClass("color-error");
  $('#ot_fin').removeClass("color-error");
  $('#ot_codfalla').removeClass("color-error");
  $('#ot_at').removeClass("color-error");
  $('#ot_obs_asoc').removeClass("color-error");
  $('#ot_montado').removeClass("color-error");
  $('#ot_dmontado').removeClass("color-error");
  $('#ot_busmont').removeClass("color-error");
  $('#ot_busdmont').removeClass("color-error");
  $('#ot_motivo').removeClass("color-error");
  $('#ot_ca').removeClass("color-error");
  $('#ot_date_ca').removeClass("color-error");
  $('#ot_componente_raiz').removeClass("color-error");
  $('#ot_obs_aom2').removeClass("color-error");
  $("#ot_accidentes_id").removeClass("color-error");
  $("#ot_semana_cierre").removeClass("color-error");
  $("#ot_cod_vinculada").removeClass("color-error");
}
///:: FIN DE MENSAJE DE ALERTA DEL FORMULARIO COLOR DE CAMPOS :::::::::::::::::::::::::::::///

///:: SE CARGAN LAS VARIABLES CON LA INFORMACION DE LA BASE DE DATOS ::::::::::::::::::::::///
function f_CargarVariablesOT(p_data){
  $.each(p_data, function(idx, obj){ 
    ot_id              = obj.ot_id;
    ot_origen           = obj.ot_origen;
    ot_bus              = obj.ot_bus;
    ot_kilometraje      = obj.ot_kilometraje;
    ot_date_crea        = obj.ot_date_crea;
    ot_date_ct          = obj.ot_date_ct;
    ot_asociado         = obj.ot_asociado;
    ot_hmotor           = obj.ot_hmotor;
    ot_cgm_crea         = obj.ot_cgm_crea;
    ot_cgm_ct           = obj.ot_cgm_ct;
    ot_estado           = obj.ot_estado;
    ot_resp_asoc        = obj.ot_resp_asoc;
    ot_descrip          = obj.ot_descrip;
    ot_tecnico          = obj.ot_tecnico;
    ot_check            = obj.ot_check;
    ot_obs_cgm          = obj.ot_obs_cgm;
    ot_sistema          = obj.ot_sistema;
    ot_inicio           = obj.ot_inicio;
    ot_fin              = obj.ot_fin;
    ot_codfalla         = obj.ot_codfalla;
    ot_at               = obj.ot_at;
    ot_obs_asoc         = obj.ot_obs_asoc;
    ot_montado          = obj.ot_montado;
    ot_dmontado         = obj.ot_dmontado;
    ot_busmont          = obj.ot_busmont;
    ot_busdmont         = obj.ot_busdmont;
    ot_motivo           = obj.ot_motivo;
    ot_obs_aom          = obj.ot_obs_aom;
    ot_ca               = obj.ot_ca;
    ot_date_ca          = obj.ot_date_ca;
    ot_componente_raiz  = obj.ot_componente_raiz;
    ot_accidentes_id    = obj.ot_accidentes_id;
    ot_semana_cierre    = obj.ot_semana_cierre;
    ot_cod_vinculada    = obj.ot_cod_vinculada;
  });
}
///:: FIN DE SE CARGAN LAS VARIABLES CON LA INFORMACION DE LA BASE DE DATOS :::::::::::::::///
  
///:: SE INICIALIZAN LAS VARIABLES DE LA OT CORRECTIVA ::::::::::::::::::::::::::::::::::::///
function f_CargarVariablesVacioOT(){
  f_LimpiaMsOT();
  ot_id              = '';
  ot_origen           = '';
  ot_bus              = '';
  ot_kilometraje      = '';
  ot_date_crea        = '';
  ot_date_ct          = '';
  ot_asociado         = '';
  ot_hmotor           = '';
  ot_cgm_crea         = '';
  ot_cgm_ct           = '';
  ot_estado           = '';
  ot_resp_asoc        = '';
  ot_descrip          = '';
  ot_tecnico          = '';
  ot_check            = '';
  ot_obs_cgm          = '';
  ot_sistema          = '';
  ot_inicio           = '';
  ot_fin              = '';
  ot_codfalla         = '';
  ot_at               = '';
  ot_obs_asoc         = '';
  ot_montado          = '';
  ot_dmontado         = '';
  ot_busmont          = '';
  ot_busdmont         = '';
  ot_motivo           = '';
  ot_obs_aom          = '';
  ot_ca               = '';
  ot_date_ca          = '';
  ot_componente_raiz  = '';
  ot_obs_aom2         = '';
  ot_accidentes_id    = '';
  ot_semana_cierre    = '';
  ot_cod_vinculada    = '';
}
///:: FIN DE SE INICIALIZAN LAS VARIABLES DE LA OT CORRECTIVA :::::::::::::::::::::::::::::///

///:: SE CARGAN LAS VARIABLES HTML CON LA INFORMACION :::::::::::::::::::::::::::::::::::::///
function f_CargaVariablesHtmlOT(){
  let html="";

  Accion='Origenes';
  $.ajax({
      url: "Ajax.php",
      type: "POST",
      datatype:"json",
      async: false,
      data: {MoS:MoS,NombreMoS:NombreMoS,Accion:Accion, ot_origen:ot_origen},    
      success: function(data){
          $("#ot_origen").html(data);
      }
  });

  $('#ot_id').val(ot_id);
  $('#ot_origen').val(ot_origen);
  $('#ot_bus').val(ot_bus);
  $('#ot_kilometraje').val(ot_kilometraje);
  $('#ot_date_crea').val(ot_date_crea);
  $('#ot_date_ct').val(ot_date_ct);
  $('#ot_asociado').val(ot_asociado);
  $('#ot_hmotor').val(ot_hmotor);
  $('#ot_cgm_crea').val(ot_cgm_crea);
  $('#ot_cgm_ct').val(ot_cgm_ct);
  $('#ot_estado').val(ot_estado);
  $('#ot_resp_asoc').val(ot_resp_asoc);
  $('#ot_descrip').val(ot_descrip);
  $('#ot_tecnico').val(ot_tecnico);
  $('#ot_check').val(ot_check);
  $('#ot_obs_cgm').val(ot_obs_cgm);
  $('#ot_sistema').val(ot_sistema);
  $('#ot_inicio').val(ot_inicio);
  $('#ot_fin').val(ot_fin);
  $('#ot_codfalla').val(ot_codfalla);
  $('#ot_at').val(ot_at);
  $('#ot_obs_asoc').val(ot_obs_asoc);
  $('#ot_montado').val(ot_montado);
  $('#ot_dmontado').val(ot_dmontado);
  $('#ot_busmont').val(ot_busmont);
  $('#ot_busdmont').val(ot_busdmont);
  $('#ot_motivo').val(ot_motivo);
  //$('#ot_obs_aom').val(ot_obs_aom);
  $('#ot_ca').val(ot_ca);
  $('#ot_date_ca').val(ot_date_ca);
  $('#ot_componente_raiz').val(ot_componente_raiz);
  $('#ot_obs_aom2').val(ot_obs_aom2);
  $("#ot_accidentes_id").val(ot_accidentes_id);
  $("#ot_semana_cierre").val(ot_semana_cierre);
  $("#ot_cod_vinculada").val(ot_cod_vinculada);

  // Se calcula el rango del kilometraje
  if(ot_bus!="" && ot_fin!=null){
    f_CalculoKilometraje(ot_bus,ot_fin);
  }

  // Se cargan los div
  html = f_MostrarDiv("formProcesarOT","div_CodigoOT",ot_id,"");
  $("#div_CodigoOT").html(html);
  html = f_MostrarDiv("formProcesarOT","div_ot_estadoactual",ot_estado,"");
  $("#div_ot_estadoactual").html(html);
  html = f_MostrarDiv("formProcesarOT","div_ot_ca",ot_ca+" EL "+ot_date_ca,"");
  $("#div_ot_ca").html(html);
  html = f_MostrarDiv("formProcesarOT","div_ot_date_ct",ot_date_ct,"");
  $("#div_ot_date_ct").html(html);
  //$("#div_ot_obs_aom").html(ot_obs_aom);
}
///:: FIN DE SE CARGAN LAS VARIABLES HTML CON LA INFORMACION ::::::::::::::::::::::::::::::///

///:: SE CARGAN LAS VARIABLES CON LOS VALORES EDITADOS ::::::::::::::::::::::::::::::::::::///
function f_CargarVariablesEditadasOT(){
  ot_id              = $.trim($('#ot_id').val());
  ot_origen           = $.trim($('#ot_origen').val());
  ot_bus              = $.trim($('#ot_bus').val());
  ot_kilometraje      = $.trim($('#ot_kilometraje').val());
  ot_date_crea        = $.trim($('#ot_date_crea').val());
  ot_date_ct          = $.trim($('#ot_date_ct').val());
  ot_asociado         = $.trim($('#ot_asociado').val());
  ot_hmotor           = $.trim($('#ot_hmotor').val());
  ot_cgm_crea         = $.trim($('#ot_cgm_crea').val());
  ot_cgm_ct           = $.trim($('#ot_cgm_ct').val());
  ot_estado           = $.trim($('#ot_estado').val());
  ot_resp_asoc        = $.trim($('#ot_resp_asoc').val());
  ot_descrip          = $.trim($('#ot_descrip').val());
  ot_tecnico          = $.trim($('#ot_tecnico').val());
  ot_check            = $.trim($('#ot_check').val());
  ot_obs_cgm          = $.trim($('#ot_obs_cgm').val());
  ot_sistema          = $.trim($('#ot_sistema').val());
  ot_inicio           = $.trim($('#ot_inicio').val());
  ot_fin              = $.trim($('#ot_fin').val());
  ot_codfalla         = $.trim($('#ot_codfalla').val());
  ot_at               = $.trim($('#ot_at').val());
  ot_obs_asoc         = $.trim($('#ot_obs_asoc').val());
  ot_montado          = $.trim($('#ot_montado').val());
  ot_dmontado         = $.trim($('#ot_dmontado').val());
  ot_busmont          = $.trim($('#ot_busmont').val());
  ot_busdmont         = $.trim($('#ot_busdmont').val());
  ot_motivo           = $.trim($('#ot_motivo').val());
  ot_ca               = $.trim($('#ot_ca').val());
  ot_date_ca          = $.trim($('#ot_date_ca').val());
  ot_componente_raiz  = $.trim($('#ot_componente_raiz').val());
  ot_obs_aom2         = $.trim($('#ot_obs_aom2').val());
  ot_accidentes_id    = $.trim($('#ot_accidentes_id').val());
  ot_semana_cierre    = $.trim($('#ot_semana_cierre').val());
  ot_cod_vinculada    = $.trim($('#ot_cod_vinculada').val());
}
///:: FIN DE SE CARGAN LAS VARIABLES CON LOS VALORES EDITADOS :::::::::::::::::::::::::::::///

///:: CALCULO DE KM DEL DIA ANTERIOR Y DEL DIA FINAL:::::::::::::::::::::::::::::::::::::::///
function f_CalculoKilometraje(pot_bus,pot_inicio){
  let kmhtml = "";
  if(pot_inicio.length>0){
    pot_inicio = pot_inicio.substring(0,10);
    if(pot_inicio!="0000-00-00"){
      Accion='CalculoKilometraje';
      $.ajax({
        url: "Ajax.php",
        type: "POST",
        datatype:"json",
        async: false,
        data: {MoS:MoS,NombreMoS:NombreMoS,Accion:Accion,ot_bus:pot_bus,ot_inicio:pot_inicio},    
        success: function(data){
          kmhtml = data;
        },
      });
    }
  }
  $("#div_KmComparacion").html(kmhtml);
}
///:: FIN DE CALCULO DE KM DEL DIA ANTERIOR Y DEL DIA FINAL::::::::::::::::::::::::::::::::///

///:: VALIDA EL KM REALIZADO ::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
function f_validarKm(pot_bus,pot_inicio,pot_kilometraje){
  let rptakm = "";
  if(pot_inicio.length>0){
    pot_inicio = pot_inicio.substring(0,10);
    if(pot_inicio!="0000-00-00"){
      Accion='ValidarKm';
      $.ajax({
        url: "Ajax.php",
        type: "POST",
        datatype:"json",
        async: false,
        data: {MoS:MoS,NombreMoS:NombreMoS,Accion:Accion,ot_bus:pot_bus,ot_inicio:pot_inicio,ot_kilometraje:pot_kilometraje},    
        success: function(data){
          rptakm = data;
        },
      });
    }
  }
  return rptakm;
}
///:: FIN DE VALIDA EL KM REALIZADO :::::::::::::::::::::::::::::::::::::::::::::::::::::::///

///:: FUNCION DE PERMITE CREAR UNA OT :::::::::::::::::::::::::::::::::::::::::::::::::::::///
function f_PreguntaCrear(pot_id){
  let rptaPreguntaCrear = 0;
  Swal.fire({
    title: '¿Está seguro de crear?',
    html: "Se creará la OT N° : "+pot_id+" !!!",
    icon: 'warning',
    showCancelButton: true,
    cancelButtonColor: '#d33',
    cancelButtonText: 'Cancelar',
    confirmButtonColor: '#3085d6',
    confirmButtonText: 'Si, crear!',
    focusConfirm: true
  }).then((result) => 
  {
    if(result.isConfirmed){
      rptaPreguntaCrear = 1;
   }
  });
  return rptaPreguntaCrear;
}
///:: FIN DE FUNCION DE PERMITE CREAR UNA OT ::::::::::::::::::::::::::::::::::::::::::::::///

///:: FUNCION QUE CARGA LOS COMBOS DE SELECTS :::::::::::::::::::::::::::::::::::::::::::::///
function f_combos_selects_ot()
{
  // Cargamos los buses
  Accion='BusesOT';
  $.ajax({
      url: "Ajax.php",
      type: "POST",
      datatype:"json",
      async: false,
      data: {MoS:MoS,NombreMoS:NombreMoS,Accion:Accion},    
      success: function(data){
          $("#ot_bus").html(data);
          $("#ot_busmont").html(data);
          $("#ot_busdmont").html(data);
      }
  });

  // Cargamos Asociados
  Accion='AsociadoOT';
  $.ajax({
      url: "Ajax.php",
      type: "POST",
      datatype:"json",
      async: false,
      data: {MoS:MoS,NombreMoS:NombreMoS,Accion:Accion},    
      success: function(data){
          $("#ot_asociado").html(data);
      }
  });

  Accion='Origenes';
  ot_origen="";
  $.ajax({
      url: "Ajax.php",
      type: "POST",
      datatype:"json",
      async: false,
      data: {MoS:MoS,NombreMoS:NombreMoS,Accion:Accion,ot_origen:ot_origen},    
      success: function(data){
          $("#ot_origen").html(data);
      }
  });

  Accion='SelectUsuario';
  Usua_Perfil = 'CGM';
  $.ajax({
    url: "Ajax.php",
    type: "POST",
    datatype:"json",
    async: false,
    data: {MoS:MoS,NombreMoS:NombreMoS,Accion:Accion,Usua_Perfil:Usua_Perfil},    
    success: function(data){
      $("#ot_cgm_crea").html(data);
      $("#ot_cgm_ct").html(data);
    }
  });

  // COMBOS DE TABLA TIPO OTCORRECTIVAS
  Operacion='OTCORRECTIVAS';
  Tipo='ESTADO';
  selectHtmlOT="";
  selectHtmlOT = f_TipoTabla(Operacion,Tipo);
  $("#ot_estado").html(selectHtmlOT);

  Tipo='SISTEMA';
  selectHtmlOT="";
  selectHtmlOT = f_TipoTabla(Operacion,Tipo);
  $("#ot_sistema").html(selectHtmlOT);

  Tipo='CHECK';
  selectHtmlOT="";
  selectHtmlOT = f_TipoTabla(Operacion,Tipo);
  $("#ot_check").html(selectHtmlOT);

  selectHtmlOT = f_select_combo("Calendario", "SI", "Calendario_Semana", "", "", "`Calendario_Semana` DESC");
  $("#ot_semana_cierre").html(selectHtmlOT);
}
///:: FIN DE FUNCION QUE CARGA LOS COMBOS DE SELECTS ::::::::::::::::::::::::::::::::::::::///

function f_validar_semana_cerrada(p_semana){
  let a_data;
  let rpta="";
  a_data = f_BuscarDataBD("manto_ot_cierre", "otc_semana", p_semana);
  $.each(a_data, function(idx, obj){ 
    rpta = obj.otc_estado;
  });
  return rpta;  
}
///:: TERMINO DE FUNCIONES DE OT CORRECTIVAS ::::::::::::::::::::::::::::::::::::::::::::::///