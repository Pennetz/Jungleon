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

if (!haPermesso('Crea Oggetti')) {
    header('Location: VisualizzaUtente.php?errore=' . urlencode('Non hai il permesso per creare oggetti'));
    exit();
}

$puoPubblicare = haPermesso('Pubblicazione');
$tipiArmature = chiamaApiGet('TipiArmature');
$tipiArmi = chiamaApiGet('TipiArmi');
$tipiPozioni = chiamaApiGet('TipiPozioni');
$tipiReliquie = chiamaApiGet('TipiReliquie');
$errore = $_GET['errore'] ?? null;
$messaggio = $_GET['messaggio'] ?? null;
?>
<!doctype html>
<html lang="it">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Crea Oggetto</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous" />
</head>
<body class="bg-light">
    <div class="container py-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h1 class="h3 mb-1">Crea Oggetto</h1>
                <p class="text-muted mb-0">Definisci l'oggetto base e associa uno o più tipi nelle diverse famiglie disponibili.</p>
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
                <form action="salvaOggetto.php" method="post" class="row g-3">
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
                            <input class="form-check-input" type="checkbox" role="switch" id="pubblico" name="pubblico" value="1" <?php echo $puoPubblicare ? '' : 'disabled'; ?> />
                            <label class="form-check-label" for="pubblico">Pubblico</label>
                        </div>
                        <?php if (!$puoPubblicare): ?>
                            <div class="form-text text-danger">Non puoi pubblicare le tue creazioni. Se ritieni sia un errore contatta un moderatore.</div>
                        <?php endif; ?>
                    </div>

                    <div class="col-12">
                        <label for="descrizione" class="form-label">Descrizione</label>
                        <textarea class="form-control" id="descrizione" name="descrizione" rows="3"></textarea>
                    </div>

                    <div class="col-12">
                        <label for="storia" class="form-label">Storia</label>
                        <textarea class="form-control" id="storia" name="storia" rows="3"></textarea>
                    </div>

                    <div class="col-md-4">
                        <label for="valore" class="form-label">Valore</label>
                        <input type="number" class="form-control" id="valore" name="valore" min="0" required>
                    </div>

                    <div class="col-md-4">
                        <label for="rarita" class="form-label">Rarità</label>
                        <input type="text" class="form-control" id="rarita" name="rarita" placeholder="Comune, Raro, Epico..." required>
                    </div>

                    <div class="col-md-4">
                        <label for="armature" class="form-label">Tipi armature</label>
                        <select class="form-select" id="armature" name="tipiArmature[]" multiple size="8">
                            <?php foreach ($tipiArmature as $tipo): ?>
                                <option value="<?php echo htmlspecialchars((string)$tipo); ?>"><?php echo htmlspecialchars((string)$tipo); ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="col-md-4">
                        <label for="armi" class="form-label">Tipi armi</label>
                        <select class="form-select" id="armi" name="tipiArmi[]" multiple size="8">
                            <?php foreach ($tipiArmi as $tipo): ?>
                                <option value="<?php echo htmlspecialchars((string)$tipo); ?>"><?php echo htmlspecialchars((string)$tipo); ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="col-md-4">
                        <label for="pozioni" class="form-label">Tipi pozioni</label>
                        <select class="form-select" id="pozioni" name="tipiPozioni[]" multiple size="8">
                            <?php foreach ($tipiPozioni as $tipo): ?>
                                <option value="<?php echo htmlspecialchars((string)$tipo); ?>"><?php echo htmlspecialchars((string)$tipo); ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="col-md-4">
                        <label for="reliquie" class="form-label">Tipi reliquie</label>
                        <select class="form-select" id="reliquie" name="tipiReliquie[]" multiple size="8">
                            <?php foreach ($tipiReliquie as $tipo): ?>
                                <option value="<?php echo htmlspecialchars((string)$tipo); ?>"><?php echo htmlspecialchars((string)$tipo); ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="col-12 d-flex justify-content-end gap-2">
                        <a href="VisualizzaUtente.php" class="btn btn-secondary">Annulla</a>
                        <button type="submit" class="btn btn-success">Crea oggetto</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>