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
    <title>Biblioteka - Lektury</title>
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
    ?>
</head>

<body>
    <ul class="barra">
        <li class="barra"><a class="barra" href="home.php?ordine">Strona główna</a></li>
        <li class="barra"><a class="barra" href="aggiungi.php">Dodaj</a></li>
        <li class="barra"><a class="barra" href="letture.php">Lektury</a></li>
        <li class="barra" style="float: right;"><a class="barra" href="logout.php">Wyloguj</a></li>
    </ul>
    <div id="titolo2">
        <h1 class="aggiungi"><b>Lektury</b></h1>
    </div>
    <div class="btn-group btn-group-justified" style="width: 500px; margin: auto;">
        <a href="letture1.php" class="btn btn-primary">Rozpocznij lekturę</a>
        <a href="letture2.php" class="btn btn-primary">Lektury w trakcie</a>
        <a href="letture3.php" class="btn btn-primary">Lista lektur</a>
    </div>
    <div class="cit">
        <p class="cit"><i>"Maszyna technologicznie najbardziej efektywna, jaką kiedykolwiek stworzył człowiek, to książka."</i></p>
        <p class="cit_a">Northrop Frye</p>
    </div>
</body>

</html>