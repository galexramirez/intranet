<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no,">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="Module/manual/View/img/favicon.ico">

    <title> <?= DF_TITULO; ?> <?= DF_MENSAJE; ?></title>

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="Services/Resources/bootstrap/css/bootstrap.min.css">

    <!-- Custom styles for this template -->
    <link href="Module/manual/View/local_view.css" rel="stylesheet">

    <!-- Librerias externas para mostrar u ocultar el password -->
    <link rel='stylesheet' href='Services/Resources/bootstrap-4.5.2-dist/css/bootstrap.min.css' type='text/css' media='all'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">


  </head>

  <body>

  <div class="container-fluid my-segundonivel p-0">
    <div id="my-sideBar-manual" class="border-rigth">
      <div class="d-flex flex-column align-items-stretch flex-shrink-0 bg-light overflow-auto p-0 my-menu">
        <a href="manual" class="d-flex align-items-center pb-3 mb-3 link-body-emphasis text-decoration-none border-bottom">
          <svg class="bi pe-none me-2" width="30" height="24"><use xlink:href="Module/manual/View/img/favicon.ico"/></svg>
          <span class="fs-5 fw-semibold">MANUAL DE SINPRO</span>
        </a>
        <ul class="list-unstyled ps-0">
          <li class="mb-1">
            <button class='btn btn-toggle d-inline-flex align-items-center rounded border-0 collapsed' data-toggle='collapse' data-target='#ajustes-collapse' aria-expanded='false'>
              AJUSTES
            </button>
            <div class="collapse" id="ajustes-collapse">
              <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                <li><a href="#" class="nav-link ml-2" onclick="f_capitulo('ajustes_generales')">AJUSTES GENERALES</a></li>
                <li><a href="#" class="nav-link ml-2" onclick="f_capitulo('ajustes_mantenimiento')">AJUSTES DE MANTENIMIENTO</a></li>
                <li><a href="#" class="nav-link ml-2" onclick="f_capitulo('ajustes_operaciones')">AJUSTE DE OPERACIONES</a></li>
                <li><a href="#" class="nav-link ml-2" onclick="f_capitulo('ajustes_usuario')">AJUSTE DE USUARIO</a></li>
                <li><a href="#" class="nav-link ml-2" onclick="f_capitulo('maestro_uno')">MAESTRO UNO</a></li>
                <li><a href="#" class="nav-link ml-2" onclick="f_capitulo('usuario')">USUARIO</a></li>
              </ul>
            </div>
          </li>
          <li class="mb-1">
            <button class="btn btn-toggle d-inline-flex align-items-center rounded border-0 collapsed" data-toggle="collapse" data-target="#mantenimiento-collapse" aria-expanded="false">
              MANTENIMIENTO
            </button>
            <div class="collapse" id="mantenimiento-collapse">
              <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                <li><a href="#" class="nav-link ml-2" onclick="f_capitulo('componentes')">COMPONENTES</a></li>
                <li><a href="#" class="nav-link ml-2" onclick="f_capitulo('dashboard_mantenimiento')">DASHBOARD DE MANTENIMIENTO</a></li>
                <li><a href="#" class="nav-link ml-2" onclick="f_capitulo('infobus')">INFOBUS</a></li>
                <li><a href="#" class="nav-link ml-2" onclick="f_capitulo('check_list')">INSPECCION CHECK LIST</a></li>
                <li><a href="#" class="nav-link ml-2" onclick="f_capitulo('inspeccion_flota')">INSPECCION DE FLOTA</a></li>
                <li><a href="#" class="nav-link ml-2" onclick="f_capitulo('inventario')">INVENTARIO</a></li>
                <li><a href="#" class="nav-link ml-2" onclick="f_capitulo('kilometraje')">KILOMETRAJE</a></li>
                <li><a href="#" class="nav-link ml-2" onclick="f_capitulo('materiales_servicios')">MATERIALES Y SERVICIOS</a></li>
                <li><a href="#" class="nav-link ml-2" onclick="f_capitulo('orden_trabajo')">ORDEN DE TRABAJO</a></li>
                <li><a href="#" class="nav-link ml-2" onclick="f_capitulo('ot_correctivas')">OT CORRECTIVAS</a></li>
                <li><a href="#" class="nav-link ml-2" onclick="f_capitulo('ot_preventivas')">OT PREVENTIVAS</a></li>
                <li><a href="#" class="nav-link ml-2" onclick="f_capitulo('pedidos')">PEDIDOS</a></li>
                <li><a href="#" class="nav-link ml-2" onclick="f_capitulo('vales')">VALES</a></li>
                <li><a href="#" class="nav-link ml-2" onclick="f_capitulo('vales_v3')">VALES 3.0</a></li>
              </ul>
            </div>
          </li>
          <li class="mb-1">
            <button class="btn btn-toggle d-inline-flex align-items-center rounded border-0 collapsed" data-toggle="collapse" data-target="#operaciones-collapse" aria-expanded="false">
              OPERACIONES
            </button>
            <div class="collapse" id="operaciones-collapse">
              <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                <li><a href="#" class="nav-link ml-2" onclick="f_capitulo('analisis_novedades')">AJUSTES GENERALES</a></li>
                <li><a href="#" class="nav-link ml-2" onclick="f_capitulo('comportamiento')">AJUSTES DE MANTENIMIENTO</a></li>
                <li><a href="#" class="nav-link ml-2" onclick="f_capitulo('control_facilitador')">AJUSTE DE OPERACIONES</a></li>
                <li><a href="#" class="nav-link ml-2" onclick="f_capitulo('costo_accidentes')">AJUSTE DE USUARIO</a></li>
                <li><a href="#" class="nav-link ml-2" onclick="f_capitulo('desempeno_piloto')">MAESTRO UNO</a></li>
                <li><a href="#" class="nav-link ml-2" onclick="f_capitulo('despacho_flota')">USUARIO</a></li>
                <li><a href="#" class="nav-link ml-2" onclick="f_capitulo('inasistencias')">INASISTENCIAS</a></li>
                <li><a href="#" class="nav-link ml-2" onclick="f_capitulo('informe_preliminar')">INFORME PRELIMINAR</a></li>
                <li><a href="#" class="nav-link ml-2" onclick="f_capitulo('nomina')">NOMINA</a></li>
                <li><a href="#" class="nav-link ml-2" onclick="f_capitulo('novedades_piloto')">NOVEDADES DE PILOTO</a></li>
                <li><a href="#" class="nav-link ml-2" onclick="f_capitulo('programacion_carga')">PROGRAMACION CARGA</a></li>
                <li><a href="#" class="nav-link ml-2" onclick="f_capitulo('solicitudes')">SOLICITUDES</a></li>
              </ul>
            </div>
          </li>
        </ul>
      </div>
    </div>
    <div id="div_capitulo" class="my-contenido-con-sidebar p-0">
    </div>
  </div>
    <footer>
      <script src='Services/Resources/jquery-3.2.1/jquery-3.2.1.min.js' type='text/javascript'></script> 
      <script src='Services/Resources/bootstrap-4.5.2-dist/js/bootstrap.min.js' type='text/javascript'></script>
      <script src='Services/Resources/showdownjs-showdown-7cbadb8/dist/showdown.min.js' type='text/javascript'></script>
      <script src='Module/manual/View/local_view.js' type='text/javascript'></script>
    </footer>
  </body>
</html>