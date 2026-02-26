<?php 

session_start();
require_once __DIR__ . '/API/chiavi.php';

ini_set("display_errors", 1);
error_reporting(E_ALL);

try {
    // legge i dati inviati da registrati.php
    $username = $_POST['username'] ?? null;
    $password = $_POST['password'] ?? null;
    $nome = $_POST['nome'] ?? null;
    $email = $_POST['email'] ?? null;

    if (empty($username) || empty($password) || empty($nome)) {
        header("Location: registrati.php?errore=" . urlencode("Campi obbligatori mancanti"));
        exit();
    }

    // registra l'utente facendo una chiamata all'API (usa localhost per chiamate interne)
    $apiUrl = "http://localhost/Progetti/Jungleon/API/Register";
    
    $context = stream_context_create([
        'http' => [
            'method' => 'POST',
            'header' => [
                "Content-Type: application/json",
            ],
            'content' => json_encode(["username" => $username, "email" => $email ?? null, "nome" => $nome, "password" => $password]),
            'ignore_errors' => true  // Necessario per catturare anche risposte con errori HTTP
        ]
    ]);
    $response = file_get_contents($apiUrl, false, $context);

    if ($response === false) {
        $error = error_get_last();
        header("Location: registrati.php?errore=" . urlencode("Errore di connessione: " . ($error['message'] ?? 'sconosciuto')));
        exit();
    }
    
    $response_data = json_decode($response, true);

    if (!is_array($response_data)) {
        header("Location: registrati.php?errore=" . urlencode("Risposta non valida dal servizio di registrazione"));
        exit();
    }

    $success = $response_data['data']['success'] ?? false;
    $apiError = $response_data['error'] ?? null;
    //echo var_dump($response_data);

    if ($success) {
        $registeredUsername = $response_data['data']['username'] ?? $username;
        header("Location: accedi.php?messaggio=" . urlencode("Registrazione completata! Effettua il login.") . "&username=" . urlencode($registeredUsername));
        exit();
    } else {
        $errore = $apiError ?: "Errore durante la registrazione";
        header("Location: registrati.php?errore=" . urlencode($errore));
        exit();
    }

} catch (Exception $e) {
    echo "Errore: " . $e->getMessage();
}


?>