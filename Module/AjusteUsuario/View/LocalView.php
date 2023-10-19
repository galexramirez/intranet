
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

	<div class="container-fluid ml-0 mr-0 mb-0">
		<form id="formAjusteUsuario" enctype="multipart/form-data" action="" method="post">    
			<div class="form-group">
				<div class="row d-flex justify-content-araound">
					<div class="col-lg-6 mx-1">
						<div class="row border border-muted border-radius rounded">
			      		    <div class="col-lg-6">
								<div class="row">
									<div class="col-lg-6">
										<div class="form-group">
						          			<label for="Colaborador_id" class="col-form-label form-control-sm">DNI</label>
											<input type="text" readonly class="form-control form-control-sm form-control-plaintext" id="Colaborador_id">
				  		       			</div>
									</div>
								</div>
				  		        <div class="row">
									<div class="col-lg-12">
				  		        		<div class="form-group">
						           			<label for="Colab_ApellidosNombres" class="col-form-label form-control-sm">Apellidos y Nombres</label>
						           			<input type="text" readonly class="form-control form-control-sm form-control-plaintext" id="Colab_ApellidosNombres">
				  		        		</div>
									</div>
								</div>
								<div class="row">
									<div class="col-lg-12">
				  		        		<div class="form-group">
						           			<label for="Usua_NombreCorto" class="col-form-label form-control-sm">1er. Nombre y 1er. Apellido</label>
						           			<input type="text" readonly class="form-control form-control-sm form-control-plaintext" id="Usua_NombreCorto">
				  		        		</div>
									</div>
								</div>
								<div class="row">
									<div class="col-lg-8">
				  		        		<div class="form-group">
						           			<label for="Colab_CargoActual" class="col-form-label form-control-sm">Cargo Actual</label>
											<input type="text" readonly class="form-control form-control-sm form-control-plaintext" id="Colab_CargoActual">
						       			</div>               
						    		</div>
									<div class="col-lg-4">
			      		       			<div class="form-group">
			      		        			<label for="Colab_FechaIngreso" class="col-form-label form-control-sm">Fecha de Ingreso</label>
			      		        			<input type="date" readonly class="form-control form-control-sm form-control-plaintext" id="Colab_FechaIngreso">
			      		        		</div>
			      		    		</div>    
								</div>
								<div class="row">
						    		<div class="col-lg-6">
						        		<div class="form-group">
											<label for="Colab_PerfilEvaluacion" class="col-form-label form-control-sm">Perfil</label>
						            		<input type="text" readonly class="form-control form-control-sm form-control-plaintext" id="Colab_PerfilEvaluacion">
										</div> 
			      		    		</div>  
									<div class="col-lg-6">
				  		    			<div class="form-group">
						          			<label for="Colab_CodigoCortoPT" class="col-form-label form-control-sm">Código de ATU</label>
						           			<input type="text" readonly class="form-control form-control-sm form-control-plaintext" id="Colab_CodigoCortoPT">
				  		       			</div>
			      		    		</div>
								</div>
			      		    </div>
			      		    <div class="col-lg-6">
								<div class="row">
									<div class="col-lg-12 ml-auto">
										<div class="text-center p-3 mb-3" id="div_FotografiaAjusteUsuario">
											<!--<img src="data:image/jpg;base64," height="260px" width="280px" alt="" />-->
										</div>
									</div>		
								</div>
							</div>
							<div class="col-lg-12">
			      				<div class="row">
			      				    <div class="col-lg-4">
										<div class="form-group">
			      				        	<label for="Colab_Email" class="col-form-label form-control-sm">Correo Electrónico</label>
		      		    		    		<input type="text" readonly class="form-control form-control-sm form-control-plaintext" id="Colab_Email">
										</div>
			      				    </div>
									<div class="col-lg-4">
										<div class="form-group">
				        		       		<label for="Usua_UsuarioWeb" class="col-form-label form-control-sm">Usuario Web</label>
				        		       		<input type="text" readonly class="form-control form-control-sm form-control-plaintext" id="Usua_UsuarioWeb">
										</div>
			      				    </div>
									<div class="col-lg-4">
	      		        		       	<div class="form-group">
	      		        		        	<label for="Usua_Password" class="col-form-label form-control-sm">Password</label>
											<div class="input-group">
	      		        		        		<input type="password" name="Usua_Password" class="form-control form-control-sm" id="Usua_Password" placeholder="Contraseña" required 	autocomplete="off" disabled>
												<div class="input-group-append">
													<button id="show_password" class="btn btn-primary" type="button" onclick="f_mostrarPassword()" disabled> <span class="fa fa-eye-slash icon"></span> 	</button>
												</div>
											</div>
	      		        		        </div>
	      		        		    </div>    
				      			</div>
							</div>
							<div class="col-lg-12">
								<div class="row">
			      				    <div class="col-lg-8">
				  				        <div class="form-group">
											<label for="Colab_Direccion" class="col-form-label form-control-sm">Dirección</label>
								        	<input type="text" readonly class="form-control form-control-sm form-control-plaintext" id="Colab_Direccion">
										</div> 
			      				    </div>    
			      				    <div class="col-lg-4">
				  				        <div class="form-group">
								        	<label for="Colab_Distrito" class="col-form-label form-control-sm">Distrito</label>
								        	<input type="text" readonly class="form-control form-control-sm form-control-plaintext" id="Colab_Distrito">
				  				        </div> 
			      				    </div>    
			      				</div>
							</div>
						</div>
					</div>
					<div class="col-lg-6 mx-1">
						<div class="row border border-muted border-radius rounded">
							<div class="col-lg-12">
			      				<div class="row d-flex justify-content-end align-items-center">
									<div class="p-2 form-group">
										<button type="button" id='btnCancelarAjusteUsuario' class="btn btn-light btn-sm">Cancelar</button>
										<button type="button" id="btnEditarAjusteUsuario" class="btn btn-secondary btn-sm">Editar</button>
			      						<button type="submit" id="btnGuardarAjusteUsuario" class="btn btn-dark btn-sm">Guardar</button>
									</div>
			      				</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</form>    
	</div>  			

</div>
