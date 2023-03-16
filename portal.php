<?php

session_start();

if(!isset($_SESSION["id"])) {
    // header("location: index.php");
}

//var_dump($_SESSION);

?>
<a href="logout.php">Afmelden</a>
<html>
<head>
<link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container">
<h2>Saldo
<h2>€123.456.789,00</h2>
<button type="submit" class="button2">overmaken</button><br>
</div>
</body>

</html>