<?php

require '../includes/dbcon.php';

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

    try {

        $connPDODBNADCERTDOC->beginTransaction();

        // Generate a unique control number
        $ctrl_no = createRandomcnumber($connPDODBNADCERTDOC);

        // Insert into tbl_user
        $stmt = $connPDODBNADCERTDOC->prepare("INSERT INTO tbl_user (ctrl_no, fullname, hospital_affiliation, address, mobile_number, email_address, added_at) 
            VALUES (:ctrl_no, :fullname, :hospital_affiliation, :address, :mobile_number, :email_address, NOW()) RETURNING user_id");

        $stmt->execute([
            ':ctrl_no' => $ctrl_no,
            ':fullname' => $fullname,
            ':hospital_affiliation' => $hospital_affiliation,
            ':address' => $address,
            ':mobile_number' => $mobile_number,
            ':email_address' => $email_address
        ]);

        $inserted_id = $stmt->fetchColumn();

         //  Insert multiple certificate requests
        $reqnos = $_POST['reqno'] ?? [];
        foreach ($reqnos as $i => $reqno) {
            $certDesignation = $_POST['certDesignation'][$i] ?? '';
            $trainingDate = $_POST['trainingDate'][$i] ?? '';
            $trainingDateTo = $_POST['trainingDateTo'][$i] ?? '';

            if (!empty($certDesignation) || !empty($trainingDate) || !empty($trainingDateTo)) {
                $stmt = $connPDODBNADCERTDOC->prepare("INSERT INTO tbl_cert_req 
                    (user_id, ctrl_no, fullname, certDesignation,  trainingDate, trainingDateTo, status, added_at) 
                    VALUES 
                    (:user_id, :ctrl_no, :fullname, :certDesignation, :trainingDate, :trainingDateTo, 'Requested', NOW())");

                $stmt->execute([
                    ':user_id' => $inserted_id,
                    ':ctrl_no' => $ctrl_no,
                    ':fullname' => $fullname,
                    ':certDesignation' => $certDesignation,
                    ':trainingDate' => $trainingDate,
                    ':trainingDateTo' => $trainingDateTo
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
