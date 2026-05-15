<?php
session_start();
require_once __DIR__ . '/auth_guard.php';
if (!isset($_SESSION['username'])) { header('Location: VisualizzaUtente.php'); exit(); }
?>
<!doctype html>
<html lang="it">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Contatta Moderatore</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous" />
</head>
<body class="bg-light">
  <div class="container py-4">
    <div class="d-flex justify-content-between mb-3">
      <h1 class="h4">Contatta un moderatore (lamentela)</h1>
      <a href="VisualizzaUtente.php" class="btn btn-outline-secondary">Torna indietro</a>
    </div>

    <div class="card">
      <div class="card-body">
        <form id="complaintForm">
          <div class="mb-3">
            <label class="form-label">Tipologia (libera, in futuro a tendina)</label>
            <input id="tipo" class="form-control" placeholder="es: abuso, bug, richiesta" />
            <!-- TODO: in futuro da rendere una tendina -->
          </div>
          <div class="mb-3">
            <label class="form-label">Testo lamentela</label>
            <textarea id="testo" class="form-control" rows="6" required></textarea>
          </div>
          <div>
            <button type="button" id="sendComplaint" class="btn btn-warning">Invia</button>
            <div id="complaintMsg" class="mt-2"></div>
          </div>
        </form>
      </div>
    </div>
  </div>

<script>
const apiBase = '/Progetti/Jungleon/API/';
document.getElementById('sendComplaint').addEventListener('click', async ()=>{
  const tipo = document.getElementById('tipo').value.trim();
  const testo = document.getElementById('testo').value.trim();
  document.getElementById('complaintMsg').textContent = '';
  if(!testo){ document.getElementById('complaintMsg').textContent = 'Inserisci un testo.'; return; }
  const res = await fetch(apiBase + 'Lamentela', {method:'POST', headers:{'Content-Type':'application/json'}, body: JSON.stringify({tipo: tipo, testo: testo})});
  const j = await res.json();
  if(!res.ok){ document.getElementById('complaintMsg').textContent = j.error || 'Errore'; return; }
  document.getElementById('complaintMsg').textContent = 'Lamentela inviata.';
});
</script>
</body>
</html>
