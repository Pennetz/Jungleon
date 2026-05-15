<?php
/*
header("content-type: application/json; charset= utf-8");
die(json_encode($_SERVER));*/
require __DIR__ . '/vendor/autoload.php';
require __DIR__ . '/chiavi.php';
require_once __DIR__ . '/../classi/Mostro.php';

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

error_reporting(E_ALL);
ini_set('display_errors', 1);

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);


function documentazione(){
	header("Content-Type: text/html; charset= utf-8");

?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">

    <title>Api Jungleon service</title>
  </head>
  <body>
    <div class="container"> 
	    <h1 class="alert alert-info">API Jungleon service</h1>
	    <h2 class="alert alert-danger" title="Rivolgiti ad un moderatore" alt="Rivolgiti ad un moderatore">AUTH REQUIRED</h2>
        
       	
        <h3 class="alert alert-warning">Crea nuovo ruolo</h3>
        <div class="jumbotron">
            method : POST <br/>
            endpoint : https://crispy-space-invention-7v7q7wx7r7xrfx66w-80.app.github.dev/Progetti/Jungleon/API/Ruolo <br/>                                             <!-- da implementare -->
            returned data: Nome Ruolo 
        </div>

        <h3 class="alert alert-success">Registrazione utente</h3>
        <div class="jumbotron">
            method : POST <br/>
            endpoint : https://crispy-space-invention-7v7q7wx7r7xrfx66w-80.app.github.dev/Progetti/Jungleon/API/Register <br/>                                    <!-- da implementare -->
            returned data: stato (True), ID utente 
        </div>

        <h3 class="alert alert-success">Login</h3>
        <div class="jumbotron">
            method : POST <br/>
            endpoint : https://crispy-space-invention-7v7q7wx7r7xrfx66w-80.app.github.dev/Progetti/Jungleon/API/Login <br/>                                    <!-- da implementare -->
            returned data: JWT token, scadenza token 
        </div>

        <h3 class="alert alert-secondary">Join to new game</h3>
        <div class="jumbotron">
            method : POST <br/>
            endpoint : https://crispy-space-invention-7v7q7wx7r7xrfx66w-80.app.github.dev/Progetti/Jungleon/API/??? <br/>                                             <!-- da implementare -->
            returned data: game's ID 
        </div>

        <h3 class="alert alert-secondary">Insert your move</h3>
        <div class="jumbotron">
            method : POST <br/>
            endpoint : https://crispy-space-invention-7v7q7wx7r7xrfx66w-80.app.github.dev/Progetti/Jungleon/API/??? <br/>                                             <!-- da implementare -->
            returned data: move's ID 
        </div>

        <h3 class="alert alert-success">Ruoli esistenti</h3>
        <div class="jumbotron">
            method : GET <br/>
            endpoint : https://crispy-space-invention-7v7q7wx7r7xrfx66w-80.app.github.dev/Progetti/Jungleon/API/Ruoli <br/>                                    <!-- da implementare -->
            returned data: Ruoli LIST 
        </div>
        
        <h3 class="alert alert-success">Ruolo per Nome</h3>
        <div class="jumbotron">
            method : GET <br/>
            endpoint : https://crispy-space-invention-7v7q7wx7r7xrfx66w-80.app.github.dev/Progetti/Jungleon/API/Ruolo/{NomeRuolo(string)} <br/>                                             <!-- da implementare -->
            returned data: Ruoli LIST(1)  
        </div>
		
        <h3 class="alert alert-success">Dungeons pubblici</h3>
        <div class="jumbotron">
            method : GET <br/>
            endpoint : https://crispy-space-invention-7v7q7wx7r7xrfx66w-80.app.github.dev/Progetti/Jungleon/API/Dungeons <br/>                                             <!-- da implementare -->
            returned data: Dungeons LIST(45)  
        </div>

        <h3 class="alert alert-success">Dungeons pubblici per pagina</h3>
        <div class="jumbotron">
            method : GET <br/>
            endpoint : https://crispy-space-invention-7v7q7wx7r7xrfx66w-80.app.github.dev/Progetti/Jungleon/API/Dungeons/{pagina(int)} <br/>                                             <!-- da implementare -->
            returned data: Dungeons LIST(45)  
        </div>

        <h3 class="alert alert-success">Dungeon per ID</h3>
        <div class="jumbotron">
            method : GET <br/>
            endpoint : https://crispy-space-invention-7v7q7wx7r7xrfx66w-80.app.github.dev/Progetti/Jungleon/API/Dungeons/{ID(int)} <br/>                                             <!-- da implementare -->
            returned data: Dungeons LIST(1)  
        </div>

        <h3 class="alert alert-warning">Dungeons per Filtro</h3>
        <div class="jumbotron">
            method : GET <br/>
            endpoint : https://crispy-space-invention-7v7q7wx7r7xrfx66w-80.app.github.dev/Progetti/Jungleon/API/DungeonsFiltrati/{filtro} <br/>                                             <!-- da implementare -->
            returned data: Dungeons LIST  
        </div>

        <h3 class="alert alert-secondary">Last move</h3>
        <div class="jumbotron">
            method : GET <br/>
            endpoint : https://crispy-space-invention-7v7q7wx7r7xrfx66w-80.app.github.dev/Progetti/Jungleon/API/??? <br/>                                             <!-- da implementare -->
            returned data: last move 
        </div>

		<h3 class="alert alert-secondary">Game's Moves</h3>
        <div class="jumbotron">
            method : GET <br/>
            endpoint : https://crispy-space-invention-7v7q7wx7r7xrfx66w-80.app.github.dev/Progetti/Jungleon/API/??? <br/>                                             <!-- da implementare -->
            returned data: moves's LIST 
        </div>
		
        

    </div>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js" integrity="sha384-SR1sx49pcuLnqZUnnPwx6FCym0wLsk5JZuNx2bPPENzswTNFaQU1RDvt3wT4gWFG" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.min.js" integrity="sha384-j0CNLUeiqtyaRmlzUHCPZ+Gy5fQu0dQ6eZ/xAww941Ai1SxSY+0EQqNXNE6DZiVc" crossorigin="anonymous"></script>
    -->
  </body>
</html>


<?php

}

/* ------------------------ FUNZIONI GENERICHE ------------------------ */

function gestisci_URI(){
  $richiesta= $_SERVER["REQUEST_URI"];
  // print("richiesta: ".$richiesta);
  // print("\n");
  $param=explode("/",$richiesta);
  // print("\n");
  // print("count: ".count($param));
  // print("\n");
  // print_r($param);
  // print("\n");
  if (count($param)>4){
    // print_r(array_slice($param,4));
    return array_slice($param,4);
  }
    return null;
}

function db_connect(){
    $db = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    return $db;
}

function get_pepper(){
    static $pepper = null;
    if ($pepper !== null) return $pepper;

    $path = __DIR__ . '/pepper.txt';
    if (!file_exists($path)) die(json_encode(["error" => "Pepper mancante"]));
    $pepper = trim(file_get_contents($path));
    if ($pepper === '') die(json_encode(["error" => "Pepper vuoto"]));

    return $pepper;
}

function genera_salt($lunghezza = 16){
    return bin2hex(random_bytes($lunghezza)); // 16 byte = 32 caratteri esadecimali
}

function calcola_hash_password($password, $salt){
    $pepper = get_pepper();
    return hash('sha256', $salt . $pepper . $password);
}

function ruoli_utente_db($db, $username){
  $stmt = $db->prepare("SELECT DISTINCT Ruoli FROM Ruoli_Utenti WHERE Utenti=? ORDER BY Ruoli ASC");
  if (!$stmt) {
    return [];
  }

  $stmt->bind_param("s", $username);
  $stmt->execute();
  $result = $stmt->get_result();

  $ruoli = [];
  while ($row = $result->fetch_assoc()) {
    if (!empty($row["Ruoli"])) {
      $ruoli[] = $row["Ruoli"];
    }
  }

  $stmt->close();
  return array_values(array_unique($ruoli));
}

function privilegi_utente_db($db, $username){
  $stmt = $db->prepare(
    "SELECT DISTINCT Privilegi.nome, Privilegi.tipo, Privilegi.descrizione " .
    "FROM Privilegi " .
    "INNER JOIN Privilegi_Ruoli ON Privilegi_Ruoli.Privilegi = Privilegi.nome " .
    "INNER JOIN Ruoli_Utenti ON Ruoli_Utenti.Ruoli = Privilegi_Ruoli.Ruoli " .
    "WHERE Ruoli_Utenti.Utenti = ? " .
    "ORDER BY Privilegi.nome ASC"
  );

  if (!$stmt) {
    return [];
  }

  $stmt->bind_param("s", $username);
  $stmt->execute();
  $result = $stmt->get_result();

  $privilegi = [];
  while ($row = $result->fetch_assoc()) {
    $privilegi[] = [
      "nome" => $row["nome"],
      "tipo" => $row["tipo"] ?? null,
      "descrizione" => $row["descrizione"] ?? null
    ];
  }

  $stmt->close();
  return $privilegi;
}

function restrizioni_utente_db($db, $username){
  $stmt = $db->prepare(
    "SELECT Privilegi, Utenti_Mandante, dataAssegnazione, dataFine, motivazione " .
    "FROM RestrizioniPrivilegiUtenti " .
    "WHERE Utenti_Ricevente = ? AND dataFine > NOW() " .
    "ORDER BY dataFine DESC"
  );

  if (!$stmt) {
    return [];
  }

  $stmt->bind_param("s", $username);
  $stmt->execute();
  $result = $stmt->get_result();

  $restrizioni = [];
  while ($row = $result->fetch_assoc()) {
    $restrizioni[] = $row;
  }

  $stmt->close();
  return $restrizioni;
}

function permessi_validi_utente_db($db, $username){
  $ruoli = ruoli_utente_db($db, $username);
  $privilegi = privilegi_utente_db($db, $username);
  $restrizioni = restrizioni_utente_db($db, $username);

  $privilegi_bloccati = [];
  foreach ($restrizioni as $restrizione) {
    if (!empty($restrizione["Privilegi"])) {
      $privilegi_bloccati[] = $restrizione["Privilegi"];
    }
  }

  $privilegi_validi = [];
  foreach ($privilegi as $privilegio) {
    if (!in_array($privilegio["nome"], $privilegi_bloccati, true)) {
      $privilegi_validi[] = $privilegio;
    }
  }

  return [
    "ruoli" => $ruoli,
    "privilegi" => $privilegi_validi,
    "restrizioni" => $restrizioni
  ];
}

function tipi_mostri_db($db){
  $result = $db->query("SELECT nome FROM TipiMostri ORDER BY nome ASC");
  $tipi = [];
  while ($row = $result->fetch_assoc()) {
    $tipi[] = $row["nome"];
  }
  return $tipi;
}

function template_oggetti_utente_db($db, $username){
  $stmt = $db->prepare(
    "SELECT ID, nome, livello, descrizione, storia, valore, `rarità`, pubblico, dataCreazione " .
    "FROM TemplateOggetti WHERE Utenti = ? ORDER BY dataCreazione DESC"
  );
  if (!$stmt) {
    return [];
  }
  $stmt->bind_param("s", $username);
  $stmt->execute();
  $result = $stmt->get_result();
  $oggetti = [];
  while ($row = $result->fetch_assoc()) {
    $oggetti[] = $row;
  }
  $stmt->close();
  return $oggetti;
}

function template_oggetti_pubblici_db($db, $username){
  $stmt = $db->prepare(
    "SELECT ID, nome, livello, descrizione, storia, valore, `rarità`, pubblico, dataCreazione " .
    "FROM TemplateOggetti WHERE pubblico = 1 AND (Utenti IS NULL OR Utenti <> ?) ORDER BY dataCreazione DESC"
  );
  if (!$stmt) {
    return [];
  }
  $stmt->bind_param("s", $username);
  $stmt->execute();
  $result = $stmt->get_result();
  $oggetti = [];
  while ($row = $result->fetch_assoc()) {
    $oggetti[] = $row;
  }
  $stmt->close();
  return $oggetti;
}

function mostri_utente_db($db, $username){
  $stmt = $db->prepare(
    "SELECT ID, nome, livello, Utenti, descrizione, esperienzaData, oroDato, vita, resistenza, `velocità` AS velocita, forza, pubblico, dataCreazione " .
    "FROM Mostri WHERE Utenti = ? ORDER BY dataCreazione DESC"
  );
  if (!$stmt) {
    return [];
  }
  $stmt->bind_param("s", $username);
  $stmt->execute();
  $result = $stmt->get_result();
  $mostri = [];
  while ($row = $result->fetch_assoc()) {
    $mostri[] = $row;
  }
  $stmt->close();
  return $mostri;
}

function user_exists_db($db, $username){
  $stmt = $db->prepare("SELECT username FROM Utenti WHERE username = ? LIMIT 1");
  if (!$stmt) return false;
  $stmt->bind_param("s", $username);
  $stmt->execute();
  $res = $stmt->get_result();
  $exists = $res && $res->num_rows > 0;
  $stmt->close();
  return $exists;
}

function send_message_db($db, $mittente, $ricevente, $testo, $tipo = 'messaggio'){
  $stmt = $db->prepare(
    "INSERT INTO MessaggiUtenti (`Utenti-Mandante`, `Utenti-Ricevente`, `tipo`, `dataInvio`, `testo`, `visualizzato`) VALUES (?, ?, ?, NOW(), ?, 0)"
  );
  $stmt->bind_param("ssss", $mittente, $ricevente, $tipo, $testo);
  $stmt->execute();
  $id = $db->insert_id;
  $stmt->close();
  return $id;
}

function get_chats_for_user_db($db, $username){
  $stmt = $db->prepare(
    "SELECT `Utenti-Mandante` AS mandante, `Utenti-Ricevente` AS ricevente, tipo, dataInvio, testo, visualizzato " .
    "FROM MessaggiUtenti " .
    "WHERE `Utenti-Mandante` = ? OR `Utenti-Ricevente` = ? " .
    "ORDER BY dataInvio DESC, ID DESC"
  );
  $stmt->bind_param("ss", $username, $username);
  $stmt->execute();
  $res = $stmt->get_result();

  $conversazioni = [];
  while ($row = $res->fetch_assoc()) {
    $other = ($row['mandante'] === $username) ? $row['ricevente'] : $row['mandante'];
    if ($other === null || $other === '') {
      continue;
    }

    if (!isset($conversazioni[$other])) {
      $conversazioni[$other] = [
        'other' => $other,
        'last_messaggio' => $row['testo'] ?? '',
        'last_data' => $row['dataInvio'] ?? null,
        'unread_count' => 0,
      ];
    }

    if ($row['ricevente'] === $username && (int)($row['visualizzato'] ?? 0) === 0) {
      $conversazioni[$other]['unread_count']++;
    }

    if ($conversazioni[$other]['last_data'] === null || ($row['dataInvio'] ?? '') > $conversazioni[$other]['last_data']) {
      $conversazioni[$other]['last_messaggio'] = $row['testo'] ?? '';
      $conversazioni[$other]['last_data'] = $row['dataInvio'] ?? null;
    }
  }

  $stmt->close();

  $list = array_values($conversazioni);
  usort($list, static function ($a, $b) {
    return strcmp((string)($b['last_data'] ?? ''), (string)($a['last_data'] ?? ''));
  });

  return $list;
}

function get_messages_between_users_db($db, $username, $otherUser){
  $stmt = $db->prepare(
    "SELECT `Utenti-Mandante` AS Mittente, `Utenti-Ricevente` AS Ricevente, testo, tipo, visualizzato AS visto, dataInvio AS dataCreazione " .
    "FROM MessaggiUtenti " .
    "WHERE (`Utenti-Mandante` = ? AND `Utenti-Ricevente` = ?) OR (`Utenti-Mandante` = ? AND `Utenti-Ricevente` = ?) " .
    "ORDER BY dataInvio ASC, ID ASC"
  );
  $stmt->bind_param("ssss", $username, $otherUser, $otherUser, $username);
  $stmt->execute();
  $res = $stmt->get_result();
  $list = [];
  while ($row = $res->fetch_assoc()) $list[] = $row;
  $stmt->close();
  return $list;
}

function mark_messages_seen_db($db, $username, $otherUser){
  $stmt = $db->prepare(
    "UPDATE MessaggiUtenti SET visualizzato = 1 WHERE `Utenti-Mandante` = ? AND `Utenti-Ricevente` = ? AND visualizzato = 0"
  );
  $stmt->bind_param("ss", $otherUser, $username);
  $stmt->execute();
  $affected = $stmt->affected_rows;
  $stmt->close();
  return $affected;
}

function count_unseen_in_chat_db($db, $username, $otherUser){
  $stmt = $db->prepare(
    "SELECT COUNT(*) as c FROM MessaggiUtenti WHERE `Utenti-Mandante` = ? AND `Utenti-Ricevente` = ? AND visualizzato = 0"
  );
  $stmt->bind_param("ss", $otherUser, $username);
  $stmt->execute();
  $res = $stmt->get_result();
  $row = $res->fetch_assoc();
  $stmt->close();
  return (int)($row['c'] ?? 0);
}

function count_received_messages($db, $username){
  $stmt = $db->prepare("SELECT COUNT(*) as c FROM MessaggiUtenti WHERE `Utenti-Ricevente` = ?");
  $stmt->bind_param("s", $username);
  $stmt->execute();
  $res = $stmt->get_result();
  $row = $res->fetch_assoc();
  $stmt->close();
  return (int)($row['c'] ?? 0);
}

function moderatori_disponibili_db($db){
  $stmt = $db->prepare(
    "SELECT DISTINCT Ruoli_Utenti.Utenti as username " .
    "FROM Ruoli_Utenti " .
    "INNER JOIN Privilegi_Ruoli ON Privilegi_Ruoli.Ruoli = Ruoli_Utenti.Ruoli " .
    "INNER JOIN Privilegi ON Privilegi.nome = Privilegi_Ruoli.Privilegi " .
    "WHERE LOWER(Privilegi.tipo) = LOWER(?)"
  );
  $privType = 'Accettazione lamentele';
  $stmt->bind_param("s", $privType);
  $stmt->execute();
  $res = $stmt->get_result();
  $cands = [];
  while ($row = $res->fetch_assoc()) {
    $user = $row['username'];
    // check active restrictions
    $restr = restrizioni_utente_db($db, $user);
    $blocked = false;
    foreach ($restr as $r) {
      if (strcasecmp($r['Privilegi'], 'Accettazione lamentele') === 0) { $blocked = true; break; }
    }
    if (!$blocked) {
      $cands[] = ['username' => $user, 'count' => count_received_messages($db, $user)];
    }
  }
  usort($cands, function($a,$b){ return $a['count'] <=> $b['count']; });
  return $cands;
}


/* ------------------------ REGISTRAZIONE E LOGIN ------------------------ */


function registra_utente_db($db, $username, $email, $nome, $password, $ruolo = 'UtenteBase') {
    if (empty($username) || empty($password) || empty($nome)) {
        http_response_code(400);
        die(json_encode(["error" => "username, password e nome obbligatori"]));
    }

    // Controllo duplicati
    if ($email == null){
        $stmt = $db->prepare("SELECT username FROM Utenti WHERE username=?");
        $stmt->bind_param("s", $username);

    }

    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        http_response_code(409);
        die(json_encode(["error" => "username o email già in uso"]));
    }

    $salt = genera_salt();
    $hash = calcola_hash_password($password, $salt);
    $password_finale = $salt . $hash;

    if ($email == null) {
      $stmt = $db->prepare("INSERT INTO Utenti (username, nome, password) VALUES (?, ?, ?)");
      $stmt->bind_param("sss", $username, $nome, $password_finale);
    } else {
      $stmt = $db->prepare("INSERT INTO Utenti (username, email, nome, password) VALUES (?, ?, ?, ?)");
      $stmt->bind_param("ssss", $username, $email, $nome, $password_finale);
    }
    //var_dump($stmt);
    //print("1\n");
    $success = $stmt->execute();
    //var_dump($success);
    //print("2\n");

    if (!$success) {
        $stmt = $db->prepare("DELETE FROM Utenti WHERE username=?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        http_response_code(500);
        die(json_encode(["error" => "Errore durante la registrazione"]));
    } else {

        $stmt = $db->prepare("INSERT INTO `Ruoli_Utenti` (`ID`, `Utenti`, `Ruoli`) VALUES (NULL, ?, ?);");
        $stmt->bind_param("ss", $username, $ruolo);
        //print("3\n");
        $success = $stmt->execute();
        if ($success) {
          return ["success" => true, "username" => $username];
        }
        /*
        $stmt = $db->prepare("SELECT username FROM Utenti WHERE username=?");
        $stmt->bind_param("s", $username);
        $success = $stmt->execute();
        if(!$success) {
            http_response_code(500);
            die(json_encode(["error" => "Errore durante la registrazione"]));
        }
        //print("4\n");
        $result = $stmt->get_result();
        $user = $result->fetch_assoc();
        if ($user["username"] == $username) {
            return ["success" => true, "username" => $user["username"]];

        } else {
            http_response_code(500);
            die(json_encode(["error" => "Errore durante la registrazione"]));

        }*/
        //print("5\n");
    }
}

function crea_mostro_db($db, Mostro $mostro){
  try {
    // Inserimento diretto: la struttura del DB gestisce già i valori di default e i vincoli.
    $stmt = $db->prepare(
      "INSERT INTO Mostri (nome, livello, Utenti, descrizione, esperienzaData, oroDato, vita, resistenza, `velocità`, forza, pubblico) " .
      "VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)"
    );

    [$nome, $livello, $utenti, $descrizione, $esperienzaData, $oroDato, $vita, $resistenza, $velocita, $forza, $pubblico] = $mostro->toDbValues();

    $stmt->bind_param(
      "sissiiiiiii",
      $nome,
      $livello,
      $utenti,
      $descrizione,
      $esperienzaData,
      $oroDato,
      $vita,
      $resistenza,
      $velocita,
      $forza,
      $pubblico
    );

    $stmt->execute();

    $mostroId = $db->insert_id;

    $tipiMostri = array_values(array_unique($mostro->tipiMostri ?? []));
    foreach ($tipiMostri as $tipoMostro) {
      if ($tipoMostro === null || $tipoMostro === '') {
        continue;
      }
      $stmt = $db->prepare("INSERT INTO TipiMostriMostri (Mostri, TipiMostri) VALUES (?, ?)");
      $stmt->bind_param("is", $mostroId, $tipoMostro);
      $stmt->execute();
    }

    $oggetti = array_values(array_unique(array_merge($mostro->oggettiUtente ?? [], $mostro->oggettiPubblici ?? [])));
    foreach ($oggetti as $oggettoId) {
      if ($oggettoId === null || $oggettoId === '') {
        continue;
      }
      $oggettoId = (int)$oggettoId;
      $numero = 1;
      $stmt = $db->prepare("INSERT INTO TemplateOggettiMostri (Mostri, TemplateOggetti, numero) VALUES (?, ?, ?)");
      $stmt->bind_param("iii", $mostroId, $oggettoId, $numero);
      $stmt->execute();
    }

    return [
      "success" => true,
      "id" => $mostroId,
      "nome" => $nome
    ];
  } catch (Exception $e) {
    return [
      "success" => false,
      "error" => $e->getMessage()
    ];
  }
}

function login_utente_db($db, $username, $password){
  $stmt = $db->prepare(
    "SELECT Utenti.username, Utenti.password " .
    "FROM Utenti " .
    "WHERE Utenti.username=?"
  );
  $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    if (!$user) {
        http_response_code(401);
        die(json_encode(["error" => "Credenziali non valide"]));
    }

    $password_db = $user['password'];
    $salt = substr($password_db, 0, 32);
    $hash_db = substr($password_db, 32);

    $hash_calcolato = calcola_hash_password($password, $salt);

    if (!hash_equals($hash_db, $hash_calcolato)) {
        http_response_code(401);
        die(json_encode(["error" => "Credenziali non valide"]));
    }

    // Genera JWT
    $payload = [
      "iat" => time(),
      "nbf" => time(),
      "exp" => time() + JWT_EXP,
      "iss" => JWT_ISSUER,
      "aud" => JWT_AUDIENCE,
      "sub" => $user["username"],
      "username" => $user["username"]
    ];

    $permessi = permessi_validi_utente_db($db, $user["username"]);
    $payload["ruoli"] = $permessi["ruoli"];
    $payload["privilegi"] = $permessi["privilegi"];
    $payload["restrizioni"] = $permessi["restrizioni"];

    $token = JWT::encode($payload, JWT_SECRET, 'HS256');

    /*setcookie(
      "Jungleon_token",
      $token,
      [
        "expires" => time() + JWT_EXP,
        "path" => "/Jungleon/",
        "httponly" => false,
        "secure" => false,
        "samesite" => "Lax"

      ]

    );*/

    return [
      "success" => true,
      "token" => $token,
      "expires_in" => JWT_EXP,
      "username" => $user["username"],
      "ruoli" => $permessi["ruoli"],
      "privilegi" => $permessi["privilegi"],
      "restrizioni" => $permessi["restrizioni"]
    ];
}


function ruoli_db($db){
    $result = $db->query("SELECT * from Ruoli ORDER BY Nome DESC");
    $risp=array();
    while($row = $result->fetch_assoc()) $risp[]=$row;
    return $risp;
}



function ruolo_db($db,$nome){
  //$cancella=$db->query("delete from games_partite WHERE PLAYER2 IS NULL AND CREATED_AT < NOW() - INTERVAL 1 DAY	");
  
  $result = $db->query("SELECT * from Ruoli WHERE Nome='$nome' ORDER BY Nome DESC");
  $risp=array();
  while($row = $result->fetch_assoc())
    $risp[]=$row;
  return $risp;
}

function ruolo_utente_db($db, $username){
  if (!$username) {
    return null;
  }

  $stmt = $db->prepare("SELECT Ruoli FROM Ruoli_Utenti WHERE Utenti=? ORDER BY dataAssegnazione DESC LIMIT 1");
  if (!$stmt) {
    return null;
  }

  $stmt->bind_param("s", $username);
  $stmt->execute();
  $result = $stmt->get_result();
  $row = $result->fetch_assoc();
  $stmt->close();

  return $row["Ruoli"] ?? null;
}

function permessi_ruolo_db($db, $ruolo){
  if (!$ruolo) {
    return [];
  }

  $stmt = $db->prepare(
    "SELECT DISTINCT Privilegi.nome, Privilegi.tipo, Privilegi.descrizione " .
    "FROM Privilegi " .
    "INNER JOIN Privilegi_Ruoli ON Privilegi_Ruoli.Privilegi = Privilegi.nome " .
    "WHERE Privilegi_Ruoli.Ruoli = ? " .
    "ORDER BY Privilegi.nome ASC"
  );

  if (!$stmt) {
    return [];
  }

  $stmt->bind_param("s", $ruolo);
  $stmt->execute();
  $result = $stmt->get_result();

  $permessi = [];
  while ($row = $result->fetch_assoc()) {
    if (isset($row["nome"])) {
      $permessi[] = [
        "nome" => $row["nome"],
        "tipo" => $row["tipo"] ?? null,
        "descrizione" => $row["descrizione"] ?? null
      ];
    }
  }

  $stmt->close();
  return $permessi;
}

function dungeons_db($db, $pagina){
  //$cancella=$db->query("delete from games_partite WHERE PLAYER2 IS NULL AND CREATED_AT < NOW() - INTERVAL 1 DAY	");
  $pg1 = 1*$pagina;
  $pg2 = 1*($pagina-1);
  //print_r("PG1: $pg1 - PG2: $pg2\n");
  if($pg2 <= 0)
    $result = $db->query('SELECT * from Dungeons WHERE Pubblico = "True" ORDER BY dataCreazione DESC LIMIT 45');
  else
    $result = $db->query("(SELECT * from Dungeons WHERE Pubblico = \"True\" ORDER BY dataCreazione DESC LIMIT $pg1) EXCEPT (SELECT * from Dungeons WHERE Pubblico = \"True\" ORDER BY dataCreazione DESC LIMIT $pg2)");
  //var_dump($result);
  $risp=array();
  while($row = $result->fetch_assoc())
    $risp[]=$row;
  return $risp;
}
function altriDungeons_db($db, $pagina){
  #$cancella=$db->query("delete from games_partite WHERE PLAYER2 IS NULL AND CREATED_AT < NOW() - INTERVAL 1 DAY	");
  $pg1=1*$pagina;
  $pg2=1*($pagina-1);
  $result = $db->query("(SELECT * from Dungeons WHERE Pubblico = True ORDER BY dataCreazione DESC LIMIT $pg1) - (SELECT * from Dungeons WHERE Pubblico = True ORDER BY dataCreazione DESC LIMIT $pg2)");
  $risp=array();
  while($row = $result->fetch_assoc())
    $risp[]=$row;
  return $risp;
}

function dungeon_db($db,$ID){
  #$cancella=$db->query("delete from games_partite WHERE PLAYER2 IS NULL AND CREATED_AT < NOW() - INTERVAL 1 DAY	");
  
  $result = $db->query("SELECT * from Dungeons WHERE ID = $ID");
  $risp=array();
  while($row = $result->fetch_assoc())
    $risp[]=$row;
  return $risp;
}

function dungeonsFiltrati_db($db,$filtro){
  
  switch($filtro){
    case "": 
      $filtro=""; 
      break;
      
    case null: 
      $filtro=""; 
      break;

    default: $filtro=$db->real_escape_string($filtro); break;
  }

  //$result = $db->query("SELECT * from Dungeons WHERE Pubblico = True AND (Nome LIKE '%$filtro%' OR Descrizione LIKE '%$filtro%') ORDER BY dataCreazione DESC");
  $risp=array();
  //while($row = $result->fetch_assoc())
    //$risp[]=$row;
  return $risp;
}
  
// function insert_partita($db,$player){
// if (strpos(strtoupper($player), "GRANA")!==false)
//     return -1;
//   $stmt = $db->prepare("INSERT INTO games_partite(PLAYER1) VALUES (?)");
//   $stmt->bind_param("s", $player); 
//   $stmt->execute();
//   return $db->insert_id;
// }

function verifica_jwt() {
    // Prova a recuperare l'header Authorization in vari modi
    $authHeader = null;
    
    // Metodo 1: $_SERVER
    if (isset($_SERVER['HTTP_AUTHORIZATION'])) {
        $authHeader = $_SERVER['HTTP_AUTHORIZATION'];
    } elseif (isset($_SERVER['REDIRECT_HTTP_AUTHORIZATION'])) {
        $authHeader = $_SERVER['REDIRECT_HTTP_AUTHORIZATION'];
    }
    
    // Metodo 2: getallheaders() se disponibile
    if (!$authHeader && function_exists('getallheaders')) {
        $headers = getallheaders();
        $authHeader = $headers['Authorization'] ?? $headers['authorization'] ?? null;
    }
    
    // Metodo 3: apache_request_headers() se disponibile
    if (!$authHeader && function_exists('apache_request_headers')) {
        $headers = apache_request_headers();
        $authHeader = $headers['Authorization'] ?? $headers['authorization'] ?? null;
    }
    
    if (!$authHeader) {
        error_log("verifica_jwt: Token mancante - Headers disponibili: " . json_encode($_SERVER));
        errore(401, "Token mancante");
    }

    if (!preg_match('/Bearer\s(\S+)/', $authHeader, $matches)) {
        error_log("verifica_jwt: Formato token non valido - Header: " . $authHeader);
        errore(401, "Formato token non valido");
    }

    $jwt = $matches[1];

    try {
        $decoded = JWT::decode($jwt, new Key(JWT_SECRET, 'HS256'));
      return $decoded; // contiene username, privilegi e restrizioni
    } catch (Exception $e) {
        error_log("verifica_jwt: Errore decode - " . $e->getMessage());
        errore(401, "Token non valido o scaduto");
    }
}

function nomi_da_claim_privilegi($claim){
  $nomi = [];
  foreach ((array)$claim as $item) {
    if (is_string($item)) {
      $nomi[] = $item;
      continue;
    }

    if (is_array($item)) {
      foreach (["nome", "Nome", "Privilegi"] as $chiave) {
        if (isset($item[$chiave])) {
          $nomi[] = $item[$chiave];
          break;
        }
      }
      continue;
    }

    if (is_object($item)) {
      foreach (["nome", "Nome", "Privilegi"] as $chiave) {
        if (isset($item->{$chiave})) {
          $nomi[] = $item->{$chiave};
          break;
        }
      }
    }
  }

  return array_values(array_unique(array_filter($nomi, static fn($val) => $val !== null && $val !== '')));
}

function token_ha_privilegio($decoded, $nomePrivilegio){
  $privilegi = nomi_da_claim_privilegi($decoded->privilegi ?? []);
  $restrizioni = nomi_da_claim_privilegi($decoded->restrizioni ?? []);

  return in_array($nomePrivilegio, $privilegi, true) && !in_array($nomePrivilegio, $restrizioni, true);
}


function insert_ruolo($db,$ruolo){                                                                               //!!!!!!Moficato!!!!!!!!
if (strpos(strtoupper($ruolo), "GRANA")!==false)
    return -1;
  $stmt = $db->prepare("INSERT INTO games_partite(PLAYER1) VALUES (?)");
  $stmt->bind_param("s", $ruolo); 
  $stmt->execute();
  return $db->insert_id;
}



// function insert_mossa($db,$partita,$player,$mossa){
	
//   $stmt = $db->prepare("SELECT * from games_partite WHERE ID=?");
//   $stmt->bind_param("i", $partita); 
//   $stmt->execute();
//   $result = $stmt->get_result();
//   $row = $result->fetch_assoc();
//   if ($row==null)
//   return -1;
//   if ( $row["PLAYER2"]==null)
//   return -2;
//   if ( $player==null)
//   return -2;
  
//   /*if ($row["PLAYER1"]!=$player && $row["PLAYER2"]!=$player)*/
//   if ($row["PLAYER1"]!=$player && $row["PLAYER2"]!=$player && $row["PLAYER3"]!=$player && $row["PLAYER3"]!=$player &&
//   $row["PLAYER4"]!=$player && $row["PLAYER5"]!=$player && $row["PLAYER6"]!=$player && $row["PLAYER7"]!=$player)
//   return -3;
  
//   $stmt = $db->prepare("INSERT INTO games_mosse(MOSSA,PLAYER,GAME) VALUES (?,?,?)");
//   $stmt->bind_param("ssi", $mossa,$player,$partita); 
//   $stmt->execute();
//   return $db->insert_id;
// }


// function mosse($db,$partita){
//   $stmt = $db->prepare("SELECT * FROM games_partite WHERE ID=?");
//   $stmt->bind_param("i", $partita); 
//   $stmt->execute();
//   $result = $stmt->get_result();
//   if ($result->num_rows==0)
//   	return -1;
    
//   $stmt = $db->prepare("SELECT * from games_mosse WHERE GAME=? ORDER BY ID DESC");
//   $stmt->bind_param("i", $partita); 
//   $stmt->execute();
//   $result = $stmt->get_result();
//   $ris=array();
//   while($row = $result->fetch_assoc()) $ris[]=$row;
//   return $ris;
// }


// function last_mossa($db,$partita){
//   $stmt = $db->prepare("SELECT * FROM games_partite WHERE ID=?");
//   $stmt->bind_param("i", $partita); 
//   $stmt->execute();
//   $result = $stmt->get_result();
//   if ($result->num_rows==0)
//   	return -1;
    
//   $stmt = $db->prepare("SELECT * from games_mosse WHERE GAME=? ORDER BY ID DESC LIMIT 1");
//   $stmt->bind_param("i", $partita); 
//   $stmt->execute();
//   $result = $stmt->get_result();
//   $row = $result->fetch_assoc();
//   return $row;
//   }


// function join_partita($db,$partita,$player){
// if (strpos(strtoupper($player), "GRANA")!==false)
//     return -2;

//   $partite=ruolo_db($db,7);
//   $find=false;
//   foreach ($partite as $p)
//     if ($p["ID"]==$partita){ 
//     $find=true;
//     $n=-1;
//     for ($i=1;$i<=7;$i++){//
//     	$giocatore="PLAYER".$i;
//     	if ($p[$giocatore]==$player)
//       		return -1;
    	
//         if ($p[$giocatore]==null && $n==-1)//
//         	$n=$i;//
//         }
//     }
//   if (!$find) return 0;
//   //echo $n;
//   $stmt = $db->prepare("UPDATE games_partite SET PLAYER$n=? WHERE ID=?");//PLAYER2
//   $stmt->bind_param("si", $player,$partita); 
//   if ($stmt->execute()) return 1;
//   else return -2;
// }



function errore($tipo,$error){
	http_response_code($tipo);
  header("Content-Type: application/json; charset=utf-8");
  die(json_encode([
    "error" => $error,
    "status" => $tipo
  ]));
}

function rispondi_json($data){
	http_response_code(200);
  header("Content-Type: application/json; charset=utf-8");
	echo json_encode($data,JSON_INVALID_UTF8_IGNORE);
}


//menage bearer token JWT
function verifica_token(){
  if(isset($_SERVER["HTTP_AUTHORIZATION"]))
  {
      $token = trim(str_replace("Bearer", "", $_SERVER["HTTP_AUTHORIZATION"]));
      try {
          $decoded = JWT::decode($token, new Key(JWT_SECRET, 'HS256'));
          // Token valido, procedi con la richiesta
      } catch (Exception $e) {
          errore(401, "Token non valido o scaduto "+ $e->getMessage());
      }
  } else {
      // Nessun token fornito
      errore(401, "Token mancante");
  }
}

/* ------------------------ GESTIONE ROTTE ------------------------ */



class risposta{
    public $method;
    public $action;
    public $data;

    public function __construct($m,$a,$d) {
        $this->method = $m;
        $this->action = $a;
        $this->data = $d;
    }

}

// Allow from any origin
/*if(isset($_SERVER["HTTP_ORIGIN"]))
{
    // You can decide if the origin in $_SERVER['HTTP_ORIGIN'] is something you want to allow, or as we do here, just allow all
    header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
}
else
{
    //No HTTP_ORIGIN set, so we allow any. You can disallow if needed here
    header("Access-Control-Allow-Origin: *");
}*/

// Allow same origin requests
// if (isset($_SERVER["HTTP_ORIGIN"]) /*&& $_SERVER["HTTP_ORIGIN"]=="https://crispy-space-invention-7v7q7wx7r7xrfx66w-80.app.github.dev"*/)
// {
//     header("Access-Control-Allow-Origin: {https://crispy-space-invention-7v7q7wx7r7xrfx66w-80.app.github.dev}");
//     header("Access-Control-Allow-Credentials: true");
//     header("Access-Control-Max-Age: 6400");    // cache for 10 minutes
// }
// else
// {
//   //echo("ciao");
//   die(documentazione());
//     //header("Access-Control-Allow-Origin: *");
// }

// header("Access-Control-Allow-Credentials: true");
// header("Access-Control-Max-Age: 600");    // cache for 10 minutes



/*
if($_SERVER["REQUEST_METHOD"] === "OPTIONS")
{
  if (isset($_SERVER["HTTP_ACCESS_CONTROL_REQUEST_METHOD"]))
    header("Access-Control-Allow-Methods: POST, GET, OPTIONS, DELETE, PUT"); //Make sure you remove those you do not want to support

  if (isset($_SERVER["HTTP_ACCESS_CONTROL_REQUEST_HEADERS"]))
    header("Access-Control-Allow-Headers: {$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}");

  //Just exit with 200 OK with the above headers for OPTIONS method
  exit(0);
}*/



//From here, handle the request as it is ok
   
//header("Access-Control-Allow-Credentials: true");
//header("Access-Control-Allow-Headers: X-Requested-With, Content-Type, Origin, Cache-Control, Pragma, Authorization, Accept, Accept-Encoding");
//header("Access-Control-Allow-Methods: GET,POST, OPTIONS");
//header("Content-Type: application/json; charset= utf-8");                                       !!!POTREBBE SERVIRE, QUINDI IN CASO DECOMMENTALO!!!
$oggetto=null;

if (gestisci_URI()[0]=="")
  die (documentazione());

$parametri=gestisci_URI();
if (is_null($parametri)){
  documentazione();
}


/*if (!isset($_SERVER['PHP_AUTH_USER'])) {
  header('WWW-Authenticate: bearer realm="Jungleon API"');
  header('HTTP/1.0 401 Unauthorized');
  errore(401,"bearer Auth required");                                           !!!CHIEDI AL PROFESSORE SE SERVE!!!
  exit;

} else {*/
  /*if ($_SERVER['PHP_AUTH_USER']!="Fire17Jungleon" && $_SERVER['PHP_AUTH_USER']!="4IE" 
  || $_SERVER['PHP_AUTH_PW']!="Jungleon17Stone" && $_SERVER['PHP_AUTH_PW']!="Falzone")
    errore(401,"Basic Auth error. Auth_user or password not valid");
  */
  //else{
    
      
    //rispondi_json($parametri);
    //die;
    
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      if (!isset($parametri[0]))
          errore(400,"something expexted");

      switch($parametri[0]){
        case "Register":
            $data = json_decode(file_get_contents('php://input'));
            if (!isset($data->username, $data->nome, $data->password)) {
                http_response_code(400);
                die(json_encode(["error" => "Dati mancanti"]));
            }
            $risposta = registra_utente_db(db_connect(), $data->username, $data->email ?? null, $data->nome, $data->password);
            header("Content-Type: application/json; charset= utf-8");
            $oggetto = new risposta("POST", "Registration completed", $risposta);
            break;


        case "Mostro":
          $data = json_decode(file_get_contents('php://input'));
          if (!$data) {
            errore(400, "JSON non valido");
          }

          $decoded = verifica_jwt();
          $usernameToken = $decoded->username ?? $decoded->sub ?? null;
          if (!$usernameToken) {
            errore(401, "Token senza username");
          }

          if (!token_ha_privilegio($decoded, "Crea Mostri")) {
            errore(403, "Privilegio Crea Mostri non disponibile");
          }

          if (isset($data->Utenti) && $data->Utenti !== $usernameToken) {
            errore(403, "Utente non coerente con il token");
          }

          $data->Utenti = $usernameToken;

          if (!empty($data->pubblico) && (int)$data->pubblico === 1 && !token_ha_privilegio($decoded, "Pubblicazione")) {
            errore(403, "Privilegio Pubblicazione non disponibile");
          }

          $mostro = Mostro::fromRequest($data);
          $risposta = crea_mostro_db(db_connect(), $mostro);
          if (!$risposta["success"]) {
            errore(500, $risposta["error"]);
          }

          header("Content-Type: application/json; charset= utf-8");
          $oggetto = new risposta("POST", "Monster created", $risposta);
          break;

        case "Messaggi":
          // invia un messaggio a un altro utente
          $data = json_decode(file_get_contents('php://input'));
          if (!$data || !isset($data->to) || !isset($data->testo)) {
            errore(400, "to e testo richiesti");
          }
          $decoded = verifica_jwt();
          $from = $decoded->username ?? $decoded->sub ?? null;
          if (!$from) errore(401, "Token senza username");

          $to = trim($data->to);
          if (!user_exists_db(db_connect(), $to)) {
            errore(404, "Utente destinatario non trovato");
          }

          if ($from === $to) errore(400, "Non è possibile inviare un messaggio a se stessi");

          $id = send_message_db(db_connect(), $from, $to, $data->testo, 'messaggio');
          header("Content-Type: application/json; charset= utf-8");
          $oggetto = new risposta("POST", "Messaggio inviato", ["success"=>true, "id"=>$id, "destinatario"=>$to]);
          break;

        case "Lamentela":
          // invia una lamentela a un moderatore scelto automaticamente
          $data = json_decode(file_get_contents('php://input'));
          if (!$data || !isset($data->testo) || !isset($data->tipo)) {
            errore(400, "tipo e testo richiesti");
          }
          $decoded = verifica_jwt();
          $from = $decoded->username ?? $decoded->sub ?? null;
          if (!$from) errore(401, "Token senza username");

          $cands = moderatori_disponibili_db(db_connect());
          if (empty($cands)) errore(500, "Nessun moderatore disponibile");
          $moderatore = $cands[0]['username'];

          $id = send_message_db(db_connect(), $from, $moderatore, $data->testo, 'lamentela');
          header("Content-Type: application/json; charset= utf-8");
          $oggetto = new risposta("POST", "Lamentela inviata", ["success"=>true, "id"=>$id]);
          break;


        case "Login":
          //effettua login
            $data = json_decode(file_get_contents('php://input'));
            if (!isset($data->username, $data->password)) {
                http_response_code(400);
                die(json_encode(["error" => "username o password mancanti"]));
            }
            $jwt = login_utente_db(db_connect(), $data->username, $data->password);
            header("Content-Type: application/json; charset= utf-8");
            $oggetto=new risposta("POST","Login completed",$jwt);
            break;


        case "Ruolo":
          if (!isset($parametri[1]))
            errore(400,"Ruolo atteso");
          else { 
            //inserisci ruolo
            $ruolo["nome"]=insert_ruolo(db_connect(),$parametri[1]);
            switch($ruolo["nome"]){
              case "": 	errore(400,"Role name error");
            }
            header("Content-Type: application/json; charset= utf-8");
            $oggetto=new risposta("POST","New Role created",$ruolo);
          }
          break;
        

        // case "Partita":
        //   if (!isset($parametri[1]))
        //     errore(400,"player expected");
        //   else { 
        //     //inserisci partita
        //     $partita["id"]=insert_partita(db_connect(),$parametri[1]);
        //     switch($partita["id"]){
        //       case -1: 	errore(400,"Player name error");
        //     }
        //     header("Content-Type: application/json; charset= utf-8");
        //     $oggetto=new risposta("POST","New match created",$partita);
        //   }
        //   break;

        default:
            errore(400,"Request error");
            break;
      }
/*
      if ($parametri[0]=="partita"){
        if (!isset($parametri[1]))
          errore(400,"player expected");
        else { 
          //inserisci partita
          $partita["id"]=insert_partita(db_connect(),$parametri[1]);
          switch($partita["id"]){
            case -1: 	errore(400,"Player name error");
          }
          $oggetto=new risposta("POST","New match created",$partita);
        }
      }
        else if ($parametri[0]=="mossa"){
    //inserisci mossa
            if (!isset($parametri[1]))
              errore(400,"ID partita expected");
            else if(!isset($parametri[2]))
              errore(400,"player expected");
            else if (!isset($parametri[3]))
              errore(400,"mossa expected");
            else{
              $mossa=array();
              $mossa["id_partita"]=$parametri[1];
              $mossa["player"]=$parametri[2];
              $mossa["mossa"]=$parametri[3];
              $id=insert_mossa(db_connect(),$mossa["id_partita"],$mossa["player"],$mossa["mossa"]);
              switch($id){
      case -2: 	errore(400,"Match is waiting for player join");
      case -3: 	errore(400,"Player name error");
      case -1: 	errore(400,"Match is not avaiabled");
      default:  $mossa["id"]=$id;$oggetto=new risposta("POST","Insert your play",$mossa);
              }
            }
              
        }
        else if ($parametri[0]=="join"){
      if (!isset($parametri[1]))
              errore(400,"ID partita expected");
            else if(!isset($parametri[2]))
              errore(400,"player expected");
            else{
              $partita=array();
                $partita["id"]=$parametri[1];
                $partita["player"]=$parametri[2];
                $ris=join_partita(db_connect(),$partita["id"],$partita["player"]);
                if ($ris==1)
                $oggetto=new risposta("POST","connected to the match",$partita);
                else if ($ris==0)
                  errore(400,"Match not avaiable");
                else if ($ris==-1)
                    errore(400,"Player name already used");
                  else if ($ris==-2)
                    errore(400,"Player name error");
                else errore(500,"DB error");
        }
        
    }
      else
          errore(400,"Request error");*/          

    } else if ($_SERVER['REQUEST_METHOD'] === 'GET') {                                                              #modificato!!!!!!!!!!!!!!!!!!!!!!!!!!!
      if (!isset($parametri[0]))
        errore(400,"something expected");

      switch ($parametri[0]) {
        case "Ruoli":
          $ruoli=array();
          $ruoli=ruoli_db(db_connect());
          //for ($i=0;$i<10;$i++) $partita[]=rand(1,100);
          //elenco partite disponibili
          header("Content-Type: application/json; charset= utf-8");
          $oggetto=new risposta("GET","ruoli esistenti",$ruoli);
          //var_dump($oggetto);
          break;

        case "Ruolo":
          if (!isset($parametri[1]))
            errore(400,"Nome ruolo richiesto");

          $nome=$parametri[1];
          $ruolo=array();
          $ruolo=ruolo_db(db_connect(),$nome);
          //for ($i=0;$i<10;$i++) $partita[]=rand(1,100);
          //elenco partite disponibili
          header("Content-Type: application/json; charset= utf-8");
          $oggetto=new risposta("GET","Ruolo richiesto",$ruolo);
          //var_dump($oggetto);
          break;

        case "RuoloUtente":
          $decoded = verifica_jwt();
          $username = $decoded->username ?? $decoded->sub ?? null;
          if (!$username) {
            errore(400, "username mancante nel token");
          }

          $datiRuolo = permessi_validi_utente_db(db_connect(), $username);

          header("Content-Type: application/json; charset= utf-8");
          $oggetto=new risposta("GET","Ruolo utente", [
            "username" => $username,
            "ruoli" => $datiRuolo["ruoli"],
            "ruoloPrincipale" => $datiRuolo["ruoli"][0] ?? null
          ]);
          break;

        case "PermessiUtente":
          $decoded = verifica_jwt();
          $username = $decoded->username ?? $decoded->sub ?? null;
          if (!$username) {
            errore(400, "username mancante nel token");
          }

          $permessi = permessi_validi_utente_db(db_connect(), $username);
          header("Content-Type: application/json; charset= utf-8");
          $oggetto=new risposta("GET","Permessi utente", [
            "username" => $username,
            "ruoli" => $permessi["ruoli"],
            "permessi" => $permessi["privilegi"],
            "restrizioni" => $permessi["restrizioni"]
          ]);
          break;

        case "Dungeons":
          if (!isset($parametri[1])){
            $pagina=1;
          } else {
            $pagina=$parametri[1];
          }
          $dungeons=array();
          $dungeons=dungeons_db(db_connect(), $pagina);
          header("Content-Type: application/json; charset= utf-8");
          $oggetto=new risposta("GET","dungeons esistenti",$dungeons);
          //var_dump($oggetto);
          break;

        case "Dungeon":
          if (!isset($parametri[1]))
            errore(400,"ID dungeon richiesto");

          $ID=$parametri[1];
          $dungeon=array();
          $dungeon=dungeon_db(db_connect(),$ID);
          header("Content-Type: application/json; charset= utf-8");
          $oggetto=new risposta("GET","Dungeon richiesto",$dungeon);
          //var_dump($oggetto);
          break;

        case "DungeonsFiltrati":
          $dungeons=array();
          if (!isset($parametri[1]))
            errore(400,"filtro richiesto");
          $filtro=$parametri[1];
          $dungeons=dungeonsFiltrati_db(db_connect(),$filtro);
          header("Content-Type: application/json; charset= utf-8");
          $oggetto=new risposta("GET","dungeons filtrati",$dungeons);
          //var_dump($oggetto);
          break;

        case "TipiMostri":
          $tipi = tipi_mostri_db(db_connect());
          header("Content-Type: application/json; charset= utf-8");
          $oggetto = new risposta("GET", "Tipi mostri", $tipi);
          break;

        case "Chats":
          if (!isset($parametri[1])) errore(400, "username richiesto");
          $username = $parametri[1];
          $chats = get_chats_for_user_db(db_connect(), $username);
          header("Content-Type: application/json; charset= utf-8");
          $oggetto = new risposta("GET", "Chats utente", $chats);
          break;

        case "Chat":
          if (!isset($parametri[1])) errore(400, "chat id richiesto");
          $otherUser = $parametri[1];
          if (!isset($parametri[2])) errore(400, "azione richiesta");
          $azione = $parametri[2];
          if ($azione === 'Messaggi'){
            $decoded = verifica_jwt();
            $username = $decoded->username ?? $decoded->sub ?? null;
            if (!$username) errore(401, "Token senza username");
            $msg = get_messages_between_users_db(db_connect(), $username, $otherUser);
            header("Content-Type: application/json; charset= utf-8");
            $oggetto = new risposta("GET", "Messaggi chat", $msg);
            break;
          } elseif ($azione === 'Visto'){
            // mark as seen only if there are unseen messages
            $decoded = verifica_jwt();
            $username = $decoded->username ?? $decoded->sub ?? null;
            if (!$username) errore(401, "Token senza username");
            $count = count_unseen_in_chat_db(db_connect(), $username, $otherUser);
            if ($count <= 0) errore(400, "Nessun messaggio non letto");
            $affected = mark_messages_seen_db(db_connect(), $username, $otherUser);
            header("Content-Type: application/json; charset= utf-8");
            $oggetto = new risposta("POST", "Messaggi marcati come visti", ["count"=>$affected]);
            break;
          } else {
            errore(400, "azione chat non riconosciuta");
          }

        case "Moderatori":
          $mods = moderatori_disponibili_db(db_connect());
          header("Content-Type: application/json; charset= utf-8");
          $oggetto = new risposta("GET", "Moderatori disponibili", $mods);
          break;

        case "TemplateOggettiUtente":
          if (!isset($parametri[1])) {
            errore(400, "username richiesto");
          }
          $oggetti = template_oggetti_utente_db(db_connect(), $parametri[1]);
          header("Content-Type: application/json; charset= utf-8");
          $oggetto = new risposta("GET", "Oggetti utente", $oggetti);
          break;

        case "TemplateOggettiPubblici":
          if (!isset($parametri[1])) {
            errore(400, "username richiesto");
          }
          $oggetti = template_oggetti_pubblici_db(db_connect(), $parametri[1]);
          header("Content-Type: application/json; charset= utf-8");
          $oggetto = new risposta("GET", "Oggetti pubblici", $oggetti);
          break;

        case "MostriUtente":
          if (!isset($parametri[1])) {
            errore(400, "username richiesto");
          }
          $mostri = mostri_utente_db(db_connect(), $parametri[1]);
          header("Content-Type: application/json; charset= utf-8");
          $oggetto = new risposta("GET", "Mostri utente", $mostri);
          break;

        default:
          errore(400,"Request error");
          break;
      }
    }
    else
        errore(405,"Method not allowed");

    array_push($parametri,$oggetto);
    rispondi_json($oggetto);

	//}
//}
?>