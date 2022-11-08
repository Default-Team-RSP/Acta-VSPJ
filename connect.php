<?php                                                                                  
$servername = "localhost";         //proměnné
$username = "root";
$password = "";
$dbname = "ActaVSPJ"; //název databáze
// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
 mysqli_set_charset($conn, "utf8");       //nastavení utf8
?>