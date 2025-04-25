<?php
require 'includes/dbcon.php';


$status = $_GET['status'] ?? 'unknown';
$ctrl_no = $_GET['control_num'] ?? 'N/A';

$message = '';
$color = 'gray';

switch ($status) {
    case 'success':
        $message = "Payment Successful!";
        $color = 'green';

        // Optional: Update status in tbl_cert_req
        $stmt = $connPDODBNADCERTDOC->prepare("UPDATE tbl_cert_req SET status = 'Paid', remarks = 'Paid via Maya' WHERE ctrl_no = ?");
        $stmt->execute([$ctrl_no]);

        break;

    case 'failure':
        $message = "Payment Failed.";
        $color = 'red';
        break;

    case 'cancel':
        $message = "Payment was Cancelled.";
        $color = 'orange';
        break;

    default:
        $message = "Unknown payment result.";
        break;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Payment Result</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f3f3f3;
            text-align: center;
            padding-top: 50px;
        }
        .status-box {
            display: inline-block;
            padding: 30px;
            border-radius: 10px;
            background: white;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        .status-box h1 {
            color: <?= $color ?>;
        }
    </style>
</head>
<body>
    <div class="status-box">
        <h1><?= htmlspecialchars($message) ?></h1>
        <p><strong>Control Number:</strong> <?= htmlspecialchars($ctrl_no) ?></p>
        <a href="index.php">Return to Homepage</a>
    </div>
</body>
</html>