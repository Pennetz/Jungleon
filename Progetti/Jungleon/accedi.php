<?php
session_start();
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
                        <a class="nav-link" href="../index.php">Back to Home</a>
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
                <div class="container">
                    <h3 class="alert alert-danger"> <?php echo $_GET["errore"] ?> </h3>
                </div>
            <?php } ?>
            
            <?php
                if (isset($_GET["messaggio"])){
            ?>
                <div class="container">
                    <h3 class="alert alert-success"> <?php echo $_GET["messaggio"] ?> </h3>
                </div>
            <?php } ?>

            <div class="mt-5 mb-4 container">
                <!-- creo una "card" per il login -->
                <h2>Login</h2>

                <form action="login.php" method="post" class="mt-4">
                    <div class="mb-3">
                        <label for="username" class="form-label">Username</label>
                        <input
                            type="text"
                            class="form-control"
                            id="username"
                            name="username"
                            value="<?php echo htmlspecialchars($_GET['username'] ?? '', ENT_QUOTES, 'UTF-8'); ?>"
                        />
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input
                            type="password"
                            class="form-control"
                            id="password"
                            name="password"
                        />
                    </div>
                    <h6>
                        <button type="submit" class="btn btn-primary">Conferma</button> oppure
                        <a href="registrati.php">Registrati</a>
                    </h6>
            </div>
            

            <?php if(isset($_GET["errore"])){ ?>
            <script>
            	setTimeout(elimina, 3500);
                function elimina(){
                	document.getElementsByTagName("h3")[0].style.display="none";
                }
            </script>
            <?php } ?>
            
            <?php if(isset($_GET["messaggio"])){ ?>
            <script>
            	setTimeout(eliminaMessaggio, 5000);
                function eliminaMessaggio(){
                	var messaggi = document.querySelectorAll(".alert-success");
                	if(messaggi.length > 0) messaggi[0].style.display="none";
                }
            </script>
            <?php } ?>


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