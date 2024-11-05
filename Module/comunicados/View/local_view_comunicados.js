///::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
///:: COMINICADOS DE PILOTO v1.0 FECHA: 2024-10-28 ::::::::::::::::::::::::::::::::::::::::///
//::: ACCESO A LA PROGRAMACION SEMANAL Y COMUNICADOS DE PILOTOS :::::::::::::::::::::::::::///
///::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///

$(document).ready(function () {
    div_boton = f_BotonesFormulario("form_comunicados", "btn_form_comunicados");
    $("#btn_form_comunicados").html(div_boton);
    div_show = f_MostrarDiv("comunicados", "carouselComunicados", "ACTIVO");
    $("#carouselComunicados").html(div_show);
  
    ///:: INICIO DE BOTONES DE COMUNICADOS DE PILOTOS :::::::::::::::::::::::::::::::::::::///
    ///::::::::::::::: BOTON DESCARGA ARCHIVO PDF PROGRAMACION ACTUAL :::::::::::::::::::::///
    $(document).on("click", ".btn_programacion_actual", function () {
        let semana_programacion = "actual";
        let semana = semana_publicada(semana_programacion);
        let dni = f_DNI();
        window.open(mi_carpeta + "Module/ProgramacionCarga/Controller/PDF_Individual.php?Semana=" + semana + "&Dni=" + dni, '_blank');
    });
    ///::::::::::::: FIN BOTON DESCARGA ARCHIVO PDF PROGRAMACION ACTUAL::::::::::::::::::::///

    ///:::::::::::::::: BOTON DESCARGA ARCHIVO PDF PROXIMA PROGRAMACION :::::::::::::::::::///
    $(document).on("click", ".btn_programacion_proxima", function () {
        let semana_programacion = "proxima";
        let semana = semana_publicada(semana_programacion);
        let dni = f_DNI();
        window.open(mi_carpeta + "Module/ProgramacionCarga/Controller/PDF_Individual.php?Semana=" + semana + "&Dni=" + dni, '_blank');
    });
    ///:::::::::::::: FIN BOTON DESCARGA ARCHIVO PDF PROXIMA PROGRAMACION :::::::::::::::::///

    ///:::::::::::::::: BOTON MARCACION DE PILOTOS GEOPOSICION ::::::::::::::::::::::::::::///
    $(document).on("click", ".btn_marcacion", function () {
        alert("1");
        Accion = 'marcacion';
        navigator.geolocation.getCurrentPosition(geoposOK, geoposKO);
        if(lat==null || long==null){
            msg = "Tu posición actual no esta disponible. ";
            alert(msg);
        }else{
            alert("2");
            var params = {
                MoS: MoS, 
                NombreMoS: NombreMoS,
                Accion: Accion,
                lat: lat,
                long: long
            };
            $.ajax({
                url: 'Ajax.php',
                dataType: 'json',
                type: 'POST',
                data: params,
                beforeSend: function () {
                },
                success: function (response) {
                    alert("grabar");
                    $("#modal_body_marcacion").html(response);
                    $(".modal-header").css("background-color", "#007bff");
                    $(".modal-header").css("color", "white" );
                    $(".modal-title").text("Marcación de Colaborador");		
                    $("#modal_marcacion").modal('show');
                }
            });
        }
        alert("3");
    });
    ///:::::::::::::::: FIN BOTON MARCACION DE PILOTOS GEOPOSICION ::::::::::::::::::::::::///

    ///:: TERMINO DE BOTONES DE COMUNICADOS DE PILOTOS ::::::::::::::::::::::::::::::::::::///
});

///:: FUNCIONES COMUNICADOS DE PILOTO :::::::::::::::::::::::::::::::::::::::::::::::::::::///
///:::::::::::::::::::::: FUNCION GENERA LA SEMANA A DESCARGAR ::::::::::::::::::::::::::::///
function semana_publicada(semana_programacion) {
    let semana = "";
    let pub_rg_estado = "PUBLICADO";
    let fecha_actual = f_CalculoFecha("hoy", "0");
    if (semana_programacion == "proxima") {
        fecha_actual = f_CalculoFecha("hoy", "+1 Week");
    }
    let semana_calendario = f_buscar_dato("Calendario", "Calendario_Semana", "`Calendario_Id`='" + fecha_actual + "'");
    let pub_rg_id = f_buscar_dato("PublicacionRegistroCarga", "PubRg_Id", "`PubRg_SemanaPublicada`='" + semana_calendario + "' AND `PubRg_Estado`='" + pub_rg_estado + "'");
    semana = semana_calendario + pub_rg_id;
    return semana;
}
///::::::::::::::::::::: FIN FUNCION GENERA LA SEMANA A DESCARGAR ::::::::::::::::::::::::::///
///:: TERMINO FUNCIONES COMUNICACIONES DE PILOTO :::::::::::::::::::::::::::::::::::::::::::///