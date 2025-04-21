<?php

$host = "localhost";
$dbname = "nad_cert_request_form";
$dbusername = "root";
$dbpassword = "";

try {
    $connPDODBNADCERTDOC = new PDO("mysql:host=$host;dbname=$dbname", $dbusername, $dbpassword);
    $connPDODBNADCERTDOC->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection Failed: " . $e->getMessage());
}

// $host = "localhost";
// $username = "root";
// $password = "";
// $database = "nad_cert_request_form";
// $conn = mysqli_connect($host, $username, $password, $database);

?>
