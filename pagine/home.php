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
    <title>Biblioteka - Strona główna</title>
    <?php
    session_start();
    if (!isset($_SESSION['username'])) {
        header('location: logout.php');
    }
    $username = $_SESSION["username"];
    $servername = 'bibliotekaprojekt-server.mysql.database.azure.com';
    $db_name = 'mydatabase';
    $db_username = 'tmdzlzwxgh';
    $db_password = 'Projekt123';
    $filtro = $_GET["ordine"];
    ?>
</head>

<body>
    <ul class="barra">
        <li class="barra"><a class="barra" href="home.php?ordine">Strona główna</a></li>
        <li class="barra"><a class="barra" href="aggiungi.php">Dodaj książkę</a></li>
        <li class="barra"><a class="barra" href="letture.php">Lektury</a></li>
        <li class="barra" style="float: right;"><a class="barra" href="logout.php">Wyloguj</a></li>
    </ul>
    <div id="titolo2">
        <h1 class="aggiungi"><b>Biblioteka</b></h1>
    </div>
    <div class="btn-group btn-group-justified" style="width: 500px; margin: auto;">
        <a href="home.php?ordine=titolo" class="btn btn-primary">Tytuł</a>
        <a href="home.php?ordine=autore" class="btn btn-primary">Autor</a>
        <a href="home.php?ordine=genere" class="btn btn-primary">Gatunek</a>
    </div>
    <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post">
        <div class="cerca">
            <div class="input-group">
                <input type="text" class="form-control" name="ricerca" placeholder="Szukaj tytułu" autocomplete="off">
                <div class="input-group-btn">
                    <button class="btn btn-default" type="submit">
                        <i class="glyphicon glyphicon-search"></i>
                    </button>
                </div>
            </div>
        </div>
    </form>
    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $conn = new mysqli($servername, $db_username, $db_password, $db_name);
        $sql = "SELECT codice, titolo, autore, genere, posizione
                        FROM libri 
                        WHERE titolo LIKE '%" . $_POST["ricerca"] . "%'";
        //echo $sql;

        $ris = $conn->query($sql) or die("<p>Zapytanie nie powiodło się!</p>");
    } else if ($filtro == "titolo") {
        $conn = new mysqli($servername, $db_username, $db_password, $db_name);
        $sql = "SELECT codice, titolo, autore, genere, posizione
                    FROM libri
                    ORDER BY titolo";

        $ris = $conn->query($sql) or die("<p>Zapytanie nie powiodło się! " . $conn->error . "</p>");
    } else if ($filtro == "autore") {
        $conn = new mysqli($servername, $db_username, $db_password, $db_name);
        $sql = "SELECT codice, titolo, autore, genere, posizione
                    FROM libri
                    ORDER BY autore";

        $ris = $conn->query($sql) or die("<p>Zapytanie nie powiodło się! " . $conn->error . "</p>");
    } else if ($filtro == "genere") {
        $conn = new mysqli($servername, $db_username, $db_password, $db_name);
        $sql = "SELECT codice, titolo, autore, genere, posizione
                    FROM libri
                    ORDER BY genere";

        $ris = $conn->query($sql) or die("<p>Zapytanie nie powiodło się! " . $conn->error . "</p>");
    } else {
        $conn = new mysqli($servername, $db_username, $db_password, $db_name);
        $sql = "SELECT codice, titolo, autore, genere, posizione
                    FROM libri
                    ORDER BY codice";

        $ris = $conn->query($sql) or die("<p>Zapytanie nie powiodło się! " . $conn->error . "</p>");
    }
    ?>
    <div class="tabella">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Kod</th>
                    <th>Tytuł</th>
                    <th>Autor</th>
                    <th>Gatunek</th>
                    <th>Pozycja</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($ris->num_rows > 0) {
                    while ($row = $ris->fetch_assoc()) {
                        echo "<tr>
                                    <td>" . $row["codice"] . "</td>
                                    <td>" . $row["titolo"] . "</td>
                                    <td>" . $row["autore"] . "</td>
                                    <td>" . $row["genere"] . "</td>
                                    <td>" . $row["posizione"] . "</td>
                                </tr>";
                    }
                }
                ?>
            </tbody>
        </table>
    </div>
</body>

</html>