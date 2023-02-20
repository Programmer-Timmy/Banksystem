<?php
require_once "database.php";
if ($_POST) {
	$stmt = $con->prepare("SELECT * FROM gebruiker WHERE gebruikersnaam=?");
	$stmt->bindValue(1, $_POST["gebruikersnaam"]);
	$stmt->execute();

	$user = $stmt->fetchObject();

	if ($user !== false) {
		if (password_verify($_POST["wachtwoord"], $user->wachtwoord)) {
			session_start();
			$_SESSION["id"] = $user->id;
			if ($user->isadmin == 1) {
				$_SESSION["admin"] = 'true';
				header("location:/admin");
				return;
			}
			header("location: portal.php");
			return;
		}
	}
	echo "<script>alert('Verkeerd wachtwoord of gebruikersnaam');</script>";
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
		<input type="text" class="gebruikersnaam" name="gebruikersnaam" placeholder="Gebruikersnaam"><br>
		<input type="password" class="wachtwoord" name="wachtwoord" placeholder="Wachtwoord"><br>
		<input type="submit" value="Inloggen" class="btn btn-primary">
		<a href="registreren.php" class="btn btn-primary" role="button">Registreren</a>
	</form>
</body>

</html>