<?php

    // $connPDODBNADCERTDOCservername = '10.14.1.5';
    // $connPDODBNADCERTDOCpgport = '5432';
    // $connPDODBNADCERTDOCdbname = 'prdocumenttracking';
    // $connPDODBNADCERTDOCusername = 'phcweb';
    // $connPDODBNADCERTDOCpassword = 'abcEFG28';

    // try {
    //     $connPDODBPRDOC = new PDO("pgsql:host=$connPDODBNADCERTDOCservername port=$connPDODBNADCERTDOCpgport dbname=$connPDODBNADCERTDOCdbname user=$connPDODBNADCERTDOCusername password=$connPDODBNADCERTDOCpassword");
    //     // set the PDO error mode to exception
    //     $connPDODBPRDOC->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // } catch (PDOException $e) {
    //     echo "Connection failed: " . $e->getMessage();
    // }

    $host = 'localhost';
    $db = 'nadcertreqform';
    $user = 'joy';
    $pass = '1234';
    $dsn = "pgsql:host=$host;dbname=$db";

    try {
        $connPDODBNADCERTDOC = new PDO($dsn, $user, $pass, [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        ]);
    } catch (PDOException $e) {
        echo "Database connection failed: " . $e->getMessage();
    }


?>