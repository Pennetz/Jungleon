<?php
session_start();
require_once __DIR__ . '/API/chiavi.php';
require_once __DIR__ . '/auth_guard.php';

if (!isset($_SESSION['username'])) {
    header('Location: VisualizzaUtente.php');
    exit();
}

$errore = $_GET['errore'] ?? null;
$messaggio = $_GET['messaggio'] ?? null;
?>
<!doctype html>
<html lang="it">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Contatta Moderatore - Jungleon</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous" />
</head>
<body class="bg-light">
    <div class="container py-4">
        <div class="d-flex justify-content-between mb-3">
            <h1 class="h4">Contatta un moderatore</h1>
            <a href="VisualizzaUtente.php" class="btn btn-outline-secondary">Torna al profilo</a>
        </div>

        <?php if ($errore): ?>
            <div class="alert alert-danger"><?php echo htmlspecialchars($errore); ?></div>
        <?php endif; ?>

        <?php if ($messaggio): ?>
            <div class="alert alert-success"><?php echo htmlspecialchars($messaggio); ?></div>
        <?php endif; ?>

        <div class="card shadow-sm">
            <div class="card-body">
                <form id="lamentaForm">
                    <div class="mb-3">
                        <label for="tipo" class="form-label">Tipologia (libera per ora)</label>
                        <input id="tipo" name="tipo" class="form-control" placeholder="Es. abuso, spam, richiesta aiuto" />
                        <div class="form-text">Nota: in futuro questa sarà una tendina predefinita.</div>
                    </div>
                    <div class="mb-3">
                        <label for="testo" class="form-label">Testo della lamentela</label>
                        <textarea id="testo" name="testo" class="form-control" rows="6" required></textarea>
                    </div>
                    <div>
                        <button id="send" class="btn btn-danger">Invia lamentela</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

<script>
const apiBase = '/Progetti/Jungleon/API/';

document.getElementById('lamentaForm').addEventListener('submit', async (e)=>{
    e.preventDefault();
    const tipo = document.getElementById('tipo').value.trim();
    const testo = document.getElementById('testo').value.trim();
    if (!testo) { alert('Inserisci il testo della lamentela'); return; }

    const res = await fetch(apiBase + 'Lamentela', {
        method: 'POST',
        headers: {'Content-Type':'application/json'},
        body: JSON.stringify({tipo: tipo, testo: testo})
    });

    const j = await res.json();
    if (!res.ok) {
        alert(j.error || 'Errore invio lamentela');
        return;
    }

    // successo
    window.location.href = 'VisualizzaUtente.php?messaggio=' + encodeURIComponent('Lamentela inviata al moderatore');
});
</script>
</body>
</html>
