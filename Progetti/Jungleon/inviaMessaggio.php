<?php
session_start();
require_once __DIR__ . '/API/chiavi.php';
require_once __DIR__ . '/auth_guard.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') { http_response_code(405); exit(); }

$data = json_decode(file_get_contents('php://input'), true);
if (!$data || empty($data['to']) || empty($data['testo'])) { http_response_code(400); echo json_encode(['error'=>'to e testo richiesti']); exit(); }

$token = $_SESSION['token'] ?? null;
if (!$token) { http_response_code(401); echo json_encode(['error'=>'Token mancante']); exit(); }

$apiUrl = 'http://localhost/Progetti/Jungleon/API/Messaggi';
$context = stream_context_create([
  'http'=>[
    'method'=>'POST',
    'header'=>"Content-Type: application/json\r\nAuthorization: Bearer $token\r\n",
    'content'=>json_encode(['to'=>$data['to'],'testo'=>$data['testo']]),
    'ignore_errors'=>true
  ]
]);

$resp = file_get_contents($apiUrl, false, $context);
if ($resp === false) { http_response_code(500); echo json_encode(['error'=>'Errore chiamata API']); exit(); }
header('Content-Type: application/json'); echo $resp;
