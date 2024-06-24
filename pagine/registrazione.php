<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../CSS/MyCss.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <title>Biblioteka - Rejestracja</title>
    <?php
    $servername = "bibliotekaprojekt-server.mysql.database.azure.com";
    $db_name = "mydatabase";
    $db_username = "tmdzlzwxgh";
    $db_password = "Projekt123";
    ?>
</head>

<body>
    <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post">
        <div class="form1">
            <div id="titolo1">
                <h1 class="aggiungi"><b>Zarejestruj się</b></h1>
            </div>
            <div class="row" id="login">
                <div class="col-sm-4"></div>
                <div class="col-sm-4">
                    <input class="form-control" id="aggiungi" type="text" name="username" placeholder="Username">
                </div>
            </div>
            <div class="row" id="login">
                <div class="col-sm-4"></div>
                <div class="col-sm-4">
                    <input class="form-control" id="aggiungi" type="text" name="password" placeholder="Password">
                </div>
            </div>
            <div class="row" id="login">
                <div class="col-sm-4"></div>
                <div class="col-sm-4">
                    <input class="form-control" id="aggiungi" type="text" name="nome" placeholder="Imię">
                </div>
            </div>
            <div class="row" id="login">
                <div class="col-sm-4"></div>
                <div class="col-sm-4">
                    <input class="form-control" id="aggiungi" type="text" name="cognome" placeholder="Nazwisko">
                </div>
            </div>
            <div class="row" id="login">
                <div class="col-sm-4"></div>
                <div class="col-sm-4">
                    <input class="btn btn-primary" id="bottone1" type="submit" value="Zarejestruj się">
                </div>
            </div>
        </div>
    </form>
    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if ($_POST["username"] == "" or $_POST["password"] == "") {
            echo "nazwa użytkownika i hasło nie mogą być puste!";
        } else {
            $conn = new mysqli($servername, $db_username, $db_password, $db_name);
            $sql = "SELECT Username 
                    FROM utenti 
                    WHERE Username='" . $_POST["username"] . "'";
            //echo $sql;

            $ris = $conn->query($sql) or die("<p>Zapytanie nie powiodło się!</p>");
            if ($ris->num_rows > 0) {
                echo "<div class='row' style='margin-top: 30px;'>
                                <div class='col-sm-3'></div>
                                <div class='col-sm-6'>
                                    <div class='alert alert-danger'><strong>Błąd!</strong> Wybrana nazwa użytkownika jest niedostępna.</div>
                                </div>
                            </div>";
            } else {
                $sql = "INSERT INTO utenti (Username, Password, Nome, Cognome)
                            VALUES ('" . $_POST["username"] . "', 
                                '" . $_POST["password"] . "', 
                                '" . $_POST["nome"] . "', 
                                '" . $_POST["cognome"] . "')";
                if ($conn->query($sql) === true) {
                    $conn->close();
                    header("location: home.php");
                } else {
                    echo "Rejestracja nie powiodła się: " . $conn->error;
                }
            }
        }
    }
    ?>
</body>

</html>