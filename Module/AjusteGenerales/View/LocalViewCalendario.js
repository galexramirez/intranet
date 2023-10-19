///::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
///:: CALENDARIO v 2.0 ::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
///:: CREAR, EDITAR, BORRAR TABLA CALENDARIO ::::::::::::::::::::::::::::::::::::::::::.:::///
///:: FECHA: 2023-07-02 09:50 :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///

///::DECLARACION DE VARIABLES :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
var Calendario_Id, Calendario_Anio, Calendario_TipoDia, CalendarioSemana;
var opcionCalendario, tablaCalendario, filaCalendario;
opcionCalendario = 0; // Variabla para ver tipo de grabacion crear: 1, editar: 2

///:: DOM JS CALENDARIO :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
$(document).ready(function(){
    let nuevaFecha, inicioSemana, finSemana, diaInicio, mesInicio, diaFin, mesFin, texto1, t_html;

    div_boton = f_BotonesFormulario("formSeleccionCalendario","btn_NuevoCalendario");
    $("#div_btnNuevoCalendario").html(div_boton);

    $("#Calendario_Id").on('change', function () {
        texto1="0";
        Calendario_Id = $("#Calendario_Id").val();
        
        nuevaFecha = new Date(Calendario_Id.concat(' 12:00:00'));
        if(nuevaFecha.getDay()==0){
            inicioSemana = new Date(nuevaFecha.getFullYear(), nuevaFecha.getMonth(), nuevaFecha.getDate() - 6 );
            finSemana = nuevaFecha;
        }else{
            inicioSemana = new Date(nuevaFecha.getFullYear(), nuevaFecha.getMonth(), nuevaFecha.getDate() - nuevaFecha.getDay() + 1);
            finSemana = new Date(nuevaFecha.getFullYear(), nuevaFecha.getMonth(), nuevaFecha.getDate() + 7 - nuevaFecha.getDay());
        }

        diaInicio = texto1.concat(inicioSemana.getDate());
        diaInicio = diaInicio.substring(diaInicio.length - 2);
        mesInicio = texto1.concat(inicioSemana.getMonth()+1);
        mesInicio = mesInicio.substring(mesInicio.length - 2);
        
        diaFin = texto1.concat(finSemana.getDate());
        diaFin = diaFin.substring(diaFin.length - 2);
        mesFin = texto1.concat(finSemana.getMonth()+1);
        mesFin = mesFin.substring(mesFin.length - 2);
        
        Calendario_Anio = Calendario_Id.substring(0,4);
        Calendario_Semana = Calendario_Anio.concat('-S##('+diaInicio+'.'+mesInicio+'-'+diaFin+'.'+mesFin+')');
        
        $("#Calendario_Anio").val(Calendario_Anio);
        $("#Calendario_Semana").val(Calendario_Semana);
    });

    div_tabla = f_CreacionTabla("tablaCalendario","");
    $("#div_tablaCalendario").html(div_tabla);
    columnastabla = f_ColumnasTabla("tablaCalendario","");

    Accion = 'LeerCalendario';
    tablaCalendario = $('#tablaCalendario').DataTable({
        language        : idiomaEspanol,
        responsive      : "true",
        dom             : 'Blfrtip',
        buttons:[
            {
                extend      : 'excelHtml5',
                text        : '<i class="fas fa-file-excel"></i> ',
                titleAttr   : 'Exportar a Excel',
                className   : 'btn btn-success',
                title       : 'CALENDARIO'
            }
        ],
        "ajax"          :{
            "url"       : "Ajax.php", 
            "method"    : 'POST',
            "data"      :{ MoS:MoS, NombreMoS:NombreMoS, Accion:Accion},
            "dataSrc"   : ""
        },
        "columns"       : columnastabla,
        "order"         : [[0, 'desc']]
    });     

    ///:: INICIO BOTONES CALENDARIO :::::::::::::::::::::::::::::::::::::::::::::::::::::::///

    ///::: EVENTO DEL BOTON NUEVO :::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
    $(document).on("click", ".btnNuevoCalendario", function(){
        $("#formCalendario").trigger("reset");    
        opcionCalendario = 1; // Alta 
        f_limpia_calendario();
        t_html = f_TipoTabla("TRONCAL", "TIPO DIA");
        $("#Calendario_TipoDia").html(t_html);
        $("#Calendario_Id").prop('disabled', false);
        $("#Calendario_Anio").prop('disabled', true);
        $("#Calendario_Semana").prop('disabled', false);
        $(".modal-header").css( "background-color", "#17a2b8");
        $(".modal-header").css( "color", "white" );
        $(".modal-title").text("Alta de Calendario");
        $('#modalCRUDCalendario').modal('show');	    
    });
    ///:: FIN EVENTO DEL BOTON NUEVO ::::::::::::::::::::::::::::::::::::::::::::::::::::::///

    ///:: EVENTO DEL BOTON EDITAR :::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
    $(document).on("click", ".btnEditarCalendario", function(){
        opcionCalendario = 2;// Editar
        f_limpia_calendario();
        t_html = f_TipoTabla("TRONCAL", "TIPO DIA");
        $("#Calendario_TipoDia").html(t_html);
        $("#Calendario_Id").prop('disabled', true);
        $("#Calendario_Anio").prop('disabled', true);
        $("#Calendario_Semana").prop('disabled', true);
        filaCalendario      = $(this).closest("tr");	        
        Calendario_Id       = filaCalendario.find('td:eq(0)').text();
        Calendario_Anio     = filaCalendario.find('td:eq(2)').text();
        Calendario_TipoDia  = filaCalendario.find('td:eq(3)').text();
        Calendario_Semana   = filaCalendario.find('td:eq(4)').text();
        $("#Calendario_Id").val(Calendario_Id);
        $("#Calendario_Anio").val(Calendario_Anio);
        $("#Calendario_TipoDia").val(Calendario_TipoDia);
        $("#Calendario_Semana").val(Calendario_Semana);
        $(".modal-header").css("background-color", "#007bff");
        $(".modal-header").css("color", "white" );
        $(".modal-title").text("Editar Tablas");		
        $('#modalCRUDCalendario').modal('show');		   
    });
    ///:: FIN EVENTO DEL BOTON EDITAR :::::::::::::::::::::::::::::::::::::::::::::::::::::///

    ///:: BOTON BORRAR REGISTRO :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
    $(document).on("click", ".btnBorrarCalendario", function(){
        filaCalendario  = $(this);           
        Calendario_Id   = filaCalendario.closest("tr").find('td:eq(0)').text();     
        let rptaCalendarioBorrar = 0;
        Swal.fire({
            title               : '¿Está seguro?',
            text                : "Se eliminara el registro "+Calendario_Id+"!",
            icon                : 'warning',
            showCancelButton    : true,
            confirmButtonColor  : '#3085d6',
            cancelButtonColor   : '#d33',
            confirmButtonText   : 'Si, eliminar!'
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire(
                    'Eliminado!',
                    'El registro se ha sido eliminado.',
                    'success'
                )
                rptaCalendarioBorrar = 1;
                Accion = 'BorrarCalendario';
                if (rptaCalendarioBorrar == 1) {            
                    $.ajax({
                    url: "Ajax.php",
                    type: "POST",
                    datatype:"json",    
                    data:  { MoS:MoS,NombreMoS:NombreMoS,Accion:Accion,Calendario_Id:Calendario_Id },   
                        success: function() {
                            tablaCalendario.row(filaCalendario.parents('tr')).remove().draw();
                        }
                    });
                }
            }
        });
    });
    ///:: FIN BOTON BORRAR REGISTRO :::::::::::::::::::::::::::::::::::::::::::::::::::::::///

    ///:: CREAR Y EDITAR CALENDARIO :::::::::::::::::::::::::::::::::::::::::::::::::::::::///
    $('#formCalendario').submit(function(e){                         
        e.preventDefault(); //evita el comportambiento normal del submit, es decir, recarga total de la página
        Calendario_Id       = $.trim($('#Calendario_Id').val());    
        Calendario_Anio     = $.trim($('#Calendario_Anio').val());
        Calendario_TipoDia  = $.trim($('#Calendario_TipoDia').val());    
        Calendario_Semana   = $.trim($('#Calendario_Semana').val());
        validacion          = f_validar_calendario(Calendario_Id,Calendario_Anio,Calendario_TipoDia,Calendario_Semana);

        if(validacion=="invalido") {
            Swal.fire({
                icon    : 'error',
                title   : 'INFORMACION...',
                text    : '*La información no es correcta!!!'
            })
        }else{
            $("#btnGuardarCalendario").prop("disabled",true);
            if(opcionCalendario == 1) {
                Accion='CrearCalendario'; /// CREAR
                $.ajax({
                    url: "Ajax.php",
                    type: "POST",
                    datatype:"json",    
                    data:  { MoS:MoS,NombreMoS:NombreMoS,Accion:Accion,Calendario_Id:Calendario_Id,Calendario_Anio:Calendario_Anio,Calendario_TipoDia:Calendario_TipoDia,Calendario_Semana:Calendario_Semana },    
                    success: function(data) {
                        tablaCalendario.ajax.reload(null, false);
                    }
                });
            }
            if(opcionCalendario == 2) {
                Accion='EditarCalendario'; /// EDITAR
                $.ajax({
                    url: "Ajax.php",
                    type: "POST",
                    datatype:"json",    
                    data:  { MoS:MoS,NombreMoS:NombreMoS,Accion:Accion,Calendario_Id:Calendario_Id,Calendario_Anio:Calendario_Anio,Calendario_TipoDia:Calendario_TipoDia,Calendario_Semana:Calendario_Semana },    
                    success: function(data) {
                        tablaCalendario.ajax.reload(null, false);
                    }
                });
            } 
            $('#modalCRUDCalendario').modal('hide');
            $("#btnGuardarCalendario").prop("disabled",false);
        }
    });

    ///:: TERMINO BOTONES CALENDARIO ::::::::::::::::::::::::::::::::::::::::::::::::::::::///
});
///:: TERMINO DOM JS CALENDARIO :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///

///:: FUNCIONES CALENDARIO ::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///

///:: FUNCION PARA VALIDAR LOS DATOS INGRESADOS AL FORMULARIO :::::::::::::::::::::::::::::///
function f_validar_calendario(Calendario_Id,Calendario_Anio,Calendario_TipoDia,Calendario_Semana){
    f_limpia_calendario();
    let rptaValidarCalendario="";    

    if(Calendario_Anio=="") {
        $("#Calendario_Id").addClass("color-error");
        rptaValidarCalendario="invalido";
    }
    if(Calendario_TipoDia=="" ||  Calendario_TipoDia.length>10){
         $("#Calendario_TipoDia").addClass("color-error");
        rptaValidarCalendario="invalido";
    }
    if(Calendario_Semana.length<21 || Calendario_Semana.indexOf("#")!=-1){
        $("#Calendario_Semana").addClass("color-error");
        rptaValidarCalendario="invalido";
    }
    return rptaValidarCalendario; 
}
///:: FIN FUNCION PARA VALIDAR LOS DATOS INGRESADOS AL FORMULARIO :::::::::::::::::::::::::///

///:: LIMPIA LOS CAMPOS CON ERROR DEL FORMULARIO ::::::::::::::::::::::::::::::::::::::::::///
function f_limpia_calendario(){
    $("#Calendario_Id").removeClass("color-error");
    $("#Calendario_Anio").removeClass("color-error");
    $("#Calendario_TipoDia").removeClass("color-error");
    $("#Calendario_Semana").removeClass("color-error");
}
///:: FIN LIMPIA LOS CAMPOS CON ERROR DEL FORMULARIO ::::::::::::::::::::::::::::::::::::::///

///:: TERMINO FUNCIONES CALENDARIO ::::::::::::::::::::::::::::::::::::::::::::::::::::::::///