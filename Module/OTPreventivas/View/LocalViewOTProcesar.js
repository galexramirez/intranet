///::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
///:::::::::: PROCESAR OT PREVENTIVAS v 1.0 FECHA: 13-05-2022 :::::::::::::::::::///
//::::::::::::::::::  EDITAR TABLA DE OT PREVENTIVAS ::::::::::::::::::::::::::::///
///::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///

///:::::::::::::::::::::::: Declaracion de Variables ::::::::::::::::::::::::::::///
var cod_otpv, otpv_semana, otpv_turno, otpv_date_prog, otpv_bus, otpv_fecuencia, otpv_descripcion, otpv_asociado, otpv_genera, otpv_date_genera, otpv_estado, otpv_cgm_cierra, otpv_tecnico, otpv_inicio, otpv_fin, otpv_kmrealiza, otpv_hmotor, otpv_componente, otpv_obs_as, otpv_obs_cgm,  otpv_cierra_ad, otpv_date_cierra_ad, otpv_obs_cierre_ad, otpv_obs_km, otpv_obs_cierre_ad2, selectotpv_estado;

///::::::::::::::: JS CARGA DE DATA TABLE :::::::::::::://
$(document).ready(function(){
  $("#formProcesarOTPrv").hide();

  // Si hay cambios en el codigo OT se oculta el form
  $("#cod_otpv").on('change', function () {
    $("#formProcesarOTPrv").hide();
  });

  $("#otpv_inicio").on('change', function () {
    otpv_inicio = $("#otpv_inicio").val();
    f_CalculoKilometraje(otpv_bus,otpv_inicio);
  });

  $("#otpv_asociado").on('change', function () {
    otpv_asociado = $("#otpv_asociado").val();
    t_html = f_select_combo("manto_resp_asociado","NO","ra_nombres","","`ra_asociado`='"+otpv_asociado+"'");
    $("#otpv_tecnico").html(t_html);
    otpv_tecnico = "";
    $("#otpv_tecnico").val(otpv_tecnico);
  })

  Accion='SelectUsuario';
  Usua_Perfil = 'CGM';
  $.ajax({
    url: "Ajax.php",
    type: "POST",
    datatype:"json",
    async: false,
    data: {MoS:MoS,NombreMoS:NombreMoS,Accion:Accion,Usua_Perfil:Usua_Perfil},    
    success: function(data){
      $("#otpv_cgm_cierra").html(data);
    }
  });

  // COMBOS DE TABLA TIPO OTPREVENTIVAS
  Operacion='OTPREVENTIVAS';
  Tipo='ESTADO';
  selectHtmlOTPrv="";
  selectHtmlOTPrv = f_TipoTabla(Operacion,Tipo);
  $("#selectotpv_estado").html(selectHtmlOTPrv);

  $("#cod_otpv").keypress(function(event) {
    if (event.keyCode === 13 && $("#cod_otpv").val().length>0) {
      $("#btnCargarOTPrv").focus();
    }
  });

  $("#idProcesar").on("click",function(){
    $("#cod_otpv").select().focus();
  });

  ///::::::::::::::::::: EVENTO DEL BOTON VER LOG OTPrv ::::::::::::::::::::::::::::::::///
  $("#btnLogOTPrv").click(function(){
    $("#formModalLogOTPrv").trigger("reset");
    $("#div_log").html(otpv_obs_cierre_ad);
    $(".modal-header").css( "background-color", "#17a2b8");
    $(".modal-header").css( "color", "white" );
    $(".modal-title").text("Log");
    $('#modalCRUDLogOTPrv').modal('show');
  });
  ///:::::::::::::::::::::: TERMINO BOTON VER LOG PEDIDO :::::::::::::::::::::::::::::::///

  ///::::::::::::::::::: EVENTO DEL BOTON VER PROCESAR OT PREVENTIVAS ::::::::::::::::///
  $("#btn_procesar_ver_otprv").click(function(){
    cod_otpv = $("#cod_otpv").val();
    $("#form_modal_ver_otprv").trigger("reset");
      Accion = 'ver_ot_prv';
      $.ajax({
        url     : "Ajax.php",
        type    : "POST",
        datatype:"json",
        async   : false,    
        data    : {MoS:MoS,NombreMoS:NombreMoS,Accion:Accion,cod_ot_prv:cod_otpv},    
        success: function(data){
          $("#div_ver_otprv").html(data);
        }
      });
      $(".modal-header").css( "background-color", "#17a2b8");
      $(".modal-header").css( "color", "white" );
      $(".modal-title").text("INFORMACION OTs PREVENTIVAS");
      $('#modal_crud_ver_otprv').modal('show');
      $('#modal-resizable_ver_otprv').resizable();
      $(".modal-dialog").draggable({
        cursor: "move",
        handle: ".dragable_touch",
      });        
  });
  ///:::::::::::::::::::::: TERMINO BOTON VER OT :::::::::::::::::::::::::::::::::::::::///

});    

///::::::::::::::::::::::::: BOTONES DE OT PREVENTIVAS :::::::::::::::::::::///

///:::::::::::::::::::::::: JS DATA TABLE OT PREVENTIVAS ::::::::::::::::::::::::::::::::::///
$("#btnCargarOTPrv").on("click",function(){
  let htmlcod_otpv=""
  let select_combo  = "";
  cod_otpv = $("#cod_otpv").val();
  otpv_estado = "";
  f_LimpiaMsOTPrv();

  select_combo = f_select_combo("manto_tipotablaotpreventivas","NO","TtablaOTPreventivas_Detalle","","`TtablaOTPreventivas_Tipo`='TURNO' AND TtablaOTPreventivas_Operacion='OTPREVENTIVAS'");
  $("#otpv_turno").html(select_combo);
  select_combo = f_select_combo("Buses","NO","Bus_NroExterno","","`Bus_NroExterno`!=''");
  $("#otpv_bus").html(select_combo);
  //select_combo = f_select_combo("manto_tipotablaotpreventivas","NO","TtablaOTPreventivas_Detalle","","`TtablaOTPreventivas_Tipo`='FRECUENCIA' AND TtablaOTPreventivas_Operacion='OTPREVENTIVAS'");
  //$("#otpv_fecuencia").html(select_combo);

  if(cod_otpv!=""){
    // Cargamos las variables en blanco
    f_CargarVariablesVacioOTPrv();
    Accion = 'CargarOTPrv';
    $.ajax({
      url: "Ajax.php",
      type: "POST",
      datatype:"json",
      async: false,    
      data: {MoS:MoS,NombreMoS:NombreMoS,Accion:Accion,cod_otpv:cod_otpv},    
      success: function(data){
        data = $.parseJSON(data);
        f_CargarVariablesOTPrv(data);
      }
    });
  }

  select_combo = f_select_combo("manto_resp_asociado","SI","ra_asociado",otpv_asociado,"`ra_asociado`!=''");
  $("#otpv_asociado").html(select_combo);

  if(otpv_estado==""){
    cod_otpv = "";
    $("#cod_otpv").val(cod_otpv);
    $("#cod_otpv").focus();
    Swal.fire({
      position: 'center',
      icon: 'warning',
      title: 'NO ENCONTRADO!',
      showConfirmButton: false,
      timer: 1500
    })      
  }else{
    // SE CARGA EL COMBO CON TODOS LOS TECNICOS DEL ASOCIADO
    Accion='SelectTecnico';
    $.ajax({
      url: "Ajax.php",
      type: "POST",
      datatype:"json",
      async: false,
      data: {MoS:MoS,NombreMoS:NombreMoS,Accion:Accion,otpv_asociado:otpv_asociado},    
      success: function(data){
        $("#otpv_tecnico").html(data);
      }
    });
    // SE PRECARGA EL PRIMER TECNICO DEL ASOCIADO
    if(otpv_tecnico==null || otpv_tecnico==""){
      Accion='BuscarTecnico';
      $.ajax({
        url: "Ajax.php",
        type: "POST",
        datatype:"json",
        async: false,
        data: {MoS:MoS,NombreMoS:NombreMoS,Accion:Accion,otpv_asociado:otpv_asociado},    
        success: function(data){
          otpv_tecnico = data;
        }
      });
      $("#otpv_tecnico").val(otpv_tecnico);
    }
    $("#formProcesarOTPrv").show();
    htmlcod_otpv = "<h3>Código OT: P-"+cod_otpv+"</h3>";
    $("#div_CodigoOT").html(htmlcod_otpv);
    $("#otpv_tecnico").focus().select();
    f_CargaVariablesHtmlOTPrv();
  }

});

///:::::::::::::::::::::::: JS DATA TABLE OTPREVENTIVAS ::::::::::::::::::::::::::::::::::///
$("#btnGuardarOTPrv").on("click",function(){
  let bvalidarOTPrv="";
  let bvalidarKm="NO";
  let rptaGuardar = 0;
  let mensajekm = "";
  let mensajeEstado = "";
  let mensajeinfo = "";
  cod_otpv = $("#cod_otpv").val();
  
  f_CargarVariablesEditadasOTPrv();
  bvalidarOTPrv = f_validarOTPrv(otpv_cgm_cierra, otpv_tecnico, otpv_inicio, otpv_fin, otpv_kmrealiza, otpv_hmotor, otpv_obs_as, otpv_obs_cgm, otpv_obs_cierre_ad2);
  bvalidarKm = f_validarKm(otpv_bus,otpv_inicio,otpv_kmrealiza);

  if(selectotpv_estado=="CERRADO"){
    if(bvalidarOTPrv!=""){
      mensajeinfo= '*Es posible que algún campo su información no sea la correcta!'
      rptaGuardar = 1;
    }
  
    if(bvalidarKm=="NO"){
      mensajekm = "*El kilometraje ingresado no corresponde!";
      if(selectotpv_estado=="CERRADO"){
        $("#otpv_kmrealiza").css("background", "yellow" );
        rptaGuardar = 1;
      }
    }
      
    if(selectotpv_estado=="ABIERTO"){
      mensajeEstado = "*El estado de la OT Preventiva es ABIERTO!";
    }
    
    if(rptaGuardar==0){
      if(mensajekm!="" || mensajeEstado!=""){
        tmsg = "";
        if(mensajekm!=""){
          tmsg = tmsg+"<br>"+mensajekm;
        }
        if(mensajeEstado!=""){
          tmsg = tmsg+"<br>"+mensajeEstado;
        }
    
        Swal.fire({
          title: '¿Está seguro de guardar?',
          html: "Ten en cuenta que:"+tmsg+" !!!",
          icon: 'warning',
          showCancelButton: true,
          cancelButtonColor: '#d33',
          cancelButtonText: 'Cancelar',
          confirmButtonColor: '#3085d6',
          confirmButtonText: 'Si, guardar!',
          focusCancel: true
        }).then((result) => 
        {
          if(result.isConfirmed){
            $("#bntGuardarOTPrv").prop("disabled",true);
            // Cargamos las variables en blanco
            Accion = 'EditarOTPrv';
            $.ajax({
              url: "Ajax.php",
              type: "POST",
              datatype:"json",
              async: true,
              //await: true,
              data: {MoS:MoS,NombreMoS:NombreMoS,Accion:Accion,cod_otpv:cod_otpv,otpv_cgm_cierra:otpv_cgm_cierra, otpv_tecnico:otpv_tecnico, otpv_inicio:otpv_inicio, otpv_fin:otpv_fin, otpv_kmrealiza:otpv_kmrealiza, otpv_hmotor:otpv_hmotor, otpv_componente:otpv_componente, otpv_obs_as:otpv_obs_as, otpv_obs_cgm:otpv_obs_cgm, otpv_obs_cierre_ad:otpv_obs_cierre_ad, otpv_obs_cierre_ad2:otpv_obs_cierre_ad2, otpv_obs_km:otpv_obs_km, otpv_estado:selectotpv_estado, otpv_turno:otpv_turno, otpv_date_prog:otpv_date_prog, otpv_bus:otpv_bus, otpv_fecuencia:otpv_fecuencia, otpv_descripcion:otpv_descripcion, otpv_asociado:otpv_asociado },
              success: function(data){
                if(data.length>0){
                  Swal.fire({
                    position: 'center',
                    icon: 'error',
                    title: data
                  })
                }else{
                  Swal.fire({
                    position: 'center',
                    icon: 'success',
                    title: 'El registro ha sido grabado.',
                    showConfirmButton: false,
                    timer: 1500
                  })
                  otprv_observadas = f_otprv_observadas();
                  $("#otprv_alerta").html(otprv_observadas);        
                  $("#formProcesarOTPrv").hide();
                  cod_otpv = "";
                  $("#cod_otpv").val(cod_otpv);
                  $("#cod_otpv").focus();        
                }
                $("#bntGuardarOTPrv").prop("disabled",false);
              }
            });
         }
        });
      }else{
        $("#bntGuardarOTPrv").prop("disabled",true);
        // Cargamos las variables en blanco
        Accion = 'EditarOTPrv';
        $.ajax({
          url: "Ajax.php",
          type: "POST",
          datatype:"json",
          async: false,
          data: {MoS:MoS,NombreMoS:NombreMoS,Accion:Accion,cod_otpv:cod_otpv,otpv_cgm_cierra:otpv_cgm_cierra, otpv_tecnico:otpv_tecnico, otpv_inicio:otpv_inicio, otpv_fin:otpv_fin, otpv_kmrealiza:otpv_kmrealiza, otpv_hmotor:otpv_hmotor, otpv_componente:otpv_componente, otpv_obs_as:otpv_obs_as, otpv_obs_cgm:otpv_obs_cgm, otpv_obs_cierre_ad:otpv_obs_cierre_ad, otpv_obs_cierre_ad2:otpv_obs_cierre_ad2, otpv_obs_km:otpv_obs_km, otpv_estado:selectotpv_estado, otpv_turno:otpv_turno, otpv_date_prog:otpv_date_prog, otpv_bus:otpv_bus, otpv_fecuencia:otpv_fecuencia, otpv_descripcion:otpv_descripcion, otpv_asociado:otpv_asociado },    
          success: function(data){
            if(data.length>0){
              Swal.fire({
                position: 'center',
                icon: 'error',
                title: data
              })
            }else{
              Swal.fire({
                position: 'center',
                icon: 'success',
                title: 'El registro ha sido grabado.',
                showConfirmButton: false,
                timer: 1500
              })      
              $("#formProcesarOTPrv").hide();
              cod_otpv = "";
              $("#cod_otpv").val(cod_otpv);
              $("#cod_otpv").focus();      
            }
            $("#bntGuardarOTPrv").prop("disabled",false);
          }
        });
      }
    }else{
      tmsg = "";
      if(mensajeinfo!=""){
        tmsg = tmsg+"<br>"+mensajeinfo;
      }
      if(mensajekm!=""){
        tmsg = tmsg+"<br>"+mensajekm;
      }
      if(mensajeEstado!=""){
        tmsg = tmsg+"<br>"+mensajeEstado;
      }
      Swal.fire({
        icon: 'error',
        title: 'NO ES POSIBLE GUARDAR...',
        html: "Ten en cuenta que: "+tmsg+" !!!",
      })
    }
  }else{
    Swal.fire({
      title: '¿Está seguro de guardar?',
      html: "La OT en un estado diferente a CERRADO !!!",
      icon: 'warning',
      showCancelButton: true,
      cancelButtonColor: '#d33',
      cancelButtonText: 'Cancelar',
      confirmButtonColor: '#3085d6',
      confirmButtonText: 'Si, guardar!',
      focusCancel: true
    }).then((result) => 
    {
      if(result.isConfirmed){
        $("#bntGuardarOTPrv").prop("disabled",true);
        // Cargamos las variables en blanco
        Accion = 'EditarOTPrv';
        $.ajax({
          url: "Ajax.php",
          type: "POST",
          datatype:"json",
          async: false,
          data: {MoS:MoS,NombreMoS:NombreMoS,Accion:Accion,cod_otpv:cod_otpv,otpv_cgm_cierra:otpv_cgm_cierra, otpv_tecnico:otpv_tecnico, otpv_inicio:otpv_inicio, otpv_fin:otpv_fin, otpv_kmrealiza:otpv_kmrealiza, otpv_hmotor:otpv_hmotor, otpv_componente:otpv_componente, otpv_obs_as:otpv_obs_as, otpv_obs_cgm:otpv_obs_cgm, otpv_obs_cierre_ad:otpv_obs_cierre_ad, otpv_obs_cierre_ad2:otpv_obs_cierre_ad2, otpv_obs_km:otpv_obs_km, otpv_estado:selectotpv_estado, otpv_turno:otpv_turno, otpv_date_prog:otpv_date_prog, otpv_bus:otpv_bus, otpv_fecuencia:otpv_fecuencia, otpv_descripcion:otpv_descripcion, otpv_asociado:otpv_asociado },    
          success: function(data){
            if(data.length>0){
              Swal.fire({
                position: 'center',
                icon: 'error',
                title: data
              })
            }else{
              Swal.fire({
                position: 'center',
                icon: 'success',
                title: 'El registro ha sido grabado.',
                showConfirmButton: false,
                timer: 1500
              })
              otprv_observadas = f_otprv_observadas();
              $("#otprv_alerta").html(otprv_observadas);          
              $("#formProcesarOTPrv").hide();
              cod_otpv = "";
              $("#cod_otpv").val(cod_otpv);
              $("#cod_otpv").focus();      
            }
            $("#bntGuardarOTPrv").prop("disabled",false);
          }
        });
     }
    });
  }
});

///::::::::::::::::::::::::::::::::: FUNCIONES DE OT PREVENTIVAS ::::::::::::::::::::::::::::::::::::///

///::::::::::::::: FUNCION PARA VALIDAR LOS DATOS INGRESADOS AL FORMULARIO :::::::::::::::::::///
function f_validarOTPrv(potpv_cgm_cierra, potpv_tecnico, potpv_inicio, potpv_fin, potpv_kmrealiza, potpv_hmotor, potpv_obs_as, potpv_obs_cgm, potpv_obs_cierre_ad2){
    f_LimpiaMsOTPrv();
    let NoLetrasMayuscEspacio=/[^A-Z \Ñ]/;
    let rptaOTPrv="";

    if(potpv_obs_as.length > 12000){
      $("#otpv_obs_as").addClass("color-error");
      rptaOTPrv="invalido";
    }
  
    if(potpv_obs_cgm.length > 4000){
      $("#otpv_obs_cgm").addClass("color-error");
      rptaOTPrv="invalido";
    }

    if(potpv_inicio==""){
      $("#otpv_inicio").addClass("color-error");
      rptaOTPrv="invalido";
    }
  
    if(potpv_fin==""){
      $("#otpv_fin").addClass("color-error");
      rptaOTPrv="invalido";
    }
  
    if(potpv_fin < potpv_inicio){
      $("#otpv_inicio").addClass("color-error");
      rptaOTPrv="invalido";
    }

    if(potpv_kmrealiza==""){
      $("#otpv_kmrealiza").addClass("color-error");
      rptaOTPrv="invalido";
    }

    return rptaOTPrv; 
}

///::::::::: INVISIBILIZA LOS MENSAJE DE ALERTA DEL FORMULARIO :::::: /// 
function f_LimpiaMsOTPrv(){
  $("#otpv_obs_as").removeClass("color-error");
  $("#otpv_obs_cgm").removeClass("color-error");
  $("#otpv_inicio").removeClass("color-error");
  $("#otpv_fin").removeClass("color-error");
  $("#otpv_kmrealiza").removeClass("color-error");
}

///::::::::::: SE CARGAN LAS VARIABLES CON LA INFORMACION DE LA BASE DE DATOS ::::::::::::///
function f_CargarVariablesOTPrv(p_data){
  $.each(p_data, function(idx, obj){ 
    otpv_semana         = obj.otpv_semana;
    otpv_turno          = obj.otpv_turno;
    otpv_date_prog      = obj.otpv_date_prog;
    otpv_bus            = obj.otpv_bus;
    otpv_fecuencia      = obj.otpv_fecuencia;
    otpv_descripcion    = obj.otpv_descripcion;
    otpv_asociado       = obj.otpv_asociado;
    otpv_genera         = obj.otpv_genera;
    otpv_date_genera    = obj.otpv_date_genera;
    otpv_estado         = obj.otpv_estado;
    otpv_cgm_cierra     = obj.otpv_cgm_cierra;
    otpv_tecnico        = obj.otpv_tecnico;
    otpv_inicio         = obj.otpv_inicio;
    otpv_fin            = obj.otpv_fin;
    otpv_kmrealiza      = obj.otpv_kmrealiza;
    otpv_hmotor         = obj.otpv_hmotor;
    otpv_componente     = obj.otpv_componente;
    otpv_obs_as         = obj.otpv_obs_as;
    otpv_obs_cgm        = obj.otpv_obs_cgm;
    otpv_cierra_ad      = obj.otpv_cierra_ad;
    otpv_date_cierra_ad = obj.otpv_date_cierra_ad;
    otpv_obs_cierre_ad  = obj.otpv_obs_cierre_ad;
    otpv_obs_km         = obj.otpv_obs_km;
    selectotpv_estado   = obj.otpv_estado;
  });
}
  
///::::::::::: SE INICIALIZAN LAS VARIABLES DE LA OT PREVENTIVA ::::::::::::///
function f_CargarVariablesVacioOTPrv(){
//cod_otpv = ""; 
  otpv_semana         = ""; 
  otpv_turno          = ""; 
  otpv_date_prog      = ""; 
  otpv_bus            = ""; 
  otpv_fecuencia      = ""; 
  otpv_descripcion    = ""; 
  otpv_asociado       = ""; 
  otpv_genera         = ""; 
  otpv_date_genera    = ""; 
  otpv_estado         = ""; 
  otpv_cgm_cierra     = ""; 
  otpv_tecnico        = ""; 
  otpv_inicio         = ""; 
  otpv_fin            = ""; 
  otpv_kmrealiza      = ""; 
  otpv_hmotor         = ""; 
  otpv_componente     = ""; 
  otpv_obs_as         = ""; 
  otpv_obs_cgm        = ""; 
  otpv_cierra_ad      = ""; 
  otpv_date_cierra_ad = ""; 
  otpv_obs_cierre_ad  = ""; 
  otpv_obs_km         = "";
  otpv_obs_cierre_ad2 = ""; 
  selectotpv_estado   = ""; 
}
  
///::::::::::: SE CARGAN LAS VARIABLES HTML CON LA INFORMACION
function f_CargaVariablesHtmlOTPrv(){
  $("#otpv_semana").val(otpv_semana);
  $("#otpv_turno").val(otpv_turno);
  $("#otpv_date_prog").val(otpv_date_prog);
  $("#otpv_bus").val(otpv_bus);
  $("#otpv_fecuencia").val(otpv_fecuencia);
  $("#otpv_descripcion").val(otpv_descripcion);
  $("#otpv_asociado").val(otpv_asociado);
  $("#otpv_genera").val(otpv_genera+" el "+otpv_date_genera);
  $("#otpv_date_genera").val(otpv_date_genera);
  $("#otpv_estado").val(otpv_estado);
  $("#otpv_cgm_cierra").val(otpv_cgm_cierra);
  $("#otpv_tecnico").val(otpv_tecnico);
  $("#otpv_inicio").val(otpv_inicio);
  $("#otpv_fin").val(otpv_fin);
  $("#otpv_kmrealiza").val(otpv_kmrealiza);
  $("#otpv_hmotor").val(otpv_hmotor);
  $("#otpv_componente").val(otpv_componente);
  $("#otpv_obs_as").val(otpv_obs_as);
  $("#otpv_obs_cgm").val(otpv_obs_cgm);
  $("#otpv_cierra_ad").val(otpv_cierra_ad+" el "+otpv_date_cierra_ad);
  $("#otpv_date_cierra_ad").val(otpv_date_cierra_ad);
  //$("#div_otpv_obs_cierre_ad").html(otpv_obs_cierre_ad) // SE MUESTRA VARIABLE EN DIV
  $("#otpv_obs_km").val(otpv_obs_km);
  $("#otpv_obs_cierre_ad2").val(otpv_obs_cierre_ad2);
  $("#selectotpv_estado").val(selectotpv_estado);
  f_CalculoKilometraje(otpv_bus,otpv_inicio);
}
  
///::::::::::: SE CARGAN LAS VARIABLES CON LOS VALORES EDITADOS DEL INFORME PRELIMINAR ::::::::::::///
function f_CargarVariablesEditadasOTPrv(){
  otpv_cgm_cierra     = $.trim($('#otpv_cgm_cierra').val());
  otpv_tecnico        = $.trim($('#otpv_tecnico').val());
  otpv_inicio         = $.trim($('#otpv_inicio').val());
  otpv_fin            = $.trim($('#otpv_fin').val());
  otpv_kmrealiza      = $.trim($('#otpv_kmrealiza').val());
  otpv_hmotor         = $.trim($('#otpv_hmotor').val());
  otpv_componente     = $.trim($('#otpv_componente').val());
  otpv_obs_as         = $.trim($('#otpv_obs_as').val());
  otpv_obs_cgm        = $.trim($('#otpv_obs_cgm').val());
  otpv_cierra_ad      = $. trim($('#otpv_cierra_ad').val());
  otpv_date_cierra_ad = $.trim($('#otpv_date_cierra_ad').val());
  //otpv_obs_cierre_ad = $.trim($('#otpv_obs_cierre_ad').val());
  otpv_obs_km         = 0;
  otpv_obs_cierre_ad2 = $.trim($('#otpv_obs_cierre_ad2').val());
  selectotpv_estado   = $.trim($('#selectotpv_estado').val());

  otpv_turno = $.trim($('#otpv_turno').val());
  otpv_date_prog = $.trim($('#otpv_date_prog').val());
  otpv_bus = $.trim($('#otpv_bus').val());
  otpv_fecuencia = $.trim($('#otpv_fecuencia').val());
  otpv_descripcion = $.trim($('#otpv_descripcion').val());
  otpv_asociado = $.trim($('#otpv_asociado').val());
}

///::::::::::::::: CALCULO DE KM DEL DIA ANTERIOR Y DEL DIA FINAL:::::::::::::::::::::::::::///
function f_CalculoKilometraje(potpv_bus,potpv_inicio){
  let kmhtml = "";
  if(potpv_inicio.length>0){
    potpv_inicio = potpv_inicio.substring(0,10);
    if(potpv_inicio!="0000-00-00"){
      Accion='CalculoKilometraje';
      $.ajax({
        url: "Ajax.php",
        type: "POST",
        datatype:"json",
        async: false,
        data: {MoS:MoS,NombreMoS:NombreMoS,Accion:Accion,otpv_bus:potpv_bus,otpv_inicio:potpv_inicio},    
        success: function(data){
          kmhtml = data;
        },
      });
    }
  }
  $("#div_KmComparacion").html(kmhtml);
}

///::::::::::::::: VALIDA EL KM REALIZADO :::::::::::::::::::::::::::///
function f_validarKm(potpv_bus,potpv_inicio,potpv_kmrealiza){
  let rptakm = "";
  if(potpv_inicio.length>0){
    potpv_inicio = potpv_inicio.substring(0,10);
    if(potpv_inicio!="0000-00-00"){
      Accion='ValidarKm';
      $.ajax({
        url: "Ajax.php",
        type: "POST",
        datatype:"json",
        async: false,
        data: {MoS:MoS,NombreMoS:NombreMoS,Accion:Accion,otpv_bus:potpv_bus,otpv_inicio:potpv_inicio,otpv_kmrealiza:potpv_kmrealiza},    
        success: function(data){
          rptakm = data;
        },
      });
    }
  }
  return rptakm;
}