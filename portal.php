<?php
session_start();
if (!isset($_SESSION['id'])) {
    header("location:/");
}

require_once 'database.php';

$stmt = $con->prepare("SELECT * FROM gebruiker WHERE id_gebruiker = ?");
$stmt->bindValue(1, $_SESSION['id']);
$stmt->execute();
$gebruiker = $stmt->fetchObject();

?>

<!DOCTYPE html>
<html>

<head>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="style/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css">


</head>

<body>
    <div class="header">
        <a href="#default" class="logo"> <?php
                                            echo ("Hallo $gebruiker->voornaam $gebruiker->achternaam");
                                            ?>
        </a>
        <div class="header-right">
            <a class="active" href="portal.php">Home</a>
            <a href="inkomsten.php">Inkomsten</a>
            <a href="uitgaven.php">Uitgaven</a>
            <a href="schulden.php">Schulden</a>
            <a href="activa.php">Activa</a>
            <a href="logout.php">Uitlogen</a>
        </div>
    </div>

    <br><br>
    <button class="button-36" onclick="window.location.href='transactie.php'">Transactie toevoegen</button>
    <button class="button-36" onclick="window.location.href='addschuld.php'">Schuld toevoegen</button>
    <button class="button-36" onclick="window.location.href='addactiva.php'">Activa toevoegen</button>






</body>

</html>