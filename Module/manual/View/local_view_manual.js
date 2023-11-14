///::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
///:: REGISTRO  MANUAL DE USUARIO v 1.0 :::::::::::::::::::::::::::::::::::::::::::::::::::///
///:: CREAR Y EDITAR DETALLE DE MANUAL DE USUARIO :::::::::::::::::::::::::::::::::::::::::///
///::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///

///:: DECLARACIONES DE VARIABLES GLOBALES :::::::::::::::::::::::::::::::::::::::::::::::::///
var manual_id, man_capitulo, man_sub_capitulo, man_descripcion, man_log, man_html;
var opcion_manual;

///:: JS DOM REGISTRO MANUAL DE USUARIO :::::::::::::::::::::::::::::::::::::::::::::::::::///
$(document).ready(function(){
  let select_manual = '';
  div_show = f_MostrarDiv("form_seleccion_manual_registro","btn_seleccion_manual_registro","");
  $("#div_btn_seleccion_manual_registro").html(div_show);

  $(document).on('change', '.man_capitulo, .man_sub_capitulo', function() {
    manual_id = '';
    man_capitulo = $("#man_capitulo").val();
    man_sub_capitulo = $("#man_sub_capitulo").val();
    manual_id = f_buscar_dato("glo_manual", "manual_id", "`man_capitulo`='"+man_capitulo+"' AND `man_sub_capitulo`='"+man_sub_capitulo+"'");
    man_descripcion = f_buscar_dato("glo_manual", "man_descripcion", "`man_capitulo`='"+man_capitulo+"' AND `man_sub_capitulo`='"+man_sub_capitulo+"'");
    $("#manual_id").val(manual_id);
    $("#man_descripcion").val(man_descripcion);
  });

  ///:: INICIO BOTONES DE CHECK LIST REGISTRO :::::::::::::::::::::::::::::::::::::::::::::///
  
  ///:: EVENTO BOTON BUSCAR REGISTRO MANUAL DE USUARIO ::::::::;;;;;:::::::::::::::::::::::///
  $(document).on("click", ".btn_cargar_manual_registro", function(){
    opcion_manual = '';
    man_html = '';
    manual_id = $("#manual_id").val();
    man_capitulo = $("#man_capitulo").val();
    man_sub_capitulo = $("#man_sub_capitulo").val();
    man_descripcion = $("#man_descripcion").val();

    if(man_capitulo!=='' && man_sub_capitulo!==''){
      if( manual_id=='' ){
        Swal.fire({
          title: '¿Está seguro de crear?',
          html: "Se creará el Capítulo : "+man_capitulo+" Sub Capítulo : "+man_sub_capitulo+" !!!",
          icon: 'warning',
          showCancelButton: true,
          cancelButtonColor: '#d33',
          cancelButtonText: 'Cancelar',
          confirmButtonColor: '#3085d6',
          confirmButtonText: 'Si, crear!',
          focusConfirm: true
        }).then((result) => 
        {
          if(result.isConfirmed){
            opcion_manual = "CREAR";
            f_cargar_html(man_html);
          }
        });
      }else{
        if( manual_id==f_buscar_dato("glo_manual", "manual_id", "`man_capitulo`='"+man_capitulo+"' AND `man_sub_capitulo`='"+man_sub_capitulo+"'") ){
          man_html = f_buscar_dato("glo_manual_html", "man_html", "`manual_id`='"+manual_id+"'");
          opcion_manual = "EDITAR";
          f_cargar_html(man_html);
        }
      }
    }else{
      Swal.fire({
        position            : 'center',
        icon                : 'error',
        title               : "Ingresar Capítulo y Sub Capítulo !!!",
        showConfirmButton   : false,
        timer               : 1500
      })
    }
  });
  ///:: FIN EVENTO BOTON BUSCAR REGISTRO MANUAL DE USUARIO :::::::::::::::::::::::::::///

  ///:: EVENTO BOTON GUARDAR REGISTRO MANUAL DE USUARIO ::::::::::::::::::::::::::::::///
  $(document).on("click", ".btn_guardar_manual_registro", function(){
    let validar_manual_registro = "";
    manual_id = $("#manual_id").val();
    man_capitulo = $("#man_capitulo").val();
    man_sub_capitulo = $("#man_sub_capitulo").val();
    man_descripcion = $("#man_descripcion").val();
    man_html = tinymce.get("man_html").getContent();

    validar_manual_registro = f_valida_agregar_manual(manual_id, man_capitulo, man_sub_capitulo, man_descripcion, man_html);
   
    if(validar_manual_registro=="invalido"){
      Swal.fire({
        icon  : 'error',
        title : 'MANUAL DE USUARIO...',
        text  : 'Falta completar información !!!'
      })

    }else{
      $("#btn_guardar_manual_registro").prop("disabled",true); 
      if(opcion_manual=="CREAR"){
        Accion = "crear_manual_registro";
      }
      if(opcion_manual=="EDITAR"){
        Accion = "editar_manual_registro";
      }
      $.ajax({
        url       : "Ajax.php",
        type      : "POST",
        datatype  : "json",
        async     : false,
        data      :  { MoS:MoS, NombreMoS:NombreMoS, Accion:Accion, manual_id:manual_id, man_capitulo:man_capitulo, man_sub_capitulo:man_sub_capitulo, man_descripcion:man_descripcion, man_html:man_html },
        success   : function(data) {
          Swal.fire(
            'Guardado!',
            'El registro ha sido guardado.',
            'success'
          )            
        }
      });
      div_show = f_MostrarDiv("form_seleccion_manual_registro","btn_seleccion_manual_registro","");
      $("#div_btn_seleccion_manual_registro").html(div_show);
      $("#div_manual_html").empty();
      $("#div_btn_guardar_manual_registro").empty();
      $("#man_capitulo").focus().select();
      $("#btn_guardar_manual_registro").prop("disabled",false);
    }
  });
  ///:: FIN EVENTO BOTON GUARDAR REGISTRO MANUAL DE USUARIO :::::::::::::::::::::::::::::::///

  ///:: EVENTO BOTON CANCELAR REGISTRO MANUAL DE USUARIO ::::::::::::::::::::::::::::::::::///
  $(document).on("click", ".btn_cancelar_manual_registro", function(){
    div_show = f_MostrarDiv("form_seleccion_manual_registro","btn_seleccion_manual_registro","");
    $("#div_btn_seleccion_manual_registro").html(div_show);
    $("#div_manual_html").empty();
    $("#man_capitulo").focus().select();
  });
  ///:: FIN EVENTO BOTON CANCELAR REGISTRO MANUAL DE USUARIO ::::::::::::::::::::::::::::::///

  ///:: EVENTO BOTON LOG REGISTRO MANUAL DE USUARIO :::::::::::::::::::::::::::::::::::::::///
  $(document).on("click", ".btn_log_manual_registro", function(){
    $("#form_modal_log_manual").trigger("reset");
    manual_id = $("#t_manual_id").val();
    man_log = f_buscar_dato("manto_manual_registro","man_log","`manual_id` = '"+manual_id+"'");
    $("#div_log_manual").html(man_log);
    $(".modal-header").css( "background-color", "#17a2b8");
    $(".modal-header").css( "color", "white" );
    $(".modal-title").text("Log");
    $('#modal_crud_log_manual').modal('show');
  });
  ///:: FIN EVENTO BOTON LOG REGISTRO MANUAL DE USUARIO :::::::::::::::::::::::::::::::::::///

  ///:: EVENTO BOTON VER REGISTRO MANUAL DE USUARIO :::::::::::::::::::::::::::::::::::::::///
  $(document).on("click", ".btn_ver_manual_registro", function(){
  });
  ///:: FIN EVENTO BOTON VER REGISTRO MANUAL DE USUARIO :::::::::::::::::::::::::::::::::::///

  ///:: TERMINO BOTONES DE CHECK LIST REGISTRO ::::::::::::::::::::::::::::::::::::::::::::///
});
///:: FUNCIONES REGISTRO MANUAL DE USUARIO ::::::::::::::::::::::::::::::::::::::::::::::::///

///:: FUNCION PARA VALIDAR LOS DATOS INGRESADOS AL FORMULARIO :::::::::::::::::::::::::::::///
function f_valida_agregar_manual(p_manual_id, p_man_capitulo, p_man_sub_capitulo, p_man_descripcion){
  f_limpia_manual_registro();
  let rpta_valida_agregar_manual = "";
  
  /*if(p_manual_id==""){
    $("#manual_id").addClass("color-error");
    rpta_valida_agregar_manual = "invalido";
  }*/
  if(p_man_capitulo==""){
    $("#man_capitulo").addClass("color-error");
    rpta_valida_agregar_manual = "invalido";
  }
  if(p_man_sub_capitulo==""){
    $("#man_sub_capitulo").addClass("color-error");
    rpta_valida_agregar_manual = "invalido";
  }
  if(p_man_descripcion==""){
    $("#man_descripcion").addClass("color-error");
    rpta_valida_agregar_manual = "invalido";
  }
  return rpta_valida_agregar_manual;
}
///:: FUNCION PARA VALIDAR LOS DATOS INGRESADOS AL FORMULARIO :::::::::::::::::::::::::::::///

///:: REESTABLECE EL COLOR DE LOS CAMPOS INVALIDOS ::::::::::::::::::::::::::::::::::::::::/// 
function f_limpia_manual_registro(){
  $("#manual_id").removeClass("color-error");
  $("#man_capitulo").removeClass("color-error");
  $("#man_sub_capitulo").removeClass("color-error");
  $("#man_descripcion").removeClass("color-error");
}
///:: FIN REESTABLECE EL COLOR DE LOS CAMPOS INVALIDOS ::::::::::::::::::::::::::::::::::::///

function f_cargar_html(p_man_html){

  div_show = f_MostrarDiv("form_manual_html","div_manual_html",p_man_html);
  $("#div_manual_html").html(div_show);

  tinymce.init({
    selector: 'textarea#man_html',
    plugins: 'image code',
    toolbar: 'undo redo | link image | code',
    /* enable title field in the Image dialog*/
    image_title: true,
    /* enable automatic uploads of images represented by blob or data URIs*/
    automatic_uploads: true,
    /*
      URL of our upload handler (for more details check: https://www.tiny.cloud/docs/configure/file-image-upload/#images_upload_url)
      images_upload_url: 'postAcceptor.php',
      here we add custom filepicker only to Image dialog
    */
    file_picker_types: 'image',
    /* and here's our custom image picker*/
    file_picker_callback: (cb, value, meta) => {
      const input = document.createElement('input');
      input.setAttribute('type', 'file');
      input.setAttribute('accept', 'image/*');
  
      input.addEventListener('change', (e) => {
        const file = e.target.files[0];
  
        const reader = new FileReader();
        reader.addEventListener('load', () => {
          /*
            Note: Now we need to register the blob in TinyMCEs image blob
            registry. In the next release this part hopefully won't be
            necessary, as we are looking to handle it internally.
          */
          const id = 'blobid' + (new Date()).getTime();
          const blobCache =  tinymce.activeEditor.editorUpload.blobCache;
          const base64 = reader.result.split(',')[1];
          const blobInfo = blobCache.create(id, file, base64);
          blobCache.add(blobInfo);
  
          /* call the callback and populate the Title field with the file name */
          cb(blobInfo.blobUri(), { title: file.name });
        });
        reader.readAsDataURL(file);
      });
  
      input.click();
    },
    content_style: 'body { font-family:Helvetica,Arial,sans-serif; font-size:16px }'
  }); 

  div_show = f_MostrarDiv("form_seleccion_manual_registro","btn_seleccion_manual_registro","guardar");
  $("#div_btn_seleccion_manual_registro").html(div_show);
}
///:: TERMINO FUNCIONES REGISTRO MANUAL DE USUARIO ::::::::::::::::::::::::::::::::::::::::///