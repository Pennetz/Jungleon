<?php
    echo "ciao";

    $host = "localhost";
    $username = "utente_phpmyadmin";
    $password = "password_sicura";

    $connessione = new mysqli($host, $username, $password, "Dungeons");

    if ($connessione->connect_errno){
        die("Connessione fallita: " . $connessione->connect_error);
    }

    $interrogaione = "SELECT * FROM Utenti;";
    $risultato = $connessione->query($interrogaione);
    
    /*if(!$risultato){
        
    }*/

    echo "<br>TUTTO OK<br><br>";
    echo var_dump($risultato);
?>