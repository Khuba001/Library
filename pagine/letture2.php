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
    <title>Biblioteka - Lektury w trakcie</title>
    <?php
    session_start();
    if (!isset($_SESSION['username'])) {
        header('location: logout.php');
    }
    $username = $_SESSION["username"];
    $servername = 'bibliotekaprojekt-server.mysql.database.azure.com';
    $db_name = 'mydatabase'; // Zmieniono na 'mydatabase'
    $db_username = 'tmdzlzwxgh';
    $db_password = 'Projekt123';
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
        <h1 class="aggiungi"><b>Lektury w trakcie</b></h1>
    </div>
    <div class="btn-group btn-group-justified" style="width: 500px; margin: auto;">
        <a href="letture1.php" class="btn btn-primary">Rozpocznij lekturę</a>
        <a href="letture2.php" class="btn btn-primary">Lektury w trakcie</a>
        <a href="letture3.php" class="btn btn-primary">Lista lektur</a>
    </div>
    <?php
    $conn = new mysqli($servername, $db_username, $db_password, $db_name);
    $sql = "SELECT libri.codice, titolo, autore, genere, DATE_FORMAT(inizio, '%d/%m/%Y') as inizio
                FROM libri JOIN letture
                ON libri.codice=letture.codice
                WHERE inizio IS NOT NULL AND fine IS NULL AND utente='$username'";

    $ris = $conn->query($sql) or die("<p>Błąd zapytania! " . $conn->error . "</p>");
    ?>
    <div class="tabella">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Codice</th>
                    <th>Tytuł</th>
                    <th>Autor</th>
                    <th>Gatunek</th>
                    <th>Data rozpoczęcia</th>
                    <th>Akcja</th>
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
                                    <td>" . $row["inizio"] . "</td>
                                    <td>
                                        <form class='form-inline' action=" . $_SERVER['PHP_SELF'] . " method='post'>
                                            <input class='hidden' type='text' name='cod' value=" . $row["codice"] . ">
                                            <input class='form-control' id='data' type='date' name='fine'>
                                            <input class='btn btn-primary' id ='bottone2' type='submit' value='Zakończ'>
                                        </form>
                                    </td>
                                </tr>";
                    }
                }
                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    $sql = "UPDATE letture
                                SET fine= '" . $_POST["fine"] . "'
                                WHERE codice='" . $_POST["cod"] . "'";
                    $ris = $conn->query($sql) or die("<p>Błąd zapytania! " . $conn->error . "</p>");
                    header('location: letture3.php');
                }
                ?>
            </tbody>
        </table>
    </div>
</body>

</html>