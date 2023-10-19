///:: JS CARGA DE DATA TABLE MODulo :::::::::::::::::::::::::::::::::::::::::::::::::::::::///
$(document).ready(function(){
    div_tabla       = f_CreacionTabla("tablaModulo","");
    $("#div_tablaModulo").html(div_tabla);
    columnastabla   = f_ColumnasTabla("tablaModulo","");

    Accion='CargarModulo';
    tablaModulo = $('#tablaModulo').DataTable({
        language: idiomaEspanol,
        responsive: "true",
        dom: 'Blfrtip', // Con Botones Excel,Pdf,Print
        buttons:[
            {
                extend      : 'excelHtml5',
                text        : '<i class="fas fa-file-excel"></i> ',
                titleAttr   : 'Exportar a Excel',
                className   : 'btn btn-success',
                title       : 'MODULOS'
            },
        ],
        "ajax":{            
                "url"       : "Ajax.php", 
                "method"    : 'POST', //usamos el metodo POST
                "data"      : {MoS:MoS,NombreMoS:NombreMoS,Accion:Accion}, //enviamos opcion 4 para que haga un SELECT
                "dataSrc"   : ""
                },
        "columns": columnastabla
    });     

    ///:: EVENTO DEL BOTON NUEVO MODULO :::::::::::::::::::::::::::::::::::::::::::::::::::///
    $("#btnNuevoModulo").click(function(){
        opcion = 1; // Alta 
        f_limpia_modulo();          
        $("#formModulo").trigger("reset");
        $(".modal-header").css( "background-color", "#17a2b8");
        $(".modal-header").css( "color", "white" );
        $(".modal-title").text("Alta de Modulo");
        $('#modalCRUDModulo').modal('show');	    
    });

    ///::::::::: BOTON EDITAR ::::::::::::::::::::::///       
    $(document).on("click", ".btnEditarModulo", function(){
        opcion = 2;// Editar
        f_limpia_modulo();
        fila            = $(this).closest("tr");	        
        Modulo_Id       = fila.find('td:eq(0)').text();
        Mod_Nombre      = fila.find('td:eq(1)').text();
        Mod_NombreVista = fila.find('td:eq(2)').text();
        Mod_Icono       = fila.find('td:eq(3)').html();
        mod_tipo        = fila.find('td:eq(4)').text();
        mod_plegable    = fila.find('td:eq(5)').text();

        $("#Modulo_Id").val(Modulo_Id);
        $("#Mod_Nombre").val(Mod_Nombre);
        $("#Mod_NombreVista").val(Mod_NombreVista);
        $("#Mod_Icono").val(Mod_Icono);
        $("#mod_tipo").val(mod_tipo);
        $("#mod_plegable").val(mod_plegable);
   
        $(".modal-header").css("background-color", "#007bff");
        $(".modal-header").css("color", "white" );
        $(".modal-title").text("Editar Modulo");		
    
        $('#modalCRUDModulo').modal('show');		   
    });

    /// ::::::::::::::: CREA Y EDITA USUARIO :::::::::::::///
    $('#formModulo').submit(function(e){
        let validacion  = "";
        let t_msg       = "";
        let a_data      = [];
        e.preventDefault(); //evita el comportambiento normal del submit, es decir, recarga total de la página
        Modulo_Id       = $.trim($('#Modulo_Id').val());    
        Mod_Nombre      = $.trim($('#Mod_Nombre').val());
        Mod_NombreVista = $.trim($('#Mod_NombreVista').val());    
        Mod_Icono       = $.trim($('#Mod_Icono').val());
        mod_tipo        = $.trim($('#mod_tipo').val());
        mod_plegable    = $.trim($('#mod_plegable').val());
        validacion      = f_validar_modulo(Modulo_Id,Mod_Nombre,Mod_NombreVista,Mod_Icono, mod_tipo, mod_plegable);

        if(Mod_Nombre!=""){
            a_data = f_BuscarDataBD("Modulo","Mod_Nombre",Mod_Nombre);
            if(a_data.length>0 && opcion==1){
                t_msg = "<br>Nombre del Modulo EXISTE!!!";
                validacion = "invalido";
                $("#Mod_Nombre").addClass("color-error");
            }
            if(a_data.length>0 && opcion==2){
                $.each(a_data, function(idx, obj){
                    if(Modulo_Id != obj.Modulo_Id){
                        t_msg = "<br>Nombre del Modulo EXISTE!!!";
                        validacion = "invalido";
                        $("#Mod_Nombre").addClass("color-error");        
                    } 
                });
            }
        }
        if(Mod_NombreVista!=""){
            a_data = f_BuscarDataBD("Modulo","Mod_NombreVista",Mod_NombreVista);
            if(a_data.length>0 && opcion==1){
                t_msg += "<br>NombreVista del Modulo EXISTE!!!";
                validacion = "invalido";
                $("#Mod_NombreVista").addClass("color-error");
            }
            if(a_data.length>0 && opcion==2){
                $.each(a_data, function(idx, obj){
                    if(Modulo_Id != obj.Modulo_Id){
                        t_msg += "<br>NombreVista del Modulo EXISTE!!!";
                        validacion = "invalido";
                        $("#Mod_NombreVista").addClass("color-error");        
                    } 
                });
            }
        }
        if(validacion=="invalido"){
            Swal.fire({
                position            : 'center',
                icon                : 'error',
                title               : '*Falta Completar Información!!!'+t_msg,
                showConfirmButton   : false,
                timer               : 1500
            });
        }else{
            $("#btnGuardarModelo").prop("disabled",true);
            if(opcion == 1) { // CREAR
                if(validacion!="invalido") {   
                    Accion='CrearModulo';
                    $.ajax({
                        url: "Ajax.php",
                        type: "POST",
                        datatype:"json",    
                        data:  { MoS:MoS,NombreMoS:NombreMoS,Accion:Accion,Mod_Nombre:Mod_Nombre,Mod_NombreVista:Mod_NombreVista,Mod_Icono:Mod_Icono, mod_tipo:mod_tipo, mod_plegable:mod_plegable },    
                        success: function(data) {
                            tablaModulo.ajax.reload(null, false);
                        }
                    });
                } 
            }
            if(opcion == 2) { // EDITAR
                if(validacion!="invalido") {   
                    Accion='EditarModulo';
                    $.ajax({
                        url: "Ajax.php",
                        type: "POST",
                        datatype:"json",    
                        data: { MoS:MoS,NombreMoS:NombreMoS,Accion:Accion,Modulo_Id:Modulo_Id,Mod_Nombre:Mod_Nombre,Mod_NombreVista:Mod_NombreVista,Mod_Icono:Mod_Icono, mod_tipo:mod_tipo, mod_plegable:mod_plegable},
                            success: function(data) {
                                tablaModulo.ajax.reload(null, false);
                            }
                        });
                } 
            }
            $("#btnGuardarModelo").prop("disabled",false);
            $('#modalCRUDModulo').modal('hide');
        }
    });
        
    ///::::::::  BOTON BORRAR REGISTRO  
    $(document).on("click", ".btnBorrarModulo", function(){
        fila = $(this);           
        Modulo_Id = $(this).closest('tr').find('td:eq(0)').text();     
        respuesta = 0;
        Swal.fire({
            title: '¿Está seguro?',
            text: "Se eliminara el registro "+Modulo_Id+"!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si, eliminar!'
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire(
                    'Eliminado!',
                    'El registro ha sido eliminado.',
                    'success'
                )
                respuesta = 1;
                Accion='BorrarModulo';
                if (respuesta = 1) {            
                    $.ajax({
                    url: "Ajax.php",
                    type: "POST",
                    datatype:"json",    
                    data:  { MoS:MoS,NombreMoS:NombreMoS,Accion:Accion,Modulo_Id:Modulo_Id },   
                        success: function() {
                        tablaModulo.row(fila.parents('tr')).remove().draw();                  
                        }
                    });
                }
            }
        });
    });

});    


///::::::: FUNCION PARA VALIDAR LOS DATSO INGRESADOS AL FORMULARIO :::::::::::::::::::///
function f_validar_modulo(Modulo_Id,Mod_Nombre,Mod_NombreVista,Mod_Icono, mod_tipo, mod_plegable){
    f_limpia_modulo();
    let respuesta="";    
    if(Mod_Nombre==""){
        $("#Mod_Nombre").addClass("color-error");
        respuesta="invalido";
    }
    if(Mod_NombreVista==""){
        $("#Mod_NombreVista").addClass("color-error");
        respuesta="invalido";
    }
    if(Mod_Icono==""){
        $("#Mod_Icono").addClass("color-error");
        respuesta="invalido";
    }
    if(mod_tipo==""){
        $("#mod_tipo").addClass("color-error");
        respuesta="invalido";
    }
    if(mod_tipo=="Modulo"){
        if(mod_plegable==""){
            $("#mod_plegable").addClass("color-error");
            respuesta="invalido";
        }
    }
    return respuesta; 
}

///::::::::: INVISIBILIZA LOS MENSAJE DE ALERTA DEL FORMULARIO :::::: /// 
function f_limpia_modulo(){
    $("#Modulo_Id").removeClass("color-error");
    $("#Mod_Nombre").removeClass("color-error");
    $("#Mod_NombreVista").removeClass("color-error");
    $("#Mod_Icono").removeClass("color-error");
    $("#mod_tipo").removeClass("color-error");
    $("#mod_plegable").removeClass("color-error");
}