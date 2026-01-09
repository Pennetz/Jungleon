<?php

//HEADERS
header("Access-Control-Allow-Origin: http://localhost/rest-api-authentication-example/");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

//JWT
include_once 'php-jwt-master/src/BeforeValidException.php';
include_once 'php-jwt-master/src/ExpiredException.php';
include_once 'php-jwt-master/src/SignatureInvalidException.php';
include_once 'php-jwt-master/src/JWT.php';
use \Firebase\JWT\JWT;

if($_SERVER['REQUEST_METHOD'] == "POST"){ //SE IN POST

    if( isset($_POST["token"]) && strlen($_POST["token"]) > 0  ){ //OK

        //CHIAVE
        $key = "chiave_di_casa";

        //PARAMETRO
        $jwt = $_POST["token"];

        try {
 
            // decode jwt
            $decoded = JWT::decode($jwt, $key, array('HS256'));

            
            //$res=array("nomeStudente"=>$decoded->studente["nome"],"cognomeStudente"=>$decoded["studente"]["cognome"],"classeStudente"=>$decoded["studente"]["classe"], "status"=>true,"token"=>$jwt);
            http_response_code(200);
            echo json_encode($decoded->data);
        }
        
        // if decode fails, it means jwt is invalid
        catch (Exception $e){
        
            // set response code
            http_response_code(401);
        
            // show error message
            echo json_encode(array(
                "message" => "Access denied.",
                "error" => $e->getMessage()
            ));
        }



    }
    else{ //BAD REQUEST
       
        http_response_code(400);
        $res=array("responseCode"=>400,"responseText"=>"Bad Request", "text"=>"missing token");
        echo json_encode($res);
    }


}
else{//METHOD NOT ALLOWED

    http_response_code(405);
    $res=array("responseCode"=>405,"responseText"=>"Method not Allowed", "methodAllowed"=>"POST");
    echo json_encode($res);
}




?>