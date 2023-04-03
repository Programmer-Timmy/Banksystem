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
  <link rel="stylesheet" href="style/style.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>

<body>
  <form method="POST">


    <section class="vh-100" style="background-color: #eee;">
      <div class="container h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
          <div class="col-lg-12 col-xl-11">
            <div class="card text-black" style="border-radius: 25px;">
              <div class="card-body p-md-5">
                <div class="row justify-content-center">
                  <div class="col-md-10 col-lg-6 col-xl-5 order-2 order-lg-1">

                    <p class="text-center h1 fw-bold mb-5 mx-1 mx-md-4 mt-4">Registreren</p>

                    <form class="mx-1 mx-md-4">

                      <div class="d-flex flex-row align-items-center mb-4">
                        <i class="fas fa-user fa-lg me-3 fa-fw"></i>
                        <div class="form-outline flex-fill mb-0">
                          <input type="text" class="voornaam" name="voornaam" placeholder="Voornaam"><br>
                          <label class="form-label" for="form3Example1c">Voornaam</label>
                        </div>
                      </div>

                      <div class="d-flex flex-row align-items-center mb-4">
                        <i class="fas fa-envelope fa-lg me-3 fa-fw"></i>
                        <div class="form-outline flex-fill mb-0">
                          <input type="text" class="achternaam" name="achternaam" placeholder="Achternaam"><br>
                          <label class="form-label" for="form3Example3c">Achternaam</label>
                        </div>
                      </div>

                      <div class="d-flex flex-row align-items-center mb-4">
                        <i class="fas fa-key fa-lg me-3 fa-fw"></i>
                        <div class="form-outline flex-fill mb-0">
                          <input type="text" class="gebruikersnaam" name="gebruikersnaam" placeholder="Gebruikersnaam"><br>
                          <label class="form-label" for="form3Example4cd">Gebruikersnaam</label>
                        </div>
                      </div>




                      <div class="d-flex flex-row align-items-center mb-4">
                        <i class="fas fa-lock fa-lg me-3 fa-fw"></i>
                        <div class="form-outline flex-fill mb-0">
                          <input type="password" class="wachtwoord" name="wachtwoord" placeholder="Wachtwoord"><br>
                          <label class="form-label" for="form3Example4c">Wachtwoord</label>
                        </div>
                      </div>

                      <div class="d-flex flex-row align-items-center mb-4">
                        <i class="fas fa-key fa-lg me-3 fa-fw"></i>
                        <div class="form-outline flex-fill mb-0">
                          <input type="text" class="land" name="land_id" placeholder="Land"><br>
                          <label class="form-label" for="form3Example4cd">Land</label>
                        </div>
                      </div>






                      <div class="form-check d-flex justify-content-center mb-5">

                        <label class="form-check-label" for="form2Example3">
                          I ga akkoord met de Gebruikers voorwaarden <a href="#!">TOS ---</a>

                          <input class="form-check-input me-2" type="checkbox" value="" id="form2Example3c" />
                        </label>
                      </div>

                      <div class="d-flex justify-content-center mx-4 mb-3 mb-lg-4">
                        <button type="submit" class="button2">Registreren</button><br>
                      </div>




                    </form>

                  </div>
                  <div class="col-md-10 col-lg-6 col-xl-7 d-flex align-items-center order-1 order-lg-2">

                    <img id="test2" src="bankfoto2.jfif" class="img-fluid" alt="Sample image">





  </form>
</body>

</html>