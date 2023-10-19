<div id="contenido" class="container-fluid p-0">

	<nav class="navbar navbar-light bg-light p-0">
		<div class="container-fluid">
			<a class="navbar-brand text-muted align-baselin" href="#">
				<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-right-circle-fill" viewBox="0 0 16 16">
 					 <path d="M8 0a8 8 0 1 1 0 16A8 8 0 0 1 8 0zM4.5 7.5a.5.5 0 0 0 0 1h5.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3a.5.5 0 0 0 0-.708l-3-3a.5.5 0 1 0-.708.708L10.293 7.5H4.5z"/>
				</svg>	
				<?= $NombreDeModuloVista ?>
			</a>
		</div>
	</nav>

	<section class="container-fluid py-3">
		<button id="btnNuevo" type="button" class="btn btn-secondary btn-sm" data-toggle="modal">+ Nuevo</button>  
	</section>
	
	<div class="row p-3">
		<div class="col-auto m-0">
			<div class="table-responsive" id="div_tablaMaestroUno">
				<!-- Accesos Creacion Tabla -->
			</div>
    	</div>
	</div>


	<!--Modal para CRUD-->
	<div class="row modal fade" id="modalCRUD" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-lg"  role="document">
			<div class="modal-content">

				<div class="modal-header">
			        <h5 class="modal-title" id="exampleModalLabel"></h5>
			        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
			        </button>
			    </div>
			      	
				<form id="formMaestroUno">    
			      	<div class="modal-body">
			      		<div class="row">
			      		    <div class="col-lg-6">
								<div class="row">
									<div class="col-lg-6">
										<div class="form-group">
						          			<label for="Colaborador_id" class="col-form-label form-control-sm">DNI</label>
						           			<input type="text" class="form-control form-control-sm" id="Colaborador_id" maxlength="8">
				  		       			</div>
									</div>
									<div class="col-lg-6">
				  		        		<div class="form-group">
						           			<label for="Colab_nombre_corto" class="col-form-label form-control-sm">NOMBRE CORTO</label>
						           			<input type="text" class="form-control text-uppercase form-control-sm" id="Colab_nombre_corto" maxlength="45">
				  		        		</div>
									</div>
								</div>
				  		        <div class="row">
									<div class="col-lg-12">
				  		        		<div class="form-group">
						           			<label for="Colab_ApellidosNombres" class="col-form-label form-control-sm">APELLIDOS Y NOMBRES</label>
						           			<input type="text" class="form-control text-uppercase form-control-sm" id="Colab_ApellidosNombres" maxlength="60">
				  		        		</div>
									</div>
								</div>
								<div class="row">
									<div class="col-lg-12">
				  		        		<div class="form-group">
						           			<label for="Colab_CargoActual" class="col-form-label form-control-sm">CARGO ACTUAL</label>
						           			<select class="form-control form-control-sm" id="Colab_CargoActual">
											</select>
						       			</div>               
						    		</div>
								</div>
								<div class="row">
						    		<div class="col-lg-6">
						        		<div class="form-group">
						            		<label for="Colab_Estado" class="col-form-label form-control-sm">ESTADO</label>
						            		<select class="form-control form-control-sm" id="Colab_Estado">
											</select>
				  		        		</div>
			      		    		</div>  
									<div class="col-lg-6">
				  		    			<div class="form-group">
						          			<label for="Colab_CodigoCortoPT" class="col-form-label form-control-sm">CODIGO ATU</label>
						           			<input type="text" class="form-control form-control-sm" id="Colab_CodigoCortoPT">
				  		       			</div>
			      		    		</div>
								</div>
								<div class="row">
			      		    		<div class="col-lg-6">
			      		       			<div class="form-group">
			      		        			<label for="Colab_FechaIngreso" class="col-form-label form-control-sm">F.INGRESO</label>
			      		        			<input type="date" class="form-control form-control-sm" id="Colab_FechaIngreso">
			      		        		</div>
			      		    		</div>    
			      		    		<div class="col-lg-6">    
			      		        		<div class="form-group">
			      		        			<label for="Colab_FechaCese" class="col-form-label form-control-sm">F.CESE</label>
			      		        			<input type="date" class="form-control form-control-sm" id="Colab_FechaCese">
			      		        		</div>            
			      		    		</div>    
			      				</div>   
							</div>
			      		    <div class="col-lg-6">
								<div class="row">
									<div class="col-lg-12" > <!--  ml-auto -->
										<div class="ExternalFiles" id="div_FotografiaColaborador">
											<!--<img src="data:image/jpg;base64," height="260px" width="280px" alt="" />-->
										</div>
									</div>		
								</div>
								<div class="row">
									<div class="col-lg-12">
										<div class="form-group">
											<div class="custom-file">
									  			<label id="labelColab_Fotografia" class="custom-file-label form-control-sm" for="customFileLang">Seleccionar Archivo .jpg o .bmp</label>
									  			<input type="file" class="custom-file-input form-control-sm" id="Colab_Fotografia" lang="es" accept=".jpg, .bmp"> 
											</div>
				  		               	</div>
									</div>
								</div>
							</div>    
			      		</div>
			      		<div class="row">
			      		    <div class="col-lg-7">
								<div class="form-group">
									<label for="Colab_Email" class="col-form-label form-control-sm">CORREO ELECTRONICO</label>
		      		        		<input type="text" class="form-control form-control-sm" id="Colab_Email" placeholder="john@example.com">
								</div>
			      		    </div>
							<!--<div class="col-lg-4">
				  		        <div class="form-group">
									<label for="Colab_PerfilEvaluacion" class="col-form-label form-control-sm">PERFIL</label>
						            <select class="form-control form-control-sm" id="Colab_PerfilEvaluacion">
									</select>
								</div> 
			      		    </div>-->
			      		    <div class="col-lg-5">
				  		        <div class="form-group">
						        	<label for="Colab_Distrito" class="col-form-label form-control-sm">DISTRITO</label>
						        	<select class="form-control form-control-sm" id="Colab_Distrito">
									</select>
				  		        </div> 
			      		    </div>
						</div>
						<div class="row">
			      		    <div class="col-lg-12">
				  		        <div class="form-group">
									<label for="Colab_Direccion" class="col-form-label form-control-sm">DIRECCION</label>
						        	<input type="text" class="form-control text-uppercase form-control-sm" id="Colab_Direccion" maxlength="130">
								</div> 
			      		    </div>    
			      		</div>  
			      	</div>
			      	<div class="modal-footer">
			      		<button type="button" class="btn btn-light btn-sm" data-dismiss="modal">Cancelar</button>
			      		<button type="submit" id="btnGuardar" class="btn btn-dark btn-sm">Guardar</button>
			      	</div>
			    </form>    
			</div>
		</div>
	</div>  			

	<!--Modal para CRUD FOTOGRAFIA-->
	<div class="row modal fade" id="modalCRUDFotografia" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">

				<div class="modal-header">
			        <h5 class="modal-title" id="exampleModalLabel"></h5>
			        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
			        </button>
			    </div>
			      	
				<form id="formFotografia">    
			      	<div class="modal-body">
						<div class="row">
							<div class="col-lg-12">
								<div class="text-center form-group" id="div_MostrarFotografia">

								</div>
							</div>		
						</div>
			      	</div>
			      	<div class="modal-footer">
			      		<button type="button" class="btn btn-light" data-dismiss="modal">Cerrar</button>
			      	</div>
			    </form>    
			</div>
		</div>
	</div>  			

</div>
