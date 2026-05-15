<?php
session_start();
require_once __DIR__ . '/auth_guard.php';



$username = $_SESSION['username'];
?>
<!doctype html>
<html lang="it">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Tracking Mouse MQTT - Jungleon</title>
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
        rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
        crossorigin="anonymous"
    />
    <style>
        body {
            margin: 0;
            min-height: 100vh;
            background: #f4f7fb;
        }

        .top-panel {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 20;
            background: #ffffff;
            border-bottom: 1px solid #d9e1ea;
        }

        .play-area {
            position: fixed;
            left: 0;
            right: 0;
            top: 130px;
            bottom: 0;
            overflow: hidden;
            cursor: crosshair;
        }

        .remote-cursor {
            position: absolute;
            width: 14px;
            height: 14px;
            border-radius: 50%;
            transform: translate(-50%, -50%);
            box-shadow: 0 0 0 2px #ffffff;
            pointer-events: none;
        }

        .remote-label {
            position: absolute;
            transform: translate(10px, -22px);
            font-size: 12px;
            color: #ffffff;
            background: rgba(0, 0, 0, 0.7);
            border-radius: 5px;
            padding: 2px 6px;
            pointer-events: none;
            white-space: nowrap;
        }
    </style>
</head>
<body>
    <div class="top-panel">
        <div class="container py-3">
            <div class="d-flex justify-content-between align-items-center mb-2">
                <h1 class="h5 mb-0">Tracking mouse multiutente (MQTT)</h1>
                <a href="VisualizzaUtente.php" class="btn btn-outline-secondary btn-sm">Torna all'area utente</a>
            </div>
            <div class="small text-muted">
                Il tuo identificatore e' lo username in sessione: <strong id="meName"></strong>
            </div>
            <div class="small">
                Stato connessione: <strong id="connStatus" class="text-warning">connessione...</strong>
                | Broker: <strong id="brokerUsed">-</strong>
                | Utenti visibili: <strong id="usersCount">0</strong>
            </div>
        </div>
    </div>

    <div id="playArea" class="play-area"></div>

    <script src="assets/js/mqtt.min.js"></script>
    <script>
        // ===========================
        // 1) DATI BASE DELL'UTENTE
        // ===========================
        // Questo username arriva da PHP (sessione) ed e' l'ID univoco richiesto.
        const myUsername = <?php echo json_encode($username, JSON_UNESCAPED_UNICODE); ?>;

        // ===========================
        // 2) CONFIGURAZIONE MQTT
        // ===========================
        // Broker SOLO locale (offline): stesso host che serve la pagina.
        // Richiede Mosquitto locale con listener WebSocket su porta 9001.
        const brokerUrl = (location.protocol === "https:" ? "wss://" : "ws://") + location.hostname + ":9001/mqtt";

        // Topic comune: chi pubblica qui verra' visto da tutti gli iscritti.
        const topic = "jungleon/mouse/tracking/base";

        // ===========================
        // 3) RIFERIMENTI UI
        // ===========================
        const connStatus = document.getElementById("connStatus");
        const brokerUsed = document.getElementById("brokerUsed");
        const usersCount = document.getElementById("usersCount");
        const playArea = document.getElementById("playArea");

        document.getElementById("meName").textContent = myUsername;
        brokerUsed.textContent = brokerUrl;

        // users[username] = { x, y, color, lastSeen, cursorEl, labelEl }
        const users = {};

        // ===========================
        // 4) FUNZIONI DI SUPPORTO
        // ===========================

        // Stesso username -> stesso colore (utile per distinguere utenti).
        function colorFromName(name) {
            let hash = 0;
            for (let i = 0; i < name.length; i++) {
                hash = (hash << 5) - hash + name.charCodeAt(i);
                hash |= 0;
            }
            const hue = Math.abs(hash) % 360;
            return "hsl(" + hue + " 75% 45%)";
        }

        function setStatus(text, className) {
            connStatus.textContent = text;
            connStatus.className = className;
        }

        function refreshCount() {
            usersCount.textContent = String(Object.keys(users).length);
        }

        // Converte le coordinate del mouse in coordinate RELATIVE all'area di gioco.
        // Questo risolve lo spostamento del cursore (offset).
        function getRelativeCoordinates(event) {
            const rect = playArea.getBoundingClientRect();
            return {
                x: event.clientX - rect.left,
                y: event.clientY - rect.top
            };
        }

        function upsertUser(username, x, y, color) {
            if (!users[username]) {
                const cursorEl = document.createElement("div");
                cursorEl.className = "remote-cursor";

                const labelEl = document.createElement("div");
                labelEl.className = "remote-label";

                playArea.appendChild(cursorEl);
                playArea.appendChild(labelEl);

                users[username] = {
                    x: x,
                    y: y,
                    color: color,
                    lastSeen: Date.now(),
                    cursorEl: cursorEl,
                    labelEl: labelEl
                };
            }

            users[username].x = x;
            users[username].y = y;
            users[username].color = color;
            users[username].lastSeen = Date.now();
        }

        function drawUser(username) {
            if (username === myUsername) {
                return; // Non disegno il mio cursore (lo vedo gia' muoversi in locale).
            }
            const u = users[username];
            if (!u) {
                return;
            }

            u.cursorEl.style.left = u.x + "px";
            u.cursorEl.style.top = u.y + "px";
            u.cursorEl.style.backgroundColor = u.color;

            u.labelEl.style.left = u.x + "px";
            u.labelEl.style.top = u.y + "px";
            u.labelEl.textContent = username;
        }

        function removeUser(username) {
            const u = users[username];
            if (!u) {
                return;
            }
            u.cursorEl.remove();
            u.labelEl.remove();
            delete users[username];
        }

        // ===========================
        // 5) CONNESSIONE AL BROKER
        // ===========================
        const myColor = colorFromName(myUsername);

        // ATTENZIONE: clientId NON e' l'username applicativo.
        // clientId deve essere unico per connessione MQTT: aggiungo un suffisso random.
        const mqttClientId = "jungleon-" + myUsername + "-" + Math.random().toString(16).slice(2, 8);

        const client = mqtt.connect(brokerUrl, {
            clientId: mqttClientId,
            clean: true,
            reconnectPeriod: 2000,
            connectTimeout: 5000
        });

        client.on("connect", () => {
            setStatus("connesso", "text-success");

            // Subscribe = mi iscrivo al topic per ricevere i messaggi degli altri.
            client.subscribe(topic, (err) => {
                if (err) {
                    setStatus("errore subscribe", "text-danger");
                }
            });
        });

        client.on("reconnect", () => {
            setStatus("riconnessione...", "text-warning");
        });

        client.on("close", () => {
            setStatus("disconnesso", "text-danger");
        });

        client.on("error", () => {
            setStatus("errore connessione", "text-danger");
        });

        // Quando arriva un messaggio dal topic, disegno/aggiorno il cursore corrispondente.
        client.on("message", (_topic, payload) => {
            let data;
            try {
                data = JSON.parse(payload.toString());
            } catch {
                return;
            }

            if (!data || !data.username || typeof data.x !== "number" || typeof data.y !== "number") {
                return;
            }

            upsertUser(data.username, data.x, data.y, data.color || colorFromName(data.username));
            drawUser(data.username);
            refreshCount();
        });

        // ===========================
        // 6) INVIO POSIZIONE MOUSE
        // ===========================
        // Throttle semplice: max 25 messaggi al secondo.
        let lastSendTime = 0;
        const minInterval = 40;

        playArea.addEventListener("mousemove", (event) => {
            const now = Date.now();
            if (now - lastSendTime < minInterval) {
                return;
            }
            lastSendTime = now;

            // Coordinate corrette rispetto all'area di gioco.
            const coords = getRelativeCoordinates(event);

            const message = {
                username: myUsername,
                x: coords.x,
                y: coords.y,
                color: myColor,
                ts: now
            };

            // Aggiorno subito il mio cursore in locale, senza aspettare la rete.
            upsertUser(myUsername, message.x, message.y, myColor);
            drawUser(myUsername);
            refreshCount();

            // Publish = invio il messaggio sul topic.
            if (client.connected) {
                client.publish(topic, JSON.stringify(message));
            }
        });

        // ===========================
        // 7) PULIZIA UTENTI INATTIVI
        // ===========================
        // Se non ricevo aggiornamenti per 5 secondi, rimuovo l'utente dalla vista.
        setInterval(() => {
            const now = Date.now();
            for (const username in users) {
                if (now - users[username].lastSeen > 5000) {
                    removeUser(username);
                }
            }
            refreshCount();
        }, 1000);
    </script>
</body>
</html>
