///::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
///:: VINCULAR ORDEN DE TRABAJO v 1.0 FECHA: 2023-12-12 :::::::::::::::::::::::::::::::::::///
///:: CREAR VINCULO ENTRE ORDEN DE TRABAJO Y NOVEDADES ::::::::::::::::::::::::::::::::::::///
///::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///

///:: DECLARACION DE VARIABLES ::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
let select_vot, vot_ot_tipo, vot_ot_id, vot_bus;

///:: JS DOM VINCULAR ORDEN DE TRABAJO ::::::::::::::::::::::::::::::::::::::::::::::::::::///
$(document).ready(function(){

    $("#vot_ot_tipo").change(function(){
        vot_ot_tipo = $("#vot_ot_tipo").val();
        vot_ot_id = "";
        select_vot = f_select_combo("manto_orden_trabajo","NO","ot_id","","`ot_tipo`='"+vot_ot_tipo+"' AND `ot_bus`='"+vot_bus+"' AND `ot_estado`='ABIERTO'","`ot_id` DESC");
        $("#vot_ot_id").html(select_vot);
        $("#vot_ot_id").val(vot_ot_id); 
    });

    ///:: BOTONES DE VINCULAR ORDEN DE TRABAJO ::::::::::::::::::::::::::::::::::::::::::::///

    ///:: BOTON VINCULAR ::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
    $(document).on("click", ".btn_vincular_ot", function(){
        let validar_novedades = '';
        vot_bus = ""; 
        validar_novedades = f_validar_novedades();
        if(validar_novedades!==""){
            Swal.fire({
                position            : 'center',
                icon                : 'error',
                title               : validar_novedades+' !!!',
                showConfirmButton   : false,
                timer               : 1500
            })
        }else{
            $("#form_vincular_ot").trigger("reset");

            f_limpia_vincular_ot();
      
            vot_ot_tipo = "";
            vot_ot_id = "";
            
            select_vot = f_select_combo("manto_tc_orden_trabajo","NO","tc_categoria3","","`tc_variable`='SISTEMA' AND `tc_categoria1`='ORDEN TRABAJO' AND `tc_categoria2`='TIPO'","`tc_categoria3` ASC");
            $("#vot_ot_tipo").html(select_vot);
            
            select_vot = f_select_combo("manto_orden_trabajo","NO","ot_id","","`ot_tipo`='"+vot_ot_tipo+"' AND `ot_bus`='"+vot_bus+"' AND `ot_estado`='ABIERTO'","`ot_id` DESC");
            $("#vot_ot_id").html(select_vot);
    
            $("#vot_ot_tipo").val(vot_ot_tipo); 
            $("#vot_ot_id").val(vot_ot_id); 
    
            $(".modal-header").css( "background-color", "#17a2b8");
            $(".modal-header").css( "color", "white" );
            $(".modal-title").text("Vincular Orden de Trabajo");
            $('#modal_crud_vincular_ot').modal('show');    
        }
    });
    ///:: FIN BOTON VINCUALR ::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///

    ///:: VINCULAR ORDEN DE TRABAJO :::::::::::::::::::::::::::::::::::::::::::::::::::::::///
    $('#form_vincular_ot').submit(function(e){                         
        e.preventDefault();
        let validacion_vot = '';

        vot_ot_tipo = $("#vot_ot_tipo").val();
        vot_ot_id = $("#vot_ot_id").val(); 

        validacion_vot = f_validar_vincular_ot(vot_ot_tipo, vot_ot_id);
    
        if(validacion_vot=="invalido"){
            Swal.fire({
                position            : 'center',
                icon                : 'error',
                title               : '*Falta Completar Información!!!',
                showConfirmButton   : false,
                timer               : 1500
            })
        }else{
            $("#btn_vincular_novedad_ot").prop("disabled",true);
            Accion = 'vincular_orden_trabajo';
            let a_data = [];
            a_data = JSON.stringify(filas_seleccionadas);
            $.ajax({
                url         : "Ajax.php",
                type        : "POST",
                datatype    : "json",    
                data        : { MoS:MoS, NombreMoS:NombreMoS, Accion:Accion, ot_tipo:vot_ot_tipo, ot_id:vot_ot_id, a_data:a_data},    
                success     : function(data) {
                    tabla_novedades.ajax.reload(null, false);
                    div_show = f_MostrarDiv("form_seleccion_novedades", "btn_seleccion_novedades", "inicio", "inicio");
                    $("#div_btn_seleccion_novedades").html(div_show);
                }
            });
            $('#modal_crud_vincular_ot').modal('hide');
            $("#btn_vincular_novedad_ot").prop("disabled",false);
        }
  });
  ///:: FIN VINCULAR ORDEN DE TRABAJO :::::::::::::::::::::::::::::::::::::::::::::::::::::///


    ///:: TERMINO BOTONES DE VINCULAR ORDE DE TRABAJO :::::::::::::::::::::::::::::::::::::///
});
///:: TERMINO JS DOM GENERA ORDEN DE TRABAJO ::::::::::::::::::::::::::::::::::::::::::::::///

///:: FUNCIONES DE VINCULAR ORDEN DE TRABAJO ::::::::::::::::::::::::::::::::::::::::::::::///
function f_validar_novedades(){
    let rpta_validar_novedades = "";
    let a_data = [];
    a_data = JSON.stringify(filas_seleccionadas);
    Accion = 'validar_novedades_vincular_ot';
    $.ajax({
        url     : "Ajax.php",
        type    : "POST",
        datatype: "json",
        async   : false,
        data    : {MoS:MoS, NombreMoS:NombreMoS, Accion:Accion, a_data:a_data},    
        success : function(data){
            rpta_validar_novedades = data;
        }
    });
    if(rpta_validar_novedades==""){
        vot_bus = filas_seleccionadas[0].bus;
    }
    return rpta_validar_novedades
}

function f_limpia_vincular_ot(){
    $("#vot_ot_tipo").removeClass("color-error");
    $("#vot_ot_id").removeClass("color-error");
}
  
function f_validar_vincular_ot(p_vot_ot_tipo, p_vot_ot_id){
    f_limpia_vincular_ot();
    let rpta_validar_vincular_ot = "";
    
    if(p_vot_ot_tipo==""){
        $("#vot_ot_tipo").addClass("color-error");
        rpta_validar_vincular_ot = "invalido";
    } 
    if(p_vot_ot_id==""){
        $("#vot_ot_id").addClass("color-error");
        rpta_validar_vincular_ot = "invalido";
    } 
    return rpta_validar_vincular_ot;
}
  
///:: TERMINO FUNCIONES DE VINCULAR ORDEN DE TRABAJO ::::::::::::::::::::::::::::::::::::::///