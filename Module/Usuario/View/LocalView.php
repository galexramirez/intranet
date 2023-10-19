<div id="contenido" class="container-fluid p-0">

	<nav class="navbar navbar-light bg-light p-0">
		<div class="container-fluid">

    		<a class="navbar-brand text-muted align-baselin" href="#">
				<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-right-circle-fill" viewBox="0 0 16 16">
 					 <path d="M8 0a8 8 0 1 1 0 16A8 8 0 0 1 8 0zM4.5 7.5a.5.5 0 0 0 0 1h5.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3a.5.5 0 0 0 0-.708l-3-3a.5.5 0 1 0-.708.708L10.293 7.5H4.5z"/>
				</svg>	
				<?= $NombreDeModuloVista ?></a>
		</div>
	</nav>
	
	<section class="container-fluid py-3">
		<button id="btn_nuevo_usuario" type="button" class="btn btn-secondary btn-sm btn_nuevo_usuario" data-toggle="modal">+ Nuevo</button>  
	</section>
	
	<div class="row p-3">
		<div class="col-auto m-0">
			<div class="table-responsive" id="div_tablaUsuario">
				<!-- Accesos CreacionTabla -->
			</div>
    	</div>
	</div>

	<!--Modal para CRUD-->
	<div class="row modal fade" id="modalCRUD" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	    <div class="modal-dialog" role="document">
	        <div class="modal-content">
	           
			    <div class="modal-header">
	                <h5 class="modal-title" id="exampleModalLabel"></h5>
	                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
	                </button>
	            </div>
	      	
			  	<form id="formUsuarios">    
	      		    <div class="modal-body">
	      		        <div class="row">
	      		            <div class="col-lg-6">
		  		                <div class="form-group">
				                  	<label for="Usuario_Id" class="col-form-label form-control-sm">DNI</label>
				                   	<input type="text" class="form-control form-control-sm" id="Usuario_Id" maxlength="8">
		  		               	</div>
	      		            </div>
	      		            <div class="col-lg-6">
		  		                <div class="form-group">
				                   	<label for="Usua_NombreCorto" class="col-form-label form-control-sm">1er.NOMBRE Y 1er.APELLIDO</label>
				                   	<input type="text" readonly class="form-control text-uppercase form-control-sm" id="Usua_NombreCorto" maxlength="45">
				               	</div>               
				           	</div>
	      		        </div>
	      		        <div class="row">
	      		            <div class="col-lg-12">
		  		                <div class="form-group">
				                   <label for="Usua_Nombres" class="col-form-label form-control-sm">APELLIDOS Y NOMBRES</label>
				                   <input type="text" readonly class="form-control text-uppercase form-control-sm" id="Usua_Nombres" maxlength="60">
		  		                </div> 
	      		            </div>    
	      		        </div>
						<div class="row"> 
				            <div class="col-lg-6">
				              	<div class="form-group">
				               		<label for="Usua_UsuarioWeb" class="col-form-label form-control-sm">USUARIO WEB</label>
				               		<input type="text" class="form-control form-control-sm" id="Usua_UsuarioWeb" maxlength="80">
								</div>
		  		            </div>
	      		            <div class="col-lg-6">
	      		               	<div class="form-group">
	      		                	<label for="input-group" class="col-form-label form-control-sm">PASSWORD</label>
									<div class="input-group">
	      		                		<input type="password" name="Usua_Password" class="form-control form-control-sm" id="Usua_Password" placeholder="Contraseña" required autocomplete="off">
										<div class="input-group-append">
											<button id="show_password" class="btn btn-primary btn-sm" type="button" onclick="f_mostrarPassword()"> <span class="fa fa-eye-slash icon"></span> </button>
										</div>
									</div>
	      		                </div>
	      		            </div>
						</div>
	      		        <div class="row">
	      		            <div class="col-lg-6">    
	      		                <div class="form-group">
								  	<label for="Usua_Perfil" class="col-form-label form-control-sm">PERFIL</label>
				                   	<select class="form-control form-control-sm" id="Usua_Perfil">

									</select>
								</div>            
	      		            </div>    
	      		            <div class="col-lg-6">
	      		                <div class="form-group">
									<label for="Usua_Estado" class="col-form-label form-control-sm">ESTADO</label>
				                   	<select class="form-control form-control-sm" id="Usua_Estado">
										
									</select>
	      		                </div>
	      		            </div>
						</div>   
	      		    </div>
	      		    <div class="modal-footer">
	      		        <button type="button" class="btn btn-light btn-sm" data-dismiss="modal">Cancelar</button>
	      		        <button type="submit" id="btn_guardar_usuario" class="btn btn-dark btn-usuario">Guardar</button>
	      		    </div>
	      		</form>    
	        </div>
	    </div>
	</div>  			
</div>
