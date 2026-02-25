<?php 

session_start();

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

    // registra l'utente facendo una ?curl a api.php
    $context = stream_context_create([
        'http' => [
            'method' => 'POST',
            'header' => [
                "Content-Type: application/json",
                "Origin: https://crispy-space-invention-7v7q7wx7r7xrfx66w-80.app.github.dev/",
            ],
            'content' => json_encode(["username" => $username, "email" => $email ?? null, "nome" => $nome, "password" => $password])
        ]
    ]);
    $response = file_get_contents("https://crispy-space-invention-7v7q7wx7r7xrfx66w-80.app.github.dev/Progetti/Jungleon/API/Register", false, $context);

    if ($response === false) {
        header("Location: registrati.php?errore=" . urlencode("Errore di connessione al servizio di registrazione"));
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
        echo "Registrazione e login avvenuta con successo.";
    } else {
        $errore = $apiError ?: "Errore durante la registrazione";
        header("Location: registrati.php?errore=" . urlencode($errore));
        exit();
    }

} catch (Exception $e) {
    echo "Errore: " . $e->getMessage();
}


?>