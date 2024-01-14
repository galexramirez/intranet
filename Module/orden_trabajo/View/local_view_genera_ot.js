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
        let validar_novedades = '';
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
        }
    });
    ///:: FIN BOTON NUEVO :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///

    ///:: CREAR ORDEN DE TRABAJO ::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
    $('#form_genera_ot').submit(function(e){                         
        e.preventDefault();
        let validacion_got = '';
        let nueva_ot = '';
    
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
            let a_data = [];
            a_data = JSON.stringify(filas_seleccionadas);
            $.ajax({
                url         : "Ajax.php",
                type        : "POST",
                datatype    : "json",    
                data        : { MoS:MoS, NombreMoS:NombreMoS, Accion:Accion, ot_origen:got_ot_origen, ot_nombre_proveedor:got_proveedor, a_data:a_data},    
                success     : function(data) {
                    nueva_ot = data;
                    if(nueva_ot!==""){
                        Swal.fire({
                            title: "¿ Desea imprimir OT ?",
                            showDenyButton: true,
                            confirmButtonText: "Imprimir",
                            denyButtonText: `No imprimir`,
                          }).then((result) => {
                            /* Read more about isConfirmed, isDenied below */
                            if (result.isConfirmed) {
                                f_imprimir_ot(nueva_ot,"div_imprimir_novedad_ot");
                            } else if (result.isDenied) {
                                Swal.fire({
                                    position: "top-end",
                                    icon: "info",
                                    title: "Impresión Cancelada!",
                                    showConfirmButton: false,
                                    timer: 1500
                                  });
                            }
                          });
                    }
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