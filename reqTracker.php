<?php
  include('includes/dbcon.inc.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="assets/img/favicon.png">
  <title>
    TRACK REQUEST
  </title>
  <!--     Fonts and icons     -->
  <link href="assets/fonts/fonts.css" rel="stylesheet" />
  <!-- Nucleo Icons -->
  <link href="assets/css/nucleo-icons.css" rel="stylesheet" />
  <link href="assets/css/nucleo-svg.css" rel="stylesheet" />
  <!-- Font Awesome Icons -->
  <script src="assets/fonts/fontawesome.js" crossorigin="anonymous"></script>
  <link href="assets/css/nucleo-svg.css" rel="stylesheet" />
  <!-- CSS Files -->
  <link id="pagestyle" href="assets/css/dash.css?v=2.0.4" rel="stylesheet" />
  <!-- stylesheet -->
  <link rel="stylesheet" href="assets/style2.css">
  <!-- jquery -->
  <script src="assets/jquery.min.js" nonce="<?=$_SERVER['HTTP_X_NONCE']?>"></script>
    
</head>

<body>
  
    <section class="container reqTrack">
        <header class="trackTitle">Track your Request:</header>
        <form  action="" method="POST" class="formReq">
            <div class="columnReq">
                <div class="input-box inputCtrl">
                    <input type="text" name="search" placeholder="Enter your Control No.">
                </div>
                <div class="input-box trackCtrl">
                    <button class="trackReq" type="submit" name="submit">Track</button>
                </div>
            </div>
        </form>
        <?php
            $conn = mysqli_connect("localhost", "root", "", "nad_cert_request_form");

            if (isset($_POST['submit']))
            {
                $ctrlno = $_POST['search'];
                
                $query = "SELECT tbl_user.*, tbl_cert_req.user_id, tbl_cert_req.ctrl_no, tbl_cert_req.fullname, tbl_cert_req.certDesignation, tbl_cert_req.trainingCert, tbl_cert_req.otherTrainingCert, tbl_cert_req.trainingDate, tbl_cert_req.processingOfficer, tbl_cert_req.status, tbl_cert_req.releaseDate FROM tbl_user
                JOIN tbl_cert_req ON tbl_user.ctrl_no = tbl_cert_req.ctrl_no
                WHERE tbl_cert_req.ctrl_no = '$ctrlno' ";
                $query_run = mysqli_query($conn, $query);
        ?>

            <table id="requests">
                <tr>
                    <th id="reqTh">Control No.</th>
                    <th>Full Name</th>
                    <th>Document Requesting</th>
                    <th>Title</th>
                    <th>Other Title</th>
                    <th>Training Date</th>
                    <th>Release Date</th>
                    <th>Processing Officer</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            
                <?php
                    if (mysqli_num_rows ($query_run) > 0 )
                    {
                        while ($row = mysqli_fetch_array($query_run))
                        {
                            ?>
                                <tr>
                                    <td id="reqTh"><?php echo $row['ctrl_no'] ?></td>
                                    <td><?php echo $row['fullname'] ?></td>
                                    <td><?php echo $row['certDesignation'] ?></td>
                                    <td><?php echo $row['trainingCert'] ?></td>
                                    <td><?php echo $row['otherTrainingCert'] ?></td>
                                    <td><?php echo date("M d, Y",strtotime($row['trainingDate'])) ?></td>
                                    <td id="reqTd"><?php 
                                                  if(!is_null($row['releaseDate']))
                                                  {
                                                    $reDate = strtotime($row['releaseDate']);
                                                    if ($reDate > 0)
                                                    {
                                                      echo date("M d, Y",strtotime($row['releaseDate']));
                                                    }
                                                  }
                                                  ?></td>
                                    <td class="text-center text-uppercase"><?php echo $row['processingOfficer'] ?></td>
                                
                                    <?php 
                                        $ctrl = $row['ctrl_no'];
                                        if ($row['status'] ==="Requested")
                                        {
                                            echo '<td id="reqTd">Requested</td>';
                                            echo '<td></td>';
                                        }
                                        else if ($row['status'] ==="For Payment")
                                        {
                                            echo '<td id="reqTd">For Payment</td>';
                                            // echo '<td id="reqTd"><a href="reqPayment.php" class="text-secondary font-weight-bold text-lg">
                                            // <i class="fa fa-wallet"></i> Pay </a> </td>';
                                            echo '<td id="reqTd"><form action="reqPayment.php" method="POST">
                                                <input type="hidden" name="reqPaymentID" value="'.$ctrl.'">
                                                <button type="submit" class="btn btn-info btn-xs mb-0" name="reqPaymentBtn">
                                                    <i class="fas fa-wallet">
                                                    </i>
                                                    Pay
                                                </button>
                                              </form></td>';
                                        }
                                        else if ($row['status'] ==="Paid")
                                        {
                                            echo '<td id="reqTd">Paid</td>';
                                            echo '<td></td>';
                                        }
                                        else if ($row['status'] ==="For Releasing")
                                        {
                                            echo '<td id="reqTd">For Releasing</td>';
                                            echo '<td></td>';
                                        }
                                        else if ($row['status'] ==="Released")
                                        {
                                            echo '<td id="reqTd">Released</td>';
                                            echo '<td></td>';
                                        }
                                    ?>
                                </tr>
                            <?php
                        }
                    }
                    else 
                    {
                        // echo "No Request Available";
                        ?>
                            <tr>
                                <td colspan="9">No Request Found.</td>
                            </tr>
                        <?php
                    }
                    ?>
            </table>

        <?php
            }
        ?>
        
    </section>


  <!--   Core JS Files   -->
  <script src="assets/js/core/popper.min.js"></script>
  <script src="assets/js/core/bootstrap.min.js"></script>
  <script src="assets/js/plugins/perfect-scrollbar.min.js"></script>
  <script src="assets/js/plugins/smooth-scrollbar.min.js"></script>
  <script src="assets/js/plugins/chartjs.min.js"></script>
  <!-- Github buttons -->
  <script async defer src="assets/js/buttons.js"></script>
  <!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="assets/js/dashboard.min.js?v=2.0.4"></script>
</body>

</html>