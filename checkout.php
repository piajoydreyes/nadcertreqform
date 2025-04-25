<?php
    require 'includes/dbcon.php';

    $controlNumber = $_POST['control_num'];

    // 1. Fetch user data
    $stmtUser = $connPDODBNADCERTDOC->prepare("SELECT * FROM tbl_user WHERE ctrl_no = ?");
    $stmtUser->execute([$controlNumber]);
    $user = $stmtUser->fetch();

    if (!$user) {
        exit("User not found.");
    }

    // 2. Split fullname into first and last name
    $nameParts = explode(" ", $user['fullname'], 2);
    $firstName = $nameParts[0];
    $lastName = isset($nameParts[1]) ? $nameParts[1] : '';

    // 3. Fetch payment info
    $stmtPay = $connPDODBNADCERTDOC->prepare("SELECT * FROM tbl_cert_payment WHERE ctrl_no = ?");
    $stmtPay->execute([$controlNumber]);
    $payment = $stmtPay->fetch();

    if (!$payment) {
        exit("No payment info found.");
    }

    $totalAmount = $payment['totalprice'];

    // 4. Set ngrok-based redirect URL
    $redirectUrl = "https://40d4-202-90-128-252.ngrok-free.app/nadcertreqform/payment_result.php";

    // 5. Maya Checkout API
    $checkoutUrl = "https://pg-sandbox.paymaya.com/checkout/v1/checkouts";
    $apiKey = "pk-843dszWFD28fI9BN36SrmXqunFfdEYgSEIMkVO7410B"; 

    $headers = [
        "Content-Type: application/json",
        "Authorization: Basic " . base64_encode($apiKey . ":")
    ];

    $request = [
        "totalAmount" => [
            "value" => $totalAmount,
            "currency" => "PHP"
        ],
        "buyer" => [
            "firstName" => $firstName,
            "lastName" => $lastName,
            "contact" => [
                "phone" => $user['mobile_number'],
                "email" => $user['email_address']
            ],
            "billingAddress" => [
                "line1" => $user['address'],
                "countryCode" => "PH"
            ]
        ],
        "redirectUrl" => [
            "success" => "$redirectUrl?status=success&control_num=$controlNumber",
            "failure" => "$redirectUrl?status=failure&control_num=$controlNumber",
            "cancel"  => "$redirectUrl?status=cancel&control_num=$controlNumber"
        ],
        "referenceNumber" => $controlNumber,
        "requestReferenceNumber" => "REQ-" . time()
    ];

    $ch = curl_init($checkoutUrl);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($request));
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    $response = curl_exec($ch);
    curl_close($ch);

    // Handle response
    $data = json_decode($response, true);

    if (isset($data['redirectUrl'])) {
        header("Location: " . $data['redirectUrl']);
        exit;
    } else {
        echo "Checkout error: ";
        echo "<pre>" . json_encode($data, JSON_PRETTY_PRINT) . "</pre>";
    }