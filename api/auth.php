<?php 

require_once 'class/auth.class.php';
require_once 'class/respuestas.class.php';

$_auth = new auth;
$_respuestas = new respuestas;

if($_SERVER['REQUEST_METHOD'] == "POST"){
    // RECIBIR DATOS
    $post_body = file_get_contents("php://input");

    //ENVIAMOS DATOS AL MANEJADOR
    $datos_array = $_auth->login($post_body);

    // DEVOLVEMOS UNAS RESPUESTA
    header('Content-Type: application/json');
    if(isset($datos_array["result"]["error_id"])){
        $response_code = $datos_array["result"]["error_id"];
        http_response_code($response_code);
    }else{
        http_response_code(200);
    }
    echo json_encode($datos_array);
}else{
    header('Content-Type: application/json');
    $datos_array = $_respuestas->error_405();
    echo json_encode($datos_array);
}

?>