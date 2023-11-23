var MoS, NombreMoS, Accion, div_show;    
MoS ='Module';
NombreMoS ='Nomina';

$(document).ready(function()
{
  div_show = f_MostrarDiv("contenido", "div_alertsDropdown_ayuda", NombreMoS);
  $("#div_alertsDropdown_ayuda").html(div_show);

  $('#tablaUsuarios').hide();  

  ///::::::::::::::: JS CARGA DE DATA TABLE :::::::::::::://
  $("#btnCargarNomina").on("click",function()
  {
      let FechaInicio = $("#FechaInicio").val();
      let FechaTermino = $("#FechaTermino").val();
      Accion='CargarNomina';

      validacion = validar(FechaInicio,FechaTermino);

      if(validacion!="invalido"){
      $("#tablaUsuarios").dataTable().fnDestroy();
      $('#tablaUsuarios').show();
      tablaUsuarios = $('#tablaUsuarios').DataTable({
        //Para cambiar el lenguaje a español
        language:
          {
            "lengthMenu": "&nbsp&nbsp&nbsp&nbspMostrar _MENU_ registros",
            "zeroRecords": "No se encuentran resultados",
            "info": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
            "infoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
            "infoFiltered": "(Filtrado de un total de _MAX_ registros)",
            "sSearch": "Buscar:",
            "oPaginate": 
              {
                "sFirst": "Primero",
                "sLast": "Ultimo",
                "sNext": "Siguiente",
                "sPrevious": "Anterior"
              },
            "sProcesssing": "Procesando...",
          },
        //Para usar los botones
        responsive: "true",
        dom: 'Blfrtip', // Con Botones Excel,Pdf,Print
        buttons:
          [
            {
                extend:     'excelHtml5',
                text:       '<i class="fas fa-file-excel"></i> ',
                titleAttr:  'Exportar a Excel',
                className:  'btn btn-success',
                title:      'Nomina del ' + FechaInicio + ' al ' + FechaTermino,
                filename:   'Nomina del ' + FechaInicio + ' al ' + FechaTermino,
            },
        /*    {
                extend:     'pdfHtml5',
                text:       '<i class="fas fa-file-pdf"></i> ',
                titleAttr:  'Exportar a PDF',
                className:  'btn btn-danger'
            }, 
            {
                extend:     'print',
                text:       '<i class="fa fa-print"></i> ',
                titleAttr:  'Imprimir',
                className:  'btn btn-info'
            },*/
          ],
        "ajax":{            
                "url": "Ajax.php", 
                "method": 'POST', //usamos el metodo POST
                "data":{MoS:MoS,NombreMoS:NombreMoS,Accion:Accion,FechaInicio:FechaInicio,FechaTermino:FechaTermino}, //enviamos opcion 4 para que haga un SELECT
                "dataSrc":""
                },
        "columns":[
                  {"data": "Fecha"},
                  {"data": "Codigo"},                    
                  {"data": "DNI"},                    
                  {"data": "ApellidosNombres"},                    
                  {"data": "HoraInicio"},
                  {"data": "HoraTermino"},                    
                  {"data": "Amplitud"},
                  {"data": "Duracion"},
                  {"data": "TipoOperacion"},
                  {"data": "Servicio"}
                  ]
      });
      }
  });
});    


///::::::: FUNCION PARA VALIDAR LOS DATOS INGRESADOS AL FORMULARIO :::::::::::::::::::///
function validar(FechaInicio,FechaTermino){

  LimpiaMs();

  NoLetrasMayuscEspacio=/[^A-Z ]/;
  var respuesta="";    

  if(FechaTermino < FechaInicio)
      {
      //   $("#MsFechaTermino").text("*Fecha de Termino debe ser mayor");
      //   $("#MsFechaTermino").css("display", "flex" );
         Swal.fire({
          icon: 'error',
          title: 'Fechas...',
          text: '*Fecha de Termino debe ser mayor!'
        })

         respuesta="invalido";
      }
  if(FechaTermino=="" | FechaInicio=="")
      {
      //   $("#MsFechaTermino").text("*Fechas no pueden ser vacios");
      //   $("#MsFechaTermino").css("display", "flex" );
         Swal.fire({
          icon: 'error',
          title: 'Fechas...',
          text: '*Fechas no pueden ser vacios!'
         })

         respuesta="invalido";
      }
  return respuesta; 
}

///::::::::: INVISIBILIZA LOS MENSAJE DE ALERTA DEL FORMULARIO :::::: /// 
function LimpiaMs(){
    $("#MsFechaInicio").css("display", "none" );
    $("#MsFechaTermino").css("display", "none" );
}

function f_MostrarDiv(pNombreFormulario,pNombreObjeto,pDato){
  let rptaMostrarDiv="";
  Accion='MostrarDiv';
  $.ajax({
    url: "Ajax.php",
    type: "POST",
    datatype:"json",
    async: false,
    data: {MoS:MoS,NombreMoS:NombreMoS,Accion:Accion,NombreFormulario:pNombreFormulario,NombreObjeto:pNombreObjeto,Dato:pDato},    
    success: function(data){
      rptaMostrarDiv = data;
    }
  });
  return rptaMostrarDiv;
}

//::::::::::::::::::::::::::::::::: BUSCAR DATA EN BD :::::::::::::::::::::::::::::://
function f_BuscarDataBD(pTablaBD,pCampoBD,pDataBuscar){
  let rptaData;
  Accion='BuscarDataBD';
  $.ajax({
    url: "Ajax.php",
    type: "POST",
    datatype:"json",
    async: false,
    data: {MoS:MoS,NombreMoS:NombreMoS,Accion:Accion,TablaBD:pTablaBD,CampoBD:pCampoBD,DataBuscar:pDataBuscar},    
    success: function(data){
      rptaData = $.parseJSON(data);
    }
  });
  return rptaData;
}

function f_buscar_dato(p_nombre_tabla, p_campo_buscar, p_condicion_where){
  let rpta_buscar = "";
  Accion = 'buscar_dato';
  $.ajax({
    url       : "Ajax.php",
    type      : "POST",
    datatype  : "json",
    async     : false,
    data      : {MoS:MoS, NombreMoS:NombreMoS, Accion:Accion, nombre_tabla:p_nombre_tabla, campo_buscar:p_campo_buscar, condicion_where:p_condicion_where},
    success   : function(data){
      rpta_buscar = data;
    }
  });
  return rpta_buscar;
}

function f_ayuda_modulo(man_titulo){
  let man_modulo_id = f_buscar_dato("Modulo", "Modulo_Id", "`Mod_Nombre` = '"+NombreMoS+"'");
  let manual_id = f_buscar_dato("glo_manual", "manual_id", "`man_modulo_id` = '"+man_modulo_id+"' AND `man_titulo` = '"+man_titulo+"'");
  let man_html = f_buscar_dato("glo_manual_html", "man_html", "`manual_id`='"+manual_id+"'");
  $("#div_ver_ayuda_html").html(man_html);

  $("#form_modal_ver_ayuda").trigger("reset");
  $(".modal-header").css( "background-color", "#17a2b8");
  $(".modal-header").css( "color", "white" );
  $(".modal-title").text( man_titulo );
  $('#modal_crud_ver_ayuda').modal('show');	   
  $('#modal-resizable_ver_ayuda').resizable();
  $(".modal-dialog").draggable({
    cursor: "move",
    handle: ".dragable_touch",
  });         
}