///::::::::: ACTIVA LOS TABS ::::::::::::: ///
$(document).ready(function()
{
    div_tabla = f_CreacionTabla("tablaBuses","");
    $("#div_tablaBuses").html(div_tabla);
    columnastabla = f_ColumnasTabla("tablaBuses","");

    Accion='LeerBuses';
    tablaBuses = $('#tablaBuses').DataTable({
        language: idiomaEspanol,
        responsive: "true",
        dom: 'Blfrtip', // Con Botones Excel,Pdf,Print
        buttons:[
            {
                extend      : 'excelHtml5',
                text        : '<i class="fas fa-file-excel"></i> ',
                titleAttr   : 'Exportar a Excel',
                className   : 'btn btn-success'
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

    ///::::::::: EVENTO DEL BOTON NUEVO ::::::::::::::///
    $("#btnNuevoBuses").click(function(){
        opcion = 1; // Alta 
        f_LimpiaMsBuses();
        $("#Bus_NroExterno").prop('disabled', false);
        $("#formBuses").trigger("reset");
        $(".modal-header").css( "background-color", "#17a2b8");
        $(".modal-header").css( "color", "white" );
        $(".modal-title").text("Alta de Buses");
        $('#modalCRUDBuses').modal('show');	    
    });

    ///::::::::: BOTON EDITAR ::::::::::::::::::::::///       
    $(document).on("click", ".btnEditarBuses", function(){
        opcion = 2;// Editar
        f_LimpiaMsBuses();
        $("#Bus_NroExterno").prop('disabled', true);
        fila = $(this).closest("tr");	        
        Bus_NroExterno = fila.find('td:eq(0)').text();
        Bus_NroVid = fila.find('td:eq(1)').text();
        Bus_NroPlaca = fila.find('td:eq(2)').text();
        Bus_Operacion = fila.find('td:eq(3)').text();
        Bus_Detalle = fila.find('td:eq(4)').text();
        Bus_Tipo = fila.find('td:eq(5)').text();
        Bus_Tipo2 = fila.find('td:eq(6)').text();
        Bus_Estado = fila.find('td:eq(7)').text();
        Bus_Tanques = fila.find('td:eq(8)').text();

        $("#Bus_NroExterno").val(Bus_NroExterno);
        $("#Bus_NroVid").val(Bus_NroVid);
        $("#Bus_NroPlaca").val(Bus_NroPlaca);
        $("#Bus_Operacion").val(Bus_Operacion);
        $("#Bus_Detalle").val(Bus_Detalle);
        $("#Bus_Tipo").val(Bus_Tipo);
        $("#Bus_Tipo2").val(Bus_Tipo2);
        $("#Bus_Estado").val(Bus_Estado);
        $("#Bus_Tanques").val(Bus_Tanques);
        
        $(".modal-header").css("background-color", "#007bff");
        $(".modal-header").css("color", "white" );
        $(".modal-title").text("Editar Buses");		
    
        $('#modalCRUDBuses').modal('show');		   
    });

    /// ::::::::::::::: CREA Y EDITA USUARIO :::::::::::::///
    $('#formBuses').submit(function(e){                         
        let validacionBuses;
        e.preventDefault(); //evita el comportambiento normal del submit, es decir, recarga total de la página
        Bus_NroExterno = $.trim($('#Bus_NroExterno').val());    
        Bus_NroVid = $.trim($('#Bus_NroVid').val());
        Bus_NroPlaca = $.trim($('#Bus_NroPlaca').val());    
        Bus_Operacion = $.trim($('#Bus_Operacion').val());
        Bus_Detalle = $.trim($('#Bus_Detalle').val());
        Bus_Tipo = $.trim($('#Bus_Tipo').val());
        Bus_Tipo2 = $.trim($('#Bus_Tipo2').val());
        Bus_Estado = $.trim($('#Bus_Estado').val());
        Bus_Tanques = $.trim($('#Bus_Tanques').val());
    
        validacionBuses = validarBuses(Bus_NroExterno,Bus_NroVid,Bus_NroPlaca,Bus_Operacion,Bus_Detalle,Bus_Tipo,Bus_Tipo2,Bus_Estado,Bus_Tanques);
        
        if(validacionBuses == "invalido"){
            Swal.fire({
              position: 'center',
              icon: 'error',
              title: '*Falta Completar Información!!!',
              showConfirmButton: false,
              timer: 1500
            })
        }else{
            /// CREAR
            if(opcion == 1) {   
                $("#btnGuardarBuses").prop("disabled",true);
                Accion='CrearBuses';
                $.ajax({
                    url: "Ajax.php",
                    type: "POST",
                    datatype:"json",    
                    data:  { MoS:MoS,NombreMoS:NombreMoS,Accion:Accion,Bus_NroExterno:Bus_NroExterno,Bus_NroVid:Bus_NroVid,Bus_NroPlaca:Bus_NroPlaca,Bus_Operacion:Bus_Operacion,Bus_Detalle:Bus_Detalle,Bus_Tipo:Bus_Tipo,Bus_Tipo2:Bus_Tipo2,Bus_Estado:Bus_Estado,Bus_Tanques:Bus_Tanques},    
                    success: function(data) {
                        tablaBuses.ajax.reload(null, false);
                        $("#btnGuardarBuses").prop("disabled",false);
                    }
                });
                $('#modalCRUDBuses').modal('hide');
            } 
            /// EDITAR
            if(opcion == 2) {   
                $("#btnGuardarBuses").prop("disabled",true);
                Accion='EditarBuses';
                $.ajax({
                    url: "Ajax.php",
                    type: "POST",
                    datatype:"json",    
                    data:  { MoS:MoS,NombreMoS:NombreMoS,Accion:Accion,Bus_NroExterno:Bus_NroExterno,Bus_NroVid:Bus_NroVid,Bus_NroPlaca:Bus_NroPlaca,Bus_Operacion:Bus_Operacion,Bus_Detalle:Bus_Detalle,Bus_Tipo:Bus_Tipo,Bus_Tipo2:Bus_Tipo2,Bus_Estado:Bus_Estado,Bus_Tanques:Bus_Tanques},    
                    success: function(data) {
                        tablaBuses.ajax.reload(null, false);
                        $("#btnGuardarBuses").prop("disabled",false);
                    }
                });
                $('#modalCRUDBuses').modal('hide');
            } 
        }
    });
        
    ///::::::::  BOTON BORRAR REGISTRO  
    $(document).on("click", ".btnBorrarBuses", function(){
        fila = $(this);           
        Bus_NroExterno = $(this).closest('tr').find('td:eq(0)').text();     

        respuesta = 0;
        Swal.fire({
            title: '¿Está seguro?',
            text: "Se eliminara el bus "+Bus_NroExterno+"!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si, eliminar!'
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire(
                    'Eliminado!',
                    'El bus se ha sido eliminado.',
                    'success'
                )
                Accion='BorrarBuses';
    
                if (respuesta = 1) {            
                    $.ajax({
                    url: "Ajax.php",
                    type: "POST",
                    datatype:"json",    
                    data:  { MoS:MoS,NombreMoS:NombreMoS,Accion:Accion,Bus_NroExterno:Bus_NroExterno },   
                        success: function() {
                        tablaBuses.row(fila.parents('tr')).remove().draw();
                        }
                    });
                }
            }
        });
    });
});

///::::::: FUNCION PARA VALIDAR LOS DATSO INGRESADOS AL FORMULARIO :::::::::::::::::::///
function validarBuses(pBus_NroExterno,pBus_NroVid,pBus_NroPlaca,pBus_Operacion,pBus_Detalle,pBus_Tipo,pBus_Tipo2,pBus_Estado,pBus_Tanques){
    f_LimpiaMsBuses();
    NoLetrasMayuscEspacio=/[^A-Z \Ñ]/;
    let rptaBuses="";

    if(pBus_NroExterno==""){
        $("#Bus_NroExterno").addClass("color-error");
        rptaBuses="invalido";
      }
    
    return rptaBuses; 
}

///::::::::: INVISIBILIZA LOS MENSAJE DE ALERTA DEL FORMULARIO :::::: /// 
function f_LimpiaMsBuses(){
    $("#MsBus_NroExterno").removeClass("color-error");
    $("#MsBus_NroVid").removeClass("color-error");
    $("#MsBus_NroPlaca").removeClass("color-error");
    $("#MsBus_Operacion").removeClass("color-error");
    $("#MsBus_Detalle").removeClass("color-error");
}