<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>API - LBI</title>
    <link rel="stylesheet" href="assets/estilo.css" type="text/css">
</head>
<body>

<div  class="container">
    <h1>Api de Limabus</h1>
    <div class="divbody">
        <h3>Auth - login</h3>
        <code>
           POST  /auth
           <br>
           {
               <br>
               "usuario" :"", -> REQUERIDO
               <br>
               "password": "" -> REQUERIDO
               <br>
            }
        
        </code>
    </div>      
    <div class="divbody">   
        <h3>OTs</h3>
        <code>
           GET  /ot?page=$numeroPagina
           <br>
           GET  /ot?id=$ot_id
        </code>

        <code>
           POST  /ot
            <br>
            {
                <br> 
                "nombre" : "",   
                <br> 
                "dni" : "", -> REQUERIDO
                <br> 
                "correo":"",     
                <br> 
                "token" : "" -> REQUERIDO        
                <br>       
                "ot_estado" :"",             
                <br>  
                "ot_origen" : "",        
                <br>        
                "ot_tipo" : "",       
                <br>       
                "ot_bus" : "",      
                <br>         
                "ot_ruc_proveedor" : ""
                <br>
                "ot_nombre_proveedor" : ""
                <br>
                "ot_cgm_id" : ""
                <br>
                "ot_fecha_registro" : ""
                <br> 
                "ot_actividad" : ""
                <br> 
                "ot_actividad_vincular" : ""
                <br> 
                "ot_liometraje" : ""
                <br> 
                "ot_sistema" : ""
                <br>
                "ot_ejecucion" : ""
                <br> 
                "ot_obs_proveedor" : ""
                <br> 
                "ot_obs_cgm" : ""
                <br>
                "ot_log" : ""
                <br> 
                "ot_cierre_semanal" : ""
                <br>  
            }

        </code>
        <code>
            PUT  /ot
            <br> 
            {
                <br> 
                "nombre" : "",               
                <br> 
                "dni" : "", -> REQUERIDO 
                <br> 
                "correo":"",                 
                <br> 
                "token" : "" , -> REQUERIDO
                <br>       
                "ot_id" :"", -> REQUERIDO
                <br>  
                "ot_estado" : "",        
                <br>        
                "ot_origen" : "",       
                <br>       
                "ot_tipo" : "",      
                <br>         
                "ot_bus" : ""
                <br>         
                "ot_ruc_proveedor" : ""
                <br>
                "ot_nombre_proveedor" : ""
                <br>
                "ot_cgm_id" : ""
                <br>
                "ot_fecha_registro" : ""
                <br> 
                "ot_actividad" : ""
                <br> 
                "ot_actividad_vincular" : ""
                <br> 
                "ot_liometraje" : ""
                <br> 
                "ot_sistema" : ""
                <br>
                "ot_ejecucion" : ""
                <br> 
                "ot_obs_proveedor" : ""
                <br> 
                "ot_obs_cgm" : ""
                <br>
                "ot_log" : ""
                <br> 
                "ot_cierre_semanal" : ""
                <br>  
            }

        </code>
        <code>
           DELETE  /ot
           <br> 
           {   
               <br>    
               "token" : "", -> REQUERIDO        
               <br>       
               "ot_id" : "" -> REQUERIDO
               <br>
           }

        </code>
    </div>


</div>
    
</body>
</html>