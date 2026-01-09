<?php

//HEADERS
header("Access-Control-Allow-Origin: http://localhost/rest-api-authentication-example/");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

//JWT
include_once 'php-jwt-master/src/BeforeValidException.php'; //se è già incluso non lo include 2 volte
include_once 'php-jwt-master/src/ExpiredException.php';
include_once 'php-jwt-master/src/SignatureInvalidException.php';
include_once 'php-jwt-master/src/JWT.php';
use \Firebase\JWT\JWT;


if($_SERVER['REQUEST_METHOD'] == "POST"){ //SE IN POST

    if( isset($_POST["nome"]) && strlen($_POST["nome"]) > 0 && isset($_POST["cognome"]) && strlen($_POST["cognome"]) > 0 && isset($_POST["classe"]) && strlen($_POST["classe"]) > 0  ){ //OK

        //PARAMETRI STUDENTE
        $nome = $_POST["nome"];
        $cognome = $_POST["cognome"];
        $classe = $_POST["classe"];
        
        //CHIAVE
        $key = "chiave_di_casa";

        //ORARI --> EXP IN 60s
        $issued_at = time();
        $expiration_time = $issued_at + (60 * 1);

        //PAYLOAD
        $payload = array(

            "iss" => "http://example.org",
            "aud" => "http://example.com",
            "iat" => $issued_at,
            "exp" => $expiration_time,
            "nbf" => 1357000000,
            "data" => array(
                
                "studente" => array(
                "nome" => $nome,
                "cognome" => $cognome,
                "classe" => $classe
                ),
                
                "docente" => array(
                "nome" => "Taver",
                "cognome" => "Nello",
                "matricola" => "X"
                )
            )
        );

        //CREAZIONE JWT
        try
        { //OK
            $jwt = JWT::encode($payload, $key,'HS256'); 
            $res=array("responseCode"=>200,"responseText"=>"OK", "status"=>true,"token"=>$jwt);
            http_response_code(200);
            echo json_encode($res);
            echo "\n";

            $host = "localhost";
            $username = "utente_phpmyadmin";
            $password = "86FbuSRrfWRkgWh";

            $connessione = new mysqli($host, $username, $password, "JungleonDB");

            if ($connessione->connect_errno){
                die("Connessione fallita: " . $connessione->connect_error);
            }

            $interrogaione = "SELECT * FROM Dungeons;";
            $risultato = $connessione->query($interrogaione);

            echo "<br>TUTTO OK<br>";
            echo "\n";
            echo var_dump($risultato);
            //echo $risultato[3];
            echo 2;


        }
        catch (UnexpectedValueException $e) 
        { //INTERNAL SERVER ERROR
            $res=array("responseCode"=>500,"responseText"=>"Internal Server Error", "text"=>"something went wrong","status"=>false,"error"=>$e->getMessage());   
            http_response_code(500);
            echo json_encode($res);

        }
       






    }
    else{ //BAD REQUEST
       
        http_response_code(400);
        $res=array("responseCode"=>400,"responseText"=>"Bad Request", "text"=>"missing parameter");
        echo json_encode($res);
    }

} 

else{//METHOD NOT ALLOWED

    http_response_code(405);
    $res=array("responseCode"=>405,"responseText"=>"Method not Allowed", "methodAllowed"=>"POST");
    echo json_encode($res);
}







?>