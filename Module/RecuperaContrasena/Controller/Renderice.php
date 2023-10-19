<?php
if (!isset($_SESSION['Usua_Email']))
	{         
	if(!isset($_POST["Colab_Email"]))
 		{ 
		MView('RecuperaContrasena','LoginView');
 		}
	else
		{
		MModel('RecuperaContrasena','Correo');
		$Instancia = new Correo();
		$validado = $Instancia->ValidaCorreo($_POST["Colab_Email"]);
		if($validado==1)
			{
			/* Se genera nueva contraseña */
			MController('RecuperaContrasena','Logico');
			$Instancia2 = new Logico();
			$longitud = 8;
			$password = $Instancia2->GeneraContrasena($longitud);
	
			/* Grabar en BD nueva contraseña */
			$Respuesta = $Instancia->GrabaContrasena($_POST["Colab_Email"],$password);

		    //Se envia correo con la contraseña temporal
			$destinatario = $_POST["Colab_Email"]; 
			$remitente = "Soporte Limabus <jvalencia@limabus.com.pe>";
			$asunto = "Cambio de Password";
			$copia = "";
			$copiaOculta = ""; 
			$Respuesta2 = $Instancia2->EnviarCorreo($destinatario,$remitente,$asunto,$copia,$copiaOculta,$password);
			
			$_SESSION['Usua_Email']= "VALIDADO";
			}
		else{
			$_SESSION['Usua_Email']= "INVALIDO";
			}
		header('Location: /RecuperaContrasena');
		}
	} 
else
	{
	if($_SESSION['Usua_Email']=="VALIDADO")
		{
		$MENSAJE = "Se ha enviado un nuevo password a su correo electrónico. Revisar carpetas SPAM. Volver a la página principal";
		}
	else
		{
		$MENSAJE = "El correo electrónico no se encuentra registrado. Volver a la página principal";
		}
	MView('RecuperaContrasena','LoginViewValido',compact('MENSAJE'));
	session_destroy();
	}