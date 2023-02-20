<?php
require_once "database.php";
if ($_POST) {
    $pass = password_hash($_POST["wachtwoord"], PASSWORD_DEFAULT);
$sql = "INSERT INTO gebruiker (voornaam, achternaam, gebruikersnaam, wachtwoord, id_land) values(?,?,?,?,?)";
    $stmt = $con->prepare($sql);
    $stmt->bindValue(1, $_POST["voornaam"]);
    $stmt->bindValue(2, $_POST["achternaam"]);
    $stmt->bindValue(3, $_POST["gebruikersnaam"]);
    $stmt->bindValue(4, $pass);
$stmt->bindValue(5, $_POST["land_id"]);

    $stmt->execute();

    $user = $stmt->fetchObject();
}
?>
<!DOCTYPE html>
<html lang="nl">

<head>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>

<body>
    <form method="POST">
        <container class="container">
            <input type="text" class="voornaam" name="voornaam" placeholder="Voornaam"><br>
            <input type="text" class="achternaam" name="achternaam" placeholder="Achternaam"><br>
            <input type="text" class="gebruikersnaam" name="gebruikersnaam" placeholder="Gebruikersnaam"><br>
            <input type="password" class="wachtwoord" name="wachtwoord" placeholder="Wachtwoord"><br>
            Admin: <input type="checkbox" class="admin" name="admin"><br>
            <input type="text" class="land" name="land_id" placeholder="Land"><br>
            <!--href locatie toevoegen naar homepagina-->
            <button type="submit" class="btn btn-primary" href="registreren.php">Registreren</button><br>
        </container>
    </form>
</body>

</html>