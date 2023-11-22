<?php
$Accion = $_POST['Accion'];   
$Modulo = 'Accidentes';
switch ($Accion)
   {

   //:::::::::::::::::::::::::::::: CREACION DE OBJETOS :::::::::::::::::::::::::::::::::::::::::::::://

   case 'CreacionTabs':
      $NombreTabs=$_POST['NombreTabs'];
      $TipoTabs=$_POST['TipoTabs'];

      MController($Modulo,'Accesos');
      $InstanciaAjax= new Accesos();
      $Respuesta=$InstanciaAjax->CreacionTabs($NombreTabs,$TipoTabs);
   break;

   case 'CreacionTabla':
      $NombreTabla=$_POST['NombreTabla'];
      $TipoTabla=$_POST['TipoTabla'];

      MController($Modulo,'Accesos');
      $InstanciaAjax= new Accesos();
      $Respuesta=$InstanciaAjax->CreacionTabla($NombreTabla,$TipoTabla);
   break;

   case 'ColumnasTabla':
      $NombreTabla=$_POST['NombreTabla'];
      $TipoTabla=$_POST['TipoTabla'];

      MController($Modulo,'Accesos');
      $InstanciaAjax= new Accesos();
      $Respuesta=$InstanciaAjax->ColumnasTabla($NombreTabla,$TipoTabla);
   break;

   case 'BotonesFormulario':
      $NombreFormulario=$_POST['NombreFormulario'];
      $NombreObjeto=$_POST['NombreObjeto'];

      MController($Modulo,'Accesos');
      $InstanciaAjax= new Accesos();
      $Respuesta=$InstanciaAjax->BotonesFormulario($NombreFormulario,$NombreObjeto);
   break;

   case 'DivFormulario':
      $NombreFormulario=$_POST['NombreFormulario'];
      $NombreObjeto=$_POST['NombreObjeto'];

      MController($Modulo,'Accesos');
      $InstanciaAjax= new Accesos();
      $Respuesta=$InstanciaAjax->DivFormulario($NombreFormulario,$NombreObjeto);
   break;

   case 'MostrarDiv':
      $NombreFormulario=$_POST['NombreFormulario'];
      $NombreObjeto=$_POST['NombreObjeto'];
      $Dato=$_POST['Dato'];

      MController($Modulo,'Accesos');
      $InstanciaAjax= new Accesos();
      $Respuesta=$InstanciaAjax->MostrarDiv($NombreFormulario,$NombreObjeto,$Dato);
   break;

   case 'CalculoFecha':
      $inicio= $_POST['inicio'];
      $calculo = $_POST['calculo'];

      MController($Modulo,'Logico');
      $InstanciaAjax= new Logico();
      $Respuesta=$InstanciaAjax->CalculoFecha($inicio,$calculo);
   break;

   case 'antiguedad':
      $inicio= $_POST['inicio'];
      $final = $_POST['final'];

      MController($Modulo,'Logico');
      $InstanciaAjax= new Logico();
      $Respuesta=$InstanciaAjax->antiguedad($inicio,$final);
   break;

   case 'DiferenciaFecha':
      $inicio = $_POST['inicio'];
      $final = $_POST['final'];
      $dias = $_POST['dias'];

      MController($Modulo,'Logico');
      $InstanciaAjax= new Logico();
      $Respuesta=$InstanciaAjax->DiferenciaFecha($inicio,$final,$dias);
   break;

   case 'buscar_dato':
      $nombre_tabla     = $_POST['nombre_tabla'];
      $campo_buscar     = $_POST['campo_buscar'];
      $condicion_where  = $_POST['condicion_where'];

      MController($Modulo,'Logico');
      $InstanciaAjax = new Logico();
      $Respuesta     = $InstanciaAjax->buscar_dato($nombre_tabla, $campo_buscar, $condicion_where);
   break;

   ///:::::::::::::::::::::::::::::: FIN DE CREACION DE OBJETOS :::::::::::::::::::::::::::::::::::::///

   case 'BuscarAccidentes':
      $fecha_inicio  = $_POST['fecha_inicio'];
      $fecha_termino = $_POST['fecha_termino'];
      
      MModel($Modulo,'CRUD');
      $InstanciaAjax= new CRUD();
      $Respuesta=$InstanciaAjax->BuscarAccidentes($fecha_inicio, $fecha_termino);
   break;

   case 'BuscarColaborador':
      $Acci_NombreColaborador = $_POST['Acci_NombreColaborador'];

      MController($Modulo,'Logico');
      $InstanciaAjax= new Logico();
      $Respuesta=$InstanciaAjax->BuscarColaborador($Acci_NombreColaborador);
   break;

   case 'BuscarNroPlaca':
      $Acci_Bus = $_POST['Acci_Bus'];
      
      MController($Modulo,'Logico');
      $InstanciaAjax= new Logico();
      $Respuesta=$InstanciaAjax->BuscarNroPlaca($Acci_Bus);
   break;

   case 'DetalleControlFacilitador':
      $Nove_ProgramacionId = $_POST['Nove_ProgramacionId'];
      $Novedad_Id = $_POST['Novedad_Id'];

      MController($Modulo,'Logico');
      $InstanciaAjax= new Logico();
      $Respuesta=$InstanciaAjax->DetalleControlFacilitador($Nove_ProgramacionId,$Novedad_Id);
   break;

   case 'CargaTablaNaturaleza':
      $Accidentes_Id = $_POST['Accidentes_Id'];
      $Acci_Tipo = $_POST['Acci_Tipo'];

      MModel($Modulo,'CRUD');
      $InstanciaAjax= new CRUD();
      $Respuesta=$InstanciaAjax->CargaTablaNaturaleza($Accidentes_Id,$Acci_Tipo);
   break;

   case 'EliminarTablaNaturaleza':
      $OPE_AcciNaturalezaId = $_POST['OPE_AcciNaturalezaId'];
      $Accidentes_Id = $_POST['Accidentes_Id'];
      $Acci_Tipo = $_POST['Acci_Tipo'];

      MModel($Modulo,'CRUD');
      $InstanciaAjax= new CRUD();
      $Respuesta=$InstanciaAjax->EliminarTablaNaturaleza($OPE_AcciNaturalezaId,$Accidentes_Id,$Acci_Tipo);
   break;

   case 'CrearAccidentesNaturaleza':
      $Accidentes_Id    = $_POST['Accidentes_Id'];
      $Acci_Tipo        = $_POST['Acci_Tipo'];
      $Acci_Descripcion = strtoupper($_POST['Acci_Descripcion']);
      $Acci_Nombre      = strtoupper($_POST['Acci_Nombre']);
      $Acci_Dni         = $_POST['Acci_Dni'];
      $Acci_Edad        = $_POST['Acci_Edad'];
      $Acci_Genero      = $_POST['Acci_Genero'];
      $acci_origen      = $_POST['acci_origen'];
      $Acci_Placa       = $_POST['Acci_Placa'];

      MModel($Modulo,'CRUD');
      $InstanciaAjax = new CRUD();
      $Respuesta     = $InstanciaAjax->CrearAccidentesNaturaleza($Accidentes_Id, $Acci_Tipo, $Acci_Descripcion, $Acci_Nombre, $Acci_Dni, $Acci_Edad, $Acci_Genero, $acci_origen, $Acci_Placa);
   break;

   case 'editar_accidentes_naturaleza':
      $Accidentes_Id          = $_POST['Accidentes_Id'];
      $Acci_Tipo              = $_POST['Acci_Tipo'];
      $Acci_Descripcion       = strtoupper($_POST['Acci_Descripcion']);
      $Acci_Nombre            = strtoupper($_POST['Acci_Nombre']);
      $Acci_Dni               = $_POST['Acci_Dni'];
      $Acci_Edad              = $_POST['Acci_Edad'];
      $Acci_Genero            = $_POST['Acci_Genero'];
      $acci_origen      = $_POST['acci_origen'];
      $Acci_Placa             = $_POST['Acci_Placa'];
      $OPE_AcciNaturalezaId   = $_POST['OPE_AcciNaturalezaId'];

      MModel($Modulo,'CRUD');
      $InstanciaAjax = new CRUD();
      $Respuesta     = $InstanciaAjax->editar_accidentes_naturaleza($Accidentes_Id, $Acci_Tipo, $Acci_Descripcion, $Acci_Nombre, $Acci_Dni, $Acci_Edad, $Acci_Genero, $acci_origen, $Acci_Placa, $OPE_AcciNaturalezaId);
   break;

   case 'CargaTablaReparacion':
      $Accidentes_Id = $_POST['Accidentes_Id'];

      MModel($Modulo,'CRUD');
      $InstanciaAjax= new CRUD();
      $Respuesta=$InstanciaAjax->CargaTablaReparacion($Accidentes_Id);
   break;

   case 'EliminarTablaReparacion':
      $OPE_AcciReparacionId = $_POST['OPE_AcciReparacionId'];
      $Accidentes_Id        = $_POST['Accidentes_Id'];

      MModel($Modulo,'CRUD');
      $InstanciaAjax = new CRUD();
      $Respuesta     = $InstanciaAjax->EliminarTablaReparacion($OPE_AcciReparacionId,$Accidentes_Id);
   break;

   case 'CrearAccidentesReparacion':
      $Accidentes_Id                = $_POST['Accidentes_Id'];
      $Acci_CodigoColor             = $_POST['Acci_CodigoColor'];
      $Acci_SeccionBus              = $_POST['Acci_SeccionBus'];
      $Acci_DescripcionReparacion   = strtoupper($_POST['Acci_DescripcionReparacion']);

      MModel($Modulo,'CRUD');
      $InstanciaAjax = new CRUD();
      $Respuesta     = $InstanciaAjax->CrearAccidentesReparacion($Accidentes_Id,$Acci_CodigoColor,$Acci_SeccionBus,$Acci_DescripcionReparacion);
   break;

   case 'CodigoQR':
      $Accidentes_Id = $_POST['Accidentes_Id'];
      $Acci_TipoAccidente = $_POST['Acci_TipoAccidente'];
      $Acci_TipoEvento = $_POST['Acci_TipoEvento'];
      $Acci_Bus = $_POST['Acci_Bus'];
      $Acci_NombreColaborador = $_POST['Acci_NombreColaborador'];
      $Acci_Lugar = $_POST['Acci_Lugar'];
      $Acci_Comisaria = $_POST['Acci_Comisaria'];
      $Acci_Hospital = $_POST['Acci_Hospital'];
      $Tipo = $_POST['Tipo'];
      
      MController($Modulo,'Logico');
      $InstanciaAjax = new Logico();
      $Respuesta = $InstanciaAjax->CodigoQR($Accidentes_Id,$Acci_TipoAccidente,$Acci_TipoEvento,$Acci_Bus,$Acci_NombreColaborador,$Acci_Lugar,$Acci_Comisaria,$Acci_Hospital,$Tipo);
   break;

   case 'BorrarAccidentes':
      $Accidentes_Id=$_POST['Accidentes_Id'];
         
      MModel($Modulo,'CRUD');
      $InstanciaAjax= new CRUD();
      $Respuesta=$InstanciaAjax->BorrarAccidentes($Accidentes_Id);
   break;

   case 'CerrarInformePreliminar':
      $Accidentes_Id=$_POST['Accidentes_Id'];
      
      MModel($Modulo,'CRUD');
      $InstanciaAjax= new CRUD();
      $Respuesta=$InstanciaAjax->CerrarInformePreliminar($Accidentes_Id);
   break;

   case 'SelectUsuario':
      $Usua_Perfil = $_POST['Usua_Perfil'];
      
      MController($Modulo,'Logico');
      $InstanciaAjax= new Logico();
      $Respuesta=$InstanciaAjax->SelectUsuario($Usua_Perfil);
   break;

   case 'SelectBus':
      MController($Modulo,'Logico');
      $InstanciaAjax= new Logico();
      $Respuesta=$InstanciaAjax->SelectBus();
   break;

   case 'SelectTipos':
      $TtablaAccidentes_Operacion= $_POST['TtablaAccidentes_Operacion'];
      $TtablaAccidentes_Tipo = $_POST['TtablaAccidentes_Tipo'];

      MController($Modulo,'Logico');
      $InstanciaAjax= new Logico();
      $Respuesta=$InstanciaAjax->SelectTipos($TtablaAccidentes_Operacion,$TtablaAccidentes_Tipo);
   break;

   case 'BuscarServicio':
      $Prog_Fecha= $_POST['Prog_Fecha'];
      $Prog_Tabla = $_POST['Prog_Tabla'];
      
      MController($Modulo,'Logico');
      $InstanciaAjax= new Logico();
      $Respuesta=$InstanciaAjax->BuscarServicio($Prog_Fecha,$Prog_Tabla);
   break;

   case 'SelectTablaAccidente':
      $Prog_Fecha= $_POST['Prog_Fecha'];   
      
      MController($Modulo,'Logico');
      $InstanciaAjax= new Logico();
      $Respuesta=$InstanciaAjax->SelectTablaAccidente($Prog_Fecha);
   break;

   case 'AbrirInformePreliminar':
      $Accidentes_Id=$_POST['Accidentes_Id'];

      MModel($Modulo,'CRUD');
      $InstanciaAjax= new CRUD();
      $Respuesta=$InstanciaAjax->AbrirInformePreliminar($Accidentes_Id);
   break;

   case 'CerrarInformePreliminar':
      $Accidentes_Id=$_POST['Accidentes_Id'];

      MModel($Modulo,'CRUD');
      $InstanciaAjax= new CRUD();
      $Respuesta=$InstanciaAjax->CerrarInformePreliminar($Accidentes_Id);
   break;

   case 'GrabarImagen':
      $Accidentes_Id    = $_POST['Accidentes_Id'];
      $Acci_TipoImagen  = $_POST['Acci_TipoImagen'];
      $Acci_Imagen = $_FILES['Acci_Imagen']['tmp_name'];

      if ($_FILES['Acci_Imagen']['error'] !== UPLOAD_ERR_OK) {
         $error = $_FILES['Acci_Imagen']['error'];
         switch ($error) {
             case UPLOAD_ERR_INI_SIZE:
                 $mensajeError = "El tamaño de la imagen excede la directiva upload_max_filesize en php.ini";
                 break;
             case UPLOAD_ERR_FORM_SIZE:
                 $mensajeError = "El tamaño de la imagen excede el límite especificado en el formulario";
                 break;
             case UPLOAD_ERR_PARTIAL:
                 $mensajeError = "La imagen solo se ha subido parcialmente";
                 break;
             case UPLOAD_ERR_NO_FILE:
                 $mensajeError = "No se ha seleccionado ninguna imagen para subir";
                 break;
             case UPLOAD_ERR_NO_TMP_DIR:
                 $mensajeError = "Falta el directorio temporal para subir la imagen";
                 break;
             case UPLOAD_ERR_CANT_WRITE:
                 $mensajeError = "No se puede escribir la imagen en el disco";
                 break;
             case UPLOAD_ERR_EXTENSION:
                 $mensajeError = "Una extensión de PHP detuvo la subida de la imagen";
                 break;
             default:
                 $mensajeError = "Error desconocido al subir la imagen";
                 break;
         }
         echo $mensajeError;
      }else{
         MController($Modulo,'Logico');
         $InstanciaAjax= new Logico();
         $Respuesta=$InstanciaAjax->GrabarImagen($Accidentes_Id,$Acci_TipoImagen,$Acci_Imagen);   
      }

   break;

   case 'EditarImagen':
      $Accidentes_Id = $_POST['Accidentes_Id'];
      $Acci_TipoImagen = $_POST['Acci_TipoImagen'];
      $Acci_Imagen = $_FILES['Acci_Imagen']['tmp_name'];
      if ($_FILES['Acci_Imagen']['error'] !== UPLOAD_ERR_OK) {
         $error = $_FILES['Acci_Imagen']['error'];
         switch ($error) {
             case UPLOAD_ERR_INI_SIZE:
                 $mensajeError = "El tamaño de la imagen excede la directiva upload_max_filesize en php.ini";
                 break;
             case UPLOAD_ERR_FORM_SIZE:
                 $mensajeError = "El tamaño de la imagen excede el límite especificado en el formulario";
                 break;
             case UPLOAD_ERR_PARTIAL:
                 $mensajeError = "La imagen solo se ha subido parcialmente";
                 break;
             case UPLOAD_ERR_NO_FILE:
                 $mensajeError = "No se ha seleccionado ninguna imagen para subir";
                 break;
             case UPLOAD_ERR_NO_TMP_DIR:
                 $mensajeError = "Falta el directorio temporal para subir la imagen";
                 break;
             case UPLOAD_ERR_CANT_WRITE:
                 $mensajeError = "No se puede escribir la imagen en el disco";
                 break;
             case UPLOAD_ERR_EXTENSION:
                 $mensajeError = "Una extensión de PHP detuvo la subida de la imagen";
                 break;
             default:
                 $mensajeError = "Error desconocido al subir la imagen";
                 break;
         }
         echo $mensajeError;
      }else{
         MController($Modulo,'Logico');
         $InstanciaAjax= new Logico();
         $Respuesta=$InstanciaAjax->EditarImagen($Accidentes_Id,$Acci_TipoImagen,$Acci_Imagen);            
      }
   break;

   case 'BuscarImagen':
      $Accidentes_Id = $_POST['Accidentes_Id'];
      $Acci_TipoImagen = $_POST['Acci_TipoImagen'];
         
      MModel($Modulo,'CRUD');
      $InstanciaAjax= new CRUD();
      $Respuesta=$InstanciaAjax->BuscarImagen($Accidentes_Id,$Acci_TipoImagen);
   break;

   case 'EstadoInformePreliminar':
      $Accidentes_Id=$_POST['Accidentes_Id'];

      MController($Modulo,'Logico');
      $InstanciaAjax= new Logico();
      $Respuesta=$InstanciaAjax->EstadoInformePreliminar($Accidentes_Id);
   break;

   case 'CargarNovedad':
      $Nove_ProgramacionId = $_POST['Nove_ProgramacionId'];
      $Novedad_Id = $_POST['Novedad_Id'];

      MController($Modulo,'Logico');
      $InstanciaAjax= new Logico();
      $Respuesta=$InstanciaAjax->CargarNovedad($Nove_ProgramacionId,$Novedad_Id);
   break;

   case 'CrearInformePreliminar':
      $Accidentes_Id                   = $_POST['Accidentes_Id'];
      $Acci_TipoAccidente              = $_POST['Acci_TipoAccidente'];
      $Acci_ClaseAccidente             = $_POST['Acci_ClaseAccidente'];
      $Acci_DanosMateriales            = $_POST['Acci_DanosMateriales'];
      $Acci_Lesiones                   = $_POST['Acci_Lesiones'];
      $Acci_Fatalidad                  = $_POST['Acci_Fatalidad'];
      $Acci_Otro                       = $_POST['Acci_Otro'];
      $Acci_OtroDescripcion            = $_POST['Acci_OtroDescripcion'];
      $Acci_TipoEvento                 = $_POST['Acci_TipoEvento'];
      $Acci_Fecha                      = $_POST['Acci_Fecha'];
      $Acci_Hora                       = $_POST['Acci_Hora'];
      $Acci_NombreColaborador          = $_POST['Acci_NombreColaborador'];
      $Acci_Tabla                      = $_POST['Acci_Tabla'];
      $Acci_Servicio                   = $_POST['Acci_Servicio'];
      $Acci_Lugar                      = $_POST['Acci_Lugar'];
      $Acci_Bus                        = $_POST['Acci_Bus'];
      $Acci_Sentido                    = $_POST['Acci_Sentido'];
      $Acci_km_perdidos                = $_POST['Acci_km_perdidos'];
      $Acci_Conciliacion               = $_POST['Acci_Conciliacion'];
      $Acci_MontoConciliado            = $_POST['Acci_MontoConciliado'];
      $Acci_NombreCGO                  = $_POST['Acci_NombreCGO'];
      $Acci_NombrePersonalApoyo        = $_POST['Acci_NombrePersonalApoyo'];
      $Acci_ReconoceResponsabilidad    = $_POST['Acci_ReconoceResponsabilidad'];
      $Acci_Hospital                   = $_POST['Acci_Hospital'];
      $Acci_Comisaria                  = $_POST['Acci_Comisaria'];
      $Acci_HoraFinAtencion            = $_POST['Acci_HoraFinAtencion'];
      $Acci_HorasTrabajadas            = $_POST['Acci_HorasTrabajadas'];
      $Acci_Objeto                     = $_POST['Acci_Objeto'];
      $Acci_HoraLlegadaProcurador      = $_POST['Acci_HoraLlegadaProcurador'];
      $Acci_NombreCGM                  = $_POST['Acci_NombreCGM'];
      $Acci_NombrePersonalApoyoManto   = $_POST['Acci_NombrePersonalApoyoManto'];
      $Acci_NumeroOT                   = $_POST['Acci_NumeroOT'];
      $Acci_DocReporte                 = $_POST['Acci_DocReporte'];
      $Acci_DocConciliacion            = $_POST['Acci_DocConciliacion'];
      $Acci_DocPartePolicial           = $_POST['Acci_DocPartePolicial'];
      $Acci_DocOficioPeritaje          = $_POST['Acci_DocOficioPeritaje'];
      $Acci_DocReporteAtencion         = $_POST['Acci_DocReporteAtencion'];
      $Acci_DocDenunciaPolicial        = $_POST['Acci_DocDenunciaPolicial'];
      $Acci_DocCitacionManifestacion   = $_POST['Acci_DocCitacionManifestacion'];
      $Acci_DocOtro                    = $_POST['Acci_DocOtro'];
      $Acci_DocOtroDescripcion         = $_POST['Acci_DocOtroDescripcion'];
      $Acci_Descripcion                = $_POST['Acci_Descripcion'];
      $Nove_ProgramacionId             = $_POST['Nove_ProgramacionId'];
      $Novedad_Id                      = $_POST['Novedad_Id'];
      $Acci_Operacion                  = $_POST['Acci_Operacion'];
      $acci_lugar_referencia           = strtoupper($_POST['acci_lugar_referencia']);

      MController($Modulo,'Logico');
      $InstanciaAjax = new Logico();
      $Respuesta     = $InstanciaAjax->CrearInformePreliminar($Accidentes_Id, $Acci_ClaseAccidente, $Acci_TipoAccidente, $Acci_DanosMateriales, $Acci_Lesiones, $Acci_Fatalidad,$Acci_Otro, $Acci_OtroDescripcion, $Acci_TipoEvento, $Acci_Fecha, $Acci_Hora, $Acci_NombreColaborador, $Acci_Tabla, $Acci_Servicio, $Acci_Lugar, $Acci_Bus, $Acci_Sentido,$Acci_km_perdidos, $Acci_Conciliacion, $Acci_MontoConciliado, $Acci_NombreCGO, $Acci_NombrePersonalApoyo, $Acci_ReconoceResponsabilidad, $Acci_Hospital, $Acci_Comisaria,$Acci_HoraFinAtencion, $Acci_HorasTrabajadas, $Acci_Objeto, $Acci_HoraLlegadaProcurador, $Acci_NombreCGM, $Acci_NombrePersonalApoyoManto, $Acci_NumeroOT, $Acci_DocReporte,$Acci_DocConciliacion, $Acci_DocPartePolicial, $Acci_DocOficioPeritaje, $Acci_DocReporteAtencion, $Acci_DocDenunciaPolicial, $Acci_DocCitacionManifestacion, $Acci_DocOtro,$Acci_DocOtroDescripcion, $Acci_Descripcion, $Nove_ProgramacionId, $Novedad_Id, $Acci_Operacion, $acci_lugar_referencia);
   break;

   case 'BuscarInformePreliminar':
      $Accidentes_Id = $_POST['Accidentes_Id'];

      MModel($Modulo, 'CRUD');
      $InstanciaAjax = new CRUD();
      $Respuesta     = $InstanciaAjax->BuscarInformePreliminar($Accidentes_Id);
   break;

   case 'EditarInformePreliminar':
      $Accidentes_Id                   = $_POST['Accidentes_Id'];
      $Acci_TipoAccidente              = $_POST['Acci_TipoAccidente'];
      $Acci_ClaseAccidente             = $_POST['Acci_ClaseAccidente'];
      $Acci_DanosMateriales            = $_POST['Acci_DanosMateriales'];
      $Acci_Lesiones                   = $_POST['Acci_Lesiones'];
      $Acci_Fatalidad                  = $_POST['Acci_Fatalidad'];
      $Acci_Otro                       = $_POST['Acci_Otro'];
      $Acci_OtroDescripcion            = $_POST['Acci_OtroDescripcion'];
      $Acci_TipoEvento                 = $_POST['Acci_TipoEvento'];
      $Acci_Fecha                      = $_POST['Acci_Fecha'];
      $Acci_Hora                       = $_POST['Acci_Hora'];
      $Acci_NombreColaborador          = $_POST['Acci_NombreColaborador'];
      $Acci_Tabla                      = $_POST['Acci_Tabla'];
      $Acci_Servicio                   = $_POST['Acci_Servicio'];
      $Acci_Lugar                      = $_POST['Acci_Lugar'];
      $Acci_Bus                        = $_POST['Acci_Bus'];
      $Acci_Sentido                    = $_POST['Acci_Sentido'];
      $Acci_km_perdidos                = $_POST['Acci_km_perdidos'];
      $Acci_Conciliacion               = $_POST['Acci_Conciliacion'];
      $Acci_MontoConciliado            = $_POST['Acci_MontoConciliado'];
      $Acci_NombreCGO                  = $_POST['Acci_NombreCGO'];
      $Acci_NombrePersonalApoyo        = $_POST['Acci_NombrePersonalApoyo'];
      $Acci_ReconoceResponsabilidad    = $_POST['Acci_ReconoceResponsabilidad'];
      $Acci_Hospital                   = $_POST['Acci_Hospital'];
      $Acci_Comisaria                  = $_POST['Acci_Comisaria'];
      $Acci_HoraFinAtencion            = $_POST['Acci_HoraFinAtencion'];
      $Acci_HorasTrabajadas            = $_POST['Acci_HorasTrabajadas'];
      $Acci_Objeto                     = $_POST['Acci_Objeto'];
      $Acci_HoraLlegadaProcurador      = $_POST['Acci_HoraLlegadaProcurador'];
      $Acci_NombreCGM                  = $_POST['Acci_NombreCGM'];
      $Acci_NombrePersonalApoyoManto   = $_POST['Acci_NombrePersonalApoyoManto'];
      $Acci_NumeroOT                   = $_POST['Acci_NumeroOT'];
      $Acci_DocReporte                 = $_POST['Acci_DocReporte'];
      $Acci_DocConciliacion            = $_POST['Acci_DocConciliacion'];
      $Acci_DocPartePolicial           = $_POST['Acci_DocPartePolicial'];
      $Acci_DocOficioPeritaje          = $_POST['Acci_DocOficioPeritaje'];
      $Acci_DocReporteAtencion         = $_POST['Acci_DocReporteAtencion'];
      $Acci_DocDenunciaPolicial        = $_POST['Acci_DocDenunciaPolicial'];
      $Acci_DocCitacionManifestacion   = $_POST['Acci_DocCitacionManifestacion'];
      $Acci_DocOtro                    = $_POST['Acci_DocOtro'];
      $Acci_DocOtroDescripcion         = $_POST['Acci_DocOtroDescripcion'];
      $Acci_Descripcion                = $_POST['Acci_Descripcion'];
      $acci_lugar_referencia           = strtoupper($_POST['acci_lugar_referencia']);

      MController($Modulo,'Logico');
      $InstanciaAjax= new Logico();
      $Respuesta=$InstanciaAjax->EditarInformePreliminar($Accidentes_Id, $Acci_ClaseAccidente, $Acci_TipoAccidente, $Acci_DanosMateriales, $Acci_Lesiones, $Acci_Fatalidad, $Acci_Otro, $Acci_OtroDescripcion, $Acci_TipoEvento, $Acci_Fecha, $Acci_Hora, $Acci_NombreColaborador, $Acci_Tabla, $Acci_Servicio, $Acci_Lugar, $Acci_Bus, $Acci_Sentido, $Acci_km_perdidos, $Acci_Conciliacion, $Acci_MontoConciliado, $Acci_NombreCGO, $Acci_NombrePersonalApoyo, $Acci_ReconoceResponsabilidad, $Acci_Hospital, $Acci_Comisaria, $Acci_HoraFinAtencion, $Acci_HorasTrabajadas, $Acci_Objeto, $Acci_HoraLlegadaProcurador, $Acci_NombreCGM, $Acci_NombrePersonalApoyoManto, $Acci_NumeroOT, $Acci_DocReporte, $Acci_DocConciliacion, $Acci_DocPartePolicial, $Acci_DocOficioPeritaje, $Acci_DocReporteAtencion, $Acci_DocDenunciaPolicial, $Acci_DocCitacionManifestacion, $Acci_DocOtro, $Acci_DocOtroDescripcion, $Acci_Descripcion, $acci_lugar_referencia);
   break;

   case 'BuscarInvestigacion':
      $fecha_inicio  = $_POST['fecha_inicio'];
      $fecha_termino = $_POST['fecha_termino'];

      MModel($Modulo,'CRUD');
      $InstanciaAjax = new CRUD();
      $Respuesta     = $InstanciaAjax->BuscarInvestigacion($fecha_inicio, $fecha_termino);
   break;

   case 'DatosCalculados':
      //Recepcion de Variables del JS
      $Accidentes_Id=$_POST['Accidentes_Id'];
      
      //Ejecuta Modelo
      MController($Modulo,'Logico');
      $InstanciaAjax= new Logico();
      $Respuesta=$InstanciaAjax->DatosCalculados($Accidentes_Id);
   break;

   case 'CargarInvestigacion':
      //Recepcion de Variables del JS
      $Accidentes_Id=$_POST['Accidentes_Id'];

      //Ejecuta Modelo
      MModel($Modulo, 'CRUD');
      $InstanciaAjax= new CRUD();
      $Respuesta=$InstanciaAjax->CargarInvestigacion($Accidentes_Id);
   break;

   case 'CrearInvestigacion':
      $Accidentes_Id                      = $_POST['Accidentes_Id'];
      $Acci_DatosRegistro                 = $_POST['Acci_DatosRegistro'];
      $Acci_Trafico                       = $_POST['Acci_Trafico'];
      $Acci_LugarReferencia               = $_POST['Acci_LugarReferencia'];
      $Acci_FactorDeterminante            = $_POST['Acci_FactorDeterminante'];
      $Acci_ResponsabilidadDeterminante   = $_POST['Acci_ResponsabilidadDeterminante'];
      $Acci_FactorContributivo            = $_POST['Acci_FactorContributivo'];
      $Acci_ResponsabilidadContributivo   = $_POST['Acci_ResponsabilidadContributivo'];
      $Acci_TipoExpediente                = $_POST['Acci_TipoExpediente'];
      $Acci_EventoReportado               = $_POST['Acci_EventoReportado'];
      $Acci_Frecuencia                    = $_POST['Acci_Frecuencia'];
      $Acci_Probabilidad                  = $_POST['Acci_Probabilidad'];
      $Acci_Severidad                     = $_POST['Acci_Severidad'];
      $Acci_GravedadEvento                = $_POST['Acci_GravedadEvento'];
      $Acci_ResponsabilidadAccidente      = $_POST['Acci_ResponsabilidadAccidente'];
      $Acci_GradoFalta                    = $_POST['Acci_GradoFalta'];
      $Acci_Reincidencia                  = $_POST['Acci_Reincidencia'];
      $Acci_CodigoRIT                     = $_POST['Acci_CodigoRIT'];
      $Acci_DescripcionRIT                = $_POST['Acci_DescripcionRIT'];
      $Acci_AccionDisciplinaria           = $_POST['Acci_AccionDisciplinaria'];
      $Acci_ReporteGDH                    = $_POST['Acci_ReporteGDH'];
      $Acci_FechaReporteGDH               = $_POST['Acci_FechaReporteGDH'];
      $Acci_Premio                        = $_POST['Acci_Premio'];
      $Acci_FechaCierreAccidente          = $_POST['Acci_FechaCierreAccidente'];
      $Acci_TiempoInvestigacion           = $_POST['Acci_TiempoInvestigacion'];
      $Acci_CumplimientoMeta              = $_POST['Acci_CumplimientoMeta'];
      $Acci_DelayRegistro                 = $_POST['Acci_DelayRegistro'];
      $Acci_CumplimientoRegistro          = $_POST['Acci_CumplimientoRegistro'];
      $Acci_FechaRegistro                 = $_POST['Acci_FechaRegistro'];
      $Acci_FechaCierreReporte            = $_POST['Acci_FechaCierreReporte'];
      $acci_nro_siniestro                 = $_POST['acci_nro_siniestro'];

      MModel($Modulo,'CRUD');
      $InstanciaAjax= new CRUD();
      $Respuesta=$InstanciaAjax->CrearInvestigacion($Accidentes_Id, $Acci_DatosRegistro, $Acci_Trafico, $Acci_LugarReferencia, $Acci_FactorDeterminante, $Acci_ResponsabilidadDeterminante, $Acci_FactorContributivo, $Acci_ResponsabilidadContributivo, $Acci_TipoExpediente, $Acci_EventoReportado, $Acci_Frecuencia, $Acci_Probabilidad,$Acci_Severidad, $Acci_GravedadEvento, $Acci_ResponsabilidadAccidente, $Acci_GradoFalta, $Acci_Reincidencia, $Acci_CodigoRIT, $Acci_DescripcionRIT, $Acci_AccionDisciplinaria,$Acci_ReporteGDH, $Acci_FechaReporteGDH, $Acci_Premio, $Acci_FechaCierreAccidente, $Acci_TiempoInvestigacion, $Acci_CumplimientoMeta, $Acci_DelayRegistro,$Acci_CumplimientoRegistro, $Acci_FechaRegistro, $Acci_FechaCierreReporte, $acci_nro_siniestro);
   break;

   case 'EditarInvestigacion':
      //Recepcion de Variables de JS
      $Accidentes_Id                      = $_POST['Accidentes_Id'];
      $Acci_DatosRegistro                 = $_POST['Acci_DatosRegistro'];
      $Acci_Trafico                       = $_POST['Acci_Trafico'];
      $Acci_LugarReferencia               = $_POST['Acci_LugarReferencia'];
      $Acci_FactorDeterminante            = $_POST['Acci_FactorDeterminante'];
      $Acci_ResponsabilidadDeterminante   = $_POST['Acci_ResponsabilidadDeterminante'];
      $Acci_FactorContributivo            = $_POST['Acci_FactorContributivo'];
      $Acci_ResponsabilidadContributivo   = $_POST['Acci_ResponsabilidadContributivo'];
      $Acci_TipoExpediente                = $_POST['Acci_TipoExpediente'];
      $Acci_EventoReportado               = $_POST['Acci_EventoReportado'];
      $Acci_Frecuencia                    = $_POST['Acci_Frecuencia'];
      $Acci_Probabilidad                  = $_POST['Acci_Probabilidad'];
      $Acci_Severidad                     = $_POST['Acci_Severidad'];
      $Acci_GravedadEvento                = $_POST['Acci_GravedadEvento'];
      $Acci_ResponsabilidadAccidente      = $_POST['Acci_ResponsabilidadAccidente'];
      $Acci_GradoFalta                    = $_POST['Acci_GradoFalta'];
      $Acci_Reincidencia                  = $_POST['Acci_Reincidencia'];
      $Acci_CodigoRIT                     = $_POST['Acci_CodigoRIT'];
      $Acci_DescripcionRIT                = $_POST['Acci_DescripcionRIT'];
      $Acci_AccionDisciplinaria           = $_POST['Acci_AccionDisciplinaria'];
      $Acci_ReporteGDH                    = $_POST['Acci_ReporteGDH'];
      $Acci_FechaReporteGDH               = $_POST['Acci_FechaReporteGDH'];
      $Acci_Premio                        = $_POST['Acci_Premio'];
      $Acci_FechaCierreAccidente          = $_POST['Acci_FechaCierreAccidente'];
      $Acci_TiempoInvestigacion           = $_POST['Acci_TiempoInvestigacion'];
      $Acci_CumplimientoMeta              = $_POST['Acci_CumplimientoMeta'];
      $Acci_DelayRegistro                 = $_POST['Acci_DelayRegistro'];
      $Acci_CumplimientoRegistro          = $_POST['Acci_CumplimientoRegistro'];
      $Acci_FechaRegistro                 = $_POST['Acci_FechaRegistro'];
      $Acci_FechaCierreReporte            = $_POST['Acci_FechaCierreReporte'];
      $acci_nro_siniestro                 = $_POST['acci_nro_siniestro'];
      
      //Ejecuta Modelo
      MModel($Modulo,'CRUD');
      $InstanciaAjax= new CRUD();
      $Respuesta=$InstanciaAjax->EditarInvestigacion($Accidentes_Id, $Acci_DatosRegistro, $Acci_Trafico, $Acci_LugarReferencia, $Acci_FactorDeterminante, $Acci_ResponsabilidadDeterminante, $Acci_FactorContributivo, $Acci_ResponsabilidadContributivo, $Acci_TipoExpediente, $Acci_EventoReportado, $Acci_Frecuencia, $Acci_Probabilidad,$Acci_Severidad, $Acci_GravedadEvento, $Acci_ResponsabilidadAccidente, $Acci_GradoFalta, $Acci_Reincidencia, $Acci_CodigoRIT, $Acci_DescripcionRIT, $Acci_AccionDisciplinaria,$Acci_ReporteGDH, $Acci_FechaReporteGDH, $Acci_Premio, $Acci_FechaCierreAccidente, $Acci_TiempoInvestigacion, $Acci_CumplimientoMeta, $Acci_DelayRegistro,$Acci_CumplimientoRegistro, $Acci_FechaRegistro, $Acci_FechaCierreReporte, $acci_nro_siniestro);
   break;

   case 'abrir_informe_final':
      $Accidentes_Id = $_POST['Accidentes_Id'];

      MModel($Modulo,'CRUD');
      $InstanciaAjax = new CRUD();
      $Respuesta     = $InstanciaAjax->abrir_informe_final($Accidentes_Id);
   break;

   case 'BuscarReportegdh':
      $fecha_inicio  = $_POST['fecha_inicio'];
      $fecha_termino = $_POST['fecha_termino'];
      
      MModel($Modulo,'CRUD');
      $InstanciaAjax = new CRUD();
      $Respuesta     = $InstanciaAjax->BuscarReportegdh($fecha_inicio, $fecha_termino);
   break;

   case 'GravedadEvento':
      //Recepcion de Variables del JS
      $Acci_Frecuencia = $_POST['Acci_Frecuencia'];
      $Acci_Probabilidad = $_POST['Acci_Probabilidad'];
      $Acci_Severidad = $_POST['Acci_Severidad'];

      //Ejecuta Modelo
      MController($Modulo,'Logico');
      $InstanciaAjax= new Logico();
      $Respuesta=$InstanciaAjax->GravedadEvento($Acci_Frecuencia,$Acci_Probabilidad,$Acci_Severidad);
   break;

   case 'ResponsabilidadAccidente':
      //Recepcion de Variables del JS
      $Acci_ResponsabilidadContributivo = $_POST['Acci_ResponsabilidadContributivo'];
      $Acci_ResponsabilidadDeterminante = $_POST['Acci_ResponsabilidadDeterminante'];

      //Ejecuta Modelo
      MController($Modulo,'Logico');
      $InstanciaAjax= new Logico();
      $Respuesta=$InstanciaAjax->ResponsabilidadAccidente($Acci_ResponsabilidadContributivo,$Acci_ResponsabilidadDeterminante);
   break;

   case 'CumplimientoMeta':
      //Recepcion de Variables del JS
      $Acci_TipoExpediente = $_POST['Acci_TipoExpediente'];
      $Acci_TiempoInvestigacion = $_POST['Acci_TiempoInvestigacion'];

      //Ejecuta Modelo
      MController($Modulo,'Logico');
      $InstanciaAjax= new Logico();
      $Respuesta=$InstanciaAjax->CumplimientoMeta($Acci_TipoExpediente,$Acci_TiempoInvestigacion);
   break;

   case 'CodigoRIT':
      //Recepcion de Variables del JS
      $Acci_GradoFalta = $_POST['Acci_GradoFalta'];

      //Ejecuta Modelo
      MController($Modulo,'Logico');
      $InstanciaAjax= new Logico();
      $Respuesta=$InstanciaAjax->CodigoRIT($Acci_GradoFalta);
   break;

   case 'DescripcionRIT':
      //Recepcion de Variables del JS
      $Acci_CodigoRIT = $_POST['Acci_CodigoRIT'];
      $Acci_GradoFalta = $_POST['Acci_GradoFalta'];

      //Ejecuta Modelo
      MController($Modulo,'Logico');
      $InstanciaAjax= new Logico();
      $Respuesta=$InstanciaAjax->DescripcionRIT($Acci_CodigoRIT,$Acci_GradoFalta);
   break;

   case 'AccionDisciplinaria':
      //Recepcion de Variables del JS
      $Acci_CodigoRIT = $_POST['Acci_CodigoRIT'];
      $Acci_Reincidencia = $_POST['Acci_Reincidencia'];

      //Ejecuta Modelo
      MController($Modulo,'Logico');
      $InstanciaAjax= new Logico();
      $Respuesta=$InstanciaAjax->AccionDisciplinaria($Acci_CodigoRIT,$Acci_Reincidencia);
   break;

   case 'PDFInformePreliminar':
      //Recepcion de Variables del JS
      $Accidentes_Id=$_POST['Accidentes_Id'];

      //Ejecuta Modelo
      MController($Modulo, 'Logico');
      $InstanciaAjax= new Logico();
      $Respuesta=$InstanciaAjax->PDFInformePreliminar($Accidentes_Id);
   break;

   case 'DocumentRoot':
      MController($Modulo,'Logico');
      $InstanciaAjax= new Logico();
      $Respuesta=$InstanciaAjax->DocumentRoot();
   break;

   case 'horas_trabajadas':
      $operacion  = $_POST['operacion'];
      $fecha      = $_POST['fecha'];
      $dni        = $_POST['dni'];
      $hora       = $_POST['hora'];
      
      MController($Modulo,'Logico');
      $InstanciaAjax = new Logico();
      $Respuesta     = $InstanciaAjax->horas_trabajadas($operacion, $fecha, $dni, $hora);      
   break;

   case 'km_perdidos':
      $Accidentes_Id = $_POST['Accidentes_Id'];
      $operacion     = $_POST['operacion'];
      $bus           = $_POST['bus'];
      $fecha_operacion = $POST['fecha_operacion'];
      
      MController($Modulo,'Logico');
      $InstanciaAjax = new Logico();
      $Respuesta     = $InstanciaAjax->km_perdidos($Accidentes_Id, $operacion, $bus, $fecha_operacion);      
   break;

   case 'guardar_pdf_informe_preliminar':
      $Accidentes_Id = $_POST['Accidentes_Id'];

      MController($Modulo, 'Logico');
      $InstanciaAjax= new Logico();
      $Respuesta=$InstanciaAjax->guardar_pdf_informe_preliminar($Accidentes_Id);
   break;

   case 'permisos':
      $nombre_modulo = $_POST['nombre_modulo'];
      $nombre_objeto = $_POST['nombre_objeto'];

      MController($Modulo, 'Logico');
      $InstanciaAjax = new Logico();
      $Respuesta     = $InstanciaAjax->Permisos($nombre_modulo, $nombre_objeto);
   break;

   case 'BuscarDataBD':
      $TablaBD    = $_POST['TablaBD'];
      $CampoBD    = $_POST['CampoBD'];
      $DataBuscar = $_POST['DataBuscar'];

      MController($Modulo,'Logico');
      $InstanciaAjax = new Logico();
      $Respuesta     = $InstanciaAjax->BuscarDataBD($TablaBD,$CampoBD,$DataBuscar);
   break;

   case 'buscar_pdf':
      $tabla               = $_POST['tabla'];
      $campo_archivo       = $_POST['campo_archivo'];
      $campo_buscar        = $_POST['campo_buscar'];
      $dato_buscar         = $_POST['dato_buscar'];
      $campo_tipo_archivo  = $_POST['campo_tipo_archivo'];
      $dato_tipo_archivo   = $_POST['dato_tipo_archivo'];
      $nombre_archivo      = $_POST['nombre_archivo'];

      //Ejecuta Modelo
      MController($Modulo,'Logico');
      $InstanciaAjax = new Logico();
      $Respuesta     = $InstanciaAjax->buscar_pdf($tabla, $campo_archivo, $campo_buscar, $dato_buscar, $campo_tipo_archivo, $dato_tipo_archivo, $nombre_archivo);
   break;

   case 'unlink_pdf':
      $archivo = $_POST['archivo'];

      MController($Modulo,'Logico');
      $InstanciaAjax = new Logico();
      $Respuesta     = $InstanciaAjax->unlink_pdf($archivo);
   break;

   case 'grabar_pdf':
      $Accidentes_Id    = $_POST['Accidentes_Id'];
      $Acci_TipoImagen  = $_POST['Acci_TipoImagen'];
      $Acci_Imagen      = addslashes(file_get_contents($_FILES['Acci_Imagen']['tmp_name']));
         
      MModel($Modulo,'CRUD');
      $InstanciaAjax = new CRUD();
      $Respuesta     = $InstanciaAjax->GrabarImagen($Accidentes_Id, $Acci_TipoImagen, $Acci_Imagen);
   break;

   case 'editar_pdf':
      $Accidentes_Id    = $_POST['Accidentes_Id'];
      $Acci_TipoImagen  = $_POST['Acci_TipoImagen'];
      $Acci_Imagen      = addslashes(file_get_contents($_FILES['Acci_Imagen']['tmp_name']));
         
      MModel($Modulo,'CRUD');
      $InstanciaAjax = new CRUD();
      $Respuesta     = $InstanciaAjax->EditarImagen($Accidentes_Id, $Acci_TipoImagen, $Acci_Imagen);
   break;

   case 'LeerTipoTablaAccidentes':
      MModel($Modulo,'CRUD');
      $InstanciaAjax= new CRUD();
      $Respuesta=$InstanciaAjax->LeerTipoTablaAccidentes();
   break;

   case 'CrearTipoTablaAccidentes':
      $TtablaAccidentes_Id=$_POST['TtablaAccidentes_Id'];
      $TtablaAccidentes_Tipo=strtoupper($_POST['TtablaAccidentes_Tipo']);
      $TtablaAccidentes_Operacion=strtoupper($_POST['TtablaAccidentes_Operacion']);
      $TtablaAccidentes_Detalle=strtoupper($_POST['TtablaAccidentes_Detalle']);
      
      MModel($Modulo,'CRUD');
      $InstanciaAjax= new CRUD();
      $Respuesta=$InstanciaAjax->CrearTipoTablaAccidentes($TtablaAccidentes_Id,$TtablaAccidentes_Tipo,$TtablaAccidentes_Operacion,$TtablaAccidentes_Detalle);
   break;

   case 'EditarTipoTablaAccidentes':
      $TtablaAccidentes_Id=$_POST['TtablaAccidentes_Id'];
      $TtablaAccidentes_Tipo=strtoupper($_POST['TtablaAccidentes_Tipo']);
      $TtablaAccidentes_Operacion=strtoupper($_POST['TtablaAccidentes_Operacion']);
      $TtablaAccidentes_Detalle=strtoupper($_POST['TtablaAccidentes_Detalle']);
      
      MModel($Modulo,'CRUD');
      $InstanciaAjax= new CRUD();
      $Respuesta=$InstanciaAjax->EditarTipoTablaAccidentes($TtablaAccidentes_Id,$TtablaAccidentes_Tipo,$TtablaAccidentes_Operacion,$TtablaAccidentes_Detalle);
   break;

   case 'BorrarTipoTablaAccidentes':
      $TtablaAccidentes_Id=$_POST['TtablaAccidentes_Id'];
      
      MModel($Modulo,'CRUD');
      $InstanciaAjax= new CRUD();
      $Respuesta=$InstanciaAjax->BorrarTipoTablaAccidentes($TtablaAccidentes_Id);
   break;

   case 'carga_tabla_ver_lesionados':
      $Accidentes_Id = $_POST['Accidentes_Id'];
      $Acci_Tipo = $_POST['Acci_Tipo'];

      MModel($Modulo,'CRUD');
      $InstanciaAjax= new CRUD();
      $Respuesta=$InstanciaAjax->carga_tabla_ver_lesionados($Accidentes_Id,$Acci_Tipo);
   break;

   default: header('Location: /inicio');

}