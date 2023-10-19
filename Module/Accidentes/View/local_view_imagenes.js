///::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
///:: TAB IMAGENES v 4.0  FECHA: 2023-05-10 :::::::::::::::::::::::::::::::::::::::::::::::///
///:: CREAR, EDITAR, ELIMINAR TABLA ope_accidentes_imagenes :::::::::::::::::::::::::::::::///
///::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///

///:: DECLARACION DE VARIABLES ::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///

///:: INICIO DOM JS IMAGENES ::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
$(document).ready(function(){

  ///:: COLOCA EL NOMBRE DEL ARCHIVO EN EL INPUT FILE PARA IMAGENES Y MAPA ::::::::::::::::///
  $(document).on('change', '#Acci_Imagen', function (event) {
    fotoEditar = "";
    let NombreArch = event.target.files[0].name;
    let Extension = NombreArch.split('.').pop();
    if (Extension!='jpg'){
      Swal.fire({
        icon  : 'error',
        title : 'EXTENSION...',
        text  : '*El archivo no tiene la extension *.jpg!!!'
      });
    }else{
      let archivo = event.target.files[0];
      let reader  = new FileReader();
      if (archivo) {
        reader.readAsDataURL(archivo );
        reader.onloadend  = function () {
          fotoEditar      = '<img src="' + reader.result + '" class="rounded img-fluid img-thumbnail" alt="Responsive image"/>';
          $("#div_ImagenCarga").html(fotoEditar);
        }
      }  
    }
    $("#labelAcci_Imagen").text(NombreArch);
  });

  ///:: COLOCA EL NOMBRE DEL ARCHIVO EN EL INPUT FILE PARA IMAGEN BUS :::::::::::::::::::::///
  $(document).on('change', '#Acci_ImagenBus', function (event) {
    fotoEditar      = "";
    let NombreArch  = event.target.files[0].name;
    let Extension   = NombreArch.split('.').pop();
    $("#labelAcci_ImagenBus").text(NombreArch);
    let archivo     = event.target.files[0];
    let reader      = new FileReader();
    if (archivo) {
      reader.readAsDataURL(archivo );
      reader.onloadend  = function () {
        fotoEditar      = '<img src="' + reader.result + '" class="rounded img-fluid img-thumbnail" alt="Responsive image"/>';
        $("#div_ImagenBus").html(fotoEditar);
      }
    }
  });

  ///:: INICIO BOTONES IMAGENES :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///

  ///:: BOTON CARGAR IMAGEN -> REALIZA LA GRABACION EN LA TABLA OPE_AccidentesImagenes IMAGENES Y MAPA ::///
  $('#formModalImagenesCarga').submit(function(e){
    let grabar_imagen = "";
    e.preventDefault(); //evita el comportambiento normal del submit, es decir, recarga total de la página
    let fotoEditar="";
    grabar_imagen = f_GrabarImagen(opcionCargaImagenes);
    if(grabar_imagen!=""){
      Swal.fire({
        icon  : 'error',
        title : 'IMAGEN...',
        text  : '* '+grabar_imagen+' !!!'
      });
    }else{
      let archivo = $('#Acci_Imagen')[0].files[0];
      let reader = new FileReader();
      if (archivo) {
        reader.readAsDataURL(archivo );
        reader.onloadend = function () {
          fotoEditar='<img src="' + reader.result + '" class="card-img-top rounded img-fluid img-thumbnail" alt="Responsive image" />';
          if(Acci_TipoImagen=="Imagen1"){
            $("#div_Imagen1").html(fotoEditar);
          }
          if(Acci_TipoImagen=="Imagen2"){
            $("#div_Imagen2").html(fotoEditar);
          }
          if(Acci_TipoImagen=="Imagen3"){
            $("#div_Imagen3").html(fotoEditar);
          }
          if(Acci_TipoImagen=="Imagen4"){
            $("#div_Imagen4").html(fotoEditar);
          }
          if(Acci_TipoImagen=="Mapa"){
            $("#div_Mapa").html(fotoEditar);
          }
        }
      }  
    }
    $('#modalCRUDImagenesCarga').modal('hide');
  });
  ///:: FIN BOTON CARGAR IMAGEN -> REALIZA LA GRABACION EN LA TABLA OPE_AccidentesImagenes IMAGENES Y MAPA ::///

  ///:: TERMINO BOTON IMAGENES ::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///

});
///:: TERMINO DOM JS IMAGENES :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///

///:: INICIO FUNCIONES DE IMAGENES ::::::::::::::::::::::::::::::::::::::::::::::::::::::::///

///:: BUSCAR IMAGEN :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///       
function f_BuscarImagen(p_Acci_TipoImagen){
  let img = "";
  if(InformePreliminar_Id!=""){
    Accion  = 'BuscarImagen';
    $.ajax({
        url       : "Ajax.php",
        type      : "POST",
        datatype  : "json",    
        async     : false,   
        data      : { MoS:MoS,NombreMoS:NombreMoS,Accion:Accion,Accidentes_Id:InformePreliminar_Id,Acci_TipoImagen:p_Acci_TipoImagen },   
        success   : function(data) {
            data = $.parseJSON(data);
            $.each(data, function(idx, obj){ 
                if(obj.b64_Foto){
                    img  = 'data:image/jpg;base64,' + obj.b64_Foto;
                }
            });
        }
    });
  }
  return img;
}
///:: FIN BUSCAR IMAGEN :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///

///:: GRABAR IMAGEN :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
function f_GrabarImagen(p_opcionCargaImagenes){
  let rpta_grabar_imagen = "";
  let blobFile;
  let formData = new FormData();
  if(Acci_TipoImagen=="Bus"){
    blobFile = $('#Acci_ImagenBus')[0].files[0];
  }else{
    blobFile = $('#Acci_Imagen')[0].files[0];
  }
  if(p_opcionCargaImagenes==1){
    Accion='GrabarImagen';
  }else{
    Accion='EditarImagen';
  }
  formData.append("MoS", MoS);
  formData.append("NombreMoS", NombreMoS);
  formData.append("Accion", Accion);
  formData.append("Accidentes_Id", InformePreliminar_Id);
  formData.append("Acci_TipoImagen", Acci_TipoImagen);
  formData.append("Acci_Imagen", blobFile);
  if(InformePreliminar_Id!=""){
    $.ajax({
      url         : "Ajax.php",
      type        : "POST",
      datatype    : "json",    
      data        :  formData,   
      contentType : false,
      processData : false,
      success     : function(data) {
        rpta_grabar_imagen = data;
      }
    });	
  }
  return rpta_grabar_imagen;
} 
///:: FIN GRABAR IMAGEN :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///

///:: CARGAR IMAGEN :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
function f_CargarImagenes(html_Imagen){
  let pImagen;
  let buscarImagen="";
  Acci_TipoImagen = html_Imagen;
  if(Acci_TipoImagen == "Bus"){
    $("#formModalImagenesBus").trigger("reset");
  }else{
    $("#formModalImagenesCarga").trigger("reset");
  }
  buscarImagen = f_BuscarImagen(Acci_TipoImagen);
  if(buscarImagen==""){
    pImagen = '<img src="Module/Accidentes/View/Img/SinImagen.jpg" class="rounded img-fluid img-thumbnail" alt="Responsive image" >';
    opcionCargaImagenes = 1; //CREAR nueva imagen
  }else{
    pImagen = '<img src="' + buscarImagen + '" class="rounded img-fluid img-thumbnail" alt="Responsive image" >';
    opcionCargaImagenes = 2; //EDITAR imagen
  }
  
  $(".modal-header").css( "background-color", "#17a2b8");
  $(".modal-header").css( "color", "white" );

  if(Acci_TipoImagen == "Bus"){
    $("#div_ImagenBus").html(pImagen);
    $("#labelAcci_ImagenBus").text("Seleccionar Archivo .jpg o .bmp");
    $(".modal-title").text("Carga de Bus");
    $('#modalCRUDImagenesBus').modal('show');
  }else{
    if(Acci_TipoImagen == "Mapa"){
      $(".modal-title").text("Carga de Mapa");
    }else{
      $(".modal-title").text("Carga de Imagenes");
    }
    $("#div_ImagenCarga").html(pImagen);
    $("#labelAcci_Imagen").text("Seleccionar Archivo .jpg o .bmp");
    $('#modalCRUDImagenesCarga').modal('show');
  }
}
///:: FIN CARGAR IMAGEN :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///

///:: TERMINO FUNCIONES DE IMAGENES :::::::::::::::::::::::::::::::::::::::::::::::::::::::///