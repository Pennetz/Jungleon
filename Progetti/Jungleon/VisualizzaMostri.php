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

function chiamaApiGet(string $path): array {
    $url = 'http://localhost/Progetti/Jungleon/API/' . ltrim($path, '/');
    $response = @file_get_contents($url);
    if ($response === false) {
        return [];
    }

    $decoded = json_decode($response, true);
    if (!is_array($decoded)) {
        return [];
    }

    return $decoded['data'] ?? [];
}

$mostri = chiamaApiGet('MostriUtente/' . rawurlencode($_SESSION['username']));
$messaggio = $_GET['messaggio'] ?? null;
$errore = $_GET['errore'] ?? null;
?>
<!doctype html>
<html lang="it">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>I miei mostri</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous" />
</head>
<body class="bg-light">
    <div class="container py-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h1 class="h3 mb-1">I miei mostri</h1>
                <p class="text-muted mb-0">Elenco dei mostri creati da <?php echo htmlspecialchars($_SESSION['username']); ?>.</p>
            </div>
            <a href="VisualizzaUtente.php" class="btn btn-outline-secondary">Torna al profilo</a>
        </div>

        <?php if ($messaggio): ?>
            <div class="alert alert-success"><?php echo htmlspecialchars($messaggio); ?></div>
        <?php endif; ?>

        <?php if ($errore): ?>
            <div class="alert alert-danger"><?php echo htmlspecialchars($errore); ?></div>
        <?php endif; ?>

        <?php if (haPermesso('Crea Mostri')): ?>
            <div class="mb-3 text-center">
                <a href="creaMostro.php" class="btn btn-success">➕ Crea un altro mostro</a>
            </div>
        <?php endif; ?>

        <div class="card shadow-sm">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped align-middle mb-0">
                        <thead>
                            <tr>
                                <th>Nome</th>
                                <th>Livello</th>
                                <th>Esperienza</th>
                                <th>Oro</th>
                                <th>Vita</th>
                                <th>Resistenza</th>
                                <th>Velocita</th>
                                <th>Forza</th>
                                <th>Pubblico</th>
                                <th>Data creazione</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (empty($mostri)): ?>
                                <tr>
                                    <td colspan="10" class="text-center text-muted py-4">Nessun mostro creato ancora.</td>
                                </tr>
                            <?php else: ?>
                                <?php foreach ($mostri as $mostro): ?>
                                    <tr>
                                        <td>
                                            <strong><?php echo htmlspecialchars($mostro['nome'] ?? ''); ?></strong>
                                            <?php if (!empty($mostro['descrizione'])): ?>
                                                <div class="text-muted small"><?php echo htmlspecialchars($mostro['descrizione']); ?></div>
                                            <?php endif; ?>
                                        </td>
                                        <td><?php echo htmlspecialchars((string)($mostro['livello'] ?? '')); ?></td>
                                        <td><?php echo htmlspecialchars((string)($mostro['esperienzaData'] ?? '')); ?></td>
                                        <td><?php echo htmlspecialchars((string)($mostro['oroDato'] ?? '')); ?></td>
                                        <td><?php echo htmlspecialchars((string)($mostro['vita'] ?? '')); ?></td>
                                        <td><?php echo htmlspecialchars((string)($mostro['resistenza'] ?? '')); ?></td>
                                        <td><?php echo htmlspecialchars((string)($mostro['velocita'] ?? '')); ?></td>
                                        <td><?php echo htmlspecialchars((string)($mostro['forza'] ?? '')); ?></td>
                                        <td><?php echo !empty($mostro['pubblico']) ? 'Sì' : 'No'; ?></td>
                                        <td><?php echo htmlspecialchars((string)($mostro['dataCreazione'] ?? '')); ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
