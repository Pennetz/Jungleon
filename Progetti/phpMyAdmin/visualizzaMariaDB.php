<?php
    echo "ciao";

    $host = "localhost";
    $username = "utente_phpmyadmin";
    $password = "86FbuSRrfWRkgWh";

    $connessione = new mysqli($host, $username, $password, "JungleonDB");

    if ($connessione->connect_errno){
        die("Connessione fallita: " . $connessione->connect_error);
    }

    $interrogaione = "SELECT * FROM Dungeons;";
    $risultato = $connessione->query($interrogaione);
    
    /*if(!$risultato){
        
    }*/

    echo "<br>TUTTO OK<br><br>";
    echo var_dump($risultato);
    echo $risultato[3];
    echo 2;
?>