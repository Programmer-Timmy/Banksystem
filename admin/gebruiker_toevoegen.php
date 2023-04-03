<?php
session_start();
require_once "../database.php";

if (!isset($_SESSION['admin'])) {
    header('location: ../');
}

if ($_POST) {

    if (isset($_POST["isadmin"])) {
        $isadmin = 1;
    } else {
        $isadmin = 0;
    }

    $pass = password_hash($_POST['wachtwoord'], PASSWORD_DEFAULT);

    $stmt = $con->prepare("INSERT INTO gebruiker(voornaam, achternaam, isadmin, gebruikersnaam, wachtwoord, id_land) VALUES(?,?,?,?,?,?)");
    $stmt->bindValue(1, $_POST["voornaam"]);
    $stmt->bindValue(2, $_POST["achternaam"]);
    $stmt->bindValue(3, $isadmin);
    $stmt->bindValue(4, $_POST["gebruikersnaam"]);
    $stmt->bindValue(5, $pass);
    $stmt->bindValue(6, $_POST["id_land"]);
    $stmt->execute();

    header("location: ../admin");
}

$stmt = $con->prepare("SELECT * FROM land");
$stmt->execute();

$landen = $stmt->fetchAll(PDO::FETCH_OBJ);
?>
<html>
<body>
    <form method="post">
        voornaam: <input type="text" name="voornaam"><br>
        achernaam: <input type="text" name="achternaam"><br>
        Admin? <input type="checkbox" name="isadmin"><br>
        Gebruikersnaam: <input type="text" name="gebruikersnaam"><br>
        wachtwoord: <input type="text" name="wachtwoord"><br>
        land:
        <select id="id_land" name="id_land">
            <?php
            foreach ($landen as $land) {
                echo "<option  value='$land->id_land'>$land->naam</option>";
            }
            ?>
        </select>
        <input type="submit">
    </form>
</body>
</html>