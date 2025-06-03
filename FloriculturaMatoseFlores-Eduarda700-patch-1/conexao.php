<?php
$servername = "localhost";
$username = "root";
$password = "Hermes142";
$dbname = "floricultura";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error){
    die("falha na conexão: " . $conn->connect_error);

}
?>