<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "luizareceita";
$porta = 3306;

$conn = new mysqli($servername, $username, $password, $dbname, $porta);


if ($conn->connect_error) {
    die("Erro na conexão: " . $conn->connect_error);
}
?>