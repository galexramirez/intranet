<?php 

require_once 'class/respuestas.class.php';
require_once 'class/ot.class.php';

$_respuestas = new respuestas;
$_ot = new ot;

if($_SERVER['REQUEST_METHOD'] == "GET"){
    if(isset($_GET["page"])){
        $pagina = $_GET["page"];
        $lista_ot = $_ot->lista_ot($pagina);
        header("Content-Type: application/json");
        echo json_encode($lista_ot);
        http_response_code(200);
    }else if(isset($_GET['id'])){
        $ot_id = $_GET['id'];
        $datos_ot = $_ot->obtener_ot($ot_id);
        header("Content-Type: application/json");
        echo json_encode($datos_ot);
        http_response_code(200);
    }
}else if($_SERVER['REQUEST_METHOD'] == "POST"){ 
    // RECIBIMOS LOS DATOS ENVIADOS
    $post_body = file_get_contents("php://input");
    // ENVIAMOS LOS DATOS AL MANEJADOR
    $datos_array = $_ot->post($post_body);
    // DEVOLVEMOS UNA RESPUESTA 
     header('Content-Type: application/json');
     if(isset($datos_array["result"]["error_id"])){
        $response_code = $datos_array["result"]["error_id"];
        http_response_code($response_code);
     }else{
        http_response_code(200);
     }
     echo json_encode($datos_array);
}else if($_SERVER['REQUEST_METHOD'] == "PUT"){
    // RECIBIMOS LOS DATOS ENVIADOS
    $post_body = file_get_contents("php://input");
    // ENVIAMOS LOS DATOS AL MANEJADOR
    $datos_array = $_ot->put($post_body);
    // DEVOLVEMOS UNA RESPUESTA 
    header('Content-Type: application/json');
    if(isset($datos_array["result"]["error_id"])){
        $response_code = $datos_array["result"]["error_id"];
        http_response_code($response_code);
     }else{
        http_response_code(200);
     }
     echo json_encode($datos_array);
}else if($_SERVER['REQUEST_METHOD'] == "DELETE"){
    $headers = getallheaders();
    if(isset($headers["token"]) && isset($headers["ot_id"])){
        // RECIBIMOS LOS DATOS ENVIADOS POR EL HEADER
        $send = [
            "token" => $headers["token"],
            "ot_id" => $headers["ot_id"]
        ];
        $post_body = json_encode($send);
    }else{
        // RECIBIMOS LOS DATOS ENVIADOS
        $post_body = file_get_contents("php://input");
    }
    // ENVIAMOS DATOS AL MANEJADOR
    $datos_array = $_ot->delete($post_body);
    // DEVOLVEMOS UNA RESPUESTA
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