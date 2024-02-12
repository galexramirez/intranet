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
}else if($_SERVER['REQUEST_METHOD'] == "POST"){ echo "hola post";/*
    //recibimos los datos enviados
    $postBody = file_get_contents("php://input");
    //enviamos los datos al manejador
    $datosArray = $_pacientes->post($postBody);
    //delvovemos una respuesta 
     header('Content-Type: application/json');
     if(isset($datosArray["result"]["error_id"])){
         $responseCode = $datosArray["result"]["error_id"];
         http_response_code($responseCode);
     }else{
         http_response_code(200);
     }
     echo json_encode($datosArray);*/
    
}else if($_SERVER['REQUEST_METHOD'] == "PUT"){ echo "hola put";/*
      //recibimos los datos enviados
      $postBody = file_get_contents("php://input");
      //enviamos datos al manejador
      $datosArray = $_pacientes->put($postBody);
        //delvovemos una respuesta 
     header('Content-Type: application/json');
     if(isset($datosArray["result"]["error_id"])){
         $responseCode = $datosArray["result"]["error_id"];
         http_response_code($responseCode);
     }else{
         http_response_code(200);
     }
     echo json_encode($datosArray);*/

}else if($_SERVER['REQUEST_METHOD'] == "DELETE"){ echo "hola delete";/*

        $headers = getallheaders();
        if(isset($headers["token"]) && isset($headers["pacienteId"])){
            //recibimos los datos enviados por el header
            $send = [
                "token" => $headers["token"],
                "pacienteId" =>$headers["pacienteId"]
            ];
            $postBody = json_encode($send);
        }else{
            //recibimos los datos enviados
            $postBody = file_get_contents("php://input");
        }
        
        //enviamos datos al manejador
        $datosArray = $_pacientes->delete($postBody);
        //delvovemos una respuesta 
        header('Content-Type: application/json');
        if(isset($datosArray["result"]["error_id"])){
            $responseCode = $datosArray["result"]["error_id"];
            http_response_code($responseCode);
        }else{
            http_response_code(200);
        }
        echo json_encode($datosArray);*/
       

}else{
    header('Content-Type: application/json');
    $datos_array = $_respuestas->error_405();
    echo json_encode($datos_array);
}

?>