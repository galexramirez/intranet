<?php
session_start();
class Logico
{
    var $Modulo="ControlFacilitador";
    // 1.0 CARGA PANTALLA PRINCIPAL DEL MODULO
    public function Contenido($NombreDeModuloVista)
    {
        MView($this->Modulo, 'LocalView', compact('NombreDeModuloVista'));
    }
    
    //::::::::::::::::::::::::::::::::::::::::: FACILITADOR CARGA ::::::::::::::::::::::::::::::::::::::::::::::::::::://

    public function CrearFacilitadorCarga($CFaRg_FechaCargada, $CFaRg_TipoOperacionCargada, $Semana)
    {
        // COMPARAR QUE LA FECHA A REGISTRAR COINCIDA CON LA SEMANA SELECCIONADA
        MModel($this->Modulo, 'CRUD');
        $InstanciaAjax= new CRUD();
        $Respuesta1=$InstanciaAjax->BuscarSemanaFacilitadorCarga($CFaRg_FechaCargada, $Semana);

        if ($Respuesta1==false) {
            echo "El registro no corresponde a la semana seleccionada ...!!!";
        } else {
            // BUSQUEDA Y CONDICION DE FECHA DE PROGRAMACION EN TABLA ControlFaciliotadorRegistroCarga
            MModel($this->Modulo, 'CRUD');
            $InstanciaAjax= new CRUD();
            $Respuesta2=$InstanciaAjax->BuscarFacilitadorCarga($CFaRg_FechaCargada, $CFaRg_TipoOperacionCargada);

            if ($Respuesta2==false) {
                echo "El registro ya existe ...!!!";
            } else {
                $Opcion = 0; // Retorna la cantidad de registros de la programacion
                MModel($this->Modulo, 'CRUD');
                $InstanciaAjax= new CRUD();
                $Respuesta3=$InstanciaAjax->DetalleFacilitador($CFaRg_FechaCargada, $CFaRg_TipoOperacionCargada, $Opcion);
                if ($Respuesta3==0) {
                    echo "No se encuentra cargada la programación ...!!!";
                } else {
                    // Se graba registro en tabla ControlFacilitadorRegistroCarga
                    MModel($this->Modulo, 'CRUD');
                    $InstanciaAjax= new CRUD();
                    $CFaRg_Id=$InstanciaAjax->CrearFacilitadorCarga($CFaRg_FechaCargada, $CFaRg_TipoOperacionCargada);
                    $CFaci_Estado = "ACTIVO";

                    // Retorna los registros de programacion a grabar en el control facilitador
                    $Opcion = 1;
                    MModel($this->Modulo, 'CRUD');
                    $InstanciaAjax= new CRUD();
                    $Respuesta4=$InstanciaAjax->DetalleFacilitador($CFaRg_FechaCargada, $CFaRg_TipoOperacionCargada, $Opcion);

                    // Se graban los registros de programacion en la tabla ControlFacilitador
                    $CantErrores=0;
                    foreach ($Respuesta4 as $row) {
                        $Programacion_Id=$row['Programacion_Id'];
                        $Prog_Codigo=$row['Prog_Codigo'];
                        $Prog_Operacion=$row['Prog_Operacion'];
                        $Prog_Fecha=$row['Prog_Fecha'];
                        $Prog_Dni=$row['Prog_Dni'];
                        $Prog_CodigoColaborador=$row['Prog_CodigoColaborador'];
                        $Prog_NombreColaborador=$row['Prog_NombreColaborador'];
                        $Prog_Tabla=$row['Prog_Tabla'];
                        $Prog_HoraOrigen=$row['Prog_HoraOrigen'];
                        $Prog_HoraDestino=$row['Prog_HoraDestino'];
                        $Prog_Servicio=$row['Prog_Servicio'];
                        $Prog_ServBus=$row['Prog_ServBus'];
                        $Prog_Bus=$row['Prog_Bus'];
                        $Prog_LugarOrigen=$row['Prog_LugarOrigen'];
                        $Prog_LugarDestino=$row['Prog_LugarDestino'];
                        $Prog_TipoEvento=$row['Prog_TipoEvento'];
                        $Prog_Observaciones=$row['Prog_Observaciones'];
                        $Prog_KmXPuntos=$row['Prog_KmXPuntos'];
                        $Prog_TipoTabla=$row['Prog_TipoTabla'];
                        $Prog_NPlaca=$row['Prog_NPlaca'];
                        $Prog_NVid=$row['Prog_NVid'];
                        $Prog_IdManto=$row['Prog_IdManto'];
                        $Prog_Sentido=$row['Prog_Sentido'];
                        $Prog_BusManto=$row['Prog_BusManto'];
                        $Prog_Viajes=$row['Prog_Viajes'];
                        $CFaci_Campo1=$row['Prog_Campo1']; // Campos libres
                        $CFaci_Campo2=$row['Prog_Campo2']; // Campos libres
                        $CFaci_Campo3=$row['Prog_Campo3']; // Campos libres

                        if ($Prog_KmXPuntos=="") {
                            $Prog_KmXPuntos=0;
                        }
                        
                        MModel($this->Modulo, 'CRUD');
                        $InstanciaAjax= new CRUD();
                        $Respuesta5=$InstanciaAjax->CrearDetalleFacilitador($Programacion_Id, $Prog_Codigo, $Prog_Operacion, $Prog_Fecha, $Prog_Dni, $Prog_CodigoColaborador, $Prog_NombreColaborador, $Prog_Tabla, $Prog_HoraOrigen, $Prog_HoraDestino, $Prog_Servicio, $Prog_ServBus, $Prog_Bus, $Prog_LugarOrigen, $Prog_LugarDestino, $Prog_TipoEvento, $Prog_Observaciones, $Prog_KmXPuntos, $Prog_TipoTabla, $Prog_NPlaca, $Prog_NVid, $CFaRg_Id, $CFaci_Estado,$Prog_IdManto, $Prog_Sentido, $Prog_BusManto, $Prog_Viajes, $CFaci_Campo1, $CFaci_Campo2, $CFaci_Campo3);
                        
                        if ($Respuesta5==false) {
                            $CantErrores=$CantErrores+1;
                            echo "No grabo linea ".$row." -> Fecha: ".$Prog_Fecha." - Tabla : ".$Prog_Tabla." - Hora Origen : ".$Prog_HoraOrigen."<hr>"  ;
                        }
                    }

                    echo "Se cargaron ".($Respuesta3-$CantErrores)." de ".($Respuesta3);
                }
            }
        }
    }

    public function AniosFacilitadorCarga()
    {
        //Ejecuta Modelo
        MModel($this->Modulo, 'CRUD');
        $InstanciaAjax= new CRUD();
        $Respuesta=$InstanciaAjax->AniosFacilitadorCarga();

        $html = '<option value="">Año</option>';
        foreach ($Respuesta as $row) {
            $html .= '<option value="'.$row['Anio'].'">'.$row['Anio'].'</option>';
        }
        echo $html;
    }

    public function SemanasFacilitadorCarga($Calendario_Anio)
    {
        //Ejecuta Modelo
        MModel($this->Modulo, 'CRUD');
        $InstanciaAjax= new CRUD();
        $Respuesta=$InstanciaAjax->SemanasFacilitadorCarga($Calendario_Anio);

        $html = '<option value="">Semana</option>';
        foreach ($Respuesta as $row) {
            $html .= '<option value="'.$row['Semana'].'">'.$row['Semana'].'</option>';
        }
        echo $html;
    }

    public function CerrarFacilitadorCarga($CFaRg_Id, $CFaRg_FechaCargada, $CFaRg_TipoOperacionCargada)
    {
        MModel($this->Modulo,'CRUD');
        $InstanciaAjax  = new CRUD();
        $Respuesta      = $InstanciaAjax->crear_control_facilitador_historico($CFaRg_Id);

        MModel($this->Modulo,'CRUD');
        $InstanciaAjax  = new CRUD();
        $Respuesta      = $InstanciaAjax->borrar_control_facilitador($CFaRg_FechaCargada, $CFaRg_TipoOperacionCargada);

        MModel($this->Modulo,'CRUD');
        $InstanciaAjax  = new CRUD();
        $Respuesta      = $InstanciaAjax->CerrarFacilitadorCarga($CFaRg_Id);
  
    }

    //::::::::::::::::::::::::::::::::::::::::::::::: DETALLE DEL CONTROL FACILITADOR :::::::::::::::::::::::::::::::::::::::::://
    
    public function CrearControlFacilitador($Prog_Operacion, $Prog_Fecha, $Prog_NombreColaborador, $Prog_Tabla, $Prog_HoraOrigen, $Prog_HoraDestino, $Prog_Servicio,$Prog_ServBus, $Prog_Bus, $Prog_LugarOrigen, $Prog_LugarDestino, $Prog_TipoEvento, $Prog_KmXPuntos, $Prog_Sentido, $Prog_BusManto, $Prog_IdManto, $Prog_Observaciones, $OPE_NovedadId, $btnOpcionNovedad, $Nove_Novedad,$Nove_TipoNovedad, $Nove_DetalleNovedad, $Nove_Descripcion, $Nove_LugarExacto, $Nove_HoraInicio, $Nove_HoraFin, $Nove_TipoOrigen, $arrData)
    {
        $MaxId              = 0;
        $Programacion_Id    = 0;
        $Prog_Codigo        = substr($Prog_Fecha, 0, 4).substr($Prog_Fecha, 5, 2).substr($Prog_Fecha, 8, 2).$Prog_Operacion;
        $Prog_Dni           = "";
        //$Prog_IdManto = 0;
        $CFaRg_Id           = 0;
        $CFaci_Estado       = "ACTIVO"; // Registro habilitado
        $CFaci_UsuarioId    = $_SESSION['USUARIO_ID'];
        $CFaci_Novedad      = "SI";
        $CFaci_ProcesoOrigen= "OPERACION";
        $CFaci_Version      = 1;
        //$Prog_Observaciones = "";
        $Prog_TipoTabla     = "";
        $Prog_Viajes        = "";
        $CFaci_Campo1       = "";
        $CFaci_Campo2       = "";
        $CFaci_Campo3       = "";
                
        //Ejecuta Modelo
        MModel($this->Modulo, 'CRUD');
        $InstanciaAjax= new CRUD();
        $Respuesta=$InstanciaAjax->BusNroVid($Prog_Bus);
        foreach ($Respuesta as $row) {
            $Prog_NVid = $row['NroVID'];
        }

        MModel($this->Modulo, 'CRUD');
        $InstanciaAjax= new CRUD();
        $Respuesta=$InstanciaAjax->BusNroPlaca($Prog_Bus);
        foreach ($Respuesta as $row) {
            $Prog_NPlaca = $row['NroPlaca'];
        }

        MModel($this->Modulo, 'CRUD');
        $InstanciaAjax= new CRUD();
        $Respuesta=$InstanciaAjax->CodigoColaborador($Prog_NombreColaborador);
        foreach ($Respuesta as $row) {
            $Prog_Dni = $row['Colaborador_id'];
            $Prog_CodigoColaborador = $row['Colab_CodigoCortoPT'];
        }

        MModel($this->Modulo, 'CRUD');
        $InstanciaAjax  = new CRUD();
        $Respuesta      = $InstanciaAjax->ValidarControlFacilitador($Prog_Fecha, $Prog_Operacion);
        foreach ($Respuesta as $row) {
            $CFaRg_Id = $row['CFaRg_Id'];
        }

        // Se asigna el siguiente Id de ControlFacilitador a Programacion_Id
        $TablaBD="OPE_ControlFacilitador";
        $CampoId="ControlFacilitador_Id";
        MModel($this->Modulo, 'CRUD');
        $InstanciaAjax  = new CRUD();
        $MaxId          = $InstanciaAjax->MaxId($TablaBD,$CampoId);
        foreach ($MaxId as $row) {
            $Programacion_Id = $row['MaxId']+1;  // Este campo sera tambien igual al ControlFacilitador_Id
        }

        // Se si selecciono una linea del control facilitador buscamos su campo Nro de Viajes
        foreach ($arrData as $row){
            $ControlFacilitador_Id = $row;
            // Se busca los datos en tabla Control Facilitador por el campo ControlFacilitador_Id
            $TablaBD = 'OPE_ControlFacilitador';
            $CampoBD = 'ControlFacilitador_Id';
            MModel($this->Modulo, 'CRUD');
            $InstanciaAjax  = new CRUD();
            $data           = $InstanciaAjax->BuscarDataBD($TablaBD,$CampoBD,$ControlFacilitador_Id);
            foreach ($data as $row1){
                $Prog_Viajes = $row1['Prog_Viajes'];
            }
        }

        // Se graba el nuevo registro en la tabla ControlFacilitador
        MModel($this->Modulo, 'CRUD');
        $InstanciaAjax  = new CRUD();
        $Respuesta      = $InstanciaAjax->CrearControlFacilitador($Programacion_Id, $Prog_Codigo, $Prog_Operacion, $Prog_Fecha, $Prog_Dni, $Prog_CodigoColaborador, $Prog_NombreColaborador, $Prog_Tabla, $Prog_HoraOrigen, $Prog_HoraDestino, $Prog_Servicio, $Prog_ServBus, $Prog_Bus, $Prog_LugarOrigen, $Prog_LugarDestino, $Prog_TipoEvento, $Prog_Observaciones, $Prog_KmXPuntos, $Prog_TipoTabla, $Prog_NPlaca, $Prog_NVid, $Prog_Sentido, $Prog_BusManto, $Prog_IdManto, $CFaRg_Id, $CFaci_Estado, $CFaci_UsuarioId, $CFaci_Novedad, $CFaci_ProcesoOrigen, $CFaci_Version, $Prog_Viajes, $CFaci_Campo1, $CFaci_Campo2, $CFaci_Campo3);

        // Se graban las novedades en la tabla Novedad originadas por el nuevo registro del Control Facilitador
        if ($btnOpcionNovedad=='NuevaNovedad') {
            $Nove_Fecha     = date("Y-m-d H:i:s");
            $Novedad_Id     = date("Ymd-His");
            $Nove_Estado    = "PENDIENTE";
            $Nove_Version   = 1;
            
            MModel($this->Modulo, 'CRUD');
            $InstanciaAjax  = new CRUD();
            $Respuesta      = $InstanciaAjax->CrearNovedad($Novedad_Id,$Programacion_Id, $Nove_Novedad, $Nove_TipoNovedad, $Nove_DetalleNovedad, $Nove_Descripcion, $Prog_Operacion, $Prog_Fecha, $Prog_Dni, $Prog_CodigoColaborador, $Prog_NombreColaborador, $Prog_Tabla, $Prog_HoraOrigen, $Prog_HoraDestino, $Prog_Servicio, $Prog_Bus, $Prog_LugarOrigen, $Prog_LugarDestino, $Nove_Estado, $CFaci_ProcesoOrigen, $Nove_Fecha, $CFaRg_Id, $Nove_LugarExacto, $Nove_HoraInicio, $Nove_HoraFin, $Nove_Version, $Nove_TipoOrigen);

            // Se graban las filas editadas y la novedad seleccionada en la tabla ControlCambiosNovedad
            $CNove_TipoOrigen   = "CREACION";
            $CNove_Fecha        = $Nove_Fecha;
		    
            MModel($this->Modulo, 'CRUD');
            $InstanciaAjax  = new CRUD();
            $TablaBD        = 'OPE_Novedad';
            $CampoBD        = 'Novedad_Id';
            $RespuestaBN    = $InstanciaAjax->BuscarDataBD($TablaBD,$CampoBD,$Novedad_Id);

            foreach ($RespuestaBN as $rowBN) {
                $CNove_ProcesoOrigen    = $rowBN['Nove_ProcesoOrigen'];
                $CNove_ProgramacionId   = $rowBN['Nove_ProgramacionId'];
                $CNove_NovedadId        = $rowBN['Novedad_Id'];
                $CNove_OPENovedadId     = $rowBN['OPE_NovedadId'];
                $CNove_FechaOperacion   = $rowBN['Nove_FechaOperacion'];

                MModel($this->Modulo, 'CRUD');
                $InstanciaAjax  = new CRUD();
                $RespuestaCN    = $InstanciaAjax->CrearControlCambiosNovedad($CNove_ProcesoOrigen, $CNove_ProgramacionId, $CNove_NovedadId, $CNove_Fecha, $Programacion_Id, $CNove_TipoOrigen, $CFaRg_Id, $CNove_OPENovedadId, $CNove_FechaOperacion, $CFaci_Version, $Nove_Version);
            }
        }else{
            // Se graban las filas editadas y la novedad seleccionada en la tabla ControlCambiosNovedad
            $CNove_TipoOrigen = "ASOCIACION";
			$CNove_Fecha = date("Y-m-d H:i:s");

            $TablaBD = 'OPE_Novedad';
            $CampoBD = 'OPE_NovedadId';
            MModel($this->Modulo, 'CRUD');
            $InstanciaAjax= new CRUD();
            $RespuestaBN=$InstanciaAjax->BuscarDataBD($TablaBD,$CampoBD,$OPE_NovedadId);

            foreach ($RespuestaBN as $rowBN) {
                $CNove_ProcesoOrigen = $rowBN['Nove_ProcesoOrigen'];
                $CNove_ProgramacionId = $rowBN['Nove_ProgramacionId'];
                $CNove_NovedadId = $rowBN['Novedad_Id'];
                $CNove_OPENovedadId = $rowBN['OPE_NovedadId'];
                $CNove_FechaOperacion = $rowBN['Nove_FechaOperacion'];
                $CNove_NoveVersion = $rowBN['Nove_Version'];
            }
			MModel($this->Modulo, 'CRUD');
            $InstanciaAjax= new CRUD();
            $RespuestaCN=$InstanciaAjax->CrearControlCambiosNovedad($CNove_ProcesoOrigen, $CNove_ProgramacionId, $CNove_NovedadId, $CNove_Fecha, $Programacion_Id,$CNove_TipoOrigen,$CFaRg_Id,$CNove_OPENovedadId,$CNove_FechaOperacion,$CFaci_Version,$CNove_NoveVersion);

        }
    }

    public function EditarControlFacilitador($Prog_Fecha, $Prog_Operacion, $Prog_NombreColaborador, $Prog_Tabla, $Prog_HoraOrigen, $Prog_HoraDestino, $Prog_Servicio,$Prog_ServBus, $Prog_Bus, $Prog_LugarOrigen, $Prog_LugarDestino, $Prog_TipoEvento, $Prog_KmXPuntos, $Prog_Sentido, $Prog_BusManto, $Prog_IdManto, $Prog_Observaciones, $arrData, $OPE_NovedadId, $btnOpcionNovedad,$Nove_Novedad, $Nove_TipoNovedad, $Nove_DetalleNovedad, $Nove_Descripcion, $Nove_LugarExacto, $Nove_HoraInicio, $Nove_HoraFin, $Nove_TipoOrigen)
    {
        $Prog_Viajes    = "";
        $CFaci_Campo1   = "";
        $CFaci_Campo2   = "";
        $CFaci_Campo3   = "";
        $Prog_Dni       = "";
        //$Prog_Observaciones = "";
        $Prog_TipoTabla = "";
        $aProgramacionId = array();

        MModel($this->Modulo, 'CRUD');
        $InstanciaAjax  = new CRUD();
        $Respuesta      = $InstanciaAjax->BusNroVid($Prog_Bus);
        foreach ($Respuesta as $row) {
            $Prog_NVid = $row['NroVID'];
        }

        MModel($this->Modulo, 'CRUD');
        $InstanciaAjax  = new CRUD();
        $Respuesta      = $InstanciaAjax->BusNroPlaca($Prog_Bus);
        foreach ($Respuesta as $row) {
            $Prog_NPlaca = $row['NroPlaca'];
        }

        //Ejecuta Modelo
        MModel($this->Modulo, 'CRUD');
        $InstanciaAjax  = new CRUD();
        $Respuesta      = $InstanciaAjax->CodigoColaborador($Prog_NombreColaborador);

        foreach ($Respuesta as $row) {
            $Prog_Dni               = $row['Colaborador_id'];
            $Prog_CodigoColaborador = $row['Colab_CodigoCortoPT'];
        }

        // Se recorren todos los ID a modificar
        foreach ($arrData as $row) {
            $CFaci_EstadoACT            = "EDITADO"; // Registro habilitado
            $CFaci_NovedadACT           = "SI"; // [NO] TIENE NOVEDAD, [SI] TIENE NOVEDAD
            $ControlFacilitador_IdACT   = $row;

            // Se busca los datos en tabla Control Facilitador por el campo ControlFacilitador_Id
            $TablaBD = 'OPE_ControlFacilitador';
            $CampoBD = 'ControlFacilitador_Id';
            MModel($this->Modulo, 'CRUD');
            $InstanciaAjax= new CRUD();
            $data1=$InstanciaAjax->BuscarDataBD($TablaBD,$CampoBD,$ControlFacilitador_IdACT);
    
            // Se cargan los datos desde la tabla OPE_ControlFacilitador para modificar
            foreach ($data1 as $row1) {
                // Se cargan las variables $...EDT para crear una copia en la tabla OPE_ControlFacilitadorEDT
                $ControlFacilitador_IdEDT   = $row1['ControlFacilitador_Id'];
                $Programacion_IdEDT         = $row1['Programacion_Id'];
                $Prog_CodigoEDT             = $row1['Prog_Codigo'];
                $Prog_OperacionEDT          = $row1['Prog_Operacion'];
                $Prog_FechaEDT              = $row1['Prog_Fecha'];
                $Prog_DniEDT                = $row1['Prog_Dni'];
                $Prog_CodigoColaboradorEDT  = $row1['Prog_CodigoColaborador'];
                $Prog_NombreColaboradorEDT  = $row1['Prog_NombreColaborador'];
                $Prog_TablaEDT              = $row1['Prog_Tabla'];
                $Prog_HoraOrigenEDT         = $row1['Prog_HoraOrigen'];
                $Prog_HoraDestinoEDT        = $row1['Prog_HoraDestino'];
                $Prog_ServicioEDT           = $row1['Prog_Servicio'];
                $Prog_ServBusEDT            = $row1['Prog_ServBus'];
                $Prog_BusEDT                = $row1['Prog_Bus'];
                $Prog_LugarOrigenEDT        = $row1['Prog_LugarOrigen'];
                $Prog_LugarDestinoEDT       = $row1['Prog_LugarDestino'];
                $Prog_TipoEventoEDT         = $row1['Prog_TipoEvento'];
                $Prog_ObservacionesEDT      = $row1['Prog_Observaciones'];
                $Prog_KmXPuntosEDT          = $row1['Prog_KmXPuntos'];
                if ($Prog_KmXPuntosEDT == "") {
                    $Prog_KmXPuntosEDT = 0;
                }
                $Prog_TipoTablaEDT          = $row1['Prog_TipoTabla'];
                $Prog_NPlacaEDT             = $row1['Prog_NPlaca'];
                $Prog_NVidEDT               = $row1['Prog_NVid'];
                $Prog_IdMantoEDT            = $row1['Prog_IdManto'];
                $Prog_SentidoEDT            = $row1['Prog_Sentido'];
                $Prog_BusMantoEDT           = $row1['Prog_BusManto'];
                $CFaRg_IdEDT                = $row1['CFaRg_Id'];
                $CFaci_UsuarioIdEDT         = $row1['CFaci_UsuarioId'];
                $CFaci_EstadoEDT            = "ANULADO";
                $CFaci_NovedadEDT           = $row1['CFaci_Novedad'];
                $CFaci_ProcesoOrigenEDT     = $row1['CFaci_ProcesoOrigen'];
                $CFaci_VersionEDT           = $row1['CFaci_Version'];
                $Prog_ViajesEDT             = $row['Prog_Viajes'];
                $CFaci_Campo1EDT            = $row['CFaci_Campo1'];
                $CFaci_Campo2EDT            = $row['CFaci_Campo2'];
                $CFaci_Campo3EDT            = $row['CFaci_Campo3'];

                // Se cargan las variables $...ACT para Actualizar los cambios en la fila del Control Facilitador 
                $Programacion_IdACT         = $row1['Programacion_Id'];
                $Prog_CodigoACT             = $row1['Prog_Codigo'];
                $Prog_OperacionACT          = $row1['Prog_Operacion'];
                $Prog_FechaACT              = $row1['Prog_Fecha'];
                $Prog_IdMantoACT            = $row1['Prog_IdManto'];
                $CFaRg_IdACT                = $row1['CFaRg_Id'];
                $CFaci_ProcesoOrigenACT     = $row1['CFaci_ProcesoOrigen'];
                $CFaci_VersionACT           = $CFaci_VersionEDT + 1; // SE INCREMENTA VERSION +1 QUE QUEDARA ACTIVA
    
                if ($Prog_CodigoColaborador=="") {
                    $Prog_DniACT = $row1['Prog_Dni'];
                    $Prog_CodigoColaboradorACT = $row1['Prog_CodigoColaborador'];
                    $Prog_NombreColaboradorACT = $row1['Prog_NombreColaborador'];
                } else {
                    $Prog_DniACT = $Prog_Dni;
                    $Prog_CodigoColaboradorACT = $Prog_CodigoColaborador;
                    $Prog_NombreColaboradorACT = $Prog_NombreColaborador;
                }
                if ($Prog_Tabla=="") {
                    $Prog_TablaACT = $row1['Prog_Tabla'];
                } else {
                    $Prog_TablaACT = $Prog_Tabla;
                }
                if ($Prog_HoraOrigen=="") {
                    $Prog_HoraOrigenACT = $row1['Prog_HoraOrigen'];
                } else {
                    $Prog_HoraOrigenACT = $Prog_HoraOrigen;
                }
                if ($Prog_HoraDestino=="") {
                    $Prog_HoraDestinoACT = $row1['Prog_HoraDestino'];
                } else {
                    $Prog_HoraDestinoACT = $Prog_HoraDestino;
                }
                if ($Prog_Servicio=="") {
                    $Prog_ServicioACT = $row1['Prog_Servicio'];
                } else {
                    $Prog_ServicioACT = $Prog_Servicio;
                }
                if ($Prog_ServBus=="") {
                    $Prog_ServBusACT = $row1['Prog_ServBus'];
                } else {
                    $Prog_ServBusACT = $Prog_ServBus;
                }
                if ($Prog_Bus=="") {
                    $Prog_BusACT = $row1['Prog_Bus'];
                } else {
                    $Prog_BusACT = $Prog_Bus;
                }
                if ($Prog_LugarOrigen=="") {
                    $Prog_LugarOrigenACT = $row1['Prog_LugarOrigen'];
                } else {
                    $Prog_LugarOrigenACT = $Prog_LugarOrigen;
                }
                if ($Prog_LugarDestino=="") {
                    $Prog_LugarDestinoACT = $row1['Prog_LugarDestino'];
                } else {
                    $Prog_LugarDestinoACT = $Prog_LugarDestino;
                }
                if ($Prog_TipoEvento=="") {
                    $Prog_TipoEventoACT = $row1['Prog_TipoEvento'];
                } else {
                    $Prog_TipoEventoACT = $Prog_TipoEvento;
                }
                if ($Prog_Observaciones=="") {
                    $Prog_ObservacionesACT = $row1['Prog_Observaciones'];
                } else {
                    $Prog_ObservacionesACT = $Prog_Observaciones;
                }
                $Prog_KmXPuntosACT = $row1['Prog_KmXPuntos'];
                if ($Prog_KmXPuntos=="0" && $Prog_KmXPuntosACT=="0") {
                    $Prog_KmXPuntosACT = $Prog_KmXPuntos;
                }
                if ($Prog_TipoTabla=="") {
                    $Prog_TipoTablaACT = $row1['Prog_TipoTabla'];
                } else {
                    $Prog_TipoTablaACT = $Prog_TipoTabla;
                }
                if ($Prog_NPlaca=="") {
                    $Prog_NPlacaACT = $row1['Prog_NPlaca'];
                } else {
                    $Prog_NPlacaACT = $Prog_NPlaca;
                }
                if ($Prog_NVid=="") {
                    $Prog_NVidACT = $row1['Prog_NVid'];
                } else {
                    $Prog_NVidACT = $Prog_NVid;
                }
                if ($Prog_Sentido=="") {
                    $Prog_SentidoACT = $row1['Prog_Sentido'];
                } else {
                    $Prog_SentidoACT = $Prog_Sentido;
                }
                if ($Prog_BusManto=="") {
                    $Prog_BusMantoACT = $row1['Prog_BusManto'];
                } else {
                    $Prog_BusMantoACT = $Prog_BusManto;
                }
                if ($Prog_IdManto=="") {
                    $Prog_IdMantoACT = $row1['Prog_IdManto'];
                } else {
                    $Prog_IdMantoACT = $Prog_IdManto;
                }
                if ($Prog_Viajes=="") {
                    $Prog_ViajesACT = $row1['Prog_Viajes'];
                } else {
                    $Prog_ViajesACT = $Prog_Viajes;
                }
                if ($CFaci_Campo1=="") {
                    $CFaci_Campo1 = $row1['CFaci_Campo1'];
                } else {
                    $CFaci_Campo1ACT = $CFaci_Campo1;
                }
                if ($CFaci_Campo2=="") {
                    $CFaci_Campo2ACT = $row1['CFaci_Campo2'];
                } else {
                    $CFaci_Campo2ACT = $CFaci_Campo2;
                }
                if ($CFaci_Campo3=="") {
                    $CFaci_Campo3ACT = $row1['CFaci_Campo3'];
                } else {
                    $CFaci_Campo3ACT = $CFaci_Campo3;
                }

            }

            if ($btnOpcionNovedad=='NuevaNovedad') {
                //SOLO SE ACTUALIZA EL CAMPO CFaci_Novedad en la tabla OPE_ControlFacilitador
                MModel($this->Modulo, 'CRUD');
                $InstanciaAjax= new CRUD();
                $data3=$InstanciaAjax->EditarControlFacilitadorNovedad($ControlFacilitador_IdACT, $CFaci_NovedadACT);
            }else{
                // Se graba la nueva linea en la tabla OPE_ControlFacilitadorEDT con los datos que seran editados de la tabla OPE_ControlFacilitador 
                MModel($this->Modulo, 'CRUD');
                $InstanciaAjax= new CRUD();
                $Respuesta=$InstanciaAjax->CrearControlFacilitadorEDT($ControlFacilitador_IdEDT, $Programacion_IdEDT, $Prog_CodigoEDT, $Prog_OperacionEDT, $Prog_FechaEDT, $Prog_DniEDT, $Prog_CodigoColaboradorEDT, $Prog_NombreColaboradorEDT, $Prog_TablaEDT, $Prog_HoraOrigenEDT, $Prog_HoraDestinoEDT, $Prog_ServicioEDT, $Prog_ServBusEDT, $Prog_BusEDT, $Prog_LugarOrigenEDT, $Prog_LugarDestinoEDT, $Prog_TipoEventoEDT, $Prog_ObservacionesEDT, $Prog_KmXPuntosEDT, $Prog_TipoTablaEDT, $Prog_NPlacaEDT, $Prog_NVidEDT, $Prog_SentidoEDT, $Prog_BusMantoEDT, $Prog_IdMantoEDT, $CFaRg_IdEDT, $CFaci_EstadoEDT, $CFaci_UsuarioIdEDT, $CFaci_NovedadEDT, $CFaci_ProcesoOrigenEDT, $CFaci_VersionEDT, $Prog_ViajesEDT, $CFaci_Campo1EDT, $CFaci_Campo2EDT, $CFaci_Campo3EDT);

                MModel($this->Modulo, 'CRUD');
                $InstanciaAjax= new CRUD();
                $Respuesta=$InstanciaAjax->EditarControlFacilitador($ControlFacilitador_IdACT, $Programacion_IdACT, $Prog_CodigoACT, $Prog_OperacionACT, $Prog_FechaACT, $Prog_DniACT, $Prog_CodigoColaboradorACT, $Prog_NombreColaboradorACT, $Prog_TablaACT, $Prog_HoraOrigenACT, $Prog_HoraDestinoACT, $Prog_ServicioACT, $Prog_ServBusACT, $Prog_BusACT, $Prog_LugarOrigenACT, $Prog_LugarDestinoACT, $Prog_TipoEventoACT, $Prog_ObservacionesACT, $Prog_KmXPuntosACT, $Prog_TipoTablaACT, $Prog_NPlacaACT, $Prog_NVidACT, $Prog_SentidoACT, $Prog_BusMantoACT, $Prog_IdMantoACT, $CFaRg_IdACT, $CFaci_EstadoACT, $CFaci_NovedadACT, $CFaci_ProcesoOrigenACT,$CFaci_VersionACT, $Prog_ViajesACT, $CFaci_Campo1ACT, $CFaci_Campo2ACT, $CFaci_Campo3ACT);

                // En el Arreglo se graban los numeros Programacion_Id y ControlFacilitador_Id para generar el ControlCambiosNovedad
                $aProgramacionId[] = ["ControlFacilitador_Id" => $ControlFacilitador_IdACT, "Programacion_Id" => $Programacion_IdACT, "CFaRg_Id" => $CFaRg_IdACT, "CFaci_Version" => $CFaci_VersionACT];
            }

        }
              
        // Se graban las novedades en la tabla OPE_Novedad originadas por el nuevo registro del Control Facilitador
        if ($btnOpcionNovedad=='NuevaNovedad') {
            $CNove_TipoOrigen = "CREACION"; // CREACION, ASOCIACION
            $Nove_Estado = "PENDIENTE"; // Registro habilitado
            if($Nove_Novedad=='NOVEDAD_BUS' && $Nove_TipoNovedad=='FALLA_COMUNICACIONES' && $Nove_DetalleNovedad=='SIN_VARADA'){
                $Nove_Estado = "CERRADO"; // Registro se crea CERRADO
            }
            $Nove_Fecha = date("Y-m-d H:i:s");
            $Novedad_Id = date("Ymd-His");
            $Nove_Version = 1;

            MModel($this->Modulo, 'CRUD');
            $InstanciaAjax= new CRUD();
            $Respuesta=$InstanciaAjax->CrearNovedad($Novedad_Id, $Programacion_IdEDT, $Nove_Novedad, $Nove_TipoNovedad, $Nove_DetalleNovedad, $Nove_Descripcion, $Prog_OperacionEDT, $Prog_FechaEDT, $Prog_DniEDT, $Prog_CodigoColaboradorEDT, $Prog_NombreColaboradorEDT, $Prog_TablaEDT, $Prog_HoraOrigenEDT, $Prog_HoraDestinoEDT, $Prog_ServicioEDT, $Prog_BusEDT, $Prog_LugarOrigenEDT, $Prog_LugarDestinoEDT, $Nove_Estado, $CFaci_ProcesoOrigenEDT, $Nove_Fecha, $CFaRg_IdEDT, $Nove_LugarExacto, $Nove_HoraInicio, $Nove_HoraFin, $Nove_Version, $Nove_TipoOrigen);
            
            // Se graban las filas editadas y la novedad seleccionada en la tabla ControlCambiosNovedad
            $CNove_Fecha = $Nove_Fecha;
            
            $TablaBD = 'OPE_Novedad';
            $CampoBD = 'Novedad_Id';
            MModel($this->Modulo, 'CRUD');
            $InstanciaAjax= new CRUD();
            $RespuestaBN=$InstanciaAjax->BuscarDataBD($TablaBD,$CampoBD,$Novedad_Id);

            foreach ($RespuestaBN as $rowBN) {
                $CNove_ProcesoOrigen    = $rowBN['Nove_ProcesoOrigen'];
                $CNove_ProgramacionId   = $rowBN['Nove_ProgramacionId'];
                $CNove_NovedadId        = $rowBN['Novedad_Id'];
                $CNove_OPENovedadId     = $rowBN['OPE_NovedadId'];
                $CNove_FechaOperacion   = $rowBN['Nove_FechaOperacion'];
            }

            MModel($this->Modulo, 'CRUD');
            $InstanciaAjax  = new CRUD();
            $RespuestaCN    = $InstanciaAjax->CrearControlCambiosNovedad($CNove_ProcesoOrigen, $CNove_ProgramacionId, $CNove_NovedadId, $CNove_Fecha, $ControlFacilitador_IdEDT,$CNove_TipoOrigen,$CFaRg_IdEDT,$CNove_OPENovedadId,$CNove_FechaOperacion,$CFaci_VersionEDT,$Nove_Version);
        } else {
            // Se graban las filas editadas y la novedad seleccionada en la tabla ControlCambiosNovedad
			$CNove_TipoOrigen   = "ASOCIACION";
			$CNove_Fecha        = date("Y-m-d H:i:s");
            
            $TablaBD = 'OPE_Novedad';
            $CampoBD = 'OPE_NovedadId';
            MModel($this->Modulo, 'CRUD');
            $InstanciaAjax= new CRUD();
            $RespuestaBN0=$InstanciaAjax->BuscarDataBD($TablaBD,$CampoBD,$OPE_NovedadId);
            
            // Se cargan las variables de la tabla OPE_Novedad para ser grabados en la tabla OPE_ControlCambiosNovedad
            foreach ($RespuestaBN0 as $rowBN) {
                $CNove_ProcesoOrigen    = $rowBN['Nove_ProcesoOrigen'];
                $CNove_NovedadId        = $rowBN['Novedad_Id'];
                $CNove_OPENovedadId     = $rowBN['OPE_NovedadId'];
                $CNove_FechaOperacion   = $rowBN['Nove_FechaOperacion'];
                $CNove_NoveVersion      = $rowBN['Nove_Version'];
            }

            // se graban los filas del control facilitador con la novedad que las genera en la tabla OPE_ControlCambiosNovedad
            foreach ($aProgramacionId as $row) {
                $CNove_ProgramacionId       = $row['Programacion_Id'];
                $CNove_ControlFacilitadorId = $row['ControlFacilitador_Id'];
                $CNove_CFaRgId              = $row['CFaRg_Id'];
                $CNove_CFaciVersion         = $row['CFaci_Version'];
                
                MModel($this->Modulo, 'CRUD');
                $InstanciaAjax= new CRUD();
				$RespuestaCN=$InstanciaAjax->CrearControlCambiosNovedad($CNove_ProcesoOrigen, $CNove_ProgramacionId, $CNove_NovedadId, $CNove_Fecha, $CNove_ControlFacilitadorId,$CNove_TipoOrigen,$CNove_CFaRgId,$CNove_OPENovedadId,$CNove_FechaOperacion,$CNove_CFaciVersion,$CNove_NoveVersion);
			}
        }
    }

    public function EditarTotalControlFacilitador($Prog_Fecha,$Prog_Operacion,$Prog_IdManto1,$Prog_Bus2,$OPE_NovedadId)
    {
        if(!empty($Prog_IdManto1) && !empty($Prog_Bus2)){
            $Prog_NVid2 = "";
            $Prog_NPlaca2 = "";
            $Prog_BusManto2 = "";

            MModel($this->Modulo, 'CRUD');
            $InstanciaAjax= new CRUD();
            $Respuesta=$InstanciaAjax->BuscarBus($Prog_Fecha,$Prog_Operacion,$Prog_Bus2);
            foreach ($Respuesta as $row) {
                $Prog_BusManto2 = $row['Prog_BusManto'];
                $Prog_NVid2 = $row['Prog_NVid'];
                $Prog_NPlaca2 = $row['Prog_NPlaca'];
            }

            // SE CARGA LA INFORMACION DE LA NOVEDAD SELECCIONADA PARA SER GRANADOS EN LA TABLA OPE_ControlCambiosNovedad
            $CNove_TipoOrigen = "ASOCIACION";
            $CNove_Fecha = date("Y-m-d H:i:s");

            $TablaBD = 'OPE_Novedad';
            $CampoBD = 'OPE_NovedadId';
            MModel($this->Modulo, 'CRUD');
            $InstanciaAjax= new CRUD();
            $Respuesta=$InstanciaAjax->BuscarDataBD($TablaBD, $CampoBD, $OPE_NovedadId);

            foreach ($Respuesta as $row) {
                $CNove_ProcesoOrigen = $row['Nove_ProcesoOrigen'];
                $CNove_NovedadId = $row['Novedad_Id'];
                $CNove_OPENovedadId = $row['OPE_NovedadId'];
                $CNove_FechaOperacion = $row['Nove_FechaOperacion'];
                $CNove_NoveVersion = $row['Nove_Version'];
            }

            // SE INICIA EL CAMBIO DEL BUS 1 POR EL BUS 2
            MModel($this->Modulo, 'CRUD');
            $InstanciaAjax= new CRUD();
            $Respuesta=$InstanciaAjax->BuscarIdManto($Prog_Fecha,$Prog_Operacion,$Prog_IdManto1);

            foreach ($Respuesta as $row) {
                // Se cargan las variables $...EDT para crear una copia en la tabla OPE_ControlFacilitadorEDT
                $ControlFacilitador_IdEDT = $row['ControlFacilitador_Id'];
                $Programacion_IdEDT = $row['Programacion_Id'];
                $Prog_CodigoEDT = $row['Prog_Codigo'];
                $Prog_OperacionEDT = $row['Prog_Operacion'];
                $Prog_FechaEDT = $row['Prog_Fecha'];
                $Prog_DniEDT = $row['Prog_Dni'];
                $Prog_CodigoColaboradorEDT = $row['Prog_CodigoColaborador'];
                $Prog_NombreColaboradorEDT = $row['Prog_NombreColaborador'];
                $Prog_TablaEDT = $row['Prog_Tabla'];
                $Prog_HoraOrigenEDT = $row['Prog_HoraOrigen'];
                $Prog_HoraDestinoEDT = $row['Prog_HoraDestino'];
                $Prog_ServicioEDT = $row['Prog_Servicio'];
                $Prog_ServBusEDT = $row['Prog_ServBus'];
                $Prog_BusEDT = $row['Prog_Bus'];
                $Prog_LugarOrigenEDT = $row['Prog_LugarOrigen'];
                $Prog_LugarDestinoEDT = $row['Prog_LugarDestino'];
                $Prog_TipoEventoEDT = $row['Prog_TipoEvento'];
                $Prog_ObservacionesEDT = $row['Prog_Observaciones'];
                $Prog_KmXPuntosEDT = $row['Prog_KmXPuntos'];
                if ($Prog_KmXPuntosEDT == "") {
                    $Prog_KmXPuntosEDT = 0;
                }
                $Prog_TipoTablaEDT = $row['Prog_TipoTabla'];
                $Prog_NPlacaEDT = $row['Prog_NPlaca'];
                $Prog_NVidEDT = $row['Prog_NVid'];
                $Prog_IdMantoEDT = $row['Prog_IdManto'];
                $Prog_SentidoEDT = $row['Prog_Sentido'];
                $Prog_BusMantoEDT = $row['Prog_BusManto'];
                $CFaRg_IdEDT = $row['CFaRg_Id'];
                $CFaci_UsuarioIdEDT = $row['CFaci_UsuarioId'];
                $CFaci_EstadoEDT = "ANULADO";
                $CFaci_NovedadEDT = $row['CFaci_Novedad'];
                $CFaci_ProcesoOrigenEDT = $row['CFaci_ProcesoOrigen'];
                $CFaci_VersionEDT = $row['CFaci_Version'];
                $Prog_ViajesEDT = $row['Prog_Viajes'];
                $CFaci_Campo1EDT = $row['CFaci_Campo1'];
                $CFaci_Campo2EDT = $row['CFaci_Campo2'];
                $CFaci_Campo3EDT = $row['CFaci_Campo3'];

                // Se graba la nueva linea en la tabla OPE_ControlFacilitadorEDT con los datos que seran editados de la tabla OPE_ControlFacilitador 
                MModel($this->Modulo, 'CRUD');
                $InstanciaAjax= new CRUD();
                $Respuesta=$InstanciaAjax->CrearControlFacilitadorEDT($ControlFacilitador_IdEDT, $Programacion_IdEDT, $Prog_CodigoEDT, $Prog_OperacionEDT, $Prog_FechaEDT, $Prog_DniEDT, $Prog_CodigoColaboradorEDT, $Prog_NombreColaboradorEDT, $Prog_TablaEDT, $Prog_HoraOrigenEDT, $Prog_HoraDestinoEDT, $Prog_ServicioEDT, $Prog_ServBusEDT, $Prog_BusEDT, $Prog_LugarOrigenEDT, $Prog_LugarDestinoEDT, $Prog_TipoEventoEDT, $Prog_ObservacionesEDT, $Prog_KmXPuntosEDT, $Prog_TipoTablaEDT, $Prog_NPlacaEDT, $Prog_NVidEDT, $Prog_SentidoEDT, $Prog_BusMantoEDT, $Prog_IdMantoEDT, $CFaRg_IdEDT, $CFaci_EstadoEDT, $CFaci_UsuarioIdEDT, $CFaci_NovedadEDT, $CFaci_ProcesoOrigenEDT, $CFaci_VersionEDT, $Prog_ViajesEDT, $CFaci_Campo1EDT, $CFaci_Campo2EDT, $CFaci_Campo3EDT);
            
                // Se cargan las variables $...ACT para Actualizar los cambios en la fila del Control Facilitador 
                $CFaci_EstadoACT = "EDITADO"; // Registro habilitado
                $CFaci_NovedadACT = "SI"; // [NO] TIENE NOVEDAD, [SI] TIENE NOVEDAD
                $ControlFacilitador_IdACT = $row['ControlFacilitador_Id'];
                $CFaci_VersionACT = $CFaci_VersionEDT + 1; // SE INCREMENTA VERSION +1 QUE QUEDARA ACTIVA
                $Programacion_IdACT = $row['Programacion_Id'];
                $CFaRg_IdACT = $row['CFaRg_Id'];

                MModel($this->Modulo, 'CRUD');
                $InstanciaAjax= new CRUD();
                $Respuesta=$InstanciaAjax->EditarTotalBus($ControlFacilitador_IdACT, $CFaci_EstadoACT, $CFaci_NovedadACT, $CFaci_VersionACT, $Prog_Bus2, $Prog_NPlaca2, $Prog_NVid2, $Prog_BusManto2);

                // se graban los filas del control facilitador con la novedad que las genera en la tabla OPE_ControlCambiosNovedad
                $CNove_ProgramacionId = $Programacion_IdACT;
                $CNove_ControlFacilitadorId = $ControlFacilitador_IdACT;
                $CNove_CFaRgId = $CFaRg_IdACT;
                $CNove_CFaciVersion = $CFaci_VersionACT;
                
                MModel($this->Modulo, 'CRUD');
                $InstanciaAjax= new CRUD();
                $Respuesta=$InstanciaAjax->CrearControlCambiosNovedad($CNove_ProcesoOrigen, $CNove_ProgramacionId, $CNove_NovedadId, $CNove_Fecha,$CNove_ControlFacilitadorId, $CNove_TipoOrigen, $CNove_CFaRgId, $CNove_OPENovedadId, $CNove_FechaOperacion, $CNove_CFaciVersion, $CNove_NoveVersion);
            }
        }
    }

    public function SelectUsuario()
    {
        //Ejecuta Modelo
        MModel($this->Modulo, 'CRUD');
        $InstanciaAjax= new CRUD();
        $Respuesta=$InstanciaAjax->SelectUsuario();

        $html = '<option value="">Seleccione una opcion</option>';

        foreach ($Respuesta as $row) {
            $html .= '<option value="'.$row['Usuario'].'">'.$row['Usuario'].'</option>';
        }
        echo $html;
    }

    public function SelectUsuarioActual($Prog_Fecha,$Prog_Operacion)
    {
        //Ejecuta Modelo
        MModel($this->Modulo, 'CRUD');
        $InstanciaAjax= new CRUD();
        $Respuesta=$InstanciaAjax->SelectUsuarioActual($Prog_Fecha,$Prog_Operacion);

        $html = '<option value="">Seleccione una opcion</option>';

        foreach ($Respuesta as $row) {
            $html .= '<option value="'.$row['Usuario'].'">'.$row['Usuario'].'</option>';
        }
        echo $html;
    }

    public function SelectBus($Prog_Operacion)
    {
        //Ejecuta Modelo
        MModel($this->Modulo, 'CRUD');
        $InstanciaAjax= new CRUD();
        $Respuesta=$InstanciaAjax->SelectBus($Prog_Operacion);

        $html = '<option value="">Seleccione una opcion</option>';
        $html .= '<option value="00000">00000</option>';

        foreach ($Respuesta as $row) {
            $html .= '<option value="'.$row['Bus'].'">'.$row['Bus'].'</option>';
        }
        echo $html;
    }

    public function SelectIdMantoActual($Prog_Fecha,$Prog_Operacion)
    {
        //Ejecuta Modelo
        MModel($this->Modulo, 'CRUD');
        $InstanciaAjax= new CRUD();
        $Respuesta=$InstanciaAjax->SelectIdMantoActual($Prog_Fecha,$Prog_Operacion);

        $html = '<option value="">Seleccione una opcion</option>';

        foreach ($Respuesta as $row) {
            $html .= '<option value="'.$row['IdManto'].'">'.$row['IdManto'].' | '.substr($row['ServBus'],0,15).' | '.substr($row['Servicio'],0,10).' | '.$row['Km'].' Km | '.$row['HoraInicio'].'-'.$row['HoraTermino'].' '.substr($row['BusManto'],0,5).'</option>';
        }
        echo $html;
    }

    public function SelectBusCambio($Prog_Fecha,$Prog_Operacion)
    {
        //Ejecuta Modelo
        MModel($this->Modulo, 'CRUD');
        $InstanciaAjax= new CRUD();
        $Respuesta=$InstanciaAjax->SelectBusCambio($Prog_Fecha,$Prog_Operacion);

        $html = '<option value="">Seleccione una opcion</option>';
        $html .= '<option value="00000">00000</option>';

        foreach ($Respuesta as $row) {
            $html .= '<option value="'.$row['Bus'].'">'.$row['Bus'].'</option>';
        }
        echo $html;
    }

    public function CodigoColaborador($Prog_NombreColaborador)
    {
        MModel($this->Modulo, 'CRUD');
        $InstanciaAjax= new CRUD();
        $Respuesta=$InstanciaAjax->CodigoColaborador($Prog_NombreColaborador);

        $Codigo = '';
        foreach ($Respuesta as $row) {
            $Codigo = $row['Colab_CodigoCortoPT'];
        }
        echo $Codigo;
    }

    public function BusNroVid($Prog_Bus)
    {
        MModel($this->Modulo, 'CRUD');
        $InstanciaAjax= new CRUD();
        $Respuesta=$InstanciaAjax->BusNroVid($Prog_Bus);

        $NroVID = '';
        foreach ($Respuesta as $row) {
            $NroVID = $row['NroVID'];
        }
        echo $NroVID;
    }

    public function BusNroPlaca($Prog_Bus)
    {
        MModel($this->Modulo, 'CRUD');
        $InstanciaAjax= new CRUD();
        $Respuesta=$InstanciaAjax->BusNroPlaca($Prog_Bus);

        $NroPlaca = '';
        foreach ($Respuesta as $row) {
            $NroPlaca = $row['NroPlaca'];
        }
        echo $NroPlaca;
    }

    public function SelectTipos($Prog_Operacion, $Ttabla_Tipo)
    {
        MModel($this->Modulo, 'CRUD');
        $InstanciaAjax= new CRUD();
        $Respuesta=$InstanciaAjax->SelectTipos($Prog_Operacion, $Ttabla_Tipo);

        $html = '<option value="">Seleccione una opcion</option>';

        foreach ($Respuesta as $row) {
            $html .= '<option value="'.$row['Detalle'].'">'.$row['Detalle'].'</option>';
        }
        echo $html;
    }

    public function ValidarControlFacilitador($Prog_Fecha, $Prog_Operacion)
    {
        MModel($this->Modulo, 'CRUD');
        $InstanciaAjax= new CRUD();
        $Respuesta=$InstanciaAjax->ValidarControlFacilitador($Prog_Fecha, $Prog_Operacion);

        $CFaRg_Estado = '';
        foreach ($Respuesta as $row) {
            $CFaRg_Estado = $row['CFaRg_Estado'];
        }
        echo $CFaRg_Estado;
    }

    public function InconsistenciasControlFacilitador($Prog_Fecha, $Prog_Operacion)
    {
        $Orden = "COLABORADOR";

        MModel($this->Modulo, 'CRUD');
        $InstanciaAjax= new CRUD();
        $Respuesta=$InstanciaAjax->InconsistenciasControlFacilitador($Prog_Fecha, $Prog_Operacion, $Orden);

        $aInconsistencias   = array();
        $DniPiloto          = "";
        $Servicio           = "DISPONIBLE OPERACION";
        $Servicio1          = "DISPONIBLE";
        $Evento             = "ANULADO";
        $Error = true;

        foreach ($Respuesta as $row) {
            if ($DniPiloto != $row['Prog_Dni']) {
                $DniPiloto = $row['Prog_Dni'];
                $HoraOrigenPrevia =	$row['Prog_Hora_Origen'];
                $Error = false;
            }
            if ($Servicio == $row['Prog_Servicio'] || $Servicio1 == $row['Prog_Servicio'] || $Evento == $row['Prog_TipoEvento'] ){
                $DniPiloto = "";
                $HoraOrigenPrevia =	"";
                $Error = true;
            }
            if ($Error==false) {
                if ($row['Prog_HoraOrigen'] >= $HoraOrigenPrevia) {
                    if ($row['Prog_HoraDestino'] >= $row['Prog_HoraOrigen']) {
                        $HoraOrigenPrevia = $row['Prog_HoraDestino'];
                    } else {
                        $aInconsistencias[] = ["Inco_Id" => $row['ControlFacilitador_Id'], "Inco_Tipo" => "PILOTO", "Inco_Detalle" => $row['Prog_NombreColaborador'], "Inco_IdManto" => $row['Prog_IdManto']];
                        $Error = true;
                    }
                } else {
                    $aInconsistencias[] = ["Inco_Id" => $row['ControlFacilitador_Id'],"Inco_Tipo" => "PILOTO", "Inco_Detalle" => $row['Prog_NombreColaborador'], "Inco_IdManto" => $row['Prog_IdManto']];
                    $Error = true;
                }
            }
        }

        $Orden      = "BUS";
        $Servicio   = "BUS RETEN";
        $Evento     = "ANULADO";
        MModel($this->Modulo, 'CRUD');
        $InstanciaAjax= new CRUD();
        $Respuesta=$InstanciaAjax->InconsistenciasControlFacilitador($Prog_Fecha, $Prog_Operacion, $Orden);
        $Bus="";
        $Error = true;

        foreach ($Respuesta as $row) {
            if ($Bus != $row['Prog_Bus']) {
                $Bus = $row['Prog_Bus'];
                $HoraOrigenPrevia =	$row['Prog_Hora_Origen'];
                $Error = false;
            }
            if ($Servicio == $row['Prog_Servicio'] || $Evento == $row['Prog_TipoEvento']){
                $Bus = "";
                $HoraOrigenPrevia =	"";
                $Error = true;
            }
            if ($Error==false) {
                if ($row['Prog_HoraOrigen'] >= $HoraOrigenPrevia) {
                    if ($row['Prog_HoraDestino'] >= $row['Prog_HoraOrigen']) {
                        $HoraOrigenPrevia = $row['Prog_HoraDestino'];
                    } else {
                        $aInconsistencias[] = ["Inco_Id" => $row['ControlFacilitador_Id'], "Inco_Tipo" => "BUS", "Inco_Detalle" => $row['Prog_Bus'], "Inco_IdManto" => $row['Prog_IdManto']];
                        $Error = true;
                    }
                } else {
                    $aInconsistencias[] = ["Inco_Id" => $row['ControlFacilitador_Id'], "Inco_Tipo" => "BUS", "Inco_Detalle" => $row['Prog_Bus'], "Inco_IdManto" => $row['Prog_IdManto']];
                    $Error = true;
                }
            }
        }
        print json_encode($aInconsistencias, JSON_UNESCAPED_UNICODE);//envio el array final el formato json a AJAX
    }

    public function InconsistenciasBusPiloto($Prog_Fecha,$Prog_Operacion,$Prog_Bus,$Prog_NombreColaborador,$arrData,$Prog_HoraOrigen,$Prog_HoraDestino)
    {
        $rptaInconsistencias = "";
        $Prog_HDestino="";
        $Prog_HOrigen="";
        $primerPiloto = 0;
        $primerBus = 0;
        
        if(count($arrData)>0){
            foreach($arrData as $row){
                $ControlFacilitador_Id = $row;
                if($primerPiloto == 0){
                    MModel($this->Modulo, 'CRUD');
                    $InstanciaAjax= new CRUD();
                    $Respuesta=$InstanciaAjax->InconsistenciasPiloto($Prog_Fecha, $Prog_Operacion, $Prog_NombreColaborador,$Prog_HoraOrigen,$Prog_HDestino,$ControlFacilitador_Id);
                    foreach ($Respuesta as $row) {
                        $rptaInconsistencias = "Colaborador ID: ".$row['ControlFacilitador_Id']." ";
                        $primerPiloto = 1;
                    }
                    if($primerPiloto==0){
                        $InstanciaAjax= new CRUD();
                        $Respuesta=$InstanciaAjax->InconsistenciasPiloto($Prog_Fecha, $Prog_Operacion, $Prog_NombreColaborador,$Prog_HOrigen,$Prog_HoraDestino,$ControlFacilitador_Id);
                        foreach ($Respuesta as $row) {
                            $rptaInconsistencias = "Colaborador ID: ".$row['ControlFacilitador_Id']." ";
                            $primerPiloto = 1;
                        }
                    }
                }
                if($primerBus == 0 && $Prog_Bus!=""){
                    MModel($this->Modulo, 'CRUD');
                    $InstanciaAjax= new CRUD();
                    $Respuesta=$InstanciaAjax->InconsistenciasBus($Prog_Fecha, $Prog_Operacion, $Prog_Bus,$Prog_HoraOrigen,$Prog_HDestino,$ControlFacilitador_Id);
                    foreach ($Respuesta as $row) {
                        if(empty($rptaInconsistencias)){
                            $rptaInconsistencias .= "Bus ID: ".$row['ControlFacilitador_Id']." ";
                        }else{
                            $rptaInconsistencias .= " -  Bus ID: ".$row['ControlFacilitador_Id']." ";
                        }
                        $primerBus = 1;
                    }
                    if($primerBus==0){
                        $InstanciaAjax= new CRUD();
                        $Respuesta=$InstanciaAjax->InconsistenciasBus($Prog_Fecha, $Prog_Operacion, $Prog_Bus,$Prog_HOrigen,$Prog_HoraDestino,$ControlFacilitador_Id);
                        foreach ($Respuesta as $row) {
                            if (empty($rptaInconsistencias)) {
                                $rptaInconsistencias = "Bus ID: ".$row['ControlFacilitador_Id']." ";
                            } else {
                                $rptaInconsistencias .= " -  Bus ID: ".$row['ControlFacilitador_Id']." ";
                            }
                            $primerBus = 1;
                        }
                    }
                }
            }
        }
        echo $rptaInconsistencias;
    }

    public function ResumenOperacion($Prog_Fecha)
    {
        $html                               = "";
        $operacion_alimentador              = "ALIMENTADOR";
        $operacion_troncal                  = "TRONCAL";
        $a_resumen_operacion                = array();
        $pie_pagina_resumen_ope             = "";
        $fecha_resumen_ope                  = date_format(date_create($Prog_Fecha),"d/m/Y");
        $encargado_resumen_ope              = "";
        $buses_reten_resumen_ope            = 0;
        $retraso_operacion_resumen_ope      = 0;
        $cambio_bus_resumen_ope             = 0;
        $cambio_piloto_resumen_ope          = 0;
        $km_alimentador_resumen_ope         = 0;
        $km_troncal_resumen_ope             = 0;
        $km_adicional_alimentador           = 0;
        $km_adicional_troncal               = 0;
        $km_perdido_alimentador             = 0;
        $km_perdido_troncal                 = 0;
        $falla_bus_resumen_ope              = 0;
        $falla_comunicaciones_resumen_ope   = 0;
        $falla_telemetria_resumen_ope       = 0;
        $bus_no_disponible_resumen_ope      = 0;
        $bus_bajo_gas_resumen_ope           = 0;
        $bus_no_conforme_resumen_ope        = 0;
        $cambios_status_resumen_ope         = 0;
        $bus_no_confiable_resumen_ope       = 0;
        $varadas_resumen_ope                = 0;
        $inasistencia_total_resumen_ope     = 0;
        $inasistencia_parcial_resumen_ope   = 0;
        $actitud_negativa_resumen_ope       = 0;
        $incump_norma_sistema_resumen_ope   = 0;
        $incump_norma_transito_resumen_ope  = 0;
        $accidente_sl_resumen_ope           = 0;
        $accidente_cl_resumen_ope           = 0;
        $incidentes_resumen_ope             = 0;
        $accidente_transito_resumen_ope     = 0;
        $dano_operacion_resumen_ope         = 0;
        $vandalismo_resumen_ope             = 0;
        $accidente_especial_resumen_ope     = 0;
        $total_inasistencias_resumen_ope    = 0;

        $n_anio = substr($Prog_Fecha,0,4);
        $n_dia  = substr($Prog_Fecha,8,2);
        switch (date("w",strtotime($Prog_Fecha)))
        {
            case 0: $t_dia = "DOMINGO"; break;
            case 1: $t_dia = "LUNES"; break;
            case 2: $t_dia = "MARTES"; break;
            case 3: $t_dia = "MIERCOLES"; break;
            case 4: $t_dia = "JUEVES"; break;
            case 5: $t_dia = "VIERNES"; break;
            case 6: $t_dia = "SABADO"; break;
        }
        switch (substr($Prog_Fecha,5,2))
        {
            case "01": $t_mes = "ENERO"; break;
            case "02": $t_mes = "FEBRERO"; break;
            case "03": $t_mes = "MARZO"; break;
            case "04": $t_mes = "ABRIL"; break;
            case "05": $t_mes = "MAYO"; break;
            case "06": $t_mes = "JUNIO"; break;
            case "07": $t_mes = "JULIO"; break;
            case "08": $t_mes = "AGOSTO"; break;
            case "09": $t_mes = "SETIEMBRE"; break;
            case "10": $t_mes = "OCTUBRE"; break;
            case "11": $t_mes = "NOVIEMBRE"; break;
            case "12": $t_mes = "DICIEMBRE"; break;
        }
        $t_fecha = $t_dia.", ".$n_dia." DE ".$t_mes." DEL ".$n_anio;

        MModel($this->Modulo, 'CRUD');
        $InstanciaAjax= new CRUD();
        $Respuesta=$InstanciaAjax->NombreUsuario();

        foreach ($Respuesta as $row) {
            $encargado_resumen_ope = $row['nombrecorto'];
        }

        MModel($this->Modulo, 'CRUD');
        $InstanciaAjax  = new CRUD();
        $Respuesta      = $InstanciaAjax->BusesReten($Prog_Fecha);

        foreach ($Respuesta as $row) {
            $buses_reten_resumen_ope = $row['busesreten'];
        }

        MModel($this->Modulo, 'CRUD');
        $InstanciaAjax  = new CRUD();
        $Respuesta      = $InstanciaAjax->RetrasoOperacion($Prog_Fecha);

        foreach ($Respuesta as $row) {
            $retraso_operacion_resumen_ope = $row['retrasooperacion'];
        }

        MModel($this->Modulo, 'CRUD');
        $InstanciaAjax  = new CRUD();
        $Respuesta      = $InstanciaAjax->CambioBus($Prog_Fecha);
        
        $cambio_bus_resumen_ope = $Respuesta;

        MModel($this->Modulo, 'CRUD');
        $InstanciaAjax  = new CRUD();
        $Respuesta      = $InstanciaAjax->varadas($Prog_Fecha);

        foreach ($Respuesta as $row) {
            if ($row['cantidad']>0){
                $varadas_resumen_ope = $row['cantidad'];
            }
        }

        MModel($this->Modulo, 'CRUD');
        $InstanciaAjax  = new CRUD();
        $Respuesta      = $InstanciaAjax->cambio_piloto($Prog_Fecha);
        
        $cambio_piloto_resumen_ope = $Respuesta;

        MModel($this->Modulo, 'CRUD');
        $InstanciaAjax  = new CRUD();
        $Respuesta      = $InstanciaAjax->km_comercial($Prog_Fecha);

        foreach ($Respuesta as $row) {
            if ($row['km_comercial']>0){
                if($row['Prog_Operacion']==$operacion_alimentador){
                    $km_alimentador_resumen_ope = $row['km_comercial'];
                }
                if($row['Prog_Operacion']==$operacion_troncal){
                    $km_troncal_resumen_ope = $row['km_comercial'];
                }                
            }
        }

        MModel($this->Modulo, 'CRUD');
        $InstanciaAjax  = new CRUD();
        $Respuesta      = $InstanciaAjax->km_adicional($Prog_Fecha, $operacion_alimentador);

        foreach ($Respuesta as $row) {
            if ($row['km_adicional']>0){
                $km_adicional_alimentador = $row['km_adicional'];
            }
        }

        MModel($this->Modulo, 'CRUD');
        $InstanciaAjax  = new CRUD();
        $Respuesta      = $InstanciaAjax->km_adicional($Prog_Fecha, $operacion_troncal);

        foreach ($Respuesta as $row) {
            if ($row['km_adicional']>0){
                $km_adicional_troncal = $row['km_adicional'];
            }
        }

        MModel($this->Modulo, 'CRUD');
        $InstanciaAjax  = new CRUD();
        $Respuesta      = $InstanciaAjax->km_perdido($Prog_Fecha, $operacion_alimentador);

        foreach ($Respuesta as $row) {
            if ($row['km_perdido']>0){
                $km_perdido_alimentador = $row['km_perdido'];
            }
        }

        MModel($this->Modulo, 'CRUD');
        $InstanciaAjax  = new CRUD();
        $Respuesta      = $InstanciaAjax->km_perdido($Prog_Fecha, $operacion_troncal);

        foreach ($Respuesta as $row) {
            if ($row['km_perdido']>0){
                $km_perdido_troncal = $row['km_perdido'];
            }
        }

        MModel($this->Modulo, 'CRUD');
        $InstanciaAjax= new CRUD();
        $Respuesta=$InstanciaAjax->ResumenOperacion($Prog_Fecha);

        foreach ($Respuesta as $row) {
            switch ($row['Nove_TipoNovedad']) {
                case 'FALLA_BUS'                : $falla_bus_resumen_ope                = $row['cantidad'];     break;
                case 'FALLA_COMUNICACIONES'     : $falla_comunicaciones_resumen_ope     = $row['cantidad'];     break;
                case 'FALLA_TELEMETRIA'         : $falla_telemetria_resumen_ope         = $row['cantidad'];     break;
                case 'BUS_NO_DISPONIBLE'        : $bus_no_disponible_resumen_ope        = $row['cantidad'];     break;
                case 'BUS_CON_BAJO_GAS'         : $bus_bajo_gas_resumen_ope             = $row['cantidad'];     break;
                case 'BUS_NO_CONFORME'          : $bus_no_conforme_resumen_ope          = $row['cantidad'];     break;
                case 'CAMBIO_POR_STATUS'        : $cambios_status_resumen_ope           = $row['cantidad'];     break;
                case 'BUS_NO_CONFIABLE'         : $bus_no_confiable_resumen_ope         = $row['cantidad'];     break;

                case 'ACCIDENTE_TRANSITO'       : $accidente_transito_resumen_ope       = $row['cantidad'];     break;
                case 'DAÑO_EN_OPERACION'        : $dano_operacion_resumen_ope           = $row['cantidad'];     break;
                case 'INCIDENTE'                : $incidentes_resumen_ope               = $row['cantidad'];     break;
                case 'VANDALISMO'               : $vandalismo_resumen_ope               = $row['cantidad'];     break;
                case 'ACCIDENTE_ESPECIAL'       : $accidente_especial_resumen_ope       = $row['cantidad'];     break;

                case 'INASISTENCIA_TOTAL'       : $inasistencia_total_resumen_ope       = $row['cantidad'];     break;
                case 'INASISTENCIA_PARCIAL'     : $inasistencia_parcial_resumen_ope     = $row['cantidad'];     break;
                case 'ACTITUD_NEGATIVA'         : $actitud_negativa_resumen_ope         = $row['cantidad'];     break;
                case 'INCUMP_NORMA_SISTEMA'     : $incump_norma_sistema_resumen_ope     = $row['cantidad'];     break;
                case 'INCUMP_NORMA_TRANSITO'    : $incump_norma_transito_resumen_ope    = $row['cantidad'];     break;
                default: ;
            }
        }

        $total_inasistencias_resumen_ope = $inasistencia_parcial_resumen_ope + $inasistencia_total_resumen_ope;

        $html = '   <div class="modal-body">
                        <div class="row align-items-end mb-3 border-bottom border-muted">
                            <div class="col-lg-3">
                                <img src="Module/ControlFacilitador/View/Img/logo23.JPG" class="my-logo-modal-body" alt="">
                            </div>
                            <div class="col-lg-9">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <h4 class="modal-body-title_resumen_troncal" id="modal-body-title_resumen_troncal">RESUMEN DE OPERACION DIARIA</h4>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <h6 class="modal-body-subtitle_resumen_troncal" id="modal-body-subtitle_resumen_troncal">FECHA  :&nbsp&nbsp'.$t_fecha.'</h6> 
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row align-items-end mb-0 pt-3 pl-5 pr-5">
                            <div class="col-lg-6 ">
                                <div class="form-group">
                                    <span class=" text-secondary">KM. COMERCIAL</span>
                                    <span class=" text-secondary">ALIMENTADOR </span>
                                    <br>
                                    <h1 class=" text-secondary font-weight-bold">'.number_format($km_alimentador_resumen_ope,2,'.',' ').'</h1> 
                                </div>
                            </div>
                            <div class="col-lg-6 border-left border-muted">
                                <div class="form-group">
                                    <span class=" text-secondary">KM. COMERCIAL</span>
                                    <span class=" text-secondary">TRONCAL </span>
                                    <br>
                                    <h1 class=" text-secondary font-weight-bold">'.number_format($km_troncal_resumen_ope,2,'.',' ').'</h1>
                                </div> 
                            </div>
                        </div>
                        
                        <div class="row align-items-end mb-0 pb-4 pl-5 pr-5  border-bottom border-muted">
                            <div class="col-lg-3  ">
                                <div class="form-group">
                                    <span class=" text-secondary">KM. ADICIONAL</span>
                                    <br>
                                    <h4 class=" text-secondary font-weight-bold">'.number_format($km_adicional_alimentador,2,'.',' ').'</h4> 
                                </div>
                            </div><div class="col-lg-3  ">
                                <div class="form-group">
                                    <span class=" text-secondary">KM. PERDIDO</span>
                                    <br>
                                    <h4 class=" text-secondary font-weight-bold">'.number_format($km_perdido_alimentador,2,'.',' ').'</h4> 
                                </div>
                            </div>
                            <div class="col-lg-3 border-left border-muted">
                                <div class="form-group">
                                    <span class=" text-secondary">KM. ADICIONAL</span>
                                    <br>
                                    <h4 class=" text-secondary font-weight-bold">'.number_format($km_adicional_troncal,2,'.',' ').'</h4>   
                                </div> 
                            </div><div class="col-lg-3">
                                <div class="form-group">
                                    <span class=" text-secondary">KM. PERDIDO</span>
                                    <br>
                                    <h4 class=" text-secondary font-weight-bold">'.number_format($km_perdido_troncal,2,'.',' ').'</h4>   
                                </div> 
                            </div>
                        </div>

                        <div class="row align-items-end pt-3 pb-3 pl-5 pr-5 border-bottom border-muted">
                            <div class="col-lg-3 ">
                                <div class="form-group mb-0">
                                    <span class=" text-secondary">Cambio Bus</span>
                                    <br>
                                    <h4 class=" text-secondary font-weight-bold">'.$cambio_bus_resumen_ope.'</h4> 
                                </div>
                            </div><div class="col-lg-3  ">
                                <div class="form-group mb-0">
                                    <span class=" text-secondary">Cambio Piloto</span>
                                    <br>
                                    <h4 class=" text-secondary font-weight-bold">'.$cambio_piloto_resumen_ope.'</h4> 
                                </div>
                            </div>
                            
                            <div class="col-lg-3">
                                <div class="form-group mb-0">
                                    <span class=" text-secondary">Total Inasistencias</span>
                                    <br>
                                    <h4 class=" text-secondary font-weight-bold">'.$total_inasistencias_resumen_ope.'</h4>   
                                </div> 
                            </div><div class="col-lg-3">
                                <div class="form-group mb-0">
                                    <span class=" text-secondary">Varadas</span>
                                    <br>
                                    <h4 class=" text-secondary font-weight-bold">'.$varadas_resumen_ope.'</h4>   
                                </div> 
                            </div>
                        </div>

                        <div class="row pt-3">
                            <div class="col-lg-4">
                                <div class="form-row align-items-end">
                                    <div class="col-lg-10">
                                        <p class="form-control form-control-sm bg-success text-white">FALLAS DE BUS</p>
                                    </div>
                                    <div class="col-lg-2">
                                        <p class="form-control form-control-sm font-weight-bold">'.$falla_bus_resumen_ope.'</p>
                                    </div>
                                </div>
                                <div class="form-row align-items-end">
                                    <div class="col-lg-10">
                                        <p class="form-control form-control-sm bg-success text-white">BUSES RETEN</p>
                                    </div>
                                    <div class="col-lg-2">
                                        <p class="form-control form-control-sm font-weight-bold">'.$buses_reten_resumen_ope.'</p>
                                    </div>
                                </div>
                                <div class="form-row align-items-end">
                                    <div class="col-lg-10">
                                        <p class="form-control form-control-sm bg-success text-white">FALLA COMUNICACIONES</p>
                                    </div>
                                    <div class="col-lg-2">
                                        <p class="form-control form-control-sm font-weight-bold">'.$falla_comunicaciones_resumen_ope.'</p>
                                    </div>
                                </div>
                                <div class="form-row align-items-end">
                                    <div class="col-lg-10">
                                        <p class="form-control form-control-sm bg-success text-white">FALLA TELEMETRIA</p>
                                    </div>
                                    <div class="col-lg-2">
                                        <p class="form-control form-control-sm font-weight-bold">'.$falla_telemetria_resumen_ope.'</p>
                                    </div>
                                </div>
                                <div class="form-row align-items-end">
                                    <div class="col-lg-10">
                                        <p class="form-control form-control-sm bg-success text-white">BUS NO DISPONIBLE</p>
                                    </div>
                                    <div class="col-lg-2">
                                        <p class="form-control form-control-sm font-weight-bold">'.$bus_no_disponible_resumen_ope.'</p>
                                    </div>
                                </div>
                                <div class="form-row align-items-end">
                                    <div class="col-lg-10">
                                        <p class="form-control form-control-sm bg-success text-white">BUS BAJO GAS</p>
                                    </div>
                                    <div class="col-lg-2">
                                        <p class="form-control form-control-sm font-weight-bold">'.$bus_bajo_gas_resumen_ope.'</p>
                                    </div>
                                </div>
                                <div class="form-row align-items-end">
                                    <div class="col-lg-10">
                                        <p class="form-control form-control-sm bg-success text-white">BUS NO CONFORME</p>
                                    </div>
                                    <div class="col-lg-2">
                                        <p class="form-control form-control-sm font-weight-bold">'.$bus_no_conforme_resumen_ope.'</p>
                                    </div>
                                </div>
                                <div class="form-row align-items-end">
                                    <div class="col-lg-10">
                                        <p class="form-control form-control-sm bg-success text-white">CAMBIOS POR STATUS</p>
                                    </div>
                                    <div class="col-lg-2">
                                        <p class="form-control form-control-sm font-weight-bold">'.$cambios_status_resumen_ope.'</p>
                                    </div>
                                </div>
                                <div class="form-row align-items-end">
                                    <div class="col-lg-10">
                                        <p class="form-control form-control-sm bg-success text-white">BUS NO CONFIABLE</p>
                                    </div>
                                    <div class="col-lg-2">
                                        <p class="form-control form-control-sm font-weight-bold">'.$bus_no_confiable_resumen_ope.'</p>
                                    </div>
                                </div>

                            </div>
                            <div class="col-lg-4">
                                <div class="form-row align-items-end">
                                    <div class="col-lg-10">
                                        <p class="form-control form-control-sm bg-secondary text-white">ACCIDENTE TRANSITO</p>
                                    </div>
                                    <div class="col-lg-2">
                                        <p class="form-control form-control-sm font-weight-bold">'.$accidente_transito_resumen_ope.'</p>
                                    </div>
                                </div>
                                <div class="form-row align-items-end">
                                    <div class="col-lg-10">
                                        <p class="form-control form-control-sm bg-secondary text-white">DAÑO EN OPERACION</p>
                                    </div>
                                    <div class="col-lg-2">
                                        <p class="form-control form-control-sm font-weight-bold">'.$dano_operacion_resumen_ope.'</p>
                                    </div>
                                </div>
                                <div class="form-row align-items-end">
                                    <div class="col-lg-10">
                                        <p class="form-control form-control-sm bg-secondary text-white">RETRASO</p>
                                    </div>
                                    <div class="col-lg-2">
                                        <p class="form-control form-control-sm font-weight-bold">'.$retraso_operacion_resumen_ope.'</p>
                                    </div>
                                </div>
                                <div class="form-row align-items-end">
                                    <div class="col-lg-10">
                                        <p class="form-control form-control-sm bg-secondary text-white">INCIDENTE</p>
                                    </div>
                                    <div class="col-lg-2">
                                        <p class="form-control form-control-sm font-weight-bold">'.$incidentes_resumen_ope.'</p>
                                    </div>
                                </div>
                                <div class="form-row align-items-end">
                                    <div class="col-lg-10">
                                        <p class="form-control form-control-sm bg-secondary text-white">VANDALISMO</p>
                                    </div>
                                    <div class="col-lg-2">
                                        <p class="form-control form-control-sm font-weight-bold">'.$vandalismo_resumen_ope.'</p>
                                    </div>
                                </div>
                                <div class="form-row align-items-end">
                                    <div class="col-lg-10">
                                        <p class="form-control form-control-sm bg-secondary text-white">ACCIDENTE ESPECIAL</p>
                                    </div>
                                    <div class="col-lg-2">
                                        <p class="form-control form-control-sm font-weight-bold">'.$accidente_especial_resumen_ope.'</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-row align-items-end">
                                    <div class="col-lg-10">
                                        <p class="form-control form-control-sm bg-warning text-dark">INASISTENCIA TOTAL</p>
                                    </div>
                                    <div class="col-lg-2">
                                        <p class="form-control form-control-sm font-weight-bold">'.$inasistencia_total_resumen_ope.'</p>
                                    </div>
                                </div>
                                <div class="form-row align-items-end">
                                    <div class="col-lg-10">
                                        <p class="form-control form-control-sm bg-warning text-dark">INASISTENCIA PARCIAL</p>
                                    </div>
                                    <div class="col-lg-2">
                                        <p class="form-control form-control-sm font-weight-bold">'.$inasistencia_parcial_resumen_ope.'</p>
                                    </div>
                                </div>
                                <div class="form-row align-items-end">
                                    <div class="col-lg-10">
                                        <p class="form-control form-control-sm bg-warning text-dark">ACTITUD NEGATIVA</p>
                                    </div>
                                    <div class="col-lg-2">
                                        <p class="form-control form-control-sm font-weight-bold">'.$actitud_negativa_resumen_ope.'</p>
                                    </div>
                                </div>
                                <div class="form-row align-items-end">
                                    <div class="col-lg-10">
                                        <p class="form-control form-control-sm bg-warning text-dark">INCUMP.NORMA SISTEMA</p>
                                    </div>
                                    <div class="col-lg-2">
                                        <p class="form-control form-control-sm font-weight-bold">'.$incump_norma_sistema_resumen_ope.'</p>
                                    </div>
                                </div>
                                <div class="form-row align-items-end">
                                    <div class="col-lg-10">
                                        <p class="form-control form-control-sm bg-warning text-dark">INCUMP.NORM. TRANSITO</p>
                                    </div>
                                    <div class="col-lg-2">
                                        <p class="form-control form-control-sm font-weight-bold">'.$incump_norma_transito_resumen_ope.'</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <div class="row align-items-end">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <h6>Generado el:&nbsp&nbsp'.date("d/m/Y H:i").'&nbsp&nbsp Responsable :&nbsp&nbsp'.$encargado_resumen_ope.'</h6>
                                </div> 
                            </div>
                        </div>
                    </div>';
        echo $html;
    }

    public function resumen_operacion_hist($Prog_Fecha)
    {
        $html                               = "";
        $operacion_alimentador              = "ALIMENTADOR";
        $operacion_troncal                  = "TRONCAL";
        $a_resumen_operacion                = array();
        $pie_pagina_resumen_ope             = "";
        $fecha_resumen_ope                  = date_format(date_create($Prog_Fecha),"d/m/Y");
        $encargado_resumen_ope              = "";
        $buses_reten_resumen_ope            = 0;
        $retraso_operacion_resumen_ope      = 0;
        $cambio_bus_resumen_ope             = 0;
        $cambio_piloto_resumen_ope          = 0;
        $km_alimentador_resumen_ope         = 0;
        $km_troncal_resumen_ope             = 0;
        $km_adicional_alimentador           = 0;
        $km_adicional_troncal               = 0;
        $km_perdido_alimentador             = 0;
        $km_perdido_troncal                 = 0;
        $falla_bus_resumen_ope              = 0;
        $falla_comunicaciones_resumen_ope   = 0;
        $falla_telemetria_resumen_ope       = 0;
        $bus_no_disponible_resumen_ope      = 0;
        $bus_bajo_gas_resumen_ope           = 0;
        $bus_no_conforme_resumen_ope        = 0;
        $cambios_status_resumen_ope         = 0;
        $bus_no_confiable_resumen_ope       = 0;
        $varadas_resumen_ope                = 0;
        $inasistencia_total_resumen_ope     = 0;
        $inasistencia_parcial_resumen_ope   = 0;
        $actitud_negativa_resumen_ope       = 0;
        $incump_norma_sistema_resumen_ope   = 0;
        $incump_norma_transito_resumen_ope  = 0;
        $accidente_sl_resumen_ope           = 0;
        $accidente_cl_resumen_ope           = 0;
        $incidentes_resumen_ope             = 0;
        $accidente_transito_resumen_ope     = 0;
        $dano_operacion_resumen_ope         = 0;
        $vandalismo_resumen_ope             = 0;
        $accidente_especial_resumen_ope     = 0;
        $total_inasistencias_resumen_ope    = 0;

        $n_anio = substr($Prog_Fecha,0,4);
        $n_dia  = substr($Prog_Fecha,8,2);
        switch (date("w",strtotime($Prog_Fecha)))
        {
            case 0: $t_dia = "DOMINGO"; break;
            case 1: $t_dia = "LUNES"; break;
            case 2: $t_dia = "MARTES"; break;
            case 3: $t_dia = "MIERCOLES"; break;
            case 4: $t_dia = "JUEVES"; break;
            case 5: $t_dia = "VIERNES"; break;
            case 6: $t_dia = "SABADO"; break;
        }
        switch (substr($Prog_Fecha,5,2))
        {
            case "01": $t_mes = "ENERO"; break;
            case "02": $t_mes = "FEBRERO"; break;
            case "03": $t_mes = "MARZO"; break;
            case "04": $t_mes = "ABRIL"; break;
            case "05": $t_mes = "MAYO"; break;
            case "06": $t_mes = "JUNIO"; break;
            case "07": $t_mes = "JULIO"; break;
            case "08": $t_mes = "AGOSTO"; break;
            case "09": $t_mes = "SETIEMBRE"; break;
            case "10": $t_mes = "OCTUBRE"; break;
            case "11": $t_mes = "NOVIEMBRE"; break;
            case "12": $t_mes = "DICIEMBRE"; break;
        }
        $t_fecha = $t_dia.", ".$n_dia." DE ".$t_mes." DEL ".$n_anio;

        MModel($this->Modulo, 'CRUD');
        $InstanciaAjax= new CRUD();
        $Respuesta=$InstanciaAjax->NombreUsuario();

        foreach ($Respuesta as $row) {
            $encargado_resumen_ope = $row['nombrecorto'];
        }

        MModel($this->Modulo, 'CRUD');
        $InstanciaAjax  = new CRUD();
        $Respuesta      = $InstanciaAjax->buses_reten_hist($Prog_Fecha);

        foreach ($Respuesta as $row) {
            $buses_reten_resumen_ope = $row['busesreten'];
        }

        MModel($this->Modulo, 'CRUD');
        $InstanciaAjax  = new CRUD();
        $Respuesta      = $InstanciaAjax->retraso_operacion_hist($Prog_Fecha);

        foreach ($Respuesta as $row) {
            $retraso_operacion_resumen_ope = $row['retrasooperacion'];
        }

        MModel($this->Modulo, 'CRUD');
        $InstanciaAjax  = new CRUD();
        $Respuesta      = $InstanciaAjax->cambio_bus_hist($Prog_Fecha);
        
        $cambio_bus_resumen_ope = $Respuesta;

        MModel($this->Modulo, 'CRUD');
        $InstanciaAjax  = new CRUD();
        $Respuesta      = $InstanciaAjax->varadas($Prog_Fecha);

        foreach ($Respuesta as $row) {
            if ($row['cantidad']>0){
                $varadas_resumen_ope = $row['cantidad'];
            }
        }

        MModel($this->Modulo, 'CRUD');
        $InstanciaAjax  = new CRUD();
        $Respuesta      = $InstanciaAjax->cambio_piloto_hist($Prog_Fecha);
        
        $cambio_piloto_resumen_ope = $Respuesta;

        MModel($this->Modulo, 'CRUD');
        $InstanciaAjax  = new CRUD();
        $Respuesta      = $InstanciaAjax->km_comercial_hist($Prog_Fecha);

        foreach ($Respuesta as $row) {
            if ($row['km_comercial']>0){
                if($row['Prog_Operacion']==$operacion_alimentador){
                    $km_alimentador_resumen_ope = $row['km_comercial'];
                }
                if($row['Prog_Operacion']==$operacion_troncal){
                    $km_troncal_resumen_ope = $row['km_comercial'];
                }                
            }
        }

        MModel($this->Modulo, 'CRUD');
        $InstanciaAjax  = new CRUD();
        $Respuesta      = $InstanciaAjax->km_adicional_hist($Prog_Fecha, $operacion_alimentador);

        foreach ($Respuesta as $row) {
            if ($row['km_adicional']>0){
                $km_adicional_alimentador = $row['km_adicional'];
            }
        }

        MModel($this->Modulo, 'CRUD');
        $InstanciaAjax  = new CRUD();
        $Respuesta      = $InstanciaAjax->km_adicional_hist($Prog_Fecha, $operacion_troncal);

        foreach ($Respuesta as $row) {
            if ($row['km_adicional']>0){
                $km_adicional_troncal = $row['km_adicional'];
            }
        }

        MModel($this->Modulo, 'CRUD');
        $InstanciaAjax  = new CRUD();
        $Respuesta      = $InstanciaAjax->km_perdido_hist($Prog_Fecha, $operacion_alimentador);

        foreach ($Respuesta as $row) {
            if ($row['km_perdido']>0){
                $km_perdido_alimentador = $row['km_perdido'];
            }
        }

        MModel($this->Modulo, 'CRUD');
        $InstanciaAjax  = new CRUD();
        $Respuesta      = $InstanciaAjax->km_perdido_hist($Prog_Fecha, $operacion_troncal);

        foreach ($Respuesta as $row) {
            if ($row['km_perdido']>0){
                $km_perdido_troncal = $row['km_perdido'];
            }
        }

        MModel($this->Modulo, 'CRUD');
        $InstanciaAjax= new CRUD();
        $Respuesta=$InstanciaAjax->ResumenOperacion($Prog_Fecha);

        foreach ($Respuesta as $row) {
            switch ($row['Nove_TipoNovedad']) {
                case 'FALLA_BUS'                : $falla_bus_resumen_ope                = $row['cantidad'];     break;
                case 'FALLA_COMUNICACIONES'     : $falla_comunicaciones_resumen_ope     = $row['cantidad'];     break;
                case 'FALLA_TELEMETRIA'         : $falla_telemetria_resumen_ope         = $row['cantidad'];     break;
                case 'BUS_NO_DISPONIBLE'        : $bus_no_disponible_resumen_ope        = $row['cantidad'];     break;
                case 'BUS_CON_BAJO_GAS'         : $bus_bajo_gas_resumen_ope             = $row['cantidad'];     break;
                case 'BUS_NO_CONFORME'          : $bus_no_conforme_resumen_ope          = $row['cantidad'];     break;
                case 'CAMBIO_POR_STATUS'        : $cambios_status_resumen_ope           = $row['cantidad'];     break;
                case 'BUS_NO_CONFIABLE'         : $bus_no_confiable_resumen_ope         = $row['cantidad'];     break;

                case 'ACCIDENTE_TRANSITO'       : $accidente_transito_resumen_ope       = $row['cantidad'];     break;
                case 'DAÑO_EN_OPERACION'        : $dano_operacion_resumen_ope           = $row['cantidad'];     break;
                case 'INCIDENTE'                : $incidentes_resumen_ope               = $row['cantidad'];     break;
                case 'VANDALISMO'               : $vandalismo_resumen_ope               = $row['cantidad'];     break;
                case 'ACCIDENTE_ESPECIAL'       : $accidente_especial_resumen_ope       = $row['cantidad'];     break;

                case 'INASISTENCIA_TOTAL'       : $inasistencia_total_resumen_ope       = $row['cantidad'];     break;
                case 'INASISTENCIA_PARCIAL'     : $inasistencia_parcial_resumen_ope     = $row['cantidad'];     break;
                case 'ACTITUD_NEGATIVA'         : $actitud_negativa_resumen_ope         = $row['cantidad'];     break;
                case 'INCUMP_NORMA_SISTEMA'     : $incump_norma_sistema_resumen_ope     = $row['cantidad'];     break;
                case 'INCUMP_NORMA_TRANSITO'    : $incump_norma_transito_resumen_ope    = $row['cantidad'];     break;
                default: ;
            }
        }

        $total_inasistencias_resumen_ope = $inasistencia_parcial_resumen_ope + $inasistencia_total_resumen_ope;

        $html = '   <div class="modal-body">
                        <div class="row align-items-end mb-3 border-bottom border-muted">
                            <div class="col-lg-3">
                                <img src="Module/ControlFacilitador/View/Img/logo23.JPG" class="my-logo-modal-body" alt="">
                            </div>
                            <div class="col-lg-9">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <h4 class="modal-body-title_resumen_troncal" id="modal-body-title_resumen_troncal">RESUMEN DE OPERACION DIARIA</h4>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <h6 class="modal-body-subtitle_resumen_troncal" id="modal-body-subtitle_resumen_troncal">FECHA  :&nbsp&nbsp'.$t_fecha.'</h6> 
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row align-items-end mb-0 pt-3 pl-5 pr-5">
                            <div class="col-lg-6 ">
                                <div class="form-group">
                                    <span class=" text-secondary">KM. COMERCIAL</span>
                                    <span class=" text-secondary">ALIMENTADOR </span>
                                    <br>
                                    <h1 class=" text-secondary font-weight-bold">'.number_format($km_alimentador_resumen_ope,2,'.',' ').'</h1> 
                                </div>
                            </div>
                            <div class="col-lg-6 border-left border-muted">
                                <div class="form-group">
                                    <span class=" text-secondary">KM. COMERCIAL</span>
                                    <span class=" text-secondary">TRONCAL </span>
                                    <br>
                                    <h1 class=" text-secondary font-weight-bold">'.number_format($km_troncal_resumen_ope,2,'.',' ').'</h1>
                                </div> 
                            </div>
                        </div>
                        
                        <div class="row align-items-end mb-0 pb-4 pl-5 pr-5  border-bottom border-muted">
                            <div class="col-lg-3  ">
                                <div class="form-group">
                                    <span class=" text-secondary">KM. ADICIONAL</span>
                                    <br>
                                    <h4 class=" text-secondary font-weight-bold">'.number_format($km_adicional_alimentador,2,'.',' ').'</h4> 
                                </div>
                            </div><div class="col-lg-3  ">
                                <div class="form-group">
                                    <span class=" text-secondary">KM. PERDIDO</span>
                                    <br>
                                    <h4 class=" text-secondary font-weight-bold">'.number_format($km_perdido_alimentador,2,'.',' ').'</h4> 
                                </div>
                            </div>
                            <div class="col-lg-3 border-left border-muted">
                                <div class="form-group">
                                    <span class=" text-secondary">KM. ADICIONAL</span>
                                    <br>
                                    <h4 class=" text-secondary font-weight-bold">'.number_format($km_adicional_troncal,2,'.',' ').'</h4>   
                                </div> 
                            </div><div class="col-lg-3">
                                <div class="form-group">
                                    <span class=" text-secondary">KM. PERDIDO</span>
                                    <br>
                                    <h4 class=" text-secondary font-weight-bold">'.number_format($km_perdido_troncal,2,'.',' ').'</h4>   
                                </div> 
                            </div>
                        </div>

                        <div class="row align-items-end pt-3 pb-3 pl-5 pr-5 border-bottom border-muted">
                            <div class="col-lg-3 ">
                                <div class="form-group mb-0">
                                    <span class=" text-secondary">Cambio Bus</span>
                                    <br>
                                    <h4 class=" text-secondary font-weight-bold">'.$cambio_bus_resumen_ope.'</h4> 
                                </div>
                            </div><div class="col-lg-3  ">
                                <div class="form-group mb-0">
                                    <span class=" text-secondary">Cambio Piloto</span>
                                    <br>
                                    <h4 class=" text-secondary font-weight-bold">'.$cambio_piloto_resumen_ope.'</h4> 
                                </div>
                            </div>
                            
                            <div class="col-lg-3">
                                <div class="form-group mb-0">
                                    <span class=" text-secondary">Total Inasistencias</span>
                                    <br>
                                    <h4 class=" text-secondary font-weight-bold">'.$total_inasistencias_resumen_ope.'</h4>   
                                </div> 
                            </div><div class="col-lg-3">
                                <div class="form-group mb-0">
                                    <span class=" text-secondary">Varadas</span>
                                    <br>
                                    <h4 class=" text-secondary font-weight-bold">'.$varadas_resumen_ope.'</h4>   
                                </div> 
                            </div>
                        </div>

                        <div class="row pt-3">
                            <div class="col-lg-4">
                                <div class="form-row align-items-end">
                                    <div class="col-lg-10">
                                        <p class="form-control form-control-sm bg-success text-white">FALLAS DE BUS</p>
                                    </div>
                                    <div class="col-lg-2">
                                        <p class="form-control form-control-sm font-weight-bold">'.$falla_bus_resumen_ope.'</p>
                                    </div>
                                </div>
                                <div class="form-row align-items-end">
                                    <div class="col-lg-10">
                                        <p class="form-control form-control-sm bg-success text-white">BUSES RETEN</p>
                                    </div>
                                    <div class="col-lg-2">
                                        <p class="form-control form-control-sm font-weight-bold">'.$buses_reten_resumen_ope.'</p>
                                    </div>
                                </div>
                                <div class="form-row align-items-end">
                                    <div class="col-lg-10">
                                        <p class="form-control form-control-sm bg-success text-white">FALLA COMUNICACIONES</p>
                                    </div>
                                    <div class="col-lg-2">
                                        <p class="form-control form-control-sm font-weight-bold">'.$falla_comunicaciones_resumen_ope.'</p>
                                    </div>
                                </div>
                                <div class="form-row align-items-end">
                                    <div class="col-lg-10">
                                        <p class="form-control form-control-sm bg-success text-white">FALLA TELEMETRIA</p>
                                    </div>
                                    <div class="col-lg-2">
                                        <p class="form-control form-control-sm font-weight-bold">'.$falla_telemetria_resumen_ope.'</p>
                                    </div>
                                </div>
                                <div class="form-row align-items-end">
                                    <div class="col-lg-10">
                                        <p class="form-control form-control-sm bg-success text-white">BUS NO DISPONIBLE</p>
                                    </div>
                                    <div class="col-lg-2">
                                        <p class="form-control form-control-sm font-weight-bold">'.$bus_no_disponible_resumen_ope.'</p>
                                    </div>
                                </div>
                                <div class="form-row align-items-end">
                                    <div class="col-lg-10">
                                        <p class="form-control form-control-sm bg-success text-white">BUS BAJO GAS</p>
                                    </div>
                                    <div class="col-lg-2">
                                        <p class="form-control form-control-sm font-weight-bold">'.$bus_bajo_gas_resumen_ope.'</p>
                                    </div>
                                </div>
                                <div class="form-row align-items-end">
                                    <div class="col-lg-10">
                                        <p class="form-control form-control-sm bg-success text-white">BUS NO CONFORME</p>
                                    </div>
                                    <div class="col-lg-2">
                                        <p class="form-control form-control-sm font-weight-bold">'.$bus_no_conforme_resumen_ope.'</p>
                                    </div>
                                </div>
                                <div class="form-row align-items-end">
                                    <div class="col-lg-10">
                                        <p class="form-control form-control-sm bg-success text-white">CAMBIOS POR STATUS</p>
                                    </div>
                                    <div class="col-lg-2">
                                        <p class="form-control form-control-sm font-weight-bold">'.$cambios_status_resumen_ope.'</p>
                                    </div>
                                </div>
                                <div class="form-row align-items-end">
                                    <div class="col-lg-10">
                                        <p class="form-control form-control-sm bg-success text-white">BUS NO CONFIABLE</p>
                                    </div>
                                    <div class="col-lg-2">
                                        <p class="form-control form-control-sm font-weight-bold">'.$bus_no_confiable_resumen_ope.'</p>
                                    </div>
                                </div>

                            </div>
                            <div class="col-lg-4">
                                <div class="form-row align-items-end">
                                    <div class="col-lg-10">
                                        <p class="form-control form-control-sm bg-secondary text-white">ACCIDENTE TRANSITO</p>
                                    </div>
                                    <div class="col-lg-2">
                                        <p class="form-control form-control-sm font-weight-bold">'.$accidente_transito_resumen_ope.'</p>
                                    </div>
                                </div>
                                <div class="form-row align-items-end">
                                    <div class="col-lg-10">
                                        <p class="form-control form-control-sm bg-secondary text-white">DAÑO EN OPERACION</p>
                                    </div>
                                    <div class="col-lg-2">
                                        <p class="form-control form-control-sm font-weight-bold">'.$dano_operacion_resumen_ope.'</p>
                                    </div>
                                </div>
                                <div class="form-row align-items-end">
                                    <div class="col-lg-10">
                                        <p class="form-control form-control-sm bg-secondary text-white">RETRASO</p>
                                    </div>
                                    <div class="col-lg-2">
                                        <p class="form-control form-control-sm font-weight-bold">'.$retraso_operacion_resumen_ope.'</p>
                                    </div>
                                </div>
                                <div class="form-row align-items-end">
                                    <div class="col-lg-10">
                                        <p class="form-control form-control-sm bg-secondary text-white">INCIDENTE</p>
                                    </div>
                                    <div class="col-lg-2">
                                        <p class="form-control form-control-sm font-weight-bold">'.$incidentes_resumen_ope.'</p>
                                    </div>
                                </div>
                                <div class="form-row align-items-end">
                                    <div class="col-lg-10">
                                        <p class="form-control form-control-sm bg-secondary text-white">VANDALISMO</p>
                                    </div>
                                    <div class="col-lg-2">
                                        <p class="form-control form-control-sm font-weight-bold">'.$vandalismo_resumen_ope.'</p>
                                    </div>
                                </div>
                                <div class="form-row align-items-end">
                                    <div class="col-lg-10">
                                        <p class="form-control form-control-sm bg-secondary text-white">ACCIDENTE ESPECIAL</p>
                                    </div>
                                    <div class="col-lg-2">
                                        <p class="form-control form-control-sm font-weight-bold">'.$accidente_especial_resumen_ope.'</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-row align-items-end">
                                    <div class="col-lg-10">
                                        <p class="form-control form-control-sm bg-warning text-dark">INASISTENCIA TOTAL</p>
                                    </div>
                                    <div class="col-lg-2">
                                        <p class="form-control form-control-sm font-weight-bold">'.$inasistencia_total_resumen_ope.'</p>
                                    </div>
                                </div>
                                <div class="form-row align-items-end">
                                    <div class="col-lg-10">
                                        <p class="form-control form-control-sm bg-warning text-dark">INASISTENCIA PARCIAL</p>
                                    </div>
                                    <div class="col-lg-2">
                                        <p class="form-control form-control-sm font-weight-bold">'.$inasistencia_parcial_resumen_ope.'</p>
                                    </div>
                                </div>
                                <div class="form-row align-items-end">
                                    <div class="col-lg-10">
                                        <p class="form-control form-control-sm bg-warning text-dark">ACTITUD NEGATIVA</p>
                                    </div>
                                    <div class="col-lg-2">
                                        <p class="form-control form-control-sm font-weight-bold">'.$actitud_negativa_resumen_ope.'</p>
                                    </div>
                                </div>
                                <div class="form-row align-items-end">
                                    <div class="col-lg-10">
                                        <p class="form-control form-control-sm bg-warning text-dark">INCUMP.NORMA SISTEMA</p>
                                    </div>
                                    <div class="col-lg-2">
                                        <p class="form-control form-control-sm font-weight-bold">'.$incump_norma_sistema_resumen_ope.'</p>
                                    </div>
                                </div>
                                <div class="form-row align-items-end">
                                    <div class="col-lg-10">
                                        <p class="form-control form-control-sm bg-warning text-dark">INCUMP.NORM. TRANSITO</p>
                                    </div>
                                    <div class="col-lg-2">
                                        <p class="form-control form-control-sm font-weight-bold">'.$incump_norma_transito_resumen_ope.'</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <div class="row align-items-end">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <h6>Generado el:&nbsp&nbsp'.date("d/m/Y H:i").'&nbsp&nbsp Responsable :&nbsp&nbsp'.$encargado_resumen_ope.'</h6>
                                </div> 
                            </div>
                        </div>
                    </div>';
        echo $html;
    }

    public function ListarReporte($ControlFacilitador_Id)
    {
        MModel($this->Modulo, 'CRUD');
        $InstanciaAjax= new CRUD();
        $Respuesta=$InstanciaAjax->ListarReporte($ControlFacilitador_Id);
    }

    public function CambiosControlFacilitador($ControlFacilitador_Id)
    {
        $html = "";
        $Cont = 0;

        MModel($this->Modulo, 'CRUD');
        $InstanciaAjax= new CRUD();
        $Respuesta2=$InstanciaAjax->CambiosControlFacilitador($ControlFacilitador_Id);

        foreach ($Respuesta2 as $row) {
            if ($Cont==0) {
                $html .= '<div class="card border-success mb-3">';
                $html .=    '<div class="card-body card-novedades">
                                <div class="row align-items-end">
                                    <div class="col-lg-4">    
                                        <div class="form-group">
                                            <label for="" class="col-form-label">Nombres y Apellidos</label>
                                            <label for="" class="form-control">' . $row['Prog_NombreColaborador'] . '</label>
                                        </div>            
                                    </div>
                                    <div class="col-lg-2">    
                                        <div class="form-group">
                                            <label for="" class="col-form-label">Tabla</label>
                                            <label for="" class="form-control">' . $row['Prog_Tabla'] . '</label>
                                        </div>            
                                    </div>    
                                    <div class="col-lg-2">    
                                        <div class="form-group">
                                            <label for="" class="col-form-label">Bus</label>
                                            <label for="" class="form-control">' . $row['Prog_Bus'] . '</label>
                                        </div>            
                                    </div>    
                                    <div class="col-lg-2">    
                                        <div class="form-group">
                                            <label for="" class="col-form-label">Servicio</label>
                                            <label for="" class="form-control">' . $row['Prog_Servicio'] . '</label>
                                        </div>            
                                    </div>    
                                    <div class="col-lg-2">    
                                        <div class="form-group">
                                            <label for="" class="col-form-label">H. Origen</label>
                                            <label for="" class="form-control">' . $row['Prog_HoraOrigen'] . '</label>
                                        </div>            
                                    </div>    
                                </div>
                                <div class="row align-items-end">
                                    <div class="col-lg-2">    
                                        <div class="form-group">
                                            <label for="" class="col-form-label">H. Destino</label>
                                            <label for="" class="form-control">' . $row['Prog_HoraDestino'] . '</label>
                                        </div>            
                                    </div>    
                                    <div class="col-lg-2">    
                                        <div class="form-group">
                                            <label for="" class="col-form-label">L. Origen</label>
                                            <label for="" class="form-control">' . $row['Prog_LugarOrigen'] . '</label>
                                        </div>            
                                    </div>    
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label for="" class="col-form-label">L. Destino</label>
                                            <label for="" class="form-control">' . $row['Prog_LugarDestino'] . '</label>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label for="" class="col-form-label">Servicio Bus</label>
                                            <label for="" class="form-control">' . $row['Prog_ServBus'] . '</label>
                                        </div> 
                                    </div>    
                                    <div class="col-lg-3">    
                                        <div class="form-group">
                                            <label for="" class="col-form-label">Tipo de Evento</label>
                                            <label for="" class="form-control">' . $row['Prog_TipoEvento'] . '</label>
                                        </div>            
                                    </div>
                                    <div class="col-lg-1">
                                        <div class="form-group">
                                            <label for="" class="col-form-label">KM.</label>
                                            <label for="" class="form-control">' . $row['Prog_KmXPuntos'] . '</label>
                                        </div>
                                    </div>    
                                </div>   
                                <div class="row align-items-end">
                                    <div class="col-lg-2">    
                                        <div class="form-group">
                                            <label for="" class="col-form-label">Tipo de Tabla</label>
                                            <label for="" class="form-control">' . $row['Prog_TipoTabla'] . '</label>
                                        </div>            
                                    </div>
                                    <div class="col-lg-7">    
                                        <div class="form-group"> 
                                            <label for="" class="col-form-label">Observaciones</label>
                                            <label for="" class="form-control">' . $row['Prog_Observaciones'] . '</label>
                                        </div>            
                                    </div>
                                    <div class="col-lg-3">    
                                        <div class="form-group"> 
                                            <label for="" class="col-form-label">Generado por</label>
                                            <label for="" class="form-control">' . $row['CFaci_UsuarioId'] . '</label>
                                        </div>            
                                    </div>    
                                </div>
                            </div>';
                $html .= '</div>';
                $Cont = 1;
            }
           
            if ($row['CNove_TipoOrigen'] == "CREACION") {
                $html .= '<div class="card mb-3">';
                $html .=    '<div class="card-header">
                                <div class="row align-items-end">
                                    <div class="col-lg-12">    	
                                        <h6 class="card-title">'.$row['CNove_NovedadId'] . " | " . $row['Nove_Novedad'] . " | " . $row['Nove_TipoNovedad'] . " | " . $row['Nove_DetalleNovedad'] . " | Generado por: " . $row['Nove_UsuarioId'] .'</h6>
                                    </div>
                                </div>
                                <div class="row align-items-end">
                                    <div class="col-lg-12">    
                                        <p class="form-text">' . $row['Nove_Descripcion'] . '</p>
                                    </div>    
                                </div>
                            </div>';
                $html .= '</div>';
            }
            if ($row['CNove_TipoOrigen'] == "ASOCIACION") {
                $html .= '<div class="card mb-3">';
                $html .=    '<div class="card-header">
                                <div class="row align-items-end">
                                    <div class="col-lg-12">    	
                                        <h6 class="card-title">'.$row['CNove_NovedadId'] . " | " . $row['Nove_Novedad'] . " | " . $row['Nove_TipoNovedad'] . " | " . $row['Nove_DetalleNovedad'] . " | Generado por: " . $row['Nove_UsuarioId'] .'</h6> 
                                    </div>
                                </div>
                                <div class="row align-items-end">
                                    <div class="col-lg-12">    
                                        <p class="form-text">' . $row['Nove_Descripcion'] . '</p>            
                                    </div>    
                                </div>
                            </div>';
                $html .=   '<div class="card-body">
                                <div class="row align-items-end">
                                    <div class="col-lg-4">    
                                        <div class="form-group">
                                            <label for="" class="col-form-label">Nombres y Apellidos</label>
                                            <label for="" class="form-control">' . $row['Prog_NombreColaborador'] . '</label>
                                        </div>            
                                    </div>
                                    <div class="col-lg-2">    
                                        <div class="form-group">
                                            <label for="" class="col-form-label">Tabla</label>
                                            <label for="" class="form-control">' . $row['Prog_Tabla'] . '</label>
                                        </div>            
                                    </div>    
                                    <div class="col-lg-2">    
                                        <div class="form-group">
                                            <label for="" class="col-form-label">Bus</label>
                                            <label for="" class="form-control">' . $row['Prog_Bus'] . '</label>
                                        </div>            
                                    </div>    
                                    <div class="col-lg-2">    
                                        <div class="form-group">
                                            <label for="" class="col-form-label">Servicio</label>
                                            <label for="" class="form-control">' . $row['Prog_Servicio'] . '</label>
                                        </div>            
                                    </div>    
                                    <div class="col-lg-2">    
                                        <div class="form-group">
                                            <label for="" class="col-form-label">H. Origen</label>
                                            <label for="" class="form-control">' . $row['Prog_HoraOrigen'] . '</label>
                                        </div>            
                                    </div>    
                                </div>
                                <div class="row align-items-end">
                                    <div class="col-lg-2">    
                                        <div class="form-group">
                                            <label for="" class="col-form-label">H. Destino</label>
                                            <label for="" class="form-control">' . $row['Prog_HoraDestino'] . '</label>
                                        </div>            
                                    </div>    
                                    <div class="col-lg-2">    
                                        <div class="form-group">
                                            <label for="" class="col-form-label">L. Origen</label>
                                            <label for="" class="form-control">' . $row['Prog_LugarOrigen'] . '</label>
                                        </div>            
                                    </div>    
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label for="" class="col-form-label">L. Destino</label>
                                            <label for="" class="form-control">' . $row['Prog_LugarDestino'] . '</label>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label for="" class="col-form-label">Servicio Bus</label>
                                            <label for="" class="form-control">' . $row['Prog_ServBus'] . '</label>
                                        </div> 
                                    </div>    
                                    <div class="col-lg-3">    
                                        <div class="form-group">
                                            <label for="" class="col-form-label">Tipo de Evento</label>
                                            <label for="" class="form-control">' . $row['Prog_TipoEvento'] . '</label>
                                        </div>            
                                    </div>
                                    <div class="col-lg-1">
                                        <div class="form-group">
                                            <label for="" class="col-form-label">KM.</label>
                                            <label for="" class="form-control">' . $row['Prog_KmXPuntos'] . '</label>
                                        </div>
                                    </div>    
                                </div>   
                                <div class="row align-items-end">
                                    <div class="col-lg-2">    
                                        <div class="form-group">
                                            <label for="" class="col-form-label">Tipo de Tabla</label>
                                            <label for="" class="form-control">' . $row['Prog_TipoTabla'] . '</label>
                                        </div>            
                                    </div>
                                    <div class="col-lg-7">    
                                        <div class="form-group"> 
                                            <label for="" class="col-form-label">Observaciones</label>
                                            <label for="" class="form-control">' . $row['Prog_Observaciones'] . '</label>
                                        </div>            
                                    </div>
                                    <div class="col-lg-3">    
                                        <div class="form-group"> 
                                            <label for="" class="col-form-label">Generado por</label>
                                            <label for="" class="form-control">' . $row['CFaci_UsuarioId'] . '</label>
                                        </div>            
                                    </div>    
                                </div>
                            </div>';
                $html .= '</div>';
            }
        }
        echo $html;
    }

    public function cambios_control_facilitador_hist($ControlFacilitador_Id)
    {
        $html = "";
        $Cont = 0;

        MModel($this->Modulo, 'CRUD');
        $InstanciaAjax= new CRUD();
        $Respuesta2=$InstanciaAjax->cambios_control_facilitador_hist($ControlFacilitador_Id);

        foreach ($Respuesta2 as $row) {
            if ($Cont==0) {
                $html .= '<div class="card border-success mb-3">';
                $html .=    '<div class="card-body card-novedades">
                                <div class="row align-items-end">
                                    <div class="col-lg-4">    
                                        <div class="form-group">
                                            <label for="" class="col-form-label">Nombres y Apellidos</label>
                                            <label for="" class="form-control">' . $row['Prog_NombreColaborador'] . '</label>
                                        </div>            
                                    </div>
                                    <div class="col-lg-2">    
                                        <div class="form-group">
                                            <label for="" class="col-form-label">Tabla</label>
                                            <label for="" class="form-control">' . $row['Prog_Tabla'] . '</label>
                                        </div>            
                                    </div>    
                                    <div class="col-lg-2">    
                                        <div class="form-group">
                                            <label for="" class="col-form-label">Bus</label>
                                            <label for="" class="form-control">' . $row['Prog_Bus'] . '</label>
                                        </div>            
                                    </div>    
                                    <div class="col-lg-2">    
                                        <div class="form-group">
                                            <label for="" class="col-form-label">Servicio</label>
                                            <label for="" class="form-control">' . $row['Prog_Servicio'] . '</label>
                                        </div>            
                                    </div>    
                                    <div class="col-lg-2">    
                                        <div class="form-group">
                                            <label for="" class="col-form-label">H. Origen</label>
                                            <label for="" class="form-control">' . $row['Prog_HoraOrigen'] . '</label>
                                        </div>            
                                    </div>    
                                </div>
                                <div class="row align-items-end">
                                    <div class="col-lg-2">    
                                        <div class="form-group">
                                            <label for="" class="col-form-label">H. Destino</label>
                                            <label for="" class="form-control">' . $row['Prog_HoraDestino'] . '</label>
                                        </div>            
                                    </div>    
                                    <div class="col-lg-2">    
                                        <div class="form-group">
                                            <label for="" class="col-form-label">L. Origen</label>
                                            <label for="" class="form-control">' . $row['Prog_LugarOrigen'] . '</label>
                                        </div>            
                                    </div>    
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label for="" class="col-form-label">L. Destino</label>
                                            <label for="" class="form-control">' . $row['Prog_LugarDestino'] . '</label>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label for="" class="col-form-label">Servicio Bus</label>
                                            <label for="" class="form-control">' . $row['Prog_ServBus'] . '</label>
                                        </div> 
                                    </div>    
                                    <div class="col-lg-3">    
                                        <div class="form-group">
                                            <label for="" class="col-form-label">Tipo de Evento</label>
                                            <label for="" class="form-control">' . $row['Prog_TipoEvento'] . '</label>
                                        </div>            
                                    </div>
                                    <div class="col-lg-1">
                                        <div class="form-group">
                                            <label for="" class="col-form-label">KM.</label>
                                            <label for="" class="form-control">' . $row['Prog_KmXPuntos'] . '</label>
                                        </div>
                                    </div>    
                                </div>   
                                <div class="row align-items-end">
                                    <div class="col-lg-2">    
                                        <div class="form-group">
                                            <label for="" class="col-form-label">Tipo de Tabla</label>
                                            <label for="" class="form-control">' . $row['Prog_TipoTabla'] . '</label>
                                        </div>            
                                    </div>
                                    <div class="col-lg-7">    
                                        <div class="form-group"> 
                                            <label for="" class="col-form-label">Observaciones</label>
                                            <label for="" class="form-control">' . $row['Prog_Observaciones'] . '</label>
                                        </div>            
                                    </div>
                                    <div class="col-lg-3">    
                                        <div class="form-group"> 
                                            <label for="" class="col-form-label">Generado por</label>
                                            <label for="" class="form-control">' . $row['CFaci_UsuarioId'] . '</label>
                                        </div>            
                                    </div>    
                                </div>
                            </div>';
                $html .= '</div>';
                $Cont = 1;
            }
           
            if ($row['CNove_TipoOrigen'] == "CREACION") {
                $html .= '<div class="card mb-3">';
                $html .=    '<div class="card-header">
                                <div class="row align-items-end">
                                    <div class="col-lg-12">    	
                                        <h6 class="card-title">'.$row['CNove_NovedadId'] . " | " . $row['Nove_Novedad'] . " | " . $row['Nove_TipoNovedad'] . " | " . $row['Nove_DetalleNovedad'] . " | Generado por: " . $row['Nove_UsuarioId'] .'</h6>
                                    </div>
                                </div>
                                <div class="row align-items-end">
                                    <div class="col-lg-12">    
                                        <p class="form-text">' . $row['Nove_Descripcion'] . '</p>
                                    </div>    
                                </div>
                            </div>';
                $html .= '</div>';
            }
            if ($row['CNove_TipoOrigen'] == "ASOCIACION") {
                $html .= '<div class="card mb-3">';
                $html .=    '<div class="card-header">
                                <div class="row align-items-end">
                                    <div class="col-lg-12">    	
                                        <h6 class="card-title">'.$row['CNove_NovedadId'] . " | " . $row['Nove_Novedad'] . " | " . $row['Nove_TipoNovedad'] . " | " . $row['Nove_DetalleNovedad'] . " | Generado por: " . $row['Nove_UsuarioId'] .'</h6> 
                                    </div>
                                </div>
                                <div class="row align-items-end">
                                    <div class="col-lg-12">    
                                        <p class="form-text">' . $row['Nove_Descripcion'] . '</p>            
                                    </div>    
                                </div>
                            </div>';
                $html .=   '<div class="card-body">
                                <div class="row align-items-end">
                                    <div class="col-lg-4">    
                                        <div class="form-group">
                                            <label for="" class="col-form-label">Nombres y Apellidos</label>
                                            <label for="" class="form-control">' . $row['Prog_NombreColaborador'] . '</label>
                                        </div>            
                                    </div>
                                    <div class="col-lg-2">    
                                        <div class="form-group">
                                            <label for="" class="col-form-label">Tabla</label>
                                            <label for="" class="form-control">' . $row['Prog_Tabla'] . '</label>
                                        </div>            
                                    </div>    
                                    <div class="col-lg-2">    
                                        <div class="form-group">
                                            <label for="" class="col-form-label">Bus</label>
                                            <label for="" class="form-control">' . $row['Prog_Bus'] . '</label>
                                        </div>            
                                    </div>    
                                    <div class="col-lg-2">    
                                        <div class="form-group">
                                            <label for="" class="col-form-label">Servicio</label>
                                            <label for="" class="form-control">' . $row['Prog_Servicio'] . '</label>
                                        </div>            
                                    </div>    
                                    <div class="col-lg-2">    
                                        <div class="form-group">
                                            <label for="" class="col-form-label">H. Origen</label>
                                            <label for="" class="form-control">' . $row['Prog_HoraOrigen'] . '</label>
                                        </div>            
                                    </div>    
                                </div>
                                <div class="row align-items-end">
                                    <div class="col-lg-2">    
                                        <div class="form-group">
                                            <label for="" class="col-form-label">H. Destino</label>
                                            <label for="" class="form-control">' . $row['Prog_HoraDestino'] . '</label>
                                        </div>            
                                    </div>    
                                    <div class="col-lg-2">    
                                        <div class="form-group">
                                            <label for="" class="col-form-label">L. Origen</label>
                                            <label for="" class="form-control">' . $row['Prog_LugarOrigen'] . '</label>
                                        </div>            
                                    </div>    
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label for="" class="col-form-label">L. Destino</label>
                                            <label for="" class="form-control">' . $row['Prog_LugarDestino'] . '</label>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label for="" class="col-form-label">Servicio Bus</label>
                                            <label for="" class="form-control">' . $row['Prog_ServBus'] . '</label>
                                        </div> 
                                    </div>    
                                    <div class="col-lg-3">    
                                        <div class="form-group">
                                            <label for="" class="col-form-label">Tipo de Evento</label>
                                            <label for="" class="form-control">' . $row['Prog_TipoEvento'] . '</label>
                                        </div>            
                                    </div>
                                    <div class="col-lg-1">
                                        <div class="form-group">
                                            <label for="" class="col-form-label">KM.</label>
                                            <label for="" class="form-control">' . $row['Prog_KmXPuntos'] . '</label>
                                        </div>
                                    </div>    
                                </div>   
                                <div class="row align-items-end">
                                    <div class="col-lg-2">    
                                        <div class="form-group">
                                            <label for="" class="col-form-label">Tipo de Tabla</label>
                                            <label for="" class="form-control">' . $row['Prog_TipoTabla'] . '</label>
                                        </div>            
                                    </div>
                                    <div class="col-lg-7">    
                                        <div class="form-group"> 
                                            <label for="" class="col-form-label">Observaciones</label>
                                            <label for="" class="form-control">' . $row['Prog_Observaciones'] . '</label>
                                        </div>            
                                    </div>
                                    <div class="col-lg-3">    
                                        <div class="form-group"> 
                                            <label for="" class="col-form-label">Generado por</label>
                                            <label for="" class="form-control">' . $row['CFaci_UsuarioId'] . '</label>
                                        </div>            
                                    </div>    
                                </div>
                            </div>';
                $html .= '</div>';
            }
        }
        echo $html;
    }

    public function CerrarReporte($ControlFacilitador_Id)
	{
        $Programacion_Id = "";
        MModel($this->Modulo, 'CRUD');
        $InstanciaAjax= new CRUD();
        $TablaBD = 'OPE_ControlFacilitador';
        $CampoBD = 'ControlFacilitador_Id';
        $Respuesta=$InstanciaAjax->BuscarDataBD($TablaBD,$CampoBD,$ControlFacilitador_Id);

        foreach($Respuesta as $row){
            $Programacion_Id = $row['Programacion_Id'];
        }

        MModel($this->Modulo, 'CRUD');
        $InstanciaAjax= new CRUD();
        $Respuesta=$InstanciaAjax->CerrarReporte($Programacion_Id);

	}

    public function horas_trabajadas($operacion, $fecha, $codigo, $hora)
    {
        $rpta_horas_trabajadas = "";
        
        MModel($this->Modulo, 'CRUD');
        $InstanciaAjax  = new CRUD();
        $Respuesta      = $InstanciaAjax->horas_trabajadas($operacion, $fecha, $codigo, $hora);

        foreach ($Respuesta as $row) {
            $rpta_horas_trabajadas = $row['horas_trabajadas'];
        }
        echo $rpta_horas_trabajadas;
    }

    //::::::::::::::::::::::::::::::::::::::::::::::: NOVEDAD CARGA :::::::::::::::::::::::::::::::::::::::::://
    
    public function ValidarNovedad($Prog_Fecha, $Prog_Operacion)
    {
        MModel($this->Modulo, 'CRUD');
        $InstanciaAjax= new CRUD();
        $Respuesta=$InstanciaAjax->ValidarNovedad($Prog_Fecha, $Prog_Operacion);
        $ValidaEvento="";

        if ($Respuesta==false) {
            $ValidaEvento="NO NOVEDADES";
        } else {
            $ValidaEvento="SI NOVEDADES";
        }
        echo $ValidaEvento;
    }

    public function ValidarNovedad_ControlFacilitador($OPE_NovedadId, $Novedad_Id)
    {
        $ValidaNovedad="";
        $TablaBD = 'OPE_Novedad';
        $CampoBD = 'OPE_NovedadId';
        MModel($this->Modulo, 'CRUD');
        $InstanciaAjax= new CRUD();
        $Respuesta=$InstanciaAjax->BuscarDataBD($TablaBD,$CampoBD,$OPE_NovedadId);
        foreach($Respuesta as $row){
            $Nove_Version = $row['Nove_Version'];
        }

        MModel($this->Modulo, 'CRUD');
        $InstanciaAjax= new CRUD();
        $Respuesta=$InstanciaAjax->ValidarNovedad_ControlFacilitador($OPE_NovedadId, $Novedad_Id, $Nove_Version);

        foreach($Respuesta as $row){
            $ValidaNovedad .= $row['ControlFacilitador_Id'].' ';
        }

        echo $ValidaNovedad;
    }

    public function ListarNovedad($OPE_NovedadId)
    {
        MModel($this->Modulo, 'CRUD');
        $InstanciaAjax= new CRUD();
        $Respuesta2=$InstanciaAjax->ListarNovedad($OPE_NovedadId);
    }

    public function SelectNovedad($Prog_Fecha, $Prog_Operacion, $ControlFacilitador_Id)
    {
        $Programacion_Id = 0;

        if($ControlFacilitador_Id>0){
            $TablaBD = 'OPE_ControlFacilitador';
            $CampoBD = 'ControlFacilitador_Id';

            MModel($this->Modulo, 'CRUD');
            $InstanciaAjax= new CRUD();
            $Respuesta=$InstanciaAjax->BuscarDataBD($TablaBD,$CampoBD,$ControlFacilitador_Id);
            foreach ($Respuesta as $row) {
                $Programacion_Id = $row['Programacion_Id'];
            }
        }

        MModel($this->Modulo, 'CRUD');
        $InstanciaAjax= new CRUD();
        $Respuesta=$InstanciaAjax->SelectNovedad($Prog_Fecha, $Prog_Operacion,$Programacion_Id);
            
        $html = '<option value="">Seleccione una opcion</option>';

        foreach ($Respuesta as $row) {
            $html .= '<option value="'.$row['OPE_NovedadId'].'"> '.$row['Nove_Fecha'].' | '.$row['Nove_TipoNovedad'].' | '.$row['Nove_DetalleNovedad'].' | Nom: '.$row['Nove_NombreCorto'].' | Bus: '.$row['Nove_Bus'].' | Est: '.$row['Nove_Estado'].'</option>';
        }
        echo $html;
    }
    
    public function EditarNovedadCarga($OPE_NovedadId,$Novedad_Id,$Nove_Novedad,$Nove_TipoNovedad,$Nove_DetalleNovedad,$Nove_Descripcion,$Nove_LugarExacto,$Nove_HoraInicio,$Nove_HoraFin)
    {
        // Buscar los datos de la novedad mediante el campo OPE_NovedadId
        $TablaBD = 'OPE_Novedad';
        $CampoBD = 'OPE_NovedadId';
        MModel($this->Modulo, 'CRUD');
        $InstanciaAjax= new CRUD();
        $Respuesta=$InstanciaAjax->BuscarDataBD($TablaBD,$CampoBD,$OPE_NovedadId);

        // Crear variables para los campos que no se editan y asignarles los valores de la consulta a la BD en Buscar
        foreach($Respuesta as $row){
            $OPE_NovedadId = $row['OPE_NovedadId'];
            $Novedad_IdEDT = $row['Novedad_Id'];
            $Nove_NovedadEDT = $row['Nove_Novedad'];
            $Nove_TipoNovedadEDT = $row['Nove_TipoNovedad'];
            $Nove_DetalleNovedadEDT = $row['Nove_DetalleNovedad'];
            $Nove_DescripcionEDT = $row['Nove_Descripcion'];
            $Nove_LugarExactoEDT = $row['Nove_LugarExacto'];
            $Nove_HoraInicioEDT = $row['Nove_HoraInicio'];
            $Nove_HoraFinEDT = $row['Nove_HoraFin'];
            $Nove_VersionEDT = $row['Nove_Version'];
            $Nove_VersionACT = $Nove_VersionEDT + 1;
            $Nove_ProgramacionId = $row['Nove_ProgramacionId'];
            $Nove_Operacion = $row['Nove_Operacion'];
            $Nove_FechaOperacion = $row['Nove_FechaOperacion'];
            $Nove_Dni = $row['Nove_Dni'];
            $Nove_CodigoColaborador = $row['Nove_CodigoColaborador'];
            $Nove_NombreColaborador = $row['Nove_NombreColaborador'];
            $Nove_Tabla = $row['Nove_Tabla'];
            $Nove_HoraOrigen = $row['Nove_HoraOrigen'];
            $Nove_HoraDestino = $row['Nove_HoraDestino'];
            $Nove_Servicio = $row['Nove_Servicio'];
            $Nove_Bus = $row['Nove_Bus'];
            $Nove_LugarOrigen = $row['Nove_LugarOrigen'];
            $Nove_LugarDestino = $row['Nove_LugarDestino'];
            $Nove_Estado = $row['Nove_Estado'];
            $Nove_UsuarioId = $row['Nove_UsuarioId'];
            $Nove_ProcesoOrigen = $row['Nove_ProcesoOrigen'];
            $Nove_Fecha = $row['Nove_Fecha'];
            $Nove_CFaRgId = $row['Nove_CFaRgId'];
            $Nove_UsuarioId_Edicion = $row['Nove_UsuarioId_Edicion'];
            $Nove_FechaEdicion = $row['Nove_FechaEdicion'];
            $Nove_UsuarioId_Eliminar = $row['Nove_UsuarioId_Eliminar'];
            $Nove_FechaEliminar = $row['Nove_FechaEliminar'];
            $Nove_UsuarioId_Cerrar = $row['Nove_UsuarioId_Cerrar'];
            $Nove_FechaCerrar = $row['Nove_FechaCerrar'];
            $Nove_TipoOrigen = $row['Nove_TipoOrigen'];
        }

        // Grabar los datos editados y no editados en un nuevo registro donde el campo Nove_OrigenId sera igual a OPE_Novedad Id
        MModel($this->Modulo, 'CRUD');
        $InstanciaAjax= new CRUD();
        $Respuesta=$InstanciaAjax->CrearNovedadCargaEDT($OPE_NovedadId,$Novedad_IdEDT,$Nove_NovedadEDT,$Nove_TipoNovedadEDT,$Nove_DetalleNovedadEDT,$Nove_DescripcionEDT,$Nove_LugarExactoEDT,$Nove_HoraInicioEDT,$Nove_HoraFinEDT,$Nove_ProgramacionId,$Nove_Operacion,$Nove_FechaOperacion,$Nove_Dni,$Nove_CodigoColaborador,$Nove_NombreColaborador,$Nove_Tabla,$Nove_HoraOrigen,$Nove_HoraDestino,$Nove_Servicio,$Nove_Bus,$Nove_LugarOrigen,$Nove_LugarDestino,$Nove_Estado,$Nove_UsuarioId,$Nove_ProcesoOrigen,$Nove_Fecha,$Nove_CFaRgId,$Nove_UsuarioId_Edicion,$Nove_FechaEdicion,$Nove_UsuarioId_Eliminar,$Nove_FechaEliminar,$Nove_UsuarioId_Cerrar,$Nove_FechaCerrar,$Nove_VersionEDT,$Nove_TipoOrigen); 

        // Actulizar el registro OPE_NovedadId en los campos editados de la novedad
        MModel($this->Modulo, 'CRUD');
        $InstanciaAjax= new CRUD();
        $Respuesta=$InstanciaAjax->EditarNovedadCarga($OPE_NovedadId,$Novedad_Id,$Nove_Novedad,$Nove_TipoNovedad,$Nove_DetalleNovedad,$Nove_Descripcion,$Nove_LugarExacto,$Nove_HoraInicio,$Nove_HoraFin,$Nove_VersionACT);
    }

    public function AbrirNovedadCarga($OPE_NovedadId)
    {
        // Se abrie el registro OPE_NovedadId
        MModel($this->Modulo, 'CRUD');
        $InstanciaAjax= new CRUD();
        $Respuesta=$InstanciaAjax->AbrirNovedadCarga($OPE_NovedadId);
    }

    public function CerrarNovedadCarga($OPE_NovedadId)
    {
        MModel($this->Modulo, 'CRUD');
        $InstanciaAjax = new CRUD;
        $Respuesta=$InstanciaAjax->CerrarNovedadCarga($OPE_NovedadId);

    }

    public function BuscarDescripcionNovedad($Prog_Operacion, $Ttabla_Tipo)
    {
        MModel($this->Modulo, 'CRUD');
        $InstanciaAjax= new CRUD();
        $Respuesta=$InstanciaAjax->SelectTipos($Prog_Operacion, $Ttabla_Tipo);

        $Descripcion = '';

        foreach ($Respuesta as $row) {
            $Descripcion .= $row['Detalle'];
        }
        echo $Descripcion;
    }

    public function HistorialNovedadCarga($Novedad_Id)
    {
        $html = "";

        MModel($this->Modulo, 'CRUD');
        $InstanciaAjax= new CRUD();
        $Respuesta=$InstanciaAjax->HistorialNovedadCarga($Novedad_Id);

        foreach($Respuesta as $row){
            $html .='<div class="card border-success mb-3">
                        <div class="card-header">
                            <div class="row align-items-end">
                                <div class="col-lg-2">    
                                      <div class="form-group">
                                          <label for="" class="col-form-label">ID</label>
                                        <label for="" class="form-control">' . $row['OPE_NovedadId'] . '</label>
                                      </div>            
                                  </div>
                                <div class="col-lg-3">    
                                      <div class="form-group">
                                          <label for="" class="col-form-label">Fecha</label>
                                        <label for="" class="form-control">' . $row['Nove_Fecha'] . '</label>
                                      </div>            
                                  </div>    
                                <div class="col-lg-3">    
                                      <div class="form-group">
                                          <label for="" class="col-form-label">Usuario</label>
                                        <label for="" class="form-control">' . $row['Nove_UsuarioId'] . '</label>
                                      </div>            
                                  </div>    
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row align-items-end">
                                <div class="col-lg-3">    
                                    <div class="form-group">
                                        <label for="" class="col-form-label">Novedad ID</label>
                                        <label for="" class="form-control">' . $row['Novedad_Id'] . '</label>
                                    </div>            
                                </div>    
                                <div class="col-lg-3">    
                                      <div class="form-group">
                                          <label for="" class="col-form-label">Novedad</label>
                                        <label for="" class="form-control">' . $row['Nove_Novedad'] . '</h3></label>
                                      </div>            
                                  </div>
                                <div class="col-lg-3">    
                                      <div class="form-group">
                                          <label for="" class="col-form-label">Tipo Novedad</label>
                                        <label for="" class="form-control">' . $row['Nove_TipoNovedad'] . '</label>
                                      </div>            
                                  </div>    
                                <div class="col-lg-3">    
                                    <div class="form-group">
                                        <label for="" class="col-form-label">Detalle Novedad</label>
                                        <label for="" class="form-control">' . $row['Nove_DetalleNovedad'] . '</label>
                                    </div>            
                                </div>    
                            </div>
                              <div class="row align-items-end">
                                <div class="col-lg-4">
                                      <div class="form-group">
                                          <label for="" class="col-form-label">Lugar Exacto</label>
                                        <label for="" class="form-control">' . $row['Nove_LugarExacto'] . '</label>
                                      </div>            
                                  </div>    
                                <div class="col-lg-3">
                                        <div class="form-group">
                                          <label for="" class="col-form-label">H. Inicio</label>
                                        <label for="" class="form-control">' . $row['Nove_HoraInicio'] . '</label>
                                      </div>
                                  </div>
                                <div class="col-lg-3">
                                      <div class="form-group">
                                        <label for="" class="col-form-label">H. Fin</label>
                                        <label for="" class="form-control">' . $row['Nove_HoraFin'] . '</label>
                                      </div> 
                                  </div>
                            </div>
                            <div class="row align-items-end">
                                <div class="col-lg-12">    
                                      <div class="form-group"> 
                                          <label for="" class="col-form-label">Descripcion</label>
                                          <label for="" class="form-control">' . $row['Nove_Descripcion'] . '</label>
                                      </div>            
                                  </div>    
                            </div>
                        </div>
                        <div class="card-footer text-muted">
                            <div class="row align-items-end">
                                <div class="col-lg-3">    
                                      <div class="form-group"> 
                                          <label for="" class="col-form-label">Usuario Ultima Edicion</label>
                                          <label for="" class="form-control">' . $row['Nove_UsuarioId_Edicion'] . '</label>
                                      </div>            
                                  </div>
                                <div class="col-lg-3">    
                                      <div class="form-group"> 
                                          <label for="" class="col-form-label">Fecha Ultima Edicion</label>
                                          <label for="" class="form-control">' . $row['Nove_FechaEdicion'] . '</label>
                                      </div>            
                                  </div>    
                                  <div class="col-lg-3">    
                                      <div class="form-group"> 
                                          <label for="" class="col-form-label">Usuario que Elimina</label>
                                          <label for="" class="form-control">' . $row['Nove_UsuarioId_Elimnar'] . '</label>
                                      </div>            
                                  </div>
                                <div class="col-lg-3">    
                                      <div class="form-group"> 
                                          <label for="" class="col-form-label">Fecha que Elimina</label>
                                          <label for="" class="form-control">' . $row['Nove_FechaEliminar'] . '</label>
                                      </div>            
                                  </div>    
                            </div>
                            <div class="row align-items-end">
                                <div class="col-lg-3">    
                                      <div class="form-group"> 
                                          <label for="" class="col-form-label">Usuario que Cierra</label>
                                          <label for="" class="form-control">' . $row['Nove_UsuarioId_Cerrar'] . '</label>
                                      </div>            
                                  </div>
                                <div class="col-lg-3">    
                                      <div class="form-group"> 
                                          <label for="" class="col-form-label">Fecha que Cierra</label>
                                          <label for="" class="form-control">' . $row['Nove_FechaCerrar'] . '</label>
                                      </div>            
                                  </div>    
                            </div>	
                        </div>
                    </div>';
        }
        echo $html;
    }

	public function ValidarControlFacilitadorCarga($Prog_Fecha)
    {
        MModel($this->Modulo, 'CRUD');
        $InstanciaAjax= new CRUD();
        $Respuesta=$InstanciaAjax->ValidarControlFacilitadorCarga($Prog_Fecha);

        $CFaRg_Estado = "";
		$ContGenerado = 0;
		$ContCerrado = 0;
        foreach ($Respuesta as $row) {
			$ContGenerado++;
			if($row['CFaRg_Estado']=="CERRADO"){
				$ContCerrado++;
			}
        }

		if($ContCerrado == 0 && $ContGenerado > 0){
			$CFaRg_Estado = "GENERADO";
		}
		if($ContCerrado > 0){
			$CFaRg_Estado = "CERRADO";
		}

		echo $CFaRg_Estado;
    }

    public function BuscarServBus($Prog_Operacion, $Prog_Fecha, $Prog_IdManto)
    {
        $Prog_ServBus="";
        MModel($this->Modulo, 'CRUD');
        $InstanciaAjax= new CRUD();
        $Respuesta=$InstanciaAjax->BuscarServBus($Prog_Operacion, $Prog_Fecha, $Prog_IdManto);

        foreach ($Respuesta as $row) {
            $Prog_ServBus = $row['Prog_ServBus'];
        }
        echo $Prog_ServBus;
    }

    public function BuscarDataBD($TablaBD,$CampoBD,$DataBuscar)
    {
        MModel($this->Modulo,'CRUD');
        $InstanciaAjax= new CRUD();
        $Respuesta=$InstanciaAjax->BuscarDataBD($TablaBD,$CampoBD,$DataBuscar);

        print json_encode($Respuesta, JSON_UNESCAPED_UNICODE);
    }

    public function auto_completar($nombre_tabla, $nombre_campo)
    {
        $rpta_autocompletar = [];

        MModel($this->Modulo,'CRUD');
        $InstanciaAjax  = new CRUD();
        $Respuesta      = $InstanciaAjax->auto_completar($nombre_tabla, $nombre_campo);
        foreach ($Respuesta as $row) {
            if($nombre_campo=="Bus_NroExterno"){
                $rpta_autocompletar[] = ["value" => $row['Bus_NroExterno'], "label" => "<strong>".$row['Bus_NroExterno']."</strong> ".$row['Bus_NroPlaca']];
            }
        }
		echo json_encode($rpta_autocompletar);
    }

    public function buscar_dato($nombre_tabla, $campo_buscar, $condicion_where)
	{
		$rpta_buscar_dato = "";
        MModel($this->Modulo, 'CRUD');
		$InstanciaAjax= new CRUD();
		$Respuesta=$InstanciaAjax->buscar_dato($nombre_tabla, $campo_buscar, $condicion_where);

        foreach ($Respuesta as $row) {
			$rpta_buscar_dato = $row[$campo_buscar];
		}
		echo $rpta_buscar_dato;
	}

    public function DocumentRoot()
    {
        $miCarpeta  = '';
        $miHost     = $_SERVER['HTTP_HOST'];
        $miReferer  = $_SERVER['HTTP_REFERER'];
        $miCarpeta  = substr($miReferer,0,strpos($miReferer,$miHost)).$miHost.'/';
        echo $miCarpeta;
    }

    public function buscar_pdf($tabla, $campo_archivo, $campo_buscar, $dato_buscar, $campo_tipo_archivo, $dato_tipo_archivo, $nombre_archivo)
    {
        $b64_file       = "";
        $b64_file_name  = "";

        MModel($this->Modulo,'CRUD');
        $InstanciaAjax  = new CRUD;
        $Respuesta      = $InstanciaAjax->buscar_pdf($tabla, $campo_archivo, $campo_buscar, $dato_buscar, $campo_tipo_archivo, $dato_tipo_archivo);

        foreach($Respuesta as $row){
            $b64_file = $row['b64_file'];
        }

        if($b64_file!=""){
            $mi_carpeta     = $_SERVER['DOCUMENT_ROOT']."/Services/pdf";
            $date           = date('d-m-Y-'.substr((string)microtime(), 1, 8));
            $date           = str_replace(".", "", $date);
            $b64_file_name  = $nombre_archivo."_v".$date.".pdf";
            $b64_file       = base64_decode($b64_file,true);
            file_put_contents($mi_carpeta."/".$b64_file_name, $b64_file);        
        }

        echo $b64_file_name;
    }

    public function unlink_pdf($archivo){
        $rpta_unlink_pdf = "ELIMINADO";
        $mi_carpeta  = $_SERVER['DOCUMENT_ROOT']."/Services/pdf";
        
        unlink($mi_carpeta.'/'.$archivo);
        
        if(file_exists($mi_carpeta.'/'.$archivo)){
            $rpta_unlink_pdf = "NO ELIMINADO";
        }
        
        echo $rpta_unlink_pdf;
    }

}