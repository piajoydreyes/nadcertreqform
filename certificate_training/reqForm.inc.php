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

    $employee_no = $_POST["employee_no"] ?? null;
    $uad = $_POST["uad"] ?? null;
    $position = $_POST["position"] ?? null;
    $unit = $_POST["unit"] ?? null;
    $tentative_resig_date = $_POST["tentative_resig_date"] ?? null;
    $final_resig_date = $_POST["final_resig_date"] ?? null;

    $now = date('Y-m-d H:i:s');


    try {
        // require '../includes/dbcon.php'; 

        $connPDODBNADCERTDOC->beginTransaction();

        // Generate a unique control number
        $ctrl_no = createRandomcnumber($connPDODBNADCERTDOC);

        // 1. Insert into tbl_user
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

        // 2. If employee fields are not empty, insert into tbl_phc_employee
        if (!empty($employee_no) || !empty($uad) || !empty($position) || !empty($unit) || !empty($tentative_resig_date) || !empty($final_resig_date)) {
            $stmt = $connPDODBNADCERTDOC->prepare("INSERT INTO tbl_phc_employee (user_id, employee_no, uad, position, unit, tentative_resig_date, final_resig_date, added_at)
                VALUES (:user_id, :employee_no, :uad, :position, :unit, :tentative_resig_date, :final_resig_date, :added_at)");

            $stmt->execute([
                ':user_id' => $inserted_id,
                ':employee_no' => $employee_no,
                ':uad' => $uad,
                ':position' => $position,
                ':unit' => $unit,
                ':tentative_resig_date' => $tentative_resig_date,
                ':final_resig_date' => $final_resig_date,
                ':added_at' => $now
            ]);
        }

        // 3. Insert multiple certificate requests
        $reqnos = $_POST['reqno'] ?? [];
        foreach ($reqnos as $i => $reqno) {
            $certDesignation = $_POST['certDesignation'][$i] ?? '';
            $trainingCert = $_POST['trainingCert'][$i] ?? '';
            $otherTrainingCert = $_POST['otherTrainingCert'][$i] ?? '';
            $trainingDate = $_POST['trainingDate'][$i] ?? '';
            $trainingDateTo = $_POST['trainingDateTo'][$i] ?? '';

            if (!empty($certDesignation) || !empty($trainingCert) || !empty($otherTrainingCert) || !empty($trainingDate)) {
                $stmt = $connPDODBNADCERTDOC->prepare("INSERT INTO tbl_cert_req 
                    (user_id, ctrl_no, fullname, certDesignation, trainingCert, otherTrainingCert, trainingDate, trainingDateTo, status, processingOfficer, remarks, releaseDate, added_at) 
                    VALUES 
                    (:user_id, :ctrl_no, :fullname, :certDesignation, :trainingCert, :otherTrainingCert, :trainingDate, :trainingDateTo, 'Requested', '', '', '', :added_at)");

                $stmt->execute([
                    ':user_id' => $inserted_id,
                    ':ctrl_no' => $ctrl_no,
                    ':fullname' => $fullname,
                    ':certDesignation' => $certDesignation,
                    ':trainingCert' => $trainingCert,
                    ':otherTrainingCert' => $otherTrainingCert,
                    ':trainingDate' => $trainingDate,
                    ':trainingDateTo' => $trainingDateTo,
                    ':added_at' => $now
                ]);
            }
        }

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
        die("Something went wrong. Please try again later.");
    }
} else {
    header("Location: reqForm.php");
    exit();
}
?>
