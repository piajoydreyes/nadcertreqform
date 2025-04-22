<?php

    session_start();
        
    require '../includes/dbcon.php'; 

    if (isset($_POST['editReqBtn'])) {
        $ctrl_no = $_POST['editDocReqID'];
        $processingOfficer = $_POST['processingOfficer'];
        $status = $_POST['status'];
        $remarks = $_POST['remarks'];
        $releaseDate = $_POST['releaseDate'];
        
        try {
            // Start transaction
            $connPDODBNADCERTDOC->beginTransaction();
        
            // Update request
            $stmt = $connPDODBNADCERTDOC->prepare("
                UPDATE tbl_cert_req
                SET processingOfficer = :processingOfficer,
                    status = :status,
                    remarks = :remarks,
                    releaseDate = :releaseDate
                WHERE ctrl_no = :ctrl_no
            ");
            $stmt->execute([
                ':processingOfficer' => $processingOfficer,
                ':status' => $status,
                ':remarks' => $remarks,
                ':releaseDate' => $releaseDate,
                ':ctrl_no' => $ctrl_no
            ]);
        
            // Optional: Insert payment info
            $description = $_POST['description'];
            $quantity = $_POST['quantity'];
            $unitPrice = $_POST['unitPrice'];
            $totalPrice = $_POST['totalPrice'];
            $adminID = $_POST['admin_id'];
            $userID = $_POST['user_id'];
        
            if (!empty($description) || !empty($quantity) || !empty($unitPrice) || !empty($totalPrice) || !empty($adminID) || !empty($userID)) {
                $stmt2 = $connPDODBNADCERTDOC->prepare("
                    INSERT INTO tbl_cert_payment (ctrl_no, description, quantity, unitPrice, totalPrice, admin_id, user_id)
                    VALUES (:ctrl_no, :description, :quantity, :unitPrice, :totalPrice, :admin_id, :user_id)
                ");
                $stmt2->execute([
                    ':ctrl_no' => $ctrl_no,
                    ':description' => $description,
                    ':quantity' => $quantity,
                    ':unitPrice' => $unitPrice,
                    ':totalPrice' => $totalPrice,
                    ':admin_id' => $adminID,
                    ':user_id' => $userID
                ]);
            }
        
            // Commit transaction
            $connPDODBNADCERTDOC->commit();
        
            header("Location: requests.php");
            exit();
        } catch (PDOException $e) {
            $connPDODBNADCERTDOC->rollBack();
            echo "Error: " . $e->getMessage();
        }
    }

