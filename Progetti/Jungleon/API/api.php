<?php
/*
header("content-type: application/json; charset= utf-8");
die(json_encode($_SERVER));*/
require __DIR__ . '/vendor/autoload.php';

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
	    <h2 class="alert alert-danger" title="Rivolgiti ad un moderatore" alt="Rivolgiti ad un moderatore">BASIC AUTH REQUIRED</h2>
        
       	
        <h3 class="alert alert-warning">Crea nuovo ruolo</h3>
        <div class="jumbotron">
            method : POST <br/>
            endpoint : https://scaling-potato-7v7q7wx7rrwqhx6wq-80.app.github.dev/Progetti/Jungleon/API/Ruolo <br/>                                             <!-- da implementare -->
            returned data: Nome Ruolo 
        </div>

        <h3 class="alert alert-success">Registrazione utente</h3>
        <div class="jumbotron">
            method : POST <br/>
            endpoint : https://scaling-potato-7v7q7wx7rrwqhx6wq-80.app.github.dev/Progetti/Jungleon/API/Register <br/>                                    <!-- da implementare -->
            returned data: stato (True), ID utente 
        </div>

        <h3 class="alert alert-success">Login</h3>
        <div class="jumbotron">
            method : GET <br/>
            endpoint : https://scaling-potato-7v7q7wx7rrwqhx6wq-80.app.github.dev/Progetti/Jungleon/API/Login <br/>                                    <!-- da implementare -->
            returned data: JWT token, scadenza token 
        </div>

        <h3 class="alert alert-secondary">Join to new game</h3>
        <div class="jumbotron">
            method : POST <br/>
            endpoint : https://scaling-potato-7v7q7wx7rrwqhx6wq-80.app.github.dev/Progetti/Jungleon/API/??? <br/>                                             <!-- da implementare -->
            returned data: game's ID 
        </div>

        <h3 class="alert alert-secondary">Insert your move</h3>
        <div class="jumbotron">
            method : POST <br/>
            endpoint : https://scaling-potato-7v7q7wx7rrwqhx6wq-80.app.github.dev/Progetti/Jungleon/API/??? <br/>                                             <!-- da implementare -->
            returned data: move's ID 
        </div>

        <h3 class="alert alert-success">Ruoli esistenti</h3>
        <div class="jumbotron">
            method : GET <br/>
            endpoint : https://scaling-potato-7v7q7wx7rrwqhx6wq-80.app.github.dev/Progetti/Jungleon/API/Ruoli <br/>                                    <!-- da implementare -->
            returned data: Ruoli LIST 
        </div>
        
        <h3 class="alert alert-success">Ruolo per Nome</h3>
        <div class="jumbotron">
            method : GET <br/>
            endpoint : https://scaling-potato-7v7q7wx7rrwqhx6wq-80.app.github.dev/Progetti/Jungleon/API/Ruolo/{NomeRuolo(string)} <br/>                                             <!-- da implementare -->
            returned data: Ruoli LIST(1)  
        </div>
		
        <h3 class="alert alert-success">Dungeons pubblici</h3>
        <div class="jumbotron">
            method : GET <br/>
            endpoint : https://scaling-potato-7v7q7wx7rrwqhx6wq-80.app.github.dev/Progetti/Jungleon/API/Dungeons <br/>                                             <!-- da implementare -->
            returned data: Dungeons LIST(45)  
        </div>

        <h3 class="alert alert-success">Dungeons pubblici per pagina</h3>
        <div class="jumbotron">
            method : GET <br/>
            endpoint : https://scaling-potato-7v7q7wx7rrwqhx6wq-80.app.github.dev/Progetti/Jungleon/API/Dungeons/{pagina(int)} <br/>                                             <!-- da implementare -->
            returned data: Dungeons LIST(45)  
        </div>

        <h3 class="alert alert-success">Dungeon per ID</h3>
        <div class="jumbotron">
            method : GET <br/>
            endpoint : https://scaling-potato-7v7q7wx7rrwqhx6wq-80.app.github.dev/Progetti/Jungleon/API/Dungeons/{ID(int)} <br/>                                             <!-- da implementare -->
            returned data: Dungeons LIST(1)  
        </div>

        <h3 class="alert alert-warning">Dungeons per Filtro</h3>
        <div class="jumbotron">
            method : GET <br/>
            endpoint : https://scaling-potato-7v7q7wx7rrwqhx6wq-80.app.github.dev/Progetti/Jungleon/API/DungeonsFiltrati/{filtro} <br/>                                             <!-- da implementare -->
            returned data: Dungeons LIST  
        </div>

        <h3 class="alert alert-secondary">Last move</h3>
        <div class="jumbotron">
            method : GET <br/>
            endpoint : https://scaling-potato-7v7q7wx7rrwqhx6wq-80.app.github.dev/Progetti/Jungleon/API/??? <br/>                                             <!-- da implementare -->
            returned data: last move 
        </div>

		<h3 class="alert alert-secondary">Game's Moves</h3>
        <div class="jumbotron">
            method : GET <br/>
            endpoint : https://scaling-potato-7v7q7wx7rrwqhx6wq-80.app.github.dev/Progetti/Jungleon/API/??? <br/>                                             <!-- da implementare -->
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

/* ------------------------ CONFIGURAZIONE ------------------------ */

define('JWT_SECRET', '214d74fe2533889e5be398e25905a7cc8c9d1ecdc1b2a42888a6de50269d9051');   // cambia con una tua chiave
define('JWT_ISSUER', 'https://jungleon.local');
define('JWT_AUDIENCE', 'https://jungleon.client');
define('JWT_EXP', 300); // 5 minuti

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
    $db = new mysqli("localhost", "utente_phpmyadmin", "86FbuSRrfWRkgWh", "JungleonDB");
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


/* ------------------------ REGISTRAZIONE E LOGIN ------------------------ */


function registra_utente_db($db, $username, $email, $nome, $password, $ruolo = 'UtenteBase') {
    if (empty($username) || empty($password) || empty($nome)) {
        http_response_code(400);
        die(json_encode(["error" => "Username, password e nome obbligatori"]));
    }

    // Controllo duplicati
    if ($email == null){
        $stmt = $db->prepare("SELECT Username FROM Utenti WHERE Username=?");
        $stmt->bind_param("s", $username);

    } else {
        $stmt = $db->prepare("SELECT Username FROM Utenti WHERE Username=? OR Email=?");
        $stmt->bind_param("ss", $username, $email);
    }

    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        http_response_code(409);
        die(json_encode(["error" => "Username o email già in uso"]));
    }

    $salt = genera_salt();
    $hash = calcola_hash_password($password, $salt);
    $password_finale = $salt . $hash;

    if ($email == null) {
        $stmt = $db->prepare("INSERT INTO Utenti (Username, Nome, Password, Ruolo) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $username, $nome, $password_finale, $ruolo);
    } else {
        $stmt = $db->prepare("INSERT INTO Utenti (Username, Email, Nome, Password, Ruolo) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssss", $username, $email, $nome, $password_finale, $ruolo);
    }
    //var_dump($stmt);
    print("1\n");
    $success = $stmt->execute();
    //var_dump($success);
    print("2\n");

    if (!$success) {
        $stmt = $db->prepare("DELETE FROM Utenti WHERE Username=?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        http_response_code(500);
        die(json_encode(["error" => "Errore durante la registrazione"]));
    } else {
        print("3\n");
        $stmt = $db->prepare("SELECT ID FROM Utenti WHERE Username=?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        print("4\n");
        $result = $stmt->get_result();
        $user = $result->fetch_assoc();
        print("5\n");
    }

    print("6\n");
    return ["success" => true, "ID" => $user["ID"]];
}

function login_utente_db($db, $username, $password){
    $stmt = $db->prepare("SELECT ID, Username, Password, Ruolo FROM Utenti WHERE Username=?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    if (!$user) {
        http_response_code(401);
        die(json_encode(["error" => "Credenziali non valide"]));
    }

    $password_db = $user['Password'];
    $salt = substr($password_db, 0, 32);
    $hash_salvato = substr($password_db, 32);

    $hash_calcolato = calcola_hash_password($password, $salt);

    if (!hash_equals($hash_salvato, $hash_calcolato)) {
        http_response_code(401);
        die(json_encode(["error" => "Credenziali non valide"]));
    }

    // Genera JWT
    $payload = [
        "iat" => time(),
        "exp" => time() + JWT_EXP,
        "sub" => $user["ID"],
        "username" => $user["Username"],
        "ruolo" => $user["Ruolo"]
    ];

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

    return ["success" => true, "token" => $token, "expires_in" => JWT_EXP];
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

function dungeons_db($db, $pagina){
  #$cancella=$db->query("delete from games_partite WHERE PLAYER2 IS NULL AND CREATED_AT < NOW() - INTERVAL 1 DAY	");
  $pg1 = 1*$pagina;
  $pg2 = 1*($pagina-1);
  //print_r("PG1: $pg1 - PG2: $pg2\n");
  if($pg2 <= 0)
    $result = $db->query('SELECT * from Dungeons WHERE Pubblico = "True" ORDER BY DataCreazione DESC LIMIT 45');
  else
    $result = $db->query("(SELECT * from Dungeons WHERE Pubblico = \"True\" ORDER BY DataCreazione DESC LIMIT $pg1) EXCEPT (SELECT * from Dungeons WHERE Pubblico = \"True\" ORDER BY DataCreazione DESC LIMIT $pg2)");
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
  $result = $db->query("(SELECT * from Dungeons WHERE Pubblico = True ORDER BY DataCreazione DESC LIMIT $pg1) - (SELECT * from Dungeons WHERE Pubblico = True ORDER BY DataCreazione DESC LIMIT $pg2)");
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

  //$result = $db->query("SELECT * from Dungeons WHERE Pubblico = True AND (Nome LIKE '%$filtro%' OR Descrizione LIKE '%$filtro%') ORDER BY DataCreazione DESC");
  $risp=array();
  //while($row = $result->fetch_assoc())
    //$risp[]=$row;
  return $risp;
}
  
function insert_partita($db,$player){
if (strpos(strtoupper($player), "GRANA")!==false)
    return -1;
  $stmt = $db->prepare("INSERT INTO games_partite(PLAYER1) VALUES (?)");
  $stmt->bind_param("s", $player); 
  $stmt->execute();
  return $db->insert_id;
}

function verifica_jwt() {
    if (!isset($_SERVER['HTTP_AUTHORIZATION'])) {
        errore(401, "Token mancante");
    }

    $authHeader = $_SERVER['HTTP_AUTHORIZATION'];
    if (!preg_match('/Bearer\s(\S+)/', $authHeader, $matches)) {
        errore(401, "Formato token non valido");
    }

    $jwt = $matches[1];

    try {
        $decoded = JWT::decode($jwt, new Key(JWT_SECRET, 'HS256'));
        return $decoded; // contiene id utente, username, ecc.
    } catch (Exception $e) {
        errore(401, "Token non valido o scaduto");
    }
}


function insert_ruolo($db,$ruolo){                                                                               //!!!!!!Moficato!!!!!!!!
if (strpos(strtoupper($ruolo), "GRANA")!==false)
    return -1;
  $stmt = $db->prepare("INSERT INTO games_partite(PLAYER1) VALUES (?)");
  $stmt->bind_param("s", $ruolo); 
  $stmt->execute();
  return $db->insert_id;
}



function insert_mossa($db,$partita,$player,$mossa){
	
  $stmt = $db->prepare("SELECT * from games_partite WHERE ID=?");
  $stmt->bind_param("i", $partita); 
  $stmt->execute();
  $result = $stmt->get_result();
  $row = $result->fetch_assoc();
  if ($row==null)
  return -1;
  if ( $row["PLAYER2"]==null)
  return -2;
  if ( $player==null)
  return -2;
  
  /*if ($row["PLAYER1"]!=$player && $row["PLAYER2"]!=$player)*/
  if ($row["PLAYER1"]!=$player && $row["PLAYER2"]!=$player && $row["PLAYER3"]!=$player && $row["PLAYER3"]!=$player &&
  $row["PLAYER4"]!=$player && $row["PLAYER5"]!=$player && $row["PLAYER6"]!=$player && $row["PLAYER7"]!=$player)
  return -3;
  
  $stmt = $db->prepare("INSERT INTO games_mosse(MOSSA,PLAYER,GAME) VALUES (?,?,?)");
  $stmt->bind_param("ssi", $mossa,$player,$partita); 
  $stmt->execute();
  return $db->insert_id;
}


function mosse($db,$partita){
  $stmt = $db->prepare("SELECT * FROM games_partite WHERE ID=?");
  $stmt->bind_param("i", $partita); 
  $stmt->execute();
  $result = $stmt->get_result();
  if ($result->num_rows==0)
  	return -1;
    
  $stmt = $db->prepare("SELECT * from games_mosse WHERE GAME=? ORDER BY ID DESC");
  $stmt->bind_param("i", $partita); 
  $stmt->execute();
  $result = $stmt->get_result();
  $ris=array();
  while($row = $result->fetch_assoc()) $ris[]=$row;
  return $ris;
}


function last_mossa($db,$partita){
  $stmt = $db->prepare("SELECT * FROM games_partite WHERE ID=?");
  $stmt->bind_param("i", $partita); 
  $stmt->execute();
  $result = $stmt->get_result();
  if ($result->num_rows==0)
  	return -1;
    
  $stmt = $db->prepare("SELECT * from games_mosse WHERE GAME=? ORDER BY ID DESC LIMIT 1");
  $stmt->bind_param("i", $partita); 
  $stmt->execute();
  $result = $stmt->get_result();
  $row = $result->fetch_assoc();
  return $row;
  }


function join_partita($db,$partita,$player){
if (strpos(strtoupper($player), "GRANA")!==false)
    return -2;

  $partite=ruolo_db($db,7);
  $find=false;
  foreach ($partite as $p)
    if ($p["ID"]==$partita){ 
    $find=true;
    $n=-1;
    for ($i=1;$i<=7;$i++){//
    	$giocatore="PLAYER".$i;
    	if ($p[$giocatore]==$player)
      		return -1;
    	
        if ($p[$giocatore]==null && $n==-1)//
        	$n=$i;//
        }
    }
  if (!$find) return 0;
  //echo $n;
  $stmt = $db->prepare("UPDATE games_partite SET PLAYER$n=? WHERE ID=?");//PLAYER2
  $stmt->bind_param("si", $player,$partita); 
  if ($stmt->execute()) return 1;
  else return -2;
}



function errore($tipo,$error){
	http_response_code($tipo);
	//header("Content-Type: application/json; charset= utf-8");
    $ris='{"error":'.$tipo.';"description":"'.$error.'"}';
    die( $ris);
}

function rispondi_json($data){
	http_response_code(200);
	echo json_encode($data,JSON_INVALID_UTF8_IGNORE);
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
if (isset($_SERVER["HTTP_ORIGIN"]) && $_SERVER["HTTP_ORIGIN"]=="https://scaling-potato-7v7q7wx7rrwqhx6wq-80.app.github.dev")
{
    header("Access-Control-Allow-Origin: {https://scaling-potato-7v7q7wx7rrwqhx6wq-80.app.github.dev/}");
    header("Access-Control-Allow-Credentials: true");
    header("Access-Control-Max-Age: 6400");    // cache for 10 minutes
}
else
{
  die(documentazione());
    //header("Access-Control-Allow-Origin: *");
}

header("Access-Control-Allow-Credentials: true");
header("Access-Control-Max-Age: 600");    // cache for 10 minutes

if($_SERVER["REQUEST_METHOD"] === "OPTIONS")
{
  if (isset($_SERVER["HTTP_ACCESS_CONTROL_REQUEST_METHOD"]))
    header("Access-Control-Allow-Methods: POST, GET, OPTIONS, DELETE, PUT"); //Make sure you remove those you do not want to support

  if (isset($_SERVER["HTTP_ACCESS_CONTROL_REQUEST_HEADERS"]))
    header("Access-Control-Allow-Headers: {$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}");

  //Just exit with 200 OK with the above headers for OPTIONS method
  exit(0);
}
//From here, handle the request as it is ok
   
//header("Access-Control-Allow-Credentials: true");
//header("Access-Control-Allow-Headers: X-Requested-With, Content-Type, Origin, Cache-Control, Pragma, Authorization, Accept, Accept-Encoding");
//header("Access-Control-Allow-Methods: GET,POST, OPTIONS");
header("Content-Type: application/json; charset= utf-8");
$oggetto=null;

if (gestisci_URI()[0]=="")
  die (documentazione());

//menage bearer token JWT
if(isset($_SERVER["HTTP_AUTHORIZATION"]))
{
    $token = trim(str_replace("Bearer", "", $_SERVER["HTTP_AUTHORIZATION"]));
    try {
        $decoded = JWT::decode($token, new Key(JWT_SECRET, 'HS256'));
        // Token valido, procedi con la richiesta
    } catch (Exception $e) {
        errore(401, "Token non valido o scaduto "+ $e->getMessage());
    }
}
if (!isset($_SERVER['PHP_AUTH_USER'])) {
  header('WWW-Authenticate: Basic realm="Jungleon API"');
  header('HTTP/1.0 401 Unauthorized');
  errore(401,"Basic Auth not sent");
  exit;

} else {
  if ($_SERVER['PHP_AUTH_USER']!="Fire17Jungleon" && $_SERVER['PHP_AUTH_USER']!="4IE" 
  || $_SERVER['PHP_AUTH_PW']!="Jungleon17Stone" && $_SERVER['PHP_AUTH_PW']!="Falzone")
    errore(401,"Basic Auth error. Auth_user or password not valid");

  else{
    $parametri=gestisci_URI();
    if (is_null($parametri)){
      documentazione();
    }
      
    //rispondi_json($parametri);
    //die;
    
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      if (!isset($parametri[0]))
          errore(400,"something expexted");

      switch($parametri[0]){
        case "Register":
            $data = json_decode(file_get_contents('php://input'));
            if (!isset($data->username/*, $data->email*/, $data->nome, $data->password)) {
                http_response_code(400);
                die(json_encode(["error" => "Dati mancanti"]));
            }
            //registra l'utente (la mail è opzionale)
            $risposta = registra_utente_db(db_connect(), $data->username, $data->email ?? null, $data->nome, $data->password);
            $oggetto=new risposta("POST","Registration completed",$risposta);
            break;


        case "Login":
          //effettua login
            $data = json_decode(file_get_contents('php://input'));
            if (!isset($data->username, $data->password)) {
                http_response_code(400);
                die(json_encode(["error" => "Username o password mancanti"]));
            }
            $jwt = login_utente_db(db_connect(), $data->username, $data->password);
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
            $oggetto=new risposta("POST","New Role created",$ruolo);
          }
          break;
        

        case "Partita":
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
          break;

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
          $oggetto=new risposta("GET","Ruolo richiesto",$ruolo);
          //var_dump($oggetto);
          break;

        case "Dungeons":
          if (!isset($parametri[1])){
            $pagina=1;
          } else {
            $pagina=$parametri[1];
          }
          $dungeons=array();
          $dungeons=dungeons_db(db_connect(), $pagina);
          $oggetto=new risposta("GET","dungeons esistenti",$dungeons);
          //var_dump($oggetto);
          break;

        case "Dungeon":
          if (!isset($parametri[1]))
            errore(400,"ID dungeon richiesto");

          $ID=$parametri[1];
          $dungeon=array();
          $dungeon=dungeon_db(db_connect(),$ID);
          $oggetto=new risposta("GET","Dungeon richiesto",$dungeon);
          //var_dump($oggetto);
          break;

        case "DungeonsFiltrati":
          $dungeons=array();
          if (!isset($parametri[1]))
            errore(400,"filtro richiesto");
          $filtro=$parametri[1];
          $dungeons=dungeonsFiltrati_db(db_connect(),$filtro);
          $oggetto=new risposta("GET","dungeons filtrati",$dungeons);
          //var_dump($oggetto);
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

	}
}
?>