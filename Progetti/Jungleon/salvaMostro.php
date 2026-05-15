<?php
session_start();
require_once __DIR__ . '/API/chiavi.php';
require_once __DIR__ . '/auth_guard.php';

if (!isset($_SESSION['username'])) {
    header('Location: accedi.php');
    exit();
}

function haPermesso(string $nomePermesso): bool {
    $permessi = $_SESSION['privilegi'] ?? [];
    foreach ($permessi as $permesso) {
        if (is_array($permesso) && (($permesso['nome'] ?? null) === $nomePermesso)) {
            return true;
        }
        if (is_string($permesso) && $permesso === $nomePermesso) {
            return true;
        }
    }
    return false;
}

if (!haPermesso('Crea Mostri')) {
    header('Location: VisualizzaUtente.php?errore=' . urlencode('Non hai il permesso per creare mostri'));
    exit();
}

$vuolePubblico = isset($_POST['pubblico']) && (int)$_POST['pubblico'] === 1;
if ($vuolePubblico && !haPermesso('Pubblicazione')) {
    header('Location: creaMostro.php?errore=' . urlencode('Non hai il privilegio per pubblicare il mostro'));
    exit();
}

$payload = [
    'nome' => trim($_POST['nome'] ?? ''),
    'livello' => (int)($_POST['livello'] ?? 0),
    'Utenti' => $_SESSION['username'],
    'descrizione' => trim($_POST['descrizione'] ?? ''),
    'esperienzaData' => (int)($_POST['esperienzaData'] ?? 0),
    'oroDato' => (int)($_POST['oroDato'] ?? 0),
    'vita' => (int)($_POST['vita'] ?? 0),
    'resistenza' => (int)($_POST['resistenza'] ?? 0),
    'velocita' => (int)($_POST['velocita'] ?? $_POST['velocità'] ?? 0),
    'forza' => (int)($_POST['forza'] ?? 0),
    'pubblico' => isset($_POST['pubblico']) ? 1 : 0,
    'tipiMostri' => array_values($_POST['tipiMostri'] ?? []),
    'oggettiUtente' => array_values($_POST['oggettiUtente'] ?? []),
    'oggettiPubblici' => array_values($_POST['oggettiPubblici'] ?? [])
];

$apiUrl = 'http://localhost/Progetti/Jungleon/API/Mostro';
$context = stream_context_create([
    'http' => [
        'method' => 'POST',
        'header' => [
            'Content-Type: application/json',
            'Authorization: Bearer ' . ($_SESSION['token'] ?? ''),
        ],
        'content' => json_encode($payload, JSON_UNESCAPED_UNICODE),
        'ignore_errors' => true
    ]
]);

$response = file_get_contents($apiUrl, false, $context);
if ($response === false) {
    $error = error_get_last();
    header('Location: creaMostro.php?errore=' . urlencode('Errore di connessione: ' . ($error['message'] ?? 'sconosciuto')));
    exit();
}

$responseData = json_decode($response, true);
if (!is_array($responseData)) {
    header('Location: creaMostro.php?errore=' . urlencode('Risposta non valida dal servizio di creazione mostri'));
    exit();
}

if (!empty($responseData['data']['success'])) {
    header('Location: VisualizzaMostri.php?messaggio=' . urlencode('Mostro creato correttamente'));
    exit();
}

$errore = $responseData['error'] ?? ($responseData['data']['error'] ?? 'Errore durante la creazione del mostro');
header('Location: creaMostro.php?errore=' . urlencode($errore));
exit();
