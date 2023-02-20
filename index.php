<?php
require_once "database.php";
//var_dump(hash("SHA256", "Murcs"));
//var_dump(password_hash("Murcs", PASSWORD_DEFAULT));

//als er op submit is gedrukt
if ($_POST) {
	$stmt = $con->prepare("SELECT * FROM gebruiker WHERE gebruikersnaam=?");
	$stmt->bindValue(1, $_POST["gebruikersnaam"]);
	$stmt->execute();

	$user = $stmt->fetchObject();
	//als we iemand hebben gevonden met dit e-mailadres
	// kijken of username in de tabel staat
	if ($user !== false) {
		//checken of hij uberhaupt nog wel mag inloggen met deze email
		if (password_verify($_POST["wachtwoord"], $user->wachtwoord)) {
			session_start();
			$_SESSION["id"] = $user->id;

			header("location: portal.php");
			return;
		}
	}

	echo "<h1 style='color:red';>Kan niet inloggen</h1>";

	// met php checken of hash overeen komt met wachtwoord
	// zo ja dan gaan we session starten
}
?>

<!DOCTYPE html>
<html>

<head>
	<link rel="stylesheet" href="style.css">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>

<body>
	<form method="post">
		<form method="post">
			<container class="container">
				<input type="text" class="gebruikersnaam" name="gebruikersnaam" placeholder="Gebruikersnaam"><br>
				<input type="text" class="wachtwoord" name="wachtwoord" placeholder="Wachtwoord"><br>
				<!--href locatie toevoegen naar homepagina-->
				<a href="" class="btn btn-primary" role="button">Inloggen</a>
				<a href="registreren.php" class="btn btn-primary" role="button">Registreren</a><br>
			</container>
		</form>
	</form>
</body>

</html>