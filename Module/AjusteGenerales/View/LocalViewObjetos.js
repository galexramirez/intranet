///:::::::::::::::::: DECLARACION DE VARIABLES ::::::::::::::::::::::::::::::///
var objetos_id,obj_nombremodulo,obj_nombreobjeto,obj_descripcion;
var tablaObjetos, opcionObjetos, filaObjetos;

///::::::::: ACTIVA LOS TABS ::::::::::::: ///
$(document).ready(function()
{

    div_tabla = f_CreacionTabla("tablaObjetos","");
    $("#div_tablaObjetos").html(div_tabla);
    columnastabla = f_ColumnasTabla("tablaObjetos","");

    Accion='LeerObjetos';
    tablaObjetos = $('#tablaObjetos').DataTable({
        language: idiomaEspanol,
        responsive: "true",
        dom: 'Blfrtip', // Con Botones Excel,Pdf,Print
        buttons:[
            {
                extend:     'excelHtml5',
                text:       '<i class="fas fa-file-excel"></i> ',
                titleAttr:  'Exportar a Excel',
                className:  'btn btn-success'
            },
        ],
        "ajax":{            
                "url": "Ajax.php", 
                "method": 'POST', //usamos el metodo POST
                "data":{MoS:MoS,NombreMoS:NombreMoS,Accion:Accion}, //enviamos opcion 4 para que haga un SELECT
                "dataSrc":""
                },
        "columns": columnastabla
    });     

    ///::::::::: EVENTO DEL BOTON NUEVO ::::::::::::::///
    $("#btnNuevoObjeto").click(function(){
        opcionObjetos = 1; // Alta 
        f_LimpiaObjetos();
        f_select_combos_objetos();
        $("#obj_nombremodulo").prop('disabled', false);
        $("#obj_nombreobjeto").prop('disabled', false);
        $("#formObjetos").trigger("reset");
        $(".modal-header").css( "background-color", "#17a2b8");
        $(".modal-header").css( "color", "white" );
        $(".modal-title").text("Alta de Objetos");
        $('#modalCRUDObjetos').modal('show');	    
    });

    ///::::::::: BOTON EDITAR ::::::::::::::::::::::///       
    $(document).on("click", ".btnEditarObjeto", function(){
        opcionObjetos = 2;// Editar
        f_LimpiaObjetos();
        f_select_combos_objetos();
        $("#obj_nombremodulo").prop('disabled', true);
        $("#obj_nombreobjeto").prop('disabled', true);
        filaObjetos = $(this).closest("tr");	        
        objetos_id = filaObjetos.find('td:eq(0)').text();
        obj_nombremodulo = filaObjetos.find('td:eq(1)').text();
        obj_nombreobjeto = filaObjetos.find('td:eq(2)').text();
        obj_descripcion = filaObjetos.find('td:eq(3)').text();

        $("#objetos_id").val(objetos_id);
        $("#obj_nombremodulo").val(obj_nombremodulo);
        $("#obj_nombreobjeto").val(obj_nombreobjeto);
        $("#obj_descripcion").val(obj_descripcion);
        
        $(".modal-header").css("background-color", "#007bff");
        $(".modal-header").css("color", "white" );
        $(".modal-title").text("Editar Objetos");		
    
        $('#modalCRUDObjetos').modal('show');		   
    });

    /// ::::::::::::::: CREA Y EDITA USUARIO :::::::::::::///
    $('#formObjetos').submit(function(e){                         
        let validacionObjetos;
        let existeObjetos = "";
        e.preventDefault(); //evita el comportambiento normal del submit, es decir, recarga total de la página
        objetos_id          = $.trim($('#objetos_id').val());
        obj_nombremodulo    = $.trim($('#obj_nombremodulo').val());
        obj_nombreobjeto    = $.trim($('#obj_nombreobjeto').val());
        obj_descripcion     = $.trim($('#obj_descripcion').val());

        validacionObjetos = f_validarObjetos(obj_nombremodulo,obj_nombreobjeto,obj_descripcion);
        
        if(validacionObjetos == "invalido"){
            Swal.fire({
              position: 'center',
              icon: 'error',
              title: '*Falta Completar Información!!!',
              showConfirmButton: false,
              timer: 1500
            })
        }else{
            /// CREAR
            if(opcionObjetos == 1) {
                Accion='ValidarObjetos';
                $.ajax({
                    url: "Ajax.php",
                    type: "POST",
                    datatype:"json",
                    async: false,
                    data:  { MoS:MoS,NombreMoS:NombreMoS,Accion:Accion, obj_nombremodulo:obj_nombremodulo, obj_nombreobjeto:obj_nombreobjeto},    
                    success: function(data) {
                        existeObjetos = data;
                    }
                });
                if(existeObjetos=="SI"){
                    Swal.fire(
                        'Registro!',
                        'El registro ya existe ...',
                        'success'
                    )
                    $("#obj_nombremodulo").addClass("color-error");
                    $("#obj_nombreobjeto").addClass("color-error");
                }else{
                    $("#btnGuardarObjeto").prop("disabled",true);
                    Accion='CrearObjetos';
                    $.ajax({
                        url: "Ajax.php",
                        type: "POST",
                        datatype:"json",    
                        data:  { MoS:MoS,NombreMoS:NombreMoS,Accion:Accion,objetos_id:objetos_id,obj_nombremodulo:obj_nombremodulo,obj_nombreobjeto:obj_nombreobjeto,obj_descripcion:obj_descripcion},    
                        success: function(data) {
                            tablaObjetos.ajax.reload(null, false);
                            $("#btnGuardarObjeto").prop("disabled",false);
                        }
                    });
                    $('#modalCRUDObjetos').modal('hide');
                }
            } 
            /// EDITAR
            if(opcionObjetos == 2) {   
                $("#btnGuardarObjeto").prop("disabled",true);
                Accion='EditarObjetos';
                $.ajax({
                    url: "Ajax.php",
                    type: "POST",
                    datatype:"json",    
                    data:  { MoS:MoS,NombreMoS:NombreMoS,Accion:Accion,objetos_id:objetos_id,obj_nombremodulo:obj_nombremodulo,obj_nombreobjeto:obj_nombreobjeto,obj_descripcion:obj_descripcion},    
                    success: function(data) {
                        tablaObjetos.ajax.reload(null, false);
                        $("#btnGuardarObjeto").prop("disabled",false);
                    }
                });
                $('#modalCRUDObjetos').modal('hide');
            } 
        }
    });
        
    ///::::::::  BOTON BORRAR REGISTRO  
    $(document).on("click", ".btnBorrarObjeto", function(){
        filaObjetos = $(this);           
        objetos_id = filaObjetos.closest('tr').find('td:eq(0)').text();     
        let respuestaObjetos = 0;
        Swal.fire({
            title: '¿Está seguro?',
            text: "Se eliminará el registro "+objetos_id+"!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si, eliminar!'
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire(
                    'Eliminado!',
                    'El registro se ha sido eliminado.',
                    'success'
                )
                respuestaObjetos = 1;
                // Nombre
                Accion='BorrarObjetos';
                if (respuestaObjetos == 1) {            
                    $.ajax({
                    url: "Ajax.php",
                    type: "POST",
                    datatype:"json",
                    async: false,    
                    data:  { MoS:MoS,NombreMoS:NombreMoS,Accion:Accion,objetos_id:objetos_id },   
                        success: function(data) {
                            tablaObjetos.row(filaObjetos.parents('tr')).remove().draw();
                        }
                    });
                }
            }
        });
    });
});

///::::::: FUNCION PARA VALIDAR LOS DATSO INGRESADOS AL FORMULARIO :::::::::::::::::::///
function f_validarObjetos(pobj_nombremodulo,pobj_nombreobjeto,pobj_descripcion){
    f_LimpiaObjetos();
    NoLetrasMayuscEspacio=/[^A-Z \Ñ]/;
    let rptaObjetos="";

    if(pobj_nombremodulo==""){
        $("#obj_nombremodulo").addClass("color-error");
        rptaObjetos = "invalido";
    }
    if(pobj_nombreobjeto==""){
        $("#obj_nombreobjeto").addClass("color-error");
        rptaObjetos = "invalido";
    }
    if(pobj_descripcion==""){
        $("#obj_descripcion").addClass("color-error");
        rptaObjetos = "invalido";
    }
    return rptaObjetos;
}

///::::::::: INVISIBILIZA LOS MENSAJE DE ALERTA DEL FORMULARIO :::::: /// 
function f_LimpiaObjetos(){
    $("#objetos_id").removeClass("color-error");
    $("#obj_nombremodulo").removeClass("color-error");
    $("#obj_nombreobjeto").removeClass("color-error");
    $("#obj_descripcion").removeClass("color-error");
}

function f_select_combos_objetos(){
    Accion='SelectModulo'; 
    $.ajax({
      url: "Ajax.php",
      type: "POST",
      datatype:"json",
      async: false,
      data: {MoS:MoS,NombreMoS:NombreMoS,Accion:Accion},    
      success: function(data){
        $("#obj_nombremodulo").html(data);
      }
    });
}