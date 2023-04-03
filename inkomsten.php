<?php
require 'database.php';

if (isset($_GET["id"])) {
    $stmt = $conn->prepare("DELETE FROM inkomen WHERE idinkomen = ?");
    $stmt->bindValue(1, $_GET["id"]);

    $stmt->execute();
    header("location: inkomsten.php");
}

$stmt = $conn->prepare(
    "SELECT inkomen.idinkomen, inkomen.bedrag, inkomen.datum, inkomen.periodiek, inkomen.id_gebruiker, inkomen_soort.soort
FROM inkomen
JOIN inkomen_soort ON inkomen.id_inkomen_soort = inkomen_soort.id_inkomen_soort;
WHERE id_gebruiker = 1;"
);
$stmt->execute();

$tests = $stmt->fetchAll(PDO::FETCH_OBJ);


?>

<!DOCTYPE html>
<html>

<head>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css">


</head>

<body>
    <div class="header">
        <a href="#default" class="logo">
            <?php
            echo ("Hallo $gebruiker->voornaam $gebruiker->achternaam");
            
            ?>
        </a>
        <div class="header-right">
            <a href="index.php">Home</a>
            <a class="active" href="inkomsten.php">Inkomsten</a>
            <a href="uitgaven.php">Uitgaven</a>
            <a href="schulden.php">Schulden</a>
            <a href="activa.php">Activa</a>


        </div>
    </div>

    <br><br>

    <a href="transactie.php" class="button">Transactie toevoegen</a>

    <h1>Inkomsten</h1>
    <table class='table table-striped'>
        <thead class='table-dark>'>
            <th>Bedrag</th>
            <th>Datum</th>
            <th>Soort</th>
            <th>Periodiek</th>
        </thead>
        <tbody>
            <?php
            foreach ($tests as $test) {
                echo "<tr>";
                echo "<td>€$test->bedrag</td>";
                echo "<td>$test->datum</td>";
                echo "<td>$test->soort</td>";

                if ($test->periodiek == 1) {
                    echo "<td>Ja</td>";
                } else {
                    echo "<td>Nee</td>";
                }

                echo "<td><a class='btn btn-danger' href='inkomsten.php?id=$test->idinkomen' onclick='return confirm(\"Weet je het zeker?\");'>X</a></td>";

                echo "</tr>";
            }
            ?>
        </tbody>
    </table>

</body>

</html>