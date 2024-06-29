<?php
class C_ConsultaModulos
{
    var $datos = array();
    function __construct()
    {
        SModel('ConsultaModulos', 'M_ConsultaModulos');
        $Instancia3 = new Modulos_m();
        $this->datos = $Instancia3->ModulosPorUsuario();
    }

    // Recibe "", Identifica Modulo de inicio para el usuario, Nonbre  Modulo Inicio.      
    function ModuloDeInicio()
    {
        $PrimerModuloConsulta = "";
        $ModuloDeInicio = "";

        foreach ($this->datos as $row) {

            if ($PrimerModuloConsulta == '') {
                $PrimerModuloConsulta = $row['Mod_Nombre'];
            }

            if ($row['PER_ModInicio'] == 'SI') {
                $ModuloDeInicio = $row['Mod_Nombre'];
            }
        }

        if ($ModuloDeInicio == '') {
            $ModuloDeInicio = $PrimerModuloConsulta;
        }
        return $ModuloDeInicio;
    }

    // Recibe Nombre Modulo, Valida acceso al modulo para el usuario, Verdadero/Falso  
    function ValidaModulo($NombreDeModulo)
    {
        $Resultado = "Falso";
        foreach ($this->datos as $row) {
            if ($row['Mod_Nombre'] == $NombreDeModulo) {
                $Resultado = "Verdadero";
            }
        }
        return $Resultado;
    }

    // Recibe Nombre Modulo, Identifica el nivel de permiso del usuario en el modulo, true/false  
    function PermisoAlModulo($NombreDeModulo)
    {
        $Resultado = "";
        foreach ($this->datos as $row) {
            if ($row['Mod_Nombre'] == $NombreDeModulo) {
                $Resultado = $row['PER_Nivel'];
            }
        }
        return $Resultado;
    }

    // Recibe "", Crea Lista los modulos que tiene activo el usuario, Array  
    function ListaModulosDelUsuario()
    {
        return $this->datos;
    }
}
