<?php
include('dbcon.inc.php');

if(isset($_POST['submitOR']))
{
    $ctrl_no = $_POST['ctrl_no'];
    $or_number = $_POST['or_num'];

    if (!empty($_POST['or_num']))
    {
        $query = "UPDATE tbl_cert_payment SET or_num = '$or_number' WHERE ctrl_no = '$ctrl_no' ";
        $query_run = mysqli_query($conn, $query);
    
        if ($query_run)
        {
            header('Location: ../reqTracker.php');
            exit();
        }       
    }
}