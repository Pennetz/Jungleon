<?php
session_start();
require_once __DIR__ . '/API/chiavi.php';
require_once __DIR__ . '/auth_guard.php';
$other = isset($_GET['other']) ? trim($_GET['other']) : (isset($_GET['chat']) ? trim($_GET['chat']) : '');
if ($other === ''){ http_response_code(400); echo json_encode(['error'=>'destinatario richiesto']); exit(); }
$token = $_SESSION['token'] ?? null;
$apiUrl = 'http://localhost/Progetti/Jungleon/API/Chat/' . rawurlencode($other) . '/Messaggi';
$context = stream_context_create(['http'=>['method'=>'GET','header'=>"Authorization: Bearer $token\r\n"]]);
$resp = file_get_contents($apiUrl, false, $context);
if ($resp === false){ http_response_code(500); echo json_encode(['error'=>'API error']); exit(); }
header('Content-Type: application/json'); echo $resp;
