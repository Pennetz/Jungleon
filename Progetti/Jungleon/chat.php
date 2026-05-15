<?php
session_start();
require_once __DIR__ . '/API/chiavi.php';
require_once __DIR__ . '/auth_guard.php';

if (!isset($_SESSION['username'])) {
    header('Location: VisualizzaUtente.php');
    exit();
}

$username = $_SESSION['username'];
?>
<!doctype html>
<html lang="it">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Chat - Jungleon</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous" />
</head>
<body class="bg-light">
    <div class="container py-4">
        <div class="d-flex justify-content-between mb-3">
            <h1 class="h4">Chat</h1>
            <a href="VisualizzaUtente.php" class="btn btn-outline-secondary">Torna al profilo</a>
        </div>

        <div class="row">
            <div class="col-md-4">
                <div class="card mb-3">
                    <div class="card-body">
                        <h5>Nuovo messaggio</h5>
                        <div class="mb-2">
                            <label for="toUser" class="form-label">Username destinatario</label>
                            <input id="toUser" class="form-control" />
                        </div>
                        <div class="mb-2">
                            <label for="msgText" class="form-label">Messaggio</label>
                            <textarea id="msgText" class="form-control" rows="3"></textarea>
                        </div>
                        <div>
                            <button id="sendBtn" class="btn btn-primary">Invia</button>
                            <div id="sendError" class="text-danger mt-2"></div>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-body">
                        <h5>Le tue chat</h5>
                        <ul id="chatList" class="list-group list-group-flush"></ul>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body d-flex flex-column" style="height:70vh">
                        <div id="messages" class="mb-3 overflow-auto" style="flex:1"></div>
                        <div class="mt-2 d-flex">
                            <input id="replyText" class="form-control me-2" placeholder="Scrivi un messaggio..." />
                            <button id="replyBtn" class="btn btn-success">Invia</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<script>
const apiBase = '/Progetti/Jungleon/';
let currentChat = null;

async function fetchChats(){
    const res = await fetch(apiBase + 'getChats.php');
    const data = await res.json();
    const list = data.data || [];
    const ul = document.getElementById('chatList');
    ul.innerHTML = '';
    list.forEach(c => {
        const other = c.other || '';
        const li = document.createElement('li');
        li.className = 'list-group-item list-group-item-action';
        li.textContent = other + (c.unread_count > 0 ? ' ('+c.unread_count+' non letti)' : '');
        li.style.cursor = 'pointer';
        li.onclick = () => openChat(other);
        ul.appendChild(li);
    });
}

async function openChat(otherUser){
    currentChat = otherUser;
    const res = await fetch(apiBase + 'getMessages.php?other=' + encodeURIComponent(otherUser));
    const data = await res.json();
    const msgs = data.data || [];
    const container = document.getElementById('messages');
    container.innerHTML = '';
    msgs.forEach(m => {
        const div = document.createElement('div');
        div.className = 'mb-2';
        div.innerHTML = '<strong>'+m.Mittente+'</strong>: '+m.testo+' <div class="small text-muted">'+m.dataCreazione+'</div>';
        container.appendChild(div);
    });
    container.scrollTop = container.scrollHeight;
    // mark seen
    await fetch(apiBase + 'markSeen.php?other=' + encodeURIComponent(otherUser));
    fetchChats();
}

document.getElementById('sendBtn').addEventListener('click', async ()=>{
    const to = document.getElementById('toUser').value.trim();
    const testo = document.getElementById('msgText').value.trim();
    document.getElementById('sendError').textContent = '';
    if(!to || !testo){ document.getElementById('sendError').textContent = 'Destinatario e testo obbligatori'; return; }
    const res = await fetch(apiBase + 'Messaggi', {method:'POST', headers:{'Content-Type':'application/json'}, body: JSON.stringify({to:to, testo:testo})});
    const j = await res.json();
    if(!res.ok){ document.getElementById('sendError').textContent = j.error || 'Errore invio'; return; }
    document.getElementById('msgText').value = '';
    fetchChats();
});

document.getElementById('replyBtn').addEventListener('click', async ()=>{
    const testo = document.getElementById('replyText').value.trim();
    if(!currentChat){ alert('Apri una chat'); return; }
    if(!testo) return;
    const res = await fetch(apiBase + 'Messaggi', {method:'POST', headers:{'Content-Type':'application/json'}, body: JSON.stringify({to:currentChat, testo:testo})});
    if(!res.ok){ const j=await res.json(); alert(j.error||'Errore'); return; }
    document.getElementById('replyText').value = '';
    openChat(currentChat);
});

fetchChats();
setInterval(fetchChats, 5000);
</script>
</body>
</html>
