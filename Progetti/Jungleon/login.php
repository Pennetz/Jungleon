<?php
    session_start();
    require_once __DIR__ . '/API/chiavi.php';

    ini_set('display_errors', 1);
    error_reporting(E_ALL);

    try {
        // legge i dati inviati da accedi.php
        $username = $_POST['username'];
        $password = $_POST['password'];
        // verifica se username e password sono corretti facendo una curl a api.php
        // $ch = curl_init();
        // curl_setopt($ch, CURLOPT_URL, "http://localhost/Progetti/Jungleon/API/api.php/login");
        // curl_setopt($ch, CURLOPT_POST, 1);
        // curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode(array("username" => $username, "password" => $password)));
        // curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        // curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));


        /*$curl = curl_init("http://localhost/Progetti/Jungleon/API/api.php/login");    //inizia una sessione cURL e instanzia l'handler cURL (per poter usare curl_close(), curl_exec(), ...)
        curl_setopt_array($curl, [
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => json_encode(array("username" => $username, "password" => $password)),
            CURLOPT_HTTPHEADER => [
                'Content-Type: application/json',
            ],
        ]);*/


// Chiamata all'API usando localhost (chiamata interna server-to-server)
$apiUrl = "http://localhost/Progetti/Jungleon/API/Login";

$context = stream_context_create([
    'http' => [
        'method' => 'POST',
        'header' => [
            'Content-Type: application/json',
        ],
        'content' => json_encode(["username" => $username, "password" => $password])
    ]
]);
$response = file_get_contents($apiUrl, false, $context);
//var_dump($response);

$response_data = json_decode($response, true);
//var_dump($response_data);

if ($response_data["data"]["token"]) {
    $_SESSION['token'] = $response_data["data"]["token"];
    $_SESSION['username'] = $username;
    header("Location: VisualizzaUtente.php");
    exit();
} else {
    header("Location: accedi.php?errore=Credenziali non valide");
    exit();
}
        
    } catch (Exception $e) {
        echo "Errore: " . $e->getMessage();
    }

?>