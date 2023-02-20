<?php

session_start();

if(!isset($_SESSION["id"])) {
    // header("location: index.php");
}

//var_dump($_SESSION);

?>
<a href="logout.php">Afmelden</a>


<h2>Saldo
<h2>€123.456.789,00</h2>