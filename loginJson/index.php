<?php
	session_start();
    if (isset($_SESSION["name"])){
    	header("location:visualizzaUtente.php");
        exit();	//identico a "die()"
    }
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

            <div class="container">
				<h1 class="alert alert-access"> Register </h1>
                <?php
                	if (isset($_GET["errore"])){
                ?>
                <h3 class="alert alert-danger"> <?php echo $_GET["errore"] ?> </h3>
                <?php } ?>
                <form id="form" action="./register.php" method="POST"> <!--  -->

                    <label for="usernameLbl" class = "form-label">Username</label>
                    <input class="form-control" type="text"name="username" id="username" placeholder="inserisci il tuo username">

                    <hr>

                    <label for="passwordLbl" class = "form-label">Password</label>
                    <input class="form-control" type="password" name="password" id="password" placeholder="inserisci la tua password">

                    <hr>
                    
                    <input id="btnRegistra" type="submit" class="btn btn-primary" value="Registrati">
                     oppure 
                    <a href="loginIndex.php" type="button" class="btn btn-primary">Accedi</a>
                </form>
            </div>
            <?php if(isset($_GET["errore"])){ ?>
            <script>
            	setTimeout(elimina, 2000);
                function elimina(){
                	document.getElementsByTagName("h3")[0].style.display="none";
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