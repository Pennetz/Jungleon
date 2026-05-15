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
    $restrizioni = $_SESSION['restrizioni'] ?? [];

    $estraiNomi = static function (array $lista): array {
        $nomi = [];
        foreach ($lista as $item) {
            if (is_array($item) && isset($item['nome'])) {
                $nomi[] = $item['nome'];
            } elseif (is_string($item)) {
                $nomi[] = $item;
            }
        }

        return array_values(array_unique(array_filter($nomi, static fn($val) => $val !== null && $val !== '')));
    };

    $nomiRestrizioni = $estraiNomi($restrizioni);

    foreach ($permessi as $permesso) {
        if (is_array($permesso) && (($permesso['nome'] ?? null) === $nomePermesso)) {
            return !in_array($nomePermesso, $nomiRestrizioni, true);
        }
        if (is_string($permesso) && $permesso === $nomePermesso) {
            return !in_array($nomePermesso, $nomiRestrizioni, true);
        }
    }
    return false;
}

if (!haPermesso('Crea Oggetti')) {
    header('Location: VisualizzaUtente.php?errore=' . urlencode('Non hai il permesso per creare oggetti'));
    exit();
}

$vuolePubblico = isset($_POST['pubblico']) && (int)$_POST['pubblico'] === 1;
if ($vuolePubblico && !haPermesso('Pubblicazione')) {
    header('Location: creaOggetto.php?errore=' . urlencode('Non hai il privilegio per pubblicare l\'oggetto'));
    exit();
}

$payload = [
    'nome' => trim($_POST['nome'] ?? ''),
    'livello' => (int)($_POST['livello'] ?? 0),
    'Utenti' => $_SESSION['username'],
    'descrizione' => trim($_POST['descrizione'] ?? ''),
    'storia' => trim($_POST['storia'] ?? ''),
    'valore' => (int)($_POST['valore'] ?? 0),
    'rarita' => trim((string)($_POST['rarita'] ?? ($_POST['rarità'] ?? ''))),
    'pubblico' => $vuolePubblico ? 1 : 0,
    'tipiArmature' => array_values($_POST['tipiArmature'] ?? []),
    'tipiArmi' => array_values($_POST['tipiArmi'] ?? []),
    'tipiPozioni' => array_values($_POST['tipiPozioni'] ?? []),
    'tipiReliquie' => array_values($_POST['tipiReliquie'] ?? [])
];

$apiUrl = 'http://localhost/Progetti/Jungleon/API/Oggetto';
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
    header('Location: creaOggetto.php?errore=' . urlencode('Errore di connessione: ' . ($error['message'] ?? 'sconosciuto')));
    exit();
}

$responseData = json_decode($response, true);
if (!is_array($responseData)) {
    header('Location: creaOggetto.php?errore=' . urlencode('Risposta non valida dal servizio di creazione oggetti'));
    exit();
}

if (!empty($responseData['data']['success'])) {
    header('Location: VisualizzaUtente.php?messaggio=' . urlencode('Oggetto creato correttamente'));
    exit();
}

$errore = $responseData['error'] ?? ($responseData['data']['error'] ?? 'Errore durante la creazione dell\'oggetto');
header('Location: creaOggetto.php?errore=' . urlencode($errore));
exit();