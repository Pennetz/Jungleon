<?php
session_start();
require_once __DIR__ . '/API/chiavi.php';

if (!isset($_SESSION['username'])) {
    header("location: index.php");
    exit();
}

/**
 * Richiede ruolo e permessi all'API usando il token
 * @param string $token JWT token
 * @return array|null Dati utente (username, ruolo, permessi) o null se errore
 */
function ruoloUtenteDaApi($token) {
    if (!$token) {
        return null;
    }

    $apiUrl = API_BASE_URL . "/Progetti/Jungleon/API/PermessiUtente";
    
    // Crea il context con header formattati correttamente
    $context = stream_context_create([
        'http' => [
            'method' => 'GET',
            'header' => "Content-Type: application/json\r\n" .
                       "Authorization: Bearer " . $token . "\r\n",
            'ignore_errors' => true
        ]
    ]);

    $response = @file_get_contents($apiUrl, false, $context);
    
    if ($response === false) {
        return null;
    }

    // Controlla lo status code dalla risposta HTTP
    if (isset($http_response_header)) {
        $status_line = $http_response_header[0] ?? '';
        if (strpos($status_line, '200') === false) {
            return null;
        }
    }

    $responseData = json_decode($response, true);
    if (!isset($responseData['data']['ruolo'], $responseData['data']['permessi'])) {
        return null;
    }

    return [
        'username' => $responseData['data']['username'] ?? null,
        'ruolo' => $responseData['data']['ruolo'],
        'permessi' => $responseData['data']['permessi']
    ];
}

/**
 * Verifica il token JWT e legge il ruolo dal database
 * @return array|null Array con informazioni utente (username, ruolo, exp) o null se token non valido
 */
function verificaTokeneEstraiRuolo() {
    // Verifica se il token esiste in sessione
    if (!isset($_SESSION['token'])) {
        return null;
    }

    $token = $_SESSION['token'];
    $info = ruoloUtenteDaApi($token);

    if (!$info || !isset($info['ruolo'], $info['permessi'])) {
        return null;
    }

    $username = $info['username'] ?? ($_SESSION['username'] ?? null);
    if (!$username) {
        return null;
    }

    return [
        'username' => $username,
        'ruolo' => $info['ruolo'],
        'permessi' => $info['permessi'],
        //'exp' => null,
        'valido' => true
    ];
}

// Ottieni le informazioni del token/utente
$datiUtente = verificaTokeneEstraiRuolo();

/**
 * Controlla se l'utente ha un permesso specifico in base al ruolo
 * @param array $datiUtente Array con dati utente (username, ruolo, permessi, valido)
 * @param string $azione L'azione richiesta
 * @return bool true se è permesso, false altrimenti
 */
function puoiFare($datiUtente, $azione = null) {
    if (!$datiUtente || !$datiUtente['valido']) {
        return false;
    }

    $permessi = $datiUtente['permessi'] ?? [];

    // Se non è specificata un'azione, solo verifica che esistano permessi
    if ($azione == null) {
        return !empty($permessi);
    }

    // Estrai i nomi dei permessi dall'array strutturato
    foreach ($permessi as $permesso) {
        if (is_array($permesso) && isset($permesso['nome']) && $permesso['nome'] === $azione) {
            return true;
        }
    }

    return false;
}
?>
<!doctype html>
<html lang="it">
    <head>
        <title>Fabrizio Pennetta Jungleon</title>
        <!-- Required meta tags -->
        <meta charset="utf-8" />
        <meta
            name="viewport"
            content="width=device-width, initial-scale=1, shrink-to-fit=no"
        />

        <!-- Bootstrap CSS v5.2.1 -->
        <link
            href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
            rel="stylesheet"
            integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
            crossorigin="anonymous"
        />
    </head>

    <body>
        <header>
            <!-- place navbar here -->
            <div class="container">
                <div class="nav nav-tabs">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php">Back to Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link " href="../Informatica.php">Informatica</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../TPSIT.php">TPSIT</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../GPO.php">GPO</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="index.php">Jungleon</a>
                    </li>
                </div>
            </div>
            
        </header>
        <main>


            <?php
                if (isset($_GET["errore"])){
            ?>
                <h3 class="alert alert-danger"> <?php echo $_GET["errore"] ?> </h3>

            <?php
                }
            ?>

            <!-- ==================== SEZIONE AUTORIZZAZIONE E MOCKUP AZIONI ==================== -->
            <div class="container mt-5">
                <h3>Area Azioni Utente</h3>
                
                <?php
                    if ($datiUtente && $datiUtente['valido']) {
                        ?>
                        <div class="alert alert-info">
                            <strong>Benvenuto <?php echo htmlspecialchars($datiUtente['username']); ?>!</strong><br/>
                            Ruolo: <span class="badge bg-primary"><?php echo htmlspecialchars($datiUtente['ruolo']); ?></span>
                        </div>

                        <!-- Mockup AZIONE 1: Visualizza (accessibile a tutti) -->
                        <?php if (puoiFare($datiUtente, 'visualizza')) { ?>
                            <button class="btn btn-info" disabled title="Azione mockup - Tutti">
                                📋 Visualizza Dati
                            </button>
                        <?php } ?>

                        <!-- Mockup AZIONE 2: Crea (Admin, Moderatore, UtenteBase) -->
                        <?php if (puoiFare($datiUtente, 'crea')) { ?>
                            <button class="btn btn-success" disabled title="Azione mockup - Admin, Moderatore, UtenteBase">
                                ➕ Crea Nuova Partita
                            </button>
                        <?php } ?>

                        <!-- Mockup AZIONE 3: Modifica (Admin, Moderatore) -->
                        <?php if (puoiFare($datiUtente, 'modifica')) { ?>
                            <button class="btn btn-warning" disabled title="Azione mockup - Admin, Moderatore">
                                ✏️ Modifica Impostazioni
                            </button>
                        <?php } ?>

                        <!-- Mockup AZIONE 4: Elimina (Admin, Moderatore) -->
                        <?php if (puoiFare($datiUtente, 'elimina')) { ?>
                            <button class="btn btn-danger" disabled title="Azione mockup - Admin, Moderatore">
                                🗑️ Elimina Dati
                            </button>
                        <?php } ?>

                        <!-- Mockup AZIONE 5: Gestisci Utenti (Solo Admin) -->
                        <?php if (puoiFare($datiUtente, 'gestisci_utenti')) { ?>
                            <button class="btn btn-dark" disabled title="Azione mockup - Solo Admin">
                                👥 Gestisci Utenti
                            </button>
                        <?php } ?>

                        <!-- Mockup AZIONE 6: Gestisci Partite (Admin, Moderatore) -->
                        <?php if (puoiFare($datiUtente, 'gestisci_partite')) { ?>
                            <button class="btn btn-secondary" disabled title="Azione mockup - Admin, Moderatore">
                                🎮 Gestisci Partite
                            </button>
                        <?php } ?>

                        <hr/>
                        <p class="text-muted">
                            <small>ℹ️ I bottoni sopra sono un mockup. Il sistema verifica il ruolo dell'utente e mostra/nasconde le azioni in base ai permessi salvati nel database.</small>
                        </p>
                        <?php
                    } else {
                        ?>
                        <div class="alert alert-warning">
                            ⚠️ Token non valido o scaduto. Effettua il login di nuovo.
                        </div>
                        <?php
                    }
                ?>
            </div>

            <?php
                if (!isset($_SESSION['username'])) {
                    
                    header("location: VisualizzaUtente.php");

                } else { //altrimenti visualizzo il bottone per andare alla pagina di login
            ?>
                <div class="container mt-3">
                    <h6>Non hai un account?</h6>
                    <a href="register.php" class="btn btn-secondary">Registrati</a>
                    <a href="logout.php" class="btn btn-primary">Logout</a>
                </div>
            <?php
                } 
            ?>
            

        </main>
        <footer>
            <!-- place footer here -->
        </footer>
        <!-- Bootstrap JavaScript Libraries -->
        <script
            src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
            integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
            crossorigin="anonymous"
        ></script>

        <script
            src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
            integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+"
            crossorigin="anonymous"
        ></script>
    </body>
</html>