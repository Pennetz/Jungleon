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

if (!haPermesso('Crea Mostri')) {
    header('Location: VisualizzaUtente.php?errore=' . urlencode('Non hai il permesso per creare mostri'));
    exit();
}

$puoPubblicare = haPermesso('Pubblicazione');

$tipiMostri = chiamaApiGet('TipiMostri');
$oggettiUtente = chiamaApiGet('TemplateOggettiUtente/' . rawurlencode($_SESSION['username']));
$oggettiPubblici = chiamaApiGet('TemplateOggettiPubblici/' . rawurlencode($_SESSION['username']));
$errore = $_GET['errore'] ?? null;
$messaggio = $_GET['messaggio'] ?? null;
?>
<!doctype html>
<html lang="it">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Crea Mostro</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous" />
</head>
<body class="bg-light">
    <div class="container py-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h1 class="h3 mb-1">Crea Mostro</h1>
                <p class="text-muted mb-0">Compila i dati base e scegli tipologie e oggetti associati.</p>
            </div>
            <a href="VisualizzaUtente.php" class="btn btn-outline-secondary">Torna indietro</a>
        </div>

        <?php if ($errore): ?>
            <div class="alert alert-danger"><?php echo htmlspecialchars($errore); ?></div>
        <?php endif; ?>

        <?php if ($messaggio): ?>
            <div class="alert alert-success"><?php echo htmlspecialchars($messaggio); ?></div>
        <?php endif; ?>

        <div class="card shadow-sm">
            <div class="card-body">
                <form action="salvaMostro.php" method="post" class="row g-3">
                    <div class="col-md-6">
                        <label for="nome" class="form-label">Nome</label>
                        <input type="text" class="form-control" id="nome" name="nome" required>
                    </div>
                    <div class="col-md-3">
                        <label for="livello" class="form-label">Livello</label>
                        <input type="number" class="form-control" id="livello" name="livello" min="1" required>
                    </div>
                    <div class="col-md-3">
                        <label for="pubblico" class="form-label d-block">Visibilità</label>
                        <div class="form-check form-switch mt-2">
                            <input class="form-check-input" type="checkbox" role="switch" id="pubblico" name="pubblico" value="1" <?php echo $puoPubblicare ? '' : 'disabled'; ?>>
                            <label class="form-check-label" for="pubblico">Pubblico</label>
                        </div>
                        <?php if (!$puoPubblicare): ?>
                            <div class="form-text text-danger">Non puoi pubblicare le tue creazioni. Se ritieni sia un errore contatta un moderatore</div>
                        <?php endif; ?>
                    </div>

                    <div class="col-12">
                        <label for="descrizione" class="form-label">Descrizione</label>
                        <textarea class="form-control" id="descrizione" name="descrizione" rows="3"></textarea>
                    </div>

                    <div class="col-md-4">
                        <label for="esperienzaData" class="form-label">Esperienza data</label>
                        <input type="number" class="form-control" id="esperienzaData" name="esperienzaData" min="0" required>
                    </div>
                    <div class="col-md-4">
                        <label for="oroDato" class="form-label">Oro dato</label>
                        <input type="number" class="form-control" id="oroDato" name="oroDato" min="0" required>
                    </div>
                    <div class="col-md-4">
                        <label for="vita" class="form-label">Vita</label>
                        <input type="number" class="form-control" id="vita" name="vita" min="1" required>
                    </div>

                    <div class="col-md-4">
                        <label for="resistenza" class="form-label">Resistenza</label>
                        <input type="number" class="form-control" id="resistenza" name="resistenza" min="0" required>
                    </div>
                    <div class="col-md-4">
                        <label for="velocita" class="form-label">Velocita</label>
                        <input type="number" class="form-control" id="velocita" name="velocita" min="0" required>
                    </div>
                    <div class="col-md-4">
                        <label for="forza" class="form-label">Forza</label>
                        <input type="number" class="form-control" id="forza" name="forza" min="0" required>
                    </div>

                    <div class="col-md-4">
                        <label for="tipiMostri" class="form-label">Tipi mostri</label>
                        <select class="form-select" id="tipiMostri" name="tipiMostri[]" multiple size="8">
                            <?php foreach ($tipiMostri as $tipoMostro): ?>
                                <option value="<?php echo htmlspecialchars((string)$tipoMostro); ?>"><?php echo htmlspecialchars((string)$tipoMostro); ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="col-md-4">
                        <label for="oggettiUtente" class="form-label">Oggetti tuoi</label>
                        <select class="form-select" id="oggettiUtente" name="oggettiUtente[]" multiple size="8">
                            <?php foreach ($oggettiUtente as $oggetto): ?>
                                <option value="<?php echo htmlspecialchars((string)$oggetto['ID']); ?>">
                                    <?php echo htmlspecialchars($oggetto['nome'] . ' - livello ' . $oggetto['livello']); ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="col-md-4">
                        <label for="oggettiPubblici" class="form-label">Oggetti pubblici</label>
                        <select class="form-select" id="oggettiPubblici" name="oggettiPubblici[]" multiple size="8">
                            <?php foreach ($oggettiPubblici as $oggetto): ?>
                                <option value="<?php echo htmlspecialchars((string)$oggetto['ID']); ?>">
                                    <?php echo htmlspecialchars($oggetto['nome'] . ' - livello ' . $oggetto['livello']); ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="col-12 d-flex justify-content-end gap-2">
                        <a href="VisualizzaUtente.php" class="btn btn-secondary">Annulla</a>
                        <button type="submit" class="btn btn-success">Crea mostro</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.querySelectorAll('select[multiple]').forEach(function(select) {
            select.addEventListener('mousedown', function(event) {
                const option = event.target;
                if (option && option.tagName === 'OPTION') {
                    event.preventDefault();
                    option.selected = !option.selected;
                    select.focus();
                }
            });
        });
    </script>
</body>
</html>
