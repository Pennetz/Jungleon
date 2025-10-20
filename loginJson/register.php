<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    // Controllo campi vuoti
    if ($username === "" || $password === "") {
        $errore = "Inserisci sia username che password.";
        header("Location: index.php?errore=" . urlencode($errore));
        exit;
    }

    // Carica il pepper
    $pepper = trim(file_get_contents("pepe.txt"));

    // Genera un sale univoco
    $salt = bin2hex(random_bytes(16));

    // Crea un unico hash SHA-256
    $stringaDaHashare = $password . $pepper . $salt;
    $pwd_hashed = hash("sha256", $stringaDaHashare);

    $fileUtenti = "utenti.json";

    // Se il file non esiste, crealo
    if (!file_exists($fileUtenti)) {
        file_put_contents($fileUtenti, "[]");
    }

    $utenti = json_decode(file_get_contents($fileUtenti), true);

    // Controlla se l'username è già registrato
    foreach ($utenti as $u) {
        if ($u['username'] === $username) {
            $errore = "Username già registrato.";
            header("Location: index.php?errore=" . urlencode($errore));
            exit;
        }
    }

    // Aggiungi utente
    $utenti[] = [
        "username" => $username,
        "hash" => $pwd_hashed,
        "salt" => $salt,
        "role" => "none",
        "color" => "#778899"
    ];

    file_put_contents($fileUtenti, json_encode($utenti, JSON_PRETTY_PRINT));

    // Salva la sessione e reindirizza
    $_SESSION['name'] = $username;
    header("Location: visualizzaUtente.php");
    exit;
}
?>