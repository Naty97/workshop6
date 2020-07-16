<?php
include "C:\xampp\apache\virtualhost\isw613\Workshop6\connection.php";
$username = $argv[1];
$password = $argv[2];
$dbName = $argv[3];
$host = $argv[4];
$table = $argv[5];
$file = $argv[6];


try {
    $conexion = new PDO("mysql:host=$host;dbname=$dbName", $username, $password);
} catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
    die();
}

$file = fopen($argv[6], "w");

$users = $conexion->prepare("SELECT * FROM $table");
$users->execute();
$users = $users->fetchAll();
foreach ($users as $user) {
    fwrite($file, $user["name"] . ", " . $user["lastname"] . ", " . $user["DNI"] . ", " . $user["age"] . "\r\n");
}
echo "¡El archivo .csv con la información de los usuarios fue creado exitosamente!";

fclose($file);
?>