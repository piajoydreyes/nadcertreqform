<?php

require '../includes/dbcon.php';
require 'functions.php';

if (isset($_POST["submit"])) {

    // Sanitize and assign input values
    $ctrl_no = trim($_POST["ctrl_no"]);
    $fullname = trim($_POST["fullname"]);
    $hospital_affiliation = trim($_POST["hospital_affiliation"]);
    $address = trim($_POST["address"]);
    $mobile_number = trim($_POST["mobile_number"]);
    $email_address = trim($_POST["email_address"]);

    $certDesignation = $_POST['certDesignation'];
    $trainingDate = $_POST['trainingDate'];
    $trainingDateTo = $_POST['trainingDateTo'];

    $now = date('Y-m-d H:i:s');

    try {

        $connPDODBNADCERTDOC->beginTransaction();

        // Generate a unique control number
        $ctrl_no = createRandomcnumber($connPDODBNADCERTDOC);

        // Insert into tbl_user
        $stmt = $connPDODBNADCERTDOC->prepare("INSERT INTO tbl_user (ctrl_no, fullname, hospital_affiliation, address, mobile_number, email_address, added_at) 
            VALUES (:ctrl_no, :fullname, :hospital_affiliation, :address, :mobile_number, :email_address, :added_at) RETURNING user_id");

        $stmt->execute([
            ':ctrl_no' => $ctrl_no,
            ':fullname' => $fullname,
            ':hospital_affiliation' => $hospital_affiliation,
            ':address' => $address,
            ':mobile_number' => $mobile_number,
            ':email_address' => $email_address,
            ':added_at' => $now
        ]);

        $inserted_id = $stmt->fetchColumn();

    
        // Insert into tbl_cert_req
        $stmt = $connPDODBNADCERTDOC->prepare("INSERT INTO tbl_cert_req 
            (user_id, ctrl_no, fullname, certDesignation, trainingCert, otherTrainingCert, trainingDate, trainingDateTo, status, processingOfficer, remarks, releaseDate, added_at) 
            VALUES 
            (:user_id, :ctrl_no, :fullname, :certDesignation, '', '', :trainingDate, :trainingDateTo, 'Requested', '', '', '', :added_at)");

        $stmt->execute([
            ':user_id' => $inserted_id,
            ':ctrl_no' => $ctrl_no,
            ':fullname' => $fullname,
            ':certDesignation' => $certDesignation,
            ':trainingDate' => $trainingDate,
            ':trainingDateTo' => $trainingDateTo,
            ':added_at' => $now
        ]);
        

        $connPDODBNADCERTDOC->commit();

        // Confirmation message
        ?>

        <!DOCTYPE html>
        <html>
        <head>
            <meta charset="utf-8" />
            <title>REQUEST FORM</title>
            <link rel="stylesheet" href="assets/style.css">
            <script src="assets/jquery.min.js" nonce="<?=$_SERVER['HTTP_X_NONCE']?>"></script>
        </head>
        <body>
            <section class="container-confirm">
                <header>Request Submitted!</header>
                <p>
                    We received your request on <b><?= date('l, F j, Y') ?></b> with reference number <b><?= htmlspecialchars($ctrl_no) ?></b>.
                    <br><br>
                    Your request is being processed. Please allow 2-3 business days.
                    <br><br>
                    If you have any questions, contact us at 02-89252401 local 3544/3545 or nad@phc.gov.ph.
                </p>
                <form action="../reqTracker.php">
                    <button class="btnReq">Check Request Status</button>
                </form>
            </section>

            <script>
                $(document).ready(function() {
                    function disableBack() { window.history.forward(); }
                    window.onload = disableBack();
                    window.onpageshow = function(evt) { if (evt.persisted) disableBack(); }
                });
            </script>
        </body>
        </html>
        <?php

    } catch (PDOException $e) {
        if ($connPDODBNADCERTDOC->inTransaction()) {
            $connPDODBNADCERTDOC->rollBack();
        }
        error_log("Database error: " . $e->getMessage());
        echo "Error: " . $e->getMessage();
        die("Something went wrong. Please try again later.");
    }
} else {
    header("Location: reqForm.php");
    exit();
}
?>
