<?php

require_once "../database.php";

if (!isset($_SESSION['admin'])){
    header('location: ../');
}

$stmt = $con->prepare("SELECT * FROM gebruiker WHERE id_gebruiker = ?");
$stmt->bindValue(1, $_GET["id"]);
$stmt->execute();
$gebruiker = $stmt->fetchObject();

$stmt = $con->prepare("SELECT * FROM land");
$stmt->execute();
$landen = $stmt->fetchAll(PDO::FETCH_OBJ);


if ($_POST) {
    if (isset($_POST["isadmin"])) {
        $isadmin = 1;
    } else {
        $isadmin = 0;
    }

    $password = $gebruiker->wachtwoord;
    if ($_POST['wachtwoord']) $password = password_hash($_POST['wachtwoord'], PASSWORD_DEFAULT);

    $stmt = $con->prepare("UPDATE gebruiker SET voornaam=?, achternaam=?, isadmin=?, gebruikersnaam=?, wachtwoord=?, id_land=? WHERE id_gebruiker=?");
    $stmt->bindValue(1, $_POST["voornaam"]);
    $stmt->bindValue(2, $_POST["achternaam"]);
    $stmt->bindValue(3, $isadmin);
    $stmt->bindValue(4, $_POST["gebruikersnaam"]);
    $stmt->bindValue(5, $password);
    $stmt->bindValue(6, $_POST["id_land"]);
    $stmt->bindValue(7, $_GET["id"]);
    $stmt->execute();

    header("location: ../admin");
}

?>

<html>

<body>
    <form method="post">
        voornaam: <input type="text" name="voornaam" value="<?php echo $gebruiker->voornaam ?>"><br>
        achernaam: <input type="text" name="achternaam" value="<?php echo $gebruiker->achternaam ?>"><br>
        Admin? <input type="checkbox" name="isadmin" <?php
        if ($gebruiker->isadmin == '1') {
        echo "checked";
        } ?>><br>
        Gebruikersnaam: <input type="text" name="gebruikersnaam" value="<?php echo $gebruiker->gebruikersnaam ?>"><br>
        wachtwoord: <input type="text" name="wachtwoord"><br>
        land:
        <select id="id_land" name="id_land">
            <?php
            // voeg optie toe om andere landen aanteclicken en dan een nieuw land toetevoegen aan de database
            foreach ($landen as $land) {
                if ($land->id_land == $gebruiker->id_land) {
                    echo "<option selected value='$land->id_land'>$land->naam</option>";
                } else {
                    echo "<option value='$land->id_land'>$land->naam</option>";
                }
            }
            ?>
        </select>
        <input type="submit">
    </form>
</body>

</html>