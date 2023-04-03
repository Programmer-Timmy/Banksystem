<?php
require_once "database.php";

$stmt = $con->prepare("SELECT * FROM land");
$stmt->execute();
$landen = $stmt->fetchAll(PDO::FETCH_OBJ);

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
  <link rel="stylesheet" href="style/style.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>

<body>
  <form method="post" style="padding-top: 100px; padding-left: 500px; padding-right: 500px;">
    <div class="mb-3">
      voornaam: <input type="text" name="voornaam" class="form-control"><br>
    </div>
    <div class="mb-3">
      achernaam: <input type="text" name="achternaam" class="form-control"><br>
    </div>
    <div class="mb-3">
      Gebruikersnaam: <input type="text" name="gebruikersnaam" class="form-control"><br>
    </div>
    wachtwoord: <input type="text" name="wachtwoord" class="form-control"><br>
    <div class="mb-3">
      land:
      <select id="id_land" name="id_land" class="form-select">
        <?php
        foreach ($landen as $land) {
          echo "<option  value='$land->id_land'>$land->naam</option>";
        }
        ?>
      </select>
    </div>
    <input class="btn btn-primary" type="submit">
  </form>

  <div class="d-flex flex-column flex-md-row text-center text-md-start justify-content-between py-4 px-4 px-xl-5 bg-primary" style="position: fixed;
    bottom: 0;
    width: 100%;">
    <!-- Copyright -->
    <div class="text-white mb-3 mb-md-0">
      Copyright © 2023. All rights reserved.
    </div>

  </div>
</body>

</html>