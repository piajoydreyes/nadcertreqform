<?php
    require 'includes/dbcon.php';

    function getPaymentDetails($controlNumber) {
        global $connPDODBNADCERTDOC;
        $stmt = $connPDODBNADCERTDOC->prepare("SELECT description, quantity, unitprice, totalprice FROM tbl_cert_payment WHERE ctrl_no = ?");
        $stmt->execute([$controlNumber]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    function getUserDetails($controlNumber) {
        global $connPDODBNADCERTDOC;
        $stmt = $connPDODBNADCERTDOC->prepare("
            SELECT u.fullname, u.email_address
            FROM tbl_user u
            JOIN tbl_cert_req r ON u.user_id = r.user_id
            WHERE r.ctrl_no = ?
        ");
        $stmt->execute([$controlNumber]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    function updateStatus($controlNumber, $status) {
        global $connPDODBNADCERTDOC;
        $stmt = $connPDODBNADCERTDOC->prepare("UPDATE tbl_cert_req SET status = ? WHERE ctrl_no = ?");
        $stmt->execute([$status, $controlNumber]);
    }