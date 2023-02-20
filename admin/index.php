<?php
require_once "../database.php";

$stmt = $con->prepare("
        SELECT 
            gebruiker.id_gebruiker, 
            gebruiker.voornaam, 
            gebruiker.achternaam, 
            gebruiker.isadmin,
            gebruiker.gebruikersnaam,
            gebruiker.wachtwoord,
            land.naam AS land 
        FROM 
            gebruiker
            LEFT JOIN land ON gebruiker.id_land = land.id_land");
$stmt->execute();

$gebruikers = $stmt->fetchAll(PDO::FETCH_OBJ);

if (isset($_GET["id"])) {
    $stmt = $con->prepare("DELETE FROM gebruiker WHERE id_gebruiker = ?");
    $stmt->bindValue(1, $_GET["id"]);

    $stmt->execute();

    header("location: ../admin");
}




?>
<html>

<body>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
    <a class="btn btn-primary m-3" href="gebruiker_toevoegen.php">toevoegen</a>

    <table class="table table-striped" style="text-align: center;">
        <thead class="thead-dark">
            <tr>
                <th>Gebruikers Id</th>
                <th>Voornaam</th>
                <th>Achternaam</th>
                <th>Admin?</th>
                <th>gebruikersnaam</th>
                <th>wachtwoord</th>
                <th>Land</th>
                <th>wijzigen</th>
                <th>Verwijder</th>
            </tr>
        </thead>
        <tbody>
            <?php

            foreach ($gebruikers as $gebruiker) {
                echo "<tr>";
                echo "<td>$gebruiker->id_gebruiker</td>";
                echo "<td>$gebruiker->voornaam</td>";
                echo "<td>$gebruiker->achternaam</td>";
                if ($gebruiker->isadmin == 1) {
                    echo "<td>True</td>";
                } else {
                    echo "<td>False</td>";
                };
                echo "<td>$gebruiker->gebruikersnaam</td>";
                echo "<td>$gebruiker->wachtwoord</td>";
                echo "<td>$gebruiker->land</td>";
                echo "<td><a href='wijzig_gebruiker.php?id=$gebruiker->id_gebruiker' class='btn btn-primary'>...</a></td>";
                echo "<td><a href='../admin?id=$gebruiker->id_gebruiker' onclick='return confirm(\"weet je het zeker?\")'; class='btn btn-danger'>X</a></td>";
                echo "</tr>";
            }

            ?>
        </tbody>

</html>