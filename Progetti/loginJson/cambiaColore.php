<?php
session_start();

if (!isset($_SESSION['name']) || !isset($_POST['color'])) {
    header("Location: index.php?errore=" . urlencode("Devi prima effettuare il login."));
    exit();
}

$newColor = trim($_POST['color']);

// Validazione colore (deve essere esadecimale #RRGGBB)
if (!preg_match('/^#[0-9A-Fa-f]{6}$/', $newColor)) {
    http_response_code(400);
    exit();
}

$_SESSION['color'] = $newColor;

$fileUtenti = "utenti.json";
$name = $_SESSION['name'];

$utenti = json_decode(file_get_contents($fileUtenti), true);

// Aggiorna il colore dell'utente loggato
foreach ($utenti as &$u) {
    if ($u['username'] === $name) {
        $u['color'] = $newColor;
        break;
    }
}

file_put_contents($fileUtenti, json_encode($utenti, JSON_PRETTY_PRINT));
http_response_code(200);
?>
