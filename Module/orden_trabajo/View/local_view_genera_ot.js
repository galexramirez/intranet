///::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
///:: GENERA ORDEN DE TRABAJO v 1.0 FECHA: 2023-12-11 :::::::::::::::::::::::::::::::::::::///
///:: CREAR ORDEN DE TRABAJO ::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
///::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///

///:: DECLARACION DE VARIABLES ::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
let select_got, got_ot_origen, got_proveedor;

///:: JS DOM GENERA ORDEN DE TRABAJO ::::::::::::::::::::::::::::::::::::::::::::::::::::::///
$(document).ready(function(){

    ///:: BOTONES DE GENERA ORDEN DE TRABAJO ::::::::::::::::::::::::::::::::::::::::::::::///

    ///:: BOTON NUEVO :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
    $(document).on("click", ".btn_agregar_ot", function(){
        $("#form_genera_ot").trigger("reset");

        f_limpia_genera_ot();
  
        got_ot_origen = "";
        got_proveedor = "";

        select_got = f_select_combo("manto_ot_origen","NO","or_nombre","","`or_nombre`!='' AND `or_tipo_ot`!=''","`or_nombre` ASC");
        $("#got_ot_origen").html(select_got);
        
        select_got = f_select_combo("manto_proveedores","NO","prov_razonsocial","","`prov_estado`='ACTIVO'","`prov_razonsocial` ASC");
        $("#got_proveedor").html(select_got);

        $("#got_ot_origen").val(got_ot_origen); 
        $("#gor_asociado").val(got_proveedor); 

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
    
        got_ot_origen = $("#got_ot_origen").val();
        got_proveedor = $("#got_proveedor").val(); 

        validacion_got = f_validar_genera_ot(got_ot_origen, got_proveedor);
    
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
                data        : { MoS:MoS, NombreMoS:NombreMoS, Accion:Accion, ot_origen:got_ot_origen, ot_nombre_proveedor:got_proveedor, not_origen_novedad:origen_novedad, not_tipo_novedad:tipo_novedad, not_novedad_id:novedad_id,not_operacion:tipo_operacion, not_bus:nro_bus, ot_descrip:accion_ot},    
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
  ///:: FIN CREAR NOVEDAD REGULAR :::::::::::::::::::::::::::::::::::::::::::::::::::::::::///


    ///:: TERMINO BOTONES DE NOVEDADES REGULAR ::::::::::::::::::::::::::::::::::::::::::::///
});
///:: TERMINO JS DOM GENERA ORDEN DE TRABAJO ::::::::::::::::::::::::::::::::::::::::::::::///

///:: FUNCIONES DE GENERA ORDEN DE TRABAJO ::::::::::::::::::::::::::::::::::::::::::::::::///
function f_limpia_genera_ot(){
    $("#got_ot_origen").removeClass("color-error");
    $("#got_proveedor").removeClass("color-error");
}
  
function f_validar_genera_ot(p_got_ot_origen, p_got_proveedor){
    f_limpia_genera_ot();
    let rpta_validar_genera_ot = "";
    
    if(p_got_ot_origen==""){
        $("#got_ot_origen").addClass("color-error");
        rpta_validar_genera_ot = "invalido";
    } 
    if(p_got_proveedor==""){
        $("#got_proveedor").addClass("color-error");
        rpta_validar_genera_ot = "invalido";
    } 
    return rpta_validar_genera_ot;
}
  
///:: TERMINO FUNCIONES DE NOVEDAD REGULAR ::::::::::::::::::::::::::::::::::::::::::::::::///