<?php 
// 1.0 DATOS A USARSE EN EL MODULO - MODIFICAR SI SE CREA NUEVO MODULO
    $NombreDeModulo="orden_trabajo"; // Como figura en la BD
    $NombreDeModuloVista="Orden de Trabajo"; // Como se muestra la usuario

// 2.0 VERIFICA PERMISOS DEL USUARIO SOBRE EL MODULO

    // Valida si hay usario activo en sesion activo
    if (!isset($_SESSION['USUARIO_ID']))
        { session_destroy();  header('Location: /inicio'); }

    // Valida si el usuario tiene acceso al Modulo

    SController('ConsultaModulos','C_ConsultaModulos'); 
	$Instancia2 = new C_ConsultaModulos();     
    $Respuesta=$Instancia2->ValidaModulo($NombreDeModulo);     	    
    if ($Respuesta=="Falso")
        { session_destroy();  header('Location: /inicio'); }
    $Respuesta=$Instancia2->PermisoAlModulo($NombreDeModulo);


 // 3.0 RECURSOS PARA EL MODULO     
    $InsertHead="   <link rel='stylesheet' href='Module/orden_trabajo/View/LocalView.css' type='text/css' media='all'>
                    <link rel='stylesheet' type='text/css' href='Services/Resources/DataTables-10.25/datatables/datatables.min.css'> 
                    <link rel='stylesheet' type='text/css' href='Services/Resources/DataTables-10.25/datatables/DataTables-1.10.25/css/dataTables.bootstrap4.min.css'>
                    <link rel='stylesheet' type='text/css' href='Services/Resources/DataTables-10.25/datatables/Buttons-1.7.1/css/buttons.bootstrap4.min.css'>
                    <link rel='stylesheet' href='https://pro.fontawesome.com/releases/v5.10.0/css/all.css' integrity='sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p' crossorigin='anonymous'/>  
                    <link rel='stylesheet' type='text/css' href='Services/Resources/cdn.datatables.net/fixedheader/3.1.9/css/fixedHeader.dataTables.min.css'>
                    <link rel='stylesheet' type='text/css' href='Services/Resources/cdn.datatables.net/select/1.3.3/css/select.dataTables.min.css'> 
                    <link rel='stylesheet' href='Services/Resources/fonts.googleapis.com/css.css'>
                    <link rel='stylesheet' href='Services/Resources/fonts.googleapis.com/icon.css'> 
                    <link rel='stylesheet' href='Services/Resources/jquery-ui-1.12.1/jquery-ui.min.css'>";

    $InserFooter="  <script type='text/javascript' src='Services/Resources/DataTables-10.25/datatables/datatables.min.js'></script>
                    <script type='text/javascript' src='Services/Resources/DataTables-10.25/datatables/JSZip-2.5.0/jszip.min.js'></script>
                    <script type='text/javascript' src='Services/Resources/DataTables-10.25/datatables/pdfmake-0.1.36/pdfmake.min.js'></script>
                    <script type='text/javascript' src='Services/Resources/DataTables-10.25/datatables/pdfmake-0.1.36/vfs_fonts.js'></script>
                    <script type='text/javascript' src='Services/Resources/DataTables-10.25/datatables/DataTables-1.10.25/js/jquery.dataTables.min.js'></script>
                    <script type='text/javascript' src='Services/Resources/DataTables-10.25/datatables/DataTables-1.10.25/js/dataTables.bootstrap4.min.js'></script>
                    <script type='text/javascript' src='Services/Resources/DataTables-10.25/datatables/Buttons-1.7.1/js/dataTables.buttons.min.js'></script>
                    <script type='text/javascript' src='Services/Resources/DataTables-10.25/datatables/Buttons-1.7.1/js/buttons.bootstrap4.min.js'></script>
                    <script type='text/javascript' src='Services/Resources/DataTables-10.25/datatables/Buttons-1.7.1/js/buttons.html5.min.js'></script>
                    <script type='text/javascript' src='Services/Resources/DataTables-10.25/datatables/Buttons-1.7.1/js/buttons.print.min.js'></script>
                    <script src='Module/orden_trabajo/View/LocalViewInicio.js' type='text/javascript'></script>
                    <script src='Module/orden_trabajo/View/LocalViewOTCorrectivas.js' type='text/javascript'></script>
                    <script src='Module/orden_trabajo/View/LocalViewOTProcesar.js' type='text/javascript'></script>
                    <script src='Module/orden_trabajo/View/local_view_horas_tecnicos.js' type='text/javascript'></script>
                    <script src='Module/orden_trabajo/View/local_view_cierre_semanal.js' type='text/javascript'></script>
                    <script src='Module/orden_trabajo/View/local_view_novedades.js' type='text/javascript'></script>
                    <script src='Module/orden_trabajo/View/local_view_novedad_regular.js' type='text/javascript'></script>
                    <script src='Module/orden_trabajo/View/local_view_codificar_novedad.js' type='text/javascript'></script>
                    <script src='Module/orden_trabajo/View/local_view_tc_ot_sistema.js' type='text/javascript'></script>
                    <script src='Module/orden_trabajo/View/local_view_tc_ot_usuario.js' type='text/javascript'></script>
                    <script type='text/javascript' src='Services/Resources/cdn.datatables.net/fixedheader/3.1.9/js/dataTables.fixedHeader.min.js'></script>
                    <script type='text/javascript' src='Services/Resources/cdn.datatables.net/select/1.3.3/js/dataTables.select.min.js'></script>
                    <script src='Services/Resources/jquery-ui-1.12.1/jquery-ui.min.js'></script> ";

// 4.0 CONTRUCCION DE LA VISTA

    SController('PlantillaTemplon','C_PlantillaTemplon');
    $Instancia2 = new C_PlantillaTemplon();     
    
    // PLANTILLA PARTE A
    $Respuesta=$Instancia2->VistaGeneral_A($InsertHead,$NombreDeModulo);  
    
    // VISTA DEL MODULO
    MController('orden_trabajo','Logico');
    $InstanciaModelo = new Logico();     
    $Respuesta=$InstanciaModelo->Contenido($NombreDeModuloVista);

    // PLANTILLA PARTE B
    $Respuesta=$Instancia2->VistaGeneral_B($InserFooter);

?>