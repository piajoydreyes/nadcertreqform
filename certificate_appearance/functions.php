<?php

function createRandomcnumber($connPDODBNADCERTDOC) {
    $chars = "003232303232023232023456789";
    srand((double)microtime()*1000000);
    $control = '';
    $isUnique = false;
    
    while (!$isUnique) {
        $control = '';
        for ($i = 0; $i <= 8; $i++) {
            $num = rand() % 33;
            $tmp = substr($chars, $num, 1);
            $control .= $tmp;
        }
        $ctrl_no = 'APPEARANCE-CERT-' . $control;
        
        // Check if control number already exists in the database
        $stmt = $connPDODBNADCERTDOC->prepare("SELECT COUNT(*) FROM tbl_user WHERE ctrl_no = :ctrl_no");
        $stmt->execute([':ctrl_no' => $ctrl_no]);
        
        if ($stmt->fetchColumn() == 0) {
            $isUnique = true; // The control number is unique, break the loop
        }
    }
    return $ctrl_no;
}

$ctrl_no = createRandomcnumber($connPDODBNADCERTDOC);