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
    header('Location: VisualizzaUtente.php?errore=' . urlencode('Non hai il permesso per eliminare mostri o boss'));
    exit();
}

$idCreatura = (int)($_POST['idCreatura'] ?? 0);
$tipoCreatura = strtolower(trim((string)($_POST['tipoCreatura'] ?? 'mostro')));

if ($idCreatura <= 0 || !in_array($tipoCreatura, ['mostro', 'boss'], true)) {
    header('Location: VisualizzaMostri.php?errore=' . urlencode('Creatura non valida'));
    exit();
}

$apiUrl = $tipoCreatura === 'boss'
    ? 'http://localhost/Progetti/Jungleon/API/Boss'
    : 'http://localhost/Progetti/Jungleon/API/Mostro';

$payload = [
    'id' => $idCreatura,
];

$context = stream_context_create([
    'http' => [
        'method' => 'DELETE',
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
    header('Location: VisualizzaMostri.php?errore=' . urlencode('Errore di connessione: ' . ($error['message'] ?? 'sconosciuto')));
    exit();
}

$responseData = json_decode($response, true);
if (!is_array($responseData)) {
    header('Location: VisualizzaMostri.php?errore=' . urlencode('Risposta non valida dal servizio di eliminazione'));
    exit();
}

if (!empty($responseData['data']['success'])) {
    $msg = $tipoCreatura === 'boss' ? 'Boss eliminato correttamente' : 'Mostro eliminato correttamente';
    header('Location: VisualizzaMostri.php?messaggio=' . urlencode($msg));
    exit();
}

$errore = $responseData['error'] ?? ($responseData['data']['error'] ?? 'Errore durante l\'eliminazione');
header('Location: VisualizzaMostri.php?errore=' . urlencode($errore));
exit();
