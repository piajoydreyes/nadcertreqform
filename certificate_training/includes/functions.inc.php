<?php

require '../../includes/dbcon.php';

function emptyReqFormInput($fullname, $hospital_affiliation, $address, $mobile_number, $email_address): bool
{
    return empty($fullname) || empty($hospital_affiliation) || empty($address) || empty($mobile_number) || empty($email_address);
}

function validateNumber($mobile_number): bool
{
    return !preg_match("/^[0-9]{11}$/", $mobile_number);
}

function validateEmail($email_address): bool
{
    return !filter_var($email_address, FILTER_VALIDATE_EMAIL);
}
