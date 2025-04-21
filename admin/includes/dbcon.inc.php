<?php

$serverName = "localhost";
$dBUsername = "root";
$dBPassword = "";
$dBName = "nad_cert_request_form";

$conn = mysqli_connect($serverName, $dBUsername, $dBPassword, $dBName);

if (!$conn)
{
    die("Connection failed: " .  mysqli_connect_error());
}