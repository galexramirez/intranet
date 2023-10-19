<!-- 2.2 CONTENIDO DE MODULO -->

<div id="contenido" class="container-fluid p-0">

	<nav class="navbar navbar-light bg-light p-0">
		<div class="container-fluid">
    	
		<a class="navbar-brand text-muted" href="#">
			<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-right-circle-fill" viewBox="0 0 16 16">
 			 <path d="M8 0a8 8 0 1 1 0 16A8 8 0 0 1 8 0zM4.5 7.5a.5.5 0 0 0 0 1h5.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3a.5.5 0 0 0 0-.708l-3-3a.5.5 0 1 0-.708.708L10.293 7.5H4.5z"/>
			</svg>
			<?= $NombreDeModuloVista ?>
		</a>
	
		</div>
	</nav>
	
	<section class="container-fluid py-3">
		<form id="formUsuarios" class="row col-sm-12 container-fluid" enctype="multipart/form-data" action="" method="post">	    
			<div class="row align-items-end pb-4 col-sm-12">
				<div class="col-lg-2">
			      	<div class="form-group">
						<label for="" class="col-form-label">Fecha de Inicio:</label>
						<input type="date" class="form-control" id="FechaInicio" placeholder="aaaa-mm-dd" >
			    		<div id="MsFechaInicio"class="invalid-feedback">Complete el campo.</div>
			      	</div>
			    </div>
				<div class="col-lg-2">
			      	<div class="form-group">
						<label for="" class="col-form-label">Fecha de Término:</label>
						<input type="date" class="form-control" id="FechaTermino" placeholder="aaaa-mm-dd" >
			    		<div id="MsFechaTermino"class="invalid-feedback">Complete el campo.</div>
			      	</div>
			    </div>
				<div class="col-lg-2">             	
					<div class="form-group">
						<button type="button" id="btnCargarNomina"class="btn btn-success"> Cargar Nomina </button>
					</div>
			    </div> 
			</div>
		</form>
	</section>
	
	<div class="row p-3">
		<div class="col-auto m-0">
			<div class="table-responsive">
				<table id="tablaUsuarios" class="table table-striped table-bordered table-condensed ">
        			<thead class="text-center">
            			<tr>
						<th>Fecha</th>
						<th>Código</th>
            		    <th>DNI</th>
						<th>Apellidos y Nombres</th>
						<th>Hora de Inicio</th>
						<th>Hora de Término</th>
						<th>Amplitud</th>
						<th>Duración</th>
						<th>Tipo de Operación</th>
						<th>Servicio</th>
						</tr>
        			</thead>
        			<tbody>                           
        			</tbody>
				<!--<tfoot class="text-center">
            			<tr>
            		    <th>Fecha de Ingreso</th>
						<th>Año</th>
						<th>Mes</th>
						<th>Semana</th>
						<th>Fecha</th>
						<th>Dia</th>
						<th>Coóigo</th>
            		    <th>DNI</th>
						<th>Apellidos y Nombres</th>
						<th>Hora de Inicio</th>
						<th>Hora de Termino</th>
						<th>Amplitud</th>
						<th>Duración</th>
						<th>Tipo de Colaborador</th>
						<th>Servicio</th>
            			</tr>
        			</tfoot>  -->      
    			</table>
			</div>
    	</div>
	</div>
</div>
