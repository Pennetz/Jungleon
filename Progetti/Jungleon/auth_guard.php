<?php

if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

if (empty($_SESSION['username']) || empty($_SESSION['token'])) {
    header('Location: VisualizzaUtente.php');
    exit();
}
