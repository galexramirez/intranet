///::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
///:: GENERA ORDEN DE TRABAJO v 1.0 FECHA: 2023-12-11 :::::::::::::::::::::::::::::::::::::///
///:: CREAR ORDEN DE TRABAJO ::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
///::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///

///:: DECLARACION DE VARIABLES ::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
let select_got, got_ot_tipo, got_asociado;

///:: JS DOM GENERA ORDEN DE TRABAJO ::::::::::::::::::::::::::::::::::::::::::::::::::::::///
$(document).ready(function(){

    ///:: BOTONES DE GENERA ORDEN DE TRABAJO ::::::::::::::::::::::::::::::::::::::::::::::///

    ///:: BOTON NUEVO :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
    $(document).on("click", ".btn_agregar_ot", function(){
        $("#form_genera_ot").trigger("reset");

        f_limpia_genera_ot();
  
        got_ot_tipo = "";
        got_asociado = "";

        select_got = f_select_combo("manto_tc_orden_trabajo","NO","tc_categoria3","","`tc_variable`='SISTEMA' AND `tc_categoria1`='ORDEN TRABAJO' AND `tc_categoria2`='TIPO'","`tc_categoria3` ASC");
        $("#got_ot_tipo").html(select_got);
        
        select_got = f_select_combo("manto_resp_asociado","SI","ra_asociado","","`ra_asociado`!=''","`ra_asociado` ASC");
        $("#got_asociado").html(select_got);

        $("#got_ot_tipo").val(got_ot_tipo); 
        $("#gor_asociado").val(got_asociado); 

        $(".modal-header").css( "background-color", "#17a2b8");
        $(".modal-header").css( "color", "white" );
        $(".modal-title").text("Generar Orden de Trabajo");
        $('#modal_crud_genera_ot').modal('show');
    });
    ///:: FIN BOTON NUEVO :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///

    ///:: CREAR ORDEN DE TRABAJO ::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
    $('#form_genera_ot').submit(function(e){                         
        e.preventDefault();
        let validacion_got = '';
    
        got_ot_tipo = $("#got_ot_tipo").val();
        got_asociado = $("#got_asociado").val(); 

        validacion_got = f_validar_genera_ot(got_ot_tipo, got_asociado);
    
        if(validacion_got=="invalido"){
            Swal.fire({
                position            : 'center',
                icon                : 'error',
                title               : '*Falta Completar Información!!!',
                showConfirmButton   : false,
                timer               : 1500
            })
        }else{
            $("#btn_genera_ot").prop("disabled",true);
            Accion = 'crear_orden_trabajo';
            $.ajax({
                url         : "Ajax.php",
                type        : "POST",
                datatype    : "json",    
                data        : { MoS:MoS, NombreMoS:NombreMoS, Accion:Accion, not_ot_tipo:got_ot_tipo, ot_asociado:got_asociado, not_origen_novedad:origen_novedad, not_tipo_novedad:tipo_novedad, not_novedad_id:novedad_id,not_operacion:tipo_operacion, not_bus:nro_bus},    
                success     : function(data) {
                    tabla_novedades.ajax.reload(null, false);
                    div_show = f_MostrarDiv("form_seleccion_novedades", "btn_seleccion_novedades", "inicio", "inicio");
                    $("#div_btn_seleccion_novedades").html(div_show);
                }
            });
            $('#modal_crud_genera_ot').modal('hide');
            $("#btn_genera_ot").prop("disabled",false);
        }
  });
  ///:: FIN CREAR NOVEDAD REGULAR :::::::::::::::::::::::::::::::::::::::::::::::::::::::///


    ///:: TERMINO BOTONES DE NOVEDADES REGULAR ::::::::::::::::::::::::::::::::::::::::::::///
});
///:: TERMINO JS DOM GENERA ORDEN DE TRABAJO ::::::::::::::::::::::::::::::::::::::::::::::///

///:: FUNCIONES DE GENERA ORDEN DE TRABAJO ::::::::::::::::::::::::::::::::::::::::::::::::///
function f_limpia_genera_ot(){
    $("#got_ot_tipo").removeClass("color-error");
    $("#got_asociado").removeClass("color-error");
}
  
function f_validar_genera_ot(p_got_ot_tipo, p_got_asociado){
    f_limpia_genera_ot();
    let rpta_validar_genera_ot = "";
    
    if(p_got_ot_tipo==""){
        $("#got_ot_tipo").addClass("color-error");
        rpta_validar_genera_ot = "invalido";
    } 
    if(p_got_asociado==""){
        $("#got_asociado").addClass("color-error");
        rpta_validar_genera_ot = "invalido";
    } 
    return rpta_validar_genera_ot;
}
  
///:: TERMINO FUNCIONES DE NOVEDAD REGULAR ::::::::::::::::::::::::::::::::::::::::::::::::///