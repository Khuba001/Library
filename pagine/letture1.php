<!DOCTYPE html>
<html lang="pl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../CSS/MyCss.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <title>Biblioteka - Rozpocznij lekturę</title>
    <?php
    session_start();
    if (!isset($_SESSION['username'])) {
        header('location: logout.php');
    }
    $username = $_SESSION["username"];
    $servername = 'bibliotekaprojekt-server.mysql.database.azure.com';
    $db_name = 'mydatabase'; // Poprawione na 'mydatabase'
    $db_username = 'tmdzlzwxgh';
    $db_password = 'Projekt123';
    $error = true;
    ?>
</head>

<body>
    <ul class="barra">
        <li class="barra"><a class="barra" href="home.php?ordine">Strona główna</a></li>
        <li class="barra"><a class="barra" href="aggiungi.php">Dodaj książkę</a></li>
        <li class="barra"><a class="barra" href="letture.php">Lektury</a></li>
        <li class="barra" style="float: right;"><a class="barra" href="logout.php">Wyloguj</a></li>
    </ul>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if ($_POST["inizio"] == "") {
            echo "<div class='row' id='login'>
                            <div class='col-sm-4'></div>
                            <div class='alert alert-danger alert-dismissible fade in col-sm-4'>
                                <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                                <strong>Błąd!</strong> Pole rozpoczęcia lektury nie może być puste.
                            </div>
                        </div>";
        } else {
            $titolo = $_POST["titolo"];
            $conn = new mysqli($servername, $db_username, $db_password, $db_name);

            $sql = "SELECT codice
                        FROM libri
                        WHERE titolo='$titolo'";
            $ris = $conn->query($sql) or die("<p>Błąd zapytania! " . $conn->error . "</p>");
            $row = $ris->fetch_assoc();

            $sql1 = "INSERT INTO letture (codice, utente, inizio)
                        VALUES ('" . $row["codice"] . "',
                            '" . $username . "', 
                            '" . $_POST["inizio"] . "')";
            if ($conn->query($sql1) === true) {
                header("location: letture2.php");
            } else {
                $error = false;
            }
        }
    }
    ?>

    <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post">
        <div class="form1">
            <div id="titolo1">
                <h1 class="aggiungi"><b>Rozpocznij lekturę</b></h1>
            </div>
            <div class="btn-group btn-group-justified" style="width: 500px; margin: auto;">
                <a href="letture1.php" class="btn btn-primary">Rozpocznij lekturę</a>
                <a href="letture2.php" class="btn btn-primary">Lektury w trakcie</a>
                <a href="letture3.php" class="btn btn-primary">Lista lektur</a>
            </div>
            <div class="row" id="login">
                <div class="col-sm-4"></div>
                <div class="col-sm-4" style="text-align: left; margin-top: 50px;">
                    <label for="sel1">Tytuł:</label>
                    <select class="form-control" id="sel1" name="titolo">
                        <?php
                        $conn = new mysqli($servername, $db_username, $db_password, $db_name);
                        $sql = "SELECT titolo
                                    FROM libri
                                    ORDER BY titolo";

                        $ris = $conn->query($sql) or die("<p>Błąd zapytania! " . $conn->error . "</p>");
                        if ($ris->num_rows > 0) {
                            while ($row = $ris->fetch_assoc()) {
                                echo "<option>" . $row["titolo"] . "</option>";
                            }
                        }
                        ?>
                    </select>
                </div>
            </div>
            <div class="row" id="login">
                <div class="col-sm-4"></div>
                <div class="col-sm-4">
                    <input class="form-control" id="aggiungi" type="date" name="inizio">
                </div>
            </div>
            <div class="row" id="login">
                <div class="col-sm-4"></div>
                <div class="col-sm-4">
                    <input class="btn btn-primary" id="bottone1" type="submit" value="Rozpocznij lekturę">
                </div>
            </div>
        </div>
    </form>

    <?php
    if ($error == false) {
        echo "<div class='row' id='login'>
                <div class='col-sm-4'></div>
                <div class='alert alert-danger alert-dismissible fade in col-sm-4'>
                    <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                    <strong>Błąd!</strong> Rejestracja nie powiodła się.
                </div>
            </div>";
    }
    ?>

</body>

</html>