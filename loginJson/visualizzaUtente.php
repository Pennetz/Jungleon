<?php
	session_start();
    //var_dump($_SESSION);
    $fileUtenti = "utenti.json";
    
    if (!isset($_SESSION["name"])){
    	header("Location: index.php?errore=" . urlencode("Devi prima effettuare il login."));
        exit();

    } else {
        $username = $_SESSION["name"];
        if (!isset($_SESSION["role"]) || !isset($_SESSION["color"])) {

            $utenti = json_decode(file_get_contents($fileUtenti), true);
            $trovato = false;

            foreach ($utenti as $u) {
                if ($u["username"] === $username) {
                    $trovato = true;
                    $role = $u['role'];
                    $color = $u['color'];

                }
            }
            
            if (!$trovato){
                $errore = "Accedi per poter vedere la pagina";
                header("Location: loginIndex.php?errore=" . urlencode($errore));
                exit();

            }
            $_SESSION["role"] = $role;
            $_SESSION["color"] = $color;
            $name = $_SESSION['name'];
                
        } else {
            $name = $_SESSION['name'];
            $color = $_SESSION["color"];
            $role = $_SESSION["role"];
        }
    }
?>

<!doctype html>
<html lang="it">
    <head>
        <title>pagina utente</title>
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

    <body style="background-color: <?php echo $color; ?>;">
        <header>
            <!-- place navbar here -->
             <div class="container">
                <div class="nav nav-tabs">
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
                    <li class="nav-item">
                        <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Cooming soon</a>
                    </li>
                </div>
            </div>

        </header>
        <main>
            <main class="d-flex vh-100 justify-content-center align-items-center">

                <div class="d-grid gap-2">

                    <!-- <a href="./visualizzaUtente.php" class="btn btn-primary" role="button" data-bs-toggle="button">Toggle link</a> -->
                    <!-- <a href="./visualizzaUtente.php" class="btn btn-primary" role="button" data-bs-toggle="button" aria-pressed="true">Active toggle link</a> -->
                    <h2>The Jungleon is waiting for you...</h2>
                    <!-- d-grid gap-2 col-md-auto -->
                    <div class="d-grid gap-2 col-md-auto">
                        <a href="./visualizzaUtente.php" class="btn row btn-primary ">Nuova partita</a>
                        <a href="./visualizzaUtente.php" class="btn row btn-primary disabled" tabindex="-1" aria-disabled="true" role="button" data-bs-toggle="button">Continua partita</a>
                        <a href="./visualizzaUtente.php" class="btn row btn-primary ">Partita online (1vs1)</a>
                        <a href="./visualizzaUtente.php" class="btn row btn-primary ">Partita online (2vs2)</a>
                        <a href="./visualizzaUtente.php" class="btn row btn-primary ">Gioca Dungeon personalizzati</a>
                        <a href="./visualizzaUtente.php" class="btn row btn-primary ">Il tuo Dungeon</a>
                        <?php if ($role==="admin") { ?>
                        <a href="./visualizzaUtente.php" class="btn row btn-danger ">Modifica DungeonBase</a>
                        <?php } ?>
                    </div>

                    <!-- <div class="col-md-auto"> -->
                        <?php 
                        if (!isset($_SESSION['name'])) {  //se non è settato il ruolo significa che sono un ospite
                            ?>
                    <a href="logout.php" class="btn btn-primary mx-5">register</a>
                    <a href="logout.php" class="btn btn-primary mx-5">login</a>
                    <?php
                        } else {
                    ?>
                    <a href="logout.php" class="btn btn-primary mx-5">logout</a>
                    <?php
                        }
                    ?>
                    <hr>
                    <label for="colorPicker">Scegli un colore di sfondo:</label>
                    <input type="color" id="colorPicker" value="<?php echo htmlspecialchars($color); ?>">
                    <!-- </div> -->
                </div>

                <script>
                    const colorPicker = document.getElementById('colorPicker');

                    colorPicker.addEventListener('input', async (event) => {
                        const newColor = event.target.value;
                        document.body.style.backgroundColor = newColor;

                        // Aggiorna colore lato server senza ricaricare la pagina
                        await fetch('cambiaColore.php', {
                            method: 'POST',
                            headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                            body: 'color=' + encodeURIComponent(newColor)
                        });
                    });
                </script>

            </main>

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
