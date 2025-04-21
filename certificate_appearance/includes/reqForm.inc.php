<?php
if (isset($_POST["submit"]))
{
    $ctrl_no = $_POST["ctrl_no"];
    $fullname = $_POST["fullname"];
    $hospital_affiliation = $_POST["hospital_affiliation"];
    $address = $_POST["address"];
    $mobile_number = $_POST["mobile_number"];
    $email_address = $_POST["email_address"];

    $certDesignation = $_POST['certDesignation'];
    $trainingDate = $_POST['trainingDate'];
    $trainingDateTo = $_POST['trainingDateTo'];
    $status = "Requested";

    require_once 'functions.inc.php';

    if (emptyReqFormInput($fullname, $hospital_affiliation, $address, $mobile_number, $email_address) !== false)
    {
        header ("location: ../reqForm.php?error=emptyinputs");
        exit();
    }
    if (validateNumber($mobile_number) !== false)
    {
        header ("location: ../reqForm.php?error=invalidnum");
        exit();
    }
    if (validateEmail($email_address) !== false)
    {
        header ("location: ../reqForm.php?error=invalidemail");
        exit();
    }
    // if (emptyRequests($certDesignation, $trainingCert, $otherTrainingCert) !== false)
    // {
    //     header ("location: ../reqForm.php?error=invalidnum");
    //     exit();
    // }

    // submitRequest($conn, $ctrl_no, $fullname, $hospital_affiliation, $address, $mobile_number, $email_address, $user_id, $employee_no, $uad, $position, $unit, $tentative_resig_date, $final_resig_date, $certDesignation, $trainingCert, $trainingDate, $status);

    try 
    {
        
        //user info
        $query = "INSERT INTO tbl_user (ctrl_no, fullname, hospital_affiliation, address, mobile_number, email_address) 
        VALUES (:ctrl_no, :fullname, :hospital_affiliation, :address, :mobile_number, :email_address)";
        $stmt = $connPDODBNADCERTDOC->prepare($query);
        $stmt->bindParam(":ctrl_no", $ctrl_no);
        $stmt->bindParam(":fullname", $fullname);
        $stmt->bindParam(":hospital_affiliation", $hospital_affiliation);
        $stmt->bindParam(":address", $address);
        $stmt->bindParam(":mobile_number", $mobile_number);
        $stmt->bindParam(":email_address", $email_address);
        $stmt->execute();

        $inserted_id = $connPDODBNADCERTDOC->lastInsertId();

        // for($i=0; $i<count($_POST['reqno']); $i++)
        // {
        //     $certDesignation = $_POST['certDesignation'][$i];
        //     $trainingCert = $_POST['trainingCert'][$i];
        //     $otherTrainingCert = $_POST['otherTrainingCert'][$i];
        //     $trainingDate = $_POST['trainingDate'][$i];
        //     $trainingDateTo = $_POST['trainingDateTo'][$i];

        //     $status = "Requested";

        
        //     if(!empty($_POST['certDesignation']) || !empty($_POST['trainingCert']) || !empty($_POST['otherTrainingCert']) || !empty($_POST['trainingDate']) || !empty($_POST['trainingDateTo']))
        //     {
        //         $query = "INSERT INTO tbl_cert_req (user_id, ctrl_no, fullname, certDesignation, trainingCert, otherTrainingCert, trainingDate, trainingDateTo, status) VALUES ('$inserted_id', '$ctrl_no','$fullname', '$certDesignation', '$trainingCert', '$otherTrainingCert', '$trainingDate', '$trainingDateTo', '$status')";

        //         $stmt = $connPDODBNADCERTDOC->prepare($query);
        //         $stmt->execute();
        //     }
        // }

        
            $certDesignation = $_POST['certDesignation'];
            // $trainingCert = $_POST['trainingCert'];
            // $otherTrainingCert = $_POST['otherTrainingCert'];
            $trainingDate = $_POST['trainingDate'];
            $trainingDateTo = $_POST['trainingDateTo'];

            $status = "Requested";

        
            if(!empty($_POST['certDesignation']) || !empty($_POST['trainingDate']) || !empty($_POST['trainingDateTo']))
            {
                $query = "INSERT INTO tbl_cert_req (user_id, ctrl_no, fullname, certDesignation,  trainingDate, trainingDateTo, status) VALUES ('$inserted_id', '$ctrl_no','$fullname', '$certDesignation', '$trainingDate', '$trainingDateTo', '$status')";

                $stmt = $connPDODBNADCERTDOC->prepare($query);
                $stmt->execute();
            }

        // header("Location: ../reqConfirmation.php");

        ?>

            <!DOCTYPE html>
            <html>
            <head>
                <meta charset="utf-8" />
                <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
                <link rel="apple-touch-icon" sizes="76x76" href="../../assets/img/apple-icon.png">
                <link rel="icon" type="image/png" href="../../assets/img/favicon.png">
                <title>
                    REQUEST FORM
                </title>

                <!-- stylesheet -->
                <link rel="stylesheet" href="../../assets/style.css">

                <!-- jquery -->
                <script src="../assets/jquery.min.js" nonce="<?=$_SERVER['HTTP_X_NONCE']?>"></script>
                
            </head>

            <body>

            <section class="container-confirm">
        
                <header>Request Submitted!</header>
                <p>
                    We have successfully received your request on <b> <?php $currentDate = date('l, F j, Y'); echo $currentDate; ?> </b> with reference number <b> <?php echo $ctrl_no ?></b>.
                </br>
                </br>
                    Your request is being processed. Please allow us 2-3 business day for our team to review and respond to your request.
                </br>
                </br>
                    If you have any questions, feel free to reach out to us at 02-89252401 local 3544/3545 or email at nad@phc.gov.ph
                </br>
                </br>
                <form action="../../reqTracker.php">
                    <button class="btnReq">Check Request Status</button>
                </form>
            </section>


            <!-- disables browser back/previous button -->
            <script>
                $(document).ready(function() {
                    function disableBack() { window.history.forward() }

                    window.onload = disableBack();
                    window.onpageshow = function(evt) { if (evt.persisted) disableBack() }
                });
            </script>

            </body>
            </html>

        <?php

        $connPDODBNADCERTDOC = null;
        $stmt = null;

        die();
        
    } 
    catch (PDOException $e) 
    {
        die("Connection Failed: " . $e->getMessage());
    }

}   
else 
{
    header("Location: ../reqForm.php");
    die();
}
