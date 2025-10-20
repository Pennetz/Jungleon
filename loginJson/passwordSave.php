<?php
	session_start();

    if (isset($_SESSION['name'])) {
        header("Location: visualizzaUtente.php");
        exit();
    }

    $utenti=json_decode(file_get_contents("utenti.json"));
    
?>

<!doctype html>
<html lang="it">
    <head>
        <title>Informatica Form HTML</title>
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
                        <a class="nav-link" href="./index.php">Indietro</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../Informatica.php">Informatica</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../TPSIT.php">TPSIT</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../GPO.php">GPO</a>
                    </li>
                </div>
            </div>
            
            <h1></h1>

            <?php

                //$errore = isset($_GET['errore']) ? $_GET['errore'] : "";

                if ($_SERVER["REQUEST_METHOD"] === "POST") {
                    $username = trim($_POST['username']);
                    $password = trim($_POST['password']);

                    if ($username === "" || $password === "") {
                        $errore = "Inserisci sia username che password.";
                        header("Location: loginIndex.php?errore=" . urlencode($errore));
                        exit();
                    }

                    $pepper = trim(file_get_contents("pepe.txt"));
                    $fileUtenti = "utenti.json";

                    if (!file_exists($fileUtenti)) {
                        $errore = "Nessun utente registrato.";
                        header("Location: loginIndex.php?errore=" . urlencode($errore));
                        exit();
                    }

                    $utenti = json_decode(file_get_contents($fileUtenti), true);
                    $trovato = false;

                    foreach ($utenti as $u) {
                        if ($u['username'] === $username) {
                            $trovato = true;
                            $salt = substr($u["hash"],0,16).substr($u["hash"],80,16);
                            $stringa = $password . $pepper . $salt; //$u['salt']
                            $hashLogin = hash("sha256", $stringa);                            

                            if (hash_equals(substr($u['hash'],16,64), $hashLogin)) {
                                $_SESSION['name'] = $username;
                                header("Location: visualizzaUtente.php");
                                exit();
                            } else {
                                $errore = "Nome utente o Password errati";      //volendo si può diversificare da quello sotto mettendo "Password errata" (chiedi prof)
                                header("Location: loginIndex.php?errore=" . urlencode($errore));
                                exit();
                            }
                        }
                    }

                    if (!$trovato) {
                        $errore = "Nome utente o Password errati";      //volendo si può differenziare da quello sopra mettendo "Utente non registrato" (chiedi prof)
                        header("Location: loginIndex.php?errore=" . urlencode($errore));
                        exit;
                    }
                }
                ?>

        </header>
        <main>

            <div class="container">
				
            </div>
            

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
